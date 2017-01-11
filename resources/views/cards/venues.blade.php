      <table class="listing left">
      @foreach($venues as $i => $venue)
          <tr style="background-color: {{ $i % 2 == 0 ? '#ffffff': '#f3f3f3' }};"  class="event left">
              <td class="event-venue links">
            <a href="\profile\{{$venue['id']}}\{{$venue['name']}}">{{$venue['name']}}</a>
              </td>
              <td><span class="event-name">{{$venue['category']}}</span></td>
              <td><span class="event-name">{{$venue['street_address']}}, {{$venue['city']}}, {{$venue['state']}}</span>
          </td>
          </tr>
      @endforeach
      </table>