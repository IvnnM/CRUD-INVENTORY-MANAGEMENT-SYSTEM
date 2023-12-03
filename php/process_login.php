<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../connect.php';

    if (!isset($_POST['username'], $_POST['password'])) {
        exit('Please fill both the username and password fields!');
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $name = getNameFromDatabase($conn, $username, $password);

    if ($name) {
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Incorrect username or password!";
        header("Location: ../V2login.php");
        exit();

    }
    $conn->close();
}

function getNameFromDatabase($conn, $username, $password)
{
    $sql = "SELECT name FROM accounts WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['name'];
    }

    return null; // Return null if no name is found
}
?>
