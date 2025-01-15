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
    <div class="content mx-auto p-12 pb-20 rounded-lg">
        <h2 class="title text-4xl font-bold text-white mb-12">Sign In</h2>

        <form
            action="process/process_login.php"
            class="form form-container"
            method="POST"
            id="login-form">

            <div class="form-control">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    placeholder="muhammadsufyan@gmail.com" />
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    placeholder="********" />
            </div>
            <a href="<?= redirect_url('/register'); ?>" class="link">Not yet registered?</a>
            <button
                type="submit"
                class="btn btn-primary btn-lg">
                Login <i class="bx bxs-right-arrow-circle"></i>
            </button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../../layouts/auth/auth_layout.php';
