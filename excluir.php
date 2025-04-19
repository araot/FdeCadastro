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

$id = $_GET['id'] ?? '';

if ($id) {
    // Excluir o usuário
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário excluído com sucesso!";
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao excluir: " . $stmt->error;
    }
}
?>
</body>

</html>