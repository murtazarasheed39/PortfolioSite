<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db_connect.php';

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                $message = "Login successful!";
            } else {
                $message = "Invalid password.";
            }
        } else {
            $message = "No account found with that email.";
        }
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<table>
  <tr class="nav">
    <td><a href="index.html">Home</a></td>
    <td><a href="about.html">About</a></td>
    <td colspan="2"></td>
    <td><a href="login.php">Login</a></td>
    <td><a href="register.php">Register</a></td>
  </tr>
  <tr class="banner">
    <td colspan="6">
      <h1>Welcome Back</h1>
      <p>Login to your account</p>
    </td>
  </tr>
  <tr>
    <td colspan="4" class="content">
      <h2>Sign In</h2>
      <?php if (!empty($message)) echo "<p class='status-msg'>$message</p>"; ?>
      <form id="loginForm" action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <div class="option-group">
          <label><input type="checkbox" id="remember"> Remember me</label>
        </div>

        <input type="submit" value="Login">
      </form>
    </td>
    <td colspan="2" class="sidebar">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
      <p>New here? <a href="register.php">Register today!</a></p>
    </td>
  </tr>
  <tr class="footer">
    <td colspan="6">&copy; 2025 Murtaza Rasheed</td>
  </tr>
</table>
</body>
</html>
