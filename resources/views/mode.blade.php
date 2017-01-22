@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Režim rada</div>

                <div class="panel-body">
                    <div class="btn-group btn-group-justified" role="group" id="tollbooth">
                        @foreach($tollbooths as $tollbooth)
                        <div class="btn-group btn-group-lg" role="group">
                            <button type="button" class="btn btn-default @if(session('tollbooth_id') == $tollbooth->id) active @endif" data-id="{{ $tollbooth->id }}">{{ $tollbooth->name }}</button>
                        </div>
                        @endforeach
                    </div>
                    <p></p>
                    <div class="btn-group btn-group-justified" role="group" id="mode">
                        <div class="btn-group btn-group-lg" role="group">
                            <button type="button" class="btn btn-default @if(session('mode', -1) == "0") active @endif" data-id="0">Ulaz</button>
                        </div>
                        <div class="btn-group btn-group-lg" role="group">
                            <button type="button" class="btn btn-default @if(session('mode', -1) == "1") active @endif" data-id="1">Izlaz</button>
                        </div>
                    </div>
                    <p></p>
                    <form method="POST" action="{{ url('mode') }}" class="text-center">
                        {{ csrf_field() }}
                        <input type="hidden" name="tollbooth_id">
                        <input type="hidden" name="mode">
                        <button type="submit" class="btn btn-primary" disabled>
                            <i class="glyphicon glyphicon-plus"></i> Izaberi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var tollbooth_id = {{ session('tollbooth_id', 'null') }};
        var mode = {{ session('mode', 'null') }};
        $('#tollbooth button').click(function(e) {
            var id = $(this).data('id');
            tollbooth_id = id;
            updateButton();
            $('#tollbooth button').removeClass('active');
            $(this).addClass('active');
            e.stopPropagation();
            return false;
        });
        $('#mode button').click(function(e) {
            var id = $(this).data('id');
            mode = id;
            updateButton();
            $('#mode button').removeClass('active');
            $(this).addClass('active');
            e.stopPropagation();
            return false;
        });
        function updateButton() {
            if(tollbooth_id != null && mode != null) {
                $("input[name=tollbooth_id]").val(tollbooth_id);
                $("input[name=mode]").val(mode);
                $("button[type=submit]").attr('disabled', null);
            }
        }
        updateButton();
    })
</script>
@endpush