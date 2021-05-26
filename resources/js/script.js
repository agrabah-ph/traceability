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
