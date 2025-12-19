<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des appels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="mt-4" style="margin:10px;">
    <!-- Bouton pour afficher ou cacher les filtres -->
    <button id="toggle-filters-btn" class="btn btn-secondary mb-3" onclick="toggleFilters()">Afficher/Cacher les filtres</button>

    <div class="row">
        <!-- Appels de Yves -->
        <div class="col-md-6">
            <h3>Appels d'Yves</h3>

            <!-- Champs de texte pour filtrer les colonnes -->
            <div id="filters-yves" class="mb-2">
                <input type="text" id="filter-time-yves" onkeyup="filterTable('yves-table', 0, this.value)" class="form-control" placeholder="Filtrer par heure">
                <input type="text" id="filter-number-yves" onkeyup="filterTable('yves-table', 1, this.value)" class="form-control" placeholder="Filtrer par numéro">
                <input type="text" id="filter-status-yves" onkeyup="filterTable('yves-table', 2, this.value)" class="form-control" placeholder="Filtrer par statut">
            </div>

            <table class="table table-striped" id="yves-table">
                <thead>
                <tr>
                    <th onclick="sortTable('yves-table', 0)">Heure</th>
                    <th onclick="sortTable('yves-table', 1)">Numéro</th>
                    <th onclick="sortTable('yves-table', 2)">Status</th>
                    <th>Code Client</th> <!-- Nouvelle colonne pour afficher les codes clients -->
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($calls as $call)
                    @if($call->interlocuteur == 'Yves' && $call->status != 'supprimer')
                        <tr id="call-{{ $call->id }}">
                            <td>{{ $call->created_at->format('H:i') }}</td>
                            <td>{{ $call->numero }}</td>
                            <td>{{ $call->status }}</td>
                            <td>
                                <!-- Afficher le code client s'il est renseigné -->
                                @if($call->codeCalling)
                                    <a href="{{route('viewCalls',['openModal'=> 1,'callId' => $call->id])}}"> <strong>{{ $call->codeCalling->code }}</strong></a>
                                @else
                                    <a href="{{route('viewCalls',['openModal'=> 1,'callId' => $call->id])}}"><em>Aucun code</em></a>
                                @endif
                            </td>
                            <td>
                                <div id="note-{{$call->id}}">
                                    @if($call->note)
                                        <strong>Note:</strong> {{ $call->note }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <select name="status" class="form-select" onchange="updateStatusAjax({{ $call->id }}, this.value)">
                                    <option value="open" {{ $call->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="fermer" {{ $call->status == 'fermer' ? 'selected' : '' }}>Fermer</option>
                                    <option value="en cours" {{ $call->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="a rappeler" {{ $call->status == 'a rappeler' ? 'selected' : '' }}>À rappeler</option>
                                    <option value="supprimer" {{ $call->status == 'supprimer' ? 'selected' : '' }}>Supprimer</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#noteModal{{ $call->id }}">Ajouter note</button>
                                <button class="btn btn-danger btn-sm" onclick="markAsDeleted({{ $call->id }})">Supprimer</button>
                            </td>
                        </tr>

                        <!-- Modal pour ajouter une note -->
                        <div class="modal fade" id="noteModal{{ $call->id }}" tabindex="-1" aria-labelledby="noteModalLabel{{ $call->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="noteModalLabel{{ $call->id }}">Ajouter une note</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="noteForm{{ $call->id }}" data-id="{{ $call->id }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Note</label>
                                                <textarea class="form-control" name="note" rows="3"></textarea>
                                            </div>
                                            <button type="button" class="btn btn-success" onclick="addNoteAjax({{ $call->id }})">Enregistrer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </tbody>
            </table>

            <p>Total d'appels : {{ $calls->where('interlocuteur', 'Yves')->where('status', '!=', 'supprimer')->count() }}</p>
        </div>

        <!-- Appels de Léo -->
        <div class="col-md-6">
            <h3>Appels de Léo</h3>

            <!-- Champs de texte pour filtrer les colonnes -->
            <div id="filters-leo" class="mb-2">
                <input type="text" id="filter-time-leo" onkeyup="filterTable('leo-table', 0, this.value)" class="form-control" placeholder="Filtrer par heure">
                <input type="text" id="filter-number-leo" onkeyup="filterTable('leo-table', 1, this.value)" class="form-control" placeholder="Filtrer par numéro">
                <input type="text" id="filter-status-leo" onkeyup="filterTable('leo-table', 2, this.value)" class="form-control" placeholder="Filtrer par statut">
            </div>

            <table class="table table-striped" id="leo-table">
                <thead>
                <tr>
                    <th onclick="sortTable('leo-table', 0)">Heure</th>
                    <th onclick="sortTable('leo-table', 1)">Numéro</th>
                    <th onclick="sortTable('leo-table', 2)">Status</th>
                    <th>Code Client</th> <!-- Nouvelle colonne pour afficher les codes clients -->
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($calls as $call)
                    @if($call->interlocuteur == 'Léo' && $call->status != 'supprimer')
                        <tr id="call-{{ $call->id }}">
                            <td>{{ $call->created_at->format('H:i') }}</td>
                            <td>{{ $call->numero }}</td>
                            <td>{{ $call->status }}</td>
                            <td>
                                <!-- Afficher le code client s'il est renseigné -->
                                @if($call->codeCalling)
                                    <a href="{{route('viewCalls',['openModal'=> 1,'callId' => $call->id])}}">   <strong>{{ $call->codeCalling->code }}</strong> </a>
                                @else
                                    <a href="{{route('viewCalls',['openModal'=> 1,'callId' => $call->id])}}"><em>Aucun code</em></a>
                                @endif
                            </td>
                            <td>
                                <div id="note-{{$call->id}}">
                                    @if($call->note)
                                        <strong>Note:</strong> {{ $call->note }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <select name="status" class="form-select" onchange="updateStatusAjax({{ $call->id }}, this.value)">
                                    <option value="open" {{ $call->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="fermer" {{ $call->status == 'fermer' ? 'selected' : '' }}>Fermer</option>
                                    <option value="en cours" {{ $call->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="a rappeler" {{ $call->status == 'a rappeler' ? 'selected' : '' }}>À rappeler</option>
                                    <option value="supprimer" {{ $call->status == 'supprimer' ? 'selected' : '' }}>Supprimer</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#noteModal{{ $call->id }}">Ajouter note</button>
                                <button class="btn btn-danger btn-sm" onclick="markAsDeleted({{ $call->id }})">Supprimer</button>
                            </td>
                        </tr>

                        <!-- Modal pour ajouter une note -->
                        <div class="modal fade" id="noteModal{{ $call->id }}" tabindex="-1" aria-labelledby="noteModalLabel{{ $call->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="noteModalLabel{{ $call->id }}">Ajouter une note</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="noteForm{{ $call->id }}" data-id="{{ $call->id }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Note</label>
                                                <textarea class="form-control" name="note" rows="3"></textarea>
                                            </div>
                                            <button type="button" class="btn btn-success" onclick="addNoteAjax({{ $call->id }})">Enregistrer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </tbody>
            </table>

            <p>Total d'appels : {{ $calls->where('interlocuteur', 'Léo')->where('status', '!=', 'supprimer')->count() }}</p>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalClientOpen" tabindex="-1" aria-labelledby="noteModalLabel{{ $call->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel{{ $call->id }}">Appel en cours pour le numéro : {{ $call->numero }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Vérifier si un code existe pour ce numéro -->
                @if($codeCalling)
                    <p>
                        <strong>Code Client :</strong>
                        <span id="clientCodeText{{ $call->id }}">{{ $codeCalling->code }}</span>
                        <!-- Bouton pour copier le code -->
                        <button id="copyButton{{ $call->id }}" class="btn btn-outline-secondary btn-sm" onclick="copyToClipboard('clientCodeText{{ $call->id }}', 'copyButton{{ $call->id }}')">Copier</button>
                    </p>

                    <!-- Liste des 5 derniers appels -->
                    <h6>Historique des 10 derniers appels :</h6>
                    <ul class="list-group">
                        @foreach($recentCalls as $recentCall)
                            <li class="list-group-item">
                                <strong>Date & Heure :</strong> {{ $recentCall->created_at->format('d/m/Y H:i') }}<br>
                                <strong>Interlocuteur :</strong> {{ $recentCall->interlocuteur }}<br>
                                <strong>Note :</strong> {{ $recentCall->note ?? 'Aucune note' }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <!-- Afficher le formulaire si aucun code n'est trouvé -->
                    <form action="{{ route('saveClientCode') }}" method="POST">
                        @csrf
                        <input type="hidden" name="numero" value="{{ $call->numero }}">
                        <div class="mb-3">
                            <label for="clientCode" class="form-label">Code Client</label>
                            <input type="text" class="form-control" id="clientCode" name="code" placeholder="Saisissez le code client">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer le code</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Script de filtrage, tri, suppression logique et affichage des filtres -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Vérifier les paramètres de l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const openModal = urlParams.get('openModal');
        const callId = urlParams.get('callId');

        if (openModal && callId) {
            // Ouvrir la modal pour le callId donné
            var targetModal = document.querySelector('#ModalClientOpen');
            if (targetModal) {
                var modalInstance = bootstrap.Modal.getOrCreateInstance(targetModal);
                modalInstance.show();
            }
        }
    });

    function copyToClipboard(elementId, buttonId) {
        var textToCopy = document.getElementById(elementId).textContent;

        if (navigator.clipboard) {
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    changeButtonStyle(buttonId);
                })
                .catch(err => {
                    console.error('Erreur lors de la copie dans le presse-papiers :', err);
                });
        } else {
            var tempElement = document.createElement("textarea");
            tempElement.value = textToCopy;
            document.body.appendChild(tempElement);
            tempElement.select();
            document.execCommand("copy");
            document.body.removeChild(tempElement);
            changeButtonStyle(buttonId);
        }
    }

    function changeButtonStyle(buttonId) {
        var copyButton = document.getElementById(buttonId);
        copyButton.classList.remove('btn-outline-secondary');
        copyButton.classList.add('btn-success');
        copyButton.textContent = "Copié !";

        // Remettre le bouton à son état d'origine après 2 secondes
        setTimeout(() => {
            copyButton.classList.remove('btn-success');
            copyButton.classList.add('btn-outline-secondary');
            copyButton.textContent = "Copier";
        }, 2000);
    }

    // Fonction pour afficher ou cacher les filtres
    function toggleFilters() {
        const filtersYves = document.getElementById('filters-yves');
        const filtersLeo = document.getElementById('filters-leo');
        const displayStyle = filtersYves.style.display === 'none' ? 'block' : 'none';
        filtersYves.style.display = displayStyle;
        filtersLeo.style.display = displayStyle;
    }

    // Fonction de tri sur les colonnes
    function sortTable(tableId, columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById(tableId);
        switching = true;
        // Initialement, trier en ordre ascendant
        dir = "asc";

        // Boucle jusqu'à ce qu'aucun switch n'ait lieu
        while (switching) {
            switching = false;
            rows = table.rows;
            // Boucle sur toutes les lignes sauf l'en-tête
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[columnIndex];
                y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                // Si un switch doit avoir lieu, le faire
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                // Si aucun switch n'a eu lieu et que la direction est "asc", passer à "desc"
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }

    // Fonction pour filtrer les tableaux
    function filterTable(tableId, columnIndex, filterValue) {
        var filter, table, tr, td, i, txtValue;
        filter = filterValue.toUpperCase();
        table = document.getElementById(tableId);
        tr = table.getElementsByTagName("tr");

        // Boucle sur toutes les lignes du tableau
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[columnIndex];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function updateStatusAjax(callId, status) {
        $.ajax({
            url: '/updateStatus/' + callId,
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "status": status
            },
            success: function (response) {
                console.log('Statut mis à jour avec succès pour l\'appel ' + callId);
            },
            error: function () {
                alert('Erreur lors de la mise à jour du statut.');
            }
        });
    }

    // Fonction pour marquer un appel comme "supprimer"
    function markAsDeleted(callId) {
        $.ajax({
            url: '/updateStatus/' + callId,
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "status": "supprimer"
            },
            success: function (response) {
                // Supprimer la ligne du tableau visuellement
                document.getElementById("call-" + callId).style.display = 'none';
            },
            error: function () {
                alert('Erreur lors de la suppression.');
            }
        });
    }

    // Fonction pour ajouter une note via AJAX
    function addNoteAjax(callId) {
        var form = $('#noteForm' + callId);
        var note = form.find('textarea[name="note"]').val();

        $.ajax({
            url: '/addNote/' + callId,
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                $('#note-' + callId).html("")
                $('#note-' + callId).html('<strong>Note:</strong> ' + response.note);
                console.log(callId)
                $('#noteModal' + callId).modal('hide');
            },
            error: function () {
                alert('Erreur lors de l\'ajout de la note.');
            }
        });
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
