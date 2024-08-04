<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Auth::routes();

/** Frontend */
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/front/login/form', [App\Http\Controllers\Frontend\LoginController::class, 'form'])->name('front.login.form');
Route::any('/front/login', [App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('front.login');
Route::post('/front/login2', [App\Http\Controllers\Frontend\LoginController::class, 'login2'])->name('front.login2');
Route::get('/front/logout', [App\Http\Controllers\Frontend\LoginController::class, 'logout']);
Route::get('/front/register', [App\Http\Controllers\Frontend\RegisterController::class, 'form']);
Route::post('/front/register', [App\Http\Controllers\Frontend\RegisterController::class, 'register'])->name('front.register');
Route::get('/stat', [App\Http\Controllers\Frontend\StatController::class, 'index']);
Route::post('/stat', [App\Http\Controllers\Frontend\StatController::class, 'index']);
Route::get('/stat/export-xls', [App\Http\Controllers\Frontend\StatController::class, 'index']);
Route::get('/faq', [App\Http\Controllers\Frontend\FaqController::class, 'index']);
Route::get('/contact', [App\Http\Controllers\Frontend\ContactController::class, 'index']);
Route::post('/contact/save', [App\Http\Controllers\Frontend\ContactController::class, 'save'])->name('contact.save');
Route::get('/hilight/view/{id}', [App\Http\Controllers\Frontend\HilightController::class, 'view']);
Route::get('/website-policy', [App\Http\Controllers\Frontend\WebsitePolicyController::class, 'index']);
Route::get('/privacy-policy', [App\Http\Controllers\Frontend\PrivacyPolicyController::class, 'index']);
Route::get('/elearning-steps', [App\Http\Controllers\Frontend\ElearningStepsController::class, 'index']);
Route::get('/survey', [App\Http\Controllers\Frontend\SurveyController::class, 'form'])->name('survey.form');
Route::post('/survey', [App\Http\Controllers\Frontend\SurveyController::class, 'submit'])->name('survey.submit');
Route::get('/certificate/verify/{verifyToken}', [App\Http\Controllers\Frontend\CertificateController::class, 'verify'])->name('certificate.verify');
Route::middleware(['frontend.auth'])->group(function () {
    Route::get('/profile/{user}/edit', [App\Http\Controllers\Frontend\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [App\Http\Controllers\Frontend\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change_password/{user}/edit', [App\Http\Controllers\Frontend\ChangePasswordController::class, 'edit'])->name('change_password.edit');
    Route::put('/change_password/{user}', [App\Http\Controllers\Frontend\ChangePasswordController::class, 'update'])->name('change_password.update');

    Route::get('/elearning', [App\Http\Controllers\Frontend\ElearningController::class, 'index'])->name('elearning.index');
    Route::get('/elearning/index', [App\Http\Controllers\Frontend\ElearningController::class, 'index'])->name('elearning.index');
    Route::get('/elearning/curriculum/{curriculum_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculum'])->name('elearning.curriculum.index');
    Route::get('/elearning/curriculum/lesson/{lesson_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumLesson'])->name('elearning.curriculum-lesson.index');
    Route::get('/elearning/curriculum/lesson-exam/{lesson_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumLessonExamIntro'])->name('elearning.curriculum-lesson.index');

    Route::get('/elearning/curriculum/{curriculum_id}/continue', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumContinue'])->name('elearning.continue');

    //Pretest-Posttest
    Route::get('/elearning/curriculum/{curriculum_id}/{exam_type_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumLessonExamPrePost'])->name('elearning.curriculum-lesson.index');
    Route::post('/elearning/curriculum/{curriculum_id}/{exam_type_id}/execute', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumLessonExamExecute'])->name('elearning.curriculum-lesson.start');

    Route::get('/elearning/{user_curriculum_pp_exam}/exam', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumLessonExam'])->name('elearning.curriculum-lesson.exam');
    Route::post('/elearning/{user_curriculum_pp_exam}/exam/save', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumLessonExamSave'])->name('elearning.curriculum-lesson.exam');
    Route::post('/elearning/curriculum/{curriculum_id}/reset', [App\Http\Controllers\Frontend\ElearningController::class, 'curriculumReset'])->name('elearning.curriculum-lesson.reset');

    Route::get('/elearning/history', [App\Http\Controllers\Frontend\ElearningHistoryController::class, 'index'])->name('elearning.history.index');

    Route::get('/elearning/download-curriculum/{curriculum_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'downloadCurriculum']);
    Route::get('/elearning/download-lesson/{lesson_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'downloadLesson']);
    
    Route::get('/elearning/download-curriculum-exam/{curriculum_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'downloadCurriculumExam']);
    Route::get('/elearning/download-lesson-exam/{lesson_id}', [App\Http\Controllers\Frontend\ElearningController::class, 'downloadLessonExam']);

    Route::get('/certificate/pdf/{curriculum_id}', [App\Http\Controllers\Frontend\CertificateController::class, 'pdf'])->name('certificate.pdf');
});
Route::post('/accept-cookie', [App\Http\Controllers\Frontend\CookieController::class, 'acceptCookie']);

/** Admin */
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/ajax-dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'ajaxDashboard'])->name('ajax.dashboard');

    Route::resource('/user', App\Http\Controllers\Admin\UserController::class)->names('admin.user');
    Route::resource('/hilight', App\Http\Controllers\Admin\HilightController::class)->names('admin.hilight');
    Route::resource('/contact', App\Http\Controllers\Admin\ContactController::class)->names('admin.contact');
    Route::resource('/website-policy', App\Http\Controllers\Admin\WebsitePolicyController::class)->names('admin.website-policy');
    Route::resource('/privacy-policy', App\Http\Controllers\Admin\PrivacyPolicyController::class)->names('admin.privacy-policy');
    Route::resource('/faq', App\Http\Controllers\Admin\FaqController::class)->names('admin.faq');
    Route::resource('/inbox', App\Http\Controllers\Admin\InboxController::class)->names('admin.inbox');
    Route::resource('/survey', App\Http\Controllers\Admin\SurveyController::class)->names('admin.survey');
    Route::resource('/log', App\Http\Controllers\Admin\LogController::class)->names('admin.log');

    Route::resource('/curriculum-category', App\Http\Controllers\Admin\CurriculumCategoryController::class)->names('admin.curriculum-category');
    Route::resource('/curriculum', App\Http\Controllers\Admin\CurriculumController::class)->names('admin.curriculum');
    Route::resource('/curriculum-lesson', App\Http\Controllers\Admin\CurriculumLessonController::class)->names('admin.curriculum-lesson');
    Route::resource('/curriculum-lesson-question', App\Http\Controllers\Admin\CurriculumLessonQuestionController::class)->names('admin.curriculum-lesson-question');
    Route::resource('/curriculum-exam-setting', App\Http\Controllers\Admin\CurriculumExamSettingController::class)->names('admin.curriculum-exam-setting');

    // drag&drop order
    Route::post('/faq/update-order', [App\Http\Controllers\Admin\FaqController::class, 'updateOrder'])->name('faq.updateOrder');
    Route::post('/survey/update-order', [App\Http\Controllers\Admin\SurveyController::class, 'updateOrder'])->name('survey.updateOrder');
    Route::post('/curriculum-lesson-question/update-order', [App\Http\Controllers\Admin\CurriculumLessonQuestionController::class, 'updateOrder'])->name('admin.curriculum-lesson-question.updateOrder');
    Route::post('/curriculum-category/update-order', [App\Http\Controllers\Admin\CurriculumCategoryController::class, 'updateOrder'])->name('admin.curriculum-category.updateOrder');


    Route::get('/certificate/pdf/{user_id}/{curriculum_id}', [App\Http\Controllers\Frontend\CertificateController::class, 'pdfUser'])->name('certificate.pdf');
});

/** Ajax */
Route::get('/get-provinces/{area_id}', [App\Http\Controllers\AjaxController::class, 'getProvinces']);
Route::get('/get-districts/{province}', [App\Http\Controllers\AjaxController::class, 'getDistricts']);
Route::get('/get-subdistricts/{district}', [App\Http\Controllers\AjaxController::class, 'getSubdistricts']);
Route::get('/ajaxGetZipCode', [App\Http\Controllers\AjaxController::class, 'ajaxGetZipCode'])->name('ajaxGetZipCode');
Route::get('/get-fieldset/{userTypeId}', [App\Http\Controllers\Frontend\RegisterController::class, 'getFieldset']);

/** Social Login */
Route::get('/login/{provider}', [App\Http\Controllers\SocialiteController::class, 'redirect']);
Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialiteController::class, 'callback']);
