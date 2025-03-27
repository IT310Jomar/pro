

<?php 



?>





<!-- Cash in Cash out -->

<div class="modal" id="cashInOut" tabindex="1" style="background-color: rgba(0, 0, 0, 0.9)">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="max-height: 50%;">
    <div class="modal-content" style="font-size: small">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    
                    <h4>
                    CASH-IN / CASH-OUT <span class="user_name" style="color: #FF6700" ></span></h4>
                    <button type="button" class="payment_btn btn btn-secondary shadow-none closeCashInBtn" style="width: auto; margin-left: 10px; margin-top: -10px"  ><i class="fa fa-close"></i></button>
                </div>
            </div>
           
            <div class="row cash_in_cash_out">
               
                <!-- <div class="col-lg-12 d-block input_amount">
                    <input require type="number" autocomplete="false" class="w-100 cash_amount" autofocus placeholder="0.00">
                    <textarea require class="w-100 text_reason" placeholder="Reason...." name="reason_note" id="reason_note" cols="20" rows="10"></textarea>
                </div> -->
                <div class="col-lg-12 d-flex options-cash-in-out">
                    <button class="btn btn-secondary cash_in" value="0" style="margin-right: 30px">(+) ADD CASH</button>
                    <button class="btn btn-secondary cash_out" value="1">(-) REMOVE CASH</button>
                    
                </div>
                <input type="number" hidden class="w-100 cashType_selected" >
                <div class="col-12 cashInContainer">
                    <!-- in JS -->
                </div>

                <div class="d-flex buttonsSubmitCancel">
                    
                </div>

            </div>
      </div>
    </div>
  </div>
</div>

<script>
 var existingDataInOut = [];
    function getCashInCashOutHistory() {
        var user_id = $('#user_id').val()
        axios.post('api.php?action=getCashInHistory', {
            'cashierId' : user_id
        })
        .then(function(response) {
            // console.log(response.data.data)
            var cashInOutHistory = response.data.data
            var startingIndex = response.data.data.length;
            cashInOutHistory.sort(function(a, b) {
                return new Date(b.date) - new Date(a.date);
            });
           
            $.each(cashInOutHistory, function(index, InOut) {
                var descendingIndex = startingIndex - index;
                if(existingDataInOut.indexOf(InOut.id) === -1 ) {
                    existingDataInOut.push(InOut.id);
                    var row = '<tr class="selectable-InOut-row"' +
                    '>' +
                    '<td >' + (descendingIndex) +'</td>';
                        if(InOut.cashType == 1) {
                            row += '<td colspan="2">' +
                            '<svg class="svg_icon_out" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">' +
                                '<path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>' +
                            '</svg>' +
                            'CASH OUT' +
                            '</td>' +
                            '<td>' + (addCommas(parseFloat(InOut.cash_out_amount).toFixed(2))) + '</td>';
                        } else {
                            row += '<td colspan="2">' +
                            '<svg class="svg_icon_in" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">' +
                                '<path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>' +
                            '</svg>' +
                            'CASH IN' + '</td>' +
                            '<td>' + (addCommas(parseFloat(InOut.cash_in_amount).toFixed(2))) + '</td>' ;
                        }

                        row += '<td colspan="1">' + (dateAndTimeFormat(InOut.date).formatted_date + ' | ' + dateAndTimeFormat(InOut.date).formatted_time) + '</td>' +
                        '<td colspan="2" style="height: auto;">' + InOut.reason_note + '</td>';

                    row += '</tr>';
                    $('.cashInOutHistoryTable tbody').append(row);
                }
            })

        })
        .catch(function(error) {
            console.log(error)
        })

        $('.closeCashInBtn').click(function() {
            $('#cashInOut').hide();
        })
    }

    $(document).ready(function() {
       
       
        
    });

    
</script>


<style>

/* .cashInOutHistoryTable td {

    vertical-align: top; 
    padding: 8px; 
    white-space: normal; 
    min-width: 100px; 
    word-wrap: break-word; 
} */


.enabled {
    background-color: green; 
}

.buttonsSubmitCancel button{
    font-size: small;
    width: auto;
   
    color: #fff;
    border: 1px solid #4B413E;
    border-radius: 0;
    outline: none;
}

div.d-flex.buttonsSubmitCancel {
    justify-content: right;
}

.cashInOutForm {
    margin-top: 20px;
}
.options-cash-in-out button.selected {
    background-color: #ff6700;
    
}

.svg_icon_danger {
    hei
}

.selectable-InOut-row td {
    padding: 0;
    font-style: italic;
}

.svg_icon_out {
    color: red;
    margin-right: 5px;
}

.svg_icon_in {
    color: green;
    margin-right: 5px;
}

.cashInOutHistoryTable {
    height: auto;
    width: 100%
}


.cashInContainer {
    top: 0;
    height: 160px;
    border: 1px solid #4B413E;
    margin-bottom: 10px;
    overflow-y: auto;
    scrollbar-width: 0; 
    scrollbar-color: transparent;
}


.cashInContainer::-webkit-scrollbar {
    width: 0;
}

.cashInContainer::-webkit-scrollbar-thumb {
    background-color: transparent;
}

.col-lg-12.d-flex.options-cash-in-out {

    height: 50px;
    padding-right: 0;
    padding-left: 0;
    margin-bottom: 10px;
}

.cash_in_cash_out {
    height: auto;
    border: 1px solid #4B413E;
    padding: 10px;
    background: transparent;
    margin: 5px;
}

.options-cash-in-out button {
    width: 190px;
    height: 50px;
    border: 1px solid #4B413E;
    border-radius: 0;
    background: #262626;
    font-weight: bold;
   
}


.options-cash-in-out {
    justify-content: center;
}

.input_amount input{
    border: 1px solid #4B413E;
    border-radius: 0;
    background: #262626;
    font-size: small;
    padding: 10px;
    margin-bottom: 10px;
}


.input_amount textarea{
    color: #fff;
    padding: 10px;
    font-size: small;
    outline: 0;
    border: 1px solid #4B413E;
    border-radius: 0;
    background: #262626;
    height: 50px;
    margin-bottom: 10px;
}




</style>