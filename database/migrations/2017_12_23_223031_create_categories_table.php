<?php
use Illuminate\Support\Facades\Schema; use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateCategoriesTable extends Migration { public function up() { Schema::create('categories', function (Blueprint $sp6661f4) { $sp6661f4->increments('id'); $sp6661f4->integer('user_id')->index(); $sp6661f4->text('name'); $sp6661f4->integer('sort')->default(1000); $sp6661f4->string('password')->nullable(); $sp6661f4->boolean('password_open')->default(false); $sp6661f4->boolean('enabled'); $sp6661f4->timestamps(); }); } public function down() { Schema::dropIfExists('groups'); } }