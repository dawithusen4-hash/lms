<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About - Library Management System</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --bg: #f4f7f6;
            --white: #ffffff;
            --text: #555;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: var(--white);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        header {
            text-align: center;
            border-bottom: 3px solid var(--accent);
            margin-bottom: 30px;
            padding-bottom: 20px;
        }

        h2 { color: var(--primary); margin-bottom: 10px; }
        h3 { color: var(--accent); border-left: 5px solid var(--accent); padding-left: 15px; margin-top: 30px; }

        p { margin-bottom: 20px; font-size: 1.1rem; text-align: justify; }

        /* List Styling */
        ul { list-style: none; padding: 0; }
        ul li {
            background: #f9f9f9;
            margin: 8px 0;
            padding: 12px 15px;
            border-radius: 8px;
            border-left: 3px solid var(--primary);
            transition: 0.3s;
        }
        ul li:hover { transform: translateX(10px); background: #f1f1f1; }

        /* Team Section */
        .team-box {
            background: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            margin-top: 40px;
        }
        .team-box h5 { margin: 0 0 10px 0; color: var(--primary); font-size: 1.2rem; }
        .member-list { font-weight: bold; color: #2c3e50; line-height: 2; }

        /* Back Button */
        .back-link {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            color: var(--accent);
            font-weight: bold;
            transition: 0.2s;
        }
        .back-link:hover { color: var(--primary); }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background: var(--primary);
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h2>About Library Management System</h2>
        <p>Efficiently managing <b  color: #721c24;>BOOK </b>at Mattu University</p>
    </header>

    <section>
        <p>
            The <strong>Library Management System</strong> is a modern web-based application developed using
            <strong>PHP</strong> and <strong>MySQL</strong>. It is engineered to streamline library activities, 
            moving away from traditional manual record-keeping to a digital, high-speed environment.
        </p>
    </section>

    <h3>🚀 Main Features</h3>
    <ul>
        <li>✅ Secure User Registration and Login</li>
        <li>✅ Multi-level Access (Admin and Member roles)</li>
        <li>✅ Real-time Book Inventory Management</li>
        <li>✅ Automated Borrowing and Returning Workflows</li>
        <li>✅ Relational Database Architecture</li>
    </ul>

    <h3>💻 Technologies Used</h3>
    <ul>
        <li><strong>Backend:</strong> PHP 8.x</li>
        <li><strong>Database:</strong> MySQL (Relational)</li>
        <li><strong>Frontend:</strong> HTML5 & CSS3</li>
        <li><strong>Environment:</strong> Apache Server (WAMP)</li>
    </ul>

    <div class="team-box">
        <h5>👨‍💻 System Designed By:</h5>
        <div class="member-list">
            1. Wondimu Nega <br>
            2. Gurmessa Deraje <br>
            3. Dawit Husen
        </div>
    </div>

    <a class="back-link" href="login.php">⬅️ Back to login</a>
</div>

<footer>
    <p>&copy 2026 AT MATTU UNIVERSITY.</p>
</footer>

</body>
</html>