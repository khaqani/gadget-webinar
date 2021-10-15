<?php

namespace App\Http\Controllers\Webinar\Front;

use App\Http\Controllers\Controller;
use App\Models\Base\User;
use App\Models\Base\Province;
use App\Models\Base\City;
use App\Models\Base\Notification;
use App\Models\Webinar\Webinar;

use App\Models\Webinar\Teacher;
use App\Models\Webinar\Organizer;

use App\Models\Webinar\Participant;
use Illuminate\Http\Request;
use Validator;

class TeacherController extends Controller
{

    public function index(Request $request)
    {
        $items = User::where('type',0);

        
        $sort = request()->input('sort');
        $status = request()->input('status');
        $type = request()->input('type');
        $city_id = request()->input('city_id');


        if (request()->has('city_id') && request()->input('city_id') != '') {
            $items = $items->where('city_id', $city_id);
        }

        if (request()->has('type') && request()->input('type') != '') {
            $items = $items->where('type', $type);
        }

        if (request()->has('q') && request()->input('q') != '') {
            $items = $items->where('name','like','%'.request()->input('q').'%');
        }

        $daterang1 = request()->input('daterang1');
        $daterang2 = request()->input('daterang2');
        $date = request()->input('date');




        if ($daterang1 != '' && $daterang1 !=NULL) {
            $ddate1=\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($daterang1,0,4) , substr($daterang1,5,2), substr($daterang1,8,2) )->format('Y.m.d'); 
            $items = $items->where('start','>=', $ddate1);
        }

        if ($daterang2 != '' && $daterang2 !=NULL) {
            $ddate2=\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($daterang2,0,4) , substr($daterang2,5,2), substr($daterang2,8,2) )->format('Y.m.d'); 
            $items = $items->where('end','<=', $ddate2);
        }


        if ($date != '' && $date !=NULL) {
            $ddate=\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($date,0,4) , substr($date,5,2), substr($date,8,2) )->format('Y.m.d'); 
            $items = $items->where('datetime', $ddate);
        }

    switch ($sort) {
                 case 'new': 
                    $items = $items->orderBy('id', 'DESC');
                    break;

                case 'name': 
                    $items = $items->orderBy('name', 'ASC');
                    break;
                break;

                default:
                    $items = $items->orderBy('id', 'DESC');
            }
   
            
        switch ($status) {
                     case 'active': 
                        $items = $items->where('status', 1)->paginate(8);
                     break;
    
                    case 'deactive': 
                        $items = $items->where('status', 0)->paginate(8);
                    break;
    
                    default:
                    $items = $items->paginate(8);
                }


        if ($request->ajax()) {
            return view('Webinar.Front.teachers.load', ['items' => $items])->render();  
        }


        $provinces = Province::whereNotNull('id')->get();
        $cities = City::whereNotNull('id')->get();

            return view('Webinar.Front.teachers.index', [
            'items' => $items,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }

    public function show(Request $request, $slug){
        $item = Teacher::where('slug', $slug)->first();
        $items = Webinar::whereNotNull('id');

        if ($request->ajax()) {
            return view('Webinar.Front.teachers.load', ['items' => $items])->render();  
        }

        $items = $items->paginate(8);


        return view('Webinar.Front.teachers.show', [
            'item' => $item,
            'items' => $items,
        ]);

    }

}