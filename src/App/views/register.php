<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    </head>
    <body>
        <form method="POST">
            <input name="name" type="text" />
            <input name="age" type="text" />
            <input name="email" type="text" />
            <input name="password" type="text" />
            <input name="confirmPassword" type="text" />
            <input type="submit" />
            <?php isset($errors) ? var_dump($errors) : "" ?>
            <?php isset($oldFormData) ? var_dump($oldFormData) : "" ?>
        </form>
    </body>
</html>