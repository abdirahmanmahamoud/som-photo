let menu = document.querySelector('.menu');
let menu_bg = document.querySelector('.menu-bg');
let clone = document.querySelector('.clone');
let box = document.querySelector('.box-container');
let button = document.querySelector('#button');
let clone2 = document.querySelector('.clone2');
let reg = document.querySelector('.reg');
let deleted = document.querySelector('.delete');
let clone3 = document.querySelector('.clone3');
ler();


menu.addEventListener('click',() =>{
    menu_bg.classList = 'menu-bg show';
})
clone.addEventListener('click',() =>{
    menu_bg.classList = 'menu-bg hide';
})
box.addEventListener('click',(e) =>{
    if(e.target.classList == 'images'){
        e.target.parentElement.children[1].children[1].classList = 'title-icon show';
        e.target.parentElement.children[1].children[1].children[1].addEventListener('click', (de) =>{
            pen(de.target.parentElement.parentElement.parentElement.children[2].value);
        })
        e.target.parentElement.children[1].children[1].children[2].addEventListener('click', (se) =>{
            deletes(se.target.parentElement.parentElement.parentElement.children[2].value,se.target.parentElement.parentElement.children[0].children[0].innerText);
        })
        e.target.parentElement.children[1].children[1].children[0].addEventListener('click', (sa) =>{
          let id = sa.target.parentElement.parentElement.parentElement.children[2].value; 
          window.location.href = `photo.php?id=${id}`; 
        })
    }
})

button.addEventListener('click',() =>{
    reg.classList = 'reg show';
})
clone2.addEventListener('click',() =>{
    reg.classList = 'reg hide';
})
clone3.addEventListener('click',() =>{
    deleted.classList = 'delete hide';
    $('#span').html('');
})
deleted.addEventListener('click',(e) =>{
    if(e.target.classList == 'delete show'){
        deleted.classList = 'delete hide';
        $('#span').html('');
    }
})

let btt = 'insert';

$('#from').submit(function (e) { 
    e.preventDefault();
    let form_data = new FormData($('#from')[0]);
    form_data.append('image',$('input[type=file]')[0].files[0]);
    if(btt == 'insert'){
        form_data.append('action','register');
    }else{
        form_data.append('action','update');
    }
    $.ajax({
        method : 'POST',
        dataType : 'JSON',
        url :  'apl/category.php',
        data :  form_data,
        processData : false,
        contentType : false,
        success : function(data){
            let status = data.status;
            let per = data.data;
            alert(per);
            reg.classList = 'reg hide';
            ler();
            btt = 'insert';
        },
        error : function(data){
            alert(per);
        },
        })     
});

function ler(){
    $('.box-container').html('');
    let id = $('#id_admin').val();
    let send ={
        'id' : id,
       'action' :  'khar'
    }
    $.ajax({
       method : 'POST',
       dataType : 'JSON',
       url :  'apl/category.php',
       data :  send,
       success : function(data){
          let status = data.status;
          let per = data.data;
          let html ='';
          let tr = '';
          if(status){
             per.forEach(item =>{
                tr += `
                <div class="box">
                <img src="images/category/${item['image']}" class="images">
                <div class="box-title">
                <div class="title-name">
                <span class="name">${item['name']}</span>
                <span>${item['number']} images</span>
                </div>
                <div class="title-iconhide">
                <i class="fas fa-eye" id='eye'></i>
                <i class="fas fa-pen" id='pen'></i>
                <i class="fas fa-trash"></i>
                </div>
                </div>
                <input type="hidden"  name="id" id="id" value="${item['id']}">
                </div>
                `;
             })
            /$('.box-container').append(tr);
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }

function pen(e) {
    $('#box_id').val(e);
let send ={
    'id' : e,
    'action' :  'all'
}
$.ajax({
    method : 'POST',
    dataType : 'JSON',
    url :  'apl/category.php',
    data :  send,
    success : function(data){
        let status = data.status;
        let per = data.data;
        let html ='';
        let tr = '';
        if(status){
        $('#name').val(per[0].name);
        reg.classList = 'reg show';
        btt = 'update';
        }
    },
    error : function(data){
        console.log(data);
    },
})   
}

function deletes(id,name) {
    let text = `mala tirtiyaah ${name}`;
    $('#span').append(text);
    deleted.classList = 'delete show';
    let button_delete = document.querySelector('#button_delete');
    button_delete.addEventListener('click',() =>{
        let send ={
            'id' : id,
           'action' :  'delete'
        }
        $.ajax({
           method : 'POST',
           dataType : 'JSON',
           url :  'apl/category.php',
           data :  send,
           success : function(data){
              let status = data.status;
              let per = data.data;
              alert(per)
              deleted.classList = 'delete hide';
              $('#span').html('');
              ler();
            },
            error : function(data){
               console.log(data);
            },
        })
    })
}