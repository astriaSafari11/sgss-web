<style>
    .unclickable {
        pointer-events: none;
        cursor: default;
    }

    .dropdown, .dropdown * {
        pointer-events: auto !important;
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
    
    <div class="d-flex align-items-center gap-2">
        <h4 class="fw-bold text-primary mb-0">Chosen Vendor Based On</h4>
        <div class="d-flex align-items-center border rounded-4 px-4 py-2" style="border-color:rgb(175, 175, 175) !important; position: relative;">
            <span class="text-primary" style="font-size: 20px;" id="vendortext">Choose Item Status</span>
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

    </div>
    <!-- end row result saving -->

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
    vendorText.textContent = 'Status: ' + status;
    
    // Hapus semua class warna terlebih dahulu
    vendorText.classList.remove('text-danger', 'text-warning', 'text-success', 'text-primary');
    
    // Tambahkan class warna sesuai pilihan
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
</script>