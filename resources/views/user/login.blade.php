<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="{!! asset('/css/stylesheet.css') !!}">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="background">
      
    </div>
    <section id="conteudo-view" class="login">
      <h1>Agendamento</h1>
      <h3>Teste Target.it</h3>
      {!! Form::open([ 'route'=>'user.login' , 'method'=>'post']) !!}
      <p>Efetuar Login</p>
        <label>
          {!! Form::text('username',null,['class'=>'input','placeholder'=>'Nome']) !!}
        </label>
        <label>
          {!! Form::Password('password',['class'=>'input','placeholder'=>'Senha']) !!}
        </label>
        {!! Form::submit('logar') !!}
      {!! Form::close() !!}
    </section>
  </body>
</html>
