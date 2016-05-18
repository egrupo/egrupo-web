<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Authorizer;
use App\Models\Atividade;
use App\Models\Escoteiro;
use App\Models\Divisao;
use App\Models\Aviso;
use App\User;
use DB;
use DateTime;
use Response;

class DivisoesMobileController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function avisos($slug,$divisao_id){

        $user = User::find(Authorizer::getResourceOwnerId());

        $avisos_atividades = DB::table('atividades')
            ->leftJoin('presencas','presencas.atividade_id','=','atividades.id')
            ->where('presencas.id',null)
            ->where('atividades.organization_id',$user->organization_id)
            ->where('atividades.performed_at','<=',new DateTime('today'))
            ->where(function($query) use ($divisao_id){
                $query->where('atividades.divisao',$divisao_id)
                        ->orWhere('atividades.divisao',Divisao::$GRUPO);
            })
            ->count();

        $lembretes = DB::table('lembretes')
            ->where('divisao',$divisao_id)
            ->where('organization_id',$user->organization_id)
            ->where('remindme_at','<=',new DateTime('today'))
            ->get();

        $prox_atividade = Atividade::where(function($query) use ($divisao_id){
                                            $query->where('divisao',$divisao_id)
                                                    ->orWhere('divisao',Divisao::$GRUPO);
                                        })
                                        ->where('organization_id',$user->organization_id)
                                        ->where('performed_at','>=',new DateTime('today'))
                                        ->orderBy('performed_at')->first();

        $response['n_avisos_atividades'] = $avisos_atividades;
        $response['lembretes'] = $lembretes;
        $response['proxima_atividade'] = $prox_atividade;

        return Response::json($response);
    }

    public function escoteiros($slug,$divisao_id){
        $user = User::find(Authorizer::getResourceOwnerId());

        return Escoteiro::where('organization_id',$user->organization_id)
                ->where('divisao',$divisao_id)
                ->get();
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
}
