<?php
session_start();
include 'config.php';

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($res);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['role'] == $role) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch($user['role']) {
                case 'admin': header("Location: register.php"); break;
                case 'librarian': header("Location: manage_book.php"); break;
                case 'member': header("Location: dashboard.php"); break;
                default: header("Location: dashboard.php"); break;
            }
            exit;
        } else {
            $error = "Role mismatch. Please select your correct role.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Library Management System</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --bg: #f4f7f6;
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styling */
        header {
            background: #7abd74ff;
            color: #070700ff;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        header h1 { margin: 0; font-size: 1.5rem; letter-spacing: 1px; }

        nav { margin-top: 10px; padding: 0.5em; }
        nav a { color: #000000ff; text-decoration: none; margin: 0 15px;
            font-size: 1rem; }
        nav a:hover { color: white; }

        /* Login Card */
        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            background: var(--white);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .login-card h2 {
            margin-top: 0;
            color: var(--primary);
            text-align: center;
            margin-bottom: 30px;
        }

        /* Form Inputs */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #666; font-size: 0.9rem; }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box; /* Fixes width issue */
        }

        input:focus, select:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover { background: #2980b9; }

        /* Error Message */
        .error-msg {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<header>
    <h1>LIBRARY MANAGEMENT SYSTEM</h1>
    <nav><a href="about.php">About</a>
  
</nav>
</header>

<div class="login-container">
    <div class="login-card">
        <h2>Welcome Login Page</h2>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label>Login By Your Role</label>
                <select name="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="admin">Administrator</option>
                    <option value="librarian">Librarian</option>
                    <option value="member">Member</option>
                </select>
            </div>

            <button name="login">Sign In</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2026 AT MATTU UNIVERSITY. All Rights Reserved.</p>
</footer>

</body>
</html>