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
                          </div>                                   
                        </div>         
                      </div>                     
                    </div>
                </form>
                <!-- /.card -->
              </div>
            </div>              
            <div class="row mb-2">
              <div class="col-sm-3">
                <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
                  Item Movement
                </a> 
              </div>
            </div>            
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">                 
                  
                    <input type="hidden" name="id" value="<?php echo $vendor->id;?>">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="row table-responsive">
                            <table class="table table-sm table-bordered">
                              <thead  style="text-align: center;white-space:nowrap;">
                                  <tr >
                                      <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;" rowspan="3">Period</th>
                                      <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;" rowspan="3">Initial Value</th>
                                      <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;" colspan="<?php echo 12;?>">Week</th>
                                  </tr>
                                  <tr >
                                      <?php for($i=1;$i<=12;$i++){ ?>
                                        <th style="color: #fff;background-color:#001F82;text-align: center;"><?php echo $i;?></th>
                                      <?php } ?>
                                  </tr>
                                  <tr >
                                      <?php for($i=1;$i<=12;$i++){ ?>
                                        <th style="color: #fff;background-color:#001F82;text-align: center;">
                                          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-value-<?php echo $i;?>">
                                            <i class="fa-solid fa-pen-to-square"></i>		
                                          </b>                                          
                                        </th>
                                      <?php } ?>
                                  </tr>                                  
                              </thead>
                              <tbody style="white-space:nowrap;vertical-align:center;">
                                <tr>
                                  <td>Gross Requirements</td>
                                  <td></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->gross_requirement==0?'-':myNum($item_movement[$i-1]->gross_requirement);?></td>
                                  <?php } ?>                                  
                                </tr>     
                                <tr>
                                  <td>Schedule Receipts</td>
                                  <td></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->schedules_receipts==0?'-':myNum($item_movement[$i-1]->schedules_receipts);?></td>
                                  <?php } ?>                                  
                                </tr>                                                   
                                <tr>
                                  <td>Stock on Hand</td>
                                  <td  style="text-align: center;"><?php echo myNum($material->initial_stock);?></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->stock_on_hand==0?'-':myNum($item_movement[$i-1]->stock_on_hand);?></td>
                                  <?php } ?>                                  
                                </tr> 
                                <tr>
                                  <td>Current Safety Stock</td>
                                  <td  style="text-align: center;"><?php echo myNum(min($material->initial_stock, $material->standart_safety_stock));?></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->current_safety_stock==0?'-':myNum($item_movement[$i-1]->current_safety_stock);?></td>
                                  <?php } ?>                                  
                                </tr> 
                                <tr>
                                  <td>Net On Hand</td>
                                  <td  style="text-align: center;"><?php echo myNum($material->initial_stock-$material->standart_safety_stock);?></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->net_on_hand==0?'-':myNum($item_movement[$i-1]->net_on_hand);?></td>
                                  <?php } ?>                                  
                                </tr>
                                <tr>
                                  <td>Net Requirement</td>
                                  <td></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->net_requirement==0?'-':myNum($item_movement[$i-1]->net_requirement);?></td>
                                  <?php } ?>                                  
                                </tr> 
                                <tr>
                                  <td>Planned Order Receipts</td>
                                  <td></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->planned_order_receipt==0?'-':myNum($item_movement[$i-1]->planned_order_receipt);?></td>
                                  <?php } ?>                                  
                                </tr>                       
                                <tr>
                                  <td>Planned Order Release</td>
                                  <td></td>
                                  <?php for($i=1;$i<=12;$i++){ ?>
                                    <td style="text-align: center;"><?php echo $item_movement[$i-1]->planned_order_release==0?'-':myNum($item_movement[$i-1]->planned_order_release);?></td>
                                  <?php } ?>                                  
                                </tr>                                                                                                                                            
                              </tbody>
                            </table> 

                          </div>                                      
                        </div>         
                      </div>                     
                    </div>
                    <?php for($i=1;$i<=12;$i++){ ?>
                      <form action="<?php echo site_url('master_data/update_item_movement');?>" method="post">
                        <div class="modal fade" id="modal-edit-value-<?php echo $i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <input type="hidden" name="material_movement_id" value="<?php echo $item_movement[$i-1]->id;?>">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Input Item Movement Data, Week : <?php echo $i;?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                            <div class="col-12">
                                              <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                  <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="gross_requirement" value ="<?php echo $item_movement[$i-1]->gross_requirement;?>" <?php echo $gross_req[$i-1]->type=='formula'?'disabled':'';?>>
                                                    <label for="floatingInput" class="fw-bold text-primary">Gross Requirements</label>
                                                  </div>
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                  <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="schedule_receipt" value ="<?php echo $item_movement[$i-1]->schedules_receipts;?>">
                                                    <label for="floatingInput" class="fw-bold text-primary">Schedule Receipts</label>
                                                  </div>
                                                </div>
                                                <!--end::Col-->                              
                                            </div>         
                                          </div>
                                          </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" name="submit" class="btn btn-outline-primary">Update Data</button>
                                </div>
                              </div>
                            </div>
                        </div>  
                      </form>
                    <?php } ?>                    
                  <!-- /.card-body -->                  
                </div>
                <!-- /.card -->
              </div>
            </div>                      
          </div>           