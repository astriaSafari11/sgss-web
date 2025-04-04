<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
  .select2-container--bootstrap-5 .select2-selection {
    width: 100%;
    min-height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-family: inherit;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15sease-in-out, box-shadow .15sease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    height: 58px;
  }

  .select2-container .select2-selection--single .select2-selection__rendered {
    display: block;
    /* padding-left: 8px;
      padding-right: 20px; */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-top: 18px;
  }
</style>
<form action="<?= site_url ('master_data/update_material'); ?>" method="post" class="needs-validation" novalidate>
  <input type="hidden" name="id" value="<?php echo $material->id; ?>">
  <div class="row mb-2">
    <div class="col-sm-6">
      <a href="<?= site_url ('master_data/material_list'); ?>" class="btn btn-sm btn-outline-primary position-relative"
        style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
        <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
        Back
      </a>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Update Material</li>
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
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="material Code" name="item_code"
                  value="<?php echo $material->item_code; ?>" disabled>
                <label for="floatingInput" class="fw-bold text-primary">Material Code</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="item_name"
                  value="<?php echo $material->item_name; ?>" required>
                <label for="floatingInput" class="fw-bold text-primary">Material Name</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="size"
                  value="<?php echo $material->size; ?>" required>
                <label for="floatingInput" class="fw-bold text-primary">Size</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" id="item_group" style="height: 56px;"
                  data-placeholder="Choose Item Group" name="item_group" required>
                  <?php foreach ($item_group as $row)
                  { ?>
                    <option value="<?php echo $row->id; ?>" <?php echo $material->item_category_id == $row->id ? 'selected' : ''; ?>><?php echo $row->item_category_name; ?></option>
                  <?php } ?>
                </select>
                <label for="uom" class="fw-bold text-primary">Item Category</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" id="size_uom" style="height: 56px;"
                  data-placeholder="Choose Size UoM" name="size_uom" required>
                  <option></option>
                  <?php foreach ($size_uom as $row)
                  { ?>
                    <option value="<?php echo $row->uom_code; ?>" <?php echo $material->size_uom == $row->uom_code ? 'selected' : ''; ?>><?php echo $row->uom_code; ?>
                      (<?php echo $row->uom_name; ?>)</option>
                  <?php } ?>
                </select>
                <label for="uom" class="fw-bold text-primary">Size UoM</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" id="uom" style="height: 56px;"
                  data-placeholder="Choose UoM" name="uom" required>
                  <option></option>
                  <?php foreach ($uom as $row)
                  { ?>
                    <option value="<?php echo $row->uom_code; ?>" <?php echo $material->uom == $row->uom_code ? 'selected' : ''; ?>><?php echo $row->uom_code; ?>
                      (<?php echo $row->uom_name; ?>)</option>
                  <?php } ?>
                </select>
                <label for="uom" class="fw-bold text-primary">UoM</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" id="factory" style="height: 56px;"
                  data-placeholder="Choose Factory" name="factory" required>
                  <option></option>
                  <?php foreach ($factory as $row)
                  { ?>
                    <option value="<?php echo $row->factory_name; ?>" <?php echo $material->factory == $row->factory_name ? 'selected' : ''; ?>><?php echo $row->factory_name; ?></option>
                  <?php } ?>
                </select>
                <label for="factory" class="fw-bold text-primary">Factory</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="lot_size"
                  value="<?php echo $material->lot_size; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Lot Size</label>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="order_cycle"
                  value="<?php echo $material->order_cycle; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Order Cycle</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="initial_stock"
                  value="<?php echo $material->initial_stock; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Initial Stock</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="lt_pr_po"
                  value="<?php echo $material->lt_pr_po; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Lead Time PR to PO</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="lt_pr_to_deliv"
                  value="<?php echo $material->lt_pr_to_deliv; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Lead Time PO to Deliv</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="text" class="form-control budgetTarget" id="floatingInput" name="budget_target"
                  value="<?php echo myNum ($budget->baseline_price); ?>" id="budgetTarget" value="0">
                <label for="floatingInput" class="fw-bold text-primary">Target Price Per Item</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" id="pic" style="height: 56px;"
                  data-placeholder="Choose PIC" name="pic" required>
                  <option></option>
                  <?php foreach ($user as $row)
                  { ?>
                    <option value="<?php echo $row->nip; ?>" <?php echo $material->pic == $row->nip ? 'selected' : ''; ?>>
                      <?php echo $row->nama; ?>
                    </option>
                  <?php } ?>
                </select>
                <label for="floatingInput" class="fw-bold text-primary">PIC</label>
              </div>
            </div>
          </div>
          <hr class="divider">
          <div class="row">
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="var_stock_card_overstock"
                  value="<?php echo ! empty ($settings->var_stock_card_overstock) ? $settings->var_stock_card_overstock : 0; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Overstock Threshold (%+SS)</label>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="var_stock_card_ok"
                  value="<?php echo ! empty ($settings->var_stock_card_ok) ? $settings->var_stock_card_ok : 0; ?>">
                <label for="floatingInput" class="fw-bold text-primary">OK Threshold (%+SS)</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="var_pending_approval"
                  value="<?php echo ! empty ($settings->var_pending_approval) ? $settings->var_pending_approval : 0; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Approval Threshold (days)</label>
              </div>
            </div>
            <!--begin::Col-->
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="min_threshold"
                  value="<?php echo ! empty ($settings->min_threshold) ? $settings->min_threshold : 0; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Approval Threshold (%)</label>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput"  name="var_todo_list" value="10">
                                <label for="floatingInput" class="fw-bold text-primary">To Do List Threshold</label>
                              </div>
                            </div> -->
            <!--begin::Col-->
            <!-- <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput"  name="var_stock_card_todo_list" value ="10">
                                <label for="floatingInput" class="fw-bold text-primary">SO To Do List Threshold</label>
                              </div>
                            </div> -->
            <!--end::Col-->
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="fast_moving_threshold"
                  value="<?php echo ! empty ($settings->fast_moving_threshold) ? $settings->fast_moving_threshold : 0; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Fast Moving Threshold (% + Forecast)</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="slow_moving_threshold"
                  value="<?php echo ! empty ($settings->slow_moving_threshold) ? $settings->slow_moving_threshold : 0; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Slow Moving Threshold (% + Forecast)</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="usage_ok_threshold"
                  value="<?php echo ! empty ($settings->usage_ok_threshold) ? $settings->usage_ok_threshold : 0; ?>">
                <label for="floatingInput" class="fw-bold text-primary">Usage OK Threshold (% + Forecast)</label>
              </div>
            </div>
            <!-- <div class="col-3">
              <div class="form-floating mb-3">
                <input type="text" class="form-control averageForecast" id="floatingInput" name="average_forecast"
                  value="0">
                <label for="floatingInput" class="fw-bold text-primary">Average Forecast</label>
              </div>
            </div> -->
            <!--begin::Col-->
            <!--end::Col-->
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="<?= site_url ('master_data/material_list'); ?>" class="btn btn-outline-danger"
              style="font-weight: 600; border-radius: 50px; white-space:nowrap;width:200px;">
              Cancel
            </a>
            <button type="submit" name="submit" class="btn btn-outline-primary"
              style="font-weight: 600; border-radius: 50px;width:200px;" id="submitMat">Update Material</button>
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
  var URL_AJAX = '<?php echo base_url (); ?>index.php/ajax';
  $(document).ready(function () {
    $(".averageForecast").on('keyup', function () {
      var val = this.value;
      val = val.replace(/[^0-9\.]/g, '');

      if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
      }

      this.value = val;
    });

    $(".budgetTarget").on('keyup', function () {
      var val = this.value;
      val = val.replace(/[^0-9\.]/g, '');

      if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
      }

      this.value = val;
    });

    $('#uom').select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    });

    $('#size_uom').select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    });

    $('#factory').select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    });

    $('#item_group').select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    });

    $('#pic').select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    });
  });

  function submit_material() {
    $("#submit_form").submit();

    event.preventDefault();
    $('#submitMat').attr('disabled', true);
    $('#submitMat').text('Processing...');
  }

  function get_uom(id) {
    $.post(URL_AJAX + "/get_uom", {
      id
    }, function (o) {
      $('#uom').html(o);
    });
  }

  function get_item_group(id) {
    $.post(URL_AJAX + "/get_item_group", {
      id
    }, function (o) {
      $('#item_group').html(o);
    });
  }

  function get_size_uom(id) {
    $.post(URL_AJAX + "/get_uom", {
      id
    }, function (o) {
      $('#size_uom').html(o);
    });
  }

  function get_factory(id) {
    $.post(URL_AJAX + "/get_factory", {
      id
    }, function (o) {
      $('#factory').html(o);
    });
  }
</script>