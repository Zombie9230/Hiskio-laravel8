<!-- Modal -->
<div class="modal fade" id="notification" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">通知</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ol>
            @foreach ($notifications as $notification)
            <li class="read_notification" data-id="{{ $notification->id }}">{{ $notification->data['msg'] }}
                <span class="read">
                  @if ($notification->read_at)
                      (已讀)
                  @endif
                </span>
              </li>
            @endforeach
          </ol>
        </div>
      </div>
    </div>
  </div>
  <script>
  $('.read_notification').click(function(){
    var $this = $(this);
    $.ajax({
      method: "POST",
      url: "/read-notification",
      data: { id: $this.data('id')}
    })
    .done(function( msg ) {
      if(msg.result){
        $this.find('.read').text('(已讀)')
      }
    });
  });
  </script>
