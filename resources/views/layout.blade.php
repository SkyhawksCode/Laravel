<!-- layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>TradeInn</title>
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    @yield('content')
  <script src="{{ asset('/js/app.js') }}" type="text/js"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>