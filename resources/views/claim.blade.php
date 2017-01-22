@extends('layouts.mini')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('claim/' . $claim->id . '/download') }}" class="pull-right">
                        <i class="glyphicon glyphicon-download"></i> Preuzmi
                    </a>
                    Potvrda
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-6 control-label">Broj potvrde</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $claim->id }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Naplatna kućica</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $claim->tollbooth->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Kategorija vozila</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $claim->category->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Broj tablica</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $claim->plates }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Datum</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $claim->created_at }}
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection