<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Trace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TraceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Trace::get();
        return response()->view('user.trace.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Inventory::with('product')->get();
//            return $datas;
        $random = Str::random(10);

        $host_names = explode(".", $_SERVER['HTTP_HOST']);
        $domain = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1]."/".$random;
        return response()->view('user.trace.create', compact('datas', 'random', 'domain'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function show(Trace $trace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function edit(Trace $trace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trace $trace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trace $trace)
    {
        //
    }
}
