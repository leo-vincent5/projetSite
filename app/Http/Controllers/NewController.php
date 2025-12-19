<?php

namespace App\Http\Controllers;

use App\Insta;
use App\Models\Mariage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewController extends Controller
{

    public function reservation_mariage(Request $request){
        return view('mariage.reservation')->with(['forfait' => $request->input('forfait')]);
    }
    public function sendReservation(Request $request){
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $localisation = $request->input('localisation');
        $message = $request->input('message');
        $forfait = $request->input('forfait');
        $capcha = $request->input('antir');

        if ($capcha !== "photo"){
            return redirect()->to(url()->previous() . '#error')->with("error", "Veuillez renseigner le champs capcha");
        }

        $newMariage = new Mariage();
        $newMariage->telephone = $telephone;
        $newMariage->message = $message;
        $newMariage->localisation = $localisation;
        $newMariage->email = $email;
        $newMariage->forfait = $forfait;
        $newMariage->save();

        return redirect()->to(url()->previous() . '#success')->with("success", "Votre message a bien été envoyé, nous vous recontacterons des que possible ! ");


    }

    public function help_price(){
        return view('help.price');
    }

    public function cgv(){
        return view('help.conditionvente');
    }

    public function legal(){
        return view('help.legal');
    }


    public function forfaits(){
        return view('forfaits.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $response = Http::get('https://www.instagram.com/photographelu/?__a=1');
        //dd($response);
        $insta = Insta::all();
        return view('new')->with(['codes' => $insta]);
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
}
