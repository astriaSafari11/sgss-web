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
    <?php if (! empty ($order))
    { ?>
        <input type="hidden" name="order_id" value="<?php echo $order->id; ?>">
    <?php } ?>
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
                                <select class="form-select" id="usage_reason" data-placeholder="Choose Purchase Reason"
                                    name="usage_reason" required>
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
                                    readonly>
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
                                    value="<?php echo $area->area_code; ?>" readonly>
                                <label for="area" class="fw-bold text-primary" style="font-size: 14px;">Area</label>
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-2 text-primary fw-bold">Service Item</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Type of
                                        Service
                                    </th>
                                    <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor</th>
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
                                    <?php if (empty ($detail->item_id))
                                    { ?>
                                        <th style="color: #fff;background-color: #001F82;text-align: center;"></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="data-row">
                                    <td width="10%" style="vertical-align: middle;text-align: center;">
                                        <select class="form-control form-select-sm search-item" id="item" name="item[]"
                                            style="width: 100%;" required>
                                            <option value="">- Select Service -</option>
                                            <?php echo $row->item_name; ?>
                                            </option>
                                            <?php foreach ($item as $row)
                                            {
                                            $selected = isset ($detail) && $detail->item_id == $row->id ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo ! empty ($detail) && $detail->item_id == $row->id ? 'selected' : ''; ?>>
                                                    <?php echo $row->item_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="item_hidden[]" class="item_hidden_input"
                                            value="<?php echo ! empty ($detail) ? $detail->item_id : ''; ?>">
                                    </td>
                                    <td width="10%">
                                        <select class="form-control form-select-sm vendor_input" id="vendor"
                                            name="vendor[]" style="width: 100%;" required>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm service_category_input"
                                            id="service_category" placeholder="Service Category"
                                            name="service_category[]" readonly>
                                    </td>
                                    <td>
                                        <input type="text"
                                            class="form-control form-control-sm unitPrice unit_price_input"
                                            id="unit_price" placeholder="Unit Price" name="unit_price[]" required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm qty_input" id="qty"
                                            placeholder="Qty" name="qty[]" required>
                                    </td>
                                    <td>
                                        <select class="form-control form-select-sm uom_input" id="uom" name="uom[]"
                                            style="width: 100%;" required>
                                            <option value="person">Person</option>
                                            <option value="pallet">Pallet</option>
                                            <option value="once off">Once Off</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control form-control-sm sub_total_input"
                                            id="sub_total" placeholder="Sub Total" name="sub_total[]" readonly></td>
                                    <td width="5%">
                                        <input type="number" class="form-control form-control-sm tax_input" id="tax"
                                            placeholder="Tax / VAT" name="tax[]" required>
                                    </td>
                                    <td><input type="text" class="form-control form-control-sm total_input" id="total"
                                            placeholder="Total" name="total[]" readonly></td>
                                    <?php if (empty ($detail->item_id))
                                    { ?>
                                        <td>
                                            <button class="btn btn-outline-primary btn-sm add-row" type="button">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    <?php } ?>
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
    $(document).on("click", ".add-row", function () {
        // Clone the first row
        var newRow = $('.data-row:first').clone();
        // Clear input values
        newRow.find('input').val('');
        newRow.find(".add-row").removeClass("add-row btn-outline-primary").addClass("remove-row btn-outline-danger").html('<i class="fas fa-minus"></i>');
        // Append cloned row to table
        $('#myTable tbody').append(newRow);
    });

    $(document).on("click", ".remove-row", function () {
        // Prevent removing the last row
        if ($('#myTable .data-row').length > 1) {
            $(this).closest('tr').remove();
        }
    });

    $(document).ready(function () {
        $('#type_of_service_qty').show();
        $('#type_of_service_amount').hide();
        $(".unitPrice").on('keyup', function () {
            var val = this.value;
            val = val.replace(/[^0-9\.]/g, '');

            if (val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
                val = valArr.join('.');
            }

            this.value = val;
        });

        $(".totalPrice").on('change', function () {
            var val = this.value;
            val = val.replace(/[^0-9\.]/g, '');

            if (val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
                val = valArr.join('.');
            }

            this.value = val;
        });

        $('#myTable tbody tr').each(function () {
            var input = $(this);
            var row = input.closest('tr');
            var name = input.val().trim();
            var type = $('#type').val();

            <?php if (! empty ($detail))
            { ?>
                row.find('.search-item').prop('disabled', true);
            <?php } ?>

            $.ajax({
                url: URL_AJAX + "/get_vendor_list",
                method: "POST",
                data: {
                    type: 'service',
                    item: <?php echo ! empty ($detail->item_id) ? $detail->item_id : '""'; ?>
                },
                dataType: "html",
                success: function (data) {
                    row.find('.vendor_input').html(data);
                }
            });
        });

        // AJAX call on name input blur
        $('#myTable').on('change', '.search-item', function () {
            var input = $(this);
            var row = input.closest('tr');
            var name = input.val().trim();
            var type = $('#type').val();

            $.ajax({
                url: URL_AJAX + "/get_vendor_list",
                method: "POST",
                data: {
                    type: 'service',
                    item: name
                },
                dataType: "html",
                success: function (data) {
                    row.find('.vendor_input').html(data);
                }
            });

            if (type !== '') {
                if (type == 'amount') {
                    row.find('.service_category_input').val('Bulk Service');
                    row.find('.qty_input').val(1);
                    row.find('.uom_input').val('once off');
                } else {
                    row.find('.qty_input').val('');
                    row.find('.uom_input').val('');
                    $.ajax({
                        url: URL_AJAX + "/get_service_type",
                        method: "POST",
                        data: {
                            id: name
                        },
                        dataType: "json",
                        success: function (data) {
                            var service = $('#type').val();
                            if (service == 'amount') {
                                row.find('.service_category_input').val('Bulk Service');
                            } else {
                                row.find('.service_category_input').val(data.service_category);
                            }
                        }
                    });
                }
            }
        });

        // AJAX call on name input blur
        $('#myTable').on('keyup', '.unit_price_input', function () {
            var val = this.value;
            val = val.replace(/[^0-9\.]/g, '');

            if (val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
                val = valArr.join('.');
            }

            this.value = val;
        });

        $('#myTable').on('change', '.unit_price_input', function () {
            var input = $(this);
            var row = input.closest('tr');

            var unit_price = input.val().replace(/[^0-9\.]/g, '');
            var qty = row.find('.qty_input').val();
            var tax = row.find('.tax_input').val();
            var calc = calculateTotal(unit_price, qty, tax);

            row.find('.total_input').val(Number(calc.total).toLocaleString());
            row.find('.sub_total_input').val(Number(calc.sub_total).toLocaleString());
        });

        $('#myTable').on('change', '.qty_input', function () {
            var input = $(this);
            var row = input.closest('tr');

            var unit_price = row.find('.unit_price_input').val().replace(/[^0-9\.]/g, '');
            var qty = input.val();
            var tax = row.find('.tax_input').val();

            var calc = calculateTotal(unit_price, qty, tax);
            row.find('.total_input').val(Number(calc.total).toLocaleString());
            row.find('.sub_total_input').val(Number(calc.sub_total).toLocaleString());
        });

        $('#myTable').on('change', '.tax_input', function () {
            var input = $(this);
            var row = input.closest('tr');

            var unit_price = row.find('.unit_price_input').val().replace(/[^0-9\.]/g, '');
            var qty = row.find('.qty_input').val();
            var tax = input.val();

            var calc = calculateTotal(unit_price, qty, tax);

            row.find('.total_input').val(Number(calc.total).toLocaleString());
            row.find('.sub_total_input').val(Number(calc.sub_total).toLocaleString());
        });

        <?php if (isset ($detail))
        { ?>
            $.ajax({
                url: URL_AJAX + "/get_service_type",
                method: "POST",
                data: {
                    id: <?php echo $detail->item_id; ?>
                },
                dataType: "json",
                success: function (data) {
                    var service = $('#type').val();
                    if (service == 'amount') {
                        $('#service_category').val('Bulk Service');
                    } else {
                        $('#service_category').val(data.service_category);
                    }
                }
            });
        <?php } ?>
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
                    if (service == 'amount') {
                        $('#service_category').val('Bulk Service');
                    } else {
                        $('#service_category').val(data.service_category);
                    }
                }
            })
        });
    });

    function calculateTotal(unit_price, qty, tax) {
        var sub_total = unit_price * qty;
        var total = Number(sub_total) + Number((sub_total * tax / 100));

        return {
            sub_total: sub_total,
            total: total
        }
    }
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