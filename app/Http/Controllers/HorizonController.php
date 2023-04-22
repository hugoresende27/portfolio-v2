<?php

namespace App\Http\Controllers;

use App\Models\Elasticdemo;
use App\Models\fs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HorizonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $quote = $this->inspire();
        $data = Elasticdemo::paginate(10);
        return view('projects.horizon', compact('quote','data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(fs $fs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fs $fs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fs $fs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fs $fs)
    {
        //
    }



    public function startHorizon()
    {
//        echo "<pre>";
//        Artisan::call('horizon:list');
//        return (Artisan::output());
//        exec('php artisan horizon');
    }

    public function inspire(): string
    {
        Artisan::call('inspire');
        return (Artisan::output());
    }
}
