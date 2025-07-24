<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
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
      <h1>Create Your Account</h1>
      <p>Join Murtaza Rasheed's journey!</p>
    </td>
  </tr>
  <tr>
    <td colspan="4" class="content">
      <h2>Sign Up</h2>

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = trim($_POST["fullname"]);
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $dob = $_POST["dob"];
        $gender = $_POST["gender"] ?? null;

        $sql = "INSERT INTO users (fullname, username, email, password, dob, gender) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fullname, $username, $email, $password, $dob, $gender);

        if ($stmt->execute()) {
          echo "<p style='color:green;'>Registration successful!</p>";
        } else {
          echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
      }
      ?>

      <form id="registerForm" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" placeholder="Enter your full name">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Enter a username">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email address">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter a strong password">

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob">

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
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
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
