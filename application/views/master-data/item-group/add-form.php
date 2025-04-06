<?php $this->load->view ('_partials/head.php'); ?>
<form action="<?= site_url ('master_data/save_item_group'); ?>" method="post" class="needs-validation" novalidate>
  <div class="row mb-2">
    <div class="col-sm-6">
      <a href="<?= site_url ('master_data/item_group'); ?>" class="btn btn-sm btn-outline-primary position-relative"
        style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
        <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
        Back
      </a>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Item Group List</li>
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
                <input type="text" class="form-control" id="floatingInput" placeholder="ID" name="item_group_id"
                  value="auto filled" disabled required>
                <label for="floatingInput" class="fw-bold text-primary">Item Group ID</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="item_group_name" required>
                <label for="floatingInput" class="fw-bold text-primary">Item Group Name</label>
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
    get_item_group_item_group();
  });

  function get_item_group_item_group(id) {
    $.post(URL_AJAX + "/get_item_group_item_group", { id }, function (o) {
      $('#item_group').html(o);
    });
  }  
</script> -->