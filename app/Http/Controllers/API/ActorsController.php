<?php

namespace App\Http\Controllers\API;

use App\ActorDirector;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $actors = ActorDirector::latest()->paginate(25);

        return $actors;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $actor = ActorDirector::create($request->all());

        return response()->json($actor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = ActorDirector::findOrFail($id);

        return $actor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $actor = ActorDirector::findOrFail($id);
        $actor->update($request->all());

        return response()->json($actor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ActorDirector::destroy($id);

        return response()->json(null, 204);
    }
}
