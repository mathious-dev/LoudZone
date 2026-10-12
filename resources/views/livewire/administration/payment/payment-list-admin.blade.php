<div class="overflow-x-auto bg-white rounded-lg shadow-md mb-8">
    <x-search :options="$tabSearchPossibility"/>
    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
    <table class="min-w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
            <tr>
                <th scope="col" class="px-6 py-4 font-semibold">Commande</th>
                <th scope="col" class="px-6 py-4 font-semibold">Méthode</th>
                <th scope="col" class="px-6 py-4 font-semibold">ID Transaction</th>
                <th scope="col" class="px-6 py-4 font-semibold">État</th>
                <th scope="col" class="px-6 py-4 font-semibold text-right">Montant</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($listPayments as $payment)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $payment->order->reference }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded">
                            {{ strtoupper($payment->payment_method) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-xs font-mono">{{ $payment->transaction_id }}</td>
                    <td class="px-6 py-4">
                        @if($payment->state == 'completed' || $payment->state == 1)
                            <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Payé</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Échoué / Attente</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right font-semibold">{{ number_format($payment->amount, 2, ',', ' ') }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>