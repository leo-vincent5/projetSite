@extends('layouts.app')

@section('content')

        <h1 class="mt-5 mb-5" style=" text-align:center;">Devis pour votre mariage</h1>



        <div class="container" style="">
            <h1>Tarification flexible pour vos souvenirs inoubliables de mariage</h1>

            <p>Chez Equicode, nous comprenons que chaque mariage est unique et mérite une attention particulière. C'est pourquoi nos tarifs varient en fonction de plusieurs facteurs, notamment la distance à parcourir pour rejoindre votre lieu de mariage et les demandes spécifiques de nos clients.</p>

            <p>Le prix de nos forfaits de photographie de mariage est déterminé en tenant compte du kilométrage nécessaire pour couvrir votre événement et pour capturer chaque moment spécial. Nous ajustons également nos tarifs en fonction des demandes spécifiques telles que les heures supplémentaires de couverture, les séances pré-mariage et les impressions supplémentaires.</p>

            <p>Pour garantir la transparence et la satisfaction de nos clients, nous établissons un contrat détaillé pour chaque mariage. Ce contrat spécifie clairement les services inclus, les heures de couverture, les délais de livraison et les conditions de paiement. Nous croyons fermement à la clarté et à la communication ouverte tout au long du processus, afin de nous assurer que nos clients savent exactement à quoi s'attendre pour leur grand jour.</p>

            <p>En tant que professionnel, Equicode s'engage à fournir des souvenirs inoubliables de votre mariage. Nous sommes enregistrés en tant qu'entreprise individuelle et nous fournissons des factures détaillées pour chaque transaction. Vous pouvez être assuré que vous travaillez avec un prestataire de services fiable et légitime.</p>

            <p>Si vous cherchez des souvenirs de mariage sur mesure, adaptés à vos besoins spécifiques et à votre budget, contactez-nous chez Equicode. Nous sommes là pour capturer chaque instant magique de votre journée spéciale, en garantissant un service professionnel, transparent et de qualité à chaque étape du processus.</p>
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
                <form method="post" action="{{route('sendReservation')}}">
                    @csrf


                    <div class="form-group m-5">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Forfait</label>
                        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="forfait">
                            <option @if(isset($forfait)) selected @endif >Choisir...</option>
                            <option @if($forfait === "bronze") selected @endif value="bronze">Forfait Bronze - L'Essentiel du Bonheur - À partir de 400 €</option>
                            <option @if($forfait === "argent") selected @endif value="argent">Forfait Argent - Élégance Immortalisée - À partir de 800 €</option>
                            <option @if($forfait === "or") selected @endif  value="or">Forfait Or - L'Harmonie Personnalisée - À partir de 2000 €</option>
                        </select>
                    </div>


                    <div class="form-group m-5">
                        <label for="exampleFormControlInput1" style="font-size: 1em;">Votre adresse
                            mail</label>
                        <input required="required" type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        <small>Votre mail ne servira qu'à vous recontacter , en aucun cas à d'autres fins commerciales.</small>
                    </div>

                    <div class="form-group m-5">
                        <label for="exampleFormControlInput1" style="font-size: 1em;">Numéro de téléphone</label>
                        <input required="required" type="tel" name="telephone" class="form-control" id="exampleFormControlInput1" placeholder="0606441824">
                        <small>Votre numéro de téléphone ne servira qu'à vous recontacter , en aucun cas à d'autres fins commerciales.</small>
                    </div>

                    <div class="form-group m-5">
                        <label for="exampleFormControlInput1" style="font-size: 1em;">La localistation de votre mariage</label>
                        <input required="required" type="text" name="localisation" class="form-control" id="exampleFormControlInput1" placeholder="Avignon">
                        <small>Pour définir le coût de déplacement</small>
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


@section('css')
    <style>
        p{font-size: large;}
    </style>
@endsection
