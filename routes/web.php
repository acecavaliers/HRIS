<?php

use App\Http\Controllers\Company\EmployeeHandbookHrController;
use App\Http\Controllers\DisciplinaryActionController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeDependentController;
use App\Http\Controllers\Employee\EmployeeDisciplinaryActionController;
use App\Http\Controllers\Employee\EmployeeEducationController;
use App\Http\Controllers\Employee\EmployeeEmploymentDetailController;
use App\Http\Controllers\Employee\EmployeeEmploymentHistoryController;
use App\Http\Controllers\Employee\EmployeeFamilyBackgroundController;
use App\Http\Controllers\Employee\EmployeeIdentificationController;
use App\Http\Controllers\Employee\EmployeeWorkAssignmentController;
use App\Http\Controllers\Maintenance\AllowanceController;
use App\Http\Controllers\Maintenance\BloodTypeController;
use App\Http\Controllers\Maintenance\CivilStatusController;
use App\Http\Controllers\Maintenance\CodeOfDisciplineController;
use App\Http\Controllers\Maintenance\CourseController;
use App\Http\Controllers\Maintenance\DayShiftController;
use App\Http\Controllers\Maintenance\DoctorController;
use App\Http\Controllers\Maintenance\EducationController;
use App\Http\Controllers\Maintenance\EducationLevelController;
use App\Http\Controllers\Maintenance\EducationLevelSchoolController;
use App\Http\Controllers\Maintenance\EmployeeStatusController;
use App\Http\Controllers\Maintenance\GenderController;
use App\Http\Controllers\Maintenance\IdentificationTypeController;
use App\Http\Controllers\Maintenance\InterviewMethodController;
use App\Http\Controllers\Maintenance\JobTitleCategoryController;
use App\Http\Controllers\Maintenance\JobTitleController;
use App\Http\Controllers\Maintenance\LeaveTypeController;
use App\Http\Controllers\Maintenance\NationalityController;
use App\Http\Controllers\Maintenance\OffenseController;
use App\Http\Controllers\Maintenance\OffenseDetailController;
use App\Http\Controllers\Maintenance\OffensesClassificationController;
use App\Http\Controllers\Maintenance\ProficiencyController;
use App\Http\Controllers\Maintenance\ReligionController;
use App\Http\Controllers\Maintenance\SalaryGradeController;
use App\Http\Controllers\Maintenance\SalaryGradeDetailController;
use App\Http\Controllers\Maintenance\SalaryStandardizationController;
use App\Http\Controllers\Maintenance\SchoolController;
use App\Http\Controllers\Maintenance\SpecializationController;
use App\Http\Controllers\Maintenance\SubDepartmentController;
use App\Http\Controllers\Maintenance\SubDepartmentUnitController;
use App\Http\Controllers\Maintenance\SubSpecializationController;
use App\Http\Controllers\Maintenance\SuffixController;
use App\Http\Controllers\Maintenance\TrainingCategoryController;
use App\Http\Controllers\Maintenance\TrainingController;
use App\Http\Controllers\Maintenance\WorkLocationController;
use App\Http\Controllers\Recruitment\ApplicantController;
use App\Http\Controllers\Maintenance\ApplicationStatusController;
use App\Http\Controllers\Maintenance\PrfReasonForReqController;
use App\Http\Controllers\ProfileController;
use App\Models\IdentificationType;
use App\Models\SalaryGrade;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\General\CommonController;
use App\Http\Controllers\SystemTableController;
use App\Http\Controllers\SystemTableMigratedController;
use App\Http\Controllers\NavTabsController;
use App\Http\Controllers\Maintenance\CountriesController;
use App\Http\Controllers\ModuleCategoryController;
use App\Http\Controllers\EmployeeOnboardingController;
use App\Http\Controllers\EmployeeOffboardingController;
use App\Http\Controllers\SystemTableDetailsController;
use App\Http\Controllers\Maintenance\RegionsController;
use App\Http\Controllers\FormTypeController;
use App\Http\Controllers\Maintenance\ApplicationSourceController;
use App\Http\Controllers\Maintenance\AutoGenerateCodeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Maintenance\ProvinceController;
use App\Http\Controllers\Maintenance\CityController;
use App\Http\Controllers\Maintenance\JobLevelController;
use App\Http\Controllers\Maintenance\DepartmentController;
use App\Http\Controllers\Maintenance\DivisionController;
use App\Http\Controllers\Maintenance\JobPositionController;
use App\Http\Controllers\Maintenance\OccupationController;
use App\Http\Controllers\Maintenance\CourseCategoryController;
use App\Http\Controllers\Maintenance\DoctorCategoryController;
use App\Http\Controllers\Maintenance\EarningController;
use App\Http\Controllers\Maintenance\SkillController;
use App\Http\Controllers\Maintenance\EmployeeTypeController;
use App\Http\Controllers\Maintenance\LanguageController;
use App\Http\Controllers\Maintenance\EventTypeController;
use App\Http\Controllers\Maintenance\HolidayTypeController;
use App\Http\Controllers\Maintenance\HolidayController;
use App\Http\Controllers\Maintenance\WorkShiftController;
use App\Http\Controllers\Maintenance\IslandGroupController;
use App\Http\Controllers\Maintenance\RelationshipController;
use App\Http\Controllers\Recruitment\PersonnelRequisitionController;
use App\Http\Controllers\Company\CalendarController;
use App\Http\Controllers\EmployeeWorkScheduleController;
use App\Http\Controllers\Maintenance\EmployeeHandBookController;
use App\Http\Controllers\Maintenance\EmploymentTypeController;
use App\Http\Controllers\Maintenance\OffenseCategoryController;
use App\Http\Controllers\Maintenance\OffenseSeverityController;
use App\Http\Controllers\Maintenance\PrfStatusController;
use App\Http\Controllers\Timekeeping\ClockEntriesController;
use App\Http\Controllers\Settings\SystemSettingsController;
use App\Http\Controllers\Recruitment\RecruitmentDashboardController;
use App\Http\Controllers\Settings\PersonnelRequisitionSettingController;
use App\Http\Controllers\Recruitment\CareerController;
use App\Http\Controllers\Settings\PersonnelRequisition\PrfApproverSettingController;
use App\Http\Controllers\Settings\ThemeSettings\ThemeColorSettingController;
use App\Http\Controllers\OnboardingChecklist\OnboardingChecklistController;
use App\Http\Controllers\Performance\PerformanceTypeController;
use App\Http\Controllers\Performance\IndicatorTypeController;
use App\Http\Controllers\Performance\AppraisalTypeController;
use App\Http\Controllers\Performance\GoalController;
use App\Http\Controllers\Performance\GoalTypeController;
use App\Http\Controllers\Performance\GoalTrackingController;
use App\Http\Controllers\Performance\CompetenceController;
use App\Http\Controllers\RequestTimeOffController;
use App\Http\Controllers\ShiftSetupController;
use App\Models\EmployeeWorkSchedule;
use App\Models\School;

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
    /*  return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]); */
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // ...

    /* CommonContoller */
    Route::post('/getTableColumns', [CommonController::class, 'getTableColumns'])->name('getTableColumns');
    Route::get('/getCurrentNavSidebar', [CommonController::class, 'getCurrentNavSidebar'])->name('getCurrentNavSidebar');
    Route::get('/gettablenames', [CommonController::class, 'getTableNames'])->name('gettablenames');
    Route::patch('/updateEnableDisplayColumn', [CommonController::class, 'updateEnableDisplayColumn'])->name('updateEnableDisplayColumn');
    Route::patch('/updateEnableDisplayColumnForDefault', [CommonController::class, 'updateEnableDisplayColumnForDefault'])->name('updateEnableDisplayColumnForDefault');
    Route::get('/getSearchFormColumns', [CommonController::class, 'getSearchFormColumns'])->name('searchformcolumns');
    Route::get('/getAddFormColumns',  [CommonController::class, 'getAddFormColumns'])->name('addformcolumns');
    Route::get('/getAddFormColumnsCustom', [CommonController::class, 'getAddFormColumnsCustom'])->name('addformcolumnscustom');
    Route::get('/getDataFromReferenceTable', [CommonController::class, 'getDataFromReferenceTable'])->name('getDataFromReferenceTable');
    Route::get('/getDataFromReferenceTableWhereColumn', [CommonController::class, 'getDataFromReferenceTableWhereColumn'])->name('getDataFromReferenceTableWhereColumn');

    Route::get('/getEditFormColumns',  [CommonController::class, 'getEditFormColumns'])->name('editformcolumns');
    Route::get('/getDataFromForeignKey', [CommonController::class, 'getDataFromForeignKey']);
    Route::get('/getActiveModuleCurrentColumns', [CommonController::class, 'getActiveModuleCurrentColumns'])->name('getActiveModuleCurrentColumns');
    Route::get('/getCurrentModuleByPageUrl', [CommonController::class, 'getCurrentModuleByPageUrl'])->name('getCurrentModuleByPageUrl');
    Route::get('/getCountNotYetMigrated', [CommonController::class, 'getCountNotYetMigrated'])->name('getCountNotYetMigrated');
    Route::get('/getTableColumnsFinal', [CommonController::class, 'getTableColumnsFinal'])->name('getTableColumnsFinal');
    /* ModuleController */
    Route::patch('/module/updateCurrentActive', [ModuleController::class, 'updateCurrentActive'])->name('module.updatecurrentactive');
    Route::patch('/module/updateDefault', [ModuleController::class, 'updateDefault'])->name('module.updateDefault');
    Route::get('/modules', [ModuleController::class, 'indexactive'])->name('modules');

    /* SubmoduleController */
    Route::patch('/submodule/updateCurrentActive', [SubmoduleController::class, 'updateCurrentActive'])->name('submodule.updatecurrentactive');


    /* NavTabsController  */
    Route::get('/navtabs', [NavTabsController::class, 'index'])->name('navtabs');
    Route::patch('/updateCurrentNavTab', [NavTabsController::class, 'updateCurrentNavTab'])->name('updateCurrentNavTab');
    Route::patch('/getDefaultTabView', [NavTabsController::class, 'getDefaultTabView'])->name('getDefaultTabView');


    /* SystemTableController */
    Route::get('/systemtablelistalldata', [SystemTableController::class, 'listalldata'])->name('systemtablelistalldata');

    /* SystemTableDetailsController */
    Route::put('/updateByBulk', [SystemTableDetailsController::class, 'updateByBulk'])->name('systemtabledetails.updateByBulk');

    /* ModuleCategoryController */
    Route::get('/modulecategory/getlistactive', [ModuleCategoryController::class, 'getlistactive'])->name('modulecategory.getlistactive');

    /* SystemTableMigratedController */
    Route::get('/systemtablesmigrated/getlist', [SystemTableMigratedController::class, 'getlist'])->name('systemtablesmigrated.getlist');


    Route::get('/systemtablesdetails/getlist', [SystemTableDetailsController::class, 'getlist'])->name('systemtablesdetails.getlist');
    Route::get('/systemtablesdetails/getcolumns', [SystemTableDetailsController::class, 'getcolumns'])->name('systemtablesdetails.getcolumns');
    Route::get('/systemtablesdetails/systemtabledetailssearch', [SystemTableDetailsController::class, 'searchData'])->name('systemtabledetailssearch');
    Route::get('/systemtablesdetails/getspecificlist', [SystemTableDetailsController::class, 'getSystemDetailsBySystemTable'])->name('getSystemDetailsBySystemTable');

    /* Countries */
    Route::get('/countries/getlist', [CountriesController::class, 'getlist'])->name('countries.getlist');
    Route::get('/countries/getcolumns', [CountriesController::class, 'getcolumns'])->name('countries.getcolumns');
    Route::get('/countries/search', [CountriesController::class, 'searchData'])->name('countries.search');
    Route::get('/countries/getactivelist', [CountriesController::class, 'getactivelist'])->name('countries.getactivelist');
    /* Regions */
    Route::get('/regions/getlist', [RegionsController::class, 'getlist'])->name('regions.getlist');
    Route::get('/regions/getcolumns', [RegionsController::class, 'getcolumns'])->name('regions.getcolumns');
    Route::get('/regions/search', [RegionsController::class, 'searchData'])->name('regions.search');
    Route::get('/regions/getactivelist', [RegionsController::class, 'getactivelist'])->name('regions.getactivelist');

    /* Province */
    Route::get('/provinces/getlist', [ProvinceController::class, 'getlist'])->name('provinces.getlist');
    Route::get('/provinces/getcolumns', [ProvinceController::class, 'getcolumns'])->name('provinces.getcolumns');
    Route::get('/provinces/search', [ProvinceController::class, 'searchData'])->name('provinces.search');
    Route::get('/provinces/getactivelist', [ProvinceController::class, 'getactivelist'])->name('provinces.getactivelist');

    /* City */
    Route::get('/cities/getlist', [CityController::class, 'getlist'])->name('cities.getlist');
    Route::get('/cities/getcolumns', [CityController::class, 'getcolumns'])->name('cities.getcolumns');
    Route::get('/cities/search', [CityController::class, 'searchData'])->name('cities.search');
    Route::get('/cities/getactivelist', [CityController::class, 'getactivelist'])->name('cities.getactivelist');

    /* JobLevel */
    Route::get('/joblevels/getlist', [JobLevelController::class, 'getlist'])->name('joblevels.getlist');
    Route::get('/joblevels/getcolumns', [JobLevelController::class, 'getcolumns'])->name('joblevels.getcolumns');
    Route::get('/joblevels/search', [JobLevelController::class, 'searchData'])->name('joblevels.search');

    /* Permissions */
    Route::get('/permission/getlist', [PermissionController::class, 'getlist'])->name('permissions.getlist');
    Route::get('/permission/getcolumns', [PermissionController::class, 'getcolumns'])->name('permissions.getcolumns');
    Route::get('/permission/search', [PermissionController::class, 'searchData'])->name('permissions.search');
    Route::get('/permission/getActiveList', [PermissionController::class, 'getActiveList'])->name('permissions.getActiveList');


    /* Role */
    Route::get('/role/getlist', [RoleController::class, 'getlist'])->name('roles.getlist');
    Route::get('/role/getcolumns', [RoleController::class, 'getcolumns'])->name('roles.getcolumns');
    Route::get('/role/search', [RoleController::class, 'searchData'])->name('roles.search');

    /* Division */
    Route::get('/divisions/getlist', [DivisionController::class, 'getlist'])->name('divisions.getlist');
    Route::get('/divisions/getcolumns', [DivisionController::class, 'getcolumns'])->name('divisions.getcolumns');
    Route::get('/divisions/search', [DivisionController::class, 'searchData'])->name('divisions.search');

    /* Department */
    Route::get('/departments/getlist', [DepartmentController::class, 'getlist'])->name('departments.getlist');
    Route::get('/departments/getcolumns', [DepartmentController::class, 'getcolumns'])->name('departments.getcolumns');
    Route::get('/departments/search', [DepartmentController::class, 'searchData'])->name('departments.search');

    /* SubDepartment */
    Route::get('/subdepartments/getlist', [SubDepartmentController::class, 'getlist'])->name('subdepartments.getlist');
    Route::get('/subdepartments/getcolumns', [SubDepartmentController::class, 'getcolumns'])->name('subdepartments.getcolumns');
    Route::get('/subdepartments/search', [SubDepartmentController::class, 'searchData'])->name('subdepartments.search');

    /* SubDepartmentUnit */
    Route::get('/subdepartmentunits/getlist', [SubDepartmentUnitController::class, 'getlist'])->name('subdepartmentunits.getlist');
    Route::get('/subdepartmentunits/getcolumns', [SubDepartmentUnitController::class, 'getcolumns'])->name('subdepartmentunits.getcolumns');
    Route::get('/subdepartmentunits/search', [SubDepartmentUnitController::class, 'searchData'])->name('subdepartmentunits.search');

    /* JobPosition */
    Route::get('/jobpositions/getlist', [JobPositionController::class, 'getlist'])->name('jobpositions.getlist');
    Route::get('/jobpositions/getcolumns', [JobPositionController::class, 'getcolumns'])->name('jobpositions.getcolumns');
    Route::get('/jobpositions/search', [JobPositionController::class, 'searchData'])->name('jobpositions.search');

    /* Occupations */
    Route::get('/occupations/getlist', [OccupationController::class, 'getlist'])->name('occupations.getlist');
    Route::get('/occupations/getcolumns', [OccupationController::class, 'getcolumns'])->name('occupations.getcolumns');
    Route::get('/occupations/search', [OccupationController::class, 'searchData'])->name('occupations.search');

    /* LeaveTypes */
    Route::get('/leavetypes/getlist', [LeaveTypeController::class, 'getlist'])->name('leavetypes.getlist');
    Route::get('/leavetypes/getcolumns', [LeaveTypeController::class, 'getcolumns'])->name('leavetypes.getcolumns');
    Route::get('/leavetypes/search', [LeaveTypeController::class, 'searchData'])->name('leavetypes.search');

    /* Proficiency */
    Route::get('/proficiencies/getlist', [ProficiencyController::class, 'getlist'])->name('proficiencies.getlist');
    Route::get('/proficiencies/getcolumns', [ProficiencyController::class, 'getcolumns'])->name('proficiencies.getcolumns');
    Route::get('/proficiencies/search', [ProficiencyController::class, 'searchData'])->name('proficiencies.search');
    /* Course Category */
    Route::get('/coursecategories/getlist', [CourseCategoryController::class, 'getlist'])->name('coursecategories.getlist');
    Route::get('/coursecategories/getcolumns', [CourseCategoryController::class, 'getcolumns'])->name('coursecategories.getcolumns');
    Route::get('/coursecategories/search', [CourseCategoryController::class, 'searchData'])->name('coursecategories.search');

    /* Skill */
    Route::get('/skills/getlist', [SkillController::class, 'getlist'])->name('skills.getlist');
    Route::get('/skills/getcolumns', [SkillController::class, 'getcolumns'])->name('skills.getcolumns');
    Route::get('/skills/search', [SkillController::class, 'searchData'])->name('skills.search');

    /* Education */
    Route::get('/educations/getlist', [EducationController::class, 'getlist'])->name('educations.getlist');
    Route::get('/educations/getcolumns', [EducationController::class, 'getcolumns'])->name('educations.getcolumns');
    Route::get('/educations/search', [EducationController::class, 'searchData'])->name('educations.search');

    /* Employee Type */
    Route::get('/employeetypes/getlist', [EmployeeTypeController::class, 'getlist'])->name('employeetypes.getlist');
    Route::get('/employeetypes/getcolumns', [EmployeeTypeController::class, 'getcolumns'])->name('employeetypes.getcolumns');
    Route::get('/employeetypes/search', [EmployeeTypeController::class, 'searchData'])->name('employeetypes.search');

    /* Employment Type */
    Route::get('/employmenttypes/getlist', [EmploymentTypeController::class, 'getlist'])->name('employmenttypes.getlist');
    Route::get('/employmenttypes/getcolumns', [EmploymentTypeController::class, 'getcolumns'])->name('employmenttypes.getcolumns');
    Route::get('/employmenttypes/search', [EmploymentTypeController::class, 'searchData'])->name('employmenttypes.search');

    /* Offense Category */
    Route::get('/offensecategories/getlist', [OffenseCategoryController::class, 'getlist'])->name('offensecategories.getlist');
    Route::get('/offensecategories/getcolumns', [OffenseCategoryController::class, 'getcolumns'])->name('offensecategories.getcolumns');
    Route::get('/offensecategories/search', [OffenseCategoryController::class, 'searchData'])->name('offensecategories.search');

    /* Offense Severity */
    Route::get('/offenseseverities/getlist', [OffenseSeverityController::class, 'getlist'])->name('offenseseverities.getlist');
    Route::get('/offenseseverities/getcolumns', [OffenseSeverityController::class, 'getcolumns'])->name('offenseseverities.getcolumns');
    Route::get('/offenseseverities/search', [OffenseSeverityController::class, 'searchData'])->name('offenseseverities.search');

    /* EducationLevel */
    Route::get('/educationlevels/getlist', [EducationLevelController::class, 'getlist'])->name('educationlevels.getlist');
    Route::get('/educationlevels/getcolumns', [EducationLevelController::class, 'getcolumns'])->name('educationlevels.getcolumns');
    Route::get('/educationlevels/search', [EducationLevelController::class, 'searchData'])->name('educationlevels.search');

    /* Course */
    Route::get('/courses/getlist', [CourseController::class, 'getlist'])->name('courses.getlist');
    Route::get('/courses/getcolumns', [CourseController::class, 'getcolumns'])->name('courses.getcolumns');
    Route::get('/courses/search', [CourseController::class, 'searchData'])->name('courses.search');

    /* Languages */
    Route::get('/languages/getlist', [LanguageController::class, 'getlist'])->name('languages.getlist');
    Route::get('/languages/getcolumns', [LanguageController::class, 'getcolumns'])->name('languages.getcolumns');
    Route::get('/languages/search', [LanguageController::class, 'searchData'])->name('languages.search');

    /* Disciplinary Action */
    Route::get('/disciplinaryactions/getlist', [DisciplinaryActionController::class, 'getlist'])->name('disciplinaryactions.getlist');
    Route::get('/disciplinaryactions/getcolumns', [DisciplinaryActionController::class, 'getcolumns'])->name('disciplinaryactions.getcolumns');
    Route::get('/disciplinaryactions/search', [DisciplinaryActionController::class, 'searchData'])->name('disciplinaryactions.search');

    /* Event Type */
    Route::get('/eventtypes/getlist', [EventTypeController::class, 'getlist'])->name('eventtypes.getlist');
    Route::get('/eventtypes/getcolumns', [EventTypeController::class, 'getcolumns'])->name('eventtypes.getcolumns');
    Route::get('/eventtypes/search', [EventTypeController::class, 'searchData'])->name('eventtypes.search');

    /* HolidayType */
    Route::get('/holidaytypes/getlist', [HolidayTypeController::class, 'getlist'])->name('holidaytypes.getlist');
    Route::get('/holidaytypes/getcolumns', [HolidayTypeController::class, 'getcolumns'])->name('holidaytypes.getcolumns');
    Route::get('/holidaytypes/search', [HolidayTypeController::class, 'searchData'])->name('holidaytypes.search');

    /* Holiday */
    Route::get('/holidays/getlist', [HolidayController::class, 'getlist'])->name('holidays.getlist');
    Route::get('/holidays/getcolumns', [HolidayController::class, 'getcolumns'])->name('holidays.getcolumns');
    Route::get('/holidays/search', [HolidayController::class, 'searchData'])->name('holidays.search');
    Route::get('/holidays/getTodayEvent', [HolidayController::class, 'getTodayEvent'])->name('holidays.getTodayEvent');
    Route::get('/holidays/getWeeklyEvent', [HolidayController::class, 'getWeeklyEvent'])->name('holidays.getWeeklyEvent');

    /* Schools */
    Route::get('/schools/getlist', [SchoolController::class, 'getlist'])->name('schools.getlist');
    Route::get('/schools/getcolumns', [SchoolController::class, 'getcolumns'])->name('schools.getcolumns');
    Route::get('/schools/search', [SchoolController::class, 'searchData'])->name('schools.search');

    /* Education Level School */
    Route::get('/educationlevelschools/getlist', [EducationLevelSchoolController::class, 'getlist'])->name('educationlevelschools.getlist');
    Route::get('/educationlevelschools/getcolumns', [EducationLevelSchoolController::class, 'getcolumns'])->name('educationlevelschools.getcolumns');
    Route::get('/educationlevelschools/search', [EducationLevelSchoolController::class, 'searchData'])->name('educationlevelschools.search');


    /* Work Shift */
    Route::get('/workshifts/getlist', [WorkShiftController::class, 'getlist'])->name('workshifts.getlist');
    Route::get('/workshifts/getcolumns', [WorkShiftController::class, 'getcolumns'])->name('workshifts.getcolumns');
    Route::get('/workshifts/search', [WorkShiftController::class, 'searchData'])->name('workshifts.search');


    // Shiftsetups
    Route::get('/shiftsetup/getcolumns', [ShiftSetupController::class, 'getcolumns'])->name('shiftsetup.getcolumns');
    Route::get('/shiftsetup/getlist', [ShiftSetupController::class, 'getlist'])->name('shiftsetup.getlist');
    Route::get('/shiftsetup/search', [ShiftSetupController::class, 'searchData'])->name('shiftsetup.search');

    Route::get('/shiftsetup/getDiv', [ShiftSetupController::class, 'getDiv'])->name('shiftsetup.getDiv');
    Route::get('/shiftsetup/getDept', [ShiftSetupController::class, 'getDept'])->name('shiftsetup.getDept');
    Route::get('/shiftsetup/getSubDept', [ShiftSetupController::class, 'getSubDept'])->name('shiftsetup.getSubDept');
    Route::get('/shiftsetup/getSubDeptUnit', [ShiftSetupController::class, 'getSubDeptUnit'])->name('shiftsetup.getSubDeptUnit');


    /* Relationship */
    Route::get('/relationships/getlist', [RelationshipController::class, 'getlist'])->name('relationships.getlist');
    Route::get('/relationships/getcolumns', [RelationshipController::class, 'getcolumns'])->name('relationships.getcolumns');
    Route::get('/relationships/search', [RelationshipController::class, 'searchData'])->name('relationships.search');


    Route::get('/islandgroups/getlist', [IslandGroupController::class, 'getlist'])->name('islandgroups.getlist');
    Route::get('/islandgroups/getcolumns', [IslandGroupController::class, 'getcolumns'])->name('islandgroups.getcolumns');
    Route::get('/islandgroups/search', [IslandGroupController::class, 'searchData'])->name('islandgroups.search');

    /* Application Source */
    Route::get('/applicationsources/getlist', [ApplicationSourceController::class, 'getlist'])->name('applicationsources.getlist');
    Route::get('/applicationsources/getcolumns', [ApplicationSourceController::class, 'getcolumns'])->name('applicationsources.getcolumns');
    Route::get('/applicationsources/search', [ApplicationSourceController::class, 'searchData'])->name('applicationsources.search');

    /* Earnings */
    Route::get('/earnings/getlist', [EarningController::class, 'getlist'])->name('earnings.getlist');
    Route::get('/earnings/getcolumns', [EarningController::class, 'getcolumns'])->name('earnings.getcolumns');
    Route::get('/earnings/search', [EarningController::class, 'searchData'])->name('earnings.search');

    /* Allowance */
    Route::get('/allowances/getlist', [AllowanceController::class, 'getlist'])->name('allowances.getlist');
    Route::get('/allowances/getcolumns', [AllowanceController::class, 'getcolumns'])->name('allowances.getcolumns');
    Route::get('/allowances/search', [AllowanceController::class, 'searchData'])->name('allowances.search');

    /* Specialization */
    Route::get('/specializations/getlist', [SpecializationController::class, 'getlist'])->name('specializations.getlist');
    Route::get('/specializations/getcolumns', [SpecializationController::class, 'getcolumns'])->name('specializations.getcolumns');
    Route::get('/specializations/search', [SpecializationController::class, 'searchData'])->name('specializations.search');

    /* SubSpecialization */
    Route::get('/subspecializations/getlist', [SubSpecializationController::class, 'getlist'])->name('subspecializations.getlist');
    Route::get('/subspecializations/getcolumns', [SubSpecializationController::class, 'getcolumns'])->name('subspecializations.getcolumns');
    Route::get('/subspecializations/search', [SubSpecializationController::class, 'searchData'])->name('subspecializations.search');

    /* Doctor Category */
    Route::get('/doctorcategories/getlist', [DoctorCategoryController::class, 'getlist'])->name('doctorcategories.getlist');
    Route::get('/doctorcategories/getcolumns', [DoctorCategoryController::class, 'getcolumns'])->name('doctorcategories.getcolumns');
    Route::get('/doctorcategories/search', [DoctorCategoryController::class, 'searchData'])->name('doctorcategories.search');

    /* PrfReasonForReq */
    Route::get('/prfreasonforreqs/getlist', [PrfReasonForReqController::class, 'getlist'])->name('prfreasonforreqs.getlist');
    Route::get('/prfreasonforreqs/getcolumns', [PrfReasonForReqController::class, 'getcolumns'])->name('prfreasonforreqs.getcolumns');
    Route::get('/prfreasonforreqs/search', [PrfReasonForReqController::class, 'searchData'])->name('prfreasonforreqs.search');

    /* Auto Generate Codes */
    Route::get('/autogeneratecodes/getlist', [AutoGenerateCodeController::class, 'getlist'])->name('autogeneratecodes.getlist');
    Route::get('/autogeneratecodes/getcolumns', [AutoGenerateCodeController::class, 'getcolumns'])->name('autogeneratecodes.getcolumns');
    Route::get('/autogeneratecodes/search', [AutoGenerateCodeController::class, 'searchData'])->name('autogeneratecodes.search');
    Route::get('/autogeneratecodes/getautogeneratecode', [AutoGenerateCodeController::class, 'getAutoGenCodeBySystemTableDetails'])->name('autogeneratecodes.getAutoGenCodeBySystemTableDetails');
    Route::patch('/autogeneratecodes/updateNextNo', [AutoGenerateCodeController::class, 'updateNextNo'])->name('autogeneratecodes.updateNextNo');
    /* Personnel Requisitions */
    Route::get('/personnelrequisitions/getlist', [PersonnelRequisitionController::class, 'getlist'])->name('personnelrequisitions.getlist');
    Route::get('/personnelrequisitions/getcolumns', [PersonnelRequisitionController::class, 'getcolumns'])->name('personnelrequisitions.getcolumns');
    Route::get('/personnelrequisitions/search', [PersonnelRequisitionController::class, 'searchData'])->name('personnelrequisitions.search');

    Route::get('/prfstatus/getlist', [PrfStatusController::class, 'getlist'])->name('prfstatus.getlist');
    Route::get('/prfstatus/getcolumns', [PrfStatusController::class, 'getcolumns'])->name('prfstatus.getcolumns');
    Route::get('/prfstatus/search', [PrfStatusController::class, 'searchData'])->name('prfstatus.search');

    /* Applicant  */
    Route::get('/applicants/getlist', [ApplicantController::class, 'getlist'])->name('applicants.getlist');
    Route::get('/applicants/getcolumns', [ApplicantController::class, 'getcolumns'])->name('applicants.getcolumns');
    Route::get('/applicants/search', [ApplicantController::class, 'searchData'])->name('applicants.search');

    /* Employee Handbooks  */
    Route::get('/employeehandbooks/getlist', [EmployeeHandbookHrController::class, 'getlist'])->name('employeehandbooks.getlist');
    Route::get('/employeehandbooks/getcolumns', [EmployeeHandbookHrController::class, 'getcolumns'])->name('employeehandbooks.getcolumns');
    Route::get('/employeehandbooks/search', [EmployeeHandbookHrController::class, 'searchData'])->name('employeehandbooks.search');
    Route::post('/file-upload', [EmployeeHandbookHrController::class, 'getFileName']);



    /* Job Title Category */
    Route::get('/jobtitlecategories/getlist', [JobTitleCategoryController::class, 'getlist'])->name('jobtitlecategories.getlist');
    Route::get('/jobtitlecategories/getcolumns', [JobTitleCategoryController::class, 'getcolumns'])->name('jobtitlecategories.getcolumns');
    Route::get('/jobtitlecategories/search', [JobTitleCategoryController::class, 'searchData'])->name('jobtitlecategories.search');

    /* Job Title  */
    Route::get('/jobtitles/getlist', [JobTitleController::class, 'getlist'])->name('jobtitles.getlist');
    Route::get('/jobtitles/getcolumns', [JobTitleController::class, 'getcolumns'])->name('jobtitles.getcolumns');
    Route::get('/jobtitles/search', [JobTitleController::class, 'searchData'])->name('jobtitles.search');

    /* Application status  */
    Route::get('/applicationstatuses/getlist', [ApplicationStatusController::class, 'getlist'])->name('applicationstatuses.getlist');
    Route::get('/applicationstatuses/getcolumns', [ApplicationStatusController::class, 'getcolumns'])->name('applicationstatuses.getcolumns');
    Route::get('/applicationstatuses/search', [ApplicationStatusController::class, 'searchData'])->name('applicationstatuses.search');

    /* Interview Methods  */
    Route::get('/interviewmethods/getlist', [InterviewMethodController::class, 'getlist'])->name('interviewmethods.getlist');
    Route::get('/interviewmethods/getcolumns', [InterviewMethodController::class, 'getcolumns'])->name('interviewmethods.getcolumns');
    Route::get('/interviewmethods/search', [InterviewMethodController::class, 'searchData'])->name('interviewmethods.search');

    /* Offenses  */
    Route::get('/offenses/getlist', [OffenseController::class, 'getlist'])->name('offenses.getlist');
    Route::get('/offenses/getcolumns', [OffenseController::class, 'getcolumns'])->name('offenses.getcolumns');
    Route::get('/offenses/search', [OffenseController::class, 'searchData'])->name('offenses.search');

    /* Offense Details  */
    Route::get('/offensedetails/getlist', [OffenseDetailController::class, 'getlist'])->name('offensedetails.getlist');
    Route::get('/offensedetails/getcolumns', [OffenseDetailController::class, 'getcolumns'])->name('offensedetails.getcolumns');
    Route::get('/offensedetails/search', [OffenseDetailController::class, 'searchData'])->name('offensedetails.search');

    /* Code of Discipline  */
    Route::get('/codeofdisciplines/getlist', [CodeOfDisciplineController::class, 'getlist'])->name('codeofdisciplines.getlist');
    Route::get('/codeofdisciplines/getcolumns', [CodeOfDisciplineController::class, 'getcolumns'])->name('codeofdisciplines.getcolumns');
    Route::get('/codeofdisciplines/search', [CodeOfDisciplineController::class, 'searchData'])->name('codeofdisciplines.search');

    /* Offenses Classifications */
    Route::get('/offensesclassifications/getlist', [OffensesClassificationController::class, 'getlist'])->name('offensesclassifications.getlist');
    Route::get('/offensesclassifications/getcolumns', [OffensesClassificationController::class, 'getcolumns'])->name('offensesclassifications.getcolumns');
    Route::get('/offensesclassifications/search', [OffensesClassificationController::class, 'searchData'])->name('offensesclassifications.search');

    /* Work Locations */
    Route::get('/worklocations/getlist', [WorkLocationController::class, 'getlist'])->name('worklocations.getlist');
    Route::get('/worklocations/getcolumns', [WorkLocationController::class, 'getcolumns'])->name('worklocations.getcolumns');
    Route::get('/worklocations/search', [WorkLocationController::class, 'searchData'])->name('worklocations.search');

    /* Day Shifts */
    Route::get('/dayshifts/getlist', [DayShiftController::class, 'getlist'])->name('dayshifts.getlist');
    Route::get('/dayshifts/getcolumns', [DayShiftController::class, 'getcolumns'])->name('dayshifts.getcolumns');
    Route::get('/dayshifts/search', [DayShiftController::class, 'searchData'])->name('dayshifts.search');

    /* Day Shifts */
    Route::get('/identificationtypes/getlist', [IdentificationTypeController::class, 'getlist'])->name('identificationtypes.getlist');
    Route::get('/identificationtypes/getcolumns', [IdentificationTypeController::class, 'getcolumns'])->name('identificationtypes.getcolumns');
    Route::get('/identificationtypes/search', [IdentificationTypeController::class, 'searchData'])->name('identificationtypes.search');

    /* Employee */
    Route::get('/employees/getlist', [EmployeeController::class, 'getlist'])->name('employees.getlist');
    Route::get('/employees/getcolumns', [EmployeeController::class, 'getcolumns'])->name('employees.getcolumns');
    Route::get('/employees/search', [EmployeeController::class, 'searchData'])->name('employees.search');

    /* Employee Status*/
    Route::get('/employeestatuses/getlist', [EmployeeStatusController::class, 'getlist'])->name('employeestatuses.getlist');
    Route::get('/employeestatuses/getcolumns', [EmployeeStatusController::class, 'getcolumns'])->name('employeestatuses.getcolumns');
    Route::get('/employeestatuses/search', [EmployeeStatusController::class, 'searchData'])->name('employeestatuses.search');

    /* Blood Types*/
    Route::get('/bloodtypes/getlist', [BloodTypeController::class, 'getlist'])->name('bloodtypes.getlist');
    Route::get('/bloodtypes/getcolumns', [BloodTypeController::class, 'getcolumns'])->name('bloodtypes.getcolumns');
    Route::get('/bloodtypes/search', [BloodTypeController::class, 'searchData'])->name('bloodtypes.search');

    /* Religions */
    Route::get('/religions/getlist', [ReligionController::class, 'getlist'])->name('religions.getlist');
    Route::get('/religions/getcolumns', [ReligionController::class, 'getcolumns'])->name('religions.getcolumns');
    Route::get('/religions/search', [ReligionController::class, 'searchData'])->name('religions.search');

    /* Civil Status */
    Route::get('/civilstatuses/getlist', [CivilStatusController::class, 'getlist'])->name('civilstatuses.getlist');
    Route::get('/civilstatuses/getcolumns', [CivilStatusController::class, 'getcolumns'])->name('civilstatuses.getcolumns');
    Route::get('/civilstatuses/search', [CivilStatusController::class, 'searchData'])->name('civilstatuses.search');

    /* Nationality */
    Route::get('/nationalities/getlist', [NationalityController::class, 'getlist'])->name('nationalities.getlist');
    Route::get('/nationalities/getcolumns', [NationalityController::class, 'getcolumns'])->name('nationalities.getcolumns');
    Route::get('/nationalities/search', [NationalityController::class, 'searchData'])->name('nationalities.search');

    /* Suffix */
    Route::get('/suffixes/getlist', [SuffixController::class, 'getlist'])->name('suffixes.getlist');
    Route::get('/suffixes/getcolumns', [SuffixController::class, 'getcolumns'])->name('suffixes.getcolumns');
    Route::get('/suffixes/search', [SuffixController::class, 'searchData'])->name('suffixes.search');


    /* FormType */
    Route::get('/formtype/getFormTypebyDataType', [FormTypeController::class, 'getFormTypebyDataType'])->name('formtype.getformtypebydatatype');
    Route::get('/formtype/getFormTypebyDataTypeByID', [FormTypeController::class, 'getFormTypebyDataTypeByID'])->name('formtype.getFormTypebyDataTypeByID');

    /* Employee Education */
    Route::get('/employeeeducation/getlist', [EmployeeEducationController::class, 'getlist'])->name('employeeeducation.getlist');
    Route::get('/employeeeducation/getcolumns', [EmployeeEducationController::class, 'getcolumns'])->name('employeeeducation.getcolumns');
    Route::get('/employeeeducation/search', [EmployeeEducationController::class, 'searchData'])->name('employeeeducation.search');

    /* Employee Employment History */
    Route::get('/employeeemploymenthistories/getlist', [EmployeeEmploymentHistoryController::class, 'getlist'])->name('employeeemploymenthistories.getlist');
    Route::get('/employeeemploymenthistories/getcolumns', [EmployeeEmploymentHistoryController::class, 'getcolumns'])->name('employeeemploymenthistories.getcolumns');
    Route::get('/employeeemploymenthistories/search', [EmployeeEmploymentHistoryController::class, 'searchData'])->name('employeeemploymenthistories.search');

    /* Employee Employment Details */
    Route::get('/employeeemploymentdetails/getlist', [EmployeeEmploymentDetailController::class, 'getlist'])->name('employeeemploymentdetails.getlist');
    Route::get('/employeeemploymentdetails/getcolumns', [EmployeeEmploymentDetailController::class, 'getcolumns'])->name('employeeemploymentdetails.getcolumns');
    Route::get('/employeeemploymentdetails/search', [EmployeeEmploymentDetailController::class, 'searchData'])->name('employeeemploymentdetails.search');

    /* Employee Family Background */
    Route::get('/employeefamilybackgrounds/getlist', [EmployeeFamilyBackgroundController::class, 'getlist'])->name('employeefamilybackgrounds.getlist');
    Route::get('/employeefamilybackgrounds/getcolumns', [EmployeeFamilyBackgroundController::class, 'getcolumns'])->name('employeefamilybackgrounds.getcolumns');
    Route::get('/employeefamilybackgrounds/search', [EmployeeFamilyBackgroundController::class, 'searchData'])->name('employeefamilybackgrounds.search');

    /* Employee  Dependet */
    Route::get('/employeedependents/getlist', [EmployeeDependentController::class, 'getlist'])->name('employeedependents.getlist');
    Route::get('/employeedependents/getcolumns', [EmployeeDependentController::class, 'getcolumns'])->name('employeedependents.getcolumns');
    Route::get('/employeedependents/search', [EmployeeDependentController::class, 'searchData'])->name('employeedependents.search');

    /* Employee  Disciplinary Actions */
    Route::get('/employeedisciplinaryactions/getlist', [EmployeeDisciplinaryActionController::class, 'getlist'])->name('employeedisciplinaryactions.getlist');
    Route::get('/employeedisciplinaryactions/getcolumns', [EmployeeDisciplinaryActionController::class, 'getcolumns'])->name('employeedisciplinaryactions.getcolumns');
    Route::get('/employeedisciplinaryactions/search', [EmployeeDisciplinaryActionController::class, 'searchData'])->name('employeedisciplinaryactions.search');

    /* Employee Work Assignment */
    Route::get('/employeeworkassignments/getlist', [EmployeeWorkAssignmentController::class, 'getlist'])->name('employeeworkassignments.getlist');
    Route::get('/employeeworkassignments/getcolumns', [EmployeeWorkAssignmentController::class, 'getcolumns'])->name('employeeworkassignments.getcolumns');
    Route::get('/employeeworkassignments/search', [EmployeeWorkAssignmentController::class, 'searchData'])->name('employeeworkassignments.search');

    /* Employee Work Assignment */
    Route::get('/employeeidentifications/getlist', [EmployeeIdentificationController::class, 'getlist'])->name('employeeidentifications.getlist');
    Route::get('/employeeidentifications/getcolumns', [EmployeeIdentificationController::class, 'getcolumns'])->name('employeeidentifications.getcolumns');
    Route::get('/employeeidentifications/search', [EmployeeIdentificationController::class, 'searchData'])->name('employeeidentifications.search');

    /* Employee Work Schedule */
    Route::get('/employeeworkschedule/getlist', [EmployeeWorkScheduleController::class, 'getlist'])->name('employeeworkschedule.getlist');
    Route::get('/employeeworkschedule/getDivisions', [EmployeeWorkScheduleController::class, 'getDivisions'])->name('employeeworkschedule.getDivisions');
    Route::get('/employeeworkschedule/getDept', [EmployeeWorkScheduleController::class, 'getDept'])->name('employeeworkschedule.getDept');
    Route::get('/employeeworkschedule/getSubDept', [EmployeeWorkScheduleController::class, 'getSubDept'])->name('employeeworkschedule.getSubDept');
    Route::get('/employeeworkschedule/getSubDeptUnit', [EmployeeWorkScheduleController::class, 'getSubDeptUnit'])->name('employeeworkschedule.getSubDeptUnit');
    Route::get('/employeeworkschedule/getWorkShifts', [EmployeeWorkScheduleController::class, 'getWorkShifts'])->name('employeeworkschedule.getWorkShifts');

    /* Gender */
    Route::get('/genders/getlist', [GenderController::class, 'getlist'])->name('genders.getlist');
    Route::get('/genders/getcolumns', [GenderController::class, 'getcolumns'])->name('genders.getcolumns');
    Route::get('/genders/search', [GenderController::class, 'searchData'])->name('genders.search');

    /* Doctor */
    Route::get('/doctors/getlist', [DoctorController::class, 'getlist'])->name('doctors.getlist');
    Route::get('/doctors/getcolumns', [DoctorController::class, 'getcolumns'])->name('doctors.getcolumns');
    Route::get('/doctors/search', [DoctorController::class, 'searchData'])->name('doctors.search');

    /* Salary Grade */
    Route::get('/salarygrades/getlist', [SalaryGradeController::class, 'getlist'])->name('salarygrades.getlist');
    Route::get('/salarygrades/getcolumns', [SalaryGradeController::class, 'getcolumns'])->name('salarygrades.getcolumns');
    Route::get('/salarygrades/search', [SalaryGradeController::class, 'searchData'])->name('salarygrades.search');

    /* Salary Standardization*/
    Route::get('/salarystandardizations/getlist', [SalaryStandardizationController::class, 'getlist'])->name('salarystandardizations.getlist');
    Route::get('/salarystandardizations/getcolumns', [SalaryStandardizationController::class, 'getcolumns'])->name('salarystandardizations.getcolumns');
    Route::get('/salarystandardizations/search', [SalaryStandardizationController::class, 'searchData'])->name('salarystandardizations.search');

    /* Salary Grade Detail*/
    Route::get('/salarygradedetails/getlist', [SalaryGradeDetailController::class, 'getlist'])->name('salarygradedetails.getlist');
    Route::get('/salarygradedetails/getcolumns', [SalaryGradeDetailController::class, 'getcolumns'])->name('salarygradedetails.getcolumns');
    Route::get('/salarygradedetails/search', [SalaryGradeDetailController::class, 'searchData'])->name('salarygradedetails.search');

    Route::get('/employees/{managevalue}/{empid?}', [EmployeeController::class, 'getEmployeeMain'])->name('employeemanage');

    /* PRF APPROVER SETTINGS */
    Route::get('/prfapproversettings/getlist', [PrfApproverSettingController::class, 'getlist'])->name('prfapproversettings.getlist');
    Route::get('/prfapproversettings/getcolumns', [PrfApproverSettingController::class, 'getcolumns'])->name('prfapproversettings.getcolumns');
    Route::get('/prfapproversettings/search', [PrfApproverSettingController::class, 'searchData'])->name('prfapproversettings.search');

    /* THEME COLOR SETTINGS */

    Route::get('/themecolorsettings/getlist', [ThemeColorSettingController::class, 'getlist'])->name('themecolorsettings.getlist');
    Route::get('/themecolorsettings/getcolumns', [ThemeColorSettingController::class, 'getcolumns'])->name('themecolorsettings.getcolumns');
    Route::get('/themecolorsettings/search', [ThemeColorSettingController::class, 'searchData'])->name('themecolorsettings.search');
    Route::get('/themecolorsettings/getThemeColorSelected', [ThemeColorSettingController::class, 'getThemeColorSelected'])->name('getThemeColorSelected');


    /* Training */
    Route::get('/trainings/getlist', [TrainingController::class, 'getlist'])->name('trainings.getlist');
    Route::get('/trainings/getcolumns', [TrainingController::class, 'getcolumns'])->name('trainings.getcolumns');
    Route::get('/trainings/search', [TrainingController::class, 'searchData'])->name('trainings.search');

    /* Training */
    Route::get('/trainingcategories/getlist', [TrainingCategoryController::class, 'getlist'])->name('trainingcategories.getlist');
    Route::get('/trainingcategories/getcolumns', [TrainingCategoryController::class, 'getcolumns'])->name('trainingcategories.getcolumns');
    Route::get('/trainingcategories/search', [TrainingCategoryController::class, 'searchData'])->name('trainingcategories.search');



    Route::get('/getmodelnames', function () {
        $path = app_path('Models') . '/*.php';
        return collect(glob($path))->map(fn($file) => basename($file, '.php'))->toArray();
    });

    Route::get('/systemtablesmain', function () {
        return Inertia::render('SystemAdministration/SystemTablesMain');
    })->name('systemtablesmain');

    /* Route::get('/get-permissions', function () {
    return auth()->check()?auth()->user()->jsPermissions():0;
}); */
    /* SAMPLE */


    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::get('/getCalendarinMonths', [CalendarController::class, 'getCalendarinMonths'])->name('calendar.getCalendarinMonths');

    Route::get('/clockentries', [ClockEntriesController::class, 'index'])->name('clockentries.index');
    Route::get('/clockentriesall', [ClockEntriesController::class, 'getAllClockEntires'])->name('clockentries.getAllClockEntires');
    Route::get('/clockentriesbyuserid', [ClockEntriesController::class, 'getClockEntriesByUserID'])->name('clockentries.getClockEntriesByUserID');
    Route::get('/getlist', [CalendarController::class, 'getlist'])->name('getlist');

    Route::get('/systemsettings', [SystemSettingsController::class, 'index'])->name('systemsettings.index');
    Route::get('/generalsettings', [SystemSettingsController::class, 'generalsettingsindex'])->name('generalsettings');
    Route::get('/themesettings', [SystemSettingsController::class, 'generalsettingsindex'])->name('themesettings');

    Route::get('/Handbook', [EmployeeHandBookController::class, 'index']);


    Route::get('/employeemain', function () {
        return Inertia::render('Employee/EmployeeMain');
    });

    /* RESOURCES */
    Route::resources([
        'systemtables' => SystemTableController::class,
        'systemtablesmigrated' => SystemTableMigratedController::class,
        'systemtabledetails' => SystemTableDetailsController::class,
        'countries' => CountriesController::class,
        'regions' => RegionsController::class,
        'formtypes' => FormTypeController::class,
        'permissions' => PermissionController::class,
        'roles' => RoleController::class,
        'provinces' => ProvinceController::class,
        'cities' => CityController::class,
        'joblevels' => JobLevelController::class,
        'divisions' => DivisionController::class,
        'departments' => DepartmentController::class,
        'subdepartments' => SubDepartmentController::class,
        'jobpositions' => JobPositionController::class,
        'subdepartmentunits' => SubDepartmentUnitController::class,
        'occupations' => OccupationController::class,
        'leavetypes' => LeaveTypeController::class,
        'proficiencies' => ProficiencyController::class,
        'coursecategories' => CourseCategoryController::class,
        'skills' => SkillController::class,
        'educations' => EducationController::class,
        'educationlevels' => EducationLevelController::class,
        'employeetypes' => EmployeeTypeController::class,
        'courses' => CourseController::class,
        'languages' => LanguageController::class,
        'disciplinaryactions' => DisciplinaryActionController::class,
        'eventtypes' => EventTypeController::class,
        'holidaytypes' => HolidayTypeController::class,
        'holidays' => HolidayController::class,
        'schools' => SchoolController::class,
        'educationlevelschools' => EducationLevelSchoolController::class,
        'workshifts' => WorkShiftController::class,
        'islandgroups' => IslandGroupController::class,
        'relationships' => RelationshipController::class,
        'applicationsources' => ApplicationSourceController::class,
        'allowances' => AllowanceController::class,
        'earnings' => EarningController::class,
        'specializations' => SpecializationController::class,
        'subspecializations' => SubSpecializationController::class,
        'doctorcategories' => DoctorCategoryController::class,
        'prfreasonforreqs' => PrfReasonForReqController::class,
        'autogeneratecodes' => AutoGenerateCodeController::class,
        'personnelrequisitions' => PersonnelRequisitionController::class,
        'applicants' => ApplicantController::class,
        'calendar' => CalendarController::class,
        'orgchart' => CalendarController::class,
        'employeehandbook' => EmployeeHandBookController::class,
        'employeehandbooks' => EmployeeHandbookHrController::class,
        'prfstatus' => PrfStatusController::class,
        'jobtitlecategories' => JobTitleCategoryController::class,
        'jobtitles' => JobTitleController::class,
        'applicationstatuses' => ApplicationStatusController::class,
        'recruitmentdashboard' => RecruitmentDashboardController::class,
        'interviewmethods' => InterviewMethodController::class,
        'employmenttypes' => EmploymentTypeController::class,
        'offensecategories' => OffenseCategoryController::class,
        'offenseseverities' => OffenseSeverityController::class,
        'offenses' => OffenseController::class,
        'offensedetails' => OffenseDetailController::class,
        'codeofdisciplines' => CodeOfDisciplineController::class,
        'offensesclassifications' => OffensesClassificationController::class,
        'worklocations' => WorkLocationController::class,
        'dayshifts' => DayShiftController::class,
        'identificationtypes' => IdentificationTypeController::class,
        'employees' => EmployeeController::class,
        'employeestatuses' => EmployeeStatusController::class,
        'personnelrequisitionsettings' => PersonnelRequisitionSettingController::class,
        'employeeeducation' => EmployeeEducationController::class,
        'bloodtypes' => BloodTypeController::class,
        'religions' => ReligionController::class,
        'civilstatuses' => CivilStatusController::class,
        'nationalities' => NationalityController::class,
        'suffixes' => SuffixController::class,
        'employeeemploymenthistories' => EmployeeEmploymentHistoryController::class,
        'employeeemploymentdetails' => EmployeeEmploymentDetailController::class,
        'employeefamilybackgrounds' => EmployeeFamilyBackgroundController::class,
        'employeedependents' => EmployeeDependentController::class,
        'employeedisciplinaryactions' => EmployeeDisciplinaryActionController::class,
        'employeeworkassignments' => EmployeeWorkAssignmentController::class,
        'employeeidentifications' => EmployeeIdentificationController::class,
        'genders' => GenderController::class,
        'doctors' => DoctorController::class,
        'salarygrades' => SalaryGradeController::class,
        'salarystandardizations' => SalaryStandardizationController::class,
        'salarygradedetails' => SalaryGradeDetailController::class,
        'careers' => CareerController::class,
        'prfapproversettings' => PrfApproverSettingController::class,
        'themecolorsettings' => ThemeColorSettingController::class,
        'onboardingchecklists' => OnboardingChecklistController::class,
        'employeeworkschedule' => EmployeeWorkScheduleController::class,
        'shiftsetup' => ShiftSetupController::class,
        'trainings' => TrainingController::class,
        'trainingcategories' => TrainingCategoryController::class,
        'requesttimeoff' => RequestTimeOffController::class,
    ]);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
