<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GoogleDriveController extends Controller
{
    public function readExcelFile($fileId)
    {
        // Configurazione del client Google
        $client = new Client();
        $client->setApplicationName('Laravel Google Drive Integration');
        $client->setScopes(Drive::DRIVE_READONLY);
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setAccessType('offline');

        // Autenticazione
        $service = new Drive($client);

        // Ottieni il file dal Google Drive
        $response = $service->files->get($fileId, ['alt' => 'media']);
        $content = $response->getBody()->getContents();

        // Salva temporaneamente il file Excel
        $tempFilePath = storage_path('temp_file.xlsx');
        file_put_contents($tempFilePath, $content);

        // Leggi il file Excel usando PhpSpreadsheet
        $spreadsheet = IOFactory::load($tempFilePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Elimina il file temporaneo
        unlink($tempFilePath);

        return response()->json($data);
    }
}