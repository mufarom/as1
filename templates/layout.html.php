<!DOCTYPE html>
<html>

<head>
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="../ibuy.css" />
</head>

<body>
    <header>
        <a href="index.php" id="homeBtn">
            <h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>
        </a>

        <form action="search.php" method="GET">
            <input type="text" name="search" placeholder="Search for anything" />
            <input type="submit" name="submit" value="Search" />
        </form>

        <ul>
            <a href="register.php"><input type="submit" value="Register" /></a>
            <a href="login.php"><input type="submit" value="Login" /></a>
            <a href="manageAdmins.php"><input type="submit" value="Admins" /></a>
        </ul>

    </header>

    <?php
    include '../templates/nav.html.php';
    ?>

    <img src="banners/1.jpg" alt="Banner" />

    <main>
        <?= $output ?>
        <footer>
            &copy; ibuy 2019
        </footer>
    </main>
</body>

</html>