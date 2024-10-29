<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("test-firebase",function(){
    // $database = app('firebase.database');
    // dd($database);
    // $newPost = $database->getReference('posts')->push([
    //     'title' => 'Post Title',
    //     'content' => 'Post Content',
    // ]);
    // dd($newPost);
    

    try {
        $factory = (new Factory)->withServiceAccount(storage_path('app/sheelFirebase.json'));
        $database = $factory->createDatabase();
    
        // Test writing data to the database
        $testData = [
            'test_key' => 'Test value'
        ];
        $database->getReference('test/data')->set($testData);
    
        // Output result
        dd('Test data added successfully!');
    
    } catch (FirebaseException $e) {
        dd('Error: ' . $e->getMessage());
    }

});
