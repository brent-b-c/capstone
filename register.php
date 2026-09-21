<?php
require 'db_connect.php';
$msg = '';
if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);

    try {
        $stmt = $pdo->prepare("INSERT INTO users(name,email,password,contact,address,role) VALUES(?,?,?,?,?,'resident')");
        $stmt->execute([$name,$email,$pass,$contact,$address]);
        $msg = "Registration successful! Wait for admin approval.";
        $msgClass = "success";
    } catch(Exception $e) {
        $msg = "Email already taken.";
        $msgClass = "error";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantay Bayanihan | Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            background: linear-gradient(135deg, #8B0000, #CC0000, #FF3333);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }
        .container {
            display: flex;
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,0.5);
            max-width: 800px;
            width: 100%;
            height: 500px;
        }
        .left {
            background: linear-gradient(135deg, #CC0000, #B30000);
            color: white;
            padding: 30px 25px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        .shield {
            font-size: 70px;
            margin-bottom: 15px;
        }
        .left h1 {
            font-size: 26px;
            font-weight: 900;
            margin-bottom: 8px;
        }
        .tagline {
            font-size: 16px;
            font-weight: bold;
            margin: 12px 0;
        }
        .left p {
            font-size: 13px;
            opacity: 0.9;
            line-height: 1.4;
        }
        .right {
            padding: 35px 40px;
            flex: 1.1;
        }
        .right h2 {
            color: #CC0000;
            font-size: 22px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 11px 14px;
            margin: 8px 0;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        input:focus, textarea:focus {
            border-color: #CC0000;
            outline: none;
        }
        textarea { min-height: 70px; resize: none; }
        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        button[type="submit"], .back-btn {
            background: #CC0000;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            flex: 1;
            transition: 0.3s;
            text-align: center;        /* ensures text is centered */
        }
        button[type="submit"]:hover, .back-btn:hover {
            background: #B30000;
            transform: translateY(-2px);
        }
        .success, .error {
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
            margin: 10px 0;
            font-weight: bold;
        }
        .success { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }
        .error   { background:#ffe6e6; color:#CC0000; border:1px solid #CC0000; }

        @media (max-width: 820px) {
            .container { flex-direction: column; height: auto; max-width: 380px; }
            .left { padding: 30px 20px; }
            .shield { font-size: 60px; }
            .right { padding: 30px 25px; }
            .form-buttons { flex-direction: column; gap: 8px; }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- LEFT: HERO -->
    <div class="left">
        <i class="fas fa-shield-alt shield"></i>
        <h1>BANTAY BAYANIHAN</h1>
        <div class="tagline">Be Ready. Be a Hero.</div>
        <p>Join your community in emergency preparedness.</p>
    </div>

    <!-- RIGHT: FORM -->
    <div class="right">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="contact" placeholder="Contact Number">
            <textarea name="address" placeholder="Full Address" required></textarea>
            
            <div class="form-buttons">
                <button type="submit">REGISTER</button>
                <!-- Changed from <a> to <button> -->
                <button type="button" class="back-btn" onclick="window.location.href='login.php'">BACK TO LOGIN</button>
            </div>
        </form>

        <?php if($msg): ?>
            <div class="<?= $msgClass ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>