<style>
  #valid_modal .modal-dialog {
    max-width: fit-content;
    min-width: 600px;
  }

  @media (max-width: 768px) {
    #valid_modal .modal-dialog {
      max-width: 90vw;
    }
  }

  #valid_modal .modal-content {
    color: #ffff;
    background: #262625;
    border-radius: 0;
    min-height: 38vh;
    position: relative;
  }

  #valid_modal .close-button {
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

  #valid_modal .modal-title {
    font-family: Century Gothic;
    font-size: 1.5em;
    margin-top: 1em;
    margin-bottom: 0.5em;
    display: flex;
    align-items: center;
  }

  #valid_modal .warning-container {
    display: flex;
    align-items: center;
  }

  #valid_modal .warning-container svg {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1em;
    margin-top: -0.5em;
  }

  #valid_modal .warningCard {
    max-width: 61.2vh;
    /* Adjusted width */
    height: 25vh;
    display: flex;
    margin-left: 20px;
    margin-right: 20px;
    border: 1px solid #4B413E;
    border-radius: 0;
    padding: 10px;
    box-sizing: border-box;
    background: #262625;
    justify-content: center;
    flex-shrink: 0;
    margin-top: -1em;
  }





  #valid_modal .warningText {
    color: #fff;
    margin-right: 2vw;
    font-size: 1.5em;
    font-family: "Century Gothic", sans-serif;
    white-space: nowrap;
    text-align: center;
  }

  #valid_modal .warningText h {
    display: inline;
    margin: 0;
    font-size: 1.5em;
    font-weight: bold;
  }

  #valid_modal .continueButtonContainer {
    margin-top: 1em;
    text-align: right;
    margin-bottom: 0.5em;
    margin-right: 0.95vw;
  }

  #continueButton {
    font-size: 1.25em;
    width: 150px;
    height: 40px;
    font-family: Century Gothic;
  }
 
/* .validContinue{
  width: 160px;
  height: 37px;
  font-family: Century Gothic;
  font-size: 20px;
  margin-top: 10px;
  margin-right: 1.7em;
  margin-bottom: 15px;
  } */

/* .validContinue:focus {
  background-color: #1E8449; 
  outline: 0;
} */

button.coupon_buttons {
  /* padding-left: 30px;
  padding-right: 30px; */
  width: auto;
  font-size: medium;
}

.coupon_buttons button {
  font-size: large;
  padding: 5px;
  width: 100%;
  margin-left: 20px;
  margin-right: 20px;
  margin-top: 10px;
  margin-bottom: 10px;
}

</style>

<!-- ... (your existing HTML structure) -->
<div class="modal" id="valid_modal"  tabindex="0" style="background-color: rgba(0, 0, 0, 0.3); overflow: hidden; z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button id="validClose" class="close-button" style="font-size: larger;">&times;</button>
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
          <p class="warning-title"><b>VALID UNTIL</b></p>&nbsp;
          <p style="font-family: Century Gothic; color: #FF6900;"class="validity"><b></b></p>
        </div>
      </div>
      <div class="warningCard">
            <div style=" display: flex;align-items: center; width: 50%; justify-content: center;">
            <img class="resized-image" src="./assets/img/Picture2.png">
            </div>
          <!-- Hidden value -->
            <input type="number" hidden id="coupon_val_input">
            <input type="number" hidden id="coupon_id_val">

            <div style="display: flex; align-items: center; width: 80%; justify-content: left; flex-direction: column; margin-top: 50px;">
              <p style="color: #566573;"><b style="font-size: xx-large">AMOUNT:&nbsp;&nbsp;<span class="couponAmount" style="color: #1E8449;"></span></b></p>
              <span style="font-family: Century Gothic; font-size: 2vw; color: #1E8449; margin-top: -1.25vw"><b>[VALID]</b></span>
            </div>
      </div>

      <div class="d-flex coupon_buttons">
        <button onclick="closeModal()">CANCEL</button>
        <button class="use_coupon_btn">USE COUPON</button>
      </div>
     
    </div>
  </div>
</div>

<script>
  function validModal(c_amount,exprd_date) {
    
    $(document).ready(function() {
       var coupon_amount = $('#coupon_val_input').val();
       var coupon_ids = $('#coupon_id_val').val();
       var coupon_change = 0;
       var subTotalTobePaid = $('#totalPayment').text();
      //  console.log(coupon_amount)
      $('.use_coupon_btn').click(function() {

        if($('.selectable-row').length == 0) {
          modifiedMessageAlert('error', 'You have to add product first!', false, false);
        } else {
          function setTheCouponVal() {
           // In payment function modal
           if($('#payCashModal').is(':visible')) {
            $('#coupon_to_return_val').val(parseFloat(coupon_change).toFixed(2))
            $('#couponValue').val(parseFloat(coupon_amount).toFixed(2))
            $('#coupon_text').text(addCommas(parseFloat(coupon_amount).toFixed(2)))
            
            $('#valid_modal').hide();
            $('#coupon_id').val(coupon_ids);
            // $('.search_input').focus()
            
          } else {
            
            // In home search function
            $('#coupon_val_to_return').val((coupon_change))
            $('#coupon_val_to_add').val((coupon_amount));
            $('#coupon_use_text').text(coupon_amount);
            $('#coupon_id').val(coupon_ids);
            $('small').removeClass('text-light');

            $('#valid_modal').hide();
            $('.search_input').focus()
          } 
        }

          // Validate if the coupon is greater than to total Sales
          if(parseFloat(coupon_amount).toFixed(2) < parseFloat(subTotalTobePaid).toFixed(2)) {
            coupon_change = removeCommas(coupon_amount) - removeCommas(subTotalTobePaid);
            coupon_amount = removeCommas(subTotalTobePaid);
            
            $('.totalPurchase').text('[ ' + addCommas(subTotalTobePaid) + ' ]');
            $('.couponAmount_to_purchase').text('[ ' + addCommas(parseFloat(coupon_change).toFixed(2)) + ' ]')
            $('#valid_modal').hide();
            $('#warning_toProceedModal').show()

            $('.justContinue').click(function() {
              setTheCouponVal();
              $('#warning_toProceedModal').hide()
            })

            $('#closeBtnWarningCoupon, .cancelBtnWarning').click(function() {
              $('#warning_toProceedModal').hide()
            })
          
          } else {
            
            setTheCouponVal()
          }
        }
       
      })
 
    });
    const dateObj = new Date(exprd_date);
    var floatAmount = parseFloat(c_amount.replace(/,/g, ''));
    const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('en-US', dateOptions).format(dateObj);
    const timeOptions = { hour: 'numeric', minute: 'numeric', hour12: true };
    const formattedTime = new Intl.DateTimeFormat('en-US', timeOptions).format(dateObj);
  
    $('#valid_modal').show();
    var formatTotal = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP'
                    }).format(floatAmount);
    $('.couponAmount').text(formatTotal)
    $('.validity').text(`[${formattedDate} ${formattedTime}]`);

  }

  $('#validClose').on('click', function() {
    $('#valid_modal').hide();
  });

function closeModal(){
   $('#valid_modal').hide();
   $('.search_input').focus()
}

</script>