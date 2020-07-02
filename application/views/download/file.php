<section class="page-section bg-primary text-white mb-0 sundulAtas">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">Download File</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-download"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-12" style="text-align: center;"><p class="lead">Name File - <?= $dataFile->file_realname ?>.</p></div>
            <?php if ($is_video) {?>
            <div class="col-lg-12" style="text-align: center;">
                <h5 style="margin:unset">Preview Video</h5>
                <video width="100%" height="100%" controls>
                    <source src="<?= base_url('download/readfile/'.$dataFile->file_key) ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <?php }?>
            <?php if ($is_image) {?>
            <div class="col-lg-12" style="text-align: center;">
                <h5 style="margin:unset">Preview Image</h5>
                <img src="<?= base_url('download/readfile/'.$dataFile->file_key) ?>" width="100%" height="100%">
            </div>
            <?php }?>
        </div>
        <!-- About Section Button-->
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light" href="<?= base_url('download/do/'.$dataFile->file_key) ?>" download="<?= $dataFile->file_realname ?>"><i class="fas fa-download mr-2"></i>Already Download!</a>
        </div>
    </div>
</section>