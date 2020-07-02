<?php $dataUser = $this->session->userdata('loginData'); ?>
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <?php if (!empty($dataUser)) {
            $dataUsed = $this->db->query("select sum(file_size) as size from tbl_file where id_user = '".$dataUser['userId']."'")->row();
            ?>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Drive Used</h4>
                <p class="lead mb-0"><?= formatBytes($dataUsed->size) ?></p>
            </div>
            <?php } ?>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About Kuro Drive</h4>
                <p class="lead mb-0">Kuro Drive is a free to upload file</p>
            </div>
        </div>
    </div>
</footer>
<!-- Copyright Section-->
<section class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright © Kuro Drive 2020 - <?= date('Y') ?></small></div>
</section>