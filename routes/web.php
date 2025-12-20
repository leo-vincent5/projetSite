<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AudioPlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/ok', function () {
    dd("ça marche ! ");
});

Route::get('/tickboss', function () {
    
    return view('tb');
});



Route::get('/download/file1', function () {
    return response()->download('/tb/tickboss.apk');
})->name('download.file1');

Route::get('/download/file2', function () {
    return response()->download('/tb/supremo.apk');
})->name('download.file2');

Route::get('/download/file3', function () {
    return response()->download('/tb/addsupremo.apk');
})->name('download.file3');



Route::get('/card', function () {
    return redirect('/');
});

Route::get('/testv2', function () {
    exec("php artisan optimize:clear");
});

Route::get('/poney',[\App\Http\Controllers\PoneyController::class,'index'])->name('index');




Route::get('/drive',[GalleryController::class,"drive"])->name('drive');
Route::get('/phototherapie',[NewController::class,"phototherapie"])->name('phototherapie');

Route::post('/login-drive',[GalleryController::class,"login_drive"])->name('login-drive');
Route::get('/help-price',[NewController::class,"help_price"])->name('help_price');

Route::get('/forfaits_photos_mariage',[NewController::class,"forfaits"])->name('forfaits');
Route::get('/reservation_mariage',[NewController::class,"reservation_mariage"])->name('reservation_mariage');
Route::post('/sendReservation',[NewController::class,"sendReservation"])->name('sendReservation');
Route::get('/legal',[NewController::class,"legal"])->name('legal');
Route::get('/cgv',[NewController::class,"cgv"])->name('cgv');


Route::get('/galerie',[GalleryController::class,"index"])->name('gallery');
Route::get('/galerie/{name}',[GalleryController::class,"souscat"])->name('under-galerie');
Route::get('/galerie/{name}/{club}', [GalleryController::class,"club"])->name("club-view");
Route::get('/creationweb',[GalleryController::class,"web"])->name('creation-web');
Route::post('/send',[GalleryController::class,"envoi"])->name("envoi");
Route::post('/envoieForm', [GalleryController::class,"envoieContact"])->name("envoieformulaire");
Route::post('/projetWeb',[GalleryController::class,"projetweb"])->name('projet-web');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('new',[NewController::class,'index'])->name('new');
Route::get('/shootings', [GalleryController::class,'shooting'])->name('shooting');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/share/audio', [AudioPlayerController::class, 'show'])->name('audio.share.show');


Route::middleware('auth')->group(function () {


    Route::get('/alohomora', [AudioPlayerController::class, 'index'])->name('audio.player');

    Route::post('/audio/resume', [AudioPlayerController::class, 'saveResume'])->name('audio.resume.save');

    Route::get('/pauline-stats', [\App\Http\Controllers\PoneyController::class, 'stats']);
    Route::post('/pauline-stats/delete', [\App\Http\Controllers\PoneyController::class, 'deletePaulineEntries']);
    Route::post('/save-client-code', [\App\Http\Controllers\tickbossController::class, 'saveClientCode'])->name('saveClientCode');

// Route pour mettre à jour le statut d'un appel via AJAX
    Route::post('/updateStatus/{id}', [\App\Http\Controllers\tickbossController::class, 'updateStatus'])->name('updateStatus');
// Route pour ajouter une note à un appel
    Route::post('/addNote/{id}', [\App\Http\Controllers\tickbossController::class, 'addNote'])->name('addNote');

    Route::get('/calls', [\App\Http\Controllers\tickbossController::class, 'showCalls'])->name('viewCalls');
    Route::get('/admin', [GalleryController::class,"admin"])->name("admin");
    Route::get('/gestion',[AdminController::class,"gestion"])->name('gestion');
    Route::get('/galerie/{name}/{club}/{file}', [GalleryController::class,"reserve"])->name("reserve");

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/filtre', [GalleryController::class,"filtre"])->name("filtre");
    Route::get('/panier',[GalleryController::class,'panier'])->name("panier");
    Route::get('/history',[GalleryController::class,'history'])->name("history");
    Route::post('/getPanier',[GalleryController::class,"getPanier"])->name('getPanier');
    Route::post('/add_panier_speed',[GalleryController::class,'addPanierSpeed'])->name("add_panier_speed");
    Route::post('/add_pack',[GalleryController::class,'addPack'])->name('add_pack');
    Route::post('/delete-pack',[GalleryController::class,'deletepack'])->name('delete-pack');

    Route::post('/add-panier',[GalleryController::class,'addPanier'])->name("add-panier");
    Route::post('/vider-panier',[PanierController::class,'viderPanier'])->name("vider-panier");
    Route::post('/deleteOne-panier',[PanierController::class,'deleteOne'])->name("deleteOne-panier");

    Route::post('/paiement-ajax',[PanierController::class,'paiementAccept'])->name("paiement-accept");
    Route::get('/paiementPack/{id}',[GalleryController::class,'paiementPack'])->name('paiementPack');
    Route::post('/paiement-ajax-pack',[GalleryController::class,'paiementAjaxPack'])->name('paiementPackAjax');
    Route::post('/get-paiement-ajax',[GalleryController::class,'getPaiementAjax'])->name('getPaiementAjax');

    Route::get('/show_pack/{id}',[GalleryController::class,'ShowPack'])->name('showPack');

    Route::post('/admin_add_employeur',[AdminController::class,'addEmployeur'])->name('admin_add_employeur');
    Route::post('/admin_delete_employeur',[AdminController::class,'deleteEmployeur'])->name('admin_delete_employeur');
    Route::get('/admin_facture/{id}',[AdminController::class,'getFacture'])->name('admin_facture');
    Route::post('/admin_add_mission',[AdminController::class,'addMission'])->name('addMission');
    Route::post('/add_facture_progress',[AdminController::class,'addFactureInProgress'])->name('add_facture_progress');
    Route::post('/delete_liaison_facture',[AdminController::class,'deleteLiaison'])->name('deleteLiaison');
    Route::get('/generate_pdf/{id}',[AdminController::class,'generatePdf'])->name('generate_pdf');
    Route::post('/add_remarque_facture', [AdminController::class,'addRemarque'])->name('addRemarque');
    Route::post('/get_all_ligne',[AdminController::class,'getAllLigne'])->name('getAllLigne');
    Route::post('/edit_remarque_facture',[AdminController::class,'editRemarqueFacture'])->name('editRemarqueFacture');
    Route::post('/delete_facture',[AdminController::class,'deleteFacture'])->name('deleteFacture');
    Route::post('/get_panier_user',[AdminController::class,'getPanierUser'])->name('getPanierUser');

    Route::get('/bourse',[AdminController::class,'bourse'])->name('bourse');

    Route::get('/codePromo',[GalleryController::class,'codePromo'])->name('codePromo');
    Route::get('/generateur_code',[AdminController::class,'generateurCode'])->name('generateurCode');
    Route::post('/createCode',[AdminController::class,'createCode'])->name('createCode');
    Route::post('/sendCodePromo',[AdminController::class,'sendCodePromo'])->name('sendCodePromo');
    Route::post('/delete_code_promo',[AdminController::class,'deleteCodePromo'])->name('deleteCodePromo');
    Route::get('/useCodePromo/{id}',[AdminController::class,'useCodePromo'])->name('useCodePromo');
});

Route::get('/telecharger-image/{repertoire}/{nomFichier}', [GalleryController::class,'telechargerImage'])->name('telecharger.image');
Route::get('/download/{repertoire}', [GalleryController::class,'download'])->name('download');
Route::get('/loadmore/{repertoire}/{nb}', [GalleryController::class,'loadmore'])->name('loadmore');
Route::get('/loadmorehidden/{repertoire}/{nb}', [GalleryController::class,'loadmorehidden'])->name('loadmorehidden');


require __DIR__.'/auth.php';
