<?php
include("configuration.php");
session_start();
if(isset($_SESSION['email']))
{
    header("location:home.php");
}
$email=$_POST['email'];
$password=$_POST['password'];
if($email==NULL || $_POST['password']==NULL)
{
}
else
{
    $sql=mysqli_query($al,"SELECT * FROM users WHERE email='".mysqli_real_escape_string($al,$email)."' AND password='".mysqli_real_escape_string($al,sha1($password))."'");    
    if(mysqli_num_rows($sql)==1)
    {
        $_SESSION['email']=$_POST['email'];
        header("location:home.php");
    }
    else
    {
        $info="Incorrect Email or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome to Chatter Box</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #4a89f0;
        }
        .container {
            margin-top: 100px;
            max-width: 600px;
            padding: 20px;
            background-color: #87b1f5;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .heading {
            font-size: 24px;
            font-weight: bold;
        }
        .tableHead {
            font-weight: bold;
        }
        .info {
            color: red;
        }
        .labels {
            color: white;
        }
        .fields {
            width: 100%;
        }
        .commandButton {
            margin-top: 10px;
        }
        .text {
            color: white;
        }
        .register-link {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div align="center">
            <br />
            <h2 class="heading">Welcome to Technical support</h2>
            <br />
            <br />
            <br />
            <form method="post" action="">
            <table class="table" cellpadding="4" cellspacing="4">
                    <tr>
                        <td align="center" colspan="2" class="tableHead">User Login</td>
                    </tr>
                    <tr>
                        <?php echo $info;?>
                    </tr>
                    <tr>
                        <td class="labels">Email ID :</td>
                        <td><input type="email" name="email" class="fields form-control" required="required" /></td>
                    </tr>
                    <tr>
                        <td class="labels">Password :</td>
                        <td><input type="password" name="password" class="fields form-control" required="required" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Login" class="commandButton btn btn-primary" /></td>
                    </tr>
                </table>
            </form>
            <br />
            <br />
            <span class="text">New User..? </span><a href="registration.php" class="register-link">Register Here</a><br />
            <br />
            <br />
        </div>
    </div>
</body>
</html>

