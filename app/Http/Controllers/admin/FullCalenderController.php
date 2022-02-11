<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Event;
use App\Models\admin\FullCalendar;
;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = FullCalendar::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end', 'color']);
            return response()->json($data);
    	}
    	return view('adm.pages.calender.full-calender2');
    }
	
	
    public function index2(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = FullCalendar::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end', 'color']);
            return response()->json($data);
    	}
    	return view('adm.pages.calender.full-calender2');
    }

    public function index3(Request $request)
    {
		// dd('test');
		if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end', 'color']);
            return response()->json($data);
    	}
    	return view('adm.pages.calender.full-calendar3');
    }

    public function final(Request $request)
    {
		if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end', 'color', 'textColor']);
            return response()->json($data);
    	}
    	return view('adm.pages.calender.full-calendar-final');
    }

    public function finalAction(Request $request)
    {
        // return $request->input();
    	// if($request->ajax())
    	// {
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'allDay'	=>	1,
    				'textColor'	=>	'red',
    				'color'		=>	'blue',
    				'start'		=>	$request->start,
    				'end'		=>	$request->end,
    			]);
    			// return redirect()->back();
    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
        // return $request->input();

    			$event = FullCalendar::find($request->id)->update([
    				'title'		=>	$request->title,
    				'allDay'	=>	1,
    				'textColor'	=>	'red',
    				'color'		=>	'blue',
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = FullCalendar::find($request->id)->delete();

    			return response()->json($event);
    		}
    	// }
    }

    public function action(Request $request)
    {
        return $request->input();
    	// if($request->ajax())
    	// {
    		if($request->type == 'add')
    		{
    			$event = FullCalendar::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end,
    				'color'		=>	$request->color
    			]);
    			return redirect()->back();
    			// return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = FullCalendar::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = FullCalendar::find($request->id)->delete();

    			return response()->json($event);
    		}
    	// }
    }
	
    public function action2(Request $request)
    {
        // return $request->input();
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = FullCalendar::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end,
    				'color'		=>	$request->color
    			]);

    			// return redirect()->back();
    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = FullCalendar::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = FullCalendar::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
	
    public function actionSave(Request $request)
    {
        return $request->input();
    	// if($request->ajax())
    	// {
    		if($request->type == 'add')
    		{
    			$event = FullCalendar::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end,
    			]);

    			return redirect()->back();
    			// return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = FullCalendar::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = FullCalendar::find($request->id)->delete();

    			return response()->json($event);
    		}
    	// }
    }
	
}