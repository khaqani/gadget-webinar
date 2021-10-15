
<div id="box-add">
       <div class="modal-sandbox"></div>
       <div class="modal-content">

       <div class="clearfix">
           <h2><a class="status-title">افزودن</a> استاد</h2>
           <a class="close" >✖</a>
      </div>

            <div class="clearfix">
            <form id="myform" class="form-group" action="{{ route('Webinar.Admin.teachers.store') }}" method="post" enctype="multipart/form-data">

            <div class="field expanded">
         <input id="avatar" type="file" name="avatar">
      </div>


            <div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
               <label for="subject">عنوان</label>
               </div>

               <div class="field expanded">
            <input class="form-control"  id="name" type="text" required="" name="name" placeholder=""  value="" onfocus="this.placeholder='عنوان مطلب را وارد نمایید'" onblur onblur="this.placeholder=''" />
               <label for="subject">شعار</label>
               </div>


      <button id="submit" class="btn-submit" type="submit"> ارسال جهت تایید</button>
</form>
           </div>
       </div> 
</div>
</section>
</main>



