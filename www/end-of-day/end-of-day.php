<?php 



?>



<div class="modal" id="endOfDayModal" tabindex="1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 70%; max-height: 80%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
        
        <div class="d-flex">
            <h3 class="headTitle">
             
                <span>
                  <svg class="svgIconShare" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="#FF6700" d="M400 255.4V240 208c0-8.8-7.2-16-16-16H352 336 289.5c-50.9 0-93.9 33.5-108.3 79.6c-3.3-9.4-5.2-19.8-5.2-31.6c0-61.9 50.1-112 112-112h48 16 32c8.8 0 16-7.2 16-16V80 64.6L506 160 400 255.4zM336 240h16v48c0 17.7 14.3 32 32 32h3.7c7.9 0 15.5-2.9 21.4-8.2l139-125.1c7.6-6.8 11.9-16.5 11.9-26.7s-4.3-19.9-11.9-26.7L409.9 8.9C403.5 3.2 395.3 0 386.7 0C367.5 0 352 15.5 352 34.7V80H336 304 288c-88.4 0-160 71.6-160 160c0 60.4 34.6 99.1 63.9 120.9c5.9 4.4 11.5 8.1 16.7 11.2c4.4 2.7 8.5 4.9 11.9 6.6c3.4 1.7 6.2 3 8.2 3.9c2.2 1 4.6 1.4 7.1 1.4h2.5c9.8 0 17.8-8 17.8-17.8c0-7.8-5.3-14.7-11.6-19.5l0 0c-.4-.3-.7-.5-1.1-.8c-1.7-1.1-3.4-2.5-5-4.1c-.8-.8-1.7-1.6-2.5-2.6s-1.6-1.9-2.4-2.9c-1.8-2.5-3.5-5.3-5-8.5c-2.6-6-4.3-13.3-4.3-22.4c0-36.1 29.3-65.5 65.5-65.5H304h32zM72 32C32.2 32 0 64.2 0 104V440c0 39.8 32.2 72 72 72H408c39.8 0 72-32.2 72-72V376c0-13.3-10.7-24-24-24s-24 10.7-24 24v64c0 13.3-10.7 24-24 24H72c-13.3 0-24-10.7-24-24V104c0-13.3 10.7-24 24-24h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H72z"/></svg>
                </span>
            
                END OF DAY <span class="spanCurrentDate">[Saturday Feb 5, 2024 | 04:53 PM]</span> <span id="currentTimeEnd"></span> </h3>
            <div class="ml-auto"> 
                <button class="btn btn-secondary shadow-none primary_button_style" onclick="closeModal('#endOfDayModal')"><i class="fa fa-times"></i></button>
            </div>
        </div>
       

        <div class="row endOfDayContent">
           <div class="d-flex justify-content-start">
              <input style="width: 885px; font-style: italic; float: left" type="text" placeholder="SEARCH CODE / NAME / SERIAL NO." class=" shadow-none input_search_end_day">
              <input style="width: 220px; " type="text" placeholder="Select a date..." class="shadow-none input_date_rage">
              <button style="background: #FF6700" class="btn btn-secondary btn_search">SEARCH</button>
              <button style="background: #00B050" class="btn btn-secondary btn_new">[+] NEW</button>
           </div>


         <div class="end_of_day_container" >
            <table class="end_of_day_table table table-borderless m-0 text-light ">
                <thead>
                  <tr style="border: 1px solid #FF6700; color: #FF6700">
                    <td colspan="2">REF #</td>
                    <td colspan="2">DATE & TIME</td>
                    <td colspan="2">NAME</td>
                    <td colspan="2">TOTAL SALES</td>
                    <td colspan="2">GRAND TOTAL</td>
                  </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
         </div>

         <hr>
         <div class="d-flex">
            <button onclick="closeModal('#endOfDayModal')" class="primary_button_style btn btn-secondary"><span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
            </span>
            CANCEL</button>
            <button id="reprint_zread" class="primary_button_style btn btn-secondary"> <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
              <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
              <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
            </svg>
            </span> REPRINT Z-READ</button>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="chooseReportModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
          
        <div class="d-flex">
            <h5>CHOOSE YOUR OPTION</h5>
            <button style="margin-top: -10px" class="btn btn-secondary shadow-none primary_button_style closeBtnOption"><i class="fa fa-times"></i></button>
        </div>

        <div class="row optioContent">
            <div class="col-12 d-flex print_report_container">
                <label for="">PRINT ITEMS REPORT</label>
                <label class="switch" style="margin-top: 5px; font-size: small; float: right">
                  <input type="checkbox" id="taxExempt_button">
                  <span class="slider"></span>
                </label>
            </div>

            <div class="col-6 ps-0" style="height: auto;">
              <div class="justify-content-center p-0">
                <div class="text-center x-reading current_user">
                    <button class="btn btn-secondary primary_button_style" id="x_current_user">X-READING <br><span style="font-size: small">CURRENT USER</span></button>
                </div>

                <div class="text-center x-reading all_user">
                  <button class="btn btn-secondary  primary_button_style" id="x_all_user">X-READING <br><span style="font-size: small">ALL USERS</span></button>
                </div>
              </div>
            </div>


            <div class="col-6 pe-0" style="height: auto;">
              <div class="text-center z-reading">
                <button class="btn btn-secondary primary_button_style z_reading">Z-READING <br><span style="font-size: small">CLOSING THE STORE</span></button>
              </div>
            </div>
        </div>

        <div class="d-flex">
          <button class="primary_button_style btn btn-secondary " style="margin-left: 10px">CANCEL</button>
          <button class="primary_button_style btn btn-secondary me-2 btn_continue_report">CONTINUE</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="allertMessageModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5)">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 30%;">
    <div class="modal-content">
      <div class="modal-body" style="background: #262626; color: #ffff; border-radius: 0;">
          
        <div class="d-flex">
            <h4 style="font-weight: bold"><span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
            </span> ATTENTION REQUIRED!</h4>
            <button style="margin-top: -10px;" class="btn btn-secondary shadow-none primary_button_style closeWarningBtn"><i class="fa fa-times"></i></button>
        </div>

        <div class="messageBox text-center">
            <!-- <h4>NO BILL/s ENTERED</h4> <br> -->
            <h2> Would you like to cash count first?</h2>
            <!-- <p style="font-size: large">Are you sure you want to exit <span style="color: #FF6700; font-weight: bold">Cash Count</span> report?</p> -->
        </div>

        <div class="d-flex warning_btn">
            <button class="primary_button_style no_message_btn btn btn-secondary">NO</button>
            <button class="primary_button_style yes_message_btn btn btn-secondary">YES</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>


function toGetXReadingReport () {
  axios.get('api.php?action=getAlluserXeading')
  .then(function(response) {
    var cashier_list = response.data.res1
    var tendered = response.data.res2
  })
  .catch(function(error) {
    console.log(error)
  })
}

var curTime;
$(document).ready(function() {
  $('#reprint_zread').click(function() {
    // toPrintOrRecordZreading();
    var reference_num = $('.z_reading-row.selected').data('zreference');
    axios.post('api.php?action=getSpecificZreading', {
      'ref_num' : reference_num,
    })
    .then(function(response) {
      // var prev_z_read_data = JSON.parse()
      // var jsonData = JSON.stringify(response.data.data.all_data);
      $.ajax({
          url: './z-reading.php',
          type: 'GET',
          data: { 
            returData: response.data.data.all_data
           },
          success: function(data) {
            $('#zread_printing').show();
            function reprintZread() {
              console.log('Printing')
            }
            var reprintZ = setInterval(reprintZread, 1000);
            setTimeout(function() {
              clearInterval(reprintZ);
              window.location.reload();
            }, 2000);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
      });
    })
    .catch(function(error) {
      console.log(error);
    })
    
  })

  $(".input_date_rage").flatpickr({
      mode: "range",
      dateFormat: "m-d-Y",
      altInput: true,
      altFomart: "M j, Y",
  });

    $('#x_current_user').click(function() {
      $('.current_user').css('border', '1px solid #00B050');
      $('.all_user').css('border', '1px solid #4B413E');
      $('.z-reading').css('border', '1px solid #4B413E');

      $('#x_current_user').addClass('selected_data')
      $('#x_all_user').removeClass('selected_data')
      $('.z_reading').removeClass('selected_data')
      
      $('.btn_continue_report').css('background', '#00B050')
    });

    $('#x_all_user').click(function() {
        $('.all_user').css('border', '1px solid #00B050');
        $('.current_user').css('border', '1px solid #4B413E');
        $('.z-reading').css('border', '1px solid #4B413E');


        $('#x_current_user').removeClass('selected_data')
        $('#x_all_user').addClass('selected_data')
        $('.z_reading').removeClass('selected_data')

        $('.btn_continue_report').css('background', '#00B050')
    });

    $('.z-reading').click(function() {
        $('.z-reading').css('border', '1px solid #00B050');
        $('.current_user').css('border', '1px solid #4B413E');
        $('.all_user').css('border', '1px solid #4B413E');

        $('#x_current_user').removeClass('selected_data')
        $('#x_all_user').removeClass('selected_data')
        $('.z_reading').addClass('selected_data')

        $('.btn_continue_report').css('background', '#00B050')
    });

    $('.spanCurrentDate').text('[' + dateAndTimeFormat(currentDate()).formatted_date + ' | ')

    // $('.closeBtnEndOfDay').click(function() {
    //   $('#endOfDayModal').hide();
    // })

    $('.btn_new').click(function() {
      $('#chooseReportModal').show();
    })

    $('.closeBtnOption').click(function() {
      $('#chooseReportModal').hide();
    })

    var checkedPrint = 0
    $('#taxExempt_button').change(function() {
        if ($(this).prop('checked')) { 
          checkedPrint = 1
          console.log(checkedPrint)
        } else {
          checkedPrint = 0
          console.log(checkedPrint)
        }
    });


    $('.btn_continue_report').click(function () {

      if ($('.z_reading').hasClass('selected_data')) {
        $('#chooseReportModal').hide();
        $('#allertMessageModal').show();
      } else if ($('#x_all_user').hasClass('selected_data')) {
        $('#chooseReportModal').hide();
        $('#endOfDayModal').hide();
        $('#zread_printing').show();
        $('#reportType').text('X');
        toGetXReadingReport();
      } else {
        $('#chooseReportModal').hide();
        $('#endOfDayModal').hide();
        $('#zread_printing').show();
        $('#reportType').text('X')
      }

      $('.closeWarningBtn, .no_message_btn').click(function() {
        $('#allertMessageModal').hide();

        function toPrinterFirst() {
          $('#zread_printing').show();
        }
        toPrintOrRecordZreading();
        var printInterval = setInterval(toPrinterFirst, 500)
        setTimeout(function () {
          clearInterval(printInterval);
        }, 2000)

      })

      // To Record Z-reading (Go to denomination.php file)
      $('.yes_message_btn').click(function() {
        $('#endOfDayModal').hide();
        var s_order_len = $('#saveQty').text();
        if ($('#x_current_user').hasClass('selected_data')) {
          $('#allertMessageModal').hide();
          $('.report_type').val(1)
          $('#denominationModal').show();
        } else if ($('#x_all_user').hasClass('selected_data')) {
          $('#allertMessageModal').hide();
          $('.report_type').val(2)
          $('#denominationModal').show();
        } else if (s_order_len > 0) {
          $('#allertMessageModal').hide();
          modifiedMessageAlert('error', 'You have to clear first the save order', false, false)
        } else {
          $('#allertMessageModal').hide();
          $('.report_type').val(3)
          $('#denominationModal').show();
        }
      })
    })
})

</script>



<style>


  .messageBox {
    height: 100px;
    border: 1px solid #4B413E;
    border-radius: 0;
    background: transparent;
    padding: 10px
  }

  .messageBox h2 {
    font-weight: bold;
  }

  .input_date_rage {
    margin-top: 10px;
  }
  .z-reading {
    border: 1px solid #4B413E;
    height: auto;
    margin-top: 10px;
    
  }


  .z-reading button{
    width: 100%;
    height: 133px;
    border: none;
    background: transparent;
    margin: 0;
   }

  .x-reading {
    border: 1px solid #4B413E;
    height: auto;
    margin-top: 10px;
  }

  .x-reading button{
    width: 100%;
    height: 100%;
    border: none;
    background: transparent;
    margin: 0;
  }

  .print_report_container {
    border: 1px solid #4B413E;
    background: transparent;
    height: 50px;
    padding: 10px;
    width: 100%;
  }

  .optioContent {
    border: 1px solid #4B413E;
    height: 250px;
    background: transparent;
    margin: 10px;
    padding: 30px;
    justify-content: center;
    align-items: flex-start;
  }

    .spanCurrentDate {
      color: #FF6700
    }

    #currentTimeEnd {
      color: #FF6700
    }
    .end_of_day_container {
      
      justify-content: center; 
      align-items: center;
      height: 600px;
      scrollbar-color: transparent;
      overflow-y: auto;
      scrollbar-width: 0; 
      padding: 20px;
     
    }


    .end_of_day_container::-webkit-scrollbar {
        width: 0;
    }

    .end_of_day_container::-webkit-scrollbar-thumb {
        background-color: transparent;
    }

    .primary_button_style {
      border: 1px solid #4B413E;
      width: auto;
      border-radius: 0;
      background: #262626;
      /* margin-right: 10px; */
    }

    .spanDateRange {
        color: #FF6700;
    }

    .svgIconShare {
      color: #FF6700;
      height: 32px;
      margin-top: -5px;
    }


    .endOfDayContent input {
      border: none;
      margin-right: 10px;
      border-radius: 0;
      background: transparent;
      border: 1px solid #4B413E; 
      color: #fff;
      font-size: small;
      width: auto;
    }


    .endOfDayContent button {
      border: 1px solid #4B413E;
      width: auto;
      border-radius: 0;
      background: #262626;
      margin-right: 10px;
      font-size: small;
    }
</style>