<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Admin;
use App\Models\Auteur;
use App\Models\Demande;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DemandeController
 */
class DemandeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $demandes = Demande::factory()->count(3)->create();

        $response = $this->get(route('demande.index'));

        $response->assertOk();
        $response->assertViewIs('demande.index');
        $response->assertViewHas('demandes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('demande.create'));

        $response->assertOk();
        $response->assertViewIs('demande.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DemandeController::class,
            'store',
            \App\Http\Requests\DemandeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $contenu = $this->faker->text;
        $auteur = Auteur::factory()->create();
        $admin = Admin::factory()->create();

        $response = $this->post(route('demande.store'), [
            'status' => $status,
            'contenu' => $contenu,
            'auteur_id' => $auteur->id,
            'admin_id' => $admin->id,
        ]);

        $demandes = Demande::query()
            ->where('status', $status)
            ->where('contenu', $contenu)
            ->where('auteur_id', $auteur->id)
            ->where('admin_id', $admin->id)
            ->get();
        $this->assertCount(1, $demandes);
        $demande = $demandes->first();

        $response->assertRedirect(route('demande.index'));
        $response->assertSessionHas('demande.id', $demande->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $demande = Demande::factory()->create();

        $response = $this->get(route('demande.show', $demande));

        $response->assertOk();
        $response->assertViewIs('demande.show');
        $response->assertViewHas('demande');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $demande = Demande::factory()->create();

        $response = $this->get(route('demande.edit', $demande));

        $response->assertOk();
        $response->assertViewIs('demande.edit');
        $response->assertViewHas('demande');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DemandeController::class,
            'update',
            \App\Http\Requests\DemandeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $demande = Demande::factory()->create();
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $contenu = $this->faker->text;
        $auteur = Auteur::factory()->create();
        $admin = Admin::factory()->create();

        $response = $this->put(route('demande.update', $demande), [
            'status' => $status,
            'contenu' => $contenu,
            'auteur_id' => $auteur->id,
            'admin_id' => $admin->id,
        ]);

        $demande->refresh();

        $response->assertRedirect(route('demande.index'));
        $response->assertSessionHas('demande.id', $demande->id);

        $this->assertEquals($status, $demande->status);
        $this->assertEquals($contenu, $demande->contenu);
        $this->assertEquals($auteur->id, $demande->auteur_id);
        $this->assertEquals($admin->id, $demande->admin_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $demande = Demande::factory()->create();

        $response = $this->delete(route('demande.destroy', $demande));

        $response->assertRedirect(route('demande.index'));

        $this->assertModelMissing($demande);
    }
}
