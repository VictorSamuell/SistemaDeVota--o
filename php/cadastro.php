<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-type: application/json');


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


    // Verifique se o número do candidato e o email são válidos
    
    if(isset($data['Nome'])){
        $Nome = $data['Nome'];
    }


    if(isset($data['Senha'])){
        $Senha = $data['Senha'];
    }


    if(isset($data['Email'])){
        $Email = $data['Email'];
    }

    

    // Consulta o banco de dados para atualizar os votos do candidato
    $query = "INSERT INTO estudantes (nome_estudante, senha, email) VALUES ('$Nome', '$Senha', '$Email')";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode(array("error" => "Erro ao registrar o voto: " . mysqli_error($conn)));
        exit();
    } else {
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION['email'] = $Email;
        $_SESSION['senha'] = $Senha;
        $_SESSION['nome_estudante'] = $Nome;

        echo json_encode(array("success" => true));

        

    }


    if (mysqli_query($conn, $query)) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("error" => "Erro ao registrar o voto: " . mysqli_error($conn)));
    }
} else {
    echo json_encode(array("error" => "Método de requisição inválido."));
}

mysqli_close($conn);