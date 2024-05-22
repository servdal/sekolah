<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Backup\DbDumperFactory;
use Session;

class BackupController extends Controller
{
    public function backupPublicFolder()
    {
        if (Session('previlage') == 'level1'){
            $backupFolderPath = storage_path('app/backup');
            if (!file_exists($backupFolderPath)) {
                mkdir($backupFolderPath, 0755, true);
            }
            $backupFolderPath = storage_path('app/backup/public');
            if (!file_exists($backupFolderPath)) {
                mkdir($backupFolderPath, 0755, true);
            }
            $publicFolderPath = public_path();
            $backupFolderPath = storage_path('app/backup/public');
            File::copyDirectory($publicFolderPath, $backupFolderPath);
            return response()->json(['message' => 'Public folder backup completed']);
        } else {
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
    }
    public function backupDatabase()
    {
        if (Session('previlage') == 'level1'){
            $backupFolderPath = storage_path('app/backup');
            if (!file_exists($backupFolderPath)) {
                mkdir($backupFolderPath, 0755, true);
            }
            $dbDumper = DbDumperFactory::createFromConnection(config('database.default'));
            $dbDumper->setDbName(config('database.connections.' . config('database.default') . '.database'))
                ->setUserName(config('database.connections.' . config('database.default') . '.username'))
                ->setPassword(config('database.connections.' . config('database.default') . '.password'));
            $backupName = 'database-backup-' . date('Y-m-d-H-i-s') . '.sql';
            $backupPath = storage_path('app/backup/' . $backupName);
            $dbDumper->dumpToFile($backupPath);
            return response()->download($backupPath)->deleteFileAfterSend();
        } else {
            $data['kalimatheader']  	= 'Mohon Maaf';
            $data['kalimatbody']  		= 'Laman Terbatas untuk Kalangan Tertentu, Mohon Kembali Ke Laman Sebelum atau Hubungi Tim ADMIN';
            return view('errors.notready', $data);
        }
    }
}
