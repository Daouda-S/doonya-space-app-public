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
          @if (Session()->has('error'))

        <div style=" margin:2px; position: relative; display: grid; align-items: center; font-family: 'Sans-serif'; font-weight: bold; text-transform: uppercase; white-space: nowrap; user-select: none; background-color: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.375rem; opacity: 1;">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden relative flex justify-center items-center shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-6 p-6 text-gray-900">
                    <!-- Left Column: Text -->
                        <div class="">
                                <h1 class="mb-4 text-danger" style=" font-size: 2rem ; font-weight: 600">Veillez remplir suivre les instructions</h1>
                                
                                <form action="{{ route('payement.validate',$reservation->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="espace" value="{{ $reservation->espace_id }}">
                                    <input type="hidden" name="user" value="{{ $reservation->user_id }}">
                                    <input type="hidden" name="dateDebut" value="{{ $reservation->dateDebut }}">    
                                    <input type="hidden" name="dateFin" value="{{ $reservation->dateFin }}">
                                    <input type="hidden" name="prix" value="{{ $reservation->prix }}">
                                    <input type="hidden" name="status" value="En cours de validation">
                                    <!-- Name Field -->
                                    <h3 class=" mb-3">Saisissez ce code sur votre compte mobile</h3>
                                    <div class="mb-2 row">
                                        <img class="col-6 p-0" src="{{ asset('images/orange.jpg') }}" alt="Image" style="width: 150px; height: 100px;">
                                        <p class="mb-2 pt-5 mx-4 col-6 fs-3" >*144*2*1*67400675*{{ $reservation->prix }}#</p>
                                    </div>
                                    <div class="mb-2 row">
                                        <img class="col-6 mx-5 p-0" src="{{ asset('images/moov.png') }}" alt="Image" style="width: 100px; height: 100px;">
                                        <p class="mb-2 pt-5 col-6 fs-3" >*555*2*1*60230614*{{ $reservation->prix }}#</p>
                                    </div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-4 text-danger">apres avoir payer, remplissez le formulaire ci-dessous avec une capture de la transaction</label>
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Numero de telephone</label>
                                        <input type="number" id="phone" name="phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                                    </div>
                        
                                    <!-- Email Field -->
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Capture de la transaction</label>
                                        <input type="file" id="image" name="image" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-6">
                                        <button class=" btn" style="background-color: #1f4b99; color: white; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" 
                                            onmouseover="this.style.backgroundColor='#154f8c'" 
                                            onmouseout="this.style.backgroundColor='#1f4b99'" 
                                            onfocus="this.style.boxShadow='0 0 0 4px rgba(31, 75, 153, 0.3)'" 
                                            onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                            Valider le paiement
                                        </button>
                                    </div>
                                </form>
                        </div>
                    <!-- Right Column: Image -->
                    <div class="" style="height: 20em ; width:30rem">
                        {{-- <div class="absolute" style="right: 5em; top:13.5em ; font-size:2rem ; font-weight: 600"><h1>Veillez suivre les instructions</h1></div> --}}
                        <img src="{{ asset('images/contact.jpg') }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>