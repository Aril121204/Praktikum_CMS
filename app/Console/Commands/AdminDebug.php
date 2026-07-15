<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Buat admin baru dengan cepat';

    public function handle()
    {
        $this->info('🔧 MEMBUAT ADMIN BARU...');
        
        $name = $this->ask('Nama admin', 'Super Admin');
        $email = $this->ask('Email admin', 'admin@asiaphone.com');
        $password = $this->secret('Password (minimal 6 karakter)') ?? 'admin123';

        if (strlen($password) < 6) {
            $this->error('❌ Password minimal 6 karakter!');
            return 1;
        }

        // Cek apakah email sudah ada
        $existing = DB::table('users')->where('EMAIL', $email)->first();
        if ($existing) {
            $this->error('❌ Email sudah terdaftar!');
            return 1;
        }

        try {
            DB::table('users')->insert([
                'NAME' => $name,
                'EMAIL' => $email,
                'EMAIL_VERIFIED_AT' => now(),
                'PASSWORD' => Hash::make($password),
                'ROLE' => 'admin',
                'CREATED_AT' => now(),
                'UPDATED_AT' => now(),
            ]);

            $this->info('');
            $this->info('✅ ADMIN BERHASIL DIBUAT!');
            $this->info('');
            $this->info('📧 Email: ' . $email);
            $this->info('🔑 Password: ' . $password);
            $this->info('');
            $this->warn('⚠️  Login di: http://localhost:8000/admin/login');
            
            return 0;
        } catch (\Exception $e) {
            $this->error('❌ ERROR: ' . $e->getMessage());
            return 1;
        }
    }
}