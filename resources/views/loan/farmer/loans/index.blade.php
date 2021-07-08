@extends(subdomain_name().'.master')

@section('title', 'My Loans')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-6">
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
        <div class="col-sm-6">
            {{--            <div class="title-action">--}}
            {{--                <a href="#" class="btn btn-primary">This is action area</a>--}}
            {{--            </div>--}}
        </div>
    </div>

    <div id="app" class="wrapper wrapper-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <div class="loan-product-list project-list">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Bank</th>
                                        <th>Loan Name</th>
                                        <th class="text-right">Amount</th>
                                        <th>Interest</th>
                                        <th>Term</th>
                                        <th class="text-right">Total Loan Amount</th>
                                        <th class="text-right">Amortization</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($loans as $loan)
                                        <tr class="d-none">
                                            <td colspan="99">
                                                <pre>{{json_encode($loan,128)}}</pre>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{$loan->provider->profile->bank_name}}
                                                <br/>
                                                <small>Branch:
                                                    <strong>{{ $loan->provider->profile->branch_name }}</strong></small><br/>
                                                <small>Address: <span
                                                            class="">{{ $loan->provider->profile->address_line }}</span></small><br/>
                                            </td>
                                            <td class="project-title">
                                                {{$loan->product->name}}
                                            </td>
                                            <td class="text-right">{{currency_format($loan->product->amount)}}</td>
                                            <td>{{$loan->product->interest_rate}}%</td>
                                            <td>{{$loan->product->duration}} Months</td>
                                            <td class="text-right">{{currency_format(computeAmortization($loan->product->amount, $loan->product->duration, $loan->product->interest_rate, 2) * $loan->product->duration)}}</td>

                                            <td class="text-right">{{currency_format(computeAmortization($loan->product->amount, $loan->product->duration, $loan->product->interest_rate, 2))}}</td>
                                            @if($loan->status == 'Active')
                                                <td class=" text-center text-green">{{$loan->status}}</td>
                                            @elseif($loan->status == 'Pending')
                                                <td class="text-center text-warning">{{$loan->status}}</td>
                                            @else
                                                <td class="text-center text-danger">{{$loan->status}}</td>
                                            @endif
                                            <td class="project-actions">
                                                <a href="#" class="btn btn-white btn-sm sched_modal_trigger"
                                                   data-schedule="{{$loan->payment_schedules}}"><i
                                                            class="fa fa-calendar"></i> Schedules </a>
                                                {{--                                                <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>--}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="empty_row">
                                            <td colspan="99" class="text-center">No Loans Yet</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category=""
         data-variant="" data-bal="">
        <div id="modal-size">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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

    <div class="modal fade" id="sched_modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true"
         data-category="" data-variant="" data-bal="">
        <div id="modal-size" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <h3 class="modal-title">Payment Schedules</h3>
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Due Date</th>
                            <th class="text-right">Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="schedules_tbody">

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
{{--                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary" id="modal-save-btn">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
    {{--    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    {{--    {!! Html::style('/css/template/plugins/sweetalert/sweetalert.css') !!}--}}
    {!! Html::style('/css/template/plugins/sweetalert/sweetalert.css') !!}
@endsection

@section('scripts')
    {{--    {!! Html::script('') !!}--}}
    {!! Html::script('/js/template/plugins/jqueryMask/jquery.mask.min.js') !!}
    {!! Html::script('/js/template/moment.js') !!}
    {!! Html::script('/js/template/numeral.js') !!}
    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}
    {{--    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}--}}
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}--}}
    {{--    {!! Html::script('/js/template/moment.js') !!}--}}
    <script>

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        $(document).on('click', '.sched_modal_trigger', function () {
            var sched_modal = $('#sched_modal');
            sched_modal.modal('show');
            $('#schedules_tbody').empty();
            var data_schedules = $(this).data('schedule')

            if(data_schedules.length < 1){
                let setRows = '<tr>';
                setRows += '<td colspan="99" class="text-center">';
                setRows += "Loan Not Approved yet";
                setRows += '</td>';
                setRows += '</tr>';
                $('#schedules_tbody').append(setRows);
            }
            for (let i = 0; i < data_schedules.length; i++) {
                const dataSchedule = data_schedules[i];

                let setRows = '<tr>';
                setRows += '<td>';
                setRows += dataSchedule.due_date_display;
                setRows += '</td>';
                setRows += '<td class="text-right">';
                setRows += numberWithCommas(dataSchedule.payable_amount);
                setRows += '</td>';
                setRows += '<td>';
                setRows += dataSchedule.status_display;
                setRows += '</td>';
                setRows += '</tr>';
                $('#schedules_tbody').append(setRows);
            }
        });
        $(document).ready(function () {
            // var modal = $('#modal');
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
