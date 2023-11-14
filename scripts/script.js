document.addEventListener('DOMContentLoaded', function () {
    const checkForm = {
        NumeroCandidato: false,
        Email: false,
    };

    const voto = {
        NumeroCandidato: 0,
        Email: '',
    };

    const submitButton = document.querySelector('.btn');
    const NumeroCandidatoInput = document.getElementById('NumeroCandidato');
    const EmailInput = document.getElementById('Email');

    function checkFormValidity() {
        if (checkForm.NumeroCandidato && checkForm.Email) {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'disabled');
        }
    }

    NumeroCandidatoInput.addEventListener('input', function (e) {
        const NumeroCandidato = e.target.value.trim();

        if (NumeroCandidato >= 1 && NumeroCandidato <= 4) {
            voto.NumeroCandidato = NumeroCandidato;
            checkForm.NumeroCandidato = true;
        } else {
            checkForm.NumeroCandidato = false;
        }

        checkFormValidity();
    });

    EmailInput.addEventListener('input', function (e) {
        const Email = e.target.value.trim();

        if (Email.includes('@gmail.com')) {
            voto.Email = Email;
            checkForm.Email = true;
        } else {
            checkForm.Email = false;
        }

        checkFormValidity();
    });

    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();

        if (checkForm.NumeroCandidato && checkForm.Email) {
            fetch("http://localhost:5000/gravavoto.php", {
                method: 'POST',
                body: JSON.stringify(voto),
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Voto registrado com sucesso!');

                        // Atualize a lista de resultados após o voto ser registrado
                        const resultList = document.getElementById('resultList');
                        resultList.innerHTML = ''; // Limpe a lista atual

                        // Faça uma solicitação para obter os resultados atualizados dos candidatos
                        fetch("http://localhost:5000/consultavoto.php")
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    data.forEach(candidato => {
                                        resultList.innerHTML += `<li>${candidato.nome_candidato}: ${candidato.votos} votos</li>`;
                                    });
                                } else {
                                    resultList.innerHTML = "<li>Nenhum voto registrado ainda.</li>";
                                }
                            })
                            .catch(error => {
                                console.error('Erro ao obter os resultados: ' + error);
                            });
                    } else {
                        alert('Erro ao registrar o voto: ' + data.error);
                    }
                })
                .catch(error => {
                    alert('Erro ao enviar o voto: ' + error);
                });
        }
    });
});