<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PDFController;
use App\Models\Attivita;
use App\Models\CaiSezioni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ExcelController extends Controller
{

    public function form_excel()
    {

        /**
         *  Documentation - richiama form per caricare dati soci da excel
         * passa alla form $viewData["tipo"]
         */
        $viewData = [];
        $viewData["title"] = "Import Area Codici Gestionali";
        $viewData["tipo"] = "import_area_codici";

        return view('excel.form_excel')->with("viewData", $viewData);

    }

    public function form_import_sezioni()
    {
        /**
         *  Documentation - richiama form per caricare dati  da excel
         * passa alla form $viewData["tipo"]
         */
        $viewData = [];
        $viewData["title"] = "Import ";
        $viewData["tipo"] = "import_sezioni";

        return view('excel.form_load_excel_sezioni')->with("viewData", $viewData);

    }

    public function importexcel_sezioni_cai(Request $request)
    {

        $the_file = $request->file('uploaded_file');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();

            $row_range = range(1, $row_limit);

            DB::table('cai_sezionis')->truncate();

            $code = 0;
            foreach ($row_range as $row) {
                $id = $sheet->getCell('A' . $row)->getValue();
                $sez = $sheet->getCell('B' . $row)->getValue();
                if ($id !== null) {
                    $sezione = new CaiSezioni;
                    $sezione->id = $id;
                    $sezione->nome = $sez;
                    $sezione->published = 1;
                    $sezione->save();

                }
            }

            // -------------------- -------------------------------------
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->route('form_import_sezioni')->with('success', 'I dati A sono stati caricati.');

    }

    /*  public function __construct()
    {
    // Enable Xdebug
    if (function_exists('xdebug_break')) {
    xdebug_break();
    }
    }
     */
    /**
     *
     * importexcel_attivita da foglio excel su google drive proposte attivita dalle form google
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function importexcel_attivita(Request $request)
    {

        $the_file = $request->file('uploaded_file');

        $attivita_esi = Attivita::all();
        $titoli = $attivita_esi->pluck('titolo');
        $titoliArray = $titoli->toArray();

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $row_range = range(4, $row_limit);

            // Read the row number
            /*   foreach ($row_range as $row) {
            $row_number = $row;
            // You can use $row_number as needed
            }
             */

            $ids_range = explode(',', $request->ids);

            foreach ($row_range as $row) {
                $row_number = $row;
                $id = $sheet->getCell('A' . $row)->getValue();
               // foreach ($ids_range as $ids) {
                    if ($row_number >= $ids_range[0]  && $row_number <= $ids_range[1]) {

                        $titolo = $sheet->getCell("E{$row}")->getValue();
                         // verifica se il titolo esiste già nel database
                        if (!in_array($titolo, $titoliArray)) {
                            $dd = trim($sheet->getCell('B' . $row)->getFormattedValue()); 

                            $data_inizio = trim($sheet->getCell("C{$row}")->getFormattedValue());
                            if (\DateTime::createFromFormat('d/m/Y', $data_inizio) !== false) {
                                $data_inizio = \DateTime::createFromFormat('d/m/Y', $data_inizio)->format('Y-m-d');
                            } else {
                                $data_inizio = null;
                            }
                            
                            $data_fine = trim($sheet->getCell("D{$row}")->getFormattedValue());
                            if (\DateTime::createFromFormat('d/m/Y', $data_fine) !== false) {
                                $data_fine = \DateTime::createFromFormat('d/m/Y', $data_fine)->format('Y-m-d');
                            } else {
                                $data_fine = $data_inizio;
                            }
                            
                            $inizio_iscrizioni = trim($sheet->getCell("B{$row}")->getFormattedValue());
                            if (\DateTime::createFromFormat('d/m/Y', $inizio_iscrizioni) !== false) {
                                $inizio_iscrizioni = \DateTime::createFromFormat('d/m/Y', $inizio_iscrizioni)->format('Y-m-d');
                            } else {
                                $inizio_iscrizioni = null;
                            }

                            
                                $descrizione = trim($sheet->getCell('F' . $row)->getFormattedValue());

                                $fine_iscrizioni = trim($sheet->getCell("G{$row}")->getFormattedValue());
                                if (\DateTime::createFromFormat('d/m/Y', $fine_iscrizioni) !== false) {
                                    $fine_iscrizioni = \DateTime::createFromFormat('d/m/Y', $fine_iscrizioni)->format('Y-m-d');
                                } else {
                                    $fine_iscrizioni = null;
                                }
// Check if data_inizio is greater than or equal to the current date
if ($data_inizio >= date('Y-m-d')) {
                                $raccolta_iscrizioni = trim($sheet->getCell("H{$row}")->getFormattedValue());
                                $tipo_iscrizioni = trim($sheet->getCell("I{$row}")->getFormattedValue());
                                $link_iscrizioni = trim($sheet->getCell("J{$row}")->getFormattedValue());

                                $nome = trim($sheet->getCell("K{$row}")->getFormattedValue());
                                $cognome = trim($sheet->getCell("L{$row}")->getFormattedValue());
                                $gruppo = trim($sheet->getCell('M' . $row)->getFormattedValue());
                                $email = trim($sheet->getCell("N{$row}")->getFormattedValue());
                                $telefono = trim($sheet->getCell("O{$row}")->getFormattedValue());
                                $qualifica = trim($sheet->getCell("P{$row}")->getFormattedValue());
                                $specializzazione = trim($sheet->getCell("Q{$row}")->getFormattedValue());
                                $altri_organizzatori = trim($sheet->getCell("R{$row}")->getFormattedValue());

                                $tipo_attivita = trim($sheet->getCell("S{$row}")->getFormattedValue());

                                $difficolta = trim($sheet->getCell("U{$row}")->getFormattedValue());
                                $difficolta_giovanile = trim($sheet->getCell("T{$row}")->getFormattedValue());

                                $durata = trim($sheet->getCell("AA{$row}")->getFormattedValue());
                                $dislivello = trim($sheet->getCell("AB{$row}")->getFormattedValue());
                                $quota_minima = trim($sheet->getCell("AC{$row}")->getFormattedValue());
                                $quota_massima = trim($sheet->getCell("AD{$row}")->getFormattedValue());

                                $lunghezza = trim($sheet->getCell("AE{$row}")->getFormattedValue());
                                $dislivello = trim($sheet->getCell("AF{$row}")->getFormattedValue());
                                $quota_minima = trim($sheet->getCell("AG{$row}")->getFormattedValue());
                                $quota_massima = trim($sheet->getCell("AH{$row}")->getFormattedValue());
                                $tratti_spinta = trim($sheet->getCell("AI{$row}")->getFormattedValue());

                                $portage = trim($sheet->getCell("AJ{$row}")->getFormattedValue());
                                $numero_minimo = trim($sheet->getCell("AK{$row}")->getFormattedValue());
                                $numero_massimo = trim($sheet->getCell("AL{$row}")->getFormattedValue());
                                $ammissione = trim($sheet->getCell("AM{$row}")->getFormattedValue());
                                $altri_costi = trim($sheet->getCell("AN{$row}")->getFormattedValue());

                                $tipo_trasporto = trim($sheet->getCell("AO{$row}")->getFormattedValue());
                                $ora_ritrovo = trim($sheet->getCell("AP{$row}")->getFormattedValue());
                                $luogo_ritrovo = trim($sheet->getCell("AQ{$row}")->getFormattedValue());
                                $luogo_ritrovo = trim($sheet->getCell("AR{$row}")->getFormattedValue());

                                $attrezzatura_specifica = trim($sheet->getCell('AW' . $row)->getFormattedValue());
                                $fotografie = trim($sheet->getCell('AX' . $row)->getFormattedValue());
                                $traccia_gpx = trim($sheet->getCell('AY' . $row)->getFormattedValue());

                                $attivita = new Attivita;
                                $attivita->fill([
                                    $attivita->nome = $nome,
                                    $attivita->cognome = $cognome,
                                    $attivita->qualifica = $qualifica,
                                    $attivita->altro = $altri_organizzatori,
                                    $attivita->email = $email,
                                    $attivita->telefono = $telefono,
                                    $attivita->titolo = $titolo,
                                    $attivita->descrizione = $descrizione,
                                    $attivita->socio = $ammissione,
                                    $attivita->tipo_volantino = 2,

                                    // $attivita->pdf_file =  ;
                                    $attivita->image_file = 'Logo-CAI.webp',
                                    $attivita->data_inizio = $data_inizio,
                                    $attivita->data_fine = $data_fine,
                                    $attivita->inizio_iscrizioni = $inizio_iscrizioni,
                                    $attivita->fine_iscrizioni = $fine_iscrizioni,

                                    $attivita->tipo_iscrizione = convert_tipo_iscrizioni($tipo_iscrizioni),
                                    $attivita->tipo_attivita = convert_tipo_attivita($tipo_attivita),
                                    $attivita->specializzazione = convert_specializzazione($specializzazione),
                                    $attivita->link_modulo_esterno = $link_iscrizioni,
                                   
                                    $attivita->data_fine = $data_fine,
                                    $attivita->difficolta = convert_difficolta($difficolta),
                                    $attivita->durata = intval($durata),
                                    $attivita->dislivello = intval($dislivello),
                                    $attivita->quotaminima = intval($quota_minima),
                                    $attivita->quotamassima = intval($quota_massima),
                                    $attivita->numeromassimo = intval($numero_massimo),
                                    $attivita->numerominimo = intval($numero_minimo),
                                    $attivita->tipologiatrasporto = $tipo_trasporto,
                                    $attivita->oraritrovo = $ora_ritrovo,
                                    $attivita->luogoritrovo = $luogo_ritrovo,
                                    $attivita->altricosti = $altri_costi,
                                    $attivita->altriorganizzatori = $altri_organizzatori,
                                    $attivita->linkluogo = null,
                                    $attivita->a_spinta = $tratti_spinta,
                                    $attivita->portage = $portage,
                                    $attivita->lunghezza = $lunghezza,
                                    $attivita->order = $row_number,
                                   // $attivita->presentazione = $data_presentazione,
                                   
                                    //$attivita->data_presentazione = null;
                                    //$attivita->link_volantino = null;
                                   //$attivita->contatti = null;
                                   //$attivita->canale = null;
                                ]);
                                $attivita->tipo_iscrizione = 3;
                                $attivita->published = 0;
                                $attivita->save();
                                $nome_pdf = "attivita_id{$attivita->id}.pdf";
                                $attivita = Attivita::find($attivita->id);
                                $attivita->pdf_file = $nome_pdf;
                                $attivita->save();

                                $pdfController = new PDFController();
                                $pdfController->crea_pdf_attivita($attivita->id);
                            }
                        }
                    }
              //  }
            }

            // -------------------- -------------------------------------
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->route('form_excel')->with('success', 'I dati A sono stati caricati.');
    }
}

function convert_data($data)
{

    $anno = substr($data, 6, 4);
    if ($anno != '') {
        $mese = substr($data, 3, 2);
        $giorno = substr($data, 0, 2);
        return $anno . '-' . $mese . '-' . $giorno;
    } else {
        return null;
    }
}

function convert_tipo($tipo)
{
    $tipoc = substr($tipo, 0, 2);
    return $tipoc;
}

function convert_tipo_attivita($tipo)
{
    $tipoc = substr($tipo, 0, 2);
    return '1'; //$tipoc;
}
function convert_tipo_iscrizioni($tipo)
{
    $tipoc = substr($tipo, 0, 2);
    switch ($tipoc) {
        case "T":
            return 0;
        case "E":
            return 1;
        case "EE":
            return 2;
        case "EEA":
            return 3;
        default:
            return null;
    }
   
}
function convert_difficolta($tipo)
{
    $tipoc = substr($tipo, 0, 3);

    switch ($tipoc) {
        case "T":
            return 0;
        case "E":
            return 1;
        case "EE":
            return 2;
        case "EEA":
            return 3;
        default:
            return null;
    }

}

function convert_specializzazione($tipo)
{
    $tipoc = substr($tipo, 0, 3);

    switch ($tipoc) {
        case "EEA":
            return 0;
        case "EAI":
            return 1;
        case "Altro":
            return 2;
        default:
            return null;
    }

}
