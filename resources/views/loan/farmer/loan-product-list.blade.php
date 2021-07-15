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
                <div class="col-sm-3">
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
                        <span id="term_value" class="float-right mt-2"></span>
                        <label class="col-form-label" for="product_name">Loan Term</label>
                        <div id="term_slider"></div>
                        {{--                        <input type="range" name="term" min="4" max="60" value="4" placeholder="How many months?" class="form-control loan_input">--}}
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <span id="amount_value" class="float-right mt-2"></span>
                        <label class="col-form-label" for="price">Loanable Amount</label>
                        <div id="amount_slider"></div>
                        {{--                        <input type="range" name="amount"  value="" placeholder="Enter Amount" class="form-control money loan_input">--}}
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
                                        <th>Loan Product Name</th>
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
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View
                                            </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit
                                            </a>
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

    <div class="modal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category=""
         data-variant="" data-bal="">
        <div id="modal-size">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
    <div class="modal fade" id="application_modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true"
         data-category="" data-variant="" data-bal="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('loan-submit-form')}}" method="post">
                <input type="hidden" name="id" id="loan_submit_id">
                @csrf
                <div class="modal-header" style="padding: 15px;">
                    <h4 class="modal-title">Loan Application Form</h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <pre class="d-none">{{json_encode($farmer, 128)}}</pre>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>First name</label>
                                {{ Form::text('first_name', $farmer->profile->first_name, array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Middle name</label>
                                {{ Form::text('middle_name', $farmer->profile->middle_name, array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Last name</label>
                                {{ Form::text('last_name', $farmer->profile->last_name, array('class'=>'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                {{ Form::text('dob', $farmer->profile->dob, array('class'=>'form-control datepicker')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Place of Birth</label>
                                {{ Form::text('pob', $farmer->profile->pob, array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Gender</label>
                                {{ Form::select('gender',  ['M'=>'Male','F'=>'Female'], $farmer->profile->gender, array('class'=>'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Civil Status</label>
                                {{ Form::select('civil_status',  ['single'=>'Single','married'=>'Married','separated'=>'Separated','annulled_divorced'=>'Annulled/Divorced','widower'=>'Window/er'], $farmer->profile->civil_status, array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Citizenship</label>
                                {{ Form::text('citizenship', $farmer->profile->citizenship, array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Address</label>
                                {{ Form::textarea('address', $farmer->profile->address, array('class'=>'form-control','rows'=>3,'style'=>'resize:none')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Mobile</label>
                                {{ Form::text('mobile', $farmer->profile->mobile, array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Email</label>
                                {{ Form::text('email', $farmer->user->email, array('class'=>'form-control','disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Gross Monthly Income</label>
                                {{ Form::text('gross_monthly_income', $farmer->profile->gross_monthly_income, array('class'=>'form-control ')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Estimate Monthly Expenses</label>
                                {{ Form::text('monthly_expenses', $farmer->profile->monthly_expenses, array('class'=>'form-control ')) }}
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="bg-muted p-4">
                                <strong>Naiintindihan ng humihiram na eto ay market testing sa pakikipag ugnayan ng Agrabah at CARD BDSFI na kung saan:</strong>
                                <br>
                                <br>
                                <p>1. Eto ay pilot testing/market testing na kung saan maaring one time lang ang pag hiram at ang mga susunod na pag hiram ay sa CARD BANK or ibang insitutition na ng CARD MRI pwedeng gawin</p>
                                <p>2. Ang hinihiram ay babayaran sa loob ng tatlong (3) buwan na may voluntary contribution na 2.5% ng prinsipal kada buwan, Kaugnay nito kung may pambayad na ang humihiram bago sumapit ang ikatlong buwan, maari nila itong bayaran ng buo or "partial"</p>

                                <p>3. Pumapayag at naiintindihan ng humihiram na ang disbursement at collection ay via Konect2 CARD, CARD Sulit Padala or GCASH. Ang ACCOUNT Number ng CARD BDSFI na kung saan maari itong bayaran ay ibibigay sa humhiram matapos "madisburse" and pera."</p>
                                <div class="text-center"><label><input type="checkbox" class="" id="terms_agree"> Naiintindihan</label></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button  class="btn btn-primary" disabled id="submit_app_loan">Submit</button>
                </div>
                </form>
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
                            <dd class="mb-1 loan-amor"></dd>
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
    {!! Html::style('/css/template/plugins/nouslider/jquery.nouislider.css') !!}
    {!! Html::style('/css/template/plugins/datapicker/datepicker3.css') !!}

@endsection

@section('scripts')
    {{--    {!! Html::script('') !!}--}}
    {!! Html::script('/js/template/plugins/jqueryMask/jquery.mask.min.js') !!}
    {!! Html::script('/js/template/moment.js') !!}
    {!! Html::script('/js/template/numeral.js') !!}
    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}
    {!! Html::script('/js/template/plugins/nouslider/jquery.nouislider.min.js') !!}
    {!! Html::script('/js/template/plugins/datapicker/bootstrap-datepicker.js') !!}

    {{--    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}--}}
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}--}}
    {{--    {!! Html::script('/js/template/moment.js') !!}--}}
    <script>
        $(document).on('click', '.show_application', function () {
            $('#application_modal').modal('show');
            $('#loan_submit_id').val($(this).data('id'))
        });
        $(document).on('change', '#terms_agree', function () {

            $('#submit_app_loan').prop('disabled', !this.checked);
        });

        $(document).ready(function () {


            var mem = $('.datepicker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'yyyy-mm-dd',
                placement: 'bottom',
                startView: 2
            });

            var modal = $('#modal');

            var term_slider = document.getElementById('term_slider');

            noUiSlider.create(term_slider, {
                start: 80,
                behaviour: 'tap',
                connect: 'lower',
                step: 1,
                range: {
                    'min': 2,
                    'max': 90
                },
                format: {
                    // 'to' the formatted value. Receives a number.
                    to: function (value) {
                        return parseInt(value);
                    },
                    // 'from' the formatted value.
                    // Receives a string, should return a number.
                    from: function (value) {
                        return parseInt(value);
                    }
                }
            });
            $('#term_value').html(term_slider.noUiSlider.get());
            term_slider.noUiSlider.on('slide', function () {
                $('#term_value').html(term_slider.noUiSlider.get())
                getList($('select[name=type]').val(), term_slider.noUiSlider.get(), range_slider.noUiSlider.get())
            });

            var range_slider = document.getElementById('amount_slider');

            noUiSlider.create(range_slider, {
                start: [10000, 500000],
                behaviour: 'drag',
                connect: true,
                range: {
                    'min': 10000,
                    'max': 1000000
                },
                step: 10000,
                format: {
                    // 'to' the formatted value. Receives a number.
                    to: function (value) {
                        return parseInt(Math.round(value));
                    },
                    // 'from' the formatted value.
                    // Receives a string, should return a number.
                    from: function (value) {
                        return parseInt(Math.round(value));
                    }
                }
            });

            var range_value = range_slider.noUiSlider.get();
            $('#amount_value').html(numberWithCommas(range_value[0]) + " - " + numberWithCommas(range_value[1]));
            range_slider.noUiSlider.on('slide', function () {
                var range_value = range_slider.noUiSlider.get();
                $('#amount_value').html(numberWithCommas(range_value[0]) + " - " + numberWithCommas(range_value[1]));
                getList($('select[name=type]').val(), term_slider.noUiSlider.get(), range_value)
            });


            // var term_slider = document.getElementById("term_slider");
            // var term_value = document.getElementById("term_value");
            // term_value.innerHTML = term_slider.value; // Display the default slider value
            // term_slider.oninput = function() {
            //     term_value.innerHTML = this.value;
            // }
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

            $(document).on('change keyup', '.loan_input', function () {
                getList($('select[name=type]').val(), $('input[name=term]').val(), $('input[name=amount]').val());
            });

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $(document).on('click', '.show_loan', function () {

                var name = $(this).data('name');
                var provider = $(this).data('provider');
                var amount = $(this).data('amount');
                var type = $(this).data('type');
                var duration = $(this).data('duration');
                var interest_rate = $(this).data('interest_rate');

                var title = 'Loan Product 1';
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
                var loan_amor = (amount / interest_rate) * duration;
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

            $(document).on('click', '.btn-action', function () {
                var loanProductID = $(this).data('id');
                switch ($(this).data('action')) {
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
                                closeOnCancel: true
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                                    $.get('{!! route('loan-apply') !!}', {
                                        id: loanProductID
                                    }, function (data) {
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

            function getList(type, term, amount) {
                console.log('type: ' + type);
                console.log('term: ' + term);
                console.log('amount: ' + numeral(amount).format('0'));
                var list = new Array();
                jQuery.ajaxSetup({async: false});
                $.get('{!! route('loan-product-list-get') !!}', {
                    type: type,
                    term: term,
                    amount: amount
                }, function (data) {
                    // console.log(data);
                    for (var a = 0; a < data.length; a++) {
                        list.push('' +
                            '<tr>' +
                            '<td>' + data[a].name + '</td>' +
                            '<td class="project-title">' +
                            '<a href="#">' + data[a].provider.profile.bank_name + '</a>' +
                            '<br/>' +
                            '<small>' + data[a].type.display_name + '</small>' +
                            '</td>' +
                            '<td>' + data[a].interest_rate + '%</td>' +
                            '<td>' + data[a].duration + ' ' + data[a].timing_name + '</td>' +
                            '<td class="text-right">' + numeral(data[a].amount).format('0,0.00') + '</td>' +
                            '<td class="project-actions">' +
                            '<a href="#" class="btn btn-white btn-sm show_loan" data-name="' + data[a].name + '" data-provider="' + data[a].provider.profile.bank_name + '" data-amount="' + data[a].amount + '" data-type="' + data[a].type.display_name + '" data-duration="' + data[a].duration + '" data-interest_rate="' + data[a].interest_rate + '"><i class="fa fa-search"></i> View </a>' +
                            '<button type="button" class="btn btn-white btn-sm show_application" data-action="apply-loan" data-id="' + data[a].id + '"><i class="fa fa-check"></i> Apply </button>' +
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
