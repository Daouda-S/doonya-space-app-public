@section('title'){{ 'Paiement' }}@endsection
<x-app-layout>
    <div class="page-title" data-aos="fade">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                <h1 style="font-weight: 900 ; font-size:3.2em ; color:white">Paiement reussi</h1>
                <p class="mb-0">Merci pour votre paiement</p>
            </div>
          </div>
        </div>
      </div><!-- End Page Title -->

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Votre reservation est en cours de validation</h1>
            <p>Vous recevrez un message sur votre numero de telephone pour confirmer la reservation</p>
            <p>Veillez telecharger votre facture en cliquant sur le bouton ci-dessous</p>
            <a href="{{ route('payement.download', $reservation['id']) }}" class="btn btn-primary">Telecharger la facture</a>
        </div>
    </div>
</x-app-layout>