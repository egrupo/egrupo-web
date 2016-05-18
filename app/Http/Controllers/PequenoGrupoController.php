<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PequenoGrupo;
use Auth;

class PequenoGrupoController extends Controller
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
        return view('organization.pequenogrupo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        $peq = new PequenoGrupo;

        $peq->fill([
            'nome' => $request->get('nome'),
            'divisao' => $request->get('divisao'),
            'organization_id' => Auth::user()->organization_id
        ]);

        if(!$peq->isValid()){
            return redirect()->back()->withInput();
        }

        $peq->save();
        return redirect()->to('admin');
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
        return view('organization.pequenogrupo.edit',array('peq' => PequenoGrupo::find($id)));
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
        $peq = PequenoGrupo::find($id);

        $peq->divisao = $request->get('divisao');
        $peq->nome = $request->get('nome');

        $peq->save();

        return redirect()->to('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        PequenoGrupo::find($id)->delete();
        return redirect()->to('admin');
    }
}
