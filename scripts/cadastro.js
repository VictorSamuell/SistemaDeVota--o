document.addEventListener('DOMContentLoaded', function () {
    const checkForm = {
        Email: false,
        Senha: false,
        Nome: false,
    };

    const Cadastro = {
        Email: '',
        Senha: '',
        Nome: '',
    };


    const submitButton = document.querySelector('.btn');
    const SenhaInput = document.getElementById('Senha');
    const EmailInput = document.getElementById('Email');
    const NomeInput = document.getElementById('Nome');


    function checkFormValidity() {
        if (checkForm.Senha && checkForm.Email && checkForm.Nome) {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'disabled');
        }
    }

    NomeInput.addEventListener('input', function (e) {
        const Nome = e.target.value.trim();

            Cadastro.Nome = Nome;
            checkForm.Nome = true;
        

        checkFormValidity();
    });


    SenhaInput.addEventListener('input', function (e) {
        const Senha = e.target.value.trim();

            Cadastro.Senha = Senha;
            checkForm.Senha = true;
        

        checkFormValidity();
    });

    EmailInput.addEventListener('input', function (e) {
        const Email = e.target.value.trim();

        if (Email.includes('@gmail.com')) {
            Cadastro.Email = Email;
            checkForm.Email = true;
        } else {
            checkForm.Email = false;
        }

        checkFormValidity();
    });








});