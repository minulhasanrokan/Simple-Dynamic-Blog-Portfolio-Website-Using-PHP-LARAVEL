<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\home\HomeSliderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\WorkingProcessController;

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
    return view('frontend.index');
});


// all about fornnt end route.......
Route::controller(AboutController::class)->group(function(){

    Route::get('/about-me','about_page')->name('frontend.about.page');


    Route::get('/about-me/{slug}','about_me')->name('frontend.about.me');

    Route::get('/contact-me','contact_me')->name('frontend.contact.page');
    
});


// all service fornnt end route.......
Route::controller(ServiceController::class)->group(function(){

    Route::get('/all-services','all_services')->name('frontend.all.services.page');
    
});

// all Portfolio fornnt end route.......
Route::controller(PortfolioController::class)->group(function(){

    Route::get('/portfolio','portfolio')->name('frontend.portfolio.page');
    
});


Route::controller(SkillController::class)->group(function(){


    Route::get('/skill-details/{slug}','skill_details')->name('skill.details');
    
});

Route::controller(EducationController::class)->group(function(){

    Route::get('/education-details/{slug}','education_details')->name('education.details');
    
});

Route::controller(AwardController::class)->group(function(){


    Route::get('/award-details/{slug}','award_details')->name('award.details');
    
});

Route::controller(PortfolioController::class)->group(function(){


    Route::get('/portfolio-details/{slug}','portfolio_details')->name('portfolio.details');


    Route::get('/portfolio-cetagory-details/{slug}','portfolio_details')->name('portfolio.cetagory.details');
    
});

Route::controller(BlogController::class)->group(function(){

    Route::get('/blog-details/{slug}','blog_details')->name('blog.details');
    Route::post('/blog-add-comment','add_comment')->name('blog.add.comment');
    Route::get('/all-blog','all_blog_details')->name('blog.all');
    Route::get('/blog-cetagory-details/{slug}','blog_cetagory_details')->name('blog.cetagory.details');
    
});

Route::controller(ServiceController::class)->group(function(){

    Route::get('/all-service','all_service_details')->name('service.all');
    Route::get('/service-details/{slug}','service_details')->name('service.details');
    
});


Route::controller(TestimonialController::class)->group(function(){

    Route::get('/all-testimonial','all_testimonial_details')->name('testimonial.all');
    Route::get('/testimonial-details/{slug}','testimonial_details')->name('testimonial.details');
    
});


Route::controller(ResumeController::class)->group(function(){

    Route::get('/resume-details/{slug}','resume_details')->name('resume.details');
});

Route::controller(EmailController::class)->group(function(){

    Route::post('/send-message','send_message')->name('frontend.send.message');
});


// all admin route.......
Route::controller(AdminController::class)->group(function(){

    Route::get('/admin/logout','admin_logout')->middleware(['auth', 'verified'])->name('admin.logout');
    Route::get('/admin/profile','admin_profile')->middleware(['auth', 'verified'])->name('admin.profile');
    Route::get('/admin/profile-edit','edit_profile')->middleware(['auth', 'verified'])->name('edit.profile');
    Route::get('/admin/edit-contact-information','edit_contact_information')->middleware(['auth', 'verified'])->name('edit.contact.information');
    Route::post('/admin/contact-information-update','update_contact_information')->middleware(['auth', 'verified'])->name('update.edit.contact.information');
    Route::post('/admin/profile-update','update_profile')->middleware(['auth', 'verified'])->name('update.profile');
    Route::get('/admin/change-password','change_password')->middleware(['auth', 'verified'])->name('admin.change.password');
    Route::post('/admin/update-password','update_password')->middleware(['auth', 'verified'])->name('update.password');

    Route::get('/admin/system-settings','system_settings')->middleware(['auth', 'verified'])->name('admin.system.settings');
    Route::post('/admin/update-system-settings','update_system_settings')->middleware(['auth', 'verified'])->name('admin.system.settings.store');

});

// all home slider route.......
Route::controller(HomeSliderController::class)->group(function(){

    Route::get('/admin/home-add-slider','add_slider')->middleware(['auth', 'verified'])->name('admin.home.add.slide');
    Route::post('/admin/home-slider-store','slider_store')->middleware(['auth', 'verified'])->name('admin.store.slide');
    Route::get('/admin/home-slider','home_slider')->middleware(['auth', 'verified'])->name('admin.home.slide');
    Route::get('/admin/home-slider-view/{id}','slider_view')->middleware(['auth', 'verified'])->name('admin.slider.view');
    Route::get('/admin/home-slider-edit/{id}','slider_edit')->middleware(['auth', 'verified'])->name('admin.slider.edit'); 
    Route::post('/admin/home-slider-update','slider_update')->middleware(['auth', 'verified'])->name('admin.update.slide');

    Route::get('/admin/home-slider-change-publish-status/{id}','change_publish_status')->middleware(['auth', 'verified'])->name('admin.slider.change_publish_status');
    Route::get('/admin/home-slider-change-active-status/{id}','change_active_status')->middleware(['auth', 'verified'])->name('admin.slider.change_active_status');
    Route::get('/admin/home-slider-delete/{id}','slider_delete')->middleware(['auth', 'verified'])->name('admin.slider.delete');

});


// all about route route.......
Route::controller(AboutController::class)->group(function(){

    Route::get('/admin/add-about','add_about')->middleware(['auth', 'verified'])->name('admin.add.about');
    Route::post('/admin/about-store','about_store')->middleware(['auth', 'verified'])->name('admin.store.about');
    Route::get('/admin/all-about','all_about')->middleware(['auth', 'verified'])->name('admin.all.about');
    Route::get('/admin/about-edit/{id}','slider_edit')->middleware(['auth', 'verified'])->name('admin.about.edit');
    Route::post('/admin/about-update','about_update')->middleware(['auth', 'verified'])->name('admin.update.about');
    Route::get('/admin/about-change-publish-status/{id}','change_publish_status')->middleware(['auth', 'verified'])->name('admin.about.change_publish_status');
    Route::get('/admin/about-change-active-status/{id}','change_active_status')->middleware(['auth', 'verified'])->name('admin.about.change_active_status');
    Route::get('/admin/about-delete/{id}','about_delete')->middleware(['auth', 'verified'])->name('admin.about.delete');
    Route::get('/admin/about-view/{id}','about_view')->middleware(['auth', 'verified'])->name('admin.about.view');


    //multi image 

    Route::get('/admin/add-multi-image','add_multi_image')->middleware(['auth', 'verified'])->name('admin.add.multi.image');
    Route::post('/admin/multi-image-store','multi_image_store')->middleware(['auth', 'verified'])->name('admin.store.multi.image');
    Route::get('/admin/all-multi-image','all_multi_image')->middleware(['auth', 'verified'])->name('admin.all.multi.image');
    Route::get('/admin/multi-image-edit/{id}','edit_multi_image')->middleware(['auth', 'verified'])->name('admin.multi.image.edit');
    Route::post('/admin/multi-image-update','multi_image_update')->middleware(['auth', 'verified'])->name('admin.update.multi.image');
    Route::get('/admin/multi-image-change-publish-status/{id}','change_publish_status_multi_image')->middleware(['auth', 'verified'])->name('admin.multi.image.change_publish_status');
    
    Route::get('/admin/multi-image-change-active-status/{id}','change_active_status_multi_image')->middleware(['auth', 'verified'])->name('admin.multi.image.change_active_status');
    Route::get('/admin/multi-image-delete/{id}','delete_multi_image')->middleware(['auth', 'verified'])->name('admin.multi.image.delete');




});

// all about skill route.......
Route::controller(SkillController::class)->group(function(){

    Route::get('/admin/add-skill','add_skill')->middleware(['auth', 'verified'])->name('admin.add.skill');
    Route::post('/admin/skill-store','skill_store')->middleware(['auth', 'verified'])->name('admin.store.skill');
    Route::get('/admin/all-skill','all_skill')->middleware(['auth', 'verified'])->name('admin.all.skill');
    Route::get('/admin/skill-edit/{id}','skill_edit')->middleware(['auth', 'verified'])->name('admin.skill.edit');
    Route::post('/admin/skill-update','skill_update')->middleware(['auth', 'verified'])->name('admin.update.skill');
    Route::get('/admin/skill-change-publish-status/{id}','change_publish_status')->middleware(['auth', 'verified'])->name('admin.skill.change_publish_status');
    Route::get('/admin/skill-change-active-status/{id}','change_active_status')->middleware(['auth', 'verified'])->name('admin.skill.change_active_status');
    Route::get('/admin/skill-delete/{id}','skill_delete')->middleware(['auth', 'verified'])->name('admin.skill.delete');



    Route::get('/admin/skill-view/{id}','skill_view')->middleware(['auth', 'verified'])->name('admin.skill.view');
    

});


// all PartnersController route.......
Route::controller(PartnersController::class)->group(function(){

    Route::get('/admin/partners','admin_partners')->middleware(['auth', 'verified'])->name('admin.partners');
    Route::post('/admin/partners-store','partners_store')->middleware(['auth', 'verified'])->name('admin.partners.store');

});


// all about award route.......
Route::controller(AwardController::class)->group(function(){

    Route::get('/admin/add-award','add_award')->middleware(['auth', 'verified'])->name('admin.add.award');
    Route::post('/admin/award-store','award_store')->middleware(['auth', 'verified'])->name('admin.store.award');
    Route::get('/admin/all-award','all_award')->middleware(['auth', 'verified'])->name('admin.all.award');
    Route::get('/admin/award-edit/{id}','award_edit')->middleware(['auth', 'verified'])->name('admin.award.edit');
    Route::post('/admin/award-update','award_update')->middleware(['auth', 'verified'])->name('admin.update.award');
    Route::get('/admin/award-change-publish-status/{id}','change_publish_status')->middleware(['auth', 'verified'])->name('admin.award.change_publish_status');
    Route::get('/admin/award-change-active-status/{id}','change_active_status')->middleware(['auth', 'verified'])->name('admin.award.change_active_status');
    Route::get('/admin/award-delete/{id}','award_delete')->middleware(['auth', 'verified'])->name('admin.award.delete');

    

    Route::get('/admin/award-view/{id}','skill_view')->middleware(['auth', 'verified'])->name('admin.award.view');
    

});

// all Education route.......
Route::controller(EducationController::class)->group(function(){

    Route::get('/admin/add-education','add_education')->middleware(['auth', 'verified'])->name('admin.add.education');
    Route::post('/admin/education-store','education_store')->middleware(['auth', 'verified'])->name('admin.store.education');
    Route::get('/admin/all-education','all_education')->middleware(['auth', 'verified'])->name('admin.all.education');
    Route::get('/admin/education-edit/{id}','education_edit')->middleware(['auth', 'verified'])->name('admin.education.edit');
    Route::post('/admin/education-update','education_update')->middleware(['auth', 'verified'])->name('admin.update.education');
    Route::get('/admin/education-change-publish-status/{id}','change_publish_status')->middleware(['auth', 'verified'])->name('admin.education.change_publish_status');
    Route::get('/admin/education-change-active-status/{id}','change_active_status')->middleware(['auth', 'verified'])->name('admin.education.change_active_status');
    Route::get('/admin/education-delete/{id}','education_delete')->middleware(['auth', 'verified'])->name('admin.education.delete');



    Route::get('/admin/education-view/{id}','education_view')->middleware(['auth', 'verified'])->name('admin.education.view');
});

// all Resume route.......
Route::controller(ResumeController::class)->group(function(){

    Route::get('/admin/add-resume','add_resume')->middleware(['auth', 'verified'])->name('admin.add.resume');
    Route::post('/admin/resume-store','resume_store')->middleware(['auth', 'verified'])->name('admin.store.resume');
    Route::get('/admin/all-resume','all_resume')->middleware(['auth', 'verified'])->name('admin.all.resume');
    Route::get('/admin/resume-edit/{id}','resume_edit')->middleware(['auth', 'verified'])->name('admin.resume.edit');
    Route::post('/admin/resume-update','resume_update')->middleware(['auth', 'verified'])->name('admin.update.resume');
    Route::get('/admin/resume-change-publish-status/{id}','change_publish_status')->middleware(['auth', 'verified'])->name('admin.resume.change_publish_status');
    Route::get('/admin/resume-change-active-status/{id}','change_active_status')->middleware(['auth', 'verified'])->name('admin.resume.change_active_status');
    Route::get('/admin/resume-delete/{id}','education_delete')->middleware(['auth', 'verified'])->name('admin.resume.delete');
});


// all Portfolio Category route.......
Route::controller(PortfolioController::class)->group(function(){

    Route::get('/admin/add-portfolio-cetagory','add_cetagory')->middleware(['auth', 'verified'])->name('admin.add.portfolio.cetagory');
    Route::post('/admin/portfolio-cetagory-store','portfolio_cetagory_store')->middleware(['auth', 'verified'])->name('admin.store.portfolio.category');
    Route::get('/admin/all-portfolio-cetagory','all_cetagory')->middleware(['auth', 'verified'])->name('admin.all.portfolio.cetagory');
    Route::get('/admin/portfolio-cetagory-edit/{id}','portfolio_cetagory_edit')->middleware(['auth', 'verified'])->name('admin.portfolio.cetagory.edit');
    Route::post('/admin/portfolio-cetagory-update','portfolio_cetagory_update')->middleware(['auth', 'verified'])->name('admin.update.portfolio.category');
    Route::get('/admin/portfolio-cetagory-change-publish-status/{id}','change_publish_status')->middleware(['auth', 'verified'])->name('admin.portfolio.cetagory.change_publish_status');
    Route::get('/admin/portfolio-cetagory-change-active-status/{id}','change_active_status')->middleware(['auth', 'verified'])->name('admin.portfolio.cetagory.change_active_status');
    Route::get('/admin/portfolio-cetagory-delete/{id}','portfolio_cetagory_delete')->middleware(['auth', 'verified'])->name('admin.portfolio.cetagory.delete');



    Route::get('/admin/portfolio-cetagory-view/{id}','portfolio_cetagory_view')->middleware(['auth', 'verified'])->name('admin.portfolio.cetagory.view');


    //portfolio........
    Route::get('/admin/add-portfolio','add_portfolio')->middleware(['auth', 'verified'])->name('admin.add.portfolio');
    Route::post('/admin/portfolio-store','portfolio_store')->middleware(['auth', 'verified'])->name('admin.store.portfolio');
    Route::get('/admin/all-portfolio','all_portfolio')->middleware(['auth', 'verified'])->name('admin.all.portfolio');
    Route::get('/admin/portfolio-edit/{id}','portfolio_edit')->middleware(['auth', 'verified'])->name('admin.portfolio.edit');
    Route::post('/admin/portfolio-update','portfolio_update')->middleware(['auth', 'verified'])->name('admin.update.portfolio');
    Route::get('/admin/portfolio-change-publish-status/{id}','change_portfolio_publish_status')->middleware(['auth', 'verified'])->name('admin.portfolio.change_publish_status');
    Route::get('/admin/portfolio-change-active-status/{id}','change_portfolio_active_status')->middleware(['auth', 'verified'])->name('admin.portfolio.change_active_status');
    Route::get('/admin/portfolio-delete/{id}','portfolio_delete')->middleware(['auth', 'verified'])->name('admin.portfolio.delete');



    Route::get('/admin/portfolio-view/{id}','portfolio_view')->middleware(['auth', 'verified'])->name('admin.portfolio.view');

    

});

// all blog and blog Category route.......
Route::controller(BlogController::class)->group(function(){

    Route::get('/admin/add-blog-cetagory','add_cetagory')->middleware(['auth', 'verified'])->name('admin.add.blog.cetagory');
    Route::post('/admin/blog-cetagory-store','cetagory_store')->middleware(['auth', 'verified'])->name('admin.store.blog.category');
    Route::get('/admin/all-blog-cetagory','all_cetagory')->middleware(['auth', 'verified'])->name('admin.all.blog.cetagory');
    Route::get('/admin/blog-cetagory-edit/{id}','blog_cetagory_edit')->middleware(['auth', 'verified'])->name('admin.blog.cetagory.edit');
    Route::post('/admin/blog-cetagory-update','blog_cetagory_update')->middleware(['auth', 'verified'])->name('admin.update.blog.category');
    Route::get('/admin/blog-cetagory-change-publish-status/{id}','blog_category_change_publish_status')->middleware(['auth', 'verified'])->name('admin.blog.cetagory.change_publish_status');
    Route::get('/admin/blog-cetagory-change-active-status/{id}','blog_category_change_active_status')->middleware(['auth', 'verified'])->name('admin.blog.cetagory.change_active_status');
    Route::get('/admin/blog-cetagory-delete/{id}','blog_category_delete')->middleware(['auth', 'verified'])->name('admin.blog.cetagory.delete');


    
    Route::get('/admin/blog-category-view/{id}','blog_category_view')->middleware(['auth', 'verified'])->name('admin.blog.cetagory.view');


    //blog..........
    Route::get('/admin/add-blog','add_blog')->middleware(['auth', 'verified'])->name('admin.add.blog');
    Route::post('/admin/blog-store','blog_store')->middleware(['auth', 'verified'])->name('admin.store.blog');
    Route::get('/admin/all-blog','all_blog')->middleware(['auth', 'verified'])->name('admin.all.blog');
    Route::get('/admin/blog-edit/{id}','blog_edit')->middleware(['auth', 'verified'])->name('admin.blog.edit');
    Route::post('/admin/blog-update','blog_update')->middleware(['auth', 'verified'])->name('admin.update.blog');
    Route::get('/admin/blog-change-publish-status/{id}','change_blog_publish_status')->middleware(['auth', 'verified'])->name('admin.blog.change_blog_publish_status');
    Route::get('/admin/blog-change-active-status/{id}','change_blog_active_status')->middleware(['auth', 'verified'])->name('admin.blog.change_blog_active_status');
    Route::get('/admin/blog-delete/{id}','blog_delete')->middleware(['auth', 'verified'])->name('admin.blog.delete');


    Route::get('/admin/blog-view/{id}','blog_view')->middleware(['auth', 'verified'])->name('admin.blog.view');



    //blog comments.........

    Route::get('/admin/blog-comment','blog_comment')->middleware(['auth', 'verified'])->name('admin.blog.comment');
    Route::get('/admin/blog-comment-change-publish-status/{id}','change_comment_publish_status')->middleware(['auth', 'verified'])->name('admin.blog.comment.change_publish_status');
    Route::get('/admin/blog-comment-delete/{id}','comment_delete')->middleware(['auth', 'verified'])->name('admin.blog.comment.delete');

});


// all Service route.......
Route::controller(ServiceController::class)->group(function(){

    Route::get('/admin/add-service-title','service_title')->middleware(['auth', 'verified'])->name('admin.add.service-title');
    Route::post('/admin/service-title-store','service_title_store')->middleware(['auth', 'verified'])->name('admin.service.title.store');
    Route::get('/admin/add-service','add_service')->middleware(['auth', 'verified'])->name('admin.add.service');
    Route::post('/admin/service-store','service_store')->middleware(['auth', 'verified'])->name('admin.store.service');
    Route::get('/admin/all-service','all_service')->middleware(['auth', 'verified'])->name('admin.all.service');
    Route::get('/admin/service-edit/{id}','service_edit')->middleware(['auth', 'verified'])->name('admin.service.edit');
    Route::post('/admin/service-update','service_update')->middleware(['auth', 'verified'])->name('admin.update.service');
    Route::get('/admin/service-change-publish-status/{id}','change_service_publish_status')->middleware(['auth', 'verified'])->name('admin.service.change_service_publish_status');
    Route::get('/admin/service-change-active-status/{id}','change_service_active_status')->middleware(['auth', 'verified'])->name('admin.service.change_service_active_status');
    Route::get('/admin/service-delete/{id}','service_delete')->middleware(['auth', 'verified'])->name('admin.service.delete');


    Route::get('/admin/service-view/{id}','blog_edit')->middleware(['auth', 'verified'])->name('admin.service.view');




});

// all Testimonial WorkingProcessController
Route::controller(WorkingProcessController::class)->group(function(){

    Route::get('/admin/add-working-process-title','working_process_title')->middleware(['auth', 'verified'])->name('admin.add.working-process-title');
    Route::post('/admin/working-process-title-store','working_process_title_store')->middleware(['auth', 'verified'])->name('admin.working-process.title.store');
    Route::get('/admin/add-process','add_process')->middleware(['auth', 'verified'])->name('admin.add.process');
    Route::post('/admin/process-store','process_store')->middleware(['auth', 'verified'])->name('admin.store.process');
    Route::get('/admin/all-process','all_process')->middleware(['auth', 'verified'])->name('admin.all.process');
    Route::get('/admin/process-edit/{id}','process_edit')->middleware(['auth', 'verified'])->name('admin.process.edit');
    Route::get('/admin/process-change-publish-status/{id}','change_process_publish_status')->middleware(['auth', 'verified'])->name('admin.process.change_process_publish_status');
    Route::get('/admin/process-change-active-status/{id}','change_process_active_status')->middleware(['auth', 'verified'])->name('admin.process.change_process_active_status');
    Route::get('/admin/process-delete/{id}','process_delete')->middleware(['auth', 'verified'])->name('admin.process.delete');
    Route::post('/admin/process-update','process_update')->middleware(['auth', 'verified'])->name('admin.update.process');


    Route::get('/admin/process-view/{id}','process_view')->middleware(['auth', 'verified'])->name('admin.process.view');
});

// all Testimonial route.......
Route::controller(TestimonialController::class)->group(function(){

    Route::get('/admin/add-testimonial-title','testimonial_title')->middleware(['auth', 'verified'])->name('admin.add.testimonial-title');
    Route::post('/admin/testimonial-title-store','testimonial_title_store')->middleware(['auth', 'verified'])->name('admin.testimonial.title.store');
    Route::get('/admin/add-testimonial','add_testimonial')->middleware(['auth', 'verified'])->name('admin.add.testimonial');
    Route::post('/admin/testimonial-store','testimonial_store')->middleware(['auth', 'verified'])->name('admin.store.testimonial');
    Route::get('/admin/all-testimonial','all_testimonial')->middleware(['auth', 'verified'])->name('admin.all.testimonial');
    Route::get('/admin/testimonial-edit/{id}','testimonial_edit')->middleware(['auth', 'verified'])->name('admin.testimonial.edit');
    Route::post('/admin/testimonial-update','testimonial_update')->middleware(['auth', 'verified'])->name('admin.update.testimonial');
    Route::get('/admin/testimonial-change-publish-status/{id}','change_testimonial_publish_status')->middleware(['auth', 'verified'])->name('admin.testimonial.change_testimonial_publish_status');
    Route::get('/admin/testimonial-change-active-status/{id}','change_testimonial_active_status')->middleware(['auth', 'verified'])->name('admin.testimonial.change_testimonial_active_status');
    Route::get('/admin/testimonial-delete/{id}','testimonial_delete')->middleware(['auth', 'verified'])->name('admin.testimonial.delete');





    Route::get('/admin/testimonial-view/{id}','testimonial_view')->middleware(['auth', 'verified'])->name('admin.testimonial.view');
});


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
