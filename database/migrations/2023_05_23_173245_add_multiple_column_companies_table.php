<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('company_no')->index()->after('name');
            $table->string('phone')->after('name');
            $table->string('email_company')->after('name_person');
            $table->string('phone_company')->after('name_person');
            $table->string('fax_company')->nullable()->after('name_person');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['company_no', 'phone', 'email_company', 'phone_company', 'fax_company']);
        });
    }
}
