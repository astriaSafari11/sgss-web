<div class="btn-group">
  <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
    style="font-weight: 600; border-radius: 50px; white-space:nowrap;width:200px" data-bs-toggle="dropdown"
    aria-expanded="false">
    Master Data Services
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="<?= site_url ('service_master/usage_reason'); ?>">
        <i class="fa-solid fa-box-archive" style="margin-right:5px; margin-left: 5px;"></i>
        Usage Reason
      </a></li>
    <li>
      <hr class="dropdown-divider" />
    </li>
    <li><a class="dropdown-item" href="<?= site_url ('service_management/master_data'); ?>">
        <i class="fa-solid fa-box-archive" style="margin-right:5px; margin-left: 5px;"></i>
        Service List
      </a></li>
    <li><a class="dropdown-item" href="<?= site_url ('service_master/vendor_list'); ?>">
        <i class="fa-solid fa-address-card" style="margin-right:5px; margin-left: 5px;"></i>
        Vendor
      </a></li>
  </ul>
</div>
<a type="button" class="btn btn-sm btn-outline-primary position-relative"
  style="font-weight: 600; border-radius: 50px; width: 150px;">
  <i class="fa-solid fa-file-export"></i>
  Export
</a>
<a type="button" class="btn btn-sm btn-outline-primary position-relative"
  style="font-weight: 600; border-radius: 50px;width: 150px;" data-bs-toggle="modal" data-bs-target="#modal-import">
  <i class="fa-solid fa-file-import"></i>
  Import
</a>

<form id="form-upload-user" method="post" autocomplete="off" enctype="multipart/form-data">
  <div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
            Import Master Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="exampleDataList" class="form-label">Please download our master template first.</label></br>
          <a href="<?= site_url ('master_data/generate') ?>" type="button" class="btn btn-outline-primary">Download
            Template</a>
          <hr>
          <p class="text-danger"><small>Maximum size of each file = 3000000 bytes (3 mb). Allowed File types which can
              be uploaded = .xlsx</small></p>
          <input type="file" class="custom-file-input" id="file" name="file" data-toggle="custom-file-input"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
          <div class="" style="margin-top: 10px;">
            <div class="user-loader text-center" style="display: none;">
              <i class="fa fa-spinner fa-spin"></i> <small>Please wait system is processing your data...</small>
            </div>
            <div class="alert alert-success alert-dismissable" role="alert" id="success-result" style="display: none;">
              <div class="success-text"></div>
            </div>
            <div class="alert alert-danger alert-dismissable" role="alert" id="failed-result" style="display: none;">
              <div class="failed-text"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-outline-primary" id="btnUpload">Import Data</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $(document).ready(function () {
    $("body").on("submit", "#form-upload-user", function (e) {
      e.preventDefault();
      var data = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "<?php echo site_url ('master_data/upload') ?>",
        data: data,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $("#btnUpload").prop('disabled', true);
          $(".user-loader").show();
          $("#success-result").hide();
          $("#failed-result").hide();
        },
        success: function (result) {
          $("#btnUpload").prop('disabled', false);
          if ($.isEmptyObject(result.error_message)) {
            $("#success-result").show();
            $(".success-text").html(result.success_message);
          } else {
            $("#failed-result").show();
            $(".failed-text").html(result.error_message);
          }
          $(".user-loader").hide();
        }
      });
    });
  });
</script>