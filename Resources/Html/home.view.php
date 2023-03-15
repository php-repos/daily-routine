<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Daily Routine</title>
    <!--  Tailwindcss CDN  -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Vue CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script> const { createApp } = Vue </script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <?php require __DIR__ . "/Sections/greeting.view.php" ?>
        </div>
        <div>
            <?php require __DIR__ . "/Sections/ram-status.view.php" ?>
        </div>
        <div>
            <?php require __DIR__ . "/Sections/hard-status.view.php" ?>
        </div>
    </div>

    <?php if (is_array($cryptos)): ?>
    <div class="mt-8">
        <?php require __DIR__ . "/Sections/crypto.view.php" ?>
    </div>
    <?php endif; ?>

    <?php if ($show_weather): ?>
    <div class="mt-8">
        <?php require __DIR__ . "/Sections/weather.view.php" ?>
    </div>
    <?php endif; ?>

    <?php if (is_array($headlines)): ?>
    <div class="mt-8">
        <?php require __DIR__ . "/Sections/news.view.php" ?>
    </div>
    <?php endif; ?>
</body>
</html>
