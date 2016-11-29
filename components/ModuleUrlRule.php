<?php
namespace app\components;

use Yii;
use yii\web\UrlRule;

class ModuleUrlRule extends UrlRule {

    public $appModules;

    public function init() {
        if ($this->name === null) $this->name = __CLASS__;
    }

    public function createUrl($manager, $route, $params) {
        if ($route == 'site/index') {
            return '';
        }
        $link = '';
      if (count($params) > 0) {
          $link = '?';
          foreach ($params as $key => $value)
          {
              if (is_array($value)) {
                  continue;
              }
                  $link .= $key . '=' . $value . '&';

          }
          $link = substr($link, 0, -1);
      }
        return $route . $link;
    }

    public function parseRequest($manager, $request) {
        $url = explode('/', $request->getPathInfo());
        $params = [];
        $pathToController = '';
        $route = '';
        if (in_array($url[0], $this->appModules)) {
            $pathToController = Yii::$app->basePath . '/modules/' . $url[0] . '/controllers';
            $module =  !empty($url[1]) ?  $url[1] :  $url[0];

            if (file_exists($pathToController . '/' .  ucfirst($module) . 'Controller.php')) {
                if (count($url) == 3) {
                    if (empty($url[2])) {
                        $route = $url[0] . '/' . $module . '/index';
                    } else {
                        $route = $url[0] . '/' . $module . '/' . $url[2];
                    }
                }

                if (count($url) <= 2) {
                    if (empty($url[2])) {
                        $route = $url[0] . '/' .$module . '/index';
                    }
                }
            } else {
                return false;
            }
        } else {
            if (count($url) > 0) {
                $pathToController = Yii::$app->basePath . '/controllers/' . ucfirst($url[0]) . 'Controller.php';
                if (count($url) == 1) {
                    if (file_exists($pathToController)) {
                        $route = $url[0] . '/index';
                    } else {
                        $route = 'site/' . $url[0];
                    }
                } elseif (count($url) == 2) {
                    $route = $url[0] . '/' . $url[1];
                }
//                elseif (count($url) == 3) {
//                    $route = $url[0] . '/' . $url[2];
//                }
                else {
                    return false;
                }
            } else {
                $route = 'site/index';
            }
        }
        return [$route, $params];
    }
}