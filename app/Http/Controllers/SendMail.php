<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Defuse\Crypto\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\File;
use Spatie\PdfToImage\Pdf;
use App\Models\User;
use Mail;
use QrCode;
use PDFCREATOR;
function TerbilangA($x)
{
	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	if ($x < 12)
	return " " . $abil[$x];
	elseif ($x < 20)
	return TerbilangA($x - 10) . " belas";
	elseif ($x < 100)
	return TerbilangA($x / 10) . " puluh" . TerbilangA($x % 10);
	elseif ($x < 200)
	return " seratus" . TerbilangA($x - 100);
	elseif ($x < 1000)
	return TerbilangA($x / 100) . " ratus" . TerbilangA($x % 100);
	elseif ($x < 2000)
	return " seribu" . TerbilangA($x - 1000);
	elseif ($x < 1000000)
	return TerbilangA($x / 1000) . " ribu" . TerbilangA($x % 1000);
	elseif ($x < 1000000000)
	return TerbilangA($x / 1000000) . " juta" . TerbilangA($x % 1000000);
	elseif ($x < 1000000000000)
	return TerbilangA($x / 1000000000) . " milyar" . TerbilangA($x % 1000000000);
	elseif ($x < 1000000000000000)
	return TerbilangA($x / 1000000000000) . " trilyun" . TerbilangA($x % 1000000000000);
}
class SendMail extends Controller
{
    protected static $pass = 'S1v3pY0uB3e';
    protected static function enkrip($string){
        return Crypto::encryptWithPassword($string,self::$pass);
    }
    public static function dekrip($enc){
        try{
	        return Crypto::decryptWithPassword($enc,self::$pass);
		}catch (\Exception $e){
            return false;
		}
    }
    public static function kirim($to_name,$to_email,$forget=false){
        $date=date('YmdHis');
        $cekdata = User::where('email', $to_email)->orderBy('id', 'DESC')->first();
        if (isset($cekdata->id)){
            if($forget){
                $string_enc     = $to_email.'|'.$date.'|FOR';
                $url            = url('/verifikasiemail').'?key='.self::enkrip($string_enc);
                $subject        = 'Ubah Password ('.$cekdata->fakpanjang.')';
                $subjectmail    = 'Ubah Password';
                $note           = 'Anda telah melakukan permohonan ubah password. Silahkan klik link berikut untuk melanjutkan proses.';
                DB::table('password_resets')->insert([
                    'email'     => $to_email,
                    'token'     => self::enkrip($string_enc),
                    'created_at'=> date("Y-m-d H:i:s")
                ]);
            }else{
                $string_enc     = $to_email.'|'.$date.'|VER';
                $url            = url('/verifikasiemail').'?key='.self::enkrip($string_enc);
                $subject        = 'Verifikasi Email ('.$cekdata->fakpanjang.')';
                $subjectmail    = 'Verifikasi Email';
                $note           = 'Email anda telah terdaftar di Aplikasi ('.$cekdata->fakpanjang.') Email ini dapat digunakan jika anda lupa password. Selanjutnya dimohon Bapak/Ibu membuat password untuk login ke aplikasi dengan cara Klik Tombol di bawah ini.';
            }
            $data = array(
                'nama_lengkap'      => $to_name, 
                'fakultas'          => $cekdata->fakpanjang, 
                'url_verifikasi'    => $url,
                'forget'            => $forget,
                'subject'           => $subjectmail, 
                'note'              => $note,
            );
            if ($to_email != 'arsiparis@localhost.com'){
                Mail::send('mail/user', $data, function($message) use ($to_name, $to_email, $subject) {
                    $message->to($to_email, $to_name)->subject($subject);
                    $message->from('swandhana.fp@ub.ac.id','Mail Admin');
                });
            }
        }
    }
    public static function kirimUser($to_name,$to_email,$to_username,$password,$ubahpass=false){
        $date=date('YmdHis');
        $cekdata = User::where('email', $to_email)->first();
        if (isset($cekdata->id)){
            if($ubahpass){
                $subject    = 'Password User Diubah ('.$cekdata->fakpanjang.')';
                $note       = 'Password anda telah diubah oleh admin dengan password berikut:';
            }else{
                $subject    = 'User Didaftarkan ('.$cekdata->fakpanjang.')';
                $note       = 'Email anda telah terdaftar di Aplikasi ('.$cekdata->fakpanjang.'). Email ini dapat digunakan jika anda lupa password. Untuk login silahkan akses dengan user <b>'.$to_username.'</b> atau email ini dan dengan password berikut:';
            }
            $data = array(
                'nama_lengkap'  => $to_name, 
                'password'      => $password,
                'subject'       => $subject,
                'note'          => $note,
            );
            if ($to_email != 'arsiparis@localhost.com'){
                Mail::send('mail/useradmin', $data, function($message) use ($to_name, $to_email, $subject) {
                    $message->to($to_email, $to_name)->subject($subject);
                    $message->from('swandhana.fp@ub.ac.id','Mail Admin');
                });
            }
        }
    }
    public static function notif($to_name,$to_email,$subject,$note){
        $data = array(
            'nama_lengkap'  => $to_name,
            'subject'       => $subject,
            'note'          => $note,
        );
        if ($to_email != 'arsiparis@localhost.com'){
            Mail::send('mail/notif', $data, function($message) use ($to_name, $to_email, $subject) {
                $message->to($to_email, $to_name)->subject($subject);
                $message->from('swandhana.fp@ub.ac.id','Mail Admin');
            });
        }
        $jtokencari 	= User::where('email', $to_email)->whereNotNull('firebaseid')->get();
        if (!empty($jtokencari)){
            foreach ( $jtokencari as $rtokencari ){
                $firebaseid = $rtokencari->firebase;
                $msg = array (
                    'message' 	=> $subject,
                    'title'		=> Session('namaapps01'),
                    'subtitle'	=> Session('fakpanjang'),
                    'tickerText'=> 'Notification Centre',
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
                        "title" => Session('namaapps01'),
                        "sound" => "default",
                        "body" 	=> $subject
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
    }
    public static function mobilenotif($to_name,$to_email,$subject,$note){
        if ($to_email == 'all'){
            $sjtokencariql 	= User::where('id_sekolah', $to_name)->whereNotNull('firebaseid')->get();
            if (!empty($jtokencari)){
                foreach ( $jtokencari as $rtokencari ){
                    $firebaseid = $rtokencari->firebaseid;
                    $i++;
                    $msg = array (
                        'message' 	=> $subject,
                        'title'		=> 'New User',
                        'subtitle'	=> 'New User',
                        'tickerText'=> 'Notification Centre',
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
                            "title" => $subject,
                            "sound" => "default",
                            "body" 	=> $note
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
        }
    }
    public static function kiriminbox($marking,$pengirim,$penerima,$email,$jenis,$kerja,$catatan,$tanggal){
        $footnote   = $catatan;
        $catatan    = '';
        $jenissrt   = '';
        $perihal    = 'Mail From '.$pengirim;
        $ceksurat 	= Suratkeluar::where('marking', $marking)->count();
        if ($ceksurat == 0){
            $ceksurat 	= Tabelskdanperaturan::where('marking', $marking)->count();
            if ($ceksurat == 0){
                $ceksurat 	= Suratkeluartnpnomor::where('marking', $marking)->count();
                if ($ceksurat == 0){
                    $getdatasurat 	= Draftsk::where('marking', $marking)->first();
                    if (isset($getdatasrt->id)){
                        $jenissrt 		= $getdatasurat->jenissk;
                        $paraf1 		= $getdatasurat->paraf1;
                        $paraf2 		= $getdatasurat->paraf2;
                        $paraf3 		= $getdatasurat->paraf3;
                        $paraf4 		= $getdatasurat->paraf4;	
                        $penandatangan 	= $getdatasurat->penandatangan;
                        $idsurat 	    = $getdatasurat->id;
                        $noagenda       = '';
                        $tglsurat       = $getdatasurat->tanggalsk;
                        $nosurat        = $getdatasurat->nomor.' TAHUN '.$getdatasurat->tahun;
                        $kepada         = $getdatasurat->nama;
                        $perihal        = $getdatasurat->judulsk;
                        $alamat         = $getdatasurat->nip;
                        $lampiran       = '';
                        $kodefak        = '';
                        $klasifikasi    = '';
                        $pembuat        = $getdatasurat->konseptor;
                        $unit           = $getdatasurat->unitkonseptor;
                        $tabel          = 'DRAFTSK';
                    } else {
                        $getdatamsk 	= Suratmasuk::where('marking', $marking)->first();
                        if (isset($getdatamsk->id)){
                            $jenissrt 		= $getdatamsk->bentuk;
                            $paraf1 		= '';
                            $paraf2 		= '';
                            $paraf3 		= '';
                            $paraf4 		= '';
                            $penandatangan 	= '';
                            $idsurat 	    = $getdatamsk->id;
                            $noagenda       = '';
                            $tglsurat       = $getdatamsk->tglsurat;
                            $nosurat        = $getdatamsk->nosurat;
                            $kepada         = $penerima;
                            $perihal        = $getdatamsk->perihal;
                            $alamat         = '';
                            $lampiran       = '';
                            $kodefak        = '';
                            $klasifikasi    = '';
                            $pembuat        = $getdatamsk->pembuat;
                            $unit           = $getdatamsk->fakultas;
                            $tabel          = 'MASUK';
                        } else {
                            $paraf1 		= '';
                            $paraf2 		= 0;
                            $paraf3 		= 0;
                            $paraf4 		= 0;
                            $penandatangan	= 0;
                            $idsurat 	    = 0;
                            $noagenda       = '';
                            $tglsurat       = '';
                            $nosurat        = '';
                            $kepada         = '';
                            $perihal        = '';
                            $alamat         = '';
                            $lampiran       = '';
                            $kodefak        = '';
                            $klasifikasi    = '';
                            $pembuat        = '';
                            $unit           = '';
                            $tabel          = '';
                        }
                    }
                } else {
                    $getdatasurat 	= Suratkeluartnpnomor::where('marking', $marking)->first();
                    $jenissrt 		= $getdatasurat->jenissrt;
                    $paraf1 		= $getdatasurat->paraf1;
                    $paraf2 		= $getdatasurat->paraf2;
                    $paraf3 		= $getdatasurat->paraf3;
                    $paraf4 		= $getdatasurat->paraf4;
                    $penandatangan 	= $getdatasurat->pejabat;
                    $idsurat 	    = $getdatasurat->id;
                    $noagenda       = '';
                    $tglsurat       = $getdatasurat->tglbuat;
                    $nosurat        = $getdatasurat->marking;
                    $kepada         = $getdatasurat->kepada;
                    $perihal        = $getdatasurat->perihal;
                    $alamat         = $getdatasurat->alamat;
                    $lampiran       = '';
                    $kodefak        = $getdatasurat->kodefak;
                    $klasifikasi    = $getdatasurat->faskode;
                    $pembuat        = $getdatasurat->pembuat;
                    $unit           = $getdatasurat->kelompok;
                    $tabel          = 'KELUARNONOMER';
                }	
            } else {
                $getdatasurat 	= Tabelskdanperaturan::where('marking', $marking)->first();
                $paraf1 		= $getdatasurat->paraf1;
                $paraf2 		= $getdatasurat->paraf2;
                $paraf3 		= $getdatasurat->paraf3;
                $paraf4 		= $getdatasurat->paraf4;
                $penandatangan 	= $getdatasurat->penandatangan;
                $jenissrt 	    = $getdatasurat->kelompok;
                $idsurat 	    = $getdatasurat->id;
                $noagenda       = '';
                $tglsurat       = $getdatasurat->tanggal;
                $nosurat        = $getdatasurat->nomor.' TAHUN '.$getdatasurat->tahun;
                $kepada         = $getdatasurat->namaparaf1;
                $perihal        = $getdatasurat->judul;
                $alamat         = $getdatasurat->sparaf1;
                $lampiran       = '';
                $kodefak        = $getdatasurat->kelompok;
                $klasifikasi    = $getdatasurat->kodefas;
                $pembuat        = $getdatasurat->inputor;
                $unit           = $getdatasurat->catatan;
                $tabel          = 'SKDANPERATURAN';
            }
        } else {
            $getdatasurat 	= Suratkeluar::where('marking', $marking)->first();
            $paraf1 		= $getdatasurat->paraf1;
            $paraf2 		= $getdatasurat->paraf2;
            $paraf3 		= $getdatasurat->paraf3;
            $paraf4 		= $getdatasurat->paraf4;
            $penandatangan 	= $getdatasurat->pejabat;
            $jenissrt 	    = $getdatasurat->jenissrt;
            $idsurat 	    = $getdatasurat->id;
            $noagenda       = '';
            $tglsurat       = $getdatasurat->tglsurat;
            $nosurat        = $getdatasurat->nomor.'/'.$getdatasurat->fakultas.'/'.$getdatasurat->kodefak.'/'.$getdatasurat->monsrt.'/'.$getdatasurat->yersrt;
            $kepada         = $getdatasurat->kepada;
            $perihal        = $getdatasurat->perihal;
            $alamat         = $getdatasurat->alamat;
            $lampiran       = '';
            $kodefak        = $getdatasurat->kodefak;
            $klasifikasi    = $getdatasurat->faskode;
            $pembuat        = $getdatasurat->pembuat;
            $unit           = $getdatasurat->kelompok;
            $tabel          = 'KELUAR';
        }
        if ($jenissrt == 'Perjanjian Orientasi Kerja') { $catatan = 'KONTRAK'; }
        try{
	        $idinbox    = Inboxsurat::insertGetId([
                'marking'  		=> $marking,
                'pengirim'  	=> $pengirim,
                'penerima'		=> $penerima,
                'email'			=> $email,
                'status'		=> 'send',
                'sifat'			=> 5,
                'jenis'			=> $jenis,
                'kerja'			=> $kerja,
                'catatan'		=> $catatan,
                'footnote'		=> $footnote,
                'tandatangan'	=> '',
                'tanggal'		=> $tanggal,
            	'idsurat'		=> $idsurat,
                'noagenda'		=> $noagenda,
                'tglsurat'		=> $tglsurat,
                'jenissrt'		=> $jenissrt,
                'nosurat'		=> $nosurat,
                'kepada'		=> $kepada,
                'perihal'		=> $perihal,
                'alamat'		=> $alamat,
                'lampiran'		=> $lampiran,
                'kodefak'		=> $kodefak,
                'klasifikasi'	=> $klasifikasi,
                'pembuat'		=> $pembuat,
                'unit'			=> $unit,
                'tabel'			=> $tabel,
                'penandatangan'	=> $penandatangan,
                'paraf1'	    => $paraf1,
                'paraf2'	    => $paraf2,
                'paraf3'	    => $paraf3,
                'paraf4'	    => $paraf4,
            ]);
            $string_enc = $email.'|'.$idinbox.'|VER';
            $url        = url('/openinbox').'?key='.self::enkrip($string_enc);
            if ($kerja == 'MASUK'){
                if ($penerima == 'Arsiparis'){
                    Suratmasuk::where('marking', $marking)->update([
                        'status'    => 'arsip',
                        'disposisi' => ''
                    ]);
                } else {
                    Suratmasuk::where('marking', $marking)->update([
                        'status'    => 'disposisi',
                        'disposisi' => 'Ke '.$penerima
                    ]);    
                }
            }
            $tuliskirim     = 'Dari '.$pengirim.' '.$jenis.' ('.$kerja.') <p><a href="'.$url.'" style="display:inline-block;background:#e85034;color:#ffffff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:100%;Margin:0;text-decoration:none;text-transform:none;padding:9px 26px 9px 26px;mso-padding-alt:0px;border-radius:24px;" target="_blank">Direct Open Mailbox</a></p> NB : Sebelum membuka link diatas, pastikan Bapak/Ibu sudah login ke aplikasi '.url('/');
            $cariiduser 	= User::where('email', $email)->get();
            if (!empty($cariiduser)){
                foreach($cariiduser as $riduser){
                    $idcaritoken	= $riduser->id;
                    $jtokencari	    = Firebasebank::where('userid', $idcaritoken)->get();
                    if (!empty($jtokencari)){
                        foreach ( $jtokencari as $rtokencari ){
                            $firebaseid = $rtokencari->firebase;
                            $msg        = array (
                                'message' 	=> $tuliskirim,
                                'title'		=> Session('namaapps01'),
                                'subtitle'	=> Session('fakpanjang'),
                                'tickerText'=> 'Notification Centre',
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
                                    "title" => Session('namaapps01'),
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
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
                            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );		
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                            $result = curl_exec($ch);
                            curl_close($ch);
                        }
                    }
                }
            }
            $data = array(
                'nama_lengkap'  => $penerima, 
                'password'      => '',
                'subject'       => $perihal,
                'note'          => $tuliskirim,
            );
            if ($perihal == null){
                $perihal = 'Mail Service';
            }
            if ($email != 'arsiparis@localhost.com'){
                Mail::send('mail/notif', $data, function($message) use ($penerima, $email, $perihal) {
                    $message->to($email, $penerima)->subject($perihal);
                    $message->from('swandhana.fp@ub.ac.id','Mail Admin');
                });
            }
		} catch (\Exception $e){
            return $e->getMessage();
		}
    }
    public static function timeago($time_ago){
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "one minute ago";
            } else{
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an hour ago";
            } else {
                return "$hours hrs ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }
    public static function terbilang($x){
        $x = TerbilangA($x);
        return $x;
    }
}
