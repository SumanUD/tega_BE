<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function apiindex(){
        $event = Event::get();
        return response()->json($event);
    }

    public function index(){
        $event = Event::get();
        return view('Admin.addevent',['event'=>$event]);
    }

        // Add Event
        public function store(Request $request){
        
            $request->validate([
                'event_title' => 'required',
                'event_date' => 'required',
                'event_description' => 'required',
                'event_image' => 'required|mimes:jpeg,jpg,png|max:21000'
            ]);

            $event_description = $request->event_description;

            $dom = new \DomDocument();
        
            $dom->loadHtml($event_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
            $imageFile = $dom->getElementsByTagName('imageFile');
        
            foreach($imageFile as $item => $image)
            {
        
                $data = $img->getAttribute('src');
        
                list($type, $data) = explode(';', $data);
        
                list(, $data)      = explode(',', $data);
        
                $imgeData = base64_decode($data);
        
                $image_name= "/upload/" . time().$item.'.png';
        
                $path = public_path('Assets/Image/event') . $image_name;
        
                file_put_contents($path, $imgeData);
                
                $image->removeAttribute('src');
        
                $image->setAttribute('src', $image_name);
             }
        
            $event_description = $dom->saveHTML();

            $imageName = time().'.'.$request->event_image->extension();
            $request->event_image->move(public_path('Assets/Image/event'), $imageName);
    
            $event = new Event;
            $event->event_image = $imageName;
            $event->event_title = $request->event_title;
            $event->event_date = $request->event_date;
            $event->event_description = $request->event_description;
    
            $event->save();
            return redirect()->back()->with('success', "Event added successfully.");
    
        }

    // Show Event
    public function show_event($slug)
    {
        $event = Event::where('slug',$slug)->first();

        if (!$event) {
            return response()->json(['status' => 404, 'error' => 'Event not found'], 404);
        }

        return response()->json(['status' => 200, 'event' => $event], 200);
    }

        // Edit Event
        public function edit($slug){

        $event = Event::where('slug',$slug)->first();

        return view('Admin.editevent',['event' => $event]);

    }

        // Update Event
        public function update(Request $request, $slug){

            $request->validate([
                'event_title' => 'required',
                'event_date' => 'required',
                'event_description' => 'required',
                'event_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
            ]);
    
            $event = Event::where('slug', $slug)->first();

            $event_description = $request->event_description;

            $dom = new \DomDocument();
        
            $dom->loadHtml($event_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
            $imageFile = $dom->getElementsByTagName('imageFile');
        
            foreach($imageFile as $item => $image)
            {
        
                $data = $img->getAttribute('src');
        
                list($type, $data) = explode(';', $data);
        
                list(, $data)      = explode(',', $data);
        
                $imgeData = base64_decode($data);
        
                $image_name= "/upload/" . time().$item.'.png';
        
                $path = public_path('Assets/Image/event') . $image_name;
        
                file_put_contents($path, $imgeData);
                
                $image->removeAttribute('src');
        
                $image->setAttribute('src', $image_name);
             }
        
            $event_description = $dom->saveHTML();

            if(isset($request->event_image)){
                $imageName = time().'.'.$request->event_image->extension();
                $request->event_image->move(public_path('Assets/Image/event'), $imageName);
                $event->event_image = $imageName;
                }
    
            $event->event_title = $request->event_title;
            $event->event_date = $request->event_date;
            $event->event_description = $request->event_description;
    
            $event->save();
            $event = Event::get();
            return redirect()->route('addevent')->with('success', "Event updated successfully.");
    
        }

            // Delete Event
    public function destroy($slug){
        $event = Event::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/event/'.$event->event_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $event->delete();
        return redirect()->route('addevent')->with('error', "Event Deleted successfully.");
    }
}
