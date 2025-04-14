<?php
class Usuario {
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome, $email, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function verificarSenha($senha) {
        return password_verify($senha, $this->senha);
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenhaHash() {
        return $this->senha;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    public function paraArray() {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ];
    }
}