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

<h3>وبینار های من <a class="btn-addcard" onclick="newitem()"> + ایجاد وبینار جدید </a>
</h3>


<main class=" ">


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

  <div class="table-row header top">
    <div class="column2 index">#</div>
    <div class="wrapper attributes">
      <div class="wrapper title-comment-module-reporter">
        <div class="wrapper title-comment">
          <div class="column2 title">عنوان وبینار</div>
        </div>
      </div>
      <div class="wrapper status-owner-severity">
        <div class="column2 severity">وضعیت</div>
      </div>
    </div>
    <div class="wrapper icons">
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
    @include('Webinar.Account.mywebinars.load')
	@endif
	</div>
</main>

@endsection


@section('modal')
@include('Webinar.Account.mywebinars._show')
  @include('Webinar.Account.mywebinars._form')
@endsection


@section('js')
  <script src="/assets/js/vendor/select2.min.js"></script>
  <script src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
  <script src="/assets/js/vendor/jquery.fileuploader.min.js"></script>
<script>   
$(".select2").select2();

$('#parent_id').select2();

$("#cat_id").select2({
        placeholder: "انتخاب دسته بندی", allowClear: false,
        matcher: function(term,  data) {
            var parent_id = document.getElementById("parent_id").value;
            var temp = data.element.classList.value;
            if(temp == parent_id) return data; else return null;
          }
    });


$('#parent_id').change(function() {
        var parent_id = document.getElementById("parent_id").value;
        $("#grade_id").val('').trigger('change')
    });

$("#mywebinarform").submit(function(e) {
  e.preventDefault();
  var postData = new FormData(this);
        document.querySelectorAll('.error').forEach(e => e.remove());
        $('.invalid').removeClass("invalid");
    $.ajax({
        url: $("#mywebinarform").attr("action") ,
        type: $("#mywebinarform").attr("method") ,
        data: postData,
        success: function(data) {
                toastr.success(data.message);
        },
        error: function(e) {
            var t = e.responseJSON;
            toastr.error(t.message);
            
          //  Object.keys(t.errors).forEach(function(key) {
           //     console.log( key +"" + t.errors[key] )
           ////     $("#"+key).parent().append('<div class="error">' + t.errors[key] + "</div>")
           //     $('#'+ key).addClass("invalid");
           //   });
        },cache: false,
        contentType: false,
        processData: false
    });
});


$("#add_organizer form").submit(function(e) {
    e.preventDefault();

    var formData = new FormData(this);
        document.querySelectorAll('.error').forEach(e => e.remove());
        $('.invalid').removeClass("invalid");
        var name =  $('#add_organizer_name').val();
    $.ajax({
        url: '/account/addorganizer' ,
        type: 'post' ,
        data: formData,
        success: function(data) {
                add_organizer();
                $('.organizers').append("<option value='"+data.id+"' selected>"+name+"</option>");
                $('.organizers').trigger('change'); 

                toastr.success(data.message);
                $("#add_organizer form")[0].reset();
        },
        error: function(e) {
            var t = e.responseJSON;
            toastr.error(t.message);
            
            Object.keys(t.errors).forEach(function(key) {
                $("#"+key).parent().append('<div class="error">' + t.errors[key] + "</div>")
                $('#'+ key).addClass("invalid");
              });
        },cache: false,
        contentType: false,
        processData: false
    });
});


$("#add_teacher form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
        document.querySelectorAll('.error').forEach(e => e.remove());
        $('.invalid').removeClass("invalid");
        var name =  $('#add_teacher_name').val();
    $.ajax({
        url: '/account/addteacher' ,
        type: 'post' ,
        data: formData,
        success: function(data) {
              add_teacher();
                $('.teachers').append("<option value='"+data.id+"' selected>"+name+"</option>");
                $('.teachers').trigger('change'); 
                $("#add_teacher form")[0].reset();
                toastr.success(data.message);
        },
        error: function(e) {
            var t = e.responseJSON;
            toastr.error(t.message);
            
            Object.keys(t.errors).forEach(function(key) {
                $("#"+key).parent().append('<div class="error">' + t.errors[key] + "</div>")
                $('#'+ key).addClass("invalid");
              });
        },cache: false,
        contentType: false,
        processData: false
    });
});

$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
    })

function box_add() {
    $("#box-add").fadeToggle( "slow" );
    $("#dark-overlay").toggle();
    $("#maino").toggleClass("is-blurred");
}


function details(id) {
$.ajax({
    url: '/account/mywebinars/' +id,
        type: 'get',
        success: function (data) {
            box_detail();
            Object.keys(data).forEach(function(key) {
                if (typeof $("#item-"+key).text() !== 'undefined')
                    $("#item-"+key).text(data[key]);
              });

        },
        error: function (xhr, status, error) {
            toastr.error(data.message);
        }
    });
   
        }


        function box_detail() {
    $("#box-detail").fadeToggle( "slow" );
    $("#maino").toggleClass("is-blurred");
}

$("#box-detail .close").click(function(){
$("#box-detail").fadeToggle( "slow" );
});


$("#box-add .close").click(function(){
$("#box-add").fadeToggle( "slow" );
$("#dark-overlay").hide();
$("#maino").toggleClass("is-blurred");
});

$("#add_organizer .close").click(function(){
$("#add_organizer").fadeToggle( "slow" );
});


$("#add_teacher .close").click(function(){
$("#add_teacher").fadeToggle( "slow" );
});


function add_organizer() {
    $("#add_organizer").fadeToggle( "slow" );
}

function add_teacher() {
    $("#add_teacher").fadeToggle( "slow" );
}


url = new URL(window.location.href);
start = url.searchParams.get('param');
  if(start=="create")  newitem();

function newitem() {
        $(".status-title").text('افزودن');
         form_method = 'Post';
         form_action = $("#myform").attr("action");
              box_add();
            }

            function edititem(id) {
        $(".status-title").text('ویرایش');
         form_method = 'Post';
         form_action = $("#myform").attr("action");
              box_add();
            }




            function partiitem(id) {
              box_add();
            }


            function boxenable(digit) {
              $('.stylstep').removeClass('styleactive');
              $('.section-content').removeClass('current');
              for(i = 1; i <=digit; i++) {
                $(".tabsection-"+ i).addClass('styleactive');
              }
              $("#section-"+digit).addClass('current');
            }



            $('.invalid').removeClass("invalid");




$('.stylstep, .baddi, .ghabli').click(function(){
		var tab_id = $(this).attr('data-section');
    var digit = tab_id.match(/\d+/)[0];
    var sec1 = false;
    var sec2 = false;
    var sec3 = false;
    var sec4 = false;


          //sec 1
          if (!$('#name').val()) {
            toastr.error("لطفا عنوان وبینار را وارد کنید ");
            sec1 = false;
          }
          else {
            sec1 = true;
          }

          if (digit!=1 && digit!=2) {
            //sec 2
            if ($('#teachers').val().length == 0) {
              toastr.error("لطفا مدرسی را وارد کنید ");
              sec2 = false;
            }
            else {
              sec2 = true;
            }
          }

          if (digit!=1 && digit!=2 && digit!=3) {
          //sec 3

          if ($('.jalase').length==0) {
            toastr.error("لطفا  جلسه ای ایجاد کنید ");
            sec3 = false;
          }
          else {
            sec3 = true;
          }
        }

        if (digit!=1 && digit!=2 && digit!=3 && digit!=4) {

          //sec 4
          if (!$('#name').val()) {
            toastr.error("لطفا اطلاعات ضروری را کامل کنید ");
            sec4 = false;
          }
          else {
            sec4 = true;
          }
        }

          if(digit==1) {boxenable(1);}
          if(digit==2 && sec1) {boxenable(2);}
          if(digit==3 && sec1 && sec2) {boxenable(3);}
          if(digit==4 && sec1 && sec2 && sec3) {boxenable(4);}
          if(digit==5 && sec1 && sec2 && sec3 && sec4) {boxenable(5);price();}


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
    limit:1,
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



      kamaDatepicker('discount_start', { 
        placeholder: "روز / ماه / سال",
        closeAfterSelect: true,
        nextButtonIcon: "icon-circle-right",
        previousButtonIcon: "icon-circle-left",
        buttonsColor: "green",
        markToday: true,
        markHolidays: true,
        highlightSelectedDay: true,
        sync: true,
        gotoToday: true
        });

        kamaDatepicker('discount_end', { 
        placeholder: "روز / ماه / سال",
        closeAfterSelect: true,
        nextButtonIcon: "icon-circle-right",
        previousButtonIcon: "icon-circle-left",
        buttonsColor: "green",
        markToday: true,
        markHolidays: true,
        highlightSelectedDay: true,
        sync: true,
        gotoToday: true
        });



      kamaDatepicker('ticket_start', {
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


      kamaDatepicker('ticket_end', {
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
var jalaseindex = 0;
var faqindex = 0;
var ticketindex = 0;
var sectionindex = 0;
var subchapterindex = 0;



function storechapteritem() {
  var chapterindex = $('.chapterstyle').length;

  var item = '<div id="chapter'+chapterindex+'" class="chapterstyle clearfix">';
    $temp = $('#chaptername').val();
    item += '<a class="section-name"> عنوان فصل: <span>'+ $temp +' </span></a>';
    item += '<div class="section-btn">';
    item += '<a class="section-edit" onclick="editnodefaq('+chapterindex+')">ویرایش </a>';
    item += '<a class="section-remove" onclick="removenodefaq('+chapterindex+')">حذف </a>';
    item += '</div>';


    item += '<div class="additemchapter"><div class="addboxchapter"><label>عنوان بخش </label><input id="inputchapter'+chapterindex+'" type="text"/><a onclick="storesubchapteritem('+chapterindex+')">افزودن</a> </div><div class="result"></div></div>';


  item += '</div>';

    item += '<input type="hidden" name="sections[]" value="'+$temp+'">';

    $("#resultschapters").append(item);
    $("#chaptername").val('');
}



function storesubchapteritem(chapterindex) {

var subchapterindex = $('.subchapters'+chapterindex).length;
  var item = '<div id="subchapter'+ chapterindex+'-'+subchapterindex+'" class="subchapterstyle subchapters'+chapterindex +' clearfix">';
    $temp = $('#inputchapter'+chapterindex).val();
    console.log ("index:" + chapterindex + "index:" )
    item += '<a class="subsection-name"> عنوان بخش: <span>'+ $temp +' </span></a>';
    item += '<div class="subsection-btn">';
    item += '<a class="subsection-edit" onclick="editnodefaq('+chapterindex+')">ویرایش </a>';
    item += '<a class="subsection-remove" onclick="removenodefaq('+chapterindex+')">حذف </a>';
    item += '</div>';


    item += '<div class="createsubchapter"><label for="question">عنوان زیر بخش </label><input id="inputsubchapter'+chapterindex+'-'+subchapterindex+'" class="" type="text" value=""/><a id="button_add" onclick="storesubsubchapteritem('+chapterindex+','+subchapterindex+')"  name="submit" >افزودن</a></div><div class="resultzirbakhs"></div>';


  item += '</div>';

    item += '<input type="hidden" name="chapters['+chapterindex+'][]" value="'+$temp+'">';
    $('#chapter'+chapterindex+' .result').append(item);
}


function storesubsubchapteritem(chapterindex, subchapterindex) {

var subsubchapterindex = $('.subsubchapters'+chapterindex+'-' +subchapterindex).length;
$temp = $('#inputsubchapter'+chapterindex+'-'+subchapterindex).val();

  var item = '<div id="subchapter'+ chapterindex+'-'+subchapterindex+'-'+subsubchapterindex+'" class="subchapterstyle clearfix">';
    item += '<a class="subsubsection-name"> عنوان زیر بخش: <span>'+ $temp +' </span></a>';
    item += '<div class="subsubsection-btn">';
    item += '<a class="subsubsection-edit" onclick="editnodefaq('+chapterindex+')">ویرایش </a>';
    item += '<a class="subsubsection-remove" onclick="removenodefaq('+chapterindex+')">حذف </a>';
    item += '</div>';

  item += '</div>';

    item += '<input type="hidden" name="subchapters['+chapterindex+']['+subchapterindex+'][]" value="'+$temp+'">';
    $('#subchapter'+chapterindex+'-'+subchapterindex +' .resultzirbakhs').append(item);
}


function storeticketitem() {
  var ticket_title = $("#ticket_title").val();
  var ticket_count = $("#ticket_count").val();
  var ticket_price = $("#ticket_price").val();
  var ticket_start = $("#ticket_start").val();
  var ticket_end = $("#ticket_end").val();
  var ticket_isvideo = $("#ticket_isvideo").val();
  var ticketindex =  $('.ticketitem').length;

  var item = '<div id="ticket'+ticketindex+'" class="ticketitem">';
    item += '';
    item += '<a class="ticket-name"> عنوان: <span>'+ ticket_title +' </span></a> ';
    item += '<div class="ticket-btn"><a class="ticketedit" onclick="ticketedit('+ticketindex+')">ویرایش</a> <a class="ticketremove" onclick="ticketremove('+ticketindex+')">حذف </a></div>';
    item += '<a class="ticket-start">بلیت فروشی: <span>'+ ticket_start +' - '+  ticket_end+' </span></a>';
    item += '<a class="ticket-video">ویدئو: <span>'+ ticket_isvideo +' </span></a>';
    item += '<a class="ticket-price"> قیمت: <span>'+ ticket_price +' </span></a>';
    item += '<a class="ticket-count"> تعداد: <span>'+ ticket_count +' </span></a>';
  item += '</div>';

  item += '<input type="hidden" id="tickets'+ticketindex+'title" name="tickets['+ticketindex+'][title]" value="'+ticket_title+'">';
    item += '<input type="hidden" id="tickets'+ticketindex+'count" name="tickets['+ticketindex+'][count]" value="'+ticket_count+'">';
    item += '<input type="hidden" id="tickets'+ticketindex+'price" name="tickets['+ticketindex+'][price]" value="'+ticket_price+'">';
    item += '<input type="hidden" id="tickets'+ticketindex+'start" name="tickets['+ticketindex+'][start]" value="'+ticket_start+'">';
    item += '<input type="hidden" id="tickets'+ticketindex+'end" name="tickets['+ticketindex+'][end]" value="'+ticket_end+'">';
    item += '<input type="hidden" id="tickets'+ticketindex+'isvideo" name="tickets['+ticketindex+'][isvideo]" value="'+ticket_isvideo+'">';

    $("#resultstickets").append(item);
    $("#ticket_title").val('');
    $("#ticket_count").val('');
    $("#ticket_price").val('');
}


var discountlist = [];

function storediscountitem() {
var discount_code = $("#discount_code").val();

if(discountlist.includes(discount_code))
{
  toastr.error("کد تخفیف تکراری است");
}
else{
  discountlist.push(discount_code);


var discount_ticket = $("#discount_ticket").val();
var discount_type = $("#discount_type").val();
var discount_value = $("#discount_value").val();
var discount_count = $("#discount_count").val();
var discount_start = $("#discount_start").val();
var discount_end = $("#discount_end").val();
var discountindex =  $('.discountitem').length;

var item = '<div id="discountitem'+discountindex+'" class="discountitem discount-'+discount_ticket+'">';
  item += '<div class="float-right">';
  item += '<a class="discount-code"> کد تخفیف: <span>'+ discount_code +' </span></a>';
  item += '<a class="discount-count"> نوع: <span>'+ discount_type +' </span></a>';
  item += '<a class="discount-start"> مقدار: <span>'+ discount_value +' </span></a>';
  item += '<a class="discount-end"> تعداد: <span>'+ discount_count +' </span></a>';
  item += '<a class="discount-video"> ارائه ویدئو: <span>'+ discount_start +' - '+ discount_end +' </span></a>';
  item += '<a class="discount-end"> معتبر برای بلیط: <span>'+ discount_ticket +' </span></a>';

  item += '</div>';
  item += '<a class="discountedit" onclick="discountedit('+ticketindex+')">ویرایش </a>';
  item += '<a class="discountremove" onclick="discountremove('+ticketindex+')">حذف </a>';
item += '</div>';

item += '<input type="hidden" id="tickets'+ticketindex+'title" name="tickets['+ticketindex+'][title]" value="'+ticket_title+'">';
  item += '<input type="hidden" id="tickets'+ticketindex+'count" name="tickets['+ticketindex+'][count]" value="'+ticket_count+'">';
  item += '<input type="hidden" id="tickets'+ticketindex+'price" name="tickets['+ticketindex+'][price]" value="'+ticket_price+'">';
  item += '<input type="hidden" id="tickets'+ticketindex+'start" name="tickets['+ticketindex+'][start]" value="'+ticket_start+'">';
  item += '<input type="hidden" id="tickets'+ticketindex+'end" name="tickets['+ticketindex+'][end]" value="'+ticket_end+'">';
  item += '<input type="hidden" id="tickets'+ticketindex+'isvideo" name="tickets['+ticketindex+'][isvideo]" value="'+ticket_isvideo+'">';

  $("#resultsdiscounts").append(item);
  $("#ticket_title").val('');
  $("#ticket_count").val('');
  $("#ticket_price").val('');

  }
}

function storefaqitem() {
  var faqindex = $('.faqq').length;

  var item = '<div id="faq'+faqindex+'" class="faqq clearfix">';
  item += '<div class="content">';
    item += '<a class="faq-question"><span> سوال: </span>'+ $("#faqquestion").val() +' </a>';
    item += '<a class="faq-answer"><span> پاسخ: </span>'+ $("#faqanswer").val() +' </a>';
    item += '</div>';
    item += '<div class="faqbtn"><a class="faq-edit" onclick="editnodefaq('+faqindex+')">ویرایش </a>';
    item += '<a class="faq-remove" onclick="removenodefaq('+faqindex+')">حذف </a></div>';

  item += '</div>';

    item += '<input type="hidden" id="faqs'+faqindex+'_faqquestion" name="faqs['+jalaseindex+'][faqquestion]" value="'+$("#faqquestion").val()+'">';
    item += '<input type="hidden" id="faqs'+faqindex+'_faqanswer" name="faqs['+jalaseindex+'][faqanswer]" value="'+$("#faqanswer").val()+'">';

    $("#resultsfaqs").append(item);
    $("#faqquestion").val('');
    $("#faqanswer").val('');
}

function removenodefaq(j) {
   $("#faq" + j).remove(); 
}


function editnodefaq(j) {
   $("#faqquestion").val($("#faqs"+j+"faqquestion").val());
   $("#faqanswer").val($("#faqs"+j+"faqanswer").val());
}

function price() {
  jalasecount= $('.jalase').length;
  total = 0;
  unit = 150;

  if(jalasecount==0) {
    total = 0;

  }
  else{
    for(i=0;i<jalasecount;i++)
  {
    var start = $("#section"+i+"_jalasestart").val()
    var end = $("#section"+i+"_jalaseend").val();
    var temp = (end.split(":")[0] - start.split(":")[0]) * 60 + (end.split(":")[1] - start.split(":")[1]);;
    total += temp;
  }
  }
  $(".pricemin").text(total + "دقیقه");
  $(".pricesoft").text(total * unit + "تومان");
  $(".pricetax").text(total/100 * 9 * unit  + "تومان");
  $(".pricetotal").text(total * unit + total/100 * 9 * unit  + "تومان");

}
var jalaseindex = 0;

function storejalase() {
      e1 = ($("#jalasedate").val()=="") ? true:false;
      e2 = ($("#jalasestart").val() > $("#jalaseend").val()) ? true:false;    
      e3 = ($("#jalasestart").val()=="") ? true:false;
      e4 = ($("#jalasestart").val()=="") ? true:false;

    if (e1 || e2) {
      if(e1) toastr.error("تاریخ برگزاری را وارد کنید ");
      if(e2) toastr.error("تاریخ پایان جلسه نمی توان قبل از شروع باشد ");
    }
    else {
        jalaseindex = jalaseindex +1;

        var item = '<div id="jalase'+jalaseindex+'" class="jalase">';
        item += '<div class="jalase-right">';
        item += '<a class="jalasename"> عنوان: <span>'+ $("#jalasename").val() +' </span></a>';
        item += '</div>';
        item += '<div class="jalase-left">';
        item += '<a class="jalaseedit" onclick="editnode('+jalaseindex+')">ویرایش </a>';
        item += '<a class="jalaseremove" onclick="removenode('+jalaseindex+')">حذف </a>';
        item += '</div>';

        item += '<div class="jalase-info">';
        item += '<a class="jalasedate"> تاریخ: <span>'+ $("#jalasedate").val() +' </span></a>';
        item += '<a class="jalasestart"> شروع: <span>'+ $("#jalasestart").val() +' </span></a>';
        item += '<a class="jalaseend"> پایان: <span>'+ $("#jalaseend").val() +' </span></a>';
        item += '</div>';

        item += '<input type="hidden" id="section'+jalaseindex+'_jalasename" name="sessions[][name]" value="'+$("#jalasename").val()+'">';
        item += '<input type="hidden" id="section'+jalaseindex+'_jalasedate" name="sessions[][date]" value="'+$("#jalasedate").val()+'">';
        item += '<input type="hidden" id="section'+jalaseindex+'_jalasestart" name="sessions[][start]" value="'+$("#jalasestart").val()+'">';
        item += '<input type="hidden" id="section'+jalaseindex+'_jalaseend" name="sessions[][end]" value="'+$("#jalaseend").val()+'">';


        $("#resultsjalase").append(item);
        $("#jalasename").val('');
        $("#jalasedate").val('');
        $("#jalasestart").val('');
        $("#jalaseend").val('');
          toastr.success("بخش اضافه شد");
    }
}


function discountremove(j) {
   var code = $("#discountitem" + j + " .discount-code span").innerText; 
   discountlist.pop(code);
   $("#discountitem" + j).remove(); 
}

function removenode(j) {
   $("#jalase" + j).remove(); 
}



function editnode(j) {

   $("#jalasename").val($("#section"+j+"_jalasename").val());
   $("#jalasedate").val($("#section"+j+"jalasedate").val());
   $("#jalasestart").val($("#section"+j+"jalasestart").val());
   $("#jalaseend").val($("#section"+j+"jalaseend").val());
}



function ticketremove(j) {
  var i = j+1;
  if ($(".discount-" + i).length > 0) {
    toastr.error("ابتدا باید تخفیف مربوط  به بلیط را حذف کنید");
  }else{
    $("#ticket" + j).remove(); 
  }
}

function ticketedit(j) {
   $("#ticket_title").val($("#tickets"+j+"title").val());
   $("#ticket_start").val($("#tickets"+j+"start").val());
   $("#ticket_end").val($("#tickets"+j+"end").val());
   $("#ticket_count").val($("#tickets"+j+"count").val());
   $("#ticket_isvideo").val($("#tickets"+j+"isvideo").val());
   $("#ticket_price").val($("#tickets"+j+"price").val());
}



$('.tab-link').click(function(){
  var tab_id = $(this).attr('data-tab');
  if(tab_id=="tab-4") {
    var list = '<option value="0" selected>تمامی بلیت ها</option>';
    var listtickets = $(".ticket-name span");
    delete listtickets["length"];
    delete listtickets["prevObject"];
        for (const [key, value] of Object.entries(listtickets)) {
          var index = Number(key)+1;
      list += '<option value="'+index +'">' +`${value.innerText}`+'</option>';
    }

    $('#discount_ticket').html(list);
    }

});
    </script>

@endsection


