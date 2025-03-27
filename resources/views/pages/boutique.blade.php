@section('title'){{ 'nos salles' }}@endsection
<x-app-layout>
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                <h1 style="font-weight: 900 ; font-size:3.2em ; color:white">Nos Salles</h1>
                <p class="mb-0">Visiter toutes nos salles en location et faites votre choix</p>
            </div>
          </div>
        </div>
      </div><!-- End Page Title -->
      
      

    <!-- Shop Page -->
    <!-- Salle Section -->
    <div class="container">
        <div class="row mt-1">
            <div id="selected-value" class=" col-10" >
                <strong style="display: none;" >Valeur sélectionnée : <span id="display-value">Aucune sélection</span> </strong>
            </div>
            <div class="col-2">
                <select name="espace" id="espace" class="form-select">
                    <option value="">Filtrer par prix</option>
                    <option value="asc">prix >= 10.000 FCFA</option>
                    <option value="desc">prix < 10.000 FCFA</option>
                </select>
            </div>
        </div>
    </div>
    @php
            // prix
            
        // secondary-content
        $bureauIndividuelsSecondary = $bureauIndividuels->where('prix', '<', 10000);
        $salleConferencesSecondary = $salleConferences->where('prix', '<', 10000);
        $espaceCoworkingsSecondary = $espaceCoworkings->where('prix', '<', 10000);
        $espaceIndividuelsSecondary = $espaceIndividuels->where('prix', '<', 10000);
        // tertiary-content
        $bureauIndividuelsTertiary = $bureauIndividuels->where('prix', '>=', 10000);
        $salleConferencesTertiary = $salleConferences->where('prix', '>=', 10000);
        $espaceCoworkingsTertiary = $espaceCoworkings->where('prix', '>=', 10000);
        $espaceIndividuelsTertiary = $espaceIndividuels->where('prix', '>=', 10000);
    @endphp
    <div id="primary-content">
        <section id="agents-bureau-individuel" class="agents section">
    
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Bureaux Individuels</h2>
              <p>Découvrer nos différentes catégories de salles à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                <div class="row gy-3">
                    @forelse ($bureauIndividuels as $bureauIndividuel)
                        <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="pic">
                                    @if ($bureauIndividuel->status == 'disponible')
                                         @if ($bureauIndividuel->espaceImage->isNotEmpty())
                                            <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $bureauIndividuel->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @else
                                        @if ($bureauIndividuel->espaceImage->isNotEmpty())
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $bureauIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @endif
                                </div>
                                <div class="member-info rounded-3 p-4">
                                    <div class="row">
                                        @if ($bureauIndividuel->status == 'disponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            {{-- <a  href="#"></a> --}}
                                            <button class="col-6 btn-primary p-0" style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#154f8c'" 
                                            onmouseout="this.style.backgroundColor='#1f4b99'" 
                                            onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                            onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @elseif ($bureauIndividuel->status == 'indisponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @elseif ($bureauIndividuel->status == 'déjà loué')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @endif
                                        
                                    </div>
                                    <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($bureauIndividuel['description'], 35) }}</span>
                                     <div class="row my-1 "><span class="col-8"><h3 class="" style="text-decoration: underline">Options Supplementaires : </h3></span>
                                        @if ($bureauIndividuel->options->isEmpty())
                                            <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                        @else
                                            <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $bureauIndividuel->options->count() }}</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <span class="col-3"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $bureauIndividuel['taille'] }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $bureauIndividuel['capacite'] }}</span>
                                    </div>
                                    <div class="social">
                                    <p >Prix par jour : {{ $bureauIndividuel['prix'] }} FCFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $bureauIndividuel->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $bureauIndividuel['nom'] }}</p>
                                        </h5>
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $bureauIndividuel['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $bureauIndividuel->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $bureauIndividuel['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $bureauIndividuel['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $bureauIndividuel['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $bureauIndividuel->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($bureauIndividuel->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($bureauIndividuel->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                        <p style="color: #ef4444" > Pas de bureaux individuels actuellement</p>
                    @endforelse
                </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-salle-conference" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Salles de Conférences</h2>
              <p>Découvrer nos différentes catégories de salles de conférences à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($salleConferences as $salleConference)
                            <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member rounded-3 p-4">
                                    <div class="pic">
                                        @if ($salleConference->status == 'disponible')
                                         @if ($salleConference->espaceImage->isNotEmpty())
                                            <a href="{{ url('reservationPages/index', $salleConference['id']) }}" style="color: white">
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $salleConference->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @else
                                        @if ($salleConference->espaceImage->isNotEmpty())
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $salleConference->espaceImage->first()->image) }}" alt="Image espace" />
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @endif
                                    </div>
                                    <div class="member-info ">
                                        <div class="row">
                                            @if ($salleConference->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $salleConference['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $salleConference['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($salleConference->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $salleConference['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($salleConference->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $salleConference['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($salleConference['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 class="" style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($salleConference->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $salleConference->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $salleConference['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $salleConference['capacite'] }}</span>
                                        </div>
                                        <div class="social">
                                        <p>Prix par jour : {{ $salleConference['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $salleConference->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $salleConference['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $salleConference['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $salleConference->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $salleConference['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $salleConference['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $salleConference['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $salleConference->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($salleConference->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($salleConference->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas de Salles de Conférences actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-espace-coworking" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Espaces de Co-Working</h2>
              <p>Découvrer nos différentes catégories de salles de co-working à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($espaceCoworkings as $espaceCoworking)
                            <div class="col-lg-4 col-md-6 " style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="pic">
                                        @if ($espaceCoworking->status == 'disponible')
                                            @if ($espaceCoworking->espaceImage->isNotEmpty())
                                                <a href="{{ url('reservationPages/index', $espaceCoworking['id']) }}" style="color: white">
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceCoworking->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @else
                                            @if ($espaceCoworking->espaceImage->isNotEmpty())
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceCoworking->espaceImage->first()->image) }}" alt="Image espace" />
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="member-info p-4 rounded-3">
                                        <div class="row">
                                            @if ($espaceCoworking->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceCoworking['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceCoworking->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceCoworking->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3> {{ \Illuminate\Support\Str::limit($espaceCoworking['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($espaceCoworking->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $espaceCoworking->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $espaceCoworking['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $espaceCoworking['capacite'] }}</span>
                                        </div>
        
                                        <div class="social">
                                        <p>Prix par jour : {{ $espaceCoworking['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $espaceCoworking->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $espaceCoworking['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $espaceCoworking['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $espaceCoworking->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $espaceCoworking['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $espaceCoworking['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $espaceCoworking['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $espaceCoworking->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($espaceCoworking->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($espaceCoworking->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas d'espaces de Co-Working actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-espace-individuel" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Espaces de Co-Working VIP</h2>
              <p>Découvrer nos différentes catégories d'espaces de Co-Working VIP à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($espaceIndividuels as $espaceIndividuel)
                            <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="pic">
                                        @if ($espaceIndividuel->status == 'disponible')
                                            @if ($espaceIndividuel->espaceImage->isNotEmpty())
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceIndividuel->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @else
                                            @if ($espaceIndividuel->espaceImage->isNotEmpty())
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="member-info p-4 rounded-3">
                                        <div class="row">
                                            @if ($espaceIndividuel->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceIndividuel->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceIndividuel->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($espaceIndividuel['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($espaceIndividuel->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $espaceIndividuel->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $espaceIndividuel['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $espaceIndividuel['capacite'] }}</span>
                                        </div>
        
                                        <div class="social">
                                        <p>Prix par jour : {{ $espaceIndividuel['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $espaceIndividuel->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $espaceIndividuel['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $espaceIndividuel['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $espaceIndividuel->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $espaceIndividuel['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $espaceIndividuel['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $espaceIndividuel['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $espaceIndividuel->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($espaceIndividuel->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($espaceIndividuel->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas d'espaces de Co-Working VIP actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
    </div>
    <div id="secondary-content" style="display: none;">
        <section id="agents-bureau-individuel" class="agents section">
    
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Bureaux Individuels</h2>
              <p>Découvrer nos différentes catégories de salles à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                <div class="row gy-5">
                    @forelse ($bureauIndividuelsSecondary as $bureauIndividuel)
                        <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="pic">
                                    @if ($bureauIndividuel->status == 'disponible')
                                         @if ($bureauIndividuel->espaceImage->isNotEmpty())
                                            <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $bureauIndividuel->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @else
                                        @if ($bureauIndividuel->espaceImage->isNotEmpty())
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $bureauIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @endif
                                </div>
                                <div class="member-info rounded-3 p-4">
                                    <div class="row">
                                        @if ($bureauIndividuel->status == 'disponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            {{-- <a  href="#"></a> --}}
                                            <button class="col-6 btn-primary p-0" style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#154f8c'" 
                                            onmouseout="this.style.backgroundColor='#1f4b99'" 
                                            onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                            onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @elseif ($bureauIndividuel->status == 'indisponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @elseif ($bureauIndividuel->status == 'déjà loué')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @endif
                                        
                                    </div>
                                    <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($bureauIndividuel['description'], 35) }}</span>
                                     <div class="row my-1 "><span class="col-8"><h3 class="" style="text-decoration: underline">Options Supplementaires : </h3></span>
                                        @if ($bureauIndividuel->options->isEmpty())
                                            <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                        @else
                                            <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $bureauIndividuel->options->count() }}</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <span class="col-3"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $bureauIndividuel['taille'] }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $bureauIndividuel['capacite'] }}</span>
                                    </div>
                                    <div class="social">
                                    <p >Prix par jour : {{ $bureauIndividuel['prix'] }} FCFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $bureauIndividuel->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $bureauIndividuel['nom'] }}</p>
                                        </h5>
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $bureauIndividuel['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $bureauIndividuel->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $bureauIndividuel['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $bureauIndividuel['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $bureauIndividuel['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $bureauIndividuel->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($bureauIndividuel->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($bureauIndividuel->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                        <p style="color: #ef4444" > Pas de bureaux individuels actuellement</p>
                    @endforelse
                </div>
        
                </div>
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-salle-conference" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Salles de Conférences</h2>
              <p>Découvrer nos différentes catégories de salles de conférences à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($salleConferencesSecondary as $salleConference)
                            <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member rounded-3 p-4">
                                    <div class="pic">
                                        @if ($salleConference->status == 'disponible')
                                         @if ($salleConference->espaceImage->isNotEmpty())
                                            <a href="{{ url('reservationPages/index', $salleConference['id']) }}" style="color: white">
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $salleConference->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @else
                                        @if ($salleConference->espaceImage->isNotEmpty())
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $salleConference->espaceImage->first()->image) }}" alt="Image espace" />
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @endif
                                    </div>
                                    <div class="member-info ">
                                        <div class="row">
                                            @if ($salleConference->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $salleConference['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $salleConference['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($salleConference->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $salleConference['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($salleConference->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $salleConference['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($salleConference['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 class="" style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($salleConference->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $salleConference->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $salleConference['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $salleConference['capacite'] }}</span>
                                        </div>
                                        <div class="social">
                                        <p>Prix par jour : {{ $salleConference['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $salleConference->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $salleConference['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $salleConference['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $salleConference->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $salleConference['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $salleConference['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $salleConference['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $salleConference->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($salleConference->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($salleConference->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas de Salles de Conférences actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-espace-coworking" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Espaces de Co-Working</h2>
              <p>Découvrer nos différentes catégories de salles de co-working à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($espaceCoworkingsSecondary as $espaceCoworking)
                            <div class="col-lg-4 col-md-6 " style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="pic">
                                        @if ($espaceCoworking->status == 'disponible')
                                            @if ($espaceCoworking->espaceImage->isNotEmpty())
                                                <a href="{{ url('reservationPages/index', $espaceCoworking['id']) }}" style="color: white">
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceCoworking->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @else
                                            @if ($espaceCoworking->espaceImage->isNotEmpty())
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceCoworking->espaceImage->first()->image) }}" alt="Image espace" />
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="member-info p-4 rounded-3">
                                        <div class="row">
                                            @if ($espaceCoworking->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceCoworking['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceCoworking->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceCoworking->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3> {{ \Illuminate\Support\Str::limit($espaceCoworking['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($espaceCoworking->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $espaceCoworking->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $espaceCoworking['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $espaceCoworking['capacite'] }}</span>
                                        </div>
        
                                        <div class="social">
                                        <p>Prix par jour : {{ $espaceCoworking['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $espaceCoworking->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $espaceCoworking['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $espaceCoworking['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $espaceCoworking->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $espaceCoworking['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $espaceCoworking['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $espaceCoworking['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $espaceCoworking->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($espaceCoworking->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($espaceCoworking->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas d'espaces de Co-Working actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-espace-individuel" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Espaces de Co-Working VIP</h2>
              <p>Découvrer nos différentes catégories d'espaces de Co-Working VIP à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($espaceIndividuelsSecondary as $espaceIndividuel)
                            <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="pic">
                                        @if ($espaceIndividuel->status == 'disponible')
                                            @if ($espaceIndividuel->espaceImage->isNotEmpty())
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceIndividuel->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @else
                                            @if ($espaceIndividuel->espaceImage->isNotEmpty())
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="member-info p-4 rounded-3">
                                        <div class="row">
                                            @if ($espaceIndividuel->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceIndividuel->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceIndividuel->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($espaceIndividuel['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($espaceIndividuel->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $espaceIndividuel->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $espaceIndividuel['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $espaceIndividuel['capacite'] }}</span>
                                        </div>
        
                                        <div class="social">
                                        <p>Prix par jour : {{ $espaceIndividuel['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $espaceIndividuel->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $espaceIndividuel['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $espaceIndividuel['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $espaceIndividuel->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $espaceIndividuel['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $espaceIndividuel['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $espaceIndividuel['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $espaceIndividuel->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($espaceIndividuel->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($espaceIndividuel->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas d'espaces de Co-Working VIP actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
    </div>
    <div id="tertiary-content" style="display: none;">
        <section id="agents-bureau-individuel" class="agents section">
    
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Bureaux Individuels</h2>
              <p>Découvrer nos différentes catégories de salles à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                <div class="row gy-5">
                    @forelse ($bureauIndividuelsTertiary as $bureauIndividuel)
                        <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="pic">
                                    @if ($bureauIndividuel->status == 'disponible')
                                         @if ($bureauIndividuel->espaceImage->isNotEmpty())
                                            <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $bureauIndividuel->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @else
                                        @if ($bureauIndividuel->espaceImage->isNotEmpty())
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $bureauIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @endif
                                </div>
                                <div class="member-info rounded-3 p-4">
                                    <div class="row">
                                        @if ($bureauIndividuel->status == 'disponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            {{-- <a  href="#"></a> --}}
                                            <button class="col-6 btn-primary p-0" style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#154f8c'" 
                                            onmouseout="this.style.backgroundColor='#1f4b99'" 
                                            onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                            onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @elseif ($bureauIndividuel->status == 'indisponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @elseif ($bureauIndividuel->status == 'déjà loué')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $bureauIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                        @endif
                                        
                                    </div>
                                    <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($bureauIndividuel['description'], 35) }}</span>
                                     <div class="row my-1 "><span class="col-8"><h3 class="" style="text-decoration: underline">Options Supplementaires : </h3></span>
                                        @if ($bureauIndividuel->options->isEmpty())
                                            <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                        @else
                                            <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $bureauIndividuel->options->count() }}</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <span class="col-3"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $bureauIndividuel['taille'] }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $bureauIndividuel['capacite'] }}</span>
                                    </div>
                                    <div class="social">
                                    <p >Prix par jour : {{ $bureauIndividuel['prix'] }} FCFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $bureauIndividuel->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $bureauIndividuel['nom'] }}</p>
                                        </h5>
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $bureauIndividuel['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $bureauIndividuel->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $bureauIndividuel['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $bureauIndividuel['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $bureauIndividuel['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $bureauIndividuel->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($bureauIndividuel->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($bureauIndividuel->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                        <p style="color: #ef4444" > Pas de bureaux individuels actuellement</p>
                    @endforelse
                </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-salle-conference" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Salles de Conférences</h2>
              <p>Découvrer nos différentes catégories de salles de conférences à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($salleConferencesTertiary as $salleConference)
                            <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member rounded-3 p-4">
                                    <div class="pic">
                                        @if ($salleConference->status == 'disponible')
                                         @if ($salleConference->espaceImage->isNotEmpty())
                                            <a href="{{ url('reservationPages/index', $salleConference['id']) }}" style="color: white">
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $salleConference->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @else
                                        @if ($salleConference->espaceImage->isNotEmpty())
                                            <img class="img-fluid rounded-3" src="{{ asset('storage/' . $salleConference->espaceImage->first()->image) }}" alt="Image espace" />
                                        @else
                                            <p style="color: #ef4444">pas d'image </p>
                                        @endif
                                    @endif
                                    </div>
                                    <div class="member-info ">
                                        <div class="row">
                                            @if ($salleConference->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $salleConference['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $salleConference['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($salleConference->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $salleConference['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($salleConference->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $salleConference['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $salleConference->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($salleConference['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 class="" style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($salleConference->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $salleConference->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $salleConference['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $salleConference['capacite'] }}</span>
                                        </div>
                                        <div class="social">
                                        <p>Prix par jour : {{ $salleConference['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $salleConference->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $salleConference['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $salleConference['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $salleConference->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $salleConference['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $salleConference['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $salleConference['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $salleConference->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($salleConference->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($salleConference->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas de Salles de Conférences actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-espace-coworking" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Espaces de Co-Working</h2>
              <p>Découvrer nos différentes catégories de salles de co-working à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($espaceCoworkingsTertiary as $espaceCoworking)
                            <div class="col-lg-4 col-md-6 " style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="pic">
                                        @if ($espaceCoworking->status == 'disponible')
                                            @if ($espaceCoworking->espaceImage->isNotEmpty())
                                                <a href="{{ url('reservationPages/index', $espaceCoworking['id']) }}" style="color: white">
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceCoworking->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @else
                                            @if ($espaceCoworking->espaceImage->isNotEmpty())
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceCoworking->espaceImage->first()->image) }}" alt="Image espace" />
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="member-info p-4 rounded-3">
                                        <div class="row">
                                            @if ($espaceCoworking->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceCoworking['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceCoworking->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceCoworking->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceCoworking->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3> {{ \Illuminate\Support\Str::limit($espaceCoworking['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($espaceCoworking->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $espaceCoworking->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $espaceCoworking['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $espaceCoworking['capacite'] }}</span>
                                        </div>
        
                                        <div class="social">
                                        <p>Prix par jour : {{ $espaceCoworking['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $espaceCoworking->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $espaceCoworking['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $espaceCoworking['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $espaceCoworking->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $espaceCoworking['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $espaceCoworking['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $espaceCoworking['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $espaceCoworking->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($espaceCoworking->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($espaceCoworking->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas d'espaces de Co-Working actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
        <!-- Salle Section -->
        <section id="agents-espace-individuel" class="agents section mx-2">
        
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Nos Espaces de Co-Working VIP</h2>
              <p>Découvrer nos différentes catégories d'espaces de Co-Working VIP à location...</p>
            </div><!-- End Section Title -->
    
              <!-- Real Estate Section -->
                <div class="container">
        
                    <div class="row gy-5">
                        @forelse ($espaceIndividuelsTertiary as $espaceIndividuel)
                            <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="pic">
                                        @if ($espaceIndividuel->status == 'disponible')
                                            @if ($espaceIndividuel->espaceImage->isNotEmpty())
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceIndividuel->espaceImage->first()->image) }}" alt="Image espace" /></a>
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @else
                                            @if ($espaceIndividuel->espaceImage->isNotEmpty())
                                                <img class="img-fluid rounded-3" src="{{ asset('storage/' . $espaceIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                            @else
                                                <p style="color: #ef4444">pas d'image </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="member-info p-4 rounded-3">
                                        <div class="row">
                                            @if ($espaceIndividuel->status == 'disponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                {{-- <a  href="#"></a> --}}
                                                <button class="col-6 " style=" height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceIndividuel->status == 'indisponible')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @elseif ($espaceIndividuel->status == 'déjà loué')
                                                <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#allImagesModal{{ $espaceIndividuel->id }}" style="color: #fc9250; font-weight: 600;">Voir plus </a>
                                            @endif
                                        </div>
                                        <span><h3 style="text-decoration: underline"> Description : </h3>{{ \Illuminate\Support\Str::limit($espaceIndividuel['description'], 35) }}</span>
                                        <div class="row my-1 "><span class="col-8"><h3 style="text-decoration: underline">Options Supplementaires : </h3></span>
                                            @if ($espaceIndividuel->options->isEmpty())
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">pas d'option supplementaire</span>
                                            @else
                                                <span class="col-4" style="color: #ef4444;font-weight: 600;">{{ $espaceIndividuel->options->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Taille : </h3></span><span class="col-6 p-0">{{ $espaceIndividuel['taille'] }}</span>
                                        </div>
                                        <div class="row">
                                            <span class="col-4"><h3 style="text-decoration: underline"> Capacité : </h3></span><span class="col-6 p-0" style="color: #ef4444">{{ $espaceIndividuel['capacite'] }}</span>
                                        </div>
        
                                        <div class="social">
                                        <p>Prix par jour : {{ $espaceIndividuel['prix'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modale pour afficher toutes les images -->
                          <div class="modal fade" id="allImagesModal{{ $espaceIndividuel->id }}" tabindex="-1" aria-labelledby="allImagesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="allImagesModalLabel" style="font-weight: 600; font-size: 1.3rem;">
                                            <p> {{ $espaceIndividuel['nom'] }}</p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Afficher toutes les images en utilisant la grille Bootstrap -->
                                        <div class="row">
                                            <div class="col-6">
                                            {{-- <p> ID : {{ $bureauIndividuel['id'] }}</p> --}}
                                            
                                            <p> <span style="font-weight: 600;">Description</span> : {{ $espaceIndividuel['description'] }}</p>
                                            <p> <span style="font-weight: 600;">Status</span> : {{ $espaceIndividuel->status }}</p>
                                            <p> <span style="font-weight: 600;">Prix</span> : {{ $espaceIndividuel['prix'] }} Fcfa</p>
                                            <p> <span style="font-weight: 600;">Taille</span> : {{ $espaceIndividuel['taille'] }} </p>
                                            <p> <span style="font-weight: 600;">Capacité</span> : {{ $espaceIndividuel['capacite'] }} </p>
                                            </div>
                                            <div class="col-6">
                                            <p> <span style="font-weight: 600;">Options Supplementaires</span> : 
                                                @forelse ( $espaceIndividuel->options as $option)
                                                    <h6>{{ $option['materiel'] }} - </h6>
                                                @empty
                                                    <h6 style="color: #ef4444">pas d'option supplementaire</h6>
                                                @endforelse
                                            </p>
                                            @if ($espaceIndividuel->status == 'disponible')
                                                 <button class="col-6 btn btn-primary mt-2" style="height:35px; background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#154f8c'" 
                                                onmouseout="this.style.backgroundColor='#1f4b99'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                                <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                            @endif
                                            </div>
                                            <p> Images :</p>
                                            <div class="mb-4 mt-4">
                                                <div class=" row mt-4 flex flex">
                                                    @foreach ($espaceIndividuel->espaceImage as $image)
                                                        <div class=" mb-4 col-sm-12 col-md-6 flex-shrink-0 w-1/3 md:w-1/4" style="position: relative">
                                                            <!-- Image affichée -->
                                                            <img class="rounded " height="500px" width="500px" src="{{ asset('storage/' . $image->image) }}" alt="Image espace" />
                                                            
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
                            <p style="color: #ef4444" > Pas d'espaces de Co-Working VIP actuellement</p>
                        @endforelse
                    </div>
        
                </div>
    
    
        </section><!-- /Salle Section -->
    </div>

    <script>
        document.querySelector('a[href^="#"]').addEventListener("click", function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            window.scrollTo({
                top: targetElement.offsetTop - 50, // Ajoutez un léger décalage si nécessaire
                behavior: "smooth"
            });
        });

    // Récupérer l'élément select et l'élément où afficher la valeur
    const selectElement = document.getElementById('espace');
    const displayElement = document.getElementById('display-value');

    const ElementPrimary = document.getElementById('primary-content');
    const ElementSecondary = document.getElementById('secondary-content');
    const ElementTertiary = document.getElementById('tertiary-content');

    // Ajouter un événement qui s'exécute chaque fois que l'utilisateur change la sélection
    selectElement.addEventListener('change', function () {
        const selectedValue = selectElement.value;  // Récupérer la valeur sélectionnée
        const htmlContentElement = document.getElementById('html-content');

        // Afficher la valeur sélectionnée dans la page
        if (selectedValue) {
            displayElement.textContent = selectedValue;
        } else {
            displayElement.textContent = "Aucune sélection";
        }
        
        if(selectedValue === "asc"){
            ElementPrimary.style.display = 'none';
            ElementSecondary.style.display = 'none';
            ElementTertiary.style.display = 'block';
        }else if(selectedValue === "desc"){
            ElementPrimary.style.display = 'none';
            ElementSecondary.style.display = 'block';
            ElementTertiary.style.display = 'none';
        }else{
            ElementPrimary.style.display = 'block';
            ElementSecondary.style.display = 'none';
            ElementTertiary.style.display = 'none';
        }
    });
    </script>
    

</x-app-layout>