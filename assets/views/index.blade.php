<!-- index.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>WiFI MAC</td>
          <td>Battery Level</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($batteries as $battery)
        <tr>
            <td>{{$battery->id}}</td>
            <td>{{$battery->wifimac}}</td>
            <td>{{$battery->batterylevel}}</td>
            <td><a href="{{ route('batteries.edit', $battery->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('batteries.destroy', $battery->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection