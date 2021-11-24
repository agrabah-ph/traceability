@extends('layouts.login')

@section('title', 'Farmers Login')

@section('content')
    <div class="ibox-content">
        <div class="text-center">
            <img src="{{ URL::to('/images/logo.png') }}" alt="agrabah-logo" class="logo img-fluid mt-3" width="250">
        </div>
    </div>

    <section class="container text-center">

{{--        <div id="app">--}}
{{--            <div id="qr-reader" style="width:400px"></div>--}}

{{--            <input type="text" id="FarmerBarcode" name="FarmerBarcode" value="" autocomplete="off" spellcheck="false" placeholder="Farmer Barcode">--}}
{{--        </div>--}}

        <div class="farmer-login mt-5">
                <form action="{!! route('farmer-login-form') !!}" method="post" id="form"> @csrf
                    <div class="form-group">
                        <i class="fa fa-qrcode text-success" id="scan-qr" style="font-size: 44px; cursor: pointer;"></i>
                    </div>
                    <div class="form-group mb-5">
    {{--                    <input type="text" name="farmer-id" class="form-control text-center">--}}
                        <div class="error-bag"></div>
                        @if($errors->has('farmer'))
                            <span class="text-danger">{{$errors->first('farmer')}}</span>
                        @endif
                        {{Form::text('farmer',null, array('class'=>'form-control numonly', 'id'=>'farmer-id-input', 'autofocus'))}}
                        <label><strong class="text-uppercase">Farmer ID</strong></label>
                    </div>

                </form>
                <button type="button" class="btn btn-block btn-xl btn-success p-3 btn-action">PROCEED</button>

                <div class="mt-1">
                    <a href="{{ route('home') }}" class="btn btn-block btn-info p-3">DASHBOARD</a>
                </div>

        </div>
    </section>

    <div class="modal inmodal fade" id="modal" ref="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category="" data-variant="" data-bal="">
        <div id="modal-size">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div id="qr-reader" style="width:300px"></div>
                    <div id="qr-reader-results"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('styles')
    {{--{!! Html::style('') !!}--}}
@endsection

@section('scripts')
{{--        {!! Html::script('https://unpkg.com/vue-qrcode-reader@3.0.3/dist/VueQrcodeReader.umd.min.js') !!}--}}

{{--        <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>--}}
        {!! Html::script('/js/html5-qrcode.min.js') !!}
    <script>
        $(document).ready(function(){
            var modal = $('#modal');
            var resultContainer = $('#qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    console.log(`Scan result ${decodedText}`, decodedResult);
                    resultContainer.text(decodedText);
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 250 }
            );

            $(document).on('click', '#scan-qr', function(){
                console.log('modal click');
                modal.data('type', 'qr-scan');
                // modal.data('id', id);
                modal.data('variant', 'farmer-inventory');
                modal.find('.modal-title').text('Scan QR Code');
                modal.find('#modal-size').removeClass().addClass('modal-dialog modal-sm');
                // modal.find('.modal-body').empty().append('' +
                //     '<div id="qr-reader" style="width:300px"></div>' +
                //     '<div id="qr-reader-results"></div>' +
                // '');

                modal.modal({backdrop: 'static', keyboard: false});
            });

            $(document).on('shown.bs.modal', function (event) {
                switch (modal.data('type')) {
                    case 'qr-scan':
                        modal.find('.modal-header').hide();
                        modal.find('.modal-footer').hide();
                        html5QrcodeScanner.render(onScanSuccess);
                        break;
                }
            });

            $(document).on('hidden.bs.modal', function (event) {
                switch (modal.data('type')) {
                    case 'qr-scan':
                        modal.find('.modal-header').show();
                        modal.find('.modal-footer').show();
                        break;
                }
            });

            $(document).on('click', '#modal-save-btn', function(){
                $('#farmer-id-input').val($('#scan-result').text());
                modal.modal('toggle');
            });

            $('.form-control').keydown(function(event){
                if(event.keyCode === 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $(document).on('click', '.btn-action', function(){
                console.log(validateFarmer());
                if(validateFarmer()[0] > 0){
                    console.log(validateFarmer()[0]);
                    $('.error-bag').empty().append('<span class="text-danger">'+ validateFarmer()[1] +'</span>');
                    return false;
                }
                $('#form').submit();
            });

            function validateFarmer() {
                var error = 0, errorMge = null, result = new Array();
                jQuery.ajaxSetup({async: false});
                $.get('{!! route('farmer-check') !!}', {
                    id: $('input[name=farmer]').val()
                }, function(data){
                    console.log(data);
                    if(data){
                        if(data.profile === null){
                            error += 1;
                            errorMge = 'Farmer need Account setup first';
                        }
                    }else{
                        error += 1;
                        errorMge = 'Farmer not exists!';
                    }
                });
                result.push(error, errorMge);
                return result;
            }

        });
    </script>
@endsection
