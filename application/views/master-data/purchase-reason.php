<?php $this->load->view ('_partials/head.php'); ?>
<style>
  div.dt-container {
    width: 100%;
    margin: 0 auto;
  }
</style>
<div class="row mb-2">
  <div class="col-sm-9">
    <?php $this->load->view ('master-data/_header_parts.php'); ?>
  </div>
  <div class="col-sm-3">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item" aria-current="page">Master Data</li>
      <li class="breadcrumb-item active" aria-current="page">Purchase Reason List</li>
    </ol>
  </div>
</div>

<!--begin::Row-->
<div class="row">
  <div class="col-12 mb-4">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <div class="card-tools">
          <a class="btn btn-sm btn-outline-primary position-relative"
            style="font-weight: 600; border-radius: 50px; white-space:nowrap" data-bs-toggle="modal"
            data-bs-target="#modal-add">
            <i class="fa-solid fa-circle-plus"></i>
            Add New Purchase Reason
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="dt-container">

          <form method="post" id="searchData">
            <?php $this->load->view ('_partials/search_bar.php'); ?>
          </form>
          <table id="purchase_table" class="table table-striped table-bordered" width="100%">
            <thead style="text-align: center;white-space:nowrap;">
              <tr>
                <th style="color: #fff;background-color: #001F82;text-align: center; width: 80px">No.</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">ID</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">Type</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">Purchase Reason</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">Approval</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">WL Approval</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; width: 120px;">Action</th>
              </tr>
            </thead>
            <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
      <!-- <div class="card-footer">Footer</div> -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </div>
</div>
<!--end::Row-->
<div id="popup">
  <!--end::Row-->
  <form id="form-add" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
              Add New Purchase Reason</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <!--begin::Col-->

              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-6">
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Default select example" id="type" style="height: 56px;"
                    data-placeholder="Choose Type" name="type" required>
                    <option></option>
                    <option value="service">Service</option>
                    <option value="goods">Goods</option>
                  </select>
                  <label for="floatingInput" class="fw-bold text-primary">Type</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" name="purchase_reason" required>
                  <label for="floatingInput" class="fw-bold text-primary">Purchase Reason</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Default select example" id="approval" style="height: 56px;"
                    data-placeholder="Choose Approval" name="approval" required>
                    <option></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <label for="floatingInput" class="fw-bold text-primary">Approval</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Default select example" id="wl_approval" style="height: 56px;"
                    data-placeholder="Choose WL Approval" name="wl_approval" required>
                    <option></option>
                    <option value="WL1">WL 1</option>
                    <option value="WL2">WL 2</option>
                    <option value="WL3">WL 3</option>
                  </select>
                  <label for="floatingInput" class="fw-bold text-primary">WL Approval</label>
                  <div class="invalid-feedback">This field is required.</div>
                </div>
              </div>
              <!--end::Col-->

              <!--begin::Col-->
              <!--end::Col-->
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
    var table = $('#purchase_table').DataTable({
      scrollX: true,
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax": {
        "url": "<?= site_url ('master_data/get_purchase_reason'); ?>",
        "type": "POST"
      },
      "order": [],
      "columnDefs": [
        {
          targets: 1, // Sembunyikan kolom ID
          visible: false
        },
        {
          targets: 4, // Kolom Approval Status
          render: function (data, type, row) {
            return data == "1" ? '<span class="badge bg-success fs-6">YES</span>' :
              '<span class="badge bg-danger fs-6">NO</span>';
          }
        },
        {
          targets: '_all',
          createdCell: function (cell) {
            $(cell).css('vertical-align', 'middle');
          }
        }
      ],
      "columns": [
        { "data": 0 },
        { "data": 1 }, // ID (Hidden)
        { "data": 2 },
        { "data": 3 },
        { "data": 4 },
        { "data": 5 },
        { "data": 6 }
      ],
      "searching": false,
      "lengthChange": false
    });

    // Submit form via AJAX
    $('#searchData').submit(function (e) {
      e.preventDefault();
      // table.ajax.reload(); // Reload DataTable            
      $.ajax({
        url: '<?= site_url ('master_data/search_material'); ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
          table.ajax.reload(null, false); // Reload DataTable
        }
      });
    });

    $("body").on("submit", "#form-add", function (e) {
      e.preventDefault();
      var data = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "<?php echo site_url ('master_data/save_purchase_reason') ?>",
        data: data,
        data: $(this).serialize(),
        success: function (response) {
          $('#modal-add').modal('hide');
          table.ajax.reload(null, false); // Reload DataTable
        }
      });
    });
  });

</script>