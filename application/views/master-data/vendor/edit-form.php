<form action="<?= site_url ('master_data/update_vendor'); ?>" method="post" class="needs-validation" novalidate>
  <input type="hidden" name="id" value="<?php echo $vendor->id; ?>">
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
        <li class="breadcrumb-item active" aria-current="page">Edit Vendor</li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $vendor->vendor_name; ?></li>
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
                  value="<?php echo $vendor->vendor_code; ?>" required readonly>
                <label for="floatingInput" class="fw-bold text-primary">Vendor Code</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                  name="vendor_name" value="<?php echo $vendor->vendor_name; ?>" required>
                <label for="floatingInput" class="fw-bold text-primary">Vendor Name</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="vendor_location"
                  value="<?php echo $vendor->vendor_location; ?>" required>
                <label for="floatingInput" class="fw-bold text-primary">Vendor Location</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="number" min="0" class="form-control" id="floatingInput" placeholder="name@example.com"
                  name="est_lead_time" value="<?php echo $vendor->est_lead_time; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Lead Time PO to Deliver</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Select Channel" id="vendor_channel" style="height: 56px;"
                  name="vendor_channel" required>
                  <option value=""> -- Select Channel --</option>
                  <option value="COUPA" <?php echo $vendor->vendor_channel == 'COUPA' ? 'selected' : ''; ?>>COUPA</option>
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
                  value="<?php echo $vendor->additional_margin; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Additional Margin (%)</label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Select Validity" id="validity" style="height: 56px;"
                  name="validity" required>
                  <option value=""> -- Select Validity --</option>
                  <option value="VALID" <?php echo $vendor->validity == 'VALID' ? 'selected' : ''; ?>>VALID</option>
                  <option value="INVALID" <?php echo $vendor->validity == 'INVALID' ? 'selected' : ''; ?>>INVALID</option>
                </select>
                <label for="floatingInput" for="category" class="fw-bold text-primary">Validity</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Select Category" id="category" style="height: 56px;"
                  name="category" required>
                  <option value="">-- Select Category --</option>
                </select>
                <label for="floatingInput" for="category" class="fw-bold text-primary">Validity</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--begin::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" style="height: 56px;" name="rating"
                  id="rating">
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
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" name="submit" class="btn btn-outline-primary"
              style="font-weight: 600; border-radius: 50px;width: 150px;">Update</button>
          </div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>
  </div>
</form>
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
    get_vendor_category('<?php if (isset ($vendor->category))
    {
    echo $vendor->category;
    } ?>');
  });

  function get_vendor_category(id) {
    $.post(URL_AJAX + "/get_vendor_category", { id }, function (o) {
      $('#category').html(o);
    });
  }  
</script>