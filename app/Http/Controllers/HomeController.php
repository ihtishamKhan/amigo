<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        $total_orders = Order::count();
        $completed_orders = Order::where('status', 'completed')->count();
        $cancelled_orders = Order::where('status', 'Cancelled')->count();
        $revenue = Order::where('status', 'completed')->sum('total');

        // Prepare data for the last 7 days chart
        $dates = [];
        $orders_data = [];
        $delivered_data = [];
        $cancelled_data = [];

        // Generate the last 7 days dates
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = \Carbon\Carbon::now()->subDays($i)->format('M d'); // Format: Jan 01
        }

        // Count orders by status for each day
        foreach ($dates as $index => $formatted_date) {
            $date = \Carbon\Carbon::now()->subDays(6 - $index)->format('Y-m-d');
            
            // Count all orders for this day
            $orders_data[] = Order::whereDate('created_at', $date)->count();
            
            // Count completed orders for this day
            $completed_data[] = Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->count();
            
            // Count cancelled orders for this day
            $cancelled_data[] = Order::whereDate('created_at', $date)
                ->where('status', 'cancelled')
                ->count();
        }

        // Convert data to JSON for JavaScript
        $chart_data = [
            'dates' => $dates,
            'orders' => $orders_data,
            'completed' => $completed_data,
            'cancelled' => $cancelled_data
        ];

        // dd($chart_data);

        return view('index', compact(
            'total_orders', 
            'completed_orders', 
            'cancelled_orders', 
            'revenue', 
            'chart_data'
        ));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar = '/images/' . $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
