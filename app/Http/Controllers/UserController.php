<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SendMail;
use App\Http\Controllers\Sco\NotifikasiController;
use App\Sekolah;
use App\Models\User;
use App\Pejabatsurat;
use App\Histories;
use App\Simpegpegawai;
use App\Filess;
use App\Detailpegawai;
use App\Dataindukstaff;
use App\Datainduk;
use App\Penerimasurat;
use App\WebinarEventlist;
use App\Suratmasuk;
use App\Suratkeluar;
use App\Suratkeluartnpnomor;
use App\Inboxsurat;
use App\Banksoalpeserta;
use App\Banksoalujian;
use App\Models\Tabelskdanperaturan;
use App\Models\Draftsk;
use App\Models\Golongan;
use App\Models\Kelompoklain;
use App\Models\KLasifikasikepakaran;
use App\Models\Detailpendidikan;
use App\Models\Detaildiklat;
use App\Models\Detailsertifikat;
use App\Models\Detailasesor;
use App\Models\Detailorganisasi;
use App\Models\Detailseminar;
use App\Models\Detailanggotakeluarga;
use App\Models\Detailmutasi;
use App\Models\Detailidentitas;
use App\Models\Detailpangkat;
use App\Models\Detailfungsional;
use App\Models\Detailsertifikasi;
use App\Models\Detailgaji;
use App\Models\Detailpenghargaan;
use App\Models\MasterPS;
use App\Models\Templateskpp;
use Carbon\Carbon;
use Gufy\PdfToHtml\Html;
use Gufy\PdfToHtml\Pdf;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Tcpdf\Fpdi;
use simplehtmldom\HtmlWeb;
use Validator;
use Session;
use QrCode;
use Auth;
use Hash;
use DateTime;
use FeedReader;
use Redirect;
use PDFCREATOR;
use Browser;

class UserController extends Controller
{
	public function viewUser() {
		$data   				= [];
		$iduser					= Session('id');
		$getdatauser			= User::where('id', $iduser)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		$data['datauser']		= $getdatauser;
		$data['jpegawai']		= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->get();
		$data['tahunne']		= date("Y");
		$data['tanggal']		= date("Y-m-d");
		if (Session('previlage') == 'level0' OR Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
			$data['sidebar']	= 'useranyar';
			return view('simaster.useranyar', $data);
		} else {
			return redirect('profiluser');
		}
    }
	public function getAllusername() {
		$arrrekap 	= [];
		if (Session('previlage') == 'adminzis'){
			$getallthn 	= User::where('previlage', 'adminzis')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		} else if (Session('previlage') == 'ortu'){
			$getallthn 	= User::where('previlage', 'ortu')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		} else {
			if (Session('username') == 'admin'){
				$getallthn 	= User::all();
			} else {
				if (session('sekolah_id_sekolah') !== null AND session('sekolah_id_sekolah') != '0'){
					$getallthn 	= User::where('previlage', '!=', 'level0')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				} else {
					$getallthn 	= User::where('fakultas', Session('fakultas'))->get();
				}
			}
		}
		echo json_encode($getallthn);
	}
	public function exUsername(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'val01' =>  'required',
			'val02' =>  'required',
			'val04' =>  'required',
        ]);
        if($validator->fails()) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Semua Form Wajib Terisi']);
			return back();
        } else {
			$idne 		= $request->input('val01');
			$nama 		= $request->input('val02');
			$password	= $request->input('val03');
			$username	= $request->input('val04');
			$password2	= $request->input('val05');
			$level		= $request->input('val06');
			if ($username == 'hapus'){
				$cekuser 	= User::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Penghapusan Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
				return back();
				
			} else if ($username == 'paguyuban'){
				$cekuser 	= User::where('id', $idne)->first();
				if (isset($cekuser->id)){
					$spesial 	= $cekuser->spesial;
					if ($spesial == '' OR is_null($spesial)){
						$spesial = 'paguyuban';
					} else {
						$spesial = '';
					}
					$update 	= User::where('id', $idne)->update([
						'spesial'	=> $spesial
					]);
					if ($update){
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Update Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ada yg diubah']);
						return back(); 	
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ditemukan']);
					return back();
				}
			} else if ($username == 'lupa'){
				$cekuser 	= User::where('id', $idne)->first();
				if (isset($cekuser->id)){
					$update = User::where('id', $idne)->update([
						'status'	=> 2
					]);
					if ($update){
						SendMail::kirim($cekuser->nama,$cekuser->email);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Link Password an. '.$nama.' Dengan Username '.$username.' Sukses di kirim ke email']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ada yg diubah']);
						return back(); 	
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ditemukan']);
					return back();
				}
			} else {
				if ($password == '' OR $username == '' OR $nama == ''){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Semua Form Wajib di Isi']);
					return back(); 
				} else if ($password != $password2){
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Password Pertama dan Kedua Tidak Cocok']);
					return back(); 
				} else {
					$getnama 	= Dataindukstaff::where('niy', $nama)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($getnama->nama)){
						$niy 	= $nama;
						$nama 	= $getnama->nama;						
					} else {
						$niy 	= '123456789';
					}
					if ($idne == 'new'){
						$cekuser 	= User::where('username', $username)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					} else {
						$cekuser 	= User::where('username', $username)->where('id', '!=', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					}
					if ($cekuser == 0){
						if ($idne == 'new'){
							if (Session('previlage') == 'level1'){
								$user = User::create([
									'nama'      	=>  $nama,
									'username' 		=>  $username,
									'password' 		=>  bcrypt($password),
									'previlage' 	=> 	$level,
									'nip' 			=> 	$niy,
									'fakultas' 		=>  Session('sekolah_kode_sekolah'),
									'fakpanjang' 	=>  Session('sekolah_nama_sekolah'),
									'id_sekolah'	=>  Session('sekolah_id_sekolah'),
									'email'			=>	$username
								]);
								return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Pendaftaran Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
								return back();
							} else if (Session('previlage') == 'adminzis'){
								$user = User::create([
									'nama'      	=>  $nama,
									'username' 		=>  $username,
									'password' 		=>  bcrypt($password),
									'previlage' 	=> 	'adminzis',
									'nip' 			=> 	$niy,
									'fakultas' 		=>  Session('sekolah_kode_sekolah'),
									'fakpanjang' 	=>  Session('sekolah_nama_sekolah'),
									'id_sekolah'	=>  Session('sekolah_id_sekolah'),
									'email'			=>	$username
								]);
								return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Pendaftaran Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Lakukan']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Anda Tidak Berhak Menambahkan Akun']);
								return back();
							}
						} else {
							if (Session('previlage') == 'level1'){
								User::where('id', $idne)->update([
									'nama'      	=>  $nama,
									'username' 		=>  $username,
									'password' 		=>  bcrypt($password),
									'previlage' 	=> 	$level,
									'nip' 			=> 	$niy,
								]);
							} else {
								User::where('id', $idne)->update([
									'nama'      	=>  $nama,
									'username' 		=>  $username,
									'password' 		=>  bcrypt($password),
									'nip' 			=> 	$niy,
								]);
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Pendaftaran Akun Untuk '.$nama.' Dengan Username '.$username.' Sukses di Ubah']);
							return back();
						}						
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Username telah digunakan, silahkan gunakan username yang lain.']);
						return back(); 
					}
				}
			}
        }
    }
	public function exDaftarortu(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'nama' 		=>  'required',
			'set01' 	=>  'required',
			'set02' 	=>  'required',
			'set03' 	=>  'required',
			'id_sekolah'=>  'required',
        ]);
		if($validator->fails()) {
			return response(['status' => true, 'icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Form Wajib (Nama, Email, Password) Tidak Boleh Kosong']);
		} else {
			$email 		= $request->input('set01');
			$pass1 		= $request->input('set02');
			$pass2		= $request->input('set03');
			$noinduk1	= $request->input('set04');
			$noinduk2	= $request->input('set05');
			$noinduk3	= $request->input('set06');
			$noinduk4	= $request->input('set07');
			$noinduk5	= $request->input('set08');
			$noinduk6	= $request->input('set09');
			$ttl1		= $request->input('set10');
			$ttl2		= $request->input('set11');
			$ttl3		= $request->input('set12');
			$ttl4		= $request->input('set13');
			$ttl5		= $request->input('set14');
			$ttl6		= $request->input('set15');
			$nama		= $request->input('nama');
			$boleh 		= 0;
			if ($noinduk1 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk1)->where('tgllahir', $ttl1)->count();
			}
			if ($noinduk2 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk2)->where('tgllahir', $ttl2)->count();
			}
			if ($noinduk3 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk3)->where('tgllahir', $ttl3)->count();
			}
			if ($noinduk4 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk4)->where('tgllahir', $ttl4)->count();
			}
			if ($noinduk5 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk5)->where('tgllahir', $ttl5)->count();
			}
			if ($noinduk6 != '' AND $boleh == 0){
				$boleh	= Datainduk::where('noinduk', $noinduk6)->where('tgllahir', $ttl6)->count();
			}
			if ($boleh == 0){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon masukkan Noinduk dan Tanggal Lahir anak anda dengan benar.'], 500);
			} else if ($pass1 != $pass2){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Password Pertama dan Kedua Tidak Cocok'], 500);
			} else {
				$sql 		= Sekolah::where('id', $request->input('id_sekolah'))->first();
				$cekuser 	= User::where('username', $email)->count();
				if ($cekuser == 0 AND isset($sql->id)){
					$getid 	= User::orderBy('id', 'DESC')->first();
					$idne 	= $getid->id;
					$idne 	= $idne + 1;
					try {
						$input 	= User::create([
							'id'			=> 	$idne,
							'nama'      	=>  $nama,
							'username' 		=>  $email,
							'password' 		=>  bcrypt($pass1),
							'previlage' 	=> 	'ortu',
							'nip' 			=> 	$idne,
							'fakultas' 		=>  $sql->nama_sekolah,
							'fakpanjang' 	=>  $sql->nama_yayasan,
							'email' 		=>  $email,
							'status'		=> 	1,
							'merangkap' 	=> 	'',
							'id_sekolah'	=>  $request->input('id_sekolah'),
							'firebaseid'	=>  $request->input('firebaseid'),
						]);
						if ($input){
							$pesan = '';
							if ($noinduk1 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk1)->where('tgllahir', $ttl1)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk1)->where('tgllahir', $ttl1)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk1.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk2 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk2)->where('tgllahir', $ttl2)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk2)->where('tgllahir', $ttl2)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk2.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk3 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk3)->where('tgllahir', $ttl3)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk3)->where('tgllahir', $ttl3)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk3.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk4 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk4)->where('tgllahir', $ttl4)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk4)->where('tgllahir', $ttl4)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk4.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk5 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk5)->where('tgllahir', $ttl5)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk5)->where('tgllahir', $ttl5)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk5.' Telah terhubung dengan akun anda<br />';
								}
							}
							if ($noinduk6 != ''){
								$boleh	= Datainduk::where('noinduk', $noinduk6)->where('tgllahir', $ttl6)->count();
								if ($boleh == 1){
									Datainduk::where('noinduk', $noinduk6)->where('tgllahir', $ttl6)->update([
										'kodeortu' => $idne
									]);
									$pesan = $pesan.'Noinduk '.$noinduk6.' Telah terhubung dengan akun anda<br />';
								}
							}
							$getnotif 	= User::where('fakultas', $sql->nama_sekolah)->orWhere('username', 'admin')->get();
							$tuliskirim = 'Mari Sambut Saudara '.$nama.' Yang Hari Ini Bergabung';
							foreach ( $getnotif as $rtokencari ){
								$firebaseid = $rtokencari->firebaseid;
								if ($firebaseid != '' AND !is_null($firebaseid)){
									$msg = array (
										'message' 	=> $tuliskirim,
										'title'		=> 'DUIDEV',
										'subtitle'	=> 'Software House',
										'tickerText'=> 'New User Notification',
										'image'		=> '',
										'vibrate'	=> 1,
										'sound'		=> 1,
										'largeIcon'	=> 'large_icon',
										'smallIcon'	=> 'small_icon'
									);
									$fields = array
									(
										'to' 			=> $firebaseid,
										'priority'		=> 'high',
										'notification' 	=> [
											"title" => 'SCO UB',
											"sound" => "default",
											"body" 	=> $tuliskirim
										],
										'data'			=> $msg
										
									);
									$headers = array
									(
										'Authorization: key=' . config('global.API_ACCESS'),
										'Content-Type: application/json'
									);
									$url = 'https://fcm.googleapis.com/fcm/send';
									$ch = curl_init();
								
									// Set the url, number of POST vars, POST data
									curl_setopt($ch, CURLOPT_URL, $url);
								
									curl_setopt($ch, CURLOPT_POST, true);
									curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								
									// Disabling SSL Certificate support temporarly
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
									curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
									curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
									curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
								
									// Execute post
									$result = curl_exec($ch);
									curl_close($ch);
								}
							}
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Success', 'message' => 'Pendaftaran Sukses, silahkan anda login.<br />'.$pesan], 200);
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Database error, silahkan coba beberapa saat lagi'], 500);
						}
					} catch (\Exception $e) {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $e->getMessage()], 500);
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email sudah terdaftar, silahkan gunakan email lain atau gunakan fasilitas recovery password atau hubungi tim TI untuk reset password'], 200);
				}
			}
        }
    }
	public function exProfileupdate(Request $request) {
    	$validator  =   Validator::make($request->all(), [
            'val01' =>  'required',
			'val02' =>  'required',
			'val03' =>  'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 'Error.!', 'message' => 'Semua Form Wajib di Isi']);
			return back();
        } else {
			$nip 		= $request->input('val01');
			$gol 		= $request->input('val02');
			$email		= $request->input('val03');
			$username	= $request->input('val08');
			$pass1		= $request->input('val09');
			$pass2		= $request->input('val10');
			$nama		= $request->input('val11');
			$nip 		= preg_replace('/\s+/', '', $nip);
			$cekttd		= $request->input('val06');
			$cekparaf	= $request->input('val07');
			$idne		= Session('id');
			$getalldata = User::where('id', $idne)->first();
			$idpeg		= $getalldata->id;
			$jabatan	= $getalldata->previlage;
			$fakultas	= $getalldata->fakultas;
			$fakpanjang	= $getalldata->fakpanjang;
			if ($cekttd == 'uploadttd'){
				if($request->hasFile('val04')) {
					$ImageExt	= $request->file('val04')->getClientOriginalExtension();
					$file_tmp	= $request->file('val04');
					$data 		= file_get_contents($file_tmp);
					$ttd 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
				} else {
					$ttd 		= '';
				}
			} else {
				$ttd		= $request->input('val04');
			}
			if ($cekparaf == 'uploadparaf'){
				if($request->hasFile('val05')) {
					$ImageExt	= $request->file('val05')->getClientOriginalExtension();
					$file_tmp2	= $request->file('val05');
					$data2 		= file_get_contents($file_tmp2);
					$paraf 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data2);
				} else {
					$paraf 		= '';
				}
			} else {
				$paraf		= $request->input('val05');
			}
			if ($ttd != ''){
				User::where('id', $idne)->update([
					'tandatangan'	=> $ttd,
				]);
			}
			if ($paraf != ''){
				User::where('id', $idne)->update([
					'paraf'			=> $paraf
				]);
			}
			$bolehganti = 'YES';
			if ($username != ''){
				$cekuser 	= User::where('username', $username)->where('id', '!=', $idne)->count();
				if ($cekuser == 0){
					$bolehganti = 'YES';
				} else {
					$bolehganti = 'NO';
				}
			} else {
				$bolehganti = 'NO';
			}
			if ($bolehganti == 'YES'){
				if ($pass1 != ''){
					if ($pass1 == $pass2){
						$bolehganti = 'YES';
					} else {
						$bolehganti = 'NO';
					}
				} else {
					$bolehganti = 'NO';
				}
			}
			if ($nama == ''){
				$bolehganti == 'NO';
			}
			if ($bolehganti == 'NO'){
				return response()->json(['status' => 'error', 'message' => 'Nama, Username dan Password Anda Belum di isi']);
				return back();
			} else {
				User::where('id', $idne)->update([
					'nama' 			=> $nama,
					'username' 		=> $username,
					'password' 		=> bcrypt($pass1),
					'nip' 			=> $nip,
					'golongan' 		=> $gol,
					'email'			=> $email,
				]);
				$cekdata 	= User::where('id', $idne)->first();
				$nama 		= $cekdata->nama;
				$nip 		= $cekdata->nip;
				$golongan	= $cekdata->golongan;
				$email		= $cekdata->email;
				$tandatangan= $cekdata->tandatangan;
				$paraf		= $cekdata->paraf;
				if ($nip == ''){
					return response()->json(['status' => 'error', 'message' => 'NIP Anda Belum di isi']);
					return back();
				} else if ($email == ''){
					return response()->json(['status' => 'error', 'message' => 'Email Anda Belum di isi']);
					return back();
				} else {
					return response()->json(['status' => 'Success.!', 'message' => 'Update Data Induk Sukses']);
					return back();
				}
			}
        }
    }
	public function viewDataInduk(){
		$data						= [];
		$data['tahunne']			= date("Y");
		$data['tanggal']			= date("Y-m-d");
		$data['sidebar']			= 'dataindukstaff';
		$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$data['domainapps01']  		= Session('sekolah_nama_yayasan');
		$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
		$data['addressapps01']  	= Session('sekolah_alamat');
		$data['emailapps01']  		= Session('sekolah_email');
		$data['lamanapps01']  		= parse_url(request()->root())['host'];
		$data['logofrontapps01']  	= Session('sekolah_frontpage');
		$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		if (Session('previlage') !== null){
			$data['user']  			= User::where('username', Session('username'))->first();
			$data['datastaf']  		= Dataindukstaff::where('niy', Session('nip'))->first();
			return view('simaster.profil', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Session Expired, Please Relogin';
            return view('errors.notready', $data);
        }
	}
	public function exEditProfil(Request $request){
        $id = $request->input('val01');
		if ($id == 'resetpassword'){
			$id 		= $request->input('val04');
			$password 	= $request->input('val02');
			try {
				DB::beginTransaction();
				DB::table('users')->where('id', $id)->update([
					'password' => bcrypt($password),
				]);
				DB::commit();
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Password Berhasil di Ubah']);
				return back();
			} catch (\Exception $e) {
				DB::rollback();
				$pesan 		= $e->getMessage();
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
				return back();
			}
		} else if ($user = User::where('id', $id)->first()) {
			$niy 		= $request->input('val05');
			$username 	= $request->input('val03');
			if ($request->hasFile('file')) {
				$ekstensi		= $request->file('file')->getClientOriginalExtension();
				$ekstensi		= strtolower($ekstensi);
				if ($ekstensi == 'png' OR $ekstensi == 'jpg' OR $ekstensi == 'jpeg'){
					$namafile		= 'STAF-'.$niy.'.'.$request->file('file')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('file');
					Storage::putFileAs('dist/img/foto/',$uploadedFile,$namafile);
					Dataindukstaff::where('niy', $niy)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
						'foto' => $namafile
					]);
					User::where('username', $username)->update([
						'photo' => $namafile,
					]);
				}
			}
			if ($request->hasFile('tandatangan')) {
				$ekstensi		= $request->file('tandatangan')->getClientOriginalExtension();
				$ekstensi		= strtolower($ekstensi);
				if ($ekstensi == 'png' OR $ekstensi == 'jpg' OR $ekstensi == 'jpeg'){
					$namafile		= 'ttd-'.$niy.'.'.$request->file('tandatangan')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('tandatangan');
					Storage::putFileAs('images/'.Session('id').'/',$uploadedFile,$namafile);
					User::where('username', $username)->update([
						'tandatangan' => 'images/'.Session('id').'/'.$namafile,
					]);
				}
			}
			try {
				DB::beginTransaction();
				DB::table('users')->where('username', $username)->update([
					'nama'	=> $request->input('val02'),
					'email' => $request->input('val06'),
				]);
				DB::commit();
				echo 'User Data Updated';
			} catch (\Exception $e) {
				DB::rollback();
				$pesan 		= $e->getMessage();
				echo $pesan;
			}
		} else {
			$response = [
				'status'	=> 'Update Gagal.!',
				'message'	=> 'ID '.$id.' Tidak Ditemukan',
				'type'		=> 'info'
			];
			return response()->json($response, 200);        	
		}
	}
}
