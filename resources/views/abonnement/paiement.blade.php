@extends('client.layouts.app')

@section('title', 'Paiement - ' . $forfait->nom)

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Finaliser votre paiement</h1>
            <p class="text-gray-600 mt-2">Forfait {{ $forfait->nom }}</p>
        </div>

        <!-- Récapitulatif -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-sky-600 to-sky-700 px-6 py-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold">{{ $forfait->nom }}</h2>
                        <p class="text-sky-100">{{ $forfait->description ?? 'Forfait pressing' }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold">{{ number_format($forfait->montant, 0, ',', ' ') }}</div>
                        <div class="text-sky-100">XOF</div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Votre forfait inclut :</h3>
                <ul class="space-y-3">
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <strong>{{ $forfait->credits >= 999 ? 'Lessives illimitées' : $forfait->credits . ' lessives' }}</strong>
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Durée: {{ $forfait->duree_jours }} jours
                    </li>
                    @if($forfait->caracteristiques)
                        @foreach($forfait->caracteristiques as $caracteristique)
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $caracteristique }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        <!-- Moyens de paiement -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h3 class="font-semibold text-gray-800 mb-4">Moyens de paiement acceptés</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="flex items-center gap-2 bg-yellow-50 px-4 py-2 rounded-lg">
                    <span class="font-semibold text-yellow-700">MTN MoMo</span>
                </div>
                <div class="flex items-center gap-2 bg-sky-50 px-4 py-2 rounded-lg">
                    <span class="font-semibold text-sky-700">Moov Money</span>
                </div>
                <div class="flex items-center gap-2 bg-cyan-50 px-4 py-2 rounded-lg">
                    <span class="font-semibold text-cyan-700">Wave</span>
                </div>
                <div class="flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-lg">
                    <span class="font-semibold text-gray-700">Visa / Mastercard</span>
                </div>
            </div>
        </div>

        <!-- Bouton de paiement -->
        <div class="text-center">
            <button
                id="btn-payer"
                class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-4 px-8 rounded-xl text-lg transition-colors shadow-lg hover:shadow-xl"
            >
                Payer {{ number_format($forfait->montant, 0, ',', ' ') }} XOF
            </button>

            <p class="text-gray-500 text-sm mt-4">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Paiement sécurisé par KKiaPay
            </p>

            <a href="{{ route('abonnement.index') }}" class="inline-block mt-6 text-gray-600 hover:text-gray-900 transition-colors">
                ← Retour aux forfaits
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btn-payer').addEventListener('click', function() {
        openKkiapayWidget({
            amount: {{ $forfait->montant }},
            position: "center",
            callback: "{{ route('abonnement.succes') }}",
            data: {
                abonnement_id: {{ $abonnement->id }}
            },
            theme: "#3b82f6",
            key: "{{ $clePublique }}",
            sandbox: true
        });
    });

    // Écouter le succès du paiement
    addSuccessListener(response => {
        console.log('Paiement réussi:', response);
        // Rediriger vers la page de succès avec la référence
        window.location.href = "{{ route('abonnement.succes') }}?reference=" + response.transactionId + "&abonnement_id={{ $abonnement->id }}";
    });

    // Écouter l'échec du paiement
    addFailedListener(response => {
        console.log('Paiement échoué:', response);
        alert('Le paiement a échoué. Veuillez réessayer.');
    });

    // Écouter la fermeture du widget
    addKkiapayCloseListener(() => {
        console.log('Widget fermé');
    });
</script>
@endpush
