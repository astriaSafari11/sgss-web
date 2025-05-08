<?php $this->load->view ('_partials/head.php'); ?>
<!--begin::Row-->
<div class="row">
    <div class="col-12 mb-4">
        <!-- Default box -->
        <div class="card">
            <div class="card-header" style="background-color: #001F82;">
                <h3 class="card-title" style="font-weight: 600;color: #FFF;">General Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo formatDate ($order->period_start); ?>" disabled>
                                    <label for="floatingInput">Period Start</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo formatDate ($order->period_end); ?>" disabled>
                                    <label for="floatingInput">Period End</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo $order->shift; ?>" disabled>
                                    <label for="floatingInput">Shift</label>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo $order->requestor; ?>" disabled>
                                    <label for="floatingInput">Requestor</label>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo $order->remarks; ?>" disabled>
                                    <label for="floatingInput">Usage Reason</label>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo $order->requested_for; ?>" disabled>
                                    <label for="floatingInput">Requested For</label>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo $order->remarks; ?>" disabled>
                                    <label for="floatingInput">Remarks</label>
                                </div>
                            </div>
                            <?php if ($order->is_feedback == 1)
                            { ?>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput"
                                            value="<?php echo $order->po_gr_number; ?>" disabled>
                                        <label for="floatingInput">PO GR</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput"
                                            value="<?php echo myNum ($order->po_gr_amount); ?>" disabled>
                                        <label for="floatingInput">PO GR Amount</label>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--end::Col-->
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        value="<?php echo $order->area; ?>" disabled>
                                    <label for="floatingInput">Area</label>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput"
                                        value="<?php echo $order->attachment_file; ?>" disabled>
                                    <label for="floatingInput">Attachment</label>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-12 mb-4">
        <!-- Default box -->
        <div class="card">
            <div class="card-header" style="background-color: #001F82;">
                <h3 class="card-title" style="font-weight: 600;color: #FFF;">Item Information</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Vendor</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Type of Service</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Service Category
                            </th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Unit Price</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Qty</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">UoM</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Subtotal</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Tax / VAT</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_detail as $row)
                        { ?>
                            <tr>
                                <td class="align-middle" style="vertical-align: middle;text-align: center;">
                                    <?php echo $row->vendor_name; ?>
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: center;">
                                    <?php echo $row->item_name; ?>
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: center;">
                                    <?php echo $row->service_type; ?>
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: center;">
                                    <?php echo myNum ($row->uom_price); ?>
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: center;">
                                    <?php echo $row->uom; ?>
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: right;">
                                    <?php echo myNum ($row->qty); ?>
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: center;">
                                    <?php echo myNum ($row->sub_total); ?>
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: right;">
                                    <?php echo myNum ($row->tax); ?> %
                                </td>
                                <td class="align-middle" style="vertical-align: middle;text-align: center;">
                                    <?php echo myNum ($row->total_price); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<?php if ($order->status == "approved")
        { ?>
    <form method="POST" action="<?php echo site_url ('service_management/feedback_update/' . _encrypt ($order->id)); ?>">
        <div class="row">
            <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header" style="background-color: #001F82;">
                        <h3 class="card-title" style="font-weight: 600;color: #FFF;">Feedback</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="po_gr_number"
                                                value="">
                                            <label for="floatingInput">PO GR Number</label>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control grAmount" id="floatingInput"
                                                name="po_gr_amount" value="">
                                            <label for="floatingInput">PO GR AMOUNT</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end text-white">
                        <button class="btn btn-sm btn-outline-primary custom-btn" type="submit" name="submit" <?php echo $order->status == 'rejected' ? 'disabled' : ''; ?>
                            style="font-weight: 600; border-radius: 50px; width: 150px;">
                            Submit Feedback
                        </button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </form>
<?php } ?>

<?php $this->load->view ('_partials/footer.php'); ?>

<script>
    $(document).ready(function () {
        $('#example').DataTable();

        Highcharts.setOptions({
            colors: ['#C0CDD9', '#8EAACF', '#DAEAFF', '#7E99B1', '#64E572', '#D8DFE7', '#7E9AB2']
        });

        $(".grAmount").on('keyup', function () {
            var val = this.value;
            val = val.replace(/[^0-9\.]/g, '');

            if (val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
                val = valArr.join('.');
            }

            this.value = val;
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
</script>