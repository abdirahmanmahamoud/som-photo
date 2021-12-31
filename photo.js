let photo_container = document.querySelector('.photo-container');
let box_info = document.querySelector('.box-info');
let menu = document.querySelector('.menu');
let menu_bg = document.querySelector('.menu-bg');
let reg = document.querySelector('.reg');
let button = document.querySelector('#button');
let clone = document.querySelector('.clone');
let clone2 = document.querySelector('.clone2');
ler();


menu.addEventListener('click',() =>{
    menu_bg.classList = 'menu-bg show';
})
clone.addEventListener('click',() =>{
    menu_bg.classList = 'menu-bg hide';
})
button.addEventListener('click',() =>{
    reg.classList = 'reg show';
})
clone2.addEventListener('click',() =>{
    reg.classList = 'reg hide';
})
photo_container.addEventListener('click',(e) =>{
    if(e.target.classList == 'box-png'){
        e.target.parentElement.children[1].classList = 'box-info show';
        e.target.parentElement.children[1].children[1].addEventListener('click',(f) =>{
           deletes(f.target.parentElement.parentElement.children[2].value,f.target.parentElement.parentElement.children[3].value);      
        })
        e.target.parentElement.children[1].children[0].addEventListener('click',(f) =>{      
           eeg(f.target.parentElement.parentElement.children[2].value);
        })
    }
})

$('#from').submit(function (e) { 
    e.preventDefault();
    let form_data = new FormData($('#from')[0]);
    form_data.append('image',$('input[type=file]')[0].files[0]);
        form_data.append('action','register');

    $.ajax({
        method : 'POST',
        dataType : 'JSON',
        url :  'apl/photo.php',
        data :  form_data,
        processData : false,
        contentType : false,
        success : function(data){
            let status = data.status;
            let per = data.data;
            alert(per);
            reg.classList = 'reg hide';
            ler();
        },
        error : function(data){
            alert(per);
        },
        })     
});

function ler(){
    $('.photo-container').html('');
    let id = $('#admin_id').val();
    let send ={
        'id' : id,
       'action' :  'khar'
    }
    $.ajax({
       method : 'POST',
       dataType : 'JSON',
       url :  'apl/photo.php',
       data :  send,
       success : function(data){
          let status = data.status;
          let per = data.data;
          let html ='';
          let tr = '';
          if(status){
             per.forEach(item =>{
                tr += `
                <div class="box-photo">
                       <img src="images/photo/${item['image']}" class="box-png">
                       <div class="box-info hide">
                       <i class="fas fa-eye"></i>
                       <i class="fas fa-trash"></i>
                       </div>
                       <input type="hidden"  name="id" id="id" value="${item['id']}">
                       <input type="hidden" name="admin" id="admin" value="${id}">
                   </div>
              `;
             })
            /$('.photo-container').append(tr);
          }
        },
        error : function(data){
           console.log(data);
        },
    })
 }
 function deletes(id,admin) {
        let send ={
            'id' : id,
            'admin' : admin,
           'action' :  'delete'
        }
        $.ajax({
           method : 'POST',
           dataType : 'JSON',
           url :  'apl/photo.php',
           data :  send,
           success : function(data){
              let status = data.status;
              let per = data.data;
              alert(per)
             
              ler();
            },
            error : function(data){
               console.log(data);
            },
        })
}
let photo_e = document.querySelector('.photo-e');
function eeg(e) {
    let images_id = `<img src="images/photo/${e}.png" class="images_e">`;
    $('.som').append(images_id);
    photo_e.classList = 'photo-e show';

}

photo_e.addEventListener('click' , (c) =>{
    if(c.target.classList == 'photo-e show'){
        photo_e.classList = 'photo-e hide';
        $('.som').html('');
    }
})