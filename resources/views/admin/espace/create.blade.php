<x-sidebar-layout>
    @if (Session()->has('error'))
        <div style=" margin:2px; position: relative; display: grid; align-items: center; font-family: 'Sans-serif'; font-weight: bold; text-transform: uppercase; white-space: nowrap; user-select: none; background-color: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.375rem; opacity: 1;">
            {{ Session('error') }}
        </div>
    @endif
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un nouveau espace</h4>
            </div>
            <form class="forms-sample" action="{{ route('admin.espaces.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Matricule Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label for="nom">Nom</label>
                        <select type="text" name="nom" id="nom" class="form-select form-select-sm" style="color: black" required>
                            <option value="bureau individuel">Bureau individuel</option>
                            <option value="salle de conference">Salle de conférence</option>
                            <option value="espace coworking">Espace de Co-working</option>
                            <option value="espace coworking VIP">Espace de Co-Working VIP</option>
                        </select>
                    </div>
                    @error('nom')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                
                <!-- Description Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-select form-select-sm" required />
                    </div>
                    @error('description')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                
                <!-- Materiel Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select form-select-sm" style="color: black" required>
                            <option value="disponible">Disponible</option>
                            <option value="indisponible">Indisponible</option>
                            <option value="déjà loué">déjà loué</option>
                        </select>
                    </div>
                    @error('status')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Prix</label>
                        <input type="number" name="prix" id="prix" class="form-select form-select-sm" required />
                    </div>
                    @error('prix')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                    </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Taille de l'espace</label>
                        <input type="text" name="taille" id="taille" class="form-select form-select-sm" required />
                    </div>
                    @error('taille')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label>Le nombre de personne que peut contenir l'espace</label>
                        <input type="number" name="capacite" id="capacite" class="form-select form-select-sm" required />
                    </div>
                    @error('capacite')
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
                                        id="option-{{ $option['id'] }}" 
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    />
                                    <label for="option-{{ $option['id'] }}" class="text-sm text-gray-700">
                                        {{ $option['matricule'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                

                <!-- Image Field -->
                <div class="mb-4">
                    <div class="form-group m-2">
                        <label for="image">Image :</label>
                        <input type="file" accept=".jpg,.jpeg,.png" name="espace_image[]" class=" mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" multiple credits='false' />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 mb-4 mx-2">
                    <button id="submitBtn" type="submit" class="btn btn-primary me-2">Envoyer</button>
                    <button id="cancelBtn" class="btn btn-danger" style="color: white"><a style="color: white; text-decoration:none" href="{{ route('admin.options') }}">Annuler</a></button>
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
                });
                // Action pour le bouton "Annuler"
                $('#cancelBtn').click(function() {
                    // Afficher le loader
                    $('#loader').show(); // Affiche le loader
                    $('#overlay').show();
    
                    // Redirection après 1 seconde (simule une attente)
                    setTimeout(function() {
                        window.location.href = "{{ route('admin.options') }}"; // Rediriger après l'action
                    }, 1000);
                });
        
            </script>
</x-sidebar-layout>