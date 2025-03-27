








<div class="modal" id="z_readingModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 37%;">
      <div class="modal-content">
        <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">

          <div class="col-lg-12 d-flex">
            <div style="position: relative; width: 100%; margin-right: 10px">
              <h4>SALES COMPLETE</h4>
            </div>
            <button type="button" id="colseBtnZreading" class="payment_btn btn btn-secondary shadow-none" style="width: auto; margin-left: 10px;"  ><i class="fa fa-close"></i></button>
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
                    <input type="number" hidden value="1" style="color: #000" class="paymentType_val">
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



  <script>


    $(document).ready(function() {

        $('#colseBtnZreading').click(function() {
            $('#z_readingModal').hide();
        })

    })


  </script>

  <style>

  </style>