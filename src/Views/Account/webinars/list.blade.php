@extends("Themes." . $theme . ".account")

@section('title')
خدمات
@endsection

@section('breadcrumb')
<ul>
		<li><a href="{{route('admin.dashboard') }}">پیشخوان</a></li>
		<li class="active">لیست وبینار ها</li>
	</ul>

    <div class="infobar">
    </div>
@endsection

@section('main')

<h3>وبینار های ثبت نامی من</h3>




<div class="container-fluid" style="margin: 10px 0">

<div class="table-bar clearfix">
<div class="order">
							<label for="">مرتب سازی براساس</label>
							<select id="sort" name="sort" class="">
								<option value="new">تازه ترین</option>
								<option value="name">نام محصول</option>
								<option value="slug">شناسه تجاری</option>
								<option value="count"> فروش</option>
							</select>
						</div>
						<div class="order">
							<label for="">وضعیت</label>
							<select id="status" name="status" class="">
								<option value="all">همه موارد</option>
								<option value="active">فعال</option>
								<option value="deactive">غیرفعال</option>
							</select>
						</div>
						<div class="searchbar">
							<input id="search" name="search">
							<button id="searchb"><i class="icon-search"> </i></button>
						</div>


</div>

</div>
  <div class="videos-grid getlist">
	@if(!$items->isEmpty())
		@include('Webinar.Account.webinars.load')
	@endif
	</div>

			
@endsection

@section('js')
  <script src="/assets/js/vendor/select2.min.js"></script>
</script>

@endsection


