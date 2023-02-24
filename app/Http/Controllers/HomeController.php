<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (request()->is('doctors/*')) {
            return redirect()->route('doctors.login');
        } else if (request()->is('patients/*')) {
            return redirect()->route('patients.login');
        } else {
            return redirect()->route('patients.login');
        }
        // return view('auth.login');

    }
}
