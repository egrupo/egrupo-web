<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\MyBaseController;

use App\Models\Divisao;
use App\Models\Escoteiro;
use App\Models\OS;
use App\Models\Desafio;
use App\Models\Atividade;

use App\Models\Material\Categoria;
use App\Models\Material\Material;
use App\Models\Material\LocalArrumo;

use Auth;
use DB;

use App\Generator\ProgressoFileGenerator;

class DivisoesController extends MyBaseController {

    public function showDivisao($slug,$label){

        $divisao = Divisao::where('label',$label)->pluck('id');

        return view('organization.pages.divisao',array('divisao' => $divisao));
    }

    public function showEscoteiros($slug, $label){
        $divisao = Divisao::where('label',$label)->pluck('id');

        if(!$divisao)
            return 'not found';

        $escoteiros = Escoteiro::where('divisao',$divisao)
                        ->where('organization_id',Auth::user()->organization_id)
                        ->orderBy('patrulha')->get();

        return view('organization.escoteiros.index', array('escoteiros' => $escoteiros ,
                                                        'label' => $label,
                                                        'divisao' => $divisao ));
    }

    public function showDesafios($slug,$label){
        $id = Divisao::where('label',$label)->pluck('id');

        $caderno1 = Desafio::where('divisao',$id)->where('etapa',1)->get();
        $caderno2 = Desafio::where('divisao',$id)->where('etapa',2)->get();
        $caderno3 = Desafio::where('divisao',$id)->where('etapa',3)->get();

        $especialidade = DB::table('data_especialidades')
                        ->where('divisao','=',$id)
                        ->get();

        return view('organization.pages.cadernos',array('id' => $id , 'caderno1' => $caderno1,
                                                                'caderno2' => $caderno2,
                                                                'caderno3' => $caderno3,
                                                                'especialidades' => $especialidade ));
    }

    public function showOSTodas($slug, $label){

        $divisao = Divisao::where('label',$label)->pluck('id');
        return view('organization.os.os_todas',array('label' => $label,
                                                     'anos' => OS::getYears(),
                                                     'divisao' => $divisao ));
    }

    public function showAtividades($slug,$label,$ano = null){
        if($ano == null)
            $ano = Atividade::getCurrentYear();

        $divisao = Divisao::where('label',$label)->pluck('id');

        return view('organization.atividades.index',array('atividades' => Atividade::getAtividades($label,$ano),
                                                     'label' => $label,
                                                     'ano' => $ano,
                                                     'divisao' => $divisao));
    }

    public function showMaterial($slug,$label){

        $divisao = Divisao::getId($label);

        $locais = LocalArrumo::where('organization_id',Auth::user()->organization_id)
                ->where('divisao',$divisao)
                ->get();

        $short = sizeOf($locais) == 0 && Material::where('organization_id', Auth::user()->organization_id)
                                                    ->where('divisao',$divisao)
                                                    ->count() == 0;

        return view('organization.pages.material',array(
            'label' => $label,
            'divisao' => $divisao,
            'locais' => $locais,
            'short_view' => $short,
            ));
    }

    public function showAtividadesTodas($slug,$label){

        return view('organization.atividades.atividades_todas',array('label' => $label,
                                                     'anos' => Atividade::getYears() ));
    }

    public function showPad($label){

    }

    public function progresso($slug,$divisao){
        $name = ProgressoFileGenerator::geraFile($divisao);

         $header = array(
                'Content-Type: application/octet-stream'
            );

        return response()->download($name,$name,$header)->deleteFileAfterSend(true);
    }
}
