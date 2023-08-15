<!DOCTYPE html>
<html>
<head>
    <title>Resultados da Pesquisa</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('texturapapel.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #4a60df94;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        .results-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            margin-right: 15px;
            text-align: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-nova-pesquisa, .btn-home, .btn-print {
            background-color: #84e713a1;
            text-decoration: none;
            color: #000;
            border: none;
            padding: 10px 10px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease-in-out;
            margin-top: 15px;
            display: inline-block;
            margin-right: 10px;
        }

        .btn-nova-pesquisa:hover, .btn-home:hover, .btn-print:hover {
            background-color: #1fb34b;
        }

        /* Estilos para impressão */
        @media print {
            .results-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background-color: white;
                box-shadow: none;
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="results-container">
        <h1>Resultados da Pesquisa</h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "serversocial";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        $pesquisa = $_GET['pesquisa'];

        $sql = "SELECT * FROM cadunico WHERE cpf = '$pesquisa'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Tipo de Atendimento</th>
                        <th>Atendente</th>
                        <th>Data e Hora</th>
                    </tr>';

            while ($row = $result->fetch_assoc()) {
                $dataHoraFormatada = date('d/m/Y H:i', strtotime($row['datahora']));
                echo '<tr>
                        <td>' . $row['nome'] . '</td>
                        <td>' . $row['cpf'] . '</td>
                        <td>' . $row['atendimento'] . '</td>
                        <td>' . $row['atendente'] . '</td>
                        <td>' . $dataHoraFormatada . '</td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo '<p>Nenhum resultado encontrado para o CPF: ' . $pesquisa . '</p>';
        }

        $conn->close();
        ?>
        <a href="javascript:window.print()" class="btn-print">Imprimir</a>
        <a href="pesquisar.html" class="btn-nova-pesquisa">Nova Pesquisa</a>
        <a href="index.html" class="btn-home">Página Inicial</a>
    </div>
</body>
</html>
