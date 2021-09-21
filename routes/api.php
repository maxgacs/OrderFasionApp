<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('manager/login', 'API\ManagerController@login');
Route::get('viewOneManager/{id}', 'API\ManagerController@viewOneManager');

Route::post('user/login', 'API\UserController@login');
Route::post('createUser', 'API\UserController@createUser');
Route::get('viewUsers', 'API\UserController@viewUsers');
Route::get('viewOneUser/{id}', 'API\UserController@viewOneUser');
Route::put('updateUsers/{id}', 'API\UserController@updateUsers');
Route::post('updateUsers/{id}', 'API\UserController@updateUsers');//fake update
Route::put('updateImageUser/{id}', 'API\UserController@updateImageUser');
Route::post('updateImageUser/{id}', 'API\UserController@updateImageUser');

Route::post('Emp/login', 'API\EmpController@login');
Route::post('createEmp', 'API\EmpController@createEmp');
Route::get('viewEmp', 'API\EmpController@viewEmp');
Route::get('SelectIDEmployeesDESC', 'API\EmpController@SelectIDEmployeesDESC');
Route::get('viewWaitingEmp', 'API\EmpController@viewWaitingEmp');
Route::get('viewOneEmp/{id}', 'API\EmpController@viewOneEmp');
Route::put('updateEmp/{id}', 'API\EmpController@updateEmp');
Route::post('updateEmp/{id}', 'API\EmpController@updateEmp');//fake update
Route::post('updateImageEmp/{id}', 'API\EmpController@updateImageEmp');
Route::put('updateImageEmp/{id}', 'API\EmpController@updateImageEmp');
Route::post('updateStatusEmp/{id}', 'API\EmpController@updateStatusEmp');
Route::get('SelectEmployeesTypeID1Updated_atASC', 'API\EmpController@SelectEmployeesTypeID1Updated_atASC');
Route::get('SelectEmployeesTypeID2Updated_atASC', 'API\EmpController@SelectEmployeesTypeID2Updated_atASC');
Route::get('SelectEmployeesTypeID3Updated_atASC', 'API\EmpController@SelectEmployeesTypeID3Updated_atASC');
Route::get('SelectEmployeesTypeID4Updated_atASC', 'API\EmpController@SelectEmployeesTypeID4Updated_atASC');
Route::post('updateEmpStat/{id}', 'API\EmpController@updateEmpStat');
Route::post('updateEmpStat3/{id}', 'API\EmpController@updateEmpStat3');
Route::delete('Empdelete/{id}', 'API\EmpController@Empdelete');

Route::get('viewMainProductType', 'API\MainProductController@viewMainProductType');

Route::get('viewProductType/{id}', 'API\ProductController@viewProductType');
Route::get('viewProductOne/{id}', 'API\ProductController@viewProductOne');
Route::post('updateProduct/{id}', 'API\ProductController@updateProduct');
Route::put('updateProduct/{id}', 'API\ProductController@updateProduct');

Route::get('viewChoose_Mat/{id}', 'API\Choose_MatController@viewChoose_Mat');
Route::get('viewChoose_MatCOUNT/{id}', 'API\Choose_MatController@viewChoose_MatCOUNT');
Route::get('viewChoose_Mat_materialTypeName/{id}', 'API\Choose_MatController@viewChoose_Mat_materialTypeName');
Route::get('viewChoose_MatOne/{id1}/{id2}', 'API\Choose_MatController@viewChoose_MatOne');
Route::get('viewChoose_Mat_Sp/{id}', 'API\Choose_Mat_SpController@viewChoose_Mat_Sp');
Route::get('viewChoose_Mat_SpOne/{id}', 'API\Choose_Mat_SpController@viewChoose_Mat_SpOne');

Route::post('AddCart', 'API\Shop_CartController@AddCart');
Route::get('viewCartUser/{id}', 'API\Shop_CartController@viewCartUser');
Route::get('viewCart/{id}', 'API\Shop_CartController@viewCart');
Route::get('viewMaterialID/{id}', 'API\Shop_CartController@viewMaterialID');
Route::get('viewCartUserColorGROUP/{id1}/{id2}', 'API\Shop_CartController@viewCartUserColorGROUP');
Route::get('viewProductCartUser/{id1}/{id2}', 'API\Shop_CartController@viewProductCartUser');
Route::get('viewONECartUserProductID/{id}', 'API\Shop_CartController@viewONECartUserProductID');
Route::get('SUMpriceTotal/{id}', 'API\Shop_CartController@SUMpriceTotal');
Route::get('SUMdataTotal/{id}', 'API\Shop_CartController@SUMdataTotal');
Route::get('QuanUsed/{id}', 'API\Shop_CartController@QuanUsed');
Route::get('QuanUsedSp/{id}', 'API\Shop_CartController@QuanUsedSp');
Route::get('HalfpriceTotal/{id}', 'API\Shop_CartController@HalfpriceTotal');
Route::delete('cartdelete/{id}', 'API\Shop_CartController@cartdelete');

Route::post('AddOrder', 'API\OrderController@AddOrder');
Route::put('updateOrderComfirm/{id}', 'API\OrderController@updateOrderComfirm');
Route::put('updateOrderCancel/{id}', 'API\OrderController@updateOrderCancel');
Route::put('updateOrderData/{id}', 'API\OrderController@updateOrderData');
Route::put('updateDateline/{id}', 'API\OrderController@updateDateline');
Route::post('updateDateline/{id}', 'API\OrderController@updateDateline');
Route::post('updateOrderCancel/{id}', 'API\OrderController@updateOrderCancel');
Route::post('updateOrderComfirm/{id}', 'API\OrderController@updateOrderComfirm');
Route::post('updateOrderCancelEmp/{id}', 'API\OrderController@updateOrderCancelEmp');
Route::put('updateOrderCancelEmp/{id}', 'API\OrderController@updateOrderCancelEmp');
Route::post('updateOrderCancelCusMoney/{id}', 'API\OrderController@updateOrderCancelCusMoney');
Route::put('updateOrderCancelCusMoney/{id}', 'API\OrderController@updateOrderCancelCusMoney');
Route::get('viewOrderID/{id}', 'API\OrderController@viewOrderID');
Route::get('viewQuanDatelineOrderID/{id}', 'API\OrderController@viewQuanDatelineOrderID');
Route::get('viewOrderDESC', 'API\OrderController@viewOrderDESC');
Route::get('viewOrderStepStatusASC', 'API\OrderController@viewOrderStepStatusASC');
Route::get('viewOrderStepStatusPayASC', 'API\OrderController@viewOrderStepStatusPayASC');
Route::get('viewOrderUserStepStatusASC/{id}', 'API\OrderController@viewOrderUserStepStatusASC');
Route::get('viewOrderUserStepStatusPayASC/{id}', 'API\OrderController@viewOrderUserStepStatusPayASC');
Route::get('viewOrderEmpStepStatusASC/{id1}/{id2}', 'API\OrderController@viewOrderEmpStepStatusASC');
Route::get('viewOrderStepStatusIDWaitingASC/{id}', 'API\OrderController@viewOrderStepStatusIDWaitingASC');
Route::get('viewOrderStepStatusIDWaitingASCType3', 'API\OrderController@viewOrderStepStatusIDWaitingASCType3');
Route::get('SUMpriceTotalOrder/{id}', 'API\OrderController@SUMpriceTotalOrder');
Route::get('viewOrderIDOneUser/{id}', 'API\OrderController@viewOrderIDOneUser');
Route::get('viewOrderUser/{id}', 'API\OrderController@viewOrderUser');
Route::get('viewONEOrderUserProductID/{id1}/{id2}', 'API\OrderController@viewONEOrderUserProductID');
Route::get('viewOrderUserColorGROUP/{id1}/{id2}/{id3}', 'API\OrderController@viewOrderUserColorGROUP');
Route::get('SUMOrderpriceTotal/{id1}/{id2}', 'API\OrderController@SUMOrderpriceTotal');
Route::get('OrderQuanUsed/{id1}/{id2}', 'API\OrderController@OrderQuanUsed');
Route::get('OrderQuanUsedSp/{id1}/{id2}', 'API\OrderController@OrderQuanUsedSp');
Route::get('OrderCutRate/{id1}/{id2}', 'API\OrderController@OrderCutRate');
Route::get('ViewStepStatus/{id}', 'API\OrderController@ViewStepStatus');
Route::get('ViewOrderCreated_at/{id}', 'API\OrderController@ViewOrderCreated_at');
Route::get('ViewSoldProductID/{id}', 'API\OrderController@ViewSoldProductID');
Route::get('viewOrderText_alert/{id}', 'API\OrderController@viewOrderText_alert');
Route::post('updateImageCompensation/{id}', 'API\OrderController@updateImageCompensation');
Route::put('updateImageCompensation/{id}', 'API\OrderController@updateImageCompensation');
Route::post('updateOrderText_alertStatus/{id}', 'API\OrderController@updateOrderText_alertStatus');
Route::get('ViewSUM1_4Dateline/{id1}/{id2}', 'API\OrderController@ViewSUM1_4Dateline');
Route::get('ViewSUM3Dateline/{id}', 'API\OrderController@ViewSUM3Dateline');
Route::get('ViewSUM3Dateline2/{id1}', 'API\OrderController@ViewSUM3Dateline2');

Route::post('AddOrder_Details', 'API\Order_DetailController@AddOrder_Details');

Route::post('AddDeposit/{IDuser}', 'API\DepositController@AddDeposit');
Route::get('viewDepositDESC', 'API\DepositController@viewDepositDESC');
Route::get('viewDepositOrderID/{id}', 'API\DepositController@viewDepositOrderID');
Route::post('AddImageDeposit/{id}', 'API\DepositController@AddImageDeposit');

Route::post('AddPayment/{id}', 'API\PaymentController@AddPayment');
Route::get('viewPaymentOrderID/{id}', 'API\PaymentController@viewPaymentOrderID');

Route::put('updateMaterialSize/{id}', 'API\MaterialController@updateMaterialSize');
Route::get('viewMaterial/{id}', 'API\MaterialController@viewMaterial');

Route::put('updateMaterial_SpSize/{id}', 'API\Material_SpController@updateMaterial_SpSize');
Route::get('viewMaterial_Sp/{id}', 'API\Material_SpController@viewMaterial_Sp');

Route::post('AddSalary', 'API\SalaryController@AddSalary');
Route::get('viewOrderEmpComfirm/{id}', 'API\SalaryController@viewOrderEmpComfirm');
Route::put('updateSalaryStat/{id}', 'API\SalaryController@updateSalaryStat');
Route::post('updateSalaryStat/{id}', 'API\SalaryController@updateSalaryStat');
Route::put('updateSalaryStatStartDate/{id}', 'API\SalaryController@updateSalaryStatStartDate');
Route::post('updateSalaryStatStartDate/{id}', 'API\SalaryController@updateSalaryStatStartDate');
Route::put('updateSalaryStatEndDate/{id}', 'API\SalaryController@updateSalaryStatEndDate');
Route::post('updateSalaryStatEndDate/{id}', 'API\SalaryController@updateSalaryStatEndDate');
Route::get('viewSalaryWaiting/{id1}/{id2}', 'API\SalaryController@viewSalaryWaiting');
Route::put('updateSalaryWaiting/{id}', 'API\SalaryController@updateSalaryWaiting');
Route::post('updateSalaryWaiting/{id}', 'API\SalaryController@updateSalaryWaiting');
Route::get('viewSalaryDESC', 'API\SalaryController@viewSalaryDESC');
Route::post('UpImageSalary/{id}', 'API\SalaryController@UpImageSalary');
Route::put('UpImageSalary/{id}', 'API\SalaryController@UpImageSalary');
Route::get('viewSalaryStatusOrder2', 'API\SalaryController@viewSalaryStatusOrder2');
Route::get('viewSalaryOne/{id}', 'API\SalaryController@viewSalaryOne');
Route::get('viewSalaryEmpID/{id}', 'API\SalaryController@viewSalaryEmpID');
Route::get('viewQuanEndDateOrderID/{id}', 'API\SalaryController@viewQuanEndDateOrderID');
Route::put('updateSalaryMoneyEmp/{id}', 'API\SalaryController@updateSalaryMoneyEmp');
Route::post('updateSalaryMoneyEmp/{id}', 'API\SalaryController@updateSalaryMoneyEmp');
Route::post('AddSalaryEmpCut', 'API\SalaryController@AddSalaryEmpCut');
Route::get('viewSalaryJobEmpCutNull/{id}', 'API\SalaryController@viewSalaryJobEmpCutNull');
Route::get('viewONEOrderUserProductIDJobEmp3/{id}', 'API\SalaryController@viewONEOrderUserProductIDJobEmp3');
Route::get('viewOrderUserColorGROUPJobEmp3/{id}', 'API\SalaryController@viewOrderUserColorGROUPJobEmp3');

Route::get('viewbank', 'API\BankController@viewbank');
