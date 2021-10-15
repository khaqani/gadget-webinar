@foreach($items as $index => $service)
  <div class="table-row">
    <div class="column2 index">{{ ($index +1) + ($items->currentpage()-1) *$items->perpage() }}</div>
      <div class="wrapper attributes">
        <div class="wrapper title-comment-module-reporter">
          <div class="wrapper title-comment">
            <div class="column2 title">
            <a target="_blank" title="{{$service->name }}" href="/webinar/{{$service->slug}}">{{$service->name }}</a></div>
            <div class="column2 comment">{{ $service->slug}}</div>
          </div>
        </div>
        <div class="wrapper status-owner-severity">
          <div class="column2 severity high">{{$service->Dstatus }} - {{$service->server_id }}</div>
        </div>
      </div>
      <div class="wrapper dates">
        <div class="column2 date">{{$service->created_at }}</div>
        <div class="column2 date">{{$service->updated_at }}</div>
      </div>
      <div class="wrapper icons">
        <div class="column2 watch"> <a class="action-button blue describe" title="View Post" href="/webinar/{{$service->slug}}">مشاهده</a></div>
        <div class="column2 add-comment"><a  onclick="edititem({{$service->id}})" class="action-button yellow describe" title="Edit Post" >✎ </a></div>
        <div class="column2 watch"><a  onclick="deleteitem({{$service->id}})" class="action-button red describe" title="Delete Post" >✖</a></div>
    </div>
  </div>

  <input type="hidden" id="currentpage" value="{{$items->currentpage()}}">
@endforeach
{{ $items->links() }}
