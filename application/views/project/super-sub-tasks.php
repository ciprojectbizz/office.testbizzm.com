<!-- Button trigger modal -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Super Sub Tasks</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card" style="border-radius: 15px">
                        <div class="card-header">

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead style="background-color:#023047; color: #fff">
                                    <tr>
                                        <th>Super Sub Task</th>
                                        <th>Assign To</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($tasks as $task) : ?>
                                    <tr style="background-color: #fff; color: #000">
                                        <td><i class="fa fa-tasks"></i> <?= $task['super_sub_task_name'] ?></td>
                                        <td><i class="fa fa-user"></i> <?= $task['assign_to_name'] ?></td>
                                        <td><?= $task['created_by_name'] ?></td>
                                         <td><a href="<?= base_url('project/assign_super_sub_tasks/' . $task['id'] . '/' . $sub_task_id . '/' . $project_id) ?>"
                                                class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Asign Super Sub Tasks"><i
                                                    class="fas fa-tasks"></i> 
                                                </a> &nbsp; <a
                                                href="<?= base_url('project/view_details/' . $project_id . '/' . $sub_task_id . '/' . $task['super_sub_task_id']) ?>"
                                                class="btn btn-default" style="background-color:#3d405b; color: #fff" data-toggle="tooltip" title="View Details"><i
                                                    class="fa fa-eye"></i> </a>
                                            &nbsp; <button type="button" class="btn btn-default"
                                                style="background-color: #184e77; color:#fff"
                                                onclick="open_upload_file(<?= $task['super_sub_task_id'] ?>)" data-toggle="tooltip" title="File upload"><i
                                                    class="fa fa-upload"></i> </button> &nbsp;

                                            <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#captureimage" onclick="on_camera()"
                                                style="background-color: #023e8a; color:#fff" data-toggle="tooltip" title="capture"><i
                                                    class="fa fa-camera"></i>
                                               </button>
                                            <!-- <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#myModal3" style="background-color: #457b9d; color:#fff" data-toggle="tooltip" title="Scanner"><i
                                                    class="fa fa-barcode"></i> </button> -->
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="modal-form">

                    <form id="upload_file_form" method="post" enctype="multipart/form-data">
						<div class="form-group ">
							<!---<label for="first_name" class="col-sm-6 control-label">First Name 
							</label>-->
							<div class="col-sm-12">
								<select class="form-select form-control" name = "folder_name" required>
									<option selected>Select Year</option>
									<?php foreach($file_assign as $file_assignRow) { ?>
									<option value="<?= $file_assignRow['id'] ?>"><?= $file_assignRow['folder_name'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group ">
							<!---<label for="first_name" class="col-sm-6 control-label">First Name 
							</label>-->
							<div class="col-sm-12">
								<input type="file" class="" name="files[]" style="margin-top: 10px;" multiple>
							</div>
						</div>
                        
                        <input type="hidden" name="super_sub_task_id" id="super_sub_task_id">
                        <input type="hidden" name="sub_task_id" value="<?= $sub_task_id ?>">
                        <input type="hidden" name="project_id" value="<?= $project_id ?>">
                </div>
                <div id="" class="popup_error" style="font-size: 13px;color:#CC0000;"></div><br>
                <button class="btn btn-success" type="button" id="upload_file_btn">UPLOAD</button>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="captureimage">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px; overflow: auto;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Capture</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="close_camera()">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <form method="POST" action="<?= base_url('project/capture_image/' . $project_id) ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="my_camera"></div>
                                <br />
                                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" name="webcam" id="webcamimage" class="image-tag">
                                <input type="hidden" name="image" class="image-tag">
                            </div>
                            <div class="col-md-6">
                                <div id="results"></div>
                            </div>
                            <div class="col-md-12 text-center">
                                <br />
                                <input type="submit" class="btn btn-success" value="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="myModal3">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Scan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="modal-form">
                    <p>Connect your scanner</p>
                    <form action="<?php echo base_url(); ?>project/qrcodeGenerator" method="post">
                        <input type="text" name="qrcode_text">
                        <input type="submit" class="btn btn-success" value="submit">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div style="display: none;" id="loder">
    <?php $this->load->view('loder') ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<!-- JavaScript Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<link rel="stylesheet" href="<?= base_url('assets/toast/toastr.min.css') ?>">
<script src="<?= base_url('assets/toast/toastr.min.js') ?>"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
function on_camera() {
    Webcam.set({
        width: 250,
        height: 150,
        image_format: 'jpeg',
        upload_name: 'webcam',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');
}

function close_camera() {
    Webcam.reset();
}

function take_snapshot() {
    Webcam.snap(function(data_uri) {
        $('#webcamimage').val(data_uri);
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
    });
    Webcam.upload(data_uri, '"<?php echo base_url(); ?>Enquiry_Management/Demosave"', function(code, text) {
        if (code === '200') {
            alert('ok');
        } else {
            alert('error');
        }
    });
}

function open_upload_file(super_sub_task_id) {
    $('#upload_file_form')[0].reset();
    $('#myModal1').modal('show');
    $('#super_sub_task_id').val(super_sub_task_id)

}

$('#upload_file_btn').click(function(e) {
    e.preventDefault();
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-right"
    };
    var form = $('#upload_file_form')[0];
    var data = new FormData(form);
    $.ajax({
        url: "<?= base_url('project/post_add_image') ?>",
        type: 'post',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            $('#loder').show()
        },
        success: function(data) {
            console.log(data)
            if (data.status == 'success') {
                toastr.success('File Upload Successfully');
                setTimeout(() => {
                    window.location.href = "<?= base_url() ?>/" + data.url
                }, 1000)
            } else {
                if (data.error)
                    toastr.error(data.error)
                if (data.error_project_id)
                    toastr.error(data.error_project_id);
                if (data.error_sub_task_id)
                    toastr.error(data.error_sub_task_id);
                if (data.error_super_sub_task_id)
                    toastr.error(data.error_super_sub_task_id);
                if (data.error_file)
                    toastr.error(data.error_file);
            }
            $('#loder').hide()
        },
        error: function(error) {
            // console.log(error)
            $('#loder').hide()
        }
    })
})
</script>
