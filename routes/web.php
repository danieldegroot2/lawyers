<?php

use Illuminate\Support\Facades\Route;
use App\Models\System\RouteBilder;
use App\Models\CoreEngine\Model\SystemSite;
use App\Models\System\General\SiteConfig;
use App\Models\System\General\Site;
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




Route::any('/system/import/chunk', [App\Http\TaskSystem\ControllerTaskSystem::class, 'importChartForecastData'])->name('importChart');
Route::any('/system/import/price', [App\Http\TaskSystem\ControllerTaskSystem::class, 'importPrice'])->name('cron_price');
Route::any('/install', function() {
    $check = Schema::hasTable((new SystemSite())->getTable());
    if (!$check) {
        $result = Artisan::call('migrate');
        $conf = new SiteConfig();
        $conf->setConfig(['migration'=>true]);
        return view('/install');
    } else {
        redirect("/");
    }

})->name("install");

$publicRout = new RouteBilder();
foreach ($publicRout->build() as $controller_name => $controller){
    foreach ($controller as $action){
       try {
           Route::any($action['url'], $action['pathController'])->name($action['name']);
       } catch (Throwable $e ) {
           dd("error",$action);
       }
    }
}
Route::any('/{file?}', function(\Illuminate\Http\Request $r){
    if(isset($r->segments()[0])) {
        $dir = public_path("sitemap_") . "/" . Site::getSite()['domain_name'] . '/' . 'sitemap/' . $r->segments()[0];
        if (file_exists($dir))
            return response()->file($dir);
        else
            abort(404);
    }
})->where('file','(.*?)\.(xml)$')->name('sitemap');