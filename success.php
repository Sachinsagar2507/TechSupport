<!DOCTYPE html>
<html>
<head>
    <title>Complaint Form - Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
  body {
    text-align: center;
    background-color: #adaae6;
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
    <h1>Complaint Registered Successfully!</h1>
    <p>Thank you for submitting your complaint. We have received your complaint and will process it soon.</p>
    <p><a href="complaint.php">Click here to submit another complaint</a></p>
</body>
</html>
