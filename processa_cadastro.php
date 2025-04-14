<?php
require_once 'classes/Sessao.php';
require_once 'classes/Autenticador.php';

Sessao::iniciar();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastro.php");
    exit;
}

$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$autenticador = new Autenticador();

$resultado = $autenticador->registrar($nome, $email, $senha);

if ($resultado === true) {
    Sessao::set('sucesso', 'Cadastro realizado com sucesso! Faça login.');
    header("Location: login.php");
    exit;
} else {
    Sessao::set('erro', $resultado);
    header("Location: cadastro.php");
    exit;
}