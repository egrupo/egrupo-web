<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Escoteiro;
use App\Models\ProvaEtapa;
use App\Models\Etapa;
use App\Models\Divisao;
use App\User;
use Authorizer;

use Response;

use Storage;
use Image;

class EscoteirosMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Authorizer::getResourceOwnerId());

        return Escoteiro::
                where('organization_id',$user->organization_id)
                ->where(function($query) {
                    $query->where('divisao',Divisao::$ALCATEIA)
                    ->orWhere('divisao',Divisao::$TES)
                    ->orWhere('divisao',Divisao::$TEX)
                    ->orWhere('divisao',Divisao::$CLA)
                    ->orWhere('divisao',Divisao::$CHEFIA);
                })
                ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        $user = User::find(Authorizer::getResourceOwnerId());

        $escoteiro = new Escoteiro;
        $escoteiro->fill(['nome' => $request->get('nome'),
                        'divisao' => $request->get('divisao'),
                        'id_associativo' => $request->get('id_associativo')
                        ]);

        $escoteiro->organization_id = $user->organization_id;

        if( ! $escoteiro->isValid() ){
            return Response::json(array('code' => 400, 'message' => 'Escoteiro inválido'),400);
        }

        $escoteiro->save();

        return $this->escoteiros($slug,$escoteiro->divisao);
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
    public function update($slug,$id,Request $request)
    {
        $escoteiro = Escoteiro::find($id);
        $escoteiro->update($request->all());
        return $escoteiro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProgresso($slug,$id){

        $escoteiro = Escoteiro::find($id);

        $e1 = ProvaEtapa::where('escoteiro_id',$id)
                        ->where('divisao',$escoteiro->divisao)
                        ->where('etapa',1)->get();

        $e2 = ProvaEtapa::where('escoteiro_id',$id)
                        ->where('divisao',$escoteiro->divisao)
                        ->where('etapa',2)->get();

        $e3 = ProvaEtapa::where('escoteiro_id',$id)
                        ->where('divisao',$escoteiro->divisao)
                        ->where('etapa',3)->get();

        $r1 = array(
            'divisao' => $escoteiro->divisao,
            'etapa' => 1,
            'total' => Etapa::getNProvas(1,$escoteiro->divisao),
            'provas' => $e1,
            );

        $r2 = array(
            'divisao' => $escoteiro->divisao,
            'etapa' => 2,
            'total' => Etapa::getNProvas(2,$escoteiro->divisao),
            'provas' => $e2,
            );

        $r3 = array(
            'divisao' => $escoteiro->divisao,
            'etapa' => 3,
            'total' => Etapa::getNProvas(3,$escoteiro->divisao),
            'provas' => $e3,
            );

        return Response::json(array($r1,$r2,$r3));
    }

    public function postProgresso($slug,$id,Request $request){
        $escoteiro = Escoteiro::find($id);

        if(!$escoteiro){
            return Response::json(array('code' => 404, 'message' => 'Este escoteiro não existe'),404);
        }

        $etapa = $request->get('etapa');
        $divisao = $request->get('divisao');
        $concluded_at = $request->get('concluded_at');
        $provas = $request->get('desafios');

        if($provas != null){
            $inds = explode(',',$provas);
            for($i = 0 ; $i < count($inds) ; $i++){
                $prova = $inds[$i];

                $p = ProvaEtapa::firstOrNew(array('prova' => $prova,'escoteiro_id' => $id,'etapa' => $etapa,'divisao' => $divisao));
                if(!$p->exists){
                    $p->concluded_at = $request->get('concluded_at');
                }
                $p->save();
            }
        }

        $provasRemover = $request->get('desafios_remover');
        if($provasRemover != null){
            $inds = explode(',',$provasRemover);
            for($i = 0 ; $i < count($inds) ; $i++){
                $prova = $inds[$i];

                $p = ProvaEtapa::firstOrNew(array('prova' => $prova,'escoteiro_id' => $id,'etapa' => $etapa,'divisao' => $divisao));
                if($p->exists){
                   $p->delete(); 
                }
            }
        }

        return $this->getProgresso($slug,$id);
    }

    public function getAvatar($slug,$name,Request $request){

        $escoteiro = Escoteiro::find($name);

        $w = $request->get('w');
        $h = $request->get('h');

        $image = null;

        if($escoteiro->avatar_url){
            $image = Image::make(storage_path().'/app/'.$slug.'/avatars/'.$name.'.jpg'); 
        } else {
            $image = Image::make('images/default_pic.png');
        }

        if($w == null && $h == null){
            $w = 500;
            $h = 500;
        }

        $image->fit($w,$h);

        return $image->response();
    }

    public function escoteiros($slug,$divisao_id){
        $user = User::find(Authorizer::getResourceOwnerId());

        return Escoteiro::where('organization_id',$user->organization_id)
                ->where('divisao',$divisao_id)
                ->get();
    }

}
