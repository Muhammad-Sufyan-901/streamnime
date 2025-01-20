<?php
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}
?>

<header class="header" id="header">
    <nav class="navbar container mx-auto px-0 py-6 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button class="navbar-toggle">
                <i class='bx bx-menu'></i>
            </button>

            <img src="<?= redirect_url('assets/images/logo/logo-streamnime-blue.png'); ?>" alt="StreamNime Logo" width="175" class="logo">
        </div>

        <form
            action=""
            class="form form-container w-1/3"
            method="POST"
            id="login-form">
            <div class="form-control">
                <input
                    type="search"
                    name="search"
                    id="search"
                    required
                    placeholder="Search Anime" />
            </div>
        </form>

        <div class="flex items-center gap-4">
            <?php if (isLoggedIn()) : ?>
                <a href="<?= redirect_url('/profile'); ?>"
                    class="btn btn-primary btn-md">
                    Profile <i class='bx bx-user'></i>
                </a>
            <?php endif; ?>
            <?php if (!isLoggedIn()) : ?>
                <a href="<?= redirect_url('/login'); ?>"
                    class="btn btn-primary btn-md">
                    Login <i class='bx bx-log-in'></i>
                </a>

                <a href="<?= redirect_url('/register'); ?>"
                    class="btn btn-primary-outline btn-md">
                    Register <i class='bx bx-log-in'></i>
                </a>
            <?php endif; ?>
        </div>
    </nav>
</header>