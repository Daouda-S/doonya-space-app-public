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
                    <div class="form-group m-2">
                        <label>Choisir l'espace</label>
                        <select name="espace" id="espace" class="form-control form-select-sm" style="color: black"  required>
                            <option value="">Choisissez un espace</option>
                            @foreach($espaces as $espace)
                            <option value="{{ $espace['id'] }}" {{ $reservation['espace_id'] == $espace['id'] ? 'selected' : '' }}>
                                {{ $espace['nom'] }}
                            </option>
                            @endforeach
                        </select>
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
                        <input type="datetime-local" name="dateDebut" id="dateDebut" value="{{ $reservation['dateDebut'] }}" class="form-control form-control-sm" required />
                    </div>
                    @error('dateDebut')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                
                <!-- date de fin Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Date de fin</label>
                        <input type="datetime-local" name="dateFin" id="dateFin" value="{{ $reservation['dateFin'] }}" class="form-control form-control-sm" required />
                    </div>
                    @error('dateFin')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
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
                                        id="options" 
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                        @if(in_array($option->id, $reservation->options->pluck('id')->toArray())) checked @endif
                                    />
                                    <label for="option-{{ $option['id'] }}" class="text-sm text-gray-700">
                                        {{ $option->option->matricule }}
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
                            <option {{ old('status', $reservation['status']) == 'Non payé' ? 'selected' : '' }} value="Non Payé"> Non Payé</option>
                        </select>
                    </div>
                </div>
                <!--  image Field -->
                {{-- <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Capture de paiement</label>
                        <input type="file" name="image" id="image" value="{{ $reservation['image'] }}" class="form-control form-control-sm" required />
                    </div>
                </div> --}}
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

    </script>
</x-sidebar-layout>