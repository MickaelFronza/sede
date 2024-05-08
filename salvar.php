<?php
// Conectar ao banco de dados
$servername = "localhost"; // ou endereço IP do servidor
$username = "umadcamcom_niversede";
$password = "Hl6KUj2VRAinJ19";
$dbname = "umadcamcom_niversede";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Prepara a consulta SQL para obter os aniversariantes por mês
$sql = "SELECT MONTH(data_nascimento) as mes, DAY(data_nascimento) as dia, nome FROM aniversariantes ORDER BY MONTH(data_nascimento), DAY(data_nascimento)";

$result = $conn->query($sql);

$aniversariantes = array();

if ($result->num_rows > 0) {
    // Output dos dados de cada linha
    while($row = $result->fetch_assoc()) {
        $mes = intval($row["mes"]);
        $dia = intval($row["dia"]);
        $nome = $row["nome"];
        $aniversariantes[$mes][] = array("dia" => $dia, "nome" => $nome);
    }
}

$conn->close();

// Retornar os aniversariantes em formato JSON
echo json_encode($aniversariantes);
?>
