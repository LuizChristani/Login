<?php
require_once 'classes/Sessao.php';
require_once 'classes/Autenticador.php';

Sessao::iniciar();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$lembrar = isset($_POST['lembrar']) ? true : false;

$autenticador = new Autenticador();

$resultado = $autenticador->login($email, $senha, $lembrar);

if ($resultado === true) {
    header("Location: dashboard.php");
    exit;
} else {
    Sessao::set('erro', $resultado);
    header("Location: login.php");
    exit;
}