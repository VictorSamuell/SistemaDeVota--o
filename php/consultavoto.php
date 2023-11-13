<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
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
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Recebe os dados em JSON e decodifica
    // Verifique se o número do candidato e o email são válidos
    $query = "SELECT numero_candidato, nome_candidato, votos FROM candidatos";
    $results = mysqli_query($conn, $query);

    if (!$results) {
        echo json_encode(array("error" => "Erro ao consultar os votos."));
        exit;
    }

    $resultList = array();

    while ($row = mysqli_fetch_assoc($results)) {
        $resultList[] = array(
            "nome_candidato" => $row['nome_candidato'],
            "numero_candidato" => $row['numero_candidato'],
            "votos" => $row['votos']
        );
    }


    mysqli_close($conn);

    echo json_encode($resultList);
}
?>