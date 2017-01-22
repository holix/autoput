@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('tollbooths.create') }}" class="btn btn-success btn-xs pull-right">
                        <i class="glyphicon glyphicon-plus"></i> Dodaj
                    </a>
                    Naplatne kućice
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    #
                                </th>
                                <th>
                                    Naziv
                                </th>
                                <th class="text-right" width="20%">
                                    Akcije
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tollbooths as $tollbooth)
                            <tr>
                                <td>
                                    {{ $tollbooth->id }}
                                </td>
                                <td>
                                    {{ $tollbooth->name }}
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('tollbooths.destroy', $tollbooth->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('tollbooths.show', $tollbooth->id) }}" class="btn btn-default btn-xs">
                                            <i class="glyphicon glyphicon-search"></i> Pregledaj
                                        </a>
                                        <a href="{{ route('tollbooths.edit', $tollbooth->id) }}" class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-wrench"></i> Uredi
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-xs" data-toggle="confirmation">
                                            <i class="glyphicon glyphicon-trash"></i> Obriši
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
