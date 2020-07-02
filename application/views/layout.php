<!DOCTYPE html>
<html lang="en">
    <head>
        <?php  $this->load->view('include/head') ?>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php  $this->load->view('include/nav') ?>
        <!-- Masthead-->
        <?php  $this->load->view('include/header') ?>

        <?php $this->load->view($v_content) ?>
        <!-- Footer-->
        <?php $this->load->view('include/footer') ?>

        <?php $this->load->view('include/modal') ?>

        <?php $this->load->view('include/script') ?>
    </body>
</html>
