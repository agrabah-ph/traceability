@extends('master')

@section('title', 'Trace Create')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@yield('title')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="\">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@yield('title')</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <button type="button" class="btn btn-primary btn-action" data-action="store">Store</button>
            </div>
        </div>
    </div>
{{--    <form action="{!! route('trace.store') !!}" method="post" id="form">--}}
    <div id="app" class="wrapper wrapper-content">

        <div class="row">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
{{--                    <div class="ibox-title">--}}
{{--                        <h5>Blank <small>page</small></h5>--}}
{{--                    </div>--}}
                    <div class="ibox-content">
                        <div class="form-group">
                            <label>Reference</label>
                            <input type="text" name="reference" value="{{ $random }}" class="form-control" readonly>
{{--                            <p>{{ $domain }}</p>--}}
                            <input type="hidden" name="url" value="{{ $url }}">
                        </div>

                        <div class="visible-print text-center">
                            {!! QrCode::size(100)->generate($url.'/'.$random); !!}
{{--                            <p>Scan me to return to the original page.</p>--}} <br><br>
                            <small>url: {{ $url.'/'.$random }}</small>
                        </div>

                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Dispatch <small>info</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label>Driver Name</label>
                            <input type="text" name="driver-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Vehicle Type</label>
                            <input type="text" name="vehicle-type" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Plate No.</label>
                            <input type="text" name="vehicle-plate" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-right" style="width: 120px">Qty</th>
                                    <th class="text-right" style="width: 100px" data-sort-ignore="true"><i class="fa fa-cogs text-success"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->product->display_name }}
{{--                                        <td class="text-right"><input type="text" value="{{ $data->quantity }}" data-id="{{ $data->id }}" class="form-control numonly input-s"></td>--}}
                                        <td class="text-right">{{ $data->quantity }} {{ $data->unit }}</td>
                                        <td class="text-right">
                                            <div class="btn-group text-right">
                                                <a href="" class="action btn-white btn btn-xs"><i class="fa fa-times text-danger"></i> remove</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-right" colspan="3">
                                        <button type="button" class="btn btn-success btn-action" data-action="add-item">Add</button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
{{--    </form>--}}

    <div class="modal inmodal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category="" data-variant="" data-bal="">
        <div id="modal-size">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save-btn">Save changes</button>
                </div>
            </div>
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

            $(document).on('click', '.btn-action', function(){
                switch ($(this).data('action')) {
                    case 'store':
                        // $('#form').submit();
                        var datas = new Array();
                        var inv = new Array();
                        datas.push($('input[name=reference]').val());
                        datas.push($('input[name=url]').val());
                        datas.push($('input[name=driver-name]').val());
                        datas.push($('input[name=vehicle-type]').val());
                        datas.push($('input[name=vehicle-plate]').val());
                        // datas.push($('input[name=]').val());

                        console.log(datas);
                        console.log(inv);

                        {{--$.post('{!! route('trace-store') !!}', {--}}
                        {{--    datas: datas,--}}
                        {{--    inv : inv--}}
                        {{--}, function(data){--}}

                        {{--});--}}

                        break;
                    case 'add-item':
                        addItem();
                        break;
                }
            });

            var modal = $('#modal');
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

            function addItem() {
                modal.find('.modal-title').text('Farmer Inventory');
                modal.find('#modal-size').removeClass().addClass('modal-dialog modal-lg');
                $.get('');
                modal.modal({backdrop: 'static', keyboard: false});
            }

        });
    </script>
@endsection
