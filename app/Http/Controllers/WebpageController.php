<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Jogo;
use App\Models\Escoteiro;
use App\Models\Atividade;
use App\Models\Aviso;
use App\Models\Divisao;
use Auth;
use DB;
use DateTime;
use App\User;
use PHPExcel;
use PHPExcel_IOFactory;
use Response;
use Mail;
use File;

class WebpageController extends MyBaseController {

    public function showBlogPage(){
        // return View::make('layouts.blogpost');
    }

    public function showDashboard(){

        if(Auth::user()->level == 4){

            $escoteiro = Escoteiro::find(Escoteiro::getRealId(Auth::user()->escoteiro_id));

            // $id = Auth::user()->getEscoteiroId();
            // $escoteiro = Escoteiro::where('id',$id)->first();
            // dd($escoteiro);

            $div = $escoteiro->divisao;
            //proxima atividade
            $prox_atividade = Atividade::where(function($query) use ($div){
                                            $query->where('divisao',$div)
                                                    ->orWhere('divisao',Divisao::$GRUPO);
                                        })
                                        ->where('organization_id',Auth::user()->organization_id)
                                        ->where('performed_at','>=',new DateTime('today'))
                                        ->orderBy('performed_at')->first();


            //avisos escoteiro
            $avisos_escoteiro = Aviso::where('tipo',Aviso::$INDIVIDUAL)
                                        ->where('target_id',$escoteiro->id)
                                        ->where('organization_id',Auth::user()->organization_id)
                                        ->get();

            //avisos TEx
            $avisos_divisao = Aviso::where('tipo',Aviso::$GRUPO)
                                    ->where('target_id',$escoteiro->divisao)
                                    ->where('organization_id',Auth::user()->organization_id)
                                    ->get();

            $h = date('G');

            $greeting = 'Boa tarde';

            if($h > 6 && $h < 12)
                $greeting = 'Bom dia';
            else if($h >= 20)
                $greeting = 'Boa noite';

            return view('organization.pages.escoteiros.dashboard',array('escoteiro' => $escoteiro,
                                                                    'greeting' => $greeting,
                                                                    'prox_atividade' => $prox_atividade,
                                                                    'avisos_escoteiro' => $avisos_escoteiro,
                                                                    'avisos_divisao' => $avisos_divisao));
        }

        if(Auth::user()->level == 5){
            return view('layouts.pais.dashboard');
        }

        $avisos_atividades = DB::table('atividades')
                                    ->leftJoin('presencas','presencas.atividade_id','=','atividades.id')
                                    ->where('presencas.id',null)
                                    ->where('atividades.organization_id',Auth::user()->organization_id)
                                    ->where('atividades.performed_at','<=',new DateTime('today'))
                                    ->where(function($query){
                                        $query->where('atividades.divisao',Auth::user()->divisao)
                                                ->orWhere('atividades.divisao',Divisao::$GRUPO);
                                    })
                                    ->count();

        $cardinal[0] = Escoteiro::where('organization_id',Auth::user()->organization_id)->where('divisao','=',User::$ALCATEIA)->count();
        $cardinal[1] = Escoteiro::where('organization_id',Auth::user()->organization_id)->where('divisao','=',User::$TES)->count();
        $cardinal[2] = Escoteiro::where('organization_id',Auth::user()->organization_id)->where('divisao','=',User::$TEX)->count();
        $cardinal[3] = Escoteiro::where('organization_id',Auth::user()->organization_id)->where('divisao','=',User::$CLA)->count();
        $cardinal[4] = Escoteiro::where('organization_id',Auth::user()->organization_id)->where('divisao','=',User::$CHEFIA)->count();

        $avisos_lembretes = DB::table('lembretes')
                                ->where('divisao',Auth::user()->divisao)
                                ->where('organization_id',Auth::user()->organization_id)
                                ->where('remindme_at','<=',new DateTime('today'))
                                ->count();

        $avisos_n_escoteiros = Escoteiro::grupo()->count() == 0;
        $avisos_n_atividades = Atividade::grupo()->count() == 0;

        return view('organization.pages.dashboard',array('warn_atividades' => $avisos_atividades,
                                                    'warn_lembretes' => $avisos_lembretes,
                                                    'warn_n_escoteiros' => $avisos_n_escoteiros,
                                                    'warn_n_atividades' => $avisos_n_atividades,
                                                        'num_elems' => $cardinal )); 

    }

    public function showDesafios(){
        return redirect()->action('DivisoesController@showDesafios',array(mySlug(),'Alcateia'));
    }

    public function showJogos(){
        return view('organization.pages.jogos',array('input' => null,'jogos' => Jogo::all()));
    }

    public function showPNEC(){
        return view('organization.pnec.pnec');
    }

    public function showCartaoEscoteiro(){
        return view('organization.cartaoescoteiro.cartaoescoteiro');
    }

    public function showAdmin(){
        return view('organization.pages.admin');
    }

    public function showObjetivos(){
        return view('organization.pages.objetivos');
    }

    public function searchPerson($slug,Request $request){

        $term = $request->get('term');

        $escoteiros = Escoteiro::grupo()
                        ->where('organization_id',Auth::user()->organization_id)
                        ->where(function($query) use ($term){
                            $query->where('nome','LIKE','%'.$term.'%');
                            $query->orWhere('totem','LIKE','%'.$term.'%');
                            $query->orWhere('id_associativo','LIKE','%'.$term.'%');
                            $query->orWhere('patrulha','LIKE','%'.$term.'%');
                        })
                        ->orderBy('id_associativo')
                        ->get();

        return view('organization.pages.search',array('term' => $term , 'escoteiros' => $escoteiros));
    }

    public function showOS($slug){
        return view('organization.pages.os');
    }

    public function showPNECR(Request $request){
        $ids = $request->get('id');

        if(empty($ids)){
            return '';
        } else {
            $escoteiros = Escoteiro::whereIn('id_associativo',$ids)->get();
        }

        $name = 'Lista_Nominal_AEP_'.mySlug().'.xls';

        $this->gerarListaNominal($request,$escoteiros,$name);

        $messages = array();

        if($request->get('enviaremail')){

            $email = $request->get('email');

            $vars = array(
                        'intro' => $request->get('intro')
                    );

                Mail::send('mail.lista_nominal',$vars,function($message) use ($name,$email){
                    $message->from('hello.egrupo@gmail.com',mySlug());
                    $message->subject('Lista Nominal PNEC');
                    $message->to($email);
                    $message->attach($name);
                });

            $messages = array('Mail enviado para '.$email);   
            File::delete($name);
            return redirect()->back()->with('messages',$messages);
        } else {
            $header = array(
                    'Content-Type: application/octet-stream'
                );

            return response()->download($name,$name,$header)->deleteFileAfterSend(true);
        }
    }

    public function showCartaoEscoteiroR(Request $request){
        $ids = $request->get('id');
        $cartoes = $request->get('cartao');

        if(empty($ids)){
            return back()->withInput();
        } else {
            $escoteiros = Escoteiro::whereIn('id_associativo',$ids)->get();
        }

        $name = 'Pedido_Cartao_Escoteiro.xls';
        $this->gerarListaCartaoEscoteiro($escoteiros,$name,$cartoes);

        $messages = array();

        if($request->get('enviaremail')){

            $email = $request->get('email');

            $vars = array(
                        'intro' => $request->get('intro')
                    );

                Mail::send('mail.cartao_escoteiro',$vars,function($message) use ($name,$email){
                    $message->from('hello.egrupo@gmail.com',mySlug());
                    $message->subject('Pedido Cartão de Escoteiro');
                    $message->to($email);
                    $message->attach($name);
                });

            $messages = array('Mail enviado para '.$email);
            File::delete($name);
            return redirect()->back()->with('messages',$messages);
        } else {
            $header = array(
                    'Content-Type: application/octet-stream'
                );

            return response()->download($name,$name,$header)->deleteFileAfterSend(true);
        }
    }

    public function gerarListaCartaoEscoteiro($escoteiros,$name,$cartoes){
        $excel = new PHPExcel();
        $excel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('1:1')->getFont()->setSize(13);

        $excel->setActiveSheetIndex(0)
                ->setCellValue('A1','NOME COMPLETO')
                ->setCellValue('B1','COMPROMISSO DE HONRA')
                ->setCellValue('C1','1º CARTÃO')
                ->setCellValue('D1','NÚMERO ASSOCIATIVO');

        $i = 1;
        foreach($escoteiros as $escoteiro){
            $i++;

            $excel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,$escoteiro->nome_completo)
                    ->setCellValue('B'.$i,$escoteiro->compromisso_honra)
                    ->setCellValue('C'.$i,in_array($escoteiro->id,$cartoes) ? 'SIM' : 'NÃO')
                    ->setCellValue('D'.$i,$escoteiro->id_associativo);
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        ob_clean();
        $writer->save($name);
    }
    
    public function gerarListaNominal($request,$escoteiros,$name){

        $excel = PHPExcel_IOFactory::createReader('Excel5');
        $excel = $excel->load('Lista_Nominal_PNEC.xls');

        $excel->setActiveSheetIndex(0)
                ->setCellValue('C8',$request->get('entidade'))//Entidade
                ->setCellValue('C9',$request->get('grupo'))//Grupo
                ->setCellValue('C10',$request->get('regiao'))//Região
                ->setCellValue('C11',$request->get('contacto'))//Contacto
                ->setCellValue('C13',$request->get('nome'))//Nome
                ->setCellValue('C14',$request->get('cargo'))//Cargo
                ->setCellValue('C15',$request->get('nassociativo'))//N Associativo
                ->setCellValue('C16',$request->get('telemovel'))//Telemovel
                ->setCellValue('C18',$request->get('data_inicio'))//Data Inicio
                ->setCellValue('C19',$request->get('data_fim'));//Data Fim

        $i = 22;
        $currentPage = 0;
        foreach($escoteiros as $escoteiro){
            $i++;

            if($i == 53 && $currentPage == 0){
                $i = 61;
            }

            if($i == 106 && $currentPage == 0){
                $i = 8;
                $currentPage = 1;
            }

            if($i == 52 && $currentPage == 1){
                $i = 60;
            }
            
            $excel->setActiveSheetIndex($currentPage)
                    ->setCellValue('B'.$i,$escoteiro->id_associativo)
                    ->setCellValue('C'.$i,$escoteiro->nome_completo)
                    ->setCellValue('D'.$i,Divisao::getLabel($escoteiro->divisao));
        }

        $writer = PHPExcel_IOFactory::createWriter($excel,'Excel5');
        ob_clean();
        $writer->save($name);
    }
}
