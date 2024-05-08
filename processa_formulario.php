<?php
// Conexão com o banco de dados
$servername = "localhost"; // ou endereço IP do servidor
$username = "umadcamcom_niversede";
$password = "Hl6KUj2VRAinJ19";
$dbname = "umadcamcom_niversede";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Recebe os dados do formulário
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];

// Verifica se o nome já existe no banco de dados
$sql_check = "SELECT * FROM usuarios WHERE nome = '$nome'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Nome já existe, exibe uma mensagem de erro
    echo "Erro: Este nome já está cadastrado!";
} else {
    // Prepara e executa a query SQL para inserir os dados
    $sql_insert = "INSERT INTO usuarios (nome, data_nascimento) VALUES ('$nome', '$data_nascimento')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
