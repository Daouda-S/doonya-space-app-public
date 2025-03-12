<x-sidebar-layout>
    @if (Session()->has('error'))
        <div style=" margin:2px; position: relative; display: grid; align-items: center; font-family: 'Sans-serif'; font-weight: bold; text-transform: uppercase; white-space: nowrap; user-select: none; background-color: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.375rem; opacity: 1;">
            {{ Session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="position-relative card-body">
                <div class="m-2">
                    <p class="card-title">Les Salles</p>
                    <button id="add" class=" position-absolute btn-primary btn" type="button" style="right:2%; top:1%;"><a href="{{ route('admin.espaces.create') }}" style="font-style: none;color:white;font-size:1rem;font-weight:700" >Ajouter</a></button>
                </div>
              <div class="row ">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="example" class="display expandable-table" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nom</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Options Supplementaires</th>
                          <th>Prix</th>
                          {{-- <th>Image</th> --}}
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($espaces as $espace)
                        <tr>
                            <td>{{ $espace['id'] }}</td>
                            <td>{{ $espace['nom'] }}</td>
                            <td>{{ $espace['description'] }}</td>
                            <td @if ($espace->status == "disponible") style="color:#16a34a" @endif > {{ $espace->status }}</td>
                            <td >
                                <ul class="mt-3" style="list-style-type: none;">
                                    @forelse ( $espace->options as $option)
                                        <li>{{ $option['materiel'] }}</li>
                                    @empty
                                        <li style="color: #ef4444">pas d'option supplementaire</li>
                                    @endforelse
                                </ul>
                            </td>
                            <td >{{ $espace['prix'] }} Fcfa</td>
                            {{-- <td >
                                @if ($espace->espaceImage->isNotEmpty())
                                    <img height="100px" width="100px" class="rounded" src="{{ asset('storage/' . $espace->espaceImage->first()->image) }}" alt="Image option" />
                                @else
                                    <p style="color: #ef4444">pas d'image </p>
                                @endif
                            </td> --}}
                            <td class="row relative px-6 py-5">
                                <a id="pencil" class=" col-2 text-sm text-center"  href="{{ route('admin.espaces.edit', $espace['id']) }}">
                                    <i class="icon-layout menu-icon mdi mdi-pencil" style="color: #16a34a;font-size: 25px;"></i>
                                </a>
                                <a id="eye" class=" col-2 text-sm text-center"href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espace->id }}">
                                    <i class="icon-layout menu-icon mdi mdi-eye" style="color: #1f4b99;font-size: 25px;"></i>
                                </a>
                                <form class="col-2" action="{{ route('admin.espaces.destroy', $espace['id']) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette option ?');">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="text-sm" style="background: none;border: none;cursor: pointer;padding: 0;">
                                            <i class="icon-layout menu-icon mdi mdi-delete"  style="color:#ef4444;font-size: 25px;"></i>
                                        </button>
                                    
                                </form>
                                @if ($espace->status == "disponible")
                                    <button class=" col-2 item-center btn-primary btn btn-sm" style="background-color: #16a34a; border:none; width:95px" type="button"><a href="{{ route('admin.reservations.create', $espace['id']) }}" style="font-style: none;color:white;font-size:1rem;font-weight:700;" >Reserver</a></button>
                                @endif
                            </td>
                        </tr>

                                  <!-- Modale pour afficher toutes les images -->
                        <div class="modal fade" id="allImagesModal{{ $espace->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 95%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="allImagesModalLabel">
                                            Doonya Space Application de reservation.
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <p> ID : {{ $espace['id'] }}</p>
                                            <p> Nom : {{ $espace['nom'] }}</p>
                                            <p> Description : {{ $espace['description'] }}</p>
                                            <p> Status : {{ $espace->status }}</p>
                                            <p> Prix : {{ $espace['prix'] }} Fcfa</p>
                                            <p> Options Supplementaires : 
                                                @forelse ( $espace->options as $option)
                                                    <strong>{{ $option['materiel'] }} - </strong>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex-wrap gap-4">
                                                    @foreach ($espace->espaceImage as $image)
                                                        <div class=" col-2 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="200px" width="200px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr class="border-b hover:bg-gray-100">
                            <td >Pas d'espace disponible</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
              
              // Action pour le bouton "modifier"
              $('#pencil').click(function() {
                  // Afficher le loader
                  $('#loader').show(); // Affiche le loader
                  $('#overlay').show();
              });
              // Action pour le bouton "voir"
              $('#add').click(function() {
                  // Afficher le loader
                  $('#loader').show(); // Affiche le loader
                  $('#overlay').show();
              });
          });
  
      </script>

</x-sidebar-layout>


