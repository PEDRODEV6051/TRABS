<?php
// Inclui a conexão com o banco de dados
include('conexao.php'); // Certifique-se de que o arquivo de conexão está configurado corretamente

// Recebe os dados do formulário de login
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Consulta SQL para verificar o usuário
$query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = mysqli_query($conexao, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Verifica se a senha digitada corresponde à senha armazenada
    if (password_verify($senha, $row['senha'])) {
        echo "Login bem-sucedido!";
        // Redirecione para a página inicial
        header("Location: home.php");
        exit();
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}
?>
