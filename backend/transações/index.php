<?php
require_once 'db_config.php';
$conn = dbConnect();
// Inicia a sessão para armazenar dados temporários
session_start();
// Inclui o arquivo de transações
require_once 'transactions.php';
// Define o nome do usuário
$userName = "João Silva";
// Processa a adição de uma nova transação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $amount = floatval($_POST['amount']);
    addTransaction($description, $amount);
}
// Obtém o saldo atual e o histórico de transações
$currentBalance = getBalance();
$transactions = getTransactions();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Bancário</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Bem-vindo, <?php echo htmlspecialchars($userName); ?></h1>
            <p>Saldo Atual: R$ <?php echo number_format($currentBalance, 2, ',', '.'); ?></p>
        </header>
        <section class="transactions">
            <h2>Histórico de Transações</h2>
            <ul id="transactionList">
                <?php foreach ($transactions as $transaction): ?>
                    <li class="transaction-item <?php echo $transaction['amount'] < 0 ? 'negative' : 'positive'; ?>">
                        <span><?php echo htmlspecialchars($transaction['description']); ?></span>
                        <span><?php echo $transaction['amount'] < 0 ? '-' : ''; ?>R$ <?php echo number_format(abs($transaction['amount']), 2, ',', '.'); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section class="add-transaction">
            <h2>Adicionar Transação</h2>
            <form method="POST" action="">
                <input type="text" name="description" placeholder="Descrição" required>
                <input type="number" name="amount" placeholder="Valor" required>
                <button type="submit">Adicionar</button>
            </form>
        </section>
    </div>
</body>
</html>
