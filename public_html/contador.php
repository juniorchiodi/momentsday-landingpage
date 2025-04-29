<?php
$arquivo = 'visitas.json';

if (!file_exists($arquivo)) {
    echo json_encode([]);
    exit;
}

$dados = json_decode(file_get_contents($arquivo), true);

if (!is_array($dados)) {
    echo json_encode([]);
    exit;
}

header('Content-Type: application/json');
echo json_encode($dados);