<div class="row">
		@if($escoteiro->divisao != App\User::$CHEFIA)
			<div class="col-md-6">
				<h4 class="text-center">Etapas</h4>
				<div class="row">
					<div class="col-md-6">
						{!! Form::open(array('route' => array('escoteiros.concluirprovaetapa',mySlug(),$escoteiro->id) ,'method' => 'POST' )) !!}
							<p>{!! Form::select('etapa', array(
									'' => '',
									'1' => '1ª Etapa',
									'2' => '2ª Etapa',
									'3' => '3ª Etapa',
								),null, array('class' => 'form-control', 'required' => 'required' )) !!}</p>
							<p><input type="number" min="1" name="prova" class="form-control" placeholder="numero do desafio" required></p>
							<p><input type="date" name="concluded_at" class="form-control" placeholder="data do desafio" required></p>
							@if($total)
								<p>
									{!! Form::select('divisao', array(
										'' => '',
										'1' => 'Alcateia',
										'2' => 'TEs',
										'3' => 'TEx',
										'4' => 'Cla',
									),null, array('class' => 'form-control','required' => 'required' )) !!}
								</p>
							@else
								<input type="hidden" name="divisao" value="{{ $escoteiro->divisao }}" />
							@endif
							<p><button type="submit" class="btn btn-primary btn-block">Adicionar Desafio</button></p>
						{!! Form::close() !!}
					</div>
					<div class="col-md-6">
						{!! Form::open(array('route' => array('escoteiros.concluiretapa',mySlug(),$escoteiro->id) ,'method' => 'POST' )) !!}
							<p>{!! Form::select('etapa', array(
									'' => '',
									'1' => '1ª Etapa',
									'2' => '2ª Etapa',
									'3' => '3ª Etapa',
								),null, array('class' => 'form-control','required' => 'required' )) !!}</p>
							<p><input type="date" name="concluded_at" class="form-control" placeholder="data de conclusão" required></p>
							@if($total)
								<p>
									{!! Form::select('divisao', array(
										'' => '',
										'1' => 'Alcateia',
										'2' => 'TEs',
										'3' => 'TEx',
										'4' => 'Cla',
									),null, array('class' => 'form-control','required' => 'required' )) !!}
								</p>
							@else
								<input type="hidden" name="divisao" value="{{ $escoteiro->divisao }}" />
							@endif
							<p><button type="submit" class="btn btn-primary btn-block">Concluir Etapa</button></p>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<h4 class="text-center">Especialidades</h4>
				<div class="col-md-6">
					{!! Form::open(array('route' => array('escoteiros.concluirprovaespecialidade',mySlug(),$escoteiro->id) ,'method' => 'POST' )) !!}
						<p>
							<select class="form-control" required="required" name="especialidade">
								<option value selected="selected">especialidade</option>
								@foreach(App\Models\Especialidade::getEspecialidades(Auth::user()->divisao) as $e)
									<option value="{{ $e->id }}">{{ $e->label }}</option>
								@endforeach
							</select>
						</p>
						<p><input type="number" name="prova" class="form-control" placeholder="numero do desafio" required></p>
						<p><input type="date" name="concluded_at" class="form-control" placeholder="data do desafio" required></p>
						<input type="hidden" name="divisao" value="{{ Auth::user()->divisao }}" />
						<p><button type="submit" class="btn btn-danger btn-block">Adicionar Desafio Especialidade</button></p>
					{!! Form::close() !!}
				</div>
				<div class="col-md-6">
					{!! Form::open(array('route' => array('escoteiros.concluirespecialidade',mySlug(),$escoteiro->id) ,'method' => 'POST' )) !!}
						<p>
							<select class="form-control" required="required" name="especialidade">
								<option value selected="selected">especialidade</option>
								@foreach(App\Models\Especialidade::getEspecialidades(Auth::user()->divisao) as $e)
									<option value="{{ $e->id }}">{{ $e->label }}</option>
								@endforeach
							</select>
						</p>
						<p><input type="date" name="concluded_at" class="form-control" placeholder="data de conclusão" required></p>
						<input type="hidden" name="divisao" value="{{ Auth::user()->divisao }}" />
						<p><button type="submit" class="btn btn-danger btn-block">Concluir Especialidade</button></p>
					{!! Form::close() !!}
				</div>
			</div>
		@else
			<!-- Fazer progresso para a chefia -->
		@endif
	</div>