<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/app.css" rel="stylesheet">
    <title>Youdemy</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/auth/login.php">Login</a></li>
                <li><a href="/auth/register.php">Register</a></li>
                <li><a href="/courses/index.php">Courses</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php include($view); ?>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Youdemy. All rights reserved.</p>
    </footer>

    <script src="/public/js/app.js"></script>
</body>
</html>