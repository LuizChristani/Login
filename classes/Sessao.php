<?php
class Sessao {
    public static function iniciar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($chave, $valor) {
        self::iniciar();
        $_SESSION[$chave] = $valor;
    }

    public static function get($chave, $padrao = null) {
        self::iniciar();
        return isset($_SESSION[$chave]) ? $_SESSION[$chave] : $padrao;
    }

    public static function existe($chave) {
        self::iniciar();
        return isset($_SESSION[$chave]);
    }

    public static function remover($chave) {
        self::iniciar();
        if (isset($_SESSION[$chave])) {
            unset($_SESSION[$chave]);
        }
    }

    public static function destruir() {
        self::iniciar();
        $_SESSION = [];
            if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
}