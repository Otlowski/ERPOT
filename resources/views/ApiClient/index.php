<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>API Client - Marenco</title>
        <link media="all" type="text/css" rel="stylesheet" href="/js/AppBase/Extensions/Bootstrap/css/bootstrap.min.css">
        <style>
            body {
                display: block;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                overflow-y:scroll;
                background: #101f39;
                color: #fff;
                font-family: Menlo,Monaco,Consolas,"Courier New",monospace;
                font-size: 13px;
            }
            .container {
                min-width: 800px !important;
                max-width: 900px !important;
                margin: 0 auto;
            }
            select {
                color: #101f39;
            }
            input,
            textarea{
                color: #101f39;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            pre {  
                color: #666;
            }
            .string { color: #4e9a06; /*greenDark*/ }
            .number { color: #ad7fa8; /*violet*/ }
            .boolean { color: #cda000; /*gold*/ }
            .null { color: #999; /*gray*/ font-style: italic; }
            .key { color: #204a87; /*blueDark*/ }

            .data-type {
                background: #000;
                color: #fff;
                border-radius: 3px;
                padding: 2px;
            }
            .data-type__string {
                background: #4e9a06;
            }
        </style>
    </head>
    <body>

        <!-- Hidden input to store Laravel 5.2 ajax communication _token --> 
        <input type="text" name="_token" value="<?= csrf_token() ?>">
        <!-- Content -->
        <div class="container">
            
            <!-- List of available RESTful methods -->
            <div class="row col-xs-12">
                <h6>1. API RESTful methods:</h6>
              <!-- List of available API Methods with sample data -->
                <select id="usemethod">
          <optgroup label="USERS">
            <option rel="POST" rel2='{"username":"user123","email":"example@mail.com","password":"pass","password_confirm":"pass"}' value="/users/registerUser">POST users/registerUser</option>
            <option rel="POST" rel2='{"hash":"6717ba1d2162de4357762ef1923a02c5e787ba1e850740305e1671739c30a35a0c8cba006136a65a5754e35f01a7a2531c22eedff04adf4fe8f50c74f3cf3211"}' value="/users/verifyRegisterHash">POST users/verifyRegisterHash</option>
            <option rel="POST" rel2='{"receiver":"receiver","email":"example@mail.com"}' value="/users/testMailSending">POST users/testMailSending</option>
            <option rel="POST" rel2='{"email":"example@mail.com","password":"pass"}' value="/users/login">POST users/login</option>
            <option rel="POST" rel2='{"hash":"6717ba1d2162de4357762ef1923a02c5e787ba1e850740305e1671739c30a35a0c8cba006136a65a5754e35f01a7a2531c22eedff04adf4fe8f50c74f3cf3211"}' value="/users/logout">POST users/logout</option>
            <option rel="POST" rel2='{"hash":"6717ba1d2162de4357762ef1923a02c5e787ba1e850740305e1671739c30a35a0c8cba006136a65a5754e35f01a7a2531c22eedff04adf4fe8f50c74f3cf3211"}' value="/users/isLogged">POST users/isLogged</option>
            <option rel="POST" rel2='{"with_users_sessions":0,"with_users_mails":0,"with_users_register_hashes":1,"object_ids":[{"object_id":"USXX0000000000000001"},{"object_id":"USXX0000000000000003"}]}' value="/users/listUsers">POST users/listUsers</option>
            <option rel="POST" rel2='{"create":[{"username":"user123","email":"example@mail.com","password":"pass","firstname":"firstname","lastname":"lastname","is_admin":0,"status":"activated"}]}' value="/users/addUser">POST users/addUser</option>
            <option rel="POST" rel2='{"create":[{"object_id":"USXX0000000000000001","username":"user123","email":"example@mail.com","password":"pass","firstname":"firstname","lastname":"lastname","is_admin":0,"status":"activated"}]}' value="/users/updateUser">POST users/updateUser</option>
            <option rel="POST" rel2='{"delete":[{"object_id":"USXX0000000000000001"}]}' value="/users/deleteUser">POST users/deleteUser</option>
            <option rel="POST" rel2='{"locale":"en"}' value="/users/setLocale">POST users/setLocale</option>
            <option rel="POST" rel2='{"object_id":"USXX0000000000000001"}' value="/users/detailsUser">POST users/detailsUser</option>
          </optgroup>
          <optgroup label="USERS GROUPS">
            <option rel="POST" rel2='{"with_users":0}' value="/users/listUsersGroups">POST users/listUsersGroups</option>
            <option rel="POST" rel2='{"create":[{"name":"create NEKST GROUP","description":"CREATED TEST GROUP NO...."}]}' value="/users/addUsersGroups">POST users/addUsersGroups</option>
            <option rel="POST" rel2='{"create":[{"id":"1","name":"testGroupNo.1","description":"TEST GROUP AFTER UPDATE NO1"}]}' value="/users/updateUsersGroups">POST users/updateUsersGroups</option>
            <option rel="POST" rel2='{"delete":[{"id":"1"}]}' value="/users/deleteUsersGroups">POST users/deleteUsersGroups</option
            <option rel="POST" rel2='{"id":"1"}' value="/users/detailsUsersGroups">POST users/detailsUsersGroups</option>
          </optgroup>
          <optgroup label="USERS MAILS">
            <option rel="POST" rel2='' value="/users/listUsersMails">POST users/listUsersMails</option>
            <option rel="POST" rel2='{"create":[{"users__object_id":"USXX0000000000000001","send_date":"2016-08-27 15:30:00","subject":"subject","message":"mail message"}]}' value="/users/addUserMail">POST users/addUserMail</option>
            <option rel="POST" rel2='{"create":[{"id":1,"users__object_id":"USXX0000000000000001","send_date":"2016-08-27 15:30:00","subject":"subject","message":"mail message"}]}' value="/users/updateUserMail">POST users/updateUserMail</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/users/deleteUserMail">POST users/deleteUserMail</option>
          </optgroup>
          <optgroup label="USERS REGISTER HASH">
            <option rel="POST" rel2='' value="/users/listUsersRegisterHashes">POST users/listUsersRegisterHashes</option>
            <option rel="POST" rel2='{"create":[{"users__object_id":"USXX0000000000000001","hash":"6717ba1d2162de4357762ef1923a02c5e787ba1e850740305e1671739c30a35a0c8cba006136a65a5754e35f01a7a2531c22eedff04adf4fe8f50c74f3cf3211","start_at":"2016-08-27 15:30:00","finish_at":"2016-08-27 17:30:00"}]}' value="/users/addUserRegisterHash">POST users/addUserRegisterHash</option>
            <option rel="POST" rel2='{"create":[{"id":1,"users__object_id":"USXX0000000000000001","hash":"6717ba1d2162de4357762ef1923a02c5e787ba1e850740305e1671739c30a35a0c8cba006136a65a5754e35f01a7a2531c22eedff04adf4fe8f50c74f3cf3211","start_at":"2016-08-27 15:30:00","finish_at":"2016-08-27 17:30:00"}]}' value="/users/updateUserRegisterHash">POST users/updateUserRegisterHash</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/users/deleteUserRegisterHash">POST users/deleteUserRegisterHash</option>
          </optgroup>
          <optgroup label="USERS SESSIONS">
            <option rel="POST" rel2='' value="/users/listUsersSessions">POST users/listUsersSessions</option>
            <option rel="POST" rel2='{"create":[{"users__object_id":"USXX0000000000000001","start_at":"2016-08-27 15:30:00","finish_at":"2016-08-27 17:30:00","hash":"6717ba1d2162de4357762ef1923a02c5e787ba1e850740305e1671739c30a35a0c8cba006136a65a5754e35f01a7a2531c22eedff04adf4fe8f50c74f3cf3211"}]}' value="/users/addUserSession">POST users/addUserSession</option>
            <option rel="POST" rel2='{"create":[{"id":1,"users__object_id":"USXX0000000000000001","start_at":"2016-08-27 15:30:00","finish_at":"2016-08-27 17:30:00","hash":"6717ba1d2162de4357762ef1923a02c5e787ba1e850740305e1671739c30a35a0c8cba006136a65a5754e35f01a7a2531c22eedff04adf4fe8f50c74f3cf3211"}]}' value="/users/updateUserSession">POST users/updateUserSession</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/users/deleteUserSession">POST users/deleteUserSession</option>
          </optgroup>
          <optgroup label="[PIVOT] TRAININGS EVENTS CONTENTS">
            <option rel="POST" rel2='{"date":"2016-12-31T23:00:00.000Z"}' value="/trainings/listTrainingsEventsContents">POST trainings/listTrainingsEventsContents</option>
          </optgroup>
          <optgroup label="[PIVOT] TRAININGS EVENTS USERS">
            <option rel="POST" rel2='' value="/trainings/listTrainingsEventsUsers">POST trainings/listTrainingsEventsUsers</option>
          </optgroup>
           <optgroup label="EVENTS">
            <option rel="POST" rel2='{"create":[{"name":"#1 Programming Lesson","rooms__object_id":"ROXX0000000000000001","start_at":"2017-01-02 15:30:00","finish_at":"2017-01-02 17:30:00"}], "users__objects_ids":["USXX0000000000000001","USXX0000000000000002","USXX0000000000000003"],"trainings_contents__ids":[97,98,99,100]}' value="/trainings/addEvent">POST trainings/addEvent</option>
            <option rel="POST" rel2='{"create":[{"id":"1","name":"#updateEventXX1","rooms__object_id":"ROXX0000000000000001","start_at":"2016-08-27 15:30:00","finish_at":"2016-08-27 17:30:00"}]}' value="/trainings/updateEvent">POST trainings/updateEvent</option>
             <option rel="POST" rel2='{"id":"1"}' value="/trainings/deleteEvent">POST trainings/deleteEvent</option>
           </optgroup>
          <optgroup label="TRAININGS EVENTS">
            <option rel="POST" rel2='{"with_trainings_users":0,"with_trainings_notes":0,"with_trainings_leaders":0,"object_ids":[{"object_id":"TRXX0000000000000001"}]}' value="/trainings/listTrainingsEvents">POST trainings/listTrainingsEvents</option>
            <option rel="POST" rel2='{"create":[{"rooms__object_id":"ROXX0000000000000001","trainings_contents__id":1,"seats_amount":20,"start_at":"2016-08-27 15:30:00","finish_at":"2016-08-27 17:30:00","status":"not finished"}]}' value="/trainings/addTrainingEvent">POST trainings/addTrainingEvent</option>
            <option rel="POST" rel2='{"create":[{"object_id":"TRXX0000000000000001","rooms__object_id":"ROXX0000000000000001","trainings_contents__id":1,"seats_amount":20,"start_at":"2016-08-27 15:30:00","finish_at":"2016-08-27 17:30:00","status":"not finished"}]}' value="/trainings/updateTrainingEvent">POST trainings/updateTrainingEvent</option>
            <option rel="POST" rel2='{"delete":[{"object_id":"TRXX0000000000000001"}]}' value="/trainings/deleteTrainingEvent">POST trainings/deleteTrainingEvent</option>
            <option rel="POST" rel2='{"id":"1"}' value="/trainings/detailsTrainingEvent">POST trainings/detailsTrainingEvent</option>
          </optgroup>
          <optgroup label="TRAININGS GROUPS">
            <option rel="POST" rel2='{"with_trainings":1}' value="/trainings/listTrainingsGroups">POST trainings/listTrainingsGroups</option>   
            <option rel="POST" rel2='{"create":[{"name":"create Group","description":"CREATED TEST GROUP NO...."}]}' value="/trainings/addTrainingsGroups">POST trainings/addTrainingsGroups</option>
            <option rel="POST" rel2='{"create":[{"id":"1","name":"testGroupNo.1","description":"TEST GROUP AFTER UPDATE NO1"}]}' value="/trainings/updateTrainingsGroups">POST trainings/updateTrainingsGroups</option>
            <option rel="POST" rel2='{"delete":[{"id":"1"}]}' value="/trainings/deleteTrainingsGroups">POST trainings/deleteTrainingsGroups</option>
            <option rel="POST" rel2='{"id":"1"}' value="/trainings/detailsTrainingsGroups">POST trainings/detailsTrainingsGroups</option>
          </optgroup>
          <optgroup label="TRAININGS CONTENTS">
            <option rel="POST" rel2='{"with_trainings":1,"with_trainings_documents":0,"with_trainings_chapters":"0"}' value="/trainings/listTrainingsContents">POST trainings/listTrainingsContents</option>
            <option rel="POST" rel2='{"create":[{"name":"content name","description":"content description"}]}' value="/trainings/addTrainingContent">POST trainings/addTrainingContent</option>
            <option rel="POST" rel2='{"create":[{"id":1,"name":"content name","description":"content description"}]}' value="/trainings/updateTrainingContent">POST trainings/updateTrainingContent</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/trainings/deleteTrainingContent">POST trainings/deleteTrainingContent</option>
            <option rel="POST" rel2='{"id":"1"}' value="/trainings/detailsTrainingContent">POST trainings/detailsTrainingContent</option>
          </optgroup>
          <optgroup label="TRAININGS DOCUMENTS">
            <option rel="POST" rel2='' value="/trainings/listTrainingsDocuments">POST trainings/listTrainingsDocuments</option>
            <option rel="POST" rel2='{"create":[{"trainings_contents__id":1,"name":"document name","description":"document description","source":"document source"}]}' value="/trainings/addTrainingDocument">POST trainings/addTrainingDocument</option>
            <option rel="POST" rel2='{"create":[{"id":1,"trainings_contents__id":1,"name":"document name","description":"document description","source":"document source"}]}' value="/trainings/updateTrainingDocument">POST trainings/updateTrainingDocument</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/trainings/deleteTrainingDocument">POST trainings/deleteTrainingDocument</option>
          </optgroup>
          <optgroup label="TRAININGS LEADERS">
            <option rel="POST" rel2='' value="/trainings/listTrainingsLeaders">POST trainings/listTrainingsLeaders</option>
            <option rel="POST" rel2='{"create":[{"users__object_id":"USXX0000000000000001","trainings__object_id":"TRXX0000000000000001"}]}' value="/trainings/addTrainingLeader">POST trainings/addTrainingLeader</option>
            <option rel="POST" rel2='{"create":[{"id":1,"users__object_id":"USXX0000000000000001","trainings__object_id":"TRXX0000000000000001"}]}' value="/trainings/updateTrainingLeader">POST trainings/updateTrainingLeader</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/trainings/deleteTrainingLeader">POST trainings/deleteTrainingLeader</option>
          </optgroup>
          <optgroup label="TRAININGS NOTES">
            <option rel="POST" rel2='' value="/trainings/listTrainingsNotes">POST trainings/listTrainingsNotes</option>
            <option rel="POST" rel2='{"create":[{"trainings__object_id":"TRXX0000000000000001","note":"trainings note"}]}' value="/trainings/addTrainingNote">POST trainings/addTrainingNote</option>
            <option rel="POST" rel2='{"create":[{"id":1,"trainings__object_id":"TRXX0000000000000001","note":"trainings note"}]}' value="/trainings/updateTrainingNote">POST trainings/updateTrainingNote</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/trainings/deleteTrainingNote">POST trainings/deleteTrainingNote</option>
          </optgroup>
          <optgroup label="TRAININGS USERS">
            <option rel="POST" rel2='' value="/trainings/listTrainingsUsers">POST trainings/listTrainingsUsers</option>
            <option rel="POST" rel2='{"create":[{"users__object_id":"USXX0000000000000001","trainings__object_id":"TRXX0000000000000001","presence_confirmation":"2016-08-27 15:30:00"}]}' value="/trainings/addTrainingUser">POST trainings/addTrainingUser</option>
            <option rel="POST" rel2='{"create":[{"id":1,"users__object_id":"USXX0000000000000001","trainings__object_id":"TRXX0000000000000001","presence_confirmation":"2016-08-27 15:30:00"}]}' value="/trainings/updateTrainingUser">POST trainings/updateTrainingUser</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/trainings/deleteTrainingUser">POST trainings/deleteTrainingUser</option>
          </optgroup>
          <optgroup label="TRAININGS CHAPTERS">
            <option rel="POST" rel2='' value="/trainings/listTrainingsChapters">POST trainings/listTrainingsChapters</option>
            <option rel="POST" rel2='{"create":[{"trainings_contents__id":1,"value":"some text"}]}' value="/trainings/addTrainingChapter">POST trainings/addTrainingChapter</option>
            <option rel="POST" rel2='{"create":[{"id":1,"trainings_contents__id":1,"value":"some text"}]}' value="/trainings/updateTrainingChapter">POST trainings/updateTrainingChapter</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/trainings/deleteTrainingChapter">POST trainings/deleteTrainingChapter</option>
          </optgroup>
          <optgroup label="QUESTIONNAIRES">
            <option rel="POST" rel2='{"with_questionnaires_items":0,"with_questionnaires_users":1,"object_ids":[{"object_id":"QUXX0000000000000001"},{"object_id":"QUXX0000000000000003"}]}' value="/questionnaires/listQuestionnaires">POST questionnaires/listQuestionnaires</option>
            <option rel="POST" rel2='{"create":[{"trainings_contents__id":"1","name":"name","description":"description","status":"not finished","source":"source"}]}' value="/questionnaires/addQuestionnaire">POST questionnaires/addQuestionnaire</option>
            <option rel="POST" rel2='{"create":[{"object_id":"QUXX0000000000000001","trainings_contents__id":"1","name":"name","description":"description","status":"not finished","source":"source"}]}' value="/questionnaires/updateQuestionnaire">POST questionnaires/updateQuestionnaire</option>
            <option rel="POST" rel2='{"delete":[{"object_id":"QUXX0000000000000001"}]}' value="/questionnaires/deleteQuestionnaire">POST questionnaires/deleteQuestionnaire</option>
          </optgroup>
          <optgroup label="QUESTIONNAIRES FEEDBACKS">
            <option rel="POST" rel2='' value="/questionnaires/listQuestionnairesFeedbacks">POST questionnaires/listQuestionnairesFeedbacks</option>
            <option rel="POST" rel2='{"create":[{"questionnaires_items__id":1,"value":"value","username":"username"}]}' value="/questionnaires/addQuestionnaireFeedback">POST questionnaires/addQuestionnaireFeedback</option>
            <option rel="POST" rel2='{"create":[{"id":1,"questionnaires_items__id":1,"value":"value","username":"username"}]}' value="/questionnaires/updateQuestionnaireFeedback">POST questionnaires/updateQuestionnaireFeedback</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/questionnaires/deleteQuestionnaireFeedback">POST questionnaires/deleteQuestionnaireFeedback</option>
          </optgroup>
          <optgroup label="QUESTIONNAIRES ITEMS">
            <option rel="POST" rel2='{"with_questionnaires_feedbacks":1}' value="/questionnaires/listQuestionnairesItems">POST questionnaires/listQuestionnairesItems</option>
            <option rel="POST" rel2='{"create":[{"questionnaires__object_id":"QUXX0000000000000001","value":"some question"}]}' value="/questionnaires/addQuestionnaireItem">POST questionnaires/addQuestionnaireItem</option>
            <option rel="POST" rel2='{"create":[{"id":1,"questionnaires__object_id":"QUXX0000000000000001","value":"some question"}]}' value="/questionnaires/updateQuestionnaireItem">POST questionnaires/updateQuestionnaireItem</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/questionnaires/deleteQuestionnaireItem">POST questionnaires/deleteQuestionnaireItem</option>
          </optgroup>
          <optgroup label="QUESTIONNAIRES USERS">
            <option rel="POST" rel2='' value="/questionnaires/listQuestionnairesUsers">POST questionnaires/listQuestionnairesUsers</option>
            <option rel="POST" rel2='{"create":[{"questionnaires__object_id":"QUXX0000000000000001","users__object_id":"USXX0000000000000001","trainings_users__id":1,"status":"not finished","result":0}]}' value="/questionnaires/addQuestionnaireUser">POST questionnaires/addQuestionnaireUser</option>
            <option rel="POST" rel2='{"create":[{"id":1,"questionnaires__object_id":"QUXX0000000000000001","users__object_id":"USXX0000000000000001","trainings_users__id":1,"status":"not finished","result":0}]}' value="/questionnaires/updateQuestionnaireUser">POST questionnaires/updateQuestionnaireUser</option>
            <option rel="POST" rel2='{"delete":[{"id":1}]}' value="/questionnaires/deleteQuestionnaireUser">POST questionnaires/deleteQuestionnaireUser</option>
          </optgroup>
          <optgroup label="ROOMS">
            <option rel="POST" rel2='{"with_trainings":1,"object_ids":[{"object_id":"ROXX0000000000000001"},{"object_id":"ROXX0000000000000003"}]}' value="/rooms/listRooms">POST rooms/listRooms</option>
            <option rel="POST" rel2='{"create":[{"free_seats_amount":"50","localization":"section A","number":203}]}' value="/rooms/addRoom">POST rooms/addRoom</option>
            <option rel="POST" rel2='{"create":[{"object_id":"ROXX0000000000000001","free_seats_amount":"50","localization":"section A","number":203}]}' value="/rooms/updateRoom">POST rooms/updateRoom</option>
            <option rel="POST" rel2='{"delete":[{"object_id":"ROXX0000000000000001"}]}' value="/rooms/deleteRoom">POST rooms/deleteRoom</option>
            <option rel="POST" rel2='{"roomId":"1"}' value="/rooms/detailsRoom">POST rooms/detailsRoom</option>
          </optgroup>
          <optgroup label="ROOMS GROUPS">
            <option rel="POST" rel2='{"with_rooms":1}' value="/rooms/listRoomsGroups">POST rooms/listRoomsGroups</option>   
            <option rel="POST" rel2='{"create":[{"name":"create Group","description":"CREATED TEST GROUP NO...."}]}' value="/rooms/addRoomsGroups">POST rooms/addRoomsGroups</option>
            <option rel="POST" rel2='{"create":[{"id":"1","name":"testGroupNo.1","description":"TEST GROUP AFTER UPDATE NO1"}]}' value="/rooms/updateRoomsGroups">POST rooms/updateRoomsGroups</option>
            <option rel="POST" rel2='{"delete":[{"id":"1"}]}' value="/rooms/deleteRoomsGroups">POST rooms/deleteRoomsGroups</option>
            <option rel="POST" rel2='{"id":"1"}' value="/rooms/detailsRoomsGroups">POST rooms/detailsRoomsGroups</option>
          </optgroup>
          <optgroup label="REPORTS">
            <option rel="POST" rel2='{"start_at":"2016-05-27","finish_at":"2016-08-27"}' value="/reports/showTrainingsStats">POST reports/showTrainingsStats</option>
            <option rel="POST" rel2='{"start_at":"2016-05-27","finish_at":"2016-08-27"}' value="/reports/showQuestionnairesStats">POST reports/showQuestionnairesStats</option>
          </optgroup>
      </select>
            </div>
            <!-- Custom RESTful method -->
            <div class="row col-xs-12">
                <h6>2. API RESTful request header settings:</h6>
                <select id="method">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="PUT">PUT</option>
                    <option value="DELETE">DELETE</option>
                </select>
                <!-- Virtual host URL -->
                https://<?= $_SERVER['HTTP_HOST'] ?><input type="text" size="30" name="url" id="url" value="" />
            </div>
            <!-- Session hash -->
            <div class="row col-xs-12">
                <h6>3. User session hash data:</h6>
                <textarea id="hashdata" style="width:100%;height:20px;"></textarea>
            </div>
            <!-- Data params -->
            <div class="row col-xs-12">
                <h6>4. API RESTful form data:</h6>
                <textarea id="jsondata" style="width:100%;height:100px;"></textarea>
            </div>
            <!-- Buttons: Run | Select all | Copy -->
            <div class="row col-xs-12" style="text-align: center;padding-top: 10px;">
                <button id="runbutton" class="btn btn-default" type="button">Send request</button>
            </div>
            <!-- Response -->
            <div class="row col-xs-12">
                <h6>5. Response:</h6>
                <div id="log" style="display:none"></div>
                <pre id="jsonColorized" style="max-height: 400px; overflow-y: scroll;"></pre>
            </div>
        </div>
       
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    var apiClientVC = {};
    apiClientVC._token = $('input[name=_token]').val();

    apiClientVC.$buttonSend = $('#runbutton');
    apiClientVC.$textToken = null;
    apiClientVC.$textParams = null;
    apiClientVC.$textResponseRaw = $('#jsonRaw');
    apiClientVC.$textResponseColorize = $('#jsonColorized');

    apiClientVC.initView = function () {
        console.info("init view");
        console.info(apiClientVC._token);
        $('#usemethod').on("change", apiClientVC.onUriListChange);
        $('#runbutton').unbind('click').click(apiClientVC.onSendClick);
    };

    apiClientVC.onUriListChange = function (e) {
        console.info("API Method changed");

        $('#url').attr('value', $(this).val());
        $('#method').val($("#usemethod option:selected").attr('rel'));
        $('#jsondata').val($("#usemethod option:selected").attr('rel2'));

    };

    apiClientVC.onSendClick = function (e) {
        console.info("Send button click");
        var jsonObject = ($('#jsondata').val() !== '') ? $('#jsondata').val() : null;

        var dataParam = {
            'url': $('#url').val(),
            'method': $('#method').val(),
            'json': jsonObject
        };
        apiClientVC.testApiDirect(dataParam);
        //apiClientVC.testApiByCUrl(dataParam);
    };

    apiClientVC.testJsonString = function(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    };
    
    apiClientVC.testApiDirect = function (dataParam) {
        try {
            
            // clear form
            apiClientVC.$textResponseRaw.html("");
            apiClientVC.$textResponseColorize.html("");
            $('#log').html('');
            
            // Set token do communikation
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': apiClientVC._token
                }
            });
            // send request
            $.ajax({
                url: dataParam.url,
                type: dataParam.method,
                processData: "false",
                dataType:   "json",
                data: JSON.parse(dataParam.json),
                beforeSend: function () {
                    $('#log').html('');
                },
                success: function (response) {
                    if( !apiClientVC.testJsonString( JSON.stringify(response) ) ) {
                        apiClientVC.$textResponseColorize.html(response);
                        return;
                    }
                    var jsonObj = response;
                    var jsonRawStr = JSON.stringify(jsonObj, undefined, 4);
                    var jsonColorizedStr = apiClientVC.syntaxHighlight(jsonRawStr);

                    apiClientVC.$textResponseRaw.append(jsonRawStr);
                    apiClientVC.$textResponseColorize.append(jsonColorizedStr);

                    // remember session hash if login method has been executed:
                    if ($('#url').val() == '/users/login') {
                        var responseData = JSON.parse(response);
                        $("#hashdata").val('"hash":"' + responseData.message.hash + '"');
                    }

                },
                error: function (response) {
                    $('#log').html(response);
                    apiClientVC.$textResponseColorize.html(response);
                    
                    alert('API URI Error');
                    console.log('API URI Error');
                }
            });
        } catch (ex) {
            console.log('Processing error...');
        }
        ;

    };
    
    apiClientVC.testApiByCUrl = function (dataParam) {
        //try {
            // clear form
            apiClientVC.$textResponseRaw.html("");
            apiClientVC.$textResponseColorize.html("");
            $('#log').html('');
            // extend dataParam [ laravel _token | session hash ]
            var jsonString = dataParam.json;
            var jsonObj = JSON.parse(jsonString);
                jsonObj._token = apiClientVC._token;
                jsonString = JSON.stringify(jsonObj);
                console.log(jsonString);
            
                dataParam.json = jsonString;
            
            // Set token do communikation
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': apiClientVC._token
                }
            });
            // send request
            $.ajax({
                url: '/developers/api/send',
                type: 'POST',
                processData: "false",
                data: dataParam,
                beforeSend: function () {
                    $('#log').html('');
                },
                success: function (response) {
                    if( !apiClientVC.testJsonString(response) ) {
                        apiClientVC.$textResponseColorize.html(response);
                        return;
                    }
                    var jsonObj = JSON.parse(response);
                    var jsonRawStr = JSON.stringify(jsonObj, undefined, 4);
                    var jsonColorizedStr = apiClientVC.syntaxHighlight(jsonRawStr);

                    apiClientVC.$textResponseRaw.append(jsonRawStr);
                    apiClientVC.$textResponseColorize.append(jsonColorizedStr);

                    // remember session hash if login method has been executed:
                    if ($('#url').val() == '/users/login') {
                        var responseData = JSON.parse(response);
                        $("#hashdata").val('"hash":"' + responseData.message.hash + '"');
                    }

                },
                error: function (response) {
                    $('#log').html(response);
                    apiClientVC.$textResponseColorize.html(response);
                    
                    alert('API URI Error');
                    console.log('API URI Error');
                }
            });
//        } catch (ex) {
//            console.log('Processing error...');
//        }
        ;

    };

    apiClientVC.syntaxHighlight = function (json) {
        json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
            var cls = 'number';
            if (/^"/.test(match)) {
                if (/:$/.test(match)) {
                    cls = 'key';
                } else {
                    cls = 'string';
                }
            } else if (/true|false/.test(match)) {
                cls = 'boolean';
            } else if (/null/.test(match)) {
                cls = 'null';
            }
            return '<span class="' + cls + '">' + match + '</span>';
        });
    };


    $(document).ready(function () {
        apiClientVC.initView();
    });

</script>
</body>
</html>
