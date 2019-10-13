@extends('templates.master')

@section('css-view')
<!--Import Google Icon Font-->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!--Import materialize.css-->
     <link type="text/css" rel="stylesheet" href="{!!asset('materialize/css/materialize.min.css')!!}"  media="screen,projection"/>
@endsection

@section('conteudo-view')
  @include('templates.menu_user',['op1'=>'active','op2'=>'','op3'=>''])


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
                <h4 class="card-title">Agendar Sala</h4>
              </div>
            <div class='card-body'>
              {!!Form::open(['route'=>'user.agendamento','method'=>'post'])!!}
                <div class="row">

                  @include('templates.formularios.select',['input'=>'room_id','sectors'=>$rooms,'atributes'=>['placeholder'=>'Selecione sala de reunião','class'=>'form-control']])
                  <div class="col-3">
                    <input name='date' type="text" class="datepicker">
                  </div>
                  <div class="col-3">
                    <input name="time" type="text" class="timepicker">
                  </div>

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
            <h4 class="card-title ">Reuniões:</h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Agendado por:
                  </th>
                  <th>
                    Sala
                  </th>
                  <th>
                    data
                  </th>

                </thead>
                <tbody>

                  @foreach($schedulings as $scheduling)
                  @if(strtotime($scheduling->date) >= strtotime('2019-10-12'))
                  <tr>
                    <td>
                      {{$users[$scheduling->user_id]}}
                    </td>
                    <td>
                      {{$rooms[$scheduling->room_id]}}
                    </td>
                    <td>
                      {{date('d/m/Y H:i',  strtotime($scheduling->date))}}
                    </td>

                  </tr>
                  @endif
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
<script type="text/javascript" src="{!!asset('materialize/js/materialize.min.js')!!}"></script>
<script type="text/javascript">


$(document).ready(function(){
$('.timepicker').timepicker({format: 'hh:mm'});
});
$(document).ready(function(){


    $('.datepicker').datepicker({format: 'yyyy-mm-dd'});

  });
</script>
@endsection
