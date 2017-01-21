<style>
.mbt-profile img.mbt-image-lg{
    z-index: 0;
    width: 100%;
    margin-bottom: 10px;
}

.mbt-image-profile
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%;
    /*border-bottom-left-radius: 50%;*/
    border-bottom-right-radius: 50%;
    border-top-left-radius: 50%;
    border-top-right-radius: 50%;
}

@media (max-width:768px)
{

.mbt-profile-text>h1{
    font-weight: 700;
    font-size:16px;
}

.mbt-image-profile
{
    margin: -45px 10px 0px 25px;
    border-bottom-left-radius: 50%;
    border-bottom-right-radius: 50%;
    border-top-left-radius: 50%;
    border-top-right-radius: 50%;
    z-index: 9;
    width: 20%;
}
}
</style>

<div>
    <div class="mbt-profile">
        <img align="left" class="mbt-image-lg" src="{{$profile['backgroundurl']}}" alt="Profile image example"/>
        <img align="left" class="mbt-image-profile thumbnail" src="{{$profile['imageurl']}}"" alt="Profile image example"/>
        <div class="mbt-profile-text">
            <h1>{{$profile['name']}}</h1>
            <p>{{$profile['city']}}, {{$profile['state']}}</p>
        </div>
    </div>
</div>
<div style="clear: both;"></div>
			<div style="display: none;">
  {{$profile['id']}}<br>
  {{$profile['name']}}<br>

  {{$profile['lat']}}<br>
  {{$profile['lng']}}<br>
  {{$profile['phone']}}<br>
  {{$profile['email']}}<br>
  {{$profile['participant']}}<br>
  {{$profile['production']}}<br>
  {{$profile['canhavemembers']}}<br>
  {{$profile['canbeamember']}}<br>
  {{$profile['public']}}<br>
  {{$profile['confirmed']}}<br>
  {{$profile['created_at']}}<br>
  {{$profile['updated_at']}}<br>
  {{$profile['created_by']}}<br>
  {{$profile['updated_by']}}<br>
  {{$profile['location']}}<br>

			</div>
