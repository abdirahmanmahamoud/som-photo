let error = document.querySelector('.error');
let suss = document.querySelector('.suss');
let from = document.querySelector('#from');
let password = document.querySelector('#password');
let confirm_password = document.querySelector('#confirm_password');

from.addEventListener('submit', (e) =>{
    e.preventDefault();
    $('.error').html(''); 
    $('.suss').html('');
    if(password.value.length < 6){
        errors('password maximum character is 6');
    }else if(password.value !== confirm_password.value){
        errors('password is not match');
    }else{
        submit();
    }
})

function submit(){ 
    let form_data = new FormData($('#from')[0]);
    form_data.append('image',$('input[type=file]')[0].files[0]);
    form_data.append('action','register');
    $.ajax({
        method : 'POST',
        dataType : 'JSON',
        url :  'apl/user.php',
        data :  form_data,
        processData : false,
        contentType : false,
        success : function(data){
            let status = data.status;
            let per = data.data;
            mess(status,per);
        },
        error : function(data){
            mess(status,per);
        },
        })
    
}

function errors(message) {
    error.innerHTML = message;
    error.classList = 'error show';
}

function mess(status,message){
    if(status == true){
       suss.innerHTML = message;
       suss.classList = 'suss show';
       setTimeout(function(){
       },3000)
 
    }else if(status == false){
        $('.error').html(''); 
        errors(message)
    }
}