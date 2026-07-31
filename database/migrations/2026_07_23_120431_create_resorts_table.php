<?php

use App\Enums\WebinarStatus;
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
        Schema::create('resorts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('location');
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('status')->default(WebinarStatus::SCHEDULED->value);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resorts');
    }
};