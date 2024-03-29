@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
  @include('templates.menu',['op1'=>'active','op2'=>'','op3'=>''])


  <div class="content">
    <div class="container-fluid">
      <div class="row">
        @if($message)
          <div class="alert alert-danger col-12">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span>
              <b> Alerta - </b> {{$message}}</span>
          </div>

        @endif
        <div class='col-md-12'>
          <div class='card'>
            <div class="card-header card-header-primary">
                <h4 class="card-title">Cadastrar usuario</h4>
              </div>
            <div class='card-body'>
              {!!Form::open(['route'=>'user.add','method'=>'post'])!!}
                <div class="row">
                  @include('templates.formularios.itext',['col'=>'3','input'=>'name','atributes'=>['placeholder'=>'Nome de Usuario','class'=>'form-control']])
                  @include('templates.formularios.itext',['col'=>'3','input'=>'phone','atributes'=>['placeholder'=>'999999999','class'=>'form-control']])
                  @include('templates.formularios.email',['input'=>'email','atributes'=>['placeholder'=>'E-mail','class'=>'form-control']])
                  @include('templates.formularios.password',['input'=>'password','atributes'=>['placeholder'=>'Senha','class'=>'form-control']])
                  @include('templates.formularios.select',['input'=>'sector_id','sectors'=>$sectors,'atributes'=>['placeholder'=>'Selecione Setores','class'=>'form-control']])
                  @include('templates.formularios.button')



                </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Usúario:</h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Nome
                  </th>
                  <th>
                    Telefone
                  </th>
                  <th>
                    E-mail
                  </th>
                  <th>
                    Setor
                  </th>
                  <th></th>
                </thead>
                <tbody>

                  @foreach($users as $user)
                  <tr>
                    <td>
                      {{ $user->id }}
                    </td>
                    <td>
                      {{ $user->name }}
                    </td>
                    <td>
                      {{ $user->phone }}
                    </td>
                    <td>
                      {{ $user->email }}
                    </td>
                    <td class="text-primary">
                      {{$sectors[$user->sector_id]}}
                    </td>
                    <td class="td-actions">
                    
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


@endsection

@section('js-view')

@endsection
