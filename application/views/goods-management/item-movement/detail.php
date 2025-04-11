<div class="row mb-2">
  <div class="col-sm-6">
    <a href="<?= site_url ('goods_management/item_movement'); ?>"
      class="btn btn-sm btn-outline-primary position-relative"
      style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
      <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
      Back
    </a>
  </div>
  <div class="col-sm-6">
  </div>
</div>
<!--begin::Row-->
<div class="row">
  <div class="col-md-12 col-sm-12 col-12">
    <div class="info-box text-bg-white">
      <div class="info-box-content" style="color: #001F82;">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="row mb-3">
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $material->item_code; ?>" />
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item Description</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3"
                  value="<?php echo $material->item_name; ?> - <?php echo $material->size; ?> <?php echo $material->uom; ?>" />
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lot Size</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $material->lot_size; ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lead Time PR to PO</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3"
                  value="<?php echo $material->lt_pr_po; ?> Days" />
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lead Time PO to
                  Deliver</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3"
                  value="<?php echo $material->lt_pr_to_deliv; ?> Days" />
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Total Lead Time</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3"
                  value="<?php echo $material->gen_lead_time; ?> Days" />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Order Cycle</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3"
                  value="<?php echo myNum ($material->order_cycle); ?> Days" />
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <button type="button" class="btn btn-primary"
                  style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Standart SS</button>
              </div>
              <div class="col-sm-2" style="margin:0px;">
                <input type="text" class="form-control" id="inputEmail3"
                  value="<?php echo myNum ($material->standard_safety_stock); ?>" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
<div class="row mb-2">
  <div class="col-3">
    <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
      MRP Table
    </a>
  </div>
  <div class="col-9">
    <form action="<?php echo site_url ('goods_management/stock_card_detail/' . _encrypt ($material->id)); ?>"
      method="post">
      <div class="d-flex justify-content-end align-items-center mb-2" style="white-space:nowrap;">
        <div id="searchContainer">
          <div class="d-flex align-items-center gap-2 search-row mb-1">
            <label for="start_week" class="small">Show Week From :</label>
            <select id=" start_week" class="form-select form-select-sm" name="start_week">
              <option value="all">-- Wk Number --</option>
              <?php for ($i = 0; $i < 52; $i++)
              { ?>
                <option value="<?php echo $i + 1; ?>" <?php echo $i == $past_week - 1 ? 'selected' : ''; ?>>
                  <?php echo $i + 1; ?>
                </option>
              <?php } ?>
            </select>

            <label for="to_week" class="small">To :</label>
            <select id="to_week" class="form-select form-select-sm" name="to_week">
              <option value="all">-- Wk Number --</option>
              <?php for ($i = 0; $i < 52; $i++)
              { ?>
                <option value="<?php echo $i + 1; ?>" <?php echo $i == $up_week - 1 ? 'selected' : ''; ?>>
                  <?php echo $i + 1; ?>
                </option>
              <?php } ?>
            </select>
            <button class="btn btn-outline-primary btn-sm" type="submit" name="search" style="width: 100px;">
              <i class="fas fa-search"></i>
              Search
            </button>
            <button class="btn btn-outline-primary btn-sm" type="submit" name="reset" style="width: 100px;">
              Reset
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row" style="margin:2px;">
  <div class="col-12">
    <div class="row table-responsive">
      <table class="table table-bordered">
        <thead style="text-align: center;">
          <tr>
            <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;width:250px;"
              rowspan="3">Period</th>
            <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;width:80px;"
              rowspan="3">Initial Value</th>
            <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;"
              colspan="<?php echo $past_week + $up_week; ?>"><?php echo date ('Y'); ?> Week</th>
          </tr>
          <tr>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <th style="color: #fff;background-color:#001F82;text-align: center;<?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $i; ?>
              </th>
            <?php } ?>
          </tr>
          <tr>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <th style="text-align: center;white-space:nowrap;">
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                  data-bs-target="#modal-edit-value-<?php echo $i; ?>">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                  </b>
              </th>
            <?php } ?>
          </tr>
        </thead>
        <tbody style="white-space:nowrap;vertical-align:center;">
          <tr>
            <td>Gross Requirements</td>
            <td></td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->gross_requirement == 0 ? '-' : myNum ($item_movement[$i - 1]->gross_requirement); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Actual Usage</td>
            <td></td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->usage == 0 ? '-' : myNum ($item_movement[$i - 1]->usage); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Schedule Receipts</td>
            <td></td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->schedules_receipts == 0 ? '-' : myNum ($item_movement[$i - 1]->schedules_receipts); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Stock on Hand</td>
            <td style="text-align: center; <?php if ($i == $current_week)
            {
            echo 'background-color:#DAEAFF;color: #001F82;';
            } ?>"><?php echo myNum ($material->initial_stock); ?></td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->stock_on_hand == 0 ? '-' : myNum ($item_movement[$i - 1]->stock_on_hand); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Current Safety Stock</td>
            <td style="text-align: center; <?php if ($i == $current_week)
            {
            echo 'background-color:#DAEAFF;color: #001F82;';
            } ?>">
              <?php echo myNum (min ($material->initial_stock, $material->standard_safety_stock)); ?>
            </td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->current_safety_stock == 0 ? '-' : myNum ($item_movement[$i - 1]->current_safety_stock); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Net On Hand</td>
            <td style="text-align: center; <?php if ($i == $current_week)
            {
            echo 'background-color:#DAEAFF;color: #001F82;';
            } ?>">
              <?php echo myNum ($material->initial_stock - $material->standard_safety_stock); ?>
            </td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->net_on_hand == 0 ? '-' : myNum ($item_movement[$i - 1]->net_on_hand); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Net Requirement</td>
            <td></td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->net_requirement == 0 ? '-' : myNum ($item_movement[$i - 1]->net_requirement); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Planned Order Receipts</td>
            <td></td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->planned_order_receipt == 0 ? '-' : myNum ($item_movement[$i - 1]->planned_order_receipt); ?>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td>Planned Order Release</td>
            <td></td>
            <?php for ($i = $past_week; $i <= $up_week; $i++)
            { ?>
              <td style="text-align: center; <?php if ($i == $current_week)
              {
              echo 'background-color:#DAEAFF;color: #001F82;';
              } ?>">
                <?php echo $item_movement[$i - 1]->planned_order_release == 0 ? '-' : myNum ($item_movement[$i - 1]->planned_order_release); ?>
              </td>
            <?php } ?>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php for ($i = $past_week; $i <= $up_week; $i++)
    { ?>
  <form action="<?php echo site_url ('goods_management/update_item_movement'); ?>" method="post">
    <div class="modal fade" id="modal-edit-value-<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <input type="hidden" name="material_movement_id" value="<?php echo $item_movement[$i - 1]->id; ?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
              Week <?php echo $i; ?> - <?php echo date ('Y'); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <!--begin::Col-->
                  <div class="col-6">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" name="gross_requirement"
                        value="<?php echo $item_movement[$i - 1]->gross_requirement; ?>" <?php echo $gross_req[$i - 1]->type == 'formula' ? 'disabled' : ''; ?>>
                      <label for="floatingInput" class="fw-bold text-primary">Gross Requirements</label>
                    </div>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="col-6">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" name="stock_on_hand" value="">
                      <label for="floatingInput" class="fw-bold text-primary">Stock On Hand</label>
                    </div>
                  </div>
                  <!--end::Col-->
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" class="btn btn-outline-primary">Update Data</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php } ?>
