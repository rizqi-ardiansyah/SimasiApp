
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMASI</title>

    <link rel="stylesheet" href="{{url('/assets/css/style.css')}}">


</head>


<body class="login-page">
  <div class="login-logo">
              <img class="lgn-logo" src="{{url('/assets/img/logoMangsi.png')}}" alt="logo-login"> <br>
          </div>
    <div class="form">
      <p class="login-box-msg">{{$title}}</p>
      <form class="login-form" action="/simasi/public/login" method="post">
      @csrf
        <input type="text" placeholder="username" name="email"/>
        <input type="password" placeholder="password" name="password"/>
        <button>login</button>
      </form>
    </div>
  </div>
</body>
