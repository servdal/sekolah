<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessageNotification;
use App\Models\User;
use App\Models\ShortLink;
use App\Chatting;
use App\Pengumuman;
use App\Sekolah;
use App\Layanan;
use App\Pembayaranzis;
use App\Datapresensi;
use App\Rapotan;
use App\Datainduk;
use App\Datapsb;
use App\Datapelengkappsb;
use App\Setting;
use App\Tesppdb;
use App\Pembayaran;
use App\Ekstrakulikuler;
use App\Suratkeluar;
use App\ProgramPIP;
use App\AbsenProgramPIP;
use App\HPTKeuangan;
use App\Inboxsurat;
use App\Suratmasuk;
use App\Insidental;
use App\Formulirpsb;
use App\Bukutamu;
use App\XFiles;
use App\RencanaKegiatan;
use App\RABKegiatan;
use App\Dataindukstaff;
use App\EfikasiKeuangan;
use App\KurikulumAlquran;
use App\MushafHalaman;
use App\MushafUjian;
use App\MushafUjianLisan;
use App\Perpumini;
use App\Datanilai;
use App\Datakd;

use Carbon\Carbon;
use setasign\Fpdi\Tcpdf\Fpdi;
use GuzzleHttp\Client;
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
function angka_ke_teks_arab($angka) {
	$digit_arab = array(
		0 => '٠',
		1 => '١',
		2 => '٢',
		3 => '٣',
		4 => '٤',
		5 => '٥',
		6 => '٦',
		7 => '٧',
		8 => '٨',
		9 => '٩'
	);
	$teks_arab 		= '';
	$angka_str 		= strval($angka);
	$panjang_angka 	= strlen($angka_str);
	for ($i = 0; $i < $panjang_angka; $i++) {
		$teks_arab .= $digit_arab[$angka_str[$i]];
	}
	return $teks_arab;
}
function formatPesan($pesan) {
	$pengganti = [
		':)' 	=> '&#128522;',
		'T_T' 	=> '&#128557;',
		'>.<' 	=> '&#128518;',
		'^_v' 	=> '&#128540;',
		'<' 	=> '&#60;',
		'>' 	=> '&#62;',
		'"' 	=> '&#34;',
		'#' 	=> '&#35;',
		'$' 	=> '&#36;',
		'%' 	=> '&#37;',
		'&' 	=> '&#38;',
		'+' 	=> '&#43;',
		'@' 	=> '&#64;',
		'?' 	=> '&#63;',
		'^' 	=> '&#94;',
		'{' 	=> '&#123;',
		'}' 	=> '&#125;',
		'`' 	=> '&#96;',
		"'" 	=> "&#39;",
		'(' 	=> "&#40;",
		')' 	=> "&#41;"
	];
	return str_replace(array_keys($pengganti), array_values($pengganti), $pesan);
}
class FrontpageController extends Controller
{
	public function show($slug)
    {
        $link = ShortLink::where('slug', $slug)->firstOrFail();
        $link->increment('clicks');
        return redirect()->away($link->destination_url);
    }
	protected function ppdbUploadAccessKey()
	{
		return 'ppdb_upload_access';
	}
	protected function storePpdbUploadAccess($idSekolah, $nik, $tgllahir)
	{
		Session::put($this->ppdbUploadAccessKey(), [
			'id_sekolah' => (string) $idSekolah,
			'nik' => trim((string) $nik),
			'tgllahir' => trim((string) $tgllahir),
			'verified_at' => Carbon::now()->timestamp,
		]);
	}
	protected function hasPpdbUploadAccess($idSekolah, $nik, $tgllahir = null)
	{
		if (Auth::check()) {
			return true;
		}
		$access = Session::get($this->ppdbUploadAccessKey());
		if (!is_array($access) || !isset($access['verified_at'])) {
			return false;
		}
		if (($access['verified_at'] + 1800) < Carbon::now()->timestamp) {
			Session::forget($this->ppdbUploadAccessKey());
			return false;
		}
		if ((string) ($access['id_sekolah'] ?? '') !== (string) $idSekolah) {
			return false;
		}
		if (trim((string) ($access['nik'] ?? '')) !== trim((string) $nik)) {
			return false;
		}
		if ($tgllahir !== null && trim((string) ($access['tgllahir'] ?? '')) !== trim((string) $tgllahir)) {
			return false;
		}
		return true;
	}
	protected function validatePpdbImageData($data)
	{
		if (!is_string($data)) {
			return null;
		}
		$data = trim($data);
		if ($data === '') {
			return null;
		}
		if (!preg_match('/^data:image\/(png|jpe?g);base64,/i', $data)) {
			return false;
		}
		$parts = explode(',', $data, 2);
		if (count($parts) !== 2) {
			return false;
		}
		$binary = base64_decode($parts[1], true);
		if ($binary === false || strlen($binary) > (2 * 1024 * 1024)) {
			return false;
		}
		$imageInfo = @getimagesizefromstring($binary);
		if ($imageInfo === false || !isset($imageInfo['mime'])) {
			return false;
		}
		if (!in_array($imageInfo['mime'], ['image/jpeg', 'image/png'], true)) {
			return false;
		}
		return $data;
	}
	protected function getAuthorizedPpdbRecord($id)
	{
		$datapsb = Datapsb::where('id', $id)->first();
		if (!isset($datapsb->id)) {
			return null;
		}
		if ($this->hasPpdbUploadAccess($datapsb->id_sekolah, $datapsb->nik, $datapsb->tgllahir)) {
			return $datapsb;
		}
		return null;
	}
	public static function genSurat($id, $tabel){
		$data		= [];
		$homebase 	= url("/");
		$kalender 	= array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$bulan_arab = array(
			"wulan",
			"يناير", // Januari
			"فبراير", // Februari
			"مارس", // Maret
			"أبريل", // April
			"مايو", // Mei
			"يونيو", // Juni
			"يوليو", // Juli
			"أغسطس", // Agustus
			"سبتمبر", // September
			"أكتوبر", // Oktober
			"نوفمبر", // November
			"ديسمبر" // Desember
		);
        if ($tabel == 'zis'){
			$getdata 					= Pembayaranzis::where('id', $id)->first();
			if (isset($getdata->namafile)){
				$namafile				= $getdata->namafile;
				$data['gambar']   		= $namafile;
			} else {
				$data['gambar']   		= url('/').'/dist/img/takadagambar.jpg';
			}
			return view('cetak.filelampiran', $data);
		} else if ($tabel == 'pembayaran'){
			$getdata 					= Pembayaran::where('id', $id)->first();
			if (isset($getdata->buktibayar)){
				$namafile				= $getdata->buktibayar;
				$data['gambar']   		= $namafile;
			} else {
				$data['gambar']   		= url('/').'/dist/img/takadagambar.jpg';
			}
			return view('cetak.filelampiran', $data);
		} else if ($tabel == 'suratijin'){
			$getdata 					= Datapresensi::where('id', $id)->first();
			if (isset($getdata->surat)){
				$surat						= $getdata->surat;
				$data['generatetbl']   		= $surat;
			} else {
				$data['gamgeneratetblbar']  = '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
			}
			return view('cetak.suratgenerator', $data);
		} else if ($tabel == 'kwitansiformulirpsb'){
			$rmaster2 						= Formulirpsb::where('id', $id)->first();
			if (isset($rmaster2->id)){
				$nama 						= $rmaster2->nama;
				$tamasuk					= $rmaster2->tapel;
				$nominal					= $rmaster2->nominal;
				$jenis						= $rmaster2->jenis;
				$nomor						= $rmaster2->nomor;
				$tanggalctk					= $rmaster2->tanggal;
				$id_sekolah					= $rmaster2->id_sekolah;
				$rsetting					= Sekolah::where('id', $id_sekolah)->first();
				$sekolah 					= $rsetting->nama_sekolah;
				$yayasan 					= $rsetting->nama_yayasan;
				$alamat 					= $rsetting->alamat;
				$kepalasekolah 				= $rsetting->kepala_sekolah->nama;
				$niykasek					= $rsetting->kepala_sekolah->niy;
				$mutiara 					= $rsetting->slogan;
				$logo 						= $rsetting->logo;
				$kota 						= $rsetting->kota;
				$logo_grey 					= $rsetting->logo_grey;
				$frontpage 					= $rsetting->frontpage;
				$akreditasi 				= $rsetting->akreditasi;
				$kopsurat 					= $rsetting->kopsurat;
				$nis 						= $rsetting->nis;
				$email 						= $rsetting->email;
				$nomhuruf 					= SendMail::terbilang($nominal);
				$nomangka					= number_format( $nominal , 0 , '.' , ',' );
				if ($kopsurat == '' OR $kopsurat == null){
					$kopsurat 				= '<tr>
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
					$kopsurat				= '<tr><td colspan="11"><img src="'.$homebase.'/'.$kopsurat.'" width="100%" /></tr>';
				}
				$alamatcetak				= $homebase.'/kwitansipsb/'.$rmaster2->id;
				try {
					$qrcode 				= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
				} catch (\Exception $e) {
					$qrcode 				= '';
				}
				$tasks						= [];
				$tasks['logo_grey']			= $homebase.'/'.$rsetting->logo_grey;
				$tasks['kopsurat']			= $kopsurat;
				$tasks['rsetting']			= $rsetting;
				$tasks['qrcode']			= $qrcode;
				$tasks['costumid']			= $jenis.$nomor;
				$tasks['nama']				= $nama;
				$tasks['nomhuruf']			= $nomhuruf;
				$tasks['tamasuk']			= $tamasuk;
				$tasks['tanggalctk']		= $tanggalctk;
				$tasks['nomangka']			= $nomangka;
				$tasks['asline']			= Session('nama');
				$tasks['namaapps01']  		= config('global.Title2');
				$tasks['domainapps01']  	= config('global.yayasan');
				$tasks['subdomainapps01']  	= config('global.singkatan');
				$tasks['subsubdomainapps01']= config('global.sekolah');
				$tasks['addressapps01']  	= config('global.alamat');
				$tasks['emailapps01']  		= config('global.email');
				$tasks['lamanapps01']  		= config('global.homeweb');
				$tasks['logofrontapps01']  	= config('global.logosimaster');
				$tasks['logo01']  			= config('global.logoapss');
				return view('cetak.kwitansipsb', $tasks);
			} else {
				$data['generatetbl']  = '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
				return view('cetak.suratgenerator', $data);
			}
		} else if ($tabel == 'rapot'){
			$cekdata		= Rapotan::where('id', $id)->first();
			if (isset($cekdata->id)){
				$marking		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotDinas';
				$markingguru 	= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDGURU';
				$ttdks 			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDKS';
				$cettdguru 		= XFiles::where('xmarking', $markingguru)->first();
				$cekttdks 		= XFiles::where('xmarking', $ttdks)->first();
				$ttdkasek		= $cekttdks->xfile ?? '[ttdks]';
				$ttdguru		= $cettdguru->xfile ?? '[ttdguru]';
				if ($ttdkasek != 'locked'){
					$arrtanggal				= explode(' ', $cekdata->tanggal);
					$tanggal				= $arrtanggal[0];
					$arrtanggal				= explode('-', $tanggal);
					if (isset($arrtanggal[2])){
						$yy 				= $arrtanggal[0];
						$mm 				= (int)$arrtanggal[1];
						$dd 				= $arrtanggal[2];
						$mm 				= $kalender[$mm];
						$tanggal			= $dd.' '.$mm.' '.$yy;
					}
					
					$tabelatas				= '';
					$nomor 					= 1;
					$totalsum 				= 0;
					$pembagisum 			= 0;
					$headerwajib 			= '';
					$headermulok 			= '';
					$rowswajib				= [];
					$rowsmulok 				= [];
					$semester				= $cekdata->semester;
					$semestercari 			= mb_substr($semester, 0, 1);
					for ($index = 1; $index <= 30; $index++) {
						$kode 			= 'k'.sprintf("% 02s", $index);
						$field_huruf 	= 'h'.sprintf("% 02s", $index);
						$field_nilai 	= 'n'.sprintf("% 02s", $index);
						$matpel 		= $cekdata->$field_huruf;
						$kkm 			= $cekdata->$field_nilai;
						$afektif		= '';
						$angka			= 0;
						$terbilang		= '';
						$cekmatpel 		= explode('; ', $matpel);
						if (isset($cekmatpel[1])){
							$jenis 		= $cekmatpel[0];
							$matpel		= $cekmatpel[1];
						} else {
							$jenis 		= 'Wajib';
						}
						if ($cekdata->$kode !== '' && $cekdata->$kode !== null) {
							$datacari 	= $cekdata->$kode;
							$cekjenis 	= explode('[pisah]', $datacari);
							if (isset($cekjenis[1])) {
								$afektif 	= $cekjenis[0];
								$muatan 	= $cekjenis[1];
								$deskripsi 	= $cekjenis[2] ?? '';
								$angka 		= $cekjenis[3] ?? 0;
								if ($angka == 0){
									$golekakhir = DB::table('db_nilai')->whereIn('jennilai', ['pts', 'pat'])->where('noinduk', $cekdata->noinduk)->where('semester', $semestercari)->where('tapel', $cekdata->tapel)->where('matpel', $muatan)->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
									$golekharian= DB::table('db_nilai')->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])->where('noinduk', $cekdata->noinduk)->where('semester', $semestercari)->where('tapel', $cekdata->tapel)->where('matpel', $muatan)->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))->groupBy('noinduk')->first();
									$rataakhir 	= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
									$rataharian = isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
									$angka 		= ($rataakhir != 0 && $rataharian != 0) ? round(((($rataharian * 2) + $rataakhir) / 3), 0) : 0;
								}
								$totalsum	= $totalsum + $angka;
								$pembagisum++;
								if ($angka == 0){
									$terbilang = 'Nol';
								} else {
									if ($deskripsi == ''){
										$idterbesar 		= 0;
										$golekterterbesar	= Datanilai::whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
															->where('noinduk', $cekdata->noinduk)
															->where('semester', $semestercari)
															->where('tapel', $cekdata->tapel)
															->where('matpel', $muatan)
															->orderBY('nilai', 'DESC')
															->first();
										if (isset($golekterterbesar->id)){
											$idterbesar 		= $golekterterbesar->id;
											$deskripsi			= $deskripsi.$cekdata->nama.' menunjukkan penguasaan yang baik dalam '.$golekterterbesar->deskripsi.' <br />';
										}
										$golekterkecil	= Datanilai::whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
															->where('noinduk', $cekdata->noinduk)
															->where('semester', $semestercari)
															->where('tapel', $cekdata->tapel)
															->where('matpel', $muatan)
															->where('id', '!=', $idterbesar)
															->orderBY('nilai', 'ASC')
															->first();
										if (isset($golekterkecil->id)){
											$deskripsi			= $deskripsi.$cekdata->nama.' perlu pendampingan dalam '.$golekterkecil->deskripsi;
										}
									}
									if ($jenis == 'Wajib'){
										$rowswajib[] = array(
											'teks' => '<tr><td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">[nomor]</td><td style="border-right: 1px solid #000000" align="left" valign="top" colspan="3">'.$matpel.'</td><td style="border-right: 1px solid #000000" align="center" valign="top">'.$angka.'</td><td style="border-right: 1px solid #000000" align="left" valign="top" colspan="3">'.$deskripsi.'</td></tr>'
										);
									} else {
										$rowsmulok[] = array(
											'teks' => '<tr><td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">[nomor]</td><td style="border-right: 1px solid #000000" align="left" valign="top" colspan="3">'.$matpel.'</td><td style="border-right: 1px solid #000000" align="center" valign="top">'.$angka.'</td><td style="border-right: 1px solid #000000" align="left" valign="top" colspan="3">'.$deskripsi.'</td></tr>'
										);
									}
								}
							}
						}
					}
					foreach($rowswajib as $rteks){
						$teks 		= $rteks['teks'];
						$teks 		= str_replace('[nomor]', $nomor, $teks);
						$tabelatas 	= $tabelatas.$teks;
						$nomor++;
					}
					$tabelatas 		= $tabelatas.'<tr><td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;" align="left" valign="top" bgcolor="#F2F2F2" colspan="8">Muatan Lokal</td></tr>';
					foreach($rowsmulok as $rteks){
						$teks 		= $rteks['teks'];
						$teks 		= str_replace('[nomor]', $nomor, $teks);
						$tabelatas 	= $tabelatas.$teks;
						$nomor++;
					}
					$data['ttdortu']		= '';
					$data['ttdguru']		= '';
					$data['ttdkasek']		= '';
					$data['rapot']			= $cekdata;
					$data['sekolah']		= $cekdata->namasekolah  ?? Session('sekolah_nama_sekolah');
					$data['alamat']			= Session('sekolah_alamat');
					$data['tanggal']		= $tanggal;
					$data['tabelatas']		= $tabelatas;
					$generatesurat 			= view('cetak.rapot', $data)->render();
					XFiles::updateOrCreate(
						[
							'xmarking'	=> $marking,
						],
						[
							'xtabel'	=> 'db_rapotan',
							'xjenis'	=> $cekdata->id_sekolah.';'.$cekdata->noinduk,
							'xfile'		=> $generatesurat
						]
					);
					return $generatesurat;
				} else {
					$ceksudah 		= XFiles::where('xmarking', $marking)->first();
					if (isset($ceksudah->xfile)){
						$surat 		= $ceksudah->xfile ?? '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
						return $surat;
					} else {
						$data['generatetbl']  = '<iframe src="'.url('/').'/printmark/'.$marking.'"></iframe>';
						return view('cetak.suratgenerator', $data);
					}
				}
			} else {
				$data['generatetbl']  = '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
				return view('cetak.suratgenerator', $data);
			}
			
		} else if ($tabel == 'rapotkhas'){
			$data 			= [];
			$tabelatas 		= [];
			$x 				= 0;
			$totalsum 		= 0;
			$pembagisum 	= 0;
			$cekdata		= Rapotan::where('id', $id)->first();
			if (isset($cekdata->id)){
				$nama 			= $cekdata->nama;
				$kelas			= $cekdata->kelas;
				$noinduk 		= $cekdata->noinduk;
				$nisn			= $cekdata->nisn;
				$tapel 			= $cekdata->tapel;
				$semester		= $cekdata->semester;
				$id_sekolah		= $cekdata->id_sekolah;
				$semestercari 	= mb_substr($semester, 0, 1);
				$markingguru 	= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDGURU';
				$ttdks 			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDKS';
				$markingguru2 	= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'A-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDGURU';
				$ttdks2 		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'A-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDKS';
				$cekortu		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-ORTU';
				$marking		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotKhas';
				$cettdguru 		= XFiles::where('xmarking', $markingguru)->first();
				$cekttdks 		= XFiles::where('xmarking', $ttdks)->first();
				$cettdortu 		= XFiles::where('xmarking', $cekortu)->first();
				$ttdkasek		= $cekttdks->xfile ?? '[ttdks]';
				$ttdguru		= $cettdguru->xfile ?? '[ttdguru]';
				$ttdortu		= $cettdortu->xfile ?? '[ttdortu]';
				if ($ttdkasek == '[ttdks]'){
					$cekttdks2 	= XFiles::where('xmarking', $ttdks2)->first();
					$ttdkasek	= $cekttdks2->xfile ?? '[ttdks]';
				}
				if ($ttdguru == '[ttdguru]'){
					$cettdguru2 = XFiles::where('xmarking', $markingguru2)->first();
					$ttdguru	= $cettdguru2->xfile ?? '[ttdguru]';
				}
				if ($ttdkasek != 'final'){
					if ($id_sekolah == '2'){
						$jumlah 				= 0;
						if ($ttdortu != '[ttdortu]'){
							$ttdortu 	= '<img src="'.$ttdortu.'" height="100" />';
						} else {
							$ttdortu = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
						}
						if ($ttdkasek != '[ttdks]'){
							try {
								$keterangan = 'Rapot Link '.url('/').'/printmark/'.$marking.' Di Tandatangani Oleh '.$cekdata->namakepalasekolah.' Pada '.date('Y-m-d H:i:s');
								$qrcode		= base64_encode(QrCode::format('png')->size(100)->generate($keterangan));
								$ttdkasek	= '<img src="data:image/png;base64, '.$qrcode.'" height="100" />';
							} catch (\Exception $e) {
								$ttdkasek 	= '<img src="'.$ttdkasek.'" height="100" />';
							}
							$jumlah++;
						} else {
							$ttdkasek = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
						}
						if ($ttdguru != '[ttdguru]'){ 
							try {
								$keterangan = 'Rapot Link '.url('/').'/printmark/'.$marking.' Di Tandatangani Oleh '.$cekdata->namaguru.' Pada '.date('Y-m-d H:i:s');
								$qrcode		= base64_encode(QrCode::format('png')->size(100)->generate($keterangan));
								$ttdguru	= '<img src="data:image/png;base64, '.$qrcode.'" height="100" />';
							} catch (\Exception $e) {
								$ttdguru 	= '<img src="'.$ttdguru.'" height="100" />';
							}
							$jumlah++;
						} else {
							$ttdguru = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
						}
						$getdata 				= $cekdata;
						$data['ttdortu']		= $ttdortu;
						$data['ttdguru']		= $ttdguru;
						$data['ttdkasek']		= $ttdkasek;
						$data['kopsurat']		= url('/').'/format/kop_rapot_mataba.png';
						$data['datarapot']		= $getdata;
						$data['tanggal']		= $cekdata->tanggal;
						$generatesurat 			= view('cetak.rapottpq', $data)->render();
		
						if ($jumlah == 2){
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $ttdks,
								],
								[
									'xfile'		=> 'final'
								]
							);
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $markingguru,
								],
								[
									'xfile'		=> 'final'
								]
							);
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $marking,
								],
								[
									'xfile'		=> $generatesurat
								]
							);
						}
						return $generatesurat;
					} else {
						$arrtanggal		= explode(' ', $cekdata->tanggal);
						$tanggal		= $arrtanggal[0];
						$arrtanggal		= explode('-', $tanggal);
						if (isset($arrtanggal[2])){
							$yy 		= $arrtanggal[0];
							$mm 		= (int)$arrtanggal[1];
							$dd 		= $arrtanggal[2];
							$mm 		= $kalender[$mm];
							$tanggal	= $dd.' '.$mm.' '.$yy;
						} else {
							$tanggal 	= $cekdata->tanggal;
						}
						$cekrapotakhlak	= '';
						$akhlak			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-AKHLAK';
						$akhlak2		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'A-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-AKHLAK';
						$cekakhlak 		= XFiles::where('xmarking', $akhlak)->first();
						$cekakhlak2 	= XFiles::where('xmarking', $akhlak2)->first();
						if (isset($cekakhlak->xfile)){
							$rapotakhlak 	= $cekakhlak->xfile;
							if ($rapotakhlak == 'arsip'){
								$cekrapotakhlak	= 'arsip';
							}
						} else if (isset($cekakhlak2->xfile)){
							$rapotakhlak 	= $cekakhlak2->xfile;
							if ($rapotakhlak == 'arsip'){
								$cekrapotakhlak	= 'arsip';
							}
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
						$nomor 			= 1;
						for ($index = 1; $index <= 30; $index++) {
							$kode 			= 'k'.sprintf("% 02s", $index);
							$field_huruf 	= 'h'.sprintf("% 02s", $index);
							$field_nilai 	= 'n'.sprintf("% 02s", $index);
							$matpel 		= $cekdata->$field_huruf;
							$kkm 			= $cekdata->$field_nilai;
							$afektif		= '';
							$angka			= 0;
							$terbilang		= '';
							if ($cekdata->$kode !== '' && $cekdata->$kode !== null) {
								$datacari 	= $cekdata->$kode;
								$cekjenis 	= explode('[pisah]', $datacari);
								if (isset($cekjenis[1])) {
									$afektif 	= $cekjenis[0];
									$muatan 	= $cekjenis[1];
									$deskripsi 	= $cekjenis[2] ?? '';
									$angka 		= $cekjenis[3] ?? 0;
									if ($angka == 0){
										$golekakhir = DB::table('db_nilai')
														->whereIn('jennilai', ['pts', 'pat'])
														->where('noinduk', $noinduk)
														->where('semester', $semestercari)
														->where('tapel', $tapel)
														->where('matpel', $muatan)
														->where('id_sekolah', $cekdata->id_sekolah)
														->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
														->groupBy('noinduk')
														->first();
										
										$golekharian = DB::table('db_nilai')
														->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
														->where('noinduk', $noinduk)
														->where('semester', $semestercari)
														->where('tapel', $tapel)
														->where('matpel', $muatan)
														->where('id_sekolah', $cekdata->id_sekolah)
														->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
														->groupBy('noinduk')
														->first();
						
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
									}
									$totalsum	= $totalsum + $angka;
									$pembagisum++;
									
									if ($angka == 0){
										$terbilang = 'Nol';
									} else {
										$terbilang 	= ($angka != 0) ? SendMail::terbilang($angka) : '';
									}
								}
								$matpel = str_replace('Mulok; ', '', $matpel);
								$matpel = str_replace('Wajib; ', '', $matpel);
								$tabelatas[] = [
									'nomor' 		=> $nomor,
									'matpel' 		=> $matpel,
									'kkm' 			=> $kkm,
									'angka' 		=> $angka,
									'terbilang' 	=> $terbilang,
									'afektif' 		=> $afektif,
									'kode' 			=> $kode,
									'field_huruf' 	=> $field_huruf,
									'field_nilai' 	=> $field_nilai,
								];
								$nomor++;
							}
						}
						if ($totalsum != 0 AND $pembagisum != 0){
							$ratareal 			= $totalsum/$pembagisum;
							$rataakhir 			= round($ratareal, 0);
						} else {
							$rataakhir			= 0;
							$ratareal			= 0;
						}
						$terbilang 				= ($totalsum != 0) ? SendMail::terbilang($totalsum) : '';
						Rapotan::where('noinduk', $noinduk)->where('semester', $cekdata->semester)->where('tapel', $cekdata->tapel)->where('id_sekolah', $cekdata->id_sekolah)->update([
							'ratarata'			=> $ratareal,
							'total'				=> $totalsum,
							'jumlahmatpel'		=> $pembagisum,
						]);
						$jumlah 				= 0;
						if ($ttdkasek != '[ttdks]'){
							try {
								$keterangan = 'Rapot Link '.url('/').'/printmark/'.$marking.' Di Tandatangani Oleh '.$cekdata->namakepalasekolah.' Pada '.date('Y-m-d H:i:s');
								$qrcode		= base64_encode(QrCode::format('png')->size(100)->generate($keterangan));
								$ttdkasek	= '<img src="data:image/png;base64, '.$qrcode.'" height="100" />';
							} catch (\Exception $e) {
								$ttdkasek 	= '<img src="'.$ttdkasek.'" height="100" />';
							}
							$jumlah++;
						} else {
							$ttdkasek = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
						}
						if ($ttdortu != '[ttdortu]'){
							$ttdortu 	= '<img src="'.$ttdortu.'" height="100" />';
						} else {
							$ttdortu = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
						}
						if ($ttdguru != '[ttdguru]'){ 
							try {
								$keterangan = 'Rapot Link '.url('/').'/printmark/'.$marking.' Di Tandatangani Oleh '.$cekdata->namaguru.' Pada '.date('Y-m-d H:i:s');
								$qrcode		= base64_encode(QrCode::format('png')->size(100)->generate($keterangan));
								$ttdguru	= '<img src="data:image/png;base64, '.$qrcode.'" height="100" />';
							} catch (\Exception $e) {
								$ttdguru 	= '<img src="'.$ttdguru.'" height="100" />';
							}
							$jumlah++;
						} else {
							$ttdguru = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
						}
						$data['terbilang']		= $terbilang;
						$data['rataakhir']		= $rataakhir;
						$data['totalsum']		= $totalsum;
						$data['ttdortu']		= $ttdortu;
						$data['ttdguru']		= $ttdguru;
						$data['ttdkasek']		= $ttdkasek;
						$data['kopsurat']		= url('/').'/format/kop_rapot_sdtq.jpg';
						$data['tabelatas']		= $tabelatas;
						$data['datarapot']		= $cekdata;
						$data['sekolah']		= $cekdata->namasekolah ?? Session('sekolah_nama_sekolah');
						$data['tanggal']		= $tanggal;
						$data['rapotakhlak']	= $rapotakhlak;
						$data['saran']			= $cekdata->saran;
						if ($cekdata->semester == '1.1' OR $cekdata->semester == '2.1'){
							$generatesurat			= view('cetak.rapottengahkhas', $data)->render();
						} else {
							$generatesurat			= view('cetak.rapotkhas', $data)->render();
						}
						XFiles::updateOrCreate(
							[
								'xmarking'	=> $marking,
							],
							[
								'xtabel'	=> 'db_rapotan',
								'xfile'		=> $generatesurat
							]
						);
						if ($jumlah == 2 AND $cekrapotakhlak != 'arsip'){
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $ttdks,
								],
								[
									'xfile'		=> 'final'
								]
							);
							/*
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $akhlak,
								],
								[
									'xfile'		=> 'arsip'
								]
							);
							*/
						}
						return $generatesurat;
					}
				} else {
					$ceksurat 	= XFiles::where('xmarking', $marking)->first();
					$surat 		= $ceksurat->xfile ?? '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
					return $surat;
				}
			} else {
				$data['generatetbl']  = '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
				return view('cetak.suratgenerator', $data);
			}
			
		} else if ($tabel == 'rapotalquran'){
			$getarrayid 		= explode('.', $id);
			$tapelsemester 		= $getarrayid[0];
			$semester 			= $getarrayid[1];
			$kelas 				= $getarrayid[2] ?? '';
			$niyguru 			= $getarrayid[3] ?? '';
			$noinduk 			= $getarrayid[4] ?? '';
			$gettapelonly 		= explode('-', $tapelsemester);
			$tahun1 			= $gettapelonly[0] ?? '';
			$tahun2 			= $gettapelonly[1] ?? '';
			$nama				= '';
			$foto				= '';
			$hariefektif		= '';
			$harisetorsekolah	= '';
			$harisetorrumah		= '';
			$niywaka			= '';
			$waka				= '';
			$niykasek			= '';
			$kasek				= '';
			$sakit				= '';
			$ijin				= '';
			$alpha				= '';
			$namaguru			= '';
			$id_sekolah			= '';
			$tapel				= '';
			$tanggal 			= date('Y-m-d');
			if (Session('sekolah_id_sekolah') !== null){
				$getdata 			= MushafUjian::where('noinduk', $noinduk)->where('tapelsemester', $tapelsemester)->where('id_sekolah',  Session('sekolah_id_sekolah'))->groupBy('juz')->orderByRaw('CAST(SUBSTRING_INDEX(Juz, " ", -1) AS UNSIGNED) ASC')->get();
			} else {
				$getdata 			= MushafUjian::where('noinduk', $noinduk)->where('tapelsemester', $tapelsemester)->where('kelas', $kelas)->groupBy('juz')->orderByRaw('CAST(SUBSTRING_INDEX(juz, " ", -1) AS UNSIGNED) ASC')->get();
			}
			$i					= 0;
			foreach ($getdata as $rgrpklas) {
				$j  			= 0;
				$juz			= $rgrpklas->juz;
				$id_sekolah		= $rgrpklas->id_sekolah;
				$jklas  		= MushafUjian::where('juz', $juz)->where('noinduk', $noinduk)->where('tapelsemester', $tapelsemester)->where('id_sekolah',  $id_sekolah)->orderBy('halaman', 'ASC')->get();
				foreach ($jklas as $rklas) {
					$nama 										= $rklas->nama;
					$foto 										= $rklas->foto;
					$hariefektif 								= $rklas->hariefektif;
					$harisetorsekolah 							= $rklas->setoransekolah;
					$harisetorrumah 							= $rklas->setoranrumah;
					$niywaka 									= $rklas->niywaka;
					$waka 										= $rklas->namawakaalquran;
					$niykasek 									= $rklas->niyks;
					$kasek 										= $rklas->namaks;
					$sakit 										= $rklas->sakit;
					$ijin 										= $rklas->ijin;
					$alpha 										= $rklas->alpha;
					$niyguru 									= $rklas->niyguru;
					$namaguru 									= $rklas->namaguru;
					$tapel 										= $rklas->tapel;
					$created_at 								= $rklas->created_at;
					$gettanggalonly 							= explode(' ', $created_at);
					$tanggal									= $gettanggalonly[0];
					$data['perjuz'][$i][$j]['juz']				= $rklas->juz;
					$data['perjuz'][$i][$j]['namasurah']		= $rklas->namasurah;
					$data['perjuz'][$i][$j]['halaman']			= $rklas->halaman;
					$data['perjuz'][$i][$j]['jumlahkata']		= $rklas->jumlahkata;
					$data['perjuz'][$i][$j]['jumlahkesalahan']	= $rklas->jumlahkesalahan;
					$data['perjuz'][$i][$j]['nilaikesalahan']	= $rklas->nilaikesalahan;
					$data['perjuz'][$i][$j]['nilaipersurat']	= $rklas->nilaipersurat;
					$data['perjuz'][$i][$j]['predikat']			= $rklas->predikat;
					$data['perjuz'][$i][$j]['nilaiperjuz']		= $rklas->nilaiperjuz;
					$j++;
				}
				$i++;
			}
			$x  = 0;
			foreach ($getdata as $kgrpklas) {
				$data['juznumber'][$x]  	= $kgrpklas->juz;
				$x++;
			}
			if ($i == 0){
				$data['juznumber'][0]  					=   '-';
				$data['perjuz'][0][0]['juz']			=   '0';
				$data['perjuz'][0][0]['namasurah']		=   'No Data';
				$data['perjuz'][0][0]['halaman']		=   '0';
				$data['perjuz'][0][0]['jumlahkata']		=   '0';
				$data['perjuz'][0][0]['jumlahkesalahan']=   '0';
				$data['perjuz'][0][0]['nilaikesalahan']	=   '-';
				$data['perjuz'][0][0]['nilaipersurat']	=   '-';
				$data['perjuz'][0][0]['predikat']		=   '-';
				$data['perjuz'][0][0]['nilaiperjuz']	=   '0';
			}
			$markingguru		= $tapelsemester.'-'.$kelas.'-'.$noinduk.'-'.$id_sekolah.'-RapotAlQuran';
			$markingttdks 		= $tapelsemester.'-'.$kelas.'-'.$noinduk.'-'.$id_sekolah.'-TTDKS';
			$markingwaka 		= $tapelsemester.'-'.$kelas.'-'.$noinduk.'-'.$id_sekolah.'-TTDWAKA';

			$ceksudah 			= XFiles::where('xmarking', $markingguru)->first();
			if (isset($ceksudah->xfile) AND $ceksudah->xfile != ''){
				$data['generatetbl']  = $ceksudah->xfile;
				return view('cetak.suratgenerator', $data);
			} else {
				$final1 	= 0;
				$final2 	= 0;
				$cekttdwaka = XFiles::where('xmarking', $markingwaka)->first();
				if (isset($cekttdwaka->xfile) AND $cekttdwaka->xfile != ''){
					try {
						$keterangan = 'Rapot Link '.url('/').'/rapotalquran/'.$id.' Di Tandatangani Oleh '.$waka.' Pada '.$cekttdwaka->created_at;
						$qrcode		= base64_encode(QrCode::format('png')->size(100)->generate($keterangan));
						$ttdwaka	= '<img src="data:image/png;base64, '.$qrcode.'" height="100" />';
					} catch (\Exception $e) {
						$ttdwaka	= '<img src="'.$cekttdwaka->xfile.'" height="100" />';
					}
					$final1  = 1;
				} else {
					$ttdwaka = '<img src="'.url('/').'/boxed-bg.jpg" height="100" />';
				}
				$cekttdkasek 	= XFiles::where('xmarking', $markingttdks)->first();
				if (isset($cekttdkasek->xfile) AND $cekttdkasek->xfile != ''){
					try {
						$keterangan = 'Rapot Link '.url('/').'/rapotalquran/'.$id.' Di Tandatangani Oleh '.$kasek.' Pada '.$cekttdkasek->created_at;
						$qrcode		= base64_encode(QrCode::format('png')->size(100)->generate($keterangan));
						$ttdkasek	= '<img src="data:image/png;base64, '.$qrcode.'" height="100" />';
					} catch (\Exception $e) {
						$ttdkasek 	= '<img src="'.$cekttdkasek->xfile.'" height="100" />';
					}
					$final2   = 1;
				} else {
					$ttdkasek =  '<img src="'.url('/').'/boxed-bg.jpg" height="100" />';
				}
				$cekarraytapelsemester = explode('-', $tapelsemester);
				if (isset($cekarraytapelsemester[3])){
					$jenisujian = $cekarraytapelsemester[3];
				} else {
					$jenisujian	= '';
				}
				if ($semester == '1'){
					$kopsurat = url('/').'/format/kop_ujian_alquran_ganjil.jpg';
					$semester = 'GANJIL';
				} else if ($semester == '2'){
					$kopsurat = url('/').'/format/kop_ujian_alquran_genap.jpg';
					$semester = 'GENAP';
				} else {
					$kopsurat = url('/').'/format/kop_ujian_alquran.jpg';
				}
				if ($id_sekolah == '2'){
					$kopsurat = url('/').'/format/kop_rapot_mataba.png';
				}
				
				if ($jenisujian == 'UTS'){
					$semester = 'TENGAH SEMESTER '.$semester;
				} else if ($jenisujian == 'UAS'){
					$semester = 'AKHIR SEMESTER '.$semester;
				} else {
					$semester = 'JUZ '.$jenisujian.' SEMESTER '.$semester;
				}
				$getkelasalquran 			= Datainduk::where('id_sekolah', $id_sekolah)->where('noinduk', $noinduk)->first();
				$jilid 						= $getkelasalquran->jilid ?? '';
				$arrtangggal				= explode('-', $tanggal);
				$dd         				= $arrtangggal[2];
				$mm         				= (int)$arrtangggal[1];
				$mm							= $kalender[$mm];
				$tahuniki   				= $arrtangggal[0];
				$sakniki					= $dd.' '.$mm.' '.$tahuniki;
				$data['id_sekolah']  		= $id_sekolah;
				$data['kopsurat']  			= $kopsurat;
				$data['tapel']  			= $tapel;
				$data['semester']  			= $semester;
				$data['jilid']  			= $jilid;
				$data['kelas']  			= $kelas;
				$data['namaguru']  			= $namaguru;
				$data['niyguru']  			= $niyguru;
				$data['nama']  				= strtoupper($nama);
				$data['foto']  				= $foto;
				$data['hariefektif']  		= $hariefektif;
				$data['harisetorsekolah']  	= $harisetorsekolah;
				$data['harisetorrumah']  	= $harisetorrumah;
				$data['niywaka']  			= $niywaka;
				$data['waka']  				= $waka;
				$data['niykasek']  			= $niykasek;
				$data['kasek']  			= $kasek;
				$data['sakit']  			= $sakit;
				$data['ijin']  				= $ijin;
				$data['alpha']  			= $alpha;
				$data['ttdkasek']  			= $ttdkasek;
				$data['ttdwaka']  			= $ttdwaka;
				$data['tanggal']  			= $sakniki;
				$final 						= $final1 + $final2;
				if ($final == 2){
					$generatesurat 			= view('cetak.rapotalquran', $data)->render();
					XFiles::updateOrCreate(
						[
							'xmarking'		=> $markingguru,
						],
						[
							'xtabel'	=> 'mushaf_ujian',
							'xjenis'	=> $id_sekolah.';'.$noinduk,
							'xfile'		=> $generatesurat
						]
					);
				} else {
					return view('cetak.rapotalquran', $data);
				}
			}
		} else if ($tabel == 'hasilujianlisan'){
			$getarrayid 	= MushafUjianLisan::where('id', $id)->first();
			$semester		= $getarrayid->semester;
			$updated_at		= $getarrayid->updated_at;
			$hasilujianlisan= $getarrayid->tapel.'-'.$getarrayid->semester.'-'.$getarrayid->kelas.'-'.$getarrayid->noinduk.'-'.$getarrayid->id_sekolah.'-HasilUjianLisan';
			$ttdks 			= $getarrayid->tapel.'-'.$getarrayid->semester.'-'.$getarrayid->kelas.'-'.$getarrayid->noinduk.'-'.$getarrayid->id_sekolah.'-TTDKS';
			$ceksudah 		= XFiles::where('xmarking', $hasilujianlisan)->first();
			if (isset($ceksudah->xfile) AND $ceksudah->xfile != ''){
				$data['generatetbl']  = $ceksudah->xfile;
				return view('cetak.suratgenerator', $data);
			} else {
				if ($semester == '1'){
					$kopsurat = url('/').'/format/kop_ujian_lisan_ganjil.jpg';
					$semester = 'GANJIL';
				} else if ($semester == '2'){
					$kopsurat = url('/').'/format/kop_ujian_lisan_genap.jpg';
					$semester = 'GENAP';
				} else {
					$kopsurat = url('/').'/format/kop_ujian_lisan.jpg';
				}
				$arrtangggal				= explode(' ', $updated_at);
				$tanggal         			= $arrtangggal[0];
				$arrtangggal				= explode('-', $tanggal);
				$dd         				= $arrtangggal[2];
				$mm         				= (int)$arrtangggal[1];
				$mm							= $bulan_arab[$mm];
				$tahuniki   				= $arrtangggal[0];
				$dd 						= angka_ke_teks_arab($dd);
				$tahuniki 					= angka_ke_teks_arab($tahuniki);
				$formatArab					= $dd.' '.$mm.' '.$tahuniki;
				$teksKotaArab 				= "تحريرا في مالانج ";
				$hasilAkhir 				= $teksKotaArab.' '.$formatArab;
				$data['kopsurat']  			= $kopsurat;
				$data['tanggal']  			= $hasilAkhir;
				$data['getdata']  			= $getarrayid;
				if (isset($getarrayid->penandatangan)){
					try {
						$keterangan 	= 'Rapot Link '.url('/').'/printmark/'.$hasilujianlisan.' Di Tandatangani Oleh '.$getarrayid->penandatangan.' Pada '.$getarrayid->updated_at;
						$qrcode			= base64_encode(QrCode::format('png')->size(100)->generate($keterangan));
						$ttdks			= '<img src="data:image/png;base64, '.$qrcode.'" height="100" />';
					} catch (\Exception $e) {
						$ttdks 			= '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
					}
				} else {
					$ttdks 				= '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
				}
				$data['ttdks']  		= $ttdks;
				$generatesurat 			= view('cetak.hasilujianalquran', $data)->render();
				if ($ttdks != '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'){
					XFiles::updateOrCreate(
						[
							'xmarking'	=> $hasilujianlisan,
						],
						[
							'xtabel'	=> 'mushaf_ujianlisan',
							'xjenis'	=> $getarrayid->id_sekolah.';'.$getarrayid->noinduk,
							'xfile'		=> $generatesurat
						]
					);
				}
				return $generatesurat;
			}
		}
    }
    public function index() {
		$data 		= [];
		$previlage  =  Session('previlage');
		if ($previlage == null OR $previlage == ''){
			return redirect('/');
		} else {
			$tahun						= date("Y");
			$urutanwerno				= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
			$urutanbg					= array('primary','success','warning','info','danger','secondary','primary','success','warning','info');
			$data['namaapps01']  		= Session('sekolah_nama_aplikasi');
			$data['domainapps01']  		= Session('sekolah_nama_yayasan');
			$data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
			$data['subsubdomainapps01'] = Session('sekolah_kode_sekolah');
			$data['addressapps01']  	= Session('sekolah_alamat');
			$data['emailapps01']  		= Session('sekolah_email');
			$data['lamanapps01']  		= parse_url(request()->root())['host'];
			$data['logofrontapps01']  	= Session('sekolah_frontpage');
			$data['logo01']  			= url("/").'/'.Session('sekolah_logo');
			$data['sidebar']		    = 'dashbord';
			if ($previlage == 'ortu'){
				$groups     = Pengumuman::where('id_sekolah', Session('sekolah_id_sekolah'))->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
				$y      	= 0;
				$x      	= 0;
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
				return view('simaster.index', $data);
			} else {
				$data['allkegiatan'] = RencanaKegiatan::where('tahun', date('Y'))->orderBy('status', 'ASC')->orderBy('mulai', 'ASC')->paginate(10);
				return view('simaster.indexmanagement', $data);
			}
		}
    }
	public function FrontPageindex(Request $request) {
		$data			= [];
		$urutanwerno	= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		$urutanbg		= array('primary','success','warning','info','danger','secondary','primary','success','warning','info');
		$id 			= $request->input('id');
		$firebaseid 	= $request->input('firebaseid');
		$previlage  	= Session('previlage');
        if ($previlage !== null) {
			return redirect('dashbord');
        } else {
			$ceksek = explode('?firebaseid=', $id);
			if (isset($ceksek[1])){
				$id 		= $ceksek[0];
				$firebaseid = $ceksek[1];
			}
			if ($firebaseid != '' AND $firebaseid !== null){
				$user  	= User::where('firebaseid', $firebaseid)->where('id_sekolah', $id)->first();
			} else {
				$user 	= null;
			}
			$sql = Sekolah::where('id', $id)->first();
			if (isset($user->previlage) AND isset($sql->id)){
				Auth::login($user);
				$previlage 			= $user->previlage;
				$idsekolah 			= $user->id_sekolah;
				$idne 				= $user->id;
				$fakultas 			= $user->fakultas;
				$cekidmark1 		= XFiles::where('xmarking', 'Foto-'.$user->username)->first();
				if (isset($cekidmark1->xfile)){
					$foto 			= $cekidmark1->xfile;
				} else {
					$foto 			= url('/').'/'.$sql->logo;
				}
				session(['id' 					=> $user->id]);
				session(['nama' 				=> $user->nama]);
				session(['username' 			=> $user->username]);
				session(['previlage'			=> $user->previlage]);
				session(['fakultas' 			=> $user->fakultas]);
				session(['fakpanjang' 			=> $user->fakpanjang]);
				session(['email' 				=> $user->email]);
				session(['nip'					=> $user->nip]);
				session(['spesial' 				=> $user->spesial]);
				session(['fbid' 				=> $user->firebaseid]);
				session(['avatar' 				=> $foto]);
				session(['sekolah_nama_aplikasi'=> 'SIMASTER']);
				session(['sekolah_id_sekolah'	=> $idsekolah]);
				session(['sekolah_level'		=> $sql->level]);
				session(['sekolah_nama_yayasan'	=> $sql->nama_yayasan]);
				session(['sekolah_nama_sekolah'	=> $sql->nama_sekolah]);
				session(['sekolah_kode_sekolah'	=> $sql->kode_sekolah]);
				session(['sekolah_nis'			=> $sql->nis]);
				session(['sekolah_nss'			=> $sql->nss]);
				session(['sekolah_npsn'			=> $sql->npsn]);
				session(['sekolah_alamat'		=> $sql->alamat]);
				session(['sekolah_kota'			=> $sql->kota]);
				session(['sekolah_telp'			=> $sql->telp]);
				session(['sekolah_email'		=> $sql->email]);
				session(['sekolah_slogan'		=> $sql->slogan]);
				session(['sekolah_logo'			=> $sql->logo]);
				session(['sekolah_frontpage'	=> $sql->frontpage]);
				return redirect('dashbord');
			} else {
				if (isset($sql->id)){
					$profile 				= '';
					$visimisi 				= '';
					$strukturorganisasi 	= '';
					$pendidik 				= '';
					$jadwal 				= '';
					$kontak 				= '';
					$sertamerta 			= '';
					$setiapsaat 			= '';
					$pengumuman 			= '';
					$getdata 				= Layanan::where('id_sekolah',$id)->orderBy('layanan', 'ASC')->get();
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
					$groups     = Pengumuman::where('id_sekolah', $id)->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'DESC')->limit(30)->get();
					$y      	= 0;
					$x      	= 0;
					foreach ($groups as $group) {
						$tanggal    = $group->tanggal;
						$rsurat     = Pengumuman::where('id_sekolah', $id)->where('tanggal', 'like', '%'. $tanggal . '%')->orderBy('id', 'DESC')->limit(30)->get();
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
					$data['id_sekolah']			= $sql->id;
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
				} else {
					return redirect('/');
				}
			}
        }
	}
	//Chatting
	public function chatGetlist(Request $request) {
		$idevent 	= $request->input('val02');
		$kelompok	= Session('previlage');
		$nmlengkap	= Session('nama');
		if (Session('sekolah_id_sekolah') !== null){
			$idsekolah 	= Session('sekolah_id_sekolah');
			$logo 		= url("/").'/'.Session('sekolah_logo');
			$isipesan		= '';
			$getdata 		= User::where('username', Session('username'))->first();
			if (isset($getdata->id)){
				$klsajar 	= $getdata->klsajar;
			} else { $klsajar = ''; }
			if (Session('noinduk') !== null){
				$qcatting	= null;
				echo '
				<div class="direct-chat-msg left">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">Waktu Terlarang</span>
						<span class="direct-chat-timestamp pull-left">Now</span>
					</div><!-- /.direct-chat-info -->
					<img class="direct-chat-img" src="/mascot.png" alt="message user image" />
					<div class="direct-chat-text">
						No Chat While On Test Mode
					</div>
				</div>';
			} else {
				if ($idevent == '' OR $idevent == '0' OR $idevent == null){
					$qcatting	= Chatting::where('id_sekolah', $idsekolah)->orderBy('id', 'DESC')->limit(100)->get();
				} else {
					$qcatting	= Chatting::where('id_sekolah', $idevent)->orderBy('id', 'DESC')->limit(100)->get();
				}
			}
			if (!empty($qcatting)){
				foreach ($qcatting as $chat) {
					$pesan 		= $chat->pesannya;				
					$waktu 		= $chat->created_at;
					$nama 		= $chat->nama;
					$ket 		= $chat->ket;
					if ($ket == '' OR is_null($ket)){
						if ($logo == ''){
							$gravatar1 	= url('/mascot.png');
							$gravatar2 	= url('/duidev-softwarehouse.png');
						} else {
							$gravatar1 	= $logo;
							$gravatar2	= $logo;
						}
					} else {
						$gravatar1 = $ket;
						$gravatar2 = $ket;
					}
					if ($nama == $nmlengkap){
						echo '<div class="direct-chat-msg left">
								<div class="direct-chat-info clearfix">
									<span class="direct-chat-name pull-right">'.$nama.'</span>
									<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
								</div>
								<img class="direct-chat-img" src="'.$gravatar1.'" alt="message user image" />
								<div class="direct-chat-text">
									'.$pesan.'
								</div>
							</div>';
					} else {
						echo '<div class="direct-chat-msg right">
								<div class="direct-chat-info clearfix">
									<span class="direct-chat-name pull-right">'.$nama.'</span>
									<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
								</div>
								<img class="direct-chat-img" src="'.$gravatar2.'" alt="message user image" />
								<div class="direct-chat-text">
									'.$pesan.'
								</div>
							</div>';
					}
				}
			}
		} else {
			echo '<div class="direct-chat-msg left">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">System</span>
						<span class="direct-chat-timestamp pull-left">now</span>
					</div>
					<img class="direct-chat-img" src="logo.png" alt="message user image" />
					<div class="direct-chat-text">
						Session Expired, Please Relogin
					</div>
				</div>';
		}
    }
	public function cattingSurat(Request $request) {
		$kelompok	= Session('previlage');
		$nmlengkap	= Session('nama');
		$pesan		= $request->input('val01');
		$idevent	= $request->input('idevent');
		$logo 		= url("/").'/'.Session('sekolah_logo');
		$getdata 	= User::where('username', Session('username'))->first();
		if (isset($getdata->id)){
			$klsajar 	= $getdata->klsajar;
		} else { $klsajar = ''; }
		if ($idevent == '' OR $idevent == '0' OR $idevent == null){
			$idsekolah 	= Session('sekolah_id_sekolah');
		} else {
			$idsekolah 	= $idevent;
			$logo 		= $request->input('val03');
		}
		if (Session('avatar') !== null){
			$gravatar	= Session('avatar');
		} else if (Session('sekolah_logo') !== null){
			$gravatar	= url("/").'/'.Session('sekolah_logo');
		} else {
			$gravatar	= url('/duidev-softwarehouse.png');
		}
		if ($pesan != ''){
			$pesan = formatPesan($pesan);
			if (Session('noinduk') !== null){
			} else {
				$input = Chatting::insert([
					'kelompok'  	=>  $kelompok,
					'nama'  		=>  $nmlengkap,
					'pesannya'		=>  $pesan,
					'ket'			=>  $gravatar,
					'id_sekolah'	=>	$idsekolah
				]);
				event(new \App\Events\NotifController('New Message From '.$nmlengkap.': '.$pesan));
			}
		}
		
		if (Session('noinduk') !== null){
			$qcatting	= null;
			echo '
				<div class="direct-chat-msg left">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">Waktu Terlarang</span>
						<span class="direct-chat-timestamp pull-left">Now</span>
					</div><!-- /.direct-chat-info -->
					<img class="direct-chat-img" src="/mascot.png" alt="message user image" />
					<div class="direct-chat-text">
						No Chat While On Test Mode
					</div>
				</div>';
		} else {
			$qcatting	= Chatting::where('id_sekolah', $idsekolah)->orderBy('id', 'DESC')->limit(100)->get();
    	}
		if (!empty($qcatting)){
			foreach ($qcatting as $chat) {
				$pesan 		= $chat->pesannya;				
				$waktu 		= $chat->created_at;
				$nama 		= $chat->nama;
				$ket 		= $chat->ket;
				if ($ket == '' OR is_null($ket)){
					if ($logo == ''){
						$gravatar1 	= url('/mascot.png');
						$gravatar2 	= url('/duidev-softwarehouse.png');
					} else {
						$gravatar1 	= $logo;
						$gravatar2	= $logo;
					}
				} else {
					$gravatar1 = $ket;
					$gravatar2 = $ket;
				}
				if ($nama == $nmlengkap){
					echo '<div class="direct-chat-msg left">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-right">'.$nama.'</span>
								<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
							</div>
							<img class="direct-chat-img" src="'.$gravatar1.'" alt="message user image" />
							<div class="direct-chat-text">
								'.$pesan.'
							</div>
						</div>';
				} else {
					echo '<div class="direct-chat-msg right">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-right">'.$nama.'</span>
								<span class="direct-chat-timestamp pull-left">'.$waktu.'</span>
							</div>
							<img class="direct-chat-img" src="'.$gravatar2.'" alt="message user image" />
							<div class="direct-chat-text">
								'.$pesan.'
							</div>
						</div>';
				}
			}
		}
    }
	//Persuratan Lain-Lain
	public function viewSurat ($id){
		$surat = self::genSurat($id, 'suratijin');
		return $surat;
	}
	public function viewLampiran ($id){
		$surat = self::genSurat($id, 'zis');
		return $surat;
	}
	public function viewBuktiBayar ($id){
		$surat = self::genSurat($id, 'pembayaran');
		return $surat;
	}
	public function ctkKwitansi($id) {
		$tasks			= [];
		$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
		$marking		= $id;
		$homebase		= url("/");
		$alamatcetak	= $homebase.'/kwitansi/'.$marking;
		$sql 			= Pembayaran::where('marking', $marking)->first();
		if (isset($sql->id)){
			$verifikasi	= $sql->verifikasi;
			$kirim		= $sql->kirim;
			$id_sekolah	= $sql->id_sekolah;
			$niy		= $sql->inputor;
			$asline		= '';
			$getnama 	= User::where('nip', $niy)->first();
			if (isset($getnama->nama)){
				$asline	= $getnama->nama;
			}
		} else {
			$verifikasi	= '';
			$kirim 		= 'Belum di Verifikasi';
			$id_sekolah	= session('sekolah_id_sekolah');
			$niy 		= Session('nip');
			$asline 	= Session('nama');
		}
		
		if ($verifikasi == ''){
			$jeneng			= 'Belum Di Verifikasi';
			$tgliki 		= date('d');
			$mthiki 		= date('m');
			$mthiki 		= (int)$mthiki;
			$thniki 		= date('Y');
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
			$kirim 			= 'Belum di Verifikasi';
		} else {
			$gettanggal		= substr($verifikasi, -8);
			$jeneng			= str_replace($gettanggal, '', $verifikasi);
			$arrtanggal 	= str_split($gettanggal);
			$ceknama		= User::where('username', 'LIKE', $jeneng.'%')->first();
			if (isset($ceknama->nama)){
				$jeneng		= $ceknama->nama;
				$asline		= $jeneng;
			}
			$tgliki 		= $arrtanggal[0].$arrtanggal[1];
			$mthiki 		= $arrtanggal[2].$arrtanggal[3];
			$mthiki 		= (int)$mthiki;
			$thniki 		= $arrtanggal[4].$arrtanggal[5].$arrtanggal[6].$arrtanggal[7];
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
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
		$sql 		= Pembayaran::where('marking', $marking)->where('id_sekolah', $id_sekolah)->get();
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
				$cekekskul	= Ekstrakulikuler::where('nama', $jenis)->where('id_sekolah', $id_sekolah)->count();
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
						$cekinsidental = Insidental::where('kode', $jenis)->where('id_sekolah', $id_sekolah)->first();
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
		$x 			= SendMail::terbilang($total);
		if ($ekskula2 != 0){
			$tekskula2	= number_format( $ekskula2 , 0 , '.' , ',' );
		}
		else { $tekskula2 = ''; }
		
		if ($ekskulb2 != 0){
			$tekskulb2	= number_format( $ekskulb2 , 0 , '.' , ',' );
		}
		else { $tekskulb2 = ''; }
		
		if ($ekskulc2 != 0){
			$tekskulc2	= number_format( $ekskulc2 , 0 , '.' , ',' );
		}
		else { $tekskulc2 = ''; }
		
		if ($ekskuld2 != 0){
			$tekskuld2	= number_format( $ekskuld2 , 0 , '.' , ',' );
		}
		else { $tekskuld2 = ''; }
		
		if ($ekskule2 != 0){
			$tekskule2	= number_format( $ekskule2 , 0 , '.' , ',' );
		}
		else { $tekskule2 = ''; }
		
		if ($biayaspp != 0){
			$tbiayaspp	= number_format( $biayaspp , 0 , '.' , ',' );
		}
		else { $tbiayaspp = ''; }
		
		if ($biayadpp != 0){
			$tbiayadpp	= number_format( $biayadpp , 0 , '.' , ',' );
		}
		else { $tbiayadpp = ''; }
		
		if ($paguyuban != 0){
			$tpaguyuban	= number_format( $paguyuban , 0 , '.' , ',' );
		}
		else { $tpaguyuban = ''; }
		
		if ($bkegiatan != 0){
			$tkegiatan	= number_format( $bkegiatan , 0 , '.' , ',' );
		}
		else { $tkegiatan = ''; }
		
		if ($bbukupaket != 0){
			$tbukupaket	= number_format( $bbukupaket , 0 , '.' , ',' );
		}
		else { $tbukupaket = ''; }
		
		if ($bbukutulis != 0){
			$tbukutulis	= number_format( $bbukutulis , 0 , '.' , ',' );
		}
		else { $tbukutulis = ''; }
		
		if ($lain1a != 0){
			$tlain1a	= number_format( $lain1a , 0 , '.' , ',' );
		}
		else { $tlain1a = ''; }
		if ($lain2a != 0){
			$tlain2a	= number_format( $lain2a , 0 , '.' , ',' );
		}
		else { $tlain2a = ''; }
		
		if ($lain3a != 0){
			$tlain3a	= number_format( $lain3a , 0 , '.' , ',' );
		}
		else { $tlain3a = ''; }
		
		if ($lain4a != 0){
			$tlain4a	= number_format( $lain4a , 0 , '.' , ',' );
		}
		else { $tlain4a = ''; }
		try {
			$qrcode 				= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
		} catch (\Exception $e) {
			$qrcode 				= 'iVBORw0KGgoAAAANSUhEUgAAAPoAAAD6CAMAAAC/MqoPAAABUFBMVEVHcEzT09Py8vLu7u7a2tr09PT09PTBwcHz8/Pp6enz8/Pp6enx8fH09PT09PTz8/Pw8PDt7e3w8PDn5+fu7u7x8fH09PTz8/Py8vLz8/Pz8/P09PTx8fHy8vLz8/Px8fHw8PDy8vLy8vLy8vLz8/OPj4+GhoaJiYmAgICHh4eGhoa1tbXJycmYmJjV1dW5ubm5ubmEhITg4OC/v7/Dw8O4uLiPj4+8vLyBgYF+fn7Nzc2amprR0dHd3d3p6en09PT09PTk5OTy8vKZmZnc3Nzh4eGVlZXw8PBiYmKlpaWQkJB0dHTu7u7s7Oze3t7JycmLi4vq6urU1NSFhYWfn5+9vb1oaGjOzs5vb29XV1fCwsKwsLDR0dGIiIjGxsbo6Oirq6u1tbVsbGxcXFz39/d4eHhfX1/Y2NhUVFS6urpOTk6AgIBERERJSUlBQUE/Pz9TfwEQAAAAQXRSTlMABHAfCaL5Ad0NyBJZ8+bTRCg7GjJO7cGqupOQhn6yYWl3mYyfKBdjvto+imm40qZefp3fTcaRNvCfteWJ7e3//sQynkgAABqbSURBVHja7J35VxrJFoDZpEFUdlziiibGTDIZ38wkmcmb0+zYDQJCAwoiWxCR5P3/P76uql6qQQF718k9Z+bXme989966XbcbLZaf8TN+xs9QGA6PPeRb2T/YPoxGj46i0cPtg/2VcMAfdBAvF9rqCYUPopvetYgzRkoi5lxd864v7ewF7I6X59oe3tnwRpyAc4IbwaN/r7rWt/YCnpfj3+Pb2XU5yUUj4l3aD72xPn/uYHjLu0o+NSK/fvh0/PrNM+Z2+155naSc+FZoJr8C/GdZ/ITftr5Kyo6LajKZzHz9cPruucl3BLZcpKLI1hmWnQ2W/hm5d/g2IqTiSHUgO52hPxy/Jp4J+O4qqUa0R1B7hqbpk0/PQD0R2FAHHCR9keHQabr09tjcVU/YDyOkijGkMrz4UunEzPCOPS+pbsSbSV58qdQ6OTUrfGjDSaod+WpS9N5qmdO8Y99FahAJVPCIvdSqvD12mK7Kj5ykNlGWsLPw78x11PmWSc2iQIn1Dti/fHptpmRfIzWMdEfqfXximqz3vHKSmkZ8gr3y5a/X5ijzDVLraE+wt1jxJnioD62T2seU98rYePEBrw7k5Lf0FDvb6g1u7S5Sn0B9XsL+5dTxbyBnn2KZqZwf//Xm30BOktdMJikO9ND72KikJwJ6kpOJm6RkoIfeT4xhD3lJXSM7krK3APuXYwPmWv8yqXO0m1PslbEBzS64SeoeBQpnN6rZuY9IA4K/qM2UjGO37sSMQM/CC3qgvYKzv9WTfWWVNCTaHY69NJaw6zfVhlykQTFkUx7Cj41hD64bRU4mGgwD2ekcxl7Ri936ijQu2h3Oe+VSf3bCqELnB1rknc7lKnqz+11GkrNDHYsO4CuXgJ3Wkd2xQRobBYpBOT+4zLXwwU7zM27faTA66HQMp33Qwgd6jWcbg9MdXVch9kyOZS9Jbq20nOcdR6TxUWQoyM5qzw1onP1Uu9tKIrxqAvQ21M5A7eB4F9m/HGs3zCyTZogihbyPWXSWPYOxa3Z3cWAKcrbaKeidBtpzFewhdnzy+sX2OO6yioLekwOAPijh7NoccdYt0iSR7iD20qWQ8kLOa9LqAhGzoGerFAXgkzDj2ZTHN3LqtzrCukSaJoYUZGfGUPughbNrUO6+iHnQz7uInYboIOWxG3rVy93w4V16vnU6kD2HtI8lN7WnL1g6+xDTROwo42HKi+wqbybMVOls5EcdyM5mPNQ+oLGtVEvdlA+YSjpJ1juQPZnjtFckN/RqdnnilbnIYcYD9nGP015KYuxqdnmzDHJijx81ATxV6nHaxxmc/ZR4adM7Psw2O4A9c8lrb+FbKfU6nWfZbOhkuQm1Mzle+yCTxLx/Ukt72Gk28m/pbhPCg2JH2ivJpPg+sVrarUemk05ejJqQvVXDtYve1dFO2F3mQ882oPZmpifRLnhXqcnvxcyHnih2ITvT64naGYxdlXHWqmx8TzhRJFTuc90ugKdytR7f5CsMxn6ixkgnL9+dEdfybnTbtrcS9oEIr+zZtqO7y66IOjk0HEH2zqAm0c4Ir14cG9HfV12bW7ZwKOi2so3Cgv7hM8htD4UPlpaV86dGiH1ck2hnhIL/oMK1/PaTsL1LNt/sT7IJwuoJ7UWXld1sp6uIvVXDtCcZLOeVn2+OhV8Zirl2bYt/ie0JHGwqeCgqVKtVwE7XMO0lRmTPfNKr1GOuoxU7yPAnHKjuwM6yU7Z1wD4aZWqY9nESY1fe6BYq9bWlFTvxJGwu+T1hmV+CstZHAD15VuvVhLOdRlf0iF1xo9uZX9/rNr/cO2C28ENbcj4hSVVRMDWJdriY4XrdB4UX09bdecKPfG5FwyJB+A+fDj9sNID3KlWD2vlqz1Ci968KJ7qgd+b/gWs7ZLUonZcJIhR9Ytonyg3AXq12WHRMe4uiKKHeFWZ8YNYZ5D2wq3X559t8UsPL1huIvdk7w6udzXgEzw43SjN+f4ZxFpxQ7T7EbXvK1HhevEHsEB3TnqEobhObTCrM+Ec3bWvbahnn0z70hJeO4zc3iL17eYazw4wX4BVlvOORFwRXl0IWtV9GJ4LRhefb1A3HPoGeGzMdiq93RknGP/KsHvOuaPLiivtwwYLPXheLCH6UO5Nqz0B0BK8o430PdbnVLbtFm3BsLeb9ol6E7I2bau5Wqr3U4bZSAP6dyl3Ou6Ld+zqe3cXyvc6xc+hYkx9TPDsbSub46d1DbNev5ftpC713nS/XeXYeXcx4pil6l//kSlinmu7qtkfTV/OInUX6+3WdZ+fQITvSTnObGcCuoNinZrm1Pa0/pV1g05MdXvPsxUauP6F93GmK3uUfb6GJ+dIVtmgdxPyr73j5WmBvXAL0GlbtA6opsv+i1hOrN2DRPvbnVvqwLLID9AntDNpOQHj5J7tN8t9cDulA/vB5ij+5pMtlyA7hq71+n6927mKaRlf0EP2r7PuKQ4lzXcinimzqTB8Oywgeotf6k9pbzS6nnYX/rMYVvE7k89DzhSFiR96rZ31RO2IfN7uC947cPufGVqwun0Un9JkJn4inUqlhasixX49urya1DzrdrlDucvtcUDxoImGdyB2HM2fZdgqEKL7Zv+rf8tq56xpm1BW8y+1zfuHiyGmz6PPV8JyfPDlPF1JIO2Ivd/pXU9qTaDvRBK8f/CmvzxHiFU1Up0+G7RsznefjacTOey9TV1eYdsROj3h2VrvMeU441teDOtX57O8HAXla6j15dzWlvTKqCt47Mlv8Hj++BvQhD88eYrPxOGRPY97pO0F7jZvke+NuFa2lAPsfiiaamE0XcOv+7GMt245z7IWCwF4B6BPaB82qyP6bovXDrluXBjfniibbhugYO8j5MYeOV3uuCW7oOXaZp9u2juk+7zedshftKXaIDtlvJdo7DbSWAuwy0dF17LYOxxoRmvOCWvb8ArC3J72XELpY7eABjoLbCcSuBN1r14F8ToNjyVl0gV1s9KlR/2662hm4nUDeP8oSR2zp1OPcB3MeWbL580fYhxlcOzfSMdxWCqzgP8ob58CD27L2R7p9aXaDS2Tz+UfZ67npamduGoL3P61y21xsX/vT3DvnAT2RBewIvi0peMDevZ2qdobbSgF6megHbKVrLd2zEyFjc9AF9oe8D+mpaqf4jRzrXSY6O83taD267s5dOiQge/ZB72CwK9Ymqr3WKaKtVEO+dZ9zTdv7CfdCv0CbSEzlvOSAT05o7zWL/DayWpXZ5vxrG1rePRP+BX90eJb3QqEwqf2yy2/kWHh5h5vFsbmn5aXE3sIb9Qn2ycFuotpz1XqR9974KPP/bsWvofKlp7xHMc0uek+zcw2ufXDDb+RYdLk3VFarsVU+kz0uiC/nJNorwlqKRX9vMVnI+GnxR7xDdloy0mWu60WB/TdzgXtsct62fjzn4807XHvnun6NNnIs+2czgROBTXkvRj/qPX7TF7Xf1qplcR35u4l+X9sS3Jb9A9vCAT/BHi/X7kXtgzq2jvzdYxpwa1jJl2OJ6aEWwqcG94L2Pl3G1pF/m+aPRvmjyl6DB+i8eLzeK/ditXeGAnux+F+TgLuV/+WEB4ZaAF+6FzK+d8NvZoB3k5xtgV0nGVOHPTsx0NP3gvaKuJVitZuiwQd31Pn7AQ8Nte3M/R2vncI2cvVfg8+9vc1jb7PWOe21Ir6NNL7LEf4jNX+/apq99YPTfteSbGIN73LyprensI9/cNr73TTGXv/DYOW+TdU/DZ1gj+dYdKD9LlcWVrEsusGlrvLfvXqQPVUD1gE6ExdXseWyoaXuVv3vXj3Afl6+ggl/f1erx4Ubeta7kad6YEOzz/6xwS7fuP8Btd9n8O1E6p/Pz/4on+M9n29+R+i3RclW6m/H8z/K5x3wGRYdsNPxNs7+/kUc5TO8Z/MXg+9Q+21dsp34x/8yjvJZ3tNnAP3Hj4x0M/Mf6ws5yh9nT9TvvwP2s7L0pva9QUe5Tj9wAdjJ5neITp1LLisNmGccK7r+hA/LXvrf/7k7t962lSMAixTF5V13iZJJ3XNeEjhB7CBAkEQr10baU19qF65b10cuUDeG08T9/2/lXkiRFEktJYo+ziZ5sEAx/jizM7Mzs0vE/vejQPZiln/8noN5C7Hf/g2hf3s4DmToczdy8iD3U2zubtBUf/ztPJitfJvz+3AavfwPbbr7FyL/ev8lkKn9XMvXow2Naf7j4L+Ovv/4Z6jtJF/PVus8yblFp/9+/P7415Nghj5Xoav2U4jc0feHH98f/3g/DSzgz/MU+hOJ3BmOa/v2cOcGtSRD/7nxk89yPI6+Pn7/w4F/IecIPj/zztAMtEV9f/zPrX8x47CX8/LpwuAJT6Q7+O1/Xy/ugovYk0Fe4VvpCQ9gvDv8x7fLu9ACvpNPeZVb1ey47Xjmx5/CK/hWJR/7Zj3twcInf/71S3gRa4F87NvBwZMKff6X2/BCLpc9SpwmOeRPCX9weXQX+igXdVctHWcKnpD94GTpEzsHda+ajjU9IPDT383obd+6g0oZBRCE/eB3w55DMMMNPh8f+9C3wA5FMXWMmMOuY9U6R9GyJ/ds57sudUbDfrPZ7NumlAZfHG59ohfNk5Njjz1T+JYyGtTqqGKEKbhiv8ceOWx91zFotB1yH/tBRuyiZPKNJTMl1BgTnbCzdY9eKZ+jym6YfUNyXdlpFrkYw8IkeGXbJg5on8/PEXtI7ht5uFbbriV5pT6D3KXa9k37OR5BuX/ZANzo8Q05+cBCbrT6LtuO4gR7dnuLwBH7MYL/crwRudEbVFcbJ1BdlQVqadsmt2Yo04ulfu6K3cFfk7zV4R1ulgMqwQqxt/pbJpffzmaY/Tag81/Ws+dlqyYwn/6hicnkIC9yqvRI5U+OD9biHjdTuaJEjTe2rO0Ak898csfsayg7lEbNtKsMNSEZtPUD0eS3RwR8duvT+fTKrncGxfTqKcQfXqJs3au9PTqiQvfJPa3IYau03hnT8efUm1uPZD6eoi6NmV/w56mnudFtrFkRkuNOtLW2vkDf/4TAXXYi9+P04OsaYhAz1yVt68W1+u4plrpf7imnuV6qbeCBIi087G2/tsa9PTwNss/O0yk7bDc3WlFWxAi7YedQa9j/dHrqss+O1iA3hhv+lhpcXqPmkXuVdw8PF+xI8KnI4eaKCfrhe278MNnGK9Rx6pAfEvjZUTqZG8PNj3IKSR0dVZ5LdWn3kLJTwd+mIlcyUEwQOHJS7DRzanp+dX9/uIBPSQ7NTI4z8r0kV2xrcj7gBfnD/T2Fxzo/S0MujrOZkqBokkxNq6flt0V3/8Ylx+xHafy5PsxKM4FQsXptk2/k2N/Pfby4uPfJ/SQN+SDTYIsT8u3zru9eYPZDwn6bijznbs2M1y37iNyTe4qJDkX+WZMXCh/xqaVU7qcplizQ4p41OBCwvl/Q+Z5G3Sfy85Z54f3Vzc2Fq/NHKfyaUnzm5IVXNwQd45+niF4rz5288PHGZb+/OE1h4+xnT859wIeRE/gUQm+rzx5d3b3y0A/Zha5nkR/m5HqxWFefyE+A+vzKY09h3s24cFOuh4YqxGT9a0NTkZyh9OxQElctBgd+JWwh6hJ19YcJBv7sirLf3LMH7/HNa30pNMqdrracl5f7bV9dWW/736cFxkboFujpBIDoJUbA4IAd8j1WK7SP0An8EbuN68WuMfilDA6cQmknlEtf2j4k+rLtoBS1QlR4XyGLXgK7AXS67t1hRH+zQGfXdzG+BsbH1I4G/odVicg8L169EokeTIm4lwQoIz9McutnZ1eY/uaCWd9hwhGsfNzTshbs0e+48lri4tDhouqYFTqR+9Uhu5EbF1KjO4GAa6tk35vNoD/dIyejO2FUM0N0gNAJ/Ixd35ur0Zc6DaHnD91Sut6x+1rf8l7d7E4jDx3iEaUZmUmd6Dz7VJeKK9GlgdZHfwYLsqlCjLRAhV6mqUeh4lYa23IAodMngx8vXu3cBVmjO+Q37MvVnrASvY36SHAnyYKMnE8NikbYP6om1YtaDIKquXaRnvmbCfqbszmBZ7dyU6uwGt0XpKilgFRpicl/em+Rkg0DCH7PVVUC/3cm6PuIHP27YI9i++nQQZH+3i0s1b4fk15hTX2PIwIdFCot6lzUzNDfXxOhn92zW7lKOnSHls5VfAz/YBm9UJEMNEh4HCV172W6ZFJkgc7V9+bzlOitRlp090WJJW5RXQsYDLlYraK/IBbdezXRIDOp/7J3TdjZ3bpRTYvudsVhG0/fMSTGvg02Wuqq4vs0E3TuwzVin6dAT/Jt0eiukuNvetU1qdusA2Z096WPWFsyQS+8dNCv52fbRadWHU+VRdcM1MulQU0FTOjuC3oUOSt08AYdNT6fz++3iU4ljW0U6AcCtJaDHyw2xaBTG4HXD9lI/f0lPmd9zu7cjPTotFOG+AbZjOqlBavQaQVeyg5dfofJr69Y0eEaZq7oRwcRb3WDRrexAp2axwzRC6+J1M+Ot+fcglJHJ1gtLdjh1OCFvNH3rwk7czpWr62L7n4TgCKv6MtLeo5B4TOc64X6HmFnXrQmrVmTzdxCXwBQK2MltOVF15LQB77YIBt0AIjGXzObeNhPjU6VNWQl1BpvlvWl5H6yc+tk59cdjb/ERv6G2cQP1w1plhNbXL3G97xGSb2yOqQpgezQwS/vMPucuZ1iJzX6yCex5YCyOnSTdfzqQJakmicRl3CllemzJfaXl5idORnd41Kiu72/3bhvuYnKUTx6ja5aNf+znATQe6vTCeHxYg+zXzCXl9WU6E19YSTkoYVGqBdy6FuwR6PbgTTNOGr51149HyPFfnl9dpLB0i0K3c3G4e/RtyGHggMa5Pdi0YtS4MZuCrAecUmqzVHv9zA7o8bDpFxFFPpA9MmIbncIugngz1pFoQujoIklLgMG/Ky7Gk5X+H/5gNiZY1k+DTrQjIBTpOmW4OEydsRi3IcuW2JA3732ed9d3H5LI92GkRdE7KxRTQkwZGTpL9TYaQVNBI3K4Ng3TyuGT1eXnJRc8c5npslob6sM7LrswlBMciMJiVksdtbVW1ldmYe3bDy6HSMUq3npV9GsEdUQqu7hXkRgLrpCbmGPFjGvVA2XOmBHq6qyWmx6Tydtu4fwGoudrQwBE6L42MLTYt+9vdjf3LWH/qcz4iILT9AzMoMlm+Y8QqOslA3RWwKm7iZ/8Q7J/WLjeC4WfbHvvq7EoFGZxtbcAnOEh8FatlcPTN3GyO070/2BUexT9vq6942iL7kafZKZewZHDDoULX9yXzYza2kDaLo/MAby8VY0Gr0V2K0GKlLkvq4CSEIv94PPu9iLumidnZAchz3cbEP3FoEuSqPgNjAQ8b43vZfYWqCX7SVxqkuvYhDX3QkpOOwPZ2ylt1gPoinB0TGtiFaagtA0DehLT5m+HR/AVtqB0ZkMK/WI7eCgNpIWj1AM3CSl3BH7JduyvRWnWIIcHDEd7gAI1f7YbNOHU+US7iHEA4Ficzjqddqd3sTWqhtsIgAOO6ul62bRD84hSAFsfBdh4y0EjihePbCp/J30NEfyb28A8GaPMaazCz/deP/ukqkG9dOJHdVeX16ebtpb8YyVnoXdaBR+wvHi9SeG+R7ZIlzXNM2J1rmKphH/19CQt5WbGhnohyK+hFzkjErd9fWa/2lWeWvgC2Pkpm3xNc79VhP5Q8F/V64xsGxt8xO69ndX16H0qExQTYeQJ30UE+S15A5OMeOiG6Tr3fEU4vUPPZpDpOdwVPRpZxGl1yTYgm2PvY7jv5bN0RQcNMYqSXZBUvyVcWwHM9hgKwzKa1k61PdRAgiDoKOfd5zffDyZSNPyZGLL+LHgLI6DrnRHzuckp7PjJuJpznVUHS0CZnsqWbwJnQscdGVSaotTC6gWuqs0mYxVMJ6KPXvH+Wnj/eSA5W1lprwcW+rHX8r1wnDaIujjqSSSgjwwSYYcNEWjhRNoDvoQ59RIvrIsSoscOhhNd4DlrY6FDnoKaqc1ROi8s3CzacV3RP6fRguiLtxGeTrJYGsBqKx68wNcPtm0JkqKXiuYYg//Sg6Poz59PzpXmo4n0xGg6ABopCNMg8oALlKsTb1ltjwRcuZUaRa5erVO0HFmt0/RSTablHb45M4H5iFrbTE5XdNfkrpY7k55VZLGGL0Jy/Ux7X+h6FVDrzX/3961LTkKAtHgBTQi4g1j4iVq/kP//6u2m8ZJsjM7W7WVPGzVkDcj0cNp6KaBkw1fEKBDFzgpqyoG4Loy2uRjQiO7239tUKRwTA47dLCD7gH6zW26K9L0NQo+IpHttyp4qv7EejZuoebDhNCRYXgbm3TfoV/XJkgy3AS2KxApKahFoLvvbsMfOF+PZbkLEzKJxya2Jt+hs4FStgQdGm52a7pcv8rRxXr+TvUz0p9Yr1S2rL2H0HO19bqObNTroANbJ61btASAfqtreeG4XxYstdb95pYm2G1tZLSew/vvJ3oCGmZxZ315Zl28lHU3MxxP0R8N/zdtLIDut1xxbaF7Vi6W8tAOemFIQRamvW6YsyDQZVlh2d7l2YE8mXLuAqfSQ6GWYAHnGBB0MpwP6D26zaoOri/q6x+jPfPl+Wi+Jl+N7Jn1BPy28gE6gsqGYWhTXCVx0LtVwaVBQU910JMG3F+R8gYuZy5bn5u0su7OZQFzZQe1aT3GBF2MnAzEQYf63mFK4QfC1x4ew+3dcSW74Z71fQhtuvKJ9VjytWUIvTCpZgGL7WhP0IGsCSbYrCf+mq5bWlw/WtY2gVsLQ2tJ0Bwnjf+jZfrYuQXVj50i+2i7JTTrmT1AD+bVXHCLjnmTThlLcj3289BkkVLGpFCMUdFdr8KynuMbemsIDFOwMmIe00IXtevN4Iclc8NcugQQ5njOf1u/jJlLMLJmgKGOaKcYroWwjXLZZi5d6BNSlyA12o2f3zSlpO39LE5KP6+qAj5V7vsPx/hKTwbB6OWHytOsnmiQKq9wQdQTEFJMdKQtkFPBpIdlLAK8g7ro/r2optt8LRNvJ7EcL7cFFTyoFlai8Nc94xDoDmqM2fZuAU5oAuHaQnzdQYQQ73jq30p+/f9P2/6Un/JT/q38Aq70HcufWb0TAAAAAElFTkSuQmCC';
		}
		$tulisan					= number_format( $total , 0 , '.' , ',' );
		$y 							= $x.' rupiah';
		if (Session('nama') !== null){
			$tulis 					= 'Digenerate Tgl. '.$tanggalctk.' Oleh '.Session('nama').' Kwitansi Pembayaran ananda '.$nama.' Kelas '.$kelas.' Untuk '.$tlsbulan.' Sejumlah '.$tulisan;
			Pembayaran::where('marking', $marking)->update([
				'kirim' 		=> $tulis,
				'updated_at'	=> date("Y-m-d H:i:s")
			]);
		} else {
			$tulis 					= 'Digenerate Tgl. '.$tanggalctk.' Kwitansi Pembayaran ananda '.$nama.' Kelas '.$kelas.' Untuk '.$tlsbulan.' Sejumlah '.$tulisan;
		}
		$rsetting					= Sekolah::where('id', $id_sekolah)->first();
		$sekolah 					= $rsetting->nama_sekolah;
		$yayasan 					= $rsetting->nama_yayasan;
		$alamat 					= $rsetting->alamat;
		$kepalasekolah 				= $rsetting->kepala_sekolah->nama;
		$mutiara 					= $rsetting->slogan;
		$logo 						= $rsetting->logo;
		$logogrey 					= $rsetting->logo_grey;
		$tasks['logo']				= url('/').'/'.$rsetting->logo;
		$tasks['logo_grey']			= url('/').'/'.$rsetting->logo_grey;
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
		$tasks['qrcode']			= $qrcode;
		$tasks['logogrey']			= $logogrey;
		$domain						= str_replace('https://', '', $homebase);
		$domain						= str_replace('http://', '', $domain);
		$domain						= str_replace('/', '', $domain);
		return view('cetak.kwitansi', $tasks);
    }
	public function cekingPembayaran ($id){
		$homebase			= url("/");
		$cekdata 			= Pembayaranzis::where('id', $id)->count();
		if ($cekdata == 0){
			$data 						= [];
			$data['logo']				= $homebase.'/logo.png';
			$data['logo_grey']			= '';
			$data['yayasan']   			= '';
			$data['sekolah']   			= '';
			$data['alamat']   			= '';
			$data['rsetting']   		= [];
			$data['nama']   			= 'Not Found';
			$data['kelas']   			= 'Not Found';
			$data['namawali']   		= 'Not Found';
			$data['jeniszakat']   		= '';
			$data['orang']         		= '0';
			$data['satuan']         	= '';
			$data['nominal']           	= '0';
			$data['zakatmaal']         	= '0';
			$data['donasi']          	= '0';
			$data['total']          	= '0';
			$data['qrcode']            	= '';
			$data['status']           	= '<span class="label label-danger">Not Found</span>';
		} else {
			$getdata 			= Pembayaranzis::where('id', $id)->first();
			$namawali			= $getdata->namawali;
			$hape				= $getdata->hape; 
			$namasiswa			= $getdata->namasiswa; 
			$kelas				= $getdata->kelas; 
			$jeniszakat			= $getdata->jeniszakat; 
			$orang				= $getdata->orang; 
			$nominal			= $getdata->nominal; 
			$zakatmaal			= $getdata->zakatmaal; 
			$donasi				= $getdata->donasi; 
			$validator			= $getdata->validator;
			$tglvalidasi		= $getdata->tglvalidasi;
			$namafile			= $getdata->namafile;
			$id_sekolah			= $getdata->id_sekolah;
			if ($jeniszakat == 'Uang'){
				$total			= $nominal + $zakatmaal + $donasi;
				$satuan 		= 'Rp. 35.000,-';
				$nominal		= number_format( $nominal , 0 , '.' , ',' );
			} else {
				$total			= $zakatmaal + $donasi;
				$satuan			= '2.5 Kg';
				$nominal		= 0;
			}
			$zakatmaal			= number_format( $zakatmaal , 0 , '.' , ',' );
			$donasi				= number_format( $donasi , 0 , '.' , ',' );
			$total				= number_format( $total , 0 , '.' , ',' );
			$alamatweb			= $homebase.'/ceking/'.$id;
			$alamatcetak		= $homebase.'/verifikasi/'.$id;
			if ($tglvalidasi == '0000-00-00'){
				$qrcode 		= '';
				$status 		= '<span class="badge badge-danger">Belum di Validasi</span>';
			} else {
				try {
					$qrcode 	= QrCode::size(150)->generate($alamatweb);
				} catch (\Exception $e) {
					$qrcode 	= '';
				}
				$status 		= '<a href="'.$alamatcetak.'" target="_blank"><span class="badge badge-primary">Telah di validasi, Klik untuk Cetak Tanda Terima</span></a>';
			}
			$data 						= [];
			$rsetting					= Sekolah::where('id', $id_sekolah)->first();
			$sekolah 					= $rsetting->nama_sekolah;
			$yayasan 					= $rsetting->nama_yayasan;
			$alamat 					= $rsetting->alamat;
			$kepalasekolah 				= $rsetting->kepala_sekolah->nama;
			$mutiara 					= $rsetting->slogan;
			$logo 						= $rsetting->logo;
			$kopsurat 					= $rsetting->kopsurat;
			if ($kopsurat == '' OR $kopsurat == null){
				$kopsurat 			= '<tr>
											<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="'.$logo.'" width="98" height="75" /></td>
											<td colspan="8">'.$yayasan.'</td>
										</tr>
										<tr>
											<td colspan="8">'.$sekolah.'</td>
										</tr>
										<tr>
											<td colspan="8">'.$alamat.'</td>
										</tr>';
			} else {
				$kopsurat			= '<tr><td colspan="11"><img src="'.$homebase.'/'.$kopsurat.'" width="100%" /></td></tr>';
			}
			$data['logo']				= $homebase.'/'.$logo;
			$data['logo_grey']			= $homebase.'/'.$rsetting->logo_grey;
			$data['kopsurat']   		= $kopsurat;
			$data['yayasan']   			= $yayasan;
			$data['sekolah']   			= $sekolah;
			$data['alamat']   			= $alamat;
			$data['nama']   			= $namasiswa;
			$data['kelas']   			= $kelas;
			$data['rsetting']   		= $rsetting;
			$data['namawali']   		= $namawali;
			$data['jeniszakat']   		= $jeniszakat;
			$data['orang']         		= $orang;
			$data['satuan']         	= $satuan;
			$data['nominal']           	= $nominal;
			$data['zakatmaal']         	= $zakatmaal;
			$data['donasi']          	= $donasi;
			$data['total']          	= $total;
			$data['qrcode']            	= $qrcode;
			$data['status']           	= $status;
		}
		return view('cetak.viewstatus', $data);
	}
	public function verifikasiPembayaran ($id){
		$homebase			= url("/");
		$cekdata 			= Pembayaranzis::where('id', $id)->count();
		if ($cekdata == 0){
			$data 						= [];
			$data['nama']   			= 'Not Found';
			$data['kelas']   			= 'Not Found';
			$data['namawali']   		= 'Not Found';
			$data['jeniszakat']   		= '';
			$data['orang']         		= '0';
			$data['satuan']         	= '';
			$data['nominal']           	= '0';
			$data['zakatmaal']         	= '0';
			$data['donasi']          	= '0';
			$data['total']          	= '0';
			$data['qrcode']            	= '';
			$data['terbilang']          = '';
			$data['validator']          = '';
			$data['tglvalidasi']        = '';
		} else {
			$getdata 			= Pembayaranzis::where('id', $id)->first();
			$namawali			= $getdata->namawali;
			$hape				= $getdata->hape; 
			$namasiswa			= $getdata->namasiswa; 
			$kelas				= $getdata->kelas; 
			$jeniszakat			= $getdata->jeniszakat; 
			$orang				= $getdata->orang; 
			$nominal			= $getdata->nominal; 
			$zakatmaal			= $getdata->zakatmaal; 
			$donasi				= $getdata->donasi; 
			$validator			= $getdata->validator;
			$tglvalidasi		= $getdata->tglvalidasi;
			$namafile			= $getdata->namafile;
			$id_sekolah			= $getdata->id_sekolah;
			$bulan 				= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

			if ($jeniszakat == 'Uang'){
				$total			= $nominal + $zakatmaal + $donasi;
				$satuan 		= 'Rp. 35.000,-';
				$nominal		= number_format( $nominal , 0 , '.' , ',' );
			} else {
				$total			= $zakatmaal + $donasi;
				$satuan			= '2.5 Kg';
				$nominal		= 0;
			}
			$terbilang 			= SendMail::terbilang($total);
			$zakatmaal			= number_format( $zakatmaal , 0 , '.' , ',' );
			$donasi				= number_format( $donasi , 0 , '.' , ',' );
			$total				= number_format( $total , 0 , '.' , ',' );
			$alamatweb			= $homebase.'/ceking/'.$id;
			$alamatcetak		= $homebase.'/verifikasi/'.$id;
			if ($tglvalidasi == '0000-00-00'){
				$qrcode 		= '';
				$tglvalidasi	= '<p style="background-color:red;">Belum di Validasi</p>';
				$status 		= '<p style="background-color:red;">Belum di Validasi</p>';
			} else {
				$arrtanggal		= explode('-', $tglvalidasi);
				$yy 			= $arrtanggal[0];
				$mm 			= (int)$arrtanggal[1];
				$dd 			= $arrtanggal[2];
				$mm 			= $bulan[$mm];
				$tglvalidasi	= $dd.' '.$mm.' '.$yy;
				try {
					$qrcode 	= QrCode::size(150)->generate($alamatcetak);
				} catch (\Exception $e) {
					$qrcode 	= '';
				}
				$status 		= '<a href="'.$alamatcetak.'" target="_blank"><span class="label label-primary">Telah di validasi, Klik untuk Cetak Tanda Terima</span></a>';
			}
			$rsetting					= Sekolah::where('id', $id_sekolah)->first();
			$terbilang					= ucwords($terbilang);
			$data 						= [];
			$data['logo']				= $homebase.'/'.$rsetting->logo;
			$data['logo_grey']			= $homebase.'/'.$rsetting->logo_grey;
			$data['rsetting']			= $rsetting;
			$data['nama']   			= $namasiswa;
			$data['kelas']   			= $kelas;
			$data['namawali']   		= $namawali;
			$data['jeniszakat']   		= $jeniszakat;
			$data['orang']         		= $orang;
			$data['satuan']         	= $satuan;
			$data['nominal']           	= $nominal;
			$data['zakatmaal']         	= $zakatmaal;
			$data['donasi']          	= $donasi;
			$data['total']          	= $total;
			$data['qrcode']            	= $qrcode;
			$data['terbilang']          = $terbilang.' Rupiah';
			$data['validator']          = $validator;
			$data['tglvalidasi']        = $tglvalidasi;
		}
		return view('cekingpembayaran', $data);
	}
	public function exKwitansiByID($id) {
		$file =  public_path('kwitansi/'.$id.'.pdf');
		if (file_exists(public_path('kwitansi/'.$id.'.pdf'))){
			return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
		} else {
			$homebase	= url("/");
			$domain		= str_replace('http://', '', $homebase);
			$domain		= str_replace('https://', '', $domain);
			$domain		= str_replace('/', '', $domain);
			$info = array(
				'Name' 			=> config('global.Title2'),
				'Location' 		=> config('global.alamat'),
				'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik, verifikasi keaslian dokumen ini merujuk ke '.$homebase,
				'ContactInfo' 	=> $domain,
			);
			$domain		= str_replace('#', '', $domain);
			$domain		= str_replace('-', '', $domain);
			$domain		= str_replace('.', '', $domain);
			$fileserti 	= $domain.'.crt';
			if (Storage::disk('local')->exists('/tte/' . $fileserti)) {
				$certificate 	= 'file://'.base_path().'/public/tte/'.$fileserti;
			} else {
				$dn = array(
					"countryName" 			=> "IN",
					"stateOrProvinceName" 	=> config('global.kota'),
					"localityName" 			=> config('global.Title2'),
					"organizationName" 		=> config('global.yayasan'),
					"organizationalUnitName"=> config('global.singkatan'),
					"commonName" 			=> config('global.sekolah'),
					"emailAddress" 			=> config('global.email')
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
				Storage::disk('local')->append('/tte/' . $domain.'.crt', $certout);
				$certificate 	= 'file://'.base_path().'/public/tte/'.$domain.'.crt';
			}
			$getdata 	= HPTKeuangan::where('id', $id)->first();
			if (isset($getdata->id)){
				try {
					$draft =  public_path('kwitansi/draft/'.$id.'.pdf');
					unlink($draft);
				} catch (\Exception $e) {
				}
				$idne 		= $getdata->id;
				$deskripsi 	= $getdata->deskripsi;
				$pemasukan 	= $getdata->pemasukan;
				$pengeluaran= $getdata->pengeluaran;
				$bendahara 	= $getdata->bendahara;
				$tglkwitansi= $getdata->tglkwitansi;
				$id_sekolah	= $getdata->id_sekolah;
				$jenis		= $getdata->jenis;
				$email 		= $id.'@'.$domain;
				$markindttd = $id_sekolah.'-'.$getdata->id.'-kwitansi';
				$cekttd 	= XFiles::where('xmarking', $markindttd)->first();
				if (isset($cekttd->xfile)){
					$tandatangan = $cekttd->xfile;
				} else {
					$tandatangan = '';
				}
				if ($bendahara == '' OR is_null($bendahara)){
					$bendahara	= 'Bendahara';
				}
				if ($jenis == 'pendaftaran') { $tulisanne = 'BUKU PENDAFTARAN'; }
				else if ($jenis == 'spp') { $tulisanne = 'BUKU KEUANGAN PEMBAYARAN SPP'; }
				else if ($jenis == 'makan') { $tulisanne = 'BUKU UANG MAKAN'; }
				else if ($jenis == 'ekstrakurikuler') { $tulisanne = 'BUKU KEUANGAN EKSTRAKULIKULER'; }
				else if ($jenis == 'kegiatan') { $tulisanne = 'BUKU KEUANGAN KEGIATAN'; }
				else if ($jenis == 'peralatan') { $tulisanne = 'BUKU UANG PERALATAN '; }
				else if ($jenis == 'bos') { $tulisanne = 'BUKU BANTUAN OPERASIONAL SEKOLAH'; }
				else if ($jenis == 'pembangunan') { $tulisanne = 'BUKU INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN '; }
				else if ($jenis == 'seragam') { $tulisanne = 'BUKU UANG SERAGAM '; }
				else if ($jenis == 'buku') { $tulisanne = 'BUKU PENGADAAN BUKU '; }
				else if ($jenis == 'jariyah') { $tulisanne = 'BUKU JARIYAH '; }
				else if ($jenis == 'lainlain') { $tulisanne = 'BUKU KEUANGAN LAIN-LAIN '; }
				else {
					$tulisanne	= 'BUKU '.strtoupper($jenis);
				}
				if ($tandatangan == '' OR is_null($tandatangan)){
					$tandatangan 	= '<img src="'.$homebase.'/boxed-bg.jpg" width="100">';
					$imageName 		= "post-".time().".png";
				} else {
					$imageInfo 		= explode(";base64,", $tandatangan);
					$imgExt 		= str_replace('data:image/', '', $imageInfo[0]);
					$image 			= str_replace(' ', '+', $imageInfo[1]);
					$imageName 		= "post-".time().".".$imgExt;
					Storage::disk('local')->put('/scan/generate/'.$imageName, base64_decode($image));
					$tandatangan 	= '<img src="'.$homebase.'/scan/generate/'.$imageName.'" width="100">';
				}
				if ($tglkwitansi == '' OR is_null($tglkwitansi) OR $tglkwitansi == '0000-00-00'){
					$tanggal 	= $getdata->tanggal;
					$bulan 		= (int)$getdata->bulan;
					$tahun 		= $getdata->tahun;	
				} else {
					$getarrtgl 	= explode('-', $tglkwitansi);
					$tanggal 	= $getarrtgl[2];
					$bulan 		= (int)$getarrtgl[1];
					$tahun 		= $getarrtgl[0];
				}
				if ($pengeluaran == '' OR $pengeluaran == 0) {$total = $pemasukan; $format = 'pemasukan'; }
				else { $total = $pengeluaran; $format = 'pengeluaran'; }
				$rsetting		= Sekolah::where('id', $id_sekolah)->first();
				if (isset($rsetting->id)){
					$sekolah 		= $rsetting->nama_sekolah;
					$yayasan 		= $rsetting->nama_yayasan;
					$alamat 		= $rsetting->alamat;
					$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
					$mutiara 		= $rsetting->slogan;
					$logo 			= $rsetting->logo;
					$logogrey 		= $rsetting->logo_grey;	
				} else {
					$sekolah 		= config('global.sekolah');
					$yayasan 		= config('global.yayasan');
					$alamat 		= config('global.alamat');
					$kepalasekolah 	= config('global.Title2');
					$mutiara 		= 'Mulia Bersama Alquran';
					$logo 			= config('global.logoapss');
					$logogrey 		= $homebase.'/'.config('global.logoapss');
				}
				$x 				= SendMail::terbilang($total);
				$tulisan		= number_format( $total , 0 , '.' , ',' );
				$y 				= $x.' rupiah';
				$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
				$blniki 		= $bulanlist[$bulan];
				if ($format == 'pemasukan'){
					$generatetable	= '
						<table width="760" border="0" cellpadding="0" cellspacing="0" class="isi">
							<tr>
								<td width="50">&nbsp;</td>
								<td width="30">&nbsp;</td>
								<td width="120">&nbsp;</td>
								<td width="13">&nbsp;</td>
								<td width="26">&nbsp;</td>
								<td width="125">&nbsp;</td>
								<td width="39">&nbsp;</td>
								<td width="129">&nbsp;</td>
							</tr>
							<tr>
								<td width="400" colspan="5">&nbsp;</td>
								<td width="350" colspan="3" rowspan="5" align="center">&nbsp;<br /><img src="'.$homebase.'/'.$logo.'" width="150"/></td>
							</tr>
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr><td colspan="5" width="400">'.$yayasan.'</td></tr>
							<tr><td colspan="5" width="400">'.$sekolah.'</td></tr>
							<tr><td colspan="5" width="400">'.$alamat.'</td></tr>
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
							<tr>
								<td width="50">&nbsp;</td>
								<td colspan="4" width="200"><strong>KEPADA</strong></td>
								<td colspan="3" width="360" align="right"><strong>TANGGAL</strong></td>
							</tr>
							<tr>
								<td width="50">&nbsp;</td>
								<td colspan="4" width="200">'.$deskripsi.'</td>
								<td colspan="3" width="360" align="right">'.$tanggal.' '.$blniki.' '.$tahun.'</td>
							</tr>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
							<tr><td colspan="8">&nbsp;</td></tr>
							<tr>
								<td width="50">&nbsp;</td>
								<td colspan="4" width="400" style="border-bottom:double;"><strong>KETERANGAN</strong></td>
								<td colspan="3" width="200" align="center" style="border-bottom:double;"><strong>TOTAL</strong></td>
							</tr>
							<tr><td colspan="8">&nbsp;</td></tr>
							<tr>
								<td width="50">&nbsp;</td>
								<td colspan="4" width="400">'.$tulisanne.'</td>
								<td align="center" width="50">Rp</td>
								<td colspan="3" width="150" align="right">'.$tulisan.'</td>
							</tr>
							<tr><td>&nbsp;</td><td width="600" colspan="7" style="border-bottom:double;">&nbsp;</td></tr>
							<tr><td colspan="8">&nbsp;</td></tr>
							<tr><td colspan="8" align="right"><strong>TERBILANG :</strong>'.$y.'</td></tr>
							<tr><td colspan="8">&nbsp;</td></tr>
							<tr><td colspan="8">&nbsp;</td></tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								<td colspan="3" width="200">&nbsp;</td>
								<td colspan="3" width="460">VERIFIKATOR<br />'.$tandatangan.'<br />'.$bendahara.'</td>
							</tr>
							<tr><td colspan="8">&nbsp;</td></tr>
						</table>';
				} else {
					$generatetable	= '
						<table width="760" border="0" cellpadding="0" cellspacing="0" class="isi">
							<tr>
								<td width="50">&nbsp;</td>
								<td width="30">&nbsp;</td>
								<td width="120">&nbsp;</td>
								<td width="13">&nbsp;</td>
								<td width="26">&nbsp;</td>
								<td width="125">&nbsp;</td>
								<td width="39">&nbsp;</td>
								<td width="129">&nbsp;</td>
							</tr>
							<tr>
								<td width="400" colspan="5">&nbsp;</td>
								<td width="350" colspan="3" rowspan="5" align="center">&nbsp;<br /><img src="'.$homebase.'/'.$logo.'" width="150"/></td>
							</tr>
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr><td colspan="5" width="400">'.$yayasan.'</td></tr>
							<tr><td colspan="5" width="400">'.$sekolah.'</td></tr>
							<tr><td colspan="5" width="400">'.$alamat.'</td></tr>
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr><td colspan="8">&nbsp;</td></tr>
							<tr>
								<td colspan="8">
									<table width="750" border="0" cellpadding="0" cellspacing="0" class="table table-striped">
										<tr>
											<td colspan="3" width="150" ><span class="isi">Sudah terima dari </span></td>
											<td colspan="8" width="600" style="border-bottom:dotted"><span class="isi">: Bendahara '.$sekolah.'</span></td>
										</tr>
										<tr>
											<td colspan="3">Uang Sebesar</td>
											<td colspan="8" style="border-bottom:dotted">: '.$tulisanne.'</td>
										</tr>
										<tr>
											<td colspan="3">Untuk</td>
											<td colspan="8" style="border-bottom:dotted">: '.$deskripsi.' dari Buku '.strtoupper($jenis).'</td>
										</tr>
										<tr>
											<td width="30">&nbsp;</td>
											<td width="30">&nbsp;</td>
											<td width="30">&nbsp;</td>
											<td width="101">&nbsp;</td>
											<td width="25">&nbsp;</td>
											<td width="118">&nbsp;</td>
											<td width="13">&nbsp;</td>
											<td width="26">&nbsp;</td>
											<td width="150" colspan="3" align="center"><span class="isi">'.$tanggal.' '.$blniki.' '.$tahun.'</span></td>
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
											<td colspan="3" rowspan="3" align="center">'.$tandatangan.'</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td colspan="3" rowspan="2" style="border-bottom:thin; border-top:thin; border-left:thin; border-right:thin;" valign="middle" align="center"><span class="isi"><b>Rp. <u>'.$tulisan.'</u></b></span></td>
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
										</tr>
										<tr>
											<td colspan="6">&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td colspan="3" style="border-bottom:dotted" align="center"><span class="isi">'.$bendahara.'</span></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>';
			
				}
				try {
					$page_format 		= array(
						'MediaBox' 	=> array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 200),
						'Dur' 		=> 3,
						'PZ' 		=> 1,
					);
					PDFCREATOR::setSignature($certificate, $certificate, $fileserti, '', 2, $info, 'A');
					PDFCREATOR::SetProtection(array('modify', 'copy'), '', null, 0, null);
					PDFCREATOR::SetCreator($sekolah);
					PDFCREATOR::SetAuthor($bendahara);
					PDFCREATOR::SetTitle('KWITANSI '.$deskripsi);
					PDFCREATOR::SetSubject($format);
					PDFCREATOR::SetKeywords($tulisanne);
					PDFCREATOR::setPrintHeader(false);
					PDFCREATOR::setPrintFooter(false);
					PDFCREATOR::SetMargins(5, 0, 5);
					PDFCREATOR::setFontSubsetting(true);
					PDFCREATOR::setImageScale(PDF_IMAGE_SCALE_RATIO);
					PDFCREATOR::AddPage('P', $page_format, false, false);
					$bMargin = PDFCREATOR::getBreakMargin();
					$auto_page_break = PDFCREATOR::getAutoPageBreak();
					PDFCREATOR::SetAutoPageBreak(false, 0);
					$img_file = 'bgkwitansi.png';
					PDFCREATOR::Image($img_file, 0, 0, 215, 200);
					PDFCREATOR::SetAutoPageBreak(true, 0);
					PDFCREATOR::setPageMark();
					PDFCREATOR::writeHTML($generatetable, true, 0, true, 0);
					PDFCREATOR::setCellHeightRatio(2);
					PDFCREATOR::setFooterMargin(0);
					$pdfdoc = PDFCREATOR::Output('', 'S');
					PDFCREATOR::reset();
					if ($tandatangan == '' OR is_null($tandatangan)){
						Storage::disk('local')->put('/kwitansi/draft/'.$idne.'.pdf', $pdfdoc);
						$file =  public_path('kwitansi/draft/'.$idne.'.pdf');
					} else {
						Storage::disk('local')->put('/kwitansi/'.$idne.'.pdf', $pdfdoc);
						$file =  public_path('kwitansi/'.$idne.'.pdf');
					}
					$qrcode =  public_path('scan/generate/'.$imageName);
					try {
						unlink($qrcode);
					} catch (\Exception $e) {
					}
					if (Storage::disk('local')->exists('/kwitansi/' . $idne.'.pdf')) {
						return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
					} else if (Storage::disk('local')->exists('/kwitansi/draft/' . $idne.'.pdf')) {
						return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
					} else {
						$generatetable 			= $generatetable;
						$data['generatetbl']   	= $generatetable;
						return view('cetak.biodatarapot', $data);
					}
				} catch (\Exception $e) {
					$generatetable 			= $generatetable.''.$e->getMessage();
					$data['generatetbl']   	= $generatetable;
					$data['catatankaki']   	= $e->getMessage();
					return view('cetak.biodatarapot', $data);
				}
			}
		}
	}
	public function TtdKwitansi($id){
		$homebase	= url("/");
		$kalender   = array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$dd         = date("d");
		$mm         = (int)date("m");
		$mm			= $kalender[$mm];
		$tahuniki   = date("Y");
		$tglsurat	= date("Y-m-d");
		$sakniki	= $dd.' '.$mm.' '.$tahuniki;
		$getarrsurat= explode("-",$id);
		if (isset($getarrsurat[1])){
			$id		= $getarrsurat[1];
		}
		$getdata 		= HPTKeuangan::where('id', $id)->first();
		if (isset($getdata->id)){
			$deskripsi 	= $getdata->deskripsi;
			$pemasukan 	= $getdata->pemasukan;
			$pengeluaran= $getdata->pengeluaran;
			$bendahara 	= $getdata->bendahara;
			$tglkwitansi= $getdata->tglkwitansi;
			$tandatangan= $getdata->getTandatangan->xfile ?? '';;
			$jenis		= $getdata->jenis;
			$tanggal 	= $dd;
			$bulan 		= $mm;
			$tahun 		= $tahuniki;
			$blniki 	= $bulan;

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
			if (is_null($tandatangan) OR $tandatangan == ''){
				$data           		=   [];
				if ($pengeluaran == '' OR $pengeluaran == 0) {$total = $pemasukan; $format = 'pemasukan'; }
				else { $total = $pengeluaran; $format = 'pengeluaran'; }
				$rsetting		= Sekolah::where('id', $getdata->id_sekolah)->first();
				$sekolah 		= $rsetting->nama_sekolah;
				$yayasan 		= $rsetting->nama_yayasan;
				$alamat 		= $rsetting->alamat;
				$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
				$mutiara 		= $rsetting->slogan;
				$logo 			= $rsetting->logo;
				$logogrey 		= $rsetting->logo_grey;
				$x 				= SendMail::terbilang($total);
				$tulisan		= number_format( $total , 0 , '.' , ',' );
				$y 				= $x.' rupiah';
				if ($format == 'pemasukan'){
					$rom 		= '<table width="760" border="0" cellpadding="0" cellspacing="0" class="table table-striped">
									<tr>
										<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="'.$homebase.'/'.$logo.'" width="98"/></td>
										<td colspan="8">'.$yayasan.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$sekolah.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$alamat.'</td>
									</tr>
									<tr>
										<td width="101" style="border-bottom:double">&nbsp;</td>
										<td width="25" style="border-bottom:double">&nbsp;</td>
										<td width="118" style="border-bottom:double">&nbsp;</td>
										<td width="13" style="border-bottom:double">&nbsp;</td>
										<td width="26" style="border-bottom:double">&nbsp;</td>
										<td width="125" style="border-bottom:double">&nbsp;</td>
										<td width="39" style="border-bottom:double">&nbsp;</td>
										<td width="129" style="border-bottom:double">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3"><span class="isi">Deskripsi</span></td>
										<td colspan="8" style="border-bottom:dotted"><span class="isi">: '.$deskripsi.'</span></td>
									</tr>
									<tr>
										<td colspan="3">Uang Sebesar</td>
										<td colspan="8" style="border-bottom:dotted">: '.$y.'</td>
									</tr>
									<tr>
										<td colspan="3">Masuk Dalam Buku</td>
										<td colspan="8" style="border-bottom:dotted">: '.$tulisanne.'</td>
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
										<td colspan="3" align="center"><span class="isi">'.$sakniki.'</span></td>
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
										<td colspan="3" rowspan="3" align="center">'.$tandatangan.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td colspan="3" rowspan="2" style="border-bottom:thin; border-top:thin; border-left:thin; border-right:thin;" valign="middle" align="center"><span class="isi"><b>Rp. <u>'.$tulisan.'</u></b></span></td>
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
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" style="border-bottom:dotted" align="center"><span class="isi">'.$bendahara.'</span></td>
									</tr>
								</table>';
			
				} else {
					$rom 		= '<table width="760" border="0" cellpadding="0" cellspacing="0" class="table table-striped">
									<tr>
										<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="'.$homebase.'/'.$logo.'" width="98"/></td>
										<td colspan="8">'.$yayasan.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$sekolah.'</td>
									</tr>
									<tr>
										<td colspan="8">'.$alamat.'</td>
									</tr>
									<tr>
										<td width="101" style="border-bottom:double">&nbsp;</td>
										<td width="25" style="border-bottom:double">&nbsp;</td>
										<td width="118" style="border-bottom:double">&nbsp;</td>
										<td width="13" style="border-bottom:double">&nbsp;</td>
										<td width="26" style="border-bottom:double">&nbsp;</td>
										<td width="125" style="border-bottom:double">&nbsp;</td>
										<td width="39" style="border-bottom:double">&nbsp;</td>
										<td width="129" style="border-bottom:double">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3"><span class="isi">Sudah terima dari </span></td>
										<td colspan="8" style="border-bottom:dotted"><span class="isi">: Bendahara '.$sekolah.'</span></td>
									</tr>
									<tr>
										<td colspan="3">Uang Sebesar</td>
										<td colspan="8" style="border-bottom:dotted">: '.$y.'</td>
									</tr>
									<tr>
										<td colspan="3">Untuk</td>
										<td colspan="8" style="border-bottom:dotted">: '.$deskripsi.' dari Buku '.strtoupper($jenis).'</td>
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
										<td colspan="3" align="center"><span class="isi">'.$sakniki.'</span></td>
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
										<td colspan="3" rowspan="3" align="center">'.$tandatangan.'</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td colspan="3" rowspan="2" style="border-bottom:thin; border-top:thin; border-left:thin; border-right:thin;" valign="middle" align="center"><span class="isi"><b>Rp. <u>'.$tulisan.'</u></b></span></td>
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
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td colspan="3" style="border-bottom:dotted" align="center"><span class="isi">'.$bendahara.'</span></td>
									</tr>
								</table>';
			
				}
				$tandatangan 			= 	'<img src="'.$homebase.'/boxed-bg.jpg" width="100">';
				$data['jenissurat'] 	= 	'Kwitansi';
				$data['tandatangan'] 	= 	$tandatangan;
				$data['idsurat'] 	    = 	$id;
				$data['sakniki']       	=   $sakniki;
				$data['bendahara']     	=   $bendahara;
				$data['alamatweb']    	=   '';
				$data['surat']     		=   $rom;
				return view('simaster.formttd', $data);
			} else {
				$data					= [];
				$data['sidebar'] 		= 'ttdkwitansi';
				$data['kalimatheader'] 	= 'Mohon Maaf Kwitansi Ini Sudah di Tandatangani';
				$data['kalimatbody'] 	= 'Kwitansi Yang Telah di Tandatangani Tidak Bisa di Ubah / di Tandatangani Ulang <p></p><a href="/" class="btn btn-primary">Kembali Ke Home</a>';
				return view('errors.notready', $data);
			}
		} else {
			$data					= [];
			$data['sidebar'] 		= 'ttdkwitansi';
			$data['kalimatheader'] 	= 'Data Tidak Di Temukan';
			$data['kalimatbody'] 	= 'Yth. Bapak/Ibu Bendahara<br />Kwitansi dengan ID '.$id.' Tidak ditemukan, periksa kembali URL yang diterima<p></p><a href="/" class="btn btn-primary">Kembali Ke Home</a>';
			return view('errors.notready', $data);
		}
	}
	public function viewTtdProposal($id) {
        $sql = RencanaKegiatan::where('id', $id)->first();
        if (isset($sql->id)){
			$catatanks 					= $sql->catatanks;
			$ceksudahacc 				= explode(' ', $catatanks);
			if ($ceksudahacc[0] == 'Disetujui'){
				return redirect('/laporankegiatan/'.$id);
			} else {
				if ($sql->markingteksproposal == null OR $sql->markingteksproposal == ''){
					$teksproposal			= '';
				} else {
					$teksproposal			= $sql->getTeksProposal->xfile ?? '';
				}
				if ($sql->markingteksrab == null OR $sql->markingteksrab == ''){
					$markingteksrab			= [];
				} else {
					$markingteksrab 		= RABKegiatan::where('marking', $sql->markingteksrab)->get();
				}
				$tandatangan				= '';
				$usernameks					= '';
				$cekpejabat     			= Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', $sql->id_sekolah)->first();
				if (isset($cekpejabat->id)){
					$nama       			= $cekpejabat->nama;
					$niy        			= $cekpejabat->niy;
					$foto 					= $cekpejabat->foto;
					$getusername 			= User::where('nip', $niy)->first();
					if (isset($getusername->id)){
						$usernameks 		= $getusername->username;
						$cekmarkttdks   	= 'TTDKS-'.Session('sekolah_id_sekolah');
						$cekttdks           = XFiles::where('xmarking', $cekmarkttdks)->first();
						if (isset($cekttdks->xfile)){
							$tandatangan	= $cekttdks->xfile;
						} else {
							$cekmarkttd     = 'TTD-'.$usernameks;
							$cekttd         = XFiles::where('xmarking', $cekmarkttd)->first();
							if (isset($cekttd->xfile)){
								$tandatangan= $cekttd->xfile;
							}
						}
					}
					if ($foto == '' OR is_null($foto)){
						$fotoks 			= url("/").'/'.Session('sekolah_logo');
					} else {
						$fotoks 			= url("/").'/dist/img/foto/'.$foto;
					}
				} else {
					$nama 					= 'Kepala Sekolah '.config('global.sekolah');
				}
	
				$data['usernameks'] 		= $usernameks;
				$data['tandatangan'] 		= $tandatangan;
				$data['nama'] 				= $nama;
				$data['fotoks'] 			= $fotoks;
				$data['markingteksrab'] 	= $markingteksrab;
				$data['teksproposal'] 	    = $teksproposal;
				$data['datakegiatan']       = $sql;
				return view('simaster.formttdproposal', $data);
			}
        } else {
            $data                       = [];
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Proposal ID '.$id.' Tidak ditemukan';
            return view('errors.notready', $data);
        }
	}
	public function viewProposal($id) {
        $sql = RencanaKegiatan::where('id', $id)->first();
        if (isset($sql->id)){
			$catatanks 					= $sql->catatanks;
			if ($sql->markingteksproposal == null OR $sql->markingteksproposal == ''){
				$teksproposal			= '';
			} else {
				$teksproposal			= $sql->getTeksProposal->xfile ?? '';
			}
			if ($sql->markingteksrab == null OR $sql->markingteksrab == ''){
				$markingteksrab			= [];
			} else {
				$markingteksrab 		= RABKegiatan::where('marking', $sql->markingteksrab)->get();
			}
			$cekpejabat     			= Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', session('sekolah_id_sekolah'))->first();
			$fotoks 					= url("/").'/'.Session('sekolah_logo');
			$markindttdks = session('sekolah_id_sekolah').'-'.$sql->id.'-persetujuanKS';
			$cekttdks 					= XFiles::where('xmarking', $markindttdks)->first();
			if(isset($cekttdks->xid)){
				$ttdks 					= $cekttdks->xfile;
			} else { $ttdks				= ''; }
			$data['ttdks'] 				= $ttdks;
			$data['fotoks'] 			= $fotoks;
			$data['markingteksrab'] 	= $markingteksrab;
			$data['teksproposal'] 	    = $teksproposal;
			$data['datakeuangan']      	= EfikasiKeuangan::where('realjenis', 'Kegiatan')->where('realnominal', $sql->id)->get();
			$data['datakegiatan']       = $sql;
			return view('simaster.previewproposal', $data);
        } else {
            $data                       = [];
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Proposal ID '.$id.' Tidak ditemukan';
            return view('errors.notready', $data);
        }
	}
	public function expersetujuanBerkas(Request $request) {
        $validator = Validator::make($request->all(), [
            'set01'     =>  'required',
            'set02'     =>  'required',
            'set03'     =>  'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Error !! Semua Form Harus di Isi']);
        } else {
			$id 		= $request->input('set01');
			$ttd 		= $request->input('set02');
			$alasan 	= $request->input('set03');
			$alamatweb 	= $request->input('set04');
			$jenissurat = $request->input('set05');
			$username 	= $request->input('set06');
			$password 	= $request->input('set07');
			if (is_null($username)){ $username = ''; }
			if (is_null($password)){ $password = ''; }
			
			if ($username != '' AND $password != ''){
				$user 			= User::where('username',$username)->first();
				if (Hash::check($password, $user->password)) {
					$lanjut = 1;
				} else {
					$lanjut = 0;
				}
			} else {
				$lanjut = 1;
			}
			if ($lanjut == 1){
				if ($jenissurat == 'Kwitansi'){
					$rom  		= HPTKeuangan::where('id', $id)->first();
					if (isset($rom->id)){
						if ($rom->pengeluaran == '' OR $rom->pengeluaran == 0) {$realjenis = 'pemasukan'; $realnominal = $rom->pemasukan; }
						else { $realjenis = 'pengeluaran'; $realnominal = $rom->pengeluaran;}
						if ($alasan == 'SETUJU'){
							$update = HPTKeuangan::where('id', $id)->update([
								'tglkwitansi'	=> date("Y-m-d"),
								'updated_at'	=> date("Y-m-d H:i:s")
							]);
							$cekmailbox = Inboxsurat::where('xmarking', $markindttd)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
							if (isset($cekmailbox->id)){
								Inboxsurat::where('id', $cekmailbox->id)->update([
									'status'	=> 2,
									'penerima'	=> 'Arsip'
								]);
							}
						} else {
							$markindttd = session('sekolah_id_sekolah').'-'.$rom->id.'-kwitansi';
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $markindttd,
									'xtabel'	=> 'db_keuangan',
								],
								[
									'xjenis'	=> '',
									'xfile'		=> $ttd
								]
							);
							$update = HPTKeuangan::where('id', $id)->update([
								'keterangan'	=> 'Tidak Setuju dengan alasan '.$alasan.' pada '.date("Y-m-d H:i:s"),
								'pemasukan'		=> 0,
								'pengeluaran'	=> 0,
								'realnominal'	=> $realnominal,
								'realjenis'		=> $realjenis,
								'updated_at'	=> date("Y-m-d H:i:s")
							]);
						}
						if ($update){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Data Updated']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
						return back();	
					}
				} else if ($jenissurat == 'Orang Tua Asuh'){
					$rom  	= Datainduk::where('id', $id)->first();
					if (isset($rom->id)){
						$kodeortuasuh = $rom->kodeortuasuh;
						if ($kodeortuasuh == '' OR is_null($kodeortuasuh)){
							$update = Datainduk::where('id', $id)->update([
								'ttdoratuasuh'	=> $ttd,
								'kodeortuasuh'	=> Session('email'),
								'tglkesediaan'	=> date("Y-m-d H:i:s"),
								'updated_at'	=> date("Y-m-d H:i:s"),
							]);
							if ($update){
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Permohon Sebagai Orang Tua Asuh Telah Kami Terima. Semoga Allah, Tuhan Yang Maha Kaya dan Maha Mengurusi Segala Sesuatu memudahkan urusan Dunia dan Akherat Bapak / Ibu yang budiman.']);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
								return back();
							}
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Permohonan Gagal, Siswa ini telah memiliki Orang Tua Asuh. Mohon Refresh Kembali Laman Ini']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
						return back();	
					}
				} else if ($jenissurat == 'TAMBAH DATA SISWA'){
					$noinduk	= $id;
					$tgllahir	= $ttd;
					$rom  		= Datainduk::where('noinduk', $noinduk)->where('tgllahir', $tgllahir)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
					if (isset($rom->id)){
						$update = Datainduk::where('id', $rom->id)->update([
							'kodeortu'		=> Session('id'),
							'updated_at'	=> date("Y-m-d H:i:s"),
						]);
						if ($update){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Setting Sebagai Orang Tua Telah Kami Terima. Semoga Allah, Tuhan Yang Maha Kaya dan Maha Mengurusi Segala Sesuatu memudahkan urusan Dunia dan Akherat Bapak / Ibu yang budiman.']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan, Pastikan Pilihan Sekolah Bapak/Ibu sesuai dengan portal loginnya']);
						return back();	
					}
				} else if ($jenissurat == 'Rencana Kegiatan'){
					$rom  		= RencanaKegiatan::where('id', $id)->first();
					if (isset($rom->id)){
						if ($alasan == 'SETUJU'){
							$update = RencanaKegiatan::where('id', $id)->update([
								'catatanks'	=> 'Disetujui Pada :'.date("Y-m-d H:i:s"),
							]);
							$markindttdks = session('sekolah_id_sekolah').'-'.$rom->id.'-persetujuanKS';
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $markindttdks,
									'xtabel'	=> 'db_rencanakegiatan',
								],
								[
									'xjenis'	=> 'Kegiatan Tahun '.date('Y'),
									'xfile'		=> $ttd
								]
							);
							$cekmailbox = Inboxsurat::where('xmarking', $markindttdks)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
							if (isset($cekmailbox->id)){
								Inboxsurat::where('id', $cekmailbox->id)->update([
									'status'	=> 2,
									'penerima'	=> 'Arsip'
								]);
							}
						} else {
							$update = RencanaKegiatan::where('id', $id)->update([
								'catatanks'	=> 'Ditolak Pada '.date("Y-m-d H:i:s").' dengan alasan '.$alasan,
							]);
						}
						if ($update){
							return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Terimakasih atas persetujuan Bapak/Ibu']);
							return back();
						} else {
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
						return back();	
					}
				} else if ($jenissurat == 'Rapot Orang Tua'){
					$cekdata		= Rapotan::where('id', $id)->first();
					if (isset($cekdata->id)){
						$rapotkhas		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotKhas';
						$rapotdinas		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotDinas';
						$markingortu	= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-ORTU';
						$ceksudah 		= XFiles::where('xmarking', $markingortu)->count();
						if ($ceksudah == 0){
							XFiles::create([
								'xmarking'	=> $markingortu,
								'xtabel'	=> $request->input('set04'),
								'xjenis'	=> $cekdata->noinduk,
								'xfile'		=> $ttd
							]);
						} else {
							XFiles::where('xmarking', $markingortu)->update([
								'xtabel'	=> $request->input('set04'),
								'xjenis'	=> $cekdata->noinduk,
								'xfile'		=> $ttd
							]);
						}
						$ceksudah1 		= XFiles::where('xmarking', $rapotdinas)->first();
						if (isset($ceksudah1->xfile)){
							$rapotdinas = $ceksudah1->xfile;
							$rapotdinas	= str_replace('[ttdortu]', '<img src="'.$ttd.'" height="100">', $rapotdinas);
							XFiles::where('xmarking', $rapotdinas)->update([
								'xfile'	=> $rapotdinas
							]);
						}
						$ceksudah2 			= XFiles::where('xmarking', $rapotkhas)->first();
						if (isset($ceksudah2->xfile)){
							$rapotkhas	= $ceksudah2->xfile;
							$rapotkhas	= str_replace('[ttdortu]', '<img src="'.$ttd.'" height="100">', $rapotkhas);
							XFiles::where('xmarking', $rapotkhas)->update([
								'xfile'	=> $rapotkhas
							]);
						}
						$cekmailbox = Inboxsurat::where('xmarking', $rapotdinas)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
						if (isset($cekmailbox->id)){
							Inboxsurat::where('id', $cekmailbox->id)->update([
								'status'	=> 2,
								'penerima'	=> 'Arsip'
							]);
						}
						$cekmailbox = Inboxsurat::where('xmarking', $rapotkhas)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
						if (isset($cekmailbox->id)){
							Inboxsurat::where('id', $cekmailbox->id)->update([
								'status'	=> 2,
								'penerima'	=> 'Arsip'
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Terimakasih, Atas Respon Bapak/Ibu']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
						return back();
					}
				} else if ($jenissurat == 'Rapot Kepala Sekolah'){
					$cekdata		= Rapotan::where('id', $id)->first();
					if (isset($cekdata->id)){
						$marking		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDKS';
						$rapotkhas		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotKhas';
						$rapotdinas		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotDinas';
						$ceksudah 		= XFiles::where('xmarking', $marking)->count();
						if ($ceksudah == 0){
							XFiles::create([
								'xmarking'	=> $marking,
								'xtabel'	=> $request->input('set04'),
								'xjenis'	=> $cekdata->noinduk,
								'xfile'		=> $ttd
							]);
						} else {
							XFiles::where('xmarking', $marking)->update([
								'xtabel'	=> $request->input('set04'),
								'xjenis'	=> $cekdata->noinduk,
								'xfile'		=> $ttd
							]);
						}
						$ceksudah1 		= XFiles::where('xmarking', $rapotdinas)->first();
						if (isset($ceksudah1->xfile)){
							$rapotdinas = $ceksudah1->xfile;
							$rapotdinas	= str_replace('[ttdks]', '<img src="'.$ttd.'" height="100">', $rapotdinas);
							XFiles::where('xmarking', $rapotdinas)->update([
								'xfile'	=> $rapotdinas
							]);
						}
						$ceksudah2 			= XFiles::where('xmarking', $rapotkhas)->first();
						if (isset($ceksudah2->xfile)){
							$rapotkhas	= $ceksudah2->xfile;
							$rapotkhas	= str_replace('[ttdks]', '<img src="'.$ttd.'" height="100">', $rapotkhas);
							XFiles::where('xmarking', $rapotkhas)->update([
								'xfile'	=> $rapotkhas
							]);
						}
						$ceksudahada 	= MushafUjianLisan::where('noinduk', $cekdata->noinduk)->where('semester', $cekdata->semester)->where('tapel', $cekdata->tapel)->where('id_sekolah', $cekdata->id_sekolah)->first();
						if (isset($ceksudahada->id)){
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $ceksudahada->marking,
								],
								[
									'xtabel'	=> 'mushaf_ujianlisan',
									'xjenis'	=> $cekdata->noinduk,
									'xfile'		=> $ttd
								]
							);
						}
						$cekmailbox = Inboxsurat::where('xmarking', $rapotdinas)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
						if (isset($cekmailbox->id)){
							Inboxsurat::where('id', $cekmailbox->id)->update([
								'status'	=> 2,
								'penerima'	=> 'Arsip'
							]);
						}
						$cekmailbox = Inboxsurat::where('xmarking', $rapotkhas)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
						if (isset($cekmailbox->id)){
							Inboxsurat::where('id', $cekmailbox->id)->update([
								'status'	=> 2,
								'penerima'	=> 'Arsip'
							]);
						}
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Terimakasih, Atas Respon Bapak/Ibu']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
						return back();
					}
				} else {
					$rom  		= Suratkeluar::where('id', $id)->first();
					if (isset($rom->id)){
						$pembuat 	= $rom->pembuat;
						$filelama 	= $rom->klasifikasi;
						$tahun		= $rom->yersrt;
						if ($alasan == 'SETUJU'){
							XFiles::where('xmarking', $rom->marking)->update([
								'xfile' => $ttd
							]);
							$update = Suratkeluar::where('id', $id)->update([
								'status'		=> 'File Uploaded, Signed',
								'updated_at'	=> date('Y-m-d H:i:s')
							]);
							$cekmailbox = Inboxsurat::where('xmarking', $rom->marking)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
							if (isset($cekmailbox->id)){
								Inboxsurat::where('id', $cekmailbox->id)->update([
									'status'	=> 2,
								]);
							}
							if ($update){
								$ceknip 	= User::where('nama', $pembuat)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
								if (isset($ceknip->nip)){
									$tuliskirim = 'Surat Nomor '.$rom->nomor.' Sudah di Tandatangani';
									SendMail::mobilenotif($ceknip->nip,'perseorangan',$pembuat,$tuliskirim);
									Notification::send($ceknip, new NewMessageNotification($tuliskirim));
								}
								$homebase	= url("/");
								$domain		= str_replace('http://', '', $homebase);
								$domain		= str_replace('https://', '', $domain);
								$domain		= str_replace('/', '', $domain);
								$domain		= str_replace('#', '', $domain);
								$domain		= str_replace('-', '', $domain);
								$domain		= str_replace('.', '', $domain);
								$fileserti 	= $domain.'.crt';
								$error		= '';
								if (Storage::disk('local')->exists('/tte/' . $fileserti)) {
									$certificate 	= 'file://'.base_path().'/public/tte/'.$fileserti;
									try {
										$info = array(
											'Name' 			=> $rom->namapejabat,
											'Location' 		=> $homebase,
											'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik, verifikasi keaslian dokumen ini merujuk ke '.$homebase,
											'ContactInfo' 	=> $domain,
										);
										$page_format 		= array(
											'MediaBox' 		=> array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 330),
											'Dur' 			=> 3,
											'PZ' 			=> 1,
										);
										$pdf 	= new Fpdi('P','mm',array(210,330));
										$pages 	= $pdf->setSourceFile(public_path().'/'.$filelama);
										for ($i = 1; $i <= $pages; $i++)
										{
											$page = $pdf->importPage($i);
											$pdf->AddPage();
											$pdf->useTemplate($page, ['adjustPageSize' => true]);
											$pdf->setSignature($certificate, $certificate, $rom->marking, '', 2, $info);
											$pdf->setPageMark();
										}
										$pdf->Output(public_path().'/scan/'.$tahun.'/'.$rom->marking.'.pdf', 'F');
										if (Storage::disk('local')->exists('/scan/'.$tahun.'/'. $rom->marking.'.pdf')) {
											$draft 		= public_path($filelama);
											try {
												unlink($draft);
											} catch (\Exception $e) {
											}
											Suratkeluar::where('id', $rom->id)->update([
												'sifat'			=> 'TTE',
												'klasifikasi'	=> 'scan/'.$tahun.'/'.$rom->marking.'.pdf'
											]);
										}
									} catch (\Exception $e) {
										$error = $e->getMessage();
										Suratkeluar::where('id', $rom->id)->update([
											'sifat'		=> $error,
										]);
									}
								} else {
									Suratkeluar::where('id', $rom->id)->update([
										'sifat'		=> 'Non TTE',
									]);
								}
								return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Terimakasih, Surat ini kami proses Lebih Lanjut '.$error]);
								return back();
							} else {
								return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
								return back();
							}
						} else {
							Suratkeluar::where('id', $id)->update([
								'status'		=> 'File Uploaded, dan Di Tolak',
								'perihal'		=> $rom->perihal.'<br />Ditolak dengan alasan '.$alasan,
							]);
							$ceknip 	= User::where('nama', $pembuat)->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
							if (isset($ceknip->nip)){
								$tuliskirim = 'Surat Nomor '.$rom->nomor.' dikembalikan untuk diperbaiki dengan catatan '.$alasan;
								SendMail::mobilenotif($ceknip->nip,'perseorangan',$pembuat,$tuliskirim);
								Notification::send($ceknip, new NewMessageNotification($tuliskirim));
							}
							$cekmailbox = Inboxsurat::where('xmarking', $rom->marking)->where('id_sekolah', session('sekolah_id_sekolah'))->first();
							if (isset($cekmailbox->id)){
								Inboxsurat::where('id', $cekmailbox->id)->update([
									'status'	=> 2,
									'penerima'	=> 'Arsip'
								]);
							}
							return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Thank You', 'message' => 'Terimakasih atas konfirmasinya, surat akan kami revisi sesegera mungkin']);
							return back();
						}
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
						return back();	
					}
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Password Salah']);
				return back();
			}
        }
    }
	public function exPresensiviewPIP(Request $request) {
		$nama 		= strtoupper($request->val01);
		$kelas		= strtoupper($request->val02);
		$idsekolah 	= $request->val03;
		$cekdata	= AbsenProgramPIP::where('nama', $nama)->where('kelas', $kelas)->where('idsekolah', $idsekolah)->count();
		if ($cekdata != 0){
			$input 	= 	AbsenProgramPIP::where('nama', $nama)->where('kelas', $kelas)->where('idsekolah', $idsekolah)->update([
				'updated_at'=> date("Y-m-d H:i:s")
			]);
		} else {
			$input 	= 	AbsenProgramPIP::create([
				'nama'		=> $nama,
				'kelas'		=> $kelas,
				'idsekolah'	=> $idsekolah,
			]);
		}
		if ($input){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Selamat Datang '.$nama]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan, Hubungi Tim IT Terkait']);
			return back();
		}
	}
	//RAPOT
	public function viewTtdRapot ($id){
		$homebase		= url('/');
		$cekdata		= Rapotan::where('id', $id)->first();
		if (isset($cekdata->id)){
			$ttdortu 			= '';
			$catatanortu 		= '';
			$foto 				= $cekdata->foto;
			$id_sekolah 		= $cekdata->id_sekolah;
			$semester			= $cekdata->semester;
			$semestercari		= mb_substr($semester, 0, 1);
			$markingks			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDKS';
			$markingguru		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDGURU';
			$rapotalquran		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotAlQuran';
			$rapotkhas			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotKhas';
			$rapotdinas			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotDinas';
			$hasilujianlisan	= $cekdata->tapel.'-'.$semestercari.'-UL-'.$cekdata->kelas.'-'.$cekdata->noinduk;
			$cekortu			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-ORTU';
			$cekttdks 			= XFiles::where('xmarking', $markingks)->first();
			if (isset($cekttdks->xfile)){
				$ttdks  		= $cekttdks->xfile;
				$url 			= $homebase.'/rapot/'.$cekdata->id;
				return Redirect::to($url);
			} else {
				$ceksudah 			= XFiles::where('xmarking', $cekortu)->first();
				if (isset($ceksudah->xfile)){
					$ttdortu  		= $ceksudah->xfile;
					$catatanortu  	= $ceksudah->xtabel;
				}
				$ceksudahada		= MushafUjian::where('id_sekolah',$cekdata->id_sekolah)->where('semester', $semestercari)->where('tapel', $cekdata->tapel)->where('noinduk', $cekdata->noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'created_at', 'namaguru', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
				if (!empty($ceksudahada)){
					$rapotalquran	= '<table class="table table-striped table-bordered"><thead><tr><th>Kode Semester</th><th>Tanggal</th><th>Link</th></tr></thead><tbody>';
					foreach ($ceksudahada as $rujianalquran){
						$rapotalquran = $rapotalquran.'<tr><td>'.$rujianalquran->tapelsemester.'</td><td>'.$rujianalquran->created_at.'</td><td><a href="'.url("/").'/'.$rujianalquran->link.'" target="_blank"><span class="badge badge-primary">View</span></a></td></tr>';
					}
					$rapotalquran = $rapotalquran.'</tbody></table>';
				}
				$rapotdinas 	= self::genSurat($cekdata->id, 'rapot');
				$rapotkhas  	= self::genSurat($cekdata->id, 'rapotkhas');
				$cekdataul 		= MushafUjianLisan::where('noinduk', $cekdata->noinduk)->where('semester', $semestercari)->where('tapel', $cekdata->tapel)->where('id_sekolah', $cekdata->id_sekolah)->first();
				if (isset($cekdataul->id)){
					$hasilujianlisan 	= self::genSurat($cekdataul->id, 'hasilujianlisan');
				}
				if ($foto == '' OR is_null($foto)){
					$lampiran = url("/").'/'.Session('sekolah_logo');
				} else {
					if (Storage::disk('local')->exists('/dist/img/foto/' . $foto)) {
						$lampiran = url("/").'/dist/img/foto/'.$foto;
					} else {
						$lampiran = url("/").'/'.Session('sekolah_logo');
					}
				}
				$tandatangan				= '';
				$usernameks					= '';
				$cekpejabat     			= Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', $id_sekolah)->first();
				if (isset($cekpejabat->id)){
					$nama       			= $cekpejabat->nama;
					$niy        			= $cekpejabat->niy;
					$foto 					= $cekpejabat->foto;
					$getusername 			= User::where('nip', $niy)->first();
					if (isset($getusername->id)){
						$usernameks 		= $getusername->username;
						$cekmarkttd 		= 'TTD-'.$usernameks;
						$cekttd				= XFiles::where('xmarking', $cekmarkttd)->first();
						if (isset($cekttd->xfile)){
							$tandatangan	= $cekttd->xfile;
						}
					}
					if ($foto == '' OR is_null($foto)){
						$fotoks 			= url("/").'/'.Session('sekolah_logo');
					} else {
						$fotoks 			= url("/").'/dist/img/foto/'.$foto;
					}
				} else {
					$nama 					= 'Kepala Sekolah '.config('global.sekolah');
				}
				if ($cekdata->fase == 'MATABA'){
					$data['usernameks'] 		= $usernameks;
					$data['tandatangan'] 		= $tandatangan;
					$data['ttdortu'] 			= $ttdortu;
					$data['catatanortu'] 		= $catatanortu;
					$data['foto'] 				= $lampiran;
					$data['rapot'] 				= $cekdata;
					$data['rapotdinas'] 		= $rapotdinas;
					$data['rapotkhas'] 			= $rapotkhas;
					$data['rapotalquran'] 		= $rapotalquran;
					$data['hasilujianlisan'] 	= $hasilujianlisan;
					return view('simaster.erapottpq', $data);
				} else {
					$data['usernameks'] 		= $usernameks;
					$data['tandatangan'] 		= $tandatangan;
					$data['ttdortu'] 			= $ttdortu;
					$data['catatanortu'] 		= $catatanortu;
					$data['foto'] 				= $lampiran;
					$data['rapot'] 				= $cekdata;
					$data['rapotdinas'] 		= $rapotdinas;
					$data['rapotkhas'] 			= $rapotkhas;
					$data['rapotalquran'] 		= $rapotalquran;
					$data['hasilujianlisan'] 	= $hasilujianlisan;
					return view('simaster.erapot', $data);
				}
				
			}
		} else {
			$data['generatetbl']  = '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
			return view('cetak.suratgenerator', $data);
		}
	}
	public function viewRapot ($id){
		$cekdata		= Rapotan::where('id', $id)->first();
		if (isset($cekdata->id)){
			$ttdortu 			= '';
			$catatanortu 		= '';
			$linkrapotdinas 	= url('/').'/rapot/'.$id;
			$linkrapotkhas 		= url('/').'/rapot/'.$id;
			$linkrapotalquran 	= url('/').'/rapot/'.$id;
			$linkrapotlisan 	= url('/').'/rapot/'.$id;
			$foto 				= $cekdata->foto;
			$id_sekolah 		= $cekdata->id_sekolah;
			$semester			= $cekdata->semester;
			$semestercari		= mb_substr($semester, 0, 1);
			$rapotalquran		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotAlQuran';
			$rapotkhas			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotKhas';
			$rapotdinas			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-RapotDinas';
			$hasilujianlisan	= $cekdata->tapel.'-'.$semestercari.'-UL-'.$cekdata->kelas.'-'.$cekdata->noinduk;
			$markingguru		= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-TTDGURU';
			$cekortu			= $cekdata->tapel.'-'.$cekdata->semester.'-'.$cekdata->kelas.'-'.$cekdata->noinduk.'-'.$cekdata->id_sekolah.'-ORTU';
			$ceksudah 			= XFiles::where('xmarking', $cekortu)->first();
			if (isset($ceksudah->xfile)){
				$ttdortu  		= $ceksudah->xfile;
				$catatanortu  	= $ceksudah->xtabel;
			}
			$ceksudahada		= MushafUjian::where('id_sekolah',$cekdata->id_sekolah)->where('semester', $semestercari)->where('tapel', $cekdata->tapel)->where('noinduk', $cekdata->noinduk)->groupBy('tapelsemester')->select('nama', 'noinduk', 'kelas', 'foto', 'tapel', 'tapelsemester', 'sakit', 'ijin', 'alpha', 'semester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'created_at', 'namaguru', DB::raw("CONCAT('rapotalquran/', tapelsemester, '.', semester, '.', kelas, '.', niyguru, '.', noinduk) AS link"))->get();
			if (!empty($ceksudahada)){
				$rapotalquran	= '<table class="table table-striped table-bordered"><thead><tr><th>Kode Semester</th><th>Tanggal</th><th>Link</th></tr></thead><tbody>';
				foreach ($ceksudahada as $rujianalquran){
					$rapotalquran = $rapotalquran.'<tr><td>'.$rujianalquran->tapelsemester.'</td><td>'.$rujianalquran->created_at.'</td><td><a href="'.url("/").'/'.$rujianalquran->link.'" target="_blank"><span class="badge badge-primary">View</span></a></td></tr>';
				}
				$rapotalquran = $rapotalquran.'</tbody></table>';
			}
			$linkrapotdinas 	= url('/').'/printmark/'.$cekdata->id;
			$rapotdinas 		= self::genSurat($cekdata->id, 'rapot');
			$linkrapotkhas 		= url('/').'/printmarkbyid/'.$cekdata->id;
			$rapotkhas  		= self::genSurat($cekdata->id, 'rapotkhas');
			$ceksudahada 		= MushafUjianLisan::where('noinduk', $cekdata->noinduk)->where('semester', $semestercari)->where('tapel', $cekdata->tapel)->where('id_sekolah', $cekdata->id_sekolah)->first();
			if (isset($ceksudahada->id)){
				$hasilujianlisan 	= self::genSurat($ceksudahada->id, 'hasilujianlisan');
				$linkrapotlisan 	= url('/').'/hasilujianlisan/'.$ceksudahada->id;
			}
			if ($foto == '' OR is_null($foto)){
				$lampiran = url("/").'/'.Session('sekolah_logo');
			} else {
				if (Storage::disk('local')->exists('/dist/img/foto/' . $foto)) {
					$lampiran = url("/").'/dist/img/foto/'.$foto;
				} else {
					$lampiran = url("/").'/'.Session('sekolah_logo');
				}
			}
			if ($cekdata->fase == 'MATABA'){
				$data['linkrapotkhas']		= $linkrapotkhas;
				$data['linkrapotalquran']	= $linkrapotalquran;
				$data['ttdortu'] 			= $ttdortu;
				$data['catatanortu'] 		= $catatanortu;
				$data['foto'] 				= $lampiran;
				$data['rapot'] 				= $cekdata;
				$data['rapotkhas'] 			= $rapotkhas;
				$data['rapotalquran'] 		= $rapotalquran;
				return view('cetak.erapotmataba', $data);
			} else {
				$data['linkrapotdinas']		= $linkrapotdinas;
				$data['linkrapotkhas']		= $linkrapotkhas;
				$data['linkrapotalquran']	= $linkrapotalquran;
				$data['linkrapotlisan']		= $linkrapotlisan;
				$data['ttdortu'] 			= $ttdortu;
				$data['catatanortu'] 		= $catatanortu;
				$data['foto'] 				= $lampiran;
				$data['rapot'] 				= $cekdata;
				$data['rapotdinas'] 		= $rapotdinas;
				$data['rapotkhas'] 			= $rapotkhas;
				$data['rapotalquran'] 		= $rapotalquran;
				$data['hasilujianlisan'] 	= $hasilujianlisan;
				return view('cetak.erapot', $data);
			}
		} else {
			$data['generatetbl']  = '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
			return view('cetak.suratgenerator', $data);
		}
	}
	public function viewRapotAlquran ($id){
		$getarrayid 	= explode('.', $id);
		if (isset($getarrayid[4])){
			$surat 		= self::genSurat($id, 'rapotalquran');
			return $surat;
		} else {
			$data                       = [];
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Rapot AlQuran dengan ID '.$id.' Tidak ditemukan';
            return view('errors.notready', $data);
		}
	}
	public function viewHasilUjianLisan ($id){
		$getarrayid 	= MushafUjianLisan::where('id', $id)->first();
		if (isset($getarrayid->id)){
			$surat = self::genSurat($id, 'hasilujianlisan');
			return $surat;
		} else {
			$data                       = [];
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Hasil Ujian Lisan dengan ID '.$id.' Tidak ditemukan';
            return view('errors.notready', $data);
		}
	}
	public function viewPrintWithMark ($id){
		$rapotkhas  		= self::genSurat($id, 'rapot');
		return $rapotkhas;
		/*
		$cekprintmark 					= XFiles::where('xmarking', $id)->first();
		if (isset($cekprintmark->xfile) AND $cekprintmark->xfile != ''){
			$generatetbl 	= $cekprintmark->xfile;
			$generatetbl	= str_replace('[ttdortu]', '<p>&nbsp;</p><p>&nbsp;</p>', $generatetbl);
			$generatetbl	= str_replace('[ttdguru]', '<p>&nbsp;</p><p>&nbsp;</p>', $generatetbl);
			$generatetbl	= str_replace('[ttdks]', '<p>&nbsp;</p><p>&nbsp;</p>', $generatetbl);
			$generatetbl	= str_replace('720', '800', $generatetbl);
			$data['generatetbl']  = $generatetbl;
			return view('cetak.suratgenerator', $data);
		} else {
			$data                       = [];
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Print Mark '.$id.' Tidak ditemukan';
            return view('errors.notready', $data);
		}
		*/
	}
	public function viewPrintWithMarkID ($id){
		$rapotkhas  		= self::genSurat($id, 'rapotkhas');
		return $rapotkhas;
		/*
		$cekprintmark		= XFiles::where('xid', $id)->first();
		if (isset($cekprintmark->xfile) AND $cekprintmark->xfile != ''){
			$generatetbl 	= $cekprintmark->xfile;
			$generatetbl	= str_replace('[ttdortu]', '<p>&nbsp;</p><p>&nbsp;</p>', $generatetbl);
			$generatetbl	= str_replace('[ttdguru]', '<p>&nbsp;</p><p>&nbsp;</p>', $generatetbl);
			$generatetbl	= str_replace('[ttdks]', '<p>&nbsp;</p><p>&nbsp;</p>', $generatetbl);
			$generatetbl	= str_replace('720', '800', $generatetbl);
			$data['generatetbl']  = $generatetbl;
			return view('cetak.suratgenerator', $data);
		} else {
			$data                       = [];
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Print Mark '.$id.' Tidak ditemukan';
            return view('errors.notready', $data);
		}
			*/
	}
	public function jsonStatistikkd(Request $request) {
		$idrapot 	= $request->val01;
		$ratap 		= 0;
		$ratae 		= 0;
		$ratau		= 0;
		$getdata 		= Rapotan::where('id', $idrapot)->first();
		if (isset($getdata->id)){
			$nama 			= $getdata->nama;
			$kelas			= $getdata->kelas;
			$noinduk 		= $getdata->noinduk;
			$nisn			= $getdata->nisn;
			$tapel 			= $getdata->tapel;
			$semester		= $getdata->semester;
			$id_sekolah		= $getdata->id_sekolah;
			$semestercari	= mb_substr($semester, 0, 1);

			$goleknilaiu = DB::table('db_nilai')
							->whereIn('jennilai', ['pts', 'pat'])
							->where('noinduk', $getdata->noinduk)
							->where('semester', $semestercari)
							->where('tapel', $getdata->tapel)
							->where('id_sekolah', $id_sekolah)
							->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
							->groupBy('noinduk')
							->first();
			$goleknilaip = DB::table('db_nilai')
							->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05'])
							->where('noinduk', $getdata->noinduk)
							->where('semester', $semestercari)
							->where('tapel', $getdata->tapel)
							->where('id_sekolah', $id_sekolah)
							->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
							->groupBy('noinduk')
							->first();
			$goleknilaie = DB::table('db_nilai')
							->whereIn('jennilai', ['e01', 'e02', 'e03', 'e04', 'e05'])
							->where('noinduk', $getdata->noinduk)
							->where('semester', $semestercari)
							->where('tapel', $getdata->tapel)
							->where('id_sekolah', $id_sekolah)
							->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
							->groupBy('noinduk')
							->first();
			$ratap 	= isset($goleknilaip->rata_rata) ? $goleknilaip->rata_rata : 0;
			$ratae 	= isset($goleknilaie->rata_rata) ? $goleknilaie->rata_rata : 0;
			$ratau 	= isset($goleknilaiu->rata_rata) ? $goleknilaiu->rata_rata : 0;
							
		}
		$arraysurat[] = array(
			'jenis' 		=> 'Penilaian Harian',
			'jumlah' 		=> $ratap,
		);
		$arraysurat[] = array(
			'jenis' 		=> 'Evaluasi',
			'jumlah' 		=> $ratae,
		);
		$arraysurat[] = array(
			'jenis' 		=> 'Ujian',
			'jumlah' 		=> $ratau,
		);
		echo json_encode($arraysurat);
	}
	public function jsonStatpermuatan(Request $request) {
		$arraysurat	= [];
		$idrapot 	= $request->val01;
		$getdata 	= Rapotan::where('id', $idrapot)->first();
		if (isset($getdata->id)){
			$nama 			= $getdata->nama;
			$kelas			= $getdata->kelas;
			$noinduk 		= $getdata->noinduk;
			$nisn			= $getdata->nisn;
			$tapel 			= $getdata->tapel;
			$semester		= $getdata->semester;
			$id_sekolah		= $getdata->id_sekolah;
			$fase			= $getdata->fase;
			$semestercari	= mb_substr($semester, 0, 1);

			if ($fase == 'MATABA'){
				$arraysurat[] = [
					'jenis' 		=> 'AL-ISLAM',
					'jumlah' 		=> $getdata->n01,
					'teks' 			=> $getdata->k02,
				];
				$arraysurat[] = [
					'jenis' 		=> 'KOGNITIF',
					'jumlah' 		=> $getdata->n02,
					'teks' 			=> $getdata->k05,
				];
				$arraysurat[] = [
					'jenis' 		=> 'BAHASA',
					'jumlah' 		=> $getdata->n03,
					'teks' 			=> $getdata->k08,
				];
				$arraysurat[] = [
					'jenis' 		=> 'FISIK MOTORIK',
					'jumlah' 		=> $getdata->n04,
					'teks' 			=> $getdata->k11,
				];
			} else {
				for ($index = 1; $index <= 30; $index++) {
					$kode 			= 'k'.sprintf("% 02s", $index);
					$field_huruf 	= 'h'.sprintf("% 02s", $index);
					$field_nilai 	= 'n'.sprintf("% 02s", $index);
					$matpel 		= $getdata->$field_huruf;
					$kkm 			= $getdata->$field_nilai;
					$matpel 		= str_replace('Mulok; ', '', $matpel);
					$matpel 		= str_replace('Wajib; ', '', $matpel);
					if ($getdata->$kode !== '' && $getdata->$kode !== null) {
						$datacari 	= $getdata->$kode;
						$cekjenis 	= explode('[pisah]', $datacari);
						if (isset($cekjenis[1])) {
							$afektif 	= $cekjenis[0];
							$muatan 	= $cekjenis[1];
							$golekakhir = DB::table('db_nilai')
											->whereIn('jennilai', ['pts', 'pat'])
											->where('noinduk', $noinduk)
											->where('semester', $semestercari)
											->where('tapel', $tapel)
											->where('matpel', $muatan)
											->where('id_sekolah', $id_sekolah)
											->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
											->groupBy('noinduk')
											->first();
			
							$golekharian= DB::table('db_nilai')
											->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
											->where('noinduk', $noinduk)
											->where('semester', $semestercari)
											->where('tapel', $tapel)
											->where('matpel', $muatan)
											->where('id_sekolah', $id_sekolah)
											->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
											->groupBy('noinduk')
											->first();
			
							$rataakhir 	= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
							$rataharian = isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
							$arraysurat[] = [
								'jenis' 		=> $muatan,
								'jumlah3' 		=> $rataharian,
								'jumlah4' 		=> $rataakhir,
							];
						}
					}
				}
			}
			
		}
		echo json_encode($arraysurat);
	}
	public function viewBiodataSiswa(Request $request) {
		$data			= [];
		$urutanwerno	= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		$urutanbg		= array('primary','success','warning','info','danger','secondary','primary','success','warning','info');
		$id 			= $request->input('id');
		$previlage  	= Session('previlage');
        if ($previlage !== null) {
			$datainduk 	= Datainduk::where('id', $id)->first();
			if (isset($datainduk->id)){
				$iduser					= Session('id');
				$getdatauser			= User::where('id', $iduser)->first();
				$klsajar				= $getdatauser->klsajar ?? '';
				$semester 				= $getdatauser->smt ?? '1';
				$tapel 					= $getdatauser->tapel ?? '';
				$data['datainduk']  	= $datainduk;
				$data['semester']  		= $semester;
				$data['tapel']  		= $tapel;
				return view('simaster.biodatasiswa', $data);
			} else {
				$data['kalimatheader']  = 'Mohon Maaf';
				$data['kalimatbody']  	= 'ID Siswa '.$id.' Tidak di Temukan';
				return view('errors.notready', $data);
			}
        } else {
			$data['kalimatheader']  	= 'Mohon Maaf';
        	$data['kalimatbody']  		= 'Session Expired, Please Reloggin';
            return view('errors.notready', $data);
        }
	}
	//BUKU TAMU
	public function exbukuTamu(Request $request) {
        $nama   	= $request->input('val02');
		$instansi  	= $request->input('val03');
		$pejabat  	= $request->input('val04');
		$keperluan  = $request->input('val05');
		$email  	= $request->input('val06');
		$hape  		= $request->input('val07');
		$id_sekolah = $request->input('val08');
		
		if ($nama == 'pengecekanfirebase'){
			$firebaseid  	= $request->input('val01');
			$idsekolah   	= $request->input('val03');
			$ceksekolah 	= Sekolah::where('id', $idsekolah)->first();
			if (isset($ceksekolah->id)){
				$url 		= $ceksekolah->domain;
				if ($firebaseid == '' OR is_null($firebaseid)){
					$url 	= $url.'/frontpage?id='.$idsekolah;
				} else {
					$url 	= $url.'/frontpage?id='.$idsekolah.'?firebaseid='.$firebaseid;
				}
			} else {
				$url 		=  url('/').'/frontpage?id='.$idsekolah;
			}
			echo $url;
		} else {
			if($request->hasFile('file')) {
				$ImageExt	= $request->file('file')->getClientOriginalExtension();
				$file_tmp	= $request->file('file');
				$data 		= file_get_contents($file_tmp);
				$foto 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
			} else { $foto = ''; }
			$nama 		= formatPesan($nama);
			$instansi 	= formatPesan($instansi);
			$keperluan 	= formatPesan($keperluan);
			$hape 		= formatPesan($hape);
			$email 		= formatPesan($email);
			$pejabat 	= formatPesan($pejabat);

			$input = Bukutamu::create([
				 'nama'			=> $nama,
				 'instansi'		=> $instansi, 
				 'keperluan'	=> $keperluan, 
				 'hape'			=> $hape, 
				 'email'		=> $email, 
				 'pejabat'		=> $pejabat, 
				 'id_sekolah'	=> $id_sekolah
			]);
			if ($input){
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Welcome '.$nama]);
				return back();
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Sistem Error, Silahkan Coba Beberapa Saat Lagi']);
				return back();
			}
		}
    }
    public function exTamucari(Request $request) {
        $tahun   	= $request->input('val01');
		$bulan  	= $request->input('val02');
		$sekolah  	= $request->input('val03');
		if ($tahun == ''){ $tahun = date("Y"); }
		if ($bulan == 'ALL'){
			$getalldata = Bukutamu::where('id_sekolah', $sekolah)->whereDate('created_at', 'LIKE', $tahun.'%')->get();
		} else {
			$getalldata = Bukutamu::where('id_sekolah', $sekolah)->whereDate('created_at', 'LIKE', $tahun.'-'.$bulan.'%')->get();
		}
		
		$arrrekap	= [];
		if (!empty($getalldata)){
			foreach($getalldata as $rdata){
				$pejabat 	= $rdata->pejabat;
				$arrrekap[] = array(
					'nama' 		=> $rdata->nama,
					'instansi' 	=> $rdata->instansi,
					'keperluan' => $rdata->keperluan,
					'hape' 		=> $rdata->hape,
					'email' 	=> $rdata->email,
					'pejabat' 	=> $rdata->pejabat,
					'foto' 		=> $rdata->foto,
					'tanggal' 	=> $rdata->created_at,
				);
			}
		}
		echo json_encode($arrrekap);
    }
	public function bukuTamu(Request $request) {
		$sekolah  	= $request->input('val01');
		$getalldata = Bukutamu::where('id_sekolah', $sekolah)->whereDate('created_at', Carbon::today())->get();
		$arrrekap	= [];
		if (!empty($getalldata)){
			foreach($getalldata as $rdata){
				$pejabat 	= $rdata->pejabat;
				$arrrekap[] = array(
					'nama' 		=> $rdata->nama,
					'instansi' 	=> $rdata->instansi,
					'keperluan' => $rdata->keperluan,
					'hape' 		=> $rdata->hape,
					'email' 	=> $rdata->email,
					'pejabat' 	=> $rdata->pejabat,
					'foto' 		=> $rdata->foto,
					'tanggal' 	=> $rdata->created_at,
				);
			}
		}
		echo json_encode($arrrekap);
    }
	public function rekapTamu(Request $request) {
		$sekolah  	= $request->input('val01');
    	$getalldata = Bukutamu::where('id_sekolah', $sekolah)->whereDate('created_at', Carbon::today())->groupBy('pejabat')->get();
		$arrrekap	= [];

		if (!empty($getalldata)){
			foreach($getalldata as $rdata){
				$pejabat 	= $rdata->pejabat;
				$jumlah 	= Bukutamu::where('id_sekolah', $sekolah)->whereDate('created_at', Carbon::today())->where('pejabat', $pejabat)->count();
				$arrrekap[] = array(
					'pejabat' 		=> $pejabat,
					'jumlah' 		=> $jumlah,
				);
			}
		}
		echo json_encode($arrrekap);
    }
	//PPDB
	public function ctkKwitansiPSB ($id){
		$surat = self::genSurat($id, 'kwitansiformulirpsb');
		return $surat;
	}
	public function ctkFormkesanggupan($id){
		$homebase				= url("/");
		$datapsb				= $this->getAuthorizedPpdbRecord($id);
		if (isset($datapsb->id)){
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
			$byrdpp1 				= '';
			$byrdpp2 				= '';
			$byrdpp3 				= '';
			$nik					= $datapsb->nik;
			$rsetting				= Sekolah::where('id', $datapsb->id_sekolah)->first();
			$sekolah 				= $rsetting->nama_sekolah;
			$yayasan 				= $rsetting->nama_yayasan;
			$alamat 				= $rsetting->alamat;
			$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
			$mutiara 				= $rsetting->slogan;
			$logo 					= $rsetting->logo;
			$kopsurat 				= $rsetting->kopsurat;
			if ($kopsurat == '' OR $kopsurat == null){
				$kopsurat			= '<tr>
										<td colspan="3" rowspan="9" align="left" valign="top" style="border-bottom:double"><img src="'.$logo.'" width="120" height="120" /></td>
										<td colspan="6">&nbsp;</td>
										<td colspan="2" rowspan="2" align="center" valign="middle" style="border-bottom:double; border-top:double; border-left:double; border-right:double;"><strong>'.$datapsb->kodependaf.'</strong></td>
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="8" align="center"><b>'.$yayasan.'</b></td>
									</tr>
									<tr>
										<td colspan="8" align="center"><b>'.$sekolah.'</b></td>
									</tr>
									<tr>
										<td colspan="8" align="center"><strong>PANITIA PENERIMAAN PESERTA  DIDIK BARU (P2DB)</strong></td>
									</tr>
									<tr>
										<td colspan="8" align="center">'.config('global.nomerinduksekolah').'</td>
									</tr>
									<tr>
										<td colspan="8" align="center"><strong>'.$alamat.'</strong></td>
									</tr>
									<tr>
										<td colspan="8" align="center">'.config('global.email').'</td>
									</tr>
									<tr>
										<td width="21" style="border-bottom:double">&nbsp;</td>
										<td width="33" style="border-bottom:double">&nbsp;</td>
										<td width="56" style="border-bottom:double">&nbsp;</td>
										<td width="22" style="border-bottom:double">&nbsp;</td>
										<td width="25" style="border-bottom:double">&nbsp;</td>
										<td width="198" style="border-bottom:double">&nbsp;</td>
										<td width="39" style="border-bottom:double">&nbsp;</td>
										<td width="129" style="border-bottom:double">&nbsp;</td>
									</tr>';
			} else {
				$kopsurat			= '<tr><td colspan="11"><img src="'.$homebase.'/'.$kopsurat.'" width="100%" /></td></tr>';
			}
			$sql 					= Layanan::where('id_sekolah', $datapsb->id_sekolah)->orderBy('layanan', 'ASC')->get();
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
			if ($setspp1 != ''){
				$byrspp1 = number_format( $setspp1 , 0 , '.' , ',' );
			} else { $byrspp1 = 0; }
			if ($setspp2 != ''){
				$byrspp2 = number_format( $setspp2 , 0 , '.' , ',' );
			} else { $byrspp2 = 0; }
			if ($setspp3 != ''){
				$byrspp3 = number_format( $setspp3 , 0 , '.' , ',' );
			} else { $byrspp3 = 0; }
			if ($setdpp1 != ''){
				$byrdpp1 = number_format( $setdpp1 , 0 , '.' , ',' );
			}
			if ($setdpp2 != ''){
				$byrdpp2 = number_format( $setdpp2 , 0 , '.' , ',' );
			}
			if ($setdpp3 != ''){
				$byrdpp3 = number_format( $setdpp3 , 0 , '.' , ',' );
			}
			$cekpelengkap	= Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah', $datapsb->id_sekolah)->first();
			$scanakta		= $cekpelengkap->getPSBAkta->xfile ?? '';
			$scanfoto		= $cekpelengkap->getPSBFoto->xfile ?? '';
			$scankk			= $cekpelengkap->getPSBKK->xfile ?? '';
			$scanket		= $cekpelengkap->getPSBKet->xfile ?? '';
			$scanbukti		= $cekpelengkap->getPSBBukti->xfile ?? '';
			
			$statcetak		= '';
			if ($scanakta == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Akta Terlebih Dahulu'; }
			if ($scanfoto == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan Foto Terlebih Dahulu'; }
			if ($scankk == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Kartu Keluarga Terlebih Dahulu'; }
			if ($scanket == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Keterangan Lulus'; }
			
			$tahun					= date("Y");
			$tasks					= [];
			$tasks['logo']			= $homebase.'/'.$logo;
			$tasks['logo_grey']		= $homebase.'/'.$rsetting->logo_grey;
			$tasks['kopsurat']		= $kopsurat;
			$tasks['rsetting']		= $rsetting;
			$tasks['yayasan']		= $yayasan;
			$tasks['sekolah']		= $sekolah;
			$tasks['alamat']		= $alamat;
			$tasks['kepalasekolah']	= $kepalasekolah;
			$tasks['periode']		= $periode;
			$tasks['ketuayayasan']	= '____________________';
			$tasks['jabketyayasan']	= 'Ketua '.$yayasan;
			$tasks['datapsb']		= $datapsb;
			$tasks['byrspp1']		= $byrspp1;
			$tasks['byrspp2']		= $byrspp2;
			$tasks['byrspp3']		= $byrspp3;
			$tasks['byrdpp1']		= $byrdpp1;
			$tasks['byrdpp2']		= $byrdpp2;
			$tasks['byrdpp3']		= $byrdpp3;
			$tasks['tahun']			= $tahun;
			return view('cetak.formkesanggupan', $tasks);
		} else {
			return view('errors.hilang');
		}
    }
	public function viewObservasi($id){
		$homebase			= url("/");
		$getdata 			= $this->getAuthorizedPpdbRecord($id);
		if (!isset($getdata->id)){
			return view('errors.hilang');
		} else {
			$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
			$tgliki			= date("d");
			$mthiki 		= (int)date("m");
			$thniki 		= date("Y");
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
			$alamatcetak	= $homebase.'/observasi/'.$id;
			$qrcode 		= QrCode::size(150)->generate($alamatcetak);
			$rsetting		= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
			$sekolah 		= $rsetting->nama_sekolah;
			$yayasan 		= $rsetting->nama_yayasan;
			$alamat 		= $rsetting->alamat;
			$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
			$mutiara 		= $rsetting->slogan;
			$logo 			= $rsetting->logo;
			$logo_grey 		= $rsetting->logo_grey;
			$ketuapanitia	= $kepalasekolah;
			$nik			= $getdata->nik;
			$kodependaf		= $getdata->kodependaf;
			$nama 			= $getdata->nama;
			$kelamin		= $getdata->kelamin;
			$tmplahir 		= $getdata->tmplahir;
			$tgllahir 		= $getdata->tgllahir;
			$umur 			= $getdata->umur;
			$darah			= $getdata->darah;
			$berat			= $getdata->berat;
			$tinggi 		= $getdata->tinggi;
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
			$n1				= $getdata->n1;
			$n2				= $getdata->n2;
			$n3				= $getdata->n3;
			$n4				= $getdata->n4;
			$n5				= $getdata->n5;
			$n6				= $getdata->n6;
			$n7				= $getdata->n7;
			$n8				= $getdata->n8;
			$n9				= $getdata->n9;
			$n10			= $getdata->n10;
			$n11			= $getdata->n11;
			$n12			= $getdata->n12;
			$n13			= $getdata->n13;
			$total			= $getdata->total;
			$rata			= $getdata->rata;
			$hasil			= $getdata->hasil;
			$nosurat		= $getdata->nosurat;
			$des1			= $getdata->des1;
			$des2			= $getdata->des2;
			$des3			= $getdata->des3;
			$des4			= $getdata->des4;
			$des5			= $getdata->des5;
			$des6			= $getdata->des6;
			$des7			= $getdata->des7;
			$deadline		= $getdata->deadline;
			$akhirumum		= $getdata->akhirumum;
			$seragam		= (int)$getdata->dana1;
			$gedung			= (int)$getdata->dana2;
			$spp			= (int)$getdata->dana3;
			$kegiatan		= $getdata->dana4;
			$getnamawaka 	= Dataindukstaff::where('id_sekolah', Session('sekolah_id_sekolah'))->where('jabatan', 'Waka Kesiswaan')->first();
			$wakakesiswaan 	= $getnamawaka->nama ?? '';
			
			$cekpelengkap	= Datapelengkappsb::where('niksiswa', $nik)->first();
			$scanakta		= $cekpelengkap->getPSBAkta->xfile ?? $homebase.'/dist/img/aktehilang.png';
			$scanfoto		= $cekpelengkap->getPSBFoto->xfile ?? $homebase.'/dist/img/fotohilang.png';
			$scankk			= $cekpelengkap->getPSBKK->xfile ?? $homebase.'/dist/img/kkhilang.png';
			$scanket		= $cekpelengkap->getPSBKet->xfile ?? $homebase.'/dist/img/kethilang.png';
			$scanbukti		= $cekpelengkap->getPSBBukti->xfile ?? $homebase.'/dist/img/buktihilang.png';
			$telpon			= $cekpelengkap->telpon ?? '';
			

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
			$sql 					= Layanan::where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('layanan', 'ASC')->get();
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
			$pembagi1 	= 0;
			$pembagi2 	= 0;
			$pembagi3a	= 0;
			$pembagi3b	= 0;
			$pembagi4 	= 0;
			$tot1		= 0;
			$tot2		= 0;
			$tot3a		= 0;
			$tot3b		= 0;
			$tot4		= 0;
			
			if ($hasil == 'DITERIMA'){
				if ($n1 != ''){ 
					$pembagi1++; 
					$tot1 = $tot1 + $n1; 
					if ( ($n1 >= 0) && ($n1 <= 68)) { $terbilang1 = 'D'; }
					elseif ( ($n1 >= 69) && ($n1 <= 77)) { $terbilang1 = 'C'; }
					elseif ( ($n1 >= 78) && ($n1 <= 89)) { $terbilang1 = 'B'; }	
					else { $terbilang1 = 'A';}
				} else { $terbilang1 = ''; }
				if ($n2 != ''){ 
					$pembagi1++; 
					$tot1 = $tot1 + $n2; 
					if ( ($n2 >= 0) && ($n2 <= 68)) { $terbilang2 = 'D'; }
					elseif ( ($n2 >= 69) && ($n2 <= 77)) { $terbilang2 = 'C'; }
					elseif ( ($n2 >= 78) && ($n2 <= 89)) { $terbilang2 = 'B'; }	
					else { $terbilang2 = 'A';}	
				} else { $terbilang2 = ''; }
				if ($n3 != ''){ 
					$pembagi1++;
					$tot1 = $tot1 + $n3; 
					if ( ($n3 >= 0) && ($n3 <= 68)) { $terbilang3 = 'D'; }
					elseif ( ($n3 >= 69) && ($n3 <= 77)) { $terbilang3 = 'C'; }
					elseif ( ($n3 >= 78) && ($n3 <= 89)) { $terbilang3 = 'B'; }	
					else { $terbilang3 = 'A';}	
				} else { $terbilang3 = ''; }
				if ($n4 != ''){ 
					$pembagi2++; 
					$tot2 = $tot2 + $n4; 
					if ( ($n4 >= 0) && ($n4 <= 68)) { $terbilang4 = 'D'; }
					elseif ( ($n4 >= 69) && ($n4 <= 77)) { $terbilang4 = 'C'; }
					elseif ( ($n4 >= 78) && ($n4 <= 89)) { $terbilang4 = 'B'; }	
					else { $terbilang4 = 'A';}
				} else { $terbilang4 = ''; }
				if ($n5 != ''){ 
					$pembagi2++; 
					$tot2 = $tot2 + $n5; 
					if ( ($n5 >= 0) && ($n5 <= 68)) { $terbilang5 = 'D'; }
					elseif ( ($n5 >= 69) && ($n5 <= 77)) { $terbilang5 = 'C'; }
					elseif ( ($n5 >= 78) && ($n5 <= 89)) { $terbilang5 = 'B'; }	
					else { $terbilang5 = 'A';}
				} else { $terbilang5 = ''; }
				if ($n6 != ''){ 
					$pembagi2++; 
					$tot2 = $tot2 + $n6; 
					if ( ($n6 >= 0) && ($n6 <= 68)) { $terbilang6 = 'D'; }
					elseif ( ($n6 >= 69) && ($n6 <= 77)) { $terbilang6 = 'C'; }
					elseif ( ($n6 >= 78) && ($n6 <= 89)) { $terbilang6 = 'B'; }	
					else { $terbilang6 = 'A';}
				} else { $terbilang6 = ''; }
				if ($n7 != ''){ 
					$pembagi3a++; 
					$tot3a = $tot3a + $n7; 
					if ( ($n7 >= 0) && ($n7 <= 68)) { $terbilang7 = 'D'; }
					elseif ( ($n7 >= 69) && ($n7 <= 77)) { $terbilang7 = 'C'; }
					elseif ( ($n7 >= 78) && ($n7 <= 89)) { $terbilang7 = 'B'; }	
					else { $terbilang7 = 'A';}
				} else { $terbilang7 = ''; }
				if ($n8 != ''){ 
					$pembagi3a++; 
					$tot3a = $tot3a + $n8; 
					if ( ($n8 >= 0) && ($n8 <= 68)) { $terbilang8 = 'D'; }
					elseif ( ($n8 >= 69) && ($n8 <= 77)) { $terbilang8 = 'C'; }
					elseif ( ($n8 >= 78) && ($n8 <= 89)) { $terbilang8 = 'B'; }	
					else { $terbilang8 = 'A'; }
				} else { $terbilang8 = ''; }
				if ($n9 != ''){ 
					$pembagi3b++; 
					$tot3b = $tot3b + $n9; 
					if ( ($n9 >= 0) && ($n9 <= 68)) { $terbilang9 = 'D'; }
					elseif ( ($n9 >= 69) && ($n9 <= 77)) { $terbilang9 = 'C'; }
					elseif ( ($n9 >= 78) && ($n9 <= 89)) { $terbilang9 = 'B'; }	
					else { $terbilang9 = 'A'; }
				} else { $terbilang9 = ''; }
				if ($n10 != ''){ 
					$pembagi3b++; 
					$tot3b = $tot3b + $n10; 
					if ( ($n10 >= 0) && ($n10 <= 68)) { $terbilang10 = 'D'; }
					elseif ( ($n10 >= 69) && ($n10 <= 77)) { $terbilang10 = 'C'; }
					elseif ( ($n10 >= 78) && ($n10 <= 89)) { $terbilang10 = 'B'; }	
					else { $terbilang10 = 'A'; }
				} else { $terbilang10 = ''; }
				if ($n11 != ''){ 
					$pembagi4++; 
					$tot4 = $tot4 + $n11; 
					if ( ($n11 >= 0) && ($n11 <= 68)) { $terbilang11 = 'D'; }
					elseif ( ($n11 >= 69) && ($n11 <= 77)) { $terbilang11 = 'C'; }
					elseif ( ($n11 >= 78) && ($n11 <= 89)) { $terbilang11 = 'B'; }	
					else { $terbilang11 = 'A'; }
				} else { $terbilang11 = ''; }
				if ($n12 != ''){ 
					$pembagi4++; 
					$tot4 = $tot4 + $n12; 
					if ( ($n12 >= 0) && ($n12 <= 68)) { $terbilang12 = 'D'; }
					elseif ( ($n12 >= 69) && ($n12 <= 77)) { $terbilang12 = 'C'; }
					elseif ( ($n12 >= 78) && ($n12 <= 89)) { $terbilang12 = 'B'; }	
					else { $terbilang12 = 'A'; }
				} else { $terbilang12 = ''; }
				if ($n13 != ''){ 
					$pembagi4++; 
					$tot4 = $tot4 + $n13; 
					if ( ($n13 >= 0) && ($n13 <= 68)) { $terbilang13 = 'D'; }
					elseif ( ($n13 >= 69) && ($n13 <= 77)) { $terbilang13 = 'C'; }
					elseif ( ($n13 >= 78) && ($n13 <= 89)) { $terbilang13 = 'B'; }	
					else { $terbilang13 = 'A'; }
				} else { $terbilang13 = ''; }
				if ($tot1 != 0){
					$kognitif 	= round(($tot1 / $pembagi1),0);
				} else { $kognitif = ''; }
				$keagamaan = 0;
				if ($tot3a != 0){
					$keagamaana 	= round(($tot3a / $pembagi3a),0);
					$keagamaan		= $keagamaan + $keagamaana;
				} else { $keagamaana = ''; }
				
				if ($tot3b != 0){
					$keagamaanb 	= round(($tot3b / $pembagi3b),0);
					$keagamaan		= $keagamaan + $keagamaanb;
				} else { $keagamaanb = ''; }
				
				if ($keagamaan == 0){
					$keagamaan = '';
				}

				$tagihan	= $seragam + $gedung + $spp;
				$totalbayar = number_format( $tagihan , 0 , '.' , ',' );
				$seragam 	= number_format( $seragam , 0 , '.' , ',' );
				$gedung 	= number_format( $gedung , 0 , '.' , ',' );
				$spp 		= number_format( $spp , 0 , '.' , ',' );

				$generatetbl= '
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="8"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">'.$alamat.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' - NSS : '.$rsetting->nss.' - NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="83">Nomor</td>
					<td width="14">:</td>
					<td colspan="9"><b>'.$nosurat.'</b></td>
				  </tr>
				  <tr>
					<td>Lamp.</td>
					<td>:</td>
					<td colspan="9"><b>1 Lembar</b></td>
				  </tr>
				  <tr>
					<td>Perihal</td>
					<td>:</td>
					<td colspan="9"><b>Pengumuman Hasil Observasi</b></td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Kepada Yth.</td>
				  </tr>
				  <tr>
					<td colspan="11"><b>Wali Murid Ananda '.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="11">Di tempat</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Assalamu&#8217;alaikum warahmatullaahi Wabarakaatuh</em></td>
				  </tr>
				  <tr>
					<td colspan="11">Berdasarkan hasil observasi kompetensi calon peserta didik baru '.$sekolah.' Kota '.config('global.kota').' Tahun Pelajaran '.$tamasuk.', kami putuskan bahwa :</td>
				  </tr>
				  <tr>
					<td colspan="2">Nama</td>
					<td width="38">:</td>
					<td colspan="8"><b>'.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="2">No. Observasi</td>
					<td>:</td>
					<td colspan="8"><strong>'.$kodependaf.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="2">dinyatakan</td>
					<td>:</td>
					<td colspan="8">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" valign="middle"><table width="200" border="1" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center" valign="middle"><b>'.$hasil.'</b></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td colspan="11">sebagai siswa kelas 1 di '.$sekolah.' Tahun Pelajaran '.$tamasuk.'</td>
				  </tr>
				  <tr>
					<td colspan="11">
					<table cellpadding="0" cellspacing="0" border="1" width="100%">
					  <tr>
						<td colspan="10" style="text-align:center; background-color:#6C9"><b>Kesimpulan Hasil Observasi</b></td>
					  </tr>
					  <tr>
						<td colspan="3" style="text-align:center;background-color:#6C9">Observasi</td>
						<td width="143" rowspan="2" style="text-align:center;"><u>Kognitif</u><br />
						  <strong>'.$kognitif.'</strong></td>
						<td rowspan="2" style="text-align:center;"><u>Keagamaan</u><br /><strong>'.$keagamaan.'</strong></td>
						<td colspan="2" style="border-bottom:thin; text-align:center; background-color:#6C9"><u>Jumlah</u></td>
						<td colspan="3" style="text-align:center;background-color:#6C9"><u>Rata - Rata</u></td>
					  </tr>
					  <tr>
						<td colspan="3" style="text-align:center;background-color:#6C9"><b>NILAI</b></td>
						<td colspan="2" style="text-align:center;background-color:#6C9"><strong>'.$total.'</strong></td>
						<td colspan="3" style="text-align:center;background-color:#6C9"><strong>'.$rata.'</strong></td>
					  </tr>
					</table>
					</td>
				  </tr> 
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td width="11">&nbsp;</td>
					<td width="253">&nbsp;</td>
					<td width="43">&nbsp;</td>
					<td width="105">&nbsp;</td>
					<td width="19">&nbsp;</td>
					<td width="134">&nbsp;</td>
					<td width="49">&nbsp;</td>
					<td width="51">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Sehubungan dengan hal tersebut di atas, kami mohon Bapak/Ibu segera melakukan registrasi (daftar ulang) dengan persyaratan sebagai berikut :</td>
				  </tr>
				  <tr>
					<td align="right">1.</td>
					<td>&nbsp;</td>
					<td colspan="9">Melengkapi persyaratan calon siswa baru dengan menyerahkan :</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>a.</td>
					<td colspan="8">Foto copy Kartu Keluarga 2 lembar dengan menunjukkan dokumen asli (bagi yang belum) ;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>b.</td>
					<td colspan="8">Pas Foto berwarna ukuran 3 x 4 sebanyak 2 lembar (bagi yang belum) ;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>c.</td>
					<td colspan="8">Surat keterangan domisili dari RT / RW (bagi yang mengontrak) ;</td>
				  </tr>
				  <tr>
					<td align="right">2.</td>
					<td>&nbsp;</td>
					<td colspan="9">Membayar biaya</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>a.</td>
					<td colspan="2">Seragam &amp; ATS</td>
					<td>Rp.</td>
					<td colspan="2" align="right">'.$seragam.'</td>
					<td colspan="3" class="info">&nbsp;&nbsp;(Saat Daftar Ulang)</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>b.</td>
					<td colspan="2">Dana Pengembangan Pendidikan</td>
					<td>Rp.</td>
					<td colspan="2" align="right">'.$gedung.'</td>
					<td colspan="3" class="info">&nbsp;&nbsp;(Saat Daftar Ulang)</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>c.</td>
					<td colspan="2">Iuran bulan Pertama</td>
					<td>Rp.</td>
					<td colspan="2" align="right">'.$spp.'</td>
					<td colspan="3" class="info">&nbsp;&nbsp;(Paling lambat tgl.'.$deadline.')</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><strong>Total</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align="left"><strong>Rp.</strong></td>
					<td colspan="2" align="right"><strong>'.$totalbayar.'</strong></td>
					<td align="right">&nbsp;</td>
					<td align="right">&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
					<td align="right" valign="top">3.</td>
					<td>&nbsp;</td>
					<td colspan="9" valign="top">Batas Registrasi atau Daftar Ulang <strong>paling lambat satu minggu</strong> setelah pengumuman hasil observasi diterima (berakhir hari '.$akhirumum.'). Jika tidak melakukan daftar ulang pada waktu yang ditentukan dianggap mengundurkan diri dan akan diisi oleh peserta selanjutnya.</td>
				  </tr>
				  <tr>
					<td align="right"valign="top">4.</td>
					<td>&nbsp;</td>
					<td colspan="9" valign="top">Melakukan pengukuran seragam (diumumkan menyusul lewat WA/SMS).</td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Demikian surat pemberitahuan ini, atas bantuan dan kerjasamanya yang baik kami sampaikan terima kasih.</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Wasssalamu&#8217;alaikum warahmatullaahi Wabarakaatuh.</em></td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>'.$wakakesiswaan.'</strong></td>
				  </tr>
				</table>
				<div style="page-break-before: always">
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="2" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="9"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="9"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="9"><strong>PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="9">Terakreditasi A</td>
				  </tr>
				  <tr>
					<td colspan="9" class="judul">NIS : '.$rsetting->nis.' - NSS : '.$rsetting->nss.' - NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="9" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" style="font-size:large;"><b><u>LAPORAN HASIL OBSERVASI PESERTA DIDIK BARU</u></b></td>
				  </tr>
				  <tr>
					<td colspan="11" align="center"><b>TAHUN AJARAN '.$tamasuk.'</b></td>
				  </tr>
				  <tr>
					<td width="80">&nbsp;</td>
					<td width="70">&nbsp;</td>
					<td width="189">&nbsp;</td>
					<td width="16">&nbsp;</td>
					<td width="173">&nbsp;</td>
					<td width="51">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="17">&nbsp;</td>
					<td width="153">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="6">Nama PDB : '.$nama.'</td>
					<td colspan="5" align="right">No. Observasi : '.$kodependaf.'</td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top: double; text-align: center;"><table border="1" cellpadding="0" cellspacing="0">
					  <tr>
						<td width="24" rowspan="2" align="center" bgcolor="#339933"><b>NO</b></td>
						<td width="120" rowspan="2" align="center" bgcolor="#339933"><b>OBSERVASI</b></td>
						<td width="239" rowspan="2" align="center" bgcolor="#339933"><b>ASPEK<br />
						  PENILAIAN</b></td>
						<td colspan="2" align="center" bgcolor="#339933"><b>PEROLEHAN NILAI</b></td>
						<td width="225" rowspan="2" align="center" bgcolor="#339933"><b>DESKRIPSI</b></td>
					  </tr>
					  <tr>
						<td width="71" align="center" bgcolor="#339933"><b>ANGKA</b></td>
						<td width="107" align="center" bgcolor="#339933"><b>HURUF</b></td>
						</tr>
					  <tr>
						<td rowspan="3">1.</td>
						<td rowspan="3">KOGNITIF</td>
						<td>Membaca</td>
						<td style="text-align: center">'.$n1.'</td>
						<td>'.$terbilang1.'</td>
						<td align="left" valign="top">'.$des1.'</td>
					  </tr>
					  <tr>
						<td>Menulis</td>
						<td style="text-align: center">'.$n2.'</td>
						<td>'.$terbilang2.'</td>
						<td align="left" valign="top">'.$des2.'</td>
					  </tr>
					  <tr>
						<td>Berhitung</td>
						<td style="text-align: center">'.$n3.'</td>
						<td>'.$terbilang3.'</td>
						<td align="left" valign="top">'.$des3.'</td>
					  </tr>
					<tr>
						<td rowspan="4">2.</td>
						<td rowspan="4">KEMAMPUAN AGAMA ISLAM</td>
						<td>Mengaji/Membaca</td>
						<td style="text-align: center">'.$n7.'</td>
						<td>'.$terbilang7.'</td>
						<td align="left" valign="top">'.$des4.'</td>
					</tr>
					<tr>
						<td>Menulis</td>
						<td style="text-align: center">'.$n8.'</td>
						<td>'.$terbilang8.'</td>
						<td align="left" valign="top">'.$des5.'</td>
						</tr>
					<tr>
						<td>3 Surat Juz Amma</td>
						<td style="text-align: center">'.$n9.'</td>
						<td>'.$terbilang9.'</td>
						<td align="left" valign="top">'.$des6.'</td>
					</tr>
					<tr>
						<td>3 Doa Harian</td>
						<td style="text-align: center">'.$n10.'</td>
						<td>'.$terbilang10.'</td>
						<td align="left" valign="top">'.$des7.'</td>
					</tr>

				  </table>
				  </td></tr>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>'.$wakakesiswaan.'</strong></td>
				  </tr>
				</table>';
			} else if ($hasil == 'BELUM DITERIMA'){
				$generatetbl= '
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="8"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">'.$alamat.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' - NSS : '.$rsetting->nss.' - NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="83">Nomor</td>
					<td width="14">:</td>
					<td colspan="9"><b>'.$nosurat.'</b></td>
				  </tr>
				  <tr>
					<td>Lamp.</td>
					<td>:</td>
					<td colspan="9"><b>1 Lembar</b></td>
				  </tr>
				  <tr>
					<td>Perihal</td>
					<td>:</td>
					<td colspan="9"><b>Pengumuman Hasil Observasi</b></td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Kepada Yth.</td>
				  </tr>
				  <tr>
					<td colspan="11"><b>Wali Murid Ananda '.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="11">Di tempat</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Assalamu&#8217;alaikum warahmatullaahi Wabarakaatuh</em></td>
				  </tr>
				  <tr>
					<td colspan="11">Berdasarkan hasil observasi kompetensi calon peserta didik baru '.$sekolah.' Kota Malang Tahun Pelajaran '.$tamasuk.', kami putuskan bahwa :</td>
				  </tr>
				  <tr>
					<td colspan="2">Nama</td>
					<td width="38">:</td>
					<td colspan="8"><b>'.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="2">No. Observasi</td>
					<td>:</td>
					<td colspan="8"><strong>'.$kodependaf.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="2">dinyatakan</td>
					<td>:</td>
					<td colspan="8">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" valign="middle"><table width="200" border="1" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center" valign="middle"><b>'.$hasil.'</b></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td colspan="11">terima kasih atas partisipasi Bapak / Ibu Wali Murid dalam PPDB tahun ini, dan kami berdoa semoga ananda '.$nama.' dapat diterima di sekolah lain yang lebih baik.</td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Demikian surat pemberitahuan ini, atas bantuan dan kerjasamanya yang baik kami sampaikan terima kasih.</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Wasssalamu&#8217;alaikum warahmatullaahi Wabarakaatuh.</em></td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>'.$wakakesiswaan.'</strong></td>
				  </tr>
				</table>';
			} else {
				$generatetbl= '
				<table width="800" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
					<td colspan="8"><strong>'.$yayasan.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>'.$sekolah.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="8"><strong>PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">'.$alamat.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' - NSS : '.$rsetting->nss.' - NPSN : '.$rsetting->npsn.'</td>
				  </tr>
				  <tr>
					<td colspan="8" class="judul"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
				  </tr>
				  <tr>
					<td colspan="11" style="border-top:double">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="83">Nomor</td>
					<td width="14">:</td>
					<td colspan="9"><b>'.$nosurat.'</b></td>
				  </tr>
				  <tr>
					<td>Lamp.</td>
					<td>:</td>
					<td colspan="9"><b>1 Lembar</b></td>
				  </tr>
				  <tr>
					<td>Perihal</td>
					<td>:</td>
					<td colspan="9"><b>Pengumuman Hasil Observasi</b></td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Kepada Yth.</td>
				  </tr>
				  <tr>
					<td colspan="11"><b>Wali Murid Ananda '.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="11">Di tempat</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Assalamu&#8217;alaikum warahmatullaahi Wabarakaatuh</em></td>
				  </tr>
				  <tr>
					<td colspan="11">Berdasarkan hasil observasi kompetensi calon peserta didik baru '.$sekolah.' Kota Malang Tahun Pelajaran '.$tamasuk.', kami putuskan bahwa :</td>
				  </tr>
				  <tr>
					<td colspan="2">Nama</td>
					<td width="38">:</td>
					<td colspan="8"><b>'.$nama.'</b></td>
				  </tr>
				  <tr>
					<td colspan="2">No. Observasi</td>
					<td>:</td>
					<td colspan="8"><strong>'.$kodependaf.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="2">dinyatakan</td>
					<td>:</td>
					<td colspan="8">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11" align="center" valign="middle"><table width="200" border="1" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center" valign="middle"><b>SEBAGAI '.$hasil.'</b></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td colspan="11">kami berharap Bapak /  Ibu Wali Murid dapat bersabar menunggu pihak sekolah menghubungi Bapak /Ibu Wali Murid apabila ada calon siswa baru yang mengundurkan diri.</td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="11">Demikian surat pemberitahuan ini, atas bantuan dan kerjasamanya yang baik kami sampaikan terima kasih.</td>
				  </tr>
				  <tr>
					<td colspan="11"><em>Wasssalamu&#8217;alaikum warahmatullaahi Wabarakaatuh.</em></td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="6" align="center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Mengetahui,</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Kepala '.$sekolah.',</td>
					<td colspan="6" align="center">Ketua P2DB</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5">&nbsp;</td>
					<td colspan="6">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><strong>'.$kepalasekolah.'</strong></td>
					<td colspan="6" align="center"><strong>'.$wakakesiswaan.'</strong></td>
				  </tr>
				</table>';
			}
			
			$tahun					= date("Y");
			$tasks 					= [];
			$tasks['generatetbl']	= $generatetbl;
			$tasks['qrcode']		= $qrcode;
			$tasks['logo_grey']		= url('/').'/'.$logo_grey;
		
			return view('cetak.observasi', $tasks);
		}		
	}
	public function viewBiodatapsb($id){
		$homebase			= url("/");
		$getdata 			= $this->getAuthorizedPpdbRecord($id);
		if (!isset($getdata->id)){
			return view('errors.hilang');
		} else {
			$bulanlist 		= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
			$tgliki			= date("d");
			$mthiki 		= (int)date("m");
			$thniki 		= date("Y");
			$blniki 		= $bulanlist[$mthiki];
			$tanggalctk 	= $tgliki.' '.$blniki.' '.$thniki;
			$alamatcetak	= $homebase.'/biodatapsb/'.$id;
			$qrcode 		= QrCode::size(150)->generate($alamatcetak);
			$ketuapanitia	= '________________';
			$nik			= $getdata->nik;
			$kodependaf		= $getdata->kodependaf;
			$nama 			= $getdata->nama;
			$kelamin		= $getdata->kelamin;
			$tmplahir 		= $getdata->tmplahir;
			$tgllahir 		= $getdata->tgllahir;
			$umur 			= $getdata->umur;
			$darah			= $getdata->darah;
			$berat			= $getdata->berat;
			$tinggi 		= $getdata->tinggi;
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
			$n1				= $getdata->n1;
			$n2				= $getdata->n2;
			$n3				= $getdata->n3;
			$n4				= $getdata->n4;
			$n5				= $getdata->n5;
			$n6				= $getdata->n6;
			$n7				= $getdata->n7;
			$n8				= $getdata->n8;
			$n9				= $getdata->n9;
			$n10			= $getdata->n10;
			$n11			= $getdata->n11;
			$n12			= $getdata->n12;
			$n13			= $getdata->n13;
			$total			= $getdata->total;
			$rata			= $getdata->rata;
			$hasil			= $getdata->hasil;
			$nosurat		= $getdata->nosurat;
			$des1			= $getdata->des1;
			$des2			= $getdata->des2;
			$des3			= $getdata->des3;
			$des4			= $getdata->des4;
			$des5			= $getdata->des5;
			$des6			= $getdata->des6;
			$des7			= $getdata->des7;
			$deadline		= $getdata->deadline;
			$akhirumum		= $getdata->akhirumum;
			$seragam		= (int)$getdata->dana1;
			$gedung			= (int)$getdata->dana2;
			$spp			= (int)$getdata->dana3;
			$kegiatan		= $getdata->dana4;
			$rsetting		= Sekolah::where('id', $getdata->id_sekolah)->first();
			$sekolah 		= $rsetting->nama_sekolah;
			$yayasan 		= $rsetting->nama_yayasan;
			$alamat 		= $rsetting->alamat;
			$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
			$mutiara 		= $rsetting->slogan;
			$logo 			= $rsetting->logo;
			
			if ($wali != '') { $alamatwali = $alamatortu; }
			else { $alamatwali = ''; }

			$cekpelengkap	= Datapelengkappsb::where('niksiswa', $nik)->first();
			$scanakta		= $cekpelengkap->getPSBAkta->xfile ?? $homebase.'/dist/img/aktehilang.png';
			$scanfoto		= $cekpelengkap->getPSBFoto->xfile ?? $homebase.'/dist/img/fotohilang.png';
			$scankk			= $cekpelengkap->getPSBKK->xfile ?? $homebase.'/dist/img/kkhilang.png';
			$scanket		= $cekpelengkap->getPSBKet->xfile ?? $homebase.'/dist/img/kethilang.png';
			$scanbukti		= $cekpelengkap->getPSBBukti->xfile ?? $homebase.'/dist/img/buktihilang.png';
			if ($cekpelengkap->gayah == 'rangegaji1'){ 
				$tulisgajiayah = '&lt; Rp. 500.000,00'; 
			} else if ($cekpelengkap->gayah == 'rangegaji2'){ 
				$tulisgajiayah = 'Rp. 500.000,00 - Rp. 1.000.000,00'; 
			} else if ($cekpelengkap->gayah == 'rangegaji3'){ 
				$tulisgajiayah = 'Rp. 1.000.000,00 - Rp. 2.000.000,00';
			} else if ($cekpelengkap->gayah == 'rangegaji4'){ 
				$tulisgajiayah = '&gt; Rp. 2.000.000,00'; 
			} else {
				$tulisgajiayah	= '';
			}
			if ($cekpelengkap->gibu == 'rangegaji1'){ 
				$tulisgajiibu = '&lt; Rp. 500.000,00'; 
			} else if ($cekpelengkap->gibu == 'rangegaji2'){ 
				$tulisgajiibu = 'Rp. 500.000,00 - Rp. 1.000.000,00';
			} else if ($cekpelengkap->gibu == 'rangegaji3'){ 
				$tulisgajiibu = 'Rp. 1.000.000,00 - Rp. 2.000.000,00';
			} else if ($cekpelengkap->gibu == 'rangegaji4'){ 
				$tulisgajiibu = '&gt; Rp. 2.000.000,00'; 
			} else {
				$tulisgajiibu	= '';
			}
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
			$sql 					= Layanan::where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('layanan', 'ASC')->get();
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
			$generatetbl= '
				<table width="800" cellpadding="0" cellspacing="0" id="printiki">
					<tr>
						<td colspan="3" rowspan="6"><img src="'.$homebase.'/'.$logo.'" width="98" height="98" /></td>
						<td colspan="5">'.$yayasan.'</td>
						<td width="58">NO.</td>
						<td width="172" style="border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;text-align:center;vertical-align:middle;">'.$kodependaf.'</td>
					</tr>
					<tr>
						<td colspan="7">'.$sekolah.'</td>
					</tr>
					<tr>
						<td colspan="7">Terakreditasi A</td>
					</tr>
					<tr>
						<td colspan="7" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
					</tr>
					<tr>
						<td colspan="7">'.$alamat.'</td>
					</tr>
					<tr>
						<td colspan="7" style="color: #00F"><i>Telpon '.$rsetting->telp.' Email '.$rsetting->email.'</i></td>
					</tr>
					<tr>
						<td align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td width="51" align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td width="241" align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td width="26" align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td width="61" align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td align="left" valign="top" style="border-top:double">&nbsp;</td>
						<td align="left" valign="top" style="border-top:double">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="10" align="center"><strong>FORMULIR PENDAFTARAN SISWA BARU</strong></td>
					</tr>
					<tr>
						<td colspan="10" align="center"><strong>TAHUN PELAJARAN '.$tamasuk.'</strong></td>
					</tr>
					<tr>
						<td colspan="10" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="10"></td>
					</tr>
					<tr>
						<td colspan="10" style="background:#999; border-bottom:1px solid black;border-top:1px solid black;"><strong>DATA UMUM</strong></td>
					</tr>
					<tr>
						<td colspan="10"><b><u>A. IDENTITAS CALON SISWA :</u></b></td>
					</tr>
					<tr>
						<td width="27">1</td>
						<td colspan="9">Nama Peserta Didik</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">a.Lengkap (sesuai akta kelahiran)</td>
						<td width="7">:</td>
						<td colspan="5">'.$nama.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">b. Panggilan</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->panggilan.'</td>
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
						<td colspan="3">a. Tempat</td>
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
						<td colspan="3">Umur (per Juli $thniki)</td>
						<td>:</td>
						<td colspan="5">'.$umur.'</td>
					</tr>
					<tr>
						<td>6</td>
						<td colspan="3">Agama</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->agama.'</td>
					</tr>
					<tr>
						<td>7</td>
						<td colspan="3">Kewarganegaraan</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->warga.'</td>
					</tr>
					<tr>
						<td>8</td>
						<td colspan="3">Anak Ke</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->anakke.' Dengan Jumlah Saudara :</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">a. Kandung</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->kandung.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">b. Tiri</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->tiri.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">c. Angkat</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->angkat.'</td>
					</tr>
					<tr>
						<td>9</td>
						<td colspan="3">Bahasa Sehari-hari di keluarga</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->bahasa.'</td>
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
						<td colspan="3">a.Berat badan</td>
						<td>:</td>
						<td colspan="5">'.$berat.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">b.Tinggi badan</td>
						<td>:</td>
						<td colspan="5">'.$tinggi.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">c.Penyakit yang pernah di derita</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->penyakit.'</td>
					</tr>
					<tr>
						<td valign="top">11</td>
						<td colspan="3" valign="top">Alamat Rumah</td>
						<td valign="top">:</td>
						<td colspan="5" valign="top">RT. '.$erte.' RW. '.$erwe.' KELURAHAN '.$kelurahan.' KECAMATAN '.$kecamatan.' KOTA/KABUPATEN '.$kota.' KODEPOS '.$kodepos.'</td>
					</tr>
					<tr>
						<td>12</td>
						<td colspan="3">Telepon Rumah</td>
						<td>:</td>
						<td colspan="5">'.$telpon.'</td>
					</tr>
					<tr>
						<td>13</td>
						<td colspan="3">Bertempat tinggal bersama</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->bersama.'</td>
					</tr>
					<tr>
						<td>14</td>
						<td colspan="3">Jarak tempat tinggal ke sekolah</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->jarak.' km</td>
					</tr>
					<tr>
						<td colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="10"><b><u>B. PERKEMBANGAN PESERTA DIDIK</u></b></td>
					</tr>
					<tr>
						<td>1</td>
						<td colspan="9">Masuk menjadi Peserta didik baru tingkat I</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">a.Asal Sekolah</td>
						<td>:</td>
						<td colspan="5">'.$asal.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">b.Alamat Sekolah Sebelumnya</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->alamattk.'</td>
					</tr>
					<tr>
						<td>2</td>
						<td colspan="9">Pindahan dari sekolah lain</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">a.Nama sekolah asal</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->pindahasal.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">b.Dari tingkat</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->pindahkelas.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">c.Diterima tanggal</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->pindahtgl.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">d.Ditingkat</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->pindahkekls.'</td>
					</tr>
					<tr>
						<td>3</td>
						<td colspan="9">NILAI RATA-RATA  RAPOT SEMESTER 1-5</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">a. Semester 1</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->semester1.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">b. Semester 2</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->semester2.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">c. Semester 3</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->semester3.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">d. Semester 4</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->semester4.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">e. Semester 5</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->semester5.'</td>
					</tr>
					<tr>
						<td colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="10"><b><u>C. IDENTITAS ORANG TUA/WALI :</u></b></td>
					</tr>
					<tr>
						<td>1</td>
						<td colspan="9">Ayah</td>
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
						<td colspan="5">'.$cekpelengkap->payah.'</td>
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
						<td colspan="5">'.$cekpelengkap->aayah.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="9" style="color: #999">(diisi jika tidak serumah dengan calon siswa)</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->hayah.'</td>
					</tr>
					<tr>
						<td colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<td>2</td>
						<td colspan="9">Ibu</td>
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
						<td colspan="5">'.$cekpelengkap->pibu.'</td>
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
						<td colspan="5">'.$cekpelengkap->aaibu.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="9"><span style="color: #999">(diisi jika tidak serumah dengan calon siswa)</span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="3">f.No. Telpon / HP yang bisa dihubungi</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->hibu.'</td>
					</tr>
					<tr>
						<td colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<td>3</td>
						<td colspan="9">Wali Peserta Didik (jika mempunyai)</td>
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
						<td colspan="5">'.$cekpelengkap->hubwali.'</td>
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
						<td colspan="5">'.$cekpelengkap->agamawali.'</td>
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
						<td colspan="5">'.$cekpelengkap->hwali.'</td>
					</tr>
					<tr>
						<td colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="10" style="background:#999; border-bottom:1px solid black;border-top:1px solid black;"><strong>DATA KHUSUS CALON SISWA</strong></td>
					</tr>
					<tr>
						<td valign="top">1</td>
						<td colspan="3" valign="top">Kesulitan yang pernah dialami selama disekolah asal</td>
						<td valign="top">:</td>
						<td colspan="5" valign="top">'.$cekpelengkap->kesulitan.'</td>
					</tr>
					<tr>
						<td>2</td>
						<td colspan="3">Orang-orang yang tinggal bersama calon siswa</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->anggotarumah.'</td>
					</tr>
					<tr>
						<td>3</td>
						<td colspan="3">Kegiatan yang dapat dilakukan sendiri</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->kegiatansendiri.'</td>
					</tr>
					<tr>
						<td>4</td>
						<td colspan="3">Penglihatan</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->mata.'</td>
					</tr>
					<tr>
						<td>5</td>
						<td colspan="3">Pendengaran</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->telinga.'</td>
					</tr>
					<tr>
						<td>6</td>
						<td colspan="3">Penampilan</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->wajah.'</td>
					</tr>
					<tr>
						<td>7</td>
						<td colspan="3">Gaya belajar calon siswa (jika diketahui) </td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->gybljr.'</td>
					</tr>
					<tr>
						<td>8</td>
						<td colspan="3">Bakat khusus yang menonjol </td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->bakat.'</td>
					</tr>
					<tr>
						<td>9</td>
						<td colspan="3">Sumber Informasi</td>
						<td>:</td>
						<td colspan="5">'.$cekpelengkap->sumberinfo.'</td>
					</tr>
					<tr>
						<td>10</td>
						<td colspan="9">Prestasi yang pernah diraih selama di TK (dilengkapi dengan foto atau fotokopi piagam penghargaan):</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td width="27">a. </td>
						<td colspan="8">'.$cekpelengkap->prestasi1.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>b. </td>
						<td colspan="8">'.$cekpelengkap->prestasi2.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>c. </td>
						<td colspan="8">'.$cekpelengkap->prestasi3.'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>d. </td>
						<td colspan="8">'.$cekpelengkap->prestasi4.'</td>
					</tr>
					<tr>
						<td colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="10" style="font-size: x-small">Dimohon segera ke '.$sekolah.' untuk mengumpulkan persyaratan berupa :</td>
					</tr>
					<tr>
						<td style="font-size: x-small">1</td>
						<td colspan="6" style="font-size: x-small">Melampirkan fotocopy akta kelahiran dan fotocopy kartu keluarga</td>
						<td width="128" rowspan="4" style="border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;text-align:center;vertical-align:middle; "><img src="'.$scanfoto.'" width="98" height="120" /></td>
						<td colspan="2" style="text-align: center">'.config('global.kota').', '.$tanggalctk.'</td>
					</tr>
					<tr>
						<td style="font-size: x-small">2</td>
						<td colspan="6" style="font-size: x-small">Foto 4x6 sebanyak 2 lembar</td>
						<td colspan="2" style="text-align: center">Orang Tua / Wali</td>
					</tr>
					<tr>
						<td height="97" valign="top" style="font-size: x-small">3</td>
						<td colspan="6" style="font-size: x-small" valign="top">Bukti Bayar Formulir<br />Melampirkan fotocopy Raport dan Surat Pengantar dari Sekolah Asal</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="6" style="font-size: x-small">&nbsp;</td>
						<td colspan="2" align="center">'.$namaayah.'</td>
					</tr>
					<tr>
						<td colspan="10" >Lampiran 1 : Scan Akta <br /><img width="100%" src="'.$scanakta.'"/></td>
					</tr>
					<tr>
						<td colspan="10" >Lampiran 2 : Scan KK <br /><img width="100%" src="'.$scankk.'"/></td>
					</tr>
					<tr>
						<td colspan="10" >Lampiran 3 : Scan Keterangan <br /><img width="100%" src="'.$scanket.'"/></td>
					</tr>
					<tr>
						<td colspan="10" >Lampiran 4 : Scan Bukti Bayar <br /><img width="100%" src="'.$scanbukti.'"/></td>
					</tr>
				</table>';
			
			$tahun					= date("Y");
			$tasks 					= [];
			$tasks['generatetbl']	= $generatetbl;
			$tasks['qrcode']		= $qrcode;
			return view('cetak.observasi', $tasks);
		}		
	}
	public function viewKarpes ($id){
		$homebase			= url("/");
		$getdata 			= $this->getAuthorizedPpdbRecord($id);
		if (!isset($getdata->id)){
			return view('errors.hilang');
		} else {
			$alamatcetak		= $homebase.'/karpes/'.$id;
			$qrcode 			= QrCode::size(150)->generate($alamatcetak);
			$kepalasekolah  	= config('global.Title2');
			$yayasan  			= config('global.yayasan');
			$sekolah 			= config('global.sekolah');
			$alamat  			= config('global.alamat');
			$mutiara			= '';
			$logo 				= 'boxed-bg.jpg';
			$logo_grey			= 'boxed-bg.jpg';
			$rsetting			= Sekolah::where('id', session('sekolah_id_sekolah'));
			if (isset($rsetting->id)){
				$sekolah 			= $rsetting->nama_sekolah;
				$yayasan 			= $rsetting->nama_yayasan;
				$alamat 			= $rsetting->alamat;
				$logo_grey 			= $rsetting->logo_grey;
				if (isset($rsetting->kepala_sekolah->nama)){
					$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
				} else {
					$kepalasekolah 	= config('global.swandhananama');
				}
				$mutiara 			= $rsetting->slogan;
				$logo 				= $rsetting->logo;
			}
			
			$kodependaf			= $getdata->kodependaf;
			$nik				= $getdata->nik;
			$status				= $getdata->status;
			$cekpelengkap		= Datapelengkappsb::where('niksiswa', $nik)->first();
			if (isset($cekpelengkap->niksiswa)){
				$scanakta 	= $cekpelengkap->scanakta;
				$scanfoto	= $cekpelengkap->scanfoto;
				$scankk 	= $cekpelengkap->scankk;
				$scanket 	= $cekpelengkap->scanket;
				$telpon 	= $cekpelengkap->telpon;
			} else {
				$scanakta 	= '';
				$scanfoto	= '';
				$scankk 	= '';
				$scanket 	= '';
				$telpon 	= '';
			}

			$statppdb				= '';
			$kodebaru				= '';
			$kodepindahan 			= '';
			$hargaformulir 			= '';
			$namabank 				= '';
			$norek 					= '';
			$periodepsb				= '';
			$setspp1 				= '';
			$setspp2 				= '';
			$setspp3 				= '';
			$setdpp1 				= '';
			$setdpp2 				= '';
			$setdpp3 				= '';
			$sql 					= Layanan::where('id_sekolah',$id)->orderBy('layanan', 'ASC')->get();
			if (!empty($sql)){
				foreach ($sql as $rlayanan){
					$layanan 		= $rlayanan->layanan;
					if ($layanan == 'periodepsb') { $periodepsb = $rlayanan->status; }
					if ($layanan == 'ppdb') { $statppdb = $rlayanan->status; }
					if ($layanan == 'kodebaru') { $kodebaru = $rlayanan->status; }
					if ($layanan == 'kodepindahan') { $kodepindahan = $rlayanan->status; }
					if ($layanan == 'hargaformulir') { $hargaformulir = $rlayanan->status; }
					if ($layanan == 'namabank') { $namabank = $rlayanan->status; }
					if ($layanan == 'norek') { $norek = $rlayanan->status; }
					if ($layanan == 'spp1') { $setspp1 = $rlayanan->status; }
					if ($layanan == 'spp2') { $setspp2 = $rlayanan->status; }
					if ($layanan == 'spp3') { $setspp3 = $rlayanan->status; }
					if ($layanan == 'dpp1') { $setdpp1 = $rlayanan->status; }
					if ($layanan == 'dpp2') { $setdpp2 = $rlayanan->status; }
				}
			}
			$jadwalujian 			= '
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" style="background-color:#999"><strong>No</strong></td>
					<td align="center" style="background-color:#999"><strong>Ujian</strong></td>
					<td colspan="3" align="center" style="background-color:#999"><strong>Hari</strong></td>
					<td colspan="2" align="center" style="background-color:#999"><strong>Tanggal</strong></td>
					<td align="center" style="background-color:#999"><strong>Jam</strong></td>
					<td align="center" style="background-color:#999"><strong>Ruang</strong></td>
					<td align="center" style="background-color:#999"><strong>Materi</strong></td>
				</tr>
			
			';
			$bulanlist 	= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
			$nomer		= 1;
			$sql 		= Tesppdb::orderBy('tanggal', 'ASC')->get();
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
					$jadwalujian= $jadwalujian.'
						<tr>
							<td align="left">'.$nomer.'</td>
							<td align="left">'.$hasil->nama.'</td>
							<td colspan="3" align="left">'.$hasil->hari.'</td>
							<td colspan="2" align="left">'.$tlstgl.'</td>
							<td align="left">'.$hasil->jam.'</td>
							<td align="left">'.$hasil->ruang.'</td>
							<td align="left">'.$hasil->materi.'</td>
						</tr>';
					$nomer++;
				}
			}
			if ($getdata->kodepsb == 'baru'){
				$kodepsb = 'SISWA BARU';
			} else { $kodepsb = 'PINDAHAN'; }
			$jadwalujian			= $jadwalujian.'</table>';
			$tahun					= date("Y");
			$tasks 					= [];
			$tasks['logo_grey']		= $homebase.'/'.$logo_grey;
			$tasks['logo']			= $homebase.'/'.$logo;
			$tasks['yayasan']		= $yayasan;
			$tasks['sekolah']		= $sekolah;
			$tasks['alamat']		= $alamat;
			$tasks['periodepsb']	= $periodepsb;
			$tasks['kodepsb']		= $kodepsb;
			$tasks['kepalasekolah']	= $kepalasekolah;
			$tasks['datapsb']		= $getdata;
			$tasks['scanfoto']		= $scanfoto;				
			$tasks['tahun']			= $tahun;
			$tasks['status']		= $status;
			$tasks['qrcode']		= $qrcode;
			$tasks['jadwalujian']	= $jadwalujian;
			$tasks['logokecil']		= $homebase.'/'.$logo;
			return view('cetak.formkarpes', $tasks);
		}		
	}
	public function ppdb(Request $request) {
		$id = $request->input('id');
		$rsetting				= Sekolah::where('id', $id)->first();
		if(!$rsetting){
			return view('accessdenided');
		}
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
		$sql 					= Layanan::where('id_sekolah',$id)->orderBy('layanan', 'ASC')->get();
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
		$tasks['statppdb']		= $statppdb;
		$tasks['tahun']			= date("Y");
		$tasks['hargaformulir']	= $hargaformulir;
		$tasks['norek']			= $norek;
		$tasks['namabank']		= $namabank;
		$tasks['lvlsekolah']	= $rsetting->level;
		$tasks['sidebar']		= 'ppdb';
		return view('ppdb', $tasks);
    }
	public function exPpdb(Request $request) {
		$id_sekolah				= $request->id_sekolah;
		$homebase				= url("/");
		$setkerja				= $request->setkerja;
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
		$sql 					= Layanan::where('id_sekolah',$id_sekolah)->orderBy('layanan', 'ASC')->get();
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
		if ($setkerja == 'siswa'){
			$tahun		= $request->val01;
			$kelas		= $request->val02;
			$niksiswa	= $request->val03;
			$nama 		= strtoupper($request->val04);
			$panggilan	= strtoupper($request->val05);
			$tmtlahir	= strtoupper($request->val06);
			$tgllahir	= $request->val07;
			$umur		= $request->val08;
			$kelamin	= strtoupper($request->val09);
			$agama		= $request->val10;
			$warga		= $request->val11;
			$tinggi		= $request->val12;
			$berat		= $request->val13;
			$darah		= $request->val14;
			$bahasa		= $request->val15;
			$penyakit	= $request->val16;
			$anakke		= $request->val17;
			$kandung	= $request->val18;
			$tiri		= $request->val19;
			$angkat		= $request->val20;
			$jarak		= $request->val21;
			$telpon		= $request->val22;
			$bersama	= $request->val23;
			$buktiBayar	= $this->validatePpdbImageData($request->val24);
			$ceknik		= strlen($niksiswa);
			if ($ceknik != 16){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 NIK Haruslah 16 Karakter
					  </div>';
			} else if ($buktiBayar === false){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 Bukti pembayaran harus berupa file JPG atau PNG dengan ukuran maksimum 2MB
					  </div>';
			} else if ($nama == '' OR $tmtlahir == '' OR $anakke == '' OR $tgllahir == '' OR $niksiswa == '' OR $umur == '' OR $jarak == '' OR $telpon == ''){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						 Nama : '.$nama.'<br />
						 NIK. Siswa : '.$niksiswa.'<br />
						 TTL : '.$tmtlahir.'/'.$tgllahir.'<br />
						 Umur : '.$umur.'<br />
						 Anak Ke : '.$anakke.'<br />
						 Jarak dari Rumah Ke Sekolah : '.$jarak.'<br />
						 Email : '.$telpon.'<br />
					  </div>';
			} else {
				if ($panggilan == ''){ $panggilan = '-'; }
				if ($tinggi == ''){ $tinggi = '0'; }
				if ($tinggi == ''){ $tinggi = '0'; }
				if ($berat == ''){ $berat = '0'; }
				if ($darah == ''){ $darah = '-'; }
				if ($bahasa == ''){ $bahasa = 'INDONESIA'; }
				if ($penyakit == ''){ $penyakit = '-'; }
				$count = Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->count();				
				if ($count == 0) {
					$kodethn 	 	= substr($tahun, 0, 4);
					$urutanbaru		= Datapsb::where('tahun', $kodethn)->where('kodepsb', 'baru')->where('id_sekolah',$id_sekolah)->count();
					$urutanpindah	= Datapsb::where('tahun', $kodethn)->where('kodepsb', '!=', 'baru')->where('id_sekolah',$id_sekolah)->count();
					$getid 			= Datapsb::orderBy('id', 'DESC')->first();
					if (isset($getid->id)){
						$idne 		= $getid->id;
						$idne		= $idne + 1;
					} else {
						$idne		= 1;
					}
					
					if ($kelas == 1) { 
						$urutan  	= $urutanbaru + 1; 
						$kodependaf = $kodebaru.'-'.$urutan; 
						$kodepsb 	= 'baru';
					} else { 
						$urutan  	= $urutanpindah + 1; 
						$kodependaf = $kodepindahan.'-'.$urutan; 
						$kodepsb 	= 'mutasi kelas '.$kelas;
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode != 0){
						$urutan = $urutan + 1;
						if ($kelas == 1) { 
							$kodependaf = $kodebaru.'-'.$urutan; 
						}
						else { 
							$kodependaf = $kodepindahan.'-'.$urutan; 
						}
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode != 0){
						$urutan = $urutan + 1;
						if ($kelas == 1) { 
							$kodependaf = $kodebaru.'-'.$urutan; 
						}
						else { 
							$kodependaf = $kodepindahan.'-'.$urutan; 
						}
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode != 0){
						$urutan = $urutan + 1;
						if ($kelas == 1) { 
							$kodependaf = $kodebaru.'-'.$urutan; 
						}
						else { 
							$kodependaf = $kodepindahan.'-'.$urutan; 
						}
					}
					$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
					if ($rowcekkode == 0){
						$gooo = Datapsb::create([
							'tahun'			=> $kodethn, 
							'kodependaf'	=> $kodependaf, 
							'kodepsb'		=> $kodepsb, 
							'nama'			=> $nama, 
							'nik'			=> $niksiswa, 
							'kelamin'		=> $kelamin, 
							'tmplahir'		=> $tmtlahir, 
							'tgllahir'		=> $tgllahir, 
							'umur'			=> $umur, 
							'darah'			=> $darah, 
							'berat'			=> $berat, 
							'tinggi'		=> $tinggi, 
							'alamatortu'	=> '', 
							'namaayah'		=> '', 
							'namaibu'		=> '', 
							'kerjaayah'		=> '', 
							'kerjaibu'		=> '', 
							'wali'			=> '', 
							'pekerjaanwali'	=> '', 
							'foto'			=> '', 
							'tamasuk'		=> $tahun, 
							'hape'			=> '', 
							'asal'			=> '', 
							'mutasi'		=> '', 
							'kelurahan'		=> '', 
							'kecamatan'		=> '', 
							'kota'			=> '', 
							'kodepos'		=> '', 
							'telpon'		=> '', 
							'erte'			=> '', 
							'erwe'			=> '', 
							'n1'			=> '', 
							'n2'			=> '', 
							'n3'			=> '', 
							'n4'			=> '', 
							'n5'			=> '', 
							'n6'			=> '', 
							'n7'			=> '', 
							'n8'			=> '', 
							'n9'			=> '', 
							'n10'			=> '', 
							'n11'			=> '', 
							'n12'			=> '', 
							'n13'			=> '', 
							'total'			=> '', 
							'rata'			=> '', 
							'hasil'			=> '', 
							'deadline'		=> '', 
							'akhirumum'		=> '', 
							'nosurat'		=> '', 
							'des1'			=> '', 
							'des2'			=> '', 
							'des3'			=> '', 
							'des4'			=> '', 
							'des5'			=> '', 
							'des6'			=> '', 
							'des7'			=> '', 
							'des8'			=> '', 
							'dana1'			=> '', 
							'dana2'			=> '', 
							'dana3'			=> '', 
							'dana4'			=> '', 
							'status'		=> 10,
							'id_sekolah'    => $id_sekolah
						]);
						if ($gooo){
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $niksiswa.'-BuktiBayar',
								],
								[
									'xtabel'	=> 'db_psb',
									'xjenis'	=> $niksiswa,
									'xfile'		=> $buktiBayar
								]
							);
							$cekkelengkapan = Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->count();
							if ($cekkelengkapan == 0){
								Datapelengkappsb::create([
									'niksiswa'		=> $niksiswa, 
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'payah'			=> '',
									'pibu'			=> '',
									'gayah'			=> '',
									'gibu'			=> '',
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
									'gybljr'		=> '',
									'bakat'			=> '',
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
									'scanbukti'		=> $niksiswa.'-BuktiBayar',
									'id_sekolah'    => $id_sekolah
								]);
							} else {
								Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'marking'		=> $idne,
									'scanbukti'		=> $niksiswa.'-BuktiBayar',
								]);
							}							
							$this->storePpdbUploadAccess($id_sekolah, $niksiswa, $tgllahir);
							echo 'sukses';
						}
						else {
							echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
						  </div>';
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> '.$kodependaf.'</h4>
							Percobaan Permintaan Kode Pendaftaran Gagal 3x, mohon menghubungi admin PPDB untuk info lebih lanjut'.$urutanbaru.'/'.$id_sekolah.'/'.$kodethn.'
						  </div>';
					}
				} else {
					$status = '';
					$umume 	= '';
					$boleh 	= 'IYES';
					$idupdt	= 0;
					$jcek 	= Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->get();	
					foreach ($jcek as $cekid) {
						$kodep 	= $cekid->kodependaf;
						$umume 	= $cekid->akhirumum;
						$status = $cekid->status;
						if ($umume == ''){
							if ($status == 'verified' OR $status == 'unverified'){
								$boleh 	= 'NO';
							} else {
								$boleh 	= 'IYES';
								$idupdt = $cekid->id;
							}
						} else {
							$status	= $cekid->status;
							$idupdt = $cekid->id;
						}
					}
					if ($boleh == 'NO'){
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							 Data Anda Telah Ter Periksa, Mohon Bersabar Untuk Proses Seleksi dan Pengumuman.
						  </div>';
					} else if ($status == 'verified' OR $status == 'unverified'){
						$kodethn 	 	= substr($tahun, -4);
						$urutanbaru		= Datapsb::where('tahun', $kodethn)->where('kodepsb', 'baru')->where('id_sekolah',$id_sekolah)->count();
						$urutanpindah	= Datapsb::where('tahun', $kodethn)->where('kodepsb', '!=', 'baru')->where('id_sekolah',$id_sekolah)->count();
						$getid 			= Datapsb::orderBy('id', 'DESC')->where('id_sekolah',$id_sekolah)->first();
						if (isset($getid->id)){
							$idne 		= $getid->id;
							$idne		= $idne + 1;
						} else {
							$idne		= 1;
						}
						
						if ($kelas == 1) { 
							$urutan  	= $urutanbaru + 1; 
							$kodependaf = $kodebaru.'-'.$urutan; 
							$kodepsb 	= 'baru';}
						else { 
							$urutan  	= $urutanpindah + 1; 
							$kodependaf = $kodepindahan.'-'.$urutan; 
							$kodepsb 	= 'mutasi kelas '.$kelas;
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode != 0){
							$urutan = $urutan + 1;
							if ($kelas == 1) { 
								$kodependaf = $kodebaru.'-'.$urutan; 
							}
							else { 
								$kodependaf = $kodepindahan.'-'.$urutan; 
							}
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode != 0){
							$urutan = $urutan + 1;
							if ($kelas == 1) { 
								$kodependaf = $kodebaru.'-'.$urutan; 
							}
							else { 
								$kodependaf = $kodepindahan.'-'.$urutan; 
							}
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode != 0){
							$urutan = $urutan + 1;
							if ($kelas == 1) { 
								$kodependaf = $kodebaru.'-'.$urutan; 
							}
							else { 
								$kodependaf = $kodepindahan.'-'.$urutan; 
							}
						}
						$rowcekkode 	= Datapsb::where('kodependaf', $kodependaf)->where('id_sekolah',$id_sekolah)->count();
						if ($rowcekkode == 0){
							$gooo = Datapsb::create([
								'tahun'			=> $kodethn, 
								'kodependaf'	=> $kodependaf, 
								'kodepsb'		=> $kodepsb, 
								'nama'			=> $nama, 
								'nik'			=> $niksiswa, 
								'kelamin'		=> $kelamin, 
								'tmplahir'		=> $tmtlahir, 
								'tgllahir'		=> $tgllahir, 
								'umur'			=> $umur, 
								'darah'			=> $darah, 
								'berat'			=> $berat, 
								'tinggi'		=> $tinggi, 
								'alamatortu'	=> '', 
								'namaayah'		=> '', 
								'namaibu'		=> '', 
								'kerjaayah'		=> '', 
								'kerjaibu'		=> '', 
								'wali'			=> '', 
								'pekerjaanwali'	=> '', 
								'foto'			=> '', 
								'tamasuk'		=> $tahun, 
								'hape'			=> '', 
								'asal'			=> '', 
								'mutasi'		=> '', 
								'kelurahan'		=> '', 
								'kecamatan'		=> '', 
								'kota'			=> '', 
								'kodepos'		=> '', 
								'telpon'		=> '', 
								'erte'			=> '', 
								'erwe'			=> '', 
								'n1'			=> '', 
								'n2'			=> '', 
								'n3'			=> '', 
								'n4'			=> '', 
								'n5'			=> '', 
								'n6'			=> '', 
								'n7'			=> '', 
								'n8'			=> '', 
								'n9'			=> '', 
								'n10'			=> '', 
								'n11'			=> '', 
								'n12'			=> '', 
								'n13'			=> '', 
								'total'			=> '', 
								'rata'			=> '', 
								'hasil'			=> '', 
								'deadline'		=> '', 
								'akhirumum'		=> '', 
								'nosurat'		=> '', 
								'des1'			=> '', 
								'des2'			=> '', 
								'des3'			=> '', 
								'des4'			=> '', 
								'des5'			=> '', 
								'des6'			=> '', 
								'des7'			=> '', 
								'des8'			=> '', 
								'dana1'			=> '', 
								'dana2'			=> '', 
								'dana3'			=> '', 
								'dana4'			=> '', 
								'status'		=> 10,
								'id_sekolah'	=> $id_sekolah
							]);
							if ($gooo){
								XFiles::updateOrCreate(
									[
										'xmarking'	=> $niksiswa.'-BuktiBayar',
									],
									[
										'xtabel'	=> 'db_psb',
										'xjenis'	=> $niksiswa,
										'xfile'		=> $buktiBayar
									]
								);
								$cekkelengkapan = Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->count();
								if ($cekkelengkapan == 0){
									Datapelengkappsb::create([
										'niksiswa'		=> $niksiswa, 
										'panggilan'		=> $panggilan, 
										'umur'			=> $umur, 
										'agama'			=> $agama, 
										'warga'			=> $warga, 
										'bahasa'		=> $bahasa, 
										'penyakit'		=> $penyakit, 
										'anakke'		=> $anakke, 
										'kandung'		=> $kandung, 
										'tiri'			=> $tiri, 
										'angkat'		=> $angkat, 
										'jarak'			=> $jarak, 
										'telpon'		=> $telpon, 
										'bersama'		=> $bersama, 
										'payah'			=> '',
										'pibu'			=> '',
										'gayah'			=> '',
										'gibu'			=> '',
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
										'gybljr'		=> '',
										'bakat'			=> '',
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
										'scanbukti'		=> $niksiswa.'-BuktiBayar',
										'id_sekolah'	=> $id_sekolah
									]);
								} else {
									Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
										'panggilan'		=> $panggilan, 
										'umur'			=> $umur, 
										'agama'			=> $agama, 
										'warga'			=> $warga, 
										'bahasa'		=> $bahasa, 
										'penyakit'		=> $penyakit, 
										'anakke'		=> $anakke, 
										'kandung'		=> $kandung, 
										'tiri'			=> $tiri, 
										'angkat'		=> $angkat, 
										'jarak'			=> $jarak, 
										'telpon'		=> $telpon, 
										'bersama'		=> $bersama, 
										'marking'		=> $idne,
										'scanbukti'		=> $niksiswa.'-BuktiBayar',
									]);
								}							
								$this->storePpdbUploadAccess($id_sekolah, $niksiswa, $tgllahir);
								echo 'sukses';
							}
							else {
								echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
							  </div>';
							}
						} else {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error</h4>
								Percobaan Permintaan Kode Pendaftaran Gagal 3x, mohon menghubungi admin PPDB untuk info lebih lanjut
							  </div>';
						}
					} else {
						$qsimpandata = Datapsb::where('id', $idupdt)->update([
							'nama'			=> $nama, 
							'kelamin'		=> $kelamin, 
							'tmplahir'		=> $tmtlahir, 
							'tgllahir'		=> $tgllahir, 
							'umur'			=> $umur, 
							'darah'			=> $darah, 
							'berat'			=> $berat, 
							'tinggi'		=> $tinggi,
							'updated_at'	=> Carbon::now()
						]);
						if ($qsimpandata){
							XFiles::updateOrCreate(
								[
									'xmarking'	=> $niksiswa.'-BuktiBayar',
								],
								[
									'xtabel'	=> 'db_psb',
									'xjenis'	=> $niksiswa,
									'xfile'		=> $buktiBayar
								]
							);
							$cekkelengkapan = Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->count();
							if ($cekkelengkapan == 0){
								Datapelengkappsb::create([
									'niksiswa'		=> $niksiswa, 
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'payah'			=> '',
									'pibu'			=> '',
									'gayah'			=> '',
									'gibu'			=> '',
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
									'gybljr'		=> '',
									'bakat'			=> '',
									'sumberinfo'	=> '',
									'prestasi1'		=> '',
									'prestasi2'		=> '',
									'prestasi3'		=> '',
									'prestasi4'		=> '',
									'marking'		=> $idupdt,
									'scanakta'		=> '',
									'scanfoto'		=> '',
									'scankk'		=> '',
									'scanket'		=> '',
									'scanbukti'		=> $niksiswa.'-BuktiBayar',
									'id_sekolah'	=> $id_sekolah
								]);
							} else {
								Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
									'panggilan'		=> $panggilan, 
									'umur'			=> $umur, 
									'agama'			=> $agama, 
									'warga'			=> $warga, 
									'bahasa'		=> $bahasa, 
									'penyakit'		=> $penyakit, 
									'anakke'		=> $anakke, 
									'kandung'		=> $kandung, 
									'tiri'			=> $tiri, 
									'angkat'		=> $angkat, 
									'jarak'			=> $jarak, 
									'telpon'		=> $telpon, 
									'bersama'		=> $bersama, 
									'marking'		=> $idupdt,
									'scanbukti'		=> $niksiswa.'-BuktiBayar',
								]);
							}
							$this->storePpdbUploadAccess($id_sekolah, $niksiswa, $tgllahir);
							echo 'sukses';
						}
						else {
							echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
						  </div>';
						}
					}
				}
			}
		} else if ($setkerja == 'ortu'){
			$ayah		= strtoupper($request->val01);
			$ibu		= strtoupper($request->val02);
			$kayah		= $request->val03;
			$kibu		= $request->val04;
			$wali		= strtoupper($request->val05);
			$kwali		= $request->val06;
			$alamat		= strtoupper($request->val07);
			$erte		= strtoupper($request->val08);
			$erwe		= strtoupper($request->val09);
			$kelu		= strtoupper($request->val10);
			$keca		= strtoupper($request->val11);
			$kodepos	= strtoupper($request->val12);
			$kota		= strtoupper($request->val13);
			$payah		= $request->val14;
			$pibu		= $request->val15;
			$gayah		= $request->val16;
			$gibu		= $request->val17;
			$aayah		= $request->val18;
			$aibu		= $request->val19;
			$hayah		= $request->val20;
			$hibu		= $request->val21;
			$agamawali	= $request->val22;
			$hpwali		= $request->val23;
			$kwali		= $request->val24;
			$hubwali	= $request->val25;
			$niksiswa	= $request->val26;
			if($ayah == '' or $ibu == '' or $alamat == '' or $kelu == '' or $keca == ''){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						 Nama Ayah : '.$ayah.'<br />
						 Nama Ibu  : '.$ibu.'<br />
						 Alamat : '.$alamat.'<br />
						 Kelurahan : '.$kelu.'<br />
						 Kecamatan : '.$keca.'<br />
					  </div>';
			} else {
				$gooo = Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
					'alamatortu'	=> $alamat, 
					'namaayah'		=> $ayah, 
					'namaibu'		=> $ibu, 
					'kerjaayah'		=> $kayah, 
					'kerjaibu'		=> $kibu, 
					'wali'			=> $wali, 
					'pekerjaanwali'	=> $kwali, 
					'hape'			=> $hibu, 
					'kelurahan'		=> $kelu, 
					'kecamatan'		=> $keca, 
					'kota'			=> $kota, 
					'kodepos'		=> $kodepos, 
					'erte'			=> $erte, 
					'erwe'			=> $erwe,
					'updated_at'	=> Carbon::now()
				]);
				if ($gooo){
					Datapsb::where('nik', $niksiswa)->where('status', '10')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 20
					]);
					Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
						'payah'			=> $payah,
						'pibu'			=> $pibu,
						'gayah'			=> $gayah,
						'gibu'			=> $gibu,
						'aayah'			=> $aayah,
						'aaibu'			=> $aibu,
						'hayah'			=> $hayah,
						'hibu'			=> $hibu,
						'agamawali'		=> $agamawali,
						'hwali'			=> $hpwali,
						'kwali'			=> $kwali,
						'hubwali'		=> $hubwali,
					]);
					echo 'sukses';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Error</h4>
					 Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
				  </div>';
				}
			}
		} else if ($setkerja == 'asaltk'){
			$asala		= $request->val01;
			$almttk		= $request->val02;
			$pindahasal	= $request->val03;
			$pindahkls	= $request->val04;
			$pindahtgl	= $request->val05;
			$pindahkekls= $request->val06;
			$niksiswa	= $request->val07;
			$semester1	= $request->val08;
			$semester2	= $request->val09;
			$semester3	= $request->val10;
			$semester4	= $request->val11;
			$semester5	= $request->val12;
			if($asala == '' or $almttk == ''){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
						 Asal Sekolah Sebelumnya : '.$asala.'<br />
						 Alamat Sekolah Sebelumnya  : '.$almttk.'<br />
					  </div>';
			} else {
				$gooo = Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
					'asal'			=> $asala, 
					'mutasi'		=> $pindahasal,
					'updated_at'	=> Carbon::now()
				]);
				if ($gooo){
					Datapsb::where('nik', $niksiswa)->where('status', '20')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 30
					]);
					Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
						'alamattk'		=> $almttk,
						'pindahasal'	=> $pindahasal,
						'pindahkelas'	=> $pindahkls,
						'pindahtgl'		=> $pindahtgl,
						'pindahkekls'	=> $pindahkekls,
						'semester1'		=> $semester1,
						'semester2'		=> $semester2,
						'semester3'		=> $semester3,
						'semester4'		=> $semester4,
						'semester5'		=> $semester5,
					]);
					echo 'sukses';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
						</div>';
				}
			}
		} else {
			$kesulitan	= $request->val01;
			$bersamaly	= $request->val02;
			$kegsndrly	= $request->val03;
			$mata		= $request->val04;
			$telinga	= $request->val05;
			$wajah		= $request->val06;
			$gybljr		= $request->val07;
			$bakat		= $request->val08;
			$prestasi1	= $request->val09;
			$prestasi2	= $request->val10;
			$prestasi3	= $request->val11;
			$prestasi4	= $request->val12;
			$idsbrlain	= $request->val13;
			$niksiswa	= $request->val14;
			$arrbersama	= $request->val15;
			$arrkegiatan= $request->val16;
			$arrsumber	= $request->val17;
			if($niksiswa == ''){
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Error</h4>
					 Pastikan Semua Form Yang Bertanda Bintang di Bawah Sudah di Isi <br />
					 NIK. Siswa : '.$niksiswa.'<br />
				  </div>';
			} else {
				$anggotakeluarga = '';
				if (!empty($arrbersama)){
					foreach ($arrbersama as $v) {
						if ($v == 'Lain'){ 
							if ($anggotakeluarga == '') { $anggotakeluarga = $bersamaly; }
							else { $anggotakeluarga = $anggotakeluarga.'-'.$bersamaly; }
						} else {
							if ($anggotakeluarga == '') { $anggotakeluarga = $v; }
							else { $anggotakeluarga = $anggotakeluarga.'-'.$v; }
						}			
					}
				}
				$mandiri = '';
				if (!empty($arrkegiatan)){
					foreach ($arrkegiatan as $r) {
						if ($r == 'Lain'){ 
							if ($mandiri == '') { $mandiri = $kegsndrly; }
							else { $mandiri = $mandiri.'-'.$kegsndrly; }
						} else {
							if ($mandiri == '') { $mandiri = $r; }
							else { $mandiri = $mandiri.'-'.$r; }
						}			
					}
				}
				$sumberlain = '';
				if (!empty($arrsumber)){
					foreach ($arrsumber as $s) {
						if ($s == 'Lain'){ 
							if ($sumberlain == '') { $sumberlain = $idsbrlain; }
							else { $sumberlain = $sumberlain.'-'.$idsbrlain; }
						} else {
							if ($sumberlain == '') { $sumberlain = $s; }
							else { $sumberlain = $sumberlain.'-'.$s; }
						}			
					}
				}
				$gooo = Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
						'kesulitan'			=> $kesulitan,
						'anggotarumah'		=> $anggotakeluarga,
						'kegiatansendiri'	=> $mandiri,
						'mata'				=> $mata,
						'telinga'			=> $telinga,
						'wajah'				=> $wajah,
						'gybljr'			=> $gybljr,
						'bakat'				=> $bakat,
						'sumberinfo'		=> $sumberlain,
						'prestasi1'			=> $prestasi1,
						'prestasi2'			=> $prestasi2,
						'prestasi3'			=> $prestasi3,
						'prestasi4'			=> $prestasi4,
						'updated_at'		=> Carbon::now()
					]);
				if ($gooo){
					Datapsb::where('nik', $niksiswa)->where('status', '30')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 40
					]);
					$getdata = Datapsb::where('nik', $niksiswa)->orderBy('id', 'DESC')->where('id_sekolah',$id_sekolah)->first();
					echo '<div class="col-md-12">
							<div class="widget-user-header bg-yellow">
							  <div class="widget-user-image">
								<img class="img-circle" src="dist/img/wasimonghead.png" alt="User Avatar" height="90" width="100">
							  </div>
							  <h3 class="widget-user-username">'.$getdata->nama.'</h3>
							  <h3 class="widget-user-desc">'.$getdata->kodependaf.'</h3>
							</div>
							<div class="box-footer">
								<div class="box-body">
								 	<div class="form-group">
									  <ul class="nav nav-stacked">
										<li><span class="pull-left badge bg-red">1</span> '.$getdata->nik.'</li>  
										<li><span class="pull-left badge bg-blue">2</span> '.$getdata->tmplahir.', '.$getdata->tgllahir.'</li>
										<li><span class="pull-left badge bg-aqua">3</span> '.$getdata->namaayah.' / '.$getdata->namaibu.'</li>
										<li><span class="pull-left badge bg-green">4</span> '.$getdata->alamatortu.' Kel. '.$getdata->kelurahan.' Kec. '.$getdata->kecamatan.' '.$getdata->kota.'</li>
										<li><span class="pull-left badge bg-red">5</span> '.$getdata->asal.'</li>                    
									  </ul>
									  <b>Mohon Simpan No. ID Registrasi Anda, Dan Bila Anda Lupa Anda Dapat Meminta Informasi ID Registrasi Anak Anda ke Panitia PPDB.<br /> ID Registrasi Anak Anda Adalah :<br /></b>
									  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><font color="blue" size="+2">'.$getdata->kodependaf.'</font></p>
									</div>
								</div>
							</div>
						</div>'; 
				}
				else {
					echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error</h4>
							Sistem Gagal Terhubung Dengan Database, Silahkan Coba Beberapa Saat Lagi
						</div>';
				}
			}
		}
    }
	public function exSavefileppdb(Request $request) {
		$id_sekolah = $request->id_sekolah;
		$nik 		= $request->nik;
		$tgllahir	= $request->tgllahir;
		$akte 		= $request->akte;
		$foto 		= $request->foto;
		$ksk 		= $request->ksk;
		$keterangan	= $request->keterangan;
		$sukses 	= '';
		$aktaImage = $this->validatePpdbImageData($akte);
		$fotoImage = $this->validatePpdbImageData($foto);
		$kkImage = $this->validatePpdbImageData($ksk);
		$ketImage = $this->validatePpdbImageData($keterangan);
		if ($tgllahir == '' || !$this->hasPpdbUploadAccess($id_sekolah, $nik, $tgllahir)) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Akses Ditolak', 'message' => 'Sesi upload tidak valid. Silahkan verifikasi ulang NIK dan tanggal lahir.'], 403);
		}
		if ($aktaImage === false || $fotoImage === false || $kkImage === false || $ketImage === false) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'File Tidak Valid', 'message' => 'File harus berupa JPG atau PNG dengan ukuran maksimum 2MB.'], 422);
		}
		$ceknik 	= Datapsb::where('nik', $nik)->where('tgllahir', $tgllahir)->where('id_sekolah',$id_sekolah)->count();
		if ($ceknik != 0){
			if ($foto != ''){
				XFiles::updateOrCreate(
					[
						'xmarking'	=> $nik.'-Foto',
					],
					[
						'xtabel'	=> 'db_psb',
						'xjenis'	=> $nik,
						'xfile'		=> $fotoImage
					]
				);
				Datapsb::where('nik', $nik)->where('status', '40')->where('id_sekolah',$id_sekolah)->update([
					'status'		=> 60
				]);
				Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
					'scanfoto' => $nik.'-Foto'
				]);
				$sukses 		= $sukses.'Foto Berhasil di Upload<br />';
			}
			if ($akte != ''){
				XFiles::updateOrCreate(
					[
						'xmarking'	=> $nik.'-Akte',
					],
					[
						'xtabel'	=> 'db_psb',
						'xjenis'	=> $nik,
						'xfile'		=> $aktaImage
					]
				);
				Datapsb::where('nik', $nik)->where('status', '40')->where('id_sekolah',$id_sekolah)->update([
					'status'		=> 50
				]);
				Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
					'scanakta' => $nik.'-Akte'
				]);
				$sukses 		= $sukses.'Akte Berhasil di Upload<br />';
			}
			if ($ksk != ''){
				XFiles::updateOrCreate(
					[
						'xmarking'	=> $nik.'-KSK',
					],
					[
						'xtabel'	=> 'db_psb',
						'xjenis'	=> $nik,
						'xfile'		=> $kkImage
					]
				);
				Datapsb::where('nik', $nik)->where('status', '40')->where('id_sekolah',$id_sekolah)->update([
					'status'		=> 70
				]);
				Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
					'scankk' => $nik.'-KSK'
				]);
				$sukses 		= $sukses.'KSK Berhasil di Upload<br />';
			}
			if ($keterangan != ''){
				XFiles::updateOrCreate(
					[
						'xmarking'	=> $nik.'-SKL',
					],
					[
						'xtabel'	=> 'db_psb',
						'xjenis'	=> $nik,
						'xfile'		=> $ketImage
					]
				);
				Datapsb::where('nik', $nik)->where('status', '40')->where('id_sekolah',$id_sekolah)->update([
					'status'		=> 80
				]);
				Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
					'scanket' => $nik.'-SKL'
				]);
				$sukses 		= $sukses.'Surat Keterangan Lulus Berhasil di Upload<br />';
			}
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $sukses]);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk NIK ini.']);
			return back();	
		}
	}
	public function exCeknikppdb(Request $request) {
		$id_sekolah = $request->id_sekolah;
		$nik 		= $request->val01;
		$tgllahir	= $request->val02;
		$sukses 	= '';
		$ceknik 	= Datapsb::where('nik', $nik)->where('tgllahir', $tgllahir)->where('id_sekolah',$id_sekolah)->count();
		if ($ceknik != 0){
			$this->storePpdbUploadAccess($id_sekolah, $nik, $tgllahir);
			return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Data NIK dan TTL ditemukan']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk anak anda dan pastikan NIK dan Tgl. Lahir yang dimasukkan sesuai dengan : '.$nik.' dengan tanggal lahir '.$tgllahir ]);
			return back();	
		}
	}
	public function exGetkodependaf(Request $request) {
		$id_sekolah 		= $request->id_sekolah;
		$nik 		= $request->val01;
		$tgllahir	= $request->val02;
		if (!$this->hasPpdbUploadAccess($id_sekolah, $nik, $tgllahir)) {
			return response('forbidden', 403);
		}
		$getkode 	= Datapsb::where('nik', $nik)->where('tgllahir', $tgllahir)->where('id_sekolah',$id_sekolah)->orderBy('id', 'DESC')->first();
		if (isset($getkode->id)){
			echo $getkode->id;
		} else {
			echo 'notfound';
		}
	}
	public function exSaveberkasppdb(Request $request) {
		$id_sekolah = $request->id_sekolah;
		$nik 		= $request->val01;
		$jenis		= $request->val02;
		$tgllahir	= $request->val03;
		$file		= $request->file;
		$fileImage	= $this->validatePpdbImageData($file);
		if ($tgllahir == '' || !$this->hasPpdbUploadAccess($id_sekolah, $nik, $tgllahir)) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Akses Ditolak', 'message' => 'Sesi upload tidak valid. Silahkan verifikasi ulang NIK dan tanggal lahir.'], 403);
		}
		if ($fileImage === false) {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'File Tidak Valid', 'message' => 'File harus berupa JPG atau PNG dengan ukuran maksimum 2MB.'], 422);
		}
		$cekdata	= Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->count();
		if ($cekdata != 0){
			$getfotolama	= Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->first();
			if (isset($getfotolama->niksiswa)){
				$idpel			= $getfotolama->id;
				$idpsb			= $getfotolama->marking;
				$scanaktalm		= $getfotolama->scanakta;
				$scanfotolm		= $getfotolama->scanfoto;
				$scankklm		= $getfotolama->scankk;
				$scanketlm		= $getfotolama->scanket;
				$scanbuktilm	= $getfotolama->scanbukti;
				if ($jenis == 'AKTE'){
					XFiles::updateOrCreate(
						[
							'xmarking'	=> $nik.'-Akte',
						],
						[
							'xtabel'	=> 'db_psb',
							'xjenis'	=> $nik,
							'xfile'		=> $fileImage
						]
					);
					Datapelengkappsb::where('id', $getfotolama->id)->update([
						'scanakta' => $nik.'-Akte'
					]);
				} else if ($jenis == 'FOTO'){
					XFiles::updateOrCreate(
						[
							'xmarking'	=> $nik.'-Foto',
						],
						[
							'xtabel'	=> 'db_psb',
							'xjenis'	=> $nik,
							'xfile'		=> $fileImage
						]
					);
					Datapelengkappsb::where('id', $getfotolama->id)->update([
						'scanfoto' => $nik.'-Foto'
					]);
				} else if ($jenis == 'KK'){
					XFiles::updateOrCreate(
						[
							'xmarking'	=> $nik.'-KSK',
						],
						[
							'xtabel'	=> 'db_psb',
							'xjenis'	=> $nik,
							'xfile'		=> $fileImage
						]
					);
					Datapelengkappsb::where('id', $getfotolama->id)->update([
						'scankk' => $nik.'-KSK'
					]);
				} else if ($jenis == 'KET'){
					XFiles::updateOrCreate(
						[
							'xmarking'	=> $nik.'-SKL',
						],
						[
							'xtabel'	=> 'db_psb',
							'xjenis'	=> $nik,
							'xfile'		=> $fileImage
						]
					);
					Datapelengkappsb::where('id', $getfotolama->id)->update([
						'scanket' => $nik.'-SKL'
					]);
				} else {
					XFiles::updateOrCreate(
						[
							'xmarking'	=> $nik.'-BuktiBayar',
						],
						[
							'xtabel'	=> 'db_psb',
							'xjenis'	=> $nik,
							'xfile'		=> $fileImage
						]
					);
						Datapelengkappsb::where('id', $getfotolama->id)->update([
							'scanbukti' => $nik.'-BuktiBayar'
						]);
					}
				$cekstatus 		= Datapsb::where('nik', $nik)->where('id_sekolah',$id_sekolah)->orderBy('id', 'DESC')->first();
				$idne 			= $cekstatus->id;
				$status			= $cekstatus->status;
				$persen			= 40;
				if ($scanaktalm != ''){
					$persen 	= $persen + 10;
				}
				if ($scanfotolm != ''){
					$persen 	= $persen + 10;
				}
				if ($scankklm != ''){
					$persen 	= $persen + 10;
				}
				if ($scanketlm != ''){
					$persen 	= $persen + 10;
				}
				if ($scanbuktilm != ''){
					$persen 	= $persen + 10;
				}
				if ($status == '40' OR $status == '50' OR $status == '60' OR $status == '70' OR $status == '80' OR $status == '90'){
					Datapsb::where('id', $idne)->update([
						'status'		=> $persen
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Upload '.$jenis.' Berhasil']);
				return back();
				
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk anak anda dan pastikan NIK yang dimasukkan sesuai dengan : '.$nik ]);
				return back();	
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk anak anda dan pastikan NIK yang dimasukkan sesuai dengan : '.$nik ]);
			return back();	
		}
	}
	public function jsonDatacalonsiswa(Request $request) {
		$nik 		= $request->val01;
		$tgllahir	= $request->val02;
		$id_sekolah	= $request->id_sekolah;
		if (!$this->hasPpdbUploadAccess($id_sekolah, $nik, $tgllahir)) {
			return response()->json([], 403);
		}
		$scanakta	= '';
		$scanfoto	= '';
		$scankk		= '';
		$scanket	= '';
		$scanbukti	= '';
		$idpsb		= $nik;
		$idpel		= $nik;
		$getdata	= Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah', $id_sekolah)->first();
		if (isset($getdata->niksiswa)){
			$idpel			= $getdata->id;
			$idpsb			= $getdata->marking;
			$scanakta		= $getdata->getPSBAkta->xfile ?? '';
			$scanfoto		= $getdata->getPSBFoto->xfile ?? '';
			$scankk			= $getdata->getPSBKK->xfile ?? '';
			$scanket		= $getdata->getPSBKet->xfile ?? '';
			$scanbukti		= $getdata->getPSBBukti->xfile ?? '';
		}
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'AKTE',
			'deskripsi' 	=> 'Scan / Foto Akta Kelahiran, Kartu Keluarga dan KTP Orang Tua',
			'isine'			=> $scanakta
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'FOTO',
			'deskripsi' 	=> 'Scan / Foto Calon Siswa 4x6',
			'isine'			=> $scanfoto
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'KK',
			'deskripsi' 	=> 'Scan / Foto Slip Gaji Kedua Orang Tua',
			'isine'			=> $scankk
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'KET',
			'deskripsi' 	=> 'Scan / Foto Rapot Semester 1-5 dan Surat Kelakuan baik dari sekolah',
			'isine'			=> $scanket
		);
		$arraysurat[] = array(
			'idpsb' 		=> $idpsb,
			'nik' 			=> $nik,
			'idpelengkap' 	=> $idpel,	
			'jenis' 		=> 'BUKTI',
			'deskripsi' 	=> 'Scan Bukti Pembayaran',
			'isine'			=> $scanbukti
		);
		echo json_encode($arraysurat);
	}
	public function ctkLabelBuku($id){
		$data	=   Perpumini::where('id', $id)->first();
        $cetak 	= '<table width="100%" class="printiki" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="3" style="border-bottom-color: #000; border-bottom-style: double; border-bottom-width: thin;" valign="bottom"><br /><strong>'.$data->judul.'</td>
					</tr>
					<tr>
						<td valign="top">ISBN</td>
						<td valign="top">:</td>
						<td valign="top">'.$data->isbn.'</td>
					</tr>
					<tr>
						<td valign="top">Rak</td>
						<td valign="top">:</td>
						<td valign="top">'.$data->rakbuku.'</td>
					</tr>
					<tr>
						<td valign="top">Kode Buku</td>
						<td valign="top">:</td>
						<td valign="top">'.$data->kodebuku.'</td>
					</tr>
					<tr>
						<td valign="top">Pengarang</td>
						<td valign="top">:</td>
						<td valign="top">'.$data->pengarang.'</td>
					</tr>
					<tr>
						<td valign="top">Penerbit</td>
						<td valign="top">:</td>
						<td valign="top">'.$data->penerbit.'</td>
					</tr>
				</table>';
		$data['datatoprint'] = $cetak;
        return view('cetak.labelbuku', $data);
    }
	public function viewTabelBulan(Request $request) {
		$month 			= $request->month;
		$year 			= $request->year;
		$bentuk 		= $request->bentuk;
		if ($bentuk == 'kalender'){
			if ($month == 'latest') { $month =  date('m'); }
			$daysInMonth 	= Carbon::createFromDate($year, $month, 1)->daysInMonth;
			$startDate 		= Carbon::createFromDate($year, $month, 1)->startOfMonth()->startOfWeek();
			$dates 			= [];
			for ($day = 0; $day < $daysInMonth; $day++) {
				$date 			= $startDate->copy()->addDays($day)->format('Y-m-d');
				$count_kegiatan = RencanaKegiatan::where('mulai', $date)->count();
				$cekharilibur 	= DB::table('db_hariliburnasional')->where('tanggal', $date)->where('id_sekolah', Session('sekolah_id_sekolah'))->count();
				$dates[$date] 	= [
					'jumlah_kegiatan' 	=> $count_kegiatan,
					'is_holiday' 		=> $cekharilibur,
					'keterangan' 		=> ''
				];
			}
			$generatesurat 		= view('cetak.kalender', compact('month', 'year', 'dates', 'startDate'))->render();
			echo $generatesurat;
		} else if ($bentuk == 'listkalender'){
			if ($month == 'latest') { $month =  date('m'); }
			$daysInMonth 	= Carbon::createFromDate($year, $month, 1)->startOfMonth()->startOfWeek();

			$kegiatan 		= RencanaKegiatan::where('mulai', '>', $daysInMonth)->get();
			$harilibur 		= DB::table('db_hariliburnasional')->where('tanggal', '>', $daysInMonth)->where('id_sekolah', '!=', '3')->get();
			$result 		= [];
			foreach ($kegiatan as $item) {
				$result[] = [
					'mulai'				=> $item->mulai,
					'namakegiatan'		=> $item->namakegiatan,
					'penanggunggjawab'	=> $item->penanggunggjawab,
				];
			}
			foreach ($harilibur as $item) {
				$result[] = [
					'mulai'				=> $item->tanggal,
					'namakegiatan'		=> $item->namaharilibur,
					'penanggunggjawab'	=> '',
				];
			}
			if (!empty($result)) {
				usort($result, function($a, $b) {
					return strtotime($a['mulai']) - strtotime($b['mulai']);
				});
			}
			$generatesurat 	= view('cetak.kalenderkegiatan', compact('result'))->render();
			echo $generatesurat;
		} else if ($bentuk == 'hariliburnasional'){
			$sql 	= DB::table('db_hariliburnasional')->where('tanggal', 'LIKE', $year.'-%')->where('id_sekolah', Session('sekolah_id_sekolah'))->orderBy('tanggal', 'ASC')->groupBy('marking')->get();
			echo json_encode($sql);
		} else if ($bentuk == 'inputhariliburnasional'){
			$mulai 			= $request->val01;
			$akhir 			= $request->val02;
			$nama 			= $request->val03;
			$idne 			= $request->val04;
			if ($idne != 'new'){
				DB::table('db_hariliburnasional')->where('marking', $idne)->where('id_sekolah', Session('sekolah_id_sekolah'))->delete();
			}
			$marking		= $mulai.' s/d '.$akhir;
			try {
				DB::beginTransaction();
				if ($mulai == $akhir){
					DB::table('db_hariliburnasional')->insert([
						'tanggal'       => $mulai,
						'mulai'         => $mulai,
						'akhir'        	=> $akhir,
						'namaharilibur'	=> $nama,
						'marking'		=> $marking,
						'id_sekolah'   	=> Session('sekolah_id_sekolah'),
					]);
				} else if ($mulai < $akhir){
					while ($mulai <= $akhir) {
						DB::table('db_hariliburnasional')->insert([
							'tanggal'       => $mulai,
							'mulai'         => $mulai,
							'akhir'         => $akhir,
							'namaharilibur' => $nama,
							'marking'		=> $marking,
							'id_sekolah'    => Session('sekolah_id_sekolah'),
						]);
						$mulai = date('Y-m-d', strtotime($mulai . ' +1 day'));
					}
				} else {
					DB::table('db_hariliburnasional')->insert([
						'tanggal'       => $akhir,
						'mulai'         => $mulai,
						'akhir'        	=> $akhir,
						'namaharilibur'	=> $nama,
						'marking'		=> $marking,
						'id_sekolah'   	=> Session('sekolah_id_sekolah'),
					]);
				}
				DB::commit();
				echo 'Data Success';
			} catch (\Exception $e) {
				DB::rollback();
				$pesan = $e->getMessage();
				echo $pesan; 
			}
		}
		
	}
}
