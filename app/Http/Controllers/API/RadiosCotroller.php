<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Radios;
use Illuminate\Http\Request;

class RadiosCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $radios = Radios::all();

        return response()->json($radios, 200);
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

        $radio = Radios::create($request->all());

        return response()->json($radio, 201);
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
        $radio = Radios::findOrFail($id);

        if($radio){

            return response()->json($radio);
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

        $radio = Radios::findOrFail($id);
        $radio->update($request->all());

        return response()->json($radio, 200);
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
        Radios::destroy($id);

        return response()->json(null, 204);
    }
}
