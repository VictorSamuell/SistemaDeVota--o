document.addEventListener('DOMContentLoaded', function () {
    const checkForm = {
        Senha: false,
        Email: false,
    };

    const login = {
        Email: '',
        Senha: '',
    };


    const submitButton = document.querySelector('.btn');
    const SenhaInput = document.getElementById('Senha');
    const EmailInput = document.getElementById('Email');

    function checkFormValidity() {
        if (checkForm.Senha && checkForm.Email) {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'disabled');
        }
    }

    SenhaInput.addEventListener('input', function (e) {
        const Senha = e.target.value.trim();

            login.Senha = Senha;
            checkForm.NumeroCandidato = true;
        

        checkFormValidity();
    });

    EmailInput.addEventListener('input', function (e) {
        const Email = e.target.value.trim();

        if (Email.includes('@gmail.com')) {
            login.Email = Email;
            checkForm.Email = true;
        } else {
            checkForm.Email = false;
        }

        checkFormValidity();
    });








});