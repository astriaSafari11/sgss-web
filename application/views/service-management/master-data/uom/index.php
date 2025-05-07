<?php $this->load->view ('_partials/head.php'); ?>
<style>
    div.dt-container {
        width: 100%;
        margin: 0 auto;
    }
</style>
<div class="row mb-2">
    <div class="col-sm-9">
        <?php $this->load->view ('service-management/master-data/_header_parts.php'); ?>
    </div>
    <div class="col-sm-3">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Master Data</li>
            <li class="breadcrumb-item active" aria-current="page">UOM List</li>
        </ol>
    </div>
</div>

<!--begin::Row-->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-sm btn-outline-primary position-relative"
                        style="font-weight: 600; border-radius: 50px; white-space:nowrap" data-bs-toggle="modal"
                        data-bs-target="#modal-add">
                        <i class="fa-solid fa-circle-plus"></i>
                        Add New UOM
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-container">
                    <form method="post" id="searchData">
                        <?php $this->load->view ('_partials/search_bar.php'); ?>
                    </form>
                    <table id="uom_table" class="table table-striped table-bordered" width="100%">
                        <thead style="text-align: center;white-space:nowrap;">
                            <tr>
                                <th style="color: #fff;background-color: #001F82;text-align: center; width: 80px">No.</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">ID</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">UOM Name</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center; width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;white-space:nowrap;vertical-align:center;"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Row-->

<!-- Modal Add -->
<div id="popup">
    <form id="form-add" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" style="font-weight:600;">Add New UOM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="uom_name" required>
                                    <label for="floatingInput" class="fw-bold text-primary">UOM Name</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-outline-primary" id="btnUpload">Add Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $this->load->view ('_partials/footer.php'); ?>

<script>
    $(document).ready(function () {
        var table = $('#uom_table').DataTable({
            scrollX: true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "<?= site_url('service_master/get_uom'); ?>",
                "type": "POST"
            },
            "order": [],
            "columnDefs": [{
                targets: '_all',
                createdCell: function (cell) {
                    $(cell).css('vertical-align', 'middle');
                }
            }],
            "searching": false,
            "lengthChange": false
        });

        $('#searchData').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('service_master/search_material'); ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function () {
                    table.ajax.reload(null, false);
                }
            });
        });

        $("body").on("submit", "#form-add", function (e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "<?= site_url('service_master/save_uom'); ?>",
                data: data,
                contentType: false,
                processData: false,
                success: function () {
                    $('#modal-add').modal('hide');
                    table.ajax.reload(null, false);
                }
            });
        });
    });
</script>
