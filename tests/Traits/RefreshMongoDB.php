<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\DB;

trait RefreshMongoDb
{
    /**
     * Refresh the test MongoDB database.
     *
     * @return void
     */
    public function refreshTestDatabase()
    {
        $database = DB::connection('mongodb');

        // Get all collections except system collections
        $collections = $database->listCollections();

        foreach ($collections as $collection) {
            $collectionName = $collection->getName();

            // Skip system collections
            if (strpos($collectionName, 'system.') !== 0) {
                $database->selectCollection($collectionName)->drop();
            }
        }

        // Re-create indices if needed
        $this->createIndices();
    }

    /**
     * Create any required indices after refresh.
     * Add your indices here.
     *
     * @return void
     */
    protected function createIndices()
    {
        // Example: Creating an index for users collection
        $usersCollection = DB::connection('mongodb')->getCollection('users');
        $usersCollection->createIndex(['email' => 1], ['unique' => true]);

        // Add more indices as needed
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshTestDatabase();
    }
}
