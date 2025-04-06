<?php $this->load->view ('_partials/head.php'); ?>
<form action="<?= site_url ('master_data/save_purchase_reason'); ?>" method="post" class="needs-validation" novalidate>
  <div class="row mb-2">
    <div class="col-sm-6">
      <a href="<?= site_url ('master_data/purchase_reason'); ?>" class="btn btn-sm btn-outline-primary position-relative"
        style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
        <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
        Back
      </a>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Purchase Reason List</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-12 mb-4">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
            <!--begin::Col-->
            <div class="col-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Type" name="type"
                  required>
                <label for="floatingInput" class="fw-bold text-primary">Type</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Purchase Reason" name="purchase_reason"
                  required>
                <label for="floatingInput" class="fw-bold text-primary">Purchase Reason</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingInput" name="approval_status" required>
                    <option value="" selected disabled>-- Select Approval Status --</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                    </select>
                    <label for="floatingApproval" class="fw-bold text-primary">Status Approval</label>
                    <div class="invalid-feedback">This field is required.</div>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingInput" name="WL_Approval" required>
                    <option value="" selected disabled>-- Select WL Approval --</option>
                    <option value="WL1">WL1</option>
                    <option value="WL2">WL2</option>
                    <option value="WL3">WL3</option>
                    <option value="WL4">WL4</option>
                    </select>
                    <label for="floatingApproval" class="fw-bold text-primary">WL Approval</label>
                    <div class="invalid-feedback">This field is required.</div>
                </div>

            </div>
            
            <!--end::Col-->
            <!--begin::Col-->
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" name="submit" class="btn btn-outline-primary"
              style="font-weight: 600; border-radius: 50px;width: 150px;">Submit</button>
          </div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>
  </div>
</form>
<?php $this->load->view ('_partials/footer.php'); ?>


<!-- <script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (() => {
    'use strict';

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
      form.addEventListener(
        'submit',
        (event) => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        },
        false,
      );
    });
  })();
</script>
<script>
  var URL_AJAX = '<?php echo site_url (); ?>/ajax';
  $(document).ready(function () {
    get_purchase_reason_purchase_reason();
  });

  function get_purchase_reason_purchase_reason(id) {
    $.post(URL_AJAX + "/get_purchase_reason_purchase_reason", { id }, function (o) {
      $('#purchase_reason').html(o);
    });
  }  
</script> -->