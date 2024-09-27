<?php
require 'db.php';
require 'corredor.class.php';

session_start();

// Verificação de sessão
if (!isset($_SESSION['corredor_id'])) {
    // Redireciona o usuário não logado para a página de login
    header('Location: login.php');
    exit(); // Garante que o script pare de rodar após o redirecionamento
}

// Caso o usuário esteja logado, carrega os corredores
$corredores = Corredor::todos($pdo);
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
    <title>Lista de Corredores</title>
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
        .table-container {
            margin-top: 2rem;
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
            <h1 class="text-4xl font-bold">Lista de Corredores</h1>
            <p class="mt-4 text-lg">Veja todos os corredores cadastrados e seus tempos de corrida.</p>
        </div>
    </div>

    <!-- Lista de Corredores -->
    <div class="container table-container">
        <table class="table table-hover table-striped shadow-lg rounded-lg overflow-hidden">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Idade</th>
                    <th>Tempo (min)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($corredores as $corredor) : ?>
        <tr>
            <td><?= htmlspecialchars($corredor['nome']) ?></td>
            <td><?= htmlspecialchars($corredor['email']) ?></td>
            <td><?= htmlspecialchars($corredor['idade']) ?></td>
            <td><?= htmlspecialchars($corredor['tempo']) ?> min</td>
            <td>
                <a href="editar.php?id=<?= $corredor['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="deletar.php?id=<?= $corredor['id'] ?>" class="btn btn-danger btn-sm">Deletar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer text-center mt-5">
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
