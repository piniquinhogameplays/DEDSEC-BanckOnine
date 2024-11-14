<?php
// Inicializa a sessão e as transações se ainda não existirem
if (!isset($_SESSION['transactions'])) {
    $_SESSION['transactions'] = [
        ['description' => 'Depósito', 'amount' => 5000],
        ['description' => 'Compra - Supermercado', 'amount' => -150],
        ['description' => 'Transferência', 'amount' => -200],
    ];
}

// Função para obter todas as transações
function getTransactions() {
    return $_SESSION['transactions'];
}

// Função para calcular o saldo atual
function getBalance() {
    return array_reduce($_SESSION['transactions'], function ($carry, $item) {
        return $carry + $item['amount'];
    }, 0);
}

// Função para adicionar uma nova transação
function addTransaction($description, $amount) {
    $_SESSION['transactions'][] = [
        'description' => $description,
        'amount' => $amount
    ];
}
?>