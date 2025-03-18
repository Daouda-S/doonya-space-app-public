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
    <section id="agents-bureau-individuel" class="agents section mx-2">
    
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Nos Bureaux Individuels</h2>
          <p>Découvrer nos différentes catégories de salles à location...</p>
        </div><!-- End Section Title -->

          <!-- Real Estate Section -->
            <div class="container">
    
            <div class="row gy-5">
                @forelse ($bureauIndividuels as $bureauIndividuel)
                    <div class="col-lg-4 col-md-6" style="margin-bottom: 100px" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="pic">
                                @if ($bureauIndividuel->espaceImage->isNotEmpty())
                                    <img class="img-fluid" src="{{ asset('storage/' . $bureauIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                @else
                                    <p style="color: #ef4444">pas d'image </p>
                                @endif
                            </div>
                            <div class="member-info">
                                <div class="row">
                                    @if ($bureauIndividuel->status == 'disponible')
                                        <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                        {{-- <a  href="#"></a> --}}
                                        <button class="col-6 " style=" background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                        onmouseover="this.style.backgroundColor='#154f8c'" 
                                        onmouseout="this.style.backgroundColor='#1f4b99'" 
                                        onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                        onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                        <a href="{{ url('reservationPages/index', $bureauIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                    @elseif ($bureauIndividuel->status == 'indisponible')
                                        <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                    @elseif ($bureauIndividuel->status == 'déjà loué')
                                        <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $bureauIndividuel['status'] }}</h4>
                                    @endif
                                    
                                </div>
                                <span><h3 style="text-decoration: underline"> Description : </h3>{{ $bureauIndividuel['description'] }}</span>
                                 <span><h3 class="mt-2" style="text-decoration: underline">Options Supplementaires : </h3>
                                <ul>
                                    @forelse ( $bureauIndividuel->options as $option)
                                        <li>{{ $option['materiel'] }}</li>
                                    @empty
                                        <li style="color: #ef4444">pas d'option supplementaire</li>
                                    @endforelse
                                </ul></span>
                                <span><h3 style="text-decoration: underline"> Taille : </h3>{{ $bureauIndividuel['taille'] }}</span>
                                <span><h3 style="text-decoration: underline"> Capacité : </h3>{{ $bureauIndividuel['capacite'] }}</span>
                                <div class="social">
                                <p>Prix par jour : {{ $bureauIndividuel['prix'] }} FCFA</p>
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
                            <div class="member">
                                <div class="pic">
                                    @if ($salleConference->espaceImage->isNotEmpty())
                                        <img class="img-fluid" src="{{ asset('storage/' . $salleConference->espaceImage->first()->image) }}" alt="Image espace" />
                                    @else
                                        <img src="" alt="" srcset=""/>
                                        <p style="color: #ef4444">pas d'image </p>
                                    @endif
                                </div>
                                <div class="member-info">
                                    <div class="row">
                                        @if ($salleConference->status == 'disponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $salleConference['status'] }}</h4>
                                            {{-- <a  href="#"></a> --}}
                                            <button class="col-6 " style=" background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#154f8c'" 
                                            onmouseout="this.style.backgroundColor='#1f4b99'" 
                                            onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                            onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            <a href="{{ url('reservationPages/index', $salleConference['id']) }}" style="color: white">Reserver</a></button>
                                        @elseif ($salleConference->status == 'indisponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $salleConference['status'] }}</h4>
                                        @elseif ($salleConference->status == 'déjà loué')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $salleConference['status'] }}</h4>
                                        @endif
                                    </div>
                                    <span><h3 style="text-decoration: underline"> Description : </h3>{{ $salleConference['description'] }}</span>
                                     <span><h3 class="mt-2" style="text-decoration: underline">Options Supplementaires : </h3>
                                    <ul>
                                        @forelse ( $salleConference->options as $option)
                                            <li>{{ $option['materiel'] }}</li>
                                        @empty
                                            <li style="color: #ef4444">pas d'option supplementaire</li>
                                        @endforelse
                                    </ul></span>
                                    <span><h3 style="text-decoration: underline"> Taille : </h3>{{ $salleConference['taille'] }}</span>
                                    <span><h3 style="text-decoration: underline"> Capacité : </h3>{{ $salleConference['capacite'] }}</span>
    
                                    <div class="social">
                                    <p>Prix par jour : {{ $salleConference['prix'] }} FCFA</p>
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
                                    @if ($espaceCoworking->espaceImage->isNotEmpty())
                                        <img class="img-fluid" src="{{ asset('storage/' . $espaceCoworking->espaceImage->first()->image) }}" alt="Image espace" />
                                    @else
                                        <img style="margin-bottom: 100px" src="" alt="pas d'image " srcset=""/>
                                    @endif
                                </div>
                                <div class="member-info">
                                    <div class="row">
                                        @if ($espaceCoworking->status == 'disponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                            {{-- <a  href="#"></a> --}}
                                            <button class="col-6 " style=" background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#154f8c'" 
                                            onmouseout="this.style.backgroundColor='#1f4b99'" 
                                            onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                            onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            <a href="{{ url('reservationPages/index', $espaceCoworking['id']) }}" style="color: white">Reserver</a></button>
                                        @elseif ($espaceCoworking->status == 'indisponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                        @elseif ($espaceCoworking->status == 'déjà loué')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceCoworking['status'] }}</h4>
                                        @endif
                                    </div>
                                    <span><h3 style="text-decoration: underline"> Description : </h3>{{ $espaceCoworking['description'] }}</span>
                                     <span><h3 class="mt-2" style="text-decoration: underline">Options Supplementaires : </h3>
                                    <ul>
                                        @forelse ( $espaceCoworking->options as $option)
                                            <li>{{ $option['materiel'] }}</li>
                                        @empty
                                            <li style="color: #ef4444">pas d'option supplementaire</li>
                                        @endforelse
                                    </ul></span>
                                    <span><h3 style="text-decoration: underline"> Taille : </h3>{{ $espaceCoworking['taille'] }}</span>
                                    <span><h3 style="text-decoration: underline"> Capacité : </h3>{{ $espaceCoworking['capacite'] }}</span>
    
                                    <div class="social">
                                    <p>Prix par jour : {{ $espaceCoworking['prix'] }} FCFA</p>
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
                                    @if ($espaceIndividuel->espaceImage->isNotEmpty())
                                        <img class="img-fluid" src="{{ asset('storage/' . $espaceIndividuel->espaceImage->first()->image) }}" alt="Image espace" />
                                    @else
                                        <img style="margin-bottom: 100px" src="" alt="pas d'image " srcset=""/>
                                    @endif
                                </div>
                                <div class="member-info">
                                    <div class="row">
                                        @if ($espaceIndividuel->status == 'disponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#16a34a;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                            {{-- <a  href="#"></a> --}}
                                            <button class="col-6 " style=" background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#154f8c'" 
                                            onmouseout="this.style.backgroundColor='#1f4b99'" 
                                            onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                            onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            <a href="{{ url('reservationPages/index', $espaceIndividuel['id']) }}" style="color: white">Reserver</a></button>
                                        @elseif ($espaceIndividuel->status == 'indisponible')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#ef4444;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                        @elseif ($espaceIndividuel->status == 'déjà loué')
                                            <h4 class="col-6" style="text-transform: capitalize; color:#1f4b99;" >Status: {{ $espaceIndividuel['status'] }}</h4>
                                        @endif
                                    </div>
                                    <span><h3 style="text-decoration: underline"> Description : </h3>{{ $espaceIndividuel['description'] }}</span>
                                     <span><h3 class="mt-2" style="text-decoration: underline">Options Supplementaires : </h3>
                                    <ul>
                                        @forelse ( $espaceIndividuel->options as $option)
                                            <li>{{ $option['materiel'] }}</li>
                                        @empty
                                            <li style="color: #ef4444">pas d'option supplementaire</li>
                                        @endforelse
                                    </ul></span>
                                    <span><h3 style="text-decoration: underline"> Taille : </h3>{{ $espaceIndividuel['taille'] }}</span>
                                    <span><h3 style="text-decoration: underline"> Capacité : </h3>{{ $espaceIndividuel['capacite'] }}</span>
    
                                    <div class="social">
                                    <p>Prix par jour : {{ $espaceIndividuel['prix'] }} FCFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="color: #ef4444" > Pas d'espaces coworking vip actuellement</p>
                    @endforelse
                </div>
    
            </div>


    </section><!-- /Salle Section -->
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
        
    </script>
    

</x-app-layout>