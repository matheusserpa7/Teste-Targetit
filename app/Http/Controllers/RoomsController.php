<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RoomCreateRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Repositories\RoomRepository;
use App\Validators\RoomValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class RoomsController.
 *
 * @package namespace App\Http\Controllers;
 */
class RoomsController extends Controller
{
    /**
     * @var RoomRepository
     */
    protected $repository;

    /**
     * @var RoomValidator
     */
    protected $validator;

    /**
     * RoomsController constructor.
     *
     * @param RoomRepository $repository
     * @param RoomValidator $validator
     */
    public function __construct(RoomRepository $repository, RoomValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $rooms = DB::table('rooms')->get();
            return view('user.admin_room',[
             'rooms' => $rooms,
             'message'=>null
            ]);
    }
    public function add(RoomCreateRequest $request){
      $campos=$request->all();
      foreach ($campos as $campo) {
          if(!$campo){
            $sectors = DB::table('sectors')->where('id','>',1)->get();
            return view('user.admin_sectors',[
              'sectors' => $sectors,
              'message' => "preencha todos os campos"
            ]);
          }

        }

      $result=$this->store($request);
    
       return Redirect()->route('room.admin');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoomCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RoomCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $room = $this->repository->create($request->all());

            $response = [
                'message' => 'Room created.',
                'data'    => $room->toArray(),
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
        $room = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $room,
            ]);
        }

        return view('rooms.show', compact('room'));
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
        $room = $this->repository->find($id);

        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoomUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RoomUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $room = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Room updated.',
                'data'    => $room->toArray(),
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
                'message' => 'Room deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Room deleted.');
    }

}
