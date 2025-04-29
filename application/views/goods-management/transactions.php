<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
    #modal-add .select2-container--bootstrap-5 .select2-selection {
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
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        height: 58px;
    }

    #modal-add .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        display: block;
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

    .unclickable {
        pointer-events: none;
        cursor: default;
    }
</style>

<div class="row">
    <div class="col-md-8 col-sm-12 col-12">
        <span class="btn mb-2 unclickable"
            style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">KPI</span>
        <div class="info-box" style="border-radius: 25px;">
            <div class="info-box-content" style="color: #001F82;">
                <figure class="highcharts-figure">
                    <div id="container" style="height: 250px; position: relative;"></div>
                </figure>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 unclickable"
            style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">YoY
            Consumption</span>
        <div class="info-box" style="border-radius: 25px;">
            <div class="info-box-content" style="color: #001F82;">
                <div id="yoy-consumption-chart" style="height: 250px;"></div>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>


    <!-- /.col -->
</div>
<span class="btn mb-2 unclickable"
    style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Usage</span>
<div class="row mb-2 justify-between">
    <div class="col-sm-6">

    </div>
    <div class="col-sm-6">
        <div class="d-flex justify-content-end">
            <a href="#" class="btn btn-sm btn-outline-primary"
                style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:10px;" data-bs-toggle="modal"
                data-bs-target="#modal-add">
                <i class="fa-solid fa-add"></i>
                Add Usage
            </a>
            <a href="#" class="btn btn-sm btn-outline-primary"
                style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:10px;" id="btnExport">
                <i class="fa-solid fa-file-export"></i>
                Export
            </a>
            <a class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;width: 150px;"
                data-bs-toggle="modal" data-bs-target="#modal-import">
                <i class="fa-solid fa-file-import"></i>
                Import
            </a>
        </div>
    </div>
</div>
<!--begin::Row-->
<div class="row info-box d-flex align-items-stretch ms-1 py-3 rounded-5">
    <form action="<?php echo site_url ('goods_management/transactions'); ?>" method="post">
        <?php $this->load->view ('_partials/search_bar_special.php'); ?>
    </form>
    <style>
        a.underline-custom {
            color: #001F82;
            text-decoration: none;
        }

        a.underline-custom:hover {
            text-decoration: underline;
            font-weight: 600;
        }
    </style>

    <table id="example" class="table table-sm" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                    Transactions</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Code</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Item</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Requested
                    Qty</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">UoM</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">YTD Used
                    QTY</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Status
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset ($item))
            {
            foreach ($item as $k => $v)
                { ?>
                    <tr>
                        <td style="vertical-align: middle;text-align: left;"><?php echo $v->transaction_id; ?></td>
                        <td style="vertical-align: middle;text-align: center;">
                            <a href="<?= site_url ('goods_management/stock_card_detail/' . _encrypt ($v->id)); ?>"
                                class="underline-custom">
                                <?php echo $v->item_code; ?>
                            </a>
                        </td>
                        <td style="vertical-align: middle;text-align: left;"><?php echo $v->item_name; ?></td>
                        <td style="vertical-align: middle;text-align: center;"><?php echo myNum ($v->qty); ?></td>
                        <td style="vertical-align: middle;text-align: center;"><?php echo $v->uom; ?></td>
                        <td style="vertical-align: middle;text-align: center;"><?php echo myNum ($v->ytd_used); ?></td>
                        <td style="vertical-align: middle;text-align: center;">
                            <?php if ($v->usage_status == 'OK')
                            { ?>
                                <button class="btn btn-sm btn-success" style="font-weight: 600; border-radius: 50px; width: 100%;">
                                    OK
                                </button>
                            <?php } ?>
                            <?php if ($v->usage_status == 'Fast Moving')
                            { ?>
                                <button class="btn btn-sm btn-danger" style="font-weight: 600; border-radius: 50px; width: 100%;">
                                    Fast Moving
                                </button>
                            <?php } ?>
                            <?php if ($v->usage_status == 'Slow Moving')
                            { ?>
                                <button class="btn btn-sm btn-warning" style="font-weight: 600; border-radius: 50px; width: 100%;">
                                    Slow Moving
                                </button>
                            <?php } ?>
                        </td>
                    </tr>

                <?php }
            } ?>
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<!-- <div class="card-footer">Footer</div> -->
<!-- /.card-footer-->
</div>
<!-- /.card -->
</div>
</div>
<!--end::Row-->
<input type="hidden" name="item_id" value="<?php echo $material->id; ?>">
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                    style="color: #001F82;font-weight:600;">
                    Add New Transactions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInputDate" placeholder="dd-mm-yyyy"
                                name="date" value="<?php echo date ('Y-m-d'); ?>" required>
                            <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Action
                                Date</label>
                        </div>
                    </div>
                    <div id="addContainer">
                        <div class="d-flex align-items-center gap-2 search-row mb-1">
                            <!-- btn add filter (hanya muncul di baris pertama) -->
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select item-select" name="item" id="item">
                                        <option value="">-- All Item --</option>
                                        <?php foreach ($item_list as $k => $v)
                                        {
                                        $s = isset ($param_search['item']) && $param_search['item'] == $v->id ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $v->id; ?>" <?php echo $s; ?>>
                                                <?php echo $v->item_name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label for="floatingInput" class="fw-bold text-primary"
                                        style="font-size: 14px;">Item</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="--" name="uom" id="uom"
                                        value="" readonly>
                                    <label for="filterUom" class="fw-bold text-primary">UoM</label>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="qty" id="qty" required>
                                    <label for="qty" class="fw-bold text-primary" style="font-size: 14px;">Qty</label>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary add-row mb-3" type="button" style="height: 100%;">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <table id="usageDataTable" class="table table-sm table-bordered" style="width:100%"
                            cellspacing="0">
                            <thead>
                                <th
                                    style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                                    Item Name</th>
                                <th
                                    style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                                    UoM</th>
                                <th
                                    style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                                    QTY</th>
                                <th
                                    style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                                </th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">No,
                    Cancel.</button>
                <button type="button" class="btn btn-outline-primary" id="submitMat" onclick="submit_usage()">Yes,
                    Submit Transactions</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Section -->
<div class="modal fade" id="cost-detail" tabindex="-1" aria-labelledby="cost-detail" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cost-detail" class="text-primary" style="color: #001F82;font-weight:600;">
                    Cost Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel Contoh -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">No</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Item Name</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Spend 2025</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Budget</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Spend 2024 YTD
                                </th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Spend 2024 FY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Masker</td>
                                <td>Rp.15.000.000</td>
                                <td>Rp.50.000.000</td>
                                <td>Rp.20.000.000</td>
                                <td>Rp.49.000.000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sepatu Safety</td>
                                <td>Rp.17.250.000</td>
                                <td>Rp.57.500.000</td>
                                <td>Rp.23.000.000</td>
                                <td>Rp.56.350.000</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Alkohol</td>
                                <td>Rp.14.550.000</td>
                                <td>Rp.48.500.000</td>
                                <td>Rp.19.400.000</td>
                                <td>Rp.47.530.000</td>
                            </tr>
                        </tbody>
                        <!-- <tfoot>
              <tr>
                
              </tr>
            </tfoot> -->
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" id="btnExportExcel">Export Excel</button>
                <!-- logic belum -->
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    var URL_AJAX = '<?php echo base_url (); ?>index.php/ajax';
    var addUsageData = [];
    var item_list = <?php echo json_encode ($item_list); ?>;

    $(document).ready(function () {
        $(document).on("click", ".add-row", function () {
            // var newRow = $(".search-row:first").clone();
            // newRow.find("input").val(""); // Kosongkan input
            // newRow.find(".add-row").removeClass("add-row btn-outline-primary").addClass("remove-row btn-outline-danger").html('<i class="fas fa-minus"></i>');
            // $("#addContainer").append(newRow);

            addUsageData.push({
                item_id: $("#item").val(),
                qty: $("#qty").val(),
                uom: $("#uom").val(),
            })
            const $tableBody = $("#usageDataTable tbody");

            $tableBody.empty(); // Clear the tbody

            $.each(addUsageData, function (index, item) {
                var data = item_list.find((data) => String(data.id) == item.item_id);

                let $row = $("<tr>");
                $row.append($("<td style='vertical-align: middle;text-align: center;'>").text(data.item_name));
                $row.append($("<td style='vertical-align: middle;text-align: center;'>").text(item.uom));
                $row.append($("<td style='vertical-align: middle;text-align: center;'>").text(item.qty));
                $row.append($("<td style='vertical-align: middle;text-align: center;'>").html("<button class= 'btn btn-sm btn-outline-danger remove-row' type = 'button' style = 'height: 100%;' onclick='removeUsage(" + item.item_id + ")'><i class='fas fa-minus'></i></button>")); // Tambahkan ikon minus
                $tableBody.append($row);
            });
        });

        $(document).on("click", ".remove-row", function () {
            $(this).closest(".search-row").remove();
        });
        $('#item').on('change', function () {
            $.ajax({
                url: URL_AJAX + "/get_uom_material",
                method: "POST",
                data: {
                    id: $(this).val()
                },
                dataType: "json",
                success: function (data) {
                    $('#uom').val(data.uom);
                }
            })
        });

        $('select').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#modal-add'),
        });

        $('#modal-add').on('shown.bs.modal', function () {
            $('.modal-select').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modal-add'),
                placeholder: "-- All Item --",
                width: '100%',
            });
        });
    });

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

    function removeUsage(item_id) {
        addUsageData = addUsageData.filter(item => String(item.item_id) != String(item_id));

        const $tableBody = $("#usageDataTable tbody");
        $tableBody.empty(); // Clear the tbody

        $.each(addUsageData, function (index, item) {
            var data = item_list.find((data) => String(data.id) == item.item_id);

            let $row = $("<tr>");
            $row.append($("<td style='vertical-align: middle;text-align: center;'>").text(data.item_name));
            $row.append($("<td style='vertical-align: middle;text-align: center;'>").text(item.uom));
            $row.append($("<td style='vertical-align: middle;text-align: center;'>").text(item.qty));
            $row.append($("<td style='vertical-align: middle;text-align: center;'>").html("<button class= 'btn btn-sm btn-outline-danger remove-row' type = 'button' style = 'height: 100%;' onclick='removeUsage(" + item.item_id + ")'><i class='fas fa-minus'></i></button>")); // Tambahkan ikon minus
            $tableBody.append($row);
        })
    }

    function submit_usage() {
        $('#submitUsage').attr('disabled', true);
        $('#submitUsage').text('Processing...');

        var values = {
            "transactions_date": $('#floatingInputDate').val(),
            "item": addUsageData
        };

        console.log(values);

        $.ajax({
            url: '<?php echo site_url ('goods_management/add_transaction'); ?>',
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
</script>
<script>

    $(document).ready(function () {
        var table = $('#example').DataTable({
            dom: "t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
        });

        $('#example_filter').remove();
        $('#example_length').remove();

        $('#entriesSelect').on('change', function () {
            var length = $(this).val();
            table.page.len(length).draw();
        });

        Highcharts.setOptions({
            colors: ['#C0CDD9', '#8EAACF', '#DAEAFF', '#7E99B1', '#64E572', '#D8DFE7', '#7E9AB2']
        });

        Highcharts.chart('container', {

            chart: {
                type: 'pie',
                custom: {},
                events: {
                    render() {
                        const chart = this,
                            series = chart.series[0];
                        let customLabel = chart.options.chart.custom.label;
                    }
                },
                backgroundColor: 'transparent'
            },
            credits: {
                enabled: false
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: (e) => {
                                const myModal = new bootstrap.Modal('#cost-detail', {
                                    keyboard: false
                                });
                                myModal.show();
                                console.log('clicked');
                            },
                        }
                    },
                    borderRadius: 8,
                    dataLabels: [{
                        enabled: true,
                        distance: 20,
                        format: '{point.name}'
                    }, {
                        enabled: true,
                        distance: -15,
                        format: '{point.percentage:.0f}%',
                        style: {
                            fontSize: '0.9em'
                        }
                    }],
                    showInLegend: true
                }
            },
            series: [{
                name: 'Item',
                colorByPoint: true,
                innerSize: '50%',
                data: [{
                    name: 'Item 1',
                    y: 23.9
                }, {
                    name: 'Item 2',
                    y: 12.6
                }, {
                    name: 'Item 3',
                    y: 37.0
                }, {
                    name: 'Item 4',
                    y: 26.4
                }]
            }]
        });

        Highcharts.chart('yoy-consumption-chart', {
            chart: {
                type: 'column',
                backgroundColor: 'transparent'
            },
            title: {
                text: 'YoY Consumption',
                align: 'center',
                style: { fontSize: '16px', fontWeight: 'bold' }
            },
            xAxis: {
                categories: ['2024', '2025']
            },
            yAxis: {
                title: { text: '' },
                min: 0
            },
            legend: { enabled: false },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Consumption',
                type: 'column',
                data: [500000, 200000],
                color: '#001F82',
                dataLabels: {
                    enabled: true,
                    format: '{y:,.0f}'
                }
            }, {
                name: 'Trend',
                type: 'line',
                data: [500000, 200000],
                color: 'orange',
                marker: { enabled: false }
            }]
        });
    });


    // logic untuk tinggi card tertentu
    document.addEventListener("DOMContentLoaded", function () {
        let targetRows = [0]; // Index row yang ingin diatur

        targetRows.forEach(index => {
            let targetRow = document.querySelectorAll(".row")[index];

            if (targetRow) {
                let cards = targetRow.querySelectorAll(".info-box");

                if (cards.length > 0) {
                    let maxHeight = 0;

                    // Cari tinggi maksimum dalam row ini
                    cards.forEach(card => {
                        let cardHeight = card.offsetHeight;
                        if (cardHeight > maxHeight) {
                            maxHeight = cardHeight;
                        }
                    });

                    // Set semua card di row ini ke tinggi maksimum
                    cards.forEach(card => {
                        card.style.height = maxHeight + "px";
                    });
                }
            }
        });
    });

    window.onload = function () {
        const sidebar = document.querySelector(".app-sidebar");
        const mainContent = document.querySelector(".main-content");
        let originalSizes = [];
        let isSidebarOpen = false;

        Highcharts.charts.forEach((chart, index) => {
            if (chart) {
                originalSizes[index] = {
                    width: chart.chartWidth,
                    height: chart.chartHeight
                };
            }
        });

        function checkSidebarState() {
            const currentState = !sidebar.classList.contains('collapsed') && sidebar.offsetWidth >= 100;
            
            if (currentState !== isSidebarOpen) {
                isSidebarOpen = currentState;
                handleSidebarStateChange();
            }
        }

        function handleSidebarStateChange() {
            if (isSidebarOpen) {
                Highcharts.charts.forEach((chart, index) => {
                    if (chart && originalSizes[index]) {
                        let newWidth = originalSizes[index].width * 0.8;
                        let newHeight = originalSizes[index].height * 0.8;
                        chart.setSize(newWidth, newHeight, false);

                        chart.renderTo.style.margin = '0 auto';
                        chart.renderTo.style.padding = '0';
                    }
                });

                mainContent.style.transform = 'scale(0.95)';
                mainContent.style.transformOrigin = 'top center';
            } else {
                Highcharts.charts.forEach((chart, index) => {
                    if (chart && originalSizes[index]) {
                        chart.setSize(originalSizes[index].width, originalSizes[index].height, false);
                        chart.renderTo.style.margin = '';
                        chart.renderTo.style.padding = '';
                    }
                });

                mainContent.style.transform = 'scale(1)';
            }
        }

        if (sidebar && mainContent) {
            checkSidebarState();

            const mutationObserver = new MutationObserver(checkSidebarState);
            mutationObserver.observe(sidebar, {
                attributes: true,
                attributeFilter: ['class']
            });

            const resizeObserver = new ResizeObserver(checkSidebarState);
            resizeObserver.observe(sidebar);

            window.addEventListener('resize', checkSidebarState);
        }
    };
</script>