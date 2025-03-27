


<div class="modal" id="denominationModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 23%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
          
        <div class="d-flex">
            <h5>DENOMINATION</h5>
            <button style="margin-top: -10px;" class="btn btn-secondary shadow-none primary_button_style closeBtnEndOfDay"><i class="fa fa-times"></i></button>
        </div>

        <div class="denomination">
            <div class="text-center">
            
                <h6>Click +ADD button to count <span><br></span> cash denomination</h6>
                <div class="d-flex" style="justify-content: flex-start">
                    <select name="select_bill" id="select_bill">
                        <option value="ALL">Bill</option>
                        <option value="1000">&#8369; 1,000.00</option>
                        <option value="500">&#8369; 500.00</option>
                        <option value="200">&#8369; 200.00</option>
                        <option value="100">&#8369; 100.00</option>
                        <option value="50">&#8369; 50.00</option>
                        <option value="20">&#8369; 20.00</option>
                        <option value="10">&#8369; 10.00</option>
                        <option value="5">&#8369; 5.00</option>
                        <option value="1">&#8369; 1.00</option>
                        <option value="0.50">&#8369; 0.50</option>
                        <option value="0.25">&#8369; 0.25</option>
                        <option value="0.10">&#8369; 0.10</option>
                        <option value="0.5">&#8369; 0.5</option>
                        <option value="0.1">&#8369; 0.1</option>
                    </select>

                    <input type="number" hidden class="report_type">

                    <input type="number" placeholder="Enter a quantity" class="bill_qty">
                    <button class="primary_button_style add_bill btn btn-secondary">[+]ADD</button>
                </div>

                <table class="billsTable">
                    <thead>
                        <tr style="border: 1px solid #FF6700; color: #FF6700">
                            <td style="padding-left: 5px;">BILL</td>
                            <td>PCS</td>
                            <td>TOTAL</td>
                            <td class="text-center">ACTION</td>
                        </tr> 
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            
        </div>

        <h5 class="total_cash">Total Cash: <span id="cash_drawer">0.00</span></h5>

        <div class="d-flex justify-content-end">
            <button class="primary_button_style btn btn-secondary submitCashCount">SUBMIT</button>
        </div>

      </div>
    </div>
  </div>
</div>



<div class="modal" id="attentionReqModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
          
        <div class="d-flex">
            <h4 style="font-weight: bold"><span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
            </span> ATTENTION REQUIRED!</h4>
            <button style="margin-top: -10px;" class="btn btn-secondary shadow-none primary_button_style closeBtnEndOfDay"><i class="fa fa-times"></i></button>
        </div>

        <div class="requiredAttention text-center">
            <h4>NO BILL/s ENTERED</h4> <br>

            <p style="font-size: large">To complete the End-of-Day, a cash count report must
                be sumitted. Otherwise, you counter will remain open.
            </p> <br>

            <p style="font-size: large">Are you sure you want to exit <span style="color: #FF6700; font-weight: bold">Cash Count</span> report?</p>
        </div>

        <div class="d-flex warning_btn">
            <button class="primary_button_style no_warning_btn btn btn-secondary">NO</button>
            <button class="primary_button_style yes_warning_btn btn btn-secondary">YES</button>
        </div>

      </div>
    </div>
  </div>
</div>


<script>


function toPrintOrRecordZreading() {

    function addLeadingZeros(number, length) {
        return String(number).padStart(length, '0');
    }

    var totalSales_amount = 0; 
    var changeAmount = 0;
    var overAllTotalSales = 0; 
    var totalVatSales = 0;

    var Vat_Amount = 0;
    var VatTableSales = 0;
    var Vat_Amount_ex = 0;
    var toSubtract = 0;

    var item_discount = 0;
    var customer_discount = 0;

    var totalVoidVat = 0
    var vat_return = 0;
    var vat_refunded = 0;

    var totalReturnAmount = 0;
    var totalAmountVoid = 0;
    var totalRefundAmount = 0;

    var reg_dis = 0;
    var reg_vat = 0;

    var sc_dis = 0;
    var sc_vat = 0;

    var officer_dis = 0;
    var officers_vat = 0;

    var sp_dis = 0;
    var single_parent_vat = 0;

    var pwd_dis = 0;
    var pwd_person_vat = 0;

    var naac_dis = 0;
    var naac_person_vat = 0;


    var teacher_dis = 0;
    var teacher_person_vat = 0;

    var totalCash = 0;
    var totalCcDb = 0;
    var totalEwallet = 0;
    var totalCoupon = 0;
    var totalCashIn = 0;
    var totalCashOut = 0;

    var void_beg = addLeadingZeros(0, 8);
    var void_end = addLeadingZeros(0, 8);

    var si_beg = addLeadingZeros(0, 8);
    var si_end = addLeadingZeros(0, 8);

    var return_beg = addLeadingZeros(0, 8);
    var return_end = addLeadingZeros(0, 8);

    var refund_beg = addLeadingZeros(0, 8);
    var refund_end = addLeadingZeros(0, 8);

    var prev_acc_sales = 0;
    var creditPayment = 0;


    axios.get('api.php?action=getAllPayments')
    .then(function(response) {
        var allPayment = response.data.data; // current day payments (sales)
        var overAllPayment = response.data.data2; // over all payments (sales)
        var getTotalVats = response.data.getTotalVat;
        var getAllTransact = response.data.getAllTransac;
        var return_pro = response.data.return_prod;
        var void_tran = response.data.void_transaction;
        var refunded_prod = response.data.refundedProduct;
        var transactionSummary = response.data.transactionSummary; 
        var cashInCashOut = response.data.cashIn_cashOut;
        var si_BegAndEnd = response.data.si_beg_and_end;

        var prev_sales = response.data.previous_sales;
        var p_details;
        var convert_toJson;
        // current sales
        for (var i = 0; i < allPayment.length; i++) {
            p_details = response.data.data[i].payment_details;
            convert_toJson = JSON.parse(p_details);
            if (convert_toJson != null) {
            var change_am = parseFloat(allPayment[i].change_amount)
            changeAmount += change_am;
                $.each(convert_toJson, function(index, value) {
                    if (value.amount != 0) {
                        var allAmount = parseFloat(value.amount);
                        totalSales_amount += parseFloat(allAmount);
                    }
                });
            }
        }

        // over all sales
        for (var i = 0; i < overAllPayment.length; i++) {
        p_details = response.data.data2[i].payment_details;
        convert_toJson = JSON.parse(p_details);
        // console.log(response.data.data2[i].change_amount)
        if (convert_toJson != null) {
                $.each(convert_toJson, function(index, value) {
                    if (value.amount != 0) {
                        var OverallAmount = parseFloat(value.amount).toFixed(2);
                        overAllTotalSales += parseFloat(OverallAmount);  
                    }
                });
            }
        }

        // over all sales
        for (var i = 0; i < prev_sales.length; i++) {
        var prevSales = response.data.data2[i].payment_details;
        convert_toJson = JSON.parse(prevSales);
        
        if (convert_toJson != null) {
                $.each(convert_toJson, function(index, value) {
                    if (value.amount != 0) {
                        var previous_sale = parseFloat(value.amount).toFixed(2);
                        prev_acc_sales += parseFloat(previous_sale);  
                        
                    }
                });
            }
        }

        // get all total vat and vatable sales        
        for(var i = 0; i < getTotalVats.length; i++) {

        if(getTotalVats[i].isVAT == 1) {

            if(getTotalVats[i].VAT) {
            var vm = getTotalVats[i].VAT
            Vat_Amount += vm;
            } 

            if (getTotalVats[i].totalVatSales) {
            var vs = getTotalVats[i].totalVatSales
            VatTableSales += vs;
            }
        } else {

                if(getTotalVats[i].VAT) {
                var vm_ex = getTotalVats[i].VAT
                Vat_Amount_ex += vm_ex;
                }
                
                if(getTotalVats[i].fcustomer_discount) {
                var sub_amount = getTotalVats[i].fcustomer_discount;
                toSubtract += sub_amount; 
                }
        }
        }

        
        for(var i = 0; i < getAllTransact.length; i++) {
        if(getAllTransact[i].totalDis || getAllTransact[i].fcustomer_discount) {
            var totalDiscount_item = getAllTransact[i].totalDis;
            var cus_discount = getAllTransact[i].fcustomer_discount;
            if(getAllTransact[i].customer_type == 'SC' && getAllTransact[i].isVAT == 1) {
            var senior_discount = getAllTransact[i].fcustomer_discount;
            var senior_vat = getAllTransact[i].VAT;
            sc_dis += senior_discount;
            sc_vat += senior_vat
            } else if (getAllTransact[i].customer_type == 'Officer' && getAllTransact[i].isVAT == 1) {
            var officer_discount = getAllTransact[i].fcustomer_discount;
            var officer_vat = getAllTransact[i].VAT;
            officer_dis += officer_discount
            officers_vat += officer_vat
            
            } else if (getAllTransact[i].customer_type == 'SP' && getAllTransact[i].isVAT == 1) {
            var sp_discount = getAllTransact[i].fcustomer_discount;
            var sp_vat = getAllTransact[i].VAT;
            sp_dis += sp_discount
            single_parent_vat += sp_vat

            } else if (getAllTransact[i].customer_type == 'PWD' && getAllTransact[i].isVAT == 1) {
            var pwd_discount = getAllTransact[i].fcustomer_discount;
            var pwd_vat = getAllTransact[i].VAT;
            pwd_dis += pwd_discount
            pwd_person_vat += pwd_vat

            } else if (getAllTransact[i].customer_type == 'NAAC' && getAllTransact[i].isVAT == 1) {
            var naac_discount = getAllTransact[i].fcustomer_discount;
            var naac_vat = getAllTransact[i].VAT;
            naac_dis += pwd_discount
            naac_person_vat += pwd_vat

            } else if (getAllTransact[i].customer_type == 'Teacher' && getAllTransact[i].isVAT == 1) {
            var teach_discount = getAllTransact[i].fcustomer_discount;
            var teach_vat = getAllTransact[i].VAT;
            teacher_dis += pwd_discount
            teacher_person_vat += pwd_vat

            } else if (getAllTransact[i].customer_type == 'Regular' && getAllTransact[i].isVAT == 1) {
            var regular_discount = getAllTransact[i].regular_discount;
            var regular_vat = getAllTransact[i].VAT;

            if(regular_discount != null) {
                reg_dis += regular_discount
                reg_vat += regular_vat
            }
            }
            item_discount += totalDiscount_item; // item discount
            customer_discount += cus_discount; // customer discount
        }
        }

        // return product
        for(var i = 0; i < return_pro.length; i++) {
        if(return_pro[i].prod_price) {
            var return_amount = parseFloat(return_pro[i].prod_price);
            
            if(return_pro[i].isVAT == 1) {
            vat_return = parseFloat(return_pro[i].VAT)
            }
            totalReturnAmount += return_amount
        }

        if (return_pro.length == 1) {
            return_beg = return_pro[0].receipt_num;
            return_end = return_pro[0].receipt_num;
        } else if (return_pro.length > 1) {
            return_beg = return_pro[0].receipt_num;
            return_end = return_pro[return_pro.length - 1].receipt_num;
        }
        }

        // refund product
        for(var i = 0; i < refunded_prod.length; i++) {
        if(refunded_prod[i].prod_price) {
            var refund_amount = parseFloat(refunded_prod[i].prod_price);
            if(refunded_prod[i].isVAT == 1) {
            vat_refunded = parseFloat(refunded_prod[i].VAT)
            }
            totalRefundAmount += refund_amount
        }


        if (refunded_prod.length == 1) {
            refund_beg = refunded_prod[0].receipt_num;
            refund_end = refunded_prod[0].receipt_num;
        } else if (refunded_prod.length > 1) {
            refund_beg = refunded_prod[0].receipt_num;
            refund_end = refunded_prod[refunded_prod.length - 1].receipt_num;
        }
        }
        
        // Less Void
        for(var i = 0; i < void_tran.length; i++) {
        if(void_tran[i].totalVoid) {
            var v_transac = void_tran[i].totalVoid;
            totalAmountVoid += v_transac
            if(void_tran[i].isVAT == 1) {
            var void_vat = void_tran[i].VAT
            totalVoidVat += void_vat;
            }
        }

        if (void_tran.length == 1) {
            void_beg = void_tran[0].receipt_num;
            void_end = void_tran[0].receipt_num;
        } else if (void_tran.length > 1) {
            void_beg = void_tran[0].receipt_num;
            void_end = void_tran[void_tran.length - 1].receipt_num;
        }
        }


        // Transaction Summary
        var credit_debitIds = [11, 12, 13, 14, 15]; // credit and debit id's
        var eWallet_Ids = [2, 3, 8, 9, 10] // e-wallet id's
        for(var i = 0; i < transactionSummary.length; i++) {

        if(transactionSummary[i].payment_method_id == 1) {
            var cash_payment = JSON.parse(transactionSummary[i].payment_details);
            for(var j = 0; j < cash_payment.length; j++) {
            if(cash_payment[j].paymentType == 'cash' && cash_payment[j].amount != 0) {
                var totalCashReceive = cash_payment[j].amount
                totalCash += parseFloat(totalCashReceive);
            }
            }
        } else if(credit_debitIds.includes(transactionSummary[i].payment_method_id)) {
            var credit_debit = JSON.parse(transactionSummary[i].payment_details);
            for(var k = 0; k < credit_debit.length; k++) {
            if(credit_debitIds.includes(transactionSummary[i].payment_method_id) && credit_debit[k].amount != 0) {
                var totalCredit_DebitReceive = credit_debit[k].amount
                totalCcDb += parseFloat(totalCredit_DebitReceive);
            }
            }
        } else if(eWallet_Ids.includes(transactionSummary[i].payment_method_id)) {
            var e_wallets = JSON.parse(transactionSummary[i].payment_details);
            for(var e = 0; e < e_wallets.length; e++) {
            // console.log(e_wallets, ' this your e-wallet receive')
            if(eWallet_Ids.includes(transactionSummary[i].payment_method_id) && e_wallets[e].amount != 0) {
                var e_wallet_receive = e_wallets[e].amount
                totalEwallet += parseFloat(e_wallet_receive);
            }
            }
        } else if(transactionSummary[i].payment_method_id == 7) {
            var coupon_receipt = JSON.parse(transactionSummary[i].payment_details);
            for(var c = 0; c < coupon_receipt.length; c++) {
            if(coupon_receipt[c].paymentType == 'coupon' && coupon_receipt[c].amount != 0) {
                var coupon_receive = coupon_receipt[c].amount
                totalCoupon += parseFloat(coupon_receive)
            }
            }
        } else if (transactionSummary[i].payment_method_id == 5) {
            var credit = JSON.parse(transactionSummary[i].payment_details);
            for(var b = 0; c < credit.length; b++) {
                if(credit[b].paymentType == 'credit' && credit[b].amount != 0) {
                    var creditval = credit[b].amount
                    creditPayment += parseFloat(creditval)
                }
            }

        } else {
            // Don't forget the split payment method
        }
        }


        // Cash in Cash Out
        for(var i = 0; i < cashInCashOut.length; i++) {
        if (cashInCashOut[i].cash_in_amount != null) {
            var allCashInAmount = cashInCashOut[i].cash_in_amount;
            totalCashIn += allCashInAmount
        }

        if(cashInCashOut[i].cash_out_amount != null) {
            var allCashOutAmount = cashInCashOut[i].cash_out_amount;
            totalCashOut += allCashOutAmount
            }
        }


        // Beginning and End of Sales Invoice 

        for(var i = 0; i < si_BegAndEnd.length; i++) {
            if(si_BegAndEnd.length == 1) {
                si_beg = si_BegAndEnd[0].receipt_num;
                si_end = si_BegAndEnd[0].receipt_num;
            } else if (si_BegAndEnd.length > 1) {
                si_beg = si_BegAndEnd[0].receipt_num;
                si_end = si_BegAndEnd[si_BegAndEnd.length - 1].receipt_num;
            }
        }


        var todaySales = totalSales_amount - changeAmount;
        var lessDiscount = (customer_discount + item_discount) - toSubtract;
        var lesssVatAdjustment = vat_return + sc_vat + officers_vat + totalVoidVat + pwd_person_vat;
        var netAmount = (todaySales - (customer_discount + item_discount - toSubtract) - lesssVatAdjustment)
        var other_discounts = (reg_dis + item_discount + teacher_dis);

        var cash_drawer = (totalCash - changeAmount) + totalCashIn;
        var cash_in_receive = (todaySales - (lessDiscount) - (totalReturnAmount) - (totalAmountVoid) - (lesssVatAdjustment));
        var payment_receive = (todaySales - (lessDiscount) - (totalReturnAmount) - (totalAmountVoid) - (lesssVatAdjustment) + totalCcDb + totalCoupon);


        var returData = {
        'present_accumulated_sale' : overAllTotalSales,
        'previous_accumulated_sale' : prev_acc_sales,
        'beg_si' : si_beg,
        'end_si' : si_end,
        'void_beg' : void_beg,
        'void_end' : void_end,
        'return_beg' : return_beg,
        'return_end' : return_end,
        'refund_beg' : refund_beg,
        'refund_end' : refund_end,

        'totalSales' : todaySales,
        'vatable_sales' : VatTableSales,
        'vat_amount' : Vat_Amount,
        'vat_exempt' : Vat_Amount_ex,

        'gross_amount' : todaySales,
        'less_discount' : lessDiscount,
        'less_return_amount' : totalReturnAmount,
        'less_void' : totalAmountVoid,
        'less_vat_adjustment' : lesssVatAdjustment,
        'net_amount' : netAmount,

        'senior_discount' : sc_dis,
        'officer_discount' : officer_dis,
        'pwd_discount' : pwd_dis,
        'naac_discount' : naac_dis,
        'solo_parent_discount' : sp_dis,
        'other_discount' : other_discounts,

        'void' : totalAmountVoid,
        'return' : totalReturnAmount,
        'refund' : totalRefundAmount,

        'senior_citizen_vat' : sc_vat,
        'officers_vat' : officers_vat,
        'pwd_vat' : pwd_person_vat,
        'zero_rated' : 0.00,
        'total_void_vat' : totalVoidVat,
        'vat_refunded' : vat_refunded,
        'vat_return' : vat_return,

        'cash_in_receive' : cash_in_receive,
        'totalCcDb' : totalCcDb,
        'credit' : creditPayment,
        'totalEwallet' : totalEwallet,
        'totalCoupon' : totalCoupon,

        'totalCashIn' : totalCashIn,
        'totalCashOut' : totalCashOut,

        'payment_receive' : payment_receive,
    };


    function printZreadReport () {
        var jsonData = JSON.stringify(returData);
        $.ajax({
            url: './z-reading.php',
            type: 'GET',
            data: { returData: jsonData },
            success: function(data) {
            console.log('printing')
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function updateZreadCount () {
        axios.put('api.php?action=update_z_reading_count')
        .then(function(response) {
        console.log('UPDATED')
        })
        .catch(function(error) {
        console.log(error)
        })
    }

    var dateAndTime = new Date().toISOString();
     
    var requestDataZRead = {
        'cashierId': $('#user_id').val(), 
        'date_and_time': dateAndTime,
        'totalSales': todaySales,
        'z_read_allData' : returData,
    }; 

    axios.get('api.php?action=getAllZreading')
    .then(function(response) {
        function toPostDataZread() {
            axios.post('api.php?action=postZReadReport', requestDataZRead)
            .then(function(response) {
                console.log(response.data.data);
                console.log('success')
            })
            .catch(function(error) {
                console.log(error);
            });
        }
    if(response.data.data == null || response.data.data == []) {
            toPostDataZread();
    } else {
            toPostDataZread()
    }
    })

    printZreadReport ()

    })

    .catch(function(error) {
    console.log(error);
    });
}

$(document).ready(function() {
    function getAllTableBodyValues() {
        var tbodyValues = [];
        $('.billsTable tbody tr').each(function() {
            var rowObject = {};
            $(this).find('td:not(:has(button))').each(function(index) {
                var cellValue = $(this).text().trim().replace(/[^\d.]/g, '');
                if (index === 0) {
                    rowObject['bills'] = cellValue;
                } else if (index === 1) {
                    rowObject['qty'] = cellValue; 
                } else if (index === 2) {
                    rowObject['total'] = cellValue; 
                }
            });
            tbodyValues.push(rowObject);
        });
        return tbodyValues;
    }

    $('.submitCashCount').click(function () {
        var table_length = $('.cont_bill_row').length;
       if (table_length > 0) {
        var count_data = getAllTableBodyValues();
        var arrayList = { data: count_data }; 

        console.log(arrayList)
        // $.ajax({
        //     url: './cash-count.php',
        //     type: 'GET',
        //     data: arrayList,
        //     success: function(data) {
                
        //         // console.log('hello')
        //     },
        //     error: function(xhr, status, error) {
        //         console.error(error);
        //     }
        // });

        // Insert the data
        axios.post('api.php?action=postCashCount', arrayList)
        .then(function(response) {
            // console.log(response.data);
        })
        .catch(function(error) {
            console.error("Error posting cash count:", error);
        });

        $('#denominationModal').hide();
        $('#cashcount_printing').show();

        if($('#cashcount_printing').is(':visible')) {
           
            // toPrintOrRecordZreading();

            // function refrehWindow() {
            //     window.location.reload();
            // }
            // var  intervalReload = setInterval(refrehWindow, 1000);
            // setTimeout(function () {
            //     clearInterval(intervalId);
            // }, 1000);
        }
        
        } else {
            $('#attentionReqModal').show();
            $('.yes_warning_btn').click(function() {
                console.log('continue')
            })

            $('.no_warning_btn').click(function() {
                $('#attentionReqModal').hide();
            })
        }
    })


    function calculateTotal() {
        var sum = 0;
        $('.total').each(function() {
            sum += parseFloat($(this).text());
        });
        $('#cash_drawer').text(sum.toFixed(2));
    }


    var deleteIcon =    `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>`;

    var editIcon =      `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>`;
                        
                        
    var saveIcon =      `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                            <path d="M11 2H9v3h2z"/>
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                        </svg>`;

    var sum = 0;
    function toAddInTableCount() {
        var bill = $('#select_bill option:selected').text();
        var quantity = $('.bill_qty').val();
        var denomination = $('#select_bill').val();
        var total = (parseFloat(quantity) * parseFloat(denomination)).toFixed(2);

        // Check if there's already a row with the same bill
        var existingRow = $('.billsTable tbody').find('tr.cont_bill_row').filter(function() {
            return $(this).find('td:first').text() === bill;
        });

        if (existingRow.length > 0) {
            // If there's an existing row, update its quantity and total
            var existingQuantity = parseFloat(existingRow.find('.pcs').text());
            var newQuantity = existingQuantity + parseFloat(quantity);
            var newTotal = (parseFloat(newQuantity) * parseFloat(denomination)).toFixed(2);
            existingRow.find('.pcs').text(newQuantity);
            existingRow.find('.total').text(newTotal);
        } else {
            // If there's no existing row, add a new row
            var newRow = "<tr class='cont_bill_row'>" +
                "<td>" + bill + "</td>" +
                "<td class='pcs'>" + quantity + "</td>" +
                "<td class='total text-right'>" + total + "</td>" +
                "<td class='text-center'><button class='delete_row'>DELETE</button> <button class='edit_row'>EDIT</button></td>" +
                "</tr>";
            $('.billsTable tbody').append(newRow);
        }

        calculateTotal();
    }


    $('.add_bill').on('click', function(){
        toAddInTableCount()
    });

    
    // Enter Function 

    $('.bill_qty').on('keydown', function (event) {
        if(event.which == 13) {
            toAddInTableCount()
        }
    })


    function saveEditedRow($row) {
        var newQuantity = $row.find('.edit_pcs').val();
        var denomination = $('#select_bill').val();
        var total = (parseFloat(newQuantity) * parseFloat(denomination)).toFixed(2);
        
        $row.find('.pcs').text(newQuantity);
        $row.find('.total').text(total);
        $row.find('.edit_row').text('EDIT').toggleClass('save_row edit_row');
        calculateTotal();
    }      

        // Edit a row
        $('.billsTable').on('click', '.edit_row', function(){
            var $pcsCell = $(this).closest('tr').find('.pcs');
            var currentQuantity = $pcsCell.text().trim();
            $pcsCell.html('<input type="number" class="edit_pcs primary_button_style" value="' + currentQuantity + '">');
            $(this).text('SAVE').toggleClass('edit_row save_row');
            $('.edit_pcs').focus().select();
        });

        // Save edited row
        $('.billsTable').on('click', '.save_row', function(){
            var $row = $(this).closest('tr');
            saveEditedRow($row);
        });

        // Enter Function for editing row
        $('.billsTable').on('keydown', '.edit_pcs', function(event) {
            if (event.which === 13) { 
                var $row = $(this).closest('tr');
                saveEditedRow($row);
                event.preventDefault();
            }
        });

        // Deleting a row
        $('.billsTable').on('click', '.delete_row', function() {
            $(this).closest('tr').remove();
            calculateTotal();
        });
})



</script>


<style>

    .total_cash {
        font-size: medium;
        text-align: right;
        margin-top: 5px;
    }

    .edit_pcs {
        width:55px;
        font-size: medium;
        height: 20px;
    }

    .warning_btn button{
        width: 100px;
        margin-top: 10px;
    
    }

    .d-flex.warning_btn button{
        justify-content: space-evenly;
    }

    .submitCashCount {
        margin-top: 10px;
    }

    .billsTable {
        margin-top: 10px;
        text-align: left;
    }

    .add_bill {
        font-size: small;
        background: #00B050;
        margin-left: 10px;
    }

    .denomination {
        height: 600px;
        border: 1px solid #4B413E;
        border-radius: 0;
        background: transparent;
        padding: 10px
    }

    .requiredAttention {
        height: 200px;
        border: 1px solid #4B413E;
        border-radius: 0;
        background: transparent;
        padding: 10px
    }


    #select_bill {
        border: none;
        margin-right: 10px;
        border-radius: 0;
        background: transparent;
        border: 1px solid #4B413E; 
        color: #fff;
        font-size: small;
        width: auto;
        height: 30px;
        outline: none;
    }

    .bill_qty {
        border: 1px solid #4B413E;
        font-size: small;
    }


    .delete_row {
        border: 0;
        box-shadow: none;
        background: none;
        font-size: small;
        color: #FF6700;
    }

    .edit_row {
        border: 0;
        box-shadow: none;
        background: none;
        font-size: small;
        color: #FF6700;
    }

    .save_row {
        border: 0;
        box-shadow: none;
        background: none;
        font-size: small;
        color: #FF6700;
        text-transform: uppercase;
    }


    .cont_bill_row {
        font-size: medium;
        text-align: left;
    }


</style>