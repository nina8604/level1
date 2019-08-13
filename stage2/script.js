function show_valid_phones() {
    let inputs = document.getElementById('phone_container').getElementsByClassName('phones');
    let htmlPhone = '';
    for (let i = 0; i < inputs.length; i++)
        if (inputs[i].getAttribute('data-validate') == 1)
            htmlPhone += 'Телефон: <b>' + inputs[i].value + '</b><br>';
    document.getElementById('phones_inner').innerHTML = htmlPhone;
}

$(document).ready(function() {
    let count = 1;
    button.addEventListener("click", function(){
        let input = document.createElement('INPUT');
        input.type = 'text';
        input.className = 'phones';
        input.id = "phone" + count;
        input.setAttribute('data-validate', '0');
        input.setAttribute("placeholder", "+380(xx)xxx-x-xxx");
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
            show_valid_phones();
        });

    });

    let letters = /^[A-Za-z]+$/;
    let error = "Данные введены не верною Повторите попытку.";
    let errorEmpty = "Пожалуйста, заполните поле."

    document.getElementById('fio').addEventListener( 'change', function(){
        let fio = document.getElementById('fio').value;
        if (fio.match(letters)){
            let htmlFio = 'ФИО: <b>' + fio + '</b><br>';
            document.getElementById('fio_inner').innerHTML = htmlFio;
            this.nextElementSibling.innerHTML = '';
        }else {
            this.nextElementSibling.innerHTML = error;
            htmlFio = '';
            document.getElementById('fio_inner').innerHTML = htmlFio;
        }
    });
    document.getElementById('email').addEventListener( 'change', function(){
        let email = document.getElementById('email').value;
        let mailFormat = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;
        if (email.match(mailFormat)){
            let htmlEmail = 'email: <b>' + email + '</b><br>';
            document.getElementById('email_inner').innerHTML = htmlEmail;
            this.nextElementSibling.innerHTML = '';
        }else {
            this.nextElementSibling.innerHTML = error;
            htmlEmail = '';
            document.getElementById('email_inner').innerHTML = htmlEmail;
        }
    });


    let phoneFormat = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
    let phone_container = document.getElementById('phone_container');

    phone_container.addEventListener( 'change', function(event) {
        let target = event.target;
        if (target.className == 'phones') {
            console.log(target.value);
            if (target.value.match(phoneFormat)){
                target.setAttribute('data-validate', '1');
                target.nextElementSibling.innerHTML = '';
            } else {
                target.nextElementSibling.innerHTML = error;
                target.setAttribute('data-validate', '0');
            }
            show_valid_phones();

        }
    });



    document.getElementById('age').addEventListener( 'change', function(){
        let age = document.getElementById('age').value;
        if (isNaN(age) || age <= 0 || age > 150 || age.indexOf(".") >= 0){
            this.nextElementSibling.innerHTML = error;
            let htmlAge = '';
            document.getElementById('age_inner').innerHTML = htmlAge;
        }else {
            htmlAge = 'Возраст: <b>' + age + '</b><br>';
            document.getElementById('age_inner').innerHTML = htmlAge;
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
                let span = document.createElement('span');
                span.innerHTML = ['Ваше фото: <img class="thumb" src="', e.target.result,
                    '" title="', escape(theFile.name), '" width="150"/>'].join('');
                document.getElementById('photo_inner').appendChild(span);
                this.nextElementSibling.innerHTML = '';
            };
        })(photo);

        // Read in the image file as a data URL.
        reader.readAsDataURL(photo);
    });
    document.getElementById('resume').addEventListener( 'change', function(){
        let resume = document.getElementById('resume').value;
        if (resume !== ''){
            let htmlResume = 'Резюме: <pre>' + resume + '</pre><br>';
            document.getElementById('resume_inner').innerHTML = htmlResume;
            this.nextElementSibling.innerHTML = '';
        }else {
            this.nextElementSibling.innerHTML = errorEmpty;
            htmlResume = '';
            document.getElementById('resume_inner').innerHTML = htmlResume;
        }
    });
});