<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TvCategory;
use Illuminate\Http\Request;

class LivesCatCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tvcat = TvCategory::all();

        return response()->json($tvcat, 200);
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

        $tvcat = TvCategory::create($request->all());

        return response()->json($tvcat, 201);
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
        $tvcat = TvCategory::find($id);

        if($tvcat){
            return response()->json($tvcat, 200); }
        else
        {
            return response()->json(["message"=>"aucune entrée"], );
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

        $tvcat = TvCategory::findOrFail($id);
        $tvcat->update($request->all());

        return response()->json($tvcat, 200);
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
        $test=TvCategory::destroy($id);

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
