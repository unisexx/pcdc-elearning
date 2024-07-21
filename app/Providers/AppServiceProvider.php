<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Survey;
use Form;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Form::component('bsText', 'components.form.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsTextArea', 'components.form.textarea', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsTiny', 'components.form.tiny', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsFile', 'components.form.file', ['name', 'label' => null, 'value' => null, 'path' => null, 'attributes' => []]);
        Form::component('bsSwitch', 'components.form.switch', ['name', 'label' => null, 'value' => null, 'enableValue' => null, 'disableValue' => null, 'attributes' => []]);
        Form::component('bsSelect', 'components.form.select', ['name', 'label' => null, 'selectOptionArray' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsPassword', 'components.form.password', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsUploadAndCropImage', 'components.form.upload-and-crop-image', ['name', 'label' => null, 'value' => null, 'attributes' => []]);

        /** Pagination */
        Paginator::defaultView('vendor.pagination.custom');
        Paginator::defaultSimpleView('vendor.pagination.custom');

        /** Frontend Footer */
        $cacheTime = 60 * 60 * 24; // 1 วัน
        View::share('contact', Cache::remember('contact', $cacheTime, function () {
            return Contact::first();
        }));

        // หน้าบ้าน แบบสำรวจความพึงพอใจ
        View::composer('components.frontend.survey', function ($view) {
            $view->with('surveys', Survey::where('status', 'active')->orderBy('order', 'asc')->get());
        });
    }
}
