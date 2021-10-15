<?php

namespace App\Http\Controllers\Webinar\Account;

use App\Http\Controllers\Controller;
use App\Models\Base\User;
use App\Models\Base\Province;
use App\Models\Base\City;
use App\Models\Base\Notification;
use App\Models\Webinar\Webinar;
use App\Models\Webinar\Session;
use App\Models\Webinar\Faq;
use App\Models\Webinar\Ticket;
use App\Models\Webinar\Category;
use App\Models\Webinar\Section;
use App\Models\Webinar\Chapter;
use App\Models\Webinar\Subchapter;
use App\Models\Webinar\Teacher;
use App\Models\Webinar\Organizer;
use App\Models\Webinar\Participant;

use App\Models\Wallet\Transaction;
use App\Models\Wallet\Money;



use Illuminate\Http\Request;
use Validator;


class MyWebinarController extends Controller
{

    public function index(Request $request)
    {
        $user = \Auth::guard()->user();
        $user_id = $user->id;
        $items = Webinar::where('creator_id', $user_id);
       
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
            return view('Webinar.Account.mywebinars.load', ['items' => $items])->render();  
        }


        $teachers = User::where('type', 0)->get();
        $organizers =  User::where('type', 1)->get();

        $parentcats = Category::where('parent_id', 1)->get();
        $subcats = Category::wherenotin('parent_id', [0,1])->get();


            return view('Webinar.Account.mywebinars.list', [
            'organizers' => $organizers,
            'teachers' => $teachers,
            'items' => $items,
            'parentcats' => $parentcats,
            'subcats' => $subcats,
        ]);
    }


    public function directpaywebinar(Request $request, int $id) 
    {
        $webinar = Webinar::where('id', $id)->first();
        $cost = $webinar->cost;

        $price = $request->input('amount');
        $slug = "Zarinpal";
        $payment = strtoupper($slug);

        $total_paid = $cost *10;
        
        try {
                $gateway = \Gateway::make($payment);
                $gateway->setCallback(url('/account/webinarpayment'));
                $gateway->price($total_paid)->ready();

                $refId =  $gateway->refId(); // شماره ارجاع بانک
                $transID = $gateway->transactionId(); // شماره تراکنش
                $webinar->tracking=$refId;
                $webinar->save();

                        return $gateway->redirect();
  
        } catch ( GatewayChargingErrorException $e) {
            Log::info($e->getMessage());
            return redirect()->route('/account/webinarpayment')->with('error', 'There is a problem processing your request.');
        }
    }


    public function payment(Request $request) 
    {
        $price = $request->input('amount');
        $slug = "Zarinpal";
        $payment = strtoupper($slug);


        $total_paid = $price *10;
  
        try {
                $gateway = \Gateway::make($payment);
            
                $gateway->setCallback(url('/admin/wallet/callback'));
                $gateway->price($total_paid)->ready();

                $refId =  $gateway->refId(); // شماره ارجاع بانک
                $transID = $gateway->transactionId(); // شماره تراکنش

                        return $gateway->redirect();
  
        } catch ( GatewayChargingErrorException $e) {
            Log::info($e->getMessage());
            return redirect()->route('admin/wallet/callback')->with('error', 'There is a problem processing your request.');
        }
    }

    public function webinarpayment(Request $request)
    {
        $user = \Auth::guard()->user();

        try { 

            $gateway = \Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();

            $transaction = Transaction::where('ref_id', $refId)->first();

            if(!$transaction) 
                return "خطا";

                if($transaction->status=='SUCCEED') {
                    $webinar = Webinar::where('tracking', $refId)->first();
                    if(!$webinar) abort(403);
                    $webinar->status = 2;
                    $webinar->save();

                    Money::create([
                        'user_id' =>  $user->id,
                        'type' =>  1,
                        'amount' =>  $transaction->price,
                        'title' =>  'پرداخت مستقیم بانکی',
                        'current' =>  $user->wallet,
                        'gateway'=>  1,
                        ]);


                return view('Webinar.Account.mywebinars.payment', ['ref' => $refId]);
            } 



         } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {
         
             // تراکنش قبلا سمت بانک تاییده شده است و
             // کاربر احتمالا صفحه را مجددا رفرش کرده است
             // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم
         
             echo $e->getMessage() . "<br>";
         
         } catch (\Exception $e) {
         
             // نمایش خطای بانک
             echo $e->getMessage();
         }


        }




    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          //  'name' => ['required', 'unique:webinar'],
        ]);

        $data = $request->except('_token', '_method');

        $cover = $request->file('cover');

        if ($request->has('cover')) {
            $request['avatar']  = $cover->store('webinars', ['disk' => 'uploads']);
        }


        if ($request->slug == NULL) {
            $data['slug'] = str_replace(' ', '-', $data['name']); 
        }
        else {
            $data['slug'] = str_replace(' ', '-', $data['slug']); 
        }

        if ($request->description != NULL) {
            $data['description'] = trim(preg_replace('/\s\s+/', ' ', $data['description']));
        }
    
        $user = \Auth::guard()->user();
        $data['creator_id'] = $user->id;
        $data['status'] = 0;

        $runtime = 0;
        foreach($request->sessions as $sess) {
            $start = explode(":", $sess['start']);
            $end = explode(":", $sess['end']);
            $temp = ($end[0] - $start[0]) * 60 + ($end[1] - $start[1]);
            $runtime += $temp;
        }
        $unit = 150;
        $cost = $runtime * $unit + $runtime/100 * 9 * $unit;
        $data['runtime'] = $runtime;
        $data['cost'] = $cost;
        $webinar = Webinar::create($data);

        if (request()->has('sections')) {
            foreach($request->sections as $index => $section){    
                $sec = new Section([
                    'webinar_id' => $webinar->id,
                    'name' => $section,
                    'tartib' => $index,
                ]);
               $webinar->sessions()->save($sec);   
               
               if (request()->has('chapters')) {
                $chapters = request()->input('chapters');
    
                if (isset($chapters[$index])) {

                    foreach($chapters[$index] as $index2 => $chapter){   
                        
                        $chap = new Chapter([
                            'section_id' => $sec->id,
                            'name' => $chapter,
                            'tartib' => $index2,
                        ]);
                        $sec->chapters()->save($chap);    
                   
                   
                        if (request()->has('subchapters')) {
                            $subchapters = request()->input('subchapters');
                
                            if (isset($subchapters[$index][$index2])) {

                            foreach($subchapters[$index][$index2] as $index3 => $subchapter){   
                                
                                $subchap = new Subchapter([
                                    'chapter_id' => $chap->id,
                                    'name' => $subchapter,
                                    'tartib' => $index3,
                                ]);
                            $chap->subchapters()->save($subchap);        
                                }
                            }
                            }
                        }
                    }
                }
            }
        }


        if (request()->has('sessions')) {
            foreach($request->sessions as $session){    

                $section = new Session([
                    'webinar_id' => $webinar->id,
                    'title' => $session['name'],
                    'date' => $session['date'],
                    'start' => $session['start'],
                    'end' => $session['end'],
                ]);
               $webinar->sessions()->save($section);        
            }
        }





        if (request()->has('organizers')) {
            foreach($request->organizers as $organizer){   
                $webinar->organizers()->attach(['organizer_id' => $organizer]);
            }
        }

        if (request()->has('teachers')) {
            foreach($request->teachers as $teacher){    
                $webinar->teachers()->attach(['teacher_id' => $teacher]);
            }
        }

        if (request()->has('faqs')) {
            foreach($request->faqs as $faq){    

                $item = new Faq([
                    'webinar_id' => $webinar->id,
                    'question' => $faq['faqquestion'],
                    'answer' => $faq['faqanswer'],
                ]);
               $webinar->faqs()->save($item);        
            }
        }


        if (request()->has('tickets')) {
            foreach($request->tickets as $ticket){    

                $item = new Ticket([
                    'webinar_id' => $webinar->id,
                    'title' => $ticket['title'],
                    'start' => $ticket['start'],
                    'end' => $ticket['end'],
                    'count' => $ticket['count'],
                    'isvideo' => $ticket['isvideo'],
                    'price' => $ticket['price'],
                ]);
               $webinar->tickets()->save($item);        
            }
        }




        return response()
        ->json([
            'saved' => true,
            'message' => 'با موفقیت ثبت شد'
        ], 200);

    }


    public function addorganizer(Request $request) {
        $name = $request->name; 
        $slogen = $request->slogen; 
        $slug = str_replace(' ', '-', $name); 
        $mobile_number = $request->tel; 

        $item = User::create([
            'name' => $request->name,
            'slogen' => $slogen,
            'mobile_number' => $mobile_number,
            'password' => "zero",
            'type' => 1,
            'status' => 0,
        ]);

        return response()
        ->json([
            'id' => $item->id,
            'saved' => true,
            'message' => 'با موفقیت ثبت شد'
        ], 200);
    }

     public function addteacher(Request $request) {
        $name = $request->name; 
        $slogen = $request->slogen; 
        $slug = str_replace(' ', '-', $name); 
        $mobile_number = $request->tel; 

        $item = User::create([
            'name' => $request->name,
            'slogen' => $slogen,
            'mobile_number' => $mobile_number,
            'password' => "zero",
            'type' => 0,
            'status' => 0,
        ]);
        
        return response()
        ->json([
            'id' => $item->id,
            'saved' => true,
            'message' => 'با موفقیت ثبت شد'
        ], 200);
    }

    public function show($id){
        $item = Webinar::where('id', $id)->first();
        $user = auth()->user();

            $buyusers = Participant::where('Webinar_id',$item->id)->get();


        return response()
        ->json([
            'id' => $item->id,
            'participants' => $buyusers,
        ], 200);
        

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