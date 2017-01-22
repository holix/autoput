@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Korisnici: {{ $user->first_name }} {{ $user->last_name }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('users.update', $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">Ime</label>

                            <div class="col-md-10">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-2 control-label">Ime</label>

                            <div class="col-md-10">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-2 control-label">Prezime</label>

                            <div class="col-md-10">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label">Lozinka</label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('admin') ? ' has-error' : '' }}">
                            <label for="admin" class="col-md-2 control-label">Admin</label>

                            <div class="col-md-10">
                                <select id="admin" type="select" class="form-control" name="admin" required>
                                    <option value="0" @if(old('admin', $user->admin) == '0') selected @endif>Ne</option>
                                    <option value="1" @if(old('admin', $user->admin) == '1') selected @endif>Da</option>
                                </select>

                                @if ($errors->has('admin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('admin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-wrench"></i> Uredi
                                </button>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-default">
                                    <i class="glyphicon glyphicon-search"></i> Pregledaj
                                </a>
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
