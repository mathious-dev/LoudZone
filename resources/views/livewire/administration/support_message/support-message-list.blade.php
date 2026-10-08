<div>
    <table>
        <tr>
            <th>Date</th>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Utilisateur</th>
            <th>Catégorie</th>
            <th>état</th>
        </tr>
        @foreach ($listSupportMessages as $supportMessage)
            <tr>
                <td>{{ $supportMessage->created_at }}</td>
                <td>{{ $supportMessage->title }}</td>
                <td>{{ $supportMessage->content }}</td>
                <td>{{ $supportMessage->user->name }} {{ $supportMessage->user->first_name }}</td>
                <td>{{ $supportMessage->supportMessageCategory->label }}</td>
                <td></td>
            </tr>
        @endforeach
    </table>
</div>
