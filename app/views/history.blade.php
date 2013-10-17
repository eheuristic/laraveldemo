<table class="table table-striped table-bordered table-condensed">
    <thead>
    <tr>
        <td class="header">
              From
        </td>
        <td>
               Subject
        </td>
        <td>
               Content
        </td>
         <td>
               Sent Time
        </td>
    </tr>
</thead>
@foreach ($histories as $history)
    <tr>
        <td>
              {{ $history->to  }}
        </td>
        <td>
               {{ $history->subject  }}
        </td>
        <td>
                {{ $history->msg_body  }}
        </td>
         <td>
                {{ $history->created_at  }}
        </td>
    </tr>
    @endforeach
</table>
<!--
<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
    -->