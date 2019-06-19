<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use WaleedAhmad\Pinterest\Facade\Pinterest;

class HomeController extends Controller
{

    /**
     * Show the application index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function getAuthUser(){
        $user = Pinterest::user()->me(array(
            'fields' => 'username,first_name,last_name,image[small,large]'
        ));
        dd($user);
    }

    public function getPins()
    {
        $pins = Pinterest::user()->getMePins();
        dump($pins);
        if($pins->hasNextPage()){
            $more_pins = Pinterest::user()->getMePins([
                'cursor' => $pins->pagination['cursor']
            ]);
            dd($more_pins);
        }
    }

    public function getBoards()
    {
        $boards = Pinterest::user()->getMeBoards();
        dd($boards);
    }

    public function createPin()
    {
        // Create a pin from external source
        Pinterest::pins()->create(array(
            "note"          => "Pin Caption",
            "image_url"     => "https://imgur.com/oSDNUSD",
            "board"         => "waleedahmad/pinterest-laravel"
        ));

        // Create a pin from storage path
        Pinterest::pins()->create(array(
            "note"          => "Pin Caption",
            "image"         => Storage::path('/path/to/your/image.jpg'),
            "board"         => "waleedahmad/laravel-pinterest"
        ));

        // Create ping with base64 encoded image
        Pinterest::pins()->create(array(
            "note"          => "Pin Caption",
            "image_base64"  => "[base64 encoded image]",
            "board"         => "waleedahmad/laravel-pinterest"
        ));
    }

    public function editPin()
    {
        Pinterest::pins()->edit("181692166190244554", array(
            "note"  => "Update Caption"
        ));
    }

    public function getFollowingUsers()
    {
        $users = Pinterest::following()->users();
        dd($users);
    }

    public function getFollowingBoards()
    {
        $boards = Pinterest::following()->boards();
        dd($boards);
    }

    public function getFollowingInterests()
    {
        $interests = Pinterest::following()->interests();
        dd($interests);
    }

    public function followUser(){
        Pinterest::following()->followUser("waleedahmad");
    }

    public function followBoard(){
        Pinterest::following()->followBoard("503066289565421201");
    }

    public function followInterest(){
        Pinterest::following()->followInterest("architecten-911112299766");
    }

    public function unfollowUser(){
        Pinterest::following()->unfollowUser("waleedahmad");
    }

    public function unfollowBoard(){
        Pinterest::following()->unfollowBoard("503066289565421201");
    }

    public function unfollowInterest(){
        Pinterest::following()->unfollowInterest("architecten-911112299766");
    }
}
