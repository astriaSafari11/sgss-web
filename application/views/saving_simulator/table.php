<head>
    <?php $this->load->view ('_partials/head.php'); ?>
</head>

<div class="main-content">
<!-- saving table section  -->
<div class="row d-flex align-items-stretch mt-3 mx-2">
        <h4 class="fw-bold text-primary">Saving Table</h4>

        <table id="example" class="table table-sm mx-2" style="max-width:100%; box-sizing: border-box;" cellspacing="0">
            <thead>
                <tr>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Quantity</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">UoM Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Total Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Purchase Reason</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;"><a href="<?php echo site_url ('saving_simulator/detail'); ?>">Masker
                    </td>
                    <td style="text-align: center;">20</td>
                    <td style="text-align: center;">Box</td>
                    <td style="text-align: center;">VND01</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Earplug</td>
                    <td style="text-align: center;">20</td>
                    <td style="text-align: center;">Box</td>
                    <td style="text-align: center;">VND02</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Masker</td>
                    <td style="text-align: center;">50</td>
                    <td style="text-align: center;">Box</td>
                    <td style="text-align: center;">VND01</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Alkohol</td>
                    <td style="text-align: center;">100</td>
                    <td style="text-align: center;">ml</td>
                    <td style="text-align: center;">VND01</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Alkohol</td>
                    <td style="text-align: center;">100</td>
                    <td style="text-align: center;">ml</td>
                    <td style="text-align: center;">VND03</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- end saving table section -->

</div>


    <?php $this->load->view ('_partials/footer.php'); ?>