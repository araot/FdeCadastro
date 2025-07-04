<?php
// Início da sessão
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Conexão com o banco
require 'conexao.php';

$usuario = $_SESSION['usuario'];

// Buscar total de usuários cadastrados
$sql = "SELECT COUNT(*) AS total FROM usuarios";
$result = $conexao->query($sql);
$total_usuarios = $result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Usuários</title>
    <link rel="stylesheet" href="/FdeCadastro/estilo/estilo.css">

    <style>
    .dashboard-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
    }

    .card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 25px;
        width: 250px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h3 {
        font-size: 1.2rem;
        color: #444;
    }

    .card p {
        font-size: 2rem;
        color: #4CAF50;
        font-weight: bold;
        margin-top: 10px;
    }

    nav ul {
        list-style: none;
        text-align: center;
        margin-top: 30px;
        padding: 0;
    }

    nav ul li {
        display: inline-block;
        margin: 0 15px;
    }

    nav ul li a {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s;
    }

    nav ul li a:hover {
        background-color: #388E3C;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>Olá, <?php echo htmlspecialchars($usuario); ?> 👋</h2>
        <p>Bem-vindo ao seu painel de controle!</p>

        <div class="dashboard-cards">
            <div class="card">
                <h3>Usuários Cadastrados</h3>
                <p><?php echo $total_usuarios; ?></p>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="/FdeCadastro/cadastrar.php">Cadastrar Novo Usuário</a></li>
                <li><a href="/FdeCadastro/index.php">Ver Lista de Usuários</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </div>

</body>

</html>