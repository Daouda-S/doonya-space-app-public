<x-sidebar-layout>
    @if (Session()->has('error'))
        <div style=" margin:2px; position: relative; display: grid; align-items: center; font-family: 'Sans-serif'; font-weight: bold; text-transform: uppercase; white-space: nowrap; user-select: none; background-color: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.375rem; opacity: 1;">
            {{ Session('error') }}
        </div>
    @endif
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier la reservation </h4>
            </div>
            <form class="forms-sample" action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- espace Field -->
                <div class="mb-4">
                    {{-- <div class="form-group m-2">
                        <label>Choisir l'espace</label>
                        <select name="espace" id="espace" class="form-control form-select-sm" style="color: black"  required>
                            <option value="">Choisissez un espace</option>
                            @foreach($espaces as $espace)
                            <option value="{{ $espace['id'] }}" {{ $reservation['espace_id'] == $espace['id'] ? 'selected' : '' }}>
                                {{ $espace['nom'] }}
                            </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group m-2">
                        <label>Nom de l'espace</label>
                        <input type="text" hidden value="{{ $reservation->espace->id }}" id="espace" name="espace" class="form-control form-control-sm" required />
                        <input type="text" value="{{ $reservation->espace->nom }}" readonly class="form-control form-control-sm" required />
                    </div>
                    @error('espace')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <!-- user Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Choisir l'utilisateur</label>
                        <select name="user" id="user" class="form-control form-select-sm" style="color: black" required>
                            <option value="">Choisissez un utilisateur</option>
                            @foreach($users as $user)
                                <option value="{{ $user['id'] }}" {{ $reservation['user_id'] == $user['id'] ? 'selected' : '' }}>
                                    {{ $user['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('user')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                
                <!-- date debut Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Date de début</label>
                        <input type="date" name="dateDebut" id="dateDebut" value="{{ $dateDebut }}" class="form-control form-control-sm" required />
                    </div>
                    @error('dateDebut')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                
                <!-- date de fin Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Date de fin</label>
                        <input type="date" name="dateFin" id="dateFin" value="{{ $dateFin }}" class="form-control form-control-sm" required />
                    </div>
                    @error('dateFin')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <div class="mb-4 m-2">
                    <label for="diffDays" class=" text-sm font-medium text-gray-700">Nombre de jours :</label>
                    <label id="diffDays" class=" text-sm text-gray-700"></label> <!-- Affichage de la différence en jours -->
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Prix</label>
                        <input type="number" name="prix" id="prix" value="{{ $reservation['prix'] }}" class="form-control form-control-sm" required />
                    </div>
                    @error('prix')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <!-- Options Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Choisir les options :</label>
                        <div class="flex flex-wrap gap-4 mt-4">
                            @foreach ($options as $option)
                                <div class="flex items-center gap-2">
                                    <input 
                                        type="checkbox" 
                                        name="option[]" 
                                        value="{{ $option['id'] }}" 
                                        id="{{ $option->option->prix }}" 
                                        data="{{ $option->option->prix }}" 
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                        @if(in_array($option->id, $reservation->options->pluck('id')->toArray())) checked @endif
                                    />
                                    <label for="option-{{ $option['id'] }}" class="text-sm text-gray-700">
                                        {{ $option->option->materiel }} ({{ $option->option->prix }}Fcfa)
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--  status Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Choisir le status</label>
                        <select name="status" id="status" class="form-control form-select-sm" style="color: black" required>
                            <option {{ old('status', $reservation['status']) == 'En cours de validation' ? 'selected' : '' }} value="En cours de validation">En cours de validation</option>
                            <option {{ old('status', $reservation['status']) == 'Payé' ? 'selected' : '' }} value="Payé">Payé</option>
                            <option {{ old('status', $reservation['status']) == 'Terminée' ? 'selected' : '' }} value="Terminée">Terminée</option>
                        </select>
                    </div>
                </div>
                <!--  image Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Capture de paiement</label>
                        <input type="file" name="image" id="image" value="{{ $reservation['image'] }}" class="form-control form-control-sm" />
                    </div>
                </div>
                <div class="mt-6 mb-4 mx-2">
                    <button type="submit" id="submitBtn" class="btn btn-primary me-2">Envoyer</button>
                    <button class="btn btn-danger" id="cancelBtn" style="color: white"><a style="color: white; text-decoration:none" href="{{ route('admin.reservations') }}">Annuler</a></button>
                </div>
            </form>
        </div>
    </div>
    <!-- Overlay flou -->
    <div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(f, f, f, 0.5); backdrop-filter: blur(5px); z-index: 998;">
    </div>

    <!-- Loader (invisible par défaut) -->
    <div id="loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 999;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
           
        // Affichage du loader lors de la soumission du formulaire
        $('#editForm').submit(function(e) {
            e.preventDefault(); // Empêche la soumission immédiate du formulaire

            // Afficher le loader
            $('#overlay').show();
            $('#loader').show();

            // Désactiver le bouton de soumission pour éviter plusieurs soumissions
            $('#submitBtn').prop('disabled', true);

            // Soumettre le formulaire après 1 seconde (ou via AJAX si besoin)
            setTimeout(function() {
                $('#editForm')[0].submit(); // Soumission du formulaire classique
            }, 1000); // Simuler un délai pour tester le loader
        });

            // Action pour le bouton "Annuler"
            $('#cancelBtn').click(function() {
                // Afficher le loader
                $('#loader').show(); // Affiche le loader
                $('#overlay').show();
            });
        });

        
      document.addEventListener("DOMContentLoaded", function() {
          // Sélectionner les éléments
          const dateDebut = document.getElementById('dateDebut');
          const dateFin = document.getElementById('dateFin');
          const prix = document.getElementById('prix');
          const optionsCheckbox = document.querySelectorAll('input[name="option[]"]');
          const diffDaysDisplay = document.getElementById('diffDays');
          diffDaysDisplay.value = 1;
        
        function calculerPrix() {
          // Vérifier que les champs ne sont pas vides
          if (!dateDebut.value || !dateFin.value) {
            prix.value = parseFloat("{{ $reservation->prix }}");  // Si une date est vide, réinitialiser le prix
            diffDaysDisplay.textContent = '';
            return;
          }   
          
          const debut = new Date(dateDebut.value);
          const fin = new Date(dateFin.value);
          const prixParJour = parseFloat("{{ $espace->prix }}");
          const today = new Date();
          today.setHours(0, 0, 0, 0);
          const currentTime = new Date();
          const currentHour = currentTime.getHours();
          const currentMinute = currentTime.getMinutes();
          // Vérifiez si les dates sont valides
          if (isNaN(debut.getTime()) || isNaN(fin.getTime())) {
              console.log("Dates invalides");
              prix.value = prixParJour;  // Si une des dates est invalide, réinitialiser le prix
              return;
          }
          
        let checkedIds = [];  // Tableau pour stocker les id des options cochées
        let calcule = 0; // Tableau pour stocker les id des options cochées
        // Parcourir chaque case à cocher
        optionsCheckbox.forEach(function(option) {
            if (option.checked) {
                // Si l'option est cochée, récupérer son id et l'ajouter au tableau
                checkedIds.push(option.id);
            }
        });
        const checkedIdsAsInt = checkedIds.map(id => parseInt(id));  // Transformer en entier
        console.log("Id des options cochées (en entier) : ", checkedIdsAsInt);
        // Utiliser reduce pour additionner tous les éléments du tableau
        calcule = checkedIdsAsInt.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
        console.log("La somme des ids sélectionnés est :", calcule);
          
        // Vérifier si la dateFin est après dateDebut
        if (fin >= debut) {
            dateDebut.style.color = 'black';
            dateFin.style.color = 'black';
            // Calculer la différence en millisecondes
            const diffTime = fin - debut;
            // Convertir la différence en jours (millisecondes -> jours)
            const diffDays = diffTime / (1000 * 3600 * 24);
            diffDaysDisplay.textContent = (parseInt(diffDays.toFixed(0)) + 1);
            // Si la durée est de 0 jour (fin égale à début), définir un jour minimum
            if (diffDays == 0) {
                prix.value = prixParJour+calcule;
            } else {
                // Calculer le prix total basé sur la durée
                const prixOptions = diffDays * calcule + calcule;
                const totalPrix = diffDays * prixParJour + prixOptions + prixParJour;
                prix.value = totalPrix;
            }
          } else {
                dateDebut.style.color = 'red';
                dateFin.style.color = 'red';
                prix.value = prixParJour+calcule;  // Si dateFin est avant dateDebut, réinitialiser le prix
                diffDaysDisplay.textContent = '';
          }
        }
        // Ajouter des écouteurs d'événements pour recalculer le prix lorsque les dates changent
        dateDebut.addEventListener('input', calculerPrix);
        dateFin.addEventListener('input', calculerPrix);
        // Ajouter des écouteurs d'événements pour chaque case à cocher
        optionsCheckbox.forEach(function(option) {
            option.addEventListener('change', calculerPrix);  // Recalculer le prix quand une option est sélectionnée ou désélectionnée
        });
      });

          // Initialisation de Flatpickr
        flatpickr("#dateDebut", {
            dateFormat: "Y-m-d", // Format de la date
            minDate: "today", // Empêcher la sélection de dates passées
            locale: "fr", // Langue (ici en français)
            allowInput: false // Permet l'édition manuelle
        });
        flatpickr("#dateFin", {
            dateFormat: "Y-m-d", // Format de la date
            minDate: "today", // Empêcher la sélection de dates passées
            locale: "fr", // Langue (ici en français)
            allowInput: false // Permet l'édition manuelle
        });

    </script>
</x-sidebar-layout>