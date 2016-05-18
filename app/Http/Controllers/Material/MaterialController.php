<?php

namespace App\Http\Controllers\Material;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Material\Material;
use App\Models\Material\LocalArrumo;
use App\Models\Divisao;

use Auth;
use App;

class MaterialController extends Controller
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
        return view('organization.material.material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        //
        // 'id','organization_id','divisao','categoria_id','local_arrumo','quantidade','nome','descricao','notas'
        $material = new Material;

        $material->fill([
            'nome' => $request->get('nome'),
            'divisao' => $request->get('divisao'),
            'organization_id' => Auth::user()->organization_id,
            'local_arrumo' => $request->get('local_arrumo'),
            'quantidade' => $request->get('quantidade'),
        ]);

        if(!$material->isValid()){
            return redirect()->back()->with('errors',$material->errors);
        }

        $local = LocalArrumo::find($request->get('local_arrumo'));
        $local->last_update_at = date('Y-m-d H:i:s');
        $local->user_id = Auth::user()->id;
        $local->save();

        $material->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug,$id)
    {
        // $material = Material::find($id);

        // if(!$material)
        //     App::abort(404);

        // return 'showing '.$material->nome;  
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$id)
    {
        $material = Material::find($id);

        if(!$material)
            App::abort(404);

        return view('organization.material.material.edit',array(
            'material' => $material,
            ));
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
        $material = Material::find($id);

        //Atualizar o local anterior
        $previousLocal = LocalArrumo::find($material->local_arrumo);
        if($previousLocal){
            $previousLocal->last_update_at = date('Y-m-d H:i:s');
            $previousLocal->user_id = Auth::user()->id;
            $previousLocal->save();
        }

        $material->update($request->all());
        $material->save();

        //Atualizar o novo local
        $local = LocalArrumo::find($request->get('local_arrumo'));
        if($local){
            $local->last_update_at = date('Y-m-d H:i:s');
            $local->user_id = Auth::user()->id;
            $local->save();
        }

        return redirect()->route('divisoes.material',[$slug,Divisao::getLabel($material->divisao)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id,Request $request)
    {
        $material = Material::find($id);

        $local = LocalArrumo::find($material->local_arrumo);
        $local->last_update_at = date('Y-m-d H:i:s');
        $local->user_id = Auth::user()->id;
        $local->save();

        $divisao = $material->divisao;

        $material->delete();

        return redirect()->route('divisoes.material',[$slug,Divisao::getLabel($divisao)]);
    }
}
