// Simulação de dados de transações iniciais
const transactions = [
    { description: 'Depósito', amount: 5000 },
    { description: 'Compra - Supermercado', amount: -150 },
    { description: 'Transferência', amount: -200 },
];

function loadTransactions() {
    const transactionList = document.getElementById('transactionList');
    transactionList.innerHTML = '';
    transactions.forEach((transaction) => {
        const transactionItem = document.createElement('li');
        transactionItem.classList.add('transaction-item');
        transactionItem.classList.add(transaction.amount < 0 ? 'negative' : 'positive');
        transactionItem.innerHTML = `
            <span>${transaction.description}</span>
            <span>${transaction.amount < 0 ? '-' : ''}R$ ${Math.abs(transaction.amount).toFixed(2)}</span>
        `;
        transactionList.appendChild(transactionItem);
    });

    updateBalance();
}

function updateBalance() {
    const balance = transactions.reduce((acc, transaction) => acc + transaction.amount, 0);
    document.getElementById('userBalance').textContent = `R$ ${balance.toFixed(2)}`;
}

document.getElementById('transactionForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const description = document.getElementById('transactionDesc').value;
    const amount = parseFloat(document.getElementById('transactionAmount').value);
    
    if (!description || isNaN(amount)) return;

    transactions.push({ description, amount })
    loadTransactions();

    document.getElementById('transactionDesc').value = '';
    document.getElementById('transactionAmount').value = '';
});

// Carregar transações ao iniciar
loadTransactions();
