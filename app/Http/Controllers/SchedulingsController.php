<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SchedulingCreateRequest;
use App\Http\Requests\SchedulingUpdateRequest;
use App\Repositories\SchedulingRepository;
use App\Validators\SchedulingValidator;
use Illuminate\Support\Facades\DB;
use \Auth;

/**
 * Class SchedulingsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SchedulingsController extends Controller
{
    /**
     * @var SchedulingRepository
     */
    protected $repository;

    /**
     * @var SchedulingValidator
     */
    protected $validator;

    /**
     * SchedulingsController constructor.
     *
     * @param SchedulingRepository $repository
     * @param SchedulingValidator $validator
     */
    public function __construct(SchedulingRepository $repository, SchedulingValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function add(SchedulingCreateRequest $request){

        $campos=$request->all();
        foreach ($campos as $campo) {
            if(!$campo){
              $rooms = DB::table('rooms')->pluck('room_identification','id');
              $users= DB::table('users')->where('sector_id','>',1)->pluck('name','id');
              $schedulings= DB::table('schedulings')->get();
              return view('user.scheduling',[
                'rooms' => $rooms,
                'users' => $users,
                'schedulings' => $schedulings,
                'message' => 'Preencha todos os campos'
              ]);
            }
          }
          $Hour =  date("H:i", strtotime($request->get('time')));
          $time=$request->get('date')." ".$Hour;

            $schedulings= DB::table('schedulings')->get();

            foreach ($schedulings as $scheduling) {
             if((strtotime( $time) >= strtotime($scheduling->date." -1 hours" ) && strtotime( $time) <= strtotime($scheduling->date ))||(strtotime( $time) <= strtotime($scheduling->date." +1 hours" )&&strtotime( $time)>strtotime($scheduling->date)) ){

               if($request->get('room_id')==$scheduling->room_id){
                 //dd($scheduling->room_id);


               $rooms = DB::table('rooms')->pluck('room_identification','id');
               $users= DB::table('users')->where('sector_id','>',1)->pluck('name','id');

               return view('user.scheduling',[
                 'rooms' => $rooms,
                 'users' => $users,
                 'schedulings' => $schedulings,
                 'message' => 'Horário indisponivel , verifique'
               ]);
             }
           }
             if(strtotime($scheduling->created_at." +1 day") > strtotime(date('Y-m-d'))&&$scheduling->user_id==Auth::user()->id){

               $rooms = DB::table('rooms')->pluck('room_identification','id');
               $users= DB::table('users')->where('sector_id','>',1)->pluck('name','id');
               return view('user.scheduling',[
                 'rooms' => $rooms,
                 'users' => $users,
                 'schedulings' => $schedulings,
                 'message' => 'Limite de Reservas 1 por dia'
               ]);
             }
            }


           $this->store($request);

         return Redirect()->route('user.agendamento');


      }
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $schedulings = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $schedulings,
            ]);
        }

        return view('schedulings.index', compact('schedulings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SchedulingCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */

    public function store(SchedulingCreateRequest $request)
    {
      $Hour =  date("H:i", strtotime($request->get('time')));
      $time=$request->get('date')." ".$Hour;


        try {

           $data=[
             '_token'=>$request->get('_token'),
             'user_id' => Auth::user()->id,
             'room_id' => $request->get('room_id'),
             'date' => $time
           ];

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $scheduling = $this->repository->create($data);

            $response = [
                'message' => 'Scheduling created.',
                'data'    => $scheduling->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scheduling = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $scheduling,
            ]);
        }

        return view('schedulings.show', compact('scheduling'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scheduling = $this->repository->find($id);

        return view('schedulings.edit', compact('scheduling'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SchedulingUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */

    public function update(SchedulingUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $scheduling = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Scheduling updated.',
                'data'    => $scheduling->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Scheduling deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Scheduling deleted.');
    }
}
