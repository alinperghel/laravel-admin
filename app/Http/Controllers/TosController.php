<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;

class TosController extends Controller {

    public function index() {
        $term = Term::orderBy('published_at', 'desc')->take(1)->get()->first();

        $old_terms = Term::orderBy('published_at', 'desc')->where('published_at', '!=', null)->get();
        
        if (count($old_terms) > 1) {
            $old_terms->shift(); // remove first item from colection
        }
        
        
        return view('tos.view')->with(['term' => $term, 'old_terms'=>$old_terms]);
    }

    public function history($id) {
        $term = Term::findOrFail($id);
        return view('tos.view')->with(['term' => $term]);
    }

}
