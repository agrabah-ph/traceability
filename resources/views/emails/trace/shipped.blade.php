@component('mail::message')
# {{ $details['title'] }}

<div style="text-align: center">
    {!! $details['body'] !!}
    <h1 style="text-align: center">{{ $details['code'] }}</h1>
    @if($details['code'] !== '')
    <small>CODE</small><br><br>
    @endif
{{--    <img src="data:image/png;base64,{{ $details['qrcode'] }}" alt="" width="200">--}}
</div>

@component('mail::button', ['url' => $details['url']])
View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
