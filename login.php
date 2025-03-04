<?php 
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['Phone_nb'];
    
    $stmt = $pdo->prepare("SELECT * FROM client WHERE telCl = ?");
    $stmt->execute([$phone]);
    $client = $stmt->fetch();
    
    if ($client) {
        $_SESSION['client_id'] = $client['idClient'];  
        $_SESSION['client_name'] = $client['nomCl'] . " " . $client['prenomCl'];  

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid phone number. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/login.css">
    <title>Login Page</title>
</head>
<body>
    <form action="login.php" method="POST">
        <input type="text" name="Phone_nb" placeholder="Phone number" required>
        <button type="submit">Login</button>
    </form>
    <?php if(isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
</body>
</html>
