<?php $this->load->view ('_partials/head.php'); ?>
<form action="<?= site_url ('master_data/save_vendor'); ?>" method="post" class="needs-validation" novalidate>
  <div class="row mb-2">
    <div class="col-sm-6">
      <a href="<?= site_url ('master_data/vendor_list'); ?>" class="btn btn-sm btn-outline-primary position-relative"
        style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
        <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
        Back
      </a>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Vendor List</li>
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
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Vendor Code" name="vendor_code"
                  value="auto filled" disabled required>
                <label for="floatingInput" class="fw-bold text-primary">Vendor Code</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="vendor_name" required>
                <label for="floatingInput" class="fw-bold text-primary">Vendor Name</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="vendor_location" required>
                <label for="floatingInput" class="fw-bold text-primary">Vendor Location</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="est_lead_time">
                <label for="floatingInput" class="fw-bold text-primary">Lead Time</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Select Channel" id="vendor_channel" style="height: 56px;"
                  name="vendor_channel" required>
                  <option value=""> -- Select Channel --</option>
                  <option value="COUPA">COUPA</option>
                  <option value="3P">3P</option>
                  <option value="Online">Online</option>
                </select>
                <label for="floatingInput" for="vendor_channel" class="fw-bold text-primary">Vendor Channel</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="additional_margin" value="0">
                <label for="floatingInput" class="fw-bold text-primary">Additional Margin (%)</label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Select Validity" id="validity" style="height: 56px;"
                  name="validity" required>
                  <option value=""> -- Select Validity --</option>
                  <option value="VALID">VALID</option>
                  <option value="INVALID">INVALID</option>
                </select>
                <label for="floatingInput" for="category" class="fw-bold text-primary">Validity</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Select Category" id="category" style="height: 56px;"
                  name="category" required>
                  <option value=""> -- Select Category --</option>
                </select>
                <label for="floatingInput" for="category" class="fw-bold text-primary">Category</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--begin::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="rating" id="rating" style="height: 56px;" name="rating">
                  <option value="">-- Select Rating --</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label for="floatingInput" for="rating" class="fw-bold text-primary">Rating</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--begin::Col-->
            <!--end::Col-->
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
<script>
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
    get_vendor_category();
  });

  function get_vendor_category(id) {
    $.post(URL_AJAX + "/get_vendor_category", { id }, function (o) {
      $('#category').html(o);
    });
  }  
</script>