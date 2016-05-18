<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use Storage;
use App\Models\OS;
use App\Models\Atividade;
use App\User;
use App\Models\Divisao;
use App\Models\Escoteiro;
use App\Models\Presenca;

class OSController extends Controller
{

    public static $TABLE_HEIGHT = 300;

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
        return view('organization.os.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        $os = new OS;

        $os->fill($request->all());

        if($os->escoteiro_id == 0)
            $os->type = 0;

        if( ! $os->isActivityValid() ){
            return redirect()->back()->withErrors('Não existe uma atividade associada à data que preencheste: '.$os->data);
        }

        if( ! $os->isValid() ){
            return redirect()->back()->withInput()->withErrors($os->messages);
        }

        $month = date('n',strtotime($request->get('data')));
        $year = date('Y',strtoTime($request->get('data')));

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

        $os->ano = $ano;
        $os->trimestre = $trimestre;
        $os->organization_id = Auth::user()->organization_id;
        $os->save();

        return redirect()->back();
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
    public function destroy($slug,$id)
    {
        OS::find($id)->delete();
        return redirect()->back();
    }

    public function destroyOSFile($slug,$name){
        Storage::disk('local')->delete(mySlug().'/os/'.$name);
        return redirect()->back();
    }

    public function downloadOS($slug,Request $request,$name){
        $path = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().mySlug().'/os/'.$name;
        $header = array(
            'Content-Type: application/octet-stream'
        );

        return response()->download($path,$name,$header);
    }

    public function gerarOS($slug,Request $request){

        $trimestre = $request->get('trimestre');
        $ano = $request->get('ano');

        $objPHPWord = new \PhpOffice\PhpWord\PhpWord();

        /* Styles */
        $numberStyleList = array('format' => 'decimal', 'left' => 0, 'hanging' => 0 , 'tabPos' => 0);

        $smallFontStyle = array('name' => 'Arial', 'size' => 8);
        $normalFontStyle = array('name' => 'Arial', 'size' => 11);
        $listItemFontStyle = array('name' => 'Arial', 'size' => 14, 'bold' => true);
        $listSubItemFontStyle = array('name' => 'Arial', 'size' => 12, 'bold' => true);
        $boldStyle = array('bold' => true);
        $tBoldStyle = array('bold' => true);

        $centerParagraph = array('align' => 'center');

        $smallUnderlineFontStyle = array('name' => 'Arial', 'size' => 8, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE);
        $smallBoldFontStyle = array('name' => 'Arial', 'size' => 8 , 'bold' => true);
        $smallFontStyle = array('name' => 'Arial', 'size' => 8);
        $introTextStyle = array('name' => 'Arial' , 'size' => 24 ,'bold' => true);

        $hAlign = array('align' => 'center');
        $vAlign = array('valign' => 'center');

        $objPHPWord->addNumberingStyle(
            'multilevel',
            array(
                'type'   => 'multilevel',
                'levels' => array(
                    array('pStyle' => 'Heading1' ,'format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                ),
            )
        );

        $objPHPWord->addFontStyle('text',$smallFontStyle);
        $objPHPWord->addFontStyle('small_underline',$smallUnderlineFontStyle);
        $objPHPWord->addFontStyle('small_bold',$smallBoldFontStyle);
        $objPHPWord->addFontStyle('small',$smallFontStyle);
        $objPHPWord->addFontStyle('normal',$normalFontStyle);
        $objPHPWord->addFontStyle('title',$listItemFontStyle);
        $objPHPWord->addFontStyle('subtitle',$listSubItemFontStyle);
        $objPHPWord->addFontStyle('bold',$boldStyle);
        $objPHPWord->addTitleStyle('tbold',$tBoldStyle);
        $objPHPWord->addFontStyle('intro',$introTextStyle);
        $objPHPWord->addParagraphStyle('center',$centerParagraph);

        $tableEfetivoStyle = array('borderSize' => 2, 'cellMargin' => 20);

        /* Sections */

        $os = $objPHPWord->createSection();

        $objPHPWord->addNumberingStyle(
            'headingNumbering',
            array('type'   => 'multilevel',
                  'levels' => array(
                      array('format' => 'decimal', 'text' => '%1','suffix' => 'nothing'),
                      array('format' => 'decimal', 'text' => '%1.%2','suffix' => 'nothing')
                  ),
            )
        );
        $objPHPWord->addTitleStyle(1, array('size' => 14, 'name' => 'Arial','bold' => true), array('numStyle' => 'headingNumbering', 'numLevel' => 0));
        $objPHPWord->addTitleStyle(2, array('size' => 12, 'name' => 'Arial','bold' => true), array('numStyle' => 'headingNumbering', 'numLevel' => 1));

        /* Página 1 */
        $os->addImage('images/os/oslogo.png',array('align' => 'center','width' => 450));
        $os->addTextBreak(8);
        $os->addText(htmlspecialchars('Ordem de Serviço',ENT_COMPAT,'UTF-8'),'intro','center');
        $os->addText(htmlspecialchars($trimestre.'º Trimestre '.$ano,ENT_COMPAT,'UTF-8'),'intro','center');
        $os->addText(htmlspecialchars('Grupo '.Auth::user()->organization->number,ENT_COMPAT,'UTF-8'),'intro','center');

        $os->addPageBreak();
        /* Introdução */
        $os->addTitle(htmlspecialchars('. Introdução', ENT_COMPAT, 'UTF-8'),1);
        $os->addTextBreak();

        $os->addText($request->get('intro'));

        /* Elementos Efetivos */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Elementos Efetivos',ENT_COMPAT,'UTF-8'),1);
        $os->addTextBreak();

        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(1111,$vAlign)->addText(htmlspecialchars('Divisão', ENT_COMPAT, 'UTF-8'),'bold');
        $tbl->addCell(1321,$vAlign)->addText(htmlspecialchars('Pequeno Grupo', ENT_COMPAT, 'UTF-8'),'bold');
        $tbl->addCell(1417,$vAlign)->addText(htmlspecialchars('Cargo', ENT_COMPAT, 'UTF-8'),'bold');
        $tbl->addCell(1000,$vAlign)->addText(htmlspecialchars('Outras funções', ENT_COMPAT, 'UTF-8'),'bold');
        $tbl->addCell(1275,$vAlign)->addText(htmlspecialchars('Progresso', ENT_COMPAT, 'UTF-8'),'bold');
        $tbl->addCell(2000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold');
        $tbl->addCell(1275,$vAlign)->addText(htmlspecialchars('Totem', ENT_COMPAT, 'UTF-8'),'bold');
        $tbl->addCell(1000,$vAlign)->addText(htmlspecialchars('Nº AEP', ENT_COMPAT, 'UTF-8'),'bold');

        foreach(Escoteiro::getEfetivoOS() as $escoteiro){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(1111,$vAlign)->addText(htmlspecialchars($escoteiro->divisao, ENT_COMPAT, 'UTF-8'),'normal');
            $tbl->addCell(1321,$vAlign)->addText(htmlspecialchars($escoteiro->patrulha, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(1417,$vAlign)->addText(htmlspecialchars($escoteiro->cargo, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(1000,$vAlign)->addText(htmlspecialchars('', ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(1275,$vAlign)->addText(htmlspecialchars($escoteiro->nivel_escotista, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(2000,$vAlign)->addText(htmlspecialchars($escoteiro->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(1275,$vAlign)->addText(htmlspecialchars($escoteiro->totem, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(1000,$vAlign)->addText(htmlspecialchars($escoteiro->id_associativo, ENT_COMPAT, 'UTF-8'),'text');
        }

        /* Criar Legenda */
        $os->addTextBreak();
        $os->addTitle('Legenda','tbold');
        $peqgrupo = $os->createTextRun();
        $peqgrupo->addText('Legenda de Pequenos Grupos:','small_underline');
        $peqgrupo->addText(' Nas TEs e TEx: ','small');
        $peqgrupo->addText('Pat','small_bold');
        $peqgrupo->addText(' (Patrulha), na Alcateia ','small');
        $peqgrupo->addText('B','small_bold');
        $peqgrupo->addText(' (Bando)','small');

        $progresso = $os->createTextRun();
        $progresso->addText('Legenda Progresso:','small_underline');
        $progresso->addText(' Cam','small_bold');
        $progresso->addText(' (Caminheiro), ','small');
        $progresso->addText('CPF','small_bold');
        $progresso->addText(' (Curso Preliminar de Formação), ','small');
        $progresso->addText('CBF','small_bold');
        $progresso->addText(' (Curso básico de Formação), ','small');
        $progresso->addText('CDD','small_bold');
        $progresso->addText(' (Curso de dirigentes de Divisão), ','small'); 
        $progresso->addText('CIF','small_bold');
        $progresso->addText(' (Curso de instrutores de Formação), ','small');
        $progresso->addText('IF','small_bold');
        $progresso->addText(' (Instrutor de Formação), ','small');
        $progresso->addText('ADF','small_bold');
        $progresso->addText(' (adjunto de Director de Formação), ','small');
        $progresso->addText('DF','small_bold');
        $progresso->addText(' (Director de Formação), ','small');
        $progresso->addText('DFEst','small_bold');
        $progresso->addText(' (Estágio a decorrer)','small');

        $cargos = $os->createTextRun();
        $cargos->addText('Legenda Cargos de Chefia:','small_underline');
        $cargos->addText(' ECG','small_bold');
        $cargos->addText(' (Escoteiro-Chefe de Grupo), ','small');
        $cargos->addText('ECA','small_bold');
        $cargos->addText(' (Escoteiro Chefe de Alcateia), ','small');
        $cargos->addText('ECTEs','small_bold');
        $cargos->addText(' (Escoteiro Chefe de Tribo de Escoteiros), ','small');
        $cargos->addText('ECTEx','small_bold');
        $cargos->addText(' (Escoteiro Chefe de Tribo de Exploradores), ','small');
        $cargos->addText('ECC','small_bold');
        $cargos->addText(' (Escoteiro Chefe de Clã), ','small');
        $cargos->addText('ECSA','small_bold');
        $cargos->addText(' (Escoteiro Chefe dos Serviços Administrativos), ','small');
        $cargos->addText('ESCG','small_bold');
        $cargos->addText(' (Escoteiro Subchefe de Grupo), ','small');
        $cargos->addText('Col','small_bold');
        $cargos->addText(' (colaborador da Chefia de Grupo), ','small');
        $cargos->addText('IG','small_bold');
        $cargos->addText(' (Instrutor de Grupo), ','small');
        $cargos->addText('EH','small_bold');
        $cargos->addText(' (Escoteiro honorário)','small');

        $colab = $os->createTextRun();
        $colab->addText('Legenda de colaborações:','small_underline');
        $colab->addText(' Col Alc','small_bold');
        $colab->addText(' (Colabora na Divisão Alcateia), ','small');
        $colab->addText('Col TEs','small_bold');
        $colab->addText(' (Colabora na Divisão Tribo de Escoteiros), ','small');
        $colab->addText('Col TEx','small_bold');
        $colab->addText(' (Colabora na Divisão Tribo de Exploradores), ','small');
        $colab->addText('Col SA','small_bold');
        $colab->addText(' (Colaborador dos Serviços Administrativos)','small');

        /* Tabela de Admissões */
        $os->addPageBreak();
        $os->addTitle(htmlspecialchars('. Admissões',ENT_COMPAT,'UTF-8'),1);
        $os->addTextBreak();

        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Data', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars('Divisão', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);

        foreach(OS::getAdmissoes($ano,$trimestre) as $temp){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars($temp->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars(OS::readifyDate($temp->data), ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars($temp->label, ENT_COMPAT, 'UTF-8'),'text');
        }

        /* Demissões */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Demissões',ENT_COMPAT,'UTF-8'),1);
        $os->addTextBreak();

        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Data', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars('Divisão', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);

        foreach(OS::getDemissoes($ano,$trimestre) as $temp){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars($temp->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars(OS::readifyDate($temp->data), ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars($temp->label, ENT_COMPAT, 'UTF-8'),'text');
        }

        /* Passagens de divisão */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Passagens de Divisão',ENT_COMPAT,'UTF-8'),1);
        $os->addTextBreak();

        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Data', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars('Divisão', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);

        foreach(OS::getPassagens($ano,$trimestre) as $temp){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars($temp->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars(OS::readifyDate($temp->data), ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars($temp->label, ENT_COMPAT, 'UTF-8'),'text');
        }

        /* Progresso Escotista, Promessas e Compromissos */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Progresso Escotista, Promessas e Compromissos',ENT_COMPAT,'UTF-8'),1);
        $os->addTextBreak();

        /* Alcateia */
        $os->addTitle(htmlspecialchars('. Alcateia', ENT_COMPAT, 'UTF-8'),2);
        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Data', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars('Tipo de Progresso', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);

        foreach(OS::getProgresso(Divisao::$ALCATEIA,$ano,$trimestre) as $temp){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars($temp->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars(OS::readifyDate($temp->data), ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars($temp->label, ENT_COMPAT, 'UTF-8'),'text');
        }
        $os->addTextBreak();

        /* TEs */
        $os->addTitle(htmlspecialchars('. Tribo de Escoteiros', ENT_COMPAT, 'UTF-8'),2);
        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Data', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars('Tipo de Progresso', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);

        foreach(OS::getProgresso(Divisao::$TES,$ano,$trimestre) as $temp){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars($temp->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars(OS::readifyDate($temp->data), ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars($temp->label, ENT_COMPAT, 'UTF-8'),'text');
        }
        $os->addTextBreak();

        /* TEx */
        $os->addTitle(htmlspecialchars('. Tribo de Exploradores', ENT_COMPAT, 'UTF-8'),2);
        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Data', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars('Tipo de Progresso', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);

        foreach(OS::getProgresso(Divisao::$TEX,$ano,$trimestre) as $temp){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars($temp->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars(OS::readifyDate($temp->data), ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars($temp->label, ENT_COMPAT, 'UTF-8'),'text');
        }
        $os->addTextBreak();

        /* Cla */
        $os->addTitle(htmlspecialchars('. Clã', ENT_COMPAT, 'UTF-8'),2);
        $tbl = $os->addTable($tableEfetivoStyle);
        $tbl->addRow(OSController::$TABLE_HEIGHT);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Nome', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars('Data', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);
        $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars('Tipo de Progresso', ENT_COMPAT, 'UTF-8'),'bold',$hAlign);

        foreach(OS::getProgresso(Divisao::$CLA,$ano,$trimestre) as $temp){
            $tbl->addRow(OSController::$TABLE_HEIGHT);
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars($temp->nome, ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(3000,$vAlign)->addText(htmlspecialchars(OS::readifyDate($temp->data), ENT_COMPAT, 'UTF-8'),'text');
            $tbl->addCell(4000,$vAlign)->addText(htmlspecialchars($temp->label, ENT_COMPAT, 'UTF-8'),'text');
        }
        $os->addTextBreak();

        /* Atividades das Divisões */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Atividades das Divisões',ENT_COMPAT,'UTF-8'),1);
        $os->addTextBreak();

        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Alcateia', ENT_COMPAT, 'UTF-8'),2);
        $os->addTextBreak();

        /* Tabela de Atividades da Alcateia */
        $rows = DB::table('atividades')
            ->where('organization_id',Auth::user()->organization_id)
            ->where(function($query) {
                $query->where('divisao',Divisao::$ALCATEIA)
                    ->orWhere('divisao',Divisao::$GRUPO);
            })
            ->where('trimestre',$trimestre)
            ->where('ano',$ano)
            ->groupBy('mes')
            ->select(DB::raw('substring_index(performed_at,\'-\',2) as mes, count(*) as colunas'))
            ->get();

        $os->addImage('images/os/osalc.png',array('width' => 150));
        $os->addTextBreak();
        
        foreach($rows as $row){
            $tbl = $os->addTable(array('borderSize' => 2, 'cellMargin' => 80));
            $tbl->addRow(600);
            $cull = $tbl->addCell(750,array('valign' => 'center'));
            OS::readifyMonth($row->mes,$cull);

            $width = (9250/$row->colunas);

            $atividades = DB::table('atividades')
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$ALCATEIA)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->where('trimestre',$trimestre)
                            ->where('ano',$ano)
                            ->where('performed_at','like',$row->mes.'%')
                            ->orderBy('performed_at')
                            ->get();

            foreach($atividades as $ativ){
                $cell = $tbl->addCell($width);
                $cell->addText(explode('-',$ativ->performed_at)[2],'small_bold',array('align' => 'right'));
                $nomes = explode('/',$ativ->nome);
                foreach($nomes as $nome){
                    $cell->addText($nome,'small',array('align' => 'center'));   
                }
            }
        }

        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('Presenças', ENT_COMPAT, 'UTF-8'),'tbold');

        $nalc = DB::table('atividades')->where('ano',$ano)
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where('trimestre',$trimestre)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$ALCATEIA)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })->get();

        foreach($nalc as $ativ){
            $textrun = $os->addListItemRun();
            $textrun->addText(htmlspecialchars(OS::readifyDate($ativ->performed_at).':', ENT_COMPAT, 'UTF-8'),'small_bold');

            $presencas = DB::table('escoteiros')
                    ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
                    ->where('presencas.atividade_id','=',$ativ->id)
                    ->where('presencas.tipo','=',Presenca::$PRESENTE)
                    ->select('escoteiros.nome')
                    ->get();
            
            $text = '';
            foreach($presencas as $p){
                $text .= ' '.$p->nome.',';
            }

            $text = trim($text,',');
            $textrun->addText(htmlspecialchars($text,ENT_COMPAT,'UTF-8'),'small');
        }

        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Tribo de Escoteiros', ENT_COMPAT, 'UTF-8'),2);
        $os->addTextBreak();

        /* Tabela de Atividades da Alcateia */
        $rows = DB::table('atividades')
            ->where('organization_id',Auth::user()->organization_id)
            ->where(function($query) {
                $query->where('divisao',Divisao::$TES)
                    ->orWhere('divisao',Divisao::$GRUPO);
            })
            ->where('trimestre',$trimestre)
            ->where('ano',$ano)
            ->groupBy('mes')
            ->select(DB::raw('substring_index(performed_at,\'-\',2) as mes, count(*) as colunas'))
            ->get();

        $os->addImage('images/os/ostes.png',array('width' => 150));
        $os->addTextBreak();

        foreach($rows as $row){
            $tbl = $os->addTable(array('borderSize' => 2, 'cellMargin' => 80));
            $tbl->addRow(600);
            $cull = $tbl->addCell(750,array('valign' => 'center'));
            OS::readifyMonth($row->mes,$cull);

            $width = (9250/$row->colunas);

            $atividades = DB::table('atividades')
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$TES)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->where('trimestre',$trimestre)
                            ->where('ano',$ano)
                            ->where('performed_at','like',$row->mes.'%')
                            ->orderBy('performed_at')
                            ->get();

            foreach($atividades as $ativ){
                $cell = $tbl->addCell($width);
                $cell->addText(explode('-',$ativ->performed_at)[2],'small_bold',array('align' => 'right'));
                $nomes = explode('/',$ativ->nome);
                foreach($nomes as $nome){
                    $cell->addText($nome,'small',array('align' => 'center'));   
                }
            }
        }

        /* Listagem de presenças da TES */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('Presenças', ENT_COMPAT, 'UTF-8'),'tbold');

        $ntes = DB::table('atividades')->where('ano',$ano)
                    ->where('organization_id',Auth::user()->organization_id)
                    ->where('trimestre',$trimestre)
                    ->where(function($query) {
                        $query->where('divisao',Divisao::$TES)
                            ->orWhere('divisao',Divisao::$GRUPO);
                    })->get();

        foreach($ntes as $ativ){
            $textrun = $os->addListItemRun();
            $textrun->addText(htmlspecialchars(OS::readifyDate($ativ->performed_at).':', ENT_COMPAT, 'UTF-8'),'small_bold');

            $presencas = DB::table('escoteiros')
                    ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
                    ->where('presencas.atividade_id','=',$ativ->id)
                    ->where('presencas.tipo','=',Presenca::$PRESENTE)
                    ->select('escoteiros.nome')
                    ->get();

            $text = '';
        
            foreach($presencas as $p){
                $text .= ' '.$p->nome.',';
            }

            $text = trim($text,',');
            $textrun->addText(htmlspecialchars($text,ENT_COMPAT,'UTF-8'),'small');
        }

        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Tribo de Exploradores', ENT_COMPAT, 'UTF-8'),2);
        $os->addTextBreak();

        /* Tabela de Atividades da Tribo de Exploradors */
        $rows = DB::table('atividades')
            ->where('organization_id',Auth::user()->organization_id)
            ->where(function($query) {
                $query->where('divisao',Divisao::$TEX)
                    ->orWhere('divisao',Divisao::$GRUPO);
            })
            ->where('trimestre',$trimestre)
            ->where('ano',$ano)
            ->groupBy('mes')
            ->select(DB::raw('substring_index(performed_at,\'-\',2) as mes, count(*) as colunas'))
            ->get();

        $os->addImage('images/os/ostex.png',array('width' => 150));
        $os->addTextBreak();
        
        foreach($rows as $row){
            $tbl = $os->addTable(array('borderSize' => 2, 'cellMargin' => 80));
            $tbl->addRow(600);
            $cull = $tbl->addCell(750,array('valign' => 'center'));
            OS::readifyMonth($row->mes,$cull);

            $width = (9250/$row->colunas);

            $atividades = DB::table('atividades')
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$TEX)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->where('trimestre',$trimestre)
                            ->where('ano',$ano)
                            ->where('performed_at','like',$row->mes.'%')
                            ->orderBy('performed_at')
                            ->get();

            foreach($atividades as $ativ){
                $cell = $tbl->addCell($width);
                $cell->addText(explode('-',$ativ->performed_at)[2],'small_bold',array('align' => 'right'));
                $nomes = explode('/',$ativ->nome);
                foreach($nomes as $nome){
                    $cell->addText($nome,'small',array('align' => 'center'));   
                }
            }
        }

        /* Listagem de presenças da TEX */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('Presenças', ENT_COMPAT, 'UTF-8'),'tbold');

        $ntex = DB::table('atividades')->where('ano',$ano)
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where('trimestre',$trimestre)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$TEX)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->get();
        
        foreach($ntex as $ativ){
            $textrun = $os->addListItemRun();
            $textrun->addText(htmlspecialchars(OS::readifyDate($ativ->performed_at).':', ENT_COMPAT, 'UTF-8'),'small_bold');

            $presencas = DB::table('escoteiros')
                    ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
                    ->where('presencas.atividade_id','=',$ativ->id)
                    ->where('presencas.tipo','=',Presenca::$PRESENTE)
                    ->select('escoteiros.nome')
                    ->get();
            $text = '';
            foreach($presencas as $p){
                $text .= ' '.$p->nome.',';
            }

            $text = trim($text,',');
            $textrun->addText(htmlspecialchars($text,ENT_COMPAT,'UTF-8'),'small');
        }

        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Clã', ENT_COMPAT, 'UTF-8'),2);
        $os->addTextBreak();

        /* Tabela de Atividades de Clã */
        $rows = DB::table('atividades')
            ->where('organization_id',Auth::user()->organization_id)
            ->where(function($query) {
                $query->where('divisao',Divisao::$CLA)
                    ->orWhere('divisao',Divisao::$GRUPO);
            })
            ->where('trimestre',$trimestre)
            ->where('ano',$ano)
            ->groupBy('mes')
            ->select(DB::raw('substring_index(performed_at,\'-\',2) as mes, count(*) as colunas'))
            ->get();

        $os->addImage('images/os/oscla.png',array('width' => 150));
        $os->addTextBreak();
        
        foreach($rows as $row){
            $tbl = $os->addTable(array('borderSize' => 2, 'cellMargin' => 80));
            $tbl->addRow(600);
            $cull = $tbl->addCell(750,array('valign' => 'center'));
            OS::readifyMonth($row->mes,$cull);

            $width = (9250/$row->colunas);

            $atividades = DB::table('atividades')
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$CLA)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->where('trimestre',$trimestre)
                            ->where('ano',$ano)
                            ->where('performed_at','like',$row->mes.'%')
                            ->orderBy('performed_at')
                            ->get();

            foreach($atividades as $ativ){
                $cell = $tbl->addCell($width);
                $cell->addText(explode('-',$ativ->performed_at)[2],'small_bold',array('align' => 'right'));
                $nomes = explode('/',$ativ->nome);
                foreach($nomes as $nome){
                    $cell->addText($nome,'small',array('align' => 'center'));   
                }
            }
        }

        /* Listagem de presenças do CLA */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('Presenças', ENT_COMPAT, 'UTF-8'),'tbold');

        $ncla = DB::table('atividades')->where('ano',$ano)
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where('trimestre',$trimestre)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$CLA)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->get();

        foreach($ncla as $ativ){
            $textrun = $os->addListItemRun();
            $textrun->addText(htmlspecialchars(OS::readifyDate($ativ->performed_at).':', ENT_COMPAT, 'UTF-8'),'small_bold');

            $presencas = DB::table('escoteiros')
                    ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
                    ->where('presencas.atividade_id','=',$ativ->id)
                    ->where('presencas.tipo','=',Presenca::$PRESENTE)
                    ->select('escoteiros.nome')
                    ->get();

            $text = '';
            foreach($presencas as $p){
                $text .= ' '.$p->nome.',';
            }

            $text = trim($text,',');
            $textrun->addText(htmlspecialchars($text,ENT_COMPAT,'UTF-8'),'small');
        }

        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('. Chefia', ENT_COMPAT, 'UTF-8'),2);
        $os->addTextBreak();

        /* Tabela de Atividades de CHEFIA */
        $rows = DB::table('atividades')
            ->where('organization_id',Auth::user()->organization_id)
            ->where(function($query) {
                $query->where('divisao',Divisao::$CHEFIA)
                    ->orWhere('divisao',Divisao::$GRUPO);
            })
            ->where('trimestre',$trimestre)
            ->where('ano',$ano)
            ->groupBy('mes')
            ->select(DB::raw('substring_index(performed_at,\'-\',2) as mes, count(*) as colunas'))
            ->get();

        // $os->addImage('img/oschefia.png',array('width' => 150));
        $os->addTextBreak();
        
        foreach($rows as $row){
            $tbl = $os->addTable(array('borderSize' => 2, 'cellMargin' => 80));
            $tbl->addRow(600);
            $cull = $tbl->addCell(750,array('valign' => 'center'));
            OS::readifyMonth($row->mes,$cull);

            $width = (9250/$row->colunas);

            $atividades = DB::table('atividades')
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$CHEFIA)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->where('trimestre',$trimestre)
                            ->where('ano',$ano)
                            ->where('performed_at','like',$row->mes.'%')
                            ->orderBy('performed_at')
                            ->get();

            foreach($atividades as $ativ){
                $cell = $tbl->addCell($width);
                $cell->addText(explode('-',$ativ->performed_at)[2],'small_bold',array('align' => 'right'));
                $nomes = explode('/',$ativ->nome);
                foreach($nomes as $nome){
                    $cell->addText($nome,'small',array('align' => 'center'));   
                }
            }
        }

        /* Listagem de presenças do CHEFIA */
        $os->addTextBreak();
        $os->addTitle(htmlspecialchars('Presenças', ENT_COMPAT, 'UTF-8'),'tbold');

        $ncla = DB::table('atividades')->where('ano',$ano)
                            ->where('organization_id',Auth::user()->organization_id)
                            ->where('trimestre',$trimestre)
                            ->where(function($query) {
                                $query->where('divisao',Divisao::$CHEFIA)
                                    ->orWhere('divisao',Divisao::$GRUPO);
                            })
                            ->get();

        foreach($ncla as $ativ){
            $textrun = $os->addListItemRun();
            $textrun->addText(htmlspecialchars(OS::readifyDate($ativ->performed_at).':', ENT_COMPAT, 'UTF-8'),'small_bold');

            $presencas = DB::table('escoteiros')
                    ->leftJoin('presencas','escoteiros.id','=','presencas.user_id')
                    ->where('presencas.atividade_id','=',$ativ->id)
                    ->where('presencas.tipo','=',Presenca::$PRESENTE)
                    ->select('escoteiros.nome')
                    ->get();

            $text = '';
            foreach($presencas as $p){
                $text .= ' '.$p->nome.',';
            }

            $text = trim($text,',');
            $textrun->addText(htmlspecialchars($text,ENT_COMPAT,'UTF-8'),'small');
        }
        
        /* Presenças dos Serviços Administrativos, Chefia do Grupo, Chefe de Clã, Caminheiros que não estiveram em serviço e eventos extra Grupo*/
        // $os->addTextBreak();
        // $os->addTitle(htmlspecialchars('. Conselhos de Dirigentes',ENT_COMPAT,'UTF-8'),1);
        // $os->addTextBreak();

        // $os->addTextBreak();
        // $os->addTitle(htmlspecialchars('. Equipas, prémios e vencedores das atividades',ENT_COMPAT,'UTF-8'),1);
        // $os->addTextBreak();

        $name = 'OS_trimestre'.$trimestre.'_'.$ano.'_v1.docx';

        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($objPHPWord, 'Word2007');
        ob_clean();

        $fileLocation = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().mySlug().'/os/'.$name;

        $writer->save($fileLocation);

        $header = array(
            'Content-Type: application/octet-stream'
        );

        return response()->download($fileLocation,$name,$header);
    }
}
