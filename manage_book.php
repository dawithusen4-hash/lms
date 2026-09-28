<?php 
include 'config.php';
$result = mysqli_query($conn, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Books - Admin</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --danger: #e74c3c;
            --success: #27ae60;
            --bg: #f4f7f6;
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .header-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--bg);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        h2 { color: var(--primary); margin: 0; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #f8f9fa;
            color: var(--primary);
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            color: #444;
        }

        tr:hover { background-color: #fcfcfc; }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .bg-success { background: #d4edda; color: #155724; }
        .bg-danger { background: #f8d7da; color: #721c24; }

        .btn-delete {
            color: var(--danger);
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid var(--danger);
            border-radius: 4px;
            transition: 0.3s;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
        }

        .back-link {
            display: inline-block;
            text-decoration: none;
            color: var(--accent);
            font-weight: bold;
        }

        /* Success Message */
        .alert-success {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            animation: fadeOut 0.5s ease-in-out 3s forwards;
        }

        @keyframes fadeOut {
            to { opacity: 0; display: none; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-area">
        <h2>📚 Manage Library Inventory</h2>
        <a href="add_book.php" style="text-decoration: none; color: var(--success); font-weight: bold;">+ Add New Book</a>
    </div>

    <?php
    // Show success message after delete
    if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
        echo '<div class="alert-success">Book deleted successfully!</div>';
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Copies Available</th>
                <th>Status</th>
                <th>Action</th>
                <th>Book ID</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                $statusClass = $row['copies'] > 0 ? 'bg-success' : 'bg-danger';
                $statusText = $row['copies'] > 0 ? 'In Stock' : 'Out of Stock';
            ?>
            <tr>
                <td><strong><?php echo $row['title']; ?></strong></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['copies']; ?></td>
                <td><span class="badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
                <td>
                    <a href="delete_book.php?id=<?php echo $row['book_id']; ?>" 
                       class="btn-delete" 
                       onclick="return confirm('Are you sure you want to delete this book?')">
                       Delete
                    </a>
                </td>
                <td><?php echo $row['book_id']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="login.php" class="back-link">← Back to login</a>
</div>

</body>
</html>
