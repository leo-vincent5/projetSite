<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

       
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer votre mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

       
     @error('simon_ok')
        
            <div class="mb-4 font-medium text-sm text-red-600">
                
                {{ $message }}   
            </div>
        
        @enderror

    <div id="simonCaptcha" class="simon-wrap">
  <div class="simon-grid">
    <button type="button"  class="pad pad-green" data-pad="0" aria-label="Vert"></button>
    <button type="button" class="pad pad-red"   data-pad="1" aria-label="Rouge"></button>
    <button type="button" class="pad pad-yellow"data-pad="2" aria-label="Jaune"></button>
    <button type="button" class="pad pad-blue"  data-pad="3" aria-label="Bleu"></button>
  </div>

  <div class="simon-ui">
    <div class="status">
      <span id="simonLevel">Niveau: 0</span>
      <span id="simonMsg">Clique “Démarrer”</span>
    </div>

    
    <div class="actions">
      <button class="bg-green-600 text-white" id="simonStart" type="button">Démarrer</button>
      <button id="simonReset" class="bg-orange-500 text-white" type="button">Reset</button>
      <input id="simonOk" type="hidden" name="simon_ok" value="0">
    </div>
  </div>
   <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà enregistré ?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __("S'enregistrer") }}
            </x-primary-button>
        </div>
</div>

</form>
<style>
  .simon-wrap{max-width:360px;font-family:system-ui,Segoe UI,Roboto,Arial,sans-serif}
  .simon-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:12px 0}
  .pad{height:110px;border:0;border-radius:18px;cursor:pointer;opacity:.9;transition:transform .05s, filter .1s, opacity .1s}
  .pad:active{transform:scale(.98)}
  .pad-green{background:#22c55e}
  .pad-red{background:#ef4444}
  .pad-yellow{background:#eab308}
  .pad-blue{background:#3b82f6}

  /* flash */
  .pad.flash{filter:brightness(1.7);opacity:1}
  .simon-ui{display:flex;flex-direction:column;gap:10px}
  .status{display:flex;justify-content:space-between;gap:12px;font-size:14px;opacity:.9}
  .actions{display:flex;gap:10px}
  .actions button{padding:10px 12px;border-radius:12px;border:1px solid #e5e7eb;cursor:pointer}
</style>

<script>
(() => {
  const pads = Array.from(document.querySelectorAll('#simonCaptcha .pad'));
  const startBtn = document.getElementById('simonStart');
  const resetBtn = document.getElementById('simonReset');
  const levelEl = document.getElementById('simonLevel');
  const msgEl = document.getElementById('simonMsg');
  const okInput = document.getElementById('simonOk');

  // --- Réglages simples
  const FLASH_MS = 350;
  const GAP_MS = 180;

  // --- State
  let seq = [];
  let userIndex = 0;
  let playing = false;
  let accepting = false;
  let solved = false;

  // --- Hook: à toi de brancher ta logique de validation
  function onSuccess() {
    solved = true;
    okInput.value = "1";            // pratique pour un submit form
    msgEl.textContent = "✅ Captcha validé";
    startBtn.disabled = true;
  }

  function setLevel() {
    levelEl.textContent = `Niveau: ${seq.length}`;
  }

  function sleep(ms) {
    return new Promise(r => setTimeout(r, ms));
  }

  async function flashPad(i) {
    const el = pads[i];
    el.classList.add('flash');
    await sleep(FLASH_MS);
    el.classList.remove('flash');
    await sleep(GAP_MS);
  }

  function addStep() {
    const next = Math.floor(Math.random() * 4);
    seq.push(next);
    setLevel();
  }

  async function playSequence() {
    playing = true;
    accepting = false;
    msgEl.textContent = "👀 Regarde la séquence…";
    await sleep(300);
    for (const step of seq) await flashPad(step);
    msgEl.textContent = "🧠 À toi de jouer";
    userIndex = 0;
    playing = false;
    accepting = true;
  }

  function fail() {
    okInput.value = "0";
    levelEl.textContent = `Niveau: 0`;
    seq = [];
    accepting = false;
    msgEl.textContent = "❌ Raté, recommence";
    // mini feedback
    pads.forEach(p => p.style.opacity = ".6");
    setTimeout(() => pads.forEach(p => p.style.opacity = ".9"), 180);
  }


  function daltonien(){

  }

  function resetAll() {
    seq = [];
    userIndex = 0;
    playing = false;
    accepting = false;
    solved = false;
    okInput.value = "0";
    msgEl.textContent = "Clique “Démarrer”";
    setLevel();
    startBtn.disabled = false;
  }

  async function start() {
    if (solved || playing) return;
    addStep();
    await playSequence();
  }

  // --- Events
  startBtn.addEventListener('click', start);
  resetBtn.addEventListener('click', resetAll);

  pads.forEach(pad => {
    pad.addEventListener('click', async () => {
      if (!accepting || playing || solved) return;

      const val = Number(pad.dataset.pad);
      await flashPad(val);

      if (val !== seq[userIndex]) {
        fail();
        // Option: rejouer la séquence actuelle au lieu de reset complet
        await sleep(450);
        await playSequence();
        return;
      }

      userIndex++;

      // Fin de niveau
      if (userIndex === seq.length) {
        accepting = false;

        // ✅ condition de réussite: par ex. 3 niveaux
        if (seq.length >= 3) {
          onSuccess();
          return;
        }

        msgEl.textContent = "✅ Bien ! Niveau suivant…";
        await sleep(500);
        addStep();
        await playSequence();
      }
    });
  });

  // init
  resetAll();
})();
</script>


</x-guest-layout>
