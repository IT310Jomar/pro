<style>
 #ewallet_modal .modal-dialog {
  max-width: fit-content; 
  min-width: 300px; 
}

@media (max-width: 1000px) {
  #ewallet_modal .modal-dialog {
    max-width: 90vw; 
  }
}


  #ewallet_modal .modal-content {
    color: #ffff;
    background: #262625;
    border-radius: 0;
    min-height: 50vh;
    position: relative;
  }

  #ewallet_modal .close-button {
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

  #ewallet_modal .modal-title {
    font-family: Century Gothic;
    font-size: 1.5em;
    margin-top: 1em;
    margin-bottom: 0.5em;
    display: flex;
    align-items: center;
  }

  #ewallet_modal .warning-container {
    display: flex;
    align-items: center;
  }

  #ewallet_modal .warning-container svg {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1em;
    margin-top: -0.5em;
  }

  #ewallet_modal .warningCard {
    min-width: fit-content;
    height: 38vh;
    margin-left: 2em;
    border: 2px solid #4B413E;
    border-radius: 0;
    padding: 1.5vw;
    box-sizing: border-box;
    background: #262625;
    margin-right: 2em;
    flex-shrink: 0;
    margin-top: -1em;
    position: relative;
  }

 
#ewallet_modal .topCard {
    border: 2px solid #4B413E; 
    margin: 1em 0; 
    padding: 1em;
    box-sizing: border-box; 
    border-radius: 0;
    display: flex;
    height: 15vh;
    margin-top: -1vh;
    margin-bottom: 3vh;
    width: fit-content;
   

}
#ewallet_modal .belowCard {
    /* border: 2px solid #4B413E;  */
    margin: 1em 0; 
    padding: 1em;
    /* box-sizing: border-box; */
    display:flex; 
    border-radius: 0;
    height: fit-content;
    position: relative;
    margin-top: -5vh;
}
#ewallet_modal .leftCard {
    /* border: 2px solid #4B413E;  */
    margin: 1em 0; 
    padding: 1em;
    /* box-sizing: border-box;  */
    border-radius: 0;
}
#ewallet_modal .rightCard {
    /* border: 2px solid #4B413E;  */
    margin: 1em 0; 
    padding: 1em;
    /* box-sizing: border-box;  */
    border-radius: 0;
    width: 50%;
    
}

#closeButton {
    font-size: 1.25em;
    width: 150px;
    height: 40px;
    font-family: Century Gothic;
  }
 
#ewallet_modal .closeButton{
width: 160px;
height: 37px;
font-family: Century Gothic;
font-size: 20px;
margin-top: 10px;
margin-right: 10px;
margin-bottom: 15px;
}
#ewallet_modal .printVoucher:focus {
  background-color: #1E8449; 
  outline: 0;
}
#ewallet_modal .submitEWallet{
width: 160px;
height: 37px;
font-family: Century Gothic;
font-size: 20px;
margin-top: 10px;
margin-right: 1.7em;
margin-bottom: 15px;
}
#ewallet_modal .wallet:focus {
  outline: none;
  border: 1px solid transparent;
  box-shadow: inset 0 0 0 1px transparent;
  background-color: #404040;
  border: 1px solid #4B413E;
  color: #fff; 
}

#ewallet_modal .wallet {
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  position: relative;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  min-width: 235px;
  max-width: 850px
  
}

#ewallet_modal .wallet::placeholder {
  color: #7F7F7F; 
  opacity: 1; 
  font-size: 12px;
}
#ewallet_modal .date{
  font-family: Century Gothic;
  min-width: 100px;
  max-width: 600px;
  display: flex;
  align-items: center;
  justify-content: center;
}
#ewallet_modal .time{
  font-family: Century Gothic;
  color: #FF6900;
}
#ewallet_modal .maya {
  margin: 1em 0;
  border-radius: 0;
  max-width: 9vh;
  /* border: 2px solid #4B413E;
  box-sizing: border-box; */
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; 
  position: relative;
  height: 9vh; 
  margin-right: 3px;


}
#ewallet_modal .mayaImg {
  width: 9vh; 
  height: 9vh; 
  object-fit: fill; 
}
 .checkmark-container {
  position: absolute;
  top: 0;
  right: 0;
  background-color:  #FF6900; 
  color: white; 
  border-radius: none; 
  width: 20px; 
  height: 20px; 
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px; 
  visibility: hidden; 
}
.maya.active {
  border: 2px solid  #FF6900; 
}

.maya.active .checkmark-container {
  visibility: visible; 
}

.gcash.active {
  border: 2px solid  #FF6900; 
}

.gcash.active .checkmark-container {
  visibility: visible; 
}
.shopeePay.active {
  border: 2px solid  #FF6900; 
}

.shopeePay.active .checkmark-container {
  visibility: visible; 
}
.grabPay.active {
  border: 2px solid  #FF6900; 
}

.grabPay.active .checkmark-container {
  visibility: visible; 
}
.aliPay.active {
  border: 2px solid  #FF6900; 
}

.aliPay.active .checkmark-container {
  visibility: visible; 
}
.gcash{
  margin: 1em 0;
  padding: 1em;
  border-radius: 0;
  width: 9vh;
  /* border: 2px solid #4B413E;
  box-sizing: border-box; */
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; 
  position: relative;
  height: 9vh;
  margin-left: 40px; 
 
}
.shopeePay{
  margin: 1em 0;
  padding: 1em;
  border-radius: 0;
  width: 8.8vh;
  /* border: 2px solid #4B413E;
  box-sizing: border-box; */
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; 
  position: relative;
  height: 8.8vh; 

 
}

.gcashImg{
  width: 8.8vh; 
  height: 7.5vh; 
  object-fit: fill; 
}
.shopeeImg{
  width: 9vh; 
  height: 7.7vh; 
  object-fit: fill; 
}
.grabImg{
  width: 8vh; 
  height: 8vh; 
  object-fit: fill; 
}
.aliImg{
  width: 9vh; 
  height: 7.7vh; 
  object-fit: fill; 
}




.grabPay{
  margin: 1em 0;
  padding: 1em;
  border-radius: 0;
  width: 9vh;
  /* border: 2px solid #4B413E;
  box-sizing: border-box; */
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; 
  position: relative;
  height: 9vh; 
 
}
.aliPay{
  margin: 1em 0;
  border-radius: 0;
  padding: 1em;
  width: 8.8vh;
  /* border: 2px solid #4B413E;
  box-sizing: border-box; */
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; 
  position: relative;
  height: 9vh; 
  margin-right: 40px;
}
#dateDis, #timeDis {
    font-weight: bold;
    font-size: 15px;
}
#ewallet_modal .message {
    color: red;
    font-size: 12px;
    display: none;
}
#ewallet_modal .submitEWallet:focus{
  background-color: #1E8449; 
  outline: 0;
}
#customerName:focus{
  border-color:#FF6900 !important;
}
#transactionRef:focus{
  border-color:#FF6900 !important;
}
</style>

<!-- ... (your existing HTML structure) -->
<div class="modal" id="ewallet_modal"  tabindex="0" style="background-color: rgba(0, 0, 0, 0.7); overflow: hidden; z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button id="eWalletClose" name="eWalletClose" class="close-button" style="font-size: larger;">&times;</button>
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
          <p class="warning-title header_name"><b>REFUND VIA E-WALLET</b></p>&nbsp;
          <p class="cashier_name" style="font-family: Century Gothic; color: #FF6900;"><b style="text-transform: uppercase;" ><?= '[USER:' . $firstName . ']' ?></b></p>
        </div>
      </div>
      <div class="warningCard">

        <div class="topCard">
          <div  class="gcash">
          <img class="gcashImg" src="./assets/img/gcash.png">
          <div class="checkmark-container">&#10003;</div>
          </div>
          <div  class="maya">
          <img class="mayaImg" src="./assets/img/maya.png">
          <div class="checkmark-container">&#10003;</div>
          </div>
          <div  class="shopeePay">
          <img class="shopeeImg" src="./assets/img/shopeepay.png">
          <div class="checkmark-container">&#10003;</div>
          </div>
          <div  class="grabPay">
          <img class="grabImg" src="./assets/img/grabpay.png">
          <div class="checkmark-container">&#10003;</div>
          </div>
          <div  class="aliPay">
          <img class="aliImg" src="./assets/img/alipay.png">
          <div class="checkmark-container">&#10003;</div>
          </div>
        </div>
        <div class="belowCard" >
      
          <div class="leftCard" style="width: 50%;">
          <div style="display: flex; width:fit-content;align-items:center; justify-content:center; margin-left:15px">
          <h6 class="date" id="dateDis"></h6>&nbsp;&nbsp;&nbsp;&nbsp;
          <h6 class="time" id="timeDis"></h6>
          </div>
          <small style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center ">Cannot be modified after</small>
          <small style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center; margin-top: -1vh">submission of entry.</small>
          <span  class="message" id="customerNameError"  style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center; margin-top: 15px"></span>
          <span  class="message" id="transactionRefError"  style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center"></span>
          <span  class="message" id="amountError"   style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center"></span>
          <span  class="message" id="optionError"   style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center"></span>
          </div>
          <div class="rightCard" style="align-items: center; justify-content: right">
          <input type="text" class="wallet form-control" id="customerName" name="customerName" placeholder="CUSTOMER NAME(optional)"/>
          <input type="text" class="wallet form-control" id="transactionRef" name="transactionRef" placeholder="REFERENCE NUMBER(*)"/>
          <input type="text" readonly class="wallet form-control amount_value_e_wallet" id="amount" name="amount" placeholder="(Php) ENTER AMOUNT"/>
       
      </div>
        </div>
      
    </div>
      <div style="display:flex; align-items: right; justify-content: right">
        <button class="submitEWallet" name="submitEWallet" onclick="submitE()">[ENTER] SUBMIT</button>
      </div>
    </div>
  </div>
</div>

<script>
 
  $('#eWalletClose').on('click', function() {
     $('#ewallet_modal').hide();
   
  });


function removeActiveClass() {
  document.querySelectorAll('.maya, .gcash, .shopeePay, .grabPay, .aliPay').forEach(card => {
    card.classList.remove('active');
  });
}


function removeActiveClass(exceptCard) {
  document.querySelectorAll('.maya, .gcash, .shopeePay, .grabPay, .aliPay').forEach(card => {
    if (card !== exceptCard) { 
      card.classList.remove('active');
    }
  });
}


function toggleActiveClass(card) {
  if (card.classList.contains('active')) {
    card.classList.remove('active');
  } else {
    removeActiveClass(card); 
    card.classList.add('active'); 
   
  }
}

var optionsData;
var paymendMetthodVal;
var option;


function toSelectCard(options) {
  options = $('.maya.active, .gcash.active, .shopeePay.active, .grabPay.active, .aliPay.active').length > 0;
    if (document.querySelector('.maya').classList.contains('active')) {
      optionsData  = 3
      paymendMetthodVal = 3
    }else if(document.querySelector('.gcash').classList.contains('active')){
      optionsData = 2
      paymendMetthodVal = 2
    }else if(document.querySelector('.shopeePay').classList.contains('active')){
      optionsData = 9
      paymendMetthodVal = 8;
    }else if(document.querySelector('.grabPay').classList.contains('active')){
      optionsData = 4
      paymendMetthodVal = 9;
    }else if(document.querySelector('.aliPay').classList.contains('active')){
      optionsData = 8
      paymendMetthodVal = 10;
    }else{
      optionsData = ""
      paymendMetthodVal = ""
    }
    
    if(options){
      $('#optionError').text('')
    }

    // console.log(optionsData)  
    // console.log(paymendMetthodVal)
    $('#payment_met_val').val(paymendMetthodVal);
    $('.paymentType_val').val(paymendMetthodVal);
}
document.querySelectorAll('.maya, .gcash, .shopeePay, .grabPay, .aliPay').forEach(card => {
  card.addEventListener('click', function() {
    toggleActiveClass(this);
    toSelectCard(option)
  });
});

function renderDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = today.getMonth();
    var yyyy = today.getFullYear();
  
    var hours = today.getHours();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; 
    hours = String(hours).padStart(2, '0');
    
    var minutes = String(today.getMinutes()).padStart(2, '0');
    var seconds = String(today.getSeconds()).padStart(2, '0');
    var timeString = '[' + hours + ':' + minutes + ':' + seconds + ' ' + ampm + ']';

    var monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    var monthName = monthNames[mm];

    var dateString = monthName + ' ' + dd + ', ' + yyyy;

    var myTime = document.getElementById('timeDis');
    myTime.textContent = timeString;

    var myDate = document.getElementById('dateDis');
    myDate.textContent = dateString;
}

renderDate();  
setInterval(renderDate, 1000);
document.addEventListener('keydown', function(event) {
        if (event.key === 'Tab') {
            event.preventDefault(); 
            $('.submitEWallet').focus()
        }
    });

$(document).ready(function() {

  $('#ewallet_modal').keydown(function(e){
  switch(e.which){
    case 38:
      $('#customerName').focus();
    break;
    default: return;
  }
  e.preventDefault()
})

  let timeout = null; // Initialize timeout variable

// Function to focus button, checking all conditions
function focusButtonIfReady() {
    const customerName = $('#customerName').val();
    const transactionRef = $('#transactionRef').val();
    const amount = $('#amount').val();
    const optionss = $('.maya.active, .gcash.active, .shopeePay.active, .grabPay.active, .aliPay.active').length > 0;
    if (customerName && transactionRef && amount && optionss) {
        $('.submitEWallet').focus();
    }
}


function handleInput() {
    clearTimeout(timeout); 
    timeout = setTimeout(focusButtonIfReady, 1000); 
}



$('#customerName, #transactionRef, #amount').on('input', handleInput);
    $('#customerName').on('input', function(){
        const customerName = $(this).val(); 
        if (customerName) {
            $('#customerNameError').css('display', 'none'); 
        }
       
    });
    $('#transactionRef').on('input', function(){
        const transactionRef = $(this).val();
        
        
        if (transactionRef) {
            $('#transactionRefError').css('display', 'none'); 
        }
      
    });
  
$('#amount').on('input', function() {
    let a = $(this).val().replace(/[^0-9.]+/g, '').replace(/(\..*)\./g, '$1');

    a = a.replace(/^0+([1-9])/, '$1'); 
    a = a.replace(/^(0+\d+)$/, '0'); 
    a = a.replace(/(\.\d{2})\d+/, '$1');

   
    let parts = a.split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    a = parts.join('.');
    $(this).val(a);
    if (a) {
        $('#amountError').css('display', 'none');
    }
   
  });
});

document.addEventListener('keydown', function(event) {
  var activeCard = document.querySelector('.maya.active, .gcash.active, .shopeePay.active, .grabPay.active, .aliPay.active');
  var customerNameInput = document.getElementById('customerName');
  var transactionRefInput = document.getElementById('transactionRef');
  switch(event.keyCode) {
    case 37:
      if (activeCard) {
        moveLeft(activeCard);
        toSelectCard(activeCard)
      }
      break;
    case 39: 
      if (activeCard) {
        moveRight(activeCard);
        toSelectCard(activeCard)
      }
      break;
    case 38: 
      if (document.activeElement === customerNameInput || document.activeElement === transactionRefInput) {
        var lastActiveCard = document.querySelector('.maya.active, .gcash.active, .shopeePay.active, .grabPay.active, .aliPay.active');
        if (lastActiveCard) {
          lastActiveCard.focus();
        }
      }
      break;
    case 40: 
      if (activeCard) {
        if (document.activeElement === customerNameInput) {
          transactionRefInput.focus();
        } else {
          customerNameInput.focus();
        }
      }
      break;
  }
});

function moveLeft(activeCard) {
 
  var prevCard = activeCard.previousElementSibling;
  if (!prevCard) {
    prevCard = activeCard.parentNode.lastElementChild;
  }
  toggleActiveClass(prevCard);
  updateOptionsData(prevCard);
}

function moveRight(activeCard) {
 
  var nextCard = activeCard.nextElementSibling;
  if (!nextCard) {
    nextCard = activeCard.parentNode.firstElementChild;
  }
  toggleActiveClass(nextCard);
  updateOptionsData(nextCard);
}

function updateOptionsData(activeCard) {
  if (activeCard.classList.contains('maya')) {
    optionsData = 3;
  } else if (activeCard.classList.contains('gcash')) {
    optionsData = 2;
  } else if (activeCard.classList.contains('shopeePay')) {
    optionsData = 9;
  } else if (activeCard.classList.contains('grabPay')) {
    optionsData = 4;
  } else if (activeCard.classList.contains('aliPay')) {
    optionsData = 8;
  } else {
    optionsData = "";
  }
}

$('#ewallet_modal').keydown(function(e){
 switch(e.which){
  case 13:
    $('button[name="submitEWallet"]').click()
  break;
  default: return;
 }
 e.preventDefault()
})

$('button[name="submitEWallet"]').click(function() {
      $('.submitEWallet').css({
          'background-color': '#1E8449',
          'outline':'0',
          'border-color': '#1E8449'
      });
      setTimeout(function() {
        $('.submitEWallet').css({
            'background-color': '',
            'outline': '',
            'border-color': ''
        });
    }, 1000);
});

$('#ewallet_modal').keydown(function(e) {
        switch(e.which){
         case 27:
          $('button[name="eWalletClose"]').click()
          $('#ewallet').focus()  
         break;
        default: return; 
        }
      e.preventDefault(); 
    });
</script>