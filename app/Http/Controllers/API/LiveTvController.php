<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\LiveTV;
use Illuminate\Http\Request;

class LiveTvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $livetv = LiveTV::all();//latest()->paginate(25);

        return response()->json($livetv,200);
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

        $livetv = LiveTV::create($request->all());

        if($livetv){

            return response()->json($livetv, 201);
        }
        else{

            return response()->json(["message"=>" ajout impossible, verifier tous les champs et contraite de clé étrangère"], );
        }
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
        $livetv = LiveTV::find($id);

        //return $livetv;

        if($livetv){
            return response()->json($livetv, 200); }
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

        $livetv = LiveTV::find($id);
        $test=$livetv->update($request->all());

        if($test){
            return response()->json($livetv, 200); }
        else{
            return response()->json(["message"=>"aucune entrée"], );
        }
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
        $test = LiveTV::destroy($id);

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
