<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TosController extends Controller
{
    public function index()
    {
        echo 'last term';
    }
    
    public function history($id)
    {
        echo 'term ' . $id;
    }
}
