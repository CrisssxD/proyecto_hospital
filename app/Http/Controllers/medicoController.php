<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemedicoRequest;
use App\Http\Requests\UpdatemedicoRequest;
use App\Repositories\medicoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class medicoController extends AppBaseController
{
    /** @var  medicoRepository */
    private $medicoRepository;

    public function __construct(medicoRepository $medicoRepo)
    {
        $this->medicoRepository = $medicoRepo;
    }

    /**
     * Display a listing of the medico.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->medicoRepository->pushCriteria(new RequestCriteria($request));
        $medicos = $this->medicoRepository->all();

        return view('medicos.index')
            ->with('medicos', $medicos);
    }

    /**
     * Show the form for creating a new medico.
     *
     * @return Response
     */
    public function create()
    {
        return view('medicos.create');
    }

    /**
     * Store a newly created medico in storage.
     *
     * @param CreatemedicoRequest $request
     *
     * @return Response
     */
    public function store(CreatemedicoRequest $request)
    {
        $input = $request->all();

        $medico = $this->medicoRepository->create($input);

        Flash::success('Medico saved successfully.');

        return redirect(route('medicos.index'));
    }

    /**
     * Display the specified medico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medico = $this->medicoRepository->findWithoutFail($id);

        if (empty($medico)) {
            Flash::error('Medico not found');

            return redirect(route('medicos.index'));
        }

        return view('medicos.show')->with('medico', $medico);
    }

    /**
     * Show the form for editing the specified medico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medico = $this->medicoRepository->findWithoutFail($id);

        if (empty($medico)) {
            Flash::error('Medico not found');

            return redirect(route('medicos.index'));
        }

        return view('medicos.edit')->with('medico', $medico);
    }

    /**
     * Update the specified medico in storage.
     *
     * @param  int              $id
     * @param UpdatemedicoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemedicoRequest $request)
    {
        $medico = $this->medicoRepository->findWithoutFail($id);

        if (empty($medico)) {
            Flash::error('Medico not found');

            return redirect(route('medicos.index'));
        }

        $medico = $this->medicoRepository->update($request->all(), $id);

        Flash::success('Medico updated successfully.');

        return redirect(route('medicos.index'));
    }

    /**
     * Remove the specified medico from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medico = $this->medicoRepository->findWithoutFail($id);

        if (empty($medico)) {
            Flash::error('Medico not found');

            return redirect(route('medicos.index'));
        }

        $this->medicoRepository->delete($id);

        Flash::success('Medico deleted successfully.');

        return redirect(route('medicos.index'));
    }
}
