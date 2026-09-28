<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Borrowing Logic
if (isset($_POST['borrow'])) {
    if (!isset($_POST['book_id'])) {
        $message = "<div class='alert error'>Please select a book from the list below.</div>";
    } else {
        $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
        $check = mysqli_query($conn, "SELECT copies FROM books WHERE book_id='$book_id'");
        $book_data = mysqli_fetch_assoc($check);

        if ($book_data['copies'] > 0) {
            mysqli_query($conn, "INSERT INTO borrow(user_id, book_id, borrow_date, status) VALUES('$user_id', '$book_id', CURDATE(), 'borrowed')");
            mysqli_query($conn, "UPDATE books SET copies=copies-1 WHERE book_id='$book_id'");
            $message = "<div class='alert success'>✅ Book borrowed successfully! <a href='dashboard.php'>← Back to Dashboard</a></div>";
        } else {
            $message = "<div class='alert error'>This book just ran out of stock.</div>";
        }
    }
}

// Search Logic
$search_query = "";
$sql = "SELECT * FROM books WHERE copies > 0";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['search']);
    $sql .= " AND (title LIKE '%$search_query%' OR author LIKE '%$search_query%')";
}
$books = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Center | Mattu University</title>
    <style>
        :root {
            --brand-blue: #0056b3;
            --light-blue: #f0f7ff;
            --border-color: #dee2e6;
            --text-dark: #333;
            --text-muted: #666;
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8f9fa;
            color: var(--text-dark);
            margin: 0;
            line-height: 1.6;
        }

        /* 1. TOP HEADER */
        header {
            background: var(--brand-blue);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .main-wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* 2. MESSAGE AREA */
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* 3. SEARCH SECTION (Top of content) */
        .search-container {
            background: var(--white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border-bottom: 3px solid var(--brand-blue);
        }

        .search-container h3 { margin-top: 0; color: var(--brand-blue); }

        .search-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input[type="text"] {
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 1rem;
        }

        /* 4. BOOK LIST SECTION (Middle of content) */
        .book-list-container {
            background: var(--white);
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .book-row {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            transition: background 0.2s;
            cursor: pointer;
        }

        .book-row:last-child { border-bottom: none; }

        .book-row:hover { background-color: var(--light-blue); }

        .book-row input[type="radio"] {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
        }

        .book-details {
            flex: 1;
        }

        .book-title {
            display: block;
            font-weight: bold;
            font-size: 1.1rem;
            color: var(--brand-blue);
        }

        .book-meta {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        /* 5. ACTION BUTTON (Bottom of list) */
        .action-container {
            margin-top: 20px;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-search { background: #f0f0f0; color: #333; }
        .btn-search:hover { background: #e0e0e0; }

        .btn-borrow { background: var(--brand-blue); color: white; }
        .btn-borrow:hover { background: #004494; transform: translateY(-2px); }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--text-muted);
            text-decoration: none;
        }

        footer {
            text-align: center;
            padding: 30px;
            color: #999;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<header>
    <h1>Mattu University Library</h1>
</header>

<div class="main-wrapper">
    
    <?php if ($message != "") echo $message; ?>

    <section class="search-container">
        <h3>Find a Book</h3>
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Type title or author..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-search">Search</button>
        </form>
    </section>

    <form method="POST">
        <section class="book-list-container">
            <?php if (mysqli_num_rows($books) > 0) { ?>
                <?php while ($b = mysqli_fetch_assoc($books)) { ?>
                    <label class="book-row">
                        <input type="radio" name="book_id" value="<?php echo $b['book_id']; ?>" required>
                        <div class="book-details">
                            <span class="book-title"><?php echo htmlspecialchars($b['title']); ?></span>
                            <span class="book-meta">By <?php echo htmlspecialchars($b['author']); ?> | <strong><?php echo $b['copies']; ?></strong> BOOKS  available</span>
                        </div>
                    </label>
                <?php } ?>
            <?php } else { ?>
                <div style="padding: 20px; text-align: center; color: var(--text-muted);">
                    No books available for this search.
                </div>
            <?php } ?>
        </section>

        <?php if (mysqli_num_rows($books) > 0) { ?>
        <div class="action-container">
            <button name="borrow" class="btn btn-borrow">Borrow Selected Book</button>
        </div>
        <?php } ?>
    </form>

    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>

<footer>
    &copy; 2026 Mattu University | Library Management System
</footer>

</body>
</html>