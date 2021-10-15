<?php
namespace App\Http\Controllers\Webinar\Admin;
use App\Http\Controllers\Controller;
use App\Models\Webinar\Webinar;
use App\Models\Webinar\Participant;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Validator;

use App\Models\Base\User;
use App\Models\Webinar\Organizer;

class RequestController extends Controller
{

    public function index(Request $request)
    {
        $items = Organizer::wherenotnull('id');

        $sort = request()->input('sort');
        $status = request()->input('status');
        $type = request()->input('type');
        $city_id = request()->input('city_id');


        if (request()->has('q') && request()->input('q') != '') {
            $items = $items->where('name','like','%'.request()->input('q').'%');
        }

        if (request()->has('city_id') && request()->input('city_id') != '') {
            $items = $items->where('city_id', $city_id);
        }

        $date = request()->input('date');




    switch ($sort) {
                 case 'new': 
                    $items = $items->orderBy('id', 'DESC');
                    break;

                case 'name': 
                    $items = $items->orderBy('name', 'ASC');
                    break;
                   
                 case 'slug': 
                    $items = $items->orderBy('slug', 'ASC');
                    break;

                case 'count': 
                    $items = Brand::withCount('products')->orderBy('products_count', 'desc');
                   
                break;

                default:
                    $items = $items->orderBy('id', 'DESC');
            }
   

            $items = $items->paginate(8);


        if ($request->ajax()) {
            return view('Webinar.Admin.teachers.load', ['items' => $items])->render();  
        }
        return view('Webinar.Admin.teachers.list', [
            'countAll'    => Webinar::whereNotNull('id')->count(),
            'countActive' => Webinar::whereNotNull('id')->where('status', 1)->count(),
            'items' => $items,
        ]);

    }


    public function buylist(Request $request, int $id)
    {
        $user = User::find(auth()->user()->id);

        if($user->hasRole('superadmin')) {
        }
        else{
            $item = Webinar::where('creator_id', $user->id)->where('id',$id)->first();
            if(!$item) {
                return 'شما مجاز نیستید';
            }
        }


        $items = WebinarCustomer::where('Webinar_id', $id)->paginate(10);


        if ($request->ajax()) {
            return view('Webinar.Admin.teachers.buyload', ['items' => $items])->render();  
        }

        return view('Webinar.Admin.teachers.buylist', [
            'countAll'    => Webinar::whereNotNull('id')->count(),
            'countActive' => Webinar::whereNotNull('id')->where('status', 1)->count(),
            'items'    => $items,
        ]);

    }

    public function create()
    {
        $grades = Grade::whereNotNull('id')->get();
        $courses = Course::whereNotNull('id')->get();
        $chapters = Chapter::whereNotNull('id')->get();
        $topics = Topic::whereNotNull('id')->get();
        $subtopics = Subtopic::whereNotNull('id')->get();


        $provinces = Province::whereNotNull('id')->get();
        $cities = City::whereNotNull('id')->get();



        return view('Webinar.Admin.teachers.create', [
            'grades' => $grades,
            'courses' => $courses,
            'chapters' => $chapters,
            'topics' => $topics,
            'subtopics' => $subtopics,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }


    public function edit(int $id)
    {
        $item = Webinar::whereid($id)->first();

        $provinces = Province::whereNotNull('id')->get();
        $cities = City::whereNotNull('id')->get();
        return view('Webinar.Admin.teachers.edit', [
            'item' =>  $item,
           
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }





    public function getList(Request $request){
        $items = Webinar::whereNotNull('id')->get();
        if (!$items) {
            return response()->json(['message' => 'Error when getting information...'], 422);
        }
        return response()->json($items);
    }

    

    
    public function show($id){
        $item = Webinar::whereid($id)->first();
        if(!$item)
            return response()->json(['message' => 'Item not found!'],422);
        return $item;
    }


    public function karname($id){
        $item = MovieCustomer::whereid($id)->first();

        return view('Webinar.Admin.teachers.karname', [
            'item'    => $item,
            'answer'    => $item->quiz->answer,
            'sections'    => $item->quiz->sections,

        ]);

    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:webinar'],
        ]);


        $data = $request->except('_token', '_method');

        if ($request->slug == NULL) {
            $data['slug'] = str_replace(' ', '-', $data['name']); 
        }
        else {
            $data['slug'] = str_replace(' ', '-', $data['slug']); 
        }

        if ($request->description != NULL) {
            $data['description'] = trim(preg_replace('/\s\s+/', ' ', $data['description']));
    }
    
        $user = Auth::guard()->user();
        $data['creator_id'] = $user->id;

        $service = Webinar::create($data);

        return response()
        ->json([
            'saved' => true,
            'message' => 'با موفقیت ثبت شد'
        ]);

    }



    public function store2(Request $request){

        $validation = Validator::make($request->all(), [
        ]);

        if($validation->fails())
            return response()->json($validation->messages(),200);

          //  $term = Term::wherestatus(1)->first();
          //  $list =  Studentreq::whereNotNull('id')->where('term_id',$term->id );

         //   $user = Auth::guard()->user();

           // $request['User_id'] = $user->id;

            if ($request->description != NULL) {
                $request['description'] = trim(preg_replace('/\s\s+/', ' ', $request['description']));
        }
         //   $request['start'] =\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($request['start'],0,4) , substr($request['start'],5,2), substr($request['start'],8,2) )->format('Y.m.d'); 
           // $request['end'] =\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($request['end'],0,4) , substr($request['end'],5,2), substr($request['end'],8,2) )->format('Y.m.d'); 
           // $request['datetime'] =\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($request['datetime'],0,4) , substr($request['datetime'],5,2), substr($request['datetime'],8,2) )->format('Y.m.d'); 


        $quiz = Webinar::create($request->all());
       

            return redirect()->route('Webinar.Admin.teachers.index')->with('message', 'آزمون الفزوده شد');

    }

    public function destroy(Request $request)
    {
        $service = Webinar::whereid($request->input('id'))->first();
        $service->delete();
        return response()->json(['message' => 'وبینار مورد نظر حذف شد!']);
    }


    public function update(Request $request, $id){
        $question = Webinar::whereid($id)->first();
        if(!$question)
		return response()->json(['message' => 'Item not found!'],422);
       
        $validation = Validator::make($request->all(), [
            'price' => 'required',
            'type' => 'required'
        ]);
        if ($request->description != NULL) {
            $request['description'] = trim(preg_replace('/\s\s+/', ' ', $request['description']));
    }

    $request['start'] =\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($request['start'],0,4) , substr($request['start'],5,2), substr($request['start'],8,2) )->format('Y.m.d'); 
    $request['end'] =\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($request['end'],0,4) , substr($request['end'],5,2), substr($request['end'],8,2) )->format('Y.m.d'); 
    $request['datetime'] =\Morilog\Jalali\CalendarUtils::toGregorianDate(substr($request['datetime'],0,4) , substr($request['datetime'],5,2), substr($request['datetime'],8,2) )->format('Y.m.d'); 

        if($validation->fails())
            return response()->json($validation->messages(),200);
			$question->update($request->all());
			

            return redirect()->route('admin.Webinar.index')
            ->with('message', 'Update successful');
    }
  
	public function toggleStatus(Request $request){
        $question = Webinar::find($request->input('id'));
		$question->status = !$question->status;
        $question->save();
        if($question->status)
            return response()->json(['message' => 'The item is "enabled"'], 200);
		else
			return response()->json(['message' => 'The item was "disabled"'], 200);
	}
}