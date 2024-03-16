<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <title><?= isset($title) ? $title : 'Kohana' ?></title>
        <script src="https://code.jquery.com/jquery-4.0.0-beta.min.js"></script>
        <link rel="stylesheet" href="<?= URL::base() . 'assets/css/style.css' ?>">
        <meta name="csrf" content="<?= Security::token(); ?>">
    </head>
    <body class="bg-gray-100 min-h-screen">
        <?= View::factory('partials/nav') ?>
        <?= $content ?>
        <script src="<?= URL::base() . 'assets/js/scripts.js' ?>" defer></script>
    </body>
</html>