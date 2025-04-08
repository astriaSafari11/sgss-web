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
<form action="<?= site_url ('goods_management/add_transaction'); ?>" method="post" class="needs-validation" novalidate>
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
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <select id="filterItem" class="form-select" name="item[]">
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
                                <div class="col-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingQty" name="qty[]"
                                            required>
                                        <label for="floatingQty" class="fw-bold text-primary"
                                            style="font-size: 14px;">Qty</label>
                                    </div>
                                </div>

                                <!-- btn add filter (hanya muncul di baris pertama) -->
                                <button class="btn btn-outline-primary add-row" type="button" style="height: 100%;">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">No, Cancel.</button>
                    <button type="submit" name="submit" class="btn btn-outline-primary">Yes, Submit
                        Transaction.</button>
                </div>
            </div>
        </div>
    </div>
</form>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function () {
        $(document).on("click", ".add-row", function () {
            var newRow = $(".search-row:first").clone();
            newRow.find("input").val(""); // Kosongkan input
            newRow.find(".add-row").removeClass("add-row btn-outline-primary").addClass("remove-row btn-outline-danger").html('<i class="fas fa-minus"></i>');
            $("#addContainer").append(newRow);
        });

        $(document).on("click", ".remove-row", function () {
            $(this).closest(".search-row").remove();
        });

        $('#filterItem').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
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

        Highcharts.chart('container1', {
            chart: {
                type: 'pie',
                custom: {},
                events: {
                    render() {
                        const chart = this,
                            series = chart.series[0];
                        let customLabel = chart.options.chart.custom.label;

                        // if (!customLabel) {
                        //     customLabel = chart.options.chart.custom.label =
                        //         chart.renderer.label(
                        //             'Total<br/>' +
                        //             '<strong>2 877 820</strong>'
                        //         )
                        //             .css({
                        //                 color: '#000',
                        //                 textAnchor: 'middle'
                        //             })
                        //             .add();
                        // }

                        // const x = series.center[0] + chart.plotLeft,
                        //     y = series.center[1] + chart.plotTop -
                        //     (customLabel.attr('height') / 2);

                        // customLabel.attr({
                        //     x,
                        //     y
                        // });
                        // // Set font size based on chart diameter
                        // customLabel.css({
                        //     fontSize: `${series.center[2] / 12}px`
                        // });
                    }
                }
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
                innerSize: '20%',
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
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

        Highcharts.chart('container2', {
            chart: {
                type: 'bar',
                custom: {},
                events: {
                    render() {
                        const chart = this,
                            series = chart.series[0];
                        let customLabel = chart.options.chart.custom.label;

                        // if (!customLabel) {
                        //     customLabel = chart.options.chart.custom.label =
                        //         chart.renderer.label(
                        //             'Total<br/>' +
                        //             '<strong>2 877 820</strong>'
                        //         )
                        //             .css({
                        //                 color: '#000',
                        //                 textAnchor: 'middle'
                        //             })
                        //             .add();
                        // }

                        const x = series.center[0] + chart.plotLeft,
                            y = series.center[1] + chart.plotTop -
                                (customLabel.attr('height') / 2);

                        customLabel.attr({
                            x,
                            y
                        });
                        // Set font size based on chart diameter
                        customLabel.css({
                            fontSize: `${series.center[2] / 12}px`
                        });
                    }
                }
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
        let originalSizes = [];

        if (sidebar) {
            // Menyimpan ukuran asli dari semua chart
            Highcharts.charts.forEach((chart, index) => {
                if (chart) {
                    originalSizes[index] = {
                        width: chart.chartWidth,
                        height: chart.chartHeight
                    };
                }
            });

            sidebar.addEventListener("mouseenter", function () {
                Highcharts.charts.forEach((chart, index) => {
                    if (chart) {
                        // Kurangi ukuran lebar 20%
                        let newWidth = originalSizes[index].width * 0.8;
                        let newHeight = newWidth * 1;
                        chart.setSize(newWidth, newHeight, false);

                        // Set margin/padding menjadi 0 dan align center
                        chart.renderTo.style.margin = '0';
                        chart.renderTo.style.padding = '0';
                        chart.renderTo.style.display = 'block';
                        chart.renderTo.style.marginLeft = 'auto';
                        chart.renderTo.style.marginRight = 'auto';
                    }
                });
            });

            sidebar.addEventListener("mouseleave", function () {
                Highcharts.charts.forEach((chart, index) => {
                    if (chart) {
                        let newWidth = originalSizes[index].width;
                        let newHeight = originalSizes[index].height;
                        chart.setSize(newWidth, newHeight, false);

                        // Set margin/padding kembali ke normal
                        chart.renderTo.style.margin = '';
                        chart.renderTo.style.padding = '';
                        chart.renderTo.style.display = '';
                        chart.renderTo.style.marginLeft = '';
                        chart.renderTo.style.marginRight = '';
                    }
                });
            });
        }
    };


</script>