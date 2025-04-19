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
    header("Location:login.php");
    exit;
}

require 'conexao.php';

$id = $_GET['id'] ?? '';

if ($id) {
    // Buscar o usuário para editar
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        $nome = $usuario['nome'];
        $email = $usuario['email'];
    } else {
        echo "Usuário não encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($nome && $email) {
        // Atualizar os dados do usuário
        $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssi", $nome, $email, $id);

        if ($stmt->execute()) {
            echo "Usuário atualizado com sucesso!";
            header("Location: index.php");
            exit;
        } else {
            echo "Erro: " . $stmt->error;
        }
    }
}
?>

    <h2>Editar Usuário</h2>

    <form method="post">
        Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
        <button type="submit">Atualizar</button>
    </form>
</body>

</html>