<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseRepairRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_repair_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('only_one_residence',['y','n'])->default('n');
            $table->enum('lack_the_finances_resources',['y','n'])->default('n');
            $table->enum('older_age',['y','n'])->default('n');
            $table->enum('physical_disability',['y','n'])->default('n');
            $table->enum('veteran',['y','n'])->default('n');

            $table->string('name');
            $table->string('street')->nullable();
            $table->bigInteger('city');
            $table->bigInteger('state');
            $table->string('zipcode');
            $table->string('extended_zip')->nullable();
            $table->string('primary_phone');
            $table->string('secondary_phone')->nullable();
            $table->enum('marital_status',['m','u']);
            $table->string('alternate_contact_name')->nullable();
            $table->string('alternate_contact_phone')->nullable();

            $table->double('total_annual_household_income',10,2);
            $table->integer('age_of_owner');
            $table->integer('years_lived_in_this_home');
            $table->enum('any_resident_disabled',['y','n'])->default('n');
            $table->json('disabled_person_details')->nullable();
            $table->enum('any_veteran_member',['y','n'])->default('n');
            $table->json('residents_details')->nullable();
            $table->json('house_information')->nullable();
            $table->enum('received_cio_help',['y','n'])->default('n');
            $table->integer('received_cio_help_year')->nullable();
            
            
            $table->json('basic_plumbing')->nullable();
            $table->json('heat_furnace')->nullable();
            $table->json('basic_electrical')->nullable();
            $table->json('doors_and_windows')->nullable();
            $table->json('painting')->nullable();
            $table->json('wood_repair')->nullable();
            $table->json('roof_patching')->nullable();
            $table->json('gutters')->nullable();
            $table->json('insulation_weatherization')->nullable();
            $table->json('wheelchair_ramp')->nullable();
            $table->json('concrete_patching')->nullable();
            $table->json('other_repairs')->nullable();
            $table->json('yard_work')->nullable();

            $table->enum('tc_agreed',['y','n'])->default('n');

            $table->json('custom_field')->nullable();

            $table->bigInteger('field_assistant_id')->nullable();
            $table->string('verification_document')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->bigInteger('verified_by')->nullable();

            $table->bigInteger('house_captain_id')->nullable();
            $table->timestamp('house_captain_approved_at')->nullable();
            $table->bigInteger('house_captain_approved_by')->nullable();
            $table->text('rejected_house_captains')->nullable();
           

            $table->enum('status',['received','verifying','verified','work_in_progress','work_completed','rejected','cancelled'])->default('received');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_repair_requests');
    }
}
