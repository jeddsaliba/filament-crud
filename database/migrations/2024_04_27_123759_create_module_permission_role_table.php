<?php

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
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
        Schema::create('module_permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->restrictOnDelete()->constrained();
            $table->foreignIdFor(Permission::class)->restrictOnDelete()->constrained();
            $table->foreignIdFor(Role::class)->restrictOnDelete()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_permission_role');
    }
};
