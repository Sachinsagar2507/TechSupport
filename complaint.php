<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "customer";

$conn = mysqli_connect($server_name, $username, $password, $database_name);
// Now check the connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $Regarding = $_POST['Regarding'];
    $Complaint_in_Detail = $_POST['Complaint_in_Detail'];

    // Use prepared statements to prevent SQL injection
    $sql_query = "INSERT INTO complaint (name, email, Regarding, `Complaint in Detail`)
                  VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql_query);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $Regarding, $Complaint_in_Detail);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // Redirect to a new page after successful submission
        header("Location: success.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Complaint Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
  body {
    text-align: center;
    background-color:#adaae6;
  }
  h1 {
    margin-top: 140px;
  }
  .navigation-bar {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .navigation-bar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .navigation-bar li {
            float: left;
        }

        .navigation-bar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navigation-bar li a:hover {
            background-color: #111;
        }

        .nav-brands {
            background: #1e00ff;
            padding: 9px;
            border-radius: 2px;
            font-weight: bold;
        }
</style>
<body>
<div class="navigation-bar">
        <ul>
            <li><a class="nav-brands" href="home.php">Support Team</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="box.php">Chat</a></li>
            <li><a href="complaint.php">Complaint</a></li>
            <li style="float:right">
                <a href="logout.php">
                    <button class="btn btn-primary btn-block" style="border-radius: 6px; height: 40px; width: 100%;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                            <path d="M7.5 1v7h1V1h-1z" />
                            <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                        </svg>
                        LOGOUT
                    </button>
                </a>
            </li>
            
        </ul>
    </div>
  <h1>Complaint Form</h1>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="container">
    <div class="row">
      <div class="col-4">
        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" id="name" required><br><br>
      </div>
      <div class="col-4">
        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email" id="email" required><br><br>
      </div>
      <div class="col-4">
        <label for="Regarding">Regarding:</label>
        <input class="form-control" type="text" name="Regarding" id="Regarding" required><br><br>
      </div>
    </div>
    <label for="Complaint_in_Detail">Complaint in Detail:</label><br>
    <textarea class="form-control" name="Complaint_in_Detail" id="Complaint_in_Detail" rows="4" cols="40"></textarea>
    <br><br>
    <input class="btn btn-dark" type="submit" value="Submit">
  </form>
</body>
</html>
