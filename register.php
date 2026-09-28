<?php 
include 'config.php';

$message = "";
if (isset($_POST['register'])) {
    // Escaping strings to prevent basic SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name,email,password,role) VALUES('$name','$email','$password','$role')";
   if (mysqli_query($conn, $sql)) {

    $message = '
    <div class="alert success">
        Registar & Account created successfully!<br>
        <a href="login.php" class="login-link">Login here</a>
    </div>
    ';

} else {

    $message = "<div class='alert error'>Error: " . mysqli_error($conn) . "</div>";

}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Library Management System</title>
    <style>
        /* Alert box */
.alert {
    max-width: 420px;
    margin: 25px auto;
    padding: 16px;
    border-radius: 6px;
    text-align: center;
    font-weight: 600;
}

/* Success */
.alert.success {
    background: #d4edda;
    color: #111010ff;
    border: 1px solid #c3e6cb;
}

/* Error */
.alert.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Login link */
.login-link {
    display: inline-block;
    margin-top: 8px;
    color: #0e25f1ff;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
}

/* Hover ONLY for login link */
.login-link:hover {
    color: #0b3d1f;
    text-decoration: underline;
}

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
            color: black;
            padding: 20px 0;
            text-align: center;
        }

        nav a {
            color: #010e18ff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1rem;
        }

        nav a:hover { color: white; }

        /* Form Container */
        .register-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .register-card {
            background: var(--white);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .register-card h2 {
            margin-top: 0;
            color: var(--primary);
            text-align: center;
            margin-bottom: 25px;
        }

        /* Form Inputs */
        .form-group { margin-bottom: 15px; }
        
        label { 
            display: block; 
            margin-bottom: 8px; 
            color: #555; 
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
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
            margin-top: 20px;
        }

        button:hover { background: #2980b9; }

        /* Alerts */
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 0.9rem;
        }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        footer {
            text-align: center;
            padding: 20px;
            background: #fff;
            color: #7f8c8d;
            border-top: 1px solid #eee;
        }
        /* Logout Button */
.logout-btn {
    display: block;
    width: 120px;              /* short */
    margin: 30px auto;         /* center */
    text-align: center;
    padding: 10px 0;
    background: #e74c3c;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    border-radius: 6px;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #e20909ff;
}

    </style>
</head>
<body>

<header>
    <h1>LIBRARY MANAGEMENT SYSTEM</h1>
    <nav>
        <a href="about.php">About</a>
        <a href="add_book.php">add_book.php</a>
        <a href="borrow_book.php">borrow_book.php</a>
        <a href="return_book.php">return_book.php</a>
       
         </nav>
</header>

<div class="register-container">
    <div class="register-card">
        <h2>Create Account</h2>

        <?php echo $message; ?>

        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required placeholder="Enter full name">
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="name@mattu.edu">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="inter password">
            </div>

            <div class="form-group">
                <label>User Role</label>
                <select name="role" required>
                    <option value="" disabled selected>Assign a role</option>
                    <option value="admin">Administrator</option>
                    <option value="librarian">Librarian</option>
                    <option value="member">Member</option>
                </select>
            </div>

            <button name="register">Register Account</button>
        </form>
    </div>
</div>
 <a href="logout.php" class="logout-btn">Logout</a>
<footer>
    <p>&copy; 2026 AT MATTU UNIVERSITY.</p>
</footer>

</body>
</html>