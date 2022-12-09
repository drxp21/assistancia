<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EntrepriseController
 */
class EntrepriseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $entreprises = Entreprise::factory()->count(3)->create();

        $response = $this->get(route('entreprise.index'));

        $response->assertOk();
        $response->assertViewIs('entreprise.index');
        $response->assertViewHas('entreprises');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('entreprise.create'));

        $response->assertOk();
        $response->assertViewIs('entreprise.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EntrepriseController::class,
            'store',
            \App\Http\Requests\EntrepriseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $content = $this->faker->paragraphs(3, true);

        $response = $this->post(route('entreprise.store'), [
            'content' => $content,
        ]);

        $entreprises = Entreprise::query()
            ->where('content', $content)
            ->get();
        $this->assertCount(1, $entreprises);
        $entreprise = $entreprises->first();

        $response->assertRedirect(route('entreprise.index'));
        $response->assertSessionHas('entreprise.id', $entreprise->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->get(route('entreprise.show', $entreprise));

        $response->assertOk();
        $response->assertViewIs('entreprise.show');
        $response->assertViewHas('entreprise');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->get(route('entreprise.edit', $entreprise));

        $response->assertOk();
        $response->assertViewIs('entreprise.edit');
        $response->assertViewHas('entreprise');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EntrepriseController::class,
            'update',
            \App\Http\Requests\EntrepriseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $entreprise = Entreprise::factory()->create();
        $content = $this->faker->paragraphs(3, true);

        $response = $this->put(route('entreprise.update', $entreprise), [
            'content' => $content,
        ]);

        $entreprise->refresh();

        $response->assertRedirect(route('entreprise.index'));
        $response->assertSessionHas('entreprise.id', $entreprise->id);

        $this->assertEquals($content, $entreprise->content);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->delete(route('entreprise.destroy', $entreprise));

        $response->assertRedirect(route('entreprise.index'));

        $this->assertModelMissing($entreprise);
    }
}
