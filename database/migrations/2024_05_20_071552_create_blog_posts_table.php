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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('blogcat_id');
            $table->integer('user_id');
            $table->string('post_title');
            $table->string('post_slug');
            $table->string('post_image');
            $table->string('post_baniere')->nullable();
            $table->text('short_descp');
            $table->longText('long_descp');

            $table->string('post_title_en');
            $table->string('post_slug_en');
            $table->text('short_descp_en');
            $table->longText('long_descp_en');

            $table->string('post_title_es');
            $table->string('post_slug_es');
            $table->text('short_descp_es');
            $table->longText('long_descp_es');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
