<?php
// Exemplo básico de verificação de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Aqui você deve verificar o usuário e a senha com seu banco de dados
    // Para o exemplo, vamos apenas verificar se os valores são "admin" e "senha123"
    
    if ($usuario == "admin" && $senha == "senha123") {
        // Se o login for bem-sucedido, redireciona para a página de serviços
        header("Location: ../site/serviços/index.html");
        exit();
    } else {
        echo "Usuário ou senha inválidos.";
    }
}
?>
