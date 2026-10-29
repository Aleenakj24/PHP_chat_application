<?php
// 1. POST Request: When a user submits a new message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    $name = $_POST['uname'];
    $msg = $_POST['msg'];
    
    // Combine name and message into a line of text
    $data = $name . ": " . $msg . "\n";
    
    // Append the line to a simple text file
    file_put_contents("chat.txt", $data, FILE_APPEND);
}

// 2. GET Request handling (Default behavior when the page loads or refreshes)
$chat_content = "";
if (file_exists("chat.txt")) {
    $chat_content = file_get_contents("chat.txt");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Chat</title>
</head>
<body>
    <h2>LAN Chat Room</h2>

    <!-- Textarea displays the chat log fetched during the GET request -->
    <textarea rows="15" cols="50" readonly><?php echo $chat_content; ?></textarea>
    
    <br><br>

    <!-- GET Request Button: Clicking this simply reloads the page to fetch new messages -->
    <form method="get" action="chat.php">
        <button type="submit">🔄 Refresh Chat</button>
    </form>

    <br>

    <!-- POST Request Form: Submits new messages to the server -->
    <form method="post" action="chat.php">
        <input type="text" name="uname" placeholder="Your Name" required>
        <br><br>
        <input type="text" name="msg" placeholder="Type message..." size="40" required>
        <button type="submit" name="send">Send</button>
    </form>
</body>
</html>
