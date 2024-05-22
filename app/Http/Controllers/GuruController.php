<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Chatting;
use App\Pengumuman;
use App\Datainduk;
use App\Dataindukstaff;
use App\Datakkm;
use App\Datatema;
use App\Datanilai;
use App\Datakd;
use App\Datapresensi;
use App\Datapresensiekskul;
use App\Datasetorantahfid;
use App\Logstaff;
use App\Ekstrakulikuler;
use App\Setkuangan;
use App\Loginputnilai;
use App\Setting;
use App\Konseling;
use App\Sekolah;
use App\Rapotan;
use App\Prestasi;
use App\Mushaflist;
use App\Ruang;
use App\SettingNilai;
use App\Presensifinger;
use Validator;
use Session;
use DateTime;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
class GuruController extends Controller
{
	public function viewLognilai() {
		$data   	=   [];
		$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		$groups 	= Logstaff::select(DB::Raw('DATE(created_at) day'))
						->where('id_sekolah',session('sekolah_id_sekolah'))
						->groupBy('day')
						->orderBy('created_at')
						->limit(30)
						->get();
		$y      	=   0;
		$x      	=   0;		
		foreach ($groups as $group) {
			$tanggal    = $group->day;
			$rsurat     = Logstaff::where('created_at', 'like', '%'. $tanggal . '%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
			foreach ($rsurat as $rowpeng) {
				$siapa          = $rowpeng->sopo;
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
		if (Session('previlage') == 'level1'){
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
		if (isset($getdatauser->klsajar)){
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
		$data['sidebar']			= 'lognilai';
		if (Session('previlage') == 'level1'){
			$arraypesertakelas		= [];
			$getdatanilaidiri 		= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->whereNotIn('statpeg', ['Non Aktif', 'Pensiun', 'Meninggal'])->get();
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
		return view('simaster.lapekskul', $data);
	}
	public function viewNilekskul() {
		$data   					= [];
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
	}
	public function viewLapabsen() {
		$data   		= [];
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($getdatauser->klsajar)){
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
	public function viewSetkkm() {
		$data   					= [];
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
		$data['sidebar']			= 'setkkm';
		return view('simaster.setkkm', $data);
	}
	public function viewRencanaPembelajaran() {
		$data		= [];
		$jgroupps	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('kelas')->select('kelas')->orderBy('kelas')->get();
		$i			= 0;
        foreach ($jgroupps as $rgrpklas) {
            $j  		= 0;
            $kelas	= $rgrpklas->kelas;
            $jklas  	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->where('kelas', $kelas)->get();
            foreach ($jklas as $rklas) {
                $data['matpels'][$i][$j]['matpel']	=   $rklas->matpel.'( '.$rklas->muatan.' )';
                $data['matpels'][$i][$j]['id']		=   $rklas->id;
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
		}
		$getdatauser	= User::where('id', Session('id'))->first();
		if (isset($getdatauser->klsajar)){
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
		$data['sidebar']			= 'rps';
		$data['ruangans']			= Ruang::where('fakultas', Session('sekolah_id_sekolah'))->get();
		$data['dataguru']			= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->get();
		$data['klsajar']			= $klsajar;
		$data['smt']				= $smt;
		$data['tapel']				= $tapel;
		$data['setidkelas']			= $klsajar;
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3'){
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
			if (isset($getdatauser->klsajar)){
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
		} else {
			if ($idne == 'baru'){
				$cekmatkul = Datakkm::where('id', $request->val09)->first();
				if (isset($cekmatkul->id)){
					$cekmasuk = Datakd::where('muatan', $cekmatkul->muatan)
									->where('kelas', $cekmatkul->kelas)
									->where('kodekd', $request->val07)
									->where('tema', $request->val02)
									->where('subtema', $request->val03)
									->where('id_sekolah',session('sekolah_id_sekolah'))->count();
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
							'id_sekolah'	=> session('sekolah_id_sekolah')
						]);
						if ($kerja){
							$sukses = $sukses. 'Data Kode KD Kelas '.$cekmatkul->kelas.' Mata Pelajaran '.$cekmatkul->matpel.' Berhasil di Input';
						} else {
							$error = $error.'Gagal Input Sistem Error, Silahkan Coba Beberapa Saat Lagi.';
						}
					} else {
						$error = $error.'Gagal Input Kode '.$request->val07.' Untuk Mata Pelajaran '.$cekdata->matpel.' Kelas '.$cekdata->kelas.' Pada Tema '.$cekdata->tema.'('.$cekdata->subtema.') Sudah ada, mohon mengggantinya dengan kode unik lainnya';
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
		$iduser						= Session('id');
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
		$getdatauser				= User::where('id', $iduser)->first();
		if (isset($getdatauser->klsajar)){
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
					$data['datasiswa'][$y]['nama']  	= $hasil->nama;
					$data['datasiswa'][$y]['noinduk'] 	= $hasil->noinduk;
					$data['datasiswa'][$y]['kelas'] 	= $hasil->klspos;
					$data['datasiswa'][$y]['urutan'] 	= $urutan;
					$data['datasiswa'][$y]['nisn'] 		= $hasil->nisn;
					$data['datasiswa'][$y]['alamat'] 	= $hasil->alamatortu;
					$data['datasiswa'][$y]['foto'] 		= $hasil->foto;
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
			if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3'){
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
		$data 			= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3'){
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
			$minkelasa		= $masterkls.'A';
			$minkelasb		= $masterkls.'B';
			$minkelasc		= $masterkls.'C';
			$minkelasd		= $masterkls.'D';
			$minkelase		= $masterkls.'E';
			$minkelasf		= $masterkls.'F';
			$minkelasg		= $masterkls.'G';
			$minkelash		= $masterkls.'H';
			$minkelasi		= $masterkls.'I';

			$masterklsa		= ($masterkls+1).'A';
			$masterklsb		= ($masterkls+1).'B';
			$masterklsc		= ($masterkls+1).'C';
			$masterklsd		= ($masterkls+1).'D';
			$masterklse		= ($masterkls+1).'E';
			$masterklsf		= ($masterkls+1).'F';
			$masterklsg		= ($masterkls+1).'G';
			$masterklsh		= ($masterkls+1).'H';
			$masterklsi		= ($masterkls+1).'I';
			if (session('sekolah_level') == 1){
				$data['minkelasa']	= 'TA-A.1';
				$data['minkelasb']	= 'TA-A.2';
				$data['minkelasc']	= 'TA-A.3';

				$data['masterklsa']	= 'TA-B.1';
				$data['masterklsb']	= 'TA-B.2';
				$data['masterklsc']	= 'TA-B.3';
			} else if (session('sekolah_level') == 2){
				$data['minkelasa']	= $minkelasa;
				$data['minkelasb']	= $minkelasb;
				$data['minkelasc']	= $minkelasc;

				$data['masterklsa']	= $masterklsa;
				$data['masterklsb']	= $masterklsb;
				$data['masterklsc']	= $masterklsc;
			} else {
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
			$tahun			= date("Y");
			$tanggal		= date("Y-m-d");
			$iduser			= Session('id');
			$getdatauser	= User::where('id', $iduser)->first();
			if (isset($getdatauser->klsajar)){
				$klsajar		= $getdatauser->klsajar;
				$smt 			= $getdatauser->smt;
				$tapel 			= $getdatauser->tapel;
			} else {
				$klsajar		= '';
				$smt 			= '';
				$tapel 			= '';
			}
			$getkomponennilai 	= SettingNilai::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $masterkls)->where('semester', $smt)->where('tapel', $tapel)->get();
			$arraykomponen 		= [];
			$arraymatpel	 	= [];
			$i 					= 0;
			if (!$getkomponennilai->isEmpty()) {
				foreach ($getkomponennilai as $komponen) {
					$nilai_types = ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05', 'pts', 'pat'];
					foreach ($nilai_types as $type) {
						if ($komponen->$type == 1) {
							$arraykomponen[$i++] = [
								'namakomponen' 	=> ucfirst($type == 'pts' ? 'PTS' : ($type == 'pat' ? 'PAT' : "Penilaian Harian " . substr($type, 1))),
								'nilaike' 		=> $type,
								'idsetting' 	=> $komponen->id,
								'idkd' 			=> $komponen->idkd,
								'deskripsi' 	=> $komponen->deskripsi,
								'muatan' 		=> $komponen->muatan,
								'kodekd' 		=> $komponen->kodekd,
							];
						}
					}
					$arraymatpel[] = [
						'muatan' => $komponen->muatan,
						'matpel' => $komponen->matpel,
					];
				}
			}
			$arraymatpel		= collect($arraymatpel)->unique(function ($item) {
									return $item['muatan'] . '-' . $item['matpel'];
								})->values()->all();
			if ($i == 0){
				$arraykomponen[0] = array(
					'namakomponen'		=> 'No Data',
					'nilaike'			=> 'no data',
					'idsetting'			=> '0',
					'idkd'				=> '0',
					'deskripsi'			=> 'Setting Penilaian belum di Set',
				);
				$arraymatpel[0] = array(
					'muatan'		=> 'no data',
					'matpel'		=> '-',
				);
			}
			$getdatanilaidiri 			= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('klspos', $setidkelas)->get();
			if (!$getdatanilaidiri->isEmpty()) {
				foreach ($getdatanilaidiri as $rows) {
					$ceksudahrapot 			= Rapotan::where('noinduk', $rows->noinduk)->where('kelas', $setidkelas)->first();
					$ceksudahabsen 			= Datapresensi::where('noinduk', $rows->noinduk)->where('tanggal', $tanggal)->first();
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
			}
			$jgroupps	= Datakd::where('id_sekolah',session('sekolah_id_sekolah'))->where('kelas', $masterkls)->where('semester', $smt)->groupBy('muatan')->select('muatan')->orderBy('muatan')->get();
			$i			= 0;
			foreach ($jgroupps as $rgrpklas) {
				$j  		= 0;
				$muatan		= $rgrpklas->muatan;
				$jklas  	= Datakd::where('id_sekolah', Session('sekolah_id_sekolah'))->where('kelas', $masterkls)->where('semester', $smt)->where('muatan', $muatan)->get();
				foreach ($jklas as $rklas) {
					$data['komponendasar'][$i][$j]['deskripsi']	=   $rklas->kodekd.'( '.$rklas->deskripsi.' )';
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
				$data['komponendasar'][0][0]['matdeskripsipel']	=   'No Data';
				$data['komponendasar'][0][0]['id']				=   '0';
			}
			$data['arraymatpel']		= $arraymatpel;
			$data['arraykomponen']		= $arraykomponen;
			$data['masterkls']			= $masterkls;
			$data['setidkelas']			= $setidkelas;
			$data['klsajar']			= $klsajar;
			$data['smt']				= $smt;
			$data['tapel']				= $tapel;
			$data['datasiswa']			= $arraypesertakelas;
			$data['jadwal']				= DB::table('jadwal_pembelajaran')->where('id_sekolah',session('sekolah_id_sekolah'))->where('kelas', $masterkls)->where('semester', $smt)->where('guruterjadwal', Session('nama'))->get();
			$data['ruangans']			= Ruang::where('fakultas', Session('sekolah_id_sekolah'))->get();
			$data['sidebar']			= 'grade'.$setidkelas;
			$data['tahunne']			= $tahun;
			$data['tanggal']			= $tanggal;
			return view('simaster.penilaian', $data);
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
		if (isset($getdatauser->klsajar)){
			$klsajar	= $getdatauser->klsajar;
			$smt		= $getdatauser->smt;
			$tapel		= $getdatauser->tapel;
		} else {
			$klsajar	= '';
			$smt		= '';
			$tapel		= '';
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
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3'){
			return view('simaster.penilaianalquran', $data);
		} else {
			$data['kalimatheader']  = 'Mohon Maaf';
			$data['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $data);
		}
  	}
	public function viewNgajiDashboard() {
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		if (isset($getdatauser->klsajar)){
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
		$data   					= [];
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
		$data['sidebar']			= 'lognilai';
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3'){
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
		$rmatpel			= Datakd::where('id', $idkd)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($rmatpel->temake)){
			$tema			= $rmatpel->tema;
			$subtema 		= $rmatpel->subtema;
			$kkm 			= $rmatpel->kkm;
		} else {
			$tema			= 0;
			$subtema 		= 0;
			$kkm			= 0;
		}
		$sukses   		= 0;
		$gagal    		= '';
		$tanggal		= date("Y-m-d h:s:m");
		$tanggalmark	= date("Y-m-d");
		$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.Session('nip').'-'.$tanggalmark.'-NIL-'.$idsetting.'-'.$jenisnilai;
		$ceksudah		= Loginputnilai::where('marking', $markingguru)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
		if ($ceksudah == 0){
			foreach ( $jnilai as $datanilai ){
				$nilai 		= $datanilai['nilainya'];
				$noinduk	= $datanilai['noinduk'];
				$nama		= $datanilai['namanya'];
				$marking 	= $markingguru.'-'.$noinduk;
				$ceksudah	= Datanilai::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($ceksudah == 0){
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
						'penginput'		=> Session('nip'), 
						'tanggal'		=> $tanggal, 
						'jennilai'		=> $jenisnilai, 
						'marking'		=> $marking, 
						'deskripsi'		=> $deskripsi, 
						'kkm'			=> $kkm,
						'id_sekolah'	=> session('sekolah_id_sekolah')
					]);
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
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
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
		$markingguru	= $tapel.'-'.$semester.'-'.$kelas.'-'.Session('nip').'-'.$tanggalmark.'-DIRI';
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
			$eks1				= $datanilai['eks1'];
			$ekstrakulikuler1	= $datanilai['ekstrakulikuler1'];
			$eks2				= $datanilai['eks2'];
			$ekstrakulikuler2	= $datanilai['ekstrakulikuler2'];
			$eks3				= $datanilai['eks3'];
			$ekstrakulikuler3	= $datanilai['ekstrakulikuler3'];
			$eks4				= $datanilai['eks4'];
			$ekstrakulikuler4	= $datanilai['ekstrakulikuler4'];
			$eks5				= $datanilai['eks5'];
			$ekstrakulikuler5	= $datanilai['ekstrakulikuler5'];
			if ($foto == '' OR $foto == null){
				$foto 			= Session('sekolah_logo');
			}
			$update 			= Rapotan::updateOrCreate(
				[
					'noinduk' 		=> $noinduk,
					'semester' 		=> $semester,
					'tapel' 		=> $tapel,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				],
				[
					'nama' 				=> $nama,
					'nisn' 				=> $nisn,
					'foto' 				=> $foto,
					'alamat' 			=> $alamat,
					'kelas' 			=> $kelas,
					'nildeskripsieks1' 	=> $eks1,
					'ekstrakulikuler1' 	=> $ekstrakulikuler1,
					'nildeskripsieks2' 	=> $eks2,
					'ekstrakulikuler2' 	=> $ekstrakulikuler2,
					'nildeskripsieks3' 	=> $eks3,
					'ekstrakulikuler3' 	=> $ekstrakulikuler3,
					'nildeskripsieks4' 	=> $eks4,
					'ekstrakulikuler4' 	=> $ekstrakulikuler4,
					'nildeskripsieks5' 	=> $eks5,
					'ekstrakulikuler5' 	=> $ekstrakulikuler5,
					'tbs1' 				=> $tbs1,
					'tbs2' 				=> $tbs2,
					'bbs1' 				=> $bbs1,
					'bbs2' 				=> $bbs2,
					'pendengaran' 		=> $telinga,
					'penglihatan' 		=> $mata,
					'gigi' 				=> $gigi,
					'kesehatanlain' 	=> $lainnya,
					'marking' 			=> $markingguru.'-'.$noinduk,
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
			$data		= DB::table('jadwal_pembelajaran')->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('marking')->get();
		} else if ($bentuk == 'detailtabel'){
			$data		= DB::table('jadwal_pembelajaran')->where('marking', $semester)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		} else {
			$sql		= DB::table('jadwal_pembelajaran')->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			$id			= '';
			if (!empty($sql)){
				foreach ($sql as $rjadwal) {
					if ($id == ''){
						$id		= 'id1';
					} else {
						$id		= $rjadwal->id;
					}
					$mulai		= $rjadwal->mulai;
					$akhir		= $rjadwal->akhir;
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
			$tanggal	= $request->val02;
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
				$tanggal 	= date( "Y-m-d", strtotime( $tanggal ) );
				$newDate 	= DateTime::createFromFormat('Y-m-d', $tanggal);
				$sethari 	= $newDate->format('D');
				$mulai		= $tanggal.' '.$jammulai;
				$akhir		= $tanggal.' '.$jamakhir;
				$catatan 	= Session('nama').' Mengubah Data Jadwal Data semula Tanggal '.$cekdata->tanggal.' ('.$cekdata->jammulai.'-'.$cekdata->jamakhir.') Ruang : '.$cekdata->ruang.' Guru : '.$cekdata->guruterjadwal.' Menjadi '.$tanggal.' ('.$jammulai.'-'.$jamakhir.') Ruang '.$ruang.' Guru : '.$guru.'<br />Pada :'.date('Y-m-d H:i:s');
				if ($ruang == 'Online' OR $ruang == 'Outing Class'){
					$cekruang = 0;
				} else {
					$cekruang  	= DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('ruang', $ruang)
										->where('id', '!=', $idne)
											->where(function ($query) use ($mulai, $akhir) {
												$query->where(function ($q) use ($mulai, $akhir) {
													$q->where('mulai', '>=', $mulai)
													->where('mulai', '<', $akhir);
												})->orWhere(function ($q) use ($mulai, $akhir) {
													$q->where('mulai', '<=', $mulai)
													->where('akhir', '>', $akhir);
												})->orWhere(function ($q) use ($mulai, $akhir) {
													$q->where('akhir', '>', $mulai)
													->where('akhir', '<=', $akhir);
												})->orWhere(function ($q) use ($mulai, $akhir) {
													$q->where('mulai', '>=', $mulai)
													->where('akhir', '<=', $akhir);
												});
											})->count();
				}
				if ($guru == '' OR $guru == null){
					$cekguru = 0;
				} else {
					$cekguru = DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('niyguru', $niyguru)
									->where('id', '!=', $idne)
										->where(function ($query) use ($mulai, $akhir) {
											$query->where(function ($q) use ($mulai, $akhir) {
												$q->where('mulai', '>=', $mulai)
												->where('mulai', '<', $akhir);
											})->orWhere(function ($q) use ($mulai, $akhir) {
												$q->where('mulai', '<=', $mulai)
												->where('akhir', '>', $akhir);
											})->orWhere(function ($q) use ($mulai, $akhir) {
												$q->where('akhir', '>', $mulai)
												->where('akhir', '<=', $akhir);
											})->orWhere(function ($q) use ($mulai, $akhir) {
												$q->where('mulai', '>=', $mulai)
												->where('akhir', '<=', $akhir);
											});
										})->count();
				}
				if ($cekruang == 0 AND $cekguru == 0){
					$input = DB::table('jadwal_pembelajaran')->where('id', $idne)->update([
						'tanggal'			=> $tanggal,
						'jammulai'			=> $jammulai,
						'jamakhir'			=> $jamakhir,
						'mulai'				=> $mulai,
						'akhir'				=> $akhir,
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
						$gagal 	= $gagal.'<font color="red">Gagal Input Jadwal Pertemuan '.$pertemuan.' di Ruang '.$ruang.' Mulai '.$mulai.' s/d/ '.$akhir.' Karena Kesalahan System</font><br />';
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
			$arraypertemuan = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20');
			$getdatamp 		= Datakkm::where('id', $idmatpel)->first();
			if (isset($getdatamp->id)){
				$kelas 		= $getdatamp->kelas;
				$matpel 	= $getdatamp->matpel;
				$marking 	= $tapel.'-'.$semester.'-'.$kelas.'-'.$idmatpel;
				foreach ($arraypertemuan as $pertemuan){
					$tanggal 	= $request->{'jadwal_tanggal'.$pertemuan};
					$ruang 		= $request->{'jadwal_ruangan'.$pertemuan};
					$guru 		= $request->{'jadwal_guru'.$pertemuan};
					$jammulai 	= $request->{'jadwal_mulai'.$pertemuan};
					$jamakhir 	= $request->{'jadwal_akhir'.$pertemuan};
					$jammulai 	= date( "H:i:s", strtotime( $jammulai ) );
					$jamakhir 	= date( "H:i:s", strtotime( $jamakhir ) );
					$tanggal 	= date( "Y-m-d", strtotime( $tanggal ) );
					$getdatagr 	= Dataindukstaff::where('niy', $guru)->first();
					if (isset($getdatagr->id)){
						$guru 	= $getdatagr->nama;
						$niyguru= $getdatagr->niy;
					} else {
						$niyguru= 0;
					}
					if ($jammulai != '00:00:00' AND $jamakhir != '00:00:00'){
						$newDate 	= DateTime::createFromFormat('Y-m-d', $tanggal);
						$sethari 	= $newDate->format('D');
						$mulai		= $tanggal.' '.$jammulai;
						$akhir		= $tanggal.' '.$jamakhir;
						if ($ruang == 'Online' OR $ruang == 'Outing Class'){
							$cekruang = 0;
						} else {
							$cekruang = DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('ruang', $ruang)
													->where(function ($query) use ($mulai, $akhir) {
														$query->where(function ($q) use ($mulai, $akhir) {
															$q->where('mulai', '>=', $mulai)
															->where('mulai', '<', $akhir);
														})->orWhere(function ($q) use ($mulai, $akhir) {
															$q->where('mulai', '<=', $mulai)
															->where('akhir', '>', $akhir);
														})->orWhere(function ($q) use ($mulai, $akhir) {
															$q->where('akhir', '>', $mulai)
															->where('akhir', '<=', $akhir);
														})->orWhere(function ($q) use ($mulai, $akhir) {
															$q->where('mulai', '>=', $mulai)
															->where('akhir', '<=', $akhir);
														});
													})->count();
						}
						if ($guru == '' OR $guru == null){
							$cekguru = 0;
						} else {
							$cekguru = DB::table('jadwal_pembelajaran')->where('id_sekolah', session('sekolah_id_sekolah'))->where('niyguru', $niyguru)
												->where(function ($query) use ($mulai, $akhir) {
													$query->where(function ($q) use ($mulai, $akhir) {
														$q->where('mulai', '>=', $mulai)
														->where('mulai', '<', $akhir);
													})->orWhere(function ($q) use ($mulai, $akhir) {
														$q->where('mulai', '<=', $mulai)
														->where('akhir', '>', $akhir);
													})->orWhere(function ($q) use ($mulai, $akhir) {
														$q->where('akhir', '>', $mulai)
														->where('akhir', '<=', $akhir);
													})->orWhere(function ($q) use ($mulai, $akhir) {
														$q->where('mulai', '>=', $mulai)
														->where('akhir', '<=', $akhir);
													});
												})->count();
						}
						
						if ($cekruang == 0 AND $cekguru == 0){
							$input = DB::table('jadwal_pembelajaran')->insert([
								'tanggal'			=> $tanggal,
								'jammulai'			=> $jammulai,
								'jamakhir'			=> $jamakhir,
								'mulai'				=> $mulai,
								'akhir'				=> $akhir,
								'hari'				=> $sethari,
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
								$sukses 	= $sukses.'<font color="success">Pertemuan '.$pertemuan.' di Ruang '.$ruang.' Mulai '.$mulai.' s/d '.$akhir.' Sukses di Input</font><br />';
							} else {
								$gagal 	= $gagal.'<font color="red">Gagal Input Jadwal Pertemuan '.$pertemuan.' di Ruang '.$ruang.' Mulai '.$mulai.' s/d/ '.$akhir.' Karena Kesalahan System</font><br />';
							}
						} else {
							$gagal 	= $gagal.'<font color="red">Gagal Input Jadwal Pertemuan '.$pertemuan.' di Ruang '.$ruang.' Mulai '.$mulai.' s/d '.$akhir.' Kode Error Ruang : '.$cekruang.' Kode Error Pengampu : '.$cekguru.'</font><br />';
						}
					}
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
		$i 			= 0;
		if ($jenis == 'tersimpan'){
			$data		= new SettingNilai();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			if ($semester != null AND $semester != '') $data = $data->where('semester', $semester);
			if ($tapel != null AND $tapel != '') $data = $data->where('tapel', $tapel);
			$data 		= $data->where('id_sekolah', session('sekolah_id_sekolah'));
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('muatan', 'like', "%$searchTerm%")
					  ->orWhere('matpel', 'like', "%$searchTerm%")
					  ->orWhere('kelas', 'like', "%$searchTerm%")
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
			$data 		= $data->where('id_sekolah', session('sekolah_id_sekolah'));
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('muatan', 'like', "%$searchTerm%")
					  ->orWhere('kelas', 'like', "%$searchTerm%")
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
		}
	}
	public function jsonLognilai() {
		$arrlognilai	= [];
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		if (isset($getdatauser->klsajar)){
			$smt 		= $getdatauser->smt;
			$tapel 		= $getdatauser->tapel;
		} else {
			$smt 		= '1';
			$tapel 		= '';
		}
		$getlognilai	= DB::table('db_loginputnilai')
							->select('db_loginputnilai.*', 'db_allstaf.nama')
							->leftJoin('db_allstaf', 'db_loginputnilai.niy', 'db_allstaf.niy')
							->where('db_loginputnilai.niy', Session('nip'))
							->where('db_loginputnilai.tapel', $tapel)
							->where('db_loginputnilai.semester', $smt)
							->where('db_loginputnilai.id_sekolah', Session('sekolah_id_sekolah'))
							->orderBy('db_loginputnilai.tanggal', 'desc')
							->get();
		echo json_encode($getlognilai);
	}
	public function jsonRinciannilai(Request $request) {
		$arrlognilai	= [];
		$marking 		= $request->val01;		
		$getlognilai 	= Datanilai::where('marking', 'LIKE', $marking.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		echo json_encode($getlognilai);
	}
	public function exVerpresensi(Request $request) {
		$idne 		= $request->val01;
		$tapel 		= $request->val02;
		$kategori 	= $request->val03;
		$jenis 		= $request->val04;
		$iduser		= Session('id');
		$getdatauser= User::where('id', $iduser)->first();
		if (isset($getdatauser->klsajar)){
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
		$idmatpel	= 0;
		$sukses 	= 0;
		$error 		= '';
		$materi 	= '';
		$kodekd 	= '';
		$muatan		= '';
		$tema 		= 0;
		$subtema	= 0;
		$getkodekd 	= Datakd::where('id', $idmateri)->first();
		if (isset($getkodekd->id)){
			$materi = $getkodekd->materi;
			$kodekd = $getkodekd->kodekd;
			$matpel	= $getkodekd->matpel;
			$muatan	= $getkodekd->muatan;
			$tema	= $getkodekd->tema;
			$subtema= $getkodekd->subtema;
		}
		$markingguru= $tapel.'-'.$semester.'-'.$kelas.'-'.Session('nip').'-'.$tanggal.'-PresensiKelas';
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
			} else {
				$error =  $error.'An. '.$nama.' No. Induk '.$noinduk.' Data Sudah Ada, Gunakan Fitur Edit untuk merubahnya<br />';
			}
		}
		$createjadwal = 0;
		if ($idjadwal == '' OR $idjadwal == 'TJ'){
			$createjadwal 	= 1;
		} else {
			$cekdatalama = DB::table('jadwal_pembelajaran')->where('id', $idjadwal)->first();
			if (isset($cekdatalama->id)){
				$niyguru 	= $cekdatalama->niyguru;
				if ($niyguru == Session('nip')){
					DB::table('jadwal_pembelajaran')->where('id', $idjadwal)->update([
						'guruyanghadir'	=> 'Sesuai Jadwal',
						'materi'		=> $materi,
						'tglkehadiran'	=> $tanggal,
					]);
				} else {
					DB::table('jadwal_pembelajaran')->where('id', $idjadwal)->update([
						'guruyanghadir'	=> Session('nama'),
						'materi'		=> $materi,
						'tglkehadiran'	=> $tanggal,
					]);
				}
			} else {
				$createjadwal 	= 1;
			}
		}
		if ($createjadwal == 1){
			$getidmatpel= Datakkm::where('kelas', $kelas)->where('muatan', $muatan)->first();
			if (isset($getidmatpel->id)){
				$idmatpel = $getidmatpel->id;
			}

			$jammulai 	= date( "H:i:s", strtotime( $jammulai ) );
			$jamakhir 	= date( "H:i:s", strtotime( $jamakhir ) );
			$tanggal 	= date( "Y-m-d", strtotime( $tanggal ) );
			$newDate 	= DateTime::createFromFormat('Y-m-d', $tanggal);
			$sethari 	= $newDate->format('D');
			$mulai		= $tanggal.' '.$jammulai;
			$akhir		= $tanggal.' '.$jamakhir;
			if ($materi == '' OR $materi == null){
				$materi	= $request->presensi_materimanual  ?? '-';
			}
			if ($matpel == '' OR $matpel == null){
				$matpel 	= $materi;
			}
			if ($ruang == null || $ruang == ''){ $ruang = 'Online'; }
			$input 		= DB::table('jadwal_pembelajaran')->insert([
				'tanggal'			=> $tanggal,
				'jammulai'			=> $jammulai,
				'jamakhir'			=> $jamakhir,
				'mulai'				=> $mulai,
				'akhir'				=> $akhir,
				'hari'				=> $sethari,
				'ruang'				=> $ruang,
				'idmatpel'			=> $idmatpel,
				'matapelajaran'		=> $matpel,
				'kelas'				=> $kelas,
				'semester'			=> $semester,
				'tapel'				=> $tapel,
				'marking'			=> $marking,
				'guruterjadwal'		=> Session('nama'),
				'niyguru'			=> Session('nip'),
				'guruyanghadir'		=> 'Sesuai Jadwal',
				'materi'			=> $materi,
				'tglkehadiran'		=> $tanggal,
				'id_sekolah'		=> session('sekolah_id_sekolah'),
			]);
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
		if ($update){
			Logstaff::create([
				'jenis'			=> 'Perubahan Nilai', 
				'sopo'			=> Session('nip'),
				'kelakuan'		=> $deskripsi,
				'id_sekolah' 	=> session('sekolah_id_sekolah')
			]);
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nilai Berhasil diubah']);
			return back();
		} else { 
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database Error, Silahkan coba beberapa saat lagi']);
			return back(); 
		}
	}
	public function exMultinaikkls(Request $request) {
		$kelas 		= $request->val01;
		$listnoinduk= $request->val02;
		$nokelulusan= $request->val03;
		$sukses 	= '';
		$error 		= '';
		foreach ($listnoinduk as $noinduk) {
			if ($noinduk != ''){
				if ($nokelulusan == ''){
					$update = Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'klspos'	=> $kelas,
						'id_sekolah'=>session('sekolah_id_sekolah')
					]);
					if ($input) { $sukses=$sukses.'<br />Sukses Set Kelas Untuk No. Induk '.$noinduk; }
					else { $error = $error.'<br />Gagal Set Kelas Untuk No. Induk '.$noinduk; }
				} else {
					$update = Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'nokelulusan'	=> $nokelulusan,
						'id_sekolah'=>session('sekolah_id_sekolah')
					]);
					if ($input) { $sukses=$sukses.'<br />Sukses Set Kelulusan Untuk No. Induk '.$noinduk; }
					else { $error = $error.'<br />Gagal Set Kelulusan Untuk No. Induk '.$noinduk; }
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
	public function exSavesetguru(Request $request) {
		$smt 		= $request->val01;
		$kelas		= $request->val02;
		$tapel		= $request->val04;
		$tapel 		= str_replace('/','-', $tapel);
		$tapel 		= str_replace(' ','', $tapel);
		
		$getuser 	= User::where('id', Session('id'))->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($getuser->nip)){
			$niy	= $getuser->nip;
			Dataindukstaff::where('niy', $niy)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
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
		$kelas					= $request->val02;
		$blniki 				= $bulanlist[$mthiki];
		$tanggalctk 			= $tgliki.' '.$blniki.' '.$thniki;
		$niy 					= Session('nip');
		$asline 				= Session('nama');
		$rsetting				= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$niykasek				= $rsetting->kepala_sekolah->niy;
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
		if (isset($getdatauser->klsajar)){
			$klsajar			= $getdatauser->klsajar;
			$semester 			= $getdatauser->smt;
			$tapel 				= $getdatauser->tapel;
		} else {
			$klsajar			= '';
			$semester 			= '';
			$tapel 				= '';
		}
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
		if ($idne == 'previewrapot'){
			$idne 				= $request->val02;
			$rmaster 			= Datainduk::where('id', $idne)->first();
			if (isset($rmaster->nama)){
				$markingguru	= $tapel.'-'.$semester.'-'.$rmaster->klspos.'-'.Session('nip').'-'.date('Y-m-d').'-DIRI';
				Rapotan::updateOrCreate(
					[
						'noinduk' 		=> $rmaster->noinduk,
						'semester' 		=> $semester,
						'tapel' 		=> $tapel,
						'id_sekolah' 	=> session('sekolah_id_sekolah')
					],
					[
						'nama' 				=> $rmaster->nama,
						'nisn' 				=> $rmaster->nisn,
						'foto' 				=> $rmaster->foto,
						'alamat' 			=> $rmaster->alamat,
						'kelas' 			=> $rmaster->kelas,
						'marking' 			=> $markingguru.'-'.$rmaster->noinduk,
						'id_sekolah' 		=> session('sekolah_id_sekolah')
					]
				);
				$cekdata 		= Rapotan::where('noinduk', $rmaster->noinduk)->where('tapel', $tapel)->where('semester', $semester)->first();
				if (isset($cekdata->id)){
					$totaldata  			= Datapresensi::where('tapel', $cekdata->tapel)->where('semester', $cekdata->semester)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('tanggal')->get();
					$totaldata 				= count($totaldata);
					$hadir  				= Datapresensi::where('tapel', $cekdata->tapel)->where('semester', $cekdata->semester)->where('noinduk', $cekdata->noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->where('status', 1)->count();
					$ijin  					= Datapresensi::where('tapel', $cekdata->tapel)->where('semester', $cekdata->semester)->where('noinduk', $cekdata->noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->where('status', 2)->count();
					$sakit  				= Datapresensi::where('tapel', $cekdata->tapel)->where('semester', $cekdata->semester)->where('noinduk', $cekdata->noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->where('status', 3)->count();
					$alpha 					= $totaldata - ($hadir + $ijin + $sakit);
					Rapotan::where('id', $cekdata->id)->update([
						'sakit'				=> $sakit,
						'ijin'				=> $ijin,
						'alpha'				=> $alpha,
						'namaguru'			=> Session('nama'),
						'nipguru'			=> Session('niy'),
						'namakepalasekolah'	=> $kepalasekolah,
						'nipkepalasekolah'	=> $niykasek,
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => url('/').'/rapot/'.$rmaster->id]);
					return back();
				} else {
					$error = 'Data Rapot dengan an. '.$rmaster->nama.' Tapel '.$tapel.' / '.$semester.' Tidak di Temukan';
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
					return back();
				}
			} else {
				$error = 'Data Induk dengan ID '.$idne.' Tidak ditemukan';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			}
		} else {
			if ($idne != 'all'){
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
			} else {
				$sql 			= Datainduk::where('klspos', $kelas)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				if (!empty($sql)){
					foreach ($sql as $rmaster) {
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
						$generatetbl	= $generatetbl.'<table width="822" cellpadding="0" cellspacing="0">
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
									</table><div style="page-break-before: always">';
					}
				}
				$tasks['generatetbl']	= $generatetbl;
				return view('cetak.biodatarapot', $tasks);
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
				if ($foto != ''){
					if (File::exists(base_path() ."/public/dist/img/foto/". $foto)) {
						$lampiran	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="35">';
					} else {
						$lampiran	= '<img src="'.$homebase.'/logo.png" height="35">';
					}
				} else {
					$lampiran	= '<img src="'.$homebase.'/logo.png" height="35">';
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
		$noinduk 	= $request->val01;
		$tapel 		= $request->val02;
		$arrpresensi= [];
		$homebase	= url("/");
		if ($tapel == 'persiswa'){
			$sql 		= Datapresensi::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('tanggal', 'ASC')->get();
		} else if ($tapel == 'exportpresensifinger'){
			$sql 		= null;
			$arrpresensi= Presensifinger::where('nip', '!=', '')->where('departemen', $request->val01)->where('kantor', $request->val03)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('tanggal', 'ASC')->orderBy('pin', 'ASC')->get();
		} else if ($tapel == 'pertanggalinput'){
			$datacari 	= Loginputnilai::where('id', $noinduk)->first();
			if (isset($datacari->id)){
				$sql 	= Datapresensi::where('tanggal', $datacari->tanggal)->where('kelas', $datacari->kelas)->where('petugas', $datacari->niy)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('tanggal', 'ASC')->get();
			}
		} else {
			$sql 		= Datapresensi::where('tapel',  $tapel)->where('noinduk', $noinduk)->orderBy('tanggal', 'ASC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		}
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$noinduk	= $hasil->noinduk;
				$status		= $hasil->status;
				$alasan		= $hasil->alasan;
				if ($alasan == ''){
					if ($status == '1'){
						$alasan = 'HADIR';
					} else if ($status == '2'){
						$alasan = 'IJIN';
					} else if ($status == '3'){
						$alasan = 'SAKIT';
					} else {
						$alasan = 'ALPHA';
					}
				}
				$getnama 	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				$nama		= $getnama->nama;
				$arrpresensi[] = array(
					'id'		=> $hasil->id,
					'tanggal'	=> $hasil->tanggal,
					'nama'		=> $nama, 
					'noinduk'	=> $hasil->noinduk, 
					'tapel'		=> $hasil->tapel, 
					'kelas'		=> $hasil->kelas, 
					'status'	=> $hasil->status,
					'alasan'	=> $alasan, 
					'selama'	=> $hasil->selama, 
					'surat'		=> $hasil->surat, 
					'inputor'	=> $hasil->petugas, 
					'marking'	=> $hasil->marking
				);
			}
		}
		echo json_encode($arrpresensi);
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
							->where('db_setkeuangan.id_sekolah', session('sekolah_id_sekolah'))
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
		$arrlistkkm		= [];
		$kelas 			= $request->val01;
		$sql			= Datakkm::where('kelas', $kelas)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$arrlistkkm[] = array(
					'idne' 		=> $hasil->id,
					'kelas'		=> $hasil->kelas,
					'matpel'	=> $hasil->matpel,
					'muatan'	=> $hasil->muatan,
					'kitiga'	=> $hasil->kitiga,
					'kiempat'	=> $hasil->kiempat,
				);
			}
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
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					if ($kerja){
						$sukses = $sukses.'Data KKM Kelas '.$kelas.' Mata Pelajaran '.$matpel.' Berhasil di Input';
					} else {
						$error = $error.'Sistem Error, Silahkan Coba Beberapa Saat Lagi';
					}
				} else {
					$error = $error.'Data KKM Telah Ada';
				}
			} else {
				$kerja 	= Datakkm::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'matpel'	=> $matpel,
					'muatan'	=> $muatan,
					'kitiga'	=> $kie3,
					'kiempat'	=> $kie4,
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
			} else {
				$sql 	= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('klspos', $jilid)->get();
			}
		}
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$nama 		= $hasil->nama;
				$noinduk 	= $hasil->noinduk;
				$kelas 		= $hasil->klspos;
				$foto 		= $hasil->foto;
				if ($foto == '' OR $foto == null){
					$lampiran	= '<img src="'.$homebase.'/logo.png" height="35">';
				} else {
					$lampiran	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="35">';
				}
				$ziyadah_tanggal		= '';
				$ziyadah_mulaisurah		= '';
				$ziyadah_mulaiayat		= '';
				$ziyadah_akhirsurah		= '';
				$ziyadah_akhirayat		= '';
				
				$murojaah_tanggal		= '';
				$murojaah_mulaisurah	= '';
				$murojaah_mulaiayat		= '';
				$murojaah_akhirsurah	= '';
				$murojaah_akhirayat		= '';

				$tilawah_tanggal		= '';
				$tilawah_mulaisurah		= '';
				$tilawah_mulaiayat		= '';
				$tilawah_akhirsurah		= '';
				$tilawah_akhirayat		= '';
				
				$tahsin_tanggal			= '';
				$tahsin_mulaisurah		= '';
				$tahsin_mulaiayat		= '';
				$tahsin_akhirsurah		= '';
				$tahsin_akhirayat		= '';
				
				$tanggal				= '';
				$ceklastdata= Datasetorantahfid::where('noinduk', $noinduk)->where('id_sekolah', $hasil->id_sekolah)->orderBy('tanggal', 'DESC')->first();
				if (isset($ceklastdata->id)){
					$tanggal				= $ceklastdata->tanggal;
					$ziyadah_tanggal		= $ceklastdata->ziyadah_tanggal;
					$ziyadah_mulaisurah		= $ceklastdata->ziyadah_mulaisurah;
					$ziyadah_mulaiayat		= $ceklastdata->ziyadah_mulaiayat;
					$ziyadah_akhirsurah		= $ceklastdata->ziyadah_akhirsurah;
					$ziyadah_akhirayat		= $ceklastdata->ziyadah_akhirayat;
					$murojaah_tanggal		= $ceklastdata->murojaah_tanggal;
					$murojaah_mulaisurah	= $ceklastdata->murojaah_mulaisurah;
					$murojaah_mulaiayat		= $ceklastdata->murojaah_mulaiayat;
					$murojaah_akhirsurah	= $ceklastdata->murojaah_akhirsurah;
					$murojaah_akhirayat		= $ceklastdata->murojaah_akhirayat;
					$tahsin_tanggal			= $ceklastdata->tahsin_tanggal;
					$tahsin_mulaisurah		= $ceklastdata->tahsin_mulaisurah;
					$tahsin_mulaiayat		= $ceklastdata->tahsin_mulaiayat;
					$tahsin_akhirsurah		= $ceklastdata->tahsin_akhirsurah;
					$tahsin_akhirayat		= $ceklastdata->tahsin_akhirayat;
					$tilawah_tanggal		= $ceklastdata->tilawah_tanggal;
					$tilawah_mulaisurah		= $ceklastdata->tilawah_mulaisurah;
					$tilawah_mulaiayat		= $ceklastdata->tilawah_mulaiayat;
					$tilawah_akhirsurah		= $ceklastdata->tilawah_akhirsurah;
					$tilawah_akhirayat		= $ceklastdata->tilawah_akhirayat;
				}
				$arrpresensi[] = array(
					'id' 					=> $hasil->id,
					'nama' 					=> $hasil->nama,
					'jilid' 				=> $hasil->jilid,
					'noinduk' 				=> $hasil->noinduk,
					'kelas'					=> $hasil->klspos,
					'foto'					=> $lampiran,
					'tapel'					=> $tapel,
					'tanggal' 				=> $tanggal,
                    'ziyadah_tanggal' 		=> $ziyadah_tanggal,
                    'ziyadah_mulaisurah' 	=> $ziyadah_mulaisurah,
                    'ziyadah_mulaiayat' 	=> $ziyadah_mulaiayat,
                    'ziyadah_akhirsurah' 	=> $ziyadah_akhirsurah,
                    'ziyadah_akhirayat' 	=> $ziyadah_akhirayat,
                    'murojaah_tanggal' 		=> $murojaah_tanggal,
                    'murojaah_mulaisurah' 	=> $murojaah_mulaisurah,
                    'murojaah_mulaiayat' 	=> $murojaah_mulaiayat,
                    'murojaah_akhirsurah' 	=> $murojaah_akhirsurah,
                    'murojaah_akhirayat' 	=> $murojaah_akhirayat,
                    'tilawah_tanggal' 		=> $tilawah_tanggal,
                    'tilawah_mulaisurah' 	=> $tilawah_mulaisurah,
                    'tilawah_mulaiayat' 	=> $tilawah_mulaiayat,
                    'tilawah_akhirsurah' 	=> $tilawah_akhirsurah,
                    'tilawah_akhirayat' 	=> $tilawah_akhirayat,
                    'tahsin_tanggal' 		=> $tahsin_tanggal,
                    'tahsin_mulaisurah' 	=> $tahsin_mulaisurah,
                    'tahsin_mulaiayat' 		=> $tahsin_mulaiayat,
                    'tahsin_akhirsurah' 	=> $tahsin_akhirsurah,
                    'tahsin_akhirayat' 		=> $tahsin_akhirayat,
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
					$alasan = 'Hadir Namun Terlambat';
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
		$sekolah					= Session('sekolah_id_sekolah');
		$tahunne					= date("Y");
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
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level2' OR Session('previlage') == 'level3'){
			return view('simaster.konseling', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
        	$tasks['kalimatbody']  		= 'Anda Tidak di ijinkan masuk ke laman ini, silahkan kembali ke laman sebelumnya';
            return view('errors.notready', $tasks);
        }
	}
	public function jsonKonselingthnini() {
		$arrrekap 		= [];
		$tahun			= date("Y");
		$fakultas		= Session('sekolah_id_sekolah');
		$fakpanjang		= Session('sekolah_nama_sekolah');
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
		$getkelas		= Datainduk::where('noinduk', $noinduk)->first();
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
							'guru'			=> Session('nama'),
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
							'guru'			=> Session('nama'),
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
	public function jsonAlldatakonseling(Request $request) {
		$bulan   	= $request->val01;
		$tahun   	= $request->val02;
		$tahunini	= date("Y");
		
		if ($bulan == 'BULANINI'){
			$bulan 	= date("m");
			$valcari= $tahunini.'-'.$bulan.'-%';
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
				$jenis 	= $rdatane->jenis;
				if ($jenis == 'MNK'){ $tlsjenis = 'Miras, Narkoba, Kriminal'; }
				else if ($jenis == 'BP'){ $tlsjenis = 'Berkelahi dan Pengeroyokan'; }
				else if ($jenis == 'BLY'){ $tlsjenis = 'Bullying atau Perundungan'; }
				else if ($jenis == 'TS'){ $tlsjenis = 'Perilaku Tidak Sopan'; }
				else if ($jenis == 'HLS'){ $tlsjenis = 'Hubungan dengan Lawan Jenis'; }
				else if ($jenis == 'BLS'){ $tlsjenis = 'Bolos atau Terlambat'; }
				else if ($jenis == 'MRK'){ $tlsjenis = 'Merokok'; }
				else if ($jenis == 'BJR'){ $tlsjenis = 'Masalah Belajar'; }
				else if ($jenis == 'HTS'){ $tlsjenis = 'Hubungan dengan Teman Sebaya'; }
				else { $tlsjenis = 'Masalah Lainnya'; }
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
			$urutan		= $datanilai['urutan'];
			$namaekskul	= $datanilai['namaekskul'];
			$marking 	= $markingguru . '-' . $noinduk;
			if ($jenis == 'PTS' OR $jenis == 'PAS'){
				if ($urutan == 1){
					$update 			= Rapotan::updateOrCreate(
						[
							'noinduk' 		=> $noinduk,
							'semester' 		=> $smt,
							'tapel' 		=> $tapel,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						],
						[
							'nama' 				=> $nama,
							'nisn' 				=> $nisn,
							'foto' 				=> $foto,
							'alamat' 			=> $alamat,
							'kelas' 			=> $kelas,
							'nildeskripsieks1' 	=> $nilai,
							'ekstrakulikuler1' 	=> $namaekskul,
							'id_sekolah' 		=> session('sekolah_id_sekolah')
						]
					);
				}
				if ($urutan == 2){
					$update 			= Rapotan::updateOrCreate(
						[
							'noinduk' 		=> $noinduk,
							'semester' 		=> $smt,
							'tapel' 		=> $tapel,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						],
						[
							'nama' 				=> $nama,
							'nisn' 				=> $nisn,
							'foto' 				=> $foto,
							'alamat' 			=> $alamat,
							'kelas' 			=> $kelas,
							'nildeskripsieks2' 	=> $nilai,
							'ekstrakulikuler2' 	=> $namaekskul,
							'id_sekolah' 		=> session('sekolah_id_sekolah')
						]
					);
				}
				if ($urutan == 3){
					$update 			= Rapotan::updateOrCreate(
						[
							'noinduk' 		=> $noinduk,
							'semester' 		=> $smt,
							'tapel' 		=> $tapel,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						],
						[
							'nama' 				=> $nama,
							'nisn' 				=> $nisn,
							'foto' 				=> $foto,
							'alamat' 			=> $alamat,
							'kelas' 			=> $kelas,
							'nildeskripsieks3' 	=> $nilai,
							'ekstrakulikuler3' 	=> $namaekskul,
							'id_sekolah' 		=> session('sekolah_id_sekolah')
						]
					);
				}
				if ($urutan == 4){
					$update 			= Rapotan::updateOrCreate(
						[
							'noinduk' 		=> $noinduk,
							'semester' 		=> $smt,
							'tapel' 		=> $tapel,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						],
						[
							'nama' 				=> $nama,
							'nisn' 				=> $nisn,
							'foto' 				=> $foto,
							'alamat' 			=> $alamat,
							'kelas' 			=> $kelas,
							'nildeskripsieks4' 	=> $nilai,
							'ekstrakulikuler4' 	=> $namaekskul,
							'id_sekolah' 		=> session('sekolah_id_sekolah')
						]
					);
				}
				if ($urutan == 5){
					$update 			= Rapotan::updateOrCreate(
						[
							'noinduk' 		=> $noinduk,
							'semester' 		=> $smt,
							'tapel' 		=> $tapel,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						],
						[
							'nama' 				=> $nama,
							'nisn' 				=> $nisn,
							'foto' 				=> $foto,
							'alamat' 			=> $alamat,
							'kelas' 			=> $kelas,
							'nildeskripsieks5' 	=> $nilai,
							'ekstrakulikuler5' 	=> $namaekskul,
							'id_sekolah' 		=> session('sekolah_id_sekolah')
						]
					);
				}
				if ($update){
					$sukses++;
				} else {
					$gagal = $gagal.' Input Data '.$jenis.' an '.$nama.' No Induk '.$noinduk.' Gagal <br />';
				}
			} else {
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
		$pesan 			= '';
		$gagal 			= '';
		$noinduk		= $request->setoran_noinduk;
		$kelas			= $request->setoran_kelas;
		$jilid			= '';
		$tanggal		= $request->setoran_tanggal;
		$nama			= $request->setoran_nama;
		$ceksek 		= Datasetorantahfid::where('noinduk', $noinduk)->where('tanggal', $tanggal)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
		
		$getdatauser	= User::where('id', Session('id'))->first();
		if (isset($getdatauser->klsajar)){
			$klsajar	= $getdatauser->klsajar;
			$smt 		= $getdatauser->smt;
			$tapel 		= $getdatauser->tapel;
		} else {
			$klsajar	= '-';
			$smt 		= '-';
			$tapel 		= '-';
		}
		$idziyadahawal 		= $request->setoran_ziyadahsurahawal;
		if ($idziyadahawal == 0 OR $idziyadahawal == '' OR $idziyadahawal == null){
			$setoran_ziyadahsurahawal 	= '';
			$setoran_ziyadahayatawal	= '';
		} else {
			$explodeayat 				= explode('.', $idziyadahawal);
			$setoran_ziyadahsurahawal 	= $explodeayat[0];
			$setoran_ziyadahayatawal	= $explodeayat[1];
			$jilid						= $setoran_ziyadahsurahawal;
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
			$setoran_tilawahsurahawal 	= $explodeayat[0];
			$ayat						= $explodeayat[1];
			$getnamasurah 				= Mushaflist::where('id', $setoran_tilawahsurahawal)->first();
			if (isset($getnamasurah->id)){
				$setoran_tilawahsurahawal 	= $getnamasurah->surah.' Ayat '.$ayat;
			}
		}
		$idtilawahayatakhir 		= $request->setoran_tilawahsurahakhir;
		if ($idtilawahayatakhir == 0 OR $idtilawahayatakhir == '' OR $idtilawahayatakhir == null){
			$setoran_tilawahsurahakhir 	= '';
			$idtilawahayatakhir			= '';
		} else {
			$explodeayat 				= explode('.', $idtilawahayatakhir);
			$setoran_tilawahsurahakhir 	= $explodeayat[0];
			$ayat						= $explodeayat[1];
			$getnamasurah 				= Mushaflist::where('id', $setoran_tilawahsurahakhir)->first();
			if (isset($getnamasurah->id)){
				$setoran_tilawahsurahakhir 	= $getnamasurah->surah.' Ayat '.$ayat;
			}
		}
		$idtahsinayatawal 				= $request->setoran_tahsinawal;
		if ($idtahsinayatawal == 0 OR $idtahsinayatawal == '' OR $idtahsinayatawal == null){
			$setoran_tahsinawal 		= '';
			$idtahsinayatawal			= '';
		} else {
			$explodeayat 				= explode('.', $idtahsinayatawal);
			$setoran_tahsinawal 		= $explodeayat[0];
			$ayat						= $explodeayat[1];
			$getnamasurah 				= Mushaflist::where('id', $setoran_tahsinawal)->first();
			if (isset($getnamasurah->id)){
				$setoran_tahsinawal 	= $getnamasurah->surah.' Ayat '.$ayat;
			}
		}
		$idtahsinayatakhir 				= $request->setoran_tahsinakhir;
		if ($idtahsinayatakhir == 0 OR $idtahsinayatakhir == '' OR $idtahsinayatakhir == null){
			$setoran_tahsinakhir 		= '';
			$idtahsinayatakhir			= '';
		} else {
			$explodeayat 				= explode('.', $idtahsinayatakhir);
			$setoran_tahsinakhir 		= $explodeayat[0];
			$ayat						= $explodeayat[1];
			$getnamasurah 				= Mushaflist::where('id', $setoran_tahsinakhir)->first();
			if (isset($getnamasurah->id)){
				$setoran_tahsinakhir 	= $getnamasurah->surah.' Ayat '.$ayat;
			}
		}
		if (Session('previlage') == 'ortu'){
			$inputor = 'ortu';
		} else {
			$inputor = Session('nip');
		}
		if ($ceksek == 0){
			$inputawal 	= Datasetorantahfid::create([
				'inputor'				=> $inputor,
				'nama'					=> $nama,
				'kelas'					=> $kelas,
				'tapel'					=> $tapel,
				'semester'				=> $smt,
				'jilid'					=> $jilid,
				'noinduk'				=> $noinduk,
				'tanggal'				=> $tanggal,
				'marking'				=> session('sekolah_id_sekolah').'-'.$noinduk.'_'.$tanggal,
				'id_sekolah'			=> session('sekolah_id_sekolah'),
				'ziyadah_tanggal'		=> '&#10004;',
				'ziyadah_mulaisurah'	=> $setoran_ziyadahsurahawal,
				'ziyadah_mulaiayat'		=> $idziyadahawal,
				'ziyadah_akhirsurah'	=> $setoran_ziyadahsurahakhir,
				'ziyadah_akhirayat'		=> $isziyadahsurahakhir,
				'murojaah_tanggal'		=> '&#10004;',
				'murojaah_mulaisurah'	=> $setoran_msurahawal,
				'murojaah_mulaiayat'	=> $idmsurahawal,
				'murojaah_akhirsurah'	=> $setoran_msurahakhir,
				'murojaah_akhirayat'	=> $idmsurahakhir,
				'tilawah_tanggal'		=> '&#10004;',
				'tilawah_mulaisurah'	=> $setoran_tilawahsurahawal,
				'tilawah_mulaiayat'		=> $idtilawahayatawal,
				'tilawah_akhirsurah'	=> $setoran_tilawahsurahakhir,
				'tilawah_akhirayat'		=> $idtilawahayatakhir,
				'tahsin_tanggal'		=> '&#10004;',
				'tahsin_mulaisurah'		=> $setoran_tahsinawal,
				'tahsin_mulaiayat'		=> $idtahsinayatawal,
				'tahsin_akhirsurah'		=> $setoran_tahsinakhir,
				'tahsin_akhirayat'		=> $idtahsinayatakhir,
				'nilai'					=> $request->setoran_nilai,
				'kelulusan'				=> $request->setoran_status,
				'catatan'				=> $request->setoran_catatan,
			]);
			if ($inputawal){
				$pesan = $pesan.' Input awal sukses';
			} else {
				$gagal 	= $gagal.' Input data Awal Gagal';
			}
		} else {
			$inputawal 		= Datasetorantahfid::where('noinduk', $noinduk)->where('tanggal', $tanggal)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
				'inputor'				=> $inputor,
				'nama'					=> $nama,
				'kelas'					=> $kelas,
				'tapel'					=> $tapel,
				'semester'				=> $smt,
				'jilid'					=> $jilid,
				'ziyadah_tanggal'		=> '&#10004;',
				'ziyadah_mulaisurah'	=> $request->setoran_ziyadahsurahawal,
				'ziyadah_mulaiayat'		=> $request->setoran_ziyadahayatawal,
				'ziyadah_akhirsurah'	=> $request->setoran_ziyadahsurahakhir,
				'ziyadah_akhirayat'		=> $request->setoran_ziyadahayatakhir,
				'murojaah_tanggal'		=> '&#10004;',
				'murojaah_mulaisurah'	=> $request->setoran_msurahawal,
				'murojaah_mulaiayat'	=> $request->setoran_mayatawal,
				'murojaah_akhirsurah'	=> $request->setoran_msurahakhir,
				'murojaah_akhirayat'	=> $request->setoran_mayatakhir,
				'tilawah_tanggal'		=> '&#10004;',
				'tilawah_mulaisurah'	=> $request->setoran_tilawahsurahawal,
				'tilawah_mulaiayat'		=> $request->setoran_tilawahayatawal,
				'tilawah_akhirsurah'	=> $request->setoran_tilawahsurahakhir,
				'tilawah_akhirayat'		=> $request->setoran_tilawahayatakhir,
				'tahsin_tanggal'		=> '&#10004;',
				'tahsin_mulaisurah'		=> $request->setoran_tahsinawal,
				'tahsin_mulaiayat'		=> $request->setoran_tahsinayatawal,
				'tahsin_akhirsurah'		=> $request->setoran_tahsinakhir,
				'tahsin_akhirayat'		=> $request->setoran_tahsinayatakhir,
				'nilai'					=> $request->setoran_nilai,
				'kelulusan'				=> $request->setoran_status,
				'catatan'				=> $request->setoran_catatan,
				'updated_at'			=> date('Y-m-d H:i:s')
			]);
			if ($inputawal){
				$pesan = $pesan.' Update awal sukses';
			} else {
				$gagal 	= $gagal.' Update data Awal Gagal';
			}
		}
		
		if ($gagal == ''){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $pesan]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan.'<br />'.$gagal]);
			return back();
		}
	}
	//Tidak dipakai
	public function viewKodekd() {
		$data   					= [];
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
		$data['jmuatan']			= Datakkm::groupBy('muatan')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('muatan','ASC')->get();
		$data['sidebar']			= 'kodekd';
		return view('simaster.kodekd', $data);
	}
	public function jsonDatakd(Request $request) {
		$arrlistkd		= [];
		$kelas 			= $request->val01;
		$muatan 		= $request->val02;
		$sql			= Datakd::where('kelas', $kelas)->where('muatan', $muatan)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$arrlistkd[] = array(
					'idne' 		=> $hasil->id,
					'kelas'		=> $hasil->kelas,
					'kodekd'	=> $hasil->kodekd,
					'muatan'	=> $hasil->muatan,
					'deskripsi'	=> $hasil->deskripsi,
					'nilai'		=> $hasil->kkm,
				);
			}
		}
		echo json_encode($arrlistkd);
	}
	public function exUploaddatakd(Request $request) {
		$aksi 		= $request->set_aksi;
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
			if ($aksi == '1'){
				Datakd::truncate();
				$catatan = Session('nama').' Mereset Data KD Pada : '.date("Y-m-d H:i");
				Logstaff::create([
					'jenis'		=> 'Perubahan Nilai',
					'sopo'		=> Session('nip'),
					'kelakuan'	=> $catatan,
				]);
			}
			$barispertama	= '';
			foreach($getalldata as $val){
				if ($barispertama != ''){
					$semester			= $val['A'];
					$kelas				= $val['B'];
					$tema				= $val['C'];
					$subtema			= $val['D'];
					$deskripsitema		= $val['E'];
					$matpel				= $val['F'];
					$muatan				= $val['G'];
					$kodekd  			= $val['H'];
					$kkm  				= $val['I'];
					$deskripsikd		= $val['J'];
					if (is_null($kkm)){ $kkm = 0; }
					if ($kkm == ''){ $kkm = 0; }
					if ($kkm == 0){
						$cekkkm			= Datakkm::where('muatan', $muatan)->where('kelas', $kelas)->first();
						if (isset($cekkkm->kitiga)){
							$kkmki3		= $cekkkm->kitiga;
							$kkmki4		= $cekkkm->kiempat;
							$arrnomor1 	= str_split($kodekd);
							$val1 		= $arrnomor1[0];
							if ($val1 == '3'){
								$kkm 	= $kkmki3;
							} else {
								$kkm 	= $kkmki4;
							}
						} else {
							$kkm 		= 0;
						}
					}
					$input 				= Datakd::create([
						'semester'		=> $semester,
						'kelas'			=> $kelas,
						'tema'			=> $tema,
						'subtema'		=> $subtema,
						'deskripsitema'	=> $deskripsitema,
						'matpel'		=> $matpel,
						'muatan'		=> $muatan,
						'kodekd'		=> $kodekd,
						'kkm'			=> $kkm,
						'deskripsi'		=> $deskripsikd
					]);
					if ($input){
						$sukses++;
					} else {
						$gagal = $gagal.'Gagal Tambah '.$deskripsitema.' Muatan '.$muatan.' Kelas '.$kelas.'<br />';
					}
				} else {
					$barispertama = 'skip';
				}
			}
			$catatan = Session('nama').' Upload Data KD berhasil sejumlah '.$sukses.' Pada : '.date("Y-m-d H:i");
			Logstaff::create([
				'jenis'		=> 'Perubahan Nilai',
				'sopo'		=> Session('nip'),
				'kelakuan'	=> $catatan,
			]);
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
	public function viewSettema() {
		$data   					= [];
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
		$data['sidebar']			= 'settema';
		return view('simaster.settema', $data);
	}
	public function jsonTema(Request $request) {
		$arrlisttema	= [];
		$kelas 			= $request->val01;
		$sql			= Datatema::where('kelas', $kelas)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$arrlisttema[] = array(
					'id' 		=> $hasil->id,
					'kelas'		=> $hasil->kelas,
					'temake'	=> $hasil->temake,
					'tema'		=> $hasil->tema,
					'subtemake'	=> $hasil->subtemake,
					'subtema'	=> $hasil->subtema,
				);
			}
		}
		echo json_encode($arrlisttema);
	}
	public function exSimpandatatema(Request $request) {
		$kelas 		= $request->val01;
		$temake 	= $request->val02;
		$tema 		= $request->val03;
		$subtema1	= $request->val04;
		$subtema2	= $request->val05;
		$subtema3	= $request->val06;
		$subtema4	= $request->val07;
		$error		= '';
		$sukses 	= '';
		if($kelas == '' or $temake == '' or $tema == ''  or $subtema1 == '' or $subtema2 == '' ){
			$error = $error.'Pastikan Semua Form Di Isi';
		} else {
			if ($subtema1 != ''){
				$input = Datatema::create([
					'kelas'		=> $kelas, 
					'temake'	=> $temake, 
					'tema'		=> $tema, 
					'subtemake'	=> '1', 
					'subtema'	=> $subtema1,
					'id_sekolah'=>session('sekolah_id_sekolah')
				]);
				if ($input){
					$sukses	= $sukses.'<br />Tambah data Tema '.$temake.' Subtema 1 dengan nama '.$tema.' - '.$subtema1.' Untuk kelas '.$kelas.' Sukses';
				} else {
					$error	= $error.'<br />Tambah data Tema '.$temake.' Subtema 1 dengan nama '.$tema.' - '.$subtema1.' Untuk kelas '.$kelas.' Gagal di Input';
				}
			}
			if ($subtema2 != ''){
				$input = Datatema::create([
					'kelas'		=> $kelas, 
					'temake'	=> $temake, 
					'tema'		=> $tema, 
					'subtemake'	=> '2', 
					'subtema'	=> $subtema2,
					'id_sekolah'=>session('sekolah_id_sekolah')
				]);
				if ($input){
					$sukses	= $sukses.'<br />Tambah data Tema '.$temake.' Subtema 2 dengan nama '.$tema.' - '.$subtema2.' Untuk kelas '.$kelas.' Sukses';
				} else {
					$error	= $error.'<br />Tambah data Tema '.$temake.' Subtema 2 dengan nama '.$tema.' - '.$subtema2.' Untuk kelas '.$kelas.' Gagal di Input';
				}
			}
			if ($subtema3 != ''){
				$input = Datatema::create([
					'kelas'		=> $kelas, 
					'temake'	=> $temake, 
					'tema'		=> $tema, 
					'subtemake'	=> '3', 
					'subtema'	=> $subtema3,
					'id_sekolah'=>session('sekolah_id_sekolah')
				]);
				if ($input){
					$sukses	= $sukses.'<br />Tambah data Tema '.$temake.' Subtema 3 dengan nama '.$tema.' - '.$subtema3.' Untuk kelas '.$kelas.' Sukses';
				} else {
					$error	= $error.'<br />Tambah data Tema '.$temake.' Subtema 3 dengan nama '.$tema.' - '.$subtema3.' Untuk kelas '.$kelas.' Gagal di Input';
				}
			}
			if ($subtema4 != ''){
				$input = Datatema::create([
					'kelas'		=> $kelas, 
					'temake'	=> $temake, 
					'tema'		=> $tema, 
					'subtemake'	=> '4', 
					'subtema'	=> $subtema4,
					'id_sekolah'=>session('sekolah_id_sekolah')
				]);
				if ($input){
					$sukses	= $sukses.'<br />Tambah data Tema '.$temake.' Subtema 4 dengan nama '.$tema.' - '.$subtema4.' Untuk kelas '.$kelas.' Sukses';
				} else {
					$error	= $error.'<br />Tambah data Tema '.$temake.' Subtema 4 dengan nama '.$tema.' - '.$subtema4.' Untuk kelas '.$kelas.' Gagal di Input';
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
	public function exUbahdatatema(Request $request) {
		$idne 		= $request->val01;
		$tema 		= $request->val02;
		$subtema 	= $request->val03;
		$error		= '';
		$sukses 	= '';
		if($tema == '' or $subtema == ''){
			$error = $error.'Pastikan Semua Form Di Isi';
		} else {
			$update = Datatema::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
				'tema' 		=> $tema,
				'subtema' 	=> $subtema
			]);
			if ($update){
				$sukses = $sukses.$tema.' - '.$subtema.' Updated';
			} else {
				$error = $error.'Database error, silahkan coba beberapa saat lagi';
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
