      <table class="listing left">
      @foreach($venues as $i => $venue)
          <tr style="background-color: {{ $i % 2 == 0 ? '#ffffff': '#f3f3f3' }};"  class="event left">
              <td class="event-venue links">
            <a href="\venue\{{$venue['id']}}">{{$venue['name']}}</a>
              </td>
              <td><span class="event-name">{{$venue['category']}}</span></td>
              <td><span class="event-name">{{$venue['street_address']}}, {{$venue['city']}}, {{$venue['state']}}</span>
          </td>
          @has(venue.$venue['id'].edit)
          <td>
          {{ Form::open(['method' => 'GET', 'route' => ['venue.edit', $venue['id']]]) }}
              {{ Form::submit('Edit', ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
          </td>
          @endhas
          @has(delete-venues)
          <td>
          {{ Form::open(['method' => 'DELETE', 'route' => ['venue.destroy', $venue['id']]]) }}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
          </td>
          @endhas
          </tr>
      @endforeach
      </table>
