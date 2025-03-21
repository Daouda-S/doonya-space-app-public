@section('title'){{ 'Reserver' }}@endsection
<x-app-layout>

    <div class="page-title" data-aos="fade">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                <h1 style="font-weight: 900 ; font-size:3.2em ; color:white">Passer une Reservation</h1>
                <p class="mb-0">Passer une reservation en un click.</p>
            </div>
          </div>
        </div>
      </div><!-- End Page Title -->

    <div class=" row mx-3">
        <!-- Testimonials Section -->
    <!-- Hero Section -->
    <section class=" row gy-4">
        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <form class="forms-sample" action="{{ route('payement.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom de l'espace</label>
                    <input type="text" hidden value="{{ $espace->id }}" id="espace" name="espace" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                    <input type="text" value="{{ $espace->nom }}" readonly class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                </div>
                <input type="text" hidden value="{{ $user->id }}" name="user">

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Date de debut</label>
                    <input type="date" placeholder="Cliquez pour choisir la date de debut" name="dateDebut" id="dateDebut" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                    @error('dateDebut')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Date de Fin</label>
                    <input type="date" placeholder="Cliquez pour choisir la date de fin" name="dateFin" id="dateFin" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                    @error('dateFin')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <div class="mb-4">
                  <label for="diffDays" class=" text-sm font-medium text-gray-700">Nombre de jours :</label>
                  <label id="diffDays" class=" text-sm text-gray-700"></label> <!-- Affichage de la différence en jours -->
              </div>

                <!-- Options Field -->
                <div class="mb-4">
                    @if ($options && $options->isNotEmpty())
                    <label class="block text-sm font-medium text-gray-700">Choisir les options :</label>
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
                                />
                                <label for="option-{{ $option['id'] }}" class="text-sm text-gray-700">
                                    {{ $option->option->materiel }} ({{ $option->option->prix }}Fcfa)
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700">Prix</label>
                  <input type="number" value="{{ $espace->prix }}" name="prix" id="prix" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required readonly />
                  @error('prix')
                      <label class="text-danger">{{ $message }}</label>
                  @enderror
              </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-2" style="background-color: #1f4b99;">Passer au Paiement</button>
                    <button class="btn btn-danger" style="color: white"><a style="color: white; text-decoration:none" href="{{ route('pages.boutique') }}">Retour</a></button>
                </div>
            </form>
        </div>
        <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
          <div class="row gy-4">
            @if ($espace->espaceImage->count() == 1)
            <h1 style="font-weight: 700 ; font-size:1.2em ; text-align:center" class="mb-2">L'Image</h1>
                  <!-- Si une seule image, afficher une grande image -->
                  <div class="col-12 d-flex justify-content-center align-items-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                      <img class="rounded" height="500px" width="500px" src="{{ asset('storage/' . $espace->espaceImage->first()->image) }}" alt="Image espace" />
                  </a>
                  </div>
                  <!-- Modale qui s'affiche lors du clic sur l'image -->
                  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <!-- Afficher l'image -->
                                <img class="img-fluid rounded" src="{{ asset('storage/' . $espace->espaceImage->first()->image) }}" alt="Image espace" />
                            </div>
                        </div>
                    </div>
                </div>
              @elseif ($espace->espaceImage->count() == 2)
              <h1 style="font-weight: 700 ; font-size:1.2em ; text-align:center" class="mb-2">Les Images</h1>
                @foreach ($espace->espaceImage as $image)
                  <div class="col-lg-6">
                    <div class=" d-flex justify-content-center align-items-center">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $image->id }}">
                        <img class="rounded" height="300px" width="300px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                      </a>
                    </div>
                  </div>
                  <!-- Modale qui s'affiche lors du clic sur l'image -->
                  <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img class="img-fluid rounded" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                            </div>
                        </div>
                    </div>
                  </div>
                @endforeach
              @else
              <h1 style="font-weight: 700 ; font-size:1.2em ; text-align:center" class="">Les Images</h1>
              <div class="row gy-4">
                @foreach ($espace->espaceImage->take(6) as $image)  <!-- Afficher seulement les 6 premières images -->
                    <div class="col-lg-4">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $image->id }}">
                            <img class="rounded" height="200px" width="200px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                        </a>
                    </div>
            
                    <!-- Modale pour chaque image -->
                    <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $image->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <!-- Afficher l'image -->
                                    <img class="img-fluid rounded" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            
                <!-- Afficher l'icône "plus" après les 6 premières images -->
                @if ($espace->espaceImage->count() > 6)
                    <div class="col-12 text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal">
                            <button class="btn btn-primary" style="background-color: #1f4b99">
                                <i class="bi bi-plus-circle" ></i> Voir plus d'images
                            </button>
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Modale pour afficher toutes les images -->
            <div class="modal fade" id="allImagesModal" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 95%;">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                          <div class="row">
                              @foreach ($espace->espaceImage as $image)
                                  <div class="col-md-3 mb-3"> <!-- 4 images par ligne sur les écrans moyens et plus -->
                                      <img class="img-fluid rounded" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                  </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
            </div>
              @endif
            </div>

          </div>
    </section><!-- /Hero Section -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Sélectionner les éléments
        const dateDebut = document.getElementById('dateDebut');
        const dateFin = document.getElementById('dateFin');
        const prix = document.getElementById('prix');
        const optionsCheckbox = document.querySelectorAll('input[name="option[]"]');
        const diffDaysDisplay = document.getElementById('diffDays');
        diffDaysDisplay.value = 1;
        dateDebut.value = new Date().toISOString().split('T')[0];
        dateFin.value = new Date().toISOString().split('T')[0];
        // Fonction pour calculer et afficher le prix
        function calculerPrix() {
          
          // Vérifier que les champs ne sont pas vides
          
          if (!dateDebut.value || !dateFin.value) {
            prix.value = parseFloat("{{ $espace->prix }}");  // Si une date est vide, réinitialiser le prix
            diffDaysDisplay.textContent = '';
            return;
          }   
        //   const optionsCheckbox = document.querySelectorAll('input[name="option[]"]');
          
          const debut = new Date(dateDebut.value);
          const fin = new Date(dateFin.value);
          const prixParJour = parseFloat("{{ $espace->prix }}");
          const today = new Date();
          today.setHours(0, 0, 0, 0);
          // alert(debut);
          // alert(today);
          const currentTime = new Date();
          const currentHour = currentTime.getHours();
          const currentMinute = currentTime.getMinutes();
        //   if ( debut.getTime() === today.getTime()) {
        //         if (currentHour > 7) {
        //         alert("L'heure actuelle est superieure à 7h00. L'heure d'ouverture, vous ne pouvez reserver que demain.");
        //         dateDebut.value=new Date().toISOString().split('T')[0];
        //     }
        //   }
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
            //   alert("La date de fin doit être supérieure ou égale à la date de début.");
            //   dateFin.value=new Date().toISOString().split('T')[0];
            //   dateDebut.value=new Date().toISOString().split('T')[0];
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
   </x-app-layout>