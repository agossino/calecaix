<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\IscrizioneController;
use App\Http\Controllers\MercatinoController;
use App\Http\Controllers\AttivitaFormController;
use App\Http\Controllers\IscrittiController;
use App\Http\Controllers\AttivitaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('custom-welcome'); // Cambia 'welcome' con il nome della tua vista personalizzata
});


//Route::get('/run-storage-link', function () {
//    Artisan::call('storage:link');
//    return 'Storage link created successfully!';
//});



Route::get('/read-excel/{fileId}', [GoogleDriveController::class, 'readExcelFile']);

Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'),'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::view('termini', 'termini')->name('termini');
Route::view('privacy', 'privacy')->name('privacy');

//Route::get('/home', [HomeController::class, 'index'])->middleware('verified');

// gestione autorizzazioni iscritti
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/index', 'index_users');
    Route::get('/admin/edit_role/{id}', 'show_role');
    Route::post('/admin/utente_store','store_role');
    Route::get('/admin/destroyUtente/{id}', 'destroyutente');
    Route::get('/admin/disableUtente/{id}', 'disableUtente');
    Route::get('/admin/index/{data}/{categoria}','index');
});

Route::controller(PDFController::class)->group(function () {
    Route::get('/show-pdf/{filename}/{id}', 'showPDF');
    Route::get('/visualizza-pdf', 'showDirectPdf');
    Route::get('/vpdf/{id}', 'index');
    
    Route::get('/crea_pdf', 'crea_pdf_attivita');
    Route::get('/pagina_pdf/{id}', 'pagina_pdf');
});

Route::controller(ExcelController::class)->group(function () {
    Route::get('/form_excel', 'form_excel')->name('form_excel');
    Route::post('/import_excel','importexcel_attivita')->name('importexcel_attivita');
    Route::post('/carica_riga_excel/{id}','importexcel_singolo')->name('excel.lista_titoli');

    Route::get('/form_import_sezioni', 'form_import_sezioni')->name('form_import_sezioni');
    Route::post('/form_importexcel_sezioni_cai','importexcel_sezioni_cai')->name('form_importexcel_sezioni_cai');
    
});

Route::controller(ContentController::class)->group(function () {
    Route::get('/showEditor/{id}', 'showEditor');
    Route::post('storeEditor/{id}', 'storeEditor');
    Route::get('/listArticoli', 'listArticoli');
    Route::get('/content.addArticolo', 'addArticolo');
    Route::post('addEditor', 'addEditor');
    Route::get('destroyArticolo/{id}', 'destroyArticolo');
    Route::get('disableArticolo/{id}', 'disableArticolo');
});

// richiama il mercatino dall'esterno caibo.it/calecai/public/mercatino.index
Route::controller(MercatinoController::class)->group(function () {
    Route::get('/mercatino.index', 'index');

});

// cancella iscrizione dall'esterno , emil spedita dopo registrazione
Route::controller(IscrizioneController::class)->group(function () {
    //Route::get('/iscrizione.canc_daweb/{id}', 'canc_daweb');
    Route::get('/iscrizione/tipo/{tipo}/{id}', 'iscri_tipo');
    Route::get('/iscrizione.canc_daweb/{idiscr}', 'canc_daWeb')->name('iscrizione.canc_daweb');
    Route::get('/iscrizione.conf_daweb/{idiscr}', 'conf_daWeb')->name('iscrizione.conf_daweb');
});

Route::controller(IscrizioneController::class)->group(function () {
    Route::get('iscrizione', 'create')->name('iscrizione.create');
    Route::post('iscrizione', 'store')->name('iscrizione.store');
    // form aggiungi iscrizione
    Route::get('/iscrizione.add/{tipo}/{escursione}/{categoria}', 'create');
    // cancellazione iscrizione da locale
    Route::get('/iscrizione.canc/{id}', 'cancella');

    // cancella iscrizione dalla email spedita
   // Route::get('/iscrizione.canc/{id}', 'canc_daweb'); 
   // Route::get('/iscrizione.conf/{id}', 'conf_daweb'); 

    // lista iscriziono /id = 0, tutte le iscrizioni 
    Route::get('/iscrizione.list/{escursione}', 'list');
    // annulla, cancella, abilita dalla lista iscrizioni
    Route::get('/iscrizione.annulla_iscriz/{escursione}', 'annulla_iscriz');
    Route::get('/iscrizione.abilita_iscriz/{escursione}', 'abilita_iscriz');
    Route::get('/iscrizione.cancella_iscriz/{escursione}', 'cancella_iscriz');

    Route::get('/iscritti/show/{iscritti}/{id}', 'show')->name('iscritti.show');
    Route::POST('/iscritti/edit', 'edit')->name('iscritti.edit');
    Route::POST('/iscritti.delete', 'destroy')->name('iscritti.delete');
});

// Inserimento attivita con generazione volatino dai dat insriti
Route::controller(AttivitaFormController::class)->group(function () {
    Route::get('/form/page1', 'showPage1')->name('form/page1');
    Route::post('/form/page1', 'postPage1');

    Route::get('/form/page1b', 'showPage1b');
    Route::post('/form/page1b', 'postPage1b');


    Route::get('/form/page1c', 'showPage1c');
    Route::post('/form/page1c', 'postPage1c');

    Route::get('/form/page2', 'showPage2');
    Route::post('/form/page2', 'postPage2');

    Route::get('/form/page3', 'showpage3');
    Route::post('/form/page3', 'postpage3');
    
    Route::get('/form/page3b', 'showpage3b');
    Route::post('/form/page3b', 'postpage3b');

    Route::get('/form/page4', 'showPage4');
    Route::post('/form/page4', 'postPage4');

    Route::get('/form/page5', 'showPage5');
    Route::post('/form/page5', 'postPage5');

    Route::get('/form/page6', 'showPage6');
    Route::post('/form/page6', 'postPage6');


    Route::get('/form/page7', 'showPage7');
    Route::post('/form/page7', 'postPage7');

    Route::get('/form/page8', 'showPage8');
    Route::post('/form/page8', 'postPage8');

    Route::get('/form/page9', 'showpage9');
    Route::post('/form/page9', 'postpage9');

    Route::get('/form/page10', 'showpage10');
    Route::post('/form/page10', 'postpage10');
    
    Route::get('/form/pageSave', 'submitForm');
    Route::get('/form/pageSuccess', 'pageSuccess');
});

Route::controller(AttivitaController::class)->group(function () {
    Route::get('/attivita/index/{categoria}/{dataOggi}', 'index')->name('attivita/index');
    Route::get('/attivita/singolo/{id}', 'singolo')->name('attivita/singolo');
    Route::get('/attivita/list', 'list')->name('attivita/list');
    Route::get('/attivita/edit/{id}/{tipo}', 'edit')->name('attivita/edit');
    Route::get('/attivita/destroy/{id}', 'destroy')->name('attivita/destroy');
    Route::get('/attivita/published/{id}', 'published');
    Route::post('/attivita/save_edit/{id}', 'save_edit')->name('attivita/save_edit');
    Route::get('attivita/cerca/{ritorno}',  'cerca')->name('attivita.cerca');

     Route::get('/attivita/show_descrizione/{id}', 'show_descrizione')->name('attivita/show_descrizione');
     Route::POST('/attivita/update_descrizione/{id}', 'update_descrizione')->name('attivita/update_descrizione');
     Route::get('/get_from_dbcai', 'get_from_dbcai')->name('get_from_dbcai');
     Route::post('/attivita/incrementa-clic/{attivitaId}', 'incrementa_clic')->name('attivita/incrementa_click');

     Route::get('/attivita/get_programma/{id}', 'get_programma')->name('get_programma');
});


Route::get('/generate-image/{id}', [ImageController::class, 'generateImage']);
