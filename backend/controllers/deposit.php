<?php
session_start();
include('../../config.php');

if (isset($_POST['deposit'])) {
  // corrigir isso antes que eu envie um valor errado no array $_POST['amount']
  // o array nao esta achando onome corresponde do usuario na pasta, pq em si cada usuario nao recebe nd na pasta só ela vazia.
  // adicionar um arquivo de identifucaçao na pasta do usuario 
  $username = $_SESSION['username'];
  $recipient = $_POST['recipient'];
  $amount = $_POST['amount'];

  $sql = "SELECT * FROM users WHERE username='$recipient'";
  // Filha da puta foi o arrombado que disse que fazia funcionar sem $conn e usa a prr da variavel $cc no codigo sem dar nome nela 
  $conn = new mysqli(hostname: 'localhost', username: 'root', password: '', database: 'user_system');
  $result = $conn->query(query: $sql);

  if ($result->num_rows > 0) {
    $sql_update = "UPDATE users SET balance = balance + $amount WHERE username='$recipient'";
    if ($conn->query(query: $sql_update) === TRUE) {
      echo "Transferência realizada!";
    } else {
      echo "Erro na transferência: " . $conn->error;
    }
  } else {
    echo "Destinatário não encontrado!";
  }
}
?>
