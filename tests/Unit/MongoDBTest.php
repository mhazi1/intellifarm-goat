<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use MongoDB\Client;

class MongoDBTest extends TestCase
{

    /**
     * Test if MongoDB connection is successful
     *
     * @return void
     */

    public function test_mongodb_connection()
    {
        try {
            // Test basic connection
            $collection = DB::connection('mongodb')->getCollection('intellifarm');

            // Try to perform a simple operation
            $result = $collection->insertOne(['test' => 'data']);

            // Clean up test data
            $collection->deleteOne(['_id' => $result->getInsertedId()]);

            // If we get here, connection is successful
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->fail('MongoDB connection failed: ' . $e->getMessage());
        }
    }
}
