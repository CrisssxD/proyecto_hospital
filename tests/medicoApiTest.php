<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class medicoApiTest extends TestCase
{
    use MakemedicoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemedico()
    {
        $medico = $this->fakemedicoData();
        $this->json('POST', '/api/v1/medicos', $medico);

        $this->assertApiResponse($medico);
    }

    /**
     * @test
     */
    public function testReadmedico()
    {
        $medico = $this->makemedico();
        $this->json('GET', '/api/v1/medicos/'.$medico->id);

        $this->assertApiResponse($medico->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemedico()
    {
        $medico = $this->makemedico();
        $editedmedico = $this->fakemedicoData();

        $this->json('PUT', '/api/v1/medicos/'.$medico->id, $editedmedico);

        $this->assertApiResponse($editedmedico);
    }

    /**
     * @test
     */
    public function testDeletemedico()
    {
        $medico = $this->makemedico();
        $this->json('DELETE', '/api/v1/medicos/'.$medico->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/medicos/'.$medico->id);

        $this->assertResponseStatus(404);
    }
}
