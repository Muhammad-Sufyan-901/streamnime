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
<div class="banner">
    <div class="banner-content">
        <h1>Plastic Memories</h1>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, voluptates accusantium natus ad similique hic labore, ullam explicabo doloribus ea nam ducimus iure inventore voluptate quam illo. Ex temporibus excepturi eaque, perspiciatis maiores labore provident unde quisquam harum natus corrupti?
        </p>
        <button class="btn-watch">Putar Sekarang</button>
        <button class="btn-favorite">Favorit Saya</button>
    </div>
    <div class="banner-image">
        <img src="./assets/images/anime/poster/plastic-memories.jpg" alt="Anime Image" />
    </div>
</div>


<?php
$content = ob_get_clean();

require_once __DIR__ . '/../../layouts/main/main_layout.php';
