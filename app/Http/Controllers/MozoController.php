<?php

namespace App\Http\Controllers;


class MozoController extends Controller
{
    /**
     * Display a main menu of contable user.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu() {
        return view('mozo.menu');
    }
}
