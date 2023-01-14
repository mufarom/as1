<h2>Register</h2>
<div class="form-container">
    <form action="register.php" method="POST">
        <input type="text" name="firstname" required placeholder="Firstname">
        <input type="text" name="surname" required placeholder="Surname">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="password" name="cpassword" required placeholder="Confirm Password">
        <input type="submit" name="submit" value="Register" class="form-btn">
        <p>Already have an account?<a href="login.php">Login</a></p>
    </form>
</div>