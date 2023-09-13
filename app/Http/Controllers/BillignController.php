<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillignController extends Controller
{
    //
    public function index(){
        return view('billing.index');
    }
}
