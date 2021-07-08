@extends(subdomain_name().'.master')

@section('title', 'Loan Applications')

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
{{--            <div class="title-action">--}}
{{--                <a href="#" class="btn btn-primary">This is action area</a>--}}
{{--            </div>--}}
        </div>
    </div>

    <div id="app" class="wrapper wrapper-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
{{--                    <div class="ibox-title">--}}
{{--                        <h5>Blank <small>page</small></h5>--}}
{{--                    </div>--}}
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <div class="loan-product-list project-list">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Applicant</th>
                                        <th class="text-right">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($loans as $loan)
                                    <tr data-id="{{ $loan->id }}">
                                        <td class="project-title">
                                            <a href="project_detail.html">{{ $loan->product->name }}</a>
                                            <br/>
                                            <small>Type: <strong>{{ $loan->product->type->display_name }}</strong></small><br/>
                                            <small>Amount: <span class="money">{{ currency_format($loan->product->amount) }}</span></small><br/>
                                            <small>Term: {{ $loan->product->duration }}mos</small><br/>
                                            <small>Interest: {{ $loan->product->interest_rate }}%</small><br/>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">{{ $loan->borrower->profile->first_name }} {{ $loan->borrower->profile->last_name }}</a>
                                            <br/>
                                            <small>{{ getRoleNameByID($loan->borrower->user_id, 'display_name') }}</small>
                                        </td>
                                        <td class="text-right">{{ $loan->status }}</td>
                                        <td class="project-actions">
                                            @if($loan->status == 'Pending')
                                                <button type="button" class="btn btn-white btn-sm btn-action" data-action="decline"><i class="fa fa-times text-danger"></i> Decline </button>
                                                <button type="button" class="btn btn-white btn-sm btn-action" data-action="approve"><i class="fa fa-thumbs-up text-success"></i> Approve </button>
                                            @endif
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
        </div>

    </div>

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
{{--    {!! Html::script('/js/template/plugins/jqueryMask/jquery.mask.min.js') !!}--}}
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
            // $('.money').mask("#,##0.00", {reverse: true});

            $(document).on('click', '.btn-action', function(){
                var action = $(this).data('action');
                var id = $(this).closest('tr').data('id');
                switch(action){
                    case 'decline':
                        $.get('{!! route('loan-update-status') !!}', {
                            id: id,
                            status: 'Declined'
                        }, function(data){
                            location.reload();
                        });
                        break;
                    case 'approve':
                        $.get('{!! route('loan-update-status') !!}', {
                            id: id,
                            status: 'Active'
                        }, function(data){
                            location.reload();
                        });
                        break;
                }
            });

        });
    </script>
@endsection
