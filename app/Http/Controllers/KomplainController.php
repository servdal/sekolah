<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Keluhan;
use App\Models\User;
use App\Dataindukstaff;
use Validator;
use Session;
use Redirect;
use DateTime;
use Carbon\Carbon;
class KomplainController extends Controller
{
    public function viewLapKomplain() {
        $iduser			= Session('id');
		$getdatauser	= User::where('id', $iduser)->where('id_sekolah',session('sekolah_id_sekolah'))->first();
		if (isset($getdatauser->klsajar)){
			$klsajar		= $getdatauser->klsajar;
			$smt 			= $getdatauser->smt;
            $previlage 		= $getdatauser->previlage;
        } else {
			$klsajar		= '';
			$smt 			= '';
			$previlage 		= Session('previlage');
		}
        if ($previlage == 'level5' OR $previlage == 'level1' OR $previlage == 'level2' OR $previlage == 'level3' OR $previlage == 'level4'){
			$biodata    		=   Dataindukstaff::where('niy', Session('nip'))->first();
			$data       		=   [];
			$data['biodata']    =   $biodata;
			return view('simaster.laposankeluhan', $data);
		} else {
			$data       		=   [];
			return view('errors.gakboleh', $data);
		}
    }
    public function getKomplainpribadi(Request $request) {
    	$nohape		= $request->input('set01');
		$arraysurat	= array();
		$jprestasi	= Keluhan::where('nip', $nohape)->where('rating', '=', '')->orderBy('created_at', 'ASC')->get();
		foreach ($jprestasi as $rpeg) {
			$arraysurat[] = array(
				'id' 		=> $rpeg->id,
				'dari' 		=> $rpeg->dari,
				'hostname' 	=> $rpeg->hostname,
				'statuser' 	=> $rpeg->statuser,
				'jenis' 	=> $rpeg->jenis,		
				'nip' 		=> $rpeg->nip,
				'nama' 		=> $rpeg->nama,
				'kepada' 	=> $rpeg->kepada,
				'judul' 	=> $rpeg->judul,
				'isikeluhan'=> $rpeg->isikeluhan,
				'gambar' 	=> $rpeg->gambar,
				'extension' => $rpeg->extension,
				'tanggapan' => $rpeg->tanggapan,
				'bukti' 	=> $rpeg->bukti,
				'jenfile' 	=> $rpeg->jenfile,
				'rating' 	=> $rpeg->rating,
				'status' 	=> $rpeg->status,
			);
		}
		echo json_encode($arraysurat);
	}
	public function getdatakeluhan(Request $request) {
		$arraysurat	= array();
		$tahun		= $request->input('set01');
		$bulan		= $request->input('set02');
		$jenis		= $request->input('set03');
		$idsekolah	= $request->input('set04');
		if ($jenis == 'belum'){
			$jprestasi	= Keluhan::where('tanggapan', '=', '')->where('id_sekolah',session('sekolah_id_sekolah'))->orderBy('created_at', 'ASC')->get();
		} else {
			if ($bulan == 'ALL'){
				$valcari = $tahun;
			} else {
				$valcari = $tahun.'-'.$bulan;
			}
			$jprestasi	= Keluhan::where('created_at', 'LIKE', $valcari.'%')->where('id_sekolah',session('sekolah_id_sekolah'))->get();
		}		
		foreach ($jprestasi as $rpeg) {
			$start 	= Carbon::parse($rpeg->created_at);
			$end	= Carbon::parse($rpeg->updated_at);
			$durasi	= $start->diffInHours($end) . ':' . $start->diff($end)->format('%I:%S');
			
			if ($durasi == '00:00:00'){ $durasi = ''; }
			$arraysurat[] = array(
				'id' 		=> $rpeg->id,
				'dari' 		=> $rpeg->dari,
				'hostname' 	=> $rpeg->hostname,
				'statuser' 	=> $rpeg->statuser,
				'jenis' 	=> $rpeg->jenis,		
				'nip' 		=> $rpeg->nip,
				'nama' 		=> $rpeg->nama,
				'kepada' 	=> $rpeg->kepada,
				'judul' 	=> $rpeg->judul,
				'isikeluhan'=> $rpeg->isikeluhan,
				'gambar' 	=> $rpeg->gambar,
				'extension' => $rpeg->extension,
				'tanggapan' => $rpeg->tanggapan,
				'bukti' 	=> $rpeg->bukti,
				'jenfile' 	=> $rpeg->jenfile,
				'rating' 	=> $rpeg->rating,
				'status' 	=> $rpeg->status,
				'buat' 		=> $start,
				'lastupdate'=> $end,
				'durasi'	=> $durasi
			);
		}
		
		echo json_encode($arraysurat);
	}
	public function statjRating(Request $request) {
        $arraysurat     =   [];
        $sql            =   Keluhan::where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('rating')->get();
        foreach ($sql as $get) {
            $rating 	= $get->rating;
			$jumlah		= Keluhan::where('id_sekolah',session('sekolah_id_sekolah'))->where('rating', $rating)->count();
            $arraysurat[] = array(
                'rating' 	=> $rating,
                'jumlah' 	=> $jumlah,
            );
        }
        echo json_encode($arraysurat);
    }
	public function statUnitkerja(Request $request) {
        $arraysurat     =   [];
        $sql            =   Keluhan::where('id_sekolah',session('sekolah_id_sekolah'))->groupBy('kepada')->get();
        foreach ($sql as $get) {
            $kepada 	= $get->kepada;
			$jumlah		= Keluhan::where('id_sekolah',session('sekolah_id_sekolah'))->where('kepada', $kepada)->count();
            $arraysurat[] = array(
                'unitkerja' 	=> $kepada,
                'jumlah' 		=> $jumlah,
            );
        }
        echo json_encode($arraysurat);
    }
	public function saveKomplain(Request $request) {
        $nama			= $request->input('val01');
        $nim			= $request->input('val02');
        $status			= $request->input('val03');
        $tentang		= $request->input('val04');
        $isi			= $request->input('val05');
		$jenis			= $request->input('val06');
        $idsekolah		= $request->input('val07');

		if ($nama == '' OR $nim == '' OR $jenis == '' OR $tentang == '' OR $isi == ''){
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Error, Pastikan Semua Isian Anda Isi. Bila Masih Mendapati Kesulitan Silahkan Hubungi Pihak Admin PSIK Untuk Info Lebih Lanjut.']);
			return back();
		} else {
			$serveragent 	= $_SERVER['HTTP_USER_AGENT'];
			$gettgl  		= explode(" ", $serveragent);
			$agent1	 		= $gettgl[4];
			$agent2	 		= $gettgl[5];
			$useragent 		= $agent1.' '.$agent2;
			$input 			= Keluhan::create([
				'dari'		=> $nama, 
				'hostname'	=> $useragent, 
				'statuser'	=> $status, 
				'jenis'		=> 'NIM', 
				'nip'		=> $nim, 
				'nama'		=> $nama, 
				'kepada'	=> $jenis, 
				'judul'		=> $tentang, 
				'isikeluhan'=> $isi, 
				'gambar'	=> '', 
				'extension'	=> '', 
				'tanggapan'	=> '', 
				'rating'	=> '', 
				'status'	=> 'new',
				'id_sekolah'=> $idsekolah
			]);
			$idne = $input->id;
			if ($input){
				if ($request->hasFile('file')) {
					$jenfile	= $request->file->getClientOriginalExtension();
					$jenfile	= strtolower($jenfile);
					if ($jenfile == 'jpeg' OR $jenfile == 'jpg' ){
						$file   	= time().'.'.$request->file->getClientOriginalExtension();
						$uploadedFile 	= $request->file('file');
						Storage::putFileAs('images/komplain/',$uploadedFile,$file);
						$filename 	= $file;
						Keluhan::where('id', $idne)->update([
							'gambar'	=> $filename,
							'extension'	=> $request->file->getClientOriginalExtension(), 
						]);
					}
				}
				event(new \App\Events\NotifikasiPengguna('Keluhan Dari '.$nama.' terkait '.$tentang.' Sudah Masuk, Mohon segera ditindaklanjuti'));
			} else {
				return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Error, Pastikan Semua Isian Anda Isi. Bila Masih Mendapati Kesulitan Silahkan Hubungi Pihak Admin PSIK Untuk Info Lebih Lanjut.']);
				return back();
			}
		}
    }
	public function saveTanggapan(Request $request) {
        $tanggapan		= $request->input('val01');
        $idne			= $request->input('val02');
		if ($tanggapan == 'readonly'){
			$input 			= Keluhan::where('id', $idne)->update([
				'status'	=> 'read'
			]);
		} else {
			$input 			= Keluhan::where('id', $idne)->update([
				'tanggapan'	=> $tanggapan, 
				'status'	=> 'replied'
			]);
		}
		
		if ($input){
			if ($request->hasFile('file')) {
				$jenfile			= $request->file->getClientOriginalExtension();
				$jenfile			= strtolower($jenfile);
				if ($jenfile == 'jpeg' OR $jenfile == 'jpg' ){
					$file   		= time().'.'.$request->file->getClientOriginalExtension();
					$uploadedFile 	= $request->file('file');
					Storage::putFileAs('images/komplain/',$uploadedFile,$file);
						
					$filename 		= $file;
					Keluhan::where('id', $idne)->update([
						'bukti'		=> $filename,
						'jenfile'	=> $request->file->getClientOriginalExtension(),
					]);
				}
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tanggapan atas keluhan ini telah tersampaikan']);
				return back();
			} else {
				return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Tanggapan atas keluhan ini telah tersampaikan']);
				return back();
			}
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Error, Pastikan Semua Isian Anda Isi. Bila Masih Mendapati Kesulitan Silahkan Hubungi Pihak Admin PSIK Untuk Info Lebih Lanjut.']);
			return back();
		}
    }
	public function saveRating(Request $request) {
        $rating		= $request->input('val01');
        $idne		= $request->input('val02');
		$input 		= Keluhan::where('id', $idne)->update([
			'rating'	=> $rating, 
			'status'	=> 'finish'
		]);
		if ($input){
			return response()->json(['icon' => 'success', 'warna' => '#5ba035', 'status' => 'Sukses', 'message' => 'Laporan keluhan ini telah sukses diarsipkan']);
			return back();
		} else {
			return response()->json(['icon' => 'error', 'warna' => '#bf441d', 'status' => 'Gagal', 'message' => 'Error, Pastikan Semua Isian Anda Isi. Bila Masih Mendapati Kesulitan Silahkan Hubungi Pihak Admin PSIK Untuk Info Lebih Lanjut.']);
			return back();
		}
    }
}

