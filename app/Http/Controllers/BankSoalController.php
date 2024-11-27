<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Bankjawaban;
use App\Banksoal;
use App\Banksoalujian;
use App\Banksoaltest;
use App\Datanilai;
use App\Banksoalaktif;
use App\Pengumuman;
use App\Setting;
use App\Ruang;
use App\Logstaff;
use App\Datakkm;
use App\SettingNilai;
use App\Dataindukstaff;
use App\Datainduk;
use App\Sekolah;
use App\Layanan;
use Validator;
use Session;
use QrCode;
use Auth;
use Hash;
use DateTime;
use FeedReader;
use Carbon\Carbon;

class BankSoalController extends Controller
{
    public function viewIndex() {
        $data                       = [];
        $homebase					= url("/");
		$data['sidebar']			= 'frontpage';
		$data['firebaseid']			= '';
		if (Session('previlage') == 'level1' OR Session('previlage') == 'Waka Kurikulum'){
            $ujianlist 				= Banksoaltest::where('status', 1)->groupBy('marking')->get();
            $soalterverifikasi 	   	= Banksoal::where('active', 1)->where('view', '1')->count();
            $soaltidakterverikasi 	= Banksoal::where('active', 1)->where('view', '0')->count();
            $data['mohonverifikasi']= Banksoal::where('active', 1)->where('view', '0')->orderBy('id', 'DESC')->count();
            $data['ujian']   		= count($ujianlist);
            $data['kodelist']   	= Banksoal::where('active', 1)->groupBy('kode')->get();
            $data['pesertas']   	= 0;
            $data['kelompokspv']   	= 0;
        } else {
            $soalterverifikasi 	   	= Banksoal::where('created_by', Session('nip'))->where('view', '1')->where('active', 1)->count();
            $soaltidakterverikasi	= Banksoal::where('created_by', Session('nip'))->where('view', '0')->where('active', 1)->count();
            $data['ujian']   		= Banksoaltest::where('created_by',Session('nip'))->groupBy('marking')->count();
            $data['kodelist']   	= Banksoal::where('active', 1)->groupBy('kode')->get();
            $data['mohonverifikasi']= Banksoal::where('active', 1)->where('view', '0')->where('verified_by', Session('nip'))->orderBy('id', 'DESC')->count();
        }
        $cekstatus		= User::where('email', Session('email'))->first();
        if (isset($cekstatus->id)){
            $merangkap	= $cekstatus->merangkap ?? '';
			$semester	= $cekstatus->smt ?? '';
			$tapel		= $cekstatus->tapel ?? '';
			$klsajar	= $cekstatus->klsajar ?? '';
			$klsajar 	= preg_replace('/\D/', '', $klsajar);
        } else { 
			$merangkap	= ''; 
			$semester	= '';
			$tapel		= '';
			$klsajar	= '';
		}
        $email 		= Session('email');
        $idpeg 		= Session('id');
        $koreksi 	= 0;
        $sql 		= Banksoaltest::where('idsupervisor', $idpeg)->where('status', '1')->get();
        if (!empty($sql)){
            foreach ($sql as $rows){
                $marking 		= $rows->marking;
                $namaujian 		= $rows->namaujian;
                $supervisor 	= $rows->supervisor;
                $idsoal 		= $rows->idsoal;
                $getmahasiswa 	= Banksoalujian::where('marking', $marking)->where('idsoal', $idsoal)->get();
                if (!empty($getmahasiswa)){
                    foreach($getmahasiswa as $rmhs){
                        $koreksi++;
                    }
                }
            }
        }
		
		$jgroupps	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('kelas')->select('kelas')->orderBy('kelas')->get();
		$i			= 0;
		$arraymatpel= [];
        foreach ($jgroupps as $rgrpklas) {
            $j  		= 0;
            $kelas		= $rgrpklas->kelas;
            $jklas  	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->where('kelas', $kelas)->get();
            foreach ($jklas as $rklas) {
                $data['matpels'][$i][$j]['kelas']	=   $rklas->kelas;
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
			$data['matpels'][0][0]['muatan']	=   '-';
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
		$getkomponennilai 	= SettingNilai::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $klsajar)->where('semester', $semester)->where('tapel', $tapel)->get();
		$arraykomponen 		= [];
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
			}
		}
		if ($i == 0){
			$arraykomponen[0] = array(
				'deskripsi'			=> 'No Data',
				'nilaike'			=> 'no data',
				'idsetting'			=> '0',
				'idkd'				=> '0',
				'kodekd'			=> '0',
				'muatan'			=> 'No Data',
				'namakomponen'		=> 'Komponen Penilaian Kelas '.$klsajar.' SMT '.$semester.' TP '.$tapel.' Belum Ada',
			);
		}
		$data['arraykomponen']				= $arraykomponen;
		$data['klsajar']					= $klsajar;
		$data['smt']						= $semester;
		$data['tapel']						= $tapel;
		$data['iduser']						= $idpeg;
        $data['koreksi']   					= $koreksi;
        $data['soalterverifikasi']       	= $soalterverifikasi;
        $data['soaltidakterverikasi']    	= $soaltidakterverikasi;
        $data['merangkap']    				= $merangkap;
        return view('simaster.banksoal', $data);
    }
	public function viewPortalUjian() {
        $data		= [];
        $homebase	= url("/");
		if (Session('noinduk') !== null){
			$pengumumanujian		= '';
			$sql 					= Layanan::where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('layanan', 'ASC')->get();
			if (!empty($sql)){
				foreach ($sql as $rlayanan){
					$status 		= $rlayanan->status;
					$layanan 		= $rlayanan->layanan;
					if ($layanan == 'pengumumanujian') { $periode = $status; }
				}
			}
			$hasil						= Datanilai::where('noinduk', Session('noinduk'))->where('marking', Session('marking'))->first();
			$data['noinduk']			= Session('noinduk');
			$data['marking']			= Session('marking');
			$data['biodata']			= $hasil;
			$data['pengumumanujian']	= $pengumumanujian;
			return view('simaster.portaltest', $data);
		} else {
			return view('simaster.test', $data);
		}
    }
	public function exLoginTest(Request $request){
        $email    		= $request->input('email');
		$password   	= $request->input('password');
		$remember   	= $request->input('remember');
		$fakultas   	= $request->input('fakultas');
		$id_sekolah   	= $request->input('id_sekolah');
		$homebase		= url("/");
		$user 			= Datanilai::where('deskripsi', $email)->where('noinduk', $password)->first();
		if ($user) {
			Auth::login($user);
			$theme01			= 'Admin LT3';
			$namaapps01  		= config('global.Title2');
			$domainapps01  		= config('global.yayasan');
			$subdomainapps01  	= config('global.singkatan');
			$subsubdomainapps01 = config('global.sekolah');
			$addressapps01  	= config('global.alamat');
			$kota01  			= config('global.kota');
			$emailapps01  		= config('global.email');
			$lamanapps01  		= config('global.homeweb');
			$logofrontapps01  	= config('global.logosimaster');
			$lamanportal		= config('global.homeweb');
			$logo01				= config('global.logoapss');
			$sekolah_level 		= 2;
			$sekolah_nama_kasek	= '';
			$sekolah_nis		= '';
			$sekolah_nss		= '';
			$sekolah_npsn		= '';
			$sekolah_telp		= '';
			$sekolah_slogan		= '';
			$sekolah_logo		= '';
			
			$sql = Sekolah::where('id', $user->id_sekolah)->first();
			if (isset($sql->id)){
				$sekolah_level			= $sql->level;
				$domainapps01			= $sql->nama_yayasan;
				$subsubdomainapps01		= $sql->nama_sekolah;
				$subdomainapps01		= $sql->kode_sekolah;
				$sekolah_nama_kasek		= $sql->id_kepala_sekolah;
				$sekolah_nis			= $sql->nis;
				$sekolah_nss			= $sql->nss;
				$sekolah_npsn			= $sql->npsn;
				$addressapps01			= $sql->alamat;
				$kota01					= $sql->kota;
				$sekolah_telp			= $sql->telp;
				$emailapps01			= $sql->email;
				$sekolah_slogan			= $sql->slogan;
				$logo01					= $sql->logo;
				$logofrontapps01		= $sql->frontpage;
			}
			$getfoto 	= Datainduk::where('noinduk', $user->noinduk)->where('id_sekolah', $user->id_sekolah)->first();
			if ($getfoto && $getfoto->foto) {
				$foto 	= $homebase.'/dist/img/foto/'.$getfoto->foto;
			} else {
				$foto 	= $homebase.'/logo.png';
			}
			session([
				'id'						=> $user->id,
				'nama' 	    				=> $user->nama,
				'noinduk'					=> $user->noinduk,
				'marking'        			=> $user->deskripsi,
				'fakultas'					=> $subdomainapps01,
				'fakpanjang'				=> $subsubdomainapps01,
				'avatar'        			=> $foto,
				'sekolah_nama_aplikasi'  	=> $namaapps01,
				'sekolah_id_sekolah'  		=> $user->id_sekolah,
				'sekolah_level'  			=> $sekolah_level,
				'sekolah_nama_yayasan'		=> $domainapps01,
				'sekolah_nama_sekolah'  	=> $subsubdomainapps01,
				'sekolah_kode_sekolah'  	=> $subdomainapps01,
				'sekolah_nama_kasek'  		=> $sekolah_nama_kasek,
				'sekolah_nis'  				=> $sekolah_nis,
				'sekolah_nss'  				=> $sekolah_nss,
				'sekolah_npsn'				=> $sekolah_npsn,
				'sekolah_alamat'			=> $addressapps01,
				'sekolah_kota'				=> $kota01,
				'sekolah_telp'				=> $sekolah_telp,
				'sekolah_email'				=> $emailapps01,
				'sekolah_slogan'			=> $sekolah_slogan,
				'sekolah_frontpage'			=> $logofrontapps01,
				'sekolah_logo'				=> $logo01,
			]);
			
			$response = [
				'message'       => 'User SignIn',
				'user'          => $user,
			];
			return response()->json($response, 200);
		} else {
			$response = [
				'message'       => 'No. Ujian ('.$email.') dengan Nomor Induk '.$password.' yang dimasukkan tidak ditemukan',
			];
			return response()->json($response, 500);
		}
	
        $response = [
            'message'       => 'An Error Occured'
        ];
        return response()->json($response, 500);  
    }
	public function exInputBankSoal(Request $request) {
		$idne		= $request->input('set01');
		$keterangan	= '';
		$idsoal		= 0;
		if ($idne == 'hapus'){
			$idne		= $request->input('set02');
			$getdata 	= Banksoal::where('id', $idne)->first();
			if (isset($getdata->id)){
				$lampiran 	= $getdata->lampiran;
				$cekdulu 	= Banksoalujian::where('idsoal', $idne)->count();
				if ($cekdulu == 0){
					if ($lampiran != ''){
						if (File::exists(public_path()."/".$lampiran)) {
							File::delete(public_path()."/".$lampiran);
						}
					}
					if ($getdata->lampiran2 != '' AND $getdata->lampiran2 != null){
						if (File::exists(public_path()."/".$getdata->lampiran2)) {
							File::delete(public_path()."/".$getdata->lampiran2);
						}
					}
					if ($getdata->lampiran3 != '' AND $getdata->lampiran3 != null){
						if (File::exists(public_path()."/".$getdata->lampiran3)) {
							File::delete(public_path()."/".$getdata->lampiran3);
						}
					}
					if ($getdata->lampiran4 != '' AND $getdata->lampiran4 != null){
						if (File::exists(public_path()."/".$getdata->lampiran4)) {
							File::delete(public_path()."/".$getdata->lampiran4);
						}
					}
					if ($getdata->lampiran5 != '' AND $getdata->lampiran5 != null){
						if (File::exists(public_path()."/".$getdata->lampiran5)) {
							File::delete(public_path()."/".$getdata->lampiran5);
						}
					}
					if ($getdata->lampiran6 != '' AND $getdata->lampiran6 != null){
						if (File::exists(public_path()."/".$getdata->lampiran6)) {
							File::delete(public_path()."/".$getdata->lampiran6);
						}
					}
					$input 		= Banksoal::where('id', $idne)->delete();
					$keterangan = 'Delete Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
				} else {
					if ($lampiran != ''){
						if (File::exists(public_path()."/".$lampiran)) {
							File::delete(public_path()."/".$lampiran);
						}
					}
					Banksoal::where('id', $idne)->update([
						'active'	=> 0,
						'view'		=> 0,
						'inputor'	=> 'Deleted By '.Session('nama').' at '.date('Y-m-d H:i:s')
					]);
					$keterangan = 'Marking Non Aktif Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
				}
			} else {
				$keterangan = 'Delete Soal Dengan ID '.$idne.' Tidak ditemukan';
			}
		} else if ($idne == 'setverified'){
			$idne		= $request->input('set02');
			$getdata 	= Banksoal::where('id', $idne)->first();
			if (isset($getdata->id)){
				Banksoal::where('id', $idne)->update([
					'view'			=> 1,
					'active'		=> 1,
					'verified_by'	=> Session('nip'),
					'inputor'		=> 'Verified at '.date('Y-m-d H:i:s')
				]);
				$keterangan = 'Marking Aktif Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
			} else {
				$keterangan = 'Delete Soal Dengan ID '.$idne.' Tidak ditemukan';
			}
		} else if ($idne == 'setunverified'){
			$idne		= $request->input('set02');
			$getdata 	= Banksoal::where('id', $idne)->first();
			if (isset($getdata->id)){
				$catatan= ' <br /> Permintaan dari '.Session('nama').' '.date('Y-m-d H:i:s').' untuk diperbaiki';
				Banksoal::where('id', $idne)->update([
					'view'			=> 1,
					'verified_by'	=> '',
					'inputor'		=> $catatan
				]);
				$keterangan = 'Marking Non Aktif Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
			} else {
				$keterangan = 'Delete Soal Dengan ID '.$idne.' Tidak ditemukan';
			}
		} else if ($idne == 'akhiriujian'){
			$idne		= $request->input('set02');
			$catatan	= 'Ended at '.date('Y-m-d H:i:s');
			$update		= Datanilai::where('noinduk', Session('noinduk'))->where('deskripsi', Session('marking'))->update([
				'status'	=> 0,
				'catatan'   => $catatan
			]);
            if ($update){
                $keterangan = 'Back Home';
            } else {
                $keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
            }
			
		} else if ($idne == 'Stopindividu'){
			$idne		= $request->input('val02');
			$getcatatan = Datanilai::where('noinduk', $idne)->where('marking', $request->input('val03'))->first();
            if (isset($getcatatan->catatan)){
                $idne   	= $getcatatan->id;
                $catatan	= $getcatatan->catatan;
                $catatan	= $catatan.' <br /> Stopped By '.Session('nama').' at '.date('Y-m-d H:i:s');
                $update 	= Datanilai::where('id', $idne)->update([
                    'status'	=> 0,
                    'catatan'   => $catatan
                ]);
                if ($update){
                    $keterangan = 'Set Off Done';
                } else {
                    $keterangan = 'Marking Off Gagal dilakukan, silahkan ulangi beberapa saat lagi';
                }
            }
		} else if ($idne == 'startindividu'){
			$idne		= $request->input('val02');
			$getcatatan = Datanilai::where('noinduk', $idne)->where('marking', $request->input('val03'))->first();
            if (isset($getcatatan->catatan)){
                $idne   = $getcatatan->id;
                $catatan= $getcatatan->catatan;
                $catatan= $catatan.' <br /> Started By '.Session('nama').' at '.date('Y-m-d H:i:s');
                $update 	= Datanilai::where('id', $idne)->update([
                    'status'	=> 9,
                    'catatan'   => $catatan
                ]);
                if ($update){
                    $keterangan = 'Set On Done';
                } else {
                    $keterangan = 'Marking On Gagal dilakukan, silahkan ulangi beberapa saat lagi';
                }
            }
		} else if ($idne == 'onofpengumuman'){
			$marking	= $request->input('set02');
			$ceksek 	= Banksoaltest::where('marking', $marking)->first();
			if (isset($ceksek->id)){
				$pengumuman = $ceksek->pengumuman;
				if ($pengumuman == '0'){ $pengumuman = '1'; $status = 2; }
				else { $pengumuman = '0'; $status = $ceksek->status; }
				$update 	= Banksoaltest::where('marking', $marking)->update([
					'pengumuman'	=> $pengumuman,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($update){
					Banksoalujian::where('marking', $ceksek->marking)->update([
						'pengumuman'	=> $pengumuman
					]);
					Datanilai::where('marking', $marking)->update([
						'status'	=> $status
					]);
					$keterangan = 'Pengumuman Telah di Update';
				} else {
					$keterangan = 'Marking Pengumuman Gagal dilakukan, silahkan ulangi beberapa saat lagi';
				}
			} else {
				$keterangan = 'Marking Tidak ditemukan';
			}

		} else if ($idne == 'removepeserta'){
			$idmahasiswa	= $request->input('set02');
			$marking		= $request->input('set03');
			$cekjawaban 	= Banksoalujian::where('marking', $marking)->where('idmahasiswa', $idmahasiswa)->where('skore', '!=', '0.00')->count();
			if ($cekjawaban == 0){
				$update 	= Banksoalujian::where('marking', $marking)->where('idmahasiswa', $idmahasiswa)->delete();
				$keterangan = 'Peserta terhapus dari List';
			} else {
				$update 	= Banksoalujian::where('marking', $marking)->where('idmahasiswa', $idmahasiswa)->update([
					'status'		=> 3, //disable
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				$keterangan = 'Peserta terset arsip dari List';
			}
			if ($update){
				Datanilai::where('marking', $marking)->where('noinduk', $idmahasiswa)->delete();
			} else {
				$keterangan = 'Remove Peserta Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'ubahspv'){
			$idspv			= $request->input('set02');
			$idujian		= $request->input('set03');
			$idsoal			= $request->input('set04');
			$inputor 		= Session('nama');
			$input 	= Banksoaltest::where('id', $idujian)->where('idsoal', $idsoal)->update([
				'idsupervisor'	=> $idspv,
				'supervisor'	=> $inputor,
				'updated_at'	=> date('Y-m-d H:i:s')
			]);
			if ($input){
				$keterangan = 'Setting SPV an '.$inputor;
			} else {
				$keterangan = 'Update SPV an '.$inputor.' Gagal, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'tryout' OR $idne == 'setujian'){
			$idne		= $request->input('set02');
			$update 	= User::where('username', Session('username'))->update([
				'paraf'		=> $idne,
				'updated_at'=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Lets Get Started';
			} else {
				$keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'verifikasimulti'){
			$arrid		= $request->input('set02');
			foreach ($arrid as $idne){
				$getdata 	= Banksoal::where('id', $idne)->first();
				$inputor 	= 'Verified By '.Session('nama').' at '.date("Y-m-d H:i:s");
				$update 	= Banksoal::where('id', $idne)->update([
					'inputor'		=> $inputor,
					'verified_by'	=> Session('nip'),
					'view'			=> 1,
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				if ($update){
					$keterangan = $keterangan.'ID '.$idne.' Activated; ';
				} else {
					$keterangan = $keterangan.'ID '.$idne.' Failed To Activated; ';
				}
			}
		} else if ($idne == 'verifikasi'){
			$idne		= $request->input('set02');
			if ($request->input('set03') !== null){
				$komen	= $request->input('set03');
			} else {
				$komen 	= '';
			}
			$getdata 	= Banksoal::where('id', $idne)->first();
			$inputor 	= $komen.' Verified By '.Session('nama').' at '.date("Y-m-d H:i:s");
			$update 	= Banksoal::where('id', $idne)->update([
				'inputor'		=> $inputor,
				'verified_by'	=> Session('nip'),
				'view'			=> 1,
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Marking Aktif Soal Dengan ID '.$idne.' Kode '.$getdata->kode.' '.$getdata->deskripsi;
			} else {
				$keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'tolakverifikasi'){
			$idne		= $request->input('set02');
			if ($request->input('set03') !== null){
				$komen	= $request->input('set03');
			} else {
				$komen 	= '';
			}
			$getdata 	= Banksoal::where('id', $idne)->first();
			$inputor 	= 'Rejected by '.Session('nama').' at '.date("Y-m-d H:i:s").', notes: '.$komen;
			$update 	= Banksoal::where('id', $idne)->update([
				'inputor'	=> $inputor,
				'view'		=> 0,
				'updated_at'=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Marking Soal Dengan ID '.$idne.' Sukses, dengan komentar '.$komen;
			} else {
				$keterangan = 'Marking Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else if ($idne == 'new'){
			$opsib		= $request->input('set06');
			$opsic		= $request->input('set07');
			$opsid		= $request->input('set08');
			$opsie		= $request->input('set09');
			$idmatpel	= $request->input('set13');
			$getdtmp 	= Datakkm::where('id', $idmatpel)->first();
			if (isset($getdtmp->id)){
				$deskripsitambahan = $getdtmp->matpel.' Kelas '.$getdtmp->kelas.' Semester '.$request->input('set02');
			} else {
				$deskripsitambahan = '';
			}
			if (is_null($opsib) OR $opsib == ''){ $opsib = '-'; }
			if (is_null($opsic) OR $opsic == ''){ $opsic = '-'; }
			if (is_null($opsid) OR $opsid == ''){ $opsid = '-'; }
			if (is_null($opsie) OR $opsie == ''){ $opsie = '-'; }
			$cekdeskripsi = Banksoal::where('deskripsi', $request->input('set04'))->where('jawaban', $request->input('set11'))->where('kunci', $request->input('set10'))->count();
			if ($cekdeskripsi == 0){
				$input 	= Banksoal::create([
					'kode'					=> $request->input('set02'),
					'ceel'					=> $request->input('set13'),
					'deskripsi'				=> $request->input('set04'),
					'deskripsitambahan'		=> $deskripsitambahan,
					'lampiran'				=> '',
					'lampiran2' 			=> '',
					'lampiran3' 			=> '',
					'lampiran4' 			=> '',
					'lampiran5' 			=> '',
					'lampiran6' 			=> '',
					'jawaban'				=> $request->input('set11'),
					'opsia' 				=> $request->input('set05'),
					'opsib' 				=> $opsib,
					'opsic' 				=> $opsic,
					'opsid' 				=> $opsid,
					'opsie' 				=> $opsie,
					'kunci' 				=> $request->input('set10'),
					'active'				=> 1,
					'inputor'				=> '',
					'view'					=> 0,
					'created_by'			=> Session('nip'),
                    'id_sekolah' 	        => session('sekolah_id_sekolah')
				]);
				$idsoal 	= $input->id;
				$fullkode 	= date("y").'-'.$request->input('set02').'-'.$request->input('set03').'-'.$idsoal;
				Banksoal::where('id', $idsoal)->update([
					'fullkode'	=> $fullkode
				]);
				$keterangan = 'Tambah Soal Dengan ID '.$fullkode.' Kode '.$request->input('set02').' Sukses';
			} else {
				$keterangan = 'Soal Dengan Deskripsi '.$request->input('set04').' Tedeteksi Double, Mohon Ubah Deskripsi atau pilihan jawaban';
			}
		} else if ($idne == 'upload'){
			$path 			= $_FILES['file']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$xx 			= '-';
			$marking 		= date("y").'-'.Session('nim');
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				if(is_null($val['I']) OR $val['I'] == 'KONTRIBUTOR' OR $val['I'] == ''){
					//
				} else {
					$email 			= $val['I'];
					$getfakultas 	= User::where('email', $email)->first();
					if (isset($getfakultas->id)){
						$fakultas 	= $getfakultas->unit_kerja;
						$fakpanjang	= $getfakultas->prodihomebase;
						$inputor 	= $getfakultas->nama_lengkap;
					} else {
						$fakultas 	= subdomainapps07;
						$fakpanjang	= subsubdomainapps07;
						$inputor 	= Session('nama');
					}
					$cekdeskripsi = Banksoal::where('deskripsi', $val['B'])->where('jawaban', $val['M'])->where('kunci', $val['H'])->count();
					if ($cekdeskripsi == 0){
						$input 	= Banksoal::create([
							'kode'					=> $val['L'],
							'ceel'					=> $val['J'],
							'deskripsi'				=> $val['B'],
							'deskripsitambahan'		=> '',
							'lampiran'				=> $val['N'],
							'lampiran2' 			=> '',
							'lampiran3' 			=> '',
							'lampiran4' 			=> '',
							'lampiran5' 			=> '',
							'lampiran6' 			=> '',
							'jawaban'				=> $val['M'],
							'opsia' 				=> $val['C'],
							'opsib' 				=> $val['D'],
							'opsic' 				=> $val['E'],
							'opsid' 				=> $val['F'],
							'opsie' 				=> $val['G'],
							'kunci' 				=> $val['H'],
							'active'				=> 1,
							'inputor'				=> '',
							'view'					=> 1,
							'created_by'			=> $email,
                            'id_sekolah' 	        => session('sekolah_id_sekolah')
						]);
						if ($input){
							$idsoal 	= $input->id;
							$fullkode 	= date("y").'-'.$val['L'].'-'.$val['J'].'-'.$val['K'].'-'.$idsoal;
							Banksoal::where('id', $idsoal)->update([
								'fullkode'	=> $fullkode
							]);
							$sukses++;
						} else {
							$error 		= $error.'; Gagal Input Nomor '.$val['A'];
						}
					} else {
						$error 		= $error.'; Tedeteksi Double Input Nomor '.$val['A'];
					}
				}
			}
			$keterangan = 'Upload Soal Sejumlah '.$sukses.'; Keterangan '.$error;
		} else if ($idne == 'editnilai'){
			$update = Banksoalujian::where('id', $request->input('set02'))->update([
				'skore'			=> $request->input('set03'),
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
			if ($update){
				$keterangan = 'Skore Set To '.$request->input('set03');
			} else {
				$keterangan = 'Skoring Gagal dilakukan, silahkan ulangi beberapa saat lagi';
			}
		} else {
			$opsib		= $request->input('set06');
			$opsic		= $request->input('set07');
			$opsid		= $request->input('set08');
			$opsie		= $request->input('set09');
			$cekfile01	= $request->input('set19');
			$cekfile02	= $request->input('set20');
			$cekfile03	= $request->input('set21');
			$cekfile04	= $request->input('set22');
			$cekfile05	= $request->input('set23');
			$cekfile06	= $request->input('set24');
			$idmatpel	= $request->input('set13');
			$getdtmp 	= Datakkm::where('id', $idmatpel)->first();
			if (isset($getdtmp->id)){
				$deskripsitambahan = $getdtmp->matpel.' Kelas '.$getdtmp->kelas.' Semester '.$request->input('set02');
			} else {
				$deskripsitambahan = '';
			}
			if (is_null($cekfile01)){ $cekfile01 = ''; }
			if (is_null($cekfile02)){ $cekfile02 = ''; }
			if (is_null($cekfile03)){ $cekfile03 = ''; }
			if (is_null($cekfile04)){ $cekfile04 = ''; }
			if (is_null($cekfile05)){ $cekfile05 = ''; }
			if (is_null($cekfile06)){ $cekfile06 = ''; }
			if (is_null($opsib) OR $opsib == ''){ $opsib = '-'; }
			if (is_null($opsic) OR $opsic == ''){ $opsic = '-'; }
			if (is_null($opsid) OR $opsid == ''){ $opsid = '-'; }
			if (is_null($opsie) OR $opsie == ''){ $opsie = '-'; }
			$getdata 	= Banksoal::where('id', $idne)->first();
			if (isset($getdata->id)){
				$ceksudahvalid 	= $getdata->view;
				if ($cekfile01 == '' AND $getdata->lampiran != ''){
					if (File::exists(public_path()."/".$getdata->lampiran)) {
						File::delete(public_path()."/".$getdata->lampiran);
					}
				}
				if ($cekfile02 == '' AND $getdata->lampiran2 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran2)) {
						File::delete(public_path()."/".$getdata->lampiran2);
					}
				}
				if ($cekfile03 == '' AND $getdata->lampiran3 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran3)) {
						File::delete(public_path()."/".$getdata->lampiran3);
					}
				}
				if ($cekfile04 == '' AND $getdata->lampiran4 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran4)) {
						File::delete(public_path()."/".$getdata->lampiran4);
					}
				}
				if ($cekfile05 == '' AND $getdata->lampiran5 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran5)) {
						File::delete(public_path()."/".$getdata->lampiran5);
					}
				}
				if ($cekfile06 == '' AND $getdata->lampiran6 != ''){
					if (File::exists(public_path()."/".$getdata->lampiran6)) {
						File::delete(public_path()."/".$getdata->lampiran6);
					}
				}
				if ($cekfile01 == 'ada'){ $cekfile01 = $getdata->lampiran; }
				if ($cekfile02 == 'ada'){ $cekfile02 = $getdata->lampiran2; }
				if ($cekfile03 == 'ada'){ $cekfile03 = $getdata->lampiran3; }
				if ($cekfile04 == 'ada'){ $cekfile04 = $getdata->lampiran4; }
				if ($cekfile05 == 'ada'){ $cekfile05 = $getdata->lampiran5; }
				if ($cekfile06 == 'ada'){ $cekfile06 = $getdata->lampiran6; }
				$cekdeskripsi 	= Banksoal::where('id', '!=', $idne)->where('deskripsi', $request->input('set04'))->where('jawaban', $request->input('set11'))->where('kunci', $request->input('set10'))->count();
				if ($cekdeskripsi == 0){
					if ($ceksudahvalid == 1){
						if (Session('previlage') == 'administarator'){
							$input 	= Banksoal::where('id', $idne)->update([
								'kode'					=> $request->input('set02'),
								'ceel'					=> $request->input('set13'),
								'deskripsitambahan'		=> $deskripsitambahan,
								'deskripsi'				=> $request->input('set04'),
								'opsia' 				=> $request->input('set05'),
								'opsib' 				=> $opsib,
								'opsic' 				=> $opsic,
								'opsid' 				=> $opsid,
								'opsie' 				=> $opsie,
								'view'					=> 1,
								'active'				=> 1,
                                'kunci' 				=> $request->input('set10'),
								'jawaban'				=> $request->input('set11'),
								'lampiran'				=> $cekfile01,
								'lampiran2' 			=> $cekfile02,
								'lampiran3' 			=> $cekfile03,
								'lampiran4' 			=> $cekfile04,
								'lampiran5' 			=> $cekfile05,
								'lampiran6' 			=> $cekfile06,
                                'verified_by'	        => 'Update By Admin',
								'updated_at'			=> date("Y-m-d H:i:s")
							]);
							$idsoal 	= $idne;
							$keterangan = 'Update Soal Dengan ID '.$idsoal.' Kode '.$request->input('set01');
                          	
						} else {
							$input 	= Banksoal::where('id', $idne)->update([
								'kode'					=> $request->input('set02'),
								'ceel'					=> $request->input('set13'),
								'deskripsi'				=> $request->input('set04'),
								'deskripsitambahan'		=> $deskripsitambahan,
								'opsia' 				=> $request->input('set05'),
								'opsib' 				=> $opsib,
								'opsic' 				=> $opsic,
								'opsid' 				=> $opsid,
								'opsie' 				=> $opsie,
								'kunci' 				=> $request->input('set10'),
								'jawaban'				=> $request->input('set11'),
								'view'					=> 0,
								'active'				=> 1,
                                'verified_by'	        => '',
								'lampiran'				=> $cekfile01,
								'lampiran2' 			=> $cekfile02,
								'lampiran3' 			=> $cekfile03,
								'lampiran4' 			=> $cekfile04,
								'lampiran5' 			=> $cekfile05,
								'lampiran6' 			=> $cekfile06,
								'updated_at'			=> date("Y-m-d H:i:s")
							]);
							$idsoal = $idne;
							$keterangan = 'Update Soal Dengan ID '.$idsoal.' Kode '.$request->input('set01').' Sukses Namun harus di Validasi Ulang, karena telah di validasi sebelumnya';
						}
					} else {
						$input 	= Banksoal::where('id', $idne)->update([
							'kode'					=> $request->input('set02'),
							'ceel'					=> $request->input('set13'),
							'deskripsi'				=> $request->input('set04'),
							'deskripsitambahan'		=> $deskripsitambahan,
							'opsia' 				=> $request->input('set05'),
							'opsib' 				=> $opsib,
							'opsic' 				=> $opsic,
							'opsid' 				=> $opsid,
							'opsie' 				=> $opsie,
							'lampiran'				=> $cekfile01,
							'lampiran2' 			=> $cekfile02,
							'lampiran3' 			=> $cekfile03,
							'lampiran4' 			=> $cekfile04,
							'lampiran5' 			=> $cekfile05,
							'lampiran6' 			=> $cekfile06,
							'kunci' 				=> $request->input('set10'),
							'jawaban'				=> $request->input('set11'),
							'active'				=> 1,
                            'view'					=> 0,
							'verified_by'	        => '',
							'updated_at'			=> date("Y-m-d H:i:s")
						]);
						$idsoal = $idne;
						$keterangan = 'Update Soal Dengan ID '.$idsoal.' Kode '.$request->input('set01').' Sukses';
					}
                  	Banksoaltest::where('idsoal', $idsoal)->update([
                      'kode'					=> $request->input('set02'),
                      'ceel'					=> $request->input('set13'),
                      'deskripsi'				=> $request->input('set04'),
                      'opsia' 				    => $request->input('set05'),
                      'opsib' 				    => $opsib,
                      'opsic' 				    => $opsic,
                      'opsid' 				    => $opsid,
                      'opsie' 				    => $opsie,
                      'kunci' 				    => $request->input('set10'),
                      'tipesoal'				=> $request->input('set11'),
                      'lampiran'				=> $cekfile01,
                      'lampiran2' 			    => $cekfile02,
                      'lampiran3' 			    => $cekfile03,
                      'lampiran4' 			    => $cekfile04,
                      'lampiran5' 			    => $cekfile05,
                      'lampiran6' 			    => $cekfile06,
                    ]);
                  $keterangan = $keterangan.' Test Untuk ID Soal '.$idsoal.' Berhasil di Update';
				} else {
					$keterangan = 'Soal Dengan Deskripsi '.$request->input('set04').' Tedeteksi Double, Mohon Ubah Deskripsi atau pilihan jawaban';
				}
			} else {
				$keterangan = 'Soal Dengan ID '.$idne.' Tidak di Temukan';
			}
		}
		if ($idsoal != 0){
			if ($request->hasFile('file')) {
				$nmfile1 = 'Pic01-'.$idsoal.'.'.$request->file('file')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile1)) {
					File::delete(public_path()."/".$nmfile1);
				}
				$request->file->move(public_path('images/soal/'), $nmfile1);
				Banksoal::where('id', $idsoal)->update([
					'lampiran'	=> 'images/soal/'.$nmfile1,
				]);
			}
			if ($request->hasFile('file2')) {
				$nmfile2 = 'Pic02-'.$idsoal.'.'.$request->file('file2')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile2)) {
					File::delete(public_path()."/".$nmfile2);
				}
				$request->file('file2')->move(public_path('images/soal/'), $nmfile2);
				Banksoal::where('id', $idsoal)->update([
					'lampiran2'	=> 'images/soal/'.$nmfile2,
				]);
			}
			if ($request->hasFile('file3')) {
				$nmfile3 = 'Pic03-'.$idsoal.'.'.$request->file('file3')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile3)) {
					File::delete(public_path()."/".$nmfile3);
				}
				$request->file('file3')->move(public_path('images/soal/'), $nmfile3);
				Banksoal::where('id', $idsoal)->update([
					'lampiran3'	=> 'images/soal/'.$nmfile3,
				]);
			}
			if ($request->hasFile('file4')) {
				$nmfile4 = 'Pic04-'.$idsoal.'.'.$request->file('file4')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile4)) {
					File::delete(public_path()."/".$nmfile4);
				}
				$request->file('file4')->move(public_path('images/soal/'), $nmfile4);
				Banksoal::where('id', $idsoal)->update([
					'lampiran4'	=> 'images/soal/'.$nmfile4,
				]);
			}
			if ($request->hasFile('file5')) {
				$nmfile5 = 'Pic05-'.$idsoal.'.'.$request->file('file5')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile5)) {
					File::delete(public_path()."/".$nmfile5);
				}
				$request->file('file5')->move(public_path('images/soal/'), $nmfile5);
				Banksoal::where('id', $idsoal)->update([
					'lampiran5'	=> 'images/soal/'.$nmfile5,
				]);
			}
			if ($request->hasFile('file6')) {
				$nmfile6 = 'Pic06-'.$idsoal.'.'.$request->file('file6')->getClientOriginalExtension();
				if (File::exists(public_path()."/".$nmfile6)) {
					File::delete(public_path()."/".$nmfile6);
				}
				$request->file('file6')->move(public_path('images/soal/'), $nmfile6);
				Banksoal::where('id', $idsoal)->update([
					'lampiran6'	=> 'images/soal/'.$nmfile6,
				]);
			}
		}
		echo $keterangan;
	}
	public function getBankSoal(Request $request) {
		$arraysurat 	= [];
		$previlage		= Session('previlage');
		$jenis   		= $request->input('jenis');
        $view   		= $request->input('view');
        $homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		$totaldata  	= 0;
        $limit         	= 10;
        $limit      	= ($request->input('limit') == null ? $limit : $request->input('limit'));
		$order      	= ($request->input('order') == null ? 'id desc' : $request->input('order'));
        $ceksek 		= explode(" ", $order);
		if (Session('previlage') == 'level1'  OR Session('previlage') == 'Waka Kurikulum'){
			if ($jenis == '0'){
				$data 	    = Banksoal::where('active', $jenis)->select('bs_banksoal.*');
			} else if ($jenis == '1'){
				$data 	    = Banksoal::where('active', '1')->where('verified_by', '<>', '')->select('bs_banksoal.*');
			} else if ($jenis == '2'){
				$data 	    = Banksoal::where('active', '1')->where(function($q) { 
                                        $q->whereNull('verified_by')->orWhere('verified_by', '');
                                    })->select('bs_banksoal.*');
			} else if ($jenis == '3'){
				$data 	    = Banksoal::where('active', '1')->where('inputor', 'LIKE', 'Rejected%')->select('bs_banksoal.*');
			} else {
				$data 	    = Banksoal::where('fullkode', 'LIKE', '%'.$jenis.'%')->select('bs_banksoal.*');
			}
		} else {
			if ($jenis == '0'){
                $data 	    = Banksoal::where('created_by', Session('nip'))->where('active', $jenis)->select('bs_banksoal.*');
            } else if ($jenis == '1'){
                $data 	    = Banksoal::where('created_by', Session('nip'))->where('verified_by', '<>', '')->where('active', '1')->select('bs_banksoal.*');
            } else if ($jenis == '2'){
                $data 	    = Banksoal::where('created_by', Session('nip'))->where(function($q) { 
                                    $q->whereNull('verified_by')->orWhere('verified_by', '');
                                })->select('bs_banksoal.*');
            } else if ($jenis == '3'){
                $data 	    = Banksoal::where('created_by', Session('nip'))->where('active', '1')->where('inputor', 'LIKE', 'Rejected%')->select('bs_banksoal.*');
            } else {
                $data 	    = Banksoal::where('created_by', Session('nip'))->where('fullkode', 'LIKE', '%'.$jenis.'%')->select('bs_banksoal.*');
            }
		}
		if (isset($ceksek[1])){
			$variabel 	= $ceksek[0];
			$urutan		= $ceksek[1];
			if ($variabel == 'undefined'){
				$variabel = 'id';
			}
			$order 		= $variabel.' '.$urutan;
		}
		if ($request->has('valcari') && !empty($request->valcari)) {
			$searchTerm = $request->valcari;
			$data->where(function ($q) use ($searchTerm) {
				$q->where('deskripsi', 'like', "%$searchTerm%")
					->orWhere('deskripsitambahan', 'like', "%$searchTerm%")
					->orWhere('created_by', 'like', "%$searchTerm%")
					->orWhere('created_at', 'like', "%$searchTerm%");
			});
		}
        $data       	= $data->orderByRaw($order)->paginate($limit);
		$totaldata		= $data->total();
		if (!empty($data)){
			foreach ($data as $hasil){
				$idsoal 	= $hasil->id;
				$tlssoale	= $hasil->deskripsi;
				$alasan		= $hasil->deskripsitambahan;
				$kode		= $hasil->kode;
				$ceel		= $hasil->ceel;
				$aktif		= $hasil->active;
				$tipesoal	= $hasil->jawaban;
				$view		= $hasil->view;
				$tahun		= $hasil->created_at->year;
				$lampiran	= $hasil->lampiran;
				$fullkode	= $hasil->fullkode;
				$nilai01	= $hasil->nilai01;
				if (is_null($fullkode) OR $fullkode == ''){
					$fullkode = $tahun.'-'.$kode.'-'.$ceel.$idsoal;
					Banksoal::where('id', $idsoal)->update([
						'fullkode'	=> $fullkode
					]);
				}
				if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
				$showjawab	= '';	
				$deskripsi 	= str_replace("</p><p>", "<br />", $hasil->deskripsi);
				$opsia 		= str_replace("</p><p>", "<br />", $hasil->opsia);
				$opsib 		= str_replace("</p><p>", "<br />", $hasil->opsib);
				$opsic 		= str_replace("</p><p>", "<br />", $hasil->opsic);
				$opsid 		= str_replace("</p><p>", "<br />", $hasil->opsid);
				$opsie 		= str_replace("</p><p>", "<br />", $hasil->opsie);
				$kunci 		= str_replace("</p><p>", "<br />", $hasil->kunci);
				$deskripsi 	= str_replace($vowels, "", $deskripsi);
				$opsia 		= str_replace($vowels, "", $opsia);
				$opsib 		= str_replace($vowels, "", $opsib);
				$opsic 		= str_replace($vowels, "", $opsic);
				$opsid 		= str_replace($vowels, "", $opsid);
				$opsie 		= str_replace($vowels, "", $opsie);
				$kunci 		= str_replace($vowels, "", $kunci);
				$kunci 		= preg_replace('/\s+/', '', $kunci);
				$kunci 		= strtoupper($kunci);
				Banksoal::where('id', $idsoal)->update([
					'opsia'		=> $opsia,
					'opsib'		=> $opsib,
					'opsic'		=> $opsic,
					'opsid'		=> $opsid,
					'opsie'		=> $opsie,
					'kunci'		=> $kunci,
					'deskripsi'	=> $deskripsi,
				]);
				if ($tipesoal == 'Labelled Case'){
					$showjawab	= '<table border="0" width="100%"><tr><td width="5%"><strong>Point A</strong></td><td>'.$opsia.'</td><td width="5%"><strong>Point B</strong></td><td>'.$opsib.'</td></tr><tr><td><strong>Point C</strong></td><td>'.$opsic.'</td><td><strong>Point D</strong></td><td>'.$opsid.'</td></tr><tr><td><strong>Point E</strong></td><td>'.$opsie.'</td><td colspan="2"><i><u>Soal Label Dengan Masing-Masing Jawaban di atas</u></i></td></tr></table>';
				} else if ($tipesoal == 'esay'){
					$showjawab	= '<table border="0" width="100%"><tr><td><strong>Esay Case With Answer Deskription Like :</strong><br />'.$opsia.'</td></tr></table>';
				} else {
					$showjawab	= '<table border="0" width="100%"><tr><td width="5%"><strong>A</strong></td><td>'.$opsia.'</td><td width="5%"><strong>B</strong></td><td>'.$opsib.'</td></tr><tr><td><strong>C</strong></td><td>'.$opsic.'</td><td><strong>D</strong></td><td>'.$opsid.'</td></tr><tr><td><strong>E</strong></td><td>'.$opsie.'</td><td colspan="2"><strong><font color=blue>Keys : </font></strong><span class="badge badge-primary"> '.$kunci.'</span></td></tr></table>';
				}
				$keterangan	= '<strong>Inputor : </strong>'.$hasil->inputor.'<br /><strong>Used On :</strong>'.$hasil->deskripsitambahan.'<br />Facility : '.$hasil->nilai01.' ( '.$hasil->keterangan01.' )<br />Discrimination : '.$hasil->nilai02.' ( '.$hasil->keterangan02.' )<br />so the question is : '.$hasil->kesimpulan.'<p></p>';
				$arraysurat[] = array(
					'idsoal' 			=> $idsoal,
					'tipesoal' 			=> $tipesoal,	
					'jawaban' 			=> $hasil->jawaban,
					'showjawab' 		=> $showjawab,
					'keterangan' 		=> $keterangan,
					'kode' 				=> $kode,
					'fullkode' 			=> $hasil->fullkode,
					'ceel' 				=> $ceel,	
					'inputor' 			=> $hasil->inputor,
					'aktif' 			=> $hasil->active,
					'view' 			    => $hasil->view,
					'aktifview' 		=> $view,
					'lampiran' 			=> $hasil->lampiran,
					'alasan' 			=> $alasan,
					'deskripsi' 		=> $deskripsi,
					'jawaba' 			=> $opsia,
					'jawabb' 			=> $opsib,
					'jawabc' 			=> $opsic,
					'jawabd' 			=> $opsid,
					'jawabe' 			=> $opsie,
					'kuncie' 			=> $kunci,
					'tahun' 			=> $hasil->created_at->year,
					'deskripsitambahan' => $hasil->deskripsitambahan,
					'verified_by' 		=> $hasil->verified_by,
					'created_by' 		=> $hasil->created_by,
					'id_sekolah' 		=> $hasil->id_sekolah,
				);
			}
		}
        $response = [
            'message'   => 'List Laporan',
            'previlage'	=> $previlage,
            'data'      => $arraysurat,
            'total'     => $totaldata,
			
        ];
        return response()->json($response, 200);
	}
	public function jsonGetSoalAktif() {
		$arraysurat 	= [];
		$homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		if (Session('previlage') == 'level1'  OR Session('previlage') == 'Waka Kurikulum'){
			$data 	    = Banksoal::where('view', 1)->get();
		} else {
			$data 	    = Banksoal::where('created_by', 'LIKE', Session('nip'))->where('view', 1)->get();
		}
		if (!empty($data)){
			foreach ($data as $hasil){
				$idsoal 	= $hasil->id;
				$tlssoale	= $hasil->deskripsi;
				$alasan		= $hasil->deskripsitambahan;
				$kode		= $hasil->kode;
				$ceel		= $hasil->ceel;
				$aktif		= $hasil->active;
				$tipesoal	= $hasil->jawaban;
				$view		= $hasil->view;
				$tahun		= $hasil->created_at->year;
				$lampiran	= $hasil->lampiran;
				$fullkode	= $hasil->fullkode;
				$nilai01	= $hasil->nilai01;
				if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
				$showjawab	= '';	
				$deskripsi 	= str_replace("</p><p>", "<br />", $hasil->deskripsi);
				$opsia 		= str_replace("</p><p>", "<br />", $hasil->opsia);
				$opsib 		= str_replace("</p><p>", "<br />", $hasil->opsib);
				$opsic 		= str_replace("</p><p>", "<br />", $hasil->opsic);
				$opsid 		= str_replace("</p><p>", "<br />", $hasil->opsid);
				$opsie 		= str_replace("</p><p>", "<br />", $hasil->opsie);
				$kunci 		= str_replace("</p><p>", "<br />", $hasil->kunci);
				$deskripsi 	= str_replace($vowels, "", $deskripsi);
				$opsia 		= str_replace($vowels, "", $opsia);
				$opsib 		= str_replace($vowels, "", $opsib);
				$opsic 		= str_replace($vowels, "", $opsic);
				$opsid 		= str_replace($vowels, "", $opsid);
				$opsie 		= str_replace($vowels, "", $opsie);
				$kunci 		= str_replace($vowels, "", $kunci);
				$kunci 		= preg_replace('/\s+/', '', $kunci);
				$kunci 		= strtoupper($kunci);
				$arraysurat[] = array(
					'idsoal' 			=> $idsoal,
					'tipesoal' 			=> $tipesoal,	
					'kode' 				=> $kode,
					'ceel' 				=> $ceel,	
					'inputor' 			=> $hasil->inputor,
					'aktif' 			=> $hasil->active,
					'aktifview' 		=> $view,
					'lampiran' 			=> $hasil->lampiran,
					'deskripsi' 		=> $deskripsi,
					'jawaba' 			=> $opsia,
					'jawabb' 			=> $opsib,
					'jawabc' 			=> $opsic,
					'jawabd' 			=> $opsid,
					'jawabe' 			=> $opsie,
					'kuncie' 			=> $kunci,
					'tahun' 			=> $hasil->created_at->year,
					'deskripsitambahan' => $hasil->deskripsitambahan,
				);
			}
		}
		echo json_encode($arraysurat);
    }
	public function dataJsonaktiftest(Request $request) {
		$arraysurat = [];
		$nomor		= 1;
		$masterno  	= $request->input('set01');
        $valcari   	= $request->input('set02');
		if ($valcari == 'cariujian'){
			$arraydata 	= Datanilai::where('noinduk', $masterno)->where('deskripsi', $request->input('set03'))->get();
			$response 	= [
				'noinduk'	=> $masterno,
				'marking'	=> $request->input('set03'),
				'data'		=> $arraydata
			];
			return response()->json($response, 200);
		} else if ($valcari == 'riwayatujian'){
			$arraysurat = Banksoalujian::select(DB::Raw('count(DISTINCT idsoal) as jumlah'), 'id', 'kode', 'ceel', 'mulai', 'selesai',  'timer', 'namaujian', 'supervisor', 'status', 'marking', 'pengumuman')->where('idmahasiswa', $masterno)->groupBy('marking')->orderBy('mulai', 'DESC')->get();
			echo json_encode($arraysurat);
		} else if ($valcari == 'Pengumuman'){
			$arraysurat = Datanilai::where('status', 2)->where('noinduk', $masterno)->get();
			echo json_encode($arraysurat);
		} else {
			$statusCondition 	= ($valcari == 'Arsip') ? '0' : '1';
			$createdByCondition = (Session('previlage') == 'level1' OR Session('previlage') == 'Waka Kurikulum') ? null : Session('nip');
			$query 				= Banksoaltest::where('status', $statusCondition);
			if ($createdByCondition) {
				$query->where('created_by', $createdByCondition);
			}
			$sql = $query->groupBy('marking')->orderBy('id', 'DESC')->get();

			$arraysurat = [];
			$nomor 		= 1;
			if (!empty($sql)) {
				foreach ($sql as $hasil) {
					$jumlah 	= Banksoaltest::where('marking', $hasil->marking)->count();
					$peserta 	= Datanilai::where('marking', $hasil->marking)->count();
					$arrmulai 	= explode(" ", $hasil->mulai);
					$arrakhir 	= explode(" ", $hasil->selesai);
					$pengumuman = ($hasil->pengumuman == '1') ? '&#10004;' : '';
					$arraysurat[] = [
						'id'            => $hasil->id,
						'peserta'       => $peserta,
						'tglmulai'      => $arrmulai[0],
						'jammulai'      => $arrmulai[1],
						'tglselesai'    => $arrakhir[0],
						'jamselesai'    => $arrakhir[1],
						'jumlah'        => $jumlah,
						'nomor'         => $nomor,
						'kode'          => $hasil->kode,
						'ceel'          => $hasil->ceel,
						'tanggal'       => $hasil->tanggal,
						'mulai'         => $hasil->mulai,
						'selesai'       => $hasil->selesai,
						'namaujian'     => $hasil->namaujian,
						'supervisor'    => $hasil->supervisor,
						'tlssupervisor' => $hasil->created_by,
						'tipe'          => $hasil->tipe,
						'status'        => $hasil->status,
						'timer'         => $hasil->timer,
						'marking'       => $hasil->marking,
						'pengumuman'    => $pengumuman,
						'tahun'         => $hasil->created_at->year,
					];
					$nomor++;
				}
			}
			echo json_encode($arraysurat);
		}
    	
	}
	public function getDetailSoal(Request $request) {
		$arraysurat 	= [];
		$homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		$idprodi   		= $request->input('val01');
        $valjenis   	= $request->input('val02');
        $sql			= Banksoaltest::where('namaujian', $idprodi)->where('kode', $valjenis)->get();
		if (!empty($sql)){
			foreach ($sql as $rows){
				$idsoal = $rows->idsoal;
				$hasil 	= Banksoal::where('id', $idsoal)->first();
				if (isset($hasil->id)){
					$idsoal 	= $hasil->id;
					$tlssoale	= $hasil->deskripsi;
					$alasan		= $hasil->deskripsitambahan;
					$kode		= $hasil->kode;
					$ceel		= $hasil->ceel;
					$aktif		= $hasil->active;
					$tipesoal	= $hasil->jawaban;
					$view		= $hasil->view;
					$tahun		= $hasil->created_at->year;
					$lampiran	= $hasil->lampiran;
					$fullkode	= $hasil->fullkode;
					$nilai01	= $hasil->nilai01;
					if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
					$showjawab	= '';	
					$deskripsi 	= str_replace("</p><p>", "<br />", $hasil->deskripsi);
					$opsia 		= str_replace("</p><p>", "<br />", $hasil->opsia);
					$opsib 		= str_replace("</p><p>", "<br />", $hasil->opsib);
					$opsic 		= str_replace("</p><p>", "<br />", $hasil->opsic);
					$opsid 		= str_replace("</p><p>", "<br />", $hasil->opsid);
					$opsie 		= str_replace("</p><p>", "<br />", $hasil->opsie);
					$kunci 		= str_replace("</p><p>", "<br />", $hasil->kunci);
					$deskripsi 	= str_replace($vowels, "", $deskripsi);
					$opsia 		= str_replace($vowels, "", $opsia);
					$opsib 		= str_replace($vowels, "", $opsib);
					$opsic 		= str_replace($vowels, "", $opsic);
					$opsid 		= str_replace($vowels, "", $opsid);
					$opsie 		= str_replace($vowels, "", $opsie);
					$kunci 		= str_replace($vowels, "", $kunci);
					$kunci 		= preg_replace('/\s+/', '', $kunci);
					$kunci 		= strtoupper($kunci);
					$arraysurat[] = array(
						'id' 				=> $rows->id,
						'idsoal' 			=> $idsoal,
						'tipesoal' 			=> $tipesoal,	
						'kode' 				=> $kode,
						'ceel' 				=> $ceel,	
						'inputor' 			=> $hasil->inputor,
						'aktif' 			=> $hasil->active,
						'aktifview' 		=> $view,
						'lampiran' 			=> $hasil->lampiran,
						'deskripsi' 		=> $deskripsi,
						'jawaba' 			=> $opsia,
						'jawabb' 			=> $opsib,
						'jawabc' 			=> $opsic,
						'jawabd' 			=> $opsid,
						'jawabe' 			=> $opsie,
						'kuncie' 			=> $kunci,
						'tahun' 			=> $hasil->created_at->year,
						'deskripsitambahan' => $hasil->deskripsitambahan,
					);
				}
			}
		}
		echo json_encode($arraysurat);
    }
	public function jsonRekapSoal(Request $request) {
		$alldata 		= [];
		$previlage		= Session('previlage');
		$idprodi   		= $request->input('val01');
        $valjenis   	= $request->input('val02');
        $homebase		= url("/");
		$vowels 		= array("<p>", "</p>");
		if ($valjenis == 'rekap'){
			$countkb		= Banksoaltest::where('namaujian', $idprodi)->where('kode', 'KB')->count();
			$countkd		= Banksoaltest::where('namaujian', $idprodi)->where('kode', 'KD')->count();
			$alldata[] = array(
				'jumlah'		=> $countkd,
				'idprodi'		=> $idprodi,
				'kodesoal'		=> 'KD',
				'tuliskode'		=> 'Soal Kompetensi Dasar',
			);
			$alldata[] = array(
				'jumlah'		=> $countkb,
				'idprodi'		=> $idprodi,
				'kodesoal'		=> 'KB',
				'tuliskode'		=> 'Soal Kompetensi Bidang',
			);
		}
		echo json_encode($alldata);
	}
	public function getFirstSoal(Request $request) {
		$idne		= $request->input('val01');
        $homebase	= url("/");
		$hasil		= Banksoal::where('id', $idne)->first();
		if (isset($hasil->id)){
			return response()->json([
				'idsoal' 	=> $hasil->id,
				'deskripsi'	=> $hasil->deskripsi,
				'alasan'	=> $hasil->deskripsitambahan,
				'kode'		=> $hasil->kode,
				'ceel'		=> $hasil->ceel,
				'aktif'		=> $hasil->active,
				'dosen'		=> $hasil->inputor,
				'tipesoal'	=> $hasil->jawaban,
				'view'		=> $hasil->view,
				'tahun'		=> $hasil->created_at->year,
				'lampiran'	=> $hasil->lampiran,
				'lampiran2'	=> $hasil->lampiran2,
				'lampiran3'	=> $hasil->lampiran3,
				'lampiran4'	=> $hasil->lampiran4,
				'lampiran5'	=> $hasil->lampiran5,
				'lampiran6'	=> $hasil->lampiran6,
				'fullkode'	=> $hasil->fullkode,
				'nilai01'	=> $hasil->nilai01,
				'opsia'		=> $hasil->opsia,
				'opsib'		=> $hasil->opsib,
				'opsic'		=> $hasil->opsic,
				'opsid'		=> $hasil->opsid,
				'opsie'		=> $hasil->opsie,
				'kunci'		=> $hasil->kunci,
			]);
		}
		return back();
	}
	public function getFirstDataUjian(Request $request) {
		$idne		= $request->input('val01');
		$tabel		= $request->input('val02');
        $homebase	= url("/");
		if ($tabel == 'banksoal'){
			$hasil		= Banksoal::where('id', $idne)->first();
			if (isset($hasil->id)){
				return response()->json([
					'deskripsi'	=> $hasil->deskripsi,
					'lampiran'	=> $hasil->lampiran,
					'lampiran2'	=> $hasil->lampiran2,
					'lampiran3'	=> $hasil->lampiran3,
					'lampiran4'	=> $hasil->lampiran4,
					'lampiran5'	=> $hasil->lampiran5,
					'lampiran6'	=> $hasil->lampiran6,
					'jenissoal'	=> $hasil->jawaban,
					'opsia'		=> $hasil->opsia,
					'opsib'		=> $hasil->opsib,
					'opsic'		=> $hasil->opsic,
					'opsid'		=> $hasil->opsid,
					'opsie'		=> $hasil->opsie,
				]);
			}
		} else {
			$hasil		= Banksoalujian::where('id', $idne)->first();
			if (isset($hasil->id)){
				$idne 		= $hasil->idsoal;
				$jawaban 	= $hasil->jawaban;
				$opsia 		= $hasil->opsia;
				$opsib 		= $hasil->opsib;
				$opsic 		= $hasil->opsic;
				$opsid 		= $hasil->opsid;
				$opsie 		= $hasil->opsie;
				$deskripsi 	= $hasil->deskripsi;
				$tipesoal 	= $hasil->tipesoal;
				$lampiran 	= $hasil->lampiran;
				$lampiran2 	= $hasil->lampiran2;
				$lampiran3 	= $hasil->lampiran3;
				$lampiran4 	= $hasil->lampiran4;
				$lampiran5 	= $hasil->lampiran5;
				$lampiran6 	= $hasil->lampiran6;
				if ($deskripsi == '' OR is_null($deskripsi)){
					$getsoal = Banksoal::where('id', $hasil->idsoal)->first();
					if (isset($getsoal->id)){
						$tipesoal 	= $getsoal->jawaban;
						$opsia 		= $getsoal->opsia;
						$opsib 		= $getsoal->opsib;
						$opsic 		= $getsoal->opsic;
						$opsid 		= $getsoal->opsid;
						$opsie 		= $getsoal->opsie;
						$deskripsi 	= $getsoal->deskripsi;
						$lampiran 	= $getsoal->lampiran;
						$lampiran2 	= $getsoal->lampiran2;
						$lampiran3 	= $getsoal->lampiran3;
						$lampiran4 	= $getsoal->lampiran4;
						$lampiran5 	= $getsoal->lampiran5;
						$lampiran6 	= $getsoal->lampiran6;
						Banksoalujian::where('id', $idne)->update([
							'fullkode'	=> $getsoal->fullkode,
							'tipesoal'	=> $tipesoal,
							'opsia'		=> $opsia,
							'opsib'		=> $opsib,
							'opsic'		=> $opsic,
							'opsid'		=> $opsid,
							'opsie'		=> $opsie,
							'deskripsi'	=> $deskripsi,
							'lampiran'	=> $lampiran,
							'lampiran2'	=> $lampiran2,
							'lampiran3'	=> $lampiran3,
							'lampiran4'	=> $lampiran4,
							'lampiran5'	=> $lampiran5,
							'lampiran6'	=> $lampiran6,
						]);
					}
				}
				if ($tipesoal == 'esay'){
					$opsia	= $jawaban;
					$opsib	= '';
					$opsic 	= '';
					$opsid 	= '';
					$opsie	= '';
				} else {
					if ($jawaban == 'A'){ $opsia = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsia.'</div></div>'; }
					if ($jawaban == 'B'){ $opsib = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsib.'</div></div>'; }
					if ($jawaban == 'C'){ $opsic = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsic.'</div></div>'; }
					if ($jawaban == 'D'){ $opsid = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsid.'</div></div>'; }
					if ($jawaban == 'E'){ $opsie = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'.$opsie.'</div></div>'; }
				}
				return response()->json([
					'deskripsi'	=> $deskripsi,
					'lampiran'	=> $lampiran,
					'lampiran2'	=> $lampiran2,
					'lampiran3'	=> $lampiran3,
					'lampiran4'	=> $lampiran4,
					'lampiran5'	=> $lampiran5,
					'lampiran6'	=> $lampiran6,
					'jenissoal'	=> $tipesoal,
					'opsia'		=> $opsia,
					'opsib'		=> $opsib,
					'opsic'		=> $opsic,
					'opsid'		=> $opsid,
					'opsie'		=> $opsie,
				]);
			}
		}
		
		return back();
	}
	public function exAddtoTXT (Request $request) {
        $tabel 		= '';
		$marking	= $request->input('set01');
        $jenis	    = $request->input('set02');
		$homebase	= url("/");
		$data		= [];
		$i			= 0;
		$dilarang 	= array("<p>","</p>","<br />","<br>");
		if ($jenis == 'moodle'){
			$judul 		= '';
            $jjadwal 	= Banksoaltest::where('tipesoal', 'choice')->where('marking', $marking)->orderBy('id', 'DESC')->get();   
            if (!empty($jjadwal)){
                foreach ($jjadwal as $rmaster1){
                    $judul		= $rmaster1->namaujian;
					$lampiran	= $rmaster1->lampiran;
                    $lampiran2	= $rmaster1->lampiran2;
                    $lampiran3	= $rmaster1->lampiran3;
                    $lampiran4	= $rmaster1->lampiran4;
                    $lampiran5	= $rmaster1->lampiran5;
                    $lampiran6	= $rmaster1->lampiran6;
                    if ($lampiran == null){ $lampiran = ''; }
                    if ($lampiran2 == null){ $lampiran2 = ''; }
                    if ($lampiran3 == null){ $lampiran3 = ''; }
                    if ($lampiran4 == null){ $lampiran4 = ''; }
                    if ($lampiran5 == null){ $lampiran5 = ''; }
                    if ($lampiran6 == null){ $lampiran6 = ''; }
                    $data['tabel'][$i]['kode'] 	= $rmaster1->fullkode;
                    $data['tabel'][$i]['soal'] 	= str_replace($dilarang, "", $rmaster1->deskripsi);
                    $data['tabel'][$i]['opsia'] = str_replace($dilarang, "", $rmaster1->opsia);
                    $data['tabel'][$i]['opsib'] = str_replace($dilarang, "", $rmaster1->opsib);
                    $data['tabel'][$i]['opsic'] = str_replace($dilarang, "", $rmaster1->opsic);
                    $data['tabel'][$i]['opsid'] = str_replace($dilarang, "", $rmaster1->opsid);
                    $data['tabel'][$i]['opsie'] = str_replace($dilarang, "", $rmaster1->opsie);
                    $data['tabel'][$i]['kunci'] = $rmaster1->kunci;
                    $gambar     = '';
                    if ($lampiran != '' AND file_exists(public_path($lampiran))){
                        $gambar = $gambar.'<img src="'.$homebase.'/'.$lampiran.'" /><br />';
                    }
                    if ($lampiran2 != '' AND file_exists(public_path($lampiran2))){
                        $gambar = $gambar.'<img src="'.$homebase.'/'.$lampiran2.'" /><br />';
                    }
                    if ($lampiran3 != '' AND file_exists(public_path($lampiran3))){
                        $gambar = $gambar.'<img src="'.$homebase.'/'.$lampiran3.'" /><br />';
                    }
                    if ($lampiran4 != '' AND file_exists(public_path($lampiran4))){
                        $gambar = $gambar.'<img src="'.$homebase.'/'.$lampiran4.'" /><br />';
                    }
                    if ($lampiran5 != '' AND file_exists(public_path($lampiran5))){
                        $gambar = $gambar.'<img src="'.$homebase.'/'.$lampiran5.'" /><br />';
                    }
                    if ($lampiran6 != '' AND file_exists(public_path($lampiran6))){
                        $gambar = $gambar.'<img src="'.$homebase.'/'.$lampiran6.'" /><br />';
                    }
                    $data['tabel'][$i]['gambar'] = $gambar;
                    $i++;
                }
            }
			$data['jenis'] = $jenis;
			$data['judul'] = $judul;
            return view('cetak.soal', $data);
        } else if ($jenis == 'koreksimanual'){
            $cekpeserta = Datanilai::where('id', $marking)->first();
            if (isset($cekpeserta->id)){
                $nomor      = 1;
                $judul      = '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="40%"><strong>Nama Ujian</strong></td><td width="10%"><strong>:</strong></td><td width="50%" align="left"><strong>'.$cekpeserta->namaujian.'</strong></td></tr>';
                $judul      = $judul.'<tr><td width="40%"><strong>Tanggal</strong></td><td width="10%"><strong>:</strong></td><td width="50%" align="left"><strong>'.$cekpeserta->tanggal.'</strong></td></tr>';
                $judul      = $judul.'<tr><td width="40%"><strong>Nama</strong></td><td width="10%"><strong>:</strong></td><td width="50%" align="left"><strong>'.$cekpeserta->name.'</strong></td></tr>';
                $judul      = $judul.'<tr><td width="40%"><strong>Email</strong></td><td width="10%"><strong>:</strong></td><td width="50%" align="left"><strong>'.$cekpeserta->email.'</strong></td></tr>';
                $cekceel	= Banksoalujian::where('nomorpeserta', $cekpeserta->noinduk)->where('marking', $cekpeserta->marking)->groupBy('ceel')->get();
                if (!empty($cekceel)){
                    foreach($cekceel as $rceel){
                        if ($tabel == ''){
                            $tabel  = '<table border="1" cellpadding="0" cellspacing="0" width="100%"><thead><tr><th colspan="3" align="left">'.$judul;
                            $tabel  = $tabel.'<tr><td width="40%"><strong>Category</strong></td><td width="10%"><strong>:</strong></td><td width="50%" align="left"><strong>'.$rceel->ceel.'</strong></td></tr></table>';
                            $tabel  = $tabel.'</th></tr></thead><tbody>';
                        } else {
                            $tabel  = $tabel.'</tbody></table><div style="page-break-before: always"></div><table border="1" cellpadding="0" cellspacing="0" width="100%"><thead><tr><th colspan="3" align="left">'.$judul;
                            $tabel  = $tabel.'<tr><td width="40%"><strong>Category</strong></td><td width="10%"><strong>:</strong></td><td width="50%" align="left"><strong>'.$rceel->ceel.'</strong></td></tr></table>';
                            $tabel  = $tabel.'</th></tr></thead><tbody>';
                        }
                        $tabel      = $tabel.'<tr><td width="10%" align="center" valign"top"><strong>NO</strong></td><td width="45%" align="center"  valign"top"><strong>Case Description</strong></td><td width="45%" align="center" valign"top"><strong>Student Answer</strong></td></tr>';
                        $ggetdataujian	= Banksoalujian::where('nomorpeserta', $cekpeserta->noinduk)->where('marking', $cekpeserta->marking)->where('ceel', $rceel->ceel)->get();
                        foreach($ggetdataujian as $rmaster1){
                            $lampiran	= $rmaster1->lampiran;
                            $lampiran2	= $rmaster1->lampiran2;
                            $lampiran3	= $rmaster1->lampiran3;
                            $lampiran4	= $rmaster1->lampiran4;
                            $lampiran5	= $rmaster1->lampiran5;
                            $lampiran6	= $rmaster1->lampiran6;
                            $deskripsi  = str_replace($dilarang, "", $rmaster1->deskripsi);
                            if ($lampiran == null){ $lampiran = ''; }
                            if ($lampiran2 == null){ $lampiran2 = ''; }
                            if ($lampiran3 == null){ $lampiran3 = ''; }
                            if ($lampiran4 == null){ $lampiran4 = ''; }
                            if ($lampiran5 == null){ $lampiran5 = ''; }
                            if ($lampiran6 == null){ $lampiran6 = ''; }
                            if ($lampiran != '' AND file_exists(public_path($lampiran))){
                                $lampiran = '<a href="'.$homebase.'/'.$lampiran.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran.'" /></a>';
                            }
                            if ($lampiran2 != '' AND file_exists(public_path($lampiran2))){
                                $lampiran2 = '<a href="'.$homebase.'/'.$lampiran2.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran2.'" /></a>';
                            }
                            if ($lampiran3 != '' AND file_exists(public_path($lampiran3))){
                                $lampiran3 = '<a href="'.$homebase.'/'.$lampiran3.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran3.'" /></a>';
                            }
                            if ($lampiran4 != '' AND file_exists(public_path($lampiran4))){
                                $lampiran4 = '<a href="'.$homebase.'/'.$lampiran4.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran4.'" /></a>';
                            }
                            if ($lampiran5 != '' AND file_exists(public_path($lampiran5))){
                                $lampiran5 = '<a href="'.$homebase.'/'.$lampiran5.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran5.'" /></a>';
                            }
                            if ($lampiran6 != '' AND file_exists(public_path($lampiran6))){
                                $lampiran6 = '<a href="'.$homebase.'/'.$lampiran6.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran6.'" /></a>';
                            }
                            $deskripsi = '<table border="0" cellpadding="0" cellspacing="0"><tr><td>'.$lampiran.'</td><td>'.$lampiran2.'</td><td>'.$lampiran3.'</td><td>'.$lampiran4.'</td><td>'.$lampiran5.'</td><td>'.$lampiran6.'</td></tr><tr><td colspan="6">'.$deskripsi.'</td></tr><tr><td colspan="6">';
                            if ($rmaster1->tipesoal == 'Labelled Case'){
                                $deskripsi = $deskripsi.'<strong>Labelled Question</strong><br />
                                                            <ol>
                                                                <li>'.$rmaster1->opsia.'</li>
                                                                <li>'.$rmaster1->opsib.'</li>
                                                                <li>'.$rmaster1->opsic.'</li>
                                                                <li>'.$rmaster1->opsid.'</li>
                                                                <li>'.$rmaster1->opsie.'</li>
                                                                <li>'.$rmaster1->opsif.'</li>
                                                                <li>'.$rmaster1->opsig.'</li>
                                                                <li>'.$rmaster1->opsih.'</li>
                                                                <li>'.$rmaster1->opsii.'</li>
                                                                <li>'.$rmaster1->opsij.'</li>
                                                                <li>'.$rmaster1->opsik.'</li>
                                                                <li>'.$rmaster1->opsil.'</li>
                                                                <li>'.$rmaster1->opsim.'</li>
                                                                <li>'.$rmaster1->opsin.'</li>
                                                                <li>'.$rmaster1->opsio.'</li>
                                                                <li>'.$rmaster1->opsip.'</li>
                                                                <li>'.$rmaster1->opsiq.'</li>
                                                                <li>'.$rmaster1->opsir.'</li>
                                                                <li>'.$rmaster1->opsis.'</li>
                                                                <li>'.$rmaster1->opsit.'</li>
                                                            </ol>
                                            </td></tr>';
                            } else if ($rmaster1->tipesoal == 'esay'){
                                $deskripsi = $deskripsi.'<strong>Esai Question</strong><br /><strong><font color="blue">Keys : '.$rmaster1->opsia.'</font></strong></td></tr>';
                            } else if ($rmaster1->tipesoal == 'Multi Essay Case'){
                                $deskripsi = $deskripsi.'<strong>Multi Essay Question</strong><br />
                                    <ol>
                                        <li>'.$rmaster1->opsia.' skore ( '.$rmaster1->opsik.' )</li>
                                        <li>'.$rmaster1->opsib.' skore ( '.$rmaster1->opsil.' )</li>
                                        <li>'.$rmaster1->opsic.' skore ( '.$rmaster1->opsim.' )</li>
                                        <li>'.$rmaster1->opsid.' skore ( '.$rmaster1->opsin.' )</li>
                                        <li>'.$rmaster1->opsie.' skore ( '.$rmaster1->opsio.' )</li>
                                        <li>'.$rmaster1->opsif.' skore ( '.$rmaster1->opsip.' )</li>
                                        <li>'.$rmaster1->opsig.' skore ( '.$rmaster1->opsiq.' )</li>
                                        <li>'.$rmaster1->opsih.' skore ( '.$rmaster1->opsir.' )</li>
                                        <li>'.$rmaster1->opsii.' skore ( '.$rmaster1->opsis.' )</li>
                                        <li>'.$rmaster1->opsij.' skore ( '.$rmaster1->opsit.' )</li>
                                    </ol>
                                    </td></tr>';
                            } else if ($rmaster1->tipesoal == 'Yes No Question'){
                                $deskripsi = $deskripsi.'<strong>Yes No Question</strong><br /><strong><font color="blue">Keys : '.$rmaster1->opsia.'</font></strong></td></tr>';
                            } else {
                                $deskripsi = $deskripsi.'<table border="0" width="100%"><tr><td width="10%"><strong>A</strong></td><td  width="40%">'.$rmaster1->opsia.'</td><td width="10%"><strong>B</strong></td><td  width="40%">'.$rmaster1->opsib.'</td></tr><tr><td><strong>C</strong></td><td>'.$rmaster1->opsic.'</td><td><strong>D</strong></td><td>'.$rmaster1->opsid.'</td></tr><tr><td><strong>E</strong></td><td>'.$rmaster1->opsie.'</td><td colspan="2" aligg="center"><strong><font color="blue">Keys : '.$rmaster1->kunci.'</font></strong></td></tr></table></td></tr>';
                            }
                            $deskripsi = $deskripsi.'</table>';
                            if ($rmaster1->skore == '' OR $rmaster1->skore == '0' OR $rmaster1->skore == '0.00' OR $rmaster1->skore == null){
                                $skore = '';
                            } else { $skore = $rmaster1->skore; }
                            $tabel     = $tabel.'<tr><td width="10%" align="center" valign"top" rowspan="2"><strong>'.$nomor.'</strong></td><td width="45%" valign"top" rowspan="2">'.$deskripsi.'</td><td width="45%" valign"top">'.$rmaster1->jawaban.'</td></tr><tr><td><strong>Score</strong>: '.$skore.'</td></tr>';
                            $nomor++;
                        }
                    }
                }
                if ($tabel != ''){ $tabel = $tabel.'</tbody></table>'; }
            }
            echo $tabel;
        } else {
			$judul 		= '';
            $nomor      = 1;
            $tabel      = '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table"><thead><tr><th align="center" width="10%"><strong>NO</strong></th><th align="center" colspan="5"  width="90%"><strong>DESKRIPTION</strong></th></tr></thead><tbody>';
            $jjadwal 	= Banksoaltest::where('marking', $marking)->orderBy('id', 'DESC')->get();   
            if (!empty($jjadwal)){
                foreach ($jjadwal as $rmaster1){
					$judul		= $rmaster1->namaujian;
                    $lampiran	= $rmaster1->lampiran;
                    $lampiran2	= $rmaster1->lampiran2;
                    $lampiran3	= $rmaster1->lampiran3;
                    $lampiran4	= $rmaster1->lampiran4;
                    $lampiran5	= $rmaster1->lampiran5;
                    $lampiran6	= $rmaster1->lampiran6;
                    $deskripsi  = str_replace($dilarang, "", $rmaster1->deskripsi);
                    if ($lampiran == null){ $lampiran = ''; }
                    if ($lampiran2 == null){ $lampiran2 = ''; }
                    if ($lampiran3 == null){ $lampiran3 = ''; }
                    if ($lampiran4 == null){ $lampiran4 = ''; }
                    if ($lampiran5 == null){ $lampiran5 = ''; }
                    if ($lampiran6 == null){ $lampiran6 = ''; }
					$gambar = 0;
					$linkgbr= '';
                    if ($lampiran != '' AND file_exists(public_path($lampiran))){
                        $linkgbr = $linkgbr.'<a href="'.$homebase.'/'.$lampiran.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran.'" /></a>';
						$gambar++;
                    }
                    if ($lampiran2 != '' AND file_exists(public_path($lampiran2))){
                        $linkgbr = $linkgbr.'<a href="'.$homebase.'/'.$lampiran2.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran2.'" /></a>';
						$gambar++;
                    }
                    if ($lampiran3 != '' AND file_exists(public_path($lampiran3))){
                        $linkgbr = $linkgbr.'<a href="'.$homebase.'/'.$lampiran3.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran3.'" /></a>';
						$gambar++;
                    }
                    if ($lampiran4 != '' AND file_exists(public_path($lampiran4))){
                        $linkgbr = $linkgbr.'<a href="'.$homebase.'/'.$lampiran4.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran4.'" /></a>';
						$gambar++;
                    }
                    if ($lampiran5 != '' AND file_exists(public_path($lampiran5))){
                        $linkgbr = $linkgbr.'<a href="'.$homebase.'/'.$lampiran5.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran5.'" /></a>';
						$gambar++;
                    }
                    if ($lampiran6 != '' AND file_exists(public_path($lampiran6))){
                        $linkgbr = $linkgbr.'<a href="'.$homebase.'/'.$lampiran6.'" target="_blank"><img width="50" height="50" src="'.$homebase.'/'.$lampiran6.'" /></a>';
						$gambar++;
                    }
					
					$bentukjawaban = '';
                    if ($rmaster1->tipesoal == 'Labelled Case'){
                        if ($jenis == 'standartkey'){
                            $bentukjawaban = '<strong>Labelled Question</strong><br />
                            <ol type="a">
                                <li>'.$rmaster1->opsia.'</li>
                                <li>'.$rmaster1->opsib.'</li>
                                <li>'.$rmaster1->opsic.'</li>
                                <li>'.$rmaster1->opsid.'</li>
                                <li>'.$rmaster1->opsie.'</li>
                                <li>'.$rmaster1->opsif.'</li>
                                <li>'.$rmaster1->opsig.'</li>
                                <li>'.$rmaster1->opsih.'</li>
                                <li>'.$rmaster1->opsii.'</li>
                                <li>'.$rmaster1->opsij.'</li>
                                <li>'.$rmaster1->opsik.'</li>
                                <li>'.$rmaster1->opsil.'</li>
                                <li>'.$rmaster1->opsim.'</li>
                                <li>'.$rmaster1->opsin.'</li>
                                <li>'.$rmaster1->opsio.'</li>
                                <li>'.$rmaster1->opsip.'</li>
                                <li>'.$rmaster1->opsiq.'</li>
                                <li>'.$rmaster1->opsir.'</li>
                                <li>'.$rmaster1->opsis.'</li>
                                <li>'.$rmaster1->opsit.'</li>
                            </ol>';
                        } else {
                            $bentukjawaban = '<strong>Labelled Question</strong><br />
                            <ol type="a">
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                                <li>........</li>
                            </ol>';
                        }
                    } else if ($rmaster1->tipesoal == 'esay'){
                        if ($jenis == 'standartkey'){
                            $bentukjawaban = '<strong>Esai Question</strong><br /><strong><font color="blue">Keys : '.$rmaster1->opsia.'</font></strong>';
                        } else {
                            $bentukjawaban = '<strong>Esai Question</strong>';
                        }
                    } else if ($rmaster1->tipesoal == 'Multi Essay Case'){
                        if ($jenis == 'standartkey'){
                            $bentukjawaban = '<strong>Multi Essay Question</strong><br />
                            <ol type="a">
                                <li>'.$rmaster1->opsia.' skore ( '.$rmaster1->opsik.' )</li>
                                <li>'.$rmaster1->opsib.' skore ( '.$rmaster1->opsil.' )</li>
                                <li>'.$rmaster1->opsic.' skore ( '.$rmaster1->opsim.' )</li>
                                <li>'.$rmaster1->opsid.' skore ( '.$rmaster1->opsin.' )</li>
                                <li>'.$rmaster1->opsie.' skore ( '.$rmaster1->opsio.' )</li>
                                <li>'.$rmaster1->opsif.' skore ( '.$rmaster1->opsip.' )</li>
                                <li>'.$rmaster1->opsig.' skore ( '.$rmaster1->opsiq.' )</li>
                                <li>'.$rmaster1->opsih.' skore ( '.$rmaster1->opsir.' )</li>
                                <li>'.$rmaster1->opsii.' skore ( '.$rmaster1->opsis.' )</li>
                                <li>'.$rmaster1->opsij.' skore ( '.$rmaster1->opsit.' )</li>
                            </ol>';
                        } else {
                            $bentukjawaban = '<strong>Multi Essay Question</strong><br />
                            <ol type="a">
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                                <li>..........</li>
                            </ol>';
                        }
                    } else if ($rmaster1->tipesoal == 'Yes No Question'){
                        if ($jenis == 'standartkey'){
                            $bentukjawaban = '<strong>Yes No Question</strong><br /><strong><font color="blue">Keys : '.$rmaster1->opsia.'</font></strong>';
                        } else {
                            $bentukjawaban = '<strong>Yes No Question</strong>';
                        }
                    } else {
						$bentukjawaban = 'MCQ';
                    }
					if ($bentukjawaban == 'MCQ'){
						if ($gambar == 0){
							$tabel 	= $tabel.'<tr><td align="center" valign="top" rowspan="4">'.$nomor.'</td><td valign="top" colspan="5">'.$deskripsi.'</td></tr>';
						}else {
							$tabel 	= $tabel.'<tr><td align="center" valign="top" rowspan="5">'.$nomor.'</td><td valign="top" colspan="5">'.$deskripsi.'</td></tr>';
							$tabel 	= $tabel.'<tr><td valign="top" colspan="5">'.$linkgbr.'</td></tr>';
						}
						if ($jenis == 'standartkey'){
                            $tabel 	= $tabel.'<tr>
											<td width="5%"><strong>a.</strong></td>
											<td width="40%">'.$rmaster1->opsia.'</td>
											<td width="5%">&nbsp;</td>
											<td width="5%"><strong>b.</strong></td>
											<td width="40%">'.$rmaster1->opsib.'</td>
										</tr>
										<tr>
											<td><strong>c.</strong></td>
											<td>'.$rmaster1->opsic.'</td>
											<td>&nbsp;</td>
											<td><strong>d.</strong></td>
											<td>'.$rmaster1->opsid.'</td>
										</tr>
										<tr>
											<td><strong>e.</strong></td>
											<td>'.$rmaster1->opsie.'</td>
											<td>&nbsp;</td>
											<td colspan="2" align="center"><strong><font color="blue">Keys : '.$rmaster1->kunci.'</font></strong></td>
										</tr>';
                        } else {
                            $tabel 	= $tabel.'<tr>
											<td width="10%"><strong>a.</strong></td>
											<td width="35%">'.$rmaster1->opsia.'</td>
											<td>&nbsp;</td>
											<td width="10%"><strong>b.</strong></td>
											<td width="35%">'.$rmaster1->opsib.'</td>
										</tr>
										<tr>
											<td><strong>c.</strong></td>
											<td>'.$rmaster1->opsic.'</td>
											<td>&nbsp;</td>
											<td><strong>d.</strong></td>
											<td>'.$rmaster1->opsid.'</td>
										</tr>
										<tr>
											<td><strong>e.</strong></td>
											<td>'.$rmaster1->opsie.'</td>
											<td>&nbsp;</td>
											<td colspan="2" align="center">&nbsp;</td>
										</tr>';
                        }
					} else {
						if ($gambar == 0){
							$tabel 	= $tabel.'<tr><td align="center" valign="top" rowspan="2">'.$nomor.'</td><td valign="top" colspan="5">'.$deskripsi.'</td></tr>';
						}else {
							$tabel 	= $tabel.'<tr><td align="center" valign="top" rowspan="3">'.$nomor.'</td><td valign="top" colspan="5">'.$deskripsi.'</td></tr>';
							$tabel 	= $tabel.'<tr><td valign="top" colspan="5">'.$linkgbr.'</td></tr>';
						}
						$tabel 	= $tabel.'<tr><td valign="top" colspan="5">'.$bentukjawaban.'</td></tr>';
					}
					$nomor++;
                }
            }
            $tabel      = $tabel.'</tbody></table>';
            echo $tabel;
        }
    }
	public function exCeksoalkembar(Request $request) {
		$tabel 		= '';
		$homebase	= url("/");
		$dilarang 	= array("<p>","</p>","<br />", ",", "?", "!");
		$marking	= Session('id').time();
		$soale		= $request->input('set01');
		$soale 	    = str_replace($dilarang, "", $soale);
		$arrsoal	= explode(" ", $soale);
		if (isset($arrsoal[5])){
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			$kata03			= $arrsoal[2];
			$kata04			= $arrsoal[3];
			$kata05			= $arrsoal[4];
			$kata06			= $arrsoal[5];
			$kombinasi01	= $kata01.' '.$kata02.' '.$kata03.' '.$kata04;
			$kombinasi02	= $kata02.' '.$kata03.' '.$kata04.' '.$kata05;
			$kombinasi03	= $kata03.' '.$kata04.' '.$kata05.' '.$kata06;

		} else if (isset($arrsoal[4])){
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			$kata03			= $arrsoal[2];
			$kata04			= $arrsoal[3];
			$kata05			= $arrsoal[4];
			$kombinasi01	= $kata01.' '.$kata02.' '.$kata03;
			$kombinasi02	= $kata02.' '.$kata03.' '.$kata04;
			$kombinasi03	= $kata03.' '.$kata04.' '.$kata05;
		} else if (isset($arrsoal[3])){
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			$kata03			= $arrsoal[2];
			$kata04			= $arrsoal[3];
			$kombinasi01	= $kata01.' '.$kata02;
			$kombinasi02	= $kata02.' '.$kata03;
			$kombinasi03	= $kata03.' '.$kata04;
		} else {
			$kata01			= $arrsoal[0];
			$kata02			= $arrsoal[1];
			if (isset($arrsoal[2])){
				$kata03			= $arrsoal[2];
				$kombinasi01	= $kata01.' '.$kata02;
				$kombinasi02	= $kata02.' '.$kata03;
				$kombinasi03	= $kata03;		
			} else {
				$kombinasi01	= $kata01.' '.$kata02;
				$kombinasi02	= $kata01;
				$kombinasi03	= $kata02;
			}
		}
		$ceksql1	= Banksoal::where('view', '!=', '0')->where('deskripsi', 'LIKE', '%'.$kombinasi01.'%')->get();
		if (!empty($ceksql1)){
			foreach ($ceksql1 as $getdata){
				Banksoalaktif::create([
					'kode'					=> $getdata->kode,
					'ceel'					=> $getdata->ceel,
					'deskripsi'				=> $getdata->deskripsi,
					'deskripsitambahan'		=> $getdata->deskripsitambahan,
					'lampiran'				=> $getdata->lampiran,
					'jawaban'				=> $getdata->jawaban,
					'opsia' 				=> $getdata->opsia,
					'opsib' 				=> $getdata->opsib,
					'opsic' 				=> $getdata->opsic,
					'opsid' 				=> $getdata->opsid,
					'opsie' 				=> $getdata->opsie,
					'kunci' 				=> $getdata->kunci,
					'active'				=> $getdata->id,
					'inputor'				=> $getdata->inputor,
					'view'					=> 1,
					'created_by'			=> $marking
				]);
			}
		}
		$ceksql2	= Banksoal::where('view', '!=', '0')->where('deskripsi', 'LIKE', '%'.$kombinasi02.'%')->get();
		if (!empty($ceksql2)){
			foreach ($ceksql2 as $getdata){
				Banksoalaktif::create([
					'kode'					=> $getdata->kode,
					'ceel'					=> $getdata->ceel,
					'deskripsi'				=> $getdata->deskripsi,
					'deskripsitambahan'		=> $getdata->deskripsitambahan,
					'lampiran'				=> $getdata->lampiran,
					'jawaban'				=> $getdata->jawaban,
					'opsia' 				=> $getdata->opsia,
					'opsib' 				=> $getdata->opsib,
					'opsic' 				=> $getdata->opsic,
					'opsid' 				=> $getdata->opsid,
					'opsie' 				=> $getdata->opsie,
					'kunci' 				=> $getdata->kunci,
					'active'				=> $getdata->id,
					'inputor'				=> $getdata->inputor,
					'view'					=> 1,
					'created_by'			=> $marking
				]);
			}
		}
		$ceksql3	= Banksoal::where('view', '!=', '0')->where('deskripsi', 'LIKE', '%'.$kombinasi03.'%')->get();
		if (!empty($ceksql3)){
			foreach ($ceksql3 as $getdata){
				Banksoalaktif::create([
					'kode'					=> $getdata->kode,
					'ceel'					=> $getdata->ceel,
					'deskripsi'				=> $getdata->deskripsi,
					'deskripsitambahan'		=> $getdata->deskripsitambahan,
					'lampiran'				=> $getdata->lampiran,
					'jawaban'				=> $getdata->jawaban,
					'opsia' 				=> $getdata->opsia,
					'opsib' 				=> $getdata->opsib,
					'opsic' 				=> $getdata->opsic,
					'opsid' 				=> $getdata->opsid,
					'opsie' 				=> $getdata->opsie,
					'kunci' 				=> $getdata->kunci,
					'active'				=> $getdata->id,
					'inputor'				=> $getdata->inputor,
					'view'					=> 1,
					'created_by'			=> $marking
				]);
			}
		}
		$rekap 	= Banksoalaktif::where('created_by',$marking)->select('id', 'active', 'kode', 'ceel', 'deskripsi', 'inputor', 'opsia', 'opsib', 'opsic', 'opsid', 'opsie', 'kunci', DB::Raw('COUNT(active) as jumlah'))->groupBy('active')->orderBy('jumlah', 'DESC')->get();
		$tabel	= '';
		$i		= 1;
		if (!empty($rekap)){
			$tabel = '<table border="1" cellpadding="1" cellspacing="1"><tr><th align="center">NO</th><th align="center">CODE</th><th align="center">Category</th><th align="center">DESCRIPTION</th><th align="center">CONTRIBUTOR</th><th align="center">COUNT</th></tr>';
			foreach ($rekap as $hasil){
				$opsia		= $hasil->opsia;
				$opsib		= $hasil->opsib;
				$opsic		= $hasil->opsic;
				$opsid		= $hasil->opsid;
				$opsie		= $hasil->opsie;
				$kunci		= $hasil->kunci;
				$kunci 		= preg_replace('/\s+/', '', $kunci);
				$showjawab	= '<table border="0"><tr><td>A</td><td>'.$opsia.'</td></tr><tr><td>B</td><td>'.$opsib.'</td></tr><tr><td>C</td><td>'.$opsic.'</td></tr><tr><td>D</td><td>'.$opsid.'</td></tr><tr><td>E</td><td>'.$opsie.'</td></tr><tr><td>Keys:</td><td>'.$kunci.'</td></tr></table>';
				$tabel = $tabel.'
					<tr>
						<td align="center">'.$i.'</td>
						<td align="center">'.$hasil->kode.'</td>
						<td align="center">'.$hasil->ceel.'</td>
						<td align="left">'.$hasil->deskripsi.'<br />'.$showjawab.'</td>
						<td align="center">'.$hasil->inputor.'</td>
						<td align="center">'.$hasil->jumlah.'</td>
					</tr>
				';
				$i++;
			}
			$tabel = $tabel.'</table>';
		}
		Banksoalaktif::where('created_by',$marking)->delete();
		echo $tabel;
	}
	public function exAddTest(Request $request) {
		$idne   	= $request->input('val07');
       	$homebase	= url("/");
		$keterangan	= '';
		$idsoal		= 0;
		if ($idne == 'hapus'){
			$idne		= $request->input('val01');
			$update 	= Banksoaltest::where('id', $idne)->update([
				'status'		=> 0,
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Non Akifkan']);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Down, Silahkan Ulangi Beberapa Saat Lagi']);
				return back();
			}
		} else if ($idne == 'new'){
			$nama   		= $request->input('val01');
			$dmulai   		= $request->input('val02');
			$tmulai   		= $request->input('val03');
			$dselesai   	= $request->input('val04');
			$tselesai   	= $request->input('val05');
			$status   		= $request->input('val06');
			$arridsoal		= $request->input('lists');
			$timer   		= $request->input('val08');
			$kodesekolah   	= $request->input('val09');
			$idkd  			= $request->input('val10');
			$deskripsi  	= $request->input('val11');
			$matapelajaran  = $request->input('val12');
			$komponen  		= $request->input('val13');
			$kode  			= $request->input('val14');
			$idsetting  	= $request->input('val15');
			if ($nama == '' OR $dmulai == '' OR $tmulai == '' OR $dselesai == '' OR $tselesai == '' OR $status == '' OR $timer == '' OR $idsetting == '' OR $idkd == ''){
				return response()->json(['marking' => 'new', 'icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Periksa isian Bapak/Ibu Pastikan semua data terisi)']);
				return back();
			} else {
				$arraymulai		= explode(" ", $tmulai);
				if (isset($arraymulai[1])){
					$jmulai 		= $arraymulai[0];
					$cmulai 		= $arraymulai[1];
					$arrayjmulai	= explode(":", $jmulai);
					$hhmulai		= (int)$arrayjmulai[0];
					$mmmulai		= $arrayjmulai[1];
					if ($cmulai == 'AM'){
						if ($hhmulai < 10){
							$mulai 	= $dmulai.' 0'.$hhmulai.':'.$mmmulai.':00';
						} else {
							$mulai 	= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
						}
					} else {
						if ($hhmulai ==  12){
							$hhmulai= 12;
						} else {
							$hhmulai= $hhmulai + 12;
						}
						$mulai 		= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
					}
				} else {
					$mulai 		= $dmulai.' '.$tmulai;
				}
				$arrayselesai	= explode(" ", $tselesai);
				if (isset($arrayselesai[1])){
					$jselesai 		= $arrayselesai[0];
					$cselesai 		= $arrayselesai[1];
					$arrayjselesai	= explode(":", $jselesai);
					$hhselesai		= $arrayjselesai[0];
					$mmselesai		= $arrayjselesai[1];
					if ($cselesai == 'AM'){
						if ($hhselesai < 10){
							$akhir = $dselesai.' 0'.$hhselesai.':'.$mmselesai.':00';
						} else {
							$akhir = $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
						}
					} else {
						if ($hhselesai ==  12){
							$hhselesai 	= 12;
						} else {
							$hhselesai 	= $hhselesai + 12;
						}			
						$akhir 		= $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
					}
				} else {
					$akhir 		= $dselesai.' '.$tselesai;
				}
				$marking		= md5($kodesekolah.'-'.$idsetting.'-'.$nama.'-'.$mulai.'-'.$akhir);
	
				$ceksudah 		= Banksoaltest::where('marking', $marking)->count();
				if ($ceksudah == 0){
					$i 			= 0;
					Banksoaltest::create([
						'tanggal'		=> $dmulai,
						'ceel'			=> $matapelajaran,
						'kode'			=> $komponen,
						'namaujian'		=> $nama,
						'idsupervisor'	=> $idsetting,
						'supervisor'	=> $idkd,
						'tipe'			=> $idsetting,
						'idsoal'		=> 0,
						'status'		=> $status,
						'mulai'			=> $mulai,
						'selesai'		=> $akhir,
						'timer'			=> $timer,
						'marking'		=> $marking,
						'created_by'	=> Session('nip'),
						'id_sekolah'	=> Session('sekolah_id_sekolah')
					]);
					Banksoalujian::where('marking', $marking)->update([
						'status'		=> $status,
						'tanggal'		=> $dmulai,
						'mulai'			=> $mulai,
						'selesai'		=> $akhir,
						'timer'			=> $timer,
					]);
					Datanilai::where('marking', $marking)->update([
						'tanggal'	    => $dmulai,
						'mulai'	        => $mulai,
						'akhir'		    => $akhir,
						'timer'		    => $timer,
						'status'        => $status
					]);
					return response()->json(['marking' => $marking, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Input Sejumlah '.$i.' Soal']);
					return back();
				} else {
					return response()->json(['marking' => $marking, 'icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Nama Ujian Sudah Ada, Mohon Membuat Nama Ujian dengan Nama Yang Unik (Lengkapi dengan Kode, tahun yang unik)']);
					return back();
				}
			}
		} else {
			$nama   		= $request->input('val01');
			$dmulai   		= $request->input('val02');
			$tmulai   		= $request->input('val03');
			$dselesai   	= $request->input('val04');
			$tselesai   	= $request->input('val05');
			$status   		= $request->input('val06');
			$arridsoal		= $request->input('lists');
			$timer   		= $request->input('val08');
			$kodesekolah   	= $request->input('val09');
			$idkd  			= $request->input('val10');
			$deskripsi  	= $request->input('val11');
			$matapelajaran  = $request->input('val12');
			$komponen  		= $request->input('val13');
			$kode  			= $request->input('val14');
			$idsetting  	= $request->input('val15');
			if (is_null($status)){ $status = 1; }
			$arraymulai		= explode(" ", $tmulai);
			if (isset($arraymulai[1])){
				$jmulai 		= $arraymulai[0];
				$cmulai 		= $arraymulai[1];
				$arrayjmulai	= explode(":", $jmulai);
				$hhmulai		= (int)$arrayjmulai[0];
				$mmmulai		= $arrayjmulai[1];
				if ($cmulai == 'AM'){
					if ($hhmulai < 10){
						$mulai 	= $dmulai.' 0'.$hhmulai.':'.$mmmulai.':00';
					} else {
						$mulai 	= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
					}
				} else {
					if ($hhmulai ==  12){
						$hhmulai= 12;
					} else {
						$hhmulai= $hhmulai + 12;
					}
					$mulai 		= $dmulai.' '.$hhmulai.':'.$mmmulai.':00';
				}
			} else {
				$mulai 		= $dmulai.' '.$tmulai;
			}
			$arrayselesai	= explode(" ", $tselesai);
			if (isset($arrayselesai[1])){
				$jselesai 		= $arrayselesai[0];
				$cselesai 		= $arrayselesai[1];
				$arrayjselesai	= explode(":", $jselesai);
				$hhselesai		= $arrayjselesai[0];
				$mmselesai		= $arrayjselesai[1];
				if ($cselesai == 'AM'){
					if ($hhselesai < 10){
						$akhir = $dselesai.' 0'.$hhselesai.':'.$mmselesai.':00';
					} else {
						$akhir = $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
					}
				} else {
					if ($hhselesai ==  12){
						$hhselesai 	= 12;
					} else {
						$hhselesai 	= $hhselesai + 12;
					}			
					$akhir 		= $dselesai.' '.$hhselesai.':'.$mmselesai.':00';
				}
			} else {
				$akhir 		= $dselesai.' '.$tselesai;
			}
			$marking		= md5($kodesekolah.'-'.$idsetting.'-'.$nama.'-'.$mulai.'-'.$akhir);

			if ($request->input('lists') !== null){
				$count	= count($arridsoal);
			} else {
				$count 	= 0;
			}
			if ($count == 0){
				Banksoaltest::where('marking', $idne)->update([
					'tanggal'		=> $dmulai,
					'namaujian'		=> $nama,
					'status'		=> $status,
					'ceel'			=> $matapelajaran,
					'kode'			=> $komponen,
					'idsupervisor'	=> $idsetting,
					'supervisor'	=> $idkd,
					'tipe'			=> $idsetting,
					'pengumuman'	=> 0,
					'mulai'			=> $mulai,
					'selesai'		=> $akhir,
					'timer'			=> $timer,
					'created_by'	=> Session('nip'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
				Banksoalujian::where('marking', $idne)->update([
					'status'		=> $status,
					'tanggal'		=> $dmulai,
					'mulai'			=> $mulai,
					'selesai'		=> $akhir,
					'timer'			=> $timer,
				]);
				Datanilai::where('marking', $idne)->update([
					'tanggal'	    => $dmulai,
					'mulai'	        => $mulai,
					'akhir'		    => $akhir,
					'timer'		    => $timer,
					'status'        => $status
				]);
				return response()->json(['marking' => $idne, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Input']);
				return back();
			} else {
				Banksoaltest::where('marking', $idne)->delete();
				$i 			= 0;
				foreach ($arridsoal as $idsoal){
					$getdata = Banksoal::where('id', $idsoal)->first();
					if (isset($getdata->id)){
						Banksoaltest::create([
							'ceel'			=> $matapelajaran,
							'kode'			=> $komponen,
							'idsupervisor'	=> $idsetting,
							'supervisor'	=> $idkd,
							'tipe'			=> $idsetting,
							'tanggal'		=> $dmulai,
							'namaujian'		=> $nama,
							'idsoal'		=> $idsoal,
							'fullkode'      => $getdata->fullkode,
							'deskripsi'     => $getdata->deskripsi,
							'lampiran'      => $getdata->lampiran,
							'lampiran2'     => $getdata->lampiran2,
							'lampiran3'     => $getdata->lampiran3,
							'lampiran4'     => $getdata->lampiran4,
							'lampiran5'     => $getdata->lampiran5,
							'lampiran6'     => $getdata->lampiran6,
							'tipesoal'      => $getdata->jawaban,
							'opsia'         => $getdata->opsia,
							'opsib'         => $getdata->opsib,
							'opsic'         => $getdata->opsic,
							'opsid'         => $getdata->opsid,
							'opsie'         => $getdata->opsie,
							'opsif'         => $getdata->opsif,
							'opsig'         => $getdata->opsig,
							'opsih'         => $getdata->opsih,
							'opsii'         => $getdata->opsii,
							'opsij'         => $getdata->opsij,
							'opsik'         => $getdata->opsik,
							'opsil'         => $getdata->opsil,
							'opsim'         => $getdata->opsim,
							'opsin'         => $getdata->opsin,
							'opsio'         => $getdata->opsio,
							'opsip'         => $getdata->opsip,
							'opsiq'         => $getdata->opsiq,
							'opsir'         => $getdata->opsir,
							'opsis'         => $getdata->opsis,
							'opsit'         => $getdata->opsit,
							'kunci'         => $getdata->kunci,
							'status'        => $status,
							'pengumuman'    => 0,
							'mulai'			=> $mulai,
							'selesai'		=> $akhir,
							'timer'			=> $timer,
							'marking'       => $marking,
							'created_by'	=> Session('nip'),

						]);
					}
					$i++;
				}
				Banksoalujian::where('marking', $marking)->update([
					'status'		=> $status,
					'tanggal'		=> $dmulai,
					'mulai'			=> $mulai,
					'selesai'		=> $akhir,
					'timer'			=> $timer,
				]);
				Datanilai::where('marking', $idne)->update([
					'tanggal'	    => $dmulai,
					'mulai'	        => $mulai,
					'akhir'		    => $akhir,
					'timer'		    => $timer,
					'status'        => $status
				]);
				return response()->json(['marking' => $marking, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Ujian Berhasil di Update']);
				return back();
			}
		}
	}
	public function exAddPesertaTest(Request $request) {
		$idne   		= $request->input('val01');
		$marking   		= $request->input('val02');
		$jenis   		= $request->input('val03');
       	$homebase		= url("/");
		$update 		= null;
		$pesan			= '';
		$tanggal 		= date("Y-m-d H:i:s");
		$mulai 			= date("Y-m-d H:i:s");
		$akhir 			= date("Y-m-d H:i:s");
		$urutan 		= 1;
		$jumlah 		= 0;
		$tahun			= date("Y");
		$keterangan		= '';
		$tema			= '';
		$subtema		= '';
		$kodekd			= '';
		$deskripsi		= '';
		$matpel			= '';
		$kkm			= '';
		$jennilai		= '';
		$cekstatus		= User::where('email', Session('email'))->first();
        if (isset($cekstatus->tapel)){
        	$semester	= $cekstatus->smt;
			$tapel		= $cekstatus->tapel;
		} else { 
			$semester	= '';
			$tapel		= '';
		}
		if ($idne == 'all'){
            $getallpeserta	= Datainduk::where('klspos', $tahun)->where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('klspos')->get();
			if (!empty($getallpeserta)){
				foreach($getallpeserta as $getpeserta){
					$idpeserta 		= $getpeserta->id;
					$namapeserta	= $getpeserta->nama;
					$nomorpeserta 	= $getpeserta->noinduk;
					$asalpeserta 	= $getpeserta->klspos;
					if ($asalpeserta == '' OR $asalpeserta == 'unkown' OR $asalpeserta == null){
						$asalpeserta= $getpeserta->jilid;
					}
					$foto			= $getpeserta->foto;
                    if ($foto == '' OR $foto == null){
                        $foto	= '<img src="'.$homebase.'/boxed-bg.jpg" height="35">';
                    } else {
                        if (File::exists(base_path() ."/public/dist/img/foto/". $foto)) {
                            $foto	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="35">';
                        } else {
                            $foto	= '<img src="'.$homebase.'/boxed-bg.jpg" height="35">';
                        }
                    }
					$urutan 		= 1;
					$jumlah			= 0;
					$mcq            = 0;
                    $esai           = 0;
                    $multiesai      = 0;
                    $labeled        = 0;
                    $yesno          = 0;
                    $mulai          = '';
                    $akhir          = '';
                    $supervisor     = '';
                    $ceel           = '';
                    $kode           = '';
                    $tanggal        = '';
                    $namaujian      = '';
                    $tipe           = '';
                    $status         = 0;
					$getujian 		= Banksoaltest::where('marking', $request->input('val02'))->orderByRaw("RAND()")->get();
					if (!empty($getujian)){
						foreach ($getujian as $getdata){
							$timer 		= $getdata->timer;
							$mulai 		= $getdata->mulai;
							$akhir 		= $getdata->selesai;
							$ceel 		= $getdata->ceel;
                            $kode 		= $getdata->kode;
                            $tanggal 	= $getdata->tanggal;
                            $namaujian 	= $getdata->namaujian;
                            $tipe 		= $getdata->tipe;
                            $status     = $getdata->status;
                            $timer 		= $getdata->timer;
							$mulai 		= $getdata->mulai;
							$akhir 		= $getdata->selesai;
                            $tipesoal   = $getdata->tipesoal;
                            $supervisor = $getdata->supervisor;
                            if ($tipesoal == 'Labelled Case'){
                                $labeled++;
                            } else if ($tipesoal == 'esay'){
                                $esai++;
                            } else if ($tipesoal == 'Multi Essay Case'){
                                $multiesai++;
                            } else if ($tipesoal == 'Yes No Question'){
                                $yesno++;
                            } else {
                                $mcq++;
                            }
							$ceksek 	= Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $rows->id)->first();
							if (isset($ceksek->id)){
								Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $rows->id)->update([
									'ceel'			=> $getdata->ceel,
                                    'kode'			=> $getdata->kode,
                                    'tanggal'       => $getdata->tanggal,
                                    'mulai'         => $getdata->mulai,
                                    'selesai'       => $getdata->selesai,
                                    'namaujian'     => $getdata->namaujian,
                                    'supervisor'	=> $getdata->supervisor,
                                    'timer'         => $getdata->timer,
									'tipe'			=> $getdata->tipe,
                                    'idtest'	    => $getdata->id,
                                    'idsoal'		=> $getdata->idsoal,
                                    'idmahasiswa'	=> $getpeserta->id,
                                    'nomorpeserta'	=> $getpeserta->noinduk,
                                    'namapeserta'	=> $getpeserta->nama,
                                    'asalpeserta'	=> $getpeserta->klspos,
									'fullkode'      => $getdata->fullkode,
                                    'deskripsi'     => $getdata->deskripsi,
                                    'lampiran'      => $getdata->lampiran,
                                    'lampiran2'     => $getdata->lampiran2,
                                    'lampiran3'     => $getdata->lampiran3,
                                    'lampiran4'     => $getdata->lampiran4,
                                    'lampiran5'     => $getdata->lampiran5,
                                    'lampiran6'     => $getdata->lampiran6,
                                    'tipesoal'      => $getdata->tipesoal,
                                    'opsia'         => $getdata->opsia,
                                    'opsib'         => $getdata->opsib,
                                    'opsic'         => $getdata->opsic,
                                    'opsid'         => $getdata->opsid,
                                    'opsie'         => $getdata->opsie,
                                    'opsif'         => $getdata->opsif,
                                    'opsig'         => $getdata->opsig,
                                    'opsih'         => $getdata->opsih,
                                    'opsii'         => $getdata->opsii,
                                    'opsij'         => $getdata->opsij,
                                    'opsik'         => $getdata->opsik,
                                    'opsil'         => $getdata->opsil,
                                    'opsim'         => $getdata->opsim,
                                    'opsin'         => $getdata->opsin,
                                    'opsio'         => $getdata->opsio,
                                    'opsip'         => $getdata->opsip,
                                    'opsiq'         => $getdata->opsiq,
                                    'opsir'         => $getdata->opsir,
                                    'opsis'         => $getdata->opsis,
                                    'opsit'         => $getdata->opsit,
                                    'urutan'        => $urutan,
                                    'kunci'         => $getdata->kunci,
                                    'status'        => $getdata->status,
                                    'marking'       => $request->input('val02'),
								]);
								$jumlah++;
							} else {
								$input = Banksoalujian::create([
									'ceel'			=> $getdata->ceel,
                                    'kode'			=> $getdata->kode,
                                    'tanggal'       => $getdata->tanggal,
                                    'mulai'         => $getdata->mulai,
                                    'selesai'       => $getdata->selesai,
                                    'namaujian'     => $getdata->namaujian,
                                    'supervisor'	=> $getdata->supervisor,
                                    'timer'         => $getdata->timer,
									'tipe'			=> $getdata->tipe,
                                    'idtest'	    => $getdata->id,
                                    'idsoal'		=> $getdata->idsoal,
                                    'idmahasiswa'	=> $getpeserta->id,
                                    'nomorpeserta'	=> $getpeserta->noinduk,
                                    'namapeserta'	=> $getpeserta->nama,
                                    'asalpeserta'	=> $getpeserta->klspos,
									'fullkode'      => $getdata->fullkode,
                                    'deskripsi'     => $getdata->deskripsi,
                                    'lampiran'      => $getdata->lampiran,
                                    'lampiran2'     => $getdata->lampiran2,
                                    'lampiran3'     => $getdata->lampiran3,
                                    'lampiran4'     => $getdata->lampiran4,
                                    'lampiran5'     => $getdata->lampiran5,
                                    'lampiran6'     => $getdata->lampiran6,
                                    'tipesoal'      => $getdata->tipesoal,
                                    'opsia'         => $getdata->opsia,
                                    'opsib'         => $getdata->opsib,
                                    'opsic'         => $getdata->opsic,
                                    'opsid'         => $getdata->opsid,
                                    'opsie'         => $getdata->opsie,
                                    'opsif'         => $getdata->opsif,
                                    'opsig'         => $getdata->opsig,
                                    'opsih'         => $getdata->opsih,
                                    'opsii'         => $getdata->opsii,
                                    'opsij'         => $getdata->opsij,
                                    'opsik'         => $getdata->opsik,
                                    'opsil'         => $getdata->opsil,
                                    'opsim'         => $getdata->opsim,
                                    'opsin'         => $getdata->opsin,
                                    'opsio'         => $getdata->opsio,
                                    'opsip'         => $getdata->opsip,
                                    'opsiq'         => $getdata->opsiq,
                                    'opsir'         => $getdata->opsir,
                                    'opsis'         => $getdata->opsis,
                                    'opsit'         => $getdata->opsit,
                                    'skore'         => 0,
                                    'urutan'        => $urutan,
                                    'kunci'         => $getdata->kunci,
                                    'status'        => $getdata->status,
                                    'jawaban'       => '',
                                    'jawaban2'      => '',
                                    'jawaban3'      => '',
                                    'jawaban4'      => '',
                                    'jawaban5'      => '',
                                    'jawaban6'      => '',
                                    'jawaban7'      => '',
                                    'jawaban8'      => '',
                                    'jawaban9'      => '',
                                    'jawaban10'     => '',
                                    'jawaban11'     => '',
                                    'jawaban12'     => '',
                                    'jawaban13'     => '',
                                    'jawaban14'     => '',
                                    'jawaban15'     => '',
                                    'jawaban16'     => '',
                                    'jawaban17'     => '',
                                    'jawaban18'     => '',
                                    'jawaban19'     => '',
                                    'jawaban20'     => '',
                                    'marking'       => $request->input('val02'),
									'created_at'    => null,
                                    'updated_at'    => null
								]);
								$jumlah++;
							}
							$urutan++;
						}
					}
					$ceksudah       = Datanilai::where('marking', $request->input('val02'))->where('noinduk', $idpeserta)->count();
                    if ($ceksudah == 0){
                        Datanilai::create([
                            'noinduk'		=> $getpeserta->noinduk,
                            'nama'		    => $getpeserta->nama,
                            'kelas'		    => $getpeserta->klspos,
                            'tapel'		    => $tapel,
                            'semester'		=> $semester,
                            'tema'    		=> $tema,
                            'subtema'		=> $subtema,
                            'kodekd'		=> $kodekd,
                            'deskripsi'		=> $deskripsi,
                            'matpel'		=> $matpel,
                            'nilai'		    => 0,
                            'kkm'	   	 	=> $kkm,
                            'status'        => $status,
                            'catatan'		=> '',
                        	'id_sekolah'	=> $getpeserta->id_sekolah,
                            'penginput'	    => Session('nip'),
                            'tanggal'		=> $tanggal,
                            'mulai'	        => $mulai,
                            'akhir'		    => $akhir,
                            'timer'		    => $timer,
                            'jennilai'		=> $jennilai,
                            'marking'		=> $request->input('val02'),
                            'keterangan'	=> '',
                            'surat'			=> '',
                        ]);
                    } else {
						Datanilai::where('marking', $request->input('val02'))->where('idpeserta', $idpeserta)->update([
							'noinduk'		=> $getpeserta->noinduk,
                            'nama'		    => $getpeserta->nama,
                            'kelas'		    => $getpeserta->klspos,
                            'tapel'		    => $tapel,
                            'semester'		=> $semester,
                            'tema'    		=> $tema,
                            'subtema'		=> $subtema,
                            'kodekd'		=> $kodekd,
                            'deskripsi'		=> $deskripsi,
                            'matpel'		=> $matpel,
                            'kkm'	   	 	=> $kkm,
                            'status'        => $status,
                        	'id_sekolah'	=> $getpeserta->id_sekolah,
                            'penginput'	    => Session('nip'),
                            'tanggal'		=> $tanggal,
                            'mulai'	        => $mulai,
                            'akhir'		    => $akhir,
                            'timer'		    => $timer,
                            'jennilai'		=> $jennilai,
                        ]);
					}
					$keterangan		= $keterangan.'Set Ujian an. '.$namapeserta.' Sejumlah '.$jumlah.' Soal;<br /> ';
				}
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Info', 'message' => $keterangan]);
			return back();
		} else {
			if ($jenis == 'tambah'){
                $getpeserta = Datainduk::where('id', $idne)->first();
				if (isset($getpeserta->id)){
					$idpeserta 		= $getpeserta->id;
					$namapeserta	= $getpeserta->nama;
					$nomorpeserta 	= $getpeserta->noinduk;
					$asalpeserta 	= $getpeserta->klspos;
					$foto			= $getpeserta->foto;
					if ($foto == '' OR $foto == null){
                        $foto	= '<img src="'.$homebase.'/dist/img/takadagambar.png" height="35">';
                    } else {
                        if (File::exists(base_path() ."/public/dist/img/foto/". $foto)) {
                            $foto	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="35">';
                        } else {
                            $foto	= '<img src="'.$homebase.'/dist/img/takadagambar.png" height="35">';
                        }
                    }
					$urutan 		= 1;
					$jumlah			= 0;
					$mcq            = 0;
                    $esai           = 0;
                    $multiesai      = 0;
                    $labeled        = 0;
                    $yesno          = 0;
                    $mulai          = '';
                    $akhir          = '';
                    $supervisor     = '';
                    $ceel           = '';
                    $kode           = '';
                    $tanggal        = '';
                    $namaujian      = '';
                    $tipe           = '';
                    $status         = 0;
					
					$getujian 		= Banksoaltest::where('marking', $request->input('val02'))->orderByRaw("RAND()")->get();
					if (!empty($getujian)){
						foreach ($getujian as $getdata){
							$ceel 		= $getdata->ceel; //Muatan
							$kode 		= $getdata->kode; //Komponen Nilai
							$supervisor = $getdata->supervisor; //ID KD
							$idsupervisor = $getdata->idsupervisor; //ID Setting Komponen
							if ($jennilai == ''){
								$jennilai 	= $kode;
								$matpel		= $ceel;
								$getsetting = SettingNilai::where('id', $idsupervisor)->first();
								if (isset($getsetting->id)){
									$tema		= $getsetting->tema ?? '-';
									$subtema	= $getsetting->subtema ?? '-';
									$kodekd		= $getsetting->kodekd ?? '-';
									$kkm		= $getsetting->kkm ?? '';
									$deskripsi	= $getsetting->deskripsi ?? '';
									$matpel		= $getsetting->matpel ?? '';
								}
							}
							$timer 		= $getdata->timer;
							$mulai 		= $getdata->mulai;
							$akhir 		= $getdata->selesai;
                            $tanggal 	= $getdata->tanggal;
                            $namaujian 	= $getdata->namaujian;
                            $tipe 		= $getdata->tipe;
                            $status     = $getdata->status;
                            $timer 		= $getdata->timer;
							$mulai 		= $getdata->mulai;
							$akhir 		= $getdata->selesai;
                            $tipesoal   = $getdata->tipesoal;
                            
                            if ($tipesoal == 'Labelled Case'){
                                $labeled++;
                            } else if ($tipesoal == 'esay'){
                                $esai++;
                            } else if ($tipesoal == 'Multi Essay Case'){
                                $multiesai++;
                            } else if ($tipesoal == 'Yes No Question'){
                                $yesno++;
                            } else {
                                $mcq++;
                            }
							$ceksek 	= Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $getdata->id)->first();
							if (isset($ceksek->id)){
								Banksoalujian::where('idmahasiswa', $idpeserta)->where('idtest', $getdata->id)->update([
									'ceel'			=> $getdata->ceel,
                                    'kode'			=> $getdata->kode,
                                    'tanggal'       => $getdata->tanggal,
                                    'mulai'         => $getdata->mulai,
                                    'selesai'       => $getdata->selesai,
                                    'namaujian'     => $getdata->namaujian,
                                    'supervisor'	=> $getdata->supervisor,
                                    'timer'         => $getdata->timer,
									'tipe'			=> $getdata->tipe,
                                    'idsoal'		=> $getdata->idsoal,
                                    'nomorpeserta'	=> $getpeserta->noinduk,
                                    'namapeserta'	=> $getpeserta->nama,
                                    'asalpeserta'	=> $getpeserta->klspos,
									'fullkode'      => $getdata->fullkode,
                                    'deskripsi'     => $getdata->deskripsi,
                                    'lampiran'      => $getdata->lampiran,
                                    'lampiran2'     => $getdata->lampiran2,
                                    'lampiran3'     => $getdata->lampiran3,
                                    'lampiran4'     => $getdata->lampiran4,
                                    'lampiran5'     => $getdata->lampiran5,
                                    'lampiran6'     => $getdata->lampiran6,
                                    'tipesoal'      => $getdata->tipesoal,
                                    'opsia'         => $getdata->opsia,
                                    'opsib'         => $getdata->opsib,
                                    'opsic'         => $getdata->opsic,
                                    'opsid'         => $getdata->opsid,
                                    'opsie'         => $getdata->opsie,
                                    'opsif'         => $getdata->opsif,
                                    'opsig'         => $getdata->opsig,
                                    'opsih'         => $getdata->opsih,
                                    'opsii'         => $getdata->opsii,
                                    'opsij'         => $getdata->opsij,
                                    'opsik'         => $getdata->opsik,
                                    'opsil'         => $getdata->opsil,
                                    'opsim'         => $getdata->opsim,
                                    'opsin'         => $getdata->opsin,
                                    'opsio'         => $getdata->opsio,
                                    'opsip'         => $getdata->opsip,
                                    'opsiq'         => $getdata->opsiq,
                                    'opsir'         => $getdata->opsir,
                                    'opsis'         => $getdata->opsis,
                                    'opsit'         => $getdata->opsit,
                                    'urutan'        => $urutan,
                                    'kunci'         => $getdata->kunci,
                                    'status'        => $getdata->status,
                                    'marking'       => $request->input('val02'),
								]);
								$jumlah++;
							} else {
								$input = Banksoalujian::create([
									'ceel'			=> $getdata->ceel,
                                    'kode'			=> $getdata->kode,
                                    'tanggal'       => $getdata->tanggal,
                                    'mulai'         => $getdata->mulai,
                                    'selesai'       => $getdata->selesai,
                                    'namaujian'     => $getdata->namaujian,
                                    'supervisor'	=> $getdata->supervisor,
                                    'timer'         => $getdata->timer,
									'tipe'			=> $getdata->tipe,
                                    'idtest'	    => $getdata->id,
                                    'idsoal'		=> $getdata->idsoal,
                                    'idmahasiswa'	=> $getpeserta->id,
                                    'nomorpeserta'	=> $getpeserta->noinduk,
                                    'namapeserta'	=> $getpeserta->nama,
                                    'asalpeserta'	=> $getpeserta->klspos,
									'fullkode'      => $getdata->fullkode,
                                    'deskripsi'     => $getdata->deskripsi,
                                    'lampiran'      => $getdata->lampiran,
                                    'lampiran2'     => $getdata->lampiran2,
                                    'lampiran3'     => $getdata->lampiran3,
                                    'lampiran4'     => $getdata->lampiran4,
                                    'lampiran5'     => $getdata->lampiran5,
                                    'lampiran6'     => $getdata->lampiran6,
                                    'tipesoal'      => $getdata->tipesoal,
                                    'opsia'         => $getdata->opsia,
                                    'opsib'         => $getdata->opsib,
                                    'opsic'         => $getdata->opsic,
                                    'opsid'         => $getdata->opsid,
                                    'opsie'         => $getdata->opsie,
                                    'opsif'         => $getdata->opsif,
                                    'opsig'         => $getdata->opsig,
                                    'opsih'         => $getdata->opsih,
                                    'opsii'         => $getdata->opsii,
                                    'opsij'         => $getdata->opsij,
                                    'opsik'         => $getdata->opsik,
                                    'opsil'         => $getdata->opsil,
                                    'opsim'         => $getdata->opsim,
                                    'opsin'         => $getdata->opsin,
                                    'opsio'         => $getdata->opsio,
                                    'opsip'         => $getdata->opsip,
                                    'opsiq'         => $getdata->opsiq,
                                    'opsir'         => $getdata->opsir,
                                    'opsis'         => $getdata->opsis,
                                    'opsit'         => $getdata->opsit,
                                    'skore'         => 0,
                                    'urutan'        => $urutan,
                                    'kunci'         => $getdata->kunci,
                                    'status'        => $getdata->status,
                                    'jawaban'       => '',
                                    'jawaban2'      => '',
                                    'jawaban3'      => '',
                                    'jawaban4'      => '',
                                    'jawaban5'      => '',
                                    'jawaban6'      => '',
                                    'jawaban7'      => '',
                                    'jawaban8'      => '',
                                    'jawaban9'      => '',
                                    'jawaban10'     => '',
                                    'jawaban11'     => '',
                                    'jawaban12'     => '',
                                    'jawaban13'     => '',
                                    'jawaban14'     => '',
                                    'jawaban15'     => '',
                                    'jawaban16'     => '',
                                    'jawaban17'     => '',
                                    'jawaban18'     => '',
                                    'jawaban19'     => '',
                                    'jawaban20'     => '',
                                    'marking'       => $request->input('val02'),
								]);
								$jumlah++;
							}
							$urutan++;
						}
					}
					if ($jumlah != 0){
						$kodeunik 		= $request->input('val02').'-'.$nomorpeserta;
						$kodeunikPendek = substr(hash('sha256', $kodeunik), 0, 9);
						$ceksudah       = Datanilai::where('marking', $request->input('val02'))->where('noinduk', $nomorpeserta)->first();
						if (isset($ceksudah->id)){
							Datanilai::where('id', $ceksudah->id)->update([
								'nama'		    => $getpeserta->nama,
								'kelas'		    => $getpeserta->klspos,
								'tapel'		    => $tapel,
								'semester'		=> $semester,
								'tema'    		=> $tema,
								'subtema'		=> $subtema,
								'kodekd'		=> $kodekd,
								'deskripsi'		=> $kodeunikPendek,
								'matpel'		=> $matpel,
								'kkm'	   	 	=> $kkm,
								'status'        => $status,
								'id_sekolah'	=> $getpeserta->id_sekolah,
								'penginput'	    => Session('nip'),
								'tanggal'		=> $tanggal,
								'mulai'	        => $mulai,
								'akhir'		    => $akhir,
								'timer'		    => $timer,
								'jennilai'		=> $jennilai,
							]);
						} else {
							Datanilai::create([
							    'noinduk'		=> $nomorpeserta,
								'nama'		    => $getpeserta->nama,
								'kelas'		    => $getpeserta->klspos,
								'tapel'		    => $tapel,
								'semester'		=> $semester,
								'tema'    		=> $tema,
								'subtema'		=> $subtema,
								'kodekd'		=> $kodekd,
								'deskripsi'		=> $kodeunikPendek,
								'matpel'		=> $matpel,
								'nilai'		    => 0,
								'kkm'	   	 	=> $kkm,
								'status'        => $status,
								'catatan'		=> '',
								'id_sekolah'	=> $getpeserta->id_sekolah,
								'penginput'	    => Session('nip'),
								'tanggal'		=> $tanggal,
								'mulai'	        => $mulai,
								'akhir'		    => $akhir,
								'timer'		    => $timer,
								'jennilai'		=> $jennilai,
								'marking'		=> $request->input('val02'),
								'keterangan'	=> '',
								'surat'			=> '',
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => $namapeserta.' Set Ujian Sejumlah '.$jumlah.' Soal']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Soal Tidak Ditemukan, Mohon Input Soal Terlebih Dahulu']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID Peserta Tidak Valid']);
					return back();
				}
            } else {
                $remove       = Datanilai::where('marking', $marking)->where('noinduk', $idne)->delete();
                if ($remove){
                    $cekjawaban 	= Banksoalujian::where('marking', $marking)->where('nomorpeserta', $idne)->where('skore', '!=', '0.00')->count();
					if ($cekjawaban == 0){
						Banksoalujian::where('marking', $marking)->where('nomorpeserta', $idne)->delete();
						$keterangan = 'Peserta terhapus dari List';
					} else {
						Banksoalujian::where('marking', $marking)->where('nomorpeserta', $idne)->update([
							'status'		=> 3, //disable
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
						$keterangan = 'Peserta terset arsip dari List';
					}
                    return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Info', 'message' => $keterangan]);
                    return back();
                } else {
                    $keterangan = 'Delete Failed';
                    return response()->json(['icon' => 'error', 'warna' => '#5ba035', 'status' => 'Failed', 'message' => $keterangan]);
			        return back();
                }
            }
		}
	}
    public function viewUjianKompetensi() {
		$homebase		= url("/");
		$idujian		= Session('id');
		$idpeg			= Session('idpeg');
		$data			= [];
		$semester 		= '';
		$prodi			= 0;
		$tandatangan 	= $homebase.'/boxed-bg.png';
		$foto 			= $homebase.'/mascot.png';
		$hasil			= Datanilai::where('noinduk', Session('noinduk'))->where('deskripsi', Session('marking'))->first();
		if (isset($hasil->id)){
			$listsoalkb		= [];
			$mulai 			= $hasil->mulai;
			$akhir 			= $hasil->akhir;
			$marking 		= $hasil->marking;
			$absenmulai 	= Carbon::createFromFormat('Y-m-d H:i:s', $mulai);
			$absenakhir 	= Carbon::createFromFormat('Y-m-d H:i:s', $akhir);
			$check 			= Carbon::now()->between($absenmulai,$absenakhir);
			if ($check){
				$sql		            = Banksoalujian::where('idmahasiswa', $hasil->noinduk)->where('marking', $marking)->orderBy('urutan', 'ASC')->get();
				$data['idmahasiswa']	= $hasil->noinduk;
				$data['listsoal']		= $sql;
				$data['mulai']			= $mulai;
				$data['akhir']			= $akhir;
				$data['timer']			= $hasil->timer;
				$data['jenisujian']		= $hasil->namaujian;
				return view('simaster.ujiannewmodel', $data);
			} else {
				if ($hasil->status == 9){
					$sql		            = Banksoalujian::where('idmahasiswa', $hasil->idpeserta)->where('marking', $marking)->orderBy('urutan', 'ASC')->get();
					$data['idmahasiswa']	= $hasil->noinduk;
					$data['listsoal']		= $sql;
					$data['jenisujian']		= $hasil->namaujian;
					$data['mulai']			= $mulai;
					$data['akhir']			= $akhir;
					$data['timer']			= $hasil->timer;
					return view('simaster.ujiannotimer', $data);
				} else {
					$data['judulpesan']			= 'Restricted Area';
					$data['kalimatheader']		= 'Waktu '.date("Y-m-d H:i:s").' Diluar Rentang Setting Ujian ';
					$data['kalimatbody']		= 'Ujian Ini di Setting Mulai '.$mulai.' s/d '.$akhir.' <br /> <a href="profiluser">Kembali Ke Laman Biodata</a>';
					return view('errors.notready', $data);
				}
			}
		} else {
			$data['judulpesan']			= 'Restricted Area';
			$data['kalimatheader']		= 'ID Tidak Valid';
			$data['kalimatbody']		= 'Mohon Maaf ID '.Session('noinduk').' dengan Kode Ujian '.Session('marking').' Tidak Di Temukan';
			return view('errors.notready', $data);
		}
	}
	public function viewTryOut() {
		$homebase		= url("/");
		$data			= [];
		$getuser 		= User::where('username', Session('username'))->first();
		if (isset($getuser->paraf)){
			$idne 		= $getuser->id;
			$marking	= 'tryout-'.time();
			$mulai		= date('Y-m-d H:i:s');
			$tambah		= ' + 360 second';
			$akhir		= date('Y-m-d h:i:s',strtotime($tambah,strtotime($mulai)));
			$hasil		= Dataindukstaff::where('niy', $getuser->nip)->first();
			if (isset($hasil->nama)){
				$idpeserta				= $hasil->id;
				$listsoalkb				= [];
				$sql					= Banksoaltest::where('marking', $getuser->paraf)->orderByRaw("RAND()")->get();
				$data['idmahasiswa']	= $idpeserta;
				$data['listsoal']		= $sql;
				$data['listsoaltryout']	= $sql;
				$data['mulai']			= $mulai;
				$data['akhir']			= $akhir;
				$data['timer']			= 60;
				$data['jenisujian']		= 'tryout';
				return view('simaster.ujiannewmodel', $data);
			} else {
				$data['judulpesan']			= 'Restricted Area';
				$data['kalimatheader']		= 'Session Un Valid';
				$data['kalimatbody']		= 'Please try to relogin';
				return view('errors.notready', $data);
			}
		} else {
			$data['judulpesan']			= 'Restricted Area';
			$data['kalimatheader']		= 'Unkown Try Out Ticket';
			$data['kalimatbody']		= 'Please try to select test mark again';
			return view('errors.notready', $data);
		}
	}
	public function exSimpanJawaban(Request $request) {
    	$idujian		= $request->input('set01');
		$idmahasiswa	= $request->input('set02');
		$jawaban		= $request->input('set03');
        $getdata 		= Banksoalujian::where('id', $idujian)->first();
        if (isset($getdata->id)){
            $idtest 	= $getdata->idtest;
            $namaujian 	= $getdata->namaujian;
			$mulai 		= $getdata->mulai;
			$akhir 		= $getdata->selesai;
			$kunci 		= $getdata->kunci;
            $tipesoal 	= $getdata->tipesoal;
			$marking 	= $getdata->marking;
			if ($tipesoal == 'choice' AND $kunci == $jawaban){
				$skore 	= 1;
			} else { $skore = 0; }
            Banksoalujian::where('id', $idujian)->update([
				'jawaban'	=> $jawaban,
				'skore'		=> $skore,
			]);
			$getskore = Banksoalujian::select(DB::raw('SUM(skore) as skore'))->where('marking', $getdata->marking)->where('idmahasiswa', $getdata->idmahasiswa)->where('tipesoal', $getdata->tipesoal)->groupBy('idmahasiswa')->first();
			if (isset($getskore->skore)){
				$jumlah		= $getskore->skore;
			} else { $jumlah = 0 ; }
			Datanilai::where('marking', $getdata->marking)->where('noinduk', $getdata->idmahasiswa)->update([
				'nilai'		=> $jumlah,
			]);
		
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Answer Saved']);
			return back();
        } else {
            return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idujian.' Tidak Valid, Hubungi TIM IT atau Refresh Laman Ini']);
            return back();
        }
    
	}
	public function jsonallcase(Request $request) {
		$arraysurat 	= [];
		$tahun			= $request->input('set01');
		$inputor		= $request->input('set02');
		$kode			= $request->input('set03');
		if ($tahun == 'soalaktif' OR $tahun == 'carisoal'){
			if ($tahun == 'soalaktif'){ 
                $arraysurat = Banksoaltest::where('marking', $request->input('set03'))->get();
            } else {
                $arraysurat = Banksoal::where('view', '!=', '0')->whereNotIn('id', Banksoaltest::where('marking', $kode)->pluck('idsoal'))->get();
            }
		} else if ($tahun == 'Analisis') {
			$sql 	= Banksoaltest::where('marking', $kode)->get();
			if (!empty($sql)){
				foreach ($sql as $rows){
					if ($rows->opsit !== null){
						$skore = $rows->opsit;
					} else {
						$jumlah	= Banksoalujian::where('marking', $rows->marking)->where('idsoal', $rows->idsoal)->count();
							$betul	= Banksoalujian::where('marking', $rows->marking)->where('idsoal', $rows->idsoal)->where('skore', '1')->count();
							if ($betul != 0 AND $jumlah != 0){
								$skore 	= round((($betul/$jumlah)*100), 2);
							} else {
								$skore 	= null;
							}
						Banksoaltest::where('id', $rows->id)->update([
							'opsit'	=> $skore
						]);
					}
					
					$arraysurat[] = array(
						'id' 				=> $rows->id,
						'kode' 				=> $rows->kode,	
						'ceel' 				=> $rows->ceel,	
						'tipesoal' 			=> $rows->tipesoal,	
						'deskripsi' 		=> $rows->deskripsi,
						'namaujian' 		=> $rows->namaujian,
						'idsoal' 			=> $rows->idsoal,
						'tahun' 			=> $skore,
						'created_by' 		=> $rows->created_by,
					);
				}
			}
		} else if ($tahun == 'analitiksoal') {
			$sql 	    = Banksoal::where('ceel', '!=', 'Contoh Soal')->where('active', '1')->where('view', '1')->get();
			if (!empty($sql)){
				foreach ($sql as $rows){
					if ($rows->opsit !== null){
						$skore = $rows->opsit;
					} else {
						if ($rows->jawaban == 'choice'){
							$jumlah	= Banksoalujian::where('namaujian', 'NOT LIKE', '%Try Out%')->where('idsoal', $rows->id)->count();
							$betul	= Banksoalujian::where('namaujian', 'NOT LIKE', '%Try Out%')->where('idsoal', $rows->id)->where('skore', '1.00')->count();
							if ($jumlah != 0 AND $betul != 0){
								$skore 	= round((($betul/$jumlah)*100), 2);
							} else { $skore = 0; }
						} else {
							$getskore 	= Banksoalujian::select(DB::raw('round(AVG(skore),2) as skore'))->where('namaujian', 'NOT LIKE', '%Try Out%')->where('idsoal', $rows->id)->groupBy('idsoal')->first();
							if (isset($getskore->skore)){
								$skore		= $getskore->skore;
							} else { $skore = 0 ; }
						}
						Banksoal::where('id', $rows->id)->update([
							'opsit'	=> $skore
						]);
					}
					
					$arraysurat[] = array(
						'id' 				=> $rows->id,
						'kode' 				=> $rows->kode,	
						'ceel' 				=> $rows->ceel,	
						'tipe' 				=> $rows->jawaban,	
						'deskripsi' 		=> $rows->deskripsi,
						'created_by' 		=> $rows->created_by,
						'fakultas' 			=> $rows->fakultas,
						'fakpanjang' 		=> $rows->fakpanjang,
						'namaujian' 		=> $rows->deskripsitambahan,
						'idsoal' 			=> $rows->id,
						'ratarata' 			=> $skore,
					);
				}
			}
		} else if ($tahun == 'statistik') {
			$arraysurat 	= Banksoaltest::where('marking', $kode)->select('kesimpulan', DB::Raw('COUNT(id) as jumlah'))->groupBy('kesimpulan')->get();
		} else if ($tahun == 'rekap') {
			$arraysurat 	= Banksoal::where('view', '1')->select('ceel', 'kode', DB::Raw('COUNT(id) as jumlah'))->groupBy('ceel')->get();
		} else if ($tahun == 'listpewancara') {
			$arraysurat 	= User::where('merangkap', 'Penguji Lisan')->where('smt', $kode)->get();
		} else if ($tahun == 'caripeserta') {
			$arraysurat 	= Banksoalujian::where('marking', $kode)->where('status', '!=', '3')->groupBy('idmahasiswa')->get();
		} else if ($tahun == 'koreksipeserta') {
			$email 		= Session('email');
			$sql 		= Banksoaltest::where('idsupervisor', Session('nip'))->where('status', '1')->get();
			if (!empty($sql)){
				foreach ($sql as $rows){
					$marking 		= $rows->marking;
					$namaujian 		= $rows->namaujian;
					$supervisor 	= $rows->supervisor;
					$idsoal 		= $rows->idsoal;
					$getmahasiswa 	= Banksoalujian::where('marking', $marking)->where('idsoal', $idsoal)->get();
					if (!empty($getmahasiswa)){
						foreach($getmahasiswa as $rmhs){
							$cekjawaban = $rmhs->jawaban;
							if ($cekjawaban == ''){
								$skore = '<font color=grey>'.$rmhs->skore.'</font>';
							} else {
								if ($rmhs->skore == 0){
									$skore = '<font color=yellow>'.$rmhs->skore.'</font>';
								} else {
									$skore = '<font color=green>'.$rmhs->skore.'</font>';
								}
							}
							$arraysurat[] = array(
								'id' 			=> $rmhs->id,
								'namapeserta' 	=> $rmhs->namapeserta,
								'nomorpeserta' 	=> $rmhs->nomorpeserta,
								'asalpeserta' 	=> $rmhs->asalpeserta,
								'supervisor' 	=> $supervisor,
								'idtest' 		=> $rmhs->idtest,
								'idsoal' 		=> $rmhs->idsoal,
								'idmahasiswa' 	=> $rmhs->idmahasiswa,
								'nilai' 		=> $rmhs->skore,
								'viewnilai' 	=> $skore,
								'jawaban' 		=> $rmhs->jawaban,
								'tanggal' 		=> $rmhs->tanggal,
								'namaujian' 	=> $namaujian,
                              'idspv' 		=> $idpeg,
							);
						}
					}
				}
			}
		} else if ($tahun == 'koreksilist') {
			$arraysurat 	= Banksoalujian::where('idmahasiswa', $request->input('set02'))->where('marking', $request->input('set03'))->orderBy('idsoal', 'ASC')->get();
		} else if ($tahun == 'esaionly') {
			$getallsoal 	= Banksoaltest::where('marking', $kode)->get();
			if (!empty($getallsoal)){
				foreach($getallsoal as $hasil){
					$tipe 		= $hasil->tipe;
					$idsoal		= $hasil->idsoal;
					$ceel		= $hasil->ceel;
					$kode		= $hasil->kode;
					$deskripsi	= '';
					$caritipe 	= Banksoal::where('id', $idsoal)->first();
					if (isset($caritipe->jawaban)){
						$tipe 		= $caritipe->jawaban;
						$deskripsi 	= $caritipe->deskripsi;
						$ceel 		= $caritipe->ceel;
						$kode 		= $caritipe->kode;
					}
					if ($tipe == 'esay'){
						$arraysurat[] 	= array(
							'id' 				=> $hasil->id,
							'ceel' 				=> $ceel,
							'kode' 				=> $kode,
							'namaujian' 		=> $hasil->namaujian,
							'supervisor' 		=> $hasil->supervisor,
							'idsupervisor' 		=> $hasil->idsupervisor,
							'tipe' 				=> $tipe,
							'idsoal' 			=> $hasil->idsoal,
							'status' 			=> $hasil->status,
							'pengumuman' 		=> $hasil->pengumuman,
							'mulai' 			=> $hasil->mulai,
							'selesai' 			=> $hasil->selesai,
							'timer' 			=> $hasil->timer,
							'marking' 			=> $hasil->marking,
							'created_by' 		=> $hasil->created_by,
							'tahun' 			=> $hasil->created_at->year,
							'deskripsi' 		=> $deskripsi,
						);
					}
				}
			}
		} else {
			if ($kode != '' OR $request->input('set03') !== null){
				if ($tahun == 'activeonly'){
					$jjadwal = Banksoal::where('kode', $kode)->where('created_by', Session('username'))->orderBy('id', 'DESC')->get();
				} else if ($tahun == 'Deleted'){
					$jjadwal = Banksoal::where('kode', $kode)->where('view', '0')->orderBy('created_by', 'DESC')->get();
				} else if ($tahun == 'all'){
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('kode', $kode)->where('created_by', Session('username'))->where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				} else {
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('kode', $kode)->where('created_by', Session('username'))->where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('kode', $kode)->where('view', '!=', '0')->whereYear('created_at', $tahun)->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				}
			} else {
				if ($tahun == 'activeonly'){
					$jjadwal = Banksoal::where('created_by', Session('username'))->orderBy('id', 'DESC')->get();
				} else if ($tahun == 'unverfied'){
					if (Session('previlage') == 'administarator' OR Session('previlage') == 'verifikator') {
						$jjadwal = Banksoal::where('active', 1)->where('view', '0')->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('active', 1)->where('view', '0')->where('verified_by', Session('nip'))->orderBy('id', 'DESC')->get();
					}
				} else if ($tahun == 'Deleted'){
					$jjadwal = Banksoal::where('view', '0')->orderBy('created_by', 'DESC')->get();
				} else if ($tahun == 'all'){
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('created_by', Session('username'))->where('view', '!=', '0')->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('view', '!=', '0')->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				} else {
					if ($inputor == 'all'){
						$jjadwal = Banksoal::where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else if ($inputor == 'Private'){
						$jjadwal = Banksoal::where('created_by', Session('username'))->where('view', '!=', '0')->whereYear('created_at', $tahun)->orderBy('id', 'DESC')->get();
					} else {
						$jjadwal = Banksoal::where('view', '!=', '0')->whereYear('created_at', $tahun)->where('created_by', $inputor)->orderBy('id', 'DESC')->get();
					}
				}
			}
			if (!empty($jjadwal)){
				foreach ($jjadwal as $hasil) {
					$idsoal 	= $hasil->id;
					$tlssoale	= $hasil->deskripsi;
					$alasan		= $hasil->deskripsitambahan;
					$kode		= $hasil->kode;
					$ceel		= $hasil->ceel;
					$aktif		= $hasil->active;
					$dosen		= $hasil->inputor;
					$tipesoal	= $hasil->jawaban;
					$view		= $hasil->view;
					$tahun		= $hasil->created_at->year;
					$lampiran	= $hasil->lampiran;
					$fullkode	= $hasil->fullkode;
					$nilai01	= $hasil->nilai01;
					if (is_null($alasan)){ $alasan = ''; }
					if (is_null($nilai01)){ $nilai01 = ''; }
					if (is_null($fullkode) OR $fullkode == ''){
						$fullkode = $tahun.'-'.$kode.'-'.Session('niy').'-'.$idsoal;
						Banksoal::where('id', $idsoal)->update([
							'fullkode'	=> $fullkode
						]);
					}
					if (is_null($nilai01) OR $nilai01 == '' AND $request->input('set01') != 'activeonly'){
						$fullkode 	= $tahun.'-'.$kode.'-'.$ceel.$idsoal;
						if ($request->input('set01') != 'unverfied'){
							$getrating	= Banksoalrating::where('kodesoal', $fullkode)->first();
							if (isset($getrating->id)){
								Banksoal::where('id', $idsoal)->update([
									'nilai01'		=> $getrating->facility,
									'nilai02'		=> $getrating->discrimination,
									'keterangan01'	=> $getrating->facilitytext,
									'keterangan02'	=> $getrating->discriminationtext,
									'kesimpulan'	=> $getrating->kesimpulan,
								]);	
							}
						}
					}
					$inputor	= $dosen;
					if ($view == 1){ $view = '&#10004;'; } else { $view = ''; }
					$opsia		= $hasil->opsia;
					$opsib		= $hasil->opsib;
					$opsic		= $hasil->opsic;
					$opsid		= $hasil->opsid;
					$opsie		= $hasil->opsie;
					$kunci		= $hasil->kunci;
					$kunci 		= preg_replace('/\s+/', '', $kunci);
					if ($tipesoal == 'esay'){
						$showjawab	= 'Kunci Jawaban : <pre>'.$opsia.'</pre>';
					} else {
						$showjawab	= '<table border="0"><tr><td>A</td><td>'.$opsia.'</td></tr><tr><td>B</td><td>'.$opsib.'</td></tr><tr><td>C</td><td>'.$opsic.'</td></tr><tr><td>D</td><td>'.$opsid.'</td></tr><tr><td>E</td><td>'.$opsie.'</td></tr><tr><td>Keys : </td><td>'.$kunci.'</td></tr></table>';
					}
					if ($lampiran == ''){
						$tlssoale = '<table border="0"><tr><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
					} else {
						if (file_exists(public_path('images/ujian/'.$lampiran))){
							$tlssoale = '<table border="0"><tr><td><a href="images/ujian/'.$lampiran.'" target="_blank"><img src="images/ujian/'.$lampiran.'" width="150" /></a></td><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
						} else {
							$tlssoale = '<table border="0"><tr><td>'.$tlssoale.'<br />'.$showjawab.'</td></tr></table>';
							$lampiran = '';
						}
					}
					$keterangan		= '<strong>Kontributor : </strong>'.$inputor;
					if ($alasan != ''){
						$keterangan = $keterangan.'<br /><strong>Used On :</strong>'.$hasil->deskripsitambahan;
					}
					if ($nilai01 != ''){
						$keterangan = $keterangan.'<br />Facility : '.$hasil->nilai01.' ( '.$hasil->keterangan01.' )<br />Discrimination : '.$hasil->nilai02.' ( '.$hasil->keterangan02.' )<br />so the question is : '.$hasil->kesimpulan;
					}
					
					$arraysurat[] = array(
						'idsoal' 			=> $idsoal,
						'tipesoal' 			=> $tipesoal,	
						'jawaban' 			=> $hasil->jawaban,
						'tlssoale' 			=> $tlssoale,
						'keterangan' 		=> $keterangan,
						'kode' 				=> $kode,
						'fullkode' 			=> $hasil->fullkode,
						'lampiran' 			=> $hasil->lampiran,
						'lampiran2' 		=> $hasil->lampiran2,
						'lampiran3' 		=> $hasil->lampiran3,
						'lampiran4' 		=> $hasil->lampiran4,
						'lampiran5' 		=> $hasil->lampiran5,
						'lampiran6' 		=> $hasil->lampiran6,
						'ceel' 				=> $ceel,	
						'inputor' 			=> $hasil->inputor,
						'aktif' 			=> $hasil->active,
						'view' 			    => $hasil->view,
						'aktifview' 		=> $view,
						'alasan' 			=> $alasan,
						'deskripsi' 		=> $hasil->deskripsi,
						'jawaba' 			=> $hasil->opsia,
						'jawabb' 			=> $hasil->opsib,
						'jawabc' 			=> $hasil->opsic,
						'jawabd' 			=> $hasil->opsid,
						'jawabe' 			=> $hasil->opsie,
						'kuncie' 			=> $kunci,
						'tahun' 			=> $hasil->created_at->year,
						'created_by' 		=> $hasil->created_by,
						'verified_by' 		=> $hasil->verified_by,
						'fakultas' 			=> $hasil->fakultas,
						'fakpanjang' 		=> $hasil->fakpanjang,
						'deskripsitambahan' => $hasil->deskripsitambahan,
					);
				}
			}
		}
		echo json_encode($arraysurat);	
	}
	public function aktifet(Request $request) {
		$idsoal		= $request->input('val01');
		$kerja		= $request->input('val02');
		$marking	= $request->input('val03');
		$idpeg	    = Session('idpeg');
        $nmpeg	    = Session('nama');
		if ($kerja == 'removespv'){
			$input 	= User::where('id', $idsoal)->update([
				'merangkap'	=> ''
			]);
			if ($input){
				echo 'Hak Pewancara Telah Kami Hilangkan';
			} else {
				echo 'ID Tidak Valid / Hak Pewancara Telah Tercabut Sebelumnya';
			}
		} else if ($kerja == 'remove'){
            $getdata 	= Banksoaltest::where('id', $idsoal)->first();
			$cekada		= Banksoalujian::where('idsoal', $getdata->idsoal)->where('idtest', $getdata->id)->where('skore', '!=', '0.00')->count();
			$ceksisa    = Banksoaltest::where('marking', $marking)->count();
            $cekpeserta = Datanilai::where('marking', $marking)->where('status', '!=', '0')->count();
            if ($cekpeserta == 0){
                if ($cekada == 0){
                    if ($ceksisa == 1){
                        Banksoaltest::where('id', $getdata->id)->update([
                            'idsoal'		=> 0,
                            'ceel'			=> '',
                            'kode'			=> '',
                            'tipesoal'      => '',
                            'deskripsi'     => '',
                        ]);
                    } else {
                        Banksoaltest::where('id', $getdata->id)->delete();
                    }
                    $pesan 	= 'Remove Soal Berhasil di lakukan';	
                    echo '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Success..!!</h4>
                            '.$pesan.'
                        </div>';
                } else {
                    $pesan 	= 'Remove Soal Gagal, Soal ini telah di kerjakan';	
                    echo '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Error</h4>
                            '.$pesan.'
                        </div>';
                }
            } else {
                $pesan 	= 'Remove Soal Gagal, Mohon Mengosongkan Peserta Ujian Terlebih Dahulu';	
                echo '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Error</h4>
                        '.$pesan.'
                    </div>';
            }
		} else if ($kerja == 'removetest'){
            $data1 		= Banksoaltest::where('marking', $request->input('val01'))->count();
			$data2		= Banksoalujian::where('marking', $request->input('val01'))->count();
			Banksoaltest::where('marking', $request->input('val01'))->delete();
			Banksoalujian::where('marking', $request->input('val01'))->delete();
			echo 'Data Test Sebanyak '.$data1.' dan Peserta Sejumlah '.$data2;
		} else if ($kerja == 'cekmulai'){
			$idne		= $request->input('val01');
			$hasil 		= Datanilai::where('id', $idne)->first();
            if (isset($hasil->mulai)){
                $mulai 			= $hasil->mulai;
				$akhir 			= $hasil->akhir;
				$absenmulai 	= Carbon::createFromFormat('Y-m-d H:i:s', $mulai);
				$absenakhir 	= Carbon::createFromFormat('Y-m-d H:i:s', $akhir);
				$check 			= Carbon::now()->between($absenmulai, $absenakhir);
                if ($check){
					return response()->json(['status' => 'OK', 'marking' => $hasil->id, 'mulai' => $mulai, 'akhir' => $akhir,  'timer' => $hasil->timer, 'matpel' => $hasil->matpel]);
					return back();
				} else {
					if ($hasil->status == 9){
						return response()->json(['status' => 'LANGSUNGSTART', 'marking' => $hasil->id, 'mulai' => $mulai, 'akhir' => $akhir,  'timer' => $hasil->timer, 'matpel' => $hasil->matpel]);
						return back();
					} else {
						return response()->json(['status' => 'KELEWAT', 'marking' => $check, 'mulai' => $mulai, 'akhir' => $akhir,  'timer' => $hasil->timer, 'matpel' => $hasil->matpel]);
						return back();
					}
				}
            } else {
				return response()->json(['status' => 'TIDAK ADA', 'idne' => $idne]);
				return back();
			}
		} else if ($kerja == 'setwaktuujianmandiri'){
			$id			= $request->input('val01');
			$mulai		= $request->input('val03');
			$getcatatan = Datanilai::where('id', $id)->first();
			if (isset($getcatatan->id)){
				$mulaiawal 		= $getcatatan->mulai;
				$timer 			= $getcatatan->timer;
				$akhirawal 		= $getcatatan->akhir;
				$hitungakhir	= new DateTime($akhirawal);
				$timer 			= $timer + 3;
				$tinsecond 		= $timer * 60;
				$gettanggal		= explode(' ', $mulaiawal);
				$tanggal 		= $gettanggal[0];
				$strmulai 		= $tanggal.' '.$mulai;
				$mulai			= new DateTime($strmulai);
				$akhir			= new DateTime($strmulai);
				$akhir->modify('+'.$timer.' minutes');
				/*
				Jika tetap waktu akhir sebagai penentu selesainya ujian
				if ($akhir > $hitungakhir){
					$akhir		= $akhirawal;
				}
				*/
				$update 		= Datanilai::where('id', $getcatatan->id)->update([
					'mulai'		=> $mulai,
					'akhir'		=> $akhir
				]);
				if ($update){
					Banksoalujian::where('marking', $getcatatan->marking)->where('nomorpeserta', $getcatatan->noinduk)->update([
						'mulai'		=> $mulai,
						'selesai'	=> $akhir
					]);
					$keterangan = 'Lets Get Started';
				} else {
					$keterangan = 'Marking Aktif Gagal dilakukan, silahkan ulangi beberapa saat lagi';
				}
			} else {
				$keterangan = 'Marking Aktif Gagal dilakukan, Data Ujian tidak ditemukan';
			}
			$response = [
				'message'	=> $keterangan,
			];
			return response()->json($response, 200);
		} else {
			$getdata 	= Banksoal::where('id', $idsoal)->first();
			if (isset($getdata->id)){
				if ($kerja == 'input'){
					$cekid 	= Banksoaltest::where('marking', $marking)->first();
					if (isset($cekid->id)){
						$cekwes = Banksoaltest::where('marking', $marking)->where('idsoal', $idsoal)->count();
						if ($cekwes == 0){
							$cekidkosong 	= Banksoaltest::where('marking', $marking)->where('idsoal', 0)->first();
							if (isset($cekidkosong->id)){
								$update 	= Banksoaltest::where('id', $cekidkosong->id)->update([
									'ceel'			=> $cekid->ceel,
									'kode'			=> $cekid->kode,
									'idsupervisor'	=> $cekid->idsupervisor,
									'supervisor'	=> $cekid->supervisor,
									'tipe'			=> $cekid->tipe,
									'tanggal'		=> $cekid->tanggal,
									'idsoal'		=> $idsoal,
									'namaujian'     => $cekid->namaujian,
									'fullkode'      => $getdata->fullkode,
									'deskripsi'     => $getdata->deskripsi,
									'lampiran'      => $getdata->lampiran,
									'lampiran2'     => $getdata->lampiran2,
									'lampiran3'     => $getdata->lampiran3,
									'lampiran4'     => $getdata->lampiran4,
									'lampiran5'     => $getdata->lampiran5,
									'lampiran6'     => $getdata->lampiran6,
									'tipesoal'      => $getdata->jawaban,
									'opsia'         => $getdata->opsia,
									'opsib'         => $getdata->opsib,
									'opsic'         => $getdata->opsic,
									'opsid'         => $getdata->opsid,
									'opsie'         => $getdata->opsie,
									'opsif'         => $getdata->opsif,
									'opsig'         => $getdata->opsig,
									'opsih'         => $getdata->opsih,
									'opsii'         => $getdata->opsii,
									'opsij'         => $getdata->opsij,
									'opsik'         => $getdata->opsik,
									'opsil'         => $getdata->opsil,
									'opsim'         => $getdata->opsim,
									'opsin'         => $getdata->opsin,
									'opsio'         => $getdata->opsio,
									'opsip'         => $getdata->opsip,
									'opsiq'         => $getdata->opsiq,
									'opsir'         => $getdata->opsir,
									'opsis'         => $getdata->opsis,
									'opsit'         => $getdata->opsit,
									'kunci'         => $getdata->kunci,
									'status'        => $cekid->status,
									'pengumuman'    => $cekid->pengumuman,
									'mulai'         => $cekid->mulai,
									'selesai'       => $cekid->selesai,
									'timer'         => $cekid->timer,
									'marking'       => $cekid->marking,
									'updated_at'	=> date("Y-m-d H:i:s")
								]);
							} else {
								$update = Banksoaltest::create([
									'ceel'			=> $cekid->ceel,
									'kode'			=> $cekid->kode,
									'idsupervisor'	=> $cekid->idsupervisor,
									'supervisor'	=> $cekid->supervisor,
									'tipe'			=> $cekid->tipe,
									'tanggal'		=> $cekid->tanggal,
									'idsoal'		=> $idsoal,
									'fullkode'      => $getdata->fullkode,
									'namaujian'     => $cekid->namaujian,
									'deskripsi'     => $getdata->deskripsi,
									'lampiran'      => $getdata->lampiran,
									'lampiran2'     => $getdata->lampiran2,
									'lampiran3'     => $getdata->lampiran3,
									'lampiran4'     => $getdata->lampiran4,
									'lampiran5'     => $getdata->lampiran5,
									'lampiran6'     => $getdata->lampiran6,
									'tipesoal'      => $getdata->jawaban,
									'opsia'         => $getdata->opsia,
									'opsib'         => $getdata->opsib,
									'opsic'         => $getdata->opsic,
									'opsid'         => $getdata->opsid,
									'opsie'         => $getdata->opsie,
									'opsif'         => $getdata->opsif,
									'opsig'         => $getdata->opsig,
									'opsih'         => $getdata->opsih,
									'opsii'         => $getdata->opsii,
									'opsij'         => $getdata->opsij,
									'opsik'         => $getdata->opsik,
									'opsil'         => $getdata->opsil,
									'opsim'         => $getdata->opsim,
									'opsin'         => $getdata->opsin,
									'opsio'         => $getdata->opsio,
									'opsip'         => $getdata->opsip,
									'opsiq'         => $getdata->opsiq,
									'opsir'         => $getdata->opsir,
									'opsis'         => $getdata->opsis,
									'opsit'         => $getdata->opsit,
									'kunci'         => $getdata->kunci,
									'status'        => $cekid->status,
									'pengumuman'    => $cekid->pengumuman,
									'mulai'         => $cekid->mulai,
									'selesai'       => $cekid->selesai,
									'timer'         => $cekid->timer,
									'marking'       => $cekid->marking,
								]);
							}
							if ($update){
								$keterangan	= '';
								
								echo '<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-check"></i> Sucess.!</h4>
										Case Added to '.$cekid->namaujian.' ( '.$cekid->tipe.' )
									</div>';
							} else {
								echo '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-ban"></i> Error</h4>
										System Error, Please Try Again in a few minutes
									</div>';
							}
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Case ID =>, '.$idsoal.' Already Set
							</div>';
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Error, '.$marking.' Marking Not Valid
							</div>';	
					}
				} else {
					$cekid 	= Banksoaltest::where('marking', $marking)->first();
					if (isset($cekid->id)){
						$cekwes = Banksoaltest::where('marking', $marking)->count();
						if ($cekwes == 1){
							$update = Banksoaltest::where('marking', $marking)->where('idsoal', $idsoal)->update([
								'idsoal'	=> 0,
								'kode'		=> '',
								'fullkode'	=> '',
								'deskripsi'	=> '',
							]);
						} else {
							$update = Banksoaltest::where('marking', $marking)->where('idsoal', $idsoal)->delete();
						}
						if ($update){
							
							echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Sucess.!</h4>
									Case Remove From '.$cekid->namaujian.' ( '.$cekid->tipe.' )
								</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Error</h4>
									System Error, Please Try Again in a few minutes
								</div>';
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Error, '.$marking.' Marking Not Valid
							</div>';	
					}
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error</h4>
						Error, '.$idsoal.' ID Not Valid
					</div>';	
			}
		}
	}
	//new_fitur
	public function jsonUsercari (Request $request) {
        $tanggal    = $request->input('val01');
        $kelompok   = $request->input('val02');
        if ($kelompok == 'all'){
            $arraysurat = Datainduk::where('tamasuk', 'LIKE', $tanggal.'%')->orderBy('nama', 'ASC')->get();
        } else if ($kelompok == 'viewallnonpeserta'){
            $arraysurat = Datainduk::where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->whereNotIn('noinduk', Datanilai::where('marking', $tanggal)->pluck('noinduk'))->get();
        } else {
            $arraysurat = Datainduk::where('tamasuk', 'LIKE', $tanggal.'%')->orderBy('nama', 'ASC')->get();
        }
        echo json_encode($arraysurat);
    }
	public function jsonPesertaTest (Request $request) {
        $marking  	    = $request->input('val01');
		$arraysurat     = Datanilai::where('marking', $marking)->get();
        if (!empty($arraysurat)){
            echo json_encode($arraysurat);
        } else {
            $arraysurat = [];
            $sql        = Banksoaltest::where('marking', $marking)->get();
            if (!empty($sql)){
                foreach($sql as $rows){
                    $idmahasiswa    = $rows->idmahasiswa;
					$getskore = Banksoalujian::select(DB::raw('SUM(skore) as skore'))->where('marking', $rows->marking)->where('idmahasiswa', $rows->idmahasiswa)->groupBy('idmahasiswa')->first();
					if (isset($getskore->skore)){
						$jumlah		= $getskore->skore;
					} else { $jumlah = 0 ; }
                    Datanilai::where('noinduk', $idmsh)->where('marking', $rows->marking)->update([
                        'nilai'      => $jumlah,
                    ]);
                }
            }
            echo json_encode($arraysurat);
        }
	}
}