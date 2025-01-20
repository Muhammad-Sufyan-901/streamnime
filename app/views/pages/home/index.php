<?php
require_once __DIR__ . '/../../../config/app.php';

function redirect_url($path)
{
    global $appConfig;

    $base_url = rtrim($appConfig['base_url'], '/'); // Pastikan base_url tanpa trailing slash
    $path = ltrim($path, '/'); // Pastikan path tanpa leading slash

    return $base_url . '/' . $path;
}


ob_start();
?>
<section class="banner-container  swiper">
    <div class="swiper-wrapper banner-content">
        <?php foreach ($animes as $anime) : ?>
            <div class="swiper-slide anime-banner" style="background-image: url('./assets/images/anime/banner/<?= $anime['banner'] ?>');">
                <div class="anime-banner-content container">
                    <img src="./assets/images/anime/logo/<?= $anime['logo'] ?>" alt="Anime Logo" width="450" class="mb-12">

                    <div class="anime-category-badges flex items-center gap-4 mb-4">
                        <?php foreach ((new \App\Controllers\HomeController())->getAnimeGenres($anime['id']) as $category) : ?>
                            <div class="anime-category-badge"><?= trim($category) ?></div>
                        <?php endforeach; ?>
                    </div>

                    <p class="banner-description mb-12">
                        <?= $anime['prolog'] ?>
                    </p>

                    <div class="banner-buttons flex items-center gap-8">
                        <a href="<?= redirect_url('detail/' . $anime['slug']); ?>" class="btn-watch"><i class='bx bx-play-circle'></i> Putar Sekarang</a>
                        <button onclick="addToFavorite(<?= $anime['id'] ?>)" class="btn-favorite"><i class='bx bxs-heart'></i> Tambah ke Favorit Saya</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="banner-anime-swiper-button-next swiper-button-next"></div>
    <div class="banner-anime-swiper-button-prev swiper-button-prev"></div>

    <div class="swiper-pagination"></div>
</section>

<section class="anime-list my-16 container">
    <h2 class="anime-list-title text-4xl font-bold mb-12">Anime Terbaru</h2>
    <div class="anime-list-container swiper">
        <div class="swiper-wrapper">
            <?php foreach ($animes as $anime) : ?>
                <div class="swiper-slide anime-card">
                    <a href="<?= redirect_url('detail/' . $anime['slug']); ?>">
                        <img src="./assets/images/anime/poster/<?= $anime['thumbnail'] ?>" alt="Anime Poster" class="anime-card-poster">

                        <div class="anime-card-content mt-8">
                            <div class="anime-category-badges flex items-center flex-wrap gap-4 mb-8">
                                <?php foreach ((new \App\Controllers\HomeController())->getAnimeGenres($anime['id']) as $category) : ?>
                                    <div class="anime-category-badge"><?= trim($category) ?></div>
                                <?php endforeach; ?>
                            </div>
                            <h3 class="anime-card-title text-lg font-bold"><?= $anime['title'] ?></h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="anime-list-swiper-button-next swiper-button-next"></div>
        <div class="anime-list-swiper-button-prev swiper-button-prev"></div>
    </div>
</section>

<section class="anime-list my-16 container">
    <h2 class="anime-list-title text-4xl font-bold mb-12">Anime Trending</h2>
    <div class="anime-list-container swiper">
        <div class="swiper-wrapper">
            <?php foreach ($animes as $anime) : ?>
                <div class="swiper-slide anime-card">
                    <a href="<?= redirect_url('detail/' . $anime['slug']); ?>">
                        <img src="./assets/images/anime/poster/<?= $anime['thumbnail'] ?>" alt="Anime Poster" class="anime-card-poster">

                        <div class="anime-card-content mt-8">
                            <div class="anime-category-badges flex items-center flex-wrap gap-4 mb-8">
                                <?php foreach ((new \App\Controllers\HomeController())->getAnimeGenres($anime['id']) as $category) : ?>
                                    <div class="anime-category-badge"><?= trim($category) ?></div>
                                <?php endforeach; ?>
                            </div>
                            <h3 class="anime-card-title text-lg font-bold"><?= $anime['title'] ?></h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="anime-list-swiper-button-next swiper-button-next"></div>
        <div class="anime-list-swiper-button-prev swiper-button-prev"></div>
    </div>
</section>

<section class="anime-list my-16 container">
    <h2 class="anime-list-title text-4xl font-bold mb-12">Anime Populer</h2>
    <div class="anime-list-container swiper">
        <div class="swiper-wrapper">
            <?php foreach ($animes as $anime) : ?>
                <div class="swiper-slide anime-card">
                    <a href="<?= redirect_url('detail/' . $anime['slug']); ?>">
                        <img src="./assets/images/anime/poster/<?= $anime['thumbnail'] ?>" alt="Anime Poster" class="anime-card-poster">

                        <div class="anime-card-content mt-8">
                            <div class="anime-category-badges flex items-center flex-wrap gap-4 mb-8">
                                <?php foreach ((new \App\Controllers\HomeController())->getAnimeGenres($anime['id']) as $category) : ?>
                                    <div class="anime-category-badge"><?= trim($category) ?></div>
                                <?php endforeach; ?>
                            </div>
                            <h3 class="anime-card-title text-lg font-bold"><?= $anime['title'] ?></h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="anime-list-swiper-button-next swiper-button-next"></div>
        <div class="anime-list-swiper-button-prev swiper-button-prev"></div>
    </div>
</section>

<script>
    function addToFavorite(animeId) {
        console.log('add to favorite');

        fetch('<?= BASE_URL ?>' + '/add-anime-to-favorite/' + animeId, {
            method: 'POST'
        }).then(response => {
            console.log(response);
            return response.json()
        }).then(data => {
            if (data.status === 200) {
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
    }
</script>
<?php
$content = ob_get_clean();
$pageStyle = '/home/styles';

require_once __DIR__ . '/../../layouts/main/main_layout.php';
