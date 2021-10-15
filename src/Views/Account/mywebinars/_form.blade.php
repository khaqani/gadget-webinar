
<div id="box-add">
       <div class="modal-sandbox"></div>
       <div class="modal-content">

       <div class="clearfix">
           <h2><a class="status-title">ایجاد</a> وبینار</h2>
           <a class="close" >✖</a>
      </div>

            <div class="clearfix">
            <form id="mywebinarform" class="form-group" action="{{ route('Webinar.Account.MyWebinar.store') }}" method="post" enctype="multipart/form-data">

            <div class="styles__steps___3inVP tabssection">



<div class="stylstep styleactive tabsection-1"  data-section="section-1">
    <div class="stylesinner">
        <span class="fab fa-instagram  styyle"></span>
        <h3 class="stitle"> اطلاعات اولیه</h3>
    </div>
</div>

<div class="stylstep tabsection-2"  data-section="section-2">
    <div class="styleline "></div>

   <div class="stylesinner">
        <span class="fab fa-instagram  styyle"></span>
        <h3 class="stitle  ">افراد</h3>

    </div>
</div>

<div class="stylstep tabsection-3"  data-section="section-3">
    <div class="styleline "></div>
    <div class="stylesinner">

        <span class="fab fa-instagram  styyle"></span>
        <h3 class="stitle  ">جلسات - زمان</h3>

    </div>
</div>


<div class="stylstep tabsection-4"  data-section="section-4">
    <div class="styleline "></div>
    <div class="stylesinner">

        <span class="fab fa-instagram  styyle"></span>
        <h3 class="stitle  ">محتوا</h3>

    </div>
</div>


<div class="stylstep or tabsection-5" data-section="section-5">
    <div class="styleline "></div>
    <div class="stylesinner">
        <span class="fab fa-instagram  styyle"></span>
        <h3 class="stitle ">تایید نهایی </h3>
    </div>
</div>

</div>


<div id="section-1" class="section-content short-description current clearfix">

<div class="section-right">

         <div class="field expanded">
            <input class="form-control" id="name" type="text" required="" name="name" placeholder="عنوان وبینار را وارد نمایید" autocomplete="off">
         </div>

         <div class="create_webinar_right">
         <label for="subject">نوع رویداد</label>

            <div class="field expanded">
               <select name="type" class="select2">
                  <option value="" disabled selected>نوع رویداد</option>
                  <option value="0">عمومی</option>
                  <option value="1">خصوصی</option>
               </select>
            </div>
         </div>


         <div class="create_webinar_left">


         <label for="subject">دسته بندی</label>

            <select name="parent_id" id="parent_id">

               <option value="" disabled selected>انتخاب دسته کلی</option>

               @foreach($parentcats as $cat)
                  <option value="{{$cat->id}}">{{$cat->name}}</option>
               @endforeach
               </select>

               <select name="cat_id[]" id="cat_id" multiple class="maincategory">
               <option value="" disabled selected>انتخاب دسته بندی</option>
               @foreach($subcats as $cat)
               <option class="{{$cat->parent_id}}" value="{{$cat->id}}">{{$cat->name}}</option>
               @endforeach
               
            </select>
               </div>

  


</div>


<div class="section-left">


<div class="field expanded">
         <input id="cover" type="file" name="cover">
      </div>

</div>

   <a class="baddi" data-section="section-2">  ادامه</a>
</div>


<div id="section-2" class="section-content short-description clearfix">



   <div class="section-main-50">
      <h4 class="titlebar">انتخاب مدرس <a onclick="add_teacher()">افزودن</a></h4>
         <div class="field expanded">
            <select class="teachers" id="teachers" name="teachers[]" multiple="multiple">
               @foreach($teachers as $teacher)
               <option value="{{$teacher->id}}">{{$teacher->name}}</option>
               @endforeach
            </select>
               <a onclick="add_teacher()"  class="add_teacher">+ افزودن مدرس جدید</a>
            </div>
   </div>


   <div class="section-main-50">
      <h4 class="titlebar"> انتخاب حامیان </h4>
         <div class="field expanded">
               <select class="organizers" name="organizers[]" multiple="multiple">
                  @foreach($organizers as $organizer)
                  <option value="{{$organizer->id}}">{{$organizer->name}}</option>
                  @endforeach
               </select>
               <a onclick="add_organizer()" class="add_organizer">+ افزودن حامی جدید</a>
         </div>
   </div>



         <a class="ghabli" data-section="section-1">  قبل</a>
         <a class="baddi" data-section="section-3">  ادامه</a>
   </div>

<div id="section-3" class="section-content short-description clearfix">



<div class="field expanded">


   <div class="jalase-add">
      <div class="field expanded">
         <input class="form-control"  id="jalasename" type="text" name="titlesession" placeholder="عنوان جلسه را وارد نمایید"  />
         <label for="subject">عنوان</label>
      </div>

      <div class="field expanded">
<input class="form-control"  type="text" id="jalasedate" name="date" placeholder="روز / ماه / سال" value="">
<label for="subject">تاریخ</label>
</div>

<div class="field expanded">
<label for="subject">زمان</label>
<input type="hidden" id="jalasestart" name="time">
<input type="hidden" id="jalaseend" name="time">
</div>


<div class="timepicker">
<div class="timepicker__result">
<span class="timepicker__result-time">xx:xx</span>
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
<span class="timepicker__result-time2">xx:xx</span>
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

<a onclick="storejalase()" class="btn-storejalase">افزودن</a> 
<button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
<button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>
</div>


   </div>


   <div class="jalase-list">
   <h4 class="titlebar">لیست جلسات </h4>

      <div id="resultsjalase"></div>
   </div>



       <a class="ghabli" data-section="section-2">  قبل</a>
       <a class="baddi" data-section="section-4">  ادامه</a>

       </div>

<div id="section-4" class="section-content short-description clearfix">




<div class="webinar-two">

<ul class="tabs webinarcreate">
<li class="tab-link current" data-tab="tab-1"> معرفی </li>
<li class="tab-link" data-tab="tab-2">سرفصل</li>
<li class="tab-link" data-tab="tab-3">بلیت</li>
<li class="tab-link" data-tab="tab-4">تخفیف</li>
<li class="tab-link" data-tab="tab-5">سوالات متداول</li>

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

 <div class="create-chapter">
      <label for="chapter">فصل </label>
      <input id="chaptername" name="chaptername"  type="text" value=""/>

      <a id="button_add" onclick="storechapteritem()"  name="submit" >افزودن</a> 
  </div>


  
  <div id="resultschapters"></div>




</div>

<div id="tab-3" class="tab-content clearfix">
      <div class="ticket-side">
         <p>
            <input id="ticket_title" class="width100 input-gray" placeholder="عنوان" type="text" value=""/>
         </p>

         <div class="field expanded">
         <label for="subject">شروع بلیت فروشی</label>
            <input class="form-control"  type="text" id="ticket_start" placeholder="روز / ماه / سال" value="">
         </div>

         <div class="field expanded">
         <label for="subject">پایان بلیت فروشی</label>
            <input class="form-control"  type="text" id="ticket_end"  placeholder="روز / ماه / سال" value="">
         </div>

         <div class="field expanded">
         <select name="ticket_isvideo"  id="ticket_isvideo" class="select2">
            <option value="" disabled selected>دارای ویدئوی ضبظ</option>
            <option value="1">بله</option>
            <option value="0">خیر</option>
         </select>
      </div>

         <p>
            <input id="ticket_count" class="width100 input-gray" type="text" placeholder="تعداد" value=""/>
         </p>
         <p>
            <input id="ticket_price" class="width100 input-gray" type="text" placeholder="قیمت" value=""/>
         </p>
         <a onclick="storeticketitem()" class="btn-ticket">افزودن</a> 
         <button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
         <button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>

      </div>
      <div class="ticket-main">
         <h4> لیست بلیت ها</h4>
         <div id="resultstickets"></div>
      </div>
</div>

<div id="tab-4" class="tab-content clearfix">
      <div class="ticket-side">
      <select name="discount_ticket" id="discount_ticket">
            <option value="" disabled selected>تمامی بلیت ها</option>
         </select>

         <p>
            <input id="discount_code" class="width100 input-gray" placeholder="کد تخفیف" type="text" value=""/>
         </p>

         <select name="discount_type"  id="discount_type" class="select2">
            <option value="" disabled selected>نوع</option>
            <option value="1">تخفیف درصدی </option>
            <option value="0">تخفیف مبلغی</option>
         </select>

         <div class="field expanded">
            <input class="form-control"  type="number" id="discount_value" placeholder="میزان تخفیف" value="">
         </div>

         <div class="field expanded">
            <input class="form-control"  type="number" id="discount_count"  placeholder="ظرفیت" value="">
         </div>

         <div class="field expanded">
      </div>

      <div class="field expanded">
            <input class="form-control"  type="text" id="discount_start" placeholder="تاریخ شروع" value="">
         </div>

         <div class="field expanded">
            <input class="form-control"  type="text" id="discount_end"  placeholder="تاریخ پایان" value="">
         </div>
         <a onclick="storediscountitem()" class="btndiscount">افزودن</a> 
         <button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
         <button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>

      </div>
      <div class="ticket-main">
         <h4> لیست تخفیف ها</h4>
         <div id="resultsdiscounts"></div>
      </div>
</div>

<div id="tab-5" class="tab-content clearfix">
   <div class="faq-boxadd">
      <p class="item clearfix">
            <input id="faqquestion" name="faqquestion" class="width100 input-gray" type="text" placeholder="سوال" value=""/>
      </p>
      <p class="item clearfix">
            <textarea id="faqanswer" name="faqanswer" class="width100 input-gray" type="text" placeholder="پاسخ"  value=""></textarea>
      </p>
      <a onclick="storefaqitem()" class="">افزودن</a> 
  <button id="button_edit" type="submit" class="btn-green btn-right" name="submit"  style="display:none;">ویرایش</button> 
  <button id="button_cancel" onclick="resetform()" type="button" class="btn-gray btn-right" name="submit"  style="display:none;"> صرف نظر</button>

  </div>
  <div class="faq-main">

  <h4>سوالات</h4>
      <div id="resultsfaqs"></div>
      </div>
</div>
</div>

<a class="ghabli" data-section="section-3">  قبل</a>
<a class="baddi" data-section="section-5">  ادامه</a>

</div>

<div id="section-5" class="section-content short-description ">
<div class="faktor">
<h4><span>پیش فاکتور</span></h4>

<table>
<tr>
   <td>مدت زمان وبینار:</td>
   <td><div class="pricemin"> </div> </td>
</tr>

<tr>
   <td>مبلغ نرم افزار</td>
   <td><div class="pricesoft"> </div> </td>
</tr>

<tr>
   <td>مالیات</td>
   <td><div class="pricetax"> </div> </td>
</tr>


<tr>
   <td>کل</td>
   <td><div class="pricetotal"> </div> </td>
</tr>


</table>
    
   </div>

   <button id="mywebinar_apply" class="btn-final" type="submit"> ثبت درخواست</button>
   <a class="ghabli" data-section="section-4">  قبل</a>
</div>
</div>


</form>

           </div>
       </div> 
</div>
</section>
</main>

      <div id="add_teacher" class="modal-minibox">
         <h2> افزودن مدرس </h2>
         <a class="close" >✖</a>

         <form>

         <div class="field expanded">
            <label for="subject">نام</label>
            <input class="form-control"  id="add_teacher_name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
         </div>

         <div class="field expanded">
            <label for="subject">معرفی کوتاه</label>
            <input class="form-control"  id="add_teacher_name" type="text" required="" name="slogen" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
         </div>

         <div class="field expanded">
            <label for="subject">شماره تماس</label>
            <input class="form-control"type="text" required="" name="tel" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
         </div>
         <button id="btn_add_teacher" class="btn-final" type="submit"> افزودن</button>
         </form>
      </div>

      <div id="add_organizer" class="modal-minibox">
         <h2> افزودن برگزار کننده </h2>
         <a class="close" >✖</a>

         <form>

         <div class="field expanded">
            <label for="subject">نام</label>
            <input class="form-control" type="text" id="add_organizer_name" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
         </div>

         <div class="field expanded">
            <label for="subject">معرفی کوتاه</label>
            <input class="form-control"  id="add_organizer_slogen" type="text" required="" name="slogen" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
         </div>

         <div class="field expanded">
            <label for="subject">شماره تماس</label>
            <input class="form-control"type="text" required="" name="tel" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
         </div>
         <button id="btn_add_organizer" class="btn-final" type="submit"> افزودن</button>
         </form>

      </div>