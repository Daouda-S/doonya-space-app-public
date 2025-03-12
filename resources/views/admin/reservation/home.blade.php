<x-sidebar-layout>

    
    {{-- @if (Session()->has('success'))

        <div style=" margin:2px; position: relative; display: grid; align-items: center; font-family: 'Sans-serif'; font-weight: bold; text-transform: uppercase; white-space: nowrap; user-select: none; background-color: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.375rem; opacity: 1;">
            {{ Session::get('success') }}
        </div>
    @endif --}}



    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title">Les Reservations</p>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="example" class="display expandable-table border-b" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Clients</th>
                          <th>Espaces</th>
                          <th>Options Supplementaires</th>
                          <th>Date de debut</th>
                          <th>Date de fin</th>
                          <th>Prix</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation['id'] }}</td>
                            <td >{{ $reservation->user->name }}</td>
                            <td >{{ $reservation->espace->nom }}</td>
                            <td  >
                                <ul class="mt-3" style="list-style-type: none;">
                                    @forelse ( $reservation->options as $option)
                                        <li>{{ $option->option->matricule }}</li>
                                    @empty
                                        <li style="color: #ef4444">pas d'option supplementaire</li>
                                    @endforelse
                                </ul>
                            </td>
                            <td >{{ $reservation['dateDebut'] }}</td>
                            <td >{{ $reservation['dateFin'] }}</td>
                            <td >{{ $reservation['prix'] }} Fcfa</td>
                            <td class=" row relative px-6 py-5">
                                    <a  class=" col-4 text-sm text-center" href="{{ route('admin.reservations.edit', $reservation['id']) }}">
                                          <i id="pencil" class="icon-layout menu-icon mdi mdi-pencil" style="color: #16a34a;font-size: 25px;"></i>
                                    </a>
                                <form class="col-4" action="{{ route('admin.reservations.destroy', $reservation['id']) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette option ?');">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="text-sm" style="background: none;border: none;cursor: pointer;padding: 0;">
                                            <i class="icon-layout menu-icon mdi mdi-delete"  style="color:#ef4444;font-size: 25px;"></i>
                                        </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-b hover:bg-gray-100">
                            <td >Pas de reservation disponible</td>
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
        });

    </script>
</x-sidebar-layout>


