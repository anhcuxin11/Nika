@if(session()->get('msg_success'))
  <div class="alert alert-success my-3" role="alert">
    {{ session()->get('msg_success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@elseif(session()->get('msg_error'))
  <div class="alert alert-danger my-3" role="alert">
    {!! session()->get('msg_error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
