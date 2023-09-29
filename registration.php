<?php
include("configuration.php");
$name=$_POST['name'];
$nname=$_POST['nname'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$dob=$_POST['dob'];
$p1=$_POST['p1'];
$p2=$_POST['p2'];
$date=date('d-M-Y');

$c=mysqli_query($al,"SELECT * FROM users WHERE email='$email'");
if($name==NULL || $nname==NULL || $email==NULL || $contact==NULL || $p1==NULL || $p2==NULL || $dob==NULL)
{
}
elseif(mysqli_num_rows($c)==1)
		{
			$info="Email ID or Nick Name Already Exists";
		}
		elseif($p1==$p2)
		{	
			$p3=sha1($p1);
			$sql=mysqli_query($al,"INSERT INTO users(name,nick,dob,email,contact,password,date) VALUES('$name','$nname','$dob','$email','$contact','$p3','$date')");
			if($sql) {
			$info="Successfully Registered User $name";
			} else { $info = "Error in Registration"; }
		}
		else
		{
			$info="Password Didn't Matched";
		}
?>
<?php
include("configuration.php");
$name=$_POST['name'];
$nname=$_POST['nname'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$dob=$_POST['dob'];
$p1=$_POST['p1'];
$p2=$_POST['p2'];
$date=date('d-M-Y');

$c=mysqli_query($al,"SELECT * FROM users WHERE email='$email'");
if($name==NULL || $nname==NULL || $email==NULL || $contact==NULL || $p1==NULL || $p2==NULL || $dob==NULL)
{
}
elseif(mysqli_num_rows($c)==1)
		{
			$info="Email ID or Nick Name Already Exists";
		}
		elseif($p1==$p2)
		{	
			$p3=sha1($p1);
			$sql=mysqli_query($al,"INSERT INTO users(name,nick,dob,email,contact,password,date) VALUES('$name','$nname','$dob','$email','$contact','$p3','$date')");
			if($sql) {
			$info="Successfully Registered User $name";
			} else { $info = "Error in Registration"; }
		}
		else
		{
			$info="Password Didn't Matched";
		}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #4a89f0;
        }
        .container {
            margin-top: 60px;
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
<body><center>
    <div class="container">
        <div align="center">
            <h2 class="mb-4">User Registration Panel</h2>
            <form method="post" action="">
                <table class="table" cellpadding="4" cellspacing="4">
                    <tr>
                        <td colspan="2" align="center" class="text-muted">All Fields are Mandatory</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" class="text-danger"><?php echo $info; ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Full Name:</td>
                        <td><input type="text" name="name" size="30" class="form-control" placeholder="Enter Full Name" required="required"></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Nick Name:</td>
                        <td><input type="text" name="nname" size="30" class="form-control" placeholder="Enter Nick Name" required="required"></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Date of Birth:</td>
                        <td><input type="text" name="dob" size="30" class="form-control" placeholder="DD/MM/YYYY" maxlength="10" required="required"></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Email ID:</td>
                        <td><input type="email" name="email" size="30" class="form-control" placeholder="Enter Email ID" required="required"></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Contact No.:</td>
                        <td><input type="text" name="contact" size="30" class="form-control" placeholder="Enter Contact No." maxlength="10" required="required"></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Password:</td>
                        <td><input type="password" name="p1" size="30" class="form-control" placeholder="Enter Password" required="required"></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Re-Type Password:</td>
                        <td><input type="password" name="p2" size="30" class="form-control" placeholder="Re-Type Password" required="required"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Register Me" class="btn btn-primary" onclick="return confirm('Please check everything before submitting')">
                        </td>
                    </tr>
                </table>
            </form>
            <a href="index.php" class="btn btn-link">BACK</a>
        </div>
    </div>
	</center></body>
</html>
