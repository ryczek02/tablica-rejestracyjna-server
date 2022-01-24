<?php


Route::get('/generatenm/{img}', function($text){
    $text = str_replace('-', ' ', $text);
    $img = Image::make(public_path('images/tabds.png'));
    //top
    $img->text($text, 50, 18, function($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(95);
        $font->color('#8E02A2');
        $font->align('left');
        $font->valign('top');
    });
//    left
    $img->text($text, 48, 20, function($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(95);
        $font->color('#00939d');
        $font->align('left');
        $font->valign('top');
    });

    //right
    $img->text($text, 53, 20, function($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(95);
        $font->color('#c894a1');
        $font->align('left');
        $font->valign('top');
    });
//
////    //bottom
    $img->text($text, 50, 23, function($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(95);
        $font->color('#93cba6');
        $font->align('left');
        $font->valign('top');
    });
////    last
    $img->text($text, 50, 20, function($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(95);
        $font->color('#9192D2');
        $font->align('left');
        $font->valign('top');
    });

    $img->blur(1);

    $tempfile = 'images/' . Str::random(3) . '-nm.png';
    $test = $img->save('images/' . Str::random(5) . '.png');
    File::delete(public_path($tempfile));
    return response($test)->header('Content-type','image/png');
})->name('generateImage');

Route::get('/generateds/{img}', function($text){
    $text = str_replace('-', ' ', $text);
    $img = Image::make(public_path('images/displace.png'));
    $img->text($text, 50, 20, function($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(95);
        $font->color('#fff');
        $font->align('left');
        $font->valign('top');
    });

    $img->blur(2);

    $tempfile = 'images/' . Str::random(3) . '.png';
    $test = $img->save('images/' . Str::random(5) . '-ds.png');
    File::delete(public_path($tempfile));
    return response($test)->header('Content-type','image/png');
})->name('generateImage');


Route::get('/regions/TJE', function(){
    return ['TJE', 'LUB'];
});


Route::get('/generate/{img}', function($text){
    $text = str_replace('-', ' ', $text);
    $img = Image::make(public_path('images/tab.png'));
    $img->text($text, 50, 20, function($font) {
        $font->file(public_path('fonts/arial.ttf'));
        $font->size(95);
        $font->color('#000');
        $font->align('left');
        $font->valign('top');
    });

    $tempfile = 'images/' . Str::random(3) . '.png';
    $test = $img->save('images/' . Str::random(5) . '.png');
    File::delete(public_path($tempfile));
    return response($test)->header('Content-type','image/png');
})->name('generateImage');

Route::get('/generatedPlateTest', function(){
    return \App\Http\Resources\GeneratedPlateTest::collection(\App\Models\Region::all());
});

Route::get('/findExampleVoivodeship', function(){
    $voivodeship = \App\Models\Voivodeship::find(13);

    return $voivodeship->licensePlates();
});


Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail ',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\Test\SendMail($details));

    dd("Email is Sent.");
});
