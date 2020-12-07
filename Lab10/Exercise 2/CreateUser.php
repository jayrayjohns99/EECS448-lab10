<?php

$username = $_POST["input"];

$mysqli = new mysqli("mysql.eecs.ku.edu", "jjohnston", "JRJku99",
"jjohnston");

if ($mysqli->connect_errno)
{
 printf("Connect failed: %s\n", $mysqli->connect_error);
 exit();
}

$userExists = false;

$query = "SELECT * FROM Users";
if ($result = $mysqli->query($query))
{

 while ($row = $result->fetch_assoc())
 {

   if ($row["user_id"] == $username)
   {
       global $userExists;
       $userExists = true;
       break;
   }
 }
}

if ($userExists)
{
    echo "User {$username} already exists.\n";
}

else
{
    $insertString = "INSERT INTO Users (user_id) VALUES ('{$username}')";

    if ($mysqli->query($insertString))
    {
        echo "User {$username} has been created.\n";

        $result->free();
    }

    else
    {
        echo "Error creating user {$username}: ", $mysqli->error, "\n";

        $result->free();
    }
}

$mysqli->close();

?>
