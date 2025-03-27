
<?php 



?>

<div class="modal" id="cashCountModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 70%; max-height: 80%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        <div class="d-flex">
            <h3 class="headTitle">
                <span>
                  <svg class="svgIconShare" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="#FF6700" d="M400 255.4V240 208c0-8.8-7.2-16-16-16H352 336 289.5c-50.9 0-93.9 33.5-108.3 79.6c-3.3-9.4-5.2-19.8-5.2-31.6c0-61.9 50.1-112 112-112h48 16 32c8.8 0 16-7.2 16-16V80 64.6L506 160 400 255.4zM336 240h16v48c0 17.7 14.3 32 32 32h3.7c7.9 0 15.5-2.9 21.4-8.2l139-125.1c7.6-6.8 11.9-16.5 11.9-26.7s-4.3-19.9-11.9-26.7L409.9 8.9C403.5 3.2 395.3 0 386.7 0C367.5 0 352 15.5 352 34.7V80H336 304 288c-88.4 0-160 71.6-160 160c0 60.4 34.6 99.1 63.9 120.9c5.9 4.4 11.5 8.1 16.7 11.2c4.4 2.7 8.5 4.9 11.9 6.6c3.4 1.7 6.2 3 8.2 3.9c2.2 1 4.6 1.4 7.1 1.4h2.5c9.8 0 17.8-8 17.8-17.8c0-7.8-5.3-14.7-11.6-19.5l0 0c-.4-.3-.7-.5-1.1-.8c-1.7-1.1-3.4-2.5-5-4.1c-.8-.8-1.7-1.6-2.5-2.6s-1.6-1.9-2.4-2.9c-1.8-2.5-3.5-5.3-5-8.5c-2.6-6-4.3-13.3-4.3-22.4c0-36.1 29.3-65.5 65.5-65.5H304h32zM72 32C32.2 32 0 64.2 0 104V440c0 39.8 32.2 72 72 72H408c39.8 0 72-32.2 72-72V376c0-13.3-10.7-24-24-24s-24 10.7-24 24v64c0 13.3-10.7 24-24 24H72c-13.3 0-24-10.7-24-24V104c0-13.3 10.7-24 24-24h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H72z"/></svg>
                </span>
            
                SUBMIT CASH-COUNT <span class="spanCurrentDate">[Saturday Feb 5, 2024 | 04:53 PM]</span> <span id="cashCountCurTime"></span> </h3>
              <div class="ml-auto"> 
                <button class="btn btn-secondary shadow-none primary_button_style" onclick="closeModal('#cashCountModal')"><i class="fa fa-times"></i></button>
            </div>
        </div>
       
        <div class="row cashCountButton">
          <div class="d-flex justify-content-start">
            <input style="width: 885px; font-style: italic; float: left" type="text" placeholder="SEARCH CODE / NAME / SERIAL NO." class="shadow-none input_search_count_cash">
            <input style="width: 220px; " type="text" placeholder="Select a date..." class="shadow-none input_date_rage">
            <button style="background: #FF6700" class="btn btn-secondary btn_search">SEARCH</button>
            <button style="background: #00B050" class="btn btn-secondary btn_new_cash_count">[+] NEW</button>
          </div>

          <div class="cash_count_container" >
            <table class="cash_count_table table table-borderless m-0 text-light ">
                <thead>
                  <tr style="border: 1px solid #FF6700; color: #FF6700">
                    <td colspan="2">DATE/TIME</td>
                    <td colspan="2">CASHIER NAME</td>
                    <td colspan="2">SALES</td>
                    <td colspan="2">COUNTED</td>
                    <td colspan="2">DIFFERENCE</td>
                  </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
          </div>

          <hr>
          <div class="d-flex">
            <button onclick="closeModal('#cashCountModal')" class="primary_button_style btn btn-secondary"><span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
            </span>
            CANCEL</button>
            <button id="reprint_cash_count" class="primary_button_style btn btn-secondary"> <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
              <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
              <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
            </svg>
            </span> REPRINT CASH COUNT</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>


function closeModal(modal) {
  $(modal).hide();
  window.location.reload();
}

$(document).ready(function() {

  $('.closeBtnEndOfDay').click(function() {
    $('#denominationModal').hide();
    $('#cashCountModal').show();
  })

  $('.btn_new_cash_count').click(function () {
    $('#cashCountModal').hide();
    $('#denominationModal').show();
  })


  $('#reprint_cash_count').click(function() {
    var cashCountId = $('.cash_count-row.selected').data('cashcountid');
    axios.post('api.php?action=getSpecificCashCount', {
      'cashCountId' : cashCountId,
    })
    .then(function(response) {
      var arrayList = { data: response.data.data };
      $.ajax({
          url: './reprint_cash_count.php',
          type: 'GET',
          data: arrayList,
          success: function(data) {
            // console.log('hello')
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
    })
    .catch(function(error) {
      console.log(error)
    })
    
  })

})

</script>


<style>

#cashCountCurTime {
  color: #FF6700
}

.cashCountButton input {
    border: none;
    margin-right: 10px;
    border-radius: 0;
    background: transparent;
    border: 1px solid #4B413E; 
    color: #fff;
    font-size: small;
    width: auto;
}


.cashCountButton button {
  border: 1px solid #4B413E;
  width: auto;
  border-radius: 0;
  background: #262626;
  margin-right: 10px;
  font-size: small;
}

.cash_count_container {   
  justify-content: center; 
  align-items: center;
  height: 600px;
  scrollbar-color: transparent;
  overflow-y: auto;
  scrollbar-width: 0; 
  padding: 20px; 
}


.cash_count_container::-webkit-scrollbar {
  width: 0;
}

.cash_count_container::-webkit-scrollbar-thumb {
  background-color: transparent;
}

</style>
