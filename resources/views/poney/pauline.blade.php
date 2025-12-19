<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Page Vidéo avec Autoplay au Scroll</title>
    <link rel="stylesheet" href="css/poney.css">
</head>
<body>

<div id="loader">
    <img src="img/cabre.gif" alt="Chargement...">
</div>

<header>
    <h1>OUPSIDOUPSI <BR>CHARDON</h1>
    <img src="img/poney/oupsi.png" alt="Logo" class="logo-penche" style="   position: relative;
    top: -57px;
    left: -124px;
    transform: rotate(341deg);
">
</header>

<div class="banner">
    <p>Disponible à la reservation</p>

</div>

<main>
    <div class="video-container">
        <video id="myVideo" controls MUTED >
            <source src="poney.mov" type="video/mp4">
            Votre navigateur ne supporte pas la lecture de cette vidéo.
        </video>
    </div>
</main>


<!-- Première galerie photo - Slider -->
<section class="gallery">
    <h2>Moi Bébé</h2>
    <div class="slider" id="slider1" style="margin-top: 30px">
        <div class="slides">
            <img src="img/poney/4.jpeg" alt="Poney 1">
            <img src="img/poney/5.jpeg" alt="Poney 2">
            <img src="img/poney/6.jpeg" alt="Poney 3">
            <img src="img/poney/7.jpeg" alt="Poney 3">
        </div>
    </div>


    <div class="description">
        <b>Oupsidoupsi Chardon</b>, mâle alezan dun né le 26 mai 2024, sera grand standard voire petit B.

        <p>Caractère très proche de l’homme, joueur et curieux. Oupsidoupsi sera un parfait poney d’enfant, le copain idéal pour toute une famille !</p>

        <p>Il est à jour de vermifuge, de parage, se laisse manipuler, brosser de partout et apprécie vraiment le contact avec l’humain. Il marche en longe, se laisse curer les pieds, bref, il a tout d’un grand (le tout, en respectant son rythme de poulain !). Il se déplace bien, sera grand et charpenté.</p>
    </div>

  </section>

<!-- Deuxième galerie photo - Slider -->
<section class="gallery">
    <h2>Moi maintenant </h2>
    <img src="img/poney/oupsi2.png" alt="Logo" class="logo-penche" style="    position: relative;
    top: -57px;
    left: 128px;
    transform: rotate(341deg);
">
    <div class="slider" id="slider2">
        <div class="slides">
            <img src="img/poney/oupsi (1).jpeg" alt="Poney 1">
            <img src="img/poney/oupsi (2).jpeg" alt="Poney 2">
            <img src="img/poney/oupsi (3).jpeg" alt="Poney 3">
            <img src="img/poney/oupsi (4).jpeg" alt="Poney 4">
            <img src="img/poney/oupsi (5).jpeg" alt="Poney 5">
            <img src="img/poney/oupsi (6).jpeg" alt="Poney 6">
            <img src="img/poney/oupsi (7).jpeg" alt="Poney 7">
            <img src="img/poney/oupsi (8).jpeg" alt="Poney 8">
            <img src="img/poney/oupsi (9).jpeg" alt="Poney 9">
            <img src="img/poney/oupsi (10).jpeg" alt="Poney 10">
            <img src="img/poney/oupsi (11).jpeg" alt="Poney 11">
            <img src="img/poney/oupsi (12).jpeg" alt="Poney 12">

        </div>
    </div>
</section>

<!-- Troisième galerie photo - Slider -->
<section class="gallery" style="    margin-top: 0; ">
    <h2 style="margin-bottom: 20px;">Ma maman</h2>
    <div class="slider" id="slider3">
        <div class="slides">
            <img src="img/poney/maman (1).jpeg" alt="Poney 1">
            <img src="img/poney/maman (2).jpeg" alt="Poney 2">
        </div>
    </div>
    <div class="description2">
        <p><b>Mère : Unique des Marettes</b> (alezane crins lavés), par Djedai de Cottard et Odyssée d’Incarville (Pander Prince of Spring C)</p>
    </div>
</section>


<!-- Troisième galerie photo - Slider -->
<section class="gallery" style="    margin-top: 0; ">
    <h2 style="margin-bottom: 20px;">Mon papa</h2>
    <div class="slider" id="slider4">
        <div class="slides">
            <img src="img/poney/papa (1).jpg" alt="Poney 1">
            <img src="img/poney/papa (2).jpg" alt="Poney 2">
        </div>
    </div>
    <div class="description2">
        <p><b>Père : Crema Brunsdecrau </b> (alezan dun), par Spirit d’Incarville (bons résultats en CSO) et Maya des Brunsdecrau (Master des Bruns de Crau), classifié 1 avec une note de 16,5/20</p>
    </div>
</section>


</main>

<footer class="contact-section">
    <h2>Me contacter</h2>
    <div class="contact-info">
        <a href="mailto:pauline.chiri@hotmail.fr" class="contact-button">📧 Envoyer un email</a>
        <a href="tel:+33641957566" class="contact-button">📞 Appeler 06 41 95 75 66</a>
    </div>
</footer>

<script src="script.js"></script>
<script>

    window.addEventListener('load', function() {
        const loader = document.getElementById('loader');
        loader.style.display = 'none';
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Autoplay video au scroll
        const video = document.getElementById("myVideo");

        function handleVideoPlayback() {
            const videoRect = video.getBoundingClientRect();
            const isVideoVisible = videoRect.top >= 0 && videoRect.bottom <= window.innerHeight;

            if (isVideoVisible && video.paused) {
                video.play().catch(error => console.log("Autoplay bloqué par le navigateur :", error));
            } else if (!isVideoVisible && !video.paused) {
                video.pause();
            }
        }

        window.addEventListener("scroll", handleVideoPlayback);
        window.addEventListener("resize", handleVideoPlayback);
        handleVideoPlayback();

        // Slider automatique
        function setupSlider(sliderId) {
            const slider = document.getElementById(sliderId);
            const slides = slider.querySelector('.slides');
            const images = slides.querySelectorAll('img');
            let currentIndex = 0;

            function showNextSlide() {
                currentIndex = (currentIndex + 1) % images.length;
                slides.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            setInterval(showNextSlide, 3000); // Change d'image toutes les 3 secondes
        }

        setupSlider('slider1');
        setupSlider('slider2');
        setupSlider('slider3');
        setupSlider('slider4');
    });
</script>
</body>
</html>
