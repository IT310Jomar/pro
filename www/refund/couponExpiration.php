<style>
  #coupon_Modal .modal-dialog {
    max-width: fit-content;
    min-width: 600px;
  }

  @media (max-width: 768px) {
    #coupon_Modal .modal-dialog {
      max-width: 90vw;
    }
  }

  #coupon_Modal .modal-content {
    color: #ffff;
    background: #262625;
    border-radius: 0;
    min-height: 25vh;
    position: relative;
  }

  #coupon_Modal .close-button {
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

  #coupon_Modal .modal-title {
    font-family: Century Gothic;
    font-size: 1.5em;
    margin-top: 1em;
    margin-bottom: 0.5em;
    display: flex;
    align-items: center;
  }

  #coupon_Modal .warning-container {
    display: flex;
    align-items: center;
  }

  #coupon_Modal .warning-container img {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1vh;
    margin-top: -0.5em;
  }

  #coupon_Modal .warningCard {
    min-width: fit-content;
    /* Adjusted width */
    height: 15vh;
    display: flex;
    margin-left: 2em;
    border: 2px solid #4B413E;
    border-radius: 0;
    padding: 1.5vw;
    box-sizing: border-box;
    justify-content: flex-start;
    align-items: center;
    background: #262625;
    margin-right: 2em;
    flex-shrink: 0;
    margin-top: -2vh;
  }

  #coupon_Modal .warningText {
    color: #fff;
    margin-right: 2vw;
    font-size: 1.5em;
    font-family: "Century Gothic", sans-serif;
    white-space: nowrap;
    text-align: center;
  }


  .expireDate::placeholder {
        font-style: italic;
    }
  #coupon_Modal .warning-container svg {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1em;
    margin-top: -0.5em;
  }
 .confirmation-container{
    margin-top: 1em;
    margin-bottom: 1em;
    display: flex;
  }
  .cancelBtns{
    font-family: Century Gothic;
    width: 140px;
    height: 40px;
  }
  .saveButtonDate{
    font-family: Century Gothic;
    width: 140px;
    height: 40px;
  }
  .saveButtonDate:focus{
    background-color:  #1E8449;
    outline: none;
  }

</style>

<!-- ... (your existing HTML structure) -->
<div class="modal" id="coupon_Modal"   tabindex="0" style="background-color: rgba(0, 0, 0, 0.4); overflow: hidden; z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button id="dateButton" class="close-button" style="font-size:larger">&times;</button>
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
                   <p class="warning-title"><b>ATTENTION</b></p>&nbsp;
                   <p style="font-family: Century Gothic; color: #FF6900;"><b>[REQUIRED]</b></p>
            </div>
          </div>
          <div class="warningCard">
             <div style="width: 100%">
                 <p style="font-family: Century Gothic; font-size: medium; text-align: center; margin-bottom: 0">The item's price is less than the value of the coupon</p>
                 <p style="font-family: Century Gothic; font-size: medium; text-align: center; margin-top: 0; margin-bottom: 0">used.&nbsp;<span style="color:#FF6900" class="couponAmt">100</span>&nbsp; will converted back</p>
                 <p style="font-family: Century Gothic; font-size: medium; text-align: center; margin-top: 0">into coupon form.</p>
             </div>
           </div>
          <div class="confirmation-container">
            <div style="width: 50%;margin-left:2em">
               <button  class="cancelBtns" style="color: red">CANCEL</button>
            </div>
             <div style="display:flex; align-items:right;width: 50%;justify-content: right; margin-right: 2em">
               <button id="saveButtonDate" class="saveButtonDate">CONTINUE</button>
             </div>                        
          </div>
    </div>
  </div>
</div>
<script>


function couponModal() {
    $('#coupon_Modal').show();
    $(document).ready(function() {
       $('.saveButtonDate').focus();
    });

}
function couponModals() {
    $('#coupon_Modal').show();

}
$('#dateButton').on('click', function() {
    $('#coupon_Modal').hide();
   
  });



</script>

