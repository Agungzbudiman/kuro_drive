<?php $parent = $this->uri->segment(3) ?>
<section class="page-section sundulAtas">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Manage Drive</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon">
                <i class="fas fa-file-medical addDrive cPointer" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"></i>
            </div>
            <div class="divider-custom-icon" style="margin-left: 20px;" title="add folder">
                <i class="fas fa-folder-plus addFolder cPointer"></i>
            </div>
            <?php if (!empty($parent)) { ?>
            <div class="divider-custom-icon" style="margin-left: 20px;" title="back">
                <a href="<?= base_url('drive/manage/'.$back) ?>" style="text-decoration: none;" class="fas fa-arrow-circle-left cPointer"></a>
            </div>
            <?php } ?>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-12">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card">
                        <progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
                        <form id="formUpload" action="<?= base_url('drive/doUpload') ?>" method="post" enctype="multipart/form-data">
                            <input type="file" name="file" id="file">
                            <input type="hidden" name="id_folder" id="fileFolder" value="<?= $parent ?>">
                            <!-- Drag and Drop container-->
                            <div class="upload-area"  id="uploadfile">
                                <h1 id="textUpload">Drag and Drop file here<br/>Or<br/>Click to select file</h1>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <?= $this->session->flashdata('msgbox') ?>
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name File</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Size File</th>
                        </tr>
                    </thead>
                    <tbody class="tblDrive">
                        <?php foreach ($dataFolder as $key => $value) { ?>
                        <tr class="clickable-folder" data-href="<?= base_url('drive/manage/'.$value->folder_id) ?>" data-idfolder="<?= $value->folder_id ?>" data-remove="<?= base_url('drive/removeFolder/'.$value->folder_id.'/'.$this->uri->segment(3)) ?>">
                            <td><?= $value->folder_name ?></td>
                            <td>My Folder</td>
                            <td>-</td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($dataFile as $key => $value) { ?>
                        <tr class="clickable-file" data-href="<?= base_url('download/file/'.$value->file_key) ?>" data-remove="<?= base_url('drive/removeFile/'.$value->file_key.'/'.$this->uri->segment(3)) ?>">
                            <td><?= $value->file_realname ?></td>
                            <td>My File</td>
                            <td><?= formatBytes($value->file_size) ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (count($dataFolder)==0&&count($dataFile)==0): ?>
                        <tr>
                            <td colspan="3"><p style="text-align: center;">Empty</p></td>
                        </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div style="display: none;" id="folderAdd">
    <form class="row" action="<?= base_url('drive/addFolder') ?>" method="post">
        <div class="col-sm-12">
            <input type="hidden" name="id_folder" value="<?= $this->uri->segment(3) ?>">
            <input type="text" class="form-control" name="folder_name" placeholder="Folder Name" required>
        </div>
        <div class="clearfix col-sm-12" style="margin-top: 10px;">
          <button class="btn btn-primary btn-go">Add</button>
          <button type="button" style="float: right;" class="btn btn-danger btn-cancel-option">Cancel</button>
        </div>
    </form>
</div>
<div style="display: none;" id="folderRename">
    <form class="row" action="<?= base_url('drive/renameFolder') ?>" method="post">
        <div class="col-sm-12">
            <input type="hidden" name="id_parent" value="<?= $this->uri->segment(3) ?>">
            <input type="hidden" name="id_folder" class="id_folder">
            <input type="text" class="form-control" name="folder_name" placeholder="Folder Name Rename" required>
        </div>
        <div class="clearfix col-sm-12" style="margin-top: 10px;">
          <button class="btn btn-primary btn-go">Update</button>
          <button type="button" style="float: right;" class="btn btn-danger btn-cancel-option">Cancel</button>
        </div>
    </form>
</div>
<div style="display: none;" id="folderMenu">
    <ul class="bd-sidebar nav">
        <li><a class="renameFolder">Ganti Nama</a></li>
        <li><a class="removeFolder">Hapus</a></li>
        <li><a class="btn-cancel-option">Cancel</a></li>
    </ul>
</div>
<div style="display: none;" id="fileMenu">
    <ul class="bd-sidebar nav">
        <li><a class="removeFile">Hapus</a></li>
        <li><a class="copyLinkFile">Copy link</a></li>
        <li><a class="btn-cancel-option">Cancel</a></li>
    </ul>
</div>
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false" style="position: absolute;right: 20px;bottom: 0">
  <div class="toast-header">
    <strong class="mr-auto">Info</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
  </div>
</div>