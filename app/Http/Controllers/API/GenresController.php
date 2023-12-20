<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genre = genres::all();//latest()->paginate(25);

        return response()->json($genre,200);
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

        $genre = genres::create($request->all());

        return response()->json($genre, 201);
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
        $genre = genres::find($id);

        if($genre){
            return response()->json($genre, 200); }
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

        $genre = genres::findOrFail($id);
        $genre->update($request->all());

        return response()->json($genre, 200);
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
       $test = genres::destroy($id);

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
