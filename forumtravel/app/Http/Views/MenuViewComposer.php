<?php
namespace App\Http\Views;
use App\Models\Module;

class MenuViewComposer {
  
  private $module;

  public function __construct(Module $module)
  {
    $this->module = $module;
  }

  public function compose($view)
  {
    $user = auth()->user();

    $modulesFiltered = session()->get('modules') ? session()->get('modules') : [];

    if (!$modulesFiltered) {

        if ($user->isAdmin()) {

          $modulesFiltered = ($this->getModules($user->role->modules))->toArray();

        } else {

          $modules = $this->getModules($user->role->modules());
                                            
          foreach ($modules as $key => $module) {
            $modulesFiltered[$key]['name'] = $module->name;
    
            foreach ($module->resources as $k => $resource) {
              if ($resource->roles->contains($user->role)) {
                $modulesFiltered[$key]['resources'][$k]['name'] = $resource->name;
                $modulesFiltered[$key]['resources'][$k]['resource'] = $resource->resource;
              }
            }
          }
        }
      
      session()->get('modules', $modulesFiltered);
    }

    return $view->with('modules', $modulesFiltered);
  }

  public function getModules($module)
  {
      return Module::with(['resources' => function($queryBuilder){
          return $queryBuilder->where('is_menu', true);
      }])->get();
  }
  
}