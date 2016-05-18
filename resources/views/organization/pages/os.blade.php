@extends('organization.default')

@section('header')
	<title>Ordem de Serviço</title>
@stop

@section('content')

	{!! Form::open(['route' => ['geraros',mySlug()],'method' => 'post']) !!}
	<div class="row">
		<div class="col-md-7">
			<div class="row">
				<div class="col-md-6">
					<h3 class="page-header">Ano</h3>
					{!! Form::select('ano', App\Models\Atividade::getYearsArray(), null, array('class' => 'form-control' )) !!}
				</div>
				<div class="col-md-6">
					<h3 class="page-header">Trimestre</h3>
					<p>{!! Form::select('trimestre', [
						'1' => '1º Trimestre',
						'2' => '2º Trimestre',
						'3' => '3º Trimestre',
					], null, array('class' => 'form-control' )) !!}</p>
				</div>
				<div class="col-md-12">
					<h3 class="page-header">Introdução</h3>
					{!! Form::textarea('intro',null,array('class' => 'form-control','rows' => '3' ,'placeholder' => 'O 2º trimestre começou a 10 de Janeiro de 2015...' )) !!}
				</div>	
			</div>

		</div>

		<div class="col-md-5">
			<h3 class="page-header">OS já geradas</h3>
			<div class="row">
				<div class="col-md-12">
					@foreach(App\Models\OS::getOSFilesListing() as $file)
						<p><a href="{{ URL::route('os.download',[mySlug(), $file['basename']]) }}"><span class="glyphicon glyphicon-download-alt" /></a> {{ $file['basename'] }}
							<a href="{{ URL::route('osfile.destruir',[mySlug(), $file['basename']]) }}"><span class="pull-right glyphicon glyphicon-remove" /></a>
						</p>
					@endforeach
				</div>
			</div>
		</div>		
	</div>

	<p />

	<div class="row">
		<div class="col-md-12">
			<p>{!! Form::submit('Gerar Ordem de Serviço',array('class' => 'btn btn-large btn-primary')) !!}</p>
		</div>
	</div>
	{!! Form::close() !!}
@stop