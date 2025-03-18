<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->decimal('interest_rate', 5, 2)->default(8.00); // Lãi suất mặc định 8%
    });
}

public function down()
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->dropColumn('interest_rate');
    });
}

};
