<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\State;
use App\Models\Temple;
use App\Models\Contact;
use App\Models\ArtiTime;
use App\Models\Festival;
use App\Models\DarshanTime;
use App\Models\TempleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    // public function indexHome()
    // {
    //     $latitude = 28.6139;
    //     $longitude = 77.2090;
    //     $date = Carbon::now()->toDateString(); // Get today's date (YYYY-MM-DD)
    //     $response = Http::get("https://api.sunrise-sunset.org/json", [
    //         'lat' => $latitude,
    //         'lng' => $longitude,
    //         'date' => $date, // Today's date
    //         'formatted' => 0  // Get UTC time
    //     ]);

    //     $data = $response->json();
    //     $sunrise = Carbon::parse($data['results']['sunrise'])->setTimezone('Asia/Kolkata')->format('h:i A');
    //     $sunset = Carbon::parse($data['results']['sunset'])->setTimezone('Asia/Kolkata')->format('h:i A');
    //     $sun = [$sunrise,$sunset];
    //     $temples = Temple::limit(6)->get();
    //     $images = TempleImage::all();
    //     $darshans = DarshanTime::all();
    //     $artis = ArtiTime::all();
    //     $today = Carbon::today();
    //     $festivals = Festival::where('start_date', '>', $today)
    //         ->orderBy('start_date', 'asc')
    //         ->take(6)
    //         ->get();
    //     $upcomingFestival = Festival::where('start_date', '>', $date)
    //     ->orderBy('start_date', 'asc')
    //     ->first();
    //     return view('home.home2',compact('temples','images','darshans','artis','festivals','sun','upcomingFestival'));
    // }
    public function indexHome(Request $request)
{
    $latitude = 28.6139;
    $longitude = 77.2090;
    $date = Carbon::now()->toDateString();

    $response = Http::get("https://api.sunrise-sunset.org/json", [
        'lat' => $latitude,
        'lng' => $longitude,
        'date' => $date,
        'formatted' => 0
    ]);

    $data = $response->json();
    $sunrise = Carbon::parse($data['results']['sunrise'])->setTimezone('Asia/Kolkata')->format('h:i A');
    $sunset = Carbon::parse($data['results']['sunset'])->setTimezone('Asia/Kolkata')->format('h:i A');
    $sun = [$sunrise, $sunset];

    // // Fetch all states
    // $states = State::where('country_id', '101')->pluck('name', 'name');


    // // Get the selected state from the request
    // $selectedState = $request->input('state');

    // // Fetch temples based on the selected state
    // $query = Temple::query();
    // if (!empty($selectedState)) {
    //     $query->where('state', $selectedState);
    // }
    // $temples = $query->limit(6)->get();
    // Fetch all states
$states = State::where('country_id', '101')->pluck('name', 'name');

// Get selected state and season from request
$selectedState = $request->input('state');
$selectedSeason = $request->input('season');

// Fetch temples based on filters
$query = Temple::query();

if (!empty($selectedState)) {
    $query->where('state', $selectedState);
}

if (!empty($selectedSeason) && $selectedSeason !== 'all') {
    $query->where('season', $selectedSeason);
}

$temples = $query->limit(6)->get();

    $images = TempleImage::all();
    $darshans = DarshanTime::all();
    $artis = ArtiTime::all();
    $today = Carbon::today();
    $festivals = Festival::where('start_date', '>', $today)
        ->orderBy('start_date', 'asc')
        ->take(6)
        ->get();
    $upcomingFestival = Festival::where('start_date', '>', $date)
        ->orderBy('start_date', 'asc')
        ->first();

    return view('home.home2', compact('temples', 'images', 'darshans', 'artis', 'festivals', 'sun', 'upcomingFestival', 'states', 'selectedState'));
}


    public function contactstore(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string'
    ]);

    Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message
    ]);

    return response()->json(['message' => 'Your message has been sent successfully!']);
}

    public function viewtemple($id)
    {
        $temple = Temple::find($id);
        $temple_images = TempleImage::where('temple_id',$id)->get();
        $today = Carbon::today();
        $festivals = Festival::where('temple_id', $id)
            ->where('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();
        return view('home.temple.temple',compact('temple','festivals','temple_images'));
        // dd($id);
    }

    public function festivals()
    {
        // $temple = Temple::find($id);
        $today = Carbon::today();
        // $festivals = Festival::paginate(12);
        $festivals = Festival::where('start_date', '>=', $today)
        ->orderBy('start_date', 'asc')
        ->paginate(9);
        // dd($festivals);
        return view('home.festival.festivals',compact('festivals'));
    }
    public function temples(Request $request)
    {
         // Fetch all states
    $states = State::where('country_id', '101')->pluck('name', 'name');


    // Get the selected state from the request
    $selectedState = $request->input('state');

    // Fetch temples based on the selected state
    $query = Temple::query();
    if (!empty($selectedState)) {
        $query->where('state', $selectedState);
    }
    $temples = $query->paginate(9);
        // $temple = Temple::find($id);
        // $today = Carbon::today();
        $temples = Temple::paginate(9);
        // dd($temples);
        // $festivals = Festival::where('start_date', '>=', $today)
        // ->orderBy('start_date', 'asc')
        // ->paginate(9);
        return view('home.temple.temples',compact('temples','states', 'selectedState'));
    }

    public function singlefestival($id)
    {
        $festival = Festival::findOrFail($id);
        $templeId = $festival->temple_id;

        $templeImages = TempleImage::where('temple_id',$templeId)->get();
        return view('home.festival.festivalSingle',compact('festival','templeImages'));
    }

    public function mahakhumb()
    {
        return view('home.mahakhumb');
    }
}
