<?php
  session_start();
  include("./config/config.php");
  if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Address Book</title>
  <link rel="stylesheet" href="./css/main.css" />
</head>
<body>
  <!-- Navbar -->
  <div class="topnav">
    <div class="nav-left">
      <div class="vector"></div>
      <span class="name">John Doe</span>
    </div>
    <div class="nav-right">
      <a href="./functions/logout.php">Logout</a>
    </div>
  </div>
  <!-- Content -->
  <div class="page_content">
    <div class="options">
      <div class="search">
        <input type="text" placeholder="Search..">
        <!-- <button>a</button> -->
      </div>
      <button>Add contact</button>
    </div>
    <table class="container">
      <tr>
        <th>Name</th>
        <th>City</th>
        <th>Phone number</th>
        <th>E-mail</th>
        <th>Options</th>
      </tr>
      <tr>
        <td>
          <div>JP</div>
        </td>
        <td>Tunis</td>
        <td>87985177</td>
        <td>javier.pena@dea.com</td>
        <td></td>
      </tr>
      <tr>
        <td>
          <div>JP</div>
        </td>
        <td>Tunis</td>
        <td>87985177</td>
        <td>javier.pena@dea.com</td>
        <td></td>
      </tr>
    </table>
  </div>
</body>
</html>