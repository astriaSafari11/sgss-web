<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

    .flatpickr-calendar {
        background-color: rgb(255, 255, 255) !important;
    }

    .flatpickr-month {
        background-color: #001F82 !important;
        color: white !important;
        height: 40px !important;
    }

    .flatpickr-prev-month svg,
    .flatpickr-next-month svg {
        fill: white !important;
    }

    .flatpickr-monthDropdown-months {
        background-color: #001F82 !important;
        color: white !important;
        border: none !important;
    }

    .flatpickr-monthDropdown-months option {
        background-color: #001F82 !important;
        color: white !important;
    }

    .flatpickr-monthDropdown-months option:hover {
        background-color: #001F82 !important;
    }
</style>
<form action="<?php echo site_url ('goods_management/submit_order'); ?>" method="post" enctype="multipart/form-data"
    class="needs-validation" novalidate>
    <input type="hidden" name="planned_id" value="<?php echo $order->planned_id; ?>">
    <input type="hidden" name="order_id" value="<?php echo $order->id; ?>">
    <!--begin::Row-->
    <div class="row">
        <div class="col-12 mb-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInputDate" placeholder="dd-mm-yyyy"
                                    name="date" value="<?php echo date ('Y-m-d'); ?>" required>
                                <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Action
                                    Date <?php echo $order->request_id; ?></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput" placeholder="Requestor Name"
                                    value="<?php echo $this->session->userdata ('user_name'); ?>" readonly>
                                <label for="floatingInput" class="fw-bold text-primary" name="requestor"
                                    style="font-size: 14px;">Requestor</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="purchase-reason"
                                    data-placeholder="Choose Purchase Reason" name="purchase_reason" required>
                                    <option></option>
                                    <?php foreach ($purchase_reason as $row)
                                    { ?>
                                        <option value="<?php echo $row->purchase_reason; ?>">
                                            <?php echo $row->purchase_reason; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="floatingSelect" class="fw-bold text-primary"
                                    style="font-size: 14px;">Purchase
                                    Reason</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="requested-for" data-placeholder="Choose Requested For"
                                    name="requested_for" required>
                                    <option></option>
                                    <?php foreach ($user_list as $row)
                                    { ?>
                                        <option value="<?php echo $row->nama; ?>"><?php echo $row->nama; ?> -
                                            <?php echo $row->email; ?>
                                        </option>
                                    <?php } ?>

                                </select>
                                <label for="floatingSelect" class="fw-bold text-primary"
                                    style="font-size: 14px;">Requested For</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="remarks">
                                <label for="floatingInput" class="fw-bold text-primary"
                                    style="font-size: 14px;">Remarks</label>
                            </div>
                        </div>
                        <!--end::Col-->
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="area" value="<?php echo $area->area_code; ?>"
                                    readonly>
                                <label for="floatingInput" class="fw-bold text-primary"
                                    style="font-size: 14px;">Area</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="attachmentInput" class="fw-bold text-primary"
                                    style="font-size: 14px;">Attachment</label>
                                <div class="input-group">
                                    <input type="file" name="attachment" class="form-control d-none"
                                        id="attachmentInput" accept="*/*" style="width: 100%;">
                                    <input type="text" class="form-control" placeholder="Choose file..." readonly>
                                    <button class="btn btn-primary" type="button" id="uploadBtn">
                                        <i class="bi bi-upload"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-2 text-primary fw-bold">Order Information</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Qty</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor
                                        </th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Lead Time
                                            (days)</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">UoM Price
                                            (Rp.)</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Total
                                            Price (Rp.)</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Remaining
                                            Budget</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Savings
                                        </th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Saving
                                            Value</th>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;">Lead Time
                                            Impact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;text-align: center;font-size: 14px;">
                                            <div
                                                style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                                <span style="flex-grow: 1; text-align: center;">
                                                    <?php echo $detail->item_name; ?>
                                                    <?php echo $detail->size; ?>
                                                    <?php echo $detail->uom; ?></span>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded-circle p-2.1"
                                                    style="margin-left: 3px;" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-item">
                                                    <i class="fa-solid fa-pen text-white"></i>
                                                </button>
                                            </div>

                                        </td>
                                        <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                                            <div
                                                style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                                <span
                                                    style="flex-grow: 1; text-align: center;"><?php echo $detail->qty; ?></span>
                                                <?php if (isset ($detail))
                                                { ?>
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm rounded-circle p-2.1"
                                                        style="margin-left: 3px;" data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-qty">
                                                        <i class="fa-solid fa-pen text-white"></i>
                                                    </button>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td style="vertical-align: middle;text-align: center;font-size: 14px;">
                                            <?php echo $detail->uom; ?>
                                        </td>
                                        <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                                            <div
                                                style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                                <span
                                                    style="flex-grow: 1; text-align: center;"><?php echo $vendor->vendor_name; ?></span>
                                                <?php if (isset ($detail))
                                                { ?>
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm rounded-circle p-2.1"
                                                        style="margin-left: 3px;" data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-vendor">
                                                        <i class="fa-solid fa-pen text-white"></i>
                                                    </button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <?php
                                        $savings = isset ($detail) ? myDecimal (calculate_savings ($detail->uom_price, get_baseline_price ($detail->item_id, 'target'))) : 0;
                                        $saving_value = isset ($detail) ? myNum (($detail->qty * get_baseline_price ($detail->item_id, 'target')) - $detail->total_price) : 0;
                                        $lead_time_impact = isset ($detail) ? myNum ($detail->est_lead_time - $detail->lt_pr_po) : 0;

                                        $bg = $savings < 1 ? '#FBE2D5' : '#80f578';

                                        $bg_lead_time = $lead_time_impact < 1 ? '#FBE2D5' : '#80f578';
                                        ?>
                                        <td style="vertical-align: middle;text-align: center;font-size: 14px;">
                                            <?php echo myNum ($detail->est_lead_time); ?>
                                        </td>
                                        <td style="vertical-align: middle;text-align: right;font-size: 14px;">
                                            <?php echo myNum ($detail->uom_price); ?>
                                        </td>
                                        <td style="vertical-align: middle;text-align: right;font-size: 14px;">
                                            <?php echo myNum ($detail->total_price); ?>
                                        </td>
                                        <td style="vertical-align: middle;text-align: center;font-size: 14px;">
                                            <?php echo isset ($detail) ? myNum (calc_remaining_budget ($detail->item_id)) : 0; ?>
                                        </td>
                                        <td
                                            style="vertical-align: middle;text-align: center;font-size: 14px;background-color:<?php echo $bg; ?>;">
                                            <?php echo $savings; ?>
                                            %
                                        </td>
                                        <td
                                            style="vertical-align: middle;text-align: center;font-size: 14px;background-color:<?php echo $bg; ?>;">
                                            <?php echo $saving_value; ?>
                                        </td>
                                        <td
                                            style="vertical-align: middle;text-align: center;font-size: 14px;background-color:<?php echo $bg_lead_time; ?>;">
                                            <?php echo $lead_time_impact; ?> days
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php if (isset ($detail))
                        { ?>

                            <h5 class="mb-2 text-primary fw-bold">Budget Information</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="color: #fff;background-color:rgb(121, 121, 122);text-align: center;">
                                                Target Price / item
                                            </th>
                                            <th style="color: #fff;background-color:rgb(121, 121, 122);text-align: center;">
                                                Budget Price / item
                                            </th>
                                            <th style="color: #fff;background-color:rgb(121, 121, 122);text-align: center;">
                                                Annual Budget</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align: middle;text-align: right;font-size: 14px;">
                                                <?php echo myNum (get_baseline_price ($detail->item_id, 'target')); ?>
                                            </td>
                                            <td style="vertical-align: middle;text-align: right;font-size: 14px;">
                                                <?php echo myNum (get_baseline_price ($detail->item_id, 'target')); ?>
                                            </td>
                                            <td style="vertical-align: middle;text-align: right;font-size: 14px;">
                                                <?php echo myNum (get_annual_price ($detail->item_id, date ('Y'))); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-end">
                        <button class="btn btn-sm btn-danger custom-btn-danger" type="button"
                            style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;"
                            onclick="location.reload();">
                            Reset
                        </button>
                        <button class="btn btn-sm btn-secondary custom-btn" type="submit"
                            style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;">
                            Submit
                        </button>

                        <style>
                            .custom-btn {
                                color: #001F82;
                                border: 2px solid #001F82;
                                background-color: transparent;
                                transition: all 0.3s ease-in-out;
                            }

                            .custom-btn:hover {
                                background-color: #001F82;
                                color: white !important;
                            }

                            .custom-btn-danger {
                                color: #DC3545;
                                border: 2px solid #001F82;
                                background-color: transparent;
                                transition: all 0.3s ease-in-out;
                            }

                            .custom-btn-danger:hover {
                                background-color: #DC3545;
                                color: white !important;
                            }
                        </style>

                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
        </div>
</form>
<div class="modal fade" id="modal-edit-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="<?= site_url ('goods_management/order_form'); ?>" method="post" id="modal-edit-item">
        <input type="hidden" name="order_id" value="<?php echo _encrypt ($order->id); ?>">
        <input type="hidden" name="request_id" value="<?php echo _encrypt ($order->request_id); ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                        style="color: #001F82;font-weight:600;">
                        Edit Order Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <select id="filterItem" class="form-select" name="item"
                                            data-placeholder="Choose Item">
                                            <option value="">-- All Item --</option>
                                            <?php foreach ($item as $k => $v)
                                            {
                                            $s = isset ($param_search['item']) && $param_search['item'] == $v->id ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $v->id; ?>" <?php echo $s; ?>>
                                                    <?php echo $v->item_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label for="filterItem" class="fw-bold text-primary">Item</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit_item" class="btn btn-outline-primary">Edit Item</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="modal-edit-qty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="<?= site_url ('goods_management/order_form'); ?>" method="post" id="modal-edit-qty">
        <input type="hidden" name="order_id" value="<?php echo _encrypt ($order->id); ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                        style="color: #001F82;font-weight:600;">
                        Edit Order Qty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="name@example.com" name="qty" min="1">
                                        <label for="floatingInput" class="fw-bold text-primary">Qty</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit_qty" class="btn btn-outline-primary">Edit Qty Order</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-edit-vendor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="<?= site_url ('goods_management/order_form'); ?>" method="post" id="modal-edit-vendor">
        <input type="hidden" name="order_id" value="<?php echo _encrypt ($order->id); ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                        style="color: #001F82;font-weight:600;">
                        Edit Selected Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="vendor" data-placeholder="Choose Vendor"
                                            name="vendor" required>
                                            <option>-- Select Vendor --</option>
                                            <?php foreach ($vendor_list as $row)
                                            { ?>
                                                <option value="<?php echo $row->vendor_code; ?>">
                                                    <?php echo $row->vendor_name; ?> - Item Price :
                                                    <?php echo myNum ($row->price_per_uom); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingInput" class="fw-bold text-primary">Vendor List</label>
                                    </div>
                                    <h5 class="mb-2 text-primary fw-bold">Vendor Options</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th
                                                        style="color: #fff;background-color: #001F82;text-align: center;">
                                                        Vendor Name</th>
                                                    <th
                                                        style="color: #fff;background-color: #001F82;text-align: center;">
                                                        Lead Time (days)</th>
                                                    <th
                                                        style="color: #fff;background-color: #001F82;text-align: center;">
                                                        UoM Price (Rp.)</th>
                                                    <th
                                                        style="color: #fff;background-color: #001F82;text-align: center;">
                                                        Total Price (Rp.)</th>
                                                    <th
                                                        style="color: #fff;background-color: #001F82;text-align: center;">
                                                        Savings</th>
                                                    <th
                                                        style="color: #fff;background-color: #001F82;text-align: center;">
                                                        Savings Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($vendor_list as $row)
                                                    {
                                                    $savings = calculate_savings ($row->price_per_uom, get_baseline_price ($detail->item_id, 'target'));
                                                    $total_price = $row->price_per_uom * $detail->qty;
                                                    $saving_value = ($detail->qty * get_baseline_price ($detail->item_id, 'target')) - $total_price;
                                                    ?>
                                                    <tr>
                                                        <td
                                                            style="vertical-align: middle;text-align: center;font-size: 14px;">
                                                            <?php echo $row->vendor_code; ?> -
                                                            <?php echo $row->vendor_name; ?>
                                                        </td>
                                                        <td
                                                            style="vertical-align: middle;text-align: center;font-size: 14px;">
                                                            <?php echo myNum ($row->est_lead_time); ?>
                                                        </td>
                                                        <td
                                                            style="vertical-align: middle;text-align: center;font-size: 14px;">
                                                            <?php echo myNum ($row->price_per_uom); ?>
                                                        </td>
                                                        <td
                                                            style="vertical-align: middle;text-align: center;font-size: 14px;">
                                                            <?php echo myNum ($total_price); ?>
                                                        </td>
                                                        <td
                                                            style="vertical-align: middle;text-align: center;font-size: 14px;">
                                                            <?php echo myDecimal ($savings); ?>
                                                            %
                                                        </td>
                                                        <td
                                                            style="vertical-align: middle;text-align: center;font-size: 14px;">
                                                            <?php echo myNum ($saving_value); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit_vendor" class="btn btn-outline-primary">Edit Vendor</button>
                </div>
            </div>
        </div>
    </form>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#floatingInputDate", {
        dateFormat: "d-m-Y",
        defaultDate: null,
        allowInput: true,
        onOpen: function (selectedDates, dateStr, instance) {
            if (instance._input.value === "dd-mm-yyyy") {
                instance._input.value = "dd-mm-yyyy";
            }
        },
        onChange: function (selectedDates, dateStr, instance) {
            if (instance._input.value === " ") {
                instance._input.value = "dd-mm-yyyy";
            }
        }
    });
</script>
<script>
    document.getElementById("uploadBtn").addEventListener("click", function () {
        document.getElementById("attachmentInput").click();
    });

    // Menampilkan nama file yang diunggah
    document.getElementById("attachmentInput").addEventListener("change", function () {
        let fileName = this.files.length > 0 ? this.files[0].name : "Choose file...";
        this.nextElementSibling.value = fileName;
    });
</script>
<script>
    $(document).ready(function () {
        $('#purchase-reason').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        $('#requested-for').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        $('#filterItem').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    });
</script>
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