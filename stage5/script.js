// function show_valid_phones() {
//     let inputs = document.getElementById('phone_container').getElementsByClassName('phones');
//     let htmlPhone = '';
//     for (let i = 0; i < inputs.length; i++)
//         if (inputs[i].getAttribute('data-validate') == 1)
//             htmlPhone += 'Телефон: <b>' + inputs[i].value + '</b><br>';
//     document.getElementById('phones_inner').innerHTML = htmlPhone;
// }

let error = "Данные введены не верною Повторите попытку.";
let errorEmpty = "*данное поле обязательно для заполнения.";
function validate_fio() {
    let letters = /^[A-Za-z]+$/;
    let fio = document.getElementById('fio');
    let fioValue = fio.value;
    // let htmlFio = '';
    if (fioValue == ""){
        fio.nextElementSibling.innerHTML = errorEmpty;
        // htmlFio = '';
        // document.getElementById('fio_inner').innerHTML = htmlFio;
        return false;
    }else {
        if (fioValue.match(letters)){
            // htmlFio = 'ФИО: <b>' + fioValue + '</b><br>';
            // document.getElementById('fio_inner').innerHTML = htmlFio;
            fio.nextElementSibling.innerHTML = '';
            return true;
        }else {
            fio.nextElementSibling.innerHTML = error;
            // htmlFio = '';
            // document.getElementById('fio_inner').innerHTML = htmlFio;
            return false;
        }
    }
}

function validate_email() {
    let mailFormat = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;
    let email = document.getElementById('email');
    let emailValue = email.value;
    // let htmlEmail = '';
    if (emailValue == "") {
        email.nextElementSibling.innerHTML = errorEmpty;
        // htmlEmail = '';
        // document.getElementById('email_inner').innerHTML = htmlEmail;
        return false;
    } else {
        if (emailValue.match(mailFormat)){
            // htmlEmail = 'email: <b>' + emailValue + '</b><br>';
            // document.getElementById('email_inner').innerHTML = htmlEmail;
            email.nextElementSibling.innerHTML = '';
            return true;
        }else {
            email.nextElementSibling.innerHTML = error;
            // htmlEmail = '';
            // document.getElementById('email_inner').innerHTML = htmlEmail;
            return false;
        }
    }

}

let phoneFormat = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
function validate_phone(input) {
    input.setAttribute('data-validate', '0');

    if (input.value == '')
        input.nextElementSibling.innerHTML = errorEmpty;
    else
    if (input.value.match(phoneFormat)) {
        input.setAttribute('data-validate', '1');
        input.nextElementSibling.innerHTML = '';
    } else
        input.nextElementSibling.innerHTML = error;

    return input.getAttribute('data-validate') == '1';
}
function validate_phones() {
    let validate = true;
    let inputs = document.getElementById('phone_container').getElementsByClassName('phones');
    for (let i = 0; i < inputs.length; i++)
        if ( !validate_phone(inputs[i]) )
            validate = false;
    return validate;
}

function validate_age() {
    let age = document.getElementById('age');
    let ageValue = age.value;
    // let htmlAge = '';
    if (ageValue == "") {
        age.nextElementSibling.innerHTML = errorEmpty;
        // htmlAge = '';
        // document.getElementById('age_inner').innerHTML = htmlAge;
        return false;
    } else {
        if (isNaN(ageValue) || ageValue <= 0 || ageValue > 150 || ageValue.indexOf(".") >= 0){
            age.nextElementSibling.innerHTML = error;
            // htmlAge = '';
            // docplusument.getElementById('age_inner').innerHTML = htmlAge;
            return false;
        }else {
            // htmlAge = 'Возраст: <b>' + ageValue + '</b><br>';
            // document.getElementById('age_inner').innerHTML = htmlAge;
            age.nextElementSibling.innerHTML = '';
            return true;
        }
    }
}

function validate_photo() {
    let validateSize = 2*1024*1024;
    let photo = document.getElementById('photo');
    let photoFile = photo.files[0];
    if (photoFile === undefined){
        photo.nextElementSibling.innerHTML = errorEmpty;
        // document.getElementById('photo_inner').innerHTML = '';
        return false;
    } else {
        if (!photoFile.type.match('image/jp.*')) {
            photo.nextElementSibling.innerHTML = "Файл неверного формата. Только JPG формат. Повторите попытку";
            // document.getElementById('photo_inner').innerHTML = '';
            return false;
        }
        if (photoFile.size > validateSize ) {
            photo.nextElementSibling.innerHTML = "Файл превышает допустимый размер 2МВ. Повторите попытку.";
            // document.getElementById('photo_inner').innerHTML = '';
            return false;
        }
        // let reader = new FileReader();
        // reader.onload = (function(theFile) {
        //     return function(e) {
        //         document.getElementById('photo_inner').innerHTML = '';
        //         let span = document.createElement('span');
        //         span.innerHTML = ['Ваше фото: <img class="thumb" src="', e.target.result,
        //             '" title="', escape(theFile.name), '" width="150"/>'].join('');
        //         document.getElementById('photo_inner').appendChild(span);
        //         document.getElementById('photo').nextElementSibling.innerHTML = '';
        //     };
        // })(photoFile);
        //
        // // Read in the image file as a data URL.
        // reader.readAsDataURL(photoFile);
        photo.nextElementSibling.innerHTML = '';
        return true;
    }
}

function validate_resume() {
    let resume = document.getElementById('resume');
    let resumeValue = resume.value;
    // let htmlResume = '';
    if (resumeValue == ''){
        resume.nextElementSibling.innerHTML = errorEmpty;
        // htmlResume = '';
        // document.getElementById('resume_inner').innerHTML = htmlResume;
        return false;
    }else {
        // htmlResume = 'Резюме: <pre>' + resumeValue + '</pre><br>';
        // document.getElementById('resume_inner').innerHTML = htmlResume;
        resume.nextElementSibling.innerHTML = '';
        return true;
    }
}

$('.form').submit(function (event) {
    event.preventDefault();
    console.log(checkForm());
    if (checkForm()){
        $.ajax({
            url:     'send-form.php',
            type:     "POST",
            // dataType: "html", //формат данных
            data: $(this).serialize(),
            success: function(response) { //Данные отправлены успешно
                alert('OK');
            },
            error: function(response) { // Данные не отправлены
                alert('error');
            }
        });
    }else {
        return;
    }

});

function checkForm() {
    let validate = true;
console.log('fio',validate_fio());
    if ( !validate_fio() ) 		validate = false;
    console.log('email',validate_email());
    if ( !validate_email() )  	validate = false;
    console.log('validate_phones',validate_phones());
    if ( !validate_phones() ) 	validate = false;
    console.log('validate_age',validate_age());
    if ( !validate_age() ) 		validate = false;
    console.log('validate_photo',validate_photo());
    if ( !validate_photo() ) 	validate = false;
    console.log('validate_resume',validate_resume());
    if ( !validate_resume() ) 	validate = false;

    return validate;
}

$(document).ready(function() {
    let count = 1;
    // create new fields for extra phones
    plus.addEventListener("click", function(){
        let input = document.createElement('INPUT');
        input.type = 'text';
        input.className = 'phones';
        input.id = "phone" + count;
        input.setAttribute('data-validate', '0');
        // input.setAttribute("placeholder", "+380(xx)xxx-x-xxx");
        input.name = "value[]";
        let span = document.createElement('SPAN');
        let pre = document.createElement('PRE');
        let deleteBtn = document.createElement('INPUT');
        deleteBtn.type = 'button';
        deleteBtn.setAttribute("class", "delete_extra_phone");
        deleteBtn.value = 'Удалить';

        document.querySelector('#phone_container').appendChild(input);
        document.querySelector('#phone_container').appendChild(span);
        document.querySelector('#phone_container').appendChild(deleteBtn);
        document.querySelector('#phone_container').appendChild(pre);
        count++;
        deleteBtn.addEventListener("click", function() {
            this.previousElementSibling.remove();
            this.previousElementSibling.remove();
            this.nextElementSibling.remove();
            this.remove();
            // show_valid_phones();
        });

    });

    document.getElementById('fio').addEventListener( 'blur', function(){
        validate_fio();
    });

    document.getElementById('email').addEventListener( 'blur', function(){
        validate_email();
    });

    let phone_container = document.getElementById('phone_container');
    phone_container.addEventListener( 'focusout', function(event) {
        if (event.target.className == 'phones') {
            validate_phone(event.target);
            // show_valid_phones();
        }
    });

    document.getElementById('age').addEventListener( 'blur', function(){
        validate_age();
    });

    document.getElementById('photo').addEventListener( 'change', function(){
        validate_photo();
    });

    document.getElementById('resume').addEventListener( 'blur', function(){
        validate_resume();
    });



});