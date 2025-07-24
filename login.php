<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<table>
  <tr class="nav">
    <td><a href="index.php">Home</a></td>
    <td><a href="about.php">About</a></td>
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

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
          $user = $result->fetch_assoc();
          if (password_verify($password, $user['password'])) {
            echo "<p style='color:green;'>Login successful!</p>";
          } else {
            echo "<p style='color:red;'>Incorrect password.</p>";
          }
        } else {
          echo "<p style='color:red;'>No account found.</p>";
        }

        $stmt->close();
      }
      ?>

      <form method="post">
        <label for="login-email">Email:</label>
        <input type="email" name="email" id="login-email" placeholder="Enter your email" required>

        <label for="login-password">Password:</label>
        <input type="password" name="password" id="login-password" placeholder="Enter your password" required>

        <div class="option-group">
          <label><input type="checkbox" id="remember"> Remember me</label>
        </div>

        <input type="submit" value="Login">
      </form>
    </td>
    <td colspan="2" class="sidebar">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
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
