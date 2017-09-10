<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Http\Controllers\Questionnaires;
use App\Http\Controllers\Rooms;
use App\Http\Controllers\Users;
use App\Http\Controllers\Trainings;
use App\Http\Controllers\Chat;
use App\Http\Controllers\ApiClient\ApiClientController;

//Route::get('/', function() {
//    return view('welcome');
//});
// Route::get('/', ['uses' => 'UsersViewsController@indexDashboard', 'middleware'=>'auth']);

/* App :: API Test enviroment (Test client) */
Route::group([ 'prefix' => 'developers', 'middlewareGroups' => ['web']], function() {
    Route::get('/info',         function() { phpinfo(); die(); });
    Route::get('/api',          ['uses' => 'ApiClient\ApiClientController@showForm']);
    Route::post('/api/send',    ['uses' => 'ApiClient\ApiClientController@sendData']);
});

/* [GET] Webpages */
// Route::auth();

Route::get('/login',                                        ['uses' => 'UsersViewsController@indexLogin']);
Route::get('/register',                                     ['uses' => 'UsersViewsController@indexRegister']);

Route::group(
             ['middleware' => 'web'], function() {

    Route::get('/',                                             ['uses' => 'UsersViewsController@indexDashboard']);
    Route::get('/dashboard',                                    ['uses' => 'UsersViewsController@indexDashboard']);
    Route::get('/users',                                        ['uses' => 'UsersViewsController@indexUsers']);
    Route::get('/courses',                                      ['uses' => 'UsersViewsController@indexCourses']);
    Route::get('/calendar',                                     ['uses' => 'UsersViewsController@indexCalendar']);


    Route::get('/chat',                                         ['uses' => 'Chat\ChatController@showChat']);

    Route::get('/verify/{hash}',                                ['uses' => 'Users\UsersController@verifyRegisterLink']);

    Route::get('/rooms',                                        ['uses' => 'Rooms\RoomsController@showRoomsIndex']);

    Route::get('/trainings',                                    ['uses' => 'Trainings\TrainingsEventsController@showTrainingsIndex']);

    Route::get('/trainings/calendar',                           ['uses' => 'Trainings\TrainingsEventsController@showTrainingsCalendar']);


    Route::group(['prefix' => 'reports' ,'namespace' => 'Reports'], function() {
        Route::get('/trainings',                                ['uses' => 'ReportsController@showTrainingsIndex']);
        Route::get('/questionnaires',                           ['uses' => 'ReportsController@showQuestionnairesIndex']);
    });
});





/* [POST] Trainings */
Route::group(['prefix' => 'trainings', 'middlewareGroups' => ['web']], function() {
    /*  Events  */
    Route::post('addEvent',                                           ['uses' => 'Events\EventsController@addEvent']);
    Route::post('updateEvent',                                        ['uses' => 'Events\EventsController@updateEvent']);
    Route::post('deleteEvent',                                        ['uses' => 'Events\EventsController@deleteEvent']);
    /*  Training  */
    Route::post('listTrainingsEvents',                                ['uses' => 'Trainings\TrainingsEventsController@listTrainingsEvents']);
    Route::post('addTrainingEvent',                                   ['uses' => 'Trainings\TrainingsEventsController@addTrainingEvent']);
    Route::post('updateTrainingEvent',                                ['uses' => 'Trainings\TrainingsEventsController@updateTrainingEvent']);
    Route::post('deleteTrainingEvent',                                ['uses' => 'Trainings\TrainingsEventsController@deleteTrainingEvent']);
    Route::post('detailsTrainingEvent',                               ['uses' => 'Trainings\TrainingsEventsController@detailsTrainingEvent']);

     /*  TrainingGroup  */

    Route::post('listTrainingsGroups',                  ['uses' => 'Trainings\TrainingsGroupsController@listTrainingsGroups']);
    Route::post('addTrainingsGroups',                   ['uses' => 'Trainings\TrainingsGroupsController@addTrainingsGroups']);
    Route::post('updateTrainingsGroups',                ['uses' => 'Trainings\TrainingsGroupsController@updateTrainingsGroups']);
    Route::post('deleteTrainingsGroups',                ['uses' => 'Trainings\TrainingsGroupsController@deleteTrainingsGroups']);
    Route::post('detailsTrainingsGroups',               ['uses' => 'Trainings\TrainingsGroupsController@detailsTrainingsGroups']);

    /*  TrainingContent  */
    Route::post('listTrainingsContents',                         ['uses' => 'Trainings\TrainingsContentsController@listTrainingsContents']);
    Route::post('addTrainingContent',                            ['uses' => 'Trainings\TrainingsContentsController@addTrainingContent']);
    Route::post('updateTrainingContent',                         ['uses' => 'Trainings\TrainingsContentsController@updateTrainingContent']);
    Route::post('deleteTrainingContent',                         ['uses' => 'Trainings\TrainingsContentsController@deleteTrainingContent']);
    Route::post('detailsTrainingContent',                        ['uses' => 'Trainings\TrainingsContentsController@detailsTrainingContent']);

    /*  TrainingDocument  */
    Route::post('listTrainingsDocuments',                        ['uses' => 'Trainings\TrainingsDocumentsController@listTrainingsDocuments']);
    Route::post('addTrainingDocument',                           ['uses' => 'Trainings\TrainingsDocumentsController@addTrainingDocument']);
    Route::post('updateTrainingDocument',                        ['uses' => 'Trainings\TrainingsDocumentsController@updateTrainingDocument']);
    Route::post('deleteTrainingDocument',                        ['uses' => 'Trainings\TrainingsDocumentsController@deleteTrainingDocument']);

    /*  TrainingLeader  */
    Route::post('listTrainingsLeaders',                          ['uses' => 'Trainings\TrainingsLeadersController@listTrainingsLeaders']);
    Route::post('addTrainingLeader',                             ['uses' => 'Trainings\TrainingsLeadersController@addTrainingLeader']);
    Route::post('updateTrainingLeader',                          ['uses' => 'Trainings\TrainingsLeadersController@updateTrainingLeader']);
    Route::post('deleteTrainingLeader',                          ['uses' => 'Trainings\TrainingsLeadersController@deleteTrainingLeader']);

    /*  TrainingNote  */
    Route::post('listTrainingsNotes',                            ['uses' => 'Trainings\TrainingsNotesController@listTrainingsNotes']);
    Route::post('addTrainingNote',                               ['uses' => 'Trainings\TrainingsNotesController@addTrainingNote']);
    Route::post('updateTrainingNote',                            ['uses' => 'Trainings\TrainingsNotesController@updateTrainingNote']);
    Route::post('deleteTrainingNote',                            ['uses' => 'Trainings\TrainingsNotesController@deleteTrainingNote']);

    /*  TrainingUser  */
    Route::post('listTrainingsUsers',                            ['uses' => 'Trainings\TrainingsUsersController@listTrainingsUsers']);
    Route::post('addTrainingUser',                               ['uses' => 'Trainings\TrainingsUsersController@addTrainingUser']);
    Route::post('updateTrainingUser',                            ['uses' => 'Trainings\TrainingsUsersController@updateTrainingUser']);
    Route::post('deleteTrainingUser',                            ['uses' => 'Trainings\TrainingsUsersController@deleteTrainingUser']);

    /*  TrainingChapter  */
    Route::post('listTrainingsChapters',                        ['uses' => 'Trainings\TrainingsChaptersController@listTrainingsChapters']);
    Route::post('addTrainingChapter',                           ['uses' => 'Trainings\TrainingsChaptersController@addTrainingChapter']);
    Route::post('updateTrainingChapter',                        ['uses' => 'Trainings\TrainingsChaptersController@updateTrainingChapter']);
    Route::post('deleteTrainingChapter',                        ['uses' => 'Trainings\TrainingsChaptersController@deleteTrainingChapter']);

    /* Pivot TrainingEventContent*/
    Route::post('listTrainingsEventsContents',                  ['uses' => 'Trainings\TrainingEventContentController@listTrainingsEventsContents']);
   Route::post('addTrainingEvent',                                   ['uses' => 'Trainings\TrainingsEventsController@addTrainingEvent']);
   Route::post('updateTrainingEvent',                                ['uses' => 'Trainings\TrainingsEventsController@updateTrainingEvent']);
   Route::post('deleteTrainingEvent',                                ['uses' => 'Trainings\TrainingsEventsController@deleteTrainingEvent']);

    /* Pivot TrainingEventUser*/

  Route::post('listTrainingsEventsUsers',                    ['uses' => 'Trainings\TrainingsEventsUsersController@listTrainingsEventsUsers']);
   Route::post('addTrainingEventUsers',                              ['uses' => 'Trainings\TrainingsEventsUsersController@addTrainingsEventsUsers']);
   Route::post('updateTrainingEventUsers',                           ['uses' => 'Trainings\TrainingsEventsUsersController@updateTrainingsEventsUsers']);
   Route::post('deleteTrainingEventUsers',                           ['uses' => 'Trainings\TrainingsEventsUsersController@deleteTrainingsEventsUsers']);
});

/* [POST] Users */
Route::group(['prefix' => 'users', 'middlewareGroups' => ['web']], function() {

    /*  User  */
    Route::post('registerUser',                     ['uses' => 'Users\UsersController@registerUser']);
    Route::post('login',                            ['uses' => 'Users\UsersController@login']);
    Route::post('logout',                           ['uses' => 'Users\UsersController@logout']);
    Route::post('isLogged',                         ['uses' => 'Users\UsersController@risLogged']);
    Route::post('testMailSending',                  ['uses' => 'Users\UsersController@testMailSending']);
    Route::post('listUsers',                        ['uses' => 'Users\UsersController@listUsers']);
    Route::post('addUser',                          ['uses' => 'Users\UsersController@addUser']);
    Route::post('updateUser',                       ['uses' => 'Users\UsersController@updateUser']);
    Route::post('deleteUser',                       ['uses' => 'Users\UsersController@deleteUser']);
    Route::post('setLocale',                        ['uses' => 'Users\UsersController@setLocale']);
    Route::post('detailsUser',                      ['uses' => 'Users\UsersController@detailsUser']);

    /*  UserMail  */
    Route::post('listUsersMails',                   ['uses' => 'Users\UsersMailsController@listUsersMails']);
    Route::post('addUserMail',                      ['uses' => 'Users\UsersMailsController@addUserMail']);
    Route::post('updateUserMail',                   ['uses' => 'Users\UsersMailsController@updateUserMail']);
    Route::post('deleteUserMail',                   ['uses' => 'Users\UsersMailsController@deleteUserMail']);

     /*  UserRegisterHash  */
    Route::post('listUsersRegisterHashes',          ['uses' => 'Users\UsersRegisterHashesController@listUsersRegisterHashes']);
    Route::post('addUserRegisterHash',              ['uses' => 'Users\UsersRegisterHashesController@addUserRegisterHash']);
    Route::post('updateUserRegisterHash',           ['uses' => 'Users\UsersRegisterHashesController@updateUserRegisterHash']);
    Route::post('deleteUserRegisterHash',           ['uses' => 'Users\UsersRegisterHashesController@deleteUserRegisterHash']);

     /*  UserSession  */
    Route::post('listUsersSessions',                ['uses' => 'Users\UsersSessionsController@listUsersSessions']);
    Route::post('addUserSession',                   ['uses' => 'Users\UsersSessionsController@addUserSession']);
    Route::post('updateUserSession',                ['uses' => 'Users\UsersSessionsController@updateUserSession']);
    Route::post('deleteUserSession',                ['uses' => 'Users\UsersSessionsController@deleteUserSession']);

     /*  UserGroup  */
    Route::post('listUsersGroups',                  ['uses' => 'Users\UsersGroupsController@listUsersGroups']);
    Route::post('addUsersGroups',                   ['uses' => 'Users\UsersGroupsController@addUsersGroups']);
    Route::post('updateUsersGroups',                ['uses' => 'Users\UsersGroupsController@updateUsersGroups']);
    Route::post('deleteUsersGroups',                ['uses' => 'Users\UsersGroupsController@deleteUsersGroups']);
    Route::post('detailsUsersGroups',               ['uses' => 'Users\UsersGroupsController@detailsUsersGroups']);
});

/* [POST] Rooms */
Route::group(['prefix' => 'rooms', 'middlewareGroups' => ['web']], function() {

     /*  Room  */
    Route::post('listRooms',           ['uses' => 'Rooms\RoomsController@listRooms']);
    Route::post('addRoom',             ['uses' => 'Rooms\RoomsController@addRoom']);
    Route::post('updateRoom',          ['uses' => 'Rooms\RoomsController@updateRoom']);
    Route::post('deleteRoom',          ['uses' => 'Rooms\RoomsController@deleteRoom']);
    Route::post('detailsRoom',         ['uses' => 'Rooms\RoomsController@detailsRoom']);

    /*  Rooms Groups */
    Route::post('listRoomsGroups',            ['uses' => 'Rooms\RoomsGroupsController@listRoomsGroups']);
    Route::post('addRoomsGroups',             ['uses' => 'Rooms\RoomsGroupsController@addRoomsGroups']);
    Route::post('updateRoomsGroups',          ['uses' => 'Rooms\RoomsGroupsController@updateRoomsGroups']);
    Route::post('deleteRoomsGroups',          ['uses' => 'Rooms\RoomsGroupsController@deleteRoomsGroups']);
    Route::post('detailsRoomsGroups',         ['uses' => 'Rooms\RoomsGroupsController@detailsRoomsGroups']);

});

/* [POST] Questionnaires */
Route::group(['prefix' => 'questionnaires', 'middlewareGroups' => ['web']], function() {

    /*  Questionnaire  */
    Route::post('listQuestionnaires',                                 ['uses' => 'Questionnaires\QuestionnairesController@listQuestionnaires']);
    Route::post('addQuestionnaire',                                   ['uses' => 'Questionnaires\QuestionnairesController@addQuestionnaire']);
    Route::post('updateQuestionnaire',                                ['uses' => 'Questionnaires\QuestionnairesController@updateQuestionnaire']);
    Route::post('deleteQuestionnaire',                                ['uses' => 'Questionnaires\QuestionnairesController@deleteQuestionnaire']);

    /*  QuestionnaireFeedback  */
    Route::post('listQuestionnairesFeedbacks',                        ['uses' => 'Questionnaires\QuestionnairesFeedbacksController@listQuestionnairesFeedbacks']);
    Route::post('addQuestionnaireFeedback',                           ['uses' => 'Questionnaires\QuestionnairesFeedbacksController@addQuestionnaireFeedback']);
    Route::post('updateQuestionnaireFeedback',                        ['uses' => 'Questionnaires\QuestionnairesFeedbacksController@updateQuestionnaireFeedback']);
    Route::post('deleteQuestionnaireFeedback',                        ['uses' => 'Questionnaires\QuestionnairesFeedbacksController@deleteQuestionnaireFeedback']);

    /*  QuestionnaireItem  */
    Route::post('listQuestionnairesItems',                            ['uses' => 'Questionnaires\QuestionnairesItemsController@listQuestionnairesItems']);
    Route::post('addQuestionnaireItem',                               ['uses' => 'Questionnaires\QuestionnairesItemsController@addQuestionnaireItem']);
    Route::post('updateQuestionnaireItem',                            ['uses' => 'Questionnaires\QuestionnairesItemsController@updateQuestionnaireItem']);
    Route::post('deleteQuestionnaireItem',                            ['uses' => 'Questionnaires\QuestionnairesItemsController@deleteQuestionnaireItem']);

    /*  QuestionnaireUser  */
    Route::post('listQuestionnairesUsers',                            ['uses' => 'Questionnaires\QuestionnairesUsersController@listQuestionnairesUsers']);
    Route::post('addQuestionnaireUser',                               ['uses' => 'Questionnaires\QuestionnairesUsersController@addQuestionnaireUser']);
    Route::post('updateQuestionnaireUser',                            ['uses' => 'Questionnaires\QuestionnairesUsersController@updateQuestionnaireUser']);
    Route::post('deleteQuestionnaireUser',                            ['uses' => 'Questionnaires\QuestionnairesUsersController@deleteQuestionnaireUser']);
});

/* [POST] Reports */
Route::group(['prefix' => 'reports', 'middlewareGroups' => ['web']], function() {

    /*  Trainings  */
    Route::post('showTrainingsStats',                                 ['uses' => 'Reports\TrainingsController@showTrainingsStats']);

    /*  Questionnaires  */
    Route::post('showQuestionnairesStats',                            ['uses' => 'Reports\QuestionnairesController@showQuestionnairesStats']);
});

/* [POST] Reports */
Route::group(['middlewareGroups' => ['web']], function() {

    Route::post('chat',                                               ['uses' => 'Chat\ChatController@showChat']);
});

Route::auth();

Route::get('/home', 'HomeController@index');
