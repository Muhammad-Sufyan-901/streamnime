<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamNime | <?= $pageTitle ?? 'Home' ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/resets.css">
    <link rel="stylesheet" href="./assets/css/utilities.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <link rel="stylesheet" href="./assets/css/main/styles.css">

    <!-- Icons Library -->
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet" />
</head>

<body>
    <?php require_once __DIR__ . '/partials/navbar.php'; ?>

    <main id="main">
        <?= $content ?? 'No content' ?>
    </main>

    <?php require_once __DIR__ . '/partials/footer.php'; ?>

    <script src="./assets/js/index.js"></script>
</body>

</html>