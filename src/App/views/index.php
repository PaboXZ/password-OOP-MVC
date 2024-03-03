<?php include $this->resolve('partials/_head.php'); ?>
<?php include $this->resolve('partials/_header.php'); ?>

<!--Body -->
<div class="container">
    <main>
        <div class="box-full-size">
            <?php foreach($passwords as $password): ?>
            <div class="password-tile">
                <div class="password-tile-name"><?= $password['password_name']; ?></div>
                <div class="password-tile-actions">
                    <div class="password-tile-action button-small"><img class="action-icon" src="assets/img/copy.png" /></div>
                    <div class="password-tile-action button-small"><img class="action-icon" src="assets/img/view.png" /></div>
                    <div class="password-tile-action button-small"><img class="action-icon" src="assets/img/edit.png" /></div>
                    <div class="password-tile-action button-small"><img class="action-icon" src="assets/img/delete.png" /></div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="password-tile">
                <div class="password-tile-name"><form method="POST" id="add-password" action='/addPassword'><input type="hidden" name="_CSRF" value="<?= $_SESSION['token']?>" /><input class="input-invisible" type="text" placeholder="Add new..." name="passwordName" /></form></div>
                <div class="password-tile-actions">
                    <button form="add-password" class="password-tile-action button-small"><img class="action-icon" src="assets/img/plus.png" />
                </div>
                <?php if(isset($errors['passwordName'])): ?>
                <div class="error-field"><?= $errors['passwordName'][0] ?></div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>
<?php include $this->resolve('partials/_footer.php'); ?>