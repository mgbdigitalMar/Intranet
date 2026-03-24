<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Users: birthdays
        Schema::table('users', function (Blueprint $table) {
            $table->index(['birthday']);
        });

        // Absences: status + start_date for queries/alerts
        Schema::table('absences', function (Blueprint $table) {
            $table->index(['status', 'start_date']);
            $table->index('user_id');
        });

        // Purchase requests: status + created_at
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->index(['status', 'created_at']);
            $table->index('user_id');
        });

        // Employees search: simple name index (fulltext if needed later)
        Schema::table('users', function (Blueprint $table) {
            $table->index('name');
            $table->index('department');
            $table->index('position');
        });

        // News events
        Schema::table('news', function (Blueprint $table) {
            $table->index(['type', 'event_date']);
        });

        // Reservations (common pattern)
        if (Schema::hasTable('room_reservations')) {
            Schema::table('room_reservations', function (Blueprint $table) {
                $table->index(['status', 'date']);
                $table->index('user_id');
            });
        }

        if (Schema::hasTable('car_reservations')) {
            Schema::table('car_reservations', function (Blueprint $table) {
                $table->index(['status', 'date']);
                $table->index('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['birthday']);
            $table->dropIndex(['name']);
            $table->dropIndex(['department']);
            $table->dropIndex(['position']);
        });

        Schema::table('absences', function (Blueprint $table) {
            $table->dropIndex(['status', 'start_date']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex(['type', 'event_date']);
        });

        if (Schema::hasTable('room_reservations')) {
            Schema::table('room_reservations', function (Blueprint $table) {
                $table->dropIndex(['status', 'date']);
                $table->dropIndex(['user_id']);
            });
        }

        if (Schema::hasTable('car_reservations')) {
            Schema::table('car_reservations', function (Blueprint $table) {
                $table->dropIndex(['status', 'date']);
                $table->dropIndex(['user_id']);
            });
        }
    }
};

