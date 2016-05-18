<?php

namespace App\Generator;

use PHPExcel;
use PHPExcel_IOFactory;

use App\Models\Divisao;
use App\Models\Escoteiro;
use App\Models\Desafio;

use Auth;

class ProgressoFileGenerator {

	public static function geraFile($divisao){
        $name = 'Tabela_Progresso_'.Divisao::getLabel($divisao).'.xls';

        $excel = new PHPExcel();
        $excel->createSheet(1);
        $excel->createSheet(2);

        $escoteiros = Escoteiro::grupo()->where('divisao',$divisao)->get();

        $provas1 = Desafio::where('divisao',$divisao)
    					->where('etapa',1)
    					->get();

		$provas2 = Desafio::where('divisao',$divisao)
						->where('etapa',2)
						->get();

		$provas3 = Desafio::where('divisao',$divisao)
						->where('etapa',3)
						->get();

		$excel->setActiveSheetIndex(0)->setTitle('1ª Etapa');
		$excel->setActiveSheetIndex(1)->setTitle('2ª Etapa');
		$excel->setActiveSheetIndex(2)->setTitle('3ª Etapa');

		$i = 1;
		foreach($escoteiros as $e){
			$i++;
			$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,$i,$e->nome);

			$excel->setActiveSheetIndex(1)
					->setCellValueByColumnAndRow(0,$i,$e->nome);

			$excel->setActiveSheetIndex(2)
					->setCellValueByColumnAndRow(0,$i,$e->nome);
		}

       	//primeira etapa
       	$col = 0;
       	$row = 1;
        foreach($provas1 as $p){
        	$col++;
        	$row = 1;
        	$excel->setActiveSheetIndex(0)
	        			->setCellValueByColumnAndRow($col,$row,$col);

        	foreach($escoteiros as $e){
        		$row++;
        		if($e->concludedProva(1,$divisao,$p->id)){
        			$excel->setActiveSheetIndex(0)
	        			->setCellValueByColumnAndRow($col,$row,'S');
        		} else {
    				$excel->setActiveSheetIndex(0)
	        			->setCellValueByColumnAndRow($col,$row,'N');
        		}
	        	
        	}

        }

        //segunda etapa


        //terceira etapa


        // $excel->setActiveSheetIndex(0)
        //         ->setCellValue('C8',$request->get('entidade'))//Entidade
        //         ->setCellValue('C9',$request->get('grupo'))//Grupo
        //         ->setCellValue('C10',$request->get('regiao'))//Região
        //         ->setCellValue('C11',$request->get('contacto'))//Contacto
        //         ->setCellValue('C13',$request->get('nome'))//Nome
        //         ->setCellValue('C14',$request->get('cargo'))//Cargo
        //         ->setCellValue('C15',$request->get('nassociativo'))//N Associativo
        //         ->setCellValue('C16',$request->get('telemovel'))//Telemovel
        //         ->setCellValue('C18',$request->get('data_inicio'))//Data Inicio
        //         ->setCellValue('C19',$request->get('data_fim'));//Data Fim

        $writer = PHPExcel_IOFactory::createWriter($excel,'Excel5');
        ob_clean();
        $writer->save($name);
        return $name;
	}
}