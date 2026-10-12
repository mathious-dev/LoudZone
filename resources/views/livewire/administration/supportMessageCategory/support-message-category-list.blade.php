<div>
    <table>
        <tr>
            <th>Nom de catégorie</th>
            <th>Nombre d'infos supplémentaires associées</th>
            <th>Actions</th>
        </tr>
        @foreach ($listSupportMessageCategories as $category)
            <tr>
                <td>{{ $category->label }}</td>
                <td>{{Count($category->addInfos)  }}</td>
                <td><button wire:click='delete({{$category->id  }})' wire:confirm="Êtes-vous sûr de vouloir supprimer cette information ?">Supprimer</button></td>
            </tr>
        @endforeach
    </table>
</div>
