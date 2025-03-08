<?php
namespace App\Http\Controllers;

use App\Models\Attivita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttivitaController extends Controller
{
    /**
     * Gestione comune attivita sia con pdf autogenerato (form) che con pdf preparato (formb)
     * Summary of importa
     * @return void
     */
    public function index(Request $request, $dataOggi = null, $categoria): \Illuminate\Contracts\View\View
    {
        $dataOggi             = $dataOggi ?? now()->format('Y-m-d'); // Usa la data di oggi se non è fornita
        $viewData             = [];
        $dataOggius           = Carbon::createFromFormat("d-m-Y", $dataOggi)->format("Y-m-d");
        $viewData['dataoggi'] = $dataOggi;
        $user                 = Auth::user();
        $anno                 = now()->year;
        $anno_attivita        = Carbon::parse($dataOggius)->year;
        //$user = User::find(1);
        // $rol = $user->role;
        // Cache::flush();

        // seleziona tipo_attivita 99 = tutti, $categoria = tipo_attivita
        if ($categoria == 99) {
            // se utente non login o se login come utente
            if ($user == null || $user == 'utente') {
                $viewData['attivita'] = Attivita::where('published', 1)
                    ->where(function ($query) use ($dataOggius) {
                        $query->where(function ($query) use ($dataOggius) {
                            $query->where('calendario', 0)
                                ->whereDate('data_inizio', '>=', $dataOggius);
                        })->orWhere(function ($query) use ($dataOggius) {
                            //$query->where('tipo_attivita', 2)// calendario
                            $query->where('calendario', '>=', 1)
                                ->whereDate('data_fine', '>=', $dataOggius);
                        });
                    })
                // ->whereRaw('LENGTH(titolo) > 2')
                // ->whereRaw('LENGTH(descrizione) > 3')
                    ->get();
            } else {
                if ($user->is_admin == 1 || $user->role == 'editor') {
                    $viewData['attivita'] = Attivita::where('published', 1)
                        ->where(function ($query) use ($dataOggius) {
                            $query->where(function ($query) use ($dataOggius) {
                                $query->where('calendario', 0)
                                    ->whereDate('data_inizio', '>=', $dataOggius);
                            })->orWhere(function ($query) use ($dataOggius) {
                                //$query->where('tipo_attivita', 2)// calendario
                                $query->where('calendario', '>=', 1)
                                    ->whereDate('data_fine', '>=', $dataOggius);
                            });
                        })
                        ->get();
                }
            }

// tutte le attivita
        } elseif ($categoria != 0) {
            // se categoria scelta da home trekking, corsi, ecc..
            if ($user == null || $user == 'utente') {
                $viewData['attivita'] = Attivita::where('published', 1)
                    ->where('tipo_attivita', $categoria)
                    ->where(function ($query) use ($dataOggius) {
                        // usa data_inizio per filtrare le attivita da visualizzare
                        $query->where(function ($query) use ($dataOggius) {
                            $query->where('calendario', 0)
                                ->whereDate('data_inizio', '>=', $dataOggius);
                        })->orWhere(function ($query) use ($dataOggius) {
                            //$query->where('tipo_attivita', 2)
                            // usa data_fine se il campo 'calendario' contiene 1
                            $query->where('calendario', '>=', 1)
                                ->whereDate('data_fine', '>=', $dataOggius);
                        });
                    })
                    ->get();

            } else {
                // se amminstratore ecc..
                if ($user->is_admin == 1 || $user->role == 'editor') {
                    $viewData['attivita'] = Attivita::where('published', 1)
                        ->where('tipo_attivita', $categoria)
                        ->where(function ($query) use ($dataOggius) {
                            // usa data_inizio per filtrare le attivita da visualizzare
                            $query->where(function ($query) use ($dataOggius) {
                                $query->where('calendario', 0)
                                    ->whereDate('data_inizio', '>=', $dataOggius);
                            })->orWhere(function ($query) use ($dataOggius) {
                                //$query->where('tipo_attivita', 2)
                                // usa data_fine se il campo 'calendario' contiene 1
                                $query->where('calendario', '>=', 1)
                                    ->whereDate('data_fine', '>=', $dataOggius);
                            });
                        })
                        ->get();
                }
            }
        } else {
            // visualizza solo i calendari
            if ($user == null || $user == 'utente') {
                $viewData['attivita'] = Attivita::where('published', 1)
                    ->where(function ($query) {
                        // calendari tipo 1 e 2
                        $query->where('calendario', '>=', 1);

                    })
                // solo se il calendario finisce nell'anno attuale
                    ->where(function ($query) use ($dataOggius) {
                        $query->whereYear('data_fine', now()->year);
                    })
                // ->whereRaw('LENGTH(titolo) > 2')
                // ->whereRaw('LENGTH(descrizione) > 3')
                    ->get();
            } else {
                // se amminstratore ecc..
                $viewData['attivita'] = Attivita::where('published', 1)
                    ->where('tipo_attivita', $categoria)
                    ->get();
            }
        }

        return view('attivita.index')->with("viewData", $viewData);
    }

// funzione index altenativa da finire e provare (tutti i nomi che finiscono per _x sono provvisori e si possono cancellare)
    public function index_x(Request $request, $dataOggi = null, $categoria): \Illuminate\Contracts\View\View
    {
        $dataOggi             = $dataOggi ?? now()->format('Y-m-d'); // Usa la data di oggi se non è fornita
        $viewData             = [];
        $dataOggius           = Carbon::createFromFormat("d-m-Y", $dataOggi)->format("Y-m-d");
        $viewData['dataoggi'] = $dataOggi;
        $user                 = Auth::user();
        // tutti da data di oggi inzio o fine se calndari
        if ($categoria == 99) {
            $viewData['attivita'] = Attivita::where('published', 1)
                ->where(function ($query) use ($dataOggius) {
                    $query->where(function ($query) use ($dataOggius) {
                        $query->where('calendario', 0)
                            ->whereDate('data_inizio', '>=', $dataOggius);
                    })->orWhere(function ($query) use ($dataOggius) {
                        $query->whereIn('calendario', [1, 2])
                            ->whereDate('data_fine', '>=', $dataOggius);
                    });
                })
                ->get();

        } else {

        }

        return view('attivita.index')->with("viewData", $viewData);
    }

    public function singolo($id)
    {
        $viewData             = [];
        $viewData['attivita'] = Attivita::find($id);
        return view('attivita.singolo')->with("viewData", $viewData);
    }

    public function list()
    {
        $viewData             = [];
        $viewData['attivita'] = Attivita::all();
        return view('attivita.list')->with("viewData", $viewData);
    }

    /**
     *Richiama l'editore per la modifica di un'attività
     */
    public function edit($id, $tipo)
    {

        $viewData             = [];
        $attivita             = Attivita::find($id);
        $tipovolantino        = $attivita->tipo_volantino;
        $viewData['attivita'] = Attivita::find($id);

        if ($tipo == 2) { // se tipo 2 autogenerato
            return view('attivita/edit_attivita_vol_autogenerato')->with("viewData", $viewData);
        } elseif ($tipo == 1) { // se tipo 1 preparato
            return view('attivita/edit_attivita_vol_linkesterno')->with("viewData", $viewData);
        } elseif ($tipo == 0) { // se tipo 1 preparato
            return view('attivita/edit_attivita_vol_interno')->with("viewData", $viewData);

        } else {
            return redirect()->back()->withErrors(['error' => 'Tipo attivita non trovato']);
        }
    }

    public function published($id)
    {
        $viewData = [];
        $attivita = Attivita::find($id);

        if ($attivita->published == 0) {
            $attivita->published = 1;
        } else {
            $attivita->published = 0;
        }
        $attivita->save();
        $viewData['attivita'] = Attivita::all();
        return view('attivita/list')->with("viewData", $viewData);
    }

    /**
     * Aggiorna 
     */

    public function save_edit(Request $request, $id)
    {

        $request->validate([
            //'pdf_file' => 'required|file|mimes:pdf|max:2548', // max 2MB
            // 'image_file' => 'required|file|mimes:pdf|max:2548', // max 2MB
        ]);
        $validatedData = $request->validate([
            'titolo' => 'required|string|max:255',
            // 'massimo' => 'required',
            // 'data_inizio' => 'required|date',
            //  'data_fine' => 'required|date',
            // 'tipo_volantino' => 'required',
            // 'tipo_iscrizione' => 'required',
            // 'pdf_file' => 'required',
            // 'image_file' => 'required|file|max:2548', // max 2MB
        ], [
            'titolo.required' => 'Il campo Titolo è obbligatorio',
            // 'massimo' => 'E\' necessario imnserire un valore massimo di patecipanti',
            // 'data_inizio' => 'La data di di inizio è obbligatoria',
            // 'data_fine' => 'La data di fine è obbligatoria, puo essere uguale a inizio',
            // 'tipo_iscrizione' => 'tipo iscrizione è richiesto',
            //  'tipo_volantino' => 'tipo di volantino è richiesto',
            // 'pdf_file' => 'il pdf è richiesto',
            // 'image_file' => 'Immagine richiesta max:2548', // max 2MB
        ]);

        $escursio = Attivita::find($id);

        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            //$image_path = $image->store('public/imgtrek');
            $pdf_path           = $pdf->storeAs('public/pdftrek', $pdf->getClientOriginalName());
            $viewData['pdf']    = ['image_path' => $pdf_path, 'image' => $pdf->getClientOriginalName()];
            $escursio->pdf_file = $pdf->getClientOriginalName();
        } else {
            $viewData['pdf'] = $escursio->pdf_file;
        }

        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            //$image_path = $image->store('public/imgtrek');
            $image_path           = $image->storeAs('public/imgtrek', $image->getClientOriginalName());
            $viewData['image']    = ['image_path' => $image_path, 'image' => $image->getClientOriginalName()];
            $escursio->image_file = $image->getClientOriginalName();
        } else {
            $viewData['image'] = $escursio->image_file;
        }

                                            // $fine = Carbon::createFromFormat('Y-m-d', $request->data_fine)->format('d-m-Y');
        $dataOggi = now()->format('Y-m-d'); // Usa la data di oggi se non è fornita

        if ($request->data_inizio == null) {
            $request->data_inizio = $dataOggi;
        }
        $escursio->data_fine = $request->data_fine;

        if ($request->inizio_iscrizioni == null) {
            $request->inizio_iscrizioni = $dataOggi;
        }
        $escursio->inizio_iscrizioni = $request->inizio_iscrizioni;
        if ($request->fine_iscrizioni == null) {
            $request->fine_iscrizioni = $request->data_inizio;
        }
        $escursio->fine_iscrizioni = $request->fine_iscrizioni;
        $escursio->titolo          = $request->titolo;
        if (isset($viewData['pdf']['image'])) {
            $escursio->pdf_file = $viewData['pdf']['image'];
        }
        if ($request->tipo_volantino !== null) {
            $escursio->tipo_volantino = $request->tipo_volantino;
        }
        if ($request->link_volantino !== null) {
            $escursio->link_volantino = $request->link_volantino;
        }
        if ($request->descrizione !== null) {
            $escursio->descrizione = $request->descrizione;
        }
        if ($request->note !== null) {
            $escursio->note = $request->note;
        }
        if ($request->tipo_attivita !== null) {
            $escursio->tipo_attivita = $request->tipo_attivita;
        }
        if ($request->tipo_iscrizione !== null) {
            $escursio->tipo_iscrizione = $request->tipo_iscrizione;
        }

        if ($request->link_modulo_esterno !== null) {
            $escursio->link_modulo_esterno = $request->link_modulo_esterno;
        }

        if ($request->specializzazione !== null) {
            $escursio->specializzazione = $request->specializzazione;
        }
        if ($request->qualifica !== null) {
            $escursio->qualifica = $request->qualifica;
        }
        if ($request->numeromassimo !== null) {
            $escursio->numeromassimo = $request->numeromassimo;
        }
        if ($request->numerominimo !== null) {
            $escursio->numerominimo = $request->numerominimo;
        }
        if ($request->tipo_iscrizione !== null) {
            $escursio->tipo_iscrizione = $request->tipo_iscrizione;
        }
        if ($request->contatti !== null) {
            $escursio->contatti = $request->contatti;
        }
        if ($request->luogoritrovo !== null) {
            $escursio->luogoritrovo = $request->luogoritrovo;
        }
        if ($request->oraritrovo !== null) {
            $escursio->oraritrovo = $request->oraritrovo;
        }
        if ($request->data_inizio !== null) {
            $escursio->data_inizio = $request->data_inizio;
        }
        if ($request->data_fine !== null) {
            $escursio->data_fine = $request->data_fine;
        }
        if ($request->durata !== null) {
            $escursio->durata = $request->durata;
        }
        if ($request->quotaminima !== null) {
            $escursio->quotaminima = $request->quotaminima;
        }
        if ($request->quotamassima !== null) {
            $escursio->quotamassima = $request->quotamassima;
        }
        if ($request->dislivello !== null) {
            $escursio->dislivello = $request->dislivello;
        }
        if ($request->lunghezza !== null) {
            $escursio->lunghezza = $request->lunghezza;
        }
        if ($request->portage !== null) {
            $escursio->portage = $request->portage;
        }
        if ($request->calendario !== null) {
            $escursio->calendario = $request->calendario;
        }
        if ($request->difficolta !== null) {
            $escursio->difficolta = $request->difficolta;
        }
        if ($request->user_email !== null) {
            $escursio->user_email = $request->user_email;
        }
        if ($request->published !== null) {
            $escursio->published = $request->published;
        }
        $escursio->save();

        $viewData              = [];
        $viewData['attivita']  = Attivita::where('published', '!=', 0)->get();
        $viewData['published'] = ['1' => 'Abilitato', '0' => 'Escluso'];
        // Salvare il percorso dell'immagine nel database o passarlo alla vista
        //return view('attivita/list')->with("viewData", $viewData);
        return redirect('/');
    }

    public function cerca(Request $request, $ritorno)
    {
        $cerca                = $request->input('cerca'); // Logica per cercare l'attività basata sul valore di $cerca
        $trova                = Attivita::where('titolo', 'LIKE', "%{$cerca}%")->get();
        $viewData["attivita"] = $trova;
        if ($ritorno == 'list') {
            return view('attivita/list')->with("viewData", $viewData);
        } else {
            $dataO      = Carbon::now()->toDateString();
            $dataOggiit = Carbon::createFromFormat("Y-m-d", $dataO)->format("d-m-Y");
            // return view('attivita/index')->with("viewData", $viewData);
            $viewData['dataoggi'] = $dataOggiit;

            return view('attivita.index')->with("viewData", $viewData);
        }

    }

    public function show_descrizione($id)
    {
        $viewData             = [];
        $viewData['attivita'] = Attivita::find($id);
        return view('attivita.summernoteEditor')->with("viewData", $viewData);
    }

    public function update_descrizione(Request $request, $id)
    {
        $attivita              = Attivita::find($id);
        $attivita->descrizione = $request->descrizione;
        $attivita->save();

        // se tipo volantino autogenerato
        /*  $pdfController = new PDFController();
        $pdfController->crea_pdf_attivita($id);
        // recupera  record  salvato
        $escursio = Attivita::find($id);
        // salva nome pdf
        $escursio->pdf_file = 'attivita_id' . $escursio->id . '.pdf';
        $escursio->save();
*/
        return redirect()->back()->with('success', 'Descrizione aggiornata con successo');
    }

    public function destroy($id)
    {

        $attivita = Attivita::find($id);
        if ($attivita) {
            $attivita->delete();
        } else {
            return redirect()->back()->withErrors(['error' => 'Attività non trovata']);
        }

        $viewData             = [];
        $viewData['attivita'] = Attivita::where('published', '!=', 0)->get();
        return view('attivita.list')->with("viewData", $viewData);
        //return redirect('/');
    }

    public function get_from_dbcai()
    {
        // Connessione al database esterno
        //$externalDbConnection = DB::connection('mysql_external'); // Recupero dei dati dalla tabella 'eventos' del database esterno
        // $viewData             = $externalDbConnection->table('eventos')->where('id', '>=', 856)->get();
        $viewData = DB::table('rino4_evetrek_eventos')->where('id', '>=', 855)->get();

        foreach ($viewData as $data) {
            if (Carbon::parse($data->znminizio)->lt(now())) {
                continue;
            }
            if (Attivita::where('titolo', $data->title)->exists()) {
                continue;
            }
            $attivita         = new Attivita;
            $attivita->titolo = $data->title;
            if ($data->descrizione != null) {
                $attivita->descrizione = $data->descrizione;
            } else {
                $attivita->descrizione = " ";
            }
            $attivita->data_inizio    = $data->znminizio;
            $attivita->data_fine      = $data->datafineus;
            $attivita->tipo_attivita  = $data->catidev;
            $attivita->tipo_volantino = 0;
            if ($data->tipo_iscriz != null) {
                $attivita->tipo_iscrizione = $data->tipo_iscriz;
            } else {
                $attivita->tipo_iscrizione = 1;
            }
            $attivita->image_file = basename($data->imagebox);
            $attivita->pdf_file   = basename($data->banner);

            $attivita->published = 0;
            $attivita->save();

            import_images_from_web($data->imagebox);
            import_pdf_from_web($data->banner);
        }

        return redirect()->back()->with('success', 'Dati importati con successo');
    }
    public function get_programma($id)
    {
        $viewData             = [];
        $viewData['attivita'] = Attivita::find($id);

        return view('attivita/programma')->with("viewData", $viewData);
    }
}
function import_images_from_web($url)
{
    $url           = 'https://caibo.it/' . $url;
    $imageContents = file_get_contents($url);
    $imageName     = basename($url);
    $imagePath     = 'public/imgtrek/' . $imageName;

    if (Storage::put($imagePath, $imageContents)) {
        return null;
    }
}

function import_pdf_from_web($url)
{
    $url         = 'https://caibo.it/' . $url;
    $pdfContents = file_get_contents($url);
    $pdfName     = basename($url);
    $pdfPath     = 'public/pdftrek/' . $pdfName;

    if (Storage::put($pdfPath, $pdfContents)) {
        return null;
    }

    function import_images_from_web($url)
    {
        $url           = 'https://caibo.it/' . $url;
        $imageContents = file_get_contents($url);
        $imageName     = basename($url);
        $imagePath     = 'public/imgtrek/' . $imageName;

        if (Storage::put($imagePath, $imageContents)) {
            return null;
        }
    }

}
