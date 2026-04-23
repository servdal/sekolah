<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SendMail;
use App\Models\User;
use App\Dataindukstaff;
use App\Datainduk;
use App\Logstaff;
use App\XFiles;
use Carbon\Carbon;
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
		$data['alluser']		= User::where('id_sekolah', session('sekolah_id_sekolah'))->whereNotIn('previlage', ['ortu', 'Arsip'])->orderBy('id', 'DESC')->paginate(9);
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
				$getallthn 	= User::where('previlage', '!=', 'level0')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			}
		}
		return $getallthn;
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
			$idpegawai	= $request->input('val07');

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
			} else if ($username == 'getusername'){
				$cekuser 	= User::where('id', $idne)->first();
				if (isset($cekuser->id)){
					return response()->json(['icon' => 'success', 'nama' => $cekuser->nama,  'nip' => $cekuser->nip,  'username' => $cekuser->username, 'previlage' => $cekuser->previlage,  'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data an. '.$cekuser->nama]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'username' => '', 'previlage' => '', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ditemukan']);
					return back();
				}
			} else if ($username == 'ubah'){
				$email		= $request->input('val08') ?? $nama;
				$cekuser 	= User::where('id', $idne)->first();
				if (isset($cekuser->id) AND $nama != ''){
					$cekemail = User::where('id', '!=', $idne)->where('username', $nama)->count();
					if ($cekemail == 0){
						if ($idpegawai == '' OR $idpegawai == null){
							if ($password != '' AND $password == $password2){
								$update = User::where('id', $idne)->update([
									'nama'		=> $nama,
									'email'		=> $email,
									'username'	=> $email,
									'password' 	=> bcrypt($password),
									'previlage'	=> $level,
								]);
							} else {
								$update = User::where('id', $idne)->update([
									'nama'		=> $nama,
									'email'		=> $email,
									'username'	=> $email,
									'previlage'	=> $level,
									'updated_at'=> date('Y-m-d H:i:s')
								]);
							}
						} else {
							$getnama 	= Dataindukstaff::where('niy', $idpegawai)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if (isset($getnama->nama)){
								$niy 	= $getnama->niy;
								$nama 	= $getnama->nama;
								if ($password != '' AND $password == $password2){
									$update = User::where('id', $idne)->update([
										'nama'      => $nama,
										'nip' 		=> $niy,
										'email'		=> $email,
										'username'	=> $email,
										'password' 	=> bcrypt($password),
										'previlage'	=> $level,
									]);
								} else {
									$update = User::where('id', $idne)->update([
										'nama'      => $nama,
										'nip' 		=> $niy,
										'email'		=> $email,
										'username'	=> $email,
										'previlage'	=> $level,
										'updated_at'=> date('Y-m-d H:i:s')
									]);
								}
							}
						}
						if ($update){
							$deskripsi 	= Session('nama').' Mengubah User '.$cekuser->nama.' Dari Previlage '.$cekuser->previlage.' Menjadi '.$level.' Pada '.date('Y-m-d H:i:s');
							Logstaff::create([
								'jenis'		=> 'Mengubah Data User',
								'sopo'		=> Session('nip'),
								'kelakuan'	=> $deskripsi,
							]);
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Username dan Password Updated']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$idne.' Tidak ada yg diubah']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Email Terdeteksi Double, Mohon Menggunakan Email Lain']);
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
			$cekidmark1 = XFiles::where('xmarking', 'Foto-'.Session('username'))->first();
			if (isset($cekidmark1->xfile)){
				$foto = $cekidmark1->xfile;
			} else {
				$foto = '';
			}
			$cekidmark2 = XFiles::where('xmarking', 'TTD-'.Session('username'))->first();
			if (isset($cekidmark2->xfile)){
				$tandatangan = $cekidmark2->xfile;
			} else {
				$tandatangan = '';
			}
			$data['user']  			= User::where('username', Session('username'))->first();
			$data['datastaf']  		= Dataindukstaff::where('niy', Session('nip'))->first();
			$data['foto']  			= $foto;
			$data['tandatangan']  	= $tandatangan;
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
		} else if ($id == 'updatetteks'){
			$cekmarkttd = 'TTDKS-'.Session('sekolah_id_sekolah');
			try {
				XFiles::updateOrCreate(
					[
						'xmarking'	=> $cekmarkttd,
						'xtabel'	=> 'TTDKS',
					],
					[
						'xfile'		=> $request->input('val02')
					]
				);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tandatangan Kepala Sekolah Updated']);
				return back();
			} catch (\Exception $e) {
				$pesan 		= $e->getMessage();
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
				return back();
			}
		} else if ($id == 'updatettepribadi'){
			$cekmarkttd = 'TTD-'.Session('username');
			$ceksudah 	= XFiles::where('xmarking', $cekmarkttd)->first();
			if (isset($ceksudah->xtabel)){
				$update = XFiles::where('xmarking', $cekmarkttd)->update([
					'xfile'		=> $request->input('val02')
				]);
			} else {
				$update = XFiles::create([
					'xmarking'	=> $cekmarkttd,
					'xtabel'	=> 'TTD',
					'xfile'		=> $request->input('val02')
				]);
			}
			if ($update){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tandatangan Pribadi Updated']);
				return back();	
			} else {
				$pesan 		= 'Update Gagal';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
				return back();
			}
		} else if ($user = User::where('id', $id)->first()) {
			$niy 		= $request->input('val05');
			$username 	= $request->input('val03');
			$niy 		= $request->input('val05');
			$foto		= $request->input('val07');
			$tandatangan= $request->input('val08');
			$getniy 	= User::where('username', $username)->first();
			$niy 		= $getniy->nip;
			$cekidmark1 = XFiles::where('xmarking', 'Foto-'.$username)->first();
			if (isset($cekidmark1->xid)){
				$idfoto = $cekidmark1->xid;
			} else {
				$idfoto = XFiles::create([
					'xmarking'	=> 'Foto-'.$username,
					'xtabel'	=> 'Foto',
					'xjenis'	=> $niy,
					'xfile'		=> ''
				]);
				$idfoto = $idfoto->xid;
			}
			$cekidmark2 = XFiles::where('xmarking', 'TTD-'.$username)->first();
			if (isset($cekidmark2->xid)){
				$idttd = $cekidmark2->xid;
			} else {
				$idttd = XFiles::create([
					'xmarking'	=> 'TTD-'.$username,
					'xtabel'	=> 'TTD',
					'xjenis'	=> $niy,
					'xfile'		=> ''
				]);
				$idttd = $idttd->xid;
			}
			XFiles::where('xid', $idfoto)->update([
				'xfile'		=> $foto
			]);
			XFiles::where('xid', $idttd)->update([
				'xfile'		=> $tandatangan
			]);
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
