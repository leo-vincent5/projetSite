@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#090406] text-white">

    <section class="relative overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-12">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300/70">
                        Pack photo
                    </p>

                    <h1 class="mt-3 text-4xl font-black tracking-tight">
                        Votre pack photo
                    </h1>
                </div>

                <a href="{{ route('history') }}"
                   class="inline-flex w-fit rounded-full bg-white/10 px-6 py-3 text-sm font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15">
                    ← Retour
                </a>
            </div>

            <div class="mt-8 rounded-2xl border border-amber-300/20 bg-amber-300/10 p-5 text-amber-100">
                <div class="flex gap-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-300 text-[#090406] font-black">
                        !
                    </div>

                    <p class="text-sm leading-6">
                        Pensez à sauvegarder vos photos sur votre ordinateur ou votre téléphone.
                        Equicode stocke vos achats pour un minimum de 6 mois. Le téléchargement des packs n'est pas encore disponible, mais appelez-moi pour que je  puisse vous les envoyer par email ou via un lien de téléchargement sécurisé.Je suis  à votre disposition pour toute question ou assistance concernant vos achats. <a href="tel:+33606441824" class="font-bold text-amber-300 hover:underline">Contactez-moi</a> pour toute demande.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-12">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @foreach($photos as $photo)
                @php
                    $result = explode("/", $photo->name);
                    $newResult = "";
                    $cpt = 0;

                    foreach ($result as $item) {
                        $cpt++;

                        if ($cpt == count($result)) {
                            $newResult .= "traiter-";
                        } else {
                            $newResult .= $item . "/";
                        }
                    }

                    $imageUrl = "/" . $newResult . $photo->encode . ".jpg";
                @endphp

                <div class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] shadow-[0_20px_60px_rgba(0,0,0,0.35)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]">
                    <div class="relative aspect-[4/5] overflow-hidden">
                        <img
                            src="{{ $imageUrl }}"
                            alt="Photo achetée"
                            loading="lazy"
                            decoding="async"
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                        >

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-80"></div>

                        <div class="absolute bottom-0 left-0 right-0 flex items-center justify-between gap-3 p-4">
                            <span class="rounded-full bg-white/15 px-4 py-2 text-xs font-bold text-white backdrop-blur">
                                Photo incluse
                            </span>

                            <a href="{{ $imageUrl }}"
                               download
                               class="rounded-full bg-amber-300 px-4 py-2 text-xs font-black text-[#12070d] transition hover:bg-amber-200">
                                Télécharger
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

</div>
@endsection