<?php $this->load->view('_partials/head.php'); ?>

<div class="row">
              <div class="col-md-8 col-sm-12 col-12">
                <span class="btn mb-2" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">KPI</span>  
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
                <span class="btn mb-2" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">YoY Consumption</span>  
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

                    <!-- btn add new tr -->
                    <div class="d-flex justify-content-between">
                        <p class="text-primary fw-bold fs-5">TRANSACTIONS</p>
                        <a href="#" class="btn btn-sm btn-outline-primary position-relative mb-3" style="font-weight: 600; border-radius: 50px; white-space:nowrap">
                            <i class="fa-solid fa-circle-plus"></i>
                            Add New Transactions
                        </a>
                    </div>
                    <!-- end btn add new tr -->

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
</script>