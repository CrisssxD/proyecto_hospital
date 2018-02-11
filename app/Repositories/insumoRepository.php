<?php

namespace App\Repositories;

use App\Models\insumo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class insumoRepository
 * @package App\Repositories
 * @version February 2, 2018, 12:18 am UTC
 *
 * @method insumo findWithoutFail($id, $columns = ['*'])
 * @method insumo find($id, $columns = ['*'])
 * @method insumo first($columns = ['*'])
*/
class insumoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return insumo::class;
    }
}
