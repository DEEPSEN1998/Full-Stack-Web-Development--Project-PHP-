<?php


if (isset($_POST['admin_name']) && isset($_POST['admin_pass'])) {
    if ($_POST['admin_name'] == 'admin' && $_POST['admin_pass'] == 'admin@321') {
        $_SESSION['admin'] = true;
        header("Location: ./");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
</head>
<body class="w3-light-grey">
    <div class="w3-container w3-center w3-margin-top">
        <div class="w3-card-4 w3-white w3-padding" style="max-width: 400px; margin: auto;">
            <h2>Admin Login</h2>
            <?php if (!empty($error)) echo "<p class='w3-text-red'>$error</p>"; ?>
            <form method="POST">
                <p><input class="w3-input w3-border" type="text" name="admin_name" placeholder="Admin Name" required></p>
                <p><input class="w3-input w3-border" type="password" name="admin_pass" placeholder="Password" required></p>
                <p><button class="w3-button w3-blue" type="submit">Login</button></p>
            </form>
        </div>
    </div>
</body>
</html>
