<?php
session_start();
include('../../config.php');

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $conn = new mysqli(hostname: 'localhost', username: 'root', password: '', database: 'user_system');
  $result = $conn->query(query: $sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['username'] = $user['username'];
      header('Location: ../../frontend/dashboard.html');
    } else {
      echo "Senha incorreta!";
    }
  } else {
    echo "Usuário não encontrado!";
  }
}
?>
