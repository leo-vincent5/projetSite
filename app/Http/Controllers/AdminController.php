<?php

namespace App\Http\Controllers;

use App\CodePromo;
use App\NbPhotoUser;
use App\Paiement;
use App\Panier;
use App\Activite;
use App\Employeur;
use App\Facture;
use App\Tentative;
use App\useCode;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use App\FactureInProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function gestion(){
        if (Auth::user()->id == 1){
            $employeurs = Employeur::all();
            return view('gestion')->with(['employeurs' => $employeurs]);
        } else {
            return "interdit";
        }
    }

    public function addEmployeur(Request $request){
        $nom = $request->input('nom');
        $siret = $request->input('siret');
        $email = $request->input('email');

        $newEmployeur = new Employeur();
        $newEmployeur->nom = $nom;
        $newEmployeur->siret = $siret;
        $newEmployeur->email = $email;
        $newEmployeur->save();

        return $newEmployeur;
    }

    public function deleteEmployeur(Request $request){
        $id = $request->input('id');

        $employeur = Employeur::find($id);
        $employeur->delete();
        return true;
    }

    public function getFacture($id){


        $employeur = Employeur::find($id);
        $factures = Facture::query()->where('employeur_id','=',$id)->get();
        $missions = Activite::all();
        return view("facture_employeur")->with(['employeur' => $employeur,'missions' => $missions, "factures" => $factures]);
    }

    public function addMission(Request $request){
        $titre = $request->input('titre');
        $date = $request->input('date');
        $lieu = $request->input('lieu');
        $prix = $request->input('prix');

        $mission = new Activite();
        $mission->titre = $titre;
        $mission->date = $date;
        $mission->lieu = $lieu;
        $mission->prix = $prix;
        $mission->save();

        return $mission;
    }

    public function addFactureInProgress(Request $request){
        $activite_id = $request->input('activite_id');
        $facture_id = $request->input('facture_id');
        $employeur_id = Arr::last(explode("/",$request->session()->previousUrl()));
        if ($facture_id == 0 ){
             $facture = new Facture();
             $facture->employeur_id = $employeur_id;
             $facture->save();

             $inprogress = new FactureInProgress();
             $inprogress->activite_id = $activite_id;
             $inprogress->facture_id = $facture->id;
             $inprogress->save();


        } else {
             $facture_object = Facture::find($facture_id);
             $inprogress = new FactureInProgress();
             $inprogress->activite_id = $activite_id;
             $inprogress->facture_id = $facture_id;
             $inprogress->save();
        }

        if ($facture_id == 0){
            $facture_id = $facture->id;
            $facture_object = $facture;

        }


        $factures = FactureInProgress::query()->where('facture_id','=',$facture_id)->get();
        $acts_ids = [];
        //dd($factures);
        foreach ($factures as $facture){
            $acts_ids[] = $facture->activite_id;
        }

        $activites = Activite::query()->whereIn('id',$acts_ids)->get();
        //dd($activites);
        return ['activites' => $activites,'facture' => $facture_object];


    }

    public function deleteLiaison(Request $request){
        $user_id = Auth::user()->id;
        $facture = $request->input('facture_id');
        $activite = $request->input('activite_id');
        $activiteInfo = Activite::find($activite);
        $facture = FactureInProgress::query()->where('activite_id','=',$activite)->where('facture_id','=',$facture)->first();
        if ($facture != null){

            $prix = $activiteInfo->prix;
            $facture->delete();
            return ['status' => "supprimer","prix" => $prix];
        }
        return "erreur";

    }

    public function generatePdf(Request $request,$id){

        $facture_id = $id;
        $facture = Facture::find($facture_id);
        $employeur_id = $facture->employeur_id;
        $factureLignes = FactureInProgress::query()->where('facture_id','=',$facture_id)->get();
        $employeur = Employeur::find($employeur_id);
        $factureLignesArray = [];
        foreach($factureLignes as $ligne){
            $factureLignesArray[] = $ligne->activite_id;
        }

        $activites = Activite::query()->whereIn('id',$factureLignesArray)->get();

       // dd($activites);
       // dd($employeur);

        $pdf = PDF::loadView("pdf.facture",["employeur" => $employeur, "facture" => $facture,"activites" => $activites]);
        return $pdf->download("facture-00".$facture->id."-".Carbon::create($activites->first()->date)->format("d-m-Y").".pdf");
        return view('pdf.facture');

    }

    public function addRemarque(Request $request){
        $facture = Facture::find($request->input('facture_id'));
        $remarque = $request->input('remarque');

        $facture->remarque = $remarque;
        $facture->save();
        return "ok";
    }

    public function getAllLigne(Request $request){
        $facture_id = $request->input('facture_id');

        $factureLigne = FactureInProgress::query()->where('facture_id','=',strval($facture_id))->get();

        $arrayLines = [];
        foreach ($factureLigne as $ligne){
            $arrayLines[] = $ligne->activite_id;
        }


        $activites = Activite::query()->whereIn('id',$arrayLines)->get();

        return $activites;

    }

    public function editRemarqueFacture(Request $request){

        $remarque = $request->input('remarque');
        $facture_id = $request->input('facture_id');
        $facture = Facture::find($facture_id);
        if ($facture != null){
            $facture->remarque = $remarque;
        $facture->save();
        }
        return $facture;
    }

    public function deleteFacture(Request $request){
        $id = $request->input('facture_id');

        $facture = Facture::find($id);
        if ($facture != null){
            $facture->delete();
        }

        return "ok";

    }


    public function bourse(){
        if(Auth::id() == 1){
        return view("bourse.index");
        }
        else {
            return  redirect("/");
        }
    }

    public function getPanierUser(){
        $panier = Panier::all()->loadMissing("photo","user");
//        dd($panier);
        return $panier;
    }

    public function generateurCode(){
        if(Auth::user()->id != 1 ){
             return redirect('/');
        } else {
            $codes = CodePromo::all();
            return view('admin.generateurCode')->with(['codes' => $codes]);
        }
    }

    public function createCode(Request $request){
        if(Auth::user()->id != 1 ){
             return redirect('/');
        } else {

            $nb_utility = $request->input('nbUtilisation');
            $code = $request->input('code');
            $nb_jours = $request->input('nbduree');
            $details = $request->input('details');
            $nbphoto = $request->input('nbphoto');


            $newCode = new CodePromo();
            $newCode->code = $code;
            $newCode->nb_jours = $nb_jours;
            $newCode->nb_utility = $nb_utility;
            $newCode->details = $details;
            $newCode->nbphoto = $nbphoto;
            $newCode->save();

            return back()->with('success','Le code à été crée');

        }
    }

    public function sendCodePromo(Request $request){

//        dd(,Carbon::now()->format('d-m-Y'));

        $countTentative = Tentative::query()
            ->where('user_id','=',Auth::user()->id)
            ->where('day','=',Carbon::now()->format('d-m-Y'))
            ->get()->count();

        if ($countTentative == 0){
            $tentativesOld  = Tentative::query()->where('user_id','=',Auth::user()->id)->get();
            foreach ($tentativesOld as $item){
                $item->delete();
            }
        } else {
            if ($countTentative > 3 ){
                return ['errors' => 'Vous avez fait trop d\'essais pour aujourd\'hui !'];
            }
        }

        $tentative = new Tentative();
        $codePromo = $request->input('codePromo');
        $tentative->code = $codePromo;
        $tentative->user_id = Auth::user()->id;
        $tentative->save();


        $searchCode = CodePromo::query()->where('code','=',$codePromo)->first();
        $countCode = useCode::query()->where('id_user','=',Auth::user()->id)->where('code','like',$codePromo)->get()->count();

        if ($searchCode == null){
            return ['errors' => 'Code inexistant'];
        }

        if ($countCode >=1) {
            return ['errors' => 'Code déja utilisé'];
        }

        if ($searchCode->nb_utility < 1){
            return ['errors' => 'Le code promo a été utilisé par trop de personnes'];
        }

        $newcode = new useCode();
        $newcode->id_user = Auth::user()->id;
        $newcode->id_code = $searchCode->id;
        $newcode->code = $searchCode->code;
        $newcode->ip = $_SERVER['REMOTE_ADDR'];
        $newcode->save();

        $searchCode->nb_utility = $searchCode->nb_utility - 1;
        $searchCode->save();

        $checkNbPhoto = NbPhotoUser::query()->where('user_id','=',Auth::user()->id)->first();

        if ($checkNbPhoto == null ){
            $addNbPhoto = new NbPhotoUser();
            $addNbPhoto->user_id = Auth::user()->id;
            $addNbPhoto->nb_photo = $searchCode->nbphoto;
            $nbPhoto = $searchCode->nbphoto;
            $addNbPhoto->save();
        } else {
            $checkNbPhoto->nb_photo = $checkNbPhoto->nb_photo + $searchCode->nbphoto;
            $nbPhoto = $checkNbPhoto->nb_photo;
            $checkNbPhoto->save();

        }

        return ['success' => 'Votre code a été validé','nb' => $nbPhoto];


    //    dd($codePromo);
    }

    public function deleteCodePromo(Request $request){
        $codeSearch = $request->input('id_code');
        $code = CodePromo::find($codeSearch);
        if ($code){
            $useCode = useCode::query()->where('id_code','=',$code->id)->get();
            foreach ($useCode as $item){
                $item->delete();
            }
            $code->delete();
            return 'success';
        } else {
            return 'error';
        }
    }


    public function useCodePromo($id){


        $nbPhoto = NbPhotoUser::query()->where('user_id','=',Auth::user()->id)->first();

        $count =  $nbPhoto->nb_photo;

        if ($count < 1){
          return  redirect()->back()->with(['errors' => 'Vous n\'avez plus de photos offertes, renseigner un code promo']);
        }


        $photo_id = $id;
        $paiement = new Paiement();
        $paiement->id_user = Auth::user()->id;
        $paiement->id_photo = $photo_id;
        $json = json_encode("USE CODE PROMO ");
        $paiement->json =  $json;
        $paiement->save();

        $nbPhoto->nb_photo = $nbPhoto->nb_photo - 1 ;

        $nbPhoto->save();


        $panier = Panier::query()->where('id_user','=',Auth::user()->id)->where('id_photo','=',$photo_id)->first();

        $panier->delete();


        return redirect()->back()
            ->with(['success' => 'Vous avez débloqué une nouvelle photo grace à votre code, retrouvez la avec <a href="'.route('history').'"> les photos que vous avez acheté ici </a> ']);

    }

}
