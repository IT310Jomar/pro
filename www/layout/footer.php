  <!-- JS -->
  <!-- <script type="text/javascript" src="assets/vendor/jquery/jquery.min.js"></script> -->
  <script type="text/javascript" src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
  <!-- <script type="text/javascript" src="assets/vendor/datatables/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="assets/vendor/datatables/jquery.dataTables.min.js"></script> -->


  <script>
    // Initialize Datatable
    $(document).ready(function () {
        $('#searchProductTable').DataTable({
          "bPaginate": false,
          pageLength : 1,
          info : false,
        });
        
    });

    // Render Date
    function renderDate() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();
      today = mm + '/' + dd + '/' + yyyy;
      var myDate = document.getElementById('dateDisplay');
      myDate.textContent = today;

    }

    renderDate();
    // Render Time
    function renderTime() {
      var currentTime = new Date();
      var diem = "AM";
      var h = currentTime.getHours();
      var m = currentTime.getMinutes();
      var s = currentTime.getSeconds();
      if (h == 0) {
        h = 12;
      }
      else if (h == 12) {
        diem = "PM";
      }
      else if (h > 12) {
        h = h - 12;
        diem = "PM";
      }
      if (h < 10) {
        h = "0" + h;
      }
      if (m < 10) {
        m = "0" + m;
      }
      if (s < 10) {
        s = "0" + s;
      }
      // var myClock = document.getElementById('clockDisplay');
      var current_Time = document.getElementById('curTime');
      curTime = document.getElementById('currentTimeEnd');
      curTime2 = document.getElementById('cashCountCurTime');
      // myClock.textContent = h + ":" + m + ":" + s + " " + diem;
      // myClock.innerText = h + ":" + m + ":" + s + " " + diem;
      curTime.textContent = h + ":" + m + ":" + s + " " + diem + "]"
      curTime.innerText = h + ":" + m + ":" + s + " " + diem + "]";

      curTime2.textContent = h + ":" + m + ":" + s + " " + diem + "]"
      curTime2.innerText = h + ":" + m + ":" + s + " " + diem + "]";

      if(current_Time) {
        setTimeout('renderTime()',1000);
        current_Time.textContent = h + ":" + m + ":" + s + " " + diem;
        current_Time.innerText = h + ":" + m + ":" + s + " " + diem;
      } else {
        setTimeout('renderTime()',1000);
      }
    }
   

    // Load data from server
    var i = 0;
    function move() {
      if (i == 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
          if (width >= 100) {
            clearInterval(id);
            i = 0;
          } else {
            width++;
            elem.style.width = width + "%";
          }
          if (width == 100) {
            location.reload();
          }
        }
      }
    }


    // Open modal when button is clicked
    $("#infoModalButton").click(function() {
      $("#opacity").removeClass("d-none");
      $("#helpModal").show(); //F1
    });

    $('#closeBtnMenu').click(function () {
      $('#menuModal').hide();
    })

    $("#searchModalButton").click(function() {
      $("#opacity").removeClass("d-none");
      $("#searchProductModal").show(); //F1
    });

    $("#deleteModalButton").click(function() {
        validation = false
        $("#opacity").removeClass("d-none");
        var selectedRow = $('.selectable-row.selected');
        if (selectedRow.length > 0) {
          $("#voidProductModal").show(); 
          var selectedRowId = selectedRow.data('id');
          var selectedRowAmount = selectedRow.data('disamount');
          var selectedRowQty = selectedRow.data('qty');
          var selectedSubTotal = selectedRow.data('subtotal');
          var selectedRowName = selectedRow.data('name');
          var selectedRowTransacNo = selectedRow.data('transac');
          var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g,"");
        
         
          if(dataQ){
            var newT = dataQ 
            var returnAmount = parseFloat(returnAmountText);
            var totalAmount = parseFloat( newT);
            var sum = returnAmount + totalAmount;
             dataQ = '';
          }else{
            var returnAmount = parseFloat(returnAmountText);
            var totalAmount = parseFloat(selectedSubTotal);
            var sum = returnAmount + totalAmount;
          }
          if ($('#voidProductModal').is(':visible')) {
            $('#triggerF').focus();
            $(document).off('keyup').on("keyup", "#triggerF", function(e) {
                if (e.which === 13) {
                    validation = false
                    deleteItem();
                    selectedRow.remove();
                    
                    $("#opacity").addClass("d-none"); 
                    if(returnAmountText){
                      var formattedTotalAmount = new Intl.NumberFormat('en-PH', {
                      style: 'currency',
                      currency: 'PHP'
                     }).format(sum);
                     if(sum > 0){
                      $('.returnAmount').html(`
                          <div class="card d-flex justify-content-center align-items-center" style="border: none; background-color: #FF6900; border-radius: 0; height: 100%; width: 100%; margin: 0; padding: 0;">
                              <div>
                                  <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center;" class="lh-1"><strong>RETURN AMOUNT</strong></small>
                                  <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center; font-size: 16px; margin-top: 5px" class="totalReturnAmount lh-1">${formattedTotalAmount}</small>
                              </div>
                          </div>
                      `);
                     }
                    } 
                     
                }
            });
          }
          $('#product_name').text(selectedRowName);
          $('#productId').val(selectedRowId);
        } else {
          modifiedMessageAlert('error', 'There is nothing to delete!', false, false);
        }
    });

    $('#closeBtn').click(function(event) {
      $('#payCashModal').hide();
      $(document).off('keydown.voidTransaction');
      $(document).off('keydown.keyPrint', '#paidText')
      $(document).off('keydown.saveTransactions')
      $(document).on('keydown.selectRowTransaction')
      $(document).off('keydown.voidTransaction');
      resetModalContent();
      $('#previewReceiptModal').hide();
    })

    $('#qunatityModalButton').click(function() {
      changeQty();
    }) 

    // $("#paymentModalButton").click(function() {
    //   $("#payCashModal").show(); //F1
    // });

    $("#reprintModalButton").click(function() {
      $("#opacity").removeClass("d-none");
      $("#reprintModal").show(); //F1
    });

    $("#cashOutModalButton").click(function() {
      $("#opacity").removeClass("d-none");
      $("#withdrawModal").show(); //F1
    });
    

    // Enter amount 
    document.addEventListener("keyup", function(e) {
      // If ESC is pressed
      if (e.key == 'Escape') {
        $("#opacity").addClass("d-none");
        $("#helpModal").hide(); //F1
        $("#searchProductModal").hide(); //F2
        $("#voidProductModal").hide(); //F3
        $("#voidTransactionModal").hide(); //F4
        // $("#payCashModal").hide(); //F5
        $("#payLaterModal").hide(); //F6
        $("#withdrawModal").hide(); //F7
        $("#reprintModal").hide(); //F8
        $("#loadDataModal").hide(); //F11
        $("#logoutModal").hide(); //F12
        $("#quantityProductModal").hide();
        $("#enterCustomerNameModal").hide();
        $('#saveTransacConfirmation').hide();
        $('#quantityDefaultProductModal').hide();
        $('#saveModal').hide();
        $('#customerListModal').hide();
        $('#menuModal').hide();
        $('#salesCompleteModal').hide();
        $('#splitPaymentModal').hide();
        $('#salesHistoryModal').hide();

     
        const anyModalsOpen = $('.modal:visible').length == 0;
        if(anyModalsOpen){
          window.location.reload();
          var inputBox = $("#search-input");
          resetModalContent();
          inputBox.focus();
        } 
        $(document).off('keydown.newSales');
        $(document).off('keydown.voidTransaction');
        $(document).off('keydown.keyPrint', '#paidText')
        $(document).off('keydown.saveTransactions')
        $(document).on('keydown.selectRowTransaction')
        $(document).off('keydown.voidTransaction');
        // event.stopPropagation();

        // updateCouponValue(couponId);
        
        
      }

      if(e.key == 'Esc'){
        var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g,"");
        if(returnAmountText){
        window.location.reload()
        }
      }
  
      // If F1 is pressed
      if (e.key == 'F1') {
        $("#opacity").removeClass("d-none");
        $("#helpModal").show(); //F1
        $("#searchProductModal").hide(); //F2
        $("#voidProductModal").hide(); //F3
        $("#voidTransactionModal").hide(); //F4
        $("#payCashModal").hide(); //F5
        $("#payLaterModal").hide(); //F6
        $("#withdrawModal").hide(); //F7
        $("#reprintModal").hide(); //F8
        $("#loadDataModal").hide(); //F11
        $("#logoutModal").hide(); //F12
      }
      // If info modal is open
      if ($('#helpModal').is(':visible')) {
        if (e.key == 'Escape') {
          $("#opacity").addClass("d-none");
          $("#helpModal").hide();
        } else {
          // Do nothing
        }
      }
       // If F2 is pressed
       if (e.key == 'F2') {
        console.log('ghellp')
        var selectedRow = $('.selectable-row.selected');
        if (selectedRow.length > 0) {
          $('#discount_modal').show();
         
          discountItem()
          var inputBoxDis = $("#itemDiscount");
          if (inputBoxDis.length) {
            inputBoxDis.focus().select();
              var selectedRowId = selectedRow.data('id');
              var selectedRowType = selectedRow.data('dtype');
              var selectedRowAmount = selectedRow.data('disamount');
              var selectedRowQty = selectedRow.data('qty');
              var selectedSubTotal = selectedRow.data('subtotal');
              var selectedRowName = selectedRow.data('name');
              var selectedRowTransacNo = selectedRow.data('transac');
              var selectedRowPrice = selectedRow.data('prices');

              var totalSub = selectedRowQty * selectedRowPrice;
              // $('#quantityProductModal').modal('show');
              $('#discount_item_id').val(selectedRowId);
              // $('#quantity').val(selectedRowQty);
              $('#item_name').text(selectedRowName);
              $('#discount_item_sub').val(totalSub);
              $('#transac_num').val(selectedRowTransacNo);
              
              var percentVal = (selectedRowAmount * 100) / (totalSub);

              if (selectedRowType == 0) {
                  $('#itemDiscount').val(percentVal);
                  $('#amountType').text('%');
                  $('#discounVal').val(0);
                  
                  $('#discount_type').text('%').addClass('active');
                  $('#discount_type1').text('₱').removeClass('active');

                  if (!$(event.target).is(inputBoxDis)) {
                    inputBoxDis.focus();
                  }
                  
              } else {
                  $('#itemDiscount').val(selectedRowAmount);
                  $('#amountType').text('₱');
                  $('#discounVal').val(1);
                  $('#discount_type').text('%').removeClass('active');
                  $('#discount_type1').text('₱').addClass('active');

                  if (!$(event.target).is(inputBoxDis)) {
                    inputBoxDis.focus();
                  }
              }

                $('.btn-group .btn').click(function () {
                  $('.btn-group .btn').removeClass('active');
                  $(this).addClass('active');

                  if (!$(event.target).is(inputBoxDis)) {
                    inputBoxDis.focus();
                  }
                });

                $('#discount_type').click(function () {
                    $('#discounVal').val(0);
                    $('#amountType').text('%');
                    $('#itemDiscount').val(percentVal);

                    if (!$(event.target).is(inputBoxDis)) {
                    inputBoxDis.focus();
                  }
                })
                $('#discount_type1').click(function () {
                    $('#discounVal').val(1);
                    $('#amountType').text('₱');
                    $('#itemDiscount').val(selectedRowAmount);

                    if (!$(event.target).is(inputBoxDis)) {
                    inputBoxDis.focus();
                  }
                })

                $('#discount_cart_type').click(function () {
                    $('#discounCartVal').val(0);
                    $('#amountCartType').text('%');

                    if (!$(event.target).is(inputBoxDis)) {
                    inputBoxDis.focus();
                  }
                })
                $('#discount_cart_type1').click(function () {
                    $('#discounCartVal').val(1);
                    $('#amountCartType').text('₱');

                    if (!$(event.target).is(inputBoxDis)) {
                    inputBoxDis.focus();
                  }
                })

          }
        }

        $("#voidProductModal").hide(); //F3
        $("#voidTransactionModal").hide(); //F4
       
        $("#payCashModal").hide(); //F5
        $("#payLaterModal").hide(); //F6
        $("#withdrawModal").hide(); //F7
        $("#reprintModal").hide(); //F8
        $("#loadDataModal").hide(); //F11
        $("#logoutModal").hide(); //F12
      }
      // If info modal is open
      if ($('#discount_modal').is(':visible')) {
        if (e.key == 'Escape') {
         
          $("#discount_modal").hide();
        } else {
          // Do nothing
        }
      }
      // if F7 is pressed
      if (e.key == 'F7') {
       
        $("#helpModal").hide(); //F1
        $("#searchProductModal").hide(); //F2
        $("#voidProductModal").hide(); //F3
        $("#voidTransactionModal").hide(); //F4
        $("#payCashModal").hide(); //F5
        $("#payLaterModal").hide(); //F6
        // $("#withdrawModal").show(); 
        $('#customerListModal').show(); //F7
        
        $("#reprintModal").hide(); //F8
        $("#loadDataModal").hide(); //F11
        $("#logoutModal").hide(); //F12
      }
      // If withdraw modal is open
      // if ($('#customerListModal').is(':visible')) {
      //   $('#CustomersList tbody').empty();
      //   getAllCustomer();
      // }
     
      // F9
      if (e.key == 'F9') {
        voidProducts()
      }
      // Del
      var validation = true;
      if (e.key == 'Delete') {
        validation = false
        $("#opacity").removeClass("d-none");
        var selectedRow = $('.selectable-row.selected');
        if (selectedRow.length > 0) {
          $("#voidProductModal").show(); 
          var selectedRowId = selectedRow.data('id');
          var selectedRowAmount = selectedRow.data('disamount');
          var selectedRowQty = selectedRow.data('qty');
          var selectedSubTotal = selectedRow.data('subtotal');
          var selectedRowName = selectedRow.data('name');
          var selectedRowTransacNo = selectedRow.data('transac');
          var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g,"");
         
          if(dataQ){
            var newT = dataQ 
            var returnAmount = parseFloat(returnAmountText);
            var totalAmount = parseFloat( newT);
            var sum = returnAmount + totalAmount;
             dataQ = '';
          }else{
            var returnAmount = parseFloat(returnAmountText);
            var totalAmount = parseFloat(selectedSubTotal);
            var sum = returnAmount + totalAmount;
          }
          if ($('#voidProductModal').is(':visible')) {
            $('#triggerF').focus();
            $(document).off('keyup').on("keyup", "#triggerF", function(e) {
                if (e.which === 13) {
                    validation = false
                    deleteItem();
                    selectedRow.remove();
                    
                    $("#opacity").addClass("d-none"); 
                    if(returnAmountText){
                      var formattedTotalAmount = new Intl.NumberFormat('en-PH', {
                      style: 'currency',
                      currency: 'PHP'
                     }).format(sum);
                     if(sum > 0){
                      $('.returnAmount').html(`
                          <div class="card d-flex justify-content-center align-items-center" style="border: none; background-color: #FF6900; border-radius: 0; height: 100%; width: 100%; margin: 0; padding: 0;">
                              <div>
                                  <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center;" class="lh-1"><strong>RETURN AMOUNT</strong></small>
                                  <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center; font-size: 16px; margin-top: 5px" class="totalReturnAmount lh-1">${formattedTotalAmount}</small>
                              </div>
                          </div>
                      `);
                     }
                    } 
                     
                }
            });
          }
          $('#product_name').text(selectedRowName);
          $('#productId').val(selectedRowId);
        } else {
          modifiedMessageAlert('error', 'There is nothing to delete!', false, false);
        }
        
      }
    
      
      // if F6 is pressed
      if (e.key == 'F6') {
        $("#opacity").removeClass("d-none");
        $("#helpModal").hide(); //F1
        $("#searchProductModal").hide(); //F2
        $("#voidProductModal").hide(); //F3
        $("#voidTransactionModal").hide(); //F4
        $("#payCashModal").hide(); //F5
        $("#payLaterModal").hide(); //F6
        $("#withdrawModal").hide(); //F7
        $("#reprintModal").show(); //F8
        $("#transactionNumReprint").focus(); //F8
        $("#loadDataModal").hide(); //F11
        $("#logoutModal").hide(); //F12
      }
      // If withdraw modal is open
      if ($('#reprintModal').is(':visible')) {
        if (e.key == 'Escape') {
          $("#opacity").addClass("d-none");
          $("#reprintModal").hide();
        } if (e.key == 'Enter') {
          $("#opacity").addClass("d-none");
          $("#reprintModal").hide();
          $("#reprint").click();
        } else {
          // Do nothing
        }
      }
      // if f11 is pressed
      if (e.key == 'F11') {
        $("#opacity").removeClass("d-none");
        $("#helpModal").hide(); //F1
        $("#searchProductModal").hide(); //F2
        $("#voidProductModal").hide(); //F3
        $("#voidTransactionModal").hide(); //F4
        $("#payCashModal").hide(); //F5
        $("#payLaterModal").hide(); //F6
        $("#withdrawModal").hide(); //F7
        $("#reprintModal").hide(); //F8
        $("#modalLoadData").show(); 
        $("#loadData").click();
        $("#logoutModal").hide(); //F12
      }
      // if F12 is pressed
      if (e.key == 'F12') {
        $("#opacity").removeClass("d-none");
        $("#helpModal").hide(); //F1
        $("#searchProductModal").hide(); //F2
        $("#voidProductModal").hide(); //F3
        $("#voidTransactionModal").hide(); //F4
        $("#payCashModal").hide(); //F5
        $("#amount").focus(); //F5
        $("#payLaterModal").hide(); //F6
        $("#withdrawModal").hide(); //F7
        $("#reprintModal").hide(); //F8
        $("#loadDataModal").hide(); //F11
        $("#logoutModal").show(); //F12
      }
      // If logout modal is open
      if ($('#logoutModal').is(':visible')) {
        if (e.key == 'Escape') {
          $("#opacity").addClass("d-none");
          $("#logoutModal").hide();
        } if (e.key == 'Enter') {
          window.location.href = "index.php";
        } else {
          // Do nothing
        }
      }

      // If the total of the transaction is zero then do nothing
      if (total == '0' || total == '0.00' ) {
        // Do nothing
      } else {
        // If ESC is pressed
        if (e.key == 'Escape') {
          $("#opacity").addClass("d-none");
          $("#helpModal").hide(); //F1
          $("#searchProductModal").hide(); //F2
          $("#voidProductModal").hide(); //F3
          $("#voidTransactionModal").hide(); //F4
          // $("#payCashModal").hide(); //F5
          $("#previewReceiptModal").hide(); //F5
          $("#payLaterModal").hide(); //F6
          $("#withdrawModal").hide(); //F7
          $("#reprintModal").hide(); //F8
          $("#loadDataModal").hide(); //F11
          $("#logoutModal").hide(); //F12

          $("#quantityProductModal").hide();
          $("#enterCustomerNameModal").hide();
          $('#saveTransacConfirmation').hide();
          $('#quantityDefaultProductModal').hide();
          $('#saveModal').hide();
          $('#customerListModal').hide();
          const anyModalsOpen = $('.modal:visible').length == 0;
         if(anyModalsOpen){
          var inputBox = $("#search-input");
          inputBox.focus();
          resetModalContent();
         }
        
        }
        // If F3 is pressed
        if (e.key == 'F3') {
          $("#helpModal").hide(); //F1
          $("#searchProductModal").hide(); //F2
          $("#productId").focus(); //F3
          $("#voidTransactionModal").hide(); //F4
          $("#payCashModal").hide(); //F5
          $("#payLaterModal").hide(); //F6
          $("#withdrawModal").hide(); //F7
          $("#reprintModal").hide(); //F8
          $("#loadDataModal").hide(); //F11
          $("#logoutModal").hide(); //F12
          saveOrders();
        }
        // If F4 is pressed
        if (e.key == 'F4') {
          $("#helpModal").hide(); //F1
          $("#searchProductModal").hide(); //F2
          $("#voidProductModal").hide(); //F3
          var selectedRow = $('.selectable-row.selected');
          changeQty();
          
          
         
          $("#payCashModal").hide(); //F5
          $("#payLaterModal").hide(); //F6
          $("#withdrawModal").hide(); //F7
          $("#reprintModal").hide(); //F8
          $("#loadDataModal").hide(); //F11
          $("#logoutModal").hide(); //F12
        }
        // if F5 is pressed
        if (e.key == 'F5') {
          e.preventDefault();
          $("#opacity").removeClass("d-none");
          $("#helpModal").hide(); //F1
          $("#searchProductModal").hide(); //F2
          $("#voidProductModal").hide(); //F3
          $("#voidTransactionModal").hide(); //F4
          // $("#payCashModal").show(); //F5
          $("#amount").focus(); //F5
          $("#payLaterModal").hide(); //F6
          $("#withdrawModal").hide(); //F7
          $("#reprintModal").hide(); //F8
          $("#loadDataModal").hide(); //F11
          $("#logoutModal").hide();
          $('#totalChange').val('0.00'); //F12
          var returnAmountText = $('.totalReturnAmount').text();
          var totalAmountText = $('#totalPayment').text();
          var formatTotal;
          if (returnAmountText !== null && returnAmountText !== '') {
            
            if(returnAmountText.replace(/[^\d.-]/g, '') > 0 ){
              var tableRows = $('.selectable-row')
            if(tableRows.length == 0) {
              modifiedMessageAlert('error', 'You have to add product first!', false, false);
            }else{
              checkModal();
              if( $('#check_modal').is(':visible')){
                var rt = returnAmountText.replace(/[^\d.-]/g, '')
                var at = totalAmountText.replace(/[^\d.-]/g, '')
                var totalAmt = parseFloat(rt) + parseFloat(at);
                spanTotal = new Intl.NumberFormat('en-PH', {
                              style: 'currency',
                              currency: 'PHP'
                          }).format(at);
                var spanRTA = new Intl.NumberFormat('en-PH', {
                              style: 'currency',
                              currency: 'PHP'
                          }).format( totalAmt);
                $('.spanReturnAmount').text('[' +  spanRTA + ']');
                $('.spanAmount').text('[' +  spanTotal + ']')
                $('.input_paid').prop('readonly', true);
                paymentFuntion();
                $('.yesBtn').on('click',function(){
                  $('#check_modal').hide();
                  var amount =  $('#amount_text').text().replace(/[^\d.-]/g, '');
                  $('.spanAmount').text(formatTotal)
                  formatTotal = new Intl.NumberFormat('en-PH', {
                              style: 'currency',
                              currency: 'PHP'
                          }).format(amount);
                  $('.coupon_text').text(formatTotal);
                  $('#couponValue').val(removeCommas(amount));
                  $('#coupon_val_to_add').val(removeCommas(amount));
                  paymentFuntion();
                  $('.totalPayments').text(0); 
                  totalTopay = $('.totalPayments').text();
                })
              }
            }
          }else{
            paymentFuntion();
            var totalAmount = $('.totalPayments').text().trim();
            var amount =  $('#amount_text').text().replace(/[^\d.-]/g, '');;
            var returnAmountText = $('.totalReturnAmount').text().trim();
            var numericText = returnAmountText.replace(/[^\d.-]/g, ''); 
            var parsedNumber = parseFloat(numericText);
            var coupon = parseFloat(amount) + parseFloat(parsedNumber)
          
            // console.log(coupon,'coupon kini')
            var formatCoupon = new Intl.NumberFormat('en-PH', {
                              style: 'currency',
                              currency: 'PHP'
                          }).format(coupon);
            // $('#totalRefundAmount').text(formatCoupon);
            $('.coupon_text').text(formatCoupon);
          
            var total =  parseFloat(amount)-parseFloat(coupon);
            var totals = new Intl.NumberFormat('en-PH', {
                              currency: 'PHP'
                          }).format(total);
                          $('#totalRefundAmount').text(total);

            $('#coupon_val_to_add').val(coupon);
            paymentFuntion();
            $('.totalPayments').text(totals); 
            }  
          } else {
            paymentFuntion();
          }
        }
        // if F6 is pressed PAY LATER
        // if (e.key == 'F6') {
        //   $("#opacity").removeClass("d-none");
        //   $("#helpModal").hide(); //F1
        //   $("#searchProductModal").hide(); //F2
        //   $("#voidProductModal").hide(); //F3
        //   $("#voidTransactionModal").hide(); //F4
        //   $("#payCashModal").hide(); //F5
        //   $("#payLaterModal").show(); //F6
        //   $("#payer").focus(); //F6
        //   $("#withdrawModal").hide(); //F7
        //   $("#reprintModal").hide(); //F8
        //   $("#loadDataModal").hide(); //F11
        //   $("#logoutModal").hide(); //F12
        // }
      }
      // If amount modal is open
      if ($('#payCashModal').is(':visible')) {
        if (e.key == 'Escape') {
          $("#payCashModal").hide();
        } else {
          // Close app
          if (e.key == 'Escape') {
            // close();
          }
        }
      }
      // If change modal is open
      if ($('#changeModal').is(':visible')) {
        if (e.key == 'Enter') {
          $("#opacity").addClass("d-none");
          $("#changeModal").hide();
          $("#saveTransactionPayCash").click();
        } else {
          // Do nothing
        }
      }
      // If void product modal is open
      if ($('#voidProductModal').is(':visible')) {
        if (e.key == 'Enter') {
          $("#opacity").addClass("d-none");
          $("#voidProductModal").hide();
          $("#voidProduct").click();
        } else {
          // Do nothing
        }
      }
      // If void transaction modal is open
      if ($('#voidTransactionModal').is(':visible')) {
        if (e.key == 'Enter') {
          $("#opacity").addClass("d-none");
          $("#voidTransactionModal").hide();
          $("#voidTransaction").click();
        } else {
          // Do nothing
        }
      }
      // If amount modal is open
      if ($('#payLaterModal').is(':visible')) {
        if (e.key == 'Escape') {
          $("#opacity").addClass("d-none");
          $("#payLaterModal").hide();
        } else {
          // Close app
          if (e.key == 'Escape') {
            // close();
          }
        }
      }

      // if attention failed is open
      if($('#exampleModal2'). is(':visible')) {
        if(e.key == 'Escape') {
          $('#exampleModal2').hide();
          // close();
        }       
      }
      // If pay later modal is open
      if ($('#payLaterInfoModal').is(':visible')) {
        $("#voidTransactionModal").hide();
        $("#payCashModal").hide(); 
        $("#payLaterModal").hide(); 
        if (e.key == 'Enter') {
          $("#opacity").addClass("d-none");
          $("#payLaterModal").hide();
          $("#saveTransactionPayLater").click();
        } else {
          // Do nothing
        }
      }
    });

    // Open change modal if page reload
    $("#changeModal").show();
    $("#payLaterInfoModal").show();

  </script>
