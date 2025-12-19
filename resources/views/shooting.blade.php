@extends('layouts.app')


@section('content')
    <h1 class="mt-5 mb-5" style=" text-align:center;">Réserver votre shooting</h1>



    <div class="container" style="">
        <div style="text-align: center" ><h3><i>Prix flexible / N'hésitez pas à envoyer un message.<br> En moyenne la séance est de 50 €  + ( 0.5 € / km ) + <br> ( 5 € de l'heure )</i> </h3></div>
        @if(session()->has('success'))
            <div class="alert alert-success" id="success" style="z-index: 20000">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger" id="error" style="z-index: 20000">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="container">
            <form method="post" action="{{route('envoieformulaire')}}">
                @csrf


            <div class="form-group m-5">
                <label for="exampleFormControlInput1" style="font-size: 1em;">Votre adresse
                    mail</label>
                <input required="required" type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                <small>Votre mail ne servira qu'à vous recontacter , en aucun cas à d'autres fins commerciales.</small>
            </div>
            <div class="mt-5">
                <div class="form-group m-5">
                    <label for="exampleFormControlTextarea1">Que souhaitez-vous ? </label>
                    <textarea  required="required" name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                </div>


                <div class="form-group  m-5">
                    <label for="exampleInputEmail1">Anti-Robot</label>
                    <input type="text" name="antir" required class="form-control" id="antir" aria-describedby="emailHelp" placeholder="Ecrivez : 'photo'">
                    <small id="emailHelp" class="form-text text-muted">Merci d'écrire 'photo' pour verifier que vous n'êtes pas un robot.</small>
                </div>


                <div class="form-group  m-5">

                    <button type="submit" class=" mt-3 btn btn-primary">Envoyer</button>
                    <a href="/"><button type="button" class=" mt-3 btn btn-danger">Retour</button></a>

                </div>



            </div>
            </form>
        </div>

    <div class="galerie container">
        <div class="row">
            <div class="col-sm-4">
                <img class="mb-4" src="img/shoot/1.jpg" style="width: inherit">
            </div>
            <div class="col-sm-4">
                <img class="mb-4" src="img/shoot/2.jpg" style="width: inherit">
            </div>
            <div class="col-sm-4">
                <img class="mb-4" src="img/shoot/4.jpg" style="width: inherit">
            </div>
            <div class="col-sm-4">
                <img class="mb-4" src="img/shoot/5.jpg" style="width: inherit">
            </div>
            <div class="col-sm-4">
                <img class="mb-4" src="img/shoot/6.jpg" style="width: inherit">
            </div>
            <div class="col-sm-4">
                <img class="mb-4" src="img/shoot/7.jpg" style="width: inherit">
            </div>
        </div>
    </div>


@endsection
