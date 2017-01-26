<style>
.mbt-venue img.mbt-image-lg{
    z-index: 0;
    width: 100%;
    margin-bottom: 10px;
}

.mbt-image-venue
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%;
}

@media (max-width:768px)
{

.mbt-venue-text>h1{
    font-weight: 700;
    font-size:16px;
}

.mbt-image-venue
{
    margin: -45px 10px 0px 25px;
    z-index: 9;
    width: 20%;
}
}
</style>

<div>
    <div class="mbt-venue">
        <img align="left" class="mbt-image-lg" src="{{$venue['backgroundurl']}}" alt="venue image example"/>
        <img align="left" class="mbt-image-venue thumbnail" src="{{$venue['imageurl']}}" alt="venue image example"/>
        <div class="mbt-venue-text">
            <h1>{{$venue['name']}}</h1>
            <p>{{$venue['street_address']}} {{$venue['city']}}, {{$venue['state']}} {{$venue['postalcode']}}</p>
        </div>
    </div>
</div>
<div style="clear: both;"></div>

      <div style="display: none;">
  {{$venue['id']}}<br>
  {{$venue['name']}}<br>
  {{$venue['slug']}}<br>
  {{$venue['category']}}<br>
  {{$venue['street_address']}}<br>
  {{$venue['city']}}<br>
  {{$venue['state']}}<br>
  {{$venue['postalcode']}}<br>
  {{$venue['lat']}}<br>
  {{$venue['lng']}}<br>
  {{$venue['phone']}}<br>
  {{$venue['email']}}<br>
  {{$venue['location']}}<br>
			</div>
