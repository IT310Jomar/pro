<style>
/* Ensure the full screen modal */
#modalPrintCashCount .modal {
    display: block; 
    position: fixed;
    z-index: 3000;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    
}

#modalPrintCashCount .modal-content {
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


#modalPrintCashCount .modal-body {
    color: white;
    padding: 20px;
    display: flex; 
    justify-content: center; 
    align-items: center; 
    text-align: center; 
    height: 100px; 
}

#modalPrintCashCount .modal-footer {
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

<div class="modal" id="modalPrintCashCount" tabindex="0" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-dialog-centered" max-width="50%">
        <div class="modal-content">
            <div class="modal-body">
            <p id="animated-text">
                <!-- Wrap each letter in a span -->
                <span>P</span><span>R</span><span>I</span><span>N</span><span>G</span> <span>C</span><span>A</span><span>S</span><span>H</span> <span>C</span><span>O</span><span>U</span><span>N</span><span>T</span><span>.</span><span>.</span><span>.</span>
            </p>
            </div>
        </div>
    </div>   
</div>
<script>
 $('#done-button').on('click', function(){
    $('#modalPrintCashCount').hide();
 })
</script>


