<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('user_id');
            $table->integer('event_id')->index('event_id');
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->timestamp('date');
            $table->string('media')->nullable();
            $table->string('links')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable();
        });

        Schema::create('login_history', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('user_id');
            $table->integer('password');
            $table->string('status');
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('url');
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable();
        });

        Schema::create('password', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->string('password');
            $table->string('password_question')->nullable();
            $table->string('password_answer')->nullable();
            $table->string('active', 50)->default('');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->string('description')->nullable();
            $table->timestamp('begin_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable();
        });

        Schema::create('songs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('artist')->nullable();
            $table->string('title');
            $table->string('lyrics')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('production_date')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('role_id')->nullable()->index('role_id')->default(1);
            $table->string('full_name');
            $table->timestamp('birthdate');
            $table->string('address')->nullable();
            $table->string('paroki')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_tiktok')->nullable();
            $table->string('phone_number')->default('0');
            $table->string('image')->nullable();
            $table->string('email');
            $table->string('description')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('first_attendance');
            $table->timestamp('last_attendance')->nullable();
            $table->decimal('total_attendance', 10, 0)->nullable();
            $table->decimal('attendance_percentage', 10, 0)->nullable();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->string('remember_token')->default('');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable('registration');
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('udpated_by')->nullable('registration');
        });

        Schema::table('attendance', function (Blueprint $table) {
            $table->foreign(['user_id'], 'attendance_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['event_id'], 'attendance_ibfk_2')->references(['id'])->on('events')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('login_history', function (Blueprint $table) {
            $table->foreign(['user_id'], 'login_history_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('password', function (Blueprint $table) {
            $table->foreign(['user_id'], 'password_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['role_id'], 'users_ibfk_1')->references(['id'])->on('roles')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
        
        DB::table('roles')->insert(
            array('name' => 'umat'),
            array('name' => 'admin'),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_ibfk_1');
        });

        Schema::table('password', function (Blueprint $table) {
            $table->dropForeign('password_ibfk_1');
        });

        Schema::table('login_history', function (Blueprint $table) {
            $table->dropForeign('login_history_ibfk_1');
        });

        Schema::table('attendance', function (Blueprint $table) {
            $table->dropForeign('attendance_ibfk_1');
            $table->dropForeign('attendance_ibfk_2');
        });

        Schema::dropIfExists('users');

        Schema::dropIfExists('songs');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('password');

        Schema::dropIfExists('media');

        Schema::dropIfExists('login_history');

        Schema::dropIfExists('events');

        Schema::dropIfExists('attendance');
    }
};
