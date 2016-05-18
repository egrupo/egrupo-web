@extends('organization.default')

@section('header')
	<title>{{ $escoteiro->nome }}</title>
	<meta name="_token" content="{{ csrf_token() }}"/>
@stop

@section('content')
	<div class="row">
		<h2 class="page-header">{{ $escoteiro->nome }} 
			@if(Auth::user()->level <= App\User::$CAMINHEIRO || $escoteiro->id_associativo == Auth::user()->escoteiro_id)
				<small><a href="{{ URL::route('escoteiros.edit',[ mySlug(), $escoteiro->id ]) }}"><span class="glyphicon glyphicon-edit"></span></a></small>
			@endif
		</h2>
		<div class="col-md-3">
			@if ($escoteiro->avatar_url)
				{!! Html::image('avatar/'.$escoteiro->id,null, array('class' => 'img-rounded avatar') ) !!}
			@else
				{!! Html::image('images/default_pic.png',null, array('class' => 'img-rounded avatar') ) !!}
			@endif
		</div>
		<div class="col-md-4">
			<pre>Número Associativo: <strong>{{ $escoteiro->id_associativo }}</strong></pre>
			<pre>Totem: <strong>{{ $escoteiro->totem }}</strong></pre>
			<pre>Divisão: <strong>{{ App\Models\Divisao::getLabel($escoteiro->divisao) }}</strong></pre>
			<pre>Patrulha: <strong>{{ $escoteiro->patrulha }}</strong></pre>
		</div>
		<div class="col-md-4">
			<pre>Cargo: <strong>{{ $escoteiro->cargo }}</strong></pre>
			<pre>Nível Escotista: <strong>{{ $escoteiro->nivel_escotista }}</strong></pre>
			<pre>Data nascimento: <strong>{{ $escoteiro->data_nascimento }}</strong></pre>
			<pre>Telemóvel: <strong>{{ $escoteiro->telemovel }}</strong></pre>
		</div>
		<div class="col-md-8">
			<pre>Nome Completo: <strong>{{ $escoteiro->nome_completo }}</strong></pre>
		</div>
		@if(Auth::user()->level <= App\User::$CAMINHEIRO)
			<div class="col-md-offset-3 col-md-8">
				<pre><strong>{{ $escoteiro->notas }}</strong> </pre>
			</div>
		@endif
	</div>

	@if(Auth::user()->level <= App\User::$CAMINHEIRO || $escoteiro->id_associativo == Auth::user()->escoteiro_id)

		<h2 class="page-header">Progresso 
			@if(Auth::user()->level <= App\User::$CAMINHEIRO)
				<small><a onClick="toggleProgresso()"><span class="glyphicon glyphicon-edit"></span></a></small>
			@endif
		</h2>
		<div id="marcar-progresso" hidden>
			@if(Auth::user()->level <= App\User::$CAMINHEIRO)
				@include('organization.progresso.gravar', array('escoteiro' => $escoteiro ,'total' => false))
			@endif
		</div>

		@include('organization.progresso.etapa', array('divisao' => $escoteiro->divisao , 'escoteiro' => $escoteiro))
		<div class="row">
			@foreach($escoteiro->getEspecialidades($escoteiro->divisao) as $especialidade)
				<div style="float: left;padding-left: 5px; padding-top: 5px;">
					<a href="#" onClick="return false;"
						data-container="body" 
						data-toggle="popover" data-trigger="focus" 
						data-placement="bottom" title="{{ $especialidade->label }}" 
						data-content="{{ $especialidade->concluded_at }}"
					>
					{!! Html::image($especialidade->image_link,$especialidade->label, array('class' => 'especialidade','title' => $especialidade->label )) !!}
					</a>
				</div>
			@endforeach
		</div>
		<div class="row mrgt20">
			<div class="col-md-4">
				<a href="{{ URL::route('escoteiros.showprogresso',[mySlug(),$escoteiro->id])  }}"><button class="btn btn-large btn-primary">Ver progresso total</button></a>
				<a href="{{ URL::route('escoteiros.showprogressoespecialidades',[mySlug(),$escoteiro->id])  }}"><button class="btn btn-large btn-primary">Ver Especialidades</button></a>
			</div>
		</div>

		<h2 class="page-header">Presenças <small>{{ App\Models\Atividade::getCurrentYear() }} <a href="{{ URL::route('escoteiros.showpresencas',[mySlug(),$escoteiro->id])  }}">(ver todas as presenças)</a></small></h2>
		@include('organization.presencas.ano', array('escoteiro' => $escoteiro, 'ano' => App\Models\Atividade::getCurrentYear()))

		<h2 class="page-header">Outras Info</h2>
		<div class="row">
			<div class="col-md-3">
				<pre>Autoriza Imagem? <strong>{{ $escoteiro->autoriza_imagem? 'SIM':'NÃO' }}</strong></pre>
			</div>
			<div class="col-md-3">
				<pre>Tem ficha de inscrição? <strong>{{ $escoteiro->ficha_inscricao? 'SIM':'NÃO' }}</strong></pre>
			</div>
			<div class="col-md-6">
				<pre>Compromisso de honra: <strong>{{ $escoteiro->compromisso_honra }}</strong></pre>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<pre>Email: <strong>{{ $escoteiro->email }}</strong></pre>
				<pre>NIF: <strong>{{ $escoteiro->nif }}</strong></pre>
				<pre>Nome Enc. Ed. 1: <strong>{{ $escoteiro->nome_ee_1 }}</strong></pre>
				<pre>Telem. Enc. Ed. 1: <strong>{{ $escoteiro->telem_ee_1 }}</strong></pre>
				<pre>Email Enc. Ed. 1: <strong>{{ $escoteiro->email_ee_1 }}</strong></pre>
			</div>
			<div class="col-md-6">
				<pre>BI/CC: <strong>{{ $escoteiro->bi }}</strong></pre>
				<pre>Entrada no grupo: <strong>{{ $escoteiro->entrada_grupo }}</strong></pre>
				<pre>Nome Enc. Ed. 2: <strong>{{ $escoteiro->nome_ee_2 }}</strong></pre>
				<pre>Telem. Enc. Ed. 2: <strong>{{ $escoteiro->telem_ee_2 }}</strong></pre>
				<pre>Email Enc. Ed. 2: <strong>{{ $escoteiro->email_ee_2 }}</strong></pre>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<pre>Morada: <strong>{{ $escoteiro->morada }}</strong></pre>
			</div>
			<div class="col-md-12">
				<pre>Outras info: <strong>{{ $escoteiro->descricao }}</strong></pre>
			</div>
		</div>
	@endif

@stop

@section('scripts')
	<script type="text/javascript" src="{{ URL::asset('js/progresso.js') }}"></script>
@stop