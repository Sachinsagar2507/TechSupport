<?php
include("configuration.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("location: index.php");
}

$email = $_SESSION['email'];
$sql = mysqli_query($al, "SELECT * FROM users WHERE email='$email'");
$b = mysqli_fetch_array($sql);
$name = $b['name'];

// Fetch the list of users from the database (excluding the currently logged-in user)
$userList = array();
$userQuery = mysqli_query($al, "SELECT * FROM users WHERE id <> {$b['id']}");
while ($userRow = mysqli_fetch_assoc($userQuery)) {
    $userList[] = $userRow;
}

// Check if a user is selected for private chat
$selectedUser = null;
if (isset($_GET['user'])) {
    $selectedUserId = $_GET['user'];
    // Fetch the selected user's information
    $selectedUserQuery = mysqli_query($al, "SELECT * FROM users WHERE id='$selectedUserId'");
    $selectedUser = mysqli_fetch_assoc($selectedUserQuery);
}

// Check for incoming private messages
$privateMessages = array(); // You should fetch private messages from your database here

// Handle sending private messages
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['private_message'])) {
    $privateMessage = $_POST['private_message'];
    $senderId = $b['id']; // Get the sender's user ID
    $receiverId = $_POST['receiver_id']; // Get the receiver's user ID
    // Insert the private message into your database here
    // Remember to include sender_id and receiver_id in your messages table
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chat Page</title>
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
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            height: 400px; /* Adjust the height as needed */
            overflow-y: scroll;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 10px;
            overflow-y: scroll;
        }

        .message-container {
            display: flex;
            justify-content: <?php echo ($message['sender_id'] == $b['id']) ? 'flex-end' : 'flex-start'; ?>;
            margin-bottom: 10px;
        }

        .message-bubble {
            background-color: <?php echo ($message['sender_id'] == $b['id']) ? '#007bff' : '#f0f0f0'; ?>;
            color: <?php echo ($message['sender_id'] == $b['id']) ? '#fff' : '#000'; ?>;
            padding: 10px;
            border-radius: 10px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .chat-input {
            padding-top: 10px;
        }

        .chat-input form {
            display: flex;
        }

        .chat-input input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .chat-input button {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-input button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
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
    <div class="heading">Chat Page - Welcome <?php echo $name; ?></div>
    <hr style="border: 6px wavy #63C;" />
    <div class="content">
        <div class="row">
            <!-- User list column -->
            <div class="col-md-4">
                <h2>Users</h2>
                <ul>
                    <?php foreach ($userList as $user) : ?>
                        <li>
                            <a href="?user=<?php echo $user['id']; ?>"><?php echo $user['name']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- Chat column -->
            <div class="col-md-8">
                <?php if ($selectedUser) : ?>
                    <h2>Chat with <?php echo $selectedUser['name']; ?></h2>
                    <div class="chat-container">
                        <div class="chat-messages">
                            <!-- Display private messages here -->
                            <?php foreach ($privateMessages as $message) : ?>
                                <div class="message-container">
                                    <div class="message-bubble"><?php echo $message['message']; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="chat-input">
                            <form method="post" action="">
                                <input type="hidden" name="receiver_id" value="<?php echo $selectedUser['id']; ?>">
                                <input type="text" name="private_message" placeholder="Type your private message" required>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                <?php else : ?>
                    <p>Select a user to start a private chat.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
