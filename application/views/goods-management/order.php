<?php $this->load->view('_partials/head.php'); ?>
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary">Action Date</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary">Requestor</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary">Purchase Reason</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
  <div class="form-floating">
    <select class="form-select" id="floatingSelect">
      <option value="" disabled selected>--</option>
      <option value="1">Budi</option>
      <option value="2">Ahmad</option>
      <option value="3">Faqih</option>
    </select>
    <label for="floatingSelect" class="fw-bold text-primary">Requested For</label>
  </div>
</div>

                      <!--end::Col-->    
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary">Remarks</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary">Area</label>
                        </div>
                      </div>
                      <!--end::Col-->                                                              
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary">Attachment</label>
                        </div>
                      </div>
                      <!--end::Col-->
                    </div>                    
                    <h3 class="mb-2 text-primary font-bold">Item Information</h3>
                    <table class="table table-bordered" style="width:100%">
                      <thead>
                          <tr >
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Qty</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">UoM Price</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Total Price</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td style="vertical-align: middle;text-align: center;">Alkohol</td>
                              <td style="vertical-align: middle;text-align: center;">
                                20 <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;"><i class="fa-solid fa-pen text-white"></i></button>
                              </td>
                              <td style="vertical-align: middle;text-align: center;">Box</td>
                              <td style="vertical-align: middle;text-align: center;">
                                Vendor 1 <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;"><i class="fa-solid fa-pen text-white"></i></button>
                              </td>
                              <td style="vertical-align: middle;text-align: center;">Rp. 5.000</td>
                              <td style="vertical-align: middle;text-align: center;">Rp. 500.000</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;text-align: center;">Alkohol</td>
                            <td style="vertical-align: middle;text-align: center;">
                              20 <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;"><i class="fa-solid fa-pen text-white"></i></button>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">Box</td>
                            <td style="vertical-align: middle;text-align: center;">
                              Vendor 2 <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;"><i class="fa-solid fa-pen text-white"></i></button>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">Rp. 5.000</td>
                            <td style="vertical-align: middle;text-align: center;">Rp. 500.000</td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;text-align: center;">Alkohol</td>
                          <td style="vertical-align: middle;text-align: center;">
                            20 <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;"><i class="fa-solid fa-pen text-white"></i></button>
                          </td>
                          <td style="vertical-align: middle;text-align: center;">Box</td>
                          <td style="vertical-align: middle;text-align: center;">
                            Vendor 3 <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;"><i class="fa-solid fa-pen text-white"></i></button>
                          </td>
                          <td style="vertical-align: middle;text-align: center;">Rp. 5.000</td>
                          <td style="vertical-align: middle;text-align: center;">Rp. 500.000</td>
                      </tr>                                                  
                      </tbody>  
                      </table>              
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-end">
                  <button class="btn btn-lg btn-secondary custom-btn" type="button" style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;">
                        Reset
                    </button>
                  <button class="btn btn-lg btn-secondary custom-btn" type="button" style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;">
                        Submit
                    </button>

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
                    </style>
                   
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!-- /.card -->
              </div>
            </div>   

<?php $this->load->view('_partials/footer.php'); ?>

<script>
      $(document).ready(function() {
          $('#example').DataTable();

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