@extends('organization.default')

@section('header')
	<title>{{ $atividade->nome }}</title>
@stop

@section('content')
	<div class="row"></div>

	<h2 class="page-header">{{ $atividade->nome }} 
		@if(Auth::user()->level <= App\User::$CAMINHEIRO)
			<small><a href="{{ URL::route('atividades.edit',[ mySlug(), $atividade->id]) }}"><span class="glyphicon glyphicon-edit"></span></a></small><small><a href="#"><span style="color: red;" data-target="#myModal" data-toggle="modal" class="pull-right glyphicon glyphicon-remove"></span></a></small>
		@endif
	</h2>

	<div class="row">
		<div class="col-md-4">
			<h4 class="text-center">Informações Gerais</h4>
			<pre>Local: <strong>{{ $atividade->local }}</strong></pre>
			<pre>Divisão: <strong>{{ App\Models\Divisao::getLabel($atividade->divisao) }}</strong></pre>
			<pre>Data de realização: <strong>{{ $atividade->performed_at }}</strong></pre>
			<pre>Trimestre: <strong>{{ $atividade->trimestre }}</strong></pre>
			<pre>Duração: <strong>{{ $atividade->duracao }}</strong></pre>
			<pre>Noites Campo: <strong>{{ $atividade->noites_campo }}</strong></pre>
			<pre>Presenças: <strong>{{ $atividade->getNumPresencas() }}</strong></pre>
			<pre>Informações: <strong>{{ $atividade->infos }}</strong></pre>
			<pre>Descrição: <strong>{{ $atividade->descricao }}</strong></pre>
		</div>
		<div class="col-md-5">
			<h4 class="text-center">Programa</h4>
			<pre><strong>{{ $atividade->programa }}</strong></pre>
		</div>
		<div class="col-md-3">
			<h4 class="text-center">Objetivos</h4>
			<pre><strong>{{ $atividade->objetivos }}</strong></pre>
		</div>
	</div>
	<h3 class="page-header">Presenças</h3>
	<div class="row">
		@if(Auth::user()->level <= App\User::$CAMINHEIRO)
			<div class="row">
				<div class="col-md-12">
					<div class="btn-group">
						<a class="btn btn-lg btn-warning @if($presencas_divisao == App\Models\Divisao::$ALCATEIA || $presencas_divisao == App\Models\Divisao::$GRUPO) active @endif" href="{{ URL::route('atividades.show.divisao' , [mySlug(), $atividade->id , App\Models\Divisao::$ALCATEIA ] ) }}">Alcateia</a>
						<a class="btn btn-lg btn-success @if($presencas_divisao == App\Models\Divisao::$TES || $presencas_divisao == App\Models\Divisao::$GRUPO) active @endif" href="{{ URL::route('atividades.show.divisao' , [mySlug(), $atividade->id , App\Models\Divisao::$TES ] ) }}">TEs</a>
						<a class="btn btn-lg btn-primary @if($presencas_divisao == App\Models\Divisao::$TEX || $presencas_divisao == App\Models\Divisao::$GRUPO) active @endif" href="{{ URL::route('atividades.show.divisao' , [mySlug(), $atividade->id , App\Models\Divisao::$TEX ] ) }}">TEx</a>
						<a class="btn btn-lg btn-danger @if($presencas_divisao == App\Models\Divisao::$CLA || $presencas_divisao == App\Models\Divisao::$GRUPO) active @endif" href="{{ URL::route('atividades.show.divisao' , [mySlug(), $atividade->id , App\Models\Divisao::$CLA ] ) }}">Clã</a>
						<a class="btn btn-lg btn-default @if($presencas_divisao == App\Models\Divisao::$CHEFIA || $presencas_divisao == App\Models\Divisao::$GRUPO) active @endif" href="{{ URL::route('atividades.show.divisao' , [mySlug(), $atividade->id , App\Models\Divisao::$CHEFIA ] ) }}">Chefia</a>
					</div>
				</div>
			
			</div>
		@endif
		<div class="spacer-mini"></div>
		<div class="row">
			@if(Auth::user()->level <= App\User::$CAMINHEIRO)
				@include('organization.atividades.atividades_presencas',['presencas_divisao' => $presencas_divisao])
			@else
				@include('organization.atividades.atividades_escoteiros',['presencas_divisao' => $presencas_divisao])
			@endif
		</div>
				
		</div>
	</div>
		
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Apagar atividade</h4>
      </div>
      <div class="modal-body">
        Tens a certeza que queres apagar esta atividade?<br>
        Todas as informações serão perdidas!
      </div>
      <div class="modal-footer">
        
        {!! Form::open(array('route' => ['atividades.destroy',mySlug(),$atividade->id] , 'method' => 'DELETE' )) !!}
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-danger">Sim</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@stop

@section('scripts')
	{!! Html::script('js/presencas.js') !!}
	{!! Html::script('js/jquery.confirm.min.js') !!}
@stop