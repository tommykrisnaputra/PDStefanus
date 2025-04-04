<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('attendance', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->integer('user_id')->index('user_id');
            $table->integer('event_id')->index('event_id');
            $table->timestamp('date')
                ->nullable()
                ->useCurrent();
            $table->mediumText('description')->nullable();
            $table->boolean('active')->default(TRUE);
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::create('events', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->string('title');
            $table->timestamp('date');
            $table->string('media')->nullable();
            $table->string('links')->nullable();
            $table->string('address')->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('active')->default(TRUE);
            $table->integer('order_number')->nullable();
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::create('tema_pd', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->string('title');
            $table->timestamp('date');
            $table->string('media')->nullable();
            $table->string('links')->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('active')->default(TRUE);
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::create('login_history', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->integer('user_id')->index('user_id');
            $table->integer('password');
            $table->string('status');
            $table->mediumText('description')->nullable();
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::create('media', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->string('name');
            $table->string('url');
            $table->mediumText('description')->nullable();
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->string('name');
            $table->string('image')->nullable();
            $table->boolean('active')->default(TRUE);
            $table->mediumText('description')->nullable();
            $table->timestamp('begin_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::create('songs', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->string('artist')->nullable();
            $table->string('title');
            $table->string('lyrics')->nullable();
            $table->mediumText('description')->nullable();
            $table->timestamp('production_date')->nullable();
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table
                ->integer('role_id')
                ->nullable()
                ->index('role_id')
                ->default(1);
            $table->string('full_name');
            $table->timestamp('birthdate');
            $table->string('address')->nullable();
            $table->string('wilayah')->nullable();
            $table->string('paroki')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_tiktok')->nullable();
            $table->string('phone')->default('0');
            $table->string('image')->nullable();
            $table->string('email');
            $table->mediumText('description')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('last_aba');
            $table->timestamp('first_attendance');
            $table->timestamp('last_attendance')->nullable();
            $table->decimal('total_attendance', 10, 0)->nullable();
            $table->decimal('attendance_percentage', 10, 0)->nullable();
            $table->string('password');
            $table->boolean('active')->default(TRUE);
            $table->string('remember_token')->default('');
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable('registration');
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable('registration');
            });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
            });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            });


        Schema::create('team_attendances', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->integer('user_id')->index('user_id');
            $table->integer('team_event_id')->index('team_event_id');
            $table->timestamp('date')
                ->nullable()
                ->useCurrent();
            $table->mediumText('description')->nullable();
            $table->boolean('active')->default(TRUE);
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });


        Schema::create('team_events', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->string('title');
            $table->timestamp('date');
            $table->mediumText('description')->nullable();
            $table->boolean('active')->default(TRUE);
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });


        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            });

        Schema::create('parameters', function (Blueprint $table) {
            $table->integer('id', TRUE);
            $table->string('name');
            $table->string('value');
            $table->timestamp('date');
            $table->string('description');
            });

        Schema::create('aba', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index('user_id');
            $table->mediumText('verses')->nullable();
            $table->timestamp('date');
            $table->mediumText('description')->nullable();
            $table
                ->timestamp('created_at')
                ->nullable()
                ->useCurrent();
            $table->integer('created_by')->nullable();
            $table
                ->timestamp('updated_at')
                ->useCurrentOnUpdate()
                ->nullable()
                ->useCurrent();
            $table->integer('updated_by')->nullable();
            });

        Schema::table('attendance', function (Blueprint $table) {
            $table
                ->foreign(['user_id'], 'attendance_ibfk_1')
                ->references(['id'])
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
            $table
                ->foreign(['event_id'], 'attendance_ibfk_2')
                ->references(['id'])
                ->on('events')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
            });

        Schema::table('login_history', function (Blueprint $table) {
            $table
                ->foreign(['user_id'], 'login_history_ibfk_1')
                ->references(['id'])
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
            });

        Schema::table('users', function (Blueprint $table) {
            $table
                ->foreign(['role_id'], 'users_ibfk_1')
                ->references(['id'])
                ->on('roles')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
            });

        Schema::table('team_attendances', function (Blueprint $table) {
            $table
                ->foreign(['user_id'], 'team_attendances_ibfk_1')
                ->references(['id'])
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
            $table
                ->foreign(['team_event_id'], 'team_attendances_ibfk_2')
                ->references(['id'])
                ->on('team_events')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
            });

        DB::table('roles')->insert([
            [
                'name' => 'umat',
            ],
            [
                'name' => 'admin',
            ],
            [
                'name' => 'tim',
            ],
        ]);

        DB::table('users')->insert([
            [
                'role_id'          => 2,
                'full_name'        => 'PD Stefanus',
                'birthdate'        => '2023-03-24',
                'address'          => 'Jl. Satria IV No.Blok C',
                'wilayah'          => 'Jelambar',
                'paroki'           => 'Kristoforus',
                'social_instagram' => 'pdstefanus',
                'social_tiktok'    => 'pdstefanus',
                'phone'            => '087877828233',
                'email'            => 'stefan_news@yahoo.com',
                'first_attendance' => '2023-03-24',
                'last_attendance'  => '2023-03-24',
                'password'         => Hash::make('adminstefanus'),
                'active'           => TRUE,
            ],
        ]);

        DB::table('tema_pd')->insert([
            [
                'title'       => 'The Art of Giving',
                'date'        => '2023-03-16',
                'media'       => 'https://i.imgur.com/Waty6k8.jpg',
                'links'       => 'https://www.instagram.com/p/Cpws0qXPZvC/?utm_source=ig_web_copy_link',
                'description' => 'Deskripsi Pujian',
            ],
            [
                'title'       => 'B.R.E.A.D',
                'date'        => '2023-03-09',
                'media'       => 'https://i.imgur.com/rE3wWTe.jpg',
                'links'       => 'https://www.instagram.com/p/CpegnvHv3ej/?utm_source=ig_web_copy_link',
                'description' => 'Deskripsi Dance',
            ],
            [
                'title'       => 'Divergent',
                'date'        => '2023-03-02',
                'media'       => 'https://i.imgur.com/SiaQ9hm.jpg',
                'links'       => 'https://www.instagram.com/p/CpMccqdPrUu/?utm_source=ig_web_copy_link',
                'description' => 'Deskripsi Divergent',
            ],
        ]);

        DB::table('events')->insert([
            [
                'title'        => 'Pujian',
                'date'         => '2023-03-30',
                'media'        => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/County_Dublin_-_Holmpatrick_Church_of_Ireland_Church_-_20190615195717.jpg/1200px-County_Dublin_-_Holmpatrick_Church_of_Ireland_Church_-_20190615195717.jpg',
                'links'        => 'https://www.instagram.com/reel/Co6EEAphLdQ/?utm_source=ig_web_copy_link',
                'description'  => 'Tim Pujian PD Stefanus adalah wadah untuk kalian yang punya kerinduan memuji & menyembah Tuhan lewat talenta bernyanyi & bermain musik. Latian Pujian diadakan setiap hari selasa pukul 7 malam. Yuk join kita untuk sama-sama bernyanyi & memuji Tuhan!',
                'order_number' => 1,
            ],
            [
                'title'        => 'Dance',
                'date'         => '2023-03-30',
                'media'        => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJRKwHTcmdDwIqcloCC076mxpFa0oP6Nizjw&usqp=CAU',
                'links'        => 'https://www.instagram.com/reel/CqF_KDXgA47/?utm_source=ig_web_copy_link',
                'description'  => 'Dance ministry pd stefanus adalah suatu wadah untuk kalian yang punya hobi dan bakat menari. Di dance ministry, kita gak hanya undang pelatih dari luar, tapi kita juga bisa buat koreo sendiri ato cover dari youtube. Latian kita diadakan pada hari senin pukul 7 malam.',
                'order_number' => 2,
            ],
            [
                'title'        => 'Kombas',
                'date'         => '2023-03-30',
                'media'        => 'https://holynamewinfield.org/images/stories/rotator/rd2022/rotator1.jpg',
                'links'        => 'https://www.instagram.com/reel/Cnn3ncQoJSL/?utm_source=ig_web_copy_link',
                'description'  => 'Deskripsi Kombas',
                'order_number' => 3,
            ],
            [
                'title'        => 'PD Stefanus',
                'date'         => '2023-03-30',
                'media'        => 'https://www.imb.org/wp-content/uploads/2016/08/Local-Church.jpg',
                'links'        => 'https://pdstefanusgrogol.com/',
                'description'  => 'PD Stefanus di adakan setiap hari kamis malam pukul 19.00 WIB',
                'order_number' => 4,
            ],
        ]);

        DB::table('parameters')->insert([
            [
                'name'        => 'ABA Start',
                'value'       => '',
                'date'        => now(),
                'description' => 'Perhitungan ABA awal',
            ],
            [
                'name'        => 'ABA End',
                'value'       => '',
                'date'        => now(),
                'description' => 'Tanggal hari ini',
            ],
        ]);
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_ibfk_1');
            });

        Schema::table('login_history', function (Blueprint $table) {
            $table->dropForeign('login_history_ibfk_1');
            });

        Schema::table('attendance', function (Blueprint $table) {
            $table->dropForeign('attendance_ibfk_1');
            $table->dropForeign('attendance_ibfk_2');
            });

        Schema::table('team_attendances', function (Blueprint $table) {
            $table->dropForeign('team_attendances_ibfk_1');
            $table->dropForeign('team_attendances_ibfk_2');
            });

        Schema::dropIfExists('users');
        Schema::dropIfExists('songs');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('media');
        Schema::dropIfExists('login_history');
        Schema::dropIfExists('events');
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('tema_pd');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('team_attendances');
        Schema::dropIfExists('team_events');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('aba');

        }
    };
