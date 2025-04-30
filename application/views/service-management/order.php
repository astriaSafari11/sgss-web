<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
<form action="<?php echo site_url ('service_management/submit_order'); ?>" method="post" class="needs-validation"
    novalidate>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="#" method="post" class="needs-validation" novalidate>
                    <div class="row">
                        <!-- Form Inputs -->
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <select class="form-select select2" id="type" name="type" required>
                                    <option></option>
                                    <option value="qty">Order by Qty</option>
                                    <option value="amount">Order by Amount</option>
                                </select>
                                <label for="type" class="fw-bold text-primary" style="font-size: 14px;">Service
                                    Type</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="period_start" placeholder="Period Start"
                                    name="period_start" required>
                                <label for="period_start" class="fw-bold text-primary" style="font-size: 14px;">Period
                                    Start</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="period_end" placeholder="Period End"
                                    name="period_end" required>
                                <label for="period_end" class="fw-bold text-primary" style="font-size: 14px;">Period
                                    End</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
                                <select class="form-select select2" id="shift" name="shift" required>
                                    <option></option>
                                    <option value="DM">DM</option>
                                    <option value="DS">DS</option>
                                    <option value="DP">DP</option>
                                </select>
                                <label for="shift" class="fw-bold text-primary" style="font-size: 14px;">Shift</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
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
                                <label for="usage_reason" class="fw-bold text-primary" style="font-size: 14px;">Usage
                                    Reason</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="remarks" placeholder="Remarks"
                                    name="remarks">
                                <label for="remarks" class="fw-bold text-primary"
                                    style="font-size: 14px;">Remarks</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="requestor" placeholder="Requestor"
                                    name="requestor" value="<?php echo $this->session->userdata ('user_name'); ?>"
                                    required>
                                <label for="requestor" class="fw-bold text-primary"
                                    style="font-size: 14px;">Requestor</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="requested-for" data-placeholder="Choose Requested For"
                                    name="requested_for" required>
                                    <option></option>
                                    <?php foreach ($user as $row)
                                    { ?>
                                        <option value="<?php echo $row->nama; ?>"><?php echo $row->nama; ?> -
                                            <?php echo $row->email; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="requested_for" class="fw-bold text-primary"
                                    style="font-size: 14px;">Requested
                                    For</label>
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="area" placeholder="Area" name="area"
                                    value="<?php echo $area->area_code; ?>" required>
                                <label for="area" class="fw-bold text-primary" style="font-size: 14px;">Area</label>
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-2 text-primary fw-bold">Service Item</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor</th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Type of
                                        Service
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Service
                                        Category
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Unit Price
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Qty
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">UoM
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Subtotal
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Tax / VAT
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Total</th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-select-sm" id="vendor" name="vendor" style="width: 100%;">
                                            <?php foreach ($vendor as $row)
                                            { ?>
                                                <option value="<?php echo $row->vendor_code; ?>">
                                                    <?php echo $row->vendor_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <select class="form-select-sm" id="item" name="item" style="width: 100%;">
                                            <?php foreach ($item as $row)
                                            { ?>
                                                <option value="<?php echo $row->id; ?>">
                                                    <?php echo $row->item_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control-sm" id="service_category"
                                            placeholder="Service Category" name="service_category" disabled>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control-sm" id="unit_price"
                                            placeholder="Unit Price" name="unit_price" required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control-sm" id="qty" placeholder="Qty"
                                            name="qty" required>
                                    </td>
                                    <td>
                                        <select class="form-select-sm" id="uom" name="uom" style="width: 100%;">
                                            <option value="person">Person</option>
                                            <option value="pallet">Pallet</option>
                                            <option value="once off">Once Off</option>
                                        </select>
                                    </td>
                                    <td><input type="number" class="form-control-sm" id="sub_total"
                                            placeholder="Sub Total" name="sub_total" readonly></td>
                                    <td>
                                        <input type="number" class="form-control-sm" id="tax" placeholder="Tax / VAT"
                                            name="tax" required>
                                    </td>
                                    <td><input type="number" class="form-control-sm" id="total" placeholder="Total"
                                            name="total" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-sm btn-danger custom-btn-danger" type="button"
                            style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;"
                            onclick="location.reload();">
                            Reset
                        </button>
                        <button class="btn btn-sm btn-secondary custom-btn" type="submit" name="submit"
                            style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</form>

<!-- Flatpickr & Select2 initialization -->
<script>
    var URL_AJAX = '<?php echo base_url (); ?>index.php/ajax';
    flatpickr("#date", {
        dateFormat: "d/m/Y",
        allowInput: true
    });

    flatpickr("#period_start", {
        dateFormat: "d/m/Y",
        allowInput: true
    });

    flatpickr("#period_end", {
        dateFormat: "d/m/Y",
        allowInput: true
    });

    $(document).ready(function () {
        $('#type_of_service_qty').show();
        $('#type_of_service_amount').hide();

        $('#type').on('change', function () {
            var value = $(this).val();
            console.log(value);

            if (value == 'amount') {
                $('#service_category').val('Bulk Service');
                $('#qty').val(1);
                $('#uom').val('once off');
            }
        });

        $('#unit_price').on('change', function () {
            calculateTotal();
        });

        $('#qty').on('change', function () {
            calculateTotal();
        });

        $('#tax').on('change', function () {
            calculateTotal();
        });

        $('#item').on('change', function () {
            $.ajax({
                url: URL_AJAX + "/get_service_type",
                method: "POST",
                data: {
                    id: $(this).val()
                },
                dataType: "json",
                success: function (data) {
                    var service = $('#type').val();
                    if (value == 'amount') {
                        $('#service_category').val('Bulk Service');
                    } else {
                        $('#service_category').val(data.service_category);
                    }
                }
            })
        });
    });

    function calculateTotal() {
        var unit_price = $('#unit_price').val();
        var qty = $('#qty').val();
        var sub_total = unit_price * qty;
        $('#sub_total').val(sub_total);

        var tax = $('#tax').val();
        var total = Number(sub_total) + Number((sub_total * tax / 100));
        $('#total').val(total);
    }

</script>