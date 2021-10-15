@foreach($items as $item)
    <article>
        <a href="/teachers/{{ $item->slug }}">
            <img src="{{ $item->Davatar }}" alt="{{ $item->name }}">
                <h3>{{ $item->name }}</h3>
                <h4>{{ $item->slogen }}</h4>
        </a>
    </article>
@endforeach
    {{ $items->links() }}




