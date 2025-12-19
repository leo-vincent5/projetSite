@extends("layouts.app")
@section("css")
    <style>
        @import url(https://fonts.googleapis.com/css?family=Quicksand:400,300);
        body{
            font-family: 'Quicksand', sans-serif;
        }
        .gal-container{
            padding: 12px;
        }
        .gal-item{
            overflow: hidden;
            padding: 3px;
        }
        .gal-item .box{
            height: 350px;
            overflow: hidden;
        }
        .box img{
            width: 100%;
            height: auto;
            max-width: 100%;
            object-fit: contain;

        }
        .gal-item a:focus{
            outline: none;
        }
        .gal-item a:after{
            content:"\e003";
            font-family: 'Glyphicons Halflings';
            opacity: 0;
            background-color: rgba(0, 0, 0, 0.75);
            position: absolute;
            right: 3px;
            left: 3px;
            top: 3px;
            bottom: 3px;
            text-align: center;
            line-height: 350px;
            font-size: 30px;
            color: #fff;
            -webkit-transition: all 0.5s ease-in-out 0s;
            -moz-transition: all 0.5s ease-in-out 0s;
            transition: all 0.5s ease-in-out 0s;
        }
        .gal-item a:hover:after{
            opacity: 1;
        }
        .modal-open .gal-container .modal{
            background-color: rgba(0,0,0,0.4);
        }
        .modal-open .gal-item .modal-body{
            padding: 0px;
        }
        .modal-open .gal-item button.close{
            position: absolute;
            width: 25px;
            height: 25px;
            background-color: #000;
            opacity: 1;
            color: #fff;
            z-index: 999;
            right: -12px;
            top: -12px;
            border-radius: 50%;
            font-size: 15px;
            border: 2px solid #fff;
            line-height: 25px;
            -webkit-box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
            box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
        }
        .modal-open .gal-item button.close:focus{
            outline: none;
        }
        .modal-open .gal-item button.close span{
            position: relative;
            top: -3px;
            font-weight: lighter;
            text-shadow:none;
        }
        .gal-container .modal-dialogue{
            width: 80%;
        }
        .gal-container .description{
            position: relative;
            height: 40px;
            top: -40px;
            padding: 10px 25px;
            background-color: rgba(0,0,0,0.5);
            color: #fff;
            text-align: left;
        }
        .gal-container .description h4{
            margin:0px;
            font-size: 15px;
            font-weight: 300;
            line-height: 20px;
        }
        .gal-container .modal.fade .modal-dialog {
            -webkit-transform: scale(0.1);
            -moz-transform: scale(0.1);
            -ms-transform: scale(0.1);
            transform: scale(0.1);
            top: 100px;
            opacity: 0;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }

        .gal-container .modal.fade.in .modal-dialog {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
            -webkit-transform: translate3d(0, -100px, 0);
            transform: translate3d(0, -100px, 0);
            opacity: 1;
        }
        @media (min-width: 768px) {
            .gal-container .modal-dialog {
                width: 55%;
                margin: 50 auto;
            }
        }
        @media (max-width: 768px) {
            .gal-container .modal-content{
                height:250px;
            }
        }
        /* Footer Style */
        i.red{
            color:#BC0213;
        }
        .gal-container{
            padding-top :75px;
            padding-bottom:75px;
        }
        footer{
            font-family: 'Quicksand', sans-serif;
        }
        footer a,footer a:hover{
            color: #88C425;
        }
        main{
            text-align: center;
            text-align: -webkit-center;
        }

        .thumbnail {margin-bottom:6px;}

        .carousel-control.left,.carousel-control.right{
            background-image:none;
            margin-top:10%;
            width:5%;
        }

         #gallery{
                align-items: center;
                max-width: 70vw;
                margin: auto;
        }

        @media only screen and (max-width: 600px) {
          #gallery {
                max-width: 100vw;
                width: 100vw;

          }
        }

        .imgforeach, .resizingImg {
            width: 100%;
            height: auto;
            max-width: 100%;
            object-fit: contain;
        }

        @-moz-document url-prefix() {
              .imgforeach {
                width: -moz-available;
              }
              .resizingImg{
                width: -moz-available;
              }
        }

        #message-container {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #review-link {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        #review-link:hover {
            background-color: #45a049;
        }

    </style>
@endsection
@section("content")
    @csrf
    <a href="./">
        <button class="btn btn-danger">Explorer le site
            <svg width="16px" height="16px" fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 495.398 495.398" xml:space="preserve"
                 stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <g>
                            <g>
                                <path
                                    d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"></path>
                                <path
                                    d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"></path>
                            </g>
                        </g>
                    </g>
                </g></svg>
        </button>
    </a>

    <a href="/drives/{{$repertoire}}.zip">
        <button id="dlALL" class="btn btn-success">Télécharger toutes les photos
            <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                 stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12"
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>
        </button>
    </a>
    @if($repertoire === "mariage05")
    <div id="message-container">
        <p>Chers amis et proches qui avez partagé ce jour exceptionnel avec nous,</p>
        <p>Capturer les moments précieux de ce mariage a été un honneur absolu. Vos sourires, vos rires et vos émotions ont donné vie à chaque photo.</p>
        <p>J'aimerais immortaliser vos sentiments dans les commentaires. Pourriez-vous prendre un instant pour partager vos pensées sur notre expérience commune?</p>
        <p>Chaque commentaire et note sur Google compte énormément et contribue à mettre en avant mon travail et ainsi me lancer à 100% alors merci d'avance 😊</p>
        <a id="review-link" href="https://g.page/r/CZZ40g-d2bUDEB0/review" target="_blank">Laisser un commentaire sur Google</a>
    </div>
    @endif

    <div class="container gal-container row" id="gallery">

        @foreach($files as $key =>  $file)
            <div class="col-md-4 col-sm-6 co-xs-12 ">
                <div class="box">
                    <a title="Image 1" >
                        <img class="thumbnail img-responsive imgforeach"
                             id="image-{{$key+1}}" src="{{asset($file)}}" alt="image de {{$key}}" loading="lazy"></a>
                </div>
            </div>
        @endforeach

        <div class="hidden" id="img-repo" style="display: none">
            @foreach($files as $key  => $file)
                <div class="item" id="image-{{$key+1}}">
                    <img
                         class="thumbnail img-responsive modalImg resizingImg" title="Image {{$key+1}} / 632" src="{{asset($file)}}"
                         loading="lazy">
                </div>
            @endforeach

        </div>


        <div class="modal" id="modal-gallery" role="dialog">
            <div class="modal-dialog" style="width: 95vw; max-width: 95vw; max-height: 99vh;">
                <div class="modal-content" style="    height: 98VH;">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">×</button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div id="modal-carousel" class="carousel">

                            <div class="carousel-inner">

                            </div>
                        </div>
                    </div>
                    <div id="buttonNav" style="position: absolute;
    bottom: 3VH;
    width: 100%;">
                                <a class="carousel-control left" id="prec" data-image="1" data-slide="prev">
                                    <svg height="38px" width="38px" version="1.1" id="Layer_1"
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         viewBox="0 0 512 512" xml:space="preserve" fill="#000000"
                                         transform="rotate(180)matrix(1, 0, 0, -1, 0, 0)"><g id="SVGRepo_bgCarrier"
                                                                                             stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <circle style="fill:#71E2F0;" cx="256" cy="256" r="256"></circle>
                                            <path style="fill:#38C6D9;"
                                                  d="M190.338,405.356L294.15,509.168c86.556-12.934,158.941-69.198,194.395-146.013L363.972,238.582 L190.338,405.356z"></path>
                                            <path style="fill:#263A7A;"
                                                  d="M287.494,265.447l-97.22,97.22c-11.783,11.783-11.781,30.884,0,42.667l0,0 c11.783,11.781,30.884,11.781,42.667,0l128-128c11.783-11.781,11.781-30.884,0-42.667l-128-128 c-11.783-11.781-30.884-11.781-42.667,0l0,0c-11.783,11.781-11.781,30.884,0,42.667l97.22,97.22 C292.712,251.771,292.712,260.23,287.494,265.447z"></path>
                                            <path style="fill:#121149;"
                                                  d="M291.407,256c0,3.418-1.305,6.839-3.913,9.447l-97.22,97.22c-11.783,11.781-11.783,30.884,0,42.667 l0,0c11.783,11.781,30.884,11.781,42.667,0l128-128c5.891-5.891,8.837-13.612,8.837-21.333H291.407z"></path>
                                        </g></svg>
                                </a>
                                <a id="dlPhoto"
                                   href="{{ route('telecharger.image', ['nomFichier' => $file->getFilename(),'repertoire' => $repertoire]) }}"
                                   class="btn btn-primary">Télécharger l'image</a>
                                <a class="carousel-control right" id="next" data-image="1" href="#modal-carousel"
                                   data-slide="next">
                                    <svg height="38px" width="38px" version="1.1" id="Layer_1"
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g
                                            id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <circle style="fill:#71E2F0;" cx="256" cy="256" r="256"></circle>
                                            <path style="fill:#38C6D9;"
                                                  d="M190.338,405.356L294.15,509.168c86.556-12.934,158.941-69.198,194.395-146.013L363.972,238.582 L190.338,405.356z"></path>
                                            <path style="fill:#263A7A;"
                                                  d="M287.494,265.447l-97.22,97.22c-11.783,11.783-11.781,30.884,0,42.667l0,0 c11.783,11.781,30.884,11.781,42.667,0l128-128c11.783-11.781,11.781-30.884,0-42.667l-128-128 c-11.783-11.781-30.884-11.781-42.667,0l0,0c-11.783,11.781-11.781,30.884,0,42.667l97.22,97.22 C292.712,251.771,292.712,260.23,287.494,265.447z"></path>
                                            <path style="fill:#121149;"
                                                  d="M291.407,256c0,3.418-1.305,6.839-3.913,9.447l-97.22,97.22c-11.783,11.781-11.783,30.884,0,42.667 l0,0c11.783,11.781,30.884,11.781,42.667,0l128-128c5.891-5.891,8.837-13.612,8.837-21.333H291.407z"></path>
                                        </g></svg>
                                </a>
                            </div>
                </div>
            </div>
        </div>

    </div>

    <button id="loadMore" class="btn btn-primary" data-nb="20">Charger plus d'images</button>

    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warningModalLabel">Avertissement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Attention</b> : Si vous utilisez actuellement une connexion 4G pour visionner les photos, le visionnement de médias peut entraîner une utilisation importante de données et peut augmenter les coûts associés à votre forfait 4G.</p>
                    <p>Nous vous recommandons de basculer vers une connexion Wi-Fi pour économiser sur les frais de données mobiles. Souhaitez-vous continuer à visionner les photos en utilisant la connexion 4G? <br><br><br>Léo d'<a href="https://equicode.fr/">Equicode</a> 🦄 </p>
                </div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Je continue</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#warningModal').modal('show');
            /* activate the carousel */
            $("#modal-carousel").carousel({interval:false});

            /* change modal title when slide changes */
            $("#modal-carousel").on("slid.bs.carousel",       function () {
                $(".modal-title")
                    .html($(this)
                        .find(".active img")
                        .attr("title"));
            });

            /* when clicking a thumbnail */
            $("#next").click(function(){

                var content = $(".carousel-inner");
                var title = $(".modal-title");

                content.empty();
                title.empty();

                var id = "image-"+$(this)[0].dataset.image
                console.log(id)
                var repo = $("#img-repo .item");
                var repoCopy = repo.filter("#" + id).clone();
                var active = repoCopy.first();

                active.addClass("active");
                title.html(active.find("img").attr("title"));
                content.append(repoCopy);
                if ( parseInt($(this)[0].dataset.image) % 20 === 0 ){
                    $("#loadMore").click();
                }
                let nb = parseInt($(this)[0].dataset.image) + 1
                $(this)[0].dataset.image = nb
                $("#prec")[0].dataset.image = nb - 2
                $("#dlPhoto")[0].href = "/telecharger-image/{{$repertoire}}/"+ $(".carousel-inner img")[0].src.split('/').pop()
            });

            $("#prec").click(function(){

                var content = $(".carousel-inner");
                var title = $(".modal-title");

                content.empty();
                title.empty();

                var id = "image-"+$(this)[0].dataset.image
                console.log(id)
                var repo = $("#img-repo .item");
                var repoCopy = repo.filter("#" + id).clone();
                var active = repoCopy.first();

                active.addClass("active");
                title.html(active.find("img").attr("title"));
                content.append(repoCopy);
                $(this)[0].dataset.image = parseInt($(this)[0].dataset.image) - 1
                $("#next")[0].dataset.image = parseInt($("#next")[0].dataset.image) - 1
                $("#dlPhoto")[0].href = "/telecharger-image/{{$repertoire}}/"+ $(".carousel-inner img")[0].src.split('/').pop()
            });

            $(document).on('click',".row .thumbnail", function(){
                var content = $(".carousel-inner");
                var title = $(".modal-title");

                content.empty();
                title.empty();

                var id = this.id;
                var repo = $("#img-repo .item");
                var repoCopy = repo.filter("#" + id).clone();
                var active = repoCopy.first();

                active.addClass("active");
                title.html(active.find("img").attr("title"));
                content.append(repoCopy);
                console.log(id)
                let realId = id.split('-')
                if ( parseInt(realId[1]) % 20 === 0 ){
                    $("#loadMore").click();
                }
                $("#next")[0].dataset.image = parseInt(realId[1]) + 1
                $("#prec")[0].dataset.image = parseInt(realId[1]) - 1
                // show the modal
                $("#modal-gallery").modal("show");
                $("#dlPhoto")[0].href = "/telecharger-image/{{$repertoire}}/"+ $(".carousel-inner img")[0].src.split('/').pop()
            });


            var page = 2; // Commence à la deuxième page (la première est déjà chargée côté serveur)

            $(document).ready(function() {


                function isElementInViewport(el) {
                    var rect = el.getBoundingClientRect();

                    return (
                        rect.top >= 0 &&
                        rect.left >= 0 &&
                        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                    );
                }


                function hello(){
                    if (window.innerWidth >= 768) {
                        var myElement = document.getElementById('loadMore');
                    if (isElementInViewport(myElement)) {
                        console.log('L\'élément est maintenant visible à l\'écran.');
                        $("#loadMore").click();
                        // Faites quelque chose lorsque l'élément devient visible
                    } else {
                        console.log('L\'élément n\'est pas visible à l\'écran.');
                        // Faites quelque chose lorsque l'élément n'est plus visible
                    }
                    }
                }

                setInterval(hello, 2000);

                // Fonction pour charger plus d'images
                function loadMoreImages(test) {
                    let nb = $(test)[0].dataset.nb
                    console.log(nb)
                    let repertoire = "{{$repertoire}}"
                    $.ajax({
                        url: '/loadmore/'+repertoire+'/'+nb,
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#gallery').append(data); // Remplacez '#gallery' par l'ID de votre conteneur d'images
                            page++; // Incrémente le numéro de page pour la prochaine requête
                            test.dataset.nb = parseInt(test.dataset.nb)+20;

                        },
                        error: function() {
                            console.log('Erreur lors du chargement des images.');
                        }
                    });
                }

                function loadMoreImageshidden(test) {
                    let nb = $(test)[0].dataset.nb
                    console.log(nb)
                    let repertoire = "{{$repertoire}}"
                    $.ajax({
                        url: '/loadmorehidden/'+repertoire+'/'+nb,
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#img-repo').append(data); // Remplacez '#gallery' par l'ID de votre conteneur d'images
                            page++; // Incrémente le numéro de page pour la prochaine requête
                            $('#loadMore').removeAttr('disabled');
                        },
                        error: function() {
                            console.log('Erreur lors du chargement des images.');
                        }
                    });
                }

                // Écouteur d'événement pour charger plus d'images lorsque le bouton est cliqué
                $('#loadMore').on('click', function() {
                    $('#loadMore').attr('disabled', 'disabled');
                    loadMoreImages(this);
                    loadMoreImageshidden(this);

                });
            });

        });



    </script>
@endsection
