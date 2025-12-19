@extends('layouts.app')


@section('content')
     @if(session()->has('success'))
    <div class="alert alert-success" style="z-index: 20000">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="container-fluid"><img style="margin-left: -20px;width: 100vw;margin-top: -50px" src="img/perso/code.jpg" alt="fond"> </div>
    <h1 class="mt-5 mb-5" style=" text-align:center;">Obtenir votre devis pour votre site web</h1>


    <div class="container" style="">
        <div style="text-align: center" ><h3><i>Vous êtes particulier ou professionnel ? Vous avez un projet qui vous tient à coeur mais vous n'avez pas des millions d'euros ? Vous êtes au bon endroit! </i> </h3></div>

        <div class="container">
            <form method="post" action="{{route('projet-web')}}" >
                @csrf
                <div class="form-group m-5">
                    <label for="exampleFormControlInput1" style="font-size: 1em;">Votre adresse
                        mail</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    <small>Votre mail ne servira qu'a vous recontacter , en aucun cas à d'autres fins commerciales</small>
                </div>
                <div class="form-group m-5">
                    <label for="exampleFormControlInput1" style="font-size: 1em;">Numéro de téléphone</label>
                    <input type="tel" name="tel" class="form-control" id="exampleFormControlInput1" placeholder="06 06 06 06 06">
                    <small>Facultatif : Si vous souhaitez être recontacté par téléphone </small>
                </div>
                <div class="mt-5">
                    <div class="form-group m-5">
                        <label for="exampleFormControlTextarea1">Que souhaitez-vous ? </label>
                        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <input type="submit" class="mt-3 btn btn-primary" value="Envoyer">
                    </div>

                </div>
            </form>
        </div>

@endsection
