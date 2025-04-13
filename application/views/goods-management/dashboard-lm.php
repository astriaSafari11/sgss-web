<?php $this->load->view ('_partials/head.php'); ?>

<div class="row mb-2 justify-between">
  <div class="col-sm-6">
    <a class="btn btn-sm btn-primary position-relative" style="font-weight: 600; border-radius: 50px;">
      Approval List
      <?php if ($req_count > 0)
      { ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          <?php echo $req_count; ?>
          <span class="visually-hidden">unread messages</span>
        </span>
      <?php } ?>
    </a>
    <!-- <a href="<?= site_url ('goods_management/feedback'); ?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px;">
                  Feedback List
                  <?php if ($feedback_count > 0)
                  { ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <?php echo $feedback_count; ?>
                      <span class="visually-hidden">unread messages</span>
                    </span>
                  <?php } ?>
                </a>                   -->
  </div>
  <div class="col-sm-6">
    <div class="d-flex justify-content-end">
      <a href="<?= site_url ('goods_management/export_goods_order_request'); ?>" class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:10px;" id="btnExport"
        onclick="btnExportClick()">
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
<div class="row">
  <div class="col-12 mb-2">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <form action="<?php echo site_url ('goods_management'); ?>" method="post">
          <?php $this->load->view ('_partials/search_bar.php', $data); ?>
        </form>
        <table id="example" class="table table-sm align-middle" style="width:100%" cellspacing="0">
          <thead class="align-middle">
            <tr>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Action Date</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">SS Days Left</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Qty</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Requestor</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Reason</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($req_list as $k => $v)
            { //debugCode($v); ?>
              <tr>
                <td style="vertical-align: middle;text-align: center;"><?php echo mDate ($v->date); ?></td>
                <td style="vertical-align: middle;text-align: center;">5 Days</td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $v->item_name; ?>   <?php echo $v->size; ?>
                  <?php echo $v->uom; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $v->qty; ?></td>
                <td style="vertical-align: middle;text-align: center;"><?php echo $v->requestor; ?></td>
                <td style="vertical-align: middle;text-align: center;">
                  <?php echo approval_category ($v->approval_category, $v->order_category, $v->purchase_reason, $v->remarks); ?>
                </td>
                <td style="vertical-align: middle;text-align: center;">
                  <a href="<?= site_url ('goods_management/order_detail/' . _encrypt ($v->order_id)); ?>"
                    class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 150px;">
                    APPROVE
                  </a>
                  <a class="btn btn-sm btn-outline-danger" style="font-weight: 600; border-radius: 50px; width: 150px;"
                    data-bs-toggle="modal" data-bs-target="#modal-reject-value-<?php echo $v->id; ?>">
                    REJECT
                  </a>
                </td>
              </tr>
              <div class="modal fade" id="modal-reject-value-<?php echo $v->id; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="<?= site_url ('goods_management/approval_reject'); ?>" method="post"
                  id="modal-reject-value-<?php echo $v->id; ?>">
                  <input type="hidden" name="id" value="<?php echo _encrypt ($v->order_id); ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" class="text-primary"
                          style="color: #001F82;font-weight:600;">Reject Order Request</h5>
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
                                  <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="remarks" value="">
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
            <?php } ?>
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
  <div class="col-12 mb-2">
    <span class="btn btn-primary" style="border-radius: 50px;width: 100%;font-weight: 600;">KPI</span>
  </div>
</div>
<div class="row">
  <div class="col-md-4 col-sm-12 col-12">
    <span class="btn mb-2"
      style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">COST</span>
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

  <div class="col-md-4 col-sm-12 col-12">
    <span class="btn mb-2"
      style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">SERVICE</span>
    <div class="info-box" style="border-radius: 25px;">
      <div class="info-box-content" style="color: #001F82;">
        <figure class="highcharts-figure1">
          <div id="container1" style="height: 250px;"></div>
        </figure>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-4 col-sm-12 col-12">
    <span class="btn mb-2"
      style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">CASH</span>
    <div class="info-box" style="border-radius: 25px;">
      <div class="info-box-content" style="color: #001F82;">
        <figure class="highcharts-figure2">
          <div id="container2" style="height: 250px;"></div>
        </figure>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<!--end::Row-->
<form id="form-upload-user" method="post" autocomplete="off" enctype="multipart/form-data">
  <div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">
            Import Order Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-danger"><small>Maximum size of each file = 3000000 bytes (3 mb). Allowed File types which can
              be uploaded = .xlsx</small></p>
          <input type="file" class="custom-file-input" id="file" name="file" data-toggle="custom-file-input"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
          <div class="" style="margin-top: 10px;">
            <div class="user-loader text-center" style="display: none;">
              <i class="fa fa-spinner fa-spin"></i> <small>Please wait system is processing your data...</small>
            </div>
            <div class="alert alert-success alert-dismissable" role="alert" id="success-result" style="display: none;">
              <div class="success-text"></div>
            </div>
            <div class="alert alert-danger alert-dismissable" role="alert" id="failed-result" style="display: none;">
              <div class="failed-text"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-outline-primary" id="btnUpload">Import Request Order</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal untuk Detail Chart -->
<div class="modal fade" id="chartDetailModal" tabindex="-1" aria-labelledby="chartDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title text-primary" id="chartDetailLabel" style="font-weight:600;">
          Status: <span id="chart-type-label">To Do</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Tabel -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center">
            <thead class="text-white" style="background-color: #001F82;">
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

<div class="modal fade" id="cost-detail" tabindex="-1" aria-labelledby="cost-detail" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cost-detail" class="text-primary" style="color: #001F82;font-weight:600;">
          Cost Detail</h5>
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

<?php $this->load->view ('_partials/footer.php'); ?>

<script>
  $(document).ready(function () {
    $("body").on("submit", "#form-upload-user", function (e) {
      e.preventDefault();
      var data = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "<?php echo site_url ('goods_management/upload') ?>",
        data: data,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $("#btnUpload").prop('disabled', true);
          $(".user-loader").show();
          $("#success-result").hide();
          $("#failed-result").hide();
        },
        success: function (result) {
          $("#btnUpload").prop('disabled', false);
          if ($.isEmptyObject(result.error_message)) {
            $("#success-result").show();
            $(".success-text").html(result.success_message);
          } else {
            $("#failed-result").show();
            $(".failed-text").html(result.error_message);
          }
          $(".user-loader").hide();
        }
      });
    });
  });
  var URL_AJAX = '<?php echo site_url (); ?>/ajax';
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
      credits: { enabled: false },
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

    // update judul
  function showChartModal(typeName) {
    document.getElementById('chart-type-label').innerText = typeName;
    const modal = new bootstrap.Modal(document.getElementById('chartDetailModal'));
    modal.show();
  }

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
      credits: { enabled: false },
      plotOptions: {
        innerSize: '20%',
        series: {
          allowPointSelect: true,
          cursor: 'pointer',
          point: {
          events: {
            click: function () {
              showChartModal(this.name);
            }
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
      credits: { enabled: false },
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

  window.onload = function () {
  const sidebar = document.querySelector(".app-sidebar");
  let originalSizes = [];

  if (sidebar) {
    // Menyimpan ukuran asli dari semua chart
    Highcharts.charts.forEach((chart, index) => {
      if (chart) {
        originalSizes[index] = {
          width: chart.chartWidth,
          height: chart.chartHeight
        };
      }
    });

    sidebar.addEventListener("mouseenter", function () {
      Highcharts.charts.forEach((chart, index) => {
        if (chart) {
          // Kurangi ukuran lebar 20%
          let newWidth = originalSizes[index].width * 0.8;
          let newHeight = newWidth * (originalSizes[index].height / originalSizes[index].width);
          chart.setSize(newWidth, newHeight, false);

          // Set margin/padding menjadi 0 dan align center
          chart.renderTo.style.margin = '0';
          chart.renderTo.style.padding = '0';
          chart.renderTo.style.display = 'block';
          chart.renderTo.style.marginLeft = 'auto';
          chart.renderTo.style.marginRight = 'auto';
        }
      });
    });

    sidebar.addEventListener("mouseleave", function () {
      Highcharts.charts.forEach((chart, index) => {
        if (chart) {
          let newWidth = originalSizes[index].width;
          let newHeight = originalSizes[index].height;
          chart.setSize(newWidth, newHeight, false);

          // Set margin/padding kembali ke normal
          chart.renderTo.style.margin = '';
          chart.renderTo.style.padding = '';
          chart.renderTo.style.display = '';
          chart.renderTo.style.marginLeft = '';
          chart.renderTo.style.marginRight = '';
        }
      });
    });
  }
};
</script>