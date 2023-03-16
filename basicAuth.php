<?php
session_set_cookie_params(604800, '/');
if (!isset($_SESSION)) {
    session_start();
}

$hashes = array(
    'canvas' => 'gb1tXiwnMbolY',
    'angelheart' => 'yHc9XfKB0Gyuk',
);

if (!empty($_SESSION['PHP_AUTH_USER']) && !empty($_SESSION['PHP_AUTH_PW'])) {
    // already authorized

} else {
    if (
        !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) ||
        !(isset($hashes[$_SERVER['PHP_AUTH_USER']]) &&
            password_verify($_SERVER['PHP_AUTH_PW'], $hashes[$_SERVER['PHP_AUTH_USER']]))
    ) {

        unset($_SESSION['PHP_AUTH_USER']);
        unset($_SESSION['PHP_AUTH_PW']);
        header('WWW-Authenticate: Basic realm="Enter username and password"');
        header('HTTP/1.0 401 Unauthorized');
        die('<h1>Error: Authorization Required</h1>');
    } else {
        $_SESSION['PHP_AUTH_USER'] = $_SERVER['PHP_AUTH_USER'];
        $_SESSION['PHP_AUTH_PW'] = $_SERVER['PHP_AUTH_PW'];
    }
}
