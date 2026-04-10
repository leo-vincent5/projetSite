@extends('layouts.app')


@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="    max-width: 50vw;
    margin: auto;    min-width: 365px;">
        <div style="text-align: -webkit-center;">
            <a href="/">
                <img style="width: 50%;" alt="logo" src="img/equicode.png">

            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="padding: 20px; margin: 20px;">

            <h1>Forfaits de Shooting Photo de Mariage</h1>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="padding: 20px; margin: 20px;">
            <div class="forfait" id="forfait1">
                <h2>Forfait Bronze - L'Essentiel du Bonheur</h2>
                <p class="prix"></p>
                <p>Capturez les moments essentiels de votre journée spéciale avec notre Forfait Bronze - L'Essentiel du Bonheur. Conçu pour ceux qui recherchent une couverture de base mais de qualité pour leur mariage, ce forfait vous offre une expérience de photographie simple mais mémorable.</p>
                <h3>Caractéristiques du forfait :</h3>
                <ul>
                    <li>4 heures de couverture de mariage</li>
                    <li>Prise de vue par un photographe professionnel</li>
                    <li>Édition de base des photos sélectionnées</li>
                    <li>Album photo en ligne pour partager et télécharger vos images</li>
                </ul>
                <a href="{{route('reservation_mariage',['forfait' => 'bronze'])}}" class="btn">Réserver maintenant</a>
            </div>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="padding: 20px; margin: 20px;">
            <div class="forfait" id="forfait2">
                <h2>Forfait Argent - L'Élégance Captivante</h2>
                <p class="prix"></p>
                <p>Offrez-vous une expérience de mariage élégante et captivante avec notre Forfait Argent - L'Élégance Captivante. Avec une couverture plus étendue et des services supplémentaires, ce forfait est parfait pour ceux qui recherchent un niveau de sophistication supplémentaire pour leur journée spéciale.</p>
                <h3>Caractéristiques du forfait :</h3>
                <ul>
                    <li>8 heures de couverture de mariage</li>
                    <li>Prise de vue par un photographe professionnel</li>
                    <li>Édition complète des photos sélectionnées</li>
                    <li>Album photo de luxe imprimé</li>
                    <li>Séance de photos de fiançailles</li>
                </ul>
                <a href="{{route('reservation_mariage',['forfait' => 'argent'])}}" class="btn">Réserver maintenant</a>
            </div>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="padding: 20px; margin: 20px;">
            <div class="forfait" id="forfait3">
                <h2>Forfait Or - La Magie Intemporelle</h2>
                <p class="prix"></p>
                <p>Vivez la magie intemporelle de votre mariage avec notre Forfait Or - La Magie Intemporelle. Offrant une couverture complète et des services exclusifs, ce forfait vous assure des souvenirs inoubliables qui captureront chaque instant de votre journée spéciale dans toute sa splendeur.</p>
                <h3>Caractéristiques du forfait :</h3>
                <ul>
                    <li>Journée complète de couverture de mariage</li>
                    <li>Prise de vue des préparatifs de la mariée </li>
                    <li>Prise de vue par un photographe professionnel et un assistant</li>
                    <li>Édition haut de gamme des photos sélectionnées</li>
                    <li>Album photo de luxe personnalisé</li>
                    <li>Session de photos de pré-mariage</li>
                    <li>Livraison rapide des images éditées</li>
                    <li>Session de visionnage des photos avec le photographe</li>
                </ul>
                <a href="{{route('reservation_mariage',['forfait' => 'or'])}}" class="btn">Réserver maintenant</a>
            </div>

        </div>



        <div class="categories d-flex flex-wrap justify-content-around">
            <a href="#" class="category-link">Voir des photos de mariage</a>
            <a href="{{route('help_price')}}" class="category-link">Pourquoi ce prix ?</a>
        </div>




@endsection


@section('css')
<style>


    .forfait{
        margin-top: 50px;
    }

    h1 {
        color: #333;
    }
    p {
        color: #666;
    }
    .prix {
        background: linear-gradient(to left, #761c4a, #600425);
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        margin-bottom: 10px;
        display: inline-block;
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    .btn {
        background: linear-gradient(to left, #761c4a, #600425);
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 20px;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background: linear-gradient(to left, #600425, #761c4a);
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

@endsection
