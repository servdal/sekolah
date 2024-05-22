<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SendMail;
use App\Models\User;
use App\Sekolah;
use App\Pembayaranzis;
use App\Pembayaran;
use App\Chatting;
use App\Pengumuman;
use App\Datainduk;
use App\Dataindukstaff;
use App\Mutasi;
use App\Ekstrakulikuler;
use App\Insidental;
use App\Setkuangan;
use App\Setting;
use App\Logstaff;
use App\Tabungan;
use App\Layanan;
use App\Datapsb;
use App\Datapelengkappsb;
use App\Tesppdb;
use App\Formulirpsb;
use App\Datapresensi;
use App\Perpumini;
use App\Datatema;
use App\Datakd;
use App\Kendaraan;
use App\Kendaraanactivity;
use App\Garasi;
use App\Gedung;
use App\Ruang;
use App\Fasruang;
use App\Prestasi;
use App\Bukutamu;
use App\Peminjaman;
use App\HPTKeuangan;
use App\HPTSaldotahunan;
use App\ProgramPIP;
use App\AbsenProgramPIP;
use App\Loginputnilai;
use App\Datanilai;
use App\Datasetorantahfid;
use App\Presensifinger;
use App\Datakkm;
use Validator;
use Session;
use DateTime;
use PDFCREATOR;
use QrCode;
use PDF;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
class AdminController extends Controller
{
	public function exSavesekolah(Request $request) {
		$simpan 	= new Sekolah();
		$simpan->nama_yayasan = $request->nama_yayasan; 
		$simpan->nis = $request->nis; 
		$simpan->nss = $request->nss; 
		$simpan->npsn = $request->npsn; 
		$simpan->kode_sekolah = $request->kode_sekolah; 
		$simpan->nama_sekolah = $request->nama_sekolah; 
		$simpan->alamat = $request->alamat; 
		$simpan->kota = $request->kota; 
		$simpan->telp = $request->telp; 
		$simpan->email = $request->email; 
		$simpan->id_kepala_sekolah = $request->id_kepala_sekolah; 
		$simpan->slogan = $request->slogan; 
		$simpan->level = $request->level; 
		$simpan->status = $request->status; 
		$simpan->pendaftaran = $request->pendaftaran; 
		$simpan->pengumuman = $request->pengumuman; 
		$simpan->no_rek = $request->no_rek; 
		$simpan->nama_rek = $request->nama_rek; 
		$simpan->nama_bank_rek = $request->nama_bank_rek; 
		

		if ($request->hasFile('logo')) {
			$ekstensi		= $request->file('logo')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Upload Logo, File Logo wajib berekstensi png (huruf kecil)']);
				return back();						
			} else {
				$namafile		= time().'logo.'.$request->file('logo')->getClientOriginalExtension();
				$uploadedFile 	= $request->file('logo');
				Storage::putFileAs('logo',$uploadedFile,$namafile);
				$simpan->logo = 'logo/'.$namafile;
			}
			if ($request->hasFile('logo_grey')) {
				$ekstensi		= $request->file('logo_grey')->getClientOriginalExtension();
				if ($ekstensi != 'png') {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Upload Logo Background, Hanya File ber ekstensi png (huruf kecil)']);
					return back();						
				} else {
					$background 	= time().'logo-gray.png';
					$uploadedFile 	= $request->file('logo_grey');
					Storage::putFileAs('logo',$uploadedFile,$background);
					$simpan->logo_grey = 'logo/'.$background;
				}
			}
			if ($request->hasFile('frontpage')) {
				$ekstensi		= $request->file('frontpage')->getClientOriginalExtension();
				if ($ekstensi != 'png') {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Upload Logo Front Logo, Hanya File ber ekstensi png (huruf kecil)']);
					return back();
				} else {
					$frontlogo 	= time().'logofront.png';
					
					$uploadedFile 	= $request->file('frontpage');
					Storage::putFileAs('logo',$uploadedFile,$frontlogo);
					$simpan->frontpage = 'logo/'.$frontlogo;
				}
			}

			$simpan->save();
			if ($simpan){			
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Berhasil di Tambahkan']);
				return back();
			}else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada yang ditambahkan']);
				return back();
			}
		}
	}
	public function exUpdatesekolah(Request $request) {
		$update 	= Sekolah::where('id', $request->edit_id)->update([
			'nama_yayasan' => $request->edit_nama_yayasan, 
			'nis' => $request->edit_nis, 
			'nss' => $request->edit_nss, 
			'npsn' => $request->edit_npsn, 
			'kode_sekolah' => $request->edit_kode_sekolah, 
			'nama_sekolah' => $request->edit_nama_sekolah, 
			'alamat' => $request->edit_alamat, 
			'kota' => $request->edit_kota, 
			'telp' => $request->edit_telp, 
			'email' => $request->edit_email, 
			'id_kepala_sekolah' => $request->edit_id_kepala_sekolah, 
			'slogan' => $request->edit_slogan, 
			'level' => $request->edit_level, 
			'status' => $request->edit_status,
			'pendaftaran' => $request->edit_pendaftaran,
			'pengumuman' => $request->edit_pengumuman,
			'no_rek' => $request->no_rek,
			'nama_rek' => $request->edit_nama_rek,
			'nama_bank_rek' => $request->edit_nama_bank_rek,
		]);
		 
		

		if ($request->hasFile('edit_logo')) {
			$ekstensi		= $request->file('edit_logo')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Upload Logo, File Logo wajib berekstensi png (huruf kecil)']);
				return back();						
			} else {
				$namafile		= time().'logo.'.$request->file('edit_logo')->getClientOriginalExtension();
				$uploadedFile 	= $request->file('edit_logo');
				Storage::putFileAs('logo',$uploadedFile,$namafile);
					
				$update 	= Sekolah::where('id',$request->edit_id)->update([
					'logo' => 'logo/'.$namafile
				]);
			}
		}
		if ($request->hasFile('edit_logo_grey')) {
			$ekstensi		= $request->file('edit_logo_grey')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Upload Logo Background, Hanya File ber ekstensi png (huruf kecil)']);
				return back();						
			} else {
				$background 	= time().'logo-gray.png';
				$uploadedFile 	= $request->file('edit_logo_grey');
				Storage::putFileAs('logo',$uploadedFile,$background);
				$update 	= Sekolah::where('id', $request->edit_id)->update([
					'logo_grey' => 'logo/'.$background
				]);
			}
		}
		if ($request->hasFile('edit_frontpage')) {
			$ekstensi		= $request->file('edit_frontpage')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal Upload Logo Front Logo, Hanya File ber ekstensi png (huruf kecil)']);
				return back();
			} else {
				$frontlogo 		= time().'logofront.png';
				$uploadedFile 	= $request->file('edit_frontpage');
				Storage::putFileAs('logo',$uploadedFile,$frontlogo);
				$update 	= Sekolah::where('id', $request->edit_id)->update([
					'frontpage' => 'logo/'.$frontlogo 
				]);
			}
		}

		if ($update){			
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Berhasil diubah']);
			return back();
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal diubah']);
			return back();
		}
	}
	public function viewPresensiFinger() {
		$data				= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4' OR Session('previlage') == 'level5'){
			$iduser			= Session('id');
			$getdatauser	= User::where('id', $iduser)->first();
			if (isset($getdatauser->klsajar)){
				$semester	= $getdatauser->smt;
				$tapel		= $getdatauser->tapel;
				$klsajar	= $getdatauser->klsajar;
			} else {
				$klsajar	= '';
				$semester	= '';
				$tapel		= '';
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
			$data['sidebar']			= 'presensifingger';
			$data['semester']			= $semester;
			$data['tapel']				= $tapel;
			$data['setidkelas']			= $klsajar;
			$arraypesertakelas			= [];
			$getdatanilaidiri 			= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->whereNotIn('statpeg', ['Non Aktif', 'Pensiun', 'Meninggal'])->get();
			if (!$getdatanilaidiri->isEmpty()) {
				foreach ($getdatanilaidiri as $hasil) {
					$presensifinger 		= DB::table('db_presensifinger')->where('nip', $hasil->niy)->where('departemen', $tapel)->where('kantor', $semester)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
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
						'presensifinger' 		=> $presensifinger,
					];
				}
			}
			$data['dataguru'] 			= $arraypesertakelas;
			return view('simaster.presensifinger', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
	}
	public function viewAmilZIS() {
		$tasks 			= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'adminzis' OR Session('previlage') == 'level5'){
			$beras 		= 0;
			$uang 		= 0;
			$maal		= 0;
			$shodaqoh	= 0;
			$tahun		= date("Y");
			$getallthn 	= Pembayaranzis::where('created_at', 'LIKE', $tahun.'%')->where('tglvalidasi', '!=', '0000-00-00')->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
			if (!empty($getallthn)){
				foreach ($getallthn as $rdatane) {
					$jeniszakat		= $rdatane->jeniszakat;
					$nominal		= $rdatane->nominal;
					$zakatmaal		= $rdatane->zakatmaal;
					$donasi			= $rdatane->donasi;
					if ($jeniszakat == 'Uang'){
						$uang 		= $uang + $nominal;
					} else {
						$beras 		= $beras + $nominal;
					}
					$maal 			= $maal + $zakatmaal;
					$shodaqoh		= $shodaqoh + $donasi;
				}
			}
			$uang						= number_format( $uang , 0 , '.' , ',' );
			$maal						= number_format( $maal , 0 , '.' , ',' );
			$shodaqoh					= number_format( $shodaqoh , 0 , '.' , ',' );
			$tasks['tahunne']			= date("Y");
			$tasks['tanggal']			= date("Y-m-d");
			$tasks['totalzakat']		= $uang;
			$tasks['totalmaal']			= $maal;
			$tasks['totalsodaqoh']		= $shodaqoh;
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']	= 'lapamil';
			return view('simaster.laporanzis', $tasks);
		} else {
		    $tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman terbatas, anda tidak memiliki hak akses';
            $tasks['sidebar']			= 'lapamil';
			return view('errors.notready', $tasks);
        }
	}
	public function viewDatainduk() {
		$tasks							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
			$bulan 						= (int)date("m");
			$tahun 						= date("Y");
			$tahunlalu 					= $tahun - 1;
			$tahundepan 				= $tahun + 1;
			if ($bulan < 7){
				$tapel 					= $tahunlalu.'-'.$tahun;
			} else {
				$tapel 					= $tahun.'-'.$tahundepan;
			}
			$tasks['tapel']				= $tapel;
			$tasks['tahunne']			= $tahun;
			$tasks['tanggal']			= date("Y-m-d");
			$tasks['angkatans']			= Datainduk::groupBy('tamasuk')->get();
			$tasks['logo']				= url("/").'/'.Session('sekolah_logo');
			$tasks['yayasan']			= Session('sekolah_nama_yayasan');
			$tasks['sekolah']			= strtoupper(Session('sekolah_nama_sekolah'));
			$tasks['alamat']			= strtoupper(Session('sekolah_alamat'));
			$tasks['kepalasekolah']		= Session('nama');
			$tasks['mutiara']			= Session('sekolah_slogan');
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']			= 'datainduk';
			return view('simaster.datainduk', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
        	$tasks['kalimatbody']  		= 'Anda Tidak di ijinkan masuk ke laman ini, silahkan kembali ke laman sebelumnya';
            return view('errors.notready', $tasks);
        }
	}
	public function viewDataindukstaff() {
		$data							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
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
			return view('simaster.dataindukstaf', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
	}
	public function viewSetkeuangan() {
		$data							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level5'){
			$data['tahunne']			= date("Y");
			$data['tanggal']			= date("Y-m-d");
			$data['ekstrakulikuler']	= Ekstrakulikuler::where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['sidebar']			= 'setkeuangan';
			return view('simaster.setkeuangan', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
		
	}
	public function viewLapbayar() {
		$tasks							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level5'){
			$datethn1 					= date("Y"); 
			$datethn2 					= $datethn1 + 1; 
			$datethn3 					= $datethn1 - 1;
			$datethn4 					= $datethn1 - 2;
			$tapel1 					= $datethn4.'-'.$datethn3;
			$tapel2						= $datethn3.'-'.$datethn1;
			$tapel3 					= $datethn1.'-'.$datethn2;
			$tasks['datethn1']			= $datethn1;
			$tasks['datethn2']			= $datethn2;
			$tasks['datethn3']			= $datethn3;
			$tasks['datethn4']			= $datethn4;
			$tasks['tahunne']			= date("Y");
			$tasks['tapel1']			= $tapel1;
			$tasks['tapel2']			= $tapel2;
			$tasks['tapel3']			= $tapel3;
			$tasks['tanggal']			= date("d-m-Y");
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']			= 'lapbayar';
			$tasks['insidentalaktif']	= Insidental::where('aktifasi', 'aktif')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			return view('simaster.lapbayar', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        }
	}
	public function viewLaptabungan() {
		$tasks						= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level5'){
			$tasks['tahunne']			= date("Y");
			$tasks['tanggal']			= date("Y-m-d");
			$tasks['sidebar']			= 'laptabungan';
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['datasiswa']			= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nokelulusan', '')->get();
			$tasks['insidentalaktif']	= Insidental::where('aktifasi', 'aktif')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			return view('simaster.tabungantu', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
			$tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
			return view('errors.notready', $tasks);
		}
	}
	public function viewLogkeuangan() {
		$tasks   		=   [];
		if (Session('previlage') == 'level1'){
			$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$groups 	= Logstaff::select(DB::Raw('DATE(timestamp) day'))->where('jenis', 'Perubahan Data Keuangan')->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('day')->orderBy('timestamp')->limit(30)->get();
			$y      	= 0;
			$x      	= 0;		
			foreach ($groups as $group) {
				$tanggal    = $group->day;
				$rsurat     = Logstaff::where('timestamp', 'like', '%'. $tanggal . '%')->where('jenis', 'Perubahan Data Keuangan')->orderBy('id', 'DESC')->get();
				foreach ($rsurat as $rowpeng) {
					$siapa          = $rowpeng->sopo;
					$pengumuman     = $rowpeng->kelakuan;   
					$created_at     = $rowpeng->timestamp;
					$kapan          = SendMail::timeago($created_at);
					$iconne			= 'fa-bullhorn';
					$jencolor 		= 'red';
					
					$tasks['pengumumans'][$x]['tanggal']     =   $created_at;
					$tasks['pengumumans'][$x]['kapan']       =   $kapan;
					$tasks['pengumumans'][$x]['jencolor']    =   $jencolor;
					$tasks['pengumumans'][$x]['siapa']       =   $siapa;
					$tasks['pengumumans'][$x]['pengumuman']  =   $pengumuman;
					$tasks['pengumumans'][$x]['icon']        =   $iconne;
					$tasks['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
					
					if ($y == 9) {
						$y = 0; 
					} else {
						$y++; 
					}
					
					$x++;
				}
			}
			$tasks['tahunne']			= date("Y");
			$tasks['tanggal']			= date("Y-m-d");
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']			= 'logkeuangan';
			$tasks['insidentalaktif']	= Insidental::where('aktifasi', 'aktif')->get();
			return view('simaster.logkeuangan', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        }
	}
	public function viewLapppdb() {
		$tasks						= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4' OR Session('previlage') == 'level5'){
			$rsetting				= Sekolah::where('id', Session('sekolah_id_sekolah'))->first();
			if (isset($rsetting->id)){
				$pendaftaran 		= $rsetting->pendaftaran;
				$pengumuman			= $rsetting->pengumuman;
			} else {
				$pendaftaran 		= '';
				$pengumuman			= '';
			}
			$kepalasekolah 			= Session('sekolah_nama_kasek');
			$sekolah 				= Session('sekolah_nama_sekolah');
			$yayasan 				= Session('sekolah_nama_yayasan');
			$alamat 				= Session('sekolah_alamat');
			$mutiara 				= Session('sekolah_slogan');
			$logo 					= Session('sekolah_logo');
			$statppdb				= '';
			$kodebaru				= '';
			$kodepindahan 			= '';
			$hargaformulir 			= '';
			$namabank 				= '';
			$norek 					= '';
			$periode 				= '';
			$setspp1 				= '';
			$setspp2 				= '';
			$setspp3 				= '';
			$setdpp1 				= '';
			$setdpp2 				= '';
			$sql 					= Layanan::where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('layanan', 'ASC')->get();
			if (!empty($sql)){
				foreach ($sql as $rlayanan){
					$status 		= $rlayanan->status;
					$layanan 		= $rlayanan->layanan;
					if ($layanan == 'periodepsb') { $periode = $status; }
					if ($layanan == 'ppdb') { $statppdb = $status; }
					if ($layanan == 'kodebaru') { $kodebaru = $status; }
					if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
					if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
					if ($layanan == 'namabank') { $namabank = $status; }
					if ($layanan == 'norek') { $norek = $status; }
					if ($layanan == 'spp1') { $setspp1 = $status; }
					if ($layanan == 'spp2') { $setspp2 = $status; }
					if ($layanan == 'spp3') { $setspp3 = $status; }
					if ($layanan == 'dpp1') { $setdpp1 = $status; }
					if ($layanan == 'dpp2') { $setdpp2 = $status; }
				}
			}
			$tasks['periode']			= $periode;
			$tasks['statppdb']			= $statppdb;
			$tasks['kodebaru']			= $kodebaru;
			$tasks['kodepindahan']		= $kodepindahan;
			$tasks['hargaformulir']		= $hargaformulir;
			$tasks['namabank']			= $namabank;
			$tasks['norek']				= $norek;
			$tasks['setspp1']			= $setspp1;
			$tasks['setspp2']			= $setspp2;
			$tasks['setspp3']			= $setspp3;
			$tasks['setdpp1']			= $setdpp1;
			$tasks['setdpp2']			= $setdpp2;
			$tasks['logo']				= $logo;
			$tasks['yayasan']			= $yayasan;
			$tasks['sekolah']			= $sekolah;
			$tasks['alamat']			= $alamat;
			$tasks['kepalasekolah']		= $kepalasekolah;
			$tasks['pendaftaran']		= $pendaftaran;
			$tasks['pengumuman']		= $pengumuman;
			$tasks['tahunne']			= date("Y");
			$tasks['tanggal']			= date("Y-m-d");
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']			= 'lapppdb';
			return view('simaster.lapppdb', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        }		
	}
	public function viewMinimi() {
		$tasks						= [];
		if (Session('previlage') !== null){
			$homebase					= url("/");
			$sekarang 	    			= date("Y-m-d");
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['tahunne']			= date("Y");
			if (Session('previlage') == 'ortu'){
				return view('simaster.minimiortu', $tasks);
			} else {
				$urutanwerno	= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
				$groups     	= Perpumini::where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->limit('10')->get();
				$y      		= 0;
				$x      		= 0;
				foreach ($groups as $group) {
					if ($x == 0){
						$setaktif = 'active';
					} else {
						$setaktif = '';
					}
					if (is_null($group->gambar) OR $group->gambar == ''){ $lampiran	= $homebase.'/logo.png';}
					else {
						if (File::exists(base_path() ."/public/images/perpus/". $group->gambar)) {
							$lampiran	= $homebase.'/images/perpus/'.$group->gambar;
						} else {
							$lampiran	= $homebase.'/logo.png';
						}
					}
					$tasks['pengumumans'][$x]['id']			=   $group->id;
					$tasks['pengumumans'][$x]['kodebuku']	=   $group->kodebuku;
					$tasks['pengumumans'][$x]['pengarang']  =   $group->pengarang;
					$tasks['pengumumans'][$x]['cetakan']	=   $group->cetakan;
					$tasks['pengumumans'][$x]['judul']		=   $group->judul;
					$tasks['pengumumans'][$x]['link']		=   $group->link;
					$tasks['pengumumans'][$x]['lampiran']  	=   $lampiran;
					$tasks['pengumumans'][$x]['setaktif']  	=   $setaktif;
					$tasks['pengumumans'][$x]['kota']       =   $group->kota;
					$tasks['pengumumans'][$x]['penerbit']  	=   $group->penerbit;
					$tasks['pengumumans'][$x]['tahun']   	=   $group->tahun;
					$tasks['pengumumans'][$x]['isbn']   	=   $group->isbn;
					$tasks['pengumumans'][$x]['rakbuku']   	=   $group->rakbuku;
					$tasks['pengumumans'][$x]['kategori']   =   $group->kategori;
					$tasks['pengumumans'][$x]['urutanwerno']=   $urutanwerno[$y];
					$tasks['pengumumans'][$x]['urutan']		=   $x + 1;
					if ($y == 9) {
						$y = 0; 
					} else {
						$y++; 
					}
					$x++;
				}
				$cekrusak 		= Perpumini::orderBy('id', 'DESC')->where('id_sekolah',session('sekolah_id_sekolah'))->where('kondisi', 'RUSAK')->count();
				$cekhilang 		= Perpumini::orderBy('id', 'DESC')->where('id_sekolah',session('sekolah_id_sekolah'))->whereIn('kondisi', ['HILANG', 'MUSNAH'])->count();
				$cekpinjam 		= Peminjaman::where('id_sekolah',session('sekolah_id_sekolah'))->where('status','1')->count();
				if ($cekrusak != 0){
					$tulisrusak 			= '<span class="badge bg-yellow">'.$cekrusak.'</span>';
				} else { $tulisrusak = ''; }
				if ($cekhilang != 0){
					$tulishilang 			= '<span class="badge bg-yellow">'.$cekhilang.'</span>';
				} else { $tulishilang = ''; }
				if ($cekpinjam != 0){
					$tulispinjam			= '<span class="badge bg-yellow">'.$cekpinjam.'</span>';
				} else { $tulispinjam = ''; }
				$tasks['tahunne']			= date("Y");
				$tasks['tanggal']			= $sekarang;
				$tasks['kembali']			= date('Y-m-d',strtotime('+7 days',strtotime($sekarang)));
				$tasks['sidebar']			= 'minimi';
				$tasks['totalbuku']			= Perpumini::orderBy('id', 'DESC')->where('id_sekolah',session('sekolah_id_sekolah'))->where('kondisi', 'BAIK')->count();;
				$tasks['totalbukudipinjam']	= $tulispinjam;
				$tasks['datasiswa']			= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('nokelulusan','')->get();
				$tasks['totalbukurusak']	= $tulisrusak;
				$tasks['totalbukuhilang']	= $tulishilang;
				return view('simaster.minimi', $tasks);
			} 
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
			$tasks['kalimatbody']  		= 'Waktu idle login Bapak/Ibu Sudah Habis silahkan relogin untuk bisa mengakses laman ini kembali';
			return view('errors.notready', $tasks);
		}
	}
	public function viewPengumuman() {
		$data			= [];
		if (Session('previlage') == 'ortu' OR Session('previlage') == null OR Session('previlage') == ''){
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        } else {
			$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$groups     =   Pengumuman::where('id_sekolah', Session('sekolah_id_sekolah'))->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
			$y      	=   0;
			$x      	=   0;
			$tasks   	=   [];
			foreach ($groups as $group) {
				$tanggal    = $group->tanggal;
				$rsurat     = Pengumuman::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
				foreach ($rsurat as $rowpeng) {
					$id             =   $rowpeng->id;
					$jenis          =   $rowpeng->jenis;
					$siapa          =   $rowpeng->siapa;
					$nim            =   $rowpeng->nim;
					$pengumuman     =   $rowpeng->pengumuman;   
					$created_at     =   $rowpeng->kapan;
					$kapan          =   SendMail::timeago($created_at);
					if ($jenis == 'mahasiswa') { 
						$nama = $siapa.'('.$nim.')';
						$iconne = 'fa-user';
						$jencolor = 'green';
					} else { 
						$nama = $siapa; 
						$iconne = 'fa-bullhorn';
						$jencolor = 'red';
					}
					$tasks['pengumumans'][$x]['id']          =   $id;
					$tasks['pengumumans'][$x]['tanggal']     =   $tanggal;
					$tasks['pengumumans'][$x]['kapan']       =   $kapan;
					$tasks['pengumumans'][$x]['jencolor']    =   $jencolor;
					$tasks['pengumumans'][$x]['jenis']       =   $jenis;
					$tasks['pengumumans'][$x]['siapa']       =   $siapa;
					$tasks['pengumumans'][$x]['pengumuman']  =   $pengumuman;
					$tasks['pengumumans'][$x]['icon']        =   $iconne;
					$tasks['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
					if ($y == 9) {
						$y = 0; 
					} else {
						$y++; 
					}
					$x++;
				}
			}
			$tasks['tahunne']			= date("Y");
			$tasks['tanggal']			= date("Y-m-d");
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']			= 'pengumuman';
			return view('simaster.pengumuman', $tasks);
		}
	}
	public function viewSekolah() {
		$task 							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
			$tasks['jpeg']				= Dataindukstaff::all();
			$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  	= Session('sekolah_alamat');
			$tasks['emailapps01']  		= Session('sekolah_email');
			$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
			$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']			= 'sekolah';
			return view('simaster.sekolah', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        }
	}
	public function jsonDatasekolah() {
		$arrsekolah 	= [];
		$homebase		= url("/");
		$getallsekolah 	= Sekolah::get();
		if (!empty($getallsekolah)){
			foreach ($getallsekolah as $hasil) {
				$logo 			= $hasil->logo;
				$logo_grey 		= $hasil->logo_grey;
				$frontpage 		= $hasil->frontpage;
				if (File::exists(base_path() ."/public/". $logo)) {
					$logo	= '<img src="'.$homebase.'/'.$logo.'" height="32">';
				} else {
					$logo	= '<img src="'.$homebase.'/boxed-bg.jpg" height="32">';
				}
				
				if (File::exists(base_path() ."/public/". $logo_grey)) {
					$logo_grey	= '<img src="'.$homebase.'/'.$logo_grey.'" height="32">';
				} else {
					$logo_grey	= '<img src="'.$homebase.'/boxed-bg.jpg" height="32">';
				}
				if (File::exists(base_path() ."/public/". $frontpage)) {
					$frontpage	= '<img src="'.$homebase.'/'.$frontpage.'" height="32">';
				} else {
					$frontpage	= '<img src="'.$homebase.'/boxed-bg.jpg" height="32">';
				}
				switch ($hasil->status) {
					case 0:
						$nama_status = "<span class='label label-danger'>Tidak Aktif</span>";
					break;
					case 1:
						$nama_status = "<span class='label label-primary'>Aktif</span>";
					break;
				}
				switch ($hasil->level) {
					case 1:
						$nama_level = "<span class='label label-info'>TK/KB</span>";
					break;
					case 2:
						$nama_level = "<span class='label label-primary'>SD/MI</span>";
					break;
					case 3:
						$nama_level = "<span class='label label-warning'>SLTP/Mts</span>";
					break;
					case 4:
						$nama_level = "<span class='label label-danger'>SLTA/MA</span>";
					break;
				}
				$arrsekolah[] = array(
					'id' 					=> $hasil->id,	
					'nama_yayasan' 			=> $hasil->nama_yayasan,
					'kode_sekolah' 			=> $hasil->kode_sekolah,	
					'nama_sekolah' 			=> $hasil->nama_sekolah,	
					'alamat' 				=> $hasil->alamat,	
					'kota' 					=> $hasil->kota,	
					'telp' 					=> $hasil->telp,	
					'email' 				=> $hasil->email,	
					'id_kepala_sekolah' 	=> $hasil->id_kepala_sekolah,	
					'slogan' 				=> $hasil->slogan,	
					'logo' 					=> $hasil->logo,	
					'logo_grey' 			=> $hasil->logo_grey,	
					'frontpage' 			=> $hasil->frontpage,	
					'nis' 					=> $hasil->nis,	
					'nss' 					=> $hasil->nss,	
					'npsn' 					=> $hasil->npsn,	
					'status' 				=> $hasil->status,	
					'level' 				=> $hasil->level,	
					'pendaftaran' 			=> $hasil->pendaftaran,	
					'pengumuman' 			=> $hasil->pengumuman,	
					'no_rek' 				=> $hasil->no_rek,	
					'nama_rek' 				=> $hasil->nama_rek,	
					'nama_bank_rek' 		=> $hasil->nama_bank_rek,	
					'nama_status' 			=> $nama_status,	
					'nama_level' 			=> $nama_level, 	
					'nama_kepala_sekolah' 	=> $hasil->kepala_sekolah->nama,	
					'img_logo'				=> $logo,
					'img_logo_grey'			=> $logo_grey,
					'img_frontpage'			=> $frontpage,
				);
			}
		}
		echo json_encode($arrsekolah);
	}
	public function viewSetting() {
		$tasks						= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
			$rstatus				= Layanan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('layanan', 'daftarekskul')->first();
			if (isset($rstatus->status)){
				$ijin 				= $rstatus->status;
			} else { $ijin			= ''; }
			$rstatuszis				= Layanan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('layanan', 'pembayaranzis')->first();
			if (isset($rstatuszis->status)){
				$ijinzis 			= $rstatuszis->status;
			} else { $ijinzis		= ''; }
			$profile 				= '';
			$visimisi 				= '';
			$strukturorganisasi 	= '';
			$pendidik 				= '';
			$jadwal 				= '';
			$kontak 				= '';
			$sertamerta 			= '';
			$setiapsaat 			= '';
			$getdata 				= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
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
			$rsekolah						= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
			$tasks['sekolah']				= $rsekolah;
			$tasks['tahunne']				= date("Y");
			$tasks['tanggal']				= date("Y-m-d");
			$tasks['sidebar']				= 'setting';
			$tasks['ijin']					= $ijin;
			$tasks['ijinzis']				= $ijinzis;
			$tasks['profile']				= $profile;
			$tasks['visimisi']				= $visimisi;
			$tasks['strukturorganisasi']	= $strukturorganisasi;
			$tasks['pendidik']				= $pendidik;
			$tasks['jadwal']				= $jadwal;
			$tasks['kontak']				= $kontak;
			$tasks['sertamerta']			= $sertamerta;
			$tasks['setiapsaat']			= $setiapsaat;
			$tasks['jpeg']					= Dataindukstaff::where('id_sekolah', session('sekolah_id_sekolah'))->get();
			$tasks['namaapps01']  			= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  		= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  		= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  		= Session('sekolah_alamat');
			$tasks['emailapps01']  			= Session('sekolah_email');
			$tasks['lamanapps01']  			= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  		= Session('sekolah_frontpage');
			$tasks['logo01']  				= url("/").'/'.Session('sekolah_logo');
			$tasks['sidebar']				= 'setting';
			return view('simaster.setting', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        }
	}
	public function viewSarpras() {
		$tasks							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
			$rsekolah						= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
			$jgarasi 						= Garasi::where('fakultas', Session('sekolah_id_sekolah'))->get();
			$jgedung 						= Gedung::where('fakultas', Session('sekolah_id_sekolah'))->get();
			$tasks['gedunge']				= $jgedung;
			$tasks['garasine']				= $jgarasi;
			$tasks['sekolah']				= $rsekolah;
			$tasks['tahunne']				= date("Y");
			$tasks['tanggal']				= date("Y-m-d");
			$tasks['sidebar']				= 'sarpras';
			$tasks['namaapps01']  			= Session('sekolah_nama_aplikasi');
			$tasks['domainapps01']  		= Session('sekolah_nama_yayasan');
			$tasks['subdomainapps01']  		= Session('sekolah_nama_sekolah');
			$tasks['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$tasks['addressapps01']  		= Session('sekolah_alamat');
			$tasks['emailapps01']  			= Session('sekolah_email');
			$tasks['lamanapps01']  			= parse_url(request()->root())['host'];
			$tasks['logofrontapps01']  		= Session('sekolah_frontpage');
			$tasks['logo01']  				= url("/").'/'.Session('sekolah_logo');
			return view('simaster.sarpras', $tasks);
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        }
	}
	public function viewDatamasuk() {
		$data 							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level5'){
			$homebase					= url("/");
			$pegawais   				= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('nama', 'ASC')->get();
			$data['pegawais']   		= $pegawais;		
			$data['nama'] 				= Session('nama'); 
			$data['sidebar'] 			= 'datakeuhptmasuk';
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		    $getdebet 		            = HPTKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'))->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('id_sekolah')->first();
            if (isset($getdebet->pemasukan)){
                $totpemasukan	        = $getdebet->pemasukan;
            } else { $totpemasukan = 0 ;}
            $getkredit 		            = HPTKeuangan::select(DB::raw('SUM(pengeluaran) as pengeluaran'))->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('id_sekolah')->first();
            if (isset($getkredit->pengeluaran)){
                $totpepengeluaran	    = $getkredit->pengeluaran;
            } else { $totpepengeluaran  = 0 ;}
            $saldoakhir = $totpemasukan - $totpepengeluaran;
            $data['danaterkumpul']      = number_format( $totpemasukan , 0 , '.' , ',' );
            $data['danaterserap']  		= number_format( $totpepengeluaran , 0 , '.' , ',' );
            $data['saldo']  		    = number_format( $saldoakhir , 0 , '.' , ',' );
			return view('simaster.datamasuk', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
    }
	public function viewLaporan() {
        $homebase					= url("/");
		$data						= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level5' OR Session('spesial') == 'paguyuban'){
			$pegawais   				= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('nama', 'ASC')->get();
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
			$data['pegawais']   		= $pegawais;
			$data['nama'] 				= Session('nama'); 
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['sidebar'] 			= 'laporankeuhpt';
			$data['insidentalaktif']	= Insidental::where('aktifasi', 'aktif')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			return view('simaster.laporan', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
	}
	public function viewProgrampip() {
        $homebase					= url("/");
		$data						= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
			$pegawais   				= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('nama', 'ASC')->get();
			$data['pegawais']   		= $pegawais;
			$data['nama'] 				= Session('nama'); 
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['sidebar'] 			= 'programpip';
			return view('simaster.programpip', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
	}
	public function viewProfilPegawai($id) {
		$data						= [];
		$getdatapegawai 			= Dataindukstaff::where('id', $id)->first();
		if (isset($getdatapegawai->id)){
			$keaktifanpresensi 		= Loginputnilai::where('niy', $getdatapegawai->niy)->where('jennilai', 'Presensi Kelas')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			$presensifinger 		= DB::table('db_presensifinger')->where('nip', $getdatapegawai->niy)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			$keaktifantahfids		= Datasetorantahfid::where('inputor', $getdatapegawai->niy)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('tanggal')->get();
			$keaktifantahfids		= count($keaktifantahfids);
			$data['keaktifanpresensi']			= $keaktifanpresensi;
            $data['presensifinger']			= $presensifinger;
            $data['keaktifantahfids']			= $keaktifantahfids;
            $data['user']			= $getdatapegawai;
            return view('simaster.profilpegawai', $data);
		} else {
			$data['kalimatheader']	= 'Mohon Maaf';
            $data['kalimatbody']	= 'ID Pegawai '.$id.' Tidak ditemukan, Periksa Kembali URL Bapak/Ibu';
            return view('errors.notready', $data);
		}
	}
	public function getLaporanbulanan(Request $request) {
		$bulan		= $request->input('val01');
		$tahun		= $request->input('val02');
		$jenis		= $request->input('val03');
		$tanggal	= $request->input('val04');
		$arraysurat	= [];
		$thnlalu 	= $tahun - 1;
		$ahrf 		= explode("-", $tanggal);	
		$dino 		= $ahrf[0];
		$getthnlalu	= HPTSaldotahunan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $thnlalu)->where('jenis', $jenis)->first();
		if (isset($getthnlalu->saldo)){
			$saldothnlalu 	= $getthnlalu->saldo;
		} else { $saldothnlalu = 0; }
		$blncari = $bulan;
		while ($blncari != 0){
			$blncari 		= $blncari - 1;
			$getdebet 		= HPTKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'))->where('tahun', $tahun)->where('bulan', $blncari)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
			if (isset($getdebet->pemasukan)){
				$pemasukan		= $getdebet->pemasukan;
			} else { $pemasukan = 0 ;}
			$getkredit 		= HPTKeuangan::select(DB::raw('SUM(pengeluaran) as pengeluaran'))->where('tahun', $tahun)->where('bulan', $blncari)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
			if (isset($getkredit->pengeluaran)){
				$pengeluaran		= $getkredit->pengeluaran;
			} else { $pengeluaran = 0 ;}
			
			$saldothnlalu	= ($saldothnlalu + $pemasukan) - $pengeluaran;
		}
		$totalpemasukan 	= $saldothnlalu;
		$totalpengeluaran 	= 0;
		$saldoakhir 		= $saldothnlalu;

		$arraysurat[] = array(				
			'no' 			=> '1',
			'tanggal' 		=> $dino,
			'deskripsi' 	=> 'Saldo Awal',
			'pemasukan' 	=> number_format( $saldothnlalu , 0 , '.' , ',' ),	
			'pengeluaran' 	=> '',	
			'saldo' 		=> number_format( $saldothnlalu , 0 , '.' , ',' ),			
		  );
		$i 				= 2;
		$golekjeneng	= HPTKeuangan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $tahun)->where('bulan', $bulan)->where('jenis', $jenis)->orderBy('tanggal', 'ASC')->get();
		if(!empty($golekjeneng)){
			foreach($golekjeneng as $hasil){
				$kredit				= $hasil->pengeluaran;
				$debet				= $hasil->pemasukan;
				$totalpemasukan 	= $totalpemasukan + $debet;	
				$totalpengeluaran 	= $totalpengeluaran + $kredit;
				$saldoakhir 		= ($saldoakhir + $debet) - $kredit;
				$arraysurat[] = array(				
					'no' 			=> $i,
					'tanggal' 		=> $hasil->tanggal,
					'deskripsi' 	=> $hasil->deskripsi,
					'pemasukan' 	=> number_format( $debet , 0 , '.' , ',' ),	
					'pengeluaran' 	=> number_format( $kredit , 0 , '.' , ',' ),
					'saldo' 		=> number_format( $saldoakhir , 0 , '.' , ',' ),			
				);
				$i++;
			}
		}

		$arraysurat[] = array(				
			'no' 			=> '',
			'tanggal' 		=> '',
			'deskripsi' 	=> '<b>TOTAL</b>',
			'pemasukan' 	=> number_format( $totalpemasukan , 0 , '.' , ',' ),	
			'pengeluaran' 	=> number_format( $totalpengeluaran , 0 , '.' , ',' ),	
			'saldo' 		=> number_format( $saldoakhir , 0 , '.' , ',' ),			
		  );
		if ($bulan == 12){
			$ceksaldo = HPTSaldotahunan::where('tahun', $tahun)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
			if ($ceksaldo == 0){
				HPTSaldotahunan::create([
					'tahun' 	=> $tahun,
					'jenis'		=> $jenis,
					'saldo'		=> $saldoakhir,
					'id_sekolah'=> Session('sekolah_id_sekolah')
				]);
			}
			else {
				HPTSaldotahunan::where('tahun', $tahun)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->update([
					'saldo'		=> $saldoakhir
				]);
			}
		}
		echo json_encode($arraysurat);
	}
	public function exLaporanbulanan(Request $request) {
		$data			= [];
		$bulan			= $request->input('val01');
		$tahun			= $request->input('val02');
		$jenis			= $request->input('val03');
		$tanggal		= $request->input('val04');
		$tgllaporan		= $request->input('val05');
		$thnlalu 		= $tahun - 1;
		$ahrf2 			= explode("-", $tgllaporan);	
		$daylaporan 	= $ahrf2[0];
		$blnlaporan 	= (int)$ahrf2[1];
		$thnlaporan 	= $ahrf2[2];
		$rsetting		= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$kepalasekolah	= $rsetting->kepala_sekolah->nama;
		$niy			= $rsetting->kepala_sekolah->niy;
		$jabkajur 		= 'Kepala Sekolah';
		$namakajur 		= $kepalasekolah;
		$nipkajur 		= $niy;
		$jabbendahara 	= 'Bendahara';
		$namabendahara 	= Session('nama');
		$nipbendahara 	= Session('nip');
		if ($bulan != '' and $tahun != '' and $jenis != '' and $tanggal != '' and $tgllaporan != ''){
			$data['tgllaporan']		= $tgllaporan;
			$data['niy']			= $niy;
			$data['jabkajur']		= $jabkajur;
			$data['namakajur']		= $namakajur;
			$data['nipkajur']		= $nipkajur;
			$data['jabbendahara']	= $jabbendahara;
			$data['namabendahara']	= $namabendahara;
			$data['nipbendahara']	= $nipbendahara;
			$bulanlist 				= array(1 => "JANUARI", 2 => "FEBRUARI", 3 => "MARET", 4 => "APRIL", 5 => "MEI", 6 => "JUNI", 7 => "JULI", 8 => "AGUSTUS", 9 => "SEPTEMBER", 10 => "OKTOBER", 11 => "NOVEMBER", 12 => "DESEMBER");
			$blniki 				= $bulanlist[$bulan];
			$blnlap 				= $bulanlist[$blnlaporan];
			$tgllaporan 			= $daylaporan.' '.$blnlap.' '.$thnlaporan;
			if ($jenis == 'pendaftaran') { $tulisanne = '(01). LAPORAN BUKU PENDAFTARAN<br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'spp') { $tulisanne = '(02). LAPORAN KEUANGAN PEMBAYARAN SPP<br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'makan') { $tulisanne = '(03). LAPORAN BUKU UANG MAKAN<br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'ekstrakurikuler') { $tulisanne = '(04). LAPORAN KEUANGAN EKSTRAKULIKULER<br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'kegiatan') { $tulisanne = '(05). LAPORAN KEUANGAN KEGIATAN<br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'peralatan') { $tulisanne = '(06). LAPORAN UANG PERALATAN <br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'bos') { $tulisanne = '(07). LAPORAN DANA BOS<br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'pembangunan') { $tulisanne = '(08). LAPORAN INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN <br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'seragam') { $tulisanne = '(09). LAPORAN UANG SERAGAM <br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'buku') { $tulisanne = '(10). LAPORAN UANG BUKU <br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'jariyah') { $tulisanne = '(11). LAPORAN UANG JARIYAH <br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else if ($jenis == 'lainlain') { $tulisanne = '(12). LAPORAN KEUANGAN LAIN-LAIN <br />PERIODE BULAN '.$blniki.' TAHUN '.$tahun; }
			else {
				$tulisanne	= strtoupper($jenis);
			}
			$data['tulisanne']	= $tulisanne;
			$ahrf 				= explode("-", $tanggal);	
			$dino 				= (int)$ahrf[0];
			$rsaldothnlalu		= HPTSaldotahunan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $thnlalu)->where('jenis', $jenis)->first();
			$saldothnlalu		= $rsaldothnlalu->saldo;
			$blncari 			= $bulan;
			while ($blncari != 0){
				$blncari 			= $blncari - 1;
				$getdebet 			= HPTKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'))->where('tahun', $tahun)->where('bulan', $blncari)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
				if (isset($getdebet->pemasukan)){
					$pemasukan		= $getdebet->pemasukan;
				} else { $pemasukan = 0 ;}
				$getkredit 			= HPTKeuangan::select(DB::raw('SUM(pengeluaran) as pengeluaran'))->where('tahun', $tahun)->where('bulan', $blncari)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
				if (isset($getkredit->pengeluaran)){
					$pengeluaran	= $getkredit->pengeluaran;
				} else {$pengeluaran= 0 ;}
				$saldothnlalu		= ($saldothnlalu + $pemasukan) - $pengeluaran;
			}
			$totalpemasukan 	= $saldothnlalu;
			$totalpengeluaran 	= 0;
			$saldoakhir 		= $saldothnlalu;
			$tulisan1			= number_format( $totalpemasukan , 0 , '.' , ',' );
			$tulisan2			= number_format( $totalpengeluaran , 0 , '.' , ',' );
			$tulisan3			= number_format( $saldoakhir , 0 , '.' , ',' );
			$data['dino']		= $dino;
			$data['tulisan1']	= $tulisan1;
			$data['tulisan2']	= $tulisan2;
			$data['tulisan3']	= $tulisan3;
			$data['dino']		= $dino;
			$i 					= 2;
			$itung 				= 0;
			$halaman 			= 0;
			$index 				= 0;
			$golekjeneng		= HPTKeuangan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $tahun)->where('bulan', $bulan)->where('jenis', $jenis)->orderBy('tanggal', 'ASC')->get();
			foreach($golekjeneng as $hasil){
				$kredit				= $hasil->pengeluaran;
				$debet				= $hasil->pemasukan;
				$deskripsi			= $hasil->deskripsi;
				$tanggal			= $hasil->tanggal;
				$totalpemasukan 	= $totalpemasukan + $debet;	
				$totalpengeluaran 	= $totalpengeluaran + $kredit;
				$saldoakhir 		= ($saldoakhir + $debet) - $kredit;	
				$tulisan4			= number_format( $debet , 0 , '.' , ',' );
				$tulisan5			= number_format( $kredit , 0 , '.' , ',' );
				$tulisan6			= number_format( $saldoakhir , 0 , '.' , ',' );
				$tulisan7			= number_format( $totalpemasukan , 0 , '.' , ',' );
				$tulisan8			= number_format( $totalpengeluaran , 0 , '.' , ',' );
				$data['tabele'][$index]['i'] 			= $i;
				$data['tabele'][$index]['tanggal'] 		= $tanggal;
				$data['tabele'][$index]['deskripsi'] 	= $deskripsi;
				$data['tabele'][$index]['tulisan4'] 	= $tulisan4;
				$data['tabele'][$index]['tulisan5'] 	= $tulisan5;
				$data['tabele'][$index]['tulisan6'] 	= $tulisan6;
				$data['tabele'][$index]['tulisan7'] 	= $tulisan7;
				$data['tabele'][$index]['tulisan8'] 	= $tulisan8;
				
			}
			$tulisan9	= number_format( $saldoakhir , 0 , '.' , ',' );
			$tulisan10	= number_format( $totalpemasukan , 0 , '.' , ',' );
			$tulisan11	= number_format( $totalpengeluaran , 0 , '.' , ',' );
			$data['tulisan9']	= $tulisan9;
			$data['tulisan10']	= $tulisan10;
			$data['tulisan11']	= $tulisan11;
			$data['tgllaporan']	= $tgllaporan;
			$data['tulisan10']	= $tulisan10;
			$data['tulisan11']	= $tulisan11;
			if ($bulan == 12){
				$ceksaldo = HPTSaldotahunan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $tahun)->where('jenis', $jenis)->count();
				if ($ceksaldo == 0){
					HPTSaldotahunan::create([
						'tahun' 	=> $tahun,
						'jenis'		=> $jenis,
						'saldo'		=> $saldoakhir,
						'id_sekolah'=> Session('sekolah_id_sekolah')
					]);
				}
				else {
					HPTSaldotahunan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $tahun)->where('jenis', $jenis)->update([
						'saldo'		=> $saldoakhir
					]);
				}
			}
			return view('cetak.laporankeuangan', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Pastikan seluruh field terisi dengan data dan format yang benar';
            return view('errors.notready', $data);
		}
	}
	public function getDatakeuangan() {
		$bulan 		= date("m");
		$tahun 		= date("Y");
		$hasil		= [];
		$homebase	= url("/");
			
		if (Session('previlage') == 'ortu') {
			$getdata= HPTKeuangan::whereIn('jenis', ['Paguyuban', 'Ortu_Asuh', 'Bazar', 'Rihlah', 'Tahsin', 'Dana Kesiswaan', 'Sedekah Rutin', 'DanSosOp'])->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
		} else {
			$getdata= HPTKeuangan::whereNotIn('jenis', ['Paguyuban', 'Ortu_Asuh', 'Bazar', 'Rihlah', 'Tahsin', 'Dana Kesiswaan', 'Sedekah Rutin', 'DanSosOp'])->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
		}
		foreach($getdata as $rdata){
			$dd			= $rdata->tanggal;
			$mm			= $rdata->bulan;
			$yy			= $rdata->tahun;
			$pengeluaran= $rdata->pengeluaran;
			$pemasukan	= $rdata->pemasukan;
			$bendahara 	= $rdata->bendahara;
			$tglkwitansi= $rdata->tglkwitansi;
			$tandatangan= $rdata->tandatangan;
			$keterangan	= $rdata->keterangan;
			if ($tandatangan == '' OR is_null($tandatangan)){
				$kunci 	= 'no';
			} else {
				$kunci 		= 'yes';
				$keterangan = '<a href="'.$homebase.'/ctkkwt/'.$rdata->id.'">Di Validasi Oleh '.$bendahara.' Pada '.$tglkwitansi.'; Keterangan '.$keterangan.'</a>';
			}
			if ($mm < 10){
				$tgllengkap = $dd.'-0'.$mm.'-'.$yy;
			} else {
				$tgllengkap = $dd.'-'.$mm.'-'.$yy;
			}
			if ($pengeluaran == '' OR $pengeluaran == 0) {$total = $pemasukan;}
			else { $total = $pengeluaran; }
			$kwitansi 	= public_path('kwitansi/'.$rdata->id.'.pdf');
			$draft 		= public_path('scan/generate/Kwitansi'.$rdata->id.'.pdf');
			Storage::disk('local')->delete($kwitansi);
			Storage::disk('local')->delete($draft);
			
			$hasil[] = array(
				'id' 			=> $rdata->id,	
				'tanggal' 		=> $rdata->tanggal,		
				'bulan' 		=> $rdata->bulan,
				'tahun' 		=> $rdata->tahun,
				'deskripsi' 	=> $rdata->deskripsi,
				'pemasukan' 	=> number_format( $pemasukan , 0 , '.' , ',' ),	
				'pengeluaran' 	=> number_format( $pengeluaran , 0 , '.' , ',' ),	
				'jenis' 		=> $rdata->jenis,	
				'keterangan' 	=> $keterangan,
				'tgllengkap' 	=> $tgllengkap,
				'total' 		=> $total,
				'kunci'			=> $kunci
			);
		}
        echo json_encode($hasil);
	}
	public function getDatakeuanganEO(Request $request) {
		$idne   	= $request->input('val01');
		$bulan 		= date("m");
		$tahun 		= date("Y");
		$hasil		= [];
		$homebase	= url("/");
		$getdata	= HPTKeuangan::where('id_sekolah', $idne)->orderBy('id', 'DESC')->get();
		foreach($getdata as $rdata){
			$dd			= $rdata->tanggal;
			$mm			= $rdata->bulan;
			$yy			= $rdata->tahun;
			$pengeluaran= $rdata->pengeluaran;
			$pemasukan	= $rdata->pemasukan;
			$bendahara 	= $rdata->bendahara;
			$tglkwitansi= $rdata->tglkwitansi;
			$tandatangan= $rdata->tandatangan;
			$keterangan	= $rdata->keterangan;
			if ($tandatangan == '' OR is_null($tandatangan)){
				$kunci 	= 'no';
			} else {
				$kunci 		= 'yes';
				$keterangan = '<a href="'.$homebase.'/ctkkwt/'.$rdata->id.'">Di Validasi Oleh '.$bendahara.' Pada '.$tglkwitansi.'; Keterangan '.$keterangan.'</a>';
			}
			if ($mm < 10){
				$tgllengkap = $dd.'-0'.$mm.'-'.$yy;
			} else {
				$tgllengkap = $dd.'-'.$mm.'-'.$yy;
			}
			if ($pengeluaran == '' OR $pengeluaran == 0) {$total = $pemasukan;}
			else { $total = $pengeluaran; }
			$kwitansi 	= public_path('kwitansi/'.$rdata->id.'.pdf');
			$draft 		= public_path('scan/generate/Kwitansi'.$rdata->id.'.pdf');
			Storage::disk('local')->delete($kwitansi);
			Storage::disk('local')->delete($draft);
			
			$hasil[] = array(
				'id' 			=> $rdata->id,	
				'tanggal' 		=> $rdata->tanggal,		
				'bulan' 		=> $rdata->bulan,
				'tahun' 		=> $rdata->tahun,
				'deskripsi' 	=> $rdata->deskripsi,
				'pemasukan' 	=> number_format( $pemasukan , 0 , '.' , ',' ),	
				'pengeluaran' 	=> number_format( $pengeluaran , 0 , '.' , ',' ),	
				'jenis' 		=> $rdata->jenis,	
				'keterangan' 	=> $keterangan,
				'tgllengkap' 	=> $tgllengkap,
				'total' 		=> $total,
				'kunci'			=> $kunci
			);
		}
        echo json_encode($hasil);
	}
	public function exKwitansi(Request $request) {
		$idne   	= $request->input('valkirim');
		return redirect('ctkkwt/'.$idne);
	}
	public function getRekapsaldo() {
		$tahun 		= date("Y");
		$thnlalu 	= $tahun - 1;
		$totale 	= 0;
		$arraysurat	= [];
		$ceksek 	= HPTSaldotahunan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $thnlalu)->count();
		if ($ceksek == 0){
			$jenislist 	= array(
				0 => "lainlain", 
				1 => "Paguyuban",
				2 => "Ortu_Asuh", 
				3 => "Bazar", 
				4 => "Rihlah",
				5 => "Tahsin", 
				6 => "Dana Kesiswaan", 
				7 => "Sedekah Rutin", 
				8 => "DanSosOp", 
				9 => "pendaftaran", 
				10 => "spp", 
				11 => "makan", 
				12 => "ekstrakurikuler", 
				13 => "kegiatan", 
				14 => "peralatan", 
				15 => "bos", 
				16 => "pembangunan", 
				17 => "seragam", 
				18 => "buku", 
				19 => "jariyah");
			foreach ($jenislist as $rows){
				$jenis 			= $jenislist[$totale];
				$ceksudah 		= HPTSaldotahunan::where('jenis', $jenis)->where('tahun', $thnlalu)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
				if ($ceksudah == 0){
					$getdebet 		= HPTKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'))->where('tahun', $thnlalu)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
					if (isset($getdebet->pemasukan)){
						$totpemasukan		= $getdebet->pemasukan;
					} else { $totpemasukan = 0 ;}
					$getkredit 		= HPTKeuangan::select(DB::raw('SUM(pengeluaran) as pengeluaran'))->where('tahun', $thnlalu)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
					if (isset($getkredit->pengeluaran)){
						$totpepengeluaran		= $getkredit->pengeluaran;
					} else { $totpepengeluaran = 0 ;}
					
					$saldoakhir = $totpemasukan - $totpepengeluaran;
					HPTSaldotahunan::create([
						'tahun' 		=> $thnlalu,
						'jenis' 		=> $jenis,
						'saldo' 		=> $saldoakhir,	
						'id_sekolah'	=> Session('sekolah_id_sekolah')
					]);
				}
				$totale++;
			}
		}
		$totale 	= 0;
		$nomor 		= 1;
		if (Session('previlage') == 'ortu') {
			$getdata= HPTSaldotahunan::whereIn('jenis', ['Paguyuban', 'Ortu_Asuh', 'Bazar', 'Rihlah', 'Tahsin', 'Dana Kesiswaan', 'Sedekah Rutin', 'DanSosOp'])->where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $thnlalu)->get();
		} else {
			$getdata= HPTSaldotahunan::whereNotIn('jenis', ['Paguyuban', 'Ortu_Asuh', 'Bazar', 'Rihlah', 'Tahsin', 'Dana Kesiswaan', 'Sedekah Rutin', 'DanSosOp'])->where('id_sekolah', Session('sekolah_id_sekolah'))->where('tahun', $thnlalu)->get();
		}
		foreach($getdata as $hasil){
			$jenis		= $hasil->jenis;
			$saldo		= $hasil->saldo;
			$tlsjenis	= '';
			if ($jenis == 'pendaftaran') { $tulisanne = '01. PENDAFTARAN'; }
			elseif ($jenis == 'spp') { $tulisanne = '02. SPP'; }
			elseif ($jenis == 'makan') { $tulisanne = '03. UANG MAKAN'; }
			elseif ($jenis == 'ekstrakurikuler') { $tulisanne = '04. EKSTRAKULIKULER'; }
			elseif ($jenis == 'kegiatan') { $tulisanne = '05. KEGIATAN'; }
			elseif ($jenis == 'peralatan') { $tulisanne = '06. PERALATAN'; }
			elseif ($jenis == 'bos') { $tulisanne = '07. BOS'; }
			elseif ($jenis == 'pembangunan') { $tulisanne = '08. INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN'; }
			elseif ($jenis == 'seragam') { $tulisanne = '09. SERAGAM'; }
			elseif ($jenis == 'buku') { $tulisanne = '10. BUKU'; }
			elseif ($jenis == 'jariyah') { $tulisanne = '11. JARIYAH'; }
			elseif ($jenis == 'lainlain') { $tulisanne = '12. LAIN-LAIN'; }
			else {$tulisanne = $nomor.'. '.$jenis; $nomor++;}
			$getdebet 		= HPTKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'))->where('tahun', $tahun)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
			if (isset($getdebet->pemasukan)){
				$totpemasukan		= $getdebet->pemasukan;
			} else { $totpemasukan = 0 ;}
			$getkredit 		= HPTKeuangan::select(DB::raw('SUM(pengeluaran) as pengeluaran'))->where('tahun', $tahun)->where('jenis', $jenis)->where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('jenis')->first();
			if (isset($getkredit->pengeluaran)){
				$totpepengeluaran		= $getkredit->pengeluaran;
			} else { $totpepengeluaran = 0 ;}
			
			$saldoakhir = ($saldo + $totpemasukan) - $totpepengeluaran;
			$totale 	= $totale + $saldoakhir;
			$arraysurat[] = array(
				'id' 			=> $hasil->id,	
				'tahun' 		=> $tahun,		
				'buku' 			=> $jenis,
				'tlsjenis' 		=> $tulisanne,	
				'saldo' 		=> number_format( $saldoakhir , 0 , '.' , ',' ),				
			);
		}
		$arraysurat[] = array(
			'id' 			=> 'x',	
			'tahun' 		=> '',		
			'buku' 			=> '<b>TOTAL</b>',
			'tlsjenis' 		=> '<b>TOTAL</b>',			
			'saldo' 		=> number_format( $totale , 0 , '.' , ',' ),				
		);
        echo json_encode($arraysurat);
	}
	public function getrekapHutang() {
		$arraysurat	= [];
		$getdata 	= HPTKeuangan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('keterangan', 'hutang')->orderBy('id', 'DESC')->get();
		foreach($getdata as $hasil){
			$dd			= $hasil->tanggal;
			$mm			= $hasil->bulan;
			$yy			= $hasil->tahun;
			$pengeluaran= $hasil->pengeluaran;
			$pemasukan	= $hasil->pemasukan;
			if ($pengeluaran == '' OR $pengeluaran == 0) {$total = $pemasukan;}
			else { $total = $pengeluaran; }
			$tanggal 	= $dd.'-'.$mm.'-'.$yy;
			$arraysurat[] = array(
				'id' 			=> $hasil->id,	
				'tanggal' 		=> $tanggal,			
				'deskripsi' 	=> $hasil->deskripsi,			
				'jumlah' 		=> number_format( $total , 0 , '.' , ',' ),			
			);
		}
        echo json_encode($arraysurat);
	}
	public function simpanTransaksi(Request $request) {
		$deskripsi	= $request->input('set01');
		$pos		= $request->input('set02');
		$tanggal	= $request->input('set03');
		$jumlah		= $request->input('set04');
		$jenis		= $request->input('set05');
		$postujuan	= $request->input('set06');
		$alasan		= $request->input('set07');
		$nama		= $request->input('set08');
		$idsekolah	= $request->input('set10');
		if (is_null($idsekolah) OR $idsekolah == '' OR $idsekolah == '0'){
		    $idsekolah = Session('sekolah_id_sekolah');
		}
		if ($tanggal == '' OR is_null($tanggal)){
			$tanggal = date("Y-m-d");
		}
		$total 		= (int)str_replace(',','',$jumlah);
		if ($jenis == 'operasionalefi' and $postujuan != '' and $jumlah == ''){ $jumlah = '-'; }
		if ($jenis == 'operasionalefi' and $alasan != '' and $jumlah == ''){ $jumlah = '-'; }
		if ($jenis == 'operasionalefi' and $nama != '' and $jumlah == ''){ $jumlah = '-'; }
		if ($deskripsi != ''  and $pos != '' and $tanggal != '' and $jumlah != '' and $jenis != ''){	
			$ahrf 	= explode("-", $tanggal);	
			$tahun 	= $ahrf[0];
			if(isset($ahrf[1])){
				$wulan 	= (int)$ahrf[1];
			} else { $wulan = date("m"); $wulan = (int)$wulan; }
			if(isset($ahrf[2])){
				$dino 	= (int)$ahrf[2];
			} else { $dino = date("Y");  }
			if ($jenis == 'pelunasan'){
				$rdatalama 		= HPTKeuangan::where('id', $pos)->first();
				$marking		= $rdatalama->marking;
				$ljenis			= $rdatalama->jenis;
				$lpemasukan		= $rdatalama->pemasukan;
				$lpengeluaran	= $rdatalama->pengeluaran;
				if ($lpemasukan == '' OR $lpemasukan == 0){ $ltotal = $lpengeluaran; }
				else { $ltotal = $lpemasukan; }
				if ($ltotal != $total){
					echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error!</h4>
								Jumlah Pelunasan Harus Sama Dengan Jumlah Yang di Hutang.
							  </div>'; 
				}
				else {
					if ($marking != ''){
						$getdatacari= HPTKeuangan::where('id_sekolah', $idsekolah)->where('marking', $marking)->whereNotIn('id', [$pos])->first();
						if(isset($getdatacari->jenis)){
							$rjenis = $getdatacari->jenis;
							$deskripsidipinjam 	= 'Kembalikan dana dari pos '.$rjenis;
							$deskripsiterima	= 'Terima dana yang dipinjam pos '.$ljenis;
							$bayar = HPTKeuangan::create([
								'tanggal'		=> $dino, 
								'bulan'			=> $wulan, 
								'tahun'			=> $tahun, 
								'deskripsi'		=> $deskripsiterima, 
								'pemasukan'		=> $total, 
								'pengeluaran'	=> '', 
								'jenis'			=> $rjenis, 
								'keterangan'	=> '', 
								'marking'		=> '',
								'id_sekolah'	=> $idsekolah,
								'created_by'	=> Session('nip')
							]);
							HPTKeuangan::create([
								'tanggal'		=> $dino, 
								'bulan'			=> $wulan, 
								'tahun'			=> $tahun, 
								'deskripsi'		=> $deskripsidipinjam, 
								'pemasukan'		=> '', 
								'pengeluaran'	=> $total, 
								'jenis'			=> $ljenis, 
								'keterangan'	=> '', 
								'marking'		=> '',
								'id_sekolah'	=> $idsekolah,
								'created_by'	=> Session('nip')
							]);
							HPTKeuangan::where('id', $pos)->update([
								'keterangan' 	=> 'lunas'
							]);
						}
						else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error!</h4>
								Data Lawan Tidak di Temukan
							  </div>';
						}
					}
					else {
						$bayar = HPTKeuangan::create([
							'tanggal'		=> $dino, 
							'bulan'			=> $wulan, 
							'tahun'			=> $tahun, 
							'deskripsi'		=> $deskripsi, 
							'pemasukan'		=> $total, 
							'pengeluaran'	=> '',
							'jenis'			=> $ljenis, 
							'keterangan'	=> '', 
							'marking'		=> '',
							'id_sekolah'	=> $idsekolah,
							'created_by'	=> Session('nip')
						]);
						HPTKeuangan::where('id', $pos)->update([
							'keterangan' 	=> 'lunas'
						]);
					}
				}
			}
			if ($jenis == 'pemasukan'){
				$bayar = HPTKeuangan::create([
					'tanggal'		=> $dino, 
					'bulan'			=> $wulan, 
					'tahun'			=> $tahun, 
					'deskripsi'		=> $deskripsi, 
					'pemasukan'		=> $total, 
					'pengeluaran'	=> '',
					'jenis'			=> $pos, 
					'keterangan'	=> '', 
					'marking'		=> '',
					'id_sekolah'	=> $idsekolah,
					'created_by'	=> Session('nip')
				]);
			}
			if ($jenis == 'operasionalefi'){ 
				$pengeluaran 	= $postujuan;
				$penerimaan 	= $total;
				$konjur			= $alasan;
				$konlab			= $nama;
				if ($penerimaan != '' and $pengeluaran != ''){
					echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error!</h4>
								Mohon di Isi Salah Satu Saja, Termasuk Penerimaan atau Pengeluaran
							  </div>';
				}
				else if ($konjur != '' and $konlab != ''){
					echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error!</h4>
								Mohon di Isi Salah Satu Saja, Termasuk Kontribusi Ke Jurusan atau Kontribusi Ke Lab
							  </div>';
				}
				else {
					if ($pengeluaran != ''){
						$dana = (int)str_replace(',','',$pengeluaran);
						$bayar = HPTKeuangan::create([
							'tanggal'		=> $dino, 
							'bulan'			=> $wulan, 
							'tahun'			=> $tahun, 
							'deskripsi'		=> $deskripsi, 
							'pemasukan'		=> '',
							'pengeluaran'	=> $dana,
							'jenis'			=> 'opsefikasi', 
							'keterangan'	=> $pos, 
							'marking'		=> '',
							'id_sekolah'	=> $idsekolah,
							'created_by'	=> Session('nip')
						]);
					}
					else if ($konjur != ''){
						$dana = (int)str_replace(',','',$konjur);
						$bayar = HPTKeuangan::create([
							'tanggal'		=> $dino, 
							'bulan'			=> $wulan, 
							'tahun'			=> $tahun, 
							'deskripsi'		=> $deskripsi, 
							'pemasukan'		=> '',
							'pengeluaran'	=> $dana,
							'jenis'			=> 'opsefikasi', 
							'keterangan'	=> $pos, 
							'marking'		=> '',
							'id_sekolah'	=> $idsekolah,
							'created_by'	=> Session('nip')
						]);
						$kontribusi = 'Terima dana '.$deskripsi;
						$bayar 		= HPTKeuangan::create([
							'tanggal'		=> $dino, 
							'bulan'			=> $wulan, 
							'tahun'			=> $tahun, 
							'deskripsi'		=> $kontribusi, 
							'pemasukan'		=> $dana,
							'pengeluaran'	=> '',
							'jenis'			=> 'kontribusiefikasi', 
							'keterangan'	=> '', 
							'marking'		=> '',
							'id_sekolah'	=> $idsekolah,
							'created_by'	=> Session('nip')
						]);
					}
					else if ($konlab != ''){
						$dana 	= (int)str_replace(',','',$konlab);
						$bayar 	= HPTKeuangan::create([
							'tanggal'		=> $dino, 
							'bulan'			=> $wulan, 
							'tahun'			=> $tahun, 
							'deskripsi'		=> $deskripsi, 
							'pemasukan'		=> '',
							'pengeluaran'	=> $dana,
							'jenis'			=> 'opsefikasi', 
							'keterangan'	=> $pos, 
							'marking'		=> '',
							'id_sekolah'	=> $idsekolah,
							'created_by'	=> Session('nip')
						]);
						$kontribusi = 'Terima dana '.$deskripsi;
						$bayar 		= HPTKeuangan::create([
							'tanggal'		=> $dino, 
							'bulan'			=> $wulan, 
							'tahun'			=> $tahun, 
							'deskripsi'		=> $kontribusi, 
							'pemasukan'		=> $dana,
							'pengeluaran'	=> '',
							'jenis'			=> 'kontribusilab', 
							'keterangan'	=> '', 
							'marking'		=> '',
							'id_sekolah'	=> $idsekolah,
							'created_by'	=> Session('nip')
						]);
					}
					else {
						$bayar 	= HPTKeuangan::create([
							'tanggal'		=> $dino, 
							'bulan'			=> $wulan, 
							'tahun'			=> $tahun, 
							'deskripsi'		=> $deskripsi, 
							'pemasukan'		=> $penerimaan,
							'pengeluaran'	=> '',
							'jenis'			=> 'opsefikasi', 
							'keterangan'	=> $pos, 
							'marking'		=> '',
							'id_sekolah'	=> $idsekolah,
							'created_by'	=> Session('nip')
						]);
					}
				
				}
			}
			if ($jenis == 'pengeluaran'){
				$bayar 	= HPTKeuangan::create([
					'tanggal'		=> $dino, 
					'bulan'			=> $wulan, 
					'tahun'			=> $tahun, 
					'deskripsi'		=> $deskripsi, 
					'pemasukan'		=> '',
					'pengeluaran'	=> $total,
					'jenis'			=> $pos,
					'keterangan'	=> '', 
					'marking'		=> '',
					'id_sekolah'	=> $idsekolah,
					'created_by'	=> Session('nip')
				]);
			}
			if ($jenis == 'pinjaman'){ 
				if ($pos == $postujuan){
					$bayar 	= HPTKeuangan::create([
						'tanggal'		=> $dino, 
						'bulan'			=> $wulan, 
						'tahun'			=> $tahun, 
						'deskripsi'		=> $deskripsi, 
						'pemasukan'		=> '',
						'pengeluaran'	=> $total,
						'jenis'			=> $pos,
						'keterangan'	=> 'hutang', 
						'marking'		=> '',
						'id_sekolah'	=> $idsekolah,
						'created_by'	=> Session('nip')
					]);
				}
				else {
					$deskripsidipinjam 	= 'Dana di pinjam pos '.$postujuan;
					$deskripsiterima	= 'Terima dana talangan dari '.$pos;
					$marking 			= $idsekolah.'-'.$pos.'-'.$tanggal.'-'.$postujuan;
					$bayar 				= HPTKeuangan::create([
						'tanggal'		=> $dino, 
						'bulan'			=> $wulan, 
						'tahun'			=> $tahun, 
						'deskripsi'		=> $deskripsidipinjam, 
						'pemasukan'		=> '',
						'pengeluaran'	=> $total,
						'jenis'			=> $pos,
						'keterangan'	=> '', 
						'marking'		=> $marking,
						'id_sekolah'	=> $idsekolah,
						'created_by'	=> Session('nip')
					]);
					HPTKeuangan::create([
						'tanggal'		=> $dino, 
						'bulan'			=> $wulan, 
						'tahun'			=> $tahun, 
						'deskripsi'		=> $deskripsiterima, 
						'pemasukan'		=> $total,
						'pengeluaran'	=> '',
						'jenis'			=> $postujuan,
						'keterangan'	=> 'hutang', 
						'marking'		=> $marking,
						'id_sekolah'	=> $idsekolah,
						'created_by'	=> Session('nip')
					]);
				}
			}
			if ($jenis == 'editor'){ 
				if ($alasan == ''){
					echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error!</h4>
								Alasan Perubahan Data Wajib Di Isi!!!
							  </div>'; 
				}
				else {
					$rdatalama		= HPTKeuangan::where('id', $postujuan)->first();		
					$ldeskripsi		= $rdatalama->deskripsi;
					$lpemasukan		= $rdatalama->pemasukan;
					$lpengeluaran	= $rdatalama->pengeluaran;
					$ljenis			= $rdatalama->jenis;
					$marking		= $rdatalama->marking;
					if ($lpengeluaran == '' OR $lpengeluaran == 0) {
						$ltotal = number_format( $lpemasukan , 0 , '.' , ',' );
						if ($marking != ''){
							HPTKeuangan::where('id_sekolah', $idsekolah)->where('marking', $marking)->whereNotIn('id', [$postujuan])->update([
								'tanggal'		=> $dino,
								'bulan'			=> $wulan,
								'tahun'			=> $tahun,
								'pengeluaran'	=> $total
							]);
						}
						$bayar = HPTKeuangan::where('id', $postujuan)->update([
							'tanggal'		=> $dino,
							'bulan'			=> $wulan,
							'tahun'			=> $tahun,
							'deskripsi'		=> $deskripsi,
							'jenis'			=> $pos,
							'pemasukan'		=> $total
						]);
					}
					else {
						$ltotal = number_format( $lpengeluaran , 0 , '.' , ',' );
						if ($marking != ''){
							HPTKeuangan::where('id_sekolah', $idsekolah)->where('marking', $marking)->whereNotIn('id', [$postujuan])->update([
								'tanggal'		=> $dino,
								'bulan'			=> $wulan,
								'tahun'			=> $tahun,
								'pemasukan'		=> $total
							]);
						}
						$bayar = HPTKeuangan::where('id', $postujuan)->update([
							'tanggal'		=> $dino,
							'bulan'			=> $wulan,
							'tahun'			=> $tahun,
							'deskripsi'		=> $deskripsi,
							'jenis'			=> $pos,
							'pengeluaran'	=> $total
						]);
					}
					$baris1 	= '<table class="table table-bordered table-striped"><tr><td colspan=2><p align=center><b>Data Lama</b></p></td><td colspan=2><p align=center><b>Data Perubahan</b></p></td></tr>';
					$baris2		= '<tr><td>Deskripsi</td><td>'.$ldeskripsi.'</td><td><font color=red>Diubah Menjadi</font></td><td>'.$deskripsi.'</td></tr>';
					$baris3		= '<tr><td>Jenis</td><td>'.$ljenis.'</td><td><font color=red>Diubah Menjadi</font></td><td>'.$pos.'</td></tr>';
					$baris4		= '<tr><td>Total</td><td>'.$ltotal.'</td><td><font color=red>Diubah Menjadi</font></td><td>'.$jumlah.'</td></tr>';
					$baris5		= '<tr><td><b>Dengan Alasan</b></td><td colspan=3>'.$alasan.'</td</tr></table>';
					$baris6		= '<tr><td><b>Operator</b></td><td colspan=3>'.Session('nama').'</td</tr></table>';
					$baris7		= '<tr><td><b>Pada</b></td><td colspan=3>'.date('Y-m-d H:i:s').'</td</tr></table>';
					$perubahan  = $baris1.$baris2.$baris3.$baris4.$baris5.$baris6.$baris7;
					Logstaff::create([
						'jenis'		=> 'Perubahan Data Keuangan', 
						'sopo'		=> Session('nip'),
						'kelakuan'	=> $perubahan,
						'id_sekolah'=> $idsekolah
					]);
				}
			}
			if ($jenis == 'hapus'){ 
				if ($alasan == ''){
					echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error!</h4>
								Alasan Perubahan Data Wajib Di Isi!!!
							  </div>'; 
				}
				else {
					$rdatalama		= HPTKeuangan::where('id', $postujuan)->first();		
					$ldeskripsi		= $rdatalama->deskripsi;
					$lpemasukan		= $rdatalama->pemasukan;
					$lpengeluaran	= $rdatalama->pengeluaran;
					$ljenis			= $rdatalama->jenis;
					$marking		= $rdatalama->marking;
					if ($lpengeluaran == '' or $lpengeluaran == 0) {
						$ltotal = number_format( $lpemasukan , 0 , '.' , ',' );				
						}
					else { 
						$ltotal = number_format( $lpengeluaran , 0 , '.' , ',' );				
						}
					$baris1 	= '<table class="table table-bordered table-striped"><tr><td colspan=2><p align=center><b>Data Lama</b></p></td><td colspan=2><p align=center><b>Data Perubahan</b></p></td></tr>';
					$baris2		= '<tr><td>Deskripsi</td><td>'.$ldeskripsi.'</td><td colspan=2><font color=red>DIHAPUS</font></td></tr>';
					$baris3		= '<tr><td>Jenis</td><td>'.$ljenis.'</td><td colspan=2><font color=red>DIHAPUS</font></td></tr>';
					$baris4		= '<tr><td>Total</td><td>'.$ltotal.'</td><td colspan=2><font color=red>DIHAPUS</font></td></tr>';
					$baris5		= '<tr><td><b>Dengan Alasan</b></td><td colspan=3>'.$alasan.'</td</tr></table>';
					$baris6		= '<tr><td><b>Operator</b></td><td colspan=3>'.Session('nama').'</td</tr></table>';
					$baris7		= '<tr><td><b>Pada</b></td><td colspan=3>'.date('Y-m-d H:i:s').'</td</tr></table>';
					$perubahan  = $baris1.$baris2.$baris3.$baris4.$baris5.$baris6.$baris7;
					Logstaff::create([
						'jenis'		=> 'Perubahan Data Keuangan', 
						'sopo'		=> Session('nip'),
						'kelakuan'	=> $perubahan,
						'id_sekolah'=> $idsekolah
					]);
					if ($marking != ''){
						$bayar = HPTKeuangan::where('marking', $marking)->delete();
					}
					else {
						$bayar = HPTKeuangan::where('id', $postujuan)->delete();
					}
				}
			}
			if ($bayar){
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
							Transaksi '.$jenis.' Sukses Dilaksanakan
					  </div>';
			}		
		}
		else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Formnya Anda Isi dengan Lengkap
				  </div>';
		}	
	}
	public function exValidasiKwitansi(Request $request) {
		$homebase	= url("/");
		$idne		= $request->input('val01');
        $val02		= $request->input('val02');
        $val03		= $request->input('val03');
        $val04		= $request->input('val04');
        $val05		= $request->input('val05');
        $val06		= $request->input('val06');
        $val07		= $request->input('val07');
        $val08		= $request->input('val08');
        $val09		= $request->input('val09');
        $val10		= $request->input('val10');
        $val11		= $request->input('val11');
        $val12		= $request->input('val12');
        $val13		= $request->input('val13');
        $val14		= $request->input('val14');
		$val15		= $request->input('val15');
        $jenis		= $request->input('jenis');
		if ($jenis == 'validasikwitansi'){
			$getdata 		= HPTKeuangan::where('id', $idne)->first();
			if (isset($getdata->id)){
				$bendahara 		= $getdata->bendahara;
				$tglkwitansi 	= $getdata->tglkwitansi;
				$tandatangan 	= $getdata->tandatangan;
				$email			= '';
				$hape			= '';
				if (is_null($tandatangan) OR $tandatangan == ''){
					$getusers 		= User::where('id', $val02)->first();
					if (isset($getusers->id)){
						$email 		= $getusers->email;
						$hape 		= $getusers->nip;
						$bendahara 	= $getusers->nama;
						HPTKeuangan::where('id', $idne)->update([
							'bendahara'		=> $getusers->nama,
							'tglkwitansi'	=> date("Y-m-d"),
							'tandatangan'	=> ''
						]);
					}
					$namafile	= $homebase.'/ttdkwitansi/'.$idne;
					$emailbody 	= '
					<p>Yth. '.$bendahara.'</p>
					<p>&nbsp;</p>
					<p>Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :</p>
					<p>&nbsp;</p>
					<p>Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :</p>
					<p>&nbsp;</p>
					<div style="background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;"><a href="'.$namafile.'" target="_blank">'.$namafile.'</a></div>
					<p>&nbsp;</p>
					<p>Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>Demikian pemberitahuan ini kami sampaikan. Terima kasih</p>
					<p>[Email ini digenerate secara otomatis, dimohon tidak membalas email ini]</p>';
					if ($email != ''){
						$perihal	= 'Mohon Menandatangani Kwitansi';
						try {
							Mail::send('email',
								array(
									'isisurat' => $emailbody,
								), function($message) use ($email, $perihal){
								$message->from('swandhana.fp@ub.ac.id');
								$message->to($email)->subject($perihal);
							});
							$sendstatus = 'success';
						} catch (\Exception $e) {
							$sendstatus = $e->getMessage();
						}
					}
					$emailbody 	= '
					Yth. '.$bendahara.'%0A
					Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :%0A
					Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :%0A'.$namafile.'%0A
					Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0A
					%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih';
					$emailbody	= str_replace(" ", '%20', $emailbody);
					$emailbody	= str_replace("<br />", '%0A', $emailbody);
					$emailbody	= str_replace("<p>", '%0A', $emailbody);
					if ($hape != ''){
						$arrhpdosen = str_split($hape);
						$hape	= '';
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
						$status = 'https://api.whatsapp.com/send?phone='.$hape.'&text='.$emailbody;
					} else {
						$status = $alamatweb;
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => $sendstatus, 'message' => $status]);
					return back();
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Kwitansi Yang sudah ditandatangani tidak bisa di ubah']);
					return back();
				
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data dengan ID '.$idne.' Tidak di Temukan']);
				return back();
			}
		} else if ($jenis == 'kirimkwitansi'){
			$getdata 		= HPTKeuangan::where('id', $idne)->first();
			if (isset($getdata->id)){
				$bendahara 		= $getdata->bendahara;
				$tglkwitansi 	= $getdata->tglkwitansi;
				$tandatangan 	= $getdata->tandatangan;
				$email			= '';
				$hape			= $val02;
				$namafile		= $homebase.'/ctkkwt/'.$idne;
				$emailbody 		= '
				Bismillahirrohmanirrohim%0A%0A
				Berikut kami kirimkan kwitansi elektronik pada link berikut ini :%0A'.$namafile.'%0A
				Terimakasih atas Bantuan Bapak/Ibu dan Semoga Allah SWT melipatgandakan pahala dan rejeki Bapak/Ibu.%0A
				%0ADemikian pemberitahuan ini kami sampaikan. Terima kasih';
				$emailbody	= str_replace(" ", '%20', $emailbody);
				$emailbody	= str_replace("<br />", '%0A', $emailbody);
				$emailbody	= str_replace("<p>", '%0A', $emailbody);
				if ($hape != ''){
					$arrhpdosen = str_split($hape);
					$hape	= '';
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
					$status 	= 'https://api.whatsapp.com/send?phone='.$hape.'&text='.$emailbody;
					$sendstatus	= 'success';
				} else {
					$status 	= $namafile;
					$sendstatus	= 'gagal';
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => $sendstatus, 'message' => $status]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data dengan ID '.$idne.' Tidak di Temukan']);
				return back();
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Surat tidak support untuk dikirim']);
			return back();
		}
	}
	public function exupdDatainduk(Request $request) {
		$nama 		= $request->edit_nama;
		$nik 		= $request->edit_nik;
		$tmplahir	= $request->edit_tmplahir;
		$tgllahir	= $request->tanggallahir;
		$kelamin	= $request->edit_kelamin;
		$tinggi		= $request->edit_tinggi;
		$berat		= $request->edit_berat;
		$darah		= $request->edit_darah;
		$ayah		= $request->edit_ayah;
		$ibu		= $request->edit_ibu;
		$kayah		= $request->edit_kayah;
		$kibu		= $request->edit_kibu;
		$wali		= $request->edit_wali;
		$kwali		= $request->edit_kwali;
		$alamat		= $request->edit_alamat;
		$erte		= $request->edit_rt;
		$erwe		= $request->edit_rw;
		$kelurahan	= $request->edit_kel;
		$kecamtan	= $request->edit_kec;
		$kota		= $request->edit_kota;
		$kodepos	= $request->edit_kodepos;
		$noinduk	= $request->edit_noinduk;
		$nisn		= $request->edit_nisn;
		$hape		= $request->edit_hape;
		$asal		= $request->edit_asal;
		$tahun		= $request->edit_tahun;
		$mutasi		= $request->edit_mutasi;
		$id			= $request->edit_idne;
		$kelas		= $request->edit_kelas;
		$jilid		= $request->edit_jilid;
		$is_asuh	= $request->edit_isasuh;
		if($nik == '' OR $nama == '' OR $tmplahir == '' OR $kelamin == '' OR $ayah == '' OR $ibu == '' OR $alamat == '' OR $hape == '' OR $noinduk == '' OR $tgllahir == '' OR $tahun == '' OR $kelas == ''){
			$error ='Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
			Nama : '.$nama.'<br />
			TTL : '.$tmplahir.'/'.$tgllahir.'<br />
			Kelamin : '.$kelamin.'<br />
			Ayah : '.$ayah.'<br />
			Ibu : '.$ibu.'<br />
			No. HP : '.$hape.'<br />
			Alamat : '.$alamat.'<br />
			Tahun : '.$tahun.'<br />
			Kelas : '.$kelas.'<br />
			No. Induk : '.$noinduk.'<br /> Apabila ada data yang kosong, mohon di isi dengan strip (-) atau angka 0 (nol)';
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
		} else {
			$noinduk	= preg_replace('/\s/', '', $noinduk);
			$noinduk	= str_replace('/', '', $noinduk);
			$nisn		= preg_replace('/\s/', '', $nisn);
			if ($id == 'new'){
				$ceksudah1 	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($nisn == '' OR is_null($nisn)){
					$ceksudah2 	= 0;
				} else {
					$ceksudah2 	= Datainduk::where('nisn', $nisn)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				}
				$ceksudah = $ceksudah1 + $ceksudah2;
				if ($ceksudah == 0){
					$input = Datainduk::create([
						'noinduk'		=> $noinduk!=null?$noinduk:time(),
						'nik'			=> $nik!=null?$nik:time(),
						'nisn'			=> $nisn!=null?$nisn:'',
						'nama'			=> $nama!=null?$nama:'',
						'kelamin'		=> $kelamin!=null?$kelamin:'',
						'tmplahir'		=> $tmplahir!=null?$tmplahir:'',
						'tgllahir'		=> $tgllahir!=null?$tgllahir:date("Y-m-d"),
						'darah'			=> $darah!=null?$darah:'',
						'berat'			=> $berat!=null?$berat:0,
						'tinggi'		=> $tinggi!=null?$tinggi:0,
						'alamatortu'	=> $alamat!=null?$alamat:'',
						'namaayah'		=> $ayah!=null?$ayah:'',
						'namaibu'		=> $ibu!=null?$ibu:'',
						'kerjaayah'		=> $kayah!=null?$kayah:'',
						'kerjaibu'		=> $kibu!=null?$kibu:'',
						'wali'			=> $wali!=null?$wali:'',
						'pekerjaanwali' => $kwali!=null?$kwali:'',
						'klspos'		=> $kelas!=null?$kelas:'',
						'tamasuk'		=> $tahun!=null?$tahun:'',
						'hape'			=> $hape!=null?$hape:'',
						'asal'			=> $asal!=null?$asal:'',
						'mutasi'		=> $mutasi!=null?$mutasi:'',
						'kelurahan'		=> $kelurahan!=null?$kelurahan:'',
						'kecamatan'		=> $kecamtan!=null?$kecamtan:'',
						'kota'			=> $kota!=null?$kota:'',
						'kodepos'		=> $kodepos!=null?$kodepos:'',
						'telpon'		=> $hape!=null?$hape:'',
						'erte'			=> $erte!=null?$erte:'',
						'erwe'			=> $erwe!=null?$erwe:'',
						'jilid'			=> $jilid!=null?$jilid:1,
						'is_asuh'		=> $is_asuh!=null?$is_asuh:0,
						'id_sekolah'	=> session('sekolah_id_sekolah'),
					]);
					$id = $input->id;
					if ($input){
						if ($request->hasFile('edit_foto')) {
							$validator = Validator::make($request->all(), [
								'file' =>  'mimes:jpg,jpeg,png,PNG,JPG,JPEG|max:20000'
							]);
							if ($validator->fails()) {
								$error = $validation->errors();
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
								return back();
							} else {
								$getfotolama 	= Datainduk::where('id', $id)->first();
								$fotolama		= $getfotolama->foto;
								if ($fotolama != ''){
									if (File::exists(base_path() ."/public/dist/img/foto/". $fotolama)) {
										File::delete(base_path() ."/public/dist/img/foto/". $fotolama);
									}
								}
								$namafile		= $id.'.'.$request->file('edit_foto')->getClientOriginalExtension();
								$uploadedFile 	= $request->file('edit_foto');
								Storage::putFileAs('dist/img/foto/',$uploadedFile,$namafile);
								Datainduk::where('id', $id)->update([
									'foto' => $namafile
								]);
								return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Update Foto dan Data Siswa Sukses']);
								return back();
							}
						}
						$cekkelengkapan = Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
						if ($cekkelengkapan == 0){
							Datapelengkappsb::create([
								'niksiswa'		=> $nik, 
								'panggilan'		=> $request->edit_panggilan, 
								'umur'			=> 0, 
								'agama'			=> $request->id_agama, 
								'warga'			=> 'WNI', 
								'bahasa'		=> 'Indenesia', 
								'penyakit'		=> '', 
								'anakke'		=> '', 
								'kandung'		=> '', 
								'tiri'			=> '', 
								'angkat'		=> '', 
								'jarak'			=> '', 
								'telpon'		=> '', 
								'bersama'		=> '', 
								'payah'			=> $request->id_payah,
								'pibu'			=> $request->id_pibu,
								'gayah'			=> $request->id_gayah,
								'gibu'			=> $request->id_gibu,
								'aayah'			=> '',
								'aaibu'			=> '',
								'hayah'			=> '',
								'hibu'			=> '',
								'agamawali'		=> '',
								'hwali'			=> '',
								'kwali'			=> '',
								'hubwali'		=> '',
								'alamattk'		=> '',
								'pindahasal'	=> '',
								'pindahkelas'	=> '',
								'pindahtgl'		=> '',
								'pindahkekls'	=> '',
								'kesulitan'		=> '',
								'anggotarumah'	=> '',
								'kegiatansendiri'=>'',
								'mata'			=> '',
								'telinga'		=> '',
								'wajah'			=> '',
								'gybljr'		=> $request->edit_gayabelajar,
								'bakat'			=> $request->edit_karakter,
								'sumberinfo'	=> '',
								'prestasi1'		=> '',
								'prestasi2'		=> '',
								'prestasi3'		=> '',
								'prestasi4'		=> '',
								'marking'		=> $id,
								'scanakta'		=> '',
								'scanfoto'		=> '',
								'scankk'		=> '',
								'scanket'		=> '',
								'scanbukti'		=> '',
								'id_sekolah'    => session('sekolah_id_sekolah')
							]);
						} else {
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
								'panggilan'		=> $request->edit_panggilan, 
								'agama'			=> $request->id_agama, 
								'marking'		=> $id,
								'payah'			=> $request->id_payah,
								'pibu'			=> $request->id_pibu,
								'gayah'			=> $request->id_gayah,
								'gibu'			=> $request->id_gibu,
								'gybljr'		=> $request->edit_gayabelajar,
								'bakat'			=> $request->edit_karakter,
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Siswa Tersimpan']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Input Gagal, Coba Beberapa Saat Lagi']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No Induk / NISN Tedeteksi Double']);
					return back();
				}
			} else {
				$ceksudah 	= Datainduk::where('noinduk', $noinduk)->where('id', '!=', $id)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($nisn == '' OR is_null($nisn)){
					$ceksudah2 	= 0;
				} else {
					$ceksudah2 	= Datainduk::where('nisn', $nisn)->where('id', '!=', $id)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				}
				$ceksudah = $ceksudah + $ceksudah2;
				if ($ceksudah == 0){
					$input = Datainduk::where('id', $id)->update([
						'noinduk'		=> $noinduk!=null?$noinduk:time(),
						'nik'			=> $nik!=null?$nik:time(),
						'nisn'			=> $nisn!=null?$nisn:'',
						'nama'			=> $nama!=null?$nama:'',
						'kelamin'		=> $kelamin!=null?$kelamin:'',
						'tmplahir'		=> $tmplahir!=null?$tmplahir:'',
						'tgllahir'		=> $tgllahir!=null?$tgllahir:date("Y-m-d"),
						'darah'			=> $darah!=null?$darah:'',
						'berat'			=> $berat!=null?$berat:0,
						'tinggi'		=> $tinggi!=null?$tinggi:0,
						'alamatortu'	=> $alamat!=null?$alamat:'',
						'namaayah'		=> $ayah!=null?$ayah:'',
						'namaibu'		=> $ibu!=null?$ibu:'',
						'kerjaayah'		=> $kayah!=null?$kayah:'',
						'kerjaibu'		=> $kibu!=null?$kibu:'',
						'wali'			=> $wali!=null?$wali:'',
						'pekerjaanwali' => $kwali!=null?$kwali:'',
						'klspos'		=> $kelas!=null?$kelas:'',
						'tamasuk'		=> $tahun!=null?$tahun:'',
						'hape'			=> $hape!=null?$hape:'',
						'asal'			=> $asal!=null?$asal:'',
						'mutasi'		=> $mutasi!=null?$mutasi:'',
						'kelurahan'		=> $kelurahan!=null?$kelurahan:'',
						'kecamatan'		=> $kecamtan!=null?$kecamtan:'',
						'kota'			=> $kota!=null?$kota:'',
						'kodepos'		=> $kodepos!=null?$kodepos:'',
						'telpon'		=> $hape!=null?$hape:'',
						'erte'			=> $erte!=null?$erte:'',
						'erwe'			=> $erwe!=null?$erwe:'',
						'jilid'			=> $jilid!=null?$jilid:1,
						'is_asuh'		=> $is_asuh!=null?$is_asuh:0,
						'id_sekolah'	=> session('sekolah_id_sekolah'),
						'updated_at'	=> date("Y-m-d H:i:s")
					]);
					if ($input){
						if ($request->hasFile('edit_foto')) {
							$validator = Validator::make($request->all(), [
								'file' =>  'mimes:jpg,jpeg,png,PNG,JPG,JPEG|max:20000'
							]);
							if ($validator->fails()) {
								$error = $validation->errors();
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
								return back();
							} else {
								$getfotolama 	= Datainduk::where('id', $id)->first();
								$fotolama		= $getfotolama->foto;
								if ($fotolama != ''){
									if (File::exists(base_path() ."/public/dist/img/foto/". $fotolama)) {
										File::delete(base_path() ."/public/dist/img/foto/". $fotolama);
									}
								}
								$namafile		= $id.'.'.$request->file('edit_foto')->getClientOriginalExtension();
								$uploadedFile 	= $request->file('edit_foto');
								Storage::putFileAs('dist/img/foto/',$uploadedFile,$namafile);
								Datainduk::where('id', $id)->update([
									'foto' => $namafile
								]);
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Foto dan Data Siswa Sukses']);
								return back();
							}
						}
						$cekkelengkapan = Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
						if ($cekkelengkapan == 0){
							Datapelengkappsb::create([
								'niksiswa'		=> $nik,
								'panggilan'		=> $request->edit_panggilan, 
								'umur'			=> 0, 
								'agama'			=> $request->id_agama, 
								'warga'			=> 'WNI', 
								'bahasa'		=> 'Indenesia', 
								'penyakit'		=> '', 
								'anakke'		=> '', 
								'kandung'		=> '', 
								'tiri'			=> '', 
								'angkat'		=> '', 
								'jarak'			=> '', 
								'telpon'		=> '', 
								'bersama'		=> '', 
								'payah'			=> $request->id_payah,
								'pibu'			=> $request->id_pibu,
								'gayah'			=> $request->id_gayah,
								'gibu'			=> $request->id_gibu,
								'aayah'			=> '',
								'aaibu'			=> '',
								'hayah'			=> '',
								'hibu'			=> '',
								'agamawali'		=> '',
								'hwali'			=> '',
								'kwali'			=> '',
								'hubwali'		=> '',
								'alamattk'		=> '',
								'pindahasal'	=> '',
								'pindahkelas'	=> '',
								'pindahtgl'		=> '',
								'pindahkekls'	=> '',
								'kesulitan'		=> '',
								'anggotarumah'	=> '',
								'kegiatansendiri'=>'',
								'mata'			=> '',
								'telinga'		=> '',
								'wajah'			=> '',
								'gybljr'		=> $request->edit_gayabelajar,
								'bakat'			=> $request->edit_karakter,
								'sumberinfo'	=> '',
								'prestasi1'		=> '',
								'prestasi2'		=> '',
								'prestasi3'		=> '',
								'prestasi4'		=> '',
								'marking'		=> $id,
								'scanakta'		=> '',
								'scanfoto'		=> '',
								'scankk'		=> '',
								'scanket'		=> '',
								'scanbukti'		=> '',
								'id_sekolah'    => session('sekolah_id_sekolah')
							]);
						} else {
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
								'panggilan'		=> $request->edit_panggilan, 
								'agama'			=> $request->id_agama, 
								'payah'			=> $request->id_payah,
								'pibu'			=> $request->id_pibu,
								'gayah'			=> $request->id_gayah,
								'gibu'			=> $request->id_gibu,
								'marking'		=> $id,
								'gybljr'		=> $request->edit_gayabelajar,
								'bakat'			=> $request->edit_karakter,
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Update Data Siswa Tersimpan']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Coba Beberapa Saat Lagi']);
						return back();
					}
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'No Induk / NISN Tedeteksi Double']);
					return back();
				}
			}
		}
	}
	public function exSimpanmutasi(Request $request) {
		$nama 		= $request->val01;
		$noinduk 	= $request->val02;
		$nisn 		= $request->val03;
		$tahun 		= $request->val04;
		$tanggal 	= $request->val05;
		$tujuan 	= $request->val06;
		$alamat 	= $request->val07;
		$alasan 	= $request->val08;
		
		if($tujuan == '' or $alamat == '' or $alasan == ''  or $tanggal == '' or $tahun == '' ){
			$error ='Pastikan Semua Form Sudah di Isi <br />
			Nama : '.$nama.'<br />
			Tahun : '.$tahun.'<br />
			Tanggal : '.$tanggal.'<br />
			Tujuan : '.$tujuan.'<br />
			Alasan : '.$alasan.'<br />
			Alamat : '.$alamat.'<br />
			No. Induk : '.$noinduk;
			echo '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Error</h4>
			'.$error.'
			</div>';
		} else {
			$tulis = 'Mutasi ke '.$tujuan.' di '.$alamat.' Alasan '.$alasan;	
			$input 	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
				'nokelulusan' 	=> 'mutasi',
				'mutasi'		=> $tulis
			]);
			if ($input){
				if ($nisn == ''){ $nisn = '-'; }
					Mutasi::create([
						'nama'		=> $nama, 
						'noinduk'	=> $noinduk, 
						'nisn'		=> $nisn, 
						'tapel'		=> $tahun, 
						'sdtujuan'	=> $tujuan, 
						'alamat'	=> $alamat, 
						'alasan'	=> $alasan, 
						'tanggal'	=> $tanggal,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses </h4>
						Update Data Induk Siswa Berhasil Di Simpan
						</div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Error</h4>
				Gagal menyimpan Log Error
				</div>';
			}
		}
	}
	public function jsonDatainduk() {
		$arrsiswa 		= [];
		$homebase		= url("/");
		if (Session('previlage') == 'ortu'){
			$getallsiswa 	= Datainduk::where('kodeortu', Session('id'))->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('noinduk', 'DESC')->get();
		} else {
			$getallsiswa 	= Datainduk::orderBy('noinduk', 'DESC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		}
		if (!empty($getallsiswa)){
			foreach ($getallsiswa as $hasil) {
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
				$getpanggilan 	= Datapelengkappsb::where('marking', $hasil->id)->first();
				if (isset($getpanggilan->id)){
					$bakat 		= $getpanggilan->bakat;
					$gybljr 	= $getpanggilan->gybljr;
					$gayah 		= $getpanggilan->gayah;
					$gibu 		= $getpanggilan->gibu;
					$payah 		= $getpanggilan->payah;
					$pibu 		= $getpanggilan->pibu;
					$panggilan 	= $getpanggilan->panggilan;
					$agama 		= $getpanggilan->agama;
				} else { $payah = ''; $pibu = ''; $panggilan = $hasil->nama; $agama = ''; $bakat = ''; $gybljr = ''; $gayah = ''; $gibu = ''; }
				$arrsiswa[] = array(
					'panggilan' 	=> $panggilan,
					'agama' 		=> $agama,
					'bakat' 		=> $bakat,
					'gybljr' 		=> $gybljr,
					'gayah' 		=> $gayah,
					'gibu' 			=> $gibu,
					'payah' 		=> $payah,
					'pibu' 			=> $pibu,
					'id' 			=> $hasil->id,	
					'nik' 			=> $hasil->nik,
					'nama' 			=> $hasil->nama,	
					'kelamin' 		=> $hasil->kelamin,
					'tmplahir' 		=> $hasil->tmplahir,
					'tgllahir' 		=> $hasil->tgllahir,
					'noinduk' 		=> $hasil->noinduk,
					'nisn' 			=> $hasil->nisn,
					'darah' 		=> $hasil->darah,
					'tinggi' 		=> $hasil->tinggi,
					'berat' 		=> $hasil->berat,
					'namaayah' 		=> $hasil->namaayah,
					'namaibu' 		=> $hasil->namaibu,	
					'kerjaayah' 	=> $hasil->kerjaayah,
					'kerjaibu'		=> $hasil->kerjaibu,
					'wali'			=> $hasil->wali,
					'pekerjaanwali'	=> $hasil->pekerjaanwali,
					'erte'			=> $hasil->erte,
					'erwe'			=> $hasil->erwe,
					'alamatortu'	=> $hasil->alamatortu,
					'kelurahan'		=> $hasil->kelurahan,
					'kecamatan'		=> $hasil->kecamatan,
					'kota'			=> $hasil->kota,
					'kodepos'		=> $hasil->kodepos,
					'klspos'		=> $hasil->klspos,			
					'foto'			=> $hasil->foto,
					'tamasuk'		=> $hasil->tamasuk,
					'hape'			=> $hasil->hape,
					'asal'			=> $hasil->asal,
					'mutasi'		=> $hasil->mutasi,
					'nokelulusan'	=> $hasil->nokelulusan,
					'jilid'			=> $hasil->jilid,
					'lampiran'		=> $lampiran,
				);
			}
		}
		if (Session('email') !== null){
			$getallsiswa 	= Datainduk::where('kodeortuasuh', Session('email'))->orderBy('noinduk', 'DESC')->get();
			if (!empty($getallsiswa)){
				foreach ($getallsiswa as $hasil) {
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
					$getpanggilan 	= Datapelengkappsb::where('marking', $hasil->id)->first();
					if (isset($getpanggilan->id)){
						$panggilan 	= $getpanggilan->panggilan;
						$agama 		= $getpanggilan->agama;
					} else { $panggilan = $hasil->nama; $agama = ''; }
					$arrsiswa[] = array(
						'panggilan' 	=> $panggilan,
						'agama' 		=> $agama,
						'id' 			=> $hasil->id,	
						'nik' 			=> $hasil->nik,
						'nama' 			=> $hasil->nama,	
						'kelamin' 		=> $hasil->kelamin,
						'tmplahir' 		=> $hasil->tmplahir,
						'tgllahir' 		=> $hasil->tgllahir,
						'noinduk' 		=> $hasil->noinduk,
						'nisn' 			=> $hasil->nisn,
						'darah' 		=> $hasil->darah,
						'tinggi' 		=> $hasil->tinggi,
						'berat' 		=> $hasil->berat,
						'namaayah' 		=> $hasil->namaayah,
						'namaibu' 		=> $hasil->namaibu,	
						'kerjaayah' 	=> $hasil->kerjaayah,
						'kerjaibu'		=> $hasil->kerjaibu,
						'wali'			=> $hasil->wali,
						'pekerjaanwali'	=> $hasil->pekerjaanwali,
						'erte'			=> $hasil->erte,
						'erwe'			=> $hasil->erwe,
						'alamatortu'	=> $hasil->alamatortu,
						'kelurahan'		=> $hasil->kelurahan,
						'kecamatan'		=> $hasil->kecamatan,
						'kota'			=> $hasil->kota,
						'kodepos'		=> $hasil->kodepos,
						'klspos'		=> $hasil->klspos,			
						'foto'			=> $hasil->foto,
						'tamasuk'		=> $hasil->tamasuk,
						'hape'			=> $hasil->hape,
						'asal'			=> $hasil->asal,
						'mutasi'		=> $hasil->mutasi,
						'jilid'			=> $hasil->jilid,
						'nokelulusan'	=> $hasil->nokelulusan,
						'lampiran'		=> $lampiran,
					);
				}
			}
		}
		echo json_encode($arrsiswa);
	}
	public function jsonCariDatainduk(Request $request) {
		$arrsiswa 		= [];
		$homebase		= url("/");
		$jenis 			= $request->val01;
		$valcari 		= $request->val02;
		if ($jenis == 'keaktifankelas'){
			$arraysurat	= [];
			$i 			= 0;
			$data		= new Loginputnilai();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			$data 		= $data->where('niy', $valcari);
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('tanggal', 'like', "%$searchTerm%")
						->orWhere('matpel', 'like', "%$searchTerm%")
						->orWhere('jennilai', 'like', "%$searchTerm%")
						->orWhere('tapel', 'like', "%$searchTerm%")
						->orWhere('kodekd', 'like', "%$searchTerm%")
						->orWhere('kelas', 'like', "%$searchTerm%");
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
					'message'	=> 'List Data Keaktifan Kelas',
					'total'		=> $totaldata,
					'data'		=> $arraysurat
				];
				return response()->json($response, 200);
			}
			$response = [
				'message'        => 'No Data'
			];
			return response()->json($response, 500);
		} else if ($jenis == 'finger'){
			$arraysurat	= [];
			$i 			= 0;
			$data		= new Presensifinger();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			$data 		= $data->where('nip', $valcari);
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('tanggal', 'like', "%$searchTerm%")
						->orWhere('tanggalscan', 'like', "%$searchTerm%")
						->orWhere('jam', 'like', "%$searchTerm%")
						->orWhere('kantor', 'like', "%$searchTerm%")
						->orWhere('departemen', 'like', "%$searchTerm%")
						->orWhere('jabatan', 'like', "%$searchTerm%");
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
					'message'	=> 'List Data Finger',
					'total'		=> $totaldata,
					'data'		=> $arraysurat
				];
				return response()->json($response, 200);
			}
			$response = [
				'message'        => 'No Data'
			];
			return response()->json($response, 500);
		} else if ($jenis == 'logpribadi'){
			$arraysurat	= [];
			$i 			= 0;
			$data		= new Logstaff();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			$data 		= $data->where('sopo', $valcari);
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data 		= $data->where('kelakuan', '%'.$searchTerm.'%');
			}
			$data		= $data->orderByRaw($order)->paginate($limit);
			$totaldata	= $data->total();
			if ($data) {
				foreach($data as $rows){
					$arraysurat[$i] = $rows;
					$i++;
				}
				$response = [
					'message'	=> 'List Log Pribadi',
					'total'		=> $totaldata,
					'data'		=> $arraysurat
				];
				return response()->json($response, 200);
			}
			$response = [
				'message'        => 'No Data'
			];
			return response()->json($response, 500);
		} else if ($jenis == 'alquran'){
			$arraysurat	= [];
			$i 			= 0;
			$data		= new Datasetorantahfid();
			$limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
			$order		= ($request->input('order') == null ? 'id desc' : $request->input('order'));
			$data 		= $data->where('inputor', $valcari);
			if ($request->has('search') && !empty($request->search)) {
				$searchTerm = $request->search;
				$data->where(function ($q) use ($searchTerm) {
					$q->where('tanggal', 'like', "%$searchTerm%")
						->orWhere('tapel', 'like', "%$searchTerm%")
						->orWhere('semester', 'like', "%$searchTerm%");
				});
			}
			$dataGroupedByDate 	= $data->groupBy('tanggal')->get();
			$countTanggal 		= [];
			foreach ($dataGroupedByDate as $datakelompok) {
				$tanggal = $datakelompok->tanggal;
				if (!isset($countTanggal[$tanggal])) {
					$countTanggal[$tanggal] = 0;
				}
				$countTanggal[$tanggal]++;
			}
			$data = $data->orderByRaw($order)->paginate($limit);
			$totaldata	= $data->total();
			if ($data->count() > 0) {
				foreach ($data as $rows) {
					$rows->count_tanggal 	= isset($countTanggal[$rows->tanggal]) ? $countTanggal[$rows->tanggal] : 0;
					$arraysurat[] 			= $rows;
				}
				$response = [
					'message' 	=> 'List Keaktifan Alquran',
					'total' 	=> $totaldata,
					'data' 		=> $arraysurat
				];
				return response()->json($response, 200);
			}
			$response = [
				'message'        => 'No Data'
			];
			return response()->json($response, 500);
		} else {
			$getallsiswa 	= Datainduk::where('tamasuk', $valcari)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('noinduk', 'DESC')->get();
			if (!empty($getallsiswa)){
				foreach ($getallsiswa as $hasil) {
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
					$arrsiswa[] = array(
						'id' 			=> $hasil->id,	
						'nik' 			=> $hasil->nik,
						'nama' 			=> $hasil->nama,	
						'kelamin' 		=> $hasil->kelamin,
						'tmplahir' 		=> $hasil->tmplahir,
						'tgllahir' 		=> $hasil->tgllahir,
						'noinduk' 		=> $hasil->noinduk,
						'nisn' 			=> $hasil->nisn,
						'darah' 		=> $hasil->darah,
						'tinggi' 		=> $hasil->tinggi,
						'berat' 		=> $hasil->berat,
						'namaayah' 		=> $hasil->namaayah,
						'namaibu' 		=> $hasil->namaibu,	
						'kerjaayah' 	=> $hasil->kerjaayah,
						'kerjaibu'		=> $hasil->kerjaibu,
						'wali'			=> $hasil->wali,
						'pekerjaanwali'	=> $hasil->pekerjaanwali,
						'erte'			=> $hasil->erte,
						'erwe'			=> $hasil->erwe,
						'alamatortu'	=> $hasil->alamatortu,
						'kelurahan'		=> $hasil->kelurahan,
						'kecamatan'		=> $hasil->kecamatan,
						'kota'			=> $hasil->kota,
						'kodepos'		=> $hasil->kodepos,
						'klspos'		=> $hasil->klspos,			
						'foto'			=> $hasil->foto,
						'tamasuk'		=> $hasil->tamasuk,
						'hape'			=> $hasil->hape,
						'asal'			=> $hasil->asal,
						'mutasi'		=> $hasil->mutasi,
						'nokelulusan'	=> $hasil->nokelulusan,
						'lampiran'		=> $lampiran,
					);
				}
			}
			if (Session('email') !== null){
				$getallsiswa 	= Datainduk::where('kodeortuasuh', Session('email'))->orderBy('noinduk', 'DESC')->get();
				if (!empty($getallsiswa)){
					foreach ($getallsiswa as $hasil) {
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
						$arrsiswa[] = array(
							'id' 			=> $hasil->id,	
							'nik' 			=> $hasil->nik,
							'nama' 			=> $hasil->nama,	
							'kelamin' 		=> $hasil->kelamin,
							'tmplahir' 		=> $hasil->tmplahir,
							'tgllahir' 		=> $hasil->tgllahir,
							'noinduk' 		=> $hasil->noinduk,
							'nisn' 			=> $hasil->nisn,
							'darah' 		=> $hasil->darah,
							'tinggi' 		=> $hasil->tinggi,
							'berat' 		=> $hasil->berat,
							'namaayah' 		=> $hasil->namaayah,
							'namaibu' 		=> $hasil->namaibu,	
							'kerjaayah' 	=> $hasil->kerjaayah,
							'kerjaibu'		=> $hasil->kerjaibu,
							'wali'			=> $hasil->wali,
							'pekerjaanwali'	=> $hasil->pekerjaanwali,
							'erte'			=> $hasil->erte,
							'erwe'			=> $hasil->erwe,
							'alamatortu'	=> $hasil->alamatortu,
							'kelurahan'		=> $hasil->kelurahan,
							'kecamatan'		=> $hasil->kecamatan,
							'kota'			=> $hasil->kota,
							'kodepos'		=> $hasil->kodepos,
							'klspos'		=> $hasil->klspos,			
							'foto'			=> $hasil->foto,
							'tamasuk'		=> $hasil->tamasuk,
							'hape'			=> $hasil->hape,
							'asal'			=> $hasil->asal,
							'mutasi'		=> $hasil->mutasi,
							'nokelulusan'	=> $hasil->nokelulusan,
							'lampiran'		=> $lampiran,
						);
					}
				}
			}
			echo json_encode($arrsiswa);
		}
	}
	public function jrekapthnini() {
		$arrrekap 	= [];
		$tahun		= date("Y");
		$beras 		= 0;
		$uang 		= 0;
		$maal		= 0;
		$shodaqoh	= 0;
		$getallthn 	= Pembayaranzis::where('created_at', 'LIKE', $tahun.'%')->where('tglvalidasi', '!=', '0000-00-00')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$jeniszakat		= $rdatane->jeniszakat;
				$nominal		= $rdatane->nominal;
				$zakatmaal		= $rdatane->zakatmaal;
				$donasi			= $rdatane->donasi;
				if ($jeniszakat == 'Uang'){
					$uang 		= $uang + $nominal;
				} else {
					$beras 		= $beras + $nominal;
				}
				$maal 			= $maal + $zakatmaal;
				$shodaqoh		= $shodaqoh + $donasi;
			}
		}
		$arrrekap[] 	= array(
			'jenis' 	=> 'Zakat Fitrah Beras',
			'jumlah' 	=> $beras,
		);
		$arrrekap[] 	= array(
			'jenis' 	=> 'Zakat Fitrah Uang',
			'jumlah' 	=> $uang,
		);
		$arrrekap[] 	= array(
			'jenis' 	=> 'Zakat Maal',
			'jumlah' 	=> $maal,
		);
		$arrrekap[] 	= array(
			'jenis' 	=> 'Shodaqoh/Donasi',
			'jumlah' 	=> $shodaqoh,
		);
		echo json_encode($arrrekap);
	}
	public function jallData(Request $request) {
		$bulan   	=   $request->val01;
		$tahun   	=   $request->val02;
		$jenis 		=   $request->val03;
		
		if ($jenis == 'ALL'){
			if ($tahun == 'TAHUNINI'){
				$tahun 		= date("Y");
				$getallthn 	= Pembayaranzis::where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
			} else {
				if ($bulan == 'ALL'){
					$getallthn 	= Pembayaranzis::where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
				} else { 
					$valcari 	= $tahun.'-'.$bulan;
					$getallthn 	= Pembayaranzis::where('created_at', 'LIKE', $valcari.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
				}
			}
		} else {
			if ($jenis== 'Shodaqoh'){
				if ($tahun == 'TAHUNINI'){
					$tahun 		= date("Y");
					$getallthn 	= Pembayaranzis::where('donasi', '!=', '0')->where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
				} else {
					if ($bulan == 'ALL'){
						$getallthn 	= Pembayaranzis::where('donasi', '!=', '0')->where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
					} else { 
						$valcari 	= $tahun.'-'.$bulan;
						$getallthn 	= Pembayaranzis::where('donasi', '!=', '0')->where('created_at', 'LIKE', $valcari.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
					}
				}
			}
			else if ($jenis== 'Maal'){
				if ($tahun == 'TAHUNINI'){
					$tahun 		= date("Y");
					$getallthn 	= Pembayaranzis::where('zakatmaal', '!=', '0')->where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
				} else {
					if ($bulan == 'ALL'){
						$getallthn 	= Pembayaranzis::where('zakatmaal', '!=', '0')->where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
					} else { 
						$valcari 	= $tahun.'-'.$bulan;
						$getallthn 	= Pembayaranzis::where('zakatmaal', '!=', '0')->where('created_at', 'LIKE', $valcari.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
					}
				}
			}
			else {
				if ($tahun == 'TAHUNINI'){
					$tahun 		= date("Y");
					$getallthn 	= Pembayaranzis::where('nominal', '!=', '0')->where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
				} else {
					if ($bulan == 'ALL'){
						$getallthn 	= Pembayaranzis::where('nominal', '!=', '0')->where('created_at', 'LIKE', $tahun.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
					} else { 
						$valcari 	= $tahun.'-'.$bulan;
						$getallthn 	= Pembayaranzis::where('nominal', '!=', '0')->where('created_at', 'LIKE', $valcari.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('updated_at', 'ASC')->get();
					}
				}
			}
		}
		$alldata 	= [];
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$jeniszakat		= $rdatane->jeniszakat;
				$nominal		= $rdatane->nominal;
				$zakatmaal		= $rdatane->zakatmaal;
				$donasi			= $rdatane->donasi;
				$uang 			= 0;
				$beras 			= 0;
				if ($jeniszakat == 'Uang'){
					$uang 		= $nominal;
				} else { $beras = $nominal; }
				$total 			= $uang + $zakatmaal + $donasi;
				$alldata[] 		= array(
					'idne'			=> $rdatane->id,
					'namawali'		=> $rdatane->namawali,
					'hape'			=> $rdatane->hape,
					'namasiswa'		=> $rdatane->namasiswa,
					'kelas'			=> $rdatane->kelas,
					'jeniszakat'	=> $jeniszakat,
					'orang'			=> $rdatane->orang,
					'beras'			=> $beras,
					'uang'			=> $uang,
					'nominal'		=> $nominal,
					'zakatmaal'		=> $zakatmaal,
					'donasi'		=> $donasi,
					'total'			=> $total,
					'validator'		=> $rdatane->validator,
					'tglvalidasi'	=> $rdatane->tglvalidasi,
					'namafile'		=> $rdatane->namafile,
				);
			}
		}
		echo json_encode($alldata);
	}
	public function exVerifikasi(Request $request) {
		$idne   		=   $request->val01;
		$verifikasi   	=   $request->val02;
		$keterangan   	=   $request->val03;
		if ($keterangan == 'hapusdata'){
			if ($verifikasi == 'SAYA YAKIN'){
				$hapus = Pembayaranzis::where('id', $idne)->delete();
				if ($hapus){
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses</h4>
							Pembayaranzis Zakat, Infaq dan Shodaqoh Anda Telah Kami Hapus</strong>
						</div>';
				}else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							System Down, Mohon di Coba Beberapa Saat Lagi
						</div>';
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error</h4>
						Password Hapus Data Salah, Silahkan Tanyakan Admin Bila Anda Lupa
					</div>';
			}
		} else {
			if ($verifikasi != '' AND $keterangan != ''){
				$idinput 	= 	Pembayaranzis::where('id', $idne)->update([
					'validator'		=> $verifikasi, 
					'tglvalidasi'	=> $keterangan,
				]);
				if ($idinput){
					$homebase		= url("/");
					$alamatweb		= $homebase.'/verifikasi/'.$idne;
					
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses</h4>
							Pembayaranzis Zakat, Infaq dan Shodaqoh Anda Telah Kami Terima, Mohon kirim Link Berikut ke Pembayar Zakat Sebagai Kwitansi Digital Anda<br />
							<strong><h3><a href="'.$alamatweb.'">'.$alamatweb.'</a></h3></strong>
						</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							System Down, Mohon di Coba Beberapa Saat Lagi
						</div>';
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error</h4>
						Nama dan Tanggal Wajib di Isi
					</div>';
			}
		}
	}
	public function exDataindukstaf(Request $request) {
		$nama 		= $request->id_nama;
		$ttl		= $request->id_ttl;
		$nuptk		= $request->id_nuptk;
		$niy		= $request->id_niy;
		$kelamin	= $request->id_kelamin;
		$agama		= $request->id_agama;
		$status		= $request->id_status;
		$jabatan	= $request->id_jabatan;
		$ijasah		= $request->id_ijasah;
		$alamat		= $request->id_alamat;
		$hape		= $request->id_hape;
		$tmt		= $request->id_tmt;
		$finger		= $request->id_finger;
		
		if($nama == '' OR $ttl == '' OR $niy == '' OR $kelamin == '' OR $agama == '' OR $jabatan == '' OR $hape == '' OR $alamat == '' OR $nuptk == '' OR $status == '' OR $ijasah == ''){
			$error ='Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						Nama : '.$nama.'<br />
						TTL : '.$ttl.'<br />
						Kelamin : '.$kelamin.'<br />
						No. HP : '.$hape.'<br />
						Alamat : '.$alamat.'<br />
						No. Induk : '.$niy.'<br /> Apabila ada data yang kosong, mohon di isi dengan strip (-) atau angka 0 (nol)';
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
		} else {
			$niy		= preg_replace('/\s/', '', $niy);
			$niy		= str_replace('/', '', $niy);
			$ceksudah 	= Dataindukstaff::where('niy', $niy)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
			if ($ceksudah != 0){
				$error = 'Nomor Induk Tidak Boleh Sama';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			} else {
				$input = Dataindukstaff::create([
					'nama'		=> $nama, 
					'ttl'		=> $ttl, 
					'nuptk'		=> $nuptk, 
					'niy'		=> $niy, 
					'kelamin'	=> $kelamin, 
					'agama'		=> $agama, 
					'ijasah'	=> $ijasah, 
					'jabatan'	=> $jabatan, 
					'statpeg'	=> $status, 
					'alamat'	=> $alamat, 
					'notelp'	=> $hape, 
					'foto'		=> '', 
					'klsajar'	=> '', 
					'smt'		=> '', 
					'tapel'		=> '',
					'tmt'		=> $tmt,
					'idfinger'	=> $finger,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				if ($input){
					if ($request->hasFile('id_foto')) {
						$validator = Validator::make($request->all(), [
							'file' =>  'mimes:jpg,jpeg,png,PNG,JPG,JPEG|max:20000'
						]);
						if ($validator->fails()) {
							$error = 'Gagal menyimpan foto, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan';
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
							return back();
						} else {
							$namafile		= 'STAF-'.$niy.'.'.$request->file('id_foto')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('id_foto');
							Storage::putFileAs('dist/img/foto/',$uploadedFile,$namafile);
							Dataindukstaff::where('niy', $niy)->where('id_sekolah', session('sekolah_id_sekolah'))->update([
								'foto' => $namafile
							]);
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Induk Berhasil di Simpan']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Induk Berhasil di Simpan']);
						return back();
					}
				} else {
					$error = 'Data Staf Gagal di Simpan, Ulangi Beberapa Saat lagi';
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
					return back();
				}
			}
		}
	}
	public function exupdDataindukstaff(Request $request) {
		$nama 		= $request->edit_nama;
		$ttl		= $request->edit_ttl;
		$nuptk		= $request->edit_nuptk;
		$niy		= $request->edit_niy;
		$kelamin	= $request->edit_kelamin;
		$agama		= $request->edit_agama;
		$status		= $request->edit_status;
		$jabatan	= $request->edit_jabatan;
		$ijasah		= $request->edit_ijasah;
		$alamat		= $request->edit_alamat;
		$hape		= $request->edit_hape;
		$idne		= $request->edit_idne;
		$tmt		= $request->edit_tmt;
		$finger		= $request->edit_finger;
		if($nama == '' OR $ttl == '' OR $niy == '' OR $kelamin == '' OR $agama == '' OR $jabatan == '' OR $hape == '' OR $alamat == '' OR $nuptk == '' OR $status == '' OR $ijasah == ''){
			$error ='Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						Nama : '.$nama.'<br />
						TTL : '.$ttl.'<br />
						Kelamin : '.$kelamin.'<br />
						No. HP : '.$hape.'<br />
						Alamat : '.$alamat.'<br />
						No. Induk : '.$niy.'<br /> Apabila ada data yang kosong, mohon di isi dengan strip (-) atau angka 0 (nol)';
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
			return back();
		} else {
			$getfotolama 	= Dataindukstaff::where('id', $idne)->first();
			$fotolama		= $getfotolama->foto;
			$niylama		= $getfotolama->niy;
			$niy			= preg_replace('/\s/', '', $niy);
			$niy			= str_replace('/', '', $niy);
			if ($request->hasFile('edit_foto')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PNG,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					$error = 'Gagal menyimpan foto, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan';
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
					return back();
				} else {
					if ($fotolama != ''){
						if (File::exists(base_path() ."/public/dist/img/foto/". $fotolama)) {
							File::delete(base_path() ."/public/dist/img/foto/". $fotolama);
						}
					}
					$namafile		= 'STAF-'.$niy.'.'.$request->file('edit_foto')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('edit_foto');
					Storage::putFileAs('dist/img/foto/',$uploadedFile,$namafile);
					Dataindukstaff::where('id', $idne)->update([
						'foto' => $namafile
					]);
				}
			}
			$ceksudah 	= Dataindukstaff::where('id', '!=', $idne)->where('niy', $niy)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
			if ($ceksudah != 0){
				$error = 'Nomor Induk Tidak Boleh Sama';
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
				return back();
			} else {
				$input = Dataindukstaff::where('id', $idne)->update([
					'nama'		=> $nama, 
					'ttl'		=> $ttl, 
					'nuptk'		=> $nuptk,
					'kelamin'	=> $kelamin, 
					'agama'		=> $agama, 
					'ijasah'	=> $ijasah, 
					'jabatan'	=> $jabatan, 
					'statpeg'	=> $status, 
					'alamat'	=> $alamat, 
					'notelp'	=> $hape, 
					'niy'		=> $niy,
					'tmt'		=> $tmt,
					'idfinger'	=> $finger,
					'updated_at'=> date("Y-m-d H:i:s")
				]);
				if ($input){
					Logstaff::where('sopo', $niylama)->update([
						'sopo'		=> $niy,
					]);
					return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Induk Berhasil di Update']);
					return back();
				} else {
					$error = 'Data Staf Gagal di Update, Ulangi Beberapa Saat lagi';
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $error]);
					return back();
				}
			}
		}
	}
	public function exPresFinger(Request $request) {
		$arrstaf 	= [];
		$tapel 		= $request->tapel;
		$semester	= $request->semester;
		$jumlah 	= 0;
		if ($request->hasFile('file')) {
			$path 			= $_FILES['file']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				$tanggalscan	= $val['A'];
				$tanggal		= $val['B'];
				$jam			= $val['C'];
				$pin			= $val['D'];
				$nip			= $val['E'];
				$nama			= $val['F'];
				$jabatan		= $val['G'];
				$departemen  	= $val['H'];
				$kantor  		= $val['I'];
				$verifikasi  	= $val['J'];
				$deviceio  		= $val['K'];
				$workcode  		= $val['L'];
				$sndevice  		= $val['M'];
				$mesin  		= $val['N'];
				$recreatetgl 	= explode('-', $tanggal);
				if (isset($recreatetgl[2])){
					$dd 		= $recreatetgl[0];
					$mm 		= $recreatetgl[1];
					$yy 		= $recreatetgl[2];
					$tanggal	= $yy.'-'.$mm.'-'.$dd;
					$tanggalscan= $tanggal.' '.$jam;
				}
				if ($tanggalscan != 'Tanggal scan'){
					$cekpeg 	= Dataindukstaff::where('idfinger', $pin)->first();
					if (isset($cekpeg->id)){
						$jabatan= $cekpeg->jabatan;
						$nip 	= $cekpeg->niy;
						$catatan= 'PIN di Temukan';
					} else {
						$catatan= 'PIN Tidak di Temukan';
					}
					$input = Presensifinger::updateOrCreate(
						[
							'pin' 			=> $pin,
							'tanggalscan' 	=> $tanggalscan,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						],
						[
							'tanggalscan' 	=> $tanggalscan,
							'tanggal' 		=> $tanggal,
							'jam' 			=> $jam,
							'pin' 			=> $pin,
							'nip' 			=> $nip,
							'nama' 			=> $nama,
							'jabatan' 		=> $jabatan,
							'departemen' 	=> $tapel,
							'kantor' 		=> $semester,
							'verifikasi' 	=> $verifikasi,
							'deviceio' 		=> $deviceio,
							'workcode' 		=> $workcode,
							'serialnumber' 	=> $sndevice,
							'namamesin' 	=> $mesin,
							'id_sekolah' 	=> session('sekolah_id_sekolah')
						]
					);
					if ($input){
						$arrstaf[] = array(
							'tanggalscan' 	=> $tanggalscan,
							'tanggal' 		=> $tanggal,
							'jam' 			=> $jam,
							'pin' 			=> $pin,
							'nip' 			=> $nip,
							'nama' 			=> $nama,
							'jabatan' 		=> $jabatan,
							'departemen' 	=> $tapel,
							'kantor' 		=> $semester,
							'verifikasi' 	=> $verifikasi,
							'deviceio' 		=> $deviceio,
							'workcode' 		=> $workcode,
							'serialnumber' 	=> $sndevice,
							'namamesin' 	=> $mesin,
							'catatan'		=> $catatan,
							'status'		=> 'Sukses'
						);
						$jumlah++;
					} else {
						$arrstaf[] = array(
							'tanggalscan' 	=> $tanggalscan,
							'tanggal' 		=> $tanggal,
							'jam' 			=> $jam,
							'pin' 			=> $pin,
							'nip' 			=> $nip,
							'nama' 			=> $nama,
							'jabatan' 		=> $jabatan,
							'departemen' 	=> $tapel,
							'kantor' 		=> $semester,
							'verifikasi' 	=> $verifikasi,
							'deviceio' 		=> $deviceio,
							'workcode' 		=> $workcode,
							'serialnumber' 	=> $sndevice,
							'namamesin' 	=> $mesin,
							'catatan'		=> $catatan,
							'status'		=> 'Gagal'
						);
					}
				}
			}
		}
		$arrstaf = json_encode($arrstaf);
		return response()->json(['data' => $arrstaf, 'icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Presensi Sejumlah '.$jumlah.' Sukses di Import']);
		return back();
		
	}
	public function jsonDataindukstaff() {
		$arrstaf 		= [];
		$homebase		= url("/");
		$getallstaf 	= Dataindukstaff::orderBy('niy', 'DESC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($getallstaf)){
			foreach ($getallstaf as $hasil) {
				$foto 		= $hasil->foto;
				if ($foto != ''){
					if (File::exists(base_path() ."/public/dist/img/foto/". $foto)) {
						$lampiran	= '<img src="'.$homebase.'/dist/img/foto/'.$foto.'" height="35">';
					} else {
						$lampiran	= '<img src="'.$homebase.'/'.Session('sekolah_logo').'" height="35">';
					}
				} else {
					$lampiran	= '<img src="'.$homebase.'/'.Session('sekolah_logo').'" height="35">';
				}
				$arrstaf[] = array(
					'id' 			=> $hasil->id,	
					'nama' 			=> $hasil->nama,		
					'ttl' 			=> $hasil->ttl,
					'nuptk' 		=> $hasil->nuptk,
					'niy' 			=> $hasil->niy,
					'kelamin' 		=> $hasil->kelamin,
					'agama' 		=> $hasil->agama,
					'ijasah' 		=> $hasil->ijasah,
					'jabatan' 		=> $hasil->jabatan,
					'statpeg' 		=> $hasil->statpeg,
					'alamat' 		=> $hasil->alamat,	
					'notelp' 		=> $hasil->notelp,
					'foto' 			=> $hasil->foto,
					'tmt' 			=> $hasil->tmt,
					'idfinger' 		=> $hasil->idfinger,
					'lampiran'		=> $lampiran,
				);
			}
		}		
		echo json_encode($arrstaf);
	}
	public function jsonSetinsidental() {
		$arrinsidental		= [];
		$homebase			= url("/");
		$getaktifinsidental = Insidental::where('aktifasi', 'aktif')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
		if (!empty($getaktifinsidental)){
			foreach ($getaktifinsidental as $hasil) {
				$arrinsidental[] = array(
					'id' 		=> $hasil->id,
					'deskripsi'	=> $hasil->deskripsi,
					'kode'		=> $hasil->kode,
					'bataswaktu'=> $hasil->bataswaktu,
					'aktifasi'	=> $hasil->aktifasi,
					'jenis'		=> $hasil->jenis,
					'operator'	=> $hasil->operator,
					'timestamp'	=> $hasil->timestamp,
					'biaya'		=> number_format( $hasil->biaya , 0 , '.' , ',' ),
				);
			}
		}		
		echo json_encode($arrinsidental);
	}
	public function jsonEkskul() {
		$arrekskul		= [];
		$homebase		= url("/");
		$getalekskul 	= Ekstrakulikuler::where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
		if (!empty($getalekskul)){
			foreach ($getalekskul as $hasil) {
				$set01		= $hasil->nama;
				$jumlah 	= DB::table('db_setkeuangan')
								->join('db_datainduk', 'db_setkeuangan.noinduk', 'db_datainduk.noinduk')
								->where('db_setkeuangan.id_sekolah', session('sekolah_id_sekolah'))
								->where('db_datainduk.nokelulusan', '')
								->where(function ($query) use ($set01) {
								$query->where('db_setkeuangan.eksul1', $set01)
									->orWhere('db_setkeuangan.eksul2', $set01)
									->orWhere('db_setkeuangan.eksul3', $set01)
									->orWhere('db_setkeuangan.eksul4', $set01)
									->orWhere('db_setkeuangan.eksul5', $set01);
							})->count();
				$arrekskul[] = array(
					'id' 		=> $hasil->id,
					'namaeksul'	=> $hasil->nama,
					'peminat'	=> $jumlah,
					'biaya'		=> number_format( $hasil->biaya , 0 , '.' , ',' ),
				);
			}
		}		
		echo json_encode($arrekskul);
	}
	public function exInsidental(Request $request) {
		$kode 		= $request->val01;
		$jenis 		= $request->val02;
		$biaya 		= $request->val03;
		$deskripsi 	= $request->val04;
		$tenggat 	= $request->val05;
		$pengarah 	= $request->val06;
		if($kode == '' or $jenis == '' or $biaya == '' or $deskripsi == '' or $tenggat == '' or $pengarah == ''){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Pastikan Data Wajib Telah Terisi Nominalnya (Kode, Jenis, Deskripsi, Tenggat)							 
				</div>';
		} else {
			$jumlah 	= str_replace(',','',$biaya);
			if ($pengarah == 'baru'){
				$cekmasuk = Insidental::where('kode', $kode)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekmasuk == 0){
					$input = Insidental::create([
						'deskripsi'		=> $deskripsi, 
						'kode'			=> $kode, 
						'biaya'			=> $jumlah,
						'bataswaktu'	=> $tenggat,
						'aktifasi'		=> 'aktif',
						'jenis'			=> $jenis,
						'operator'		=> Session('nama'),
						'id_sekolah' 	=> session('sekolah_id_sekolah')
					]);
					if($input){
						echo '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Sukses</h4>
								Data Insidental. '.$deskripsi .' Berhasil Di Simpan
							</div>'; 	
					} else { 			
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Gagal menyimpan 
							</div>';	
					}
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Data Insidental. '.$deskripsi .' Gagal disimpan (kode sudah ada)
						</div>';	
				}
			} else {
				if ($jumlah == 0){ $aktif = 'disabled'; }
				else { $aktif = 'aktif'; }
				$input = Insidental::where('kode', $kode)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'deskripsi'		=> $deskripsi, 
					'biaya'			=> $jumlah,
					'bataswaktu'	=> $tenggat,
					'aktifasi'		=> $aktif,
					'jenis'			=> $jenis,
					'id_sekolah'	=> session('sekolah_id_sekolah'),
				]);
				if($input){
					$deskripsi 		= Session('nama').' Telah Mengubah Data Insidental '.$deskripsi.' Berkode. '.$kode. ' Menjadi '.$jumlah;
					Logstaff::create([
						'jenis'		=> 'Setting Tagihan',
						'sopo'		=> Session('nip'),
						'kelakuan'	=> $deskripsi,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses</h4>
							'.$deskripsi .'
						</div>'; 	
				} else { 			
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Gagal menyimpan 
						</div>';	
				}
			}			
		}
	}
	public function exEkskul(Request $request) {
		$nama 		= $request->val01;
		$biaya 		= $request->val02;
		$idne 		= $request->val04;
		$aktif 		= $request->val03;
		if($nama == '' or $biaya == ''){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Pastikan Data Wajib Telah Terisi Bila Biaya tidak ada, di isi angka 0 
				</div>';
		} else {
			$jumlah 	= str_replace(',','',$biaya);
			if ($idne == ''){
				$cekmasuk = Ekstrakulikuler::where('nama', $nama)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekmasuk == 0){
					$input = Ekstrakulikuler::create([
						'nama'		=> $nama, 
						'biaya'		=> $jumlah,
						'status'	=> $aktif,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					if($input){
						echo '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Sukses</h4>
								Sukses Memasukkan '.$nama.' dengan Biaya '.$biaya.' Laman akan di refresh dalam 2 detik
							</div>'; 	
					} else { 			
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Gagal menyimpan 
							</div>';	
					}
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Data '.$nama.' Gagal disimpan (nama sudah ada)
						</div>';	
				}
			} else {
				$cekmasuk = Ekstrakulikuler::where('nama', $nama)->where('id', '!=', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekmasuk == 0){
					$input = Ekstrakulikuler::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'nama'		=> $nama, 
						'biaya'		=> $jumlah,
						'status'	=> $aktif,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					if($input){
						echo '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Sukses</h4>
								Sukses Updating '.$nama.' dengan Biaya '.$biaya.' Laman akan di refresh dalam 2 detik
							</div>'; 	
					} else { 			
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Gagal menyimpan
							</div>';	
					}
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Data '.$nama.' Gagal disimpan (nama sudah ada)
						</div>';	
				}
			}
		}
	}
	public function exSetkeuangan(Request $request) {
		$nama 		= $request->val01;
		$noinduk 	= $request->val02;
		$ndpp 		= $request->val03;
		$nspp 		= $request->val04;
		$npaguyuban = $request->val05;
		$ekskul1 	= $request->val06;
		$ekskul2 	= $request->val07;
		$ekskul3 	= $request->val08;
		$ekskul4 	= $request->val09;
		$ekskul5 	= $request->val10;
		if($nama == '' or $ndpp == '' or $nspp == '' or $npaguyuban == '' or $noinduk == ''){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Pastikan Data Wajib Telah Terisi Bila Biaya tidak ada, di isi angka 0 
				</div>';
		} else {
			$dpp 		= str_replace(',','',$ndpp);
			$spp 		= str_replace(',','',$nspp);
			$paguyuban 	= str_replace(',','',$npaguyuban);
			$cekmasuk 	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($cekmasuk == 0){
				$input 	= Setkuangan::create([
					'nama'		=> $nama, 
					'noinduk'	=> $noinduk, 
					'dpp'		=> '',
					'spp'		=> '',
					'paguyuban' => '',
					'eksul1'	=> '',
					'eksul2'	=> '',
					'eksul3'	=> '',
					'eksul4'	=> '',
					'eksul5'	=> '',
					'id_sekolah'=> session('sekolah_id_sekolah'),
				]);
				Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'dpp'		=> $dpp,
					'spp'		=> $spp,
					'paguyuban' => $paguyuban,
					'eksul1'	=> $ekskul1,
					'eksul2'	=> $ekskul2,
					'eksul3'	=> $ekskul3,
					'eksul4'	=> $ekskul4,
					'eksul5'	=> $ekskul5,
					'id_sekolah'=> session('sekolah_id_sekolah'),
				]);
			} else {
				$input	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'dpp'		=> $dpp,
					'spp'		=> $spp,
					'paguyuban' => $paguyuban,
					'eksul1'	=> $ekskul1,
					'eksul2'	=> $ekskul2,
					'eksul3'	=> $ekskul3,
					'eksul4'	=> $ekskul4,
					'eksul5'	=> $ekskul5,
					'id_sekolah'=> session('sekolah_id_sekolah'),
				]);
			}
			if ($input){
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses</h4>
						Data an. '.$nama .' Berhasil Di Simpan
					</div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error</h4>
						Gagal menyimpan 
					</div>';	
			}
		}
	}
	public function jsonSetkeuangan(Request $request) {
		$homebase 	= url("/");
		$alldata 	= [];
		$kelas 		= $request->val01;
		$query 		= Datainduk::where('nokelulusan', '')->where('id_sekolah', session('sekolah_id_sekolah'));
		if ($kelas !== 'all') {
			$query->where('klspos', 'LIKE', $kelas . '%');
		}
		$getallsiswa = $query->get();
		if ($getallsiswa->isNotEmpty()) {
			foreach ($getallsiswa as $hasil) {
				$noinduk 	= $hasil->noinduk;
				$eksul1 	= '';
				$eksul2 	= '';
				$eksul3 	= '';
				$eksul4 	= '';
				$eksul5 	= '';
				$biaya1 	= '';
				$biaya2 	= '';
				$biaya3 	= '';
				$biaya4 	= '';
				$biaya5 	= '';
				$spp 		= 0;
				$dpp 		= 0;
				$paguyuban 	= 0;
				$foto 		= $hasil->foto;
				if (File::exists(base_path() . "/public/dist/img/foto/" . $foto)) {
					$lampiran = '<img src="' . $homebase . '/dist/img/foto/' . $foto . '" height="35">';
				} else {
					$lampiran = '<img src="' . $homebase . '/boxed-bg.jpg" height="35">';
				}
				$getdatakeu = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
				if ($getdatakeu !== null) {
					$spp 		= number_format($getdatakeu->spp, 0, '.', ',');
					$dpp 		= number_format($getdatakeu->dpp, 0, '.', ',');
					$paguyuban 	= number_format($getdatakeu->paguyuban, 0, '.', ',');
					$eksul1 	= $getdatakeu->eksul1;
					$eksul2 	= $getdatakeu->eksul2;
					$eksul3 	= $getdatakeu->eksul3;
					$eksul4 	= $getdatakeu->eksul4;
					$eksul5 	= $getdatakeu->eksul5;
					foreach ([$eksul1, $eksul2, $eksul3, $eksul4, $eksul5] as $i => $ekstrakulikuler) {
						if ($ekstrakulikuler !== '') {
							$cekbiaya = Ekstrakulikuler::where('nama', $ekstrakulikuler)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
							if ($cekbiaya !== null) {
								${"biaya" . ($i + 1)} = $cekbiaya->biaya;
							}
						}
					}
				}
				$alldata[] = [
					'id' 		=> $hasil->id,
					'noinduk' 	=> $hasil->noinduk,
					'dpp' 		=> $dpp,
					'spp' 		=> $spp,
					'paguyuban' => $paguyuban,
					'eksul1' 	=> $eksul1,
					'eksul2' 	=> $eksul2,
					'eksul3' 	=> $eksul3,
					'eksul4' 	=> $eksul4,
					'eksul5' 	=> $eksul5,
					'biaya1' 	=> $biaya1,
					'biaya2' 	=> $biaya2,
					'biaya3' 	=> $biaya3,
					'biaya4' 	=> $biaya4,
					'biaya5' 	=> $biaya5,
					'lampiran' 	=> $lampiran,
					'nama' 		=> $hasil->nama,
					'kelas' 	=> $hasil->klspos,
					'kelamin' 	=> $hasil->kelamin,
					'nisn' 		=> $hasil->nisn,
				];
			}
		}
		echo json_encode($alldata);
	}
	public function ctkViewdetailtu(Request $request) {
		$marking	= $request->valkirim;
		return redirect('ctkkwt/'.$marking);
	}
	public function ctkKwitansimulti(Request $request) {
		$arridne	= $request->valkirim;
		$jeneng		= Session('nama');
		$tanggal	= $request->tanggal;
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		if ($tanggal != ''){
			$arrayttl 	= explode("-", $tanggal);
			$tgliki 	= $arrayttl[0];
			$mthiki 	= (int)$arrayttl[1];
			$thniki 	= $arrayttl[2];
			$blniki 	= $bulanlist[$mthiki];
		} else {
			$tgliki 	= date('d');
			$mthiki 	= date('m');
			$mthiki 	= (int)$mthiki;
			$thniki 	= date('Y');
			$blniki 	= $bulanlist[$mthiki];
		}
		$tanggalctk = $tgliki.' '.$blniki.' '.$thniki;
		
		$total		= 0;
		$ekskula	= '';
		$ekskulb	= '';
		$ekskulc	= '';
		$ekskuld	= ''; 
		$ekskula2	= 0;
		$ekskulb2	= 0;
		$ekskulc2	= 0;
		$ekskuld2	= 0;
		$bulan		= '';
		$tahun		= '';
		$kelas		= '';
		$biayaspp	= 0;
		$biayadpp	= 0;
		$paguyuban	= 0;
		$bkegiatan  = 0;
		$bbukupaket	= 0;
		$bbukutulis	= 0;
		$lain1		= '';
		$lain1a		= 0;
		$lain2		= '';
		$lain2a		= 0;
		$lain3		= '';
		$lain3a		= 0;
		$tbukutulis = '';
		$tkegiatan  = '';
		$lain4 		= '';
		$lain4a		= 0;
		$ekskule 	= '';
		$ekskule2	= 0;
		$tbukupaket = '';
		$noinduk	= '';
		$nama		= '';
		$tulisbln	= '';
		$tlsbulan	= '';
		$gaksama	= '';
		foreach ($arridne as $idne) {
			$getmarking 	= Pembayaran::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$marking		= $getmarking->marking;			
			$sql 			= Pembayaran::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			if (!empty($sql)){
				foreach ($sql as $rrincian){
					$nama 		= $rrincian->nama;
					$noinduk 	= $rrincian->noinduk;
					$jenis 		= $rrincian->jenis;		
					$biaya 		= $rrincian->biaya;
					$bulane 	= $rrincian->bulan;
					$tahune 	= $rrincian->tahun;
					$kelas 		= $rrincian->kelas;
					if ($gaksama == ''){ $gaksama = $noinduk; }
					else { 
						if ($gaksama != $noinduk){ $gaksama = 'benar'; }
						else { $gaksama = $noinduk; }
					}
					$bulan		= $bulane.'-'.$tahune.',';
					if ($tulisbln != $bulan){ $tulisbln = $bulan; $tlsbulan = $tlsbulan.' '.$bulan; }
					$tahun		= $tahune;
					$total		= $total + $biaya;
					$cekekskul	= Ekstrakulikuler::where('nama', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekekskul != 0){
						if ( $ekskula == $jenis ){ $ekskula2 = $ekskula2 + $biaya; }
						else if ( $ekskulb == $jenis ){ $ekskulb2 = $ekskulb2 + $biaya; }
						else if ( $ekskulc == $jenis ){ $ekskulc2 = $ekskulc2 + $biaya; }
						else if ( $ekskuld == $jenis ){ $ekskuld2 = $ekskuld2 + $biaya; }
						else if ( $ekskule == $jenis ){ $ekskule2 = $ekskule2 + $biaya; }
						else if ($ekskula == ''){ $ekskula = $jenis; $ekskula2 = $ekskula2 + $biaya;}
						else if ($ekskulb == ''){ $ekskulb = $jenis; $ekskulb2 = $ekskulb2 + $biaya; }
						else if ($ekskulc == ''){ $ekskulc = $jenis; $ekskulc2 = $ekskulc2 + $biaya; }
						else if ($ekskuld == ''){ $ekskuld = $jenis; $ekskuld2 = $ekskuld2 + $biaya; }
						else { $ekskule = $jenis; $ekskule2 = $ekskule2 + $biaya; }		
					} else {
						if ($jenis == 'spp'){
							$biayaspp = $biayaspp + $biaya;
						} elseif ($jenis == 'dpp'){
							$biayadpp = $biayadpp + $biaya;
						} elseif ($jenis == 'Uang Makan'){
							$paguyuban = $paguyuban + $biaya;
						} else {
							$cekinsidental = Insidental::where('kode', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if (isset($cekinsidental->jenis)){
								$termasuk = $cekinsidental->jenis;
								$jenislain = $cekinsidental->deskripsi;
							} else {
								$termasuk 	= '';
								$jenislain 	= 'Deleted Insidental';
							}
							if ($termasuk == 'kegiatan'){ $bkegiatan = $bkegiatan + $biaya; }
							else if ($termasuk == 'bukupaket'){ $bbukupaket = $bbukupaket + $biaya; }
							else if ($termasuk == 'bukutulis'){ $bbukutulis = $bbukutulis + $biaya; }
							else {
								if ($lain1 == $jenislain){ $lain1a = $lain1a + $biaya; }
								else if ($lain2 == $jenislain){ $lain2a = $lain2a + $biaya; }
								else if ($lain3 == $jenislain){ $lain3a = $lain3a + $biaya; }
								else if ($lain4 == $jenislain){ $lain4a = $lain4a + $biaya; }
								else if ($lain1 == ''){
									$lain1 	= $jenislain;
									$lain1a = $lain1a + $biaya;
								}
								else if ($lain2 == ''){
									$lain2 	= $jenislain;
									$lain2a = $lain2a + $biaya;
								}
								else if ($lain3 == ''){
									$lain3 	= $jenislain;
									$lain3a = $lain3a + $biaya;
								}
								else {
									$lain4 	= $jenislain;
									$lain4a = $lain4a + $biaya;
								}
							}
						}
					}
				}
			}
		}
		$x 			= SendMail::terbilang($total);
		if ($ekskula2 != 0){
			$tekskula2	= number_format( $ekskula2 , 0 , '.' , ',' );
		} else { $tekskula2 = ''; }
		if ($ekskulb2 != 0){
			$tekskulb2	= number_format( $ekskulb2 , 0 , '.' , ',' );
		} else { $tekskulb2 = ''; }
		if ($ekskulc2 != 0){
			$tekskulc2	= number_format( $ekskulc2 , 0 , '.' , ',' );
		} else { $tekskulc2 = ''; }
		if ($ekskuld2 != 0){
			$tekskuld2	= number_format( $ekskuld2 , 0 , '.' , ',' );
		} else { $tekskuld2 = ''; }
		if ($ekskule2 != 0){
			$tekskule2	= number_format( $ekskule2 , 0 , '.' , ',' );
		} else { $tekskule2 = ''; }
		if ($biayaspp != 0){
			$tbiayaspp	= number_format( $biayaspp , 0 , '.' , ',' );
		} else { $tbiayaspp = ''; }
		if ($biayadpp != 0){
			$tbiayadpp	= number_format( $biayadpp , 0 , '.' , ',' );
		} else { $tbiayadpp = ''; }
		if ($paguyuban != 0){
			$tpaguyuban	= number_format( $paguyuban , 0 , '.' , ',' );
		} else { $tpaguyuban = ''; }
		if ($bkegiatan != 0){
			$tkegiatan	= number_format( $bkegiatan , 0 , '.' , ',' );
		} else { $tkegiatan = ''; }
		if ($bbukupaket != 0){
			$tbukupaket	= number_format( $bbukupaket , 0 , '.' , ',' );
		} else { $tbukupaket = ''; }
		if ($bbukutulis != 0){
			$tbukutulis	= number_format( $bbukutulis , 0 , '.' , ',' );
		} else { $tbukutulis = ''; }
		if ($lain1a != 0){
			$tlain1a	= number_format( $lain1a , 0 , '.' , ',' );
		} else { $tlain1a = ''; }
		if ($lain2a != 0){
			$tlain2a	= number_format( $lain2a , 0 , '.' , ',' );
		} else { $tlain2a = ''; }
		if ($lain3a != 0){
			$tlain3a	= number_format( $lain3a , 0 , '.' , ',' );
		} else { $tlain3a = ''; }
		if ($lain4a != 0){
			$tlain4a	= number_format( $lain4a , 0 , '.' , ',' );
		} else { $tlain4a = ''; }
		$tulisan					= number_format( $total , 0 , '.' , ',' );
		$y 							= $x.' rupiah';
		$niy 						= Session('nip');
		$asline 					= Session('nama');
		$rsetting					= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$sekolah 					= $rsetting->nama_sekolah;
		$yayasan 					= $rsetting->nama_yayasan;
		$alamat 					= $rsetting->alamat;
		$kepalasekolah 				= $rsetting->kepala_sekolah->nama;
		$mutiara 					= $rsetting->slogan;
		$logo 						= $rsetting->logo;
		$logogrey 					= $rsetting->logo_grey;
		$tasks						= [];
		$tasks['logo']				= $logo;
		$tasks['logo_grey']			= $rsetting->logo_grey;
		$tasks['rsetting']			= $rsetting;
		$tasks['yayasan']			= $yayasan;
		$tasks['sekolah']			= $sekolah;
		$tasks['alamat']			= $alamat;
		$tasks['nama']				= $nama;
		$tasks['kelas']				= $kelas;
		$tasks['y']					= $y;
		$tasks['tlsbulan']			= $tlsbulan;
		$tasks['tbiayaspp']			= $tbiayaspp;
		$tasks['tbukutulis']		= $tbukutulis;
		$tasks['tkegiatan']			= $tkegiatan;
		$tasks['tbukupaket']		= $tbukupaket;
		$tasks['tbiayadpp']			= $tbiayadpp;
		$tasks['tpaguyuban']		= $tpaguyuban;
		$tasks['ekskula']			= $ekskula;
		$tasks['tekskula2']			= $tekskula2;
		$tasks['lain1']				= $lain1;
		$tasks['tlain1a']			= $tlain1a;
		$tasks['ekskulb']			= $ekskulb;
		$tasks['tekskulb2']			= $tekskulb2;
		$tasks['lain2']				= $lain2;
		$tasks['tlain2a']			= $tlain2a;
		$tasks['ekskulc']			= $ekskulc;
		$tasks['tekskulc2']			= $tekskulc2;
		$tasks['lain3']				= $lain3;
		$tasks['tlain3a']			= $tlain3a;
		$tasks['ekskuld']			= $ekskuld;
		$tasks['tekskuld2']			= $tekskuld2;
		$tasks['lain4']				= $lain4;
		$tasks['tlain4a']			= $tlain4a;
		$tasks['ekskule']			= $ekskule;
		$tasks['tekskule2']			= $tekskule2;
		$tasks['tanggalctk']		= $tanggalctk;
		$tasks['tulisan']			= $tulisan;
		$tasks['mutiara']			= $mutiara;
		$tasks['asline']			= $asline;
		$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
		$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
		$tasks['addressapps01']  	= Session('sekolah_alamat');
		$tasks['emailapps01']  		= Session('sekolah_email');
		$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
		$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
		$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
		return view('cetak.kwitansimulti', $tasks);
	}
	public function exMultiverified(Request $request) {
		$arridne	= $request->val01;
		$tanggal	= $request->val03;
		$jeneng		= Session('nama');
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$arrayttl	= explode("-", $tanggal);
		$tgliki 	= $arrayttl[0];
		$mthiki 	= $arrayttl[1];
		$thniki 	= $arrayttl[2];
		$blniki 	= (int)$mthiki;
		$bulan 		= $bulanlist[$blniki];
		$harian 	= $tgliki.$bulan.$thniki;
		$setok		= '';
		foreach ($arridne as $idne) {
			$jmarking 	= Pembayaran::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$setmark	= $jmarking->marking;
			$noinduk 	= $jmarking->noinduk;
			$nama 		= $jmarking->nama;
			$bulane 	= $jmarking->bulan;
			$tahune 	= $jmarking->tahun;
			$verified 	= $jeneng.$tgliki.$mthiki.$thniki;
			$marking 	= $noinduk.$harian;
			$update		= Pembayaran::where('marking', $setmark)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
				'verifikasi'	=> $verified,
				'marking'		=> $marking,
				'harian'		=> $harian,
				'id_sekolah'	=> session('sekolah_id_sekolah')
			]);
			if ($update){
				$uploaddata = Pembayaran::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				foreach($uploaddata as $row){
					if ($row->biaya != 0){
						$jenis 		= $row->jenis;
						if ($jenis == 'Uang Makan'){
							$jenis = 'makan';
						} else if ($jenis == 'dpp'){
							$jenis = 'pembangunan';
						} else {
							$cekekskul	= Ekstrakulikuler::where('nama', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
							if ($cekekskul != 0){
								$jenis 	= 'ekstrakurikuler';
							} else {
								$cekinsidental = Insidental::where('kode', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
								if (isset($cekinsidental->jenis)){
									$termasuk = $cekinsidental->jenis;
									if ($termasuk == 'bukupaket' OR $termasuk == 'bukutulis'){ $jenis = 'buku'; }
									else { $jenis = $termasuk; }
								} else {
									$jenis = 'lainlain';
								}
							}
						}
						HPTKeuangan::create([
							'tanggal'		=> $tgliki,
							'bulan'			=> $mthiki,
							'tahun'			=> $thniki,
							'deskripsi'		=> $row->jenis.' an. '.$row->nama.' Kelas '.$row->kelas.' Bulan '.$row->bulan.' Tahun '.$row->tahun,
							'jenis'			=> $jenis,
							'pemasukan'		=> $row->biaya,
							'bendahara'		=> null,
							'tglkwitansi'	=> null,
							'tandatangan'	=> null,
							'id_sekolah'	=> session('sekolah_id_sekolah'),
							'created_by'	=> Session('nip')
						]);
					}
				}
				$setok = $setok.'<font color=yellow>Verifikasi Atas Nama  '.$nama.' Bulan '.$bulane.' '.$tahune.' Sukses</font> <br />';
			} else {
				$setok = $setok.'<font color=red>Verifikasi Atas Nama  '.$nama.' Bulan '.$bulane.' '.$tahune.' Gagal. Silahkan Verifikasi Manual Saja</font> <br />'; 
			}
		}
		
		echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Sukses!</h4>
				'.$setok.'
			</div>';
	}
	public function exRekaptunggakankelas(Request $request) {
		$kelas		= $request->val01;
		$tapel		= $request->val02;
		$blnmulai	= $request->val03;
		$blnakhir	= $request->val04;
		
		$ahrf 		= explode("-", $tapel);
		$tapel1 	= $ahrf[0];
		$tapel2 	= $ahrf[1];
		$arrbulan 	= array();
		$kodethn1 	= substr($tapel1, -2);
		$kodethn2 	= substr($tapel2, -2);
		$arrbulan[] = array(
			'urutan' => 1,
			'bulan'  => 'Juli',
			'nobulan'=> 7,
			'tahun'	 => $tapel1,
		);
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 2,
				'bulan'  => 'Agustus',
				'nobulan'=> 8,
				'tahun'	 => $tapel1,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 3,
				'bulan'  => 'September',
				'nobulan'=> 9,
				'tahun'	 => $tapel1,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 4,
				'bulan'  => 'Oktober',
				'nobulan'=> 10,
				'tahun'	 => $tapel1,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 5,
				'bulan'  => 'November',
				'nobulan'=> 11,
				'tahun'	 => $tapel1,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 6,
				'bulan'  => 'Desember',
				'nobulan'=> 12,
				'tahun'	 => $tapel1,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 7,
				'bulan'  => 'Januari',
				'nobulan'=> 1,
				'tahun'	 => $tapel2,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 8,
				'bulan'  => 'Februari',
				'nobulan'=> 2,
				'tahun'	 => $tapel2,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 9,
				'bulan'  => 'Maret',
				'nobulan'=> 3,
				'tahun'	 => $tapel2,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 10,
				'bulan'  => 'April',
				'nobulan'=> 4,
				'tahun'	 => $tapel2,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 11,
				'bulan'  => 'Mei',
				'nobulan'=> 5,
				'tahun'	 => $tapel2,
			);
			$blnakhir = $blnakhir - 1;
		}
		if ($blnakhir != 0){
			$arrbulan[] = array(
				'urutan' => 12,
				'bulan'  => 'Juni',
				'nobulan'=> 6,
				'tahun'	 => $tapel2,
			);
			$blnakhir = $blnakhir - 1;
		}
		$jeninsbutul	= '';
		$totinsbutul	= 0;
		$jeninsbupak	= '';
		$totinsbupak	= 0;
		$jeninskeg		= '';
		$totinskeg		= 0;
		$jeninslain1	= '';
		$namainslain1	= '';
		$totinslain1	= 0;
		$jeninslain2	= '';
		$namainslain2	= '';
		$totinslain2	= 0;
		$jeninslain3	= '';
		$namainslain3	= '';
		$totinslain3	= 0;
		$jeninslain4	= '';
		$namainslain4	= '';
		$totinslain4	= 0;
		$jeninslain5	= '';
		$namainslain5	= '';
		$totinslain5	= 0;
		$valcari		= $kelas.'%';
		$generatetable	= '';
		$sql 			= Insidental::where('aktifasi', 'aktif')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$kodeinst 	= $hasil->kode;
				$jeninst 	= $hasil->jenis;
				$namains 	= $hasil->deskripsi;
				$biayains 	= $hasil->biaya;
				$qcek 		= Pembayaran::where('jenis', $kodeinst)->where('bulan', 'Juli')->where('tahun', $tapel1)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				if (!empty($qcek)){
					foreach($qcek as $rcek){
						$ceknoinduk 	= $rcek->noinduk;
						$cocok			= Datainduk::where('noinduk', $ceknoinduk)->where('kelas', 'LIKE', $kelas.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->count();
						if ($cocok != 0){
							if ($jeninst == 'kegiatan'){
								if ($jeninskeg == ''){ $jeninskeg = $kodeinst; $totinskeg = (int)$biayains; }
							}
							else if ($jeninst == 'bukutulis'){
								if ($jeninsbutul == ''){ $jeninsbutul = $kodeinst; $totinsbutul = (int)$biayains; }
							}
							else if ($jeninst == 'bukupaket'){
								if ($jeninsbupak == ''){ $jeninsbupak = $kodeinst; $totinsbupak = (int)$biayains; }
							}
							else {
								if ($jeninslain1 == ''){ $jeninslain1 = $kodeinst; $namainslain1 = $namains; $totinslain1 = (int)$biayains; }
								else if ($jeninslain2 == ''){
									if ($jeninslain1 != $kodeinst){
										$jeninslain2 = $kodeinst;
										$namainslain2 = $namains;
										$totinslain2 = (int)$biayains;
									}
								}
								else if ($jeninslain3 == ''){
									if ($jeninslain1 != $kodeinst AND $jeninslain2 != $kodeinst){
										$jeninslain3 = $kodeinst;
										$namainslain3 = $namains;
										$totinslain3 = (int)$biayains;
									}
								}
								else if ($jeninslain4 == ''){
									if ($jeninslain1 != $kodeinst AND $jeninslain2 != $kodeinst AND $jeninslain3 != $kodeinst){
										$jeninslain4 = $kodeinst;
										$namainslain4 = $namains;
										$totinslain4 = (int)$biayains;
									}
								}
								else{
									if ($jeninslain1 != $kodeinst AND $jeninslain2 != $kodeinst AND $jeninslain3 != $kodeinst AND $jeninslain4 != $kodeinst){
										$jeninslain5 = $kodeinst;
										$namainslain5 = $namains;
										$totinslain5 = (int)$biayains;
									}
								}
							}
						}
					}
				}
			}
			$generatetable = '
			<table id="printiki" width="800" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td width="50">No</td>
					<td width="198">Nama</td>
					<td width="50">No.Induk</td>
					<td width="50">Kelas</td>
					<td width="90">NomSPP</td>
					<td width="90">Juni</td>
					<td width="90">BulNung</td>
					<td width="90">Totbul</td>
					<td width="90">TotSPP</td>
					<td width="90">BUPENA</td>
					<td width="90">BUPAK</td>
					<td width="90">DAKEG</td>
					<td width="90">BUTUL</td>';
					if ($jeninslain1 != ''){ $generatetable = $generatetable.'<td width="90">'.$namainslain1.'</td>'; }
					if ($jeninslain2 != ''){ $generatetable = $generatetable.'<td width="90">'.$namainslain2.'</td>'; }
					if ($jeninslain3 != ''){ $generatetable = $generatetable.'<td width="90">'.$namainslain3.'</td>'; }
					if ($jeninslain4 != ''){ $generatetable = $generatetable.'<td width="90">'.$namainslain4.'</td>'; }
					if ($jeninslain5 != ''){ $generatetable = $generatetable.'<td width="90">'.$namainslain5.'</td>'; }
			$generatetable = $generatetable.'
					<td width="90">NamaEkskul</td>
					<td width="90">TagihanEkskul</td>
					<td width="90">TOTAL</td>
				</tr>';
			$urut		= 1;
			$smt 		= Datainduk::where('klspos', $kelas.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('noinduk', 'ASC')->get();
			if (!empty($smt)){
				foreach ($smt as $jinduk) {
					$noinduk 		= $jinduk->noinduk;
					$nama 			= $jinduk->nama;
					$kelas 			= $jinduk->klspos;
					$rsetting 		= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					$setspp			= (int)$rsetting->spp;
					$seteksul1		= $rsetting->eksul1;
					$seteksul2		= $rsetting->eksul2;
					$seteksul3		= $rsetting->eksul3;
					$seteksul4		= $rsetting->eksul4;
					$seteksul5		= $rsetting->eksul5;
					$jmlhbln		= 0;
					$tagspp			= 0;
					$nungspp1		= '';
					$nungspp2		= '';
					$nunglaina1		= '';
					$nunglaina2		= '';
					$totlaina		= 0;
					$totlainb		= 0;
					$totlainc		= 0;
					$totlaind		= 0;
					$totlaine		= 0;
					$totekskul		= 0;
					$namaekskul		= '';
					$settotinsbupak = $totinsbupak;
					$settotinsbutul	= $totinsbutul;
					$settotinskeg	= $totinskeg;
					$tulis			= '';
					foreach ($arrbulan as $jbulan) {
						$caribln 	= $jbulan['bulan'];
						$carithn 	= $jbulan['tahun'];
						if ($setspp != 0){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'spp')
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrspp = $cekbayar->biaya;
							} else { $byrspp = 0; }							
							if ($byrspp == 0){
								$tulis	= 'OK';
								if ($nungspp1 == ''){ $nungspp1 = $caribln.'-'.$carithn; }
								else { $nungspp2 = $caribln.'-'.$carithn; }
								$jmlhbln = $jmlhbln + 1;
								$tagspp = $tagspp + ($setspp - $byrspp);
							}
						}
						if ($settotinsbupak != 0){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninsbupak)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrbupak = $cekbayar->biaya;
							} else { $byrbupak = 0; }
							
							$settotinsbupak = $settotinsbupak - $byrbupak;
						}
						if ($settotinsbutul != 0){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninsbutul)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrbutul = $cekbayar->biaya;
							} else { $byrbutul = 0; }
							
							$settotinsbutul = $settotinsbutul - $byrbutul;
						}
						if ($settotinskeg != 0){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninskeg)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrkeg = $cekbayar->biaya;
							} else { $byrkeg = 0; }
							$settotinskeg = $settotinskeg - $byrkeg;
						}
						if ($jeninslain1 != ''){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninslain1)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrlain1 = $cekbayar->biaya;
							} else { $byrlain1 = 0; }
							
							$totlaina = $totlaina - $byrlain1;
						}
						if ($jeninslain2 != ''){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninslain2)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrlain2 = $cekbayar->biaya;
							} else { $byrlain2 = 0; }
							$totlainb = $totlainb - $byrlain2;
						}
						if ($jeninslain3 != ''){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninslain3)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrlain3 = $cekbayar->biaya;
							} else { $byrlain3 = 0; }
							
							$totlainc = $totlainc - $byrlain3;
						}
						if ($jeninslain4 != ''){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninslain4)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrlain4 = $cekbayar->biaya;
							} else { $byrlain4 = 0; }
							
							$totlaind = $totlaind - $byrlain4;
						}
						if ($jeninslain5 != ''){
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $jeninslain5)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byrlain5 = $cekbayar->biaya;
							} else { $byrlain5 = 0; }
							
							$totlaine = $totlaine - $byrlain5;
						}
						if ($seteksul1 != '' and $seteksul1 != 'Pramuka'){
							$qgetekskul	= Ekstrakulikuler::where('nama', 'LIKE', $seteksul1)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if(isset($qgetekskul->biaya)){
								$setbiayaek	= (int)$qgetekskul->biaya;
							} else { $setbiayaek = 0; }
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $seteksul1)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byreks1 = $cekbayar->biaya;
							} else { $byreks1 = 0; }							
							if ($byreks1 < $setbiayaek){
								$tulis	= 'OK';
								if ($namaekskul == ''){ $namaekskul = $seteksul1.'('.$caribln.'-'.$carithn.')'; }
								else { $namaekskul = $namaekskul.','.$seteksul1.'('.$caribln.'-'.$carithn.')'; }
								$tageks = $setbiayaek - $byreks1;
								$totekskul = $totekskul + $tageks;
							}
						}
						if ($seteksul2 != '' and $seteksul2 != 'Pramuka'){
							$qgetekskul	= Ekstrakulikuler::where('nama', 'LIKE', $seteksul2)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if(isset($qgetekskul->biaya)){
								$setbiayaek	= (int)$qgetekskul->biaya;
							} else { $setbiayaek = 0; }
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $seteksul2)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byreks2 = $cekbayar->biaya;
							} else { $byreks2 = 0; }
							if ($byreks2 < $setbiayaek){
								$tulis	= 'OK';
								if ($namaekskul == ''){ $namaekskul = $seteksul2.'('.$caribln.'-'.$carithn.')'; }
								else { $namaekskul = $namaekskul.','.$seteksul2.'('.$caribln.'-'.$carithn.')'; }
								$tageks = $setbiayaek - $byreks2;
								$totekskul = $totekskul + $tageks;
							}
						}
						if ($seteksul3 != '' and $seteksul3 != 'Pramuka'){
							$qgetekskul	= Ekstrakulikuler::where('nama', 'LIKE', $seteksul3)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if(isset($qgetekskul->biaya)){
								$setbiayaek	= (int)$qgetekskul->biaya;
							} else { $setbiayaek = 0; }
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $seteksul3)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byreks3 = $cekbayar->biaya;
							} else { $byreks3 = 0; }
							if ($byreks3 < $setbiayaek){
								$tulis	= 'OK';
								if ($namaekskul == ''){ $namaekskul = $seteksul3.'('.$caribln.'-'.$carithn.')'; }
								else { $namaekskul = $namaekskul.','.$seteksul3.'('.$caribln.'-'.$carithn.')'; }
								$tageks = $setbiayaek - $byreks3;
								$totekskul = $totekskul + $tageks;
							}
						}
						if ($seteksul4 != '' and $seteksul4 != 'Pramuka'){
							$qgetekskul	= Ekstrakulikuler::where('nama', 'LIKE', $seteksul4)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if(isset($qgetekskul->biaya)){
								$setbiayaek	= (int)$qgetekskul->biaya;
							} else { $setbiayaek = 0; }
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $seteksul4)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byreks4 = $cekbayar->biaya;
							} else { $byreks4 = 0; }
							if ($byreks4 < $setbiayaek){
								$tulis	= 'OK';
								if ($namaekskul == ''){ $namaekskul = $seteksul4.'('.$caribln.'-'.$carithn.')'; }
								else { $namaekskul = $namaekskul.','.$seteksul4.'('.$caribln.'-'.$carithn.')'; }
								$tageks = $setbiayaek - $byreks4;
								$totekskul = $totekskul + $tageks;
							}
						}
						if ($seteksul5 != '' and $seteksul5 != 'Pramuka'){
							$qgetekskul	= Ekstrakulikuler::where('nama', 'LIKE', $seteksul5)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if(isset($qgetekskul->biaya)){
								$setbiayaek	= (int)$qgetekskul->biaya;
							} else { $setbiayaek = 0; }
							$cekbayar 	= Pembayaran::where('noinduk', $noinduk)
											->where('jenis', 'LIKE', $seteksul5)
											->where('biaya', '!=', '0')
											->where('bulan', $caribln)
											->where('tahun', $carithn)
											->where('verifikasi', '!=', '')
											->where('id_sekolah',session('sekolah_id_sekolah'))
											->first();
							if (isset($cekbayar->biaya)){
								$byreks5 = $cekbayar->biaya;
							} else { $byreks5 = 0; }
							if ($byreks5 < $setbiayaek){
								$tulis	= 'OK';
								if ($namaekskul == ''){ $namaekskul = $seteksul5.'('.$caribln.'-'.$carithn.')'; }
								else { $namaekskul = $namaekskul.','.$seteksul5.'('.$caribln.'-'.$carithn.')'; }
								$tageks = $setbiayaek - $byreks5;
								$totekskul = $totekskul + $tageks;
							}
						}
						$all = 0;
						if ($totekskul != 0){ $tulis = 'OK'; }
						if ($settotinsbupak != 0){ $tulis = 'OK'; }
						if ($settotinsbutul != 0){ $tulis = 'OK'; }
						if ($settotinskeg != 0){ $tulis = 'OK'; }
						if ($totlaina != 0){ $tulis = 'OK'; }
						if ($totlainb != 0){ $tulis = 'OK'; }
						if ($totlainc != 0){ $tulis = 'OK'; }
						if ($totlaind != 0){ $tulis = 'OK'; }
						if ($totlaine != 0){ $tulis = 'OK'; }
						if ($tulis == 'OK'){
							if ($nungspp2 == ''){ $tulisnunspp = $nungspp1; }
							else { $tulisnunspp = $nungspp1.' s.d '.$nungspp2; }
							$generatetable = $generatetable.'
							<tr>
								<td width="50">'.$urut.'</td>
								<td width="198">'.$nama.'</td>
								<td width="50">'.$noinduk.'</td>
								<td width="50">'.$kelas.'</td>
								<td width="90">'.$setspp.'</td>
								<td width="90">0</td>
								<td width="90">'.$tulisnunspp.'</td>
								<td width="90">'.$jmlhbln.'</td>
								<td width="90">'.$tagspp.'</td>
								<td width="90">0</td>
								<td width="90">'.$settotinsbupak.'</td>
								<td width="90">'.$settotinskeg.'</td>
								<td width="90">'.$settotinsbutul.'</td>';
								if ($jeninslain1 != ''){ $generatetable = $generatetable.'<td width="90">'.$totlaina.'</td>'; }
								if ($jeninslain2 != ''){ $generatetable = $generatetable.'<td width="90">'.$totlainb.'</td>'; }
								if ($jeninslain3 != ''){ $generatetable = $generatetable.'<td width="90">'.$totlainc.'</td>'; }
								if ($jeninslain4 != ''){ $generatetable = $generatetable.'<td width="90">'.$totlaind.'</td>'; }
								if ($jeninslain5 != ''){ $generatetable = $generatetable.'<td width="90">'.$totlaine.'</td>'; }
								$all = $totekskul + $totinsbupak + $totinsbutul + $totinskeg + $totlaina + $totlainb + $totlainc + $totlaind + $totlaine + $tagspp;
							$generatetable = $generatetable.'<td width="90">'.$namaekskul.'</td>
								<td width="90">'.$totekskul.'</td>
								<td width="90">'.$all.'</td>
							</tr>';
							$urut++;
						}
					}
				}
			}
			$generatetable = $generatetable.'</table>';
		}
		echo $generatetable;
	}
	public function jsonLapinsidental(Request $request) {
		$set01   	= $request->val01;
		$set02   	= $request->val02;
		$alldata 	= [];
		$getallsiswa= Datainduk::where('klspos', 'LIKE', $set02.'%')->where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($getallsiswa)){
			foreach ($getallsiswa as $hasil) {
				$noinduk 		= $hasil->noinduk;
				if ($set01 == 'dpp'){
					$getdpp		= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					$dpp 		= $getdpp->dpp;
					$tdpp 		= number_format( $dpp , 0 , '.' , ',' );
					$getjmldpp 	= Pembayaran::select(DB::raw("SUM(biaya) as jumlah"))
									->where('jenis', 'dpp')
									->where('noinduk', $noinduk)
									->where('verifikasi', '!=', '')
									->where('id_sekolah',session('sekolah_id_sekolah'))
									->groupBy('jenis')->first();
					if (isset($getjmldpp->jumlah)){
						$bayar 	= $getjmldpp->jumlah;
					}else { $bayar 	= 0; }
					
					$selisih 	= $dpp - $bayar;
					$tbayar		= number_format( $bayar , 0 , '.' , ',' );
					if ($selisih <= 0){
						$keterangan ='LUNAS';
					}
					else { 
						$tselisih	= number_format( $selisih , 0 , '.' , ',' );
						$keterangan = 'Kekurangan DPP '.$tselisih; 
					}				
					$alldata[] = array(
						'id' 			=> $hasil->id,
						'noinduk'		=> $noinduk,
						'kelas'			=> $hasil->klspos,
						'tagihan'		=> $tdpp,
						'bayar'			=> $tbayar,
						'keterangan'	=> $keterangan,
						'nama'			=> $hasil->nama,	
					);
				} else {
					$rkeuangan = Insidental::where('id', $set01)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($rkeuangan->kode)){
						$kode 			= $rkeuangan->kode;
						$biaya 			= $rkeuangan->biaya;
						$tbiaya			= number_format( $biaya , 0 , '.' , ',' );
					} else {
						$kode 			= '';
						$biaya			= '';
						$tbiaya			= 0;
					}
					
					$getjmldpp 	= Pembayaran::select(DB::raw("SUM(biaya) as jumlah"))
									->where('jenis', $kode)
									->where('noinduk', $noinduk)
									->where('verifikasi', '!=', '')
									->where('id_sekolah',session('sekolah_id_sekolah'))
									->groupBy('jenis')->first();
					if (isset($getjmldpp->jumlah)){
						$bayar 	= $getjmldpp->jumlah;
					}else { $bayar 	= 0; }
					
					$selisih 	= $biaya - $bayar;
					$tbayar		= number_format( $bayar , 0 , '.' , ',' );
					if ($selisih <= 0){
						$keterangan ='LUNAS';
					}
					else { 
						$tselisih		= number_format( $selisih , 0 , '.' , ',' );
						$keterangan 	= 'Kekurangan Insidental Kode '.$kode.' Sejumlah '.$tselisih; 
					}				
					$alldata[] = array(
						'id' 			=> $hasil->id,
						'noinduk'		=> $noinduk,
						'kelas'			=> $hasil->klspos,
						'tagihan'		=> $tdpp,
						'bayar'			=> $tbayar,
						'keterangan'	=> $keterangan,
						'nama'			=> $hasil->nama,
					);
				}
			}
		}
		echo json_encode($alldata);
	}
	public function jsonLapbulanan(Request $request) {
		$bulan1   	= (int)$request->val01;
		$bulan2   	= (int)$request->val02;
		$tahun   	= $request->val03;
		$arraysurat	= [];
		$i 			= 1;
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$finish 	= $bulan2 +1;
		while ($bulan1 != $finish){
			$bulan 	= $bulanlist[$bulan1];
			$getallsiswa= Datainduk::where('nokelulusan', '')->orderBy('noinduk', 'ASC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			if (!empty($getallsiswa)){
				foreach ($getallsiswa as $hasil) {
					$noinduk 	= $hasil->noinduk;
					$biaya1		= 0;
					$biaya2		= 0;
					$biaya3		= 0;
					$biaya4		= 0;
					$biaya5		= 0;
					$getdpp		= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($getdpp->spp)){
						$dpp 		= $getdpp->dpp;
						$spp 		= $getdpp->spp;
						$paguyuban	= $getdpp->paguyuban;
						$eksul1 	= $getdpp->eksul1;
						$eksul2 	= $getdpp->eksul2;
						$eksul3 	= $getdpp->eksul3;
						$eksul4 	= $getdpp->eksul4;
						$eksul5 	= $getdpp->eksul5;
					} else {
						$dpp 		= 0;
						$spp 		= 0;
						$paguyuban	= 0;
						$eksul1 	= '';
						$eksul2 	= '';
						$eksul3 	= '';
						$eksul4 	= '';
						$eksul5 	= '';
					}
					if ($eksul1 != ''){
						$rekskul1 = Ekstrakulikuler::where('nama', 'LIKE', $eksul1)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if(isset($rekskul1->biaya)){
							$biaya1	= $rekskul1->biaya;
						}
					}
					if ($eksul2 != ''){
						$rekskul2 = Ekstrakulikuler::where('nama', 'LIKE', $eksul2)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if(isset($rekskul2->biaya)){
							$biaya2	= $rekskul2->biaya;
						}
					}
					if ($eksul3 != ''){
						$rekskul3 = Ekstrakulikuler::where('nama', 'LIKE', $eksul3)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if(isset($rekskul3->biaya)){
							$biaya3	= $rekskul3->biaya;
						}
					}
					if ($eksul4 != ''){
						$rekskul4 = Ekstrakulikuler::where('nama', 'LIKE', $eksul4)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if(isset($rekskul4->biaya)){
							$biaya4	= $rekskul4->biaya;
						}
					}
					if ($eksul5 != ''){
						$rekskul5 = Ekstrakulikuler::where('nama', 'LIKE', $eksul5)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if(isset($rekskul5->biaya)){
							$biaya5	= $rekskul5->biaya;
						}
					}
					$bayarspp		= 0;
					$bayarpaguyuban = 0;
					$bayareks1		= 0;
					$bayareks2		= 0;
					$bayareks3		= 0;
					$bayareks4		= 0;
					$bayareks5		= 0;
					$result 		= Pembayaran::select(DB::raw('SUM(biaya) as biaya'), 'jenis')
										->where('noinduk', $noinduk)
										->where('verifikasi', '!=', '')
										->where('bulan', $bulan)
										->where('tahun', $tahun)
										->where('id_sekolah',session('sekolah_id_sekolah'))
										->groupBy('jenis')->orderBy('jenis', 'DESC')->get();
					foreach($result as $row) {
						$jmlhbyr 	= $row->biaya;
						$jenis 		= $row->jenis;
						if ($jenis == 'spp'){
							$bayarspp = $jmlhbyr;
						}
						if ($jenis == 'Uang Makan'){
							$bayarpaguyuban = $jmlhbyr;
						}
						if ($jenis == $eksul1){
							$bayareks1 = $jmlhbyr;
						}
						if ($jenis == $eksul2){
							$bayareks2 = $jmlhbyr;
						}
						if ($jenis == $eksul3){
							$bayareks3 = $jmlhbyr;
						}
						if ($jenis == $eksul4){
							$bayareks4 = $jmlhbyr;
						}
						if ($jenis == $eksul5){
							$bayareks5 = $jmlhbyr;
						};
					}
					$total = (($spp - $bayarspp)+($paguyuban - $bayarpaguyuban)+($biaya1 - $bayareks1)+($biaya2 - $bayareks2)+($biaya3 - $bayareks3)+($biaya4 - $bayareks4)+($biaya5 - $bayareks5));
					if ($total <= 0){
						$keterangan = 'LUNAS';
					}
					else {
						$tselisih	= number_format( $total , 0 , '.' , ',' );
						$keterangan = 'Kekurangan Pembayaran '.$tselisih;
					}
					$periode = $bulan.'-'.$tahun;
					$arraysurat[] = array(
						'id' 			=> $i,
						'noinduk'		=> $noinduk,
						'nama'			=> $hasil->nama,
						'kelas'			=> $hasil->klspos,
						'periode'		=> $periode,
						'tspp'			=> $spp,
						'bspp'			=> $bayarspp,
						'tpaguyuban'	=> $paguyuban,
						'bpaguyuban'	=> $bayarpaguyuban,
						'teks1'			=> $biaya1,
						'teks2'			=> $biaya2,
						'teks3'			=> $biaya3,
						'teks4'			=> $biaya4,
						'teks5'			=> $biaya5,
						'beks1'			=> $bayareks1,
						'beks2'			=> $bayareks2,
						'beks3'			=> $bayareks3,
						'beks4'			=> $bayareks4,
						'beks5'			=> $bayareks5,
						'keterangan'	=> $keterangan,
					);
					$i++;
				}
			}
			$bulan1++;
		}
		echo json_encode($arraysurat);
	}
	public function jsonLaplengkap(Request $request) {
		$bulan1   	= (int)$request->val01;
		$bulan2   	= (int)$request->val02;
		$tahun   	= $request->val03;
		$arraysurat	= [];
		$i 			= 1;
		$toall		= 0;
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$finish 	= $bulan2 +1;
		while ($bulan1 != $finish){
			$bulan 	= $bulanlist[$bulan1];
			$valcari= '%'.$bulan.$tahun.'%';
			$getallsiswa= Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('nokelulusan', '')->orderBy('noinduk', 'ASC')->get();
			if (!empty($getallsiswa)){
				foreach ($getallsiswa as $rbayar) {
					$noinduk 		= $rbayar->noinduk;
					$klspos			= $rbayar->klspos;
					$nama 	        = $rbayar->nama;
					$total 			= 0;
					$spp 			= 0;
					$dpp 			= 0;
					$paguyuban 		= 0;
					$ekskul1 		= 0;
					$ekskul2 		= 0;
					$ekskul3 		= 0;
					$ekskul4 		= 0;
					$ekskul5 		= 0;
					$insid1 		= 0;
					$insid2 		= 0;
					$insid3 		= 0;
					$insid4 		= 0;
					$insid5 		= 0;
					$bln 			= '';
					$thn			= '';
					$result 		= Pembayaran::select(DB::raw('SUM(biaya) as biaya'), 'jenis', 'bulan', 'tahun')
										->where('noinduk', $noinduk)
										->where('verifikasi', '!=', '')
										->where('bulan', $bulan)
										->where('tahun', $tahun)
										->groupBy('jenis')->orderBy('jenis', 'DESC')->get();
					foreach($result as $row) {
						$jmlhbyr 	= $row->biaya;
						$jenis 		= $row->jenis;
						$bln 		= $row->bulan;
						$thn 		= $row->tahun;
						$total      = $total + $jmlhbyr;
						if ($jenis == 'spp'){
							$spp = number_format( $jmlhbyr , 0 , '.' , ',' );
						}
						else if ($jenis == 'Uang Makan'){
							$paguyuban = number_format( $jmlhbyr , 0 , '.' , ',' );
						}
						else if ($jenis == 'dpp'){
							$dpp = number_format( $jmlhbyr , 0 , '.' , ',' );
						}
						else {
							$count 	= Ekstrakulikuler::where('nama', $jenis)->count();
							if ($count != 0){
									if ($ekskul1 == 0) { $ekskul1 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else if ($ekskul2 == 0) { $ekskul2 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else if ($ekskul3 == 0) { $ekskul3 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else if ($ekskul4 == 0) { $ekskul4 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else { $ekskul5 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
							}
							else {
									if ($insid1 == 0) { $insid1 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else if ($insid2 == 0) { $insid2 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else if ($insid3 == 0) { $insid3 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else if ($insid4 == 0) { $insid4 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
									else { $insid5 = number_format( $jmlhbyr , 0 , '.' , ',' ); }
							}
						}
					}
					$periode 	= $bln.'-'.$thn;
					$toall 		= $toall + $total;
					if ($total != 0){
						$tulistotal = number_format( $total , 0 , '.' , ',' );
						$arraysurat[] = array(
							'noinduk'		=> $noinduk,
							'nama'			=> $nama,
							'kelas'			=> $klspos,
							'periode'		=> $periode,
							'tspp'			=> $spp,
							'tpaguyuban'	=> $paguyuban,
							'teks1'			=> $ekskul1,
							'teks2'			=> $ekskul2,
							'teks3'			=> $ekskul3,
							'teks4'			=> $ekskul4,
							'teks5'			=> $ekskul5,
							'beks1'			=> $insid1,
							'beks2'			=> $insid2,
							'beks3'			=> $insid3,
							'beks4'			=> $insid4,
							'beks5'			=> $insid5,
							'keterangan'	=> $tulistotal,
						);
					}
					$i++;
				}
			}
			$bulan1++;
		}
		$tulistotalall 	= number_format( $toall , 0 , '.' , ',' );
		$arraysurat[] 	= array(
			'noinduk'		=> '',
			'nama'			=> 'Total',
			'kelas'			=> '',
			'periode'		=> '',
			'tspp'			=> '',
			'tpaguyuban'	=> '',
			'teks1'			=> '',
			'teks2'			=> '',
			'teks3'			=> '',
			'teks4'			=> '',
			'beks1'			=> '',
			'beks2'			=> '',
			'beks3'			=> '',
			'beks4'			=> '',
			'keterangan'	=> $tulistotalall,
		);
		echo json_encode($arraysurat);
    }
	public function jsonLaplengkapperjenis(Request $request) {
		$bulan1   	= (int)$request->val01;
		$bulan2   	= (int)$request->val02;
		$tahun   	= $request->val03;
		$arraysurat	= [];
		$i 			= 1;
		$bulanlist 	= array(0 => "bulan", 1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$finish 	= $bulan2 +1;
		while ($bulan1 != $finish){
			$bulan 		= $bulanlist[$bulan1];
			$valcari 	= '%'.$bulan.$tahun.'%';
			$periode	= $bulan.' '.$tahun;
			$sql 		= Pembayaran::where('bulan', $bulan)->where('tahun', $tahun)->where('biaya', '!=', '0')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			if (!empty($sql)){
				foreach ($sql as $hasil){
					$jenis = $hasil->jenis;
					$ceknama = Insidental::where('kode', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($ceknama->deskripsi)){
						$jenis = $ceknama->deskripsi;
					}
					$arraysurat[] = array(
						'noinduk'		=> $hasil->noinduk,
						'nama'			=> $hasil->nama,
						'kelas'			=> $hasil->kelas,
						'periode'		=> $periode,
						'nominal'		=> $hasil->biaya,
						'keterangan'	=> $jenis,
						'petugas'		=> $hasil->inputor,
						'tglverifikasi'	=> $hasil->timestamp,
					);
				}
			}			
			$bulan1++;
		}
		echo json_encode($arraysurat);
	}
	public function jsoRekapharian(Request $request) {
		$bulan1   	= (int)$request->val01;
		$bulan2   	= (int)$request->val02;
		$tahun   	= $request->val03;
		$arraysurat	= [];
		$i 			= 1;
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$finish 	= $bulan2 +1;
		while ($bulan1 != $finish){
			$bulan 		= $bulanlist[$bulan1];
			$valcari 	= '%'.$bulan.$tahun.'%';
			$periode	= $bulan.' '.$tahun;
			$sql 		= Pembayaran::where('harian', 'LIKE', $valcari)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('harian')->get();
			if (!empty($sql)){
				foreach ($sql as $hasil){
					$harian 		= $hasil->harian;
					$tanggal 		= $hasil->timestamp;
					$biaya1			= 0;
					$biaya2			= 0;
					$totaltransaksi = 0;
					$totaltransaksi = Pembayaran::where('harian', $harian)->where('biaya', '!=', '0')->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('noinduk')->count();
					
					$rbiaya1 		= Pembayaran::select(DB::raw('SUM(biaya) as biaya'), 'jenis')
										->where('harian', $harian)
										->where('verifikasi', '!=', '')
										->where('id_sekolah',session('sekolah_id_sekolah'))
										->groupBy('harian')->get();
					if(isset($rbiaya1->biaya)){
						$biaya1	= $rbiaya1->biaya;
					}
					
					$rbiaya2 		= Pembayaran::select(DB::raw('SUM(biaya) as biaya'), 'jenis')
										->where('harian', $harian)
										->where('verifikasi', '')
										->where('id_sekolah',session('sekolah_id_sekolah'))
										->groupBy('harian')->get();
					if(isset($rbiaya2->biaya)){
						$biaya2	= $rbiaya2->biaya;
					}
					$arraysurat[] = array(
						'tanggaltrans'		=> $harian,
						'jumlahtrans'		=> $totaltransaksi,
						'verifiedtrans'		=> number_format( $biaya1 , 0 , '.' , ',' ),
						'unverifiedtrans'	=> number_format( $biaya2 , 0 , '.' , ',' ),
					);
				}
			}
			$bulan1++;
		}
		echo json_encode($arraysurat);
	}
	public function jsoRincianharian(Request $request) {
		$harian   	= $request->val01;
		$arraysurat	= [];
		$sql 		= Pembayaran::where('harian', $harian)->where('biaya', '!=', '0')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rbayar){
				$nama			= $rbayar->nama;
				$noinduk		= $rbayar->noinduk;
				$bulan			= $rbayar->bulan;
				$tahun			= $rbayar->tahun;
				$tanggal		= $rbayar->harian;
				$verifikasi		= $rbayar->verifikasi;
				$marking		= $rbayar->marking;
				$biaya			= $rbayar->biaya;
				$jenis			= $rbayar->jenis;
				$klspos			= $rbayar->kelas;
				$rutin			= $bulan.'-'.$tahun;
				$arraysurat[] = array(
					'id' 		=> $rbayar->id,
					'nama'		=> $nama,
					'noinduk'	=> $noinduk,
					'kelas'		=> $klspos,
					'rutin'		=> $rutin,				
					'verifi'	=> $verifikasi,
					'marking'	=> $marking,
					'tanggal'	=> $tanggal,
					'jenis'		=> $jenis,
					'biaya'		=> number_format( $biaya , 0 , '.' , ',' ),
				);
			}
		}
		echo json_encode($arraysurat);
	}
	public function jsonRincianlastortu(Request $request) {
		$noinduk   	= $request->val01;
		$bulan   	= $request->val02;
		$tahun   	= $request->val03;
		$arraysurat	= [];
		$sql 		= Pembayaran::where('noinduk', $noinduk)->where('bulan', $bulan)->where('tahun', $tahun)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rbayar){
				$nama			= $rbayar->nama;
				$noinduk		= $rbayar->noinduk;
				$bulan			= $rbayar->bulan;
				$tahun			= $rbayar->tahun;
				$tanggal		= $rbayar->harian;
				$verifikasi		= $rbayar->verifikasi;
				$marking		= $rbayar->marking;
				$biaya			= $rbayar->biaya;
				$jenis			= $rbayar->jenis;
				$klspos			= $rbayar->kelas;
				$rutin			= $bulan.'-'.$tahun;
				$arraysurat[] = array(
					'id' 		=> $rbayar->id,
					'inputor' 	=> $rbayar->inputor,
					'nama'		=> $nama,
					'noinduk'	=> $noinduk,
					'rutin'		=> $rutin,
					'verifi'	=> $verifikasi,
					'marking'	=> $marking,
					'tanggal'	=> $tanggal,
					'jenis'		=> $jenis,
					'biaya'		=> number_format( $biaya , 0 , '.' , ',' ),
				);
			}
		}
		echo json_encode($arraysurat);
	}
	public function jsonRincianbyrortu(Request $request) {
		$marking   	= $request->val01;
		$arraysurat	= [];
		$sql 		= Pembayaran::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rbayar){
				$nama			= $rbayar->nama;
				$noinduk		= $rbayar->noinduk;
				$bulan			= $rbayar->bulan;
				$tahun			= $rbayar->tahun;
				$tanggal		= $rbayar->harian;
				$verifikasi		= $rbayar->verifikasi;
				$marking		= $rbayar->marking;
				$biaya			= $rbayar->biaya;
				$jenis			= $rbayar->jenis;
				$klspos			= $rbayar->kelas;
				$rutin			= $bulan.'-'.$tahun;
				$arraysurat[] = array(
					'id' 		=> $rbayar->id,
					'inputor' 	=> $rbayar->inputor,
					'nama'		=> $nama,
					'noinduk'	=> $noinduk,
					'rutin'		=> $rutin,
					'verifi'	=> $verifikasi,
					'marking'	=> $marking,
					'tanggal'	=> $tanggal,
					'jenis'		=> $jenis,
					'biaya'		=> number_format( $biaya , 0 , '.' , ',' ),
				);
			}
		}
		echo json_encode($arraysurat);
	}
	public function exManualbyr(Request $request) {
		$noinduk	= $request->val01;
		$dpp		= $request->val02;
		$spp		= $request->val03;
		$paguyuban	= $request->val04;
		$eksul1		= $request->val05;
		$eksul2		= $request->val06;
		$eksul3		= $request->val07;
		$eksul4		= $request->val08;
		$insidental	= $request->val09;
		$tahun		= $request->val10;
		$bulan		= $request->val11;
		$insidental2= $request->val12;
		$insidental3= $request->val13;
		$inputor	= $request->val14;
		$eksul5		= $request->val15;
		if ($noinduk != ''  and $bulan != '' and $tahun != ''){
			$qcarijeneng	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($qcarijeneng->klspos)){
				$klspos			= $qcarijeneng->klspos;
				$nama			= $qcarijeneng->nama;
			} else { $klspos = ''; $nama = ''; }
			$dino 			= date("d");
			$wulan 			= date("m");
			$yers 			= date("Y");
			$marking 		= session('sekolah_id_sekolah').'-'.$noinduk.$dino.$bulan.$tahun;
			$dinoan 		= $dino.$wulan.$yers;
			$statusinput	= '';
			$rdetail		= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rdetail->nama)){
				$neksul1	= $rdetail->eksul1;
				$neksul2	= $rdetail->eksul2;
				$neksul3	= $rdetail->eksul3;
				$neksul4	= $rdetail->eksul4;
				$neksul5	= $rdetail->eksul5;
			} else {
				$neksul1	= '';
				$neksul2	= '';
				$neksul3	= '';
				$neksul4	= '';
				$neksul5	= '';
			}
			if ($spp != ''){
				$cekdahbyr1		= Pembayaran::where('jenis', 'spp')
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $spp)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr1 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar SPP Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				}
				else {
					$spp 		= str_replace(',','',$spp);
					$cekmasuk	= Pembayaran::where('jenis', 'spp')
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama, 
							'noinduk'	=> $noinduk, 
							'kelas'		=> $klspos, 
							'jenis'		=> 'spp', 
							'biaya'		=> $spp, 
							'bulan'		=> $bulan, 
							'tahun'		=> $tahun, 
							'timestamp'	=> 'CURRENT_TIMESTAMP', 
							'verifikasi'=> '', 
							'marking'	=> $marking, 
							'harian'	=> $dinoan, 
							'inputor'	=> Session('nama'), 
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input SPP an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$spp.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran SPP an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$spp.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran SPP Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($paguyuban != ''){
				$cekdahbyr2		= Pembayaran::where('jenis', 'Uang Makan')
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $paguyuban)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr2 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar Uang Makan Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				}
				else {
					$paguyuban 	= str_replace(',','',$paguyuban);
					$cekmasuk	= Pembayaran::where('jenis', 'Uang Makan')
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama, 
							'noinduk'	=> $noinduk, 
							'kelas'		=> $klspos, 
							'jenis'		=> 'Uang Makan', 
							'biaya'		=> $paguyuban, 
							'bulan'		=> $bulan, 
							'tahun'		=> $tahun, 
							'timestamp'	=> 'CURRENT_TIMESTAMP', 
							'verifikasi'=> '', 
							'marking'	=> $marking, 
							'harian'	=> $dinoan, 
							'inputor'	=> Session('nama'), 
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Uang Makan an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$paguyuban.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Uang Makan an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$paguyuban.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Uang Makan Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul1 != ''){
				$cekdahbyr3		= Pembayaran::where('jenis', $neksul1)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $eksul1)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr3 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul1.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				}
				else {
					$eksul1   	= str_replace(',','',$eksul1);
					$cekmasuk	= Pembayaran::where('jenis', $neksul1)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $neksul1,
							'biaya'		=> $eksul1,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Ektrakulikuler '.$neksul1.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul1.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Ektrakulikuler '.$neksul1.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul1.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Ektrakulikuler '.$neksul1.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul2 != ''){
				$cekdahbyr4	= Pembayaran::where('jenis', $neksul2)
								->where('bulan', $bulan)
								->where('tahun', $tahun)
								->where('noinduk', $noinduk)
								->where('biaya', $eksul2)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr4 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul2.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				}
				else {
					$eksul2   	= str_replace(',','',$eksul2);
					$cekmasuk	= Pembayaran::where('jenis', $neksul2)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $neksul2,
							'biaya'		=> $eksul2,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Ektrakulikuler '.$neksul2.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul2.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Ektrakulikuler '.$neksul2.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul2.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Ektrakulikuler '.$neksul2.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul3 != ''){
				$cekdahbyr5		= Pembayaran::where('jenis', $neksul3)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $eksul3)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr5 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul3.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				}
				else {
					$eksul3   	= str_replace(',','',$eksul3);
					$cekmasuk	= Pembayaran::where('jenis', $neksul3)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $neksul3,
							'biaya'		=> $eksul3,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'	=> session('sekolah_id_sekolah'),
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Ektrakulikuler '.$neksul3.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul3.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Ektrakulikuler '.$neksul3.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul3.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Ektrakulikuler '.$neksul3.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul4 != ''){
				$cekdahbyr6		= Pembayaran::where('jenis', $neksul4)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $eksul4)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr6 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul4.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				}
				else {
					$eksul4   	= str_replace(',','',$eksul4);
					$cekmasuk	= Pembayaran::where('jenis', $neksul4)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $neksul4,
							'biaya'		=> $eksul4,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah'),
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Ektrakulikuler '.$neksul4.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul4.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Ektrakulikuler '.$neksul4.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul4.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Ektrakulikuler '.$neksul4.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul5 != ''){
				$cekdahbyr7	= Pembayaran::where('jenis', $neksul5)
								->where('bulan', $bulan)
								->where('tahun', $tahun)
								->where('noinduk', $noinduk)
								->where('biaya', $eksul5)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr7 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul5.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				}
				else {
					$eksul5   	= str_replace(',','',$eksul5);
					$cekmasuk	= Pembayaran::where('jenis', $neksul5)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $neksul5,
							'biaya'		=> $eksul5,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Ektrakulikuler '.$neksul5.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul5.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Ektrakulikuler '.$neksul5.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul5.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Ektrakulikuler '.$neksul5.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($dpp != 0) {
				$dpp 		= str_replace(',','',$dpp);
				$cekmasuk	= Pembayaran::where('jenis', 'dpp')
								->where('bulan', $bulan)
								->where('tahun', $tahun)
								->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekmasuk == 0){
					$bayar	= Pembayaran::create([
						'nama'		=> $nama,
						'noinduk'	=> $noinduk,
						'kelas'		=> $klspos,
						'jenis'		=> 'dpp',
						'biaya'		=> $dpp,
						'bulan'		=> $bulan,
						'tahun'		=> $tahun,
						'timestamp'	=> 'CURRENT_TIMESTAMP',
						'verifikasi'=> '',
						'marking'	=> $marking,
						'harian'	=> $dinoan,
						'inputor'	=> Session('nama'),
						'buktibayar'=> '',
						'id_sekolah'=> session('sekolah_id_sekolah'),
					]);
					if ($bayar){
						$statusinput = $statusinput.'<br /><font color=green>Sukses Input Pembayaran DPP An. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$dpp.'</font>';
					}
					else {
						$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran DPP An. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$dpp.' Silahkan coba beberapa saat lagi</font>';
					}
				}
				else {
					$statusinput = $statusinput.'<br /><font color=red>Pembayaran DPP An. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sudah Masuk</font>';
				}
			}
			if ($insidental != '') {
				$getinsidental	= Insidental::where('id', $insidental)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getinsidental->kode)){
					$kode 		= $getinsidental->kode;
					$jenis 		= $getinsidental->jenis;
					$biaya 		= $getinsidental->biaya;
					$deskripsi	= $getinsidental->deskripsi;
					$cekmasuk	= Pembayaran::where('jenis', $kode)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $kode,
							'biaya'		=> $biaya,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Silahkan coba beberapa saat lagi</font>';
						}
					}
					else {
						$statusinput = $statusinput.'<br /><font color=red>Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Sudah Di bayar</font>';
					}
				}
				
			}
			if ($insidental2 != '') {
				$getinsidental	= Insidental::where('id', $insidental2)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getinsidental->kode)){
					$kode 		= $getinsidental->kode;
					$jenis 		= $getinsidental->jenis;
					$biaya 		= $getinsidental->biaya;
					$deskripsi	= $getinsidental->deskripsi;
					$cekmasuk	= Pembayaran::where('jenis', $kode)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $kode,
							'biaya'		=> $biaya,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Insidental '.$deskripsi.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Silahkan coba beberapa saat lagi</font>';
						}
					}
					else {
						$statusinput = $statusinput.'<br /><font color=red>Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Sudah Di bayar</font>';
					}
				} 
				
			}
			if ($insidental3 != '') {
				$getinsidental	= Insidental::where('id', $insidental3)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getinsidental->kode)){
					$kode 		= $getinsidental->kode;
					$jenis 		= $getinsidental->jenis;
					$biaya 		= $getinsidental->biaya;
					$deskripsi	= $getinsidental->deskripsi;
					$cekmasuk	= Pembayaran::where('jenis', $kode)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $kode,
							'biaya'		=> $biaya,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'timestamp'	=> 'CURRENT_TIMESTAMP',
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'buktibayar'=> '',
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.'</font>';
						}
						else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Insidental '.$deskripsi.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Silahkan coba beberapa saat lagi</font>';
						}
					}
					else {
						$statusinput = $statusinput.'<br /><font color=red>Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Sudah Di bayar</font>';
					}
				} 
				
			}
			echo '<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Input Sukses!</h4>
					Pembayaran Sukses di masukkan, silahkan ke lanjut ke proses cetak kwitansi '.$statusinput.'
				</div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Pastikan Formnya Anda Isi dengan Lengkap Terutama Bulan dan Tahun Bayar
				</div>';
		}
	}
	public function exEditorbyr(Request $request) {
		$idne 		= $request->val01;
		$biaya 		= $request->val02;
		$sopo 		= Session('nama');
		$alasan 	= $request->val04;
		if($alasan == '' or $biaya == ''){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Pastikan Alasan Perubahan Telah Terisi, Bila Biaya tidak ada, di isi angka 0 
				</div>';
		} else {
			$biaya 		= str_replace(',','',$biaya);
			$rlampau	= Pembayaran::where('id', $idne)->first();
			$jenis 		= $rlampau->jenis;
			$biayalama	= $rlampau->biaya;
			$nama 		= $rlampau->nama;
			$noinduk 	= $rlampau->noinduk;
			$verifikasi = $rlampau->verifikasi;
			if ($verifikasi == ''){
				$deskripsi 	= $sopo.' Telah Mengubah Data Pembayaran Jenis '.$jenis.' An. '.$nama. ' No. Induk '.$noinduk.' Dari '.$biayalama.' Ke '.$biaya.' dikarenakan '.$alasan;
				$update		= Pembayaran::where('id', $idne)->update([
					'biaya'		=> $biaya,
					'inputor'	=> $sopo,				
					'id_sekolah'=> session('sekolah_id_sekolah'),				
				]);
				if ($update){
					Logstaff::create([
						'jenis'		=> 'Perubahan Data Pembayaran Siswa',
						'sopo'		=> Session('nip'), 
						'kelakuan'	=> $deskripsi,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses</h4>
							Sukses Update '.$jenis.' dengan Biaya '.$biaya.' 
						</div>'; 	
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Gagal menyimpan 
						</div>';
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error</h4>
						Gagal Mengubah, Data yang telah terverifikasi tidak bisa diubah 
					</div>';
			}
		}
	}
	public function jsonDatabayar() {
		$arraysurat	= [];
		$sql 		= Pembayaran::select(DB::raw('SUM(biaya) as biaya'), 'id', 'bulan', 'tahun', 'timestamp', 'marking', 'nama', 'noinduk', 'verifikasi', 'inputor', 'buktibayar', 'kirim')
						->where('verifikasi', '')
						->where('id_sekolah',session('sekolah_id_sekolah'))
						->groupBy('marking')->get();
		if (!empty($sql)){
			foreach ($sql as $rbayar){
				$nama			= $rbayar->nama;
				$noinduk		= $rbayar->noinduk;
				$bulan			= $rbayar->bulan;
				$tahun			= $rbayar->tahun;
				$tanggal		= $rbayar->harian;
				$verifikasi		= $rbayar->verifikasi;
				$marking		= $rbayar->marking;
				$total			= $rbayar->biaya;
				$jenis			= $rbayar->jenis;
				$klspos			= $rbayar->kelas;
				$rutin			= $bulan.'-'.$tahun;
				$getnomerhp 	= Datainduk::where('id_sekolah', Session('sekolah_id_sekolah'))->where('noinduk', $noinduk)->first();
				if (isset($getnomerhp->hape)){
					$hape 		= $getnomerhp->hape;
				} else { $hape 	= ''; }
				$arraysurat[] = array(
					'no' 		=> $rbayar->id,
					'inputor' 	=> $rbayar->inputor,
					'nama'		=> $nama,
					'noinduk'	=> $noinduk,
					'rutin'		=> $rutin,
					'verifi'	=> $verifikasi,
					'marking'	=> $marking,
					'tanggal'	=> $tanggal,
					'hape'		=> $hape,
					'foto'		=> $rbayar->buktibayar,
					'kirim'		=> $rbayar->kirim,
					'total'		=> number_format( $total , 0 , '.' , ',' ),
				);
			}
		}
		echo json_encode($arraysurat);
	}
	public function exvVerifiedpembayaran(Request $request) {
		$idne		= $request->val01;
		$noinduk	= $request->val02;
		$jeneng		= Session('nama');
		$tanggal	= $request->val04;
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		if ($tanggal != ''){
			$arrayttl 	= explode("-", $tanggal);
			$tgliki 	= $arrayttl[0];
			$mthiki 	= $arrayttl[1];
			$thniki 	= $arrayttl[2];
			$blniki 	= (int)$mthiki;
			$bulan 		= $bulanlist[$blniki];
		} else {
			$tgliki 	= date('d');
			$mthiki 	= date('m');
			$blniki 	= (int)$mthiki;
			$thniki 	= date('Y');
			$bulan 		= $bulanlist[$mthiki];
		}
		$harian 	= $tgliki.$bulan.$thniki;
		$verified 	= $jeneng.$tgliki.$mthiki.$thniki;
		$marking 	= $noinduk.$harian;
		$update 	= Pembayaran::where('marking', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
			'verifikasi'	=> $verified,
			'harian'		=> $harian,
			'marking'		=> $marking,
			'id_sekolah'	=> session('sekolah_id_sekolah'),
		]);
		if ($update){
			$uploaddata = Pembayaran::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			foreach($uploaddata as $row){
				if ($row->biaya != 0){
					$jenis 		= $row->jenis;
					if ($jenis == 'Uang Makan'){
						$jenis = 'makan';
					} else if ($jenis == 'dpp'){
						$jenis = 'pembangunan';
					} else {
						$cekekskul	= Ekstrakulikuler::where('nama', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
						if ($cekekskul != 0){
							$jenis 	= 'ekstrakurikuler';
						} else {
							$cekinsidental = Insidental::where('kode', $jenis)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
							if (isset($cekinsidental->jenis)){
								$termasuk = $cekinsidental->jenis;
								if ($termasuk == 'bukupaket' OR $termasuk == 'bukutulis'){ $jenis = 'buku'; }
								else { $jenis = $termasuk; }
							} else {
								$jenis = 'lainlain';
							}
						}
					}
					HPTKeuangan::create([
						'tanggal'		=> $tgliki,
						'bulan'			=> $mthiki,
						'tahun'			=> $thniki,
						'deskripsi'		=> $row->jenis.' an. '.$row->nama.' Kelas '.$row->kelas.' Bulan '.$row->bulan.' Tahun '.$row->tahun,
						'jenis'			=> $jenis,
						'pemasukan'		=> $row->biaya,
						'bendahara'		=> null,
						'tglkwitansi'	=> null,
						'tandatangan'	=> null,
						'id_sekolah'	=> session('sekolah_id_sekolah'),
						'created_by'	=> Session('nip')
					]);
				}
			}
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					Proses Verifikasi Selesai. Data Tidak Hilang Hanya Saja Tidak Ditampilkan Kembali
				</div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Sistem Error, Silahkan coba beberapa saat lagi
				</div>'; 
		}
	}
	public function jsonTabungan() {
		$arrrekap 	= [];
		if (Session('previlage') == 'ortu'){
			$kodeortu	= Session('id');
			$sql 		= Datainduk::where('kodeortu', $kodeortu)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			if (!empty($sql)){
				foreach ($sql as $rjeneng) {
					$noinduk 	= $rjeneng->noinduk;
					$kelas 		= $rjeneng->klspos;
					$jmlhkredit = 0;
					$jmlhdebet 	= 0;
					$rdata 		= Tabungan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('marking', 'DESC')->get();
					if (!empty($rdata)){
						foreach ($rdata as $rbayar) {			
							$nama			= $rbayar->nama;
							$noinduk		= $rbayar->noinduk;
							$kredit			= (int)$rbayar->kredit;
							$debet			= (int)$rbayar->debet;
							$jmlhkredit 	=  $jmlhkredit + $kredit;
							$jmlhdebet 		=  $jmlhdebet + $debet;							
							$arrrekap[] = array(
								'id' 		=> $rbayar->id,
								'nama'		=> $nama,
								'noinduk'	=> $noinduk,
								'kelas' 	=> $kelas,			
								'debet'		=> $debet,
								'kredit'	=> $kredit,
								'keterangan'=> $rbayar->keterangan,
								'verified' 	=> $rbayar->verified,
								'marking' 	=> $rbayar->marking,
								'inputor' 	=> $rbayar->inputor,
							);
						}
					}					
				}
			}
		} else {
			$jmlhkredit = 0;
			$jmlhdebet 	= 0;
			$rdata 		= Tabungan::where('verified', '')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('marking', 'DESC')->get();
			if (!empty($rdata)){
				foreach ($rdata as $rbayar) {			
					$nama			= $rbayar->nama;
					$noinduk		= $rbayar->noinduk;
					$kredit			= (int)$rbayar->kredit;
					$debet			= (int)$rbayar->debet;
					$jmlhkredit 	=  $jmlhkredit + $kredit;
					$jmlhdebet 		=  $jmlhdebet + $debet;
					$getkelas		= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($getkelas->klspos)){
						$kelas 		= $getkelas->klspos;
					} else { $kelas = ''; }
					$arrrekap[] = array(
						'id' 		=> $rbayar->id,
						'nama'		=> $nama,
						'noinduk'	=> $noinduk,
						'kelas' 	=> $kelas,			
						'debet'		=> $debet,
						'kredit'	=> $kredit,
						'keterangan'=> $rbayar->keterangan,
						'verified' 	=> $rbayar->verified,
						'marking' 	=> $rbayar->marking,
						'inputor' 	=> $rbayar->inputor,
					);
				}
			}			
		}
		echo json_encode($arrrekap);
	}
	public function jsonLaptabunganharian(Request $request) {
		$tanggal   	= $request->val01;
		$arraysurat	= [];
		$jmlhkredit = 0;
		$jmlhdebet 	= 0;
		$sql 		= Tabungan::where('marking', $tanggal)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('marking', 'DESC')->get();
		if (!empty($sql)){
			foreach ($sql as $rbayar){
				$nama			= $rbayar->nama;
				$noinduk		= $rbayar->noinduk;
				$kredit			= (int)$rbayar->kredit;
				$debet			= (int)$rbayar->debet;
				$jmlhkredit 	=  $jmlhkredit + $kredit;
				$jmlhdebet 		=  $jmlhdebet + $debet;
				$getkelas		= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getkelas->klspos)){
					$kelas 		= $getkelas->klspos;
				} else { $kelas = ''; }
				$arraysurat[] = array(
					'id' 		=> $rbayar->id,
					'nama'		=> $nama,
					'noinduk'	=> $noinduk,
					'kelas' 	=> $kelas,			
					'debet'		=> $debet,
					'kredit'	=> $kredit,
					'keterangan'=> $rbayar->keterangan,
					'verified' 	=> $rbayar->verified,
					'marking' 	=> $rbayar->marking,
					'inputor' 	=> $rbayar->inputor,
				);
			}
		}
		$arraysurat[] = array(
			'id' 			=> '',	
			'nama' 			=> 'Total',	
			'noinduk' 		=> '',
			'kelas' 		=> '',			
			'debet'			=> $jmlhdebet,
			'kredit'		=> $jmlhkredit,
			'keterangan'	=> '',
			'verified'		=> '',
			'marking'		=> '',
			'inputor'		=> '',
		);
		echo json_encode($arraysurat);
	}
	public function jsonCaritabungan(Request $request) {
		$noinduk   	= $request->val01;
		$arraysurat	= [];
		$jmlhkredit = 0;
		$jmlhdebet 	= 0;
		$getkelas	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($getkelas->klspos)){
			$kelas 	= $getkelas->klspos;
		} else { $kelas = ''; }
		$sql 		= Tabungan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('marking', 'DESC')->get();
		if (!empty($sql)){
			foreach ($sql as $rbayar){
				$nama			= $rbayar->nama;
				$noinduk		= $rbayar->noinduk;
				$kredit			= (int)$rbayar->kredit;
				$debet			= (int)$rbayar->debet;
				$jmlhkredit 	=  $jmlhkredit + $kredit;
				$jmlhdebet 		=  $jmlhdebet + $debet;
				$arraysurat[] = array(
					'id' 		=> $rbayar->id,
					'nama'		=> $nama,
					'noinduk'	=> $noinduk,
					'kelas' 	=> $kelas,			
					'debet'		=> $debet,
					'kredit'	=> $kredit,
					'keterangan'=> $rbayar->keterangan,
					'verified' 	=> $rbayar->verified,
					'marking' 	=> $rbayar->marking,
					'inputor' 	=> $rbayar->inputor,
				);
			}
		}
		$sisa = $jmlhdebet - $jmlhkredit;
		$arraysurat[] = array(
			'id' 			=> '',
			'nama' 			=> 'Total',
			'noinduk' 		=> '',
			'kelas' 		=> '',
			'debet'			=> $jmlhdebet,
			'kredit'		=> $jmlhkredit,
			'keterangan'	=> $sisa,
			'verified'		=> '',
			'marking'		=> '',
			'inputor'		=> '',
		);
		echo json_encode($arraysurat);
	}
	public function exTabung(Request $request) {
		$noinduk	= $request->val01;
		$jumlah		= $request->val02;
		$perlu 		= $request->val03;
		$jenis 		= $request->val04;
		$staf 		= $request->val05;
		$inputor	= Session('nama');
		$dino 		= date("d");
		$bulan 		= date("m");
		$tahun 		= date("Y");
		$marking 	= $dino.'-'.$bulan.'-'.$tahun;
		$getkelas	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($getkelas->klspos)){
			$nama 		= $getkelas->nama;
			$kelas 		= $getkelas->klspos;
		} else { $kelas = ''; $nama = ''; }
		$jumlah 	= str_replace(',','',$jumlah);
		if ($jenis == 'tarik'){
			$getdebet 	= Tabungan::select(DB::raw("SUM(debet) as jumlah"))
							->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))
							->groupBy('noinduk')->first();
			if (isset($getdebet->jumlah)){
				$tdebet = $getdebet->jumlah;
			} else { $tdebet = 0; }
			$getkredit 	= Tabungan::select(DB::raw("SUM(kredit) as jumlah"))
							->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))
							->groupBy('noinduk')->first();
			if (isset($getkredit->jumlah)){
				$tkredit = $getkredit->jumlah;
			} else { $tkredit = 0; }
			
			$totalambil = $jumlah + $tkredit;
			$totalsisa	= $tdebet - $totalambil;
			if ($totalsisa < 0){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Jumlah Yang Diambil Melebihi Tabungan 
					</div>'; 
			} else {
				$input = Tabungan::create([
					'noinduk'		=> $noinduk, 
					'nama'			=> $nama,
					'debet'			=> 0,
					'kredit'		=> $jumlah,
					'keterangan'	=> '',
					'verified'		=> '',
					'marking'		=> $marking,
					'inputor'		=> $inputor,
					'id_sekolah'	=> session('sekolah_id_sekolah')
				]);
				if ($input){
					echo '<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses!</h4>
							Tabungan Ananda '.$nama.' Diambil sejumlah Rp. '.$jumlah.',- <br />Bapak/Ibu Silahkan Mengambil Uangnya ke loket Sekolah .. Terima kasih....<br />						
						</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error!</h4>
							Sistem Error, Silahkan Coba Beberapa Saat Lagi.!
						</div>';
				}
			}
			
		} else if ($jenis == 'tabung'){
			$input = Tabungan::create([
				'noinduk'		=> $noinduk, 
				'nama'			=> $nama,
				'debet'			=> $jumlah,
				'kredit'		=> 0,
				'keterangan'	=> '',
				'verified'		=> '',
				'marking'		=> $marking,
				'inputor'		=> $inputor,
				'id_sekolah'	=> session('sekolah_id_sekolah')
			]);
			if ($input){
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Tabungan Ananda '.$nama.' Ditambahkan sejumlah Rp. '.$jumlah.',- <br />Bapak/Ibu Silahkan Menyetorkan Uangnya ke loket Sekolah agar pihak sekolah dapat memverifikasi pembayaran Bapak/Ibu. Terima kasih....
					</div>';
			} else { 
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Sistem Error, Silahkan Coba Beberapa Saat Lagi.!
					</div>';
			}
		} else if ($jenis == 'batal'){
			$idne 	= $noinduk;
			$ceksek = Tabungan::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($ceksek->id)){
				$verified 	= $ceksek->verified;
				$marking 	= $ceksek->marking;
				$debet 		= $ceksek->debet;
				$kredit		= $ceksek->kredit;
				$noinduk	= $ceksek->noinduk;
				$nama		= $ceksek->nama;
			} else {
				$verified 	= '';
				$marking 	= '';
				$debet 		= '';
				$kredit		= '';
				$noinduk	= '';
				$nama		= '';
			}
			if ($verified != ''){
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf Yang Bisa Dibatalkan Hanya Yang Belum Diverifikasi TU Sekolah Saja']);
				return back();
			} else {
				$bataltabung = Tabungan::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
				if ($bataltabung){
					if (Session('previlage') != 'ortu'){
						if ($debet == '' OR $debet == 0){
							$deskripsi = 'Menghapus data Penarikan an. '.$nama.' No. Induk '.$noinduk.' Tanggal Transaksi '.$marking.' Sejumlah '.$kredit;
						} else {
							$deskripsi = 'Menghapus data Tabungan an. '.$nama.' No. Induk '.$noinduk.' Tanggal Transaksi '.$marking.' Sejumlah '.$kredit;
						}
						Logstaff::create([
							'jenis'		=> 'Perubahan Data Tabungan Siswa',
							'sopo'		=> Session('nip'), 
							'kelakuan'	=> $deskripsi,
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
					}
					return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Tabungan Dibatalkan']);
					return back();
				} else { 
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi.']);
					return back();
				}
			}
		} else {
			$verifikasi = 'verified by '.$staf.' date '.$marking;
			$verified = Tabungan::where('id', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
				'verified'		=> $verifikasi,
			]);
			if ($verified){
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Tabungan ID '.$noinduk.' '.$verifikasi.'
					</div>';
			} else { 
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Sistem Error, Silahkan Coba Beberapa Saat Lagi.
					</div>'; 
			}
		}
	}
	public function exUploadkeuanganppdb(Request $request) {
		if ($request->hasFile('FileExcel')) {
			$path 			= $_FILES['FileExcel']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				$kodependaf		= $val['A'];
				$hasile			= $val['B'];
				$nosurat		= $val['C'];
				$seragam		= $val['D'];
				$dpp			= $val['E'];
				$spp			= $val['F'];
				$tenggatspp		= $val['G'];					
				$tenggatdu  	= $val['H'];
				if ($kodependaf != ''){
					$update	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'hasil' 	=> $hasile,
						'nosurat'	=> $nosurat,
						'dana1'		=> $seragam,
						'dana2'		=> $dpp,
						'dana3'		=> $spp,
						'deadline'	=> $tenggatspp,
						'akhirumum'	=> $tenggatdu,
						'id_sekolah'=> session('sekolah_id_sekolah')
					]);
					if ($update){ $sukses++; }
					else { $error =  $error.', Kode Pendaftaran '.$kodependaf.' (Gagal di Simpan)<br />'; }
				}
			}
			Session::flash('status', 'Success');
			Session::flash('message', 'Upload Data berhasil sejumlah <strong>'.$sukses.'</strong><br />Log Error :<br />'.$error); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} else {
			Session::flash('status', 'Error');
			Session::flash('message', 'Harap masukkan file terlebih dahulu'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
		}
	}
	public function exUploaddatainduk(Request $request) {
		if ($request->hasFile('datainduk')) {
			$path 			= $_FILES['datainduk']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				$kodependaf		= $val['A'];
				if ($val['B'] == ''){ $noinduk = ''; }else { $noinduk = $val['B']; }
				if ($val['C'] == ''){ $nisn = '0'; }else { $nisn = $val['C']; }
				if ($val['D'] == ''){ $nama = ''; }else { $nama = $val['D']; }
				if ($val['D'] == ''){ $nik = '000000000000'; }else { $nik = $val['D']; }
				if ($val['E'] == ''){ $kelamin = '-'; }else { $kelamin = $val['E']; }
				if ($val['F'] == ''){ $tmplahir = '-'; }else { $tmplahir = $val['F']; }
				if ($val['G'] == ''){ $tgllahir = '-'; }else { $tgllahir = $val['G']; }
				if ($val['H'] == ''){ $umur = '0'; }else { $umur = $val['H']; }
				if ($val['I'] == ''){ $darah = '0'; }else { $darah = $val['I']; }
				if ($val['J'] == ''){ $berat = '0'; }else { $berat = $val['J']; }
				if ($val['K'] == ''){ $tinggi = '0'; }else { $tinggi = $val['K']; }
				if ($val['L'] == ''){ $alamat = '-'; }else { $alamat = $val['L']; }
				if ($val['M'] == ''){ $ayah = '-'; }else { $ayah = $val['M']; }
				if ($val['N'] == ''){ $ibu = '-'; }else { $ibu = $val['N']; }
				if ($val['O'] == ''){ $kayah = '-'; }else { $kayah = $val['O']; }
				if ($val['P'] == ''){ $kibu = '-'; }else { $kibu = $val['P']; }
				if ($val['Q'] == ''){ $wali = '-'; }else { $wali = $val['Q']; }
				if ($val['R'] == ''){ $kwali = '-'; }else { $kwali = $val['R']; }
				if ($val['S'] == ''){ $kelas = '-'; }else { $kelas = $val['S']; }
				if ($val['T'] == ''){ $foto = 'boxed-bg.jpg'; }else { $foto = $val['T']; }
				if ($val['U'] == ''){ $tahun = '-'; }else { $tahun = $val['U']; }
				if ($val['V'] == ''){ $hape = '00000000000'; }else { $hape = $val['V']; }
				if ($val['W'] == ''){ $asal = '-'; }else { $asal = $val['W']; }
				if ($val['X'] == ''){ $mutasi = '-'; }else { $mutasi = $val['X']; }
				if ($val['Y'] == ''){ $kelurahan = '-'; }else { $kelurahan = $val['Y']; }
				if ($val['Z'] == ''){ $kecamtan = '-'; }else { $kecamtan = $val['Z']; }
				if ($val['AA'] == ''){ $kota = '-'; }else { $kota = $val['AA']; }
				if ($val['AB'] == ''){ $kodepos = '00000'; }else { $kodepos = $val['AB']; }
				if ($val['AC'] == ''){ $telpon = '0000 000000'; }else { $telpon = $val['AC']; }
				if ($val['AD'] == ''){ $erte = '000'; }else { $erte = $val['AD']; }
				if ($val['AE'] == ''){ $erwe = '000'; }else { $erwe = $val['AE']; }
				if ($val['AF'] == ''){ $nokelulusan = ''; }else { $nokelulusan = $val['AF']; }
				if ($val['AG'] == ''){ $kodeortu = '0'; }else { $kodeortu = $val['AG']; }
				$cekmasuk = Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekmasuk == 0){
					if ($nama != '' AND $noinduk != ''){
						if ($nokelulusan == ''){
							$input = Datainduk::create([
								'noinduk'		=> $noinduk, 
								'nik'			=> $nik, 
								'nisn'			=> $nisn, 
								'nama'			=> $nama, 
								'kelamin'		=> $kelamin, 
								'tmplahir'		=> $tmplahir, 
								'tgllahir'		=> $tgllahir, 
								'umur'			=> $umur, 
								'darah'			=> $darah, 
								'berat'			=> $berat, 
								'tinggi'		=> $tinggi, 
								'alamatortu'	=> $alamat, 
								'namaayah'		=> $ayah, 
								'namaibu'		=> $ibu, 
								'kerjaayah'		=> $kayah, 
								'kerjaibu'		=> $kibu, 
								'wali'			=> $wali, 
								'pekerjaanwali' => $kwali, 
								'klspos'		=> $kelas, 
								'foto'			=> $foto, 
								'tamasuk'		=> $tahun, 
								'hape'			=> $hape, 
								'asal'			=> $asal, 
								'mutasi'		=> $mutasi, 
								'kelurahan'		=> $kelurahan, 
								'kecamatan'		=> $kecamtan, 
								'kota'			=> $kota, 
								'kodepos'		=> $kodepos, 
								'telpon'		=> $telpon, 
								'erte'			=> $erte, 
								'erwe'			=> $erwe, 
								'nokelulusan'	=> '', 
								'kodeortu'		=> $kodeortu,
								'id_sekolah'	=> session('sekolah_id_sekolah')
							]);
						} else {
							$input = Datainduk::create([
								'noinduk'		=> $noinduk, 
								'nik'			=> $nik, 
								'nisn'			=> $nisn, 
								'nama'			=> $nama, 
								'kelamin'		=> $kelamin, 
								'tmplahir'		=> $tmplahir, 
								'tgllahir'		=> $tgllahir, 
								'umur'			=> $umur, 
								'darah'			=> $darah, 
								'berat'			=> $berat, 
								'tinggi'		=> $tinggi, 
								'alamatortu'	=> $alamat, 
								'namaayah'		=> $ayah, 
								'namaibu'		=> $ibu, 
								'kerjaayah'		=> $kayah, 
								'kerjaibu'		=> $kibu, 
								'wali'			=> $wali, 
								'pekerjaanwali' => $kwali, 
								'klspos'		=> $kelas, 
								'foto'			=> $foto, 
								'tamasuk'		=> $tahun, 
								'hape'			=> $hape, 
								'asal'			=> $asal, 
								'mutasi'		=> $mutasi, 
								'kelurahan'		=> $kelurahan, 
								'kecamatan'		=> $kecamtan, 
								'kota'			=> $kota, 
								'kodepos'		=> $kodepos, 
								'telpon'		=> $telpon, 
								'erte'			=> $erte, 
								'erwe'			=> $erwe, 
								'nokelulusan'	=> $nokelulusan,
								'kodeortu'		=> $kodeortu,
								'id_sekolah'	=> session('sekolah_id_sekolah')
							]);
						}
						if ($input){ $sukses++; }
						else { $error =  $error.', Nama '.$nama.' No. Induk '.$noinduk.' (Gagal di Simpan)<br />'; }
					}					
				}				
			}
			Session::flash('status', 'Success');
			Session::flash('message', 'Upload Data berhasil sejumlah <strong>'.$sukses.'</strong><br />Log Error :<br />'.$error); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} else {
			Session::flash('status', 'Error');
			Session::flash('message', 'Harap masukkan file terlebih dahulu'); 
			Session::flash('alert-class', 'alert-danger');
			return back();
		}
	}
	public function exUploadkeuangan(Request $request) {
		if ($request->hasFile('datakeuangan')) {
			$path 			= $_FILES['datakeuangan']['tmp_name'];
			$sukses 		= 0;
			$error  		= '';
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet 	= $reader->load($path);
			$getalldata		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			$hilangkan 		= array(",", ".", " ");
			foreach($getalldata as $val){
				$kodependaf		= $val['A'];
				if ($val['B'] == ''){ $noinduk = ''; }else { $noinduk = $val['B']; }
				if ($val['C'] == ''){ $nama = ''; }else { $nama = $val['C']; }
				if ($val['D'] == ''){ $kelas = '-'; }else { $kelas = $val['D']; }
				if ($val['E'] == ''){ $spp = '0'; }else { $spp = $val['E']; }
				if ($val['F'] == ''){ $dpp = '0'; }else { $dpp = $val['F']; }
				if ($val['G'] == ''){ $paguyuban = '0'; }else { $paguyuban = $val['G']; }
				if ($val['H'] == ''){ $ekskul1 = ''; }else { $ekskul1 = $val['H']; }
				if ($val['I'] == ''){ $ekskul2 = ''; }else { $ekskul2 = $val['I']; }
				if ($val['J'] == ''){ $ekskul3 = ''; }else { $ekskul3 = $val['J']; }
				if ($val['K'] == ''){ $ekskul4 = ''; }else { $ekskul4 = $val['K']; }
				if ($val['L'] == ''){ $ekskul5 = ''; }else { $ekskul5 = $val['L']; }
				if ($nama != '' AND $noinduk != ''){
					$dpp 		= str_replace(',','',$dpp);
					$spp 		= str_replace(',','',$spp);
					$paguyuban 	= str_replace(',','',$paguyuban);
					$cekmasuk 	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$input 	= Setkuangan::create([
							'nama'		=> $nama, 
							'noinduk'	=> $noinduk, 
							'dpp'		=> $dpp,
							'spp'		=> $spp,
							'paguyuban' => $paguyuban,
							'eksul1'	=> $ekskul1,
							'eksul2'	=> $ekskul2,
							'eksul3'	=> $ekskul3,
							'eksul4'	=> $ekskul4,
							'eksul5'	=> $ekskul5,
							'id_sekolah'	=> session('sekolah_id_sekolah'),
						]);
					} else {
						$input	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
							'dpp'		=> $dpp,
							'spp'		=> $spp,
							'paguyuban' => $paguyuban,
							'eksul1'	=> $ekskul1,
							'eksul2'	=> $ekskul2,
							'eksul3'	=> $ekskul3,
							'eksul4'	=> $ekskul4,
							'eksul5'	=> $ekskul5,
							'id_sekolah'	=> session('sekolah_id_sekolah'),
						]);
					}					
					if ($input){ $sukses++; }
					else { $error =  $error.', Nama '.$nama.' No. Induk '.$noinduk.' (Gagal di Simpan)<br />'; }
				}
			}
			Session::flash('status', 'Success');
			Session::flash('message', 'Upload Data berhasil sejumlah <strong>'.$sukses.'</strong><br />Log Error :<br />'.$error); 
			Session::flash('alert-class', 'alert-success');
			return back();
		} else {
			Session::flash('status', 'Error');
			Session::flash('message', 'Harap masukkan file terlebih dahulu'); 
			Session::flash('alert-class', 'alert-danger');
			
			return back();
		}
	}
	public function exSimpandataujian(Request $request) {
		$idne		= $request->val01;
		$hari		= $request->val02;
		$jam 		= $request->val03;
		$materi 	= $request->val04;
		$nama 		= $request->val05;
		$tanggal 	= $request->val06;
		$ruang 		= $request->val07;
		
		if ($hari == '' OR $jam == '' OR $materi == '' OR $tanggal == '' OR $ruang == '' OR $nama == ''){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Mohon Mengisi Semua Form Yang di Sediakan
				</div>';
		} else {
			if ($idne == 'new'){
				$simpan	= Tesppdb::create([
					'hari'		=> $hari, 
					'jam'		=> $jam, 
					'materi'	=> $materi, 
					'nama'		=> $nama, 
					'tanggal'	=> $tanggal, 
					'ruang'		=> $ruang,
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
				if ($simpan){
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses!</h4>
							Jadwal Ujian PPDB Berhasil di Simpan
						</div>';
				}
				else { 
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error!</h4>
							Gagal Delete Jadwal Ujian PPDB, Silahkan Coba Beberapa Saat Lagi
						</div>'; 
				}
			}
			else {
				$simpan	= Tesppdb::where('id', $idne)->update([
					'hari'		=> $hari, 
					'jam'		=> $jam, 
					'materi'	=> $materi, 
					'nama'		=> $nama, 
					'tanggal'	=> $tanggal, 
					'ruang'		=> $ruang,
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
				
				if ($simpan){
					echo '<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Sukses!</h4>
							Jadwal Ujian PPDB Berhasil di Update
						</div>';
				}
				else { 
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error!</h4>
							Gagal Delete Jadwal Ujian PPDB, Silahkan Coba Beberapa Saat Lagi
						</div>'; 
				}
			}
			
		}
	}
	public function exSimpanhasilppdb(Request $request) {
		$idne		= $request->val01;
		$statuse	= $request->val02;
		$nomer 		= $request->val03;
		$seragam 	= str_replace(',','',$request->val04);
		$gedung 	= str_replace(',','',$request->val05);
		$spp 		= str_replace(',','',$request->val06);
		$kegiatan 	= str_replace(',','',$request->val07);
		$deadline 	= $request->val08;
		$btspengum 	= $request->val09;
		$update		= Datapsb::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
			'hasil'		=> $statuse, 
			'nosurat'	=> $nomer, 
			'dana1'		=> $seragam, 
			'dana2'		=> $gedung, 
			'dana3'		=> $spp, 
			'dana4'		=> $kegiatan,
			'deadline'	=> $deadline,
			'akhirumum'	=> $btspengum,
			'id_sekolah'	=> session('sekolah_id_sekolah'),
		]);
		if ($update){
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					Update SUKSES
				</div>';
		} else { 
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Sistem Error => Silahkan Coba Beberapa Saat lagi
				</div>'; 
		}
	}
	public function exSaveupdateppdb(Request $request) {
		$tahun		= $request->val01;
		$kelas		= $request->val02;
		$nama 		= strtoupper($request->val03);
		$tmtlahir	= strtoupper($request->val04);
		$tgllahir	= $request->val05;
		$kelamin	= strtoupper($request->val06);
		$tinggi		= $request->val07;
		$berat		= $request->val08;
		$ayah		= strtoupper($request->val09);
		$ibu		= strtoupper($request->val10);
		$kayah		= $request->val11;
		$kibu		= $request->val12;
		$wali		= strtoupper($request->val13);
		$kwali		= $request->val14;
		$alamat		= strtoupper($request->val15);
		$erte		= strtoupper($request->val16);
		$erwe		= strtoupper($request->val17);
		$kelu		= strtoupper($request->val18);
		$keca		= strtoupper($request->val19);
		$kodepos	= strtoupper($request->val20);
		$hape		= $request->val21;
		$asal		= $request->val22;
		$kota		= strtoupper($request->val23);
		$idne		= $request->val24;
		$darah		= $request->val25;
		$update		= Datapsb::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
			'nama'			=> $nama, 
			'kelamin'		=> $kelamin, 
			'tmplahir'		=> $tmtlahir, 
			'tgllahir'		=> $tgllahir, 
			'darah'			=> $darah,
			'berat'			=> $berat,
			'tinggi'		=> $tinggi, 
			'alamatortu'	=> $alamat, 
			'namaayah'		=> $ayah, 
			'namaibu'		=> $ibu, 
			'kerjaayah'		=> $kayah, 
			'kerjaibu'		=> $kibu, 
			'wali'			=> $wali, 
			'pekerjaanwali'	=> $kwali, 
			'tamasuk'		=> $tahun, 
			'hape'			=> $hape, 
			'asal'			=> $asal, 
			'kelurahan'		=> $kelu, 
			'kecamatan'		=> $keca, 
			'kota'			=> $kota, 
			'kodepos'		=> $kodepos, 
			'erte'			=> $erte, 
			'erwe'			=> $erwe, 	
			'id_sekolah' => session('sekolah_id_sekolah')		
		]);
		if ($update){
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					Data Berhasil di Update
				</div>';
		} else { 
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Sistem Error => Silahkan Coba Beberapa Saat lagi
				</div>'; 
		}		
	}
	public function ctkKwitansipsb(Request $request) {
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
		$tamasuk				= $rsetting->pendaftaran;
		$homebase				= url("/");
		$statppdb				= '';
		$kodebaru				= '';
		$kodepindahan 			= '';
		$hargaformulir 			= '';
		$namabank 				= '';
		$norek 					= '';
		$periode 				= '';
		$setspp1 				= '';
		$setspp2 				= '';
		$setspp3 				= '';
		$setdpp1 				= '';
		$setdpp2 				= '';
		if ($kopsurat == '' OR $kopsurat == null){
			$kopsurat 			= '<tr>
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
									</tr>';
		} else {
			$kopsurat			= '<tr><td colspan="11"><img src="'.$homebase.'/'.$kopsurat.'" width="100%" /></tr>';
		}
		$sql 					= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rlayanan){
				$status 		= $rlayanan->status;
				$layanan 		= $rlayanan->layanan;
				if ($layanan == 'periodepsb') { $periode = $status; }
				if ($layanan == 'ppdb') { $statppdb = $status; }
				if ($layanan == 'kodebaru') { $kodebaru = $status; }
				if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
				if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
				if ($layanan == 'namabank') { $namabank = $status; }
				if ($layanan == 'norek') { $norek = $status; }
				if ($layanan == 'spp1') { $setspp1 = $status; }
				if ($layanan == 'spp2') { $setspp2 = $status; }
				if ($layanan == 'spp3') { $setspp3 = $status; }
				if ($layanan == 'dpp1') { $setdpp1 = $status; }
				if ($layanan == 'dpp2') { $setdpp2 = $status; }
			}
		}
		if (isset($request->valkirim)){
			$idne = $request->valkirim;
		} else { $idne = ''; }
		$bulanlist 				= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$tgliki 				= date("d");
		$mthiki 				= (int)date("m");
		$thniki 				= date("Y");
		$blniki 				= $bulanlist[$mthiki];
		$tanggalctk 			= $tgliki.' '.$blniki.' '.$thniki;
		$niy 					= Session('nip');
		$asline 				= Session('nama');
		$costumid				= $kodebaru;
		if ($idne != ''){
			$rmaster2	= Datapsb::where('id', $idne)->first();
			$nama 		= $rmaster2->nama;
			$tamasuk	= $rmaster2->tamasuk;
			$jeneng		= $request->jeneng;
			$nominal	= $hargaformulir;
			$nomhuruf 	= SendMail::terbilang($nominal);
			$nomangka	= number_format( $nominal , 0 , '.' , ',' );
		} else {
			$jenis		= $request->val01;
			$nama		= $request->val02;
			$nominal	= str_replace(',','',$request->val03);
			$nomor		= $request->val04;
			$jeneng		= $request->val05;
			$idlws 		= '';
			if (isset($request->val06)) {
				$idlws	= $request->val06;
			}
			$tglcetak 		= '';
			if (isset($request->val07)) {
				$tglcetak	= $request->val07;
			}
			
			$nomhuruf 	= SendMail::terbilang($nominal);
			$nomangka	= number_format( $nominal , 0 , '.' , ',' );
			$tahunne	= date("Y");
			$kodethn 	= substr($tahunne, -2);
			
			if ($jenis == 'Reguler'){
				$costumid 	= $kodebaru.$nomor;
				$jenis		= $kodebaru;
			}
			else {
				$costumid 	= $kodepindahan.$nomor;
				$jenis		= $kodepindahan;
			}
			if ($idlws == ''){
				$input = Formulirpsb::create([
					'tapel'		=> $tamasuk, 
					'nama'		=> $nama, 
					'jenis'		=> $jenis, 
					'nomor'		=> $nomor, 
					'nominal'	=> $nominal, 
					'tanggal'	=> $tanggalctk,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				$idlws = $input->id;
				if ($input){
					HPTKeuangan::create([
						'tanggal'		=> $tgliki,
						'bulan'			=> $mthiki,
						'tahun'			=> $thniki,
						'deskripsi'		=> 'Pembelian Formulir an. '.$nama.' TA.'.$tamasuk,
						'jenis'			=> 'pendaftaran',
						'bendahara'		=> null,
						'tglkwitansi'	=> null,
						'tandatangan'	=> null,
						'id_sekolah'	=> session('sekolah_id_sekolah'),
						'created_by'	=> Session('nip')
					]);
				}
			}
			else {
				$tanggalctk = $tglcetak;
			}
		}
		$alamatcetak				= $homebase.'/kwitansipsb/'.$idlws;
		$qrcode 					= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
		$tasks						= [];
		$tasks['logo_grey']			= $homebase.'/'.$rsetting->logo_grey;
		$tasks['kopsurat']			= $kopsurat;
		$tasks['rsetting']			= $rsetting;
		$tasks['qrcode']			= $qrcode;
		$tasks['costumid']			= $costumid;
		$tasks['nama']				= $nama;
		$tasks['nomhuruf']			= $nomhuruf;
		$tasks['tamasuk']			= $tamasuk;
		$tasks['tanggalctk']		= $tanggalctk;
		$tasks['nomangka']			= $nomangka;
		$tasks['asline']			= $asline;
		$tasks['namaapps01']  		= Session('sekolah_nama_aplikasi');
		$tasks['domainapps01']  	= Session('sekolah_nama_yayasan');
		$tasks['subdomainapps01']  	= Session('sekolah_nama_sekolah');
		$tasks['subsubdomainapps01']= Session('sekolah_kode_sekolah');
		$tasks['addressapps01']  	= Session('sekolah_alamat');
		$tasks['emailapps01']  		= Session('sekolah_email');
		$tasks['lamanapps01']  		= parse_url(request()->root())['host'];
		$tasks['logofrontapps01']  	= Session('sekolah_frontpage');
		$tasks['logo01']  			= url("/").'/'.Session('sekolah_logo');
		return view('cetak.kwitansipsb', $tasks);
	}
	public function exSavearsipppdb(Request $request) {
		$idne		= $request->val01;
		$kelas		= $request->val02;
		$noinduk	= $request->val03;
		$nisn		= $request->val04;
		$cekmasuk	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
		if ($nisn == ''){$nisn = '0';}
		if ($cekmasuk != 0){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Gagal Simpan!</h4>
					Double No. Induk Terdeteksi, Coba Refresh atau coba beberapa saat lagi
				</div>';
		} else {
			$getdatapsb = Datapsb::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$input = Datainduk::create([
				'noinduk'		=> $noinduk, 
				'nik'			=> $getdatapsb->nik, 
				'nisn'			=> $nisn, 
				'nama'			=> $getdatapsb->nama, 
				'kelamin'		=> $getdatapsb->kelamin, 
				'tmplahir'		=> $getdatapsb->tmplahir, 
				'tgllahir'		=> $getdatapsb->tgllahir, 
				'umur'			=> $getdatapsb->umur,
				'darah'			=> $getdatapsb->darah, 
				'berat'			=> $getdatapsb->berat, 
				'tinggi'		=> $getdatapsb->tinggi, 
				'alamatortu'	=> $getdatapsb->alamatortu, 
				'namaayah'		=> $getdatapsb->namaayah, 
				'namaibu'		=> $getdatapsb->namaibu, 
				'kerjaayah'		=> $getdatapsb->kerjaayah, 
				'kerjaibu'		=> $getdatapsb->kerjaibu, 
				'wali'			=> $getdatapsb->wali, 
				'pekerjaanwali' => $getdatapsb->pekerjaanwali, 
				'klspos'		=> $kelas, 
				'foto'			=> $getdatapsb->foto, 
				'tamasuk'		=> $getdatapsb->tamasuk,
				'hape'			=> $getdatapsb->hape, 
				'asal'			=> $getdatapsb->asal, 
				'mutasi'		=> $getdatapsb->mutasi, 
				'kelurahan'		=> $getdatapsb->kelurahan, 
				'kecamatan'		=> $getdatapsb->kecamatan, 
				'kota'			=> $getdatapsb->kota, 
				'kodepos'		=> $getdatapsb->kodepos, 
				'telpon'		=> $getdatapsb->telpon, 
				'erte'			=> $getdatapsb->erte, 
				'erwe'			=> $getdatapsb->erwe, 
				'nokelulusan'	=> '', 
				'kodeortu'		=> '',
				'id_sekolah' 	=> session('sekolah_id_sekolah')
			]);
			$arsip 			= 'Arsip TA '.$getdatapsb->tamasuk;
			if ($input){
				Datapsb::where('id', $idne)->update([
					'tamasuk' => $arsip
				]);
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Data Berhasil di Arsipkan
					</div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Error Sistem, Coba Beberapa Saat Lagi
					</div>';
			}
		}
	}
	public function exSaveverifikasipsb(Request $request) {
		$idne		= $request->val01;
		$verifikasi	= $request->val02;
		
		if ($verifikasi == ''){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Gagal Simpan!</h4>
					Mohon di Tentukan Verifikasinya
				</div>';
		} else {
			$input 	= Datapsb::where('id', $idne)->update([
				'status' => $verifikasi
			]);
			if ($input){
				echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Data Berhasil di Verifikasi
					</div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Error Sistem, Coba Beberapa Saat Lagi
					</div>';
			}
		}
	}
	public function exSavesettingssppdpp(Request $request) {
		$spp1		= $request->val01;
		$spp2		= $request->val02;
		$spp3		= $request->val03;
		$dpp1		= $request->val04;
		$dpp2		= $request->val05;
		$spp1 		= str_replace(',','',$spp1);
		$spp2 		= str_replace(',','',$spp2);
		$spp3 		= str_replace(',','',$spp3);
		$dpp1 		= str_replace(',','',$dpp1);
		$dpp2 		= str_replace(',','',$dpp2);
		$status		= '';
		$layananData= [
			'spp1' => [
				'status' => $spp1,
				'message' => 'SPP 1'
			],
			'spp2' => [
				'status' => $spp2,
				'message' => 'SPP 2'
			],
			'spp3' => [
				'status' => $spp3,
				'message' => 'SPP 3'
			],
			'dpp1' => [
				'status' => $dpp1,
				'message' => 'DPP 1'
			],
			'dpp2' => [
				'status' => $dpp2,
				'message' => 'DPP 2'
			],
		];
		
		foreach ($layananData as $layanan => $data) {
			$cek = Layanan::where('layanan', $layanan)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($cek->id)){
				Layanan::where('layanan', $cek->id)->update([
					'status' 		=> $data['status'],
				]);
				$status = $status . '<br />Update Setting ' . $data['message'] . ' Nominal ' . $request->{'val0' . ($i + 1)};
			} else {
				Layanan::create([
					'layanan' 	=> $layanan,
					'status' 	=> $data['status'],
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				$status = $status . '<br />Tambah Setting ' . $data['message'] . ' Nominal ' . $request->{'val0' . ($i + 1)};
			}
		}
		echo '<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Sukses!</h4>
				'.$status.'
			</div>';
	}
	public function exSavesettingppdb(Request $request) {
		$tapel 			= $request->val01;
		$ppdb 			= $request->val02;
		$pengumuman		= $request->val03;
		$kodebaru		= $request->val04;
		$kodepindahan	= $request->val05;
		$tglpengu		= $request->val06;
		$hargaformulir	= $request->val07;
		$namabank		= $request->val08;
		$norek			= $request->val09;
		$periodepsb		= $request->val10;
		$hargaformulir 	= str_replace(',','',$hargaformulir);
		$status			= '';
		Sekolah::where('id', session('sekolah_id_sekolah'))->update([
			'pengumuman' 	=> $pengumuman,
			'pendaftaran' 	=> $tapel,
		]);
		$layananData = [
			[
				'layanan' 	=> 'ppdb',
				'status' 	=> $ppdb,
				'message' 	=> 'Setting ppdb '.$request->val02
			],
			[
				'layanan' 	=> 'kodebaru',
				'status' 	=> $kodebaru,
				'message' 	=> 'Setting Kode Siswa Baru '.$request->val04
			],
			[
				'layanan' 	=> 'kodepindahan',
				'status' 	=> $kodepindahan,
				'message' 	=> 'Setting Kode Siswa Pindahan '.$kodepindahan
			],
			[
				'layanan' 	=> 'hargaformulir',
				'status' 	=> $hargaformulir,
				'message' 	=> 'Setting Harga Formulirpsb '.$request->val07
			],
			[
				'layanan' 	=> 'namabank',
				'status' 	=> $namabank,
				'message' 	=> 'Setting Nama Bank :  '.$request->val08
			],
			[
				'layanan' 	=> 'norek',
				'status' 	=> $norek,
				'message' 	=> 'Setting Norek Bank :  '.$request->val09
			],
			[
				'layanan' 	=> 'periodepsb',
				'status' 	=> $periodepsb,
				'message' 	=> 'Setting Periode PSB :  '.$request->val10
			],
		];
		
		foreach ($layananData as $layanan) {
			$cek = Layanan::where('layanan', $layanan['layanan'])->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($cek->id)){
				Layanan::where('id', $cek->id)->update([
					'status' 		=> $layanan['status'],
				]);
				$status = $status . '<br />Update ' . $layanan['message'];
			} else {
				Layanan::create([
					'layanan' 		=> $layanan['layanan'],
					'status' 		=> $layanan['status'],
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
				$status = $status . '<br />Tambah ' . $layanan['message'];
			}
		}
		
		echo '<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Sukses!</h4>
				'.$status.'
			</div>';
	}
	public function exSavenilaippdb(Request $request) {
		$idne		= $request->val01;
		$n1			= (int)$request->val02;
		$n2			= (int)$request->val03;
		$n3			= (int)$request->val04;
		$n7			= (int)$request->val05;
		$n8			= (int)$request->val06;
		$n9			= (int)$request->val07;
		$n10		= (int)$request->val08;
		$pembagi1 	= 0;
		$pembagi2 	= 0;
		$pembagi3 	= 0;
		$tot1 	  	= 0;
		$tot2 	  	= 0;
		$tot3 	  	= 0;
		$des1 	  	= '';
		$des2 	  	= '';
		$des3 	  	= '';
		$des4 	  	= '';
		$des5 	  	= '';
		$des6 	  	= '';
		$des7 	  	= '';
		$des8 	  	= '';
		if ($request->val02 != ''){ 
			$pembagi1++; 
			$tot1 = $tot1 + $n1;
			if ( ($n1 >= 0) && ($n1 <= 58)) { $des1 = 'Ananda belum mengenal huruf A-Z.'; }
			elseif ( ($n1 >= 59) && ($n1 <= 68)) { $des1 = 'Ananda baru dapat membaca mengeja perhuruf.'; }
			elseif ( ($n1 >= 69) && ($n1 <= 78)) { $des1 = 'Ananda sudah dapat membaca persuku kata atau perkata.'; }	
			else { $des1 = 'Ananda sudah dapat membaca kalimat sederhana.';}
		} 
		if ($request->val03 != ''){ 
			$pembagi1++; 
			$tot1 = $tot1 + $n2;
			if ( ($n2 >= 0) && ($n2 <= 58)) { $des2 = 'Ananda belum mengenal huruf A-Z.'; }
			elseif ( ($n2 >= 59) && ($n2 <= 68)) { $des2 = 'Ananda belum bisa menulis perkata.'; }
			elseif ( ($n2 >= 69) && ($n2 <= 78)) { $des2 = 'Ananda sudah bisa menulis perkata.'; }	
			else { $des2 = 'Ananda sudah bisa menulis kalimat.';}
		}
		if ($request->val04 != ''){ 
			$pembagi1++;
			$tot1 = $tot1 + $n3;
			if ( ($n3 >= 0) && ($n3 <= 58)) { $des3 = 'Ananda belum bisa menghitung angka 1-10.'; }
			elseif ( ($n3 >= 59) && ($n3 <= 68)) { $des3 = 'Ananda sudah bisa menghitung angka 1-20.'; }
			elseif ( ($n3 >= 69) && ($n3 <= 78)) { $des3 = 'Ananda sudah bisa menghitung angka lebih dari 20, tetapi belum bisa penjumlahan dan pengurangan.'; }
			else { $des3 = 'Ananda sudah  bisa penjumlahan dan pengurangan.';}
		}
		if ($request->val05 != ''){ 
			$pembagi2++; 
			$tot2 = $tot2 + $n7;
			if ( ($n7 >= 0) && ($n7 <= 58)) { $des4 = 'Ananda belum mengenal huruf Hijaiyyah .'; }
			elseif ( ($n7 >= 59) && ($n7 <= 68)) { $des4 = 'Ananda mengaji huruf lepas.'; }
			elseif ( ($n7 >= 69) && ($n7 <= 78)) { $des4 = 'Ananda mengaji huruf sambung dengan lambat.'; }	
			else { $des4 = 'Ananda mengaji dengan cepat dan benar, serta paham tajwid.';}
		}
		if ($request->val06 != ''){ 
			$pembagi2++; 
			$tot2 = $tot2 + $n8;
			if ( ($n8 >= 0) && ($n8 <= 58)) { $des5 = 'Ananda tidak mengenal huruf hijaiyyah.'; }
			elseif ( ($n8 >= 59) && ($n8 <= 68)) { $des5 = 'Ananda belum bisa menyalin huruf hijaiyyah .'; }	
			else { $des5 = 'Ananda menyalin huruf hijaiyyah dengan benar dan rapi .';}
		}
		if ($request->val07 != ''){ 
			$pembagi2++; 
			$tot2 = $tot2 + $n9;
			if ( ($n9 >= 0) && ($n9 <= 58)) { $des6 = 'Ananda belum bisa membaca surat-surat Juz Amma.'; }
			elseif ( ($n9 >= 59) && ($n9 <= 68)) { $des6 = 'Ananda bisa membaca 3 surat Juz Amma dengan cukup baik.'; }
			elseif ( ($n9 >= 69) && ($n9 <= 78)) { $des6 = 'Ananda bisa membaca 3 surat Juz Amma dengan baik.'; }	
			else { $des6 = 'Ananda bisa membaca 3 surat Juz Amma dengan sangat baik';}
		}
		if ($request->val08 != ''){ 
			$pembagi2++; 
			$tot2 = $tot2 + $n10;
			if ( ($n10 >= 0) && ($n10 <= 58)) { $des7 = 'Ananda belum bisa membaca doa-doa harian.'; }
			elseif ( ($n10 >= 59) && ($n10 <= 68)) { $des7 = 'Ananda bisa membaca 3 doa harian dengan cukup baik.'; }
			elseif ( ($n10 >= 69) && ($n10 <= 78)) { $des7 = 'Ananda bisa membaca 3 doa harian dengan baik.'; }	
			else { $des7 = 'Ananda bisa membaca 3 doa harian dengan sangat baik.';}
		}
		if ($tot1 != 0){
			$rata1 	= $tot1 / $pembagi1;
		} else { $rata1 = ''; }
		if ($tot2 != 0){
			$rata2 	= $tot2 / $pembagi2;
		} else { $rata2 = ''; }
		
		
		/*
		if ($n11 != ''){ 
			$pembagi3++; 
			$tot3 = $tot3 + $n11;	
		}
		if ($n12 != ''){ 
			$pembagi3++; 
			$tot3 = $tot3 + $n12;
		}
		if ($n13 != ''){ 
			$pembagi3++; 
			$tot3 = $tot3 + $n13;
		}
		$rata3 	= $tot3 / $pembagi3;
		
		if ( ($tot3 >= 0) && ($tot3 <= 8)) { $des8 = 'Ananda kurang teliti dalam bertindak, memahami bentuk dan jumlah benda, dan memahami pola gambar.'; }
		elseif ( ($tot3 >= 9) && ($tot3 <= 58)) { $des8 = 'Ananda cukup teliti dalam bertindak, memahami bentuk dan jumlah benda, dan memahami pola gambar.'; }
		elseif ( ($tot3 >= 59) && ($tot3 <= 78)) { $des8 = 'Ananda teliti dalam bertindak, memahami bentuk dan jumlah benda, dan memahami pola gambar.'; }	
		else { $des8 = 'Ananda sangat teliti dalam bertindak, memahami bentuk dan jumlah benda, dan memahami pola gambar.';}
		*/
		if ($rata1 == ''){
			if ($rata2 == ''){ $total = 0; }
			else { $total = $rata2; }
			$rata  	= round($total,2);
		} else {
			if ($rata2 == ''){ 
				$total = $rata1;
				$rata  	= round($total,2);
			}
			else { 
				$total = round(($rata1 + $rata2),0);
				$rata  	= round(($total/2),2);
			}
		}
		
		
		$input 	= Datapsb::where('id', $idne)->update([
			'n1' 		=> $n1,
			'n2' 		=> $n2,
			'n3' 		=> $n3,
			'n7' 		=> $n7,
			'n8' 		=> $n8,
			'n9' 		=> $n9,
			'n10' 		=> $n10,
			'total' 	=> $total,
			'rata' 		=> $rata,
			'des1' 		=> $des1,
			'des2' 		=> $des2,
			'des3' 		=> $des3,
			'des4' 		=> $des4,
			'des5' 		=> $des5,
			'des6' 		=> $des6,
			'des7'		=> $des7,
			'id_sekolah'=>session('sekolah_id_sekolah')
		]);
		if ($input){
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses</h4>
					Nilai Berhasil di Simpan
				</div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Sistem Error, Coba Lagi Beberapa Saat Lagi
				</div>';	
		}		
	}
	public function jsonJadwalujianppdb() {
		$arrjadwalpsb	= [];
		$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$sql 			= Tesppdb::orderBy('tanggal', 'ASC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$tanggal 	= $hasil->tanggal;
				$arrayttl 	= explode("-", $tanggal);
				$thniki 	= $arrayttl[0];
				$mthiki 	= $arrayttl[1];
				$tgliki 	= $arrayttl[2];
				$settanggal	= $tgliki.'-'.$mthiki.'-'.$thniki;
				$intbulan	= (int)$mthiki;
				$blniki 	= $bulanlist[$intbulan];
				$tlstgl 	= $tgliki.' '.$blniki.' '.$thniki;
				$arrjadwalpsb[] = array(
					'idne' 		=> $hasil->id,
					'hari' 		=> $hasil->hari,
					'jam' 		=> $hasil->jam,
					'materi' 	=> $hasil->materi,
					'nama'		=> $hasil->nama,
					'tanggal'	=> $settanggal,
					'tlstanggal'=> $tlstgl,
					'ruang'		=> $hasil->ruang,
				);
			}
		}
		echo json_encode($arrjadwalpsb);
	}
	public function jsonDetailpembeli(Request $request) {
		$arrjadwalpsb			= [];
		$tapel					= $request->val01;
		$jenis					= $request->val02;
		$sql 					= Formulirpsb::where('tapel', $tapel)->where('jenis', $jenis)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('tanggal', 'ASC')->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$arrjadwalpsb[] = array(
					'id' 		=> $hasil->id,	
					'tapel' 	=> $hasil->tapel,	
					'nama' 		=> $hasil->nama,			
					'jenis'		=> $hasil->jenis,
					'nomor'		=> $hasil->nomor,
					'costumid'	=> $hasil->jenis.$hasil->nomor,
					'nominal'	=> number_format( $hasil->nominal , 0 , '.' , ',' ),
					'tanggal'	=> $hasil->tanggal,
				);
			}
		}
		echo json_encode($arrjadwalpsb);
	}
	public function jsonDatapembelianform() {
		$arrformulirpsb	= [];
		$rsetting		= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$pendaftaran	= $rsetting->pendaftaran;
		$sql 			= Formulirpsb::select(DB::raw('SUM(nominal) as nominal'), DB::raw('COUNT(id) as jumlah'), 'tapel', 'jenis')
							->where('tapel', $pendaftaran)->where('id_sekolah',session('sekolah_id_sekolah'))
							->groupBy('jenis')->orderBy('jenis', 'DESC')->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$arrformulirpsb[] = array(
					'tapel' 		=> $hasil->tapel,
					'jenis' 		=> $hasil->jenis,		
					'jumlah' 		=> $hasil->jumlah,
					'nominal' 		=> number_format( $hasil->nominal , 0 , '.' , ',' ),
				);
			}
		}
		echo json_encode($arrformulirpsb);
	}
	public function jsonDatappdb() {
		//skripby_chatgpt
		$arrdatappdb	= [];
		$rsetting		= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		if (isset($rsetting->pendaftaran)){
			$pendaftaran 	= $rsetting->pendaftaran;
		} else {
			$pendaftaran	= 'No Data';
		}
		$getnomer 		= Datainduk::orderBy('noinduk', 'DESC')->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($getnomer->noinduk)){
			$noinduk	= $getnomer->noinduk;
			$berikutnya	= $noinduk + 1;
		} else {
			$noinduk	= 1;
			$berikutnya	= 2;
		}
		$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$arrdatappdb= Datapsb::select('id', 'nama', 'nik', 'kodependaf', 'kelamin', 'tmplahir', 'tgllahir', 'darah', 'tinggi', 'berat', 'namaayah', 'namaibu', 'kerjaayah', 'kerjaibu', 'wali', 'pekerjaanwali', 'alamatortu', 'foto', 'tamasuk', 'hape', 'asal', 'erte', 'erwe', 'kelurahan', 'kecamatan', 'kota', 'kodepos', 'telpon', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8', 'n9', 'n10', 'n11', 'n12', 'n13', 'total', 'rata', 'hasil', 'nosurat', 'dana1', 'dana2', 'dana3', 'dana4')
								->selectSub(function ($query) {
									$query->selectRaw("CASE
														WHEN status = 'verified' THEN '<small class=\"label bg-green\">GOOD</small>'
														WHEN status = 'unverified' THEN '<small class=\"label bg-red\">BAD</small>'
														ELSE '<strong>' || status || '%</strong>'
														END AS status");
								}, 'persenselesai')
								->where('tamasuk', $pendaftaran)
								->where('id_sekolah', session('sekolah_id_sekolah'))
								->orderBy('id', 'DESC')
								->get();
		
		echo json_encode($arrdatappdb);
	}
	public function jsonBuku() {
		$arrperpus	= [];	
		$homebase	= url("/");
		$i 			= 0;
		$sql 		= Perpumini::orderBy('id', 'DESC')->where('id_sekolah',session('sekolah_id_sekolah'))->groupby('isbn')->get();
		if (!empty($sql)){
			foreach ($sql as $hasil){
				$i++;
				$lampiran 		= ($hasil->gambar && File::exists(public_path("images/perpus/{$hasil->gambar}"))) ? "$homebase/images/perpus/{$hasil->gambar}" : "$homebase/logo.png";
				$jumlahbuku 	= Perpumini::where('id_sekolah',session('sekolah_id_sekolah'))->where('isbn', $hasil->isbn)->count();
				$cekpeminjaman 	= Peminjaman::where('kodebuku', $hasil->id)->count();
				if ($cekpeminjaman >= $jumlahbuku){
					$marking = 'NO';
				} else { $marking = 'YES'; }
				$jadwalguna = '';
				if ($marking == 'NO'){
					$getpinjam = Perpumini::where('id_sekolah',session('sekolah_id_sekolah'))->where('isbn', $hasil->isbn)->get();
					if(isset($getpinjam)){
						$jadwalguna = '<ol>';
						foreach($getpinjam as $rpinjam){
							$jadwalguna = $jadwalguna.'<li>Dipinjam Oleh : '.$rpinjam->peminjam.' Kelas '.$rpinjam->kelas.' Pada Tanggal '.$rpinjam->tglkembali.'</li>';
						}
						$jadwalguna = $jadwalguna.'</ol>';
					}
					
				}
				$arrperpus[] = array(
					'idne' 			=> $hasil->id,
					'gambar' 		=> $lampiran,		
					'judul' 		=> $hasil->judul,
					'link' 			=> $hasil->link,
					'kodebuku' 		=> $hasil->kodebuku,
					'pengarang' 	=> $hasil->pengarang,
					'cetakan' 		=> $hasil->cetakan,
					'kota' 			=> $hasil->kota,
					'penerbit' 		=> $hasil->penerbit,
					'tahun' 		=> $hasil->tahun,
					'ilustrasi' 	=> $hasil->ilustrasi,
					'halaman' 		=> $hasil->halaman,
					'id_sekolah' 	=> $hasil->id_sekolah,
					'isbn' 			=> $hasil->isbn,
					'tglmasuk' 		=> $hasil->tglmasuk,
					'tahunperolehan'=> $hasil->tahunperolehan,
					'jenisperolehan'=> $hasil->jenisperolehan,
					'rakbuku' 		=> $hasil->rakbuku,
					'kondisi' 		=> $hasil->kondisi,
					'kategori' 		=> $hasil->kategori,
					'inputor' 		=> $hasil->inputor,
					'jumlah' 		=> $jumlahbuku,
					'marking' 		=> $marking,
					'jadwalguna' 	=> $jadwalguna,
				);
			}
		}
		echo json_encode($arrperpus);
	}
	public function jsonBukucari(Request $request) {
		//skripby_chatgpt
		$arrperpus 	= [];
		$homebase 	= url("/");
		$kerja 		= $request->val01;
		$sql 		= Perpumini::orderBy('id', 'DESC')
						->where('id_sekolah', session('sekolah_id_sekolah'));
		if ($kerja == 'all') {
			$sql->where('kondisi', 'BAIK');
		} elseif ($kerja == 'rusak') {
			$sql->where('kondisi', 'RUSAK');
		} else {
			$sql->whereIn('kondisi', ['HILANG', 'MUSNAH']);
		}
		$peminjamans = $sql->get();

		foreach ($peminjamans as $hasil) {
			$lampiran = ($hasil->gambar && File::exists(public_path("images/perpus/{$hasil->gambar}"))) ? "$homebase/images/perpus/{$hasil->gambar}" : "$homebase/logo.png";
			
			$arrperpus[] = [
				'idne' 			=> $hasil->id,
				'gambar' 		=> $lampiran,        
				'judul' 		=> $hasil->judul,
				'link' 			=> $hasil->link,
				'kodebuku' 		=> $hasil->kodebuku,
				'pengarang' 	=> $hasil->pengarang,
				'cetakan' 		=> $hasil->cetakan,
				'kota' 			=> $hasil->kota,
				'penerbit' 		=> $hasil->penerbit,
				'tahun' 		=> $hasil->tahun,
				'ilustrasi' 	=> $hasil->ilustrasi,
				'halaman' 		=> $hasil->halaman,
				'id_sekolah' 	=> $hasil->id_sekolah,
				'isbn' 			=> $hasil->isbn,
				'tglmasuk' 		=> $hasil->tglmasuk,
				'tahunperolehan'=> $hasil->tahunperolehan,
				'jenisperolehan'=> $hasil->jenisperolehan,
				'rakbuku' 		=> $hasil->rakbuku,
				'kondisi' 		=> $hasil->kondisi,
				'kategori' 		=> $hasil->kategori,
				'inputor' 		=> $hasil->inputor,
			];
		}

		echo json_encode($arrperpus);
	}
	public function jsonPeminjaman(Request $request) {
		//skripby_chatgpt
		$arrperpus 	= [];
		$homebase 	= url("/");
		$bulan 		= $request->val01;
		$tahun 		= $request->val02;
		$sql 		= Peminjaman::where('id_sekolah', session('sekolah_id_sekolah'));
		if ($bulan !== 'aktif') {
			$sql->where('tglpinjam', 'LIKE', ($bulan === 'ALL') ? $tahun.'%' : $tahun.'-'.$bulan.'-%');
		}
		$sql->orderBy('tglkembali', 'ASC');
		$peminjamans = $sql->get();
		foreach ($peminjamans as $hasil) {
			$status 	= $hasil->status;
			$tlsstatus 	= '';
			switch ($status) {
				case 0:
					$tlsstatus = '<span class="badge bg-green">TELAH DIKEMBALIKAN</span>';
					break;
				case 2:
					$tlsstatus = '<span class="badge bg-red">HILANG / TIDAK DIKEMBALIKAN</span>';
					break;
				default:
					$tlsstatus = '<span class="badge bg-aqua">AKTIF</span>';
			}
			$getgambar 	= Perpumini::where('id', $hasil->kodebuku)->first();
			$gambar 	= '';
			$judul 		= '';
			$link 		= '';
			$kodebuku 	= '';
			$rakbuku 	= '';

			if ($getgambar) {
				$gambar 	= ($getgambar->gambar) ? '<img src="'.$homebase.'/images/perpus/'.$getgambar->gambar.'" height="35">' : '<img src="'.$homebase.'/logo.png" height="35">';
				$judul 		= $getgambar->judul;
				$link 		= $getgambar->link;
				$kodebuku 	= $getgambar->kodebuku;
				$rakbuku 	= $getgambar->rakbuku;
			}

			$foto 		= '';
			$getfoto 	= Datainduk::where('noinduk', $hasil->noinduk)->first();

			if ($getfoto && $getfoto->foto) {
				$foto 	= '<img src="'.$homebase.'/dist/img/foto/'.$getfoto->foto.'" height="35">';
			} else {
				$foto 	= '<img src="'.$homebase.'/logo.png" height="35">';
			}

			$arrperpus[] = [
				'idne' 		=> $hasil->id,
				'foto' 		=> $foto,
				'gambar' 	=> $gambar,
				'judul' 	=> $judul,
				'link' 		=> $link,
				'idbuku' 	=> $hasil->kodebuku,
				'kodebuku' 	=> $kodebuku,
				'pengarang' => $hasil->pengarang,
				'kota' 		=> $hasil->kota,
				'penerbit' 	=> $hasil->penerbit,
				'id_sekolah'=> $hasil->id_sekolah,
				'isbn' 		=> $hasil->isbn,
				'tglpinjam' => $hasil->tglpinjam,
				'tglkembali'=> $hasil->tglkembali,
				'rakbuku' 	=> $rakbuku,
				'biaya' 	=> $hasil->biaya,
				'denda' 	=> $hasil->denda,
				'peminjam' 	=> $hasil->peminjam,
				'noinduk' 	=> $hasil->noinduk,
				'kelas' 	=> $hasil->kelas,
				'status' 	=> $hasil->status,
				'inputor' 	=> $hasil->inputor,
				'tlsstatus' => $tlsstatus,
			];
		}
		echo json_encode($arrperpus);
	}
	public function exSavebuku(Request $request) {
		$judul			= $request->set01;
		$pengarang		= $request->set02;
		$penerbit 		= $request->set03;
		$cetakan 		= $request->set04;
		$kota 			= $request->set05;
		$tahun 			= $request->set06;
		$ilustrasi 		= $request->set07;
		$kodebuku 		= $request->set08;
		$rakbuku 		= $request->set09;
		$kategori 		= $request->set10;
		$tanggalmsk 	= $request->set11;
		$halaman 		= $request->set12;
		$isbn 			= $request->set13;
		$jenis 			= $request->set14;
		$kondisi 		= $request->set15;
		$link 			= $request->set16;
		$idne 			= $request->set17;
		$gakboleh 		= '';
		if ($idne == 'new'){
			$kalimat		= 'Buku berjudul '.$judul.' Pengarang '.$pengarang.' Terbitan '.$penerbit.' berhasil di tambahkan';
			$cekjudul		= Perpumini::where('kodebuku', $kodebuku)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($kondisi == 'MUSNAH' OR $kondisi == 'HILANG'){ $gakboleh = 'Buku Baru Tidak Boleh di Set HILANG / MUSNAH'; }
		} else {
			$kalimat		= 'Buku berjudul '.$judul.' Pengarang '.$pengarang.' Terbitan '.$penerbit.' berhasil di update';
			$cekjudul		= Perpumini::where('id', '!=', $idne)->where('kodebuku', $kodebuku)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($kondisi == 'MUSNAH' OR $kondisi == 'HILANG'){ 
				$cekpinjam 	= Peminjaman::where('kodebuku', $idne)->count();
				if ($cekpinjam != 0){
					$gakboleh = 'Buku ini masih dipinjam, selesaikan terlebih dahulu peminjaman buku ini';
				}
			}
		}
		if ($judul == '' OR $pengarang == '' OR $penerbit == '' OR $kota == '' OR $tahun == '' OR $kodebuku == '' OR $rakbuku == '' OR $tanggalmsk == '' OR $isbn == ''){
			$gakboleh = 'Mohon melengkapi semua form, khususnya yang bertanda bintang';
		}
		if ($kategori == 'E-Book' AND $link == ''){
			$gakboleh = 'Untuk Kategori E-Book Mohon melengkapi dengan link asal file / download file';
		}
		if ($gakboleh != ''){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gakboleh]);
			return back();
		} else if ($cekjudul == 0){
			if ($ilustrasi == ''){ $ilustrasi = '14.5 X 21'; }
			if ($halaman == ''){ $halaman = '0'; }
			$arrthnmasuk 	= explode('-', $tanggalmsk);
			$thnmasuk 		= $arrthnmasuk[2];
			if ($idne == 'new'){
				if ($link == ''){
					$input = Perpumini::create([
						'gambar'			=> '',
						'judul'				=> $judul,
						'link'				=> '',
						'kodebuku'			=> $kodebuku,
						'pengarang'			=> $pengarang,
						'cetakan'			=> $cetakan,
						'kota'				=> $kota,
						'penerbit'			=> $penerbit,
						'tahun'				=> $tahun,
						'ilustrasi'			=> $ilustrasi,
						'halaman'			=> $halaman,
						'id_sekolah'		=> session('sekolah_id_sekolah'),
						'isbn'				=> $isbn,
						'tglmasuk'			=> $tanggalmsk,
						'tahunperolehan'	=> $thnmasuk,
						'jenisperolehan'	=> $jenis,
						'rakbuku'			=> $rakbuku,
						'kondisi'			=> $kondisi,
						'kategori'			=> $kategori,
						'inputor'			=> Session('nama')
						
					]);
				} else {
					$input = Perpumini::create([
						'gambar'			=> '',
						'judul'				=> $judul,
						'link'				=> $link,
						'kodebuku'			=> $kodebuku,
						'pengarang'			=> $pengarang,
						'cetakan'			=> $cetakan,
						'kota'				=> $kota,
						'penerbit'			=> $penerbit,
						'tahun'				=> $tahun,
						'ilustrasi'			=> $ilustrasi,
						'halaman'			=> $halaman,
						'id_sekolah'		=> session('sekolah_id_sekolah'),
						'isbn'				=> $isbn,
						'tglmasuk'			=> $tanggalmsk,
						'tahunperolehan'	=> $thnmasuk,
						'jenisperolehan'	=> $jenis,
						'rakbuku'			=> $rakbuku,
						'kondisi'			=> $kondisi,
						'kategori'			=> $kategori,
						'inputor'			=> Session('nama')
					]);
				}
			} else {
				$input = Perpumini::where('id', $idne)->update([
					'judul'				=> $judul,
					'link'				=> $link,
					'kodebuku'			=> $kodebuku,
					'pengarang'			=> $pengarang,
					'cetakan'			=> $cetakan,
					'kota'				=> $kota,
					'penerbit'			=> $penerbit,
					'tahun'				=> $tahun,
					'ilustrasi'			=> $ilustrasi,
					'halaman'			=> $halaman,
					'isbn'				=> $isbn,
					'tglmasuk'			=> $tanggalmsk,
					'tahunperolehan'	=> $thnmasuk,
					'jenisperolehan'	=> $jenis,
					'rakbuku'			=> $rakbuku,
					'kondisi'			=> $kondisi,
					'kategori'			=> $kategori,
					'inputor'			=> Session('nama'),
					'updated_at'		=> date("Y-m-d H:i:s")
				]);
			}
			if ($input){
				if ($request->hasFile('file')) {
					if ($idne != 'new'){
						$getgambar = Perpumini::where('id', $idne)->first();
						if (isset($getgambar->gambar)){
							$gambarlama = $getgambar->gambar;
							if ($gambarlama != ''){
								if (File::exists(base_path() ."/public/images/perpus/". $gambarlama)) {
								File::delete(base_path() ."/public/images/perpus/". $gambarlama);
								}
							}
						}
					}
					$ekstensi		= $request->file('file')->getClientOriginalExtension();
					$namafile 		= $isbn.'.'.$ekstensi;
					$uploadedFile 	= $request->file('file');
					Storage::putFileAs('images/perpus/',$uploadedFile,$namafile);
					Perpumini::where('isbn', $isbn)->update([
						'gambar'	=> $namafile,
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $kalimat]);
				return back();
			} else { 
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data Gagal di Input, Mohon Ulangi Beberapa Saat Lagi.!!']);
				return back();	 
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Kode Buku Sudah Ada, Mohon beri Kode Lain !!']);
			return back();
		}
	}
	public function exPeminjaman(Request $request) {
		$idne		= $request->val01;
		$idbuku		= $request->val02;
		$judul 		= $request->val03;
		$pengarang 	= $request->val04;
		$kodebuku 	= $request->val05;
		$rakbuku 	= $request->val06;
		$noinduk 	= $request->val07;
		$tglpinjam 	= $request->val08;
		$tglkembali = $request->val09;
		$hari 		= $request->val10;
		$biaya 		= $request->val11;
		$status 	= $request->val12;
		$denda 		= $request->val13;
		$gakboleh 	= '';
		$getkelas	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
		if (isset($getkelas->klspos)){
			$kelas 	= $getkelas->klspos;
			$nama 	= $getkelas->nama;
		} else { $gakboleh = 'Data Siswa Tidak Ditemukan';}
		
		if ($idne == 'new'){
			$kalimat		= 'Peminjaman Buku berjudul '.$judul.' Pengarang '.$pengarang.' Kode '.$kodebuku.' berhasil di simpan';
		} else {
			$kalimat		= 'Peminjaman Buku berjudul '.$judul.' Pengarang '.$pengarang.' Kode '.$kodebuku.' berhasil di update';
		}
		$cekpinjam 	= Peminjaman::where('kodebuku', $idbuku)->where('status', '1')->count();
		if ($cekpinjam != 0 AND $status == '1'){
			$gakboleh = 'Buku ini masih dipinjam, selesaikan terlebih dahulu peminjaman buku ini';
		}

		if ($noinduk == '' OR $tglpinjam == '' OR $tglkembali == ''){
			$gakboleh = 'Mohon melengkapi semua form, khususnya yang bertanda bintang';
		}
		if ($gakboleh != ''){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gakboleh]);
			return back();
		} else {
			$getgambar	= Perpumini::where('id', $idbuku)->first();
			if (isset($getgambar->kodebuku)){
				$kota 		= $getgambar->kota;
				$penerbit 	= $getgambar->penerbit;
				$isbn 		= $getgambar->isbn;
			} else { $kota = ''; $penerbit = ''; $isbn = '';  }
			$biaya 	= (int)str_replace(',','',$biaya);
			$denda 	= (int)str_replace(',','',$denda);
			
			if ($idne == 'new'){
				$input = Peminjaman::create([
					'kodebuku'	=> $idbuku,
					'judul'		=> $judul,
					'pengarang'	=> $pengarang,
					'kota'		=> $kota,
					'penerbit'	=> $penerbit,
					'isbn'		=> $isbn,
					'tglpinjam'	=> $tglpinjam,
					'tglkembali'=> $tglkembali,
					'biaya'		=> $biaya,
					'denda'		=> $denda,
					'peminjam'	=> $nama,
					'noinduk'	=> $noinduk,
					'kelas'		=> $kelas,
					'inputor'	=> Session('nama'),
					'status'	=> $status,
					'id_sekolah'=> session('sekolah_id_sekolah'),
				]);
			} else {
				$input = Peminjaman::where('id', $idne)->update([
					'kodebuku'	=> $idbuku,
					'judul'		=> $judul,
					'pengarang'	=> $pengarang,
					'kota'		=> $kota,
					'penerbit'	=> $penerbit,
					'isbn'		=> $isbn,
					'tglpinjam'	=> $tglpinjam,
					'tglkembali'=> $tglkembali,
					'biaya'		=> $biaya,
					'denda'		=> $denda,
					'peminjam'	=> $nama,
					'noinduk'	=> $noinduk,
					'kelas'		=> $kelas,
					'inputor'	=> Session('nama'),
					'status'	=> $status,
					'id_sekolah'=> session('sekolah_id_sekolah'),
				]);
			}
			if ($input){
				if ($status == 2){
					Perpumini::where('id', $idbuku)->update([
						'kondisi'			=> 'HILANG',
						'inputor'			=> $nama,
						'updated_at'		=> date("Y-m-d H:i:s")
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $kalimat]);
				return back();
			} else { 
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data Gagal di Input, Mohon Ulangi Beberapa Saat Lagi.!!']);
				return back();	 
			}
		} 
	}
	public function exDestroyer(Request $request) {
		$idne		= $request->val01;
		$tabel		= $request->val02;
		$inputor	= Session('nama');
		$busek 		= null;
		if ($tabel == 'perpusmini'){
			$getdatalama= Perpumini::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$busek 		= Perpumini::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
			$kalimat 	= 'Data Perpustakaan Mini Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data Perpustakaan Judul Buku '.$getdatalama->judul;
		}
		if ($tabel == 'datanilai'){
			$valcari 	= '';
			$kalimat 	= 'Data Nilai Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data Nilai '.$valcari;
			$getdata 	= Loginputnilai::where('id', $idne)->first();
			if (isset($getdata->id)){
				if ($getdata->jennilai == 'Presensi Kelas'){
					$jumlah 	= Datapresensi::where('petugas', $getdata->niy)->where('tanggal', $getdata->tanggal)->where('kelas', $getdata->kelas)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
					$valcari 	= $getdata->matpel.' ( '.$getdata->jennilai.' '.$getdata->tapel.' ) Tanggal '.$getdata->tanggal.' Sejumlah '.$jumlah.' Data';
					Datapresensi::where('petugas', $getdata->niy)->where('tanggal', $getdata->tanggal)->where('kelas', $getdata->kelas)->where('id_sekolah', session('sekolah_id_sekolah'))->delete();	
					$kalimat 	= 'Data Presensi Berhasil di Hapus';
				} else {
					$jumlah 	= Datanilai::where('marking', 'LIKE', $getdata->marking.'%')->where('id_sekolah', session('sekolah_id_sekolah'))->count();
					$valcari 	= $getdata->matpel.' ( '.$getdata->jennilai.' '.$getdata->tapel.' ) Tanggal '.$getdata->tanggal.' Sejumlah '.$jumlah.' Data';
					Datanilai::where('marking', 'LIKE', $idne.'%')->where('id_sekolah', session('sekolah_id_sekolah'))->delete();
					$deskripsi 	= 'Menghapus data Nilai '.$valcari;
				}
				Logstaff::create([
					'jenis'		=> 'Perubahan '.$getdata->jennilai,
					'sopo'		=> Session('nip'), 
					'kelakuan'	=> 'Menghapus '.$valcari,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
			}
			$busek 		= Loginputnilai::where('id', $idne)->delete();
		}
		if ($tabel == 'db_tema'){
			$getdatalama= Datatema::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$busek 		= Datatema::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
			$kalimat 	= 'Data Tema Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data Tema '.$getdatalama->tema;
		}
		if ($tabel == 'db_kkm'){
			$getdatalama= Datakkm::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$busek 		= Datakkm::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
			$kalimat 	= 'Data Mata Pelajaran dan KKM Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data Mata Pelajaran dan KKM '.$getdatalama->matpel.' Kelas '.$getdatalama->kelas;
		}
		if ($tabel == 'db_programpip'){
			$getdatalama= ProgramPIP::where('id', $idne)->first();
			$busek 		= ProgramPIP::where('id', $idne)->delete();
			$kalimat 	= 'Data Program PIP Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data Program PIP an '.$getdatalama->nama.' Kelas Lama '.$getdatalama->kelaslama.' Tahun '.$getdatalama->tahap;
		}
		if ($tabel == 'db_kd'){
			$getdatalama= Datakd::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$busek 		= Datakd::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
			$kalimat 	= 'Data KD Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data KD '.$getdatalama->kodekd.' Matpel '.$getdatalama->muatan;
		}
		if ($tabel == 'pengumuman'){
			$getdatalama= Pengumuman::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$busek 		= Pengumuman::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
			$kalimat 	= 'Data Pengumuman Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data Pengumuman Tgl. '.$getdatalama->tanggal;
		}
		if ($tabel == 'ijinortu'){
			$getdatalama= Datapresensi::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$busek 		= Datapresensi::where('id', $idne)->where('id_sekolah',session('sekolah_id_sekolah'))->delete();
			$kalimat 	= 'Data Presensi Berhasil di Hapus';
			$deskripsi 	= 'Menghapus data Presensi Tgl. '.$getdatalama->tanggal.' No.Induk : '.$getdatalama->noinduk;
		}
		if ($tabel == 'ekstrakulikuler'){
			$noinduk = $request->val03;
			if ($idne == '5'){
				$busek = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'eksul5'	=> '',
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
			} elseif ($idne == '4'){
				$busek = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'eksul4'	=> '',
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
			}
			elseif ($idne == '3'){
				$busek = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'eksul3'	=> '',
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
			}
			elseif ($idne == '2'){
				$busek = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'eksul2'	=> '',
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
			} else {
				$busek = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'eksul1'	=> 'Pramuka',
					'id_sekolah' => session('sekolah_id_sekolah')
				]);
			}
			$kalimat 	= 'Data Ekstrakulikuler Berhasil di Batalkan';
		}
		if ($tabel == 'presensifinger'){
			$tanggalscan= $request->val03;
			$getdatalama= DB::table('db_presensifinger')->where('pin', $idne)->where('tanggalscan', $tanggalscan)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			$busek		= DB::table('db_presensifinger')->where('pin', $idne)->where('tanggalscan', $tanggalscan)->where('id_sekolah', session('sekolah_id_sekolah'))->delete();
			$deskripsi 	= Session('nama').' Menghapus data Presensi Finger '.$getdatalama->nama.' Scan Finger '.$getdatalama->tanggalscan.' pada '.date('Y-m-d H:i:s');
			$kalimat 	= $deskripsi;
		}
		if ($busek){
			if ($tabel == 'perpusmini' OR $tabel == 'db_programpip' OR $tabel == 'presensifinger'){
				Logstaff::create([
					'jenis'		=> $tabel, 
					'sopo'		=> Session('nip'),
					'kelakuan'	=> $kalimat,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $kalimat]);
			return back();
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Data Gagal di Hapus, Mohon Ulangi Beberapa Saat Lagi.!!']);
			return back();
		}
	}
	public function exPengumuman(Request $request) {
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain		= $cekteks[0];
		}
		$getdomainid 	= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$subsubdomainapps01			= $getdomainid->subsubdomainapps;
		} else {
			$subsubdomainapps01			= config('global.sekolah');
		}
		$siapa			= $request->val01;
		$pengumuman		= $request->val02;
		if($request->hasFile('file')) {
			$ImageExt	= $request->file('file')->getClientOriginalExtension();
			$file_tmp	= $request->file('file');
			$data 		= file_get_contents($file_tmp);
			$gambar 	= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
		} else {
			$gambar     = '';
		}
		if ($siapa == '' OR is_null($siapa)){ $siapa = Session('nama'); }
		if (session('sekolah_id_sekolah') !== null){ 
		    $id_sekolah = Session('sekolah_id_sekolah');
		} else {
		    $id_sekolah = '';
		}
		if (session('sekolah_nama_sekolah') !== null){ 
		    $fakultas = Session('sekolah_nama_sekolah');
		} else if (session('subdomainapps01') !== null){ 
		    $fakultas = Session('subsubdomainapps01');
		} else {
		    $fakultas = $subsubdomainapps01;
		}
		if (session('id') !== null){ 
		    $nim = Session('id');
		} else {
		    $nim = Session('iduser');
		}
		$input 			= Pengumuman::create([
			'jenis'			=> Session('previlage'), 
			'siapa'			=> $siapa,
			'nim'			=> $nim,
			'pengumuman'	=> $pengumuman,
			'tanggal'		=> date('d - m - Y'),
			'kapan'			=> date('Y-m-d h:i:s'),
			'id_sekolah' 	=> $id_sekolah,
			'fakultas'		=> $fakultas,
			'gambar'		=> $gambar
		]);
		if ($input){	
			SendMail::mobilenotif('1', 'all', 'Pengumuman', $pengumuman);		
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Pengumuman Berhasil di Tambahkan']);
			return back();
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Ulangi Beberapa Saat Lagi.!!']);
			return back();
		}
	}
	public function exSavesetting(Request $request) {
		$update 	= Sekolah::where('id', session('sekolah_id_sekolah'))->update([
			'nama_yayasan' 		=> $request->edit_nama_yayasan, 
			'nis' 				=> $request->edit_nis, 
			'nss' 				=> $request->edit_nss, 
			'npsn' 				=> $request->edit_npsn, 
			'kode_sekolah' 		=> $request->edit_kode_sekolah, 
			'nama_sekolah' 		=> $request->edit_nama_sekolah, 
			'alamat' 			=> $request->edit_alamat, 
			'kota' 				=> $request->edit_kota, 
			'telp' 				=> $request->edit_telp, 
			'email' 			=> $request->edit_email, 
			'id_kepala_sekolah' => $request->edit_id_kepala_sekolah, 
			'slogan' 			=> $request->edit_slogan, 
			'level' 			=> $request->edit_level, 
			'status' 			=> $request->edit_status,
			'pendaftaran' 		=> $request->edit_pendaftaran,
			'pengumuman' 		=> $request->edit_pengumuman,
			'no_rek' 			=> $request->edit_no_rek,
			'nama_rek' 			=> $request->edit_nama_rek,
			'nama_bank_rek' 	=> $request->edit_nama_bank_rek,
		]);
		$gagal 		= '';
		$sukses 	= '';
		$homebase	= url("/");
		$domain		= str_replace('http://', '', $homebase);
		$domain		= str_replace('https://', '', $domain);
		$domain		= str_replace('/', '', $domain);
		$domain		= str_replace('#', '', $domain);
		$domain		= str_replace('-', '', $domain);
		$domain		= str_replace('.', '', $domain);
		$fileserti 	= $domain.'.crt';
		if (file_exists(public_path('tte/'.$fileserti))){
			$certificate 	= 'file://'.base_path().'/public/tte/'.$fileserti;
		} else {
			try {
				$dn = array(
					"countryName" 			=> "IN",
					"stateOrProvinceName" 	=> $request->edit_kota,
					"localityName" 			=> config('global.Title2'),
					"organizationName" 		=> $request->edit_nama_yayasan,
					"organizationalUnitName"=> $request->edit_kode_sekolah,
					"commonName" 			=> $request->edit_nama_sekolah,
					"emailAddress" 			=> $request->edit_email
				);
				$privkey = openssl_pkey_new(array(
					"private_key_bits" => 2048,
					"private_key_type" => OPENSSL_KEYTYPE_RSA,
				));
				$csr = openssl_csr_new($dn, $privkey, array('digest_alg' => 'RSA-SHA256'));
				$sscert = openssl_csr_sign($csr, null, $privkey, 365);
				openssl_csr_export($csr, $csrout);
				openssl_x509_export($sscert, $certout);
				openssl_pkey_export($privkey, $pkeyout);
				Storage::disk('local')->put('/tte/'.$domain.'.crt', $pkeyout);
				file_put_contents(public_path()."/tte/".$domain.".crt", $certout, FILE_APPEND | LOCK_EX);
			} catch (\Exception $e) {
				$sendstatus = $e->getMessage();
				$gagal 		= $gagal.$sendstatus;
			}
		}
		if ($request->hasFile('edit_logo')) {
			$ekstensi		= $request->file('edit_logo')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				$gagal 		= $gagal.'Gagal Upload Logo, File Logo wajib berekstensi png (huruf kecil) <br />';
			} else {
				$namafile		= session('sekolah_id_sekolah').'-'.time().'logo.'.$request->file('edit_logo')->getClientOriginalExtension();
				$uploadedFile 	= $request->file('edit_logo');
				Storage::putFileAs('logo',$uploadedFile,$namafile);
				$update 		= Sekolah::where('id', session('sekolah_id_sekolah'))->update([
					'logo' => 'logo/'.$namafile
				]);
			}
		}
		if ($request->hasFile('edit_logo_grey')) {
			$ekstensi		= $request->file('edit_logo_grey')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				$gagal 		= $gagal.'Gagal Upload Background, File Background wajib berekstensi png (huruf kecil) <br />';
			} else {
				$background 	= session('sekolah_id_sekolah').'-'.time().'logo-gray.png';
				$uploadedFile 	= $request->file('edit_logo_grey');
				Storage::putFileAs('logo',$uploadedFile,$background);
				$update 		= Sekolah::where('id', session('sekolah_id_sekolah'))->update([
					'logo_grey' => 'logo/'.$background
				]);
			}
		}
		if ($request->hasFile('edit_frontpage')) {
			$ekstensi		= $request->file('edit_frontpage')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				$gagal 		= $gagal.'Gagal Upload Front Logo, File Front Logo wajib berekstensi png (huruf kecil) <br />';
			} else {
				$frontlogo 		= session('sekolah_id_sekolah').'-'.time().'logofront.png';
				$uploadedFile 	= $request->file('edit_frontpage');
				Storage::putFileAs('logo',$uploadedFile,$frontlogo);
				$update 		= Sekolah::where('id', session('sekolah_id_sekolah'))->update([
					'frontpage' => 'logo/'.$frontlogo 
				]);
			}
		}
		if ($request->hasFile('edit_kopsurat')) {
			$ekstensi		= $request->file('edit_kopsurat')->getClientOriginalExtension();
			if ($ekstensi != 'png') {
				$gagal 		= $gagal.'Gagal Upload Kop Surat, File Kop Surat wajib berekstensi png (huruf kecil) <br />';
			} else {
				$kopsurat 		= session('sekolah_id_sekolah').'-'.time().'kopsurat.png';
				$uploadedFile 	= $request->file('edit_kopsurat');
				Storage::putFileAs('logo',$uploadedFile,$kopsurat);
				$update 		= Sekolah::where('id', session('sekolah_id_sekolah'))->update([
					'kopsurat' => 'logo/'.$kopsurat 
				]);
			}
		}
		if ($gagal == ''){			
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Berhasil diubah']);
			return back();
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
			return back();
		}
	}
	public function exOnofflayanan(Request $request) {
		$layanan	= $request->val01;
		if ($layanan == 'ekstrakulikuler'){
			$rstatus		= Layanan::where('layanan', 'daftarekskul')->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rstatus->status)){
				$status 	= $rstatus->status;
				if ($status == ''){
					$update = Layanan::where('layanan', 'daftarekskul')->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'status' 	=> 'mati',
						'id_sekolah'=>session('sekolah_id_sekolah')
					]);
				} else {
					$update = Layanan::where('layanan', 'daftarekskul')->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'status' 	=> '',
						'id_sekolah'=>session('sekolah_id_sekolah')
					]);
				}
			} else { 
				$update = Layanan::create([
					'layanan' 	=> 'daftarekskul',
					'status' 	=> 'mati',
					'id_sekolah'=>session('sekolah_id_sekolah')
				]);
			}
		}
		if ($layanan == 'zis'){
			$rstatuszis		= Layanan::where('layanan', 'pembayaranzis')->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rstatuszis->status)){
				$status 	= $rstatuszis->status;
				if ($status == ''){
					$update = Layanan::where('layanan', 'pembayaranzis')->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'status' 	=> 'mati',
						'id_sekolah'=>session('sekolah_id_sekolah')
					]);
				} else {
					$update = Layanan::where('layanan', 'pembayaranzis')->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'status' 	=> '',
						'id_sekolah'=>session('sekolah_id_sekolah')
					]);
				}
			} else { 
				$update = Layanan::create([
					'layanan' 	=> 'pembayaranzis',
					'status' 	=> 'mati',
					'id_sekolah'=>session('sekolah_id_sekolah')
				]);
			}
		}
		if ($update){			
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Setting Berhasil di Update']);
			return back();
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Tidak ada yang diupdate']);
			return back();
		}
	}
	public function exProfilesekolah(Request $request) {
		$layanan	= $request->val01;
		$isi		= $request->val02;
		if ($isi != ''){
			$cekstatus		= Layanan::where('layanan', $layanan)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
			if ($cekstatus == 0){
				$update = Layanan::create([
					'layanan' 	=> $layanan,
					'status' 	=> $isi,
					'id_sekolah'=>session('sekolah_id_sekolah')
				]);
			} else { 
				$update = Layanan::where('layanan', $layanan)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
					'status' 	=> $isi
				]);
			}
		}
		if ($update){			
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $layanan.' Berhasil di Update']);
			return back();
		}else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Isi Tidak Boleh Kosong']);
			return back();
		}
	}
	public function getallkendaraan() {
		$arraykendaraan = [];
    	$jruang 		= Kendaraan::where('fakultas', Session('sekolah_id_sekolah'))->orderBy('garasi', 'asc')->orderBy('merek', 'asc')->get();
    	foreach ($jruang as $result) {
			$kapasitas 	= $result->kapasitas;
			$marking 	= $result->marking;
			$pjgedung 	= $result->pjgedung;
			$pejabat	= $pjgedung;
			if ($kapasitas == 0){ $kapasitas = '';}
			if ($marking == 'OK'){
				$arraykendaraan[] = array(
					'dot' 			=> $result->id,
					'merek' 		=> $result->merek,
					'garasi' 		=> $result->garasi,
					'kodegarasi' 	=> $result->kodegarasi,
					'kodekendaraan' => $result->kodekendaraan,
					'driver' 		=> $result->driver,
					'marking' 		=> $result->marking,
					'nopol' 		=> $result->nopol,
					'kondisi' 		=> $result->kondisi,
					'utilitas' 		=> $result->utilitas,
					'kapasitas' 	=> $kapasitas,
					'statpinjam' 	=> $result->statpinjam,
					'tarif' 		=> $result->tarif,
					'fakpanjang' 	=> $result->fakpanjang,
					'fakultas' 		=> $result->fakultas,
					'inputor' 		=> $result->inputor,
					'pjgedung' 		=> $pjgedung,
					'pejabat' 		=> $pejabat,
					'foto' 			=> $result->foto,
				);
			}else {
				$arraykendaraan[] = array(
					'dot' 			=> $result->id,
					'merek' 		=> $result->merek,
					'namagd' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'kodegd' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'koderg' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'petugas' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'marking' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'luas' 			=> '<span class="badge badge-danger">INACTIVE</span>',
					'kondisi' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'utilitas' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'kapasitas' 	=> '<span class="badge badge-danger">INACTIVE</span>',
					'statpinjam' 	=> '<span class="badge badge-danger">INACTIVE</span>',
					'tarif' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'fakpanjang' 	=> '<span class="badge badge-danger">INACTIVE</span>',
					'fakultas' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'inputor' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'pjgedung' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'pejabat' 		=> '<span class="badge badge-danger">INACTIVE</span>',
					'foto' 			=> '',
				);
			}
    	}
    	echo json_encode($arraykendaraan);	
    }
	public function getallgarasi() {
		$jruang 	= Garasi::where('fakultas', Session('sekolah_id_sekolah'))->orderBy('namagd', 'asc')->get();
    	echo json_encode($jruang);	
	}
	public function getAktifitaskendaraan(Request $request) {
		$arrayjadwal 	= array();
		$jenis       	= $request->val01;
		$bulan       	= $request->val02;
		$tahun       	= $request->val03;
		$fakultas		= Session('sekolah_id_sekolah');	
		if ($jenis == 'BBM'){
			if ($bulan == 'INI'){
				$tahun 		= date("Y");
				$jadwals   	= Kendaraanactivity::where('jenis', 'BBM')->where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else if ($bulan == 'ALL'){
				$jadwals   	= Kendaraanactivity::where('jenis', 'BBM')->where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else {
				$valcar 	= $tahun.'-'.$bulan;
				$jadwals   	= Kendaraanactivity::where('jenis', 'BBM')->where('fakultas', $fakultas)->where('tanggal', 'LIKE', $valcari.'%')->get();
			}
		} else if ($jenis == 'SERVICE'){
			if ($bulan == 'INI'){
				$tahun 		= date("Y");
				$jadwals   	= Kendaraanactivity::where('jenis', 'SERVICE')->where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else if ($bulan == 'ALL'){
				$jadwals   	= Kendaraanactivity::where('jenis', 'SERVICE')->where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else {
				$valcar 	= $tahun.'-'.$bulan;
				$jadwals   	= Kendaraanactivity::where('jenis', 'SERVICE')->where('fakultas', $fakultas)->where('tanggal', 'LIKE', $valcari.'%')->get();
			}
		} else if ($jenis == 'TOL'){
			if ($bulan == 'INI'){
				$tahun 		= date("Y");
				$jadwals   	= Kendaraanactivity::where('jenis', 'TOL')->where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else if ($bulan == 'ALL'){
				$jadwals   	= Kendaraanactivity::where('jenis', 'TOL')->where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else {
				$valcar 	= $tahun.'-'.$bulan;
				$jadwals   	= Kendaraanactivity::where('jenis', 'TOL')->where('fakultas', $fakultas)->where('tanggal', 'LIKE', $valcari.'%')->get();
			}
		} else {
			if ($bulan == 'INI'){
				$tahun 		= date("Y");
				$jadwals   	= Kendaraanactivity::where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else if ($bulan == 'ALL'){
				$jadwals   	= Kendaraanactivity::where('fakultas', $fakultas)->whereYear('tanggal', $tahun)->get();
			} else {
				$valcari 	= $tahun.'-'.$bulan;
				$jadwals   	= Kendaraanactivity::where('fakultas', $fakultas)->where('tanggal', 'LIKE', $valcari.'%')->get();
			}
		}
		if (!empty($jadwals)){
			foreach ($jadwals as $rjadwal) {
				$arrayjadwal[] = array(
					'idne'			=> $rjadwal->id,
					'idkendaraan'   => $rjadwal->idkendaraan,
					'merek'  		=> $rjadwal->merek,
					'garasi'  		=> $rjadwal->garasi,
					'driver'    	=> $rjadwal->driver,
					'nopol'			=> $rjadwal->nopol,
					'keterangan'	=> addslashes($rjadwal->keterangan),
					'jenis' 		=> $rjadwal->jenis,
					'tanggal' 		=> $rjadwal->tanggal,
					'nominal' 		=> $rjadwal->nominal,
					'inputor' 		=> $rjadwal->inputor,
					'fakultas' 		=> $rjadwal->fakultas,
				);
			}
		}
        echo json_encode($arrayjadwal);
    }
	public function exKendaraan(Request $request) {
		$namarg		= $request->input('set01');
		$koderg		= $request->input('set02');
		$luas		= $request->input('set03');
		$kapas		= $request->input('set04');
		$namagd		= $request->input('set05');
		$petugas	= $request->input('set06');
		$marking	= $request->input('set07');
		$idne		= $request->input('set08');
		$kondisi	= $request->input('set09');
		$utitilitas	= $request->input('set10');
		$pjgedung 	= $request->input('set11');
		$statpinjam = $request->input('set12');
		$tarif 		= $request->input('set13');
		$fakultas	= Session('sekolah_id_sekolah');
		$fakpanjang	= Session('sekolah_nama_sekolah');
		$sinten     = Session('nama');
		if ($namarg == 'hapus') {
			$getdata 	= Kendaraan::where('id', $idne)->first();
			$nama		= $getdata->merek;
			$kode 		= $getdata->kodekendaraan;
			$fakultas	= $getdata->fakultas;
			$kelakuan 	= Session('nama').' Menghapus data ruang '.$nama.' Kode Ruang : '.$kode.' Unit : '.$fakultas;
			Logstaff::create([
				'jenis'			=> 'Data Ruang', 
				'sopo'			=> Session('nip'), 
				'kelakuan'		=> $kelakuan,
				'id_sekolah' 	=> session('sekolah_id_sekolah')
			]);
			$user     	=   Kendaraan::find($idne);
			$user->delete();
			return response()->json(['status' => 'Sukses', 'message' => 'Marking Data Hapus, Sukses di Lakukan']);
			return back();
		}
		else if ($namarg == 'hapusgarasi') {
			$getdata 	= Garasi::where('id', $idne)->first();
			$namagd		= $getdata->namagd;
			$kodegd		= $getdata->kodegd;
			$fakultas	= $getdata->fakultas;
			$cekfas 	= Kendaraan::where('kodegarasi', $kodegd)->count();
			if ($cekfas == 0){				
				$kelakuan 	= Session('nama').' Menghapus data Garasi '.$namagd.' Kode : '.$kodegd.' Unit : '.$fakultas;
				Logstaff::create([
					'jenis'			=> 'Data Garasi', 
					'sopo'			=> Session('nip'), 
					'kelakuan'		=> $kelakuan,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
				Garasi::where('id', $idne)->delete();
				return response()->json(['status' => 'Sukses', 'message' => 'data garasi '.$namagd.' Kode : '.$kodegd.' Unit : '.$fakultas.' berhasil di hapus']);
				return back();
			} else {
				return response()->json(['status' => 'Gagal', 'message' => 'Dalam Gedung ini masih ada ruang yang belum di hapus']);
				return back();
			}
		}
		else if ($namarg == 'gedung') {
			if ($koderg != ''){
				if ($idne == 'new'){
					$cekwes1 = Garasi::where('namagd', $namarg)->count();
					$cekwes2 = Garasi::where('kodegd', $koderg)->count();
					if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Garasi Terdeteksi Double. Mohon Ubah Nama Gedung Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Garasi Terdeteksi Double. Mohon Ubah Kode Gedung Anda']);
						return back();
					} else{
						Garasi::insert([
							'namagd'  	=>  $koderg,
							'singgd'   	=>  $luas,
							'kodegd'	=>  $luas,
							'fakpanjang'=>  $fakpanjang,
							'fakultas'	=>  $fakultas,
							'inputor'	=>  Session('nama'),
						]);
						return response()->json(['status' => 'Sukses', 'message' => 'Data Garasi '.$koderg.' Berhasil di Simpan']);
						return back();
					}
				} else {
					$cekwes1 = Garasi::where('namagd', $namarg)->where('id', '!=', $idne)->count();
					$cekwes2 = Garasi::where('kodegd', $koderg)->where('id', '!=', $idne)->count();
					if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Garasi Terdeteksi Double. Mohon Ubah Nama Gedung Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Garasi Terdeteksi Double. Mohon Ubah Kode Gedung Anda']);
						return back();
					} else{
						Garasi::where('id', $idne)->update([
							'namagd'  	=>  $koderg,
							'singgd'   	=>  $luas,
							'kodegd'	=>  $luas,
							'fakpanjang'=>  $fakpanjang,
							'fakultas'	=>  $fakultas,
							'inputor'	=>  Session('nama'),
						]);
						return response()->json(['status' => 'Sukses', 'message' => 'Data Garasi '.$koderg.' Berhasil di Simpan']);
						return back();
					}
				}
			}else {
				return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Data Garasi Anda..!!']);
				return back();
			}
		}
		else if ($namarg == 'aktifitaskendaraan') {
			$nama		= $request->input('set02');
			$garasi		= $request->input('set03');
			$nopol		= $request->input('set04');
			$jenis		= $request->input('set05');
			$nominal	= $request->input('set06');
			$driver		= $request->input('set07');
			$keterangan	= $request->input('set08');
			$idkendaraan= $request->input('set09');
			$idne		= $request->input('set10');
			$tanggal	= $request->input('set11');
			
			if ($keterangan == ''){ $keterangan = '-'; }
			if ($jenis != '' AND $nominal != '' AND $driver != '' AND $tanggal != ''){
				$nominal 		= str_replace(',','',$nominal);
				if ($idne == 'new'){
					$input = Kendaraanactivity::create([
						'idkendaraan'	=> $idkendaraan,
						'merek'			=> $nama,
						'garasi'		=> $garasi,
						'driver'		=> $driver,
						'nopol'			=> $nopol,
						'jenis'			=> $jenis,
						'tanggal'		=> $tanggal,
						'nominal'		=> $nominal,
						'keterangan'	=> $keterangan,
						'inputor'		=> Session('nama'),
						'fakultas'		=> $fakultas
					]);
					if ($input){
						return response()->json(['status' => 'Sukses', 'message' => 'Data '.$jenis.' Tanggal '.$tanggal.' Sejumlah '.$nominal.' Berhasil di Simpan']);
						return back();
					} else {
						return response()->json(['status' => 'Gagal', 'message' => 'Data gagal di masukkan']);
						return back();
					}
					
				} else {
					$input = Kendaraanactivity::where('id', $idne)->update([
						'idkendaraan'	=> $idkendaraan,
						'merek'			=> $nama,
						'garasi'		=> $garasi,
						'driver'		=> $driver,
						'nopol'			=> $nopol,
						'jenis'			=> $jenis,
						'tanggal'		=> $tanggal,
						'nominal'		=> $nominal,
						'keterangan'	=> $keterangan,
						'inputor'		=> Session('nama'),
						'fakultas'		=> $fakultas
					]);
					if ($input){
						return response()->json(['status' => 'Sukses', 'message' => 'Data '.$jenis.' Tanggal '.$tanggal.' Sejumlah '.$nominal.' Berhasil di Update']);
						return back();
					} else {
						return response()->json(['status' => 'Gagal', 'message' => 'Data gagal di masukkan']);
						return back();
					}
				}
			}else {
				return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Data Anda..!!']);
				return back();
			}
			
		}
		else {
			if ($idne == 'new'){
				if ($namarg != '' and $koderg != '' and $namagd != '' ){
					$cekwes1 = Kendaraan::where('merek', $namarg)->count();
					$cekwes2 = Kendaraan::where('kodekendaraan', $koderg)->count();
					if ($statpinjam == 'Di Sewa/Pinjamkan untuk kalangan internal' OR $statpinjam == 'Di Sewa/Pinjamkan untuk umum'){
						$wajibada = 1;
					} else {
						$wajibada = 0;
					}
					if ($wajibada == 1 AND $pjgedung == '0'){
						return response()->json(['status' => 'Gagal', 'message' => 'Penanggung Jawab Ruang Wajib di Isi']);
						return back();
					} else if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Kendaraan Terdeteksi Double. Mohon Ubah Nama Ruang Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Kendaraan Terdeteksi Double. Mohon Ubah Kode Ruang Anda']);
						return back();
					} else{
						$jglkgedung	= Garasi::where('namagd', $namagd)->first();
						$gdnama		= $jglkgedung->namagd;
						$gdkode		= $jglkgedung->kodegd;
						$input 		= Kendaraan::insertGetId([
							'merek'  		=>  $namarg,
							'garasi'   		=>  $gdnama,
							'kodegarasi'	=>  $gdkode,
							'kodekendaraan'	=>  $koderg,
							'driver'		=>  $petugas,
							'marking'		=>  'OK',
							'nopol'			=>  $luas,
							'kapasitas'		=>  $kapas,
							'kondisi'		=>  $kondisi,
							'utilitas'		=>  $utitilitas,
							'pjgedung'		=>  $pjgedung,
							'statpinjam'	=>  $statpinjam,
							'tarif'			=>  $tarif,
							'fakpanjang'	=>  $fakpanjang,
							'fakultas'		=>  $fakultas,
							'inputor'		=>  Session('nama'),
						]);
						if ($input){
							if ($request->hasFile('file')) {
								$namafile 		= $fakultas.'-KND-'.$input;
								$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('images/kendaraan/',$uploadedFile,$namafile);
								Kendaraan::where('id', $input)->update([
									'foto'  	=>  $namafile,
								]);
							}
							return response()->json(['status' => 'Sukses', 'message' => 'Data Kendaraan '.$namarg.' Berhasil di Tambahkan']);
							return back();
						} else {
							return response()->json(['status' => 'Gagal', 'message' => 'Tidak ada yang diubah']);
							return back();
						}
					}
				}else {
					return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Anda..!!']);
					return back();
				}
			}else{
				if ($namarg != '' and $koderg != '' and $namagd != '' ){
					$cekwes1 = Kendaraan::where('merek', $namarg)->where('id', '!=', $idne)->count();
					$cekwes2 = Kendaraan::where('kodekendaraan', $koderg)->where('id', '!=', $idne)->count();
					if ($statpinjam == 'Di Sewa/Pinjamkan untuk kalangan internal' OR $statpinjam == 'Di Sewa/Pinjamkan untuk umum'){
						$wajibada = 1;
					} else {
						$wajibada = 0;
					}
					if ($wajibada == 1 AND $pjgedung == '0'){
						return response()->json(['status' => 'Gagal', 'message' => 'Penanggung Jawab Ruang Wajib di Isi']);
						return back();
					} else if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Kendaraan Terdeteksi Double. Mohon Ubah Nama Ruang Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Kendaraan Terdeteksi Double. Mohon Ubah Kode Ruang Anda']);
						return back();
					} else{
						$jglkgedung	= Garasi::where('namagd', $namagd)->first();
						$gdnama		= $jglkgedung->namagd;
						$gdkode		= $jglkgedung->kodegd;
						if ($marking == ''){
							$input 	= Kendaraan::where('id', $idne)->update([
								'merek'  		=>  $namarg,
								'garasi'   		=>  $gdnama,
								'kodegarasi'	=>  $gdkode,
								'kodekendaraan'	=>  $koderg,
								'driver'		=>  $petugas,
								'marking'		=>  '',
								'nopol'			=>  $luas,
								'kapasitas'		=>  $kapas,
								'kondisi'		=>  $kondisi,
								'utilitas'		=>  $utitilitas,
								'pjgedung'		=>  $pjgedung,
								'statpinjam'	=>  $statpinjam,
								'tarif'			=>  $tarif,
								'fakpanjang'	=>  $fakpanjang,
								'fakultas'		=>  $fakultas,
								'inputor'		=>  Session('nama'),
							]);
						}else {
							$input 	= Kendaraan::where('id', $idne)->update([
								'merek'  		=>  $namarg,
								'garasi'   		=>  $gdnama,
								'kodegarasi'	=>  $gdkode,
								'kodekendaraan'	=>  $koderg,
								'driver'		=>  $petugas,
								'marking'		=>  $marking,
								'nopol'			=>  $luas,
								'kapasitas'		=>  $kapas,
								'kondisi'		=>  $kondisi,
								'utilitas'		=>  $utitilitas,
								'pjgedung'		=>  $pjgedung,
								'statpinjam'	=>  $statpinjam,
								'tarif'			=>  $tarif,
								'fakpanjang'	=>  $fakpanjang,
								'fakultas'		=>  $fakultas,
								'inputor'		=>  Session('nama'),
							]);
						}
						if ($input){
							if ($request->hasFile('file')) {
								$cekfoto = Ruang::where('id', $idne)->first();
								if (isset($cekfoto->foto)){
									$fotolama= $cekfoto->foto;
									if (File::exists(base_path() ."/public/images/kendaraan/". $fotolama)) {
									  File::delete(base_path() ."/public/images/kendaraan/". $fotolama);
									}
								}								
								$namafile 		= $fakultas.'-RG-'.$idne;
								$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('images/kendaraan/',$uploadedFile,$namafile);
								Kendaraan::where('id', $idne)->update([
									'foto'  	=>  $namafile,
								]);
							}
							return response()->json(['status' => 'Sukses', 'message' => 'Data Kendaraan '.$namarg.' Berhasil di Update']);
							return back();
						} else {
							return response()->json(['status' => 'Gagal', 'message' => 'Tidak ada yang diubah']);
							return back();
						}
					}
				}else {
					return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Anda..!!']);
					return back();
				}
			}
		}        
	}
	public function getallruang() {
		$arrayruang = [];
		$fakultas	= Session('sekolah_id_sekolah');
		if ($fakultas == '' OR is_null($fakultas)){ $fakultas = Session('fakultas'); }
    	$jruang 	= Ruang::where('fakultas', $fakultas)->orderBy('kodegd', 'asc')->orderBy('namarg', 'asc')->get();
    	foreach ($jruang as $result) {
			$kapasitas 	= $result->kapasitasujian;
			$marking 	= $result->marking;
			$pjgedung 	= $result->pjgedung;
			$pejabat 	= $pjgedung;
			$foto 		= $result->foto;
			if (is_null($foto)){ $foto = '';}
			
			if ($kapasitas == 0){ $kapasitas = '';}
				$arrayruang[] = array(
					'dot' 			=> $result->id,
					'namarg' 		=> $result->namarg,
					'namagd' 		=> $result->namagd,
					'kodegd' 		=> $result->kodegd,
					'koderg' 		=> $result->koderg,
					'petugas' 		=> $result->petugas,
					'marking' 		=> $result->marking,
					'luas' 			=> $result->luas,
					'kondisi' 		=> $result->kondisi,
					'utilitas' 		=> $result->utilitas,
					'kapasitas' 	=> $kapasitas,
					'statpinjam' 	=> $result->pinjam,
					'tarif' 		=> $result->tarif,
					'fakpanjang' 	=> $result->fakpanjang,
					'fakultas' 		=> $result->fakultas,
					'inputor' 		=> $result->inputor,
					'pjgedung' 		=> $pjgedung,
					'pejabat' 		=> $pejabat,
					'foto' 			=> $foto,
				);
    	}
    	echo json_encode($arrayruang);	
    }
    public function getallgedung() {
		$arrayruang = [];
		$fakultas	= Session('sekolah_id_sekolah');
		if ($fakultas == '' OR is_null($fakultas)){ $fakultas = Session('fakultas'); }
    	$jruang 	= Gedung::where('fakultas', $fakultas)->orderBy('namagd', 'asc')->get();
    	foreach ($jruang as $result) {
			$pjgedung 	= $result->pjgedung;
			$foto 		= $result->foto;
			if (is_null($foto)){ $foto = '';}
			$arrayruang[] = array(
				'dot' 			=> $result->id,
				'namagd' 		=> $result->namagd,
				'singgd' 		=> $result->singgd,
				'kodegd' 		=> $result->kodegd,
				'statpinjam' 	=> $result->statpinjam,
				'tarif' 		=> $result->tarif,
				'fakpanjang' 	=> $result->fakpanjang,
				'fakultas' 		=> $result->fakultas,
				'inputor' 		=> $result->inputor,
				'pjgedung' 		=> $pjgedung,
				'pejabat' 		=> $pjgedung,
				'foto' 			=> $foto,
			);
			
    	}
    	echo json_encode($arrayruang);	
    }
	public function getdetailruang(Request $request) {
    	$idruang 	= $request->input('val01');
		$namarg 	= $request->input('val02');
		$jfasruang	= Fasruang::where('idruang', $idruang)->orderBy('jenis', 'asc')->get();
    	$arrayfiles = [];
    	foreach ($jfasruang as $file) {
	    	$arrayfiles[] = array(
				'idne' 			=> $file->id,
				'idruang' 		=> $file->idruang,
				'namarg' 		=> $namarg,		
				'namabrg' 		=> $file->namabrg,
				'jenis' 		=> $file->jenis,
				'merek' 		=> $file->merek,
				'tahunterima' 	=> $file->tahunterima,
				'jumlah' 		=> $file->jumlah,
				'sumberdana' 	=> $file->sumberdana,
				'keterangan' 	=> $file->keterangan,
				'kondisi' 		=> $file->kondisi,
				'kodebarang' 	=> $file->kodebarang,
			);
    	}
    	echo json_encode($arrayfiles);
    }
	public function getrekapdetailruang(Request $request) {
    	$idruang 	= $request->input('val01');
		$namarg 	= $request->input('val02');
		$arrayfiles	= [];
		$jfasruang	= Fasruang::where('idruang', $idruang)->groupBy('jenis')->get();
    	foreach ($jfasruang as $file) {			
			$jenis 		= $file->jenis;
			$getallnama	= Fasruang::where('idruang', $idruang)->where('jenis', $jenis)->groupBy('namabrg')->get();
			foreach($getallnama as $rnama){
				$namabrg 	= $rnama->namabrg;
				$getallstat	= Fasruang::where('idruang', $idruang)->where('jenis', $jenis)->where('namabrg', $namabrg)->groupBy('kondisi')->get();
				foreach($getallstat as $rstat){
					$kondisi 	= $rstat->kondisi;
					$jumlah		= Fasruang::where('kondisi', $kondisi)->where('idruang', $idruang)->where('jenis', $jenis)->where('namabrg', $namabrg)->count();
					$arrayfiles[] = array(
						'namabrg' 		=> $namabrg,
						'jenis' 		=> $jenis,
						'jumlah' 		=> $jumlah,
						'kondisi' 		=> $kondisi,
					);
				}
			}
    	}
    	echo json_encode($arrayfiles);
    }
	public function exfasruang(Request $request) {
		$idne		= $request->input('set01');
		$jenis		= $request->input('set02');
		$jumlah		= $request->input('set03');
		$kondisi	= $request->input('set04');
		$merek		= $request->input('set05');
		$namabrg	= $request->input('set06');
		$idruang	= $request->input('set07');
		$sumber		= $request->input('set08');
		$tahun		= $request->input('set09');
		$ruang		= $request->input('set10');
		$kodebarang	= $request->input('set11');
		$sinten     = Session('nama');
		if ($idruang == 'hapus') {
			$keterangn 	= 'Dihapus Oleh '.$sinten;
			Fasruang::where('id', $idne)->update([
				'kondisi'       =>  'HAPUS',
				'keterangan'    =>  $keterangan
			]);
			return response()->json(['status' => 'Sukses', 'message' => 'Marking Data Hapus, Sukses di Lakukan']);
			return back();
		} else {
			if ($idne == 'new'){
				if ($jumlah != '' and $namabrg != '' and $merek != '' and $tahun != '' AND $kodebarang != ''){
					$keterangan = 'Ditambah Oleh '.$sinten;
					Fasruang::insert([
						'idruang'  		=>  $idruang,
						'namabrg'   	=>  $namabrg,
						'jenis'			=>  $jenis,
						'merek'			=>  $merek,
						'tahunterima'	=>  $tahun,
						'jumlah'		=>  $jumlah,
						'sumberdana'	=>  $sumber,
						'keterangan'	=>  $keterangan,
						'kondisi'		=>  $kondisi,
						'kodebarang'	=>  $kodebarang,
					]);
					return response()->json(['status' => 'Sukses', 'message' => 'Data Fasilitas Ruang '.$namabrg.' Berhasil di Input']);
					return back();
				} else {
					return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Anda..!! Hal yang wajid di isi adalah Nama Barang, Satuan, Merk, Tahun dan Kode Barang']);
					return back();
				}
			}else{
				if ($jumlah != '' and $namabrg != '' and $merek != '' and $tahun != '' AND $kodebarang != ''){
					$keterangan = 'Di Update Oleh '.$sinten;
					Fasruang::where('id', $idne)->update([
						'idruang'  		=>  $idruang,
						'namabrg'   	=>  $namabrg,
						'jenis'			=>  $jenis,
						'merek'			=>  $merek,
						'tahunterima'	=>  $tahun,
						'jumlah'		=>  $jumlah,
						'sumberdana'	=>  $sumber,
						'keterangan'	=>  $keterangan,
						'kondisi'		=>  $kondisi,
						'kodebarang'	=>  $kodebarang,
					]);
					return response()->json(['status' => 'Sukses', 'message' => 'Data Fasilitas Ruang '.$namabrg.' Berhasil di Update']);
					return back();
				}else {
					return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Anda..!! Hal yang wajid di isi adalah Nama Barang, Satuan, Merk, Tahun dan Kode Barang']);
					return back();
				}
			}
		}        
    }
	public function exruang(Request $request) {		
		$namarg		= $request->input('set01');
		$koderg		= $request->input('set02');
		$luas		= $request->input('set03');
		$kapas		= $request->input('set04');
		$namagd		= $request->input('set05');
		$petugas	= $request->input('set06');
		$marking	= $request->input('set07');
		$idne		= $request->input('set08');
		$kondisi	= $request->input('set09');
		$utitilitas	= $request->input('set10');
		$pjgedung 	= $request->input('set11');
		$statpinjam = $request->input('set12');
		$tarif 		= $request->input('set13');
		$fakultas	= Session('sekolah_id_sekolah');
		$fakpanjang	= Session('sekolah_nama_sekolah');
		$sinten     = Session('nama');
		if ($fakultas == '' OR is_null($fakultas)){ $fakultas = Session('fakultas'); }
		if ($fakpanjang == '' OR is_null($fakpanjang)){ $fakpanjang = Session('fakpanjang'); }

		if ($namarg == 'hapus') {			
			$user     	=   Ruang::find($idne);
			$cekfas 	= 	Fasruang::where('idruang', $idne)->count();
			if ($cekfas == 0){
				$getdata 	= Ruang::where('id', $idne)->first();
				$nama		= $getdata->namarg;
				$kode 		= $getdata->koderg;
				$fakultas	= $getdata->fakultas;
				$kelakuan 	= Session('nama').' Menghapus data ruang '.$nama.' Kode Ruang : '.$kode.' Unit : '.$fakultas;
				Logstaff::create([
					'jenis'			=> 'Data Ruang', 
					'sopo'			=> Session('nip'), 
					'kelakuan'		=> $kelakuan,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
				$user->delete();
				return response()->json(['status' => 'Sukses', 'message' => 'data ruang '.$nama.' Kode Ruang : '.$kode.' Unit : '.$fakultas.' berhasil di hapus']);
				return back();
			} else {
				return response()->json(['status' => 'Gagal', 'message' => 'Dalam Ruang ini masih ada inventaris yang belum di hapus']);
				return back();
			}
		}
		else if ($namarg == 'hapusgedung') {
			$getdata 	= Gedung::where('id', $idne)->first();
			$namagd		= $getdata->namagd;
			$kodegd		= $getdata->kodegd;
			$fakultas	= $getdata->fakultas;
			$cekfas 	= Ruang::where('kodegd', $kodegd)->count();
			if ($cekfas == 0){				
				$kelakuan 	= Session('nama').' Menghapus data Gedung '.$namagd.' Kode : '.$kodegd.' Unit : '.$fakultas;
				Logstaff::create([
					'jenis'			=> 'Data Gedung', 
					'sopo'			=> Session('nip'), 
					'kelakuan'		=> $kelakuan,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
				Gedung::where('id', $idne)->delete();
				return response()->json(['status' => 'Sukses', 'message' => 'data Gedung '.$namagd.' Kode : '.$kodegd.' Unit : '.$fakultas.' berhasil di hapus']);
				return back();
			} else {
				return response()->json(['status' => 'Gagal', 'message' => 'Dalam Gedung ini masih ada ruang yang belum di hapus']);
				return back();
			}
		}
		else if ($namarg == 'gedung') {
			if ($koderg != '' or $luas != ''){
				$idne 		= $kapas;
				$pjgedung 	= $namagd;
				$statpinjam = $petugas;
				$tarif 		= $marking;
				if ($fakpanjang == ''){ $fakpanjang = 'Kantor Pusat'; }
				if ($idne == 'new'){
					$cekwes1 = Gedung::where('namagd', $koderg)->count();
					$cekwes2 = Gedung::where('kodegd', $luas)->count();
					if ($statpinjam == 'Di Sewa/Pinjamkan untuk kalangan internal' OR $statpinjam == 'Di Sewa/Pinjamkan untuk umum'){
						$wajibada = 1;
					} else {
						$wajibada = 0;
					}
					if ($wajibada == 1 AND $pjgedung == '0'){
						return response()->json(['status' => 'Gagal', 'message' => 'Penanggung Jawab Gedung Wajib di Isi']);
						return back();
					} else if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Gedung Terdeteksi Double. Mohon Ubah Nama Gedung Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Gedung Terdeteksi Double. Mohon Ubah Kode Gedung Anda']);
						return back();
					} else{
						$input = Gedung::insertGetId([
							'namagd'  	=>  $koderg,
							'singgd'   	=>  $luas,
							'kodegd'   	=>  $luas,
							'pjgedung'	=>  $pjgedung,
							'statpinjam'=>  $statpinjam,
							'tarif'		=>  $tarif,
							'fakpanjang'=>  $fakpanjang,
							'fakultas'	=>  $fakultas,
							'inputor'	=>  Session('nama'),
						]);
						if ($input){
							if ($request->hasFile('file')) {								
								$namafile 		= $fakultas.'-GDG-'.$input;
								$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('images/gedung/',$uploadedFile,$namafile);
								Gedung::where('id', $input)->update([
									'foto'  	=>  $namafile,
								]);
							}
							return response()->json(['status' => 'Sukses', 'message' => 'Data Gedung '.$koderg.' Berhasil di Simpan']);
							return back();
						} else {
							return response()->json(['status' => 'Gagal', 'message' => 'Input Gedung, Pastikan semua form anda isi dan silahkan coba lagi beberapa saat lagi']);
							return back();
						}
						
					}
				} else {
					$cekwes1 = Gedung::where('namagd', $koderg)->where('id', '!=', $idne)->count();
					$cekwes2 = Gedung::where('kodegd', $luas)->where('id', '!=', $idne)->count();
					if ($statpinjam == 'Di Sewa/Pinjamkan untuk kalangan internal' OR $statpinjam == 'Di Sewa/Pinjamkan untuk umum'){
						$wajibada = 1;
					} else {
						$wajibada = 0;
					}
					if ($wajibada == 1 AND $pjgedung == '0'){
						return response()->json(['status' => 'Gagal', 'message' => 'Penanggung Jawab Gedung Wajib di Isi']);
						return back();
					} else if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Gedung Terdeteksi Double. Mohon Ubah Nama Gedung Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Gedung Terdeteksi Double. Mohon Ubah Kode Gedung Anda']);
						return back();
					} else{
						$input = Gedung::where('id', $idne)->update([
							'namagd'  	=>  $koderg,
							'singgd'   	=>  $luas,
							'kodegd'   	=>  $luas,
							'pjgedung'	=>  $pjgedung,
							'statpinjam'=>  $statpinjam,
							'tarif'		=>  $tarif,
							'fakpanjang'=>  $fakpanjang,
							'fakultas'	=>  $fakultas,
							'inputor'	=>  Session('nama'),
						]);
						if ($input){
							if ($request->hasFile('file')) {
								$cekfoto = Gedung::where('id', $idne)->first();
								if (isset($cekfoto->foto)){
									$fotolama= $cekfoto->foto;
									if (File::exists(base_path() ."/public/images/gedung/". $fotolama)) {
									  File::delete(base_path() ."/public/images/gedung/". $fotolama);
									}
								}								
								$namafile 		= $fakultas.'-GDG-'.$idne;
								$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('images/gedung/',$uploadedFile,$namafile);
								Gedung::where('id', $idne)->update([
									'foto'  	=>  $namafile,
								]);
							}
							return response()->json(['status' => 'Sukses', 'message' => 'Data Gedung '.$koderg.' Berhasil di Update']);
							return back();
						} else {
							return response()->json(['status' => 'Gagal', 'message' => 'Tidak ada yang diubah']);
							return back();
						}
					}
				}
			}else {
				return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Data Gedung Anda..!!']);
				return back();
			}
			
		}
		else {
			if ($idne == 'new'){
				if ($namarg != '' and $koderg != '' and $namagd != '' ){
					$cekwes1 = Ruang::where('namarg', $namarg)->count();
					$cekwes2 = Ruang::where('koderg', $koderg)->count();
					if ($statpinjam == 'Di Sewa/Pinjamkan untuk kalangan internal' OR $statpinjam == 'Di Sewa/Pinjamkan untuk umum'){
						$wajibada = 1;
					} else {
						$wajibada = 0;
					}
					if ($wajibada == 1 AND $pjgedung == '0'){
						return response()->json(['status' => 'Gagal', 'message' => 'Penanggung Jawab Ruang Wajib di Isi']);
						return back();
					} else if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Ruang Terdeteksi Double. Mohon Ubah Nama Ruang Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Ruang Terdeteksi Double. Mohon Ubah Kode Ruang Anda']);
						return back();
					} else{
						$jglkgedung	= Gedung::where('namagd', $namagd)->first();
						$gdnama		= $jglkgedung->namagd;
						$gdkode		= $jglkgedung->kodegd;
						$input 		= Ruang::insertGetId([
							'namarg'  		=>  $namarg,
							'namagd'   		=>  $gdnama,
							'kodegd'		=>  $gdkode,
							'koderg'		=>  $koderg,
							'petugas'		=>  $petugas,
							'marking'		=>  $marking,
							'luas'			=>  $luas,
							'kapasitasujian'=>  $kapas,
							'kondisi'		=>  $kondisi,
							'utilitas'		=>  $utitilitas,
							'pjgedung'		=>  $pjgedung,
							'pinjam'		=>  $statpinjam,
							'tarif'			=>  $tarif,
							'fakpanjang'	=>  $fakpanjang,
							'fakultas'		=>  $fakultas,
							'inputor'		=>  Session('nama'),
						]);
						if ($input){
							if ($request->hasFile('file')) {
								$namafile 		= $fakultas.'-RG-'.$input;
								$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('images/ruang/',$uploadedFile,$namafile);
					
								Ruang::where('id', $input)->update([
									'foto'  	=>  $namafile,
								]);
							}
							return response()->json(['status' => 'Sukses', 'message' => 'Data Ruang '.$namarg.' Berhasil di Tambahkan']);
							return back();
						} else {
							return response()->json(['status' => 'Gagal', 'message' => 'Tidak ada yang diubah']);
							return back();
						}
					}
				}else {
					return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Anda..!!']);
					return back();
				}
			}else{
				if ($namarg != '' and $koderg != '' and $namagd != '' ){
					$cekwes1 = Ruang::where('namarg', $namarg)->where('id', '!=', $idne)->count();
					$cekwes2 = Ruang::where('koderg', $koderg)->where('id', '!=', $idne)->count();
					if ($statpinjam == 'Di Sewa/Pinjamkan untuk kalangan internal' OR $statpinjam == 'Di Sewa/Pinjamkan untuk umum'){
						$wajibada = 1;
					} else {
						$wajibada = 0;
					}
					if ($wajibada == 1 AND $pjgedung == '0'){
						return response()->json(['status' => 'Gagal', 'message' => 'Penanggung Jawab Ruang Wajib di Isi']);
						return back();
					} else if ($cekwes1 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Nama Ruang Terdeteksi Double. Mohon Ubah Nama Ruang Anda']);
						return back();
					} else if ($cekwes2 != 0){
						return response()->json(['status' => 'Gagal', 'message' => 'Kode Ruang Terdeteksi Double. Mohon Ubah Kode Ruang Anda']);
						return back();
					} else{
						$jglkgedung	= Gedung::where('namagd', $namagd)->first();
						$gdnama		= $jglkgedung->namagd;
						$gdkode		= $jglkgedung->kodegd;
						if ($marking == ''){
							$input = Ruang::where('id', $idne)->update([
								'namarg'  		=>  $namarg,
								'namagd'   		=>  $gdnama,
								'kodegd'		=>  $gdkode,
								'koderg'		=>  $koderg,
								'petugas'		=>  $petugas,
								'marking'		=>  $marking,
								'luas'			=>  $luas,
								'kapasitasujian'=>  $kapas,
								'kondisi'		=>  $kondisi,
								'utilitas'		=>  $utitilitas,
								'pjgedung'		=>  $pjgedung,
								'pinjam'		=>  $statpinjam,
								'tarif'			=>  $tarif,
								'fakpanjang'	=>  $fakpanjang,
								'fakultas'		=>  $fakultas,
								'inputor'		=>  Session('nama'),
							]);
						}else {
							$input = Ruang::where('id', $idne)->update([
								'namarg'  		=>  $namarg,
								'namagd'   		=>  $gdnama,
								'kodegd'		=>  $gdkode,
								'koderg'		=>  $koderg,
								'petugas'		=>  $petugas,
								'marking'		=>  $marking,
								'luas'			=>  $luas,
								'kapasitasujian'=>  $kapas,
								'kondisi'		=>  $kondisi,
								'utilitas'		=>  $utitilitas,
								'pjgedung'		=>  $pjgedung,
								'pinjam'		=>  $statpinjam,
								'tarif'			=>  $tarif,
								'fakpanjang'	=>  $fakpanjang,
								'fakultas'		=>  $fakultas,
								'inputor'		=>  Session('nama'),
							]);
						}
						if ($input){
							if ($request->hasFile('file')) {
								$cekfoto = Ruang::where('id', $idne)->first();
								if (isset($cekfoto->foto)){
									$fotolama= $cekfoto->foto;
									if (File::exists(base_path() ."/public/images/ruang/". $fotolama)) {
									  File::delete(base_path() ."/public/images/ruang/". $fotolama);
									}
								}								
								$namafile 		= $fakultas.'-RG-'.$idne;
								$namafile		= $namafile.'.'.$request->file->getClientOriginalExtension();
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('images/ruang/',$uploadedFile,$namafile);
								Ruang::where('id', $idne)->update([
									'foto'  	=>  $namafile,
								]);
							}
							return response()->json(['status' => 'Sukses', 'message' => 'Data Ruang '.$namarg.' Berhasil di Update']);
							return back();
						} else {
							return response()->json(['status' => 'Gagal', 'message' => 'Tidak ada yang diubah']);
							return back();
						}
					}
				}else {
					return response()->json(['status' => 'Gagal', 'message' => 'Mohon Lengkapi Isian Anda..!!']);
					return back();
				}
			}
		}        
    }
	public function ctkDir(Request $request) {
		$idne			= $request->input('valkirim');
		$dd				= date('d');
		$mm				= date('m');
		$yy				= date('Y');
		$bulan 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$intbln 		= (int)$mm;
		$namabulan 		= $bulan[$intbln];
		$tanggal		= $dd.' '.$namabulan.' '.$yy;
		$fakultas		= Session('sekolah_id_sekolah');
		$fakpanjang		= Session('sekolah_nama_sekolah');
		$rsetting		= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		if (isset($rsetting->nama_sekolah)){
			$sekolah 		= $rsetting->nama_sekolah;
			$yayasan 		= $rsetting->nama_yayasan;
			$alamat 		= $rsetting->alamat;
			$kasub 			= $rsetting->kepala_sekolah->nama;
			$nipkasub 		= $rsetting->kepala_sekolah->niy;
			$jabkasub		= 'Kepala Sekolah';
		} else {
			$sekolah 		= Session('fakultas');
			$yayasan 		= Session('fakpanjang');
			$alamat 		= Session('addressapps01');
			$kasub 			= '....................';
			$nipkasub 		= '....................';
			$jabkasub		= '......................';
		}
		
		
		$homebase		= url("/");
		$getdata 		= Ruang::where('id', $idne)->first();
		$namarg			= $getdata->namarg;
		$koderg			= $getdata->koderg;
		$petugas		= $getdata->petugas;
		$generate		= '
		<table cellpadding="0" cellspacing="0" width="800" id="printiki" border="0">
		  <tr>
			<td colspan="9">'.$yayasan.'</td>
		  </tr>
		  <tr>
			<td colspan="9">'.$sekolah.'</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="9">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="9" align="center">DAFTAR INVENTARIS BARANG</td>
		  </tr>
		  <tr>
			<td colspan="9" align="center">(DIR)</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="2">NAMA UPB</td>
			<td colspan="3">: '.$sekolah.'</td>
			<td colspan="2">NAMA RUANGAN</td>
			<td colspan="2">: '.$namarg.'</td>
		  </tr>
		  <tr>
			<td colspan="2">KODE UPB</td>
			<td>: __________________________</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">KODE RUANGAN</td>
			<td colspan="2">: '.$koderg.'</td>
		  </tr>
		  <tr>
			<td colspan="9">
				<table cellpadding="0" cellspacing="0" width="800" border="1">
				  <tr>
					<td rowspan="2" width="41" align="center" valign="midlle"><b>No.</b></td>
					<td rowspan="2" width="79" align="center" valign="midlle"><b>Kode Barang</b></td>
					<td rowspan="2" width="269" align="center" valign="midlle"><b>Nama Barang</b></td>
					<td colspan="3" align="center" valign="midlle"><b>Deskripsi Barang</b></td>
					<td rowspan="2" width="83" align="center" valign="midlle"><b>Jumlah Barang</b></td>
					<td rowspan="2" width="142" align="center" valign="midlle"><b>Penguasaan</b></td>
					<td rowspan="2" width="154" align="center" valign="midlle"><b>Keterangan</b></td>
				  </tr>
				  <tr>
					<td width="86" align="center" valign="midlle"><b>Merk</b></td>
					<td width="165" align="center" valign="midlle"><b>Sumber Dana</b></td>
					<td width="77" align="center" valign="midlle"><b>Tahun Perolehan</b></td>
				  </tr>
		';
		$nomer 		= 1;
		$getdatafas = Fasruang::where('idruang', $idne)->groupBy('jenis')->get();
		if(!empty($getdatafas)){
			foreach($getdatafas as $hasil){
				$penguasaan = 'Milik Sendiri';
				$jenis 		= $hasil->jenis;
				$getallstat	= Fasruang::where('idruang', $idne)->where('jenis', $jenis)->groupBy('namabrg')->get();
				foreach($getallstat as $rstat){
					$namabrg 	= $rstat->namabrg;
					$jumlah		= Fasruang::where('idruang', $idne)->where('jenis', $jenis)->where('namabrg', $namabrg)->count();
					$generate 	= $generate.'
								<tr>
									<td align="center" valign="top">'.$nomer.'</td>
									<td align="center" valign="top">'.$rstat->kodebarang.'</td>
									<td align="left" valign="top">'.$namabrg.'</td>
									<td align="left" valign="top">'.$rstat->merek.'</td>
									<td align="left" valign="top">'.$rstat->sumberdana.'</td>
									<td align="center" valign="top">'.$rstat->tahunterima.'</td>
									<td align="center" valign="top">'.$jumlah.'</td>
									<td align="left" valign="top">'.$penguasaan.'</td>
									<td align="left" valign="top">'.$rstat->kondisi.'</td>
								</tr>
								';
					$nomer++;
				}				
			}
			if ($nomer != 31){
				while($nomer != 31){
					$generate = $generate.'
					<tr>
						<td align="center" valign="top">'.$nomer.'</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					 </tr>
					';
					$nomer++;
				}
			}
		} else {
			while($nomer != 31){
				$generate = $generate.'
				<tr>
					<td align="center" valign="top">'.$nomer.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				 </tr>
				';
				$nomer++;
			}
		}
		$generate = $generate.'
			</table>
			</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="9">Tidak dibenarkan memindah barang - barang yang ada pada daftar  ini tanpa sepengetahuan penanggung jawab Unit Akutansi Kuasa Pengguna Barang (UAKPB) dan penanggung jawab ruangan.</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">Malang,</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="2">Mengetahui,</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="5">'.$jabkasub.'</td>
			<td colspan="4">Penanggung Jawab Ruangan</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="5">'.$kasub.'</td>
			<td colspan="4">'.$petugas.'</td>
		  </tr>
		  <tr>
			<td colspan="9">NIP. '.$nipkasub.'</td>
		  </tr>
		</table>';
		echo $generate;
	}
	public function viewPrestasisiswa() {
		$tasks							= [];
		if (Session('previlage') == 'level1' OR Session('previlage') == 'level4'){
			$sekolah					= Session('sekolah_id_sekolah');
			$datethn1 					= date("Y"); 
			$datethn2 					= $datethn1 + 1; 
			$datethn3 					= $datethn1 - 1;
			$datethn4 					= $datethn1 - 2;
			$tapel1 					= $datethn4.'-'.$datethn3;
			$tapel2						= $datethn3.'-'.$datethn1;
			$tapel3 					= $datethn1.'-'.$datethn2;
			$tasks['datethn1']			= $datethn1;
			$tasks['datethn2']			= $datethn2;
			$tasks['datethn3']			= $datethn3;
			$tasks['datethn4']			= $datethn4;
			$tasks['tahunne']			= date("Y");
			$tasks['tapel1']			= $tapel1;
			$tasks['tapel2']			= $tapel2;
			$tasks['tapel3']			= $tapel3;
			$tasks['tanggal']			= date("d-m-Y");
			$tasks['countregional']		= Prestasi::where('id_sekolah', $sekolah)->where('tanggal', 'LIKE', '%'.$datethn1.'%')->where('tingkat', 'Regional')->count();
			$tasks['countnasional']		= Prestasi::where('id_sekolah', $sekolah)->where('tanggal', 'LIKE', '%'.$datethn1.'%')->where('tingkat', 'Nasional')->count();
			$tasks['countinter']		= Prestasi::where('id_sekolah', $sekolah)->where('tanggal', 'LIKE', '%'.$datethn1.'%')->where('tingkat', 'Internasional')->count();
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
			$tasks['sidebar']			= 'prestasisiswa';
			return view('simaster.prestasisiswa', $tasks);
		} else {
			$tasks['kalimatheader']  = 'Mohon Maaf';
            $tasks['kalimatbody']  	= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $tasks);
        }
	}
	public function jsonPrestasithnini() {
		$arrrekap 		= [];
		$tahun			= date("Y");
		$fakultas		= Session('sekolah_id_sekolah');
		$fakpanjang		= Session('sekolah_nama_sekolah');
		$rsetting		= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$sekolah 		= $rsetting->nama_sekolah;
		$yayasan 		= $rsetting->nama_yayasan;
		$alamat 		= $rsetting->alamat;
		if (isset($rsetting->kepala_sekolah->nama)){
			$kasub 			= $rsetting->kepala_sekolah->nama;
			$nipkasub 		= $rsetting->kepala_sekolah->niy;
		} else {
			$kasub 			= config('global.swandhananama');
			$nipkasub 		= '-';
		}
		$getallthn 	= Prestasi::where('id_sekolah', Session('sekolah_id_sekolah') )->where('tanggal', 'LIKE', '%'.$tahun.'%')->groupBy('kelas')->get();
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$kelas		= $rdatane->kelas;
				$total 		= Prestasi::where('id_sekolah', Session('sekolah_id_sekolah') )->where('tanggal', 'LIKE', '%'.$tahun.'%')->where('kelas', $kelas)->count();
				$arrrekap[] 	= array(
					'jenis' 	=> $kelas,
					'jumlah' 	=> $total,
				);
			}
		}
		echo json_encode($arrrekap);
	}
	public function jsonPrestasithniniperbidang() {
		$arrrekap 	= [];
		$tahun		= date("Y");
		$getallthn 	= Prestasi::where('id_sekolah', Session('sekolah_id_sekolah') )->where('tanggal', 'LIKE', '%'.$tahun.'%')->groupBy('bidang')->get();
		if (!empty($getallthn)){
			foreach ($getallthn as $rdatane) {
				$bidang		= $rdatane->bidang;
				$total 		= Prestasi::where('id_sekolah', Session('sekolah_id_sekolah') )->where('tanggal', 'LIKE', '%'.$tahun.'%')->where('bidang', $bidang)->count();
				$arrrekap[] 	= array(
					'jenis' 	=> $bidang,
					'jumlah' 	=> $total,
				);
			}
		}
		echo json_encode($arrrekap);
	}
	public function exSimpanprestasi(Request $request) {
		$noinduk		= $request->val02;
		$namakegiatan	= $request->val03;
		$peringkat		= $request->val04;
		$bidang			= $request->val05;
		$tingkat		= $request->val06;
		$penyelenggara	= $request->val07;
		$tanggal1		= $request->val08;
		$tempat			= $request->val09;
		$idne			= $request->val10;
		$tanggal2		= $request->val11;
		$tapel			= $request->val12;
		$getkelas		= Datainduk::where('noinduk', $noinduk)->first();
		if (isset($getkelas->klspos)){
			$kelas 		= $getkelas->klspos;
			$nama 		= $getkelas->nama;
		} else { $kelas = ''; $nama = '';}
		
		if ($tanggal2 == ''){ 
			$tanggal = $tanggal1;
		} else { $tanggal = $tanggal1.' s/d '.$tanggal2; }
		if ($noinduk == 'hapus'){
			$getdata 	= Prestasi::where('id', $idne)->first();
			$namafile	= $getdata->namafile;
			if ($namafile != ''){
				if (File::exists(base_path() ."/public/dist/img/sertifikat/". $namafile)) {
				  File::delete(base_path() ."/public/dist/img/sertifikat/". $namafile);
				}
			}
			$hapus 	= Prestasi::where('id', $idne)->delete();
			if ($hapus){
				$deskripsi 	= Session('nama').' Menghapus data Prestasi '.$getdata->nama.' No.Induk : '.$getdata->noinduk.' Pada Lomba/Kegiatan '.$getdata->namakegiatan;
				Logstaff::create([
					'jenis'			=> 'Data Prestasi', 
					'sopo'			=> Session('nip'), 
					'kelakuan'		=> $deskripsi,
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Prestasi Telah di Hapus']);
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
					$cekdata = Prestasi::where('noinduk', $noinduk)->where('namakegiatan', $namakegiatan)->where('tanggal', $tanggal)->count();
					if ($cekdata != 0){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
						return back();
					} else {
						$input = Prestasi::create([
							'namakegiatan'	=> $namakegiatan,
							'bidang'		=> $bidang,
							'tingkat'		=> $tingkat,
							'juara'			=> $peringkat,
							'penyelenggara'	=> $penyelenggara,
							'tempat'		=> $tempat,
							'tanggal'		=> $tanggal,
							'tapel'			=> $tapel,
							'nama'			=> $nama,
							'noinduk'		=> $noinduk,
							'kelas'			=> $kelas,
							'namafile'		=> '',
							'inputor'		=> Session('nama'),
							'id_sekolah'	=> Session('sekolah_id_sekolah')
							
						]);
						if ($input){
							$idne = $input->id;
							if ($request->hasFile('file')) {
								$ekstensi		= $request->file('file')->getClientOriginalExtension();
								$namafile 		= $idne.'.'.$ekstensi;
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('dist/img/sertifikat/',$uploadedFile,$namafile);
								Prestasi::where('id', $idne)->update([
									'namafile'	=> $namafile,
								]);
							}			
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Prestasi Telah di Tambahkan']);
							return back();
						}else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Input Gagal', 'message' => 'Silahkan ulangi beberapa saat lagi, atau hubungi admin TI anda']);
							return back();
						}
					}
				} else {
					$cekdata = Prestasi::where('id','!=', $idne)->where('noinduk', $noinduk)->where('namakegiatan', $namakegiatan)->where('tanggal', $tanggal)->count();
					if ($cekdata != 0){
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Double Detected', 'message' => 'Data Sudah Ada']);
						return back();
					} else {
						$input = Prestasi::where('id', $idne)->update([
							'namakegiatan'	=> $namakegiatan,
							'bidang'		=> $bidang,
							'juara'			=> $peringkat,
							'penyelenggara'	=> $penyelenggara,
							'tempat'		=> $tempat,
							'tanggal'		=> $tanggal,
							'tapel'			=> $tapel,
							'nama'			=> $nama,
							'noinduk'		=> $noinduk,
							'kelas'			=> $kelas,
							'inputor'		=> Session('nama'),
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
						if ($input){	
							if ($request->hasFile('file')) {
								$getdata 	= Prestasi::where('id', $idne)->first();
								$namafile	= $getdata->namafile;
								if ($namafile != ''){
									if (File::exists(base_path() ."/public/dist/img/sertifikat/". $namafile)) {
										File::delete(base_path() ."/public/dist/img/sertifikat/". $namafile);
									}
								}
								$ekstensi		= $request->file('file')->getClientOriginalExtension();
								$namafile 		= $idne.'.'.$ekstensi;
								$uploadedFile 	= $request->file('file');
								Storage::putFileAs('dist/img/sertifikat/',$uploadedFile,$namafile);
								Prestasi::where('id', $idne)->update([
									'namafile'	=> $namafile,
								]);
							}		
							return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data Prestasi Telah di Tambahkan']);
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
	public function jsonAlldataprestasi(Request $request) {
		$bulan 		= $request->val01;
		$tahun 		= $request->val02;
		$tahunini 	= date("Y");
		$query 		= Prestasi::where('id_sekolah', session('sekolah_id_sekolah'))->where('tanggal', 'LIKE', "%$tahunini%");
		if ($bulan == 'REGIONAL') {
			$query->where('tingkat', 'Regional');
		} elseif ($bulan == 'NASIONAL') {
			$query->where('tingkat', 'Nasional');
		} elseif ($bulan == 'INTERNASIONAL') {
			$query->where('tingkat', 'Internasional');
		} elseif ($bulan == 'ALL') {
			if ($tahun == 'TAHUNINI') {
				$query->where('tanggal', 'LIKE', "%$tahunini%");
			} else {
				$query->where('tanggal', 'LIKE', "%$tahun%");
			}
		} else {
			if ($bulan == 'ALL') {
				$query->where('tanggal', 'LIKE', "%$tahun%");
			} else {
				$query->where('tanggal', 'LIKE', "%$bulan-$tahun%");
			}
		}
		$getallthn 	= $query->get();
		$alldata 	= [];
		$homebase 	= url("/");

		if ($getallthn->isNotEmpty()) {
			foreach ($getallthn as $rdatane) {
				$namafile 	= $rdatane->namafile;
				$tanggal 	= $rdatane->tanggal;
				if ($namafile != '') {
					$sertifikat = $homebase . '/dist/img/sertifikat/' . $namafile;
					$geteks = explode(".", $namafile);
					$ekstensi = $geteks[1];
				} else {
					$sertifikat = '';
					$ekstensi = '';
				}
				$cektanggal = explode(" s/d ", $tanggal);
				$tanggal1 	= $cektanggal[0];
				$tanggal2 	= isset($cektanggal[1]) ? $cektanggal[1] : $tanggal1;

				$alldata[] = [
					'id' 			=> $rdatane->id,
					'kegiatan' 		=> $rdatane->namakegiatan,
					'bidang' 		=> $rdatane->bidang,
					'peringkat' 	=> $rdatane->juara,
					'penyelenggara' => $rdatane->penyelenggara,
					'tanggal' 		=> $rdatane->tanggal,
					'tempat' 		=> $rdatane->tempat,
					'tingkat' 		=> $rdatane->tingkat,
					'tapel' 		=> $rdatane->tapel,
					'nama' 			=> $rdatane->nama,
					'noinduk' 		=> $rdatane->noinduk,
					'kelas'	 		=> $rdatane->kelas,
					'sertifikat' 	=> $sertifikat,
					'nmfile' 		=> $namafile,
					'typefile' 		=> $ekstensi,
					'tanggal1' 		=> $tanggal1,
					'tanggal2' 		=> $tanggal2,
					'inputor' 		=> $rdatane->inputor,
				];
			}
		}
		echo json_encode($alldata);
	}
	public function zis() {
		$rsetting				= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		if (isset($rsetting->id)){
			$id 					= $rsetting->id;
			$sekolah 				= $rsetting->nama_sekolah;
			$yayasan 				= $rsetting->nama_yayasan;
			$alamat 				= $rsetting->alamat;
			$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
			$mutiara 				= $rsetting->slogan;
			$logo 					= $rsetting->logo;
			$frontpage 				= $rsetting->frontpage;
			$pengumuman 			= $rsetting->pengumuman;
			$pendaftaran 			= $rsetting->pendaftaran;
			$no_rek 				= $rsetting->no_rek;
			$nama_rek 				= $rsetting->nama_rek;
			$nama_bank_rek 			= $rsetting->nama_bank_rek;
	
			$tasks					= [];
			$tasks['id_sekolah']	= $id;
			$tasks['logo']			= $logo;
			$tasks['frontpage']		= $frontpage;
			$tasks['yayasan']		= $yayasan;
			$tasks['sekolah']		= $sekolah;
			$tasks['alamat']		= $alamat;
			$tasks['kepalasekolah']	= $kepalasekolah;
			$tasks['pengumuman']	= $pengumuman;
			$tasks['pendaftaran']	= $pendaftaran;
			$tasks['no_rek']		= $no_rek;
			$tasks['nama_rek']		= $nama_rek;
			$tasks['nama_bank_rek']	= $nama_bank_rek;
			
			$rstatuszis				= Layanan::where('layanan', 'pembayaranzis')->where('id_sekolah', $id)->first();
			if (isset($rstatuszis->status)){
				$ijinzis 			= $rstatuszis->status;
			} else { $ijinzis		= ''; }
			if ($ijinzis == 'mati'){
				$tasks['kalimatheader']  	= 'Mohon Maaf';
				$tasks['kalimatbody']  		= 'Laman ini sementara di Tutup dan Akan dibuka saat Jadwal Penerimaan sudah di tentukan';
				return view('errors.notready', $tasks);
			} else {
				$tasks['sidebar']	= 'zis';
				return view('zis', $tasks);
			}
		} else {
			$tasks['kalimatheader']  	= 'Mohon Maaf';
            $tasks['kalimatbody']  		= 'Session Tidak Valid, Silahkan Relogin untuk mengakses Halaman Ini';
            return view('errors.notready', $tasks);
        }
    }
	public function exSimpanpendaftaran(Request $request) {
		if (Session('sekolah_id_sekolah') != null ){
			if (Session('sekolah_id_sekolah') != ''){
				$id_sekolah = Session('sekolah_id_sekolah');
			} else {
				$id_sekolah =   $request->id_sekolah;
			}
		} else {
			$id_sekolah =   $request->id_sekolah;
		}
		$homebase	= 	url("/");
		$nominal   	=   $request->val07;
		$zakatmal   =   $request->val08;
		$donasi   	=   $request->val09;
		$idinput   	=   $request->val11;
		$nominal 	= 	str_replace(',','',$nominal);
		$zakatmal 	= 	str_replace(',','',$zakatmal);
		$donasi 	= 	str_replace(',','',$donasi);
		
		if ($idinput == 'new'){
			$idinput 	= 	Pembayaranzis::insertGetId([
				'namawali'		=> $request->val02, 
				'namasiswa'		=> $request->val03, 
				'kelas'			=> $request->val04, 
				'jeniszakat'	=> $request->val05, 
				'orang'			=> $request->val06, 
				'nominal'		=> $nominal, 
				'zakatmaal'		=> $zakatmal, 
				'donasi'		=> $donasi,
				'hape'			=> $request->val10, 
				'validator'		=> '', 
				'tglvalidasi'	=> '',
				'namafile'		=> '',
				'id_sekolah'	=> $id_sekolah,
			]);
			$alamatweb		= $homebase.'/ceking/'.$idinput;
			if ($request->hasFile('file')) {
				$jenfile	= 	$request->file->getClientOriginalExtension();
				$file_tmp	= 	$request->file('file');
				$data 		= 	file_get_contents($file_tmp);
				$bukti 		= 	'data:image/' . $jenfile . ';base64,' . base64_encode($data);
				Pembayaranzis::where('id', $idinput)->update([
					'namafile'		=> $bukti,
				]);
			}
		} else {
			$alamatweb		= $homebase.'/ceking/'.$idinput;
			$idinput 		= Pembayaranzis::where('id', $idinput)->update([
				'namawali'		=> $request->val02, 
				'namasiswa'		=> $request->val03, 
				'kelas'			=> $request->val04, 
				'jeniszakat'	=> $request->val05, 
				'orang'			=> $request->val06, 
				'nominal'		=> $nominal, 
				'zakatmaal'		=> $zakatmal, 
				'donasi'		=> $donasi,
				'hape'			=> $request->val10, 
			]);
			if ($request->hasFile('file')) {
				$jenfile	= 	$request->file->getClientOriginalExtension();
				$file_tmp	= 	$request->file('file');
				$data 		= 	file_get_contents($file_tmp);
				$bukti 		= 	'data:image/' . $jenfile . ';base64,' . base64_encode($data);
				Pembayaranzis::where('id', $idinput)->update([
					'namafile'		=> $bukti,
				]);
			}
		}
		if ($idinput){			
			echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses</h4>
					Pembayaranzis Zakat, Infaq dan Shodaqoh Anda Telah Kami Terima, Mohon Simpan Link Berikut untuk mengetahui tindak lanjut dari Pembayaranzis anda.!<br />
					<strong><h3><a href="'.$alamatweb.'">'.$alamatweb.'</a></h3></strong>
				  </div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					 System Down, Mohon di Coba Beberapa Saat Lagi
				  </div>';
		}
		
    }
	public function pip(Request $request) {
		$id 					= $request->input('id');
		$rsetting				= Sekolah::where('id', $id)->first();
		if(!$rsetting){
			return view('accessdenided');	
		}
		$tasks					= [];		
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
		$frontpage 				= $rsetting->frontpage;
		$pengumuman 			= $rsetting->pengumuman;
		$pendaftaran 			= $rsetting->pendaftaran;
		$homebase				= url("/");
		$statppdb				= '';
		$kodebaru				= '';
		$kodepindahan 			= '';
		$hargaformulir 			= '';
		$namabank 				= '';
		$norek 					= '';
		$periode 				= '';
		$setspp1 				= '';
		$setspp2 				= '';
		$setspp3 				= '';
		$setdpp1 				= '';
		$setdpp2 				= '';
		$setdpp3 				= '';
		$sql 					= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id)->get();
		if (!empty($sql)){
			foreach ($sql as $rlayanan){
				$status 		= $rlayanan->status;
				$layanan 		= $rlayanan->layanan;
				if ($layanan == 'periodepsb') { $periode = $status; }
				if ($layanan == 'ppdb') { $statppdb = $status; }
				if ($layanan == 'kodebaru') { $kodebaru = $status; }
				if ($layanan == 'kodepindahan') { $kodepindahan = $status; }
				if ($layanan == 'hargaformulir') { $hargaformulir = $status; }
				if ($layanan == 'namabank') { $namabank = $status; }
				if ($layanan == 'norek') { $norek = $status; }
				if ($layanan == 'spp1') { $setspp1 = $status; }
				if ($layanan == 'spp2') { $setspp2 = $status; }
				if ($layanan == 'spp3') { $setspp3 = $status; }
				if ($layanan == 'dpp1') { $setdpp1 = $status; }
				if ($layanan == 'dpp2') { $setdpp2 = $status; }
			}
		}
		$tasks['id_sekolah']	= $id;
		$tasks['logo']			= $logo;
		$tasks['tabel']			= ProgramPIP::where('idsekolah', $id)->get();
		$tasks['frontpage']		= $frontpage;
		$tasks['yayasan']		= $yayasan;
		$tasks['sekolah']		= $sekolah;
		$tasks['alamat']		= $alamat;
		$tasks['kepalasekolah']	= $kepalasekolah;
		$tasks['pengumuman']	= $pengumuman;
		$tasks['pendaftaran']	= $pendaftaran;
		$tasks['statppdb']		= $statppdb;
		$tasks['tahun']			= date("Y");
		$tasks['hargaformulir']	= $hargaformulir;
		$tasks['norek']			= $norek;
		$tasks['namabank']		= $namabank;
		$tasks['lvlsekolah']	= $rsetting->level;
		$tasks['sidebar']		= 'pip';
		return view('pip', $tasks);
    }
	public function exSimpandataPIP(Request $request) {
		$idne 		= $request->val01;
		$datamasuk 	= $request->val02;
		$nama 		= $request->val03;
		$kelaslama 	= $request->val04;
		$kelasbaru 	= $request->val05;
		$tahap 		= $request->val06;
		$norek 		= $request->val07;
		$virtual 	= $request->val08;
		$keterangan = $request->val09;
		if ($idne == 'new'){
			$ceksek 	= ProgramPIP::where('norek', $norek)->where('idsekolah', Session('sekolah_id_sekolah'))->count();
			$ceksek2 	= ProgramPIP::where('virtualacc', $virtual)->where('idsekolah', Session('sekolah_id_sekolah'))->count();
			$ceksek3 	= ProgramPIP::where('nama', $nama)->where('kelaslama', $kelaslama)->where('idsekolah', Session('sekolah_id_sekolah'))->count();
		} else {
			$ceksek 	= ProgramPIP::where('id', '!=', $idne)->where('norek', $norek)->where('idsekolah', Session('sekolah_id_sekolah'))->count();
			$ceksek2 	= ProgramPIP::where('id', '!=', $idne)->where('virtualacc', $virtual)->where('idsekolah', Session('sekolah_id_sekolah'))->count();
			$ceksek3 	= ProgramPIP::where('id', '!=', $idne)->where('nama', $nama)->where('kelaslama', $kelaslama)->where('idsekolah', Session('sekolah_id_sekolah'))->count();
		}
		if ($ceksek != 0){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Gagal menyimpan, No. Rekening Terdeteksi Ganda
					</div>';
		} else if ($ceksek2 != 0){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Gagal menyimpan, No. Virtual Acc Terdeteksi Ganda
					</div>';
		} else if ($ceksek3 != 0){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					Gagal menyimpan, Nama Siswa dan Kelas Lama Terdeteksi Ganda
					</div>';
		} else {
			if ($idne == 'new'){
				$input = ProgramPIP::create([
					'idsekolah'		=> Session('sekolah_id_sekolah'),
					'datamasuk'		=> $datamasuk,
					'nama'			=> $nama,
					'kelaslama'		=> $kelaslama,
					'kelasbaru'		=> $kelasbaru,
					'tahap'			=> $tahap,
					'norek'			=> $norek,
					'virtualacc'	=> $virtual,
					'keterangan'	=> $keterangan,
					'created_by'	=> Session('nama')
				]);
			} else {
				$input = ProgramPIP::where('id', $idne)->update([
					'datamasuk'		=> $datamasuk,
					'nama'			=> $nama,
					'kelaslama'		=> $kelaslama,
					'kelasbaru'		=> $kelasbaru,
					'tahap'			=> $tahap,
					'norek'			=> $norek,
					'virtualacc'	=> $virtual,
					'keterangan'	=> $keterangan,
					'created_by'	=> Session('nama'),
					'updated_at'	=> date("Y-m-d H:i:s")
				]);
			}
		}
		if ($input){
			echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Sukses </h4>
				Data PIP an '.$nama.' Kelas Lama '.$kelaslama.' Tahap/Tahun '.$tahap.' Berhasil Di Simpan
				</div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Error</h4>
			Gagal menyimpan Log Error
			</div>';
		}
	}
	public function jsonPresensiPIPview(Request $request) {
        $mulai   	= $request->input('val01');
		$akhir  	= $request->input('val02');
		if ($akhir == ''){
			$getalldata = AbsenProgramPIP::where('idsekolah', Session('sekolah_id_sekolah'))->whereDate('created_at', 'LIKE', $mulai.'%')->get();
		} else {
			$getalldata = AbsenProgramPIP::where('idsekolah', Session('sekolah_id_sekolah'))->whereBetween('created_at', [$mulai, $akhir])->orderBy('created_at', 'ASC')->get();
		}
		
		$arrrekap	= [];
		if (!empty($getalldata)){
			foreach($getalldata as $rdata){
				$pejabat 	= $rdata->pejabat;
				$arrrekap[] = array(
					'nama' 		=> $rdata->nama,
					'kelas' 	=> $rdata->kelas,
					'tanggal' 	=> $rdata->created_at->tostring()
				);
			}
		}
		echo json_encode($arrrekap);
    }
	public function jsonDataprogramPIP() {
		$arrayruang = [];
		$jruang 	= ProgramPIP::where('idsekolah', Session('sekolah_id_sekolah'))->orderBy('nama', 'asc')->get();
    	foreach ($jruang as $result) {
			$arrayruang[] = array(
				'id' 				=> $result->id,
				'idsekolah' 		=> $result->idsekolah,
				'datamasuk' 		=> $result->datamasuk,
				'nama' 				=> $result->nama,
				'kelaslama' 		=> $result->kelaslama,
				'kelasbaru' 		=> $result->kelasbaru,
				'tahap' 			=> $result->tahap,
				'norek' 			=> $result->norek,
				'virtualacc' 		=> $result->virtualacc,
				'keterangan' 		=> $result->keterangan,
				'created_by' 		=> $result->created_by,
				'created_at' 		=> $result->created_at,
			);
			
    	}
    	echo json_encode($arrayruang);	
    }
}
