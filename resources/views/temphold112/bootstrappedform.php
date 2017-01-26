{{ Form::open(['url' => '/venue'])}}
<div class="form-group">
  {{ Form::label('name', 'Venue Name', ['class' => 'control-label'])}}
  {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Venue'])}}
  <br/>

  {{ Form::label('category', 'Category', ['class' => 'control-label'])}}
  {{ Form::select('category', ['Bar' => 'Bar', 'Club' => 'Club', 'Music Venue' => 'Music Venue'], null, ['class' => 'form-control', 'placeholder' => 'Pick a category...'])}}

</div>
<div class="form-group">
{{ Form::label('street_address', 'street address', ['class' => 'control-label'])}}
{{ Form::text('street_address', null, ['class' => 'form-control', 'placeholder' => '200 W. Adams'])}}
<br/>

{{ Form::label('city', 'City', ['class' => 'control-label'])}}
{{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Chicago'])}}
<br/>

{{ Form::label('state', 'State', ['class' => 'control-label'])}}
{{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'Illinois'])}}
<br/>

{{ Form::label('zipcode', 'Postal Address', ['class' => 'control-label'])}}
{{ Form::text('zipcode', null, ['class' => 'form-control', 'placeholder' => '41.87'])}}
<br/>

{{ Form::label('lat', 'Latitude', ['class' => 'control-label'])}}
{{ Form::text('lat', null, ['class' => 'form-control', 'placeholder' => '41.87'])}}
<br/>

{{ Form::label('lon', 'Longitude', ['class' => 'control-label'])}}
{{ Form::text('lon', null, ['class' => 'form-control', 'placeholder' => '-87.62'])}}
<br/>
</div>
<div class="form-group">
{{ Form::label('phone', 'Phone', ['class' => 'control-label'])}}
{{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'here@there.com'])}}
<br/>

{{ Form::label('email', 'Email', ['class' => 'control-label'])}}
{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'here@there.com'])}}
<br/>
</div>
<div class="form-group">
{{ Form::label('public', 'Make Public', ['class' => 'control-label'])}}
{{ Form::checkbox('public', '1', ['class' => 'form-control'])}}
<br/>
{{ Form::label('public', 'Confirmed', ['class' => 'control-label'])}}
{{ Form::checkbox('confirmed', '1', ['class' => 'form-control'])}}
<br/>
</div>

{{ Form::submit('Submit')}}
{{ Form::close()}}
