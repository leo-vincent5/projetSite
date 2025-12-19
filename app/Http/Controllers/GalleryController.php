<?php

namespace App\Http\Controllers;

use App\Devis;
use App\Mail\sendDevis;
use App\Mail\sendMessage;
use App\MessagePhoto;
use App\Models\CompteurMariage;
use App\NbPhotoUser;
use App\PackModel;
use App\PackPhoto;
use App\Paiement;
use App\Panier;
use App\PanierTempon;
use App\Photo;
use App\photoReservation;
use App\useCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $path = public_path('img/galerie/');
        $files = scandir($path);
        return view("galerie")->with(["files" => $files]);
    }

    public function envoieContact(Request $request)
    {
        $email = $request->input("email");
        $message = $request->input("message");
        $robot = $request->input('antir');
        $ipUser = $_SERVER['REMOTE_ADDR'];
        $checkPhoto = MessagePhoto::query()->where('ip','=',$ipUser)->get();
        $tabMessageUser = [];
        foreach ($checkPhoto as $item){
            if(Carbon::parse($item->created_at)->format('Y-m-d') == Carbon::now()->format('Y-m-d')){
                $tabMessageUser[] = $item;
            }
        }
        if(count($tabMessageUser) > 3 ) {
            return redirect()->to(url()->previous() . '#error')->with("error", "Vous avez déja envoyé deux messages aujourd'hui, nous allons vous recontacter. ");
        }

        if ($robot == "photo") {
            $newmessage = new MessagePhoto();
            $newmessage->email = $email;
            $newmessage->message = $message;
            $newmessage->ip = $_SERVER['REMOTE_ADDR'];
            $newmessage->save();

            Mail::to('leo.vincent5@gmail.com')->send(new sendMessage($newmessage));

            return redirect()->to(url()->previous() . '#success')->with("success", "Votre message a bien été envoyé, nous vous recontacterons des que possible ! ");
        } else {
            return redirect()->to(url()->previous() . '#error')->with("error", "Veuillez renseigner le champs capcha");
        }

    }

    public function souscat($name)
    {

        $path = public_path('img/galerie/' . $name . '/');
        $files = scandir($path);
        return view("sousGalerie")->with(["files" => $files, "name" => $name]);
    }

    public function admin()
    {

        if (Auth::user()->id == 1) {
            $paniers = Panier::all();
            $paiement = Paiement::all();
            $messages = MessagePhoto::all();
            return view("admin")->with(["paniers" => $paniers,"paiements" => $paiement, 'messages' => $messages ]);
        }
    }

    public function filtre()
    {

        $path1 = public_path('img/galerie/');
        $concours = scandir($path1);

        foreach ($concours as $concour) {
            if ($concour == "." or $concour == "..") {

            } else {

                $path2 = public_path('img/galerie/' . $concour . '/');
                $clubs = scandir($path2);
                foreach ($clubs as $club) {
                    if ($club == "." or $club == ".." or $club == "preview.jpg" or $club == "preview.JPG") {

                    } else {
                        $path = public_path('img/galerie/' . $concour . '/' . $club . '/');
                        $files = scandir($path);
                        foreach ($files as $file15) {
                            if ($file15 == "." or $file15 == ".." or (preg_match("/encode/i", $file15) > 0) or (preg_match("/traiter/i", $file15) > 0) or (preg_match("/vignette/i", $file15) > 0)) {
                            } else {
                                $lien = ("img/galerie/" . $concour . "/" . $club . "/" . $file15);
                                $lienEncode = ("img/galerie/" . $concour . "/" . $club . "/encode-" . $file15);
                                $photo = new Photo();
                                $photo->name = $lien;
                                $encodage = hash('sha256', $file15);
                                $photo->encode = $encodage;
                                $photo->name_notbuy = $lienEncode;
                                $photo->save();

//                              dd($concour, $club);
                                // Dans ce cas, il s'agit d'un fichier PNG
                                // l'image est envoyée telle quelle
                                header("Content-type: image/png");
                                // Definir l'image de fond. Une image JPEG peut etre utilisee avec la fonction
                                // imagecreatefromjpeg
                                $background = imagecreatefromjpeg("img/galerie/" . $concour . "/" . $club . "/" . $file15);
                                // Definition de limage overlay qui sera incluse dans l image background
                                $insert = imagecreatefrompng("img/calque.png");
                                // Selection du premier pixel de l image overlay (a la position 0,0) et utiliser
                                // la couleur de ce pixel comme couleur transparente
                                imagecolortransparent($insert, imagecolorat($insert, 0, 0));
                                // Recuperation des dimensions de l'image
                                $insert_x = imagesx($insert);
                                $insert_y = imagesy($insert);

                                imagealphablending($background, true);
                                imagesavealpha($background, true);

                                // Combiner les images (la fonction imagcopy() peut marcher mais bug souvent)
                                // imagejpeg($background,"img/galerie/" . $concour . "/" . $club . "/traiter-".$file15,100);
                                imagecopymerge($background, $insert, 0, 0, 0, 0, $insert_x, $insert_y, 100);

                                // Envoyer le resultat au navigateur (note : l inclusion dans du HTML n'est pas obligatoire)
                                imagejpeg($background, "img/galerie/" . $concour . "/" . $club . "/encode-" . $file15, 100);
                                rename("img/galerie/" . $concour . "/" . $club . "/" . $file15, "img/galerie/" . $concour . "/" . $club . "/traiter-" . $encodage . '.jpg');

                                list($width_orig, $height_orig) = getimagesize("img/galerie/" . $concour . "/" . $club . "/encode-" . $file15);
                                $image_p = imagecreatetruecolor($width_orig / 4, $height_orig / 4);
                                $image5 = imagecreatefromjpeg("img/galerie/" . $concour . "/" . $club . "/encode-" . $file15);
                                imagecopyresized($image_p, $image5, 0, 0, 0, 0, $width_orig / 4, $height_orig / 4, $width_orig, $height_orig);
                                // Envoyer le resultat au navigateur (note : l inclusion dans du HTML n'est pas obligatoire)

                                imagejpeg($image_p, "img/galerie/" . $concour . "/" . $club . "/vignette-" . $file15, 100);
                                rename("img/galerie/" . $concour . "/" . $club . "/vignette-" . $file15, "img/galerie/" . $concour . "/" . $club . "/vignette-" . $file15);
                            }

                        }
                    }


                }

            }

        }


        return view("club")->with(['name' => $concour, 'club' => $club, 'files' => $files]);
    }

    public function reserve($name, $club, $file)
    {
        $file = "img/galerie/" . $name . "/" . $club . "/" . $file;
        $file = str_replace('vignette','encode',$file);

        $photo = Photo::query()->where('name_notbuy','LIKE','%'.$file.'%')->first();
        //dd($photo,$file);
        return view("reserve")->with(["file" => $file, 'photo' => $photo]);
    }

    public function club($name, $club)
    {
        $path = public_path('img/galerie/' . $name . '/' . $club . '/');
        $files = scandir($path);

        return view("club")->with(['name' => $name, 'club' => $club, 'files' => $files]);
    }

    public function envoi(Request $request)
    {
        $envoi = new photoReservation();
        $envoi->email = $request->input("email");
        $string = "";
        foreach ($request->input('unite') as $unite) {
            $string .= " " . $unite;
        }
        $envoi->pack = $string;
        $envoi->text = $request->input("text");
        $envoi->photo = $request->input("photo");

        $envoi->save();
        return back()->with('status', 'Votre reservation a été envoyée!');

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function projetweb(Request $request)
    {
        $text = $request->input('text');
        $email = $request->input('email');
        $tel = $request->input('tel');

        $newdevis = new Devis();
        $newdevis->text = $text;
        $newdevis->email = $email;
        $newdevis->tel = $tel;
        $newdevis->save();

        Mail::to('leo.vincent5@gmail.com')->send(new sendDevis($newdevis));

        return back()->with("success", "Votre message a bien été envoyé, nous vous recontacterons des que possible ! ");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function web()
    {
        return view('siteweb');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function shooting()
    {

        return view('shooting');
    }

    public function addPanier(Request $request)
    {
        $photo = $request->photo_name;
        $photos = Photo::query()->where('name', '=', $photo)->first();
        $idUser = Auth::user()->id;
        $checkPanier = Panier::query()->where('id_user', '=', $idUser)->where('id_photo', '=', $photos->id)->first();

        if ($checkPanier == null) {
            $panier = new Panier();
            $panier->id_user = $idUser;
            $panier->id_photo = $photos->id;
            $panier->save();
             return "success";
        } else {
            $checkPanier->delete();
            return "deleted";
        }


    }

    public function history(){
        $achat = Paiement::query()->where('id_user','=',Auth::user()->id)->get();
        $packs = PackModel::query()->where('id_user','=',Auth::user()->id)->get();
        return view('history')->with(['achats' => $achat , 'packs' => $packs]);
    }

    public function panier()
    {
        $paniers = Panier::query()->where('id_user','=',Auth::user()->id)->get();
        $packs = PackPhoto::query()->where('id_user','=',Auth::user()->id)->get();

        return view("panier")->with(['paniers' => $paniers, 'packs' => $packs]);
    }

    public function addPanierSpeed(Request $request){
        $name = $request->photo_name;
        $photo = Photo::query()->where('name','like',$name)->first();

        $check  = Panier::query()->where('id_photo','=',$photo->id)->where('id_user','=',Auth::user()->id)->get();

        if (count($check) == 0){
            $panier = new Panier();
            $panier->id_user = Auth::user()->id;
            $panier->id_photo = $photo->id;
            $panier->save();
             return "good";
        } else {
            foreach ($check as $item){
                $item->delete();
            }
            return "delete";
        }
    }
    public function getPanier(){
        $paniers = Panier::query()->where('id_user','=',Auth::user()->id)->get();


        $panierTempons = PanierTempon::query()->where('id_user','=',Auth::user()->id)->get();
        foreach ($panierTempons as $panierTempon){
            $panierTempon->delete();
        }

        foreach ($paniers as $panier){
            $newTempon = new PanierTempon();
            $newTempon->id_user = Auth::user()->id;
            $newTempon->id_photo = $panier->id_photo;
            $newTempon->id_photo_panier_last  = $paniers->last()->id;
            $newTempon->save();
        }
        $object = [
            "count" => count($paniers),
            "id_tempon" => $paniers->last()->id
        ];

        return $object ;
    }

    public function addPack(Request $request){
        $tab = $request->tab;
        $cle = $request->cle;
        $tabJson = [];
        foreach ($tab as $item){
            if (strpos($item,$cle)){
                 $photo = Photo::query()->where('name','=',$item)->first();
                 $tabJson[] = $photo->id;
            }

        }

        $explode = explode('/',$photo->name);
        $val = "";
        $cpt = 0;
        foreach ($explode as $item){
            if ($cpt == count($explode)-1){
                $val .= "/vignette-".$item;
            } elseif($cpt ==0 ) {
                 $val .= $item;
            } else {
                $val .= "/".$item;
            }

            $cpt++;
        }

        $pack = new PackPhoto();
        $pack->photos = json_encode($tabJson);
        $pack->id_user = Auth::user()->id;
        $pack->cle = $cle;
        $pack->preview = $val;
        $pack->nbphotos = count($tabJson);
        $pack->save();

        return "good";
    }

    public function deletepack(Request $request){
        $id = $request->id;
        $pack = PackPhoto::query()->find($id);
        if ($pack->id_user == Auth::user()->id){
            $pack->delete();
            return "good";
        }
        return "piratage";
    }

    public function paiementPack(Request $request,$id){
        $idPack = $id;
        $pack = PackPhoto::query()->where('id','=',$id)->where('id_user','=',Auth::user()->id)->first();
        $trimPhoto = substr($pack->photos,'1');
        $trimPhoto = substr($trimPhoto,'0',strlen($trimPhoto)-1);
        $explodePhoto = explode(',',$trimPhoto);
        $arrayIdPhoto = [];
        foreach ($explodePhoto as $item){
            $arrayIdPhoto[] = (int)trim($item);
        }
        $photos = Photo::query()->whereIn('id',$arrayIdPhoto)->get();
        $tarif = count($photos)*2.5;
        if ($tarif > 25){
            $tarif = 25;
        }
        return view('packPhoto')->with(['photos' => $photos, 'tarif' => $tarif, 'pack_id' => $pack->id]);

    }

    public function paiementAjaxPack(Request $request){
        $details = $request->details;
        $pack_id = $request->pack_id;
        $tarif = $request->tarif;

        $packPhoto = PackPhoto::find($pack_id);
       // dd($packPhoto->photos);
        $pack = new PackModel();
        $pack->pack_id = (int)$pack_id;
        $pack->id_user = Auth::user()->id;
        $pack->details = json_encode($details);
        $pack->prix = $tarif;
        $pack->photos = $packPhoto->photos;
        $pack->preview = $packPhoto->preview;
        //dd($pack);
        $pack->save();

        $packPhoto->delete();


        return "paiement-ok";


    }


    public function ShowPack($id) {
        $pack = PackModel::query()->where('id_user','=',Auth::user()->id)->where('id','=',$id)->first();

        if (!empty($pack)){


         $trimPhoto = substr($pack->photos,'1');
        $trimPhoto = substr($trimPhoto,'0',strlen($trimPhoto)-1);
        $explodePhoto = explode(',',$trimPhoto);
        $arrayIdPhoto = [];
        foreach ($explodePhoto as $item){
            $arrayIdPhoto[] = (int)trim($item);
        }
        $photos = Photo::query()->whereIn('id',$arrayIdPhoto)->get();
            return view('packshow')->with(['photos' => $photos]);
        }
    }


    public function getPaiementAjax(){
        $paiements = Paiement::all();

        foreach ($paiements as $paiement){

        }
    }

    public function codePromo(){
        $code = useCode::query()->where('id_user','=',Auth::user()->id)->get();
        $nb = count($code);
        $nbPhoto = NbPhotoUser::query()->where('user_id','=',Auth::user()->id)->first();
        $paniers = Panier::query()->where('id_user','=',Auth::user()->id)->get();
        return view('codePromo',['paniers' => $paniers,'nb' => $nb,'nbPhoto' => $nbPhoto]);
    }

    public function drive(){
        return view('drive');
    }

    public function login_drive(Request $request){

        $repertoire = 'drives/'.strtolower($request->input('drive'));
        if (!file_exists($repertoire)){
            return redirect()->back()->with('error', "le code que vous avez saisie est incorrect");
        }
        $newMariage = new CompteurMariage();
        $newMariage->name = strtolower($request->input('drive'));
        $newMariage->ip = $_SERVER['REMOTE_ADDR'];
        $newMariage->save();

        $fichiersAvecChemins = File::allFiles($repertoire);

        $perPage = 20; // Nombre d'éléments par page
        $fichiers = array_slice($fichiersAvecChemins, 0, $perPage);
        return view("drive_unique",['files' => $fichiers, 'repertoire' => $request->input('drive')]);

    }

    public function telechargerImage($repertoire,$nomFichier)
    {
        $cheminFichier = "drives/{$repertoire}/{$nomFichier}";

        return response()->download($cheminFichier);
    }

    public function download($repertoire){
        $encRepertoire = urlencode($repertoire);
        $cheminFichier = "drives/".$encRepertoire.".zip";
//        $cheminFichier = "drives/couple.jpg";

        $headers = [
            'Content-Type' => 'application/x-rar-compressed',
        ];

        return response()->download($cheminFichier,null,$headers);
    }

    public function loadmore($repertoire, int $nb){
        $simple_repertoir = $repertoire;
        $repertoire = 'drives/'.$repertoire;
        $fichiersAvecChemins = File::allFiles($repertoire);
        $perPage =  20; // Nombre d'éléments par page
        $fichiers = array_slice($fichiersAvecChemins, $nb, $perPage);

        $result = "";
        foreach ($fichiers as $key => $fichier){
            $result .= '  <div class="col-md-4 col-sm-6 co-xs-12 ">
                           <div class="box">
                        <a title="Image '.($key+$nb+1).'">
                       <img style="width: -webkit-fill-available;" class="thumbnail img-responsive" id="image-'.($key+$nb+1).'" src="'.asset($fichier).'" alt="image '.($key+$nb).'" loading="lazy"></a>
                    </div>
                    </div>';
        }
        return $result;
    }

    public function loadmorehidden($repertoire, int $nb){
        $simple_repertoir = $repertoire;
        $repertoire = 'drives/'.$repertoire;
        $fichiersAvecChemins = File::allFiles($repertoire);
        $perPage =  20; // Nombre d'éléments par page
        $fichiers = array_slice($fichiersAvecChemins, $nb, $perPage);

        $result = "";
        foreach ($fichiers as $key => $fichier){
            $result .= '   <div class="item" id="image-'.($key+$nb+1).'">
                    <img style="max-height: 82vh;width: -webkit-fill-available;object-fit: contain;"
                         class="thumbnail img-responsive modalImg" title="Image '.($key+$nb+1).'" src="'.asset($fichier).'"
                         loading="lazy">
                </div>';
        }
        return $result;
    }

}
