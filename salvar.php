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

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepara os dados para inserção no banco de dados
    $nome = $_POST["nome"];
    $dataNascimento = $_POST["dataNascimento"];

    // Prepara a consulta SQL para inserir os dados no banco de dados
    $sql = "INSERT INTO aniversariantes (nome, data_nascimento) VALUES ('$nome', '$dataNascimento')";

    // Executa a consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso.";
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }
} else {
    echo "Nenhum dado recebido do formulário.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
