<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Games Data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('batteries.store') }}">
          <div class="form-group">
              @csrf
              <label for="wifimac">WiFi MAC:</label>
              <input type="text" class="form-control" name="wifimac" id="wifimac"/>
          </div>
          <div class="form-group">
              <label for="batterylevel">Battery Level :</label>
              <input type="text" class="form-control" name="batterylevel" id="batterylevel"/>
          </div>
          <div class="form-group">
              <label for="userid">User Name :</label>
              <input type="text" class="form-control" name="userid" id="userid"/>
          </div>
          <div class="form-group">
              <label for="pdaname">PDA Name :</label>
              <input type="text" class="form-control" name="pdaname" id="pdaname"/>
          </div>
          <div class="form-group">
              <label for="lastuserid">Last User Name :</label>
              <input type="text" class="form-control" name="lastuserid" id="lastuserid"/>
          </div>
          <button type="submit" class="btn btn-primary">Add Battery Status</button>
      </form>
  </div>
</div>
@endsection