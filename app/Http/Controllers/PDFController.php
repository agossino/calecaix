<?php
namespace App\Http\Controllers;

use App\Models\Attivita;
use App\Models\TipoAttivita;
use App\Models\TipoDifficolta;
use App\Models\TipoIscrizione;
use App\Models\TipoQualifica;
use App\Models\TipoSpecializzazione;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

$tipospecializzazione = TipoSpecializzazione::where('published', 1)->get();

$tipoqualifica  = TipoQualifica::where('published', 1)->get();
$tipodifficolta = TipoDifficolta::where('published', 1)->get();
class PDFController extends Controller
{
    /**
     * Summary of showPDF
     * @param mixed $filename
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function showPDF($filename, $id)
    {
        $path = storage_path('app/public/pdftrek/' . $filename);
        // Controlla se il file esiste
        if (! file_exists($path)) {
            // Restituisce un errore 404 se il file non esiste
            abort(404, 'Il File non esiste.');
        }
        $this->incrementa_clic($id);
        // Restituisce il file se esiste
        return response()->file($path);
    }

    public function showDirectPDF($filename)
    {
        $filePath = storage_path('app/public/pdftrek/' . $filename); // Percorso del file PDF

        return response()->file($filePath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename=' . $filename,
        ]);
    }

    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     *
     * TCPDF::writeHTMLCell( $larghezza,  $altezza,  $x dell'angolo superiore sinistro,  $y ell'angolo superiore sinistro,  $html = '',  $border,  $ln,  $fill = false,  $reseth = true,  $align = '',  $autopadding = true )

     */

    public function store(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->file('pdf_file')) {
            $filePath = $request->file('pdf_file')->store('pdfs', 'public');
            // Salva il percorso del file nel database
            // Esempio: Pdf::create(['file_path' => $filePath]);

            return back()->with('success', 'File uploaded successfully');
        }

        return back()->with('error', 'Please select a valid PDF file.');
    }


    /**
     * Crea un PDF per l'attività da pagima programma.blade.php
     * @param mixed $id
     * @return void
     */
    public function pagina_pdf($id)
    {

        $attivita = Attivita::find($id);
        $fields   = [
           // 'Descrizione'      => $attivita->descrizione,
          /*  'Titolo'           => $attivita->titolo,
            'Tipo attività'    => $attivita->tipoattivita,
            'Tipo difficolta'   => $attivita->tipodifficolta,
            'Tipo iscrizione'  => $attivita->tipoiscrizione,
            'Tipo attivita'    => $attivita->tipoattivita,
           */ 
      
            'Data inizio'      => $attivita->data_inizio,
            'Data fine'        => $attivita->data_fine,
            'Luogo ritrovo'    => $attivita->luogoritrovo,
            'Ora Ritrovo'      => $attivita->ora_ritrovo,
            'N. minimo'        => $attivita->numero_minimo,
            'N. Massimo'       => $attivita->numero_massimo,
            'Lunghezza'        => $attivita->lunghezza,
            'Durata'           => $attivita->durata,
            'Difficoltà'       => $attivita->difficolta,
            'Dislivello'       => $attivita->dislivello,
            'Quota minima'     => $attivita->quota_minima,
            'Quota massima'    => $attivita->quota_massima,
            'Nome'             => $attivita->nome,
            'Cognome'          => $attivita->cognome,
            'Telefono'         => $attivita->telefono,
            'Email'            => $attivita->email,
            'Qualifica'        => $attivita->qualifica,
            'Specializzazione' => $attivita->specializzazione,
            'Contatti guida'   => $attivita->contatti_guida,
            'Iscrizione'       => $attivita->iscrizione,
            'Condizioni'       => $attivita->condizioni,
            'Costo'            => $attivita->costo,
            'Note'             => $attivita->note,
        ];

        // Create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Cai Bologna');
        $pdf->SetAuthor('Escursionismo');
        $pdf->SetTitle('Attivita PDF');
        $pdf->SetSubject('Attivita Details');
        $pdf->SetKeywords('TCPDF, PDF, attivita, guide');

        // Set default header data
        $pdf->SetHeaderData('img/Aquila2.png', 30, 'CLUB ALPINO ITALINO "Sez. Mario Fantin" Bologna', 'Via dei Fornaciai 25/A  -  40129 BOLOGNA  tel. 051 234856                                                           www.caibo.it  segreteria@caibo.it CF: 80071110375');
       // $pdf->Image("img/logo_cai.png", 5, 5, 10, 12, '', 'https://www.caibo.it', '', true, 150);
        //$pdf->Image("img/logo_escursionismo.png", 105, 5, 10, 12, '', 'https://www.caibo.it', '', true, 150);
      
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Add a page
        $pdf->AddPage();

        $pdf->Image("img/logo_cai.png", 20, 4, 15, 14, '', 'https://www.caibo.it', '', true, 150);
        $pdf->Image("img/logo_escursionismo.png", 170, 4, 15, 14, '', 'https://www.caibo.it', '', true, 150);
        // Set font
        $pdf->SetFont('helvetica', '', 12);
        
        $html_img = '<img src="' . storage_path('app/public/imgtrek/' . $attivita->image_file) . '" width="50" height="50" />';

        $pdf->Image(storage_path('app/public/imgtrek/' . $attivita->image_file), 60, 30, 60, 60, '', 'https://caibo.it/calecai/puiblic/attivita/singolo/' . $attivita->id, '', true, 150);

        // Add content
        $stringa = $attivita->descrizione;
        $html = "<h1>{$attivita->titolo}</h1>";
        $html .= "<p><strong>Descrizione:</strong> ". $stringa ."</p>";

        $html .= '<table>';
        $counter = 0;
        foreach ($fields as $label => $value) {
            if ($counter % 2 == 0) {
            $html .= '<tr>';
            }
            $html .= "<td><strong>{$label}:</strong> {$value}</td>";
            if ($counter % 2 == 1) {
            $html .= '</tr>';
            }
            $counter++;
        }
        if ($counter % 2 != 0) {
            $html .= '</tr>';
        }
        $html .= '</table>';

        $pdf->writeHTML($html_img, true, false, true, false, '');

        $pdf->writeHTML($html, true, false, true, false, '');

    /*   $htmlInstructions = '<div style="text-align:center; margin-top:20px;">
       <p>Per chiudere questo documento, utilizzare il pulsante di chiusura del visualizzatore PDF.</p>
          </div>';
            $pdf->writeHTML($htmlInstructions, true, false, true, false, '');
    */
        // Output PDF document
        $pdf->Output('attivita.pdf', 'I');
        // Add a close button
       
    }

    public function incrementa_clic($id)
    {

        $attivita       = Attivita::find($id);
        $clic           = $attivita->clic;
        $attivita->clic = $clic + 1;
        $attivita->save();
        return redirect()->back();
    }

    public function rimuoviTagHtml($stringa)
    {
        return preg_replace('/<[^>]*>/', '', $stringa);
    }
}
