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
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('confirmed_at')->nullable()->after('status');
            $table->timestamp('processing_at')->nullable()->after('confirmed_at');
            $table->timestamp('shipped_at')->nullable()->after('processing_at');
            $table->timestamp('delivered_at')->nullable()->after('shipped_at');
            $table->timestamp('cancelled_at')->nullable()->after('delivered_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'confirmed_at',
                'processing_at',
                'shipped_at',
                'delivered_at',
                'cancelled_at'
            ]);
        });
    }
};
