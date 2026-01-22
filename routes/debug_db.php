<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/debug-db', function () {
    try {
        $results = [];

        // 1. Check Table Existence
        $results['has_umkm_table'] = Schema::hasTable('umkm');

        // 2. Check Columns
        if ($results['has_umkm_table']) {
            $results['columns'] = Schema::getColumnListing('umkm');
            
            // Check specific columns
            $results['has_slug'] = Schema::hasColumn('umkm', 'slug');
            $results['has_deleted_at'] = Schema::hasColumn('umkm', 'deleted_at');
            $results['has_status'] = Schema::hasColumn('umkm', 'status');
        }

        // 3. Test Transaction & Select
        try {
            DB::beginTransaction();
            $testSelect = DB::table('umkm')->where('slug', 'test-slug')->exists();
            $results['test_select_result'] = $testSelect;
            DB::rollback();
            $results['transaction_test'] = 'Success';
        } catch (\Exception $e) {
            DB::rollback();
            $results['transaction_test'] = 'Failed: ' . $e->getMessage();
        }

        return $results;
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
});
