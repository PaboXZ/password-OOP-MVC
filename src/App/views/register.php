<?php include $this->resolve('partials/_head.php'); ?>
<?php include $this->resolve('partials/_header.php'); ?>
<div class="container">
    <main>
        <form method="POST" class="box-small-size">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" />
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" />
            <label for="passwordConfirm">Confirm password:</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm" />
            <label><input type="checkbox" name="tos" /> Accept terms of service</label>
            <button type="sumbit">Register</button>
        </form>
    </main>
</div>
<?php include $this->resolve('partials/_footer.php'); ?>