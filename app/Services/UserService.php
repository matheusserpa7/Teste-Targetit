<?php
namespace App\Services;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class UserService
{
  private $repository;
  private $validator;
  public function __construct(UserRepository $repository,UserValidator $validator){
    $this->$repository=$repository;
    $this->$validator=$validator;
  }
}
