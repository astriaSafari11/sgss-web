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
            <?php if($order->status == "auto_approved"){ ?>
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
                            <div class="col-6 text-center">
                              <span class="text-center" style="color: #001F82;font-weight:600;font-size:32px;">AUTO-APPROVED</span>
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
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>                      
            <?php } ?>
            <?php if($order->status == "approved"){ ?>
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
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->approved_by; ?>" disabled>
                                <label for="floatingInput">Approved By</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6 text-center">
                              <span class="text-center" style="color: #001F82;font-weight:600;font-size:32px;">APPROVED</span>
                            </div>
                            <!--end::Col-->
                            <!--hin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->approve_by_title; ?>" disabled>
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
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>                      
            <?php } ?>    
            <?php if($order->status == "rejected"){ ?>
              <div class="row">
                <div class="col-12 mb-4">
                  <!-- Default box -->
                  <div class="card text-bg-light">
                    <div class="card-header">
                      <h3 class="card-title">Rejected</h3>
                    </div>                  
                    <div class="card-body">
                      <div class="row">
                        <div class="col-8">
                          <div class="row">
                            <!--begin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myDate($order->rejected_date); ?>" disabled>
                                <label for="floatingInput">Date of Rejected</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->rejected_by; ?>" disabled>
                                <label for="floatingInput">Rejected By</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6 text-center">
                              <span class="text-center" style="color:rgb(248, 0, 0);font-weight:600;font-size:32px;">REJECTED</span>
                            </div>
                            <!--end::Col-->
                            <!--hin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $order->approve_by_title; ?>" disabled>
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
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" disabled><?php echo $order->rejected_remark; ?></textarea>
                                <label for="floatingInput">Remarks</label>
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
            <?php } ?>                     
            <?php if($order->status == "waiting_approval"){ ?>
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
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="-" disabled>
                                <label for="floatingInput">Date of Approval</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="-" disabled>
                                <label for="floatingInput">Approved By</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6 text-center">
                              <span class="text-center" style="color: #001F82;font-weight:600;font-size:32px;">WAITING FOR APPROVAL</span>
                            </div>
                            <!--end::Col-->
                            <!--hin::Col-->
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="-" disabled>
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
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" disabled>Waiting for Line Manager Approval</textarea>
                                <label for="floatingInput">Remarks</label>
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
            <?php } ?>     
            <?php if($order->status == "waiting_approval" && $curr_user->role == "line_manager"){ ?>       
            <div class="row">
              <div class="col-12 mb-4">
                <div class="card text-bg-light">
                  <div class="card-header">
                    <h3 class="card-title">Approval Needed</h3>
                  </div>                  
                  <div class="card-body">
                    <h4 class="text-center" style="font-weight: 600; color:#001F82;">Do you want to approve this order?</h4>
                    <div class="text-center">
                    <a 
                        href="<?= site_url('goods_management/approval_approve/'._encrypt($order->id));?>"
                        class="btn btn-lg btn-outline-primary text-center" type="button" style="font-weight: 600; border-radius: 50px;width: 150px;">APPROVE</a>
                        <a 
                        class="btn btn-lg btn-outline-danger text-center" type="button" style="font-weight: 600; border-radius: 50px;width: 150px;" data-bs-toggle="modal" data-bs-target="#modal-reject">REJECT</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>            
          </div>
          <div class="modal fade" id="modal-reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <form action="<?= site_url('goods_management/approval_reject');?>" method="post" id="modal-reject">
                              <input type="hidden" name="id" value="<?php echo _encrypt($order->id);?>">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Reject Order Request</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                                <div class="col-12">
                                                  <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-12">
                                                      <label>Please fill your reason, to reject this order request</label>
                                                      <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="remarks" value ="">
                                                        <label for="floatingInput" class="fw-bold text-primary">Reason</label>
                                                      </div>
                                                    </div>
                                                </div>         
                                              </div>
                                              </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" name="submit" class="btn btn-outline-primary">Reject Request</button>
                                    </div>
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