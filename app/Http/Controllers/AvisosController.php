<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Aviso;
use App\User;
use Auth;

class AvisosController extends Controller
{
        
    public function __construct(){
        $this->middleware('auth.organization');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aviso = new Aviso;
        $aviso->fill($request->all());
        $aviso->organization_id = Auth::user()->organization_id;

        $id = $request->get('target_id');
        $divisao = $request->get('divisao');

        $tipo = Aviso::$INDIVIDUAL;

        if($id == 0){
            $tipo = Aviso::$GRUPO;
            $target_id = $divisao;
        } else {
            $target_id = $id;
        }

        $aviso->tipo = $tipo;
        $aviso->target_id = $target_id;

        $aviso->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        Aviso::find($id)->delete();
        return redirect()->back();
    }
}
