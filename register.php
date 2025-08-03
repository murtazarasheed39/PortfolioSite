<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db_connect.php';

    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    if (empty($fullname) || empty($username) || empty($email) || empty($_POST['password'])) {
        $message = "Please fill in all required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password, dob, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullname, $username, $email, $password, $dob, $gender);

        if ($stmt->execute()) {
            $message = "Registration successful!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
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
      <h1>Create Your Account</h1>
      <p>Join Murtaza Rasheed's journey!</p>
    </td>
  </tr>
  <tr>
    <td colspan="4" class="content">
      <h2>Sign Up</h2>
      <?php if (!empty($message)) echo "<p class='status-msg'>$message</p>"; ?>
      <form id="registerForm" action="register.php" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter a username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email address" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter a strong password" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob">

        <label>Gender:</label>
        <div class="option-group">
          <label><input type="radio" name="gender" value="male"> Male</label>
          <label><input type="radio" name="gender" value="female"> Female</label>
        </div>

        <input type="submit" value="Register">
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
      <p>Start your journey today!</p>
    </td>
  </tr>
  <tr class="footer">
    <td colspan="6">&copy; 2025 Murtaza Rasheed</td>
  </tr>
</table>
</body>
</html>
