@section('title'){{ 'Home' }}@endsection
<x-app-layout>
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
    
          <div id="hero-carousel" class="carousel slide"  data-bs-ride="carousel" data-bs-interval="5000">
    
            <div class="carousel-item active">
              <img src={{ asset('images/bg.jpg') }}  alt="">
              <div class="carousel-container">
                <div>
                  <h2><span style="color: #fc9250 !important">L'espace de travail</span> Qu'il vous faut</h2>
                  <a href="{{ route('pages.boutique') }}" class="btn-get-started">Reserver Maintenant</a>
                </div>
              </div>
            </div><!-- End Carousel Item -->
    
            <div class="carousel-item ">
                <img src={{ asset('images/bg3.jpg') }}  alt="">
                <div class="carousel-container">
                  <div>
                    <h2><span style="color: #fc9250 !important">L'espace de travail</span> Qu'il vous faut</h2>
                    <a href="{{ route('pages.boutique') }}"  class="btn-get-started">Reserver Maintenant</a>
                  </div>
                </div>
              </div><!-- End Carousel Item -->
    
              <div class="carousel-item ">
                <img src={{ asset('images/bg2.jpg') }}  alt="">
                <div class="carousel-container">
                  <div>
                    <h2><span style="color: #fc9250 !important">L'espace de travail</span> Qu'il vous faut</h2>
                    <a href="{{ route('pages.boutique') }}"  class="btn-get-started">Reserver Maintenant</a>
                  </div>
                </div>
              </div><!-- End Carousel Item -->
    
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
    
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>
    
            <ol class="carousel-indicators"></ol>
    
          </div>
    
        </section><!-- /Hero Section -->
    
        <!-- Services Section -->
        <section id="services" class="services section">
    
          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <h2>Nos Services</h2>
            {{-- <p>Les differentes services </p> --}}
          </div><!-- End Section Title -->
    
          <div class="container">
    
            <div class="row gy-4">
    
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item  position-relative">
                  <div class="icon">
                    <i class="bi bi-house-door"></i>
                  </div>
                  <h3>Locations de Salles</h3>
                  <p>L’entreprise propose une gamme variée de salles adaptées pour vos activités. <br> Nous mettons en location des Bureaux
                     Individuels, des Salles de Conférences, des Espaces de Co-Working simple et VIP</p>
                </div>
              </div><!-- End Service Item -->
    
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-person-check"></i>
                  </div>
                  <h3>Club des entrepreneurs</h3>
                  <p>Découvrez le Club des Entrepreneurs Influents à Fort Potentiel, un espace exclusif où les leaders de demain se rencontrent
                     et collaborent pour faire prospérer leurs projets. Rejoindre notre club, c’est intégrer une communauté dynamique axée sur l'innovation, la créativité et l'ambition de transformer des idées en entreprises prospères.</p>
                </div>
              </div><!-- End Service Item -->
    
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-lightbulb"></i>
                  </div>
                  <h3>Start Up Studio</h3>
                  <p>Découvrez le service <strong>Start Up Studio</strong> qui se spécialise dans la création, le soutien et le développement de nouvelles start-ups. <br> Il vous aide a générer vos propres idées d'affaires et les transforme en start-ups tout en vous fournissant les ressources nécessaires, telles que des équipes, du financement, des conseils stratégiques et des outils opérationnels.</p>
                </div>
              </div><!-- End Service Item -->
    
            </div>
    
          </div>
    
        </section><!-- /Services Section -->
    
        <!-- Agents Section -->
        <section id="real-estate" class="real-estate section">
    
          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <h2>Nos Différentes Salles</h2>
            <p>Découvrer nos différentes catégories de salles à location...</p>
          </div><!-- End Section Title -->

            <!-- Real Estate Section -->
            <div class="container">
                <div class="row gy-4">
                  <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('pages.boutique') }}#agents-bureau-individuel">
                      <div class="card">
                          <img src="{{ asset('images/bureau3.jpg') }}" alt="" class="img-fluid">
                          <div class="card-body">
                            <span class="sale-rent">Voir Plus</span>
                            <h3> <p class="stretched-link" style="color: white ">Bureau Individuel</p></h3>
                            <div class="card-content d-flex flex-column justify-content-center text-center">
                                  <div class="row propery-info">
                                    <div class="col">Canapé</div>
                                    <div class="col">Climatisation</div>
                                    <div class="col">Wifi</div>
                                    <div class="col">Tables & chaise</div>
                                  </div>
                            </div>
                          </div>
                      </div>
                    </a>
                  </div><!-- End Property Item -->
                  <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('pages.boutique') }}#agents-salle-conference">
                      <div class="card">
                          <img src="{{ asset('images/conference.JPG') }}" alt="" class="img-fluid">
                          <div class="card-body">
                            <span class="sale-rent">Voir Plus</span>
                            <h3><p class="stretched-link" style="color: white ">Salle de Conférence</p></h3>
                            <div class="card-content d-flex flex-column justify-content-center text-center">
                                <div class="row propery-info">
                                  <div class="col">Canapé</div>
                                  <div class="col">Climatisation</div>
                                  <div class="col">Wifi</div>
                                  <div class="col">Tables & chaise</div>
                                  <div class="col">Autres options</div>
                                </div>
                            </div>
                          </div>
                      </div>
                    </a>
                  </div><!-- End Property Item -->
                  <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('pages.boutique') }}#agents-espace-coworking">
                      <div class="card">
                          <img src="{{ asset('images/coworking11.jpg') }}" alt="" class="img-fluid">
                          <div class="card-body">
                          <span class="sale-rent">Voir Plus</span>
                          <h3><p class="stretched-link" style="color: white ">Espace de Co-Working</p></h3>
                          <div class="card-content d-flex flex-column justify-content-center text-center">
                              <div class="row propery-info">
                                  <div class="col">Canapé</div>
                                  <div class="col">Climatisation</div>
                                  <div class="col">Wifi</div>
                                  <div class="col">Tables & chaise</div>
                              </div>
                          </div>
                          </div>
                      </div>
                    </a>
                  </div><!-- End Property Item -->
                  <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('pages.boutique') }}#agents-espace-individuel">
                      <div class="card">
                          <img src="{{ asset('images/individuel2.jpg') }}" alt="" class="img-fluid">
                          <div class="card-body">
                            <span class="sale-rent">Voir Plus</span>
                            <h3><p class="stretched-link">Espace de Co-Working VIP</a></h3>
                            <div class="card-content d-flex flex-column justify-content-center text-center">
                                <div class="row propery-info">
                                    {{-- <div class="col">Canapé</div> --}}
                                    <div class="col">Climatisation</div>
                                    <div class="col">Wifi</div>
                                    <div class="col">Tables & chaise</div>
                                </div>
                            </div>
                          </div>
                      </div>
                    </a>
                  </div><!-- End Property Item -->
                </div>
            </div>

        </section><!-- /Agents Section -->
    
        <!-- Stats Section -->
        <section id="stats" class="stats section ">
    
          <div class="container py-5" data-aos="fade-up" data-aos-delay="100">
            <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <h2>Nos Statistiques</h2>
          </div><!-- End Section Title -->
    
            <div class="row gy-4">
    
              <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                  <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="87" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Nos Clients Satisfait</p>
                  </div>
                </div>
              </div><!-- End Stats Item -->
    
              <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                  <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Nos Projects</p>
                  </div>
                </div>
              </div><!-- End Stats Item -->
    
              <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                  <i class="bi bi-headset color-green flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Support sur 24h</p>
                  </div>
                </div>
              </div><!-- End Stats Item -->
            </div>
          </div>
        </section><!-- /Stats Section -->
    </main>
</x-app-layout>
