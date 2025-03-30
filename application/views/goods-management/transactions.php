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
<div class="row info-box d-flex align-items-stretch ms-1 py-3 rounded-5">
        <div class="col-md-12 col-sm-12 col-12">
                    <!-- btn add new tr -->
                    <div class="d-flex justify-content-between">
                        <p class="text-primary fw-bold fs-5">TRANSACTIONS</p>
                        <a href="#" class="btn btn-sm btn-outline-primary position-relative mb-3" style="font-weight: 600; border-radius: 50px; white-space:nowrap">
                            <i class="fa-solid fa-circle-plus"></i>
                            Add New Transactions
                        </a>
                    </div>
                    <!-- end btn add new tr -->

                    <?php $this->load->view ('_partials/search_bar.php'); ?>

                    
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
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Code</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Item</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Current On-Hand Stock</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">UoM</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Safety Stock</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Most Recent Transactions</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Status</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Action</th>                              
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