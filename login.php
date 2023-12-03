
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <link rel="stylesheet" href="./css/styleLogin.css">

</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center p-2">
            <h1>INVENTORY MANAGEMENT SYSTEM</h1>
            <div class="d-flex align-items-center" style=" border: solid; height:50px; width:300px; overflow: hidden; ">
                <img src="./img/loginBG.jpg" alt="Logo" class="container-image">
            </div>
        </div>
    </div>

    <div class="container-md" style="padding-top: 12vh;">

        <div class="left-container">
            <img src="./img/loginBG.jpg" alt="Background" class="container-image">
        </div>

        <div class="right-container">
        <h3 class="mb-5">Sign in</h3>
        <form id="login-form" method="POST" action="./php/process_login.php"> <!-- Update action to point to process_login.php -->
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
        </form>
        <?php
            session_start();

            // Check for error message
            if (isset($_SESSION['error_message'])) {
                echo '<div style="color: red;">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']); // Clear the error message after displaying
            }

            // ... rest of your HTML and form
        ?>


    </div>
    </div>

</body>

</html>
