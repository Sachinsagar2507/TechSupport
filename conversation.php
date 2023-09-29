<?php
include("configuration.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$email=$_SESSION['email'];
$sql=mysqli_query($al,"SELECT * FROM users WHERE email!='$email'");
$receiver=$_POST['user'];
$msg=$_POST['msg'];
$date=date('d-M-Y');
if($receiver==NULL || $msg==NULL)
{
}
else
{
	mysqli_query($al,"INSERT INTO message(sender,receiver,msg,date) VALUES('$email','$receiver','$msg','$date')");
	$info="Message Sent";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conversation</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    body {
      background-color: #146bf7; /* Set pale blue background color */
    }
    .heading {
        text-align: center;
        margin-bottom: 10px;
        color: white;
        font-size: 24px;
        font-weight: bold;
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
    .container {
        margin-top: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 6px;
    }
    .tableHead {
        text-decoration: underline;
        font-weight: bold;
    }
    .labels {
        font-weight: bold;
    }
    .msg {
        font-size: 12px;
    }
    .commandButton {
        border-radius: 6px;
        height: 40px;
        width: 100px;
    }
</style>
</head>
<body class="bg-info">
    <!-- Navigation Bar -->
    <div class="navigation-bar">
        <ul>
            <li><a class="nav-brands" href="home.php">Support Team</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="box.php">Chat</a></li>
            <li><a href="chat.php">DM</a></li>
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

    <div class="container">
        <h2 class="heading">Welcome to our customer support <?php echo $name;?></h2>
        <h3 class="heading">(Private Conversation)</h3>

        <div align="center">
            <form method="post" action="">
                <table class="table" cellpadding="4" cellspacing="4">
                    <tr>
                        <td class="tableHead" colspan="2" align="center" style="text-decoration:underline;">Send Messages</td>
                    </tr>
                    <tr>
                        <td class="info" colspan="2" align="center"><?php echo $info;?></td>
                    </tr>
                    <tr>
                        <td class="labels">Select User :</td>
                        <td>
                            <select name="user" class="fields form-select" style="background-color:#051b0d00;">
                                <option disabled="disabled" selected="selected"> - - - - - - - - - </option>
                                <?php while($v=mysqli_fetch_array($sql)) { ?>
                                    <option value="<?php echo $v['email'];?>"><?php echo $v['name'];?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="labels">Message :</td>
                        <td>
                            <textarea name="msg" class="fields form-control" rows="2" cols="30" required="required" style="width: 500px; height: 200px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="SEND" class="commandButton btn btn-primary" />
                        </td>
                    </tr>
                </table>
            </form>
            <br />
            <br />
            <?php
            $r=mysqli_query($al,"SELECT * FROM message WHERE receiver='$email' ORDER BY id DESC");
            ?>
            <table cellpadding="4" cellspacing="4" class="table">
                <?php while($t=mysqli_fetch_array($r)) {
                    $ee=$t['sender'];
                    $o=mysqli_query($al,"SELECT * FROM users WHERE email='$ee'");
                    $p=mysqli_fetch_array($o);
                    $recv=$p['nick'];
                    ?>
                    <tr>
                        <td class="msg"><?php echo $t['msg'];?>
                            <span style="color:#F39;"> ( From <?php echo $recv;?> on <?php echo $t['date'];?>)</span>
                        </td>
                        <td>
                            <a href="deleteMessage.php?del=<?php echo $t['id'];?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <br />
            <?php 
            $r=mysqli_query($al,"SELECT * FROM message WHERE sender='$email' ORDER BY id DESC LIMIT 10");
            ?>
            <table cellpadding="4" cellspacing="4" class="table">
                <tr>
                    <td class="tableHead" align="center" colspan="2" style="text-decoration:underline;">Sent Messages</td>
                </tr>
                <?php while($t=mysqli_fetch_array($r)) {
                    $ee=$t['receiver'];
                    $o=mysqli_query($al,"SELECT * FROM users WHERE email='$ee'");
                    $p=mysqli_fetch_array($o);
                    $recv=$p['nick'];
                    ?>
                    <tr>
                        <td class="msg"><?php echo $t['msg'];?><span style="color:#F39;"> ( To <?php echo $recv;?> on <?php echo $t['date'];?>)</span></td>
                        <td>
                            <a href="deleteMessage.php?del=<?php echo $t['id'];?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <br />
            <br />
            <a href="home.php">BACK</a>
        </div>
    </div>
</body>
</html>
<li><a href="conversation.php">PRIVATE</a></li>