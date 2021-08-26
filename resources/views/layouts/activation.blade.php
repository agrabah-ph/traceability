@extends('layouts.app')

@section('content')
    <div class="verify-email-template">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="body">
                            <h1>{{ __('Contact Agrabah Administrator') }}</h1>


                            <p class="text-1">
                                {{ __('Your account dont have access to this application yet, please contact administrator to activate your account.') }}
                            </p>
                            <p class="text-2">{{ __('Thank you') }},</p>

                            <a href="{{ route('logout') }}" class="btn btn-link align-baseline">Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
