<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemedicoAPIRequest;
use App\Http\Requests\API\UpdatemedicoAPIRequest;
use App\Models\medico;
use App\Repositories\medicoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class medicoController
 * @package App\Http\Controllers\API
 */

class medicoAPIController extends AppBaseController
{
    /** @var  medicoRepository */
    private $medicoRepository;

    public function __construct(medicoRepository $medicoRepo)
    {
        $this->medicoRepository = $medicoRepo;
    }

    /**
     * Display a listing of the medico.
     * GET|HEAD /medicos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->medicoRepository->pushCriteria(new RequestCriteria($request));
        $this->medicoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $medicos = $this->medicoRepository->all();

        return $this->sendResponse($medicos->toArray(), 'Medicos retrieved successfully');
    }

    /**
     * Store a newly created medico in storage.
     * POST /medicos
     *
     * @param CreatemedicoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemedicoAPIRequest $request)
    {
        $input = $request->all();

        $medicos = $this->medicoRepository->create($input);

        return $this->sendResponse($medicos->toArray(), 'Medico saved successfully');
    }

    /**
     * Display the specified medico.
     * GET|HEAD /medicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var medico $medico */
        $medico = $this->medicoRepository->findWithoutFail($id);

        if (empty($medico)) {
            return $this->sendError('Medico not found');
        }

        return $this->sendResponse($medico->toArray(), 'Medico retrieved successfully');
    }

    /**
     * Update the specified medico in storage.
     * PUT/PATCH /medicos/{id}
     *
     * @param  int $id
     * @param UpdatemedicoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemedicoAPIRequest $request)
    {
        $input = $request->all();

        /** @var medico $medico */
        $medico = $this->medicoRepository->findWithoutFail($id);

        if (empty($medico)) {
            return $this->sendError('Medico not found');
        }

        $medico = $this->medicoRepository->update($input, $id);

        return $this->sendResponse($medico->toArray(), 'medico updated successfully');
    }

    /**
     * Remove the specified medico from storage.
     * DELETE /medicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var medico $medico */
        $medico = $this->medicoRepository->findWithoutFail($id);

        if (empty($medico)) {
            return $this->sendError('Medico not found');
        }

        $medico->delete();

        return $this->sendResponse($id, 'Medico deleted successfully');
    }
}
