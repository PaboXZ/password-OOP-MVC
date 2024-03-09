<?php include $this->resolve('partials/_head.php'); ?>
<?php include $this->resolve('partials/_header.php'); ?>

<!--Body -->
<script defer src="assets/js/panel.js"></script>
<div class="container">
    <main>
        <div class="box-full-size">
            <?php foreach($passwords as $password): ?>
            <div class="password-tile" style="background-color: #<?= $password['password_color']; ?>">
                <div class="password-tile-name" id="password-name-<?= $password['id'] ?>"><?= $password['password_name']; ?></div>
                <div class="password-tile-actions">
                    <div class="hidden-password" id="password-password-<?= $password['id'] ?>"><?= $password['password'] ?></div>
                    <!--COPY BTN-->
                    <button class="password-tile-action button-small action-copy" id="copy-password-<?= $password['id'] ?>"><img class="action-icon" src="assets/img/copy.png" /></button>
                    <!--VIEW BTN-->
                    <button class="password-tile-action button-small action-view" id="view-password-<?= $password['id'] ?>"><img class="action-icon" src="assets/img/view.png" /></button>
                    <!--EDIT BTN-->
                    <button class="password-tile-action button-small action-edit" id="edit-password-<?= $password['id'] ?>"><img class="action-icon" src="assets/img/edit.png" /></button>
                    <!--DELETE BTN -->
                    <form method="POST" action="delete-password/<?= $password['id'] ?>" id="action-delete-form-<?= $password['id'] ?>">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <?php include $this->resolve('partials/_delete.php'); ?>
                        <button type="button" class="password-tile-action button-small action-delete" id="delete-password-<?= $password['id'] ?>"><img class="action-icon" src="assets/img/delete.png" /></button>
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
    <!--DELETE POPUP-->
    <div class="overlay" id="delete-popup">
        <div class="box-small-size">
            <div>Delete password <span id="delete-popup-name">password</span>?</div>
            <button class="button-small background-confirm" form="" id="delete-popup-confirm">Yes</button>
            <button class="button-small" id="delete-popup-close">No</button>
        </div>
    </div>
    <!--EDIT POPUP-->
    <div class="overlay" id="edit-popup">
        <form method="POST" id="edit-popup-regenerate-form"><?php include $this->resolve('partials/_csrf.php'); ?></form>
        <form method="POST" class="box-small-size" id="edit-popup-edit-form">
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <label class="spread-items">
                <label>Name:</label>
                <input type="text" class="input-invisible" id="edit-popup-name" name="passwordName" />
            </label>
            <div class="spread-items">
                <label>Color:</label>
                <button type="button" class="button-small" id="color-picker-button"></button>
            </div>
            <button type="submit" class="button-small">Change</button>
            <div class="overlay" id="color-picker">
                <div class="box-small-size color-picker-grid">
                    <input class="color-picker-radio" type="radio" name="password-color" value="ccc"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="666"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="c77"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="cc7"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="7c7"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="7cc"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="77c"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="c7c"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="999"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="333"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="822"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="882"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="282"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="288"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="228"/>
                    <input class="color-picker-radio" type="radio" name="password-color" value="828"/>
                    <label class="colspan-4" for="password-color-typed">RGB 12bit:</label>
                    <input class="colspan-4" type="text" pattern="^[0-9a-f]{3}$" name="password-color-typed" id="password-color-typed"/>
                    <div id="password-color-typed-error" class="colspan-8"></div>
                    <button type="button" class="colspan-4 button-small" id="color-picker-pick-color">pick</button>
                    <button type="button" class="colspan-4 button-small" id="color-picker-close-button">cancel</button>
                </div>
            </div>
            <button type="button" class="button-small" id="regenerate-password-open">Generate new</button>
            <div class="grid-two-col grid-expandable" id="regenerate-password-form">
                <div class="span-two-col">Are you sure? Current password will be no longer available.</div>
                <div class="span-two-col grid-two-col">
                    <button form="edit-popup-regenerate-form" type="submit" class="button-small background-confirm overflow-hidden">Generate</button>
                    <button type="button" class="button-small" id="regenerate-password-close">Cancel</button>
                </div>
            </div>
            <button type="button" class="button-small" id="edit-popup-close">cancel</button>
        </form>
    </div>
    <!--VIEW POPUP-->
    <div class="overlay" id="view-popup">
        <div class="box-small-size">
            <div>Password <span id="view-popup-name"></span>:</div>
            <div id="view-popup-password"></div>
            <button class="button-small" id="view-popup-close">close</button>
        </div>
    </div>
</div>
<?php include $this->resolve('partials/_footer.php'); ?>