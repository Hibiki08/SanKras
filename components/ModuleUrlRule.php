<?php
namespace app\components;

use Yii;
use yii\web\UrlRule;

class ModuleUrlRule extends UrlRule {

    public $appModules;
    public $params;

    public function init() {
        if ($this->name === null) $this->name = __CLASS__;
    }

    public function createUrl($manager, $route, $params) {
        if ($route == 'site/index') {
            return '';
        }

        $link = '';

        $this->getParams($params);

      if (count($params) > 0) {
              $link = '/';
              foreach ($params as $key => $value) {
                  $link .= $value . '/';
              }

          $link = substr($link, 0, -1);
      }
        return $route . $link;
    }

    public function getParams($params) {
        return $this->params = $params;
    }

    public function parseRequest($manager, $request) {
        $url = explode('/', $request->getPathInfo());
        $params = [];
        $pathToController = '';
        $route = '';

        $module =  !empty($url[1]) ?  $url[1] :  $url[0];
        $exploadModule = explode('-', $module);
        $controller = [];

        if (count($exploadModule) > 1) {
            foreach ($exploadModule as $val) {
                $controller[] = ucfirst($val);
            }
        } else {
            $controller = $exploadModule;
        }

        $controller = implode('', $controller);

        if (in_array($url[0], $this->appModules)) {
            $pathToController = Yii::$app->basePath . '/modules/' . $url[0] . '/controllers';

            if (file_exists($pathToController . '/' .  $controller . 'Controller.php')) {

                if (count($url) <= 2) {
                    if (empty($url[2])) {
                        $route = $url[0] . '/' . $module . '/index';
                    }
                } elseif (count($url) == 3) {
                    if (empty($url[2])) {
                        $route = $url[0] . '/' . $module . '/index';
                    } else {
                        $route = $url[0] . '/' . $module . '/' . $url[2];
                    }
                } elseif (count($url) == 4) {
                    $route = $url[0] . '/' . $module . '/' . $url[2];
                    if ($url[2] == 'edit') {
                        $params['id'] = $url[3];
                    } else {
                        $params['page'] = $url[3];
                    }
                }
            }
        } else {
            if (count($url) > 0) {
                $pathToController = Yii::$app->basePath . '/controllers/' . $controller . 'Controller.php';
                if (count($url) == 1) {
                    if (file_exists($pathToController)) {
                        $route = $url[0] . '/index';
                    } else {
                        $route = 'site/' . $url[0];
                    }
                } elseif (count($url) == 2) {
                    $controller = Yii::$app->createControllerByID($url[0]); //есть ли такой controller
                    $action = !is_null($controller) ? $controller->createAction($url[1]) : null; //есть ли такой action

                    if (!is_null($action)) {
                        $route = $url[0] . '/' . $url[1];
                    } else {
                        if ($url[0] == 'works') {
                            $params['group'] = $url[1];
                            $route = $url[0] . '/index';
                        } else {
                            if ($url[0] != 'prices' && $url[0] != 'works' && $url[0] != 'about' && $url[0] != 'contacts') {
                                $route = $url[0] . '/index';
                                $params['key'] = $url[1];
                            } else {
                                return false;
                            }
                        }
                    }
                }
                elseif (count($url) == 3) {
                    if ($url[0] == 'works' && $url[1] == 'single') {
                        $params['id'] = $url[2];
                        $route = $url[0] . '/' . $url[1];
                    }
                    elseif ($url[0] == 'about' && ($url[1] == 'news' || $url[1] == 'articles')) {
                        $params['id'] = $url[2];
                        $route = $url[0] . '/' . $url[1];
                    }
                }
                else {
                    return false;
                }
            } else {
                $route = 'site/index';
            }
        }
//                var_dump($route);die;
        return [$route, $params];
    }
}