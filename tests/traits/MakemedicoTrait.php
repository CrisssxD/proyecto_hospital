<?php

use Faker\Factory as Faker;
use App\Models\medico;
use App\Repositories\medicoRepository;

trait MakemedicoTrait
{
    /**
     * Create fake instance of medico and save it in database
     *
     * @param array $medicoFields
     * @return medico
     */
    public function makemedico($medicoFields = [])
    {
        /** @var medicoRepository $medicoRepo */
        $medicoRepo = App::make(medicoRepository::class);
        $theme = $this->fakemedicoData($medicoFields);
        return $medicoRepo->create($theme);
    }

    /**
     * Get fake instance of medico
     *
     * @param array $medicoFields
     * @return medico
     */
    public function fakemedico($medicoFields = [])
    {
        return new medico($this->fakemedicoData($medicoFields));
    }

    /**
     * Get fake data of medico
     *
     * @param array $postFields
     * @return array
     */
    public function fakemedicoData($medicoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'C_I' => $fake->word,
            'especialidad' => $fake->word,
            'celular' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $medicoFields);
    }
}
