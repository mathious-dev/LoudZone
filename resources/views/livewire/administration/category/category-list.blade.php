<div>
    <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
    <a href="{{ route('admin.categoryForm.create') }}">Ajouter une catégorie</a>
    <table>
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
        @foreach ($listCategories as $category)
        <tr>
            <td>{{ $category->label }}</td>
            <td>{{ $category->type }}</td>
            <td> 
                <a href="{{ route('admin.categoryForm.edit',$category) }}">Modifier</a>
                <button wire:click='delete({{$category->id}})'></button>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        {{ $listCategories->links() }}
    </div>
</div>
