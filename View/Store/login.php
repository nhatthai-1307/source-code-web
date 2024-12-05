<?php

?>
<html>
<?php include 'header.php' ?>
<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Login to your account</h2>
                    <form action="../../Controller/Store/Login.php" method="post">
                        <input type="hidden" name="login" value="Login" />
                        <input type="email" placeholder="Email" name="username" required />
                        <input type="password" placeholder="Password" name="password" required />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>New User Signup!</h2>
                    <form action="../../Controller/Store/Login.php" method="post">
                        <input type="hidden" name="signup" value="signup">
                        <input type="text" placeholder="First Name" name="first_name" required />
                        <input type="text" placeholder="Last Name" name="Last_name" required />
                        <input type="text" placeholder="Email" name="email" required />
                        <input type="text" placeholder="Phone" name="phone" required />
                        <input type="password" placeholder="Password" name="password" required />
                        <input type="password" placeholder="Password Confirm" name="password_confirm" required />
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php' ?>
<script src="../View/js/jquery.js"></script>
<script src="../View/js/price-range.js"></script>
<script src="../View/js/jquery.scrollUp.min.js"></script>
<script src="../View/js/bootstrap.min.js"></script>
<script src="../View/js/jquery.prettyPhoto.js"></script>
<script src="../View/js/main.js"></script>

</html>