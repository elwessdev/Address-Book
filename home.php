<?php
  session_start();
  if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
  }
  include("./config/config.php");
  include("./functions/get_addresses.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./assets//favicon-32x32.png">
  <title>Address Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css" />
</head>
<body>
  <!-- Navbar -->
  <div class="topnav">
    <div class="nav-left">
      <span class="name">Hi <?php echo $_SESSION["user_name"] ?></span>
    </div>
    <div class="nav-right">
      <a href="./functions/logout.php">Logout</a>
    </div>
  </div>
  <!-- Content -->
  <div class="container address_content">
    <header>
      <div class="search">
        <input type="text" name="search" class="search_field" placeholder="Search..">
        <button type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
        </button>
      </div>
      <div class="buttons">
          <button type="button" class="btn-primary add-contact" data-bs-toggle="modal" data-bs-target="#add_address" data-bs-whatever="@mdo">Add address</button>
          <button class="export-contacts">Export addresses</button>
      </div>
    </header>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Phone number</th>
                <th>E-mail</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
          <?php
            if ($result->num_rows > 0) {
              while($address = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><span class="initials" style="background-color:#'.$address['bgColor'].';">'.htmlspecialchars(substr(strtoupper($address['name']),0,2)).'</span>'.htmlspecialchars($address['name']).'</td>';
                echo '<td>'.htmlspecialchars($address['city']).'</td>';
                echo '<td>'.htmlspecialchars($address['phone_number']).'</td>';
                echo '<td>'.htmlspecialchars($address['email']).'</td>';
                echo '<td><div class="btns">';
                echo '<button class="btn btn-primary edit-contact" data-bs-toggle="modal" data-bs-target="#edit_address" data-bs-whatever="@mdo"
                  data-name="'.$address['name'].'";
                  data-city="'.$address['city'].'";
                  data-phone="'.$address['phone_number'].'";
                  data-email="'.$address['email'].'";
                >Edit</button>';
                echo '<button class="btn btn-primary del-contact" data-bs-toggle="modal" data-bs-target="#delete_address" data-bs-whatever="@mdo"
                  data-name="'.$address['name'].'";
                  data-city="'.$address['city'].'";
                  data-phone="'.$address['phone_number'].'";
                  data-email="'.$address['email'].'";
                >Delete</button>';
                echo '</div></td>';
                echo '</tr>';
              }
            } else {
              echo '<tr><td colspan="5" style="text-align: center;">0 results</td></tr>';
            }
          ?>
        </tbody>
    </table>
  </div>
  <!-- Add -->
  <div class="modal fade" id="add_address" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="./functions/add_address.php" method="post" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add new address</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
              <label for="city" class="col-form-label">City:</label>
              <input type="text" class="form-control" name="city">
            </div>
            <div class="mb-3">
              <label for="Phone" class="col-form-label">Phone Number:</label>
              <input type="text" class="form-control" name="phone_number">
            </div>
            <div class="mb-3">
              <label for="Email" class="col-form-label">Email:</label>
              <input type="text" class="form-control" name="email">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="add">Add</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
  <!-- Modify -->
  <div class="modal fade" id="edit_address" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="./functions/edit_address.php" method="post" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit address</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <input name="oldName" id="oldName" type="hidden" value="" />
        <input name="oldCity" id="oldCity" type="hidden" value="" />
        <input name="oldPhone" id="oldPhone" type="hidden" value="" />
        <input name="oldEmail" id="oldEmail" type="hidden" value="" />
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" id="edit-name" name="name">
            </div>
            <div class="mb-3">
              <label for="city" class="col-form-label">City:</label>
              <input type="text" class="form-control" id="edit-city" name="city">
            </div>
            <div class="mb-3">
              <label for="Phone" class="col-form-label">Phone Number:</label>
              <input type="text" class="form-control" id="edit-phone" name="phone_number">
            </div>
            <div class="mb-3">
              <label for="Email" class="col-form-label">Email:</label>
              <input type="text" class="form-control" id="edit-email" name="email">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="add">Add</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
  <!-- Delete -->
  <div class="modal fade" id="delete_address" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="./functions/delete_address.php" method="post" class="modal-content">
        <input name="name" id="dlt-name" type="hidden" value="" />
        <input name="city" id="dlt-city" type="hidden" value="" />
        <input name="phone_number" id="dlt-phone" type="hidden" value="" />
        <input name="email" id="dlt-email" type="hidden" value="" />
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to delete this address ?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
</div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="js/home.js"></script>
</body>
</html>