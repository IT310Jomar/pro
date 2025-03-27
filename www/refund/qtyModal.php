<style>
  #qty_Modal .modal-dialog {
    max-width: fit-content;
    min-width: 430px;
  }

  @media (max-width: 768px) {
    #qty_Modal .modal-dialog {
      max-width: 90vw;
    }
  }

  #qty_Modal .modal-content {
    color: #ffff;
    background: #262625;
    border-radius: 0;
    min-height: 25vh;
    position: relative;
  }

  #qty_Modal .close-button {
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

  #qty_Modal .modal-title {
    font-family: Century Gothic;
    font-size: 1.5em;
    margin-top: 1em;
    margin-bottom: 0.5em;
    display: flex;
    align-items: center;
  }

  #qty_Modal .warning-container {
    display: flex;
    align-items: center;
  }

  #qty_Modal .warning-container img {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1vh;
    margin-top: -0.5em;
  }

  #qty_Modal .warningCard {
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
    margin-top: -1em;
  }

  #qty_Modal .warningCard img {
    max-width: 70%;
    max-height: 70%;
    border: none;
    margin-left: 2vw;
  }

  #qty_Modal .warningText {
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

 
  #quantity::placeholder {
        font-style: italic;
    }
  #quantityData{
    border-radius: 0;
    min-width: fit-content;
  }
  .saveButtonQuantity:focus {
        background-color: #1E8449;
        outline: none;
    }

    .qtyBody{
  margin-left: 2em;
  margin-right: 2em;
  margin-bottom: 2em;
}

</style>

<!-- ... (your existing HTML structure) -->
<div class="modal" id="qty_Modal"  class="modalQty"  tabindex="0" style="background-color: rgba(0, 0, 0, 0.9); overflow: hidden; z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button id="qtyButton" class="close-button" style="font-size:larger">&times;</button>
      <div class="modal-title">
        <div class="warning-container">
        <img src="./assets/img/icons8-refund-64.png">
          <p class="warning-title"><b>INPUT</b></p>&nbsp;
          <p style="font-family: Century Gothic; color: #FF6900;"><b>[NO. OF QUANTITY]</b></p>
        </div>
      </div>
      <div class="warningCard">
       
      <input class="form-control"  inputmode="numeric" type="number" id="quantityData" placeholder="Enter Quantity" style="text-align: right;" oninput="validateQuantity();this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1')" />

      </div>
     <div class="qtyBody">
     <table class="full-height-table" style="margin-top: 10px;">
              <tr>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">1</button></td>
                <td ><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">2</button></td>
                <td><button class="payment_btn btn btn-secondary  shadow-none full-height-btn">3</button></td>
                <td>
                  <button class="payment_btn btn btn-secondary  shadow-none full-height-btn">BACK
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
                  <button id="saveButtonQuantity"  name="saveButtonQuantity" class="saveButtonQuantity payment_btn btn btn-secondary  shadow-none full-height-btn" style="height: 100%; padding: 0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#ffff" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                      <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                    </svg>
                    </svg>
                  </button>
                </td>
              </tr>
              <tr>
                <td colspan="3"><button class="payment_btn btn btn-secondary shadow-none full-height-btn">0</button></td>
              </tr>
            </table>
          </div>
      </div>       
    </div>
  </div>
</div>
<script>
var maxQnty;

function qtyModal(quantity, index, avgPrice) {
    $('#qty_Modal').show();

    if ($('#qty_Modal').is(':visible')) {
        $('#quantityData').focus();
        $('#quantityData').val(quantity);
    }
    maxQnty = quantity;

    $('#saveButtonQuantity').data('index', index).data('price', avgPrice);
    $('#qtyButton').data('index', index);


    $('#qtyButton').off('click').on('click', function() {
      var checkIndex = $(this).data('index');
      document.removeEventListener('keydown', function(event) {
       
    });

      $('.transactionCheckbox').eq(index).prop('checked', false).change();
      $('.quantity-input').eq(index).val('');
      $('.total-qty').eq(index).val('');
      $('#qty_Modal').hide();
   });

}
function validateQuantity() {
  
    var inputElement = document.getElementById('quantityData');
    var inputValue = inputElement.value.trim(); 
    var parsedValue = parseInt(inputValue);
    if (inputValue === '') { 
      $('#saveButtonQuantity').prop('disabled', true);
        return;
    }else{
      $('#saveButtonQuantity').prop('disabled', false);
    }
    if (isNaN(parsedValue) || parsedValue < 1  || parsedValue > maxQnty ) {  
        inputElement.value = 1;
    }
}

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Tab') {
            event.preventDefault(); 
            $('.saveButtonQuantity').focus()
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.payment_btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const number = this.innerText; 
                var quantityInput = document.getElementById('quantityData'); 
                if (number === 'BACK') {
                    quantityInput.value = quantityInput.value.slice(0, -1);
                    if (!quantityInput.value) {
                        $('#saveButtonQuantity').prop('disabled', true);
                    }
               } else if (number === 'C') {
                    quantityInput.value = '';
                    if (!quantityInput.value) {
                        $('#saveButtonQuantity').prop('disabled', true);
                    }
                } else {     
                    quantityInput.value += number;
                    validateQuantity()
                }
            });
        });
    });
    $('#quantityData').keydown(function(e) {
        switch(e.which){
         case 13:
            $('button[name="saveButtonQuantity"]').click();
        break;
        default: return; 
        }
      e.preventDefault(); 
    });


</script>

