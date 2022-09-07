<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row justify-content-md-center">
    <div class="col-4">
        <form id="login_form" class="text-center border border-light p-5" method="post">
            <p class="h4 mb-4">Sign in</p>
            <input type="email" name="email" class="form-control mb-4" placeholder="E-mail" required>
            <input type="password" name="password" class="form-control mb-4" placeholder="Password" required>

            <input class="btn btn-dark btn-block my-4" name="submit" type="submit" value="Sign In">
            <p>Not a member?
                <a href="register">Register</a>
            </p>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="public/js/login.js"></script>