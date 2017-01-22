@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Korisnici: {{ $user->first_name }} {{ $user->last_name }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('users.destroy', $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>

                            <div class="col-md-10">
                                <p class="form-control-static">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Ime</label>

                            <div class="col-md-10">
                                <p class="form-control-static">
                                    {{ $user->first_name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Prezime</label>

                            <div class="col-md-10">
                                <p class="form-control-static">
                                    {{ $user->last_name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Admin</label>

                            <div class="col-md-10">
                                <p class="form-control-static">
                                    {{ $user->admin ? 'Da' : 'Ne' }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-wrench"></i> Uredi
                                </a>
                                <button type="submit" class="btn btn-danger" data-toggle="confirmation">
                                    <i class="glyphicon glyphicon-trash"></i> Obriši
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Nazad</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
