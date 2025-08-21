<?php

namespace App\Providers;

use Form as Facade;
use Illuminate\Support\ServiceProvider as Provider;

class Form extends Provider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        Facade::component('tablePagination', 'partials.form.table-pagination', ['table' => null]);
        Facade::component('pageHeader', 'partials.form.page-header', ['routeName', 'viewName',]);
        Facade::component('formTitle', 'partials.form.page-title', ['text', 'icon' => 'fa fa-magic']);

        Facade::component('deleteLink', 'partials.form.btn_delete', [
            'routeName', 'id' => '0', 'col' => 'btn btn-white  rounded-5',
        ]);
        Facade::component('detailsLink', 'partials.form.btn_details', [
            'routeName', 'id' => '0', 'col' => 'btn btn-white  rounded-5',
        ]);

        Facade::component('statusButton', 'partials.form.btn_status', [
            'routeName', 'id' => '0', 'status' => 0, 'col' => 'btn btn-white  rounded-5',
        ]);

        Facade::component('editButton', 'partials.form.btn_edit', [
            'routeName', 'id' => '0', 'col' => 'btn btn-white  rounded-5',
        ]);
        Facade::component('saveButtons', 'partials.form.save_buttons', [
            'cancel', 'col' => 'col-md-12',
        ]);
        Facade::component('deleteButton', 'partials.form.btn_delete', [
            'item', 'url', 'text' => '', 'value' => 'name', 'id' => 'id',
        ]);
        Facade::component('fileGroup', 'partials.form.file_group', [
            'name' => 'photo', 'title' => trans('m.photo'), 'error' => '', 'acceptedFiles' => 'image/*', 'filePath' => null, 'col' => 'col-md-12',
        ]);
        Facade::component('customCheckbox', 'partials.form.checkbox', [
            'name', 'title', 'value', 'checked' => false, 'attributes' => [], 'col' => '',
        ]);
        Facade::component('customToggleButton', 'partials.form.custom-toggle', [
            'name', 'value' => '', 'checked' => false, 'on_label' => trans('m.yes'), 'off_label' => trans('m.no'), 'attributes' => [], 'onChange' => null,
        ]);
        Facade::component('statusToggleButton', 'partials.form.status_toggle', [
            'id', 'url', 'value' => '', 'checked' => false, 'disabled' => null,
        ]);

        Facade::component('dropzoneFileGroup', 'partials.form.dropzone_file_group', [
            'name', 'text', 'icon', 'attributes' => [], 'value' => null, 'col' => 'col-md-6',
        ]);

        Facade::component('genderRadioGroup', 'partials.form.gender', [
            'name' => 'gender', 'value' => 'male', 'errors' => null, 'col' => 'col-md-6',
        ]);
        Facade::component('statusRadioGroup', 'partials.form.status_radio_group', [
            'name' => 'status', 'value' => '1', 'errors' => null, 'col' => 'col-md-6',
        ]);
        Facade::component('workingTimesGroup', 'partials.form.working_times', [
            'times', 'title', 'errors' => null, 'service_id' => 0, 'attributes' => [], 'col' => 'col-md-12',
        ]);
        Facade::component('doctorWorkingTimesGroup', 'partials.form.doctor_working_times', [
            'service', 'errors' => null, 'col' => 'col-md-12',
        ]);

        Facade::component('passwordGroup', 'partials.form.password_group', [
            'name', 'title', 'errors' => null, 'required' => true, 'col' => 'col-md-6'
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}