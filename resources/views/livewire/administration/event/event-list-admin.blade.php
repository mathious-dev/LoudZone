<div class="overflow-x-auto bg-white rounded-lg shadow-md mb-8">
    <table class="min-w-full text-left text-sm whitespace-nowrap">
        <!-- THEAD identique... -->
        <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
            <tr>
                <th scope="col" class="px-6 py-4 font-semibold">Nom</th>
                <th scope="col" class="px-6 py-4 font-semibold">Description</th>
                <th scope="col" class="px-6 py-4 font-semibold">Date de début</th>
                <th scope="col" class="px-6 py-4 font-semibold">Date de fin</th>
                <th scope="col" class="px-6 py-4 font-semibold">Adresse</th>
                <th scope="col" class="px-6 py-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($listEvents as $event)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $event->label }}</td>
                    <td class="px-6 py-4 text-gray-600 truncate max-w-xs" title="{{ $event->description }}">{{ $event->description }}</td>
                    <td class="px-6 py-4 text-blue-600 font-medium">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y à H:i') }}</td>
                    <td class="px-6 py-4 text-red-600 font-medium">{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y à H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($event->address)
                            <div class="text-gray-900 font-medium">{{ $event->address->city }} ({{ $event->address->postal_code }})</div>
                            <div class="text-gray-500 text-xs mt-1">{{ $event->address->street ?? 'Rue non spécifiée' }}</div>
                        @else
                            <span class="text-gray-400 italic text-xs">Aucune adresse</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="delete({{ $event->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette information ?" class="text-red-600 hover:text-red-900 font-semibold transition-colors">
                            Supprimer
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>