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
        Schema::create('users', function (Blueprint $table) {
            // 1. id (int(11) AUTO_INCREMENT)
            $table->id(); 

            // 2. name (varchar 100)
            $table->string('name', 100);

            // 3. gender (enum Laki-laki/Perempuan, Nullable)
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();

            // 4. nik (varchar 16, Nullable)
            // Saya sarankan tambahkan ->unique() jika NIK tidak boleh kembar
            $table->string('nik', 16)->nullable(); 

            // 5. ktp (varchar 255, Nullable)
            // Ini nanti akan diisi URL dari Cloudinary
            $table->string('ktp', 255)->nullable();

            // 6. email (varchar 100)
            // Wajib unique untuk login
            $table->string('email', 100)->unique();

            // 7. password (varchar 255)
            $table->string('password');

            // 8. role (enum admin/user, default user)
            $table->enum('role', ['admin', 'user'])->default('user');

            // 9 & 10. created_at & updated_at (timestamp)
            // Laravel otomatis menangani logic current_timestamp
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};