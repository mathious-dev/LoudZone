<div class="overflow-x-auto bg-white rounded-lg shadow-md mb-8">
    <table class="min-w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
            <tr>
                <th scope="col" class="px-6 py-4 font-semibold">Nom</th>
                <th scope="col" class="px-6 py-4 font-semibold">Description</th>
                <th scope="col" class="px-6 py-4 font-semibold">Date de début</th>
                <th scope="col" class="px-6 py-4 font-semibold">Date de fin</th>
                <th scope="col" class="px-6 py-4 font-semibold">Adresse</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($listEvents as $event)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <!-- Nom -->
                    <td class="px-6 py-4 font-bold text-gray-800">
                        {{ $event->label }}
                    </td>
                    
                    <!-- Description (Tronquée avec tooltip au survol) -->
                    <td class="px-6 py-4 text-gray-600 truncate max-w-xs" title="{{ $event->description }}">
                        {{ $event->description }}
                    </td>
                    
                    <!-- Dates formatées avec Carbon -->
                    <td class="px-6 py-4 text-blue-600 font-medium">
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y à H:i') }}
                    </td>
                    <td class="px-6 py-4 text-red-600 font-medium">
                        {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y à H:i') }}
                    </td>
                    
                    <!-- Adresse propre sur deux lignes -->
                    <td class="px-6 py-4">
                        @if($event->address)
                            <div class="text-gray-900 font-medium">
                                {{ $event->address->city }} ({{ $event->address->postal_code }})
                            </div>
                            <div class="text-gray-500 text-xs mt-1">
                                {{ $event->address->street ?? 'Rue non spécifiée' }}
                            </div>
                        @else
                            <span class="text-gray-400 italic text-xs">Aucune adresse</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>