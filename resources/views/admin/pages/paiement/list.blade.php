@extends('admin.layouts.app')

@section('title', 'Paiements')

@section('content')
<x-breadcrumb />

<!-- Bouton Ajouter (optionnel si vous voulez exporter ou filtrer) -->
<div class="mb-4 flex justify-end">
    <button class="text-theme-sm shadow-theme-xs inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Exporter
    </button>
</div>

<!-- Tableau -->
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 sm:px-6">
    <!-- Header -->
    <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">
                Paiements récents
            </h3>
        </div>

        <div class="flex items-center gap-3">
            <button class="text-theme-sm shadow-theme-xs inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800">
                <svg class="fill-white stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.29004 5.90393H17.7067" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M17.7075 14.0961H2.29085" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.0826 3.33331C13.5024 3.33331 14.6534 4.48431 14.6534 5.90414C14.6534 7.32398 13.5024 8.47498 12.0826 8.47498C10.6627 8.47498 9.51172 7.32398 9.51172 5.90415C9.51172 4.48432 10.6627 3.33331 12.0826 3.33331Z" fill="" stroke="" stroke-width="1.5" />
                    <path d="M7.91745 11.525C6.49762 11.525 5.34662 12.676 5.34662 14.0959C5.34661 15.5157 6.49762 16.6667 7.91745 16.6667C9.33728 16.6667 10.4883 15.5157 10.4883 14.0959C10.4883 12.676 9.33728 11.525 7.91745 11.525Z" fill="" stroke="" stroke-width="1.5" />
                </svg>
                Filter
            </button>

            <button class="text-theme-sm shadow-theme-xs inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800">
                Voir tout
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="w-full overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-y border-gray-100">
                    <th class="py-3 text-left">
                        <p class="text-theme-xs font-medium text-gray-500">Client</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="text-theme-xs font-medium text-gray-500">Commande</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="text-theme-xs font-medium text-gray-500">Montant</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="text-theme-xs font-medium text-gray-500">Date</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="text-theme-xs font-medium text-gray-500">Actions</p>
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($paiements as $paiement)
                <tr>

                    <!-- Client + Avatar -->
                    <td class="py-3">
                        <div class="flex items-center gap-3">
                            <div class="h-[50px] w-[50px] overflow-hidden rounded-md bg-sky-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-sky-600 font-semibold text-sm">
                                    {{ $paiement->commande && $paiement->commande->user
                                        ? strtoupper(substr($paiement->commande->user->name, 0, 2))
                                        : 'AN' }}
                                </span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-theme-sm">
                                    {{ $paiement->commande->user->name ?? 'Client anonyme' }}
                                </p>
                                <p class="text-gray-500 text-theme-xs">
                                    {{ $paiement->commande->user->telephone ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <!-- Commande -->
                    <td class="py-3">
                        <a href="{{ route('commandes.show', $paiement->commande_id) }}"
                           class="text-gray-500 hover:text-gray-700 font-medium text-theme-sm">
                            {{ $paiement->commande->numSuivi ?? 'N/A' }}
                        </a>
                    </td>

                    <!-- Montant -->
                    <td class="py-3">
                        <p class="font-semibold text-gray-500 text-theme-sm">
                            {{ number_format($paiement->montant, 0, ',', ' ') }} XOF
                        </p>
                    </td>

                    <!-- Date -->
                    <td class="py-3">
                        <p class="text-gray-500 text-theme-sm">
                            {{ $paiement->datePaiement
                                ? \Carbon\Carbon::parse($paiement->datePaiement)->format('d/m/Y')
                                : $paiement->created_at->format('d/m/Y') }}
                        </p>
                        <p class="text-gray-400 text-theme-xs">
                            {{ $paiement->created_at->format('H:i') }}
                        </p>
                    </td>

                    <!-- Actions -->
                    <td class="py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('commandes.show', $paiement->commande_id) }}"
                               class="p-2 rounded-lg border border-gray-300 bg-white text-sky-600 hover:bg-sky-50 transition"
                               title="Voir la commande">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-500">
                        <p class="font-medium">Aucun paiement trouvé</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $paiements->links() }}
    </div>
</div>

@endsection
