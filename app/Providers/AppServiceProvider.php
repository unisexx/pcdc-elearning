<?php

namespace App\Providers;

use Form;
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
        Form::component('bsFile', 'components.form.file', ['name', 'label' => null, 'value' => null, 'path' => null, 'attributes' => []]);
        Form::component('bsSwitch', 'components.form.switch', ['name', 'label' => null, 'value' => null, 'enableValue' => null, 'disableValue' => null, 'attributes' => []]);
        Form::component('bsSelect', 'components.form.select', ['name', 'label' => null, 'selectOptionArray' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsPassword', 'components.form.password', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsUploadAndCropImage', 'components.form.upload-and-crop-image', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
    }
}
