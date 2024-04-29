<?php

use App\Models\Project;
use App\Models\Status;
use App\Models\User;
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
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignIdFor(Project::class)->restrictOnDelete()->constrained();
            $table->foreignIdFor(User::class, 'created_by')->restrictOnDelete()->constrained((new User)->getTable());
            $table->foreignIdFor(User::class, 'assigned_to')->restrictOnDelete()->constrained((new User)->getTable());
            $table->foreignIdFor(Status::class)->restrictOnDelete()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeignIdFor(Project::class);
            $table->dropForeignIdFor(User::class, 'created_by');
            $table->dropForeignIdFor(User::class, 'assigned_to');
            $table->dropForeignIdFor(Status::class);
        });
    }
};
