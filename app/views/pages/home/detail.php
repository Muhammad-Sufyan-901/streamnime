<?php
require_once __DIR__ . '/../../../config/app.php';

function redirect_url($path)
{
    global $appConfig;

    $base_url = rtrim($appConfig['base_url'], '/'); // Pastikan base_url tanpa trailing slash
    $path = ltrim($path, '/'); // Pastikan path tanpa leading slash

    return $base_url . '/' . $path;
}

$initialEpisode = 0;

ob_start();
?>

<section class="detail-anime" style="background-image: url('<?= redirect_url('assets/images/anime/banner/' . $anime['banner']) ?>');">
    <div class="detail-anime-container">
        <h2 class="detail-anime-title text-2xl font-bold">Detail Anime <span class="text-primary"> <?= $anime['title']; ?></span></h2>

        <div class="detail-anime-content">
            <img src="<?= redirect_url('assets/images/anime/poster/' . $anime['thumbnail']) ?>" height="400" width="300" class="detail-anime-poster" alt="Anime Poster">

            <div class="detail-anime-info flex flex-col gap-6 w-full">
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Judul <span>:</span> </span> <?= $anime['title'] ?></h3>
                </div>
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Skor <span>:</span> </span> <?= $anime['score'] ?></h3>
                </div>
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Produser <span>:</span> </span> <?= $anime['producer'] ?></h3>
                </div>
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Tipe <span>:</span> </span> <?= $anime['type'] ?></h3>
                </div>
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Status <span>:</span> </span> <?= $anime['status'] ?></h3>
                </div>
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Tanggal Rilis <span>:</span> </span> <?= date('j M Y', strtotime($anime['release_date'])) ?></h3>
                </div>
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Studio <span>:</span> </span> <?= $anime['studio'] ?></h3>
                </div>
                <div class="detail-anime-info-row w-full">
                    <h3 class="text-base"><span class="font-bold">Deskripsi <span>:</span> </span>
                        <div class="mt-4 anime-description"><?= $anime['description'] ?></div>
                    </h3>
                </div>
            </div>
        </div>

        <div class="detail-anime-episodes mt-8">
            <h2 class="text-2xl font-bold">Episode Anime <span class="text-primary"> <?= $anime['title']; ?></span></h2>

            <div id="video-container" class="mt-8">
                <video id="anime-video-player" style="width: 100%;" controls>
                    <source src="<?= $animeEpisodes[$initialEpisode]['video'] ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="detail-anime-episodes-container flex items-center flex-wrap gap-4 mt-8">
                <?php foreach ($animeEpisodes as $index => $animeEpisode) : ?>
                    <div
                        class="detail-anime-episode <?= $index === 0 ? 'active' : '' ?>"
                        data-video="<?= $animeEpisode['video'] ?>"
                        onclick="changeEpisode(this)">
                        Episode <?= $animeEpisode['episode_number']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
</section>

<script>
    function changeEpisode(element) {
        // Ambil semua elemen episode
        const episodes = document.querySelectorAll(".detail-anime-episode");
        const videoPlayer = document.getElementById("anime-video-player");

        // Hapus class active dari semua episode
        episodes.forEach(episode => episode.classList.remove("active"));

        // Tambahkan class active ke elemen yang diklik
        element.classList.add("active");

        // Ubah source video pada video player
        const newVideoSrc = element.getAttribute("data-video");
        videoPlayer.querySelector("source").setAttribute("src", newVideoSrc);
        videoPlayer.load(); // Reload video untuk memutar episode baru
    }

    // Tambahkan header class saat halaman dimuat
    const header = document.querySelector("header#header");
    header.classList.add("header-scrolled");
</script>
<?php
$content = ob_get_clean();
$pageStyle = '/home/styles';

require_once __DIR__ . '/../../layouts/main/main_layout.php';
