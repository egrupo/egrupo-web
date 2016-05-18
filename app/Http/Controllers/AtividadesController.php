<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Atividade;
use App\Models\Escoteiro;
use App\Models\Divisao;
use App\Models\Presenca;
use App\Models\RegistoAtividade;
use App\User;

use DB;
use Auth;

class AtividadesController extends Controller
{

    protected $atividade;
    
    public function __construct(Atividade $atividade){
        $this->middleware('auth.organization');
        $this->atividade = $atividade;
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
        $this->atividade->fill($request->all());

        $this->atividade->organization_id = Auth::user()->organization_id;

        if( ! $this->atividade->isValid() ){
            return redirect()->back()->withInput()->withErrors($this->atividade->errors);
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

        $this->atividade->ano = $ano;
        $this->atividade->trimestre = $trimestre;
        $this->atividade->save();

        return redirect()->route('atividades.show',[mySlug() , $this->atividade->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug,$id)
    {
        $atividade = Atividade::where('id',$id)
                    ->where('organization_id',Auth::user()->organization_id)
                    ->first();

        return redirect()->route('atividades.show.divisao',[mySlug(),$id,$atividade->divisao]);
    }

    public function showDivisao($slug,$id,$divisao){
        $atividade = Atividade::where('id',$id)
                    ->where('organization_id',Auth::user()->organization_id)
                    ->first();

        $alterar = DB::table('escoteiros')
                        ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
                        ->where('presencas.atividade_id','=',$atividade->id)
                        ->select('presencas.tipo','escoteiros.nome','escoteiros.id');

        $user_ids = $alterar->lists('id');

        $marcar = null;

        if(sizeof($user_ids) == 0){
            $marcar = Escoteiro::grupo();

            if($divisao == Divisao::$GRUPO){
                $marcar = $marcar->where(function($query) {
                            $query->where('divisao',Divisao::$ALCATEIA)
                                    ->orWhere('divisao',Divisao::$TES)
                                    ->orWhere('divisao',Divisao::$TEX)
                                    ->orWhere('divisao',Divisao::$CLA)
                                    ->orWhere('divisao',Divisao::$CHEFIA);
                        });
            } else {
                $marcar = $marcar->where('divisao','=',$divisao);
            }

            $marcar = $marcar->get();
        } else {
            $marcar = Escoteiro::grupo();

            if($divisao == Divisao::$GRUPO){
                $marcar = $marcar->where(function($query) {
                                        $query->where('divisao',Divisao::$ALCATEIA)
                                                ->orWhere('divisao',Divisao::$TES)
                                                ->orWhere('divisao',Divisao::$TEX)
                                                ->orWhere('divisao',Divisao::$CLA)
                                                ->orWhere('divisao',Divisao::$CHEFIA);
                                    });
            } else {
                $marcar = $marcar->where('divisao','=',$divisao);
            }

            $marcar = $marcar->whereNotIn('id',$user_ids)->get();
        }

        return view('organization.atividades.show',array('atividade' => $atividade, 
                                                    'alterar' => $alterar->get(),
                                                    'marcar' => $marcar,
                                                    'presencas_divisao' => $divisao));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$id)
    {
        if(Auth::user()->level > User::$CAMINHEIRO)
            return 'Não tens permissão!';
        
        $atividade = Atividade::find($id);

        $escoteiros = DB::table('escoteiros')
            ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
            ->where('escoteiros.divisao','=',$atividade->divisao)
            ->select('escoteiros.nome','escoteiros.id')->get();

        if(!$atividade)
            return 'nao ha esta atividade '.$id;

        return view('organization.atividades.edit')->with('atividade',$atividade);
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

        return redirect()->route('atividades.show',array(mySlug(),$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        DB::table('presencas')->where('atividade_id','=',$id)->delete();
        Atividade::find($id)->delete();
    
        return redirect()->route('divisoes.atividades',array(mySlug(),Divisao::getLabel(Auth::user()->divisao)));
    }



    public function showAlterarPresencas($slug,$id){
        $atividade = Atividade::find($id);

        $escoteiros = DB::table('escoteiros')
            ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
            ->where('escoteiros.organization_id',Auth::user()->organization_id)
            ->where('presencas.atividade_id','=',$atividade->id)
            ->select('presencas.tipo','escoteiros.nome','escoteiros.id')->get();

        return view('organization.atividades.marcar',array('atividade' => $atividade,
                                                    'escoteiros' => $escoteiros,
                                                    'marcar' => false,
                                                    'presencas_divisao' => 0 ));
    }

    public function showMarcarPresencas($slug,$id,$divisao){
        $atividade = Atividade::find($id);

        $alterar = DB::table('escoteiros')
                    ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
                    ->where('escoteiros.organization_id',Auth::user()->organization_id)
                    ->where('presencas.atividade_id','=',$atividade->id)
                    ->select('presencas.tipo','escoteiros.nome','escoteiros.id');

        $user_ids = $alterar->lists('id');

        $escoteiros = null;

        if(sizeof($user_ids) == 0){
            
            if($divisao == Divisao::$GRUPO){
                $escoteiros = Escoteiro::grupo()
                                ->where(function($query) {
                                    $query->where('divisao',Divisao::$ALCATEIA)
                                            ->orWhere('divisao',Divisao::$TES)
                                            ->orWhere('divisao',Divisao::$TEX)
                                            ->orWhere('divisao',Divisao::$CLA)
                                            ->orWhere('divisao',Divisao::$CHEFIA);
                                })
                                ->get();
            } else {
                $escoteiros = Escoteiro::grupo()->where('divisao','=',$divisao)->get();
            }
            
        } else {

            if($divisao == Divisao::$GRUPO){
                $escoteiros = Escoteiro::grupo()
                    ->whereNotIn('id',$user_ids)
                    ->where(function($query) {
                        $query->where('divisao',Divisao::$ALCATEIA)
                                ->orWhere('divisao',Divisao::$TES)
                                ->orWhere('divisao',Divisao::$TEX)
                                ->orWhere('divisao',Divisao::$CLA)
                                ->orWhere('divisao',Divisao::$CHEFIA);
                    })
                    ->get();
            } else {
                $escoteiros = Escoteiro::grupo()->where('divisao','=',$divisao)->whereNotIn('id',$user_ids)->get();
            }
        }

        return view('organization.atividades.marcar',array('atividade' => $atividade,
                                                    'escoteiros' => $escoteiros,
                                                    'marcar' => true,
                                                    'presencas_divisao' => $divisao ));
     }

    public function marcarPresencas($slug,$id,$divisao,Request $request){
        $tipos = $request->get('tipo');
        $escoteiros = $request->get('escoteiros');

        for($i = 0 ; $i < sizeof($tipos) ; $i++ ){
            $user_id = $escoteiros[$i];
            $tipo = $tipos[$i];

            if($tipo == Presenca::$FALTA || $tipo == PRESENCA::$PRESENTE) {
                $p = Presenca::firstOrNew(array('atividade_id' => $id,'user_id' => $user_id));
                $p->tipo = $tipo;
                $p->save();
            } else {
                Presenca::where('atividade_id',$id)->where('user_id',$user_id)->delete();
            }
        }

        return redirect()->route('atividades.show',array(mySlug(),$id));
    }

    public function guardarRegistoAtividade(Request $request,$slug,$id){

        $escoteiro_id = Auth::user()->id;
        $descricao = $request->get('descricao');

        $r = RegistoAtividade::where('escoteiro_id',$escoteiro_id)
                                ->where('organization_id',Auth::user()->organization_id)
                                ->where('atividade_id',$id)->first();

        if($r){
            $r->descricao = $descricao;
            $r->save();
        } else {
            RegistoAtividade::create(['escoteiro_id' => $escoteiro_id, 'organization_id' => Auth::user()->organization_id,'atividade_id' => $id , 'descricao' => $descricao]); 
        }

        $messages[] = 'Guardado com sucesso';

        return redirect()->route('atividades.show',array(mySlug(),$id))->with('messages',$messages);
    }

}
