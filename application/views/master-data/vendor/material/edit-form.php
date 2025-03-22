<div class="row mb-2">
  <div class="col-sm-6">
    <?php $this->load->view ('master-data/vendor/material/_headers_part.php'); ?>
  </div>
  <div class="col-sm-6">
  </div>
</div>
<div class="row mb-2">
  <div class="col-sm-6">
    <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
      General Material Information
    </a>
  </div>
  <div class="col-sm-6">
    <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
      Price Adjusment
    </a>
  </div>
</div>
<!--begin::Row-->
<div class="row">
  <div class="col-6 mb-4">
    <!-- Default box -->
    <div class="card">
      <form action="<?= site_url ('master_data/update_vendor_material'); ?>" method="post" class="needs-validation"
        novalidate>
        <input type="hidden" name="id" value="<?php echo $vendor->id; ?>">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <!--begin::Col-->
                <div class="col-3">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo $vendor->vendor_code; ?>" disabled>
                    <label for="floatingInput" class="fw-bold text-primary">Vendor Code</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-9">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo $vendor->vendor_name; ?>" disabled>
                    <label for="floatingInput" class="fw-bold text-primary">Vendor Name</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-3">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $vendor->item_code; ?>"
                      disabled>
                    <label for="floatingInput" class="fw-bold text-primary">Item Code</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-9">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $vendor->item_name; ?>"
                      disabled>
                    <label for="floatingInput" class="fw-bold text-primary">Item Name</label>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control pricePerUom" id="floatingInput" name="lt_po_deliv"
                      id="lt_po_deliv" value="<?php echo $material->lead_time; ?>">
                    <label for="floatingInput" class="fw-bold text-primary">Lead Time</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-3">
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" name="moq"
                      value="<?php echo $material->moq; ?>">
                    <label for="floatingInput" class="fw-bold text-primary">MOQ</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-3">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control pricePerUom" id="floatingInput" name="price_per_uom"
                      id="price_per_uom" value="<?php echo myNum ($material->price_per_uom); ?>">
                    <label for="floatingInput" class="fw-bold text-primary">Price Per UoM</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-3">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control priceEqualUom" id="floatingInput" name="price_equal_moq"
                      value="<?php echo myNum ($material->price_equal_moq); ?>">
                    <label for="floatingInput" class="fw-bold text-primary">Price Equal UoM</label>
                  </div>
                </div>
                <!--end::Col-->
                <!-- <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput"  name="lt_pr_po" value ="<?php echo $material->lt_pr_po; ?>">
                                <label for="floatingInput" class="fw-bold text-primary">Est. Lead Time (PO)</label>
                              </div>
                            </div>                           -->
                <div class="col-3">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="place_to_buy"
                      value="<?php echo $material->place_to_buy; ?>">
                    <label for="floatingInput" class="fw-bold text-primary">Place To Buy</label>
                  </div>
                </div>
                <div class="col-9">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="link"
                      value="<?php echo $material->link; ?>">
                    <label for="floatingInput" class="fw-bold text-primary">Link</label>
                  </div>
                </div>
                <!--end::Col-->
              </div>
              <hr class="divider">
              <div class="row">
                <!--begin::Col-->
                <div class="col-4">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo myNum ($material->lt_po_deliv); ?>" disabled>
                    <label for="floatingInput" class="fw-bold text-primary">Total Lead Time</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-4">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo myNum ($material->moq * $material->price_per_uom); ?>" disabled>
                    <label for="floatingInput" class="fw-bold text-primary">Total Price</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-4">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo $material->moq != 0 ? myDecimal ($material->price_equal_moq / ($material->moq * $material->price_per_uom)) : 0; ?> %"
                      disabled>
                    <label for="floatingInput" class="fw-bold text-primary">Savings Accumulated</label>
                  </div>
                </div>
                <!--end::Col-->
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" name="submit" class="btn btn-outline-primary"
              style="font-weight: 600; border-radius: 50px;width: 150px;">Update</button>
          </div>
        </div>
    </div>
    </form>
    <!-- /.card -->
  </div>
  <div class="col-6 mb-4">
    <div class="row">
      <!--begin::Col-->
      <div class="col-4">
        <div class="form-floating mb-3">
          <input type="number" class="form-control" id="minimum_order" value="0" name="minimum_order">
          <label for="minimum_order" class="fw-bold text-primary">Minimum Order</label>
        </div>
      </div>
      <!--end::Col-->
      <!--begin::Col-->
      <div class="col-5">
        <div class="form-floating mb-3">
          <input type="number" class="form-control" id="price" value="0" name="price">
          <label for="price" class="fw-bold text-primary">Price</label>
        </div>
      </div>
      <div class="col-3">
        <button type="submit" name="submit" class="btn btn-outline-primary"
          style="font-weight: 600; width: 100%;height: 75%;" onclick="submit_price();" id="submitPrice">ADD</button>
      </div>
    </div>
    <table id="table-price" class="table table-striped table-bordered" width="100%" style="margin-top: 5px;">
      <thead style="text-align: center;white-space:nowrap;">
        <tr>
          <th style="color: #fff;background-color:#001F82;text-align: left;">Minimum Order</th>
          <th style="color: #fff;background-color:#001F82;text-align: ;">Price per UoM</th>
          <th style="color: #fff;background-color:#001F82;text-align: ;">Savings</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;"></th>
        </tr>
      </thead>
      <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">
      </tbody>
    </table>
    </form>
    <!-- /.card -->
  </div>
</div>
</div>
<script>
  var URL_AJAX = '<?php echo site_url (); ?>/ajax';
  $(document).ready(function () {
    $('#table-price').DataTable({
      scrollX: true,
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax": {
        "url": "<?= site_url ('master_data/get_material_price?id=' . _encrypt ($material->id)); ?>",
        "type": "POST"
      },
      "order": [],
      "columnDefs": [{
        targets: [1],
        createdCell: function (cell) {
          $(cell).css('text-align', 'right');
          $(cell).css('vertical-align', 'middle');
          $(cell).css('white-space', 'nowrap');
        }
      },
      {
        targets: [0],
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
    $(".pricePerUom").on('keyup', function () {
      var val = this.value;
      val = val.replace(/[^0-9\.]/g, '');

      if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
      }

      this.value = val;
    });

    $(".priceEqualUom").on('keyup', function () {
      var val = this.value;
      val = val.replace(/[^0-9\.]/g, '');

      if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
      }

      this.value = val;
    });
  });

  function submit_price() {
    $('#submitPrice').attr('disabled', true);
    $('#submitPrice').text('Adding...');


    var values = {
      "moq": '<?php echo $material->moq; ?>',
      "price_per_uom": '<?php echo $material->price_per_uom; ?>',
      "vendor_material_id": '<?php echo $material->id; ?>',
      "minimum_order": $('#minimum_order').val(),
      "price": $('#price').val(),
    };

    $.ajax({
      url: URL_AJAX + "/add_vendor_material_price",
      type: "post",
      data: values,
      success: function (response) {
        if (response == 1) {
          $('#table-price').DataTable().ajax.reload();
          $('#submitPrice').removeAttr('disabled');
          $('#submitPrice').text('ADD');
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  }

  function remove_price(id) {
    var values = {
      "id": id,
    };

    $.ajax({
      url: URL_AJAX + "/remove_vendor_material_price",
      type: "post",
      data: values,
      success: function (response) {
        if (response == 1) {
          $('#table-price').DataTable().ajax.reload();
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  }   
</script>
<!-- <script>
var myinput = document.getElementById('price_per_uom');

myinput.addEventListener('keyup', function() {
  var val = this.value;
  val = val.replace(/[^0-9\.]/g,'');
  
  if(val != "") {
    valArr = val.split('.');
    valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
    val = valArr.join('.');
  }
  
  this.value = val;
});

</script> -->