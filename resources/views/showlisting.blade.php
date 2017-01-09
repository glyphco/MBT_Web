			<table class="listing left">
			@foreach($events as $i => $event)
			    <tr style="background-color: {{ $i % 2 == 0 ? '#ffffff': '#f3f3f3' }};"  class="event left">
			        <td class="monospace">{{ date('D.M.d.y',strtotime($event['start']))}} </td>
			        <td class="event-venue links">
			        @if (isset($event['venue']['id']))
						<a href="\venue\{{$event['venue']['id']}}\{{$event['venue']['name']}}">{{$event['venue']['name']}}</a>
					@else
						[VENUE]
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