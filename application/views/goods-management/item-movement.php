<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
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
<style>
    .unclickable {
        pointer-events: none;
        cursor: default;
    }
</style>

<div class="row">
    <div class="col-md-12 col-sm-12 col-12">
        <span class="btn mb-2 unclickable"
            style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">KPI</span>
        <div class="info-box" style="border-radius: 25px;">
            <div class="info-box-content" style="color: #001F82;">
                <figure class="highcharts-figure">
                    <div id="container" style="height: 250px;"></div>
                </figure>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<span class="btn mb-2 unclickable"
    style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Table of all items
    maintained for inventory management</span>
<div class="row mb-2 justify-between">
    <div class="col-sm-6">

    </div>
    <div class="col-sm-6">
        <div class="d-flex justify-content-end">
            <a href="<?php echo site_url ('goods_management/order_form'); ?>" class="btn btn-sm btn-outline-primary"
                style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:10px;">
                <i class="fa-solid fa-add"></i>
                Request
            </a>
            <a class="btn btn-sm btn-outline-primary"
                style="font-weight: 600; border-radius: 50px;width: 150px;margin-right:10px;" data-bs-toggle="modal"
                data-bs-target="#modal-import">
                <i class="fa-solid fa-file-import"></i>
                Import
            </a>
            <a href="<?php echo site_url ('inventory/export'); ?>" class="btn btn-sm btn-outline-primary"
                style="font-weight: 600; border-radius: 50px; margin-right:10px;" id="btnExport">
                <i class="fa-solid fa-file-export"></i>
                Export Stock Take
            </a>
            <a class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-export-report"
                style="font-weight: 600; border-radius: 50px; margin-right:10px;" id="btnExport">
                <i class="fa-solid fa-file-export"></i>
                Export Inventory Report
            </a>
        </div>
    </div>
</div>
<!--begin::Row-->
<div class="row info-box d-flex align-items-stretch ms-1 py-3 rounded-5">
    <div class="col-12 mb-2">
        <!-- end btn add request -->
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
        <form method="post" id="searchInventory">
            <?php $this->load->view ('_partials/search_bar_inventory.php'); ?>
        </form>

        <table id="example" class="table table-sm table-striped table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <!-- <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Code
                    </th> -->
                    <th
                        style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;width:30%;">
                        Item
                    </th>
                    <th
                        style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;width:10%;">
                        Current On-Hand Stock</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                        UoM
                    </th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                        Status
                    </th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                        Latest
                        Receipt</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                        Latest
                        Usage</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle;text-align: center;">
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

<!-- Modal Section -->
<div class="modal fade" id="cost-detail" tabindex="-1" aria-labelledby="cost-detail" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cost-detail" class="text-primary" style="color: #001F82;font-weight:600;">
                    Stock Detail</h5>
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

<div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                    style="color: #001F82;font-weight:600;">
                    Import Stock Take Adjustment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"><small>Maximum size of each file = 3000000 bytes (3 mb). Allowed File types which
                        can
                        be uploaded = .xlsx</small></p>
                <input type="file" class="custom-file-input" id="file" name="file" data-toggle="custom-file-input"
                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                <div class="" style="margin-top: 10px;">
                    <div class="user-loader text-center" style="display: none;">
                        <i class="fa fa-spinner fa-spin"></i> <small>Please wait system is processing your
                            data...</small>
                    </div>
                    <div class="alert alert-success alert-dismissable" role="alert" id="success-result"
                        style="display: none;">
                        <div class="success-text"></div>
                    </div>
                    <div class="alert alert-danger alert-dismissable" role="alert" id="failed-result"
                        style="display: none;">
                        <div class="failed-text"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-outline-primary" id="btnUpload">Import Data</button>
            </div>
        </div>
    </div>
</div>

<form method="post" action="<?= site_url ('inventory/inventory_export'); ?>" id="export-form">
    <div class="modal fade" id="modal-export-report" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                        style="color: #001F82;font-weight:600;">
                        Export Inventory Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input placeholder="dd-mm-yyyy" type="text" class="form-control"
                                            id="floatingInputDate" name="from">
                                        <label for="floatingInput" class="fw-bold text-primary">From</label>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input placeholder="dd-mm-yyyy" type="text" class="form-control"
                                            id="floatingInputDate2" name="to">
                                        <label for="floatingInput" class="fw-bold text-primary">To</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-outline-primary">Export Data</button>
                </div>
            </div>
        </div>
    </div>
</form>

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

    flatpickr("#floatingInputDate2", {
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

    $(document).ready(function () {
        var table = $('#example').DataTable({
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                "t" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            pageLength: 50,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ordering: false,
            scrollCollapse: true,
            scrollY: '400px',
            ajax: {
                url: "<?= site_url ('inventory/load_inventory'); ?>",
                type: "POST"
            },
            processing: true,
            serverSide: true,
            "columnDefs": [{
                targets: [0],
                createdCell: function (cell) {
                    $(cell).css('text-align', 'left');
                    $(cell).css('vertical-align', 'middle');
                    $(cell).css('white-space', 'nowrap');
                }
            }],
            language: {
                emptyTable: "Please select data on search bar first",
                zeroRecords: "Nothing to display here 😢",
                processing: `<i class="fa fa-spinner fa-spin"></i> Loading data...`
            }
        });

        $('#example_filter').hide();
        // $('#example_length').remove();

        $('#entriesSelect').on('change', function () {
            var length = $(this).val();
            table.page.len(length).draw();
        });

        // Submit form via AJAX
        $('#searchInventory').submit(function (e) {
            e.preventDefault();
            // table.ajax.reload(); // Reload DataTable            
            $.ajax({
                url: '<?= site_url ('inventory/search_inventory'); ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    table.ajax.reload(null, false); // Reload DataTable
                }
            });
        });

        Highcharts.setOptions({
            colors: ['#C0CDD9', '#8EAACF', '#DAEAFF', '#7E99B1', '#64E572', '#D8DFE7', '#7E9AB2']
        });

        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                custom: {},
                backgroundColor: 'transparent',
                events: {
                    render() {
                        const chart = this,
                            series = chart.series[0];
                        let customLabel = chart.options.chart.custom.label;
                    }
                }
            },
            credits: { enabled: false },
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
                enabled: true
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
                        enabled: false,
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
                name: 'Total Item (%)',
                colorByPoint: true,
                innerSize: '50%',
                data: [
                    <?php foreach ($kpi as $k => $v)
                    { ?>
                                                                                                                                                                                                                                                                            {
                            name: '<?php echo $v->status; ?>',
                            y: <?php echo $v->total; ?>,
                        },
                    <?php } ?>]
            }]
        });
    });

</script>