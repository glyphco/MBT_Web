      <table class="listing left">
      @foreach($profiles as $i => $profile)
          <tr style="background-color: {{ $i % 2 == 0 ? '#ffffff': '#f3f3f3' }};"  class="event left">
              <td class="event-venue links">
            <a href="\profile\{{$profile['id']}}\{{$profile['name']}}">{{$profile['name']}}</a>
              </td>
              <td><span class="event-name">{{$profile['city']}}, {{$profile['state']}}
          </td>
          </tr>
      @endforeach
      </table>