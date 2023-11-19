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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        echo json_encode(array("error" => "Dados inválidos."));
        exit();
    }

   
    if (isset($data['Email']) && isset($data['Senha'])) {
        $Email = $data['Email'];
        $Senha = $data['Senha'];

        
        $query = "SELECT * FROM estudantes WHERE email = '$Email' AND senha = '$Senha'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo json_encode(array("error" => "Erro ao consultar o usuário: " . mysqli_error($conn)));
            exit();
        }

        if (mysqli_num_rows($result) > 0) {
            
            $_SESSION['email'] = $Email;
            $_SESSION['senha'] = $Senha;

            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("error" => "Credenciais inválidas."));
        }
    } else {
        echo json_encode(array("error" => "Campos obrigatórios não preenchidos."));
    }
} else {
    echo json_encode(array("error" => "Método de requisição inválido."));
}

mysqli_close($conn);
?>
