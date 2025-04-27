<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Temple;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\ArtiTime;
use App\Models\Donation;
use App\Models\Festival;
use App\Models\DarshanTime;
use App\Models\TempleImage;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function indexUsers(Request $request)
    {
        $users = User::with('userDetails',
        'userDetails.city',
        'userDetails.state',
        'userDetails.country')->get();
        if ($request->ajax()) {
            $users = User::all();
            return response()->json($users);
        }
        // For non-AJAX requests (initial page load), return the view
        return view('admin.users.users', compact('users'));
    }
    public function inquiries(Request $request)
    {
        $contacts = Contact::all();
        if ($request->ajax()) {
            $contacts = Contact::all();
            return response()->json($contacts);
        }
        // For non-AJAX requests (initial page load), return the view
        return view('admin.contacts.contacts', compact('contacts'));
    }
    public function viewInquiries($id)
    {
        $contact = Contact::findOrFail($id); // Fetch the contact record
        return view('admin.contacts.viewContact', compact('contact'));
    }


    public function userdetails($id)
    {
        $user = User::with('userDetails','userDetails.state','userDetails.city','userDetails.country','bookings','donations')->findOrFail($id);
        $totalBookings = $user->bookings()->count();
        $totalDonationAmount = $user->donations()->sum('amount');
        return view('admin.users.userDetails', compact('user', 'totalBookings', 'totalDonationAmount'));
    }
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalActiveuser = User::where('is_verified','true')->count();
        $totalInactiveuser = User::where('is_verified','false')->count();
        $totalBookings = Booking::count();
        $totalDonations = Donation::sum('amount');
        $totalTemples = Temple::count();
        $recentBookings = Booking::with(['user', 'temple'])->latest()->take(5)->get();
        $recentdonations = Donation::with(['user', 'temple'])->latest()->take(5)->get();
        $totaluser = User::where('is_admin', 0)->count();


        // $monthlyDonations = Donation::selectRaw('SUM(amount) as total, MONTH(donation_date) as month')
        // ->whereYear('donation_date', Carbon::now()->year) // Only for the current year
        // ->groupBy('month')
        // ->orderBy('month')
        // ->pluck('total', 'month')
        // ->toArray();
        $dbDriver = DB::connection()->getDriverName();

        $monthQuery = $dbDriver === 'pgsql'
            ? 'EXTRACT(MONTH FROM donation_date)'
            : 'MONTH(donation_date)';

        $monthlyDonations = Donation::selectRaw("SUM(amount) as total, $monthQuery as month")
            ->whereYear('donation_date', Carbon::now()->year) // Only for the current year
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
        $donationsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $donationsData[] = $monthlyDonations[$i] ?? 0;
        }




        return view('admin.admindashboard', compact('totalBookings', 'totalDonations', 'totalTemples','totaluser','recentBookings','donationsData','recentdonations'));
    }

    public function indexTemples(Request $request)
    {
        $temples = Temple::all();
        if ($request->ajax()) {
            $temples = Temple::all();
            return response()->json($temples);
        }
        // For non-AJAX requests (initial page load), return the view
        return view('admin.temple.temples', compact('temples'));
    }
    public function addTemple()
    {
        return view('admin.temple.addtemple');
    }
    public function storeTemple(Request $request)
    {
        $rules = [
            'temple_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits:10',
            'temple_city' => 'required|string',
            'temple_state' => 'required|string',
            'temple_country' => 'required|string',
            'temple_address' => 'required|string|min:30|max:350',
            'temple_desc' => 'required|string|min:100',
            'temple_mainimg' => 'required|image|mimes:jpg,jpeg,png',
            'live_darshan' => 'required',
            'temple_featuredimgs.*' => 'image|mimes:jpg,jpeg,png',
            'temple_season' => 'required',
        ];

        // Conditional validation for Arti and Darshan times
        if ($request->has('arti_switch') && $request->arti_switch) {
            $rules['special_arti_date'] = 'required';
            $rules['special_arti_time'] = 'required_with:special_arti_date';
        }

        if ($request->has('darshan_switch') && $request->darshan_switch) {
            $rules['special_darshan_date'] = 'required';
            $rules['darshan_from'] = 'required_with:special_darshan_date';
            $rules['darshan_to'] = 'required_with:special_darshan_date';
        }

        // Validate the request data with dynamic rules
        $validated = $request->validate($rules);

        // Create the temple record
        $temple = Temple::create([
            'name' => $request->temple_name,
            'email' => $request->email,
            'phone' => $request->mobile,
            'city' => ucfirst(strtolower($request->temple_city)),
            'state' => ucfirst(strtolower($request->temple_state)),
            'country' => ucfirst(strtolower($request->temple_country)),
            'address' => ucfirst(strtolower($request->temple_address)),
            'description' =>ucfirst(strtolower($request->temple_desc)),
            'live_darshan' => $request->live_darshan,
            'season'=> $request->temple_season,
        ]);

        if ($temple) {
            $temple_id = $temple->id;

            // Create main image directory if it doesn't exist
            $basePath = public_path("assets/images/temple/{$temple_id}/mainimage/");

            // Ensure the directory exists
            if (!File::exists($basePath)) {
                File::makeDirectory($basePath, 0777, true);
            }

            // Save the main image
            if ($request->hasFile('temple_mainimg')) {
                $mainImg = $request->file('temple_mainimg');
                $newImageName = 'mainimg.' . $mainImg->getClientOriginalExtension();

                // Move the uploaded image to the desired path
                $mainImgPath = $mainImg->move($basePath, $newImageName);

                // Generate the relative path for the image
                $imageRelativePath = "assets/images/temple/{$temple_id}/mainimage/{$newImageName}";

                // Update temple with main image path
                $temple->update([
                    'main_image' => $imageRelativePath // Store the relative path in the database
                ]);
            }


            // Process featured images
            if ($request->hasFile('temple_featuredimgs')) {
                $featuredImagesPath = public_path("assets/images/temple/{$temple_id}/fetureimages/");
                $dataurlforimg = "assets/images/temple/{$temple_id}/fetureimages/";

                // Ensure the directory exists
                if (!File::exists($featuredImagesPath)) {
                    File::makeDirectory($featuredImagesPath, 0777, true);
                }

                $imageNames = [];

                // Handle file uploads
                foreach ($request->file('temple_featuredimgs') as $file) {
                    $newFileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                    $file->move($featuredImagesPath, $newFileName);
                    $imageNames[] = $newFileName;
                }

                // Insert featured images into the database
                foreach ($imageNames as $imageName) {
                    TempleImage::create([
                        'temple_id' => $temple_id,
                        'image_url' => $dataurlforimg . $imageName, // Use $imageName here, not $newFileName
                        'image_name' => $imageName // Store the correct image name
                    ]);
                }
            }

            // dd($request->special_arti_date);
            // Process Arti time data if the switch is on
            if ($request->has('arti_switch') && $request->arti_switch && $request->filled('special_arti_date') && $request->filled('special_arti_time')) {
                ArtiTime::create([
                    'temple_id' => $temple_id,
                    'date' => $request->special_arti_date,
                    'time' => $request->special_arti_time
                ]);
            }

            // Process Darshan time data if the switch is on
            if ($request->has('darshan_switch') && $request->darshan_switch && $request->filled('special_darshan_date') && $request->filled('darshan_from') && $request->filled('darshan_to')) {
                DarshanTime::create([
                    'temple_id' => $temple_id,
                    'date' => $request->special_darshan_date,
                    'from' => $request->darshan_from,
                    'to' => $request->darshan_to
                ]);
            }

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Temple Added Successfully',
            ], 200);
        }

        // Return failure response if temple creation failed
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while saving the temple.',
        ], 500);
    }

    public function updateTemple(Request $request, $id)
    {
        $temple_id = $id;
        if($temple_id != '')
        {
            $temple = $temple = Temple::findOrFail($id);
            $rules = [
                'temple_name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required|numeric|digits:10',
                'temple_city' => 'required|string',
                'temple_state' => 'required|string',
                'temple_country' => 'required|string',
                'temple_address' => 'required|string|min:50|max:250',
                'temple_desc' => 'required|string|min:150',
                'live_darshan' => 'required',
                'temple_season' => 'required',
            ];
            if ($request->hasFile('temple_mainimg')) {
                $rules['temple_mainimg'] = 'image|mimes:jpg,jpeg,png';
            }
            if ($request->hasFile('temple_featuredimgs')) {
                $rules['temple_featuredimgs.*'] = 'image|mimes:jpg,jpeg,png';
            }
            if ($request->has('arti_switch') && $request->arti_switch) {
                $rules['special_arti_date'] = 'required';
                $rules['special_arti_time'] = 'required_with:special_arti_date';
            }

            if ($request->has('darshan_switch') && $request->darshan_switch) {
                $rules['special_darshan_date'] = 'required';
                $rules['darshan_from'] = 'required_with:special_darshan_date';
                $rules['darshan_to'] = 'required_with:special_darshan_date';
            }
            $validated = $request->validate($rules);

            try {
                $templeupdate = $temple->update([
                    'name' => $request->temple_name,
                    'email' => $request->email,
                    'phone' => $request->mobile,
                    'city' => $request->temple_city,
                    'state' => $request->temple_state,
                    'country' => $request->temple_country,
                    'address' => $request->temple_address,
                    'description' => $request->temple_desc,
                    'live_darshan' => $request->live_darshan,
                    'season' => $request->temple_season,
                ]);
                // dd($request->all());
                if ($request->hasFile('temple_mainimg')) {
                    $basePath = public_path("assets/images/temple/{$temple_id}/mainimage/");

                    // Ensure the directory exists
                    if (!File::exists($basePath)) {
                        File::makeDirectory($basePath, 0755, true);
                    }

                    $mainImg = $request->file('temple_mainimg');
                    $newImageName = 'mainimg.' . $mainImg->getClientOriginalExtension();

                    // Delete existing file if it exists
                    if (File::exists($basePath . $newImageName)) {
                        File::delete($basePath . $newImageName);
                    }

                    // Move the uploaded file
                    $mainImgPath = $mainImg->move($basePath, $newImageName);

                    // Normalize the file path for database storage
                    $relativePath = str_replace(public_path(), '', $mainImgPath);
                    $relativePath = str_replace('\\', '/', $relativePath); // Convert backslashes to forward slashes

                    // Debug the path
                    // dd($relativePath);

                    // Update the database
                    $temple_imgupdate = $temple->update([
                        'main_image' => $relativePath // Save the relative path
                    ]);

                    // dd($temple_imgupdate);
                }
                if ($request->hasFile('temple_featuredimgs')) {
                    $featuredImagesPath = public_path("assets/images/temple/{$temple_id}/fetureimages/");
                    $dataurlforimg = "assets/images/temple/{$temple_id}/fetureimages/";

                    // Ensure the directory exists
                    if (!File::exists($featuredImagesPath)) {
                        File::makeDirectory($featuredImagesPath, 0755, true);
                    }

                    $imageNames = [];

                    // Handle file uploads
                    foreach ($request->file('temple_featuredimgs') as $file) {
                        $newFileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                        $file->move($featuredImagesPath, $newFileName);
                        $imageNames[] = $newFileName;
                    }

                    // Insert featured images into the database
                    foreach ($imageNames as $imageName) {
                        TempleImage::create([
                            'temple_id' => $temple_id,
                            'image_url' => $dataurlforimg . $imageName, // Construct the URL
                            'image_name' => $imageName, // Use the correct image name
                        ]);
                    }
                }


                if ($request->has('arti_switch') && $request->arti_switch && $request->filled('special_arti_date') && $request->filled('special_arti_time')) {
                    if ($request->has('arti_id')  && $request->input('arti_id') !== null) {
                        $arti_id = $request->input('arti_id');
                        $arti = ArtiTime::findOrFail($arti_id);
                        $arti->update([
                            'date' => $request->special_arti_date,
                            'time' => $request->special_arti_time,
                        ]);
                    }else {
                        ArtiTime::create([
                            'temple_id' => $temple_id,
                            'date' => $request->special_arti_date,
                            'time' => $request->special_arti_time
                        ]);
                    }
                }

                if ($request->has('darshan_switch') && $request->darshan_switch && $request->filled('special_darshan_date') && $request->filled('darshan_from') && $request->filled('darshan_to')) {
                    if ($request->has('darshan_id') && $request->input('darshan_id') !== null) {
                        $darshan_id = $request->input('darshan_id');
                        $darshan = DarshanTime::findOrFail($darshan_id);
                        $darshan->update([
                            'date' => $request->special_darshan_date,
                            'from' => $request->darshan_from,
                            'to' => $request->darshan_to
                        ]);
                    }else {
                        DarshanTime::create([
                            'temple_id' => $temple_id,
                            'date' => $request->special_darshan_date,
                            'from' => $request->darshan_from,
                            'to' => $request->darshan_to
                        ]);
                    }
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Temple Updated successfully.',
                ], 200);

            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to update temple.'], 500);
            }
        }

    }
    public function editTemple($id)
    {
        $temple = Temple::with(['images', 'darshanTimes', 'artiTimes'])->find($id);
        $temple->artiTimes = $temple->artiTimes ? $temple->artiTimes->first() : null;
        $temple->darshanTimes = $temple->darshanTimes ? $temple->darshanTimes->first() : null;
        return view('admin.temple.edittemple', compact('temple'));
    }
    public function viewTemple($id)
    {
        $today = Carbon::today();
        $temple = Temple::with(['images', 'darshanTimes', 'artiTimes','festivals'])->find($id);
        $temple->artiTimes = $temple->artiTimes ? $temple->artiTimes->first() : null;
        $temple->darshanTimes = $temple->darshanTimes ? $temple->darshanTimes->first() : null;
        // $temple->festivals = $temple->festivals ? $temple->festivals->all() : null;
        $festivals = Festival::where('temple_id', $id)
            ->where('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();
        return view('admin.temple.viewtemple', compact('temple','festivals'));
    }
    public function deleteTempleImage($id)
    {
        $image = TempleImage::find($id);

        if (!$image) {
            return response()->json(['status' => 'error', 'message' => 'Image not found.'], 404);
        }
        $imagePath = public_path($image->image_url);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();
        return response()->json(['status' => 'success', 'message' => 'Image deleted successfully.']);
    }
    public function deleteTemple($id)
    {
        Temple::destroy($id);
        return response()->json(['message' => 'Temple deleted successfully!','status'=>'success']);
    }
    public function destroyTemple($id)
    {
        Temple::destroy($id);
        return redirect()->route('admin.temples.index');
    }


    // Festivals
    public function indexFestivals(Request $request)
    {
        if ($request->ajax()) {
            $festivalQuery = Festival::with(['temple']);

            $recordsTotal = $festivalQuery->count();

            // Apply search filter if present
            if (!empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $festivalQuery->where(function ($query) use ($searchValue) {
                    $query->whereHas('temple', function ($q) use ($searchValue) {
                        $q->where('name', 'like', "%$searchValue%");
                    })
                    ->orWhere('festival_date', 'like', "%$searchValue%")
                    ->orWhere('name', 'like', "%$searchValue%"); // Assuming festivals also have a name
                });
            }

            $recordsFiltered = $festivalQuery->count();

            // Apply pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $festivals = $festivalQuery
                ->skip($start)
                ->take($length)
                ->get();

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $festivals
            ]);
        }
        $temples = Temple::all();
        return view('admin.festivals.index', compact('temples'));
    }

    public function editFestival($id)
    {
        $festival = Festival::with('temple')->findOrFail($id);
        return response()->json($festival);
    }
    public function storeFestival(Request $request)
    {
        $request->validate([
            'festivalName' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'temple' => 'required|exists:temples,id',
            'festival_desc' => 'required',
            'festival_image' => 'nullable|image|mimes:jpg,jpeg,png' // Ensure it's an image
        ]);

        // ✅ Check if ID exists (Edit Mode)
        $festival = Festival::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->festivalName,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,
                'temple_id' => $request->temple,
                'festival_desc' => $request->festival_desc
            ]
        );

        $festival_id = $festival->id;
        $basePath = public_path("assets/images/festival/{$festival_id}/");

        // ✅ Ensure the directory exists
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0777, true);
        }

        // ✅ Handle Image Upload
        if ($request->hasFile('festival_image')) {
            $file = $request->file('festival_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // ✅ Delete Old Image if Exists
            if ($festival->festival_image) {
                $oldImagePath = public_path($festival->festival_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // ✅ Move the new file
            $file->move($basePath, $filename);

            // ✅ Update festival record with new image
            $festival->update([
                'festival_image' => "assets/images/festival/{$festival_id}/{$filename}"
            ]);
        }

        return response()->json(['success' => 'Festival saved successfully!']);
    }

    public function updateFestival(Request $request, $id)
    {
        $festival = Festival::findOrFail($id);
        $festival->update($request->all());
        return redirect()->route('admin.festivals.index');
    }

    public function destroyFestival($id)
    {
        Festival::destroy($id);
        return redirect()->route('admin.festivals.index');
    }


    // Darshans
    public function indexBookings(Request $request)
    {
        if ($request->ajax()) {
            $bookingsQuery = Booking::with([
                'user',
                'user.userDetails.city',
                'user.userDetails.state',
                'user.userDetails.country',
                'temple'
            ]);

            $recordsTotal = $bookingsQuery->count();

            // Apply search filter if present
            if ($request->search['value']) {
                $searchValue = $request->search['value'];
                $bookingsQuery->where(function ($query) use ($searchValue) {
                    $query->whereHas('user', function ($q) use ($searchValue) {
                        $q->where('first_name', 'like', "%$searchValue%")
                          ->orWhere('last_name', 'like', "%$searchValue%")
                          ->orWhere('email', 'like', "%$searchValue%");
                    })
                    ->orWhereHas('temple', function ($q) use ($searchValue) {
                        $q->where('name', 'like', "%$searchValue%");
                    })
                    ->orWhere('booking_date', 'like', "%$searchValue%");
                });
            }

            $recordsFiltered = $bookingsQuery->count();

            // Apply pagination
            $bookings = $bookingsQuery
                ->skip($request->start)
                ->take($request->length)
                ->get();

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $bookings
            ]);
        }

        return view('admin.bookings.index');
    }


    public function viewBooking($id)

    {
        $booking = Booking::with([
            'user',
            'user.userDetails.city',
            'user.userDetails.state',
            'user.userDetails.country',
            'temple',
            'temple.images'
            ])
        ->where('id', $id)
        ->first();
        // dd($booking);
// dd($booking);
        return view('admin.bookings.viewbooking', compact('booking'));
    }
    public function viewfestival($id)

    {
        $temple = Temple::all();
        $festival = Festival::with([
            'temple',
            'temple.images'
            ])
        ->where('id', $id)
        ->first();
        // dd($booking);
// dd($booking);
        return view('admin.festivals.viewfestival', compact('festival'));
    }
public function destroyBooking($id)
{
    Booking::destroy($id);
    return response()->json([
        'success' => true,
        'message' => 'Booking deleted successfully!'
    ]);
}


    public function createBooking()
    {
        return view('admin.bookings.create');
    }

    public function storeBooking(Request $request)
    {
        Booking::create($request->all());
        return redirect()->route('admin.bookings.index');
    }

    public function editBooking($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        return redirect()->route('admin.bookings.index');
    }


    // Donation Management Methods
    public function indexDonations(Request $request)
    {
        if ($request->ajax()) {
            $donationQuery = Donation::with([
                'user',
                'user.userDetails.city',
                'user.userDetails.state',
                'user.userDetails.country',
                'temple'
            ]);

            $recordsTotal = $donationQuery->count();

            if ($request->search['value']) {
                $searchValue = $request->search['value'];
                $donationQuery->where(function ($query) use ($searchValue) {
                    $query->whereHas('user', function ($q) use ($searchValue) {
                        $q->where('first_name', 'like', "%$searchValue%")
                          ->orWhere('last_name', 'like', "%$searchValue%")
                          ->orWhere('email', 'like', "%$searchValue%");
                    })
                    ->orWhereHas('temple', function ($q) use ($searchValue) {
                        $q->where('name', 'like', "%$searchValue%");
                    })
                    ->orWhere('donation_date', 'like', "%$searchValue%");
                });
            }

            $recordsFiltered = $donationQuery->count();

            // Apply pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $donations = $donationQuery
                ->skip($start)
                ->take($length)
                ->get()
                ->map(function ($donation) {
                    return [
                        'id' => $donation->id,
                        'user' => $donation->user ? [
                            'first_name' => $donation->user->first_name,
                            'last_name' => $donation->user->last_name
                        ] : null,
                        'amount' => $donation->amount,
                        'donation_date' => $donation->donation_date,
                        'receipt_number' => $donation->receipt_number,
                        'temple' => $donation->temple ? ['name' => $donation->temple->name] : null,
                    ];
                });

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $donations
            ]);
        }

        return view('admin.donations.index');
    }


    public function viewDonation($id)

    {
        $donation = Donation::with([
            'user',
            'user.userDetails.city',
            'user.userDetails.state',
            'user.userDetails.country',
            'temple',
            'temple.images'
            ])
        ->where('id', $id)
        ->first();

        // dd($donation);
        return view('admin.donations.viewdonation', compact('donation'));
    }














    public function showDonation($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donations.show', compact('donation'));
    }

    public function generateDonationReceipt($id)
    {
        $donation = Donation::findOrFail($id);
        // Generate receipt logic here
        return view('admin.donations.receipt', compact('donation'));
    }

    // Report Generation Method
    public function generateReports()
    {
        return view('admin.reports.index');
    }

    // Static Pages Methods
    public function indexPages()
    {
        // $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function createPage()
    {
        return view('admin.pages.create');
    }

    public function storePage(Request $request)
    {
        // Page::create($request->all());
        return redirect()->route('admin.pages.index');
    }

    public function editPage($id)
    {
        // $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function updatePage(Request $request, $id)
    {
        // $page = Page::findOrFail($id);
        // $page->update($request->all());
        return redirect()->route('admin.pages.index');
    }

    public function destroyPage($id)
    {
        // Page::destroy($id);
        return redirect()->route('admin.pages.index');
    }
}
