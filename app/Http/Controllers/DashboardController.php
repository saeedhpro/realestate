<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\Employee;
use App\EstateType;
use App\Gallery;
use App\Property;
use App\RealEstate;
use App\Upload;
use App\User;
use App\VrTour;
use http\Env\Response;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    use Authenticatable;

    public function dashboard()
    {
        $user = Auth::user();
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        return view('dashboard.dashboardlayout', compact('user', 'vrads'));
    }

    public function showAdvertises()
    {
        $user = Auth::user();
        if($user ->type == User::USER){
            $advertises = Advertise::where('user_id', '=', $user->id)->orderBy('created_at', 'desc');
        } else{
            $advertises = Advertise::where('real_estate_id', '=', $user->real_estate->id)->orderBy('created_at', 'desc');
        }
        $advertises = $advertises->paginate(10);
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        return view('dashboard.advertise.index', compact('user', 'advertises', 'vrads'));
    }

    public function storeAdvertise(Request $request)
    {
        /** @var Advertise $advertise */
        $advertise = Advertise::create([
            'estate_type_id' => $request->estate_type_id,
            'advertise_type' => $request->advertise_type,
            'title' => $request->title,
            'area' => $request->area,
            'room' => $request->room,
            'age' => $request->age,
            'description' => $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address' => $request->address,
            'real_estate_id' => 1,
            'state_id' => 30,
            'city_id' => 1225,
            'is_active' => false,
            'is_pro' => false,
            'is_escrow' => true,
            'want_vr_tour' => $request->want_vr_tour == true,
            'has_elevator' => $request->has_elevator == true,
            'has_parking' => $request->has_parking == true,
            'unit' => $request->units,
            'in_floor' => $request->unit,
            'floor' => $request->floors,
            'unit_price' => (double) $request->sell / (double) $request->area,
            'sell' => $request->sell,
            'rent' => $request->rent
        ]);
        $advertise->save();
        if($request->images) {
            foreach ($request->images as $image) {
                $upload = Upload::find($image);
                $gallery = Gallery::create([
                    'advertise_id' => $advertise->id,
                    'path' => $upload->path,
                ]);
                $gallery->save();
            }
        }
        if($request->props) {
            $advertise->properties()->sync($request->props);
        }
        return $advertise;
    }
    public function updateAdvertise(Request $request, int $id)
    {
        /** @var Advertise $advertise */
        $advertise = Advertise::find($id);
        if(!$advertise){
            return view('main.404');
        }
        $advertise->update([
            'estate_type_id' => $request->estate_type_id,
            'advertise_type' => $request->advertise_type,
            'title' => $request->title,
            'area' => $request->area,
            'room' => $request->room,
            'age' => $request->age,
            'description' => $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address' => $request->address,
            'real_estate_id' => 1,
            'state_id' => 30,
            'city_id' => 1225,
            'is_active' => false,
            'is_pro' => false,
            'is_escrow' => true,
            'want_vr_tour' => $request->want_vr_tour == true,
            'has_elevator' => $request->has_elevator == true,
            'has_parking' => $request->has_parking == true,
            'unit' => $request->units,
            'in_floor' => $request->unit,
            'floor' => $request->floors,
            'unit_price' => (double) $request->sell / (double) $request->area,
            'sell' => $request->sell,
            'rent' => $request->rent
        ]);
        $advertise->save();
        if($request->images) {
            foreach ($request->images as $image) {
                $upload = Upload::find($image);
                $gallery = Gallery::create([
                    'advertise_id' => $advertise->id,
                    'path' => $upload->path,
                ]);
                $gallery->save();
            }
        }
        if($request->props) {
            $advertise->properties()->sync($request->props);
        }
        return $advertise;
    }

    public function showAdvertise(int $id)
    {

    }

    public function editAdvertise(int $id)
    {
        $user = Auth::user();
        $advertise = Advertise::find($id);
        if(!$advertise){
            return view('main.404');
        }
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        $props = Property::all();
        $estate_types = EstateType::all();
        if($advertise->lat){
            $centerLat = $advertise->lat;
        } else {
            $centerLat = 34.79825358991698;
        }
        if($advertise->lng){
            $centerLng = $advertise->lng;
        } else {
            $centerLng = 48.51484869170237;
        }
        if($advertise){
            return view('dashboard.advertise.edit', compact('advertise', 'user', 'vrads', 'props', 'estate_types', 'centerLat', 'centerLng'));
        }
    }

    public function createAdvertise()
    {
        $user = Auth::user();
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        $estate_types = EstateType::all();
        $props = Property::all();
        return view('dashboard.advertise.create', compact('user', 'vrads', 'estate_types', 'props'));
    }

    public function destroyAdvertise(int $id)
    {
        $advertise = Advertise::find($id);
        if($advertise){
            if($advertise->delete()){
                $gallery = $advertise->gallery;
                foreach ($gallery as $g){
                    $path = $g->path;
                    if($g->delete()){
                        unlink($g->path);
                    }
                }
                return response()->json(['message'=>'آگهی با موفقیت حذف شد!'], 200);
            } else {
                return response()->json(['message'=>'متاسفانه خطایی رخ داده است!'], 404);
            }
        } else {
            return view('main.404');
        }
    }

    public function destroyGallery(int $id, int $gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        if($gallery){
            if($gallery->advertise->id == $id){
                unlink($gallery->path);
                $gallery->delete();
                return response()->json(['message' => 'با موفقیت حذف شد!'], 200);
            } else {
                return \response()->json([], 402);
            }
        } else {
            return response()->json([''], 404);
        }
    }

    public function showEmployees(int $id)
    {
        $user = Auth::user();
        $realestate = RealEstate::find($id);
        $employees = $realestate->employees()->paginate(10);
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        return view('dashboard.employees.index', compact('user', 'vrads', 'realestate', 'employees'));
    }

    public function showEmployee(int $id)
    {
        $user = Auth::user();
        $employee = User::find($id);
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        if($employee->type == User::ADMIN || $employee->type == User::MANAGER) {
            $advertises = $employee->real_estate->advertises()->paginate(10);
        } else {
            $advertises = $employee->advertises->paginate(10);
        }

        return view('dashboard.employees.show', compact('user', 'vrads', 'employee', 'advertises'));
    }

    public function updateEmployee(Request $request, int $eid)
    {
        $upload = Upload::find($request->images[0]);
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'min:10', 'max:13']
        ]);
        $data = $validate->validated();
        $user = User::find($eid);
        if($request->password) {
            $request['password'] = bcrypt($request->passsword);
        }
        if($request->name) {
            $user->name = $request->name;
        }
        if($request->email) {
            $user->email = $request->email;
        }
        if($request->password) {
            $user->password = $request->password;
        }
        if($request->phone) {
            $user->phone = $request->phone;
        }
        if($request->address) {
            $user->address = $request->address;
        }
        if($upload){
            $user->avatar = $upload->path;
        }
        $user->save();
        return response()->json(['message' => 'کاربر ویرایش شد!', 'employee' => $user], 200);
    }

    public function createEmployee()
    {
        $user = Auth::user();
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        return view('dashboard.employees.create', compact('user', 'vrads'));
    }

    public function editEmployee(int $eid)
    {
        $user = Auth::user();
        $employee = User::find($eid);
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        return view('dashboard.employees.edit', compact('user', 'vrads', 'employee'));
    }

    public function storeEmployee(Request $request)
    {
        $upload = Upload::find($request->images[0]);
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'min:10', 'max:13']
        ]);
        $data = $validate->validated();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->avatar = $upload ? $upload->path : '/images/dashboard/avatar.png';
        $user->real_estate_id = 1;
        $user->role_id = 2;
        $user->type = User::EMPLOYEE;
        $user->save();
        return response()->json(['message' => 'کاربر افزوده شد!'], 200);
    }

    public function deleteAvatar(int $eid)
    {
        $employee = User::find($eid);
        $employee->avatar = '';
        if($employee->save()) {
            return response()->json(['message' => 'آواتار با موفقیت حذف شد!', 'employee' => $employee], 200);
        } else {
            return response()->json(['message' => 'متاسفانه خطایی رخ داده است!', 'employee' => $employee], 402);
        }
    }

    public function createVrTour(int $id)
    {
        $user = Auth::user();
        $advertise = Advertise::find($id);
        if($advertise->want_vr_tour) {
            $advertises = Advertise::where('want_vr_tour', '=', true)->orderBy('created_at', 'desc')->get();
            $vrads = Advertise::where('want_vr_tour', '=', true)->get();
            return view('dashboard.virtualtour.create', compact('user', 'advertises', 'advertise', 'vrads'));
        } else {
            return redirect()->route('dashboard.advertise.edit', $id);
        }
    }

    public function storeVrTour(Request $request, int $id)
    {
        $advertise = Advertise::find($id);
        if($advertise){
            if($request->id){
                $advertise->vr_tour_id = $request->id;
                $advertise->want_vr_tour = false;
                $advertise->save();
                $vrtour = VrTour::find($request->id);
                $vrtour->advertise_id = $advertise->id;
                $vrtour->save();
            } else {
                $vrtour = VrTour::create([
                    'advertise_id' => $advertise->id,
                    'title' => $request->path,
                    'path' => '/vrtour/'.$request->path,
                ]);
                $vrtour->save();
                $advertise->vr_tour_id = $vrtour->id;
                $advertise->want_vr_tour = false;
                $advertise->save();
            }
            return \response()->json(['message' => 'نمای مجازی با موفقیت ثبت شد!', 'id' => $advertise->id], 200);
        } else {
            return \response()->json(['message' => 'آگهی یافت نشد!'], 404);
        }
    }

}
