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

// Array para armazenar os aniversariantes por mês
$aniversariantes_por_mes = array();

// Consulta SQL para obter os aniversariantes de cada mês
$sql = "SELECT MONTH(data_nascimento) as mes, DAY(data_nascimento) as dia, nome FROM aniversariantes ORDER BY MONTH(data_nascimento), DAY(data_nascimento)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output dos dados de cada linha
    while($row = $result->fetch_assoc()) {
        $mes = intval($row["mes"]);
        $dia = intval($row["dia"]);
        $nome = $row["nome"];
        // Adiciona o aniversariante ao array do respectivo mês
        $aniversariantes_por_mes[$mes][] = array("dia" => $dia, "nome" => $nome);
    }
}

$conn->close();

// Obtém o mês atual
$mes_atual = date('n');

// Função para formatar o nome do mês
function nome_mes($numero_mes) {
    $meses = array(1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    return $meses[$numero_mes];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Relatório de Aniversariantes</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
<h1>Relatório de Aniversariantes</h1>
<?php
// Loop pelos meses do ano
for ($mes = 1; $mes <= 12; $mes++) {
    // Obtém o nome do mês
    $nome_do_mes = nome_mes($mes);
    // Exibe o título do mês
    echo "<h2>$nome_do_mes</h2>";
    // Verifica se há aniversariantes para este mês
    if (isset($aniversariantes_por_mes[$mes])) {
        // Exibe a tabela de aniversariantes para este mês
        echo "<table>";
        echo "<tr><th>Dia</th><th>Nome</th></tr>";
        foreach ($aniversariantes_por_mes[$mes] as $aniversariante) {
            $dia = $aniversariante['dia'];
            $nome = $aniversariante['nome'];
            echo "<tr><td>$dia</td><td>$nome</td></tr>";
        }
        echo "</table>";
    } else {
        // Se não houver aniversariantes para este mês, exibe uma mensagem
        echo "<p>Não há aniversariantes para este mês.</p>";
    }
}
?>
</body>
</html>
