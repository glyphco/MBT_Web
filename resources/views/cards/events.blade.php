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
.event_name {
    font-weight: bold;
}

.link_button_profile {
    padding: 4px 0px 4px 0px;
    white-space:nowrap;
    display: inline-block;
}
.link_button_profile>a:link {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    background: #4479BA;
    color: #FFF;
    padding: 2px 2px;
    text-decoration: none;
}
.link_button_profile>a:active { color: #FFF; text-decoration: none; background: #4479BA }
.link_button_profile>a:hover { color: #999; text-decoration: none; background: #4479BA }
.link_button_profile>a:visited { color: #FFF; text-decoration: none; background: #4479BA  }

.link_button_event>a:link {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    background: #4479BA;
    color: #FFF;
    padding: 2px 2px;
    text-decoration: none;
    white-space:nowrap;
}
.link_button_profile>a:active { color: #FFF; text-decoration: none; background: #4479BA }
.link_button_event>a:hover { color: #999; text-decoration: none; background: #4479BA }
.link_button_event>a:visited { color: #FFF; text-decoration: none; background: #4479BA  }

.xlinks>a:link { color: #636b6f; text-decoration: none }
.xlinks>a:active { color: #636b6f; text-decoration: none }
.xlinks>a:visited { color: #636b6f; text-decoration: none }
.xlinks>a:hover { color: #636b6f; text-decoration: underline; background: #cccccc }
</style>


@if ($events)
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
        <td class="center link_button_event">
        @if (isset($event['venue']['id']))
			<a href="\venue\{{$event['venue']['id']}}\{{$event['venue']['name']}}">{{$event['venue']['name']}}</a>
		@else
			{{$event['venue_name']}}
		@endif
        </td>
        <td ><span class="event_name">{{$event['name']}}:</span>
		@foreach ($event['participant'] as $participent)

		    {{ $loop->first ? '' : ', ' }}<span class="participent link_button_profile">
	        @if (isset($participent['profile_id']))
				<a class="" href="\profile\{{$participent['profile_id']}}\{{$participent['name']}}">{{$participent['name']}}</a>
			@else
				{{ $participent['name'] }}
			@endif
		    </span>
		@endforeach
		</td>
    </tr>
@endforeach

</table>
@else
<p>no events in system</p>
@endif
