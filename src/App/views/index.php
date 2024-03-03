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
                    <!--COPY BTN-->
                    <button class="password-tile-action button-small"><img class="action-icon" src="assets/img/copy.png" /></button>
                    <!--VIEW BTN-->
                    <button class="password-tile-action button-small"><img class="action-icon" src="assets/img/view.png" /></button>
                    <!--EDIT BTN-->
                    <button class="password-tile-action button-small"><img class="action-icon" src="assets/img/edit.png" /></button>
                    <!--DELETE BTN -->
                    <form method="POST" action="delete-password/<?= $password['id'] ?>">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <?php include $this->resolve('partials/_delete.php'); ?>
                        <button class="password-tile-action button-small"><img class="action-icon" src="assets/img/delete.png" /></button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="password-tile">
                <div class="password-tile-name"><form method="POST" id="add-password" action='/add-password'><?php include $this->resolve('partials/_csrf.php'); ?><input class="input-invisible" type="text" placeholder="Add new..." name="passwordName" /></form></div>
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