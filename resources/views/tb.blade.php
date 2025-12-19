<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préparation du Scan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
            background: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .download-btn {
            display: block;
            
            max-width: 400px;
            margin: 10px auto;
            padding: 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .download-btn:hover {
            background-color: #0056b3;
        }

        .checklist {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }

        .checklist li {
            background: white;
            margin: 8px 0;
            padding: 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .checklist input[type="checkbox"] {
            margin-right: 12px;
        }

        .checklist label {
            flex-grow: 1;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <h1>Préparation du Scan</h1>

    <!-- Boutons de téléchargement -->
    <a href="/tb/tickboss.apk" class="download-btn" onclick="checkTask(0)">📥 Télécharger AtbScan</a>
    <a href="/tb/supremo.apk" class="download-btn" onclick="checkTask(1)">📥 Télécharger Supremo</a>
    <a href="/tb/addsupremo.apk" class="download-btn" onclick="checkTask(2)">📥 Télécharger Supremo Addon</a>

    <!-- Liste de choses à faire -->
    <ul class="checklist">
        <li><input type="checkbox" id="task-0"><label for="task-0">Télécharger AtbScan</label></li>
        <li><input type="checkbox" id="task-1"><label for="task-1">Télécharger Supremo</label></li>
        <li><input type="checkbox" id="task-2"><label for="task-2">Télécharger Supremo Addon</label></li>
        <li><input type="checkbox" id="task-3"><label for="task-3">Couper le son du scan (voir Scanner Settings)</label></li>
        <li><input type="checkbox" id="task-4"><label for="task-4">Changer la langue du clavier en FR</label></li>
        <li><input type="checkbox" id="task-5"><label for="task-5">Désactiver la veille automatique du scan</label></li>
        <li><input type="checkbox" id="task-6"><label for="task-6">Désactiver la luminosité automatique</label></li>
        <li><input type="checkbox" id="task-7"><label for="task-7">Monter la luminosité au maximum</label></li>
        <li><input type="checkbox" id="task-8"><label for="task-8">Mettre le système en français</label></li>
        <li><input type="checkbox" id="task-9"><label for="task-9">Tester Supremo</label></li>
        <li><input type="checkbox" id="task-10"><label for="task-10">Rentrer le nom du lieu dans AtbScanPie</label></li>
    </ul>

    <ul>
  <li><a href="intent:#Intent;action=android.settings.DISPLAY_SETTINGS;end;">🔆 Ouvrir réglages d'affichage</a></li>
  <li><a href="intent:#Intent;action=android.settings.LOCALE_SETTINGS;end;">🌐 Changer langue du système</a></li>
  <li><a href="intent:#Intent;action=android.settings.SOUND_SETTINGS;end;">🔈 Ouvrir les sons</a></li>
</ul>

    <script>
        const taskCount = 11;

        // Sauvegarde ou récupération depuis localStorage
        window.onload = () => {
            for (let i = 0; i < taskCount; i++) {
                const checkbox = document.getElementById('task-' + i);
                const checked = localStorage.getItem('task-' + i) === 'true';
                checkbox.checked = checked;

                checkbox.addEventListener('change', () => {
                    localStorage.setItem('task-' + i, checkbox.checked);
                });
            }
        }

        function checkTask(index) {
            const checkbox = document.getElementById('task-' + index);
            checkbox.checked = true;
            localStorage.setItem('task-' + index, 'true');
        }
    </script>
</body>
</html>