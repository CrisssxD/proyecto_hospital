<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateinsumoRequest;
use App\Http\Requests\UpdateinsumoRequest;
use App\Repositories\insumoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class insumoController extends AppBaseController
{
    /** @var  insumoRepository */
    private $insumoRepository;

    public function __construct(insumoRepository $insumoRepo)
    {
        $this->insumoRepository = $insumoRepo;
    }

    /**
     * Display a listing of the insumo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->insumoRepository->pushCriteria(new RequestCriteria($request));
        $insumos = $this->insumoRepository->all();

        return view('insumos.index')
            ->with('insumos', $insumos);
    }

    /**
     * Show the form for creating a new insumo.
     *
     * @return Response
     */
    public function create()
    {
        return view('insumos.create');
    }

    /**
     * Store a newly created insumo in storage.
     *
     * @param CreateinsumoRequest $request
     *
     * @return Response
     */
    public function store(CreateinsumoRequest $request)
    {
        $input = $request->all();

        $insumo = $this->insumoRepository->create($input);

        Flash::success('Insumo saved successfully.');

        return redirect(route('insumos.index'));
    }

    /**
     * Display the specified insumo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $insumo = $this->insumoRepository->findWithoutFail($id);

        if (empty($insumo)) {
            Flash::error('Insumo not found');

            return redirect(route('insumos.index'));
        }

        return view('insumos.show')->with('insumo', $insumo);
    }

    /**
     * Show the form for editing the specified insumo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $insumo = $this->insumoRepository->findWithoutFail($id);

        if (empty($insumo)) {
            Flash::error('Insumo not found');

            return redirect(route('insumos.index'));
        }

        return view('insumos.edit')->with('insumo', $insumo);
    }

    /**
     * Update the specified insumo in storage.
     *
     * @param  int              $id
     * @param UpdateinsumoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinsumoRequest $request)
    {
        $insumo = $this->insumoRepository->findWithoutFail($id);

        if (empty($insumo)) {
            Flash::error('Insumo not found');

            return redirect(route('insumos.index'));
        }

        $insumo = $this->insumoRepository->update($request->all(), $id);

        Flash::success('Insumo updated successfully.');

        return redirect(route('insumos.index'));
    }

    /**
     * Remove the specified insumo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $insumo = $this->insumoRepository->findWithoutFail($id);

        if (empty($insumo)) {
            Flash::error('Insumo not found');

            return redirect(route('insumos.index'));
        }

        $this->insumoRepository->delete($id);

        Flash::success('Insumo deleted successfully.');

        return redirect(route('insumos.index'));
    }
}
