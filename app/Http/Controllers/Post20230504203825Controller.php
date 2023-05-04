<?php

namespace App\Http\Controllers;

use App\Models\ApiMaker\Post20230504203825;
use Illuminate\Http\Request;

class Post20230504203825Controller extends Controller
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'author' => 'required|text',
                'title' => 'required|text',
                'date' => 'required|date',
                'number' => 'required|integer',]);
        $post = new Post20230504203825;

                $post->author = $validatedData['author'];
                $post->title = $validatedData['title'];
                $post->date = $validatedData['date'];
                $post->number = $validatedData['number'];
        $post->save();
        return response()->json(['message' => 'Post20230504203825 created successfully', 'data' => $post]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Post20230504203825 $post20230504203825)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post20230504203825 $post20230504203825)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post20230504203825 $post20230504203825)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post20230504203825 $post20230504203825)
    {
        //
    }
}
