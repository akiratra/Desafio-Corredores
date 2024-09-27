<?php
require 'db.php';
require 'corredor.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $tempo = $_POST['tempo'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografando a senha

    $corredor = new Corredor($nome, $email, $idade, $tempo, $senha);
    $corredor->salvar($pdo);

    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro de Corredor</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 4rem 0;
        }
        .navbar-custom {
            background-color: #343a40;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 2rem 0;
        }
        .footer a {
            color: #6c757d;
            text-decoration: none;
        }
        .footer a:hover {
            color: #495057;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Corredores</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="hero text-center">
        <div class="container">
            <h1 class="text-4xl font-bold">Cadastre-se no Time de Corredores</h1>
            <p class="mt-4 text-lg">Faça parte de uma comunidade de corredores e melhore seu desempenho.</p>
        </div>
    </div>

    <!-- Formulário de Cadastro -->
    <div class="container mt-8 mb-8">
        <div class="w-full max-w-md mx-auto bg-white shadow-lg p-8 rounded-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Cadastre-se</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
                </div>
                <div class="form-group">
                    <label for="idade">Idade:</label>
                    <input type="number" class="form-control" id="idade" name="idade" placeholder="Sua idade" required>
                </div>
                <div class="form-group">
                    <label for="tempo">Tempo (min):</label>
                    <input type="number" class="form-control" id="tempo" name="tempo" placeholder="Tempo de corrida" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Cadastrar</button>
            </form>
            <p class="text-center mt-4">Já tem uma conta? <a href="login.php" class="text-blue-600 hover:underline">Faça login</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 Corredores. Todos os direitos reservados.</p>
            <p class="mt-2">
                <a href="#">Termos de Uso</a> | 
                <a href="#">Política de Privacidade</a> | 
                <a href="#">Contato</a>
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
