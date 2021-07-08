@extends('admin.master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')

    <section class="container animated fadeInRight">
        <div class="row">
{{--            <div class="col-lg-3">--}}
{{--                {!! config('dev.domain_ext') !!}--}}
{{--                <div class="widget style1 blue-bg">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-4 text-center">--}}
{{--                            <i class="fa fa-money fa-5x"></i>--}}
{{--                        </div>--}}
{{--                        <div class="col-8 text-right">--}}
{{--                            <span> Today's income </span>--}}
{{--                            <h2 class="font-bold">4,232</h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg-3">
                <a href="{{ route('farmer.index') }}">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Farmers </span>
                                <h2 class="font-bold">{{ $farmer }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('inventory.index') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-th-list fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Inventories </span>
                                <h2 class="font-bold">{{ $inventory }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('trace.index') }}">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-truck fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Trace </span>
                                <h2 class="font-bold">{{ $trace }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
{{--        <div class="row">--}}

{{--            <div class="col-lg-12">--}}
{{--                <div class="ibox ">--}}
{{--                    <div class="ibox-title">--}}
{{--                        <h5>Trace Report</h5>--}}
{{--                    </div>--}}
{{--                    <div class="ibox-content">--}}

{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-striped">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}

{{--                                    <th>#</th>--}}
{{--                                    <th>Reference </th>--}}
{{--                                    <th>Client Name </th>--}}
{{--                                    <th>Phone </th>--}}
{{--                                    <th>Completed </th>--}}
{{--                                    <th>Task</th>--}}
{{--                                    <th>Status</th>--}}
{{--                                    <th>Date</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}

{{--                                <tr>--}}
{{--                                    <td>4</td>--}}
{{--                                    <td>Gamma project</td>--}}
{{--                                    <td>Anna Jordan</td>--}}
{{--                                    <td>(016977) 0648</td>--}}
{{--                                    <td><span class="pie">4,9</span></td>--}}
{{--                                    <td>18%</td>--}}
{{--                                    <td>Jul 22, 2013</td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
    </section>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-4">
{{--                <div class="panel panel-success">--}}
{{--                    <div class="panel-heading">--}}
{{--                        {{ $type }}--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <h2>Head Office</h2>--}}
{{--                        <h4>subdomain: {{ $subdomain }}</h4>--}}
{{--                        <h4>domain: {{ $domain }}</h4>--}}
{{--                        <h4>domain ext: {{ config('dev.domain_ext') }}</h4>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
    {!! Html::style('/css/template/plugins/morris/morris-0.4.3.min.css') !!}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}
    {!! Html::script('/js/template/plugins/peity/jquery.peity.min.js') !!}

    <script>
        $(document).ready(function(){
            $("span.pie").peity("pie", {
                fill: ['#1ab394', '#d7d7d7', '#ffffff']
            })
            function getTrace(){

            }
        });
    </script>
@endsection
