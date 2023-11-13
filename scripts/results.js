function carregarConteudo() {
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
}

carregarConteudo();