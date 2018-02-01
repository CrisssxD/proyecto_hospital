<?php

namespace App\Repositories;

use App\Models\medico;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class medicoRepository
 * @package App\Repositories
 * @version January 29, 2018, 7:25 pm UTC
 *
 * @method medico findWithoutFail($id, $columns = ['*'])
 * @method medico find($id, $columns = ['*'])
 * @method medico first($columns = ['*'])
*/
class medicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'C_I',
        'especialidad',
        'celular'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return medico::class;
    }
}
