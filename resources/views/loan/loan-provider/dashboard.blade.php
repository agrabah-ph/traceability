@extends(subdomain_name().'.master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')

    <section class="container animated fadeInRight">
        @if (is_null(Auth::user()->provider))
            <h1>none</h1>
            @else
            <h1>done</h1>
        @endif
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
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
