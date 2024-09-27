<?php
require 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM corredores WHERE email = ?");
    $stmt->execute([$email]);
    $corredor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($corredor && password_verify($senha, $corredor['senha'])) {
        $_SESSION['corredor_id'] = $corredor['id'];
        header('Location: corredores.php');
    } else {
        $erro = "Email ou senha incorretos";
    }
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
    <title>Login</title>
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

    <!-- Hero Section -->
    <div class="hero text-center">
        <div class="container">
            <h1 class="text-4xl font-bold">Bem-vindo ao Portal de Corredores</h1>
            <p class="mt-4 text-lg">Entre para acessar sua conta e ver sua performance.</p>
        </div>
    </div>

    <!-- Formulário de Login -->
    <div class="container mt-8 mb-8">
        <div class="w-full max-w-md mx-auto bg-white shadow-lg p-8 rounded-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>
            <?php if (isset($erro)) { echo "<div class='alert alert-danger text-center'>$erro</div>"; } ?>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Entrar</button>
            </form>
            <p class="text-center mt-4">Não tem uma conta? <a href="cadastro.php" class="text-blue-600 hover:underline">Cadastre-se aqui</a></p>
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
