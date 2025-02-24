<?php $this->load->view('_partials/head.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <!--begin::Col-->
                      
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            .flatpickr-calendar {
                background-color:rgb(255, 255, 255) !important;
            }
            .flatpickr-month {
                background-color:#001F82 !important;
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

        <div class="col-6">
            <div class="form-floating mb-3">
            <input type="date" class="form-control" id="floatingInput" placeholder="dd-mm-yyyy">
            <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Action Date</label>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#floatingInput", {
                dateFormat: "d-m-Y",   
                defaultDate: null,     
                allowInput: true,     
            onReady: function(selectedDates, dateStr, instance) {
                instance._input.value = "dd-mm-yyyy"; 
            },
            onOpen: function(selectedDates, dateStr, instance) {
                if (instance._input.value === "dd-mm-yyyy") {
                    instance._input.value = "dd-mm-yyyy"; 
                }
            },
            onChange: function(selectedDates, dateStr, instance) {
                if (instance._input.value === " ") {
                    instance._input.value = "dd-mm-yyyy"; 
                }
            }
        });
        </script>

                    
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Requestor</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Purchase Reason</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
  <div class="form-floating">
    <select class="form-select" id="floatingSelect">
      <option value="" disabled selected>Select</option>   
      <option value="1">Budi</option>
      <option value="2">Ahmad</option>
      <option value="3">Faqih</option>
    </select>
    <label for="floatingSelect" class="fw-bold text-primary" style="font-size: 14px;">Requested For</label>
  </div>
</div>

                      <!--end::Col-->    
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Remarks</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Area</label>
                        </div>
                      </div>
                      <!--end::Col-->                                                              
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Attachment</label>
                        </div>
                      </div>
                      <!--end::Col-->
                    </div>                    
                    <h3 class="mb-2 text-primary fw-bold">Item Information</h3>
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
                            <td style="vertical-align: middle;text-align: center;font-size: 14px;">Alkohol</td>
                              <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                    <span style="flex-grow: 1; text-align: center;">20</span>
                                <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </button>
                                </div>
                            </td>

                              <td style="vertical-align: middle;text-align: center;font-size: 14px;">Box</td>
                              <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                <span style="flex-grow: 1; text-align: center;">Vendor 1</span>
                            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                <i class="fa-solid fa-pen text-white"></i>
                            </button>
                            </div>
                            </td>

                              <td style="vertical-align: middle;text-align: center;font-size: 14px;">Rp. 5.000</td>
                              <td style="vertical-align: middle;text-align: center;font-size: 14px;">Rp. 500.000</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;text-align: center;font-size: 14px;">Alkohol</td>
                            <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                    <span style="flex-grow: 1; text-align: center;">20</span>
                                <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </button>
                                </div>
                            </td>

                            <td style="vertical-align: middle;text-align: center;font-size: 14px;">Box</td>
                            <td style="vertical-align: middle; text-align: center; font-size: 14px; padding: 8px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                <span style="flex-grow: 1; text-align: center;">Vendor 2</span>
                            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                <i class="fa-solid fa-pen text-white"></i>
                            </button>
                            </div>
                            </td>

                            <td style="vertical-align: middle;text-align: center;font-size: 14px;">Rp. 5.000</td>
                            <td style="vertical-align: middle;text-align: center;font-size: 14px;">Rp. 500.000</td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;text-align: center;font-size: 14px;">Alkohol</td>
                          
                        <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                <span style="flex-grow: 1; text-align: center;">20</span>
                            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                <i class="fa-solid fa-pen text-white"></i>
                             </button>
                            </div>
                        </td>

                          <td style="vertical-align: middle;text-align: center;font-size: 14px;">Box</td>
                          <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                <span style="flex-grow: 1; text-align: center;">Vendor 3</span>
                            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                <i class="fa-solid fa-pen text-white"></i>
                            </button>
                            </div>
                        </td>

                          <td style="vertical-align: middle;text-align: center;font-size: 14px;">Rp. 5.000</td>
                          <td style="vertical-align: middle;text-align: center;font-size: 14px;">Rp. 500.000</td>
                      </tr>                                                  
                      </tbody>  
                      </table>              
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-end">
                  <button class="btn btn-sm btn-secondary custom-btn" type="button" style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;" onclick="location.reload();">
                        Reset
                    </button>
                  <button class="btn btn-sm btn-secondary custom-btn" type="button" style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;">
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