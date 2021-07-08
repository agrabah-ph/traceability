@extends('layouts.loan-provider-info')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Create Profile')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">

                <form id="form" action="{{ route('loan-provider-profile-store') }}" method="post" class="wizard-big">
                    @csrf
                    <h1>Profile</h1>
                    <fieldset>
                        <h2>Personal Information</h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>First name *</label>
                                    <input name="first_name" type="text" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label>Middle name *</label>
                                    <input name="middle_name" type="text" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label>Last name *</label>
                                    <input name="last_name" type="text" class="form-control required">
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <h1>Bank</h1>
                    <fieldset>
                        <h2>Bank Information</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Bank name *</label>
                                    <input name="bank_name" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Branch name *</label>
                                    <input name="branch_name" type="text" class="form-control required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address line *</label>
                                    <input name="address_line" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Account name *</label>
                                    <input name="account_name" type="text" class="form-control required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Account number *</label>
                                    <input name="account_number" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>TIN no. *</label>
                                    <input name="tin" type="text" class="form-control required">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h1>Additional</h1>
                    <fieldset>
                        <h2>Additional Information</h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Contact person *</label>
                                    <input name="contact_person" type="text" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label>Contact number *</label>
                                    <input name="contact_number" type="text" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label>Designation *</label>
                                    <input name="designation" type="text" class="form-control required">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h1>Finish</h1>
                    <fieldset>
                        <h2>Terms and Conditions</h2>
                        <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
    {!! Html::style('/css/app.css') !!}
    {!! Html::style('/css/template/style.css') !!}
    {!! Html::style('/css/template/plugins/iCheck/custom.css') !!}
    {!! Html::style('/css/template/plugins/steps/jquery.steps.css') !!}
    {{--{!! Html::style('/js/template/plugins/') !!}--}}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}

    <script src="{{ URL::to('/js/app.js') }}"></script>
    <script src="{{ URL::to('/js/template/inspinia.js') }}"></script>
    <script src="{{ URL::to('/js/template/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    {!! Html::script('/js/template/plugins/iCheck/icheck.min.js') !!}
    {!! Html::script('/js/template/plugins/steps/jquery.steps.min.js') !!}
    {!! Html::script('/js/template/plugins/validate/jquery.validate.min.js') !!}
    {!! Html::script('/js/template/plugins/slimscroll/jquery.slimscroll.min.js') !!}

    <script>
        $(document).ready(function(){
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);
                    // Submit form input
                    form.submit();
                }
            }).validate({
                errorPlacement: function (error, element)
                {
                    element.before(error);
                }
            });

            $('#acceptTerms').iCheck({
                checkboxClass: 'icheckbox_square-green'
            });

        });
    </script>
@endsection
