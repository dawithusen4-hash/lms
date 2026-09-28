<?php
include 'config.php';

$message = "";

if (isset($_POST['add'])) {
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $title   = mysqli_real_escape_string($conn, $_POST['title']);
    $author  = mysqli_real_escape_string($conn, $_POST['author']);
    $copies  = (int)$_POST['copies'];

    // 🔹 Check duplicate Book ID
    $check = mysqli_query($conn, "SELECT book_id FROM books WHERE book_id='$book_id'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert error'>❌ Book ID already exists. Please use a different ID.</div>";
    } else {
        // 🔹 Insert new book
        $query = "INSERT INTO books (book_id, title, author, copies)
                  VALUES ('$book_id', '$title', '$author', '$copies')";

        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert success'>✅ Book added successfully!</div>";
        } else {
            $message = "<div class='alert error'>❌ Something went wrong. Try again.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Book - Admin Panel</title>

<style>
:root {
    --primary: #2c3e50;
    --secondary: #27ae60;
    --bg: #f4f7f6;
    --white: #ffffff;
    --danger: #e74c3c;
}

/* Base */
body {
    font-family: 'Segoe UI', sans-serif;
    background: var(--bg);
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header */
header {
            background: var(--primary); /* Fixed the missing brand-blue variable */
        color: white;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
nav a {
    color: #000000ff;
    margin: 0 15px;
    text-decoration: none;
    font-weight: bold;
}

nav a:hover {
    color: #fff;
}

/* Form Container */
.container {
    max-width: 500px;
    margin: 50px auto;
    background: var(--white);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: var(--primary);
    margin-bottom: 25px;
}

/* Inputs */
label {
    font-weight: bold;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
}

input:focus {
    border-color: var(--secondary);
    outline: none;
    box-shadow: 0 0 6px rgba(39,174,96,0.3);
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: var(--secondary);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    cursor: pointer;
}

button:hover {
    background: #219150;
}

/* Alerts */
.alert {
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
}

.success {
    background: #d4edda;
    color: #155724;
}

.error {
    background: #f8d7da;
    color: #721c24;
}

/* Back Link */
.back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
    color: var(--primary);
    font-weight: bold;
}

.back-link:hover {
    text-decoration: underline;
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


/* Footer */
footer {
    margin-top: auto;
    text-align: center;
    padding: 15px;
    background: #eee;
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
    <?php echo $message; ?>

    <form method="POST">
        <h2>Add New Book</h2>

        <label>Book ID</label>
        <input type="text" name="book_id" required placeholder="Unique Book ID">

        <label>Book Title</label>
        <input type="text" name="title" required placeholder="Book title">

        <label>Author Name</label>
        <input type="text" name="author" required placeholder="Author name">

        <label>Number of Copies</label>
        <input type="number" name="copies" min="1" required placeholder="coppis of book">

        <button type="submit" name="add">➕ Add Book</button>
    </form>

</div>
<a href="logout.php" class="logout-btn">Logout</a>
<footer>
    <p>&copy; 2026 AT MATTU UNIVERSITY</p>
</footer>

</body>
</html>
