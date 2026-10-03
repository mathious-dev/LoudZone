<div>
    <table>
        <tr>
            <td><th>Nom</th></td>
            <td><th>Prénom</th></td>
            <td><th>Email</th></td>
            <td><th>NewsLetter</th></td>
        </tr>
        @foreach ($listUsers as $user)
        <tr>
             <td>{{ $user->name }}</td>
             <td>{{ $user->first_name }}</td>
             <td>{{ $user->email }}</td>
             <td>{{ $user->news_letter }}</td>
        </tr>
        @endforeach
    </table>
</div>
