<?php $dataUser = $this->session->userdata('loginData'); ?>
<?php
$uri = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$loginActive = '';
if ($uri == 'login'&&$uri2 == 'login') {
    $loginActive = 'active';
}
$registerActive = '';
if ($uri == 'login'&&$uri2 == 'register') {
    $registerActive = 'active';
}
$driveActive = '';
if ($uri == 'drive'&&$uri2 == 'manage') {
    $driveActive = 'active';
}
?>
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?= base_url('dashboard') ?>">Kuro Drive</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if (empty($dataUser)) { ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?= $loginActive ?>" href="<?= base_url('login/login') ?>">Login</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?= $registerActive ?>" href="<?= base_url('login/register') ?>">Register</a></li>
                <?php }else{ ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?= $driveActive ?>" href="<?= base_url('drive/manage') ?>">My Drive</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?= base_url('login/log') ?>">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>