@extends('master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
{{--                        {{ $type }}--}}
                    </div>
                    <div class="panel-body">
                        <h2>Head Office</h2>
                        <h4>subdomain: {{ $subdomain }}</h4>
                        <h4>domain: {{ $domain }}</h4>
                        <h4>domain ext: {{ config('dev.domain_ext') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
