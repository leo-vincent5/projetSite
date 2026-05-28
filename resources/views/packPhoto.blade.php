@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#090406] text-white">

    {{-- HERO --}}
    <section class="relative overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-16">

            <a
                href="{{ route('panier') }}"
                class="inline-flex rounded-full bg-white/10 px-5 py-3 text-sm font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15"
            >
                ← Retour au panier
            </a>

            <div class="mt-10 grid gap-8 lg:grid-cols-[1fr_360px] lg:items-end">

                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300/70">
                        Pack photo
                    </p>

                    <h1 class="mt-4 text-4xl font-black tracking-tight sm:text-5xl">
                        Acheter votre pack
                    </h1>

                    <p class="mt-5 max-w-2xl text-lg text-rose-100/70">
                        Retrouvez toutes les photos de ce pack et finalisez votre achat en paiement sécurisé.
                    </p>
                </div>

                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur">
                    <div class="text-sm uppercase tracking-[0.2em] text-rose-100/50">
                        Total à payer
                    </div>

                    <div class="mt-3 text-5xl font-black text-amber-300">
                        {{ number_format($tarif, 2, ',', ' ') }} €
                    </div>

                    <div class="mt-3 text-sm leading-6 text-rose-100/70">
                        2,50 € par photo<br>
                        Tarif plafonné à 25 € dès 10 photos
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- PAIEMENT --}}
    <section class="mx-auto max-w-7xl px-6 py-12">

        <div class="grid gap-16 lg:grid-cols-[420px_minmax(0,1fr)] xl:gap-24">

            <aside class="h-fit rounded-[2rem] border border-white/10 bg-[#160910] p-8 shadow-[0_20px_60px_rgba(0,0,0,0.45)]">

                <h2 class="text-3xl font-black">
                    Finaliser l’achat
                </h2>

                <p class="mt-3 text-rose-100/70">
                    Paiement sécurisé via PayPal. Après validation, vos photos seront disponibles dans votre historique.
                </p>

                <div class="mt-8 rounded-2xl bg-white/5 p-5">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4">
                        <span class="text-rose-100/70">Nombre de photos</span>
                        <strong>{{ count($photos) }}</strong>
                    </div>

                    <div class="flex items-center justify-between border-b border-white/10 py-4">
                        <span class="text-rose-100/70">Prix unitaire</span>
                        <strong>2,50 €</strong>
                    </div>

                    <div class="flex items-center justify-between pt-4 text-lg">
                        <span class="font-bold">Total</span>
                        <strong class="text-amber-300">
                            {{ number_format($tarif, 2, ',', ' ') }} €
                        </strong>
                    </div>
                </div>

                <div class="mt-8">
                    <article></article>
                </div>

            </aside>

            {{-- PHOTOS --}}
            <div>

                <div class="mx-3 mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-3xl font-black">
                            Photos incluses
                        </h2>

                        <p class="mt-2 text-rose-100/60">
                            Aperçu des images présentes dans votre pack.
                        </p>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">

                    @foreach($photos as $photo)

                        <div class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] shadow-[0_20px_60px_rgba(0,0,0,0.35)]">
                            <div class="relative aspect-[4/5] overflow-hidden">

                                <img
                                    src="/{{ $photo->name_notbuy }}"
                                    alt="Photo du pack"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >

                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <span class="inline-flex rounded-full bg-white/15 px-4 py-2 text-sm font-bold text-white backdrop-blur">
                                        Incluse dans le pack
                                    </span>
                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </section>

</div>

@endsection


@section('js')

<script src="https://www.paypal.com/sdk/js?currency=EUR&client-id=Ab3qyBmnJmJ8ruOvwiSKfalytsUAZnWStWRFB8LBXFRsmzbreszhabhLSxUXuhOUGsgH8zgmPle-vseT"></script>

<script>
    $(document).ready(function () {

        if (typeof paypal !== 'undefined') {
            paypal.Buttons({

                createOrder: async function (data, actions) {
                    return actions.order.create({
                        purchase_units: [
                            {
                                amount: {
                                    value: "{{ $tarif }}",
                                }
                            }
                        ]
                    });
                },

                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {

                        $.ajax({
                            type: "POST",
                            url: "/paiement-ajax-pack",
                            data: {
                                details: details,
                                pack_id: {{ $pack_id }},
                                tarif: {{ $tarif }}
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (result) {
                                window.location.href = '/history';
                            }
                        });

                    });
                }

            }).render("article");
        }

    });
</script>

@endsection