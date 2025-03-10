<div class="row mb-2">
              <div class="col-sm-6">
              <a href="<?= site_url('goods_management/item_movement');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
                  Back
                </a>               
              </div>
              <div class="col-sm-6">
              </div>
            </div>
<!--begin::Row-->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="info-box text-bg-white">
                  <div class="info-box-content" style="color: #001F82;">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-12">
                        <div class="row mb-3">
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" value="<?php echo $vendor->item_code;?>"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lot Size</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" value="<?php echo $material->lot_size;?>"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Inventory on-hand</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" value="<?php echo myNum($material->lt_po_deliv);?> Weeks"/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item Description</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" value="<?php echo $vendor->item_name;?>"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lead Time</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" value="<?php echo $material->lt_pr_po;?> Weeks"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Safety Stock</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" value="<?php echo myNum($material->initial_stock);?>"/>
                          </div>
                        </div>
                      </div>           
                    </div>  
                    <div class="row mb-2">
                    <div class="col-3">
                        <a class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
                        MRP Table
                        </a> 
                    </div>
                    </div>                     
                    <div class="row">
                                    <div class="col-12">
                                    <div class="row table-responsive">
                                        <table class="table table-sm table-bordered">
                                        <thead  style="text-align: center;white-space:nowrap;">
                                            <tr >
                                                <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;" rowspan="2">Period</th>
                                                <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;" rowspan="2">Initial Value</th>
                                                <th style="color: #fff;background-color:#001F82;text-align: center;vertical-align: middle;" colspan="<?php echo 12;?>">Week</th>
                                            </tr>
                                            <tr >
                                                <?php for($i=1;$i<=12;$i++){ ?>
                                                    <th style="color: #fff;background-color:#001F82;text-align: center;"><?php echo $i;?></th>
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
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>           
            </div>