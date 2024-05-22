<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
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
use App\Blogdata;
use App\Blogkomendata;
use App\Pembayaran;
use App\Ekstrakulikuler;
use App\Suratkeluar;
use App\ProgramPIP;
use App\AbsenProgramPIP;
use App\HPTKeuangan;
use App\Inboxsurat;
use App\Suratmasuk;
use App\Disposisi;
use App\Suratkeluartnpnomor;
use App\Macamdisposisi;
use App\Filess;
use App\Histories;
use App\Detailpegawai;
use App\Banksoalujian;
use App\Insidental;
use App\Penerimasurat;
use App\Formulirpsb;
use Carbon\Carbon;
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

class FrontpageController extends Controller
{
	protected static function genSurat($id, $tabel){
		$homebase 	= url("/");
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
				$qrcode 					= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
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
				$kopsurat			= '<img src="'.$homebase.'/'.$kopsurat.'" width="100%" />';
			}
			$cekdata		= Rapotan::where('id', $id)->first();
			if (isset($cekdata->id)){
				$tasks['titel']			= 'Rapot Ananda '.$cekdata->nama.' TA '.$cekdata->tapel.' Semester '.$cekdata->semester;
				$tasks['background']	= $homebase.'/'.$logo_grey;
				$tasks['logo']			= $homebase.'/'.$logo;
				$tasks['kopsurat']		= $kopsurat;
				$tasks['sekolah']		= $sekolah;
				$tasks['alamat']		= $alamat;
				$tasks['rapot']			= Rapotan::where('id', $cekdata->id)->first();
				return view('cetak.rapot', $tasks);
			} else {
				$data['generatetbl']  = '<img src="'.url('/').'/dist/img/takadagambar.jpg" />';
				return view('cetak.suratgenerator', $data);
			}
		}
    }
    public function index() {
		$data 		= [];
		$tahun		= date("Y");
		$urutanwerno= array('red','green','blue','yellow','navy','teal','orange','maroon','black','aqua');
		$urutanbg	= array('primary','success','warning','info','danger','secondary','primary','success','warning','info');
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
		return view('simaster.index', $data);
    }
	public function FrontPageindex(Request $request) {
		$data			= [];
		$id 			= $request->input('id');
		$firebaseid 	= $request->input('firebaseid');
		$sql 			= Sekolah::where('id', $id)->first();
		if(!$sql){
			return view('accessdenided');
		}
		$previlage  =  Session('previlage');
		if ($firebaseid == null OR $firebaseid == ''){
			$ceksek = explode("?firebaseid=", $id);
			if (isset($ceksek[1])){
				$firebaseid = $ceksek[1];
			}
		}
        if ($previlage != '') {
			return redirect('dashbord');
        } else {
			if ($firebaseid != '' AND $firebaseid !== null){
				$user  	= User::where('firebaseid', $firebaseid)->first();
			} else {
				$user 	= null;
			}
			if (isset($user->previlage)){
				Auth::login($user);
				$previlage 			= $user->previlage;
				$idsekolah 			= $user->id_sekolah;
				$idne 				= $user->id;
				$fakultas 			= $user->fakultas;
				session(['id' 		=> $user->id]);
				session(['nama' 	=> $user->nama]);
				session(['username' => $user->username]);
				session(['previlage'=> $previlage]);
				session(['fakultas' => $fakultas]);
				session(['nip'		=> $user->nip]);
				session(['spesial' 	=> $user->spesial]);
				$sql = Sekolah::where('id', $idsekolah)->first();
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
				$profile 				= '';
				$visimisi 				= '';
				$strukturorganisasi 	= '';
				$pendidik 				= '';
				$jadwal 				= '';
				$kontak 				= '';
				$sertamerta 			= '';
				$setiapsaat 			= '';
				$pengumuman 			= '';
				$getdata 				= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id)->get();
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
				$data['id_sekolah']			= $id;
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
        }
	}
	//Chatting
	public function chatGetlist(Request $request) {
		$idevent		= $request->input('val02');
		
		$kelompok	= Session('previlage');
		$nmlengkap	= Session('nama');
		if (Session('sekolah_id_sekolah') !== null){
			$idsekolah 	= Session('sekolah_id_sekolah');
			$logo 		= url("/").'/'.Session('sekolah_logo');
		} else {
			$idsekolah	= Session('fakultas');
			$logo 		= Session('avatar');
		}
		$isipesan		= '';
		$getdata 		= User::where('username', Session('username'))->first();
		if (isset($getdata->id)){
			$klsajar 	= $getdata->klsajar;
		} else { $klsajar = ''; }
	    if ($klsajar == 'test'){
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
				if (Session('theme01') == 'Vuexy'){
					if ($nama == $nmlengkap){
						echo 	'<div class="chat"><div class="chat-avatar"><span class="avatar box-shadow-1 cursor-pointer"><img src="'.$gravatar1.'" alt="avatar" height="36" width="36" /></span></div><div class="chat-body"><div class="chat-content">'.$pesan.'</div></div></div>';
					} else {
						echo 	'<div class="chat chat-left"><div class="chat-avatar"><span class="avatar box-shadow-1 cursor-pointer"><img src="'.$gravatar2.'" alt="avatar" height="36" width="36" /></span></div><div class="chat-body"><div class="chat-content">'.$pesan.'</div></div></div>';
					}
				} else {
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
    }
	public function cattingSurat(Request $request) {
		$kelompok	= Session('previlage');
		$nmlengkap	= Session('nama');
		$pesan		= $request->input('val01');
		$idevent	= $request->input('idevent');
		$logo		= '';
		$getdata 	= User::where('username', Session('username'))->first();
		if (isset($getdata->id)){
			$klsajar 	= $getdata->klsajar;
		} else { $klsajar = ''; }
		if ($idevent == '' OR $idevent == '0' OR $idevent == null){
			if (Session('sekolah_id_sekolah') !== null){
				$idsekolah 	= Session('sekolah_id_sekolah');
			} else {
				$idsekolah	= Session('fakultas');
			}
		} else {
			$idsekolah 	= $idevent;
			$logo 		= $request->input('val03');
		}
		if ($logo == ''){
			if (Session('avatar') !== null){
				$gravatar	= Session('avatar');
			} else if (Session('sekolah_logo') !== null){
				$gravatar	= url("/").'/'.Session('sekolah_logo');
			} else {
				$gravatar	= url('/duidev-softwarehouse.png');
			}
		} else {
			$gravatar		= $logo;
		}
		if ($pesan != ''){
			$pesan			= str_replace(':)', '&#128522;', $pesan);
			$pesan			= str_replace('T_T', '&#128557;', $pesan);
			$pesan			= str_replace('>.<', '&#128518;', $pesan);
			$pesan			= str_replace('^_v', '&#128540;', $pesan);
			$pesan			= str_replace('<', '&#60;', $pesan);
			$pesan			= str_replace('>', '&#62;', $pesan);
			$pesan			= str_replace('"', '&#34;', $pesan);
			$pesan			= str_replace('#', '&#35;', $pesan);
			$pesan			= str_replace('$', '&#36;', $pesan);
			$pesan			= str_replace('%', '&#37;', $pesan);
			$pesan			= str_replace('&', '&#38;', $pesan);
			$pesan			= str_replace('+', '&#43;', $pesan);
			$pesan			= str_replace('@', '&#64;', $pesan);
			$pesan			= str_replace('?', '&#63;', $pesan);
			$pesan			= str_replace('^', '&#94;', $pesan);
			$pesan			= str_replace('{', '&#123;', $pesan);
			$pesan			= str_replace('}', '&#125;', $pesan);
			$pesan			= str_replace('`', '&#96;', $pesan);
			$pesan			= str_replace("'", "&#39;", $pesan);
			$pesan			= str_replace("(", "&#40;", $pesan);
			$pesan			= str_replace(")", "&#41;", $pesan);
			if ($klsajar == 'test'){
			} else {
				$input = Chatting::insert([
					'kelompok'  	=>  $kelompok,
					'nama'  		=>  $nmlengkap,
					'pesannya'		=>  $pesan,
					'ket'			=>  $gravatar,
					'id_sekolah'	=>	$idsekolah
				]);
				event(new \App\Events\NotifController('Pesan dari '.$nmlengkap.': '.$pesan));
			}
		}
		
		$logo 		= url("/").'/'.Session('sekolah_logo');
		$isipesan	= '';
		if ($klsajar == 'test'){
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
			if (Session('fakultas') == 'iwis'){
				echo '<table class="table align-items-center mb-0"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Chatting Yet</th></tr></thead></table>';
			}
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
		} else {
			$verifikasi	= '';
			$kirim 		= 'Belum di Verifikasi';
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
		$sql 		= Pembayaran::where('marking', $marking)->where('id_sekolah',session('sekolah_id_sekolah'))->get();
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
		$qrcode 					= base64_encode(QrCode::format('png')->size(100)->generate($alamatcetak));
		
		$tulisan					= number_format( $total , 0 , '.' , ',' );
		$y 							= $x.' rupiah';
		$tulis 						= 'Digenerate Tgl. '.$tanggalctk.' Oleh '.Session('nama').' Kwitansi Pembayaran ananda '.$nama.' Kelas '.$kelas.' Untuk '.$tlsbulan.' Sejumlah '.$tulisan;
		Pembayaran::where('marking', $marking)->update([
			'kirim' 		=> $tulis,
			'updated_at'	=> date("Y-m-d H:i:s")
		]);
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
				$qrcode 		= QrCode::size(150)->generate($alamatweb);
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
											<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="{{ $logo }}" width="98" height="75" /></td>
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
				$qrcode 		= QrCode::size(150)->generate($alamatcetak);
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
		if (file_exists(public_path('kwitansi/'.$id.'.pdf'))){
			$file =  public_path('kwitansi/'.$id.'.pdf');
			return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
		} else {
			$homebase	= url("/");
			$domain		= str_replace('https://', '', $homebase);
			$info = array(
				'Name' 			=> 'DuiDev Software Hose',
				'Location' 		=> 'Malang East Java',
				'Reason' 		=> 'Dokumen ini ditandatangani secara elektronik',
				'ContactInfo' 	=> $domain,
			);
			
			$certificate= 'file://'.base_path().'/public/sco.crt';
			$getdata 	= HPTKeuangan::where('id', $id)->first();
			if (isset($getdata->id)){
				$idne 		= $getdata->id;
				$deskripsi 	= $getdata->deskripsi;
				$pemasukan 	= $getdata->pemasukan;
				$pengeluaran= $getdata->pengeluaran;
				$bendahara 	= $getdata->bendahara;
				$tglkwitansi= $getdata->tglkwitansi;
				$tandatangan= $getdata->tandatangan;
				$id_sekolah	= $getdata->id_sekolah;
				$jenis		= $getdata->jenis;
				$email 		= $id.'@'.$domain;
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
					$imageInfo 		= explode(";base64,", $getdata->tandatangan);
					$imgExt 		= str_replace('data:image/', '', $imageInfo[0]);      
					$image 			= str_replace(' ', '+', $imageInfo[1]);
					$imageName 		= "post-".time().".".$imgExt;
					Storage::disk('local')->put('/scan/generate/'.$imageName, base64_decode($image));
					$tandatangan 	= '<img src="'.$homebase.'/scan/generate/'.$imageName.'" width="100">';
					$nippjbt		= md5($bendahara);
					$ceksertifikatpribadi 	= $nippjbt.'.crt';
					$sertifikatpribadi 		= $nippjbt.'.csr';
					if (file_exists(public_path('tte/'.$ceksertifikatpribadi))){
						$certificate 	= 'file://'.base_path().'/public/tte/'.$ceksertifikatpribadi;
					} else {
						$dn = array(
							"countryName" 			=> "IN",
							"stateOrProvinceName" 	=> "East Java Indonesia",
							"localityName" 			=> "Malang",
							"organizationName" 		=> "CV SWANDHANA",
							"organizationalUnitName"=> "Duidev Software House",
							"commonName" 			=> $bendahara,
							"emailAddress" 			=> "swandhana17@gmail.com"
						);
						$privkey = openssl_pkey_new(array(
							"private_key_bits" => 2048,
							"private_key_type" => OPENSSL_KEYTYPE_RSA,
						));
						$csr = openssl_csr_new($dn, $privkey, array('digest_alg' => 'sha256'));
						$sscert = openssl_csr_sign($csr, null, $privkey, $days=365, array('digest_alg' => 'sha256'));
						openssl_csr_export($csr, $csrout);
						openssl_x509_export($sscert, $certout);
						openssl_pkey_export($privkey, $pkeyout);
						file_put_contents(base_path()."/public/tte/".$nippjbt.".crt", $pkeyout);
						file_put_contents(base_path()."/public/tte/".$nippjbt.".crt", $certout, FILE_APPEND | LOCK_EX);
					}
					$certificate 				= $nippjbt.'.crt';
					if (file_exists(public_path('tte/'.$certificate))){
						$certificate 			= 'file://'.base_path().'/public/tte/'.$nippjbt.'.crt';
					}
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
					$sekolah 		= Session('namaapps01');
					$yayasan 		= Session('domainapps01');
					$alamat 		= Session('addressapps01');
					$kepalasekolah 	= Session('subsubdomainapps01');
					$mutiara 		= Session('lamanapps01');
					$logo 			= Session('logofrontapps01');
					$logogrey 		= $homebase.'/boxed-bg.jpg';	
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
								<td width="350" colspan="3" rowspan="5" align="center">&nbsp;<br /><img src="'.$logo.'" width="150"/></td>
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
									<td width="350" colspan="3" rowspan="5" align="center">&nbsp;<br /><img src="'.$logo.'" width="150"/></td>
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
									<td colspan="4" width="200"><strong>TERIMA DARI</strong></td>
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
				}
				$page_format 		= array(
					'MediaBox' 	=> array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 200),
					'Dur' 		=> 3,
					'PZ' 		=> 1,
				);
				PDFCREATOR::setSignature($certificate, $certificate, $id, '', 2, $info, 'A');
				PDFCREATOR::SetCreator($sekolah);
				PDFCREATOR::SetAuthor(Session('nama'));
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
				$imageName 	=  'scan/generate/'.$imageName;
				Storage::disk('local')->delete($imageName);
				if ($getdata->tandatangan == '' OR is_null($getdata->tandatangan)){
					Storage::disk('local')->put('/scan/generate/Kwitansi-'.$idne.'.pdf', $pdfdoc);
					$file 		= public_path('scan/generate/Kwitansi-'.$idne.'.pdf');
				} else {
					Storage::disk('local')->put('/kwitansi/'.$idne.'.pdf', $pdfdoc);
					$file 		= public_path('kwitansi/'.$idne.'.pdf');
				}
				return response(file_get_contents($file),200)->header('Content-Type','application/pdf');
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
			$tandatangan= $getdata->tandatangan;
			$jenis		= $getdata->jenis;
			$tanggal 	= $dd;
			$bulan 		= $mm;
			$tahun 		= $tahuniki;	
			if ($jenis == 'operasional') { $tulisanne = 'BUKU OPERASIONAL RUTIN'; }
			elseif ($jenis == 'spp') { $tulisanne = 'BUKU KEUANGAN PEMBAYARAN SPP'; }
			elseif ($jenis == 'dpp') { $tulisanne = 'BUKU KEUANGAN DANA PEMBANGUNAN'; }
			elseif ($jenis == 'bos') { $tulisanne = 'BUKU KEUANGAN DANA BOS'; }
			elseif ($jenis == 'pajak') { $tulisanne = 'BUKU KEUANGAN PAJAK'; }
			elseif ($jenis == 'nonopsrutin') { $tulisanne = 'BUKU NON OPERASIONAL RUTIN '; }
			elseif ($jenis == 'lainlain') { $tulisanne = 'BUKU KEUANGAN LAIN-LAIN '; }
			else {$tulisanne = 'BUKU '.strtoupper($jenis); }
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
										<td colspan="8" style="border-bottom:dotted">: '.$deskripsi.'</td>
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
	public function viewTrackingbyid($id) {
		$arrbulan 		= array("Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$urutanwerno	= array('red','green','blue','black','navy','teal','orange','maroon','black','aqua');
		$trackingcode 	= $id;
		$data 			= [];
		$domain 		= parse_url(request()->root())['host'];
		$cekteks 		= explode("/", $domain);
		if (isset($cekteks[1])){
			$domain	= $cekteks[0];
		}
		$getdomainid 		= DB::table('app_menu')->where('domain', $domain)->first();
		if (isset($getdomainid->id)){
			$ceklaman 					= $getdomainid->sequence;
			if ($ceklaman == 2){
				$lamanportal			= $getdomainid->route.$getdomainid->created_by.$getdomainid->updated_at;
			} else if ($ceklaman == 1){
				$lamanportal			= $getdomainid->route.$getdomainid->updated_at;
			} else {
				$lamanportal			= $getdomainid->route;
			}
			$fakpanjang 				= $getdomainid->subsubdomainapps;
			$data['namaapps01']  		= $getdomainid->name;
			$data['domainapps01']  		= $getdomainid->domainapps;
			$data['subdomainapps01']  	= $getdomainid->subdomainapps;
			$data['subsubdomainapps01'] = $getdomainid->subsubdomainapps;
			$data['addressapps01']  	= $getdomainid->addressapps;
			$data['emailapps01']  		= $getdomainid->emailapps;
			$data['lamanapps01']  		= $lamanportal;
			$data['logofrontapps01']  	= $getdomainid->logofrontapps;
			$data['logo01']  			= $getdomainid->icon;
		} else {
			$data['namaapps01']  		= config('global.Title2');
			$data['domainapps01']  		= config('global.yayasan');
			$data['subdomainapps01']  	= config('global.singkatan');
			$data['subsubdomainapps01']	= config('global.sekolah');
			$data['addressapps01']  	= config('global.alamat');
			$data['emailapps01']  		= config('global.email');
			$data['lamanapps01']  		= config('global.homeweb');
			$data['logofrontapps01']  	= config('global.logosimaster');
			$data['logo01']  			= $homebase.'/'.config('global.logoapss');
			$subdomainapps				= config('global.singkatan');
			$subsubdomainapps			= config('global.sekolah');
			$fakpanjang					= $subsubdomainapps;
		}
		$cekjenis		= explode('-', $trackingcode);
		$homebase		= url("/");
		if (isset($cekjenis[1])){
			$jenis 		= $cekjenis[0];
			$idne 		= $cekjenis[1];
			if ($jenis == 'srtmsk'){
				$marking 	= str_replace("srtmsk-", "", $id);
				$cekdata	= Suratmasuk::where('marking', $marking)->count();
				if ($cekdata != 0){
					$datadiri	= Suratmasuk::where('marking', $marking)->first();
					$sql		= Inboxsurat::where('marking', $marking)->get();
						$x = 0;
						$y = 0;
						if (!empty($sql)){
							foreach ($sql as $rowpeng) {
								$pemberi        = $rowpeng->pengirim;
								$kepada     	= $rowpeng->penerima;
								if ($kepada != 'Kotak Sampah'){
									$isidisposisi   = substr($rowpeng->catatan, 0, 30) . '...';
								} else {
									$isidisposisi   = $rowpeng->catatan;
								}
								$created_at     = $rowpeng->created_at;
								$kapan        	= SendMail::timeago($created_at);
								$updatenya     	= $rowpeng->updated_at;
								$updatenya      = SendMail::timeago($updatenya);
								$iconne			= 'fa-hand-o-down';
								$dipsosisi		= 'Memberikan Disposisi kepada :<br />'.$kepada.'<br />'.$isidisposisi;
								$data['pengumumans'][$x]['tanggal']     =   $created_at;
								$data['pengumumans'][$x]['kapan']       =   $kapan;
								$data['pengumumans'][$x]['jencolor']    =   $urutanwerno[$y];
								$data['pengumumans'][$x]['siapa']       =   $pemberi;
								$data['pengumumans'][$x]['pengumuman']  =   $dipsosisi;
								$data['pengumumans'][$x]['icon']        =   $iconne;
								$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
								if ($y == 9) {
									$y = 0; 
								} else {
									$y++; 
								}
								$x++;
							}
						}
						$data['datadiri']		= [];
						return view('errors.trackdisposisi', $data);
				} else {
					$cekdata	= Inboxsurat::where('marking', $marking)->count();
					if ($cekdata == 0){
						$data['judulpesan']			= 'Unkown Errors';
						$data['kalimatheader']		= 'Marking '.$marking.' Tidak di Temukan';
						$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
						return view('errors.pesanerror', $data);
					} else {
						$sql	= Inboxsurat::where('marking', $marking)->get();
						$x = 0;
						$y = 0;
						if (!empty($sql)){
							foreach ($sql as $rowpeng) {
								$pemberi        = $rowpeng->pengirim;
								$kepada     	= $rowpeng->penerima;
								if ($kepada != 'Kotak Sampah'){
									$isidisposisi   = substr($rowpeng->catatan, 0, 30) . '...';
								} else {
									$isidisposisi   = $rowpeng->catatan;
								}
								$created_at     = $rowpeng->created_at;
								$kapan        	= SendMail::timeago($created_at);
								$updatenya     	= $rowpeng->updated_at;
								$updatenya      = SendMail::timeago($updatenya);
								$iconne			= 'fa-hand-o-down';
								$dipsosisi		= 'Memberikan Disposisi kepada :<br />'.$kepada.'<br />'.$isidisposisi;
								$data['pengumumans'][$x]['tanggal']     =   $created_at;
								$data['pengumumans'][$x]['kapan']       =   $kapan;
								$data['pengumumans'][$x]['jencolor']    =   $urutanwerno[$y];
								$data['pengumumans'][$x]['siapa']       =   $pemberi;
								$data['pengumumans'][$x]['pengumuman']  =   $dipsosisi;
								$data['pengumumans'][$x]['icon']        =   $iconne;
								$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
								if ($y == 9) {
									$y = 0; 
								} else {
									$y++; 
								}
								$x++;
							}
						}
						$data['datadiri']		= [];
						return view('errors.trackdisposisi', $data);
					}
				}
			} else if ($jenis == 'srtklr'){
				$marking 	= str_replace("srtklr-", "", $id);
				$marking 	= str_replace(".pdf", "", $marking);
				$datadiri	= [];
				$cekapaid 	= explode('-', $marking);
				if ($cekapaid[0] == 'keluar'){
					$idne 		= $cekapaid[1];
					$cekmarking	= Suratkeluar::where('id', $idne)->first();
					if (isset($cekmarking->id)){
						$marking= $cekmarking->marking;
					}
				}
				$cekdata	= Inboxsurat::where('marking', $marking)->count();
				$iconne		= 'fa-pencil';
				$perihal 	= '';
				$lampiran	= '#';
				$urlfile	= $homebase.'/scan/files/'.$marking.'.pdf';
				$datadiri	= Suratkeluar::where('marking', $marking)->first();
				if (!isset($datadiri->id)){
					$datadiri	= Tabelskdanperaturan::where('marking', $marking)->first();
					if (!isset($datadiri->id)){
						$datadiri	= Draftsk::where('marking', $marking)->first();
						if (!isset($datadiri->id)){
							$datadiri	= Suratkeluartnpnomor::where('marking', $marking)->first();
							if (!isset($datadiri->id)){
								$datadiri	= Suratmasuk::where('marking', $marking)->first();
								if (isset($datadiri->id)){
									$perihal 	= $datadiri->perihal;
									$konseptor 	= $datadiri->pembuat;
									$pembuatan 	= $datadiri->created_at;
									$title		= $datadiri->bentuk.' Nomor Agenda '.$datadiri->noagenda.' Tahun '.$datadiri->yersrt;
									$urlfile	= $homebase.'/viewsurat/94db1c8fae5b94957265aa3a335dfd3d-'.$datadiri->id;
								} else {
									$perihal 	= 'File Missing';
									$konseptor	= 'Data Not Found';
									$pembuatan 	= 'Data Not Found';
									$title		= $perihal;
								}
							} else {
								$lampiran 	= $datadiri->lampiran;
								$perihal 	= $datadiri->perihal;
								$konseptor 	= $datadiri->pembuat;
								$pembuatan 	= $datadiri->created_at;
								$title		= $datadiri->jenissrt.' Tanggal '.$datadiri->tglbuat;
								$urlfile	= $homebase.'/viewsurat/31a6c48f03aaf7ab8085cc6b5bd34990-'.$datadiri->id;
							}
						} else {
							$lampiran 	= $datadiri->lampiran;
							$perihal 	= $datadiri->judulsk;
							$konseptor 	= $datadiri->konseptor;
							$pembuatan 	= $datadiri->created_at;
							$title		= $datadiri->jenissk.' Nomor '.$datadiri->nomor.' Tahun '.$datadiri->tahun;
						}
					} else {
						$perihal 	= $datadiri->judul;
						$lampiran 	= $datadiri->namaparaf3;
						$konseptor 	= $datadiri->inputor;
						$pembuatan 	= $datadiri->created_at;
						$title		= $datadiri->kelompok.' Nomor : '.$datadiri->nomor.' Tahun '.$datadiri->tahun;
						$urlfile	= $homebase.'/viewsurat/SKPP-'.$datadiri->id;
					}
				} else {
					$lampiran 	= $datadiri->lampiran;
					$perihal 	= $datadiri->perihal;
					$konseptor 	= $datadiri->pembuat;
					$pembuatan 	= $datadiri->created_at;
					$title		= $datadiri->jenissrt.' Nomor : '.$datadiri->nomor.' Tahun '.$datadiri->yersrt;
					$urlfile	= $homebase.'/viewsurat/keluar-'.$datadiri->id;
				}
				if ($cekdata != 0){
					$sql		= Inboxsurat::where('marking', $marking)->get();
					$x 			= 0;
					$y 			= 0;
					if (!empty($sql)){
						foreach ($sql as $group) {
							$tanggal    							= 	$group->updated_at;
							$lampiran    							= 	$group->lampiran;
							if ($lampiran != ''){
								$lampiran							= '<a href="'.$homebase.'/scan/files/'.$lampiran.'" target="_blank">File Lampiran</a>';
							}
							$kapan        							= 	SendMail::timeago($tanggal);
							$cektanggal								= 	explode(" ", $tanggal);
							$tanggal								= 	$cektanggal[0];
							if ($group->penerima == 'Esign Server'){
								$pengumuman							= 'Menandatangani Surat Pada tanggal '.$tanggal.'<br /><img src="'.$group->tandatangan.'" width="100">';
							} else {
								$pengumuman							= 'Send To '.$group->penerima.' ( '.$group->kerja.' ) at '.$group->created_at.'<br />Catatan : '.$group->footnote.'<br />'.$lampiran;
							}
							$data['pengumumans'][$x]['tanggal']     =   $tanggal;
							$data['pengumumans'][$x]['kapan']       =   $kapan;
							$data['pengumumans'][$x]['jencolor']    =   $urutanwerno[$y];
							$data['pengumumans'][$x]['siapa']       =   $group->pengirim;
							$data['pengumumans'][$x]['pengumuman']  =   $pengumuman;
							$data['pengumumans'][$x]['icon']        =   $iconne;
							$data['pengumumans'][$x]['urutanwerno'] =   $urutanwerno[$y];
							if ($y == 9) {
								$y = 0; 
							} else {
								$y++; 
							}
							$x++;
						}
					}
				}
				if ($lampiran == '#' OR $lampiran == '' OR $lampiran == null){
					$lampiran 			= '#';
				} else { $lampiran		= $homebase.'/scan/files/'.$lampiran; }
				$data['datadiri']		= $datadiri;
				$data['konseptor']		= $konseptor;
				$data['pembuatan']		= $pembuatan;
				$data['keterangan']		= $perihal;
				$data['name']			= $marking;
				$data['title']			= $title;
				$data['lampiran']		= $lampiran;
				$data['urlfile']		= $urlfile;
				return view('cetak.tracksuratkeluar', $data);
			} else {
				$data['judulpesan']			= 'Unkown Errors';
				$data['kalimatheader']		= 'Jenis Tracking Belum Di Tentukan';
				$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
				return view('errors.pesanerror', $data);
			}
		} else {
			$data['judulpesan']			= 'Unkown Errors';
			$data['kalimatheader']		= 'ID '.$id.' Tidak di Temukan';
			$data['kalimatbody']		= 'Silahkan Periksa Kembali URL Anda, dan Apabila errors seperti ini berlanjut coba refresh laman anda atau hubungi tim IT Terkait. Mohon Maaf <br /> <a href="/">Kembali Ke Laman Awal</a>';
			return view('errors.pesanerror', $data);
		
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
			if ($jenissurat == 'Kwitansi'){
				$rom  		= HPTKeuangan::where('id', $id)->first();
				if (isset($rom->id)){
					if ($rom->pengeluaran == '' OR $rom->pengeluaran == 0) {$realjenis = 'pemasukan'; $realnominal = $rom->pemasukan; }
					else { $realjenis = 'pengeluaran'; $realnominal = $rom->pengeluaran;}
					if ($alasan == 'SETUJU'){
						$update = HPTKeuangan::where('id', $id)->update([
							'tandatangan'	=> $ttd,
							'tglkwitansi'	=> date("Y-m-d"),
							'updated_at'	=> date("Y-m-d H:i:s")
						]);
					} else {
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
				$rom  		= Datainduk::where('noinduk', $noinduk)->where('tgllahir', $tgllahir)->first();
				if (isset($rom->id)){
					$update = Datainduk::where('noinduk', $noinduk)->where('tgllahir', $tgllahir)->update([
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
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
					return back();	
				}
			} else if ($jenissurat == 'Surat Keluar'){
				$rom  		= Suratkeluar::where('id', $id)->first();
				if (isset($rom->id)){
					if ($alasan == 'SETUJU'){
						$update = Suratkeluar::where('id', $id)->update([
							'filelampiran'	=> 'Signed at '.date("Y-m-d H:i:s"),
						]);
						$penerima 	= 'Esign Server';
						$status 	= 'Signed';
						$cekpenerima = Penerimasurat::where('idsurat', $rom->id)->where('penulisan', $rom->alamat)->first();
						if(isset($cekpenerima->id)){
							Penerimasurat::where('id',$cekpenerima->id)->update([
								'status'	=> 'Tertandatangani',
								'jenis'		=> 'KELUAR'
							]);
						}
					} else {
						$update = Suratkeluar::where('id', $id)->update([
							'filelampiran'	=> 'Menolak Tandatangan at '.date("Y-m-d H:i:s"),
						]);
						$penerima 	= 'Konseptor';
						$status 	= 'Menolak';
					}
					if ($update){
						Inboxsurat::insert([
							'marking'  		=> $rom->marking,
							'pengirim'  	=> $rom->kepada,
							'penerima'		=> $penerima,
							'email'			=> $rom->alamat,
							'sifat'			=> 5,
							'status'		=> $status,
							'jenis'			=> 'KELUAR',
							'kerja'			=> '',
							'catatan'		=> '',
							'tandatangan'	=> $ttd,
							'tanggal'		=> '',
							'idsurat' 		=> $rom->id,
							'noagenda' 		=> '',
							'tglsurat' 		=> $rom->tglsurat,
							'jenissrt' 		=> $rom->jenissurat,
							'nosurat' 		=> $rom->nomor.'/'.$rom->fakultas.'/'.$rom->kodefak.'/'.$rom->monsrt.'/'.$rom->yersrt,
							'kepada' 		=> $rom->kepada,
							'perihal' 		=> $rom->perihal,
							'alamat' 		=> $rom->alamat,
							'lampiran' 		=> '',
							'kodefak' 		=> '',
							'klasifikasi' 	=> '',
							'pembuat' 		=> $rom->kepada,
							'unit' 			=> '',
							'tabel' 		=> 'KELUAR',
							'footnote'		=> $alasan
						]);
						return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Terimakasih, Surat ini kami proses Lebih Lanjut']);
						return back();
					} else {
						return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Update Gagal, Ulangi Beberapa Saat Lagi.']);
						return back();
					}
				
				} else {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
					return back();	
				}
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'ID '.$id.' Tidak di Temukan']);
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
	public function viewRapot ($id){
		$surat = self::genSurat($id, 'rapot');
		return $surat;
	}
	public function jsonStatistikkd(Request $request) {
		$idrapot 	= $request->val01;
		$rdata 		= Rapotan::where('id', $idrapot)->first();
		$PAI3		= $rdata->PAI3;
		$PAI4		= $rdata->PAI4;
		$PPKN3		= $rdata->PPKN3;
		$PPKN4		= $rdata->PPKN4;
		$BI3		= $rdata->BI3;
		$BI4		= $rdata->BI4;
		$MAT3		= $rdata->PAI3;
		$MAT4		= $rdata->MAT4;
		$IPA3		= $rdata->IPA3;
		$IPA4		= $rdata->IPA4;
		$IPS3		= $rdata->IPS3;
		$IPS4		= $rdata->IPS4;
		$SBDP3		= $rdata->SBDP3;
		$SBDP4		= $rdata->SBDP4;
		$PJOK3		= $rdata->PJOK3;
		$PJOK4		= $rdata->PJOK4;
		$BJ3		= $rdata->BJ3;
		$BJ4		= $rdata->BJ4;
		$BING3		= $rdata->BING3;
		$BING4		= $rdata->BING4;
		$BA3		= $rdata->BA3;
		$BA4		= $rdata->BA4;
		$TIK3		= $rdata->TIK3;
		$TIK4		= $rdata->TIK4;
		$total3 	= 0;
		$total4		= 0;
		$count3		= 0;
		$count4		= 0;
		if ($PAI3 != 0){ $total3 = $total3 + $PAI3; $count3++; }
		if ($PPKN3 != 0){ $total3 = $total3 + $PPKN3; $count3++; }
		if ($BI3 != 0){ $total3 = $total3 + $BI3; $count3++; }
		if ($MAT3 != 0){ $total3 = $total3 + $MAT3; $count3++; }
		if ($IPA3 != 0){ $total3 = $total3 + $IPA3; $count3++; }
		if ($IPS3 != 0){ $total3 = $total3 + $IPS3; $count3++; }
		if ($SBDP3 != 0){ $total3 = $total3 + $SBDP3; $count3++; }
		if ($PJOK3 != 0){ $total3 = $total3 + $PJOK3; $count3++; }
		if ($BJ3 != 0){ $total3 = $total3 + $BJ3; $count3++; }
		if ($BING3 != 0){ $total3 = $total3 + $BING3; $count3++; }
		if ($BA3 != 0){ $total3 = $total3 + $BA3; $count3++; }
		if ($TIK3 != 0){ $total3 = $total3 + $TIK3; $count3++; }
		
		if ($PAI4 != 0){ $total4 = $total4 + $PAI4; $count4++; }
		if ($PPKN4 != 0){ $total4 = $total4 + $PPKN4; $count4++; }
		if ($BI4 != 0){ $total4 = $total4 + $BI4; $count4++; }
		if ($MAT4 != 0){ $total4 = $total4 + $MAT4; $count4++; }
		if ($IPA4 != 0){ $total4 = $total4 + $IPA4; $count4++; }
		if ($IPS4 != 0){ $total4 = $total4 + $IPS4; $count4++; }
		if ($SBDP4 != 0){ $total4 = $total4 + $SBDP4; $count4++; }
		if ($PJOK4 != 0){ $total4 = $total4 + $PJOK4; $count4++; }
		if ($BJ4 != 0){ $total4 = $total4 + $BJ4; $count4++; }
		if ($BING4 != 0){ $total4 = $total4 + $BING4; $count4++; }
		if ($BA4 != 0){ $total4 = $total4 + $BA4; $count4++; }
		if ($TIK4 != 0){ $total4 = $total4 + $TIK4; $count4++; }

		if ($total3 != 0){ $rata3 = round(($total3/$count3), 2); } else { $rata3 = 0; }
		if ($total4 != 0){ $rata4 = round(($total4/$count4), 2); } else { $rata4 = 0; }
		$arraysurat[] = array(
			'jenis' 		=> 'Kompetensi Inti 3',
			'jumlah' 		=> $rata3,
		);
		$arraysurat[] = array(
			'jenis' 		=> 'Kompetensi Inti 4',
			'jumlah' 		=> $rata4,
		);
		echo json_encode($arraysurat);
	}
	public function jsonStatpermuatan(Request $request) {
		$arraysurat	= [];
		$idrapot 	= $request->val01;
		$rdata 		= Rapotan::where('id', $idrapot)->first();
		$PAI3		= $rdata->PAI3;
		$PAI4		= $rdata->PAI4;
		$PPKN3		= $rdata->PPKN3;
		$PPKN4		= $rdata->PPKN4;
		$BI3		= $rdata->BI3;
		$BI4		= $rdata->BI4;
		$MAT3		= $rdata->MAT3;
		$MAT4		= $rdata->MAT4;
		$IPA3		= $rdata->IPA3;
		$IPA4		= $rdata->IPA4;
		$IPS3		= $rdata->IPS3;
		$IPS4		= $rdata->IPS4;
		$SBDP3		= $rdata->SBDP3;
		$SBDP4		= $rdata->SBDP4;
		$PJOK3		= $rdata->PJOK3;
		$PJOK4		= $rdata->PJOK4;
		$BJ3		= $rdata->BJ3;
		$BJ4		= $rdata->BJ4;
		$BING3		= $rdata->BING3;
		$BING4		= $rdata->BING4;
		$BA3		= $rdata->BA3;
		$BA4		= $rdata->BA4;
		$TIK3		= $rdata->TIK3;
		$TIK4		= $rdata->TIK4;
		$total3 	= 0;
		$total4		= 0;
		$count3		= 0;
		$count4		= 0;
		if ($PAI3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'PAIdBP',
				'jumlah3' 		=> $PAI3,
				'jumlah4' 		=> $PAI4,
			);
		}
		if ($PPKN3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'PPKn',
				'jumlah3' 		=> $PPKN3,
				'jumlah4' 		=> $PPKN4,
			);
		 }
		if ($BI3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'BI',
				'jumlah3' 		=> $BI3,
				'jumlah4' 		=> $BI4,
			);
		 }
		if ($MAT3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'MAT',
				'jumlah3' 		=> $MAT3,
				'jumlah4' 		=> $MAT4,
			); 
		}
		if ($IPA3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'IPA',
				'jumlah3' 		=> $IPA3,
				'jumlah4' 		=> $IPA4,
			);
		 }
		if ($IPS3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'IPS',
				'jumlah3' 		=> $IPS3,
				'jumlah4' 		=> $IPS4,
			);
		 }
		if ($SBDP3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'SBDP',
				'jumlah3' 		=> $SBDP3,
				'jumlah4' 		=> $SBDP4,
			);
		 }
		if ($PJOK3 != 0){
			$arraysurat[] = array(
				'jenis' 		=> 'PJOK',
				'jumlah3' 		=> $PJOK3,
				'jumlah4' 		=> $PJOK4,
			);
		 }
		if ($BJ3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'BJ',
				'jumlah3' 		=> $BJ3,
				'jumlah4' 		=> $BJ4,
			);
		}
		if ($BING3 != 0){
			$arraysurat[] = array(
				'jenis' 		=> 'BING',
				'jumlah3' 		=> $BING3,
				'jumlah4' 		=> $BING4,
			);
		 }
		if ($BA3 != 0){ 
			$arraysurat[] = array(
				'jenis' 		=> 'BA',
				'jumlah3' 		=> $BA3,
				'jumlah4' 		=> $BA4,
			);
		 }
		if ($TIK3 != 0){
			$arraysurat[] = array(
				'jenis' 		=> 'TIK',
				'jumlah3' 		=> $TIK3,
				'jumlah4' 		=> $TIK4,
			);
		 }
		
		
		echo json_encode($arraysurat);
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
		if($request->hasFile('file')) {
			$ImageExt	= $request->file('file')->getClientOriginalExtension();
			$file_tmp	= $request->file('file');
			$data 		= file_get_contents($file_tmp);
			$foto 		= 'data:image/' . $ImageExt . ';base64,' . base64_encode($data);
		} else { $foto = ''; }
		$input = Bukutamu::create([
			 'nama'			=> $nama, 
			 'instansi'		=> $instansi, 
			 'keperluan'	=> $keperluan, 
			 'hape'			=> $hape, 
			 'email'		=> $email, 
			 'pejabat'		=> $pejabat, 
			 'foto'			=> $foto,
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
		$rsetting				= Sekolah::where('id', session('sekolah_id_sekolah'))->first();
		$sekolah 				= $rsetting->nama_sekolah;
		$yayasan 				= $rsetting->nama_yayasan;
		$alamat 				= $rsetting->alamat;
		$kepalasekolah 			= $rsetting->kepala_sekolah->nama;
		$mutiara 				= $rsetting->slogan;
		$logo 					= $rsetting->logo;
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
		$sql 					= Layanan::orderBy('layanan', 'ASC')->get();
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
		$cekdata				= Datapsb::where('id', $id)->count();
		if ($cekdata != 0){
			$datapsb				= Datapsb::where('id', $id)->orderBy('id', 'DESC')->first();
			$nik					= $datapsb->nik;
			$cekpelengkap			= Datapelengkappsb::where('niksiswa', $nik)->first();
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
			$statcetak	= '';
			if ($scanakta == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Akta Terlebih Dahulu'; }
			if ($scanfoto == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan Foto Terlebih Dahulu'; }
			if ($scankk == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Kartu Keluarga Terlebih Dahulu'; }
			if ($scanket == ''){ $statcetak = $statcetak.'<br />Mohon Melengkapi Scan/Foto Keterangan dari Sekolah Terlebih Dahulu'; }
			$tahun					= date("Y");
			$tasks					= [];
			$tasks['logo']			= $homebase.'/'.$logo;
			$tasks['logo_grey']		= $homebase.'/'.$rsetting->logo_grey;
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
			return view('error.hilang');
		}
    }
	public function viewObservasi($id){
		$homebase			= url("/");
		$cekdata 			= Datapsb::where('id', $id)->count();
		if ($cekdata == 0){
			return view('error.hilang');
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
			$ketuapanitia	= $kepalasekolah;
			$getdata 		= Datapsb::where('id', $id)->first();
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
			
			$cekpelengkap	= Datapelengkappsb::where('niksiswa', $nik)->first();
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
			$periode 				= '';
			$setspp1 				= '';
			$setspp2 				= '';
			$setspp3 				= '';
			$setdpp1 				= '';
			$setdpp2 				= '';
			$setdpp3 				= '';
			$sql 					= Layanan::orderBy('layanan', 'ASC')->get();
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
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
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
					<td colspan="6" align="center"><strong>__________________</strong></td>
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
					<td colspan="9" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
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
					<td colspan="6" align="center"><strong>__________________</strong></td>
				  </tr>
				</table>';
			}
			else if ($hasil == 'BELUM DITERIMA'){
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
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
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
					<td colspan="6" align="center"><strong>___________________</strong></td>
				  </tr>
				</table>';
			}
			else {
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
					<td colspan="8" class="judul">NIS : '.$rsetting->nis.' – NSS : '.$rsetting->nss.' – NPSN : '.$rsetting->npsn.'</td>
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
					<td colspan="6" align="center"><strong>__________________</strong></td>
				  </tr>
				</table>';
			}
			
			$tahun					= date("Y");
			$tasks 					= [];
			$tasks['generatetbl']	= $generatetbl;
			$tasks['qrcode']		= $qrcode;
			return view('cetak.observasi', $tasks);
		}		
	}
	public function viewBiodatapsb($id){
		$homebase			= url("/");
		$cekdata 			= Datapsb::where('id', $id)->count();
		if ($cekdata == 0){
			return view('error.hilang');
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
			$getdata 		= Datapsb::where('id', $id)->first();
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
			if (isset($cekpelengkap->niksiswa)){
				if ($cekpelengkap->scanakta == ''){
					$scanakta 	= $homebase.'/dist/img/aktehilang.png';
				} else {
					$scanakta 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanakta;
				}
				if ($cekpelengkap->scanfoto == ''){
					$scanfoto	= $homebase.'/dist/img/fotohilang.png';
				} else {
					$scanfoto	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanfoto;
				}
				if ($cekpelengkap->scankk == ''){
					$scankk 	= $homebase.'/dist/img/kkhilang.png';
				} else {
					$scankk 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scankk;
				}
				if ($cekpelengkap->scanket == ''){
					$scanket 	= $homebase.'/dist/img/kethilang.png';
				} else {
					$scanket 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanket;
				}
				if ($cekpelengkap->scanbukti == ''){
					$scanbukti 	= $homebase.'/dist/img/buktihilang.png';
				} else {
					$scanbukti 	= $homebase.'/dist/img/berkas/'.$cekpelengkap->scanbukti;
				}
			} else {
				$scanakta 	= $homebase.'/dist/img/aktehilang.png';
				$scanfoto	= $homebase.'/dist/img/fotohilang.png';
				$scankk 	= $homebase.'/dist/img/kkhilang.png';
				$scanket 	= $homebase.'/dist/img/kethilang.png';
				$scanbukti 	= $homebase.'/dist/img/buktihilang.png';
			}
			
			
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
			$sql 					= Layanan::orderBy('layanan', 'ASC')->get();
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
					<td colspan="6" style="font-size: x-small"><a href="'.$scanakta.'" target="_blank">Melampirkan fotocopy akta kelahiran dan fotocopy kartu keluarga</a></td>
					<td width="128" rowspan="4" style="border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;text-align:center;vertical-align:middle; "><img src="'.$scanfoto.'" width="98" height="120" /></td>
					<td colspan="2" style="text-align: center">'.config('global.kota').', '.$tanggalctk.'</td>
				  </tr>
				  <tr>
					<td style="font-size: x-small">2</td>
					<td colspan="6" style="font-size: x-small"><a href="'.$scanfoto.'" target="_blank">Foto 4x6 sebanyak 2 lembar</a></td>
					<td colspan="2" style="text-align: center">Orang Tua / Wali</td>
				  </tr>
				  <tr>
					<td height="97" valign="top" style="font-size: x-small">3</td>
					<td colspan="6" style="font-size: x-small" valign="top"><a href="'.$scankk.'" target="_blank">Slip Gaji Orang Tua</a><br /><a href="'.$scanket.'" target="_blank">Melampirkan fotocopy Raport dan Surat Pengantar dari Sekolah Asal</a></td>
					<td colspan="2">&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td colspan="6" style="font-size: x-small">&nbsp;</td>
					<td colspan="2" align="center">'.$namaayah.'</td>
				  </tr>
				</table>
				<div style="page-break-before: always">
				<img src="'.$scanakta.'"/>
				<div style="page-break-before: always">
				<img src="'.$scankk.'"/>
				<div style="page-break-before: always">
				<img src="'.$scanket.'"/>
				<div style="page-break-before: always">
				<img src="'.$scanbukti.'"/>';
			
			$tahun					= date("Y");
			$tasks 					= [];
			$tasks['generatetbl']	= $generatetbl;
			$tasks['qrcode']		= $qrcode;
			return view('cetak.observasi', $tasks);
		}		
	}
	public function viewKarpes ($id){
		$homebase			= url("/");
		$cekdata 			= Datapsb::where('id', $id)->count();
		if ($cekdata == 0){
			return view('error.hilang');
		} else {
			$alamatcetak		= $homebase.'/karpes/'.$id;
			$qrcode 			= QrCode::size(150)->generate($alamatcetak);
			$kepalasekolah  	= config('global.Title2');
			$yayasan  			= config('global.yayasan');
			$sekolah 			= config('global.sekolah');
			$alamat  			= config('global.alamat');
			$mutiara			= '';
			$logo 				= '';
			$rsetting			= Sekolah::where('id', session('sekolah_id_sekolah'));
			if (isset($rsetting->id)){
				$sekolah 			= $rsetting->nama_sekolah;
				$yayasan 			= $rsetting->nama_yayasan;
				$alamat 			= $rsetting->alamat;
				if (isset($rsetting->kepala_sekolah->nama)){
					$kepalasekolah 	= $rsetting->kepala_sekolah->nama;
				} else {
					$kepalasekolah 	= config('global.swandhananama');
				}
				$mutiara 			= $rsetting->slogan;
				$logo 				= $rsetting->logo;
				
			}
			
			$getdata 			= Datapsb::where('id', $id)->first();
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
			$sql 					= Layanan::orderBy('layanan', 'ASC')->get();
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
		$sql 					= Layanan::orderBy('layanan', 'ASC')->where('id_sekolah',$id_sekolah)->get();
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
			$ceknik		= strlen($niksiswa);
			if ($ceknik != 16){
				echo '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error</h4>
						 NIK Haruslah 16 Karakter
					  </div>';
			}
			else if($nama == '' OR $tmtlahir == '' OR $anakke == '' OR $tgllahir == '' OR $niksiswa == '' OR $umur == '' OR $jarak == '' OR $telpon == ''){
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
			}
			else {
				if ($panggilan == ''){ $panggilan = '-'; }
				if ($tinggi == ''){ $tinggi = '0'; }
				if ($tinggi == ''){ $tinggi = '0'; }
				if ($berat == ''){ $berat = '0'; }
				if ($darah == ''){ $darah = '-'; }
				if ($bahasa == ''){ $bahasa = 'INDONESIA'; }
				if ($penyakit == ''){ $penyakit = '-'; }
				$count = Datapsb::where('nik', $niksiswa)->where('id_sekolah',$id_sekolah)->count();				
				if ($count == 0) {
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
							'id_sekolah'    => $id_sekolah
						]);
						if ($gooo){
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
									'scanbukti'		=> '',
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
								]);
							}							
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
				}
				else {
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
							}
							else {
								$boleh 	= 'IYES';
								$idupdt = $cekid->id;
							}
						}
						else {
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
					}
					else if ($status == 'verified' OR $status == 'unverified'){
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
										'scanbukti'		=> '',
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
										'marking'		=> $idne
									]);
								}							
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
					}
					else {
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
									'scanbukti'		=> '',
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
								]);
							}
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
		}
		else if ($setkerja == 'ortu'){
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
			}
			else {
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
		else if ($setkerja == 'asaltk'){
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
		else {
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
			}
			else {
				$anggotakeluarga = '';
				if (!empty($arrbersama)){
					foreach ($arrbersama as $v) {
						if ($v == 'Lain'){ 
							if ($anggotakeluarga == '') { $anggotakeluarga = $bersamaly; }
							else { $anggotakeluarga = $anggotakeluarga.'-'.$bersamaly; }
						}
						else {
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
						}
						else {
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
						}
						else {
							if ($sumberlain == '') { $sumberlain = $s; }
							else { $sumberlain = $sumberlain.'-'.$s; }
						}			
					}
				}
				$gooo 	= Datapelengkappsb::where('niksiswa', $niksiswa)->where('id_sekolah',$id_sekolah)->update([
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
		$id_sekolah 		= $request->id_sekolah;
		$nik 		= $request->nik;
		$sukses 	= '';
		$ceknik 	= Datapsb::where('nik', $nik)->where('id_sekolah',$id_sekolah)->count();
		if ($ceknik != 0){
			if ($request->hasFile('akte')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					$sukses 		= $sukses.'Gagal menyimpan Akte, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan<br />';			
				} else {
					$namafile		= $nik.'-akte.'.$request->file('akte')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('akte');
					Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
				
					Datapsb::where('nik', $nik)->where('status', '40')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 50
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scanakta' => $namafile
					]);
					$sukses 		= $sukses.'Akte Berhasil di Upload<br />';
				}
			}
			if ($request->hasFile('foto')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					$sukses 		= $sukses.'Gagal menyimpan Foto, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan<br />';
				} else {
					$namafile		= $nik.'-foto.'.$request->file('foto')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('foto');
					Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
					Datapsb::where('nik', $nik)->where('status', '50')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 60
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scanfoto' => $namafile
					]);
					$sukses 		= $sukses.'Foto Berhasil di Upload<br />';
				}
			}
			if ($request->hasFile('ksk')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					$sukses 		= $sukses.'Gagal menyimpan KK, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan<br />';			
				} else {
					$namafile		= $nik.'-kk.'.$request->file('ksk')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('ksk');
					Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
					Datapsb::where('nik', $nik)->where('status', '60')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 70
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scankk' => $namafile
					]);
					$sukses 		= $sukses.'KK Berhasil di Upload<br />';
				}
			}
			if ($request->hasFile('keterangan')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					$sukses 		= $sukses.'Gagal menyimpan Surat Keterangan, maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan<br />';			
				} else {
					$namafile		= $nik.'-ket.'.$request->file('keterangan')->getClientOriginalExtension();
					$uploadedFile 	= $request->file('keterangan');
					Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
					Datapsb::where('nik', $nik)->where('status', '70')->where('id_sekolah',$id_sekolah)->update([
						'status'		=> 80
					]);
					Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
						'scanket' => $namafile
					]);
					$sukses 		= $sukses.'Surat Keterangan Lulus Berhasil di Upload<br />';
				}
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
		$sukses 	= '';
		$getkode 	= Datapsb::where('nik', $nik)->where('tgllahir', $tgllahir)->where('id_sekolah',$id_sekolah)->orderBy('id', 'DESC')->first();
		if (isset($getkode->id)){
			echo $getkode->id;
		} else {
			echo 'notfound';
		}
	}
	public function exSaveberkasppdb(Request $request) {
		$id_sekolah 		= $request->id_sekolah;
		$nik 		= $request->val01;
		$jenis		= $request->val02;
		$cekdata	= Datapelengkappsb::where('niksiswa', $nik)->count();
		if ($cekdata != 0){
			if ($request->hasFile('file')) {
				$validator = Validator::make($request->all(), [
					'file' =>  'mimes:jpg,jpeg,png,PGN,JPG,JPEG|max:20000'
				]);
				if ($validator->fails()) {
					return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Gagal menyimpan, File maksimal 2 Mb, dan hanya JPG / PNG yang diperbolehkan']);
					return back();				
				} else {
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
							if ($scanaktalm != ''){
								if (File::exists(base_path() ."/public/sdist/img/berkas/". $scanaktalm)) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanaktalm);
								}
							}
							$namafile		= $nik.'-akte.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanakta' => $namafile
							]);
						} else if ($jenis == 'FOTO'){
							if ($scanfotolm != ''){
								if (File::exists(base_path() ."/public/sdist/img/berkas/". $scanfotolm)) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanfotolm);
								}
							}
							$namafile		= $nik.'-foto.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanfoto' => $namafile
							]);
						} else if ($jenis == 'KK'){
							if ($scankklm != ''){
								if (File::exists(base_path() ."/public/sdist/img/berkas/". $scankklm)) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scankklm);
								}
							}
							$namafile		= $nik.'-kk.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scankk' => $namafile
							]);
						} else if ($jenis == 'KET'){
							if ($scanketlm != ''){
								if (File::exists(base_path() ."/public/sdist/img/berkas/". $scanketlm)) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanketlm);
								}
							}
							$namafile		= $nik.'-ket.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanket' => $namafile
							]);
						} else {
							if ($scanbuktilm != ''){
								if (File::exists(base_path() ."/public/sdist/img/berkas/". $scanbuktilm)) {
								  File::delete(base_path() ."/public/dist/img/berkas/". $scanbuktilm);
								}
							}
							$namafile	= $nik.'-bukti.'.$request->file('file')->getClientOriginalExtension();
							$uploadedFile 	= $request->file('file');
							Storage::putFileAs('dist/img/berkas/',$uploadedFile,$namafile);
							Datapelengkappsb::where('niksiswa', $nik)->where('id_sekolah',$id_sekolah)->update([
								'scanbukti' => $namafile
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
				}
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Mohon Maaf NIK Tidak ditemukan, pastikan anda telah menyelesaikan pendaftaran untuk anak anda dan pastikan NIK yang dimasukkan sesuai dengan : '.$nik ]);
			return back();	
		}
	}
	public function jsonDatacalonsiswa(Request $request) {
		$nik 		= $request->val01;
		$tgllahir	= $request->val02;
		$scanakta	= '';
		$scanfoto	= '';
		$scankk		= '';
		$scanket	= '';
		$scanbukti	= '';
		$idpsb		= $nik;
		$idpel		= $nik;
		$getdata	= Datapelengkappsb::where('niksiswa', $nik)->first();
		if (isset($getdata->niksiswa)){
			$idpel			= $getdata->id;
			$idpsb			= $getdata->marking;
			$scanakta		= $getdata->scanakta;
			$scanfoto		= $getdata->scanfoto;
			$scankk			= $getdata->scankk;
			$scanket		= $getdata->scanket;
			$scanbukti		= $getdata->scanbukti;
			if ($scanakta != ''){
				if (File::exists(base_path()."/public/sdist/img/berkas/". $scanakta)) {
				  $scanakta	= 'berkas/'.$scanakta;
				}
			}
			if ($scanfoto != ''){
				if (File::exists(base_path()."/public/sdist/img/berkas/". $scanfoto)) {
				  $scanfoto	= 'berkas/'.$scanfoto;
				}
			}
			if ($scankk != ''){
				if (File::exists(base_path()."/public/sdist/img/berkas/". $scankk)) {
				  $scankk	= 'berkas/'.$scankk;
				}
			}
			if ($scanket != ''){
				if (File::exists(base_path()."/public/sdist/img/berkas/". $scanket)) {
				  $scanket	= 'berkas/'.$scanket;
				}
			}
			if ($scanbukti != ''){
				if (File::exists(base_path()."/public/sdist/img/berkas/". $scanbukti)) {
				  $scanbukti	= 'berkas/'.$scanbukti;
				}
			}
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
}
