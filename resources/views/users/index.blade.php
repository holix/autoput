@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-xs pull-right">
                        <i class="glyphicon glyphicon-plus"></i> Dodaj
                    </a>
                    Korisnici
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    #
                                </th>
                                <th>
                                    Ime
                                </th>
                                <th>
                                    Prezime
                                </th>
                                <th>
                                    Admin
                                </th>
                                <th class="text-right" width="20%">
                                    Akcije
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->first_name }}
                                </td>
                                <td>
                                    {{ $user->last_name }}
                                </td>
                                <td>
                                    {{ $user->admin ? 'Da' : 'Ne' }}
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-default btn-xs">
                                            <i class="glyphicon glyphicon-search"></i> Pregledaj
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-xs">
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
