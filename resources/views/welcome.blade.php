<!DOCTYPE html>
<html style="scroll-behavior: smooth;" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Photographe professionnel et créateur de sites web à Avignon. Capturez des moments précieux avec notre expertise en photographie et mettez en valeur votre entreprise en ligne. Contactez-nous aujourd'hui.">
        <title>Equicode</title>

        <!-- Fonts -->
        <style>
            /* cyrillic-ext */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 200;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIOOaBXso.woff2) format('woff2');
                unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
            }
            /* cyrillic */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 200;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIMeaBXso.woff2) format('woff2');
                unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
            }
            /* vietnamese */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 200;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIOuaBXso.woff2) format('woff2');
                unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
            }
            /* latin-ext */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 200;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIO-aBXso.woff2) format('woff2');
                unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
            }
            /* latin */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 200;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofINeaB.woff2) format('woff2');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }
            /* cyrillic-ext */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 600;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIOOaBXso.woff2) format('woff2');
                unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
            }
            /* cyrillic */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 600;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIMeaBXso.woff2) format('woff2');
                unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
            }
            /* vietnamese */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 600;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIOuaBXso.woff2) format('woff2');
                unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
            }
            /* latin-ext */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 600;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofIO-aBXso.woff2) format('woff2');
                unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
            }
            /* latin */
            @font-face {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 600;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/nunito/v26/XRXV3I6Li01BKofINeaB.woff2) format('woff2');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }
        </style>
        <link href="css/boostrap.css" rel="stylesheet">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 40px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 79px;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #fond1 {
                width: 100vw;
            }
            #essais {

            }
            #photo1{
                width: 50vh;
            }
             .triangle {
                    visibility: hidden;
                    display: none;
                }

            @media (max-width: 480px) {
              #photo1 {
                width: 100vw;
              }
}

        </style>

	<style type="text/css">
			html, body {
				padding:0;
				margin:0;
				position:relative;
			}
            .subtitle{
                font-size: 1.25rem;
            }

            .white-background {
                background: linear-gradient(to left, #761c4a, #600425);
                border: none;
                padding: 20px;
            }
            /*.firsttitle{*/
            /*    transition: 1s ease-in 2s;*/
            /*}*/
            /*.firsttitle:hover{*/
            /*    scale: 2;*/
            /*    rotate: 90deg;*/
            /*}*/

            @keyframes fleche {
              0% {bottom: -18vh;}
              50% {bottom: -23vh;}
              0% {bottom: -18vh;}
            }

            /* The element to apply the animation to */
            #fleche {
              animation-name: fleche;
              animation-duration: 2s;
              animation-iteration-count: infinite;

            }

        #choix2{
            height: 223px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }


            .forfaits {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }
            .forfait {
                flex: 1;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .prix {
                background: linear-gradient(to left, #761c4a, #600425);
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 10px 0px;
                font-weight: bold;
                margin-bottom: 10px;
                display: inline-block;
                background-clip: text;
                -webkit-background-clip: text;
                color: transparent;
            }

            .btMariage:hover {
                background: linear-gradient(to left, #600425, #761c4a);
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }

            .images-preview {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }
            .image-preview {
                flex: 1;
                margin-right: 10px;
            }
            .image-preview img {
                width: 100%;
                border-radius: 5px;
            }
            .categories {
                margin-top: 20px;
            }
            .category-link {
                margin-right: 20px;
                color: #007bff;
                text-decoration: none;
                font-weight: bold;
            }
            .category-link:hover {
                text-decoration: underline;
            }



            @media (max-width: 768px) {
                .infomariage {
                    width: 100%;
                    margin-top: 10px;
                }
                .btn {
                    width: 100%;
                }
                .ml-3, .mx-3 {
                    margin-left: 0rem !important;
                    margin-top: 10px;
                }
            }
		</style>

    </head>
    <body>

        <div class="flex-center position-ref full-height" style="background-image: url('img/fond1.webp'); background-size: cover; background-position: center" >
            @if (Route::has('login'))
                <div class="top-right links" style="z-index: 5;position: absolute">
                    @auth
                        <a href="{{ url('/dashboard') }}">Accueil</a>
                    @else
                        <a href="{{ route('login') }}">Se connecter</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">S'enregistrer</a>
                        @endif
                    @endauth
                </div>
            @endif

{{--            <img src="img/fond1.jpg" id="fond1"  style="z-index: 0;">--}}
            <div class="content" style="z-index: 5; position:absolute; color: white;">
                <div class="title firsttitle">
                    Equicode
                </div>
                <div id="choix2" class="links" >
                    <a style="color: white" href="#shootingphoto"><button class="btn btn-primary white-background" style="min-width: 100px;min-height: 30px;    font-size: 25px;">Photographie</button></a>
                    <a style="color: white" href="#creationsite"><button class="btn btn-primary white-background" style="min-width: 100px;min-height: 30px;    font-size: 25px;">Création Web</button></a>
                </div>
                <a style="color: white;font-size: 2rem;" href="#shootingphoto">Le digital au galop</a>
                <a href="#menu">
                    <img id="fleche" alt="icon en forme de fleche" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABT0lEQVR4nO3ZPUscURgF4JssMYqIKClsgo0QMIVgY5FCUvjDTJkqnV3AzsZCLFJYqQSj6A8IpAiIiAgSEoLlEwbvwpLgR5R134H3gYVhZvfuOZxySkl3g33slbZTlbaTRYLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRaLJRR4LdnGIqYe+emvOqGftlAG95Gx8xcv7Fml+W89ofOlb4BsCTDR/XAN8x8z/FsE0vtWvHOFF34NfE2Qcn2uQU7y+axG8wnF9fIDJMkgYxVYNdIa524pgFif10TbGSgR4jo0a7AIL1xXBPM7r7U8YKZFgCOs14C+8/bsI3uBHvbWJ4RIROlitQX9jqVsEi/hZr9fwrETmqszHGviyp0j3unnWKW2AJ/jgXyt4WtoG73pKvG8KlrbCcvMZdI7SFn8AtWPBxt+WGKYAAAAASUVORK5CYII=" style="
    /* font-size: 1px; */
    position: absolute;
    bottom: -18vh;
    left: 46%;
    /* padding-bottom: 11vh; */

">
                </a>
            </div>

        </div>
        <div style="margin: 10vw;
    z-index: 5;
    position: inherit;">
        </div>

    <div class="d-flex justify-content-around " id="menu" style="max-width: 100vw;">
        <h2 class="demo main">Qui suis-je ?</h2>
    </div>
    <div class="container">

          <div id="resultsdiv" class="row">
              <div class="col">

              </div>
          </div>
          <div class="row mt-3" style="justify-content: center">
              <div class="col-sm-6">
                  <p style="font-size: larger" class="mt-5">
                      @php
                          $dateNaissance = \Carbon\Carbon::createFromDate(1999, 3, 25);
                          $aujourdHui = \Carbon\Carbon::now();
                          $age = $aujourdHui->diffInYears($dateNaissance);
                      @endphp
                      Bonjour ! Je suis Léo VINCENT photographe sur Avignon, le visage derrière Equicode. À {{$age}} ans, je jongle entre mes passions la photographie et le développement web.
                      <br>
                      <br>
                      Que vous recherchiez un photographe pour immortaliser vos moments spéciaux (mariage, événement, ect...) ou un développeur web pour créer votre présence en ligne, je suis là pour vous. Avec Equicode, vous obtenez bien plus qu'un simple site web ou des photos, vous obtenez une expérience unique et personnalisée.
                      <BR>
                      <br>
                      Je m'engage à capturer chaque instant avec émotion et authenticité. Que ce soit pour des événements, des séances en famille, ou des projets professionnels, je suis là pour rendre chaque moment inoubliable.
                      <br>
                      <br>
                      Et en parlant de sites web, je suis là pour vous aider à briller en ligne. De la création de sites web élégants à la gestion de votre présence sur les réseaux sociaux, je vous accompagne pour que votre entreprise se démarque.
                      <br>
                      <br>
                      Alors, si vous êtes prêt à donner vie à vos idées et à créer des souvenirs qui dureront toute une vie, rejoignez-moi chez Equicode. Ensemble, faisons de chaque instant un moment à retenir, et de chaque clic une étape vers le succès en ligne !
                  </p>
              </div>

              <div class="col-sm-6" style="text-align: center;     text-align: -webkit-center;     align-self: center; max-width: 100vw;">
                  <img id="photo1" src="img/perso/2.jpg" loading="lazy" class="d-flex row justify-content-around" alt="photo">
                  <a target="_blank" href="https://www.instagram.com/equicode_captures/"><div style="display: inline-flex;justify-content: center;align-items: center; margin-top: 20px;">
                      <img src="logo/insta.png" alt="logoinsta" style="max-width: 40px;">
                      <div style="    color: black;
    font-size: larger;">#Equicode_captures</div>
                  </div>
                  </a>

              </div>
          </div>


      </div>


        <div class="mt-5" style="background-image: url('img/mariage.webp'); background-size: cover; height: 40vw; display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column;
min-height: 300px;">
            <h1 style="color: white;text-align: center">
                Mes préstations de mariages
            </h1>
        </div>



        <div class="container mt-5" id="shootingphoto">
            <h1 style="text-align: center;margin-bottom: 30px;">Forfaits de Shooting Photo de Mariage</h1>

            <div class="forfaits">
                <div class="forfait">
                    <h2>Forfait Bronze - L'Essentiel du Bonheur</h2>
                    <p class="prix"><i>~ 50 photos</i></p>
                    <p>Capturez les moments magiques de votre journée spéciale avec notre Forfait Bronze. Idéal pour les mariages intimes, ce forfait offre une couverture professionnelle pendant la mairie et le vin d'honneur, capturant les moments les plus précieux. Vous recevrez une sélection soigneusement choisie de photos, reflétant l'essence de votre bonheur. Des souvenirs intemporels à un prix accessible, ce forfait vous offre une belle introduction à notre art de la photographie de mariage.</p>
                    <a href="{{route('forfaits')}}" class="btn btn-primary white-background btMariage">En savoir plus</a>
                </div>

                <div class="forfait">
                    <h2>Forfait Argent - Élégance Immortalisée</h2>
                    <p class="prix"><i>~ 150 photos</i></p>
                    <p>Notre Forfait Argent vous offre une expérience photographique enrichie, capturant chaque instant avec une précision exceptionnelle. Profitez d'une couverture étendue de 6 heures, assortie de retouches de base pour sublimer vos souvenirs. En prime, recevez 5 tirages photo de haute qualité, créant une galerie physique de vos moments inoubliables. L'Élégance Immortalisée offre une fusion parfaite entre qualité et accessibilité.</p>
                    <a href="{{route('forfaits')}}" class="btn btn-primary white-background btMariage">En savoir plus</a>
                </div>

                <div class="forfait">
                    <h2>Forfait Or - L'Harmonie Personnalisée</h2>
                    <p class="prix"><i>~ 400 photos</i></p>
                    <p>Le Forfait Or offre une expérience de photographie de mariage inégalée, créant une harmonie parfaite entre la capture artistique et la personnalisation exceptionnelle. Profitez d'une couverture étendue, avec des retouches avancées pour sublimer chaque image. En plus d'une collection complète de photos, recevez 20 tirages photo haut de gamme et un somptueux album personnalisé. Laissez-nous transformer votre journée en une œuvre d'art intemporelle avec L'Harmonie Personnalisée.</p>
                    <a href="{{route('forfaits')}}" class="btn btn-primary white-background btMariage">En savoir plus</a>
                </div>
            </div>


            <div class="mt-5">
                <h2>Les avis</h2>
                <div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
                    <img src="img/avis.png" alt="avis de mariés tres heureux" style="max-width: 90vw; height: min-content">
                    <img src="img/avis1.png" alt="avis d'une femme tres heureuse ! " style="max-width: 90vw;height: min-content">
                </div>

            </div>


            <div class="categories" style="    max-width: 600px; display: flex; flex-wrap: wrap;     justify-content: space-between;">
                <a href="#" class=" btn btn-primary white-background btMariage infomariage" style="">Voir des photos de mariage</a>
                <a href="{{route('help_price')}}" class=" btn btn-primary white-background btMariage infomariage"  style="">Pourquoi ce prix ?</a>
                <a target="_blank" href="https://g.co/kgs/pyh8dy8" class="btn btn-primary white-background btMariage infomariage" style="">Voir plus d'avis ?</a>
            </div>



        </div>

        <div class="mt-5" style="background-image: url('img/TESTmariage.webp'); background-size: cover; height: 40vw; display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column;
min-height: 300px;">

        </div>




    <div class="container mt-5" id="shootingphoto">
        <h1 style="color: #636b6f;text-align: center">
                 Shooting photo
             </h1>
     <div class="row mt-5">
         <div class="col-sm-3">
             <img src="img/shoot/1.jpg" class="d-block w-100" alt="shooting d'une femme sur la plage" loading="lazy">
         </div>
        <div class="col-sm-3">
             <img src="img/shoot/2.jpg" class="d-block w-100" alt="shooting d'un poney happy !" loading="lazy">
         </div>
         <div class="col-sm-3">
             <img src="img/shoot/4.jpg" class="d-block w-100" alt="shooting d'une modele heureuse" loading="lazy">
         </div>
         <div class="col-sm-3">
             <img src="img/shoot/5.jpg" class="d-block w-100" alt="shooting handicapé heureux " loading="lazy">
         </div>

        </div>

        <h2 class="mt-5" style="text-align: center"> Vous avez un moment que vous souhaitez capturer ?</h2>
        <p style="text-align: center; font-size: 3vh">Un anniversaire, un mariage ? Ou juste un moment de tendresse que vous souhaitez garder à tout jamais ? </p>
        <div style="text-align: center"><a href="{{route('shooting')}}"><button class="btn btn-primary white-background">En savoir plus</button></a><a href="{{route('drive')}}"><button class="btn btn-primary white-background ml-3">Accédez à vos photos</button></a></div>
</div>


        <div class="mt-5" style="background-image: url('img/fond2.jpg'); background-size: cover; height: 40vw; display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column;
min-height: 300px;">
            <h1 style="color: white;text-align: center">
                Vous nous avez vus sur un concours ?
            </h1>
            <a href="{{route("gallery")}}">
                <button class="btn btn-primary white-background" style="min-width: 100px;min-height: 30px;">Cliquer ici pour visionner vos photos</button>
            </a>

        </div>

<div class="container mt-3">
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
</div>

         <h1 style="margin: 10px;width: revert; text-align: center  ; margin-top: 8rem!important;" id="contact" class=" mt-2 d-flex row justify-content-around ">
             Vous avez une question ? Contactez-nous
         </h1>
         <div class="container" style="z-index: 5000;">
                <form method="post" action="{{route('envoieformulaire')}}">
                    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Adresse Email</label>
    <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre adresse mail">
    <small id="emailHelp" class="form-text text-muted">Votre adresse mail sera utilisée pour vous recontacter, en aucun cas pour des démarchages commerciaux.</small>
  </div>
    <div class="form-group">
    <label for="exampleFormControlTextarea1">Votre message</label>
    <textarea class="form-control" name="message" required id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
                    <div class="form-group">
    <label for="exampleInputCaptcha">Anti-Robot</label>
    <input type="text" name="antir" required class="form-control" id="antir" aria-describedby="captchaHelp" placeholder="Ecrivez : 'photo'">
    <small id="captchaHelp" class="form-text text-muted">Merci d'écrire 'photo' pour verifier que vous n'êtes pas un robot.</small>
  </div>
  <button type="submit" class="btn btn-primary white-background">Envoyer</button>
</form>

                </div></div>


         <div id="creationsite" class="mt-5" style="background-image: url('img/carou/1.jpg'); background-size: cover; height: 40vw; display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column;
min-height: 300px;">
             <h1 style="color: white;text-align: center">
                 Création de site internet
             </h1>
         </div>


      <div class="container mt-5">
          <h1 style="color: white;text-align: center;color: #636b6f" class="mt-5">
                Professionel ou particulier, vous avez besoin d'un site internet ?
            </h1>
      </div>




      <div class="container">

          <div id="resultsdiv" class="row">
              <div class="col">

              </div>
          </div>
          <div class="row mt-3" style="justify-content: center">
              <div class="col-sm-6" style="text-align: center;     text-align: -webkit-center;     align-self: center; max-width: 100vw;">
                  <img id="photo1" loading="lazy" src="img/perso/codage.jpg"  class="d-flex row justify-content-around mt-5" alt="photo">
              </div>
              <div class="col-sm-6">
                  <p style="font-size: larger" class="mt-5">
                      Que vous soyez professionel ou particulier, mettez-vous en avant sur internet grâce à Equicode.
                      <br>
                      Pour répondre à la crise sanitaire, Equicode propose des tarifs abordables pour permettre à tous de se lancer sur internet. <br> Vous êtes restaurateur ou vendeur? <br> Equicode se déplace pour prendre en photo vos articles et discuter de vos souhaits en terme de site internet pour cibler vos différents clients. <br><br>Vous avez une idée? Un projet qui vous tient à coeur? Lancez-vous sur internet à nos cotés :
                  </p>
                  <div id="centeritems" style="text-align: center"><a href="{{route('creation-web')}}"><button class="btn btn-primary white-background">En savoir plus </button></a></div>
              </div>

          </div>


      </div>

      
<div 
  id="iframeOverlay"
  style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; align-items: center; justify-content: center;"
  onclick="closeIframe(event)"
>
  <iframe 
    src="https://exaltec.net/chatbot-user?c55e814b-9ee6-49d7-9b23-38e1d447f3c2"
    style="width: 500px; height: 80vh; border: none; border-radius: 8px;"
    onclick="event.stopPropagation()"
  ></iframe>
</div>

<button 
  id="chatBtn" class="" 
  style="position: fixed; bottom: 20px; right: 20px; width: 60px; height: 60px; border-radius: 50%;background: linear-gradient(to left, #761c4a, #600425); color: white; border: none; cursor: pointer; box-shadow: 0 4px 8px rgba(0,0,0,0.3); z-index: 1000; font-size: 24px;"
  onclick="toggleIframe()"
>
<img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2Ij48cGF0aCBmaWxsPSJjdXJyZW50Q29sb3IiIGQ9Ik04IDJhLjc1Ljc1IDAgMCAwLS43NS43NVY1SDUuNWEyLjk5IDIuOTkgMCAwIDAtMi45NTcgMi41SDIuNUMxLjY4IDcuNSAxIDguMTggMSA5djFjMCAuODIuNjggMS41IDEuNSAxLjVoLjA0M0EyLjk5IDIuOTkgMCAwIDAgNS41IDE0aDVhMi45OSAyLjk5IDAgMCAwIDIuOTU3LTIuNWguMDQzYy44MiAwIDEuNS0uNjggMS41LTEuNVY5YzAtLjgyLS42OC0xLjUtMS41LTEuNWgtLjA0M0EyLjk5IDIuOTkgMCAwIDAgMTAuNSA1SDguNzVWMi43NUEuNzUuNzUgMCAwIDAgOCAyTTYgNi43NWMuNjg2IDAgMS4yNS41NjQgMS4yNSAxLjI1UzYuNjg2IDkuMjUgNiA5LjI1UzQuNzUgOC42ODYgNC43NSA4UzUuMzE0IDYuNzUgNiA2Ljc1bTQgMGMuNjg2IDAgMS4yNS41NjQgMS4yNSAxLjI1UzEwLjY4NiA5LjI1IDEwIDkuMjVTOC43NSA4LjY4NiA4Ljc1IDhTOS4zMTQgNi43NSAxMCA2Ljc1bS00LjUgNGg1YS43NS43NSAwIDAgMSAuNzUuNzVhLjc1Ljc1IDAgMCAxLS43NS43NWgtNWEuNzUuNzUgMCAwIDEtLjc1LS43NWEuNzUuNzUgMCAwIDEgLjc1LS43NSIvPjwvc3ZnPg==" alt="bot Ia"
style="width: 32px; height: 42px;     filter: invert(1);">
</button>

    <footer  class="container py-5" style="margin-top: 7rem!important; max-width: 100vw;">
      <div class="row" style="text-align: center;align-items: center">
        <div id="essais" class="col-12 col-md">
         <img src="img/essais-logo.png" loading="lazy" style="width: 30vh" alt="logo">
          <small class="d-block mb-3 text-muted">© 2021</small>
        </div>
        <div class="col-6 col-md">
          <div class="subtitle">Photographie</div>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Photos sur concours</a></li>
            <li><a class="text-muted" href="#">Shooting Photo</a></li>
            <li><a class="text-muted" href="#">Galerie</a></li>
            <li><a class="text-muted" href="#">Achat de photo commerciale</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
            <div class="subtitle">Création Web</div>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Introduction</a></li>
            <li><a class="text-muted" href="#">Professionel</a></li>
            <li><a class="text-muted" href="#">Particulier</a></li>
            <li><a class="text-muted" href="#">Centre equestre</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <div class="subtitle">Contact</div>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="tel:+33606441824">tel 06.06.44.18.24</a></li>
            <li><a class="text-muted" href="#">Instagram</a></li>
            <li><a class="text-muted" href="#">Facebook</a></li>
            <li><a class="text-muted" href="#">Nous écrire</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
            <div class="subtitle">Equicode</div>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Equipe</a></li>
            <li><a class="text-muted" target="_blank" href="https://www.societe.com/etablissement/equicode-89375134700012.html">Fiche entreprise</a></li>
            <li><a class="text-muted" href="/cgv">Condition Générale de ventes</a></li>
            <li><a class="text-muted" href="/legal">Mention légales</a></li>
          </ul>
        </div>
      </div>
    </footer>
    </body>

    <script type="text/javascript">


        function toggleIframe() {
        const overlay = document.getElementById('iframeOverlay');
        overlay.style.display = overlay.style.display === 'flex' ? 'none' : 'flex';
        }

        function closeIframe(event) {
        if (event.target.id === 'iframeOverlay') {
        document.getElementById('iframeOverlay').style.display = 'none';
        }
        }

			window.onload = function(){
				snow.init(10);
			};



var snow = {

	wind : 0,
	maxXrange : 100,
	minXrange : 10,
	maxSpeed : 2,
	minSpeed : 1,
	color : "#fff",
	char : "*",
	maxSize : 20,
	minSize : 8,

	flakes : [],
	WIDTH : 0,
	HEIGHT : 0,

	init : function(nb){
		var o = this,
			frag = document.createDocumentFragment();
		o.getSize();



		for(var i = 0; i < nb; i++){
			var flake = {
				x : o.random(o.WIDTH),
				y : - o.maxSize,
				xrange : o.minXrange + o.random(o.maxXrange - o.minXrange),
				yspeed : o.minSpeed + o.random(o.maxSpeed - o.minSpeed, 100),
				life : 0,
				size : o.minSize + o.random(o.maxSize - o.minSize),
				html : document.createElement("span")
			};

			flake.html.style.position = "absolute";
			flake.html.style.top = flake.y + "px";
			flake.html.style.left = flake.x + "px";
			flake.html.style.fontSize = flake.size + "px";
			flake.html.style.color = o.color;
			flake.html.appendChild(document.createTextNode(o.char));

			frag.appendChild(flake.html);
			o.flakes.push(flake);
		}

		document.body.appendChild(frag);
		o.animate();

		window.onresize = function(){o.getSize();};
	},

	animate : function(){
		var o = this;
		for(var i = 0, c = o.flakes.length; i < c; i++){
			var flake = o.flakes[i],
				top = flake.y + flake.yspeed,
				left = flake.x + Math.sin(flake.life) * flake.xrange + o.wind;
			if(top < o.HEIGHT - flake.size - 10 && left < o.WIDTH - flake.size && left > 0){
				flake.html.style.top = top + "px";
				flake.html.style.left = left + "px";
				flake.y = top;
				flake.x += o.wind;
				flake.life+= .01;
			}
			else {
				flake.html.style.top = -o.maxSize + "px";
				flake.x = o.random(o.WIDTH);
				flake.y = -o.maxSize;
				flake.html.style.left = flake.x + "px";
				flake.life = 0;
			}
		}
		setTimeout(function(){
			o.animate();
		},20);
	},

	random : function(range, num){
		var num = num?num:1;
		return Math.floor(Math.random() * (range + 1) * num) / num;
	},

	getSize : function(){
		this.WIDTH = document.body.clientWidth || window.innerWidth;
		this.HEIGHT = document.body.clientHeight || window.innerHeight;
	}

};

		</script>



</html>
