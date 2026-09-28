<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

/* Logic: Process Return */
if (isset($_POST['return'])) {
    if (!isset($_POST['borrow_id'])) {
        $message = "<div class='alert error'>Please select a book to return.</div>";
    } else {
        $borrow_id = $_POST['borrow_id'];
        $res = mysqli_query($conn, "SELECT book_id FROM borrow WHERE borrow_id='$borrow_id'");
        $row = mysqli_fetch_assoc($res);
        $book_id = $row['book_id'];

        mysqli_query($conn, "UPDATE borrow SET status='returned', return_date=CURDATE() WHERE borrow_id='$borrow_id'");
        mysqli_query($conn, "UPDATE books SET copies = copies + 1 WHERE book_id='$book_id'");
        
        $message = "<div class='alert success'>Book returned successfully!</div>";
    }
}

/* Get borrowed books */
$borrowed = mysqli_query($conn, "SELECT borrow.borrow_id, books.title FROM borrow JOIN books ON borrow.book_id = books.book_id WHERE borrow.user_id='$user_id' AND borrow.status='borrowed'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Book - LibManager</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --bg: #f4f7f6;
            --white: #ffffff;
        }
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



 body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8f9fa;
            color: var(--text-dark);
            margin: 0;
            line-height: 1.6;
        }


        .container {
            max-width: 600px;
            margin: 50px auto;
            background: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        nav { margin-top: 10px; }
        nav a {
            color: #bdc3c7;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 500;
        }
        nav a:hover { color: white; }

        h3 { color: var(--primary); border-bottom: 2px solid var(--accent); padding-bottom: 10px; }

        /* Styling the Radio List */
        .book-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: 0.2s;
            cursor: pointer;
        }

        .book-item:hover { background: #f9f9f9; border-color: var(--accent); }

        .book-item input { margin-right: 15px; transform: scale(1.2); }

        /* Buttons */
        .btn-return {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }

        .btn-return:hover { background: #2980b9; }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #7f8c8d;
        }

        /* Status Messages */
        .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
         header {
            background: #046168ff;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
    <h1>LIBRARY MANAGEMENT SYSTEM</h1>
    <nav>
        <a href="about.php">About</a> 
        
        
    </nav>
</header>

<div class="container">
    <a href="dashboard.php" class="back-link">← Back to Home</a>
    <h3>Return a Borrowed Book</h3>

    <?php echo $message; ?>

    <form method="POST">
        <?php if (mysqli_num_rows($borrowed) > 0) { ?>
            <?php while ($r = mysqli_fetch_assoc($borrowed)) { ?>
                <label class="book-item">
                    <input type="radio" name="borrow_id" value="<?php echo $r['borrow_id']; ?>" required>
                    <span><strong><?php echo $r['title']; ?></strong></span>
                </label>
            <?php } ?>
            <button type="submit" name="return" class="btn-return">Confirm Return</button>
        <?php } else { ?>
            <p style="text-align:center; color: #95a5a6; padding: 20px;">You have no books to return.</p>
        <?php } ?>
    </form>
</div>
<a href="logout.php" class="logout-btn">Logout</a>
<footer>
    <p>&copy; 2025 AT MATTU UNIVERSITY.</p>
</footer>

</body>
</html>