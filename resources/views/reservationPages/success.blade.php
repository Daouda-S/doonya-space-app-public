@section('title'){{ 'Paiement' }}@endsection
<x-app-layout>
    <div class="page-title" data-aos="fade">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                <h1 style="font-weight: 900 ; font-size:3.2em ; color:white">Requete en cours de validation</h1>
                <p class="mb-0">Merci pour votre confiance, dès qu'on validation votre Paiement, la reservation sera faites et vous aller recevoir un message sur votre numero de telephone</p>
            </div>
          </div>
        </div>
      </div><!-- End Page Title -->

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <a href="{{ route('payement.download', $reservation['id']) }}" class="btn btn-primary" style="background-color: #1f4b99;">Cliquer pour telecharger la facture</a>
        </div>
    </div>
</x-app-layout>