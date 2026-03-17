<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSocialLink;
use App\UserStatus;
use App\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Semeia a tabela de Users no banco de dados
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'username' => 'admin',
            'password' => Hash::make('12345'),
            'type' => UserType::SuperAdmin,
            'status' => UserStatus::Active,
        ]);

        UserSocialLink::create([
            'user_id' => 1,
            'facebook_url' => '',
            'instagram_url' => 'https://www.instagram.com/victorbalena/',
            'youtube_url' => '',
            'linkedin_url' => 'https://www.linkedin.com/in/victor-balena-9502a2310/',
            'x_url' => '',
            'github_url' => 'https://github.com/balenaV',
        ]);

    }
}
