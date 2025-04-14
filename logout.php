<?php
require_once 'classes/Sessao.php';
require_once 'classes/Autenticador.php';
Sessao::iniciar();
$autenticador = new Autenticador();
$autenticador->logout();
header("Location: login.php");
exit;