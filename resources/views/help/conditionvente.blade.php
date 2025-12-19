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

            <h1>Conditions Générales de Vente</h1>

            <h2>1. Objet</h2>
            <p>Les présentes Conditions Générales de Vente (ci-après les "CGV") ont pour objet de définir les conditions dans lesquelles Equicode (ci-après "le Prestataire") propose ses services de photographie et de développement web à ses clients (ci-après "le Client").</p>

            <h2>2. Prestations proposées</h2>
            <p>Le Prestataire propose les services suivants :</p>
            <ul>
                <li>Photographie de mariage et d'événements</li>
                <li>Séances photo en famille ou entre amis</li>
                <li>Développement de sites web et de solutions digitales</li>
            </ul>

            <h2>3. Commandes</h2>
            <p>Les commandes de services se font par téléphone, par email ou via le site web du Prestataire. Le Client s'engage à fournir des informations exactes et complètes lors de la commande.</p>

            <h2>4. Tarifs</h2>
            <p>Les tarifs des services sont indiqués sur le site web du Prestataire ou communiqués au Client lors de la demande de devis. Ils peuvent varier en fonction des spécificités de chaque projet.</p>

            <h2>5. Paiement</h2>
            <p>Le paiement des services peut s'effectuer par virement bancaire, carte de crédit ou tout autre moyen de paiement accepté par le Prestataire. Un acompte peut être demandé lors de la commande, le solde étant payable à la livraison des services.</p>

            <h2>6. Annulation et remboursement</h2>
            <p>En cas d'annulation de commande par le Client, des frais d'annulation peuvent être appliqués. Le Prestataire se réserve le droit de facturer des frais pour les travaux déjà effectués.</p>

            <h2>7. Propriété intellectuelle</h2>
            <p>Le Prestataire reste propriétaire de tous les droits de propriété intellectuelle attachés aux travaux réalisés, sauf accord contraire stipulé dans un contrat spécifique.</p>

            <h2>8. Responsabilités</h2>
            <p>Le Prestataire s'engage à fournir les services conformément aux attentes du Client et dans les délais convenus. Cependant, il ne saurait être tenu responsable des retards ou des dommages causés par des événements indépendants de sa volonté.</p>

            <h2>9. Confidentialité</h2>
            <p>Le Prestataire s'engage à respecter la confidentialité des informations fournies par le Client dans le cadre de la réalisation des services.</p>

            <h2>10. Litiges</h2>
            <p>En cas de litige, les parties s'engagent à rechercher une solution amiable. À défaut d'accord, les tribunaux compétents seront ceux du lieu d'immatriculation du Prestataire.</p>

            <p>Fait à Villeneuve lez avignon, le 16/03/2024</p> <div style="width: 100%;"><h4 style="margin: auto; width: fit-content;">Léo d'Equicode 🦄</h4></div>


            <div><a href="/" class="btn btn-primary white-background" style=" background: linear-gradient(to left, #761c4a, #600425);
                    border: none;
                    padding: 20px;
                    margin-top: 10px">Revenir à l'accueil</a></div>
        </div>
    </div>





@endsection
@section('css')
    <style>

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
            margin-top: 30px;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            margin-bottom: 10px;
        }
        ul {
            margin-bottom: 20px;
        }
        li {
            margin-bottom: 5px;
        }
    </style>


@endsection
