<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/FdeCadastro/estilo/estilo.css">
</head>

<body>
    <?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require 'conexao.php';

$sql = "SELECT * FROM usuarios";
$resultado = $conexao->query($sql);
?>
    <div class="container">
        <h2>Usuários Cadastrados</h2>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>

            <?php while ($usuario = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a> |
                    <a href="excluir.php?id=<?php echo $usuario['id']; ?>"
                        onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>