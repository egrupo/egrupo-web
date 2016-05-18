<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Atividade;
use App\Models\Presenca;
use App\User;
use App\Models\Divisao;
use Authorizer;
use Response;
use DB;

class AtividadesMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Authorizer::getResourceOwnerId());

        return Atividade::
                where('organization_id',$user->organization_id)
                ->where('ano',Atividade::getCurrentYear())
                ->orderBy('performed_at','DESC')
                ->get();
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
    public function store($slug,Request $request)
    {
        $user = User::find(Authorizer::getResourceOwnerId());

        $atividade = new Atividade;
        $atividade->fill(['nome' => $request->get('nome'),
                        'divisao' => $request->get('divisao'),
                        'performed_at' => $request->get('performed_at')
                        ]);

        $atividade->organization_id = $user->organization_id;

        if( ! $atividade->isValid() ){
            return Response::json(array('code' => 400, 'message' => 'Atividade inválida'),400);
        }

        $month = date('n',strtotime($request->get('performed_at')));
        $year = date('Y',strtoTime($request->get('performed_at')));

        $trimestre = 0;
        $ano = '';

        if($month > 0 && $month <= 3){
            $trimestre = 2;
        } else if($month > 3 && $month <= 8){
            $trimestre = 3;
        } else {
            $trimestre = 1; 
        }

        if($trimestre == 1){
            $ano = $year.'-'.($year+1);
        } else {
            $ano = ($year-1).'-'.$year;
        }

        $atividade->ano = $ano;
        $atividade->trimestre = $trimestre;
        $atividade->save();

        return $this->atividades($slug,$atividade->divisao);
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
        $atividade = Atividade::find($id);

        if($request->get('performed_at') != ''){
            $month = date('n',strtotime($request->get('performed_at')));
            $year = date('Y',strtoTime($request->get('performed_at')));

            $trimestre = 0;
            $ano = '';

            if($month > 0 && $month <= 3){
                $trimestre = 2;
            } else if($month > 3 && $month <= 8){
                $trimestre = 3;
            } else {
                $trimestre = 1; 
            }

            if($trimestre == 1){
                $ano = $year.'-'.($year+1);
            } else {
                $ano = ($year-1).'-'.$year;
            }

            $atividade->ano = $ano;
            $atividade->trimestre = $trimestre;
        }
        
        $atividade->update($request->all());

        return $atividade;
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

    public function atividades($slug,$divisao_id){
        $user = User::find(Authorizer::getResourceOwnerId());

        return Atividade::
                where('organization_id',$user->organization_id)
                ->where(function($query) use ($divisao_id){
                    $query->where('divisao',$divisao_id)
                        ->orWhere('divisao',Divisao::$GRUPO);
                })
                ->where('ano',Atividade::getCurrentYear())
                ->orderBy('performed_at','DESC')
                ->get();
    }

    public function getPresencas($slug,$id){
        return Presenca::where('atividade_id',$id)
            ->with(['escoteiro'])
            ->get();
    }

    public function postPresencas($slug,$id,Request $request){
        
        $presencas = $request->get('presencas');
        if($presencas != null){
            $ids = explode(',',$presencas);

            for($i = 0 ; $i < count($ids) ; $i++ ){
                $p = Presenca::firstOrNew(array('atividade_id' => $id,'user_id' => $ids[$i]));
                $p->tipo = Presenca::$PRESENTE;
                $p->save();
            }
        }

        $faltas = $request->get('faltas');
        if($faltas != null){
            $ids = explode(',',$faltas);

            for($i = 0 ; $i < count($ids) ; $i++ ){
                $p = Presenca::firstOrNew(array('atividade_id' => $id,'user_id' => $ids[$i]));
                $p->tipo = Presenca::$FALTA;
                $p->save();
            }   
        }

        $remover = $request->get('remover');
        if($remover != null){
            $ids = explode(',',$remover);

            for($i = 0 ; $i < count($ids) ; $i++ ){
                $p = Presenca::where('atividade_id',$id)
                            ->where('user_id',$ids[$i])->first();

                if($p){
                    $p->delete();
                }
            }   
        }

        return $this->getPresencas($slug,$id);
    }
}
