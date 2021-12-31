$('#from').submit(function (event) { 
    event.preventDefault();
    $('.error').html(''); 
    $('.suss').html('');
    let username = $('#username').val();
    let password = $('#password').val();
    let send = {
        'username' : username,
        'password' : password,
        'action' : 'login'
    }
    $.ajax({
        method : 'POST',
        dataType : 'JSON',
        url :  'apl/user.php',
        data :  send,
        success : function(data){
          let status = data.status;
          let per = data.data;
          mess(status,per);
        },
        error : function(data){
        mess(status,per);
        },
     })
 })

function mess(status,message){
    let error = document.querySelector('.error');
    if(status == true){
        window.location.href = 'index.php';
       setTimeout(function(){
       },3000)
 
    }else if(status == false){
        error.innerHTML = message;
       error.classList = 'error show';
    }
}