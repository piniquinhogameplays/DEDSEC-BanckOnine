<?php
include('../../config.php');

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $user_dir = "../../users/" . $username;

  $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
  $conn = new mysqli (hostname: 'localhost', username: 'root', password: '', database: 'user_system');  
  $result = $conn->query(query: $sql);

  if ($result->num_rows == 0) {
    mkdir(directory: $user_dir);
    $sql = "INSERT INTO users (username, email, password, directory_path) VALUES ('$username', '$email', '$password', '$user_dir')";
    if ($conn->query(query: $sql) === TRUE) {
      echo "Usuário registrado com sucesso!";
      header(header: 'Location: ../../frontend/index.html');
    } else {
      echo "Erro ao registrar: " . $conn->error;
    }
  } else {
    echo "Usuário ou e-mail já cadastrado!";
  }
}
?>
