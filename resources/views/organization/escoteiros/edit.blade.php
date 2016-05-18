@extends('organization.default')

@section('header')
	<title>{{ $escoteiro->nome }}</title>
@stop

@section('content')
	{!! Form::model($escoteiro, array('route' => ['escoteiros.update' ,mySlug(), $escoteiro->id ],'method' => 'patch','files' => true) ) !!}
	<div class="row"></div>
	<h2 class="page-header">
		<div class="row">
			<div class="col-md-4">
				{!! Form::text('nome',null,array('class' => 'form-control', 'placeholder' => 'Nome' )) !!}
			</div>
			<div class="col-md-3">
				{!! Form::button('Guardar' ,['type' => 'submit','class' => 'btn btn-large btn-primary' ]) !!}
			</div>
		</div>
	</h2>
	
	<div class="row"> 
		<div class="col-md-3">
			@if ($escoteiro->avatar_url)
				{!! Html::image('avatar/'.$escoteiro->id,null, array('class' => 'img-rounded avatar') ) !!}
			@else
				{!! Html::image('images/default_pic.png',null, array('class' => 'img-rounded avatar') ) !!}
			@endif

			{!! Form::file('avatar') !!}
		</div>
		<div class="col-md-4">
			<p>{!! Form::text('id_associativo',null,array('class' => 'form-control', 'placeholder' => 'Número Associativo' )) !!}</p>
			<p>{!! Form::text('totem',null,array('class' => 'form-control', 'placeholder' => 'Totem' )) !!}</p>
			<p>{!! Form::select('divisao', [
				'1' => 'Alcateia',
				'2' => 'TEs',
				'3' => 'TEx',
				'4' => 'Cla',
				'5' => 'Chefia',
				'6' => 'Antigos',
				'7' => 'Amigos'
			], null, array('class' => 'form-control' )) !!}</p>

			<p>{!! Form::select('patrulha', App\Models\PequenoGrupo::getPequenoGrupoArray($escoteiro->divisao), null, array('class' => 'form-control' )) !!}</p>
			
		</div>

		<div class="col-md-4">
			<p>{!! Form::text('cargo',null,array('class' => 'form-control', 'placeholder' => 'Cargo' )) !!}</p>
			<p>{!! Form::text('nivel_escotista',null,array('class' => 'form-control', 'placeholder' => 'Nível Escotista' )) !!}</p>
			<p>{!! Form::input('date','data_nascimento',null,array('class' => 'form-control', 'placeholder' => 'Data de Nascimento' )) !!}</p>
			<p>{!! Form::text('telemovel',null,array('class' => 'form-control', 'placeholder' => 'Núm. Telemóvel' )) !!}</p>
		</div>
		<div class="col-md-8">
			<p>
				{!! Form::text('nome_completo',null,array('class' => 'form-control', 'placeholder' => 'Nome Completo' )) !!}
			</p>
		</div>
		@if(Auth::user()->level <= App\User::$CAMINHEIRO)
			<div class="col-md-8">
					<p>{!! Form::textarea('notas',null,array('class' => 'form-control','rows' => '4' ,'placeholder' => 'Notas úteis' )) !!}</p>
			</div>
		@endif
	</div>

	<h2 class="page-header">Outras Infos</h2>
	<div class="row">
		<div class="row">
			<div class="col-md-3">
				{!! Form::hidden('autoriza_imagem', false) !!}
				<p>{!! Form::checkbox('autoriza_imagem') !!} Autoriza Imagem?</p>
			</div>
			<div class="col-md-3">
				{!! Form::hidden('ficha_inscricao', false) !!}
				<p>{!! Form::checkbox('ficha_inscricao') !!} Tem ficha de inscrição?</p>
			</div>
			<div class="col-md-6">
				<p>{!! Form::input('date','compromisso_honra',null,array('class' => 'form-control', 'placeholder' => 'Compromisso de honra' )) !!}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<p>{!! Form::text('email',null,array('class' => 'form-control', 'placeholder' => 'email' )) !!}</p>
				<p>{!! Form::text('nif',null,array('class' => 'form-control', 'placeholder' => 'nif' )) !!}</p>
				<p>{!! Form::text('nome_ee_1',null,array('class' => 'form-control', 'placeholder' => 'Nome Enc. Ed. 1' )) !!}</p>
				<p>{!! Form::text('telem_ee_1',null,array('class' => 'form-control', 'placeholder' => 'Telem. Enc. Ed. 1' )) !!}</p>
				<p>{!! Form::text('email_ee_1',null,array('class' => 'form-control', 'placeholder' => 'Email Enc. Ed. 1' )) !!}</p>
			</div>
			<div class="col-md-6">
				<p>{!! Form::text('bi',null,array('class' => 'form-control', 'placeholder' => 'bi/cc' )) !!}</p>
				<p>{!! Form::input('date','entrada_grupo',null,array('class' => 'form-control', 'placeholder' => 'Entrada no grupo' )) !!}</p>
				<p>{!! Form::text('nome_ee_2',null,array('class' => 'form-control', 'placeholder' => 'Nome Enc. Ed. 2' )) !!}</p>
				<p>{!! Form::text('telem_ee_2',null,array('class' => 'form-control', 'placeholder' => 'Telem. Enc. Ed. 2' )) !!}</p>
				<p>{!! Form::text('email_ee_2',null,array('class' => 'form-control', 'placeholder' => 'Email Enc. Ed. 2' )) !!}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>{!! Form::text('morada',null,array('class' => 'form-control', 'placeholder' => 'Morada completa' )) !!}</p>
			</div>
			<div class="col-md-12">
				<p>{!! Form::textarea('descricao',null,array('class' => 'form-control','rows' => '4' ,'placeholder' => 'Outras informações úteis (alergias, doenças, cuidados especiais, ...)' )) !!}</p>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop