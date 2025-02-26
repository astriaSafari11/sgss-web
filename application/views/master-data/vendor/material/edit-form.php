<div class="row mb-2">
              <div class="col-sm-6">
                <?php $this->load->view('master-data/vendor/material/_headers_part.php'); ?>                     
              </div>
              <div class="col-sm-6">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3">
                <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
                  General Information
                </a> 
              </div>
            </div>            
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">                 
                  <form action="<?= site_url('master_data/update_vendor_material');?>" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="id" value="<?php echo $vendor->id;?>">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="row">
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->vendor_code;?>" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Vendor Code</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->vendor_name;?>" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Vendor Name</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->item_code;?>" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Item Code</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->item_name;?>" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Item Name</label>
                              </div>
                            </div>
                            <!--end::Col-->     
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="moq" value ="<?php echo $material->moq;?>">
                                <label for="floatingInput" class="fw-bold text-primary">MOQ</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control pricePerUom" id="floatingInput" placeholder="name@example.com" name="price_per_uom" id="price_per_uom" value ="<?php echo myNum($material->price_per_uom);?>">
                                <label for="floatingInput" class="fw-bold text-primary">Price Per UoM</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control priceEqualUom" id="floatingInput" placeholder="name@example.com" name="price_equal_moq" value ="<?php echo myNum($material->price_equal_moq);?>">
                                <label for="floatingInput" class="fw-bold text-primary">Price Equal UoM</label>
                              </div>
                            </div>
                            <!--end::Col-->                          
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="lot_size" value ="<?php echo $material->lot_size;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Lot Size</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="order_cycle" value ="<?php echo $material->order_cycle;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Order Cycle</label>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="lt_pr_po" value ="<?php echo $material->lt_pr_po;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Est. Lead Time (PO)</label>
                              </div>
                            </div>                          
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="initial_stock" value ="<?php echo myNum($material->initial_stock);?>">
                                <label for="floatingInput" class="fw-bold text-primary">Initial Stock</label>
                              </div>
                            </div>  
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="place_to_buy" value ="<?php echo $material->place_to_buy;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Place To Buy</label>
                              </div>
                            </div>   
                            <div class="col-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="link" value ="<?php echo $material->link;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Link</label>
                              </div>
                            </div>                                                                                       
                            <!--end::Col-->                                                                                    
                          </div>          
                          <hr class="divider">      
                          <div class="row">
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myNum($material->lt_po_deliv);?>" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Total Lead Time</label>
                              </div>
                            </div>
                            <!--end::Col-->      
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myNum($material->standart_safety_stock);?>" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Standart Safety Stock</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myNum($material->moq*$material->price_per_uom);?>" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Total Price</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $material->moq!=0?myDecimal($material->price_equal_moq/($material->moq*$material->price_per_uom)):0;?> %" disabled>
                                <label for="floatingInput" class="fw-bold text-primary">Saving</label>
                              </div>
                            </div>
                            <!--end::Col-->
                          </div>                              
                          <hr class="divider">      
                          <div class="row">
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="var_todo_list" value ="<?php echo !empty($var_settings->var_todo_list)?$var_settings->var_todo_list:0;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Todo list variable</label>
                              </div>
                            </div>
                            <!--end::Col-->      
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="var_stock_card_todo_list" value ="<?php echo !empty($var_settings->var_stock_card_todo_list)?$var_settings->var_stock_card_todo_list:0;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Stock card todo list variable</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="var_stock_card_overstock" value ="<?php echo !empty($var_settings->var_stock_card_overstock)?$var_settings->var_stock_card_overstock:0;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Stock card overstock variable</label>
                              </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-3">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="var_stock_card_ok" value ="<?php echo !empty($var_settings->var_stock_card_ok)?$var_settings->var_stock_card_ok:0;?>">
                                <label for="floatingInput" class="fw-bold text-primary">Stock card ok variable</label>
                              </div>
                            </div>
                            <!--end::Col-->                            
                          </div>                              
                        </div>         
                      </div>                     
                    </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="submit" name="submit" 
                        class="btn btn-outline-primary" style="font-weight: 600; border-radius: 50px;width: 150px;">Update</button>
                    </div>                    
                  </div>                   
                </div>
                </form>
                <!-- /.card -->
              </div>
            </div>          
            <div class="row mb-2">
              <div class="col-sm-6">
                <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
                  Gross Requirement Formula
                </a> 
              </div>             
            </div>            
            <!--begin::Row-->            
            <div class="row">
              <div class="col-12 mb-4">
                    <table id="table-item" class="table table-sm table-bordered" width="100%">
                      <thead  style="text-align: center;white-space:nowrap;">
                          <tr >
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Year</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Week</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Type</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">AVG Week Start</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">AVG Week End</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Action</th>
                          </tr>
                      </thead>
                      <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">                       
                      </tbody>
                    </table> 
              </div>            
            </div>             
          </div>           
          <script>
      $(document).ready(function() {
          $('#table-item').DataTable({
              scrollX: true,
              "processing": true, 
              "serverSide": true, 
              "ordering": false,
              "ajax": {
                "url": "<?= site_url('master_data/get_gross_req?id='._encrypt($material->id));?>",
                "type": "POST"
              },
              "order": [],        
              "columnDefs": [
                {
                    targets: '_all',
                    createdCell: function(cell) {
                      $(cell).css('vertical-align', 'middle');
                    }
                }
            ],
          });      

          $(".pricePerUom").on('keyup', function(){
            var val = this.value;
            val = val.replace(/[^0-9\.]/g,'');
            
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
            
            this.value = val;
          });

          $(".priceEqualUom").on('keyup', function(){
            var val = this.value;
            val = val.replace(/[^0-9\.]/g,'');
            
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
            
            this.value = val;
          });          
      });
</script>
<!-- <script>
var myinput = document.getElementById('price_per_uom');

myinput.addEventListener('keyup', function() {
  var val = this.value;
  val = val.replace(/[^0-9\.]/g,'');
  
  if(val != "") {
    valArr = val.split('.');
    valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
    val = valArr.join('.');
  }
  
  this.value = val;
});

</script> -->