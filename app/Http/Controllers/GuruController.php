<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessageNotification;
use App\Http\Controllers\SendMail;
use App\Http\Controllers\FrontpageController;
use App\Models\User;
use App\Chatting;
use App\Pengumuman;
use App\Datainduk;
use App\Dataindukstaff;
use App\Datakkm;
use App\Datanilai;
use App\Datakd;
use App\Datapresensi;
use App\Datapresensiekskul;
use App\Datasetorantahfid;
use App\Logstaff;
use App\Ekstrakulikuler;
use App\Setkuangan;
use App\Loginputnilai;
use App\Konseling;
use App\Konselingguru;
use App\Sekolah;
use App\Rapotan;
use App\Prestasi;
use App\Mushaflist;
use App\Ruang;
use App\SettingNilai;
use App\Presensifinger;
use App\RencanaKegiatan;
use App\HPTKeuangan;
use App\RABKegiatan;
use App\EfikasiKeuangan;
use App\XFiles;
use App\KurikulumAlquran;
use App\MushafHalaman;
use App\MushafUjian;
use App\Inboxsurat;
use App\MushafUjianLisan;
use App\Beasiswa;
use Validator;
use Session;
use DateTime;
use QrCode;
use App\QrCodeDatabase;
use App\Models\ShortLink;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
class GuruController extends Controller
{
	private function translateDayName($dayName) {
        $translations = [
            'Monday' 	=> 'Senin',
            'Tuesday' 	=> 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' 	=> 'Kamis',
            'Friday' 	=> 'Jumat',
            'Saturday'	=> 'Sabtu',
            'Sunday' 	=> 'Ahad',
			'Mon' 		=> 'Senin',
            'Tue' 		=> 'Selasa',
            'Wed' 		=> 'Rabu',
            'Thu' 		=> 'Kamis',
            'Fri' 		=> 'Jumat',
            'Sat'		=> 'Sabtu',
            'Sun' 		=> 'Ahad',
        ];
        return isset($translations[$dayName]) ? $translations[$dayName] : $dayName;
    }
	public function viewLognilai() {
		$data   	= [];
		$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		$groups 	= Logstaff::select(DB::Raw('DATE(created_at) day'))->where('id_sekolah',session('sekolah_id_sekolah'))->where('jenis', 'Perubahan Nilai')->groupBy('day')->orderBy('created_at')->limit(30)->get();
		$y      	= 0;
		$x      	= 0;
		foreach ($groups as $group) {
			$tanggal    = $group->day;
			$rsurat     = Logstaff::where('created_at', 'like', '%'. $tanggal . '%')->where('id_sekolah',session('sekolah_id_sekolah'))->where('jenis', 'Perubahan Nilai')->orderBy('id', 'DESC')->get();
			foreach ($rsurat as $rowpeng) {
				$siapa          = $rowpeng->getDataInduk->nama ?? $rowpeng->sopo;
				$pengumuman     = $rowpeng->kelakuan;
				$created_at     = $rowpeng->created_at;
				$kapan          = SendMail::timeago($created_at);
				$iconne			= 'fa fa-bullhorn';
				$jencolor 		= 'red';
				$data['pengumumans'][$x]['tanggal']     =   $created_at;
				$data['pengumumans'][$x]['kapan']       =   $kapan;
				$data['pengumumans'][$x]['jencolor']    =   $jencolor;
				$data['pengumumans'][$x]['siapa']       =   $siapa;
				$data['pengumumans'][$x]['pengumuman']  =   $pengumuman;
				$data['pengumumans'][$x]['icon']        =   $iconne;
				$data['pengumumans'][$x]['jenis']       =   $rowpeng->jenis;
				$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
				if ($y == 9) {
					$y = 0; 
				} else {
					$y++; 
				}
				$x++;
			}
		}
		$data['tahunne']			= date("Y");
		$data['tanggal']			= date("Y-m-d");
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		$data['sidebar']			= 'lognilai';
		if (Session('previlage') == 'level1' OR Session('previlage') == 'Waka Kurikulum'  OR Session('previlage') == 'Waka Kurikulum Al Quran'){
			return view('simaster.lognilai', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }		
	}
	public function viewRaportGuru() {
		$data			= [];
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$semester	= $getdatauser->smt;
			$tapel		= $getdatauser->tapel;
		} else {
			$semester	= '';
			$tapel		= '';
		}
		$data['tahunne']			= date("Y");
		$data['tanggal']			= date("Y-m-d");
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		$data['sidebar']			= 'raportguru';
		if (Session('previlage') == 'level1'){
			$arraypesertakelas		= [];
			$getdatanilaidiri 		= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->whereNotIn('statpeg', ['Non Aktif', 'Pensiun', 'Meninggal', 'Arsip'])->get();
			if (!$getdatanilaidiri->isEmpty()) {
				foreach ($getdatanilaidiri as $hasil) {
					$keaktifanpresensi 		= Loginputnilai::where('niy', $hasil->niy)->where('tapel', $tapel)->where('semester', $semester)->where('jennilai', 'Presensi Kelas')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$presensifinger 		= DB::table('db_presensifinger')->where('nip', $hasil->niy)->where('departemen', $tapel)->where('kantor', $semester)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$keaktifantahfids		= Datasetorantahfid::where('inputor', $hasil->niy)->where('tapel', $tapel)->where('semester', $semester)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('tanggal')->get();
					$keaktifantahfids		= count($keaktifantahfids);
					$arraypesertakelas[] 	= [
						'id' 					=> $hasil->id,	
						'nama' 					=> $hasil->nama,
						'ttl' 					=> $hasil->ttl,
						'nuptk' 				=> $hasil->nuptk,
						'niy' 					=> $hasil->niy,
						'kelamin' 				=> $hasil->kelamin,
						'agama' 				=> $hasil->agama,
						'ijasah' 				=> $hasil->ijasah,
						'jabatan' 				=> $hasil->jabatan,
						'statpeg' 				=> $hasil->statpeg,
						'alamat' 				=> $hasil->alamat,	
						'notelp' 				=> $hasil->notelp,
						'foto' 					=> $hasil->foto,
						'tmt' 					=> $hasil->tmt,
						'idfinger' 				=> $hasil->idfinger,
						'keaktifanpresensi' 	=> $keaktifanpresensi,
						'presensifinger' 		=> $presensifinger,
						'keaktifantahfids' 		=> $keaktifantahfids,
					];
				}
			}
			$data['dataguru'] 		= $arraypesertakelas;
			return view('simaster.kinerjastaf', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
	}
	public function viewLapekskul() {
		$data   					= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru Ekstrakurikuler' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$data['jkelas']				= Datainduk::where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('klspos')->get();
			$data['tahunne']			= date("Y");
			$data['tanggal']			= date("Y-m-d");
			$data['sidebar']			= 'lapekskul';
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['ekstrakulikuler']	= Ekstrakulikuler::where('id_sekolah', Session('sekolah_id_sekolah'))->get();

			return view('simaster.lapekskul', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
			$data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
	}
	public function viewNilekskul() {
		$data   					= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru Ekstrakurikuler' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$data['tahunne']			= date("Y");
			$data['tanggal']			= date("Y-m-d");
			$data['sidebar']			= 'penilaianekskul';
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			return view('simaster.penilaianekskul', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
			$data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
	}
	public function viewLapabsen() {
		$data   		= [];
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($getdatauser->tapel)){
			$klsajar	= $getdatauser->klsajar;
			$smt 		= $getdatauser->smt;
			$tapel 		= $getdatauser->tapel;
		} else {
			$klsajar	= '';
			$smt 		= '';
			$tapel 		= '';
		}
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		$data['klsajar']			= $klsajar;
		$data['smt']				= $smt;
		$data['tapel']				= $tapel;
		$data['jtapel']				= Datapresensi::groupBy('tapel')->get();
		$data['tahunne']			= date("Y");
		$data['tanggal']			= date("Y-m-d");
		$data['sidebar']			= 'lapabsen';
		return view('simaster.lapabsen', $data);
	}
	public function viewRencanaPembelajaran() {
		$data		= [];
		$jgroupps	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('kelas')->select('kelas')->orderBy('kelas')->get();
		$i			= 0;
		$arraymatpel= [];
        foreach ($jgroupps as $rgrpklas) {
            $j  		= 0;
            $kelas		= $rgrpklas->kelas;
            $jklas  	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->where('kelas', $kelas)->get();
            foreach ($jklas as $rklas) {
                $data['matpels'][$i][$j]['matpel']	=   $rklas->matpel.'( '.$rklas->muatan.' )';
                $data['matpels'][$i][$j]['id']		=   $rklas->id;
				$arraymatpel[] = [
					'muatan' 	=> $rklas->muatan,
					'matpel' 	=> $rklas->matpel,
					'kkm' 		=> $rklas->kkm,
				];
                $j++;
            }
            $i++;
        }
		$x  = 0;
        foreach ($jgroupps as $kgrpklas) {
            $data['kelaslist'][$x]  =   $kgrpklas->kelas;
            $x++;
        }
		if ($i == 0){
		    $data['kelaslist'][0]  				=   '-';
        	$data['matpels'][0][0]['matpel']	=   'No Data';
			$data['matpels'][0][0]['id']		=   '0';
			$arraymatpel[0] = array(
				'muatan'		=> 'no data',
				'matpel'		=> '-',
				'kkm'			=> '-',
			);
		} else {
			$arraymatpel = collect($arraymatpel)->groupBy(['muatan'])->map(function ($items) {
				return $items->first();
			})->values()->all();
		}
		$getdatauser	= User::where('id', Session('id'))->first();
		if (isset($getdatauser->tapel)){
			$klsajar		= $getdatauser->klsajar;
			$smt 			= $getdatauser->smt;
			$tapel 			= $getdatauser->tapel;
		} else {
			$klsajar		= '';
			$smt 			= '';
			$tapel 			= '';
		}
		
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		$data['tahunne']			= date("Y");
		$data['tanggal']			= date("Y-m-d");
		$data['sidebar']			= 'rencanapembelajaran';
		$data['ruangans']			= Ruang::where('id_sekolah', Session('sekolah_id_sekolah'))->get();
		$data['dataguru']			= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->get();
		$data['arraymatpel']		= $arraymatpel;
		$data['klsajar']			= $klsajar;
		$data['smt']				= $smt;
		$data['tapel']				= $tapel;
		$data['setidkelas']			= $klsajar;
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			return view('simaster.rencanapembelajaran', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
	}
	public function exDatakodekd(Request $request) {
		$kelas 		= $request->val01;
		$idne 		= $request->val06;
		$error		= '';
		$sukses 	= '';
		if ($kelas == 'getdata'){
			$cekdata= Datakd::where('id', $request->val02)->first();
			if (isset($cekdata->id)){
				return response()->json([
					'icon' 			=> 'success', 
					'warna' 		=> '#5ba035', 
					'status' 		=> 'Data di Temukan', 
					'semester'		=> $cekdata->semester,
					'kelas'			=> $cekdata->kelas,
					'tema'			=> $cekdata->tema,
					'subtema'		=> $cekdata->subtema,
					'deskripsitema'	=> $cekdata->deskripsitema,
					'matpel'		=> $cekdata->matpel,
					'muatan'		=> $cekdata->muatan,
					'kodekd'		=> $cekdata->kodekd,
					'kkm'			=> $cekdata->kkm,
					'materi'		=> $cekdata->materi,
					'deskripsi'		=> $cekdata->deskripsi
				]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else if ($kelas == 'remove'){
			$cekdata= Datakd::where('id', $request->val02)->first();
			if (isset($cekdata->id)){
				$catatan 	= Session('nama').' Menghapus data RPS Mata Pelajaran '.$cekdata->matpel.' Kelas '.$cekdata->kelas.' Kode '.$cekdata->kodekd.' Dengan deskripsi : <strong> '.$cekdata->deskripsi.'</strong><br />Pada :'.date('Y-m-d H:i:s');
				$hapus 		= Datakd::where('id', $request->val02)->delete();
				if ($hapus){
					Logstaff::create([
						'jenis'			=> 'Perubahan RPS', 
						'sopo'			=> Session('nip'),
						'kelakuan'		=> $catatan,
						'id_sekolah' 	=> session('sekolah_id_sekolah')
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $catatan]);
					return back();
				} else { 
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database Error, Silahkan coba beberapa saat lagi']);
					return back(); 
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Tidak Valid, Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($kelas == 'removesettingnilai'){
			$cekdata= SettingNilai::where('id', $request->val02)->first();
			if (isset($cekdata->id)){
				$catatan = Session('nama').' Setting Nilai '.$cekdata->matpel.' Kelas '.$cekdata->kelas.' Kode '.$cekdata->kodekd.' Dengan deskripsi : <strong> '.$cekdata->deskripsi.'</strong><br />Pada :'.date('Y-m-d H:i:s');
				$hapus 	= SettingNilai::where('id', $request->val02)->delete();
				if ($hapus){
					Logstaff::create([
						'jenis'			=> 'Perubahan Setting Nilai', 
						'sopo'			=> Session('nip'),
						'kelakuan'		=> $catatan,
						'id_sekolah' 	=> session('sekolah_id_sekolah')
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $catatan]);
					return back();
				} else { 
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database Error, Silahkan coba beberapa saat lagi']);
					return back(); 
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Tidak Valid, Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($kelas == 'settingnilai'){
			$getdatauser	= User::where('id', Session('id'))->first();
			if (isset($getdatauser->tapel)){
				$semester		= $getdatauser->smt;
				$tapel 			= $getdatauser->tapel;
				$idne 			= $request->val02;
				$penilaian 		= $request->val03;
				$evaluasi 		= $request->val04;
				if ($penilaian == 5){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 1;
					$p04 		= 1;
					$p05 		= 1;
				} else if ($penilaian == 4){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 1;
					$p04 		= 1;
					$p05 		= 0;
				} else if ($penilaian == 3){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 1;
					$p04 		= 0;
					$p05 		= 0;
				} else if ($penilaian == 2){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 0;
					$p04 		= 0;
					$p05 		= 0;
				} else {
					$p01 		= 1;
					$p02 		= 0;
					$p03 		= 0;
					$p04 		= 0;
					$p05 		= 0;
				}
				if ($evaluasi == 5){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 1;
					$e04 		= 1;
					$e05 		= 1;
				} else if ($evaluasi == 4){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 1;
					$e04 		= 1;
					$e05 		= 0;
				} else if ($evaluasi == 3){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 1;
					$e04 		= 0;
					$e05 		= 0;
				} else if ($evaluasi == 2){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 0;
					$e04 		= 0;
					$e05 		= 0;
				} else {
					$e01 		= 1;
					$e02 		= 0;
					$e03 		= 0;
					$e04 		= 0;
					$e05 		= 0;
				}
				$getdatakd 		= Datakd::where('id', $idne)->first();
				if (isset($getdatakd->id)){
					$idkd		= $getdatakd->id;
					$muatan 	= $getdatakd->muatan;
					$matpel		= $getdatakd->matpel;
					$kelas 		= $getdatakd->kelas;
					$kodekd		= $getdatakd->kodekd;
					$kkm		= $getdatakd->kkm;

					$cekmasuk 	= SettingNilai::where('semester', $semester)->where('tapel', $tapel)->where('idkd', $idkd)->count();
					if ($cekmasuk == 0){
						$kerja 	= SettingNilai::create([
							'semester'		=> $semester,
							'kelas'			=> $kelas,
							'tapel'			=> $tapel,
							'matpel'		=> $matpel,
							'muatan'		=> $muatan,
							'kodekd'		=> $kodekd,
							'idkd'			=> $idkd,
							'kkm'			=> $kkm,
							'deskripsi'		=> $getdatakd->deskripsi,
							'muatan'		=> $getdatakd->muatan,
							'p01'			=> $p01,
							'p02'			=> $p02,
							'p03'			=> $p03,
							'p04'			=> $p04,
							'p05'			=> $p05,
							'e01'			=> $e01,
							'e02'			=> $e02,
							'e03'			=> $e03,
							'e04'			=> $e04,
							'e05'			=> $e05,
							'pts'			=> 1,
							'pat'			=> 1,
							'id_sekolah'	=> session('sekolah_id_sekolah')
						]);
						if ($kerja){
							$sukses = $sukses. 'Ploting Komponen Nilai '.$muatan.' Kelas '.$kelas.' dengan kode '.$kodekd.' Berhasil di Input';
						} else {
							$error = $error.'Gagal Input Sistem Error, Silahkan Coba Beberapa Saat Lagi.';
						}
					} else {
						$error = $error.'Komponen Nilai '.$muatan.' Kelas '.$kelas.' dengan kode '.$kodekd.' sudah ada, periksa kembali isian Bapak/Ibu atau refresh laman ini';
					}
				} else {
					$error = $error.'Gagal Input, ID KD Tidak Valid '.$idne;
				}
				
			} else {
				$error = $error.' Bapak/Ibu mohon setting dulu Semester dan Tapel Bapak/Ibu';
			}
			if ($error == ''){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else if($kelas == 'settingnilaimulti'){
			$getdatauser	= User::where('id', Session('id'))->first();
			if (isset($getdatauser->tapel)){
				$semester		= $getdatauser->smt;
				$tapel 			= $getdatauser->tapel;
				$muatan 		= $request->val02;
				$penilaian 		= $request->val03;
				$evaluasi 		= $request->val04;
				$kelas 			= $request->val05;
				
				if ($penilaian == 5){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 1;
					$p04 		= 1;
					$p05 		= 1;
				} else if ($penilaian == 4){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 1;
					$p04 		= 1;
					$p05 		= 0;
				} else if ($penilaian == 3){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 1;
					$p04 		= 0;
					$p05 		= 0;
				} else if ($penilaian == 2){
					$p01 		= 1;
					$p02 		= 1;
					$p03 		= 0;
					$p04 		= 0;
					$p05 		= 0;
				} else {
					$p01 		= 1;
					$p02 		= 0;
					$p03 		= 0;
					$p04 		= 0;
					$p05 		= 0;
				}
				if ($evaluasi == 5){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 1;
					$e04 		= 1;
					$e05 		= 1;
				} else if ($evaluasi == 4){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 1;
					$e04 		= 1;
					$e05 		= 0;
				} else if ($evaluasi == 3){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 1;
					$e04 		= 0;
					$e05 		= 0;
				} else if ($evaluasi == 2){
					$e01 		= 1;
					$e02 		= 1;
					$e03 		= 0;
					$e04 		= 0;
					$e05 		= 0;
				} else {
					$e01 		= 1;
					$e02 		= 0;
					$e03 		= 0;
					$e04 		= 0;
					$e05 		= 0;
				}
				if ($muatan == 'ALL'){
					if ($kelas == 'ALL'){
						$sql = Datakd::where('id_sekolah', session('sekolah_id_sekolah'))->whereNotIn('id', SettingNilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->pluck('idkd'))->get();
					} else {
						$sql = Datakd::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $kelas)->whereNotIn('id', SettingNilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->pluck('idkd'))->get();
					}
				} else {
					if ($kelas == 'ALL'){
						$sql = Datakd::where('id_sekolah', session('sekolah_id_sekolah'))->where('muatan', $muatan)->whereNotIn('id', SettingNilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->pluck('idkd'))->get();
					} else {
						$sql = Datakd::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $kelas)->where('muatan', $muatan)->whereNotIn('id', SettingNilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->pluck('idkd'))->get();
					}
				}
				if (!empty($sql)){
					foreach($sql as $getdatakd){
						$idkd		= $getdatakd->id;
						$muatan 	= $getdatakd->muatan;
						$matpel		= $getdatakd->matpel;
						$kelas 		= $getdatakd->kelas;
						$kodekd		= $getdatakd->kodekd;
						$kkm		= $getdatakd->kkm;
						$input 		= SettingNilai::updateOrCreate(
							[
								'semester'	=> $semester,
								'tapel'		=> $tapel,
								'idkd'		=> $idkd,
								'id_sekolah'=> session('sekolah_id_sekolah')
							],
							[
								'kelas'			=> $kelas,
								'matpel'		=> $matpel,
								'muatan'		=> $muatan,
								'kodekd'		=> $kodekd,
								'kkm'			=> $kkm,
								'deskripsi'		=> $getdatakd->deskripsi,
								'muatan'		=> $getdatakd->muatan,
								'p01'			=> $p01,
								'p02'			=> $p02,
								'p03'			=> $p03,
								'p04'			=> $p04,
								'p05'			=> $p05,
								'e01'			=> $e01,
								'e02'			=> $e02,
								'e03'			=> $e03,
								'e04'			=> $e04,
								'e05'			=> $e05,
								'pts'			=> 1,
								'pat'			=> 1,
							]
						);
						if ($input){
							$sukses = $sukses. 'Ploting Komponen Nilai '.$muatan.' Kelas '.$kelas.' dengan kode '.$kodekd.' Berhasil di Input';
						} else {
							$error = $error.'Gagal Input Sistem Error, Silahkan Coba Beberapa Saat Lagi.';
						}
					}
				}
			} else {
				$error = $error.' Bapak/Ibu mohon setting dulu Semester dan Tapel Bapak/Ibu';
			}
			if ($error == ''){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else {
			if ($idne == 'baru'){
				$cekmatkul = Datakkm::where('id', $request->val09)->first();
				if (isset($cekmatkul->id)){
					$cekmasuk = Datakd::where('muatan', $cekmatkul->muatan)->where('kelas', $cekmatkul->kelas)->where('kodekd', $request->val07)->where('tema', $request->val02)->where('subtema', $request->val03)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$kerja 	= Datakd::create([
							'semester'		=> $request->val01,
							'tema'			=> $request->val02,
							'subtema'		=> $request->val03,
							'deskripsitema'	=> $request->val04,
							'deskripsi'		=> $request->val05,
							'kodekd'		=> $request->val07,
							'kkm'			=> $request->val08,
							'kelas'			=> $cekmatkul->kelas,
							'matpel'		=> $cekmatkul->matpel,
							'muatan'		=> $cekmatkul->muatan,
							'materi'		=> $request->val10,
							'pertemuanke'	=> $request->val11,
							'id_sekolah'	=> session('sekolah_id_sekolah')
						]);
						if ($kerja){
							$sukses = $sukses. 'Data Kode KD Kelas '.$cekmatkul->kelas.' Mata Pelajaran '.$cekmatkul->matpel.' Berhasil di Input';
						} else {
							$error = $error.'Gagal Input Sistem Error, Silahkan Coba Beberapa Saat Lagi.';
						}
					} else {
						$error = $error.'Gagal Input Kode '.$request->val07.' Untuk Mata Pelajaran '.$cekmatkul->matpel.' Kelas '.$cekmatkul->kelas.' Pada Tema '.$cekmatkul->tema.'('.$cekmatkul->subtema.') Sudah ada, mohon mengggantinya dengan kode unik lainnya';
					}
				} else {
					$error = $error.'Gagal Input, ID Matpel Tidak Valid '.$request->val09;
				}
			} else {
				$cekdata= Datakd::where('id', $idne)->first();
				if (isset($cekdata->id)){
					$cekkodekembar = Datakd::where('muatan', $cekdata->muatan)
									->where('kelas', $cekdata->kelas)
									->where('kodekd', $request->val07)
									->where('tema', $cekdata->tema)
									->where('subtema', $cekdata->subtema)
									->where('id', '!=', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekkodekembar == 0){
						$kerja 	= Datakd::where('id', $idne)->update([
							'semester'		=> $request->val01,
							'tema'			=> $request->val02,
							'subtema'		=> $request->val03,
							'deskripsitema'	=> $request->val04,
							'deskripsi'		=> $request->val05,
							'kodekd'		=> $request->val07,
							'kkm'			=> $request->val08,
							'materi'		=> $request->val09,
							'pertemuanke'	=> $request->val11,
							'updated_at'	=> date('Y-m-d H:i:s')
						]);
						if ($kerja){
							$sukses = $sukses. 'Data RPS di Update';
						} else {
							$error = $error.'Gagal Update Sistem Error, Silahkan Coba Beberapa Saat Lagi.';
						}
					} else {
						$error = $error.'Gagal Input Kode '.$request->val07.' Untuk Mata Pelajaran '.$cekdata->matpel.' Kelas '.$cekdata->kelas.' Pada Tema '.$cekdata->tema.'('.$cekdata->subtema.') Sudah ada, mohon mengggantinya dengan kode unik lainnya';
					}
				} else {
					$error = $error.' ID '.$idne.' Tidak Valid';
				}
			}
			if ($error == ''){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		}
	}
	public function viewPenEkskul($id){
		$data 						= [];
		$tahun						= date("Y");
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		$data['sidebar'] 			= 'penilaianekskul';
		$iduser						= Session('id');
		$getdatauser				= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$klsajar				= $getdatauser->klsajar;
			$smt 					= $getdatauser->smt;
			$tapel 					= $getdatauser->tapel;
		} else {
			$klsajar				= '';
			$smt 					= '';
			$tapel 					= '';
		}
		$getnama					= Ekstrakulikuler::where('id', $id)->first();
		if (isset($getnama->nama)){
			$set01 	= $getnama->nama;
			if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru Ekstrakurikuler' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
				$sql 	= DB::table('db_setkeuangan')
								->join('db_datainduk', 'db_setkeuangan.noinduk', 'db_datainduk.noinduk')
								->where('db_setkeuangan.id_sekolah', session('sekolah_id_sekolah'))
								->where('db_datainduk.nokelulusan', '')
								->select('db_datainduk.nama', 'db_datainduk.klspos', 'db_datainduk.noinduk', 'db_datainduk.foto', 'db_datainduk.alamatortu', 'db_datainduk.nisn', 'db_setkeuangan.eksul1', 'db_setkeuangan.eksul2', 'db_setkeuangan.eksul3', 'db_setkeuangan.eksul4', 'db_setkeuangan.eksul5')
								->where(function ($query) use ($set01) {
								$query->where('db_setkeuangan.eksul1', $set01)
									->orWhere('db_setkeuangan.eksul2', $set01)
									->orWhere('db_setkeuangan.eksul3', $set01)
									->orWhere('db_setkeuangan.eksul4', $set01)
									->orWhere('db_setkeuangan.eksul5', $set01);
							})->get();
				$y 		= 0;
				if (!empty($sql)){
					foreach ($sql as $hasil){
						if ($set01 == $hasil->eksul1){ $urutan = 1; }
						else if ($set01 == $hasil->eksul2){ $urutan = 2; }
						else if ($set01 == $hasil->eksul3){ $urutan = 3; }
						else if ($set01 == $hasil->eksul4){ $urutan = 4; }
						else if ($set01 == $hasil->eksul5){ $urutan = 5; }
						else { $urutan = 0; }
						$nilairapot 			= '';
						$getdata 				= Rapotan::where('noinduk', $hasil->noinduk)->where('semester', $smt)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
						$ekstrakulikuler1 		= $getdata->ekstrakulikuler1 ?? '';
						$ekstrakulikuler2 		= $getdata->ekstrakulikuler2 ?? '';
						$ekstrakulikuler3 		= $getdata->ekstrakulikuler3 ?? '';
						$ekstrakulikuler4 		= $getdata->ekstrakulikuler4 ?? '';
						$ekstrakulikuler5 		= $getdata->ekstrakulikuler5 ?? '';
						if ($set01 == $ekstrakulikuler1){ $nilairapot = $getdata->nildeskripsieks1 ?? ''; }
						else if ($set01 == $ekstrakulikuler2){ $nilairapot = $getdata->nildeskripsieks2 ?? ''; }
						else if ($set01 == $ekstrakulikuler3){ $nilairapot = $getdata->nildeskripsieks3 ?? ''; }
						else if ($set01 == $ekstrakulikuler4){ $nilairapot = $getdata->nildeskripsieks4 ?? ''; }
						else if ($set01 == $ekstrakulikuler5){ $nilairapot = $getdata->nildeskripsieks5 ?? ''; }
						else { $nilairapot = ''; }
						$data['datasiswa'][$y]['nama']  	= $hasil->nama;
						$data['datasiswa'][$y]['noinduk'] 	= $hasil->noinduk;
						$data['datasiswa'][$y]['kelas'] 	= $hasil->klspos;
						$data['datasiswa'][$y]['urutan'] 	= $urutan;
						$data['datasiswa'][$y]['nisn'] 		= $hasil->nisn;
						$data['datasiswa'][$y]['alamat'] 	= $hasil->alamatortu;
						$data['datasiswa'][$y]['foto'] 		= $hasil->foto;
						$data['datasiswa'][$y]['nilairapot']= $nilairapot;
						$y++;
					}
				}
				if ($y == 0){
					$data['datasiswa'][$y]['nama']  	= 'Tidak ada peserta';
					$data['datasiswa'][$y]['noinduk'] 	= '';
					$data['datasiswa'][$y]['kelas'] 	= '';
					$data['datasiswa'][$y]['nisn'] 		= '0';
					$data['datasiswa'][$y]['alamat'] 	= '';
					$data['datasiswa'][$y]['foto'] 		= '';
					$data['datasiswa'][$y]['urutan'] 	= '0';
				}
				$data['klsajar']	= $klsajar;
				$data['smt']		= $smt;
				$data['tapel']		= $tapel;
				$data['idekskul']	= $id;
				$data['namaekskul']	= $set01;
				return view('simaster.nilharianekskul', $data);
			} else {
				$data['kalimatheader']  	= 'Mohon Maaf';
				$data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
				return view('errors.notready', $data);
			}
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'ID Ekstrakulikuler '.$id.' tidak ditemukan, mohon periksa kembali url anda.';
            return view('errors.notready', $data);
        }
    }
	public function viewGradeperkelas($id) {
		$data 				= [];
		$data['sidebar']	= $id;
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$vowels 		= array("grade");
			$setidkelas 	= str_replace($vowels, "", $id);
			$arrnomor1 		= str_split($setidkelas);
			$nomer1 		= $arrnomor1[0];
			$nomer2 		= $arrnomor1[0];
			if ($nomer2 == '1' OR $nomer2 = '0'){
				$masterkls	= $nomer1.$nomer2;
			} else if ($nomer2 == 'A' OR $nomer2 = 'B'){
				$masterkls	= $setidkelas;
			}else { $masterkls = $nomer1; }
			$masterkls = substr($masterkls, 0, -1);
		
			if (session('sekolah_level') == 1){
				$data['minkelasa']	= 'TA-A.1';
				$data['minkelasb']	= 'TA-A.2';
				$data['minkelasc']	= 'TA-A.3';

				$data['masterklsa']	= 'TA-B.1';
				$data['masterklsb']	= 'TA-B.2';
				$data['masterklsc']	= 'TA-B.3';
			} else if (session('sekolah_level') == 2){
				$minkelasa			= $masterkls.'A';
				$minkelasb			= $masterkls.'B';
				$minkelasc			= $masterkls.'C';
				$masterklsa			= ($masterkls+1).'A';
				$masterklsb			= ($masterkls+1).'B';
				$masterklsc			= ($masterkls+1).'C';
				$data['minkelasa']	= $minkelasa;
				$data['minkelasb']	= $minkelasb;
				$data['minkelasc']	= $minkelasc;

				$data['masterklsa']	= $masterklsa;
				$data['masterklsb']	= $masterklsb;
				$data['masterklsc']	= $masterklsc;
			} else {
				$minkelasa			= $masterkls.'A';
				$minkelasb			= $masterkls.'B';
				$minkelasc			= $masterkls.'C';
				$minkelasd			= $masterkls.'D';
				$minkelase			= $masterkls.'E';
				$minkelasf			= $masterkls.'F';
				$minkelasg			= $masterkls.'G';
				$minkelash			= $masterkls.'H';
				$minkelasi			= $masterkls.'I';
				$masterklsa			= ($masterkls+1).'A';
				$masterklsb			= ($masterkls+1).'B';
				$masterklsc			= ($masterkls+1).'C';
				$masterklsd			= ($masterkls+1).'D';
				$masterklse			= ($masterkls+1).'E';
				$masterklsf			= ($masterkls+1).'F';
				$masterklsg			= ($masterkls+1).'G';
				$masterklsh			= ($masterkls+1).'H';
				$masterklsi			= ($masterkls+1).'I';
				$data['minkelasa']	= $minkelasa;
				$data['minkelasb']	= $minkelasb;
				$data['minkelasc']	= $minkelasc;
				$data['minkelasd']	= $minkelasd;
				$data['minkelase']	= $minkelase;
				$data['minkelasf']	= $minkelasf;
				$data['minkelasg']	= $minkelasg;
				$data['minkelash']	= $minkelash;
				$data['minkelasi']	= $minkelasi;
		
				$data['masterklsa']	= $masterklsa;
				$data['masterklsb']	= $masterklsb;
				$data['masterklsc']	= $masterklsc;	
				$data['masterklsd']	= $masterklsd;
				$data['masterklse']	= $masterklse;
				$data['masterklsf']	= $masterklsf;	
				$data['masterklsg']	= $masterklsg;
				$data['masterklsh']	= $masterklsh;
				$data['masterklsi']	= $masterklsi;	
			}
			$tahun				= date("Y");
			$tanggal			= date("Y-m-d");
			$iduser				= Session('id');
			$getdatauser		= User::where('id', $iduser)->first();
			$klsajar			= $getdatauser->klsajar ?? '';
			$smt 				= $getdatauser->smt ?? '';
			$tapel 				= $getdatauser->tapel ?? '';
			$nip 				= $getdatauser->nip ?? '';
			$cekidmark2 		= XFiles::where('xmarking', 'TTD-'.Session('username'))->first();
			$tandatangan 		= $cekidmark2->xfile ?? '';
			$getdatanilaidiri 	= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('klspos', $setidkelas)->where('nokelulusan', '')->get();
			if (!$getdatanilaidiri->isEmpty()) {
				foreach ($getdatanilaidiri as $rows) {
					$ceksudahrapot 			= Rapotan::where('noinduk', $rows->noinduk)->where('tapel', $tapel)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					$ceksudahabsen 			= Datapresensi::where('noinduk', $rows->noinduk)->where('tanggal', $tanggal)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					$arraypesertakelas[] 	= [
						'id' 				=> $rows->id,
						'nama' 				=> $rows->nama,
						'noinduk' 			=> $rows->noinduk,
						'klspos' 			=> $rows->klspos,
						'foto' 				=> $rows->foto,
						'alamat' 			=> $rows->alamatortu,
						'nisn' 				=> $rows->nisn,
						'ekstrakulikuler1' 	=> $ceksudahrapot->ekstrakulikuler1 ?? '',
						'nildeskripsieks1' 	=> $ceksudahrapot->nildeskripsieks1 ?? '',
						'ekstrakulikuler2' 	=> $ceksudahrapot->ekstrakulikuler2 ?? '',
						'nildeskripsieks2' 	=> $ceksudahrapot->nildeskripsieks2 ?? '',
						'ekstrakulikuler3' 	=> $ceksudahrapot->ekstrakulikuler3 ?? '',
						'nildeskripsieks3' 	=> $ceksudahrapot->nildeskripsieks3 ?? '',
						'ekstrakulikuler4' 	=> $ceksudahrapot->ekstrakulikuler4 ?? '',
						'nildeskripsieks4' 	=> $ceksudahrapot->nildeskripsieks4 ?? '',
						'ekstrakulikuler5' 	=> $ceksudahrapot->ekstrakulikuler5 ?? '',
						'nildeskripsieks5' 	=> $ceksudahrapot->nildeskripsieks5 ?? '',
						'tbs1' 				=> $ceksudahrapot->tbs1 ?? '',
						'tbs2' 				=> $ceksudahrapot->tbs2 ?? '',
						'bbs1' 				=> $ceksudahrapot->bbs1 ?? '',
						'bbs2' 				=> $ceksudahrapot->bbs2 ?? '',
						'pendengaran' 		=> $ceksudahrapot->pendengaran ?? '',
						'penglihatan' 		=> $ceksudahrapot->penglihatan ?? '',
						'gigi' 				=> $ceksudahrapot->gigi ?? '',
						'kesehatanlain' 	=> $ceksudahrapot->kesehatanlain ?? '',
						'statuspresensi' 	=> $ceksudahabsen->status ?? '',
						'keteranganpresensi'=> $ceksudahabsen->alasan ?? '',
						'surat'				=> $ceksudahabsen->surat ?? '',
						'idsurat'			=> $ceksudahabsen->id ?? '0',
					];
				}
			} else {
				$arraypesertakelas[] 	= [
					'id' 				=> '0',
					'nama' 				=> 'No Data',
					'noinduk' 			=> '',
					'klspos' 			=> '',
					'foto' 				=> '',
					'alamat' 			=> '',
					'nisn' 				=> '',
					'ekstrakulikuler1' 	=> '',
					'nildeskripsieks1' 	=> '',
					'ekstrakulikuler2' 	=> '',
					'nildeskripsieks2' 	=> '',
					'ekstrakulikuler3' 	=> '',
					'nildeskripsieks3' 	=> '',
					'ekstrakulikuler4' 	=> '',
					'nildeskripsieks4' 	=> '',
					'ekstrakulikuler5' 	=> '',
					'nildeskripsieks5' 	=> '',
					'tbs1' 				=> '',
					'tbs2' 				=> '',
					'bbs1' 				=> '',
					'bbs2' 				=> '',
					'pendengaran' 		=> '',
					'penglihatan' 		=> '',
					'gigi' 				=> '',
					'kesehatanlain' 	=> '',
					'statuspresensi' 	=> '',
					'keteranganpresensi'=> '',
					'surat'				=> '',
					'idsurat'			=> '0',
				];
			}
			$data['tandatangan']		= $tandatangan;
			$data['masterkls']			= $masterkls;
			$data['setidkelas']			= $setidkelas;
			$data['klsajar']			= $klsajar;
			$data['smt']				= $smt;
			$data['tapel']				= $tapel;
			$data['datasiswa']			= $arraypesertakelas;
			$data['tahunne']			= $tahun;
			$data['tanggal']			= $tanggal;
			return view('simaster.penilaian', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function viewGradeperTahap($id) {
		$data 					= [];
		$data['sidebar']		= $id;
		$setidkelas				= $id;
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$vowels 			= array("A", "B");
			$masterkls 			= str_replace($vowels, "", $id);
			$data['minkelasa']	= '1A';
			$data['minkelasb']	= '1B';
			$data['minkelasc']	= '1C';
			$data['masterklsa']	= '2A';
			$data['masterklsb']	= '2B';
			$data['masterklsc']	= '2C';
			$tahun				= date("Y");
			$tanggal			= date("Y-m-d");
			$iduser				= Session('id');
			$getdatauser		= User::where('id', $iduser)->first();
			if (isset($getdatauser->tapel)){
				$klsajar		= $getdatauser->klsajar;
				$smt 			= $getdatauser->smt;
				$tapel 			= $getdatauser->tapel;
			} else {
				$klsajar		= '';
				$smt 			= '';
				$tapel 			= '';
			}
			$getdatanilaidiri 				= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('klspos', $setidkelas)->where('nokelulusan', '')->get();
			if (!$getdatanilaidiri->isEmpty()) {
				foreach ($getdatanilaidiri as $rows) {
					$ceksudahrapot 			= Rapotan::where('noinduk', $rows->noinduk)->where('kelas', $setidkelas)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					$ceksudahabsen 			= Datapresensi::where('noinduk', $rows->noinduk)->where('tanggal', $tanggal)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					$arraypesertakelas[] 	= [
						'id' 				=> $rows->id,
						'nama' 				=> $rows->nama,
						'noinduk' 			=> $rows->noinduk,
						'klspos' 			=> $rows->klspos,
						'foto' 				=> $rows->foto,
						'alamat' 			=> $rows->alamatortu,
						'nisn' 				=> $rows->nisn,
						'ekstrakulikuler1' 	=> $ceksudahrapot->ekstrakulikuler1 ?? '',
						'nildeskripsieks1' 	=> $ceksudahrapot->nildeskripsieks1 ?? '',
						'ekstrakulikuler2' 	=> $ceksudahrapot->ekstrakulikuler2 ?? '',
						'nildeskripsieks2' 	=> $ceksudahrapot->nildeskripsieks2 ?? '',
						'ekstrakulikuler3' 	=> $ceksudahrapot->ekstrakulikuler3 ?? '',
						'nildeskripsieks3' 	=> $ceksudahrapot->nildeskripsieks3 ?? '',
						'ekstrakulikuler4' 	=> $ceksudahrapot->ekstrakulikuler4 ?? '',
						'nildeskripsieks4' 	=> $ceksudahrapot->nildeskripsieks4 ?? '',
						'ekstrakulikuler5' 	=> $ceksudahrapot->ekstrakulikuler5 ?? '',
						'nildeskripsieks5' 	=> $ceksudahrapot->nildeskripsieks5 ?? '',
						'tbs1' 				=> $ceksudahrapot->tbs1 ?? '',
						'tbs2' 				=> $ceksudahrapot->tbs2 ?? '',
						'bbs1' 				=> $ceksudahrapot->bbs1 ?? '',
						'bbs2' 				=> $ceksudahrapot->bbs2 ?? '',
						'pendengaran' 		=> $ceksudahrapot->pendengaran ?? '',
						'penglihatan' 		=> $ceksudahrapot->penglihatan ?? '',
						'gigi' 				=> $ceksudahrapot->gigi ?? '',
						'kesehatanlain' 	=> $ceksudahrapot->kesehatanlain ?? '',
						'statuspresensi' 	=> $ceksudahabsen->status ?? '',
						'keteranganpresensi'=> $ceksudahabsen->alasan ?? '',
						'surat'				=> $ceksudahabsen->surat ?? '',
						'idsurat'			=> $ceksudahabsen->id ?? '0',
					];
				}
			} else {
				$arraypesertakelas[] 		= [
					'id' 				=> '0',
					'nama' 				=> 'No Data',
					'noinduk' 			=> '',
					'klspos' 			=> '',
					'foto' 				=> '',
					'alamat' 			=> '',
					'nisn' 				=> '',
					'ekstrakulikuler1' 	=> '',
					'nildeskripsieks1' 	=> '',
					'ekstrakulikuler2' 	=> '',
					'nildeskripsieks2' 	=> '',
					'ekstrakulikuler3' 	=> '',
					'nildeskripsieks3' 	=> '',
					'ekstrakulikuler4' 	=> '',
					'nildeskripsieks4' 	=> '',
					'ekstrakulikuler5' 	=> '',
					'nildeskripsieks5' 	=> '',
					'tbs1' 				=> '',
					'tbs2' 				=> '',
					'bbs1' 				=> '',
					'bbs2' 				=> '',
					'pendengaran' 		=> '',
					'penglihatan' 		=> '',
					'gigi' 				=> '',
					'kesehatanlain' 	=> '',
					'statuspresensi' 	=> '',
					'keteranganpresensi'=> '',
					'surat'				=> '',
					'idsurat'			=> '0',
				];
			}
			if ($masterkls == '1'){
				$kelas = 'kb';
			} else if ($masterkls == '2'){
				$kelas = 'ta';
			} else {
				$kelas = $masterkls;
			}
			$jgroupps		= Datakd::where('id_sekolah',session('sekolah_id_sekolah'))->where('kelas', $kelas)->groupBy('muatan')->select('muatan', 'kelas', 'semester')->orderBy('muatan')->get();
			$i				= 0;
			foreach ($jgroupps as $rgrpklas) {
				$j  		= 0;
				$muatan		= $rgrpklas->muatan;
				$jklas  	= Datakd::where('id_sekolah', Session('sekolah_id_sekolah'))->where('kelas', $kelas)->where('muatan', $rgrpklas->muatan)->get();
				foreach ($jklas as $rklas) {
					$data['komponendasar'][$i][$j]['deskripsi']	=   $rklas->kodekd.' Semester '.$rklas->semester.' ( '.$rklas->deskripsi.' )';
					$data['komponendasar'][$i][$j]['id']		=   $rklas->id;
					$j++;
				}
				$i++;
			}
			$x  = 0;
			foreach ($jgroupps as $kgrpklas) {
				$data['muatanlist'][$x]  = $kgrpklas->muatan;
				$x++;
			}
			if ($i == 0){
				$data['muatanlist'][0]  						=   '-';
				$data['komponendasar'][0][0]['deskripsi']		=   'No Data';
				$data['komponendasar'][0][0]['id']				=   '0';
			}
			$cekidmark2 = XFiles::where('xmarking', 'TTD-'.Session('username'))->first();
			if (isset($cekidmark2->xid)){
				$tandatangan = $cekidmark2->xfile;
			} else {
				$tandatangan = '';
			}
			$data['tandatangan']		= $tandatangan;
			$data['masterkls']			= $masterkls;
			$data['setidkelas']			= $setidkelas;
			$data['klsajar']			= $klsajar;
			$data['smt']				= $smt;
			$data['tapel']				= $tapel;
			$data['datasiswa']			= $arraypesertakelas;
			$data['jadwal']				= DB::table('jadwal_pembelajaran')->where('id_sekolah',session('sekolah_id_sekolah'))->where('kelas', $masterkls)->where('semester', $smt)->where('guruterjadwal', Session('nama'))->get();
			$data['ruangans']			= Ruang::where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			$data['tahunne']			= $tahun;
			$data['tanggal']			= $tanggal;
			return view('simaster.penilaiantpq', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function viewUjianLisanperkelas($id) {
		$data 				= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$vowels 		= array("A", "B", "C", "D", "E", "F", "G", "H", "I");
			$urlkembali 	= url('/').'/kelas/grade'.$id;
			$setidkelas 	= str_replace($vowels, "", $id);
			$iduser			= Session('id');
			$getdatauser	= User::where('id', $iduser)->first();
			if (isset($getdatauser->tapel)){
				$klsajar	= $getdatauser->klsajar;
				$smt 		= $getdatauser->smt;
				$tapel 		= $getdatauser->tapel;
			} else {
				$klsajar	= '';
				$smt 		= '';
				$tapel 		= '';
			}
			$arraypesertakelas 			= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('klspos', 'LIKE', $setidkelas.'%')->where('nokelulusan', '')->get();
			$data['urlkembali']			= $urlkembali;
			$data['setidkelas']			= $setidkelas;
			$data['klsajar']			= $klsajar;
			$data['smt']				= $smt;
			$data['tapel']				= $tapel;
			$data['datasiswa']			= $arraypesertakelas;
			return view('simaster.ujianlisan', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function viewLegger($id) {
		$data 				= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$vowels 				= array("A", "B", "C", "D", "E", "F", "G", "H", "I");
			$urlkembali 			= url('/').'/kelas/grade'.$id;
			$setidkelas 			= str_replace($vowels, "", $id);
			$iduser					= Session('id');
			$getdatauser			= User::where('id', $iduser)->first();
			$klsajar				= $getdatauser->klsajar ?? '';
			$smt 					= $getdatauser->smt ?? '';
			$tapel 					= $getdatauser->tapel ?? '';
			$dataleggerpart1 		= [];
			$matpelnonlisan 		= [];
			$i 						= 0;
			$matpelsall 			= Datakkm::where('id_sekolah',session('sekolah_id_sekolah'))->where('kelas', $setidkelas)->orderBy('jenis', 'DESC')->orderBy('matpel', 'ASC')->get();
			$arraypesertakelas 		= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('klspos', $id)->where('nokelulusan', '')->get();
			foreach ($arraypesertakelas as $siswa) {
				$totalhari1     = 0;
				$cekhadir1      = 0;
				$semester1ijin  = 0;
				$semester1sakit = 0;
				$semester1alpha = 0;
				
				$totalhari2     = 0;
				$cekhadir2      = 0;
				$semester2ijin  = 0;
				$semester2sakit = 0;
				$semester2alpha = 0;
				$semester1ms    = 0;
				$semester1mr    = 0;
				$semester1hua   = '';
				$semester1nua   = '';
				$semester2ms    = 0;
				$semester2mr    = 0;
				$semester2hua   = '';
				$semester2nua   = '';
				$semester1balsn = 0; //nilai Ujian Lisan Bahasa Arab semester 1
				$semester1bilsn = 0; //nilai Ujian Lisan Bahasa Inggris semester 1
				$semester1pailsn= 0; //nilai Ujian Lisan PAI semester 1
				$semester2balsn = 0; //nilai Ujian Lisan Bahasa Arab semester 2
				$semester2bilsn = 0; //nilai Ujian Lisan Bahasa Inggris semester 2
				$semester2pailsn= 0; //nilai Ujian Lisan PAI semester 2
				$semester1batls = 0; //nilai Ujian Tulis Bahasa Arab semester 1
				$semester1bitls = 0; //nilai Ujian Tulis Bahasa Inggris semester 1
				$semester1paitls= 0; //nilai Ujian Tulis PAI semester 1
				$semester2batls = 0; //nilai Ujian Tulis Bahasa Arab semester 2
				$semester2bitls = 0; //nilai Ujian Tulis Bahasa Inggris semester 2
				$semester2paitls= 0; //nilai Ujian Tulis PAI semester 2
                $totalbabingpai = 0;
				$totallainnya 	= 0;             
				$semesterData 	= Datapresensi::where('tapel', $tapel)->where('id_sekolah', $siswa->id_sekolah)->where('noinduk', $siswa->noinduk)->get();
				foreach ([1, 2] as $smt) {
					$semester = $semesterData->where('semester', $smt);
					if ($smt == 1) {
						$totalhari1     = $semester->unique('tanggal')->count();
						$cekhadir1      = $semester->whereIn('status', ['1','5'])->count();
						$semester1ijin  = $semester->where('status', 2)->count();
						$semester1sakit = $semester->where('status', 3)->count();
						$semester1alpha = $totalhari1 - ($cekhadir1 + $semester1ijin + $semester1sakit);
					} else {
						$totalhari2     = $semester->unique('tanggal')->count();
						$cekhadir2      = $semester->whereIn('status', ['1','5'])->count();
						$semester2ijin  = $semester->where('status', 2)->count();
						$semester2sakit = $semester->where('status', 3)->count();
						$semester2alpha = $totalhari2 - ($cekhadir2 + $semester2ijin + $semester2sakit);
					}
				}

				foreach ([1, 2] as $smt) {
					$tapelSmt 	= $tapel . '-' . $smt . '-UAS';
					$alquran 	= MushafUjian::where('id_sekolah', $siswa->id_sekolah)->where('noinduk', $siswa->noinduk)->where('tapelsemester', $tapelSmt)->get();
					$juzList 	= $alquran->pluck('juz')->unique()->values()->all();
					$rataRata 	= round($alquran->avg('nilaipersurat'), 2);
					$teksjuz 	= implode(',', $juzList);
					$teksjuz 	= str_replace('Juz ', '', $teksjuz);
					$teksjuz 	= 'Juz : '.$teksjuz;
					if ($smt == '1'){
						$semester1ms    = $alquran->first()->setoransekolah ?? 0;
                        $semester1mr    = $alquran->first()->setoranrumah ?? 0;
						$semester1hua   = $teksjuz;
                        $semester1nua   = $rataRata;
					} else {
						$semester2ms    = $alquran->first()->setoransekolah ?? 0;
						$semester2mr    = $alquran->first()->setoranrumah ?? 0;
						$semester2hua   = $teksjuz;
                        $semester2nua   = $rataRata;
					}
				}

				$getdataulisan  = MushafUjianLisan::where('id_sekolah', $siswa->id_sekolah)->where('tapel', $tapel)->where('noinduk', $siswa->noinduk)->get();
				foreach ($getdataulisan as $rowdatalisan) {
					$alllugot       = [];
					$allibadah      = [];
					$allinggris     = [];
					for ($indenul = 1; $indenul <= 8; $indenul++) {
						$alllugot[] = $rowdatalisan->{'alllugot' . $indenul} ?? null;
					}
					for ($indenul = 1; $indenul <= 5; $indenul++) {
						$allibadah[] = $rowdatalisan->{'allibadah' . $indenul} ?? null;
					}
					for ($indenul = 1; $indenul <= 7; $indenul++) {
						$allinggris[] = $rowdatalisan->{'allinggris' . $indenul} ?? null;
					}
					$pembagilugot   = count(array_filter($alllugot)); 
					$pembagiinggris = count(array_filter($allinggris)); 
					$pembagiibadah  = count(array_filter($allibadah));
					if ($rowdatalisan->semester == '1') {
						if ($pembagilugot > 0) {
							$semester1balsn = round(array_sum($alllugot) / $pembagilugot, 2);
						}
						if ($pembagiinggris > 0) {
							$semester1bilsn = round(array_sum($allinggris) / $pembagiinggris, 2);
						}
						if ($pembagiibadah > 0) {
							$semester1pailsn = round(array_sum($allibadah) / $pembagiibadah, 2);
						}
					} elseif ($rowdatalisan->semester == '2') {
						
						if ($pembagilugot > 0) {
							$semester2balsn = round(array_sum($alllugot) / $pembagilugot, 2);
						}
						if ($pembagiinggris > 0) {
							$semester2bilsn = round(array_sum($allinggris) / $pembagiinggris, 2);
						}
						if ($pembagiibadah > 0) {
							$semester2pailsn = round(array_sum($allibadah) / $pembagiibadah, 2);
						}
					}
				}

				$nilai 	= Datanilai::where('noinduk', $siswa->noinduk)->where('tapel', $tapel)->get();
				$j 		= 0;
				foreach ($matpelsall as $mapel) {
					$harian1 		= $nilai->where('semester', '1')->where('matpel', $mapel->muatan)->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])->pluck('nilai');
					$ptsPat1 		= $nilai->where('semester', '1')->where('matpel', $mapel->muatan)->whereIn('jennilai', ['pts', 'pat'])->pluck('nilai');
					$rata_harian1 	= $harian1->avg();
					$rata_pts_pat1 	= $ptsPat1->avg();
					$final1 		= ($rata_harian1 && $rata_pts_pat1) ? round(((2 * $rata_harian1 + $rata_pts_pat1) / 3), 0) : 0;
					
					$harian2 		= $nilai->where('semester', '2')->where('matpel', $mapel->muatan)->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])->pluck('nilai');
					$ptsPat2 		= $nilai->where('semester', '2')->where('matpel', $mapel->muatan)->whereIn('jennilai', ['pts', 'pat'])->pluck('nilai');
					$rata_harian2 	= $harian2->avg();
					$rata_pts_pat2 	= $ptsPat2->avg();
					$final2 		= ($rata_harian2 && $rata_pts_pat2) ? round(((2 * $rata_harian2 + $rata_pts_pat2) / 3), 0) : 0;
					$total 			= ($final1 == 0 && $final2 == 0) ? 0 : round((($final1 + $final2) / 2), 2);
					if ($mapel->muatan == 'BA'){
						$semester1batls = $final1;
						$semester2batls = $final2;
						$totalbabingpai = $totalbabingpai + $total;
					} elseif ($mapel->muatan == 'BING'){
						$semester1bitls = $final1;
						$semester2bitls = $final2;
						$totalbabingpai = $totalbabingpai + $total;
					} elseif ($mapel->muatan == 'PAI' OR $mapel->muatan == 'PAIdBP'){
						$semester1paitls = $final1;
						$semester2paitls = $final2;
						$totalbabingpai = $totalbabingpai + $total;
					} else {
						if ($i == 0){
							$matpelnonlisan[] = [
								'muatan' 	=> $mapel->muatan,
								'matpel' 	=> $mapel->matpel,
							];
						}
						$totallainnya = $totallainnya + $total;
						$data['dataleggerpart2'][$i][$j]['sas']		= $final1;
						$data['dataleggerpart2'][$i][$j]['sat'] 	= $final2;
						$data['dataleggerpart2'][$i][$j]['total'] 	= $total;
						$data['dataleggerpart2'][$i][$j]['rangking']= 'n/a';
						$j++;
					}
				}
				$pembagi = 0;
				if ($semester1batls != 0){ $pembagi++; }
				if ($semester1balsn != 0){ $pembagi++; }
				if ($semester2batls != 0){ $pembagi++; }
				if ($semester2balsn != 0){ $pembagi++; }
				if ($pembagi != 0){
					$naba 	= round((($semester1batls + $semester1balsn + $semester2batls + $semester2balsn) / $pembagi), 2);
				} else {
					$naba  	= 0;
				}
				$pembagi = 0;
				if ($semester1bitls != 0){ $pembagi++; }
				if ($semester1bilsn != 0){ $pembagi++; }
				if ($semester2bitls != 0){ $pembagi++; }
				if ($semester2bilsn != 0){ $pembagi++; }
				if ($pembagi != 0){
					$nabi 	= round((($semester1bitls + $semester1bilsn + $semester2bitls + $semester2bilsn) / $pembagi), 2);
				} else {
					$nabi  	= 0;
				}
				$pembagi = 0;
				if ($semester1paitls != 0){ $pembagi++; }
				if ($semester1pailsn != 0){ $pembagi++; }
				if ($semester2paitls != 0){ $pembagi++; }
				if ($semester2pailsn != 0){ $pembagi++; }
				if ($pembagi != 0){
					$napai 	= round((($semester1paitls + $semester1pailsn + $semester2paitls + $semester2pailsn) / $pembagi), 2);
				} else {
					$napai	= 0;
				}
				$totalsemuanilai = $totalbabingpai + $totallainnya;
				$data['dataleggerpart1'][$i] = [
					'noinduk' 				=> $siswa->noinduk,
					'nisn' 					=> $siswa->nisn,
					'nama' 					=> $siswa->nama,
					'semester1sakit' 		=> $semester1sakit,
					'semester1ijin' 		=> $semester1ijin,
					'semester1alpha' 		=> $semester1alpha,
					'semester1ms'			=> $semester1ms,
					'semester1mr'			=> $semester1mr,
					'semester2sakit'		=> $semester2sakit,
					'semester2ijin' 		=> $semester2ijin,
					'semester2alpha' 		=> $semester2alpha,
					'semester2ms'			=> $semester2ms,
					'semester2mr'			=> $semester2mr,
					'semester1hua'			=> $semester1hua,
					'semester1nua'			=> $semester1nua,
					'rangkingalquran1'		=> 'n/a',
					'semester2hua'			=> $semester2hua,
					'semester2nua'			=> $semester2nua,
					'rangkingalquran2'		=> 'n/a',
					'semester1batls'		=> $semester1batls,
					'semester1balsn'		=> $semester1balsn,
					'semester2batls'		=> $semester2batls,
					'semester2balsn'		=> $semester2balsn,
					'naba'					=> $naba,
					'rangkingba'			=> 'n/a',
					'semester1bitls'		=> $semester1bitls,
					'semester1bilsn'		=> $semester1bilsn,
					'semester2bitls'		=> $semester2bitls,
					'semester2bilsn'		=> $semester2bilsn,
					'nabi'					=> $nabi,
					'rangkingbi'			=> 'n/a',
					'semester1paitls'		=> $semester1paitls,
					'semester1pailsn'		=> $semester1pailsn,
					'semester2paitls'		=> $semester2paitls,
					'semester2pailsn'		=> $semester2pailsn,
					'napai'					=> $napai,
					'rangkingpai'			=> 'n/a',
					'totalbabingpai'		=> $totalbabingpai,
					'totallainnya'			=> $totallainnya,
					'totalsemuanilai'		=> $totalsemuanilai,
					'rangking'				=> 'n/a',
				];
				$i++;
			}
			// Ranking Helper
			$rankFields = [
				['field' => 'semester1nua', 'rank' => 'rangkingalquran1'],
				['field' => 'semester2nua', 'rank' => 'rangkingalquran2'],
				['field' => 'naba', 'rank' => 'rangkingba'],
				['field' => 'nabi', 'rank' => 'rangkingbi'],
				['field' => 'napai', 'rank' => 'rangkingpai'],
				['field' => 'totalsemuanilai', 'rank' => 'rangking'],
			];

			foreach ($rankFields as $rankDef) {
				$temp = $data['dataleggerpart1'];
				usort($temp, function ($a, $b) use ($rankDef) {
					return ($b[$rankDef['field']] ?? 0) <=> ($a[$rankDef['field']] ?? 0);
				});

				foreach ($temp as $index => $row) {
					foreach ($data['dataleggerpart1'] as &$original) {
						if ($original['noinduk'] === $row['noinduk']) {
							$original[$rankDef['rank']] = $index + 1;
							break;
						}
					}
				}
			}
			$data['matpelnonlisan']	= $matpelnonlisan;
			$data['setidkelas']		= $setidkelas;
			$data['tapel']			= $tapel;
			$data['urlkembali']		= $urlkembali;
			return view('simaster.legger', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function viewEditorRapot($id) {
		$data		= [];
		$getdata 	= Rapotan::where('id', $id)->first();
		if (isset($getdata->id)){
			$nipguru= $getdata->nipguru;
			if ($nipguru == Session('nip') OR Session('previlage') == 'level1' OR Session('previlage') == 'Waka Kurikulum'  OR Session('previlage') == 'Waka Kurikulum Al Quran'){
				$data['datarapot'] = $getdata;
				return view('simaster.editorrapot', $data);
			} else {
				$data['kalimatheader']  = 'Mohon Maaf';
				$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Guru Inputor dan Level 1, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
				return view('errors.notready', $data);
			}
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'ID Rapot '.$id.' Tidak di Temukan';
			return view('errors.notready', $data);
		}
		
  	}
	public function genRekapPerkodeKD(Request $request) {
		$data 				= [];
		$muatan 			= $request->input('muatan');
		$semester 			= $request->input('semester');
		$tapel 				= $request->input('tapel');
		$kelas 				= $request->input('kelas'); //1A
		$mstkelas 			= $request->input('mstkelas'); //1
		if ($semester == '' OR is_null($semester)){
			$getarray 		= explode('?', $muatan);
			$muatan 		= $getarray[0] ?? '';
			$semester 		= $getarray[1] ?? '';
			$tapel 			= $getarray[2] ?? '';
			$kelas 			= $getarray[3] ?? '';
			$mstkelas 		= $getarray[4] ?? '';
			$muatan			= str_replace('muatan=', '', $muatan);
			$semester		= str_replace('semester=', '', $semester);
			$tapel			= str_replace('tapel=', '', $tapel);
			$kelas			= str_replace('kelas=', '', $kelas);
			$mstkelas		= str_replace('mstkelas=', '', $mstkelas);
		}
		
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$urlkembali 				= url('/').'/kelas/grade'.$kelas;
			$arraypesertakelas 			= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('klspos', $kelas)->where('nokelulusan', '')->get();
			$jennilai 					= Datanilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->whereNotIn('jennilai', ['Ekstrakurikuler'])->groupBy('jennilai')->select('jennilai')->get();
			$kodekd 					= Datanilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->where('matpel', $muatan)->groupBy('kodekd')->select('matpel','kodekd')->get();
			$data['koloms']				= count($jennilai);
			$data['kodekds']			= $kodekd;
			$data['jennilai']			= $jennilai;
			$data['urlkembali']			= $urlkembali;
			$data['setidkelas']			= $kelas;
			$data['mstkelas']			= $mstkelas;
			$data['smt']				= $semester;
			$data['tapel']				= $tapel;
			$data['muatan']				= $muatan;
			$data['datasiswa']			= $arraypesertakelas;
			return view('simaster.rekapperkodekd', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function genSummaryReport(Request $request) {
		$data 				= [];
		$semester 			= $request->input('semester');
		$tapel 				= $request->input('tapel');
		$kelas 				= $request->input('kelas');
		$mstkelas 			= $request->input('mstkelas');
		if ($tapel == '' OR is_null($tapel)){
			$getarray 		= explode('?', $semester);
			$semester 		= $getarray[0] ?? '';
			$tapel 			= $getarray[1] ?? '';
			$kelas 			= $getarray[2] ?? '';
			$mstkelas 		= $getarray[3] ?? '';
			$semester		= str_replace('semester=', '', $semester);
			$tapel			= str_replace('tapel=', '', $tapel);
			$kelas			= str_replace('kelas=', '', $kelas);
			$mstkelas		= str_replace('mstkelas=', '', $mstkelas);
		}
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$urlkembali 				= url('/').'/kelas/grade'.$kelas;
			$arraypesertakelas 			= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('klspos', $kelas)->where('nokelulusan', '')->get();
			$matpel 					= Datanilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->where('jennilai', '!=', 'Ekstrakurikuler')->groupBy('matpel')->select('jennilai', 'matpel')->get();
			$data['matpels']			= $matpel;
			$data['urlkembali']			= $urlkembali;
			$data['setidkelas']			= $kelas;
			$data['mstkelas']			= $mstkelas;
			$data['smt']				= $semester;
			$data['tapel']				= $tapel;
			$data['datasiswa']			= $arraypesertakelas;
			return view('simaster.summaryreport', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function viewNgaji($id) {
		$data 			= [];
		$vowels 		= array("grade");
		$setidkelas 	= str_replace($vowels, "", $id);
		$arrnomor1 		= str_split($setidkelas);
		$nomer1 		= $arrnomor1[0];
		$nomer2 		= $arrnomor1[0];
		if ($nomer2 == '1' OR $nomer2 = '0'){
			$masterkls	= $nomer1.$nomer2;
		} else if ($nomer2 == 'A' OR $nomer2 = 'B'){
			$masterkls	= $setidkelas;
		}else { $masterkls = $nomer1; }
		$masterkls 		= substr($masterkls, 0, -1);
		$tahun			= date("Y");
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$klsajar	= $getdatauser->klsajar;
			$smt		= $getdatauser->smt;
			$tapel		= $getdatauser->tapel;
		} else {
			$klsajar	= '';
			$smt		= '';
			$tapel		= '';
		}
		$jgroupps	= MushafHalaman::groupBy('juz')->select('juz')->orderBy('halaman')->get();
		$i			= 0;
		foreach ($jgroupps as $rgrpklas) {
			$j  		= 0;
			$juz		= $rgrpklas->juz;
			$jklas  	= MushafHalaman::where('juz', $juz)->orderBy('halaman', 'ASC')->get();
			foreach ($jklas as $rklas) {
				$data['halamanmushaf'][$i][$j]['id']		=   $rklas->id;
				$data['halamanmushaf'][$i][$j]['juz']		=   $rklas->juz;
				$data['halamanmushaf'][$i][$j]['namasurah']	=   $rklas->namasurah;
				$data['halamanmushaf'][$i][$j]['halaman']	=   $rklas->halaman;
				$data['halamanmushaf'][$i][$j]['kata']		=   $rklas->kata;
				$j++;
			}
			$i++;
		}
		$x  = 0;
		foreach ($jgroupps as $kgrpklas) {
			$juz 						= $kgrpklas->juz;
			$juz 						= strtoupper($juz);
			$nomor						= str_replace('JUZ ', '', $juz);
			$data['juznumber'][$x]  	= $kgrpklas->juz;
			$data['juznumberonly'][$x]  = $nomor;
			$x++;
		}
		if ($i == 0){
			$data['juznumber'][0]  							=   '-';
			$data['juznumberonly'][0]  						=   '-';
			$data['halamanmushaf'][0][0]['id']				=   '0';
			$data['halamanmushaf'][0][0]['juz']				=   'No Data';
			$data['halamanmushaf'][0][0]['namasurah']		=   'No Data';
			$data['halamanmushaf'][0][0]['halaman']			=   'No Data';
			$data['halamanmushaf'][0][0]['kata']			=   'No Data';
		}
		$data['masterkls']			= $masterkls;
		$data['setidkelas']			= $setidkelas;
		$data['klsajar']			= $klsajar;
		$data['smt']				= $smt;
		$data['tapel']				= $tapel;
		$data['mushaflist']			= Mushaflist::all();
		$data['sidebar']			= 'grade'.$setidkelas;
		$data['tahunne']			= date("Y");
		$data['tanggal']			= date("Y-m-d");
		$data['kelasrpa']			= KurikulumAlquran::where('id_sekolah', session('sekolah_id_sekolah'))->groupBy('kelas')->orderBy('kelas', 'ASC')->get();

		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			return view('simaster.penilaianalquran', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function viewNgajiDashboard() {
		$data   		= [];
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$klsajar	= $getdatauser->klsajar;
			$smt		= $getdatauser->smt;
			$tapel		= $getdatauser->tapel;
		} else {
			$klsajar	= '';
			$smt		= '';
			$tapel		= '';
		}
		$i 				= 0;
		$arraymatpel	= [];
		$sql 			= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('nokelulusan','')->groupBy('klspos')->select('id', 'klspos', DB::raw('count("id") as jumlah'))->get();
		if(!empty($sql)){
			foreach ($sql as $rows){
				$klspos 	= $rows->klspos;
				$peserta 	= $rows->jumlah;
				$inputor	= '';
				$tanggal 	= '';
				$kegiatan 	= Datasetorantahfid::where('kelas', $klspos)->where('tapel', $tapel)->where('semester', $smt)->where('id_sekolah', session('sekolah_id_sekolah'))->where('inputor', '!=', 'ortu')->count();
				$last 		= Datasetorantahfid::where('kelas', $klspos)->where('tapel', $tapel)->where('semester', $smt)->where('id_sekolah', session('sekolah_id_sekolah'))->where('inputor', '!=', 'ortu')->orderBy('id', 'DESC')->first();
				if (isset($last->id)){
					$inputor = $last->inputor;
					$tanggal = $last->tanggal;
				}
				$arraymatpel[$i] = array(
					'klspos'		=> $klspos,
					'jilid'			=> $rows->jilid,
					'peserta'		=> $peserta,
					'inputor'		=> $inputor,
					'tanggal'		=> $tanggal,
					'kegiatan'		=> $kegiatan,
				);
				$i++;
			}
		}
		if ($i == 0){
			$arraymatpel[$i] = array(
				'klspos'		=> '0',
				'peserta'		=> '0',
				'inputor'		=> 'No Data',
				'tanggal'		=> '-',
				'kegiatan'		=> 'Data Induk Siswa belum terisi',
			);
		}
		$jgroupps	= MushafHalaman::groupBy('juz')->select('id', 'juz')->orderBy('id', 'ASC')->get();
		$i			= 0;
		foreach ($jgroupps as $rgrpklas) {
			$j  		= 0;
			$juz		= $rgrpklas->juz;
			$jklas  	= MushafHalaman::where('juz', $juz)->orderBy('id', 'ASC')->get();
			foreach ($jklas as $rklas) {
				$data['halamanmushaf'][$i][$j]['id']		=   $rklas->id;
				$data['halamanmushaf'][$i][$j]['juz']		=   $rklas->juz;
				$data['halamanmushaf'][$i][$j]['namasurah']	=   $rklas->namasurah;
				$data['halamanmushaf'][$i][$j]['halaman']	=   $rklas->halaman;
				$data['halamanmushaf'][$i][$j]['kata']		=   $rklas->kata;
				$j++;
			}
			$i++;
		}
		$x  = 0;
		foreach ($jgroupps as $kgrpklas) {
			$juz 						= $kgrpklas->juz;
			$juz 						= strtoupper($juz);
			$nomor						= str_replace('JUZ ', '', $juz);
			$data['juznumber'][$x]  	= $kgrpklas->juz;
			$data['juznumberonly'][$x]  = $nomor;
			$x++;
		}
		if ($i == 0){
			$data['juznumber'][0]  							=   '-';
			$data['juznumberonly'][0]  						=   '-';
			$data['halamanmushaf'][0][0]['id']				=   '0';
			$data['halamanmushaf'][0][0]['juz']				=   'No Data';
			$data['halamanmushaf'][0][0]['namasurah']		=   'No Data';
			$data['halamanmushaf'][0][0]['halaman']			=   'No Data';
			$data['halamanmushaf'][0][0]['kata']			=   'No Data';
		}
		$data['klsajar']			= $klsajar;
		$data['smt']				= $smt;
		$data['tapel']				= $tapel;
		$data['listkelas']			= $arraymatpel;
		$data['setidkelas']			= $klsajar;
		$data['masterkls']			= $klsajar;
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		$data['mushaflist']			= Mushaflist::all();
		$data['kelasrpa']			= KurikulumAlquran::where('id_sekolah', session('sekolah_id_sekolah'))->groupBy('kelas')->orderBy('kelas', 'ASC')->get();
		$data['sidebar']			= 'dashboardmengaji';
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'level4' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			return view('simaster.dashboardtahfids', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }		
	}
	public function exUploadnilai(Request $request) {
		if ($request->hasFile('sheeta')) {
			$path 			= $_FILES['sheeta']['tmp_name'];
			$tanggal		= date("Y-m-d h:s:m");
			$tanggalmark	= date("Y-m-d");
			$guru 			= Session('nama');
			$sukses   		= 0;
			$gagal			= '';
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				$noinduk	= $val['A'];
				$nama		= $val['B'];
				$kelas		= $val['C'];
				$tanggal	= $val['D'];
				$tapel		= $val['E'];
				$jenis		= $val['F'];
				$semester	= $val['G'];					
				$kodekd  	= $val['H'];
				$tema		= $val['I'];
				$subtema	= $val['J'];
				$matpel		= $val['K'];
				$nilai		= $val['L'];
				$niy		= $val['M'];
				$cekdata	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdata != 0 AND $tapel != '' AND $jenis != '' AND $tema != '' AND $subtema != '' AND $matpel != '' AND $semester != ''){
					$niy 				= str_replace("NIY. ", "", $niy);
					$markingguru		= $tapel.'-'.$semester.'-'.$matpel.'-'.Session('nip').'-'.$tanggalmark.'-'.$kodekd;
					$marking 			= $markingguru.'-'.$noinduk;
					$arrnomor1 			= str_split($kelas);
					$klspos 			= $arrnomor1[0];
					$cekdes				= Datakd::where('kelas', $klspos)->where('muatan', $matpel)->where('kodekd', $kodekd)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($cekdes->deskripsi)){
						$deskripsikd 	= $cekdes->deskripsi;
						$kkm			= $cekdes->kkm;
					} else {
						$deskripsikd 	= '';
						$kkm			= '';
					}
					$ceksudah	= Datanilai::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($ceksudah == 0){
						$update = Datanilai::create([
							'noinduk'		=> $noinduk, 
							'nama'			=> $nama, 
							'kelas'			=> $kelas, 
							'tapel'			=> $tapel, 
							'semester'		=> $semester, 
							'tema'			=> $tema, 
							'subtema'		=> $subtema, 
							'kodekd'		=> $kodekd, 
							'matpel'		=> $matpel, 
							'nilai'			=> $nilai, 
							'penginput'		=> $guru, 
							'tanggal'		=> $tanggal, 
							'jennilai'		=> $jenis, 
							'marking'		=> $marking, 
							'deskripsi'		=> $deskripsikd, 
							'kkm'			=> $kkm,
							'id_sekolah'	=> session('sekolah_id_sekolah')
						]);
						if ($update){ $sukses++; }
						else { $gagal = $gagal.'Gagal Input Nilai Untuk No.Induk '.$noinduk.'<br />'; }	
					} else {
						$gagal = $gagal.'Gagal Input Nilai Untuk No.Induk '.$noinduk.' Data Sudah ada<br />';
					}
					
				}
			}
			$ceksudah	= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($ceksudah == 0){
				Loginputnilai::create([
					'niy'		=> Session('nip'),
					'tanggal'	=> $tanggal, 
					'tema'		=> $tema, 
					'subtema'	=> $subtema, 
					'matpel'	=> $matpel, 
					'kodekd'	=> $kodekd, 
					'kelas'		=> $kelas, 
					'tapel'		=> $tapel, 
					'jennilai'	=> $jenis, 
					'semester'	=> $semester, 
					'marking'	=> $markingguru,
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
			}
			Session::flash('status', 'Success');
			Session::flash('message', 'Upload Data berhasil sejumlah <strong>'.$sukses.'</strong><br />Log Error :<br />'.$gagal); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} else {
			Session::flash('status', 'Error');
			Session::flash('message', 'Harap masukkan file terlebih dahulu'); 
			Session::flash('alert-class', 'alert-danger');
			
			return back();
		}
	}
	public function exInputnilai(Request $request) {
		$kodekd				= $request->identitaskomponen_kode;
		$jenisnilai			= $request->identitaskomponen_komponen;
		$idkd				= $request->identitaskomponen_idkd;
		$matpel				= $request->identitaskomponen_matpel;
		$deskripsi			= $request->identitaskomponen_deskripsi;
		$idsetting			= $request->identitaskomponen_idsetting;
		$semester			= $request->semester;
		$kelas				= $request->kelas;
		$tapel				= $request->tapel;
		$jnilai				= $request->nilai;
		$tema				= 0;
		$subtema 			= 0;
		$kkm				= 0;
		if ($idkd == 'kms'){
			$idsetting		= time();
			$tanggal		= $matpel.' '.date("h:s:m");
			$tanggalmark	= $matpel;
			$matpel			= 'KMS';
		} else {
			$tanggal		= date("Y-m-d h:s:m");
			$tanggalmark	= date("Y-m-d");
			$rmatpel		= Datakd::where('id', $idkd)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rmatpel->temake)){
				$tema		= $rmatpel->tema;
				$subtema 	= $rmatpel->subtema;
				$kkm 		= $rmatpel->kkm;
			}
		}
		
		$sukses   		= 0;
		$gagal    		= '';
		$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.Session('nip').'-'.$tanggalmark.'-NIL-'.$idsetting.'-'.$jenisnilai;
		$ceksudah		= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
		if ($ceksudah == 0){
			foreach ( $jnilai as $datanilai ){
				$noinduk	= $datanilai['noinduk'];
				$nama		= $datanilai['namanya'];
				
				$marking 	= $markingguru.'-'.$noinduk;
				$ceksudah	= Datanilai::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($ceksudah == 0){
					if ($idkd == 'kms'){
						$berat		= $datanilai['berat'];
						$tinggi		= $datanilai['tinggi'];
						$lingkar	= $datanilai['lingkar'] ?? 0;
						$vitamin	= $datanilai['vitamin'];
						$update 	= Datanilai::create([
							'noinduk'		=> $noinduk, 
							'nama'			=> $nama, 
							'kelas'			=> $kelas, 
							'tapel'			=> $tapel, 
							'semester'		=> $semester,
							'tema'			=> $berat,
							'subtema'		=> $tinggi, 
							'kodekd'		=> $kodekd, 
							'matpel'		=> 'KMS',
							'nilai'			=> $lingkar,
							'penginput'		=> Session('nip'), 
							'tanggal'		=> $tanggal,
							'jennilai'		=> $jenisnilai,
							'marking'		=> $marking, 
							'deskripsi'		=> $vitamin, 
							'kkm'			=> $kkm,
							'id_sekolah'	=> session('sekolah_id_sekolah')
						]);
					} else {
						$nilai 		= $datanilai['nilainya'] ?? 0;
						$nilai01	= $nilai;
						$nilai02	= $datanilai['nilainya02'] ?? null;
						$nilai03	= $datanilai['nilainya03'] ?? null;
						$nilai04	= $datanilai['nilainya04'] ?? null;
						$nilai05	= $datanilai['nilainya05'] ?? null;
						$nilai06	= $datanilai['nilainya06'] ?? null;
						if ($matpel == 'BA'){
							$pembagi= 0;
							$jumlah = 0;
							if ($nilai01 && $nilai01 != ''){ $pembagi++; $jumlah = $jumlah + $nilai01; }
							if ($nilai02 && $nilai02 != ''){ $pembagi++; $jumlah = $jumlah + $nilai02; }
							if ($nilai03 && $nilai03 != ''){ $pembagi++; $jumlah = $jumlah + $nilai03; }
							if ($nilai04 && $nilai04 != ''){ $pembagi++; $jumlah = $jumlah + $nilai04; }
							if ($nilai05 && $nilai05 != ''){ $pembagi++; $jumlah = $jumlah + $nilai05; }
							if ($nilai06 && $nilai06 != ''){ $pembagi++; $jumlah = $jumlah + $nilai06; }
							if ($pembagi != 0){
								$nilai = round(($jumlah / $pembagi), 2);
							}
						}
						$update 	= Datanilai::create([
							'noinduk'		=> $noinduk, 
							'nama'			=> $nama, 
							'kelas'			=> $kelas, 
							'tapel'			=> $tapel, 
							'semester'		=> $semester, 
							'tema'			=> $tema, 
							'subtema'		=> $subtema, 
							'kodekd'		=> $kodekd, 
							'matpel'		=> $matpel, 
							'nilai'			=> $nilai,
							'nilai01'		=> $nilai01,
							'nilai02'		=> $nilai02,
							'nilai03'		=> $nilai03,
							'nilai04'		=> $nilai04,
							'nilai05'		=> $nilai05,
							'nilai06'		=> $nilai06,
							'penginput'		=> Session('nip'), 
							'tanggal'		=> $tanggal, 
							'jennilai'		=> $jenisnilai, 
							'marking'		=> $marking, 
							'deskripsi'		=> $deskripsi, 
							'kkm'			=> $kkm,
							'id_sekolah'	=> session('sekolah_id_sekolah')
						]);
					}
					
					if ($update){ $sukses++; }
					else { $gagal = $gagal.'Gagal Input Nilai Untuk No.Induk '.$noinduk.'<br />'; }	
				} else {
					$gagal = $gagal.'Gagal Input Nilai Untuk No.Induk '.$noinduk.' Data Sudah Ada<br />';
				}
			}
			Loginputnilai::create([
				'niy'		=> Session('nip'), 
				'tanggal'	=> $tanggalmark, 
				'tema'		=> $tema, 
				'subtema'	=> $subtema, 
				'matpel'	=> $matpel, 
				'kodekd'	=> $kodekd, 
				'kelas'		=> $kelas, 
				'tapel'		=> $tapel, 
				'jennilai'	=> $jenisnilai,
				'semester'	=> $semester, 
				'marking'	=> $markingguru,
				'id_sekolah'=> session('sekolah_id_sekolah')
			]);
		} else {
			$gagal = 'Nilai '.$matpel.' untuk '.$jenisnilai.' Sudah Ada, Gunakan fungsi edit untuk merubah data';
		}
		if ($gagal == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Input Data Presensi sejumlah '.$sukses.' siswa sukses dilaksanakan.']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
			return back();
		}
	}
	public function exInputnilaiUA(Request $request) {
		$nama				= $request->nama;
		$noinduk			= $request->noinduk;
		$foto				= $request->foto;
		$hariefektif		= $request->hariefektif;
		$prszydsekolah		= $request->prszydsekolah;
		$prsmrjsekolah		= $request->prsmrjsekolah;
		$semester			= $request->semester;
		$kelas				= $request->kelas;
		$tapel				= $request->tapel;
		$jenisujian			= $request->jenisujian;
		$workcode			= $request->workcode;
		$prszydrumah		= $request->prszydrumah;
		$prsmrjrumah		= $request->prsmrjrumah;
		$tanggalmark		= $request->tanggal;
		$setoransekolah		= $prszydsekolah.';'.$prsmrjsekolah;
		$setoranrumah		= $prszydrumah.';'.$prsmrjrumah;
		
		$sukses   			= 0;
		$error    			= '';
		$tanggal			= $tanggalmark.' '.date("H:i:s");
		$markingguru 		= $request->tapelsemester.'.'.$semester.'.'.$kelas.'.'.Session('nip').'.'.$noinduk;
		if ($workcode == 'perhalaman'){
			$idtemplate		= $request->idtemplate;
			$getdatahal 	= MushafHalaman::where('id', $idtemplate)->first();
			$update 		= MushafUjian::updateOrCreate(
				[
					'noinduk' 		=> $noinduk,
					'semester' 		=> $semester,
					'tapel' 		=> $tapel,
					'halaman' 		=> $getdatahal->halaman,
					'namasurah' 	=> $getdatahal->namasurah,
					'tapelsemester' => $request->tapelsemester,
					'niyguru' 		=> Session('nip'),
					'id_sekolah' 	=> Session('sekolah_id_sekolah')
				],
				[
					'nama' 				=> $nama,
					'kelas' 			=> $kelas,
					'foto' 				=> $foto,
					'juz' 				=> $request->juz,
					'jumlahkata' 		=> $getdatahal->kata,
					'jumlahkesalahan' 	=> $request->jumlahkesalahan,
					'nilaikesalahan' 	=> $request->nilaikesalahan,
					'nilaipersurat' 	=> $request->nilaipersurat,
					'predikat' 			=> $request->predikat,
					'nilaiperjuz' 		=> $request->nilaiperjuz,
					'namaguru' 			=> Session('nama'),
					'hariefektif' 		=> $request->hariefektif,
					'setoransekolah' 	=> $setoransekolah,
					'setoranrumah' 		=> $setoranrumah,
				]
			);
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nilai Ujian Al Quran Semester '.$semester.' TP '.$tapel.' an. '.$nama.' Surah '.$getdatahal->namasurah.' Tersimpan Nilai '.$request->nilaipersurat]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else if ($workcode == 'hapusujianalquran'){
			$getdata 		= MushafUjian::where('id', $request->id)->first();
			$update 		= MushafUjian::where('id', $request->id)->delete();
			$deskripsi		= 'Menghapus Nilai Ujian AL Quran '.json_encode($getdata);
			if ($update){
				Logstaff::create([
					'jenis'			=> 'Perubahan Nilai', 
					'sopo'			=> Session('nip'),
					'kelakuan'		=> $deskripsi,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $deskripsi]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else if ($workcode == 'editordataujianalquran'){
			$tapelsemesterawal	= $request->tapelsemesterawal;
			$noinduk			= $request->noinduk;
			$update 			= MushafUjian::where('noinduk', $noinduk)->where('tapelsemester', $tapelsemesterawal)->where('id_sekolah', Session('sekolah_id_sekolah'))->update([
									'foto'			=> $request->foto,
									'semester' 		=> $request->semester,
									'tapel' 		=> $request->tapel,
									'tapelsemester'	=> $request->tapelsemester,
									'sakit' 		=> $request->sakit,
									'ijin' 			=> $request->ijin,
									'alpha'			=> $request->alpha,
									'hariefektif'	=> $request->hariefektif,
									'setoranrumah'	=> $request->setoranrumah,
									'setoransekolah'=> $request->setoransekolah,
									'namaguru'		=> $request->namapengguji,
									'created_at'	=> $tanggal
								]);
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nilai Ujian Al Quran Semester '.$request->semester.' TP '.$request->tapel.' an. '.$request->nama.' Berhasil di Update']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else if ($workcode == 'editorujianalquran'){
			$id				= $request->id;
			$getdatahal 	= MushafUjian::where('id', $id)->first();
			$update 		= MushafUjian::where('id', $getdatahal->id)->update([
								'jumlahkesalahan' 	=> $request->jumlahkesalahan,
								'nilaikesalahan' 	=> $request->nilaikesalahan,
								'nilaipersurat' 	=> $request->nilaipersurat,
								'predikat' 			=> $request->predikat,
							]);
			if ($update){
				$getrata 	= MushafUjian::select('noinduk', DB::raw('AVG(nilaipersurat) as rata_rata'))->where('tapelsemester', $getdatahal->tapelsemester)->where('noinduk', $getdatahal->noinduk)->where('id_sekolah', $getdatahal->id_sekolah)->groupBy('noinduk')->first();
				if (isset($getrata->rata_rata)){
					MushafUjian::where('tapelsemester', $getdatahal->tapelsemester)->where('noinduk', $getdatahal->noinduk)->where('id_sekolah', $getdatahal->id_sekolah)->update([
						'nilaiperjuz' 	=> $getrata->rata_rata,
					]);
				}
				$deskripsi		= 'Mengubah Nilai Ujian AL Quran Menjadi Kesalahan : '.$request->jumlahkesalahan.'; Nilai : '.$request->nilaikesalahan.';  Predikat '.$request->predikat.';  Dengan Data Awal :'.json_encode($getdatahal);
				Logstaff::create([
					'jenis'			=> 'Perubahan Nilai', 
					'sopo'			=> Session('nip'),
					'kelakuan'		=> $deskripsi,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nilai Ujian Al Quran diupdate dengan nilai baru '.$request->nilaipersurat]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else if ($workcode == 'kirimdataujianalquran'){
			$tapelsemesterawal	= $request->tapelsemesterawal;
			$noinduk			= $request->noinduk;
			$getnamawaka 		= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->whereIn('jabatan', ['Waka Kurikulum Al Quran', 'Waka AlQuran'])->first();
			$waka 				= $getnamawaka->nama ?? '';
			$niywaka 			= $getnamawaka->niy ?? '';
			$getnamaks 			= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jabatan', 'Kepala Sekolah')->first();
			$kasek 				= $getnamaks->nama ?? '';
			$niykasek 			= $getnamaks->niy ?? '';
			if ($niywaka != ''){
				$markingwaka 		= $tapel.'-'.$semester.'-'.$jenisujian.'-'.$kelas.'-'.$noinduk.'-'.Session('sekolah_id_sekolah').'-TTDWAKA';
				XFiles::updateOrCreate(
					[
						'xmarking'		=> $markingwaka,
					],
					[
						'xtabel' 		=> 'mushaf_ujian',
						'xjenis'		=> 'UA',
						'xfile'			=> ''
					]
				);
				Inboxsurat::updateOrCreate(
					[
						'xmarking'		=> $markingwaka,
						'penerima' 		=> $niywaka,
						'id_sekolah' 	=> Session('sekolah_id_sekolah')
					],
					[
						'tabel' 		=> 'mushaf_ujian',
						'perihal' 		=> 'Nilai Ujian Al Quran '.$jenisujian.' Semester '.$semester.' TP '.$tapel.' an. '.$nama,
						'pengirim' 		=> Session('nama'),
						'jenis' 		=> 'PARAF',
						'status'		=> 1,
						'urlsurat'		=> url('/').'/rapotalquran/'.$markingguru
					]
				);
			}
			if ($niykasek != ''){
				$markingttdks 		= $tapel.'-'.$semester.'-'.$jenisujian.'-'.$kelas.'-'.$noinduk.'-'.Session('sekolah_id_sekolah').'-TTDKS';
				XFiles::updateOrCreate(
					[
						'xmarking'		=> $markingttdks,
					],
					[
						'xtabel' 		=> 'mushaf_ujian',
						'xjenis'		=> 'UA',
						'xfile'			=> ''
					]
				);
				Inboxsurat::updateOrCreate(
					[
						'xmarking'		=> $markingttdks,
						'penerima' 		=> $niykasek,
						'id_sekolah' 	=> Session('sekolah_id_sekolah')
					],
					[
						'tabel' 		=> 'mushaf_ujian',
						'perihal' 		=> 'Nilai Ujian Al Quran '.$jenisujian.' Semester '.$semester.' TP '.$tapel.' an. '.$nama,
						'pengirim' 		=> Session('nama'),
						'jenis' 		=> 'TTE',
						'status'		=> 1,
						'urlsurat'		=> url('/').'/rapotalquran/'.$markingguru
					]
				);
			}
			$marking 				= $tapel.'-'.$semester.'-'.$jenisujian.'-'.$kelas.'-'.$noinduk.'-'.Session('sekolah_id_sekolah').'-RapotAlQuran';
			XFiles::where('xmarking', $marking)->update([
				'xfile' => ''
			]);
			try {
				MushafUjian::where('noinduk', $noinduk)->where('tapelsemester', $tapelsemesterawal)->where('id_sekolah', Session('sekolah_id_sekolah'))->update([
					'niywaka'			=> $niywaka,
					'namawakaalquran' 	=> $waka,
					'niyks'				=> $niykasek,
					'namaks' 			=> $kasek,
				]);
				$tuliskirim = '<a href="'.url('/').'/mailbox">Permohonan TTD Rapot Al Quran</a>';
				$getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niywaka)->first();
				if (isset($getuser->id)){
					$keterangan 	= '<p>Yth. '.$nama.'</p><p>Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :</p><p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p><p>'.$tuliskirim.'</p><p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih</p>';
					Notification::send($getuser, new NewMessageNotification($tuliskirim));
					SendMail::notif($getuser->nama,$getuser->email,'Permohonan TTD Rapot Al Quran',$keterangan);
				}
				SendMail::mobilenotif($niywaka,'perseorangan',$nama,$tuliskirim);
				$getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niykasek)->first();
				if (isset($getuser->id)){
					$keterangan 	= '<p>Yth. '.$nama.'</p><p>Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :</p><p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p><p>'.$tuliskirim.'</p><p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih</p>';
					Notification::send($getuser, new NewMessageNotification($tuliskirim));
					SendMail::notif($getuser->nama,$getuser->email,'Permohonan TTD Rapot Al Quran',$keterangan);
				}
				SendMail::mobilenotif($niykasek,'perseorangan',$nama,$tuliskirim);
				return response()->json(['linkra' => url('/').'/rapotalquran/'.$markingguru,'icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nilai Ujian Al Quran Semester '.$semester.' TP '.$tapel.' an. '.$nama.' Tersimpan dan Dikirim ke WAKA ALQURAN '.$error]);
				return back();
			} catch (\Exception $e) {
				$error = $e.'<br />';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else if ($workcode == 'getabsen'){
			$total  		= Datasetorantahfid::where('semester',$semester)->where('tapel',$tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->where('marking', 'NOT LIKE', 'PR-%')->groupBy('tanggal')->get();
			$total 			= count($total);
			$zydsekolah 	= Datasetorantahfid::whereNotNull('ziyadah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'NOT LIKE', 'PR-%')->where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
			$mrjsekolah 	= Datasetorantahfid::whereNotNull('murojaah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'NOT LIKE', 'PR-%')->where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
			$zydrumah 		= Datasetorantahfid::whereNotNull('ziyadah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'LIKE', 'PR-%')->where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
			$mrjrumah 		= Datasetorantahfid::whereNotNull('murojaah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'LIKE', 'PR-%')->where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
			if ($total != 0 AND $zydsekolah != 0){
				$prszydsekolah	= round(($total/$zydsekolah), 0);
			} else {
				$prszydsekolah	= 0;
			}
			if ($total != 0 AND $mrjsekolah != 0){
				$prsmrjsekolah	= round(($total/$mrjsekolah), 0);
			} else {
				$prsmrjsekolah	= 0;
			}
			$sekolah = round((($prszydsekolah + $prsmrjsekolah) / 2), 0);
			if ($total != 0 AND $zydrumah != 0){
				$prszydrumah	= round(($total/$zydrumah), 0);
			} else {
				$prszydrumah	= 0;
			}
			if ($total != 0 AND $mrjrumah != 0){
				$prsmrjrumah	= round(($total/$mrjrumah), 0);
			} else {
				$prsmrjrumah	= 0;
			}
			$rumah = round((($prszydrumah + $prsmrjrumah) / 2), 0);
			
			return response()->json(['total' => $total, 'prszydsekolah' => $zydsekolah, 'prsmrjsekolah' => $mrjsekolah,  'prszydrumah' => $zydrumah,  'prsmrjrumah' => $mrjrumah,  'sekolah' => $sekolah,  'rumah' => $rumah]);
			return back();
		} else if ($workcode == 'final'){
			$sakit			= 0;
			$ijin 			= 0;
			$alpha			= 0;
			$jumlahtanggal	= 0;
			$hadir			= 0;
			$totaldata  	= Datasetorantahfid::where('tapel', $tapel)->where('semester', $semester)->where('id_sekolah',session('sekolah_id_sekolah'))->where('marking', 'NOT LIKE', 'PR-%')->groupBy('tanggal')->get();
			if (!empty($totaldata)){
				foreach($totaldata as $rdate){
					$jumlahtanggal++;
					$cekhadir  		= Datapresensi::where('tanggal', $rdate->tanggal)->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($cekhadir->status)){
						if ($cekhadir->status == 1 OR $cekhadir->status == 5){
							$hadir++;
						} else if ($cekhadir->status == 2){
							$ijin++;
						} else if ($cekhadir->status == 3){
							$sakit++;
						} else {
							$alpha++;
						}
					} else {
						$alpha++;
					}
				}
			}
			$getnamawaka 	= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->whereIn('jabatan', ['Waka Kurikulum Al Quran', 'Waka AlQuran'])->first();
			if (isset($getnamawaka->id)){
				$waka 		= $getnamawaka->nama;
				$niywaka 	= $getnamawaka->niy;
			} else {
				$waka 		= '';
				$niywaka 	= '';
			}
			$getnamaks 	= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jabatan', 'Kepala Sekolah')->first();
			if (isset($getnamaks->id)){
				$kasek 		= $getnamaks->nama;
				$niykasek 	= $getnamaks->niy;
			} else {
				$wakasekka 	= '';
				$niykasek 	= '';
			}
			$update 		= MushafUjian::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->update([
				'niyguru'			=> Session('nip'),
				'namaguru'			=> Session('nama'),
				'sakit'				=> $sakit,
				'ijin'				=> $ijin,
				'alpha'				=> $alpha,
				'niywaka'			=> $niywaka,
				'namawakaalquran' 	=> $waka,
				'niyks'				=> $niykasek,
				'namaks' 			=> $kasek,
				'hariefektif' 		=> $jumlahtanggal,
				'setoransekolah' 	=> $setoransekolah,
				'setoranrumah' 		=> $setoranrumah,
				'updated_at'		=> $tanggal
			]);
			if ($update){
				$markingttdks 		= $tapel.'-'.$semester.'-'.$jenisujian.'-'.$kelas.'-'.$noinduk.'-'.Session('sekolah_id_sekolah').'-TTDKS';
				$markingwaka 		= $tapel.'-'.$semester.'-'.$jenisujian.'-'.$kelas.'-'.$noinduk.'-'.Session('sekolah_id_sekolah').'-TTDWAKA';
				$ceksudah			= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($ceksudah == 0){
					Loginputnilai::create([
						'niy'		=> Session('nip'),
						'tanggal'	=> $tanggalmark,
						'tema'		=> '-',
						'subtema'	=> '-',
						'matpel'	=> 'Ujian Al Quran '.$jenisujian.' Semester '.$semester.' TP '.$tapel,
						'kodekd'	=> $jenisujian,
						'kelas'		=> $kelas,
						'tapel'		=> $tapel,
						'jennilai'	=> 'Ujian Al Quran',
						'semester'	=> $semester,
						'marking'	=> $markingguru,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
				}
				try {
					XFiles::updateOrCreate(
						[
							'xmarking'		=> $markingwaka,
						],
						[
							'xtabel' 		=> 'mushaf_ujian',
							'xjenis'		=> 'UA',
							'xfile'			=> ''
						]
					);
					XFiles::updateOrCreate(
						[
							'xmarking'		=> $markingttdks,
						],
						[
							'xtabel' 		=> 'mushaf_ujian',
							'xjenis'		=> 'UA',
							'xfile'			=> ''
						]
					);
					Inboxsurat::updateOrCreate(
						[
							'xmarking'		=> $markingwaka,
							'penerima' 		=> $niywaka,
							'id_sekolah' 	=> Session('sekolah_id_sekolah')
						],
						[
							'tabel' 			=> 'mushaf_ujian',
							'perihal' 			=> 'Nilai Ujian Al Quran '.$jenisujian.' Semester '.$semester.' TP '.$tapel.' an. '.$nama,
							'pengirim' 			=> Session('nama'),
							'jenis' 			=> 'PARAF',
							'status'			=> 1,
							'urlsurat'			=> url('/').'/rapotalquran/'.$markingguru
						]
					);
					Inboxsurat::updateOrCreate(
						[
							'xmarking'		=> $markingttdks,
							'penerima' 		=> $niykasek,
							'id_sekolah' 	=> Session('sekolah_id_sekolah')
						],
						[
							'tabel' 			=> 'mushaf_ujian',
							'perihal' 			=> 'Nilai Ujian Al Quran '.$jenisujian.' Semester '.$semester.' TP '.$tapel.' an. '.$nama,
							'pengirim' 			=> Session('nama'),
							'jenis' 			=> 'TTE',
							'status'			=> 1,
							'urlsurat'			=> url('/').'/rapotalquran/'.$markingguru
						]
					);
					$tuliskirim = '<a href="'.url('/').'/mailbox">Permohonan TTD Rapot Al Quran</a>';
					$getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niywaka)->first();
					if (isset($getuser->id)){
						$keterangan 	= '<p>Yth. '.$nama.'</p><p>Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :</p><p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p><p>'.$tuliskirim.'</p><p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih</p>';
						Notification::send($getuser, new NewMessageNotification($tuliskirim));
						SendMail::notif($getuser->nama,$getuser->email,'Permohonan TTD Rapot Al Quran',$keterangan);
					}
					SendMail::mobilenotif($niywaka,'perseorangan',$nama,$tuliskirim);

					$getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niykasek)->first();
					if (isset($getuser->id)){
						$keterangan 	= '<p>Yth. '.$nama.'</p><p>Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :</p><p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p><p>'.$tuliskirim.'</p><p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih</p>';
						Notification::send($getuser, new NewMessageNotification($tuliskirim));
						SendMail::notif($getuser->nama,$getuser->email,'Permohonan TTD Rapot Al Quran',$keterangan);
					}
					SendMail::mobilenotif($niykasek,'perseorangan',$nama,$tuliskirim);
				} catch (\Exception $e) {
					$error = $error.$e.'<br />';
				}
				return response()->json(['linkra' => url('/').'/rapotalquran/'.$markingguru,'icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nilai Ujian Al Quran Semester '.$semester.' TP '.$tapel.' an. '.$nama.' Tersimpan dan Dikirim ke WAKA ALQURAN '.$error]);
				return back();
			} else{
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Error, Periksa Kembali Isian Bapak/Ibu']);
				return back();
			}
		} else if ($workcode == 'openpesertaujianlisan'){
			$marking 		= $tapel.'-'.$semester.'-UL-'.$kelas.'-'.$noinduk;
			MushafUjianLisan::updateOrCreate(
				[
					'marking'		=> $marking,
					'id_sekolah' 	=> Session('sekolah_id_sekolah')
				],
				[
					'noinduk'		=> $noinduk,
					'nama' 			=> $nama,
					'kelas' 		=> $kelas,
					'semester' 		=> $semester,
					'tapel' 		=> $tapel,
				]
			);
			$getdata 	= MushafUjianLisan::where('marking', $marking)->first();
			if (isset($getdata->id)){
				$idrapotujianlisan 		= $getdata->id;
			} else {
				$idrapotujianlisan		= '0';
			}
			return response()->json(['idrapotujianlisan' => $idrapotujianlisan]);
			return back();
		} else if ($workcode == 'openriwayatujianlisan'){
			$materi	= $request->val02;
			$id		= $request->val03;
			
			$getdata 	= MushafUjianLisan::where('id', $id)->first();
			if (isset($getdata->id)){
				$idrapotujianlisan 		= $getdata->id;
				$data					= [];
				$data['getdata']		= $getdata;
				if ($materi == 'english'){
					$generatesurat 			= view('cetak.detailujianlisaninggris', $data)->render();
					if ($getdata->niy1 == '' OR $getdata->niy1 == null){
						$penguji1 			= 'Slot Tersedia';
					} else {
						$penguji1 			= $getdata->nama1;
					}
					if ($getdata->niy2 == '' OR $getdata->niy2 == null){
						$penguji2 			= 'Slot Tersedia';
					} else {
						$penguji2 			= $getdata->nama2;
					}
					if ($getdata->niy3 == '' OR $getdata->niy3 == null){
						$penguji3 			= 'Slot Tersedia';
					} else {
						$penguji3 			= $getdata->nama3;
					}
				} else if ($materi == 'ibadah'){
					$generatesurat 			= view('cetak.detailujianlisanibadah', $data)->render();
					if ($getdata->niypengujiibadah1 == '' OR $getdata->niypengujiibadah1 == null){
						$penguji1 			= 'Slot Tersedia';
					} else {
						$penguji1 			= $getdata->namapengujiibadah1;
					}
					if ($getdata->niypengujiibadah2 == '' OR $getdata->niypengujiibadah2 == null){
						$penguji2 			= 'Slot Tersedia';
					} else {
						$penguji2 			= $getdata->namapengujiibadah2;
					}
					if ($getdata->niypengujiibadah3 == '' OR $getdata->niypengujiibadah3 == null){
						$penguji3 			= 'Slot Tersedia';
					} else {
						$penguji3 			= $getdata->namapengujiibadah3;
					}
				} else {
					$generatesurat 			= view('cetak.detailujianlisanlugot', $data)->render();

					if ($getdata->niypengujilugot1 == '' OR $getdata->niypengujilugot1 == null){
						$penguji1 			= 'Slot Tersedia';
					} else {
						$penguji1 			= $getdata->namapengujilugot1;
					}
					if ($getdata->niypengujilugot2 == '' OR $getdata->niypengujilugot2 == null){
						$penguji2 			= 'Slot Tersedia';
					} else {
						$penguji2 			= $getdata->namapengujilugot2;
					}
					if ($getdata->niypengujilugot3 == '' OR $getdata->niypengujilugot3 == null){
						$penguji3 			= 'Slot Tersedia';
					} else {
						$penguji3 			= $getdata->namapengujilugot3;
					}
				}
			} else {
				$generatesurat			= '';
				$penguji1 				= 'Slot Tersedia';
				$penguji2 				= 'Slot Tersedia';
				$penguji3 				= 'Slot Tersedia';
				$idrapotujianlisan		= '0';
			}
			return response()->json(['generatesurat' => $generatesurat, 'penguji1' => $penguji1, 'penguji2' => $penguji2, 'penguji3' => $penguji3, 'idrapotujianlisan' => $idrapotujianlisan]);
			return back();
		} else if ($workcode == 'setpenguji'){
			$idrapotujianlisan 	= $request->val03;
			$jenis				= $request->val02;
			$materi				= $request->val04;
			$error 				= '';
			$openpaper 			= 'NO';
			$getdata 			= MushafUjianLisan::where('id', $idrapotujianlisan)->first();
			if (isset($getdata->id)){
				if ($materi == 'english'){
					$niy1 		= $getdata->niy1;
					$niy2 		= $getdata->niy2;
					$niy3 		= $getdata->niy3;
					if ($getdata->niy1 == '' OR is_null($getdata->niy1)){
						$penguji1	= 'Slot Tersedia';
					} else {
						$penguji1	= $getdata->nama1;
					}
					if ($getdata->niy2 == '' OR is_null($getdata->niy2)){
						$penguji2	= 'Slot Tersedia';
					} else {
						$penguji2	= $getdata->nama2;
					}
					if ($getdata->niy3 == '' OR is_null($getdata->niy3)){
						$penguji3	= 'Slot Tersedia';
					} else {
						$penguji3	= $getdata->nama3;
					}
				} else if ($materi == 'ibadah'){
					$niy1 		= $getdata->niypengujiibadah1;
					$niy2 		= $getdata->niypengujiibadah2;
					$niy3 		= $getdata->niypengujiibadah3;
					if ($getdata->niypengujiibadah1 == '' OR is_null($getdata->niypengujiibadah1)){
						$penguji1	= 'Slot Tersedia';
					} else {
						$penguji1	= $getdata->namapengujiibadah1;
					}
					if ($getdata->niypengujiibadah2 == '' OR is_null($getdata->niypengujiibadah2)){
						$penguji2	= 'Slot Tersedia';
					} else {
						$penguji2	= $getdata->namapengujiibadah2;
					}
					if ($getdata->niypengujiibadah3 == '' OR is_null($getdata->niypengujiibadah3)){
						$penguji3	= 'Slot Tersedia';
					} else {
						$penguji3	= $getdata->namapengujiibadah3;
					}
				} else {
					$niy1 		= $getdata->niypengujilugot1;
					$niy2 		= $getdata->niypengujilugot2;
					$niy3 		= $getdata->niypengujilugot3;
					if ($getdata->niypengujilugot1 == '' OR is_null($getdata->niypengujilugot1)){
						$penguji1	= 'Slot Tersedia';
					} else {
						$penguji1	= $getdata->namapengujilugot1;
					}
					if ($getdata->niypengujilugot2 == '' OR is_null($getdata->niypengujilugot2)){
						$penguji2	= 'Slot Tersedia';
					} else {
						$penguji2	= $getdata->namapengujilugot2;
					}
					if ($getdata->niypengujilugot3 == '' OR is_null($getdata->niypengujilugot3)){
						$penguji3	= 'Slot Tersedia';
					} else {
						$penguji3	= $getdata->namapengujilugot3;
					}
				}
				if ($niy1 == Session('nip') AND $jenis == 'pengguji1'){

				} else if ($niy2 == Session('nip') AND $jenis == 'pengguji2'){

				} else if ($niy3 == Session('nip') AND $jenis == 'pengguji3'){

				} else {
					if ($jenis == 'pengguji1' AND $penguji1 == 'Slot Tersedia'){
						if ($materi == 'english'){
							MushafUjianLisan::where('id', $idrapotujianlisan)->update([
								'nama1'					=> Session('nama'),
								'niy1'					=> Session('nip')
							]);
						} else if ($materi == 'ibadah'){
							MushafUjianLisan::where('id', $idrapotujianlisan)->update([
								'namapengujiibadah1'	=> Session('nama'),
								'niypengujiibadah1'		=> Session('nip')
							]);
						} else {
							MushafUjianLisan::where('id', $idrapotujianlisan)->update([
								'namapengujilugot1'		=> Session('nama'),
								'niypengujilugot1'		=> Session('nip')
							]);
						}
						$penguji1 	= Session('nama');
					} else {
						if ($jenis == 'pengguji2' AND $penguji2 == 'Slot Tersedia'){
							if ($materi == 'english'){
								MushafUjianLisan::where('id', $idrapotujianlisan)->update([
									'nama2'					=> Session('nama'),
									'niy2'					=> Session('nip')
								]);
							} else if ($materi == 'ibadah'){
								MushafUjianLisan::where('id', $idrapotujianlisan)->update([
									'namapengujiibadah2' 	=> Session('nama'),
									'niypengujiibadah2'		=> Session('nip')
								]);
							} else {
								MushafUjianLisan::where('id', $idrapotujianlisan)->update([
									'namapengujilugot2'		=> Session('nama'),
									'niypengujilugot2'		=> Session('nip')
								]);
							}
							$penguji2 	= Session('nama');
						} else {
							if ($jenis == 'pengguji3' AND $penguji3 == 'Slot Tersedia'){
								if ($materi == 'english'){
									MushafUjianLisan::where('id', $idrapotujianlisan)->update([
										'nama3'					=> Session('nama'),
										'niy3'					=> Session('nip')
									]);
								} else if ($materi == 'ibadah'){
									MushafUjianLisan::where('id', $idrapotujianlisan)->update([
										'namapengujiibadah3' 	=> Session('nama'),
										'niypengujiibadah3'		=> Session('nip')
									]);
								} else {
									MushafUjianLisan::where('id', $idrapotujianlisan)->update([
										'namapengujilugot3'		=> Session('nama'),
										'niypengujilugot3'		=> Session('nip')
									]);
								}
								$penguji3 	= Session('nama');
							} else {
								$error 		= $error.'Slot untuk '.$jenis.' Ini Sudah di Isi';
							}
						}
					}
				}
				if ($error == ''){
					$openpaper = 'YES';
				}
			}
			return response()->json(['generatesurat' => $error, 'openpaper' => $openpaper, 'setpenguji' => $jenis, 'dataujian' => json_encode($getdata)]);
			return back();
		} else if ($workcode == 'inputnilai'){
			try {
				$columnName 	= $request->jenis.$request->komponen;
				MushafUjianLisan::where('id', $request->id)->update([
					$columnName => $request->nilai
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Item '.$columnName.' Saved Value '.$request->nilai]);
				return back();
			} catch (\Exception $e) {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $e->getMessage()]);
				return back();
			}
		} else if ($workcode == 'finalperpenguji'){
			$jenispenngguji 	= $request->jenis;
			$materi 			= $request->materi;
			$getdata 			= MushafUjianLisan::where('id', $request->id)->first();
			if (isset($getdata->id)){
				$data					= [];
				$data['getdata']		= $getdata;
				$penguji 				= 0;
				if ($materi == 'english'){
					$generatesurat 			= view('cetak.detailujianlisaninggris', $data)->render();
					if ($getdata->niy1 == '' OR $getdata->niy1 == null){
						$penguji1 			= 'Slot Tersedia';
					} else {
						$penguji1 			= $getdata->nama1;
						$penguji++;
					}
					if ($getdata->niy2 == '' OR $getdata->niy2 == null){
						$penguji2 			= 'Slot Tersedia';
					} else {
						$penguji2 			= $getdata->nama2;
						$penguji++;
					}
					if ($getdata->niy3 == '' OR $getdata->niy3 == null){
						$penguji3 			= 'Slot Tersedia';
					} else {
						$penguji3 			= $getdata->nama3;
						$penguji++;
					}
				} else if ($materi == 'ibadah'){
					$generatesurat 			= view('cetak.detailujianlisanibadah', $data)->render();
					if ($getdata->niypengujiibadah1 == '' OR $getdata->niypengujiibadah1 == null){
						$penguji1 			= 'Slot Tersedia';
					} else {
						$penguji1 			= $getdata->namapengujiibadah1;
						$penguji++;
					}
					if ($getdata->niypengujiibadah2 == '' OR $getdata->niypengujiibadah2 == null){
						$penguji2 			= 'Slot Tersedia';
					} else {
						$penguji2 			= $getdata->namapengujiibadah2;
						$penguji++;
					}
					if ($getdata->niypengujiibadah3 == '' OR $getdata->niypengujiibadah3 == null){
						$penguji3 			= 'Slot Tersedia';
					} else {
						$penguji3 			= $getdata->namapengujiibadah3;
						$penguji++;
					}
				} else {
					$generatesurat 			= view('cetak.detailujianlisanlugot', $data)->render();
					if ($getdata->niypengujilugot1 == '' OR $getdata->niypengujilugot1 == null){
						$penguji1 			= 'Slot Tersedia';
					} else {
						$penguji1 			= $getdata->namapengujilugot1;
						$penguji++;
					}
					if ($getdata->niypengujilugot2 == '' OR $getdata->niypengujilugot2 == null){
						$penguji2 			= 'Slot Tersedia';
					} else {
						$penguji2 			= $getdata->namapengujilugot2;
						$penguji++;
					}
					if ($getdata->niypengujilugot3 == '' OR $getdata->niypengujilugot3 == null){
						$penguji3 			= 'Slot Tersedia';
					} else {
						$penguji3 			= $getdata->namapengujilugot3;
						$penguji++;
					}
				}
				if ($penguji <= 2){
					$getnamaks 			= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jabatan', 'Kepala Sekolah')->first();
					$kasek 				= $getnamaks->nama ?? '';
					$niykasek 			= $getnamaks->niy ?? '';
					$marking = $getdata->marking;
					XFiles::updateOrCreate(
						[
							'xmarking'		=> $marking,
						],
						[
							'xtabel' 		=> 'mushaf_ujianlisan',
							'xjenis'		=> Session('sekolah_id_sekolah').';'.$getdata->noinduk,
							'xfile'			=> ''
						]
					);
					Inboxsurat::updateOrCreate(
						[
							'xmarking'		=> $marking,
							'penerima' 		=> $niykasek,
							'id_sekolah' 	=> Session('sekolah_id_sekolah')
						],
						[
							'tabel' 		=> 'mushaf_ujianlisan',
							'perihal' 		=> 'Nilai Ujian Lisan Semester '.$getdata->semester.' TP '.$getdata->tapel.' an. '.$getdata->nama,
							'pengirim' 		=> Session('nama'),
							'jenis' 		=> 'TTE',
							'status'		=> 1,
							'urlsurat'		=> url('/').'/hasilujianlisan/'.$getdata->id
						]
					);
				}
				return response()->json(['generatesurat' => $generatesurat, 'penguji1' => $penguji1, 'penguji2' => $penguji2, 'penguji3' => $penguji3, 'idrapotujianlisan' => $request->id]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $request->id.' Tidak Valid ']);
				return back();
			}
		} else {
			//tidak_ke_pakai
			$ceksudah			= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($ceksudah == 0){
				foreach ( $jnilai as $datanilai ){
					$kata 			= $datanilai['kata'];
					$jumlahkesalahan= $datanilai['jumlahkesalahan'];
					$nilaikesalahan	= $datanilai['nilaikesalahan'];
					$nilaipersurat	= $datanilai['nilaipersurat'];
					$namasurah 		= $datanilai['namasurah'];
					$halaman		= $datanilai['halaman'];
					$juz			= $datanilai['juz'];
					$predikat		= $datanilai['predikat'];
					if ($jumlahkesalahan != ''){
						$update 		= MushafUjian::updateOrCreate(
							[
								'noinduk' 		=> $noinduk,
								'semester' 		=> $semester,
								'tapel' 		=> $tapel,
								'halaman' 		=> $halaman,
								'niyguru' 		=> Session('nip'),
								'id_sekolah' 	=> session('sekolah_id_sekolah')
							],
							[
								'nama' 				=> $nama,
								'kelas' 			=> $kelas,
								'foto' 				=> $foto,
								'tapelsemester' 	=> $tapel.'-'.$semester,
								'juz' 				=> $juz,
								'namasurah' 		=> $namasurah,
								'jumlahkata' 		=> $kata,
								'jumlahkesalahan' 	=> $jumlahkesalahan,
								'nilaikesalahan' 	=> $nilaikesalahan,
								'nilaipersurat' 	=> $nilaipersurat,
								'predikat' 			=> $predikat,
								'namaguru' 			=> Session('nama'),
								'hariefektif' 		=> $hariefektif,
								'setoransekolah' 	=> $harisetorsekolah,
								'setoranrumah' 		=> $harisetorrumah,
								'namawakaalquran' 	=> '',
								'niywaka' 			=> '',
								'namaks' 			=> '',
								'niyks' 			=> '',
							]
						);
						if ($update){
							$sukses++;
						} else {
							$error = $error.$e.'Gagal Menyimpan Data an. '.$nama.' Halaman '.$halaman.'<br />';
						}
					}
				}
				Loginputnilai::create([
					'niy'		=> Session('nip'), 
					'tanggal'	=> $tanggalmark, 
					'tema'		=> '-', 
					'subtema'	=> '-', 
					'matpel'	=> 'Ujian Al Quran Semester '.$semester.' TP '.$tapel, 
					'kodekd'	=> '-', 
					'kelas'		=> $kelas, 
					'tapel'		=> $tapel, 
					'jennilai'	=> 'Ujian Al Quran',
					'semester'	=> $semester, 
					'marking'	=> $markingguru,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
			} else {
				$error = 'Nilai Ujian Al Quran Semester '.$semester.' TP '.$tapel.' an. '.$nama.' Sudah Ada, Gunakan fungsi edit untuk merubah data';
			}
			if ($error == ''){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nilai Ujian Al Quran Semester '.$semester.' TP '.$tapel.' an. '.$nama.' Tersimpan Sejumlah '.$sukses]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		}
	}
	public function exInputdatadiri(Request $request) {
    	$idkodekd		= 'DR';
		$jenisnilai		= 'DIRI';
		$idtst			= 0;
		$matpel			= '';
		$jnilai			= $request->nilai;
		$kelas			= $request->kelas;
		$tapel			= $request->tapel;
		$semester		= $request->semester;
		$sukses   		= 0;
		$gagal    		= '';
		$tanggal		= date("Y-m-d h:s:m");
		$tanggalmark	= date("Y-m-d");
		$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.Session('nip').'-DIRI';
		foreach ( $jnilai as $datanilai ){
			$klspos 			= $datanilai['klspos'];
			$noinduk			= $datanilai['noinduk'];
			$nama				= $datanilai['namanya'];
			$nisn 				= $datanilai['nisn'];
			$alamat				= $datanilai['alamat'];
			$foto				= $datanilai['foto'];
			$tbs1 				= $datanilai['tbs1'];
			$tbs2				= $datanilai['tbs2'];
			$bbs1				= $datanilai['bbs1'];
			$bbs2 				= $datanilai['bbs2'];
			$telinga			= $datanilai['telinga'];
			$mata				= $datanilai['mata'];
			$gigi				= $datanilai['gigi'];
			$lainnya			= $datanilai['lainnya'];
			if ($foto == '' OR $foto == null){
				$foto 			= Session('sekolah_logo');
			}
			$update 			= Rapotan::updateOrCreate(
				[
					'noinduk' 			=> $noinduk,
					'semester' 			=> $semester.'.1',
					'tapel' 			=> $tapel,
					'id_sekolah' 		=> session('sekolah_id_sekolah')
				],
				[
					'nama' 				=> $nama,
					'nisn' 				=> $nisn,
					'foto' 				=> $foto,
					'alamat' 			=> $alamat,
					'kelas' 			=> $kelas,
					'tbs1' 				=> $tbs1,
					'tbs2' 				=> $tbs2,
					'bbs1' 				=> $bbs1,
					'bbs2' 				=> $bbs2,
					'pendengaran' 		=> $telinga,
					'penglihatan' 		=> $mata,
					'gigi' 				=> $gigi,
					'kesehatanlain' 	=> $lainnya,
					'marking' 			=> session('sekolah_id_sekolah').'-'.$tapel.'-'.$semester.'.1-'.$noinduk,
					'id_sekolah' 		=> session('sekolah_id_sekolah')
				]
			);
			$update 			= Rapotan::updateOrCreate(
				[
					'noinduk' 			=> $noinduk,
					'semester' 			=> $semester.'.2',
					'tapel' 			=> $tapel,
					'id_sekolah' 		=> session('sekolah_id_sekolah')
				],
				[
					'nama' 				=> $nama,
					'nisn' 				=> $nisn,
					'foto' 				=> $foto,
					'alamat' 			=> $alamat,
					'kelas' 			=> $kelas,
					'tbs1' 				=> $tbs1,
					'tbs2' 				=> $tbs2,
					'bbs1' 				=> $bbs1,
					'bbs2' 				=> $bbs2,
					'pendengaran' 		=> $telinga,
					'penglihatan' 		=> $mata,
					'gigi' 				=> $gigi,
					'kesehatanlain' 	=> $lainnya,
					'marking' 			=> session('sekolah_id_sekolah').'-'.$tapel.'-'.$semester.'.2-'.$noinduk,
					'id_sekolah' 		=> session('sekolah_id_sekolah')
				]
			);
			if ($update){
				$sukses++;
			} else {
				$gagal = $gagal.' Input Data Diri an '.$nama.' No Induk '.$noinduk.' Gagal <br />';
			}
		}
		$ceksudah		= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
		if ($ceksudah == 0){
			Loginputnilai::create([
				'niy'		=> Session('nip'), 
				'tanggal'	=> $tanggalmark,
				'tema'		=> 0,
				'subtema'	=> 0,
				'matpel'	=> '',
				'kodekd'	=> '',
				'kelas'		=> $kelas,
				'tapel'		=> $tapel,
				'jennilai'	=> 'Biodata Rapot',
				'semester'	=> $semester,
				'marking'	=> $markingguru,
				'id_sekolah'=> session('sekolah_id_sekolah')
			]);
		}
		if ($gagal == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Input Biodata Rapot sejumlah '.$sukses.' siswa sukses dilaksanakan.']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
		}
    }
	public function jsonDataRPS(Request $request) {
		$arraysurat		= [];
		$idmatkul 		= $request->idmatkul;
		$kerja 			= $request->set02;
		if ($kerja == '' OR is_null($kerja)){
			$cekdata 		= Datakkm::where('id', $idmatkul)->first();
			if (isset($cekdata->id)){
				$i 			= 0;
				$kelas 		= $cekdata->kelas;
				$muatan		= $cekdata->muatan;
				$data		= new Datakd();
				$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
				$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
				$data 		= $data->where('id_sekolah', session('sekolah_id_sekolah'));
				if ($kelas != null AND $kelas != '') $data = $data->where('kelas', $kelas);
				if ($muatan != null AND $muatan != '') $data = $data->where('muatan', $muatan);
				if ($request->has('search') && !empty($request->search)) {
					$searchTerm = $request->search;
					$data->where(function ($q) use ($searchTerm) {
						$q->where('muatan', 'like', "%$searchTerm%")
							->orWhere('kelas', 'like', "%$searchTerm%")
							->orWhere('kodekd', 'like', "%$searchTerm%")
							->orWhere('deskripsitema', 'like', "%$searchTerm%")
							->orWhere('deskripsi', 'like', "%$searchTerm%")
							->orWhere('materi', 'like', "%$searchTerm%");
					});
				}
				$data		= $data->orderByRaw($order)->paginate($limit);
				$totaldata	= $data->total();
				if ($data) {
					foreach($data as $rows){
						$arraysurat[$i] = $rows;
						$i++;
					}
					$response = [
						'message'	=> 'List Data Kegiatan',
						'total'		=> $totaldata,
						'data'		=> $arraysurat
					];
					return response()->json($response, 200);
				}
				$response = [
					'message'        => 'No Data'
				];
				return response()->json($response, 500);
			} else {
				$response = [
					'message'        => 'ID Tidak Valid'
				];
				return response()->json($response, 500);
			}
		} else {
			$data 			= [];
			$cekdata 		= Datakkm::where('id', $idmatkul)->first();
			if (isset($cekdata->id)){
				$i 			= 0;
				$kelas 		= $cekdata->kelas;
				$muatan		= $cekdata->muatan;
				$data 		= Datakd::where('kelas', $kelas)->where('muatan', $muatan)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
			}
			echo json_encode($data);
		}
	}
	public function jsonJadwalRPS(Request $request) {
		$semester		= $request->val01;
		$tapel 			= $request->val02;
		$bentuk			= $request->val03;
		$data 			= [];
		if ($bentuk == 'tabel'){
			$data		= DB::table('jadwal_pembelajaran')->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			echo json_encode($data);
		} else if ($bentuk == 'detailtabel'){
			$data		= DB::table('jadwal_pembelajaran')->where('marking', $semester)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			echo json_encode($data);
		} else if ($bentuk == 'jadwal'){
			$data 	    = DB::table('jadwal_pembelajaran')->where('id_sekolah',session('sekolah_id_sekolah'))->where('kelas', $request->val04)->where('semester', $request->val01)->where('tapel', $request->val02)->where('guruterjadwal', Session('nama'))->where('hari', date('D'))->get();
			return response()->json($data);
		} else if ($bentuk == 'materi'){
			$arraymateri 	= [];
			$i 				= 0;
			$data 	    	= DB::table('jadwal_pembelajaran')->where('id_sekolah',session('sekolah_id_sekolah'))->where('kelas', $request->val04)->where('semester', $request->val01)->where('tapel', $request->val02)->where('guruterjadwal', Session('nama'))->where('hari', date('D'))->get();
			if (!empty($data)){
				foreach($data as $rows){
					$matapelajaran 	= $rows->matapelajaran;
					$getdatakd 		= Datakd::where('matpel', $matapelajaran)->where('kelas', $request->val04)->where('semester', $request->val01)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
					if (!empty($getdatakd)){
						foreach($getdatakd as $datamateri){
							$arraymateri[$i] = $datamateri;
							$i++;
						}
					}
				}
			}
			return response()->json($arraymateri);
		} else if ($bentuk == 'ruangans'){
			$data 	    = Ruang::where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			return response()->json($data);
		} else if ($bentuk == 'arraymatpel'){
			$data    	= Datakkm::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $request->val04)->select('kitiga as kkm', 'muatan', 'matpel')->get();
			return response()->json($data);
		} else if ($bentuk == 'datakd'){
			$datanilaiQuery = Datanilai::where('id_sekolah', session('sekolah_id_sekolah'))->where('semester', $semester)->where('tapel', $tapel)->where('kelas', $request->val04)->get();
			$jgroupps       = Datakd::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $request->val04)->where('semester', $semester)->groupBy('muatan')->pluck('muatan');
			$arraykdba      = [];
			$muatanlist     = [];
			$komponendasar  = [];
			$intba          = 0;
			$intumum        = 0;
			$i              = 0;
			$nilai_map      = [
				'p01' => 'Penilaian Harian 1',
				'p02' => 'Penilaian Harian 2',
				'p03' => 'Penilaian Harian 3',
				'p04' => 'Penilaian Harian 4',
				'p05' => 'Penilaian Harian 5',
				'e01' => 'Evaluasi 1',
				'e02' => 'Evaluasi 2',
				'e03' => 'Evaluasi 3',
				'e04' => 'Evaluasi 4',
				'e05' => 'Evaluasi 5',
				'pts' => 'PTS',
				'pat' => 'PAT',
			];
			foreach ($jgroupps as $muatan) {
				$jklas	= DB::table('db_kd')->select('db_kd.*', 'db_komponennilai.p01', 'db_komponennilai.p02', 'db_komponennilai.p03', 'db_komponennilai.p04', 'db_komponennilai.p05', 'db_komponennilai.e01', 'db_komponennilai.e02', 'db_komponennilai.e03', 'db_komponennilai.e04', 'db_komponennilai.e05', 'db_komponennilai.pts', 'db_komponennilai.pat')->leftJoin('db_komponennilai', 'db_kd.id', 'db_komponennilai.idkd')->where('db_kd.kelas', $request->val04)->where('db_kd.semester', $semester)->where('db_kd.muatan', $muatan)->where('db_kd.id_sekolah', Session('sekolah_id_sekolah'))->get();
				foreach ($jklas as $rklas) {
					$komponendasar[$i][$rklas->id] = [
						'deskripsi' => "{$rklas->kodekd} ({$rklas->deskripsi})",
						'id'        => $rklas->id
					];
				}
				$i++;
			}
			$arraykdba[$intba++] = [
				'idsetting'     => 0,
				'nilaike'       => 'pts',
				'namakomponen'  => 'PTS',
				'idkd'          => 0,
				'deskripsi'     => 'PTS',
				'muatan'        => 'BA',
				'kodekd'        => 'PTS',
				'smt'           => $semester,
				'tapel'         => $tapel,
				'setidkelas'    => $request->val04,
			];
			$arraykdba[$intba++] = [
				'idsetting'     => 0,
				'nilaike'       => 'pat',
				'namakomponen'  => 'PAT',
				'idkd'          => 0,
				'deskripsi'     => 'PAT',
				'muatan'        => 'BA',
				'kodekd'        => 'PAT',
				'smt'           => $semester,
				'tapel'         => $tapel,
				'setidkelas'    => $request->val04,
			];
			$muatanlist = $jgroupps->toArray();
			if ($i == 0){
				$muatanlist[0]  						=   '-';
				$komponendasar[0][0]['deskripsi']		=   'No Data';
				$komponendasar[0][0]['id']				=   '0';
			}
			$data['muatanlist'] 	= $muatanlist;
			$data['arraykdba'] 		= $arraykdba;
			$data['komponendasar'] 	= $komponendasar;
			return response()->json($data);
		} else if ($bentuk == 'datakdba'){
			$datanilaiQuery = Datanilai::where('id_sekolah', session('sekolah_id_sekolah'))->where('semester', $semester)->where('tapel', $tapel)->where('kelas', $request->val04)->where('matpel', 'BA')->get();
			$jgroupps       = Datakd::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $request->val04)->where('semester', $semester)->where('muatan', 'BA')->groupBy('muatan')->pluck('muatan');
			$arraykdba      = [];
			$intba          = 0;
			$i              = 0;
			foreach ($jgroupps as $muatan) {
				$jklas	= DB::table('db_kd')->select('db_kd.*', 'db_komponennilai.p01', 'db_komponennilai.p02', 'db_komponennilai.p03', 'db_komponennilai.p04', 'db_komponennilai.p05', 'db_komponennilai.e01', 'db_komponennilai.e02', 'db_komponennilai.e03', 'db_komponennilai.e04', 'db_komponennilai.e05', 'db_komponennilai.pts', 'db_komponennilai.pat')->leftJoin('db_komponennilai', 'db_kd.id', 'db_komponennilai.idkd')->where('db_kd.kelas', $request->val04)->where('db_kd.semester', $semester)->where('db_kd.muatan', $muatan)->where('db_kd.id_sekolah', Session('sekolah_id_sekolah'))->get();
				foreach ($jklas as $rklas) {
					$ceksudah       = $datanilaiQuery->where('matpel', $rklas->muatan)->where('kodekd', $rklas->kodekd)->where('jennilai', 'p01')->count();
					if ($ceksudah == 0) {
						$arraykdba[$intba++] = [
							'idsetting'     => $rklas->id,
							'nilaike'       => 'p01',
							'namakomponen'  => 'Penilaian Harian 1',
							'idkd'          => $rklas->id,
							'deskripsi'     => $rklas->deskripsi,
							'muatan'        => $rklas->muatan,
							'kodekd'        => $rklas->kodekd,
							'smt'           => $semester,
							'tapel'         => $tapel,
							'setidkelas'    => $request->val04
						];
					}
				
				}
				$i++;
			}
			$arraykdba[$intba++] = [
				'idsetting'     => 0,
				'nilaike'       => 'pts',
				'namakomponen'  => 'PTS',
				'idkd'          => 0,
				'deskripsi'     => 'PTS',
				'muatan'        => 'BA',
				'kodekd'        => 'PTS',
				'smt'           => $semester,
				'tapel'         => $tapel,
				'setidkelas'    => $request->val04,
			];
			$arraykdba[$intba++] = [
				'idsetting'     => 0,
				'nilaike'       => 'pat',
				'namakomponen'  => 'PAT',
				'idkd'          => 0,
				'deskripsi'     => 'PAT',
				'muatan'        => 'BA',
				'kodekd'        => 'PAT',
				'smt'           => $semester,
				'tapel'         => $tapel,
				'setidkelas'    => $request->val04,
			];
			$data['arraykdba'] 		= $arraykdba;
			return response()->json($data);
		} else if ($bentuk == 'datakdmulok'){
			$datanilaiQuery = Datanilai::where('id_sekolah', session('sekolah_id_sekolah'))->where('semester', $semester)->where('tapel', $tapel)->where('kelas', $request->val04)->where('matpel', $request->val05)->get();
			$jgroupps       = Datakd::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $request->val04)->where('semester', $semester)->where('muatan', $request->val05)->groupBy('muatan')->pluck('muatan');
			$arraykomponen  = [];
			$intumum        = 0;
			$i              = 0;
			$nilai_map      = [
				'p01' => 'Penilaian Harian 1',
				'p02' => 'Penilaian Harian 2',
				'p03' => 'Penilaian Harian 3',
				'p04' => 'Penilaian Harian 4',
				'p05' => 'Penilaian Harian 5',
				'e01' => 'Evaluasi 1',
				'e02' => 'Evaluasi 2',
				'e03' => 'Evaluasi 3',
				'e04' => 'Evaluasi 4',
				'e05' => 'Evaluasi 5',
				'pts' => 'PTS',
				'pat' => 'PAT',
			];
			foreach ($jgroupps as $muatan) {
				$jklas	= DB::table('db_kd')->select('db_kd.*', 'db_komponennilai.p01', 'db_komponennilai.p02', 'db_komponennilai.p03', 'db_komponennilai.p04', 'db_komponennilai.p05', 'db_komponennilai.e01', 'db_komponennilai.e02', 'db_komponennilai.e03', 'db_komponennilai.e04', 'db_komponennilai.e05', 'db_komponennilai.pts', 'db_komponennilai.pat')->leftJoin('db_komponennilai', 'db_kd.id', 'db_komponennilai.idkd')->where('db_kd.kelas', $request->val04)->where('db_kd.semester', $semester)->where('db_kd.muatan', $muatan)->where('db_kd.id_sekolah', Session('sekolah_id_sekolah'))->get();
				foreach ($jklas as $rklas) {
					$nilai_types = [
						'p01' => $rklas->p01 ?? '0',
						'p02' => $rklas->p02 ?? '0',
						'p03' => $rklas->p03 ?? '0',
						'p04' => $rklas->p04 ?? '0',
						'p05' => $rklas->p05 ?? '0',
						'e01' => $rklas->e01 ?? '0',
						'e02' => $rklas->e02 ?? '0',
						'e03' => $rklas->e03 ?? '0',
						'e04' => $rklas->e04 ?? '0',
						'e05' => $rklas->e05 ?? '0',
						'pts' => $rklas->pts ?? '0',
						'pat' => $rklas->pat ?? '0'
					];
					foreach ($nilai_types as $type => $nilai) {
						if ($nilai == '1') {
							$ceksudah = $datanilaiQuery->where('matpel', $rklas->muatan)->where('kodekd', $rklas->kodekd)->where('jennilai', $type)->count();
							if ($ceksudah == 0) {
								$arraykomponen[$intumum++] = [
									'idsetting'     => $rklas->id,
									'nilaike'       => $type,
									'namakomponen'  => $nilai_map[$type] ?? $type,
									'idkd'          => $rklas->id,
									'deskripsi'     => $rklas->deskripsi,
									'muatan'        => $rklas->muatan,
									'kodekd'        => $rklas->kodekd,
									'smt'           => $semester,
									'tapel'         => $tapel,
									'setidkelas'    => $request->val04
								];
							}
						}
					}
				}
				$i++;
			}
			$data['arraykomponen'] 	= $arraykomponen;
			return response()->json($data);
		} else {
			$id			= '';
			$today 		= date('Y-m-d');
			$dateArray 	= array();
			for ($i = 0; $i < 7; $i++) {
				$dateArray[] = date('Y-m-d', strtotime($today . ' + ' . $i . ' days'));
			}
			foreach ($dateArray as $tanggal){
				$newDate 	= DateTime::createFromFormat('Y-m-d', $tanggal);
				$sethari 	= $newDate->format('D');
				$sql		= DB::table('jadwal_pembelajaran')->where('hari', $sethari)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				if (!empty($sql)){
					foreach ($sql as $rjadwal) {
						if ($id == ''){
							$id		= 'id1';
						} else {
							$id		= $rjadwal->id;
						}
						$mulai		= $tanggal.' '.$rjadwal->jammulai;
						$akhir		= $tanggal.' '.$rjadwal->jamakhir;
						$start 		= Carbon::parse($mulai)->format('Y-m-d H:i:s');
						$end 		= Carbon::parse($akhir)->format('Y-m-d H:i:s');
						$data[] = array(
							'id' 			=> $id,
							'description' 	=> $rjadwal->matapelajaran,
							'location' 		=> $rjadwal->kelas,
							'subject' 		=> $rjadwal->matapelajaran.' <font color="blue">Kelas '.$rjadwal->kelas.'</font><strong> ('.$rjadwal->ruang.')</strong><br />'.$rjadwal->guruterjadwal,
							'calendar' 		=> $rjadwal->ruang,
							'start' 		=> $start,
							'end'			=> $end,
						);
					}
				}
			}
			echo json_encode($data);
		}
	}
	public function exJadwalRPS(Request $request) {
    	$kerja			= $request->kerja;
		if ($kerja == 'materi'){
			$idne		= $request->val01;
			$guru		= $request->val02;
			$materi		= $request->val03;
			$getdatagr 	= Dataindukstaff::where('niy', $guru)->first();
			if (isset($getdatagr->id)){
				$guru 	= $getdatagr->nama;
				$niyguru= $getdatagr->niy;
			} else {
				$niyguru= 0;
			}
			$cekdata	= DB::table('jadwal_pembelajaran')->where('id', $idne)->first();
			if (isset($cekdata->id)){
				$terjadwal 	= $cekdata->niyguru;
				if ($terjadwal == $niyguru){
					$update		= DB::table('jadwal_pembelajaran')->where('id', $idne)->update([
						'guruterjadwal'	=> $guru,
						'guruyanghadir'	=> 'Sesuai Jadwal',
						'materi'		=> $materi
					]);
				} else {
					$update		= DB::table('jadwal_pembelajaran')->where('id', $idne)->update([
						'guruyanghadir'	=> $guru,
						'materi'		=> $materi
					]);
				}
				$catatan 	= Session('nama').' Mengubah Data Kehadiran Guru Data semula '.$cekdata->guruyanghadir.' materi : '.$cekdata->materi.' Menjadi '.$guru.' dengan materi '.$materi.'<br />Pada :'.date('Y-m-d H:i:s');
				if ($update){
					Logstaff::create([
						'sopo'			=> Session('nip'),
						'jenis'			=> 'Perubahan Data Kehadiran Guru', 
						'kelakuan'		=> $catatan,
						'id_sekolah' 	=> session('sekolah_id_sekolah')
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $catatan]);
					return back();
				} else { 
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database Error, Silahkan coba beberapa saat lagi']);
					return back(); 
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Tidak Valid, Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($kerja == 'removejadwalbymarking'){
			$idne		= $request->val02;
			$cekdata	= DB::table('jadwal_pembelajaran')->where('marking', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($cekdata->id)){
				$catatan 	= Session('nama').' Menghapus data Jadwal Mata Pelajaran '.$cekdata->matapelajaran.' Kelas '.$cekdata->kelas.' Semester '.$cekdata->semester.' TA '.$cekdata->tapel.'<br />Pada :'.date('Y-m-d H:i:s');
				$hapus		= DB::table('jadwal_pembelajaran')->where('marking', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
				if ($hapus){
					Logstaff::create([
						'sopo'			=> Session('nip'),
						'jenis'			=> 'Penghapusan Jadwal', 
						'kelakuan'		=> $catatan,
						'id_sekolah' 	=> session('sekolah_id_sekolah')
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $catatan]);
					return back();
				} else { 
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database Error, Silahkan coba beberapa saat lagi']);
					return back(); 
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Tidak Valid, Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($kerja == 'removejadwalbyid'){
			$idne		= $request->val02;
			$cekdata	= DB::table('jadwal_pembelajaran')->where('id', $idne)->first();
			if (isset($cekdata->id)){
				$catatan 	= Session('nama').' Menghapus data Pertemuan Mata Pelajaran '.$cekdata->matapelajaran.' Kelas '.$cekdata->kelas.' Semester '.$cekdata->semester.' TA '.$cekdata->tapel.' Guru Terjadwal '.$cekdata->guruterjadwal.' Guru Yang Hadir '.$cekdata->guruyanghadir.' ('.$cekdata->tglkehadiran.') Materi : '.$cekdata->materi.'<br />Pada :'.date('Y-m-d H:i:s');
				$hapus		= DB::table('jadwal_pembelajaran')->where('id', $idne)->delete();
				if ($hapus){
					Logstaff::create([
						'jenis'			=> 'Penghapusan Jadwal Pertemuan', 
						'sopo'			=> Session('nip'),
						'kelakuan'		=> $catatan,
						'id_sekolah' 	=> session('sekolah_id_sekolah')
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $catatan]);
					return back();
				} else { 
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database Error, Silahkan coba beberapa saat lagi']);
					return back(); 
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Tidak Valid, Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($kerja == 'waktu'){
			$idne		= $request->val01;
			$sethari	= $request->val02;
			$jammulai	= $request->val03;
			$jamakhir	= $request->val03;
			$ruangan	= $request->val04;
			$guru		= $request->val05;
			$getdatagr 	= Dataindukstaff::where('niy', $guru)->first();
			if (isset($getdatagr->id)){
				$guru 	= $getdatagr->nama;
				$niyguru= $getdatagr->niy;
			} else {
				$niyguru= 0;
			}
			$cekdata	= DB::table('jadwal_pembelajaran')->where('id', $idne)->first();
			if (isset($cekdata->id)){
				$jammulai 	= date( "H:i:s", strtotime( $jammulai ) );
				$jamakhir 	= date( "H:i:s", strtotime( $jamakhir ) );
				$catatan 	= Session('nama').' Mengubah Data Jadwal Data semula Tanggal '.$cekdata->tanggal.' ('.$cekdata->jammulai.'-'.$cekdata->jamakhir.') Ruang : '.$cekdata->ruang.' Guru : '.$cekdata->guruterjadwal.' Menjadi '.$tanggal.' ('.$jammulai.'-'.$jamakhir.') Ruang '.$ruang.' Guru : '.$guru.'<br />Pada :'.date('Y-m-d H:i:s');
				if ($ruang == 'Online' OR $ruang == 'Outing Class'){
					$cekruang = 0;
				} else {
					$cekruang = DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('ruang', $ruang)->where('hari', $hari)
											->where(function ($query) use ($jammulai, $jamakhir) {
												$query->where(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jammulai', '>=', $jammulai)
													->where('jammulai', '<', $jamakhir);
												})->orWhere(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jammulai', '<=', $jammulai)
													->where('jamakhir', '>', $jamakhir);
												})->orWhere(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jamakhir', '>', $jammulai)
													->where('jamakhir', '<=', $jamakhir);
												})->orWhere(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jammulai', '>=', $jammulai)
													->where('jamakhir', '<=', $jamakhir);
												});
											})->count();
				}
				if ($niyguru == '' OR $niyguru == null){
					$cekguru = 0;
				} else {
					$cekguru = DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('niyguru', $niyguru)->where('hari', $hari)
										->where(function ($query) use ($jammulai, $jamakhir) {
											$query->where(function ($q) use ($jammulai, $jamakhir) {
												$q->where('jammulai', '>=', $jammulai)
												->where('jammulai', '<', $jamakhir);
											})->orWhere(function ($q) use ($jammulai, $jamakhir) {
												$q->where('jammulai', '<=', $jammulai)
												->where('jamakhir', '>', $jamakhir);
											})->orWhere(function ($q) use ($jammulai, $jamakhir) {
												$q->where('jamakhir', '>', $jammulai)
												->where('jamakhir', '<=', $jamakhir);
											})->orWhere(function ($q) use ($jammulai, $jamakhir) {
												$q->where('jammulai', '>=', $jammulai)
												->where('jamakhir', '<=', $jamakhir);
											});
										})->count();
				}
				if ($cekruang == 0 AND $cekguru == 0){
					$input = DB::table('jadwal_pembelajaran')->where('id', $idne)->update([
						'jammulai'			=> $jammulai,
						'jamakhir'			=> $jamakhir,
						'hari'				=> $sethari,
						'ruang'				=> $ruang,
						'niyguru'			=> $niyguru,
						'guruterjadwal'		=> $guru,
					]);
					if ($input){
						Logstaff::create([
							'jenis'			=> 'Perubahan Jadwal', 
							'sopo'			=> Session('nip'),
							'kelakuan'		=> $catatan,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $catatan]);
						return back();
					} else {
						$gagal 	= $gagal.'<font color="red">Gagal Input Jadwal Pertemuan '.$pertemuan.' di Ruang '.$ruang.' Hari '.$sethari.' Waktu : '.$jammulai.' s/d '.$jamakhir.' Karena Kesalahan System</font><br />';
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => '<font color="red">Gagal Input Jadwal Pertemuan '.$pertemuan.' di Ruang '.$ruang.' Mulai '.$mulai.' s/d '.$akhir.' Kode Error Ruang : '.$cekruang.' Kode Error Pengampu : '.$cekguru.'</font><br />']);
					return back(); 
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Tidak Valid, Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else {
			$idmatpel		= $request->jadwal_matpel;
			$tapel 			= $request->jadwal_tapel;
			$semester		= $request->jadwal_semester;
			$idjadwal		= $request->jadwal_idne;
			$gagal 			= '';
			$sukses 		= '';
			$getdatamp 		= Datakkm::where('id', $idmatpel)->first();
			if (isset($getdatamp->id)){
				$kelas 		= $getdatamp->kelas;
				$matpel 	= $getdatamp->matpel;
				$hari 		= $request->jadwal_hari01;
				$ruang 		= $request->jadwal_ruangan01;
				$niyguru 	= $request->jadwal_guru01;
				$jammulai 	= $request->jadwal_mulai01;
				$jamakhir 	= $request->jadwal_akhir01;
				$setcrash 	= $request->jadwal_setting;
				$jammulai 	= date( "H:i:s", strtotime( $jammulai ) );
				$jamakhir 	= date( "H:i:s", strtotime( $jamakhir ) );
				$marking 	= $tapel.'-'.$semester.'-'.$kelas.'-'.$idmatpel;
				if ($setcrash == 'SEMUA'){
					$cekruang = 0;
					$cekguru = 0;
				} else {
					if ($ruang == 'Online' OR $ruang == 'Outing Class'){
						$cekruang = 0;
					} else if ($setcrash == 'RUANG'){
						$cekruang = 0;
					} else {
						$cekruang = DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('ruang', $ruang)->where('hari', $hari)
												->where(function ($query) use ($jammulai, $jamakhir) {
													$query->where(function ($q) use ($jammulai, $jamakhir) {
														$q->where('jammulai', '>=', $jammulai)
														->where('jammulai', '<', $jamakhir);
													})->orWhere(function ($q) use ($jammulai, $jamakhir) {
														$q->where('jammulai', '<=', $jammulai)
														->where('jamakhir', '>', $jamakhir);
													})->orWhere(function ($q) use ($jammulai, $jamakhir) {
														$q->where('jamakhir', '>', $jammulai)
														->where('jamakhir', '<=', $jamakhir);
													})->orWhere(function ($q) use ($jammulai, $jamakhir) {
														$q->where('jammulai', '>=', $jammulai)
														->where('jamakhir', '<=', $jamakhir);
													});
												})->count();
					}
					if ($niyguru == '' OR $niyguru == null){
						$cekguru = 0;
					} else if ($setcrash == 'GURU'){
						$cekguru = 0;
					} else {
						$cekguru = DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('niyguru', $niyguru)->where('hari', $hari)
											->where(function ($query) use ($jammulai, $jamakhir) {
												$query->where(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jammulai', '>=', $jammulai)
													->where('jammulai', '<', $jamakhir);
												})->orWhere(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jammulai', '<=', $jammulai)
													->where('jamakhir', '>', $jamakhir);
												})->orWhere(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jamakhir', '>', $jammulai)
													->where('jamakhir', '<=', $jamakhir);
												})->orWhere(function ($q) use ($jammulai, $jamakhir) {
													$q->where('jammulai', '>=', $jammulai)
													->where('jamakhir', '<=', $jamakhir);
												});
											})->count();
					}
				}
				
				if ($cekruang == 0 AND $cekguru == 0){
					$getdataguru 	= Dataindukstaff::where('niy', $niyguru)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
					if (isset($getdataguru->id)){
						$guru 		= $getdataguru->nama;
					} else {
						$guru 		= $niyguru;
					}
					$input = DB::table('jadwal_pembelajaran')->insert([
						'jammulai'			=> $jammulai,
						'jamakhir'			=> $jamakhir,
						'hari'				=> $hari,
						'ruang'				=> $ruang,
						'idmatpel'			=> $idmatpel,
						'matapelajaran'		=> $matpel,
						'kelas'				=> $kelas,
						'semester'			=> $semester,
						'tapel'				=> $tapel,
						'marking'			=> $marking,
						'guruterjadwal'		=> $guru,
						'niyguru'			=> $niyguru,
						'id_sekolah'		=> session('sekolah_id_sekolah'),
					]);
					if ($input){
						$sukses 	= $sukses.'<font color="success">Jadwal '.$matpel.' di Ruang '.$ruang.' Hari '.$hari.' Waktu : '.$jammulai.' s/d '.$jamakhir.' Sukses di Input</font><br />';
					} else {
						$gagal 	= $gagal.'<font color="red">Gagal Input Jadwal '.$matpel.' di Ruang '.$ruang.' Hari '.$hari.' Waktu : '.$jammulai.' s/d '.$jamakhir.' Karena Kesalahan System</font><br />';
					}
				} else {
					$gagal 	= $gagal.'<font color="red">Gagal Input Jadwal '.$matpel.' di Ruang '.$ruang.' Hari '.$hari.' Waktu : '.$jammulai.' s/d '.$jamakhir.' Kode Error Ruang : '.$cekruang.' Kode Error Pengampu : '.$cekguru.'</font><br />';
				}
				if ($gagal == ''){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idmatpel.' Tidak dikenali']);
				return back();
			}
		}
    }
	public function jsonDataSettingNilai(Request $request) {
		$arraysurat	= [];
		$semester	= $request->semester;
		$tapel		= $request->tapel;
		$jenis		= $request->jenis;
		$matpel		= $request->matpel;
		$kelas		= $request->kelas;
		$i 			= 0;
		if ($jenis == 'tersimpan'){
			$data		= new SettingNilai();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			if ($semester != null AND $semester != '') $data = $data->where('semester', $semester);
			if ($tapel != null AND $tapel != '') $data = $data->where('tapel', $tapel);
			if ($matpel != null AND $matpel != 'ALL') $data = $data->where('muatan', $matpel);
			if ($kelas != null AND $kelas != 'ALL') $data = $data->where('kelas', $kelas);
			$data 		= $data->where('id_sekolah', session('sekolah_id_sekolah'));
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('matpel', 'like', "%$searchTerm%")
					  ->orWhere('kodekd', 'like', "%$searchTerm%")
					  ->orWhere('deskripsi', 'like', "%$searchTerm%");
				});
			}
			$data		= $data->orderByRaw($order)->paginate($limit);
			$totaldata	= $data->total();
			if ($data) {
				foreach($data as $rows){
					$arraysurat[$i] = $rows;
					$i++;
				}
				$response = [
					'message'	=> 'List Data Kegiatan',
					'total'		=> $totaldata,
					'data'		=> $arraysurat
				];
				return response()->json($response, 200);
			}
			$response = [
				'message'        => 'No Data'
			];
			return response()->json($response, 500);
		} else if ($jenis == 'exporttabel'){
			$sql 		= SettingNilai::where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
			echo json_encode($sql);
		} else {
			$data		= new Datakd();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			$data 		= $data->whereNotIn('id', SettingNilai::where('semester', $semester)->where('tapel', $tapel)->pluck('idkd'));
			if ($matpel != null AND $matpel != 'ALL') $data = $data->where('muatan', $matpel);
			if ($kelas != null AND $kelas != 'ALL') $data = $data->where('kelas', $kelas);
			$data 		= $data->where('id_sekolah', session('sekolah_id_sekolah'));
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('kodekd', 'like', "%$searchTerm%")
					  ->orWhere('deskripsi', 'like', "%$searchTerm%");
				});
			}
			$data		= $data->orderByRaw($order)->paginate($limit);
			$totaldata	= $data->total();
			if ($data) {
				foreach($data as $rows){
					$arraysurat[$i] = $rows;
					$i++;
				}
				$response = [
					'message'	=> 'List Data Kegiatan',
					'total'		=> $totaldata,
					'data'		=> $arraysurat
				];
				return response()->json($response, 200);
			}
			$response = [
				'message'        => 'No Data'
			];
			return response()->json($response, 500);
		}
	}
	public function jsonLognilai() {
		$arrlognilai	= [];
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$smt 		= $getdatauser->smt;
			$tapel 		= $getdatauser->tapel;
		} else {
			$smt 		= '1';
			$tapel 		= '';
		}
		if (Session('previlage') == 'level1' OR Session('previlage') == 'Waka Kurikulum'  OR Session('previlage') == 'Waka Kurikulum Al Quran'){
			$getlognilai	= DB::table('db_loginputnilai')
								->select('db_loginputnilai.*', 'db_allstaf.nama')
								->leftJoin('db_allstaf', 'db_loginputnilai.niy', 'db_allstaf.niy')
								->where('db_loginputnilai.tapel', $tapel)
								->where('db_loginputnilai.semester', $smt)
								->where('db_loginputnilai.id_sekolah', Session('sekolah_id_sekolah'))
								->orderBy('db_loginputnilai.tanggal', 'DESC')
								->get();
		} else {
			$getlognilai	= DB::table('db_loginputnilai')
								->select('db_loginputnilai.*', 'db_allstaf.nama')
								->leftJoin('db_allstaf', 'db_loginputnilai.niy', 'db_allstaf.niy')
								->where('db_loginputnilai.niy', Session('nip'))
								->where('db_loginputnilai.tapel', $tapel)
								->where('db_loginputnilai.semester', $smt)
								->where('db_loginputnilai.id_sekolah', Session('sekolah_id_sekolah'))
								->orderBy('db_loginputnilai.tanggal', 'DESC')
								->get();
		}
		
		echo json_encode($getlognilai);
	}
	public function jsonLognilaiEKskul(Request $request) {
		$arrlognilai	= [];
		$ekskul 		= $request->val01;
		$tapel 			= $request->val02;
		$semester 		= $request->val03;
		
		$getlognilai	= DB::table('db_loginputnilai')
								->select('db_loginputnilai.*', 'db_allstaf.nama')
								->leftJoin('db_allstaf', 'db_loginputnilai.niy', 'db_allstaf.niy')
								->where('db_loginputnilai.matpel', $ekskul)
								->where('db_loginputnilai.tapel', $tapel)
								->where('db_loginputnilai.semester', $semester)
								->where('db_loginputnilai.id_sekolah', Session('sekolah_id_sekolah'))
								->orderBy('db_loginputnilai.tanggal', 'DESC')
								->get();
		echo json_encode($getlognilai);
	}
	public function jsonRinciannilai(Request $request) {
		$arrlognilai	= [];
		$marking 		= $request->val01;
		$set01 			= $request->matpel;	
		if ($marking == 'PAS' OR $marking == 'pat'){
			$getdata 		= Rapotan::where('semester', $request->semester.'.2')->where('tapel', $request->tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
			if (!empty($getdata)){
				foreach($getdata as $rows){
					$deskripsi 	= '';
					$posisi 	= '';
					$ekstrakulikuler1 		= $rows->ekstrakulikuler1 ?? '';
					$ekstrakulikuler2 		= $rows->ekstrakulikuler2 ?? '';
					$ekstrakulikuler3 		= $rows->ekstrakulikuler3 ?? '';
					$ekstrakulikuler4 		= $rows->ekstrakulikuler4 ?? '';
					$ekstrakulikuler5 		= $rows->ekstrakulikuler5 ?? '';
					if ($set01 == $ekstrakulikuler1){ $deskripsi = $rows->nildeskripsieks1 ?? ''; $posisi = '1'; }
					else if ($set01 == $ekstrakulikuler2){ $deskripsi = $rows->nildeskripsieks2 ?? ''; $posisi = '2'; }
					else if ($set01 == $ekstrakulikuler3){ $deskripsi = $rows->nildeskripsieks3 ?? ''; $posisi = '3'; }
					else if ($set01 == $ekstrakulikuler4){ $deskripsi = $rows->nildeskripsieks4 ?? ''; $posisi = '4'; }
					else if ($set01 == $ekstrakulikuler5){ $deskripsi = $rows->nildeskripsieks5 ?? ''; $posisi = '5'; }
					else { $deskripsi = ''; }
					if ($posisi != ''){
						$getlognilai[] = array(
							'id' 		=> $rows->id,
							'nama' 		=> $rows->getDataInduk->nama ?? $rows->nama ?? '',
							'noinduk' 	=> $rows->noinduk,
							'kelas'		=> $rows->getDataInduk->klspos ?? $rows->kelas ?? '',
							'posisi'	=> $posisi,
							'deskripsi'	=> $deskripsi,
						);
					}
				}
			}
		} else {
			$getlognilai 	= Datanilai::where('marking', 'LIKE', $marking.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		}
		echo json_encode($getlognilai);
	}
	public function exVerpresensi(Request $request) {
		$idne 		= $request->val01;
		$tapel 		= $request->val02;
		$kategori 	= $request->val03;
		$jenis 		= $request->val04;
		$iduser		= Session('id');
		$getdatauser= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$semester	= $getdatauser->smt;
		} else {
			$semester 	= 1;
		}
		if ($jenis == 'ekstrakulikuler'){
			$selama 		= $request->val05;
			$rmaster		= Datapresensiekskul::where('id', $idne)->first();
			if (isset($rmaster->id)){
				$tanggal 		= $rmaster->tanggal;
				$idsiswa 		= $rmaster->noinduk;
				$klspos 		= $rmaster->kelas;
				$alasan 		= $rmaster->alasan;
				$pemohon 		= $rmaster->petugas;
				$tabele 		= $rmaster->surat;
				if ($selama != 0){
					$tglsekarang 	= date('Y-m-d',strtotime($tanggal));		
					$next 			= 1;
					while ($selama != 0){
						$tglberikutnya 	= date('Y-m-d',strtotime('+'.$next.' days',strtotime($tglsekarang)));
						$marking 		= $idsiswa.$tglberikutnya.$klspos;
						Datapresensiekskul::create([
							'tanggal'	=> $tglberikutnya, 
							'noinduk'	=> $idsiswa, 
							'tapel'		=> $tapel, 
							'kelas'		=> $klspos, 
							'status'	=> $kategori, 
							'alasan'	=> $alasan, 
							'selama'	=> $selama, 
							'surat'		=> $tabele, 
							'petugas'	=> Session('nama'), 
							'marking'	=> $marking,
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						$selama = $selama - 1;
						$next++;
					}
				}
				$update	= Datapresensiekskul::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'tapel'			=> $tapel,
					'status'		=> $kategori,
					'petugas'		=> Session('nama'), 
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);				
				
				if ($update){
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses!</h4>
							Data Presensi Berhasil di Update
						</div>';
				}
				else { 
					echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Sistem Down, Silahkan Coba Beberapa Saat Lagi
					</div>'; 
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						'.$idne.' Tidak Ditemukan
					</div>'; 
			}
		} else {
			if ($tapel != '' or $kategori != ''){
				$rmaster		= Datapresensi::where('id', $idne)->first();
				if (isset($rmaster->selama)){
					$selama 		= (int)$rmaster->selama;
					$tanggal 		= $rmaster->tanggal;
					$idsiswa 		= $rmaster->noinduk;
					$klspos 		= $rmaster->kelas;
					$alasan 		= $rmaster->alasan;
					$pemohon 		= $rmaster->petugas;
					$tabele 		= $rmaster->surat;
					$semester 		= $rmaster->semester;
					if ($selama != 0){
						$tglsekarang 	= date('Y-m-d',strtotime($tanggal));		
						$next 			= 1;
						while ($selama != 0){
							$tglberikutnya 	= date('Y-m-d',strtotime('+'.$next.' days',strtotime($tglsekarang)));
							$marking 		= $idsiswa.$tglberikutnya.$klspos;
							Datapresensi::create([
								'tanggal'	=> $tglberikutnya,
								'noinduk'	=> $idsiswa,
								'tapel'		=> $tapel,
								'semester'	=> $semester,
								'kelas'		=> $klspos,
								'status'	=> $kategori,
								'alasan'	=> $alasan,
								'selama'	=> $selama,
								'surat'		=> $tabele,
								'petugas'	=> Session('nip'),
								'marking'	=> $marking,
								'id_sekolah'=> session('sekolah_id_sekolah')
							]);
							$selama = $selama - 1;
							$next++;
						}
					}
					$update	= Datapresensi::where('id', $idne)->update([
						'tapel'			=> $tapel,
						'semester'		=> $semester,
						'status'		=> $kategori,
						'petugas'		=> Session('nip'), 
						'id_sekolah' 	=> session('sekolah_id_sekolah'),
						'updated_at'	=> date('Y-m-d H:i:s')
					]);
					if ($update){
						$deskripsi = Session('nama').' Merubah Presensi Dengan Nomor Induk '.$idsiswa.' Kelas '.$klspos.' Yang Semula '.$rmaster->status.' Menjadi '.$kategori.' Pada '.date('Y-m-d H:i:s');
						Logstaff::create([
							'jenis'			=> 'Perubahan Presensi', 
							'sopo'			=> Session('nip'),
							'kelakuan'		=> $deskripsi,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Ijin Dari Orang Tua Telah di Setujui']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Coba Beberapa Saat Lagi']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada data yang diubah']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Kategori dan Tapel Wajib di Isi']);
				return back();
			}
		}
	}
	public function exSaveabsenall(Request $request) {
		$jnilai		= $request->nilai;
		$idjadwal	= $request->presensi_jadwal;
		$idmateri	= $request->presensi_materi;
		$tanggal	= $request->presensi_tanggal;
		$jammulai	= $request->presensi_mulai;
		$jamakhir	= $request->presensi_akhir;
		$ruang		= $request->presensi_ruang;
		$tapel		= $request->tapel;
		$semester	= $request->semester;
		$kelas		= $request->kelas;
		$matpel 	= '';
		
		$sukses 	= 0;
		$error 		= '';
		$materi 	= '';
		$kodekd 	= '';
		$muatan		= '';
		$tema 		= 0;
		$subtema	= 0;
		$getkodekd 	= Datakd::where('id', $idmateri)->first();
		if (isset($getkodekd->id)){
			$materi = $getkodekd->deskripsi;
			$kodekd = $getkodekd->kodekd;
			$matpel	= $getkodekd->matpel;
			$muatan	= $getkodekd->muatan;
			$tema	= $getkodekd->tema;
			$subtema= $getkodekd->subtema;
		}
		$idmatpel	= $muatan;
		$markingguru= $matpel.'-'.$tapel.'-'.$semester.'-'.$kelas.'-'.Session('nip').'-'.$tanggal.'-PresensiKelas';
		foreach ( $jnilai as $datanilai ){
			$nilainya 		= $datanilai['nilainya'];
			$keterangan 	= $datanilai['keterangan'];
			$noinduk		= $datanilai['noinduk'];
			$nama			= $datanilai['namanya'];
			$kelas			= $datanilai['kelas'];
			if ($keterangan == null){ $keterangan = ''; }
			$marking 		= $noinduk.$tanggal.$kelas;
			$ceksek 		= Datapresensi::where('tanggal', $tanggal)->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($ceksek == 0){
				$kerja		= Datapresensi::create([
					'tanggal'	=> $tanggal,
					'noinduk'	=> $noinduk,
					'tapel'		=> $tapel,
					'semester'	=> $semester,
					'kelas'		=> $kelas,
					'status'	=> $nilainya,
					'alasan'	=> $keterangan,
					'selama'	=> 0,
					'surat'		=> '',
					'petugas'	=> Session('nip'),
					'marking'	=> $marking,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				if ($kerja){
					$sukses++;
				} else {
					$error =  $error.'An. '.$nama.' No. Induk '.$noinduk.' Gagal Input<br />';
				}
			}
		}
		$jammulai 	= date( "H:i:s", strtotime( $jammulai ) );
		$jamakhir 	= date( "H:i:s", strtotime( $jamakhir ) );
		$tanggal 	= date( "Y-m-d", strtotime( $tanggal ) );
		$newDate 	= DateTime::createFromFormat('Y-m-d', $tanggal);
		$sethari 	= $newDate->format('D');
		$mulai		= $tanggal.' '.$jammulai;
		$akhir		= $tanggal.' '.$jamakhir;
		$createjadwal = DB::table('jadwal_realisasi')->where('guruyanghadir', Session('nama'))->where('mulai', $mulai)->where('kelas', $kelas)->where('matapelajaran', $matpel)->count();
		if ($createjadwal == 0){
			$niyguru 		= Session('nip');
			$cekdatalama 	= DB::table('jadwal_pembelajaran')->where('id', $idjadwal)->first();
			if (isset($cekdatalama->id)){
				$guruterjadwal 	= $cekdatalama->guruterjadwal;
			} else {
				$guruterjadwal 	= Session('nama');
			}
			$getidmatpel= Datakkm::where('kelas', $kelas)->where('muatan', $muatan)->first();
			if (isset($getidmatpel->id)){
				$idmatpel = $getidmatpel->id;
			}
			if ($materi == '' OR $materi == null){
				$materi	= $request->presensi_materimanual  ?? '-';
			}
			if ($matpel == '' OR $matpel == null){
				$matpel 	= $materi;
			}
			if ($ruang == null || $ruang == ''){ $ruang = 'Online'; }
			$input 		= DB::table('jadwal_realisasi')->insert([
				'tanggal'			=> $tanggal,
				'mulai'				=> $mulai,
				'akhir'				=> $akhir,
				'jammulai'			=> $jammulai,
				'jamakhir'			=> $jamakhir,
				'hari'				=> $sethari,
				'ruang'				=> $ruang,
				'idmatpel'			=> $idmatpel,
				'matapelajaran'		=> $matpel,
				'kelas'				=> $kelas,
				'semester'			=> $semester,
				'tapel'				=> $tapel,
				'marking'			=> $marking,
				'guruterjadwal'		=> $guruterjadwal,
				'niyguru'			=> $niyguru,
				'guruyanghadir'		=> Session('nama'),
				'materi'			=> $materi,
				'tglkehadiran'		=> $tanggal,
				'id_sekolah'		=> session('sekolah_id_sekolah'),
			]);
		} else {
		    $niyguru 		= Session('nip');
			$cekdatalama 	= DB::table('jadwal_pembelajaran')->where('id', $idjadwal)->first();
			if (isset($cekdatalama->id)){
				$guruterjadwal 	= $cekdatalama->guruterjadwal;
			} else {
				$guruterjadwal 	= Session('nama');
			}
			$getidmatpel= Datakkm::where('kelas', $kelas)->where('muatan', $muatan)->first();
			if (isset($getidmatpel->id)){
				$idmatpel = $getidmatpel->id;
			}
			if ($materi == '' OR $materi == null){
				$materi	= $request->presensi_materimanual  ?? '-';
			}
			if ($matpel == '' OR $matpel == null){
				$matpel 	= $materi;
			}
			if ($ruang == null || $ruang == ''){ $ruang = 'Online'; }
			$input 		= DB::table('jadwal_realisasi')->where('guruyanghadir', Session('nama'))->where('mulai', $mulai)->where('kelas', $kelas)->where('matapelajaran', $matpel)->update([
				'tanggal'			=> $tanggal,
				'mulai'				=> $mulai,
				'akhir'				=> $akhir,
				'jammulai'			=> $jammulai,
				'jamakhir'			=> $jamakhir,
				'hari'				=> $sethari,
				'ruang'				=> $ruang,
				'idmatpel'			=> $idmatpel,
				'matapelajaran'		=> $matpel,
				'kelas'				=> $kelas,
				'semester'			=> $semester,
				'tapel'				=> $tapel,
				'marking'			=> $marking,
				'guruterjadwal'		=> $guruterjadwal,
				'niyguru'			=> $niyguru,
				'guruyanghadir'		=> Session('nama'),
				'materi'			=> $materi,
				'tglkehadiran'		=> $tanggal,
				'id_sekolah'		=> session('sekolah_id_sekolah'),
			]);
		}
		if (Session('sekolah_id_sekolah') == '2'){
			$matpel = $matpel.' '.$materi;
		}
		$ceksudah	= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
		if ($ceksudah == 0){
			Loginputnilai::create([
				'niy'		=> Session('nip'), 
				'tanggal'	=> $tanggal, 
				'tema'		=> $tema,
				'subtema'	=> $subtema,
				'matpel'	=> $matpel,
				'kodekd'	=> $kodekd,
				'kelas'		=> $kelas,
				'tapel'		=> $tapel, 
				'jennilai'	=> 'Presensi Kelas', 
				'semester'	=> $semester, 
				'marking'	=> $markingguru,
				'id_sekolah'=> session('sekolah_id_sekolah')
			]);
		}
		if ($error == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Input Data Presensi sejumlah '.$sukses.' siswa sukses dilaksanakan.']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
		}
	}
	public function exSaveditnilai(Request $request) {
		$idne 		= $request->val01;
		$nilai 		= $request->val02;
		if ($idne == 'kms'){
			$rjeneng	= Datanilai::where('id', $request->id)->first();
			$noinduk 	= $rjeneng->noinduk;
			$nama 		= $rjeneng->nama;
			$kelas 		= $rjeneng->kelas;
			$tapel 		= $rjeneng->tapel;
			$semester 	= $rjeneng->semester;
			$tema 		= $rjeneng->tema;
			$subtema 	= $rjeneng->subtema;
			$kodekd 	= $rjeneng->kodekd;
			$matpel 	= $rjeneng->matpel;
			$nilailm	= $rjeneng->nilai;
			$penginput 	= $rjeneng->penginput;
			$tanggal	= $rjeneng->tanggal;
			$jennilai	= $rjeneng->jennilai;
			$marking	= $rjeneng->marking;
			$deskripsi	= Session('nama').' Mengubah Data KMS Tanggal '.$tanggal.' untuk ananda '.$nama.' Kelas '.$kelas.' Tapel '.$tapel.' <strong> Dari Semula '.$tema.' / '.$subtema.' / '.$nilailm.'  / '.$rjeneng->deskripsi.' Menjadi '.$request->val03.' / '.$request->val04.' / '.$request->val02.' / '.$request->val05.'</strong>';
			$update		= Datanilai::where('id', $request->id)->update([
				'nilai'			=> $nilai,
				'tema'			=> $request->val03,
				'subtema'		=> $request->val04,
				'deskripsi'		=> $request->val05,
				'updated_at' 	=> date('Y-m-d H:i:s')
			]);
		} else if ($idne == 'deksripsi'){
			$deskripsi	= Session('nama').' Mengubah Deskripsi Ekskul Ke '.$nilai.' Dengan ID '.$request->id;
			if ($nilai == '1'){
				$update		= Rapotan::where('id', $request->id)->update([
					'nildeskripsieks1' 	=> $request->val03,
					'updated_at' 		=> date('Y-m-d H:i:s')
				]);
			} else if ($nilai == '2'){
				$update		= Rapotan::where('id', $request->id)->update([
					'nildeskripsieks2' 	=> $request->val03,
					'updated_at' 		=> date('Y-m-d H:i:s')
				]);
			} else if ($nilai == '3'){
				$update		= Rapotan::where('id', $request->id)->update([
					'nildeskripsieks3' 	=> $request->val03,
					'updated_at' 		=> date('Y-m-d H:i:s')
				]);
			} else if ($nilai == '4'){
				$update		= Rapotan::where('id', $request->id)->update([
					'nildeskripsieks4' 	=> $request->val03,
					'updated_at' 		=> date('Y-m-d H:i:s')
				]);
			} else if ($nilai == '5'){
				$update		= Rapotan::where('id', $request->id)->update([
					'nildeskripsieks5' 	=> $request->val03,
					'updated_at' 		=> date('Y-m-d H:i:s')
				]);
			} else {
				$getdata 	= Rapotan::where('id', $request->id)->first();
				$sql 		= DB::table('db_setkeuangan')->join('db_datainduk', 'db_setkeuangan.noinduk', 'db_datainduk.noinduk')
								->select('db_datainduk.nama', 'db_datainduk.klspos', 'db_datainduk.noinduk', 'db_datainduk.foto', 'db_datainduk.alamatortu', 'db_datainduk.nisn', 'db_setkeuangan.eksul1', 'db_setkeuangan.eksul2', 'db_setkeuangan.eksul3', 'db_setkeuangan.eksul4', 'db_setkeuangan.eksul5')
								->where('db_datainduk.id_sekolah', session('sekolah_id_sekolah'))
								->where('db_datainduk.noinduk', $getdata->noinduk)->first();
				if ($sql){
					$update	= Rapotan::where('id', $getdata->id)->update([
						'ekstrakulikuler1' 	=> $sql->eksul1 ?? '',
						'ekstrakulikuler2' 	=> $sql->eksul2 ?? '',
						'ekstrakulikuler3' 	=> $sql->eksul3 ?? '',
						'ekstrakulikuler4' 	=> $sql->eksul4 ?? '',
						'ekstrakulikuler5' 	=> $sql->eksul5 ?? '',
					]);
				} else {
					$update = null;
				}
				
			}
		} else {
			$rjeneng	= Datanilai::where('id', $idne)->first();
			$noinduk 	= $rjeneng->noinduk;
			$nama 		= $rjeneng->nama;
			$kelas 		= $rjeneng->kelas;
			$tapel 		= $rjeneng->tapel;
			$semester 	= $rjeneng->semester;
			$tema 		= $rjeneng->tema;
			$subtema 	= $rjeneng->subtema;
			$kodekd 	= $rjeneng->kodekd;
			$matpel 	= $rjeneng->matpel;
			$nilailm	= $rjeneng->nilai;
			$penginput 	= $rjeneng->penginput;
			$tanggal	= $rjeneng->tanggal;
			$jennilai	= $rjeneng->jennilai;
			$marking	= $rjeneng->marking;
			$deskripsi	= Session('nama').' Mengubah Nilai '.$jennilai.' Tema '.$tema.' Subtema '.$subtema.' Kode KD '.$kodekd.' Kode Matpel '.$matpel.' Tanggal Record '.$tanggal.' untuk ananda '.$nama.' Kelas '.$kelas.' Tapel '.$tapel.' <strong> Dari Semula '.$nilailm.' Menjadi '.$nilai.'</strong>';
			$update		= Datanilai::where('id', $idne)->update([
				'nilai'			=> $nilai,
				'updated_at' 	=> date('Y-m-d H:i:s')
			]);
		}
		if ($update){
			Logstaff::create([
				'jenis'			=> 'Perubahan Nilai', 
				'sopo'			=> Session('nip'),
				'kelakuan'		=> $deskripsi,
				'id_sekolah' 	=> session('sekolah_id_sekolah')
			]);
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Berhasil diubah']);
			return back();
		} else { 
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database Error, Silahkan coba beberapa saat lagi']);
			return back(); 
		}
	}
	public function exSavesetguru(Request $request) {
		$smt 		= $request->val01;
		$kelas		= $request->val02;
		$tapel		= $request->val04;
		$tapel 		= str_replace('/','-', $tapel);
		$tapel 		= str_replace(' ','', $tapel);
		
		$getuser 	= User::where('id', Session('id'))->first();
		if (isset($getuser->nip)){
			$niy	= $getuser->nip;
			Dataindukstaff::where('niy', $niy)->update([
				'klsajar' 	=> $kelas,
				'smt'		=> $smt,
				'tapel'		=> $tapel
			]);
		}
		User::where('id', Session('id'))->update([
			'klsajar' 	=> $kelas,
			'smt'		=> $smt,
			'tapel'		=> $tapel
		]);
		return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Anda Sekarang Berada di Tapel : '.$tapel.' Semester '.$smt]);
		return back();
	}
	public function jsonDatakurikulumkelas(Request $request) {
		$kodeki 		= $request->val01;
		$kls 			= $request->val02;
		$matpel 		= $request->val03;
		$arrkurikulum 	= array();
		$kelas 			= substr($kls, -2,1);
		$cari			= $kodeki.'%';
		$sql 			= Datakd::where('kelas', $kelas)->where('muatan', $matpel)->where('kodekd', 'LIKE', $cari)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil) {
				$id 			= $hasil->id;
				$kelas 			= $hasil->kelas;
				$muatan 		= $hasil->muatan;
				$kodekd 		= $hasil->kodekd;
				$deskripsi 		= $hasil->deskripsi;
				$arrkurikulum[] = array(
					'id' 			=> $id,
					'kelas'			=> $kelas,
					'muatan'		=> $muatan,
					'kodekd'		=> $kodekd,
					'deskripsi'		=> $deskripsi,
				);
			}
		}
		
		echo json_encode($arrkurikulum);
	}
	public function jsonFormatupload(Request $request) {
		$set01 		= $request->val01;
		$set02 		= $request->val02;
		$set03 		= $request->val03;
		$set04 		= $request->val04;
		$set05 		= $request->val05;
		$arrpeserta	= [];
		$sql 		= Datainduk::where('klspos', $set01)->where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil) {
				$arrpeserta[] = array(
					'id' 		=> $hasil->id,	
					'nama' 		=> $hasil->nama,		
					'noinduk' 	=> $hasil->noinduk,
					'kelas'		=> $hasil->klspos,			
					'tanggal'	=> date("Y-m-d h:s:m"),
					'tapel'		=> $set03,
					'jenis'		=> 'ULANGAN/TUGAS/PAT/PAS',
					'semester'	=> $set05,
					'kodekd'	=> '',
					'tema'		=> '',
					'subtema'	=> '',
					'matpel'	=> $set02,
					'nilai'		=> '',
					'niyguru'	=> 'NIY. '.$set04,
				);
			}
		}
		echo json_encode($arrpeserta);
	}
	public function ctkBiodatarapot(Request $request) {
		$bulanlist 				= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$tgliki 				= date("d");
		$mthiki 				= (int)date("m");
		$thniki 				= date("Y");
		$tasks					= [];
		$idne					= $request->val01;
		$masterkls				= $request->val02;
		$blniki 				= $bulanlist[$mthiki];
		$tanggalctk 			= $tgliki.' '.$blniki.' '.$thniki;
		$niy 					= Session('nip');
		$asline 				= Session('nama');
		$rsetting				= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama ?? '';
		$niykasek				= $rsetting->kepala_sekolah->niy ?? '';
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
		$kota 					= $rsetting->kota;
		$logo_grey 				= $rsetting->logo_grey;
		$frontpage 				= $rsetting->frontpage;
		$akreditasi 			= $rsetting->akreditasi;
		$kopsurat 				= $rsetting->kopsurat;
		$nis 					= $rsetting->nis;
		$email 					= $rsetting->email;
		$homebase				= url("/");
		$generatetbl 			= '';
		$iduser					= Session('id');
		$getdatauser			= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$klsajar			= $getdatauser->klsajar;
			$semester 			= $getdatauser->smt;
			$tapel 				= $getdatauser->tapel;
		} else {
			$klsajar			= '';
			$semester 			= '';
			$tapel 				= '';
		}
		if ($idne == 'summaryreport'){
			$allsiswa 			= Datainduk::where('klspos', $request->kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->where('nokelulusan', '')->get();
			$arraymatpel 		= [];
			$tabel 				= '<table border="1"><tr><td rowspan="2">Nama</td><td rowspan="2">No.Induk</td>';
			$getdatakkm			= Datakkm::where('kelas', $request->masterkls)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('jenis', 'DESC')->orderBy('muatan', 'ASC')->get();
			foreach ($getdatakkm as $rkkm){
				$arraymatpel[] = [
					'muatan' 	=> $rkkm->muatan,
					'matpel' 	=> $rkkm->matpel,
					'kkm' 		=> $rkkm->kkm,
				];
				$tabel .= '<td colspan="2">'.$rkkm->muatan.'</td>';
			}
			$tabel .= '</tr><tr>'; 
			foreach ($arraymatpel as $rmp){
				$tabel .= '<td>P/E</td><td>PTS/PAS</td>';
			}
			$tabel .= '</tr>';
			foreach($allsiswa as $rinduk){
				$tabel .= '<tr><td>'.$rinduk->nama.'</td><td>'.$rinduk->noinduk.'</td>';
				foreach ($arraymatpel as $rmp){
					$golekakhir = DB::table('db_nilai')
									->whereIn('jennilai', ['pts', 'pat'])
									->where('noinduk', $rinduk->noinduk)
									->where('semester', $request->semester)
									->where('tapel', $request->tapel)
									->where('matpel', $rmp['muatan'])
									->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
									->groupBy('noinduk')
									->first();
	
					$golekharian = DB::table('db_nilai')
									->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
									->where('noinduk', $rinduk->noinduk)
									->where('semester', $request->semester)
									->where('tapel', $request->tapel)
									->where('matpel', $rmp['muatan'])
									->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
									->groupBy('noinduk')
									->first();
					$rataakhir 	= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
					$rataharian = isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
					$tabel .= '<td>'.round($rataharian, 2).'</td><td>'.round($rataakhir,2).'</td>';
				}
				$tabel .= '</tr>';
			}
			$tabel .= '</table>';
			return response()->json([
				'semester' => $request->semester,
				'tapel' => $request->tapel,
				'kelas' => $request->kelas,
				'masterkls' => $request->masterkls,
				'data' => $tabel,
			]);

		} else if ($idne == 'summaryreportpermapel'){
			$nomor 				= 1;
			$mapel				= $request->mapel;
			$tabel 				= '<table class="table table-bordered" border="1"><thead></tr><th align="center"><strong>NO</strong></th><th align="center"><strong>No.Induk</strong></th><th align="center"><strong>NISN</strong></th><th align="center"><strong>NAMA</strong></th><th align="center"><strong>Nilai</strong></th><th align="center"><strong>DESKRIPSI</strong></th></tr></thead><tbody>';
			$getdata 			= Rapotan::where('semester', $request->semester.'.2')->where('tapel', $request->tapel)->where('kelas', 'LIKE', $request->masterkls.'%')->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('noinduk', 'ASC')->get();
			foreach($getdata as $rows){
				$tabel			.= '<tr><td align="center">'.$nomor.'</td><td>'.$rows->noinduk.'</td><td>'.$rows->nisn.'</td><td>'.$rows->nama.'</td>';
				$ketemu 		= false;
				for ($i = 1; $i <= 30; $i++) {
					$idx        = str_pad($i, 2, '0', STR_PAD_LEFT);
					$kolomMapel = 'k' . $idx;
					$kolomNilai = 'n' . $idx;
					$kolomDesk  = 'deskripsi' . $idx;

					if (!empty($rows->$kolomMapel)) {
						$mapelData = explode('[pisah]', $rows->$kolomMapel);

						if (isset($mapelData[1]) && $mapelData[1] == $mapel) {
							$deskripsi 	= $mapelData[2] ?? '';
							$nilai 		= $mapelData[3] ?? $mapelData[0];
							$ketemu   	= true;
							$tabel .= '
							<td align="center">'.$nilai.'</td>
							<td>'.$deskripsi.'</td>';
							break;
						}
					}
				}
				if (!$ketemu) {
					$tabel .= '<td align="center">-</td><td>-</td>';
				}
				$tabel			.= '</tr>';
				$nomor++;
			}
			$tabel 			.= '</tbody></table>';
			return response()->json([
				'semester' 	=> $request->semester,
				'tapel' 	=> $request->tapel,
				'kelas' 	=> $request->kelas,
				'masterkls' => $request->masterkls,
				'data' 		=> $tabel,
			]);

		} else if($idne == 'getraporttpq') {
			$nama 				= $request->nama;
			$kelas				= $request->kelas;
			$noinduk 			= $request->noinduk;
			$nisn				= $request->nisn;
			$tapel 				= $request->tapel;
			$semester			= $request->semester;
			$arrtanggal			= explode(' ', $request->tanggal);
			$tanggal			= $arrtanggal[0];
			$arrtanggal			= explode('-', $tanggal);
			$yy 				= $arrtanggal[0];
			$mm 				= (int)$arrtanggal[1];
			$dd 				= $arrtanggal[2];
			$mm 				= $bulanlist[$mm];
			$tanggal			= $dd.' '.$mm.' '.$yy;
			$rmaster 			= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$data 				= [];
			$ttdkasek			= '[ttdks]';
			$ttdortu			= '[ttdortu]';
			$ttdguru			= '[ttdguru]';

			$markingguru		= $tapel.'-'.$semester.'-'.$kelas.'-'.$noinduk.'-'.session('sekolah_id_sekolah').'-RapotKhas';
			$cekpejabat     	= Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($cekpejabat->id)){
				$kepalasekolah	= $cekpejabat->nama;
				$niykasek       = $cekpejabat->niy;
				$kelamin       	= $cekpejabat->kelamin;
				if ($kelamin == 'P'){
					$kepalasekolah 	= 'Al-Ustadzah '.$kepalasekolah;
				} else {
					$kepalasekolah 	= 'Al-Ustadz '.$kepalasekolah;
				}
			} else {
				$kepalasekolah 	= '';
				$niykasek		= '';
			}
			$cekpejabat     = Dataindukstaff::where('jabatan', 'Waka Kurikulum')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($cekpejabat->id)){
				$namaguru		= $cekpejabat->nama;
				$nipguru       	= $cekpejabat->niy;
				$kelamin       	= $cekpejabat->kelamin;
				if ($kelamin == 'P'){
					$namaguru 	= 'Al-Ustadzah '.$namaguru;
				} else {
					$namaguru 	= 'Al-Ustadz '.$namaguru;
				}
			} else {
				$namaguru 		= Session('nama');
				$nipguru		= Session('nip');
			}
			$ratarata = 0;
			$perkeembanganKeys = ['rapot_perkembangan01', 'rapot_perkembangan02', 'rapot_perkembangan03', 'rapot_perkembangan04'];
			$nilai = [
				'BB' 	=> 1,
				'MB' 	=> 2,
				'BSH' 	=> 3,
				'BSB' 	=> 4
			];

			foreach ($perkeembanganKeys as $key) {
				if (isset($request->$key) && array_key_exists($request->$key, $nilai)) {
					${'n' . substr($key, -2)} = $nilai[$request->$key];
					$ratarata += $nilai[$request->$key];
				} else {
					${'n' . substr($key, -2)} = 0;
				}
			}
			$input 				= Rapotan::updateOrCreate(
				[
					'noinduk'	=> $noinduk,
					'semester'	=> $semester,
					'tapel'		=> $tapel,
					'id_sekolah'=> session('sekolah_id_sekolah')
				],
				[
					'nama' 				=> strtoupper($rmaster->nama),
					'nisn' 				=> $rmaster->nisn,
					'foto' 				=> $rmaster->foto,
					'alamat' 			=> $rmaster->tmplahir.', '.$rmaster->tgllahir,
					'kelas' 			=> $rmaster->jilid.' / '.$rmaster->klspos,
					'n01'				=> $n01 ?? 0,
					'n02'				=> $n02 ?? 0,
					'n03'				=> $n03 ?? 0,
					'n04'				=> $n04 ?? 0,
					'k01'				=> $request->rapot_indikator01,
					'k02'				=> $request->rapot_perkembangan01,
					'k03'				=> $request->deskripsi01,
					'k04'				=> $request->rapot_indikator02,
					'k05'				=> $request->rapot_perkembangan02,
					'k06'				=> $request->deskripsi02,
					'k07'				=> $request->rapot_indikator03,
					'k08'				=> $request->rapot_perkembangan03,
					'k09'				=> $request->deskripsi03,
					'k10'				=> $request->rapot_indikator04,
					'k11'				=> $request->rapot_perkembangan04,
					'k12'				=> $request->deskripsi04,
					'fase'				=> 'MATABA',
					'jumlahmatpel'		=> 4,
					'ratarata'			=> $ratarata,
					'namaguru'			=> $namaguru,
					'nipguru'			=> $nipguru,
					'namakepalasekolah'	=> $kepalasekolah,
					'nipkepalasekolah'	=> $niykasek,
					'sakit'				=> $request->sakit,
					'ijin'				=> $request->ijin,
					'alpha'				=> $request->alpha,
					'tanggal'			=> $tanggal,
				]
			);
			$getdata 				= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			$data['ttdortu']		= $ttdortu;
			$data['ttdguru']		= $ttdguru;
			$data['ttdkasek']		= $ttdkasek;
			$data['kopsurat']		= url('/').'/format/kop_rapot_mataba.png';
			$data['datarapot']		= $getdata;
			$data['tanggal']		= $tanggal;
			$generatesurat 			= view('cetak.rapottpq', $data)->render();
			XFiles::updateOrCreate(
				[
					'xmarking'	=> $markingguru,
				],
				[
					'xtabel'	=> 'db_rapotan',
					'xjenis'	=> '',
					'xfile'		=> $generatesurat
				]
			);
			$generatesurat			= str_replace('[ttdguru]', '<img src="'.$homebase.'/boxed-bg.jpg" height="100">', $generatesurat);
			$generatesurat			= str_replace('[ttdks]', '<img src="'.$homebase.'/boxed-bg.jpg" height="100">', $generatesurat);
			$generatesurat			= str_replace('[ttdortu]', '<img src="'.$homebase.'/boxed-bg.jpg" height="100">', $generatesurat);
			return response()->json([
				'rapotkhas' => $generatesurat,
			]);
		} else if($idne == 'getraportpqakhir') {
			$nama 				= $request->nama;
			$noinduk 			= $request->noinduk;
			$nisn				= $request->nisn;
			$tapel 				= $request->tapel;
			$semester			= $request->semester;
			$ttdguru			= $request->tandatangan;
			$kelas				= $request->kelas;
			$getdata 			= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($getdata->id)){
				$kelas			= $getdata->kelas;
				$tanggal		= $getdata->tanggal;
				$namafile		= url('/').'/ttdrapot/'.$getdata->id;
			} else {
				$kelas			= $request->kelas;
				$tanggal		= $request->tanggal;
				$namafile		= '';
			}
			XFiles::updateOrCreate(
				[
					'xmarking'	=> $tapel.'-'.$semester.'-'.$kelas.'-'.$noinduk.'-'.session('sekolah_id_sekolah').'-TTDGURU',
				],
				[
					'xtabel'	=> 'db_rapotan',
					'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
					'xfile'		=> $ttdguru
				]
			);
			$data['ttdortu']		= '[ttdortu]';
			$data['ttdguru']		= '<img src="'.$ttdguru.'" height="100">';
			$data['ttdkasek']		= '[ttdkasek]';
			$data['kopsurat']		= url('/').'/format/kop_rapot_mataba.png';
			$data['datarapot']		= $getdata;
			$data['tanggal']		= $tanggal;
			$generatesurat 			= view('cetak.rapottpq', $data)->render();

			XFiles::updateOrCreate(
				[
					'xmarking'	=> $tapel.'-'.$semester.'-'.$kelas.'-'.$noinduk.'-'.session('sekolah_id_sekolah').'-RapotKhas',
				],
				[
					'xtabel'	=> 'db_rapotan',
					'xjenis'	=> '',
					'xfile'		=> $generatesurat
				]
			);
			$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.$request->tanggal.'-'.Session('nip');
			$ceksudah		= Loginputnilai::where('marking',  $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($ceksudah == 0){
				Loginputnilai::create([
					'niy'		=> Session('nip'), 
					'tanggal'	=> $request->tanggal,
					'tema'		=> 0,
					'subtema'	=> 0,
					'matpel'	=> 'RapotKhas',
					'kodekd'	=> '',
					'kelas'		=> $kelas,
					'tapel'		=> $tapel,
					'jennilai'	=> 'Rapot',
					'semester'	=> $semester,
					'marking'	=> $markingguru,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
			}
			$i = 1;
			$getperingkat = Rapotan::where('kelas', $kelas)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('ratarata', 'DESC')->get();
			if (!empty($getperingkat)){
				foreach($getperingkat as $rows){
					Rapotan::where('id', $rows->id)->update([
						'rangking'	=> $i,
					]);
					$i++;
				}
			}
			if ($namafile != ''){
				Inboxsurat::updateOrCreate(
					[
						'xmarking'		=> Session('sekolah_id_sekolah').'-Rapot'.$getdata->id.'-persetujuanKS',
						'penerima' 		=> $getdata->nipkepalasekolah,
						'id_sekolah' 	=> Session('sekolah_id_sekolah')
					],
					[
						'tabel' 			=> 'db_rapotan',
						'perihal' 			=> 'Tandatangan Rapot Semester '.$semester.' / '.$tapel.' an. '.$getdata->nama.' Kelas '.$getdata->kelas,
						'pengirim' 			=> Session('nama'),
						'jenis' 			=> 'TTE',
						'urlsurat'			=> $namafile,
						'status'			=> 1
					]
				);
				$tuliskirim	= '<a href="'.$namafile.'" target="_blank">Tandatangan Rapot</a>';
				$keterangan	= '<p>Yth. '.$nama.'</p><p>Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :</p><p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p><p>'.$tuliskirim.'</p><p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih</p>';
				$getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $getdata->nipkepalasekolah)->first();
				if (isset($getuser->id)){
					Notification::send($getuser, new NewMessageNotification($tuliskirim));
					SendMail::notif($nama,$getuser->email,'Tandatangan Rapot',$keterangan);
				}
				$tuliskirim 			= 'Permohonan TTE Rapot';
				SendMail::mobilenotif($niy,'perseorangan',$nama,$tuliskirim);
			}
			
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Telah Kami Kirim kan Ke Kepala Sekolah Untuk di Tandatangani, Dengan Catatan : Data Siswa Akan Otomatis Berpindah ke Kelas Berikutnya (bila naik kelas) apabila Kepala Sekolah Sudah Tandatangan']);
			return back();
		} else if($idne == 'editorrapottpq'){
			$ratarata = 0;
			$perkeembanganKeys = ['rapot_perkembangan01', 'rapot_perkembangan02', 'rapot_perkembangan03', 'rapot_perkembangan04'];
			$nilai = [
				'BB' 	=> 1,
				'MB' 	=> 2,
				'BSH' 	=> 3,
				'BSB' 	=> 4
			];

			foreach ($perkeembanganKeys as $key) {
				if (isset($request->$key) && array_key_exists($request->$key, $nilai)) {
					${'n' . substr($key, -2)} = $nilai[$request->$key];
					$ratarata += $nilai[$request->$key];
				} else {
					${'n' . substr($key, -2)} = 0;
				}
			}
			$input = Rapotan::where('id', $request->nama)->update([
					'n01'				=> $n01 ?? 0,
					'n02'				=> $n02 ?? 0,
					'n03'				=> $n03 ?? 0,
					'n04'				=> $n04 ?? 0,
					'k01'				=> $request->rapot_indikator01,
					'k02'				=> $request->rapot_perkembangan01,
					'k03'				=> $request->deskripsi01,
					'k04'				=> $request->rapot_indikator02,
					'k05'				=> $request->rapot_perkembangan02,
					'k06'				=> $request->deskripsi02,
					'k07'				=> $request->rapot_indikator03,
					'k08'				=> $request->rapot_perkembangan03,
					'k09'				=> $request->deskripsi03,
					'k10'				=> $request->rapot_indikator04,
					'k11'				=> $request->rapot_perkembangan04,
					'k12'				=> $request->deskripsi04,
					'ratarata'			=> $ratarata,
					'sakit'				=> $request->sakit,
					'ijin'				=> $request->ijin,
					'alpha'				=> $request->alpha,
					'tanggal'			=> $request->tanggal,
			]);
			if ($input){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Rapot Telah Berhasil di Simpan']);
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#e74c3c',  'status' => 'Gagal.!', 'message' => 'Data Rapot Gagal di Simpan']);
			}
		} else if($idne == 'getraportawal') {
			$idne 				= $request->val02;
			$masterkls			= $request->val03;
			$tapel				= $request->val04;
			$semester			= $request->val05;
			$tanggal			= $request->val06;
			$getdatakkm			= Datakkm::where('kelas', $masterkls)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('jenis', 'DESC')->orderBy('muatan', 'ASC')->get();
			$jumlahmatpel 		= count($getdatakkm);
			$rmaster 			= Datainduk::where('id', $idne)->first();
			if (isset($rmaster->nama)){
				$jumlahtanggal 			= 0;
				$hadir 					= 0;
				$ijin 					= 0;
				$sakit 					= 0;
				$prestasi1				= '';
				$ketprestasi1			= '';
				$prestasi2				= '';
				$ketprestasi2			= '';
				$prestasi3				= '';
				$ketprestasi3			= '';
				$prestasi4				= '';
				$ketprestasi4			= '';
				$semestercari 			= mb_substr($semester, 0, 1);
				$totaldata  			= Datapresensi::where('tapel', $tapel)->where('semester', $semestercari)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('tanggal')->get();
				if (!empty($totaldata)){
					foreach($totaldata as $rdate){
						$jumlahtanggal++;
						$cekhadir  		= Datapresensi::where('tanggal', $rdate->tanggal)->where('noinduk', $rmaster->noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->whereIn('status', ['1', '5'])->count();
						$cekijin  		= Datapresensi::where('tanggal', $rdate->tanggal)->where('noinduk', $rmaster->noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->where('status', 2)->count();
						$ceksakit  		= Datapresensi::where('tanggal', $rdate->tanggal)->where('noinduk', $rmaster->noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->where('status', 3)->count();
						if ($cekhadir != 0){
							$hadir++;
						}
						if ($cekijin != 0){
							$ijin++;
						}
						if ($ceksakit != 0){
							$sakit++;
						}
					}
				}
				$getprestasi  			= Prestasi::where('tapel', $tapel)->where('noinduk', $rmaster->noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				if (!empty($getprestasi)){
					foreach($getprestasi as $rprestasi){
						if ($prestasi1 == ''){
							$prestasi1 		= 'Bidang '.$rprestasi->bidang.' Tingkat '.$rprestasi->tingkat.' '.$rprestasi->namakegiatan;
							$ketprestasi1	= $rprestasi->juara;
						} else if ($prestasi2 == ''){
							$prestasi2 		= 'Bidang '.$rprestasi->bidang.' Tingkat '.$rprestasi->tingkat.' '.$rprestasi->namakegiatan;
							$ketprestasi2	= $rprestasi->juara;
						} else if ($prestasi3 == ''){
							$prestasi3 		= 'Bidang '.$rprestasi->bidang.' Tingkat '.$rprestasi->tingkat.' '.$rprestasi->namakegiatan;
							$ketprestasi3	= $rprestasi->juara;
						} else {
							$prestasi4 		= 'Bidang '.$rprestasi->bidang.' Tingkat '.$rprestasi->tingkat.' '.$rprestasi->namakegiatan;
							$ketprestasi4	= $rprestasi->juara;
						}
					}
				}
				$alpha 			= $jumlahtanggal - ($hadir + $ijin + $sakit);
				$markingguru	= $tapel.'-'.$semester.'-'.$rmaster->klspos.'-'.Session('nip').'-DIRI';
				$input 			= Rapotan::updateOrCreate(
					[
						'noinduk' 		=> $rmaster->noinduk,
						'semester' 		=> $semester,
						'tapel' 		=> $tapel,
						'id_sekolah' 	=> session('sekolah_id_sekolah'),
					],
					[
						'nama' 				=> strtoupper($rmaster->nama),
						'nisn' 				=> $rmaster->nisn,
						'foto' 				=> $rmaster->foto,
						'alamat' 			=> $rmaster->alamat,
						'kelas' 			=> $rmaster->klspos,
						'sakit'				=> $sakit,
						'ijin'				=> $ijin,
						'alpha'				=> $alpha,
						'prestasi1'			=> $prestasi1,
						'ketprestasi1'		=> $ketprestasi1,
						'prestasi2'			=> $prestasi2,
						'ketprestasi2'		=> $ketprestasi2,
						'prestasi3'			=> $prestasi3,
						'ketprestasi3'		=> $ketprestasi3,
						'prestasi4'			=> $prestasi4,
						'ketprestasi4'		=> $ketprestasi4,
						'jumlahmatpel'		=> $jumlahmatpel,
						'tanggal'			=> $tanggal,
						'marking' 			=> session('sekolah_id_sekolah').'-'.$tapel.'-'.$semester.'.-'.$rmaster->noinduk,
						'id_sekolah' 		=> session('sekolah_id_sekolah')
					]
				);
				$getdata 		= Rapotan::where('noinduk', $rmaster->noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
				return response()->json([
					'nama' 			=> strtoupper($rmaster->nama), 
					'nisn' 			=> $rmaster->nisn,
					'noinduk' 		=> $rmaster->noinduk,
					'kelas' 		=> $rmaster->klspos,
					'namasekolah' 	=> $sekolah,
					'alamatsekolah' => $alamat,
					'sakit' 		=> $sakit,
					'ijin' 			=> $ijin,
					'alpha' 		=> $alpha,
					'efektif' 		=> $jumlahtanggal,
					'k01'			=> $getdata->k01 ?? '',
					'k02'			=> $getdata->k02 ?? '',
					'k03'			=> $getdata->k03 ?? '',
					'k04'			=> $getdata->k04 ?? '',
					'k05'			=> $getdata->k05 ?? '',
					'k06'			=> $getdata->k06 ?? '',
					'k07'			=> $getdata->k07 ?? '',
					'k08'			=> $getdata->k08 ?? '',
					'k09'			=> $getdata->k09 ?? '',
					'k10'			=> $getdata->k10 ?? '',
					'k11'			=> $getdata->k11 ?? '',
					'k12'			=> $getdata->k12 ?? '',
				]);
				return back();
			} else {
				return response()->json([
					'nama' 			=> '',
					'nisn' 			=> '',
					'noinduk' 		=> '',
					'kelas' 		=> '',
					'namasekolah' 	=> $sekolah,
					'alamatsekolah' => $alamat,
				]);
				return back();
			}
		} else if($idne == 'getraportdua') {
			$n01 			= 0;
			$n02 			= 0;
			$n03 			= 0;
			$n04 			= 0;
			$n05 			= 0;
			$n06 			= 0;
			$n07 			= 0;
			$n08 			= 0;
			$n09 			= 0;
			$n10 			= 0;
			$n11 			= 0;
			$n12 			= 0;
			$n13 			= 0;
			$n14 			= 0;
			$n15 			= 0;
			$n16 			= 0;
			$n17 			= 0;
			$n18 			= 0;
			$n19 			= 0;
			$n20 			= 0;
			$n21 			= 0;
			$n22 			= 0;
			$n23 			= 0;
			$n24 			= 0;
			$n25 			= 0;
			$n26 			= 0;
			$n27 			= 0;
			$n28 			= 0;
			$n29 			= 0;
			$n30 			= 0;

			$h01 			= '';
			$h02 			= '';
			$h03 			= '';
			$h04 			= '';
			$h05 			= '';
			$h06 			= '';
			$h07 			= '';
			$h08 			= '';
			$h09 			= '';
			$h10 			= '';
			$h11 			= '';
			$h12 			= '';
			$h13 			= '';
			$h14 			= '';
			$h15 			= '';
			$h16 			= '';
			$h17 			= '';
			$h18 			= '';
			$h19 			= '';
			$h20 			= '';
			$h21 			= '';
			$h22 			= '';
			$h23 			= '';
			$h24 			= '';
			$h25 			= '';
			$h26 			= '';
			$h27 			= '';
			$h28 			= '';
			$h29 			= '';
			$h30 			= '';
			
			$k01 			= '';
			$k02 			= '';
			$k03 			= '';
			$k04 			= '';
			$k05 			= '';
			$k06 			= '';
			$k07 			= '';
			$k08 			= '';
			$k09 			= '';
			$k10 			= '';
			$k11 			= '';
			$k12 			= '';
			$k13 			= '';
			$k14 			= '';
			$k15 			= '';
			$k16 			= '';
			$k17 			= '';
			$k18 			= '';
			$k19 			= '';
			$k20 			= '';
			$k21 			= '';
			$k22 			= '';
			$k23 			= '';
			$k24 			= '';
			$k25 			= '';
			$k26 			= '';
			$k27 			= '';
			$k28 			= '';
			$k29 			= '';
			$k30 			= '';
			$nama 			= $request->nama;
			$kelas			= $request->kelas;
			$noinduk 		= $request->noinduk;
			$nisn			= $request->nisn;
			$tapel 			= $request->tapel;
			$semester		= $request->semester;
			$jnilai			= $request->nilaiafektif;
			$semestercari 	= mb_substr($semester, 0, 1);

			$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.$noinduk.'-'.session('sekolah_id_sekolah').'-AKHLAK';
			foreach ( $jnilai as $datanilai ){
				$nilai 		= $datanilai['nilai'];
				$muatan 	= $datanilai['muatan'];
				$matpel		= $datanilai['matpel'];
				$kkm		= $datanilai['kkm'];
				foreach (range(1, 30) as $i) {
					$hVar 	= 'h'. sprintf('%02d', $i);
					$kVar 	= 'k'. sprintf('%02d', $i);
					$nVar 	= 'n'. sprintf('%02d', $i);
					if ($$hVar == '') {
						$deskripsi	= '';
						$cekjenis 	= Datakkm::where('muatan', $muatan)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
						if (isset($cekjenis->id)){
							$jenis = $cekjenis->jenis;
						} else {
							$jenis = 'Wajib';
						}
						$idterbesar 		= 0;
						$golekterterbesar	= Datanilai::whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
												->where('noinduk', $noinduk)
												->where('semester', $semestercari)
												->where('tapel', $tapel)
												->where('matpel', $muatan)
												->where('id_sekolah', Session('sekolah_id_sekolah'))
												->orderBY('nilai', 'DESC')
												->first();
						if (isset($golekterterbesar->nilai)){
							$idterbesar 	= $golekterterbesar->id;
							$nilaiterbesar 	= $golekterterbesar->nilai;
							$kelasbesar 	= $golekterterbesar->kelas;
							$kelasbesar 	= mb_substr($kelasbesar, 0, 1);
							$cekdatabesar	= Datakd::where('muatan', $golekterterbesar->matpel)->where('kodekd', $golekterterbesar->kodekd)->where('kelas', $kelasbesar)->first();
							$range01 		= $cekdatabesar->template01 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
							$range02 		= $cekdatabesar->template02 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
							$range03 		= $cekdatabesar->template03 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
							$range04 		= $cekdatabesar->template04 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
							$range05 		= $cekdatabesar->template05 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
							$teks 			= '';
							if ($nilaiterbesar <= 74) {
								$teks = $range01;
							} else if (74 < $nilaiterbesar && $nilaiterbesar <= 77) {
								$teks = $range02;
							} else if (77 < $nilaiterbesar && $nilaiterbesar <= 85) {
								$teks = $range03;
							} else if (85 < $nilaiterbesar && $nilaiterbesar <= 92) {
								$teks = $range04;
							} else {
								$teks = $range05;
							}
							if ($golekterterbesar->matpel == 'BA'){
								$deskripsi		= $deskripsi.$teks.$golekterterbesar->kodekd;
							} else {
								$deskripsi		= $deskripsi.$teks.$golekterterbesar->deskripsi;
							}
						}
						$golekterkecil		= Datanilai::whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
												->where('noinduk', $noinduk)
												->where('semester', $semestercari)
												->where('tapel', $tapel)
												->where('matpel', $muatan)
												->where('id', '!=', $idterbesar)
												->where('id_sekolah', Session('sekolah_id_sekolah'))
												->orderBY('nilai', 'ASC')
												->first();
						if (isset($golekterkecil->id)){
							$nilaiterkecil 	= $golekterkecil->nilai;
							$kelaskecil 	= $golekterkecil->kelas;
							$kelaskecil 	= mb_substr($kelaskecil, 0, 1);
							$cekdatakecil 	= Datakd::where('muatan', $golekterkecil->matpel)->where('kodekd', $golekterkecil->kodekd)->where('kelas', $kelaskecil)->first();
							$range01 		= $cekdatakecil->template01 ?? 'Ananda perlu pendampingan dalam ';
							$range02 		= $cekdatakecil->template02 ?? 'Ananda perlu pendampingan dalam ';
							$range03 		= $cekdatakecil->template03 ?? 'Ananda perlu pendampingan dalam ';
							$range04 		= $cekdatakecil->template04 ?? 'Ananda perlu pendampingan dalam ';
							$range05 		= $cekdatakecil->template05 ?? 'Ananda perlu pendampingan dalam ';
							$teks 			= '';
							if ($nilaiterkecil <= 74) {
								$teks = $range01;
							} else if (74 < $nilaiterkecil && $nilaiterkecil <= 77) {
								$teks = $range02;
							} else if (77 < $nilaiterkecil && $nilaiterkecil <= 85) {
								$teks = $range03;
							} else if (85 < $nilaiterkecil && $nilaiterkecil <= 92) {
								$teks = $range04;
							} else {
								$teks = $range05;
							}
							if ($golekterkecil->matpel == 'BA'){
								$deskripsi		= $deskripsi.'<br />'.$teks.$golekterkecil->kodekd;
							} else {
								$deskripsi		= $deskripsi.'<br />'.$teks.$golekterkecil->deskripsi;
							}
						}
						$golekakhir = DB::table('db_nilai')->whereIn('jennilai', ['pts', 'pat'])->where('noinduk', $noinduk)->where('semester', $semestercari)->where('tapel', $tapel)->where('matpel', $muatan)->where('id_sekolah', Session('sekolah_id_sekolah'))->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
						$golekharian= DB::table('db_nilai')->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])->where('noinduk', $noinduk)->where('semester', $semestercari)->where('tapel', $tapel)->where('matpel', $muatan)->where('id_sekolah', Session('sekolah_id_sekolah'))->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
						$rataakhir 	= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
						$rataharian = isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
						if ($semester == '1.1' OR $semester == '2.1'){
							if ($rataakhir > 0 && $rataharian > 0){
								$angka 		= ($rataakhir != 0 && $rataharian != 0) ? round(((($rataharian * 2) + $rataakhir) / 3), 0) : 0;
							} else {
								if ($rataakhir > 0){
									$angka 		= round($rataakhir, 0);
								} else {
									$angka 		= round($rataharian, 0);
								}
							}
						} else {
							$angka 		= ($rataakhir != 0 && $rataharian != 0) ? round(((($rataharian * 2) + $rataakhir) / 3), 0) : 0;
						}
						$$hVar = $jenis.'; '.$matpel;
						$$kVar = $nilai.'[pisah]'.$muatan.'[pisah]'.$deskripsi.'[pisah]'.$angka;
						$$nVar = $kkm;
						break;
					}
				}
			}
			Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
				'n01' 				=> $n01,
				'n02' 				=> $n02,
				'n03' 				=> $n03,
				'n04' 				=> $n04,
				'n05' 				=> $n05,
				'n06' 				=> $n06,
				'n07' 				=> $n07,
				'n08' 				=> $n08,
				'n09' 				=> $n09,
				'n10' 				=> $n10,
				'n11' 				=> $n11,
				'n12' 				=> $n12,
				'n13' 				=> $n13,
				'n14' 				=> $n14,
				'n15' 				=> $n15,
				'n16' 				=> $n16,
				'n17' 				=> $n17,
				'n18' 				=> $n18,
				'n19' 				=> $n19,
				'n20' 				=> $n20,
				'n21' 				=> $n21,
				'n22' 				=> $n22,
				'n23' 				=> $n23,
				'n24' 				=> $n24,
				'n25' 				=> $n25,
				'n26' 				=> $n26,
				'n27' 				=> $n27,
				'n28' 				=> $n28,
				'n29' 				=> $n29,
				'n30' 				=> $n30,
				'h01' 				=> $h01,
				'h02' 				=> $h02,
				'h03' 				=> $h03,
				'h04' 				=> $h04,
				'h05' 				=> $h05,
				'h06' 				=> $h06,
				'h07' 				=> $h07,
				'h08' 				=> $h08,
				'h09' 				=> $h09,
				'h10' 				=> $h10,
				'h11' 				=> $h11,
				'h12' 				=> $h12,
				'h13' 				=> $h13,
				'h14' 				=> $h14,
				'h15' 				=> $h15,
				'h16' 				=> $h16,
				'h17' 				=> $h17,
				'h18' 				=> $h18,
				'h19' 				=> $h19,
				'h20' 				=> $h20,
				'h21' 				=> $h21,
				'h22' 				=> $h22,
				'h23' 				=> $h23,
				'h24' 				=> $h24,
				'h25' 				=> $h25,
				'h26' 				=> $h26,
				'h27' 				=> $h27,
				'h28' 				=> $h28,
				'h29' 				=> $h29,
				'h30' 				=> $h30,
				'k01' 				=> $k01,
				'k02' 				=> $k02,
				'k03' 				=> $k03,
				'k04' 				=> $k04,
				'k05' 				=> $k05,
				'k06' 				=> $k06,
				'k07' 				=> $k07,
				'k08' 				=> $k08,
				'k09' 				=> $k09,
				'k10' 				=> $k10,
				'k11' 				=> $k11,
				'k12' 				=> $k12,
				'k13' 				=> $k13,
				'k14' 				=> $k14,
				'k15' 				=> $k15,
				'k16' 				=> $k16,
				'k17' 				=> $k17,
				'k18' 				=> $k18,
				'k19' 				=> $k19,
				'k20' 				=> $k20,
				'k21' 				=> $k21,
				'k22' 				=> $k22,
				'k23' 				=> $k23,
				'k24' 				=> $k24,
				'k25' 				=> $k25,
				'k26' 				=> $k26,
				'k27' 				=> $k27,
				'k28' 				=> $k28,
				'k29' 				=> $k29,
				'k30' 				=> $k30,
				'sakit'				=> $request->sakit,
				'ijin'				=> $request->ijin,
				'alpha'				=> $request->alpha,
				'tanggal'			=> $request->tanggal,
			]);
			$cekrapotakhlak 	= XFiles::where('xmarking', $tapel.'-'.$semester.'-'.$kelas.'-'.$noinduk.'-'.session('sekolah_id_sekolah').'-AKHLAK')->first();
			if (isset($cekrapotakhlak->xfile)){
				$rapotakhlak 	= $cekrapotakhlak->xfile;
			} else {
				$rapotakhlak	= '<table cellspacing="0" border="1" style="width:100%">
										<thead><tr><th style="width:10%" bgcolor="#F2F2F2"><strong>No</strong></th><th style="width:60%" bgcolor="#F2F2F2"><strong>Jenis Kegiatan</strong></th><th style="width:30%" bgcolor="#F2F2F2"><strong>Nilai</strong></th></tr>
										</thead>
										<tbody>
											<tr><td style="text-align:center">1</td><td><strong>CERIA</strong> (Terbiasa mengucapkan salam dan ramah)</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">2</td><td><strong>ENERJIK</strong> (Semangat menuntut ilmu dalam menggapai ridho Allah SWT)</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">3</td><td>Gemar membaca</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">4</td><td><strong>RAJIN</strong> (Aktif berbahasa Arab dan Ingris)</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">5</td><td><strong>DISIPLIN</strong> (Berakidah kuat)</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">6</td><td>Terbiasa sholat fardhu</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">7</td><td>Senantiasa berdoa dalam setiap aktifitas</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">8</td><td>Terbiasa mengucapkan kalimat toyibah</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">9</td><td><strong>AL QURAN</strong> (Istiqomah dalam membaca, menghafal dan memahami Al Quran)</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">10</td><td><strong>SANTUN</strong> (Menjadi pribadi yang berakhlakul karimah)</td><td style="text-align:center">A/B/C/D</td></tr>
											<tr><td style="text-align:center">11</td><td>Mencintai lingkungan</td><td style="text-align:center">A/B/C/D</td></tr>
										</tbody>
									</table>';
			}
			$getdata 	= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($getdata->id)){
				$saran 	= $getdata->saran;
			} else {
				$saran	= '';
			}
			return response()->json([
				'rapotakhlak' 	=> $rapotakhlak,
				'saran' 		=> $saran,
			]);
			return back();
		} else if($idne == 'getraporttiga') {
			$nama 			= $request->nama;
			$kelas			= $request->kelas;
			$noinduk 		= $request->noinduk;
			$nisn			= $request->nisn;
			$tapel 			= $request->tapel;
			$semester		= $request->semester;
			$semestercari 	= mb_substr($semester, 0, 1);

			$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.$noinduk.'-'.session('sekolah_id_sekolah').'-AKHLAK';
			$ceksudah 		= XFiles::where('xmarking', $markingguru)->count();
			if ($ceksudah == 0){
				XFiles::create([
					'xmarking'	=> $markingguru,
					'xtabel'	=> 'db_rapotan',
					'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
					'xfile'		=> $request->rapotakhlak
				]);
			} else {
				XFiles::where('xmarking', $markingguru)->update([
					'xtabel'	=> 'db_rapotan',
					'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
					'xfile'		=> $request->rapotakhlak
				]);
			}
			Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
				'saran'				=> $request->saran,
			]);
			$getdata 				= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			$generatesurat 			= FrontpageController::genSurat($getdata->id, 'rapotkhas');
			return response()->json([
				'rapotkhas' => $generatesurat,
			]);
		} else if($idne == 'getraportempat') {
			$nama 			= $request->nama;
			$kelas			= $request->kelas;
			$noinduk 		= $request->noinduk;
			$nisn			= $request->nisn;
			$tapel 			= $request->tapel;
			$semester		= $request->semester;
			$ttdguru		= $request->tandatangan;
			$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.$noinduk.'-'.session('sekolah_id_sekolah').'-TTDGURU';
			$ceksudah 		= XFiles::where('xmarking', $markingguru)->count();
			if ($ceksudah == 0){
				XFiles::create([
					'xmarking'	=> $markingguru,
					'xtabel'	=> 'db_rapotan',
					'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
					'xfile'		=> $ttdguru
				]);
			} else {
				XFiles::where('xmarking', $markingguru)->update([
					'xmarking'	=> $markingguru,
					'xtabel'	=> 'db_rapotan',
					'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
					'xfile'		=> $ttdguru
				]);
			}
			$cekpejabat     = Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($cekpejabat->id)){
				$kepalasekolah	= $cekpejabat->nama;
				$niykasek       = $cekpejabat->niy;
			} else {
				$kepalasekolah 	= '';
				$niykasek		= '';
			}
			Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
				'namaguru'			=> Session('nama'),
				'nipguru'			=> Session('nip'),
				'namakepalasekolah'	=> $kepalasekolah,
				'nipkepalasekolah'	=> $niykasek,
				'updated_at'		=> date('Y-m-d H:i:s')
			]);
			$getdata 	= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($getdata->id)){
				if ($getdata->semester == '1.1' OR $getdata->semester == '2.1'){
					$generatesurat = FrontpageController::genSurat($getdata->id, 'rapotkhas');
				} else {
					$generatesurat = FrontpageController::genSurat($getdata->id, 'rapot');
				}
			} else {
				$generatesurat = '';
			}
			return response()->json([
				'rapotdinas' => $generatesurat,
			]);
		} else if($idne == 'getraportlima') {
			$nama 			= $request->nama;
			$kelas			= $request->kelas;
			$noinduk 		= $request->noinduk;
			$nisn			= $request->nisn;
			$tapel 			= $request->tapel;
			$semester		= $request->semester;
			$update 		= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
				'keputusan'		=> $request->nomor,
				'naik'			=> $request->naikkelas,
				'fase'			=> $request->fase,
				'tanggal'		=> $request->tanggal,
				'updated_at'	=> date('Y-m-d H:i:s')
			]);
			if ($update){
				$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.$request->tanggal;
				$ceksudah		= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($ceksudah == 0){
					Loginputnilai::create([
						'niy'		=> Session('nip'), 
						'tanggal'	=> $request->tanggal,
						'tema'		=> 0,
						'subtema'	=> 0,
						'matpel'	=> '',
						'kodekd'	=> '',
						'kelas'		=> $kelas,
						'tapel'		=> $tapel,
						'jennilai'	=> 'Rapot',
						'semester'	=> $semester,
						'marking'	=> $markingguru,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
				}
				$getdata 	= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
				if (isset($getdata->id)){
					$namafile	= url('/').'/ttdrapot/'.$getdata->id;
					Inboxsurat::updateOrCreate(
						[
							'xmarking'		=> Session('sekolah_id_sekolah').'-Rapot'.$getdata->id.'-persetujuanKS',
							'penerima' 		=> $getdata->nipkepalasekolah,
							'id_sekolah' 	=> Session('sekolah_id_sekolah')
						],
						[
							'tabel' 			=> 'db_rapotan',
							'perihal' 			=> 'Tandatangan Rapot Semester '.$semester.' / '.$tapel.' an. '.$getdata->nama.' Kelas '.$getdata->kelas,
							'pengirim' 			=> Session('nama'),
							'jenis' 			=> 'TTE',
							'urlsurat'			=> $namafile,
							'status'			=> 1
						]
					);
					$tuliskirim	= '<a href="'.$namafile.'" target="_blank">Tandatangan Rapot</a>';
					$keterangan	= '<p>Yth. '.$nama.'</p><p>Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :</p><p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p><p>'.$tuliskirim.'</p><p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih</p>';
					$getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $getdata->nipkepalasekolah)->first();
					if (isset($getuser->id)){
						Notification::send($getuser, new NewMessageNotification($tuliskirim));
						SendMail::notif($nama,$getuser->email,'Tandatangan Rapot',$keterangan);
					}
					$tuliskirim 			= 'Permohonan TTE Rapot';
					SendMail::mobilenotif($niy,'perseorangan',$nama,$tuliskirim);
					$i = 1;
					$getperingkat = Rapotan::where('kelas', $getdata->kelas)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('ratarata', 'DESC')->get();
					if (!empty($getperingkat)){
						foreach($getperingkat as $rows){
							Rapotan::where('id', $rows->id)->update([
								'rangking'	=> $i
							]);
							$i++;
						}
					}
				}
				
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Telah Kami Kirim kan Ke Kepala Sekolah Untuk di Tandatangani, Dengan Catatan : Data Siswa Akan Otomatis Berpindah ke Kelas Berikutnya (bila naik kelas) apabila Kepala Sekolah Sudah Tandatangan']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Pengiriman Gagal, Coba Refresh laman Ini Sebelum Memulai Kembali']);
				return back();
			}
		} else if($idne == 'editorrapotfisik') {
			$nama 			= $request->nama;
			$noinduk 		= $request->noinduk;
			$tapel 			= $request->tapel;
			$update 		= Rapotan::where('noinduk', $noinduk)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
				'tbs1'			=> $request->tbs1,
				'bbs1'			=> $request->bbs1,
				'tbs2'			=> $request->tbs2,
				'bbs2'			=> $request->bbs2,
				'pendengaran'	=> $request->pendengaran,
				'penglihatan'	=> $request->penglihatan,
				'gigi'			=> $request->gigi,
				'kesehatanlain'	=> $request->kesehatanlain,
				'updated_at'	=> date('Y-m-d H:i:s')
			]);
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Fisik an '.$nama.' TAPEL '.$tapel.' Berhasil di Perbaharui']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Pengiriman Gagal, Coba Refresh laman Ini Sebelum Memulai Kembali']);
				return back();
			}
		} else {
			if ($kopsurat == '' OR $kopsurat == null){
				$kopsurat 			= '<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="3" rowspan="7" align="center" valign="middle" style="border-bottom:double"><img src="'.$homebase.'/'.$logo.'" width="75" /></td>
											<td colspan="8"><b>'.$yayasan.'</b></td>
										</tr>
										<tr><td colspan="8"><b>'.$sekolah.'</b></td></tr>
										<tr><td colspan="8"><b>'.$akreditasi.'</b></td></tr>
										<tr><td colspan="8">'.$nis.'</td></tr>
										<tr><td colspan="8">'.$alamat.'</td></tr>
										<tr><td colspan="8">'.$email.'</td></tr>
										<tr>
											<td width="157" style="border-bottom:double">&nbsp;</td>
											<td width="26" style="border-bottom:double">&nbsp;</td>
											<td width="87" style="border-bottom:double">&nbsp;</td>
											<td width="22" style="border-bottom:double">&nbsp;</td>
											<td width="25" style="border-bottom:double">&nbsp;</td>
											<td width="198" style="border-bottom:double">&nbsp;</td>
											<td width="39" style="border-bottom:double">&nbsp;</td>
											<td width="129" style="border-bottom:double">&nbsp;</td>
										</tr>
									</table>';
			} else {
				$kopsurat			= $homebase.'/'.$kopsurat;
			}
			$rmaster = Datainduk::where('noinduk', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rmaster->nama)){
				$nama 			= $rmaster->nama;
				$noinduk		= $rmaster->noinduk;
				$nisn 			= $rmaster->nisn;
				$kelamin		= $rmaster->kelamin;
				$tmplahir 		= $rmaster->tmplahir;
				$tgllahir 		= $rmaster->tgllahir;
				$alamatortu		= $rmaster->alamatortu;
				$namaayah 		= $rmaster->namaayah;
				$namaibu		= $rmaster->namaibu;
				$kerjaayah		= $rmaster->kerjaayah;
				$kerjaibu		= $rmaster->kerjaibu;
				$wali			= $rmaster->wali;
				$pekerjaanwali	= $rmaster->pekerjaanwali;
				$foto			= $rmaster->foto;
				$tamasuk		= $rmaster->tamasuk;
				$hape			= $rmaster->hape;
				$asal			= $rmaster->asal;
				$mutasi			= $rmaster->mutasi;
				$kelurahan		= $rmaster->kelurahan;
				$kecamatan		= $rmaster->kecamatan;
				$kota			= $rmaster->kota;
				$kodepos		= $rmaster->kodepos;
				$telpon			= $rmaster->telpon;
				$erte			= $rmaster->erte;
				$erwe			= $rmaster->erwe;
				if ($foto == '' OR $foto == null){
					$foto	= '<img src="'.$homebase.'/boxed-bg.jpg" width="100%">';
				} else {
					if (File::exists(base_path() ."/public/dist/img/foto/". $foto)) {
						$foto	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" width="100%">';
					} else {
						$foto	= '<img src="'.$homebase.'/boxed-bg.jpg" width="100%">';
					}
				}
				$generatetbl	= '<table width="822" cellpadding="0" cellspacing="0">
									<tr><td width="31">&nbsp;</td><td width="39">&nbsp;</td><td width="153">&nbsp;</td><td width="34">&nbsp;</td><td width="24">&nbsp;</td><td width="264">&nbsp;</td><td width="41">&nbsp;</td><td width="64">&nbsp;</td><td width="36">&nbsp;</td><td width="53">&nbsp;</td><td width="81">&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr><td colspan="11">&nbsp;</td></tr>
									<tr><td colspan="11">&nbsp;</td></tr>
									<tr><td colspan="11">&nbsp;</td></tr>
									<tr><td colspan="11">&nbsp;</td></tr>
									<tr><td colspan="11" align="center"><strong><u>IDENTITAS PESERTA DIDIK</u></strong></td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">1</td>
										<td colspan="2">Nama Peserta Didik</td>
										<td>:</td>
										<td colspan="6">'.$nama.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">2</td>
										<td colspan="2">NISN / NIS</td>
										<td>:</td>
										<td>'.$noinduk.'</td>
										<td>/</td>
										<td colspan="4">'.$nisn.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">3</td>
										<td colspan="2">Tempat, Tanggal Lahir</td>
										<td>:</td>
										<td colspan="6">'.$tmplahir.', '.$tgllahir.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">4</td>
										<td colspan="2">Jenis Kelamin</td>
										<td>:</td>
										<td colspan="6">'.$kelamin.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">5</td>
										<td colspan="2">Agama</td>
										<td>:</td>
										<td colspan="6">Islam</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">6</td>
										<td colspan="2">Pendidikan Sebelumnya</td>
										<td>:</td>
										<td colspan="6">'.$asal.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">7</td>
										<td colspan="2">Alamat Peserta Didik </td>
										<td>:</td>
										<td colspan="6">'.$alamatortu.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">8</td>
										<td colspan="9">Nama Orang Tua</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="2">a. Ayah</td>
										<td>:</td>
										<td colspan="6">'.$namaayah.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="2">b. Ibu</td>
										<td>:</td>
										<td colspan="6">'.$namaibu.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">9</td>
										<td colspan="9">Pekerjaan Orang Tua</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>a. Ayah</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td colspan="6">'.$kerjaayah.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>b. Ibu</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td colspan="6">'.$kerjaibu.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">10</td>
										<td colspan="9">Alamat Orang Tua </td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>Jalan</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td>'.$alamatortu.'</td>
										<td>RT</td>
										<td>'.$erte.'</td>
										<td>RW</td>
										<td colspan="2">'.$erwe.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>Kelurahan/ Desa</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td colspan="6">'.$kelurahan.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="2">Kecamatan/ Kota</td>
										<td>:</td>
										<td colspan="6">'.$kecamatan.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>Kabupaten/Kota</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td colspan="6">'.$kota.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">11</td>
										<td colspan="9">Wali Peserta Didik </td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>a. Nama</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td colspan="6">'.$wali.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>b. Pekerjaan</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td colspan="6">'.$pekerjaanwali.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>c. Alamat</td>
										<td>&nbsp;</td>
										<td>:</td>
										<td colspan="6">'.$alamatortu.'</td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td rowspan="7" width="153">'.$foto.'</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td colspan="5" align="center">'.$kota.', '.$tanggalctk.'</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td colspan="5" align="center">KEPALA SEKOLAH</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr><td height="97">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td colspan="5" align="center" valign="bottom"><b><u>'.$kepalasekolah.'</u></b><br />NIY. '.$niykasek.'</td></tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td colspan="5" align="center" valign="bottom">&nbsp;</td></tr>
								</table>';
				$tasks['generatetbl']	= $generatetbl;
				return view('cetak.biodatarapot', $tasks);
			} else {
				$data['kalimatheader']  = 'Mohon Maaf';
				$data['kalimatbody']  	= 'Nomor Induk '.$idne.' Tidak ditemukan, periksa kembali data Bapak/Ibu';
				return view('errors.notready', $data);
			}
		}
	}
	public function jsonDatanilaikelas(Request $request) {
		$set01 		= $request->val01;
		$set02 		= $request->val02;
		$set03 		= $request->val03;
		$set04 		= $request->val04;
		$set05 		= $request->val05;
		$datakelas	= [];
		$sql 		= Datainduk::where('klspos', $set01)->where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil) {
				$datakelas[] = array(
					'id' 		=> $hasil->id,	
					'nama' 		=> $hasil->nama,		
					'noinduk' 	=> $hasil->noinduk,
					'kelas'		=> $hasil->klspos,			
					'tanggal'	=> date("Y-m-d h:s:m"),
					'tapel'		=> $set03,
					'jenis'		=> 'ULANGAN/TUGAS/PAT/PAS',
					'semester'	=> $set05,
					'kodekd'	=> '',
					'tema'		=> '',
					'subtema'	=> '',
					'matpel'	=> $set02,
					'nilai'		=> '',
					'niyguru'	=> 'NIY. '.$set04,
				);
			}
		}
		echo json_encode($datakelas);
	}
	public function jsonDataabsenkelas(Request $request) {
		$kelas 		= $request->val01;
		$tapel 		= $request->val02;
		$arrpresensi= [];
		$homebase	= url("/");
		if ($kelas == 'all'){
			$sql 		= Datainduk::where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('noinduk', 'ASC')->get();
		} else {
			if ($tapel == 'persiswa'){
				$gettapel	= Datapresensi::where('tapel', '!=', '')->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($gettapel->tapel)){
					$tapel 	= $gettapel->tapel; 
				} else {
					$tahun 	= date('Y');
					$thns	= $tahun - 1;
					$tapel 	= $thns.'-'.$tahun;
				}
				$sql 		= Datainduk::where('noinduk',  $kelas)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			} else {
				$sql 		= Datainduk::where('klspos',  $kelas)->where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('noinduk', 'ASC')->get();
			}
		}
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$nama 		= $hasil->nama;
				$noinduk 	= $hasil->noinduk;
				$kelas 		= $hasil->klspos;
				$masuk		= '';
				$ijin		= '';
				$alpha		= '';
				$sakit		= '';
				$foto 		= $hasil->foto;
				if ($foto == '' OR $foto == null){
					$lampiran	= '<img src="'.$homebase.'/'.Session('sekolah_logo').'" height="35">';
				} else {
					if (File::exists(base_path() ."/public/dist/img/foto/". $foto)) {
						$lampiran	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="35">';
					} else {
						$lampiran	= '<img src="'.$homebase.'/'.Session('sekolah_logo').'" height="35">';
					}
				}
				if ($request->val02 == 'persiswa'){
					$masuk 		= Datapresensi::where('noinduk', $noinduk)->where('status', '1')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$ijin 		= Datapresensi::where('noinduk', $noinduk)->where('status', '2')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$sakit 		= Datapresensi::where('noinduk', $noinduk)->where('status', '3')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$alpha 		= Datapresensi::where('noinduk', $noinduk)->where('status', '0')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				} else {
					$masuk 		= Datapresensi::where('tapel', $tapel)->where('noinduk', $noinduk)->where('status', '1')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$ijin 		= Datapresensi::where('tapel', $tapel)->where('noinduk', $noinduk)->where('status', '2')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$sakit 		= Datapresensi::where('tapel', $tapel)->where('noinduk', $noinduk)->where('status', '3')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					$alpha 		= Datapresensi::where('tapel', $tapel)->where('noinduk', $noinduk)->where('status', '0')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				}
				$arrpresensi[] = array(
					'id' 		=> $hasil->id,
					'nama' 		=> $hasil->nama,
					'jilid' 	=> $hasil->jilid,
					'noinduk' 	=> $noinduk,
					'kelas'		=> $kelas,
					'masuk'		=> $masuk,
					'ijin'		=> $ijin,
					'alpha'		=> $alpha,
					'sakit'		=> $sakit,
					'foto'		=> $lampiran,
					'tapel'		=> $tapel,
				);
			}
		}
		echo json_encode($arrpresensi);
	}
	public function jsonPresensicari(Request $request) {
		$noinduk 		= $request->val01;
		$tapel 			= $request->val02;
		$jennilai 		= $request->val03;
		$arrpresensi	= [];
		$homebase		= url("/");
		if ($tapel == 'persiswa'){
			$sql 			= null;
			$arrpresensi 	= DB::table('db_presensi')
							->select('db_presensi.*', 'db_datainduk.nama', 'db_datainduk.foto')
							->leftJoin('db_datainduk', 'db_presensi.noinduk', 'db_datainduk.noinduk')
							->where('db_presensi.noinduk', $noinduk)
							->where('db_presensi.id_sekolah', Session('sekolah_id_sekolah'))
							->orderBy('db_presensi.tanggal', 'ASC')
							->get();
			return response()->json($arrpresensi);
				
		} else if ($tapel == 'exportpresensifinger'){
			$sql 		= null;
			$arrpresensi= Presensifinger::where('nip', '!=', '')->where('departemen', $request->val01)->where('kantor', $request->val03)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('tanggal', 'ASC')->orderBy('pin', 'ASC')->get();
			echo json_encode($arrpresensi);

		} else if ($tapel == 'detailmateripersiswa'){
			$sql 		= null;
			$jsonlisttgl= DB::table('db_presensi')
							->select('db_presensi.*', 'db_datainduk.nama', 'db_datainduk.foto')
							->leftJoin('db_datainduk', 'db_presensi.noinduk', 'db_datainduk.noinduk')
							->where('db_presensi.noinduk', $request->val03)
							->where('db_presensi.tanggal', $request->val01)
							->where('db_presensi.id_sekolah', Session('sekolah_id_sekolah'))
							->orderBy('db_presensi.tanggal', 'ASC')
							->get();
			if (!empty($jsonlisttgl)){
				foreach ($jsonlisttgl as $hasil){
					$noinduk	= $hasil->noinduk;
					$status		= $hasil->status;
					$tanggal	= $hasil->tanggal;
					$foto 		= $hasil->foto;
					if ($foto == '' OR $foto == null){
						$foto	= '<img src="'.$homebase.'/'.Session('sekolah_logo').'" width="100%">';
					} else {
						$foto	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" width="100%">';
					}
					$cekmateri = DB::table('jadwal_realisasi')->where('tanggal', $hasil->tanggal)->where('kelas', $hasil->kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('mulai', 'ASC')->get();
					if (!empty($cekmateri)){
						foreach ($cekmateri as $rmateri){
							$arrpresensi[] = array(
								'id'			=> $rmateri->id,
								'tanggal'		=> $hasil->tanggal,
								'nama'			=> $hasil->nama, 
								'foto'			=> $foto,
								'noinduk'		=> $hasil->noinduk,
								'tapel'			=> $hasil->tapel,
								'kelas'			=> $hasil->kelas, 
								'status'		=> $hasil->status,
								'matapelajaran'	=> $rmateri->matapelajaran,
								'ruang'			=> $rmateri->ruang,
								'jammulai'		=> $rmateri->jammulai,
								'jamakhir'		=> $rmateri->jamakhir,
								'guruyanghadir'	=> $rmateri->guruyanghadir,
								'materi'		=> $rmateri->materi,
							);
						}
					}
				}
			}
			echo json_encode($arrpresensi);

		} else if ($tapel == 'detailmateriperid'){
			$sql 		= null;
			$gettanggal = DB::table('db_presensi')->where('id', $request->val01)->first();
			if (isset($gettanggal->id)){
				$jsonlisttgl= DB::table('db_presensi')
					->select('db_presensi.*', 'db_datainduk.nama', 'db_datainduk.foto')
					->leftJoin('db_datainduk', 'db_presensi.noinduk', 'db_datainduk.noinduk')
					->where('db_presensi.noinduk', $gettanggal->noinduk)
					->where('db_presensi.tanggal', $gettanggal->tanggal)
					->where('db_presensi.id_sekolah', $gettanggal->id_sekolah)
					->orderBy('db_presensi.tanggal', 'ASC')
					->get();
				if (!empty($jsonlisttgl)){
					foreach ($jsonlisttgl as $hasil){
						$noinduk	= $hasil->noinduk;
						$status		= $hasil->status;
						$tanggal	= $hasil->tanggal;
						
						$cekmateri= DB::table('jadwal_realisasi')
									->select('jadwal_realisasi.*', 'db_allstaf.foto')
									->leftJoin('db_allstaf', 'jadwal_realisasi.niyguru', 'db_allstaf.niy')
									->where('jadwal_realisasi.kelas', $hasil->kelas)
									->where('jadwal_realisasi.tanggal', $hasil->tanggal)
									->where('jadwal_realisasi.id_sekolah', $hasil->id_sekolah)
									->orderBy('jadwal_realisasi.mulai', 'ASC')
									->get();
						if (!empty($cekmateri)){
							foreach ($cekmateri as $rmateri){
								$foto 		= $rmateri->foto;
								if ($foto == '' OR is_null($foto)){
									$foto = '<img src="'.$homebase.'/dist/img/takadagambar.png" alt="image" class="direct-chat-img">';
								} else {
									$foto = '<img src="'.url("/").'/dist/img/foto/'.$foto.'" alt="image" class="direct-chat-img">';
								}
								$arrpresensi[] = array(
									'id'			=> $rmateri->id,
									'tanggal'		=> $hasil->tanggal,
									'nama'			=> $hasil->nama, 
									'foto'			=> $foto,
									'noinduk'		=> $hasil->noinduk,
									'tapel'			=> $hasil->tapel,
									'kelas'			=> $hasil->kelas, 
									'status'		=> $hasil->status,
									'matapelajaran'	=> $rmateri->matapelajaran,
									'ruang'			=> $rmateri->ruang,
									'jammulai'		=> $rmateri->jammulai,
									'jamakhir'		=> $rmateri->jamakhir,
									'guruyanghadir'	=> $rmateri->guruyanghadir,
									'materi'		=> $rmateri->materi,
								);
							}
						}
					}
				}
			}
			return response()->json($arrpresensi);
		} else if ($tapel == 'pertanggalinput'){
			$datacari 	= Loginputnilai::where('id', $noinduk)->first();
			if (isset($datacari->id)){
				$sql 	= DB::table('db_presensi')
							->select('db_presensi.*', 'db_datainduk.nama', 'db_datainduk.foto')
							->leftJoin('db_datainduk', 'db_presensi.noinduk', 'db_datainduk.noinduk')
							->where('db_presensi.tanggal', $datacari->tanggal)
							->where('db_presensi.kelas', $datacari->kelas)
							->where('db_presensi.petugas', $datacari->niy)
							->where('db_presensi.id_sekolah', Session('sekolah_id_sekolah'))
							->orderBy('db_presensi.tanggal', 'ASC')
							->get();
			} else {
				$sql 	= null;
			}
		} else if ($tapel == 'pertanggalrapot'){
			$sql 		= null;
			$datacari 	= Loginputnilai::where('id', $noinduk)->first();
			if (isset($datacari->id)){
				if ($jennilai == 'Biodata Rapot'){
					$arrpresensi 	= Rapotan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapel', $datacari->tapel)->where('kelas', $datacari->kelas)->groupBy('noinduk')->orderBy('noinduk', 'ASC')->get();
				} else {
					if (Session('sekolah_level') != 1){
						$arrpresensi 	= Rapotan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nipguru', $datacari->niy)->where('tapel', $datacari->tapel)->where('kelas', $datacari->kelas)->where('semester', $datacari->semester)->orderBy('rangking', 'ASC')->get();
					} else {
						$arrpresensi 	= Rapotan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nipguru', $datacari->niy)->where('tapel', $datacari->tapel)->where('semester', $datacari->semester)->orderBy('rangking', 'ASC')->get();
					}
				}
			}
			echo json_encode($arrpresensi);
		} else if ($tapel == 'pertapelsemesterrapot'){
			$sql 		= null;
			$arrpresensi= Rapotan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapel', $request->val01)->where('semester', 'LIKE', $request->val03.'%')->whereNotNull('namakepalasekolah')->whereNotNull('nama')->orderBy('rangking', 'ASC')->get();
			echo json_encode($arrpresensi);
		} else {
			$sql 	= DB::table('db_presensi')
							->select('db_presensi.*', 'db_datainduk.nama', 'db_datainduk.foto')
							->leftJoin('db_datainduk', 'db_presensi.noinduk', 'db_datainduk.noinduk')
							->where('db_presensi.tapel', $tapel)
							->where('db_presensi.noinduk', $noinduk)
							->where('db_presensi.id_sekolah', Session('sekolah_id_sekolah'))
							->orderBy('db_presensi.tanggal', 'ASC')
							->get();
		}
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$noinduk	= $hasil->noinduk;
				$status		= $hasil->status;
				$alasan		= $hasil->alasan;
				$foto 		= $hasil->foto;
				
				if ($foto == '' OR $foto == null){
					$fotolink	= $homebase.'/'.Session('sekolah_logo');
					$foto		= '<img src="'.$homebase.'/'.Session('sekolah_logo').'" width="100%">';
				} else {
					$fotolink	= $homebase.'/dist/img/foto/'.$foto;
					$foto		= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" width="100%">';
				}
				if ($alasan == ''){
					if ($status == '1'){
						$alasan = 'HADIR';
					} else if ($status == '2'){
						$alasan = 'IJIN';
					} else if ($status == '3'){
						$alasan = 'SAKIT';
					} else if ($status == '5'){
						$alasan = 'HADIR TERLAMBAT';
					} else {
						$alasan = 'ALPHA';
					}
				}
				$arrpresensi[] = array(
					'id'		=> $hasil->id,
					'tanggal'	=> $hasil->tanggal,
					'nama'		=> $hasil->nama, 
					'foto'		=> $foto,
					'noinduk'	=> $hasil->noinduk, 
					'tapel'		=> $hasil->tapel, 
					'kelas'		=> $hasil->kelas, 
					'status'	=> $hasil->status,
					'fotolink'	=> $fotolink,
					'alasan'	=> $alasan, 
					'selama'	=> $hasil->selama, 
					'surat'		=> $hasil->surat, 
					'inputor'	=> $hasil->petugas, 
					'marking'	=> $hasil->marking
				);
			}
			echo json_encode($arrpresensi);
		}
		
	}
	public function jsonRincianekskul(Request $request) {
		$arrlisteks	= [];
		$idne 		= $request->val01;
		$getnama	= Ekstrakulikuler::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		$i 			= 1;
		if (isset($getnama->nama)){
			$set01 	= $getnama->nama;
			$sql 	= DB::table('db_setkeuangan')
							->join('db_datainduk', 'db_setkeuangan.noinduk', 'db_datainduk.noinduk')
							->where('db_datainduk.id_sekolah', session('sekolah_id_sekolah'))
							->where('db_datainduk.nokelulusan', '')
							->where(function ($query) use ($set01) {
							$query->where('db_setkeuangan.eksul1', $set01)
								->orWhere('db_setkeuangan.eksul2', $set01)
								->orWhere('db_setkeuangan.eksul3', $set01)
								->orWhere('db_setkeuangan.eksul4', $set01)
								->orWhere('db_setkeuangan.eksul5', $set01);
						})->get();
			if (!empty($sql)){
				foreach ($sql as $hasil){
					$arrlisteks[] = array(
						'id' 		=> $hasil->id,
						'no'		=> $i,
						'nama'		=> $hasil->nama,
						'noinduk'	=> $hasil->noinduk,
						'kelas'		=> $hasil->klspos,
					);
					$i++;
				}
			}
		}
		echo json_encode($arrlisteks);
	}
	public function jsonPresensi() {
		$arrpresensi	= [];
		$getlogpresensi	= Datapresensi::where('tapel', '')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($getlogpresensi)){
			foreach ($getlogpresensi as $hasil) {
				$alasan 	= '';
				$status 	= $hasil->status;
				$noinduk 	= $hasil->noinduk;
				$idsekul 	= $hasil->id_sekolah;
				$getnama 	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah', $idsekul)->first();
				if (isset($getnama->nama)){
					$nama 	= $getnama->nama;
				} else {
					$nama	= '';
				}
				if ($status == '2'){ $alasan = 'Ijin'; }
				if ($status == '3'){ $alasan = 'Sakit'; }
				
				$arrpresensi[] = array(
					'id' 			=> $hasil->id,	
					'nama' 			=> $nama,	
					'noinduk' 		=> $noinduk,			
					'tanggal'		=> $hasil->tanggal,
					'alasan'		=> $alasan,
					'tapel'			=> $hasil->tapel,
					'kelas'			=> $hasil->kelas,
					'status'		=> $hasil->status,
					'alasan'		=> $hasil->alasan,
					'selama'		=> $hasil->selama,
					'surat'			=> $hasil->surat,
					'inputor'		=> $hasil->petugas,
				);
			}
		}		
		echo json_encode($arrpresensi);
	}
	public function jsonDatakkm(Request $request) {
		$arrlistkkm	= [];
		$kelas		= $request->val01;
		if ($kelas == 'groupbytema'){
			$i 		= 0;
			$sql 	= Datakd::where('kelas', $request->val02)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('muatan')->select('kelas','muatan')->get();
			if (!empty($sql)){
				foreach ($sql as $hasil){
					$muatan = $hasil->muatan;
					$kelas 	= $hasil->kelas;
					$getkkm = Datakd::where('muatan', $hasil->muatan)->where('kelas', $hasil->kelas)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('tema')->get();
					foreach ($getkkm as $rows){
						$arrlistkkm[$i] = $rows;
						$i++;
					}
				}
			}
		} else {
			$arrlistkkm = Datakkm::where('kelas', $kelas)->where('id_sekolah',session('sekolah_id_sekolah'))->select('id as idne', 'kelas', 'matpel', 'muatan', 'kitiga', 'kiempat', 'jenis')->get();
		}
		echo json_encode($arrlistkkm);
	}
	public function exDatakkm(Request $request) {
		$kelas 		= $request->val01;
		$matpel 	= $request->val02;
		$muatan 	= $request->val03;
		$kie3 		= $request->val04;
		$kie4 		= $request->val05;
		$idne 		= $request->val06;
		$error		= '';
		$sukses 	= '';
		$muatan		= preg_replace('/\s/', '', $muatan);
		$muatan		= str_replace('/', '', $muatan);
		$muatan		= str_replace('.','',$muatan);
		if($kelas == ''){
			$error = $error.'Mohon Klik Dulu Kelas Yang ada di Samping';
		} else if($matpel == '' and $muatan == '' and $kie3 == '' and $kie4 == '' and $idne == ''){
			$error = $error.'Data Mohon di isi dengan lengkap';
		} else {
			if ($idne == 'baru'){
				$cekmasuk = Datakkm::where('kelas', $kelas)->where('muatan', $muatan)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekmasuk == 0){
					$kerja 	= Datakkm::create([
						'kelas'		=> $kelas, 
						'matpel'	=> $matpel,
						'muatan'	=> $muatan,
						'kitiga'	=> $kie3,
						'kiempat'	=> $kie4,
						'jenis'		=> $request->val07,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					if ($kerja){
						$sukses = $sukses.'Data KKM Kelas '.$kelas.' Mata Pelajaran '.$matpel.' Berhasil di Input';
					} else {
						$error = $error.'Sistem Error, Silahkan Coba Beberapa Saat Lagi';
					}
				} else {
					$error = $error.'Data '.$muatan.' Telah Ada';
				}
			} else if ($idne == 'updatetemplate'){
				$update = Datakd::where('kelas', $kelas)->where('muatan', $muatan)->where('tema', $request->val10)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'template01'	=> $request->val04,
					'template02'	=> $request->val05,
					'template03'	=> $request->val07,
					'template04'	=> $request->val08,
					'template05'	=> $request->val09,
				]);
				if ($update){
					$sukses = $sukses.'Data KKM Kelas '.$kelas.' Muatan '.$muatan.' Tema '.$request->val10.' Berhasil di Update';
				} else {
					$error = $error.'Gagal Ubah Template, Silahkan Coba Periksa Isian Bapak/Ibu';
				}
			} else {
				$kerja 	= Datakkm::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'matpel'	=> $matpel,
					'muatan'	=> $muatan,
					'kitiga'	=> $kie3,
					'kiempat'	=> $kie4,
					'jenis'		=> $request->val07,
				]);
				if ($kerja){
					$sukses = $sukses.'Data KKM Kelas '.$kelas.' Mata Pelajaran '.$matpel.' Berhasil di UPDATE';
				} else {
					$error = $error.'Sistem Error, Silahkan Coba Beberapa Saat Lagi';
				}
			}
		}
		if ($error == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
		}
	}
	public function exUploaddatakkm(Request $request) {
		$sukses			= 0;
		$error			= '';
		$barispertama	= '';
		$aksi			= $request->set_aksi;
		if ($aksi == '1'){
			Datakkm::truncate();
			Logstaff::create([
				'jenis'		=> 'Perubahan Nilai',
				'sopo'		=> Session('nip'),
				'kelakuan'	=> Session('nama').' Mereset Data KKM pada '.date("Y-m-d H:i"),
			]);
		}
    	if ($request->hasFile('sheeta')) {
    		$path 			= $_FILES['sheeta']['tmp_name'];
			$tanggal		= date("Y-m-d h:s:m");
			$tanggalmark	= date("Y-m-d");
			$guru 			= Session('nama');
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				if ($barispertama != ''){
					$kelas			= $val['A'];
					$matpel			= $val['B'];
					$muatan			= $val['C'];
					$kitiga			= $val['D'];
					$kiempat		= $val['E'];
					if (is_null($kitiga)){ $kitiga = 0; }
					if ($kitiga == ''){ $kitiga = 0; }
					if (is_null($kiempat)){ $kiempat = 0; }
					if ($kiempat == ''){ $kiempat = 0; }
					$input 	= Datakkm::create([
						'kelas'		=> $kelas,
						'matpel'	=> $matpel,
						'muatan'	=> $muatan,
						'kitiga'	=> $kitiga,
						'kiempat'	=> $kiempat,
					]);
					if ($input){
						$sukses++;
					} else {
						$error = $error.'Gagal Tambah Muatan '.$muatan.' Kelas '.$kelas.'<br />';
					}
				} else {
					$barispertama = 'skip';
				}
			}
			$sukses = $sukses.Session('nama').' Upload Data KKM berhasil sejumlah '.$sukses.' Pada : '.date("Y-m-d H:i");
			Logstaff::create([
				'jenis'		=> 'Perubahan Nilai',
				'sopo'		=> Session('nip'),
				'kelakuan'	=> $sukses,
			]);
		} else {
    		$error = 'File tidak terdeteksi';
    	}
		if ($aksi == '1'){
			$sukses = $sukses.'<br />'.Session('nama').' Mereset Data KKM pada '.date("Y-m-d H:i");
		}
		if ($error == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
		}
    }
	public function jsonGenrapot(Request $request) {
		$KELAS 		= $request->val01;
		$TAPEL 		= $request->val02;
		$JENIS 		= $request->val03;
		$SEMESTER 	= $request->val04;
		$idwalas 	= $request->val05;
		$tanggal 	= $request->val06;
		$kerja 		= $request->val07;
		$sekolah	= Session('sekolah_id_sekolah');
		$datakelas	= [];
		if ($SEMESTER == '1 (GANJIL)'){
			$valsmt		= 1;
			$markingguru	= $TAPEL.'-'.$SEMESTER.'-'.$KELAS.'-'.Session('nip').'-'.$JENIS.'-1-';
		} else {
			$valsmt		= 2;
			$markingguru	= $TAPEL.'-'.$SEMESTER.'-'.$KELAS.'-'.Session('nip').'-'.$JENIS.'-2-';
		}
		$getguru 	= Dataindukstaff::where('id', $idwalas)->first();
		if (isset($getguru->nama)){
			$GURUKLS = $getguru->nama;
			$NIPGURU = $getguru->niy;
			$statpeg = $getguru->statpeg;
			if ($statpeg == 'PNS'){
				$NIPGURU = 'NIP. '.$NIPGURU;
			} else { $NIPGURU = 'NIY. '.$NIPGURU; }
		} else {
			$GURUKLS = '';
			$NIPGURU = '';
		}
		$rsetting	= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$NAMASD 	= $rsetting->nama_sekolah;
		$ALAMAT 	= $rsetting->alamat;
		if (isset($rsetting->kepala_sekolah->nama)){
			$KASEK 	= $rsetting->kepala_sekolah->nama;
			$statpeg= $rsetting->kepala_sekolah->statpeg;
		} else {
			$KASEK	= '';
			$statpeg= '';
		}
		$NIPGURU 	= $rsetting->kepala_sekolah;
		
		if ($statpeg == 'PNS'){
			$NIPKASEK = 'NIP. '.$NIPGURU;
		} else { $NIPKASEK = 'NIY. '.$NIPGURU; }
		$NOMOR 	= 1;
		if ($kerja == 'baru'){
			$cekdata 	= Rapotan::where('marking', 'LIKE', $markingguru.'%')->count();
			if ($cekdata == 0){
				$sql 	= DB::table('db_datainduk')
							->join('db_setkeuangan', 'db_datainduk.noinduk', 'db_setkeuangan.noinduk')
							->where('db_datainduk.klspos', $KELAS)
							->where('db_datainduk.nokelulusan', '')
							->select('db_datainduk.*', 'db_setkeuangan.eksul1', 'db_setkeuangan.eksul2', 'db_setkeuangan.eksul3', 'db_setkeuangan.eksul4', 'db_setkeuangan.eksul5')
							->orderBy('db_datainduk.noinduk', 'ASC')
							->get();
				if (!empty($sql)){
					foreach ($sql as $hasil) {
						$NAMA 		= $hasil->nama;
						$NISN 		= $hasil->nisn;
						$noinduk 	= $hasil->noinduk;
						$namaayah 	= $hasil->namaayah;
						$namaibu 	= $hasil->namaibu;
						$hape 		= $hasil->hape;
						$eksul1 	= $hasil->eksul1;
						$eksul2 	= $hasil->eksul2;
						$eksul3 	= $hasil->eksul3;
						$eksul4 	= $hasil->eksul4;
						$eksul5 	= $hasil->eksul5;
						$NISN		= $NISN.' / '.$noinduk;
						$marking	= $markingguru.$noinduk;
						$SSP		= '';
						$DES		= '';
						$SS			= '';
						$DES2		= '';
						$PAI3		= '';
						$H			= '';
						$D			= '';
						$PAI4		= '';
						$H2			= '';
						$D2			= '';
						$PPKN3		= '';
						$H3			= '';
						$D3			= '';
						$PPKN4		= '';
						$H4			= '';
						$D4			= '';
						$BI3		= '';
						$H5			= '';
						$D5			= '';
						$BI4		= '';
						$H6			= '';
						$D6			= '';
						$MAT3		= '';
						$MAT4		= '';
						$PAI3		= '';
						$H7			= '';
						$D7			= '';
						$MAT4		= '';
						$H8			= '';
						$D8			= '';
						$IPA3		= '';
						$H9			= '';
						$D9			= '';
						$IPA4		= '';
						$H10		= '';
						$D10		= '';
						$IPS3		= '';
						$H11		= '';
						$D11		= '';
						$IPS4		= '';
						$H12		= '';
						$D12		= '';
						$SBDP3		= '';
						$H13		= '';
						$D13		= '';
						$SBDP4		= '';
						$H14		= '';
						$D14		= '';
						$PJOK3		= '';
						$H15		= '';
						$D15		= '';
						$PJOK4		= '';
						$H16		= '';
						$D16		= '';
						$BJ3		= '';
						$H17		= '';
						$D17		= '';
						$BJ4		= '';
						$H18		= '';
						$D18		= '';
						$BING3		= '';
						$H19		= '';
						$D19		= '';
						$BING4		= '';
						$H20		= '';
						$D20		= '';
						$BA3		= '';
						$H21		= '';
						$D21		= '';
						$BA4		= '';
						$H22		= '';
						$D22		= '';
						$TIK3		= '';
						$H23		= '';
						$D23		= '';
						$TIK4		= '';
						$H24		= '';
						$D24		= '';
						$EKS 		= $eksul1;
						$K			= '';
						$EKS2		= $eksul2;
						$K2			= '';
						$EKS3		= $eksul3;
						$K3			= '';
						$EKS4		= $eksul4;
						$K4			= '';
						$EKS5		= $eksul5;
						$K5			= '';
						$SARAN		= '';
						$TBS1		= '';
						$TBS2		= '';
						$BBS1		= '';
						$BBS2		= '';
						$KETPD		= '';
						$KETPL		= '';
						$KETGG		= '';
						$KETL		= '';
						$PRETASI1	= '';
						$KET		= '';
						$PRETASI2	= '';
						$KET2		= '';
						$PRETASI3	= '';
						$KET3		= '';
						$PRETASI4	= '';
						$KET4		= '';
						$IZIN 		= Datapresensi::where('noinduk', $noinduk)->where('status', '2')->count();
						$SAKIT 		= Datapresensi::where('noinduk', $noinduk)->where('status', '3')->count();
						$TANPA 		= Datapresensi::where('noinduk', $noinduk)->where('status', '0')->count();
						$KEPUTUSAN	= '';
						$NAIK		= '';
						$totnil34	= 0;
						$jumlah34	= 0;
						$rata34		= 0;
						$rangking	= 0;
						$getlognilai= Datanilai::where('noinduk', $noinduk)
											->where('tapel', $TAPEL)
											->where('semester', $valsmt)
											->groupBy('matpel')
											->get();
						if (!empty($getlognilai)){
							foreach ($getlognilai as $rjeneng) {
								$matpel 	= $rjeneng->matpel;
								$nilai 		= $rjeneng->nilai;
								$jennilai 	= $rjeneng->jennilai;
								
								if ($matpel == 'Tinggi Badan Smt 1'){ $TBS1 = $nilai; }
								else if ($matpel == 'Tinggi Badan Smt 2'){ $TBS2 = $nilai; }
								else if ($matpel == 'Berat Badan Smt 1'){ $BBS1 = $nilai; }
								else if ($matpel == 'Berat Badan Smt 2'){ $BBS2 = $nilai; }
								else if ($matpel == 'Pendengaran'){ $KETPD = $nilai; }
								else if ($matpel == 'Penglihatan'){ $KETPL = $nilai; }
								else if ($matpel == 'Gigi'){ $KETGG = $nilai; }
								else if ($matpel == 'Lainnya'){ $KETL = $nilai; }
								else if ($matpel == $eksul1){ $K = $rjeneng->deskripsi;}
								else if ($matpel == $eksul2){ $K2 = $rjeneng->deskripsi;}
								else if ($matpel == $eksul3){ $K3 = $rjeneng->deskripsi;}
								else if ($matpel == $eksul4){ $K4 = $rjeneng->deskripsi;}
								else if ($matpel == $eksul5){ $K5 = $rjeneng->deskripsi;}
								else {
									if ($jennilai == 'KI1'){
										$getrata	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
										->where('noinduk', $noinduk)
										->where('tapel', $TAPEL)
										->where('semester', $valsmt)
										->where('jennilai', 'KI1')
										->groupBy('noinduk')
										->first();
										if (isset($getrata->ratanilai)){
											$SSP = (int)$getrata->ratanilai;
											if ($SSP == '4.0' OR $SSP == '4'){ 
												$SSP 	= 'A';
												$DES	= 'Ananda '.$NAMA.' selalu taat beribadah, selalu berperilaku syukur,  berdoa sebelum dan sesudah melakukan kegiatan, serta selalu toleransi dalam beribadah.';
											} else {
												$totalaspek	= 0;
												$getrata1	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'A')
															->where('jennilai', 'KI1')
															->groupBy('noinduk')
															->get();
												if (isset($getrata1->ratanilai)){
													$aspeka = $getrata1->ratanilai;
													$totalaspek = $totalaspek + $aspeka;
													if ($aspeka == 4){
														$aspeka = 'selalu taat beribadah';
													} else if ($aspeka == 3){
														$aspeka = 'taat beribadah';
													} else if ($aspeka == 2){
														$aspeka = 'perlu peningkatan sikap taat beribadah';
													} else {
														$aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap taat beribadah';
													}
												} else { $aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap taat beribadah';}
												
												$getrata2	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'B')
															->where('jennilai', 'KI1')
															->groupBy('noinduk')
															->get();
												if (isset($getrata2->ratanilai)){
													$aspekb = $getrata2->ratanilai;
													$totalaspek = $totalaspek + $aspekb;
													if ($aspekb == 4){
														$aspekb = 'selalu berperilaku syukur';
													} else if ($aspekb == 3){
														$aspekb = 'berperilaku syukur';
													} else if ($aspekb == 2){
														$aspekb = 'perlu peningkatan sikap berperilaku syukur';
													} else {
														$aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap berperilaku syukur';
													}
												} else { $aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap berperilaku syukur';}
												
												$getrata3	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'C')
															->where('jennilai', 'KI1')
															->groupBy('noinduk')
															->get();
												if (isset($getrata3->ratanilai)){
													$aspekc = $getrata3->ratanilai;
													$totalaspek = $totalaspek + $aspekc;
													if ($aspekc == 4){
														$aspekc = 'selalu berdoa sebelum dan sesudah melakukan kegiatan';
													} else if ($aspekc == 3){
														$aspekb = 'berdoa sebelum dan sesudah melakukan kegiatan';
													} else if ($aspekc == 2){
														$aspekc = 'perlu peningkatan sikap berdoa sebelum dan sesudah melakukan kegiatan';
													} else {
														$aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap berdoa sebelum dan sesudah melakukan kegiatan';
													}
												} else { $aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap berdoa sebelum dan sesudah melakukan kegiatan';}
												
												$getrata4	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'D')
															->where('jennilai', 'KI1')
															->groupBy('noinduk')
															->get();
												if (isset($getrata4->ratanilai)){
													$aspekd = $getrata4->ratanilai;
													$totalaspek = $totalaspek + $aspekd;
													if ($aspekd == 4){
														$aspekd = 'selalu toleransi dalam beribadah';
													} else if ($aspekd == 3){
														$aspekd = 'toleransi dalam beribadah';
													} else if ($aspekd == 2){
														$aspekd = 'perlu peningkatan sikap toleransi dalam beribadah';
													} else {
														$aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap toleransi dalam beribadah';
													}
												} else { $aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap toleransi dalam beribadah';}
												$totalaspek = round(($totalaspek/4), 0);
												if ($totalaspek == 1){ $SSP = 'D'; }
												else if ($totalaspek == 2){ $SSP = 'C'; }
												else { $totalaspek = 'B'; }
												$DES	= 'Ananda '.$NAMA.' '.$aspeka.', '.$aspekb.', '.$aspekc.' dan '.$aspekd;
											}
										}
									}
									else if ($jennilai == 'KI2'){
										$getrata	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
										->where('noinduk', $noinduk)
										->where('tapel', $TAPEL)
										->where('semester', $valsmt)
										->where('jennilai', 'KI2')
										->groupBy('noinduk')
										->first();
										if (isset($getrata->ratanilai)){
											$SS = (int)$getrata->ratanilai;
											if ($SS == '4.0' OR $SS == '4'){ 
												$SS 	= 'A';
												$DES2	= 'Ananda '.$NAMA.' selalu jujur, selalu disiplin, selalu tanggung Jawab, perlu meningkatkan sikap santun,  peduli, dan selalu percaya diri.';
											} else {
												$totalaspek	= 0;
												$getrata1	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'A')
															->where('jennilai', 'KI2')
															->groupBy('noinduk')
															->get();
												if (isset($getrata1->ratanilai)){
													$aspeka = $getrata1->ratanilai;
													$totalaspek = $totalaspek + $aspeka;
													if ($aspeka == 4){
														$aspeka = 'selalu jujur';
													} else if ($aspeka == 3){
														$aspeka = 'jujur';
													} else if ($aspeka == 2){
														$aspeka = 'perlu peningkatan sikap jujur';
													} else {
														$aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap jujur';
													}
												} else { $aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap jujur';}
												
												$getrata2	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'B')
															->where('jennilai', 'KI2')
															->groupBy('noinduk')
															->get();
												if (isset($getrata2->ratanilai)){
													$aspekb = $getrata2->ratanilai;
													$totalaspek = $totalaspek + $aspekb;
													if ($aspekb == 4){
														$aspekb = 'selalu disiplin';
													} else if ($aspekb == 3){
														$aspekb = 'disiplin';
													} else if ($aspekb == 2){
														$aspekb = 'perlu peningkatan sikap disiplin';
													} else {
														$aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap disiplin';
													}
												} else { $aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap disiplin';}
												
												$getrata3	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'C')
															->where('jennilai', 'KI2')
															->groupBy('noinduk')
															->get();
												if (isset($getrata3->ratanilai)){
													$aspekc = $getrata3->ratanilai;
													$totalaspek = $totalaspek + $aspekc;
													if ($aspekc == 4){
														$aspekc = 'selalu tanggung jawab';
													} else if ($aspekc == 3){
														$aspekb = 'tanggung jawab';
													} else if ($aspekc == 2){
														$aspekc = 'perlu peningkatan sikap tanggung jawab';
													} else {
														$aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap tanggung jawab';
													}
												} else { $aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap tanggung jawab';}
												
												$getrata4	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'D')
															->where('jennilai', 'KI2')
															->groupBy('noinduk')
															->get();
												if (isset($getrata4->ratanilai)){
													$aspekd = $getrata4->ratanilai;
													$totalaspek = $totalaspek + $aspekd;
													if ($aspekd == 4){
														$aspekd = 'selalu santun';
													} else if ($aspekd == 3){
														$aspekd = 'santun';
													} else if ($aspekd == 2){
														$aspekd = 'perlu peningkatan sikap santun';
													} else {
														$aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap santun';
													}
												} else { $aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap santun';}
												
												$getrata5	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'E')
															->where('jennilai', 'KI2')
															->groupBy('noinduk')
															->get();
												if (isset($getrata5->ratanilai)){
													$aspeke = $getrata5->ratanilai;
													$totalaspek = $totalaspek + $aspeke;
													if ($aspeke == 4){
														$aspeke = 'selalu peduli';
													} else if ($aspeke == 3){
														$aspeke = 'santun';
													} else if ($aspeke == 2){
														$aspeke = 'perlu peningkatan sikap peduli';
													} else {
														$aspeke = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap peduli';
													}
												} else { $aspeke = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap peduli';}
												
												$getrata6	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
															->where('noinduk', $noinduk)
															->where('tapel', $TAPEL)
															->where('semester', $valsmt)
															->where('subtema', 'F')
															->where('jennilai', 'KI2')
															->groupBy('noinduk')
															->get();
												if (isset($getrata6->ratanilai)){
													$aspekf = $getrata6->ratanilai;
													$totalaspek = $totalaspek + $aspekf;
													if ($aspekf == 4){
														$aspekf = 'selalu percaya diri';
													} else if ($aspekf == 3){
														$aspekf = 'percaya diri';
													} else if ($aspekf == 2){
														$aspekf = 'perlu peningkatan sikap percaya diri';
													} else {
														$aspekf = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap percaya diri';
													}
												} else { $aspekf = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap percaya diri';}
												
												$totalaspek = round(($totalaspek/6), 0);
												if ($totalaspek == 1){ $SS = 'D'; }
												else if ($totalaspek == 2){ $SS = 'C'; }
												else { $SS = 'B'; }
												$DES2	= 'Ananda '.$NAMA.' '.$aspeka.', '.$aspekb.', '.$aspekc.', '.$aspekd.', '.$aspeke.' dan '.$aspekf;
											}
										}
									}
									else {
										$jumlah34++;
										if ($matpel == 'Pendidikan Agama Islam dan Budi Pekerti'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H = 'B'; }
											else { $H = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D			= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D			= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H2 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H2 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H2 = 'B'; }
											else { $H2 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D2			= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D2			= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$PAI3 = $nilai3;
											$PAI4 = $nilai4;
										}
										else if ($matpel == 'Pendidikan Pancasila dan Kewarganegaraan'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H3 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H3 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H3 = 'B'; }
											else { $H3 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D3			= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D3			= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H4 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H4 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H4 = 'B'; }
											else { $H4 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D4			= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D4			= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$PPKN3 = $nilai3;
											$PPKN4 = $nilai4;
										}
										else if ($matpel == 'Bahasa Indonesia'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H5 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H5 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H5 = 'B'; }
											else { $H5 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D5			= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D5			= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H6 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H6 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H6 = 'B'; }
											else { $H6 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D6	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D6	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$BI3 = $nilai3;
											$BI4 = $nilai4;
										}
										else if ($matpel == 'Matematika'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H7 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H7 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H7 = 'B'; }
											else { $H7 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D7	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D7	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H8 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H8 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H8 = 'B'; }
											else { $H8 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D8	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D8	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$MAT3 = $nilai3;
											$MAT4 = $nilai4;
										}
										else if ($matpel == 'Ilmu Pengetahuan Alam'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H9 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H9 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H9 = 'B'; }
											else { $H9 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D9	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D9	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H10 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H10 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H10 = 'B'; }
											else { $H10 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D10	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D10	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$IPA3 = $nilai3;
											$IPA4 = $nilai4;
										}
										else if ($matpel == 'Ilmu Pengetahuan Sosial'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H11 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H11 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H11 = 'B'; }
											else { $H11 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D11	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D11	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H12 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H12 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H12 = 'B'; }
											else { $H12 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D12	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D12	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$IPS3 = $nilai3;
											$IPS4 = $nilai4;
										}
										else if ($matpel == 'Seni Budaya dan Prakarya'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H13 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H13 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H13 = 'B'; }
											else { $H13 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D13	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D13	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H14 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H14 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H14 = 'B'; }
											else { $H14 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D14	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D14	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$SBDP3 = $nilai3;
											$SBDP4 = $nilai4;
										}
										else if ($matpel == 'Pendidikan Jasmani, Olahraga dan Kesehatan'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H15 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H15 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H15 = 'B'; }
											else { $H15 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D15	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D15	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H16 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H16 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H16 = 'B'; }
											else { $H16 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D16	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D16	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$PJOK3 = $nilai3;
											$PJOK3 = $nilai4;
										}
										else if ($matpel == 'Bahasa Jawa'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H17 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H17 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H17 = 'B'; }
											else { $H17 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D17	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D17	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H18 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H18 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H18 = 'B'; }
											else { $H18 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D18	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D18	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$BJ3 = $nilai3;
											$BJ4 = $nilai4;
										}
										else if ($matpel == 'Bahasa Inggris'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H19 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H19 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H19 = 'B'; }
											else { $H19 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D19	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D19	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H20 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H20 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H20 = 'B'; }
											else { $H20 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D20	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D20	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$BING3 = $nilai3;
											$BING4 = $nilai4;
										}
										else if ($matpel == 'Bahasa Arab'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H21 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H21 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H21 = 'B'; }
											else { $H21 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D21	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D21	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H22 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H22 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H22 = 'B'; }
											else { $H22 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D22	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D22	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$BA3 = $nilai3;
											$BA4 = $nilai4;
										}
										else if ($matpel == 'Teknologi Informasi dan Komunikasi'){
											$desmin3 	= '';
											$desmax3 	= '';
											$nilmin3 	= 0;
											$nilmax3 	= 0;
											$kkm3 		= 0;
											$total3 	= 0;
											$count3 	= 0;
											$desmin4 	= '';
											$desmax4 	= '';
											$nilmin4 	= 0;
											$nilmax4 	= 0;
											$total4 	= 0;
											$count4 	= 0;
											$kkm4 		= 0;
											$getallnil = Datanilai::where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('matpel', $matpel)
														->get();
											if (!empty($getallnil)){
												foreach($getallnil as $rinnilai){
													$valnilai 	= (int)$rinnilai->nilai;
													$valkd		= $rinnilai->kodekd;
													$valjenkd	= $rinnilai->jennilai;
													if ($valjenkd != 'KI4'){
														$total3 = $total3 + $valnilai;
														$count3++;
														if ($nilmin3 == 0){
															$kkm3 	 = $rinnilai->kkm;
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin3){
																$nilmin3 = $valnilai;
																$desmin3 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax3 == 0){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax3){
																$nilmax3 = $valnilai;
																$nilmax3 = $rinnilai->deskripsi;
															}
														}
													} else {
														$total4 = $total4 + $valnilai;
														$count4++;
														if ($nilmin4 == 0){
															$kkm4 	 = $rinnilai->kkm;
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai < $nilmin4){
																$nilmin4 = $valnilai;
																$desmin4 = $rinnilai->deskripsi;
															}
														}
														if ($nilmax4 == 0){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														} else {
															if ($valnilai > $nilmax4){
																$nilmax4 = $valnilai;
																$nilmax4 = $rinnilai->deskripsi;
															}
														}
													}
												}
											}
											if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
											$kkm31 		= $kkm3 + 8;
											$kkm32 		= $kkm31 + 8;
											if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H23 = 'D'; }
											elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H23 = 'C'; }
											elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H23 = 'B'; }
											else { $H23 = 'A';}
											
											if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax3 == $desmin3){
												$D23	= $predikatatas.' dalam '.$desmax3.', ';
											} else {
												$D23	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
											}
											if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
											$kkm41 		= $kkm4 + 8;
											$kkm42 		= $kkm41 + 8;
											if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H24 = 'D'; }
											elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H24 = 'C'; }
											elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H24 = 'B'; }
											else { $H24 = 'A';}
											
											if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
											elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
											elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
											else { $predikatbawah = 'sangat baik';}
											
											if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
											elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
											elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
											else { $predikatatas = 'sangat baik';}
											
											if ($desmax4 == $desmin4){
												$D24	= $predikatatas.' dalam '.$desmax4.', ';
											} else {
												$D24	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
											}
											$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
											$TIK3 = $nilai3;
											$TIK4 = $nilai4;
										} else {
											//nek-ono-maneh
										}
									}
								}
							}
						}
						if ($totnil34 != 0 AND $jumlah34 != 0){
							$rata34 = round(($totnil34/$jumlah34), 2);
						} else { $rata34 = 0; }
						$cekprestasi = Prestasi::where('noinduk', $noinduk)->where('tapel', $TAPEL)->get();
						if (!empty($cekprestasi)){
							foreach($cekprestasi as $rprestasi){
								if ($PRETASI1 == ''){
									$PRETASI1 	= $rprestasi->kegiatan;
									$KET1 		= $rprestasi->juara;
								} else if ($PRETASI2 == ''){
									$PRETASI2 	= $rprestasi->kegiatan;
									$KET2 		= $rprestasi->juara;
								} else if ($PRETASI3 == ''){
									$PRETASI3 	= $rprestasi->kegiatan;
									$KET3 		= $rprestasi->juara;
								} else {
									$PRETASI4 	= $rprestasi->kegiatan;
									$KET4 		= $rprestasi->juara;
								}
							}
						}
						Rapotan::create([
							'NOMOR' 		=> $NOMOR,
							'NAMA' 			=> $NAMA,
							'NISN'			=> $NISN,
							'NAMASD'		=> $NAMASD,
							'ALAMAT'		=> $ALAMAT,
							'KELAS'			=> $KELAS,
							'SEMESTER'		=> $SEMESTER,
							'TAPEL'			=> $TAPEL,
							'JENIS'			=> $JENIS,
							'SSP'			=> $SSP,
							'DES'			=> $DES,
							'SS'			=> $SS,
							'DES2'			=> $DES2,
							'PAI3'			=> $PAI3,
							'H'				=> $H,
							'D'				=> $D,
							'PAI4'			=> $PAI4,
							'H2'			=> $H2,
							'D2'			=> $D2,
							'PPKN3'			=> $PPKN3,
							'H3'			=> $H3,
							'D3'			=> $D3,
							'PPKN4'			=> $PPKN4,
							'H4'			=> $H4,
							'D4'			=> $D4,
							'BI3'			=> $BI3,
							'H5'			=> $H5,
							'D5'			=> $D5,
							'BI4'			=> $BI4,
							'H6'			=> $H6,
							'D6'			=> $D6,
							'MAT3'			=> $MAT3,
							'H7'			=> $H7,
							'D7'			=> $D7,
							'MAT4'			=> $MAT4,
							'H8'			=> $H8,
							'D8'			=> $D8,
							'IPA3'			=> $IPA3,
							'H9'			=> $H9,
							'D9'			=> $D9,
							'IPA4'			=> $IPA4,
							'H10'			=> $H10,
							'D10'			=> $D10,
							'IPS3'			=> $IPS3,
							'H11'			=> $H11,
							'D11'			=> $D11,
							'IPS4'			=> $IPS4,
							'H12'			=> $H12,
							'D12'			=> $D12,
							'SBDP3'			=> $SBDP3,
							'H13'			=> $H13,
							'D13'			=> $D13,
							'SBDP4'			=> $SBDP4,
							'H14'			=> $H14,
							'D14'			=> $D14,
							'PJOK3'			=> $PJOK3,
							'H15'			=> $H15,
							'D15'			=> $D15,
							'PJOK4'			=> $PJOK4,
							'H16'			=> $H16,
							'D16'			=> $D16,
							'BJ3'			=> $BJ3,
							'H17'			=> $H17,
							'D17'			=> $D17,
							'BJ4'			=> $BJ4,
							'H18'			=> $H18,
							'D18'			=> $D18,
							'BING3'			=> $BING3,
							'H19'			=> $H19,
							'D19'			=> $D19,
							'BING4'			=> $BING4,
							'H20'			=> $H20,
							'D20'			=> $D20,
							'BA3'			=> $BA3,
							'H21'			=> $H21,
							'D21'			=> $D21,
							'BA4'			=> $BA4,
							'H22'			=> $H22,
							'D22'			=> $D22,
							'TIK3'			=> $TIK3,
							'H23'			=> $H23,
							'D23'			=> $D23,
							'TIK4'			=> $TIK4,
							'H24'			=> $H24,
							'D24'			=> $D24,
							'EKS'			=> $EKS,
							'K'				=> $K,
							'EKS2'			=> $EKS2,
							'K2'			=> $K2,
							'EKS3'			=> $EKS3,
							'K3'			=> $K3,
							'EKS4'			=> $EKS4,
							'K4'			=> $K4,
							'EKS5'			=> $EKS5,
							'K5'			=> $K5,
							'SARAN'			=> $SARAN,
							'total'			=> $totnil34,
							'jumlahmatpel'	=> $jumlah34,
							'ratarata'		=> $rata34,
							'rangking'		=> $rangking,
							'TBS1'			=> $TBS1,
							'TBS2'			=> $TBS2,
							'BBS1'			=> $BBS1,
							'BBS2'			=> $BBS2,
							'KETPD'			=> $KETPD,
							'KETPL'			=> $KETPL,
							'KETGG'			=> $KETGG,
							'KETL'			=> $KETL,
							'PRETASI1'		=> $PRETASI1,
							'KET'			=> $KET,
							'PRETASI2'		=> $PRETASI2,
							'KET2'			=> $KET2,
							'PRETASI3'		=> $PRETASI3,
							'KET3'			=> $KET3,
							'PRETASI4'		=> $PRETASI4,
							'KET4'			=> $KET4,
							'SAKIT'			=> $SAKIT,
							'IZIN'			=> $IZIN,
							'TANPA'			=> $TANPA,
							'TGLRAPOR'		=> $tanggal,
							'GURUKLS'		=> $GURUKLS,
							'NIPGURU'		=> $NIPGURU,
							'KASEK'			=> $KASEK,
							'NIPKASEK'		=> $NIPKASEK,
							'KEPUTUSAN'		=> $KEPUTUSAN,
							'NAIK'			=> $NAIK,
							'marking'		=> $marking,
							'markirim'		=> '',
							'markcetak'		=> '',
						]);
						$NOMOR++;
					}
				}
			}
		} else {
			$sql 	= DB::table('db_datainduk')
						->join('db_setkeuangan', 'db_datainduk.noinduk', 'db_setkeuangan.noinduk')
						->where('db_datainduk.klspos', $KELAS)
						->where('db_datainduk.nokelulusan', '')
						->select('db_datainduk.*', 'db_setkeuangan.eksul1', 'db_setkeuangan.eksul2', 'db_setkeuangan.eksul3', 'db_setkeuangan.eksul4', 'db_setkeuangan.eksul5')
						->orderBy('db_datainduk.noinduk', 'ASC')
						->get();
			if (!empty($sql)){
				foreach ($sql as $hasil) {
					$NAMA 		= $hasil->nama;
					$NISN 		= $hasil->nisn;
					$noinduk 	= $hasil->noinduk;
					$namaayah 	= $hasil->namaayah;
					$namaibu 	= $hasil->namaibu;
					$hape 		= $hasil->hape;
					$eksul1 	= $hasil->eksul1;
					$eksul2 	= $hasil->eksul2;
					$eksul3 	= $hasil->eksul3;
					$eksul4 	= $hasil->eksul4;
					$eksul5 	= $hasil->eksul5;
					$NISN		= $NISN.' / '.$noinduk;
					$marking	= $markingguru.$noinduk;
					$SSP		= '';
					$DES		= '';
					$SS			= '';
					$DES2		= '';
					$PAI3		= '';
					$H			= '';
					$D			= '';
					$PAI4		= '';
					$H2			= '';
					$D2			= '';
					$PPKN3		= '';
					$H3			= '';
					$D3			= '';
					$PPKN4		= '';
					$H4			= '';
					$D4			= '';
					$BI3		= '';
					$H5			= '';
					$D5			= '';
					$BI4		= '';
					$H6			= '';
					$D6			= '';
					$MAT3		= '';
					$MAT4		= '';
					$PAI3		= '';
					$H7			= '';
					$D7			= '';
					$MAT4		= '';
					$H8			= '';
					$D8			= '';
					$IPA3		= '';
					$H9			= '';
					$D9			= '';
					$IPA4		= '';
					$H10		= '';
					$D10		= '';
					$IPS3		= '';
					$H11		= '';
					$D11		= '';
					$IPS4		= '';
					$H12		= '';
					$D12		= '';
					$SBDP3		= '';
					$H13		= '';
					$D13		= '';
					$SBDP4		= '';
					$H14		= '';
					$D14		= '';
					$PJOK3		= '';
					$H15		= '';
					$D15		= '';
					$PJOK4		= '';
					$H16		= '';
					$D16		= '';
					$BJ3		= '';
					$H17		= '';
					$D17		= '';
					$BJ4		= '';
					$H18		= '';
					$D18		= '';
					$BING3		= '';
					$H19		= '';
					$D19		= '';
					$BING4		= '';
					$H20		= '';
					$D20		= '';
					$BA3		= '';
					$H21		= '';
					$D21		= '';
					$BA4		= '';
					$H22		= '';
					$D22		= '';
					$TIK3		= '';
					$H23		= '';
					$D23		= '';
					$TIK4		= '';
					$H24		= '';
					$D24		= '';
					$EKS 		= $eksul1;
					$K			= '';
					$EKS2		= $eksul2;
					$K2			= '';
					$EKS3		= $eksul3;
					$K3			= '';
					$EKS4		= $eksul4;
					$K4			= '';
					$EKS5		= $eksul5;
					$K5			= '';
					$SARAN		= '';
					$TBS1		= '';
					$TBS2		= '';
					$BBS1		= '';
					$BBS2		= '';
					$KETPD		= '';
					$KETPL		= '';
					$KETGG		= '';
					$KETL		= '';
					$PRETASI1	= '';
					$KET		= '';
					$PRETASI2	= '';
					$KET2		= '';
					$PRETASI3	= '';
					$KET3		= '';
					$PRETASI4	= '';
					$KET4		= '';
					$IZIN 		= Datapresensi::where('noinduk', $noinduk)->where('status', '2')->count();
					$SAKIT 		= Datapresensi::where('noinduk', $noinduk)->where('status', '3')->count();
					$TANPA 		= Datapresensi::where('noinduk', $noinduk)->where('status', '0')->count();
					$KEPUTUSAN	= '';
					$NAIK		= '';
					$totnil34	= 0;
					$jumlah34	= 0;
					$rata34		= 0;
					$rangking	= 0;
					$getlognilai= Datanilai::where('noinduk', $noinduk)
										->where('tapel', $TAPEL)
										->where('semester', $valsmt)
										->groupBy('matpel')
										->get();
					if (!empty($getlognilai)){
						foreach ($getlognilai as $rjeneng) {
							$matpel 	= $rjeneng->matpel;
							$nilai 		= $rjeneng->nilai;
							$jennilai 	= $rjeneng->jennilai;
							
							if ($matpel == 'Tinggi Badan Smt 1'){ $TBS1 = $nilai; }
							else if ($matpel == 'Tinggi Badan Smt 2'){ $TBS2 = $nilai; }
							else if ($matpel == 'Berat Badan Smt 1'){ $BBS1 = $nilai; }
							else if ($matpel == 'Berat Badan Smt 2'){ $BBS2 = $nilai; }
							else if ($matpel == 'Pendengaran'){ $KETPD = $nilai; }
							else if ($matpel == 'Penglihatan'){ $KETPL = $nilai; }
							else if ($matpel == 'Gigi'){ $KETGG = $nilai; }
							else if ($matpel == 'Lainnya'){ $KETL = $nilai; }
							else if ($matpel == $eksul1){ $K = $rjeneng->deskripsi;}
							else if ($matpel == $eksul2){ $K2 = $rjeneng->deskripsi;}
							else if ($matpel == $eksul3){ $K3 = $rjeneng->deskripsi;}
							else if ($matpel == $eksul4){ $K4 = $rjeneng->deskripsi;}
							else if ($matpel == $eksul5){ $K5 = $rjeneng->deskripsi;}
							else {
								if ($jennilai == 'KI1'){
									$getrata	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
									->where('noinduk', $noinduk)
									->where('tapel', $TAPEL)
									->where('semester', $valsmt)
									->where('jennilai', 'KI1')
									->groupBy('noinduk')
									->first();
									if (isset($getrata->ratanilai)){
										$SSP = $getrata->ratanilai;
										if ($SSP == '4.0' OR $SSP == '4'){ 
											$SSP 	= 'A';
											$DES	= 'Ananda '.$NAMA.' selalu taat beribadah, selalu berperilaku syukur,  berdoa sebelum dan sesudah melakukan kegiatan, serta selalu toleransi dalam beribadah.';
										} else {
											$totalaspek	= 0;
											$getrata1	= Datanilai::select('id','noinduk','matpel',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'A')
														->where('jennilai', 'KI1')
														->groupBy('noinduk')
														->get();
											if (isset($getrata1->ratanilai)){
												$aspeka = $getrata1->ratanilai;
												$deska 	= $getrata1->matpel;
												$totalaspek = $totalaspek + $aspeka;
												if ($aspeka == 4){
													$aspeka = 'selalu '.$deska;
												} else if ($aspeka == 3){
													$aspeka = $deska;
												} else if ($aspeka == 2){
													$aspeka = 'perlu peningkatan sikap '.$deska;
												} else {
													$aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deska;
												}
											} else { $aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deska; }
											
											$getrata2	= Datanilai::select('id','noinduk','matpel',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'B')
														->where('jennilai', 'KI1')
														->groupBy('noinduk')
														->get();
											if (isset($getrata2->ratanilai)){
												$aspekb = $getrata2->ratanilai;
												$deskb 	= $getrata2->matpel;
												$totalaspek = $totalaspek + $aspekb;
												if ($aspekb == 4){
													$aspekb = 'selalu '.$deskb;
												} else if ($aspekb == 3){
													$aspekb = $deskb;
												} else if ($aspekb == 2){
													$aspekb = 'perlu peningkatan sikap '.$deskb;
												} else {
													$aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deskb;
												}
											} else { $aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deskb; }
											
											$getrata3	= Datanilai::select('id','noinduk','matpel',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'C')
														->where('jennilai', 'KI1')
														->groupBy('noinduk')
														->get();
											if (isset($getrata3->ratanilai)){
												$aspekc = $getrata3->ratanilai;
												$deskc 	= $getrata3->matpel;
												$totalaspek = $totalaspek + $aspekc;
												if ($aspekc == 4){
													$aspekc = 'selalu '.$deskc;
												} else if ($aspekc == 3){
													$aspekb = $deskc;
												} else if ($aspekc == 2){
													$aspekc = 'perlu peningkatan sikap '.$deskc;
												} else {
													$aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deskc;
												}
											} else { $aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deskc; }
											
											$getrata4	= Datanilai::select('id','noinduk','matpel',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'D')
														->where('jennilai', 'KI1')
														->groupBy('noinduk')
														->get();
											if (isset($getrata4->ratanilai)){
												$aspekd = $getrata4->ratanilai;
												$deskd	= $getrata4->matpel;
												
												$totalaspek = $totalaspek + $aspekd;
												if ($aspekd == 4){
													$aspekd = 'selalu '.$deskd;
												} else if ($aspekd == 3){
													$aspekd = $deskd;
												} else if ($aspekd == 2){
													$aspekd = 'perlu peningkatan sikap '.$deskd;
												} else {
													$aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deskd;
												}
											} else { $aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap '.$deskd; }
											$totalaspek = round(($totalaspek/4), 0);
											if ($totalaspek == 1){ $SSP = 'D'; }
											else if ($totalaspek == 2){ $SSP = 'C'; }
											else { $totalaspek = 'B'; }
											$DES	= 'Ananda '.$NAMA.' '.$aspeka.', '.$aspekb.', '.$aspekc.' dan '.$aspekd;
										}
									} else { $SSP = 'O'; $DES = '-'; }
								}
								else if ($jennilai == 'KI2'){
									$getrata	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
									->where('noinduk', $noinduk)
									->where('tapel', $TAPEL)
									->where('semester', $valsmt)
									->where('jennilai', 'KI2')
									->groupBy('noinduk')
									->first();
									if (isset($getrata->ratanilai)){
										$SS = $getrata->ratanilai;
										if ($SS == '4.0' OR $SS == '4'){ 
											$SS 	= 'A';
											$DES2	= 'Ananda '.$NAMA.' selalu jujur, selalu disiplin, selalu tanggung Jawab, perlu meningkatkan sikap santun,  peduli, dan selalu percaya diri.';
										} else {
											$totalaspek	= 0;
											$getrata1	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'A')
														->where('jennilai', 'KI2')
														->groupBy('noinduk')
														->get();
											if (isset($getrata1->ratanilai)){
												$aspeka = $getrata1->ratanilai;
												$totalaspek = $totalaspek + $aspeka;
												if ($aspeka == 4){
													$aspeka = 'selalu jujur';
												} else if ($aspeka == 3){
													$aspeka = 'jujur';
												} else if ($aspeka == 2){
													$aspeka = 'perlu peningkatan sikap jujur';
												} else {
													$aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap jujur';
												}
											} else { $aspeka = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap jujur';}
											
											$getrata2	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'B')
														->where('jennilai', 'KI2')
														->groupBy('noinduk')
														->get();
											if (isset($getrata2->ratanilai)){
												$aspekb = $getrata2->ratanilai;
												$totalaspek = $totalaspek + $aspekb;
												if ($aspekb == 4){
													$aspekb = 'selalu disiplin';
												} else if ($aspekb == 3){
													$aspekb = 'disiplin';
												} else if ($aspekb == 2){
													$aspekb = 'perlu peningkatan sikap disiplin';
												} else {
													$aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap disiplin';
												}
											} else { $aspekb = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap disiplin';}
											
											$getrata3	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'C')
														->where('jennilai', 'KI2')
														->groupBy('noinduk')
														->get();
											if (isset($getrata3->ratanilai)){
												$aspekc = $getrata3->ratanilai;
												$totalaspek = $totalaspek + $aspekc;
												if ($aspekc == 4){
													$aspekc = 'selalu tanggung jawab';
												} else if ($aspekc == 3){
													$aspekb = 'tanggung jawab';
												} else if ($aspekc == 2){
													$aspekc = 'perlu peningkatan sikap tanggung jawab';
												} else {
													$aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap tanggung jawab';
												}
											} else { $aspekc = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap tanggung jawab';}
											
											$getrata4	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'D')
														->where('jennilai', 'KI2')
														->groupBy('noinduk')
														->get();
											if (isset($getrata4->ratanilai)){
												$aspekd = $getrata4->ratanilai;
												$totalaspek = $totalaspek + $aspekd;
												if ($aspekd == 4){
													$aspekd = 'selalu santun';
												} else if ($aspekd == 3){
													$aspekd = 'santun';
												} else if ($aspekd == 2){
													$aspekd = 'perlu peningkatan sikap santun';
												} else {
													$aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap santun';
												}
											} else { $aspekd = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap santun';}
											
											$getrata5	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'E')
														->where('jennilai', 'KI2')
														->groupBy('noinduk')
														->get();
											if (isset($getrata5->ratanilai)){
												$aspeke = $getrata5->ratanilai;
												$totalaspek = $totalaspek + $aspeke;
												if ($aspeke == 4){
													$aspeke = 'selalu peduli';
												} else if ($aspeke == 3){
													$aspeke = 'santun';
												} else if ($aspeke == 2){
													$aspeke = 'perlu peningkatan sikap peduli';
												} else {
													$aspeke = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap peduli';
												}
											} else { $aspeke = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap peduli';}
											
											$getrata6	= Datanilai::select('id','noinduk',DB::raw('round(AVG(nilai),0) as ratanilai'))
														->where('noinduk', $noinduk)
														->where('tapel', $TAPEL)
														->where('semester', $valsmt)
														->where('subtema', 'F')
														->where('jennilai', 'KI2')
														->groupBy('noinduk')
														->get();
											if (isset($getrata6->ratanilai)){
												$aspekf = $getrata6->ratanilai;
												$totalaspek = $totalaspek + $aspekf;
												if ($aspekf == 4){
													$aspekf = 'selalu percaya diri';
												} else if ($aspekf == 3){
													$aspekf = 'percaya diri';
												} else if ($aspekf == 2){
													$aspekf = 'perlu peningkatan sikap percaya diri';
												} else {
													$aspekf = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap percaya diri';
												}
											} else { $aspekf = 'dengan bimbingan serta pendampingan yang lebih ananda akan mampu meningkatkan sikap percaya diri';}
											
											$totalaspek = round(($totalaspek/6), 0);
											if ($totalaspek == 1){ $SS = 'D'; }
											else if ($totalaspek == 2){ $SS = 'C'; }
											else { $SS = 'B'; }
											$DES2	= 'Ananda '.$NAMA.' '.$aspeka.', '.$aspekb.', '.$aspekc.', '.$aspekd.', '.$aspeke.' dan '.$aspekf;
										}
									} else { $SS = 'O'; $DES2 = '-'; }
								}
								else {
									$jumlah34++;
									if ($matpel == 'Pendidikan Agama Islam dan Budi Pekerti'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H = 'B'; }
										else { $H = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D			= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D			= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H2 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H2 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H2 = 'B'; }
										else { $H2 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D2			= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D2			= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$PAI3 = $nilai3;
										$PAI4 = $nilai4;
									}
									else if ($matpel == 'Pendidikan Pancasila dan Kewarganegaraan'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H3 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H3 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H3 = 'B'; }
										else { $H3 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D3			= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D3			= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H4 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H4 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H4 = 'B'; }
										else { $H4 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D4			= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D4			= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$PPKN3 = $nilai3;
										$PPKN4 = $nilai4;
									}
									else if ($matpel == 'Bahasa Indonesia'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H5 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H5 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H5 = 'B'; }
										else { $H5 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D5			= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D5			= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H6 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H6 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H6 = 'B'; }
										else { $H6 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D6	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D6	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$BI3 = $nilai3;
										$BI4 = $nilai4;
									}
									else if ($matpel == 'Matematika'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H7 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H7 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H7 = 'B'; }
										else { $H7 = 'A';}
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D7	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D7	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H8 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H8 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H8 = 'B'; }
										else { $H8 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D8	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D8	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$MAT3 = $nilai3;
										$MAT4 = $nilai4;
									}
									else if ($matpel == 'Ilmu Pengetahuan Alam'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H9 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H9 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H9 = 'B'; }
										else { $H9 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D9	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D9	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H10 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H10 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H10 = 'B'; }
										else { $H10 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D10	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D10	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$IPA3 = $nilai3;
										$IPA4 = $nilai4;
									}
									else if ($matpel == 'Ilmu Pengetahuan Sosial'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H11 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H11 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H11 = 'B'; }
										else { $H11 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D11	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D11	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H12 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H12 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H12 = 'B'; }
										else { $H12 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D12	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D12	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$IPS3 = $nilai3;
										$IPS4 = $nilai4;
									}
									else if ($matpel == 'Seni Budaya dan Prakarya'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H13 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H13 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H13 = 'B'; }
										else { $H13 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D13	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D13	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H14 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H14 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H14 = 'B'; }
										else { $H14 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D14	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D14	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$SBDP3 = $nilai3;
										$SBDP4 = $nilai4;
									}
									else if ($matpel == 'Pendidikan Jasmani, Olahraga dan Kesehatan'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H15 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H15 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H15 = 'B'; }
										else { $H15 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D15	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D15	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H16 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H16 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H16 = 'B'; }
										else { $H16 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D16	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D16	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$PJOK3 = $nilai3;
										$PJOK3 = $nilai4;
									}
									else if ($matpel == 'Bahasa Jawa'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H17 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H17 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H17 = 'B'; }
										else { $H17 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D17	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D17	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H18 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H18 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H18 = 'B'; }
										else { $H18 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D18	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D18	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$BJ3 = $nilai3;
										$BJ4 = $nilai4;
									}
									else if ($matpel == 'Bahasa Inggris'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H19 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H19 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H19 = 'B'; }
										else { $H19 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D19	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D19	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H20 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H20 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H20 = 'B'; }
										else { $H20 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D20	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D20	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$BING3 = $nilai3;
										$BING4 = $nilai4;
									}
									else if ($matpel == 'Bahasa Arab'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H21 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H21 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H21 = 'B'; }
										else { $H21 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D21	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D21	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H22 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H22 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H22 = 'B'; }
										else { $H22 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D22	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D22	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$BA3 = $nilai3;
										$BA4 = $nilai4;
									}
									else if ($matpel == 'Teknologi Informasi dan Komunikasi'){
										$desmin3 	= '';
										$desmax3 	= '';
										$nilmin3 	= 0;
										$nilmax3 	= 0;
										$kkm3 		= 0;
										$total3 	= 0;
										$count3 	= 0;
										$desmin4 	= '';
										$desmax4 	= '';
										$nilmin4 	= 0;
										$nilmax4 	= 0;
										$total4 	= 0;
										$count4 	= 0;
										$kkm4 		= 0;
										$getallnil = Datanilai::where('noinduk', $noinduk)
													->where('tapel', $TAPEL)
													->where('semester', $valsmt)
													->where('matpel', $matpel)
													->get();
										if (!empty($getallnil)){
											foreach($getallnil as $rinnilai){
												$valnilai 	= (int)$rinnilai->nilai;
												$valkd		= $rinnilai->kodekd;
												$valjenkd	= $rinnilai->jennilai;
												if ($valjenkd != 'KI4'){
													$total3 = $total3 + $valnilai;
													$count3++;
													if ($nilmin3 == 0){
														$kkm3 	 = $rinnilai->kkm;
														$nilmin3 = $valnilai;
														$desmin3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin3){
															$nilmin3 = $valnilai;
															$desmin3 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax3 == 0){
														$nilmax3 = $valnilai;
														$nilmax3 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax3){
															$nilmax3 = $valnilai;
															$nilmax3 = $rinnilai->deskripsi;
														}
													}
												} else {
													$total4 = $total4 + $valnilai;
													$count4++;
													if ($nilmin4 == 0){
														$kkm4 	 = $rinnilai->kkm;
														$nilmin4 = $valnilai;
														$desmin4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai < $nilmin4){
															$nilmin4 = $valnilai;
															$desmin4 = $rinnilai->deskripsi;
														}
													}
													if ($nilmax4 == 0){
														$nilmax4 = $valnilai;
														$nilmax4 = $rinnilai->deskripsi;
													} else {
														if ($valnilai > $nilmax4){
															$nilmax4 = $valnilai;
															$nilmax4 = $rinnilai->deskripsi;
														}
													}
												}
											}
										}
										if ($total3 != 0){ $nilai3 = round(($total3/$count3), 0); }else { $nilai3 = 0; }
										$kkm31 		= $kkm3 + 8;
										$kkm32 		= $kkm31 + 8;
										if ( ($nilai3 >= 0) && ($nilai3 < $kkm3)) { $H23 = 'D'; }
										elseif ( ($nilai3 >= $kkm3) && ($nilai3 < $kkm31)) { $H23 = 'C'; }
										elseif ( ($nilai3 >= $kkm31) && ($nilai3 <= $kkm32)) { $H23 = 'B'; }
										else { $H23 = 'A';}
										
										if ( ($nilmin3 >= 0) && ($nilmin3 < $kkm3)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin3 >= $kkm3) && ($nilmin3 < $kkm31)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin3 >= $kkm31) && ($nilmin3 <= $kkm32)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax3 >= 0) && ($nilmax3 < $kkm3)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax3 >= $kkm3) && ($nilmax3 < $kkm31)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax3 >= $kkm31) && ($nilmax3 <= $kkm32)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax3 == $desmin3){
											$D23	= $predikatatas.' dalam '.$desmax3.', ';
										} else {
											$D23	= $predikatatas.' dalam '.$desmax3.', '.$predikatbawah.' dalam '.$desmin3;
										}
										if ($total4 != 0){ $nilai4 = round(($total4/$count4), 0); }else { $nilai4 = 0; }
										$kkm41 		= $kkm4 + 8;
										$kkm42 		= $kkm41 + 8;
										if ( ($nilai4 >= 0) && ($nilai4 < $kkm4)) { $H24 = 'D'; }
										elseif ( ($nilai4 >= $kkm4) && ($nilai4 < $kkm41)) { $H24 = 'C'; }
										elseif ( ($nilai4 >= $kkm41) && ($nilai4 <= $kkm42)) { $H24 = 'B'; }
										else { $H24 = 'A';}
										
										if ( ($nilmin4 >= 0) && ($nilmin4 < $kkm4)) { $predikatbawah = 'perlu bimbingan'; }
										elseif ( ($nilmin4 >= $kkm4) && ($nilmin4 < $kkm41)) { $predikatbawah = 'cukup baik'; }
										elseif ( ($nilmin4 >= $kkm41) && ($nilmin4 <= $kkm42)) { $predikatbawah = 'baik'; }
										else { $predikatbawah = 'sangat baik';}
										
										if ( ($nilmax4 >= 0) && ($nilmax4 < $kkm4)) { $predikatatas = 'perlu bimbingan'; }
										elseif ( ($nilmax4 >= $kkm4) && ($nilmax4 < $kkm41)) { $predikatatas = 'cukup baik'; }
										elseif ( ($nilmax4 >= $kkm41) && ($nilmax4 <= $kkm42)) { $predikatatas = 'baik'; }
										else { $predikatatas = 'sangat baik';}
										
										if ($desmax4 == $desmin4){
											$D24	= $predikatatas.' dalam '.$desmax4.', ';
										} else {
											$D24	= $predikatatas.' dalam '.$desmax4.', '.$predikatbawah.' dalam '.$desmin4;
										}
										$totnil34 = $totnil34 + (($nilai3 + $nilai4)/2);
										$TIK3 = $nilai3;
										$TIK4 = $nilai4;
									} else {
										//nek-ono-maneh
									}
								}
							}
						}
					}
					if ($totnil34 != 0 AND $jumlah34 != 0){
						$rata34 = round(($totnil34/$jumlah34), 2);
					} else { $rata34 = 0; }
					$cekprestasi = Prestasi::where('noinduk', $noinduk)->where('tapel', $TAPEL)->get();
					if (!empty($cekprestasi)){
						foreach($cekprestasi as $rprestasi){
							if ($PRETASI1 == ''){
								$PRETASI1 	= $rprestasi->kegiatan;
								$KET1 		= $rprestasi->juara;
							} else if ($PRETASI2 == ''){
								$PRETASI2 	= $rprestasi->kegiatan;
								$KET2 		= $rprestasi->juara;
							} else if ($PRETASI3 == ''){
								$PRETASI3 	= $rprestasi->kegiatan;
								$KET3 		= $rprestasi->juara;
							} else {
								$PRETASI4 	= $rprestasi->kegiatan;
								$KET4 		= $rprestasi->juara;
							}
						}
					}
					Rapotan::where('marking', $marking)->update([
						'NOMOR' 		=> $NOMOR,
						'NAMA' 			=> $NAMA,
						'NISN'			=> $NISN,
						'NAMASD'		=> $NAMASD,
						'ALAMAT'		=> $ALAMAT,
						'KELAS'			=> $KELAS,
						'SEMESTER'		=> $SEMESTER,
						'TAPEL'			=> $TAPEL,
						'JENIS'			=> $JENIS,
						'SSP'			=> $SSP,
						'DES'			=> $DES,
						'SS'			=> $SS,
						'DES2'			=> $DES2,
						'PAI3'			=> $PAI3,
						'H'				=> $H,
						'D'				=> $D,
						'PAI4'			=> $PAI4,
						'H2'			=> $H2,
						'D2'			=> $D2,
						'PPKN3'			=> $PPKN3,
						'H3'			=> $H3,
						'D3'			=> $D3,
						'PPKN4'			=> $PPKN4,
						'H4'			=> $H4,
						'D4'			=> $D4,
						'BI3'			=> $BI3,
						'H5'			=> $H5,
						'D5'			=> $D5,
						'BI4'			=> $BI4,
						'H6'			=> $H6,
						'D6'			=> $D6,
						'MAT3'			=> $MAT3,
						'H7'			=> $H7,
						'D7'			=> $D7,
						'MAT4'			=> $MAT4,
						'H8'			=> $H8,
						'D8'			=> $D8,
						'IPA3'			=> $IPA3,
						'H9'			=> $H9,
						'D9'			=> $D9,
						'IPA4'			=> $IPA4,
						'H10'			=> $H10,
						'D10'			=> $D10,
						'IPS3'			=> $IPS3,
						'H11'			=> $H11,
						'D11'			=> $D11,
						'IPS4'			=> $IPS4,
						'H12'			=> $H12,
						'D12'			=> $D12,
						'SBDP3'			=> $SBDP3,
						'H13'			=> $H13,
						'D13'			=> $D13,
						'SBDP4'			=> $SBDP4,
						'H14'			=> $H14,
						'D14'			=> $D14,
						'PJOK3'			=> $PJOK3,
						'H15'			=> $H15,
						'D15'			=> $D15,
						'PJOK4'			=> $PJOK4,
						'H16'			=> $H16,
						'D16'			=> $D16,
						'BJ3'			=> $BJ3,
						'H17'			=> $H17,
						'D17'			=> $D17,
						'BJ4'			=> $BJ4,
						'H18'			=> $H18,
						'D18'			=> $D18,
						'BING3'			=> $BING3,
						'H19'			=> $H19,
						'D19'			=> $D19,
						'BING4'			=> $BING4,
						'H20'			=> $H20,
						'D20'			=> $D20,
						'BA3'			=> $BA3,
						'H21'			=> $H21,
						'D21'			=> $D21,
						'BA4'			=> $BA4,
						'H22'			=> $H22,
						'D22'			=> $D22,
						'TIK3'			=> $TIK3,
						'H23'			=> $H23,
						'D23'			=> $D23,
						'TIK4'			=> $TIK4,
						'H24'			=> $H24,
						'D24'			=> $D24,
						'EKS'			=> $EKS,
						'K'				=> $K,
						'EKS2'			=> $EKS2,
						'K2'			=> $K2,
						'EKS3'			=> $EKS3,
						'K3'			=> $K3,
						'EKS4'			=> $EKS4,
						'K4'			=> $K4,
						'EKS5'			=> $EKS5,
						'K5'			=> $K5,
						'SARAN'			=> $SARAN,
						'total'			=> $totnil34,
						'jumlahmatpel'	=> $jumlah34,
						'ratarata'		=> $rata34,
						'rangking'		=> $rangking,
						'TBS1'			=> $TBS1,
						'TBS2'			=> $TBS2,
						'BBS1'			=> $BBS1,
						'BBS2'			=> $BBS2,
						'KETPD'			=> $KETPD,
						'KETPL'			=> $KETPL,
						'KETGG'			=> $KETGG,
						'KETL'			=> $KETL,
						'PRETASI1'		=> $PRETASI1,
						'KET'			=> $KET,
						'PRETASI2'		=> $PRETASI2,
						'KET2'			=> $KET2,
						'PRETASI3'		=> $PRETASI3,
						'KET3'			=> $KET3,
						'PRETASI4'		=> $PRETASI4,
						'KET4'			=> $KET4,
						'SAKIT'			=> $SAKIT,
						'IZIN'			=> $IZIN,
						'TANPA'			=> $TANPA,
						'TGLRAPOR'		=> $tanggal,
						'GURUKLS'		=> $GURUKLS,
						'NIPGURU'		=> $NIPGURU,
						'KASEK'			=> $KASEK,
						'NIPKASEK'		=> $NIPKASEK,
						'KEPUTUSAN'		=> $KEPUTUSAN,
						'NAIK'			=> $NAIK,
					]);
					$NOMOR++;
				}
			}
		}
		$datarapot 	= Rapotan::where('marking', 'LIKE', $markingguru.'%')->get();
		if (!empty($datarapot)){
			foreach($datarapot as $rdata){
				$datakelas[] = array(
					'id' 			=> $rdata->id,
					'NOMOR' 		=> $rdata->NOMOR,
					'NAMA' 			=> $rdata->NAMA,
					'NISN'			=> $rdata->NISN,
					'NAMASD'		=> $rdata->NAMASD,
					'ALAMAT'		=> $rdata->ALAMAT,
					'KELAS'			=> $rdata->KELAS,
					'SEMESTER'		=> $rdata->SEMESTER,
					'TAPEL'			=> $rdata->TAPEL,
					'JENIS'			=> $rdata->JENIS,
					'SSP'			=> $rdata->SSP,
					'DES'			=> $rdata->DES,
					'SS'			=> $rdata->SS,
					'DES2'			=> $rdata->DES2,
					'PAI3'			=> $rdata->PAI3,
					'H'				=> $rdata->H,
					'D'				=> $rdata->D,
					'PAI4'			=> $rdata->PAI4,
					'H2'			=> $rdata->H2,
					'D2'			=> $rdata->D2,
					'PPKN3'			=> $rdata->PPKN3,
					'H3'			=> $rdata->H3,
					'D3'			=> $rdata->D3,
					'PPKN4'			=> $rdata->PPKN4,
					'H4'			=> $rdata->H4,
					'D4'			=> $rdata->D4,
					'BI3'			=> $rdata->BI3,
					'H5'			=> $rdata->H5,
					'D5'			=> $rdata->D5,
					'BI4'			=> $rdata->BI4,
					'H6'			=> $rdata->H6,
					'D6'			=> $rdata->D6,
					'MAT3'			=> $rdata->PAI3,
					'H7'			=> $rdata->H7,
					'D7'			=> $rdata->D7,
					'MAT4'			=> $rdata->MAT4,
					'H8'			=> $rdata->H8,
					'D8'			=> $rdata->D8,
					'IPA3'			=> $rdata->IPA3,
					'H9'			=> $rdata->H9,
					'D9'			=> $rdata->D9,
					'IPA4'			=> $rdata->IPA4,
					'H10'			=> $rdata->H10,
					'D10'			=> $rdata->D10,
					'IPS3'			=> $rdata->IPS3,
					'H11'			=> $rdata->H11,
					'D11'			=> $rdata->D11,
					'IPS4'			=> $rdata->IPS4,
					'H12'			=> $rdata->H12,
					'D12'			=> $rdata->D12,
					'SBDP3'			=> $rdata->SBDP3,
					'H13'			=> $rdata->H13,
					'D13'			=> $rdata->D13,
					'SBDP4'			=> $rdata->SBDP4,
					'H14'			=> $rdata->H14,
					'D14'			=> $rdata->D14,
					'PJOK3'			=> $rdata->PJOK3,
					'H15'			=> $rdata->H15,
					'D15'			=> $rdata->D15,
					'PJOK4'			=> $rdata->PJOK4,
					'H16'			=> $rdata->H16,
					'D16'			=> $rdata->D16,
					'BJ3'			=> $rdata->BJ3,
					'H17'			=> $rdata->H17,
					'D17'			=> $rdata->D17,
					'BJ4'			=> $rdata->BJ4,
					'H18'			=> $rdata->H18,
					'D18'			=> $rdata->D18,
					'BING3'			=> $rdata->BING3,
					'H19'			=> $rdata->H19,
					'D19'			=> $rdata->D19,
					'BING4'			=> $rdata->BING4,
					'H20'			=> $rdata->H20,
					'D20'			=> $rdata->D20,
					'BA3'			=> $rdata->BA3,
					'H21'			=> $rdata->H21,
					'D21'			=> $rdata->D21,
					'BA4'			=> $rdata->BA4,
					'H22'			=> $rdata->H22,
					'D22'			=> $rdata->D22,
					'TIK3'			=> $rdata->TIK3,
					'H23'			=> $rdata->H23,
					'D23'			=> $rdata->D23,
					'TIK4'			=> $rdata->TIK4,
					'H24'			=> $rdata->H24,
					'D24'			=> $rdata->D24,
					'EKS'			=> $rdata->EKS,
					'K'				=> $rdata->K,
					'EKS2'			=> $rdata->EKS2,
					'K2'			=> $rdata->K2,
					'EKS3'			=> $rdata->EKS3,
					'K3'			=> $rdata->K3,
					'EKS4'			=> $rdata->EKS4,
					'K4'			=> $rdata->K4,
					'EKS5'			=> $rdata->EKS5,
					'K5'			=> $rdata->K5,
					'SARAN'			=> $rdata->SARAN,
					'TBS1'			=> $rdata->TBS1,
					'TBS2'			=> $rdata->TBS2,
					'BBS1'			=> $rdata->BBS1,
					'BBS2'			=> $rdata->BBS2,
					'KETPD'			=> $rdata->KETPD,
					'KETPL'			=> $rdata->KETPL,
					'KETGG'			=> $rdata->KETGG,
					'KETL'			=> $rdata->KETL,
					'PRETASI1'		=> $rdata->PRETASI1,
					'KET'			=> $rdata->KET,
					'PRETASI2'		=> $rdata->PRETASI2,
					'KET2'			=> $rdata->KET2,
					'PRETASI3'		=> $rdata->PRETASI3,
					'KET3'			=> $rdata->KET3,
					'PRETASI4'		=> $rdata->PRETASI4,
					'KET4'			=> $rdata->KET4,
					'SAKIT'			=> $rdata->SAKIT,
					'IZIN'			=> $rdata->IZIN,
					'TANPA'			=> $rdata->TANPA,
					'TGLRAPOR'		=> $rdata->TGLRAPOR,
					'GURUKLS'		=> $rdata->GURUKLS,
					'NIPGURU'		=> $rdata->NIPGURU,
					'KASEK'			=> $rdata->KASEK,
					'NIPKASEK'		=> $rdata->NIPKASEK,
					'KEPUTUSAN'		=> $rdata->KEPUTUSAN,
					'NAIK'			=> $rdata->NAIK,
				);
			}
		}
		echo json_encode($datakelas);
	}
	public function jsonDataabsenekskul(Request $request) {
		$idekskul 	= $request->val01;
		$tapel 		= $request->val02;
		$arrpresensi= [];
		$sql		= null;
		$homebase	= url("/");
		if ($tapel == 'alquran'){
			$getidandtapel 	= explode('TAPEL', $idekskul);
			$jilid			= $getidandtapel[0];
			$tapel 			= $getidandtapel[1];
			$sql 			= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jilid', $jilid)->get();
		} else {
			$getnama	= Ekstrakulikuler::where('id', $idekskul)->first();
			if (isset($getnama->nama)){
				$set01 	= $getnama->nama;
				$sql 	= DB::table('db_setkeuangan')
							->join('db_datainduk', 'db_setkeuangan.noinduk', 'db_datainduk.noinduk')
							->where('db_setkeuangan.id_sekolah', session('sekolah_id_sekolah'))
							->where('db_datainduk.nokelulusan', '')
							->where(function ($query) use ($set01) {
							$query->where('db_setkeuangan.eksul1', $set01)
								->orWhere('db_setkeuangan.eksul2', $set01)
								->orWhere('db_setkeuangan.eksul3', $set01)
								->orWhere('db_setkeuangan.eksul4', $set01)
								->orWhere('db_setkeuangan.eksul5', $set01);
						})->get();
			}
			
		}
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$nama 		= $hasil->nama;
				$noinduk 	= $hasil->noinduk;
				$kelas 		= $hasil->klspos;
				$masuk		= '';
				$ijin		= '';
				$alpha		= '';
				$sakit		= '';
				$foto 		= $hasil->foto;
				if ($foto == ''){
					$lampiran	= '<img src="'.$homebase.'/boxed-bg.jpg" height="35">';
				} else {
					if (File::exists(base_path() ."/public/dist/img/foto/". $foto)) {
						$lampiran	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="35">';
					} else {
						$lampiran	= '<img src="'.$homebase.'/boxed-bg.jpg" height="35">';
					}
				}
				if ($request->val02 == 'persiswa'){
					$mskaktif 	= Datanilai::where('noinduk', $noinduk)->where('nilai', '1')->count();
					$msknonakt 	= Datanilai::where('noinduk', $noinduk)->where('nilai', '4')->count();
					$ijin 		= Datanilai::where('noinduk', $noinduk)->where('nilai', '2')->count();
					$sakit 		= Datanilai::where('noinduk', $noinduk)->where('nilai', '3')->count();
					$alpha 		= Datanilai::where('noinduk', $noinduk)->where('nilai', '0')->count();
				} else {
					$mskaktif 	= Datanilai::where('kelas', $kelas)->where('noinduk', $noinduk)->where('nilai', '1')->count();
					$msknonakt 	= Datanilai::where('kelas', $kelas)->where('noinduk', $noinduk)->where('nilai', '4')->count();
					$ijin 		= Datanilai::where('kelas', $kelas)->where('noinduk', $noinduk)->where('nilai', '2')->count();
					$sakit 		= Datanilai::where('kelas', $kelas)->where('noinduk', $noinduk)->where('nilai', '3')->count();
					$alpha 		= Datanilai::where('kelas', $kelas)->where('noinduk', $noinduk)->where('nilai', '0')->count();
				}
				$arrpresensi[] = array(
					'id' 		=> $hasil->id,
					'nama' 		=> $hasil->nama,
					'noinduk' 	=> $noinduk,
					'kelas'		=> $kelas,
					'mskaktif'	=> $mskaktif,
					'msknonakt'	=> $msknonakt,
					'ijin'		=> $ijin,
					'alpha'		=> $alpha,
					'sakit'		=> $sakit,
					'foto'		=> $lampiran,
					'tapel'		=> $tapel,
				);
			}
		}
		echo json_encode($arrpresensi);
	}
	public function jsonSetoranTahfid(Request $request) {
		$jilid 		= $request->val01;
		$tapel 		= $request->val02;
		$jenis 		= $request->val03;
		$arrpresensi= [];
		$sql		= null;
		$homebase	= url("/");
		if (Session('previlage') == 'ortu'){
			if ($jenis == 'last'){
				$sql			= Datainduk::where('kodeortu', Session('id'))->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->get();
			} else {
				$arrpresensi 	= Datasetorantahfid::where('noinduk', $jilid)->where('id_sekolah',  Session('sekolah_id_sekolah'))->orderBy('tanggal', 'DESC')->get();
				$sql 			= null;
			}
		} else {
			if ($jenis == 'individu'){
				$arrpresensi 	= Datasetorantahfid::where('noinduk', $jilid)->where('id_sekolah',  Session('sekolah_id_sekolah'))->orderBy('tanggal', 'DESC')->get();
				$sql 			= null;
			} else if ($jenis == 'arsipujianalquran'){
				$pencarian 	= $request->val04;
				$i 			= 0;
				if ($pencarian == '' OR is_null($pencarian)){
					if (Session('previlage') == 'level1' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka AlQuran' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3' OR Session('previlage') == 'level4' OR Session('previlage') == 'Guru AlQuran'){
						$getnoinduk	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->groupBy('noinduk')->orderByRaw('CONVERT(noinduk, UNSIGNED) ASC')->get();
						if (!empty($getnoinduk)){
							foreach($getnoinduk as $rows){
								$datapernoinduk	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->where('noinduk', $rows->noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'created_at', 'namaguru', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
								if (!empty($datapernoinduk)){
									foreach($datapernoinduk as $datarows){
										$arrpresensi[$i] = $datarows;
										$i++;
									}
								}
						
							}
						}
					} else {
						$arrpresensi= MushafUjian::where('niyguru', Session('nip'))->where('id_sekolah',  Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->groupBy('noinduk')->orderByRaw('CONVERT(noinduk, UNSIGNED) ASC')->get();
						if (!empty($getnoinduk)){
							foreach($getnoinduk as $rows){
								$datapernoinduk= MushafUjian::where('niyguru', Session('nip'))->where('id_sekolah',  Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->where('noinduk', $rows->noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'created_at', 'namaguru', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
								if (!empty($datapernoinduk)){
									foreach($datapernoinduk as $datarows){
										$arrpresensi[$i] = $datarows;
										$i++;
									}
								}
						
							}
						}
					}
				} else {
					if (Session('previlage') == 'level1' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka AlQuran' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3' OR Session('previlage') == 'level4' OR Session('previlage') == 'Guru AlQuran'){
						$getnoinduk	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->groupBy('noinduk')->orderByRaw('CONVERT(noinduk, UNSIGNED) ASC')->get();
						if (!empty($getnoinduk)){
							foreach($getnoinduk as $rows){
								if ($pencarian == 'JUZ'){
									$datapernoinduk	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->where('noinduk', $rows->noinduk)->where('tapelsemester', 'NOT LIKE', '%S%')->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'namaguru', 'created_at', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
								} else {
									$datapernoinduk	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->where('noinduk', $rows->noinduk)->where('tapelsemester', 'LIKE', '%'.$pencarian)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'namaguru', 'created_at', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
								}
								if (!empty($datapernoinduk)){
									foreach($datapernoinduk as $datarows){
										$arrpresensi[$i] = $datarows;
										$i++;
									}
								}
						
							}
						}
					} else {
						$arrpresensi= MushafUjian::where('niyguru', Session('nip'))->where('id_sekolah',  Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->groupBy('noinduk')->orderByRaw('CONVERT(noinduk, UNSIGNED) ASC')->get();
						if (!empty($getnoinduk)){
							foreach($getnoinduk as $rows){
								if ($pencarian == 'JUZ'){
									$datapernoinduk= MushafUjian::where('niyguru', Session('nip'))->where('id_sekolah',  Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->where('tapelsemester', 'NOT LIKE', '%S%')->where('noinduk', $rows->noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'namaguru', 'created_at', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
								} else {
									$datapernoinduk= MushafUjian::where('niyguru', Session('nip'))->where('id_sekolah',  Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->where('tapelsemester', 'LIKE', '%'.$pencarian)->where('noinduk', $rows->noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'namaguru', 'created_at', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
								}
								if (!empty($datapernoinduk)){
									foreach($datapernoinduk as $datarows){
										$arrpresensi[$i] = $datarows;
										$i++;
									}
								}
						
							}
						}
					}
				}
				$sql 			= null;
			} else if ($jenis == 'arsipujianlisann'){
				$arrpresensi 	= MushafUjianLisan::where('id_sekolah',  Session('sekolah_id_sekolah'))->where('semester', $request->val02)->where('tapel', $request->val01)->where('kelas', 'LIKE', $request->val04.'%')->get();
				$sql 			= null;
			} else {
				if ($jenis == 'semuakelasujianlisan'){
					$jilid 		= str_replace('grade', '', $jilid);
					$sql 		= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('klspos', 'LIKE', $jilid.'%')->where('nokelulusan', '')->get();
				} else {
					$sql 		= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jilid', $jilid)->where('nokelulusan', '')->get();
				}
			}
		}
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$nama 					= $hasil->nama;
				$noinduk 				= $hasil->noinduk;
				$kelas 					= $hasil->klspos;
				$foto 					= $hasil->foto;
				if ($foto == '' OR $foto == null){
					$foto	= '<img src="'.$homebase.'/'.Session('sekolah_logo').'" height="40">';
				} else {
					$foto	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="40">';
				}
				$ziyadah_nilai			= '';
				$ziyadah_mulaisurah		= '';
				$ziyadah_mulaiayat		= '';
				$ziyadah_akhirsurah		= '';
				$ziyadah_akhirayat		= '';
				
				$murojaah_nilai			= '';
				$murojaah_mulaisurah	= '';
				$murojaah_mulaiayat		= '';
				$murojaah_akhirsurah	= '';
				$murojaah_akhirayat		= '';

				$tilawah_nilai			= '';
				$tilawah_mulaisurah		= '';
				$tilawah_mulaiayat		= '';
				$tilawah_akhirsurah		= '';
				$tilawah_akhirayat		= '';
				
				$tahsin_nilai			= '';
				$tahsin_mulaisurah		= '';
				$tahsin_mulaiayat		= '';
				$tahsin_akhirsurah		= '';
				$tahsin_akhirayat		= '';
				
				$tanggal				= '';
				$inputor 				= '';
				$nilai 					= '';
				$kelulusan 				= '';
				$catatan 				= '';
				$idmurojaah 			= $request->val04;
				if ($request->val03 == 'murojaahdirumah'){
					$tanggal				= $request->val02;
					$murojaah_akhirsurah	= $request->val05;
					$ceklastdata			= Datasetorantahfid::where('noinduk', $noinduk)->where('id_sekolah', $hasil->id_sekolah)->where('tanggal', $request->val02)->where('marking', 'LIKE', 'PR-%')->first();
					$nilai 					= $ceklastdata->murojaah_nilai ?? '';
					$kelulusan 				= $ceklastdata->murojaah_predikat ?? '-';
					$ceksplit 				= explode('s/d', $murojaah_akhirsurah);
					if (isset($ceksplit[1])){
						$murojaah_mulaiayat	= $ceksplit[0];
						$murojaah_akhirayat	= $ceksplit[1];
					} else {
						$murojaah_mulaiayat	= $ceklastdata->murojaah_mulaiayat ?? '';
						$murojaah_akhirayat	= $ceklastdata->murojaah_akhirayat ?? '';
					}
				} else if ($request->val03 == 'murojaahdisekolah'){
					$tanggal				= $request->val02;
					$ceklastdata			= Datasetorantahfid::where('marking', $hasil->id_sekolah.'_'.$noinduk.'_'.$tanggal)->first();
					$murojaah_akhirsurah	= $ceklastdata->murojaah_akhirsurah ?? '';
					$murojaah_mulaiayat		= $ceklastdata->murojaah_mulaiayat ?? '';
					$murojaah_akhirayat		= $ceklastdata->murojaah_akhirayat ?? '';
				} else {
					$ceklastdata			= Datasetorantahfid::where('noinduk', $noinduk)->where('id_sekolah', $hasil->id_sekolah)->orderBy('tanggal', 'DESC')->first();
					$tanggal				= $ceklastdata->tanggal ?? '';
					$murojaah_akhirsurah	= $ceklastdata->murojaah_akhirsurah ?? '';
					$murojaah_mulaiayat		= $ceklastdata->murojaah_mulaiayat ?? '';
					$murojaah_akhirayat		= $ceklastdata->murojaah_akhirayat ?? '';
				}
				$arrpresensi[] = array(
					'id' 					=> $hasil->id,
					'nama' 					=> $hasil->nama,
					'jilid' 				=> $hasil->jilid,
					'noinduk' 				=> $hasil->noinduk,
					'kelas'					=> $hasil->klspos,
					'tmplahir'				=> $hasil->tmplahir,
					'tgllahir'				=> $hasil->tgllahir,
					'foto'					=> $foto,
					'tapel'					=> $tapel,
					'tanggal' 				=> $tanggal,
                    'ziyadah_nilai' 		=> $ceklastdata->ziyadah_nilai ?? '',
                    'ziyadah_predikat' 		=> $ceklastdata->ziyadah_predikat ?? '',
                    'ziyadah_mulaisurah' 	=> $ceklastdata->ziyadah_mulaisurah ?? '',
                    'ziyadah_mulaiayat' 	=> $ceklastdata->ziyadah_mulaiayat ?? '',
                    'ziyadah_akhirsurah' 	=> $ceklastdata->ziyadah_akhirsurah ?? '',
                    'ziyadah_akhirayat' 	=> $ceklastdata->ziyadah_akhirayat ?? '',
                    'murojaah_nilai' 		=> $ceklastdata->murojaah_nilai ?? '',
                    'murojaah_predikat' 	=> $ceklastdata->murojaah_predikat ?? '',
                    'murojaah_mulaisurah' 	=> $ceklastdata->murojaah_mulaisurah ?? '',
                    'murojaah_mulaiayat' 	=> $murojaah_mulaiayat,
                    'murojaah_akhirsurah' 	=> $murojaah_akhirsurah,
                    'murojaah_akhirayat' 	=> $murojaah_akhirayat,
                    'tilawah_nilai' 		=> $ceklastdata->tilawah_nilai ?? '',
                    'tilawah_predikat' 		=> $ceklastdata->tilawah_predikat ?? '',
                    'tilawah_mulaisurah' 	=> $ceklastdata->tilawah_mulaisurah ?? '',
                    'tilawah_mulaiayat' 	=> $ceklastdata->tilawah_mulaiayat ?? '',
                    'tilawah_akhirsurah' 	=> $ceklastdata->tilawah_akhirsurah ?? '',
                    'tilawah_akhirayat' 	=> $ceklastdata->tilawah_akhirayat ?? '',
                    'tahsin_nilai' 			=> $ceklastdata->tahsin_nilai ?? '',
                    'tahsin_predikat' 		=> $ceklastdata->tahsin_predikat ?? '',
                    'tahsin_mulaisurah' 	=> $ceklastdata->tahsin_mulaisurah ?? '',
                    'tahsin_mulaiayat' 		=> $ceklastdata->tahsin_mulaiayat ?? '',
                    'tahsin_akhirsurah' 	=> $ceklastdata->tahsin_akhirsurah ?? '',
                    'tahsin_akhirayat' 		=> $ceklastdata->tahsin_akhirayat ?? '',
					'inputor' 				=> $ceklastdata->inputor ?? '',
					'nilai' 				=> $nilai,
					'kelulusan' 			=> $kelulusan,
					'catatan' 				=> $ceklastdata->catatan ?? '',
                	'idmurojaah' 			=> $idmurojaah
                );
			}
		}
		echo json_encode($arrpresensi);
	}
	public function jsonPresensiekskulcari(Request $request) {
		$noinduk 		= $request->val01;
		$tapel 			= $request->val02;
		$idekskul 		= $request->val03;
		$arrpresensi	= [];
		$homebase		= url("/");
		$sql 			= Datanilai::where('tapel', $tapel)->where('noinduk', $noinduk)->where('kodekd', $idekskul)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$noinduk	= $hasil->noinduk;
				$status		= $hasil->nilai;
				if ($status == '1'){
					$alasan = 'Hadir dan Tepat Waktu';
				} else if ($status == '4'){
					$alasan = 'Hadir Namun Kurang Aktif';
				} else if ($status == '2'){
					$alasan = 'IJIN';
				} else if ($status == '3'){
					$alasan = 'SAKIT';
				} else {
					$alasan = 'ALPHA';
				}
				$arrpresensi[] = array(
					'id'		=> $hasil->id,
					'tanggal'	=> $hasil->tanggal,
					'nama'		=> $hasil->nama,
					'noinduk'	=> $hasil->noinduk,
					'tapel'		=> $hasil->tapel,
					'kelas'		=> $hasil->kelas,
					'nilai'		=> $hasil->nilai,
					'deskripsi'	=> $hasil->deskripsi,
					'alasan'	=> $alasan,
				);
			}
		}
		echo json_encode($arrpresensi);
	}
	public function viewKonseling() {
		$tasks						= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'Waka Kurikulum' OR Session('previlage') == 'Waka Kurikulum Al Quran' OR Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level3' OR Session('previlage') == 'Guru AlQuran' OR Session('previlage') == 'Waka AlQuran'){
			$sekolah	= Session('sekolah_id_sekolah');
			$tahunne	= date("Y");
			$jgroupps	= DB::table('db_tatib')->groupBy('kelompok')->select('kelompok')->orderBy('kelompok')->get();
			$i			= 0;
			foreach ($jgroupps as $rgrpklas) {
				$j  			= 0;
				$kelompok		= $rgrpklas->kelompok;
				$jklas  		= DB::table('db_tatib')->where('kelompok', $kelompok)->orderBy('kode', 'ASC')->get();
				foreach ($jklas as $rklas) {
					$tasks['tatiblists'][$i][$j]['id']			=   $rklas->id;
					$tasks['tatiblists'][$i][$j]['kelompok']	=   $rklas->kelompok;
					$tasks['tatiblists'][$i][$j]['kode']		=   $rklas->kode;
					$tasks['tatiblists'][$i][$j]['deskripsi']	=   $rklas->deskripsi;
					$tasks['tatiblists'][$i][$j]['point']		=   $rklas->point;
					$j++;
				}
				$i++;
			}
			$x  = 0;
			foreach ($jgroupps as $kgrpklas) {
				$tasks['tatibkelompok'][$x]  	= $kgrpklas->kelompok;
				$x++;
			}
			if ($i == 0){
				$tasks['tatibkelompok'][0]  			=   '-';
				$tasks['tatiblists'][0][0]['kelompok']	=   'No Data';
				$tasks['tatiblists'][0][0]['kode']		=   'No Data';
				$tasks['tatiblists'][0][0]['deskripsi']	=   'No Data';
				$tasks['tatiblists'][0][0]['point']		=   'No Data';
				$tasks['tatiblists'][0][0]['id']		=   '0';
			}
			$tasks['tahunne']			= $tahunne;
			$tasks['tanggal']			= date("d-m-Y");
			$tasks['countbelum']		= Konseling::where('id_sekolah', $sekolah)->whereNull('hasil')->whereYear('tglmasalah', $tahunne)->count();
			$tasks['countpemantauan']	= Konseling::where('id_sekolah', $sekolah)->where('hasil', 'Dalam Pemantauan')->whereYear('tglmasalah', $tahunne)->count();
			$tasks['datasiswa']			= Datainduk::where('id_sekolah', $sekolah)->where('nokelulusan', '')->get();
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']			= 'konseling';
			if(Session('sekolah_level') == 1){
				return view('simaster.konselingtpq', $tasks);
			} else {
				return view('simaster.konseling', $tasks);
			}
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
        	$tasks['kalimatbody']  		= 'Anda Tidak di ijinkan masuk ke laman ini, silahkan kembali ke laman sebelumnya';
            return view('errors.notready', $tasks);
        }
	}
	public function jsonKonselingthnini() {
		$arrrekap 		= [];
		$tahun			= date("Y");
		$getallthn 	    = Konseling::where('id_sekolah', Session('sekolah_id_sekolah') )->whereYear('tglmasalah', $tahun)->groupBy('kelas')->get();
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$kelas	= $rdatane->kelas;
				$total 	= Konseling::where('id_sekolah', Session('sekolah_id_sekolah') )->whereYear('tglmasalah', $tahun)->where('kelas', $kelas)->count();
				$arrrekap[] 	= array(
					'jenis' 	=> $kelas,
					'jumlah' 	=> $total,
				);
			}
		}
		echo json_encode($arrrekap);
	}
	public function jsonKonselingperbidang() {
		$arrrekap 	= [];
		$tahun		= date("Y");
		$getallthn 	= Konseling::where('id_sekolah', Session('sekolah_id_sekolah') )->whereYear('tglmasalah', $tahun)->groupBy('jenis')->get();
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$jenis		= $rdatane->jenis;
				$total 		= Konseling::where('id_sekolah', Session('sekolah_id_sekolah') )->whereYear('tglmasalah', $tahun)->where('jenis', $jenis)->count();
				$arrrekap[] 	= array(
					'jenis' 	=> $jenis,
					'jumlah' 	=> $total,
				);
			}
		}
		echo json_encode($arrrekap);
	}
	public function exSimpankonseling(Request $request) {
		$idne			= $request->val01;
		$hasil			= $request->val02;
		$tindaklanjut	= $request->val03;
		$layanan		= $request->val04;
		$tgltangani		= $request->val05;
		$tanggal		= $request->val06;
		$jenis			= $request->val07;
		$kategori		= $request->val08;
		$deskripsi		= $request->val09;
		$noinduk		= $request->val10;
		$valkerja		= $request->val11;
		if ($noinduk == 'pegawai'){
			$niy		= $request->val11;
			$getnama 	= Dataindukstaff::where('niy', $niy)->first();
			if (isset($getnama->nama)){
				$nama 	= $getnama->nama;
			} else {
				$nama 	= 'Unkown';
			}
			if ($idne == 'new'){
				$cekdata = Konselingguru::where('niy', $niy)->where('tglmasalah', $tanggal)->where('jenis', $jenis)->count();
				if ($cekdata != 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
					return back();
				} else {
					$input = Konselingguru::create([
						'niy'			=> $niy,
						'nama'			=> $nama,
						'deskripsi'		=> $deskripsi,
						'tglmasalah'	=> $tanggal,
						'jenis'			=> $jenis,
						'kategori'		=> $kategori,
						'tglpenanganan'	=> $tgltangani,
						'layanan'		=> $layanan,
						'tindaklanjut'	=> $tindaklanjut,
						'hasil'			=> $hasil,
						'pembimbing'	=> Session('nama'),
						'id_sekolah'	=> Session('sekolah_id_sekolah')
						
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Konseling Telah di Tambahkan']);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
						return back();
					}
				}
			} else {
				$cekdata = Konselingguru::where('id', '!=', $idne)->where('niy', $niy)->where('tglmasalah', $tanggal)->where('jenis', $jenis)->count();
				if ($cekdata != 0){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
					return back();
				} else {
					$input = Konselingguru::where('id', $idne)->update([
						'niy'			=> $niy,
						'nama'			=> $nama,
						'deskripsi'		=> $deskripsi,
						'tglmasalah'	=> $tanggal,
						'jenis'			=> $jenis,
						'kategori'		=> $kategori,
						'tglpenanganan'	=> $tgltangani,
						'layanan'		=> $layanan,
						'tindaklanjut'	=> $tindaklanjut,
						'hasil'			=> $hasil,
						'pembimbing'	=> Session('nama'),
						'updated_at'	=> date("Y-m-d H:i:s")
					]);
					if ($input){	
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Konseling Telah di Update']);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Update Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
						return back();
					}
				}
			}
		} else if ($noinduk == 'getdatabimguru'){
			$cekdata = Konselingguru::where('id', $valkerja)->first();
			return $cekdata;
				
		} else {
			$getkelas		= Datainduk::where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah') )->first();
			if (isset($getkelas->klspos)){
				$kelas 		= $getkelas->klspos;
				$nama 		= $getkelas->nama;
			} else { $kelas = ''; $nama = '';}
			
			if ($valkerja == 'hapus'){
				$getdata 	= Konseling::where('id', $idne)->first();
				$hapus 		= Konseling::where('id', $idne)->delete();
				if ($hapus){
					$deskripsi 	= Session('nama').' Menghapus data Konseling '.$getdata->nama.' No.Induk : '.$getdata->noinduk.' Deskripsi '.$getdata->deskripsi.' Tgl Kejadian '.$getdata->tglmasalah;
					Logstaff::create([
						'jenis'		=> 'Menghapus data konseling',
						'sopo'		=> Session('nip'),
						'kelakuan'	=> $deskripsi,
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Konseling Telah di Hapus']);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
					return back();
				}
			} else {
				if ($nama == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No Induk Tidak di Temukan']);
					return back();
				} else {
					if ($idne == 'new'){
						$cekdata = Konseling::where('noinduk', $noinduk)->where('tglmasalah', $tanggal)->where('jenis', $jenis)->count();
						if ($cekdata != 0){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
							return back();
						} else {
							$input = Konseling::create([
								'noinduk'		=> $noinduk,
								'nama'			=> $nama,
								'kelas'			=> $kelas,
								'deskripsi'		=> $deskripsi,
								'tglmasalah'	=> $tanggal,
								'jenis'			=> $jenis,
								'kategori'		=> $kategori,
								'tglpenanganan'	=> $tgltangani,
								'layanan'		=> $layanan,
								'tindaklanjut'	=> $tindaklanjut,
								'hasil'			=> $hasil,
								'guru'			=> Session('nip'),
								'id_sekolah'	=> Session('sekolah_id_sekolah')
								
							]);
							if ($input){
								return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Konseling Telah di Tambahkan']);
								return back();
							}else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
								return back();
							}
						}
					} else {
						$cekdata = Konseling::where('id', '!=', $idne)->where('noinduk', $noinduk)->where('tglmasalah', $tanggal)->where('jenis', $jenis)->count();
						if ($cekdata != 0){
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
							return back();
						} else {
							$input = Konseling::where('id', $idne)->update([
								'noinduk'		=> $noinduk,
								'nama'			=> $nama,
								'kelas'			=> $kelas,
								'deskripsi'		=> $deskripsi,
								'tglmasalah'	=> $tanggal,
								'jenis'			=> $jenis,
								'kategori'		=> $kategori,
								'tglpenanganan'	=> $tgltangani,
								'layanan'		=> $layanan,
								'tindaklanjut'	=> $tindaklanjut,
								'hasil'			=> $hasil,
								'guru'			=> Session('nip'),
								'updated_at'	=> date("Y-m-d H:i:s")
							]);
							if ($input){	
								return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Konseling Telah di Update']);
								return back();
							}else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Update Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
								return back();
							}
						}
					}
				}
			}
		}
	}
	public function jsonAlldatakonseling(Request $request) {
		$bulan   	= $request->val01;
		$tahun   	= $request->val02;
		$tahunini	= date("Y");
		
		if ($bulan == 'BULANINI'){
			$bulan 		= date("m");
			$bulan		= sprintf("% 02s", $bulan);
			$valcari	= $tahunini.'-'.$bulan.'-%';
			$getallthn 	= Konseling::where('id_sekolah', Session('sekolah_id_sekolah') )->where('tglmasalah', 'LIKE', $valcari)->get();
		} else if($bulan == 'ALL'){
			$getallthn 	= Konseling::where('id_sekolah', Session('sekolah_id_sekolah') )->where('tglmasalah', 'LIKE', '%'.$tahun.'%')->get();
		} else {
			$valcari	= $tahun.'-'.$bulan.'-%';
			$getallthn 	= Konseling::where('id_sekolah', Session('sekolah_id_sekolah') )->where('tglmasalah', 'LIKE', $valcari)->get();
		}
		$alldata 	= [];
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$tlsjenis 		= $rdatane->getDesTatib->deskripsi ?? 'Masalah Lainnya';
				$alldata[] 		= array(
					'id'			=> $rdatane->id,
					'noinduk'		=> $rdatane->noinduk,
					'nama'			=> $rdatane->nama,
					'kelas'			=> $rdatane->kelas,
					'deskripsi'		=> $rdatane->deskripsi,
					'tglmasalah'	=> $rdatane->tglmasalah,
					'jenis'			=> $rdatane->jenis,
					'kategori'		=> $rdatane->kategori,
					'tglpenanganan'	=> $rdatane->tglpenanganan,
					'layanan'		=> $rdatane->layanan,
					'tindaklanjut'	=> $rdatane->tindaklanjut,
					'hasil'			=> $rdatane->hasil,
					'tlsjenis'		=> $tlsjenis,
					'guru'			=> $rdatane->guru,
					
				);
			}
		}
		echo json_encode($alldata);
    }
	public function exInputabsenekskul(Request $request) {
    	$kegiatan		= $request->absen_kegiatan;
		$tanggal		= $request->presensi_tanggal;
		$smt			= $request->absen_semester;
		$tapel			= $request->presensi_tapel;
		$jenis			= $request->absen_jenis;
		$idne			= $request->absen_idne;
		$jnilai			= $request->nilai;
		$iduser			= Session('id');
		$inputor		= Session('nama');
		$sukses   		= 0;
		$gagal    		= '';
		$tanggalmark	= $tanggal;
		if ($jenis == 'TAHFIDZ'){
			$deskripsi	= $jenis.' Jilid '.$idne;
			$jennilai	= $jenis;
		} else {
			$getnama		= Ekstrakulikuler::where('id', $idne)->first();
			if (isset($getnama->nama)){
				$deskripsi 	= $getnama->nama;
			} else {
				$deskripsi	= $jenis.' ID '.$idne;
			}
		}
		if ($jenis == '' OR is_null($jenis)){
			$jenis		= 'Ekstrakurikuler';
		}
		$kelas 			= $idne;
		$markingguru	= $tapel.'-'.$smt.'-Eks'.$idne.'-'.Session('nip').'-'.$tanggalmark.'-'.$jenis;
		foreach ( $jnilai as $datanilai ){
			$nilai 		= $datanilai['nilainya'];
			$noinduk	= $datanilai['noinduk'];
			$nama		= $datanilai['namanya'];
			$kelas 		= $datanilai['kelas'];
			$marking 	= $markingguru.'-'.$noinduk;
			$ceksudah 	= Datanilai::where('marking', $marking)->count();
			$data 		= [
				'noinduk' 	=> $noinduk,
				'nama' 		=> $nama,
				'kelas' 	=> $kelas,
				'tapel' 	=> $tapel,
				'semester' 	=> $smt,
				'kodekd' 	=> $idne,
				'matpel' 	=> $deskripsi,
				'penginput' => Session('nip'),
				'tanggal' 	=> date("Y-m-d H:i:s"),
				'jennilai' 	=> $jenis,
				'marking' 	=> $marking,
				'deskripsi' => $kegiatan,
				'id_sekolah'=> session('sekolah_id_sekolah')
			];
			if ($ceksudah == 0) {
				if ($nilai == '') {
					$data['tema'] 		= '0';
					$data['subtema'] 	= '0';
					$data['nilai'] 		= '';
					$data['kkm'] 		= '0';
				} else {
					$data['nilai'] = $nilai;
				}
				$update = Datanilai::create($data);
				if ($update) {
					$sukses++;
				} else {
					$gagal .= 'Gagal Input Nilai Untuk No.Induk ' . $noinduk . '<br />';
				}
			} else {
				$gagal .= 'Gagal Input Nilai Untuk No.Induk ' . $noinduk . ' Data Sudah Ada<br />';
			}
		}
		$ceksudah	= Loginputnilai::where('marking', $markingguru)->count();
		if ($ceksudah == 0){
			Loginputnilai::create([
				'niy'		=> Session('nip'),
				'tanggal'	=> $tanggalmark,
				'tema'		=> '',
				'subtema'	=> '',
				'matpel'	=> $deskripsi,
				'kodekd'	=> $idne,
				'kelas'		=> $kelas,
				'tapel'		=> $tapel,
				'jennilai'	=> $jenis,
				'semester'	=> $smt,
				'marking'	=> $markingguru,
				'id_sekolah'=> session('sekolah_id_sekolah')
			]);
		}
		if ($gagal == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Update Data Presensi Tanggal '.$tanggal.' Sejumlah '.$sukses.' Siswa']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
			return back();
		}
	
	}
	public function exInputnilaiekskul(Request $request) {
    	$kegiatan		= 'Penilaian';
		$tanggal		= date('Y-m-d');
		$smt			= $request->nilai_semester;
		$tapel			= $request->nilai_tapel;
		$jenis			= $request->nilai_jenis;
		$idne			= $request->nilai_idne;
		$jnilai			= $request->nilai;
		$iduser			= Session('id');
		$inputor		= Session('nama');
		$sukses   		= 0;
		$gagal    		= '';
		$tanggal		= date("Y-m-d h:s:m");
		$tanggalmark	= date("Y-m-d");
		if ($jenis == 'TAHFIDZ'){
			$deskripsi	= $jenis.' Jilid '.$idne;
		} else {
			$getnama		= Ekstrakulikuler::where('id', $idne)->first();
			if (isset($getnama->nama)){
				$deskripsi 	= $getnama->nama;
			} else {
				$deskripsi	= $jenis.' ID '.$idne;
			}
		}
		if ($jenis == 'PTS'){
			$smt = $smt.'.1';
		} else {
			$smt = $smt.'.2';
		}
		$kelas			= $idne;
		$markingguru	= $tapel.'-'.$smt.'-Eks'.$idne.'-'.Session('nip').'-'.$tanggalmark.'-'.$jenis;
		foreach ($jnilai as $datanilai) {
			$nilai 		= $datanilai['nilainya'];
			$noinduk 	= $datanilai['noinduk'];
			$nama 		= $datanilai['namanya'];
			$kelas 		= $datanilai['kelas'];
			$nisn 		= $datanilai['nisn'];
			$alamat 	= $datanilai['alamat'];
			$foto 		= $datanilai['foto'];
			$urutan 	= $datanilai['urutan'];
			$namaekskul = $datanilai['namaekskul'];
			$marking	= $tapel.'-'.$smt.'-'.$kelas.'-'.Session('nip').'-DIRI'.'-'.$noinduk;
			if ($jenis == 'PTS' || $jenis == 'PAS') {
				if ($urutan >= 1 && $urutan <= 5) {
					$update = Rapotan::updateOrCreate(
						[
							'noinduk' 		=> $noinduk,
							'semester' 		=> $smt,
							'tapel' 		=> $tapel,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						],
						[
							"nildeskripsieks{$urutan}" 		=> $nilai,
							"ekstrakulikuler{$urutan}" 		=> $namaekskul,
							'marking'						=> $marking,
						]
					);
				}
			} else {
				$ceksudah = Datanilai::where('marking', $marking)->count();
				$data = [
					'noinduk' 		=> $noinduk,
					'nama' 			=> $nama,
					'kelas' 		=> $kelas,
					'tapel' 		=> $tapel,
					'semester' 		=> $smt,
					'kodekd' 		=> $idne,
					'matpel' 		=> $deskripsi,
					'penginput' 	=> Session('nip'),
					'tanggal' 		=> date("Y-m-d H:i:s"),
					'jennilai' 		=> $jenis,
					'marking' 		=> $marking,
					'deskripsi' 	=> $kegiatan,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				];
				if ($ceksudah == 0) {
					if ($nilai == '') {
						$data['tema'] 		= '0';
						$data['subtema'] 	= '0';
						$data['nilai'] 		= '';
						$data['kkm'] 		= '0';
					} else {
						$data['nilai'] 		= $nilai;
						if ($jenis == 'PTS' || $jenis == 'PAS'){
							$data['catatan'] = $nilai;
						}
					}
					$update = Datanilai::create($data);
				} else {
					$gagal .= 'Gagal Input Nilai Untuk No.Induk ' . $noinduk . ' Data Sudah Ada<br />';
				}
				if ($update) {
					$sukses++;
				} else {
					$gagal .= 'Gagal Input Nilai Untuk No.Induk ' . $noinduk . '<br />';
				}
			}
		}
		$ceksudah	= Loginputnilai::where('marking', $markingguru)->count();
		if ($ceksudah == 0){
			Loginputnilai::create([
				'niy'		=> Session('nip'),
				'tanggal'	=> $tanggal,
				'tema'		=> '',
				'subtema'	=> '',
				'matpel'	=> $deskripsi,
				'kodekd'	=> '',
				'kelas'		=> $kelas,
				'tapel'		=> $tapel,
				'jennilai'	=> $jenis,
				'semester'	=> $smt,
				'marking'	=> $markingguru,
				'id_sekolah'=> session('sekolah_id_sekolah')
			]);
		}
		if ($gagal == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Update Data Nilai Tanggal '.$tanggal.' Sejumlah '.$sukses.' Siswa']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
			return back();
		}
	}
	public function exInputsetoran(Request $request) {
		$getdatauser	= User::where('id', Session('id'))->first();
		if (isset($getdatauser->tapel)){
			$klsajar		= $getdatauser->klsajar;
			$smt 			= $getdatauser->smt;
			$tapel 			= $getdatauser->tapel;
		} else {
			$klsajar		= '';
			$smt 			= '';
			$tapel 			= '';
		}
		if ($tapel == '' OR $tapel == null OR $smt == null OR $smt == ''){
			$getdatauser	= Datasetorantahfid::whereNotNull('tapel')->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('updated_at', 'DESC')->first();
			if (isset($getdatauser->tapel)){
				$tapel 		= $getdatauser->tapel;
				$smt 		= $getdatauser->semester;
			}
		}
		$pesan 			= '';
		$gagal 			= '';
		if (Session('previlage') == 'ortu'){
			$inputor 	= 'ortu';
		} else {
			$inputor 	= Session('nip');
		}
		$noinduk		= $request->setoran_noinduk;
		$kelas			= $request->setoran_kelas;
		$getdatasiswa 	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
		if (isset($getdatasiswa->jilid)){
			$kelas		= $getdatasiswa->jilid;
		}
		$jilid			= $kelas;
		$tanggal		= $request->setoran_tanggal;
		$nama			= $request->setoran_nama;
		$idmurojaah		= $request->idmurojaah;
		if ($idmurojaah == 'fromrpa'){
			$marking 		= session('sekolah_id_sekolah').'_'.$noinduk.'_'.$tanggal;
			$keybengakcrash	= $marking;
			try {
				Datasetorantahfid::updateOrCreate(
					[
						'keybengakcrash'		=> $keybengakcrash,
					],
					[
						'inputor'				=> $inputor,
						'nama'					=> $nama,
						'kelas'					=> $kelas,
						'tapel'					=> $tapel,
						'semester'				=> $smt,
						'jilid'					=> $jilid,
						'noinduk'				=> $noinduk,
						'tanggal'				=> $tanggal,
						'marking'				=> $marking,
						'id_sekolah'			=> session('sekolah_id_sekolah'),
						'ziyadah_mulaisurah'	=> $request->setoran_ziyadahsurahawal,
						'ziyadah_nilai'			=> $request->setoran_ziyadahnilai,
						'ziyadah_predikat'		=> $request->setoran_ziyadahpredikat,
						'murojaah_mulaisurah'	=> $request->setoran_msurahawal,
						'murojaah_nilai'		=> $request->setoran_murojaahnilai,
						'murojaah_predikat'		=> $request->setoran_murojaahpredikat,
						'tilawah_mulaisurah'	=> $request->setoran_tilawahsurahawal,
						'tilawah_nilai'			=> $request->setoran_tilawahnilai,
						'tilawah_predikat'		=> $request->setoran_tilawahpredikat,
						'tahsin'				=> $request->tahsin,
						'tahsin_nilai'			=> $request->setoran_tahsinnilai,
						'tahsin_predikat'		=> $request->setoran_tahsinpredikat,
						'catatan'				=> $request->setoran_catatan,
						'updated_at'			=> date('Y-m-d H:i:s')
					]
				);
				$pesan = 'Halaqoh Sekolah an. '.$nama.' Tanggal '.$tanggal.' Berhasil di Simpan';
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $pesan]);
				return back();
			} catch (\Exception $e) {
				$sendstatus = $e->getMessage();
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $sendstatus]);
				return back();
			}
		} else {
			if ($idmurojaah == null){
				$tempat 		= 'SEKOLAH';
				$marking 		= session('sekolah_id_sekolah').'_'.$noinduk.'_'.$tanggal;
				$keybengakcrash	= $marking;
				$ceksek 		= Datasetorantahfid::where('marking', $marking)->first();
			} else {
				$tempat 		= 'RUMAH';
				$marking 		= 'PR-'.$idmurojaah;
				$keybengakcrash	= session('sekolah_id_sekolah').'_'.$marking.'_'.$noinduk.'_'.$tanggal;
				$ceksek 		= Datasetorantahfid::where('keybengakcrash', $keybengakcrash)->first();
			}
			
			$idziyadahawal 		= $request->setoran_ziyadahsurahawal;
			if ($idziyadahawal == 0 OR $idziyadahawal == '' OR $idziyadahawal == null){
				$setoran_ziyadahsurahawal 	= '';
				$setoran_ziyadahayatawal	= '';
			} else {
				$explodeayat 				= explode('.', $idziyadahawal);
				$setoran_ziyadahsurahawal 	= $explodeayat[0];
				$setoran_ziyadahayatawal	= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_ziyadahsurahawal)->first();
				if (isset($getnamasurah->id)){
					$setoran_ziyadahsurahawal 	= $getnamasurah->surah.' Ayat '.$setoran_ziyadahayatawal;
				}
			}
			$isziyadahsurahakhir 		= $request->setoran_ziyadahsurahakhir;
			if ($isziyadahsurahakhir == 0 OR $isziyadahsurahakhir == '' OR $isziyadahsurahakhir == null){
				$setoran_ziyadahsurahakhir 	= '';
				$isziyadahsurahakhir		= '';
			} else {
				$explodeayat 				= explode('.', $isziyadahsurahakhir);
				$setoran_ziyadahsurahakhir 	= $explodeayat[0];
				$setoran_ziyadahayatakhir	= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_ziyadahsurahakhir)->first();
				if (isset($getnamasurah->id)){
					$setoran_ziyadahsurahakhir 	= $getnamasurah->surah.' Ayat '.$setoran_ziyadahayatakhir;
				}
			}
			$idmsurahawal 		= $request->setoran_msurahawal;
			if ($idmsurahawal == 0 OR $idmsurahawal == '' OR $idmsurahawal == null){
				$setoran_msurahawal 		= '';
				$setoran_mayatawal			= '';
			} else {
				$explodeayat 				= explode('.', $idmsurahawal);
				$setoran_msurahawal 		= $explodeayat[0];
				$setoran_mayatawal			= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_msurahawal)->first();
				if (isset($getnamasurah->id)){
					$setoran_msurahawal 	= $getnamasurah->surah.' Ayat '.$setoran_mayatawal;
				}
			}
			$idmsurahakhir 		= $request->setoran_msurahakhir;
			if ($idmsurahakhir == 0 OR $idmsurahakhir == '' OR $idmsurahakhir == null){
				$setoran_msurahakhir 		= '';
				$setoran_mayatakhir			= '';
			} else {
				$explodeayat 				= explode('.', $idmsurahakhir);
				$setoran_msurahakhir 		= $explodeayat[0];
				$setoran_mayatakhir			= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_msurahakhir)->first();
				if (isset($getnamasurah->id)){
					$setoran_msurahakhir 	= $getnamasurah->surah.' Ayat '.$setoran_mayatakhir;
				}
			}
			$idtilawahayatawal 		= $request->setoran_tilawahsurahawal;
			if ($idtilawahayatawal == 0 OR $idtilawahayatawal == '' OR $idtilawahayatawal == null){
				$setoran_tilawahsurahawal 	= '';
				$idtilawahayatawal			= '';
			} else {
				$explodeayat 				= explode('.', $idtilawahayatawal);
				if (isset($explodeayat[1])){
					$setoran_tilawahsurahawal 	= $explodeayat[0];
					$ayat						= $explodeayat[1];
					$getnamasurah 				= Mushaflist::where('id', $setoran_tilawahsurahawal)->first();
					if (isset($getnamasurah->id)){
						$setoran_tilawahsurahawal 	= $getnamasurah->surah.' Ayat '.$ayat;
					}
				} else {
					$setoran_tilawahsurahawal	= $idtilawahayatawal;
				}
			}
			$idtilawahayatakhir 		= $request->setoran_tilawahsurahakhir;
			if ($idtilawahayatakhir == 0 OR $idtilawahayatakhir == '' OR $idtilawahayatakhir == null){
				$setoran_tilawahsurahakhir 	= '';
				$idtilawahayatakhir			= '';
			} else {
				$explodeayat 				= explode('.', $idtilawahayatakhir);
				if (isset($explodeayat[1])){
					$setoran_tilawahsurahakhir 	= $explodeayat[0];
					$ayat						= $explodeayat[1];
					$getnamasurah 				= Mushaflist::where('id', $setoran_tilawahsurahakhir)->first();
					if (isset($getnamasurah->id)){
						$setoran_tilawahsurahakhir 	= $getnamasurah->surah.' Ayat '.$ayat;
					}
				} else {
					$setoran_tilawahsurahakhir	= $idtilawahayatakhir;
				}
			}
			try {
				Datasetorantahfid::updateOrCreate(
					[
						'keybengakcrash'		=> $keybengakcrash,
					],
					[
						'inputor'				=> $inputor,
						'nama'					=> $nama,
						'kelas'					=> $kelas,
						'tapel'					=> $tapel,
						'semester'				=> $smt,
						'jilid'					=> $jilid,
						'noinduk'				=> $noinduk,
						'tanggal'				=> $tanggal,
						'marking'				=> $marking,
						'id_sekolah'			=> session('sekolah_id_sekolah'),
						'ziyadah_mulaisurah'	=> $setoran_ziyadahsurahawal,
						'ziyadah_mulaiayat'		=> $idziyadahawal,
						'ziyadah_akhirsurah'	=> $setoran_ziyadahsurahakhir,
						'ziyadah_akhirayat'		=> $isziyadahsurahakhir,
						'ziyadah_nilai'			=> $request->setoran_nilaiziyadah,
						'ziyadah_predikat'		=> $request->setoran_statusziyadah,
						'murojaah_mulaisurah'	=> $setoran_msurahawal,
						'murojaah_mulaiayat'	=> $idmsurahawal,
						'murojaah_akhirsurah'	=> $setoran_msurahakhir,
						'murojaah_akhirayat'	=> $idmsurahakhir,
						'murojaah_nilai'		=> $request->setoran_nilaimurojaah,
						'murojaah_predikat'		=> $request->setoran_statusmurojaah,
						'tilawah_mulaisurah'	=> $setoran_tilawahsurahawal,
						'tilawah_mulaiayat'		=> $idtilawahayatawal,
						'tilawah_akhirsurah'	=> $setoran_tilawahsurahakhir,
						'tilawah_akhirayat'		=> $idtilawahayatakhir,
						'tilawah_nilai'			=> $request->setoran_nilaitilawah,
						'tilawah_predikat'		=> $request->setoran_statustilawah,
						'tahsin'				=> $request->tahsin,
						'tahsin_nilai'			=> $request->setoran_nilaitahsin,
						'tahsin_predikat'		=> $request->setoran_statustahsin,
						'catatan'				=> $request->setoran_catatan,
						'updated_at'			=> date('Y-m-d H:i:s')
					]
				);
				$pesan = 'Halaqoh di '.$tempat.' an. '.$nama.' Tanggal '.$tanggal.' Berhasil di Simpan';
				if (Session('sekolah_level') == 2 AND $tempat == 'SEKOLAH' AND $ceksek == 0){
					$getdatasiswa = Datainduk::where('noinduk', $noinduk)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
					if (isset($getdatasiswa->jilid)){
						$sql 	= Datainduk::where('noinduk', '!=', $noinduk)->where('jilid', $getdatasiswa->jilid)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
						foreach($sql as $rows){
							$marking 	= session('sekolah_id_sekolah').'-'.$rows->noinduk.'_'.$tanggal;
							$masterkls 	= substr($rows->klspos, 0, -1);
							if ($masterkls == 6 OR $masterkls == 5){
								Datasetorantahfid::updateOrCreate(
									[
										'noinduk' 		=> $rows->noinduk,
										'tanggal' 		=> $tanggal,
										'id_sekolah' 	=> Session('sekolah_id_sekolah'),
										'marking'		=> $marking,
										'keybengakcrash'=> $marking,
									],
									[
										'inputor'				=> $inputor,
										'nama'					=> $rows->nama,
										'kelas'					=> $kelas,
										'tapel'					=> $tapel,
										'semester'				=> $smt,
										'jilid'					=> $jilid,
										'ziyadah_mulaisurah'	=> $setoran_ziyadahsurahawal,
										'ziyadah_mulaiayat'		=> $idziyadahawal,
										'ziyadah_akhirsurah'	=> $setoran_ziyadahsurahakhir,
										'ziyadah_akhirayat'		=> $isziyadahsurahakhir,
										'murojaah_mulaisurah'	=> $setoran_msurahawal,
										'murojaah_mulaiayat'	=> $idmsurahawal,
										'murojaah_akhirsurah'	=> $setoran_msurahakhir,
										'murojaah_akhirayat'	=> $idmsurahakhir,
										'tilawah_mulaisurah'	=> $setoran_tilawahsurahawal,
										'tilawah_mulaiayat'		=> $idtilawahayatawal,
										'tilawah_akhirsurah'	=> $setoran_tilawahsurahakhir,
										'tilawah_akhirayat'		=> $idtilawahayatakhir,
										'tahsin'				=> $request->tahsin,
									]
								);
							} else {
								Datasetorantahfid::updateOrCreate(
									[
										'noinduk' 		=> $rows->noinduk,
										'tanggal' 		=> $tanggal,
										'id_sekolah' 	=> Session('sekolah_id_sekolah'),
										'marking'		=> $marking,
										'keybengakcrash'=> $marking,
									],
									[
										'inputor'				=> $inputor,
										'nama'					=> $rows->nama,
										'kelas'					=> $jilid,
										'tapel'					=> $tapel,
										'semester'				=> $smt,
										'jilid'					=> $jilid,
										'ziyadah_mulaisurah'	=> $setoran_ziyadahsurahawal,
										'ziyadah_mulaiayat'		=> $idziyadahawal,
										'ziyadah_akhirsurah'	=> $setoran_ziyadahsurahakhir,
										'ziyadah_akhirayat'		=> $isziyadahsurahakhir,
										'murojaah_mulaisurah'	=> $setoran_msurahawal,
										'murojaah_mulaiayat'	=> $idmsurahawal,
										'murojaah_akhirsurah'	=> $setoran_msurahakhir,
										'murojaah_akhirayat'	=> $idmsurahakhir,
										'tahsin'				=> $request->tahsin,
									]
								);
							}
						}
					}
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $pesan]);
				return back();
			} catch (\Exception $e) {
				$sendstatus = $e->getMessage();
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $sendstatus]);
				return back();
			}
		}
	}
	public function viewRencanaKegiatan() {
		$data   					= [];
		if (Session('previlage') !== null){
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['tahunne']			= date("Y");
			$data['tanggal']			= date("Y-m-d");
			$data['sidebar']			= 'rencanakegiatan';
			$jenis						= 'kegiatan';
			$getdebet 					= HPTKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'), DB::raw('SUM(pengeluaran) as pengeluaran'))->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
			if (isset($getdebet->pemasukan)){
				$totpemasukan			= $getdebet->pemasukan;
				$totpepengeluaran		= $getdebet->pengeluaran;
				$saldoakhir 			= $totpemasukan - $totpepengeluaran;
				$saldoakhir				= number_format( $saldoakhir , 0 , '.' , ',' );
			} else { 
				$totpemasukan 			= 0;
				$totpepengeluaran 		= 0;
				$saldoakhir				= 0;
			}
			$getdebetnilai1 		    = RencanaKegiatan::where('tahun', date('Y'))->where('status', 'rencana')->select(DB::raw('SUM(pengajuan) as pengajuan'))->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('id_sekolah')->first();
			if (isset($getdebetnilai1->pengajuan)){
				$nilaitotalperencanaan	= $getdebetnilai1->pengajuan;
			} else { $nilaitotalperencanaan = 0 ;}
			$getdebetnilai2 		    = RencanaKegiatan::where('tahun', date('Y'))->where('status', 'pengajuan')->select(DB::raw('SUM(pengajuan) as pengajuan'))->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('id_sekolah')->first();
			if (isset($getdebetnilai2->pengajuan)){
				$nilaitotalpengajuan	= $getdebetnilai2->pengajuan;
			} else { $nilaitotalpengajuan = 0 ;}
			$getdebetnilai3 		    = RencanaKegiatan::where('tahun', date('Y'))->where('status', 'progress')->select(DB::raw('SUM(aprovalkeuangan) as aprovalkeuangan'))->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('id_sekolah')->first();
			if (isset($getdebetnilai3->aprovalkeuangan)){
				$nilaitotalprogress	= $getdebetnilai3->aprovalkeuangan;
			} else { $nilaitotalprogress = 0 ;}
			$getdebetnilai4 		    = RencanaKegiatan::where('tahun', date('Y'))->where('status', 'selesai')->select(DB::raw('SUM(saldoakhir) as saldoakhir'))->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('id_sekolah')->first();
			if (isset($getdebetnilai4->saldoakhir)){
				$nilaitotalselesai	= $getdebetnilai4->saldoakhir;
			} else { $nilaitotalselesai = 0 ;}
			$pegawai 					= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->whereNotIn('statpeg', ['Non Aktif', 'Pensiun', 'Meninggal', 'Arsip'])->get();
			$data['nilaitotalperencanaan']	= '<span class="badge badge-primary float-right">Rp. '.number_format( $nilaitotalperencanaan , 0 , '.' , ',' ).',- </span>';
			$data['nilaitotalpengajuan']	= '<span class="badge badge-warning float-right">Rp. '.number_format( $nilaitotalpengajuan , 0 , '.' , ',' ).',- </span>';
			$data['nilaitotalprogress']		= '<span class="badge badge-info float-right">Rp. '.number_format( $nilaitotalprogress , 0 , '.' , ',' ).',- </span>';
			$data['nilaitotalselesai']		= '<span class="badge badge-danger float-right">Rp. '.number_format( $nilaitotalselesai , 0 , '.' , ',' ).',- </span>';
			$data['pegawais']				= $pegawai;
			$data['saldoakhir']				= $saldoakhir;
			return view('simaster.rencanakegiatan', $data);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
        	$tasks['kalimatbody']  		= 'Session Expired, Please Reloggin';
            return view('errors.notready', $tasks);
		}
	}
	public function jsonRencanaKegiatan(Request $request) {
		$arrsiswa 		= [];
		$homebase		= url("/");
		$jenis 			= $request->jenis;
		$tahun 			= $request->tahun;
		$arraysurat		= [];
		$i 				= 0;
		if ($jenis == 'finddatakegiatan'){
			$sql 		= RencanaKegiatan::where('id', $tahun)->first();
			return $sql;
		} else if ($jenis == 'exportkegiatan'){
			$sql 		= RencanaKegiatan::where('tahun', $tahun)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
			echo json_encode($sql);
		} else if ($jenis == 'getrabkegiatan'){
			$teksproposal 	= '';
			$jsonrab 		= [];
			$sql 			= RencanaKegiatan::where('id', $tahun)->first();
			if (isset($sql->id)){
				RencanaKegiatan::where('id', $sql->id)->update([
					'status'				=> 'pengajuan',
					'bendahara'				=> null,
					'updated_at'			=> date('Y-m-d H:i:s')
				]);
				if ($sql->markingteksproposal == null OR $sql->markingteksproposal == ''){
					$markingteksproposal = session('sekolah_id_sekolah').'-'.$sql->id.'-teksproposal';
					RencanaKegiatan::where('id', $tahun)->update([
						'markingteksproposal'	=> $markingteksproposal
					]);
					XFiles::create([
						'xmarking'	=> $markingteksproposal,
						'xtabel'	=> 'db_rencanakegiatan',
						'xjenis'	=> 'Kegiatan Tahun '.date('Y'),
						'xfile'		=> ''
					]);
				} else {
					$markingteksproposal	= $sql->markingteksproposal;
					$teksproposal			= $sql->getTeksProposal->xfile ?? '';
				}
				if ($sql->markingteksrab == null OR $sql->markingteksrab == ''){
					$markingteksrab = session('sekolah_id_sekolah').'-'.$sql->id.'-rab';
					RencanaKegiatan::where('id', $tahun)->update([
						'markingteksrab'	=> $markingteksrab
					]);
				} else {
					$markingteksrab	= $sql->markingteksrab;
				}
				$jsonrab 		= RABKegiatan::where('marking', $markingteksrab)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
				$jsonrab		= json_encode($jsonrab);
			}
			$response = [
				'namakegiatan'		=> $sql->namakegiatan,
				'mulai'				=> $sql->mulai,
				'akhir'				=> $sql->akhir,
				'bendahara'			=> $sql->bendahara,
				'penanggunggjawab'	=> $sql->penanggunggjawab,
				'teksproposal'		=> $teksproposal,
				'datarab'			=> $jsonrab,
			];
			return response()->json($response, 200);
		} else if ($jenis == 'getpenggajuankegiatan'){
			$sql 			= RencanaKegiatan::where('bendahara', 'Mohon di Periksa')->get();
			echo json_encode($sql);
		} else if ($jenis == 'getprogresskegiatan'){
			$sql 			= RencanaKegiatan::where('status', 'progress')->get();
			echo json_encode($sql);
		} else if ($jenis == 'isirabkegiatan'){
			$jsonrab 		= [];
			$sql 			= RencanaKegiatan::where('id', $tahun)->first();
			if (isset($sql->id)){
				$jsonrab 		= RABKegiatan::where('marking', $sql->markingteksrab)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
			}
			echo json_encode($jsonrab);
		} else if ($jenis == 'realisasikeuangan'){
			$jsonrab 		= [];
			$sql 			= RencanaKegiatan::where('id', $tahun)->first();
			if (isset($sql->id)){
				$jsonrab 	= EfikasiKeuangan::where('realjenis', 'Kegiatan')->where('realnominal', $sql->id)->get();
			}
			echo json_encode($jsonrab);
		} else {
			$data		= new RencanaKegiatan();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			$data 		= $data->where('status', $jenis);
			if (Session('previlage') == 'Waka Kesiswaan' OR Session('previlage') == 'level1'){
				$data 		= $data->where('id_sekolah',session('sekolah_id_sekolah'));
			} else {
				$data 		= $data->where('niypj', Session('nip'))->orWhere('created_by', Session('nip'));
				$data 		= $data->where('id_sekolah',session('sekolah_id_sekolah'));
			}
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('tahun', 'like', "%$searchTerm%")
						->orWhere('perkiraanpelaksanaan', 'like', "%$searchTerm%")
						->orWhere('namakegiatan', 'like', "%$searchTerm%")
						->orWhere('deskripsi', 'like', "%$searchTerm%")
						->orWhere('penanggunggjawab', 'like', "%$searchTerm%")
						->orWhere('mulai', 'like', "%$searchTerm%")
						->orWhere('catatanbendahara', 'like', "%$searchTerm%")
						->orWhere('bendahara', 'like', "%$searchTerm%");
				});
			}
			$data		= $data->orderByRaw($order)->paginate($limit);
			$totaldata	= $data->total();
			if ($data) {
				foreach($data as $rows){
					$arraysurat[$i] = $rows;
					$i++;
				}
				$response = [
					'message'	=> 'List Data '.$jenis,
					'total'		=> $totaldata,
					'data'		=> $arraysurat
				];
				return response()->json($response, 200);
			}
			$response = [
				'message'        => 'No Data'
			];
			return response()->json($response, 500);
		}
	}
	public function exSimpanRK(Request $request) {
		$id						= $request->id;
		$tahun					= $request->tahun;
		$mulai					= $request->mulai;
		$akhir					= $request->akhir;
		$namakegiatan			= $request->namakegiatan;
		$deskripsi				= $request->deskripsi;
		$workcode				= $request->workcode;
		$pengajuan				= $request->pengajuan;
		$pengajuan 				= str_replace(',','',$pengajuan);
		$perkiraanpelaksanaan	= $mulai.' s/d '.$akhir;
		if ($workcode == 'tambahdata'){
			if ($id == 'new'){
				$ceksudahada  		= RencanaKegiatan::where('tahun', $tahun)->where('namakegiatan', $namakegiatan)->where('perkiraanpelaksanaan', $perkiraanpelaksanaan)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
				if ($ceksudahada == 0){
					$input 			= RencanaKegiatan::create([
						'tahun'					=> $tahun,
						'perkiraanpelaksanaan'	=> $mulai.' s/d '.$akhir,
						'namakegiatan'			=> $namakegiatan,
						'mulai'					=> $mulai,
						'akhir'					=> $akhir,
						'deskripsi'				=> $deskripsi,
						'pengajuan'				=> $pengajuan,
						'status'				=> 'rencana',
						'created_by'			=> Session('nip'),
						'id_sekolah'			=> session('sekolah_id_sekolah')
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Rencana Kegiatan Telah di Tambahkan']);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Terdeteksi adanya double data, mohon periksa dan perbaiki nama, perkiraan waktu dan tahun masukkan Bapak/Ibu']);
					return back();
				}
			} else {
				$ceksudahada  		= RencanaKegiatan::where('id', '!=', $id)->where('tahun', $tahun)->where('namakegiatan', $namakegiatan)->where('perkiraanpelaksanaan', $perkiraanpelaksanaan)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
				if ($ceksudahada == 0){
					$input 			= RencanaKegiatan::where('id', $id)->update([
						'tahun'					=> $tahun,
						'perkiraanpelaksanaan'	=> $mulai.' s/d '.$akhir,
						'namakegiatan'			=> $namakegiatan,
						'mulai'					=> $mulai,
						'akhir'					=> $akhir,
						'deskripsi'				=> $deskripsi,
						'pengajuan'				=> $pengajuan,
						'updated_at'			=> date('Y-m-d H:i:s')
					]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Rencana Kegiatan Telah di Update']);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Terdeteksi adanya double data, mohon periksa dan perbaiki nama, perkiraan waktu dan tahun masukkan Bapak/Ibu']);
					return back();
				}
			}
		} else if ($workcode == 'simpanpengajuan1'){
			$getdatakegiatan = RencanaKegiatan::where('id', $id)->first();
			if (isset($getdatakegiatan->id)){
				$getnamapj 	= Dataindukstaff::where('niy', $request->penanggungjawab)->first();
				if (isset($getnamapj->id)){
					$nama 	= $getnamapj->nama;
					$niy 	= $getnamapj->niy;
				} else {
					$nama 	= $request->penanggungjawab;
					$niy 	= $request->penanggungjawab;
				}
				$getnamasek 	= Dataindukstaff::where('niy', $request->sekretaris)->first();
				if (isset($getnamasek->id)){
					$namasek	= $getnamasek->nama;
					$niysek		= $getnamasek->niy;
				} else {
					$namasek	= $request->sekretaris;
					$niysek 	= $request->sekretaris;
				}
				$getnamaben 	= Dataindukstaff::where('niy', $request->bendaharakegiatan)->first();
				if (isset($getnamaben->id)){
					$namaben 	= $getnamaben->nama;
					$niyben 	= $getnamaben->niy;
				} else {
					$namaben 	= $request->bendaharakegiatan;
					$niyben 	= $request->bendaharakegiatan;
				}
				$input 		= RencanaKegiatan::where('id', $id)->update([
					'mulai'					=> $request->mulai,
					'akhir'					=> $request->akhir,
					'namakegiatan'			=> $request->namakegiatan,
					'penanggunggjawab'		=> $nama,
					'niypj'					=> $niy,
					'sekretaris'			=> $namasek,
					'niysekretaris'			=> $niysek,
					'bendaharakegiatan'		=> $namaben,
					'niybendaharakegiatan'	=> $niyben,
					'status'				=> 'pengajuan',
					'updated_at'			=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$ceksudah = XFiles::where('xmarking', $getdatakegiatan->markingteksproposal)->count();
					if ($ceksudah == 0){
						XFiles::create([
							'xmarking'	=> $getdatakegiatan->markingteksproposal,
							'xtabel'	=> 'db_rencanakegiatan',
							'xjenis'	=> 'Kegiatan Tahun '.date('Y'),
							'xfile'		=> $request->teksproposal
						]);
					} else {
						XFiles::where('xmarking', $getdatakegiatan->markingteksproposal)->update([
							'xfile'		=> $request->teksproposal
						]);
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Rencana Anggaran Mohon di Rancang']);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'ID Kegiatan '.$id.' Tidak Valid']);
				return back();
			}
		} else if ($workcode == 'tambahdatarab'){
			$idkegiatan = $request->idkegiatan;
			$getdatakegiatan = RencanaKegiatan::where('id', $idkegiatan)->first();
			if (isset($getdatakegiatan->id)){
				if ($id == 'new'){
					$ceksudahada	= RABKegiatan::where('marking', $getdatakegiatan->markingteksrab)->where('deskripsi', $deskripsi)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
				} else {
					$ceksudahada	= RABKegiatan::where('id', '!=', $id)->where('marking', $getdatakegiatan->markingteksrab)->where('deskripsi', $deskripsi)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
				}
				if ($ceksudahada == 0){
					$input 			= RABKegiatan::create([
							'marking' 			=> $getdatakegiatan->markingteksrab,
							'deskripsi' 		=> $deskripsi,
							'anggaran' 			=> $pengajuan,
							'marking' 			=> $getdatakegiatan->markingteksrab,
							'created_by' 		=> Session('niy'),
							'id_sekolah' 		=> session('sekolah_id_sekolah')
						]);
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Rencana Anggaran Telah di Simpan']);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Terdeteksi adanya double data, mohon deskripsi masukkan Bapak/Ibu']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'ID Kegiatan '.$idkegiatan.' Tidak Valid']);
				return back();
			}
		} else if ($workcode == 'hapusdatarab'){
			$idkegiatan = $request->val02;
			$getdatakegiatan = RABKegiatan::where('id', $idkegiatan)->first();
			if (isset($getdatakegiatan->id)){
				$accbendahara = $getdatakegiatan->disetujui;
				if ($accbendahara == null OR $accbendahara == 0){
					$input 		= RABKegiatan::where('id', $idkegiatan)->delete();
					if ($input){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Deleted']);
						return back();
					}else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Data Yang Sudah di Acc Bendahara Tidak Bisa di Ubah']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'ID Kegiatan '.$idkegiatan.' Tidak Valid']);
				return back();
			}
		} else if ($workcode == 'simpanpengajuan2'){
			$getdatakegiatan = RencanaKegiatan::where('id', $id)->first();
			if (isset($getdatakegiatan->id)){
				$input 		= RencanaKegiatan::where('id', $getdatakegiatan->id)->update([
					'penanggunggjawab'	=> $request->penanggungjawab,
					'status'			=> 'pengajuan',
					'bendahara'			=> 'Mohon di Periksa',
					'updated_at'		=> date('Y-m-d H:i:s')
				]);
				if ($input){
					$getdebet		= RABKegiatan::select(DB::raw('SUM(anggaran) as anggaran'))->where('marking', $getdatakegiatan->markingteksrab)->groupBy('marking')->first();
					if (isset($getdebet->anggaran)){
						$anggaran	= $getdebet->anggaran;
					} else { $anggaran = 0 ;}
					RencanaKegiatan::where('id', $id)->update([
						'pengajuan'		=> $anggaran,
					]);
					XFiles::where('xmarking', $getdatakegiatan->markingteksproposal)->update([
						'xfile' => $request->teksproposal,
					]);
					$tuliskirim = 'Proposal Kegiatan di Sampaikan Oleh '.Session('nama');
					$listpaket 	= User::where('previlage', 'level5')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
					if (!empty($listpaket)){
						foreach($listpaket as $rows){
							SendMail::mobilenotif($rows->nip,'perseorangan',$rows->nama,$tuliskirim);
							Notification::send($rows, new NewMessageNotification($tuliskirim));
						}
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Mohon Sampaikan ke Bendahara Untuk Memeriksa Pengajuan Bapak/Ibu']);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'ID Kegiatan '.$id.' Tidak Valid']);
				return back();
			}
		} else if ($workcode == 'kirimkeks'){
			$getdatakegiatan = RencanaKegiatan::where('id', $id)->first();
			if (isset($getdatakegiatan->id)){
				$bendahara 	= $getdatakegiatan->bendahara;
				$namafile	= url('/').'/ttdproposal/'.$getdatakegiatan->id;
						
				if (is_null($bendahara) OR $bendahara == '' OR $bendahara == 'Mohon di Periksa'){
					if ($bendahara == 'Mohon di Periksa') {
						$pesan = 'Proposal ini masih dalam pemeriksaan Bendahara, Tunggu sampai Bendahara memeriksa Proposal Bapak/Ibu sebelum mengirimkannya ke Kepala Sekolah';
					} else {
						$pesan = 'Kirim Proposal ini ke Bendahara Terlebih Dahulu dengan Cara Melengkapi Proposal dan RAB Kegiatan Ini';
					}
					return response()->json(['bendahara' => $bendahara, 'icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
					return back();
				} else {
					RencanaKegiatan::where('id', $id)->update([
						'status'			=> 'progress',
						'updated_at'		=> date('Y-m-d H:i:s')
					]);
					$cekpejabat     = Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
					if (isset($cekpejabat->id)){
						$nama       = $cekpejabat->nama;
						$niy        = $cekpejabat->niy;
						$notelp     = $cekpejabat->notelp;
						$jabatan    = $cekpejabat->jabatan;
						Inboxsurat::updateOrCreate(
							[
								'xmarking'		=> Session('sekolah_id_sekolah').'-'.$getdatakegiatan->id.'-persetujuanKS',
								'penerima' 		=> $niy,
								'id_sekolah' 	=> Session('sekolah_id_sekolah')
							],
							[
								'tabel' 			=> 'db_rencanakegiatan',
								'perihal' 			=> 'Persetujuan Proposal Kegiatan '.$getdatakegiatan->namakegiatan,
								'pengirim' 			=> Session('nama'),
								'jenis' 			=> 'TTE',
								'urlsurat'			=> $namafile,
								'status'			=> 1
							]
						);
						$arrhpdosen = str_split($notelp);
						$hape	    = '';
						foreach($arrhpdosen as $rhape){
							if ($rhape == '-'){ $rhape = ''; }
							if ($rhape != ''){
								if ($hape == ''){
									if ($rhape == '0'){
										$hape = '62';
									} else {
										if ($rhape == '8' AND $hape == ''){
											$hape = '628';
										} else {
											$hape = $hape.$rhape;
										}
									}
								} else {
									$hape = $hape.$rhape;
								}
							}
						}
						$keterangan 	= 'Yth. '.$nama.'%0ADengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :%0AKami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :%0A'.$namafile.'%0ADan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih';
						$keteranganwa	= str_replace(" ", '%20', $keterangan);
						$keteranganwa 	= 'https://api.whatsapp.com/send?phone='.$hape.'&text='.$keteranganwa;
						$keterangan 	= '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<h4><i class="icon fa fa-check"></i> Mohon di Kirimkan!</h4>
											Link untuk tandatangan telah kami buat, mohon click link berikut untuk mengirimkan link permohonan tandatangan ke '.$nama.'<br />
											Link Tandatangan : <a href="'.$keteranganwa.'" target="_blank">https://api.whatsapp.com/send?phone='.$hape.'&text=MohonTTD</a>
										</div>';
						$getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niy)->first();
						if (isset($getuser->id)){
							$tuliskirim         = '<a href="'.$namafile.'" target="_blank">Tandatangani Proposal</a>';
							Notification::send($getuser, new NewMessageNotification($tuliskirim));
							SendMail::notif($nama,$getuser->email,'Persetujuan Proposal',$keterangan);
						}
						$tuliskirim = 'Surat Yang Perlu Bapak/Ibu Tandatangani Sudah di Buat, Mohon Bantuannnya untuk Membuka Aplikasi / Browser untuk memprosesnya';
						SendMail::mobilenotif($niy,'perseorangan',$nama,$tuliskirim);
						return response()->json(['bendahara' => $bendahara, 'icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Proposal Sudah kami Kirimkan via Notifikasi', 'keterangan' => $keterangan, 'keteranganwa' => $keteranganwa]);
						return back();
					}
				}
				
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'ID Kegiatan '.$id.' Tidak Valid']);
				return back();
			}
		} else if ($workcode == 'hapusrencana'){
			$getdatalama  		= RencanaKegiatan::where('id', $id)->first();
			$delete  			= RencanaKegiatan::where('id', $id)->delete();
			if ($delete){
				$kalimat 		= Session('nama').' Menghapus Data '.$getdatalama->namakegiatan.' Tahun '.$getdatalama->tahun.' Pada '.date('Y-m-d H:i:s');
				Logstaff::create([
					'jenis'		=> 'Rencana Kegiatan', 
					'sopo'		=> Session('nip'),
					'kelakuan'	=> $kalimat,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Deleted']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
				return back();
			}
				
		} else if ($workcode == 'klarifikasidatarab'){
			$disetujui 			= str_replace(',','',$request->disetujui);
			$input 			= RABKegiatan::where('id', $id)->update([
				'disetujui'		=> $disetujui,
				'keterangan'	=> $request->keterangan,
				'updated_at'	=> date('Y-m-d H:i:s')
			]);
			if ($input){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Rencana Anggaran Telah di Simpan']);
				return back();
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
				return back();
			}
		} else if ($workcode == 'klarifikasibendahara'){
			$getdatakegiatan= RencanaKegiatan::where('id', $id)->first();
			$getdebet		= RABKegiatan::select(DB::raw('SUM(disetujui) as disetujui'))->where('marking', $getdatakegiatan->markingteksrab)->groupBy('marking')->first();
			if (isset($getdebet->disetujui)){
				$aprovalkeuangan	= $getdebet->disetujui;
			} else { $anggaprovalkeuanganaran = 0 ;}
			if ($request->bendahara == 'Disetujui'){
				$input 				= RencanaKegiatan::where('id', $id)->update([
					'status'			=> 'progress',
					'aprovalkeuangan'	=> $aprovalkeuangan,
					'bendahara'			=> $request->bendahara,
					'catatanbendahara'	=> $request->catatanbendahara,
					'updated_at'		=> date('Y-m-d H:i:s')
				]);
				$cekpejabat     = Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
				if (isset($cekpejabat->id)){
					$nama       	= $cekpejabat->nama;
					$niy        	= $cekpejabat->niy;
					$notelp     	= $cekpejabat->notelp;
					$jabatan    	= $cekpejabat->jabatan;
					$namafile		= url('/').'/ttdproposal/'.$id;
					Inboxsurat::updateOrCreate(
						[
							'xmarking'		=> Session('sekolah_id_sekolah').'-'.$getdatakegiatan->id.'-persetujuanKS',
							'penerima' 		=> $niy,
							'id_sekolah' 	=> Session('sekolah_id_sekolah')
						],
						[
							'tabel' 			=> 'db_rencanakegiatan',
							'perihal' 			=> 'Persetujuan Proposal Kegiatan '.$getdatakegiatan->namakegiatan,
							'pengirim' 			=> Session('nama'),
							'jenis' 			=> 'TTE',
							'urlsurat'			=> $namafile,
							'status'			=> 1
						]
					);
					$keterangan 	= 'Yth. '.$nama.' Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :%0AKami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut : '.$namafile.' Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.Demikian pemberitahuan ini kami sampaikan. Terima kasih';
					$getuser    	= User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niy)->first();
					if (isset($getuser->id)){
						$tuliskirim         = '<a href="'.$namafile.'" target="_blank">Tandatangani Proposal</a>';
						Notification::send($getuser, new NewMessageNotification($tuliskirim));
						SendMail::notif($nama,$getuser->email,'Persetujuan Proposal',$keterangan);
					}
					$tuliskirim = 'Surat Yang Perlu Bapak/Ibu Tandatangani Sudah di Buat, Mohon Bantuannnya untuk Membuka Aplikasi / Browser untuk memprosesnya';
					SendMail::mobilenotif($niy,'perseorangan',$nama,$tuliskirim);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Proposal Sudah kami Kirimkan via Notifikasi']);
					return back();
				} else {
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Rencana Anggaran Telah di Simpan']);
					return back();
				}
			} else {
				$input 			= RencanaKegiatan::where('id', $id)->update([
					'bendahara'			=> Session('nama'),
					'aprovalkeuangan'	=> $aprovalkeuangan,
					'catatanbendahara'	=> 'Mohon di Perbaiki dengan Catatan : '.$request->catatanbendahara,
					'updated_at'		=> date('Y-m-d H:i:s')
				]);
				if ($input){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Rencana Anggaran Telah di Simpan']);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
					return back();
				}
			}
		} else if ($workcode == 'simpanrealisasi'){
			$idkegiatan 	= $request->idkegiatan;
			$nominal 		= $request->nominal;
			$jenis 			= $request->jenis;
			$nominal 		= (int)str_replace(',','',$nominal);
			$getdatakegiatan 	= RencanaKegiatan::where('id', $idkegiatan)->first();
			if (isset($getdatakegiatan->id)){
				if ($id == 'new'){
					$timestamp 	= time();
					if ($jenis == 'pemasukan'){
						$input = EfikasiKeuangan::create([
							'tanggal'		=> $request->tanggal,
							'deskripsi'		=> $request->deskripsi,
							'pemasukan'		=> $nominal,
							'pengeluaran'	=> '',
							'realnominal'	=> $getdatakegiatan->id,
							'realjenis'		=> 'Kegiatan',
							'penerima'		=> $request->penerima,
							'keterangan'	=> '',
							'marking'		=> Session('sekolah_id_sekolah').'-'.$getdatakegiatan->id.'-Efikasi-'.$timestamp,
							'id_sekolah'	=> Session('sekolah_id_sekolah'),
							'created_by'	=> Session('nip')
						]);
					} else {
						$input = EfikasiKeuangan::create([
							'tanggal'		=> $request->tanggal,
							'deskripsi'		=> $request->deskripsi,
							'pemasukan'		=> '',
							'pengeluaran'	=> $nominal,
							'realnominal'	=> $getdatakegiatan->id,
							'realjenis'		=> 'Kegiatan',
							'penerima'		=> $request->penerima,
							'keterangan'	=> '',
							'marking'		=> Session('sekolah_id_sekolah').'-'.$getdatakegiatan->id.'-Efikasi-'.$timestamp,
							'id_sekolah'	=> Session('sekolah_id_sekolah'),
							'created_by'	=> Session('nip')
						]);
					}
					XFiles::create([
						'xmarking'	=> Session('sekolah_id_sekolah').'-'.$getdatakegiatan->id.'-Efikasi-'.$timestamp,
						'xtabel'	=> 'db_efikasikeuangan',
						'xjenis'	=> 'Kegiatan Tahun '.date('Y'),
						'xfile'		=> ''
					]);
				} else {
					if ($jenis == 'pemasukan'){
						$input = EfikasiKeuangan::where('id', $id)->update([
							'tanggal'		=> $request->tanggal,
							'deskripsi'		=> $request->deskripsi,
							'pemasukan'		=> $nominal,
							'pengeluaran'	=> '',
							'realnominal'	=> $getdatakegiatan->id,
							'penerima'		=> $request->penerima,
						]);
					} else {
						$input = EfikasiKeuangan::where('id', $id)->update([
							'tanggal'		=> $request->tanggal,
							'deskripsi'		=> $request->deskripsi,
							'pemasukan'		=> '',
							'pengeluaran'	=> $nominal,
							'realnominal'	=> $getdatakegiatan->id,
							'penerima'		=> $request->penerima,
						]);
					}
				}
				if ($input){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Realisasi Angggaran Telah di Simpan']);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'ID Kegiatan '.$idkegiatan.' Tidak Valid']);
				return back();
			}
		} else if ($workcode == 'arsipkan'){
			$getdatakegiatan = RencanaKegiatan::where('id', $id)->first();
			if (isset($getdatakegiatan->id)){
				$getdebet 		            = EfikasiKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'))->where('realnominal', $getdatakegiatan->id)->where('realjenis', 'Kegiatan')->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('realnominal')->first();
				if (isset($getdebet->pemasukan)){
					$totpemasukan	        = $getdebet->pemasukan;
				} else { $totpemasukan = 0 ;}
				$getkredit 		            = EfikasiKeuangan::select(DB::raw('SUM(pengeluaran) as pengeluaran'))->where('realnominal', $getdatakegiatan->id)->where('realjenis', 'Kegiatan')->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('realnominal')->first();
				if (isset($getkredit->pengeluaran)){
					$totpepengeluaran	    = $getkredit->pengeluaran;
				} else { $totpepengeluaran  = 0 ;}
				$saldoakhir = $totpemasukan - $totpepengeluaran;
				$input = RencanaKegiatan::where('id', $id)->update([
					'status'			=> 'selesai',
					'saldoakhir'		=> $saldoakhir,
					'updated_at'		=> date('Y-m-d H:i:s')
				]);
				if ($input){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Proposal Telah Kami Arsipkan']);
					return back();
				}else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'ID Kegiatan '.$id.' Tidak Valid']);
				return back();
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Workcode '.$workcode.' Tidak Valid']);
			return back();
		}
	}
	public function jsonDataRPA(Request $request) {
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		if (isset($getdatauser->tapel)){
			$semester	= $getdatauser->smt;
			$tapel		= $getdatauser->tapel;
		} else {
			$semester	= '';
			$tapel		= '';
		}
		$arraydata 		= [];
		$homebase		= url("/");
		$kelas 			= $request->val01;
		$tahun 			= $request->tahun;
		$workcode 		= $request->workcode;
		$semester 		= $request->val02;
		if ($workcode == 'rpaperkelas'){
			$sql 		= KurikulumAlquran::where('tahun', $tahun)->where('kelas', $kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('realdate', 'ASC')->get();
			$cek 		= count($sql);
			if ($cek == 0){
				$year 			= $tahun;
        		$datesToSave 	= [];
				for ($month = 1; $month <= 12; $month++) {
					for ($day = 1; $day <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $day++) {
						$completeDate 		= sprintf('%04d-%02d-%02d', $year, $month, $day);
						$dayName 			= date('l', strtotime($completeDate));
						$indonesianDayName 	= $this->translateDayName($dayName);
						$datesToSave[] = [
							'kelas'		=> $kelas,
							'tanggal' 	=> $day,
							'bulan' 	=> $month,
							'tahun' 	=> $year,
							'hari' 		=> $indonesianDayName,
							'realdate'	=> $completeDate,
							'id_sekolah'=> Session('sekolah_id_sekolah'),
							'created_by'=> Session('nama'),
							'updated_by'=> Session('nip'),
						];
					}
				}
				KurikulumAlquran::insert($datesToSave);
				$sql 		= KurikulumAlquran::where('tahun', $tahun)->where('kelas', $kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('realdate', 'ASC')->get();
			}
			echo json_encode($sql);
		} else if ($workcode == 'statistikdisekolah'){
			$alldata	= [];
			$peserta 	= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jilid', $kelas)->where('nokelulusan', '')->count();
			$sql 		= Datasetorantahfid::where('marking', 'NOT LIKE',  'PR-%')->where('kelas', $kelas)->where('tapel', $tahun)->where('semester', $semester)->where('id_sekolah',  Session('sekolah_id_sekolah'))->orderBy('tanggal', 'DESC')->groupBy('tanggal')->get();
			if (!empty($sql)){
				foreach($sql as $rows){
					$jumlah 	= Datasetorantahfid::where('marking', 'NOT LIKE',  'PR-%')->where('kelas', $kelas)->where('tapel', $tahun)->where('semester', $semester)->where('id_sekolah',  Session('sekolah_id_sekolah'))->where('tanggal', $rows->tanggal)->count();
					if ($jumlah >= $peserta){
						$status = '<span class="badge badge-primary float-right">Lengkap</span>';
					} else {
						$status = $peserta - $jumlah;
						$status = '<span class="badge badge-danger float-right">Kurang '.$status.'</span>';
					}
					$alldata[] 		= array(
						'tanggal'	=> $rows->tanggal,
						'jumlah'	=> $jumlah,
						'peserta'	=> $peserta,
						'status'	=> $status,
					);
				}
			}
			$tempsql = Datasetorantahfid::whereNull('keybengakcrash')->get();
			foreach($tempsql as $rows){
				$marking 	= $rows->marking;
				if ($marking == ''){
					
				} else {
					$getkode = explode('-', $marking);
					if ($getkode[0] == 'PR'){
						$keybengakcrash = $rows->id_sekolah.'_'.$marking.'_'.$rows->noinduk.'_'.$rows->tanggal;
					} else {
						$keybengakcrash = $rows->id_sekolah.'_'.$rows->noinduk.'_'.$rows->tanggal;
					}
					Datasetorantahfid::where('id', $rows->id)->update([
						'keybengakcrash'	=> $keybengakcrash
					]);
				}
			}
			echo json_encode($alldata);
		} else if ($workcode == 'statistikdirumah'){
			$alldata	= [];
			$peserta 	= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jilid', $kelas)->where('nokelulusan', '')->count();
			$sql 		= Datasetorantahfid::where('marking', 'LIKE', 'PR-%')->where('kelas', $kelas)->where('tapel', $tahun)->where('semester', $semester)->where('id_sekolah',  Session('sekolah_id_sekolah'))->orderBy('tanggal', 'DESC')->groupBy('tanggal')->get();
			if (!empty($sql)){
				foreach($sql as $rows){
					$jumlah 	= Datasetorantahfid::where('marking', 'LIKE', 'PR-%')->where('kelas', $kelas)->where('tapel', $tahun)->where('semester', $semester)->where('id_sekolah',  Session('sekolah_id_sekolah'))->where('tanggal', $rows->tanggal)->count();
					if ($jumlah >= $peserta){
						$status = '<span class="badge badge-primary float-right">Lengkap</span>';
					} else {
						$status = $peserta - $jumlah;
						$status = '<span class="badge badge-danger float-right">Kurang '.$status.'</span>';
					}
					$alldata[] 		= array(
						'tanggal'	=> $rows->tanggal,
						'jumlah'	=> $jumlah,
						'peserta'	=> $peserta,
						'status'	=> $status,
					);
				}
			}
			echo json_encode($alldata);
		} else if ($workcode == 'printdatastatistikhr' OR $workcode == 'printdatastatistikhs'){
			$generatetbl= '
				<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
					<tr>
						<td colspan="16"><b><u>LAPORAN KEGIATAN KEAGAMAAN</u></b></td>
					</tr>
					<tr>
						<td align="center" rowspan="2" valign="middle"><b>NO</b></td>
						<td align="center" rowspan="2" valign="middle"><b>Nama</b></td>
						<td align="center" rowspan="2" valign="middle"><b>Tanggal</b></td>
						<td align="center" colspan="2"><b>Murojaah</b></td>
						<td align="center" colspan="2"><b>Ziyadah</b></td>
						<td align="center" colspan="2"><b>Tilawah</b></td>
						<td align="center" colspan="2"><b>Tahsin</b></td>
						<td align="center" rowspan="2" valign="middle"><b>Catatan</b></td>
						<td align="center" rowspan="2" valign="middle"><b>Guru</b></td>
					</tr>
					<tr>
						<td align="center"><b>Halaman</b></td>
						<td align="center"><b>Penilaian</b></td>
						<td align="center"><b>Halaman</b></td>
						<td align="center"><b>Penilaian</b></td>
						<td align="center"><b>Halaman</b></td>
						<td align="center"><b>Penilaian</b></td>
						<td align="center"><b>Halaman</b></td>
						<td align="center"><b>Penilaian</b></td>
					</tr>';
					$i 		= 1;
					if ($workcode == 'printdatastatistikhr'){
						$sql 	= Datasetorantahfid::where('marking', 'LIKE',  'PR-%')->where('kelas', $kelas)->where('tanggal', $request->val02)->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('nama', 'ASC')->get();
					} else {
						$sql 	= Datasetorantahfid::where('marking', 'NOT LIKE',  'PR-%')->where('kelas', $kelas)->where('tanggal', $request->val02)->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('nama', 'ASC')->get();
					}
					if (!empty($sql)){
						foreach ($sql as $row){
							$jenis 			= $row->jenis;
							$inputor 		= $row->inputor;
							if (isset($row->getInputorData->nama)){
								$inputor 	= $row->getInputorData->nama;
							}
							$generatetbl 	= $generatetbl.'<tr>
								<td align="center">'.$i.'</td>
								<td align="center">'.$row->nama.'</td>
								<td align="center">'.$row->tanggal.'</td>
								<td align="left">'.$row->murojaah_mulaisurah.' s/d '.$row->murojaah_akhirsurah.'</td>
								<td align="left">'.$row->murojaah_nilai.' ('.$row->murojaah_predikat.')</td>
								<td align="left">'.$row->ziyadah_mulaisurah.' s/d '.$row->ziyadah_akhirsurah.'</td>
								<td align="left">'.$row->ziyadah_nilai.' ('.$row->ziyadah_predikat.')</td>
								<td align="left">'.$row->tilawah_mulaisurah.' s/d '.$row->tilawah_akhirsurah.'</td>
								<td align="left">'.$row->tilawah_nilai.' ('.$row->tilawah_predikat.')</td>
								<td align="left">'.$row->tahsin.'</td>
								<td align="left">'.$row->tahsin_nilai.' ('.$row->tahsin_predikat.')</td>
								<td align="left">'.$row->catatan.'</td>
								<td align="left">'.$inputor.'</td>
							</tr>';
							$i++;
						}
					} else {
						$generatetbl = $generatetbl.'<tr>
								<td align="center">'.$i.'</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
								<td align="center">-</td>
								<td align="left">-</td>
								<td align="center">-</td>
								<td align="left">-</td>
								<td align="center">-</td>
								<td align="left">-</td>
								<td align="left">-</td>
							</tr>';
					}
			$generatetbl = $generatetbl.'</table>';
			echo $generatetbl;
		} else if ($workcode == 'dataperanakallday'){
			$kelas 		= $request->kelas;
			$tapel 		= $request->tapel;
			$noinduk 	= $request->noinduk;
			$semester 	= $request->semester;
			if ($tapel == '' OR $tapel == null){
				$sql	= Datasetorantahfid::where('kelas', $kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('tanggal', 'DESC')->groupBy('tanggal')->get();
			} else {
				$sql	= Datasetorantahfid::where('kelas', $kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->where('semester', $semester)->where('tapel', $tapel)->orderBy('tanggal', 'DESC')->groupBy('tanggal')->get();
			}
			if (!empty($sql)){
				foreach($sql as $rows){
					$markid 			= $rows->tanggal.'-'.$noinduk;
					$markid				= str_replace('-', '', $markid);
					$ceksetoransekolah 	= Datasetorantahfid::where('marking', 'NOT LIKE', 'PR-%')->where('tanggal', $rows->tanggal)->where('noinduk', $noinduk)->where('kelas', $rows->kelas)->where('id_sekolah', $rows->id_sekolah)->first();
					$ceksetoranrumah 	= Datasetorantahfid::where('marking', 'LIKE', 'PR-%')->where('tanggal', $rows->tanggal)->where('noinduk', $noinduk)->where('kelas', $rows->kelas)->where('id_sekolah', $rows->id_sekolah)->first();
					$getrpa 			= KurikulumAlquran::where('realdate', $rows->tanggal)->where('kelas', $rows->kelas)->where('id_sekolah', $rows->id_sekolah)->first();
					$arraydata[] 		= array(
						'tanggal'				=> $rows->tanggal,
						'noinduk'				=> $noinduk,
						'tapel'					=> $tapel,
						'kelas'					=> $kelas,
						'markid'				=> $markid,
						'idpr'					=> $ceksetoranrumah->id ?? $noinduk,
						'zsm'					=> $ceksetoransekolah->ziyadah_mulaisurah ?? '<span class="badge badge-danger">?</span>',
						'zsa'					=> $ceksetoransekolah->ziyadah_akhirsurah ?? '<span class="badge badge-danger">?</span>',
						'zsn'					=> $ceksetoransekolah->ziyadah_nilai ?? '0',
						'msm'					=> $ceksetoransekolah->murojaah_mulaisurah ?? '<span class="badge badge-danger">?</span>',
						'msa'					=> $ceksetoransekolah->murojaah_akhirsurah ?? '<span class="badge badge-danger">?</span>',
						'msn'					=> $ceksetoransekolah->murojaah_nilai ?? '0',
						'tsm'					=> $ceksetoransekolah->tilawah_mulaisurah ?? '<span class="badge badge-danger">?</span>',
						'tsa'					=> $ceksetoransekolah->tilawah_akhirsurah ?? '<span class="badge badge-danger">?</span>',
						'tsn'					=> $ceksetoransekolah->tilawah_nilai ?? '0',
						'tasn'					=> $ceksetoransekolah->tahsin_nilai ?? '0',
						'tast'					=> $ceksetoransekolah->tahsin ?? '<span class="badge badge-danger">?</span>',
						'catatan'				=> $ceksetoransekolah->catatan ?? '',
						'zrm'					=> $ceksetoranrumah->ziyadah_mulaisurah ?? '<span class="badge badge-danger">?</span>',
						'zrn'					=> $ceksetoranrumah->ziyadah_nilai ?? '0',
						'mrm'					=> $ceksetoranrumah->murojaah_mulaisurah ?? '<span class="badge badge-danger">?</span>',
						'mrn'					=> $ceksetoranrumah->murojaah_nilai ?? '0',
						'trm'					=> $ceksetoranrumah->tilawah_mulaisurah ?? '<span class="badge badge-danger">?</span>',
						'trn'					=> $ceksetoranrumah->tilawah_nilai ?? '0',
						'tarn'					=> $ceksetoranrumah->tahsin_nilai ?? '0',
						'tart'					=> $ceksetoranrumah->tahsin ?? '<span class="badge badge-danger">?</span>',
						'catrumah'				=> $ceksetoranrumah->catatan ?? '',
						'murojaahdirumah'		=> $getrpa->murojaahdirumah ?? '',
						'persiapanhafalanbesok'	=> $getrpa->persiapanhafalanbesok ?? '',
						'murojaahkemarin'		=> $getrpa->murojaahkemarin ?? '',
						'mendengaraudio'		=> $getrpa->mendengaraudio ?? '',
						'murojaahhariini'		=> $getrpa->murojaahhariini ?? '',
						'tahsin'				=> $getrpa->tahsin ?? '',
						'tilawah'				=> $getrpa->tilawah ?? '',
						'murojaahsabtuahad'		=> $getrpa->murojaahsabtuahad ?? '',
					);
				}
			}
			$response = [
				'tapel'		=> 'List Data tapel '.$tapel,
				'kelas'		=> $kelas,
				'data'		=> $arraydata
			];
			return response()->json($response, 200);
		} else if ($workcode == 'getriwayatforedit'){
			$sql	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapelsemester', $request->tapelsemester)->where('noinduk', $request->noinduk)->get();
			echo json_encode($sql);
			
		} else if ($workcode == 'laporansetoranortu'){
			$nama 					= $request->nama;
			$tapel 					= $request->tapel;
			$noinduk 				= $request->noinduk;
			$semester 				= $request->semester;
			$kelas 					= $request->kelas;
			$tanggal 				= $request->tanggal;
			$murojaah_mulaiayat 	= $request->murojaah_mulaiayat;
			$murojaah_akhirayat 	= $request->murojaah_akhirayat;
			$ziyadah_mulaiayat 		= $request->ziyadah_mulaiayat;
			$ziyadah_akhirayat 		= $request->ziyadah_akhirayat;
			$ziyadahsurahawal 		= $request->ziyadahsurahawal;
			$ziyadahsurahakhir 		= $request->ziyadahsurahakhir;
			$sudah 					= '&#10004;';
			$nilaiziyadah 			= null;
			$nilaimurojaah 			= null;
			if ($ziyadah_mulaiayat == 0 OR $ziyadah_mulaiayat == '' OR $ziyadah_mulaiayat == null){
				$setoran_ziyadahsurahawal 	= '';
				$setoran_ziyadahayatawal	= '';
			} else {
				$explodeayat 				= explode('.', $ziyadah_mulaiayat);
				$setoran_ziyadahsurahawal 	= $explodeayat[0];
				$setoran_ziyadahayatawal	= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_ziyadahsurahawal)->first();
				if (isset($getnamasurah->id)){
					$setoran_ziyadahsurahawal 	= $getnamasurah->surah.' Ayat '.$setoran_ziyadahayatawal;
					$nilaiziyadah			= $sudah;
				}
			}
			if ($ziyadah_akhirayat == 0 OR $ziyadah_akhirayat == '' OR $ziyadah_akhirayat == null){
				$setoran_ziyadahsurahakhir 	= '';
				$isziyadahsurahakhir		= '';
			} else {
				$explodeayat 				= explode('.', $ziyadah_akhirayat);
				$setoran_ziyadahsurahakhir 	= $explodeayat[0];
				$setoran_ziyadahayatakhir	= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_ziyadahsurahakhir)->first();
				if (isset($getnamasurah->id)){
					$setoran_ziyadahsurahakhir 	= $getnamasurah->surah.' Ayat '.$setoran_ziyadahayatakhir;
					$nilaiziyadah			= $sudah;
				}
			}
			if ($murojaah_mulaiayat == 0 OR $murojaah_mulaiayat == '' OR $murojaah_mulaiayat == null){
				$setoran_msurahawal 		= '';
				$setoran_mayatawal			= '';
			} else {
				$explodeayat 				= explode('.', $murojaah_mulaiayat);
				$setoran_msurahawal 		= $explodeayat[0];
				$setoran_mayatawal			= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_msurahawal)->first();
				if (isset($getnamasurah->id)){
					$setoran_msurahawal 	= $getnamasurah->surah.' Ayat '.$setoran_mayatawal;
					$nilaimurojaah			= $sudah;
				}
			}
			if ($murojaah_akhirayat == 0 OR $murojaah_akhirayat == '' OR $murojaah_akhirayat == null){
				$setoran_msurahakhir 		= '';
				$setoran_mayatakhir			= '';
			} else {
				$explodeayat 				= explode('.', $murojaah_akhirayat);
				$setoran_msurahakhir 		= $explodeayat[0];
				$setoran_mayatakhir			= $explodeayat[1];
				$getnamasurah 				= Mushaflist::where('id', $setoran_msurahakhir)->first();
				if (isset($getnamasurah->id)){
					$setoran_msurahakhir 	= $getnamasurah->surah.' Ayat '.$setoran_mayatakhir;
					$nilaimurojaah			= $sudah;
				}
			}
			$cekidrpa 				= KurikulumAlquran::where('murojaahdirumah', $ziyadahsurahawal.'s/d'.$ziyadahsurahakhir)->where('kelas', $kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
			if (isset($cekidrpa->id)){
				$marking 			= 'PR-'.$cekidrpa->id;
			} else {
				$marking 			= 'PR-'.time();
			}
			$ceksudah 				= Datasetorantahfid::where('marking', 'LIKE', 'PR-%')->where('noinduk', $noinduk)->where('tanggal', $tanggal)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
			if (isset($ceksudah->id)){
				Datasetorantahfid::where('id', $ceksudah->id)->update([
					'ziyadah_mulaisurah'	=> $setoran_ziyadahsurahawal,
					'ziyadah_mulaiayat'		=> $ziyadah_mulaiayat,
					'ziyadah_akhirsurah'	=> $setoran_ziyadahsurahakhir,
					'ziyadah_akhirayat'		=> $ziyadah_akhirayat,
					'ziyadah_nilai'			=> $nilaiziyadah,
					'murojaah_mulaisurah'	=> $setoran_msurahawal,
					'murojaah_mulaiayat'	=> $murojaah_mulaiayat,
					'murojaah_akhirsurah'	=> $setoran_msurahakhir,
					'murojaah_akhirayat'	=> $murojaah_akhirayat,
					'murojaah_nilai'		=> $nilaimurojaah,
					'catatan'				=> 'Saved By '.Session('nama').' at '.date('Y-m-d H:i:s'),
				]);
			} else {
				Datasetorantahfid::create([
					'inputor'				=> 'walisantri',
					'nama'					=> $nama,
					'kelas'					=> $kelas,
					'tapel'					=> $tapel,
					'semester'				=> $semester,
					'jilid'					=> $kelas,
					'noinduk'				=> $noinduk,
					'tanggal'				=> $tanggal,
					'marking'				=> $marking,
					'keybengakcrash'		=> session('sekolah_id_sekolah').'_'.$marking.'_'.$noinduk.'_'.$tanggal,
					'id_sekolah'			=> session('sekolah_id_sekolah'),
					'ziyadah_mulaisurah'	=> $setoran_ziyadahsurahawal,
					'ziyadah_mulaiayat'		=> $ziyadah_mulaiayat,
					'ziyadah_akhirsurah'	=> $setoran_ziyadahsurahakhir,
					'ziyadah_akhirayat'		=> $ziyadah_akhirayat,
					'ziyadah_nilai'			=> $nilaiziyadah,
					'ziyadah_predikat'		=> '',
					'murojaah_mulaisurah'	=> $setoran_msurahawal,
					'murojaah_mulaiayat'	=> $murojaah_mulaiayat,
					'murojaah_akhirsurah'	=> $setoran_msurahakhir,
					'murojaah_akhirayat'	=> $murojaah_akhirayat,
					'murojaah_nilai'		=> $nilaimurojaah,
					'murojaah_predikat'		=> '',
					'tilawah_mulaisurah'	=> '',
					'tilawah_mulaiayat'		=> '',
					'tilawah_akhirsurah'	=> '',
					'tilawah_akhirayat'		=> '',
					'tilawah_nilai'			=> '',
					'tilawah_predikat'		=> '',
					'tahsin'				=> '',
					'tahsin_nilai'			=> '',
					'tahsin_predikat'		=> '',
					'catatan'				=> 'Saved By '.Session('nama').' at '.date('Y-m-d H:i:s'),
				]);
			}
			
			$response = [
				'tapel'		=> 'List Data tapel '.$tapel,
				'noinduk'	=> $noinduk,
				'tanggal'	=> $tanggal,
				'kelas'		=> $kelas,
			];
			return response()->json($response, 200);
		} else if ($workcode == 'getdatabyid'){
			$nama 					= '';
			$kelas					= '';
			$noinduk				= '';
			$ziyadah_mulaisurah 	= '';
			$ziyadah_mulaiayat		= '';
			$ziyadah_akhirsurah		= '';
			$ziyadah_akhirayat		= '';
			$ziyadah_nilai			= '';
			$ziyadah_predikat		= '';
			$murojaah_mulaisurah	= '';
			$murojaah_mulaiayat		= '';
			$murojaah_akhirsurah	= '';
			$murojaah_akhirayat		= '';
			$murojaah_nilai			= '';
			$murojaah_predikat		= '';
			$murojaahdirumaha		= '';
			$murojaahdirumahb		= '';
			$persiapanhafalanbesok	= '';
			$murojaahkemarin		= '';
			$mendengaraudio			= '';
			$murojaahhariini		= '';
			$tanggal				= '';
			$i 						= 0;
			$tlsdash 				= 0;
			$arrmarkid 				= str_split($request->val01);
			foreach($arrmarkid as $rid){
				if ($i < 8){
					if ($tlsdash == 4){
						$tanggal	= $tanggal.'-'.$rid;
						$tlsdash	= 3;
					} else {
						$tanggal	= $tanggal.$rid;
						$tlsdash++;
					}
				} else {
					$noinduk 		= $noinduk.$rid;
				}
				$i++;
			}
			$getdatahalaqohdirumah 	= Datasetorantahfid::where('tanggal', $tanggal)->where('marking', 'LIKE', 'PR-%')->where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
			if (isset($getdatahalaqohdirumah->id)){
				$getrpa 				= KurikulumAlquran::where('realdate', $getdatahalaqohdirumah->tanggal)->where('kelas', $getdatahalaqohdirumah->kelas)->where('id_sekolah', $getdatahalaqohdirumah->id_sekolah)->first();
				$tanggal 				= $getdatahalaqohdirumah->tanggal ?? date('Y-m-d');
				$nama 					= $getdatahalaqohdirumah->nama ?? '';
				$kelas					= $getdatahalaqohdirumah->kelas ?? '';
				$noinduk				= $getdatahalaqohdirumah->noinduk ?? '';
				$ziyadah_mulaisurah 	= $getdatahalaqohdirumah->ziyadah_mulaisurah ?? '';
				$ziyadah_mulaiayat		= $getdatahalaqohdirumah->ziyadah_mulaiayat ?? '';
				$ziyadah_akhirsurah		= $getdatahalaqohdirumah->ziyadah_akhirsurah ?? '';
				$ziyadah_akhirayat		= $getdatahalaqohdirumah->ziyadah_akhirayat ?? '';
				$ziyadah_nilai			= $getdatahalaqohdirumah->ziyadah_nilai ?? '';
				$ziyadah_predikat		= $getdatahalaqohdirumah->ziyadah_predikat ?? '';
				$murojaah_mulaisurah	= $getdatahalaqohdirumah->murojaah_mulaisurah ?? '';
				$murojaah_mulaiayat		= $getdatahalaqohdirumah->murojaah_mulaiayat ?? '';
				$murojaah_akhirsurah	= $getdatahalaqohdirumah->murojaah_akhirsurah ?? '';
				$murojaah_akhirayat		= $getdatahalaqohdirumah->murojaah_akhirayat ?? '';
				$murojaah_nilai			= $getdatahalaqohdirumah->murojaah_nilai ?? '';
				$murojaah_predikat		= $getdatahalaqohdirumah->murojaah_predikat ?? '';
				$murojaahdirumah		= $getrpa->murojaahdirumah ?? '';
				$persiapanhafalanbesok	= $getrpa->persiapanhafalanbesok ?? '';
				$murojaahkemarin		= $getrpa->murojaahkemarin ?? '';
				$mendengaraudio			= $getrpa->mendengaraudio ?? '';
				$murojaahhariini		= $getrpa->murojaahhariini ?? '';
				
				if ($murojaahdirumah != ''){
					$arrmrj 			= explode('s/d', $murojaahdirumah);
					if (isset($arrmrj[1])){
						$murojaahdirumaha		= $arrmrj[0];
						$murojaahdirumahb		= $arrmrj[1];
					}
				}
			} else {
				$getdata 			= Datainduk::where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
				if (isset($getdata->id)){
					$getdatahalaqohdirumah 	= Datasetorantahfid::where('noinduk', $getdata->noinduk)->where('id_sekolah',  $getdata->id_sekolah)->first();
					$getrpa 				= KurikulumAlquran::where('realdate', $tanggal)->where('kelas', $getdata->jilid)->where('id_sekolah', $getdata->id_sekolah)->first();
					$nama 					= $getdatahalaqohdirumah->nama ?? '';
					$kelas					= $getdatahalaqohdirumah->kelas ?? '';
					$noinduk				= $getdatahalaqohdirumah->noinduk ?? '';
					$ziyadah_mulaisurah 	= $getdatahalaqohdirumah->ziyadah_mulaisurah ?? '';
					$ziyadah_mulaiayat		= $getdatahalaqohdirumah->ziyadah_mulaiayat ?? '';
					$ziyadah_akhirsurah		= $getdatahalaqohdirumah->ziyadah_akhirsurah ?? '';
					$ziyadah_akhirayat		= $getdatahalaqohdirumah->ziyadah_akhirayat ?? '';
					$ziyadah_nilai			= $getdatahalaqohdirumah->ziyadah_nilai ?? '';
					$ziyadah_predikat		= $getdatahalaqohdirumah->ziyadah_predikat ?? '';
					$murojaah_mulaisurah	= $getdatahalaqohdirumah->murojaah_mulaisurah ?? '';
					$murojaah_mulaiayat		= $getdatahalaqohdirumah->murojaah_mulaiayat ?? '';
					$murojaah_akhirsurah	= $getdatahalaqohdirumah->murojaah_akhirsurah ?? '';
					$murojaah_akhirayat		= $getdatahalaqohdirumah->murojaah_akhirayat ?? '';
					$murojaah_nilai			= $getdatahalaqohdirumah->murojaah_nilai ?? '';
					$murojaah_predikat		= $getdatahalaqohdirumah->murojaah_predikat ?? '';
					$murojaahdirumah		= $getrpa->murojaahdirumah ?? '';
					$persiapanhafalanbesok	= $getrpa->persiapanhafalanbesok ?? '';
					$murojaahkemarin		= $getrpa->murojaahkemarin ?? '';
					$mendengaraudio			= $getrpa->mendengaraudio ?? '';
					$murojaahhariini		= $getrpa->murojaahhariini ?? '';
					if ($murojaahdirumah != ''){
						$arrmrj 			= explode('s/d', $murojaahdirumah);
						if (isset($arrmrj[1])){
							$murojaahdirumaha		= $arrmrj[0];
							$murojaahdirumahb		= $arrmrj[1];
						}
					}
				}
			}
			if ($murojaah_mulaiayat == ''){ $murojaah_mulaiayat = $murojaahdirumaha; }
			if ($murojaah_akhirayat == ''){ $murojaah_akhirayat = $murojaahdirumahb; }
			$response = [
				'nama'					=> $nama,
				'kelas'					=> $kelas,
				'noinduk'				=> $noinduk,
				'tanggal'				=> $tanggal,
				'ziyadah_mulaisurah'	=> $ziyadah_mulaisurah,
				'ziyadah_mulaiayat'		=> $ziyadah_mulaiayat,
				'ziyadah_akhirsurah'	=> $ziyadah_akhirsurah,
				'ziyadah_akhirayat'		=> $ziyadah_akhirayat,
				'ziyadah_nilai'			=> $ziyadah_nilai,
				'ziyadah_predikat'		=> $ziyadah_predikat,
				'murojaah_mulaisurah'	=> $murojaah_mulaisurah,
				'murojaah_mulaiayat'	=> $murojaah_mulaiayat,
				'murojaah_akhirsurah'	=> $murojaah_akhirsurah,
				'murojaah_akhirayat'	=> $murojaah_akhirayat,
				'murojaah_nilai'		=> $murojaah_nilai,
				'murojaah_predikat'		=> $murojaah_predikat,
				'murojaahdirumaha'		=> $murojaahdirumaha,
				'murojaahdirumahb'		=> $murojaahdirumahb,
				'persiapanhafalanbesok'	=> $persiapanhafalanbesok,
				'murojaahkemarin'		=> $murojaahkemarin,
				'mendengaraudio'		=> $mendengaraudio,
				'murojaahhariini'		=> $murojaahhariini,
			];
			return response()->json($response, 200);
		} else if ($workcode == 'getdatabynoinduktgl'){
			$ceksudah 				= Datasetorantahfid::where('marking', 'LIKE', 'PR-%')->where('noinduk', $request->noinduk)->where('tanggal', $request->tanggal)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
			$getrpa 				= KurikulumAlquran::where('realdate', $request->tanggal)->where('kelas', $request->kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
			$response = [
				'murojaahdirumah'		=> $getrpa->murojaahdirumah ?? '',
				'persiapanhafalanbesok'	=> $getrpa->persiapanhafalanbesok ?? '',
				'murojaahkemarin'		=> $getrpa->murojaahkemarin ?? '',
				'mendengaraudio'		=> $getrpa->mendengaraudio ?? '',
				'murojaahhariini'		=> $getrpa->murojaahhariini ?? '',
				'tahsin'				=> $getrpa->tahsin ?? '',
				'tilawah'				=> $getrpa->tilawah ?? '',
				'murojaahsabtuahad'		=> $getrpa->murojaahsabtuahad ?? '',
				'ziyadah_nilai'			=> $ceksudah->ziyadah_nilai ?? '',
				'murojaah_nilai'		=> $ceksudah->murojaah_nilai ?? '',
				'tilawah_nilai'			=> $ceksudah->tilawah_nilai ?? '',
				'tahsin_nilai'			=> $ceksudah->tahsin_nilai ?? '',
			];
			return response()->json($response, 200);
		} else if ($workcode == 'laporprharian'){
			$tapel 		= $request->tapel;
			$semester 	= $request->semester;
			if ($tapel == '' OR $tapel == '-' OR $tapel == null){
				$getdatauser	= Datasetorantahfid::whereNotNull('tapel')->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('updated_at', 'DESC')->first();
				if (isset($getdatauser->tapel)){
					$tapel 		= $getdatauser->tapel;
					$semester 	= $getdatauser->semester;
				}
			}
			
			$getrpa 				= KurikulumAlquran::where('realdate', $request->tanggal)->where('kelas', $request->kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
			if (isset($getrpa->id)){
				$marking 			= 'PR-'.$getrpa->id;
			} else {
				$marking 			= 'PR-'.time();
			}
			$persiapanhafalanbesok	= $request->persiapanhafalanbesok;
			$murojaahdirumah		= $request->murojaahdirumah;
			$tilawah				= $request->tilawah;
			$murojaahsabtuahad		= $request->murojaahsabtuahad;
			if ($tilawah == 1){
				$n01				= '&#10004;';
				$tilawah			= $request->tekstilawah;
			} else {
				$n01				= null;
				$tilawah			= null;
			}
			if ($murojaahdirumah == 1){
				$n02				= '&#10004;';
				$murojaahdirumah	= $request->teksmurojaahdirumah;
			} else {
				$n02				= null;
				$murojaahdirumah	= null;
			}
			if ($murojaahsabtuahad == 1){
				$n03				= '&#10004;';
				$murojaahsabtuahad	= $request->teksmurojaahsabtuahad;
			} else {
				$n03				= null;
				$murojaahsabtuahad	= null;
			}
			if ($persiapanhafalanbesok == 1){
				$n04				= '&#10004;';
				$persiapanhafalanbesok	= $request->tekspersiapanhafalanbesok;
			} else {
				$n04				= null;
				$persiapanhafalanbesok	= null;
			}
			try {
                $ceksudah 			= Datasetorantahfid::where('marking', 'LIKE', 'PR-%')->where('noinduk', $request->noinduk)->where('tanggal', $request->tanggal)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
				if (isset($ceksudah->id)){
					Datasetorantahfid::where('id', $ceksudah->id)->update([
						'inputor'				=> 'walisantri',
						'marking'				=> $marking,
						'ziyadah_mulaisurah'	=> $persiapanhafalanbesok,
						'ziyadah_nilai'			=> $n04,
						'murojaah_mulaisurah'	=> $murojaahdirumah,
						'murojaah_nilai'		=> $n02,
						'tilawah_mulaisurah'	=> $tilawah,
						'tilawah_nilai'			=> $n01,
						'tahsin'				=> $murojaahsabtuahad,
						'tahsin_nilai'			=> $n03,
						'catatan'				=> 'Saved By '.Session('nama').' at '.date('Y-m-d H:i:s'),
					]);
					$message = 'Data an .'.$request->nama.' Tanggal '.$request->tanggal.' Berhasil di Update';
				} else {
					$cektanggal 	= Datasetorantahfid::where('tanggal', $request->tanggal)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
					if ($cektanggal == 0){
						$message = 'Tanggal Tidak Valid, Periksa apakah tanggal yang Bapak/Ibu masukkan sesuai dengan tanggal aktif sekolah';
					} else {
						Datasetorantahfid::create([
							'inputor'				=> 'walisantri',
							'nama'					=> $request->nama,
							'kelas'					=> $request->kelas,
							'tapel'					=> $tapel,
							'semester'				=> $semester,
							'jilid'					=> $request->kelas,
							'noinduk'				=> $request->noinduk,
							'tanggal'				=> $request->tanggal,
							'marking'				=> $marking,
							'keybengakcrash'		=> session('sekolah_id_sekolah').'_'.$marking.'_'.$request->noinduk.'_'.$request->tanggal,
							'id_sekolah'			=> session('sekolah_id_sekolah'),
							'ziyadah_mulaisurah'	=> $persiapanhafalanbesok,
							'ziyadah_nilai'			=> $n04,
							'murojaah_mulaisurah'	=> $murojaahdirumah,
							'murojaah_nilai'		=> $n02,
							'tilawah_mulaisurah'	=> $tilawah,
							'tilawah_nilai'			=> $n01,
							'tahsin'				=> $murojaahsabtuahad,
							'tahsin_nilai'			=> $n03,
							'catatan'				=> 'Saved By '.Session('nama').' at '.date('Y-m-d H:i:s'),
						]);
						$message = 'Data an .'.$request->nama.' Tanggal '.$request->tanggal.' Berhasil di Simpan';
					}
				}
            } catch (\Exception $e) {
                $message = $e->getMessage();
            }
			
			$response = [
				'status'	=> 'Info',
				'message'	=> $message,
				'warna'		=> '#5ba035',
				'icon'		=> 'info',
			];
			return response()->json($response, 200);
		} else if ($workcode == 'getstatistikbyid'){
			$tapel 				= $request->tapel;
			$semester 			= $request->semester;
			$generatesurat		= '<table class="table table-striped table-bordered" width="100%"><thead><tr><th colspan="5" width="100%"><strong>Disiplin Setoran AlQuran</strong></th></tr></thead><tbody><tr><td colspan="2" width="40%">Deskripsi</td><td width="20%">Hari Efektif</td><td width="20%">Setoran</td><td width="20%">Prosentase</td></tr>';
			$total  			= Datasetorantahfid::where('semester',$semester)->where('tapel',$tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->groupBy('tanggal')->get();
			$total 				= count($total);
			$getdata 			= Datainduk::where('noinduk', $request->val01)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
			if (isset($getdata->id)){
				$zydsekolah 	= Datasetorantahfid::whereNotNull('ziyadah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'NOT LIKE', 'PR-%')->where('noinduk', $getdata->noinduk)->where('id_sekolah', $getdata->id_sekolah)->count();
				$mrjsekolah 	= Datasetorantahfid::whereNotNull('murojaah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'NOT LIKE', 'PR-%')->where('noinduk', $getdata->noinduk)->where('id_sekolah', $getdata->id_sekolah)->count();
				$zydrumah 		= Datasetorantahfid::whereNotNull('ziyadah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'LIKE', 'PR-%')->where('noinduk', $getdata->noinduk)->where('id_sekolah', $getdata->id_sekolah)->count();
				$mrjrumah 		= Datasetorantahfid::whereNotNull('murojaah_nilai')->where('tapel', $tapel)->where('semester', $semester)->where('marking', 'LIKE', 'PR-%')->where('noinduk', $getdata->noinduk)->where('id_sekolah', $getdata->id_sekolah)->count();
				if ($total != 0 AND $zydsekolah != 0){
					$prszydsekolah	= round(($total/$zydsekolah), 0);
				} else {
					$prszydsekolah	= 0;
				}
				if ($total != 0 AND $mrjsekolah != 0){
					$prsmrjsekolah	= round(($total/$mrjsekolah), 0);
				} else {
					$prsmrjsekolah	= 0;
				}
				if ($total != 0 AND $zydrumah != 0){
					$prszydrumah	= round(($total/$zydrumah), 0);
				} else {
					$prszydrumah	= 0;
				}
				if ($total != 0 AND $mrjrumah != 0){
					$prsmrjrumah	= round(($total/$mrjrumah), 0);
				} else {
					$prsmrjrumah	= 0;
				}
				$generatesurat 	= $generatesurat.'<tr><td rowspan="2" width="30%">Sekolah<br />'.$tapel.'/'.$semester.'</td><td width="10%">Ziyadah</td><td>'.$total.'</td><td>'.$zydsekolah.'</td><td>'.$prszydsekolah.' %</td></tr>';
				$generatesurat 	= $generatesurat.'<tr><td>Murojaah</td><td>'.$total.'</td><td>'.$mrjsekolah.'</td><td>'.$prsmrjsekolah.' %</td></tr>';
				$generatesurat 	= $generatesurat.'<tr><td rowspan="2" width="30%">Rumah<br />'.$tapel.'/'.$semester.'</td><td width="10%">Voice Note</td><td>'.$total.'</td><td>'.$zydrumah.'</td><td>'.$prszydrumah.' %</td></tr>';
				$generatesurat 	= $generatesurat.'<tr><td>Murojaah</td><td>'.$total.'</td><td>'.$mrjrumah.'</td><td>'.$prsmrjrumah.' %</td></tr>';
			}
			$generatesurat 	= $generatesurat.'</tbody></table>';
			$response = [
				'generatesurat' => $generatesurat,
			];
			return response()->json($response, 200);
		} 
	}
	public function exDataRPA(Request $request) {
		$workcode 	= $request->workcode;
		if ($workcode == 'updatetemplate'){
			$update 	= MushafHalaman::where('id', $request->id)->update([
				'namasurah'	=> $request->nama,
				'halaman'	=> $request->halaman,
				'kata'		=> $request->kata
			]);
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Updated']);
				return back();
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
				return back();
			}
		} else if ($workcode == 'mapping'){
			$update 	= Datainduk::where('id', $request->id)->update([
				'jilid'			=> $request->kelas,
				'updated_at'	=> date('Y-m-d H:i:s')
			]);
			if ($update){
				$datainduk = Datainduk::where('id', $request->id)->first();
				Datasetorantahfid::where('noinduk', $datainduk->noinduk)->where('id_sekolah', $datainduk->id_sekolah)->update([
					'kelas'	=> $datainduk->jilid
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Updated']);
				return back();
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
				return back();
			}
		} else if ($workcode == 'tambahkelasrpa'){
			$kelas 		= $request->val01;
			$sql 		= KurikulumAlquran::where('tahun', date('Y'))->where('kelas', $kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('realdate', 'ASC')->get();
			$cek 		= count($sql);
			if ($cek == 0){
				$year 			= date('Y');
        		$datesToSave 	= [];
				for ($month = 1; $month <= 12; $month++) {
					for ($day = 1; $day <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $day++) {
						$completeDate 		= sprintf('%04d-%02d-%02d', $year, $month, $day);
						$dayName 			= date('l', strtotime($completeDate));
						$indonesianDayName 	= $this->translateDayName($dayName);
						$datesToSave[] = [
							'kelas'		=> $kelas,
							'tanggal' 	=> $day,
							'bulan' 	=> $month,
							'tahun' 	=> $year,
							'hari' 		=> $indonesianDayName,
							'realdate'	=> $completeDate,
							'id_sekolah'=> Session('sekolah_id_sekolah'),
							'created_by'=> Session('nama'),
							'updated_by'=> Session('nip'),
						];
					}
				}
				KurikulumAlquran::insert($datesToSave);
				$cek 		= KurikulumAlquran::where('tahun', date('Y'))->where('kelas', $kelas)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Updated Sejumlah '.$cek]);
			return back();
		} else if ($workcode == 'resetlaporanpr'){
			$noinduk 	= $request->noinduk;
			$tanggal 	= $request->tanggal;
			$ceksek 	= Datasetorantahfid::where('noinduk', $noinduk)->where('tanggal', $tanggal)->where('marking', 'LIKE', 'PR-%')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($ceksek->id)){
				$update = Datasetorantahfid::where('id', $ceksek->id)->update([
					'ziyadah_nilai'			=> null,
					'ziyadah_predikat'		=> null,
					'murojaah_nilai'		=> null,
					'murojaah_predikat'		=> null,
					'tilawah_nilai'			=> null,
					'tilawah_predikat'		=> null,
					'tahsin_nilai'			=> null,
					'tahsin_predikat'		=> null,
					'catatan'				=> 'Data di Koreksi dan di Reset Oleh '.Session('nama').' pada '.date('Y-m-d H:i:s'),
				]);
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Berhasil di Reset']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Data Tidak Di Temukan', 'message' => 'Data Setoran di Rumah untuk No.Induk '.$noinduk.' Tanggal '.$tanggal.' Gagal di Reset, Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Data Tidak Di Temukan', 'message' => 'Data Setoran di Rumah untuk No.Induk '.$noinduk.' Tanggal '.$tanggal.' Tidak di Temukan']);
				return back();
			}
		} else if ($workcode == 'resetlaporanhalaqohsekolahperanak'){
			$noinduk 	= $request->noinduk;
			$tanggal 	= $request->tanggal;
			$ceksek 	= Datasetorantahfid::where('noinduk', $noinduk)->where('tanggal', $tanggal)->where('marking', 'NOT LIKE', 'PR-%')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($ceksek->id)){
				$update = Datasetorantahfid::where('id', $ceksek->id)->update([
					'ziyadah_nilai'			=> null,
					'ziyadah_predikat'		=> null,
					'murojaah_nilai'		=> null,
					'murojaah_predikat'		=> null,
					'tilawah_nilai'			=> null,
					'tilawah_predikat'		=> null,
					'tahsin_nilai'			=> null,
					'tahsin_predikat'		=> null,
					'catatan'				=> 'Data di Koreksi dan di Reset Oleh '.Session('nama').' pada '.date('Y-m-d H:i:s'),
				]);
				if ($update){
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Berhasil di Reset']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Data Tidak Di Temukan', 'message' => 'Data Setoran di Rumah untuk No.Induk '.$noinduk.' Tanggal '.$tanggal.' Gagal di Reset, Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Data Tidak Di Temukan', 'message' => 'Data Setoran di Rumah untuk No.Induk '.$noinduk.' Tanggal '.$tanggal.' Tidak di Temukan']);
				return back();
			}
		} else if ($workcode == 'resetlaporansekolah'){
			$kelas 		= $request->kelas;
			$tanggal 	= $request->tanggal;
			$ceksek 	= Datasetorantahfid::where('kelas', $kelas)->where('tanggal', $tanggal)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($ceksek->id)){
				$update 	= Datasetorantahfid::where('kelas', $kelas)->where('tanggal', $tanggal)->where('id_sekolah', session('sekolah_id_sekolah'))->delete();
				if ($update){
					Logstaff::create([
						'jenis'		=> 'Perubahan Nilai',
						'sopo'		=> Session('nip'),
						'kelakuan'	=> Session('nama').' Menghapus Data Halaqoh '.json_encode($ceksek).' Pada '.date('Y-m-d H:i:s'),
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Berhasil di Hapus']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Data Tidak Di Temukan', 'message' => 'Data Setoran di Rumah untuk No.Induk '.$noinduk.' Tanggal '.$tanggal.' Gagal di Reset, Ulangi Beberapa Saat Lagi']);
					return back();
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Data Tidak Di Temukan', 'message' => 'Data Setoran di Rumah untuk No.Induk '.$noinduk.' Tanggal '.$tanggal.' Tidak di Temukan']);
				return back();
			}
		} else {
			$id 	= $request->id;
			$data 	= KurikulumAlquran::findOrFail($id);
			if ($data){
				$data->update($request->all());
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Updated']);
				return back();
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
				return back();
			}
		}
	}
	public function viewBeasiswa() {
		$data   					= [];
		if (Session('previlage') !== null){
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['sidebar']			= 'beasiswa';
			$datethn1 					= date("Y"); 
			$datethn2 					= $datethn1 + 1; 
			$datethn3 					= $datethn1 - 1;
			$datethn4 					= $datethn1 - 2;
			$tapel1 					= $datethn4.'-'.$datethn3;
			$tapel2						= $datethn3.'-'.$datethn1;
			$tapel3 					= $datethn1.'-'.$datethn2;
			$data['datethn1']			= $datethn1;
			$data['datethn2']			= $datethn2;
			$data['datethn3']			= $datethn3;
			$data['datethn4']			= $datethn4;
			$data['tahunne']			= date("Y");
			$data['tapel1']				= $tapel1;
			$data['tapel2']				= $tapel2;
			$data['tapel3']				= $tapel3;
			$data['tanggal']			= date("d-m-Y");
			$data['countakademik']		= Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapel', 'LIKE', '%'.$datethn1.'%')->where('jenis', 'Akademik')->count();
			$data['countnonakademik']	= Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapel', 'LIKE', '%'.$datethn1.'%')->where('jenis', 'Non Akademik')->count();
			$data['countsiswa']			= Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapel', 'LIKE', '%'.$datethn1.'%')->groupBy('noinduk')->count();
			$data['datasiswa']			= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nokelulusan', '')->get();
			return view('simaster.beasiswa', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
        	$data['kalimatbody']  		= 'Session Expired, Please Reloggin';
            return view('errors.notready', $data);
		}
	}
	public function jsonBeasiswa(Request $request) {
		$bulan   	= $request->val01;
		$tahun   	= $request->val02;
		$tahunini	= date("Y");
		if ($tahun == 'PERJENIS'){
			if ($bulan == 'ALL'){
				$getallthn 	= Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapel', 'LIKE', '%'.$tahunini.'%')->get();
			} else {
				$getallthn 	= Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jenis', $bulan)->where('tapel', 'LIKE', '%'.$tahunini.'%')->get();
			}
		} else {
			if ($tahun == 'TAHUNINI'){
				$getallthn 	= Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tapel', 'LIKE', '%'.$tahunini.'%')->get();
			} else {
				$getallthn 	= Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('created_at', 'LIKE', '%'.$tahun.'-'.$bulan.'%')->get();
			}
		}
		$alldata 	= [];
		$homebase	= url("/");
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$namafile 	= $rdatane->nmfile;
				$tipe 		= '';
				if ($namafile != ''){
					$arrtipe	= explode(".", $namafile);
					if (isset($arrtipe[1])){
						$tipe	= $arrtipe[1];
					}
				}
				$alldata[] 		= array(
					'id'			=> $rdatane->id,
					'noinduk'		=> $rdatane->noinduk,
					'nama'			=> $rdatane->nama,
					'kelas'			=> $rdatane->kelas,
					'tapel'			=> $rdatane->tapel,
					'jenis'			=> $rdatane->jenis,
					'namabeasiswa'	=> $rdatane->namabeasiswa,
					'jumlah'		=> $rdatane->jumlah,
					'nominal'		=> $rdatane->nominal,
					'nmfile'		=> $rdatane->getLampiran->xfile ?? '',
					'inputor'		=> $rdatane->inputor,
					'tipe'			=> strtolower($tipe)
				);
			}
		}
		echo json_encode($alldata);
	}
	public function exSimpanBeasiswa(Request $request) {
		$noinduk		= $request->val02;
		$namabeasiswa	= $request->val03;
		$jenis			= $request->val04;
		$nominal		= $request->val05;
		$jumlah			= $request->val06;
		$idne			= $request->val10;
		$tapel			= $request->val12;
		$file			= $request->file;
		$nominal 		= (int)str_replace(',','',$nominal);
		$jumlah 		= (int)str_replace(',','',$jumlah);
		
		$getkelas		= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('noinduk', $noinduk)->first();
		if (isset($getkelas->klspos)){
			$kelas 		= $getkelas->klspos;
			$nama 		= $getkelas->nama;
		} else { $kelas = ''; $nama = '';}
		
		if ($noinduk == 'hapus'){
			$getdata 	= Beasiswa::where('id', $idne)->first();
			$hapus 		= Beasiswa::where('id', $idne)->delete();
			if ($hapus){
				$deskripsi 	= 'Menghapus data Beasiswa an.'.$getdata->nama.' No.Induk : '.$getdata->noinduk.' Nama Beasiswa '.$getdata->namabeasiswa;
				Logstaff::create([
					'jenis'		=> 'db_beasiswa', 
					'sopo'		=> Session('nip'),
					'kelakuan'	=> $deskripsi,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $deskripsi]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
				return back();
			}
		} else {
			if ($nama == ''){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No Induk Tidak di Temukan']);
				return back();
			} else {
				if ($idne == 'new'){
					$cekdata = Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('noinduk', $noinduk)->where('namabeasiswa', $namabeasiswa)->where('tapel', $tapel)->count();
					if ($cekdata != 0){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
						return back();
					} else {
						$input = Beasiswa::create([
							'noinduk'		=> $noinduk,
							'nama'			=> $nama,
							'kelas'			=> $kelas,
							'tapel'			=> $tapel,
							'jenis'			=> $jenis,
							'namabeasiswa'	=> $namabeasiswa,
							'jumlah'		=> $jumlah,
							'nominal'		=> $nominal,
							'nmfile'		=> '',
							'inputor'		=> Session('nip'),
							'id_sekolah'	=> Session('sekolah_id_sekolah')
						]);
						if ($input){
							$idne = $input->id;
							if ($file != '') {
								$namafile 		= Session('sekolah_id_sekolah').'-BEASISWA-'.$idne;
								Beasiswa::where('id', $idne)->update([
									'nmfile'	=> $namafile,
								]);
								XFiles::create([
									'xmarking'	=> $namafile,
									'xtabel'	=> 'db_beasiswa',
									'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
									'xfile'		=> $request->file
								]);
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Beasiswa Telah di Tambahkan']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
							return back();
						}
					}
				} else {
					$cekdata = Beasiswa::where('id_sekolah', Session('sekolah_id_sekolah'))->where('id','!=', $idne)->where('noinduk', $noinduk)->where('namabeasiswa', $namabeasiswa)->where('tapel', $tapel)->count();
					if ($cekdata != 0){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
						return back();
					} else {
						$input = Beasiswa::where('id', $idne)->update([
							'noinduk'		=> $noinduk,
							'nama'			=> $nama,
							'kelas'			=> $kelas,
							'tapel'			=> $tapel,
							'jenis'			=> $jenis,
							'namabeasiswa'	=> $namabeasiswa,
							'jumlah'		=> $jumlah,
							'nominal'		=> $nominal,
							'inputor'		=> Session('nip'),
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
						if ($input){	
							if ($file != '') {
								$namafile 		= Session('sekolah_id_sekolah').'-BEASISWA-'.$idne;
								XFiles::where('xmarking', $namafile)->update([
									'xtabel'	=> 'db_beasiswa',
									'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
									'xfile'		=> $request->file
								]);
							}	
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Beasiswa Telah di Tambahkan']);
							return back();
						}else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Update Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
							return back();
						}
					}
				}
			}
		}
	}
	public function viewBuatqr() {
		$data				= [];
		$x					= 0;
		$getallqrcode		= QrCodeDatabase::where('inputor', Session('id'))->orderBy('id', 'DESC')->limit(30)->get();
		if (!empty($getallqrcode)){
			foreach($getallqrcode as $rows){
				if ($rows->jenis == 'Email'){
					$base64qr = base64_encode(QrCode::format('png')->size(150)->email( $rows->val01 ));
				} else if ($rows->jenis == 'Telpon'){
					$base64qr = base64_encode(QrCode::format('png')->size(150)->phoneNumber( $rows->val01 ));
				} else if ($rows->jenis == 'Geolocation'){
					$base64qr = base64_encode(QrCode::format('png')->size(150)->geo( $rows->val01, $rows->val02 ));
				} else if ($rows->jenis == 'VCard'){
					$getname 	= $rows->val01;
					$cekarray	= explode(" ", $getname);
					if (isset($cekarray[1])){
						$lastname = $cekarray[1];
						$surename = $cekarray[0];
					} else {
						$lastname = '-';
						$surename = $getname;
					}
					$base64qr = base64_encode(QrCode::format('png')->size(150)->encoding('UTF-8')->generate('BEGIN:VCARD\nVERSION:3.0\nN:'.$lastname.';'.$surename.'\nFN:'.$getname.'\nEMAIL:'.$rows->val03.'\nTEL;TYPE=voice,work,pref:'.$rows->val04.'\n ADR;TYPE=intl,work,postal,parcel:;;'.$rows->val02.';Malang;;67252;Indonesia\nEND:VCARD'));
				} else if ($rows->jenis == 'Wifi'){
					$base64qr = base64_encode(QrCode::format('png')->size(150)->wiFi([
						'ssid' 			=> $rows->val01,
						'encryption' 	=> 'WPA/WEP',
						'password' 		=> $rows->val02
					]));
				} else {
					$base64qr = base64_encode(QrCode::format('png')->size(150)->generate( $rows->val01 ));
				}
				$data['pengumumans'][$x]['id']          =   $rows->id;
                $data['pengumumans'][$x]['jenis']     	=   $rows->jenis;
                $data['pengumumans'][$x]['created_at']  =   $rows->created_at;
                $data['pengumumans'][$x]['val01']    	=   $rows->val01;
                $data['pengumumans'][$x]['val02']       =   $rows->val02;
                $data['pengumumans'][$x]['val03']       =   $rows->val03;
                $data['pengumumans'][$x]['val04']  		=   $rows->val04;
                $data['pengumumans'][$x]['base64qrcode']=   $base64qr;
                $x++;
			}
		}
		$data['sidebar']	= 'buatqr';
    	return view('buatqr', $data);
    }
	public function exCreateqrcode(Request $request) {
		$jenis		= $request->val05;
		$boleh 		= 'YA';
		$pesanerror = '';
		if ($jenis == 'Shortlink'){
			$cekdulu = ShortLink::where('slug', Str::slug($request->val01))->first();
			if (isset($cekdulu->id)){
				$boleh = 'TIDAK';
				$pesanerror = 'Nama Pendek '.Str::slug($request->val01).' Sudah digunakan untuk link '.$cekdulu->destination_url;
			} else {
				ShortLink::create([
					'slug' => Str::slug($request->val01),
					'destination_url' => $request->val02
				]);
			}
		}
		if ($boleh == 'YA'){
			$input = QrCodeDatabase::create([
				'inputor'	=> Session('id'),
				'jenis'		=> $request->input('val05'),
				'val01'		=> $request->input('val01'),
				'val02'		=> $request->input('val02'),
				'val03'		=> $request->input('val03'),
				'val04'		=> $request->input('val04')
			]);
			if ($input){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Sistem Will Generate '.$request->input('val05').' For 5 Second, Please Wait']);
				return back();
			} else {
				return response()->json(['status' => 'Error', 'message' => 'Sistem Error, Pastikan Semua isian Telah di isi']);
				return back();
			}
		} else {
			return response()->json(['status' => 'Error', 'message' => $pesanerror]);
			return back();
		}
		
	}
}
