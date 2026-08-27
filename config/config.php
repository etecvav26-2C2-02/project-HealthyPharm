<?php

// Calcula a URL base do projeto automaticamente (funciona em qualquer subpasta,
// como admin/categorias/ ou admin/usuarios/), sem precisar hardcodar o caminho.

if (!defined('BASE_URL')) {

    $raizProjeto = realpath(__DIR__ . '/..');
    $raizServidor = realpath($_SERVER['DOCUMENT_ROOT']);

    $baseUrl = str_replace('\\', '/', str_replace($raizServidor, '', $raizProjeto));

    define('BASE_URL', $baseUrl);
}
