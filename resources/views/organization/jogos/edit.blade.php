@extends('organization.default')

@section('header')
	<title>{{ $jogo->nome }}</title>
<!-- {{ HTML::script('js/jquery.confirm.min.js') }} -->
<!--	{{ HTML::script('js/atividade.js') }}-->
@stop

@section('content')
	
	{!! Form::model($jogo, array('route' => ['jogos.update' , mySlug() , $jogo->id ],'method' => 'patch' )) !!}
	<h2 class="page-header">{{ $jogo->nome }}  {{ Form::button('Guardar' ,['type' => 'submit','class' => 'btn btn-large btn-primary' ])}}</h2>
	<div class="row"> 
		<div class="col-md-4">
			<p>{!! Form::text('duracao',null,array('class' => 'form-control', 'placeholder' => 'Duração da atividade' )) !!}</p>
			<p>{!! Form::text('n_participantes',null,array('class' => 'form-control', 'placeholder' => 'n aconselhado de participantes')) !!}</p>
			<div class="form-group">
		    	<div class="col-md-offset-1 col-md-8">
		      		<div class="checkbox">{!! Form::checkbox('divisao_alcateia', null, in_array(App\Models\Divisao::$ALCATEIA,$jogo->getDivisoesArray()) ) !!}Alcateia</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_tes', null, in_array(App\Models\Divisao::$TES,$jogo->getDivisoesArray())) !!}TEs</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_tex', null, in_array(App\Models\Divisao::$TEX,$jogo->getDivisoesArray())) !!}TEx</div>
		      		<div class="checkbox">{!! Form::checkbox('divisao_cla', null, in_array(App\Models\Divisao::$CLA,$jogo->getDivisoesArray())) !!}Clã</div>
		    	</div>
		  	</div>
		</div>
		<div class="col-md-8">
			<p>{!! Form::textarea('descricao',null,array('class' => 'form-control', 'rows' => '10' ,'placeholder' => 'Fazemos uma roda e cantamos o Kumba-Ya' )) !!}</p>			
		</div>
	</div>
	{!! Form::close() !!}

@stop