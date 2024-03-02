<?php include $this->resolve('partials/_head.php'); ?>
<?php include $this->resolve('partials/_header.php'); ?>
<div class="container">
    <main>
        <form method="POST" class="box-small-size">
            <label for="login">Login:</label>
            <input value="<?=e($oldFormData['login'] ?? "") ?>" type="text" id="login" name="login" />
            <?php if(isset($errors['login'])): ?>
                <div class="error-field"><?=$errors['login'][0];?></div>
            <?php endif; ?>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" />
            <?php if(isset($errors['password'])): ?>
                <div class="error-field"><?=$errors['password'][0];?></div>
            <?php endif; ?>
            <button type="sumbit" class="button-mid">Login</button>
        </form>
    </main>
</div>
<?php include $this->resolve('partials/_footer.php'); ?>