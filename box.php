<?php
    include("configuration.php");
    session_start();
    if (!isset($_SESSION['email'])) {
        header("location:index.php");
    }
    $msg = $_POST['msg'];
    $email = $_SESSION['email'];
    $sql = mysqli_query($al, "SELECT * FROM users WHERE email='$email'");
    $b = mysqli_fetch_array($sql);
    $name = $b['nick'];
    $date = date('d-M-Y');
    if ($msg == NULL) {
    } else {
        mysqli_query($al, "INSERT INTO box(sender,msg,date) VALUES('$name','$msg','$date')");
    }
    $fetch = mysqli_query($al, "SELECT * FROM box ORDER BY id DESC");
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chatter box</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #adaae6;
            font-family: Arial, sans-serif;
        }

        .teams-container {
            
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
           
        }

        .teams-header {
            background-color: #05a0ed;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .teams-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .teams-body {
            padding: 20px;
            width: auto;
            height: 500px;
        }

        .teams-chat-box {
            max-height: 450px;
            overflow-y: scroll;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;

        }

        .teams-message {
            margin-bottom: 5px;
        }

        .teams-message .sender {
            font-weight: bold;
            color: #0078D4;
        }

        .teams-message .msg {
            word-wrap: break-word;
        }

        .teams-input-box {
            display: flex;
            margin-top: 10px;
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
        padding: 1px 16px;
        text-decoration: none;
    }
    /* .navigation-bar li a:hover {
        background-color: #111;
    } */
    .nav-brands {
        background: #1e00ff; padding: 9px; border-radius: 2px; font-weight: bold; 

    }

    form{
        background-color: #deeaf0;
    padding: 10px;
    }
</style>

<body>
<!-- Navigation Bar -->
<div class="navigation-bar">
    <ul>
        <li><a class="nav-brands" href="home.php">Support Team</a></li>
        <li><a href="home.php">Home</a></li>
        <li><a href="box.php">Chat</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li style="float:right"><a href="logout.php"><button class="btn btn-primary btn-block" style="border-radius: 6px; height: 40px; width: 100%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
  <path d="M7.5 1v7h1V1h-1z"/>
  <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
</svg>
LOGOUT</button></a></li>
        <div style="float: right; padding: 10px;color:#02fb02; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <p style="margin: 0; font-weight: bold; color: white; float:right;">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
 <?php echo $name; ?></p>
    </div>
    </ul>
</div>

    <div class="teams-container">
        <div class="teams-header">
            <h1>Welcome to our Technical support <?php echo $name;?></h1>
        </div>
        <div class="teams-body">
            <div class="teams-chat-box">
                <?php while ($f = mysqli_fetch_array($fetch)) { ?>
                    <div class="teams-message">
                        <span class="sender"><?php echo $f['sender']; ?></span>:
                        <span class="msg"><?php echo $f['msg']; ?></span>
                    </div>
                <?php } ?>
            </div>
            
        </div>
        
        </div>
        <br>
        <br>
        <div class="container"></div>
    <form method="post" action="process_message.php" class="teams-input-box">
        <div class="container">
            <div class="row">
                <div class="col-10">

                <input name="msg" class="form-textarea form-control" placeholder="Type new Message " required="required">
            </div>
            <div class ="col-2">
                <button type="submit"  class="button btn btn-primary btn-block" style="width:100%">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
  <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
</svg> Send
                </button>
            </div>
            </div>
            </div>
            </form>

    <script>
    function refreshMsgContainer() {
        var container = document.querySelector('.teams-chat-box');
        if (container) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    container.innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', 'refresh.php', true);
            xhr.send();
        }
    }

    // Refresh the message container every one second
    setInterval(refreshMsgContainer, 1000);
</script>
</body>
</html>
