<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class medico
 * @package App\Models
 * @version January 29, 2018, 7:25 pm UTC
 *
 * @property string nombre
 * @property string C_I
 * @property string especialidad
 * @property integer celular
 */
class medico extends Model
{
    use SoftDeletes;

    public $table = 'medicos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'C_I',
        'especialidad',
        'celular'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'C_I' => 'string',
        'especialidad' => 'string',
        'celular' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'C_I' => 'required',
        'celular' => 'numeric'
    ];

    
}
