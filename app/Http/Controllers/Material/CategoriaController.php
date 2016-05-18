<?php

namespace App\Http\Controllers\Material;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Material\Categoria;
use App\Models\Material\Material;

use Auth;
use Validator;

class CategoriaController extends Controller
{
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
        return view('organization.material.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        $categoria = new Categoria;

        $categoria->fill([
            'nome' => $request->get('nome'),
            'organization_id' => Auth::user()->organization_id
        ]);

        if(!$categoria->isValid()){
            return redirect()->back()->withInput();
        }

        $categoria->save();
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
    public function edit($slug,$id)
    {
        //return view('organization.pequenogrupo.edit',array('peq' => PequenoGrupo::find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug,Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->nome = $request->get('nome');
        $categoria->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        Categoria::find($id)->delete();
        Material::where('categoria_id',$id)->update(['categoria_id' => 0]);
        return redirect()->back();
    }
}
