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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        echo json_encode(array("error" => "Dados inválidos."));
        exit();
    }

    if (isset($data['Nome']) && isset($data['Senha']) && isset($data['Email'])) {
        $Nome = $data['Nome'];
        $Senha = $data['Senha'];
        $Email = $data['Email'];

        $query = "INSERT INTO estudantes (nome_estudante, senha, email) VALUES ('$Nome', '$Senha', '$Email')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo json_encode(array("error" => "Erro ao cadastrar usuário: " . mysqli_error($conn)));
            exit();
        } else {
            session_start();
            $_SESSION['email'] = $Email;
            $_SESSION['senha'] = $Senha;
            $_SESSION['nome_estudante'] = $Nome;

            echo json_encode(array("success" => true));
        }
    } else {
        echo json_encode(array("error" => "Campos obrigatórios não preenchidos."));
    }
} else {
    echo json_encode(array("error" => "Método de requisição inválido."));
}

mysqli_close($conn);
?>
