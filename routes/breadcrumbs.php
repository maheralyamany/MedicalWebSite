<?php
// Dashboard

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('الرئيسية', route('home'));
});

/******************************************************************************/

// Home > Specification
Breadcrumbs::for('specification', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('تخصصات الاطباء', route('specification.index'));
});
// Home > ٍ Specification > Add
Breadcrumbs::for('add.specification', function ($trail) {
    $trail->parent('specification');
    $trail->push('إضافة تخصص');
});
// Home > Specification > Edit
Breadcrumbs::for('edit.specification', function ($trail) {
    $trail->parent('specification');
    $trail->push('تعديل تخصص');
});

/******************************************************************************/

// Home > City
Breadcrumbs::for('city', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('المدن', route('city.index'));
});
// Home > ٍ City > Add
Breadcrumbs::for('add.city', function ($trail) {
    $trail->parent('city');
    $trail->push('إضافة مدينة');
});
// Home > City > Edit
Breadcrumbs::for('edit.city', function ($trail) {
    $trail->parent('city');
    $trail->push('تعديل مدينة');
});

/******************************************************************************/

// Home > Nickname
Breadcrumbs::for('nickname', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('ألقاب  الاطباء ', route('nickname.index'));
});
// Home > Nickname > Add
Breadcrumbs::for('add.nickname', function ($trail) {
    $trail->parent('nickname');
    $trail->push('إضافة لقب');
});
// Home > Nickname > Edit
Breadcrumbs::for('edit.nickname', function ($trail) {
    $trail->parent('nickname');
    $trail->push('تعديل لقب');
});

/******************************************************************************/

// Home > Nationality
Breadcrumbs::for('nationality', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('الجنسيات', route('nationality.index'));
});
// Home > Nationality > Add
Breadcrumbs::for('add.nationality', function ($trail) {
    $trail->parent('nationality');
    $trail->push('إضافة جنسية');
});
// Home > Nationality > Edit
Breadcrumbs::for('edit.nationality', function ($trail) {
    $trail->parent('nationality');
    $trail->push('تعديل جنسية');
});



/******************************************************************************/

// Home > Doctor
Breadcrumbs::for('doctor', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('الاطباء ', route('doctor.index'));
});
// Home > Doctor > Edit
Breadcrumbs::for('edit.doctor', function ($trail) {
    $trail->parent('doctor');
    $trail->push('تعديل  الطبيب ');
});
Breadcrumbs::for('add.doctor', function ($trail) {
    $trail->parent('doctor');
    $trail->push(trans_title('doctor'));
});
// Home > Doctor > View
Breadcrumbs::for('view.doctor', function ($trail) {
    $trail->parent('doctor');
    $trail->push('تفاصيل  الطبيب ');
});

/******************************************************************************/

// Home > Branch
Breadcrumbs::for('branch', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('الفروع', route('branch.index'));
});

// Home > Branch > Edit
Breadcrumbs::for('add.branch', function ($trail) {
    $trail->parent('branch');
    $trail->push(' أضافة  فرع جديد ');
});


// Home > Branch > Edit
Breadcrumbs::for('edit.branch', function ($trail) {
    $trail->parent('branch');
    $trail->push('تعديل الفرع ');
});
// Home > Branch > View
Breadcrumbs::for('show.branch', function ($trail) {
    $trail->parent('branch');
    $trail->push('تفاصيل الفرع ');
});

/******************************************************************************/
Breadcrumbs::for('departments', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans_title('departments'), route('departments.index'));
});
Breadcrumbs::for('add.departments', function ($trail) {
    $trail->parent('departments');
    $trail->push(trans_add('departments'));
});
Breadcrumbs::for('edit.departments', function ($trail) {
    $trail->parent('departments');
    $trail->push(trans_edit('departments'));
});
Breadcrumbs::for('show.departments', function ($trail) {
    $trail->parent('departments');
    $trail->push(trans_details('departments'));
});

/******************************************************************************/
Breadcrumbs::for('patients', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans_title('patients'), route('patients.index'));
});
Breadcrumbs::for('add.patients', function ($trail) {
    $trail->parent('patients');
    $trail->push(trans_add('patients'));
});
Breadcrumbs::for('edit.patients', function ($trail) {
    $trail->parent('patients');
    $trail->push(trans_edit('patients'));
});
Breadcrumbs::for('show.patients', function ($trail) {
    $trail->parent('patients');
    $trail->push(trans_details('patients'));
});
/******************************************************************************/
Breadcrumbs::for('drugs', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans_title('drugs'), route('drugs.index'));
});
Breadcrumbs::for('add.drugs', function ($trail) {
    $trail->parent('drugs');
    $trail->push(trans_add('drugs'));
});
Breadcrumbs::for('edit.drugs', function ($trail) {
    $trail->parent('drugs');
    $trail->push(trans_edit('drugs'));
});
Breadcrumbs::for('show.drugs', function ($trail) {
    $trail->parent('drugs');
    $trail->push(trans_details('drugs'));
});
/******************************************************************************/
Breadcrumbs::for('lab_tests', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans_title('lab_tests'), route('lab_tests.index'));
});
Breadcrumbs::for('add.lab_tests', function ($trail) {
    $trail->parent('lab_tests');
    $trail->push(trans_add('lab_tests'));
});
Breadcrumbs::for('edit.lab_tests', function ($trail) {
    $trail->parent('lab_tests');
    $trail->push(trans_edit('lab_tests'));
});
Breadcrumbs::for('show.lab_tests', function ($trail) {
    $trail->parent('lab_tests');
    $trail->push(trans_details('lab_tests'));
});
/******************************************************************************/
Breadcrumbs::for('xrays', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans_title('xrays'), route('xrays.index'));
});
Breadcrumbs::for('add.xrays', function ($trail) {
    $trail->parent('xrays');
    $trail->push(trans_add('xrays'));
});
Breadcrumbs::for('edit.xrays', function ($trail) {
    $trail->parent('xrays');
    $trail->push(trans_edit('xrays'));
});
Breadcrumbs::for('show.xrays', function ($trail) {
    $trail->parent('xrays');
    $trail->push(trans_details('xrays'));
});
/******************************************************************************/
Breadcrumbs::for('services', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans_title('services'), route('services.index'));
});
Breadcrumbs::for('add.services', function ($trail) {
    $trail->parent('services');
    $trail->push(trans_add('services'));
});
Breadcrumbs::for('edit.services', function ($trail) {
    $trail->parent('services');
    $trail->push(trans_edit('services'));
});
Breadcrumbs::for('show.services', function ($trail) {
    $trail->parent('services');
    $trail->push(trans_details('services'));
});

/******************************************************************************/

// Home > user > add
Breadcrumbs::for('add.users', function ($trail) {
    $trail->parent('users');
    $trail->push(' اضافة مستخدم');
});
// Home > User > Edit
Breadcrumbs::for('edit.users', function ($trail) {
    $trail->parent('users');
    $trail->push('تعديل مستخدم');
});
// Home > User
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('المستخدمين', route('users.index'));
});
// Home > User > View
Breadcrumbs::for('view.users', function ($trail) {
    $trail->parent('users');
    $trail->push('تفاصيل المستخدم');
});
