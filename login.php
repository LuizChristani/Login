<?php
require_once 'classes/Sessao.php';
require_once 'classes/Autenticador.php';

Sessao::iniciar();

$autenticador = new Autenticador();
if ($autenticador->estaLogado()) {
    header("Location: dashboard.php");
    exit;
}

$erro = Sessao::get('erro');
$sucesso = Sessao::get('sucesso');
Sessao::remover('erro');
Sessao::remover('sucesso');

$emailSalvo = isset($_COOKIE['email_lembrado']) ? $_COOKIE['email_lembrado'] : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .register-link {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    
    <?php if ($erro): ?>
        <div class="error"><?php echo $erro; ?></div>
    <?php endif; ?>
    
    <?php if ($sucesso): ?>
        <div class="success"><?php echo $sucesso; ?></div>
    <?php endif; ?>
    
    <form action="processa_login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($emailSalvo); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="lembrar" <?php echo $emailSalvo ? 'checked' : ''; ?>>
                Lembrar meu email
            </label>
        </div>
        
        <button type="submit">Entrar</button>
    </form>
    
    <div class="register-link">
        Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
    </div>
</body>
</html>