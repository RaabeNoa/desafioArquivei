<?php

namespace Tests\Feature;

use App\NFe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NFeTest extends TestCase
{
    public function testIndexList()
    {
        $response = $this->call('GET', '/nfes');
        $this->assertEquals(200, $response->status());
    }


    public function testApplication()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
    }

    public function testAPIConnection()
    {
        $data = [];
        $response = $this->json('POST', 'https://sandbox-api.arquivei.com.br/v1/nfe/received', $data,
            ['Content-Type' => 'application/json',
                'x-api-id' => 'f96ae22f7c5d74fa4d78e764563d52811570588e',
                'x-api-key' => 'cc79ee9464257c9e1901703e04ac9f86b0f387c2']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testNewNFe()
    {
        $nfes = new NFe(['access_key' =>'xyz123', 'total' => '55.23']);
        $this->assertDatabaseHas($nfes);
    }
}
