
<!-- Bootstrap core JS-->
<script src="<?= base_url('assets/template/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('assets/template/') ?>js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="<?= base_url('assets/template/') ?>js/jquery.easing.min.js"></script>

<!-- Core theme JS-->
<script src="<?= base_url('assets/template/') ?>js/scripts.js"></script>
<script type="text/javascript">
    var inprogress = false;
    function callToast(text,lamawaktu = 1000){
        $('.toast-body').html(text);
        $('.toast').toast('show');
        setTimeout(function() {
            $('.toast').toast('hide');
        }, lamawaktu);
    }
    function progressHandler(event){
        // hitung prosentase
        var percent = (event.loaded / event.total) * 100;
        // menampilkan prosentase ke komponen id 'progressBar'
        document.getElementById("progressBar").value = Math.round(percent);
        // menampilkan prosentase ke komponen id 'status'
        // document.getElementById("status").innerHTML = Math.round(percent)+"% telah terupload";
        // menampilkan file size yg tlh terupload dan totalnya ke komponen id 'total'
        // document.getElementById("total").innerHTML = "Telah terupload "+event.loaded+" bytes dari "+event.total;
    }
	$(document).ready(function() {
		var addDrive = 'plus';
		$(".addDrive").click(function() {
			if (addDrive == 'plus') {
				$(".addDrive").removeClass("file-medical");
				$(".addDrive").addClass("fa-minus");
				addDrive = 'minus';
			}else{
				$(".addDrive").addClass("file-medical");
				$(".addDrive").removeClass("fa-minus");
				addDrive = 'plus';
			}
		});

        $('.addFolder').popover({
            placement : 'Bottom',
            title : 'Add Folder',
            trigger : 'click',
            html : true,
            sanitize: false,
            content : function(){
                var content = '';
                content = $('#folderAdd').html();
                return content;
            } 
        }).on('shown.bs.popover', function(){

        });
        var popOverShow = '';
        var folderId = '';
        $(document).delegate('.btn-cancel-option', 'click', function(e){
            e.preventDefault();
            $('.addFolder').popover('hide');
            $(popOverShow).popover('hide');
        });

        $(document).on("click",".renameFolder",function(e){
            $(popOverShow).popover('hide');
            e.preventDefault();
            $(this).popover({
                placement : 'Bottom',
                title : 'Rename Folder',
                trigger : 'manual',
                html : true,
                sanitize: false,
                content : function(){
                    var content = '';
                    content = $('#folderRename').html();
                    return content;
                } 
            }).on('shown.bs.popover', function(){

            });
            $('.id_folder').val(folderId);
            popOverShow = this;
            $(this).popover('show');
        })

        $(".clickable-folder").click(function() {
            window.location = $(this).data("href");
        });

        $(".clickable-folder").contextmenu(function(e) {
            e.preventDefault();
            folderId = $(this).data("idfolder");
            console.log(folderId);
            $(this).popover({
                placement : 'Bottom',
                title : 'Manage Folder',
                trigger : 'manual',
                html : true,
                sanitize: false,
                content : function(){
                    var content = '';
                    content = $('#folderMenu').html();
                    return content;
                } 
            }).on('shown.bs.popover', function(){

            });
            popOverShow = this;
            $(this).popover('show');
            var linkRemoveFolder = $(this).data("remove");
            setTimeout(function() {
                $('.removeFolder').attr('href',linkRemoveFolder);
            }, 100);
        });

        var linkFile = '';
        $(".clickable-file").click(function() {
            window.location = $(this).data("href");
        });

        $(".clickable-file").contextmenu(function(e) {
            e.preventDefault();
            linkFile = $(this).data("href");
            
            $(this).popover({
                placement : 'Bottom',
                title : 'Manage File',
                trigger : 'manual',
                html : true,
                sanitize: false,
                content : function(){
                    var content = '';
                    content = $('#fileMenu').html();
                    return content;
                } 
            }).on('shown.bs.popover', function(){

            });
            popOverShow = this;
            $(this).popover('show');
            var linkRemoveFile = $(this).data("remove");
            setTimeout(function() {
                $('.removeFile').attr('href',linkRemoveFile);
            }, 100);
        });
        $(document).on("click",".copyLinkFile",function(){
            //copy link file
            const el = document.createElement('textarea');
            el.value = linkFile;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            // hide popover
            $(popOverShow).popover('hide');
            // call toast
            callToast('Berhasil Copy Link');
        });

        // preventing page from redirecting
        $("html").on("dragover", function(e) {
            e.preventDefault();
            e.stopPropagation();
            $("#textUpload").text("Drag here");
        });

        $("html").on("drop", function(e) { 
            $("#textUpload").html("Drag and Drop file here<br/>Or<br/>Click to select file");
            e.preventDefault(); e.stopPropagation();
        });

        // Drag enter
        $('.upload-area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("#textUpload").text("Drop");
        });

        // Drag over
        $('.upload-area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("#textUpload").text("Drop");
        });

        // Drop
        $('.upload-area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("#textUpload").html("Drag and Drop file here<br/>Or<br/>Click to select file");
            var file = e.originalEvent.dataTransfer.files;
            $("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);

            uploadData('');
        });

        // Open file selector on div click
        $("#uploadfile").click(function(){
            $("#file").click();
        });

        // file selected
        $("#file").change(function(){
            uploadData('');
        });
	});
	
    // Sending AJAX request and upload file
    function uploadData(formdata){
        // $('#formUpload').submit();
        // membaca data file yg akan diupload, dari komponen 'fileku'
        // console.log(document.getElementById("file").files[0]);
        // console.log($("#file")[0].files[0]);
        if (!inprogress) {
            inprogress = true;
            var file = $("#file")[0].files[0];
            var formdata = new FormData();
            formdata.append("file", file);
            formdata.append("id_folder", $("#fileFolder").val());
             
            // proses upload via AJAX disubmit ke 'upload.php'
            // selama proses upload, akan menjalankan progressHandler()
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.open("POST", "<?= base_url('drive/doUpload') ?>", true);
            ajax.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  // console.log(this.response);
                    var response = JSON.parse(this.response);
                    callToast(response.msg,3000);
                    document.getElementById("progressBar").value = 0;
                    if (response.status == 200) {
                        setTimeout(function(){
                            window.location.reload();
                        }, 4000);
                    }
                    inprogress = false;
                }
             };
            ajax.send(formdata);
        }else{
           callToast("sedang mengupload data",3000);
        }
    }

    // Added thumbnail
    function addThumbnail(data){
        $("#uploadfile h1").remove(); 
        var len = $("#uploadfile div.thumbnail").length;

        var num = Number(len);
        num = num + 1;

        var name = data.name;
        var size = convertSize(data.size);
        var src = data.src;

        // Creating an thumbnail
        $("#uploadfile").append('<div id="thumbnail_'+num+'" class="thumbnail"></div>');
        $("#thumbnail_"+num).append('<img src="'+src+'" width="100%" height="78%">');
        $("#thumbnail_"+num).append('<span class="size">'+size+'<span>');

    }

    // Bytes conversion
    function convertSize(size) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (size == 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
        return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }
</script>