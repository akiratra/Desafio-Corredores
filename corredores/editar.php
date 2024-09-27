<?php
require 'db.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['corredor_id'])) {
    header('Location: login.php');
    exit();
}

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header('Location: corredores.php');
    exit();
}

$id = $_GET['id'];

// Busca o corredor pelo ID
$stmt = $pdo->prepare("SELECT * FROM corredores WHERE id = ?");
$stmt->execute([$id]);
$corredor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $tempo = $_POST['tempo'];

    // Atualiza o corredor no banco de dados
    $stmt = $pdo->prepare("UPDATE corredores SET nome = ?, email = ?, idade = ?, tempo = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $idade, $tempo, $id]);

    // Log de alteração
    $usuario_id = $_SESSION['corredor_id'];
    $data_hora = date('Y-m-d H:i:s');
    $stmt_log = $pdo->prepare("INSERT INTO log (usuario_id, acao, data_hora) VALUES (?, 'Alterou corredor com ID $id', ?)");
    $stmt_log->execute([$usuario_id, $data_hora]);

    header('Location: corredores.php');
    exit();
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
    <title>Editar Corredor</title>
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
                    <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero text-center">
        <div class="container">
            <h1 class="text-4xl font-bold">Editar Corredor</h1>
            <p class="mt-4 text-lg">Faça as alterações necessárias.</p>
        </div>
    </div>

    <div class="container mt-5">
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($corredor['nome']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($corredor['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" class="form-control" id="idade" name="idade" value="<?= htmlspecialchars($corredor['idade']) ?>" required>
            </div>
            <div class="form-group">
                <label for="tempo">Tempo (min):</label>
                <input type="number" class="form-control" id="tempo" name="tempo" value="<?= htmlspecialchars($corredor['tempo']) ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="corredores.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div><br><br>

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
