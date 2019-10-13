<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use \Auth;
class DeashboardController extends Controller
{
  /**
   * UsersController constructor.
   *
   * @param UserRepository $repository
   * @param UserValidator $validator
   */

   private $repository;
   private $validator;

  public function __construct(UserRepository $repository, UserValidator $validator)
  {
      $this->repository = $repository;
      $this->validator  = $validator;
    //  $this->middleware('auth');
  }

  public function auth(Request $request){
    $data =[
      'email'=>$request->get('username'),
      'password'=>$request->get('password')
    ];
    try {
      if(Auth::attempt($data,null)){
        $setor=Auth::user()->sector_id;
        if($setor==1)
          return Redirect()->route('user.admin');

        else
          return Redirect()->route('user.agendamento');

      }
      else{
        echo "Acesso Negado";
      }


      //echo 'logou';
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }

    //echo $data['email']." ".$data['password'];
  }

  public function index(){
    //echo"Logado :)";
    return view('user.deashboard');

  }
  public function logout(Request $request) {
  Auth::logout();
  return redirect('/login');
}
}
