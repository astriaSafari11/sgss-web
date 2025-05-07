<?php $this->load->view ('_partials/head.php'); ?>

<style>
  .btn-custom-download:hover {
    background-color: #001F82;
    color: white;
  }

  .btn-custom-download:hover .file-icon {
    color: white !important;
  }

  .dataTables_length label,
  .dataTables_filter label,
  .dataTables_info,
  .dataTables_paginate {
    font-size: 12px !important;
  }

  .dataTables_length select {
    font-size: 12px !important;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button {
    font-size: 12px !important;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button a {
    font-size: 12px !important;
  }

  .resetDownload {
    font-size: 12px;
    padding: 5px 10px;
    margin-left: calc(100% - 25%);
    position: relative;
    top: -50px;
  }

  .unclickable {
    pointer-events: none;
    cursor: default;
  }
</style>

<div class="row mb-2 justify-between">
  <div class="col-sm-6">
    <a href="<?= site_url ('goods_management'); ?>" class="btn btn-sm btn-outline-primary position-relative"
      style="font-weight: 600; border-radius: 50px;">
      Order List
      <?php if ($req_count > 0)
      { ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          <?php echo $req_count; ?>
          <span class="visually-hidden">unread messages</span>
        </span>
      <?php } ?>
    </a>
    <a href="#" class="btn btn-sm btn-primary position-relative" style="font-weight: 600; border-radius: 50px;">
      Feedback List
      <?php if ($feedback_count > 0)
      { ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          <?php echo $feedback_count; ?>
          <span class="visually-hidden">unread messages</span>
        </span>
      <?php } ?>
    </a>
  </div>

  <div class="col-sm-6">
    <div class="d-flex justify-content-end">

      <button onclick="DownloadAll()" class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px; width: 150px;">Download All</button>

      <button type="button" class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px; width: 150px;">
        Export
      </button>
      <button type="button" class="btn btn-sm btn-outline-primary"
        style="font-weight: 600; border-radius: 50px;width: 150px;">
        Import
      </button>
    </div>
  </div>
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
      <div class="card-body" style="height: calc(100% - 50px) !important;">
        <?php $this->load->view ('_partials/search_bar.php'); ?>

        <table id="example" class="table table-sm align-middle" style="width:100%;" cellspacing="0">
          <thead class="align-middle">
            <tr>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Requested Date</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Requested Item</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Item Group</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Quantity</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Adjustment</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Status</th>
              <th style="color: #fff;background-color: #001F82;text-align: center;">Download</th>
              <th style="color: #fff;background-color: #001F82;text-align: center; width: 10%;">Action</th>

              <!-- <th style="color: #fff;text-align: center;width: 400px;">
                                <button class="btn btn-sm btn-primary" style="font-weight: 600; border-radius: 50px; width: 100%;">
                                Action
                                </button>
                              </th> -->
            </tr>
          </thead>
          <tbody>
            <?php foreach ($feedback_list as $k => $v)
            { ?>
              <tr>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo mDate ($v->date); ?>
                </td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo $v->item_name; ?></td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo $v->item_group; ?></td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo $v->vendor_name; ?></td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo $v->qty; ?></td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo $v->uom; ?></td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;">
                  <?php echo empty ($v->adjustment) ? 'none' : $v->adjustment; ?>
                </td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;">
                  <?php if ($v->order_status == 'waiting_approval')
                  { ?>
                    <button class="btn btn-sm btn-default" style="font-weight: 600; border-radius: 50px; width: 100%;">
                      Waiting Approval
                    </button>
                  <?php } ?>
                  <?php if ($v->order_status == 'rejected')
                  { ?>
                    <button class="btn btn-sm btn-danger" style="font-weight: 600; border-radius: 50px; width: 100%;">
                      Rejected
                    </button>
                  <?php } ?>
                  <?php if ($v->order_status == 'auto_approved')
                  { ?>
                    <button class="btn btn-sm btn-success " style="font-weight: 600; border-radius: 50px; width: 100%;">
                      Auto Approved
                    </button>
                  <?php } ?>
                  <?php if ($v->order_status == 'finished')
                  { ?>
                    <button class="btn btn-sm btn-warning" style="font-weight: 600; border-radius: 50px; width: 100%;">
                      Finished
                    </button>
                  <?php } ?>
                  <?php if ($v->order_status == 'approved')
                  { ?>
                    <button class="btn btn-sm btn-default" style="font-weight: 600; border-radius: 50px; width: 100%;">
                      Waiting for Feedback
                    </button>
                  <?php } ?>
                </td>
                <td style="vertical-align: middle; text-align: center;">
                  <a href="<?= site_url ('goods_management/export_pdf/' . $v->order_id); ?>"
                    class="btn btn-sm btn-outline-primary download-btn btn-custom-download" style="border-radius: 50px;"
                    data-file="Validation_Report_<?php echo $v->order_id; ?>.pdf">
                    <?php if ($v->is_download == 0)
                    { ?>
                      <i class="fas fa-file-pdf text-primary file-icon"></i>
                    <?php } ?>
                    <?php if ($v->is_download == 1)
                    { ?>
                      <i class="fas fa-file-circle-check text-success"></i>
                    <?php } ?>
                  </a>
                </td>

                <td style="vertical-align: middle;text-align: center;">
                  <?php if ($v->order_status == 'finished' || $v->order_status == 'waiting_approval')
                  { ?>
                    <a href="<?= site_url ('goods_management/order_detail/' . _encrypt ($v->order_id)); ?>"
                      class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 250px;">
                      Detail
                    </a>
                  <?php }
                else
                  { ?>
                    <a href="<?= site_url ('goods_management/feedback_form/' . _encrypt ($v->order_id)); ?>"
                      class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 250px;">
                      Feedback
                    </a>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <!-- Tombol Reset Download -->

        <button class="btn btn-outline-danger mt-3 resetDownload mb-0" onclick="resetIcons()">
          Reset Download
        </button>
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
    <span class="btn mb-2 unclickable"
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
    <span class="btn mb-2 unclickable"
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
    <span class="btn mb-2 unclickable"
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

<!-- Modal Section -->
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
        <button type="button" class="btn btn-outline-primary" id="btnExportExcel">Export Excel</button>
        <!-- logic belum -->
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
        <button type="button" class="btn btn-outline-primary" id="btnExportExcel">Export Excel</button>
        <!-- logic belum -->
      </div>
    </div>
  </div>
</div>

<?php $this->load->view ('_partials/footer.php'); ?>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".download-btn").forEach(function (btn) {
      let fileName = btn.getAttribute("data-file");
      let icon = btn.querySelector(".file-icon");

      if (localStorage.getItem(fileName) === "downloaded") {
        icon.className = "fas fa-file-circle-check text-success";
      }

      btn.addEventListener("click", function () {
        setTimeout(() => {
          icon.className = "fas fa-file-circle-check text-success";
          localStorage.setItem(fileName, "downloaded");
        }, 500);
      });
    });
  });

  function DownloadAll() {
    let downloadLinks = document.querySelectorAll('.download-btn');

    downloadLinks.forEach((link, index) => {
      let fileName = link.getAttribute('data-file');
      let isDownloaded = localStorage.getItem(fileName);

      if (!isDownloaded) {
        setTimeout(() => {
          let url = link.getAttribute('href');
          let fileName = link.getAttribute('data-file');

          let a = document.createElement('a');
          a.href = url;
          a.download = fileName;
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);

          // Ubah ikon setelah download
          let icon = link.querySelector(".file-icon");
          icon.className = "fas fa-file-circle-check text-success";
          localStorage.setItem(fileName, "downloaded");
        }, index * 200);
      }
    });
  }

  // Fungsi untuk mereset status download dan ikon
  function resetIcons() {
    localStorage.clear();
    document.querySelectorAll(".download-btn .file-icon").forEach(function (icon) {
      icon.className = "fas fa-file-pdf text-primary";
    });
    alert("Status download telah di-reset!");
    location.reload();
  }

  // supaya card tidak kepanjangan
  function adjustCardHeight() {
    document.querySelectorAll(".adjusted-card-body").forEach(cardBody => {
      let parentCard = cardBody.closest(".card");

      if (parentCard) {
        let newHeight = parentCard.scrollHeight - 60;
        cardBody.style.height = newHeight + "px";
      }
    });
  }

  window.addEventListener("load", adjustCardHeight);
  window.addEventListener("resize", adjustCardHeight);

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
          name: 'Unnecessary',
          y: 4.0
        }, {
          name: 'Urgent',
          y: 23.0
        }, {
          name: 'To Do',
          y: 73.0
        }]
      }]
    });

    // update judul
    function showChartModal(typeName) {
      document.getElementById('chart-type-label').innerText = typeName;
      const modal = new bootstrap.Modal(document.getElementById('chartDetailModal'));
      modal.show();
    }
    // kembalikan ke ukuran awal saat modal ditutup
    document.getElementById('chartDetailModal').addEventListener('hidden.bs.modal', function () {
      const chart = Highcharts.charts.find(c => c && c.renderTo.id === 'container1');
      if (chart) {
        chart.reflow();
      }
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
    const mainContent = document.querySelector(".main-content");
    let originalSizes = [];
    let isSidebarOpen = false;

    Highcharts.charts.forEach((chart, index) => {
      if (chart) {
        originalSizes[index] = {
          width: chart.chartWidth,
          height: chart.chartHeight
        };
      }
    });

    function checkSidebarState() {
      const currentState = !sidebar.classList.contains('collapsed') && sidebar.offsetWidth >= 100;

      if (currentState !== isSidebarOpen) {
        isSidebarOpen = currentState;
        handleSidebarStateChange();
      }
    }

    function handleSidebarStateChange() {
      if (isSidebarOpen) {
        Highcharts.charts.forEach((chart, index) => {
          if (chart && originalSizes[index]) {
            let newWidth = originalSizes[index].width * 0.8;
            let newHeight = originalSizes[index].height * 0.8;
            chart.setSize(newWidth, newHeight, false);

            chart.renderTo.style.margin = '0 auto';
            chart.renderTo.style.padding = '0';
          }
        });

        mainContent.style.transform = 'scale(0.95)';
        mainContent.style.transformOrigin = 'top center';
      } else {
        Highcharts.charts.forEach((chart, index) => {
          if (chart && originalSizes[index]) {
            chart.setSize(originalSizes[index].width, originalSizes[index].height, false);
            chart.renderTo.style.margin = '';
            chart.renderTo.style.padding = '';
          }
        });

        mainContent.style.transform = 'scale(1)';
      }
    }

    if (sidebar && mainContent) {
      checkSidebarState();

      const mutationObserver = new MutationObserver(checkSidebarState);
      mutationObserver.observe(sidebar, {
        attributes: true,
        attributeFilter: ['class']
      });

      const resizeObserver = new ResizeObserver(checkSidebarState);
      resizeObserver.observe(sidebar);

      window.addEventListener('resize', checkSidebarState);
    }
  };
</script>