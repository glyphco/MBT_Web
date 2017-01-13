<style>
.listing {
    font-family: 'Fira Sans', sans-serif;
    font-size: 12px;
}
.monospace {
    font-family: 'Fira Mono', sans-serif;
    font-size: 12px;
}
.center {
    text-align: center;
}

.links>a:link { color: #636b6f; text-decoration: none }
.links>a:active { color: #636b6f; text-decoration: none }
.links>a:visited { color: #636b6f; text-decoration: none }
.links>a:hover { color: #636b6f; text-decoration: underline; background: #cccccc }
</style>



<table class="listing left">
@php($current_month = null)
@foreach($events as $i => $event)
  @if (date('F',strtotime($event['start'])) != $current_month)
    @php($current_month = date('F',strtotime($event['start'])))
    <tr style="background-color:'#ffffff'"  class="month left">
        <td colspan="3" class="monospace">{{ date('F Y',strtotime($event['start']))}} </td>
  @endif

    <tr style="background-color: {{ $i % 2 == 0 ? '#ffffff': '#f3f3f3' }};"  class="event left">
        <td nowrap class="monospace">{{ date('D d',strtotime($event['start']))}} </td>
        <td class="center links">
        @if (isset($event['venue']['id']))
			<a href="\venue\{{$event['venue']['id']}}\{{$event['venue']['name']}}">{{$event['venue']['name']}}</a>
		@else
			{{$event['venue_name']}}
		@endif
        </td>
        <td><span class="event-name">{{$event['name']}}:</span>
		@foreach ($event['participant'] as $participent)

		    {{ $loop->first ? '' : ', ' }}<span class="participent links">
	        @if (isset($participent['profile_id']))
				<a href="\profile\{{$participent['profile_id']}}\{{$participent['name']}}">{{$participent['name']}}</a>
			@else
				{{ $participent['name'] }}
			@endif
		    </span>
		@endforeach
		</td>
    </tr>
@endforeach
</table>