<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Jogo;
use App\Models\Divisao;
use DB;
use Auth;

class JogosController extends Controller
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
        return view('organization.jogos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug, Request $request)
    {
        $jogo = new Jogo;
        $jogo->fill($request->all());
        $jogo->organization_id = Auth::user()->organization_id;

        if( !$jogo->isValid() )
            return redirect()->back()->withErrors($jogo->messages)->withInput();

        $divisoes = '';

        if($request->has('divisao_alcateia'))
            $divisoes .= Divisao::$ALCATEIA.',';

        if($request->has('divisao_tes'))       
            $divisoes .= Divisao::$TES.',';

        if($request->has('divisao_tex'))
            $divisoes .= Divisao::$TEX.',';

        if($request->has('divisao_cla'))
            $divisoes .= Divisao::$CLA.',';

        if($divisoes == '')
            return redirect()->to('jogos')->withInput()->withErrors(['Insere pelo menos uma divisão!']);

        $jogo->divisoes = $divisoes;
        $jogo->save();

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
        $jogo = Jogo::find($id);
        return view('organization.jogos.show',array('jogo' => $jogo));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$id)
    {
        $jogo = Jogo::find($id);
        return view('organization.jogos.edit',array('jogo' => $jogo));
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
        $jogo = Jogo::find($id);

        $divisoes = '';

        if($request->has('divisao_alcateia'))
            $divisoes .= Divisao::$ALCATEIA.',';

        if($request->has('divisao_tes'))       
            $divisoes .= Divisao::$TES.',';

        if($request->has('divisao_tex'))
            $divisoes .= Divisao::$TEX.',';

        if($requst->has('divisao_cla'))
            $divisoes .= Divisao::$CLA.',';

        $jogo->divisoes = $divisoes;
        $jogo->update($request->all());

        return redirect()->route('organization.jogos.show',array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        Jogo::find($id)->delete();
        return redirect()->back();
    }

    public function search($slug, Request $request){
        $jogos = DB::table('recursos_jogos');

        $jogos->where('organization_id',Auth::user()->organization_id);

        if($request->has('n_participantes_min'))
            $jogos->where('n_participantes','>=',$request->get('n_participantes_min'));

        if($request->has('n_participantes_max'))
            $jogos->where('n_participantes','<=',$request->get('n_participantes_max'));

        if($request->has('duracao_min'))
            $jogos->where('duracao','>=',$request->get('duracao_min'));

        if($request->has('duracao_max'))
            $jogos->where('duracao','<=',$request->get('duracao_max'));

        if($request->has('divisao_alcateia'))
            $jogos->where('divisoes','LIKE','%'.DIVISAO::$ALCATEIA.'%');

        if($request->has('divisao_tes'))
            $jogos->where('divisoes','LIKE','%'.DIVISAO::$TES.'%');

        if($request->has('divisao_tex'))
            $jogos->where('divisoes','LIKE','%'.DIVISAO::$TEX.'%');

        if($request->has('divisao_cla')){
            $jogos->where('divisoes','LIKE','%'.DIVISAO::$CLA.'%');
        }
        
        $jogos = $jogos->get();

        return view('organization.pages.jogos',array('jogos' => $jogos))->withInput($request->all());
    }
}
