<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use App\Sekolah;
use App\Layanan;
use App\Pengumuman;
use App\Models\User;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Validator;
use Session;
use QrCode;
use PDF;
use Auth;
use Hash;
use PDFCREATOR;
use DateTime;
use FeedReader;
use Redirect;

class AuthController extends Controller
{
	public function viewAuth() {
		$domain 	= parse_url(request()->root())['host'];
		$cekteks 	= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		
        $previlage  = Session('previlage');
		if ($previlage !== null){
			$url = 'https://'.$domain.'/dashbord';
			return Redirect::to($url);
		} else {
			$sql = Sekolah::where('status',1)->get();
			if(!$sql){
				return view('accessdenided');	
			}
			$cekjumlah 			= count($sql);
			if ($cekjumlah == 1){
				$sql = Sekolah::where('status',1)->first();
				$url = 'https://'.$domain.'/frontpage?id='.$sql->id;
				return Redirect::to($url);
			} else {
				$data				= [];
				$data['sidebar']	= 'frontpage';
				$data['data']		= $sql;
				return view('landingpage', $data);
			}
		}
    }
	public function logout(Request $request) {
		$idsekolah = session('sekolah_id_sekolah');
        Auth::logout();
        $request->session()->regenerate();
		$request->session()->flush();
		if ($idsekolah == ''){
			return redirect('/');
		} else {
			return redirect('/frontpage?id='.$idsekolah);
		}
    }
	public function ubah_pass(Request $request){
        $key 	= $request->input('key');
        $decrip = SendMail::dekrip($key);
        $email 	= '';
        if($decrip == false){
            $validasi 	= false;
            $message 	= 'Invalid Key';
        } else{
            $data 		= explode('|', $decrip);
            $email 		= $data[0]; 
            $datetime 	= $data[1];
            $ver 		= $data[2];
            if($ver=='FOR'){
                $datenow 	= date('YmdHis');
                $now 		= strtotime($datenow);
                $time 		= strtotime($datetime);
                $res_time 	= $now-$time;
                $bataswaktu = 60*7;
                if($res_time>$bataswaktu){
                    $validasi 	= false;
                    $message 	= 'Waktu ubah password telah habis. Untuk mendapat email ubah password silahkan melakukan permintaan ubah password';
                }else{
                    $validasi 	= true;
                    $message 	= '';
                }
            }else{
                $validasi 		= false;
                $message 		= 'Invalid Key';
            }
        } 
        $data = array(
            'validasi' 	=> $validasi,
            'message' 	=> $message,
            'email' 	=> $email,
            'key' 		=> $key,
        );
    	return view('ubah_pass', $data);
    }
	public function proses_forget(Request $request){
        $email = $request->input('set01');
        $ceksek = explode('@', $email);
		if (isset($ceksek[1])){
			$cekuser = User::where('username', $email)->first();
			if (isset($cekuser->id)){
				$password 	= time();
				$update = User::where('id', $cekuser->id)->update([
					'password' 	=>  bcrypt($password),
				]);
				if ($update){
					SendMail::kirimUser($cekuser->nama, $email, $cekuser->username, $password, true);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Informasi Username dan Password Telah Kami Kirimkan ke Email Anda']);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Reset Gagal, Silahkan Hubungi Admin']);
					return back();
				}
			} else {
				$cekemail = User::where('email', $email)->count();
				if ($cekemail != 0){
					$password 	= time();
					$update 	= User::where('email', $email)->update([
						'password' =>  bcrypt($password),
					]);
					if ($update){
						SendMail::kirimUser($email, $email, 'Sesuai dengan Email yang tersimpan', $password, true);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Informasi Username dan Password Telah Kami Kirimkan ke Email Anda']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Reset Gagal, Silahkan Hubungi Admin']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Tidak di Temukan dalam database SCO, mohon coba cek email atau coba login sekali lagi']);
					return back();
				}	
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Tidak Valid, pastikan informasi email ditulis lengkap']);
			return back();
		}
    }
	public function exDaftarBaru(Request $request){
		$username 	= $request->input('val02');
		$email 		= $request->input('val03');
		$nohape 	= $request->input('val04');
		$fakultas 	= $request->input('val05');
		$cekdomain 	= explode('@', $email);
		if (isset($cekdomain[1])){
			$emaildomain = $cekdomain[1];
		} else {
			$emaildomain = '';
		}
		if ($emaildomain == 'yahoo.com' or $emaildomain == 'yahoo.co.id' OR $emaildomain == 'gmail.com' OR $emaildomain == 'sdtq-daarulukhuwwah.sch.id'){
			$ceksek 	= Sekolah::where('id', $fakultas)->first();
			if (isset($ceksek->id)){
				$tes1 = User::where('username', $email)->count();
				if ($tes1 != 0){
					$cek = User::where('username', $email)->first();
					if ($cek->status != 0){
						$response = [
							'status'  	=> 'Double Data',
							'message'  	=> 'Email Sudah Digunakan, Silahkan Gunakan Email Lain'
						];
						return response()->json($response, 200);
					} else {
						try {
							DB::beginTransaction();
							$user = User::create([
								'nama'      => $request->input('val01'),
								'username'  => $email,
								'email'     => $email,
								'nip'     	=> $request->input('val04'),
								'nik'     	=> $request->input('val02'),
								'firebaseid'=> $request->input('firebaseid'),
								'password'  => bcrypt(time()),
								'fakultas'  => $ceksek->kode_sekolah,
								'fakpanjang'=> $ceksek->nama_sekolah,
								'previlage' => 'ortu',
								'merangkap' => '',
								'status'	=> 0,
								'id_sekolah'=> $ceksek->id
							]);
							DB::commit();
							$response = [
								'status'	=> 'User Created Successfull',
								'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
								'warna'		=> 'success',
								'icon'		=> 'fa fa-check',
							];
							$tuliskirim = 'Mari Sambut Saudara '.$request->input('val01').' Yang Hari Ini Bergabung';
							SendMail::kirim($request->input('val03'),$request->input('val03'));
							SendMail::mobilenotif($ceksek->kode_sekolah,'all','Admin FireBase',$tuliskirim);
							return response()->json($response, 201);
						} catch (\Exception $e) {
							DB::rollback();
							$response = [
								'status'   	=> 'Transaction DB Error',
								'message' 	=> $e->getMessage()
							];
							return response()->json($response, 200);
						}
					}
				} else {
					try {
						DB::beginTransaction();
						$user = User::create([
							'nama'      => $request->input('val01'),
							'username'  => $email,
							'email'     => $email,
							'nip'     	=> $request->input('val04'),
							'nik'     	=> $request->input('val02'),
							'password'  => bcrypt(time()),
							'fakultas'  => $ceksek->nama_sekolah,
							'fakpanjang'=> $ceksek->nama_yayasan,
							'firebaseid'=> $request->input('firebaseid'),
							'previlage' => 'ortu',
							'merangkap' => '',
							'status'	=> 0,
							'id_sekolah'=> $ceksek->id
						]);
						SendMail::kirim($request->input('val03'),$request->input('val03'));
						DB::commit();
						$response = [
							'status'	=> 'User Created Successfull',
							'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
							'warna'		=> 'success',
							'icon'		=> 'fa fa-check',
						];
						$tuliskirim = 'Mari Sambut Saudara '.$request->input('val01').' Yang Hari Ini Bergabung';
						SendMail::mobilenotif($ceksek->id,'all','Admin FireBase',$tuliskirim);
						return response()->json($response, 201);
					} catch (\Exception $e) {
						DB::rollback();
						$response = [
							'status'   	=> 'Transaction DB Error',
							'message' 	=> $e->getMessage()
						];
						return response()->json($response, 200);
					}
					DB::rollback();
					$response = [
						'status'   	=> 'Transaction DB Error',
						'message'  	=> 'An Error Occured'
					];
					return response()->json($response, 200);
				}
			} else {
				$response = [
					'status'   	=> 'Permission Denied',
					'message'  	=> 'ID Sekolah Tidak di Temukan'
				];
				return response()->json($response, 200);
			}
		} else {
			$response = [
				'status'   	=> 'Permission Denied',
				'message'  	=> 'Email Domain ('.$emaildomain.') not Allowed'
			];
			return response()->json($response, 200);
		}
    }
	public function exResetPassword(Request $request){
        $email 		= $request->input('email');
		$homebase	= url("/");
		if ($email == 'setpassword'){
			$password1 	= $request->input('val02');
			$password2 	= $request->input('val03');
			$email 		= $request->input('val04');
			if ($user = User::where('email',$email)->orderBy('id', 'DESC')->first()) {
				if ($user->username == 'admin'){
					$response = [
						'message'       => 'Admin tidak boleh diubah passwordnya',
					];
					return response()->json($response, 200);
				} else {
					$input = User::where('id',$user->id)->update([
						'password'  => bcrypt($password1),
						'status'	=> 1
					]);
					$pesan = 'Verifikasi dan setting password telah disimpan';
					$response = [
						'message'		=> $pesan,
					];
					return response()->json($response,200);
				}
			} else {
				$response = [
					'message'       => 'Username/Email yang dimasukkan tidak ditemukan',
				];
				return response()->json($response, 200);
			}
		} else {
			$email = $request->input('val01');
			if ($user = User::where('email',$email)->first()) {
				if($user->previlage=='pendaftar'){
					return response()->json([
						'message'	=> 'User belum aktif/belum terverifikasi.',
					], 404);
				}
				if($user->previlage=='Arsip'){
					return response()->json([
						'message'	=> 'User Telah di Block. Hubungi Dinas terkait untuk mengaktifkan kembali',
					], 404);
				}
				SendMail::kirim($user->nama,$user->email,true);
				$response = [
					'message'		=> 'Verifikasi ubah password telah dikirim ke email',
				];
				return response()->json($response,200);
			} else {
				$response = [
					'message'       => 'Username/Email yang dimasukkan tidak ditemukan',
				];
				return response()->json($response, 404);        	
			}
			$response = [
				'message'			=> 'An Error Occured'
			];
			return response()->json($response, 500);
		}
    }
	public function verifikasi(Request $request){
        $key    	= $request->input('key');
		$nama 		= '';
		$email 		= '';
		$homebase	= url("/");
		$foto		= $homebase.'/mascot.png';
        if ($key == '' OR is_null($key)){
            $validasi 		= false;
            $message 		= 'Invalid Key';
        } else {
            $decrip = SendMail::dekrip($key);
            if($decrip==false){
                $validasi 	= false;
                $message 	= 'Invalid Key';
            }else{
                $data 		= explode('|', $decrip);
                $email 		= $data[0]; 
                $datetime 	= $data[1];
                $ver 		= $data[2];
                $user 		= User::where('email',$email)->orderBy('id', 'DESC')->first();
                $nama 		= $user->nama;
				if (is_null($user->photo)){
					$foto = $homebase.'/mascot.png';
				} else {
					$foto 	= $user->photo;
					if (File::exists(public_path().$foto)) {
						$foto = $homebase.$foto;
					} else if (File::exists(public_path() ."/images/pegawai/". $foto)) {
						$foto = $homebase.'/images/pegawai/'.$foto;
					} else {
						$foto = $homebase.'/mascot.png';
					}
				}
				if($ver=='VER'){
                    if($user->status == '1'){
						return redirect('/');
					}
                    $datenow    = date('YmdHis');
                    $now        = strtotime($datenow);
                    $time       = strtotime($datetime);
                    $res_time   = $now-$time;
                    $bataswaktu = 60*7;
					User::where('id',$user->id)->update(['status' => '1']);
					$validasi   = true;
                    $message    = 'Username/Email '.$email.' telah berhasil diverifikasi';
                }else{
                    $validasi = false;
                    $message = 'Invalid Key';
                }
            }
        }
        $data = array(
            'foto' 		=> $foto,
            'email' 	=> $email,
            'nama' 		=> $nama,
            'validasi' 	=> $validasi,
            'message' 	=> $message,
        );
    	return view('user_verifikasi-rita', $data);
    }
	public function exLogin(Request $request){
        $email    		= $request->input('email');
		$password   	= $request->input('password');
		$remember   	= $request->input('remember');
		$fakultas   	= $request->input('fakultas');
		$id_sekolah   	= $request->input('id_sekolah');
		
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		if ($request->input('firebaseid') !== null){
			$firebase   = $request->input('firebaseid');
		} else {
			$firebase   = '';
		}
		$user 		= User::where('email', $email)->where('id_sekolah', $id_sekolah)->first();       
		if ($user) {
			if (!Hash::check($password, $user->password)) {
				return response()->json([
					'message' => 'Password yang dimasukkan salah',
				], 500);
			}
			if($user->previlage=='Arsip'){
				return response()->json([
					'message' => 'User telah di block. Silahkan hubungi administrator',
				], 500);
			}
			if (isset($remember) OR $remember == 1){
				$remember = true;
			} else {
				$remember = false;
			}
			Auth::login($user, $remember);
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
			$foto 				= $user->photo;
			if ($foto == '' OR $foto == null){
				$foto = url("/").'/mascot.png';
			} else {
				if (File::exists(public_path() ."/images/pegawai/". $foto)) {
					$foto = url("/").'/images/pegawai/'.$foto;
				} else if (File::exists(public_path() ."/dist/img/foto/". $foto)) {
					$foto = url("/").'/dist/img/foto/'.$foto;
				} else {
					$foto = url("/").'/mascot.png';
				}
			}
			$sql = Sekolah::where('id', $id_sekolah)->first();
			if ($sql){
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
			} else {
				$getdomainid 		= DB::table('app_menu')->where('domain', $domain)->first();
				if (isset($getdomainid->id)){
					$ceklaman 					= $getdomainid->sequence;
					if ($ceklaman == 2){
						$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_bt;
					} else if ($ceklaman == 1){
						$lamanportal			= $getdomainid->route.$getdomainid->updated_bt;
					} else {
						$lamanportal			= $getdomainid->route;
					}
					$namaapps01  		= $getdomainid->name;
					$domainapps01  		= $getdomainid->domainapps;
					$subdomainapps01  	= $getdomainid->subdomainapps;
					$subsubdomainapps01 = $getdomainid->subsubdomainapps;
					$addressapps01  	= $getdomainid->addressapps;
					$kota01  			= $getdomainid->kota;
					$emailapps01  		= $getdomainid->emailapps;
					$lamanapps01  		= $getdomainid->route;
					$logofrontapps01  	= $getdomainid->logofrontapps;
					$theme01  			= $getdomainid->theme;
					$logo01  			= $getdomainid->logo;
					$lamanportal		= $lamanportal;
				}
			}
			if ($firebase != ''){
				$firebaseid = $firebase;
				User::where('id', $user->id)->update([
					'firebaseid'	=> $firebaseid
				]);
				$tuliskirim = 'Mari Sambut Saudara '.$user->nama.' Yang Hari Ini Bergabung';
				SendMail::mobilenotif($user->id_sekolah, 'all', 'Admin FireBase', $tuliskirim);
			} else {
				$firebaseid = $user->firebaseid;
			}
			session([
				'id'						=> $user->id,
				'nama' 	    				=> $user->nama,
				'username'					=> $user->username,
				'previlage'        			=> $user->previlage,
				'fakultas'					=> $subdomainapps01,
				'fakpanjang'				=> $subsubdomainapps01,
				'email'		    			=> $user->email,
				'nip'		    			=> $user->nip,
				'spesial'		   	 		=> $user->spesial,
				'fbid'		    			=> $firebaseid,
				'avatar'        			=> $foto,
				'sekolah_nama_aplikasi'  	=> $namaapps01,
				'sekolah_id_sekolah'  		=> $id_sekolah,
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
				'message'       => 'Email/Username ('.$email.') yang dimasukkan tidak ditemukan'.$id_sekolah,
			];
			return response()->json($response, 500);
		}
	
        $response = [
            'message'       => 'An Error Occured'
        ];
        return response()->json($response, 500);  
    }
	public function exLogout(Request $request){
		$idsekolah = session('sekolah_id_sekolah');
        Auth::logout();
        $request->session()->regenerate();
		$request->session()->flush();
		if ($idsekolah == ''){
			return redirect('/');
		} else {
			return redirect('/frontpage?id='.$idsekolah);
		}
    }
	public function getFirebaseaccount($id){
		$homebase	= url("/");
		$previlage  = Session('previlage');
		if ($previlage !== null){
			$url = $homebase.'/dashbord';
			return Redirect::to($url);
		} else {
			$firebaseid = $id;
			$domain 	= parse_url(request()->root())['host'];
			$cekteks 	= explode("/", $domain);
			if (isset($cekteks[1])){
				$domain	= $cekteks[0];
			}
			$getdomainid 	= DB::table('app_menu')->where('domain', $domain)->first();
			if (isset($getdomainid->id)){
				$ceklaman 			= $getdomainid->sequence;
				if ($ceklaman == 2){
					$lamanportal	= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
				} else if ($ceklaman == 1){
					$lamanportal	= $getdomainid->route.$getdomainid->updated_at;
				} else {
					$lamanportal	= $getdomainid->route;
				}
				$namaapps01  		= $getdomainid->name;
				$domainapps01  		= $getdomainid->domainapps;
				$subdomainapps01  	= $getdomainid->subdomainapps;
				$subsubdomainapps01 = $getdomainid->subsubdomainapps;
				$addressapps01  	= $getdomainid->addressapps;
				$kota01  			= $getdomainid->kota;
				$emailapps01  		= $getdomainid->emailapps;
				$lamanapps01  		= $getdomainid->route;
				$logofrontapps01  	= $getdomainid->logofrontapps;
				$lamanportal		= $lamanportal;
				$id_sekolah			= 1;
			} else {
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
				$id_sekolah			= config('global.id_sekolah');
			}
			$fakpanjang			= $subsubdomainapps01;
			$fakultas   		= $subdomainapps01;
			$sekolah_level 		= 2;
			$sekolah_nama_kasek	= '';
			$sekolah_nis		= '';
			$sekolah_nss		= '';
			$sekolah_npsn		= '';
			$sekolah_telp		= '';
			$sekolah_slogan		= '';
			$sekolah_logo		= '';
			$sql = Sekolah::where('id', $id_sekolah)->first();
			if ($sql){
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
				$user  		 	= User::where('firebaseid', $firebaseid)->first();
				if (isset($user->id)){
					Auth::login($user, true);
					$theme01			= 'Admin LT3';
					$foto 				= $user->photo;
					if ($foto == '' OR is_null($foto)){
						$foto = url("/").'/mascot.png';
					} else {
						if (File::exists(public_path() ."/images/pegawai/". $foto)) {
							$foto = url("/").'/images/pegawai/'.$foto;
						} else if (File::exists(public_path() ."/dist/img/foto/". $foto)) {
							$foto = url("/").'/dist/img/foto/'.$foto;
						} else {
							$foto = url("/").'/mascot.png';
						}
					}
					session([
						'id'						=> $user->id,
						'nama' 	    				=> $user->nama,
						'username'					=> $user->username,
						'previlage'        			=> $user->previlage,
						'fakultas'					=> $subdomainapps01,
						'fakpanjang'				=> $subsubdomainapps01,
						'email'		    			=> $user->email,
						'nip'		    			=> $user->nip,
						'spesial'		   	 		=> $user->spesial,
						'fbid'		    			=> $user->firebaseid,
						'avatar'        			=> $foto,
						'sekolah_nama_aplikasi'  	=> $namaapps01,
						'sekolah_id_sekolah'  		=> $id_sekolah,
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
					$url = 'https://'.$domain.'/dashbord';
					return Redirect::to($url);
				} else {
					$profile 				= '';
					$visimisi 				= '';
					$strukturorganisasi 	= '';
					$pendidik 				= '';
					$jadwal 				= '';
					$kontak 				= '';
					$sertamerta 			= '';
					$setiapsaat 			= '';
					$pengumuman 			= '';
					$getdata 				= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id_sekolah)->get();
					if (!empty($getdata)){
						foreach ($getdata as $rlayanan){
							$status 		= $rlayanan->status;
							$layanan 		= $rlayanan->layanan;
							if ($layanan == 'profile') { $profile = $status; }
							if ($layanan == 'visimisi') { $visimisi = $status; }
							if ($layanan == 'strukturorganisasi') { $strukturorganisasi = $status; }
							if ($layanan == 'pendidik') { $pendidik = $status; }
							if ($layanan == 'jadwal') { $jadwal = $status; }
							if ($layanan == 'kontak') { $kontak = $status; }
							if ($layanan == 'sertamerta') { $sertamerta = $status; }
							if ($layanan == 'setiapsaat') { $setiapsaat = $status; }
						}
					}
					$groups     = Pengumuman::where('id_sekolah', $id_sekolah)->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
					$y      	= 0;
					$x      	= 0;
					foreach ($groups as $group) {
						$tanggal    = $group->tanggal;
						$rsurat     = Pengumuman::where('id_sekolah', $id_sekolah)->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
						foreach ($rsurat as $rowpeng) {
							$id             =   $rowpeng->id;
							$jenis          =   $rowpeng->jenis;
							$siapa          =   $rowpeng->siapa;
							$nim            =   $rowpeng->nim;
							$pengumuman     =   $rowpeng->pengumuman;   
							$created_at     =   $rowpeng->kapan;
							$kapan          =   SendMail::timeago($created_at);
							if ($jenis == 'mahasiswa') { 
								$nama 		= $siapa.'('.$nim.')';
								$iconne 	= 'fa-user';
								$jencolor 	= 'green';
							} else { 
								$nama 		= $siapa; 
								$iconne 	= 'fa-bullhorn';
								$jencolor 	= 'red';
							}
							$data['pengumumans'][$x]['id']          =   $id;
							$data['pengumumans'][$x]['tanggal']     =   $tanggal;
							$data['pengumumans'][$x]['kapan']       =   $kapan;
							$data['pengumumans'][$x]['jencolor']    =   $jencolor;
							$data['pengumumans'][$x]['jenis']       =   $jenis;
							$data['pengumumans'][$x]['siapa']       =   $siapa;
							$data['pengumumans'][$x]['pengumuman']  =   $pengumuman;
							$data['pengumumans'][$x]['icon']        =   $iconne;
							$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
							$data['pengumumans'][$x]['urutanbg'] 	=   $urutanbg[$y];
							if ($y == 9) {
								$y = 0; 
							} else {
								$y++; 
							}
							$x++;
						}
					}
					$data['firebaseid']			= $firebaseid;
					$data['sidebar']			= 'frontpage';
					$data['profile']			= $profile;
					$data['visimisi']			= $visimisi;
					$data['strukturorganisasi']	= $strukturorganisasi;
					$data['pendidik']			= $pendidik;
					$data['jadwal']				= $jadwal;
					$data['kontak']				= $kontak;
					$data['sertamerta']			= $sertamerta;
					$data['setiapsaat']			= $setiapsaat;
					$data['pengumuman']			= $pengumuman;
					$data['id_sekolah']			= $id_sekolah;
					$data['nama_yayasan']		= $sql->nama_yayasan;
					$data['nama_sekolah']		= $sql->nama_sekolah;
					$data['kode_sekolah']		= $sql->kode_sekolah;
					$data['nis']				= $sql->nis;
					$data['nss']				= $sql->nss;
					$data['npsn']				= $sql->npsn;
					$data['alamat']				= $sql->alamat;
					$data['kota']				= $sql->kota;
					$data['telp']				= $sql->telp;
					$data['email']				= $sql->email;
					$data['slogan']				= $sql->slogan;
					$data['logo']				= $sql->logo;
					$data['frontpage']			= $sql->frontpage;
					$data['domain']				= $sql->domain;
					return view('simaster.default', $data);
				}
			} else {
				return redirect('/');
			}
		}
    }
	public function authenticatekhusus($id){
		$data		= [];
        $user 		= User::where('email', $id)->orWhere('username', $id)->first();       
		$domain		= parse_url(request()->root())['host'];
		$cekteks	= explode("/", $domain);
		$homebase	= url("/");
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
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
		if (isset($user->previlage) AND Session('id') == '1') {
			Auth::logout();
			Auth::login($user, true);
			$user 				= $request->user();
			$tokenResult   	 	= $user->createToken('Personal Access Token');
			$token          	= $tokenResult->token;
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
			$foto 				= $user->photo;
			if ($foto == '' OR is_null($foto)){
				$foto = url("/").'/mascot.png';
			} else {
				if (File::exists(public_path() ."/images/pegawai/". $foto)) {
					$foto = url("/").'/images/pegawai/'.$foto;
				} else if (File::exists(public_path() ."/dist/img/foto/". $foto)) {
					$foto = url("/").'/dist/img/foto/'.$foto;
				} else {
					$foto = url("/").'/mascot.png';
				}
			}
			$token->expires_at 	= Carbon::now()->addDay(1);
			$token->save();
			$sql = Sekolah::where('id', $idsekolah)->first();
			if ($sql){
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
			} else {
				$getdomainid 		= DB::table('app_menu')->where('domain', $domain)->first();
				if (isset($getdomainid->id)){
					$ceklaman 					= $getdomainid->sequence;
					if ($ceklaman == 2){
						$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_bt.$firebaseid;
					} else if ($ceklaman == 1){
						$lamanportal			= $getdomainid->route.$getdomainid->updated_bt.$firebaseid;
					} else {
						$lamanportal			= $getdomainid->route;
					}
					$namaapps01  		= $getdomainid->name;
					$domainapps01  		= $getdomainid->domainapps;
					$subdomainapps01  	= $getdomainid->subdomainapps;
					$subsubdomainapps01 = $getdomainid->subsubdomainapps;
					$addressapps01  	= $getdomainid->addressapps;
					$kota01  			= $getdomainid->kota;
					$emailapps01  		= $getdomainid->emailapps;
					$lamanapps01  		= $getdomainid->route;
					$logofrontapps01  	= $getdomainid->logofrontapps;
					$theme01  			= $getdomainid->theme;
					$logo01  			= $getdomainid->logo;
					$lamanportal		= $lamanportal;
				}
			}
			session([
				'id'						=> $user->id,
				'nama' 	    				=> $user->nama,
				'username'					=> $user->username,
				'previlage'        			=> $previlage,
				'fakultas'					=> $subdomainapps01,
				'fakpanjang'				=> $subsubdomainapps01,
				'email'		    			=> $user->email,
				'nip'		    			=> $user->nip,
				'spesial'		   	 		=> $user->spesial,
				'fbid'		    			=> $user->firebaseid,
				'avatar'        			=> $foto,
				'sekolah_nama_aplikasi'  	=> $namaapps01,
				'sekolah_id_sekolah'  		=> $idsekolah,
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
				'sekolah_logo'				=> $logo01,
				'sekolah_frontpage'			=> $logofrontapps01,
				'token'						=> $tokenResult->accessToken,
			]);
			return redirect('/');
		} else {
			$data['judulpesan']			= 'Gagal Render';
			$data['kalimatheader']		= 'Mohon Maaf';
			$data['kalimatbody']		= 'ID :'.$id.' / '.Session('id').' FILE TIDAK DITEMUKAN, SILAHKAN HUBUNGI ADMIN / REFRESH HALAMAN INI';
			return view('errors.pesanerror', $data);
		}
	}
}
