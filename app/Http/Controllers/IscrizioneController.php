<?php

namespace App\Http\Controllers;


use App\Models\Iscrizione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Attivita;
use App\Models\TipoAttivita;
use App\Models\TipoIscrizione;
use Carbon\Carbon;

/* TODO tipo di iscrizioni
     - email a accompagnatore
     - telefono accompagnatore
     * dal sito cai modulo
     - dal web indirizzo

*/

class IscrizioneController extends Controller
{

    public function show($tipo, $id)
    {
        $attivita = Attivita::find($id);
        $iscritti = Iscrizione::where('attivita_id', $id)->get();
     
        $viewData = [];
        $viewData['iscritti'] = $iscritti;
        $viewData['attivita'] = $attivita;

        return view('iscritti.tipo' . $tipo)->with("viewData", $viewData);

    }

    public function edit(Request $request)
    {
        //dd($request);
        $viewData = [];
        $attivita = Attivita::find($request->attivita_id);
        $iscrizione = Iscrizione::where('attivita_id', $request->attivita_id)->first();
        $iscrizione->stato_iscrizione = $request->stato_iscrizione[1];
        $iscrizione->save();
        $iscritti = Iscrizione::where('attivita_id', $request->attivita_id)->get();
        
        $viewData['iscritti'] = $iscritti;
        $viewData['attivita'] = $attivita;
       
        return view('iscritti.tipo' . $request->tipo_iscrizione)->with("viewData", $viewData);

    }

    public function create($tipo, $evento, $categoria)
    {
        $viewData = [];
        $viewData['tipo_iscrizione'] = ['tipo_iscrizione' => $tipo, 'evento' => $evento, 'categoria' => $categoria];
        return view('iscrizione.iscrizione')->with("viewData", $viewData);

    }

    /**
     * Summary of store salva nuova iscrizione
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {


        // da iscrizione.tipo1, tipo2 ecc..
        /*    $request->validate([
                'attivita_id' => 'required',
                'tipo_iscrizione' => 'required',
                'nome' => 'required',
                'cognome' => 'required',
                //'indirizzo' => 'required',
                'socio_cai' => 'required',
                'sezione' => 'required_if:socio_cai,Si',
                'email' => 'required|email',
                // 'cellulare' => 'required',
                'accettazione_termini' => 'accepted',
                'accettazione_privacy' => 'accepted',

            ], [
                'attivita_id' => 'è richiesto',
                'tipo_iscrizione' => 'è richiesto',
                'nome' => 'è richiesto',
                'cognome' => 'è richiesto',
                //'indirizzo' => 'required',
                'socio_cai' => 'è richiesto',
                'sezione' => 'required_if:socio_cai,Si',
                'email' => 'required|email',
                // 'cellulare' => 'required',
                'accettazione_termini' => 'è richiesto',
                'accettazione_privacy' => 'è richiesto',
            ]);
    */

    $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
    $dataOggi = Carbon::createFromFormat("Y-m-d", $dataOggius)->format("d-m-Y");

        // $data = $request->except('_token'); // Escludi _token
        // Iscrizione::create($data);

        $iscrizione = new Iscrizione;
        $iscrizione->iscrizione_tipo = $request->iscrizione_tipo;
        $iscrizione->attivita_id = $request->attivita_id;
        $iscrizione->nome = $request->nome;
        $iscrizione->cognome = $request->cognome;
        $iscrizione->socio_cai = $request->socio_cai;
        $iscrizione->iscrizione_tipo = $request->iscrizione_tipo;
        if (isset($request->indirizzo)) {
            $iscrizione->indirizzo = $request->indirizzo;
        }
        if (isset($request->telefono)) {
            $iscrizione->telefono = $request->telefono;
        }
        $iscrizione->data_iscrizione  = $dataOggi;

        if (isset($request->sezione) && $request->sezione != 'Selezione') {
            $iscrizione->sezione = $request->sezione;
        }

        if (isset($request->data_nascita)) {
            $iscrizione->data_nascita = $request->data_nascita;
        }
        if (isset($request->luogo_nascita)) {
            $iscrizione->luogo_nascita = $request->luogo_nascita;
        }

        if (isset($request->email)) {
            $iscrizione->email = $request->email;
        }



        if ($request->accettazione_termini == 'on') {
            $iscrizione->accettazione_termini = 1;
        } else {
            $iscrizione->accettazione_termini = 0;
        }


        if ($request->accettazione_privacy == 'on') {
            $iscrizione->accettazione_privacy = 1;
        } else {
            $iscrizione->accettazione_privacy = 0;
        }

        $iscrizione->iscrizione_tipo = $request->iscrizione_tipo;
        $iscrizione->stato_iscrizione = 0;
        $iscrizione->published = 1;

        $iscrizione->save();

        $lastInsertedId = $iscrizione->id;

        $viewData = [];

        $viewData['sendemail'] = [
            'cellulare' => $iscrizione->cellulare,
            'attivita_id' => $request->attivita_id,
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'email' => $request->email,
            'iscrizione_id' => $lastInsertedId,
            'iscrizione_tipo' => $request->iscrizione_tipo,

        ];

        // return redirect()->back()->with('success', 'Iscirizione completata con successo!');
        return view('iscrizione.email_iscri_tipo' . $request->iscrizione_tipo)->with("viewData", $viewData);
    }

    /**
     * Sospende una iscrizione
     * @param mixed $id
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function cancella($id)
    {
        $iscrizione = Iscrizione::find($id);
        $iscrizione->iscrizione = 0;
        $iscrizione->save();

        $viewData = [];
        return redirect()->back()->with('success', 'Iscrizione cancellata con successo!');

    }

    /**
     * Sospende una iscrizione dalla email spedita dopo l'iscrizione
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function canc_daweb($id)
    {
        $dataOggi = now()->format('d-m-Y'); // Usa la data di oggi se non è fornita
        $iscrizione = Iscrizione::find($id);
        $iscrizione->stato_iscrizione = 0;
        $iscrizione->data_cancellazione = $dataOggi;
        $iscrizione->save();

        $viewData = [];
        return redirect('/')->with('success', '-------------------------------- Iscrizione cancellata con successo! ------------------------------');
     
       // return redirect()->back()->with('success', '-------------------------------- Iscrizione cancellata con successo! ------------------------------');
        // return redirect()->back()->with('success', 'Iscirizione cancellata con successo!');
    }

    public function conf_daweb($id)
    {
        $dataOggi = now()->format('d-m-Y'); // Usa la data di oggi se non è fornita
        $iscrizione = Iscrizione::find($id);
        $iscrizione->stato_iscrizione = 1;
        $iscrizione->data_cancellazione = $dataOggi;
        $iscrizione->save();

        $viewData = [];
        return redirect('/')->with('success', '--------------------------------- Iscrizione confermata con successo! --------------------------------');

        //return redirect()->back()->with('success', '--------------------------------- Iscrizione confermata con successo! --------------------------------');
        // return redirect()->back()->with('success', 'Iscirizione cancellata con successo!');
    }

    /**
     * Summary of lista iscrizioni
     * @param mixed $evento
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function list($evento)
    {
        // crea collezione con tutti gli id e titoli di tuttigli eventi
        $eventi = Attivita::all();
        $eventi_titoli = $eventi->pluck('titolo', 'id');

        if ($evento == 0) {
            $iscrizioni = Iscrizione::all();
        } else {
            $iscrizioni = Iscrizione::where('evento', $evento)->get();
        }


        $viewData = [];
        $viewData['eventi_titoli'] = $eventi_titoli;
        $viewData['iscrizione'] = $iscrizioni;

        return view('iscrizione.list_iscrizioni')->with("viewData", $viewData);
    }

    /**
     * Sospende iscrizione esguito dalla lista iscrizioni
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function annulla_iscriz($id)
    {
        $iscrizione = Iscrizione::find($id);
        $iscrizione->iscrizione = 0;
        $iscrizione->save();

        $viewData = [];
        //return view('iscrizione.cancellata')->with("viewData", $viewData);
        return redirect()->back()->with('success', 'Iscirizione annullata con successo!');
    }

    /**
     * Ripristina Iscrizione eseguito dalla pagina lista iscrizioni
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function abilita_iscriz($id)
    {
        $iscrizione = Iscrizione::find($id);
        $iscrizione->iscrizione = 1;
        $iscrizione->save();

        $viewData = [];
        //return view('iscrizione.cancellata')->with("viewData", $viewData);
        return redirect()->back()->with('success', 'Iscirizione annullata con successo!');
    }

    /**
     * Cancella definitivamente una iscrizione
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancella_iscriz($id)
    {

        Iscrizione::destroy($id);

        $viewData = [];
        //return view('iscrizione.cancellata')->with("viewData", $viewData);
        return redirect()->back()->with('success', 'Iscirizione cancellata con successo!');
    }



    public function iscri_tipo($tipo, $id)
    {
        $viewData = [];
        $viewData['attivita'] = Attivita::find($id);

        return view('iscrizione.tipo' . $tipo)->with("viewData", $viewData);

    }

    public function iscri_tipo2($tipo, $id)
    {
        $viewData = [];
        $viewData['attivita'] = Attivita::find($id);

        return view('iscrizione.tipo' . $tipo)->with("viewData", $viewData);

    }


}
