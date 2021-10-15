@extends("Themes." . $theme_admin . ".layout")

@section('title')
خدمات
@endsection

@section('breadcrumb')
<ul>
		<li><a href="{{route('admin.dashboard') }}">پیشخوان</a></li>
		<li class="active">لیست اساتید </li>
	</ul>

    <div class="infobar">
        <div><small>وبینار های در حال برگذاری</small> <span>{{$countAll}}</span>  </div>
        <div><small>وبینار های برگزار شده</small> <span>{{$countActive}}</span>  </div>
        <div><small>وبینار های پیش رو</small> <span>{{$countActive}}</span>  </div>
    </div>
@endsection

@section('content')
<main class="container card">
<a class="btn-addcard" onclick="newitem()">ایجاد  استاد جدید</a>
<div class="container-fluid" style="margin-top: 10px">


<div class="table-bar">
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

  <div class="table-row header">
    <div class="column2 index">#</div>
    <div class="wrapper attributes">
      <div class="wrapper title-comment-module-reporter">
        <div class="wrapper title-comment">
          <div class="column2 title">عنوان برگه</div>
          <div class="column2 comment">شناسه</div>
        </div>
      </div>
      <div class="wrapper status-owner-severity">
        <div class="column2 severity">وضعیت</div>
      </div>
    </div>
	<div class="wrapper dates">
      <div class="column2 date">نمایش در صفحه اصلی</div>
      <div class="column2 date">ویرایش</div>
    </div>

    <div class="wrapper icons">
	<div title="Watch" class="column2 watch">
        <span class="glyphicon glyphicon-eye-open"></span>
      </div>

      <div title="Watch" class="column2 watch">
        <span class="glyphicon glyphicon-eye-open"></span>
      </div>
      <div title="Add comment" class="column2 add-comment">
        <span class="glyphicon glyphicon-comment"></span>
      </div>
    </div>
  </div>

  <div class="getlist">
	@if(!$items->isEmpty())
		@include('Webinar.Admin.teachers.load')
	@endif
	</div>

			
</main>
@endsection

@section('modal')
    @include('Webinar.Admin.teachers._form')
@endsection

@section('js')
  <script src="/assets/js/vendor/select2.min.js"></script>
  <script src="/assets/js/vendor/jquery.fileuploader.min.js"></script>
<script>   
$(document).ready(function() {
	
	// enable fileuploader plugin
	$('#avatar').fileuploader({
        captions: {
            button: function(options) {
            return 'انتخاب کاور وبینار';
        }
        }
    });
});

</script>
@endsection


