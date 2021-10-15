
                    @foreach($items as $item)
                    <article>
                    <a href="/webinars/{{ $item->slug }}">
        <div class="image">
        <img src="{{ $item->Dcover }}" alt="{{ $item->name }}">
            <div class="time">18 اسفند 99 - ساعت 22:00</div>
            <div class="type"> 28,000 تومان</div>
        </div>
        </a>
        <div class="details">
            <div class="title"><a href="/webinars/{{ $item->slug }}">
{{ $item->name }}        </a>
</div>
            <div class="channel">
            @foreach($item->organizers as $organizer)
              
                <div class="image"><img src="{{ $organizer->Davatar }}" alt=""></div>
                <div class="name"> <b><a href="/organizers/{{ $organizer->slug }}">{{ $organizer->name }}</a></b></div>
                @endforeach 
            </div>
            <a class="buybtn" href="#"> هنوز شروع نشده </a>
        </div>
    
</article>

    @endforeach
                {{ $items->links() }}




