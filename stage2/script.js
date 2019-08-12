$(document).ready(function() {
    let count = 1;
    button.addEventListener("click", function(){
        let input = document.createElement('INPUT');
        input.type = 'text';
        input.className = 'phones';
        // input.setAttribute("id", "phone" + count);
        input.id = "phone" + count;
        input.setAttribute("placeholder", "+380(xx)xxx-x-xxx");
        input.name = "value[]";
        let span = document.createElement('SPAN');
        let pre = document.createElement('PRE');

        // let div = document.createElement('DIV');
        // div.id = 'add_extra_phone' + count;
        // div.className = 'add_extra_phone';
        let deleteBtn = document.createElement('INPUT');
        deleteBtn.type = 'button';
        deleteBtn.setAttribute("class", "delete_extra_phone");
        // deleteBtn.class = 'delete_extra_phone';
        deleteBtn.value = 'Удалить';

        document.querySelector('#phone_container').appendChild(input);
        document.querySelector('#phone_container').appendChild(span);
        document.querySelector('#phone_container').appendChild(deleteBtn);
        document.querySelector('#phone_container').appendChild(pre);

        // document.querySelector('#phone_container').appendChild(div);
        // document.querySelector('.add_extra_phone').appendChild(input);
        // document.querySelector('.add_extra_phone').appendChild(span);
        // document.querySelector('.add_extra_phone').appendChild(deleteBtn);
        // document.querySelector('.add_extra_phone').appendChild(pre);
        count++;
        deleteBtn.addEventListener("click", function() {
            // this.parent().remove();
        //     this.nextElementSibling.remove();
        //     this.previousElementSibling.remove();
            this.previousElementSibling.previousElementSibling.remove();
            this.remove();
        });

    });




    let letters = /^[A-Za-z]+$/;
    let error = "Данные введены не верною Повторите попытку.";
    let errorEmpty = "Пожалуйста, заполните поле."

    document.getElementById('fio').addEventListener( 'change', function(){
        let fio = document.getElementById('fio').value;
        let divFio = document.createElement('DIV');
        divFio.id = "fio_inner";
        document.getElementById('formValue').appendChild(divFio);
        if (fio.match(letters)){
            let htmlFio = 'ФИО: <b>' + fio + '</b><br>';
            document.getElementById(divFio.id).innerHTML = htmlFio;
            this.nextElementSibling.innerHTML = '';
        }else {
            this.nextElementSibling.innerHTML = error;
            htmlFio = '';
            document.getElementById(divFio.id).innerHTML = htmlFio;
        }

    });
    document.getElementById('email').addEventListener( 'change', function(){
        let email = document.getElementById('email').value;
        let divEmail = document.createElement('DIV');
        divEmail.id = "email_inner";
        document.getElementById('formValue').appendChild(divEmail);
        let mailFormat = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;
        if (email.match(mailFormat)){
            let htmlEmail = 'email: <b>' + email + '</b><br>';

            document.getElementById(divEmail.id).innerHTML = htmlEmail;
            this.nextElementSibling.innerHTML = '';
        }else {
            this.nextElementSibling.innerHTML = error;
            htmlEmail = '';
            document.getElementById(divEmail.id).innerHTML = htmlEmail;
        }
    });
    let phoneFormat = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
    let inputs = document.getElementById('phone_container').getElementsByClassName('phones');
    // console.log(inputs);
    let htmlPhone = '';
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener( 'change', function() {
            console.log(inputs[i].value);
            if (inputs[i].value.match(phoneFormat)){
                htmlPhone = 'Телефон: <b>' + inputs[i].value + '</b><br>';
                document.getElementById('formValue').innerHTML = htmlPhone;
                this.nextElementSibling.innerHTML = '';
            }else {
                this.nextElementSibling.innerHTML = error;
            }
        });
    }


    //
    // let phones = [];
    // // let htmlPhones = [];
    // for (let i = 0; i <= count; i++) {
    //     document.getElementById('phone'+i).addEventListener( 'change', function(){
    //
    //         phones[i] = document.getElementById('phone'+i).value;
    //         console.log(phones[i]);
    //         // if (phones[i].match(phoneFormat)){
    //         //     htmlPhones[i] = 'Телефон: <b>' + phones[i] + '</b><br>';
    //         //     document.getElementById('formValue').innerHTML = htmlPhones[i];
    //         //     this.nextElementSibling.innerHTML = '';
    //         // }else {
    //         //     this.nextElementSibling.innerHTML = error;
    //         // }
    //     });
    // }

    document.getElementById('age').addEventListener( 'change', function(){
        let age = document.getElementById('age').value;
        let divAge = document.createElement('DIV');
        divAge.id = "age_inner";
        document.getElementById('formValue').appendChild(divAge);
        if (isNaN(age) || age <= 0 || age > 150 || age.indexOf(".") >= 0){
            this.nextElementSibling.innerHTML = error;
            let htmlAge = '';
            document.getElementById(divAge.id).innerHTML = htmlAge;
        }else {
            htmlAge = 'Возраст: <b>' + age + '</b><br>';
            document.getElementById(divAge.id).innerHTML = htmlAge;
            this.nextElementSibling.innerHTML = '';
        }
    });

    let validateSize = 2*1024*1024;
    document.getElementById('photo').addEventListener( 'change', function(){
        let photo = this.files[0];
        if (!photo.type.match('image/jp.*')) {
            this.nextElementSibling.innerHTML = "Файл неверного формата. Только JPG формат. Повторите попытку";
            return;
        }
        if (photo.size > validateSize ) {
            this.nextElementSibling.innerHTML = "Файл превышает допустимый размер 2МВ. Повторите попытку.";
            return;
        }
        let reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                // Render thumbnail.
                let span = document.createElement('span');
                span.innerHTML = ['Ваше фото: <img class="thumb" src="', e.target.result,
                    '" title="', escape(theFile.name), '" width="150"/>'].join('');
                document.getElementById('formValue').appendChild(span);
                this.nextElementSibling.innerHTML = '';
            };
        })(photo);

        // Read in the image file as a data URL.
        reader.readAsDataURL(photo);
    });
    document.getElementById('resume').addEventListener( 'change', function(){
        let resume = document.getElementById('resume').value;
        let divResume = document.createElement('DIV');
        divResume.id = "resume_inner";
        document.getElementById('formValue').appendChild(divResume);
        if (resume !== ''){
            let htmlResume = 'Резюме: <pre>' + resume + '</pre><br>';
            document.getElementById(divResume.id).innerHTML = htmlResume;
            this.nextElementSibling.innerHTML = '';
        }else {
            this.nextElementSibling.innerHTML = errorEmpty;
            htmlResume = '';
            document.getElementById(divResume.id).innerHTML = htmlResume;
        }
    });
//
//     $('#addDynamicExtraFieldButton').click(function (event) {
//         addDynamicExtraField();
//         return false;
//     });
//
//     function addDynamicExtraField() {
//         var div = $('<div/>', {
//             'class': 'DynamicExtraField'
//         }).appendTo($('#DynamicExtraFieldsContainer'));
//         var br = $('<br/>').appendTo(div);
//         var label = $('<label/>').html("Доп. поле ").appendTo(div);
//         var input = $('<input/>', {
//             value: 'Удаление',
//             type: 'button',
//             'class': 'DeleteDynamicExtraField'
//         }).appendTo(div);
//         input.click(function () {
//             $(this).parent().remove();
//         });
//         var br = $('<br/>').appendTo(div);
//         var textarea = $('<textarea/>', {
//             name: 'DynamicExtraField[]',
//             cols: '50',
//             rows: '3'
//         }).appendTo(div);
//     }
//
// //Для удаления первого поля
//     $('.DeleteDynamicExtraField').click(function (event) {
//         $(this).parent().remove();
//         return false;
//     });
//     alert('hello');
});