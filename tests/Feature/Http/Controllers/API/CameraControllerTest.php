<?php


namespace Tests\Feature\Http\Controllers\API;


use App\Models\Camera;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CameraControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_cameras()
    {
        $this->json('GET', route('api.cameras.index'))
            ->assertStatus(200);
    }

    public function test_cameras_have_valid_response()
    {
        Camera::factory()->count(3)->create();

        $this->json('GET', route('api.cameras.index'))
            ->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'latitude',
                        'longitude',
                        'name'
                    ]
                ]
            ]);
    }
}
