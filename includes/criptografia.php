<?php

/**
 * Aplica três camadas de criptografia sobre a senha, na ordem:
 * 1) MD5
 * 2) SHA1 (sobre o resultado do MD5)
 * 3) hash() com SHA-256 (sobre o resultado do SHA1)
 *
 * O resultado final é sempre uma string hexadecimal de 64 caracteres.
 */
function protegerSenha(string $senha): string
{
    $etapa1_md5  = md5($senha);
    $etapa2_sha1 = sha1($etapa1_md5);
    $etapa3_hash = hash('sha256', $etapa2_sha1);

    return $etapa3_hash;
}
