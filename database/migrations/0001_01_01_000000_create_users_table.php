<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    protected $connection = 'mongodb';

    public function up(): void
    {
        Schema::connection($this->connection)->create('users', function (Blueprint $collection) {
            $collection->index('email');  // Ensures no duplicate emails
            $collection->timestamps();
        });


        // Password Reset Tokens
        Schema::connection($this->connection)->create('password_reset_tokens', function (Blueprint $collection) {
            // Index on email since we'll look up tokens by email
            $collection->index('email');
            // Index on token for verification lookups
            $collection->index('token');
            // Laravel expects a created_at timestamp
            $collection->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('users');
        Schema::connection($this->connection)->dropIfExists('password_reset_tokens');
        Schema::connection($this->connection)->dropIfExists('sessions');
    }
};
