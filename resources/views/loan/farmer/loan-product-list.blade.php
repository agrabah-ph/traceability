@extends(subdomain_name().'.master')

@section('title', 'Loan Products')

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

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="status">Loan Type</label>
                        <select name="type" class="form-control loan_input">
                            <option value="" selected>Select type</option>
                            @foreach($loanTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="col-form-label" for="product_name">Loan Term</label>
                        <input type="number" name="term" value="" placeholder="How many months?" class="form-control loan_input">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="col-form-label" for="price">Loanable Amount</label>
                        <input type="text" name="amount" value="" placeholder="Enter Amount" class="form-control money loan_input">
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <div class="loan-product-list project-list">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Lending Partner</th>
                                        <th>Interest</th>
                                        <th>Term</th>
                                        <th class="text-right">Max Loan Amount</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="project-title">
                                            <a href="project_detail.html">Contract with Zender Company</a>
                                            <br/>
                                            <small>Created 14.08.2014</small>
                                        </td>
                                        <td>Interest</td>
                                        <td>Terms</td>
                                        <td>Amount</td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category="" data-variant="" data-bal="">
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
    <div class="view-modal-layout d-none ">
        <div class="ibox">
{{--            <div class="ibox-content">--}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-b-md">
        {{--                    <a href="#" class="btn btn-white btn-xs float-right">Edit project</a>--}}
                            <h2 class="loan-name">Loan product name</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
{{--                        <dl class="row mb-0">--}}
{{--                            <div class="col-sm-6 text-sm-right">--}}
{{--                                <dt>Status:</dt>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6 text-sm-left">--}}
{{--                                <dd class="mb-1 loan-status">--}}
{{--                                    <span class="label label-primary">Active</span>--}}
{{--                                </dd>--}}
{{--                            </div>--}}
{{--                        </dl>--}}
                        <dl class="row mb-0">
                            <div class="col-sm-6 text-sm-right">
                                <dt>Bank:</dt>
                            </div>
                            <div class="col-sm-6 text-sm-left">
                                <dd class="mb-1 loan-provider">Alex Smith</dd>
                            </div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col-sm-6 text-sm-right">
                                <dt>Amount:</dt>
                            </div>
                            <div class="col-sm-6 text-sm-left">
                                <dd class="mb-1 loan-amount"> 30,000</dd>
                            </div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col-sm-6 text-sm-right">
                                <dt>Terms:</dt>
                            </div>
                            <div class="col-sm-6 text-sm-left">
                                <dd class="mb-1 loan-terms"> 6 Months</dd>
                            </div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col-sm-6 text-sm-right">
                                <dt>Interest:</dt>
                            </div>
                            <div class="col-sm-6 text-sm-left">
                                <dd class="mb-1 loan-interest"> 10%</dd>
                            </div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col-sm-6 text-sm-right">
                                <dt>Monthly Rate:</dt>
                            </div>
                            <div class="col-sm-6 text-sm-left">
                                <dd class="mb-1 loan-amor"> </dd>
                            </div>
                        </dl>

                    </div>
                    <div class="col-lg-6" id="cluster_info">

                        <dl class="row mb-0">
                            <div class="col-sm-6 text-sm-right">
                                <dt>Type:</dt>
                            </div>
                            <div class="col-sm-6 text-sm-left">
                                <dd class="mb-1 loan-type"> Short Term</dd>
                            </div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col-sm-6 text-sm-right">
                                <dt>Payment:</dt>
                            </div>
                            <div class="col-sm-6 text-sm-left">
                                <dd class="project-people mb-1">
                                    <span class="badge badge-primary">Manual</span>
                                    <span class="badge badge-primary">GCash</span>
                                    <span class="badge badge-primary">Palawan</span>
                                    <span class="badge badge-primary">Bank</span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
{{--            </div>--}}
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
        $(document).ready(function(){
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


            // $('.money').mask("#,##0.00", {reverse: true});

            getList(null, null, null);

            $(document).on('change keyup', '.loan_input', function(){
                getList($('select[name=type]').val(), $('input[name=term]').val(), $('input[name=amount]').val());
            });

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $(document).on('click', '.show_loan', function(){

                var name = $(this).data('name');
                var provider = $(this).data('provider');
                var amount = $(this).data('amount');
                var type = $(this).data('type');
                var duration = $(this).data('duration');
                var interest_rate = $(this).data('interest_rate');

                var  title = 'Loan Product 1';
                modal.find('#modal-size').removeClass().addClass('modal-dialog modal-lg');
                modal.find('.modal-title').text(title);
                modal.find('#modal-save-btn').addClass('d-none');

                var loan_view_layout = $('.view-modal-layout').clone().removeClass('d-none')
                var lvl_name = loan_view_layout.find('.loan-name');
                var lvl_status = loan_view_layout.find('.loan-status');
                var lvl_provider = loan_view_layout.find('.loan-provider');
                var lvl_amount = loan_view_layout.find('.loan-amount');
                var lvl_terms = loan_view_layout.find('.loan-terms');
                var lvl_type = loan_view_layout.find('.loan-type');
                var lvl_interest = loan_view_layout.find('.loan-interest');
                var lvl_amor = loan_view_layout.find('.loan-amor');

                lvl_name.html(name);
                // lvl_status.text.name);
                lvl_provider.text(provider);
                lvl_amount.text(amount);
                lvl_terms.text(duration);
                lvl_type.text(type);
                lvl_interest.text(interest_rate);
                var loan_amor = (amount/interest_rate) * duration;
                lvl_amor.text(numberWithCommas(loan_amor));
                /**
                 * amount: 30000
                 created_at: "2021-07-06T13:59:53.000000Z"
                 description: "et"
                 duration: 29
                 id: 1
                 interest_rate: 64
                 loan_provider_id: 1
                 loan_type_id: 2
                 name: "Loan Product 1"
                 provider:
                 account_id: "00001"
                 created_at: "2021-07-06T13:59:53.000000Z"
                 id: 1
                 profile: {id: 21, model_id: 1, model_type: "App\\LoanProvider", first_name: "Emory", middle_name: "Hartmann", …}
                 updated_at: "2021-07-06T13:59:53.000000Z"
                 user_id: 22
                 __proto__: Object
                 type:
                 created_at: "2021-07-06T13:59:53.000000Z"
                 display_name: "Long Term Loan"
                 id: 2
                 name: "long-term-loan"
                 updated_at: "2021-07-06T13:59:53.000000Z"
                 __proto__: Object
                 updated_at: "2021-07-06T13:59:53.000000Z"
                 */

                modal.find('.modal-body').empty().append(loan_view_layout.html());
                modal.modal('show');
            });

            $(document).on('click', '.btn-action', function(){
                var loanProductID = $(this).data('id');
                switch($(this).data('action')){
                    case 'apply-loan':
                        swal({
                            title: "Are you sure?",
                            text: "Your loan application will be submitted!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes!",
                            cancelButtonText: "No!",
                            closeOnConfirm: true,
                            closeOnCancel: true },
                        function (isConfirm) {
                            if (isConfirm) {
                                $.get('{!! route('loan-apply') !!}', {
                                    id: loanProductID
                                }, function(data){
                                    console.log('success');
                                    console.log(data);
                                });
                            } else {
                                swal("Cancelled", "Loan application cancelled", "error");
                            }
                        });
                        break;
                }
            });

            function getList(type, term, amount){
                console.log('type: '+ type);
                console.log('term: '+ term);
                console.log('amount: '+ numeral(amount).format('0'));
                var list = new Array();
                jQuery.ajaxSetup({async:false});
                $.get('{!! route('loan-product-list-get') !!}', {
                    type: type,
                    term: term,
                    amount: amount
                }, function(data){
                    // console.log(data);
                    for(var a = 0; a < data.length; a++){
                        list.push('' +
                            '<tr>' +
                                '<td class="project-title">' +
                                    '<a href="#">'+ data[a].provider.profile.bank_name +'</a>' +
                                    '<br/>' +
                                    '<small>'+ data[a].type.display_name +'</small>' +
                                '</td>' +
                                '<td>'+ data[a].interest_rate +'%</td>' +
                                '<td>'+ data[a].duration +' day/s</td>' +
                                '<td class="text-right">'+ numeral(data[a].amount).format('0,0.00') +'</td>' +
                                '<td class="project-actions">' +
                                    '<a href="#" class="btn btn-white btn-sm show_loan" data-name="'+data[a].name+'" data-provider="'+data[a].provider.profile.bank_name+'" data-amount="'+data[a].amount+'" data-type="'+data[a].type.display_name+'" data-duration="'+data[a].duration+'" data-interest_rate="'+data[a].interest_rate+'"><i class="fa fa-search"></i> View </a>' +
                                    '<button type="button" class="btn btn-white btn-sm btn-action" data-action="apply-loan" data-id="'+ data[a].id +'"><i class="fa fa-check"></i> Apply </button>' +
                                '</td>' +
                            '</tr>' +
                        '');
                    }
                });
                $('.loan-product-list').find('tbody').empty().append(list.join(''));
            }

        });
    </script>
@endsection
