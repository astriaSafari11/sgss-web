<?php $this->load->view ('_partials/head.php'); ?>

<!-- efek tambahan untuk widget -->
<style>
  .step-circle {
    transition: all 0.3s ease;
  }

  .step-circle:hover {
    transform: scale(1.1);
    box-shadow: 0 0 10px rgba(0, 31, 130, 0.4);
  }
</style>

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
                  <input type="text" class="form-control" id="floatingInput" value="<?php echo mDate ($order->date); ?>"
                    disabled>
                  <label for="floatingInput">Date of Request</label>
                </div>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" value="<?php echo $order->requestor; ?>"
                    disabled>
                  <label for="floatingInput">Requestor</label>
                </div>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput"
                    value="<?php echo $order->purchase_reason; ?>" disabled>
                  <label for="floatingInput">Purchase Reason</label>
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
                  <input type="text" class="form-control" id="floatingInput" value="<?php echo $order->remarks; ?>"
                    disabled>
                  <label for="floatingInput">Remarks</label>
                </div>
              </div>
              <!--end::Col-->
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" value="<?php echo $order->area; ?>"
                    disabled>
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
        <table class="table table-bordered" style="width:100%">
          <thead>
            <tr>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Item</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Qty</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">UoM</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Vendor</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">UoM Price</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Total Price</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Purchase Reason</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_detail as $row)
            { ?>
              <tr>
                <td style="vertical-align: middle;text-align: center;"><?php echo $row->item_name; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $row->qty; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $row->uom; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $row->vendor_code; ?> -
                  <?php echo $row->vendor_name; ?>
                </td>
                <td style="vertical-align: middle;text-align: right;"><?php echo myNum ($row->uom_price); ?></td>
                <td style="vertical-align: middle;text-align: right;"><?php echo myNum ($row->total_price); ?></td>
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
<div class="row">
  <div class="col-12 mb-4">
    <!-- Default box -->
    <div class="card">
      <div class="card-header" style="background-color: #001F82;">
        <h3 class="card-title" style="font-weight: 600;color: #FFF;">Approval History</h3>
      </div>
      <div class="card-body">

        <!-- start widget -->
        <div class="container-fluid position-relative py-4">

          <!-- Line start -->
          <div class="position-absolute start-0 end-0" style="top: 60px; z-index: 0;">
            <!-- Garis dasar -->
            <div class="mx-auto position-relative"
              style="height: 4px; background-color: #ccc; width: calc(100% - 20%); border-radius: 2px;">
              <!-- Garis isi/progress -->
              <div id="progress-fill"
                style="height: 100%; width: 0%; background-color: gold; position: absolute; top: 0; left: 0; border-radius: 2px; transition: width 0.5s ease;">
              </div>
            </div>
          </div>
          <!-- Line end -->

          <!-- Step Flow -->
          <div class="d-flex justify-content-between align-items-start position-relative flex-wrap" style="z-index: 1;">

            <!-- Step 1 -->
            <div class="text-center flex-fill">
              <div
                class="fw-bold rounded-circle step-circle bg-secondary-subtle text-primary mx-auto mb-2 d-flex align-items-center justify-content-center fs-5"
                style="width: 70px; height: 70px; border: 2px solid #001F82;" onclick="updateProgress(0)">
                R
              </div>
              <h6 class="fw-bold text-primary mb-1">Deby Yeusy</h6>
              <div class="d-flex flex-column gap-0">
                <small>Requestor</small>
                <h9>
                  <span class="badge text-primary" style="background-color: #DDEEFF;">
                    03/04/2025
                </h9>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="text-center flex-fill">
              <div
                class="fw-bold rounded-circle step-circle text-dark mx-auto mb-2 d-flex align-items-center justify-content-center fs-5"
                style="width: 70px; height: 70px; border: 2px solid chocolate; background-color:rgb(238, 226, 56)"
                onclick="updateProgress(1)">
                WL1
              </div>
              <h6 class="fw-bold text-primary mb-1">Felicia Nathania</h6>
              <div class="d-flex flex-column gap-0">
                <small>Waiting for Approval</small>
                <h9>
                  <span class="badge text-primary" style="background-color: #DDEEFF;">
                    Due Date: 12/04/2025
                </h9>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="text-center flex-fill">
              <div
                class="fw-bold rounded-circle step-circle bg-secondary-subtle text-primary mx-auto mb-2 d-flex align-items-center justify-content-center fs-5"
                style="width: 70px; height: 70px; border: 2px solid #001F82;" onclick="updateProgress(2)">
                WL2
              </div>
              <h6 class="fw-bold text-primary mb-1">Triyanto Wibowo</h6>
              <div class="d-flex flex-column gap-0">
                <small>Inactive</small>
                <h9>
                  <span class="badge text-primary" style="background-color: #DDEEFF;">
                    Due Date: 14/04/2025
                </h9>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="text-center flex-fill">
              <div
                class="fw-bold rounded-circle step-circle bg-secondary-subtle text-primary mx-auto mb-2 d-flex align-items-center justify-content-center fs-5"
                style="width: 70px; height: 70px; border: 2px solid #001F82;" onclick="updateProgress(3)">
                WL3
              </div>
              <h6 class="fw-bold text-primary mb-1">Zulfakar Ali</h6>
              <div class="d-flex flex-column gap-0">
                <small>Inactive</small>
                <h9>
                  <span class="badge text-primary" style="background-color: #DDEEFF;">
                    Due Date: 16/04/2025
                </h9>
              </div>
            </div>

            <!-- Step 5 -->
            <div class="text-center flex-fill">
              <div
                class="rounded-circle step-circle bg-white text-success mx-auto mb-2 d-flex align-items-center justify-content-center"
                style="width: 70px; height: 70px; border: 2px solid green;" onclick="updateProgress(4)">
                <i class="bi bi-send-check-fill fs-3"></i>
              </div>
              <h6 class="fw-bold text-success mb-1">Nama?</h6>
              <div class="d-flex flex-column gap-0">
                <small>Approved</small>
                <h9>
                  <span class="badge text-white" style="background-color: green;">
                    09/04/2025
                </h9>
              </div>
            </div>

          </div>
        </div>
        <!-- end widget -->


        <table class="table table-bordered" style="width:100%">
          <thead>
            <tr>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Approval Level</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Approver Name</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Status</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Approval Due Date</th>
              <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Approved Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_approval as $row)
            { ?>
              <tr>
                <td style="vertical-align: middle;text-align: center;"><?php echo $row->approve_title; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $row->nama; ?></td>
                <td style="vertical-align: middle;text-align: center;">
                  <?php echo $row->approve_status == 'pending' ? 'Waiting for Approval' : $row->approve_status; ?>
                </td>
                <td style="vertical-align: middle;text-align: center;"> - </td>
                <td style="vertical-align: middle;text-align: center;"> - </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
<form method="POST" action="<?php echo site_url ('goods_management/feedback_update/' . _encrypt ($order->id)); ?>">
  <div class="row">
    <div class="col-12 mb-4">
      <!-- Default box -->
      <div class="card">
        <div class="card-header" style="background-color: #001F82;">
          <h3 class="card-title" style="font-weight: 600;color: #FFF;">
            <?php echo $order->status == 'rejected' ? 'Rejected' : 'Approved'; ?>
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <div class="row">
                <!--begin::Col-->
                <div class="col-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo mDate ($order->approved_date); ?>" disabled>
                    <label
                      for="floatingInput"><?php echo $order->status == 'rejected' ? 'Date of Rejection' : 'Date of Approval'; ?></label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo $order->approved_by; ?>" disabled>
                    <label
                      for="floatingInput"><?php echo $order->status == 'rejected' ? 'Rejected by' : 'Approved By'; ?></label>
                  </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="input PO GR Number"
                      name="po_gr" value="" <?php echo $order->status == 'rejected' ? 'disabled' : 'required'; ?>>
                    <label for="floatingInput">PO GR:</label>
                  </div>
                </div>
                <!--end::Col-->
                <!--hin::Col-->
                <div class="col-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput"
                      value="<?php echo $order->approve_by_title; ?>" disabled>
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
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                      style="height: 100px" disabled><?php echo $order->approved_remark; ?></textarea>
                    <label for="floatingInput">Remarks</label>
                  </div>
                </div>
                <!--end::Col-->
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
</div>
<?php $this->load->view ('_partials/footer.php'); ?>

<script>
  // Function to update the progress bar based on the step (sementara)
  function updateProgress(step) {
    const fill = document.getElementById("progress-fill");
    let width = "0%";
    let color = "#ccc";

    switch (step) {
      case 0: // Requestor
        width = "0%";
        color = "#ccc";
        break;
      case 1: // WL1
        width = "25%";
        color = "gold";
        break;
      case 2: // WL2
        width = "50%";
        color = "#001F82";
        break;
      case 3: // WL3
        width = "75%";
        color = "#001F82";
        break;
      case 4: // Approved
        width = "100%";
        color = "green";
        break;
    }

    fill.style.width = width;
    fill.style.backgroundColor = color;
  }
  //end function

  $(document).ready(function () {
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