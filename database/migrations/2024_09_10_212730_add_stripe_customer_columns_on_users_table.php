<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_id')->nullable()->index()->comment('customer id');
            $table->string('pm_id')->nullable()->index()->comment('Payment method id');
            $table->string('pm_type')->nullable()->comment('Payment method type');
            $table->string('pm_last_four', 4)->nullable()->comment('Payment method last digits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex([
                'stripe_id',
                'pm_id',
            ]);

            $table->dropColumn([
                'stripe_id',
                'pm_type',
                'pm_last_four',
            ]);
        });
    }
};
