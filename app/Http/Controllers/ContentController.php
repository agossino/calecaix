<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\TipoAttivita;
use App\Models\Catid;
class ContentController extends Controller
{

    public function showEditor($id)
    {
        $viewData = [];
        $viewData['error'] = null;
        $viewData['contents'] = Content::find($id);
        $viewData['catids'] = Catid::all();
        // dd($viewData);
        // return view('chEditor')->with("viewData", $viewData);
        return view('content.summernoteEditor')->with("viewData", $viewData);
    }

    public function storeEditor(Request $request, $id)
    {

        try {

            $newArticolo = Content::find($id);
            $newArticolo->titolo = $request->titolo;
            $alias = $request->alias;
            $alias = Str::slug($request->titolo, '-');
            /* if (Content::existsWithSameContent('alias', $alias)) {
                 $viewData['error'] = 'Esiste già un record con lo stesso alias.';
             } else {
                 $newArticolo->alias = $alias;
             }*/
            $newArticolo->published = $request->published;
            $newArticolo->introtext = $request->introtext;
            $newArticolo->save();
          

            $viewData = [];
            $viewData['catids'] = Catid::all();
            $viewData['contents'] = Content::find($id);
            $viewData['error'] = null;
            return view('content.summernoteEditor')->with("viewData", $viewData);
        } catch (\Exception $e) {
            $viewData['error'] = 'Si è verificato un errore durante il salvataggio dei dati.';
            // Puoi anche registrare l'errore in un log per facilitare la risoluzione
            Log::error('Errore nel controller storeEditor: ' . $e->getMessage());
            $viewData['catids'] = Catid::all();
            $viewData['contents'] = Content::find($id);
            return view('content.summernoteEditor')->with("viewData", $viewData);
        }
    }
    public function addEditor(Request $request)
    {



        $request->validate([
            'introtext' => 'required',
        ]);


        try {
            $viewData = [];
            $alias = $request->alias;
            $id = $request->id;

            $newArticolo = new Content();
            $newArticolo->titolo = $request->titolo;
            $alias = Str::slug($request->titolo, '-');

            $newArticolo->published = $request->published;
            // $newArticolo->introtext = $request->introtext;
            $newArticolo->introtext = $request->input('introtext');
            $newArticolo->save();
            $id = $newArticolo->id;


            $viewData['catids'] = Catid::all();
            $viewData['contents'] = Content::find($id);
            $viewData['error'] = null;
            return view('content.summernoteEditor')->with("viewData", $viewData);
        } catch (\Exception $e) {
            $viewData['error'] = 'Si è verificato un errore durante il salvataggio dei dati.';
            // Puoi anche registrare l'errore in un log per facilitare la risoluzione
            Log::error('Errore nel controller storeEditor: ' . $e->getMessage());
            $viewData['catids'] = Catid::all();
            $viewData['contents'] = Content::find($id);
            return view('content.addEditor')->with("viewData", $viewData);
        }
    }

    public function listArticoli()
    {
        $viewData = [];
        $viewData['contents'] = Content::all();
        $viewData['catids'] = Catid::all();
        return view('content.listArticoli')->with("viewData", $viewData);
    }

    public function addArticolo()
    {
        $viewData = [];
        $viewData['contents'] = new Content();
        $viewData['catids'] = Catid::all();

        // $records = YourModel::where('published', '!=', 0)->get();

        return view('content.addArticolo')->with("viewData", $viewData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyArticolo($id)
    {
        Content::destroy($id);
        $viewData = [];
        $viewData['catids'] = Catid::all();
        $viewData['contents'] = Content::all();
        return view('content.listArticoli')->with("viewData", $viewData);
    }

    public function disableArticolo($id)
    {
        $content = Content::find($id);
        if ($content->published == 1) {
            $content->published = 0;
        } else {
            $content->published = 1;
        }
        $content->save();
        $viewData = [];
        $viewData['catids'] = Catid::all();
        $viewData['contents'] = Content::all();
        return view('content.listArticoli')->with("viewData", $viewData);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        //
    }
}
