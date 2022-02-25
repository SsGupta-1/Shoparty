$('.otpInput input').keypress(function(evt){
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)){
    	// console.log('String');
        return false;
    } else {
    	// console.log('Integer');
    }
	$(this).next().focus();
}).keyup(function(e){
	if(e.keyCode == 8){
		$(this).prev().focus();
	}
});

function IsEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

// WRITE THE VALIDATION SCRIPT TO INPUT ONLY NUMBERS.
function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}

// WRITE THE VALIDATION SCRIPT TO BLOCK SPECIAL CHARACTERS.
function blockSpChar(evt){
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if ((iKeyCode > 47 && iKeyCode < 58) || (iKeyCode > 64 && iKeyCode < 91) || (iKeyCode > 96 && iKeyCode < 123)) {
        return true;
    }
    return false;
}

// WRITE THE VALIDATION SCRIPT TO BLOCK SPECIAL AND NUMERIC CHARACTERS.
function blockNumSpChar(evt){
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if ((iKeyCode > 64 && iKeyCode < 91) || (iKeyCode > 96 && iKeyCode < 123)) {
        return true;
    }
    return false;
}

// WRITE THE VALIDATION SCRIPT TO BLOCK ALL CHARACTERS.
function blockChar(evt){
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    return false;
}

function adminLoginForm(curr, e) {
	$('#adminLoginForm').submit();     
}

function adminForgotPasswordForm(curr, e) {
	$('#forgotPasswordForm').submit();
}

function adminVerifyPasswordForm(curr, e) {
	$('#verifyPasswordForm').submit();
}

function adminResetPasswordForm(curr, e) {
	$('#resetPasswordForm').submit();
}

function updateStatus(curr, e, url) {
    $.ajax({
        url: url,
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { status:$(curr).val() },
        success:function(response){
            console.log(response);
            toastr.success("Status changed.");
        }
    });
}