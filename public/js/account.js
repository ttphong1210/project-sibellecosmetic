
function togglePassword(){
    var text = document.getElementById('checkdisplay');
    var pass = document.getElementById('pass');

if(check.checked){ 
    pass.type = 'text';
    text.innerHTML = "Ẩn mật khẩu";
}
    else {
        pass.type = 'password';
        text.innerHTML = "Hiện mật khẩu";
    }
}

$(function(){
    $(document).on('click', '#check', togglePassword);
})
