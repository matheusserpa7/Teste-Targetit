@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
  @include('templates.menu_user',['op1'=>'','op2'=>'active'])
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        @if($message)
          <div class="alert alert-success col-12">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span>
              <b> Sucesso - </b> {{$message}}</span>
          </div>

        @endif
        <div class='col-md-12'>
          <div class='card'>
            <div class="card-header card-header-primary">
                <h4 class="card-title">Alterar Senha</h4>
              </div>
            <div class='card-body'>
              {!!Form::open(['route'=>'password.update','method'=>'post'])!!}
                <div class="row">
                  @include('templates.formularios.password',['col'=>'8','input'=>'password','atributes'=>['placeholder'=>'Nova Senha','class'=>'form-control']])


                  @include('templates.formularios.button')



                </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('js-view')

@endsection
