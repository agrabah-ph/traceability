@extends(subdomain_name().'.master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')

    <div class="wrapper wrapper-content">

        <div class="row">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-title">

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th colspan="4" class="text-center">Loan Applicants</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(loanStatInfo(Auth::user()->loan_provider->id) as $info)
                                    <tr>
                                        <td>
                                            <small><strong class="stats-label text-success">{{ $info[0][0] }} </strong></small>
                                            <h4>{{ $info[0][1] }} <small>total products</small></h4>
                                        </td>
                                        <td class="text-right">
                                            <small class="stats-label">Pending</small>
                                            <h4>{{ $info[1] }}</h4>
                                        </td>
                                        <td class="text-right">
                                            <small class="stats-label">Active</small>
                                            <h4>{{ $info[2] }}</h4>
                                        </td>
                                        <td class="text-right">
                                            <small class="stats-label">Completed</small>
                                            <h4>{{ $info[3] }}</h4>
                                        </td>
                                        <td class="text-right">
                                            <small class="stats-label">Declined</small>
                                            <h4>{{ $info[4] }}</h4>
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
