<style>
 #cc_modal .modal-dialog {
  max-width: 750px; 
  min-width: 300px; 
}

@media (max-width: 1000px) {
  #cc_modal .modal-dialog {
    max-width: 90vw; 
  }
}


  #cc_modal .modal-content {
    color: #ffff;
    background: #262625;
    border-radius: 0;
    height: fit-content;
    position: relative;
  }

  #cc_modal .close-button {
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

  #cc_modal .modal-title {
    font-family: Century Gothic;
    font-size: 1.5em;
    margin-top: 1em;
    margin-bottom: 0.5em;
    display: flex;
    align-items: center;
  }

  #cc_modal .warning-container {
    display: flex;
    align-items: center;
  }

  #cc_modal .warning-container svg {
    width: 35px;
    height: 35px;
    margin-right: 0.5em;
    margin-left: 1em;
    margin-top: -0.5em;
  }

  #cc_modal .warningCard {
    min-width: fit-content;
    min-height: 420px;
    max-height: 420px;
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

 
  #cc_modal .topCard {
    border: 2px solid #4B413E;
    margin: 1em 0;
    padding: 1em;
    box-sizing: border-box;
    border-radius: 0;
    height: 200px;
    margin-top: -1vh;
    margin-bottom: 3vh;
    position: relative; 

}

#cc_modal .belowCard {
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
#cc_modal .leftCard {
    /* border: 2px solid #4B413E;  */
    margin: 1em 0; 
    padding: 1em;
    /* box-sizing: border-box;  */
    border-radius: 0;
}
#cc_modal .rightCard {
    /* border: 2px solid #4B413E;  */
    margin: 1em 0; 
    padding: 1em;
    /* box-sizing: border-box;  */
    border-radius: 0;
    width: 50%;
    
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
.submitCC{
width: 160px;
height: 37px;
font-family: Century Gothic;
font-size: 20px;
margin-top: 10px;
/* margin-right: 1.7em; */
margin-bottom: 15px;
}
.cancelCC{
width: 160px;
height: 37px;
font-family: Century Gothic;
font-size: 20px;
margin-top: 10px;
/* margin-right: 1.7em; */
margin-bottom: 15px;
}
.resetCC{
width: 160px;
height: 37px;
font-family: Century Gothic;
font-size: 20px;
margin-top: 10px;
/* margin-right: 1.7em; */
margin-bottom: 15px; 
}

.wallet:focus {
  outline: none;
  border: 1px solid transparent;
  box-shadow: inset 0 0 0 1px transparent;
  background-color: #404040;
  border: 1px solid #4B413E;
  color: #fff; 
}

.wallet {
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
  max-width: 850px;
}

.wallet::placeholder {
  color: #7F7F7F; 
  opacity: 1; 
  font-size: 12px;
}
.date{
  font-family: Century Gothic;
  min-width: 100px;
  max-width: 600px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.time{
  font-family: Century Gothic;
  color: #FF6900;
}

#dateDis, #timeDis {
    font-weight: bold;
    font-size: 15px;
}
.messages {
    color:#FF6900;
    font-size: 12px;
    display: none;
}
.submitCC:focus{
  background-color: #1E8449; 
  outline: 0;
  border-color: #1E8449 !important;
}
.oneCard{
    border-radius: 0;
    display: flex;
    margin-top: -1vh;
    width: 100%;
    margin-bottom: 2vh;
   
}
.twoCard{
    margin: 1em 0; 
    padding: 1em;
    border-radius: 0;
    display: flex;
    width: 100%;
    margin-bottom: 10vh;

   
}
.threeCard {
    padding: 1em;
    border-radius: 0;
    display: flex;
    width: 97.3%; 
    height: 25px;
    position: absolute; 
    bottom: 5px;
    left: 5px; 
    right:2vh;
  
}
.ccHeader{
  font-family: Century Gothic;
}

.resized-visa {
    width: 42%;
    height: auto; 
    margin-top: -7vh;
}.resized-tinker{
    width: 35%;
    height: auto; 
    margin-top: -3vh;
}
.resized-master{
    width: 32%;
    height: auto; 
    margin-top: -3vh;
}
.resized-discover{
    width: 35%;
    height: auto; 
    margin-top: -4vh;
}
.resized-american{
    width: 32%;
    height: auto; 
    margin-top: -3vh;
}
.resized-jcb{
    width: 34%;
    height: auto; 
    margin-top: -4vh;
}
.invalids{
  font-size: larger;
  font-family: Century Gothic;
  color: #FF6900;
  font-style: bold;
}
.ccnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 0; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}

.lastnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom:0;
  left: 96%; 
  right: 0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.secondnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 6%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.thirdnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 12.1%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.fourthnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 18.1%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.fifthnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 26.1%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.sixthnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 32.3%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.seventhnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 38.3%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.eigthnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 44.3%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.ninthnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 52%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.tenthnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 58%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.eleventhnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 64%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}

.twelfthnumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 70%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}

.thirteennumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 78%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.fourteennumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 84%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.fifteennumber{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  border-radius: 0;
  background-color: #404040;
  border: 1px solid #4B413E;
  box-sizing: border-box;
  outline: none;
  color:  #fff;
  position: absolute; 
  bottom: 0;
  left: 90%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.firstDivider{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  font-style: bold;
  position: absolute; 
  bottom: 0;
  left: 22%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.secondDivider{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  font-style: bold;
  position: absolute; 
  bottom: 0;
  left: 48.1%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}
.thirdDivider{
  font-style: italic;
  font-family: 'Century Gothic', sans-serif;
  font-style: bold;
  position: absolute; 
  bottom: 0;
  left:74%; 
  right:0;
  top:0;
  min-width: 5%;
  max-width: 5%; 
  text-align: center;
}

.has-value {
       border-color: #1E8449 !important;
  }

.no-value {
  border-color:#FF6900 !important;
}

#customerNames:focus{
  border-color:#FF6900 !important;
}
#transactionRefs:focus{
  border-color:#FF6900 !important;
}
.cancelCC:focus{
outline: 0;
border-color:#FF6900 !important;
color: #FF6900
}
.resetCC:focus{
  outline: 0;
  border-color:#FF6900 !important;
  color: #FF6900
}
</style>

<div class="modal" id="cc_modal"  tabindex="0" style="background-color: rgba(0, 0, 0, 0.7); overflow: hidden; z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button id="ccClose" name="ccClose" class="close-button" style="font-size: larger;">&times;</button>
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
          <p class="warning-title"><b>REFUND VIA DEBIT/CREDIT CARD </b></p>&nbsp;
          <p style="font-family: Century Gothic; color: #FF6900;"><b>[USER: ADMIN]</b></p>
        </div>
      </div>
      <div class="warningCard">
      
        <div class="topCard">
            <div class="oneCard"  style="display: flex;align-items:center; justify-content:center;">
              <h6 class="ccHeader">You are about to return an amount to &nbsp;<span class="cardname" style="color:#FF6900"></span>&nbsp; Card</h6>
            </div>
            <div class="twoCard" style="display: flex;align-items:center; justify-content:center;">
            <img class="resized-visa" src="./assets/img/visaCard.png">
            <img class="resized-tinker" src="./assets/img/ccdc.png">
            <img class="resized-master" src="./assets/img/masterCard.png">
            <img class="resized-discover" src="./assets/img/discoverCard.png">
            <img class="resized-american" src="./assets/img/amerCard.png">
            <img class="resized-jcb" src="./assets/img/jcbCard.png">
            <h6 class="invalids"><b?>[INVALID CARD]</b></h6>
            </div> 
            <div class="threeCard">
              <input autocomplete="off" class="ccnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber2');delayHide(this);updateInputStyle(this);checkAllInputs(); " />
              <input autocomplete="off" id="ccnumber2"   class="secondnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber3');delayHide(this);updateInputStyle(this); checkAllInputs();" />
              <input autocomplete="off" id="ccnumber3"   class="thirdnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber4');delayHide(this);updateInputStyle(this); checkAllInputs();" />
              <input autocomplete="off" id="ccnumber4"   class="fourthnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber5');delayHide(this);updateInputStyle(this); checkAllInputs();" />  
              <small class="firstDivider">-</small>  
              <input autocomplete="off" id="ccnumber5" class="fifthnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber6');delayHide(this);updateInputStyle(this); checkAllInputs();" />    
              <input autocomplete="off" id="ccnumber6" class="sixthnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber7');delayHide(this);updateInputStyle(this); checkAllInputs();" />   
              <input autocomplete="off" id="ccnumber7" class="seventhnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber8');delayHide(this);updateInputStyle(this); checkAllInputs();" />   
              <input autocomplete="off" id="ccnumber8" class="eigthnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber9');delayHide(this);updateInputStyle(this); checkAllInputs();" />          
              <small class="secondDivider">-</small>  
              <input autocomplete="off" id="ccnumber9" class="ninthnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber10');delayHide(this);updateInputStyle(this); checkAllInputs();" />
              <input autocomplete="off" id="ccnumber10" class="tenthnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber11');delayHide(this); checkAllInputs();" />
              <input autocomplete="off" id="ccnumber11" class="eleventhnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber12');delayHide(this);updateInputStyle(this); checkAllInputs();" /> 
              <input autocomplete="off" id="ccnumber12" class="twelfthnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber13');delayHide(this);updateInputStyle(this); checkAllInputs();" />       
              <small class="thirdDivider">-</small>  
              <input autocomplete="off" id="ccnumber13" class="thirteennumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber14');updateInputStyle(this); checkAllInputs();" />  
              <input autocomplete="off" id="ccnumber14" class="fourteennumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber15');updateInputStyle(this); checkAllInputs();" />  
              <input autocomplete="off" id="ccnumber15" class="fifteennumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'ccnumber16');updateInputStyle(this); checkAllInputs();" />       
              <input autocomplete="off" id="ccnumber16" class="lastnumber" inputmode="numeric" pattern="[0-9]" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');autoTab(this, 'customerNames');updateInputStyle(this); checkAllInputs();" /> 
          </div> 

          
        </div>
        <div class="belowCard" >
           <div class="leftCard" style="width: 50%; ">
                 <div style="display: flex; width:fit-content;align-items:center; justify-content:center; margin-left:15px">
                 <h6 class="date" id="dateDiss"></h6>&nbsp;&nbsp;&nbsp;&nbsp;
                 <h6 class="time" id="timeDiss"></h6>
          </div>
                <small style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center ">Cannot be modified after</small>
                <small style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center; margin-top: -1vh">submission of entry.</small>
                <span  class="messages" id="customerNameErrors"  style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center; margin-top: 15px"></span>
                <span  class="messages" id="amountErrors"   style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center"></span>
                <span  class="messages" id="optionErrors"   style="font-family: Century Gothic; display:flex; align-items: center; justify-content: center"></span>
          </div>
          <div class="rightCard" style="align-items: center; justify-content: right">
                <input hidden autocomplete="off" type="text" class="wallet form-control" id="testCustomer" name="testCustomer" placeholder="CUSTOMER NAME(*)"/>
                <input hidden type="number" id="account_number_card">
                <input autocomplete="off" type="text" class="wallet form-control" id="customerNames" name="customerName" placeholder="CUSTOMER NAME(*)" oninput="autoTab(this, 'customername');"/>
                <input autocomplete="off" type="text" class="wallet form-control" id="transactionRefs" name="transactionRef" placeholder="REFERENCE NUMBER"/>
                <input type="text" readonly class="wallet form-control cc_debit_amount" id="amounts" name="amount" placeholder="(Php) ENTER AMOUNT"/>
          </div>
       </div>
    </div>
    <div style="display:flex;width: 750px;" >
        <div style="width:50%;display:flex;align-items: left; justify-content: left;margin-left: 2em;">
            <button class="cancelCC" variant="tonal" onclick="cancel()">[ESC] CANCEL</button>
        </div>
        <div style="width:50%; display:flex;align-items: right; justify-content: center; margin-right: 2em">
             <button class="resetCC" name="resetCC" style="margin-right: 20px" onclick="reset()">[F5] RESET</button>
             <button class="submitCC" name="submitCC" onclick="submitCCRefund()">[ENTER] SUBMIT</button>
        </div>
    </div>
    </div>
  </div>
</div>
<script>
  $('#ccClose').on('click', function() {
     $('#cc_modal').hide();
   
  });


function renderDates() {
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

    var myTime = document.getElementById('timeDiss');
    myTime.textContent = timeString;

    var myDate = document.getElementById('dateDiss');
    myDate.textContent = dateString;
}

renderDates();  
setInterval(renderDates, 1000);
$('.resized-visa').hide();
$('.resized-master').hide();
$('.resized-discover').hide();
$('.resized-american').hide();
$('.resized-jcb').hide();
$('.invalids').hide();
var text = '" "';
$('.cardname').text(text);

var selectedOptions;
$(document).on('input','.ccnumber,.secondnumber,.thirdnumber,.fourthnumber', function(){
    const firstInput = $('.ccnumber').val(); 
    const secondInput = $('.secondnumber').val(); 
    const thirdInput = $('.thirdnumber').val();
    const fourthInput = $('.fourthnumber').val();
    if(firstInput == 4 && secondInput && thirdInput &&  fourthInput){
        $('.resized-visa').show(); 
        selectedOptions = 5;
        var text = '"VISA"';
        $('.cardname').text(text);
        $('.resized-tinker').hide();
        $('.paymentType_val').val(11)
        $('.invalids').hide();
    }else if((firstInput == 5 || firstInput == 2) && secondInput && thirdInput &&  fourthInput){
        $('.resized-master').show(); 
        selectedOptions = 6;
        var text = '"MASTER CARD"';
        $('.cardname').text(text);
        $('.resized-tinker').hide();
        $('.paymentType_val').val(12)
        $('.invalids').hide();
    }else if(firstInput == 6 && secondInput && thirdInput &&  fourthInput){
        $('.resized-discover').show(); 
        selectedOptions = 10;
        var text = '"DISCOVER"';
        $('.cardname').text(text);
        $('.resized-tinker').hide();
        $('.paymentType_val').val(13)
        $('.invalids').hide();
    }else if(firstInput == 3 && (secondInput == 4 || secondInput == 7)  && thirdInput &&  fourthInput){
        $('.resized-american').show(); 
        selectedOptions = 11;
        var text = '"AMERICAN EXPRESS"';
        $('.cardname').text(text);
        $('.resized-tinker').hide();
        $('.paymentType_val').val(14)
        $('.invalids').hide();
    }else if(firstInput == 3 && secondInput == 5 ){
      if(thirdInput >=2 && thirdInput <=8){
        if(fourthInput !== ""){
          $('.resized-jcb').show(); 
          selectedOptions = 12;
          var text = '"JCB"';
          $('.cardname').text(text);
          $('.resized-tinker').hide();
          $('.paymentType_val').val(15)
          $('.invalids').hide();
        }else{
          $('.resized-jcb').hide(); 
          $('.invalids').show();
          $('.resized-tinker').hide();
          var text = '"INVALID"';
          $('.cardname').text(text);
        }
      }else{
        $('.invalids').show();
        $('.resized-jcb').hide(); 
        $('.resized-tinker').hide();
        var text = '"INVALID"';
        $('.cardname').text(text);
      }
    }else if((firstInput == 1 || firstInput >= 7)){
      $('.invalids').show();
      $('.resized-tinker').hide();
      var text = '"INVALID"';
        $('.cardname').text(text);
    }else if(firstInput == 3 && ( secondInput !== 5 || secondInput !== 4 || secondInput !== 7)){
        $('.invalids').show();
        $('.resized-jcb').hide(); 
        $('.resized-american').hide(); 
        $('.resized-tinker').hide();
        var text = '"INVALID"';
        $('.cardname').text(text);
    }
    else {
        $('.resized-tinker').show();
        $('.invalids').hide();
        $('.resized-visa').hide();
        $('.resized-master').hide(); 
        $('.resized-discover').hide();
        $('.resized-american').hide(); 
        $('.resized-jcb').hide();
        var text = '" "';
        $('.cardname').text(text);
    }
  
});

function autoTab(currentElement, nextElementId) {
    if (currentElement.value.length >= currentElement.maxLength) {
        const nextElement = document.getElementById(nextElementId);
        if (nextElement) {
            nextElement.focus();
        } 
    }
}

  $(document).ready(function() {

    $("#transactionRefs").on('input', function() {
      $('#ref_number').val($(this).val());

      if($(this).val() != '') {
        $('.submitCC').css({
            'background-color': '#1E8449',
            'outline':'0',
            'border-color': '#1E8449'
        });
      } else {
        $('.submitCC').css({
            'background-color': '',
            'outline': '',
            'border-color': ''
        });
      }
    })

    $(".ccnumber").on('input', function() {
      $(".ccnumber").keypress(function(event) {
        var charCode = event.which || event.keyCode;
        var charStr = String.fromCharCode(charCode);

        if (charStr === '%') { // Start of a swipe
            $(this).val(''); // Clear the input field
        } else if (charStr === '?') { // End of a swipe
            var cardData = $(this).val(); // Extract the card data
            $("#customerNames").val(cardData)
        } 
    });


      var seeToIt = setInterval(validateCustomerCard, 1)
      setTimeout(function () {
        clearInterval(seeToIt);
      }, 1);
    });

    function validateCustomerCard () {
      if($("#customerNames").val() != '') {
        var inputValue = $('#customerNames').val(); 
        function readMagneticStripeData() {
            return inputValue; 
        }

        function parseMagneticStripeData(data) {
            if (data.substring(data.indexOf('^') + 1, data.indexOf('%'))) {
                var accountNumber = data.substring(data.indexOf('^') + 1, data.indexOf('%'));
                var nameWithSpecialChars = data.substring(data.indexOf('^') + 1, data.indexOf('^', data.indexOf('^') + 1));
                var name = nameWithSpecialChars.replace(/[^\w\s]/gi, ' ');
                var accountNumberDigitsOnly = accountNumber.replace(/\D/g,'').substring(0, 20);
                return { accountNumber: accountNumberDigitsOnly, name: name };
            } else {
                var accountNumber = data.substring(data.indexOf(';') + 1, data.indexOf('=')).replace('/', ' ');
                var name = data.substring(data.indexOf(';') + 1, data.indexOf('=')).replace('/', ' '); // Replace '/' with space
                return { accountNumber: accountNumber, name: name };
            }
        }

        function displayParsedData(parsedData) {
            var formattedAccountNumber = parsedData.accountNumber;
            var formattedName = parsedData.name.replace(/\//g, ' '); // Replace '/' with space

            return {'account_number' : formattedAccountNumber,
                    'account_name' : formattedName};
        }

        var rawData = readMagneticStripeData();
        var parsedData = parseMagneticStripeData(rawData);
        var formattedOutput = displayParsedData(parsedData);
        $('#testCustomer').val(formattedOutput.account_name);


        function concatenateInputs() {
            var concatenatedValue = "";
            $('.threeCard input').each(function() {
                concatenatedValue += $(this).val();
            });
            return concatenatedValue;
        }

        var concatenatedValue = concatenateInputs();
        // $('#account_number_cc_d').val(concatenatedValue)
        $('#testCustomer').prop('hidden', false);
        $('#customer_name_payment').val(formattedOutput.account_name);
        $('#account_number_card').val(concatenatedValue)
        $('#customerNames').prop('hidden', true);
        $('#transactionRefs').focus();
      }
    }

    $('.ccnumber, .secondnumber, .thirdnumber, .fourthnumber, .fifthnumber,.sixthnumber,.seventhnumber,.eigthnumber,.ninthnumber,.tenthnumber,.eleventhnumber,.twelfthnumber,.thirteennumber,.fourteennumber,.fifteennumber,.lastnumber,#customerNames').keydown(function(e) {
        switch(e.which) {
            case 37: 
                $(this).prevAll('.ccnumber, .secondnumber, .thirdnumber, .fourthnumber,.fifthnumber,.sixthnumber,.seventhnumber,.eigthnumber,.ninthnumber,.tenthnumber,.eleventhnumber,.twelfthnumber,.thirteennumber,.fourteennumber,.fifteennumber,.lastnumber').first().focus();
                break;
            case 39: 
                $(this).nextAll('.ccnumber, .secondnumber, .thirdnumber, .fourthnumber,.fifthnumber,.sixthnumber,.seventhnumber,.eigthnumber,.ninthnumber,.tenthnumber,.eleventhnumber,.twelfthnumber,.thirteennumber,.fourteennumber,.fifteennumber,.lastnumber').first().focus();
                break;
            default: return; 
        }
        e.preventDefault(); 
    });
    var $inputs = $('#ccnumber16, #customerNames, #transactionRefs,.cancelCC');
      $inputs.keydown(function(e) {
          var index = $inputs.index(this),
              nextIndex = 0;
          switch(e.which) {
              case 38: 
                  nextIndex = (index > 0) ? index - 1 : 0;
                  break;
              case 40: 
                  nextIndex = (index < $inputs.length - 1) ? index + 1 : $inputs.length - 1;
                  break;
              default: return; 
          }
          
          $inputs.eq(nextIndex).focus();
          e.preventDefault(); 
});
     var $btns = $('.cancelCC,.resetCC,.submitCC');
        $btns.keydown(function(e){
          var index =  $btns.index(this),
              nextIndex = 0;
              switch(e.which) {
              case 37: 
                  nextIndex = (index > 0) ? index - 1 : 0;
                  break;
              case 39: 
                  nextIndex = (index <  $btns.length - 1) ? index + 1 :  $btns.length - 1;
                  break;
              default: return; 
          }
          $btns.eq(nextIndex).focus();
          e.preventDefault(); 
        })

  
  
    $('#customerNames').on('input', function(){
        const customerName = $(this).val(); 
        if (customerName) {
            $('#customerNameErrors').css('display', 'none'); 
        }
    });

    $('#cc_modal').keydown(function(e) {
        switch(e.which){
         case 13:
          if ($('#transactionRefs').val() != '') {
            console.log($('#transactionRefs').val())
            $('button[name="submitCC"]').click();
          }
         break;
          case 116:
          $('button[name="resetCC"]').click();  
          $('.ccnumber').focus()  
         break;
         break;
        default: return; 
        }
      e.preventDefault(); 
    });

    $('#cc_modal').keydown(function(e) {
        switch(e.which){
         case 27:
          $('button[name="ccClose"]').click();
          $('#ccCard').focus()      
         break;
        default: return; 
        }
      e.preventDefault(); 
    });


  $('button[name="submitCC"]').click(function() {
      $('.submitCC').css({
          'background-color': '#1E8449',
          'outline':'0',
          'border-color': '#1E8449'
      });
      setTimeout(function() {
        $('.submitCC').css({
            'background-color': '',
            'outline': '',
            'border-color': ''
        });
    }, 1000);
});

$('button[name="resetCC"]').click(function() {
      $('.resetCC').css({
          'outline':'0',
          'border-color': '#FF6900',
          'color': '#FF6900'
      });
      setTimeout(function() {
        $('.resetCC').css({
            'color': '',
            'outline': '',
            'border-color': ''
        });
    }, 1000);
});
    
});



function delayHide(input) {
    if (input.value.length > 0) {
        input.type = 'text';
        setTimeout(() => {
            input.type = 'password';
        },200); 
    }
}
function updateInputStyle(input) {
    if (input.value.length > 0) {
        input.classList.add('has-value');
        input.classList.remove('no-value');
    } else {
        input.classList.remove('has-value');
        input.classList.add('no-value');
    }
}

var validation = false;
function checkAllInputs() {
  const inputs = document.querySelectorAll('.threeCard input');
    let allHaveValues = true;
    inputs.forEach(input => {
        if (input.value.length === 0) {
            allHaveValues = false;
        }
    });
    inputs.forEach(input => {
        if (allHaveValues) {
           validation = true
           $('#optionErrors').css('display', 'none'); 
            input.classList.add('has-value');
            input.classList.remove('no-value');
        } else {  
            if (input.value.length === 0) {
                input.classList.add('no-value');
                input.classList.remove('has-value');
            } else {
                input.classList.add('has-value');
                input.classList.remove('no-value');
            }
        }
    });
}
function reset(){
  $('.ccnumber, .secondnumber, .thirdnumber, .fourthnumber, .fifthnumber, .sixthnumber, .seventhnumber, .eigthnumber, .ninthnumber, .tenthnumber, .eleventhnumber, .twelfthnumber, .thirteennumber, .fourteennumber, .fifteennumber, .lastnumber,#customerNames, #transactionRefs').val('').removeClass('has-value no-value');
  $('.resized-visa').hide();
  $('.resized-master').hide();
  $('.resized-discover').hide();
  $('.resized-american').hide();
  $('.resized-jcb').hide();
  $('.invalids').hide();
  $('.resized-tinker').show();  
  var text = '" "';
  $('.cardname').text(text); 
  $('.ccnumber').focus()
}

function cancel(){
  reset()
  $('#cc_modal').hide();
}


</script>