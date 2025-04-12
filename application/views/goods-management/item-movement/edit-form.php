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
<form action="<?php echo site_url ('inventory/update_item'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $material->id; ?>">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <div class="info-box text-bg-white">
                <div class="info-box-content" style="color: #001F82;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="row mb-3">
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item
                                        Code</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="text" class="form-control" id="inputEmail3" disabled
                                        value="<?php echo $material->item_code; ?>" />
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item
                                        Description</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="text" class="form-control" id="item_name" name="item_name"
                                        value="<?php echo $material->item_name; ?>" />
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lot
                                        Size</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="number" class="form-control" id="lot_size" name="lot_size"
                                        value="<?php echo $material->lot_size; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lead
                                        Time
                                        PR to PO</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="number" class="form-control" id="lt_pr_po" name="lt_pr_po"
                                        value="<?php echo $material->lt_pr_po; ?>" />
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lead
                                        Time
                                        PO to
                                        Deliver</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="number" class="form-control" id="inputEmail3" id="lt_pr_to_deliv"
                                        name="lt_pr_to_deliv" value="<?php echo $material->lt_pr_to_deliv; ?>" />
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Total
                                        Lead Time</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="number" class="form-control" id="gen_lead_time" name="gen_lead_time"
                                        value="<?php echo $material->gen_lead_time; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Order
                                        Cycle</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="number" class="form-control" id="order_cycle" name="order_cycle"
                                        value="<?php echo myNum ($material->order_cycle); ?>" />
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <button type="button" class="btn btn-primary"
                                        style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Standart
                                        SS</button>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <input type="text" class="form-control" id="inputEmail3" disabled
                                        value="<?php echo myNum ($material->standard_safety_stock); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="row mb-3 justify-content-end">
                                <div class="col-sm-2" style="margin:0px;">
                                    <a type="button" class="btn btn-outline-danger"
                                        href="<?= site_url ('goods_management/item_movement'); ?>"
                                        style=" font-weight: 600; border-radius: 10px;width:100%;">Cancel</a>
                                </div>
                                <div class="col-sm-2" style="margin:0px;">
                                    <button class="btn btn-outline-primary" type="submit" name="submit"
                                        style="font-weight: 600; border-radius: 10px;width:100%;">Update
                                        Data</button>
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
</form>