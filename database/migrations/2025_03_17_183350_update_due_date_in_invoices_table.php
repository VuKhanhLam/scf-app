<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->date('due_date')->nullable()->change(); // ✅ Cho phép NULL
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->date('due_date')->nullable(false)->change();
        });
    }
};
