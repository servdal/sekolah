<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\UserController;
//use App\Http\Controllers\BackupController;
Route::get('/', [AuthController::class, 'viewAuth']);
Route::get('logkhusus/{id}', [AuthController::class, 'authenticatekhusus'])->name('logkhusus');
Route::get('cekandroid/{id}', [AuthController::class, 'getFirebaseaccount']);
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('exsimpanpendaftaran', [AuthController::class, 'exSimpanpendaftaran'])->name('exsimpanpendaftaran');
Route::post('exdaftarbaru', [AuthController::class, 'exDaftarBaru'])->name('exDaftarBaru');
Route::get('login', [FrontpageController::class, 'login'])->name('login');
Route::post('exresetpassword', [AuthController::class, 'exResetPassword'])->name('exResetPassword');
Route::post('exlogin', [AuthController::class, 'exLogin'])->name('exLogin');
Route::get('verifikasiemail',[AuthController::class, 'verifikasi'])->name('verifikasiemail');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('frontpage', [FrontpageController::class, 'FrontPageindex']);
Route::get('ppdb', [FrontpageController::class, 'ppdb'])->name('ppdb');
Route::get('suratijinortu/{id}', [FrontpageController::class, 'viewSurat']);
Route::get('viewlampiran/{id}', [FrontpageController::class, 'viewLampiran']);
Route::get('rapot/{id}', [FrontpageController::class, 'viewRapot']);
Route::get('ceking/{id}', [FrontpageController::class, 'cekingPembayaran']);
Route::get('karpes/{id}', [FrontpageController::class, 'viewKarpes']);
Route::get('observasi/{id}', [FrontpageController::class, 'viewObservasi']);
Route::get('biodatapsb/{id}', [FrontpageController::class, 'viewBiodatapsb']);
Route::get('verifikasi/{id}', [FrontpageController::class, 'verifikasiPembayaran']);
Route::get('kwitansi/{id}', [FrontpageController::class, 'ctkKwitansi']);
Route::get('kwitansipsb/{id}', [FrontpageController::class, 'ctkKwitansiPSB']);
Route::get('ctkkwt/{id}', [FrontpageController::class, 'exKwitansiByID']);
Route::get('ttdkwitansi/{id}', [FrontpageController::class, 'TtdKwitansi']);
Route::get('formkesanggupan/{id}', [FrontpageController::class, 'ctkFormkesanggupan']);
Route::get('trackingid/{id}', [FrontpageController::class, 'viewTrackingbyid']);
Route::post('tamu/exbukutamu', [FrontpageController::class, 'exbukuTamu'])->name('exbukutamu');
Route::post('tamu/carilaptamu', [FrontpageController::class, 'exTamucari'])->name('exTamucari');
Route::post('tamu/bukutamu', [FrontpageController::class, 'bukuTamu'])->name('bukuTamu');
Route::post('tamu/rekaptamu', [FrontpageController::class, 'rekapTamu'])->name('rekapTamu');
Route::post('ppdb/daftar', [FrontpageController::class, 'exPpdb'])->name('exPpdb');
Route::post('ppdb/savefileppdb', [FrontpageController::class, 'exSavefileppdb'])->name('exSavefileppdb');
Route::post('ppdb/saveberkasppdb', [FrontpageController::class, 'exSaveberkasppdb'])->name('exSaveberkasppdb');
Route::post('ppdb/ceknikppdb', [FrontpageController::class, 'exCeknikppdb'])->name('exCeknikppdb');
Route::post('ppdb/getkodependaf', [FrontpageController::class, 'exGetkodependaf'])->name('exGetkodependaf');
Route::post('ppdb/datacalonsiswa', [FrontpageController::class, 'jsonDatacalonsiswa'])->name('jsonDatacalonsiswa');
Route::post('pip/saveabsen', [FrontpageController::class, 'exPresensiviewPIP'])->name('exPresensiviewPIP');
Route::post('kwitansi/expersetujuanberkas', [FrontpageController::class, 'expersetujuanBerkas'])->name('expersetujuanBerkas');
Route::post('rapot/getstatkd', [FrontpageController::class, 'jsonStatistikkd'])->name('jsonStatistikkd');
Route::post('rapot/getstatpermuatan', [FrontpageController::class, 'jsonStatpermuatan'])->name('jsonStatpermuatan');

/////////////////E-COMPLAIN////////////////////////
Route::get('datakeluhan', [KomplainController::class, 'viewLapKomplain']);
Route::post('komplain/savekomplain', [KomplainController::class, 'saveKomplain'])->name('savekomplain');
Route::post('komplain/savetanggapan', [KomplainController::class, 'saveTanggapan'])->name('savetanggapan');
Route::post('komplain/saverating', [KomplainController::class, 'saveRating'])->name('saverating');
Route::get('komplain/getkomplainpribadi', [KomplainController::class, 'getKomplainpribadi'])->name('getkomplainpribadi');
Route::post('komplain/getdatakeluhan', [KomplainController::class, 'getdataKeluhan'])->name('getdatakeluhan');
Route::get('komplain/statjrating', [KomplainController::class, 'statjRating'])->name('statjrating');
Route::get('komplain/statunitkerja', [KomplainController::class, 'statUnitkerja'])->name('statunitkerja');

Route::group([], function () {
	Route::get('dashbord', [FrontpageController::class, 'index']);
	
	Route::post('surat/chatgetlist', [FrontpageController::class, 'chatGetlist'])->name('chatGetlist');
	Route::post('surat/catting', [FrontpageController::class, 'cattingSurat'])->name('cattingSurat');
	
	Route::get('zis', [AdminController::class, 'zis'])->name('zis');
	Route::get('jrekapthnini', [AdminController::class, 'jrekapthnini']);
	Route::get('lapamil', [AdminController::class, 'viewAmilZIS']);
	Route::post('jalldata', [AdminController::class, 'jallData'])->name('jallData');
	Route::post('exverifikasi', [AdminController::class, 'exVerifikasi'])->name('exVerifikasi');
	
	Route::get('datainduk', [AdminController::class, 'viewDatainduk']);
	Route::get('presensifinger', [AdminController::class, 'viewPresensiFinger']);
	Route::get('profilpegawai/{id}', [AdminController::class, 'viewProfilPegawai']);

	Route::post('admin/datainduk', [AdminController::class, 'exDatainduk'])->name('exDatainduk');
	Route::post('admin/upddatainduk', [AdminController::class, 'exupdDatainduk'])->name('exupdDatainduk');
	Route::post('excutor/simpanmutasi', [AdminController::class, 'exSimpanmutasi'])->name('exSimpanmutasi');
	Route::get('json/datainduk', [AdminController::class, 'jsonDatainduk'])->name('jsonDatainduk');
	Route::post('json/caridatainduk', [AdminController::class, 'jsonCariDatainduk'])->name('jsonCariDatainduk');
	Route::post('admin/expresfinger', [AdminController::class, 'exPresFinger'])->name('exPresFinger');

	Route::get('dataindukstaff', [AdminController::class, 'viewDataindukstaff']);
	Route::post('admin/dataindukstaff', [AdminController::class, 'exDataindukstaf'])->name('exDataindukstaf');
	Route::post('admin/upddataindukstaf', [AdminController::class, 'exupdDataindukstaff'])->name('exupdDataindukstaff');
	Route::get('json/dataindukstaf', [AdminController::class, 'jsonDataindukstaff'])->name('jsonDataindukstaff');
	
	Route::get('setkeuangan', [AdminController::class, 'viewSetkeuangan']);
	Route::get('json/setinsidental', [AdminController::class, 'jsonSetinsidental'])->name('jsonSetinsidental');
	Route::get('json/ekskul', [AdminController::class, 'jsonEkskul'])->name('jsonEkskul');
	Route::post('admin/simpaninsidental', [AdminController::class, 'exInsidental'])->name('exInsidental');
	Route::post('admin/saveekskul', [AdminController::class, 'exEkskul'])->name('exEkskul');
	Route::post('json/setkeuangan', [AdminController::class, 'jsonSetkeuangan'])->name('jsonSetkeuangan');
	Route::post('admin/simpansetkeuangan', [AdminController::class, 'exSetkeuangan'])->name('exSetkeuangan');
	
	Route::get('lapbayar', [AdminController::class, 'viewLapbayar']);
	Route::post('cetak/kwitansimulti', [AdminController::class, 'ctkKwitansimulti'])->name('ctkKwitansimulti');
	Route::post('cetak/viewdetailtu', [AdminController::class, 'ctkViewdetailtu'])->name('ctkViewdetailtu');
	Route::post('admin/exmultiverified', [AdminController::class, 'exMultiverified'])->name('exMultiverified');
	Route::post('admin/exrekaptunggakankelas', [AdminController::class, 'exRekaptunggakankelas'])->name('exRekaptunggakankelas');
	Route::post('json/lapinsidental', [AdminController::class, 'jsonLapinsidental'])->name('jsonLapinsidental');
	Route::post('json/lapbulanan', [AdminController::class, 'jsonLapbulanan'])->name('jsonLapbulanan');
	Route::post('json/laplengkap', [AdminController::class, 'jsonLaplengkap'])->name('jsonLaplengkap');
	Route::post('json/laplengkapperjenis', [AdminController::class, 'jsonLaplengkapperjenis'])->name('jsonLaplengkapperjenis');
	Route::post('json/rekapharian', [AdminController::class, 'jsoRekapharian'])->name('jsoRekapharian');
	Route::post('json/rincianharian', [AdminController::class, 'jsoRincianharian'])->name('jsoRincianharian');
	Route::post('json/rincianlastortu', [AdminController::class, 'jsonRincianlastortu'])->name('jsonRincianlastortu');
	Route::post('json/rincianbyrortu', [AdminController::class, 'jsonRincianbyrortu'])->name('jsonRincianbyrortu');
	Route::post('admin/manualbyr', [AdminController::class, 'exManualbyr'])->name('exManualbyr');
	Route::post('admin/editorbyr', [AdminController::class, 'exEditorbyr'])->name('exEditorbyr');
	Route::get('json/databayar', [AdminController::class, 'jsonDatabayar'])->name('jsonDatabayar');
	Route::post('admin/verifiedpembayaran', [AdminController::class, 'exvVerifiedpembayaran'])->name('exvVerifiedpembayaran');
	
	Route::get('laptabungan', [AdminController::class, 'viewLaptabungan']);
	Route::post('json/laptabunganharian', [AdminController::class, 'jsonLaptabunganharian'])->name('jsonLaptabunganharian');
	Route::post('json/caritabungan', [AdminController::class, 'jsonCaritabungan'])->name('jsonCaritabungan');
	Route::post('admin/tabung', [AdminController::class, 'exTabung'])->name('exTabung');
	Route::post('json/byrmanual', [AdminController::class, 'jsonByrmanual'])->name('jsonByrmanual');
	Route::get('json/tabungan', [AdminController::class, 'jsonTabungan'])->name('jsonTabungan');
	
	Route::get('logkeuangan', [AdminController::class, 'viewLogkeuangan']);
	Route::get('pip', [AdminController::class, 'pip'])->name('pip');
	Route::get('programpip', [AdminController::class, 'viewProgrampip']);
	Route::post('admin/exsimpandatapip', [AdminController::class, 'exSimpandataPIP'])->name('exSimpandataPIP');
	Route::post('admin/jsonpresensipipview', [AdminController::class, 'jsonPresensiPIPview'])->name('jsonPresensiPIPview');
	Route::get('json/dataprogrampip', [AdminController::class, 'jsonDataprogramPIP'])->name('jsonDataprogramPIP');
	
	Route::get('lapppdb', [AdminController::class, 'viewLapppdb']);
	Route::post('admin/uploadkeuanganppdb', [AdminController::class, 'exUploadkeuanganppdb'])->name('exUploadkeuanganppdb');
	Route::post('admin/exsimpandataujian', [AdminController::class, 'exSimpandataujian'])->name('exSimpandataujian');
	Route::post('admin/simpanhasilppdb', [AdminController::class, 'exSimpanhasilppdb'])->name('exSimpanhasilppdb');
	Route::post('admin/saveupdateppdb', [AdminController::class, 'exSaveupdateppdb'])->name('exSaveupdateppdb');
	Route::post('cetak/kwitansipsb', [AdminController::class, 'ctkKwitansipsb'])->name('ctkKwitansipsb');
	Route::post('admin/savearsipppdb', [AdminController::class, 'exSavearsipppdb'])->name('exSavearsipppdb');
	Route::post('admin/saveverifikasipsb', [AdminController::class, 'exSaveverifikasipsb'])->name('exSaveverifikasipsb');
	Route::post('admin/savesettingssppdpp', [AdminController::class, 'exSavesettingssppdpp'])->name('exSavesettingssppdpp');
	Route::post('admin/savesettingppdb', [AdminController::class, 'exSavesettingppdb'])->name('exSavesettingppdb');
	Route::post('admin/savenilaippdb', [AdminController::class, 'exSavenilaippdb'])->name('exSavenilaippdb');
	Route::get('json/jjadwalujianppdb', [AdminController::class, 'jsonJadwalujianppdb'])->name('jsonJadwalujianppdb');
	Route::get('json/datapembelianform', [AdminController::class, 'jsonDatapembelianform'])->name('jsonDatapembelianform');
	Route::post('json/detailpembeli', [AdminController::class, 'jsonDetailpembeli'])->name('jsonDetailpembeli');
	Route::get('json/datappdb', [AdminController::class, 'jsonDatappdb'])->name('jsonDatappdb');
	
	
	Route::get('minimi', [AdminController::class, 'viewMinimi']);
	Route::post('admin/exsavebuku', [AdminController::class, 'exSavebuku'])->name('exSavebuku');
	Route::post('admin/expeminjaman', [AdminController::class, 'exPeminjaman'])->name('exPeminjaman');
	Route::get('json/jsonbuku', [AdminController::class, 'jsonBuku'])->name('jsonBuku');
	Route::post('json/jsonbukucari', [AdminController::class, 'jsonBukucari'])->name('jsonBukucari');
	Route::post('json/jsonpeminjamanbuku', [AdminController::class, 'jsonPeminjaman'])->name('jsonPeminjaman');
	Route::post('admin/destroyer', [AdminController::class, 'exDestroyer'])->name('exDestroyer');
	
	Route::get('pengumuman', [AdminController::class, 'viewPengumuman']);
	Route::post('admin/pengumuman', [AdminController::class, 'exPengumuman'])->name('exPengumuman');
	
	Route::get('setting', [AdminController::class, 'viewSetting']);	
	Route::get('sekolah', [AdminController::class, 'viewSekolah']);	
	Route::get('json/datasekolah', [AdminController::class, 'jsonDatasekolah'])->name('jsonDatasekolah');
	Route::post('admin/uploaddatainduk', [AdminController::class, 'exUploaddatainduk'])->name('exUploaddatainduk');
	Route::post('admin/uploadkeuangan', [AdminController::class, 'exUploadkeuangan'])->name('exUploadkeuangan');
	Route::post('admin/savesetting', [AdminController::class, 'exSavesetting'])->name('exSavesetting');
	Route::post('admin/savesekolah', [AdminController::class, 'exSavesekolah'])->name('exSavesekolah');
	Route::post('admin/updatesekolah', [AdminController::class, 'exUpdatesekolah'])->name('exUpdatesekolah');
	Route::post('admin/onofflayanan', [AdminController::class, 'exOnofflayanan'])->name('exOnofflayanan');
	Route::post('admin/exprofilesekolah', [AdminController::class, 'exProfilesekolah'])->name('exProfilesekolah');
	
	Route::get('prestasisiswa', [AdminController::class, 'viewPrestasisiswa']);	
	Route::get('jrekapprestasithniniperbidang', [AdminController::class, 'jsonPrestasithniniperbidang'])->name('jsonPrestasithniniperbidang');
	Route::get('jrekapprestasithnini', [AdminController::class, 'jsonPrestasithnini'])->name('jsonPrestasithnini');
	Route::post('admin/exsimpanprestasi', [AdminController::class, 'exSimpanprestasi'])->name('exSimpanprestasi');
	Route::post('admin/jalldataprestasi', [AdminController::class, 'jsonAlldataprestasi'])->name('jsonAlldataprestasi');
	
	Route::get('sarpras', [AdminController::class, 'viewSarpras']);
	Route::get('umum/allkendaraan', [AdminController::class, 'getallkendaraan']);
	Route::get('umum/allgarasi', [AdminController::class, 'getallgarasi']);
	Route::post('umum/exkendaraan', [AdminController::class, 'exKendaraan'])->name('exkendaraan');
	Route::post('umum/storepinjamkendaraan', [AdminController::class, 'storepinjamkendaraan']);
	Route::post('umum/hapuspinjamkendaraan', [AdminController::class, 'hapuspinjamkendaraan']);
	Route::post('umum/getaktifitaskendaraan', [AdminController::class, 'getAktifitaskendaraan'])->name('getAktifitaskendaraan');
	Route::get('umum/getlistkendaraan', [AdminController::class, 'getlistKendaraan'])->name('getlistkendaraan');
	Route::post('umum/ctkdir', [AdminController::class, 'ctkdir'])->name('ctkdir');
	Route::get('umum/allruang', [AdminController::class, 'getallruang']);
    Route::get('umum/allgedung', [AdminController::class, 'getallgedung']);
	Route::post('umum/getrekapdetailruang', [AdminController::class, 'getrekapdetailruang']);
	Route::post('umum/getdetailruang', [AdminController::class, 'getdetailruang']);
	Route::post('umum/exfasruang', [AdminController::class, 'exfasruang'])->name('exfasruang');
	Route::post('umum/exruang', [AdminController::class, 'exruang'])->name('exruang');
	
	Route::get('datakeuhptmasuk', [AdminController::class, 'viewDatamasuk']);
	Route::get('laporankeuhpt', [AdminController::class, 'viewLaporan']);
	Route::post('json/laporanbulanan', [AdminController::class, 'getLaporanbulanan'])->name('getLaporanbulanan');	
	Route::post('cetak/laporanbulanan', [AdminController::class, 'exLaporanbulanan'])->name('exLaporanbulanan');
	Route::get('json/keuangan', [AdminController::class, 'getDatakeuangan'])->name('getDatakeuangan');
	Route::post('json/keuanganeo', [AdminController::class, 'getDatakeuanganEO'])->name('getDatakeuanganEO');
    Route::post('cetak/kwitansi', [AdminController::class, 'exKwitansi'])->name('exKwitansi');
	Route::get('json/rekapsaldo', [AdminController::class, 'getRekapsaldo'])->name('getRekapsaldo');
    Route::get('json/rekaphutang', [AdminController::class, 'getrekapHutang'])->name('getrekapHutang');
	Route::post('excutor/simpantransaksi', [AdminController::class, 'simpanTransaksi'])->name('simpanTransaksi');
	Route::post('excutor/exvalidasikwitansi', [AdminController::class, 'exValidasiKwitansi'])->name('exValidasiKwitansi');
	

	Route::get('lapekskul', [GuruController::class, 'viewLapekskul']);
	Route::get('penilaianekskul', [GuruController::class, 'viewNilekskul']);
	Route::post('json/rincianekskul', [GuruController::class, 'jsonRincianekskul'])->name('jsonRincianekskul');
	Route::get('nilekskul/{id}', [GuruController::class, 'viewPenEkskul']);
	
	Route::get('lapabsen', [GuruController::class, 'viewLapabsen']);
	Route::get('json/presensiadmin', [GuruController::class, 'jsonPresensi'])->name('jsonPresensi');
	/*
	Route::get('settema', [GuruController::class, 'viewSettema']);
	Route::post('json/jsontema', [GuruController::class, 'jsonTema'])->name('jsonTema');
	Route::post('guru/simpandatatema', [GuruController::class, 'exSimpandatatema'])->name('exSimpandatatema');
	Route::post('guru/ubahdatatema', [GuruController::class, 'exUbahdatatema'])->name('exUbahdatatema');
	*/
	Route::get('setkkm', [GuruController::class, 'viewSetkkm']);
	Route::post('json/datakkm', [GuruController::class, 'jsonDatakkm'])->name('jsonDatakkm');
	Route::post('guru/exdatakkm', [GuruController::class, 'exDatakkm'])->name('exDatakkm');
	
	Route::get('setrps', [GuruController::class, 'viewRencanaPembelajaran']);
	Route::post('json/jsdatarps', [GuruController::class, 'jsonDataRPS'])->name('jsonDataRPS');
	
	Route::get('kodekd', [GuruController::class, 'viewKodekd']);
	Route::post('json/jsdatakd', [GuruController::class, 'jsonDatakd'])->name('jsonDatakd');
	Route::post('guru/exdatakodekd', [GuruController::class, 'exDatakodekd'])->name('exDatakodekd');
	Route::post('guru/exjadwalrps', [GuruController::class, 'exJadwalRPS'])->name('exJadwalRPS');
	Route::post('json/jsjadwalrps', [GuruController::class, 'jsonJadwalRPS'])->name('jsonJadwalRPS');
	Route::post('json/jssettingnilai', [GuruController::class, 'jsonDataSettingNilai'])->name('jsonDataSettingNilai');

	Route::get('lognilai', [GuruController::class, 'viewLognilai'])->name('lognilai');
	Route::get('kelas/{id}', [GuruController::class, 'viewGradeperkelas']);
	Route::get('prestasialquran', [GuruController::class, 'viewNgajiDashboard']);
	Route::get('tahfidz/{id}', [GuruController::class, 'viewNgaji']);

	Route::get('raportguru', [GuruController::class, 'viewRaportGuru']);
	
	Route::post('guru/uploadnilai', [GuruController::class, 'exUploadnilai'])->name('exUploadnilai');
	Route::post('guru/uploaddatakd', [GuruController::class, 'exUploaddatakd'])->name('exUploaddatakd');
	Route::post('guru/uploaddatakkm', [GuruController::class, 'exUploaddatakkm'])->name('exUploaddatakkm');
	Route::post('guru/inputnilai', [GuruController::class, 'exInputnilai'])->name('exInputnilai');
	Route::post('guru/inputdatadirisiswa', [GuruController::class, 'exInputdatadiri'])->name('exInputdatadiri');
	Route::post('guru/inputabsenekskul', [GuruController::class, 'exInputabsenekskul'])->name('exInputabsenekskul');
	Route::post('guru/inputnilaiekskul', [GuruController::class, 'exInputnilaiekskul'])->name('exInputnilaiekskul');
	Route::get('json/lognilai', [GuruController::class, 'jsonLognilai'])->name('jsonLognilai');
	Route::post('json/rinciannilai', [GuruController::class, 'jsonRinciannilai'])->name('jsonRinciannilai');
	Route::post('guru/exverpresensi', [GuruController::class, 'exVerpresensi'])->name('exVerpresensi');
	Route::post('guru/saveabsenall', [GuruController::class, 'exSaveabsenall'])->name('exSaveabsenall');
	Route::post('guru/saveditnilai', [GuruController::class, 'exSaveditnilai'])->name('exSaveditnilai');
	Route::post('guru/exmultinaikkls', [GuruController::class, 'exMultinaikkls'])->name('exMultinaikkls');
	Route::post('guru/savesetguru', [GuruController::class, 'exSavesetguru'])->name('exSavesetguru');
	Route::post('guru/savenaikkelas', [GuruController::class, 'exSavenaikkelas'])->name('exSavenaikkelas');
	Route::post('json/datakurikulumkelas', [GuruController::class, 'jsonDatakurikulumkelas'])->name('jsonDatakurikulumkelas');
	Route::post('json/jsonformatupload', [GuruController::class, 'jsonFormatupload'])->name('jsonFormatupload');
	Route::post('cetak/biodatarapot', [GuruController::class, 'ctkBiodatarapot'])->name('ctkBiodatarapot');
	Route::post('json/datanilaikelas', [GuruController::class, 'jsonDatanilaikelas'])->name('jsonDatanilaikelas');
	Route::post('json/dataabsenkelas', [GuruController::class, 'jsonDataabsenkelas'])->name('jsonDataabsenkelas');
	Route::post('json/presensicari', [GuruController::class, 'jsonPresensicari'])->name('jsonPresensicari');
	Route::post('json/genrapot', [GuruController::class, 'jsonGenrapot'])->name('jsonGenrapot');
	
	Route::post('json/dataabsenekskul', [GuruController::class, 'jsonDataabsenekskul'])->name('jsonDataabsenekskul');
	Route::post('json/presensiekskulcari', [GuruController::class, 'jsonPresensiekskulcari'])->name('jsonPresensiekskulcari');
	
	Route::post('json/datasetorantahfid', [GuruController::class, 'jsonSetoranTahfid'])->name('jsonSetoranTahfid');
	Route::post('exinputsetoranhafid', [GuruController::class, 'exInputsetoran'])->name('exInputsetoran');
	
	Route::get('konseling', [GuruController::class, 'viewKonseling']);
	Route::get('jrekapkonselingperjenis', [GuruController::class, 'jsonKonselingperbidang']);	
	Route::get('jrekapkonselingthnini', [GuruController::class, 'jsonKonselingthnini']);	
	Route::post('guru/exsimpankonseling', [GuruController::class, 'exSimpankonseling'])->name('exSimpankonseling');
	Route::post('guru/jalldatakonseling', [GuruController::class, 'jsonAlldatakonseling'])->name('jsonAlldatakonseling');
	
	Route::get('biodata', [OrtuController::class, 'index']);
	Route::post('json/viewdatainduk', [OrtuController::class, 'jsonViewDatainduk'])->name('jsonViewDatainduk');
	Route::post('json/getstatdatakd', [OrtuController::class, 'jsonStatistikDatakd'])->name('jsonStatistikDatakd');
	Route::post('json/getstatdatapermuatan', [OrtuController::class, 'jsonStatDatapermuatan'])->name('jsonStatDatapermuatan');
	Route::post('json/getstatdatakehadiran', [OrtuController::class, 'jsonStatDatakehadiran'])->name('jsonStatDatakehadiran');
	
	Route::get('ijinortu', [OrtuController::class, 'viewIjin']);
	Route::post('ortu/exsimpanijin', [OrtuController::class, 'exSimpanijin'])->name('exSimpanijin');
	
	Route::get('lapnilaiortu', [OrtuController::class, 'viewLapnilaiortu']);
	Route::get('ortu/nilaisiswa', [OrtuController::class, 'jsonNilaisiswa'])->name('jsonNilaisiswa');
	Route::post('ortu/exsimpanmhnremidi', [OrtuController::class, 'exSimpanmhnremidi'])->name('exSimpanmhnremidi');
	
	
	Route::get('tagihanrutin', [OrtuController::class, 'viewTagihanrutin']);
	Route::post('ortu/exuploadbuktibyr', [OrtuController::class, 'exUploadbuktibyr'])->name('exUploadbuktibyr');
	Route::post('ortu/bayariuran', [OrtuController::class, 'exBayariuran'])->name('exBayariuran');
	Route::post('ortu/bayariuranins', [OrtuController::class, 'exBayariuranins'])->name('exBayariuranins');
	Route::get('json/insidental', [OrtuController::class, 'jsonInsidental'])->name('jsonInsidental');
	Route::get('json/databayarortu', [OrtuController::class, 'jsonDatabayarortu'])->name('jsonDatabayarortu');
	
	Route::get('tabungan', [OrtuController::class, 'viewTabungan']);
	Route::get('daftarekskul', [OrtuController::class, 'viewDaftarekskul']);
	Route::post('json/daftarekskul', [OrtuController::class, 'jsonDaftarekskul'])->name('jsonDaftarekskul');
	Route::post('ortu/daftarekskul', [OrtuController::class, 'exDaftarekskul'])->name('exDaftarekskul');
	
	Route::get('faqihkecil', [OrtuController::class, 'viewFaqihKecil']);
	Route::get('dashboardpaguyuban', [OrtuController::class, 'viewDataPaguyuban']);

	Route::get('useranyar', [UserController::class, 'viewUser']);
	Route::post('exusername', [UserController::class, 'exUsername'])->name('exusername');
	Route::post('exdaftarortu', [UserController::class, 'exDaftarortu'])->name('exDaftarortu');
	Route::post('user/anyaridata', [UserController::class, 'exProfileupdate'])->name('exProfileupdate');
	Route::get('getallusername', [UserController::class, 'getAllusername'])->name('getallusername');
	
    
	// Account Managemen
	Route::get('usersadmin',[UserController::class, 'viewUserAdmin'])->name('viewUserAdmin');
    Route::get('argonuseradmin',[UserController::class, 'viewUserAdminArgonThem'])->name('argonuseradmin');
    Route::get('datauserall', [UserController::class, 'dataUserAll'])->name('dataUserAll');
	Route::get('/berkaspelamar',[UserController::class, 'viewBerkasPelamar'])->name('viewBerkasPelamar');
    Route::get('/profiluser',[UserController::class, 'viewDataInduk'])->name('viewDataInduk');
    Route::get('/argonprofil',[UserController::class, 'viewDataIndukArgonThem'])->name('argonprofil');
    Route::post('getnotifcount', [UserController::class, 'cekNotifikasi'])->name('cekNotifikasi');
	Route::post('exeditprofil', [UserController::class, 'exEditProfil'])->name('exEditProfil');
	//Belum di Implementasikan
	//Route::get('/backup/public', [BackupController::class, 'backupPublicFolder'])->name('backup.public');
	//Route::get('/backup/database', [BackupController::class, 'backupDatabase'])->name('backup.database');

});

