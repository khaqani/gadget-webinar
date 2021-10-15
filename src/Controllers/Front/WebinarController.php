<?php
namespace Larabookir\Gateway\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Base\User;
use App\Models\Base\Province;
use App\Models\Base\City;
use App\Models\Base\Notification;
use Larabookir\Gateway\Models\Webinar;

use App\Models\Webinar\Ticket;

use App\Models\Webinar\Teacher;
use App\Models\Webinar\Organizer;

use App\Models\Webinar\Participant;
use Illuminate\Http\Request;
use Validator;


class WebinarController extends Controller
{

    public function index(Request $request)
    {
        $items = Webinar::whereNotNull('id');

        
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
            return view('Webinar::Front.load', ['items' => $items])->render();  
        }


        $provinces = Province::whereNotNull('id')->get();
        $cities = City::whereNotNull('id')->get();

            return view('Webinar::Front.index', [
            'items' => $items,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }


    public function show($slug){
        $item = Webinar::where('slug', $slug)->first();
        $user = auth()->user();



        if($user)
            $buyuser = Participant::where('Webinar_id',$item->id)->where('user_id',$user->id)->count();
        else
        $buyuser = 2;

        return view('Webinar.Front.show', [
            'item' => $item,
            'buyuser' => $buyuser,
        ]);

    }


    public function buyticket(){

        $webinar_id = request()->input('webinar_id');
        $ticket_id = request()->input('ticket_id');
        $webinar = Webinar::where('id', $webinar_id)->first();
        $item = Ticket::where('id', $ticket_id)->first();
        $user = User::find(auth()->user()->id);


        if ( $user->wallet >= $item->price) {
            $webinar->participants()->attach($user->id);
            $user->wallet -= $item->price;
            return response()->json(['message' => 'خریداری شد'], 200);

        }
        else{
            return response()->json(['message' => 'به اندازه کافی موجودی ندارید'], 422);
        }
    }



    


    public function getrequest()
    {
        return view('Webinar.Front.request');
    }

    public function postrequest()
    {
        return view('Webinar.Front.request');
    }

    public function mylist()
    {
        $user = Employee::find(auth()->user()->id);

        $term_current =  Term::whereNotNull('id')->where('status', 1)->first();
        $term_current_id = $term_current->id;

        $stu_school = Studentreq::where('employee_id', $user->id)->where('term_id', $term_current->id)->first();

        
        $brands = $user->movies()->orderBy('id', 'DESC');


        $sort = request()->input('sort');
        $status = request()->input('status');


        if (request()->has('q') && request()->input('q') != '') {
            $brands = $brands->where('name','like','%'.request()->input('q').'%');
        }

    switch ($sort) {
                 case 'new': 
                    $brands = $brands->orderBy('id', 'DESC');
                    break;

                case 'name': 
                    $brands = $brands->orderBy('name', 'ASC');
                    break;
                   
                 case 'slug': 
                    $brands = $brands->orderBy('slug', 'ASC');
                    break;

                case 'count': 
                    $brands = Brand::withCount('products')->orderBy('products_count', 'desc');
                   
                break;

                default:
                    $brands = $brands->orderBy('id', 'DESC');
            }
   

        switch ($status) {
                     case 'active': 
                        $brands = $brands->where('status', 1)->paginate(8);
                     break;
    
                    case 'deactive': 
                        $brands = $brands->where('status', 0)->paginate(8);
                    break;
    
                    default:
                    $brands = $brands->paginate(8);
                }


     
            return view('front.accounts.movie.mylist', [
            'term_current' => $term_current,
            'user' => $user,
            'item' => $stu_school,
            'brands' => $brands,
            'wishlist' => $user->products()->orderBy('id', 'DESC')->take(3)->get(),
            'countFav' => $user->products()->count(),
            'countTicket' => $user->tickets()->count(),
            'countOrder' => $user->orders()->count(),
        ]);
    }
}