<?php
session_start();

if (!((isset($_SESSION['login']) && $_SESSION['login'] == true) && isset($_SESSION['jabatan']) && (isset($_SESSION['email']) && $_SESSION['email'] != null && $_SESSION['email'] != ''))) {
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    $url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1] . '/' . $uri[2];
    header('Location: ' . $url . '/auth');
}
?>