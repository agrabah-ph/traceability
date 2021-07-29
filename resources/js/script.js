$(document).on('click', '.btn-logout', function(event){
    event.preventDefault();
    $('#form-logout').submit();
    // var url = window.location.origin;
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // $.post(url +'/logout', function(){
    //     console.log('success logout!');
    //     window.location.reload();
    //     window.location.replace(url);
    // });
});

$(document).on('select2_modal:open', () => {
    document.querySelector('.select2-search__field').focus();
});


$(document).on('keydown','.numonly',function(event) {
    // Allow: backspace, delete, tab, escape, and enter
    if( event.keyCode === 46 || event.keyCode === 8 || event.keyCode === 9 || event.keyCode === 27 || event.keyCode === 13 ||
        // Allow: Num Pad Decimal
        ( event.keyCode === 190 ) ||
        ( event.keyCode === 110 ) ||
        // Allow: Ctrl+A
        (event.keyCode === 65 && event.ctrlKey === true) ||
        // Allow: home, end, left, right
        (event.keyCode >= 35 && event.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }else{
        // Ensure that it is a number and stop the keypress
        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault();
        }
    }
});

function getAge(dob){
    dob = new Date(dob);
    var today = new Date();
    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
    return age;
}

function numFormat(yourNumber) {
    //Seperates the components of the number
    var n= yourNumber.toString().split(".");
    //Comma-fies the first part
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //Combines the two sections
    return n.join(".");
}


$(document).ready(function(){
    $('.password-field').after('<span toggle=".password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>');

    $('.toggle-password').click(function() {
        $(this).toggleClass('fa-eye fa-eye-slash');
        // var input = $($(this).attr('toggle'));
        var input = $(this).closest('.form-group').find('.password-field');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });

    window.displayLoanApplicationDetails = function (profile, loanDetail){
        console.log(profile);
        console.log(loanDetail);
        var dependents = new Array();
        if(profile.secondary_info[3][2] !== null){
            for(var a = 0; a < profile.secondary_info[3][2].length; a++){
                dependents.push('' +
                    '<tr>' +
                        '<td>'+ profile.secondary_info[3][2][a][0] +'</td>' +
                        '<td>'+ profile.secondary_info[3][2][a][1] +'</td>' +
                    '</tr>' +
                '');
            }
        }
        var groups = new Array();
        for(var a = 2; a < profile.farming_info.length; a++){
            if(profile.farming_info[a][2] === "1"){
                groups.push('' +
                    '<li>'+ profile.farming_info[a][1] +'</li>' +
                '');
            }
        }
        var landlord = (profile.secondary_info[2][2] === 'Rented') ? '<dl><dt>Landlords Address</dt><dd>'+ profile.secondary_info[2][3][0] +'</dd></dl><dl><dt>Landlords Contact No.</dt><dd>'+ profile.secondary_info[2][3][1] +'</dd></dl>' : '';
        dependents = (profile.secondary_info[3][2] !== null) ? dependents.join('') : '' +
            '<tr>' +
            '<td colspan="2" class="text-center">None</td>' +
            '</tr>' +
        '';

        var rowAAIncome = parseInt(profile.income_asset_info[0][2]);
        var rowABIncome = parseInt(profile.income_asset_info[1][2]);

        var rowBAIncome = parseInt(profile.income_asset_info[2][2]);
        var rowBBIncome = parseInt(profile.income_asset_info[3][2]);

        var rowCIncome = parseInt(profile.income_asset_info[4][2]);
        var rowDIncome = parseInt(profile.income_asset_info[5][2]);

        var rowEExpense = parseInt(profile.income_asset_info[6][2]);
        var rowFExpense = parseInt(profile.income_asset_info[7][2]);

        var rowASum = 0;
        var rowBSum = 0;
        var rowABCDSum = 0;
        var rowEFSum = 0;
        var totalIncomeSum = 0;

        rowASum += rowAAIncome;
        rowASum += rowABIncome;

        rowBSum += rowBAIncome;
        rowBSum += rowBBIncome;

        rowABCDSum += rowAAIncome;
        rowABCDSum += rowABIncome;
        rowABCDSum += rowBAIncome;
        rowABCDSum += rowBBIncome;
        rowABCDSum += rowCIncome;
        rowABCDSum += rowDIncome;

        rowEFSum += rowEExpense;
        rowEFSum += rowFExpense;

        totalIncomeSum += rowABCDSum;
        totalIncomeSum -= rowEFSum;

        var loanDetailMenu = '';
        var loanDetailContent = '';
        if(loanDetail !== null){
            loanDetailMenu = '' +
                '<li><a class="nav-link" data-toggle="tab" href="#tab-5">Loan Details</a></li>' +
            '';

            var loanPurpose = new Array();
            for(var a = 0; a < loanDetail.info_loan_detail[0][1].length; a++){
                loanPurpose.push('' +
                    '<li>'+ loanDetail.info_loan_detail[0][1][a] +'</li>' +
                '');
            }
            loanPurpose = loanPurpose.join('');

            var placeUse = new Array();
            for(var a = 0; a < loanDetail.info_loan_detail[1][1].length; a++){
                placeUse.push('' +
                    '<li>'+ loanDetail.info_loan_detail[1][1][a] +'</li>' +
                '');
            }
            placeUse = placeUse.join('');

            var bankAccount = '';
            if(loanDetail.credit_financial_info[0][1].length > 0){
                bankAccount = new Array();
                for(var a = 0; a < loanDetail.credit_financial_info[0][1].length; a++){
                    bankAccount.push('' +
                        '<tr>' +
                        '<td>'+ loanDetail.credit_financial_info[0][1][a][0][1] +'</td>' +
                        '<td>'+ loanDetail.credit_financial_info[0][1][a][1][1] +'</td>' +
                        '</tr>' +
                    '');
                }
                bankAccount = bankAccount.join('');
            }

            var creditRef = '';
            if(loanDetail.credit_financial_info[1][1].length > 0){
                creditRef = new Array();
                for(var a = 0; a < loanDetail.credit_financial_info[1][1].length; a++){
                    creditRef.push('' +
                        '<tr>' +
                        '<td>'+ loanDetail.credit_financial_info[1][1][a][0][1] +'</td>' +
                        '<td>'+ loanDetail.credit_financial_info[1][1][a][1][1] +'</td>' +
                        '</tr>' +
                    '');
                }
                creditRef = creditRef.join('');
            }

            var tradeRef = '';
            if(loanDetail.trade_reference_info[0][1].length > 0){
                tradeRef = new Array();
                for(var a = 0; a < loanDetail.trade_reference_info[0][1].length; a++){
                    tradeRef.push('' +
                        '<tr>' +
                        '<td>'+ loanDetail.trade_reference_info[0][1][a][0][1] +'</td>' +
                        '<td>'+ loanDetail.trade_reference_info[0][1][a][1][1] +'</td>' +
                        '<td>'+ loanDetail.trade_reference_info[0][1][a][2][1] +'</td>' +
                        '</tr>' +
                    '');
                }
                tradeRef = tradeRef.join('');
            }



            // var collateral = (loanDetail.info_loan_detail[2][1][0] === 'Motor Vehicle') ? '' +
            //     '<dd>'+ loanDetail.info_loan_detail[2][1][0] +' : '+ loanDetail.info_loan_detail[2][1][1][1] +' <small>['+ loanDetail.info_loan_detail[2][1][1][0] +']</small></dd>' +
            //     '' : '' +
            //
            //     '<dd>'+ loanDetail.info_loan_detail[2][1][0] +' : '+ loanDetail.info_loan_detail[2][1][1][0] +'</dd>' +
            //     '';
            var collateral = null;
            switch(loanDetail.info_loan_detail[2][1][0]){
                case 'Motor Vehicle':
                    collateral = '<dd>'+ loanDetail.info_loan_detail[2][1][0] +' : '+ loanDetail.info_loan_detail[2][1][1][1] +' <small>['+ loanDetail.info_loan_detail[2][1][1][0] +']</small></dd>';
                    break;
                case 'None':
                    collateral = '<dd>'+ loanDetail.info_loan_detail[2][1][0] +'</dd>';
                    break;
                default:
                    collateral = '<dd>'+ loanDetail.info_loan_detail[2][1][0] +' : '+ loanDetail.info_loan_detail[2][1][1][0] +'</dd>';
                    break;
            }


            loanDetailContent = '' +
                '<div role="tabpanel" id="tab-5" class="tab-pane">' +
                    '<div class="panel-body">' +
                        '<h2 class="text-success"><strong>Loan Details</strong></h2>' +
                        '<div class="row">' +
                            '<div class="col">' +
                                '<dl>' +
                                    '<dt>Purpose of Loan</dt>' +
                                    '<dd>' +
                                        '<ul class="list-inline-item">'+ loanPurpose +'</ul>' +
                                    '</dd>' +
                                '</dl>' +
                            '</div>' +
                            // '<div class="col">' +
                            //     '<dl>' +
                            //         '<dt>Primary User</dt>' +
                            //         '<dd>'+ loanDetail.info_loan_detail[1][1][0] +'</dd>' +
                            //     '</dl>' +
                            //     '<dl>' +
                            //         '<dt>Relationship to Applicant</dt>' +
                            //         '<dd>'+ loanDetail.info_loan_detail[2][1][0] +'</dd>' +
                            //     '</dl>' +
                            // '</div>' +
                        '</div>' +
                        '<div class="row">' +
                            '<div class="col">' +
                                '<dl>' +
                                    '<dt>Place of use</dt>' +
                                    '<dd>' +
                                        '<ul class="list-inline-item">'+ placeUse +'</ul>' +
                                    '</dd>' +
                                '</dl>' +
                            '</div>' +
                            '<div class="col">' +
                                '<dl>' +
                                    '<dt>Collateral</dt>' +
                                    '<dd>'+ collateral +'</dd>' +
                                '</dl>' +
                            '</div>' +
                        '</div>' +

                        '<h2 class="text-success"><strong>Credit / Financial Information</strong></h2>' +
                        '<div class="row">' +
                            '<div class="col">' +
                                '<dl>' +
                                    '<dt>Bank Accounts</dt>' +
                                    '<dd>' +
                                        '<table class="table table-borderless">' +
                                            '<thead>' +
                                                '<tr>' +
                                                    '<th><small>Account Type</small></th>' +
                                                    '<th><small>Account No.</small></th>' +
                                                '</tr>' +
                                            '</thead>' +
                                            '<tbody>'+ bankAccount +'</tbody>' +
                                        '</table>' +
                                    '</dd>' +
                                '</dl>' +
                            '</div>' +
                            '<div class="col">' +
                                '<dl>' +
                                    '<dt>Credit References</dt>' +
                                    '<dd>' +
                                        '<table class="table table-borderless">' +
                                        '<thead>' +
                                            '<tr>' +
                                                '<th><small>Bank / Financing</small></th>' +
                                                '<th><small>Monthly Amortization</small></th>' +
                                            '</tr>' +
                                        '</thead>' +
                                        '<tbody>'+ creditRef +'</tbody>' +
                                        '</table>' +
                                    '</dd>' +
                                '</dl>' +
                            '</div>' +
                        '</div>' +

                        '<h2 class="text-success"><strong>Trade and other Reference</strong></h2>' +
                        '<div class="row">' +
                            '<div class="col">' +
                                '<table class="table table-borderless">' +
                                    '<thead>' +
                                        '<tr>' +
                                            '<th><small>Customer name / Co maker</small></th>' +
                                            '<th><small>Address</small></th>' +
                                            '<th><small>Contact No.</small></th>' +
                                        '</tr>' +
                                    '</thead>' +
                                    '<tbody>'+ tradeRef +'</tbody>' +
                                '</table>' +
                            '</div>' +
                        '</div>' +

                        '<h2 class="text-success"><strong>Reference ID\'s</strong></h2>' +
                        '<div class="row">' +
                            '<div class="col">' +
                                '<dl>' +
                                    '<dt>ID 1</dt>' +
                                    '<dd>' +
                                        '<img src="'+ loanDetail.reference_id[0][1][0][1] +'" class="img-fluid" alt="">' +
                                    '</dd>' +
                                '</dl>' +
                            '</div>' +
                            '<div class="col">' +
                                '<dl>' +
                                    '<dt>ID 2</dt>' +
                                    '<dd>' +
                                        '<img src="'+ loanDetail.reference_id[0][1][1][1] +'" class="img-fluid" alt="">' +
                                    '</dd>' +
                                '</dl>' +
                            '</div>' +
                        '</div>' +


                    '</div>' +
                '</div>' +
            '';
        }

        var content = '' +
            '<div class="tabs-container" id="loan-app-detail">' +
                '<ul class="nav nav-tabs" role="tablist">' +
                    '<li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Profile</a></li>' +
                    '<li><a class="nav-link" data-toggle="tab" href="#tab-2">More Information</a></li>' +
                    '<li><a class="nav-link" data-toggle="tab" href="#tab-3">Employment</a></li>' +
                    '<li><a class="nav-link" data-toggle="tab" href="#tab-4">Monthly Income</a></li>' +
                    loanDetailMenu +

                '</ul>' +
                '<div class="tab-content">' +
                    '<div role="tabpanel" id="tab-1" class="tab-pane active">' +
                        '<div class="panel-body">' +
                            '<h2 class="text-success"><strong>Personal Information</strong></h2>' +
                            '<div class="row">' +

                                '<div class="col">' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>First name</dt>' +
                                                '<dd>'+ profile.first_name +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>Middle name</dt>' +
                                                '<dd>'+ profile.middle_name +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>Last name</dt>' +
                                                '<dd>'+ profile.last_name +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Date of Birth</dt>' +
                                                '<dd>'+ profile.bday +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>Age</dt>' +
                                                '<dd>'+ getAge(profile.dob) +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +

                                '<div class="col">' +
                                    '<div class="row">' +
                                        '<div class="col ">' +
                                            '<dl>' +
                                                '<dt>Civil Status</dt>' +
                                                '<dd>'+ profile.civil_status +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Gender</dt>' +
                                                '<dd>'+ profile.gender +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Land Line</dt>' +
                                                '<dd>'+ profile.landline +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Mobile</dt>' +
                                                '<dd>'+ profile.mobile +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Tin No.</dt>' +
                                                '<dd>'+ profile.tin +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>SSS / GSIS No.</dt>' +
                                                '<dd>'+ profile.sss_gsis +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Education</dt>' +
                                                '<dd>'+ profile.education +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +

                            '</div>' +

                            '<h2 class="text-success"><strong>Secondary Information</strong></h2>' +
                            '<div class="row">' +
                                '<div class="col">' +
                                    '<dl>' +
                                        '<dt>Current Address</dt>' +
                                        '<dd>'+ profile.secondary_info[0][2] +'</dd>' +
                                    '</dl>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Years of Stay</dt>' +
                                                '<dd>'+ profile.secondary_info[1][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Address Status</dt>' +
                                                '<dd>'+ profile.secondary_info[2][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    landlord +
                                '</div>' +
                                '<div class="col">' +
                                    '<dl>' +
                                        '<dt>Dependents</dt>' +
                                        '<dd>' +
                                            '<table class="table table-borderless table-striped">' +
                                            '<thead>' +
                                            '<tr>' +
                                            '<th>Name</th>' +
                                            '<th>Birthday</th>' +
                                            '</tr>' +
                                            '</thead>' +
                                            '<tbody>'+ dependents +'</tbody>' +
                                            '</table>' +
                                        '</dd>' +
                                    '</dl>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div role="tabpanel" id="tab-2" class="tab-pane">' +
                        '<div class="panel-body">' +
                            '<h2 class="text-success"><strong>Spouse/Co-maker Information</strong></h2>' +
                            '<div class="row">' +
                                '<div class="col">' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>First name</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[0][2] +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>Middle name</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[1][2] +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>Last name</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[2][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Date of Birth</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[3][2] +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>Age</dt>' +
                                                '<dd>'+ getAge(profile.spouse_comaker_info[3][2]) +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +

                                '<div class="col">' +
                                    '<div class="row">' +
                                        '<div class="col ">' +
                                            '<dl>' +
                                                '<dt>Civil Status</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[4][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Gender</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[5][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Land Line</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[6][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Mobile</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[7][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Tin No.</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[8][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>SSS / GSIS No.</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[9][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Education</dt>' +
                                                '<dd>'+ profile.spouse_comaker_info[10][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="row">' +
                                '<div class="col">' +
                                    '<h2 class="text-success"><strong>Farming Information</strong></h2>' +
                                    '<div class="row">' +
                                        '<dl class="col">' +
                                            '<dt>Farm Description</dt>' +
                                            '<dd>'+ profile.farming_info[0][2] +'</dd>' +
                                        '</dl>' +
                                        // '<dl class="col">' +
                                        //     '<dt>Farming Since</dt>' +
                                        //     '<dd>'+ profile.farming_info[1][2] +'</dd>' +
                                        // '</dl>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col">' +
                                    '<h2 class="text-success"><strong>Membership / Group</strong></h2>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Organization</dt>' +
                                                '<dd>'+ profile.farming_info[2][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>Others</dt>' +
                                                '<dd>' +
                                                    '<ul class="list-inline-item">'+ groups.join('') +'</ul>' +
                                                '</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div role="tabpanel" id="tab-3" class="tab-pane">' +
                        '<div class="panel-body">' +
                            '<div class="row">' +
                                '<div class="col-lg-4">' +
                                    '<dl>' +
                                        '<dt>Status</dt>' +
                                        '<dd>'+ profile.employment_info[0][2][0] +'</dd>' +
                                    '</dl>' +
                                '</div>' +
                                '<div class="col">' +
                                    '<div class="row">' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>'+ profile.employment_info[0][2][1][1] +'</dt>' +
                                                '<dd>'+ profile.employment_info[0][2][1][2] +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>'+ profile.employment_info[0][2][2][1] +'</dt>' +
                                                '<dd>'+ profile.employment_info[0][2][2][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                        '<div class="col">' +
                                            '<dl>' +
                                                '<dt>'+ profile.employment_info[0][2][3][1] +'</dt>' +
                                                '<dd>'+ profile.employment_info[0][2][3][2] +'</dd>' +
                                            '</dl>' +
                                            '<dl>' +
                                                '<dt>'+ profile.employment_info[0][2][4][1] +'</dt>' +
                                                '<dd>'+ profile.employment_info[0][2][4][2] +'</dd>' +
                                            '</dl>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div role="tabpanel" id="tab-4" class="tab-pane">' +
                        '<div class="panel-body">' +
                            '<table class="table table-borderless">' +
                                '<thead>' +
                                    '<tr>' +
                                        '<th></th>' +
                                        '<th class="text-right">Business</th>' +
                                        '<th class="text-right">Employment</th>' +
                                        '<th class="text-right">Total</th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                    '<tr>' +
                                        '<td>Applicant Monthly Income</td>' +
                                        '<td class="text-right">'+ numFormat(rowAAIncome) +'</td>' +
                                        '<td class="text-right">'+ numFormat(rowABIncome) +'</td>' +
                                        '<td class="text-right">'+ numFormat(rowASum) +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<td>Spouse\'s Monthly Income</td>' +
                                        '<td class="text-right">'+ numFormat(rowBAIncome) +'</td>' +
                                        '<td class="text-right">'+ numFormat(rowBBIncome) +'</td>' +
                                        '<td class="text-right">'+ numFormat(rowBSum) +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<td>Other Monthly Income</td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td class="text-right">'+ numFormat(rowCIncome) +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<td>Other Source of Income</td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td class="text-right">'+ numFormat(rowDIncome) +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<td>Total Monthly Income</td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td class="text-right">'+ numFormat(rowABCDSum) +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<td>Less Monthly Expenses <small><br>(Living, Utilitites, rental, transpo..)</small></td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td class="text-right">'+ numFormat(rowEExpense) +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<td>Loan Amortization <small><br>(Mortgage/loan)</small></td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td class="text-right">'+ numFormat(rowFExpense) +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<td>Total Expenses</td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td class="text-right">'+ numFormat(rowEFSum) +'</td>' +
                                    '</tr>' +
                                '</tbody>' +
                                '<tfoot>' +
                                    '<tr>' +
                                        '<td><h2><strong>NET MONTHLY INCOME</strong></h2></td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td class="text-right"><h2><strong>'+ numFormat(totalIncomeSum) +'</strong></h2></td>' +
                                    '</tr>' +
                                '</tfoot>' +
                            '</table>' +
                        '</div>' +
                    '</div>' +
                    loanDetailContent +
                '</div>' +
            '</div>' +
        '';

        return content;
    }
});

