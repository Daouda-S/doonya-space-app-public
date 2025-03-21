@section('title'){{ 'Contact' }}@endsection
<x-app-layout>
    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
          <div class="heading">
            <div class="container">
              <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                  <h1 style="font-weight: 900 ; font-size:3.2em ; color:white">Contacter Nous</h1>
                  <p class="mb-0">Nous sommes là pour vous aider ! Si vous avez des questions, des préoccupations ou si vous avez besoin d’assistance, n’hésitez pas à nous contacter.</p>
              </div>
            </div>
          </div>
        </div><!-- End Page Title -->
    
        <!-- Contact Section -->
        <section id="contact" class="contact section">
    
          <div class="container" data-aos="fade-up" data-aos-delay="100">
    
            <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
              <iframe style="border:0; width: 100%; height: 270px;"  src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d5613.749884325796!2d-1.553954773990608!3d12.345538355275652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sbf!4v1741105162240!5m2!1sfr!2sbf" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Google Maps -->
    
            <div class="row gy-4">
    
              <div class="col-lg-4">
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h3>Address</h3>
                    <p>Bd Tensoba Zoobdo, Ouagadougou, Burkina Faso </p>
                  </div>
                </div><!-- End Info Item -->
    
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-telephone flex-shrink-0"></i>
                  <div>
                    <h3>Appeler nous</h3>
                    <p>+226 67400675</p>
                  </div>
                </div><!-- End Info Item -->
    
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h3>Contacter nous par email</h3>
                    <p>doonyalabs@gmail.com</p>
                  </div>
                </div><!-- End Info Item -->
    
              </div>
    
              <div class="col-lg-8">
                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                  <div class="row gy-4">
    
                    <div class="col-md-6">
                      <input type="text" name="name" class="form-control" placeholder="Nom" required="">
                    </div>
    
                    <div class="col-md-6 ">
                      <input type="email" class="form-control" name="email" placeholder="Email" required="">
                    </div>
    
                    <div class="col-md-12">
                      <input type="text" class="form-control" name="subject" placeholder="Sujet" required="">
                    </div>
    
                    <div class="col-md-12">
                      <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                    </div>
    
                    <div class="col-md-12">
                      <div class="text-center">
                        <div class="loading">Chargement</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Vous avez envoyez un message Merci beaucoup!</div>
                      </div>
                      <button class="btn" style="background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#154f8c'" 
                        onmouseout="this.style.backgroundColor='#1f4b99'" 
                        onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                        onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                        Envoyer</button>
                    </div>
    
                  </div>
                </form>
              </div><!-- End Contact Form -->
    
            </div>
    
          </div>
    
        </section><!-- /Contact Section -->
    
      </main>
    
</x-app-layout>