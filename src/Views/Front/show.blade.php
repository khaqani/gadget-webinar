@extends("Themes." . $theme . ".layout")

@section('og')
@endsection

@section('content')
<div class="container show-webinar">

        <div class="bg-blue position-relative"></div>
        <div class="row">
            <div class="col-lg-3 pl-lg-0 pb-lg-0 pb-4">

                <div class="shadow bg-white rounded fixed-right mt-lg-0 mt-4">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-6 col-12 ">

                            <div class="fixedbottom p-lg-0 p-3">
                                <div class="row align-items-center">


                                <h4 class="organizer-title">برگزارکننده:</h4>

                                    <div class="col-lg-12 col">
                                        <div class="text-center d-lg-block d-none font-size-14 text-gray bbbx organ">
                                            <div class="side-img">
                                                <img src="https://static.eseminar.tv/public/upload/teacher/1588013658_53.jpg" alt="پروفایل">
                                            </div>
                                            <div class="side-desc">
                                                <div class="name">{{$item->creator->name}}</div>
                                                <div class="slogen">{{$item->creator->slogen}}</div>
                                            </div>
                                        </div>
                                    </div>

@if($buyuser==0)
  
    <a rel="nofollow" href="#sec2" class="btn d-block btn-primary" id="buy">
تهیه بلیت </a>

    @else
            <a class="workshop-widget-buyold">قبلا بلیت تهیه کرده اید</a>
    @endif

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" p-4 d-lg-block d-md-block d-none border-top">


                        <table class="table table-striped table-borderless"><thead><tr><th scope="col" class="es__webinarContent-meetingTitle">جلسات وبینار</th>
                        
                        <th scope="col" class="es__webinarContent-meetingDate">زمان برگزاری</th></tr></thead>
                        <tbody>
                        @foreach($item->sessions as $session)
                        <tr>
                        <td class="es__webinarContent-meetingTitle align-middle">{{$session->title}}</td>
                        <td class="es__webinarContent-meetingDate">
                        <div class="sessionShowTime">
                        <small>{{$session->date}}</small> 
                        <br> <strong>ساعت {{$session->start}} </strong> <div>↓</div> <strong>ساعت {{$session->end}}</strong></div>
                        </td></tr>
                        @endforeach
                        </tbody></table>


                            <h6 class="side-title">افراد</h6>

                                @foreach($item->teachers as $teacher)
                                    <div class="es__webinarContent-multiTeacher">
                                        <div class="es__wc-multiTeacherItem">
                                            <a href="/teachers/{{$teacher->id}}" class=""><img src="{{$teacher->Davatar}}" alt="Teacher Avatar"></a>
                                                <div class="es__wc-multiTeacherItem-content">
                                                    <a href="/teachers/{{$teacher->id}}" class="teacher-name">{{$teacher->name}}</a>
                                                    <div class="teacher-field">{{$teacher->slogen}}</div> 
                                                </div>
                                        </div>
                                    </div>
                                @endforeach


                              <h6 class="side-title">حامیان</h6>

                              @foreach($item->organizers as $organizer)
                            <div class="es__webinarContent-multiTeacher">

                                <div class="es__wc-multiTeacherItem">
                                    <a href="/organizers/{{$organizer->id}}" class=""><img src="{{$organizer->Davatar}}" alt="organizer Avatar"></a>
                                    <div class="es__wc-multiTeacherItem-content">
                                        <a href="/organizers/{{$organizer->id}}" class="teacher-name" >{{$organizer->name}}</a>
                                        <div class=""="teacher-field">{{$organizer->slogen}}</div> 
                                        </div>
                                    </div>
                                </div>
                              @endforeach


                              </div>
                              </div>

            </div>
            <div class="col-lg-9 pr-lg-5 pt-lg-0 pt-md-4">
                <div class="topheader">
                    <div class="">
                        <div class="row text-lg-right text-md-right text-center align-items-center">
                            <div class="col-lg-auto col-md-auto col-12">
                                <h1 class="text-white">{{$item->name}}</h1>
                                <h6 class="text-white-75 asdasdasd"> 
                                <div class="time"><span><i class="es__icon es__icon-calendar-solid"></i>شروع وبینار:</span>
                                         <span> {{$item->sessions[0]->date}} - ساعت {{$item->sessions[0]->start}}</span></div>


                                         






                                         <div>    <span class="d-flex align-items-center"><i class="es__icon es__icon-clock-solid"></i>
                           مدت وبینار:
                           {{$item->runtime}} دقیقه <!----> <!----></span>
</div> 
                           <div class="d-flex es__webinarTag"><div class="d-flex-align-items-center es__webinarTag-headline"><i class="es__icon es__icon-tag-solid"></i>دسته‌بندی‌ها:&nbsp;
                     </div>
                     
                     <div class="es__webinarTag-contents">
                     
                     <div>
                     
                     @foreach($item->categories as $category)
                     <a href="/webinars/categories/{{$category->slug}}">{{$category->name}}</a> <span>/&nbsp;</span> 
                     @endforeach

                     
                     </div></div></div>


                                </h6>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="text-center fixed-s mb-4 pt-lg-0" style="">
                    <ul class="row fixed-menu mb-0 px-0 pt-2 font-size-15 m-lg-0 my-tabs no-gutters list-unstyled">
                        <li class="d-block col"><a href="#sec1" class="d-block active">معرفی دوره</a></li>
                        <li class="d-block col"><a href="#sec2" class="d-block">تهیه بلیت</a></li>
                        <li class="d-block col"><a href="#sec3" class="d-block">سرفصل</a></li>
                        <li class="d-block col"><a href="#sec4" class="d-block">سوالات متداول</a></li>
                        <li class="d-block col"><a href="#sec5" class="d-block">نظرات</a></li>
                    </ul>
                </div>


                <section id="sec1">
                    <div class="mb-lg-5 mb-4">
                    <img  class="width-100" src="{{ $item->Dcover }}" alt="">

</br></br>
                        <div class="shadow bg-white p-5">
                            <h5 class="mb-3">این دوره شامل</h5>

                            {!!$item->description !!}

                            <div class="row">
                                <div class="col-lg-6 col-12 mb-1 d-block">
                                    <i class="fe fe-check"></i>

                                    با تجربه‌ما تازه‌کار بودن خود را فراموش کنید
                                </div>
                                <div class="col-lg-6 col-12 mb-1 d-block"><i class="fe fe-check "></i>

                                    در کوتاه ترین زمان ممکن یاد بگیرید

                                </div>
                                <div class="col-lg-6 col-12 mb-1 d-block"><i class="fe fe-check "></i>
                                    اول برنامه‌ریزی, بعد پلن روی کاغذ و طراحی و کدنویسی
                                </div>

                                <div class="col-lg-6 col-12 mb-1 d-block"><i class="fe fe-check "></i>

                                    HTML, CSS, Wordpress را به عمیقا درک کنید
                                </div>
                                <div class="col-lg-6 col-12 d-block"><i class="fe fe-check "></i>
                                    راحت‌تر از بقیه وارد بازار کار شویم
                                </div>
                                <div class="col-lg-6 col-12 d-block"><i class="fe fe-check "></i>
                                    زیر نظر یک حرفه‌ای تمرین کنیم
                                </div>
                            </div>

                        </div>






                    </div>


                    </section>

<section id="sec2" class=" pt-lg-5">



<div class="es-table-webinar mb-4">
  <div class="row es-table-webinar__head d-md-flex pb-2">
    <div class="d-flex align-items-center col-md-4 col-5">
      <h5 class="mb-0">
        بلیت‌های وبینار
        <span id="es__sw-softwareHelp" class="es__sw-softwareHelp"><i class="es__icon es__icon-info"></i></span> <!---->
      </h5>
    </div>
    <div class="col-2 text-center d-md-flex align-items-center d-none justify-content-center" style="white-space:nowrap;">فیلم قابل دانلود</div>
    <div class="col-2 text-center d-md-flex align-items-center justify-content-center"><span>قیمت قبلی</span></div>
    <div class="text-center es__webinarTicket-currenciesHolder col-md-4 col-5">
      <div class="es__webinarTicket-currencies">
        <!----><span class="active">تومان</span>
      </div>
    </div>
  </div>


@foreach($item->tickets as $ticket)

  <div class="row es-table-webinar__row">
    <div class="col-12 mb-0 mb-md-2 col-md-4">
      <h6 class="mb-0">{{$ticket->title}}</h6>
      <div class="pt-1"><small class="d-inline">
        فعال از
        <strong>{{$ticket->start}}</strong>
        تا
        <strong>{{$ticket->end}}</strong></small> <small class="d-md-none">― ( ویدئو {{$ticket->isvideo}} )</small>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2 text-center d-none d-md-flex align-items-center"><span class="d-flex align-items-center"><i class="es__icon es__icon-check-circle pl-1"></i> <span>دارد</span></span></div>
    <div class="col-12 col-sm-6 col-md-2 align-items-center"><span class="es-table-webinar__discount"><span></span></span></div>
    <div class="col-12 text-center col-md-4">
      <a onclick="buyticket({{$item->id}}, {{$ticket->id}})" class="es-table-webinar__buy-btn hasTolltip es__webinarBuyBtn">
        <div class="es__tolltipModule">
          فیلم ضبط شده وبینار بعد از برگزاری تا حداکثر 20 روز کاری به شما داده میشه
        </div>
        <span>{{$ticket->price}}</span>
        خرید بلیت
       </a>

    </div>
  </div>
@endforeach



</div>

                                 </section>


                <section id="sec3" class=" pt-lg-5">
                    <div class="mb-lg-5">
                        <div class="my-tab2">
                            <div class="row">
                                <div class="col">
                                    <a href="#mtc1" class="btn btn-block active-s">سرفصل دوره</a>
                                </div>
                            </div>
                        </div>
                        <div class="my-tab2-content" id="mtc1">
                            <div class="row my-5">
                                <div class="col">
                                    <div class="bg-white shadow p-4">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="my-tab3 px-lg-2 px-2 text-lg-right text-center row">
                                                @foreach($item->sections as $index => $section)
                                                    <a href="#mtc{{$index}}" class="col-lg-12 col-md col p-3 mb-4 rounded d-block activew">
                                                        <span class="small">فصل {{$index+1}}</span>
                                                        <p class="d-lg-block d-md-none d-none">{{$section->name}}</p>
                                                    </a>
                                                @endforeach
                                                </div>

                                            </div>

                                            <div class="col-lg-8">
                                                <div class="pr-lg-3">

                                                    <div class="tut-content">
                                                    @foreach($item->sections as $index => $section)
                                                        <article id="mtc{{$index}}" class="my-tab3-content" style="display: none;">
                                                        @foreach($section->chapters as $i2 => $chapter)

                                                            <h2 id="p{{$i2}}">{{$section->name}}</h2>
                                                            <h3>{{$chapter->name}}</h3>

                                                            <ul>
                                                                @foreach($chapter->subchapters as $i3 => $subchapter)
                                                                <li>{{$subchapter->name}}</li>
                                                                @endforeach
                                                            </ul>

                                                         @endforeach
                                                        </article>
                                                    @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                   
                    </div>

                </section>



                <section id="sec4">
                    <h5 class="mb-4">سوالات متداول</h5>
                    <div class="accordion" id="accordionExample">
                    @foreach($item->faqs as $index => $faq)

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapseOne">
                                        {{$faq->question}}
                                    </a>
                                </h2>
                            </div>

                            <div id="collapse{{$index}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body"> {{$faq->answer}}</div>
                            </div>
                        </div>
                    @endforeach
                </div></section>


<div class="mt-lg-5 mt-3" id="sec5">

	

	
			<div id="comments-hide">
	   <div id="comments">
            
            <h3 id="comments-title">
بازخورد و سوالات({{$item->comments->count()}} دیدگاه)			</h3> 
            
            <ol class="commentlist">
            @foreach($item->comments as $index => $comment)

    		  		<li class="comment even thread-even depth-1 parent" id="comment-2928">
				<div id="div-comment-2928" class="comment-body">
				<div class="comment-author vcard">
			<img alt="" src="http://1.gravatar.com/avatar/d9ca394b8fa2ea99f461407d73a34894?s=32&amp;d=mm&amp;r=g" srcset="http://1.gravatar.com/avatar/d9ca394b8fa2ea99f461407d73a34894?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" width="32" height="32">			<cite class="fn">رضا صبوری</cite> <span class="says">گفت:</span>		</div>
		
		<div class="comment-meta commentmetadata"><a href="http://farhadina.ir/tutorial/product/web-design/#comment-2928">
			دی ۴, ۱۳۹۶ در ۴:۵۱ ب.ظ</a>		</div>

		<p> {{$comment->text}}</p>

		<div class="reply"><a rel="nofollow" class="comment-reply-link" href="http://farhadina.ir/tutorial/product/web-design/?replytocom=2928#respond" onclick="return addComment.moveForm( &quot;div-comment-2928&quot;, &quot;2928&quot;, &quot;respond&quot;, &quot;9&quot; )" aria-label="پاسخ به رضا صبوری">پاسخ</a></div>
				</div>

		<ul class="children">
        @foreach($comment->reply as $index => $item)

		<li class="comment byuser comment-author-farhadina bypostauthor odd alt depth-2" id="comment-2929">
				<div id="div-comment-2929" class="comment-body">
				<div class="comment-author vcard">
			<img alt="" src="http://1.gravatar.com/avatar/d7d3690a182dff232ebe60616ae37ee6?s=32&amp;d=mm&amp;r=g" class="avatar avatar-32 photo" width="32" height="32">
            <cite class="fn">{{$item->user->name}}</cite>
            <span class="says">گفت:</span>		</div>
		
		<div class="comment-meta commentmetadata"><a href="http://farhadina.ir/tutorial/product/web-design/#comment-2929">
			دی ۴, ۱۳۹۶ در ۴:۵۶ ب.ظ</a>		</div>

		<p>{{$item->text}}</p>

		<div class="reply"><a rel="nofollow" class="comment-reply-link" href="http://farhadina.ir/tutorial/product/web-design/?replytocom=2929#respond" onclick="return addComment.moveForm( &quot;div-comment-2929&quot;, &quot;2929&quot;, &quot;respond&quot;, &quot;9&quot; )" aria-label="پاسخ به فرهاد کره بندی">پاسخ</a></div>
				</div>
                @endforeach

		</li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->

            @endforeach
            </ol>
            
                     
        </div></div><!-- #comments -->
    
    	<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">دیدگاهتان را بنویسید <small><a rel="nofollow" id="cancel-comment-reply-link" href="/tutorial/product/web-design/#respond" style="display:none;">لغو پاسخ</a></small></h3>
        
        @if(auth()->check())

        
        <form action="/comments" method="post" id="commentform" class="comment-form">
                <p class="comment-form-comment"><label for="comment">دیدگاه</label>
                <button class="cancel-comment-reply-link" type="button">
                انصراف از پاسخ
            </button>

                <textarea id="comment" name="text" cols="45" rows="8" maxlength="65525" required="required"></textarea></p><p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="ارسال دیدگاه"> <input type="hidden" name="comment_post_ID" value="9" id="comment_post_ID">
<input type="hidden" name="comment_parent" id="comment_parent" value="0">
<input type="hidden" name="reply_id" id="reply_id" value="">

</p></form>



@else
<p class="notify">برای ثبت نظر لطفا وارد سایت شوید</p>
@endif



			</div><!-- #respond -->
		
            </div>
        </div>
    </div>


    </div>


        
        
             
         
        


@endsection
@section('modal')

<div class="lightbox "  id="buyticket" style="display: none;">
        <div class="wrapper">
            <div class="logo">
 

             <span class="title hide"></span></div>
            <div class="content" style="">
                <header>
                    شرکت در وبینار
                <a href="#" role="button" class="btn-close"><i>✖</i></a></header>

            <div class="request-veryfy" style="display: block;">



                <form action="/buyticket" method="POST" class="form-group orginal" id="loginform">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="ticket_id" class="ticket_id">
                        <input type="hidden" name="webinar_id" class="webinar_id">

                    <button type="submit" class="submit  blue">
                        <svg class="spinner" viewBox="0 0 50 50">
                            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                        </svg>
                        <span class="text">پرداخت مستقیم</span>
                    </button>
                    <form action="/buyticket" method="POST" class="form-group orginal" id="loginform">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="ticket_id" class="ticket_id">
                        <input type="hidden" name="webinar_id" class="webinar_id">

                    <button type="submit" class="submit  blue">
                        <svg class="spinner" viewBox="0 0 50 50">
                            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                        </svg>
                        <span class="text">پرداخت از کیف پول</span>
                    </button>
                    </form>



            </div>
        </div>
    </div>
    </div>

@endsection
@section('js')


    <script src="/assets/Base/js/popper.min.js"></script>
    <script src="/assets/Base/js/bootstrap.min.js"></script>
    <script src="/assets/Plugin/slick-1.8.1/slick/slick.min.js"></script>
    <script src="/assets/Base/js/main.js"></script>

    <script src="/assets/js/custom.js"></script>
    <script src="/assets/js/vendor/stick.js"></script>

    <script type="text/javascript">

function buyticket(id,id2) {
    $(".webinar_id").val(id);
    $(".ticket_id").val(id2);
    hadibox("buyticket");
}
        $(function () {
            $(".fixed-s").stick_in_parent({offset_top: 0});
            $(".fixed-right").stick_in_parent({offset_top: 0});
        });
    </script>
    

@endsection