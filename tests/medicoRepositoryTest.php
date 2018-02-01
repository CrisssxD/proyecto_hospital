<?php

use App\Models\medico;
use App\Repositories\medicoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class medicoRepositoryTest extends TestCase
{
    use MakemedicoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var medicoRepository
     */
    protected $medicoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->medicoRepo = App::make(medicoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemedico()
    {
        $medico = $this->fakemedicoData();
        $createdmedico = $this->medicoRepo->create($medico);
        $createdmedico = $createdmedico->toArray();
        $this->assertArrayHasKey('id', $createdmedico);
        $this->assertNotNull($createdmedico['id'], 'Created medico must have id specified');
        $this->assertNotNull(medico::find($createdmedico['id']), 'medico with given id must be in DB');
        $this->assertModelData($medico, $createdmedico);
    }

    /**
     * @test read
     */
    public function testReadmedico()
    {
        $medico = $this->makemedico();
        $dbmedico = $this->medicoRepo->find($medico->id);
        $dbmedico = $dbmedico->toArray();
        $this->assertModelData($medico->toArray(), $dbmedico);
    }

    /**
     * @test update
     */
    public function testUpdatemedico()
    {
        $medico = $this->makemedico();
        $fakemedico = $this->fakemedicoData();
        $updatedmedico = $this->medicoRepo->update($fakemedico, $medico->id);
        $this->assertModelData($fakemedico, $updatedmedico->toArray());
        $dbmedico = $this->medicoRepo->find($medico->id);
        $this->assertModelData($fakemedico, $dbmedico->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemedico()
    {
        $medico = $this->makemedico();
        $resp = $this->medicoRepo->delete($medico->id);
        $this->assertTrue($resp);
        $this->assertNull(medico::find($medico->id), 'medico should not exist in DB');
    }
}
