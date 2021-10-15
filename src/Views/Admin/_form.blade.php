
<div id="box-add">
       <div class="modal-sandbox"></div>
       <div class="modal-content">

       <div class="clearfix">
           <h2><a class="status-title">ایجاد</a> وبینار</h2>
           <a class="close" >✖</a>
      </div>

            <div class="clearfix">
            <form id="myform" class="form-group" action="{{ route('Webinar.Admin.store') }}" method="post" enctype="multipart/form-data">

            <div class="styles__steps___3inVP tabssection">


   





<div class="stylstep styleactive"  data-section="section-1">
    <div class="stylesinner">
        <span class="icon-cart  styyle"></span>
        <h3 class="stitle   titleactive "> اطلاعات اولیه</h3>
    </div>
</div>

<div class="stylstep"  data-section="section-2">
    <div class="styleline "></div>

   <div class="stylesinner">
        <span class="icon-shipment  styyle"></span>
        <h3 class="stitle  ">افراد</h3>

    </div>
</div>

<div class="stylstep "  data-section="section-3">
    <div class="styleline "></div>
    <div class="stylesinner">

        <span class="icon-payment  styyle"></span>
        <h3 class="stitle  ">جلسات - زمان</h3>

    </div>
</div>


<div class="stylstep "  data-section="section-4">
    <div class="styleline "></div>
    <div class="stylesinner">

        <span class="icon-payment  styyle"></span>
        <h3 class="stitle  ">محتوا</h3>

    </div>
</div>


<div class="stylstep or" data-section="section-5">
    <div class="styleline "></div>
    <div class="stylesinner">
        <span class="icon-delivery  styyle"></span>
        <h3 class="stitle ">تایید نهایی </h3>
    </div>
</div>

</div>



<div id="section-1" class="section-content short-description current">



<div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
            <label for="subject">عنوان</label>
         </div>

         <div class="field expanded">
         <select name="type" class="select2">
            <option value="" disabled selected>نوع رویداد</option>
            <option value="0">عمومی</option>
            <option value="1">خصوصی</option>
         </select>
      </div>


      <div class="field expanded">
         <input id="cover" type="file" name="cover">
      </div>



      <div class="field expanded">
دسته بندی
            </div>


            <select name="status" class="select2">
               <option value="" disabled selected>دسته بندی اصلی</option>
               <option value="1">عمومی</option>
               <option value="0">خصوصی</option>
            </select>

            <select name="status" class="select2">
               <option value="" disabled selected>دسته بندی فرعی</option>
               <option value="1">عمومی</option>
               <option value="0">خصوصی</option>
            </select>

<a class="baadi" data-section="section-1"> ادامه </a>


</div>


<div id="section-2" class="section-content short-description ">


<h4 class="titlebar"> برگزار کننده <a>افزودن</a></h4>
         <div class="field expanded">
            <select class="organizers" name="organizers" multiple="multiple">
            </select>
            <label for="organizers">برگزار کننده</label>
         </div>

         <h4 class="titlebar">مدرس <a onclick="add_teacher()">افزودن</a></h4>
         <div class="field expanded">
            <select class="teachers" name="teachers" multiple="multiple">
            </select>
            <label for="teachers">انتخاب مدرس</label>
         </div>


</div>

<div id="section-3" class="section-content short-description ">


<h4 class="titlebar">جلسات </h4>

<div class="field expanded">
   <div id="section">

   <div class="field expanded">
      <input class="form-control"  id="jalasename" type="text" name="titlesession" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
      <label for="subject">عنوان</label>
   </div>


<div class="field expanded">
<input class="form-control"  type="text" id="jalasedate" name="date" placeholder="روز / ماه / سال" value="">
<label for="subject">تاریخ</label>
</div>

<div class="field expanded">
<label for="subject">زمان</label>
<input type="hidden" id="jalasestart" name="time" value="">
<input type="hidden" id="jalaseend" name="time" value="">
</div>


<div class="timepicker">
<div class="timepicker__result">
<span class="timepicker__result-time">18:00</span>
<div class="timepicker__result-icon">
<i class="fa fa-clock-o" aria-hidden="true"></i>
</div>
</div>
<div class="timepicker__times">
@php 
$array = array('08', '09', '10',"11","12","14","15","16","17","18","19");
@endphp

@foreach($array as $index)
<div class="timepicker__time">
   <div class="timepicker__time-hour">
   <span>{{$index}}:</span>
   </div>
   <div class="timepicker__time-minutes">
   <span class="timepicker__time-minute">00</span>
   <span class="timepicker__time-minute">15</span>
   <span class="timepicker__time-minute">30</span>
   <span class="timepicker__time-minute">45</span>
   </div>
</div>
@endforeach

</div>
</div>

<div class="timepicker">
<div class="timepicker__result2">
<span class="timepicker__result-time2">18:00</span>
<div class="timepicker__result-icon2">
<i class="fa fa-clock-o" aria-hidden="true"></i>
</div>
</div>
<div class="timepicker__times2">
@php 
$array = array('08', '09', '10',"11","12","14","15","16","17","18","19");
@endphp

@foreach($array as $index)
<div class="timepicker__time2">
   <div class="timepicker__time-hour2">
   <span>{{$index}}:</span>
   </div>
   <div class="timepicker__time-minutes2">
   <span class="timepicker__time-minute2">00</span>
   <span class="timepicker__time-minute2">15</span>
   <span class="timepicker__time-minute2">30</span>
   <span class="timepicker__time-minute2">45</span>
   </div>
</div>
@endforeach

</div>
</div>

<a onclick="storesection()" class="">افزودن</a> 
<button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
<button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>
</div>


<div id="resultsjalase"></div>

<table>
<tr><td></td><td></td> <td></td></tr>
</table>


       </div>

       </div>

<div id="section-4" class="section-content short-description ">




<div class="webinar-two">

<ul class="tabs">
<li class="tab-link current" data-tab="tab-1"> معرفی </li>
<li class="tab-link" data-tab="tab-2">سرفصل</li>
<li class="tab-link" data-tab="tab-3">بلیت</li>
<li class="tab-link" data-tab="tab-4">سوالات متداول</li>

</ul>


<div id="tab-1" class="tab-content short-description current">

<div class="field expanded">
      <textarea id="description" name="description" rows="5" class="form-control ckeditor"  placeholder="توضیحات"></textarea>
      <label for="receiver_id">توضیحات</label>
   </div>
 <div class="field expanded">
      <select class="tags" name="tags[]" multiple="multiple">
      </select>
         <label for="receiver_id">برچسب ها</label>
      </div>





      </div>

 <div id="tab-2" class="tab-content">
 <form action="" id="myform" class="sendAds clearfix"  method="post" enctype="multipart/form-data">
 <p class="item clearfix">
      <label for="question">عنوان بخش </label>
      <input id="form_question" name="question" class="width100 input-gray" type="text" value=""/>
      <span id="error_question" class="error clearfix"> </span>
  </p>

 <button id="button_add" type="submit" class="btn-green btn-right" name="submit" >افزودن</button> 
  <button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
  <button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>

  عنوان زیر بخش
  <p class="item clearfix">
      <label for="question">عنوان زیر بخش </label>
      <input id="form_question" name="question" class="width100 input-gray" type="text" value=""/>
      <span id="error_question" class="error clearfix"> </span>
  </p>

  <p class="item clearfix">
      <label for="question">عنوان زیر بخش </label>
      <input id="form_question" name="question" class="width100 input-gray" type="text" value=""/>
      <span id="error_question" class="error clearfix"> </span>
  </p>
آیتم
 <button id="button_add" type="submit" class="btn-green btn-right" name="submit" >افزودن</button> 
  <button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
  <button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>




 </form>


</div>


<div id="tab-3" class="tab-content">
    
    
<form action="" id="myform" class="sendAds clearfix"  method="post" enctype="multipart/form-data">

  <p class="item clearfix">
      <label for="question">عنوان </label>
      <input id="form_question" name="question" class="width100 input-gray" type="text" value=""/>
      <span id="error_question" class="error clearfix"> </span>
  </p>

  <p class="item clearfix">
      <label for="answer">تعداد </label>
      <textarea id="form_answer" name="answer" class="width100 input-gray" type="text" value="" /></textarea>
      <span class="clearfix"></span>
  </p>

  <p class="item clearfix">
      <label for="answer">قیمت </label>
      <textarea id="form_answer" name="answer" class="width100 input-gray" type="text" value="" /></textarea>
      <span class="clearfix"></span>
  </p>


  <button id="button_add" type="submit" class="btn-green btn-right" name="submit" >افزودن</button> 
  <button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
  <button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>
  </form>


</div>

<div id="tab-4" class="tab-content">
    
    
<form action="" id="myform" class="sendAds clearfix"  method="post" enctype="multipart/form-data">

  <p class="item clearfix">
      <label for="question">سوال </label>
      <input id="form_question" name="question" class="width100 input-gray" type="text" value=""/>
      <span id="error_question" class="error clearfix"> </span>
  </p>

  <p class="item clearfix">
      <label for="answer">پاسخ </label>
      <textarea id="form_answer" name="answer" class="width100 input-gray" type="text" value="" /></textarea>
      <span class="clearfix"></span>
  </p>

  <button id="button_add" type="submit" class="btn-green btn-right" name="submit" >افزودن</button> 
  <button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
  <button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>
  </form>


  <h2>لیست
      </h2>

      <div id="itemlist">
      </div>



</div>
</div>
</div>

<div id="section-5" class="section-content short-description ">
<div class="faktor">
      فاکتور
      <hr>
      مبلغ نرم افزار
      <hr>
      مالیات
      <hr>
      کل
   </div>

   <button id="submit" class="btn-submit" type="submit"> ارسال جهت تایید</button>

</div>










</div>


</form>

           </div>
       </div> 
</div>

</section>
</main>



<div id="add-teacher" class="modal-minibox">
   <h2> افزودن مدرس </h2>
<div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
            <label for="subject">عنوان</label>
         </div>

         <div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
            <label for="subject">عنوان</label>
         </div>

         <div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
            <label for="subject">عنوان</label>
         </div>
</div>

<div class="modal-minibox">
   <h2> افزودن برگزار کننده </h2>
<div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
            <label for="subject">عنوان</label>
         </div>

         <div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
            <label for="subject">عنوان</label>
         </div>

         <div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
            <label for="subject">عنوان</label>
         </div>
</div>
