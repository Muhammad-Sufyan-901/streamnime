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
<div class="container">
    <h1 class="page-title text-3xl font-bold mb-4">
        Welcome to Profile, <span class="text-primary"> <?= $_SESSION['username']; ?></span>
    </h1>
    <p class="text-lg font-semibold text-secondary mb-12">Change your profile information here</p>

    <form
        action="<?= redirect_url('/profile/update'); ?>"
        class="form form-container form-light"
        method="POST"
        id="login-form">

        <div class="form-control">
            <label for="email">Username</label>
            <input
                type="username"
                name="username"
                id="username"
                required
                placeholder="John Doe"
                value="<?= $_SESSION['username']; ?>" />
        </div>
        <div class="form-control">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                required
                placeholder="johndoe@gmail.com"
                value="<?= $_SESSION['email']; ?>" />
        </div>
        <button
            type="submit"
            class="btn btn-primary btn-lg">
            Edit Profile <i class="bx bxs-right-arrow-circle"></i>
        </button>
    </form>
</div>

<script>
    const header = document.querySelector("header#header");

    header.classList.add("header-scrolled");
</script>

<?php
$content = ob_get_clean();
$pageStyle = 'profile/styles';

require_once __DIR__ . '/../../layouts/main/main_layout.php';
