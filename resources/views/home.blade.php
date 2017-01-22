@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{ $t->name }}</strong> - {{ !$mode ? 'Ulaz' : 'Izlaz' }}</div>

                <div class="panel-body">
                    @if(!$mode)
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('claim') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('plates') ? ' has-error' : '' }}">
                            <label for="plates" class="col-md-2 control-label">Broj tablica</label>

                            <div class="col-md-10">
                                <input id="plates" type="text" class="form-control" name="plates" value="{{ old('plates') }}" required autofocus>

                                @if ($errors->has('plates'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plates') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-2 control-label">Kategorija vozila</label>

                            <div class="col-md-10">

                                <select id="category_id" class="form-control" name="category_id" required>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}" @if(old('category_id') == $id) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-plus"></i> Izdaj potvrdu
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th width="5%">
                                #
                            </th>
                            <th>
                                Naplatna kućica
                            </th>
                            <th>
                                Korisnik
                            </th>
                            <th>
                                Kategorija vozila
                            </th>
                            <th>
                                Broj tablica
                            </th>
                            <th>
                                Datum
                            </th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($claims as $claim)
                            <tr>
                                <td>
                                    {{ $claim->id }}
                                </td>
                                <td>
                                    {{ $claim->tollbooth->name }}
                                </td>
                                <td>
                                    {{ $claim->user->first_name }} {{ $claim->user->last_name }}
                                </td>
                                <td>
                                    {{ $claim->category->name }}
                                </td>
                                <td>
                                    {{ $claim->plates }}
                                </td>
                                <td>
                                    {{ $claim->created_at }}
                                </td>
                                <td class="text-right">
                                    <a href="{{ url('claim/' . $claim->id) }}" class="claim"><i class="glyphicon glyphicon-search"></i></a>
                                    <a href="{{ url('claim/' . $claim->id . '/download') }}"><i class="glyphicon glyphicon-download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('invoice') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('claim_id') ? ' has-error' : '' }}">
                                <label for="claim_id" class="col-md-2 control-label">Broj potvrde</label>

                                <div class="col-md-10">
                                    <input id="claim_id" type="text" class="form-control" name="claim_id" value="{{ old('claim_id') }}" required autofocus>

                                    @if ($errors->has('claim_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('claim_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-plus"></i> Izdaj račun
                                    </button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th width="5%">
                                    #
                                </th>
                                <th>
                                    Broj potvrde
                                </th>
                                <th>
                                    Ulaz
                                </th>
                                <th>
                                    Izlaz
                                </th>
                                <th>
                                    Korisnik
                                </th>
                                <th>
                                    Kategorija vozila
                                </th>
                                <th>
                                    Broj tablica
                                </th>
                                <th>
                                    Datum
                                </th>
                                <th width="5%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr @if($invoice->has_penalty) class="danger" @endif>
                                    <td>
                                        {{ $invoice->id }}
                                    </td>
                                    <td>
                                        {{ $invoice->claim->id }}
                                    </td>
                                    <td>
                                        {{ $invoice->claim->tollbooth->name }}
                                    </td>
                                    <td>
                                        {{ $invoice->tollbooth->name }}
                                    </td>
                                    <td>
                                        {{ $invoice->user->first_name }} {{ $invoice->user->last_name }}
                                    </td>
                                    <td>
                                        {{ $invoice->claim->category->name }}
                                    </td>
                                    <td>
                                        {{ $invoice->claim->plates }}
                                    </td>
                                    <td>
                                        {{ $invoice->created_at }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ url('invoice/' . $invoice->id) }}" class="invoice"><i class="glyphicon glyphicon-search"></i></a>
                                        <a href="{{ url('invoice/' . $invoice->id . '/download') }}"><i class="glyphicon glyphicon-download"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function() {
        $('a.claim').click(function(e) {
            window.open($(this).attr('href'), '_blank', 'toolbar=0,location=0,menubar=0,width=768,height=450');
            e.stopPropagation();
            return false;
        });
        $('a.invoice').click(function(e) {
            window.open($(this).attr('href'), '_blank', 'toolbar=0,location=0,menubar=0,width=768,height=600');
            e.stopPropagation();
            return false;
        });
    });
</script>
@if(session()->has('claim'))
<script>
    $(function() {
        window.open('/claim/{{ session()->get('claim') }}', '_blank', 'toolbar=0,location=0,menubar=0,width=768,height=400');
    });
</script>
@endif
@if(session()->has('invoice'))
<script>
    $(function() {
        window.open('/invoice/{{ session()->get('invoice') }}', '_blank', 'toolbar=0,location=0,menubar=0,width=768,height=550');
    });
</script>
@endif
@endpush