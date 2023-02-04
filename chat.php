<?php
  // Connect to the database
  $db = mysqli_connect("hostname", "username", "password", "database");
  
  // Check the form submission
  if (isset($_POST['submit'])) {
    // Get the data from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $message = mysqli_real_escape_string($db, $_POST['message']);
    
    // Insert the message into the database
    $query = "INSERT INTO chat (name, message) VALUES ('$name', '$message')";
    mysqli_query($db, $query);
    
    // Redirect to the chat page
    header("Location: chat.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Online Chat</title>
  </head>
  <body>
    <h1>Online Chat</h1>
    <form action="chat.php" method="post">
      <input type="text" name="name" placeholder="Your Name">
      <textarea name="message" placeholder="Your Message"></textarea>
      <input type="submit" name="submit" value="Send">
    </form>
    <hr>
    <div id="chat">
      <?php
        // Get the messages from the database
        $query = "SELECT * FROM chat ORDER BY id DESC";
        $results = mysqli_query($db, $query);
        
        // Display the messages
        while ($row = mysqli_fetch_array($results)) {
          echo "<p><strong>" . $row['name'] . ":</strong> " . $row['message'] . "</p>";
        }
      ?>
    </div>
  </body>
</html>
