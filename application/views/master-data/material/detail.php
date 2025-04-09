<div class="row mb-2">
  <div class="col-sm-6">
    <a href="<?= site_url ('master_data/material_list'); ?>" class="btn btn-sm btn-outline-primary position-relative"
      style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
      <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
      Back
    </a>
  </div>
  <div class="col-sm-6">
    <div class="d-flex justify-content-end">
      <a href="<?= site_url ('master_data/edit_material/' . _encrypt ($material->id)); ?>"
        class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:5px;">
        <i class="fa-solid fa-pen-to-square"></i>
        Edit
      </a>
      <button type="button" class="btn btn-sm btn-outline-danger"
        style="font-weight: 600; border-radius: 50px;width: 150px;margin-right:5px;" data-bs-toggle="modal"
        data-bs-target="#modal-delete">
        <i class="fa-solid fa-trash"></i>
        Delete
      </button>
      <a href="<?= site_url ('goods_management/stock_card_detail/' . _encrypt ($material->id)); ?>"
        class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:5px;">
        <i class="fa-solid fa-boxes-stacked"></i>
        Stock Card
      </a>
      <a href="<?= site_url ('master_data/edit_material/' . _encrypt ($material->id)); ?>"
        class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:5px;">
        <i class="fa-solid fa-database"></i>
        History Log
      </a>
    </div>
  </div>
</div>
<div class="row mb-2">
  <div class="col-sm-3">
    <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
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
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="item_group"
                value="<?php echo $material->item_group; ?>" required disabled>
              <label for="floatingInput" class="fw-bold text-primary">Item Group</label>
              <div class="invalid-feedback">This field is required.</div>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="material Code" name="item_code"
                value="<?php echo $material->item_code; ?>" required disabled>
              <label for="floatingInput" class="fw-bold text-primary">Material Code</label>
              <div class="invalid-feedback">This field is required.</div>
            </div>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="item_name"
                value="<?php echo $material->item_name; ?>" required disabled>
              <label for="floatingInput" class="fw-bold text-primary">Material Name</label>
              <div class="invalid-feedback">This field is required.</div>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="size"
                value="<?php echo $material->size; ?>" required disabled>
              <label for="floatingInput" class="fw-bold text-primary">Size</label>
              <div class="invalid-feedback">This field is required.</div>
            </div>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="size_uom"
                value="<?php echo $material->size_uom; ?>" disabled>
              <label for="uom" class="fw-bold text-primary">Size UoM</label>
              <div class="invalid-feedback">This field is required.</div>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="uom"
                value="<?php echo $material->uom; ?>" disabled>
              <label for="uom" class="fw-bold text-primary">Item UoM</label>
              <div class="invalid-feedback">This field is required.</div>
            </div>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="gen_lead_time"
                value="<?php echo $material->factory; ?>" disabled>
              <label for="uom" class="fw-bold text-primary">Factory</label>
            </div>
          </div>
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="lot_size"
                value="<?php echo $material->lot_size; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Lot Size</label>
            </div>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="order_cycle"
                value="<?php echo $material->order_cycle; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Order Cycle</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="initial_stock"
                value="<?php echo $material->initial_stock; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Initial Stock</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="lt_pr_po"
                value="<?php echo $material->lt_pr_po; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Lead Time PR to PO</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="lt_pr_to_deliv"
                value="<?php echo $material->lt_pr_to_deliv; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Lead Time PO to Deliv</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="gen_lead_time"
                value="<?php echo $material->gen_lead_time; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Total Lead Time</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="gen_lead_time"
                value="<?php echo myNum ($material->standard_safety_stock); ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Standart Safety Stock</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="target_inventory"
                value="<?php echo myNum ($material->target_inventory); ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Target Inventory</label>
            </div>
          </div>
          <!-- <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="average_forecast"
                value="<?php echo myNum ($material->average_forecast); ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Average Forecast</label>
            </div>
          </div> -->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="pic"
                value="<?php echo $material->pic_name; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">PIC</label>
            </div>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <!--end::Col-->
        </div>
        <hr class="divider">
        <div class="row">
          <!--begin::Col-->
          <!-- <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="var_todo_list"
                value="<?php echo ! empty ($settings->var_todo_list) ? $settings->var_todo_list : 0; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">To Do List Threshold</label>
            </div>
          </div> -->
          <!--end::Col-->
          <!--begin::Col-->
          <!-- <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="var_stock_card_todo_list"
                value="<?php echo ! empty ($settings->var_stock_card_todo_list) ? $settings->var_stock_card_todo_list : 0; ?>"
                disabled>
              <label for="floatingInput" class="fw-bold text-primary">SO To Do List Threshold</label>
            </div>
          </div> -->
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="var_stock_card_overstock"
                value="<?php echo ! empty ($settings->var_stock_card_overstock) ? $settings->var_stock_card_overstock : 0; ?>"
                disabled>
              <label for="floatingInput" class="fw-bold text-primary">Overstock Threshold (%+SS)</label>
            </div>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="var_stock_card_ok"
                value="<?php echo ! empty ($settings->var_stock_card_ok) ? $settings->var_stock_card_ok : 0; ?>"
                disabled>
              <label for="floatingInput" class="fw-bold text-primary">OK Threshold (%+SS)</label>
            </div>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="var_pending_approval"
                value="<?php echo ! empty ($settings->var_pending_approval) ? $settings->var_pending_approval : 0; ?>"
                disabled>
              <label for="floatingInput" class="fw-bold text-primary">Approval Threshold (days)</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="min_threshold"
                value="<?php echo ! empty ($settings->min_threshold) ? $settings->min_threshold : 0; ?>" disabled>
              <label for="floatingInput" class="fw-bold text-primary">Approval Threshold (%)</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="fast_moving_threshold"
                value="<?php echo ! empty ($settings->fast_moving_threshold) ? $settings->fast_moving_threshold : 0; ?>"
                disabled>
              <label for="floatingInput" class="fw-bold text-primary">Fast Moving Threshold (% + Forecast)</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="slow_moving_threshold"
                value="<?php echo ! empty ($settings->slow_moving_threshold) ? $settings->slow_moving_threshold : 0; ?>"
                disabled>
              <label for="floatingInput" class="fw-bold text-primary">Slow Moving Threshold (% + Forecast)</label>
            </div>
          </div>
          <div class="col-3">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="usage_ok_threshold"
                value="<?php echo ! empty ($settings->usage_ok_threshold) ? $settings->usage_ok_threshold : 0; ?>"
                disabled>
              <label for="floatingInput" class="fw-bold text-primary">Usage OK Threshold (% + Forecast)</label>
            </div>
          </div>
          <!--end::Col-->
        </div>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </div>
</div>
<div class="row mb-2">
  <div class="col-sm-6">
    <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
      Baseline Price
    </a>
  </div>
  <div class="col-sm-3">
    <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
      Gross Requirement Formula
    </a>
  </div>
</div>
<!--begin::Row-->
<div class="row">
  <div class="col-6 mb-4">
    <table id="table-budget" class="table table-striped table-bordered" width="100%" style="margin-top: 5px;">
      <thead style="text-align: center;white-space:nowrap;">
        <tr>
          <th style="color: #fff;background-color:#001F82;text-align: left;">Baseline Category</th>
          <th style="color: #fff;background-color:#001F82;text-align: ;">Baseline Price</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;"></th>
        </tr>
      </thead>
      <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">
        <?php foreach ($baseline_budget as $k => $v)
        { ?>
          <tr>
            <td style="vertical-align: middle;text-align: left;"><?php echo $v->baseline_category; ?></td>
            <td style="vertical-align: middle;text-align: right;">
              <?php echo ! empty ($v->baseline_price) ? myNum ($v->baseline_price) : 0; ?>
              <i class="fa-solid fa-circle-question" style="color: #001F82;" data-bs-toggle="tooltip"
                data-bs-title="<?php echo baseline_category_desc ($v->baseline_category); ?>"></i>
            </td>
            <td style="vertical-align: middle;text-align: center;">
              <?php echo $v->is_default == 1 ? '<i class="fa-solid fa-star-of-life" data-bs-toggle="tooltip" data-bs-title="Default Price"></i>' : '
              <a href="' . site_url ('master_data/set_default_price?id=' . $v->id . '&item_id=' . $material->id) . '" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-title="Set as default">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>'; ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="row">
      <div class="col-6 mb-2">
        <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
          Annual Budget
        </a>
      </div>
      <div class="col-6 mb-2 d-flex justify-content-end">
        <button type="button" class="btn btn-sm btn-outline-primary" style="font-weight: 600;" data-bs-toggle="modal"
          data-bs-target="#modal-add-annual-budget">
          <i class="fa-solid fa-add"></i>
          Add Annual Budget
        </button>
      </div>
    </div>
    <table id="table-budget" class="table table-striped table-bordered" width="100%">
      <thead style="text-align: center;white-space:nowrap;">
        <tr>
          <th style="color: #fff;background-color:#001F82;text-align: left;">Year</th>
          <th style="color: #fff;background-color:#001F82;text-align: ;">Annual Budget</th>
          <th style="color: #fff;background-color:#001F82;text-align: ;">Annual Usage</th>
          <th style="color: #fff;background-color:#001F82;text-align: center;"></th>
        </tr>
      </thead>
      <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">
        <?php foreach ($annual_budget as $k => $v)
        { ?>
          <tr>
            <td style="vertical-align: middle;text-align: left;"><?php echo $v->year; ?></td>
            <td style="vertical-align: middle;text-align: right;"><?php echo myNum ($v->annual_budget); ?></td>
            <td style="vertical-align: middle;text-align: center;"><?php echo myNum ($v->annual_usage); ?>
              <?php echo $material->uom; ?>
            </td>
            <td style="vertical-align: middle;text-align: center;" data-bs-toggle="tooltip"
              data-bs-title="Edit Annual Budget Value">
              <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#modal-edit-annual-budget-<?php echo $v->id; ?>">
                <i class="fa-solid fa-pen-to-square"></i> Edit
              </button>
            </td>
          </tr>
          <form action="<?php echo site_url ('master_data/edit_annual_budget'); ?>" method="post"
            enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="hidden" name="id" value="<?php echo $v->id; ?>">
            <input type="hidden" name="item_id" value="<?php echo $material->id; ?>">
            <div class="modal fade" id="modal-edit-annual-budget-<?php echo $v->id; ?>" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                      style="color: #001F82;font-weight:600;">Edit Annual Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <!--begin::Col-->
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="text" min="1" class="form-control" id="floatingInput" name="year" id="year"
                          value="<?php echo $v->year; ?>" readonly>
                        <label for="floatingInput" class="fw-bold text-primary">Year</label>
                        <div class="invalid-feedback">This field is required.</div>
                      </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="text" min="1" class="form-control annualBudget" id="floatingInput"
                          name="annual_budget" id="annualBudget" value="<?php echo myNum ($v->annual_budget); ?>"
                          required>
                        <label for="floatingInput" class="fw-bold text-primary">Annual Budget (Price)</label>
                        <div class="invalid-feedback">This field is required.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="number" min="1" class="form-control" id="floatingInput" name="annual_usage"
                          value="<?php echo $v->annual_usage; ?>" required>
                        <label for="floatingInput" class="fw-bold text-primary">Annual Usage (UoM)</label>
                        <div class="invalid-feedback">This field is required.</div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">No, Cancel.</button>
                    <button name="submit" type="submit" class="btn btn-outline-primary">Yes, Update Data.</button>
                  </div>
                </div>
              </div>
            </div>
    </div>
    </form>
  <?php } ?>
  </tbody>
  </table>

  <div class="row">
    <div class="col-6 mb-2">
      <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
        Average Forecast
      </a>
    </div>
    <div class="col-6 mb-2 d-flex justify-content-end">
      <button type="button" class="btn btn-sm btn-outline-primary" style="font-weight: 600;" data-bs-toggle="modal"
        data-bs-target="#modal-update-average-forecast">
        <i class="fa-solid fa-add"></i>
        Update Average Forecast
      </button>
    </div>
  </div>
  <table id="table-budget" class="table table-striped table-bordered" width="100%">
    <thead style="text-align: center;white-space:nowrap;">
      <tr>
        <th style="color: #fff;background-color:#001F82;text-align: left;">Baseline</th>
        <th style="color: #fff;background-color:#001F82;text-align: ;">Description</th>
        <th style="color: #fff;background-color:#001F82;text-align: center;"></th>
      </tr>
    </thead>
    <tbody style="text-align: center;vertical-align:center;">
      <?php foreach ($average_forecast as $k => $v)
      { ?>
        <tr>
          <td style="vertical-align: middle;text-align: left;"><?php echo $v->baseline; ?></td>
          <td style="vertical-align: middle;text-align: left;">
            <?php if ($v->baseline == 'Default')
            { ?>
              <span style="font-size: 12px;font-style: italic;">By default, the average forecast calculation will be taken
                from the <b><?php echo $v->start_week; ?></b> weeks
                prior to the
                current week.</span>
            <?php } ?>
            <?php if ($v->baseline == 'YTD')
            { ?>
              <span style="font-size: 12px;font-style: italic;">YTD Forecast is a calculation taken over the current year,
                from the first week
                up to the current week.</span>
            <?php } ?>
            <?php if ($v->baseline == 'Start-To')
            { ?>
              <span style="font-size: 12px;font-style: italic;">Start-To Forecast is a custom calculation, with adjustable
                start and end weeks for average value calculation. The current average is calculated from weeks
                <b><?php echo $v->start_week; ?></b> to
                <b><?php echo $v->to_week; ?></b>.</span>
            <?php } ?>
          </td>
          <td style="vertical-align: middle;text-align: center;">
            <?php echo $v->is_default == 1 ? '<i class="fa-solid fa-star-of-life" data-bs-toggle="tooltip" data-bs-title="The formula used to calculate the average forecast."></i>' : '
            <a href="' . site_url ('master_data/set_default_avg_forecast?id=' . $v->id . '&item_id=' . $material->id) . '" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-title="Set as default">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>'; ?>
          </td>
        </tr>
        <form action="<?php echo site_url ('master_data/edit_annual_budget'); ?>" method="post"
          enctype="multipart/form-data" class="needs-validation" novalidate>
          <input type="hidden" name="id" value="<?php echo $v->id; ?>">
          <input type="hidden" name="item_id" value="<?php echo $material->id; ?>">
          <div class="modal fade" id="modal-edit-annual-budget-<?php echo $v->id; ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                    style="color: #001F82;font-weight:600;">Edit Annual Budget</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!--begin::Col-->
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" min="1" class="form-control" id="floatingInput" name="year" id="year"
                        value="<?php echo $v->year; ?>" readonly>
                      <label for="floatingInput" class="fw-bold text-primary">Year</label>
                      <div class="invalid-feedback">This field is required.</div>
                    </div>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" min="1" class="form-control annualBudget" id="floatingInput" name="annual_budget"
                        id="annualBudget" value="<?php echo myNum ($v->annual_budget); ?>" required>
                      <label for="floatingInput" class="fw-bold text-primary">Annual Budget (Price)</label>
                      <div class="invalid-feedback">This field is required.</div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="number" min="1" class="form-control" id="floatingInput" name="annual_usage"
                        value="<?php echo $v->annual_usage; ?>" required>
                      <label for="floatingInput" class="fw-bold text-primary">Annual Usage (UoM)</label>
                      <div class="invalid-feedback">This field is required.</div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">No, Cancel.</button>
                  <button name="submit" type="submit" class="btn btn-outline-primary">Yes, Update Data.</button>
                </div>
              </div>
            </div>
          </div>
  </div>
  </form>
<?php } ?>
</tbody>
</table>
</div>
<div class="col-6 mb-4">
  <table id="table-item" class="table table-bordered" width="100%">
    <thead style="text-align: center;white-space:nowrap;">
      <tr>
        <th style="color: #fff;background-color:#001F82;text-align: center;">Year</th>
        <th style="color: #fff;background-color:#001F82;text-align: center;">Week</th>
        <th style="color: #fff;background-color:#001F82;text-align: center;">Type</th>
        <th style="color: #fff;background-color:#001F82;text-align: center;">AVG Week Start</th>
        <th style="color: #fff;background-color:#001F82;text-align: center;">AVG Week End</th>
        <th style="color: #fff;background-color:#001F82;text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">
    </tbody>
  </table>
</div>
</div>
</div>
<form action="<?= site_url ('master_data/add_annual_budget'); ?>" method="post" class="needs-validation" novalidate>
  <input type="hidden" name="item_id" value="<?php echo $material->id; ?>">
  <div class="modal fade" id="modal-add-annual-budget" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
            Add Annual Budget</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!--begin::Col-->
            <div class="col-12">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" id="uom" style="height: 56px;"
                  name="year" required>
                  <option value="" disabled>-- Select Year --</option>
                  <?php for ($i = date ('Y'); $i <= date ('Y') + 5; $i++)
                  {
                  echo '<option value="' . $i . '">' . $i . '</option>';
                  } ?>
                </select>
                <label for="floatingInput" class="fw-bold text-primary">Year</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-12">
              <div class="form-floating mb-3">
                <input type="text" min="1" class="form-control annualBudget" id="floatingInput" name="annual_budget"
                  id="annualBudget" required>
                <label for="floatingInput" class="fw-bold text-primary">Annual Budget (Price)</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-floating mb-3">
                <input type="number" min="1" class="form-control" id="floatingInput" name="annual_usage" required>
                <label for="floatingInput" class="fw-bold text-primary">Annual Usage (UoM)</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">No, Cancel.</button>
          <button type="submit" name="submit" class="btn btn-outline-primary">Yes, Submit Data.</button>
        </div>
      </div>
    </div>
  </div>
</form>
<form action="<?= site_url ('master_data/update_average_forecast'); ?>" method="post" class="needs-validation"
  novalidate>
  <input type="hidden" name="item_id" value="<?php echo $material->id; ?>">
  <div class="modal fade" id="modal-update-average-forecast" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
            Update Average Forecast</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="number" min="1" max="52" class="form-control" id="floatingInput" name="week">
                <label for="floatingInput" class="fw-bold text-primary">Default Week</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="number" min="1" max="52" class="form-control" id="floatingInput" name="start_week">
                <label for="floatingInput" class="fw-bold text-primary">Start (Week)</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-3">
                <input type="number" min="1" max="52" class="form-control" id="floatingInput" name="to_week">
                <label for="floatingInput" class="fw-bold text-primary">To (Week)</label>
                <div class="invalid-feedback">This field is required.</div>
              </div>
            </div>
          </div>
          <ul>
            <li>
              <span style="font-size: 14px;font-style: italic;">Modify the <b>Default Week</b> to alter the default
                formula’s
                standard number of weeks leading up to the current week.
              </span><br>
            </li>
            <li>
              <span style="font-size: 14px;font-style: italic;">Modify the <b>Start Week</b> and <b>To Week</b> to
                adjust
                the start and end
                calculation weeks within the Start-To formula.
              </span>
            </li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">No, Cancel.</button>
          <button type="submit" name="submit" class="btn btn-outline-primary">Yes, Submit Data.</button>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
          Delete Material</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: left;">
        <p>You are going to delete material <?php echo $material->item_code; ?> - <?php echo $material->item_name; ?>,
          all
          data related with this material will be deleted. Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel Delete.</button>
        <a href="<?php echo site_url ('master_data/delete_material?id=' . _encrypt ($material->id)); ?>" type="button"
          class="btn btn-outline-danger">Yes, Delete Data.</a>
      </div>
    </div>
  </div>
</div>
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
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl),
  );

  $(document).ready(function () {
    $(".annualBudget").on('keyup', function () {
      var val = this.value;
      val = val.replace(/[^0-9\.]/g, '');

      if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
      }

      this.value = val;
    });

    $('#table-item').DataTable({
      scrollX: true,
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax": {
        "url": "<?= site_url ('master_data/get_gross_req?id=' . _encrypt ($material->id)); ?>",
        "type": "POST"
      },
      dom: "t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "columnDefs": [
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
      "vendor_code": <?php echo $vendor->vendor_code; ?>
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
    $.post(URL_AJAX + "/get_material", { id }, function (o) {
      $('#materialOptions').html(o);
    });
  }

  function get_material(id) {
    $.post(URL_AJAX + "/get_material", { id }, function (o) {
      $('#materialOptions').html(o);
    });
  }


</script>