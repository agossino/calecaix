<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attivita;

class ImageController extends Controller
{
    public function generateImage($id)
    {
        $attivita = Attivita::find($id);

        // Creare una nuova immagine vuota
        $image = imagecreatetruecolor(800, 600);

        // Impostare i colori
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        // Riempire l'immagine con il colore bianco
        imagefilledrectangle($image, 0, 0, 600, 600, $white);

        // Aggiungere il titolo dell'attività
      //  $fontPath = resource_path('public/fonts/DejaVuSans.ttf'); // Assicurati di avere il font nella directory dei font
        $fontPath = public_path('fonts/DejaVuSans.ttf');
        imagettftext($image, 20, 0, 50, 50, $black, $fontPath, $attivita->titolo);

        // Aggiungere la descrizione
        $descrizione = strip_tags($attivita->descrizione); // Rimuovere i tag HTML
        imagettftext($image, 12, 0, 50, 100, $black, $fontPath, $descrizione);

        // Aggiungere l'immagine dell'attività
        if ($attivita->image_file) {
            $activityImagePath = storage_path('app/public/imgtrek/' . $attivita->image_file);
            if (file_exists($activityImagePath)) {
            $imageInfo = getimagesize($activityImagePath);
            switch ($imageInfo['mime']) {
                case 'image/jpeg':
                $activityImage = imagecreatefromjpeg($activityImagePath);
                break;
                case 'image/png':
                $activityImage = imagecreatefrompng($activityImagePath);
                break;
                default:
                $activityImage = null;
                break;
            }
            if ($activityImage) {
                imagecopy($image, $activityImage, 50, 150, 0, 0, imagesx($activityImage), imagesy($activityImage));
                imagedestroy($activityImage);
            }
            }
        }

        // Salvare l'immagine come file JPG
        $filePath = public_path('images/' . $attivita->id . '.jpg');
        imagejpeg($image, $filePath);

        // Liberare la memoria
        imagedestroy($image);

        // Visualizzare l'immagine generata
        return response()->file($filePath);
    }
}
