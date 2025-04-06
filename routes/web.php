<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPPDController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

Route::prefix('adminutama')->group(function() {
    // Route untuk Data User
    Route::get('/datauser', [AdminController::class, 'datauser'])->name('adminutama.datauser')->middleware('auth');
    Route::get('/adddatauser', [AdminController::class, 'addDataUser'])->name('adminutama.adddatauser');
    Route::post('/adddatauser', [AdminController::class, 'tambahdatauser'])->name('tambahdatauser');
    Route::get('/ubahdatauser/{id_user}', [AdminController::class, 'ubahdataUser'])->name('adminutama.ubahdatauser');
    Route::put('/editdatauser/{id_user}', [AdminController::class, 'updatedataUser'])->name('updatedatauser');
    Route::delete('/hapusdatauser/{id_user}', [AdminController::class, 'hapusdatauser'])->name('hapusdatauser');

    // Route untuk Data Tim Kerja
    Route::get('/datatimkerja', [AdminController::class, 'datatimkerja'])->name('adminutama.datatimkerja');
    Route::get('/adddatatimkerja', function () {
        return view('adminutama.adddatatimkerja');
    })->name('adminutama.adddatatimkerja');
    Route::get('/datatimkerja', [AdminController::class, 'datatimkerja'])->name('adminutama.datatimkerja');
    Route::post('/adddatatimkerja', [AdminController::class, 'tambahTimKerja'])->name('tambahdatatimkerja');
    Route::get('/ubahdatatimkerja/{id}', [AdminController::class, 'ubahdatatimkerja'])->name('adminutama.ubahdatatimkerja');
    Route::post('/editdatatimkerja/{id}', [AdminController::class, 'ubahTimKerja'])->name('ubahtimkerja');
    Route::delete('/timkerja/{id}', [AdminController::class, 'hapustimkerja'])->name('hapustimkerja');

    // Route untuk Data Kantor
    Route::get('/datakantor', [AdminController::class, 'datakantor'])->name('adminutama.datakantor');
    Route::get('/adddatakantor', function () {
        return view('adminutama.adddatakantor');
    })->name('adminutama.adddatakantor');
    Route::get('/datakantor', [AdminController::class, 'datakantor'])->name('adminutama.datakantor');
    Route::post('/adddatakantor', [AdminController::class, 'tambahKantor'])->name('tambahdatakantor');
    // Route untuk edit data kantor
    Route::get('/ubahdatakantor/{id}', [AdminController::class, 'ubahdatakantor'])->name('adminutama.ubahdatakantor');
    // Route untuk update data kantor
    Route::put('/ubahkantor/{id}', [AdminController::class, 'ubahkantor'])->name('ubahkantor');
    // Route untuk hapus data kantor
    Route::delete('/deletekantor/{id}', [AdminController::class, 'hapuskantor'])->name('hapuskantor');

    // Route untuk Data Pegawai
    Route::get('/datapegawai', [AdminController::class, 'datapegawai'])->name('adminutama.datapegawai');
    // add datakpegawai
    Route::get('/adddatapegawai', function () {
    return view('adminutama.adddatapegawai');
    })->name('adminutama.adddatapegawai');
    Route::get('/datapegawai', [AdminController::class, 'datapegawai'])->name('adminutama.datapegawai');
    Route::post('/adddatapegawai', [AdminController::class, 'tambahPegawai'])->name('tambahdatapegawai');
    Route::get('/editdatapegawai/{id}', [AdminController::class, 'ubahdataPegawai'])->name('adminutama.ubahdatapegawai');
    Route::post('/updatepegawai/{id}', [AdminController::class, 'ubahPegawai'])->name('ubahPegawai');
    Route::delete('/deletepegawai/{id}', [AdminController::class, 'hapusPegawai'])->name('hapuspegawai');
});

Route::post('/logout', [AdminController::class, 'logout'])->name('logout')->middleware('auth');
// // Rute untuk halaman utama
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [HomeController::class, 'index']);
// Route::get('/riwayat/filter', [RiwayatSPPDController::class, 'index'])->name('riwayat.filter');

// Rute untuk halaman admin panel
Route::get('/dashboard', [SPPDController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::post('/update-anggaran', [SPPDController::class, 'updateAnggaran'])->name('dashboard.updateAnggaran');

Route::get('/input-sppd', [SPPDController::class, 'inputSPPD'])->name('inputSPPD')->middleware('auth');
Route::get('/sppd-aktif', [SPPDController::class, 'index'])->name('sppd.index')->middleware('auth');
Route::get('/get-karyawan/{nip}', [SPPDController::class, 'getKaryawan']);
Route::post('/store-sppd', [SPPDController::class, 'storeSPPD'])->name('storeSPPD');

Route::get('/sppd/{id}/detail', [SPPDController::class, 'detail'])->name('sppd.detail')->middleware('auth');
Route::get('/sppd/{id}/editsppd', [SPPDController::class, 'editsppd'])->name('sppd.editsppd')->middleware('auth');
Route::put('/sppd/{id}', [SPPDController::class, 'update'])->name('sppd.update')->middleware('auth');

Route::put('/sppd/{id}/update', [SPPDController::class, 'update'])->name('sppd.update')->middleware('auth');

Route::get('/sppd/{id}/cetak-spt', [SPPDController::class, 'cetakSpt'])->name('sppd.cetak-spt')->middleware('auth');Route::get('/cetak-spt/{id}', [SPPDController::class, 'cetakSPT'])->name('cetak-spt');

Route::get('/sppd/{id}/cetak-spd', [SPPDController::class, 'cetakSpd'])->name('sppd.cetak-spd')->middleware('auth');
Route::get('/sppd/cetak-ttd/{id}', [SPPDController::class, 'cetakTTD'])->name('sppd.cetak-ttd')->middleware('auth');
Route::get('/cetak-spt/{id}', [SPPDController::class, 'cetakSPT'])->name('cetak-spt');

Route::get('/sppd/laporan/{id}', [SppdController::class, 'laporan'])->name('sppd.laporan');
Route::post('/sppd/laporan/store/{id}', [SPPDController::class, 'storeLaporan'])->name('sppd.storeLaporan');

// Route::post('/sppd/laporan/store', [SPPDController::class, 'storeKwitansi'])->name('sppd.storeKwitansi');
// Route::post('/store-kwitansi', [SPPDController::class, 'storeKwitansi'])->name('sppd.store_kwitansi');
// Route::post('/sppd/store-kwitansi', [SPPDController::class, 'storeKwitansi'])->name('sppd.storeKwitansi');
// Route::post('/laporan', [SPPDController::class, 'storeLaporan'])->name('laporan.store');

Route::post('/laporan/submit', [SPPDController::class, 'submitLaporan'])->name('laporan.submit');

// Rute untuk melihat riwayat SPPD
Route::get('/riwayat-sppd', [SPPDController::class, 'riwayatsppd'])->name('riwayat.riwayatsppd')->middleware('auth');
Route::get('/riwayat-detail/{no_kwitansi}', [SPPDController::class, 'detailriwayat'])->name('riwayat.detail')->middleware('auth');
Route::get('/download-spt/{no_kwitansi}', [SPPDController::class, 'downloadSPT'])->name('download.spt');
// Route::get('/download-ttd', [SPPDController::class, 'downloadTtd'])->name('download.ttd');
Route::get('/download-ttd/{no_kwitansi}', [SPPDController::class, 'downloadTtd'])->name('download.ttd');
Route::get('/download-spd/{no_kwitansi}', [SPPDController::class, 'downloadSPD'])->name('download.spd');
Route::get('/cetak-laporan/{no_kwitansi}', [SPPDController::class, 'cetakLaporan'])->name('cetakLaporan');
Route::get('/download-kwitansi/{id}', [SPPDController::class, 'downloadKwitansi'])->name('download.kwitansi');

Route::get('/riwayat/edit/{no_kwitansi}', [SPPDController::class, 'editdetailriwayat'])->name('editdetailriwayat')->middleware('auth');
Route::post('/riwayat-update/{no_kwitansi}', [SPPDController::class, 'updateDetailRiwayat'])->name('updatedetailriwayat')->middleware('auth');

Route::get('/cetak-kwitansi/{no_kwitansi}', [SPPDController::class, 'cetakkwitansi'])->name('riwayat.cetakkwitansi')->middleware('auth');

// Route::get('/inputspj', function () {
//     return view('riwayat.inputspj');
// })->name('inputspj');
// // web.php (Route file)
Route::get('/inputspj/{no_kwitansi}', [SPPDController::class, 'inputSPJ'])->name('riwayat.inputspj')->middleware('auth');
Route::post('/spj/store', [SPPDController::class, 'storeSPJ'])->name('spj.store');
Route::put('/spj/update/{no_kwitansi}', [SPPDController::class, 'updateSPJ'])->name('spj.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/detail', [SPPDController::class, 'detail_profile'])->name('profile.detailprofile')->middleware('auth');
    // Route::put('/profile/update-password', [SPPDController::class, 'updatePassword'])->name('profile.updatePassword'); // New route for password update
});

// super admin
// Route::get('/superadmin-datauser', [SPPDController::class, 'datauser'])->name('superadmin.datauser')->middleware('auth');

// Route::get('/superadmin-datatimkerja', [SPPDController::class, 'datatimkerja'])->name('superadmin.datatimkerja')->middleware('auth');

// Route::get('/superadmin-datapegawai', [SPPDController::class, 'datapegawai'])->name('superadmin.datapegawai')->middleware('auth');

// Route::get('/superadmin-datakantor', [SPPDController::class, 'datakantor'])->name('superadmin.datakantor')->middleware('auth');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/logout', [LoginController::class, 'actionlogout'])->name('logout');
//REGISTER
// Route::get('register', [RegisterController::class, 'register'])->name('register');
// Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

// // add datakantor
// Route::get('/superadmin/adddatakantor', function () {
//     return view('superadmin.adddatakantor');
// })->name('adddatakantor');
// Route::get('/datakantor', [SPPDController::class, 'datakantor'])->name('datakantor')->middleware('auth');

// // menyimpan data kantor
// Route::post('/superadmin/adddatakantor', [SPPDController::class, 'storeKantor'])->name('storedatakantor');

// // Route untuk edit data kantor
// Route::get('/superadmin/editdatakantor/{id}', [SPPDController::class, 'editdatakantor'])->name('editdatakantor')->middleware('auth');

// // Route untuk update data kantor
// Route::put('/superadmin/updatekantor/{id}', [SPPDController::class, 'updatekantor'])->name('updatekantor');

// // Route untuk hapus data kantor
// Route::delete('/superadmin/deletekantor/{id}', [SPPDController::class, 'deletekantor'])->name('deletekantor')->middleware('auth');

// // add datakpegawai
// Route::get('/superadmin/adddatapegawai', function () {
//     return view('superadmin.adddatapegawai');
// })->name('adddatapegawai');
// Route::get('/datapegawai', [SPPDController::class, 'datapegawai'])->name('datapegawai')->middleware('auth');

// // menyimpan data pegawai
// Route::post('/superadmin/adddatapegawai', [SPPDController::class, 'storePegawai'])->name('storedatapegawai');

// // Route untuk menampilkan halaman edit pegawai
// Route::get('/superadmin/editdatapegawai/{id}', [SPPDController::class, 'editPegawai'])->name('editdatapegawai');

// // Route untuk memperbarui data pegawai
// Route::post('/superadmin/updatepegawa/{id}', [SPPDController::class, 'updatePegawai'])->name('updatedatapegawai');

// // Route untuk menghapus data pegawai
// Route::delete('/superadmin/deletepegawa/{id}', [SPPDController::class, 'deletePegawai'])->name('deletepegawai');

// Route::get('/superadmin/adddatatimkerja', function () {
//     return view('superadmin.adddatatimkerja');
// })->name('adddatatimkerja');
// Route::get('/datatimkerja', [SPPDController::class, 'datatimkerja'])->name('datatimkerja')->middleware('auth');

// // Route untuk menyimpan data tim kerja
// Route::post('/superadmin/adddatatimkerja', [SPPDController::class, 'storeTimKerja'])->name('storedatatimkerja');

// // Route untuk menampilkan halaman edit tim kerja
// Route::get('/superadmin/editdatatimkerja/{id}', [SPPDController::class, 'editdatatimkerja'])->name('editdatatimkerja');

// // Route untuk memperbarui data tim kerja
// Route::post('/superadmin/updatetimkerja/{id}', [SPPDController::class, 'updateTimKerja'])->name('updatetimkerja');

// Route::delete('/superadmin/timkerja/{id}', [SPPDController::class, 'deletetimkerja'])->name('deletetimkerja');

// // add datauser
// Route::get('/superadmin/adddatauser', [SPPDController::class, 'addDataUser'])->name('adddatauser');
// Route::get('/datauser', [SPPDController::class, 'datauser'])->name('datauser');

// Route::post('/superadmin/adddatauser', [SPPDController::class, 'storeuserdata'])->name('storedatauser'); // Change to storeuserdata

// // Edit datauser
// Route::get('/superadmin/editdatauser/{id_user}', [SPPDController::class, 'editdataUser'])->name('editdatauser');
// Route::put('/superadmin/editdatauser/{id_user}', [SPPDController::class, 'updateDataUser'])->name('updateDataUser');

// // delete datauser
// // Delete datauser
// Route::delete('/superadmin/deleteuser/{id_user}', [SPPDController::class, 'deleteUser'])->name('deleteuser');
