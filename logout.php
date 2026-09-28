<html> <head>
        <style> body {
            font-family: Arial, sans-serif;
            background-color: #0f020200;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url(6.jpg);}
            nav {
            background-color: transparent;
            padding: 0.5em;
            text-align: right;
        }
header {
            background-color: #dad618ff;
            color: #f8f3f3;
            text-align: right;
            padding: 1em;
            font-size: 120%;
            width: 100%;
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 1em;
        }

        nav a {
            text-decoration: greenyellow;
            color: rgb(21, 224, 48);
            font-family: 'Times New Roman', Times, serif;
            font-weight: normal;
            transition: 0.4 ease-in-out;
        }

        nav a:hover {
            color: rgb(201, 116, 19);
        }
            </style>
</head>
    <body> <header>
        <h1>logout</h1>
        <nav>
            <a href="about.php">About</a> 
<a href="register.php">Register</a>
 <a href="login.php">Login</a>
<a href="add_book.php">Add Book</a> 
<a href="borrow_book.php">Borrow Book</a> 
<a href="return_book.php">Return Book</a>
    </nav>
    </header><?php
session_start();
session_destroy();
header("Location: login.php");
?>
</body>
</html>
