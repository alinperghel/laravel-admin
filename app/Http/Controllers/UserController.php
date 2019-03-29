<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Term;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('users/index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        echo ' hi user create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('users/edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $user = User::find($id);
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        
        $user->name = $request->get('name');
        if($user->email != $request->get('email')){
            $user->markEmailAsUnverified();
        }
        $user->email = $request->get('email');
        
        $user->phone_number = $request->get('phone_number');
        $user->save();
        
        
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        $response = $user->delete();
        return json_encode($response);
    }

    public function verify($id) {
        $user = User::find($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        // return unverify url
        return route('users.unverify', $id);
    }

    public function unverify($id) {
        $user = User::find($id);
        $user->markEmailAsUnverified();
        $user->save();
        //return verify url
        return route('users.verify', $id);
    }

    public function search(Request $request) {

        $filter = $request->input('filter');

        if ($filter) {
            $users = User::query()
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('email', 'LIKE', "%{$filter}%")
                    ->get();
        } else {
            $users = User::all();
        }

        if (count($users) > 0) {
            $html = "";

            foreach ($users as $user) {
                $html .= "<tr>";
                $html .= "<th scope=\"row\">" . $user->id . "</th>";
                $html .= "<td>" . $user->email . "</td>";
                $html .= "<td>" . $user->phone_number . "</td>";
                $html .= "<td>";
                $html .= "<a class=\"btn btn-primary\" href=\"" . route('users.edit', ['user' => $user->id]) . "\">" . __('Edit') . "</a>";
                $html .= "<a class=\"btn btn-danger delete-user\" data-id=\"" . $user->id . "\" data-token=\"" . csrf_token() . "\" href=\"" . route('users.destroy', ['user' => $user->id]) . "\">" . __('Delete') . "</a>";
                if ($user->email_verified_at) {
                    $html .= "<a class=\"btn btn-warning unverify-user\" href=\"" . route('users.unverify', ['user' => $user->id]) . "\">" . __('Unverify') . "</a>";
                } else {
                    $html .= "<a class=\"btn btn-success verify-user\" href=\"" . route('users.verify', ['user' => $user->id]) . "\">" . __('Verify') . "</a>";
                }
                $html .= "</td>";
                $html .= "</tr>";
            }

            return $html;
        } else {
            return 0;
        }
    }
    
    public function accept_actual_terms(){
        $term = Term::orderBy('published_at', 'desc')->take(1)->get()->first();
        $user = User::findOrFail(Auth::id());
        $user->terms_id = $term->id;
        $user->terms_accepted_at = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->back();
    }

}
