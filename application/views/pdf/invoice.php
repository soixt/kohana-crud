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
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center py-4">
                <h2 class="text-3xl font-bold">Invoice</h2>
                <div>
                    <p>Date: <span class="font-semibold"><?= date("Y-m-d") ?></span></p>
                    <p>Invoice #: <span class="font-semibold"><?= $invoice->id ?></span></p>
                </div>
            </div>

            <div class="mt-8">
                <div class="mb-2">
                    <p class="font-bold text-xl mb-2">Details (<?= $invoice->system->name ?>)</p>
                    <p><?= $invoice->user->email ?></p>
                    <p><?= $invoice->details ?></p>
                    <p><?= $invoice->amount ?></p>
                </div>
            </div>
        </div>
    </body>
</html>
