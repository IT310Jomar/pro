<style>
  #couponCreated_modal .modal-dialog {
    max-width: 32vw;
  }

  @media (max-width: 768px) {
    #couponCreated_modal .modal-dialog {
      max-width: 90vw;
    }
  }

  #couponCreated_modal .modal-content {
    color: #ffff;
    background: #262625;
    border-radius: 0;
    min-height: 38vh;
    position: relative;
  }

  #couponCreated_modal .close-button {
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

  #couponCreated_modal .modal-title {
    font-family: Century Gothic;
    font-size: 1.5em;
    margin-top: 1em;
    margin-bottom: 0.5em;
    display: flex;
    align-items: center;
  }

  #couponCreated_modal .warning-container {
    display: flex;
    align-items: center;
  }

  #couponCreated_modal .warning-container svg {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1em;
    margin-top: -0.5em;
  }

  #couponCreated_modal .warningCard {
    max-width: 61.2vh;
    height: 25vh;
    margin-left: 2em;
    border: 2px solid #4B413E;
    border-radius: 0;
    padding: 1.5vw;
    box-sizing: border-box;
    background: #262625;
    margin-right: 2em;
    flex-shrink: 0;
    margin-top: -1em;
  }




  #closeButton {
    font-size: 1.25em;
    width: 150px;
    height: 40px;
    font-family: Century Gothic;
  }
 
.closeButton{
width: 160px;
height: 37px;
font-family: Century Gothic;
font-size: 20px;
margin-top: 10px;
margin-right: 10px;
margin-bottom: 15px;
}
.printVoucher:focus {
  background-color: #1E8449; 
  outline: 0;
}
.printVoucher{
width: 160px;
height: 37px;
font-family: Century Gothic;
font-size: 20px;
margin-top: 10px;
margin-right: 1.7em;
margin-bottom: 15px;
}
.closeButton:focus{
  background-color: #FF6900; 
  outline: 0;
}
.top-div {
    text-align: center; 
    margin-bottom: 20px;
    width: fit-content;
}

.below-div {
    width: fit-content;
}

.resized-image {
    width: 100px; /* Adjust based on your image */
    height: auto; /* Maintains the aspect ratio */
}
.warning-title{
    font-family: Century Gothic;
}
.text-p{
    font-size: small;
}


</style>

<!-- ... (your existing HTML structure) -->
<div class="modal" id="couponCreated_modal"  tabindex="0" style="background-color: rgba(0, 0, 0, 0.7); overflow: hidden; z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button id="createdCouponClose" class="close-button" style="font-size: larger;">&times;</button>
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
          <p class="warning-title"><b>VOUCHER SUCCESSFULLY</b></p>&nbsp;
          <p style="font-family: Century Gothic; color: #FF6900;"><b>[CREATED]</b></p>
        </div>
      </div>
      <div class="warningCard">
    <div style="width:fit-content" class="top-div">
        <p class="warning-title">Voucher has been successfully created. Use before expiration date.&nbsp;<span style="color:#FF6900"><b>Terms & Conditions</b></span><span>&nbsp; may apply.</span></p>
    </div>
    <div style="width:fit-content; display: flex;" class="below-div">
        <div  id="qrCode" class="qrImage"style="flex: 50%; display: flex; align-items: center; justify-content: center; margin-left: 20px">
        </div>
        <div style="flex: 80%; display: flex; flex-direction: column; align-items: left;width:fit-content;justify-content:left; margin-left:20px;">
        <p class="text-p" style="margin-top: 15px; white-space: nowrap;">Voucher Number:&nbsp;<span style="color:#FF6900" class="voucherNum"></span></p>
        <p class="text-p" style="margin-top: -20px; white-space: nowrap;">Valid Until:&nbsp;<span style="color:#FF6900" class="expirationDate"></span>&nbsp;<span style="color:#FF6900" class="expirationTime"></span></p>
        <p class="text-p" style="margin-top: -20px; white-space: nowrap;">Amount:&nbsp;<span style="color:#FF6900" class="voucherAmount"></span></p>
        <p class="text-p" style="margin-top: -20px; white-space: nowrap;">Remarks:&nbsp;<span style="color:#FF6900">Not convertible to cash</span></p> 
        </div>
    </div>
</div>

      <div style="display:flex; align-items: right; justify-content: right">
        <button onclick="closeCreatedModal()" class="closeButton">CLOSE</button>
        <button class="printVoucher">PRINT</button>
      </div>
    </div>
  </div>
</div>

<script>
  function couponCreatedModal() {
    $('#couponCreated_modal').show();
if( $('#couponCreated_modal').is(":visible")){
    $(document).ready(function() {
        $('.printVoucher').focus()
       });
}
  }

  $('#createdCouponClose').on('click', function() {
    $('#couponCreated_modal').hide();
   
  });

function closeCreatedModal(){
   $('#couponCreated_modal').hide();
   $('.search_input').focus()
}
function getVoucherData(r_id){
    axios.get(`api.php?action=getRefundVoucher&r_id=${r_id}`).then(function(response){
      var voucher_num = response.data.voucher[0].qrNumber;
      var exprd_date = response.data.voucher[0].expiry_dateTime;
      var c_amount = response.data.voucher[0].c_amount;
      

    const dateObj = new Date(exprd_date);
    var floatAmount = parseFloat(c_amount.replace(/,/g, ''));
    const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('en-US', dateOptions).format(dateObj);
    const timeOptions = { hour: 'numeric', minute: 'numeric', hour12: true };
    const formattedTime = new Intl.DateTimeFormat('en-US', timeOptions).format(dateObj);

    var formatTotal = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP'
                    }).format(floatAmount);

    var t = new Intl.NumberFormat('en-PH', {
        currency: 'PHP'
    }).format(floatAmount);

    $('.voucherNum').text(voucher_num);
    $('.voucherAmount').text(formatTotal);
    $('.expirationDate').text(formattedDate);
    $('.expirationTime').text(formattedTime);
    var qrCode = new QRCode(document.getElementById("qrCode"), {
    text:"Php" + " "+ String(t), 
    width: 115,
    height: 115,
    colorDark: "#ffffff",
    colorLight: "rgba(255, 255, 255, 0.0)", // Fully transparent white

    correctLevel: QRCode.CorrectLevel.L 
});

    }).catch(function(error){
        console.log(error)
    });
}
function createVouchers(returnAmountText,r_id,selectedData){
    var data = true
    console.log(r_id)
   axios.post('api.php?action=insertAdata',{
    r_id: r_id,
    returnAmountText: returnAmountText,
    selectedData: selectedData
   }).then(function(response){
  
    data = false;
    if(data == false){
    getVoucherData(r_id,data)
    $('.printVoucher').on('click', function(){
     
    $.ajax({
    url: "./coupon-receipt.php",
    type: "GET",
    data: {
        r_id: r_id,
        first_name: 'Admin',
        last_name: 'Admin',
    },
    success: function(data) {
    console.log('success');
    data = true

    },
    error: function(xhr, status, error) {
        console.error(error);
        
    }
});
    $('#couponCreated_modal').hide();
    $('#modalVoucherPrint').show();
    $('#modalVoucherPrint').show()
    $('.doneVoucher').focus()       
})
    
    }
   }).catch(function(error){
    console.log(error)
   })
  }

  
</script>