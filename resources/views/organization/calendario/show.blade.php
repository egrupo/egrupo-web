@foreach(App\Models\Atividade::getAtividadesTrimestre($divisao,App\Models\Atividade::getCurrentTrimestre(),App\Models\Atividade::getCurrentYear()) as $atividade)
	<div class="calendario {{ strtotime($atividade->performed_at) < strtotime('now')?'atividade-past':'atividade-future' }}">
		<p><strong>{{ $atividade->getLOL() }}</strong></p>
		<p>{{ $atividade->nome }}</p>
	</div>
@endforeach
<div style="width: 100%; height: 20px; float: left" /> 