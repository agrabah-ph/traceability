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
        $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));

        $host_names = explode(".", $_SERVER['HTTP_HOST']);
        $domain = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];

        return view('dashboard', compact( 'subdomain', 'domain'));
    }
}
