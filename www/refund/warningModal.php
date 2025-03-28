<style>
  #warning_modal .modal-dialog {
    max-width: fit-content;
    min-width: 450px;
  }

  @media (max-width: 768px) {
    #warning_modal .modal-dialog {
      max-width: 90vw;
    }
  }

  #warning_modal .modal-content {
    color: #ffff;
    background: #262625;
    border-radius: 0;
    min-height: 35vh;
    position: relative;
  }

  #warning_modal .close-button {
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

  #warning_modal .modal-title {
    font-family: Century Gothic;
    font-size: 1.5em;
    margin-top: 1em;
    margin-bottom: 0.5em;
    display: flex;
    align-items: center;
  }

  #warning_modal .warning-container {
    display: flex;
    align-items: center;
  }

  #warning_modal .warning-container svg {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1em;
    margin-top: -0.5em;
  }

  #warning_modal .warningCard {
    max-width: 61.2vh;
    /* Adjusted width */
    height: 25vh;
    display: flex;
    margin-left: 2em;
    border: 2px solid #4B413E;
    border-radius: 0;
    padding: 1.5vw;
    box-sizing: border-box;
    justify-content: center;
    align-items: center;
    background: #262625;
    margin-right: 2em;
    flex-shrink: 0;
    margin-top: -1em;
  }



  #warning_modal .warningCard img {
    border: none;
    margin-left: 2vw;
  }

  #warning_modal .warningText {
    color: #fff;
    margin-right: 2vw;
    font-size: 1.5em;
    font-family: "Century Gothic", sans-serif;
    white-space: nowrap;
    text-align: center;
  }

  #warning_modal .warningText h {
    display: inline;
    margin: 0;
    font-size: 1.5em;
    font-weight: bold;
  }

  #warning_modal .continueButtonContainer {
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
  .noDataButtons:focus{
    outline: none;
  }
  .noDataButtons{
    width: 160px;
    height: 37px;
    font-family: Century Gothic;
    font-size: 20px;
    margin-top: 10px;
    margin-right: 1.7em;
    margin-bottom: 15px;  
  }
</style>

<!-- ... (your existing HTML structure) -->
<div class="modal" id="warning_modal" class="modalWarning" tabindex="0" style="background-color: rgba(0, 0, 0, 0.9); overflow: hidden; z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button id="warning" name="warning" class="close-button" style="font-size: larger;">&times;</button>
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
          <p class="warning-title"><b>WARNING!</b></p>&nbsp;
          <p style="font-family: Century Gothic; color: #FF6900;"><b>[NO MATCH FOUND]</b></p>
        </div>
      </div>
      <div class="warningCard">
        <div>
          <img src="./assets/img/Picture1.png">
        </div>
        <div class="warningText">
          <p style="font-family: Century Gothic;"><b>NO MATCH FOUND!</b></p>
        </div>
      </div>
      <div style="display:flex; align-items: right; justify-content: right">
        <button onclick="closeButtons()" class="noDataButtons">[ENTER] CLOSE</button>
      </div>
    </div>
  </div>
</div>

<script>
  function warningModal() {
    $('#totalData').hide();
    $('#warning_modal').show();
    $(document).ready(function() {
       $('.noDataButtons').focus();
       });
   
  }

  $('#warning').on('click', function() {
    $('#warning_modal').hide();
    $('#receiptNumber').focus()
   
  });
  function closeButtons(){
    $('#warning_modal').hide();
    $('#receiptNumber').focus()
}
</script>