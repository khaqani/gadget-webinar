@extends("Themes." . $theme_admin . ".layout")

@section('title') وبلاگ @endsection

@section('breadcrumb')
<ul>
		<li><a href="{{route('admin.dashboard') }}">پیشخوان</a></li>
		<li class="active">وبلاگ</li>
	</ul>

    <div class="infobar">
        <div><small>تعداد برگه ها</small> <span></span>  </div>
        <div><small>برگه های فعال</small> <span></span>  </div>
    </div>
@endsection

@section('content')

<div class="links">
        <a href="/admin/webinar/list">
            <div>
                <img src="/assets/images/test1.png">
                <span>وبینارها</span>
            </div>
        </a>

        <a href="/admin/webinar/teachers">
            <div>
            <img src="/assets/images/test3.png">
            <span>اساتید </span>
            </div>
        </a>

        <a href="/admin/webinar/organizers">
            <div>
            <img src="/assets/images/test4.png">
                <span>برگزارکنندگان</span>
            </div>
        </a>

        <a href="/admin/webinar/requests">
            <div>
            <img src="/assets/images/test4.png">
                <span>سرورها</span>
            </div>
        </a>
    </div>

        
    <main class="container">

    <div class="col-md-24">
        <div class="col-md-14 dash-sec">
            <h3> آخرین پست ها  <a href="/admin/orders"> مشاهده کامل </a></h3>
            <div class="content">
                <table class="tabledash">
                    <thead>
                        <tr><th scope="col"></th>
                        <th scope="col">عنوان</th>
                        <th scope="col">آخرین ویرایش</th>
                        <th scope="col">وضعیت </th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                                            </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-9 col-sm-offset-1 dash-sec">
            <h3> نظرات تایید نشده <a href="/admin/comments"> مشاهده کامل </a></h3>
            <div class="content">
                <table>
                    <thead>
                        <tr><th scope="col">نظردهنده</th>
                        <th scope="col">پست</th>
                        <th scope="col">تاریخ نشر</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col"> </th>
                    </tr></thead>
                    <tbody>

                                            </tbody>
                </table>
            </div>
        </div>
    </div>

    
    </main>
@endsection

@section('js')
@endsection

