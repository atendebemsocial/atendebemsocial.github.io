<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serversocial";

// Criar conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Receber dados do formulário
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$atendimento = $_POST['atendimento'];
$atendente = $_POST['atendente'];
$datahora = $_POST['datahora'];

// Inserir dados no banco de dados
$sql = "INSERT INTO cadunico (nome, cpf, atendimento, atendente, datahora)
        VALUES ('$nome', '$cpf', '$atendimento', '$atendente', '$datahora')";

if ($conn->query($sql) === TRUE) {
    // Redirecionar de volta ao formulário com mensagem de sucesso
    header("Location: formulario.html?success=true");
    exit();
} else {
    echo "Erro ao inserir no banco de dados: " . $conn->error;
}

$conn->close();
?>
