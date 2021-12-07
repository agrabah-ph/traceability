@extends('trace.master')

@section('title', 'Inventory Show')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@yield('title')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@yield('title')</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('inventory.index') }}" class="btn btn-primary btn-action">Back</a>
            </div>
        </div>
    </div>

    <div id="app" class="wrapper wrapper-content">
            <div class="row">
                <div class="col-sm-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Product details</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $inventory->product->display_name }}</h3>
                                <small class="text-success">Name</small>
                            </div>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $inventory->quality }}; {{ $inventory->quantity }} {{ $inventory->unit }}</h3>
                                <small class="text-success">Details</small>
                            </div>
                            <div class="mb-2">
                                <h3 class="mb-0">{{ $inventory->status }}</h3>
                                <small class="text-success">Status</small>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div style="width: 340px;">--}}
                <div class="col-auto">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Inventory ID</h5>
                        </div>
                        <div class="ibox-content">
                            {!! QrCode::size(150)->generate($inventory->reference_id); !!} <br><br>
                            <a href="{{ route('inventory-qr-print', array('id'=>$inventory->reference_id)) }}" class="btn btn-white btn-block" target="_blank"><i class="fa fa-print text-success"></i></a>
                        </div>
                    </div>
                </div>
                @if($inventory->batch_id !== null)
                <div class="col-auto">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Batch ID</h5>
                        </div>
                        <div class="ibox-content">
                            {!! QrCode::size(150)->generate($inventory->batch_id); !!} <br><br>
                            <a href="{{ route('inventory-qr-print', array('id'=>$inventory->batch_id)) }}" class="btn btn-white btn-block" target="_blank"><i class="fa fa-print text-success"></i></a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
    </div>



@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
    {{--    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    {{--    {!! Html::style('/css/template/plugins/sweetalert/sweetalert.css') !!}--}}
@endsection

@section('scripts')
    {{--    {!! Html::script('') !!}--}}
    {{--    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}--}}
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}--}}
    {{--    {!! Html::script('/js/template/moment.js') !!}--}}
    <script>
        $(document).ready(function(){


            {{--var modal = $('#modal');--}}
            {{--$(document).on('click', '', function(){--}}
            {{--    modal.modal({backdrop: 'static', keyboard: false});--}}
            {{--    modal.modal('toggle');--}}
            {{--});--}}

            {{-- var table = $('#table').DataTable({--}}
            {{--     processing: true,--}}
            {{--     serverSide: true,--}}
            {{--     ajax: {--}}
            {{--         url: '{!! route('') !!}',--}}
            {{--         data: function (d) {--}}
            {{--             d.branch_id = '';--}}
            {{--         }--}}
            {{--     },--}}
            {{--     columnDefs: [--}}
            {{--         { className: "text-right", "targets": [ 0 ] }--}}
            {{--     ],--}}
            {{--     columns: [--}}
            {{--         { data: 'name', name: 'name' },--}}
            {{--         { data: 'action', name: 'action' }--}}
            {{--     ]--}}
            {{-- });--}}

            {{--table.ajax.reload();--}}

        });
    </script>
@endsection
