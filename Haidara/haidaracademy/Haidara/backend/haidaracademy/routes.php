<?php


$app->get('/', 'HomeController:index')->setName('home');
$app->get('/fr/{ref}', 'HomeController:findOne')->setName('one');
$app->post('/fr/{ref}', 'HomeController:comment')->setName('comment.post');

/****************** Login **********************/
$app->get('/auth/login', 'Auth:getLogin')->setName('auth.login');
$app->post('/auth/login', 'Auth:postLogin')->setName('auth.login.post');
$app->post('/auth/forget/', 'Auth:forget')->setName('auth.forget');
$app->get('/auth/logout/', 'Auth:logout')->setName('auth.logout');
$app->get('/AH/{user}', 'Auth:connect')->setName('auth.connect');
$app->get('/user/{ref}', 'Auth:getUserDetail')->setName('auth.user_data');
$app->get('/user/setting/{ref}', 'Auth:setting')->setName('setting');
$app->get('/user/reset password/', 'Auth:resetPassword')->setName('auth.forget.password');
$app->get('/user/modo/', 'Auth:getListModo')->setName('auth.modo');
$app->get('/user/dailyActive/', 'Auth:listDailyActive')->setName('auth.dailyActive');
$app->get('/user/member/', 'Auth:getListMembers')->setName('auth.member');

/********************* Register *************************/
$app->get('/auth/register', 'Auth:getRegister')->setName('auth.register');
$app->post('/auth/register', 'Auth:postRegister');

/************************* Formation **************************/
$app->get('/formation/', 'Formation:getAll')->setName('formation.all');
$app->get('/formation/php/', 'Formation:php')->setName('formation.php');
$app->get('/formation/java/', 'Formation:java')->setName('formation.java');
$app->get('/formation/android/', 'Formation:android')->setName('formation.android');
$app->get('/formation/langagec#/', 'Formation:csh')->setName('formation.csh');
$app->get('/formation/langagec++/', 'Formation:cplus')->setName('formation.cplus');
$app->get('/formation/langagec/', 'Formation:c')->setName('formation.c');
$app->get('/formation/sql/', 'Formation:sql')->setName('formation.sql');
$app->get('/fr/formation/{ref}', 'Formation:getItemById')->setName('ref');
$app->get('/formation/h/{ref}', 'Formation:getDetailsCombineByCategories')->setName('formation.merge');

/************************* dashboard Formation **************************/
$app->get('/formation/course/new/creer', 'Formation:getFormCourse')->setName('new.formation');
$app->post('/formation/course/create', 'Formation:saveNewFormation')->setName('save.formation');

/**************************** Tutorial **********************************/
$app->get('/tutorial/post/new/creer', 'Tutorial:getForm')->setName('new.post');
$app->get('/tutorial/', 'Tutorial:show_all_tutorial')->setName('list.post');
$app->post('/tutorial/post/create', 'Tutorial:save')->setName('save.post');

/**************************** Tutorial **********************************/
//$app->get('/tutorial/', 'Tutorial:getAll')->setName('tutorial.all');
$app->get('/fr/tutorial/{id}/{desc}', 'Tutorial:getByCategory')->setName('tutorial.id');
//$app->get('/tutorial/watch[/{id}[/{month}]]', 'Tutorial:watch')->setName('tutorial.watch');
$app->get('/user/posts/{ref}', 'Tutorial:getCommentsDetailsByUser')->setName('comments.user');
$app->get('/user/answers/{ref}', 'Tutorial:getAnwsersDetailsByUser')->setName('answsers.user');

/********************************Primium***************************************/

$app->get('/premium/', 'Premium:getAll')->setName('prim.all');
$app->get('/premium/{ref}', 'Premium:getAll')->setName('prim.ref');
$app->get('/premium/formular/{ref}', 'Premium:chooseFormularProcess')->setName('formule');
$app->get('/user/primium/{ref}', 'Premium:getUserDetailWithPrimiumCours')->setName('prim.user_data');
$app->get('/user/ebook/{ref}', 'Formation:getDetaiEbookCours')->setName('ebook.data');

/*---------------------------------commit--------------------------------------------------*/
$app->post('/premium/formular/apply/{ref}', 'Premium:applySubscriber')->setName('apply');

/**************************** Recherche ****************************************/

$app->get('/search/[{q}]', 'SearchController:searchFromDatabase')->setName('search')->setArguments(['q']);

/**************************** Errors ****************************************/
$app->get('/error/404', 'ErrorController:getErrorPage')->setName('404');


/****************************** About me ********************************/
$app->get('/me', 'ErrorController:getErrorPage')->setName('portefilio');


/****** Ajax stuff *******/
$app->get('/delete/post/{ref}', 'Ajax:deletePost')->setName('post.del');
$app->get('/confirm/post/{ref}', 'Ajax:confirmPost')->setName('confirm.post.del');
$app->get('/delete/formation/{ref}', 'Ajax:deleteFormation')->setName('formation.del');
$app->get('/confirm/formation/{ref}', 'Ajax:deletePost')->setName('confirm.formation.del');
$app->get('/user/user/{ref}', 'Ajax:confirmUser')->setName('auth.user.confirm');
$app->get('/user/disableUser/{ref}', 'Ajax:bannedUser')->setName('auth.user.banned');
$app->get('/user/activatedUser/{ref}', 'Ajax:activatedUser')->setName('auth.user.activated');



