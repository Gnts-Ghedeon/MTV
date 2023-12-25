<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\PodcastCategory;
use Illuminate\Http\Request;

class Podcast_CategCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $podcat = PodcastCategory::all();

        return response()->json($podcat,200);
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

        $podcat = PodcastCategory::create($request->all());

        return response()->json($podcat, 201);
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
        $podcat = PodcastCategory::find($id);

        if($podcat){
            return response()->json($podcat, 200); }
        else
        {
            return response()->json(["message"=>"aucune entrée"], 404 );
        }

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

        $podcat = PodcastCategory::findOrFail($id);
        $podcat->update($request->all());

        return response()->json($podcat, 200);
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
        $test=PodcastCategory::destroy($id);

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
