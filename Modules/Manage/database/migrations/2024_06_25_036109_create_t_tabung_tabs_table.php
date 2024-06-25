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
        Schema::create('t_tabung_tabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_tabung_tabs_id');
            $table->unsignedInteger('m_user_access_tabs_id');
            $table->tinyInteger('type_transaction')->default(1)->comment('1 =  IN, 2 = OUT');
            $table->tinyInteger('condition')->default(1)->comment('1 =  filled, 2 = blank');
            $table->char('no_po', 20);
            $table->char('surat_jalan', 50);
            $table->unsignedTinyInteger('m_type_tabs_id');
            $table->char('sender',50);
            $table->char('receiver',50);
            $table->timestamps();
            $table->foreign('m_tabung_tabs_id')->references('id')->on('m_tabung_tabs')->cascadeOnDelete();
            $table->foreign('m_user_access_tabs_id')->references('id')->on('m_user_access_tabs')->cascadeOnDelete();
            $table->foreign('m_type_tabs_id')->references('id')->on('m_type_tabs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tabung_tabs');
    }
};
