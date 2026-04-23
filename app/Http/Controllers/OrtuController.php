<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Dataindukstaff;
use App\Datainduk;
use App\Datapresensi;
use App\Datanilai;
use App\Layanan;
use App\Tabungan;
use App\Pembayaran;
use App\Ekstrakulikuler;
use App\Insidental;
use App\Setkuangan;
use App\Mushaflist;
use App\Datapelengkappsb;
use App\Datapresensiekskul;
use App\Rapotan;
use App\Beasiswa;
use App\Prestasi;
use App\Konseling;
use App\Datasetorantahfid;
use App\XFiles;
use App\KurikulumAlquran;
use App\TagihanManual;
use App\Datakkm;
use App\MushafUjian;
use App\MushafUjianLisan;
use Validator;
use Session;
use Carbon\Carbon;
function hitungRataRata($datarows, $prefix, $jenis) {
	if (!is_object($datarows)) {
        return 0; // Jika bukan objek, kembalikan 0
    }
    $nilai = [
        $datarows->{$prefix.$jenis.'1'} ?? 0,
        $datarows->{$prefix.$jenis.'2'} ?? 0,
        $datarows->{$prefix.$jenis.'3'} ?? 0,
        $datarows->{$prefix.$jenis.'4'} ?? 0,
        $datarows->{$prefix.$jenis.'5'} ?? 0
    ];
    $nilai = array_filter($nilai, function($value) {
        return $value !== null;
    });
    $jumlahNilai = count($nilai);
    return $jumlahNilai > 0 ? round(array_sum($nilai) / $jumlahNilai, 2) : 0;
}
class OrtuController extends Controller
{
	public function index() {
		$homebase				    = url("/");
		$data					    = [];
		if (Session('nama') !== null){
			$data['nama'] 			    = Session('nama'); 
			$data['sidebar'] 		    = 'biodata';
			$data['namaapps01']  		= config('global.Title2');
			$data['domainapps01']  		= config('global.singkatan');
			$data['subdomainapps01']  	= config('global.yayasan');
			$data['subsubdomainapps01'] = config('global.sekolah');
			$data['addressapps01']  	= config('global.alamat');
			$data['emailapps01']  		= config('global.email');
			$data['lamanapps01']  		= config('global.homeweb');
			$data['logofrontapps01']  	= config('global.logosimaster');
			$data['anakasuh']   		= Datainduk::where('is_asuh', '1')->whereNull('kodeortuasuh')->get();
			$data['datasiswa']			= Datainduk::where('kodeortu', Session('id'))->orWhere('kodeortuasuh', Session('email'))->get();
			return view('simaster.berandaanak', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
            return view('errors.notready', $data);
		}
	}
	public function viewDataPaguyuban() {
        $homebase				= 	url("/");
		$data					= 	[];	
		$data['nama'] 			= 	Session('nama'); 
		$data['sidebar'] 		= 	'dashboardpaguyuban';
		$urutanwerno			= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
        if (Session('spesial') == 'paguyuban'){
            $getdebet 		            = HPTKeuangan::select(DB::raw('SUM(pemasukan) as pemasukan'))->whereIn('jenis', ['Paguyuban', 'Ortu_Asuh', 'Bazar', 'Rihlah', 'Tahsin', 'Tabungan', 'Sedekah Rutin', 'Dana_Sosial'])->where('id_sekolah', subdomainapps03)->groupBy('id_sekolah')->first();
            if (isset($getdebet->pemasukan)){
                $totpemasukan	        = $getdebet->pemasukan;
            } else { $totpemasukan = 0 ;}
            $getkredit 		            = HPTKeuangan::select(DB::raw('SUM(pengeluaran) as pengeluaran'))->whereIn('jenis', ['Paguyuban', 'Ortu_Asuh', 'Bazar', 'Rihlah', 'Tahsin', 'Tabungan',  'Sedekah Rutin', 'Dana_Sosial'])->where('id_sekolah', subdomainapps03)->groupBy('id_sekolah')->first();
            if (isset($getkredit->pengeluaran)){
                $totpepengeluaran	    = $getkredit->pengeluaran;
            } else { $totpepengeluaran  = 0 ;}
            $saldoakhir = $totpemasukan - $totpepengeluaran;
			$groups     	= Pengumuman::where('jenis', 'ortu')->orderBy('id', 'DESC')->get();
			$y      		= 0;
			$x      		= 0;
			foreach ($groups as $group) {
				if ($x == 0){
					$setaktif = 'active';
				} else {
					$setaktif = '';
				}
				$gambar 	= $group->gambar;
				if ($gambar == ''){ $gambar = $homebase.'/logo/1643895019logo.png';}
				$data['pengumumans'][$x]['urutan']		=   $x;
				$data['pengumumans'][$x]['setaktif']  	=   $setaktif;
				$data['pengumumans'][$x]['id']       	=   $group->id;
				$data['pengumumans'][$x]['siapa']       =   $group->siapa;
				$data['pengumumans'][$x]['pengumuman']  =   $group->pengumuman;
				$data['pengumumans'][$x]['kapan']   	=   $group->kapan;
				$data['pengumumans'][$x]['gambar']   	=   $gambar;
				$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
				if ($y == 9) {
					$y = 0; 
				} else {
					$y++; 
				}
				$x++;
			}
			
            $data['danaterkumpul']      = number_format( $totpemasukan , 0 , '.' , ',' );
            $data['danaterserap']  		= number_format( $totpepengeluaran , 0 , '.' , ',' );
            $data['saldo']  		    = number_format( $saldoakhir , 0 , '.' , ',' );
			$data['namaapps01']  		= config('global.Title2');
			$data['domainapps01']  		= config('global.singkatan');
			$data['subdomainapps01']  	= config('global.yayasan');
			$data['subsubdomainapps01'] = config('global.sekolah');
			$data['addressapps01']  	= config('global.alamat');
			$data['emailapps01']  		= config('global.email');
			$data['lamanapps01']  		= config('global.homeweb');
			$data['logofrontapps01']  	= config('global.logosimaster');
			$data['pegawais']  	        = User::where('id_sekolah', subdomainapps03)->where('spesial', 'paguyuban')->get();
			return view('simaster.datapaguyuban', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman ini khusus kalangan tertentu, Hubungi Admin apabila ada kesalahan terkait ini';
            return view('errors.notready', $data);
		}
    }
	public function viewIjin() {
		$data   					= [];
		if (Session('nama') !== null){
			$iduser						= Session('id');
			$data['datasiswa']			= Datainduk::where('kodeortu', $iduser)->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			$data['tahunne']			= date("Y");
			$data['tanggal']			= date("Y-m-d");
			$data['sidebar']			= 'ijinortu';
			$data['namaapps01']  		= config('global.Title2');
			$data['domainapps01']  		= config('global.singkatan');
			$data['subdomainapps01']  	= config('global.yayasan');
			$data['subsubdomainapps01'] = config('global.sekolah');
			$data['addressapps01']  	= config('global.alamat');
			$data['emailapps01']  		= config('global.email');
			$data['lamanapps01']  		= config('global.homeweb');
			$data['logofrontapps01']  	= config('global.logosimaster');
			return view('simaster.ijinortu', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
            return view('errors.notready', $data);
		}
	}
	public function viewLapnilaiortu() {
		$data   			= [];
		if (Session('nama') !== null){
			$iduser				= Session('id');
			$data['datasiswa']	= Datainduk::where('kodeortu', $iduser)->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			$data['tahunne']	= date("Y");
			$data['tanggal']	= date("Y-m-d");
			$data['sidebar']	= 'lapnilaiortu';
			return view('simaster.lapnilaiortu', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
            return view('errors.notready', $data);
		}
	}
	public function viewKMS() {
		$urutanwerno		= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		$data   			= [];
		if (Session('nama') !== null){
			$iduser				= Session('id');
			$i 					= 0;
			$anak 				= 0;
			$sql				= Datainduk::where('kodeortu', $iduser)->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			if (!empty($sql)){
				foreach($sql as $rows){
					$foto 		= $rows->foto;
					if ($foto == '' OR is_null($foto)){
						$lampiran = url("/").'/'.Session('sekolah_logo');
					} else {
						if (Storage::disk('local')->exists('/dist/img/foto/' . $foto)) {
							$lampiran = url("/").'/dist/img/foto/'.$foto;
						} else {
							$lampiran = url("/").'/'.Session('sekolah_logo');
						}
					}
					$data['listanak'][$anak]['id']			=   $rows->id;
					$data['listanak'][$anak]['nama']		=   $rows->nama;
					$data['listanak'][$anak]['noinduk']		=   $rows->noinduk;
					$data['listanak'][$anak]['foto']		=   $lampiran;
					$anak++;
					$y 			= 0;
					$cekada 	= Datanilai::where('noinduk', $rows->noinduk)->where('id_sekolah', $rows->id_sekolah)->get();
					if (!empty($cekada)){
						foreach($cekada as $rada){
							$data['kmsdata'][$i]['id']			=   $rada->id;
							$data['kmsdata'][$i]['berat']		=   $rada->tema;
							$data['kmsdata'][$i]['tinggi']		=   $rada->subtema;
							$data['kmsdata'][$i]['lingkar']		=   $rada->nilai;
							$data['kmsdata'][$i]['vitamin']		=   $rada->deskripsi;
							$data['kmsdata'][$i]['nama']		=   $rows->nama;
							$data['kmsdata'][$i]['noinduk']		=   $rows->noinduk;
							$data['kmsdata'][$i]['tanggal']		=   $rada->tanggal;
							$data['kmsdata'][$i]['penginput']	=   $rada->penginput;
							$data['kmsdata'][$i]['foto']		=   $lampiran;
							$data['kmsdata'][$i]['urutanwerno'] =   $urutanwerno[$y];
							if ($y == 9) {
								$y = 0; 
							} else {
								$y++; 
							}
							$i++;
						}
					}
				}
			}
			$data['tahunne']	= date("Y");
			$data['tanggal']	= date("Y-m-d");
			$data['sidebar']	= 'kms';
			return view('simaster.kms', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
			$data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
			return view('errors.notready', $data);
		}
	}
	public function viewTagihanrutin() {
		$data   				= [];
		if (Session('nama') !== null){
			$iduser					= Session('id');
			$namabank 				= '';
			$norek 					= '';
			$namapdnorek 			= '';
			$sql 					= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
			if (!empty($sql)){
				foreach ($sql as $rlayanan){
					$status 		= $rlayanan->status;
					$layanan 		= $rlayanan->layanan;
					if ($layanan == 'namabank') { $namabank = $status; }
					if ($layanan == 'norek') { $norek = $status; }
					if ($layanan == 'namapdnorek') { $namapdnorek = $status; }
				}
			}
			$i 					= 0;
			$arrtagmanual 		= [];
			$getallsiswa		= Datainduk::where('kodeortu', $iduser)->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			if (!empty($getallsiswa)){
				foreach ($getallsiswa as $hasil) {
					$noinduk 		= $hasil->noinduk;
					$nama 			= $hasil->nama;
					$eksul1			= '';
					$eksul2			= '';
					$eksul3			= '';
					$eksul4			= '';
					$eksul5			= '';
					$biaya1			= 0;
					$biaya2			= 0;
					$biaya3			= 0;
					$biaya4			= 0;
					$biaya5			= 0;
					$spp 			= 0;
					$dpp 			= 0;
					$paguyuban 		= 0;
					$getdatakeu		= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($getdatakeu->spp)){
						$spp 		= number_format( $getdatakeu->spp , 0 , '.' , ',' );
						$dpp		= number_format( $getdatakeu->dpp , 0 , '.' , ',' );
						$paguyuban	= number_format( $getdatakeu->paguyuban , 0 , '.' , ',' );
						$eksul1 	= $getdatakeu->eksul1;
						$eksul2 	= $getdatakeu->eksul2;
						$eksul3 	= $getdatakeu->eksul3;
						$eksul4 	= $getdatakeu->eksul4;
						$eksul5 	= $getdatakeu->eksul5;
					}				
					if ($eksul1 != ''){
						$cekbiaya1	= Ekstrakulikuler::where('nama', $eksul1)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if (isset($cekbiaya1->biaya)){
							$biaya1	= $cekbiaya1->biaya;
						}
					}
					if ($eksul2 != ''){
						$cekbiaya2	= Ekstrakulikuler::where('nama', $eksul2)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if (isset($cekbiaya2->biaya)){
							$biaya2	= $cekbiaya2->biaya;
						}
					}
					if ($eksul3 != ''){
						$cekbiaya3	= Ekstrakulikuler::where('nama', $eksul3)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if (isset($cekbiaya3->biaya)){
							$biaya3	= $cekbiaya3->biaya;
						}
					}
					if ($eksul4 != ''){
						$cekbiaya4	= Ekstrakulikuler::where('nama', $eksul4)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if (isset($cekbiaya4->biaya)){
							$biaya4	= $cekbiaya4->biaya;
						}
					}
					if ($eksul5 != ''){
						$cekbiaya5	= Ekstrakulikuler::where('nama', $eksul5)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
						if (isset($cekbiaya5->biaya)){
							$biaya5	= $cekbiaya5->biaya;
						}
					}
					$data['listanak'][$i]['noinduk']	= $noinduk;
					$data['listanak'][$i]['dpp']		= $dpp;
					$data['listanak'][$i]['spp']		= $spp;
					$data['listanak'][$i]['paguyuban']	= $paguyuban;
					$data['listanak'][$i]['eksul1']		= $eksul1;
					$data['listanak'][$i]['biaya1']		= $biaya1;
					$data['listanak'][$i]['eksul2']		= $eksul2;
					$data['listanak'][$i]['biaya2']		= $biaya2;
					$data['listanak'][$i]['eksul3']		= $eksul3;
					$data['listanak'][$i]['biaya3']		= $biaya3;
					$data['listanak'][$i]['eksul4']		= $eksul4;
					$data['listanak'][$i]['biaya4']		= $biaya4;
					$data['listanak'][$i]['eksul5']		= $eksul5;
					$data['listanak'][$i]['biaya5']		= $biaya5;
					$data['listanak'][$i]['nama']		= $nama;
					$cektagihanmanual = TagihanManual::where('idsiswa', $hasil->id)->whereNull('marking')->get();
					if (!empty($cektagihanmanual)){
						foreach($cektagihanmanual as $tagmanual){
							$arrtagmanual[] 	= [
								'id' 					=> $tagmanual->id,
								'jenis' 				=> $tagmanual->jenis,
								'biaya' 				=> $tagmanual->biaya,
								'tenggat' 				=> $tagmanual->tenggat,	
								'nama' 					=> $hasil->nama,
							];
						}
					}
					$i++;
				}
			}
			if ($i == 0){
				$noinduk 		= '';
				$eksul1			= '';
				$eksul2			= '';
				$eksul3			= '';
				$eksul4			= '';
				$eksul5			= '';
				$biaya1			= 0;
				$biaya2			= 0;
				$biaya3			= 0;
				$biaya4			= 0;
				$biaya5			= 0;
				$spp 			= 0;
				$dpp 			= 0;
				$paguyuban 		= 0;
				$data['listanak'][$i]['noinduk']	= $noinduk;
				$data['listanak'][$i]['dpp']		= $dpp;
				$data['listanak'][$i]['spp']		= $spp;
				$data['listanak'][$i]['paguyuban']	= $paguyuban;
				$data['listanak'][$i]['eksul1']		= $eksul1;
				$data['listanak'][$i]['biaya1']		= $biaya1;
				$data['listanak'][$i]['eksul2']		= $eksul2;
				$data['listanak'][$i]['biaya2']		= $biaya2;
				$data['listanak'][$i]['eksul3']		= $eksul3;
				$data['listanak'][$i]['biaya3']		= $biaya3;
				$data['listanak'][$i]['eksul4']		= $eksul4;
				$data['listanak'][$i]['biaya4']		= $biaya4;
				$data['listanak'][$i]['eksul5']		= $eksul5;
				$data['listanak'][$i]['biaya5']		= $biaya5;
				$data['listanak'][$i]['nama']		= 'Tidak ada anak yang di set';
			}
			$datethn1 = date("Y"); //2016
			$datethn2 = $datethn1 + 1; //2017
			$datethn3 = $datethn1 - 1; //2015
			$datethn4 = $datethn1 - 2; //2014
			$datethn5 = $datethn1 - 3; //2013
			$data['tagihanmanuals']	= $arrtagmanual;
			$data['datethn1']		= $datethn1;
			$data['datethn2']		= $datethn2;
			$data['datethn3']		= $datethn3;
			$data['datethn4']		= $datethn4;
			$data['datethn5']		= $datethn5;
			$data['namabank']		= $namabank;
			$data['norek']			= $norek;
			$data['namapdnorek']	= $namapdnorek;
			$data['tahunne']		= date("Y");
			$data['tanggal']		= date("Y-m-d");
			$data['sidebar']		= 'tagihanrutin';
			return view('simaster.tagihanrutin', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
			$data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
			return view('errors.notready', $data);
		}
	}
	public function viewTabungan() {
		$data   					= [];
		if (Session('nama') !== null){
			$iduser						= Session('id');
			$data['datasiswa']			= Datainduk::where('kodeortu', $iduser)->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			$data['tahunne']			= date("Y");
			$data['tanggal']			= date("Y-m-d");
			$data['sidebar']			= 'tabungan';
			$data['namaapps01']  		= config('global.Title2');
			$data['domainapps01']  		= config('global.singkatan');
			$data['subdomainapps01']  	= config('global.yayasan');
			$data['subsubdomainapps01'] = config('global.sekolah');
			$data['addressapps01']  	= config('global.alamat');
			$data['emailapps01']  		= config('global.email');
			$data['lamanapps01']  		= config('global.homeweb');
			$data['logofrontapps01']  	= config('global.logosimaster');
			return view('simaster.tabungan', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
			$data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
			return view('errors.notready', $data);
		}
	}
	public function viewDaftarekskul() {
		$data   		            = [];
		if (Session('nama') !== null){
			$data['namaapps01']  		= config('global.Title2');
			$data['domainapps01']  		= config('global.singkatan');
			$data['subdomainapps01']  	= config('global.yayasan');
			$data['subsubdomainapps01'] = config('global.sekolah');
			$data['addressapps01']  	= config('global.alamat');
			$data['emailapps01']  		= config('global.email');
			$data['lamanapps01']  		= config('global.homeweb');
			$data['logofrontapps01']  	= config('global.logosimaster');
			$rstatus					= Layanan::where('id_sekolah', Session('sekolah_id_sekolah'))->where('layanan', 'daftarekskul')->first();
			if (isset($rstatus->status)){
				$ijin 					= $rstatus->status;
			} else { $ijin				= ''; }
			
			if ($ijin == 'mati' OR $ijin == '' OR $ijin == 'Ditutup'){
				$data['kalimatheader']  	= 'Mohon Maaf';
				$data['kalimatbody']  		= 'Pendaftaran Ekstrakulikuler Siswa Telah Selesai. Dan akan dibuka kembali saat awal semester depan.';
				return view('errors.notready', $data);
			} else {
				$iduser				        = Session('id');
				$data['datasiswa']	        = Datainduk::where('kodeortu', $iduser)->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
				$data['ekskul']		        = Ekstrakulikuler::where('status', 'aktif')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
				$data['tahunne']	        = date("Y");
				$data['tanggal']	        = date("Y-m-d");
				$data['ijin']		        = $ijin;
				$data['sidebar']	        = 'daftarekskul';
				return view('simaster.daftarekskul', $data);
			}
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
			$data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
			return view('errors.notready', $data);
		}
	}
	public function viewFaqihKecil() {
		$data 			= [];
		if (Session('nama') !== null){
			$tahun			= date("Y");
			$iduser			= Session('id');
			$homebase		= url('/');
			$getdatauser	= Datasetorantahfid::whereNotNull('tapel')->where('semester', '!=', '0')->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('updated_at', 'DESC')->first();
			if (isset($getdatauser->tapel)){
				$tapel 		= $getdatauser->tapel;
				$semester 	= $getdatauser->semester;
			} else {
				$tapel 		= '';
				$semester 	= '';
			}
			$x      		= 0;
			$i      		= 0;
			$gettugas		= Datainduk::where('kodeortu', $iduser)->orWhere('kodeortuasuh', Session('email'))->where('nokelulusan', '')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
			if (!empty($gettugas)){
				foreach($gettugas as $rtgs){
					$jilidanak	= $rtgs->jilid;
					$foto		= $rtgs->foto;
					if ($foto == '' OR $foto == null){
						$foto	= $homebase.'/'.Session('sekolah_logo');
					} else {
						$foto	= $homebase.'/dist/img/foto/'.$foto;
					}
					$ceklastdata 	= Datasetorantahfid::where('noinduk', $rtgs->noinduk)->where('id_sekolah',  Session('sekolah_id_sekolah'))->orderBy('tanggal', 'DESC')->first();
					if (isset($ceklastdata->id)){
						$tanggal				= $ceklastdata->tanggal;
						$ziyadah_mulaisurah		= $ceklastdata->ziyadah_mulaisurah;
						$ziyadah_mulaiayat		= $ceklastdata->ziyadah_mulaiayat;
						$ziyadah_akhirsurah		= $ceklastdata->ziyadah_akhirsurah;
						$ziyadah_akhirayat		= $ceklastdata->ziyadah_akhirayat;
						$murojaah_mulaisurah	= $ceklastdata->murojaah_mulaisurah;
						$murojaah_mulaiayat		= $ceklastdata->murojaah_mulaiayat;
						$murojaah_akhirsurah	= $ceklastdata->murojaah_akhirsurah;
						$murojaah_akhirayat		= $ceklastdata->murojaah_akhirayat;
						$tahsin_mulaisurah		= $ceklastdata->tahsin;
						$tilawah_mulaisurah		= $ceklastdata->tilawah_mulaisurah;
						$tilawah_mulaiayat		= $ceklastdata->tilawah_mulaiayat;
						$tilawah_akhirsurah		= $ceklastdata->tilawah_akhirsurah;
						$tilawah_akhirayat		= $ceklastdata->tilawah_akhirayat;
						$inputor				= $ceklastdata->inputor;
						$catatan				= $ceklastdata->catatan;
						$marking				= $ceklastdata->marking;
					} else {
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
						$inputor 				= '';
						$nilai 					= '';
						$kelulusan 				= '';
						$catatan 				= '';
					}

					$data['listanak'][$i]['id'] 					= $rtgs->id;
					$data['listanak'][$i]['nama'] 					= $rtgs->nama;
					$data['listanak'][$i]['noinduk'] 				= $rtgs->noinduk;
					$data['listanak'][$i]['klspos'] 				= $rtgs->klspos;
					$data['listanak'][$i]['jilid'] 					= $rtgs->jilid;
					$data['listanak'][$i]['foto'] 					= $foto;
					$data['listanak'][$i]['tanggal'] 				= $tanggal;
					$data['listanak'][$i]['ziyadah_mulaisurah'] 	= $ziyadah_mulaisurah;
					$data['listanak'][$i]['ziyadah_mulaiayat'] 		= $ziyadah_mulaiayat;
					$data['listanak'][$i]['ziyadah_akhirsurah'] 	= $ziyadah_akhirsurah;
					$data['listanak'][$i]['ziyadah_akhirayat'] 		= $ziyadah_akhirayat;
					$data['listanak'][$i]['murojaah_mulaisurah'] 	= $murojaah_mulaisurah;
					$data['listanak'][$i]['murojaah_mulaiayat'] 	= $murojaah_mulaiayat;
					$data['listanak'][$i]['murojaah_akhirsurah'] 	= $murojaah_akhirsurah;
					$data['listanak'][$i]['murojaah_akhirayat'] 	= $murojaah_akhirayat;
					$data['listanak'][$i]['tilawah_mulaisurah'] 	= $tilawah_mulaisurah;
					$data['listanak'][$i]['tilawah_mulaiayat'] 		= $tilawah_mulaiayat;
					$data['listanak'][$i]['tilawah_akhirsurah'] 	= $tilawah_akhirsurah;
					$data['listanak'][$i]['tilawah_akhirayat'] 		= $tilawah_akhirayat;
					$data['listanak'][$i]['tahsin_mulaisurah'] 		= $tahsin_mulaisurah;
					$data['listanak'][$i]['inputor'] 				= $inputor;
					$data['listanak'][$i]['catatan'] 				= $catatan;
					$cektgshariini	= KurikulumAlquran::where('realdate', date('Y-m-d'))->where('kelas', $jilidanak)->first();
					$data['listanak'][$i]['id'] 					= $cektgshariini->id ?? '';
					$data['listanak'][$i]['realdate'] 				= $cektgshariini->realdate ?? '';
					$data['listanak'][$i]['murojaahdirumah'] 		= $cektgshariini->murojaahdirumah ?? '';
					$data['listanak'][$i]['kelas'] 					= $cektgshariini->kelas ?? '';
					$data['listanak'][$i]['mendengaraudio'] 		= $cektgshariini->mendengaraudio ?? '';
					$data['listanak'][$i]['persiapanhafalanbesok'] 	= $cektgshariini->persiapanhafalanbesok ?? '';
					$data['listanak'][$i]['murojaahsabtuahad'] 		= $cektgshariini->murojaahsabtuahad ?? '';
					$data['listanak'][$i]['murojaahkemarin'] 		= $cektgshariini->murojaahkemarin ?? '';
					$data['listanak'][$i]['murojaahhariini'] 		= $cektgshariini->murojaahhariini ?? '';
					$data['listanak'][$i]['tahsin'] 				= $cektgshariini->tahsin ?? '';
					$data['listanak'][$i]['tilawah'] 				= $cektgshariini->tilawah ?? '';
					$i++;
				}
			}
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01'] = Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['tapel']				= $tapel;
			$data['semester']			= $semester;
			$data['jilid']				= '';
			$data['mushaflist']			= Mushaflist::all();
			$sidebar					= 'jilid';
			$data['sidebar']			= $sidebar;
			return view('simaster.faqih', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Session Expired, Mohon Bapak/Ibu Login Ulang di Laman Utama';
            return view('errors.notready', $data);
		}
    }
	public function exSimpanijin(Request $request) {
		$bulan 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$ttd 			= $request->val01;
		$inputor		= Session('nama');
		$noinduk 		= $request->val03;
		$tanggal 		= $request->val04;
		$selama 		= $request->val05;
		$alasan 		= $request->val06;
		$pemohon 		= $request->val07;
		$encoded_image 	= explode(",", $ttd)[1];
		$ahrg 			= explode("-", $tanggal);
		$huruf5			= $ahrg[0];
		$huruf6 		= (int)$ahrg[1];
		$huruf7 		= $ahrg[2];
		$huruf8 		= $bulan[$huruf6];
		$tlstanggal		= $huruf7.' '.$huruf8.' '.$huruf5;
		$suratijin		= '';
		if ($request->val02 !== null){
			$suratijin	= '<img style="margin:2px; margin-left: 10px;" width="100%" src="'.$request->val02.'">';
		}
		$ceksudah		= Datapresensi::where('noinduk', $noinduk)->where('tanggal', $tanggal)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
		if ($ceksudah == 0){
			$rmaster = Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rmaster->nama)){
				$nama 			= $rmaster->nama;
				$klspos			= $rmaster->klspos;
				$namaayah		= $rmaster->namaayah;
				$namaibu		= $rmaster->namaibu;
				$alamatortu		= $rmaster->alamatortu;
				$kolomttd 		= '
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(data:image/png;base64,'.$encoded_image.') no-repeat; background-position: 5px 40px; background-size: 240px 100px;"> 
										<tr><td>&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
										<tr>
										<td>&nbsp;</td>
										<td>Malang, '.$tlstanggal.'<br />Orang Tua / Wali</td>
										</tr>          
										<tr><td height="39">&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
										<tr><td>&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
										<tr>
										<td>&nbsp;</td>
										<td>'.$pemohon.'</td>
										</tr>        
									</table>';
				$tabele			= '
									<table id="printiki" width="800" cellpadding="0" cellspacing="0">
										<col width="64" span="9" />
										<tr>
										<td width="35"></td>
										<td width="224"></td>
										<td width="14"></td>
										<td width="205"></td>
										<td width="198"></td>
										<td width="115"></td>
										</tr>
										<tr>
										<td colspan="6" align="left">&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="center" style="font-size:24px"><strong>SURAT IJIN TIDAK MASUK SEKOLAH</strong></td>
										</tr>  
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="left" ><strong>Dengan ini saya orang tua / wali atas siswa : </strong></td>
										</tr>
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td align="center">1.</td>
										<td>Nama</td>
										<td>: </td>
										<td colspan="3">'.$nama.'</td>
										</tr>
										<tr>
										<td align="center">2.</td>
										<td>No.Induk </td>
										<td>:</td>
										<td colspan="3">'.$noinduk.'</td>
										</tr> 
										<tr>
										<td align="center">3.</td>
										<td>Kelas</td>
										<td>:</td>
										<td colspan="3">'.$klspos.'</td>
										</tr>
										<tr>
										<td align="center"  valign="top">4.</td>
										<td  valign="top">Nama Orang Tua</td>
										<td  valign="top">:</td>
										<td colspan="3"  valign="top">'.$namaayah.' / '.$namaibu.'</td>
										</tr>
										<tr>
										<td align="center"  valign="top">5.</td>
										<td valign="top">Alamat Orang Tua</td>
										<td valign="top">:</td>
										<td colspan="3" valign="top">'.$alamatortu.'</td>
										</tr>
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="justify">Memohon dengan hormat untuk diijinkan anak kami untuk tidak masuk sekolah mulai tanggal '.$tlstanggal.' Selama '.$selama.' hari, dengan alasan '.$alasan.'</strong></td>
										</tr>
										<tr>
										<td align="center">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="left" valign="middle">&nbsp;</td>
										<td align="left" valign="middle">&nbsp;</td>
										<td align="left" valign="middle">&nbsp;</td>
										</tr>
										<tr>
											<td align="center">&nbsp;</td>
											<td>&nbsp;</td>   
											<td colspan="3" align="left" valign="top">'.$kolomttd.'</td>
										</tr>'.$suratijin.'
									</table>';
				$marking 		= $noinduk.$tanggal.$klspos;
				$update			= Datapresensi::create([
					'tanggal'	=> $tanggal, 
					'noinduk'	=> $noinduk, 
					'tapel'		=> '', 
					'kelas'		=> $klspos, 
					'status'	=> '2', 
					'alasan'	=> $alasan, 
					'selama'	=> $selama, 
					'surat'		=> $tabele, 
					'petugas'	=> $inputor, 
					'marking'	=> $marking,
					'id_sekolah'=> session('sekolah_id_sekolah')
				]);
				if ($update){
					$tuliskirim = 'Ijin an. '.$nama.' Kelas '.$klspos.' Tanggal '.$tanggal.' Alasan '.$alasan;
						$listpaket 	= User::where('klsajar', $klspos)->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
						if (!empty($listpaket)){
							foreach($listpaket as $rows){
								SendMail::mobilenotif($rows->nip,'perseorangan',$rows->nama,$tuliskirim);
								Notification::send($rows, new NewMessageNotification($tuliskirim));
							}
						}
					echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Ijin Dari Orang Tua Telah di Tersimpan
						</div>';
				} else { 
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
					Data Siswa Tidak di Temukan
					</div>'; 
			}
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Error!</h4>
			Data Presensi Telah Tersimpan Untuk ananda di tanggal '.$tlstanggal.'
			</div>'; 
		}
	}
	public function exSimpanmhnremidi(Request $request) {
		$bulan 			= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$ttd 			= $request->val01;
		$inputor		= Session('nama');
		$noinduk 		= $request->val03;
		$jenis 			= $request->val04;
		$idnilai 		= $request->val05;
		$alasan 		= $request->val06;
		$pemohon 		= $request->val07;
		$encoded_image 	= explode(",", $ttd)[1];
		$tanggal		= date('Y-m-d');
		$ahrg 			= explode("-", $tanggal);
		$huruf5			= $ahrg[0];
		$huruf6 		= (int)$ahrg[1];
		$huruf7 		= $ahrg[2];
		$huruf8 		= $bulan[$huruf6];
		$tlstanggal		= $huruf7.' '.$huruf8.' '.$huruf5;
		$cekdata		= Datanilai::where('id', $idnilai)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
		if ($cekdata != 0){
			$rmaster = Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rmaster->nama)){
				$nama 			= $rmaster->nama;
				$klspos			= $rmaster->klspos;
				$namaayah		= $rmaster->namaayah;
				$namaibu		= $rmaster->namaibu;
				$hape			= $rmaster->hape;
				$telpon			= $rmaster->telpon;
				$hasil			= Datanilai::where('id', $idnilai)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				$nilai 			= $hasil->nilai;
				$tema 			= $hasil->tema;
				$subtema 		= $hasil->subtema;
				$kodekd 		= $hasil->kodekd;
				$matpel 		= $hasil->matpel;
				$semester 		= $hasil->semester;
				$noinduk 		= $hasil->noinduk;
				$keterangan		= $hasil->keterangan;
				if ($keterangan == ''){
					$kolomttd 	= '
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(data:image/png;base64,'.$encoded_image.') no-repeat; background-position: 5px 40px; background-size: 240px 100px;"> 
										<tr><td>&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
										<tr>
										<td>&nbsp;</td>
										<td>Malang, '.$tlstanggal.'<br />Orang Tua / Wali</td>
										</tr>          
										<tr><td height="39">&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
										<tr><td>&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
										<tr>
										<td>&nbsp;</td>
										<td>'.$pemohon.'</td>
										</tr>        
									</table>';
					$tabele		= '
									<table id="printiki" width="800" cellpadding="0" cellspacing="0">
										<col width="64" span="9" />
										<tr>
										<td width="35"></td>
										<td width="224"></td>
										<td width="14"></td>
										<td width="205"></td>
										<td width="198"></td>
										<td width="115"></td>
										</tr>
										<tr>
										<td colspan="6" align="left">&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="center" style="font-size:24px"><strong>SURAT PERMOHONAN REMIDI NILAI</strong></td>
										</tr>  
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="left" ><strong>Dengan ini saya orang tua / wali atas siswa : </strong></td>
										</tr>
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td align="center">1.</td>
										<td>Nama</td>
										<td>: </td>
										<td colspan="3">'.$nama.'</td>
										</tr>
										<tr>
										<td align="center">2.</td>
										<td>No.Induk </td>
										<td>:</td>
										<td colspan="3">'.$noinduk.'</td>
										</tr> 
										<tr>
										<td align="center">3.</td>
										<td>Kelas</td>
										<td>:</td>
										<td colspan="3">'.$klspos.'</td>
										</tr>
										<tr>
										<td align="center"  valign="top">4.</td>
										<td  valign="top">Nama Orang Tua</td>
										<td  valign="top">:</td>
										<td colspan="3"  valign="top">'.$namaayah.' / '.$namaibu.'</td>
										</tr>
										<tr>
										<td align="center"  valign="top">5.</td>
										<td valign="top">No. Telpon / HP</td>
										<td valign="top">:</td>
										<td colspan="3" valign="top">'.$telpon.' / '.$hape.'</td>
										</tr>
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="justify">Memohon dengan hormat untuk diijinkan anak kami untuk merevisi nilai :</strong></td>
										</tr>
										<tr>
										<td align="center">1.</td>
										<td>Tema / Sub Tema / Kode KD</td>
										<td>: </td>
										<td colspan="3">'.$tema.' / '.$subtema.' / '.$kodekd.'</td>
										</tr>
										<tr>
										<td align="center">2.</td>
										<td>Matapelajar</td>
										<td>:</td>
										<td colspan="3">'.$matpel.'</td>
										</tr> 
										<tr>
										<td align="center">3.</td>
										<td>Jenis / Tanggal Penilaian</td>
										<td>:</td>
										<td colspan="3">'.$hasil->jennilai.' / '.$hasil->tanggal.'</td>
										</tr>
										<tr>
										<td colspan="6" align="left" >&nbsp;</td>
										</tr>
										<tr>
										<td colspan="6" align="justify">dengan pertimbangan : '.$alasan.'. <br />Demikan permohonan ini kami buat, atas bantuan dan kerjasamanya kami ucapkan terima kasih.</strong></td>
										</tr>
										<tr>
										<td align="center">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="left" valign="middle">&nbsp;</td>
										<td align="left" valign="middle">&nbsp;</td>
										<td align="left" valign="middle">&nbsp;</td>
										</tr>
										<tr>
										<td align="center">&nbsp;</td>
										<td>&nbsp;</td>   
										<td colspan="3" align="left" valign="top">'.$kolomttd.'</td>
										</tr>
									</table>';
					$update 	= Datanilai::where('id', $idnilai)->where('id_sekolah',session('sekolah_id_sekolah'))->update([						
						'surat'			=> $tabele, 
						'keterangan'	=> '<font color="yellow">Permohonan Remidi Telah di Ajukan</font>', 
					]);
					if ($update){
						$tuliskirim = 'Pengajuan Remidi Nilai '.$matpel.' Kode '.$kodekd.' an. '.$nama.' Kelas '.$klspos;
						$listpaket 	= User::where('klsajar', $klspos)->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
						if (!empty($listpaket)){
							foreach($listpaket as $rows){
								SendMail::mobilenotif($rows->nip,'perseorangan',$rows->nama,$tuliskirim);
								Notification::send($rows, new NewMessageNotification($tuliskirim));
							}
						}
						echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Sukses!</h4>
									Permohonan Remidi Telah di ajukan, mohon bersabar menunggu persetujuan dari Guru yang bersangkutan. <br />Catatan : Surat ini hanya berupa permohonan, dan keputusan boleh dan tidaknya nilai ini diremidi berada pada Bapak/Ibu '.$hasil->penginput.' sebagai penanggung jawab nilai tersebut.<br />Anda dapat melihat status permohonan ini di halaman ini juga di kolom keterangan.
								</div>';
					} else { 
						echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
								Sistem Down, Silahkan Coba Beberapa Saat Lagi
							</div>'; 
					}
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
							Permohonan remidi untuk nilai ini sudah ada dan tidak bisa di mintakan kembali
						</div>'; 
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
						Data Siswa Tidak di Temukan
					</div>'; 
			}
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
					Ujian ini telah dibatalkan
				</div>'; 
		}
	}
	public function jsonNilaisiswa() {
		$arrrekap 	= [];
		$kodeortu	= Session('id');
		$sql	    = Datainduk::where('kodeortu', $kodeortu)->orWhere('kodeortuasuh', Session('email'))->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rjeneng) {
				$noinduk 		= $rjeneng->noinduk;
				$klspos 		= $rjeneng->klspos;
				$rdata 			= Datanilai::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
				if (!empty($rdata)){
					foreach ($rdata as $hasil) {			
						$nilai 		= $hasil->nilai;
						$tema 		= $hasil->tema;
						$subtema 	= $hasil->subtema;
						$kodekd 	= $hasil->kodekd;
						$matpel 	= $hasil->matpel;
						$semester 	= $hasil->semester;
						$noinduk 	= $hasil->noinduk;
						$kelas 		= $hasil->kelas;
						$tapel 		= $hasil->tapel;
						if($semester == 1){ $smt = 'Ganjil'; }
						else { $smt = 'Genap'; }
						$total		= 0;
						$bayak		= 0;
						$cekrata	= Datanilai::select(DB::raw('SUM(nilai) as allnil'), DB::raw('COUNT(id) as allsiswa'))
										->where('kelas', $kelas)
										->where('tapel', $tapel)
										->where('tema', $tema)
										->where('subtema', $subtema)
										->where('matpel', $matpel)
										->where('kodekd', $kodekd)
										->where('id_sekolah',session('sekolah_id_sekolah'))
										->groupBy('kodekd')->orderBy('kodekd', 'DESC')->first();
						if (isset($cekrata->allnil)){
							$total	= $cekrata->allnil;
							$bayak	= $cekrata->allsiswa;
						}
						if ($total != 0){
							$ratakelas  = round(($total / $bayak),2);
						} else {
							$ratakelas	= 0;
						}
						$arrrekap[] = array(
							'id' 			=> $hasil->id,
							'nama' 			=> $hasil->nama,
							'noinduk' 		=> $hasil->noinduk,
							'kelas'			=> $kelas,
							'tapel'			=> $tapel,
							'semester'		=> $smt,
							'tema'			=> $tema,
							'subtema'		=> $subtema,
							'kodekd'		=> $kodekd,
							'matpel'		=> $matpel,
							'nilai'			=> $nilai,
							'ratakelas'		=> $ratakelas,
							'deskripsi'		=> $hasil->deskripsi,
							'guru'			=> $hasil->penginput,
							'tanggal'		=> $hasil->tanggal,
							'jennilai'		=> $hasil->jennilai,
						);
					}
				}
			}
		}
		if (Session('email') !== null){
			$getallsiswa 	= Datainduk::where('kodeortuasuh', Session('email'))->orderBy('noinduk', 'DESC')->get();
			if (!empty($getallsiswa)){
				foreach ($getallsiswa as $rjeneng) {
					$noinduk 		= $rjeneng->noinduk;
					$klspos 		= $rjeneng->klspos;
					$rdata 			= Datanilai::where('noinduk', $noinduk)->where('id_sekolah',$rjeneng->id_sekolah)->orderBy('id', 'DESC')->get();
					if (!empty($rdata)){
						foreach ($rdata as $hasil) {			
							$nilai 		= $hasil->nilai;
							$tema 		= $hasil->tema;
							$subtema 	= $hasil->subtema;
							$kodekd 	= $hasil->kodekd;
							$matpel 	= $hasil->matpel;
							$semester 	= $hasil->semester;
							$noinduk 	= $hasil->noinduk;
							$kelas 		= $hasil->kelas;
							$tapel 		= $hasil->tapel;
							if($semester == 1){ $smt = 'Ganjil'; }
							else { $smt = 'Genap'; }
							$total		= 0;
							$bayak		= 0;
							$cekrata	= Datanilai::select(DB::raw('SUM(nilai) as allnil'), DB::raw('COUNT(id) as allsiswa'))
											->where('kelas', $kelas)
											->where('tapel', $tapel)
											->where('tema', $tema)
											->where('subtema', $subtema)
											->where('matpel', $matpel)
											->where('kodekd', $kodekd)
											->where('id_sekolah', $hasil->id_sekolah)
											->groupBy('kodekd')->orderBy('kodekd', 'DESC')->first();
							if (isset($cekrata->allnil)){
								$total	= $cekrata->allnil;
								$bayak	= $cekrata->allsiswa;
							}
							if ($total != 0){
								$ratakelas  = round(($total / $bayak),2);
							} else {
								$ratakelas	= 0;
							}
							$arrrekap[] = array(
								'id' 			=> $hasil->id,
								'nama' 			=> $hasil->nama,
								'noinduk' 		=> $hasil->noinduk,
								'kelas'			=> $kelas,
								'tapel'			=> $tapel,
								'semester'		=> $smt,
								'tema'			=> $tema,
								'subtema'		=> $subtema,
								'kodekd'		=> $kodekd,
								'matpel'		=> $matpel,
								'nilai'			=> $nilai,
								'ratakelas'		=> $ratakelas,
								'guru'			=> $hasil->penginput,
								'tanggal'		=> $hasil->tanggal,
								'jennilai'		=> $hasil->jennilai,
							);
						}
					}
				}
			}
		}
		echo json_encode($arrrekap);
	}
	public function exUploadbuktibyr(Request $request) {
		$marking 	= $request->val01;
		$foto		= $request->val02;
		if ($foto != ''){
			$update = XFiles::where('xmarking', $marking)->update([
				'xfile' => $foto
			]);
			if ($update){
				$tuliskirim = 'Pembayaran Sekolah di laporkan wali santri, mohon bantuan untuk verifikasi';
				$listpaket 	= User::where('previlage', 'level5')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
				if (!empty($listpaket)){
					foreach($listpaket as $rows){
						SendMail::mobilenotif($rows->nip,'perseorangan',$rows->nama,$tuliskirim);
						Notification::send($rows, new NewMessageNotification($tuliskirim));
					}
				}
				echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					Upload Bukti Sukses, Mohon Pantau Terus Box Riwayat Pembayaran Untuk Melihat Bahwa Telah Terverifikasi Oleh Staf TU
					</div>';
			} else { 
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Mohon Upload Foto Bukti Pembayaran Anda Dengan Benar
					</div>'; 
			}
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
				Mohon Upload Foto Bukti Pembayaran Anda Dengan Benar
				</div>'; 
		}
	}
	public function exBayariuran(Request $request) {
		$noinduk	= $request->val01;
		$bulan		= $request->val02;
		$tahun		= $request->val03;
		$inputor	= $request->val04;
		$setbayar	= $request->val05;
		$dpp		= $request->val06;
		$paguyuban	= $request->val07;
		if ($dpp == 0){ $dpp = ''; }
		if ($paguyuban == 0){ $paguyuban = ''; }
		
		if ($noinduk != ''  and $bulan != '' and $tahun != ''){
			$qcarijeneng	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			$nama			= $qcarijeneng->nama;
			if (isset($qcarijeneng->klspos)){
				$klspos			= $qcarijeneng->klspos;
			} else { $klspos = ''; }
			$dino 			= date("d");
			$wulan 			= date("m");
			$yers 			= date("Y");
			$marking 		= session('sekolah_id_sekolah').'-'.$noinduk.$dino.$bulan.$tahun;
			$dinoan 		= $dino.$wulan.$yers;
			$statusinput	= '';
			$totalbayar		= 0;
			$rdetail		= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($rdetail->nama)){
				$spp		= $rdetail->spp;
				$neksul1	= $rdetail->eksul1;
				$neksul2	= $rdetail->eksul2;
				$neksul3	= $rdetail->eksul3;
				$neksul4	= $rdetail->eksul4;
				$neksul5	= $rdetail->eksul5;
			} else { 
				$spp		= '';
				$neksul1	= '';
				$neksul2	= '';
				$neksul3	= '';
				$neksul4	= '';
				$neksul5	= '';
			}
			if ($spp != '' AND $setbayar != 'eksulsaja'){
				$cekdahbyr1		= Pembayaran::where('jenis', 'spp')->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('biaya', $spp)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr1 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar SPP Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
					$spp 		= str_replace(',','',$spp);
					$cekmasuk	= Pembayaran::where('jenis', 'spp')->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama, 
							'noinduk'	=> $noinduk, 
							'kelas'		=> $klspos, 
							'jenis'		=> 'spp', 
							'biaya'		=> $spp, 
							'bulan'		=> $bulan, 
							'tahun'		=> $tahun, 
							'verifikasi'=> '', 
							'marking'	=> $marking, 
							'harian'	=> $dinoan, 
							'inputor'	=> Session('nama'), 
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $spp;
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input SPP an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$spp.'</font>';
						} else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran SPP an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$spp.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran SPP Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($dpp != '' AND $setbayar != 'eksulsaja'){
				$cekdahbyr2		= Pembayaran::where('jenis', 'dpp')->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('biaya', $dpp)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr2 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar DPP Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
					$dpp 		= str_replace(',','',$dpp);
					$cekmasuk		= Pembayaran::where('jenis', 'dpp')->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama, 
							'noinduk'	=> $noinduk, 
							'kelas'		=> $klspos, 
							'jenis'		=> 'dpp', 
							'biaya'		=> $dpp, 
							'bulan'		=> $bulan, 
							'tahun'		=> $tahun, 
							'verifikasi'=> '', 
							'marking'	=> $marking, 
							'harian'	=> $dinoan, 
							'inputor'	=> Session('nama'), 
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $dpp;
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input DPP an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$dpp.'</font>';
						} else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran DPP an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$dpp.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran DPP Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($paguyuban != '' AND $setbayar != 'eksulsaja'){
				$cekdahbyr2		= Pembayaran::where('jenis', 'Uang Makan')->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('biaya', $paguyuban)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr2 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar Uang Makan Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
					$paguyuban 		= str_replace(',','',$paguyuban);
					$cekmasuk		= Pembayaran::where('jenis', 'Uang Makan')->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama, 
							'noinduk'	=> $noinduk, 
							'kelas'		=> $klspos, 
							'jenis'		=> 'Uang Makan', 
							'biaya'		=> $paguyuban, 
							'bulan'		=> $bulan, 
							'tahun'		=> $tahun, 
							'verifikasi'=> '', 
							'marking'	=> $marking, 
							'harian'	=> $dinoan, 
							'inputor'	=> Session('nama'), 
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $paguyuban;
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Uang Makan an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$paguyuban.'</font>';
						} else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Uang Makan an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$paguyuban.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Uang Makan Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul1 != '' AND $setbayar != 'sppsaja'){
				$getbiaya1		= Ekstrakulikuler::where('nama', $neksul1)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getbiaya1->biaya)){
					$eksul1		= $getbiaya1->biaya;
				} else { $eksul1= 0; }
				$cekdahbyr3		= Pembayaran::where('jenis', $neksul1)->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('biaya', $eksul1)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr3 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul1.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
					$eksul1   	= str_replace(',','',$eksul1);
					$cekmasuk	= Pembayaran::where('jenis', $neksul1)->where('bulan', $bulan)->where('tahun', $tahun)->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
					if ($cekmasuk == 0){
						$bayar	= Pembayaran::create([
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'kelas'		=> $klspos,
							'jenis'		=> $neksul1,
							'biaya'		=> $eksul1,
							'bulan'		=> $bulan,
							'tahun'		=> $tahun,
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $eksul1;
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Ektrakulikuler '.$neksul1.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul1.'</font>';
						} else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Ektrakulikuler '.$neksul1.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul1.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Ektrakulikuler '.$neksul1.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul2 != '' AND $setbayar != 'sppsaja'){
				$getbiaya2		= Ekstrakulikuler::where('nama', $neksul2)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getbiaya2->biaya)){
					$eksul2			= $getbiaya2->biaya;
				} else { $eksul2 	= 0; }
				$cekdahbyr4		= Pembayaran::where('jenis', $neksul2)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $eksul2)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr4 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul2.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
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
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $eksul2;
							$statusinput = $statusinput.'<br /><font color=green>Sukses Input Ektrakulikuler '.$neksul2.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul2.'</font>';
						} else {
							$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Ektrakulikuler '.$neksul2.' an. '.$nama.'  Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$eksul2.' Silahkan coba beberapa saat lagi</font>';
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Data Pembayaran Ektrakulikuler '.$neksul2.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.' sudah ada</font>'; 
					}
				}
			}
			if ($neksul3 != '' AND $setbayar != 'sppsaja'){
				$getbiaya3		= Ekstrakulikuler::where('nama', $neksul3)->first();
				if (isset($getbiaya3->biaya)){
					$eksul3			= $getbiaya3->biaya;
				} else { $eksul3 	= 0; }
				$cekdahbyr5		= Pembayaran::where('jenis', $neksul3)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $eksul3)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr5 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul3.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
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
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $eksul3;
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
			if ($neksul4 != '' AND $setbayar != 'sppsaja'){
				$getbiaya4		= Ekstrakulikuler::where('nama', $neksul4)->first();
				if (isset($getbiaya4->biaya)){
					$eksul4			= $getbiaya4->biaya;
				} else { $eksul4 	= 0; }
				$cekdahbyr6		= Pembayaran::where('jenis', $neksul4)
									->where('bulan', $bulan)
									->where('tahun', $tahun)
									->where('noinduk', $noinduk)
									->where('biaya', $eksul4)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr6 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul4.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
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
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $eksul4;
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
			if ($neksul5 != '' AND $setbayar != 'sppsaja'){
				$getbiaya5		= Ekstrakulikuler::where('nama', $neksul5)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getbiaya5->biaya)){
					$eksul5			= $getbiaya5->biaya;
				} else { $eksul5 	= 0; }
				$cekdahbyr7	= Pembayaran::where('jenis', $neksul5)
								->where('bulan', $bulan)
								->where('tahun', $tahun)
								->where('noinduk', $noinduk)
								->where('biaya', $eksul5)->where('id_sekolah',session('sekolah_id_sekolah'))->count();
				if ($cekdahbyr7 != 0){
					$statusinput = $statusinput.'<br /><font color=red>Telah Bayar '.$neksul5.' Untuk Bulan '.$bulan.' Tahun '.$tahun.' an. '.$nama.'</font>'; 
				} else {
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
							'verifikasi'=> '',
							'marking'	=> $marking,
							'harian'	=> $dinoan,
							'inputor'	=> Session('nama'),
							'id_sekolah'=> session('sekolah_id_sekolah')
						]);
						if ($bayar){
							$totalbayar	 = $totalbayar + $eksul5;
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
			$cekmasukxfile = XFiles::where('xmarking', $marking)->count();
			if ($cekmasukxfile == 0){
				XFiles::create([
					'xmarking'	=> $marking,
					'xtabel'	=> 'db_pembayaran',
					'xjenis'	=> Session('sekolah_id_sekolah').';'.$noinduk,
					'xfile'		=> ''
				]);
			}
			$totalbayar = number_format( $totalbayar , 0 , '.' , ',' );
			echo '<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Input Sukses!</h4>
						Pembayaran Rutin :<br />  '.$statusinput.' Silahkan anda mentransfer uang sejumlah Rp. '.$totalbayar.',- ke Nomor Rekening yang tertera di halaman muka.
						</div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
				Pastikan Formnya Anda Isi dengan Lengkap
				</div>';		
		}
	}
	public function exBayariuranins(Request $request) {
		$bulan		= $request->val01;
		$tahun		= $request->val02;
		$biaya		= $request->val03;
		$kode		= $request->val04;
		$noinduk	= $request->val05;
		$inputor	= $request->val06;
		if ($noinduk != ''  and $kode != '' and $biaya != '' and $bulan != '' and $tahun != ''){
			$biaya 			= str_replace(',','',$biaya);
			$qcarijeneng	= Datainduk::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($qcarijeneng->klspos)){
				$klspos		= $qcarijeneng->klspos;
				$nama		= $qcarijeneng->nama;
			} else { $klspos = ''; $nama = ''; }
			if ($nama == ''){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						No.Induk '.$noinduk.' Belum di Setting Data Keuangan
						</div>';
			} else {
				$statusinput= '';
				$dino 		= date("d");
				$wulan 		= date("m");
				$yers 		= date("Y");
				$marking 	= session('sekolah_id_sekolah').'-'.$noinduk.$dino.$bulan.$tahun;
				$dinoan 	= $dino.$wulan.$yers;
				$getdesk	= Insidental::where('kode', $kode)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getdesk->deskripsi)){
					$deskripsi = $getdesk->deskripsi;
				} else { $deskripsi = ''; }
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
						'verifikasi'=> '',
						'marking'	=> $marking,
						'harian'	=> $dinoan,
						'inputor'	=> Session('nama'),
						'id_sekolah'=>session('sekolah_id_sekolah')
					]);
					if ($bayar){
						$statusinput = $statusinput.'<br /><font color=green>Sukses Input Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.'</font>';
						$tuliskirim = $statusinput;
						$listpaket 	= User::where('previlage', 'level5')->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
						if (!empty($listpaket)){
							foreach($listpaket as $rows){
								SendMail::mobilenotif($rows->nip,'perseorangan',$rows->nama,$tuliskirim);
								Notification::send($rows, new NewMessageNotification($tuliskirim));
							}
						}
					} else {
						$statusinput = $statusinput.'<br /><font color=red>Gagal Input Pembayaran Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Silahkan coba beberapa saat lagi</font>';
					}
				} else {
					$statusinput = $statusinput.'<br /><font color=red>Insidental '.$deskripsi.' an. '.$nama.' Bulan '.$bulan.' Tahun '.$tahun.' Sejumlah '.$biaya.' Sudah Di bayar</font>';
				}
				echo '<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Input Sukses!</h4>
						Pembayaran Status :<br />  '.$statusinput.' Silahkan anda mentransfer uang sejumlah Rp. '.$request->val03.',- ke Nomor Rekening yang tertera di halaman muka.
						</div>';
			}
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Error!</h4>
			Pastikan Formnya Anda Isi dengan Lengkap
			</div>';
		}
	}
	public function jsonInsidental() {
		$arrrekap 	= [];
		$kodeortu	= Session('id');
		$sql	    = Datainduk::where('kodeortu', $kodeortu)->orWhere('kodeortuasuh', Session('email'))->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rjeneng) {
				$noinduk 		= $rjeneng->noinduk;
				$klspos 		= $rjeneng->klspos;
				$nama 			= $rjeneng->nama;
				$idsetkeu		= 0;
				$qcarijeneng	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($qcarijeneng->klspos)){
					$dpp		= $qcarijeneng->dpp;
					$idsetkeu 	= $qcarijeneng->id;
				} else { $dpp = 0; }
				if ($dpp != 0) {
					$cekmasuk	= Pembayaran::select(DB::raw('SUM(biaya) as biaya'))
									->where('noinduk', $noinduk)
									->where('jenis', 'dpp')
									->where('verifikasi', '!=', '')
									->where('id_sekolah',session('sekolah_id_sekolah'))
									->groupBy('jenis')->first();
					if(isset($cekmasuk->biaya)){
						$bayardpp = $cekmasuk->biaya;
					} else {
						$bayardpp = 0;
					}
					$sisadpp		= $dpp - $bayardpp;
					if ($idsetkeu != 0 AND $sisadpp == 0){
						Setkuangan::where('id', $idsetkeu)->update([
							'dpp' => 0
						]);
					}
				} else { $sisadpp = 0; }
				
				if ($sisadpp != 0){
					$arrrekap[] = array(
						'no' 		=> $rjeneng->id,
						'kode'		=> 'dpp',
						'noinduk'	=> $noinduk,
						'deskripsi'	=> 'Kekurangan DPP an. '.$nama,
						'biaya'		=> number_format( $sisadpp , 0 , '.' , ',' ),
					);
				}
				
				$getaktifinsidental = Insidental::where('aktifasi', 'aktif')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
				if (!empty($getaktifinsidental)){
					foreach ($getaktifinsidental as $hasil) {
						$deskripsi2 = $hasil->deskripsi.' Untuk Ananda '.$nama;
						$cekbayar	= Pembayaran::select(DB::raw('SUM(biaya) as biaya'))
									->where('noinduk', $noinduk)
									->where('jenis', $hasil->kode)
									->where('verifikasi', '!=', '')
									->where('id_sekolah',session('sekolah_id_sekolah'))
									->groupBy('jenis')->first();
						if(isset($cekbayar->biaya)){
							$bayarkode = $cekbayar->biaya;
						} else {
							$bayarkode = 0;
						}
						$sisabyrkode 	= $hasil->biaya - $bayarkode;	
						if ($sisabyrkode != 0){
							$arrrekap[] = array(
								'no' 		=> $rjeneng->id,
								'kode'		=> $hasil->kode,
								'noinduk'	=> $noinduk,
								'deskripsi'	=> $deskripsi2,
								'biaya'		=> number_format( $sisabyrkode , 0 , '.' , ',' ),
							);
						}
					}
				}
			}
		}
		echo json_encode($arrrekap);
	}
	public function jsonDatabayarortu() {
		$arrrekap 	= [];
		$kodeortu	= Session('id');
		$sql	    = Datainduk::where('kodeortu', $kodeortu)->orWhere('kodeortuasuh', Session('email'))->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rjeneng) {
				$noinduk 	= $rjeneng->noinduk;
				$klspos 	= $rjeneng->klspos;
				$nama 		= $rjeneng->nama;
				$sql 		= Pembayaran::select(DB::raw('SUM(biaya) as biaya'), 'id', 'bulan', 'tahun', 'marking', 'nama', 'noinduk', 'verifikasi', 'inputor')->where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('marking')->get();
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
						$arrrekap[] 	= array(
							'no' 		=> $rbayar->id,
							'inputor' 	=> $rbayar->inputor,
							'nama'		=> $nama,
							'noinduk'	=> $noinduk,
							'rutin'		=> $rutin,
							'verifi'	=> $verifikasi,
							'marking'	=> $marking,
							'tanggal'	=> $tanggal,
							'foto'		=> $rbayar->getTandatangan->xfile ?? '',
							'total'		=> number_format( $total , 0 , '.' , ',' ),
						);
					}
				}
			}
		}
		echo json_encode($arrrekap);
	}
	public function jsonDaftarekskul(Request $request) {
		$arraysurat	= [];
		$kodeortu	= Session('id');
		$i 			= 1;
		$sql	    = Datainduk::where('kodeortu', $kodeortu)->orWhere('kodeortuasuh', Session('email'))->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		if (!empty($sql)){
			foreach ($sql as $rjeneng) {
				$noinduk 	= $rjeneng->noinduk;
				$kelas 		= $rjeneng->klspos;
				$nama 		= $rjeneng->nama;
				$getdatakeu	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
				if (isset($getdatakeu->spp)){
					$eksul1 	= $getdatakeu->eksul1;
					$eksul2 	= $getdatakeu->eksul2;
					$eksul3 	= $getdatakeu->eksul3;
					$eksul4 	= $getdatakeu->eksul4;
					$eksul5 	= $getdatakeu->eksul5;
				} else {
					$eksul1 	= '';
					$eksul2 	= '';
					$eksul3 	= '';
					$eksul4 	= '';
					$eksul5 	= '';
				}
				if ($eksul1 != ''){
					$cekbiaya1	= Ekstrakulikuler::where('nama', $eksul1)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($cekbiaya1->biaya)){
						$biaya1	= $cekbiaya1->biaya;
					} else { $biaya1 = 0; }
					$arraysurat[] = array(
						'dot' 			=> $i,
						'nama'			=> $nama,
						'noinduk'		=> $noinduk,
						'kelas'			=> $kelas,
						'namaekskul'	=> $eksul1,
						'biaya'			=> $biaya1,
						'kode'			=> 'eksul1',
					);	
					$i++;
				}
				if ($eksul2 != ''){
					$cekbiaya2	= Ekstrakulikuler::where('nama', $eksul2)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($cekbiaya2->biaya)){
						$biaya2	= $cekbiaya2->biaya;
					} else { $biaya2 = 0; }
					$arraysurat[] = array(
						'dot' 			=> $i,
						'nama'			=> $nama,
						'noinduk'		=> $noinduk,
						'kelas'			=> $kelas,
						'namaekskul'	=> $eksul2,
						'biaya'			=> $biaya2,
						'kode'			=> 'eksul2',
					);	
					$i++;
				}
				if ($eksul3 != ''){
					$cekbiaya3	= Ekstrakulikuler::where('nama', $eksul3)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($cekbiaya3->biaya)){
						$biaya3	= $cekbiaya3->biaya;
					} else { $biaya3 = 0; }
					$arraysurat[] = array(
						'dot' 			=> $i,
						'nama'			=> $nama,
						'noinduk'		=> $noinduk,
						'kelas'			=> $kelas,
						'namaekskul'	=> $eksul3,
						'biaya'			=> $biaya3,
						'kode'			=> 'eksul3',
					);	
					$i++;
				}
				if ($eksul4 != ''){
					$cekbiaya4	= Ekstrakulikuler::where('nama', $eksul4)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($cekbiaya4->biaya)){
						$biaya4	= $cekbiaya4->biaya;
					} else { $biaya4 = 0; }
					$arraysurat[] = array(
						'dot' 			=> $i,
						'nama'			=> $nama,
						'noinduk'		=> $noinduk,
						'kelas'			=> $kelas,
						'namaekskul'	=> $eksul4,
						'biaya'			=> $biaya4,
						'kode'			=> 'eksul4',
					);
					$i++;
				}
				if ($eksul5 != ''){
					$cekbiaya5	= Ekstrakulikuler::where('nama', $eksul5)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($cekbiaya5->biaya)){
						$biaya5	= $cekbiaya5->biaya;
					} else { $biaya5 = 0; }
					$arraysurat[] = array(
						'dot' 			=> $i,
						'nama'			=> $nama,
						'noinduk'		=> $noinduk,
						'kelas'			=> $kelas,
						'namaekskul'	=> $eksul5,
						'biaya'			=> $biaya5,
						'kode'			=> 'eksul5',
					);	
				}
			}
		}
		echo json_encode($arraysurat);
	}
	public function exDaftarekskul(Request $request) {
		$ekskul		= $request->set01;
		$noinduk	= $request->set02;
		$ekskul1	= '';
		$ekskul2	= '';
		$ekskul3	= '';
		$ekskul4	= '';
		$ekskul5	= '';
		$cekdata 	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($cekdata->id)){
			$ekskul1	= $cekdata->eksul1;
			$ekskul2	= $cekdata->eksul2;
			$ekskul3	= $cekdata->eksul3;
			$ekskul4	= $cekdata->eksul4;
			$ekskul5	= $cekdata->eksul5;
		}
		$ceksudah	= 0;
		if ($ekskul1 == $ekskul){ $ceksudah++; }
		if ($ekskul2 == $ekskul){ $ceksudah++; }
		if ($ekskul3 == $ekskul){ $ceksudah++; }
		if ($ekskul4 == $ekskul){ $ceksudah++; }
		if ($ekskul5 == $ekskul){ $ceksudah++; }
		if ($ekskul == '' OR $noinduk == ''){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
					Mohon Ekstrakulikuler dipilih terlebih dahulu
					</div>';
		} else if ($ceksudah != 0){
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
					Data Sudah ada
					</div>';	
		} else {
			$cekdata 	= Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
			if (isset($cekdata->spp)){
				$eksul1 	= $cekdata->eksul1;
				$eksul2 	= $cekdata->eksul2;
				$eksul3 	= $cekdata->eksul3;
				$eksul4 	= $cekdata->eksul4;
				$eksul5 	= $cekdata->eksul5;
				if ($eksul1 == ''){
					$update = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'eksul1'	=> $ekskul
					]);
					echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Terdaftarkan di Ektrakulikuler ke 1
					</div>';	
				} else if ($eksul2 == ''){
					$update = Setkuangan::where('noinduk', $noinduk)->where('id_sekolah',session('sekolah_id_sekolah'))->update([
						'eksul2'	=> $ekskul
					]);
					echo '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses!</h4>
						Terdaftarkan di Ektrakulikuler ke 2
						</div>';	
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Maksimal Ektrakulikuler yang diperbolehkan mencapai batas
						</div>';	
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Error!</h4>
						Mohon maaf ananda belum ada data keuangan yang tersimpan. silahkan hubungi TU Sekolah untuk setting keuangan ananda
						</div>';
			}
		}
	}
	public function jsonViewDatainduk(Request $request) {
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		$klsajar		= $getdatauser->klsajar ?? '';
		$semester 		= $getdatauser->smt ?? '1';
		$tapel 			= $getdatauser->tapel ?? '';
		$jenis 			= $request->val01;
		$noinduk 		= $request->val02;
		//nomor6 pakai data grid
		//nomor9 tidak dipakai
		$homebase		= url("/");
		$tulisgajiayah 	= '';
		$tulisgajiibu 	= '';
		$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$tgliki			= date("d");
		$mthiki 		= (int)date("m");
		$thniki 		= date("Y");
		$blniki 		= $bulanlist[$mthiki];
		$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
		$getdata 		= Datainduk::where('id', $noinduk)->first();
		if (isset($getdata->id)){
			$idne 			= $getdata->id;
			$noinduk 		= $getdata->noinduk;
			$nik 			= $getdata->nik;
			$nama 			= $getdata->nama;
			$kelamin		= $getdata->kelamin;
			$tmplahir 		= $getdata->tmplahir;
			$tgllahir 		= $getdata->tgllahir;
			$darah			= $getdata->darah;
			$berat			= $getdata->berat;
			$tinggi 		= $getdata->tinggi;
			$umur 			= $getdata->umur;
			$alamatortu		= $getdata->alamatortu;
			$namaayah 		= $getdata->namaayah;
			$namaibu		= $getdata->namaibu;
			$kerjaayah		= $getdata->kerjaayah;
			$kerjaibu		= $getdata->kerjaibu;
			$wali			= $getdata->wali;
			$pekerjaanwali	= $getdata->pekerjaanwali;
			$foto			= $getdata->foto;
			$tamasuk		= $getdata->tamasuk;
			$hape			= $getdata->hape;
			$asal			= $getdata->asal;
			$mutasi			= $getdata->mutasi;
			$kelurahan		= $getdata->kelurahan;
			$kecamatan		= $getdata->kecamatan;
			$kota			= $getdata->kota;
			$kodepos		= $getdata->kodepos;
			$telpon			= $getdata->telpon;
			$erte			= $getdata->erte;
			$erwe			= $getdata->erwe;
			$id_sekolah		= $getdata->id_sekolah;
            $alamatwali		= $alamatortu;
			$kodeortuasuh	= $getdata->kodeortuasuh;
            $tglkesediaan   = $getdata->tglkesediaan;
            $ttdoratuasuh   = $getdata->ttdoratuasuh;
			$panggilan   	= $getdata->panggilan;
			$agama   		= $getdata->agama;
			$payah   		= $getdata->payah;
			$pibu   		= $getdata->pibu;
			$gayah   		= $getdata->gayah;
			$gibu   		= $getdata->gibu;
			$gybljr   		= $getdata->gybljr;
			$bakat   		= $getdata->bakat;
			if (is_null($nik)){ $nik = ''; }
			$ceksudah		= Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah', session('sekolah_id_sekolah'))->count();
			if ($ceksudah == 0 AND $nik != ''){
				Datapelengkappsb::create([
					'niksiswa'		=> $nik, 
					'panggilan'		=> $panggilan, 
					'umur'			=> 0, 
					'agama'			=> $agama,
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
					'payah'			=> $payah,
					'pibu'			=> $pibu,
					'gayah'			=> $gayah,
					'gibu'			=> $gibu,
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
					'gybljr'		=> $gybljr,
					'bakat'			=> $bakat,
					'sumberinfo'	=> '',
					'prestasi1'		=> '',
					'prestasi2'		=> '',
					'prestasi3'		=> '',
					'prestasi4'		=> '',
					'marking'		=> $idne,
					'scanakta'		=> '',
					'scanfoto'		=> '',
					'scankk'		=> '',
					'scanket'		=> '',
					'scanbukti'		=> '',
					'id_sekolah'    => session('sekolah_id_sekolah')
				]);
			}
			$cekpelengkap		= Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			if (isset($cekpelengkap->niksiswa)){
				$bakat 		= $cekpelengkap->bakat;
				$gybljr 	= $cekpelengkap->gybljr;
				$scanakta	= $cekpelengkap->getscanakta->xfile ?? $homebase.'/dist/img/aktehilang.png';
				$scanfoto	= $cekpelengkap->getscanfoto->xfile ?? $homebase.'/dist/img/fotohilang.png';
				$scankk		= $cekpelengkap->getscankk->xfile ?? $homebase.'/dist/img/kkhilang.png';
				$scanket	= $cekpelengkap->getscanket->xfile ?? $homebase.'/dist/img/kethilang.png';
				$scanbukti	= $cekpelengkap->getscanbukti->xfile ?? $homebase.'/dist/img/buktihilang.png';
				if ($cekpelengkap->gayah == 'rangegaji1'){ 
					$tulisgajiayah = '&lt; Rp. 500.000,00'; 
				} else if ($cekpelengkap->gayah == 'rangegaji2'){ 
					$tulisgajiayah = 'Rp. 500.000,00 - Rp. 999.999,00'; 
				} else if ($cekpelengkap->gayah == 'rangegaji3'){ 
					$tulisgajiayah = 'Rp. 1.000.000,00 - Rp. 1.999.999,00';
				} else if ($cekpelengkap->gayah == 'rangegaji4'){ 
					$tulisgajiayah = 'Rp. 2.000.000,00 - Rp. 4.999.999,00';
				} else if ($cekpelengkap->gayah == 'rangegaji5'){ 
					$tulisgajiayah = 'Rp. 5.000.000,00 - Rp. 20.000.000,00';
				} else if ($cekpelengkap->gayah == 'rangegaji6'){ 
					$tulisgajiayah = '&gt; Rp. 20.000.000,00'; 
				} else {
					$tulisgajiayah	= $cekpelengkap->gayah;
				}
				if ($cekpelengkap->gibu == 'rangegaji1'){ 
					$tulisgajiibu = '&lt; Rp. 500.000,00'; 
				} else if ($cekpelengkap->gibu == 'rangegaji2'){ 
					$tulisgajiibu = 'Rp. 500.000,00 - Rp. 999.999,00'; 
				} else if ($cekpelengkap->gibu == 'rangegaji3'){ 
					$tulisgajiibu = 'Rp. 1.000.000,00 - Rp. 1.999.999,00';
				} else if ($cekpelengkap->gibu == 'rangegaji4'){ 
					$tulisgajiibu = 'Rp. 2.000.000,00 - Rp. 4.999.999,00';
				} else if ($cekpelengkap->gibu == 'rangegaji5'){ 
					$tulisgajiibu = 'Rp. 5.000.000,00 - Rp. 20.000.000,00';
				} else if ($cekpelengkap->gibu == 'rangegaji6'){ 
					$tulisgajiibu = '&gt; Rp. 20.000.000,00'; 
				} else {
					$tulisgajiibu	= $cekpelengkap->gibu;
				}
				
			}
			if ($jenis == '1'){
				$umur = Carbon::parse($tgllahir)->age;
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>IDENTITAS CALON SISWA :</u></b></td>
						</tr>
						<tr>
							<td width="27">1</td>
							<td colspan="9">Nama Peserta Didik</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Lengkap (sesuai akta kelahiran)</td>
							<td width="7">:</td>
							<td colspan="5">'.$nama.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Panggilan</td>
							<td>:</td>
							<td colspan="5">'.$panggilan.'</td>
						</tr>
						<tr>
							<td>2</td>
							<td colspan="3">NIK SISWA</td>
							<td>:</td>
							<td colspan="5">'.$nik.'</td>
						</tr>
						<tr>
							<td>3</td>
							<td colspan="3">Jenis Kelamin</td>
							<td>:</td>
							<td colspan="5">'.$kelamin.'</td>
						</tr>
						<tr>
							<td>4</td>
							<td colspan="9">Kelahiran</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Tempat</td>
							<td>:</td>
							<td colspan="5">'.$tmplahir.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Tanggal-Bln-Tahun</td>
							<td>:</td>
							<td colspan="5">'.$tgllahir.' </td>
						</tr>
						<tr>
							<td>5</td>
							<td colspan="3">Umur (per Juli '.$thniki.')</td>
							<td>:</td>
							<td colspan="5">'.$umur.'</td>
						</tr>
						<tr>
							<td>6</td>
							<td colspan="3">Agama</td>
							<td>:</td>
							<td colspan="5">'.$agama.'</td>
						</tr>
						<tr>
							<td>7</td>
							<td colspan="3">Kewarganegaraan</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->warga ?? ''.'</td>
						</tr>
						<tr>
							<td>8</td>
							<td colspan="3">Anak Ke</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->anakke ?? ''.' Dengan Jumlah Saudara :</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Kandung</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->kandung ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Tiri</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->tiri ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c. Angkat</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->angkat ?? ''.'</td>
						</tr>
						<tr>
							<td>9</td>
							<td colspan="3">Bahasa Sehari-hari di keluarga</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->bahasa ?? ''.'</td>
						</tr>
						<tr>
							<td>10</td>
							<td colspan="3">Golongan Darah</td>
							<td>:</td>
							<td colspan="5">'.$darah.'</td>
						</tr>
						<tr>
							<td>11</td>
							<td colspan="9">Keadaan Jasmani</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Berat badan</td>
							<td>:</td>
							<td colspan="5">'.$berat.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Tinggi badan</td>
							<td>:</td>
							<td colspan="5">'.$tinggi.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c. Penyakit yang pernah di derita</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->penyakit ?? ''.'</td>
						</tr>
						<tr>
							<td>12</td>
							<td colspan="9">Bakat/Karakter dan Gaya Belajar</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Bakat / Karakter</td>
							<td>:</td>
							<td colspan="5">'.$bakat.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Gaya Belajar</td>
							<td>:</td>
							<td colspan="5">'.$gybljr.'</td>
						</tr>
						<tr>
							<td valign="top">13</td>
							<td colspan="3" valign="top">Alamat Rumah</td>
							<td valign="top">:</td>
							<td colspan="5" valign="top">'.$alamatortu.' RT. '.$erte.' RW. '.$erwe.' KELURAHAN '.$kelurahan.' KECAMATAN '.$kecamatan.' KOTA/KABUPATEN '.$kota.' KODEPOS '.$kodepos.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">Telepon Rumah</td>
							<td>:</td>
							<td colspan="5">'.$telpon.'</td>
						</tr>
						<tr>
							<td>14</td>
							<td colspan="3">Bertempat tinggal bersama</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->bersama ?? ''.'</td>
						</tr>
						<tr>
							<td>15</td>
							<td colspan="3">Jarak tempat tinggal ke sekolah</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->jarak ?? ''.' km</td>
						</tr>
						<tr>
							<td>16</td>
							<td colspan="3">Saudara di sekolah</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->adasaudara ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">Jika ada, Hubungan dengan calon siswa</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->hubsaudara ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">Nama Saudara di Sekolah yang sama</td>
							<td>:</td>
							<td colspan="4">'.$cekpelengkap->namasaudara ?? ''.'</td>
							<td>'.$cekpelengkap->kelassaudara ?? ''.'</td>
						</tr>
						<tr>
							<td colspan="10">&nbsp;</td>
						</tr>
					</table>';
			} else if ($jenis == '2'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>IDENTITAS AYAH KANDUNG :</u></b></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a.Nama</td>
							<td>:</td>
							<td colspan="5">'.$namaayah.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b.Pendidikan terakhir</td>
							<td>:</td>
							<td colspan="5">'.$payah.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c.Pekerjaan</td>
							<td>:</td>
							<td colspan="5">'.$kerjaayah.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="9"><span style="color: #999">(jika wiraswasta disebutkan secara spesifik)</span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">d.Total Penghasilan satu bulan</td>
							<td>:</td>
							<td colspan="5">'.$tulisgajiayah.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">e.Alamat lengkap</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->aayah ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="9" style="color: #999">(diisi jika tidak serumah dengan calon siswa)</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->hayah ?? ''.'</td>
						</tr>
						<tr>
							<td colspan="10">&nbsp;</td>
						</tr>
					</table>';
			} else if ($jenis == '3'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>IDENTITAS IBU KANDUNG:</u></b></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a.Nama</td>
							<td>:</td>
							<td colspan="5">'.$namaibu.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b.Pendidikan Terakhir</td>
							<td>:</td>
							<td colspan="5">'.$pibu.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c.Pekerjaan</td>
							<td>:</td>
							<td colspan="5">'.$kerjaibu.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="9" style="color: #999">(jika wiraswasta disebutkan secara spesifik)</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">d.Total Penghasilan satu bulan</td>
							<td>:</td>
							<td colspan="5">'.$tulisgajiibu.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">e.Alamat Lengkap</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->aaibu ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="9"><span style="color: #999">(diisi jika tidak serumah dengan calon siswa)</span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->hibu ?? ''.'</td>
						</tr>
						<tr>
							<td colspan="10">&nbsp;</td>
						</tr>
					</table>';
			} else if ($jenis == '4'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>IDENTITAS WALI :</u></b></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a.Nama</td>
							<td>:</td>
							<td colspan="5">'.$wali.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b.Hubungan keluarga</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->hubwali ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c.Pekerjaan/Jabatan</td>
							<td>:</td>
							<td colspan="5">'.$pekerjaanwali.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">d.Agama</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->agamawali ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">e.Alamat</td>
							<td>:</td>
							<td colspan="5">'.$alamatwali.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->hwali ?? ''.'</td>
						</tr>
						<tr>
							<td colspan="10">&nbsp;</td>
						</tr>
					</table>';
			} else if ($jenis == '5'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>KEADAAN JASMANI</u></b></td>
						</tr>
						<tr>
							<td align="center"><b>NO</b></td>
							<td align="center"><b>TAPEL</b></td>
							<td align="center" colspan="2"><b>TINGGI BADAN</b></td>
							<td align="center" colspan="2"><b>BERAT BADAN</b></td>
							<td align="center"><b>PENDENGARAN</b></td>
							<td align="center"><b>PENGLIHATAN</b></td>
							<td align="center"><b>GIGI</b></td>
							<td align="center"><b>LAIN-LAIN</b></td>
						</tr>';
						$i 		= 1;
						$sql 	= Rapotan::where('noinduk', $noinduk)->orderBy('TAPEL', 'ASC')->get();
						if (!empty($sql)){
							foreach ($sql as $row){
								$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">'.$row->tapel.'</td>
									<td align="center">'.$row->tbs1.'</td>
									<td align="center">'.$row->tbs2.'</td>
									<td align="center">'.$row->bbs1.'</td>
									<td align="center">'.$row->bbs2.'</td>
									<td align="center">'.$row->pendengaran.'</td>
									<td align="center">'.$row->penglihatan.'</td>
									<td align="center">'.$row->gigi.'</td>
									<td align="center">'.$row->kesehatanlain.'</td>
								</tr>';
							}
						} else {
							$generatetbl = $generatetbl.'<tr>
								<td align="center">1</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								</tr>';
						}
				$generatetbl = $generatetbl.'</table>';
			} else if ($jenis == '6'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="7"><b><u>BEASISWA</u></b></td>
						</tr>
						<tr>
							<td align="center"><b>NO</b></td>
							<td align="center"><b>TAPEL</b></td>
							<td align="center"><b>JENIS</b></td>
							<td align="center"><b>NAMA BEASISWA</b></td>
							<td align="center"><b>NOMINAL</b></td>
							<td align="center"><b>COUNT</b></td>
							<td align="center"><b>FILE</b></td>
						</tr>';
						$i 		= 1;
						$sql 	= Beasiswa::where('noinduk', $noinduk)->get();
						if (!empty($sql)){
							foreach ($sql as $row){
								$jumlah 	= $row->jumlah;
								$nominal 	= $row->nominal;
								$nmfile 	= $row->nmfile;
								$jumlah		= number_format( $jumlah , 0 , '.' , ',' );
								$nominal	= number_format( $nominal , 0 , '.' , ',' );
								if ($nmfile == ''){
									$nmfile 	= $homebase.'/dist/img/takadagambar.jpg';
								} else {
									$nmfile 	= $homebase.'/dist/img/sertifikat/'.$nmfile;
								}
								
								$generatetbl= $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">'.$row->tapel.'</td>
									<td align="center">'.$row->jenis.'</td>
									<td align="center">'.$row->namabeasiswa.'</td>
									<td align="center">'.$jumlah.'</td>
									<td align="center">'.$nominal.'</td>
									<td align="center">'.$nmfile.'</td>
								</tr>';
							}
						} else {
							$generatetbl = $generatetbl.'<tr>
								<td align="center">1</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
							</tr>';
						}
				$generatetbl = $generatetbl.'</table>';
			} else if ($jenis == '7'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>PENDIDIKAN SEBELUMNYA</u></b></td>
						</tr>
						<tr>
							<td>1</td>
							<td colspan="9">Masuk menjadi Peserta didik baru tingkat I</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Asal TK / RA / BA</td>
							<td>:</td>
							<td colspan="5">'.$asal.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Alamat TK / RA / BA</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->alamattk ?? ''.'</td>
						</tr>
						<tr>
							<td>2</td>
							<td colspan="9">Pindahan dari sekolah lain</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Nama sekolah asal</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->pindahasal ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Dari tingkat</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->pindahkelas ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c. Diterima tanggal</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->pindahtgl ?? ''.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">d. Ditingkat</td>
							<td>:</td>
							<td colspan="5">'.$cekpelengkap->pindahkekls ?? ''.'</td>
						</tr>
					</table>';
			} else if ($jenis == '8'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>MENINGGALKAN SEKOLAH</u></b></td>
						</tr>
						<tr>
							<td>1</td>
							<td colspan="9">PINDAH SEKOLAH / MUTASI KELUAR</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Nomor Surat</td>
							<td>:</td>
							<td colspan="5">'.$mutasi.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Tanggal</td>
							<td>:</td>
							<td colspan="5">-</td>
						</tr>
						<tr>
							<td>2</td>
							<td colspan="9">TAMAT BELAJAR / LULUS MELANJUTKAN SEKOLAH KE JENJANG BERIKUTNYA</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Tanggal Tamat Belajar</td>
							<td>:</td>
							<td colspan="5">-</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. Nomor Seri Ijasah</td>
							<td>:</td>
							<td colspan="5">-</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c. Nomor Seri SKHUN</td>
							<td>:</td>
							<td colspan="5">-</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">d.Melanjutkan Ke Sekolah</td>
							<td>:</td>
							<td colspan="5">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
							<td>Nama Sekolah</td>
							<td>:</td>
							<td colspan="5">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
							<td>Kecamatan</td>
							<td>:</td>
							<td colspan="5">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
							<td>Kabupaten</td>
							<td>:</td>
							<td colspan="5">&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">e.Alasan Tidak Melanjutkan</td>
							<td>:</td>
							<td colspan="5">&nbsp;</td>
						</tr>
						
					</table>';
			} else if ($jenis == '10'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>PERILAKU SISWA</u></b></td>
						</tr>
						<tr>
							<td align="center"><b>NO</b></td>
							<td align="center"><b>Tgl. Kejadian</b></td>
							<td align="center"><b>Jenis</b></td>
							<td align="center"><b>Kategori</b></td>
							<td align="center"><b>Tgl. Penanganan</b></td>
							<td align="center"><b>Layanan yang diberikan</b></td>
							<td align="center"><b>Tindak Lanjut</b></td>
							<td align="center"><b>Hasil</b></td>
							<td align="center"><b>Guru BK</b></td>
						</tr>';
						$i 		= 1;
						$sql 	= Konseling::where('noinduk', $noinduk)->where('id_sekolah', Session('sekolah_id_sekolah') )->get();
						if (!empty($sql)){
							foreach ($sql as $row){
								$tlsjenis 		= $row->getDesTatib->deskripsi ?? 'Masalah Lainnya';
								$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">'.$row->tglmasalah.'</td>
									<td align="center">'.$tlsjenis.'</td>
									<td align="center">'.$row->kategori.'</td>
									<td align="center">'.$row->tglpenanganan.'</td>
									<td align="center">'.$row->layanan.'</td>
									<td align="center">'.$row->tindaklanjut.'</td>
									<td align="center">'.$row->hasil.'</td>
									<td align="center">'.$row->guru.'</td>
								</tr>';
								$i++;
							}
						} else {
							$generatetbl = $generatetbl.'<tr>
								<td align="center">1</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
							</tr>';
						}
				$generatetbl = $generatetbl.'</table>';
			} else if ($jenis == '11'){
				$generatetbl	= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>PRESTASI SISWA</u></b></td>
						</tr>
						<tr>
							<td align="center"><b>No</b></td>
							<td align="center"><b>Bidang</b></td>
							<td align="center"><b>Tingkat</b></td>
							<td align="center"><b>Peringkat</b></td>
							<td align="center"><b>Nama Kegiatan</b></td>
							<td align="center"><b>Penyelenggara</b></td>
							<td align="center"><b>Tanggal</b></td>
							<td align="center"><b>Tempat</b></td>
							<td align="center"><b>Tapel</b></td>
						</tr>';
						$i 		= 1;
						$sql 	= Prestasi::where('noinduk', $noinduk)->get();
						if (!empty($sql)){
							foreach ($sql as $row){
								$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">'.$row->bidang.'</td>
									<td align="center">'.$row->tingkat.'</td>
									<td align="center">'.$row->juara.'</td>
									<td align="center">'.$row->namakegiatan.'</td>
									<td align="center">'.$row->penyelenggara.'</td>
									<td align="center">'.$row->tanggal.'</td>
									<td align="center">'.$row->tempat.'</td>
									<td align="center">'.$row->tapel.'</td>
								</tr>';
								$i++;
							}
						} else {
							$generatetbl = $generatetbl.'<tr>
								<td align="center">1</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
							</tr>';
						}
				$generatetbl 	= $generatetbl.'<tr><td colspan="10"><b><u>PENGEMBANGAN DIRI</u></b></td></tr>';
						$i		= 1;
						$sql 	= Rapotan::where('noinduk', $noinduk)->orderBy('TAPEL', 'ASC')->get();
						if (!empty($sql)){
							foreach ($sql as $row){
								if ($row->ekstrakulikuler1 != ''){
									$generatetbl = $generatetbl.'<tr>
										<td align="center">'.$i.'</td>
										<td align="center" colspan="2">'.$row->tapel.'</td>
										<td align="center" colspan="4">'.$row->ekstrakulikuler1.'</td>
										<td align="center" colspan="3">'.$row->nildeskripsieks1.'</td>
									</tr>';
									$i++;
								}
								if ($row->ekstrakulikuler2 != ''){
									$generatetbl = $generatetbl.'<tr>
										<td align="center">'.$i.'</td>
										<td align="center" colspan="2">'.$row->tapel.'</td>
										<td align="center" colspan="4">'.$row->ekstrakulikuler2.'</td>
										<td align="center" colspan="3">'.$row->nildeskripsieks2.'</td>
									</tr>';
									$i++;
								}
								if ($row->ekstrakulikuler3 != ''){
									$generatetbl = $generatetbl.'<tr>
										<td align="center">'.$i.'</td>
										<td align="center" colspan="2">'.$row->tapel.'</td>
										<td align="center" colspan="4">'.$row->ekstrakulikuler3.'</td>
										<td align="center" colspan="3">'.$row->nildeskripsieks3.'</td>
									</tr>';
									$i++;
								}
								if ($row->ekstrakulikuler4 != ''){
									$generatetbl = $generatetbl.'<tr>
										<td align="center">'.$i.'</td>
										<td align="center" colspan="2">'.$row->tapel.'</td>
										<td align="center" colspan="4">'.$row->ekstrakulikuler4.'</td>
										<td align="center" colspan="3">'.$row->nildeskripsieks4.'</td>
									</tr>';
									$i++;
								}
								if ($row->ekstrakulikuler5 != ''){
									$generatetbl = $generatetbl.'<tr>
										<td align="center">'.$i.'</td>
										<td align="center" colspan="2">'.$row->tapel.'</td>
										<td align="center" colspan="4">'.$row->ekstrakulikuler5.'</td>
										<td align="center" colspan="3">'.$row->nildeskripsieks5.'</td>
									</tr>';
									$i++;
								}
							}
						} else {
							$generatetbl = $generatetbl.'<tr>
								<td align="center">1</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
								<td align="center">-</td>
							</tr>';
						}
				$generatetbl 	= $generatetbl.'</table>';
			} else if ($jenis == '27'){
				$namaortuasuh   = '-';
				$nikortuasuh    = '-';
				$emailortuasuh  = '-';
				$nohapeortuasuh = '-';
				if ($kodeortuasuh == '' OR is_null($kodeortuasuh)){
					$tglkesediaan   = '-';
					$ttdoratuasuh   = 'boxed-bg.jpg';
				} else {
					$getortu    = User::where('email', $kodeortuasuh)->first();
					if (isset($getortu->id)){
						$namaortuasuh   = $getortu->nama;
						$nikortuasuh    = $getortu->nik;
						$emailortuasuh  = $getortu->email;
						$nohapeortuasuh = $getortu->nip;
					}
				}
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="10"><b><u>IDENTITAS ORANG TUA ASUH :</u></b></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">a. Nama</td>
							<td width="7">:</td>
							<td colspan="5">'.$namaortuasuh.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">b. NIK</td>
							<td>:</td>
							<td colspan="5">'.$nikortuasuh.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c. Email</td>
							<td>:</td>
							<td colspan="5">'.$emailortuasuh.'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">c. No. HP</td>
							<td>:</td>
							<td colspan="5">'.$nohapeortuasuh.'</td>
						</tr>
						<tr>
							<td colspan="10">&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5">Form di Tandatangani Pada '.$tglkesediaan.'<br /><img src="'.$ttdoratuasuh.'" width="80" /></td>
						</tr>
					</table>';
			} else if ($jenis == '28'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1"  id="printiki">
						<tr>
							<td colspan="16"><b><u>LAPORAN KEGIATAN KEAGAMAAN</u></b></td>
						</tr>
						<tr>
							<td align="center" rowspan="2" valign="middle"><b>NO</b></td>
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
						$sql 	= Datasetorantahfid::where('noinduk', $noinduk)->where('id_sekolah', $id_sekolah)->orderBy('tanggal', 'DESC')->get();
						if (!empty($sql)){
							foreach ($sql as $row){
								$jenis 	= $row->jenis;
								$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
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
									<td align="left">'.$row->inputor.'</td>
								</tr>';
								$i++;
							}
						} else {
							$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
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
			} else if ($jenis == '29'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" id="printiki">
						<tr>
							<td colspan="4"><b><u>LAPORAN UJIAN ALQURAN</u></b></td>
						</tr>
						<tr>
							<td align="center" valign="middle"><b>NO</b></td>
							<td align="center" valign="middle"><b>Tanggal</b></td>
							<td align="center"><b>Kode Ujian</b></td>
							<td align="center"><b>Link</b></td>
						</tr>';
						$i 		= 1;
						$datapernoinduk	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('semester', $semester)->where('tapel', $tapel)->where('noinduk', $noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'created_at', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
						if (!empty($datapernoinduk)){
							foreach($datapernoinduk as $datarows){
								$created_at 	= $datarows->created_at;
								$arrtanggal 	= explode(' ', $created_at);
								$tanggal		= $arrtanggal[0];
								$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">'.$tanggal.'</td>
									<td align="center">'.$datarows->tapelsemester.'</td>
									<td align="center"><a href="'.$homebase.'/'.$datarows->link.'" target="_blank"><span class="badge badge-primary">View</span></a></td>
								</tr>';
								$i++;
							}
						} else {
							$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">-</td>
									<td align="center">-</td>
									<td align="center">-</td>
								</tr>';
						}
				$generatetbl = $generatetbl.'</table>';
			} else if ($jenis == '30'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" id="printiki">
						<tr>
							<td colspan="24"><b><u>LAPORAN UJIAN LISAN</u></b></td>
						</tr>
						<tr>
							<td align="center" rowspan="2" valign="middle"><b>NO</b></td>
							<td align="center" rowspan="2" valign="middle"><b>LINK</b></td>
							<td align="center" colspan="7" valign="middle"><b>ENGLISH</b></td>
							<td align="center" colspan="7" align="right"><b>العبادة</b></td>
							<td align="center" colspan="7" align="right"><b>اللغة العربية</b></td>
							<td align="center" rowspan="2" valign="middle"><b>Total</b></td>
						</tr>
						<tr>
							<td align="center"><b>p1</b></td>
							<td align="center"><b>n1</b></td>
							<td align="center"><b>p2</b></td>
							<td align="center"><b>n2</b></td>
							<td align="center"><b>p3</b></td>
							<td align="center"><b>n3</b></td>
							<td align="center"><b>Rata-Rata</b></td>
							<td align="center"><b>p1</b></td>
							<td align="center"><b>n1</b></td>
							<td align="center"><b>p2</b></td>
							<td align="center"><b>n2</b></td>
							<td align="center"><b>p3</b></td>
							<td align="center"><b>n3</b></td>
							<td align="center"><b>Rata-Rata</b></td>
							<td align="center"><b>p1</b></td>
							<td align="center"><b>n1</b></td>
							<td align="center"><b>p2</b></td>
							<td align="center"><b>n2</b></td>
							<td align="center"><b>p3</b></td>
							<td align="center"><b>n3</b></td>
							<td align="center"><b>Rata-Rata</b></td>
						</tr>';
						$i 		= 1;
						$datapernoinduk 	= MushafUjianLisan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('id_sekolah', Session('sekolah_id_sekolah'))->get();
						if (!empty($datapernoinduk)){
							foreach($datapernoinduk as $datarows){
								$pembagiinggris = 0;
								$pembagiinggris += !empty($datarows->niy1) ? 1 : 0;
								$pembagiinggris += !empty($datarows->niy2) ? 1 : 0;
								$pembagiinggris += !empty($datarows->niy3) ? 1 : 0;
								
								$pembagilugot = 0;
								$pembagilugot += !empty($datarows->niypengujilugot1) ? 1 : 0;
								$pembagilugot += !empty($datarows->niypengujilugot2) ? 1 : 0;
								$pembagilugot += !empty($datarows->niypengujilugot3) ? 1 : 0;
								
								$pembagiibadah = 0;
								$pembagiibadah += !empty($datarows->niypengujiibadah1) ? 1 : 0;
								$pembagiibadah += !empty($datarows->niypengujiibadah2) ? 1 : 0;
								$pembagiibadah += !empty($datarows->niypengujiibadah3) ? 1 : 0;
								
								$jumlahinggris1 = hitungRataRata($datarows, 'pengguji1', 'inggris');
								$jumlahinggris2 = hitungRataRata($datarows, 'pengguji2', 'inggris');
								$jumlahinggris3 = hitungRataRata($datarows, 'pengguji3', 'inggris');
								$inggris 		= $jumlahinggris1 + $jumlahinggris2 + $jumlahinggris3;
								if ($inggris != 0 && $pembagiinggris != 0) {
									$inggris = round($inggris / $pembagiinggris, 2);
								}
								$jumlahibadah1  = hitungRataRata($datarows, 'pengguji1', 'ibadah');
								$jumlahibadah2  = hitungRataRata($datarows, 'pengguji2', 'ibadah');
								$jumlahibadah3  = hitungRataRata($datarows, 'pengguji3', 'ibadah');
								$ibadah         = $jumlahibadah1 + $jumlahibadah2 + $jumlahibadah3;
								if ($ibadah != 0 && $pembagiibadah != 0){
									$ibadah     = round((($ibadah) / $pembagiibadah), 2);
								}
								$jumlahlugot1  	= hitungRataRata($datarows, 'pengguji1', 'lugot');
								$jumlahlugot2  	= hitungRataRata($datarows, 'pengguji2', 'lugot');
								$jumlahlugot3  	= hitungRataRata($datarows, 'pengguji3', 'lugot');
								$lugot          = $jumlahlugot1 + $jumlahlugot2 + $jumlahlugot3;
								if ($lugot != 0 && $pembagilugot != 0){
									$lugot		= round((($lugot) / $pembagilugot), 2);
								}
								$akhir          = round((($inggris + $ibadah + $lugot) / 3), 2);
								$generatetbl = $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center"><a href="'.$homebase.'/hasilujianlisan/'.$datarows->id.'" target="_blank"><span class="badge badge-primary">View</span></a></td>
									<td align="center">'.$datarows->nama1.'</td>
									<td align="center">'.$jumlahinggris1.'</td>
									<td align="center">'.$datarows->nama2.'</td>
									<td align="center">'.$jumlahinggris2.'</td>
									<td align="center">'.$datarows->nama3.'</td>
									<td align="center">'.$jumlahinggris3.'</td>
									<td align="center">'.$inggris.'</td>
									<td align="center">'.$datarows->namapengujiibadah1.'</td>
									<td align="center">'.$jumlahibadah1.'</td>
									<td align="center">'.$datarows->namapengujiibadah2.'</td>
									<td align="center">'.$jumlahibadah2.'</td>
									<td align="center">'.$datarows->namapengujiibadah3.'</td>
									<td align="center">'.$jumlahibadah3.'</td>
									<td align="center">'.$ibadah.'</td>
									<td align="center">'.$datarows->namapengujilugot1.'</td>
									<td align="center">'.$jumlahlugot1.'</td>
									<td align="center">'.$datarows->namapengujilugot2.'</td>
									<td align="center">'.$jumlahlugot2.'</td>
									<td align="center">'.$datarows->namapengujilugot3.'</td>
									<td align="center">'.$jumlahlugot3.'</td>
									<td align="center">'.$lugot.'</td>
									<td align="center">'.$akhir.'</td>
								</tr>';
								$i++;
							}
						}
				$generatetbl = $generatetbl.'</table>';
			} else if ($jenis == '31'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" id="printiki">
						<tr>
							<td colspan="4"><b><u>LAPORAN BELAJAR KELAS UMUM</u></b></td>
						</tr>
						<tr>
							<td align="center" valign="middle"><b>NO</b></td>
							<td align="center" valign="middle"><b>Kode Raport</b></td>
							<td align="center"><b>Jenis Raport</b></td>
							<td align="center"><b>Link</b></td>
						</tr>';
						$i 					= 1;
						$rapotkhas			= $tapel.'-'.$semester.'.2-'.$getdata->klspos.'-'.$noinduk.'-'.$id_sekolah.'-RapotKhas';
						$rapotdinas			= $tapel.'-'.$semester.'.2-'.$getdata->klspos.'-'.$noinduk.'-'.$id_sekolah.'-RapotDinas';
						$ceksudah 			= Rapotan::where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->whereNotNull('namakepalasekolah')->where('id_sekolah', $id_sekolah)->first();
						if (isset($ceksudah->id)){
							$linkrapot 		= url('/').'/rapot/'.$ceksudah->id;
							$generatetbl 	= $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">Semester '.$semester.' TP '.$tapel.'</td>
									<td align="center">e-RAPORT</td>
									<td align="center"><a href="'.$linkrapot.'" target="_blank"><span class="badge badge-primary">View</span></a></td>
								</tr>';
								$i++;
						}
				$generatetbl = $generatetbl.'</table>';
			} else if ($jenis == '32'){
				if (session('sekolah_id_sekolah') == '1'){
					$generatetbl= '<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" id="printiki"><thead><tr><th>Nama Matpel</th><th>Kode KD</th><th>Deskripsi</th><th>P01</th><th>P02</th><th>P03</th><th>P04</th><th>P05</th><th>E01</th><th>E02</th><th>E03</th><th>E04</th><th>E05</th><th>PTS</th><th>PAS</th></tr></thead><tbody>';
					$getmuatan 	= Datanilai::where('semester', $semester)->where('tapel', $tapel)->where('noinduk', $noinduk)->where('id_sekolah', session('sekolah_id_sekolah'))->where('jennilai', '!=', 'Ekstrakurikuler')->groupBy('matpel')->orderBy('matpel', 'ASC')->get();
					$allNilai 	= Datanilai::where('nilai', '!=', '0')->where('semester', $semester)->where('tapel', $tapel)->where('noinduk', $noinduk)->where('id_sekolah', session('sekolah_id_sekolah'))->get();
					$nilaiArray = [];
					foreach ($allNilai as $nilai) {
						$nilaiArray[$nilai->matpel][$nilai->kodekd][$nilai->jennilai] = $nilai->nilai;
					}
					foreach ($getmuatan as $rmuatan) {
						$getkodekd 	= Datanilai::where('semester', $semester)->where('tapel', $tapel)->where('noinduk', $noinduk)->where('id_sekolah', session('sekolah_id_sekolah'))->where('matpel', $rmuatan->matpel)->groupBy('kodekd')->orderBy('kodekd', 'ASC')->get();
						foreach ($getkodekd as $rkodekd) {
							$values = array_merge(
								['p01' => '', 'p02' => '', 'p03' => '', 'p04' => '', 'p05' => '',
								'e01' => '', 'e02' => '', 'e03' => '', 'e04' => '', 'e05' => '',
								'pts' => '', 'pas' => ''],
								$nilaiArray[$rmuatan->matpel][$rkodekd->kodekd] ?? []
							);
							$generatetbl .= '<tr>
								<td>' . $rkodekd->matpel . '</td>
								<td>' . $rkodekd->kodekd . '</td>
								<td>' . $rkodekd->deskripsi . '</td>
								<td>' . implode('</td><td>', $values) . '</td>
							</tr>';
						}
					}
					$generatetbl .= '</tbody></table>';
				} else {

				}
				$generatetbl = $generatetbl.'</tbody<</table>';
			} else if ($jenis == '33'){
				$generatetbl= '
					<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" id="printiki">
						<tr>
							<td colspan="4"><b><u>LAPORAN UJIAN ALQURAN</u></b></td>
						</tr>
						<tr>
							<td align="center" valign="middle"><b>NO</b></td>
							<td align="center" valign="middle"><b>Kode Raport</b></td>
							<td align="center"><b>Jenis Raport</b></td>
							<td align="center"><b>Link</b></td>
						</tr>';
						$i 					= 1;
						$datapernoinduk	= MushafUjian::where('id_sekolah', Session('sekolah_id_sekolah'))->where('noinduk', $noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'created_at', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
						if (!empty($datapernoinduk)){
							foreach($datapernoinduk as $datarows){
								$generatetbl 	= $generatetbl.'<tr>
									<td align="center">'.$i.'</td>
									<td align="center">Semester '.$datarows->semester.' TP '.$datarows->tapel.'</td>
									<td align="center">'.$datarows->tapelsemester.'</td>
									<td align="center"><a href="'.url('/').'/'.$datarows->link.'" target="_blank"><span class="badge badge-primary">View</span></a></td>
								</tr>';
								$i++;
							}
						}
				$generatetbl = $generatetbl.'</table>';
			} else {
				if ($jenis == '12'){
					$jenis = 'KB';
				} else if ($jenis == '13' OR $jenis == '14'){
					$jenis = 'TK';
				} else {
					$jenis 			= (int)$jenis;
					$jenis 			= $jenis - 14;
				}
				$generatetbl 	= '';
				$rapot 			= Rapotan::where('noinduk', $noinduk)->where('kelas', 'LIKE', $jenis.'%')->whereNotNull('namakepalasekolah')->where('id_sekolah', session('sekolah_id_sekolah'))->get();
				if (!empty($rapot)){
					foreach($rapot as $rows){
						$generatetbl = $generatetbl.' <a href="'.url('/').'/rapot/'.$rows->id.'" target="_blank">Data Kelas '.$rows->kelas.' Semester '.$rows->semester.' Tahun Ajaran '.$rows->tapel.'</a><br />';
					}
				}
				if ($generatetbl == ''){
					$generatetbl = $generatetbl.' Data Kelas '.$jenis.' Tidak di Temukan<br />';
				}
			}
		} else {
			$generatetbl = '<h1>ID '.$noinduk.' TIDAK DITEMUKAN</h1>';
		}
		
		echo $generatetbl;
	}
	public function jsonStatistikDatakd(Request $request) {
		$getnama 		= Datainduk::where('id', $request->val01)->first();
		$noinduk 		= $getnama->noinduk ?? '';
		$nama			= $getnama->nama ?? '';
		$klspos			= $getnama->klspos ?? '';
		$masterkls 		= preg_replace("/[^0-9]/", "", $klspos);
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		$klsajar		= $getdatauser->klsajar ?? '';
		$semester 		= $getdatauser->smt ?? '1';
		$tapel 			= $getdatauser->tapel ?? '';
		$golekakhir 	= DB::table('db_nilai')->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05'])->where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
		$golekharian 	= DB::table('db_nilai')->whereIn('jennilai', ['e01', 'e02', 'e03', 'e04', 'e05'])->where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
		$rataakhir 		= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
		$rataharian 	= isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
		$arraysurat[] = array(
			'jenis' 		=> 'Evaluasi',
			'jumlah' 		=> round($rataharian, 2),
		);
		$arraysurat[] = array(
			'jenis' 		=> 'Penilaian',
			'jumlah' 		=> round($rataakhir, 2),
		);
		echo json_encode($arraysurat);
	}
	public function jsonStatDatapermuatan(Request $request) {
		$getnama 		= Datainduk::where('id', $request->val01)->first();
		$noinduk 		= $getnama->noinduk ?? '';
		$nama			= $getnama->nama ?? '';
		$klspos			= $getnama->klspos ?? '';
		$masterkls 		= preg_replace("/[^0-9]/", "", $klspos);
		$iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->first();
		$klsajar		= $getdatauser->klsajar ?? '';
		$semester 		= $getdatauser->smt ?? '1';
		$tapel 			= $getdatauser->tapel ?? '';
		$arraysurat		= [];
		$getdatakkm		= Datakkm::where('kelas', $masterkls)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('jenis', 'DESC')->orderBy('muatan', 'ASC')->get();
		foreach ($getdatakkm as $rkkm){
			$golekakhir 	= DB::table('db_nilai')->whereIn('jennilai', ['pts', 'pat'])->where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('matpel', $rkkm->muatan)->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
			$golekharian 	= DB::table('db_nilai')->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])->where('noinduk', $noinduk)->where('semester', $semester)->where('tapel', $tapel)->where('matpel', $rkkm->muatan)->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
			$rataakhir 		= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
			$rataharian 	= isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
			$arraysurat[] 	= [
				'jenis' 	=> $rkkm->muatan,
				'jumlah3' 	=> round($rataharian, 2),
				'jumlah4' 	=> round($rataakhir, 2),
			];
		}
		echo json_encode($arraysurat);
	}
	public function jsonStatDatakehadiran(Request $request) {
		$getnama 	= Datainduk::where('id', $request->val01)->first();
		if (isset($getnama->id)){
			$noinduk 	= $getnama->noinduk;
			$id_sekolah	= $getnama->id_sekolah;
		} else {
			$noinduk 	= $request->val01;
			$id_sekolah	= Session('sekolah_id_sekolah');
		}
		$arrpresensi= [];
		$tepatwaktu = Datapresensi::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->whereIn('status', ['1','5'])->count();
		$ijin 		= Datapresensi::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '2')->count();
		$sakit 		= Datapresensi::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '3')->count();
		$terlambat 	= Datapresensi::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '4')->count();
		$alpha 		= Datapresensi::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '0')->count();
		$tepatwaktu2= Datapresensiekskul::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->whereIn('status', ['1','4'])->count();
		$ijin2 		= Datapresensiekskul::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '2')->count();
		$sakit2 	= Datapresensiekskul::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '3')->count();
		$terlambat2 = Datapresensiekskul::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '4')->count();
		$alpha2 	= Datapresensiekskul::where('noinduk', $noinduk)->where('id_sekolah',$id_sekolah)->where('status', '0')->count();
		$tepatwaktu	= $tepatwaktu + $tepatwaktu2;
		$terlambat	= $terlambat + $terlambat2;
		$ijin		= $ijin + $ijin2;
		$sakit		= $sakit + $sakit2;
		$alpha		= $alpha + $alpha2;
		
		$arrpresensi[] = array(
			'noinduk' 	=> $noinduk,
			'jumlah'	=> $tepatwaktu,
			'jenis'		=> 'Hadir Tepat Waktu',
		);
		$arrpresensi[] = array(
			'noinduk' 	=> $noinduk,
			'jumlah'	=> $terlambat,
			'jenis'		=> 'Hadir namun kurang Aktif / Terlambat',
		);
		$arrpresensi[] = array(
			'noinduk' 	=> $noinduk,
			'jumlah'	=> $ijin,
			'jenis'		=> 'IJIN',
		);
		$arrpresensi[] = array(
			'noinduk' 	=> $noinduk,
			'jumlah'	=> $sakit,
			'jenis'		=> 'SAKIT',
		);
		$arrpresensi[] = array(
			'noinduk' 	=> $noinduk,
			'jumlah'	=> $alpha,
			'jenis'		=> 'Tanpa Keterangan',
		);
		echo json_encode($arrpresensi);
	}
	public function jsonNStatistikilaisiswa(Request $request) {
		$kalender 		= array("Bulan", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
		$arrrekap 		= [];
		$id 			= $request->val01;
		$getdata 		= Datainduk::where('id', $id)->first();
		$cekada 		= Datanilai::where('noinduk', $getdata->noinduk)->where('id_sekolah', $getdata->id_sekolah)->orderBy('tanggal', 'ASC')->get();
		if (!empty($cekada)){
			foreach($cekada as $rada){
				$tanggal 	= $rada->tanggal;
				$arrtgl 	= explode('-', $tanggal);
				if (isset($arrtgl[2])){
					$bulan		= (int)$arrtgl[1];
					$bulan 		= $kalender[$bulan];
					$tanggal 	= $arrtgl[0].'-'.$bulan;
				}
				$arrrekap[] = array(
					'noinduk' 	=> $rada->noinduk,
					'berat'		=> $rada->tema,
					'tinggi'	=> $rada->subtema,
					'lingkar'	=> $rada->nilai,
					'vitamin'	=> $rada->deskripsi,
					'nama'		=> $rada->nama,
					'tanggal'	=> $tanggal
				);
			}
		}
		$arrrekap = collect($arrrekap)->groupBy(['tanggal'])->map(function ($items) {
			return $items->first();
		})->values()->all();
		echo json_encode($arrrekap);
	}
}
