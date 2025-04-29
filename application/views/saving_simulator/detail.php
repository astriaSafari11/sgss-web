<style>
    .unclickable {
        pointer-events: none;
        cursor: default;
    }

    .dropdown, .dropdown * {
        pointer-events: auto !important;
    }

    .form-box {
      position: relative;
      margin-bottom: 1rem;
    }
    .form-box label {
      position: absolute;
      top: -0.6rem;
      left: 0.75rem;
      background: #fff;
      padding: 0 0.25rem;
      font-size: 0.8rem;
      color: #6c757d;
    }
    .form-control[readonly] {
      background-color: #f8f9fa;
      border-color: #ced4da;
      cursor: default;
    }
    .edit-icon {
      cursor: pointer;
      color: #003366;
      margin-left: 0.5rem;
    }
</style>

<div class="main-content">
    <!-- saving table section  -->
<div class="row d-flex align-items-stretch">
        <h4 class="fw-bold text-primary">Savings Table</h4>

        <div class="px-2 w-100">
        <table id="example" class="table table-sm mx-2 align-middle" style="max-width:100%; box-sizing: border-box;" cellspacing="0">
            <thead>
                <tr>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item Code</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Latest Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Latest Purchase</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Total Purchase</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Baseline Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Savings Opportunity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center; border: 1px solid #ccc;">Masker</td>
                    <td style="text-align: center; border: 1px solid #ccc;">MSK01</td>
                    <td style="text-align: center; border: 1px solid #ccc;">Rp 5000</td>
                    <td style="text-align: center; border: 1px solid #ccc;">Rp 495.000</td>
                    <td style="text-align: center; border: 1px solid #ccc;">Rp 500.000</td>
                    <td style="text-align: center; border: 1px solid #ccc;">
                        <div class="d-flex align-items-center justify-content-center">
                            <span id="targetText" class="me-2">Target</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary p-0 rounded-circle" 
                                        type="button" 
                                        id="dropdownMenuButton" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false"
                                        style="width:24px;height:24px;">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" onclick="changeTargetText('Target')">Target</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="changeTargetText('Best')">Best</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="changeTargetText('Average')">Average</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: center; border: 1px solid #ccc;">Rp 10.000</td>
                </tr>
            </tbody>
        </table>
        </div>

    </div>
    <!-- end saving table section -->

    <!-- start row for details calc -->
    <div class="row d-flex align-items-stretch">

    <div class="d-flex align-items-center gap-2">
        <h4 class="fw-bold text-primary mb-0">Details Calculation</h4>
        <h4 class="text-primary mb-0">- Masker01</h4>
    </div>

    <!-- start isi konten -->
    <div class="col-md-3 d-flex flex-column">
    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
            font-weight: 600;
            color: #FFFFFF;
            background-color:#001F82;">
            Budget
    </span>
    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
            font-weight: 600;
            color: #FFFFFF;
            background-color:#001F82;">
            Annual Usage
    </span>
    </div>
        
    <div class="col-md-3 d-flex flex-column">
    <span class="btn mb-2 w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
                font-weight: 600;
                color: #001F82;
                background-color: #FFFFFF;
                border: 1px solid #001F82;">
        Rp50.000,00
    </span>
    <span class="btn mb-2 w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
                font-weight: 600;
                color: #001F82;
                background-color: #FFFFFF;
                border: 1px solid #001F82;">
        100 Box
    </span>    
    </div>

    <div class="col-md-3 d-flex flex-column">
    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
            font-weight: 600;
            color: #FFFFFF;
            background-color:#001F82;">
            UoM
    </span>
    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
            font-weight: 600;
            color: #FFFFFF;
            background-color:#001F82;">
            Item Code
    </span>
    </div>

    <div class="col-md-3 d-flex flex-column">
    <span class="btn mb-2 w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
                font-weight: 600;
                color: #001F82;
                background-color: #FFFFFF;
                border: 1px solid #001F82;">
        Box
    </span>
    <span class="btn mb-2 w-100 d-block text-center unclickable" 
            style="border-radius: 50px;
                font-weight: 600;
                color: #001F82;
                background-color: #FFFFFF;
                border: 1px solid #001F82;">
        MSK01
    </span>
    </div>
    <!-- end isi konten -->

    </div>
    <!-- end row for detail calc -->

    <!-- start row for saving last purchase -->
    <div class="row d-flex align-items-center justify-content-center mt-3">
    <div class="col-12 text-center">
        <h4 class="fw-bold text-primary mb-3">Savings Last Purchase</h4>

        <div class="d-flex justify-content-center align-items-center gap-2">
        <div class="bg-primary text-white rounded-4 px-3 py-2 fw-bold" style="font-size: 20px;">5%</div>

        <div class="text-primary fw-bold" style="font-size: 30px;">/</div>

        <div class="d-flex align-items-center border rounded-4 px-4 py-2" style="border-color:rgb(175, 175, 175) !important; position: relative;">
            <span class="text-primary" style="font-size: 20px;">Baseline: <b id="baselineText">Target (Rp50,000.00)</b></span>
            <div class="dropdown ms-5">
                <a href="#" class="text-decoration-none" id="baselineDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-chevron-down border rounded-5 btn btn-sm btn-outline-primary"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="baselineDropdown">
                    <li><a class="dropdown-item" href="#" onclick="changeBaseline('Target (Rp50,000.00)')">Target (Rp50,000.00)</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeBaseline('Best (Rp40,000.00)')">Best (Rp40,000.00)</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeBaseline('Average (Rp45,000.00)')">Average (Rp45,000.00)</a></li>
                </ul>
            </div>
        </div>
        </div>
    </div>
    </div>
<!-- end row for saving last purchase -->

<!-- start vendor table section  -->
<div class="row d-flex align-items-stretch mt-3">
        <h4 class="fw-bold text-primary">List of Vendors Available</h4>

        <div class="px-2 w-100">
        <table id="example" class="table table-sm mx-2 align-middle" style="max-width:100%; box-sizing: border-box;" cellspacing="0">
            <thead>
                <tr>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Vendor Code</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Vendor Name</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Category</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Lead Time (days)</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td style="text-align: center; border: 1px solid #ccc;">001</td>
                <td style="text-align: center; border: 1px solid #ccc;">Vendor A</td>
                <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
                <td style="text-align: center; border: 1px solid #ccc;">Rp15.000</td>
                <td style="text-align: center; border: 1px solid #ccc;">3</td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid #ccc;">002</td>
                <td style="text-align: center; border: 1px solid #ccc;">Vendor B</td>
                <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
                <td style="text-align: center; border: 1px solid #ccc;">Rp10.000</td>
                <td style="text-align: center; border: 1px solid #ccc;">2</td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid #ccc;">003</td>
                <td style="text-align: center; border: 1px solid #ccc;">Vendor C</td>
                <td style="text-align: center; border: 1px solid #ccc;">ONLINE</td>
                <td style="text-align: center; border: 1px solid #ccc;">Rp11.000</td>
                <td style="text-align: center; border: 1px solid #ccc;">3</td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid #ccc;">004</td>
                <td style="text-align: center; border: 1px solid #ccc;">Vendor D</td>
                <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
                <td style="text-align: center; border: 1px solid #ccc;">Rp11.000</td>
                <td style="text-align: center; border: 1px solid #ccc;">2</td>
            </tr>
        </tbody>
        </table>
        </div>

    </div>
    <!-- end vendor table section -->

    <h5 class="text-muted mt-3">Simulating on Process ...</h5>

    <!-- start row pricelist 3P -->
    <div class="row d-flex align-items-stretch mt-3">
    <h4 class="text-primary fw-bold">Price List Using 3<sup>rd</sup> Party</h4>

    <div class="px-2 w-100">
        <table id="example" class="table table-sm mx-2 align-middle" style="max-width:100%; box-sizing: border-box;" cellspacing="0">
            <thead>
                <tr>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Options</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Additional Margin</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Vendor A</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Vendor B</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Vendor C</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Vendor D</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold text-primary" style="text-align: center; border: 1px solid #ccc;">Mbiz</td>
                    <td style="text-align: center; border: 1px solid #ccc;">10%</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                    <td class="fw-bold text-success" style="text-align: center; border: 1px solid #ccc;">Rp12.500</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary" style="text-align: center; border: 1px solid #ccc;">KKUI</td>
                    <td style="text-align: center; border: 1px solid #ccc;">15%</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                    <td class="fw-bold text-success" style="text-align: center; border: 1px solid #ccc;">Rp12.500</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary" style="text-align: center; border: 1px solid #ccc;">Gunung Mas</td>
                    <td style="text-align: center; border: 1px solid #ccc;">5%</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                    <td class="fw-bold text-success" style="text-align: center; border: 1px solid #ccc;">Rp12.500</td>
                    <td class="fw-bold text-danger" style="text-align: center; border: 1px solid #ccc;">N/A</td>
                    <td class="fw-bold text-success" style="text-align: center; border: 1px solid #ccc;">Rp12.500</td>
                </tr>
            </tbody>
        </table>
    </div>

    </div>
    <!-- end row pricelist 3P -->

    <!-- start row result saving -->
    <div class="row d-flex align-items-stretch mt-3">
    <h4 class="text-primary fw-bold">Result Savings Simulator</h4>

    <div class="px-2 w-100">
        <table id="example" class="table table-sm mx-2 align-middle" style="max-width:100%; box-sizing: border-box;" cellspacing="0">
            <thead>
                <tr>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Options</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Channel</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Lead Time</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Target Savings</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">YoY Savings</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center; border: 1px solid #ccc;">Vendor 1</td>
                    <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
                    <td style="text-align: center; border: 1px solid #ccc;">12,000</td>
                    <td style="text-align: center; border: 1px solid #ccc;">3</td>
                    <td class="bg-success text-white" style="text-align: center; border: 1px solid #ccc;">1,000</td>
                    <td class="bg-success text-white" style="text-align: center; border: 1px solid #ccc;">1,500</td>
                    <td style="text-align: center; border: 1px solid #ccc;">
                        <span class="badge bg-success rounded-pill">Valid</span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: 1px solid #ccc;">Vendor 2</td>
                    <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
                    <td style="text-align: center; border: 1px solid #ccc;">9,000</td>
                    <td style="text-align: center; border: 1px solid #ccc;">2</td>
                    <td class="bg-danger text-white" style="text-align: center; border: 1px solid #ccc;">-2,000</td>
                    <td class="bg-danger text-white" style="text-align: center; border: 1px solid #ccc;">-1,500</td>
                    <td style="text-align: center; border: 1px solid #ccc;">
                        <span class="badge bg-success rounded-pill">Valid</span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: 1px solid #ccc;">Vendor 3</td>
                    <td style="text-align: center; border: 1px solid #ccc;">Online</td>
                    <td style="text-align: center; border: 1px solid #ccc;">9,500</td>
                    <td style="text-align: center; border: 1px solid #ccc;">3</td>
                    <td class="bg-danger text-white" style="text-align: center; border: 1px solid #ccc;">-1,500</td>
                    <td class="bg-danger text-white" style="text-align: center; border: 1px solid #ccc;">-1,000</td>
                    <td style="text-align: center; border: 1px solid #ccc;">
                        <span class="badge bg-danger rounded-pill">Invalid</span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: 1px solid #ccc;">Vendor 4</td>
                    <td style="text-align: center; border: 1px solid #ccc;">Mbiz</td>
                    <td style="text-align: center; border: 1px solid #ccc;">10,000</td>
                    <td style="text-align: center; border: 1px solid #ccc;">1</td>
                    <td class="bg-danger text-white" style="text-align: center; border: 1px solid #ccc;">-1,000</td>
                    <td class="bg-danger text-white" style="text-align: center; border: 1px solid #ccc;">-500</td>
                    <td style="text-align: center; border: 1px solid #ccc;">
                        <span class="badge bg-danger rounded-pill">Invalid</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row d-flex align-items-stretch mt-3">
    
    <div class="d-flex align-items-center gap-2 mb-1">
        <h4 class="fw-bold text-primary mb-0">Chosen Vendor Based On</h4>
        <div class="d-flex align-items-center border rounded-4 px-4 py-2" style="border-color:rgb(175, 175, 175) !important; position: relative;">
            <span class="text-primary fw-bold" style="font-size: 20px;" id="vendortext">Item Status</span>
            <div class="dropdown ms-4">
                <a href="#" class="text-decoration-none" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-chevron-down border rounded-5 btn btn-sm btn-outline-primary"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                    <li><a class="dropdown-item text-danger fw-bold" href="#" onclick="changeStatus(event, 'Red')">Red</a></li>
                    <li><a class="dropdown-item text-warning fw-bold" href="#" onclick="changeStatus(event, 'Yellow')">Yellow</a></li>
                    <li><a class="dropdown-item text-success fw-bold" href="#" onclick="changeStatus(event, 'Green')">Green</a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-sm text-center align-middle">
        <thead class="table-primary text-white bg-primary">
            <tr>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item Code</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">UoM</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Winner Vendor</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Channel</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Current Purchase</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Target Savings</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">YoY Savings</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td class="fw-bold" style="text-align: center; border: 1px solid #ccc;">Vendor 4</td>
            <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
            <td style="text-align: center; border: 1px solid #ccc;">12,000</td>
            <td style="text-align: center; border: 1px solid #ccc;">3</td>
            <td style="text-align: center; border: 1px solid #ccc;">1,000</td>
            <td style="text-align: center; border: 1px solid #ccc;">1,500</td>
            <td class="text-success fw-semibold" style="text-align: center; border: 1px solid #ccc;">Valid</td>
            <td class="text-danger fw-semibold" style="text-align: center; border: 1px solid #ccc;">-1500</td>
            </tr>
        </tbody>
        </table>
    </div>


    </div>
    <!-- end row result saving -->

</div>

<div class="row d-flex align-items-stretch mt-3">
    <h4 class="fw-bold text-primary mb-1">Chosen Vendor Based On Price</h4>

    <div class="table-responsive">
    <table class="table table-sm text-center align-middle">
      <thead class="table-primary text-white bg-primary">
        <tr>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item Code</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">UoM</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Winner Vendor</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Channel</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Current Purchase</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Target Savings</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">YoY Savings</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="fw-bold" style="text-align: center; border: 1px solid #ccc;">Vendor 4</td>
          <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
          <td style="text-align: center; border: 1px solid #ccc;">12,000</td>
          <td style="text-align: center; border: 1px solid #ccc;">3</td>
          <td style="text-align: center; border: 1px solid #ccc;">1,000</td>
          <td style="text-align: center; border: 1px solid #ccc;">1,500</td>
          <td class="text-success fw-semibold" style="text-align: center; border: 1px solid #ccc;">Valid</td>
          <td class="text-danger fw-semibold" style="text-align: center; border: 1px solid #ccc;">-1500</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

<div class="row d-flex align-items-stretch mt-3">
    <h4 class="fw-bold text-primary mb-1">Chosen Vendor Based On Lead Time</h4>

<div class="table-responsive">
    <table class="table table-sm text-center align-middle">
      <thead class="table-primary text-white bg-primary">
        <tr>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item Code</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Item</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">UoM</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Winner Vendor</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Channel</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Current Purchase</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">Target Savings</th>
          <th style="color: #fff;background-color: #001F82;text-align: center; border: 1px solid #ccc;">YoY Savings</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="fw-bold" style="text-align: center; border: 1px solid #ccc;">Vendor 4</td>
          <td style="text-align: center; border: 1px solid #ccc;">COUPA</td>
          <td style="text-align: center; border: 1px solid #ccc;">12,000</td>
          <td style="text-align: center; border: 1px solid #ccc;">3</td>
          <td style="text-align: center; border: 1px solid #ccc;">1,000</td>
          <td style="text-align: center; border: 1px solid #ccc;">1,500</td>
          <td class="text-success fw-semibold" style="text-align: center; border: 1px solid #ccc;">Valid</td>
          <td class="text-danger fw-semibold" style="text-align: center; border: 1px solid #ccc;">-1500</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

<div class="row d-flex align-items-stretch mt-3">
  <!-- Baris Tahun, Vendor, Target -->
    <div class="row text-center fw-semibold">
    <!-- Year -->
    <div class="col-3">
        <div class="form-box position-relative">
        <label for="year" class="bg-transparent text-primary">Year</label>
        <input type="text" class="form-control text-center pe-5 rounded-pill bg-white" id="year" value="2025" readonly style="border-color: #001F82 !important;">
        <button type="button" class="btn btn-primary btn-sm rounded-circle position-absolute top-50 end-0 translate-middle-y me-2"
                onclick="enableEdit('year')">
            <i class="fa-solid fa-pen text-white"></i>
        </button>
        </div>
    </div>

    <!-- Vendor -->
    <div class="col-3">
        <div class="form-box position-relative">
        <label for="vendor" class="bg-transparent text-primary">Vendor</label>
        <input type="text" class="form-control text-center pe-5 rounded-pill bg-white" id="vendor" value="Vendor 4" readonly style="border-color: #001F82 !important;">
        <button type="button" class="btn btn-primary btn-sm rounded-circle position-absolute top-50 end-0 translate-middle-y me-2"
                onclick="enableEdit('vendor')">
            <i class="fa-solid fa-pen text-white"></i>
        </button>
        </div>
    </div>

    <!-- Target -->
    <div class="col-3">
        <div class="form-box position-relative">
        <label for="target" class="bg-transparent text-primary">Target</label>
        <input type="text" class="form-control text-center pe-5 rounded-pill bg-white" id="target" value="Rp2.000,00" readonly style="border-color: #001F82 !important;">
        <button type="button" class="btn btn-primary btn-sm rounded-circle position-absolute top-50 end-0 translate-middle-y me-2"
                onclick="enableEdit('target')">
            <i class="fa-solid fa-pen text-white"></i>
        </button>
        </div>
    </div>
    </div>


  <!-- Grid Informasi -->
  <div class="row text-center g-2">
  <!-- Kolom Kiri -->
  <div class="col-md-6 d-flex flex-column">
    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #FFFFFF;
                 background-color:#001F82;">
      Item Code
    </span>
    <span class="btn mb-2 w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #001F82;
                 background-color: #FFFFFF;
                 border: 1px solid #001F82;">
      MSK01
    </span>

    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #FFFFFF;
                 background-color:#001F82;">
      Item
    </span>
    <span class="btn mb-2 w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #001F82;
                 background-color: #FFFFFF;
                 border: 1px solid #001F82;">
      Masker
    </span>

    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #FFFFFF;
                 background-color:#001F82;">
      UoM
    </span>
    <span class="btn mb-2 w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #001F82;
                 background-color: #FFFFFF;
                 border: 1px solid #001F82;">
      Pcs
    </span>

    <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #FFFFFF;
                 background-color:#001F82;">
      Avg Purchase Price
    </span>
    <span class="btn mb-2 w-100 d-block text-center unclickable"
          style="border-radius: 50px;
                 font-weight: 600;
                 color: #001F82;
                 background-color: #FFFFFF;
                 border: 1px solid #001F82;">
      Rp9.000
    </span>
  </div>

  <!-- Kolom Kanan -->
  <div class="col-md-6 d-flex flex-column">
        <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
            style="border-radius: 50px;
                    font-weight: 600;
                    color: #FFFFFF;
                    background-color:#001F82;">
        FY Volume
        </span>
        <span class="btn mb-2 w-100 d-block text-center unclickable"
                style="border-radius: 50px;
                        font-weight: 600;
                        color: #001F82;
                        background-color: #FFFFFF;
                        border: 1px solid #001F82;">
            100
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 5px; vertical-align: middle;"
                    data-bs-toggle="modal" data-bs-target="#modal-edit-qty">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </span>


        <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
            style="border-radius: 50px;
                    font-weight: 600;
                    color: #FFFFFF;
                    background-color:#001F82;">
        FY Spend
        </span>
        <span class="btn mb-2 w-100 d-block text-center unclickable"
            style="border-radius: 50px;
                    font-weight: 600;
                    color: #001F82;
                    background-color: #FFFFFF;
                    border: 1px solid #001F82;">
        Rp900.000,00
        <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                style="margin-left: 5px; vertical-align: middle;"
                data-bs-toggle="modal" data-bs-target="#modal-edit-spend">
            <i class="fa-solid fa-pen text-white"></i>
        </button>
        </span>

        <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
            style="border-radius: 50px;
                    font-weight: 600;
                    color: #FFFFFF;
                    background-color:#001F82;">
        FY Budget
        </span>
        <span class="btn mb-2 w-100 d-block text-center unclickable"
            style="border-radius: 50px;
                    font-weight: 600;
                    color: #001F82;
                    background-color: #FFFFFF;
                    border: 1px solid #001F82;">
        Rp900.000,00
        </span>

        <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable"
            style="border-radius: 50px;
                    font-weight: 600;
                    color: #FFFFFF;
                    background-color:#001F82;">
        Savings
        </span>
        <span class="btn mb-2 w-100 d-block text-center unclickable"
            style="border-radius: 50px;
                    font-weight: 600;
                    color: #001F82;
                    background-color: #FFFFFF;
                    border: 1px solid #001F82;">
        Rp0,-
        </span>
    </div>
    </div>


  <!-- Status Box -->
    <div id="statusAlert" onclick="toggleStatus()"
        class="alert alert-danger text-center fw-bold mt-4 border border-danger rounded-pill fs-5 text-danger"
        role="alert" style="cursor: pointer;">
    Need More Savings!
    </div>
</div>


<div class="row d-flex align-items-stretch mt-3">
    <h4 class="fw-bold text-primary mb-1">Savings Forecasts</h4>

    <div class="row mb-3">

    <div class="col-md-6 d-flex gap-2">
        <input type="text" class="form-control" placeholder="Input item code">
        <button class="btn btn-outline-primary px-4">
        <i class="bi bi-search me-1"></i> Search
        </button>
    </div>

    <div class="col-md-6 d-flex gap-2">
        <input type="text" class="form-control" placeholder="Input item code">
        <button class="btn btn-outline-primary">
        <i class="bi bi-person-check me-1"></i> Choose Vendor to Forecast
        </button>
    </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
    <table class="table table-sm text-center align-middle">
    <thead>
        <tr class="text-white fw-bold">
            <th class="align-middle bg-primary text-white" rowspan="2">2025 FY Spend</th>
            <th class="bg-info text-primary" colspan="3">Actualized</th>
            <th class="bg-primary text-white" colspan="9">Forecast</th>
            <th class="align-middle bg-primary text-white" rowspan="2">TOTAL</th>
        </tr>
        <tr class="text-white">
            <th class="bg-info">Jan</th>
            <th class="bg-info">Feb</th>
            <th class="bg-info">Mar</th>

            <!-- Forecast months with replaced buttons -->
            <th class="bg-warning text-dark">
            Apr
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-apr">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            May
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-may">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            Jun
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-jun">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            Jul
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-jul">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            Aug
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-aug">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            Sep
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-sep">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            Oct
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-oct">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            Nov
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-nov">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>
            <th class="bg-warning text-dark">
            Dec
            <button type="button" class="btn btn-primary btn-sm rounded-circle p-2"
                    style="margin-left: 4px;" data-bs-toggle="modal" data-bs-target="#modal-edit-dec">
                <i class="fa-solid fa-pen text-white"></i>
            </button>
            </th>

            <th class="bg-dark"> </th>
        </tr>
        </thead>

        <tbody>
        <!-- Volume -->
        <tr>
            <th>Volume</th>
            <td>8</td>
            <td>7</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
            <td>8.5</td>
        </tr>

        <!-- Spend -->
        <tr>
            <th>Spend</th>
            <td>100,000</td>
            <td>95,000</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td>110,500</td>
            <td></td>
        </tr>

        <!-- Avg Unit Price -->
        <tr>
            <th>Avg Unit Price</th>
            <td>12,500</td>
            <td>13,571</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td>13,000</td>
            <td></td>
        </tr>
        </tbody>
    </table>
    </div>
</div>
</body>
</div>


<script>
function changeTargetText(newText) {
    document.getElementById('targetText').textContent = newText;
    
    var dropdown = bootstrap.Dropdown.getInstance(document.getElementById('dropdownMenuButton'));
    if (dropdown) {
        dropdown.hide();
    }
}

function changeBaseline(selectedText) {
    document.getElementById('baselineText').innerHTML = selectedText;
    
    // Tutup dropdown setelah memilih
    var dropdown = bootstrap.Dropdown.getInstance(document.getElementById('baselineDropdown'));
    if (dropdown) {
        dropdown.hide();
    }
}

function changeStatus(event, status) {
    event.preventDefault();
    
    const vendorText = document.getElementById('vendortext');
    vendorText.textContent = 'Item Status: ' + status;
    
    vendorText.classList.remove('text-danger', 'text-warning', 'text-success', 'text-primary', 'fw-bold');
    vendorText.classList.add('fw-bold');

    switch(status) {
        case 'Red':
            vendorText.classList.add('text-danger');
            break;
        case 'Yellow':
            vendorText.classList.add('text-warning');
            break;
        case 'Green':
            vendorText.classList.add('text-success');
            break;
        default:
            vendorText.classList.add('text-primary');
    }
    
    // Close the dropdown
    var dropdown = bootstrap.Dropdown.getInstance(document.getElementById('statusDropdown'));
    if (dropdown) {
        dropdown.hide();
    }
}

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

    function enableEdit(id) {
    const input = document.getElementById(id);
    input.removeAttribute('readonly');
    input.focus();
  }

  function toggleStatus() {
    const alertBox = document.getElementById("statusAlert");
    const isWarning = alertBox.classList.contains("alert-danger");

    if (isWarning) {
      // Ganti jadi "Target Achieved!"
      alertBox.classList.remove("alert-danger", "border-danger", "text-danger");
      alertBox.classList.add("alert-success", "border-success", "text-success");
      alertBox.innerHTML = "<strong>Target Achieved!</strong>";
    } else {
      // Ganti balik jadi "Need More Savings!"
      alertBox.classList.remove("alert-success", "border-success", "text-success");
      alertBox.classList.add("alert-danger", "border-danger", "text-danger");
      alertBox.innerHTML = "<strong>Need More Savings!<strong>";
    }
  }
</script>