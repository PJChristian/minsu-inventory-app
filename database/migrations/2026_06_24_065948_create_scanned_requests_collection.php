<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint; 

return new class extends Migration
{
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scanned_documents', function (Blueprint $collection) {
            // MongoDB handles IDs automatically via '_id' ObjectIds.
            
            // Create an index on the sync state so your dashboard filters pending items fast
            $collection->index('sync_status');
            
            // Create a background index on the timestamp to sort by newest uploads
            $collection->index(['created_at' => -1]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scanned_documents');
    }
};
