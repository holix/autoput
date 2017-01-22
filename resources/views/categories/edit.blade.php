@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Kategorije vozila: {{ $category->name }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('categories.update', $category->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Naziv</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-wrench"></i> Uredi
                                </button>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-default">
                                    <i class="glyphicon glyphicon-search"></i> Pregledaj
                                </a>
                                <a href="{{ route('categories.index') }}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Nazad</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
