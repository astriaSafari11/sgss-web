<?php $this->load->view('_partials/head.php'); ?>
<div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary position-relative" style="font-weight: 600; border-radius: 50px;">
                  Request List
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> 5
                  <span class="visually-hidden">unread messages</span>
                  </span>
                </a>                
                <a href= "gm-performance-dashboard-feedback.php" class="btn btn-secondary position-relative" style="font-weight: 600; border-radius: 50px; color: #001F82;">
                  Feedback List
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> 5
                  <span class="visually-hidden">unread messages</span>
                  </span>
                </a>                  
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Goods Management</li>
                  <li class="breadcrumb-item active" aria-current="page">Performance Dashboard</li>
                </ol>
              </div>
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">
                  <div class="card-header">
                    <div class="card-tools">
                      <button type="button" class="btn btn-danger position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;">
                        Export
                      </button>                       
                      <button type="button" class="btn btn-danger position-relative" style="font-weight: 600; border-radius: 50px;width: 150px;">
                        Import
                      </button>                       
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr >
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Due Date</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Until Due Date</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Item Code</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Qty</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Status</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                              <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                              <td style="vertical-align: middle;text-align: center;">ALK001</td>
                              <td style="vertical-align: middle;text-align: center;">Alkohol</td>
                              <td style="vertical-align: middle;text-align: center;">100</td>
                              <td style="vertical-align: middle;text-align: center;">ml</td>
                              <td style="vertical-align: middle;text-align: center;background-color: #ed2f2f;">Urgent</td>
                              <td style="vertical-align: middle;text-align: center;">                
                                <a href="gm-performance-dashboard-feedback-form.php" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                                ORDER NOW
                                </a>  
                                <button type="button" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                                  IGNORE
                                </button>  
                              </td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                            <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                            <td style="vertical-align: middle;text-align: center;">ALK001</td>
                            <td style="vertical-align: middle;text-align: center;">Alkohol</td>
                            <td style="vertical-align: middle;text-align: center;">100</td>
                            <td style="vertical-align: middle;text-align: center;">ml</td>
                            <td style="vertical-align: middle;text-align: center;background-color: #ed2f2f;">Urgent</td>
                            <td style="vertical-align: middle;text-align: center;">                
                              <a href="gm-performance-dashboard-feedback-form.php" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                                ORDER NOW
                                </a>
                              <button type="button" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                                IGNORE
                              </button>  
                            </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                          <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                          <td style="vertical-align: middle;text-align: center;">ALK001</td>
                          <td style="vertical-align: middle;text-align: center;">Alkohol</td>
                          <td style="vertical-align: middle;text-align: center;">100</td>
                          <td style="vertical-align: middle;text-align: center;">ml</td>
                          <td style="vertical-align: middle;text-align: center;background-color: #ed2f2f;">Urgent</td>
                          <td style="vertical-align: middle;text-align: center;">                
                            <a href="gm-performance-dashboard-feedback-form.php" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                                ORDER NOW
                                </a> 
                            <button type="button" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                              IGNORE
                            </button>  
                          </td>
                      </tr>
                      <tr>
                        <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                        <td style="vertical-align: middle;text-align: center;">2011-04-25</td>
                        <td style="vertical-align: middle;text-align: center;">ALK001</td>
                        <td style="vertical-align: middle;text-align: center;">Alkohol</td>
                        <td style="vertical-align: middle;text-align: center;">100</td>
                        <td style="vertical-align: middle;text-align: center;">ml</td>
                        <td style="vertical-align: middle;text-align: center;background-color: #fa9f1d;">Medium</td>
                        <td style="vertical-align: middle;text-align: center;">                
                          <button type="button" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                          ORDER NOW
                          </button>  
                          <button type="button" class="btn btn-sm btn-secondary" style="border-radius: 50px; color: #001F82;">
                            IGNORE
                          </button>  
                        </td>
                    </tr>  
                    <!--                                            
                      <tfoot>
                        <tr >
                          <th style="color: #fff;background-color: #001F82;text-align: center;">Due Date</th>
                          <th style="color: #fff;background-color: #001F82;text-align: center;">Until Due Date</th>
                          <th style="color: #fff;background-color: #001F82;text-align: center;">Item Code</th>
                          <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                          <th style="color: #fff;background-color: #001F82;text-align: center;">Qty</th>
                          <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                          <th style="color: #fff;background-color: #001F82;text-align: center;">Status</th>
                          <th style="color: #fff;background-color: #001F82;text-align: center;">Action</th>
                      </tr>
                      </tfoot>
                    -->
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
            <div class="row">
              <div class="col-12 mb-4">
                <span class="btn btn-primary" style="border-radius: 50px;width: 100%;font-weight: 600;">KPI RESULT</span>  
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12 col-12">
                <span class="btn btn-info mb-2" style="border-radius: 50px;width: 100%;font-weight: 600;color: #fff;">COST</span>  
                <div class="info-box" style="border-radius: 25px;">
                  <div class="info-box-content" style="color: #001F82;">
                    <figure class="highcharts-figure">
                      <div id="container"></div>
                    </figure>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-4 col-sm-12 col-12">
                <span class="btn btn-info mb-2" style="border-radius: 50px;width: 100%;font-weight: 600;color: #fff;">SERVICE</span>  
                <div class="info-box" style="border-radius: 25px;">
                  <div class="info-box-content" style="color: #001F82;">
                    <figure class="highcharts-figure1">
                      <div id="container1"></div>
                    </figure>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
              <div class="col-md-4 col-sm-12 col-12">
                <span class="btn btn-info mb-2" style="border-radius: 50px;width: 100%;font-weight: 600;color: #fff;">CASH</span>  
                <div class="info-box" style="border-radius: 25px;">
                  <div class="info-box-content" style="color: #001F82;">
                    <figure class="highcharts-figure2">
                      <div id="container2"></div>
                    </figure>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div> 
              <!-- /.col -->               
            </div>
            <!--end::Row-->  

<?php $this->load->view('_partials/footer.php'); ?>

<script>
      $(document).ready(function() {
          $('#example').DataTable();

          Highcharts.setOptions({
            colors: ['#001F82', '#123e68', '#1b5885', '#3277a1', '#64E572', '#5293bb', '#6db2d9', '#89cff0']
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