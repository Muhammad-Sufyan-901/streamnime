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

    <!-- Page CSS -->
    <?php if (isset($pageStyle)): ?>
        <link rel="stylesheet" href="./assets/css/<?= $pageStyle ?>.css">
    <?php endif; ?>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    if (!empty($_SESSION['flash_message'])) {
        $flashMessage = $_SESSION['flash_message'];
        echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: '{$flashMessage['type']}',
                title: '{$flashMessage['message']}',
                confirmButtonColor: '#008bfa',
                timer: 1500,
            });
        });
    </script>";

        unset($_SESSION['flash_message']); // Hapus pesan flash setelah ditampilkan
    }
    ?>
</body>

</html>