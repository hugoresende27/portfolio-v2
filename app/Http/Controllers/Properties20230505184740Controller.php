<?php

namespace App\Http\Controllers;

use App\Models\ApiMaker\Properties20230505184740;
use Illuminate\Http\Request;

class Properties20230505184740Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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





        public function store(Request $request): \Illuminate\Http\JsonResponse
        {
            $validatedData = $request->validate([
					'title' => 'required|string',
					'reference' => 'required|string',
					'price' => 'required|numeric',
					'show_price' => 'required|boolean',
					'show_address' => 'required|boolean',]);
            $post = new Properties20230505184740;

					$post->title = $validatedData['title'];
					$post->reference = $validatedData['reference'];
					$post->price = $validatedData['price'];
					$post->show_price = $validatedData['show_price'];
					$post->show_address = $validatedData['show_address'];
            $post->save();
            return response()->json(['message' => 'Properties20230505184740 created successfully', 'data' => $post]);
        }

    /**
     * Display the specified resource.
     */



        public function show(Properties20230505184740 $properties20230505184740): Properties20230505184740
        {
            return $properties20230505184740;
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Properties20230505184740 $properties20230505184740)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Properties20230505184740 $properties20230505184740): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'reference' => 'required|string',
            'price' => 'required|numeric',
            'show_price' => 'required|boolean',
            'show_address' => 'required|boolean',
        ]);


        $properties20230505184740->title = $validatedData['title'];
        $properties20230505184740->reference = $validatedData['reference'];
        $properties20230505184740->price = $validatedData['price'];
        $properties20230505184740->show_price = $validatedData['show_price'];
        $properties20230505184740->show_address = $validatedData['show_address'];

        $properties20230505184740->save();

        return response()->json([
            'message' => 'Properties20230505184740 updated successfully',
            'data' => $properties20230505184740,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */

        public function destroy(Properties20230505184740 $properties20230505184740): ?bool
        {
            return $properties20230505184740->delete();
        }
}
