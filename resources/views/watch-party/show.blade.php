<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>{{ $party->title ?? 'Watch Party' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #050505;
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1300px;
            margin: auto;
            padding: 24px;
        }

        .title {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .status {
            color: rgba(255,255,255,.65);
            margin-bottom: 18px;
        }

        .player-box {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            background: black;
            box-shadow: 0 0 50px rgba(209,96,255,.18);
        }

        video {
            width: 100%;
            display: block;
            background: black;
        }

        .controls {
            display: flex;
            gap: 12px;
            margin-top: 18px;
            flex-wrap: wrap;
            align-items: center;
        }

        button,
        select {
            border: 0;
            border-radius: 14px;
            padding: 14px 18px;
            font-weight: 800;
        }

        button {
            cursor: pointer;
        }

        .primary {
            background: #d160ff;
            color: black;
        }

        .secondary {
            background: rgba(255,255,255,.10);
            color: white;
        }

        select {
            background: rgba(255,255,255,.10);
            color: white;
            min-width: 150px;
        }

        .countdown-overlay {
            position: absolute;
            inset: 0;
            z-index: 10;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: rgba(0,0,0,.82);
            backdrop-filter: blur(12px);
        }

        .countdown-overlay.active {
            display: flex;
        }

        .countdown-number {
            font-size: 130px;
            font-weight: 900;
            color: #d160ff;
            text-shadow: 0 0 35px rgba(209,96,255,.55);
            line-height: 1;
        }

        .countdown-text {
            margin-top: 14px;
            font-size: 20px;
            color: rgba(255,255,255,.75);
        }
    </style>
</head>

<body>

<div class="container">

    <div class="title">
        {{ $party->title ?? 'Watch Party' }}
    </div>

    <div id="syncStatus" class="status">
        Synchronisation...
    </div>

    <div class="player-box">

        <div id="countdownOverlay" class="countdown-overlay">
            <div id="countdownNumber" class="countdown-number">10</div>

            <div class="countdown-text">
                Lecture synchronisée imminente
            </div>
        </div>

        <video id="partyPlayer" controls playsinline></video>

    </div>

    <div class="controls">

        <button id="launchBtn" class="primary">
            ▶ Lancer dans 10 secondes
        </button>

        <button id="pauseBtn" class="secondary">
            ⏸ Pause synchronisée
        </button>

        <select id="audioTrackSelect" style="display:none;"></select>

    </div>

</div>

<script>
    window.partyStateUrl = @js(route('watch-party.state', $party->token));
    window.partySyncUrl = @js(route('watch-party.sync', $party->token));
    window.csrfToken = @js(csrf_token());
</script>

<script>
    const video = document.getElementById('partyPlayer');
    const syncStatus = document.getElementById('syncStatus');

    const countdownOverlay =
        document.getElementById('countdownOverlay');

    const countdownNumber =
        document.getElementById('countdownNumber');

    const audioTrackSelect =
        document.getElementById('audioTrackSelect');

    let hlsInstance = null;

    let countdownInterval = null;
    let activeCountdownTarget = null;

    let hasStartedScheduledPlayback = false;

    let isApplyingRemote = false;
    let lastSeenSync = null;

    let pauseLockUntil = 0;

    function setStatus(text) {
        syncStatus.textContent = text;
    }

    function loadVideo(url) {

        if (!url) return;

        if (video.dataset.loaded === url) {
            return;
        }

        video.dataset.loaded = url;

        if (hlsInstance) {
            hlsInstance.destroy();
            hlsInstance = null;
        }

        audioTrackSelect.style.display = 'none';
        audioTrackSelect.innerHTML = '';

        const isSafari =
            /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

        const isIOS =
            /iPad|iPhone|iPod/.test(navigator.userAgent);

        if (
            (isSafari || isIOS) &&
            video.canPlayType('application/vnd.apple.mpegurl')
        ) {

            video.src = url;
            video.load();

            return;
        }

        if (window.Hls && Hls.isSupported()) {

            hlsInstance = new Hls();

            hlsInstance.loadSource(url);
            hlsInstance.attachMedia(video);

            hlsInstance.on(
                Hls.Events.AUDIO_TRACKS_UPDATED,
                setupAudioTracks
            );

            hlsInstance.on(
                Hls.Events.MANIFEST_PARSED,
                function () {
                    setTimeout(setupAudioTracks, 300);
                }
            );
        }
    }

    function audioLabel(track, index) {

        const raw =
            String(track.lang || track.name || '')
            .toLowerCase();

        if (
            raw === 'fra' ||
            raw === 'fr' ||
            raw.includes('français')
        ) {
            return 'FR';
        }

        if (
            raw === 'eng' ||
            raw === 'en' ||
            raw.includes('english')
        ) {
            return 'EN';
        }

        return (
            track.name ||
            track.lang ||
            `Audio ${index + 1}`
        );
    }

    function setupAudioTracks() {

        if (!hlsInstance) return;

        const tracks = hlsInstance.audioTracks || [];

        if (tracks.length <= 1) {

            audioTrackSelect.style.display = 'none';
            audioTrackSelect.innerHTML = '';

            return;
        }

        const current = hlsInstance.audioTrack;

        audioTrackSelect.innerHTML = '';

        tracks.forEach((track, index) => {

            const option =
                document.createElement('option');

            option.value = index;

            option.textContent =
                audioLabel(track, index);

            audioTrackSelect.appendChild(option);
        });

        audioTrackSelect.value =
            current >= 0 ? current : 0;

        audioTrackSelect.style.display = 'inline-block';

        audioTrackSelect.onchange = function () {

            hlsInstance.audioTrack =
                Number(this.value);
        };
    }

    async function fetchState() {

        const response = await fetch(
            window.partyStateUrl,
            {
                headers: {
                    'Accept': 'application/json'
                }
            }
        );

        if (!response.ok) {
            return null;
        }

        return await response.json();
    }

    async function syncState(payload = {}) {

        const response = await fetch(
            window.partySyncUrl,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(payload)
            }
        );

        if (!response.ok) {

            console.error(
                'Erreur sync',
                response.status,
                await response.text()
            );

            return null;
        }

        return await response.json();
    }

    function showCountdown(seconds) {

        countdownOverlay.classList.add('active');

        countdownNumber.textContent = seconds;
    }

    function hideCountdown() {

        countdownOverlay.classList.remove('active');
    }

    function stopCountdown() {

        clearInterval(countdownInterval);

        countdownInterval = null;
        activeCountdownTarget = null;

        hideCountdown();
    }

    function startLocalCountdown(
        targetTimestamp,
        serverTime,
        startTime
    ) {

        targetTimestamp = Number(targetTimestamp);
        serverTime = Number(serverTime);

        startTime =
            Number(startTime || video.currentTime || 0);

        if (!targetTimestamp || !serverTime) {
            return;
        }

        if (activeCountdownTarget === targetTimestamp) {
            return;
        }

        activeCountdownTarget = targetTimestamp;

        hasStartedScheduledPlayback = false;

        clearInterval(countdownInterval);

        const offsetMs =
            (serverTime * 1000) - Date.now();

        countdownInterval = setInterval(async () => {

            const syncedNow =
                Date.now() + offsetMs;

            const remainingMs =
                (targetTimestamp * 1000) - syncedNow;

            const remainingSeconds =
                Math.ceil(remainingMs / 1000);

            if (remainingMs > 0) {

                showCountdown(remainingSeconds);

                return;
            }

            clearInterval(countdownInterval);

            countdownInterval = null;
            activeCountdownTarget = null;

            hideCountdown();

            if (hasStartedScheduledPlayback) {
                return;
            }

            hasStartedScheduledPlayback = true;

            isApplyingRemote = true;

            try {

                video.currentTime = startTime;

                await video.play();

            } catch (error) {

                console.error(
                    'Play bloqué',
                    error
                );

                setStatus(
                    'Clique sur play si le navigateur bloque la lecture automatique.'
                );
            }

            isApplyingRemote = false;

            await syncState({
                is_playing: true,
                current_time:
                    Math.floor(video.currentTime || 0),
                clear_schedule: true,
            });

        }, 100);
    }

    async function applyState() {

        const state = await fetchState();

        if (!state) return;

        loadVideo(state.source_url);

        const scheduledAt =
            Number(state.scheduled_play_at || 0);

        const serverTime =
            Number(state.server_time || 0);

        const lastSyncedAt =
            Number(state.last_synced_at || 0);

        const hasNewSync =
            lastSyncedAt &&
            lastSyncedAt !== lastSeenSync;

        if (hasNewSync) {

            lastSeenSync = lastSyncedAt;

            if (
                scheduledAt &&
                scheduledAt > serverTime
            ) {

                startLocalCountdown(
                    scheduledAt,
                    serverTime,
                    Number(state.current_time || 0)
                );

                setStatus(
                    'Lecture prévue dans ' +
                    (scheduledAt - serverTime) +
                    ' seconde(s)'
                );

                return;
            }
        }

        if (
            scheduledAt &&
            scheduledAt > serverTime
        ) {

            startLocalCountdown(
                scheduledAt,
                serverTime,
                Number(state.current_time || 0)
            );

            setStatus(
                'Lecture prévue dans ' +
                (scheduledAt - serverTime) +
                ' seconde(s)'
            );

            return;
        }

        if (countdownInterval) return;
        if (isApplyingRemote) return;

        if (Date.now() < pauseLockUntil) {
            return;
        }

        if (!scheduledAt) {

            hideCountdown();

            activeCountdownTarget = null;
        }

        const remoteTime =
            Number(state.current_time || 0);

        const localTime =
            Number(video.currentTime || 0);

        const tolerance =
            state.is_playing ? 2 : 0.5;

        if (
            Math.abs(localTime - remoteTime) > tolerance &&
            !video.seeking
        ) {

            try {
                video.currentTime = remoteTime;
            } catch (e) {}
        }

        if (state.is_playing) {

            if (video.paused) {

                isApplyingRemote = true;

                video.play().catch(() => {});

                setTimeout(() => {
                    isApplyingRemote = false;
                }, 300);
            }

            setStatus('Lecture en cours');

        } else {

            if (!video.paused) {

                isApplyingRemote = true;

                video.pause();

                setTimeout(() => {
                    isApplyingRemote = false;
                }, 300);
            }

            setStatus('Lecture en pause');
        }
    }

    async function launchIn10Seconds() {

        const state = await fetchState();

        if (!state?.server_time) {
            return;
        }

        const launchAt =
            Number(state.server_time) + 10;

        const startTime =
            Math.floor(video.currentTime || 0);

        video.pause();

        const savedState = await syncState({
            is_playing: false,
            current_time: startTime,
            scheduled_play_at: launchAt,
        });

        startLocalCountdown(
            launchAt,
            Number(
                savedState?.server_time ||
                state.server_time
            ),
            startTime
        );
    }

    async function pauseSync() {

        pauseLockUntil = Date.now() + 3000;

        isApplyingRemote = true;

        stopCountdown();

        hasStartedScheduledPlayback = false;

        const currentTime =
            Math.floor(video.currentTime || 0);

        video.pause();

        await syncState({
            is_playing: false,
            current_time: currentTime,
            clear_schedule: true,
        });

        setStatus('Lecture en pause');

        setTimeout(() => {
            isApplyingRemote = false;
        }, 800);
    }

    document.addEventListener(
        'DOMContentLoaded',
        async () => {

            const initialState =
                await fetchState();

            if (initialState?.source_url) {

                loadVideo(
                    initialState.source_url
                );
            }

            lastSeenSync =
                Number(
                    initialState?.last_synced_at || 0
                );

            document
                .getElementById('launchBtn')
                .addEventListener(
                    'click',
                    launchIn10Seconds
                );

            document
                .getElementById('pauseBtn')
                .addEventListener(
                    'click',
                    pauseSync
                );

            setInterval(applyState, 1000);

            setInterval(async () => {

                if (video.paused) return;
                if (isApplyingRemote) return;
                if (countdownInterval) return;

                if (Date.now() < pauseLockUntil) {
                    return;
                }

                await syncState({
                    is_playing: true,
                    current_time:
                        Math.floor(video.currentTime || 0),
                });

            }, 2000);
        }
    );
</script>

</body>
</html>