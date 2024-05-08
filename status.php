<?php
// Configurações de conexão com o banco de dados
$servername = "localhost"; // ou endereço IP do servidor
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Tenta criar uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    // Se houver erro, exibe uma mensagem de erro
    die("Erro na conexão: " . $conn->connect_error);
} else {
    // Se a conexão foi bem-sucedida, exibe uma mensagem de sucesso
    echo "Conexão bem-sucedida com o banco de dados!";
}

// Fecha a conexão
$conn->close();
?>
