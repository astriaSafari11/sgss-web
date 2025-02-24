<?php $this->load->view('_partials/head.php'); ?>
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
                            <input type="text" class="form-control" id="inputEmail3" placeholder="ALL"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lot Size</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Inventory on-hand</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item Description</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lead Time</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Safety Stock</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                        </div>
                      </div>           
                    </div>  
                    <div class="row">
                      <div class="row mb-3">
                            <div class="col-md-6 col-sm-6 col-12 ">
                                <h3 class="mb-2 text-primary font-bold">MRP - Table</h3>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12" style="justify-content: flex-end;display: flex;">
                                <button type="button" class="btn btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:10px;">
                                    Export
                                </button>                       
                                <button type="button" class="btn btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px;width: 150px;">
                                    Import
                                </button>                       
                            </div>
                        </div>                      
                      <div class="col-md-12 col-sm-12 col-12">
                      <table class="table table-bordered" style="width:100%" id="example">
                        <thead>
                            <tr >
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Month</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;" colspan="4">January</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;" colspan="4">February</th>
                            </tr>
                            <tr >
                                <th style="color: #000;background-color:rgb(244, 244, 245);text-align: center;"></th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">1</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">2</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">3</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">4</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">1</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">2</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">3</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;">
                                  <a href="<?= site_url('goods_management/item_movement_detail');?>" style="font-weight:600;color: #001F82;">Alkohol</a>
                                </td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                             </tr>
                             <tr>
                                <td style="vertical-align: middle;text-align: center;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                        </tbody>  
                        </table>  
                      </div>           
                    </div>                                       
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>           
            </div>
            <!--end::Row-->   
            <?php $this->load->view('_partials/footer.php'); ?>