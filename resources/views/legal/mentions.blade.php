{{-- resources/views/legal/mentions.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#090406] text-white">

    <section class="relative overflow-hidden border-b border-white/10">

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]"></div>

        <div class="relative mx-auto max-w-5xl px-6 py-20">

            <p class="text-sm uppercase tracking-[0.3em] text-amber-300/70">
                Equicode
            </p>

            <h1 class="mt-4 text-5xl font-black tracking-tight">
                Mentions légales
            </h1>

            <p class="mt-6 max-w-2xl text-lg text-rose-100/70">
                Informations légales relatives au site Equicode.
            </p>

        </div>

    </section>

    <section class="mx-auto max-w-5xl px-6 py-16">

        <div class="space-y-8">

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    Éditeur du site
                </h2>

                <div class="mt-5 space-y-3 text-rose-100/80">

                    <p>
                        <strong>Equicode</strong>
                    </p>

                    <p>
                        Entreprise enregistrée sous le numéro :
                        <strong>89375134700012</strong>
                    </p>

                    <p>
                        RCS : Villeneuve-lès-Avignon
                    </p>

                    <p>
                        Responsable de publication :
                        <strong>Léo Vincent</strong>
                    </p>

                </div>

            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    Hébergement
                </h2>

                <div class="mt-5 space-y-3 text-rose-100/80">

                    <p>
                        OVH SAS
                    </p>

                    <p>
                        2 rue Kellermann
                    </p>

                    <p>
                        59100 Roubaix - France
                    </p>

                </div>

            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    Propriété intellectuelle
                </h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    L’ensemble des contenus présents sur ce site
                    (photographies, textes, logos, éléments graphiques,
                    vidéos et contenus divers) est protégé par le Code de
                    la propriété intellectuelle.

                    Toute reproduction, représentation, diffusion ou utilisation,
                    totale ou partielle, sans autorisation écrite préalable,
                    est strictement interdite.
                </p>

            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    Données personnelles
                </h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Les informations collectées via le site sont utilisées
                    uniquement dans le cadre des services proposés par Equicode.

                    Conformément au RGPD et à la loi Informatique et Libertés,
                    vous disposez d’un droit d’accès, de rectification,
                    de suppression et de limitation de vos données personnelles.
                </p>

                <p class="mt-5 text-rose-100/80">
                    Contact :
                    <a
                        href="mailto:leo.vincent5@gmail.com"
                        class="text-amber-300 transition hover:text-amber-200"
                    >
                        leo.vincent5@gmail.com
                    </a>
                </p>

            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">

                <h2 class="text-2xl font-black">
                    Contact
                </h2>

                <p class="mt-5 text-rose-100/80">
                    Pour toute demande :
                </p>

                <a
                    href="mailto:leo.vincent5@gmail.com"
                    class="mt-4 inline-flex rounded-full bg-amber-300 px-6 py-3 font-bold text-[#12070d] transition hover:bg-amber-200"
                >
                    leo.vincent5@gmail.com
                </a>

            </div>

        </div>

    </section>

</div>

@endsection