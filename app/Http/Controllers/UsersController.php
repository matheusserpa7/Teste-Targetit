<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Entities\Sector;
use Illuminate\Support\Facades\DB;
use \Auth;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_usuario(){
      $rooms = DB::table('rooms')->pluck('room_identification','id');
      $users= DB::table('users')->where('sector_id','>',1)->pluck('name','id');
      $schedulings= DB::table('schedulings')->get();
      return view('user.scheduling',[
        'rooms' => $rooms,
        'users' => $users,
        'schedulings' => $schedulings,
        'message' => null
      ]);
    }
    public function passowrd_usuario(){
      return view('user.password',[
        'message' => null
      ]);
    }

    public function index()
    {

        $sectors = DB::table('sectors')->where('id','>',1)->pluck('sector_name','id');
        $users= DB::table('users')->where('sector_id','>',1)->get();
        return view('user.admin_user',[
          'sectors' => $sectors,
          'users' => $users,
          'message' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
       public function add(Request $request){

         $campos=$request->all();
         foreach ($campos as $campo) {
             if(!$campo){
               $sectors = DB::table('sectors')->where('id','>',1)->pluck('sector_name','id');
               $users= DB::table('users')->where('sector_id','>',1)->get();
               return view('user.admin_user',[
                 'sectors' => $sectors,
                 'users' => $users,
                 'message' => "preencha todos os campos"
               ]);
             }

           }


           $result=$this->store($request);


            return Redirect()->route('user.admin');



       }
    public function store(Request $request)
    {

        try {

          $password=bcrypt($request->get('password'));

          $data=["_token"=>$request->get('_token'),
          "name"=>$request->get('name'),
          "phone"=>$request->get('phone'),
          "email"=>$request->get('email'),
          "password"=>$password,
          "sector_id"=>$request->get('sector_id')];


            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->repository->create($data);



            $response = [
                'message' => 'User created.',
                'data'    => $user->toArray(),
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
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
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
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
     public function passowrd_update(Request $request){
       $result=$this->update($request, Auth::user()->id);
       //dd($request->all());
       return view('user.password',[
         'message' => "Alterado com secesso"
       ]);


     }
    public function update(Request $request, $id)
    {
        try {
            $data=[
              '_token'=>$request->get('_token'),
              'passord'=>bcrypt($request->get('passord'))
            ];
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($data, $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
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
     public function deleta(Request $request){
       $this->destroy($request->get('id'));
       return Redirect()->route('user.admin');

     }
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
}
