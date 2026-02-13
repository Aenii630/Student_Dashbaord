<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $phone    = trim($_POST['phone']);

    if (!empty($fullname) && !empty($email) && !empty($username) && !empty($password) && !empty($phone)) {

        $file = "users.txt";

        if (!file_exists($file)) {
            fopen($file, "w");
        }

        $users = file($file, FILE_IGNORE_NEW_LINES);
        $userExists = false;

        foreach ($users as $user) {
            $userData = explode("|", $user);
            if ($userData[2] == $username) {
                $userExists = true;
                break;
            }
        }

        if ($userExists) {
            $message = "Username already exists!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $newUser = $fullname . "|" . $email . "|" . $username . "|" . $hashedPassword . "|" . $phone . PHP_EOL;
            file_put_contents($file, $newUser, FILE_APPEND);
            $message = "Signup Successful! <a href='login.php'>Login Now</a>";
        }

    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
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
            width: 380px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            text-align: center;
        }

        h2 {
            color: #5C4033;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 6px 0;
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
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            color: red;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Signup</h2>
    <p class="message"><?php echo $message; ?></p>

    <form method="POST">
        <input type="text" name="fullname" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="text" name="phone" placeholder="Phone Number" required><br>
        <input type="submit" value="Signup">
    </form>

    <p>Already have account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
