<?php

namespace App\Http\Controllers;

use App\Term;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Events\TermsUpdated as TermsUpdatedEvent;

class TermController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('terms/index')->with('terms', Term::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $term = new Term();
        return view('terms/create')->with('term', $term);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
        ]);

        $term = new Term();
        $term->name = $request->input('name');
        $term->content = $request->input('content');
        $term->user_id = Auth::id();
        if ($request->input('publish')) {
            $term->published_at = date('Y-m-d H:i:s');
        }

        if ($term->save() && $request->input('publish')) {
            event(new TermsUpdatedEvent($term));
        }

        Session::flash('alert', ['class' => 'success', 'message' => 'Terms added successfully!']);
        return redirect('terms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $term = Term::findOrFail($id);
        if ($term->published_at) {
            Session::flash('alert', ['class' => 'warning', 'message' => 'Can not edit published terms!']);
            return redirect('terms');
        } else {
            return view('terms/edit')->with('term', $term);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
        ]);

        $term = Term::findOrFail($id);
        $term->name = $request->input('name');
        $term->content = $request->input('content');
        $term->user_id = Auth::id();
        if ($request->input('publish')) {
            $term->published_at = date('Y-m-d H:i:s');
        }

        if ($term->save() && $request->input('publish')) {
            event(new TermsUpdatedEvent($term));
        }

        Session::flash('alert', ['class' => 'success', 'message' => 'Terms updated successfully!']);
        return redirect('terms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $term = Term::findOrFail($id);
        if ($term->published_at) {
            Session::flash('alert', ['class' => 'warning', 'message' => 'Can not remove published terms!']);
            return json_encode(false);
        } else {
            $response = $term->delete();
            return json_encode($response);
        }
    }

}
