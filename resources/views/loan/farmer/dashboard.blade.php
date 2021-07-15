@extends(subdomain_name().'.master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')

    <section class="container animated fadeInRight">

    </section>

    <div class="wrapper wrapper-content">
        <div class="row">

{{--            <div class="col-lg-4">--}}
{{--                <div class="ibox ">--}}
{{--                    <div class="ibox-content">--}}
{{--                        <h3>Active Loans</h3>--}}
{{--                        <div class="project-list">--}}

{{--                            <table class="table table-hover">--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <div class="project-title">--}}
{{--                                            <a href="project_detail.html">Contract with Zender Company</a>--}}
{{--                                            <br/>--}}
{{--                                            <small>Created 14.08.2014</small>--}}
{{--                                        </div>--}}
{{--                                        <div class="project-completion">--}}
{{--                                            <small>Completion with: 48%</small>--}}
{{--                                            <div class="progress progress-mini">--}}
{{--                                                <div style="width: 48%;" class="progress-bar"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-8">--}}
{{--                <div class="ibox ">--}}
{{--                    <div class="ibox-content">--}}
{{--                        <div id="calendar"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>

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
