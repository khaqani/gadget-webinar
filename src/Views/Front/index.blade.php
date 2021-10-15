@extends("Themes." . $theme . ".layout")

@section('og')
@endsection

@section('content')
<main id="app">

    <div class="container">
        <div class="section-top clearfix">
            <h2>کارگاه ها و رویداد های آموزشی </h2>
            <form class="searchbar" action="/searchworkshops" method="get">
                <input type="text"  name="s" placeholder="دوست داری تو کدوم کارگاه شرکت کنی" class="search-course">
                <button class="icon-search">  </button>
            </form>
        </div>

        <div class="section-main clearfix">
            <aside class="sidebar-right">
            <div class="widget">
                                <h5>مکان برگزاری:</h5>

                                <p class="item-field">
                         <select name="type" id="type" >
                        <label for="type">نوع </label>
                        <option  value="">همه</option>
                        <option  value="0">حضوری</option>
                        <option  value="1">وبینار</option>

                        </select>
                    </p>       


                         <p class="item-field">
                    <label for="answer">استان</label>
                        <select name="province_id" id="province_id" class="input-group" required="">
                            <option value=""></option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                        </select>
                </p>       
                <p class="item-field">
                    <label for="answer">شهر</label>
                        <select name="city_id" id="city_id" class="input-group" required="">
                            <option value=""></option>
                            @foreach($cities as $city)
                            <option class="{{ $city->province->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                </p>       

            </div>
                    </aside>

                    <div class="sidebar-main videos-grid  getlist">
        
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
