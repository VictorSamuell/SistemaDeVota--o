<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-type: application/json');


session_start();

$hostname = "localhost";
$user = "root";
$password = "ifsp";
$database = "eleicao";

$conn = mysqli_connect($hostname, $user, $password, $database);

if (!$conn) {
    die("Erro de conexão com o banco de dados: " . mysqli_connect_error());
}

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados em JSON e decodifica

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        echo json_encode(array("error" => "Dados inválidos."));
        exit();
    }

    $sql = "SELECT * FROM ";




    // Verifique se o número do candidato e o email são válidos
    
    if(isset($data['NumeroCandidato'])) $numero_candidato = $data['NumeroCandidato'];
    else {
        $numero_candidato = 1;
    }


    if(isset($data['Email'])){
        $Email = $data['Email'];
    }

    

    // Consulta o banco de dados para atualizar os votos do candidato
    $query = "UPDATE candidatos SET votos = votos + 1 WHERE numero_candidato = $numero_candidato";

    if (mysqli_query($conn, $query)) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("error" => "Erro ao registrar o voto: " . mysqli_error($conn)));
    }
} else {
    echo json_encode(array("error" => "Método de requisição inválido."));
}

mysqli_close($conn);