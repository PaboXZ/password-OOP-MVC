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
            <label for="email">Email:</label>
            <input value="<?=e($oldFormData['email'] ?? "") ?>" type="email" name="email" id="email" />
            <?php if(isset($errors['email'])): ?>
                <div class="error-field"><?=$errors['email'][0];?></div>
            <?php endif; ?>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" />
            <?php if(isset($errors['password'])): ?>
                <div class="error-field"><?=$errors['password'][0];?></div>
            <?php endif; ?>
            <label for="passwordConfirm">Confirm password:</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm" />
            <?php if(isset($errors['passwordConfirm'])): ?>
                <div class="error-field"><?=$errors['passwordConfirm'][0];?></div>
            <?php endif; ?>
            <label><input type="checkbox" name="tos" /> Accept terms of service</label>
            <?php if(isset($errors['tos'])): ?>
                <div class="error-field"><?=$errors['tos'][0];?></div>
            <?php endif; ?>
            <button type="sumbit">Register</button>
        </form>
    </main>
</div>
<?php include $this->resolve('partials/_footer.php'); ?>