@extends('layouts.mini')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('invoice/' . $invoice->id . '/download') }}" class="pull-right">
                        <i class="glyphicon glyphicon-download"></i> Preuzmi
                    </a>
                    Račun
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-6 control-label">Broj računa</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->id }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Broj potvrde</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->claim->id }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Ulaz</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->claim->tollbooth->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Izlaz</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->tollbooth->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Kategorija vozila</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->claim->category->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Broj tablica</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->claim->plates }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Datum ulaska</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->claim->created_at }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Datum izlaska</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->created_at }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-6 control-label">Cijena</label>

                            <div class="col-xs-6">
                                <p class="form-control-static">
                                    {{ $invoice->price }}
                                </p>
                            </div>
                        </div>
                        @if($invoice->has_penalty)
                        <div class="form-group">
                            <label class="col-xs-12 text-center"><p class="text-danger">! Vožnja preko ograničenja brzine !</p></label>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection