@extends('admin.layouts.app')

@section('content')
<div>
    <x-breadcrumb />

    <!-- Messages Flash -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Tableau -->
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 sm:px-6">
        <!-- Header -->
        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Gestion des Abonnements
                </h3>
                <p class="text-sm text-gray-500">Liste de tous les abonnements clients</p>
            </div>
        </div>

        <!-- Table -->
        <div class="w-full overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-y border-gray-100">
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">ID</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Client</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Forfait</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Montant</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Crédits</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">État</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Expiration</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Actions</p>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($abonnements as $abonnement)
                    <tr>
                        <!-- ID -->
                        <td class="py-3">
                            <span class="text-gray-600">#{{ $abonnement->id }}</span>
                        </td>

                        <!-- Client -->
                        <td class="py-3">
                            <div>
                                <p class="font-medium text-gray-800 text-theme-sm">
                                    {{ $abonnement->utilisateur->name ?? 'N/A' }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $abonnement->utilisateur->email ?? '' }}</p>
                            </div>
                        </td>

                        <!-- Forfait -->
                        <td class="py-3">
                            <span class="font-medium text-gray-800">{{ $abonnement->nom_forfait }}</span>
                        </td>

                        <!-- Montant -->
                        <td class="py-3">
                            <span class="font-semibold text-gray-800">{{ number_format($abonnement->montant, 0, ',', ' ') }} XOF</span>
                        </td>

                        <!-- Crédits -->
                        <td class="py-3">
                            @if($abonnement->credits >= 999)
                                <span class="text-gray-800">Illimité</span>
                            @else
                                <span class="text-gray-800">{{ $abonnement->credits }} / {{ $abonnement->credits_initiaux ?? $abonnement->credits }}</span>
                            @endif
                        </td>

                        <!-- État -->
                        <td class="py-3">
                            @if($abonnement->etat === 'actif')
                                @if($abonnement->estActif())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                        Actif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Expiré
                                    </span>
                                @endif
                            @elseif($abonnement->etat === 'en_attente')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    En attente
                                </span>
                            @elseif($abonnement->etat === 'expire')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Expiré
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Annulé
                                </span>
                            @endif
                        </td>

                        <!-- Expiration -->
                        <td class="py-3">
                            @if($abonnement->date_expiration)
                                <span class="text-gray-600">{{ $abonnement->date_expiration->format('d/m/Y') }}</span>
                                @if($abonnement->estActif())
                                    <p class="text-xs text-green-600">{{ (int) $abonnement->joursRestants() }} jours restants</p>
                                @endif
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="py-3">
                            <a href="{{ route('admin.abonnements.show', $abonnement) }}"
                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Voir
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p>Aucun abonnement pour le moment</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $abonnements->links() }}
        </div>
    </div>
</div>
@endsection
