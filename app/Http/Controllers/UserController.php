<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Temple;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Donation;
use App\Models\Festival;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    private $user;
    public function __construct() {
        $this->user = Auth::user();
    }

    // user profile Code Start **********************
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile.show', compact('user'));
    }
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Define the directory path
        $directory = public_path('assets/images/user/' . $user->id . '/userprofile');

        // Create the directory if it doesn't exist
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Process the uploaded image
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/images/user/' . $user->id . '/userprofile/' . $imageName;

            // Move the file to the designated folder
            $image->move($directory, $imageName);

            // Delete the old profile picture if it exists
            if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                unlink(public_path($user->profile_picture));
            }

            // Save new profile picture path in the database
            $user->profile_picture = $imagePath;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }

    public function userProfile()
    {

        $countries = Country::all(); // Fetch all countries
        $states = State::all(); // Fetch all states
        $cities = City::all(); // Fetch all cities

        $user = User::with('userDetails')->findOrFail(Auth::user()->id);
        $selectedCountryId = $user->userDetails->country['id'] ?? null; // Get selected country ID
        $selectedStateId = $user->userDetails->state['id'] ?? null; // Get selected state ID
        $selectedCityId = $user->userDetails->city['id'] ?? null; // Get selected city ID
        $totalAmount = Donation::where('user_id', Auth::id())->sum('amount');
        $totalBookings = Booking::where('user_id', Auth::id())->count();


        $user = Auth::user();
        if($user->is_admin == 1)
        {
            return view('admin.adminprofile', compact('totalAmount','user','countries', 'states', 'cities', 'selectedCountryId', 'selectedStateId', 'selectedCityId'));
        }
        else{
            return view('user.userprofile', compact('totalBookings','totalAmount','user','countries', 'states', 'cities', 'selectedCountryId', 'selectedStateId', 'selectedCityId'));
        }
    }

    public function getCountries()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    // Get states based on selected country
    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states);
    }

    // Get cities based on selected state
    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json($cities);
    }

    public function getLocationData($type, $parentId = null)
    {
        switch ($type) {
            case 'country':
                $data = Country::all();  // Fetch all countries
                break;

            case 'state':
                $data = State::where('country_id', $parentId)->get();  // Fetch states based on country ID
                break;

            case 'city':
                $data = City::where('state_id', $parentId)->get();  // Fetch cities based on state ID
                break;

            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }

        return response()->json($data);
    }

    public function userDetails(Request $request)
    {
        $country = $request->input('country');

        $rules = [
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'dob' => 'required|date',
        ];

        if ($country == 101 ) {
            $rules['adhar_no'] = 'required|digits:12';
            $rules['adhar_img'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'; // Max size: 2MB
            $rules['pan_no'] = 'required|string|size:10';
            // $rules['Pancard_img'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'; // Max size: 2MB
        }

        $validatedData = $request->validate($rules);

        try {
            $user = Auth::user();
            $userId = $user->id;
            $basePath = public_path("assets/images/user/{$userId}");
            $adharCardPath = "{$basePath}/adharcard";
            $panCardPath = "{$basePath}/pancard";
            $passportPath = "{$basePath}/passport";

            // Conditionally process the Aadhar and Pancard images if they are present in the request
            $adharImgPath = null;
            $panImgPath = null;
            $passportImgPath = null;

            if ($country == 101) {
                if ($request->hasFile('adhar_img')) {
                    // Check if the old file exists and delete it
                    if (File::exists($adharCardPath . '/' . $request->input('old_adhar_img'))) {
                        File::delete($adharCardPath . '/' . $request->input('old_adhar_img'));
                    }

                    // Create directory if it doesn't exist
                    if (!File::exists($adharCardPath)) {
                        File::makeDirectory($adharCardPath, 0777, true);
                    }

                    // Move the uploaded image
                    $adharImgPath1 = $request->file('adhar_img')->move($adharCardPath, $request->file('adhar_img')->getClientOriginalName());
                    $adharImgPath = str_replace(public_path(), '', $adharImgPath1);
                    $adharImgPath = str_replace('\\', '/', $adharImgPath);
                }

                if ($request->hasFile('Pancard_img')) {
                    // Check if the old file exists and delete it
                    if (File::exists($panCardPath . '/' . $request->input('old_pancard_img'))) {
                        File::delete($panCardPath . '/' . $request->input('old_pancard_img'));
                    }

                    // Create directory if it doesn't exist
                    if (!File::exists($panCardPath)) {
                        File::makeDirectory($panCardPath, 0777, true);
                    }

                    // Move the uploaded image
                    $panImgPath1 = $request->file('Pancard_img')->move($panCardPath, $request->file('Pancard_img')->getClientOriginalName());
                    $panImgPath = str_replace(public_path(), '', $panImgPath1);
                    $panImgPath = str_replace('\\', '/', $panImgPath);
                }
            } else {
                if ($request->hasFile('passport_img')) {
                    // Check if the old file exists and delete it
                    if (File::exists($passportPath . '/' . $request->input('old_passport_img'))) {
                        File::delete($passportPath . '/' . $request->input('old_passport_img'));
                    }

                    // Create directory if it doesn't exist
                    if (!File::exists($passportPath)) {
                        File::makeDirectory($passportPath, 0777, true);
                    }

                    // Move the uploaded image
                    $passportImgPath1 = $request->file('passport_img')->move($passportPath, $request->file('passport_img')->getClientOriginalName());
                    $passportImgPath = str_replace(public_path(), '', $passportImgPath1);
                    $passportImgPath = str_replace('\\', '/', $passportImgPath);
                }
            }

            if($this->user->details_complete)
            {
                $userDetails = UserDetails::where('user_id', $userId)->first();
                $userdetailupdate = $userDetails->update([
                    'country_id' => $validatedData['country'],
                    'state_id' => $validatedData['state'],
                    'city_id' => $validatedData['city'],
                    'pincode' => $validatedData['pincode'],
                    'dob' => $validatedData['dob'],
                    'adhar_card_number' => $request->input('adhar_no', $userDetails->adhar_card_number),
                    'pan_card_number' => $request->input('pan_no', $userDetails->pan_card_number),
                    'passport_number' => $request->input('passport_no', $userDetails->passport_number),
                    'adhar_card_image' => $adharImgPath ? : $userDetails->adhar_card_image,
                    'pan_card_image' => $panImgPath ? : $userDetails->Pan_card_img,
                    'passport_image' => $passportImgPath ? : $userDetails->passport_image
                ]);


                if($userdetailupdate)
                {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Necessary details Updated successfully.',
                    ], 200);

                }

            }else {
                $necessaryDetails = UserDetails::create([
                    'user_id' => $userId,
                    'country_id' => $validatedData['country'],
                    'state_id' => $validatedData['state'],
                    'city_id' => $validatedData['city'],
                    'pincode' => $validatedData['pincode'],
                    'dob' => $validatedData['dob'],
                    'adhar_card_number' => $request->input('adhar_no', null),
                    'pan_card_number' => $request->input('pan_no', null),
                    'passport_number' =>   $request->input('passport_no', null),
                    'adhar_card_image' => $adharImgPath ?  : null,
                    'pan_card_image' => $panImgPath ?  : null,
                    'passport_image' => $passportImgPath ? : null

                ]);
                if($necessaryDetails)
                {
                    $userupdate = User::where('id', $userId)->update([
                        'details_complete' => true,
                    ]);
                    if($userupdate)
                    {
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Necessary details Saved successfully.',
                        ], 200);
                    }

                }
            }


        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while processing the form.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function  dashboard()
    {
        $totalTempleVisit = Booking::where('user_id', Auth::id())->count();
        $totalDonationCount = Donation::where('user_id', Auth::id())->count();
        $totalDonationAmount = Donation::where('user_id', Auth::id())->sum('amount');
        $lastTempleVisits = Booking::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
        $upcomingFestivals = Festival::with('temple')
        ->orderBy('start_date', 'asc')
        ->limit(5)
        ->get();
        $temples = Temple::get();

        return view('user.userdashboard',compact('totalTempleVisit','totalDonationCount','totalDonationAmount','lastTempleVisits','upcomingFestivals','temples'));
    }

    public function temples(Request $request)
    {
        $temples = Temple::paginate(10);


        if ($request->ajax()) {
            $temples = Temple::paginate(10);
            return response()->json($temples);
        }
        return view('user.temple.temples', compact('temples'));
    }

    // Temple Details
    public function showTemple($id)
    {
        $today = Carbon::today();
        $temple = Temple::with(['images', 'darshanTimes', 'artiTimes','festivals'])->find($id);
        $temple->artiTimes = $temple->artiTimes ? $temple->artiTimes->first() : null;
        $temple->darshanTimes = $temple->darshanTimes ? $temple->darshanTimes->first() : null;
        $temple->festivals = $temple->festivals ? $temple->festivals->all() : null;
        $festivals = Festival::where('temple_id', $id)
            ->where('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();
        return view('user.temple.viewtemple', compact('festivals','temple'));
    }

    // Book a Visit
    public function bookTemple(Request $request)
    {
        $request->validate([
            'temple_id' => 'required|exists:temples,id',
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
        ]);
        $receipt_number = mt_rand(100000, 999999);
        $booking_id = strtoupper(substr(md5(uniqid()), 0, 10));
        $temple = Temple::where('id',$request->temple_id)->first();
        $booking = Booking::create([
            'user_id' => Auth::id() ?? $request->user_id,
            'temple_id' => $request->temple_id,
            'booking_date' => $request->booking_date,
            'receipt_number'=> $receipt_number,
            'booking_id' => $booking_id,
        ]);
        $basePath = public_path("assets/images/BookingInvoice/");

        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0777, true, true);
        }
        $fileName = "BookingReceipt_" .$receipt_number.".pdf";
        $filePath = $basePath . $fileName;

        $pdf = Pdf::loadView('pdf.booking_receipt', ['booking' => $booking , 'temple' => $temple]);
        $pdf->save($filePath);

        $invoicepath = str_replace(public_path(), '', $filePath);
        $invoicepath = str_replace('\\', '/', $invoicepath);

        $BookingData = Booking::find($booking->id);
        $Bookingupdate = $BookingData->update([
            'invoice' => $invoicepath,
            'invoice_name' => $fileName
        ]);

        if($Bookingupdate)
        {
            return response()->json([
                'success' => true,
                'message' => 'Donation processed successfully!',
                'file_path' => asset($invoicepath) // Correct file path for JavaScript
            ]);
        }
    }

    // List User Bookings
    public function bookings(Request $request)
    {
        $bookings = Booking::where('user_id', Auth::id())->with('temple')->paginate(10);
        if ($request->ajax()) {
            $bookings = Booking::where('user_id', Auth::id())->with('temple')->paginate(10);
            return response()->json($bookings);
        }
        return view('user.bookings.index', compact('bookings'));
    }

    // View Booking Details
    public function showBooking($id)
    {
        $booking = Booking::where('user_id', Auth::id())->with('temple')->findOrFail($id);
        return view('user.bookings.show', compact('booking'));
    }

    // Make a Donation
    public function donate(Request $request)
    {
        $referenceNumber = mt_rand(100000, 999999);
        $transactionID = 'TID' . strtoupper(substr(md5(uniqid()), 0, 10));

        // Donation data
        $donation = Donation::create([
                        'user_id' => Auth::id() ?? null,
                        'temple_id' => $request->temple_id,
                        'amount' => $request->amount,
                        'payment_method' => $request->payment_method,
                        'receipt_number' => $referenceNumber,
                        'transaction_id' => $transactionID,
                        'donation_date' => now(),
                    ]);

                    $temple = Temple::firstWhere('id',$request->temple_id);
                    if(Auth::check())
                    {
                        $user = User::with('userDetails')->firstWhere('id',Auth::id());
                    }else
                    {
                        $user = null;
                    }
                    // dd($donation);

        // Define the base path inside the public directory
        $basePath = public_path("assets/images/DonationInvoice/");

        // Ensure the directory exists
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0777, true, true);
        }

        // Define file name and path
        $fileName = "DonationReceipt_" .$referenceNumber.".pdf";
        $filePath = $basePath . $fileName;

        // Generate PDF
        $pdf = Pdf::loadView('pdf.donation_receipt', compact('donation', 'user', 'temple'))->setOption('enable-local-file-access', true); ;

        // Save PDF to the specified path
        $pdf->save($filePath);

        $invoicepath = str_replace(public_path(), '', $filePath);
        $invoicepath = str_replace('\\', '/', $invoicepath);
        $DonationData = Donation::find($donation->id);
        $Donationupdate = $DonationData->update([
            'invoice' => $invoicepath,
            'invoice_name' => $fileName
        ]);

        if($Donationupdate)
        {
            return response()->json([
                'success' => true,
                'message' => 'Donation processed successfully!',
                'file_path' => asset($invoicepath) // Correct file path for JavaScript
            ]);
        }
    }
    public function downloadReceipt($filename)
    {
        $filePath = public_path("assets/images/DonationInvoice/{$filename}");

        if (!file_exists($filePath)) {
            abort(404, "Receipt not found.");
        }

        return response()->download($filePath);
    }

    public function donations(Request $request)
    {
        if ($request->ajax()) {
            $donations = Donation::where('user_id', Auth::id())->with('temple')->select('donations.*');

            return DataTables::of($donations)
                ->addColumn('DT_RowIndex', function ($row) {
                    return '<strong>' . ($row->id) . '</strong>'; // Row index
                })
                ->addColumn('action', function ($row) {
                    $downloadUrl = asset($row->invoice);
                    return '<a href="' . $downloadUrl . '" download class="btn btn-warning">
                                Donation Receipt
                            </a>';
                })
                ->rawColumns(['action', 'DT_RowIndex']) // Allow raw HTML
                ->make(true);
        }

        return view('user.donations.index');
    }
    // View Donation Details
    public function showDonation($id)
    {
        $donation = Donation::where('user_id', Auth::id())->with('temple')->findOrFail($id);
        return view('user.donations.show', compact('donation'));
    }

}
