<header>
    <a href="/" class="header-item header-logo">mose pswrd gen.1</a>
    <?php if(!isset($_SESSION['user'])): ?>
    <a href="/register" class="header-item button-small">Register</a>
    <a href="/login" class="header-item button-small">Login</a>
    <?php else: ?>
    <a href="/logout" class="header-item button-small">Logout</a>
    <?php endif; ?>
</header>