<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serversocial";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter os dados para o gráfico de atendimentos por tipo
$tipoQuery = "SELECT atendimento, COUNT(*) AS quantidade FROM cadunico GROUP BY atendimento";
$tipoResult = $conn->query($tipoQuery);
$tipoData = array();
while ($row = $tipoResult->fetch_assoc()) {
    $tipoData[] = $row;
}

// Consulta para obter os dados para o gráfico de atendimentos por mês
$mesQuery = "SELECT MONTH(datahora) AS mes, COUNT(*) AS quantidade FROM cadunico GROUP BY mes";
$mesResult = $conn->query($mesQuery);
$mesData = array();
while ($row = $mesResult->fetch_assoc()) {
    $mesData[] = $row;
}

// Dados totais de atendimentos
$totalQuery = "SELECT COUNT(*) AS total FROM cadunico";
$totalResult = $conn->query($totalQuery);
$totalData = $totalResult->fetch_assoc();

$data = array(
    'tipos' => $tipoData,
    'meses' => $mesData,
    'total' => $totalData['total']
);

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
