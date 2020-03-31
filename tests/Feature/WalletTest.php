<?php

namespace Tests\Feature;

use App\Transfer;
use App\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetWallet()
    {

        $wallet = factory(Wallet::class)->create();

        $trasnfer = factory(Transfer::class,3)->create([
            'wallet_id'=>$wallet->id
        ]);

        $response = $this->json('GET','/api/wallet');


        $response->assertStatus(200)
                ->assertJsonStructure([
                    'id','money','transfers'=>[
                        '*'=> 'id','amount','description','wallet_id'
                    ]
                ]);
        $this->assertCount(3,$response->json()['transfers']);
    }
}
