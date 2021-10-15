@extends("Themes." . $theme . ".layout")

@section('og')
@endsection

@section('content')
<main id="app">

    <div class="container">
        <div class="section-top clearfix">
            <h2>کارگاه ها و رویداد های آموزشی </h2>
            <form class="searchbar" action="/searchworkshops" method="get">
                <input type="text"  name="s" placeholder="دوست داری تو کدوم کارگاه شرکت کنی" class="text-center search-course">
                <button class="icon-search">  </button>
            </form>
        </div>

        <div class="section-main clearfix">
            <aside class="sidebar-right">
                <div class="widget">

                <a href="/teachers/{{ $item->slug }}">
            <img src="{{ $item->Davatar }}" alt="{{ $item->name }}">
                <h3>{{ $item->name }}</h3>
        </a>

        
                    <h5>تخصص:</h5>
            </div>
                    </aside>

                    <div class="sidebar-main webinarlist getlist">
        
                    @if(!$items->isEmpty())
                    @include('Webinar.Front.showload')
                    @endif
                    </div>
</div>
            </section>
        
            </div>

</main>



@endsection

@section('js')

 <script src="/assets/js/jquery.min.js"></script>
 <script src="/assets/js/vendor/select2.min.js"></script>
 <script src="/assets/js/freamwork.js"></script>
<script>

$('#province_id').change(function() {
    $("#city_id").val('').trigger('change')
});


$("#province_id").select2({
    placeholder: "انتخاب استان", allowClear: false,
});


$("#city_id").select2({
    placeholder: "انتخاب شهر", allowClear: false,
    matcher: function(term,  data) {
        var id = document.getElementById("province_id").value;
        var temp = data.element.classList.value;
        if(temp == id) return data; else return null;
    }
});
</script>

@endsection