// Simulação de um banco de dados usando localStorage
const databaseKey = "usersDB";

// Recupera usuários do localStorage
function getUsers() {
    const users = localStorage.getItem(databaseKey);
    return users ? JSON.parse(users) : [];
}

// Salva usuários no localStorage
function saveUsers(users) {
    localStorage.setItem(databaseKey, JSON.stringify(users));
}

// Adiciona um novo usuário ao banco
function registerUser(username, password) {
    const users = getUsers();
    if (users.some(user => user.username === username)) {
        alert("Usuário já cadastrado!");
        return false;
    }
    users.push({ username, password });
    saveUsers(users);
    alert("Cadastro realizado com sucesso!");
    return true;
}

// Valida login
function loginUser(username, password) {
    const users = getUsers();
    return users.some(user => user.username === username && user.password === password);
}

// Manipula o formulário de login
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const username = document.getElementById("usuario").value;
    const password = document.getElementById("senha").value;

    if (loginUser(username, password)) {
        alert("Login realizado com sucesso!");
        window.location.href = "dashboard.html"; // Redireciona para outra página
    } else {
        alert("Usuário ou senha inválidos!");
    }
});

// Manipula o link de cadastro
document.getElementById("registerLink").addEventListener("click", function (e) {
    e.preventDefault();
    const username = prompt("Digite seu nome de usuário:");
    const password = prompt("Digite sua senha:");

    if (username && password) {
        registerUser(username, password);
    }
});
