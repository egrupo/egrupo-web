<?php

namespace App\Http\Controllers\Material;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Material\LocalArrumo;
use App\Models\Divisao;

use Auth;
use App;

class LocalArrumoController extends Controller
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
        return view('organization.material.localarrumo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        $local = new LocalArrumo;

        $local->fill([
            'nome' => $request->get('nome'),
            'divisao' => $request->get('divisao'),
            'organization_id' => Auth::user()->organization_id,
            'user_id' => Auth::user()->id,
            'last_update_at' => date('Y-m-d H:i:s'),
        ]);

        if(!$local->isValid()){
            return redirect()->back()->withInput();
        }

        $local->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug,$id){

        $local = LocalArrumo::find($id);
        
        if(!$local)
            App::abort(404);

        return view('organization.material.localarrumo.show')->with([
            'local' => $local,
            ]);
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
        $local = LocalArrumo::find($id);

        $local->divisao = $request->get('divisao');
        $local->nome = $request->get('nome');

        $local->save();

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
        $local = LocalArrumo::find($id);

        if(sizeOf($local->getMaterial()) > 0)
            return redirect()->back()->with('erros',['Não podes apagar um local de arrumação com material lá dentro!']);

        $divisao = $local->divisao;

        LocalArrumo::find($id)->delete();

        return redirect()->route('divisoes.material',[$slug,Divisao::getLabel($divisao)]);
    }

}
