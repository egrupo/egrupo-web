@extends('organization.default')

@section('header')
	<title>Admin</title>
@stop

@section('content')
	<div class="row">
		<h3 class="page-header">Gerir Utilizadores</h3>
		<div class="col-md-8">	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>User</th>
						<th class="text-center">Email</th>
						<th class="text-center">Divisão</th>
						<th class="text-center">Nível</th>
						<!-- <th class="text-center">Último Login<th> -->
					</tr>
				</thead>
				<tbody>
					@foreach (Auth::user()->organization->users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td><a href="{{ URL::route('users.edit',[ mySlug() ,$user->id]) }}">{{ $user->user }}</a></td>
							<td class="text-center">{{ $user->email }}</td>
							<td class="text-center">{{ App\Models\Divisao::getLabel($user->divisao) }}</td>
							<td class="text-center">{{ $user->level }}</td>
							<!-- <td class="text-center">{{ $user->last_login_at }}<th> -->
							<!-- <td class="text-center">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans() }}<th> -->
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			@include('organization.users.create')
		</div>
	</div>

	<h3 class="page-header">Gerir Pequenos Grupos</h3>
	<div class="row">
		<div class="col-md-8">	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Pequeno Grupo</th>
						<th class="text-center">Divisão</th>
					</tr>
				</thead>
				<tbody>
					@foreach (Auth::user()->organization->pequenosgrupos as $peq)
						<tr>
							<td>{{ $peq->id }}</td>
							<td><a href="{{ URL::route('pequenogrupo.edit',[ mySlug() ,$peq->id]) }}">{{ $peq->nome }}</a></td>
							<td class="text-center">{{ App\Models\Divisao::getLabel($peq->divisao) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			@include('organization.pequenogrupo.create')
		</div>
	</div>
	
@stop