<?php
    // Admin Panel
    Route::group(['namespace' => 'Webinar\Admin', 'prefix'=>'admin/webinar', 'as'=>'Webinar.Admin.', 'middleware' => ['web', 'is_admin']], function(){

        Route::get('/teachers','TeacherController@index')->name('teachers.index');
        Route::post('/teachers','TeacherController@store')->name('teachers.store');
        Route::get('/teachers/{id}','TeacherController@show')->name('teachers.show');
        Route::patch('/teachers/{id}','TeacherController@update')->name('teachers.update');
        Route::delete('/teachers','TeacherController@destroy');

        Route::get('/organizers','OrganizerController@index')->name('organizers.index');
        Route::post('/organizers','OrganizerController@store')->name('organizers.store');
        Route::get('/organizers/{id}','OrganizerController@show')->name('organizers.show');
        Route::patch('/organizers/{id}','OrganizerController@update')->name('organizers.update');
        Route::delete('/organizers','OrganizerController@destroy');
        

        Route::get('/requests','RequestController@index')->name('requests.index');
        Route::post('/requests','RequestController@store')->name('requests.store');
        Route::get('/requests/{id}','RequestController@show')->name('requests.show');
        Route::patch('/requests/{id}','RequestController@update')->name('requests.update');
        Route::delete('/requests','RequestController@destroy');

        // Pages
        Route::get('/list','WebinarController@index')->name('index');

        Route::post('/','WebinarController@store')->name('store');
        Route::get('create','WebinarController@create')->name('create');
        Route::get('{id}/edit','WebinarController@edit')->name('edit');
        Route::get('{id}','WebinarController@show')->name('show');
        Route::patch('{id}','WebinarController@update')->name('update');
        Route::delete('/','WebinarController@destroy');

        
        Route::get('/', 'WebinarController@home')->name('index');
    });

    

    Route::group(['namespace' => 'Webinar\Account', 'prefix'=>'account', 'as'=>'Webinar.Account.', 'middleware' => ['web', 'is_user']], function(){

        
                Route::post('/addorganizer','MyWebinarController@addorganizer')->name('MyWebinar.store');
                Route::post('/addteacher','MyWebinarController@addteacher')->name('MyWebinar.store');

                // Pages
                Route::get('/mywebinars','MyWebinarController@index')->name('index');

                Route::post('/mywebinars','MyWebinarController@store')->name('MyWebinar.store');
                Route::get('/mywebinars/create','MyWebinarController@create')->name('create');
                Route::get('mywebinars/{id}/edit','MyWebinarController@edit')->name('edit');
                Route::get('myebinars/{id}','MyWebinarController@show')->name('show');
                Route::patch('mywebinars/{id}','MyWebinarController@update')->name('update');
                Route::delete('/mywebinars','MyWebinarController@destroy');

                Route::get('/paywebinar/{id}','MyWebinarController@directpaywebinar')->name('directpaywebinar');

                Route::any('/webinarpayment', 'MyWebinarController@webinarpayment');
                Route::post('wallet/add', 'MyWebinarController@payment');
            

                        // Pages
                Route::get('/webinars','WebinarController@index')->name('index');

                Route::post('/webinars','WebinarController@store')->name('store');
                Route::get('webinars/create','WebinarController@create')->name('create');
                Route::get('webinars/{id}/edit','WebinarController@edit')->name('edit');
                Route::get('webinars/{id}','WebinarController@show')->name('show');
                Route::patch('webinars/{id}','WebinarController@update')->name('update');
                Route::delete('webinars','WebinarController@destroy');


                Route::post('getteacherslist','WebinarController@getteacherslist');
                Route::post('getorganizerslist','WebinarController@getteacherslist');



    });

    Route::group(['namespace' => 'Larabookir\Gateway\Controllers\Front', 'middleware' => ['web']], function(){
        Route::get('/requestwebinar','WebinarController@getrequest');
        Route::post('/requestwebinar','WebinarController@postrequest');

        Route::get('/webinars','WebinarController@index');

        Route::get('/webinars/categories/{slug}','CategoryController@show');


        Route::get('/webinars/{slug}','WebinarController@show');
        Route::post('buyticket','WebinarController@buyticket');


        Route::get('/organizers','OrganizerController@index');
        Route::get('/organizers/{slug}','OrganizerController@show');

        Route::get('/teachers','TeacherController@index');
        Route::get('/teachers/{slug}','TeacherController@show');


    });