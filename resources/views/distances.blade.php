@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Udaljenosti</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ url('distances') }}">
                            {{ csrf_field() }}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="{{ $width }}%"></th>
                                        @foreach($tollbooths as $tollbooth)
                                        <th width="{{ $width }}%">{{ $tollbooth->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tollbooths as $first)
                                    <tr>
                                        <th class="text-right">{{ $first->name }}</th>
                                        @foreach($tollbooths as $second)
                                            @if($first->id == $second->id)
                                            <td class="active"></td>
                                            @else
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control distance" name="distances[{{ $first->id }}][{{ $second->id }}]" id="distance_{{ $first->id }}_{{ $second->id }}" value="{{ array_get($distanceValues, $first->id . '.' . $second->id, 0) }}">
                                                    <div class="input-group-addon">km</div>
                                                </div>
                                            </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                    @endforeach
                                    <tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="glyphicon glyphicon-plus"></i> Snimi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.distance').keyup(function() {
                var el = $(this);
                var value = el.val();
                var id = el.attr('id').split('_');

                $('#distance_' + id[2] + '_' + id[1]).val(value);
            });
        })
    </script>
@endpush