@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#050505] text-white py-10 overflow-hidden relative">

    <div class="absolute top-0 left-0 w-[40rem] h-[40rem] bg-purple-700/20 blur-3xl rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[35rem] h-[35rem] bg-yellow-400/10 blur-3xl rounded-full"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session()->has('success'))
            <div class="mb-5 rounded-3xl border border-emerald-500/30 bg-emerald-500/10 px-6 py-4 text-emerald-200">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="relative overflow-hidden rounded-[2rem] border border-yellow-400/30 bg-gradient-to-br from-[#1a1028] via-[#10070f] to-[#050505] shadow-[0_0_80px_rgba(168,85,247,0.35)] mb-10">
            <div class="absolute -top-24 -right-20 w-80 h-80 bg-purple-600/40 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-24 -left-20 w-80 h-80 bg-yellow-400/25 blur-3xl rounded-full"></div>

            <div class="relative p-8 sm:p-12">
                <div class="inline-flex items-center gap-2 rounded-full border border-yellow-300/50 bg-yellow-300/15 px-5 py-2 text-sm font-black text-yellow-200 mb-8">
                    ✨ Administration Equicode
                </div>

                <h1 class="text-4xl sm:text-6xl font-black bg-gradient-to-r from-yellow-200 via-yellow-400 to-purple-300 bg-clip-text text-transparent">
                    Générateur de code promo
                </h1>

                <p class="mt-6 max-w-2xl text-lg text-gray-200">
                    Créez des codes promo pour offrir des crédits photo aux utilisateurs.
                </p>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-[2rem] border border-purple-400/30 bg-gradient-to-br from-[#20112c] via-[#120910] to-[#080808] p-7 sm:p-8 shadow-[0_0_70px_rgba(168,85,247,0.25)] mb-10">

            <div class="absolute -top-20 right-10 w-64 h-64 bg-purple-600/30 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-24 left-10 w-64 h-64 bg-yellow-400/20 blur-3xl rounded-full"></div>

            <form method="post" action="{{ route('createCode') }}" class="relative space-y-6">
                @csrf

                <div>
                    <label for="code" class="block mb-2 text-sm font-black text-yellow-200">
                        Code
                    </label>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <input
                            type="text"
                            name="code"
                            id="code"
                            placeholder="Poney13"
                            value=""
                            class="flex-1 rounded-2xl border border-yellow-300/20 bg-black/40 px-5 py-4 text-white placeholder:text-gray-500 outline-none focus:border-yellow-300 focus:ring-4 focus:ring-yellow-400/20 transition-all"
                        >

                        <button
                            type="button"
                            onclick="essais(); return false;"
                            class="rounded-2xl bg-gradient-to-r from-purple-600 via-fuchsia-600 to-purple-700 px-6 py-4 font-black text-white shadow-2xl shadow-purple-900/40 hover:scale-[1.03] transition-all">
                            Générer random
                        </button>
                    </div>
                </div>

                <div class="grid gap-5 md:grid-cols-3">
                    <div>
                        <label for="nbUtilisation" class="block mb-2 text-sm font-black text-yellow-200">
                            Nombre d’utilisation
                        </label>
                        <input
                            type="number"
                            name="nbUtilisation"
                            id="nbUtilisation"
                            value="1"
                            class="w-full rounded-2xl border border-white/10 bg-black/40 px-5 py-4 text-white outline-none focus:border-yellow-300 focus:ring-4 focus:ring-yellow-400/20 transition-all"
                        >
                    </div>

                    <div>
                        <label for="exampleDateDelais" class="block mb-2 text-sm font-black text-yellow-200">
                            Durée en jours
                        </label>
                        <input
                            type="number"
                            name="nbduree"
                            id="exampleDateDelais"
                            value=""
                            class="w-full rounded-2xl border border-white/10 bg-black/40 px-5 py-4 text-white outline-none focus:border-yellow-300 focus:ring-4 focus:ring-yellow-400/20 transition-all"
                        >
                    </div>

                    <div>
                        <label for="examplephoto" class="block mb-2 text-sm font-black text-yellow-200">
                            Photos offertes
                        </label>
                        <input
                            type="number"
                            name="nbphoto"
                            id="examplephoto"
                            value=""
                            class="w-full rounded-2xl border border-white/10 bg-black/40 px-5 py-4 text-white outline-none focus:border-yellow-300 focus:ring-4 focus:ring-yellow-400/20 transition-all"
                        >
                    </div>
                </div>

                <div>
                    <label for="details" class="block mb-2 text-sm font-black text-yellow-200">
                        Détails du code
                    </label>
                    <input
                        type="text"
                        name="details"
                        id="details"
                        value=""
                        placeholder="Exemple : concours, cadeau client, partenariat..."
                        class="w-full rounded-2xl border border-white/10 bg-black/40 px-5 py-4 text-white placeholder:text-gray-500 outline-none focus:border-yellow-300 focus:ring-4 focus:ring-yellow-400/20 transition-all"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full sm:w-auto rounded-2xl bg-gradient-to-r from-yellow-300 via-yellow-500 to-yellow-300 px-9 py-4 text-lg font-black text-black shadow-[0_0_35px_rgba(250,204,21,0.35)] hover:scale-[1.03] transition-all">
                    Créer le code
                </button>
            </form>
        </div>

        <div class="mb-6">
            <h2 class="text-3xl font-black bg-gradient-to-r from-yellow-200 to-purple-300 bg-clip-text text-transparent">
                Codes existants
            </h2>
        </div>

        <div class="space-y-4">
            @foreach($codes as $code)
                <div
                    id="code_{{ $code->id }}"
                    class="rounded-[2rem] border border-white/10 bg-gradient-to-br from-[#1a1a1a] to-[#090909] p-5 shadow-[0_0_35px_rgba(168,85,247,0.12)]">

                    <div class="flex flex-col lg:flex-row lg:items-center gap-5">

                        <div class="flex-1">
                            <div class="text-2xl sm:text-3xl font-black text-yellow-300 tracking-wide">
                                {{ $code->code }}
                            </div>

                            <div class="mt-3 grid gap-2 text-sm text-gray-300">
                                <p>
                                    Créé le :
                                    <span class="text-white font-bold">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $code->created_at)->format('d/m/y') }}
                                    </span>
                                </p>

                                <p>
                                    Expire le :
                                    <span class="text-white font-bold">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $code->created_at)->addDays($code->nb_jours)->format('d/m/y') }}
                                    </span>
                                    <span class="text-gray-500">
                                        soit {{ $code->nb_jours }} jours
                                    </span>
                                </p>

                                <p>
                                    Détails :
                                    <span class="text-gray-100">
                                        {{ $code->details ?: 'Aucun détail' }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <button
                                type="button"
                                onclick="navigator.clipboard.writeText('{{ $code->code }}')"
                                class="rounded-2xl border border-yellow-300/30 bg-yellow-300/10 px-5 py-3 font-black text-yellow-200 hover:bg-yellow-300/20 transition">
                                Copier
                            </button>

                            <button
                                type="button"
                                data-id="{{ $code->id }}"
                                data-code="{{ $code->code }}"
                                data-details="{{ $code->details }}"
                                class="deleteCode rounded-2xl border border-red-400/30 bg-red-500/10 px-5 py-3 font-black text-red-200 hover:bg-red-500/20 transition">
                                Supprimer
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

{{-- MODAL SUPPRESSION --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm px-4">
    <div class="w-full max-w-lg rounded-[2rem] border border-red-400/30 bg-gradient-to-br from-[#201020] to-[#080808] p-7 shadow-[0_0_80px_rgba(239,68,68,0.25)]">

        <h3 class="text-2xl font-black text-white mb-4">
            Supprimer ce code promo ?
        </h3>

        <div class="rounded-2xl border border-white/10 bg-black/30 p-5 text-center mb-6">
            <div id="codeSupp" class="text-3xl font-black text-yellow-300"></div>
            <div class="mt-3 text-gray-400">
                Détails : <span id="detailsSupp" class="text-gray-200"></span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3">
            <button
                type="button"
                id="annule"
                class="rounded-2xl border border-white/10 bg-white/10 px-6 py-3 font-black text-white hover:bg-white/20 transition">
                Annuler
            </button>

            <button
                type="button"
                id="suppConfirm"
                class="rounded-2xl bg-red-500 px-6 py-3 font-black text-white hover:bg-red-600 transition">
                Supprimer
            </button>
        </div>

    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {

        $(".deleteCode").on('click', function () {
            let id = this.dataset.id;

            $("#codeSupp").html(this.dataset.code);
            $("#detailsSupp").html(this.dataset.details || 'Aucun détail');

            $("#suppConfirm").removeAttr('data-id');
            $("#suppConfirm").attr('data-id', id);

            $("#deleteModal")
                .removeClass('hidden')
                .addClass('flex');
        });

        $("#annule").on('click', function () {
            $("#deleteModal")
                .addClass('hidden')
                .removeClass('flex');
        });

        $('#suppConfirm').on('click', function () {
            let id_code = this.dataset.id;

            $.ajax({
                type: "POST",
                url: "/delete_code_promo",
                data: {
                    id_code: parseInt(id_code),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result === 'success') {
                        $("#code_" + id_code).remove();

                        $("#deleteModal")
                            .addClass('hidden')
                            .removeClass('flex');
                    }
                }
            });
        });

    });

    function essais() {
        $("#code")[0].value = generateRandomString(6);
    }

    const generateRandomString = (num) => {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = '';

        for (let i = 0; i < num; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }

        return result;
    }
</script>
@endsection