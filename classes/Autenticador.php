<?php
require_once 'Usuario.php';
require_once 'Sessao.php';

class Autenticador {
    private $usuarios = [];
    
    public function __construct() {
        Sessao::iniciar();
        if (Sessao::existe('usuarios')) {
            $this->usuarios = Sessao::get('usuarios');
        }
    }

    public function registrar($nome, $email, $senha) {
        if (empty($nome) || empty($email) || empty($senha)) {
            return "Todos os campos são obrigatórios";
        }
        
        $nome = htmlspecialchars($nome);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email inválido";
        }
        
        foreach ($this->usuarios as $usuario) {
            if ($usuario['email'] === $email) {
                return "Este email já está registrado";
            }
        }
        
        $usuario = new Usuario($nome, $email, $senha);
        $this->usuarios[$email] = $usuario->paraArray();
        
        Sessao::set('usuarios', $this->usuarios);
        
        return true;
    }

    public function login($email, $senha, $lembrar = false) {
        if (empty($email) || empty($senha)) {
            return "Email e senha são obrigatórios";
        }
        
        if (!isset($this->usuarios[$email])) {
            return "Email ou senha incorretos";
        }
        
        $userData = $this->usuarios[$email];

        if (!password_verify($senha, $userData['senha'])) {
            return "Email ou senha incorretos";
        }

        Sessao::set('usuario_logado', true);
        Sessao::set('usuario_nome', $userData['nome']);
        Sessao::set('usuario_email', $email);
        
        if ($lembrar) {
            setcookie('email_lembrado', $email, time() + (86400 * 30), "/"); // 30 dias
        }
        
        return true;
    }

    public function estaLogado() {
        return Sessao::existe('usuario_logado') && Sessao::get('usuario_logado') === true;
    }

    public function logout() {
        Sessao::destruir();
    }
}