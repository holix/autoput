@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Cijene</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="input-group">
                                <div class="input-group-addon input-sm">Kategorija vozila</div>
                                <select class="form-control input-sm" id="category-select">
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}" @if($category->id == $id) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="table-responsive">
                        <form method="POST" action="{{ url('prices/' . $category->id) }}">
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
                                                    <input type="text" class="form-control price" name="prices[{{ $first->id }}][{{ $second->id }}]" id="price_{{ $first->id }}_{{ $second->id }}" value="{{ array_get($priceValues, $first->id . '.' . $second->id, 0) }}">
                                                    <div class="input-group-addon">KM</div>
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
            $('.price').keyup(function() {
                var el = $(this);
                var value = el.val();
                var id = el.attr('id').split('_');

                $('#price_' + id[2] + '_' + id[1]).val(value);
            });
            $('#category-select').change(function(e) {
                var value = $(this).val();
                var current = window.location.href;
                var exploded = current.split('/');
                exploded[exploded.length - 1] = value;

                window.location.href = exploded.join('/');
            });
        })
    </script>
@endpush