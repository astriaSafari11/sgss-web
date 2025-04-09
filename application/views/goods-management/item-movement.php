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

    <!-- <div class="col-md-3 col-sm-12 col-12">
                <span class="btn mb-2" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">SEARCH</span>  
                <div class="info-box" style="border-radius: 25px;">
                  <div class="info-box-content" style="color: #001F82;height: 265px;">
                  <div class="row mb-3">
                          <div class="col-sm-12 mb-2" style="margin:0px;">
                            <div class="form-floating">
                              <select class="form-select" id="floatingSelect">
                                <option value="" disabled selected>ALL</option>   
                              </select>
                              <label for="floatingSelect" class="fw-bold text-primary" style="font-size: 14px;">Search by Item Code</label>
                            </div>
                          </div>
                          <div class="col-sm-12" style="margin:0px;">
                            <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                              <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Search by Item Desc</label>
                            </div>
                          </div>
                          <div class="col-sm-12" style="margin:0px;">
                            <button class="btn btn-sm btn-outline-primary" type="button" style="font-weight: 600; border-radius: 50px;width: 100%;">
                                Search
                            </button>
                          </div>
                        </div>
                  </div>
                  
                </div>
                
              </div> -->


    <!-- /.col -->
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
        <form action="<?php echo site_url ('goods_management/item_movement'); ?>" method="post">
            <?php $this->load->view ('_partials/search_bar_special.php'); ?>
        </form>

        <table id="example" class="table table-sm" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Code
                    </th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Item
                    </th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">
                        Current On-Hand Stock</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">UoM
                    </th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Safety
                        Stock</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Most
                        Recent Transactions</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Status
                    </th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset ($item))
                {
                foreach ($item as $k => $v)
                    { ?>
                        <tr>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="<?= site_url ('goods_management/stock_card_detail/' . _encrypt ($v->id)); ?>"
                                    class="underline-custom">
                                    <?php echo $v->item_code; ?>
                                </a>
                            </td>
                            <td style="vertical-align: middle;text-align: left;"><?php echo $v->item_name; ?></td>
                            <td style="vertical-align: middle;text-align: center;"><?php echo $v->stock_on_hand; ?></td>
                            <td style="vertical-align: middle;text-align: center;"><?php echo $v->uom; ?></td>
                            <td style="vertical-align: middle;text-align: center;"><?php echo $v->current_safety_stock; ?></td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="<?= site_url ('goods_management/request_detail/' . _encrypt ($v->recent_transactions)); ?>"
                                    target="_blank" class="underline-custom">
                                    <?php echo $v->recent_transactions; ?>
                                </a>

                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <?php if ($v->status == 'ok')
                                { ?>
                                    <button class="btn btn-sm btn-success"
                                        style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        Ok
                                    </button>
                                <?php } ?>
                                <?php if ($v->status == 'overstock')
                                { ?>
                                    <button class="btn btn-sm btn-warning"
                                        style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        OVERSTOCK
                                    </button>
                                <?php } ?>
                                <?php if ($v->status == 'understock')
                                { ?>
                                    <button class="btn btn-sm btn-danger"
                                        style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        UNDERSTOCK
                                    </button>
                                <?php } ?>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="#" class="btn btn-sm btn-outline-primary"
                                    style="font-weight: 600; border-radius: 50px; width: 150px;">
                                    EDIT
                                </a>
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
                <th style="color: #fff;background-color: #001F82;text-align: center;">Spend 2024 YTD</th>
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
        <button type="button" class="btn btn-outline-primary" id="btnExportExcel">Export Excel</button> <!-- logic belum -->
      </div>
    </div>
  </div>
</div>

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

        Highcharts.chart('container1', {
            chart: {
                type: 'pie',
                custom: {},
                backgroundColor: 'transparent',
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