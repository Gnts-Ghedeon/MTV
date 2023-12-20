<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $languages = Language::all();

        return $languages;
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

        $language = Language::create($request->all());

        return response()->json($language, 201);
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
        $language = Language::find($id);

        if($language){
            return response()->json($language, 200); }
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

        $language = Language::findOrFail($id);
        $language->update($request->all());

        return response()->json($language, 200);
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
        $test=Language::destroy($id);

        //return response()->json(null, 204);
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


