<head>
    <?php $this->load->view ('_partials/head.php'); ?>
</head>

<style>
    .unclickable {
        pointer-events: none;
        cursor: default;
    }
</style>

<div class="main-content">

<div class="row info-box d-flex align-items-stretch rounded-5 mx-1">

<?php $this->load->view ('_partials/search_bar_saving.php'); ?>

<div class="px-3 w-100">
<table id="example" class="table table-sm" style="width:100%" cellspacing="0">
<thead>
        <tr>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Item</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Quantity</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">UoM</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Vendor</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">UoM Price</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Total Price</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Purchase Reason</th>
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
    </div>
    <!-- end row for detail calc -->

</div>

<?php $this->load->view ('_partials/footer.php'); ?>