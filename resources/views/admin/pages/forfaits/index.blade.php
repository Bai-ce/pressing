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

    <!-- Bouton Ajouter -->
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.forfaits.create') }}" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-blue-600 shadow-sm hover:bg-blue-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un forfait
        </a>
    </div>

    <!-- Tableau -->
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 sm:px-6">
        <!-- Header -->
        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Gestion des Forfaits
                </h3>
                <p class="text-sm text-gray-500">Configurez les forfaits d'abonnement disponibles pour les clients</p>
            </div>
        </div>

        <!-- Table -->
        <div class="w-full overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-y border-gray-100">
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Ordre</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Nom</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Prix</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Durée</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Crédits</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Statut</p>
                        </th>
                        <th class="py-3 text-left">
                            <p class="text-theme-xs font-medium text-gray-500">Actions</p>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($forfaits as $forfait)
                    <tr>
                        <!-- Ordre -->
                        <td class="py-3">
                            <span class="text-gray-600">{{ $forfait->ordre }}</span>
                        </td>

                        <!-- Nom -->
                        <td class="py-3">
                            <div class="flex items-center gap-2">
                                <p class="font-medium text-gray-800 text-theme-sm">
                                    {{ $forfait->nom }}
                                </p>
                                @if($forfait->est_populaire)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                        Populaire
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500">{{ $forfait->description }}</p>
                        </td>

                        <!-- Prix -->
                        <td class="py-3">
                            <span class="font-semibold text-gray-800">{{ number_format($forfait->montant, 0, ',', ' ') }} XOF</span>
                        </td>

                        <!-- Durée -->
                        <td class="py-3">
                            <span class="text-gray-600">{{ $forfait->duree_jours }} jours</span>
                        </td>

                        <!-- Crédits -->
                        <td class="py-3">
                            @if($forfait->credits >= 999)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Illimité
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $forfait->credits }} lessives
                                </span>
                            @endif
                        </td>

                        <!-- Statut -->
                        <td class="py-3">
                            @if($forfait->actif)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Actif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Inactif
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="py-3">
                            <div class="flex items-center gap-2">
                                @if(auth()->user()->role === 'ADMIN')
                                <a href="{{ route('admin.forfaits.edit', $forfait) }}" class="p-2 rounded-lg border border-gray-300 bg-white text-blue-600 hover:bg-blue-50 transition" title="Modifier">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.forfaits.destroy', $forfait) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce forfait ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg border border-gray-300 bg-white text-red-600 hover:bg-red-50 transition" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-500">
                            Aucun forfait disponible. <a href="{{ route('admin.forfaits.create') }}" class="text-blue-600 hover:underline">Créer un forfait</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
