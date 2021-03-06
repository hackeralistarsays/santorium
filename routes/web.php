<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home1');
});

Route::get('/test_style', function(){
    return view('index');
});

// Route::view('/signin', 'signin');
Route::view('/signin', 'login');
Route::get('/insert_dummy_user', 'DummyData@insertUser');

Route::post('/staffLogin', 'LoginController@submitDetails');
Route::get('/users/logout', 'LogoutController@logout');

Route::view('/forgotPassword', 'forgotPassword');
Route::view('/code', 'inputToken');
Route::view('/updatePassword', 'updatePassword');

Route::post('forgot_password_submit', 'ResetPasswordSendMailController@sendEmailToUser');

Route::post('/reset_password', 'ForgotPassword@reset_password');

Route::post('/reset_pass', 'LoginController@resetPassword');

Route::view('/addStudent', 'add_student')->middleware('sessionChecker');
Route::get('/add_student', 'Students@addStudentForm')->middleware('principal_DP_examinationChecker');

Route::view('/addStudentDetails', 'final_student_form')->middleware('principal_DP_examinationChecker');

Route::view('/addParent', 'add_parent')->middleware('principal_DP_examinationChecker');

Route::view('/addTeacher', 'add_teacher')->middleware('principalChecker');
Route::post('/add_teacher', 'Teachers@insertTeacher')->middleware('principalChecker');

Route::view('/addAddress', 'add_address')->middleware('principal_DP_examinationChecker');

Route::view('/addStaff', 'add_non_teaching_staff')->middleware('sessionChecker');
Route::post('/add_staff', 'Non_teaching_staff_controller@insertStaff')->middleware('principal_DPChecker');
Route::get('/nonTeachingStaffDetails', 'Non_teaching_staff_controller@showStaff')->middleware('principal_DPChecker');



//Phamacy route
Route::get('/phamacy/index', 'PhamacyController@index')->name('pharmacy.index');
Route::get('/pharmacy/products', 'PhamacyController@products')->name('pharmacy.products');



//route to a specific non teaching staff details
Route::get('/staff_details/{id}', 'Non_teaching_staff_controller@specificStaff')->middleware('principal_DPChecker');
Route::post('edit_staff','Non_teaching_staff_controller@editStaff')->middleware('principal_DPChecker');
Route::post('/archive_staff', 'Non_teaching_staff_controller@archiveStaff')->middleware('principal_DPChecker');
Route::get('/alumniStaff', 'Non_teaching_staff_controller@showAlumni')->middleware('principal_DPChecker');
Route::get('/alumniStaff/{id}', 'Non_teaching_staff_controller@specificAlumni' )->middleware('principal_DPChecker');

Route::get('/teachers_details', 'Teachers@showTeachers')->middleware('principalChecker');
Route::get('/teachers_details/{id}', 'Teachers@specificTeacher')->middleware('principalChecker');
Route::post('/edit_teacher', 'Teachers@editTeacher')->middleware('principalChecker');
Route::post('/archive_teacher', 'Teachers@archiveTeacher')->middleware('principalChecker');
Route::get('/teachers/archived', 'Teachers@showArchived')->middleware('principalChecker');
Route::get('/teachers/archived/{teacher_id}', 'Teachers@showSpecificArchivedTeacher')->middleware('principalChecker');
Route::post('/unarchive_teacher', 'Teachers@unarchiveTeacher')->middleware('principalChecker');

//routes for roles and responsibilities for teachers
Route::post('/denySpecialRole', 'Teachers@denySpecialRole')->middleware('principalChecker');
Route::post('/add_role', 'Teachers@addSpecialRole')->middleware('principalChecker');
Route::post('/add_responsibility', 'Teachers@addResponsibility')->middleware('principalChecker');
Route::post('/denyResponsibility', 'Teachers@denyResponsibility')->middleware('principalChecker');
Route::post('/addTeachingClass', 'Teachers@addTeachingClass')->middleware('principalChecker');
Route::post('/removeTeachingClassSubject1', 'Teachers@removeTeachingClassSubject1')->middleware('principalChecker');
Route::post('/removeTeachingClassSubject2', 'Teachers@removeTeachingClassSubject2')->middleware('principalChecker');
Route::get('/teachers/myTeachingClasses', 'Teachers@showMyTeachingClasses')->middleware('marksEntryChecker');
Route::get('/allTeachersclasses', 'Teachers@showAllTeacherClasses')->middleware('principalChecker');

Route::get('/students_details/{class_name}', 'Students@studentDetails')->middleware('principal_DP_examinationChecker');
Route::post('/add_new_student', 'Students@insertStudent')->middleware('principal_DP_examinationChecker');
Route::post('/add_student_address', 'Students@addStudentAddress')->middleware('principal_DP_examinationChecker');
Route::post('/add_parent_details', 'Students@addParent')->middleware('principal_DP_examinationChecker');
Route::get('/studentDetails/{class_name},{studentID}', 'Students@specificStudent')->middleware('principal_DP_examinationChecker');
Route::post('/edit_address', 'Students@editAddress')->middleware('principal_DP_examinationChecker');
Route::post('/edit_parent_details', 'Students@editParentDetails')->middleware('principal_DP_examinationChecker');
Route::get('/studentDetails/resultSlips/{year}/{term}/{exam_type}/{student_id},{class_name}', 'ReportFormsController@resultSlip')->middleware('principal_DP_examinationChecker');
Route::get('/students/alumni', 'AlumniStudentsController@getAlumniStudents');
Route::get('/students/alumni/{student_id}', 'AlumniStudentsController@getSpecificAlumni');
Route::get('/students/parents', 'StudentParents@showParents');
Route::get('/parents/{parent_id}', 'StudentParents@specific_parent');
Route::post('/parentchild/relationship/edit', 'StudentParents@editParentRelationship');
Route::post('/parentchild/detach', 'StudentParents@detach');
Route::get('/parents/addStudent/{parent_id}', 'StudentParents@addStudentForm');
Route::post('/parents/search_child', 'StudentParents@searchStudent');
Route::post('/parents/addNew/child', 'StudentParents@addChild');
Route::view('/parents/add/newParent', 'parents.add_parent');
Route::post('/parents/addNew', 'StudentParents@addNewParent');
Route::post('/parent/edit', 'StudentParents@editParent');

Route::post('/students/outOfSession', 'Students@outOfSession');
Route::get('/students/outOfSession', 'Students@showStudentsOutOfSession');
Route::get('/students/Outofsession/{student_id}', 'Students@specific_student_out_of_session');
Route::post('/students/OutOfSession/resume', 'Students@resumeStudentToSession');


Route::get('/home', 'Sample_non_teachingController@index')->name('home');
Route::get('users', 'Sample_non_teachingController@getUsers')->name('get.users');
Route::view('/login_form', 'login');


//Routes for student entry of marks
Route::get('/marks_entry/{class}', 'MarksEntryController@checkTeacher')->middleware('marksEntryChecker');
Route::post('/submit_marks', 'MarksEntryController@submitMarks')->middleware('marksEntryChecker');
Route::post('/update_marks', 'MarksEntryController@updateMarks')->middleware('marksEntryChecker');
Route::post('/removeMarks', 'MarksEntryController@removeMarks')->middleware('marksEntryChecker');
Route::get('/report_forms/{class_name}', 'ReportFormsController@getReportForms')->middleware('resultSlipsChecker');

//print report forms
Route::get('/report_form/{student_id},{class_name}', 'ReportFormsController@generateReportForm')->middleware('resultSlipsChecker');
Route::get('/view_report_form/{student_id},{class_name}', 'ViewReportForms@report_form')->middleware('resultSlipsChecker');
Route::post('/view_student_report_form', 'ViewReportForms@student_report_form')->middleware('resultSlipsChecker');


//get the merit lists
Route::get('/merit_list/{className}', 'MeritListController@getMeritList')->middleware('resultSlipsChecker');
Route::get('/viewMeritList/{class_name}', 'MeritListController@view_merit_list')->middleware('resultSlipsChecker');
Route::get('/meritList/view/byClass/{class_name}', 'MeritListController@showMeritList');
Route::get('/meritList/older/show', 'OlderMeritList@showOlder');
Route::get('/meritlist/older/download/{class_name},{year},{term},{exam_type}', 'OlderMeritList@getSpecificMeritList');
Route::view('/counter', 'admin_landing_page');

Route::view('/homepage', 'home_page');



//fee structure forms
Route::get('/new_fee_structure', 'FeeStructure@getForm')->middleware('principalChecker');
Route::post('/save_fee_structure', 'FeeStructure@submit')->middleware('principalChecker');
Route::get('/current_fee_structures', 'FeeStructure@showCurrentFeeStructure');
Route::post('/update_fee_structure', 'FeeStructure@update')->middleware('principalChecker');
Route::get('/all_fee_structures', 'FeeStructure@allFeeStructures');


//Route to dashboards
Route::get('/admin/dashboard', 'DashboardController@toAdmin');
Route::get('/parents/children/{parent_id}', 'ParentsViewController@parentChildren');
Route::get('/teachers/dashboard', 'DashboardController@toNormalTeacher');
Route::view('/home_dashboard', 'home_dashboard');

//Routes for finance department
Route::get('/finance_department', 'FinanceDepartmentController@displayDashboard')->middleware('financeDepartmentChecker');
Route::get('/finance_department/take_fees/{class_name}', 'FinanceDepartmentController@take_fees')->middleware('financeDepartmentChecker');
Route::get('/finance_department/take_fees/student/{student_id}', 'FinanceDepartmentController@displayInputForm')->middleware('financeDepartmentChecker');
Route::post('/finance_department/record_fee', 'FinanceDepartmentController@record_new_fees')->middleware('financeDepartmentChecker');
Route::get('/finance_department/fee_balances/{class_name}', 'FinanceDepartmentController@viewFeeBalances')->middleware('financeDepartmentChecker');
Route::get('/finance_department/download_fee_balance/{class_name}','FinanceDepartmentController@downloadFeeBalances')->middleware('financeDepartmentChecker');
Route::get('/finance_department/fee_statements/{class_name}', 'FinanceDepartmentController@allClassFeeStatements')->middleware('financeDepartmentChecker');
Route::get('/finance_department/view_fee_statement/{class_name},{student_id}', 'FinanceDepartmentController@viewFeeStatement')->middleware('financeDepartmentChecker');
Route::get('/finance_department/download_fee_statement/{student_id}', 'FinanceDepartmentController@downloadFeeStatement')->middleware('sessionChecker');
Route::get('/finance_department/clean_students/{class_name}', 'FinanceDepartmentController@cleanStudents')->middleware('financeDepartmentChecker');
Route::get('/finance_department/clean_students/download/{class_name}', 'FinanceDepartmentController@downloadCleanStudents')->middleware('financeDepartmentChecker');
Route::get('/finance_department/reports', 'FinanceDepartmentController@view_reports')->middleware('financeDepartmentChecker');
Route::get('/finance_department/reports/download', 'FinanceDepartmentController@getReport')->middleware('financeDepartmentChecker');
Route::get('/finance_department/alumni/take_fees', 'FinanceDepartmentController@takeFeesForAlumni')->middleware('financeDepartmentChecker');
Route::get('/finance_department/alumni/take_fees/{student_id}', 'FinanceDepartmentController@alumni_fee_input_form')->middleware('financeDepartmentChecker');
Route::get('/finance_department/alumni/fee_statement', 'FinanceDepartmentController@alumniFeeStatement')->middleware('financeDepartmentChecker');
Route::get('/finance_department/alumni/view_fee_statement/{student_id}', 'FinanceDepartmentController@viewAlumniFeeStatement')->middleware('financeDepartmentChecker');

//routes for the accommodation facility
Route::get('/accommodation_facility/dashboard', 'Accommodation@dashboard')->middleware('accommodationChecker');
Route::get('/accommodation_facility/dormitories', 'Accommodation@showDormitories')->middleware('accommodationChecker');
Route::post('/accommodation_facility/addNewDormitory', 'Accommodation@insertDormitory')->middleware('accommodationChecker');
Route::post('/accommodation_facility/updateDormitory', 'Accommodation@updateDormitory')->middleware('accommodationChecker');
Route::get('/accommodation_facility/dormitory/{dorm_id}', 'Accommodation@dormRooms')->middleware('accommodationChecker');
Route::get('/accommodation_facility/dormitory/{dormID}/addNewRoom', 'Accommodation@addRoom')->middleware('accommodationChecker');
Route::post('/accommodation_facility/Dormitory/saveNewRoom', 'Accommodation@insertNewRoom')->middleware('accommodationChecker');
Route::post('/accommodation_facility/dormitory/removeRoom', 'Accommodation@removeRoom')->middleware('accommodationChecker');
Route::post('/accommodation_facility/dormitory/editRoom', 'Accommodation@editRoom')->middleware('accommodationChecker');
Route::get('/accommodation_facility/studentRooms/{class_name}', 'Accommodation@studentRooms')->middleware('accommodationChecker');
Route::post('/accommodation_facility/studentRooms/deallocateRoom', 'Accommodation@deallocateRoom')->middleware('accommodationChecker');
Route::get('/accommodation_facility/studentRooms/allocate/{student_id},{class_name}','Accommodation@allocateRoomForm')->middleware('accommodationChecker');
Route::post('/accommodation_facility/studentRooms/allocateRoom', 'Accommodation@saveRoom')->middleware('accommodationChecker');
Route::get('/accommodation_facility/studentRooms/editAllocatedRoom/{student_id},{className}', 'Accommodation@editRoomForm')->middleware('accommodationChecker');
Route::post('/accommodation_facility/studentRooms/editAllocateStudentRoom', 'Accommodation@saveEditedRoom')->middleware('accommodationChecker');
Route::get('/accommodation_facility/report', 'Accommodation@detailedReport')->middleware('accommodationChecker');
Route::get('/accommodation_facility/dormitory/report/{dormID}', 'Accommodation@specificDormReport')->middleware('accommodationChecker');
Route::get('/accommodation_facility/all_students/history', 'Accommodation@allStudents');
Route::get('/accommodation_facility/student/accommodation-history/{student_id}', 'Accommodation@viewStudentAccommodationHistory');
Route::get('/accommodation_facility/all_students/history/{student_id}/download', 'Accommodation@downloadStudentAccommodationHistory');
//routes for disciplinary cases
Route::get('/disciplinary/{class_name}', 'Disciplinary@showStudents')->middleware('sessionChecker');
Route::post('/disciplinary/reportCase', 'Disciplinary@reportCase')->middleware('sessionChecker');
Route::get('/disciplinary/cases/current_cases', 'Disciplinary@current_cases')->middleware('principal_DPChecker');
Route::get('/disciplinary_case/{case_id}/{student_id}/{teacher_id}', 'Disciplinary@specific_student_case')->middleware('principal_DPChecker');
Route::post('/disciplinary/case_clearance', 'Disciplinary@case_clearance')->middleware('principal_DPChecker');

//Routes for student promotions
Route::post('/students/archive', 'StudentPromotion@archiveStudent')->middleware('principal_DPChecker');
Route::post('/students/promote', 'StudentPromotion@promotoToNextClass')->middleware('principal_DPChecker');

//Routes for term sessions and exam sessions
Route::get('/term_sessions/current_session', 'Term_sessions@current_session')->middleware('principalChecker');
Route::get('/term_sessions/others', 'Term_sessions@other_sessions')->middleware('principalChecker');
Route::get('/term_sessions/new', 'Term_sessions@addNewTerm')->middleware('principalChecker');
Route::post('/term_session/set_current_session', 'Term_sessions@set_current_session')->middleware('principalChecker');
Route::get('/term_session/set_exam_session/{term_id}', 'Term_sessions@new_exam_session')->middleware('principalChecker');
Route::post('/term_session/set_exam_session', 'Term_sessions@set_exam_session')->middleware('principalChecker');
Route::post('/term_sessions/remove_exam_session', 'Term_sessions@remove_exam_session')->middleware('principalChecker');
Route::post('/term_sessions/edit_exam_session', 'Term_sessions@edit_exam_session')->middleware('principalChecker');
Route::post('/term_sessions/edit_term_session', 'Term_sessions@edit_term_session')->middleware('principalChecker');
Route::post('/term_sessions/end_term_session', 'Term_sessions@end_term_session')->middleware('principalChecker');
Route::get('/term_sessions/older', 'Term_sessions@showOlderTermSessions');
Route::get('/term_sessions/older/specific/{term_id}', 'Term_sessions@specificOldTermSession');

//Routes for student
Route::get('/students/edit/{student_id}', 'Students@editStudent')->middleware('principal_DP_examinationChecker');
Route::post('/students/edit_student', 'Students@updateStudentInfo')->middleware('principal_DP_examinationChecker');
Route::post('/students/clear_student', 'Students@studentClearance')->middleware('principal_DPChecker');
Route::get('/all_students', 'Students@showAllStudents')->middleware('principal_DPChecker');
Route::post('/students/filter', 'Students@filterStudents')->middleware('principal_DPChecker');
Route::get('/students/filtered/{class_name},{streams},{parents_included}', 'Students@downloadStudentList')->middleware('principal_DPChecker');
Route::post('/students/promote/all', 'Students@promoteAll');

//Routes for settings
Route::view('/settings/change_password', 'profile.change_password')->middleware('sessionChecker');
Route::post('/settings/changePassword', 'SettingsController@changePassword')->middleware('sessionChecker');

//Routes for profile settings
Route::get('/users/profile', 'ProfileController@viewProfile')->middleware('sessionChecker');
Route::get('/users/profile/edit', 'ProfileController@editProfile')->middleware('sessionChecker');
Route::post('/users/update_profile', 'ProfileController@updateProfile')->middleware('sessionChecker');


//sending emails
Route::post('/students/sendMail', 'SendMailController@sendMailToParent')->middleware('principal_DPChecker');

//routes for communications
Route::get('communications/{class_name}', 'CommunicationsController@getStudents');
Route::post('/communications/send_email', 'CommunicationsController@sendMailToClassParents');
Route::get('/communications/general/report', 'CommunicationsController@getGeneralReport');
Route::post('/communications/report/specific', 'CommunicationsController@reportByDates');
Route::post('/communications/delete/message', 'CommunicationsController@deleteMessage');

Route::view('/new_dashboard', 'layouts.new_dash2');


//Routes for report
Route::get('/finance_department/fee_transactions/reports', 'FinanceReportsController@showForm');
Route::post('/finance_department/fee_tansactions/get_report', 'FinanceReportsController@getReport');
Route::get('/finance_department/fee_transactions/reports/download/{date_from},{date_to},{transaction_type}', 'FinanceReportsController@downloadReport');

Route::get('/disciplinary_cases/reports', 'DisciplinaryCasesReports@showForm');
Route::post('/disciplinary_cases/get_report', 'DisciplinaryCasesReports@getReport');
Route::get('/disciplinary_cases/reports/download/{date_from},{date_to}', 'DisciplinaryCasesReports@downloadReport');
Route::get('/students/reports', 'StudentsReports@showForm');
Route::post('/students/get_report', 'StudentsReports@getReport');
Route::get('/students/reports/download/{date_from},{date_to}', 'StudentsReports@downloadReport');

Route::view('/docs/help', 'help_pages.help_page');
Route::view('/docs/marks_entry/help', 'help_pages.marks_entry_help');
Route::view('/phpinfo', 'phpinfo');


//parent routes
Route::view('/parentlogin', 'parents_view.login');
Route::post('/parents/login', 'ParentsViewController@parentLogin');
Route::get('/parent/child/{parent_id},{child_id}', 'ParentsViewController@specificChild');

//Routes for checking user data availability
Route::post('/parent_id_no/check', 'CheckUserDataAvailability@checkParentIDNo')->name('parent_id_no_available.checkID');
