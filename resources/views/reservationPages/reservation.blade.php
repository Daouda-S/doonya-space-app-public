@section('title'){{ 'Paiement' }}@endsection
<x-app-layout>
    <div class="page-title" data-aos="fade">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                <h1 style="font-weight: 900 ; font-size:3.2em ; color:white">Paiement</h1>
                <p class="mb-0">Faites votre paiement facilement.</p>
            </div>
          </div>
        </div>
      </div><!-- End Page Title -->

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden relative flex justify-center items-center shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-6 p-6 text-gray-900">
                    <!-- Left Column: Text -->
                        <div class="">
                                <h1 style=" font-size: 2.5rem ; font-weight: 600">Payer maintenant</h1>
                                
                                <form action="#" method="POST">
                                    <!-- Name Field -->
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                                        <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                                    </div>
                        
                                    <!-- Email Field -->
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                                    </div>
                        
                                    <!-- Message Field -->
                                    <div class="mb-4">
                                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                        <textarea id="message" name="message" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                                    </div>
                        
                                    <!-- Submit Button -->
                                    <div class="mt-6">
                                        <button style="padding: 12px 24px; margin-top: 20px; background-color: #3b82f6; color: white; font-weight: 600; border-radius: 8px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); cursor: pointer; transition: all 0.3s ease;" 
                                                onmouseover="this.style.backgroundColor='#2563eb'" 
                                                onmouseout="this.style.backgroundColor='#3b82f6'" 
                                                onfocus="this.style.boxShadow='0 0 0 4px rgba(59, 130, 246, 0.3)'" 
                                                onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            Envoyer
                                        </button>
                                    </div>
                                </form>
                        </div>
                    <!-- Right Column: Image -->
                    <div class="" style="height: 20em ; width:30rem">
                        <div class="absolute" style="right: 5em; top:13.5em ; font-size:2rem ; font-weight: 600"><h1>Veillez suivre les instructions</h1></div>
                        <img src="{{ asset('images/contact.jpg') }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>