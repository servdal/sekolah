<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Config_Controller;
use App\Http\Controllers\Api\Master_Controller;
use App\Http\Controllers\Api\Tr_Berita;
use App\Http\Controllers\Api\Tr_Hewan;
use App\Http\Controllers\Api\Tr_Manusia;
use App\Http\Controllers\Api\Tr_Print;
use App\Http\Controllers\Auth_User_Role\Auth_Controller;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [Auth_Controller::class, 'register']);
    Route::post('login', [Auth_Controller::class, 'signin']);
    Route::post('forget', [Auth_Controller::class, 'ver_forget']);
    Route::post('proses_forget', [Auth_Controller::class, 'proses_forget']);
    
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', [Auth_Controller::class, 'logout']);
        Route::get('authuser', [Auth_Controller::class, 'user']);
    });

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('update_profile', [Auth_Controller::class, 'update_profile']);
        Route::post('update_user', [Auth_Controller::class, 'update_user']);
        Route::post('update_pass', [Auth_Controller::class, 'update_pass']);
        
        Route::get('user_list', [Auth_Controller::class, 'user_list']);
        Route::get('show_user/{id}', [Auth_Controller::class, 'show_user_admin']);
        Route::post('add_user', [Auth_Controller::class, 'add_user']);
        Route::post('update_user_admin/{id}', [Auth_Controller::class, 'update_user_admin']);
        Route::post('reset_pass', [Auth_Controller::class, 'reset_pass_admin']);
        Route::get('role_list', [Auth_Controller::class, 'role_list']);
        
        Route::get('reviewer_list', [Auth_Controller::class, 'listReviewer']);
    });

});

Route::get('refapp/{sect}', [Config_Controller::class, 'getref']);
Route::get('refavalpp/{desc}', [Config_Controller::class, 'getvalref']);

#========================= Master =======================
Route::get('rumpunilmu_list', [Master_Controller::class, 'rumpunilmu_list']);
Route::get('jur_prodi_list', [Master_Controller::class, 'jur_prodi_list']);
Route::get('ruang', [Master_Controller::class, 'ruang']);
#========================= End Master =======================

#=========== Berita ===========#
Route::get('berita_public/get_by_jenis', [Tr_Berita::class, 'get_by_jenis']);
Route::get('berita_public', [Tr_Berita::class, 'index_public']);
Route::get('berita_public/{id}', [Tr_Berita::class, 'show_public']);
Route::get('berita_public_view/{id}', [Tr_Berita::class, 'show_view']);
#=========== End Berita ===========#

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('hewan/{id}', [Tr_Hewan::class, 'show']);
    Route::get('hewan_get_list', [Tr_Hewan::class, 'get_list']);
    Route::get('hewan_get_arsip', [Tr_Hewan::class, 'get_arsip']);
    Route::get('hewan_reviewer/{id}', [Tr_Hewan::class, 'show_by_reviewer']); //reviewer
    Route::post('hewan', [Tr_Hewan::class, 'store']); //peneliti
    Route::post('hewan_draft', [Tr_Hewan::class, 'store_draft']); //peneliti
    Route::post('hewan_upload', [Tr_Hewan::class, 'UploadTagihan']); //peneliti
    Route::post('hewan_review', [Tr_Hewan::class, 'store_review']); //reviewer
    Route::post('hewan_review_draft', [Tr_Hewan::class, 'store_review_draft']); //reviewer
    Route::post('hewan_proses', [Tr_Hewan::class, 'ProsesPermohonan']); //admin
    Route::post('hewan_arsip', [Tr_Hewan::class, 'ProsesArsip']); //admin
    Route::post('hewan_tagihan', [Tr_Hewan::class, 'ProsesTagihan']); //admin
    Route::post('hewan_ubah', [Tr_Hewan::class, 'ProsesUbah']); //admin
    Route::post('hewan_ulang', [Tr_Hewan::class, 'ProsesSeminarUlang']); //admin
    Route::post('hewan_assignment', [Tr_Hewan::class, 'AssignmentReviewer']); //admin
    Route::post('hewan_change_status', [Tr_Hewan::class, 'change_status']); //admin
    Route::post('hewan_tanda_terima/{id}', [Tr_Hewan::class, 'TandaTerima']); //admin
    Route::post('hewan_surat_pengantar/{id}', [Tr_Hewan::class, 'SuratPengantar']); //admin
    Route::post('hewan_perbaikan/{id}', [Tr_Hewan::class, 'Perbaikan']); //admin
    Route::post('hewan_laik_etik/{id}', [Tr_Hewan::class, 'LaikEtik']); //admin
    Route::post('hewan_resend_mail', [Tr_Hewan::class, 'KirimEmailReviewer']); //admin
    Route::post('hewan_setstatus', [Tr_Hewan::class, 'StatusPenelitian']); //admin
    Route::post('hewan_setstatuspilihan/{id}', [Tr_Hewan::class, 'StatusJenPenelaah']); //admin
    
    Route::get('manusia/{id}', [Tr_Manusia::class, 'show']);
    Route::get('manusia_get_list', [Tr_Manusia::class, 'get_list']);
    Route::get('manusia_get_arsip', [Tr_Manusia::class, 'get_arsip']);
    Route::get('manusia_reviewer/{id}', [Tr_Manusia::class, 'show_by_reviewer']); //reviewer
    Route::post('manusia', [Tr_Manusia::class, 'store']);
    Route::post('manusia_draft', [Tr_Manusia::class, 'store_draft']);
    Route::post('manusia_upload', [Tr_Manusia::class, 'UploadTagihan']); //peneliti
    Route::post('manusia_review', [Tr_Manusia::class, 'store_review']); //reviewer
    Route::post('manusia_review_draft', [Tr_Manusia::class, 'store_review_draft']); //reviewer
    Route::post('manusia_proses', [Tr_Manusia::class, 'ProsesPermohonan']); //admin
    Route::post('manusia_arsip', [Tr_Manusia::class, 'ProsesArsip']); //admin
    Route::post('manusia_tagihan', [Tr_Manusia::class, 'ProsesTagihan']); //admin
    Route::post('manusia_ubah', [Tr_Manusia::class, 'ProsesUbah']); //admin
    Route::post('manusia_ulang', [Tr_Manusia::class, 'ProsesSeminarUlang']); //admin
    Route::post('manusia_assignment', [Tr_Manusia::class, 'AssignmentReviewer']); //admin
    Route::post('manusia_change_status', [Tr_Manusia::class, 'change_status']); //admin
    Route::post('manusia_tanda_terima/{id}', [Tr_Manusia::class, 'TandaTerima']); //admin
    Route::post('manusia_surat_pengantar/{id}', [Tr_Manusia::class, 'SuratPengantar']); //admin
    Route::post('manusia_perbaikan/{id}', [Tr_Manusia::class, 'Perbaikan']); //admin
    Route::post('manusia_laik_etik/{id}', [Tr_Manusia::class, 'LaikEtik']); //admin
    Route::post('manusia_resend_mail', [Tr_Manusia::class, 'KirimEmailReviewer']); //admin
    Route::post('manusia_setstatus', [Tr_Manusia::class, 'StatusPenelitian']); //admin
    Route::post('manusia_setstatuspilihan/{id}', [Tr_Manusia::class, 'StatusJenPenelaah']); //admin
    
    Route::post('print_undangan', [Tr_Print::class, 'Undangan']); //admin
    Route::get('list_tgl_jadwal', [Tr_Print::class, 'getDateSeminar']); //admin

    #=========== Berita ===========#
    Route::get('berita', [Tr_Berita::class, 'index']);
    Route::get('berita/{id}', [Tr_Berita::class, 'show']);
    Route::post('berita', [Tr_Berita::class, 'store']);
    Route::post('berita/{id}', [Tr_Berita::class, 'update']);
    Route::post('berita_pin/{id}', [Tr_Berita::class, 'update_pin']);
    Route::delete('berita/{id}', [Tr_Berita::class, 'destroy']);
    #=========== End Berita ===========#

    Route::get('config', [Config_Controller::class, 'index']);
    Route::post('config', [Config_Controller::class, 'store']);

});
