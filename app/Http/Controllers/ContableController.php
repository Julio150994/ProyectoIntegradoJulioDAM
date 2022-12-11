<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContableController extends Controller
{
    /**
     * Display a main menu of contable user.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu() {
        return view('contable.menu');
    }
}
