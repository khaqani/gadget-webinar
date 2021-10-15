@foreach($items as $index => $webinar)

  <div class="table-row header">
    <div class="column2 index">{{ ($index +1) + ($items->currentpage()-1) *$items->perpage() }}</div>
      <div class="wrapper attributes">
        <div class="wrapper title-comment-module-reporter">
          <div class="wrapper title-comment">
            <div class="column2 title">
            <a target="_blank" title="{{$webinar->name }}" href="/webinars/{{$webinar->slug}}">{{$webinar->name }} <br> <span class="slugtable"> {{ $webinar->slug}}</span> </a></div>
          </div>
        </div>
        <div class="wrapper status-owner-severity">
          <div class="column2 severity high">{{$webinar->dstatus }}



          @if($webinar->status==1)
          <a href="/account/paywebinar/{{$webinar->id}}" class="pay-btn" title="پرداخت هزینه" >پرداخت هزینه</a>
          @endif
          </div>
        </div>
      </div>
      <div class="wrapper icons">
        <div class="column2 watch"> <a class="action-button blue describe" title="View Post" href="/webinar/{{$webinar->slug}}">مشاهده</a></div>


        

        <div class="column2 add-comment"><a  onclick="edititem({{$webinar->id}})" class="action-button yellow describe" title="Edit Post" >ورود برای برگزاری </a></div>

<div class="column2 add-comment"><a  onclick="details({{$webinar->id}})" class="action-button yellow describe" title="Edit Post" >شرکت کنندگان </a></div>

        <div class="column2 add-comment"><a  onclick="edititem({{$webinar->id}})" class="action-button yellow describe" title="Edit Post" >✎ </a></div>
        <div class="column2 watch"><a  onclick="deleteitem({{$webinar->id}})" class="action-button red describe" title="Delete Post" >✖</a></div>
    </div>
  </div>

  <input type="hidden" id="currentpage" value="{{$items->currentpage()}}">
@endforeach
{{ $items->links() }}
