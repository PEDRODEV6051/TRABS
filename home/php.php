<?php
// Configuração do banco de dados
$host = 'localhost'; // Nome do servidor, geralmente 'localhost' para XAMPP
$dbname = 'seu_banco_de_dados'; // Nome do banco de dados
$username = 'root'; // Usuário do banco de dados (padrão no XAMPP)
$password = ''; // Senha do banco de dados (deixe em branco no XAMPP)

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $nome_usuario = $_POST['nome-usuario'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $data_nascimento = $_POST['data-nascimento'];
    $sexo = $_POST['sexo'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar-senha'];

    // Valida se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem!";
        exit;
    }

    // Criptografa a senha antes de salvar no banco
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Preparação da query SQL para inserir os dados no banco
    $sql = "INSERT INTO usuarios (nome, nome_usuario, email, cpf, endereco, data_nascimento, sexo, senha)
            VALUES (:nome, :nome_usuario, :email, :cpf, :endereco, :data_nascimento, :sexo, :senha)";
    
    $stmt = $pdo->prepare($sql);

    // Binding dos parâmetros para prevenir SQL Injection
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':nome_usuario', $nome_usuario);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':senha', $senha_hash);

    // Executa a query
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
        // Após o cadastro, redireciona para a página de login
        header("Location: ../index.html");
        exit;
    } else {
        echo "Erro ao cadastrar. Tente novamente.";
    }
}
?>
