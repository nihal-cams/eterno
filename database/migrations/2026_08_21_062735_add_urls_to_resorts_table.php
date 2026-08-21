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
        Schema::table('resorts', function (Blueprint $table) {
            $table->string('home_button_url')
                ->nullable()
                ->after('home_button_text');

            $table->string('mega_menu_url')
                ->nullable()
                ->after('mega_menu_image');

            $table->string('book_now_url')
                ->nullable()
                ->after('book_now_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resorts', function (Blueprint $table) {
            $table->dropColumn([
                'home_button_url',
                'mega_menu_url',
                'book_now_url',
            ]);
        });
    }
};
