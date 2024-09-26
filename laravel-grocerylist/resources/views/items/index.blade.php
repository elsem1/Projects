@extends('layouts.app')
    <h1>Items</h1>
@section('title', 'Items')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Categorie</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>


@foreach($items as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->category->name }}</td>
        <td>
            <button><a href="{{ route('items.edit', $item->id) }}">Bewerken</a></button>
        </td>
        <td>
            <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Verwijderen</button>
            </form>
        </td>
    </tr>
@endforeach
@endsection

</tbody>
</table>