@extends("Themes." . $theme_admin . ".layout")

@section('title')
خدمات
@endsection

@section('breadcrumb')
<ul>
		<li><a href="{{route('admin.dashboard') }}">پیشخوان</a></li>
		<li class="active">لیست وبینار ها</li>
	</ul>

    <div class="infobar">
        <div><small>وبینار های در حال برگذاری</small> <span>{{$countAll}}</span>  </div>
        <div><small>وبینار های برگزار شده</small> <span>{{$countActive}}</span>  </div>
        <div><small>وبینار های پیش رو</small> <span>{{$countActive}}</span>  </div>
    </div>
@endsection

@section('content')
<main class="container card">
<a class="btn-addcard" onclick="newitem()">ایجاد وبینار جدید</a>
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
		@include('Webinar.Admin.load')
	@endif
	</div>

			
</main>
@endsection

@section('modal')
    @include('Webinar.Admin._form')
@endsection

@section('js')
  <script src="/assets/js/vendor/select2.min.js"></script>
  <script src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
  <script src="/assets/js/vendor/jquery.fileuploader.min.js"></script>
<script>   



$('.stylstep, .baadi').click(function(){
		var tab_id = $(this).attr('data-section');

		$('.stylstep').removeClass('current');
		$('.section-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
    })


    CKEDITOR.replace('description', {
      // Define the toolbar groups as it is a more accessible solution.
      toolbarGroups: [
        { name: 'clipboard', groups: [ 'undo', 'clipboard' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }      ],
      removeButtons: 'Save,NewPage,ExportPdf,Preview,Print,Templates,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Checkbox,About,ShowBlocks,Maximize,Language'
    });
    
$.ajax({
                url: '/admin/blog/posts/getcats',
                type: 'get',
                success: function (data) {
                   $("#getcats").html(data);

                },
                error: function (xhr, status, error) {
                    toastr.error("خطا در لود دسته بندی ");
                }
            });


  $(".tags").select2({  tags: true});
  $(".organizers").select2({  tags: true});
  $(".teachers").select2({  tags: true});

$(document).ready(function() {
	
	// enable fileuploader plugin
	$('#cover').fileuploader({
        captions: {
            button: function(options) {
            return 'انتخاب کاور وبینار';
        }
        }
    });
});

</script>

<script src="/assets/js/vendor/kamadatepicker.js"></script>

<script>
    		kamaDatepicker('jalasedate', {
               placeholder: "روز / ماه / سال"
			, closeAfterSelect: true
			, nextButtonIcon: "icon-circle-right"
			, previousButtonIcon: "icon-circle-left"
			, buttonsColor: "green"
			, markToday: true
			, markHolidays: true
			, highlightSelectedDay: true
			, sync: true
			, gotoToday: true        });



        $(".timepicker__result").click(function() {
          $(".timepicker__times").slideToggle("fast");
        });

      $(".timepicker__time-minute").on("click", function() {
        var hour = $.trim($(this).parent().siblings(".timepicker__time-hour").text());
        var minute = $(this).text();
        
        $(".timepicker__result-time").text(hour + minute);
        $("#jalasestart").val(hour + minute);
        $(".timepicker__times").slideUp();
      });



      $(".timepicker__result2").click(function() {
          $(".timepicker__times2").slideToggle("fast");
        });

      $(".timepicker__time-minute2").on("click", function() {
        var hour = $.trim($(this).parent().siblings(".timepicker__time-hour2").text());
        var minute = $(this).text();
        
        $(".timepicker__result-time2").text(hour + minute);
        $("#jalaseend").val(hour + minute);
        $(".timepicker__times2").slideUp();
      });

</script>


<script id="rendered-js">
var j = 0;

function storesection() {
    var postData = $("#section").serializeArray();


    

    var item = '<div id="jalase'+j+'">';
    item += '<div class="float-right">';
    item += '<a class="section-name"> عنوان: <span>'+ $("#jalasename").val() +' </span></a>';
    item += '<a class="section-name"> تاریخ: <span>'+ $("#jalasedate").val() +' </span></a>';
    item += '<a class="section-name"> شروع: <span>'+ $("#jalasestart").val() +' </span></a>';
    item += '<a class="section-name"> پایان: <span>'+ $("#jalaseend").val() +' </span></a>';

    item += '</div>';
    item += '<a class="question1" onclick="editnode('+j+')">ویرایش </a>';
    item += '<a class="question1" onclick="removenode('+j+')">حذف </a>';

    $.each(postData, function(i, field){
        item += '<input type="hidden" name="section['+j+']['+field.name+']" value="'+field.value+'">';
    });

    $("#resultsjalase").append(item);
    $("#jalasename").val('');
    $("#jalasedate").val('');
    $("#jalasestart").val('');
    $("#jalaseend").val('');
    j++;
      toastr.success("بخش اضافه شد");
}


function removenode(j) {
   $("#jalase" + j).remove(); 
}

function editnode(j) {
   $("#jalasename").val('');
   $("#jalasedate").val('');
}

function add_teacher() {
   $("#add-teacher").toggle(); 
}


    </script>





<style>
.bd-hide {
	display: none;
}

.bd-main {
	background-color: #FFF;
	border: 1px solid #000;
	padding: 5px;
	z-index: 9999;
	width: auto !important;
	margin: 0;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.bd-calendar {
	width: 210px;
	padding: 0;
	margin: 0;
}

.bd-title {
	width: 210px;
	padding: 0;
	margin: 0;
}

.bd-calendar table {
	border: none;
	width: 210px;
}

.bd-dropdown {
	display: inline-block;
	float: right;
	width: 75px;
}

.bd-dropdown select {
	width: 100%;
	height: 30px;
	border: none;
	cursor: pointer;
}

.bd-next, .bd-prev {
	cursor: pointer;
	background-repeat: no-repeat;
	background-position: 50% 50%;
	background-color: #FFF;
	height: 30px;
	width: 30px;
	margin: 0;
	padding: 0;
	border: none;
	display: inline-block;
	float: right;
}

.bd-table thead {
	background-color: #555555;
	color: #FFF;
}

.bd-table thead tr {
	height: 30px;
	cursor: context-menu;
}

.bd-table thead tr th {
	text-align: center;
}

.bd-table tbody tr td {
	border: none;
}

.bd-empty-cell {
	width: 30px;
	height: 30px;
}

.bd-table-days button {
	width: 30px;
	height: 30px;
	cursor: pointer;
	background-color: #F8F8F8;
	border: 0;
}

.bd-table-days button:hover {
	color: red;
	font-weight: bold;
	background-color: #E7E7E7;
}

.bd-today {
	background-color: #DFF0D8 !important;
	color: green;
}

.bd-holiday {
    background-color: #FDE8E8 !important;
}

.bd-selected-day {
	color: red;
	font-weight: bold;
}

.bd-goto-today {
	width: 210px;
	height: 30px;
	color: #FFF;
	background-color: #555555;
	padding-top: 5px;
	cursor: pointer;
	text-align: center;
}

.timepicker {
  width: 100%;
  color: #808080;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.timepicker__result,
.timepicker__result2 {
  background: #E8E8E8;
  border: solid 1px #D6D6D6;
  padding: 1em;
  font-weight: bold;
  cursor: pointer;
  position: relative;
}
.timepicker__result:after,
.timepicker__result2:after {
  content: "";
  display: table;
  clear: both;
}
.timepicker__result-time, .timepicker__result-icon,
.timepicker__result-time2, .timepicker__result-icon2  {
  float: left;
}
.timepicker__result-time,
.timepicker__result-time2 {
  width: 90%;
  border-right: solid 2px #D6D6D6;
}
.timepicker__result-icon,
.timepicker__result-icon2 {
  width: 10%;
  padding-left: 0.7em;
}
.timepicker__times,
.timepicker__times2 {
  width: 100%;
  border: solid 1px #D6D6D6;
  border-top: none;
  display: none;
  max-height: 150px;
  overflow: hidden;
  overflow-y: auto;
}
.timepicker__times::-webkit-scrollbar,
.timepicker__times2::-webkit-scrollbar {
  width: 1em;
}
.timepicker__times::-webkit-scrollbar-track,
.timepicker__times2::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
.timepicker__times::-webkit-scrollbar-thumb,
.timepicker__times2::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
.timepicker__time,
.timepicker__time2 {
  border-bottom: solid 1px #D6D6D6;
}
.timepicker__time:after,
.timepicker__time2:after {
  content: "";
  display: table;
  clear: both;
}
.timepicker__time:last-child,
.timepicker__time2:last-child {
  border: none;
}
.timepicker__time-hour, .timepicker__time-minutes,
.timepicker__time-hour2, .timepicker__time-minutes2 {
  float: left;
  cursor: pointer;
  direction:ltr
}
.timepicker__time-hour,
.timepicker__time-hour2 {
  width: 30%;
  background: #D6D6D6;
  text-align: center;
  font-weight: bold;
}
.timepicker__time-minutes,
.timepicker__time-minutes2 {
  width: 70%;
  text-align: center;
}
.timepicker__time-minute,
.timepicker__time-minute2 {
    display:inline-block;
    width: 15% !important;
    padding: 1em;
    font-weight: bold;
}



</style>
@endsection


