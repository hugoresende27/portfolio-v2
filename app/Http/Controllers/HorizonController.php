<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateElasticdemoRequest;
use App\Models\Elasticdemo;
use App\Models\fs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HorizonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $quote = $this->inspire();
        $data = Elasticdemo::orderBy('updated_at', 'DESC')->paginate(10);
        return view('projects.horizon', compact('quote','data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getRecords()
    {
        return Elasticdemo::orderBy('updated_at', 'DESC')->paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'code' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create new record in the database
        $record = new Elasticdemo;
        $record->name = $request->input('name');
        $record->street = $request->input('street');
        $record->number = $request->input('number');
        $record->code = $request->input('code');
        $record->save();

        // Return response with success message
        return response()->json([
            'success' => true,
            'message' => 'Record created',
            'record' => $record
        ], 200);
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

    public function delete(int $id)
    {
        Elasticdemo::where('id', $id)->delete();
    }

    public function deleteAll()
    {
        DB::table('elasticdemos')->truncate();
    }

    public function runSeeder()
    {
        Elasticdemo::factory(10)->create();
    }
}
