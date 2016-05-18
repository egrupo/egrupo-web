@extends('organization.default')

@section('header')
	<title>Presenças {{ $atividade->nome }}</title>
@stop

@section('content')
	{!! Form::open(array('route' => array('atividades.marcarpresencas',mySlug(),$atividade->id,$presencas_divisao) ,'method' => 'POST','class' => 'form-horizontal' )) !!}
		@foreach($escoteiros as $escoteiro)
			<div class="row"><p>
				<div class="col-md-2"><strong>{{ $escoteiro->nome }}</strong></div>
				<div class="col-md-2">
					{!! Form::select('tipo', array(
						'-1' => '',
						App\Models\Presenca::$FALTA => 'Falta',
						App\Models\Presenca::$PRESENTE => 'Presente',
					),$escoteiro->tipo, array('name' => 'tipo[]','class' => 'form-control' )) !!}
				</div>
				<input type="hidden" value="{{ $escoteiro->id }}" name="escoteiros[]" />		
			</p></div>
		@endforeach
		<br>
		<div class="row">
			<div class="col-md-4">
				@if($marcar)
					<button type="submit" class="btn btn-large btn-primary btn-block">Marcar Presenças</button>
				@else
					<button type="submit" class="btn btn-large btn-danger btn-block">Alterar Presenças</button>
				@endif
			</div>
		</div>
	{!! Form::close() !!}

@stop