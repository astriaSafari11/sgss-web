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
    margin-left: 70%;
    margin-bottom: 10px;
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
      <div class="card-body adjusted-card-body">
        <?php $this->load->view ('_partials/search_bar.php'); ?>

        <table id="example" class="table table-sm" style="width:100%" cellspacing="0">
          <thead>
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
                  <?php echo empty ($v->adjustment) ? 'none' : $v->adjustment; ?></td>
                <td style="vertical-align: middle;text-align: center;font-size: 14px;">
                  <?php if ($v->order_status == 'rejected')
                  { ?>
                    <button class="btn btn-sm btn-danger" style="font-weight: 600; border-radius: 50px; width: 100%;">
                      Rejected
                    </button>
                  <?php } ?>
                  <?php if ($v->order_status == 'auto_approved' || $v->order_status == 'approved')
                  { ?>
                    <button class="btn btn-sm btn-success" style="font-weight: 600; border-radius: 50px; width: 100%;">
                      Approved
                    </button>
                  <?php } ?>
                </td>
                <!-- <td style="vertical-align: middle;text-align: center;">
                                <a href="path/to/pdf/file.pdf" class="btn btn-sm btn-outline-primary" style="border-radius: 50px;" download>
                                <i class="fas fa-file-pdf"></i>
                                </a>
                              </td> -->

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
                  <a href="<?= site_url ('goods_management/feedback_form/' . _encrypt ($v->order_id)); ?>"
                    class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 250px;">
                    Feedback
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <!-- Tombol Reset Download -->

        <button class="btn btn-outline-danger mt-3 resetDownload" onclick="resetIcons()">
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
          // Kurangi ukuran lebar 25%
          let newWidth = originalSizes[index].width * 0.75;
          let newHeight = newWidth * 1;
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