<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $servico = $_POST['servico'];
    $descricao = $_POST['descricao'];

    // Aqui você pode adicionar o código para enviar o e-mail ou salvar os dados em um banco de dados.

    echo "Orçamento solicitado com sucesso!";
} else {
    echo "Método de requisição inválido.";
}
?>
