@foreach($items as $item)
    <article>
        <a href="/organizers/{{ $item->slug }}">
            <img src="{{ $item->Davatar }}" alt="{{ $item->name }}">
                <h3>{{ $item->name }}</h3>
        </a>
    </article>
@endforeach
    {{ $items->links() }}




