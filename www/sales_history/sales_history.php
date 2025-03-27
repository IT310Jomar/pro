

<div class="modal salesHistoryModal" id="salesHistoryModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.9)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 80%; max-height: 80%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        
        <div class="d-flex">
            <h3 class="headTitle">SALES HISTORY <span class="spanUserName">[USER: ADMIN]</span> <span class="current_date">CURRENT DATE</span></h3>
            <div class="ml-auto"> 
                <button class="btn btn-secondary shadow-none closeBtnSalesHistory"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="row salesContent">
            <div class="row">
                <div class="col-lg-9 d-flex ps-0 pe-0">
                    <div  style="margin-right: 10px; color:#ffff; margin-top: -12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ffff" class="bi bi-upc-scan" viewBox="0 0 16 16">
                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
                        </svg>
                    </div>
                    <div class="search_input_history" style="position: relative; width: 100%; margin-right: 10px">
                        <input type="text" id="search-sales" placeholder="Search customer/ tax no./ email/ phone/ loyalty card" class="form-control shadow-none" style="margin-right: 10px; border:none; border-radius: 0; font-style: italic">
                        <div id="customer-result" class="form-control shadow-none d-none"></div>
                    </div>
                    <select name="select_filter_doc_type" id="select_filter_doc_type" class="custom_form_control shadow-none select_filter_doc_type">
                        <option value="ALL">ALL</option>
                        <option value="SUCCESS">SUCCESS</option>
                        <option value="REFUNDED">REFUNDED</option>
                        <option value="VOIDED">VOIDED</option>
                        <option value="RET&EX">RET&EX</option>
                    </select>
                </div>

                <div class="col-lg-3 ps-0 pe-0 d-flex">
                    <select name="select_filter" id="select_filter" class="w-100 custom_form_control shadow-none select_filter">
                        <option value="TODAY">TODAY</option>
                        <option value="YESTERDAY">YESTERDAY</option>
                        <option value="THIS WEEK">THIS WEEK</option>
                        <option value="THIS MONTH">THIS MONTH</option>
                        <option value="THIS YEAR">THIS YEAR</option>
                        <option value="CUSTOM">CUSTOM</option>
                    </select>
                    <input disabled class="dateRange" style="width: 300px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                </div>
            </div>

           
            <div class="d-flex sales_history" style="align-items: baseline">
                <table style="width:80%; margin-right: 10px margin-top: 10px" class="salesHistoryTable table table-borderless m-0 text-light ">
                    <thead>
                        <tr style="border: 1px solid #FF6700; color: #FF6700">
                            <th colspan="1">#</th>
                            <th colspan="2">Receipt No.</th>
                            <th colspan="2">Rereference No.</th>
                            <th colspan="2">Document Type</th>
                            <th colspan="2">Date/Time</th>
                            <th colspan="2">Customer</th>
                            <th colspan="2">Type</th>
                            <th colspan="2">Amount</th>
                            <th colspan="2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>


                <div style="width:20%; float: right; margin-top: -73px;" class="justify-content-end receipt_preview_history">
                    <div class="row" id="receipt_information">
                        <div class="col-12" style="text-align: center; font-size:small; background: #fff;">
                        <h6 style="font-weight: bold;">TinkerPro Store</h6> 
                        <label style="font-weight: bold;">Owned and Operated by:</label> 
                        <label style="font-weight: bold;">UNKNOWN</label> 
                        <label style="font-weight: bold;">GUN-OB LAPU-LAPU CITY, 6015</label> 
                        <label style="font-weight: bold;">VAR REG TIN: XXXX-XXX-XXXX-XXXX</label> 
                        <label style="font-weight: bold;">MIN: XXXXXXXXXXX</label> 
                        <label style="font-weight: bold;">S/N: XXXX-XXXX-XXXX-XXXX</label> 
                        <label>CN: 09981231232</label> 
                        <label style="font-weight: bold;" class="receipt_type">PREVIEW RECEIPT</label>
                        </div>    

                        <div class="col-12" style="font-size: small; padding-top: 20px; background: #fff;">
                        <label style="font-weight: bold;" id="or_num_id">OR # 00000000</label> 
                        <label class="transactionNo" >Trans #: <span class="Preview_transacNo">02312312</span></label>
                        <label>Terminal: DEVICE_NAME </label> 
                        <label>Cashier: Admin Admin </label>
                        <label class="date_transac">Date: <span class="CurrentDate" id="CurrentDate">02/02/2024</span></label>
                        <label class="time_transac" >Time: <span id="CurrentTime">05:59:29pm</span> </label>
                        <label>Payer: <span class="Payer" id="Payer"></span></label>
                        <label class="cus_type">Customer Type: <span class="CustomerDisType"> Regular </span></label>
                    </div>

                    <div class="col-12" style="font-size: small; padding-top: 10px; background: #fff;">
                        <div class="row">
                            <label style="font-weight: bold">Item(s) <span style="float: right">Subtotal</span></label>
                            <hr class="new2">
                        
                            <div class="soldProduct" id="soldProduct">
                                <label class="orderProducts"><span style="float: right" class="subTotal_receipt">0.00</span></label>
                            </div>
                            
                            <hr class="new2">

                            <label class="itemQty">ITEM QTY <span style="float: right" class="TotalQty" id="TotalQty">0</span></label>
                            <label class="tAmount">AMOUNT <span style="float: right" class="TotalAmount" id="TotalAmount">0.00</span></label>
                            <label class="reg_dis">REGULAR DISCOUNT <span style="float: right" id="CustomerDiscount">0.00</span></label>
                            <label class="discount_item">ITEM(s) DISCOUNT <span style="float: right" id="ItemsDiscount">0.00</span></label>
                            <label class="totalPayment_preview" style="font-weight: bold">TOTAL <span style="float: right;" id="totalPayment_preview">0.00</span></label>

                            <label class="tendered" style="text-align: center">Tendered: </label>
                            <label class="payments" style="font-weight: bold" id="paymentMethod_text"><span style="float: right" id="PaidAmount"></span></label> 
                            <label class="payment_change" style="font-weight: bold">CHANGE <span style="float: right" id="ChangeAmount">0.00</span></label>  

                            <label>VATable Sales(V) <span style="float: right" id="VatSales">&#8369; 0.00</span></label>
                            <label>VAT Amount <span style="float: right" id="VatAmount">&#8369; 0.00</span></label>
                            <label>VAT Exempt <span style="float: right">&#8369; 0.00</span></label>

                            <hr class="new2">
                            <label>Name: ? _____________________</label>
                            <label>TIN/ID/SC: ? _________________</label>
                            <label>Address: ? _________________________</label>
                            <label>Signature: ? ________________________</label>  <br>
                            <label class="barcode_text" style="text-align: center; font-weight: bold"></label>  <br>
                        </div>
                    </div>

                    <div class="col-12" style="text-align: center; font-size: small; background: #fff;">
                        <label>THIS IS NOT AN OFFICIAL RECEIPT FOR</label>
                        <label>DOCUMENTATION PURPOSES ONLY</label> 
                        <label>TinkerPro IT Solution</label> 
                        <label> Gun-ob, Lapu-Lapu City, Cebu</label> 
                        <label>Website: www.tinkerpro.com</label> 
                        <label>Mobile #: 09xxxxxxxxx</label> 
                        <label>TIN #: 0000000-000000</label>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
        <div class="row mt-2 me-1 row_button">
            <div class="col-lg-12 d-flex justify-content-between buttonActions">
                <button id="cancel_receipt" class="btn btn-secondary shadow-none">CANCEL RECEIPT</button>
                <div class="d-flex">
                    <button style="margin-right: 10px" class="btn btn-secondary shadow-none reprintBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    PRINT RECEIPT</button>
                    <button style="margin-right: 10px" id="view_order" class="btn btn-secondary shadow-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                    VIEW ORDER</button>
                    <button class="btn btn-secondary shadow-none" id="refundButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                    </svg>    
                    REFUND</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
 
?>

<script>

var transactionNumber = 0;
var customerId = 0;
var payment_id = 0;


    function scrollToSelectedRow_sales() {
        var container_sales = $('.sales_history');
        var selectedRow_sales = $('.selectable-sales-row');
       
        // Check if selectedRow is defined before accessing its offset
        if (selectedRow_sales.length > 0) {
            // console.log('hello')
            container_sales.scrollTop(selectedRow_sales.offset().top - container_sales.offset().top + container_sales.scrollTop());
        }
    }


$(document).ready(function() {
    var selectedFilter = $("#select_filter").val();
    var currentDateObj = new Date(currentDate());
    var nextDayDate = new Date(currentDateObj);
    
    var ornum;
    var transactionToVoid;
    nextDayDate.setDate(nextDayDate.getDate() + 1);

    $(".dateRange").flatpickr({
        mode: "range",
        dateFormat: "m-d-Y",
        altInput: true,
        altFomart: "M j, Y",
        defaultDate: [currentDateObj, nextDayDate],
        onChange: function(selectedDates, dateStr, instance) {
            getAllSalesHistory();
        }
    });

    $('.reprintBtn').click(function() {
        var selectedDataHistory = $('.selectable-sales-row.selected');
        transactionNumber = selectedDataHistory.data('transaction');
        customerId = selectedDataHistory.data('userid');
        paymentid = selectedDataHistory.data('paymentid');
      
        var modalPrintLoad = $('#modalPrintLoadData');
        if(paymentid) {
            var printUrl = "../www/refund-print.php";
        } else {
            var printUrl = "../www/reprint-receipt.php";
            var setIntervalPrint = setInterval(function() {
                modalPrintLoad.fadeIn('fast'); 
            },1);
            setTimeout(function() {
                clearInterval(setIntervalPrint);
                modalPrintLoad.fadeOut('fast'); 
                $('#search-input').focus();
            },1500);
        }
        reprintReceipt(printUrl);
    })


    $('#refundButton').click(function() {
        var selectedDataHistory = $('.selectable-sales-row.selected');
        ornum = selectedDataHistory.data('ornums');
        $('#refundModalButton').click();
        $('#salesHistoryModal').hide();
        $('#receiptNumber').val(ornum);
    })

    $('.current_date').text(dateAndTimeFormat(currentDate()).formatted_date)
    $('.select_filter').change(function () {
        selectedFilter = $("#select_filter").val();
        getAllSalesHistory()
    })

    $('.select_filter_doc_type').change(function () {
        selected_doc = $(".select_filter_doc_type").val();
        getAllSalesHistory()
    })


    $('#cancel_receipt').click(function () {
        var selectedDataHistory = $('.selectable-sales-row.selected');
        transactionToVoid = selectedDataHistory.data('transaction')
        $('#salesHistoryModal').hide();
        $("#voidTransactionModal").show();
        $('.transationNumToVoid').val(transactionToVoid);
        voidProducts(); 
    })


    $('#search-sales').on('input', function() {
        var searchTerm = $(this).val().trim().toLowerCase();
        $('.salesHistoryTable tbody tr').each(function() {
            var saleOrNum = $(this).find('td:nth-child(2)').text().trim().toLowerCase(); 
            var customer_name = $(this).find('td:nth-child(6)').text().trim().toLowerCase();
            if (saleOrNum.includes(searchTerm) || customer_name.includes(searchTerm)) {
                $(this).show(); 
            } else {
                $(this).hide(); 
            }
        });
    });

});


function reprintReceipt(urls) {
    if(paymentid) {
        $.ajax({
            url: urls,
            type: "GET",
            data: {
                payment_id: paymentid,
                first_name: 'Admin',
                last_name: 'Admin',
            },
            success: function(data) {
                console.log('SUCCESS PRINT REFUND')
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

    } else {
        $.ajax({
            url: urls,
            type: "GET",
            data: {
                first_name: 'Admin',
                last_name: 'Admin',
                transaction_num: transactionNumber,
                user_id: customerId,
            },
            success: function(data) {
            console.log('SUCCESS PRINTING')
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
}

function runPrintPreview_history() {
  var receiptPreview = document.querySelector('.receipt_preview_history');
  receiptPreview.scrollTop = 0;
  var scrollSpeed = 5;

  function scrollContent() {
    const totalHeight = receiptPreview.scrollHeight;
    const visibleHeight = receiptPreview.clientHeight;
    
    if (receiptPreview.scrollTop + visibleHeight >= totalHeight) {
      cancelAnimationFrame(animateScroll);
    } else {
      receiptPreview.scrollTop += scrollSpeed;
    }
  }

}

function dateAndTimeFormat (dateVal) {
    var date_time_str = dateVal;
    var date_time_obj = new Date(date_time_str);

    var options = { year: 'numeric', month: 'short', day: 'numeric' };
    var formatted_date = date_time_obj.toLocaleDateString('en-US', options);

    var optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
    var formatted_time = date_time_obj.toLocaleTimeString('en-US', optionsTime);
  
    return {
        formatted_date: formatted_date,
        formatted_time: formatted_time
    };
}


function getTransactionSales(transaction) {
    axios.post('api.php?action=getTransactionsByNumJS', {
        'transNo': transaction
    })
    .then(function (response) {
        // console.log(response.data.response)
        var dateAdnTimeFomatted = dateAndTimeFormat(response.data.response[0].date_time_of_payment)
        let receiptId = response.data.response[0].receipt_id;
       
        let fullName;

        if(response.data.response[0].temporary_name != null) {
            fullName = response.data.response[0].temporary_name
        } else {
            fullName = response.data.response[0].first_name + ' ' + response.data.response[0].last_name
        }
        let formattedReceiptId = receiptId.toString().padStart(8, '0');
        $('.receipt_type').text('PREVIEW RECEIPT')
        $('.transactionNo').text('Transaction #: ' + response.data.response[0].transaction_num);
        $('#or_num_id').text('OR # ' + formattedReceiptId)

        $('.cus_type').text('Customer Type: ' + response.data.response[0].name)
        $('.date_transac').text('Date: ' + dateAdnTimeFomatted.formatted_date);
        $('.time_transac').text('Time ' + dateAdnTimeFomatted.formatted_time)
        $('.Payer').text(fullName);
        var TotalQty = 0;
        var totalAmount = 0; 

        var lengthResponse = response.data.response.length;
        const container = $('#soldProduct');
        container.empty();
        var soldProduct = response.data.response;

        for (const key in soldProduct) {
            if (soldProduct.hasOwnProperty(key)) {
                const transacNum = $('.Preview_transacNo');
                const label = $('<label class="orderProducts"></label>');

                if (soldProduct[key].isVAT == '1') {
                    label.html('<span style="font-weight: bold">' + soldProduct[key].prod_desc + " (V) " + '</span>' + '<br>' +soldProduct[key].totalProdQty + " x &#8369; " + addCommas(parseFloat(soldProduct[key].prod_price).toFixed(2)) +
                        `<span style="float: right" class="subTotal_receipt">&#8369; ${addCommas(parseFloat(soldProduct[key].totalSubtotal).toFixed(2))}</span>`);
                } else {
                    label.html('<span style="font-weight: bold">' + soldProduct[key].prod_desc + " (N) " + '</span>' + '<br>' +soldProduct[key].totalProdQty + " x &#8369; " + addCommas(parseFloat(soldProduct[key].prod_price).toFixed(2)) +
                        `<span style="float: right" class="subTotal_receipt">&#8369; ${addCommas(parseFloat(soldProduct[key].totalSubtotal).toFixed(2))}</span>`);
                }
                TotalQty += parseInt(soldProduct[key].totalProdQty);
                transacNum.text(soldProduct[key].transaction_num)
                container.append(label);
            }
        }

        for(var i = 0; i < lengthResponse; i++) {
            totalAmount += parseFloat(response.data.response[i].totalSubtotal);
        }

        var res = response.data.response[0];
        let htmlContent = '';
        const paymentMethod = response.data.paymentMethod;
      
        const paymentSelected = JSON.parse(response.data.response[0].payment_details);
        for(var j = 0; j < paymentSelected.length; j++) {
            if(paymentSelected[j].amount != 0) {
                for(var i = 0; i < paymentMethod.length; i++) {
                    if (paymentMethod[i].id == paymentSelected[j].index) {
                        
                        var methodPay = paymentMethod[i].method; 
                        var amountPay = parseFloat(paymentSelected[j].amount).toFixed(2);
                        // $('.payments').append(methodPay + ' <span style="float: right" class="PaidAmount">' + addCommas(amountPay) + '</span><br>');
                        htmlContent += methodPay + ' <span style="float: right" class="PaidAmount">&#8369; ' + addCommas(parseFloat(amountPay).toFixed(2)) + '</span><br>';
                    }
                }
            }
            $('.payments').html(htmlContent);
        }
       

        $('.itemQty').html('ITEM QTY <span style="float: right" class="TotalQty" id="TotalQty">' + addCommas(TotalQty) + '</span>');
        $('.tAmount').html('AMOUNT <span style="float: right" class="TotalAmount" id="TotalAmount">&#8369; ' + (addCommas(parseFloat(totalAmount).toFixed(2))) + '</span>' );
        $('.reg_dis').html('<span style="text-transform: uppercase;">' + res.name + '</span>' +' DISCOUNT <span style="float: right" id="CustomerDiscount">&#8369; 0.00' + '</span>');
        $('.discount_item').html('ITEM(s) DISCOUNT <span style="float: right" id="ItemsDiscount">&#8369; 0.00' + '</span>');
        $('.totalPayment_preview').html('TOTAL <span style="float: right;" id="TotalPayment">&#8369; ' + addCommas(parseFloat(res.payment_amount - res.change_amount).toFixed(2)) + '</span>');
        $('.tendered').html('<label class="tendered" style="text-align: center">Tendered: </label>');
        $('.payment_change').html('CHANGE <span style="float: right" id="ChangeAmount">&#8369; '+ addCommas(parseFloat(res.change_amount).toFixed(2)) +' </span>');

    })
    .catch(function(error) {
        console.log(error);
    });
}

function getRefundedSales(refunded, referenceNum) {
    axios.post('api.php?action=getRefundedSales', {
        'payment_id' : refunded,
        'reference_num' : referenceNum,
    })
    .then(function(response) {
        // console.log(response.data.refunded)

        var dateAdnTimeFomatted = dateAndTimeFormat(response.data.refunded[0].date)
        let receiptId = response.data.refunded[0].ref_num;
        let fullName;

        if(response.data.refunded[0].temporary_name != null) {
            fullName = response.data.refunded[0].temporary_name
        } else {
            fullName = response.data.refunded[0].first_name + ' ' + response.data.refunded[0].last_name
        }

        let formattedReceiptId = receiptId.toString().padStart(8, '0');
        $('.Payer').text(fullName);
        $('.receipt_type').text('REFUND RECEIPT')
        $('#or_num_id').text('Refund #: ' + response.data.refunded[0].refund_num)
        $('.transactionNo').html('<strong>Reference #:' + formattedReceiptId + '</strong>');
        $('.date_transac').text('Date: ' + dateAdnTimeFomatted.formatted_date );
        $('.time_transac').text('Time ' + dateAdnTimeFomatted.formatted_time)
        $('.cus_type').text('Customer Type: ' + response.data.refunded[0].discountType)

        var TotalQty = 0;
        var totalAmount = 0; 

        var lengthResponse = response.data.refunded.length;
        const container = $('#soldProduct');
        container.empty();
        var refundProduct = response.data.refunded;

        for (const key in refundProduct) {
            if (refundProduct.hasOwnProperty(key)) {
                const label = $('<label class="orderProducts"></label>');
                if (refundProduct[key].isVAT == '1') {
                    label.html(refundProduct[key].qty + "x" + parseFloat(refundProduct[key].prod_price).toFixed(2) + ' - ' + refundProduct[key].prod_desc + " (V) " +
                        `<span style="float: right" class="subTotal_receipt">${parseFloat(refundProduct[key].totalSubtotal).toFixed(2)}</span>`);
                } else {
                    label.html(refundProduct[key].qty + "x" + parseFloat(refundProduct[key].prod_price).toFixed(2) + ' - ' + refundProduct[key].prod_desc + " (N) " +
                        `<span style="float: right" class="subTotal_receipt">${parseFloat(refundProduct[key].totalSubtotal).toFixed(2)}</span>`);
                }
                TotalQty += parseInt(refundProduct[key].qty);
                container.append(label);
            }
        }

        for(var i = 0; i < lengthResponse; i++) {
            totalAmount += parseFloat(response.data.refunded[i].totalSubtotal);
        }

       
        $('.itemQty').html('<strong>TOTAL REFUND' + '<span style="float: right">' + parseFloat(totalAmount).toFixed(2) + '</span>');
        $('.tAmount').html('<hr class="new2">');
        $('.reg_dis').html('');
        $('.discount_item').html('');
        $('.totalPayment_preview').html('');
        $('.tendered').html('');
        $('.payments').html('');
        $('.payment_change').html('');
        // $('.TotalAmount').html(parseFloat(totalAmount).toFixed(2));
        
    })
    .catch(function(error) {
        console.log(error)
    })
}



function getAllSalesHistory() {
    var existingData = [];
    var existingDataRefund = [];
    var salesIndexRow = -1;
    var selectedDateRange = $(".dateRange").val();
    var selectedFilter = $("#select_filter").val();
    var selected_doc = $(".select_filter_doc_type").val();
    var selectedDates = selectedDateRange.split(" to ");
    var startDate = new Date(selectedDates[0]);
    var endDate = new Date(selectedDates[1]);

    var yesterDay = new Date (currentDate())
    var thisMonth = new Date(currentDate())
    var currentYear = new Date().getFullYear();
    

    var all = selected_doc === 'ALL';
    var succ = selected_doc === 'SUCCESS';
    var refunded_doc = selected_doc === 'REFUNDED';
    var voided_doc = selected_doc === 'VOID';
    var testRow = document.querySelectorAll('.selectable-sales-row');
    var texts = [];
    var lastCell;
    function returnTextStat () {
        testRow.forEach(function(t_row) {
            var lastCell = t_row.querySelector('td:last-child');
            var text = lastCell.textContent.trim();
            
            texts.push(text);
        });
        return texts;
    }

    
    if (selectedFilter === 'TODAY') {
        startDate = dateAndTimeFormat(currentDate()).formatted_date;
        
        $('.dateRange').prop('disabled', true);
        $('.current_date').text(startDate);
    } else if (selectedFilter === 'YESTERDAY') {
        yesterDay.setDate(yesterDay.getDate() - 1);
        
        startDate = dateAndTimeFormat(yesterDay).formatted_date;
        $('.current_date').text(startDate);
        $('.dateRange').prop('disabled', true);
    } else if (selectedFilter === 'THIS WEEK') {
        Date.prototype.getWeek = function () {
            var dt = new Date(this.getFullYear(), 0, 1);
            return Math.ceil((((this - dt) / 86400000) + dt.getDay() + 1) / 7);
        };

        var thisWeek = new Date();
        var firstDayOfWeek = new Date(thisWeek);
        firstDayOfWeek.setDate(thisWeek.getDate() - thisWeek.getDay()); 

        var lastDayOfWeek = new Date(thisWeek);
        lastDayOfWeek.setDate(thisWeek.getDate() - thisWeek.getDay() + 6);

        startDate = dateAndTimeFormat(firstDayOfWeek).formatted_date;
        endDate = dateAndTimeFormat(lastDayOfWeek).formatted_date;

        $('.dateRange').prop('disabled', true);
        $('.current_date').text(startDate + ' to ' + endDate);
    } else if (selectedFilter === 'THIS MONTH') {
        thisMonth.setDate(thisMonth.getMonth());
        var date = new Date(), y = date.getFullYear(), m = date.getMonth();
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        $('.dateRange').prop('disabled', true);
        var startDateString = dateAndTimeFormat(thisMonth).formatted_date;
        startDate = new Date(startDateString);
        startDate.setDate(startDate.getDate() - 1);
        startDate = dateAndTimeFormat(startDate).formatted_date
        endDate = dateAndTimeFormat(lastDay).formatted_date;
        $('.current_date').text(dateAndTimeFormat(startDate).formatted_date + ' to ' + dateAndTimeFormat(endDate).formatted_date);
       
    } else if (selectedFilter === 'THIS YEAR') {
        startDate = dateAndTimeFormat(new Date(currentYear, 0, 1)).formatted_date;
        endDate = dateAndTimeFormat(new Date(currentYear, 11, 31)).formatted_date;
        $('.dateRange').prop('disabled', true);
        $('.current_date').text(startDate + ' to ' + endDate);
        // console.log(startDate, endDate)
    } else if (selectedFilter === 'CUSTOM') {
        $('.dateRange').prop('disabled', false);
        var startDate = new Date(selectedDates[0]);
        var endDate = new Date(selectedDates[1]);
        startDate = dateAndTimeFormat(new Date(selectedDates[0])).formatted_date
        endDate = dateAndTimeFormat(new Date(selectedDates[1])).formatted_date
        $('.current_date').text(dateAndTimeFormat(currentDate()).formatted_date);
    }


    axios.get('api.php?action=getSalesHistory')
    .then(function(response) {
        var salesHistory = response.data.data;
        var refundedData = response.data.data2;
        var startingIndex = salesHistory.length;
        var saleDate;
       
      $('.salesHistoryTable tbody').empty();
        
      $.each(salesHistory, function(index, sale) {
        if(selectedFilter === 'CUSTOM') {
            saleDate = dateAndTimeFormat(sale.date_time_of_payment).formatted_date;
        } else {
            saleDate = dateAndTimeFormat(sale.date_time_of_payment).formatted_date;
        }

        function getFilterTable(saleDate, startDate, endDate) {
            if(selectedFilter === 'TODAY' && ((sale.is_void == 2 && selected_doc == 'VOIDED') 
            || (sale.is_paid == 1 && sale.is_refunded == 0 && sale.is_void == 0 && selected_doc == 'SUCCESS' ) 
            || (sale.is_paid == 1 && sale.is_refunded == 1 && refundedData.find(function(ref) { return ref.or_num === sale.or_num; }) && selected_doc == 'REFUNDED') 
            ||  (sale.is_paid == 1 && sale.is_refunded == 2 && selected_doc == 'RET&EX')
            || selected_doc == 'ALL')) {
                return saleDate == dateAndTimeFormat(startDate).formatted_date;
            } else if (selectedFilter == 'YESTERDAY' && ((sale.is_void == 2 && selected_doc == 'VOIDED') 
            || (sale.is_paid == 1 && sale.is_refunded == 0 && sale.is_void == 0 && selected_doc == 'SUCCESS' ) 
            || (sale.is_paid == 1 && sale.is_refunded == 1 && refundedData.find(function(ref) { return ref.or_num === sale.or_num; }) && selected_doc == 'REFUNDED') 
            ||  (sale.is_paid == 1 && sale.is_refunded == 2 && selected_doc == 'RET&EX')
            || selected_doc == 'ALL')) {
                return saleDate == dateAndTimeFormat(startDate).formatted_date;
            } else if ((selectedFilter === 'THIS WEEK' || selectedFilter === 'THIS MONTH') && ((sale.is_void == 2 && selected_doc == 'VOIDED') 
            || (sale.is_paid == 1 && sale.is_refunded == 0 && sale.is_void == 0 && selected_doc == 'SUCCESS' ) 
            || (sale.is_paid == 1 && sale.is_refunded == 1 && refundedData.find(function(ref) { return ref.or_num === sale.or_num; }) && selected_doc == 'REFUNDED') 
            ||  (sale.is_paid == 1 && sale.is_refunded == 2 && selected_doc == 'RET&EX')
            || selected_doc == 'ALL')) {
                return saleDate >= dateAndTimeFormat(startDate).formatted_date && saleDate <= dateAndTimeFormat(endDate).formatted_date; 
            }
            else if (selectedFilter === 'THIS YEAR' && ((sale.is_void == 2 && selected_doc == 'VOIDED') 
            || (sale.is_paid == 1 && sale.is_refunded == 0 && sale.is_void == 0 && selected_doc == 'SUCCESS' ) 
            || (sale.is_paid == 1 && sale.is_refunded == 1 && refundedData.find(function(ref) { return ref.or_num === sale.or_num; }) && selected_doc == 'REFUNDED') 
            ||  (sale.is_paid == 1 && sale.is_refunded == 2 && selected_doc == 'RET&EX')
            || selected_doc == 'ALL')) {
                return saleDate >= dateAndTimeFormat(startDate).formatted_date || saleDate <= dateAndTimeFormat(endDate).formatted_date;
            }
             else if (selectedFilter === 'CUSTOM' && ((sale.is_void == 2 && selected_doc == 'VOIDED') 
            || (sale.is_paid == 1 && sale.is_refunded == 0 && sale.is_void == 0 && selected_doc == 'SUCCESS' ) 
            || (sale.is_paid == 1 && sale.is_refunded == 1 && refundedData.find(function(ref) { return ref.or_num === sale.or_num; }) && selected_doc == 'REFUNDED') 
            ||  (sale.is_paid == 1 && sale.is_refunded == 2 && selected_doc == 'RET&EX')
            || selected_doc == 'ALL')) {
                return saleDate >= startDate && saleDate <= endDate;
            }
        }
        
        if (getFilterTable(saleDate, startDate, endDate) ) {
            displaySalesReport ()
        }

        function displaySalesReport() {
            var descendingIndex = startingIndex - index;
            if (existingData.indexOf(sale.or_num) === -1) {
            var row = '<tr class="selectable-sales-row"' +
            'data-transaction="' + sale.transaction_num + '" ' +
            'data-userid="' + sale.customer_id + '" ' +
            'data-ornums="'+ (LeftPadWithZeros(sale.or_num, 8)) + '" ' +
            '>' +
            '<td colspan="1">' + (descendingIndex) + '</td>' +
            '<td colspan="2">' + (LeftPadWithZeros(sale.or_num, 8)) + '</td>' +
            '<td colspan="2">' + ' ' + '</td>' +
            '<td colspan="2">' + 'Sale' + '</td>' +
            '<td colspan="2">' + dateAndTimeFormat(sale.date_time_of_payment).formatted_date + " " + dateAndTimeFormat(sale.date_time_of_payment).formatted_time + '</td>';

            if(sale.temporary_name != null) {
                row += '<td colspan="2">' + sale.temporary_name + '</td>' ;
            } else {
                row += '<td colspan="2">' + sale.customer_fname + ' ' + sale.cutomer_lname + '</td>' ;
            }
            
            row += '<td colspan="2">' + sale.customer_type + '</td>' +
            '<td colspan="2">' + addCommas(parseFloat(sale.toBePaid).toFixed(2)) + '</td>';

                if (sale.is_paid == 1 && sale.is_refunded == 0 && sale.is_void == 0) {
                    row += '<td class="text-success" >' + 'SUCCESS' + '</td>';
                }

                else if (sale.is_void == 2) {
                    row += '<td class="text-danger" >' + 'VOIDED' + '</td>';
                }

                else if (sale.is_paid == 1 && sale.is_refunded == 1 && refundedData.find(function(ref) { return ref.or_num === sale.or_num; })) {
                row += '<td class="text-warning" >' + 'REFUNDED' + '</td>';
                var refunds = refundedData.filter(function(ref) { return ref.or_num === sale.or_num; });
                    // Loop through all refunds and append a refund row for each one
                    refunds.forEach(function(refund) {
                        var row = '<tr class="selectable-sales-row"' +
                            'data-paymentid="'+ refund.payment_id +'"' + 
                            'data-references="'+ refund.reference_num +'"' +
                            '>' +
                            '<td class="color_text" colspan="1" style="font-size: large; padding: 0;text-align: center; padding-top: 7px">' + '&#x21B1;'  + '</td>' +
                            '<td class="color_text" colspan="2">' + refund.reference_num  + '</td>' +
                            '<td class="color_text" colspan="2">' + (LeftPadWithZeros(refund.or_num, 8))  + '</td>' +
                            '<td class="color_text" colspan="2">' + 'Refund'  + '</td>' +
                            
                            '<td class="color_text" colspan="2">' + dateAndTimeFormat(refund.refunded_date_time).formatted_date + " " + dateAndTimeFormat(refund.refunded_date_time).formatted_time + '</td>';

                            if(refund.temporary_name != null) {
                                row += '<td class="color_text" colspan="2">' + refund.temporary_name + '</td>' ;
                            } else {
                                row +=  '<td class="color_text" colspan="2">' + refund.customer_fname + ' ' + refund.cutomer_lname  + '</td>' ;
                            }


                            row += '<td class="color_text" colspan="2">' + refund.customer_type  + '</td>' +
                            '<td class="color_text" colspan="2">' + addCommas(parseFloat(refund.totalRefunded).toFixed(2))  + '</td>' +
                            '<td colspan="2" class="text-success">' + 'SUCCESS'  + '</td>' +
                        '</tr>';
                        $('.salesHistoryTable tbody').append(row);
                    });
                } 

                else if (sale.is_paid == 1 && sale.is_refunded == 2) {
                    row += '<td class="text-primary" >' + 'RET&EX' + '</td>';
                    var refund2 = refundedData.find(function(ref) { return ref.or_num === sale.or_num; });

                    if (refund2) {
                        // Only append a refund row if the refund matches the sale
                        $('.salesHistoryTable tbody').append(row);
                        row = '<tr class="selectable-sales-row"' +
                        'data-paymentid="'+ refund2.payment_id +'"' + '>' +
                        '<td class="color_text" colspan="1">' + ' '  + '</td>' +
                        '<td class="color_text" colspan="2">' + refund2.reference_num  + '</td>' +
                        '<td class="color_text" colspan="2">' + (LeftPadWithZeros(refund2.or_num, 8))  + '</td>' +
                        '<td class="color_text" colspan="2">' + 'Refund'  + '</td>' +
                        '<td class="color_text" colspan="2">' + refund2.refunded_date_time  + '</td>' +
                        '<td class="color_text" colspan="2">' + refund2.customer_fname + ' ' + refund2.cutomer_lname  + '</td>' +
                        '<td class="color_text" colspan="2">' + refund2.customer_type  + '</td>' +
                        '<td class="color_text" colspan="2">' + addCommas(parseFloat(refund2.totalRefunded).toFixed(2));  + '</td>' +
                        '<td colspan="2" class="text-success">' + 'SUCCESS'  + '</td>' +
                    '</tr>'
                    }

                }
    
                if(sale.is_void == 1) {
                    row += '<td style="color: red;" >' + 'VOID' + '</td>';
                }

                row += '</tr>';
                $('.salesHistoryTable tbody').append(row);
            }
        }
      });
      scrollToSelectedRow_sales()
      selectRow($('.selectable-sales-row').first());
      
    })
    .catch(function(error) {
      console.error('Error fetching sales history:', error);
    });

    var selectedRow = null;
        function selectRow(row) {
            $('.selectable-sales-row.selected').removeClass('selected');
            selectedRow = row;
            selectedRow.addClass('selected'); 
        
            if (selectedRow && selectedRow.length > 0) {
            var offset = selectedRow.offset();
            if (offset) {
                $('html, body').animate({
                scrollTop: offset.top - $(window).height() / 2
                }, 1);
            }
            if($(row).data('transaction')) {
                var transactionValue = $(row).data('transaction');
                getTransactionSales(transactionValue)
                $('.color_text').css('color', '#fc3d49');
            } else {
                var refunded = $(row).data('paymentid')
                var referenceNum = $(row).data('references')
                if (referenceNum) {
                    $(row).find('.color_text').css('color', 'black');
                }
                getRefundedSales(refunded, referenceNum)
            }

            }
        }

        $('.salesHistoryTable tbody').on('click', '.selectable-sales-row', function() {
            $('.selectable-sales-row').removeClass('selected'); 
            $(this).addClass('selected'); 
            selectRow($(this)); 
        });

        function moveSelection(direction) {
            if (selectedRow) {
                var nextRow = (direction === 'up') ? selectedRow.prev('.selectable-sales-row') : selectedRow.next('.selectable-sales-row');
                if (nextRow.length) {
                    selectRow(nextRow);
                }
                scrollToSelectedRow_sales()
            } else {
                var rowToSelect = (direction === 'up') ? $('.selectable-sales-row').last() : $('.selectable-sales-row').first();
                selectRow(rowToSelect);
                scrollToSelectedRow_sales()
            }
        }

        
        $(document).off('keydown.selectRowSalesHistory');
        $(document).on('keydown.selectRowSalesHistory', function (e) {
        $(document).off('keydown.selectRowTransaction');
          switch(e.which) {
              case 38: 
                  moveSelection('up');
                 
                  e.preventDefault();
                  break;
              case 40: 
                  moveSelection('down');
                  e.preventDefault();
                  
                  break;
              default:
                  return; 
          }
          e.preventDefault();
      }); 
      
      
    $('.closeBtnSalesHistory').click(function () {
        $('.salesHistoryModal').hide();
        event.stopPropagation();
    })

    
}


</script>


<style>

option {
    background: #262626
}


.custom_form_control {
    height: 33px;
    margin-top: -10px;
    padding-left: 10px;
    background: transparent;
    outline: 0;
}

    .color_text {
        color: #fc3d49;
    }
    .select_filter_doc_type {
        border: none;
        margin-right: 10px;
        border-radius: 0;
        background: transparent;
        border: 1px solid #4B413E; 
        color: #fff;
        font-size: small;
        width: auto;
    }

    .select_filter {
        border: none;
        margin-right: 10px;
        border-radius: 0;
        background: transparent;
        border: 1px solid #4B413E; 
        color: #fff;
        font-size: small;
        width: auto;
    }

    /* span.flatpickr-day  {
        color: #fff;
    }

    div.flatpickr-months {
        color: #fff;
    } */

    .search_input_history input {
        font-size: small;
    }
    
    .dateRange {
        font-size: small;
        background: transparent; 
        color: #fff;
        outline: solid 1px #4B413E;
    }

     input.dateRange {
        width: 100%
    }

    .receipt_preview_history {
        border: 1px solid #4B413E; 
        height: 600px; 
        color: #000;
        padding: 0;
        overflow-y: auto;
        scrollbar-width: 0; 
        scrollbar-color: transparent; 
        padding: 10px;
        width: 300px;
       
    }

    
    .row_button button {
        font-size: small;
    }
    

    .d-flex svg.bi.bi-calendar-check {
        margin-left: 10px;
        margin-top: -10px
    }
 
    .sales_history {
        height: 600px; 
        color: #000;
        padding: 0;
        overflow-y: auto;
        scrollbar-width: 0; 
        scrollbar-color: transparent;
        font-size: small;
    }

    .sales_history::-webkit-scrollbar {
        width: 0;
    }

    .sales_history::-webkit-scrollbar-thumb {
        background-color: transparent;
    }

    /* #receipt_information {
        height: 600px;
        display: flex;
        flex-direction: column;
    } */


    .receipt_preview_history::-webkit-scrollbar {
        width: 0;
    }

    .receipt_preview_history::-webkit-scrollbar-thumb {
        background-color: transparent;
    }
    
    .dateRange {
        width: auto;
        border: none;
        border-radius: 0;
    }


    .headTitle {
        font-weight: bold;
    }

    .spanUserName {
        color: #FF6700;

    }

    .salesContent {
        margin: 10px;
        border: solid 1px #4B413E;
        padding: 20px; 
        
    }


    .closeBtnSalesHistory {
        background-color: #262626;
        border: solid 1px #4B413E;
        color: #ffff;
        border-radius: 0;
        font-weight: bold;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        width: auto;
    }

    .close {
        float: right;
    }

    .d-flex {
        display: flex;
        justify-content: space-between; 
        align-items: center;
    }

    .buttonActions button {
        background-color: #262626;
        border: solid 1px #4B413E;
        color: #ffff;
        border-radius: 0;
        font-weight: bold;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        width: auto
    }

    #cancel_receipt {
        background: red;
    }


    /* Background and Text Color */
    .flatpickr-calendar {
        background: #262626 !important;
    }

    .flatpickr-calendar .flatpickr-days, .flatpickr-calendar .day, .flatpickr-calendar .weekday {
        color: #fff !important;
    }

    /* Header Styling */
    .flatpickr-calendar .flatpickr-month {
        background: #262626 !important; /* Slightly lighter than the main background for depth */
        color: #fff !important;
    }

    /* Size Adjustments for a Compact Look */
    .flatpickr-calendar {
        font-size: 12px !important; /* Smaller text */
    }

    .flatpickr-day {
        padding: 0 !important;
        width: 24px !important;
        height: 24px !important; /* Smaller day cells */
        line-height: 24px !important;
    }

    /* Adjust the calendar width */
    .flatpickr-calendar .flatpickr-innerContainer, .flatpickr-calendar .flatpickr-rContainer {
        width: auto !important; /* Adjust based on new cell sizes */
    }

    /* Hover and Active State for Better Visibility */
    .flatpickr-day:hover, .flatpickr-day.today, .flatpickr-day.selected {
        background: #555 !important; /* Darker background for hover */
        color: #fff !important;
    }


    .flatpickr-monthDropdown-months {
        background-color: #262626 !important; /* Your desired background color */
        color: #fff !important; /* Adjust text color as needed */
    }

    /* Change background color of year dropdown, if applicable */
    .flatpickr-monthDropdown-months, .numInput {
        background-color: #262626 !important; /* Your desired background color */
        color: #fff !important; /* Adjust text color as needed */
    }

    input.numInput.cur-year {
        font-size: small;
    }

    span.flatpickr-weekday {
        color: #fff;
    }

    span.flatpickr-day {
        color: #fff;
    }


    span.flatpickr-day.nextMonthDay {
        color: gray;
    }

    span.flatpickr-day.prevMonthDay {
        color: gray;
    }

    /* span.flatpickr-day.inRange {
        background: transparent;
    } */

    div.flatpickr-calendar.rangeMode.animate.open.arrowTop.arrowLeft {
        border: 1px solid rgb(75, 65, 62);
        box-shadow: none;
        outline: 0;
        border-radius: 0;
    }

</style>