<style>
    #refund_modal .modal-dialog {
        max-width: 50vw;
        min-width: fit-content;

    }

    @media (max-width: 1000px) {
        #refund_modal .modal-dialog {
            max-width: 100vw;
        }
    }

    #refund_modal .modal-content {
        color: #ffff;
        background: #262625;
        border-radius: 0;
        min-height: 60vh;
        position: relative;
    }

    #refund_modal .close-button {
        position: absolute;
        right: 1.6em;
        top: 10px;
        background: #FF6900;
        color: #fff;
        border: none;
        width: 40px;
        height: 40px;
        line-height: 30px;
        text-align: center;
        cursor: pointer;
        margin-top: 1vh;
    }

    #refund_modal .modal-title {
        font-family: Century Gothic;
        font-size: 1.5em;
        margin-top: 1em;
        margin-bottom: 0.5em;
        display: flex;
        align-items: center;
    }

    #refund_modal .warning-container {
        display: flex;
        align-items: center;
    }

    #refund_modal .warning-container svg {
        width: 35px;
        height: 35px;
        margin-right: 0.5em;
        margin-left: 1em;
        margin-top: -0.5em;
    }

    #refund_modal .warningCard {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        background: #262625;
        border: 2px solid #4B413E;
        border-radius: 0;
        margin: -2vh 2em 0 2em;
        padding: 1.5vw;
        position: relative;
        flex-wrap: nowrap;
        min-height: 50vh;
        min-width: fit-content;
    }

    #refund_modal .warningCard div {
        display: flex;
        align-items: center;
       
    }

    #refund_modal .warningCard svg {
        margin-right: 10px;
    }

    #refund_modal .warningCard input,
    #refund_modal .warningCard button {
        margin-right: 10px;
    }

    #receiptNumber::placeholder {
        font-style: italic;
    }

    #refund_modal .button-container {
        display: flex;
        justify-content: start;
        align-items: start;
        margin-top: 20px;
        margin-left: 2em;
        margin-right: 1.9em;
        
    }

    #refund_modal .nav-button {
        position: relative;
        border: 1px solid #DDDDDD;
        /* Set the border color to a light gray shade */
        outline: none;
    }


    #refund_modal .nav-button:focus,
    #refund_modal .nav-button.keyboard-focus {
        border-color: #fd7e14;
        background-color: #1E8449 ;
    }

  

    #refund_modal .tableSales {
        width: 100%;
        margin-top: 20px;
        align-self: flex-start;
        margin-top: -4vh;
    }

    #refund_modal td {
        padding: 10px;
    }

    #totalData {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: absolute;
    right: 2em;
    bottom: 0;
    margin-top: auto;
    font-family: 'Century Gothic';
    font-weight: bold;
   
}
#refund_modal .totalData td {
    font-size: 40px 
}
    #refund_modal table td {
      padding: 2px 4px !important;
      font-size: 14px !important;
}
  .scrollable-container {
     max-height: 400px;
     overflow-y: auto; 
     overflow-x: hidden; 
    -webkit-overflow-scrolling: touch; 
}

.scrollable-container .receiptDatas {
    display: block;
    overflow-y: scroll;
    width: fit-content;
   
}

.continue:focus {
    border: 2px solid #fd7e14;
    outline: none; 
  }
  #receiptNumber{
    outline: 0
  }
 
.focused {
  border: 2px solid #FF6900; 
}
.highlight {
   color:#FF6900;
}


</style>

<!-- ... (your existing HTML structure) -->
<div class="modal" id="refund_modal" tabindex="0" style="background-color: rgba(0, 0, 0, 0.7);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button id="refundClose" name="refundClose" class="close-button" style="font-size:larger">&times;</button>
            <div class="modal-title">
                <div class="warning-container">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 47.5 47.5" viewBox="0 0 47.5 47.5" id="Warning">
                        <defs>
                            <clipPath id="a">
                                <path d="M0 38h38V0H0v38Z" fill="#000000" class="color000000 svgShape"></path>
                            </clipPath>
                        </defs>
                        <g clip-path="url(#a)" transform="matrix(1.25 0 0 -1.25 0 47.5)" fill="#000000" class="color000000 svgShape">
                            <path fill="#b50604" d="M0 0c-1.842 0-2.654 1.338-1.806 2.973l15.609 30.055c.848 1.635 2.238 1.635 3.087 0L32.499 2.973C33.349 1.338 32.536 0 30.693 0H0Z" transform="translate(3.653 2)" class="colorffcc4d svgShape"></path>
                            <path fill="#131212" d="M0 0c0 1.302.961 2.108 2.232 2.108 1.241 0 2.233-.837 2.233-2.108v-11.938c0-1.271-.992-2.108-2.233-2.108-1.271 0-2.232.807-2.232 2.108V0Zm-.187-18.293a2.422 2.422 0 0 0 2.419 2.418 2.422 2.422 0 0 0 2.419-2.418 2.422 2.422 0 0 0-2.419-2.419 2.422 2.422 0 0 0-2.419 2.419" transform="translate(16.769 26.34)" class="color231f20 svgShape"></path>
                        </g>
                    </svg>
                    <p class="warning-title" style="font-family: Century Gothic;"><b>REFUND</b></p>&nbsp;
                    <p  style="font-family: Century Gothic; color: #FF6900"><b>[RETURN AND EXCHANGE]</b></p>
                </div>
            </div>
            <div class="warningCard">
                    <div style="margin-right: 5px; color:#ffff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#ffff" class="bi bi-upc-scan" viewBox="0 0 16 16" style="margin-top: -20px;margin-left: 10px">
                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
                        </svg>
                        <div style="display:grid;">
                            <span class="receiptNumberSpan"></span>
                            <input placeholder="Type or Scan Receipt Barcode" style="width: 650px; border-radius: 0; border-color:#262625"  onkeydown="preventArrowKey(event)" type="number" class="form-control" id="receiptNumber" name="receiptNumber">
                        </div>
                        <div>
                            <button  name="continue" class="continue" style="background-color: #FF6900; margin-top: -1vh; margin-left: 8px; font-family: Century Gothic;" id="continueButton">Continue</button>
                        </div>
                    </div>
                    <table class="refundedCount table table-borderless m-0 text-light adjusted-table-start" id="refundedCount"  style="font-family: Century Gothic;">
                  </table>
                <table class="table table-borderless m-0 text-light adjusted-table-start" id="userData"  style="font-family: Century Gothic;">
                </table>
               <div class="scrollable-container">
               <table class="table table-borderless m-0 text-light" id="receiptData">
              </table>
               </div>

                <table class="totalData table-borderless m-0 text-light" id="totalData" >
                    <tbody>
                        <tr>
                            <td >Refund Amount: <span style="color: #FF6900;" id="totalRefundAmount"> ₱0.00</span></td>
                        </tr>
                    </tbody>
                </table>
                <div>

                </div>
                <div id="dataCard" style="font-style: Century Gothic; color: #566573; text-align: center;font-size: 18px; justify-content:center; margin-top: 150px;margin-bottom: 100px">
                    Enter receipt number or scan barcode to<br>initiate refund process.
                </div>

            </div>

            <div class="button-container" style="margin-bottom: 30px">
                <button autofocus tabindex="0"  data-index="0" style=" border: 2px solid #4B413E; width:150px; height: 50px; font-size: 15px;font-family: Century Gothic;" type="submit" id="cashBtn" name="cashBtn" class="nav-button">
                    Cash
                   
                </button>
                <button data-index="1" onclick="eWalletRefund()" style=" border: 2px solid #4B413E; width:150px; height: 50px;; font-size: 15px; margin-left: 6vh;font-family: Century Gothic;" type="submit" id="ewallet" name="ewallet" class="nav-button">
                    E-Wallet
                   
                </button>
                <button onclick="ccRefund()" data-index="2" style=" border: 2px solid #4B413E; width:150px; height: 50px;; font-size: 15px; margin-left: 6vh;font-family: Century Gothic;" type="submit" id="ccCard" name="ccCard" class="nav-button">
                    Credit/Debit Card
                   
                </button>
                <button onclick="createVoucher()" data-index="3" style=" border: 2px solid #4B413E; width:150px; height: 50px;; font-size: 15px; margin-left: 6vh;font-family: Century Gothic;" type="submit" id="voucher" name="voucher" class="nav-button">
                    Voucher
                   
                </button>
                <button data-index="3" style=" border: 2px solid #4B413E; width:150px; height: 50px;; font-size: 15px; margin-left: 6vh;font-family: Century Gothic;" type="submit" id="returnExchange" name="returnExchange" class="nav-button">
                   Return & Exchange  
                </button>
            </div>
        </div>
    </div>
    <div class="continueButtonContainer">
    </div>
</div>
</div>
</div>

<script>



function eWalletRefund(){ 
    if ($('.transactionCheckbox:checked').length > 0 || $('#selectAllCheckbox').is(':checked')) {
        let isFirstTransaction = true;
        $('#ewallet_modal').show();
        if($('#ewallet_modal').is(":visible")){
            var gcashCard = document.querySelector('.gcash');
             $('#ewallet_modal').focus()
            toggleActiveClass(gcashCard);
            optionsData = 2;
        }
        var totalRef = $('#totalRefundAmount').text().replace(/[^\d.-]/g, '');
        var formattedTotal = new Intl.NumberFormat('en-PH', {
            currency: 'PHP',
            minimumFractionDigits: 2, 
            maximumFractionDigits: 2  
            }).format(totalRef);
    $('#amount').val(formattedTotal)   
    } else {
        nodDataModal();
    }
}
  
    $(document).ready(function() {
        let delayTimer;
        $("#refundClose").on('click', function() {
            $('#refund_modal').hide();
            window.location.reload()
            var input = document.getElementById("receiptNumber");
            input.value = ""
        })
        $('#qtyButton').on('click', function() {
            $('#qty_Modal').hide();

        });
        var userID = $('#user_id').val()
        $('#refundModalButton').click(function() {
            var selectedRow = $('.selectable-row.selected');
            var tableRows = $('.selectable-row');
            if(tableRows.length > 0) {
                modifiedMessageAlert('error', 'You have other transactions. Please save or delete them first.', false, false);
            }else{
                if(userID == 2 || userID == 1){
                var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g,"");
                   if(returnAmountText){
            
                   }else{
                        $('#refund_modal').show();
                        $('#receiptNumber').focus();
                        $('#totalData').hide();
                        $('.refundedCount').hide();
                  }
                }else{
                  permModals();
                }  
            }
       });

       $('#adminCredentials').keydown(function(e) {
        switch(e.which){
         case 13:
            $('button[name="login"]').click();
        break;
        default: return; 
        }
      e.preventDefault(); 
    });

         $('.permissions').on('click',function(){
            axios.get(`api.php?action=credentialsAdmin&credentials=${crdntials}`)
            .then(function(response){
            var crdtls = response.data.credentials
            if(crdtls){
                axios.get(`api.php?action=getPermissionLevel&userID=${userID}`).then(function(response){
                    // var accessLevel = response.data.permission[0].level
                    var accessLevel = response.data.permission[0].permission
                    var accLvl = JSON.parse(accessLevel)
                    if(accLvl[0].Refund == "Access Granted"){
                        $('#granted_modal').show()
                        $('.grantedBtn').focus()
                        if($('#granted_modal').is(":visible")){
                                $('#permModal').hide(); 
                                $('#adminCredentials').val(""); 
                            }
                        $('#grantedClose').on('click', function(){
                            $('#granted_modal').hide()
                            if(!$('#granted_modal').is(':visible')){
                                $('#refund_modal').show();
                                $('#receiptNumber').focus();
                                $('#totalData').hide();
                                $('.refundedCount').hide();
                            }
                        })
                        $('.grantedBtn').on('click', function(){
                            $('#granted_modal').hide()
                            if(!$('#granted_modal').is(':visible')){
                                $('#refund_modal').show();
                                $('#receiptNumber').focus();
                                $('#totalData').hide();
                                $('.refundedCount').hide();
                            }
                        })
                     
                    }else{
                       $('#denied_modal').show()
                       $('.deniedBtn').focus()
                       if(  $('#denied_modal').is(":visible")){
                            $('#permModal').hide(); 
                            $('#adminCredentials').val(""); 
                       }
                       $('#deniedClose').on('click', function(){
                           $('#denied_modal').hide()
                           $('#permModal').show()
                           $('#adminCredentials').focus()
                       })
                       $('.deniedBtn').on('click', function(){
                           $('#denied_modal').hide()
                           $('#permModal').show()
                           $('#adminCredentials').focus()
                       })

                    }
                }).catch(function(error){
                    $('#denied_modal').show()
                       $('.deniedBtn').focus()
                       if(  $('#denied_modal').is(":visible")){
                            $('#permModal').hide(); 
                            $('#adminCredentials').val(""); 
                       }
                       $('#deniedClose').on('click', function(){
                           $('#denied_modal').hide()
                           $('#permModal').show()
                           $('#adminCredentials').focus()
                       })
                       $('.deniedBtn').on('click', function(){
                           $('#denied_modal').hide()
                           $('#permModal').show()
                           $('#adminCredentials').focus()
                       })

                 })
            }else{
                modifiedMessageAlert('error', 'Admin password or id incorrect!' , false, false);
                console.log('hello')
            }
            }).catch(function(error){
            // console.log("1")
            })
            })

     $('#refund_modal').keydown(function(e) {
        switch(e.which){
         case 27:
            $('button[name="refundClose"]').click();
            $('#userData').hide();
            $('#totalData').hide();
            $('#dataCard').show();
            $('.refundedCount').hide();
            input.value = ""
        break;
        default: return; 
        }
      e.preventDefault(); 
    });
    $('#warning_modal').keydown(function(e) {
        switch(e.which){
         case 27:
            $('button[name="warning"]').click();
            $('#receiptNumber').focus();   
        break;
        default: return; 
        }
      e.preventDefault(); 
    });
       
        $(document).on('keyup.refundModal', function(event) {
            if (event.key === 'F8') {
                var selectedRow = $('.selectable-row.selected');
                var tableRows = $('.selectable-row');
               if(tableRows.length > 0) {
                  modifiedMessageAlert('error', 'You have other transactions. Please save or delete them first.', false, false);
               }else{
                var userID = $('#user_id').val()
                if(userID == 2 || userID == 1){
                   var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g,"");
                    if(returnAmountText){
                        processModal() 
                    }else{
                        $('#refund_modal').show();
                        if ($('#refund_modal').is(':visible')){
                        $('.search_input').blur();
                        $('#receiptNumber').focus();
                        $('#receiptData').hide();
                        $('#userData').hide();
                        $('#totalData').hide();
                        $('#dataCard').show();
                        var input = document.getElementById("receiptNumber");
                        input.value = "" 
                        } 
                   }
                }else{
                    var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g,"");
                    if(returnAmountText){
                        processModal() 
                    }else{
                      permModals();
                    }
                }
            }
            }

    $('#receiptNumber').keydown(function(e) {
        switch(e.which){
         case 13:
            $('button[name="continue"]').click();
         break;
        default: return; 
        }
      e.preventDefault(); 
    });

 
    $('#receiptNumber').on('input', function() {
            var input = $("#receiptNumber");
            var barcode = input.val();
            if (barcode.length > 0) {
                $('#totalData').hide();
                $('.receiptNumberSpan').text("");
            } else {
                $('#receiptData').hide();
                $('#userData').hide();
                $('#dataCard').show();
                $('#totalData').hide();
                
            }
    });
            
        });
    });

    const inputField = document.getElementById('receiptNumber');
    document.addEventListener('keydown', preventArrowKey);

    function preventArrowKey(event) {
        if (event.target.id === 'receiptNumber' && (event.key === 'ArrowUp' || event.key === 'ArrowDown')) {
            event.preventDefault();
        }

    }


  $(document).on("click",".continue" , function(){
           var input = document.getElementById("receiptNumber");
           var receiptNumber = $('#receiptNumber').val()
           if(receiptNumber){
                dataTransactions(receiptNumber)                   
                input.value = ""
           }else{
                $('#receiptData').hide();
                $('#userData').hide();
                $('#dataCard').show();
                $('#totalData').hide();
                $('.refundedCount').hide();
                input.value = ""
           }
           
  })

function ccRefund(){
    // $('#cc_modal').show();

    if ($('.transactionCheckbox:checked').length > 0 || $('#selectAllCheckbox').is(':checked')) {
        let isFirstTransaction = true;
        $('#cc_modal').show();
        if( $('#cc_modal').is(':visible')){
        $('.ccnumber').focus()
    }
        var totalRef = $('#totalRefundAmount').text().replace(/[^\d.-]/g, '');
        var formattedTotal = new Intl.NumberFormat('en-PH', {
            currency: 'PHP',
            minimumFractionDigits: 2, 
            maximumFractionDigits: 2  
            }).format(totalRef);
    $('#amounts').val(formattedTotal)   
    } else {
        nodDataModal();
    }

}


function submitCCRefund(){
    var txt = $('.cardname').text().replace(/^"|"$/g, '')

    if(txt !== "INVALID"){
       
       var customerName = $('#customerNames').val();
       var transactionRef = $('#transactionRefs').val();
       var amt =  $('#amounts').val();
     
      
    //    var cardNum = $('.ccnumber').val() + $('.secondnumber').val()+$('.thirdnumber').val()+$('.fourthnumber').val()+ "-" + $('.fifthnumber').val() + $('.sixthnumber').val() +  $('.seventhnumber').val() +  $('.eigthnumber').val() + "-" + $('.ninthnumber').val()
    //    +  $('.tenthnumber').val() +  $('.eleventhnumber').val() + $('.twelfthnumber').val() + "-" + $('.thirteennumber').val() +  $('.fourteennumber').val() + $('.fifteennumber').val() + $('.lastnumber').val();
        var cardNum;
        var empty = false
        if ($('.ccnumber').val() !== '' && $('.secondnumber').val() !== '' && $('.thirdnumber').val() !== '' && $('.fourthnumber').val() !== '' && $('.fifthnumber').val() !== '' && $('.sixthnumber').val() !== '' && $('.seventhnumber').val() !== '' && $('.eigthnumber').val() !== '' && $('.ninthnumber').val() !== '' && $('.tenthnumber').val() !== '' && $('.eleventhnumber').val() !== '' && $('.twelfthnumber').val() !== '' && $('.thirteennumber').val() !== '' && $('.fourteennumber').val() !== '' && $('.fifteennumber').val() !== '' && $('.lastnumber').val() !== '') {
            cardNum = $('.ccnumber').val() + $('.secondnumber').val() + $('.thirdnumber').val() + $('.fourthnumber').val() + "-" + $('.fifthnumber').val() + $('.sixthnumber').val() + $('.seventhnumber').val() + $('.eigthnumber').val() + "-" + $('.ninthnumber').val() + $('.tenthnumber').val() + $('.eleventhnumber').val() + $('.twelfthnumber').val() + "-" + $('.thirteennumber').val() + $('.fourteennumber').val() + $('.fifteennumber').val() + $('.lastnumber').val();

        }else{
          empty = true
        }
 
       if (!customerName) {
            var emptyname = 'Customer name is required';
            $('#customerNameErrors').text(emptyname).css('display', 'flex'); 
            $('#customerNames').css({"border-color":"red","outline":"none"})
       }else {
         $('#customerNameErrors').text(''); 
         }
       if(!amt){
        var amts = 'Amount is required';
        $('#amountErrors').text(amts).css('display', 'flex'); 
       }else{
        $('#amountErrors').text('');
       }
       if(!validation || empty == true ){
        var opts = 'Refund Option is required';
        $('#optionErrors').text(opts).css('display', 'flex'); 
       }else{
        $('#optionErrors').text('')
       }
       if (customerName  && amt && validation) {//customerName  && amt && validation && cardNum &&
        let isFirstTransaction = true;
        $('.transactionCheckbox:checked').each(function(index) {
            var $row = $(this).closest('tr');
            var quantityInput = $row.find('.quantity-input').val();
            var product_id = $row.find('.productid').text();
            var payment_id = $row.find('.paymentid').text();
            var product_price = $row.find('.priceData').text();
          
      var data = [{
            customerName: customerName,
            transactionRef: transactionRef,
            cardNum: cardNum
        }];
        var otherDetails = JSON.stringify(data);
       
          cashButton(quantityInput,product_id,payment_id,product_price,selectedOptions, otherDetails, function() {
            }, isFirstTransaction);
            isFirstTransaction = false; 
            $('#cc_modal').hide(); 
        });
       
      }
    }else{
        modifiedMessageAlert('error', 'Invalid Card!' , false, false);
    }
}



 function submitE(){
         if(optionsData == null || optionsData == ""){
            var opts = 'Refund Option is required';
             $('#optionError').text(opts).css('display', 'flex'); 
             $('#optionError').text('')
         }else{
            var customerName = $('#customerName').val();
            var transactionRef = $('#transactionRef').val();
            var amt =  $('#amount').val();
            // if (!customerName) {
            //         var emptyname = 'Customer name is required';
            //         $('#customerNameError').text(emptyname).css('display', 'flex'); 
            //     }else {
            //     $('#customerNameError').text(''); 
            //     }
                if (!transactionRef) {
                var transacs = 'Reference number is required'
                $('#transactionRefError').text(transacs).css('display', 'flex'); 
                $('#transactionRef').css({"border-color":"red","outline":"none"})
                }else{
                $('#transactionRefError').text('');
                $('#transactionRef').css({"border-color":"","outline":""})
                }
            if(!amt){
                var amts = 'Amount is required';
                $('#amountError').text(amts).css('display', 'flex'); 
            }else{
                $('#amountError').text('');
            }
            if(transactionRef && amt) {
                let isFirstTransaction = true;
            
                $('.transactionCheckbox:checked').each(function(index) {
                    var $row = $(this).closest('tr');
                    var quantityInput = $row.find('.quantity-input').val();
                    var product_id = $row.find('.productid').text();
                    var payment_id = $row.find('.paymentid').text();
                    var product_price = $row.find('.priceData').text();
                
            var data = [{
                    customerName: customerName,
                    transactionRef: transactionRef
                }];
                var otherDetails = JSON.stringify(data);
                cashButton(quantityInput,product_id,payment_id,product_price,optionsData, otherDetails, function() {
                    }, isFirstTransaction);
                    isFirstTransaction = false; 
                    $('#ewallet_modal').hide();  
                });
            
            }
         }

}
    
var isOpen = false;
function createVoucher(){
    isOpen = true
    //couponCreatedModal()  
    if ($('.transactionCheckbox:checked').length > 0 || $('#selectAllCheckbox').is(':checked')) {
        let isFirstTransaction = true;
        $('.transactionCheckbox:checked').each(function(index) {
            var $row = $(this).closest('tr');
            var quantityInput = $row.find('.quantity-input').val();
            var product_id = $row.find('.productid').text();
            var payment_id = $row.find('.paymentid').text();
            var product_price = $row.find('.priceData').text();
            var method = 7;
            var otherDetails = "";
                    cashButton(quantityInput, product_id, payment_id, product_price, method,otherDetails, function() {
            }, isFirstTransaction);
            isFirstTransaction = false; 
          

        });
        var returnAmountText = $('#totalRefundAmount').text().trim().replace(/[^0-9.,]/g, '');
            var r_id = $('.receipt_id').text();
            var selectedValue = "1 DAY";
            createVouchers(returnAmountText,r_id,selectedValue)
    } else {
        nodDataModal();
    }
}
var p_id;
function cashButton(qty, product_id, payment_id, product_price, method,otherDetails,callback,isFirstTransaction) {
    let data = true;
    var user_id = $('#userId').val()
    p_id = payment_id
    $('#modalCashPrint').show();
    if ($('#modalCashPrint').is(':visible')) {
         $('#cashBtn').prop('disabled', true);
         $('.doneRefund').focus();

        axios.post(`api.php?action=updateAndInsert`, {
            qty: qty,
            product_id: product_id,
            payment_id: payment_id,
            product_price: product_price,
            method:method,
            otherDetails: otherDetails,
        })
        .then(function(response) {  
         if(isFirstTransaction){
            data = false
            if(data==false){
            $.ajax({
                url: "./refund-print.php",
                type: "GET",
                data: {
                    payment_id: p_id,
                    first_name:'Admin',
                    last_name: 'Admin',
                    user_id: user_id,
                },
                success: function(data) {
                console.log('hello')
                data = true
                callback();
              
                },
                error: function(xhr, status, error) {
                    console.error(error);
                   
                }
            });
        }
            }
        })
        .catch(function(error) {
            console.log(error);
            callback();
        });
    }
}

$('#cashBtn').on('click', function() {
    if ($('.transactionCheckbox:checked').length > 0 || $('#selectAllCheckbox').is(':checked')) {
        let isFirstTransaction = true;
        $('.transactionCheckbox:checked').each(function(index) {
            var $row = $(this).closest('tr');
            var quantityInput = $row.find('.quantity-input').val();
            var product_id = $row.find('.productid').text();
            var payment_id = $row.find('.paymentid').text();
            var product_price = $row.find('.priceData').text();
            var method = 1;
            var otherDetails = "";
            cashButton(quantityInput, product_id, payment_id, product_price,method,otherDetails,  function() {
            }, isFirstTransaction);
            isFirstTransaction = false; 
        });
    } else {
        nodDataModal();
    }
});


$(document).on('click', '#returnExchange', function() {
        if ($('.transactionCheckbox:checked').length > 0 || $('#selectAllCheckbox').is(':checked')) {
        $('#refund_modal').hide();
        $('.search_input').focus();
        
        $('.transactionCheckbox:checked').each(function(index) {
            var $row = $(this).closest('tr');
            var quantityInput = $row.find('.quantity-input').val();
            var product_id = $row.find('.productid').text();
            var payment_id = $row.find('.paymentid').text();
            var product_price = $row.find('.priceData').text();
            var returnAmountText = $('#totalRefundAmount').text().trim(); 

            $('.returnAmount').html(`
                <div class="card d-flex justify-content-center align-items-center" style="border: none; background-color: #FF6900; border-radius: 0; height: 100%; width: 100%; margin: 0; padding: 0;">
                    <div>
                        <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center;" class="lh-1"><strong>RETURN AMOUNT</strong></small>
                        <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center; font-size: 16px; margin-top: 5px" class="totalReturnAmount lh-1">${returnAmountText}</small>
                        <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center; font-size: 16px; margin-top: 5px" class="totalReturnAmounts lh-1">[ESC]</small>
                    </div>
                </div>
            `);
        });
    } else {
       
        nodDataModal()
    }
});
var fadeInterval;
function dataTransactions(inputValue) {
        var table = $('#receiptData');
        var table1 = $('#userData');
        var dataCard = $('#dataCard');
        var count = $('.refundedCount');
        table.empty();
        table1.empty();
        var rqtyCell;
        var totalPricePerQty
        count.empty();

        $(document).on('change', '.transactionCheckbox', function() {
            var isChecked = $(this).prop('checked');
            var allChecked = $('.transactionCheckbox:checked').length === $('.transactionCheckbox').length;
            $('#selectAllCheckbox').prop('checked', allChecked);
            var row = $(this).closest('tr');
            rqtyCell = row.find('td.col-2:last-child');
            var quantity = row.find('td.col-1').text();
            var index = $('.transactionCheckbox').index(this);
            // var avgPrice = $(this).data('price');
            var avgPrice = row.find('.priceData').text();
            var aP = parseFloat(avgPrice);

            if (isChecked) {   
                if (parseInt(quantity) === 1) {
                    rqtyCell.text(quantity);
                    var inputQty = $('.quantity-input').eq(index);
                    var totalQtyPriceInput = $('.total-qty').eq(index);
                    var totalQtyPriceInput = $('.total-qty').eq(index);
                    inputQty.val(quantity);
                    totalQtyPriceInput.val(aP.toFixed(2));

                    var totalSum = 0

                    $('.total-qty').each(function() {
                        var value = parseFloat($(this).val()) || 0;
                        if ($(this).closest('tr').find('.transactionCheckbox').is(':checked')) {
                            totalSum += value;
                        }
                    });
                    totalSum= isNaN(totalSum) ? 0 : totalSum;
                    var formatTotal = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP'
                    }).format(totalSum);
                    $('#totalRefundAmount').text(formatTotal);
                     setTimeout(()=>{
                        $('#cashBtn').focus()
                     },500)

                } else {
                    qtyModal(quantity, index, avgPrice);
                    
                }
               
            } else {
                var input = $('td.col-2 input.total-qty').eq(index);
                var inputValue = parseFloat(input.val());

                if (isNaN(inputValue)) {
                 inputValue = 0;
                }
              
                var currentTotalRefundAmount = parseFloat($('#totalRefundAmount').text().replace(/[^0-9.-]+/g, ""));
                var newTotalRefundAmount = currentTotalRefundAmount - inputValue;
                newTotalRefundAmount = isNaN(newTotalRefundAmount) ? 0 : newTotalRefundAmount;
                var formatTotal = new Intl.NumberFormat('en-PH', {
                    style: 'currency',
                    currency: 'PHP'
                }).format(newTotalRefundAmount);
                $('#totalRefundAmount').text(formatTotal);
                // console.log(newTotalRefundAmount);
                rqtyCell.text('');
                input.val('');
                $('td.col-2 input.quantity-input').eq(index).val('');
            }
        });

        $('#saveButtonQuantity').click(function() {
            $('#cashBtn').focus()
            var index = $(this).data('index');
            var quantityValue = parseInt($('#quantityData').val(), 10);
            var avgPrice = parseFloat($(this).data('price'));
            var totalPricePerQty = quantityValue * avgPrice;
            $('td.col-2 input.quantity-input').eq(index).val(quantityValue);
            $('td.col-2 input.total-qty').eq(index).val(totalPricePerQty.toFixed(2));
            rqtyCell.text(quantityValue);

            let totalSum = 0;
            $('td.col-2 input.total-qty').each(function() {
                let value = parseFloat($(this).val()) || 0;
                if ($(this).closest('tr').find('.transactionCheckbox').is(':checked')) {
                    totalSum += value;
                }
            });
            var formatTotal = new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
            }).format(totalSum);
            $('#totalRefundAmount').text(formatTotal);
            $('#qty_Modal').hide();
        });
        var transactionData;
        axios.get(`api.php?action=paidTransaction&barcode=${inputValue}`)
            .then(function(response) {
                transactionData = response.data.transac;
                var latestRef = response.data.latest_reference_number;
                var latestCount = response.data.refundCounts 
                var retCount = response.data.returnCount
                if(transactionData) {
                    table.append('<thead><tr style="border: 1px solid #FF6900; color: #FF6900"><th class="col-2">CODE #.</th><th class="col-4">ITEM/DESCRIPTION</th><th class="col-1" style="text-align: left" >QTY.</th><th class="col-2"  style="text-align: left">PRICE</th><th class="col-2" style="text-align: left" >TOTAL</th><th class="col-2" style="display: flex; align-items: center:"><label style="margin-left: -4px;" for="selectAllCheckbox" class="wordAll">All</label><input style="margin-left: 2px" type="checkbox" id="selectAllCheckbox" />&nbsp;</th><th></th><th></th><th class="col-2" style="text-align: center">RQTY.</th></tr></thead>');
                    $('#totalData').show();
                    $('#refundedCount').show()
                    table.show();
                    table1.show();
                    dataCard.hide();
                    var row = $('<tr>');
                    row.append(`
                    <td><span >Sales Invoice No.</span><span style="color: #FF6900;" class="receiptId">&nbsp;${transactionData[0].invoiceNumber}</span></td>
                    <td><span>Invoice Amount:</span><span style="color: #FF6900;" id="invoiceAmountSpan"></span></td>
                    <td><span>Customer:</span><span style="color: #FF6900;">${transactionData[0].firstname}&nbsp${transactionData[0].lastname}</span></td>99486516
                    <td>Refund Count:<span style="color: #FF6900;">${(latestCount[0].refund_count || 0) + (retCount[0].retex || 0)}</span></td>
                    <td hidden><span class="receipt_id">${transactionData[0].receiptId}</span></td>
                    <td hidden class="transactionNum">${transactionData[0].transaction_num}</td>
                `);
                    table1.append(row);
                  
                    var row = $('<tr>');
                    var totalAmountSum = 0;
                    row.append(`
                    <td><span>Latest Refund No.</span><span style="color: #FF6900;">${latestRef ? latestRef : ''}</span></td>
                `);
                    count.append(row);
                    $.each(transactionData, function(index, transaction) {
                        var newRow = $('<tr>');

                        var formattedTotalPrice = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP'
                        }).format(transaction.avg_price);
                        var formattedTotalAmount = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP'
                        }).format(transaction.total_amount);
                        newRow.append(`
                        <td style="text-align: left; margin-left: 5px" class="col-2">${transaction.code.toString().padStart(8, '0')}</td>
                        <td class="col-4" >${transaction.description}</td>

                        <td class="col-1" style="text-align: center">${transaction.net_qty}</td>
                        <td hidden class="priceData col-2" style="text-align: center" >${transaction.avg_price}</td>
                        <td hidden class="col-2" style="text-align: center" >${transaction.total_amount}</td>
                        <td class="priceDatas col-2" style="text-align: left" >${formattedTotalPrice}</td>
                        <td class="priceAmounts col-2" style="text-align: left" >${formattedTotalAmount}</td>
                        <td class="col-2" style="text-align: center; " >
                            <input type="checkbox" class="transactionCheckbox" />
                        </td>
                        <td class="col-2 refundable-quantity" >
                          <input type="hidden"  class="form-control quantity-input" />
                        </td>
                        <td  class="col-2"><input type="hidden" class="total-qty total-price-per-qty" id="totalPricePerQty"/></td>
                        <td class="productid col-2" style="text-align: center;" hidden>${transaction.productId}</td>
                        <td class="paymentid col-2" style="text-align: center; " hidden>${transaction.paymentId}</td>
                        <td class="col-2" style="text-align: center"></td>
                       
                    `);

                    table.append(newRow);
                        totalAmountSum += parseFloat(transaction.total_amount);
                        var formattedAmount = new Intl.NumberFormat('en-PH', {
                            style: 'currency',
                            currency: 'PHP'
                        }).format(totalAmountSum);
                        $('#invoiceAmountSpan').text(formattedAmount);
                    });


                    $('#selectAllCheckbox').on('click', function() {
                        var isChecked = $(this).prop('checked');
                        $('.transactionCheckbox').prop('checked', isChecked);
                        var totalAmount = 0;
                        if (isChecked) {
                            $('#cashBtn').focus()
                            var rows = $('#receiptData tr');
                            $.each(rows, function(index, row) {
                                var $row = $(row);
                                var qtyCellText = $row.find('td.col-1').text();
                                var avgPriceText = $row.find('.priceData').text();
                                var qtyCell = parseFloat(qtyCellText);
                                var avgPrice = parseFloat(avgPriceText);
                                var input = $row.find('.quantity-input');
                                var inputPrice = $row.find('.total-qty');
                                var rqtyCell = $row.find('td.col-2:last-child');

                                if (!isNaN(qtyCell) && !isNaN(avgPrice)) {
                                    var totalPriceAll = qtyCell * avgPrice;
                                    inputPrice.val(totalPriceAll.toFixed(2));
                                    totalAmount += totalPriceAll;
                                } else {
                                    inputPrice.val('0.00');
                                }

                                rqtyCell.text(qtyCellText);
                                input.val(qtyCellText);
                            
                            }); 
                        } else {
                            $('td.col-2:last-child').text('');
                            $('.quantity-input').val('');
                            $('.total-qty').val('');
                        }
                    totalAmount = isNaN(totalAmount) ? 0 : totalAmount;
                    var formattedTotalAmount = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP'
                    }).format(totalAmount);
                     $('#totalRefundAmount').text(formattedTotalAmount);     
            });
    
            function switchHighlightedRow(direction) {
                clearInterval(fadeInterval);
                $('.wordAll').stop(true, true); 
                $('.wordAll').text("All")
                var highlightedRow = $("#receiptData tr.highlight");
                var nextRow;
                if (direction === "up") {
                    $('.wordAll').text("All")
                    nextRow = highlightedRow.prev();
                    if (nextRow.length === 0 || nextRow.index() === 0) {
                        nextRow = highlightedRow;
                    }
                } else if (direction === "down") {
                    $('.wordAll').text("All")
                    nextRow = highlightedRow.next();
                    if (nextRow.length === 0) {
                        nextRow = $("#receiptData tr:nth-child(2)");
                    }
                }

                    highlightedRow.removeClass("highlight");
                    nextRow.addClass("highlight");


                    nextRow.find(".transactionCheckbox").focus();
         }

        $('#refund_modal').keydown(function(e) {
            switch(e.which) {
                case 38:
                    switchHighlightedRow("up");
                    break;
                case 40: 
                    switchHighlightedRow("down");
                    break;
            }
        });

        $('.transactionCheckbox').keydown(function(e){
            switch(e.which){
                case 13: 
                    var highlightedCheckbox = $(".highlight .transactionCheckbox");
                    if (highlightedCheckbox.length > 0) {
                        highlightedCheckbox.click();
                    }
                    break;
            }
        })


                } else {
                    table.hide();
                    count.hide()
                    dataCard.show();
                    console.log("hello")
                    warningModal();
                }
            })
            .catch(function(error) {
                console.log(error);
              
            });
     
    }

function getCouponsData(){
    $.ajax({
        url: 'api.php?action=getCouponAll',
        type: 'GET',
        success: function(response) {
            if(response.data.success){
                var data = response.data.coupon;
                // Send this data to your PHP script
                console.log(data)
             
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching coupon data', error);
        }
    });
}

var $btns = $('#cashBtn, #ewallet, #ccCard,#voucher,#returnExchange');
      $btns.keydown(function(e) {
          var index = $btns.index(this),
              nextIndex = 0;
          switch(e.which) {
              case 37: 
                  nextIndex = (index > 0) ? index - 1 : 0;
                  break;
              case 39: 
                  nextIndex = (index < $btns.length - 1) ? index + 1 : $btns.length - 1;
                  break;
              default: return; 
          }
          
          $btns.eq(nextIndex).focus();
          e.preventDefault(); 
});
var isReceiptNumberFocused = true;

$('#refund_modal').keyup(function(e) {
    switch (e.which) {
        case 9:
            e.preventDefault(); 
            if (isReceiptNumberFocused) {
                $('#selectAllCheckbox').focus(); 
                startFadeAnimation()
            } else {
                $('#receiptNumber').focus(); 
                clearInterval(fadeInterval); 
                $('.wordAll').stop(true, true).fadeIn();
            }
            isReceiptNumberFocused = !isReceiptNumberFocused; 
            break;
            case 13: 
            if ($('#selectAllCheckbox').is(':focus')) {
                $('#selectAllCheckbox').click();
            }
            break;
        default: return;
    }
    e.preventDefault()
});
function startFadeAnimation() {
    fadeInterval = setInterval(function() {
        $('.wordAll').fadeOut(100).fadeIn(100);
    }, 200); 
}


</script>