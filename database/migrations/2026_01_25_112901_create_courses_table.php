<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');

            $table->string('course_image')->nullable();
            $table->string('course_title')->nullable();
            $table->string('course_name')->nullable();
            $table->string('course_name_slug')->nullable()->unique();

            $table->longText('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('label')->nullable();
            $table->string('resources')->nullable();
            $table->string('certificate')->nullable();

            $table->decimal('duration', 8, 2)->nullable();

            $table->integer('selling_price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->longText('prerequisites')->nullable();

            // Flags
            $table->tinyInteger('bestseller')->default(0)->comment('0=No, 1=Yes');
            $table->tinyInteger('featured')->default(0)->comment('0=No, 1=Yes');
            $table->tinyInteger('highestrated')->default(0)->comment('0=No, 1=Yes');

            $table->tinyInteger('status')->default(0)->comment('0=Inactive, 1=Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};


