<?php

namespace App\Http\Controllers;

use App\Models\PostView;
use App\Http\Requests\StorePostViewRequest;
use App\Http\Requests\UpdatePostViewRequest;

class PostViewController extends Controller
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
    public function store(StorePostViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PostView $postView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostView $postView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostViewRequest $request, PostView $postView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostView $postView)
    {
        //
    }
}
