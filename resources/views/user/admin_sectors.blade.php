@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
  @include('templates.menu',['op1'=>'','op2'=>'active','op3'=>''])
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
              {!!Form::open(['route'=>'sector.add','method'=>'post'])!!}
                <div class="row">
                  @include('templates.formularios.itext',['col'=>'8','input'=>'sector_name','atributes'=>['placeholder'=>'Nome do setor','class'=>'form-control']])


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
            <h4 class="card-title ">Setores:</h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Nome do setor
                  </th>

                  <th></th>
                </thead>
                <tbody>

                  @foreach($sectors as $sector)
                  <tr>
                    <td>
                      {{ $sector->id }}
                    </td>
                    <td>
                      {{ $sector->sector_name }}
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
