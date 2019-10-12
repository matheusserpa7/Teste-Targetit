@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
  @include('templates.menu',['op1'=>'','op2'=>'','op3'=>'active'])
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class='col-md-12'>
          <div class='card'>
            <div class="card-header card-header-primary">
                <h4 class="card-title">Cadastrar usuario</h4>
              </div>
            <div class='card-body'>
              {!!Form::open(['method'=>'post'])!!}
                <div class="row">
                  @include('templates.formularios.itext',['input'=>'Nume','atributes'=>['placeholder'=>'Nome de Usuario','class'=>'form-control']])


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
            <h4 class="card-title ">Salas:</h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Nome da Sala
                  </th>

                  <th></th>
                </thead>
                <tbody>

                  @foreach($rooms as $room)
                  <tr>
                    <td>
                      {{ $room->id }}
                    </td>
                    <td>
                      {{ $room->room_identification }}
                    </td>
                    <td class="td-actions">
                      <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                        <i class="material-icons">edit</i>
                      </button>
                      <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                        <i class="material-icons">close</i>
                      </button>
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
