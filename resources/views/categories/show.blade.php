@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Kategorije vozila: {{ $category->name }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Naziv</label>

                            <div class="col-md-10">
                                <p class="form-control-static">
                                    {{ $category->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-wrench"></i> Uredi
                                </a>
                                <button type="submit" class="btn btn-danger" data-toggle="confirmation">
                                    <i class="glyphicon glyphicon-trash"></i> Obriši
                                </button>
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
