<div class="row mb-2">
  <div class="col-sm-6">
    <a href="<?= site_url ('master_data/vendor_list'); ?>" class="btn btn-sm btn-outline-primary position-relative"
      style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
      <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
      Back
    </a>
  </div>
  <div class="col-sm-6">
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px;margin-right:5px;" data-bs-toggle="modal"
        data-bs-target="#modal-add-material">
        <i class="fa-solid fa-plus"></i>
        Add Material to Vendor
      </button>
      <a href="<?= site_url ('master_data/edit_vendor/' . _encrypt ($vendor->id)); ?>"
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
    <a href="<?= site_url ('master_data/vendor_list'); ?>" class="btn btn-primary position-relative"
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
                    name="vendor_code" value="<?php echo $vendor->vendor_code; ?>" required disabled>
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
                  <input type="number" min="0" class="form-control" id="floatingInput" name="est_lead_time"
                    value="<?php echo $vendor->est_lead_time; ?>" disabled>
                  <label for="floatingInput" class="fw-bold text-primary">Lead Time PO to Deliver</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Select Channel" id="vendor_channel" style="height: 56px;"
                    name="vendor_channel" required disabled>
                    <option value=""> -- Select Channel --</option>
                    <option value="COUPA" <?php echo $vendor->vendor_channel == 'COUPA' ? 'selected' : ''; ?>>COUPA
                    </option>
                    <option value="3P" <?php echo $vendor->vendor_channel == '3P' ? 'selected' : ''; ?>>3P</option>
                    <option value="Online" <?php echo $vendor->vendor_channel == 'Online' ? 'selected' : ''; ?>>Online
                    </option>
                  </select>
                  <label for="floatingInput" for="vendor_channel" class="fw-bold text-primary">Vendor Channel</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="floatingInput" name="additional_margin"
                    value="<?php echo $vendor->additional_margin; ?>" disabled>
                  <label for="floatingInput" class="fw-bold text-primary">Additional Margin (%)</label>
                </div>
              </div>
              <div class="col-4">
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Select Validity" id="validity" style="height: 56px;"
                    name="validity" required disabled>
                    <option value=""> -- Select Validity --</option>
                    <option value="VALID" <?php echo $vendor->validity == 'VALID' ? 'selected' : ''; ?>>VALID</option>
                    <option value="INVALID" <?php echo $vendor->validity == 'INVALID' ? 'selected' : ''; ?>>INVALID
                    </option>
                  </select>
                  <label for="floatingInput" for="category" class="fw-bold text-primary">Validity</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-4">
                <div class="form-floating  mb-3">
                  <input type="text" class="form-control" id="floatingInput" value="<?php echo $vendor->category; ?>"
                    disabled>
                  <label for="floatingInput" for="category" class="fw-bold text-primary">Category</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>
              <!--begin::Col-->
              <!--begin::Col-->
              <div class="col-4">
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Default select example" style="height: 56px;" name="rating"
                    id="rating" disabled>
                    <option value="">-- Select Rating --</option>
                    <option value="1" <?php echo $vendor->rating == '1' ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo $vendor->rating == '2' ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo $vendor->rating == '3' ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?php echo $vendor->rating == '4' ? 'selected' : ''; ?>>4</option>
                    <option value="5" <?php echo $vendor->rating == '5' ? 'selected' : ''; ?>>5</option>
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
  <div class="col-sm-3">
    <a href="<?= site_url ('master_data/vendor_list'); ?>" class="btn btn-primary position-relative"
      style="font-weight: 600; white-space:nowrap;">
      Item List
    </a>
  </div>
</div>
<!--begin::Row-->
<div class="row">
  <div class="col-12 mb-4">
    <table id="table-item" class="table table-bordered" width="100%">
      <thead style="text-align: center;white-space:nowrap;">
        <tr>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">No.</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Item Code</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Item Name</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">UoM</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Total Spend YTD
          </th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Last Year Spend
          </th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Price / UoM</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Lead Time <br />
            (days)</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">MoQ</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Total Price If Qty
            = MoQ (Rp.)</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Savings
            Accumulated</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Place To Buy</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Link</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;">Action</th>
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
        <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
          Delete Vendor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        You are going to delete vendor <?php echo $vendor->vendor_name; ?> - <?php echo $vendor->vendor_code; ?>, all
        data related with this vendor will be deleted. Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel Delete.</button>
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
        <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Add
          Material</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="exampleDataList" class="form-label">Please choose material you want to add.</label>
        <input class="form-control" list="materialOptions" id="selectMaterial"
          placeholder="Type item code / material code to search...">
        <datalist id="materialOptions"></datalist>

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
    $('#table-item').DataTable({
      scrollX: true,
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax": {
        "url": "<?= site_url ('master_data/get_material_list_by_vendor?id=' . _encrypt ($vendor->vendor_code)); ?>",
        "type": "POST"
      },
      "order": [],
      "columnDefs": [{
        targets: [4, 5, 6, 9],
        createdCell: function (cell) {
          $(cell).css('text-align', 'right');
          $(cell).css('vertical-align', 'middle');
          $(cell).css('white-space', 'nowrap');
        }
      },
      {
        targets: [1, 2, 3, 7, 8, 10, 11, 12, 13],
        createdCell: function (cell) {
          $(cell).css('text-align', 'center');
          $(cell).css('vertical-align', 'middle');
          $(cell).css('white-space', 'nowrap');
        }
      },
      {
        targets: '_all',
        createdCell: function (cell) {
          $(cell).css('vertical-align', 'middle');
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