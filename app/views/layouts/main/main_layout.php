<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamNime | <?= $pageTitle ?? 'Home' ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= redirect_url('assets/css/resets.css') ?>">
    <link rel="stylesheet" href="<?= redirect_url('assets/css/utilities.css') ?>">
    <link rel="stylesheet" href="<?= redirect_url('assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= redirect_url('assets/css/main/styles.css') ?>">

    <!-- Page CSS -->
    <?php if (isset($pageStyle)): ?>
        <link rel="stylesheet" href="<?= redirect_url('assets/css/' . $pageStyle . '.css') ?>">
    <?php endif; ?>

    <!-- Icons Library -->
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet" />

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <?php require_once __DIR__ . '/partials/navbar.php'; ?>

    <main id="main">
        <?= $content ?? 'No content' ?>
    </main>

    <?php require_once __DIR__ . '/partials/footer.php'; ?>

    <script src="<?= redirect_url('assets/js/index.js') ?>"></script>

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var bannerContainerSwiper = new Swiper(".banner-container", {
            navigation: {
                nextEl: ".banner-anime-swiper-button-next",
                prevEl: ".banner-anime-swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: true,
        });

        var animeListContainerSwiper = new Swiper(".anime-list-container", {
            navigation: {
                nextEl: ".anime-list-swiper-button-next",
                prevEl: ".anime-list-swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
            spaceBetween: 40,
            loop: true,
        });
    </script>

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