<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessageNotification;
use setasign\Fpdi\Tcpdf\Fpdi;

use App\Models\User;
use App\Suratkeluar;
use App\Suratmasuk;
use App\XFiles;
use App\Dataindukstaff;
use App\Inboxsurat;
use App\RencanaKegiatan;
use App\Logstaff;
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

class PersuratanController extends Controller
{
	public function viewIndex() {
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
			$data['sidebar']			= 'persuratan';
			$data['semester']			= $semester;
			$data['tapel']				= $tapel;
			$data['karyawans']			= Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->whereNotIn('statpeg', ['Non Aktif', 'Pensiun', 'Meninggal'])->get();
			return view('simaster.persuratan', $data);
		} else {
			$data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
	}
    public function viewMailbox() {
		$data				        = [];
        if (Session('sekolah_nama_aplikasi') !== null){
            $tandatangan    = '';
            $tandatanganks  = '';
            $usernameks     = '';
            $niy            = '';
            $cekmarkttd     = 'TTD-'.Session('username');
            $cekttd         = XFiles::where('xmarking', $cekmarkttd)->first();
            if (isset($cekttd->xfile)){
                $tandatangan= $cekttd->xfile;
            }
            $cekpejabat     			= Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', Session('sekolah_id_sekolah'))->first();
            if (isset($cekpejabat->id)){
                $nama       			= $cekpejabat->nama;
                $niy        			= $cekpejabat->niy;
                $getusername 			= User::where('nip', $niy)->first();
                if (isset($getusername->id)){
                    $usernameks 		= $getusername->username;
                    $cekmarkttd 		= 'TTDKS-'.Session('sekolah_id_sekolah');
                    $cekttd				= XFiles::where('xmarking', $cekmarkttd)->first();
                    if (isset($cekttd->xfile)){
                        $tandatanganks	= $cekttd->xfile;
                    }
                }
            }
            if (Session('nip') == $niy){
                $ttekirim               = $tandatanganks;
            } else {
                $ttekirim               = $tandatangan;
            }
            $data['usernameks']  		= $usernameks;
            $data['tandatangan']  	    = $tandatangan;
            $data['tandatanganks']  	= $tandatanganks;
            $data['ttekirim']  	        = $ttekirim;
            $data['namaapps01']  		= Session('sekolah_nama_aplikasi');
            $data['domainapps01']  		= Session('sekolah_nama_yayasan');
            $data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
            $data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
            $data['addressapps01']  	= Session('sekolah_alamat');
            $data['emailapps01']  		= Session('sekolah_email');
            $data['lamanapps01']  		= parse_url(request()->root())['host'];
            $data['logofrontapps01']  	= Session('sekolah_frontpage');
            $data['logo01']  			= url("/").'/'.Session('sekolah_logo');
            $data['sidebar']			= 'mailbox';
            return view('simaster.mailbox', $data);
        } else {
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Session Expired, Mohon Relogin';
            return view('errors.notready', $data);
        }
		
	}
    public function jsonDataSurat(Request $request) {
		$arraysurat	= [];
		$tahun	    = $request->tahun;
		$jenis		= $request->jenis;
        $cari	    = $request->cari;
        if ($cari == 'list'){
            $i 			= 0;
            $data		= new Suratkeluar();
            $limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
            $order		= ($request->input('order') == null ? 'nomor desc' : $request->input('order'));
            if ($tahun != null AND $tahun != '') $data = $data->where('yersrt', $tahun);
            $data 		= $data->where('id_sekolah', session('sekolah_id_sekolah'));
            if ($jenis != 'all'){
                $data 		= $data->where('status', $jenis);
            }
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $data->where(function ($q) use ($searchTerm) {
                    $q->where('kepada', 'like', "%$searchTerm%")
                        ->orWhere('alamat', 'like', "%$searchTerm%")
                        ->orWhere('perihal', 'like', "%$searchTerm%")
                        ->orWhere('ruangarsip', 'like', "%$searchTerm%")
                        ->orWhere('klasifikasi', 'like', "%$searchTerm%")
                        ->orWhere('namapejabat', 'like', "%$searchTerm%")
                        ->orWhere('pembuat', 'like', "%$searchTerm%");
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
                    'message'	=> 'List Data Surat '.$tahun,
                    'total'		=> $totaldata,
                    'data'		=> $arraysurat
                ];
                return response()->json($response, 200);
            }
            $response = [
                'message'        => 'No Data'
            ];
            return response()->json($response, 500);
        } else if ($cari == 'listsuratmasuk'){
            $i 			= 0;
            $data		= new Suratmasuk();
            $limit		= ($request->input('limit') == null ? '10' : $request->input('limit'));
            $order		= ($request->input('order') == null ? 'noagenda desc' : $request->input('order'));
            if ($tahun != null AND $tahun != '') $data = $data->where('yersrt', $tahun);
            $data 		= $data->where('id_sekolah', session('sekolah_id_sekolah'));
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $data->where(function ($q) use ($searchTerm) {
                    $q->where('kepada', 'like', "%$searchTerm%")
                        ->orWhere('nosurat', 'like', "%$searchTerm%")
                        ->orWhere('perihal', 'like', "%$searchTerm%")
                        ->orWhere('ruangarsip', 'like', "%$searchTerm%")
                        ->orWhere('ringkasan', 'like', "%$searchTerm%")
                        ->orWhere('asalsurat', 'like', "%$searchTerm%")
                        ->orWhere('noagenda', 'like', "%$searchTerm%");
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
                    'message'	=> 'List Data Surat Masuk '.$tahun,
                    'total'		=> $totaldata,
                    'data'		=> $arraysurat
                ];
                return response()->json($response, 200);
            }
            $response = [
                'message'        => 'No Data'
            ];
            return response()->json($response, 500);
        } else if ($cari == 'exportsuratmasuk'){
            $sql 		= Suratmasuk::where('yersrt', $tahun)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('nomor', 'DESC')->get();
			echo json_encode($sql);
        } else if ($cari == 'mailbox'){
            $sql 		= Inboxsurat::where('penerima', Session('nip'))->where('status', '1')->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('id', 'ASC')->get();
			echo json_encode($sql);
        } else if ($cari == 'arsipmailbox'){
            $arraysurat = [];
            $i          = 0;
            $sql        = Inboxsurat::where('penerima', Session('nip'))->where('status', '!=', '1')->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('id', 'DESC')->get();
            $xmarkings  = $sql->pluck('xmarking')->toArray();
            $sudahkah   = XFiles::whereIn('xmarking', $xmarkings)->get()->keyBy('xmarking');
            $updateIds  = [];
            foreach ($sql as $rows) {
                if (!isset($sudahkah[$rows->xmarking])) {
                    $updateIds[] = $rows->id;
                } else {
                    $arraysurat[$i] = $rows;
                    $i++;
                }
            }
            if (!empty($updateIds)) {
                Inboxsurat::whereIn('id', $updateIds)->update(['status' => 1]);
            }
            echo json_encode($arraysurat);
        } else {
            if ($jenis != ''){
                $sql 		= Suratkeluar::select('')->where('yersrt', $tahun)->where('status', $jenis)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('nomor', 'DESC')->get();
			} else {
                $sql 		= Suratkeluar::where('yersrt', $tahun)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('nomor', 'DESC')->get();
            }
            echo json_encode($sql);
        }
	}
    public function exPersuratanFunc(Request $request) {
		$workcode   = $request->workcode;
		$tahun 		= $request->tahun;
        $homebase   = url('/');
        if ($workcode == 'newnomor'){
            $getlast 	= Suratkeluar::where('yersrt', $tahun)->where('id_sekolah', session('sekolah_id_sekolah'))->orderBy('nomor', 'DESC')->first();
            if (isset($getlast->nomor)){
                $nomor  = $getlast->nomor;
            } else {
                $nomor  = 0;
            }
            $nomor++;
            try {
                $marking = md5(Session('sekolah_id_sekolah').'-SK-'.$tahun.'-'.$nomor);
                DB::beginTransaction();
                DB::table('tbl_suratkeluar')->insert([
                    'marking' 		=>  $marking,
                    'jenissrt' 		=>  'BIASA',
                    'nomor' 		=>  $nomor,
                    'tglsurat' 		=>  date('Y-m-d'),
                    'daysrt' 		=>  date('d'),
                    'monsrt' 		=>  (int)date('m'),
                    'yersrt' 		=>  date('Y'),
                    'kepada' 		=>  '',
                    'alamat' 		=>  '',
                    'perihal' 		=>  'Belum di Tentukan',
                    'idpejabat' 	=>  0,
                    'pejabat' 		=>  '',
                    'namapejabat' 	=>  '',
                    'sifat' 		=>  'Biasa',
                    'klasifikasi' 	=>  '',
                    'pembuat' 		=>  Session('nama'),
                    'status' 		=>  'unsigned',
                    'ruangarsip' 	=>  '',
                    'ordnerarsip' 	=>  '',
                    'lemariarsip' 	=>  '',
                    'id_sekolah' 	=>  Session('sekolah_id_sekolah'),
                ]);
                DB::commit();
                XFiles::create([
					'xmarking'	=> $marking,
					'xtabel'	=> 'tbl_suratkeluar',
					'xjenis'	=> '',
					'xfile'		=> ''
				]);
                return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Nomor '.$nomor.' di Tahun '.$tahun.' Berhasil diubah']);
                return back();
            
            } catch (\Exception $e) {
                DB::rollback();
                $pesan = $e->getMessage();
                return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
                return back(); 
            }
        } else if ($workcode == 'arsipkan'){
            try {
                DB::beginTransaction();
                DB::table('tbl_suratkeluar')->where('id', $request->val01)->update([
                    'ruangarsip' 	=>  $request->val02,
                    'ordnerarsip' 	=>  $request->val03,
                    'lemariarsip' 	=>  $request->val04,
                ]);
                DB::commit();
                return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Archived']);
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $pesan = $e->getMessage();
                return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
                return back(); 
            }
        } else if ($workcode == 'deletesrtkeluar'){
            try {
                DB::beginTransaction();
                DB::table('tbl_suratkeluar')->where('id', $request->val01)->update([
                    'ruangarsip' 	=>  'Deleted',
                    'ordnerarsip' 	=>  'By '.Session('nama'),
                    'lemariarsip' 	=>  'At '.date('Y-m-d H:i:s'),
                    'status'        =>  'unsigned',
                ]);
                DB::commit();
                $cekfilelm      = Suratkeluar::where('id', $request->val01)->first();
                $filelama       = $cekfilelm->klasifikasi;
                if ($filelama == '' OR $filelama == null){

                } else {
                    $draft 		    = public_path($filelama);
                    try {
                        unlink($draft);
                    }  catch (\Exception $e) {
                    }
                }
                $update = XFiles::where('xmarking', $cekfilelm->marking)->update([
                    'xfile' => ''
                ]);
                return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Deleted']);
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $pesan = $e->getMessage();
                return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
                return back(); 
            }
        } else if ($workcode == 'deletesrtmasuk'){
            try {
                DB::beginTransaction();
                DB::table('tbl_suratmasuk')->where('id', $request->val01)->update([
                    'ruangarsip' 	=>  'Deleted',
                    'ordnerarsip' 	=>  'By '.Session('nama'),
                    'lemariarsip' 	=>  'At '.date('Y-m-d H:i:s'),
                ]);
                DB::commit();
                $cekfilelm      = Suratmasuk::where('id', $request->val01)->first();
                $filelama       = $cekfilelm->scansurat;
                if ($filelama == '' OR $filelama == null){

                } else {
                    $draft 		    = public_path($filelama);
                    try {
                        unlink($draft);
                    }  catch (\Exception $e) {
                    } 
                }
                return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => $draft.' Deleted']);
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $pesan = $e->getMessage();
                return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
                return back(); 
            }
        } else if ($workcode == 'deletemailbox'){
            $gagal      = '';
            $cekinbox   = Inboxsurat::where('id', $request->id)->first();
            if (isset($cekinbox->id)){
                XFiles::where('xmarking', $cekinbox->xmarking)->delete();
                if ($cekinbox->tabel == 'tbl_suratkeluar'){
                    Suratkeluar::where('id', $rom->id)->update([
                        'status'        => 'Ditolak',
                        'lemariarsip'   => 'Ditolak Oleh '.Session('nama').' Pada '.date('Y-m-d H:i:s')
                    ]);
                } else if ($cekinbox->tabel == 'db_rencanakegiatan'){
                    $marking    = $cekinbox->xmarking;
                    $marking    = str_replace('persetujuanKS', 'teksproposal', $marking);
                    RencanaKegiatan::where('markingteksproposal', $marking)->update([
                        'status'        => 'rencana',
                        'bendahara'     => null,
                        'catatanks'     => 'Ditolak Oleh '.Session('nama').' Pada '.date('Y-m-d H:i:s')
                    ]);
                } else if ($cekinbox->tabel == 'db_rapotan'){
                    $urlsurat   = $cekinbox->urlsurat;
                    $remove     = explode('ttdrapot/', $urlsurat);
                    if (isset($remove[1])){
                        $idrapot= $remove[1];
                        $rapot  = Rapotan::where('id', $idrapot)->first();
                        if (isset($rapot->id)){
                            if ($cekinbox->jenis == 'PARAF'){
                                $marking	= $cekinbox->xmarking;
                            } else {
                                $marking	= $rapot->tapel.'-'.$rapot->semester.'-'.$rapot->kelas.'-'.$rapot->noinduk.'-'.$rapot->id_sekolah.'-TTDKS';
                            }
                            $rapotkhas		= $rapot->tapel.'-'.$rapot->semester.'-'.$rapot->kelas.'-'.$rapot->noinduk.'-'.$rapot->id_sekolah.'-RapotKhas';
                            $rapotdinas		= $rapot->tapel.'-'.$rapot->semester.'-'.$rapot->kelas.'-'.$rapot->noinduk.'-'.$rapot->id_sekolah.'-RapotDinas';
                            XFiles::where('xmarking', $marking)->delete();
                            XFiles::where('xmarking', $rapotkhas)->delete();
                            XFiles::where('xmarking', $rapotdinas)->delete();
                        }
                    }
                }
                Logstaff::create([
					'jenis'			=> 'Delete mailbox', 
					'sopo'			=> Session('nip'),
					'kelakuan'		=> json_encode($cekinbox).' Pada '.date('Y-m-d H:i:s'),
					'id_sekolah' 	=> session('sekolah_id_sekolah')
				]);
                Inboxsurat::where('id', $cekinbox->id)->delete();
            } else {
                $gagal =' ID '.$request->id.' Tidak Valid<br />';
            }
            if ($gagal == ''){
                return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Mailbox Deleted']);
                return back();
            } else {
                return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
                return back(); 
            }
        } else if ($workcode == 'tandatangan'){
            $statusnotif    = 0;
            $cekfilelm      = Suratkeluar::where('id', $request->val01)->first();
            $cekpejabat     = Dataindukstaff::where('id', $request->val05)->first();
            if (isset($cekpejabat->id)){
                $nama       = $cekpejabat->nama;
                $niy        = $cekpejabat->niy;
                $notelp     = $cekpejabat->notelp;
                $jabatan    = $cekpejabat->jabatan;
                $arrhpdosen = str_split($notelp);
                $hape	    = '';
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
                $namafile	= $homebase.'/ttdsurat/'.$request->val01;
                $keterangan = 'Yth. '.$nama.'%0A
                Dengan hormat kami sampaikan bahwa, kami membutuhkan tandatangan Bapak/Ibu :%0A
                Kami telah menyiapkan surat elektronik guna mempercepat proses administrasi, kami mohon dengan hormat untuk klik link berikut :%0A'.$namafile.'%0A
                Dan kami berharap isian Bapak/Ibu pada link tersebut dapat kami terima dalam waktu yang tidak terlalu lama.%0A
                %0ADemikian pemberitahuan ini kami sampaikan. Terima kasih';
                $keterangan	= str_replace(" ", '%20', $keterangan);
                $keterangan = 'https://api.whatsapp.com/send?phone='.$hape.'&text='.$keterangan;
                $keterangan = '<div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-check"></i> Mohon di Kirimkan!</h4>
                                    Link untuk tandatangan telah kami buat, mohon click link berikut untuk mengirimkan link permohonan tandatangan ke '.$nama.'<br />
                                    Link Tandatangan : <a href="'.$keterangan.'" target="_blank">https://api.whatsapp.com/send?phone='.$hape.'&text=MohonTTD</a>
                                </div>';
                $statusnotif= 1;
            } else {
                $nama       = '';
                $niy        = '';
                $hape       = '';
                $keterangan = '';
            }
            if ($request->hasFile('file')) {
                $ekstensi		= $request->file('file')->getClientOriginalExtension();
                $cekekstensi    = strtolower($ekstensi);
                if ($cekekstensi == 'pdf'){
                    $cekfilelm      = Suratkeluar::where('id', $request->val01)->first();
                    $filelama       = $cekfilelm->klasifikasi;
                    if ($filelama == '' OR $filelama == null){

                    } else {
                        $draft 		    = public_path($filelama);
                        try {
                            unlink($draft);
                        }  catch (\Exception $e) {
						}
                    }
                    $namafile 		= $request->val01.'-'.time().'.'.$ekstensi;
                    $uploadedFile 	= $request->file('file');
                    Storage::disk('local')->putFileAs('scan/'.$cekfilelm->yersrt.'/',$uploadedFile,$namafile);
                    Suratkeluar::where('id', $request->val01)->update([
                        'klasifikasi'   => 'scan/'.$cekfilelm->yersrt.'/'.$namafile,
                        'status'        => 'File Uploaded, Not Signed'
                    ]);
                } else {
                    $keterangan = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-close"></i> Upload Gagal!</h4>
                                        Ekstensi File Bapak / Ibu '.$cekekstensi.' tidak diperkenankan, mohon ubah ke PDF Terlebih Dahulu
                                    </div>';
                    $statusnotif    = 0;
                }
            } else {
                $keterangan = '<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-close"></i> Upload Gagal!</h4>
                                    File Gagal di Upload Silahkan Ulangi Beberapa Saat Lagi
                                </div>';
                $statusnotif    = 0;
            }
            $tglsurat   = $request->val08;
            $arrtgl     = explode('-', $tglsurat);
            try {
                DB::beginTransaction();
                DB::table('tbl_suratkeluar')->where('id', $request->val01)->update([
                    'perihal' 	    =>  $request->val02,
                    'kepada' 	    =>  $request->val03,
                    'alamat' 	    =>  $request->val04,
                    'tglsurat'      =>  $request->val08,
                    'daysrt' 		=>  $arrtgl[2],
                    'monsrt' 		=>  (int)$arrtgl[1],
                    'yersrt' 		=>  $arrtgl[0],
                    'idpejabat'     =>  $request->val05,
                    'pejabat' 		=>  $jabatan,
                    'namapejabat' 	=>  $nama,
                ]);
                DB::commit();
                if ($statusnotif == 1){
                    $getniy     = Dataindukstaff::where('id', $request->val05)->first();
                    if (isset($getniy->id)){
                        $niy        = $getniy->niy;
                        Inboxsurat::updateOrCreate(
							[
								'xmarking'		=> $cekfilelm->marking,
								'penerima' 		=> $niy,
								'id_sekolah' 	=> Session('sekolah_id_sekolah')
							],
							[
								'tabel' 			=> 'tbl_suratkeluar',
								'perihal' 			=> 'Tandatangan Surat Perihal '.$request->val02,
								'pengirim' 			=> Session('nama'),
								'jenis' 			=> 'TTE',
								'urlsurat'			=> url('/').'/ttdsurat/' . $request->val01,
								'status'			=> 1
							]
						);
                        $getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niy)->first();
                        if (isset($getuser->id)){
                            $tuliskirim         = '<a href="'.url('/').'/ttdsurat/' . $request->val01.'" target="_blank">Tandatangani Surat</a>';
                            Notification::send($getuser, new NewMessageNotification($tuliskirim));
                        }
                        $tuliskirim = 'Surat Yang Perlu Bapak/Ibu Tandatangani Sudah di Buat, Mohon Bantuannnya untuk Membuka Aplikasi / Browser untuk memprosesnya';
                        SendMail::mobilenotif($niy,'perseorangan',$getniy->nama,$tuliskirim);
                    }            
                }
                return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Archived', 'keterangan' => $keterangan]);
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $pesan = $e->getMessage();
                return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $pesan]);
                return back(); 
            }
        } else if ($workcode == 'ttemulti'){
            $xmarkinglist   = $request->xmarkinglist;
            $getarrid       = explode(',', $xmarkinglist);
            $password       = $request->password;
            $tandatangan    = $request->ttekirim;
            $username       = Session('username');
            $sukses         = 0;
            $gagal          = '';
            $user 			= User::where('id', Session('id'))->first();
            if (Hash::check($password, $user->password)) {
                foreach ($getarrid as $id){
                    $cekinbox = Inboxsurat::where('id', $id)->first();
                    if (isset($cekinbox->id)){
                        if ($cekinbox->tabel == 'tbl_suratkeluar' OR $cekinbox->tabel == 'db_rencanakegiatan'  OR $cekinbox->tabel == 'mushaf_ujian'){
                            $sudahkah = XFiles::updateOrCreate(
                                [
                                    'xmarking'	=> $cekinbox->xmarking,
                                ],
                                [
                                    'xfile'		=> $tandatangan
                                ]
                            );
                            if ($sudahkah){
                                Inboxsurat::where('id', $id)->update([
                                    'status'    => 2
                                ]);
                                $sukses++;
                                if ($cekinbox->tabel == 'tbl_suratkeluar'){
                                    $rom  		    = Suratkeluar::where('marking', $cekinbox->xmarking)->first();
                                    if (isset($rom->id)){
                                        $pembuat 	    = $rom->pembuat;
                                        $filelama 	    = $rom->klasifikasi;
                                        $tahun		    = $rom->yersrt;
                                        $homebase	    = url("/");
                                        $domain		    = str_replace('http://', '', $homebase);
                                        $domain		    = str_replace('https://', '', $domain);
                                        $domain		    = str_replace('/', '', $domain);
                                        $domain		    = str_replace('#', '', $domain);
                                        $domain		    = str_replace('-', '', $domain);
                                        $domain		    = str_replace('.', '', $domain);
                                        $fileserti 	    = $domain.'.crt';
                                        $error		    = '';
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
                                                'lemariarsip'		=> $error,
                                            ]);
                                        }
                                    }
                                }
                                
                            }
                        } elseif ($cekinbox->tabel == 'db_rapotan'){
                            $urlsurat   = $cekinbox->urlsurat;
                            $remove     = explode('ttdrapot/', $urlsurat);
                            if (isset($remove[1])){
                                $idrapot= $remove[1];
                                $rapot  = Rapotan::where('id', $idrapot)->first();
                                if (isset($rapot->id)){
                                    if ($cekinbox->jenis == 'PARAF'){
                                        $marking	= $cekinbox->xmarking;
                                    } else {
                                        $marking	= $rapot->tapel.'-'.$rapot->semester.'-'.$rapot->kelas.'-'.$rapot->noinduk.'-'.$rapot->id_sekolah.'-TTDKS';
                                    }
                                    $rapotkhas		= $rapot->tapel.'-'.$rapot->semester.'-'.$rapot->kelas.'-'.$rapot->noinduk.'-'.$rapot->id_sekolah.'-RapotKhas';
                                    $rapotdinas		= $rapot->tapel.'-'.$rapot->semester.'-'.$rapot->kelas.'-'.$rapot->noinduk.'-'.$rapot->id_sekolah.'-RapotDinas';
                                    XFiles::updateOrCreate(
                                        [
                                            'xmarking'	=> $marking,
                                        ],
                                        [
                                            'xtabel'	=> '',
                                            'xjenis'	=> $rapot->noinduk,
                                            'xfile'		=> $ttd
                                        ]
                                    );
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
                                    Inboxsurat::where('id', $id)->update([
                                        'status'    => 2
                                    ]);
                                    $sukses++;
                                } else {
                                    Inboxsurat::where('id', $id)->update([
                                        'status'    => 2
                                    ]);
                                    $gagal = $gagal.' TTE Rapot ID Tidak di Temukan<br />';
                                }
                            } else {
                                Inboxsurat::where('id', $id)->update([
                                    'status'    => 2
                                ]);
                                $gagal = $gagal.' TTE Rapot ID Tidak di Temukan<br />';
                            }
                        } else {
                            Inboxsurat::where('id', $id)->update([
                                'status'    => 2
                            ]);
                            $sukses++;
                        }
                    } else {
                        $gagal = $gagal.' ID '.$id.' Tidak Valid<br />';
                    }
                }
                if ($gagal == ''){			
                    return response()->json(['icon' => 'success', 'warna' => '#5ba035',  'status' => 'Sukses.!', 'message' => 'Tandatangan Yang Berhasil di Bubuhkan Sejumlah '.$sukses]);
                    return back();
                } else {
                    return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => $gagal]);
                }                 
            } else {
                return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Password Bapak/Ibu Salah']);
                return back(); 
            }
        } else if ($workcode == 'getdatasurat'){
            $getdatasurat = Suratkeluar::where('id', $request->val01)->first();
            return response()->json([
                'marking' 		=>  $getdatasurat->marking,
                'jenissrt' 		=>  $getdatasurat->jenissrt,
                'nomor' 		=>  $getdatasurat->nomor,
                'tglsurat' 		=>  $getdatasurat->tglsurat,
                'daysrt' 		=>  $getdatasurat->daysrt,
                'monsrt' 		=>  $getdatasurat->monsrt,
                'yersrt' 		=>  $getdatasurat->yersrt,
                'kepada' 		=>  $getdatasurat->kepada,
                'alamat' 		=>  $getdatasurat->alamat,
                'perihal' 		=>  $getdatasurat->perihal,
                'idpejabat' 	=>  $getdatasurat->idpejabat,
                'pejabat' 		=>  $getdatasurat->pejabat,
                'namapejabat' 	=>  $getdatasurat->namapejabat,
                'sifat' 		=>  $getdatasurat->sifat,
                'klasifikasi' 	=>  $getdatasurat->klasifikasi,
                'pembuat' 		=>  $getdatasurat->pembuat,
                'status' 		=>  $getdatasurat->status,
                'ruangarsip' 	=>  $getdatasurat->ruangarsip,
                'ordnerarsip' 	=>  $getdatasurat->ordnerarsip,
                'lemariarsip' 	=>  $getdatasurat->lemariarsip,
            ]);
            return back(); 
        } else if ($workcode == 'getdatasuratmasuk'){
            $getdatasurat = Suratmasuk::where('id', $request->val01)->first();
            return response()->json([
                'tglmasuk'      => $getdatasurat->tglmasuk,
                'tglsurat'      => $getdatasurat->tglsurat,
                'daysrt'        => $getdatasurat->daysrt,
                'monsrt'        => $getdatasurat->monsrt,
                'yersrt'        => $getdatasurat->yersrt,
                'jenissurat'    => $getdatasurat->jenissurat,
                'nosurat'       => $getdatasurat->nosurat,
                'asalsurat'     => $getdatasurat->asalsurat,
                'kepada'        => $getdatasurat->kepada,
                'perihal'       => $getdatasurat->perihal,
                'ringkasan'     => $getdatasurat->ringkasan,
                'scansurat'     => $getdatasurat->scansurat,
                'ruangarsip'    => $getdatasurat->ruangarsip,
                'ordnerarsip' 	=> $getdatasurat->ordnerarsip,
                'lemariarsip' 	=> $getdatasurat->lemariarsip,
                'bentuk'        => $getdatasurat->bentuk,
                'pembuat'       => $getdatasurat->pembuat,
                'status'        => $getdatasurat->status,
            ]);
            return back(); 
        } else if ($workcode == 'suratmasuk'){
            $idne       = $request->id_idsurat;
            $noagenda   = 0;
            if ($idne != 'new') {
                $getlast = Suratmasuk::where('id', $idne)->first();
                $noagenda = isset($getlast->noagenda) ? $getlast->noagenda : 0;
            }
            if ($noagenda == 0) {
                $getlast = Suratmasuk::where('yersrt', $tahun)
                            ->where('id_sekolah', session('sekolah_id_sekolah'))
                            ->orderBy('noagenda', 'DESC')
                            ->first();
                $noagenda = isset($getlast->noagenda) ? ($getlast->noagenda + 1) : 1;
            }

            try {
                $marking = Session('sekolah_id_sekolah') . '-' . $tahun . '-' . $noagenda;
                DB::beginTransaction();
                $data = [
                    'tglmasuk'      => $request->id_tglmasuk,
                    'tglsurat'      => $request->id_tglsurat,
                    'daysrt'        => date('d'),
                    'monsrt'        => (int) date('m'),
                    'yersrt'        => $tahun,
                    'jenissurat'    => $request->id_jenissurat,
                    'nosurat'       => $request->id_nosurat,
                    'asalsurat'     => $request->id_asalsurat,
                    'kepada'        => $request->id_kepada ?? '',
                    'perihal'       => $request->id_perihal,
                    'ringkasan'     => $request->id_ringkasan,
                    'scansurat'     => '',
                    'ruangarsip'    => '',
                    'ordnerarsip' 	=> '',
                    'lemariarsip' 	=> '',
                    'bentuk'        => $request->id_bentuk,
                    'pembuat'       => Session('nama'),
                    'status'        => ($idne == 'new') ? 'new' : 'update',
                    'id_sekolah'    => Session('sekolah_id_sekolah'),
                ];
                if ($idne == 'new') {
                    $data['marking']    = $marking;
                    $data['noagenda']   = $noagenda;
                    DB::table('tbl_suratmasuk')->insert($data);
                } else {
                    DB::table('tbl_suratmasuk')->where('id', $idne)->update($data);
                }
                
                if ($request->hasFile('file')) {
                    $ekstensi		= $request->file('file')->getClientOriginalExtension();
                    $cekekstensi    = strtolower($ekstensi);
                    if ($cekekstensi == 'pdf'){
                        $cekfilelm      = Suratmasuk::where('noagenda', $noagenda)->where('yersrt', $tahun)->first();
                        $filelama       = $cekfilelm->scansurat;
                        if ($filelama == '' OR $filelama == null){

                        } else {
                            $draft 		    = public_path($filelama);
                            try {
                                unlink($draft);
                            }  catch (\Exception $e) {
                            }   
                        }
                        $namafile 		= $noagenda.'-'.time().'.'.$ekstensi;
                        $uploadedFile 	= $request->file('file');
                        Storage::disk('local')->putFileAs('suratmasuk/'.$tahun.'/',$uploadedFile,$namafile);
                        Suratmasuk::where('noagenda', $noagenda)->where('yersrt', $tahun)->update([
                            'scansurat' => 'suratmasuk/' . $tahun . '/' . $namafile,
                            'status'    => 'File Uploaded'
                        ]);
                        $tuliskirim         = '<a href="'.url('/').'/suratmasuk/' . $tahun . '/' . $namafile.'" target="_blank">View Surat</a>';
                        $getnamapenerima    = explode('-', $request->id_kepada);
                        if (!empty($getnamapenerima)){
                            foreach($getnamapenerima as $rnama){
                                $getniy     = Dataindukstaff::where('id_sekolah',session('sekolah_id_sekolah'))->where('nama', $rnama)->first();
                                if (isset($getniy->id)){
                                    $niy        = $getniy->niy;
                                    Inboxsurat::updateOrCreate(
                                        [
                                            'xmarking'		=> $cekfilelm->marking,
                                            'penerima' 		=> $niy,
                                            'id_sekolah' 	=> Session('sekolah_id_sekolah')
                                        ],
                                        [
                                            'tabel' 			=> 'tbl_suratmasuk',
                                            'perihal' 			=> 'Surat Dari '.$request->id_asalsurat.' Perihal '.$request->id_perihal,
                                            'pengirim' 			=> Session('nama'),
                                            'jenis' 			=> 'Surat Masuk',
                                            'urlsurat'			=> url('/').'/suratmasuk/'.$tahun .'/'.$namafile,
                                            'status'			=> 1
                                        ]
                                    );
                                    $getuser    = User::where('id_sekolah', Session('sekolah_id_sekolah'))->where('nip', $niy)->first();
                                    if (isset($getuser->id)){
                                        Notification::send($getuser, new NewMessageNotification($tuliskirim));
                                    }
                                    SendMail::mobilenotif($niy,'perseorangan',$getniy->nama,'Ada Surat Untuk Bapak/Ibu');
                                }
                            }
                        }
                        $keterangan = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-check"></i> Upload Sukses!</h4>
                                            Registered In Agenda ' . $noagenda . '
                                        </div>';
                    } else {
                        $keterangan = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-close"></i> Upload Gagal!</h4>
                                            Ekstensi File Bapak / Ibu '.$cekekstensi.' tidak diperkenankan, mohon ubah ke PDF Terlebih Dahulu
                                        </div>';
                        $statusnotif    = 0;
                    }
                }
                DB::commit();
                return response()->json([
                    'keterangan'    => $keterangan,
                    'icon'          => 'success',
                    'warna'         => '#5ba035',
                    'status'        => 'Sukses.!',
                    'message'       => 'Nomor Agenda ' . $noagenda . ' di Tahun ' . $tahun . ' Berhasil disimpan'
                ]);
            } catch (\Exception $e) {
                $keterangan = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-close"></i> Upload Gagal!</h4>
                                            ' . $e->getMessage() . '
                                        </div>';
                DB::rollback();
                $pesan = $e->getMessage();
                return response()->json([
                    'keterangan'    => $keterangan,
                    'icon'          => 'error',
                    'warna'         => '#bf441d',
                    'status'        => 'Gagal',
                    'message'       => $pesan
                ]);
            }
        } 
	}
    public function viewTrackingbyid($id) {
        $homebase                   = url('/');
		$trackingcode 	            = $id;
		$data 			            = [];
		$cekjenis		            = explode('-', $trackingcode);
        $data['namaapps01']  		= Session('sekolah_nama_aplikasi');
        $data['domainapps01']  		= Session('sekolah_nama_yayasan');
        $data['subdomainapps01']  	= Session('sekolah_nama_sekolah');
        $data['subsubdomainapps01']	= Session('sekolah_kode_sekolah');
        $data['addressapps01']  	= Session('sekolah_alamat');
        $data['emailapps01']  		= Session('sekolah_email');
        $data['lamanapps01']  		= parse_url(request()->root())['host'];
        $data['logofrontapps01']  	= Session('sekolah_frontpage');
        $data['logo01']  			= url("/").'/'.Session('sekolah_logo');
		if (isset($cekjenis[1])){
			$jenis 		= $cekjenis[0];
			$idne 		= $cekjenis[1];
			if ($jenis == 'srtklr'){
				$cekdata	= 0;
				$iconne		= 'fa-pencil';
				$perihal 	= '';
				$lampiran	= '#';
				$urlfile	= $homebase.'/dist/img/buktihilang.png';
				$datadiri	= Suratkeluar::where('id', $idne)->first();
				if (!isset($datadiri->id)){
					$perihal 	= 'File Missing';
                    $konseptor	= 'Data Not Found';
                    $pembuatan 	= 'Data Not Found';
                    $title		= $perihal;
                    $marking    = 'File Missing';
                    $tandatangan= '';
				} else {
					$perihal 	= $datadiri->perihal;
					$konseptor 	= $datadiri->pembuat;
					$pembuatan 	= $datadiri->created_at;
					$title		= $datadiri->jenissrt.' Nomor : '.$datadiri->nomor.' Tahun '.$datadiri->yersrt;
					$urlfile	= $homebase.'/'.$datadiri->klasifikasi;
                    $marking    = $datadiri->marking;
                    $tandatangan= $datadiri->getTandatangan->xfile ?? '';
				}
				$data['tandatangan']	= $tandatangan;
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
    public function TtdSurat($id) {
        $getdatasurat = Suratkeluar::where('id', $id)->first();
        if (isset($getdatasurat->id)){
            $status         = $getdatasurat->status;
            $klasifikasi    = $getdatasurat->klasifikasi;
            $file           = Storage::disk('local')->path($klasifikasi);
            if (file_exists($file)) {
                $pdfContent = file_get_contents($file);
                if ($pdfContent !== false) {
                    if ($status == 'File Uploaded, Not Signed' AND $klasifikasi != ''){
                        $kalender           = array('wulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                        $dd                 = date("d");
                        $mm                 = (int)date("m");
                        $mm                 = $kalender[$mm];
                        $tahuniki           = date("Y");
                        $tglsurat           = date("Y-m-d");
                        $sakniki            = $dd.' '.$mm.' '.$tahuniki;
                        $tandatangan        = '<img src="'.url('/').'/boxed-bg.jpg" width="100">';
                        $data['jenissurat'] = $getdatasurat->jenissrt;
                        $data['tandatangan']= $tandatangan;
                        $data['idsurat']    = $id;
                        $data['sakniki']    = $sakniki;
                        $data['bendahara']  = $getdatasurat->pejabat;
                        $data['alamatweb']  = '';
                        $data['surat']      = url('/').'/'.$klasifikasi;
                        if ($getdatasurat->pejabat == 'Kepala Sekolah'){
                            $tandatangan    = '';
                            $usernameks     = '';
                            $cekmarkttdks   = 'TTDKS-'.Session('sekolah_id_sekolah');
                            $cekpejabat     = Dataindukstaff::where('jabatan', 'Kepala Sekolah')->where('id_sekolah', $getdatasurat->id_sekolah)->first();
                            if (isset($cekpejabat->id)){
                                $nama       			= $cekpejabat->nama;
                                $niy        			= $cekpejabat->niy;
                                $foto 					= $cekpejabat->foto;
                                $getusername 			= User::where('nip', $niy)->first();
                                if (isset($getusername->id)){
                                    $usernameks 		= $getusername->username;
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
                            return view('simaster.formttdpassword', $data);
                        } else {
                            return view('simaster.formttd', $data);
                        }
                    } else {
                        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
                    }
                } else {
                    $data                       = [];
                    $data['kalimatheader']  	= 'Mohon Maaf';
                    $data['kalimatbody']  		= 'Surat ID '.$id.', Failed to read PDF file';
                    return view('errors.notready', $data);
                }
            } else {
                $data                       = [];
                $data['kalimatheader']  	= 'Mohon Maaf';
                $data['kalimatbody']  		= 'Surat ID '.$id.' Tidak memiliki Surat Yang Perlu di Tandatangani';
            }
        } else {
            $data                       = [];
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Surat ID '.$id.' Tidak ditemukan';
            return view('errors.notready', $data);
        }
	}
}

