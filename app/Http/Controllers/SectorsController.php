<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SectorCreateRequest;
use App\Http\Requests\SectorUpdateRequest;
use App\Repositories\SectorRepository;
use App\Validators\SectorValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class SectorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SectorsController extends Controller
{
    /**
     * @var SectorRepository
     */
    protected $repository;

    /**
     * @var SectorValidator
     */
    protected $validator;

    /**
     * SectorsController constructor.
     *
     * @param SectorRepository $repository
     * @param SectorValidator $validator
     */
    public function __construct(SectorRepository $repository, SectorValidator $validator)
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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $sectors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sectors,
            ]);
        }

        return view('sectors.index', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SectorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SectorCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sector = $this->repository->create($request->all());

            $response = [
                'message' => 'Sector created.',
                'data'    => $sector->toArray(),
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
        $sector = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sector,
            ]);
        }

        return view('sectors.show', compact('sector'));
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
        $sector = $this->repository->find($id);

        return view('sectors.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SectorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SectorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sector = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Sector updated.',
                'data'    => $sector->toArray(),
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
                'message' => 'Sector deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Sector deleted.');
    }
    public function admin(){

      $sectors = DB::table('sectors')->where('id','>',1)->get();
      return view('user.admin_sectors',[
        'sectors' => $sectors
      ]);
    }
}
