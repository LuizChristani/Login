<?php
require_once 'classes/Sessao.php';
require_once 'classes/Autenticador.php';

Sessao::iniciar();

$autenticador = new Autenticador();
if (!$autenticador->estaLogado()) {
    header("Location: login.php");
    exit;
}

$nome = Sessao::get('usuario_nome');
$email = Sessao::get('usuario_email');

$emailSalvo = isset($_COOKIE['email_lembrado']) ? $_COOKIE['email_lembrado'] : false;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .welcome {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .info {
            margin-bottom: 15px;
            background-color: #e8f5ff;
            padding: 15px;
            border-radius: 12px;
        }
        .logout {
            text-align: right;
        }
        button {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="welcome">
        <h1>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h1>
        <p>Você está logado como: <?php echo htmlspecialchars($email); ?></p>
    </div>
    
    <?php if ($emailSalvo): ?>
    <div class="info">
        <h3>Cookie Ativo</h3>
        <p>Seu email (<?php echo htmlspecialchars($emailSalvo); ?>) está salvo em cookie para facilitar logins futuros.</p>
    </div>
    <?php endif; ?>
    
    <div class="logout">
        <a href="logout.php"><button>Sair</button></a>
    </div>
</body>
</html>