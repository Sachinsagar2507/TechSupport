<?php
include("configuration.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$email=$_SESSION['email'];
$sql=mysqli_query($al,"SELECT * FROM users WHERE email='$email'");
$b=mysqli_fetch_array($sql);
$name=$b['name'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>HOME</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #adaae6;
        }

        .heading {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin-top: 30px;
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

        .content {
            max-width: 900px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .content img {
            width: 100%; /* Adjusted to 100% for mobile view */
            max-height: auto; /* Remove max-height */
            object-fit: cover;
            border-radius: 5px;
            margin-top: 20px;
        }

        @media screen and (max-width: 768px) {
            /* Adjust styles for smaller screens */
            .content {
                padding: 10px;
            }

            .content img {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="navigation-bar">
        <ul>
            <li><a class="nav-brands" href="home.php">Support Team</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="box.php">Chat</a></li>
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
            <div style="float: right; padding: 10px;color:#02fb02; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <p style="margin: 0; font-weight: bold; color: white; float:right;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <?php echo $name; ?>
                </p>
            </div>
        </ul>
    </div>
    <div class="heading">Welcome to our Technical support <?php echo $name; ?></div>
    <hr style="border:6px wavy #63C;" />
    <div class="content">
            <img src="cus2.jpg">
            <img src="cus-image.png">
    </div>
</body>
</html>