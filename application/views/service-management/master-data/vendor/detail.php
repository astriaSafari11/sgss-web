<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container--bootstrap-5 .select2-selection {
        width: 100%;
        min-height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-family: inherit;
        /* font-size: 1rem;
        font-weight: 400; */
        /* line-height: 1.5; */
        color: #212529;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15sease-in-out, box-shadow .15sease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        /* height: 58px; */
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        font-size: 0.875rem;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        /* padding-left: 8px;
      padding-right: 20px; */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-top: 2px;
    }
</style>
<div class="row mb-2">
    <div class="col-sm-6">
        <a href="<?= site_url ('service_master/vendor_list'); ?>"
            class="btn btn-sm btn-outline-primary position-relative"
            style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
            <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
            Back
        </a>
    </div>
    <div class="col-sm-6">
        <div class="d-flex justify-content-end">
            <!-- <button type="button" class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px;margin-right:5px;" data-bs-toggle="modal"
        data-bs-target="#modal-add-material">
        <i class="fa-solid fa-plus"></i>
        Add Material to Vendor
      </button> -->
            <a href="<?= site_url ('service_master/edit_vendor/' . _encrypt ($vendor->id)); ?>"
                class="btn btn-sm btn-outline-primary"
                style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:5px;">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit
            </a>
            <button type="button" class="btn btn-sm btn-outline-danger"
                style="font-weight: 600; border-radius: 50px;width: 150px;" data-bs-toggle="modal"
                data-bs-target="#modal-delete">
                <i class="fa-solid fa-trash"></i>
                Delete
            </button>
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="col-sm-3">
        <a href="<?= site_url ('service_master/vendor_list'); ?>" class="btn btn-primary position-relative"
            style="font-weight: 600; white-space:nowrap;">
            General Information
        </a>
    </div>
</div>
<!--begin::Row-->
<div class="row">
    <div class="col-12 mb-4">
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Vendor Code"
                                        name="vendor_code" value="<?php echo $vendor->vendor_code; ?>" required
                                        disabled>
                                    <label for="floatingInput" class="fw-bold text-primary">Vendor Code</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="vendor_name"
                                        value="<?php echo $vendor->vendor_name; ?>" required disabled>
                                    <label for="floatingInput" class="fw-bold text-primary">Vendor Name</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="vendor_location"
                                        value="<?php echo $vendor->vendor_location; ?>" required disabled>
                                    <label for="floatingInput" class="fw-bold text-primary">Vendor Location</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="number" min="0" class="form-control" id="floatingInput"
                                        name="est_lead_time" value="<?php echo $vendor->est_lead_time; ?>" disabled>
                                    <label for="floatingInput" class="fw-bold text-primary">Lead Time PO to
                                        Deliver</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Select Channel" id="vendor_channel"
                                        style="height: 56px;" name="vendor_channel" required disabled>
                                        <option value=""> -- Select Channel --</option>
                                        <option value="COUPA" <?php echo $vendor->vendor_channel == 'COUPA' ? 'selected' : ''; ?>>COUPA
                                        </option>
                                        <option value="3P" <?php echo $vendor->vendor_channel == '3P' ? 'selected' : ''; ?>>3P</option>
                                        <option value="Online" <?php echo $vendor->vendor_channel == 'Online' ? 'selected' : ''; ?>>Online
                                        </option>
                                    </select>
                                    <label for="floatingInput" for="vendor_channel" class="fw-bold text-primary">Vendor
                                        Channel</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput"
                                        name="additional_margin" value="<?php echo $vendor->additional_margin; ?>"
                                        disabled>
                                    <label for="floatingInput" class="fw-bold text-primary">Additional Margin
                                        (%)</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Select Validity" id="validity"
                                        style="height: 56px;" name="validity" required disabled>
                                        <option value=""> -- Select Validity --</option>
                                        <option value="VALID" <?php echo $vendor->validity == 'VALID' ? 'selected' : ''; ?>>VALID</option>
                                        <option value="INVALID" <?php echo $vendor->validity == 'INVALID' ? 'selected' : ''; ?>>INVALID
                                        </option>
                                    </select>
                                    <label for="floatingInput" for="category"
                                        class="fw-bold text-primary">Validity</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-4">
                                <div class="form-floating  mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo $vendor->category; ?>" disabled>
                                    <label for="floatingInput" for="category"
                                        class="fw-bold text-primary">Category</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <!--begin::Col-->
                            <!--begin::Col-->
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example"
                                        style="height: 56px;" name="rating" id="rating" disabled>
                                        <option value="">-- Select Rating --</option>
                                        <option value="1" <?php echo $vendor->rating == '1' ? 'selected' : ''; ?>>1
                                        </option>
                                        <option value="2" <?php echo $vendor->rating == '2' ? 'selected' : ''; ?>>2
                                        </option>
                                        <option value="3" <?php echo $vendor->rating == '3' ? 'selected' : ''; ?>>3
                                        </option>
                                        <option value="4" <?php echo $vendor->rating == '4' ? 'selected' : ''; ?>>4
                                        </option>
                                        <option value="5" <?php echo $vendor->rating == '5' ? 'selected' : ''; ?>>5
                                        </option>
                                    </select>
                                    <label for="floatingInput" for="rating" class="fw-bold text-primary">Rating</label>
                                </div>
                            </div>
                            <!--begin::Col-->
                            <!--end::Col-->
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo myDate ($vendor->time_add); ?>" disabled>
                                    <label for="floatingInput" class="fw-bold text-primary">Created At</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo myDate ($vendor->time_update); ?>" disabled>
                                    <label for="floatingInput" class="fw-bold text-primary">Updated At</label>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row mb-2">
    <div class="d-flex justify-content-start align-items-center">
        <div>
            <a href="<?= site_url ('master_data/vendor_list'); ?>" class="btn btn-primary position-relative"
                style="font-weight: 600; white-space: nowrap;">
                Item List
            </a>
        </div>
        <div>
            <button type="button" class="btn btn-sm btn-outline-primary ms-3"
                style="font-weight: 600; border-radius: 50px;" data-bs-toggle="modal"
                data-bs-target="#modal-add-material">
                <i class="fa-solid fa-plus"></i>
                Add Service to Vendor
            </button>
        </div>
    </div>
</div>
<!--begin::Row-->
<div class="row">
    <div class="col-12 mb-4">
        <table id="table-item" class="table table-bordered" width="100%">
            <thead style="text-align: center;white-space:nowrap;">
                <tr>
                    <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">No.</th>
                    <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Service
                        Code</th>
                    <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Service
                        Name</th>
                    <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Service
                        Type</th>
                    <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Service
                        Recurring</th>
                    <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Service
                        Urgent If</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                    style="color: #001F82;font-weight:600;">
                    Delete Vendor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You are going to delete vendor <?php echo $vendor->vendor_name; ?> -
                <?php echo $vendor->vendor_code; ?>, all
                data related with this vendor will be deleted. Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel
                    Delete.</button>
                <a href="<?= site_url ('master_data/delete_vendor?id=' . _encrypt ($vendor->id)); ?>" type="button"
                    class="btn btn-outline-danger">Yes, Delete Data.</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-add-material" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                    style="color: #001F82;font-weight:600;">Add
                    Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <label for="selectMaterial" class="form-label">Please choose material you want to add.</label> -->
                <select id="selectMaterial" class="form-select" name="item">
                    <option value="">-- All Item --</option>
                    <?php foreach ($item_list as $k => $v)
                    {
                    $s = isset ($param_search['item']) && $param_search['item'] == $v->id ? 'selected' : '';
                    ?>
                        <option value="<?php echo $v->item_code; ?>" <?php echo $s; ?>><?php echo $v->item_name; ?>
                        </option>
                    <?php } ?>
                </select>

                <div style="margin-top: 10px;" id="selectedMaterial"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-primary" id="submitMat" onclick="submit_material()">Add
                    Material</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#selectMaterial').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $("#modal-add-material")
        });

        $('#table-item').DataTable({
            scrollX: true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "<?= site_url ('service_master/get_material_list_by_vendor?id=' . _encrypt ($vendor->vendor_code)); ?>",
                "type": "POST"
            },
            "order": [],
            "columnDefs": [
                {
                    targets: '_all',
                    createdCell: function (cell) {
                        $(cell).css('vertical-align', 'middle');
                        $(cell).css('text-align', 'center');
                    }
                }
            ],
        });
    });
</script>
<script>
    var URL_AJAX = '<?php echo site_url (); ?>/ajax';
    var selectedItem = [];

    $(document).ready(function () {
        get_material();
        $('#selectMaterial').on('change', function () {
            var value = $(this).val();
            selectedItem.push(value);
            showHtml(selectedItem)
            $(this).val('');
        });

    });

    function showHtml(item) {
        if (item.length > 0) {
            var showHtml = '';
            var data;
            for (var i = 0; i < item.length; i++) {
                data = '<button type="button" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;" onclick=remove_selected("' + item[i] + '")> ' + item[i] + ' <i class="fa-solid fa-xmark"></i></button>';
                showHtml = showHtml + data;
            }
            $('#selectedMaterial').html(showHtml);
        } else {
            $('#selectedMaterial').html('');
        }
    }

    function submit_material() {
        $('#submitMat').attr('disabled', true);
        $('#submitMat').text('Processing...');

        var values = {
            "item_code": selectedItem,
            "vendor_code": '<?php echo $vendor->vendor_code; ?>'
        };

        $.ajax({
            url: URL_AJAX + "/add_material_to_vendor",
            type: "post",
            data: values,
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    function remove_selected(id) {
        var newItem = selectedItem.filter(item => String(item) != String(id));
        selectedItem = newItem;

        showHtml(selectedItem);
    }

    function get_material(id) {
        $.post(URL_AJAX + "/get_material", {
            id
        }, function (o) {
            $('#materialOptions').html(o);
        });
    }

    function get_material(id) {
        $.post(URL_AJAX + "/get_material", {
            id
        }, function (o) {
            $('#materialOptions').html(o);
        });
    }
</script>