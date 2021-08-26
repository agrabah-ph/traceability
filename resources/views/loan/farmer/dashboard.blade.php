@extends(subdomain_name().'.master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="page-dashboard">
            <div class="row list-count space-1">
                <div class="col-12 col-lg-3 col-md-6">
                    <a href="">
                        <div class="box" id="">
                            <div class="item counter-label">
                                <div class="counter-label">Active Loans</div>
                                <div class="counter">0</div>
                            </div>
                            <div class="item">
                                <div class="counter-icon">
                                    <img src="https://img.icons8.com/plasticine/100/000000/bribery.png" class="img-fluid"/>
                                </div>
                            </div>
                            <div class="box-link">View <img src="https://img.icons8.com/ios/20/948b96/long-arrow-right.png" class="img-fluid"/></div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-lg-3 col-md-6">
                    <a href="">
                        <div class="box" id="">
                            <div class="item counter-label">
                                <div class="counter-label">Paid Loans</div>
                                <div class="counter">0</div>
                            </div>
                            <div class="item">
                                <div class="counter-icon">
                                    <img src="https://img.icons8.com/plasticine/100/000000/cash-in-hand.png" class="img-fluid"/>
                                </div>
                            </div>
                            <div class="box-link">View <img src="https://img.icons8.com/ios/20/948b96/long-arrow-right.png" class="img-fluid"/></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row space-1">
                <div class="col-12 col-lg-4">
                    <div class="box list-group">
                        <div class="header-label">
                            <div class="row">
                                <div class="col-6 col-lg-6">
                                    <label>Payment History</label>
                                </div>
                                <div class="col-6 col-lg-6">
                                    {{--<label>Total Product</label>--}}
                                </div>
                            </div>
                        </div>


                        <div class="repeat-container">
                            <div class="repeat-item">
                                <div class="date">TODAY</div>
                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="col-6 col-lg-6">
                                                <div class="text payment-label"><img src="https://img.icons8.com/ios/20/909090/bank-card-back-side.png" alt="icon" class="img-fluid"/> Payment 1</div>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <div class="text text-right">+ 1,000.00 <b>PHP</b></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6 col-lg-6">
                                                <div class="text payment-label"><img src="https://img.icons8.com/ios/20/909090/bank-card-back-side.png" alt="icon" class="img-fluid"/> Payment 2</div>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <div class="text text-right">+ 1,000.00 <b>PHP</b></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="repeat-item">
                                <div class="date">August 18, 2021</div>
                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="col-6 col-lg-6">
                                                <div class="text payment-label"><img src="https://img.icons8.com/ios/20/909090/bank-card-back-side.png" alt="icon" class="img-fluid"/> Payment 3</div>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <div class="text text-right">+ 1,000.00 <b>PHP</b></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6 col-lg-6">
                                                <div class="text payment-label"><img src="https://img.icons8.com/ios/20/909090/bank-card-back-side.png" alt="icon" class="img-fluid"/> Payment 4</div>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <div class="text text-right">+ 1,000.00 <b>PHP</b></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>



                    </div>
                </div>

            </div>


        </div>

        {{--<div class="row">--}}
        {{--<div class="col-12">--}}
        {{--<div class="ibox">--}}
        {{--<div class="ibox-title">--}}

        {{--</div>--}}
        {{--<div class="ibox-content">--}}
        {{--<div class="table-responsive">--}}
        {{--<table class="table table-borderless">--}}
        {{--<thead>--}}
        {{--<tr>--}}
        {{--<th>Product</th>--}}
        {{--<th colspan="4" class="text-center">Loan Applicants</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@foreach(loanStatInfo(Auth::user()->loan_provider->id) as $info)--}}
        {{--<tr>--}}
        {{--<td>--}}
        {{--<small><strong class="stats-label text-success">{{ $info[0][0] }} </strong></small>--}}
        {{--<h4>{{ $info[0][1] }} <small>total products</small></h4>--}}
        {{--</td>--}}
        {{--<td class="text-right">--}}
        {{--<small class="stats-label">Pending</small>--}}
        {{--<h4>{{ $info[1] }}</h4>--}}
        {{--</td>--}}
        {{--<td class="text-right">--}}
        {{--<small class="stats-label">Active</small>--}}
        {{--<h4>{{ $info[2] }}</h4>--}}
        {{--</td>--}}
        {{--<td class="text-right">--}}
        {{--<small class="stats-label">Completed</small>--}}
        {{--<h4>{{ $info[3] }}</h4>--}}
        {{--</td>--}}
        {{--<td class="text-right">--}}
        {{--<small class="stats-label">Declined</small>--}}
        {{--<h4>{{ $info[4] }}</h4>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
        {{--</table>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

    </div>


    {{--<section class="container animated fadeInRight">--}}

    {{--</section>--}}

    {{--<div class="wrapper wrapper-content">--}}
        {{--<div class="row">--}}

            {{--<div class="col">--}}
                {{--<div class="ibox">--}}
                    {{--<div class="ibox-content">--}}
                        {{--<h3>Active Loans</h3>--}}
                        {{--<div class="project-list">--}}

                            {{--<table class="table table-hover table-borderless">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Loan Provider</th>--}}
                                    {{--<th>Loan Type</th>--}}
                                    {{--<th>Loan Amount</th>--}}
                                    {{--<th>Amount Paid</th>--}}
                                    {{--<th>Payment Completion</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <small>China Bank</small>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <small>Short Loan</small>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <small>100,000.00</small>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <small>100,000.00</small>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="project-completion">--}}
{{--                                            <div class="progress progress-mini">--}}
{{--                                                <div style="width: 48%;" class="progress-bar"></div>--}}
{{--                                            </div>--}}
{{--                                            <small>78%</small>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

{{--            <div class="col-lg-8">--}}
{{--                <div class="ibox ">--}}
{{--                    <div class="ibox-content">--}}
{{--                        <div id="calendar"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        {{--</div>--}}
    {{--</div>--}}

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
    {!! Html::style('/css/template/plugins/iCheck/custom.css') !!}
    {!! Html::style('/css/template/plugins/fullcalendar/fullcalendar.css') !!}
    {!! Html::style('/css/template/plugins/fullcalendar/fullcalendar.print.css') !!}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}
    {!! Html::script('/js/template/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('/js/template/plugins/iCheck/icheck.min.js') !!}
{{--    {!! Html::script('/js/template/plugins/fullcalendar/moment.min.js') !!}--}}
    {!! Html::script('/js/template/plugins/fullcalendar/fullcalendar.min.js') !!}
    <script>
        $(document).ready(function() {
            /* initialize the calendar
             -----------------------------------------------------------------*/
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: [
                    {
                        title: 'All Day Event',
                        start: new Date(y, m, 1)
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d-5),
                        end: new Date(y, m, d-2)
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d-3, 16, 0),
                        allDay: false
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d+4, 16, 0),
                        allDay: false
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d+1, 19, 0),
                        end: new Date(y, m, d+1, 22, 30),
                        allDay: false
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://google.com/'
                    }
                ]
            });


        });
    </script>
@endsection
