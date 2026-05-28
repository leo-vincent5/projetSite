{{-- resources/views/legal/cgv.blade.php --}}

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
                Conditions Générales de Vente
            </h1>

            <p class="mt-6 max-w-2xl text-lg text-rose-100/70">
                Conditions applicables aux ventes de photographies numériques
                et tirages proposés sur Equicode.
            </p>

        </div>

    </section>

    <section class="mx-auto max-w-5xl px-6 py-16">

        <div class="space-y-8">

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">1. Objet</h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Les présentes Conditions Générales de Vente définissent
                    les modalités de vente des photographies numériques,
                    tirages et packs proposés par Equicode.
                </p>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">2. Produits proposés</h2>

                <div class="mt-5 space-y-4 text-rose-100/80">

                    <p>
                        • Photographies numériques téléchargeables
                    </p>

                    <p>
                        • Tirages photo papier
                    </p>

                    <p>
                        • Packs photo événementiels
                    </p>

                </div>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">3. Tarifs</h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Les prix affichés sur le site sont exprimés en euros TTC.

                    Equicode se réserve le droit de modifier les tarifs à tout moment,
                    sans effet rétroactif sur les commandes déjà validées.
                </p>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">4. Paiement</h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Le paiement des commandes est sécurisé et réalisé via PayPal
                    ou tout autre moyen proposé sur le site.
                </p>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">5. Livraison</h2>

                <div class="mt-5 space-y-5 text-rose-100/80">

                    <p>
                        Les photographies numériques sont accessibles après validation du paiement.
                    </p>

                    <p>
                        Les tirages photo sont expédiés à l’adresse communiquée lors de la commande.
                    </p>

                </div>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">6. Droit de rétractation</h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Conformément à l’article L221-28 du Code de la consommation,
                    le droit de rétractation ne peut être exercé pour les contenus
                    numériques fournis immédiatement après achat et dont l’exécution
                    a commencé avec l’accord préalable du client.
                </p>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">7. Utilisation des photographies</h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Les photographies achetées sont destinées à un usage personnel.

                    Toute utilisation commerciale, modification importante,
                    revente ou redistribution sans autorisation écrite préalable
                    est interdite.
                </p>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">8. Responsabilité</h2>

                <p class="mt-5 leading-8 text-rose-100/80">
                    Equicode ne pourra être tenu responsable des interruptions
                    temporaires du site, des problèmes techniques ou des retards
                    indépendants de sa volonté.
                </p>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8">
                <h2 class="text-2xl font-black">9. Contact</h2>

                <p class="mt-5 text-rose-100/80">
                    Pour toute question concernant une commande :
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