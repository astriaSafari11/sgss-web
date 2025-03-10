<?php $this->load->view('_partials/head.php'); ?>
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card text-bg-light">
                  <div class="card-header">
                    <h3 class="card-title">General Information</h3>
                  </div>                  
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8">
                        <div class="row">
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo mDate($order->date); ?>" disabled>
                              <label for="floatingInput">Date of Request</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->requestor; ?>" disabled>
                              <label for="floatingInput">Requestor</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->purchase_reason; ?>" disabled>
                              <label for="floatingInput">Purchase Reason</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->requested_for; ?>" disabled>
                              <label for="floatingInput">Requested For</label>
                            </div>
                          </div>
                          <!--end::Col-->    
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->remarks; ?>" disabled>
                              <label for="floatingInput">Remarks</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->area; ?>" disabled>
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
                              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->attachment_file; ?>" disabled>
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
                <div class="card text-bg-light">
                  <div class="card-header">
                    <h3 class="card-title">Item Information</h3>
                  </div>                  
                  <div class="card-body">
                    <table class="table table-bordered" style="width:100%">
                      <thead>
                          <tr >
                              <th style="color: #fff;background-color:#757474;text-align: center;">Item</th>
                              <th style="color: #fff;background-color:#757474;text-align: center;">Qty</th>
                              <th style="color: #fff;background-color:#757474;text-align: center;">UoM</th>
                              <th style="color: #fff;background-color:#757474;text-align: center;">Vendor</th>
                              <th style="color: #fff;background-color:#757474;text-align: center;">UoM Price</th>
                              <th style="color: #fff;background-color:#757474;text-align: center;">Total Price</th>
                              <th style="color: #fff;background-color:#757474;text-align: center;">Purchase Reason</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach($order_detail as $row) { ?>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;"><?php echo $row->item_name; ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?php echo $row->qty; ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?php echo $row->uom; ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?php echo $row->vendor_code; ?> - <?php echo $row->vendor_name; ?></td>
                                <td style="vertical-align: middle;text-align: right;"><?php echo myNum($row->uom_price); ?></td>
                                <td style="vertical-align: middle;text-align: right;"><?php echo myNum($row->total_price); ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?php echo $order->purchase_reason; ?></td>
                            </tr>                            
                          <?php } ?>
                      </tbody>  
                      </table>              
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
            <form method="POST" action="<?php echo site_url('goods_management/feedback_update/'._encrypt($order->id)); ?>">
              <div class="row">
                <div class="col-12 mb-4">
                  <!-- Default box -->
                  <div class="card text-bg-light">
                    <div class="card-header">
                      <h3 class="card-title">Approval</h3>
                    </div>                  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-8">
                          <div class="row">
                            <!--begin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myDate($order->approved_date); ?>" disabled>
                                <label for="floatingInput">Date of Approval</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="(auto-approved)" disabled>
                                <label for="floatingInput">Approved By</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="input PO GR Number" name="po_gr" value="" >
                                <label for="floatingInput">PO GR:</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--hin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="(auto-approved)" disabled>
                                <label for="floatingInput">As</label>
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
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" disabled><?php echo $order->approved_remark; ?></textarea>
                                <label for="floatingInput">Remarks</label>
                              </div>
                            </div>
                            <!--end::Col-->
                          </div>                    
                        </div>           
                      </div>                     
                    </div>
                    <div class="card-footer text-end text-white">
                      <button class="btn btn-sm btn-secondary custom-btn" type="submit" name="submit" style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;">
                          Submit Feedback
                      </button>
                    </div>                    
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>     
            </form>                 
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