<!DOCTYPE html><html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA_Compatible" content="ie=edge">

  <title> @yield('title-block') </title>
  <link rel="stylesheet"  href = "css/app.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>

  @include('inc.messages')
@include('inc.header')
@yield('content')
@include('inc/aside')

</body>
</html>
