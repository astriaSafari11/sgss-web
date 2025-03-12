<div class="row">
              <div class="col-md-9 col-sm-12 col-12">
                <span class="btn mb-2" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">KPI</span>  
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

              <div class="col-md-3 col-sm-12 col-12">
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
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->               
            </div>
<!--begin::Row-->
<div class="row">
              <div class="col-12 mb-2">
                <!-- Default box -->
                <div class="card">
                  <!-- <div class="card-header">
                    <div class="card-tools">
                      <button type="button" class="btn btn-sm btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;">
                        Export
                      </button>                       
                      <button type="button" class="btn btn-sm btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px;width: 150px;">
                        Import
                      </button>                       
                    </div>
                  </div> -->
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                    <!-- Start Dropdown Show X Entries -->
                    <div class="d-flex align-items-center">
                        <label for="entriesSelect" class="me-2 fs-7">Show</label>
                        <select id="entriesSelect" class="form-select form-select-sm w-auto fs-7">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="ms-2 fs-7">entries</span>
                    </div>
                    <!-- End Dropdown Show X Entries -->

                    <!-- Start Search + Filter -->
                    <div class="d-flex align-items-center gap-2">
                    <!-- Filter 1 -->
                    <label for="filterBy1" class="small">Filter 1:</label>
                    <select id="filterBy1" class="form-select form-select-sm w-auto">
                        <option value="all">All</option>
                        <option value="0">Column 1</option>
                        <option value="1">Column 2</option>
                        <option value="2">Column 3</option>
                    </select>

                    <!-- Filter 2 -->
                    <label for="filterBy2" class="small">Filter 2:</label>
                    <select id="filterBy2" class="form-select form-select-sm w-auto">
                        <option value="all">All</option>
                        <option value="A">Category A</option>
                        <option value="B">Category B</option>
                        <option value="C">Category C</option>
                    </select>

                    <!-- Filter 3 -->
                    <label for="filterBy3" class="small">Filter 3:</label>
                    <select id="filterBy3" class="form-select form-select-sm w-auto">
                        <option value="all">All</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>

                    <!-- Search Button -->
                    <button class="btn btn-outline-primary btn-sm" type="button" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                  <!--End Search Bar-->
                  </div>

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
                          <tr >
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Code</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Current On-Hand Stock</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Safety Stock</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Most Recent Transactions</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Status</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Action</th>                              
                          </tr>
                      </thead>
                      <tbody>
                      <?php foreach($item as $k => $v){ ?>
                            <tr>
                              <td style="vertical-align: middle;text-align: center;">
                                <a href="<?= site_url('goods_management/stock_card_detail/'._encrypt($v->id));?>" class="underline-custom">
                                  <?php echo $v->item_code;?></td>
                                </a> 
                              <td style="vertical-align: middle;text-align: center;"><?php echo $v->item_name;?></td>
                              <td style="vertical-align: middle;text-align: center;"><?php echo $v->stock_on_hand;?></td>
                              <td style="vertical-align: middle;text-align: center;"><?php echo $v->uom;?></td>
                              <td style="vertical-align: middle;text-align: center;"><?php echo $v->current_safety_stock;?></td>
                              <td style="vertical-align: middle;text-align: center;">0</td>
                              <td style="vertical-align: middle;text-align: center;">
                                <?php if($v->status == 'ok'){ ?> 
                                    <button class="btn btn-sm btn-success" style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        Ok
                                    </button>                                
                                <?php } ?>
                                <?php if($v->status == 'overstock'){ ?> 
                                    <button class="btn btn-sm btn-warning" style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        OVERSTOCK
                                    </button>                                
                                <?php } ?>
                                <?php if($v->status == 'understock'){ ?> 
                                    <button class="btn btn-sm btn-danger" style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        UNDERSTOCK
                                    </button>                                
                                <?php } ?>                                
                              </td>
                              <td style="vertical-align: middle;text-align: center;">                
                                <a href="#" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 150px;">
                                    EDIT
                                </a>  
                              </td>
                          </tr>

                      <?php } ?>
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

            <script>

$(document).ready(function() {
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