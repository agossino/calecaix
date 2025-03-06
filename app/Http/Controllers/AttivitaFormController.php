<?php
namespace App\Http\Controllers;

use App\Models\Attivita;
use App\Models\TipoScelteInterne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * CREA ATTIVITA   VOLANTINO autogenerato dai parametri inseriti
 * Gestione form attivita con autocreazione volantino pdf
 */
class AttivitaFormController extends Controller
{

    // --------------- page 1 ---------------------
    // richiamo visualizza  form
    public function showPage1()
    {
        return view('form.page1');
    }

    /**
     * Memorizza i dati della prima pagina del form
     * e visualizza la pagina successiva
     *
     * pagine volantino
     * 0=volantino interno
     *1
     *1b
     *1c
     *2
     *3
     *3b no
     *6
     *7
     *8 no
     *9 no
     *save

     * 1=volantino con link esterno
     *1
     *1b
     *1c
     *2
     *3
     *3b no
     *6
     *7
     *8 no
     *9
     *save

     * 2=volantino autogenerato
     *1
     *1b
     *1c
     *2
     *3
     *3b
     *6
     *7 no
     *8
     *9 no
     *save
     */
    public function postPage1(Request $request)
    {
        $request->validate([
            /*  'tipo_volantino' => 'required|array|min:1',
            'tipo_socio' => 'required|array|min:1',
            'tipo_attivita' => 'required|array|min:1',
            'tipo_iscrizione' => 'required|array|min:1',
            */
        ]);

        // crea session di tutti dati della form
        session(['page1' => $request->all()]);

        session()->put('tipo_volantino', $request->tipo_volantino);

        // visualizza pagina successiva
        return redirect('/form/page1b');

    }

    public function showPage1b()
    {
        return view('form.page1b');
    }

    public function postPage1b(Request $request)
    {
        $request->validate([
            /*  'tipo_volantino' => 'required|array|min:1',
            'tipo_socio' => 'required|array|min:1',
            'tipo_attivita' => 'required|array|min:1',
            'tipo_iscrizione' => 'required|array|min:1',
            */
        ]);

        // crea session di tutti dati della form
        session(['page1b' => $request->all()]);

        session()->put('tipo_socio', $request->tipo_socio);
        session()->put('tipo_attivita', $request->tipo_attivita);
        session()->put('tipo_iscrizione', $request->tipo_iscrizione);

        // visualizza pagina successiva
        return redirect('/form/page1c');

    }

    public function showPage1c()
    {
        return view('form.page1c');
    }

    public function postPage1c(Request $request)
    {
        $request->validate([
            /*  'tipo_volantino' => 'required|array|min:1',
            'tipo_socio' => 'required|array|min:1',
            'tipo_attivita' => 'required|array|min:1',
            'tipo_iscrizione' => 'required|array|min:1',
            */
        ]);

        // crea session di tutti dati della form
        session(['page1c' => $request->all()]);

        session()->put('tipo_socio', $request->tipo_socio);

        // visualizza pagina successiva
        return redirect('/form/page2');

    }

    // --------------- page 2 ---------------------
    public function showpage2()
    {
        return view('form.page2');
    }

    public function postpage2(Request $request)
    {

        //dd($request->all());
        $request->validate([

        ]);

        session(['page2' => $request->all()]);

        // visualizza pagina successiva
        return redirect('/form/page3');
    }

    // --------------- page 3_ ---------------------
    public function showPage3()
    {
        return view('form.page3');
    }

    public function postPage3(Request $request)
    {

        $idt = session()->get('tipo_volantino');
        $request->validate([

        ]);

        session(['page3' => $request->all()]);

        if ($idt[0] == 2) {
            return redirect('/form/page3b');
        } elseif ($idt[0] == 0 || $idt[0] == 1) {
            return redirect('/form/page6');
        }

    }

    // --------------- page 3b ---------------------
    public function showPage3b()
    {
        return view('form.page3b');
    }

    public function postPage3b(Request $request)
    {

        $idt = session()->get('tipo_volantino');
        $request->validate([

        ]);

        session(['page3b' => $request->all()]);

        if ($idt[0] == 2) {
            return redirect('/form/page4');
        } elseif ($idt[0] == 0 || $idt[0] == 1) {
            return redirect('/form/page6');
        }

    }

    // --------------- page 4 ------- Caratteristiche del percorso --------------
    public function showPage4()
    {
        return view('/form/page4');
    }

    public function postPage4(Request $request)
    {
        $request->validate([

        ]);

        session(['page4' => $request->all()]);

        $calendario = $request->input('calendario');

        // visualizza pagina successiva
        $tidv = session()->get('tipo_volantino');
        if ($tidv[0] == 0 || $tidv[0] == 1) {
            return redirect('/form/page6');
        } else {
            return redirect('/form/page5');
        }
    }

    // --------------- page 5 -----------Ritrovo Trasporto ----------
    public function showPage5()
    {

        return view('/form/page5');

    }

    public function postPage5(Request $request)
    {
        $request->validate([

        ]);

        session(['page5' => $request->all()]);
        return redirect('/form/page6');
    }

    // --------------- page 6 -------- Editor  Descrizione attività -------------
    public function showPage6()
    {

        return view('/form/page6');

    }

    public function postPage6(Request $request)
    {
        $request->validate([
            'image_file' => 'required|image',
        ]);

        $image     = $request->file('image_file');
        $imageName = $image->getClientOriginalName();

        // Ridimensiona l'immagine a 400x300 pixel
        $resizedImage = Image::make($image)->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Memorizza il nome dell'immagine nella sessione
        session(['image_name' => $imageName]);

        // Memorizza temporaneamente l'immagine ridimensionata
        $resizedImage->save(storage_path('app/temp/' . $imageName));

        $tidv = session()->get('tipo_volantino', []);
        if (isset($tidv[0]) && ($tidv[0] == 0 || $tidv[0] == 1)) {
            return redirect('/form/page7');
        } else {
            return redirect('/form/page8');
        }
    }

//------------------- Page 7 --------
    public function showPage7()
    {
        return view('form.page7');
    }

    public function postpage7(Request $request)
    {
        $tidv   = session()->get('tipo_volantino');
        $iscriz = session()->get('tipo_iscrizione');

        switch ($tidv[0]) {
            case '0':
                $request->validate([
                    'pdf_file' => 'required',
                ]);

                $pdf     = $request->file('pdf_file');
                $pdfName = $pdf->getClientOriginalName();

                // Memorizza il nome dell'immagine nella sessione
                session(['pdf_name' => $pdfName]);

                // Memorizza temporaneamente l'immagine
                $pdf->storeAs('temp', $pdfName);

                if ($iscriz[0] == '3') { // modulo esternoS
                    return redirect('/form/page9');
                } else {
                    return redirect('/form/pageSave');
                }

            case '1':
                if ($iscriz[0] == '3') { // modulo esternoS
                    return redirect('/form/page9');
                } else {
                    return redirect('/form/pageSave');
                }

            case '2':
                return redirect('/form/page8');

        }
    }

    // --------------- page 8 -------- Save-------------
    public function showPage8()
    {
        return view('/form/page8');
    }

    public function postPage8(Request $request)
    {
        $request->validate([

        ]);

        $tidv   = session()->get('tipo_volantino');
        $iscriz = session()->get('tipo_iscrizione');

        session(['page8' => $request->all()]);
        if ($iscriz[0] == '3') { // modulo esternoS
            return redirect('/form/page9');
        } else {
            return redirect('/form/pageSave');
        }

    }

    // --------------- page 9 ---------------------
    public function showPage9()
    {
        return view('/form/page9');
    }

    public function postPage9(Request $request)
    {
        $request->validate([

        ]);

        session(['page9' => $request->all()]);
        return redirect('/form/pageSave');
    }

    // --------------- page 10 -------- Esclusa attivare se serve-------------
    public function showPage10()
    {
        return view('/form/page10');
    }

    public function postPage10(Request $request)
    {
        $request->validate([

        ]);

        session(['page10' => $request->all()]);
        return redirect('/form/pageSave');
    }

    // --------------- page 10 -------- Save-------------
    public function PageSave()
    {
        return view('/form/pageSave');
    }

    public function postPageSave(Request $request)
    {
        $request->validate([

        ]);

        session(['pageSave' => $request->all()]);
        return redirect('/form/pageSave');
    }

    // --------------- page ---------------------
    public function showSuccess()
    {

        return view('/form/pageSuccess');

    }

    public function postPageSuccess(Request $request)
    {
        $request->validate([

        ]);

        session(['pageSuccess' => $request->all()]);
        return redirect('/');
    }

    //------------------ Memorizza ne database ----------
    public function submitForm()
    {

        $data = array_merge(
            session('page1', []),
            session('page1b', []),
            session('page1c', []),
            session('page2', []),
            session('page3', []),
            session('page3b', []),
            session('page4', []),
            session('page5', []),
            session('page6', []),
            session('page7', []),
            session('page8', []),
            session('page9', []),
            session('page10', []),
        );

        // Filtra i dati per rimuovere gli elementi vuoti
        // $data = array_filter($data, function ($value) {
        //   return !is_null($value) && $value !== '';
        // });

        $data = [
            'tipo_volantino'      => $data['tipo_volantino'][0] ?? null,
            'tipo_attivita'       => $data['tipo_attivita'][0] ?? null,
            'titolo'              => $data['titolo'] ?? null,
            'qualifica'           => $data['qualifica'][0] ?? null,
            'specializzazione'    => $data['specializzazione'][0] ?? null,
            'email'               => $data['email'] ?? null,
            'data_inizio'         => $data['data_inizio'] ?? null,
            'data_fine'           => $data['data_fine'] ?? null,
            'calendario'          => $data['calendario'] ?? null,
            'nome'                => $data['nome'] ?? null,
            'cognome'             => $data['cognome'] ?? null,
            'telefono'            => $data['telefono'] ?? null,
            'altro'               => $data['altro'] ?? null,
            'altriorganizzatori'  => $data['altriorganizzatori'] ?? null,
            'difficolta'          => $data['difficolta'] ?? null,
            'durata'              => $data['durata'] ?? null,
            'socio'               => $data['tipo_socio'][0] ?? null,
            'a_spinta'            => $data['a_spinta'] ?? null,
            'portage'             => $data['portage'] ?? null,
            'lunghezza'           => $data['lunghezza'] ?? null,
            'dislivello'          => $data['dislivello'] ?? null,
            'quotaminima'         => $data['quotaminima'] ?? null,
            'quotamassima'        => $data['quotamassima'] ?? null,
            'numerominimo'        => $data['numerominimo'] ?? null,
            'numeromassimo'       => $data['numeromassimo'] ?? null,
            'altricosti'          => $data['altricosti'] ?? null,
            'tipologiatrasporto'  => $data['tipologiatrasporto'] ?? null,
            'oraritrovo'          => $data['oraritrovo'] ?? null,
            'luogoritrovo'        => $data['luogoritrovo'] ?? null,
            'linkluogo'           => $data['linkluogo'] ?? null,
            'link_volantino'      => $data['link_volantino'] ?? null,
            'descrizione'         => $data['descrizione'] ?? null,
            'note'                => $data['note'] ?? null,
            'fine_iscrizioni'     => $data['fine_iscrizioni'] ?? null,
            'inizio_iscrizioni'   => $data['inizio_iscrizioni'] ?? null,
            'tipo_iscrizione'     => $data['tipo_iscrizione'][0] ?? null,
            'link_modulo_esterno' => $data['link_modulo_esterno'] ?? null,
            'user_email'          => $data['user_email'] ?? null,
        ];

        $attivita                   = new Attivita;
        $attivita->tipo_volantino   = $data['tipo_volantino'];
        $attivita->tipo_attivita    = $data['tipo_attivita'];
        $attivita->nome             = $data['nome'];
        $attivita->cognome          = $data['cognome'];
        $attivita->email            = $data['email'];
        $attivita->telefono         = $data['telefono'];
        $attivita->titolo           = $data['titolo'];
        $attivita->qualifica        = $data['qualifica'];
        $attivita->specializzazione = $data['specializzazione'];
        $attivita->data_inizio      = $data['data_inizio'];
        $attivita->data_fine        = $data['data_fine'];
        $attivita->calendario       = $data['calendario'];

        $attivita->lunghezza          = $data['lunghezza'];
        $attivita->altro              = $data['altro'];
        $attivita->altriorganizzatori = $data['altriorganizzatori'];
        $attivita->tipo_attivita      = $data['tipo_attivita'];
        $attivita->difficolta         = $data['difficolta'];
        $attivita->durata             = $data['durata'];
        $attivita->socio              = $data['socio'];
        $attivita->a_spinta           = $data['a_spinta'];
        $attivita->portage            = $data['portage'];
        $attivita->dislivello         = $data['dislivello'];
        $attivita->quotaminima        = $data['quotaminima'];
        $attivita->quotamassima       = $data['quotamassima'];
        $attivita->numerominimo       = $data['numerominimo'];
        $attivita->numeromassimo      = $data['numeromassimo'];
        $attivita->altricosti         = $data['altricosti'];
        $attivita->tipologiatrasporto = $data['tipologiatrasporto'];
        $attivita->oraritrovo         = $data['oraritrovo'];
        $attivita->luogoritrovo       = $data['luogoritrovo'];
        $attivita->linkluogo          = $data['linkluogo'];
        $attivita->link_volantino     = $data['link_volantino'];
        $attivita->descrizione        = $data['descrizione'];
        $attivita->note               = $data['note'];

        $attivita->tipo_iscrizione = $data['tipo_iscrizione'];
        if ($attivita->tipo_iscrizione == 4) {
            $attivita->fine_iscrizioni   = null;
            $attivita->inizio_iscrizioni = null;
        } else {
            $attivita->fine_iscrizioni   = $data['fine_iscrizioni'];
            $attivita->inizio_iscrizioni = $data['inizio_iscrizioni'];
        }

        $attivita->inizio_iscrizioni = $data['inizio_iscrizioni'];
        $attivita->fine_iscrizioni   = $data['fine_iscrizioni'];

        $attivita->link_modulo_esterno = $data['link_modulo_esterno'];

        // ----------- Immagine 1 -----------
        $imageName            = session('image_name');
        $attivita->image_file = $imageName;

        if ($imageName) {
            // Sposta l'immagine dalla cartella temporanea alla destinazione finale
            Storage::move('temp/' . $imageName, 'public/imgtrek/' . $imageName);
        }

        // --------------------- Pdf 1 -----------------
        $pdfName            = session('pdf_name');
        $attivita->pdf_file = $pdfName;
        if ($pdfName) {
            // Sposta l'immagine dalla cartella temporanea alla destinazione finale
            Storage::move('temp/' . $pdfName, 'public/pdftrek/' . $pdfName);
        }

        $dataOggi = now()->format('Y-m-d'); // Usa la data di oggi se non è fornita
                                            // dd($request->data_fine,$fine);
        if ($attivita->inizio_iscrizioni == null) {
            $attivita->inizio_iscrizioni = $dataOggi;
        }

        if ($attivita->fine_iscrizioni == null) {
            $attivita->fine_iscrizioni = $attivita->data_inizio;
        }

        $user = auth()->user();
        if (isset($user->email)) {
            $attivita->user_email = $user->email;
        }

        $attivita->save();


        // Pulisci la sessione
        session()->forget(['page1', 'page2', 'page3', 'page4', 'page5', 'page6', 'page7', 'page8', 'page9', 'page10' /* altre pagine */]);
        // Richiama pagina immagini gestita a parter
        return view('/form/pageSuccess');
    }

}
