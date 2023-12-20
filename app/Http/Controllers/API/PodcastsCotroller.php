<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Podcasts;
use Illuminate\Http\Request;

class PodcastsCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $podcast = Podcasts::all();

        return response()->json($podcast, 200);
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

        $podcast = Podcasts::create($request->all());

        return response()->json($podcast, 201);
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
        $podcast = Podcasts::find($id);

        if($podcast){

            return response()->json($podcast);
        }
        else{
             return response()->json(["message"=>"aucune entrée"], );
        };
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

        $podcast = Podcasts::findOrFail($id);
        $podcast->update($request->all());

        return response()->json($podcast, 200);
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
        $test=Podcasts::destroy($id);

        if($test){
            return response()->json(["message"=>" succes"], 204);
        }
        else{
        {

            return response()->json(["message"=>"erreur de suppression, rassurez vous que cet id existe"], );

        }
        };
    }
}
