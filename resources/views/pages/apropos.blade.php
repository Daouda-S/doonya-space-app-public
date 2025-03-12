@section('title'){{ 'A propos' }}@endsection
<x-app-layout>
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
          <div class="heading">
            <div class="container">
              <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                  <h1 style="font-weight: 900 ; font-size:3.2em ; color:white">A Propos de Nous</h1>
                  <p class="mb-0">Grâce à notre système de réservation en ligne, vous pouvez facilement consulter la disponibilité des salles et réserver en quelques clics.</p>
              </div>
            </div>
          </div>
        </div><!-- End Page Title -->
    
        <!-- About Section -->
        <section id="about" class="about section">
    
          <div class="container">
    
            <div class="row gy-4">
    
              <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <p class="who-we-are">Qui sommes nous</p>
                <h3>Nous sommes une équipe passionnée par la simplification de la gestion d'espaces.</h3>
                <p class="fst-italic">
                    Notre objectif est de rendre la réservation de salles accessible, facile et rapide pour tous.Pourquoi nous choisir?
                </p>
                <ul>
                  <li><i class="bi bi-check-circle"></i> <span>Facilité d'utilisation : Un processus de réservation rapide et simple, accessible à tout moment, partout.</span></li>
                  <li><i class="bi bi-check-circle"></i> <span>Large choix de salles : Des espaces variés, adaptés à toutes les occasions, allant des petites salles de réunion aux grandes salles de conférence ou de réception.</span></li>
                  <li><i class="bi bi-check-circle"></i> <span>Transparence : Des informations complètes sur chaque salle, y compris la capacité, les équipements disponibles, les photos, et plus encore.</span></li>
                  <li><i class="bi bi-check-circle"></i> <span>Service client de qualité : Une équipe dédiée à votre écoute, prête à vous accompagner dans la réservation et la gestion de vos événements.</span></li>
                </ul>
              </div>
    
              <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">
                  <div class="col-lg-6">
                    <img src="{{ asset('images/img1.JPG') }}" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-6">
                    <div class="row gy-4">
                      <div class="col-lg-12">
                        <img src="{{ asset('images/img2.JPG') }}" class="img-fluid" alt="">
                      </div>
                      <div class="col-lg-12">
                        <img src="{{ asset('images/img3.JPG') }}" class="img-fluid" alt="">
                      </div>
                    </div>
                  </div>
                </div>
    
              </div>
    
            </div>
    
          </div>
        </section><!-- /About Section -->
    
        <!-- Stats Section -->
        <section id="stats" class="stats section">
    
          <div class="container" data-aos="fade-up" data-aos-delay="100">
    
            <div class="row gy-4">
    
              <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                  <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Nos Clients Satisfait</p>
                  </div>
                </div>
              </div><!-- End Stats Item -->
    
              <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                  <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Nos Projects</p>
                  </div>
                </div>
              </div><!-- End Stats Item -->
    
              <div class="col-lg-4 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                  <i class="bi bi-headset color-green flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Support</p>
                  </div>
                </div>
              </div><!-- End Stats Item -->
    
              {{-- <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center w-100 h-100">
                  <i class="bi bi-people color-pink flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Hard Workers</p>
                  </div>
                </div>
              </div><!-- End Stats Item --> --}}
    
            </div>
    
          </div>
    
        </section><!-- /Stats Section -->
    
        {{-- <!-- Features Section -->
        <section id="features" class="features section">
    
          <div class="container">
    
            <div class="row justify-content-around gy-4">
              <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img src="assets/img/features-bg.jpg" alt=""></div>
    
              <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
                <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi</p>
    
                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-easel flex-shrink-0"></i>
                  <div>
                    <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                    <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                  </div>
                </div><!-- End Icon Box -->
    
                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-patch-check flex-shrink-0"></i>
                  <div>
                    <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                  </div>
                </div><!-- End Icon Box -->
    
                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
                  <i class="bi bi-brightness-high flex-shrink-0"></i>
                  <div>
                    <h4><a href="" class="stretched-link">Dine Pad</a></h4>
                    <p>Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis</p>
                  </div>
                </div><!-- End Icon Box -->
    
                <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="600">
                  <i class="bi bi-brightness-high flex-shrink-0"></i>
                  <div>
                    <h4><a href="" class="stretched-link">Tride clov</a></h4>
                    <p>Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit non aspernatur odit amet. Et eligendi</p>
                  </div>
                </div><!-- End Icon Box -->
    
              </div>
            </div>
    
          </div>
    
        </section><!-- /Features Section --> --}}
    
      </main>
</x-app-layout>