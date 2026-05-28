{{-- resources/views/legal/confidentialite.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#090406] text-white">

    {{-- HERO --}}
    <section class="relative overflow-hidden border-b border-white/10">

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]"></div>

        <div class="relative mx-auto max-w-5xl px-6 py-20">

            <p class="text-sm uppercase tracking-[0.3em] text-amber-300/70">
                Equicode
            </p>

            <h1 class="mt-4 text-5xl font-black tracking-tight">
                Politique de confidentialité
            </h1>

            <p class="mt-6 max-w-2xl text-lg text-rose-100/70">
                Informations relatives à la collecte et au traitement des données personnelles
                sur le site Equicode.
            </p>

        </div>

    </section>

    {{-- CONTENU --}}
    <section class="mx-auto max-w-5xl px-6 py-16">

        <div class="space-y-8">

            {{-- RESPONSABLE --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    1. Responsable du traitement
                </h2>

                <div class="mt-5 space-y-3 text-rose-100/80">

                    <p>
                        Les données personnelles collectées sur ce site sont traitées par :
                    </p>

                    <p>
                        <strong>Equicode – Léo Vincent</strong>
                    </p>

                    <p>
                        Contact :
                        <a
                            href="mailto:leo.vincent5@gmail.com"
                            class="text-amber-300 transition hover:text-amber-200"
                        >
                            leo.vincent5@gmail.com
                        </a>
                    </p>

                </div>

            </div>

            {{-- DONNÉES --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    2. Données collectées
                </h2>

                <div class="mt-5 space-y-4 text-rose-100/80">

                    <p>
                        Les données susceptibles d’être collectées sont :
                    </p>

                    <ul class="list-disc space-y-2 pl-6">

                        <li>Nom et prénom</li>
                        <li>Adresse email</li>
                        <li>Informations liées aux commandes</li>
                        <li>Historique d’achats</li>
                        <li>Données de connexion</li>

                    </ul>

                </div>

            </div>

            {{-- FINALITÉ --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    3. Utilisation des données
                </h2>

                <div class="mt-5 space-y-4 text-rose-100/80">

                    <p>
                        Les données collectées sont utilisées pour :
                    </p>

                    <ul class="list-disc space-y-2 pl-6">

                        <li>La gestion des commandes</li>
                        <li>L’accès aux photographies achetées</li>
                        <li>Le support client</li>
                        <li>La sécurisation du site</li>
                        <li>L’amélioration des services proposés</li>

                    </ul>

                </div>

            </div>

            {{-- CONSERVATION --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    4. Conservation des données
                </h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Les données personnelles sont conservées uniquement pendant la durée
                    nécessaire à la gestion des services proposés et au respect des obligations légales.
                </p>

            </div>

            {{-- PARTAGE --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    5. Partage des données
                </h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Les données personnelles ne sont ni revendues ni transmises à des tiers,
                    sauf nécessité technique liée au paiement sécurisé ou à l’hébergement du site.
                </p>

            </div>

            {{-- SÉCURITÉ --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    6. Sécurité
                </h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Equicode met en œuvre des mesures techniques et organisationnelles
                    destinées à protéger les données personnelles contre tout accès,
                    modification ou divulgation non autorisés.
                </p>

            </div>

            {{-- COOKIES --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    7. Cookies
                </h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Le site peut utiliser des cookies techniques nécessaires à son bon fonctionnement,
                    notamment pour la connexion utilisateur et le panier.
                </p>

            </div>

            {{-- DROITS --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    8. Vos droits
                </h2>

                <div class="mt-5 space-y-4 text-rose-100/80">

                    <p>
                        Conformément au RGPD, vous disposez des droits suivants :
                    </p>

                    <ul class="list-disc space-y-2 pl-6">

                        <li>Droit d’accès</li>
                        <li>Droit de rectification</li>
                        <li>Droit de suppression</li>
                        <li>Droit d’opposition</li>
                        <li>Droit à la limitation du traitement</li>

                    </ul>

                </div>

            </div>

            {{-- CONTACT --}}
            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    9. Contact
                </h2>

                <p class="mt-5 text-rose-100/80">
                    Pour toute demande relative à vos données personnelles :
                </p>

                <a
                    href="mailto:leo.vincent5@gmail.com"
                    class="mt-5 inline-flex rounded-full bg-amber-300 px-6 py-3 font-bold text-[#12070d] transition hover:bg-amber-200"
                >
                    leo.vincent5@gmail.com
                </a>

            </div>

        </div>

    </section>

</div>

@endsection