<?php
    include( __DIR__ . '/utils/db/connector.php');
    include( __DIR__ . '/utils/models/global-facade.php');
    include( __DIR__ . '/utils/models/series-facade.php');
    include( __DIR__ . '/utils/models/transaction-facade.php');
    include( __DIR__ . '/utils/models/withdraw-facade.php');
    include( __DIR__ . '/utils/models/product-facade.php');
    include( __DIR__ . '/utils/models/user-facade.php');
    include( __DIR__ . '/utils/models/paid-transactions.php');
    include( __DIR__ . '/utils/models/sales-history-facade.php');
    include( __DIR__ . '/utils/models/cash-in-out-facade.php');
    include( __DIR__ . '/utils/models/z-reading-facade.php');
    include( __DIR__ . '/utils/models/x-reading-facade.php');


    header("Content-Type: application/json");
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    $response = array("message" => "Hello from API");
    
    $transactionFacade = new TransactionFacade();
    $withdrawFacade = new WithdrawFacade;
    $productFacade = new ProductFacade;
    $globalFacade = new GlobalFacade;
    $seriesFacade = new SeriesFacade;
    $userFacade = new UserFacade;
    $paidTransactions = new PaidTransaction;
    $refundTransactions = new PaidTransaction;
    $salesHistory = new SalesHistoyFacede;
    $cashInAndOut = new CashInOrOut;
    $z_report = new ZReading;
    $x_report = new XReading;


    $action = isset($_GET['action']) ? $_GET['action'] : null;
    switch ($action) {
        case 'deleteItem':
            $item_id = isset($data->itemId) ? $data->itemId : null;
            $transactionFacade->deleteTransaction($item_id);
            break;
        case 'getAllDiscounts':
            $transactionFacade->getAllDiscounts();
            break;
        case 'getTotalBynum':
            $transactionFacade->getTotalByNum($transactionNum)->fetchAll();
            break;
        case 'getAllCustomerUser':
            $userFacade->getAllCustomerUser();
            break;
        case 'getAllProducts':
            $transactionFacade->getAllProducts();
            break;  
        case 'getAllTransactions':
            $transactionFacade->getTransactions();
            break;
        case 'getTotals':
           $transactionFacade->getTotalForJS();
            
            break;
        case 'postPayment':
            $split_payment = isset($data->split_payment) ? $data->split_payment : null;
            $cash = isset($data->cashPays) ? $data->cashPays : null;
            $change = isset($data->changes) ? $data->changes : null;
            $transac_num = isset($data->transac) ? $data->transac : null;
            $customerId = isset($data->customerId) ? $data->customerId : null;
            $regularDis = isset($data->regularDis) ? $data->regularDis : null;
            // $barcode_receipt = isset($data->barcode_receipt) ? $data->barcode_receipt : null;
            // $paymentType = isset($data->paymentType) ? $data->paymentType : null;
            
            $paymentMetVal = isset($data->paymentMetVal) ? $data->paymentMetVal : null;
            $otherDetails = isset($data->otherDetails) ? $data->otherDetails : null;
           
            $transactionFacade->postPayment($cash, $change, $transac_num, $customerId, $regularDis, $paymentMetVal, json_encode($otherDetails));
            $seriesFacade->updateSeries();
            break;
        case 'addToTransaction':
          
            $transactionNum = isset($data->transactionNum) ? $data->transactionNum : null;
            $prodQty = isset($data->qty) ? $data->qty : null;
            $barcode = isset($data->barcode) ? $data->barcode : null ;
            $cashier = isset($data->cashier) ? $data->cashier : null ;
            $verifyBarcode = $productFacade->verifyBarcode($barcode);
            $fetchProduct = $productFacade->fetchProduct($barcode);
            $currentDate = date('Y-m-d');
            if ($verifyBarcode == 1) {
                while ($row = $fetchProduct->fetch(PDO::FETCH_ASSOC)) {
                    $prodId = $row['id'];
                    $prodDesc = $row['prod_desc'];
                    $prodPrice = $row['prod_price'];
                    $subTotal = $prodQty * $prodPrice;
                    $sales = $prodQty * $row['markup'] / 100;
                    $date = date("Y-m-d");

                    if($row['expiration_date'] > $currentDate ) {
                        $addTransactions = $transactionFacade->addTransaction($transactionNum, $prodId, $prodQty, $cashier, $prodDesc, $prodPrice, $subTotal, $sales, $date);
                        if ($addTransactions) {
                            $subtractQuantity = $productFacade->subtractQuantity($prodQty, $barcode);
                        }
                        echo json_encode([
                            'success' => 'Success To add!',
                        ]);
                    } else {
                        echo json_encode([
                            'error' => 'Failed To add!',
                        ]);
                    }
                }
            }
            break;

        case 'getAllSaved' : 
            $transactionFacade->getSaveTransac();
            break;
        case 'updateTransactSaved':
            $temId = isset($data->temId) ? $data->temId : null;
            $transactionFacade->getUpdateSaved($temId);
            break;
        case 'saveTransactions':
            $customer_name = isset($data->name) ? $data->name : null;
            $transacNo = isset($data->transacNo) ? $data->transacNo : null;
            $transactionFacade->savedTransac($customer_name, $transacNo);
            $seriesFacade->updateSeries();
            break;
        case 'getTransactionsByNumJS' :
            $transNo = isset($data->transNo) ? $data->transNo : null;
            $transactionFacade->getTransactionsByNumJS($transNo);
            break;
        case 'voidTransactions' :
            $transac_num = isset($data->transac_num) ? $data->transac_num : null;
            $void_indicator = isset($data->void_indicator) ? $data->void_indicator : null;
            $transactionFacade->voidTransactions($transac_num, $void_indicator);
            $seriesFacade->updateSeries();
            break;
        case 'getUpdatedSeries' :
            $seriesFacade->getLatestSeries();
            break;

        case 'updateQty' :
            $prodID = isset($data->prodID) ? $data->prodID : 1;
            $updateQty = isset($data->updateQty) ? $data->updateQty : 1;
            $transactionFacade->updateQty($prodID, $updateQty);
            break;

        case 'discountUpdate' : 
            $transac_num = isset($data->transac_num) ? $data->transac_num : null;
            $discountType = isset($data->discountType) ? $data->discountType : null;
            $itemDiscount = isset($data->itemDiscount) ? $data->itemDiscount : null;
            $discount_item_sub = isset($data->discount_item_sub) ? $data->discount_item_sub : null;
            $discount_item_id = isset($data->discount_item_id) ? $data->discount_item_id : null;
            $transactionFacade->updateTransaction($discount_item_id, $transac_num, $discount_item_sub, $discountType, $itemDiscount);
            break;
           case 'barCodes':
                $paidTransactions->getPaidTransactions();
               break;
        case 'paidTransaction':
                $barcode = isset($_GET['barcode']) ? $_GET['barcode'] : null;
            
                if ($barcode) {
                    $result = $paidTransactions->transactions($barcode);
                    echo json_encode($result);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Barcode is missing in the request.'
                    ]);
                }
                break;
        case 'updateAndInsert':
                $postData = json_decode(file_get_contents('php://input'), true);
                $prod_qty = isset($postData['qty']) ? $postData['qty'] : null;
                $prod_id = isset($postData['product_id']) ? $postData['product_id'] : null;
                $payment_id = isset($postData['payment_id']) ? $postData['payment_id'] : null;
                $product_price = isset($postData['product_price'])? $postData['product_price'] : null;
                $method = isset($postData['method'])? $postData['method'] : null;//  otherDetails
                $otherDetails = isset($postData['otherDetails'])? $postData['otherDetails'] : null;
                $dataUpt =  $refundTransactions->processRefund($prod_qty, $prod_id, $payment_id,$product_price,$method,  $otherDetails);
               break;
        case 'getRefundData':
                $postData = json_decode(file_get_contents('php://input'), true);
                $payment_id = isset($postData['payment_id']) ? $postData['payment_id'] : null;
                $refundTransactions->getRefundedData($payment_id);
                echo json_encode([
                    'success' => true,
                ]);
                break;

        case 'getSalesHistory' : 
                $salesHistory->getAllSales();
                break;

        case 'getRefundedSales' : 
                $postData = json_decode(file_get_contents('php://input'), true);
                $payment_id = isset($postData['payment_id']) ? $postData['payment_id'] : null;
                $reference_num = isset($postData['reference_num']) ? $postData['reference_num'] : null;
                $refundTransactions->getRefundedDataJS($payment_id, $reference_num);
                
            break;

        case 'postCashInOut' :
            $cash_in_out = isset($data->cash_in_out) ? $data->cash_in_out : null;
            $cash_amount = isset($data->cash_amount) ? $data->cash_amount : null;
            $reason_note = isset($data->reason_note) ? $data->reason_note : null;
            $cashierId = isset($data->cashierId) ? $data->cashierId : null;
           
            // echo json_encode([
            //     'data' => [$cash_in_out]
            // ]);
            $cashInAndOut->cashInOrOut($cash_in_out, $cash_amount, $reason_note, $cashierId);
            break;

        case 'postSplitPayment' :
            $cashSplit = isset($data->cashSplit) ? $data->cashSplit : null;
            $gcashSplit = isset($data->gcashSplit) ? $data->gcashSplit : null;
            $mayaSplit = isset($data->mayaSplit) ? $data->mayaSplit : null;
            $debitSplit = isset($data->debitSplit) ? $data->debitSplit : null;
            $creditSplit = isset($data->creditSplit) ? $data->creditSplit : null;
            // echo json_encode([
            //     'data' => [$cashSplit, $gcashSplit, $mayaSplit, $debitSplit, $creditSplit]
            // ]);
            break;
        case 'getCashInHistory' :
            $cashierId = isset($data->cashierId) ? $data->cashierId : null;
            $cashInAndOut->getAllHistoryCashInOut($cashierId);
            break;
        case 'insertAdata':
                $data = json_decode(file_get_contents('php://input'), true);
                $totalAmountCoupon = $data['returnAmountText'] ?? null;
                $selectedData= $data['selectedData'] ?? null;
                $r_id = $data['r_id'] ?? null;
                $paidTransactions->postCouponData($totalAmountCoupon, $r_id,$selectedData);
                break;//returnExchange($product_id,$payment_id,$return_qty)
        case 'insertReturnExchange':
                    $data = json_decode(file_get_contents('php://input'), true);
                    $product_id = $data['prod_id'] ?? null;
                    $payment_id= $data['payment_id'] ?? null;
                    $return_qty= $data['return_qty'] ?? null;
                    $paidTransactions->returnExchange($product_id,$payment_id,$return_qty);
                break;
        case 'getCouponsValidity':
                $qrNum = isset($_GET['qr_num']) ? $_GET['qr_num'] : null;
                $result = $paidTransactions->getCouponsDataValidity($qrNum);
                echo json_encode( $result);
                break;
        case 'getTransactionsID':
           
            $id = isset($_GET['selectedRowId']) ? $_GET['selectedRowId'] : null;
            $res = $paidTransactions->SearchData($id);
            echo json_encode( $res);
            break;
        case 'getRefundVoucher'://getLatestReturnCouponData($r_id)  
        
            $r_id =  isset($_GET['r_id']) ? $_GET['r_id'] : null;
            $res = $paidTransactions->getLatestReturnCouponData($r_id);
            echo json_encode( ["success" => true,
            "voucher" =>   $res
        ]);
            break;

        case 'updateCouponVal' :
            $couponId = isset($data->couponId) ? $data->couponId : null;
            $paidTransactions->updateCouponVal($couponId);
            break;

        case 'getAllPayments' :
            $z_report->getAllPayments();
            break;

        case 'credentialsAdmin':
            $inputPassword =  isset($_GET['credentials']) ? $_GET['credentials'] : null;
            $crdentials = $paidTransactions->checkCredentials($inputPassword);
            echo json_encode( ["success" => true,
            "credentials" =>     $crdentials
        ]);
        break; 
        case 'getPermissionLevel':
            $userID =  isset($_GET['userID']) ? $_GET['userID'] : null;
            $permission = $paidTransactions->permission($userID);

            echo json_encode( ["success" => true,
            "permission" =>   $permission 
        ]);
        break; 

        case 'getAllMethodPayment' :
            $transactionFacade->getAllMethodPayment();
            break;

        case 'deleteAllSavedOrders' :
            $deleteSaved = isset($data->toDelete) ? $data->toDelete : null;
            $transactionFacade->getDeleteSavedTransactions($deleteSaved);
            break;
        case 'getPermissionData':
            $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null; 
            $usersAbility =  $userFacade->getPermissionData($user_id);
            echo json_encode([
                "success" => true,
                "usersAbility" =>$usersAbility 
            ]);
            break;
        case 'update_z_reading_count' : 
            $z_report->getUpdateZCount();
            break;

        case 'getAllZreading' : 
            $z_report->getAllZreading();
            break;
        case 'postZReadReport' :
            $cashierId = isset($data->cashierId) ? $data->cashierId : null;
            $date_and_time = isset($data->date_and_time) ? $data->date_and_time : null;
            $totalSales = isset($data->totalSales) ? $data->totalSales : null;
            $z_read_allData = isset($data->z_read_allData) ? $data->z_read_allData : null;
            $z_report->postZReadReport($cashierId, $date_and_time, $totalSales, json_encode($z_read_allData));
            break;

        case 'postCashCount':
            $cash_count = isset($data->data) ? $data->data : null; 
            $z_report->postCashCount($cash_count);
            break;

        case 'getCashCountable' :
            $z_report->getCashCountable();
            break;
        case 'addCustomer' :
            $addCustomerInfo = isset($data->addCustomerInfo) ? $data->addCustomerInfo : null;
            $userFacade->addCustomer($addCustomerInfo);
            break;
        case 'getSpecificZreading' :
            $ref_num = isset($data->ref_num) ? $data->ref_num : null;
            $z_report->getSpecificZreading($ref_num);
            break;
        
        case 'getSpecificCashCount' :
            $cash_countId = isset($data->cashCountId) ? $data->cashCountId  : null;
            $z_report->getSpecificCashCount($cash_countId);
            break;
        case 'getAlluserXeading' :
            $x_report->getAllUserXReading();
            break;
        default:
            header("HTTP/1.0 400 Bad Request");
            break;
        }

