<?php 


// if (isset($_POST['updateBtn'])) {
//     $updateQty = $_POST["quantity"];
//     $prodID = $_POST["productID"];
//     $updateQtyProd = $transactionFacade->updateQty($prodID, $updateQty);
//   }

?>
<!-- Customer List -->
<div class="modal" id="customerList" tabindex="10">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="list-group" id="listCustomer">

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Customer List End -->





<!-- Delete Modal Pop up -->

<div class="modal" id="modalDeletePopUp" tabindex="1" style="background-color: rgba(0, 0, 0, 0.0)">
  <div class="modal-dialog modal-dialog-centered" style="border: none">
    <div class="modal-content" style="color: #ffff; background: #232323; border-radius: 0 ">
      <div class="modal-body" style="margin-left: 10px; color: #ffff; opacity: 0.9 !important">
        <div class="d-flex justify-content-center">
          <img class="deleteItem" style="height: 100px" src="./assets/img/delete_icon" alt="">
          <h5 class="text-center">You have successfully deleted the item</h5>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Enter amount modal -->
<div class="modal" id="payCashModal" class="paymentCash" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 55vw; ">
    <div class="modal-content" style="color: #ffff; background: #262625; border-radius: 0 ">
      <div class="modal-body" style="margin-left: 10px; color: #ffff; opacity: 0.9 !important">
        <div class="row" style="margin-bottom: 1%; font-family: Century Gothic">
          <div class="col-lg-12 d-flex">
            <div class="" style="margin-right: 10px; margin-top: -10px; color:#ffff">
              <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="#ffff" class="bi bi-upc-scan" viewBox="0 0 16 16">
                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
              </svg>
            </div>
            <div style="position: relative; width: 100%; margin-right: 10px">
              <input id="coupon_discount_code" type="text" placeholder="Scan or type coupon, customer or discount code" class="form-control shadow-none" 
              style="margin-right: 10px; border:none; border-radius: 0; font-style: italic">
              <div id="customer-result" class="form-control shadow-none d-none"></div>
            </div>
            <button class="form-control shadow-none" style="background-color: #FF6700; width: auto; height: auto; color: #ffff; border:none; border-radius: 0">Search</button>
            <button type="button" id="closeBtn" class="payment_btn btn btn-secondary " style="width: auto; margin-left: 10px; margin-top: -10px"><i class="fa fa-close"></i></button>
          </div>
        </div>

        <div class="row ml-10" style="font-family: Century Gothic;">
          <div class="col-lg-2" style="margin-right: 20px;">
            <div class="row paymentMethod_btn">
              <button class="payment_btn btn btn-secondary shadow-none" id="cash" name="cash" style="margin-bottom: 10px">
              <input type="checkbox" class="hidden-checkbox" value="1">CASH</button>
              <button class="payment_btn btn btn-secondary shadow-none e_wallet" style="margin-bottom: 10px"><input type="checkbox" class="hidden-checkbox" value="2">E-WALLET</button>
              <!-- <button class="payment_btn btn btn-secondary shadow-none" style="margin-bottom: 10px"><input type="checkbox" class="hidden-checkbox" value="2">GCASH</button> -->
              <!-- <button class="payment_btn btn btn-secondary shadow-none" style="margin-bottom: 10px"><input type="checkbox" class="hidden-checkbox" value="3">MAYA</button> -->
              <button class="payment_btn btn btn-secondary shadow-none" style="margin-bottom: 10px"><input type="checkbox" class="hidden-checkbox debit_cc" value="4">DEBIT/CREDIT</button>
              <button class="payment_btn btn btn-secondary shadow-none"><input type="checkbox" class="hidden-checkbox" value="5">CREDIT</button> <br>
              <button class="payment_btn btn btn-secondary shadow-none"><input type="checkbox" class="hidden-checkbox" value="6">SPLIT</button> <br>
              <button class="void_btn shadow-none" id="void_btn"><i class="fa fa-exclamation"></i> VOID</button>
            </div>
          </div>

          <div class="col-lg-6" style="margin-right: 20px;">
            <div class="row justify-content-end">
              <div class="d-flex " style="float:right; width: 90%">
                <button class="payment_btn btn btn-secondary form-control shadow-none" id="btnDiscount" disabled style="margin-bottom: 10px; margin-right: 10px;"><i class="fa fa-tag"></i> DISCOUNT</button>
                <button class="form-control shadow-none payment_btn btn btn-secondary" id="customersList" style="margin-bottom: 10px; "> <i class="fa fa-user"></i> CUSTOMER</button>
              </div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
              <label style="margin: 0">Customer: <span id="customerFullname">Unknown Unknown</span></label>
              <label style="margin: 0" for="">Contact No.: None</label>
              <label style="margin: 0" for="">Discount Type: <span id="dstype">Regular</span></label>
            </div>

            <!-- Hidden Value -->
            <input type="number" hidden id="userId">
            <input type="number" hidden id="regular_dis">
            <input type="number" hidden id="vat_sales">
            <input type="number" hidden id="customers_discount_per">
            <input type="number" hidden id="customerDiscount">
            <input type="number" hidden id="barcode_receipt">

            <!-- For Coupons -->
            <input type="number" hidden id="couponValue">
            <input type="number" hidden id="coupon_to_return_val" value="0.00">
            <input type="number" hidden id="coupon_id">
            <input type="number" hidden id="changeVal_input" value="0.00">

            <!-- Credit and Debit -->
            <input type="number" id="account_number_cc_d">

            <!-- For E-Wallet -->
            <input type="number" hidden id="payment_met_val">
            <input type="text" hidden id="ref_number" >
            <input type="text" hidden id="customer_name_payment">
            
            <input type="number" hidden value="1" style="color: #000" class="paymentType_val">
            
            <div class="row">
              <h4 style="margin: 0">AMOUNT <span style="float: right">PHP <span id="amount_text">0.00</span></span></h4>
              <h4 style="margin: 0">DISCOUNT <span style="float: right">PHP <span id="discount_text">0.00</span></span></h4>
              <h4 style="margin: 0">COUPON <span style="float: right">PHP <span id="coupon_text" class="coupon_text">0.00</span></span></h4>
            </div>

            <div class="row">
              <h3 style="color: #FF6700; font-weight: bold; margin: 0">TOTAL <span style="float: right">PHP <span id="totalPayments" class="totalPayments">0.00</span></span></h3>
              <h3>PAID <span style="float: right; margin: 0">
              <input hidden type="number" id="paidText" required min="0" value="0" class="input_paid">
              <input style="padding-right: 10px; margin: 0; display:block; width:auto" type="text" id="fomattedPaidText" required min="0" value="0" class="input_paid">
              </span></h3>
              <h3>CHANGE <span style="float: right; margin: 0" class="phpChange">PHP <span id="totalChange">0.00</span></span></h3>

            </div>

            <div class="row justify-content-end">
              <div class="d-flex " style="float:right; width: 90%">
                <button class="payment_btn btn btn-secondary form-control shadow-none" style="margin-bottom: 10px; margin-right: 10px;"> <i class="fa fa-pencil"></i>ADD NOTES</button>
                <button class="payment_btn btn btn-secondary form-control shadow-none" id="printBtn" style="margin-bottom: 10px;"><i class="fa fa-print"></i> PRINT RECEIPT</button>
              </div>
            </div>
          </div>

          <div class="col-lg-3 p-2 pt-2">
            <div class="row p-lg-2" style="border: 1px solid #4B413E">
              <table class="full-height-table " >
                <tr>
                  <td style="height:50px;"><button class="payment_btn btn btn-secondary shadow-none full-height-btn">1</button></td>
                  <td style="height: 50px;"><button class="payment_btn btn btn-secondary shadow-none full-height-btn">2</button></td>
                  <td><button class="payment_btn btn btn-secondary shadow-none full-height-btn">3</button></td>
                  <td>
                    <button class="payment_btn btn btn-secondary shadow-none full-height-btn">
                      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                      </svg>
                      </svg>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">4</button></td>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">5</button></td>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">6</button></td>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">C</button></td>
                </tr>

                <tr>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">7</button></td>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">8</button></td>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">9</button></td>
                  <td rowspan="2">
                    <button class="payment_btn btn btn-secondary  shadow-none full-height-btn" style="height: 100%; padding: 0">
                      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                      </svg>
                      </svg>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">0</button></td>
                  <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">.</button></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Pay later modal -->


<div class="modal" id="warning_toProceedModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="color: #ffff; background: #262625; border-radius: 0 ">
      <div class="modal-body" style="color: #ffff; opacity: 0.9 !important">

        <div class="d-flex">
          <h4 style="font-weight: bold;">
          <svg style="margin-top: -8px" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg>
          ATTENTION <span style="color: #FF6700" >[REQUIRED]</span></h4>
          <button type="button" id="closeBtnWarningCoupon" class="payment_btn btn btn-secondary " style="width: auto; margin-left: 10px; margin-top: -10px"><i class="fa fa-close"></i></button>
        </div>
       

        <div class="info_warning text-center">
          <h5>The total <span class="totalPurchase" style="color: #ff6700"></span> purchase is lower than coupon amount <span class="couponAmount_to_purchase" style="color: #ff6700"></span></h5>
          <h5>Would you like to conttinue?</h5>
        </div>
        
        <div class="confirmation_container">
          <button  class="cancelBtnWarning btn btn-secondary primary_button_style" style="color: red">CANCEL</button>
          <button id="justContinue" class="btn btn-secondary primary_button_style justContinue">CONTINUE</button>                   
        </div>
      </div> 
      
      
    </div>
  </div>
</div>



<div class="modal" id="toProceedModalCoupon" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="color: #ffff; background: #262625; border-radius: 0 ">
      <div class="modal-body" style="color: #ffff; opacity: 0.9 !important">

        <div class="d-flex">
          <h4 style="font-weight: bold;">
          <svg style="margin-top: -8px" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg>
          ATTENTION <span style="color: #FF6700" >[REQUIRED]</span></h4>
          <button type="button" id="closeBtnCouponPayment" class="payment_btn btn btn-secondary " style="width: auto; margin-left: 10px; margin-top: -10px"><i class="fa fa-close"></i></button>
        </div>
       

        <div class="info_warning text-center">
          <h5>The total <span class="totalPurchase" style="color: #ff6700"></span> purchase is lower than coupon amount <span class="couponAmount_to_purchase" style="color: #ff6700"></span></h5>
          <h5>Would you like to conttinue?</h5>
        </div>
        
        <div class="confirmation_container">
          <button  class="cancelBtnWarningCuopon btn btn-secondary primary_button_style" style="color: red">CANCEL</button>
          <button id="continuePayment" class="btn btn-secondary primary_button_style continuePayment">CONTINUE</button>                   
        </div>
      </div> 
      
      
    </div>
  </div>
</div>


<!-- Enter amount modal -->
<div class="modal" id="splitModal" class="paymentCash" >
  <div class="modal-dialog modal-dialog-centered" style="max-width: 55vw; ">
    <div class="modal-content" style="color: #ffff; background: #262625; border-radius: 0 ">
      <div class="modal-body" style="margin-left: 10px; color: #ffff; opacity: 0.9 !important">
           
        <div class="col-lg-12 d-flex">
          <div style="position: relative; width: 100%; margin-right: 10px">
            <h4>SPLIT PAYMENT</h4>
          </div>
          <button type="button" id="closeBtnSplitPayment" class="payment_btn btn btn-secondary form-control shadow-none" style="width: auto; margin-left: 10px;"  ><i class="fa fa-close"></i></button>
        </div>

        <div class="row p-2 m-1" style="border: 1px solid #4B413E;">
          <div class="col-lg-6 payment-methods">
            <button class="primary_button_style btn btn-secondary shadow-none" id="cash" name="cash">CASH</button>
            <button class="primary_button_style btn btn-secondary shadow-none" id="gcash" name="gcash">GCASH</button>
            <button class="primary_button_style btn btn-secondary shadow-none" id="maya" name="maya">MAYA</button>
            <button class="primary_button_style btn btn-secondary shadow-none" id="debit" name="debit/credit">DEBIT/CREDIT</button>
            <button class="primary_button_style btn btn-secondary shadow-none" id="credit" name="credit">CREDIT</button>
          </div>

          <!-- Hidden value -->
          <input type="number" hidden id="cash_split">
          <input type="number" hidden id="gcash_split">
          <input type="number" hidden id="maya_split">
          <input type="number" hidden id="debit_split">
          <input type="number" hidden id="credit_split">

          <input type="number" hidden id="changeTextVal">

          <input type="text" hidden id="customer_name" >
          <input type="text" hidden id="reference_number">

          <div class="col-lg-6 p-5 payment-values" style="border: 1px solid #4B413E;">
            <h5>CASH: <span style="float: right" id="cashSplit" >0.00</span></h5>
            <h5>GCASH: <span style="float: right" id="gcashSplit" >0.00</span></h5>
            <h5>MAYA: <span style="float: right" id="mayaSplit" >0.00</span></h5>
            <h5>DEBIT/CREDIT: <span style="float: right" id="debitSplit" >0.00</span></h5>
            <h5>CREDIT: <span style="float: right" id="creditSplit" >0.00</span></h5>
          <hr>
            <h4>TOTAL: <span style="float: right" class="totalPaymentSplit" id="totalPaymentSplit">0.00</span></h4>
            <h4>CHANGE: <span style="float: right" id="totalChangeSplit">0.00</span></h4>
          </div>
        </div>

        <div class="d-flex mt-2" style="float: right">
          <button disabled class="payment_btn btn btn-secondary form-control shadow-none" id="submitOk" style="width: auto;" >OK</button>
          <button class="payment_btn btn btn-secondary form-control shadow-none" style="width: auto;" id="cancelBtnSplit">CANCEL</button>
        </div>
      </div>
    </div>
  </div>
</div>


  <!-- Sales Complete -->
  <div class="modal" id="salesCompleteModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 37%;">
      <div class="modal-content">
        <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">

          <div class="col-lg-12 d-flex">
            <div style="position: relative; width: 100%; margin-right: 10px">
              <h4>SALES COMPLETE</h4>
            </div>
            <button type="button" id="closeBtnSalesComplete" class="payment_btn btn btn-secondary form-control shadow-none" style="width: auto; margin-left: 10px;"  ><i class="fa fa-close"></i></button>
          </div>

          <div class="row p-2 m-1" style="height: 550px; border: 1px solid #4B413E;">
          
            <div class="col-lg-12 mb-2" style="border: 1px solid #FF6700; max-height: 10%; height: 100%; text-align: center; padding: 9px;">
              <h3 style="font-weight: bold;" id="printingText">RECEIPT PREVIEW: <span id="text_id_or" style="color: #FF6700;">000000</span></h3>
            </div>

            <div class="col-lg-7 p-1">
              <div class="row icon-print" style="justify-content: center; margin-top: 65px; margin-bottom: 40px;">
                <img style="height: 154px; width: 143px;" src="./assets/img/image-printer.png" alt="printer">
              </div>

              <div class="row p-3">
                <label style="font-weight: bold;">Tendered:<span style="float: right;" id="paidAmount_text">0.00</span></label>
                <label style="font-weight: bold;">Total Sales:<span style="float: right;" id="tenderedSales">0.00</span></label>
                <hr>
                <label style="font-weight: bold; font-size: large; color: #FF6700">Change:<span style="float: right;" id="changeText">0.00</span></label>
              </div>
            </div>

            <div class="col-lg-5 p-1 receipt_preview" style="border: 1px solid #4B413E; 
            max-height: 89%; height: 100%; color: #000;
            padding: 0;">
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
                  <label style="font-weight: bold;">PREVIEW RECEIPT</label>
                </div>    

                <div class="col-12" style="font-size: small; padding-top: 20px; background: #fff;">
                  <label style="font-weight: bold;" id="or_number_text_prev">OR # 00000000</label> 
                  <div style="display:flex">
                      <label class="referenceNumber"></label>&nbsp;
                      <label class="referenceInt"></label>
                  </div>
                  <label>Terminal: DEVICE_NAME </label> 
                  <label>Trans #: <span class="Preview_transacNo">02312312</span></label>
                  <label>Cashier: Admin Admin </label>
                  <label>Date: <span id="CurrentDate">02/02/2024</span></label>
                  <label>Time: <span id="CurrentTime">05:59:29pm</span> </label>
                  <label>Payer: <span id="Payer">Unknown</span></label>
                  <label>Customer Type: <span class="CustomerDisType"> Regular </span></label>
                 

                
                </div>

                <div class="col-12" style="font-size: small; padding-top: 10px; background: #fff;">
                  <div class="row">
                    <label style="font-weight: bold">Item(s) <span style="float: right">Subtotal</span></label>
                    <hr class="new2">
                  
                    <div class="soldProduct">
                        <label class="orderProducts"><span style="float: right" class="subTotal_receipt">0.00</span></label>
                    </div>
                    
                    <hr class="new2">

                    <label>ITEM QTY <span style="float: right" id="TotalQty">0</span></label>
                    <label>AMOUNT <span style="float: right" id="TotalAmount">0.00</span></label>
                    <label>REGULAR DISCOUNT <span style="float: right" id="CustomerDiscount">0.00</span></label>
                    <label>ITEM(s) DISCOUNT <span style="float: right" id="ItemsDiscount">0.00</span></label>
                    <label style="font-weight: bold">TOTAL <span style="float: right;" id="TotalPayment">0.00</span></label>

                    <label style="text-align: center">Tendered: </label>
                    <label style="font-weight: bold" id="paymentMethod_text">CASH<span style="float: right" id="PaidAmount">0.00</span></label> 
                    <label style="font-weight: bold" id="couponAmount">COUPON<span style="float: right" id="couponAmount_val">0.00</span></label> 
                    <label style="font-weight: bold">CHANGE <span style="float: right" id="ChangeAmount">0.00</span></label>  
                    
                    <label>VATable Sales(V) <span style="float: right" id="VatSales">0.00</span></label>
                    <label>VAT Amount <span style="float: right" id="VatAmount">0.00</span></label>
                    <label>VAT Exempt <span style="float: right">0.00</span></label>

                    <hr class="new2">
                    <label>Name: ? _____________________</label>
                    <label>TIN/ID/SC: ? _________________</label>
                    <label>Address: ? _________________________</label>
                    <label>Signature: ? ________________________</label>  
                    <label style="text-align: center; font-weight: bold">PRESS PRINT TO GENERATE BARCODE</label>  
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

              <div class="col-lg-12 blankSpace">
                <div class="row" style="
                background: #262626; color: #000;
                padding: 0;">
                  <label style="font-weight: bold; color: #4B413E">PRESS [ENTER] FOR NEW SALES</label> 
                </div>
              </div>
              
            </div>
          </div>

          <div class="col-lg-12 d-flex" >
              <button class="payment_btn btn btn-secondary form-control shadow-none" style="flex: 1; margin-bottom: 0; width: auto">[ESC] - ESCAPE</button>
              <button type="button" id="closeCustomerBtn" class="payment_btn btn btn-secondary form-control shadow-none printReceipt" style="flex: 1; margin-left: auto; margin-bottom: 0; width: auto">[ENTER] - PRINT RECEIPT</button>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!-- Discount Modal -->
<div class="modal" id="discount_modal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content" style="width: 300px">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        <div class="row">
          <div style="margin-bottom: 15px; text-align: center;">
            <h5>Apply discount to  <br> "<span style="color: #059F1B" id="item_name"></span>"</h5>
            <h6>Discount: </h6>
            <div class="d-flex btnDiscount justify-content-center" style="margin-bottom: 15px; max-width: 15vw; margin: auto;">
              <div class="btn-group" id="btnType" style="margin-bottom: 10px;">
                <button id="discount_type" style="color: #fff" class="form-control shadow-none btn active">%</button>
                <button id="discount_type1" style="color: #fff" class="form-control shadow-none btn">₱</button>
              </div>
            </div>
          </div>

          <form method="POST">
            <input type="number" hidden id="discount_item_id" name="discount_item_id" class="form-control shadow-none" style="text-align: right">
            <input type="number" hidden id="discount_item_sub" name="discount_item_sub" class="form-control shadow-none" style="text-align: right">
            <input type="number" hidden id="transac_num" name="transac_num" class="form-control shadow-none" style="text-align: right">

            <input type="number" hidden id="discounVal" name="discountType" value="0" class="form-control shadow-none" style="text-align: right">
            <div style="position: relative; margin-bottom: 10px;">
                <input type="number" id="itemDiscount" name="itemDiscount" class="form-control shadow-none" style="text-align: right; padding-right: 40px;
                color: #fff; border-radius: 0; background: transparent; ">
                <span id="amountType" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">0%</span>
            </div>
            <button class="d-none" type="submit" id="sbtBtn" name="discount_button"></button>
          </form>
        </div>

        
        <table class="full-height-table" style="margin-top: 10px ">
          <tr>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">1</button></td>
            <td ><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">2</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">3</button></td>
            <td>
              <button class="payment_btn btn btn-secondary  shadow-none full-height-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-x" viewBox="0 0 16 16">
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
                </svg>
              </button>
            </td>
          </tr>
          <tr>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">4</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">5</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">6</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">C</button></td>
          </tr>

          <tr>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">7</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">8</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">9</button></td>
            <td rowspan="2">
              <button class="payment_btn btn btn-secondary  shadow-none full-height-btn" style="height: 100%; padding: 0">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
                </svg>
              </button>
            </td>
          </tr>
          <tr>
            <td colspan="2"><button class="payment_btn btn btn-secondary shadow-none full-height-btn">0</button></td>
            <td><button class="payment_btn btn btn-secondary shadow-none full-height-btn">.</button></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="saveModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.9)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-height: 50%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        <div class="col-lg-12 d-flex saved-orders" >
            <h4>
            <span>
              <svg style="margin-top: -10;" xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
              </svg>
            </span>SAVE ORDERS
          </h4>
          <div class="ml-auto"> 
            <button type="button" id="closeSaveBtn" class="form-control shadow-none" style="width: auto; margin-left: 10px; border: none; background: transparent; color: #ffff;"><i class="fa fa-close"></i></button>
          </div>
        </div>

        <div class="row m-lg-2" style="border: 1px solid #4B413E">
          <div class="container pt-0 pb-3">
            <table class="table table-borderless m-0 text-center" id="savedTransactions">
              <thead style="border: 1px solid #FF6700">
                <tr>
                  <th style="color: #FF6700 ">SN</th>
                  <th style="color: #FF6700 ">Order</th>
                  <th style="color: #FF6700 ">Items</th>
                  <th style="color: #FF6700 ">Total</th>
                </tr>
              </thead>
              <tbody style="color: #fff">

                <!-- In JS -->
              </tbody>
            </table>
          </div>
        </div>

        <div class="row mt-3 d-flex">
          <button style="width: auto; margin-left: 10px; background: red" id="clearAllSaved" class="payment_btn btn btn-secondary shadow-none">
            <svg style="margin-top: -5;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
              <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
            CLEAR ALL
          </button>
          <div class="col-md-10 d-flex justify-content-end">
            <button id="newSales" style="width: auto; margin-right: 10px" class="payment_btn btn btn-secondary shadow-none">
              <span>
                <svg style="margin-top: -5;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                </svg>
              </span>
              NEW SALES
            </button>
            <button style="width: auto; margin-right: 10px" id="voidSavedOrders" class="payment_btn btn btn-secondary shadow-none">
              <svg style="margin-top: -5;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0zM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0" />
              </svg>
              VOID ORDER
            </button>
            <button id="continue_btn" style="width: auto; " class="payment_btn btn btn-secondary shadow-none ml-2">
              <svg style="margin-top: -5;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
              </svg>
              SELECT ORDER</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="customerListModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-height: 50%; height: 100%">
    <div class="modal-content" style="font-size: small">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        <div class="col-lg-12 d-flex">
          <div class="" style="margin-right: 10px; color:#ffff">
            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="#ffff" class="bi bi-upc-scan" viewBox="0 0 16 16">
              <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
            </svg>
          </div>
          <div style="position: relative; width: 100%; margin-right: 10px">
            <input type="text" placeholder="Search customer/ tax no./ email/ phone/ loyalty card" class="form-control shadow-none" style="margin-right: 10px; border:none; border-radius: 0; font-style: italic">
            <div id="customer-result" class="form-control shadow-none d-none"></div>
          </div>
          <button class="form-control shadow-none" style="background-color: #FF6700; width: auto; height: auto; color: #ffff; border:none; border-radius: 0">Search</button>
          <button type="button" id="addCustomer" class="payment_btn btn btn-secondary form-control shadow-none addCustomer" style="width: auto; margin-left: 10px; width: 160px" ><i class="fa fa-plus" style="margin-right: 5px"></i>Customer</button>
          <button type="button" id="closeCustomerBtnMain" class="payment_btn btn btn-secondary form-control shadow-none" style="width: auto; margin-left: 10px;"  ><i class="fa fa-close"></i></button>
        </div>

        <div class="row m-lg-2 customer-container" style="border: 1px solid #4B413E; padding: 10px">
          <table class="table table-borderless m-0 text-center CustomersList" id="CustomersList">
            <thead style="border: 1px solid #FF6700">
              <tr>
                <th style="color: #FF6700 ">ID No.</th>
                <th style="color: #FF6700 ">Name</th>
                <th style="color: #FF6700 ">Customer Type</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>

        <div class="row justify-content-end mt-2 me-1">
          <div class="col-lg-6 d-flex">
            <button style="margin-right: 10px; font-size: small" class="payment_btn btn btn-secondary form-control shadow-none" id="closeBtnCustomerL">CANCEL</button>
            <button style="margin-right: 10px; font-size: small" id="select_customer" class="payment_btn btn btn-secondary form-control shadow-none">SELECT CUSTOMER</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add New Customer -->
<div class="modal" id="addCustomerModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.9)">
  <div class="modal-dialog modal-dialog-centered modal-l" style="max-height: 50%;">
    <div class="modal-content" style="font-size: small">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        
          <div class="row">
             <div class="col-lg-12 d-flex">
                <h3>NEW CUSTOMER</h3>
                <button type="button" onclick="closeModal('#addCustomerModal')" class="payment_btn btn btn-secondary shadow-none closeCustomerBtn" style="width: auto; margin-left: 10px; margin-top: -10px"  ><i class="fa fa-close"></i></button>
             </div>
             <hr>     
          </div>
          <div class="row customer_form">
            <div class="col-6">
              <label for="">First Name</label>
              <input type="text" require class="cf_name" placeholder="Enter your firstname">
            </div>

            <div class="col-6">
              <label for="">Last Name</label>
              <input type="text" require class="cl_name" placeholder="Enter your lastname">
            </div>

            <div class="col-12">
              <label for="">Contact No.</label>
              <input type="text" require class="c_contact" placeholder="Enter you contact no." >
            </div>

            <div class="col-6">
              <label for="">Email Address</label>
              <input type="email" require class="c_email" placeholder="Enter your email address">
            </div>

            <div class="col-6">
              <label for="">CUSTOMER TYPE</label>
              <select name="customer_type_discount" class="shadow-none" id="customer_type_discount">
                <!-- JS -->
              </select>
            </div>

            <div class="col-12 d-flex">
              <label for="">Tax Exempt</label>
              <label class="switch" style="margin-top: 10px; font-size: small; float: right">
                <input type="checkbox" id="taxExempt">
                <span class="slider"></span>
              </label>
            </div>
          </div>

          <hr>

          <div class="d-flex">
            <button onclick="closeModal('#addCustomerModal')" class="primary_button_style shadow-none btn btn-secondary" >CANCEL</button>
            <button class="primary_button_style shadow-none btn btn-secondary submit_addCustomer" >SUBMIT</button>
          </div>

      </div>
    </div>
  </div>
</div>



<!-- Help modal -->
<div class="modal" id="helpModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-custom-dark">
        <h5 class="modal-title text-white">About TinkerPro POS</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <p class="small"><span class="fw-bold">Transak POS</span> <br> Version 1.0 <br> TinkerPro</p>
          </div>
          <div class="col-6">
            <p class="small">www.tinkerpos.com<br> tinkerpro.infotech@gmail.com <br> 09668226024</p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p class="fw-bold small">Help / Information</p>
            <div class="row">
              <div class="col-4">
                <p class="small"><span class="fw-bold">F1</span> - Info <br> <span class="fw-bold">F2</span> - Search <br> <span class="fw-bold">F3</span> - Delete <br> <span class="fw-bold">F4</span> - Void</p>
              </div>
              <div class="col-4">
                <p class="small"><span class="fw-bold">F5</span> - Payment <br> <span class="fw-bold">F6</span> - Reprint <br> <span class="fw-bold">F7</span> - Cashout <br> <span class="fw-bold">F8</span> - Menu</p>
              </div>
              <div class="col-4">
                <p class="small"><span class="fw-bold">F11</span> - Load Data <br> <span class="fw-bold">F12</span> - Logout</p>
              </div>
            </div>
            <p class="small text-center m-0 mt-2">Copyright © 2023 TinkerPro POS. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="menuModal" tabindex="-1" style="width: 375px; margin-left: 76.5%; height: 350px; top: 450px">
  <div class="modal-dialog modal-sm modal-dialog-centered" style="margin:0;">
    <div class="modal-content" style="height: auto; width: 500px; 
    border-radius: 0; background: #262626; border: 1px solid #4B413E">
      <div class="modal-body responsiveContainer" style="color: #fff; padding: 0; width: 370px">

      </div>
    </div>
  </div>
</div>


<!-- Search product modal -->
<div class="modal" id="searchProductModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">

        <div style="position: relative; width: 100%;" class="d-flex">
            <div  style="margin-right: 10px; color:#ffff;">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ffff" class="bi bi-upc-scan" viewBox="0 0 16 16">
                  <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
              </svg>
            </div>
            <input type="text" autocomplete="false" class="w-100 search_input_product" id="search-input-product" autocomplete="false" placeholder="SEARCH CODE / NAME / SERIAL NO.">
            <div id="search_product_result"></div>

            <div class="ml-auto"> 
                <button style="margin-left: 10px; font-size: small" class="btn btn-secondary shadow-none primary_button_style closeBtnSearch"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="show_product_info">
          <!-- JS DISPLAY -->
        </div>

        <div class="d-flex" style="margin-top: 10px">
          <button class="btn btn-secondary primary_button_style search_cancel"><span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
          </svg>
          </span>CANCEL</button>
          <button class="btn btn-secondary primary_button_style addToCart "><span>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg>
          </span>ADD TO CART</button>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Expiration Modal -->
<div class="modal" id="exampleModal2" tabindex="1" style="background-color: rgba(0, 0, 0, 0.9)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
        <div class="row" style="margin-bottom: 1%; font-family: Century Gothic;">
          <div class="col-lg-12 d-flex">
            <div class="" style="margin-right: 10px; ">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
              </svg>
            </div>
            <div style="position: relative; width: 100%; margin-right: 10px;">
              <h4 style="margin-left: 5px; font-weight: bold">ATTENTION REQUIRED <span style="color: red">[<span id="p_name" style="text-transform: uppercase;">PRODUCT NAME</span>]</span> <span style="color: red"> <i>SALES NOT ALLOWED</i> </span></h4>
              <div id="customer-result" class="form-control shadow-none d-none"></div>
            </div>
            <button type="button" id="closeBtnError" class="form-control shadow-none" style="width: auto; margin-left: 10px; border: none; background: transparent; color: #ffff;"><i class="fa fa-close"></i></button>
          </div>
        </div>

        <div class="table-expired ">
          <div class="row">
            <table class="table table-borderless m-0 text-light" id="expiredTable">
              <thead>
                <tr style="border: 1px solid #FF6700; color: #FF6700" class="text-center">
                  <th>CODE</th>
                  <th>ITEM/DESCRIPTION</th>
                  <th>PURCHASE DATE</th>
                  <th>EXPIRY DATE</th>
                  <th>QTY</th>
                  <th>BATCH</th>
                  <th>STOCKS</th>
                  <th>REQUIRED</th>
                </tr>
              </thead>
              <tbody>
                <!-- In JS -->
              </tbody>
            </table>
          </div>

          <div class="row" sytle="margin-top: 20px">
            <div class="col-lg-4" style="float: right">

            </div>
            <div class="col-lg-8" style="float: right; margin-top: 3%">
              <div class="d-flex" style="margin-right: 10px; float: right;">
                <button style="margin-right: 10px; width: auto" class="payment_btn btn btn-secondary form-control shadow-none">AJSUT STOCKS</button>
                <button style="margin-right: 10px; width: auto" class="payment_btn btn btn-secondary form-control shadow-none">ADD TO CART</button>
                <button id="continueBtn" style="margin-right: 10px; width: auto" class="payment_btn btn btn-secondary continue form-control shadow-none">CONTINUE</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Void Transactions Modal -->
<div class="modal" id="voidTransactionModal" tabindex="10" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
        <div class="row" style="margin-bottom: 1%; font-family: Century Gothic;">

          <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <div style="position: relative; width: 100%; margin-right: 10px; text-align: center;">
              <h4 style="margin-left: 5px; font-weight: bold">
              <input type="number" hidden class="transationNumToVoid">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="red" class="bi bi-radioactive" viewBox="0 0 16 16">
                    <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8" />
                    <path d="M9.653 5.496A3 3 0 0 0 8 5c-.61 0-1.179.183-1.653.496L4.694 2.992A5.97 5.97 0 0 1 8 2c1.222 0 2.358.365 3.306.992zm1.342 2.324a3 3 0 0 1-.884 2.312 3 3 0 0 1-.769.552l1.342 2.683c.57-.286 1.09-.66 1.538-1.103a6 6 0 0 0 1.767-4.624zm-5.679 5.548 1.342-2.684A3 3 0 0 1 5.005 7.82l-2.994-.18a6 6 0 0 0 3.306 5.728ZM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0" />
                  </svg>
                </span>Are you sure you want to void this transaction?
              </h4>
              <div id="customer-result" class="form-control shadow-none d-none"></div>
            </div>
            <button type="button" id="closeBtnVoid" class="form-control shadow-none" style="width: auto; margin-left: 10px; border: none; background: transparent; color: #ffff;"><i class="fa fa-close"></i></button>
          </div>

          <div class="row mt-lg-4 justify-content-center">
            <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
              <button class="payment_btn btn btn-secondary form-control shadow-none" id="closeCancelVoid" style="margin-right: 10px">CANCEL</button>
              <button class="payment_btn btn btn-secondary form-control shadow-none" id="void_yes" >YES</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Save Transctions Modal -->
<div class="modal" id="saveTransacConfirmation" tabindex="1" style="background-color: rgba(0, 0, 0, 0.8)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
        <div class="row" style="margin-bottom: 1%; font-family: Century Gothic;">

          <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <div style="position: relative; width: 100%; margin-right: 10px; text-align: center;">
                <h4 style="margin-left: 5px; font-weight: bold;">
                <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#059F1B" class="bi bi-database-check" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514"/>
                  <path d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/>
                </svg>
                </span>Do you want to save this transaction?</h4>
                <div id="customer-result" class="form-control shadow-none d-none"></div>
            </div>
            <button type="button" id="closeBtnSave" class="form-control shadow-none" style="width: auto; margin-left: 10px; border: none; background: transparent; color: #ffff;"><i class="fa fa-close"></i></button>
          </div>

          <div class="row mt-lg-4 justify-content-center">
            <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
              <button class="payment_btn btn btn-secondary primary_button_style shadow-none" id="closeCancelSave" style="margin-right: 10px">CANCEL</button>
              <button class="payment_btn btn btn-secondary primary_button_style shadow-none" id="saved_orders" style="margin-right: 10px">SAVED</button>
              <button class="payment_btn btn btn-secondary primary_button_style shadow-none" id="save_yes" style="margin-right: 10px">YES</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal" id="enterCustomerNameModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 50%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        <div class="row" style="margin-bottom: 1%; font-family: Century Gothic;">

          <div class="row mt-lg-4 justify-content-center">
            <div style="position: relative; width: 100%; text-align: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-raised-hand" viewBox="0 0 16 16">
                <path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207"/>
                <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
              </svg>
            <h1 style="margin-left: 5px;">Enter Customer Name</h1>
                <div class="d-flex" style="margin-left: 20%; margin-right: 20%">
                  <input id="customerN" placeholder="Customer Name" type="text" class="shadow-none">
                  <div class="input-group-append">
                      <span class="input-group-text" style="background: transparent; background: transparent;
                        border: 1px solid #4B413E;
                        border-radius: 0;
                        height: 46px;
                        border-left: 0;
                        margin-top: -10px;
                        
                        ">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                      </span>
                  </div>
                </div>
            </div>
            <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
                <button class="payment_btn btn btn-danger primary_button_style shadow-none" id="cancelBtnSaveCus" style="margin-right: 10px">Cancel</button>
                <button class="payment_btn btn btn-secondary primary_button_style shadow-none" id="save_cus_name" style="margin-right: 10px">Enter</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Your modal content goes here -->
        <p>Modal content goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Quanttiy Modal -->
<div class="modal" id="quantityProductModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content" style="width: 300px">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">

        <div class="d-flex justify-content-end">
          <button type="button" id="closeChangeQty" class="payment_btn btn btn-secondary shadow-none" style="width: auto; margin-left: 10px;"  ><i class="fa fa-close"></i></button>
        </div>

        <form method="POST">
            <h5 class="text-center" style="font-weight: bold">Change quantity <br> Item "<span id="prod_name" style="color: #059F1B"></span>"</h5>
            <input hidden type="text" id="productID" name="productID">
            <div class="d-flex">
              <input type="text" class="form-control shadow-none" id="formattedinputQty" name="formattedinputQty" style="border-radius: 0; background: transparent; color: #fff" >
              <input type="number" class="form-control shadow-none" hidden id="quantity" name="quantity" style="border-radius: 0; background: transparent; color: #fff" >
            </div>
            <!-- <button id="updateBtn" name="updateBtn" type="submit" class="d-none"></button> -->
        </form>

        <table class="full-height-table" style="margin-top: 10px ">
          <tr>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">1</button></td>
            <td ><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">2</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">3</button></td>
            <td>
              <button class="payment_btn btn btn-secondary  shadow-none full-height-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-x" viewBox="0 0 16 16">
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
                </svg>
              </button>
            </td>
          </tr>
          <tr>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">4</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">5</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">6</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">C</button></td>
          </tr>

          <tr>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">7</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">8</button></td>
            <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">9</button></td>
            <td rowspan="2">
              <button class="payment_btn btn btn-secondary  shadow-none full-height-btn" style="height: 100%; padding: 0">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
                </svg>
              </button>
            </td>
          </tr>
          <tr>
            <td colspan="2"><button class="payment_btn btn btn-secondary shadow-none full-height-btn">0</button></td>
            <td><button class="payment_btn btn btn-secondary shadow-none full-height-btn">.</button></td>
          </tr>
        </table>

        <!-- <div class="row mt-lg-4 justify-content-center">
          <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
            <p class="lead text-end mb-0" style="margin-right: 50px">[ENTER] - Save</p>
            <p class="lead text-start mb-0">[ESC] - Cancel</p>
          </div>
        </div>
        -->
      </div>
    </div>
  </div>
</div>

<!-- Default Quantity -->
<div class="modal" id="quantityDefaultProductModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content" style="width: 300px">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        
      <div class="d-flex justify-content-end">
        <button type="button" id="closeDefaultQty" class="payment_btn btn btn-secondary shadow-none" style="width: auto; margin-left: 10px;"  ><i class="fa fa-close"></i></button>
      </div>
    
          <h4 class="text-center" style="font-weight: bold">Set Quantity</h4>
          <div class="d-flex justify-content-center">
            <input hidden type="number" value="1" class="form-control shadow-none" id="defaultquantity" style="border-radius: 0; background: transparent; color: #fff">
            <input type="text"  value="1" class="form-control shadow-none" id="formattedDefaultQty" style="border-radius: 0; background: transparent; color: #fff">
          </div>
            <table class="full-height-table" style="margin-top: 10px ">
              <tr>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">1</button></td>
                <td ><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">2</button></td>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">3</button></td>
                <td>
                  <button class="payment_btn btn btn-secondary  shadow-none full-height-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-x" viewBox="0 0 16 16">
                      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                    </svg>
                  </button>
                </td>
              </tr>
              <tr>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">4</button></td>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">5</button></td>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">6</button></td>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">C</button></td>
              </tr>

              <tr>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">7</button></td>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">8</button></td>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">9</button></td>
                <td rowspan="2">
                  <button class="payment_btn btn btn-secondary  shadow-none full-height-btn" style="height: 100%; padding: 0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                      <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                    </svg>
                    </svg>
                  </button>
                </td>
              </tr>
              <tr>
                <td colspan="2"><button class="payment_btn btn btn-secondary shadow-none full-height-btn">0</button></td>
                <td><button class="payment_btn btn btn-secondary shadow-none full-height-btn">.</button></td>
              </tr>
            </table>

          <button id="updateBtn" name="updateBtn" type="button" class="d-none"></button>

        <!-- <div class="row mt-lg-4 justify-content-center">
          <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
            <p class="lead text-end mb-0" style="margin-right: 100px">[ENTER] - Save</p>
            <p class="lead text-start mb-0">[ESC] - Cancel</p>
          </div>
        </div> -->
       
      </div>
    </div>
  </div>
</div>

<!-- Void product modal -->
<div class="modal" id="voidProductModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.8)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
                  <input type="text" id="triggerF">
        <div class="col-lg-12 d-flex align-items-center justify-content-center">
          <h4 class="text-center" style="font-weight: bold">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
              </svg>
            </span>
            Are you sure you want to delete this <br> Item "<span id="product_name" style="color: red"></span>"
          </h4>
          <input type="number" hidden class="form-control shadow-none" id="productId" name="product_id" required autofocus>
          <button class="d-none" id="delProduct" name="btnSbtDelete"></button>
        </div>


        <div class="row mt-lg-4 justify-content-center">
          <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
            <p class="lead text-start mb-0" style="margin-right: 100px">[ESC] - Cancel</p>
            <p class="lead text-end mb-0" id="yesBtn" >[ENTER] - Yes</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- Modified Message Alert -->
<div class="modal" id="modifiedMessageModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5);z-index:2500">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
        <input type="text" id="triggerF">
        <div class="col-lg-12 d-flex align-items-center justify-content-center">
          <h4 class="text-center" style="font-weight: bold" id="modalTitle"></h4>
          <input type="number" hidden class="form-control shadow-none" id="productId" name="product_id" required autofocus>
          <button class="d-none" id="delProduct" name="btnSbtDelete"></button>
        </div>
        
        <div class="row mt-lg-4 justify-content-center">
          <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
            <p class="lead text-end mb-0" id="yesBtn"></p>
            <p class="lead text-start mb-0"></p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal" id="udQtyModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-custom-dark">
        <h5 class="modal-title text-white">Delete</h5>
      </div>
      <div class="modal-body">

        <div class="row justify-content-center" style="align-items: center;">
          <div class="col-lg-4 pe-0">
            <div class="ps-3 pt-3">
              <form method="GET">
                <input hidden type="text" name="trasactionNo" id="transactionNo">
                <button id="infoModalButton" class="w-100 bg-custom-dark" name="deleteTransac" style="border-radius: 10px;">
              </form>

              <div class="card bg-custom-dark d-flex align-items-center p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#f3f3f3" class="bi bi-info-lg" viewBox="0 0 16 16">
                  <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z" />
                </svg>
                <small class="text-light text-center text-light lh-1">DELETE<br>[F1]</small>
              </div>
              </button>
            </div>
          </div>

          <div class="col-lg-4 pe-0">
            <div class="ps-3 pt-3">
              <button id="infoModalButton" class="w-100 bg-custom-dark" style="border-radius: 10px;">
                <div class="card bg-custom-dark d-flex align-items-center p-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#f3f3f3" class="bi bi-info-lg" viewBox="0 0 16 16">
                    <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z" />
                  </svg>
                  <small class="text-light text-center text-light lh-1">UPDATE QTY.<br>[F1]</small>
                </div>
              </button>
            </div>
          </div>
        </div> <br>

        <div class="modal-footer px-0">
          <div class="row w-100">
            <div class="col-6">
              <p class="lead text-start mb-0">[ESC] - Cancel</p>
            </div>
            <!-- <div class="col-6">
              <p class="lead text-end mb-0">[ENTER] - Void</p>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Withdraw modal -->
<div class="modal" id="withdrawModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-custom-dark">
        <h5 class="modal-title text-white">Cash Out</h5>
      </div>
      <div class="modal-body">
        <form method="post">
          <p class="text-center">Enter the amount that you would like to withdraw</p>
          <input type="number" class="form-control shadow-none" id="withdrawAmount" name="withdraw_amount" required autofocus>
          <input type="hidden" name="withdraw_by" value="<?= $firstName . ' ' . $lastName ?>">
          <button type="submit" class="d-none" id="withdraw" name="withdraw"></button>
        </form>
        <div class="modal-footer px-0">
          <div class="row w-100">
            <div class="col-6">
              <p class="lead text-start mb-0">[ESC] - Cancel</p>
            </div>
            <div class="col-6">
              <p class="lead text-end mb-0">[ENTER] - Withdraw</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Reprint modal -->
<div class="modal" id="reprintModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-custom-dark">
        <h5 class="modal-title text-white">Reprint</h5>
      </div>
      <div class="modal-body">
        <form method="post">
          <p class="text-center">Enter the transaction number that you would like to reprint</p>
          <?php
          $getLatestTransactionNum = $transactionFacade->getLatestTransactionNum();
          foreach ($getLatestTransactionNum as $transactionNum) {
          ?>
            <label for="transactionNumReprint">Transaction Number</label>
            <input type="number" hidden class="form-control shadow-none" id="customer_Id" name="customer_Id" value="<?= $transactionNum['user_id']; ?>" required>
            <input type="number" class="form-control shadow-none" id="transactionNumReprint" name="transaction_num" value="<?= $transactionNum['transaction_num']; ?>" required autofocus>
          <?php
          }
          ?>
          <button type="submit" class="d-none" id="reprint" name="reprint"></button>
        </form>
        <div class="modal-footer px-0">
          <div class="row w-100">
            <div class="col-6">
              <p class="lead text-start mb-0">[ESC] - Cancel</p>
            </div>
            <div class="col-6">
              <p class="lead text-end mb-0">[ENTER] - Reprint</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Load data modal -->
<div class="modal" id="loadDataModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.9)">
  <div  class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
        <div style="position: relative; width: 100%; margin-right: 10px;">
            <h4 class="text-center">Loading data from server...</h4>
        </div>
        <div id="myProgress">
          <div id="myBar"></div>
        </div>
        <button type="submit" class="d-none" id="loadData" onclick="move()"></button>
      </div>
    </div>
  </div>
</div>
<!--Logout modal -->
<div class="modal" id="logoutModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.8)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
        <form method="post">
          <h4 style="margin-left: 5px; font-weight: bold; color: #B50604;" class="text-center">Are you sure you want to logout?</h4>
        </form>

          <div class="row mt-lg-4 justify-content-center">
            <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
                <p class="lead text-end mb-0" style="margin-right: 50px">[ENTER] - Logout</p>
                <p class="lead text-start mb-0">[ESC] - Cancel</p>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>


<!-- Barcode not Found -->
<div class="modal" id="barcodeNotFoundModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.8)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 100%;">
    <div class="modal-content" style="opacity: 0.8 !important">
      <div class="modal-body" style="background: #000; color: #ffff; border-radius: 0;">
        <form method="post">
          <h4 style="margin-left: 5px; font-weight: bold; color: #B50604;" class="text-center">Barcode Not Found!</h4>
        </form>

          <!-- <div class="row mt-lg-4 justify-content-center">
            <div class="col-lg-12 d-flex align-items-center justify-content-center" style="width: 30%">
                <p class="lead text-end mb-0" style="margin-right: 50px">[ENTER] - Logout</p>
                <p class="lead text-start mb-0">[ESC] - Cancel</p>
            </div>
          </div> -->
      </div>
    </div>
  </div>
</div>

<div class="modal" id="splitPaymentModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.4)">
  <div class="modal-dialog modal-dialog-centered "  style="max-width: 38%;">
    <div class="modal-content" style="color: #ffff; background: #262625; border-radius: 0">
      <div class="modal-body" style="color: #ffff; opacity: 0.9 !important">

        <div class="d-flex just">
          <h4 style="font-weight: bold; color: #fff; width: 100%">Enter amount for <span style="color: green" id="paymentMetext"></span>
          <button style="float: inline-end; font-size: small" class="payment_btn primary_button_style btn btn-secondary closeModaSplit"><i class="fa fa-close"></i></button>
        </div>

        <!-- Hidde value -->

        
          <div class="row">
            <div class="col-12">
              <div class="image_ewalltet_container">
                <img src="./assets/img/maya_image.png" class="e_wallet_img" alt="e_wallet_image">
              </div>
            </div>

            <div class="col-12 customer_details">
              <input id="paymentAmount_split" placeholder="Enter the amount" type="number" class="shadow-none" >
              <input type="text" id="ref_number" placeholder="Enter Ref No." class="shadow-none ">
              <input type="text" id="customer_name" placeholder="Enter the customer name" class="shadow-none ">
            </div>
          </div>
          
      </div>
    </div>
  </div>
</div>


<script>

function runPrintPreview() {
  var receiptPreview = document.querySelector('.receipt_preview');
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

  $('#totalChange').text('0.00')
  function animateScroll() {
    scrollContent();
    requestAnimationFrame(animateScroll);
    var receiptPreviewHeight = $('.receipt_preview').height();
    $('.blankSpace').height(receiptPreviewHeight);
  }
  animateScroll();
}


$('#closeBtnSalesComplete').click(function() {
  $('#salesCompleteModal').hide();
  resetModalContent();
  window.location.reload();
  $('.printReceipt').removeClass('selectBtnPaymentMethod');
  $(document).off('keydown.keyPrint');
  $(document).off('keydown.finalPrintReceipt');
  $(document).off('keydown.keyArrows', '#paidText')
})

var cashSplit = 0;
var gcashSplit = 0;
var mayaSplit = 0;
var debitSplit = 0;
var creditSplit = 0;

function splitPayments(remainingPayment) {
  const paymentTypes = ['cash', 'gcash', 'maya', 'debit', 'credit'];
  let totalSplitPaid = 0;
  let selectedPaymentTypes = [];

  $('.modal .payment-methods button').click(function() {
    const paymentType = $(this).text().trim().toUpperCase();
    $('#paymentMetext').text(paymentType);
    $('#splitPaymentModal').show();
    
    $('#paymentAmount_split').off('keydown.splitPayment').on('keydown.splitPayment', function(e) {
      if ($('#splitPaymentModal').is(':visible') && e.which === 13) {
        const paymentAmount = parseFloat($('#paymentAmount_split').val()) || 0;
        $(`#${paymentType.toLowerCase()}Split`).text(paymentAmount.toFixed(2));
        remainingPayment = (remainingPayment - paymentAmount).toFixed(2);

        $('#splitPaymentModal').hide();
        $('#submitOk').prop('disabled', parseFloat(remainingPayment) !== 0.00);
        
        $('#paymentAmount_split').off('keydown.splitPayment');

        // Recalculate totalSplitPaid based on updated values
        totalSplitPaid = 0;
        for (let i = 0; i < paymentTypes.length; i++) {
          const paymentType = paymentTypes[i];
          const amount = parseFloat($(`#${paymentType}Split`).text().replace(/,/g, '')) || 0;
          totalSplitPaid += amount;
          selectedPaymentTypes.push({ paymentType, amount, index: i + 1});
          if (amount !== 0.00) {
            $(`#${paymentType}_split`).val(i + 1);
          }
        }
      }
      $('#changeTextVal').val(remainingPayment);
    });

    $('#paymentAmount_split').val($('#changeTextVal').val());
    
    $('#submitOk').click(function() {
      $('#salesCompleteModal').show();
      var transactionNum = $('#transactionNum').val();
      var customerId = $('#userId').val();
      var regularDis = $('#regular_dis').val();
      var paymentMetVal = $('.paymentType_val').val();

      axios.post('api.php?action=postPayment', {
        'cashPays': parseFloat(totalSplitPaid).toFixed(2),
        'changes': 0,
        'transac': transactionNum,
        'customerId': customerId,
        'regularDis': regularDis,
        'paymentMetVal': 6,
        'otherDetails' : selectedPaymentTypes
      }).then(function(response) {
        console.log('SUCCESS');
      });
    });
  });

  $('.closeModaSplit').click(function() {
    $('#splitPaymentModal').hide();
  })


  $(document).change('#changeTextVal', function() {
    $('#totalPaymentSplit').text($('#changeTextVal').val());
  })
}


function addToTransac(result, barcode, qty, transactionNum) {
  axios.post('api.php?action=addToTransaction', {
      'transactionNum' : transactionNum,
      'qty' : qty,
      'barcode' : barcode
    }).then(function(response) {
        fetchDataAndUpdateTable();
        $('#search-input').val('');
        $('#search-input').val('');
    }).catch(function(error) {
        if (response.data.error) {
          $('#exampleModal2').show();
          $('#p_name').text(result[2]);
          // console.log(result);
          var row = '<tr class="text-center" id="ex_product">' +
            '<td style="color: red">' + result[0] + '</td>' +
            '<td style="color: red">' + result[2] + '</td>' +
            '<td style="color: red">' + result[17] + '</td>' +
            '<td style="color: red">' + result[28] + '</td>' +
            '<td style="color: red">' + 1 + '</td>' +
            '<td style="color: red">' + result[24] + '</td>' +
            '<td style="color: red">' + result[17] + '</td>' +
            '<td style="color: red">' + 1 + '</td>' +
            '</tr>'
          $('#ex_product td').empty();
          $('#expiredTable tbody').append(row);

          $('#continueBtn').click(function() {
            $('#exampleModal2').hide();
          });
          $('#exampleModal2').show();
          $('#search-input').val('')
      }
  })
}


function displayProduct () {

  var items_info = `
  <div class="row">
      <div class="col-6 itemInfo">
        <h4 style="font-weight: bold" class="product_names">Product Name</h4>
        <label>SKU/Code: <span class="sku_val">Value</span></label>
        <label>Barcode: <span class="barcode_val">Value</span></label>
        <label>Serial Number: <span class="serial_no_val" >Value</span></label>
        <label>Stocks in Store: <span class="stocks_in_store" >Value</span></label>
        <label>Stocks in Warehouse : <span class="stocks_in_warehouse" >Value</span></label> <br>
        <label>Price: <span class="product_price_val">Value</span></label>
      </div>

      <div class="col-6 itemImage">
          <img src="./assets/img/maya_image.png" alt="productImage">
      </div>
    </div>
  `;

  $('.show_product_info').html(items_info);

}

function toDisplay (result) {
  displayProduct();
  $(".search_input_product").val(result[2]);
  $('.product_names').text(result[2]);
  $('.sku_val').text(LeftPadWithZeros(result[17], 8));
  $('.barcode_val').text(result[1]);
  $('.serial_no_val').text(12323);
  $('.stocks_in_store').text(500);
  $('.stocks_in_warehouse').text(500);
  $('.product_price_val').text(addCommas(parseFloat(result[5]).toFixed(2)));

  $('.show_product_info').trigger('productInfoUpdated');
}

function getAllDiscounts() {
  axios.get('api.php?action=getAllDiscounts')
  .then(function(response) {
    console.log(response.data.data);
    var discounts = response.data.data;
    var selectElement = $('#customer_type_discount');
    selectElement.empty();
    selectElement.append('<option value="">Select a discount</option>');
    discounts.forEach(function(discount) {
      selectElement.append('<option value="' + discount.id + '">' + discount.name + '</option>');
    });
  })
  .catch(function(error) {
    console.log(error)
  })
}


$(document).ready(function() {
  var resultArray;
  var qty;
  var barcode;
  var firstName;
  var lastName;
  var transactionNum;


  $('.closeBtnSearch, .search_cancel').click(function() {
    $('#searchProductModal').hide();
    $('.show_product_info').html(noProductSelected);
  });

  var noProductSelected = `
    <h5>SEARCH PRODUCT BY NAME OR CODE</h5>
  `;

  $('.show_product_info').html(noProductSelected);

   function showResults_product(results) {
      var resultsContainer = $("#search_product_result");
      resultsContainer.empty();
      if (results.length > 0) {
        $.each(results, function(index, result) { 
          var resultItem = $("<div class='result-item-product' data-resultdata='" + result + "'>" + 
            result[2] + 
            "<span class='product_price' style='float: right'> &#8369;" + 
            parseFloat(result[5]).toFixed(2) + 
            "</span><span hidden class='expiration_date' style='float: right; margin-right: 10px;'>" + 
            result[29] + 
            "</span></div>");

          resultItem.on("click", function() {
           toDisplay(result)
           transactionNum = $("#transactionNum").val();
           qty = $("#qty").val();
           barcode = $(".search_input_product").val();
           firstName = $("#firstName").val();
           lastName = $("#lastName").val();
            
            const expirationDate = new Date(result[29]);
            const today = new Date();
            if(expirationDate > today){
              GetTotalTransaction(result[5])
            }
            else{
              console.log('expiredssss');
            }

            $("#search_product_result").hide();
            resultsContainer.hide();
            $(".search_input_product").val('')
          });

          resultItem.on("mouseover", function() {
            selectedProdIndex = index;
            highlightSelectedResult($('.result-item-product'), 'selected_result');
          });

          resultItem.on("mouseout", function() {
            selectedProdIndex = -1;
            highlightSelectedResult($('.result-item-product'), 'selected_result');
          });
          resultsContainer.append(resultItem);
         
        });

        resultsContainer.show();
      } else {
        resultsContainer.hide();
      }
    }


  var searchData = [];
  axios.get('api.php?action=getAllProducts')
  .then(function(response) {
    searchData = response.data.products.map(function(product) {
      return Object.values(product);
    });
  })
  .catch(function(error) {
    console.error('Error fetching data: ', error);
  });


  $(".search_input_product").off("keydown.selectProductItem")
  $(".search_input_product").on("keydown.selectProductItem", function(e) {
    if ($("#search_product_result").is(":visible")) {
      var toNamespace = 'tosearch'
      if (e.which === 38 && toNamespace === 'tosearch') {
        e.preventDefault();
        selectedProdIndex = Math.max(selectedProdIndex - 1, 0);
        highlightSelectedResult($('.result-item-product'), 'selected_result');
      } 
      else if (e.which === 40 && toNamespace === 'tosearch') { 
        e.preventDefault();
        selectedProdIndex = Math.min(selectedProdIndex + 1, $(".result-item-product").length - 1);
        highlightSelectedResult($('.result-item-product'), 'selected_result');
      } 
      else if (e.which === 13 && toNamespace === 'tosearch') { 
        var resultString = $('.result-item-product').data('resultdata');
        resultArray = resultString.split(',');
        toDisplay (resultArray)

       transactionNum = $("#transactionNum").val();
       qty = $("#qty").val();
       barcode = $(".search_input_product").val();
       firstName = $("#firstName").val();
       lastName = $("#lastName").val();
        
        const expirationDate = new Date(resultArray[29]);
        const today = new Date();
        if(expirationDate > today){
          GetTotalTransaction(resultArray[5])
        }

        else{
          console.log('expiredssss');
        }

        $("#search_product_result").hide();
        $('.search_input_product').val('');
       
      }
    }
  })

  $(".search_input_product").on("input", function(e) {
    var searchTerm = $(this).val().toLowerCase();
    if (searchTerm === '') {
      $("#search_product_result").hide();
      return;
    }

    var filteredResults = searchData.filter(function(result) {
      return result.some(function(value) {
        return String(value).toLowerCase().includes(searchTerm);
      });
    });

    showResults_product(filteredResults)
  });


  $('#formattedinputQty').on('input', function() {
    formatNumber(this, $('#quantity'), $('#formattedinputQty'));
    
    var inputValue = parseFloat($('#quantity').val()); 
    if (isNaN(inputValue)) {
        $('#formattedinputQty').val(1);
        $("#formattedinputQty").focus().select();
    }
  });

  $('#formattedDefaultQty').on('input', function() {
      formatNumber(this, $('#defaultquantity'), $('#formattedDefaultQty'));
      var inputValue = parseFloat($('#defaultquantity').val()); 
      if (isNaN(inputValue)) {
          $('#formattedDefaultQty').val(1);
          $("#formattedDefaultQty").focus().select();
      }
  });

  function formatNumber(input, idInput, formattedInput) {
    let numericValue = $(input).val().replace(/[^0-9.]/g, '');
    let formattedValue = numericValue.replace(/\B(?=(\d{3})+(?!.\d))/g, ',');
    
    idInput.val(numericValue);
    formattedInput.val(formattedValue);
  }

    $('#cancelBtnSplit').on('click', function() {
        $('#splitModal').hide();
    });

    $('.addCustomer').click(function () {
      $('#customerListModal').hide();
      $('#addCustomerModal').show();
      getAllDiscounts()

      var customer_tax_payer = 0
      $('#taxExempt').change(function() {
          if ($(this).prop('checked')) { 
            customer_tax_payer = 1
            // console.log(customer_tax_payer)
          } else {
            customer_tax_payer = 0
            // console.log(customer_tax_payer)
          }
      });

      $('.submit_addCustomer').click(function() {
          var addCustomerInfo = {
            'cf_name': $('.cf_name').val(),
            'cl_name': $('.cl_name').val(),
            'c_contact': $('.c_contact').val(),
            'c_email': $('.c_email').val(),
            'customer_type_discount': $('#customer_type_discount').val(),
            'customer_tax_payer' : customer_tax_payer,
          };

          axios.post('api.php?action=addCustomer', { addCustomerInfo: addCustomerInfo })
          .then(function(response) {
              console.log(response.data.data);
              window.location.reload();
          })
          .catch(function(error) {
            console.log(error, ' ERROR TO ADD');
          });
      });
    })

  
    $('.show_product_info').on('productInfoUpdated', function () {
      console.log('Product info updated!');
    });

    $('.addToCart').click(function() {
      console.log('Hello')
      addToTransac(resultArray, barcode, qty, transactionNum);
      $('.search_cancel').click();
    })

});




</script>

<style>

#customer_type_discount {
  border: none;
  margin-right: 10px;
  border-radius: 0;
  background: transparent;
  border: 1px solid #4B413E; 
  color: #fff;
  font-size: small;
  width: auto;
  margin-top: 0;
  padding: 10px;
  outline: none;
}

#customerN {
  border: 1px solid #4B413E;
  border-radius: 0; 
  background: transparent; 
  color: #fff;
  width: 100%;
  margin-bottom: 10px;
  border-right: 0;
  padding: 10px;
}


.image_ewalltet_container {
  height: auto;
  text-align: center;

}

.image_ewalltet_container img {
  height: 170px;
  width: 300px;
}

img.e_wallet_img {
  height: auto;

}

.customer_details input {
  border: 1px solid #4B413E;
  border-radius: 0;
  background: transparent;
  color: #fff;
  outline: 0;
  width: 100%;
  margin-top: 10px;
}

.saved-orders {
  display: flex;
  justify-content: space-between; 
  align-items: center;
}
.container {
  height: 600px; 
  color: #000;
  padding: 0;
  overflow-y: auto;
  scrollbar-width: 0; 
  scrollbar-color: transparent;
  font-size: small;
}


.container::-webkit-scrollbar {
        width: 0;
    }

.container::-webkit-scrollbar-thumb {
    background-color: transparent;
}


.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    margin-left: 10px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }


  span.slider {
    height: 30px;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .2s;
    transition: .2s;
    border-radius: 34px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 23px;
    width: 23px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .2s;
    transition: .2s;
    border-radius: 50%;
  }

  input:checked + .slider {
    background-color: #ff6700;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #8BC34A;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  .toggle-label {
    font-size: 16px;
    color: white;
    font-family: sans-serif;
    display: inline-block;
    vertical-align: top;
    line-height: 34px;
    margin-right: 10px;
  }

  /* The container for the label and the switch */
  .toggle-container {
    background-color: black;
    padding: 10px;
  }




.customer_form input {
  width: 100%;
  border: 1px solid #4B413E;
  color: #fff;
  padding: 10px;
}

.customer_form label {
  font-size: medium;
  margin-bottom: 5px;
}

.custom-form-control shadow-none {
  display: flex;
  gap: 10px; /* Space between input and button */
  align-items: center;
  padding: 5px;
}

.custom-form-control shadow-none input[type="text"] {
  flex-grow: 1;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.custom-form-control shadow-none button {
  padding: 10px 20px;
  border: none;
  background-color: #007bff;
  color: white;
  border-radius: 5px;
  cursor: pointer;
}

.custom-form-control shadow-none button:hover {
  background-color: #0056b3;
}


.button-clicked {
  background-color: #FF6700; /* Orange background */
  color: #fff; /* White text */
  border: none; /* No border, but you can customize this as needed */
}


  .check-icon {
    /* position: absolute;
    top: 5px;
    left: 5px; */
    color: green; 
  }

  .hidden-checkbox {
    display: none;
  }

  .receipt_preview {
    overflow-y: auto;
    scrollbar-width: 0; 
    scrollbar-color: transparent; 
  }

  .receipt_preview::-webkit-scrollbar {
    width: 0;
  }

  .receipt_preview::-webkit-scrollbar-thumb {
    background-color: transparent;
  }


  .blankSpace {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .blankSpace .row {
    background: #262626;
    color: #000;
    padding: 0;
    text-align: center;
  }

  label {
    display: block;
  }


    
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
          -webkit-appearance: none;
  }
  
  input[type=number] {
    -moz-appearance: textfield;
  }



.menu_list button {
  border-radius: 0;
  text-align: start;
  border: none;
  color: #fff;
  background-color: #262626;
  /* --bs-form-control shadow-none-bg: #FF6700;  */
  display: block;
  font-size: small;
  margin-bottom: 0; 
  box-shadow: 0px 0px 0px rgba(0, 0, 0, 0);


  padding: 5px;
  font-weight: 400;
  outline: none;
  width: 100%;
  display: block;
}

.input_paid:focus {
  animation: blinkBorder 500ms infinite alternate;
}

@keyframes blinkBorder {
  to {
    border-bottom: 1px solid transparent;
  }
}



.settings_button_menu {
  border-radius: 0;
  text-align: start;
  border: none;
  color: #fff;
  background-color: #262626;
  display: block;
  box-shadow: 0px 0px 0px rgba(0, 0, 0, 0);

  padding: 5px;
  font-weight: 400;
  outline: none;
  width: 100%;
  display: block;
}



.pos_shutdown_btn {
  border-radius: 0;
  text-align: start;
  border: none;
  color: #fff;
  background-color: #262626;
  display: block;
  box-shadow: 0px 0px 0px rgba(0, 0, 0, 0);

  padding: 5px;
  font-weight: 400;
  outline: none;
  width: 100%;
  display: block;
}


.menu_list {
    list-style-type: none;
    padding: 0;
}

.menu_list li {
    margin-bottom: 0; 
}


.info_warning {
  border: 1px solid #4B413E;
  border-radius: 0;
  height: 150px;
  padding-top: 10%;
  padding-left: 10px;
  padding-right: 10px;
  margin-top: 10px;
  margin-bottom: 0;
}

.confirmation_container {
  margin-top: 10px;
  display: flex;
  justify-content: space-between;
  font-size: small;
}

</style>
