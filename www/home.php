<?php

include (__DIR__ . '/layout/header.php');
include (__DIR__ . '/utils/db/connector.php');
include (__DIR__ . '/utils/models/global-facade.php');
include (__DIR__ . '/utils/models/series-facade.php');
include (__DIR__ . '/utils/models/transaction-facade.php');
include (__DIR__ . '/utils/models/withdraw-facade.php');
include (__DIR__ . '/utils/models/product-facade.php');
include (__DIR__ . '/utils/models/auth-facade.php');
include (__DIR__ . '/utils/models/users-facade.php');

$globalFacade = new GlobalFacade;
$seriesFacade = new SeriesFacade;
$transactionFacade = new TransactionFacade;
$withdrawFacade = new WithdrawFacade;
$productFacade = new ProductFacade;

$isTransact = 0;

if (isset ($_SESSION["user_id"])) {
  $userId = $_SESSION["user_id"];
}

if (isset ($_GET["is_transact"])) {
  $isTransact = $_GET["is_transact"];
}

if (isset ($_GET["first_name"])) {
  $firstName = $_GET["first_name"];
}

if (isset ($_GET["user_id"])) {
  $userID = $_GET["user_id"];
}

if (isset ($_GET["last_name"])) {
  $lastName = $_GET["last_name"];
}

// Transact payment for cash
if (isset ($_POST["transact"])) {
  $amount = $_POST["amount"];
  $total = $_POST["total"];

  if ($amount >= $total) {
    $change = $amount - $total;
    ?>

    <!-- Transaction info modal -->
    <div class="modal" id="changeModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-custom-dark">
            <h5 class="modal-title text-white">Transaction Infos</h5>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="d-flex justify-content-between">
                <div class="w-100">
                  <h4 class="float-start">Amount:</h4>
                  <h4 class="money-font text-end pt-1">&#8369;
                    <?= number_format($amount, 2) ?>
                  </h4>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <div class="w-100">
                  <h4 class="float-start">Total:</h4>

                  <h4 class="money-font text-end pt-1">&#8369;
                    <?= number_format($total, 2) ?>
                  </h4>
                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-between">
                <div class="w-100">
                  <h1 class="text-warning money-font float-start">Change:</h1>
                  <h1 class="text-warning money-font float-end">&#8369;
                    <?= number_format($change, 2) ?>
                  </h1>
                </div>
              </div>
              <!-- Hidden values -->
              <input type="hidden" name="amount" value="<?= $amount ?>">
              <input name="total" value="<?= $total ?>">
              <input type="hidden" name="change" value="<?= $change ?>">
              <input type="text" name="transaction_num">
              <!-- <button type="submit" class="d-none" id="saveTransactionPayCash" name="save_transaction_pay_cash"></button> -->
            </form>
            <div class="modal-footer">
              <p class="lead text-end">[ENTER] - PRINT RECEIPT</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php }
}

// Process pay later transactions
if (isset ($_POST["process"])) {
  $total = $_POST["total"];
  $payer = $_POST["payer"];

  if (!empty ($payer)) {
    ?>

    <!-- Transaction info modal -->
    <div class="modal" id="payLaterInfoModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-custom-dark">
            <h5 class="modal-title text-white">Transaction Info</h5>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="d-flex justify-content-between">
                <div class="w-100">
                  <h4 class="float-start">Total:</h4>
                  <h4 class="money-font text-end pt-1">&#8369;
                    <?= number_format($total, 2) ?>
                  </h4>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <div class="w-100">
                  <h4 class="float-start">Payer:</h4>
                  <h4 class="money-font text-end pt-1">
                    <?= $payer ?>
                  </h4>
                </div>
              </div>
              <!-- Hidden values -->
              <input type="hidden" name="total" value="<?= $total ?>">
              <input type="hidden" name="payer" value="<?= $payer ?>">
              <?php
              $getLatestSeries = $seriesFacade->getLatestSeries();
              foreach ($getLatestSeries as $series) { ?>
                <input type="hidden" name="transaction_num" value="<?= date('mdy') . $series['series'] ?>">
              <?php } ?>
              <button type="submit" class="d-none" id="saveTransactionPayLater" name="save_transaction_pay_later"></button>
            </form>
            <div class="modal-footer">
              <p class="lead text-end">[ENTER] - PRINT RECEIPT</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php }
}


if (isset ($_POST["discount_button"])) {
  $transac_num = $_POST["transac_num"];
  $discount_type = $_POST["discountType"];
  $dicount_amount = $_POST["itemDiscount"];
  $sub = $_POST["discount_item_sub"];
  $transan_id = $_POST["discount_item_id"];
  $discountTransac = $transactionFacade->updateTransaction($transan_id, $transac_num, $sub, $discount_type, $dicount_amount);
}

if (isset ($_POST["cartSbtn"])) {
  $transac_num = $_POST["transac_cart_num"];
  $discount_type = $_POST["discounCartType"];
  $discount_amount = $_POST["cartDiscount"];
  $cartSub = $_POST["discount_cart_sub"];
  $discountCart = $transactionFacade->updateTransaCartDis($transac_num, $cartSub, $discount_type, $discount_amount);
}


?>
<section style="height: 100%">
  <div class="row">
    <div class="col-lg-9" style="margin: 0; padding: 0">
      <div class="pos-barcode pt-2 pb-1" style="background-color: #333333">
        <div class="container-fluid ps-lg-3 pe-0">

          <div class="mx-2 p-2 d-flex align-items-baseline" style="height: baseline">
            <div class="me-2">
              <input type="number" hidden id="qty" class="form-control" placeholder="Qty" min="1" value="1">
            </div>
            <div style="position: relative; width: 100%;" class="d-flex">
              <div style="margin-right: 10px; color:#ffff;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ffff" class="bi bi-upc-scan"
                  viewBox="0 0 16 16">
                  <path
                    d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
                </svg>
              </div>
              <input type="text" autocomplete="false" class="w-100 search_input" id="search-input" autocomplete="false"
                placeholder="SEARCH CODE / NAME / SERIAL NO.">
              <div id="search-results"></div>
            </div>
            <!-- <input type="number" id="barcode" class="form-control w-100" placeholder="Barcode" autofocus> -->
            <button type="submit" class="primary_button_style primary-color-btn s_btn_product">Search</button>
            <input type="text" hidden id="firstName" value="<?= $firstName ?>">
            <input type="text" hidden id="lastName" value="<?= $lastName ?>">
            <input type="text" hidden id="user_id" value="<?= $userID ?>">
            <input type="number" hidden id="vat_Sales">
            <input type="number" hidden id="customer_id">
            <input type="number" hidden id="customer_discount">
            <input type="text" hidden id="fNamecustomer">
            <input type="text" hidden id="customerDisType">
            <input type="text" hidden id="transactionNum">
            <input type="number" hidden id="savedProduct" value="0">
            <input type="number" hidden value="0.00" id="coupon_val_to_add">
            <input type="number" hidden value="0.00" id="coupon_val_to_return">
          </div>
        </div>

        <div class="pos-transaction-body">
          <div class="pos-transaction">
            <div class="mx-2 ps-lg-3 pb-0 pe-0 me-0 ">
              <table class="table table-borderless m-0 text-light table_headers" id="theads">
                <thead>
                  <tr style="border: 1px solid #FF6700; color: #FF6700">
                    <th class="col-2">CODE #.</th>
                    <th class="col-6">ITEM/DESCRIPTION</th>
                    <th class="col-1">QTY.</th>
                    <th class="col-1">PRICE</th>
                    <th class="col-2">TOTAL</th>
                  </tr>
                </thead>
              </table>

              <div class="table-container" style="background: #33333">
                <table class="table table-borderless m-0 text-light" id="tableTransactions">
                  <tbody id="tbody-cashiering">
                    <!-- In JS -->
                  </tbody>
                </table>
              </div>

              <div class="table-container-total ">
                <table id="totalReport" class="table table-borderless mb-0"
                  style="width: 100%; height: 100%; background: #262626; border: 1px solid #FF6700; color: #FF6700;">

                  <tr style="width: 100%;">
                    <td style="padding-left: 10px" class="col-2"><i>Amount</i></td>
                    <td class="col-6"></td>
                    <td class="col-1" style="padding-left: 15px"><span id="totalQ"></span></td>
                    <td class="col-1"></td>
                    <td class="col-2" style="padding-left: 15px; ">&#8369; <s><span id="total">0.00</span></s></td>
                  </tr>
                  <tr>
                    <td style="padding-left: 10px" class="col-2"><i>Discount</i></td>
                    <td class="col-6"></td>
                    <td class="col-1" style="padding-left: 15px"></td>
                    <td class="col-1"></td>
                    <td class="col-2" style="padding-left: 15px; ">&#8369; <span id="totalD">0.00</span></td>
                  </tr>
                  <tr>
                    <td style="padding-left: 10px" class="col-2"><i>VAT</i></td>
                    <td class="col-6"></td>
                    <td class="col-1" style="padding-left: 15px"></td>
                    <td class="col-1"></td>
                    <td class="col-2" style="padding-left: 15px; ">&#8369; <span id="vatAmount">0.00</span></td>
                  </tr>
                  <tr style="width: 100%">
                    <td class="col-2" style="font-weight: bold; padding-left: 10px; color: #fff">Total</td>
                    <td class="col-6"></td>
                    <td class="col-1" style="padding-left: 15px"></td>
                    <td class="col-1"></td>
                    <td class="col-2" style="padding-left: 15px; color: #fff; font-weight: bold">&#8369; <span
                        id="totalPayment" class="totalPayment">0.00</span></td>
                  </tr>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3" style="margin: 0; padding-right: 10px; padding-left: 0;">
      <div class="row m-0">
        <div>
          <div style="background-color: #333333">
            <div class="text-center" style="display: flex; align-items: center; justify-content: center; ">
              <div class="image-container" style="height: auto;">
                <img src="assets/img/tinkerpro-logo-light.png" alt="logo" class="text-center image_logo">
              </div>
            </div>
          </div>
          <table class="table_buttons">
            <tbody>
              <tr>
                <td class="full-height-table" style="position: relative;">
                  <button id="qunatityModalButton" class="w-100 bg-custom-dark"
                    style="border-radius: 0; border: none; color: #FF6700 !important;">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <div style="margin: 3px" id="divQty" class="text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="23" width="23"
                          viewBox="0 0 448 512">
                          <path
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                        </svg>
                      </div>
                      <small class="text-light text-center lh-1">Quantity.<br>[F4]</small>
                      <div
                        style="font-size: large; position: absolute; top: 5; right: 0; height: auto; width: auto; color: #FF6700; padding: 2px 5px;">
                        <span id="defQty">1</span></div>
                    </div>
                  </button>
                </td>

                <td class="full-height-table" colspan="2">
                  <button id="paymentModalButton" class="w-100 bg-custom-dark" style="border-radius: 0; border: none;">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#f3f3f3"
                        class="bi bi-credit-card m-1" viewBox="0 0 16 16">
                        <path
                          d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                        <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
                      </svg>
                      <small class="text-light text-center text-light lh-1">PAYMENT<br>[F5]</small>
                      <div
                        style="font-size: large; position: absolute; top: 5; right: 0; height: auto; width: auto; padding: 2px 5px;">
                        <span id="coupon_use_text" class="text-success"></span></div>
                    </div>
                  </button>
                </td>
              </tr>

              <tr>
                <td class="full-height-table">
                  <button id="deleteModalButton" class="w-100 bg-custom-dark" style="border-radius: 0; border: none">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#f3f3f3"
                        class="bi bi-trash3 m-1" viewBox="0 0 16 16">
                        <path
                          d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                      </svg>
                      <small class="text-light text-center text-light lh-1">DELETE<br>[Del]</small>
                    </div>
                  </button>
                </td>

                <td class="full-height-table" colspan="2">
                  <button id="voidModalButton" class="w-100 bg-custom-dark" style="border-radius: 0; border: none">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#f3f3f3"
                        class="bi bi-file-earmark-x m-1" viewBox="0 0 16 16">
                        <path
                          d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146z" />
                        <path
                          d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                      </svg>
                      <small class="text-light text-center text-light lh-1">VOID SALES<br>[F9]</small>
                    </div>
                  </button>
                </td>
              </tr>

              <tr>
                <td class="full-height-table" colspan="3">
                  <div class="card bg-custom-dark toSwitchUI"
                    style="border-radius: 0; border:none; width: auto; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); max-height: 420px; min-height: auto; height: auto">
                    <div class="row systemInformation">
                      <div class="col-sm-6 infoSystem"
                        style="font-family: Century Gothic; font-size: small; color: #ffff; text-align: left;">
                        <label style="color: #BDBDBD; font-weight: bold">Store:</label>
                        <label style="color: #BDBDBD; font-weight: bold">Cashier:</label>
                        <label style="color: #BDBDBD; font-weight: bold">ID No.:</label>
                        <label style="color: #BDBDBD; font-weight: bold">Time In / Out:</label>

                        <label style="color: #BDBDBD; font-weight: bold">Date & Time:</label>
                        <label style="color: #BDBDBD; font-weight: bold">Machine Name:</label>
                        <label style="color: #BDBDBD; font-weight: bold">Connection Status:</label>
                        <label style="color: #BDBDBD; font-weight: bold">Device ID:</label>
                        <label style="color: #BDBDBD; font-weight: bold">Software Version:</label>
                        <!-- <label style=">Date $ Time:</p> -->
                      </div> <br> <br>

                      <div class="col-sm-6 infoSystem"
                        style="font-family: Century Gothic; font-size: small; color: #ffff; text-align: left;">
                        <label style="color: #E0E0E0">TinkerPro Retail Store</label>
                        <label style="color: #E0E0E0">
                          <?= $firstName . " " . $lastName ?>
                        </label>
                        <label style="color: #E0E0E0">12323-11</label>
                        <label style="color: #E0E0E0"><span style="margin-right: 5px">09:00 AM</span> | <span>06:00
                            PM</span></label>

                        <label style="color: #E0E0E0"><span id="dateDisplay" style="margin-right: 5px"></span> | <span
                            id="curTime"></span></label>
                        <label style="color: #E0E0E0">POS (local)</label>
                        <label style="color: #E0E0E0">Offline</label>
                        <label style="color: #E0E0E0">213213214353454</label>
                        <label style="color: #E0E0E0">1.05</label>
                      </div>
                    </div>

                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <table class="table_buttons table_bottom">
            <tbody>
              <tr>
                <td class="full-height-table">
                  <button id="searchModalButton" class="w-100 bg-custom-dark" style="border-radius: 0; border: none">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <div style="margin: 3px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                          class="bi bi-search" viewBox="0 0 16 16">
                          <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                      </div>
                      <small class="text-light text-center text-light lh-1">SEARCH<br>[F6]</small>
                    </div>
                  </button>
                </td>

                <td class="full-height-table">
                  <button id="saveButton" class="w-100 bg-custom-dark" style="border-radius: 0; border: none">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <div style="margin: 3px">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#f3f3f3" height="23" width="23"
                          viewBox="0 0 448 512">
                          <path
                            d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                        </svg>
                      </div>
                      <small class="text-light text-center text-light lh-1">SAVE<br>[F3]</small>
                      <div
                        style="font-size: large; position: absolute; top: 5; right: 0; height: auto; width: auto; padding: 2px 5px;">
                        <span id="saveQty" class="text-danger"></span></div>
                    </div>
                  </button>
                </td>

                <td class="full-height-table">
                  <button id="CustomerListBtn" class="w-100 bg-custom-dark" style="border-radius: 0; border: none">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <div style="margin: 3px">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#f3f3f3" height="23" width="23"
                          viewBox="0 0 576 512">
                          <path
                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z" />
                        </svg>
                      </div>
                      <small class="text-light text-center text-light lh-1"><span id="c_name">CUSTOMERS</span>
                        <br>[F7]</small>
                    </div>
                  </button>
                </td>
              </tr>

              <tr>
                <td class="full-height-table">
                  <button id="discountModalBtn" class="w-100 bg-custom-dark" style="border-radius: 0; border: none">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <div style="margin: 3px">
                        <svg xmlns="http://www.w3.org/2000/svg" height="23" width="23" viewBox="0 0 512 512">
                          <path fill="#ffffff"
                            d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2zM0 229.5V80C0 53.5 21.5 32 48 32H197.5c17 0 33.3 6.7 45.3 18.7l168 168c25 25 25 65.5 0 90.5L277.3 442.7c-25 25-65.5 25-90.5 0l-168-168C6.7 262.7 0 246.5 0 229.5zM144 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                      </div>
                      <small class="text-light text-center text-light lh-1">DISCOUNT<br>[F2]</small>
                    </div>
                  </button>
                </td>

                <td class="returnAmount full-height-table" style="height: 90px">
                  <button id="refundModalButton" class="w-100 bg-custom-dark"
                    style="border-radius: 0; border: none; height: 100%;">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <div style="margin: 3px">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#f3f3f3" height="23" width="23"
                          viewBox="0 0 448 512">
                          <path
                            d="M438.6 150.6c12.5-12.5 12.5-32.8 0-45.3l-96-96c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.7 96 32 96C14.3 96 0 110.3 0 128s14.3 32 32 32l306.7 0-41.4 41.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l96-96zm-333.3 352c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 416 416 416c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0 41.4-41.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3l96 96z" />
                        </svg>
                      </div>
                      <small class="text-light text-center text-light lh-1">REFUND<br>[F8]</small>
                    </div>
                  </button>

                </td>
                <td class="full-height-table" style="height: 90px">
                  <button id="menuModalButton" class="full-height-btn w-100 h-100 bg-custom-dark"
                    style="border-radius: 0; border: none;">
                    <div class="card bg-custom-dark d-flex align-items-center p-3" style="border: none">
                      <div style="margin: 3px">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#f3f3f3" height="23" width="23"
                          viewBox="0 0 448 512">
                          <path
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                        </svg>
                      </div>
                      <small class="text-light text-center text-light lh-1">Others<br> </small>
                    </div>
                  </button>
                </td>
              </tr>


            </tbody>
          </table>


        </div>

      </div>

    </div>
  </div>


  <?php
  include ('./modals/modals.php');
  include ('./refund/warningModal.php');
  include ('./refund/refund_modal.php');
  include ('./refund/qtyModal.php');
  include ('./refund/chasButtonModal.php');
  include ('./sales_history/sales_history.php');
  include ('./sales_history/printLoad.php');
  include ('./modals/loadData/loadData.php');
  include ('./refund/noData.php');
  include ('./refund/confirmationModal.php');
  include ('./refund/couponExpiration.php');
  include ('./refund/valid.php');
  include ('./refund/expired.php');
  include ('./cash_in_out/cash_in_out.php');
  include ('./refund/on_process.php');
  include ('./refund/voucherConfirmationModal.php');
  include ('./refund/voucherprint.php');
  include ('./refund/e-walletModal.php');
  include ('./end-of-day/end-of-day.php');
  include ('./end-of-day/preview_z_reading.php'); 
  include ('./end-of-day/denomination.php');
  include ('./end-of-day/cash-count-drawer.php');
  include ('./end-of-day/printing-report.php');
  include ('./end-of-day/printing-z-read.php');
  include ('./refund/cc-dcModal.php');
 
  include('./refund/access_granted.php');
  include('./refund/access_denied.php');
  ?>
</section>

<?php
include ('./layout/footer.php');
?>

</body>

</html>


<script>

  var existingTransactionIds = [];
  var savedIndex = [];
  var customerIndex = [];
 
  var intervalId;
  var intervalAmount;
  var intervaldeleteItm;
  var _keybuffer = "";
  var customer_id;
  var customer_name;
  var custiomer_discount;
  var fNamecustomer;
  var customerDisType;
  var vat_Sales;

  var disAm;
  var userId = 0;


  var selectedRowIndex = -1;
  var customerRowIndex = -1;
  var selectedIndex = -1;
  var selectedProdIndex = -1;

  var cashierID = $('#user_id').val();
          

  function GetTotalTransaction(total) {
   console.log(total)
    if (total !== NaN) {
      var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g, "");
      if (returnAmountText !== '') {
        var returnAmount = parseFloat(returnAmountText);
        var totalAmount = parseFloat(total);
        var difference = returnAmount - totalAmount;

        var formattedTotalAmount = new Intl.NumberFormat('en-PH', {
          style: 'currency',
          currency: 'PHP'
        }).format(difference);
        console.log(difference)
        if (difference > 0 && difference !== NaN) {

          $('.returnAmount').html(`
                <div class="card d-flex justify-content-center align-items-center" style="border: none; background-color: #FF6900; border-radius: 0; height: 100%; width: 100%; margin: 0; padding: 0;">
                    <div>
                        <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center;" class="lh-1"><strong>RETURN AMOUNT</strong></small>
                        <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center; font-size: 16px; margin-top: 5px" class="totalReturnAmount lh-1">${formattedTotalAmount}</small>
                    </div>
                </div>
            `);

        } else {
          $('.returnAmount').html(`
                <div class="card d-flex justify-content-center align-items-center" style="border: none; background-color: #22bb33; border-radius: 0; height: 100%; width: 100%; margin: 0; padding: 0;">
                    <div>
                        <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center;" class="lh-1"><strong>RETURN AMOUNT</strong></small>
                        <small style="font-family: 'Century Gothic'; color: #FFFFFF; display: block; text-align: center; font-size: 16px; margin-top: 5px" class="totalReturnAmount lh-1">${formattedTotalAmount}</small>
                    </div>
                </div>
            `);
        }
      }
    }
  }

  function UpdateTotalAmount() {
    var VatSalesToBeDivide = 1.12;
    var VatPercentage = 0.12; // 12% / 100
    axios.get('api.php?action=getTotals')
      .then(function (response) {

        var totalQty = response.data.total.totalQty;
        var totalAmount = parseFloat(response.data.total.totalAmount).toFixed(2);
        var totalDis = parseFloat(response.data.total.totalDis).toFixed(2);
        var total = parseFloat(response.data.total.total).toFixed(2);
        var totaVatAmount = parseFloat(response.data.total.totalVatSales).toFixed(2);
        $('#totalQ').text(addCommas(parseFloat(totalQty).toFixed(2)));
        if (isNaN(totalAmount)) {
          $('#total').text('0.00');
          $('#totalD').text('0.00');
          $('#totalPayment').text('0.00');
          $('#vatAmount').text('0.00');
          $('#totalQ').text(addCommas(parseFloat(0.00).toFixed(2)));
        } else {
          $('#total').text(addCommas(totalAmount));
          $('#totalD').text(addCommas(totalDis));
          $('#totalPayment').text(addCommas(total));
          var subTobePaid = $('#totalPayment').text();
          // var totalVATSales = parseFloat(subTobePaid / VatSalesToBeDivide).toFixed(2);
          var totalVATSales = response.data.total2.totalVatSales;
          var vat = response.data.total2.totalVat;
          $('#vatAmount').text(addCommas(vat));
          $('#vat_Sales').val(totalVATSales);

        }

      })
      .catch(function (error) {
        console.error('Error fetching data:', error);
      });

  }

  function LeftPadWithZeros(number, length) {
    var str = '' + number;
    while (str.length < length) {
      str = '0' + str;
    }
    return str;
  }

  // Current Date
  function currentDate() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();

    var output = (month < 10 ? '0' : '') + month + '-' +
      (day < 10 ? '0' : '') + day + '-' +
      d.getFullYear();

    return output;
  }


  function voidProducts() {
    var selectedRow = $('.selectable-row.selected');
    var transac_num = 0;
    var void_indicator = 0;
    if (selectedRow.length > 0) {
      $("#voidTransactionModal").show();
      transac_num = $('#transactionNum').val();
      $('#void_yes').click(function () {
      
        axios.post('api.php?action=voidTransactions', {
          'transac_num': transac_num,
          'void_indicator': void_indicator,
        })
          .then(function (response) {
            fetchDataAndUpdateTable();
            $('#tableTransactions tbody').empty();
            $("#voidTransactionModal").hide();
            modifiedMessageAlert('success', 'You have successfully voided transaction #' + transac_num, false, false);
          })
          .catch(function (error) {
            console.log(error);
          });
      });
  
      if ($("#voidTransactionModal").is(':visible')) {
        $(document).off('keydown.voidTransaction');
        $(document).on('keydown.voidTransaction', function (e) {
          console.log('ehhllo')
          if (e.which === 13) {
            $('#void_yes').click();
          }
          $(document).off('keydown.voidTransaction');
        });
      }
    } else {
      console.log('ehhlfgfgflo')
      if ($('.transationNumToVoid').val() != '') {
        void_indicator = 1;
        $('#void_yes').click(function () {
          transac_num = $('.transationNumToVoid').val();
          axios.post('api.php?action=voidTransactions', {
            'transac_num': transac_num,
            'void_indicator': void_indicator,
          })
            .then(function (response) {
              $("#voidTransactionModal").hide();

              window.location.reload();
              // modifiedMessageAlert('success', 'You have successfully voided transaction #' + transac_num, false, false);
            })
            .catch(function (error) {
              console.log(error);
            });
        });

        if ($("#voidTransactionModal").is(':visible')) {
          $(document).off('keydown.voidTransaction');
          $(document).on('keydown.voidTransaction', function (e) {
            if (e.which === 13) {
              $('#void_yes').click();
            }
            $(document).off('keydown.voidTransaction');
          });
        }

      } else {
        modifiedMessageAlert('error', 'There is nothing to void a transaction!', false, false);
      }
    }

    $('#closeBtnVoid, #closeCancelVoid').click(function () {
      $("#voidTransactionModal").hide();
      $(document).off('keydown.voidTransaction');
      $('#search-input').focus();
    });
  }



  function toVerifyZread() {
    axios.get('api.php?action=getAllZreading')
    .then(function(response) {
        var z_report = response.data.data;
        $.each(z_report, function(index, z_result) {
            var formattedDateTime = dateAndTimeFormat(z_result.date_time).formatted_date;

            if(formattedDateTime == dateAndTimeFormat(currentDate()).formatted_date) {

                $('#paymentModalButton').prop('disabled', true);
                $('#voidModalButton').prop('disabled', true);
                $('.cashCountDrawer').prop('disabled', true);
                $('.cash_in').prop('disabled', true);
                $('.cash_out').prop('disabled', true);
                $('#cancel_receipt').prop('disabled', true);
                $('#refundButton').prop('disabled', true);
                
                $('#search-input').prop('disabled', true);
                var tr_table = '<tr>' + 
                '<td class="col-12 preview_design" >' + '<h2>' + "Preview Mode Only" + '</h2>' + '<h3>' + "Z-reading has been submitted" + '</h3>' + '</td>' +
                '</tr>';
                $('#tableTransactions tbody').append(tr_table);
            } else {
              $('.btn_new_cash_count').prop('disabled', true)
            }
        });
    })
    .catch(function(error) {
        console.log(error);
    });
}


  function fetchDataAndUpdateTable() {
    var trans;
    UpdateTotalAmount();

    getLengthSaveTransac().then(function (length) {
      $('#saveQty').text(length)
    });

    if ($('#savedProduct').val() == 0) {
      getUpdatedSeries();
      resetModalContent();
    }

    $('small').addClass('text-light');
    $('#divQty').addClass('text-light');
    $('#qty').val(1);
    $('#defQty').text(1);
    var inputBox = $(".search_input");
    inputBox.focus();
    axios.get('api.php?action=getAllTransactions')
      .then(function (response) {
        var transactions = response.data.transactions;
        $.each(transactions, function (index, transaction) {
          if (existingTransactionIds.indexOf(transaction.id) === -1) {
            existingTransactionIds.push(transaction.id);
            var row = '<tr class="selectable-row"' +
              'data-id="' + transaction.id + '" ' +
              'data-qty="' + transaction.prod_qty + '" ' +
              'data-name="' + transaction.prod_desc + '" ' +
              'data-prices="' + transaction.prod_price + '" ' +
              'data-subtotal="' + transaction.subtotal + '" ' +
              'data-transac="' + transaction.transaction_num + '" ' +
              'data-dtype="' + transaction.discount_type + '" ' +
              'data-disamount="' + transaction.discount_amount + '" ' +
              'data-iscart="' + transaction.is_cart_discount + '" ' +
              'data-isvat="' + transaction.isVAT + '" ' +
              'data-vatamount="' + transaction.vat_amount + '" ' +
              'data-tax="' + transaction.tax + '" ' +
              'data-bar="' + transaction.barcode + '" ' +
              'data-prodcode="' + transaction.prodCode + '" ' +
              '>' +
              '<td class="col-2" style="padding: 15px; height: auto">' + (LeftPadWithZeros(transaction.prodCode, 8)) + '</td>' +
              '<td class="col-6" style="padding: 15px; position: relative;">' +
              transaction.prod_desc +
              // '<p style="position: absolute; bottom: 0; font-size: 10px; color: #d8d8e3">Code #.: <span>' + transaction.prod_id + '</span></p>' +
              '</td>' +
              '<td class="col-1" style="padding: 15px;"><span id="rowQty">' + addCommas(transaction.prod_qty) + '</span></td>' +
              '<td  class="col-1" style="padding: 15px;" >' + addCommas(Number(transaction.prod_price).toFixed(2)) + '</td>';

            if (transaction.discount_amount > 0) {
              row += '<td style="padding: 15px; height: 50px" id="totalRowPrice">' +
                '<i class="fa fa-arrow-down" style="color: green; font-size: small; padding: 0; position: relative"></i>' +
                addCommas(Number(transaction.subtotal).toFixed(2)) +
                '</td>';
            } else {
              row += '<td style="padding: auto; padding-top: 15px; height: 50px" id="totalRowPrice">' +
                addCommas(Number(transaction.subtotal).toFixed(2)) +
                '</td>';
            }

            row += '</tr>';
            $('#tableTransactions tbody').append(row);
            trans = $('#tableTransactions tr').data('transac');
            $("#transactionNum").val(trans);
          }

        });
        scrollToSelectedRow()
        selectRow($('.selectable-row').last());

      })
      .catch(function (error) {
        console.error('Error fetching transactions:', error);
      });


    var selectedRow = null;
    function selectRow(row) {
      $('.selectable-row.selected').removeClass('selected');
      selectedRow = row;
      selectedRow.addClass('selected');

      if (selectedRow && selectedRow.length > 0) {
        var tableContainer = $('#tableTransactions');
        var scrollTo = selectedRow.offset().top - tableContainer.offset().top + tableContainer.scrollTop();
        tableContainer.animate({
          scrollTop: scrollTo
        }, 300);
      }
    }


    $('#tableTransactions tbody').on('click', '.selectable-row', function () {
      $('.selectable-row').removeClass('selected');
      $(this).addClass('selected');
      selectRow($(this));
    });

    function moveSelection(direction) {
      if (selectedRow) {
        var nextRow = (direction === 'up') ? selectedRow.prev('.selectable-row') : selectedRow.next('.selectable-row');
        if (nextRow.length) {
          selectRow(nextRow);
        }
      } else {
        var rowToSelect = (direction === 'up') ? $('.selectable-row').last() : $('.selectable-row').first();
        selectRow(rowToSelect);
      }
    }

    $(document).off('keydown.selectRowTransaction')
    $(document).on('keydown.selectRowTransaction', function (e) {
      switch (e.which) {
        case 38:
          moveSelection('up');
          scrollToSelectedRow()
          e.preventDefault();
          break;
        case 40:
          moveSelection('down');
          e.preventDefault();
          scrollToSelectedRow()
          break;
        default:
          return;
      }
      e.preventDefault();
      e.stopPropagation();
    });
  }

  // Message Alert
  function toastMessage(type, message) {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });

    if (type == 'error') {
      Toast.fire({
        icon: type,
        title: message
      });
    } else if (type == "info") {
      Toast.fire({
        icon: type,
        title: message,
      });
    } else {
      Toast.fire({
        icon: type,
        title: message,
      });
    }
  }


  function isValidJSON(str) {
    try {
      JSON.parse(str);
    } catch (e) {
      return false;
    }
    return true;
  }

  function resetModalContent() {
    // Payment Modal
    $('#paidText').val('0');
    $('#customerDiscount').val('0');
    $('#userId').val('6');
    // $('#vat_sales').val('0');
    // console.log($('#vat_sales').val())
    $('#customerFullname').text('Unknown');
    $('#dstype').text('Regular');
    $('#totalChange').val('0.00');

    // Main Page
    // $('#vat_Sales').val('');
    $('#customer_id').val('');
    $('#customer_discount').val('');
    $('#fNamecustomer').val('');
    $('#customerDisType').val('');

    // customer Modal
    $('#CustomersList tbody').empty();
    $('#c_name').text('CUSTOMERS')

    var selectedButton = $('.selectBtnPaymentMethod');
    $('.paymentMethod_btn button').removeClass('selectBtnPaymentMethod').find('.fa-check').remove();
    $('.paymentMethod_btn button').find('input[type="checkbox"]').prop('checked', false);
    $('#printingText').html('RECEIPT PREVIEW: <span id="text_id_or" style="color: #FF6700;">00000000</span>')

    var inputBox = $("#search-input");
    inputBox.focus();

  }

  var modifiedMessageModal = $('#modifiedMessageModal');
  function modifiedMessageAlert(type, message, color, isButtonYes, isButtonCancel) {
    if (type == 'error') {
      document.getElementById('modalTitle').innerText = message;
      document.getElementById('modalTitle').style.color = 'red';
    } else {
      document.getElementById('modalTitle').innerText = message;
      document.getElementById('modalTitle').style.color = 'green';
    }


    if (isButtonYes) {
      document.getElementById('yesBtn').classList.remove('d-none');
    } else {
      document.getElementById('yesBtn').classList.add('d-none');
    }


    var setIntervalMessage = setInterval(function () {
      modifiedMessageModal.fadeIn('fast');
    }, 1);
    setTimeout(function () {
      clearInterval(setIntervalMessage);
      modifiedMessageModal.fadeOut('fast');
      // $('#search-input').focus();
    }, 1500);
  }


    
  var qty_t;
  var dataQ;
  let responseData;
  function changeQty() {
    $(document).off('keyup.defaultQty', '#formattedDefaultQty');
    $(document).off('keydown.setquantity', '#formattedinputQty');
    var selectedRow = $('.selectable-row.selected');
    if (selectedRow.length == 0) {
      $("#quantityDefaultProductModal").show();
      $('#formattedDefaultQty').focus().select();
      if ($('#quantityDefaultProductModal').is(':visible')) {
        $(document).on('keyup.defaultQty', '#formattedDefaultQty', function (e) {
          if (e.which === 13) {
            var defaultQty = $('#defaultquantity').val();
            $('#qty').val(defaultQty);
            $('#defQty').text(defaultQty);
            qty_t = defaultQty;
            $('small').removeClass('text-light');
            $('#divQty').removeClass('text-light');

            $("#quantityDefaultProductModal").hide();
            $('#search-input').focus();
          }
        });
      }
    }


    if (selectedRow.length > 0) {
      $("#quantityProductModal").show();
      var selectedRowId = selectedRow.data('id');
      var selectedRowQty = selectedRow.data('qty');
      var selectedRowName = selectedRow.data('name');
      var selectedRowPrice = selectedRow.data('prices');
      console.log(selectedRowPrice )
      $('#productID').val(selectedRowId);
      $('#quantity').val(selectedRowQty);
      $('#formattedinputQty').val(selectedRowQty);
      $('#prod_name').text(selectedRowName);
      var origQty = selectedRowQty
      var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g, "");
      var returnAmount = parseFloat(returnAmountText);
      var oldTotalPrice = parseFloat($('#totalRowPrice').text()) - (parseFloat(selectedRowPrice) * parseFloat($('#rowQty').text()));


      axios.get(`api.php?action=getTransactionsID&selectedRowId=${selectedRowId}`)
        .then(function (response) {
          responseData = response.data.t_id[0].prod_qty;
          var inputBox = $("#formattedinputQty");
          if (inputBox.length) {
            inputBox.focus().select();
          }
          $(document).on('keydown.setquantity', '#formattedinputQty', function (e) {
            var prodID = $('#productID').val();
            var updateQty = $('#quantity').val();
            if (e.which === 13) {
              axios.post('api.php?action=updateQty', {
                'prodID': prodID,
                'updateQty': updateQty,
              })
                .then(function (response) {
                  var newQty = updateQty - responseData;
                  var cellToUpdate = selectedRow.find('#rowQty');
                  var cellToUpdatePrice = selectedRow.find('#totalRowPrice');
                  cellToUpdate.text(addCommas(updateQty));
                  cellToUpdatePrice.text(addCommas(response.data.data.subtotal))
                  var newTotal = parseFloat(newQty * selectedRowPrice).toFixed(2);
                  dataQ = response.data.data.subtotal;
                 
                  if (returnAmountText) {
                    GetTotalTransaction(newTotal);
                  }
                  fetchDataAndUpdateTable();
                  intervalId = setInterval(fetchDataAndUpdateTable, 1);
                  setTimeout(function () {
                    clearInterval(intervalId);
                  }, 1);
                  $("#quantityProductModal").hide();
                })
                .catch(function (error) {
                  console.log(error);
                })
            }
          })
        })
        .catch(function (error) {
          console.log(error);
        });
    }

    $('#closeDefaultQty, #closeChangeQty').click(function () {
      $('#quantityProductModal').hide();
      $('#quantityDefaultProductModal').hide();
      $('#search-input').focus();
    })
  }

  function deleteItem() {
    var itemId = $('#productId').val();
    axios.post('api.php?action=deleteItem', {
      'itemId': itemId,
    })
      .then(function (response) {
        fetchDataAndUpdateTable();
        resetModalContent();
        var inputBox = $("#search-input");
        inputBox.focus();

        var setIntervalMessage = setInterval(function () {
          $('#modalDeletePopUp').fadeIn('fast')
        }, 1);
        setTimeout(function () {
          clearInterval(setIntervalMessage);
          $('#modalDeletePopUp').fadeOut('fast')
          $('#search-input').focus();
        }, 1500);

      })
      .catch(function (error) {
        console.error(error);
      });
  }

  function getLengthSaveTransac() {
    return axios.get('api.php?action=getAllSaved')
      .then(function (response) {
        var listSaveOrders = response.data.data;
        for(var i = 0; i < listSaveOrders.length; i++) {
          if(listSaveOrders[i].cashier_id == cashierID) {
            saveOrderLength = listSaveOrders.length;
            return saveOrderLength;
          }
        }
      })
      .catch(function (error) {
        console.error('Error fetching data:', error);
        throw error;
      });
  }

  function ListOfSavedOrder() {
    $('#saveModal').show();
    var selectedId;
    var selectedTransNum;
    var selectedRow = null;
    axios.get('api.php?action=getAllSaved')
      .then(function (response) {
        if (response.data.success) {
          var savedTransac = response.data.data;
            savedTransac.sort((a, b) => b.id - a.id); 
            $.each(savedTransac, function (index, savedTran) {
                if (savedIndex.indexOf(savedTran.id) === -1 && cashierID == savedTran.cashier_id) {
                    savedIndex.push(savedTran.id);
                    var row = '<tr class="saved_selected_row"' +
                        'data-orderid="' + savedTran.id + '" ' +
                        'data-tnumber="' + savedTran.transaction_num + '" ' +
                        '>' +
                        '<td>' + savedTran.id + '</td>' +
                        '<td>' + savedTran.name + '</td>' +
                        '<td>' + addCommas(savedTran.qty) + '</td>' +
                        '<td>' + addCommas(parseFloat(savedTran.Total).toFixed(2)) + '</td>' +
                        '</tr>';
                    $('#savedTransactions tbody').append(row);
                }
                selectRow($('.saved_selected_row').first());
            });

          function selectRow(row) {
            $('.saved_selected_row.selected').removeClass('selected');
            selectedRow = row;
            selectedRow.addClass('selected');

            if (selectedRow && selectedRow.length > 0) {
              var offset = selectedRow.offset();
              if (offset) {
                $('html, body').animate({
                  scrollTop: offset.top - $(window).height() / 2
                }, 1);
              }
            }

            selectedId = selectedRow.data('orderid');
            selectedTransNum = selectedRow.data('tnumber');

            $('#voidSavedOrders').click(function () {
              $('#saveModal').hide();
              $('#salesHistoryModal').hide();
              $("#voidTransactionModal").show();
              $('.transationNumToVoid').val(selectedTransNum);
              voidProducts();
            })
          }

          $('#savedTransactions tbody').on('click', '.saved_selected_row', function () {
            $('.saved_selected_row').removeClass('selected');
            $(this).addClass('selected');
            selectRow($(this));
          });

          function moveSelection(direction) {
            if (selectedRow) {
              var nextRow = (direction === 'up') ? selectedRow.prev('.saved_selected_row') : selectedRow.next('.saved_selected_row');
              if (nextRow.length) {
                selectRow(nextRow);
              }
            } else {
              var rowToSelect = (direction === 'up') ? $('.saved_selected_row').last() : $('.saved_selected_row').first();
              selectRow(rowToSelect);
            }
          }

          $(document).off('keydown.selectRowSalesHistory');
          $(document).on('keydown.savedSelectRowTransaction', function (e) {
            switch (e.which) {
              case 38:
                moveSelection('up');
                e.preventDefault();
                break;
              case 40:
                moveSelection('down');
                e.preventDefault();
                break;
              default:
                return;
            }
            e.preventDefault();
            e.stopPropagation();
          });

        } else {
          console.error("Error fetching saved transactions:");
        }
      })
      .catch(function (error) {
        console.error("Error fetching saved transactions:", error);
      });

      $('#closeSaveBtn, #newSales').click(function () {
          $('#saveModal').hide();
      });

    $('#continue_btn').click(function () {
      if($('.selectable-row').length != 0) {
        modifiedMessageAlert('error', 'You have other transactions', false, false)
      } else {
        axios.post('api.php?action=updateTransactSaved', {
        'temId': selectedId,
        })
        .then(function (response) {
          var regCustomerName = response.data.data.name;
          fetchDataAndUpdateTable();
          $('#fNamecustomer').val(regCustomerName)
          $('#c_name').text(regCustomerName);
          selectedRow.remove();
          $('#saveModal').hide();
          $('#savedProduct').val(1)
        })
      }
    })


    $('#clearAllSaved').click(function() {
      var tNumberValues = $('.saved_selected_row').map(function() {
          return $(this).data('tnumber');
      }).get();

      var requestDataToDelete = {
        'toDelete' : tNumberValues,
      }
      axios.post('api.php?action=deleteAllSavedOrders', requestDataToDelete)
      .then(function(response) {
        $('#saveModal').show();
        window.location.reload();
        $('#search-input').focus();
      })
      .catch(function(error) {
        console.log(error);
      })
    })


  }

  function handleKeyDown_test(event) {
    if (event.which === 13 && $('#saveTransacConfirmation').is(':visible')) {
      $(document).trigger('test.savedOrderKey');
      // console.log(event)
    }
  }

  $(document).on('keydown.savedOrderKey', handleKeyDown_test);

  $(document).on('test.savedOrderKey', function () {
    if ($('#enterCustomerNameModal').is(':visible')) {
      // do nothing 
    } else {
      $('#save_yes').click();
      $(document).on('keydown', '#customerN', function (e) {
        if (e.which == 13) {
          $('#save_cus_name').click();
        }
      })
    }
  });

  function ToSaveOrder() {
    $('#saveTransacConfirmation').hide();
    $('#enterCustomerNameModal').show();

    $('#save_cus_name').click(function () {
      var c_name = $('#customerN').val();
      var transacNo = $('#transactionNum').val()
      var requestedData;

      if (c_name == '') {
        var randomNumber = Math.floor(Math.random() * 999999999) + 1;
        requestedData = {
          'name': randomNumber,
          'transacNo': transacNo,
        }
      } else {
        requestedData = {
          'name': c_name,
          'transacNo': transacNo,
        }
      }


      axios.post('api.php?action=saveTransactions', requestedData)
        .then(function (res) {
          fetchDataAndUpdateTable();
          $('#tableTransactions tbody').empty();
          $('#enterCustomerNameModal').hide();
          window.location.reload();
        }).catch(function (error) {
          console.log(error);
        })
    })

    var inputBox = $("#customerN");
    if (inputBox.length) {
      inputBox.focus().select();
    }
  }


  function toBlockSave() {
    $('#saveTransacConfirmation').hide();
    $('#search-input').focus();
    modifiedMessageAlert('error', 'There is no transaction to save!', false, false)
  }

  function saveOrders() {
    var selectedRow = $('.selectable-row.selected');
    var tableRows = $('.selectable-row');
    ;
    $('#saveTransacConfirmation').show();

    $('#saved_orders').click(function () {
      $('#saveTransacConfirmation').hide();
      ListOfSavedOrder()
    })

    $('#cancelBtnSaveCus').click(function () {
      $('#enterCustomerNameModal').hide();
    })

    $('#closeBtnSave').click(function () {
      $('#saveTransacConfirmation').hide();
    })

    $('#closeCancelSave').click(function () {
      $('#saveTransacConfirmation').hide();
    })
  }

  function scrollToSelectedRow() {
    var container = $('.table-container');
    var selectedRow = $('.selectable-row.selected');

    // Check if selectedRow is defined before accessing its offset
    if (selectedRow.length > 0) {
      container.scrollTop(selectedRow.offset().top - container.offset().top + container.scrollTop());
    }
  }

  // Get Updated Series for transactionNumber
  function getUpdatedSeries() {

    axios.get('api.php?action=getUpdatedSeries')
      .then(function (response) {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var output = d.getFullYear() +
          (month < 10 ? '0' : '') + month +
          (day < 10 ? '0' : '') + day;
        var transacNum = output + response.data.data.series;
        $("#transactionNum").val(transacNum)
      }).catch(function (error) {
        console.log(error);
      })
  }


  function selectPaymentMethod(cashButton, callback) {
    if (cashButton.hasClass('selectBtnPaymentMethod')) {
        $(document).off('keydown.keyPrint', '#fomattedPaidText');
        $(document).off('keydown.selectRowTransaction')
        $(document).on('keydown.keyArrows', '#fomattedPaidText', function (event) {
            const arrowUpKey = 38;
            const arrowDownKey = 40;
            const enterKey = 13; // Add Enter key constant

            if (event.which === arrowUpKey || event.which === arrowDownKey || event.which === enterKey) { // Check for Enter key
                event.preventDefault();
                let selectedButton = $('.selectBtnPaymentMethod');
                if (selectedButton.length === 0) {
                    selectedButton = $('.paymentMethod_btn button').first();
                }

                let index = $('.paymentMethod_btn button').index(selectedButton);
                if (event.which === arrowUpKey) {
                    index = (index - 1 + $('.paymentMethod_btn button').length) % $('.paymentMethod_btn button').length;
                } else if (event.which === arrowDownKey) {
                    index = (index + 1) % $('.paymentMethod_btn button').length;
                }

                $('.paymentMethod_btn button').removeClass('selectBtnPaymentMethod').find('.fa-check').remove();
                $('.paymentMethod_btn button').find('input[type="checkbox"]').prop('checked', false);

                selectedButton = $('.paymentMethod_btn button').eq(index).addClass('selectBtnPaymentMethod');
                selectedButton.prepend('<i class="fa fa-check"></i>');
                var payment_method = selectedButton.find('input[type="checkbox"]').prop('checked', true);
                let buttonText = selectedButton.text();

                if (payment_method) {
                  $('#paymentMethod_text').contents().first().replaceWith(buttonText)
                  $('#paymentMethod_text').append($('#PaidAmount'));
                  $('.paymentType_val').val(payment_method.val());
                }

                var selected_p = selectedButton.text().split(/\d+/)[0].toLowerCase().trim()
                if (event.which === enterKey && selected_p === 'e-wallet') {
                    var returnString  = 'e-wallet'
                    $('.cancelCC, #eWalletClose').click(function() {
                      selectedButton.removeClass('selectBtnPaymentMethod')
                      .find('input[type="checkbox"]')
                      .prop('checked', false);
                      $('i.fa.fa-check').remove();
                      $('#fomattedPaidText').focus().select();
                    })
                    callback(returnString);
                } else if (event.which === enterKey && selected_p === 'debit/credit') {
                    var returnString  = selected_p
                    $('.cancelCC, #ccClose').click(function() {
                      selectedButton.removeClass('selectBtnPaymentMethod')
                      .find('input[type="checkbox"]')
                      .prop('checked', false);
                      $('i.fa.fa-check').remove();
                      $('#fomattedPaidText').focus().select();
                    })
                    callback(returnString);
                } else if ((event.which === enterKey && selected_p === 'cash') || (event.which === enterKey && selected_p === 'credit')) {
                  var returnString = selected_p;
                  callback(returnString);
                } else if (event.which === enterKey && selected_p === 'void') {
                  var returnString = 'void';
                  callback(returnString)
                }
            }
        });
    }
}




  function searchProduct() {
    $('#searchProductModal').show();

  }


  function updateCouponValue(couponId) {
    axios.put('api.php?action=updateCouponVal', {
      'couponId': couponId,
    })
      .then(function (response) {
        console.log(response.data.data)
      })
      .catch(function (error) {
        console.log(error);
      })
  }


  function createNewCoupon(remainingCoupon, receipt_id, selectedTime) {

    const requestedData = {
      'returnAmountText' : remainingCoupon,
      'selectedData' : selectedTime,
      'r_id' : receipt_id,
    };

    axios.post('api.php?action=insertAdata', requestedData)
    .then(function(response) {
      console.log(response.data)
      $.ajax({
        url: "./coupon-receipt.php",
        type: "GET",
        data: {
          r_id: receipt_id,
          first_name: 'Admin',
          last_name: 'Admin',
        },
        success: function (data) {
          console.log('success');
        },
        error: function (xhr, status, error) {
          console.error(error);

        }
      });
    })
    .catch(function(error) {
      console.log(error)
    })
  }





  function paymentFuntion() {

    var selectedRow = $('.selectable-row.selected');
    var tableRows = $('.selectable-row');
    if (tableRows.length == 0) {
      modifiedMessageAlert('error', 'You have to add product first!', false, false);
    } else {
      $('#userId').val(6);
      var randomNumber = String(Math.floor(Math.random() * (99999999 - 10000000 + 1)) + 10000000);
      var paddedNumber = randomNumber.padStart(8, '0');
      // $('#barcode_receipt').val(paddedNumber);

      var textDis = 0;
      var totat_v = $('#vat_Sales').val();
      $('#vat_sales').val(totat_v);
      var partial_customer = $('#customer_id').val();
      var partial_discount_per = $('#customer_discount').val();
      $("#payCashModal").show();

      $('#void_btn').click(function () {
        voidProducts();
        $("#payCashModal").hide();
      })

      $(document).off('keydown.selectRowTransaction')
      var inputBox = $(".input_paid");
      if (inputBox.length) {
        inputBox.focus().select();
        $('#search-input').blur();
      }

      var totalAmount = 0;
      var totalDiscount = 0;
      var transNo;

      var totalPayment = $('#totalPayment').text();
      var change = -1;
      var toExecute = parseFloat((totalPayment).replace(/,/g, '')).toFixed(2);

      var totalVatSales = 0;
      var totalVat = 0;
      var partialDis = 0;
      var fcustomer_dis = 0;

      var partialAmount = 0;

      var price = 0;
      var qty = 0;
      var amount = 0;
      var discounted = 0;

      var coupon_value = parseFloat($('#coupon_val_to_add').val()).toFixed(2);
      var coupon_to_return_val = parseFloat($('#coupon_val_to_return').val()).toFixed(2)
      // console.log(coupon_value, 'This is your coupon value')

      var customer_accountNum = $('#account_number_cc_d').val();

      tableRows.each(function () {
        var id = $(this).data('id');
        var qty = $(this).data('qty');
        var prices = $(this).data('prices');
        var disAmount = $(this).data('disamount');
        var testTransac = $(this).data('transac');
        var partialAmount = qty * prices;
        transNo = testTransac;
        totalDiscount += disAmount;
      });


      if ($('#fNamecustomer').val() == '') {
        $('#customerFullname').text('Unknown Unknown');
      } else {
        var customer_name_val = $('#fNamecustomer').val();
        $('#customerFullname').text(customer_name_val);
      }

      totalAmount = removeCommas($('#total').text());

      $('#coupon_to_return_val').val(parseFloat(coupon_to_return_val).toFixed(2))
      $('#couponValue').val(parseFloat(coupon_value).toFixed(2))
      $('#coupon_text').text(addCommas(parseFloat(coupon_value).toFixed(2)))
      toExecute = toExecute - parseFloat(coupon_value).toFixed(2);

      $(document).off("keydown.getAmountCoupon", "#coupon_discount_code")
      $(document).on("keydown.getAmountCoupon", "#coupon_discount_code", function (e) {
        var qr_num = $("#coupon_discount_code").val()
        isValidJSON(qr_num)
        if (isValidJSON(qr_num)) {
          var jsonData = JSON.parse(qr_num);
          var couponNumber = jsonData.couponNumber;

          if (couponNumber) {
            getCouponsValidity(couponNumber);
            $("#coupon_discount_code").val("");
            toExecute -= jsonData.amount;
            $('#totalPayments').text(addCommas(parseFloat(toExecute).toFixed(2)))
          }
        }
      })

      // if (toExecute <= -1) {
      //   toExecute = parseFloat(coupon_value).toFixed(2) - (toExecute) * -1
      // }

      $(document).off('keydown.keyPrint', '#fomattedPaidText');
      $(document).on('keydown.keyPrint', '#fomattedPaidText', function (e) {
        var namespace = 'keyPrint';
        if (e.which === 13) {

          var totalToPay = $('.totalPayments').text();
          var cashButton;

          // if ($('#paidText').val() == 0 || $('#paidText').val() == '') {
          //   cashButton = $('.e_wallet')
          // } else {
          //   cashButton = $('#cash')
          // }

          cashButton = $('#cash')
          function activeButtons() {
            cashButton.addClass('selectBtnPaymentMethod')
              .find('input[type="checkbox"]')
              .prop('checked', true);
            cashButton.prepend('<i class="fa fa-check"></i>');
          }
          
          activeButtons()
          
          // if ((totalToPay != 0 || totalToPay != '0') && (coupon_value == 0 || coupon_value != 0)) {
          //   activeButtons()
          // }
          
          var eWallet = cashButton.text().split(/\d+/)[0].toLowerCase()
          // --------------------------------------------
          function toProceed() {
            var cashPay = $('#paidText').val();
            var change = $('#totalChange').text();
            change = $('#changeVal_input').val();
            var customerId = $('#userId').val();
            var regularDis = $('#regular_dis').val();
            // var barcode_receipt = $('#barcode_receipt').val();

            var TotalQty = $('#totalQ').text();
            var VAT_Sales = $('#vat_sales').val();
            var c_amounts = $('.coupon_text').text().replace(/[^\d.-]/g, '')
            totalVatSales = $('#vat_sales').val();
            totalVat = parseFloat(totalVatSales * 0.12).toFixed(2);
            var curTime = $('#curTime').text();

            var paymentMetVal;
            var paymentMethodText;
            var ref_number;
            var e_customer_name;

            $('#PaidAmount').text(addCommas(parseFloat(cashPay).toFixed(2)));
            $('#ChangeAmount').text(addCommas(parseFloat(change).toFixed(2)));
            $('#CustomerDiscount').text(addCommas(parseFloat(fcustomer_dis - partialDis).toFixed(2)));
            var receiptTransactionID = $('.receiptId').text();
            if (receiptTransactionID) {
              var fa = new Intl.NumberFormat('en-PH', {
                currency: 'PHP',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              }).format(c_amounts);
              $('.referenceNumber').text('Reference No.:')
              $('.referenceInt').text(receiptTransactionID)
              $('#couponAmount_val').text(addCommas(parseFloat(fa).toFixed(2)))
            } else {
              $('#couponAmount_val').text(addCommas(parseFloat(coupon_value).toFixed(2)))
            }

            var returnAmountText = $('.totalReturnAmount').text().trim();
            var totalAmountText = $('#totalPayment').text().trim();
            if (returnAmountText !== null && returnAmountText !== '') {
              $('#TotalAmount').text(parseFloat(0).toFixed(2));
              $('#TotalPayment').text(parseFloat(0).toFixed(2));
            } else {
              $('#TotalPayment').text(addCommas(parseFloat(toExecute).toFixed(2)));
              $('#TotalAmount').text(addCommas(parseFloat(amount).toFixed(2)));
            }

            $('#ItemsDiscount').text(addCommas(parseFloat(partialDis).toFixed(2)));
            $('#TotalQty').text(addCommas((TotalQty)))
            $('#VatSales').text(addCommas(parseFloat(VAT_Sales).toFixed(2)));
            $('#VatAmount').text(addCommas(parseFloat(totalVat).toFixed(2)));
            $('#CurrentDate').text(currentDate());
            $('#CurrentTime').text(curTime);
            $('#Payer').text(fNamecustomer);
            var TotalQty = $('#totalQ').text();
            var VAT_Sales = $('#vat_sales').val();

            totalVatSales = $('#vat_sales').val();
            totalVat = parseFloat(totalVatSales * 0.12).toFixed(2);
            var curTime = $('#curTime').text();


            $('#PaidAmount').text(addCommas(parseFloat(cashPay).toFixed(2)));
            $('#ChangeAmount').text(addCommas(parseFloat(change).toFixed(2)));
            $('#CustomerDiscount').text(addCommas(parseFloat(fcustomer_dis - partialDis).toFixed(2)));

            var returnAmountText = $('.totalReturnAmount').text().trim();
            var totalAmountText = $('#totalPayment').text().trim();
            if (returnAmountText !== null && returnAmountText !== '') {
              $('#TotalAmount').text(parseFloat(0).toFixed(2));
              $('#TotalPayment').text(parseFloat(0).toFixed(2));
            } else {
              $('#TotalPayment').text(addCommas(parseFloat(toExecute).toFixed(2)));
              $('#TotalAmount').text(addCommas(parseFloat(amount).toFixed(2)));
            }

            $('#ItemsDiscount').text(addCommas(parseFloat(partialDis).toFixed(2)));
            $('#TotalQty').text(addCommas((TotalQty)))
            $('#VatSales').text(addCommas(parseFloat(VAT_Sales).toFixed(2)));
            $('#VatAmount').text(addCommas(parseFloat(totalVat).toFixed(2)));
            $('#CurrentDate').text(currentDate());

            $('#CurrentTime').text(curTime);
            $('#Payer').text(fNamecustomer);

            $('#couponAmount_val').text(addCommas(parseFloat(coupon_value).toFixed(2)))

            $('#salesCompleteModal').show();
            $('#savedProduct').val(0)
            $('#changeText').text(addCommas(parseFloat(change).toFixed(2)));
            $('#paidAmount_text').text(addCommas(parseFloat(cashPay).toFixed(2)));
            $('#tenderedSales').text(addCommas(parseFloat(toExecute).toFixed(2)));
            var CustomerDisType = $('.CustomerDisType');
            CustomerDisType.text($('#dstype').text())

            paymentMetVal = $('.paymentType_val').val();
            var foundMatch = false;
            // for payment method here
            axios.get('api.php?action=getAllMethodPayment')
              .then(function (response) {
                var allPaymentMet = response.data.data;
                for (var i = 0; i < allPaymentMet.length; i++) {
                  if (allPaymentMet[i].id == paymentMetVal) {
                    var pay_met_text = allPaymentMet[i].method.toLowerCase();
                    paymentMethodText = pay_met_text
                    foundMatch = true;
                    break;
                  }
                }

                // for e wallet
                ref_number = $('#ref_number').val();
                e_customer_name = $('#customer_name_payment').val();
                $('#paymentMethod_text').text(paymentMethodText.toUpperCase())
                if ($('#salesCompleteModal').is(':visible')) {

                  var requestData;
                  if (coupon_value > 0 && coupon_value < toExecute) {
                    requestData = {
                      'cashPays': parseFloat(cashPay),
                      'changes': parseFloat(change),
                      'transac': transNo,
                      'customerId': customerId,
                      'regularDis': regularDis,
                      'paymentMetVal': 6,
                      'otherDetails': [
                        { "paymentType": paymentMethodText, "amount": parseFloat(cashPay).toFixed(2), "index": paymentMetVal, ref_number, e_customer_name },
                        { "paymentType": "coupon", "amount": coupon_value, "index": "7"},
                      ]
                    };
                    console.log('test 1')
                  } else if (customer_accountNum != '') {
                    requestData = {
                      'cashPays': parseFloat(cashPay),
                      'changes': parseFloat(change),
                      'transac': transNo,
                      'customerId': customerId,
                      'regularDis': regularDis,
                      'paymentMetVal': paymentMetVal,
                      'otherDetails': [
                        { "paymentType": paymentMethodText, "amount": parseFloat(cashPay).toFixed(2), "index": paymentMetVal, ref_number, e_customer_name, customer_accountNum },
                        { "paymentType": "coupon", "amount": coupon_value, "index": "7"},
                      ]
                    };
                  } else {
                    requestData = {
                      'cashPays': parseFloat(cashPay),
                      'changes': parseFloat(change),
                      'transac': transNo,
                      'customerId': customerId,
                      'regularDis': regularDis,
                      'paymentMetVal': paymentMetVal,
                      'otherDetails': [
                        { "paymentType": paymentMethodText, "amount": parseFloat(cashPay).toFixed(2), "index": paymentMetVal, ref_number, e_customer_name },
                        { "paymentType": "coupon", "amount": coupon_value, "index": "7"},
                      ]
                    };
                    console.log('test 2')
                  }

                  $(document).off('keydown.keyPrint', '#paidText');
                  axios.post('api.php?action=postPayment', requestData)
                    .then(function (response) {
                      $("#payCashModal").hide();
                      $('#tableTransactions tbody').empty();
                      fetchDataAndUpdateTable();
                      resetModalContent();
                      $('#totalChange').val('0.00');

                      var receipt_id_text = response.data.or_number.receipt_id.toString().padStart(8, '0');
                      $('#or_number_text_prev').html('OR # ' + receipt_id_text + '');
                      $('#text_id_or').text(receipt_id_text)

                      if ($('#coupon_id') != '' || coupon_to_return_val != 0) {
                        console.log($('#coupon_id').val())
                        updateCouponValue($('#coupon_id').val())

                        if(coupon_to_return_val != '' && coupon_to_return_val != 0) {
                          createNewCoupon(coupon_to_return_val, response.data.or_number.receipt_id, '1 DAY');                        
                        }  
                      }

                      axios.post('api.php?action=getTransactionsByNumJS', {
                        'transNo': transNo
                      })
                        .then(function (response) {
                          const container = $('.soldProduct');
                          container.empty();
                          const responseData = response.data.response;
                          for (const key in responseData) {
                            if (responseData.hasOwnProperty(key)) {
                              const transacNum = $('.Preview_transacNo');
                              const label = $('<label class="orderProducts"></label>');
                              if (responseData[key].isVAT == '1') {
                                label.html(addCommas(responseData[key].totalProdQty) + "x" + addCommas(responseData[key].prod_price) + ' - ' + responseData[key].prod_desc + " (V) " +
                                  `<span style="float: right" class="subTotal_receipt">${addCommas(responseData[key].totalSubtotal)}</span>`);
                              } else {
                                label.html(addCommas(responseData[key].totalProdQty) + "x" + addCommas(responseData[key].prod_price) + ' - ' + responseData[key].prod_desc + " (N) " +
                                  `<span style="float: right" class="subTotal_receipt">${addCommas(responseData[key].totalSubtotal)}</span>`);
                              }
                              transacNum.text(responseData[key].transaction_num)
                              container.append(label);
                            }
                          }
                        })
                        .catch(function (error) {
                          console.log(error);
                        });
                      var receiptTransactionID;
                      $(document).off('keydown.saveTransactions');
                      $(document).on('keydown.finalPrintReceipt', function (e) {
                        if (e.which === 13) {
                          var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g, "");
                          var rAmount = $('.totalReturnAmount').text()
                          if (returnAmountText) {
                             receiptTransactionID = $('.receiptId').text();
                          }
                            if ($('.transactionCheckbox:checked').length > 0 || $('#selectAllCheckbox').is(':checked')) {
                              let isFirstTransaction = true;
                              var receiptTransactionID = $('.receiptId').text();
                              $('.transactionCheckbox:checked').each(function (index) {
                                var $row = $(this).closest('tr');
                                var quantityInput = $row.find('.quantity-input').val();
                                var product_id = $row.find('.productid').text();
                                var payment_id = $row.find('.paymentid').text();
                                var product_price = $row.find('.priceData').text();
                                returnproducts(quantityInput, product_id, payment_id, function () {
                                }, isFirstTransaction);
                                isFirstTransaction = false;
                              });
                            }
                            $.ajax({
                              url: "./pay-cash-receipt.php",
                              type: "GET",
                              data: {
                                first_name: 'Admin',
                                last_name: 'Admin',
                                transaction_num: transNo,
                                user_id: customerId,
                                receiptTransactionID: receiptTransactionID
                              },
                              success: function (data) {
                                $("#payCashModal").hide();
                                $(document).off('keydown.finalPrintReceipt');
                                $('#printingText').html('PRINTING YOUR RECEIPT: <span id="text_id_or" style="color: #FF6900;">' + receipt_id_text + '</span>');
                                runPrintPreview();
                                $('.printReceipt').addClass('selectBtnPaymentMethod');
                                $(document).on('keydown.newSales');
                                if ($('#salesCompleteModal').is(':visible')) {
                                  $(document).on('keydown.newSales', function (e) {
                                    if (e.which === 13) {
                                      $("#modalLoadData").show();
                                      $("#loadData").click();
                                      $('#salesCompleteModal').hide();
                                      $('#totalChange').val('0.00');
                                      $(document).off('keydown.newSales');

                                    }
                                  })
                                }
                              },
                              error: function (xhr, status, error) {
                                console.error(error);
                              }
                            });
                          
                        } else {
                          $('#salesCompleteModal').hide();
                          resetModalContent();
                          $('#totalChange').text('0.00')
                          $('.printReceipt').removeClass('selectBtnPaymentMethod');
                          $(document).off('keydown.saveTransactions');
                          $(document).off('keydown.finalPrintReceipt');
                        }
                      })
                    })
                    .catch(function (error) {
                      console.log('Error:', error);
                    });
                }
              })
              .catch(function (error) {
                console.log(error)
              })
          }
          // ---------------------------------------------------------

          // ---------------------------------------------
          function splitFunction() {
            var namespace = 'splitPaymentSelection';
            $(document).on('keydown.splitPayment', function (event) {
              if (event.which === 13 && namespace === 'splitPaymentSelection') {
                $(document).trigger('test.splitPayment', { namespace: 'splitPaymentSelection' });
              }
            });

            $(document).on('test.splitPayment', function (event, data) {
              if (data && data.namespace === 'splitPaymentSelection') {
                var paymentMethodText = $('#paymentMethod_text').text().split(/\d+/)[0].trim().toUpperCase();
                $('#splitModal').show();
                $('#totalPaymentSplit').text(totalAmount);

                var cashVal = parseFloat($('#paidText').val()).toFixed(2);

                const paymentTypes = ['CASH', 'GCASH', 'MAYA', 'DEBIT/CREDIT', 'CREDIT'];
                if (paymentTypes.includes(paymentMethodText)) {
                  $(`#${paymentMethodText.toLowerCase()}Split`).text(cashVal);
                }

                var totalSplit = (parseFloat($('#totalPaymentSplit').text()) - parseFloat(cashVal)).toFixed(2);
                $('#totalPaymentSplit').text(totalSplit);

                splitPayments(totalSplit);
              }
            });
          }
          // ---------------------------------------------

          
        function forEwalletAndCreditDebit(returnString) {
          if(returnString == 'e-wallet') {
              var paymendMetthodVal;
              $('#ewallet_modal').show();
              if($('#ewallet_modal').is(":visible")){
                  var gcashCard = document.querySelector('.gcash');
                  $('#ewallet_modal').focus()
                  toggleActiveClass(gcashCard);
                  optionsData = 2;
                  paymendMetthodVal = 2
              }

              $('.header_name').text('SELECT PAYMENT TYPE');
              $('.amount_value_e_wallet').prop('readonly', false)
              $('.amount_value_e_wallet').val(parseFloat(toExecute).toFixed(2))

              var e_walletVal = $('.amount_value_e_wallet').val();
              var e_custmer_name = $('#customerName').val();
              var e_transactionNum = $('#transactionRef').val();

              $('#customerName').on('input', function () {
                $('#customer_name_payment').val($(this).val())
              })

              $('#transactionRef').on('input', function () {
                $('#ref_number').val($(this).val())
              })

              $('.submitEWallet').click(function () {
                // console.log($('.amount_value_e_wallet').val())
                // console.log(toExecute)
                if ($('.amount_value_e_wallet').val() == toExecute) {
                  $('#paidText').val(e_walletVal)
                  toProceed()
                  $('#ewallet_modal').hide();
                } else {
                  $('#paidText').val($('.amount_value_e_wallet').val())
                  $('#fomattedPaidText').val($('.amount_value_e_wallet').val())
                  $('#ewallet_modal').hide();
                }

              })
            } else if (returnString == 'debit/credit') {
              console.log('sdfsdfsdfsd');
              $('#cc_modal').show();
              $('.ccnumber').focus();
              $('.cc_debit_amount').val(toExecute)
              
              $('.submitCC').click(function() {
                var cc_debit_amount = $('.cc_debit_amount').val();
                if ($('.cc_debit_amount').val() == toExecute) {
                  $('#paidText').val(cc_debit_amount)
                  customer_accountNum = $('#account_number_card').val();
                  if(customer_accountNum != '') {
                    toProceed()
                    $('#cc_modal').hide();
                  } else {
                    $('#cc_modal').hide();
                  }
                } 
              }) 
            } 
        }
      // ---------------------------------------------------
      
          $(document).off('keydown.saveTransactions')
          if ((parseFloat(change).toFixed(2) >= 0 || totalToPay == 0)) {
            if (totalToPay != 0 || totalToPay != '0' && coupon_value == 0) {
              selectPaymentMethod(cashButton, function(returnString) {
                if (returnString == 'cash' || returnString == 'credit') {
                   // $(document).on('keydown.saveTransactions', function (e) {
                    $(document).off('keydown.keyPrint', '#paidText');
                    // if (e.which === 13) {
                      console.log('entered here')
                      if ($('.paymentMethod_btn button').hasClass('selectBtnPaymentMethod') && parseFloat($('#changeVal_input').val()) < 0) {
                        splitFunction()
                        console.log('Split Here')
                      } else {
                        var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g, "");
                        var rAmount = $('.totalReturnAmount').text()
                        if (returnAmountText > 0) {
                          couponModal()
                          $('.couponAmt').text(rAmount)
                          var r_id = $('.receipt_id').text();
                            receiptTransactionID = $('.receiptId').text();
                          $(document).on('click', '.saveButtonDate', function () {
                            var selectedData = "1 DAY";
                            $('#coupon_Modal').hide()
                            toProceed() 
                            createCoupon(returnAmountText, r_id, selectedData)
                          })
                        } else {
                          toProceed()
                        } 
                      // }
                    }
                // })
                } else if (returnString == 'void') {
                  voidProducts();
                  $("#payCashModal").hide();
                } else {
                  forEwalletAndCreditDebit(returnString);
                }
              });

            } else {
              
              var returnAmountText = $('.totalReturnAmount').text().trim().replace(/[^0-9.-]+/g, "");
              var rAmount = $('.totalReturnAmount').text()
              if (returnAmountText > 0) {
                couponModal()
                $('.couponAmt').text(rAmount)
                var r_id = $('.receipt_id').text();
                  receiptTransactionID = $('.receiptId').text();
                $(document).on('click', '.saveButtonDate', function () {
                  var selectedData = "1 DAY";
                  $('#coupon_Modal').hide()
                  toProceed() 
                  createCoupon(returnAmountText, r_id, selectedData)
                })
              } else {
                $('#toProceedModalCoupon').show();
                $('.cancelBtnWarningCuopon, #closeBtnCouponPayment').click(function() {
                  $('#toProceedModalCoupon').hide();
                })

                if($('#toProceedModalCoupon').is(':visible')) {
                  $('.continuePayment').click(function() {
                    toProceed()
                    $('#toProceedModalCoupon').hide();
                  })
                }
              } 
            }

          } else {
            if (change < -1) {
              selectPaymentMethod(cashButton, function(returnString) {
              });
              splitFunction()
            } else {
              selectPaymentMethod(cashButton, function(returnString) {
                if(returnString == 'void') {
                  $('#void_btn').click()
                } else {
                  forEwalletAndCreditDebit (returnString)
                }
              });
            }
          }
        }
      })


      if (selectedRow.length == 0 || selectedRow.length > 0) {
        price = selectedRow.data('prices');
        qty = selectedRow.data('qty');
        amount = parseFloat(totalAmount).toFixed(2);
        discounted = parseFloat(amount - totalDiscount).toFixed(2);
        $('#amount_text').text(addCommas(amount));
        $('#discount_text').text(addCommas(parseFloat(totalDiscount).toFixed(2)));
        addCommas($('#coupon_text').text());

        // toExecute = discounted;
      }

      // if the customer id is equal to 6 execute the code
      if ($('#userId').val() === '6') {
        $("#btnDiscount").prop("disabled", false);
        $('#btnDiscount').click(function () {
          Swal.fire({
            title: "Discount",
            text: "Enter discount amount for regular customer",
            input: "text",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Enter amount",
            animation: "slide-from-top",

            inputValidator: function (value) {
              return new Promise(function (resolve, reject) {
                if (value === "") {
                  reject("You need to write something!");
                } else {
                  resolve();
                }
              });
            }

          }).then(function (result) {
            if (result.isConfirmed) {
              $('#regular_dis').val(result.value);
              var defaultValDis = $('#discount_text').text();
              var defaultValTotal = $('#totalPayments').text();
              var passValToText = parseFloat(result.value) + parseFloat(defaultValDis);
              var passValToBePaid = parseFloat(defaultValTotal) - parseFloat(result.value);
              $('#discount_text').text(passValToText);
              $('#totalPayments').text(passValToBePaid);
              toExecute = parseFloat($('#totalPayments').text()).toFixed(2);
              var inputBox = $("#paidText");
              if (inputBox.length) {
                inputBox.focus().select();
              }
            }
          });
        });
      }

      var subTotal = $('#total').text();

      // $('#totalPayments').text(discounted);
      $('#totalPayments').text(parseFloat(toExecute).toFixed(2));
      var fomatText = $('#totalPayments').text()

      $('#totalPayments').text(addCommas(fomatText))
      var finalTotal_payment = $('#totalPayments').text(); // I fucking change this into string (call this variable convert to float or call removeCommas function)


      // if there is no customer execute the code
      if ($('#customer_id').val() != '') {
        $('#customers_discount_per').val(partial_discount_per);
        $('#userId').val(partial_customer);
        var totalValue = parseFloat(totat_v);
        console.log(totat_v, ' sdfdfdfdf')
        var discount = parseFloat(totalValue * (partial_discount_per / 100)).toFixed(2);
        textDis = discount
        
        $('#customerFullname').text();
        $('#customerDiscount').val(textDis);
        $('#discount_text').text(textDis);
        $('#customerFullname').text(fNamecustomer);
        $('#dstype').text(customerDisType)
        toExecute = parseFloat(removeCommas(totalPayment) - removeCommas(discount) - removeCommas(coupon_value)).toFixed(2);
        $('#totalPayments').text(addCommas(toExecute));
      }

      // Get Customer List for discoutn
      $('#customersList').click(function () {
        getAllCustomer();
        partialDis = parseFloat($('#discount_text').text()) || 0;

        $('#select_customer').click(function () {
          customer_id = $('.customers-row.selected').data('cusid');
          customer_name = $('.customers-row.selected').data('cusfname');
          custiomer_discount = $('.customers-row.selected').data('discount');
          fNamecustomer = $('.customers-row.selected').data('cusfullname');
          customerDisType = $('.customers-row.selected').data('custype');
          disAm = $('.customers-row.selected').data('dis');
          userId = $('.customers-row.selected').data('userid');
          vat_Sales = $('#vat_Sales').val();


          $('#customer_id').val('customer_id');
          $('#customer_discount').val(custiomer_discount);
          $('#fNamecustomer').val(fNamecustomer);
          $('#c_name').text(customer_name);
          $('#customerDisType').val(customerDisType);
          $('#customerListModal').hide();

          totalVatSales = $('#vat_sales').val();
          totalVat = parseFloat(totalVatSales * 0.12).toFixed(2);
          fcustomer_dis = parseFloat((totalVatSales * (disAm / 100)) + parseFloat(partialDis)).toFixed(2);
          partialAmount = parseFloat(parseFloat(removeCommas(finalTotal_payment)).toFixed(2) - fcustomer_dis) || 0;


          var selectedCustomer = $(this).text();
          $('#customerList').modal('hide');
          $("#payCashModal").show();
          $('#customerFullname').text(fNamecustomer);
          $('#dstype').text($('.customers-row.selected').data('dtype'));

          $('#discount_text').text(addCommas(fcustomer_dis));
          textDis = removeCommas($('#discount_text').text()); // Customer discount amount
          // console.log(textDis)
          $('#totalPayments').text((parseFloat(partialAmount).toFixed(2)));
          $('#userId').val(userId);

          toExecute = parseFloat($('#totalPayments').text()).toFixed(2);  // this is your final total value if you select a customer

          change = $("#paidText").val() - toExecute;
          $('#totalChange').text(parseFloat(change).toFixed(2));

          $("#fomattedPaidText").focus().select();
          if (userId != 6) {
            $("#btnDiscount").prop("disabled", true);
          } else {
            $("#btnDiscount").prop("disabled", false);
            $('#discount_text').text('0.00');
            textDis = removeCommas($('#discount_text').text());
          }

          $('#totalPayments').text(addCommas(toExecute))
        });
      });


      $('#fomattedPaidText').on('input', function () {
        // toExecute = parseFloat(removeCommas($('#totalPayments').text())).toFixed(2); 
        var formattedValue = $(this).val(); 
        var inputValue = parseFloat(removeCommas(formattedValue));
        if (inputValue >= toExecute) {
          $("#cash").prop("disabled", false);
          $("#printBtn").prop("disabled", false);
        } else {
          // $("#printBtn").prop("disabled", true);
        }

        if (!isNaN(inputValue)) {
          formatNumber(this, $('#paidText'), $('#fomattedPaidText'));
          change = (inputValue - toExecute).toFixed(2);
          $('#changeVal_input').val(change);
          $('#totalChange').text(addCommas(change));

          if (change < 0) {
            $('.phpChange').text('PHP ' + addCommas(change)).addClass('text-danger').css('font-weight', 'bold')
            // $('#totalChange').text(addCommas(change)).addClass('text-danger').css('font-weight', 'bold');
          } else {
            $('.phpChange').text('PHP ' + addCommas(change)).removeClass('text-danger').addClass('text-success').css('font-weight', 'bold')
            // $('#totalChange').text(addCommas(change)).removeClass('text-danger').addClass('text-success').css('font-weight', 'bold');
          }
        } else {
          $('#fomattedPaidText').val(0);
          var inputBox = $("#fomattedPaidText");
          inputBox.focus().select();
        }
      });
    }

  }
  function returnproducts(quantityInput, product_id, payment_id, isFirstTransaction) {
    axios.post(`api.php?action=insertReturnExchange`, {
      return_qty: quantityInput,
      prod_id: product_id,
      payment_id: payment_id
    }).then(function (response) {
      console.log(response);
    }).catch(function (error) {
      console.log(error);
    })
  }
  function createCoupon(returnAmountText, r_id, selectedData) {
    axios.post('api.php?action=insertAdata', {
      r_id: r_id,
      returnAmountText: returnAmountText,
      selectedData: selectedData
    }).then(function (response) {
      if ($('.transactionCheckbox:checked').length > 0 || $('#selectAllCheckbox').is(':checked')) {
        let isFirstTransaction = true;
        $('.transactionCheckbox:checked').each(function (index) {
          var $row = $(this).closest('tr');
          var quantityInput = $row.find('.quantity-input').val();
          var product_id = $row.find('.productid').text();
          var payment_id = $row.find('.paymentid').text();
          var product_price = $row.find('.priceData').text();
          returnproducts(quantityInput, product_id, payment_id, function () {
          }, isFirstTransaction);
          isFirstTransaction = false;
        });
      }
      $.ajax({
        url: "./coupon-receipt.php",
        type: "GET",
        data: {
          r_id: r_id,
          first_name: 'Admin',
          last_name: 'Admin',
        },
        success: function (data) {
          console.log('success');


        },
        error: function (xhr, status, error) {
          console.error(error);

        }
      });
    }).catch(function (error) {
      console.log(error)
    })
  }

  function discountItem() {
    $(document).on('keydown.discontItem', '#itemDiscount', function (e) {
      var discountType = $('#discounVal').val();
      var itemDiscount = $('#itemDiscount').val();
      var discount_item_sub = $('#discount_item_sub').val();
      var discount_item_id = $('#discount_item_id').val();
      var transac_num = $('#transac_num').val();
      if ($('#discount_modal').is(':visible')) {
        if (e.which === 13) {
          axios.put('api.php?action=discountUpdate', {
            'transac_num': transac_num,
            'discountType': discountType,
            'itemDiscount': itemDiscount,
            'discount_item_sub': discount_item_sub,
            'discount_item_id': discount_item_id
          })
            .then(function (response) {
              console.log(response.data)
              $('#discount_modal').hide();
              fetchDataAndUpdateTable();
            })
            .catch(function (error) {
              console.log(error);
            })

        }
      }
    })
  }



  function addCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function removeCommas(numberString) {
      // Check if the input is a valid number string
      if (typeof numberString !== 'string' || isNaN(parseFloat(numberString))) {
          // If not, return 0 or handle the error based on your use case
          return 0;
      }
      // Remove commas and parse the string to float
      return parseFloat(numberString.replace(/,/g, ''));
  }


  function getAllCustomer() {
    $('#customerListModal').show();
    axios.get('api.php?action=getAllCustomerUser')
      .then(function (response) {
        var customers = response.data.customer;
        $('#CustomersList tbody').empty();
        $.each(customers, function (index, customer) {
          if (customerIndex.indexOf(customer.id) === -1) {
            var row = '<tr class="customers-row"' +
              'data-cusid="' + customer.userId + '"' +
              'data-cusfname="' + customer.first_name + '"' +
              'data-discount="' + customer.discount_amount + '"' +
              'data-cusfullname="' + customer.first_name + ' ' + customer.last_name + '"' +
              'data-custype="' + customer.name + '"' +
              'data-dtype="' + customer.name + '"' +
              'data-dis="' + customer.discount_amount + '"' +
              'data-userid="' + customer.userId + '"' +
              'id="rowCustomer"' +
              '>' +
              '<td style="color: #fff">' + customer.userId + '</td>' +
              '<td style="color: #fff">' + customer.first_name + ' ' + customer.last_name + '</td>' +
              '<td style="color: #fff">' + customer.name + '</td>';

            row += '</tr>';
          }

          $('.CustomersList tbody').append(row);
        });

        $('#CustomersList tbody tr:last').click();
      });

    $(document).off('keydown.selectCustomer')
    $(document).on('keydown.selectCustomer', function (e) {
      switch (e.which) {
        case 38:
          moveSelection('up');
          e.preventDefault();
          break;
        case 40:
          moveSelection('down');
          e.preventDefault();
          break;
        case 13:
          selectRow();
          break;
        default:
          return;
      }
      e.preventDefault();
    });

    $('#CustomersList tbody').on('click', '.customers-row', function () {
      $('.customers-row').removeClass('selected');
      $(this).addClass('selected');
      customerRowIndex = $(this).hasClass('selected') ? $(this).index() : -1;
    });

    $('#select_customer').click(function () {
      selectRow();
    });

    if ($('#customerListModal').is(':visible')) {
      function moveSelection(direction) {
        var currentIndex = customerRowIndex + direction;
        var rows = $('.customers-row');

        if (currentIndex >= 0 && currentIndex < rows.length) {
          $('.customers-row').removeClass('selected');
          $(rows[currentIndex]).addClass('selected');
          customerRowIndex = currentIndex;
        }
      }
    }


    function selectRow() {
      customer_id = $('.customers-row.selected').data('cusid');
      customer_name = $('.customers-row.selected').data('cusfname');
      custiomer_discount = $('.customers-row.selected').data('discount');
      fNamecustomer = $('.customers-row.selected').data('cusfullname');
      customerDisType = $('.customers-row.selected').data('custype');
      disAm = $('.customers-row.selected').data('dis');
      userId = $('.customers-row.selected').data('userid');
      vat_Sales = $('#vat_Sales').val();

      // var tangInaMo = (vat_Sales * (custiomer_discount / 100));
      $('#customer_id').val(customer_id);
      $('#customer_discount').val(custiomer_discount);
      $('#fNamecustomer').val(fNamecustomer);
      $('#c_name').text(customer_name);
      $('#customerDisType').val(customerDisType);
      $('#customerListModal').hide();
    }

    $('.closeCustomerBtn').click(function () {
      $('#addCustomerModal').hide();
    })

    $('#closeCustomerBtnMain').click(function () {
      $('#customerListModal').hide();
    })
  }

  var totalTopay = 0;

  function formatNumber(input, idInput, formattedInput) {
    let numericValue = $(input).val().replace(/[^0-9.]/g, '');
    let formattedValue = numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    idInput.val(numericValue);
    formattedInput.val(formattedValue);
  }

  function highlightSelectedResult(result, selected_result) {
    result.removeClass(selected_result);
    if (selectedProdIndex >= 0 && (selectedProdIndex < result.length)) {
      result.eq(selectedProdIndex).addClass(selected_result);
    }
  }


 
  

  $(document).ready(function () {

    toVerifyZread();
    renderTime();
    var sysmteInformation = `
    <div class="row systemInformation">
      <div class="col-sm-6" style="font-family: Century Gothic; font-size: small; color: #ffff; text-align: left;">
        <label style="color: #BDBDBD; font-weight: bold">Store:</label>
        <label style="color: #BDBDBD; font-weight: bold">Cashier:</label>
        <label style="color: #BDBDBD; font-weight: bold">ID No.:</label>
        <label style="color: #BDBDBD; font-weight: bold">Time In / Out:</label>
        
        <label style="color: #BDBDBD; font-weight: bold">Date & Time:</label>
        <label style="color: #BDBDBD; font-weight: bold">Machine Name:</label>
        <label style="color: #BDBDBD; font-weight: bold">Connection Status:</label>
        <label style="color: #BDBDBD; font-weight: bold">Device ID:</label>
        <label style="color: #BDBDBD; font-weight: bold">Software Version:</label>
        <!-- <label style=">Date $ Time:</p> -->
      </div> <br> <br>

      <div class="col-sm-6" style="font-family: Century Gothic; font-size: small; color: #ffff; text-align: left;">
        <label style="color: #E0E0E0">TinkerPro Retail Store</label>
        <label style="color: #E0E0E0"><?= $firstName . " " . $lastName ?></label>
        <label style="color: #E0E0E0">12323-11</label>
        <label style="color: #E0E0E0"><span style="margin-right: 5px">09:00 AM</span> | <span>06:00 PM</span></label>
        
        <label style="color: #E0E0E0"><span id="dateDisplay" style="margin-right: 5px"></span> | <span id="curTime"></span></label>
        <label style="color: #E0E0E0">POS (local)</label>
        <label style="color: #E0E0E0">Offline</label>
        <label style="color: #E0E0E0">213213214353454</label>
        <label style="color: #E0E0E0">1.05</label>
      </div>
    </div>         
  `;

    var menuButtons = `
  <div class="col-lg-12 d-flex" style="border: 1px solid #FF6700; height: 30px;">
    <div style="position: relative; width: 100%; margin-right: 10pxl; padding: 5px">
      <label style="font-size: small; color: #FF6700">MENU</label>
    </div>
    <button id="closeBtnMenu" style="color: #FF6700; border: none; width: auto">x</button>
  </div>

  <ul class="menu_list">
      <li><button name="management" class="custom-form btn btn-secondary"> 
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/>
      </svg>Management</button></li>
      <li><button id="view_sales_history" class="custom-form btn btn-secondary"><svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
      <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
      <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
      <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
      </svg>View Sales History</button></li>
      <li><button class="custom-form btn btn-secondary pending_ordersBtn">
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
      <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
      </svg>View Pending Orders</button></li>
      <li><button class="custom-form btn btn-secondary cashInOutBtn">
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
      <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
      <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
      <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
      </svg>Cash-in/Cash-out</button></li>
      <li><button class="custom-form btn btn-secondary endOfDay">
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-day" viewBox="0 0 16 16">
      <path d="M4.684 11.523v-2.3h2.261v-.61H4.684V6.801h2.464v-.61H4v5.332zm3.296 0h.676V8.98c0-.554.227-1.007.953-1.007.125 0 .258.004.329.015v-.613a2 2 0 0 0-.254-.02c-.582 0-.891.32-1.012.567h-.02v-.504H7.98zm2.805-5.093c0 .238.192.425.43.425a.428.428 0 1 0 0-.855.426.426 0 0 0-.43.43m.094 5.093h.672V7.418h-.672z"/>
      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
      </svg>End of Day</button></li>

      <li><button class="custom-form btn btn-secondary cashCountDrawer">
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
        <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z"/>
      </svg>Cash Count</button></li>

      <li><button class="custom-form btn btn-secondary locked_pos">
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
        <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
        <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/>
      </svg>Lock POS Machine</button></li>
      <li><button class="custom-form btn btn-secondary cashier_break">
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
      <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
      <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
      </svg>User Break-time</button></li>
      <li><button class="custom-form btn btn-secondary user_logout">
      <svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
      <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
      </svg>User Logout</button></li>
  </ul>

  <div class="row">
    <div class="col-lg-12">
      <div class="d-flex">
        <button class="custom-form btn btn-secondary text-center settings_button_menu" >
        <svg style="margin-right: 5px; margin-bottom: 5px" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
        </svg>SETTINGS</button>
        <button class="custom-form btn btn-secondary text-center  pos_shutdown_btn" >
        <svg style="margin-right: 5px; margin-bottom: 5px;" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>SHUTDOWN POS</button>
      </div>
    </div>
  </div>
  `;



    fetchDataAndUpdateTable();
    $("#voidModalButton").click(function () {
      voidProducts()
    });

    $('#menuModalButton').click(function (event) {
      $('.toSwitchUI').html(menuButtons)
      $('#view_sales_history').click(function (event) {
        event.stopPropagation();
        $('#salesHistoryModal').show();
        runPrintPreview_history();
        getAllSalesHistory();
        $('#menuModal').hide();
      });

      // view pending orders
      $('.pending_ordersBtn').click(function () {
        ListOfSavedOrder()
        $('#menuModal').hide();
      })

    $('button[name="management"]').click(function(){
     window.open('/tinkerpro_admin/login', '_blank');
   });

  
      // User logout
      $('.user_logout').click(function () {
        $("#logoutModal").show();
      })

      //  cash in cash out
      var submitButtonCancel = `
        <button disabled class="btn btn secondary submit_cash_btn">[ENTER] SUBMIT</button>
    `;
      $('.cashInOutBtn').click(function (event) {
        var cashForm = `
        <div class="row cashInOutForm">
            <div class="col-lg-6 text-center">
                <h4 class="currentTimeAndTime"></h4>
                <label>Cannot be modified after <br> submission of entry</label>
            </div>

            <div class="col-lg-6 d-block input_amount">
                <input require type="number" autocomplete="false" class="w-100 cash_amount" autofocus placeholder="(Php) ENTER AMOUNT">
                <textarea require class="w-100 text_reason" placeholder="(TEXT) ENTER YOUR REASON" name="reason_note" id="reason_note" cols="20" rows="10"></textarea>
            </div>
        </div>`;

        var tableHistoryCash = `
            <table class="cashInOutHistoryTable table table-borderless m-0 text-light ">
                <tbody>
                    
                </tbody>
            </table>
        `;

        $('#cashInOut').show();
        $('.cashInContainer').append(tableHistoryCash);

        if ($('#cashInOut').is(':visible')) {
          getCashInCashOutHistory();
          var user_namef = $('#firstName').val()
          $('.user_name').text('[' + 'USER: ' + user_namef + ']')
        }

        $('.options-cash-in-out button').click(function () {
          // console.log($(this).val());
          $('.cashType_selected').val($(this).val());
          $('.options-cash-in-out button').removeClass('selected');
          $(this).addClass('selected');
          $('.cashInOutHistoryTable').remove();

          if ($('.cashInContainer .cashInOutForm').length === 0) {
            $('.options-cash-in-out button').removeClass('selected');
            $(this).addClass('selected');
            $('.cashInOutHistoryTable').remove();

            $('.cashInContainer').append(cashForm);
            $('.buttonsSubmitCancel').append(submitButtonCancel);
            var curdate = dateAndTimeFormat(currentDate()).formatted_date + ' [' + dateAndTimeFormat(new Date).formatted_time + ']'
            $('.currentTimeAndTime').text(curdate)


            $('.text_reason').on('input', function () {
              if ($(this).val() !== '') {
                $('.submit_cash_btn').prop('disabled', false);
                $('.submit_cash_btn').addClass('enabled');
              } else {
                $('.submit_cash_btn').prop('disabled', true);
                $('.submit_cash_btn').removeClass('enabled');
              }
            });

            $('.submit_cash_btn').click(function () {
              if (!$('.submit_cash_btn').prop('disabled')) {
                var cashType_val = $('.cashType_selected').val();
                var cashInOrOut = cashType_val;
                var cash_amount = $('.cash_amount').val();
                var reason_note = $('.text_reason').val();
                var cashierId = $('#user_id').val();

                axios.post('api.php?action=postCashInOut', {
                  'cash_in_out': cashInOrOut,
                  'cash_amount': cash_amount,
                  'reason_note': reason_note,
                  'cashierId': cashierId,
                })
                  .then(function (response) {
                    // console.log(response.data);
                    $('#cashInOut').hide();
                    window.location.reload();
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
              }
            });
          }
        });
        $('#menuModal').hide();
      })


//---------------------------------------------------------------------------------------//
      var existingReport = [];
      // End of day
      $('.endOfDay').click(function () {
        $('#endOfDayModal').show();
        axios.get('api.php?action=getAllZreading')
          .then(function(response) {
            var z_report = response.data.data;
            var grant_total = 0; 

            // Function to filter rows based on search input
            function filterRows(searchText) {
              $('.end_of_day_table tbody tr').each(function() {
                var rowData = $(this).text().toLowerCase();
                if (rowData.indexOf(searchText.toLowerCase()) === -1) {
                  $(this).hide();
                } else {
                  $(this).show();
                }
              });
            }

            $('.input_search_end_day').on('input', function() {
              var searchText = $(this).val();
              filterRows(searchText);
            });

            $.each(z_report, function(index, z_result) {
              existingReport.push(z_result.id);
              var formattedDateTime = dateAndTimeFormat(z_result.date_time);
              var formattedSales = addCommas(parseFloat(z_result.total_sales).toFixed(2));
              
              grant_total += parseFloat(z_result.total_sales); // Increment grant_total by the current total_sales
              
              var row = '<tr class="z_reading-row"' +
                  'data-zreference="' + z_result.ref_number + '" ' +  
                  '>' +
                  '<td colspan="2">' + z_result.ref_number + '</td>' +
                  '<td colspan="2">' + formattedDateTime.formatted_date + ' ' + formattedDateTime.formatted_time + '</td>' +
                  '<td colspan="2">' + (z_result.first_name + ' ' + z_result.last_name) + '</td>' +
                  '<td colspan="2">' + formattedSales + '</td>' + 
                  '<td colspan="2">' + addCommas(grant_total.toFixed(2)) + '</td>';
              row += '</tr>';
              $('.end_of_day_table tbody').append(row);
            });
            selectRow($('.z_reading-row').last());
          })
          .catch(function(error) {
            console.log(error);
          });

        var selectedRow_z_reading = null;

        function selectRow(row) {
          $('.z_reading-row.selected').removeClass('selected');
          selectedRow = row;
          selectedRow.addClass('selected');

          if (selectedRow && selectedRow.length > 0) {
            var tableContainer = $('.end_of_day_table');
            var scrollTo = selectedRow.offset().top - tableContainer.offset().top + tableContainer.scrollTop();
            tableContainer.animate({
              scrollTop: scrollTo
            }, 300);
          }
        }

        $('.end_of_day_table tbody').on('click', '.z_reading-row', function () {
          $('.z_reading-row').removeClass('selected');
          $(this).addClass('selected');
          selectRow($(this));
        });

        function moveSelection(direction) {
          if (selectedRow) {
            var nextRow = (direction === 'up') ? selectedRow.prev('.z_reading-row') : selectedRow.next('.z_reading-row');
            if (nextRow.length) {
              selectRow(nextRow);
            }
          } else {
            var rowToSelect = (direction === 'up') ? $('.z_reading-row').last() : $('.z_reading-row').first();
            selectRow(rowToSelect);
          }
        }

        $(document).off('keydown.selectRowZread')
        $(document).on('keydown.selectRowZread', function (e) {
          switch (e.which) {
            case 38:
              moveSelection('up');
              scrollToSelectedRow()
              e.preventDefault();
              break;
            case 40:
              moveSelection('down');
              e.preventDefault();
              scrollToSelectedRow()
              break;
            default:
              return;
          }
          e.preventDefault();
          e.stopPropagation();
        });

      });

// -------------------------------------------------------------------------------------------------//

      // Close button menu
      $('#closeBtnMenu').click(function () {
        $('.toSwitchUI').html(sysmteInformation)
        renderDate();
        renderTime();
      });


      // Locked POS

      $('.locked_pos').click(function () {
        var cashier_id = $('#user_id').val();
        var cashier_lastName = $('#lastName').val();
        var cashier_firstName = $('#firstName').val();

        window.location.assign('./locked.php?first_name=' + cashier_firstName + '&last_name=' + cashier_lastName + '&user_id=' + cashier_id);
      });

      // Cashier Break 
      $('.cashier_break').click(function () {
        var cashier_id = $('#user_id').val();
        var cashier_lastName = $('#lastName').val();
        var cashier_firstName = $('#firstName').val();

        window.location.assign('./break-user.php?first_name=' + cashier_firstName + '&last_name=' + cashier_lastName + '&user_id=' + cashier_id);
      });


//----------------------------------------------------------------------------------------------// 
      // Cash Count
      $('.cashCountDrawer').click(function() {
        $('#cashCountModal').show();

        // Function to filter rows based on search input
        function filterRows(searchText) {
          $('.cash_count_table tbody tr').each(function() {
            var rowData = $(this).text().toLowerCase();
            if (rowData.indexOf(searchText.toLowerCase()) === -1) {
              $(this).hide();
            } else {
              $(this).show();
            }
          });
        }

        $('.input_search_count_cash').on('input', function() {
          var searchText = $(this).val();
          filterRows(searchText);
        });

        var existingCashCount = [];
        axios.get('api.php?action=getCashCountable')
        .then(function(response) {
          var cashCountResult = response.data.data;
          cashCountResult.forEach(function(cashCountData) {
            var formattedDate = dateAndTimeFormat(cashCountData.date_time).formatted_date; 
            var formattedTime = dateAndTimeFormat(cashCountData.date_time).formatted_time; 
            var formattedSales = addCommas(parseFloat(cashCountData.total_sales).toFixed(2));
            var formattedCashCount = addCommas(parseFloat(cashCountData.totalCash).toFixed(2));
            var formattedDiff = addCommas(parseFloat(cashCountData.total_sales - cashCountData.totalCash).toFixed(2));

            if(existingCashCount.indexOf(cashCountData.id) === -1 ) {
              existingCashCount.push(cashCountData.id);
              
              var row = '<tr class="cash_count-row"' +
              'data-cashcountid="' + cashCountData.id + '" ' +  
                '>' +
                '<td colspan="2">' + (formattedDate + " | " + formattedTime) + '</td>' +
                '<td colspan="2">' + (cashCountData.first_name + ' ' + cashCountData.last_name) + '</td>' +
                '<td colspan="2">' + formattedSales + '</td>' +
                '<td colspan="2">' + formattedCashCount + '</td>' +
                '<td colspan="2" class="text-danger">' + formattedDiff + '</td>';
              row += '</tr>';
              $('.cash_count_table tbody').append(row);
            }
            selectRow($('.cash_count-row').last());
          });
  
        })
        .catch(function(error) {
          console.log(error);
        });
      })


    var selectedRow_z_reading = null;
    function selectRow(row) {
      $('.cash_count-row.selected').removeClass('selected');
      selectedRow = row;
      selectedRow.addClass('selected');

      if (selectedRow && selectedRow.length > 0) {
        var tableContainer = $('.cash_count_table');
        var scrollTo = selectedRow.offset().top - tableContainer.offset().top + tableContainer.scrollTop();
        tableContainer.animate({
          scrollTop: scrollTo
        }, 300);
      }
    }

    $('.cash_count_table tbody').on('click', '.cash_count-row', function () {
      $('.cash_count-row').removeClass('selected');
      $(this).addClass('selected');
      selectRow($(this));
    });

    function moveSelection(direction) {
      if (selectedRow) {
        var nextRow = (direction === 'up') ? selectedRow.prev('.cash_count-row') : selectedRow.next('.cash_count-row');
        if (nextRow.length) {
          selectRow(nextRow);
        }
      } else {
        var rowToSelect = (direction === 'up') ? $('.cash_count-row').last() : $('.cash_count-row').first();
        selectRow(rowToSelect);
      }
    }

    $(document).off('keydown.selectCountCash', '#cashCountModal')
    $(document).on('keydown.selectCountCash', '#cashCountModal', function (e) {
      switch (e.which) {
        case 38:
          moveSelection('up');
          scrollToSelectedRow()
          e.preventDefault();
          break;
        case 40:
          moveSelection('down');
          e.preventDefault();
          scrollToSelectedRow()
          break;
        default:
          return;
      }
      e.preventDefault();
      e.stopPropagation();
    });

//---------------------------------------------------------------------------------------------//

      // Settings
      $('.settings_button_menu').click(function () {
        var cashier_id = $('#user_id').val();
        var cashier_lastName = $('#lastName').val();
        var cashier_firstName = $('#firstName').val();
        window.location.assign('./settings-pos.php?first_name=' + cashier_firstName + '&last_name=' + cashier_lastName + '&user_id=' + cashier_id);
      });

    });

    $('.toSwitchUI').click(function (event) {
      $('.toSwitchUI').html(sysmteInformation)
        renderDate();
        renderTime();
    });

    highlightSelectedResult($(".result-item"), "selected_result")

    $('#searchModalButton').click(function () {
      searchProduct()
      $('.search_input_product').focus();
    })

    // Search Product
    var searchData = [];
    axios.get('api.php?action=getAllProducts')
      .then(function (response) {
        searchData = response.data.products.map(function (product) {
          return Object.values(product);
        });
      })
      .catch(function (error) {
        console.error('Error fetching data: ', error);
      });

    function showResults(results) {
      console.log(results,'212121')
      var resultsContainer = $("#search-results");
      resultsContainer.empty();
      if (results.length > 0) {
        $.each(results, function (index, result) {
          // var resultItem = $("<div class='result-item'>" + result[2] + " <span class='product_price' style='float: right'> &#8369;" + parseFloat(result[5]).toFixed(2) + " </span></div>");
          var resultItem = $("<div class='result-item' data-allresult='"+result+"'>" + result[2] +
            " <span class='product_price' style='float: right'> &#8369;" +
            parseFloat(result[5]).toFixed(2) +
            "</span><span hidden class='expiration_date' style='float: right; margin-right: 10px;'>" +
            result[30] + "</span></div>");

          resultItem.on("click", function () {

            $("#search-input").val(result[2]);
            var transactionNum = $("#transactionNum").val();
            var qty = $("#qty").val();
            var barcode = $("#search-input").val();
            var firstName = $("#firstName").val();
            var lastName = $("#lastName").val();
            var cashierId = $('#user_id').val();
            fetchDataAndUpdateTable();
            const expirationDate = new Date(result[30]);
            const today = new Date();
            if (expirationDate > today) {
              
              GetTotalTransaction(result[5])
            }
            else {
              console.log('expired');
            }
            
            intervalId = setInterval(fetchDataAndUpdateTable, 1);
            setTimeout(function () {
              clearInterval(intervalId);
            }, 1);
            $('#search-input').val('');
            $("#search-results").hide();
          
            // $(document).on('keydown.transactionTable');
            axios.post('api.php?action=addToTransaction', {
              'transactionNum': transactionNum,
              'qty': qty,
              'barcode': barcode,
              'cashier' : cashierId,
            }).then(function (response) {
              
              fetchDataAndUpdateTable();
              $('#search-input').val('');
              $('#search-input').val('');

              // if the product is expired
              if (response.data.error) {
                $('#exampleModal2').show();
                $('#p_name').text(result[2]);
                var row = '<tr class="text-center" id="ex_product">' +
                  '<td style="color: red">' + result[0] + '</td>' +
                  '<td style="color: red">' + result[2] + '</td>' +
                  '<td style="color: red">' + result[17] + '</td>' +
                  '<td style="color: red">' + result[28] + '</td>' +
                  '<td style="color: red">' + 1 + '</td>' +
                  '<td style="color: red">' + result[24] + '</td>' +
                  '<td style="color: red">' + result[17] + '</td>' +
                  '<td style="color: red">' + 1 + '</td>' +
                  '</tr>'
                $('#ex_product td').empty();
                $('#expiredTable tbody').html(row);

                $('#continueBtn').click(function () {
                  $('#exampleModal2').hide();
                });
                $('#exampleModal2').show();
                $('#search-input').val('')
              }
              // ends here
            })
            resultsContainer.hide();
          });

          resultItem.on("mouseover", function () {
            selectedProdIndex = index;
            highlightSelectedResult($(".result-item"), "selected_result")
          });

          resultItem.on("mouseout", function () {
            selectedProdIndex = -1;
            highlightSelectedResult($(".result-item"), "selected_result")
          });
          resultsContainer.append(resultItem);
        });

        resultsContainer.show();
      } else {
        resultsContainer.hide();
      }
    }


    $('#closeCustomerBtn').click(function () {
      $('#customerListModal').hide();
    });

    $('#closeBtnCustomerL').click(function () {
      $('#customerListModal').hide();
    });

    // Customer List
    $('#CustomerListBtn').click(function () {
      getAllCustomer();
    })


    $('#paymentModalButton').click(function () {
      var returnAmountText = $('.totalReturnAmount').text();
      var totalAmountText = $('#totalPayment').text();
      var formatTotal;
      if (returnAmountText !== null && returnAmountText !== '') {

        if (returnAmountText.replace(/[^\d.-]/g, '') > 0) {
          var tableRows = $('.selectable-row')
          if (tableRows.length == 0) {
            modifiedMessageAlert('error', 'You have to add product first!', false, false);
          } else {
            checkModal();
            if ($('#check_modal').is(':visible')) {
              var rt = returnAmountText.replace(/[^\d.-]/g, '')
              var at = totalAmountText.replace(/[^\d.-]/g, '')
              var totalAmt = parseFloat(rt) + parseFloat(at);
              spanTotal = new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
              }).format(at);
              var spanRTA = new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
              }).format(totalAmt);
              $('.spanReturnAmount').text('[' + spanRTA + ']');
              $('.spanAmount').text('[' + spanTotal + ']')
              $('.input_paid').prop('readonly', true);
              paymentFuntion();
              $('.yesBtn').on('click', function () {
                $('#check_modal').hide();
                var amount = $('#amount_text').text().replace(/[^\d.-]/g, '');
                $('.spanAmount').text(formatTotal)
                formatTotal = new Intl.NumberFormat('en-PH', {

                  currency: 'PHP'
                }).format(amount);
                $('.coupon_text').text(formatTotal);
                $('#couponValue').val(removeCommas(amount));
                $('#coupon_val_to_add').val(removeCommas(amount));
                paymentFuntion();
                $('.totalPayments').text(0);
                totalTopay = $('.totalPayments').text();
              })
            }
          }
        } else {
          paymentFuntion();
          var totalAmount = $('.totalPayments').text().trim();
          var amount = $('#amount_text').text().replace(/[^\d.-]/g, '');;
          var returnAmountText = $('.totalReturnAmount').text().trim();
          var numericText = returnAmountText.replace(/[^\d.-]/g, '');
          var parsedNumber = parseFloat(numericText);
          var coupon = parseFloat(amount) + parseFloat(parsedNumber)

          // console.log(coupon,'coupon kini')
          var formatCoupon = new Intl.NumberFormat('en-PH', {

            currency: 'PHP'
          }).format(coupon);
          // $('#totalRefundAmount').text(formatCoupon);
          $('.coupon_text').text(formatCoupon);

          var total = parseFloat(amount) - parseFloat(coupon);
          var totals = new Intl.NumberFormat('en-PH', {
            currency: 'PHP'
          }).format(total);
          $('#totalRefundAmount').text(total);

          $('#coupon_val_to_add').val(coupon);
          paymentFuntion();
          $('.totalPayments').text(totals);
        }
      } else {
        paymentFuntion();
      }
    });

    function isValidJSON(str) {
      try {
        JSON.parse(str);
      } catch (e) {
        return false;
      }
      return true;
    }


    // Save Orders      
    $('#saveButton').click(function () {
      saveOrders();
      $('#save_yes').click(function () {
        var tableRows = $('.selectable-row')
        if (tableRows.length == 0) {
          toBlockSave()
        } else {
          ToSaveOrder()
        }
      })
    })

    $("#search-input").off("keydown.selectSearchResult")
    $("#search-input").on("keydown.selectSearchResult", function (e) {

      var qty = $("#qty").val();
      var qr_num = $("#search-input").val()

      isValidJSON(qr_num)
      if (isValidJSON(qr_num)) {
        var jsonData = JSON.parse(qr_num);
        var couponNumber = jsonData.couponNumber;
        if (couponNumber) {
          getCouponsValidity(couponNumber);
          $("#search-input").val("");
        }
      }

      if ($("#search-results").is(":visible")) {
        if (e.which === 38) { // Up arrow key

          e.preventDefault();
          selectedProdIndex = Math.max(selectedProdIndex - 1, 0);
          highlightSelectedResult($(".result-item"), "selected_result");
        }
        else if (e.which === 40) { // Down arrow key
          e.preventDefault();
          selectedProdIndex = Math.min(selectedProdIndex + 1, $(".result-item").length - 1);
          highlightSelectedResult($(".result-item"), "selected_result");
        }
        else if (e.which === 13) { // Enter key
          var selectedValue;
          if (selectedProdIndex == 0 || selectedProdIndex != 0) {
            var resultsContainer = $("#search-results");
            var priceWithPeso = $('.product_price').eq(selectedProdIndex).text();
            var expirationDate = $('.expiration_date').eq(selectedProdIndex).text();
            console.log(expirationDate)
            var test = $(".result-item span").html('');
            selectedValue = $(".result-item").eq(selectedProdIndex).text().trim(); //product_price
            var priceAsString = priceWithPeso.replace(/\₱\s*/g, '').replace(/\.00$/, '');

            const expirationDates = new Date(expirationDate);
            const today = new Date();
            
            if (expirationDates > today) {
              if (qty_t) {
                a_total = qty_t * priceAsString
                qty_t = '';

                GetTotalTransaction(a_total);
              } else {
                GetTotalTransaction(priceAsString);
              }

            } else {
              
              // do nothing
            }

            $(document).on('keydown.transactionTable');
          }


          $("#search-results").hide();
          $("#search-input").val(selectedValue);

          var transactionNum = $("#transactionNum").val();
          var barcode = selectedValue;
          var firstName = $("#firstName").val();
          var lastName = $("#lastName").val();
          var cashierId = $('#user_id').val();
          axios.post('api.php?action=addToTransaction', {
            'transactionNum': transactionNum,
            'qty': qty,
            'barcode': barcode,
            'cashier' : cashierId,
          }).then(function (response) {
            fetchDataAndUpdateTable();
            $('#search-input').val('');
            $('#search-input').val('');

            if (response.data.error) {
              $('#exampleModal2').show();
              var selectedResult = $('.result-item').data('allresult');
              var result = selectedResult.split(',');
              var row = '<tr class="text-center" id="ex_product">' +
                  '<td style="color: red">' + result[0] + '</td>' +
                  '<td style="color: red">' + result[2] + '</td>' +
                  '<td style="color: red">' + result[17] + '</td>' +
                  '<td style="color: red">' + result[28] + '</td>' +
                  '<td style="color: red">' + 1 + '</td>' +
                  '<td style="color: red">' + result[24] + '</td>' +
                  '<td style="color: red">' + result[17] + '</td>' +
                  '<td style="color: red">' + 1 + '</td>' +
                  '</tr>'
                $('#ex_product td').empty();
                $('#expiredTable tbody').html(row);
              $('#search-input').val('')
            }
          })
          $("#search-results").hide();
        }
      }
    });

    $("#search-input").on("input", function () {
      var searchTerm = $(this).val().toLowerCase();
      if (searchTerm === '') {
        $("#search-results").hide();
        // $(document).on('keydown.transactionTable');
        return;
      }

      var filteredResults = searchData.filter(function (result) {
        return result.some(function (value) {
          return String(value).toLowerCase().includes(searchTerm);
        });
      });
      showResults(filteredResults);
    });

    // Event listener to hide results on document click
    $(document).on("click", function (event) {
      if (!$(event.target).closest("#search-container").length) {
        $("#search-results").hide();
        $(document).on('keydown.transactionTable');
      }
    });
  });


  function getCouponsValidity(inputsData) {
    axios.get(`api.php?action=getCouponsValidity&qr_num=${inputsData}`)
      .then(function (response) {
        var c_amount = response.data.coupon[0]?.c_amount;
        var c_id = response.data.coupon[0]?.id;
        var coupon = response.data.coupon[0];
        var exprd_date = response.data.coupon[0]?.expiry_dateTime;

        var currentDate = new Date();
        var expirationDate = new Date(exprd_date);
        var usedDate = response.data.coupon[0]?.used_date;
        var isUse = response.data.coupon[0]?.isUse;

        var formmatedUsedDate = dateAndTimeFormat(usedDate).formatted_date
        var formmatedUsedTime = dateAndTimeFormat(usedDate).formatted_time

        if (currentDate > expirationDate) {
          expiredModal()
        }
        else {
          if (isUse == 0) {
            validModal(c_amount, exprd_date);
            $('#coupon_val_input').val(parseFloat(removeCommas(c_amount)).toFixed(2));
            $('#coupon_id_val').val(c_id);
          }
          else if (inputsData != response.data.coupon[0]?.qrNumber) {
            modifiedMessageAlert('error', 'Coupon not found!', false, false)
          }
          else {
            modifiedMessageAlert('error', 'Your coupon is already been used on ' + formmatedUsedDate + ' | ' + formmatedUsedTime, false, false)
          }
        }
      }).catch(function (error) {
        modifiedMessageAlert('error', 'Coupon not found!', false, false)
      });
  }

  $(document).ready(function () {
    $('#closeBtnError').click(function () {
      $('#exampleModal2').hide();
    })

    $('#discountModalBtn').click(function () {

      $('#discount_customer').on('change', function () {
        var cus_amount = $(this).find(':selected').data('aaa');
        $('#other_discount').text(cus_amount + '%');

        if (cus_amount === undefined) {
          cus_amount = 0;
          $('#other_discount').text(cus_amount + '%');
          if (!$(event.target).is(inputBoxDis)) {
            inputBoxDis.focus();
          }
        }
      });

      // var hasClass = $('#tab2-tab').hasClass('active');
      var selectedRow = $('.selectable-row.selected');
      var tableRow = $('.selectable-row');
      $('#tab2-tab').addClass('active');
      $('#tab2').addClass('show active')
      $('#tab1-tab').removeClass('active');
      $('#tab1').removeClass('show active');

      if (selectedRow.length > 0) {
        $('#discount_modal').show();

        var inputBoxDis = $("#itemDiscount");
        if (inputBoxDis.length) {
          inputBoxDis.focus().select();
        }
        discountItem();
        var selectedRowId = selectedRow.data('id');
        var selectedRowType = selectedRow.data('dtype');
        var selectedRowAmount = selectedRow.data('disamount');
        var selectedRowQty = selectedRow.data('qty');
        var selectedSubTotal = selectedRow.data('subtotal');
        var selectedRowName = selectedRow.data('name');
        var selectedRowTransacNo = selectedRow.data('transac');
        var selectedRowPrice = selectedRow.data('prices');

        var totalSub = selectedRowQty * selectedRowPrice;
        // $('#quantityProductModal').modal('show');
        $('#discount_item_id').val(selectedRowId);
        // $('#quantity').val(selectedRowQty);
        $('#item_name').text(selectedRowName);
        $('#discount_item_sub').val(totalSub);
        $('#transac_num').val(selectedRowTransacNo);

        var percentVal = (selectedRowAmount * 100) / (totalSub);

        if (selectedRowType == 0) {
          $('#itemDiscount').val(percentVal);
          $('#amountType').text('%');
          $('#discounVal').val(0);

          $('#discount_type').text('%').addClass('active');
          $('#discount_type1').text('₱').removeClass('active');
          if (!$(event.target).is(inputBoxDis)) {
            inputBoxDis.focus();
          }
        } else {
          $('#itemDiscount').val(selectedRowAmount);
          $('#amountType').text('₱');
          $('#discounVal').val(1);
          $('#discount_type').text('%').removeClass('active');
          $('#discount_type1').text('₱').addClass('active');

          if (!$(event.target).is(inputBoxDis)) {
            inputBoxDis.focus();
          }
        }

        $('.btn-group .btn').click(function () {
          $('.btn-group .btn').removeClass('active');
          $(this).addClass('active');

          if (!$(event.target).is(inputBoxDis)) {
            inputBoxDis.focus();
          }
        });

        $('#discount_type').click(function () {
          $('#discounVal').val(0);
          $('#amountType').text('%');
          $('#itemDiscount').val(percentVal);

          if (!$(event.target).is(inputBoxDis)) {
            inputBoxDis.focus();
          }
        })
        $('#discount_type1').click(function () {
          $('#discounVal').val(1);
          $('#amountType').text('₱');
          $('#itemDiscount').val(selectedRowAmount);

          if (!$(event.target).is(inputBoxDis)) {
            inputBoxDis.focus();
          }
        })
      } else {
        modifiedMessageAlert('error', "There is no item selected!", false, false);
      }

      $('#tab1-tab').click(function () {
        $('#tab1-tab').addClass('active');
        $('#tab1').addClass('fade show active');
        var classActive = $('#tab1-tab').hasClass('active');
        $('#tab2-tab').removeClass('active');
        $('#tab2').removeClass('show active');

      })

      var total_sub = 0;
      var test2 = 0;

      tableRow.each(function () {
        var transactionNo = $(this).data('transac');
        var isCart = $(this).data('iscart');
        var subT = $(this).data('subtotal');
        total_sub += subT;

        if (selectedRow.length > 0) {

          var selectedRowId = selectedRow.data('id');
          var selectedRowType = selectedRow.data('dtype');
          var selectedRowAmount = selectedRow.data('disamount');
          var selectedRowQty = selectedRow.data('qty');
          var selectedSubTotal = selectedRow.data('subtotal');
          var selectedRowName = selectedRow.data('name');
          var selectedRowTransacNo = selectedRow.data('transac');
          var selectedRowPrice = selectedRow.data('prices');
          var selectedRowCart = selectedRow.data('iscart');

          var totalSub = selectedRowQty * selectedRowPrice;

          $('#discount_cart_sub').val(total_sub);

          $('#transac_cart_num').val(selectedRowTransacNo);
          $('#discounCartType').val(selectedRowType);
          $('#tab2-tab').removeClass('active');
          $('#tab2').removeClass('show active');
          $('#tab1-tab').addClass('active');
          $('#tab1').addClass('show active');


          if (selectedRowType == 0) {
            // $('#itemDiscount').val(percentVal);
            $('#amountCartType').text('%');
            $('#discounCartType').val(0);

            $('#discount_cart_type').text('%').addClass('active');
            $('#discount_cart_type1').text('₱').removeClass('active');
          } else {
            // $('#itemDiscount').val(selectedRowAmount);
            $('#amountCartType').text('₱');
            $('#discounCartType').val(1);
            $('#discount_cart_type').text('%').removeClass('active');
            $('#discount_cart_type1').text('₱').addClass('active');
          }

          $('.btn-group .btn').click(function () {
            $('.btn-group .btn').removeClass('active');
            $(this).addClass('active');
          });

          $('#discount_cart_type').click(function () {
            $('#discounCartType').val(0);
            $('#amountCartType').text('%');
            // $('#itemDiscount').val(percentVal);
          })
          $('#discount_cart_type1').click(function () {
            $('#discounCartType').val(1);
            $('#amountCartType').text('₱');
            // $('#itemDiscount').val(selectedRowAmount);
          })
        }
        // }
      })
    })
  });
</script>