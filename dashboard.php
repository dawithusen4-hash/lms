<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --bg: #f4f7f6;
            --text: #333;
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            margin: 0;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: var(--primary);
            color: var(--white);
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            border-bottom: 1px solid #555;
            padding-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: #bdc3c7;
            text-decoration: none;
            padding: 12px 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: var(--accent);
            color: white;
        }

        .logout-btn {
            color: #e74c3c !important;
            margin-top: 30px !important;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 40px;
            width: 100%;
        }

        .welcome-card {
            background: var(--white);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: var(--white);
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            color: var(--primary);
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            border-top: 4px solid var(--accent);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }

        .badge {
            font-size: 0.8rem;
            background: #e67e22;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>📚 LibManager</h2>
        <p>Role: <span class="badge"><?php echo $_SESSION['role']; ?></span></p>
        
        <nav>
            
            <a href="borrow_book.php">Borrow Book</a>
            <a href="return_book.php">Return Book</a>
            
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <div style="margin-top:20px; color:#7f8c8d; font-size: 0.8rem;">
                    ADMIN TOOLS</div>
                
            <?php } ?>

            <a href="logout.php" class="logout-btn">Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="welcome-card">
            <h1>Library Dashboard</h1>
            <p>Welcome back! Use the quick links below to manage your books.</p>
        </div>

        <div class="grid">
            <a href="borrow_book.php" class="card">📖<br>Borrow Book</a>
            <a href="return_book.php" class="card">🔄<br>Return Book</a>
            
            <?php if ($_SESSION['role'] == 'admin') { ?>
                
            <?php } ?>
        </div>
    </div>

</body>
</html>