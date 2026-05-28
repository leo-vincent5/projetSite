@extends("layouts.app")

@section('css')
    <link rel="stylesheet" href="{{ asset('css/paypal.css') }}">
@endsection

@section("content")

<div class="min-h-screen bg-[#090406] text-white">

    {{-- HERO --}}
    <section class="relative overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-16">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300/70">
                        Equicode
                    </p>

                    <h1 class="mt-4 text-5xl font-black tracking-tight">
                        Votre panier
                    </h1>

                    <p class="mt-4 max-w-2xl text-lg text-rose-100/70">
                        Retrouvez ici vos photos sélectionnées avant finalisation de votre commande.
                    </p>
                </div>

                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur">
                    <div class="text-sm uppercase tracking-[0.2em] text-rose-100/50">
                        Total actuel
                    </div>

                    <div class="mt-3 text-5xl font-black text-amber-300">
                        <span id="prixPanier">{{ count($paniers) * 3 }}</span>€
                    </div>

                    <div class="mt-2 text-rose-100/70">
                        <span id="countPanier">{{ count($paniers) }}</span>
                        @if(count($paniers) > 1)
                            photos
                        @else
                            photo
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-6 py-12">

        {{-- PACKS --}}
        @if(count($packs) > 0)
            <section class="mb-16">
                <div class="mb-8 flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-3xl font-black">Mes packs</h2>
                        <p class="mt-2 text-rose-100/60">Vos packs photo prêts à être consultés ou finalisés.</p>
                    </div>
                </div>

                <div id="paypalDiv"></div>

                <div id="listPack" class="grid gap-6">
                    @foreach($packs as $pack)
                        <div
                            id="pack_{{ $pack->id }}"
                            class="flex flex-col gap-5 overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] p-5 shadow-[0_20px_60px_rgba(0,0,0,0.35)] sm:flex-row sm:items-center sm:justify-between"
                        >
                            <div class="flex items-center gap-5">
                                <img
                                    class="h-20 w-20 rounded-2xl object-cover ring-1 ring-white/10"
                                    src="/{{ $pack->preview }}"
                                    alt="Pack photo"
                                >

                                <div>
                                    <h3 class="text-xl font-black">
                                        Pack avec {{ $pack->nbphotos }} photos
                                    </h3>
                                    <p class="mt-1 text-sm text-rose-100/60">
                                        Pack sélectionné
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a
                                    href="{{ $pack->cle }}"
                                    class="inline-flex items-center justify-center rounded-full bg-white/10 px-5 py-3 font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15"
                                >
                                    Voir
                                </a>

                                <a
                                    href="{{ route('paiementPack', ['id' => $pack->id]) }}"
                                    class="inline-flex items-center justify-center rounded-full bg-emerald-500 px-5 py-3 font-bold text-white transition hover:bg-emerald-400"
                                >
                                    Finaliser l'achat
                                </a>

                                <button
                                    data-id="{{ $pack->id }}"
                                    class="deletepack inline-flex items-center justify-center rounded-full bg-red-500 px-5 py-3 font-bold text-white transition hover:bg-red-400"
                                >
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- PHOTOS À L'UNITÉ --}}
        <section>
            <div class="mb-8">
                <h2 class="text-3xl font-black">Mes photos à l'unité</h2>

                <p class="mt-3 text-rose-100/70">
                    Vous avez actuellement dans votre panier
                    <b>
                        <span id="countPanierText">{{ count($paniers) }}</span>
                        @if(count($paniers) > 1)
                            photos
                        @else
                            photo
                        @endif
                    </b>
                    pour un montant de
                    <b><span id="prixPanierText">{{ count($paniers) * 3 }}</span> €</b>.
                </p>
            </div>

            {{-- ACTIONS --}}
            <div class="mb-10 flex flex-wrap gap-4">
                <a
                    href="{{ route('history') }}"
                    class="rounded-full bg-emerald-500 px-6 py-3 font-bold text-white transition hover:bg-emerald-400"
                >
                    Voir mes photos achetées
                </a>

                <button
                    id="deletePanier"
                    class="rounded-full bg-red-500 px-6 py-3 font-bold text-white transition hover:bg-red-400"
                >
                    Vider votre panier
                </button>

                <a
                    href="{{ route('gallery') }}"
                    class="rounded-full bg-white/10 px-6 py-3 font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15"
                >
                    Voir d'autres photos
                </a>

                <a
                    href="{{ route('codePromo') }}"
                    class="rounded-full bg-amber-300 px-6 py-3 font-bold text-[#12070d] transition hover:bg-amber-200"
                >
                    Utiliser un code promo
                </a>
            </div>

            {{-- LISTE PHOTOS --}}
            <div id="list" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($paniers as $panier)
                    <div class="panier-item group overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] shadow-[0_20px_60px_rgba(0,0,0,0.45)]">
                        <div class="relative aspect-[4/5] overflow-hidden">
                            <img
                                src="/{{ $panier->photo()->first()->name_notbuy }}"
                                alt="Photo du panier"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                            >

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                            <button
                                data-id="{{ $panier->id }}"
                                class="deletePanier absolute right-4 top-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-500/90 text-xl font-black text-white shadow-lg backdrop-blur transition hover:scale-105 hover:bg-red-400"
                            >
                                ×
                            </button>

                            <div class="absolute bottom-0 left-0 right-0 p-5">
                                <div class="inline-flex rounded-full bg-amber-300 px-4 py-2 text-sm font-black text-[#12070d]">
                                    3€
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAYPAL --}}
            <div class="mt-16 rounded-[2rem] border border-white/10 bg-white/5 p-8 backdrop-blur">
                <div class="mb-6 text-center">
                    <h2 class="text-3xl font-black">Finaliser votre commande</h2>
                    <p class="mt-3 text-rose-100/70">Paiement sécurisé via PayPal</p>
                </div>

                <article></article>
                <div id="paypalButton"></div>
            </div>
        </section>

    </div>
</div>

{{-- MODALE MERCI --}}
<div
    id="exampleModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 px-4 backdrop-blur-sm"
>
    <div class="w-full max-w-xl overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] text-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">
            <h5 class="text-2xl font-black">
                Merci de votre achat
            </h5>

            <button
                type="button"
                id="closeModal"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-xl font-black hover:bg-white/15"
            >
                ×
            </button>
        </div>

        <div class="px-6 py-8 text-center">
            <div id="paypal-boutons"></div>

            <img src="/img/reverence.gif" class="mx-auto my-6 max-h-48 rounded-2xl" alt="Merci">

            <p class="text-rose-100/80">
                Merci beaucoup pour votre achat ! Vous contribuez à un rêve !<br>
                J'espère que vos photos vous plairont !<br>
                ~ Léo
            </p>
        </div>

        <div class="flex flex-col gap-3 border-t border-white/10 px-6 py-5 sm:flex-row sm:justify-center">
            <a
                href="{{ route('gallery') }}"
                class="rounded-full bg-red-500 px-5 py-3 text-center font-bold text-white transition hover:bg-red-400"
            >
                Revenir aux choix des photos
            </a>

            <a
                href="{{ route('history') }}"
                class="rounded-full bg-amber-300 px-5 py-3 text-center font-bold text-[#12070d] transition hover:bg-amber-200"
            >
                Voir mes photos achetées
            </a>
        </div>
    </div>
</div>

{{-- ANCIEN BOUTON CACHÉ CONSERVÉ POUR COMPATIBILITÉ JS --}}
<button id="acheter" type="button" class="hidden"></button>

@endsection


@section('js')

<script src="https://www.paypal.com/sdk/js?currency=EUR&client-id=Ab3qyBmnJmJ8ruOvwiSKfalytsUAZnWStWRFB8LBXFRsmzbreszhabhLSxUXuhOUGsgH8zgmPle-vseT"></script>

<script>
    function openSuccessModal() {
        const modal = document.getElementById('exampleModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeSuccessModal() {
        const modal = document.getElementById('exampleModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function updateCartDisplay(nb, prix) {
        $("#countPanier").html(nb);
        $("#countPanierText").html(nb);
        $("#prixPanier").html(prix);
        $("#prixPanierText").html(prix);
        $("#cptPanier").html(nb);
        $("#cptPanierMobile").html(nb);
    }

    $(document).ready(function () {

        $("#closeModal").on("click", function () {
            closeSuccessModal();
        });

        $("#exampleModal").on("click", function (event) {
            if (event.target.id === "exampleModal") {
                closeSuccessModal();
            }
        });

        $("#acheter").on("click", function () {
            openSuccessModal();
        });

        let coucou = 300;
        let tempon = 0;

        if (typeof paypal !== 'undefined') {
            paypal.Buttons({

                createOrder: async function (data, actions) {

                    await $.ajax({
                        type: "POST",
                        url: "/getPanier",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result);
                            coucou = result['count'];
                            tempon = result['id_tempon'];
                        }
                    });

                    return actions.order.create({
                        purchase_units: [
                            {
                                amount: {
                                    value: coucou * 3,
                                }
                            }
                        ]
                    });
                },

                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {

                        let id_user = {{ \Illuminate\Support\Facades\Auth::user()->id }};

                        $.ajax({
                            type: "POST",
                            url: "/paiement-ajax",
                            data: {
                                details: details,
                                id_user: id_user,
                                id_tempon: tempon,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (result) {
                                $('#cptrose').text(result);

                                updateCartDisplay(0, 0);

                                $("#list").html("");
                                openSuccessModal();
                            }
                        });
                    });
                }

            }).render("article");
        }
    });

    $(document).on("click", ".deletepack", function () {
        let id = this.dataset.id;

        $.ajax({
            type: "POST",
            url: "/delete-pack",
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (result === "good") {
                    $("#pack_" + id).remove();
                }
            }
        });
    });

    $(document).on("click", "#deletePanier", function () {
        $.ajax({
            type: "POST",
            url: "/vider-panier",
            data: {},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                console.log(result);

                $("#list").html("");
                updateCartDisplay(0, 0);
            }
        });
    });

    $(document).on("click", ".deletePanier", function () {
        let id_photo = this.dataset.id;
        let button = this;

        $.ajax({
            type: "POST",
            url: "/deleteOne-panier",
            data: {
                id_photo: id_photo
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                let nb = parseInt($("#countPanier").html()) || 0;
                let prix = parseInt($("#prixPanier").html()) || 0;

                nb = Math.max(nb - 1, 0);
                prix = Math.max(prix - 3, 0);

                updateCartDisplay(nb, prix);

                $(button).closest(".panier-item").remove();
            }
        });
    });
</script>

@endsection