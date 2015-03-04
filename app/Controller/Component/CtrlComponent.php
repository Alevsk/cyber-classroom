<?php

class CtrlComponent extends Component {
    public function get() {
        $aCtrlClasses = App::objects('controller');
        foreach ($aCtrlClasses as $controller) {
            if ($controller != 'AppController') {
                // Load the controller
                App::import('Controller', str_replace('Controller', '', $controller));
 
                // Load its methods / actions
                $aMethods = get_class_methods($controller);
 
                foreach ($aMethods as $idx => $method) {
 
                    if ($method{0} == '_') {
                        unset($aMethods[$idx]);
                    }
                }

                App::import('Controller', 'AppController');
                $parentActions = get_class_methods('AppController');
 
                $controllers[str_replace('Controller', '', $controller)] = array_diff($aMethods, $parentActions);
            }
        }
        return $controllers;
    }
}