<?php $this->load->view('_partials/head.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
    .select2-container--bootstrap-5 .select2-selection {
      width: 100%;
      min-height: calc(1.5em + .75rem + 2px);
      padding: .375rem .75rem;
      font-family: inherit;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      transition: border-color .15sease-in-out, box-shadow .15sease-in-out;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      height: 58px;
    }                            
    .select2-container .select2-selection--single .select2-selection__rendered {
      display: block;
      /* padding-left: 8px;
      padding-right: 20px; */
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      margin-top: 18px;
    }
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
            <form action="<?php echo site_url('goods_management/submit_order'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="hidden" name="planned_id" value="<?php echo $order_detail->planned_id; ?>">
            <input type="hidden" name="order_id" value="<?php echo $order_detail->id; ?>">
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
                            <input type="text" class="form-control" id="floatingInputDate" placeholder="dd-mm-yyyy" name="date" required>
                            <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Action Date</label>
                        </div>
                        </div>
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="name" class="form-control" id="floatingInput" placeholder="Requestor Name" value="<?php echo $this->session->userdata('user_name'); ?>" readonly>
                          <label for="floatingInput" class="fw-bold text-primary" name="requestor" style="font-size: 14px;">Requestor</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="purchase-reason" data-placeholder="Choose Purchase Reason" name="purchase_reason" required>
                                <option></option>
                                <?php foreach ($purchase_reason as $row) { ?>
                                    <option value="<?php echo $row->purchase_reason; ?>"><?php echo $row->purchase_reason; ?></option>
                                <?php } ?>
                            </select>
                            <label for="floatingSelect" class="fw-bold text-primary" style="font-size: 14px;">Purchase Reason</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="requested-for" data-placeholder="Choose Requested For" name="requested_for" required>
                                <option></option>
                                <?php foreach ($user_list as $row) { ?>
                                    <option value="<?php echo $row->nip; ?>"><?php echo $row->nama; ?> - <?php echo $row->email; ?></option>
                                <?php } ?>

                            </select>
                            <label for="floatingSelect" class="fw-bold text-primary" style="font-size: 14px;">Requested For</label>
                        </div>
                        </div>
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="name" class="form-control" id="floatingInput" placeholder="name@example.com" name="remarks">
                          <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Remarks</label>
                        </div>
                      </div>
                      <!--end::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="name" class="form-control" id="floatingInput" placeholder="name@example.com" name="area" value="<?php echo $area->area_code; ?>" readonly>
                          <label for="floatingInput" class="fw-bold text-primary" style="font-size: 14px;">Area</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="mb-3">
                            <label for="attachmentInput" class="fw-bold text-primary" style="font-size: 14px;">Attachment</label>
                            <div class="input-group" >
                                <input type="file" name="attachment" class="form-control d-none" id="attachmentInput" accept="*/*" style="width: 100%;">
                                <input type="text" class="form-control" placeholder="Choose file..." readonly>
                                <button class="btn btn-primary" type="button" id="uploadBtn">
                                    <i class="bi bi-upload"></i>
                                </button>
                            </div>
                    </div>
                    </div>                    
                    <h3 class="mb-2 text-primary fw-bold">Item Information</h3>
                    <table class="table table-bordered" style="width:100%">
                      <thead>
                          <tr >
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Qty</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">UoM Price (Rp.)</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;">Total Price (Rp.)</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($order as $row) { ?>
                            <tr>
                            <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo $row->item_name; ?></td>
                              <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                    <span style="flex-grow: 1; text-align: center;"><?php echo $row->qty; ?></span>
                                <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </button>
                                </div>
                            </td>

                              <td style="vertical-align: middle;text-align: center;font-size: 14px;"><?php echo $row->uom; ?></td>
                              <td style="vertical-align: middle; font-size: 14px; padding: 8px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                <span style="flex-grow: 1; text-align: center;"><?php echo $row->vendor_code; ?></span>
                            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2.1" style="margin-left: 3px;">
                                <i class="fa-solid fa-pen text-white"></i>
                            </button>
                            </div>
                            </td>

                              <td style="vertical-align: middle;text-align: right;font-size: 14px;"><?php echo myNum($row->price_per_uom); ?></td>
                              <td style="vertical-align: middle;text-align: right;font-size: 14px;"><?php echo myNum($row->moq*$row->price_per_uom); ?></td>
                          </tr>
                        <?php } ?>                                                
                      </tbody>  
                      </table>              
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-end">
                  <button class="btn btn-sm btn-danger custom-btn-danger" type="button" style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;" onclick="location.reload();">
                        Reset
                    </button>
                  <button class="btn btn-sm btn-secondary custom-btn" type="submit" style="font-weight: 600; border-radius: 50px; color:#001F82; width: 150px;">
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

                        .custom-btn-danger {
                            color: #DC3545; 
                            border: 2px solid #001F82; 
                            background-color: transparent;
                            transition: all 0.3s ease-in-out;
                        }

                        .custom-btn-danger:hover {
                            background-color: #DC3545;
                            color: white !important;
                        }
                    </style>
                   
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!-- /.card -->
              </div>
            </div>   
            </form> 
<?php $this->load->view('_partials/footer.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#floatingInputDate", {
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
                    <script>
                        document.getElementById("uploadBtn").addEventListener("click", function() {
                            document.getElementById("attachmentInput").click();
                        });

                        // Menampilkan nama file yang diunggah
                        document.getElementById("attachmentInput").addEventListener("change", function() {
                            let fileName = this.files.length > 0 ? this.files[0].name : "Choose file...";
                            this.nextElementSibling.value = fileName;
                        });
                    </script>        
<script>    
      $(document).ready(function() {
        $( '#purchase-reason' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        });

        $( '#requested-for' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        });
      });
  </script>
  <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (() => {
                      'use strict';

                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                      const forms = document.querySelectorAll('.needs-validation');

                      // Loop over them and prevent submission
                      Array.from(forms).forEach((form) => {
                        form.addEventListener(
                          'submit',
                          (event) => {
                            if (!form.checkValidity()) {
                              event.preventDefault();
                              event.stopPropagation();
                            }

                            form.classList.add('was-validated');
                          },
                          false,
                        );
                      });
                    })();
                  </script>