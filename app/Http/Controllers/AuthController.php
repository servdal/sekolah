<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Filesystem\Filesystem;
use App\Sekolah;
use App\Layanan;
use App\Pengumuman;
use App\XFiles;
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
use Illuminate\Support\Str;

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
			return redirect('/dashbord');
		} else {
			$sql = Sekolah::where('status',1)->get();
			if(!$sql){
				$data['kalimatheader']  	= 'Mohon Maaf';
				$data['kalimatbody']  		= 'Data Sekolah Tidak di Temukan, Hubungi Tim IT untuk menambahkan minimal 1 Data Sekolah pada tabel db_mstsekolah dengan status 1';
				return view('errors.notready', $data);
			}
			$cekjumlah 			= count($sql);
			if ($cekjumlah == 1){
				$sql = Sekolah::where('status',1)->first();
				return redirect('/frontpage?id='.$sql->id);
			} else {
				$data				= [];
				$data['sidebar']	= 'frontpage';
				$data['data']		= $sql;
				$data['firebaseid']	= '';
				return view('frontpage', $data);
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
        $request->validate([
			'set01' => ['required', 'email'],
		]);

		$email = $request->input('set01');
		$user = User::where('email', $email)->orWhere('username', $email)->first();
		if ($user && $user->previlage !== 'Arsip') {
			SendMail::kirim($user->nama, $user->email, true);
		}

		return response()->json([
			'icon' => 'success',
			'warna' => '#5ba035',
			'status' => 'Sukses',
			'message' => 'Jika email terdaftar, tautan ubah password akan dikirim.',
		]);
    }
	public function exDaftarBaru(Request $request){
		$request->validate([
			'val01' => ['required', 'string', 'max:255'],
			'val02' => ['required', 'string', 'max:100'],
			'val03' => ['required', 'email', 'max:255'],
			'val04' => ['nullable', 'string', 'max:50'],
			'val05' => ['required'],
		]);
		$username 	= $request->input('val02');
		$email 		= $request->input('val03');
		$nohape 	= $request->input('val04');
		$idsekolah 	= $request->input('val05');
		$cekdomain 	= explode('@', $email);
		if (isset($cekdomain[1])){
			$emaildomain = $cekdomain[1];
		} else {
			$emaildomain = '';
		}
		if ($emaildomain == 'yahoo.com' or $emaildomain == 'yahoo.co.id' OR $emaildomain == 'gmail.com' OR $emaildomain == 'sdtqdu.sch.id'){
			$ceksek 	= Sekolah::where('id', $idsekolah)->first();
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
							$user = User::where('username', $username)->update([
								'nama'      => $request->input('val01'),
								'email'     => $email,
								'nip'     	=> $request->input('val04'),
								'nik'     	=> $request->input('val02'),
								'firebaseid'=> $request->input('firebaseid'),
									'password'  => bcrypt(Str::random(40)),
								'fakultas'  => $ceksek->kode_sekolah,
								'fakpanjang'=> $ceksek->nama_sekolah,
								'previlage' => 'ortu',
								'id_sekolah'=> $ceksek->id
							]);
							DB::commit();
							$response = [
								'status'	=> 'User Updated Successfull',
								'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
								'warna'		=> 'success',
								'icon'		=> 'fa fa-check',
							];
							$tuliskirim = 'an '.$request->input('val01').' memperbaharui pendaftaran akunnya, mohon sampaikan ke yang bersangkutan untuk cek email untuk proses pembuatan passwordnya';
							SendMail::kirim($request->input('val03'),$request->input('val03'));
							event(new \App\Events\NotifController($tuliskirim));
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
								'password'  => bcrypt(Str::random(40)),
							'fakultas'  => $ceksek->nama_sekolah,
							'fakpanjang'=> $ceksek->nama_yayasan,
							'firebaseid'=> $request->input('firebaseid'),
							'previlage' => 'ortu',
							'merangkap' => '',
							'status'	=> 0,
							'id_sekolah'=> $ceksek->id
						]);
						DB::commit();
						SendMail::kirim($request->input('val03'),$request->input('val03'));
						$tuliskirim = 'Mari Sambut Saudara '.$request->input('val01').' Yang Hari Ini Bergabung';
						SendMail::mobilenotif($ceksek->id,'all','Admin FireBase',$tuliskirim);
						$response = [
							'status'	=> 'User Created Successfull',
							'message'	=> 'Silahkan Melanjutkan ke Email Anda Untuk Aktivasi',
							'warna'		=> 'success',
							'icon'		=> 'fa fa-check',
						];
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
        $mode 		= $request->input('email');
		if ($mode == 'setpassword'){
			$password1 	= $request->input('val02');
			$password2 	= $request->input('val03');
			$email 		= $request->input('val04');
			$token      = $request->input('val05');
			$purpose    = $request->input('val06', 'verify');

			$validated = validator([
				'password' => $password1,
				'password_confirmation' => $password2,
				'email' => $email,
				'token' => $token,
				'purpose' => $purpose,
			], [
				'password' => ['required', 'string', 'min:8', 'confirmed'],
				'email' => ['required', 'email'],
				'token' => ['required', 'string'],
				'purpose' => ['required', 'in:verify,reset'],
			]);

			if ($validated->fails()) {
				return response()->json([
					'message' => $validated->errors()->first(),
				], 422);
			}

			$user = User::where('email',$email)->orderBy('id', 'DESC')->first();
			if (! $user) {
				return response()->json([
					'message' => 'Token reset password tidak valid atau sudah kedaluwarsa.',
				], 422);
			}

			$tokenRow = DB::table('user_action_tokens')
				->where('email', $email)
				->where('purpose', $purpose)
				->where('token_hash', hash('sha256', $token))
				->whereNull('used_at')
				->where('expires_at', '>=', now())
				->latest('id')
				->first();

			if (! $tokenRow) {
				return response()->json([
					'message' => 'Token reset password tidak valid atau sudah kedaluwarsa.',
				], 422);
			}

			User::where('id',$user->id)->update([
				'password'  => bcrypt($password1),
				'status'	=> 1,
				'remember_token' => Str::random(60),
			]);

			DB::table('user_action_tokens')
				->where('id', $tokenRow->id)
				->update([
					'used_at' => now(),
					'updated_at' => now(),
				]);

			return response()->json([
				'message' => 'Password berhasil disimpan. Silahkan login.',
			],200);
		} else {
			$email = $request->input('val01');
			if ($email && ($user = User::where('email',$email)->first())) {
				if($user->previlage !== 'Arsip'){
					SendMail::kirim($user->nama,$user->email,true);
				}
			}

			return response()->json([
				'message' => 'Jika email terdaftar, tautan ubah password akan dikirim.',
			],200);
		}
    }
	public function verifikasi(Request $request){
        $token    	= $request->input('token');
		$email      = $request->input('email');
		$purpose    = $request->input('purpose', 'verify');
		$nama 		= '';
		$homebase	= url("/");
		$foto		= $homebase.'/mascot.png';
        if ($token == '' || is_null($token) || $email == '' || is_null($email)){
            $validasi 		= false;
            $message 		= 'Token tidak valid.';
        } else {
			$user = User::where('email',$email)->orderBy('id', 'DESC')->first();
			$tokenRow = DB::table('user_action_tokens')
				->where('email', $email)
				->where('purpose', $purpose)
				->where('token_hash', hash('sha256', $token))
				->whereNull('used_at')
				->where('expires_at', '>=', now())
				->latest('id')
				->first();

            if(! $user || ! $tokenRow){
                $validasi 	= false;
                $message 	= 'Token tidak valid atau sudah kedaluwarsa.';
            } else {
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
				$validasi   = true;
                $message    = $purpose === 'reset'
					? 'Silahkan buat password baru Anda.'
					: 'Silahkan verifikasi akun dengan membuat password baru.';
            }
        }
        $data = array(
            'foto' 		=> $foto,
            'email' 	=> $email,
			'nama' 		=> $nama,
            'validasi' 	=> $validasi,
            'message' 	=> $message,
			'token'     => $token,
			'purpose'   => $purpose,
        );
    	return view('user_verifikasi', $data);
    }
	public function exLogin(Request $request){
		$request->validate([
			'email' => ['required', 'email'],
			'password' => ['required', 'string'],
		]);
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
		$user 		= User::where('email', $email)->first();
		if ($user) {
			if (!Hash::check($password, $user->password)) {
				return response()->json([
					'message' => 'Email atau password tidak valid.',
				], 422);
			}
			if($user->previlage=='Arsip'){
				return response()->json([
					'message' => 'Email atau password tidak valid.',
				], 422);
			}
			if (isset($remember) OR $remember == 1){
				$remember = true;
			} else {
				$remember = false;
			}
			Auth::login($user, $remember);
			$request->session()->regenerate();
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
			$cekidmark1 		= XFiles::where('xmarking', 'Foto-'.$user->username)->first();
			if (isset($cekidmark1->xfile)){
				$foto 			= $cekidmark1->xfile;
			} else {
				$foto 			= url('/').'/'.$logo01;
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
			Session::save();
			$response = [
				'message'       => 'User SignIn',
				'user'          => $user,
			];
			return response()->json($response, 200);
		} else {
			$response = [
				'message'       => 'Email atau password tidak valid.',
			];
			return response()->json($response, 422);
		}
	
        $response = [
            'message'       => 'An Error Occured'
        ];
        return response()->json($response, 500);  
    }
	public function getFirebaseaccount($id){
		$homebase	= url("/");
		$previlage  = Session('previlage');
		if ($previlage !== null){
			$url = $homebase.'/dashbord';
			return Redirect::to($url);
		} else {
			$domain				= str_replace('http://', '', $homebase);
			$domain				= str_replace('https://', '', $domain);
			$domain				= str_replace('/', '', $domain);
			$firebaseid 		= $id;
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
			$fakpanjang			= $subsubdomainapps01;
			$fakultas   		= $subdomainapps01;
			$sekolah_level 		= config('global.level_sekolah');
			$sekolah_nama_kasek	= '';
			$sekolah_nis		= '';
			$sekolah_nss		= '';
			$sekolah_npsn		= '';
			$sekolah_telp		= '';
			$sekolah_slogan		= '';
			$sekolah_logo		= '';
			$user  		 		= User::where('firebaseid', $firebaseid)->first();
			if (isset($user->id)){
				Auth::login($user, true);
				$sql = Sekolah::where('id', $user->id_sekolah)->first();
				if ($sql){
					$id_sekolah				= $sql->id;
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
				$theme01			= 'Admin LT3';
				$cekidmark1 		= XFiles::where('xmarking', 'Foto-'.$user->username)->first();
				if (isset($cekidmark1->xfile)){
					$foto 			= $cekidmark1->xfile;
				} else {
					$foto 			= url('/').'/'.$logo01;
				}
				session([
					'id'						=> $user->id,
					'nama' 	    				=> $user->nama,
					'username'					=> $user->username,
					'previlage'        			=> $user->previlage,
					'fakultas'					=> $user->fakultas,
					'fakpanjang'				=> $user->fakpanjang,
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
				Session::save();
				$url = 'https://'.$domain.'/dashbord';
				return Redirect::to($url);
			} else {
				$sql 			= Sekolah::where('status',1)->get();
				$cekjumlah		= count($sql);
				if ($cekjumlah == 0){
					$data['kalimatheader']  	= 'Mohon Maaf';
					$data['kalimatbody']  		= 'Data Sekolah Tidak di Temukan, Hubungi Tim IT untuk menambahkan minimal 1 Data Sekolah pada tabel db_mstsekolah dengan status 1';
					return view('errors.notready', $data);
				} else if ($cekjumlah == 1){
					$sql = Sekolah::where('status',1)->first();
					$url = 'https://'.$domain.'/frontpage?id='.$sql->id;
					return Redirect::to($url);
				} else {
					$data				= [];
					$data['sidebar']	= 'frontpage';
					$data['data']		= $sql;
					$data['firebaseid']	= $firebaseid;
					//return view('frontpage', $data); kalau google playstore harus lsg ke login
					return view('welcome', $data);
				}
			}
		}
    }
	public function goToLogin(){
		$previlage  = Session('previlage');
		if ($previlage !== null){
			$url = url('/').'/dashbord';
			return Redirect::to($url);
		} else {
			$data				= [];
			$data['sidebar']	= 'frontpage';
			$data['firebaseid']	= '';
			return view('welcome', $data);
		}
		
    }
}
