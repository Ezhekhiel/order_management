<?php

use App\Http\Controllers\dcDatabase;
use App\Http\Controllers\dcIncoming;
use App\Http\Controllers\dcDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dcSpkController;
use App\Http\Controllers\orderManagement;
use App\Http\Controllers\listCellController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\setMaterialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/list_cell',[listCellController::class,'list_cell'])->name('list_cell');

Route::get('/dashboard',[dashboardController::class,'index']);
Route::get('/dashboard/main',[dashboardController::class,'main'])->name('dashboard.main');
Route::get('/dashboard/working/report/cell',[dashboardController::class,'working_report_cell'])->name('dashboard.working.report.cell');
Route::get('/dashboard/change/cell',[dashboardController::class,'change_cell'])->name('dashboard.change.cell');
Route::get('/dashboard/change/modal/style',[dashboardController::class,'change_modal_style'])->name('dashboard.change.modal.style');
Route::get('/dashboard/change/po',[dashboardController::class,'change_po'])->name('dashboard.change.po');
Route::post('/dashboard/search/detail',[dashboardController::class,'search_detail'])->name('dashboard.search.detail');
Route::get('/dashboard/search/po',[dashboardController::class,'search_po'])->name('dashboard.search.po');

Route::get('/dc/database',[dcDatabase::class,'index']);
Route::post('/dc/database/import',[dcDatabase::class,'import']);
Route::post('/dc/database/download',[dcDatabase::class,'download']);

Route::get('/formInput',[orderManagement::class,'index']);
Route::get('/formInput/main',[orderManagement::class,'main'])->name('formInput.main');
Route::get('/formInput/cell/change',[orderManagement::class,'cell_change'])->name('formInput.cell.change');
Route::get('/formInput/po/change',[orderManagement::class,'po_change'])->name('formInput.po.change');
Route::get('/formInput/detail/change',[orderManagement::class,'detail_change'])->name('formInput.detail.change');
Route::get('/formInput/process/change',[orderManagement::class,'process_change'])->name('formInput.process.change');
Route::post('/formInput/save/process',[orderManagement::class,'save_process'])->name('formInput.save.process');
Route::post('/formInput/update/cell_target',[orderManagement::class,'update_cell_target'])->name('formInput.update.cell_target');
Route::post('/formInput/save',[orderManagement::class,'save'])->name('formInput.save');

Route::get('/dc/dashboard',[dcDashboard::class,'index']);
Route::get('/dc/dashboard/main',[dcDashboard::class,'main'])->name('dc.dashboard.main');

Route::get('/dc/incoming',[dcIncoming::class,'incoming_index']);
Route::get('/dc/incoming/main',[dcIncoming::class,'incoming_data'])->name('dc.incoming.main');
Route::get('/dc/incoming/save_not_the_same',[dcIncoming::class,'incoming_save_not_the_same'])->name('dc.incoming.save_not_the_same');
Route::post('/dc/incoming/save',[dcIncoming::class,'incoming_save'])->name('dc.incoming.save');
Route::post('/dc/incoming/update',[dcIncoming::class,'incoming_update'])->name('dc.incoming.update');
Route::get('/dc/search/bm',[dcIncoming::class,'search_bm'])->name('dc.search.bm');
Route::get('/dc/change/data',[dcIncoming::class,'change_data'])->name('dc.change.data');
Route::get('/dc/change/bm',[dcIncoming::class,'change_bm'])->name('dc.change.bm');
Route::get('/dc/change/po',[dcIncoming::class,'change_po'])->name('dc.change.po');
Route::get('/dc/change/wide',[dcIncoming::class,'change_wide'])->name('dc.change.wide');

Route::get('/dc/spk',[dcSpkController::class,'index']);
Route::get('/dc/spk/main',[dcSpkController::class,'main'])->name('dc.spk.main');
Route::post('/dc/spk/save',[dcSpkController::class,'spk_save'])->name('dc.spk.save');
Route::post('/dc/spk/proses_transfer',[dcSpkController::class,'proses_transfer'])->name('dc.spk.proses_transfer');
Route::post('/dc/spk/process_mutasi',[dcSpkController::class,'process_mutasi'])->name('dc.spk.process_mutasi');
Route::get('/dc/spk/po_change',[dcSpkController::class,'po_change'])->name('dc.spk.po_change');
Route::get('/dc/spk/cell_change',[dcSpkController::class,'cell_change'])->name('dc.spk.cell_change');
Route::get('/dc/spk/detail_incoming',[dcSpkController::class,'detail_incoming'])->name('dc.spk.detail_incoming');
Route::get('/dc/spk/detailFormMutasi',[dcSpkController::class,'detailFormMutasi'])->name('dc.spk.detailFormMutasi');
Route::get('/dc/spk/detailModalFormTransfer',[dcSpkController::class,'detailModalFormTransfer'])->name('dc.spk.detailModalFormTransfer');
Route::get('/dc/spk/list_cell',[dcSpkController::class,'list_cell'])->name('dc.spk.list_cell');
Route::get('/dc/spk/search_jam',[dcSpkController::class,'search_jam'])->name('dc.spk.search_jam');
Route::post('/dc/spk/saveMutasi',[dcSpkController::class,'saveMutasi'])->name('dc.spk.saveMutasi');
Route::get('/dc/spk/print_priview_mutasi/{cell}/{jam}',[dcSpkController::class,'print_priview_mutasi']);
Route::get('/dc/spk/print_priview_transfer/{cell}/{jam}',[dcSpkController::class,'print_priview_transfer']);
Route::post('/dc/spk/reject_mutasi',[dcSpkController::class,'reject_mutasi'])->name('dc.spk.reject_mutasi');

