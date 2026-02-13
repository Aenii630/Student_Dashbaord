<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {

        $file = "users.txt";

        if (file_exists($file)) {

            $users = file($file, FILE_IGNORE_NEW_LINES);

            foreach ($users as $user) {

                $userData = explode("|", $user);

                if ($userData[2] == $username && password_verify($password, $userData[3])) {

                    $_SESSION['fullname'] = $userData[0];
                    $_SESSION['email']    = $userData[1];
                    $_SESSION['username'] = $userData[2];
                    $_SESSION['phone']    = $userData[4];

                    header("Location: dashboard.php");
                    exit();
                }
            }
        }

        $message = "Invalid Username or Password!";
    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(135deg, #6f4e37, #a67b5b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            background: #fff8f0;
            padding: 40px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            text-align: center;
        }

        h2 {
            color: #5C4033;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background: #5C4033;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #3e2723;
        }

        a {
            color: #5C4033;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Login</h2>
    <p class="error"><?php echo $message; ?></p>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>

    <p>Don't have account? <a href="signup.php">Signup</a></p>
</div>

</body>
</html>
