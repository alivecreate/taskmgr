<?php

function uploadImageThumb($request){
    // return $image;
    if($request->file('image')){
        $image = $request->file('image');
        // dd($image);
        $input['imagename'] = time().'_'.rand(111,999).'.'.$image->extension();

        //icon image resize
        $destinationPath = public_path('/web/media/icon');
        $img_icon = Image::make($image->path());
        $img_icon->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //xs image resize
        $destinationPath = public_path('/web/media/xs');
        $img_xs = Image::make($image->path());
        $img_xs->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //sm image resize
        $destinationPath = public_path('/web/media/sm');
        $img_sm = Image::make($image->path());
        $img_sm->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //md image resize
        $destinationPath = public_path('/web/media/md');
        $img_md = Image::make($image->path());
        $img_md->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        //original image 
        $destinationPath = public_path('/web/media/lg');
        $image->move($destinationPath, $input['imagename']);
        $image_name = $input['imagename'];
    }else{
        $image_name = null;
    }
    return $image_name;


}

function today_date(){
    return date("d/m/Y");
}


function dateToDay($date){
    $now = \Carbon\Carbon::now()->format('Y-m-d H:s:i');
    
    $fromFormat = \Carbon\Carbon::parse($date)->format('Y-m-d H:s:i');

    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $now);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $fromFormat);

    $diff_in_minutes = $from->diffInMinutes($to);
    return $diff_in_minutes;
}

function dateToDayCalculate($date){

    $now = \Carbon\Carbon::now()->format('Y-m-d H:s:i');
    $fromFormat = \Carbon\Carbon::parse($date)->format('Y-m-d H:s:i');

    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $now);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $fromFormat);

    $diff_in_minutes = $from->diffInMinutes($to);
    
    if($diff_in_minutes == 0){
        return $diff_in_minutes. ' Minute Ago';
    }
    elseif($diff_in_minutes > 0 && $diff_in_minutes <= 59)
    {
        return $diff_in_minutes. ' Minutes Ago';
    }elseif($diff_in_minutes > 60){
        $hours = floor($diff_in_minutes / 60);

        if($hours <= 24){
            return $hours = floor($diff_in_minutes / 60).':'.($diff_in_minutes -   floor($diff_in_minutes / 60) * 60). ' Hours Ago';
        }else{
            return $days = floor($hours / 24). ' Days Ago';
        }

    }

}

function dateFormat($date, $format){
    return \Carbon\Carbon::parse($date)->format($format);
}

function dateFormatGujDay($date, $format){
    $day = \Carbon\Carbon::parse($date)->format($format);
    if($day == 'Monday'){
        return 'સોમવાર';
    }elseif($day == 'Tuesday'){
        return 'મંગળવાર';
    }elseif($day == 'Wednesday'){
        return 'બુધવાર';
    }elseif($day == 'Thursday'){
        return 'ગુરુવાર';
    }elseif($day == 'Friday'){
        return 'શુક્રવાર';
    }elseif($day == 'Saturday'){
        return 'શનિવાર';
    }else{
        return 'રવિવાર';
    }
}

function getStatusBgColor($status){
    if($status == 'pending'){
        return 'bg-warning';
    }elseif($status == 'processing'){
        return 'bg-info';
    }elseif($status == 'cancelled'){
        return 'bg-danger';
    }elseif($status == 'completed'){
        return 'bg-success';
    }else{
        return 'bg-default';
    }
}

function getStatusBadgeColor($status){
    if($status == 'pending'){
        return 'badge bg-warning';
    }elseif($status == 'processing'){
        return 'badge bg-info';
    }elseif($status == 'cancelled'){
        return 'badge bg-danger';
    }elseif($status == 'completed'){
        return 'badge bg-success';
    }else{
        return 'badge bg-default';
    }
}

function getStatusTextColor($status){
    if($status == 'pending'){
        return 'text-warning';
    }elseif($status == 'processing'){
        return 'text-info';
    }elseif($status == 'cancelled'){
        return 'text-danger';
    }elseif($status == 'completed'){
        return 'text-success';
    }else{
        return 'text-default';
    }
}

