<style>
/* Ensure the full screen modal */
#modalCashPrint .modal {
    display: block; 
    position: fixed;
    z-index: 3000;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    
}

#modalCashPrint .modal-content {
    position: absolute; 
    top: 50%; 
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: Century Gothic;
    min-width: 200px; 
    max-width: 350px; 
    background-color: #262625; 
    border-radius: 0;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border: 1px solid #262625;
}


#modalCashPrint .modal-body {
    color: white;
    padding: 20px;
    display: flex; 
    justify-content: center; 
    align-items: center; 
    text-align: center; 
    height: 100px; 
}

#modalCashPrint .modal-footer {
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 10px;
    width: 100%;
    border-top: none;
}
#done-button {
    border: none;
    border-top: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: #4CAF50;
    border-radius: 0;
    outline: none;
    margin-right: 20px;
    width: 180px;
}

#done-button:hover {
    background-color: #218838; 
}
@keyframes colorChange {
    0%, 100% {
        color: white; 
    }
    50% {
        color: #FF6900; 
    }
}

#animated-text span {
    animation: colorChange 1s infinite; /* Apply the animation */
}

#animated-text span:nth-child(1) { animation-delay: 0.1s; }
#animated-text span:nth-child(2) { animation-delay: 0.2s; }
#animated-text span:nth-child(3) { animation-delay: 0.3s; }
#animated-text span:nth-child(4) { animation-delay: 0.4s; }
#animated-text span:nth-child(5) { animation-delay: 0.5s; }
#animated-text span:nth-child(6) { animation-delay: 0.6s; }
#animated-text span:nth-child(7) { animation-delay: 0.7s; }
#animated-text span:nth-child(8) { animation-delay: 0.8s; }
#animated-text span:nth-child(9) { animation-delay: 0.9s; }
#animated-text span:nth-child(10) { animation-delay: 1.0s;}
#animated-text span:nth-child(11) { animation-delay: 1.1s;}
#animated-text span:nth-child(12) { animation-delay: 1.2s;}

</style>

<div class="modal" id="modalCashPrint" tabindex="0" style="background-color: rgba(0, 0, 0, 0.3);">
        <div class="modal-content">
          <div class="modal-body">
          <p id="animated-text">
                <!-- Wrap each letter in a span -->
                <span>P</span><span>R</span><span>I</span><span>N</span><span>T</span><span>I</span><span>N</span><span>G</span>  <span>R</span><span>E</span><span>F</span><span>U</span><span>N</span><span>D</span><span>.</span><span>.</span><span>.</span>
            </p>
          </div>
         </div> 
         <div class="modal-footer">
            <button id="done-button" class="doneRefund">DONE</button>
      </div>
</div>
<script>
    $('.doneRefund').on('click', function(){
    if(isOpen == true){
        couponCreatedModal()
        $('#modalCashPrint').hide();
        $('#refund_modal').hide();
    }else{
   $('#modalCashPrint').hide();
   $('#refund_modal').hide();
   $('#modalCashPrint').hide(); 
     window.location.reload(); 
    }
})
</script>