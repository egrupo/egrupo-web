@extends('layouts.default')

@section('header')
	<title>Blog - {{ Auth::user()->nome }} </title>
	<script type="text/javascript" src="http://www.vincentcheung.ca/jsencryption/jsencryption.js"></script>
	{{ HTML::script('js/jsencryptionform.js') }}
@stop

@section('content')

	{{ Form::open() }}
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h3>Input</h3>
				{{ Form::textarea('cypher',null,array('id' => 'textInput','class'=>'form-control') ) }}
			</div>

			<div class="col-md-6">
				<h3>Output</h3>
				{{ Form::textarea('resultado' , null , array('id'=>'resultado','class' => 'form-control') ) }}
			</div>
		</div><!-- row -->
		{{ Form::hidden('invisible,','festejo',array('id' => 'key')) }}
		<div id="buttons">
			{{ Form::button('cifrar',array('onClick' => 'encryptFormText();' , 'class' => 'btn btn-default btn-lg') ) }}
			{{ Form::button('decifrar',array('onClick' => 'decryptFormText();' , 'class' => 'btn btn-default btn-lg' ))}}
		</div>

	</div>
	{{ Form::close() }}
@stop