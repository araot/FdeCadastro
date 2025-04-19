<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="/FdeCadastro/estilo/estilo.css">
</head>

<body>

    <h1>Cadastrar Usuário</h1>

    <?php
require 'conexao.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($nome && $email && $senha) {
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senhaCriptografada);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>
    <?php
require 'conexao.php';
?>
    <div class="container">

        <form method="post">
            Nome: <input type="text" name="nome" required><br>
            Email: <input type="email" name="email" required><br>
            Senha: <input type="password" name="senha" required><br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>

</html>