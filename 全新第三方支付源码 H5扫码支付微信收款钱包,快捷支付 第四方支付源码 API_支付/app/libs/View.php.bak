<?php
namespace WY\app\libs;

if (!defined('WY_ROOT')) {
    exit;
}
class View
{
    public $params = array();
    public $tpl;
    public function assign($data)
    {
        $this->params = $data;
    }
    public function put($file, $data = array())
    {
        if ($data) {
            extract($data);
        }
        if (!file_exists($this->tpl . $file)) {
            $file = 'woodyapp.php';
        }
        require_once $this->tpl . $file;
        $content = ob_get_contents();
        ob_get_clean();
        echo $content;
        if (ob_get_level()) {
            ob_end_flush();
        }
    }
}
?>