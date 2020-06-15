<?php
if (!defined('CORE')) {
    exit('Request Error!');
}
class common
{
    public $intCurrentUid = 0;
    public $ct = 'index';
    public $ac = 'index';
    public $dosubmit = '';
    public $refer = '';
    public $table = '';
    public $listPage = 'index';
    public $defaultPage = 'index';
    protected $_updateCache = array();
    function __construct()
    {
        preg_match('/[\\w][\\w-]*\\.(?:com\\.cn|com|cn|co|net|org|gov|cc|biz|info|top|xin)/isU', URL, $domain);
        $this->ct = req::$forms['ct'];
        $this->ac = req::$forms['ac'];
        tpl::assign('ct', $this->ct);
        tpl::assign('ac', $this->ac);
        $this->dosubmit = request('dosubmit');
        $this->refer = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '?ct=' . $this->ct . '&ac=index';
        if (!file_exists(PATH_ROOT . '/templates/template/admin/' . $this->ct . '.' . $this->ac . '.tpl') && file_exists(PATH_ROOT . '/templates/template/admin/__common.' . $this->ac . '.tpl')) {
        }
    }
    public function index()
    {
        $where = '';
        $where_arr = array();
        $config['url_prefix'] = '?ct=' . $this->ct . '&ac=' . $this->ac;
        foreach ($this->_dbfield as $k => $v) {
            if (isset($v['search']) && $v['search'] == 1) {
                $temp = '';
                $temp = 'search' . $k;
                $temp = req::item($k, '');
                tpl::assign('search' . $k, $temp);
                if (!empty($temp)) {
                    if (isset($v['search_extend']) && $v['search_extend'] == 'like') {
                        $where_arr[] = '`' . $k . "` like '%" . $temp . "%'";
                    } elseif (isset($v['search_extend']) && $v['search_extend']['direct']) {
                        $where_arr[] = '`' . $k . '`' . $v['search_extend']['direct'] . "'" . $temp . "'";
                    } else {
                        $where_arr[] = '`' . $k . "` = '" . $temp . "'";
                    }
                    $config['url_prefix'] .= '&' . $k . '=' . $temp;
                }
            }
        }
        if (!empty($where_arr)) {
            $where = ' where ' . implode(' and ', $where_arr);
        }
        $size = $config['page_size'] = 16;
        $config['current_page'] = req::item('page_no');
        empty($config['current_page']) && ($config['current_page'] = 1);
        tpl::assign('current_page', $config['current_page']);
        $sql1 = 'SELECT count(' . $this->_dbfield['mainKey'] . ') as total FROM `' . $this->table . '`' . $where;
        $rsid = db::fetch_one(db::query($sql1));
        $config['total_rs'] = $rsid['total'];
        $pages = util::pagination($config);
        tpl::assign('pages', $pages);
        $offset = ($config['current_page'] - 1) * $size;
        $sql2 = 'SELECT * FROM `' . $this->table . '`' . $where . ' order by ' . $this->_dbfield['mainKey'] . " desc LIMIT {$offset},{$size}";
        $query = db::query($sql2);
        $rows = db::fetch_all($query);
        tpl::assign('data_list', $rows);
        if (file_exists(PATH_ROOT . '/templates/template/admin/' . $this->ct . '.' . $this->ac . '.tpl')) {
            tpl::display($this->ct . '.' . $this->ac . '.tpl');
        } else {
            exit('no tpl file');
        }
    }
    public function add()
    {
        if (request('dosubmit', '')) {
            $info = req::$posts;
            if (isset($this->_submit_validate) && $this->_submit_validate) {
                foreach ($this->_submit_validate as $field => $vali) {
                    if (!isset($info[$field]) || empty($info[$field])) {
                        if (($vali['3'] == 'all' || $vali['3'] == 'insert') && $vali['1'] == 'notempty') {
                            cls_msgbox::show('系统提示', $vali['2'] ? $vali['2'] : $this->_dbfield['allTableField'][$field] . '必须!', -1);
                            exit;
                        }
                    } else {
                    }
                }
            }
            if (isset($this->_db_validate) && $this->_db_validate) {
                foreach ($this->_db_validate as $field => $vali) {
                    if (isset($info[$field]) && !empty($info[$field])) {
                        if (($vali['3'] == 'all' || $vali['3'] == 'insert') && $vali['1'] == 'unique') {
                            $arrTempData = array();
                            if (isset($vali['extend']) && $vali['extend']) {
                                $arrtempWhere = array();
                                $arrtempWhere[] = '`' . $field . '`="' . $info[$field] . '"';
                                foreach ($vali['extend'] as $extendField) {
                                    if (isset($info[$extendField])) {
                                        $arrtempWhere[] = '`' . $extendField . '`="' . $info[$extendField] . '"';
                                    }
                                }
                                $strTempwhere = '';
                                if (!empty($arrtempWhere)) {
                                    $strTempwhere = ' where ' . implode(' and ', $arrtempWhere);
                                }
                                if ($strTempwhere) {
                                    $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` ' . $strTempwhere . ' limit 1');
                                }
                            } else {
                                $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` where `' . $field . '`="' . $info[$field] . '" limit 1');
                            }
                            if ($arrTempData) {
                                cls_msgbox::show('系统提示', $vali['2'], -1);
                                exit;
                            }
                        }
                    }
                }
            }
            if (isset($this->_auto) && $this->_auto) {
                foreach ($this->_auto as $field => $vali) {
                    if (!isset($info[$field]) || empty($info[$field])) {
                        if ($vali['3'] == 'all' || $vali['3'] == 'insert') {
                            if ($vali['1'] == 'value' && isset($vali['2'])) {
                                $info[$field] = $vali['2'];
                            } elseif ($vali['1'] == 'function' && isset($vali['2'])) {
                                $info[$field] = $vali['2'];
                            }
                        }
                    }
                }
            }
            $insertid = db::ins($this->table, $info);
            if ($insertid) {
                if (isset($this->_uploadFile) && $this->_uploadFile) {
                    foreach ($this->_uploadFile as $field => $arrItem) {
                        if (isset(req::$files[$field]['tmp_name']) && !empty(req::$files[$field]['tmp_name'])) {
                            $info[$field] = $this->update_image(req::$files[$field], $arrItem, $field, $insertid);
                            if ($info[$field] && is_numeric($insertid) && $insertid > 0) {
                                db::query('update ' . $this->table . ' set `' . $field . '`="' . $info[$field] . '" where `' . $this->_dbfield['mainKey'] . '`=' . $insertid . ' limit 1');
                            }
                        }
                    }
                }
                if (isset($this->_updateCache) && !empty($this->_updateCache)) {
                    foreach ($this->_updateCache as $arrItem) {
                        if (isset($arrItem['prefix']) && isset($arrItem['key']) && !empty($arrItem['key'])) {
                            $strCacehKeyTemp = '';
                            foreach ($info as $strField => $strFieldValue) {
                                $strCacehKeyTemp = str_ireplace('{{' . $strField . '}}', $strFieldValue, $arrItem['key']);
                            }
                            if ($strCacehKeyTemp) {
                                cache::del($arrItem['prefix'], $strCacehKeyTemp);
                                cache::set($arrItem['prefix'], $strCacehKeyTemp, null);
                            }
                        }
                    }
                }
                cls_msgbox::show('系统提示', '添加成功!', '?ct=' . $this->ct . '&ac=' . $this->listPage);
            }
        } else {
            if (isset($this->_addFieldAuto) && $this->_addFieldAuto) {
                $arrAddFieldAuto = array();
                foreach ($this->_addFieldAuto as $field => $vali) {
                    if (req::$forms[$field]) {
                        $arrAddFieldAuto[$field] = req::$forms[$field];
                    }
                }
                tpl::assign('arrAddFieldAuto', $arrAddFieldAuto);
            }
        }
        if (file_exists(PATH_ROOT . '/templates/template/admin/' . $this->ct . '.' . $this->ac . '.tpl')) {
            tpl::display($this->ct . '.' . $this->ac . '.tpl');
        } else {
            exit('no tpl file');
        }
    }
    public function edit()
    {
        $id = request($this->_dbfield['mainKey'], '') ? request($this->_dbfield['mainKey'], '') : cls_msgbox::show('系统提示', '缺少id！', -1);
        if (request('dosubmit', '')) {
            $info = req::$posts;
            if ($info['shorttxt'] == '') {
                $info['shorttxt'] = strip_tags($info['content']);
                $info['shorttxt'] = mb_substr($info['shorttxt'], 0, 160, 'utf-8');
            }
            if (isset($this->_submit_validate) && $this->_submit_validate) {
                foreach ($this->_submit_validate as $field => $vali) {
                    if (!isset($info[$field]) || empty($info[$field])) {
                        if (($vali['3'] == 'all' || $vali['3'] == 'update') && $vali['1'] == 'notempty') {
                            cls_msgbox::show('系统提示', $vali['2'] ? $vali['2'] : $this->_dbfield['allTableField'][$field] . '必须!', -1);
                            exit;
                        }
                    } else {
                    }
                }
            }
            if (isset($this->_db_validate) && $this->_db_validate) {
                foreach ($this->_db_validate as $field => $vali) {
                    if (isset($info[$field]) && !empty($info[$field])) {
                        if (($vali['3'] == 'all' || $vali['3'] == 'update') && $vali['1'] == 'unique') {
                            $arrTempData = array();
                            if (isset($vali['extend']) && $vali['extend']) {
                                $arrtempWhere = array();
                                $arrtempWhere[] = '`' . $field . '`="' . $info[$field] . '"';
                                foreach ($vali['extend'] as $extendField) {
                                    if (isset($info[$extendField])) {
                                        $arrtempWhere[] = '`' . $extendField . '`="' . $info[$extendField] . '"';
                                    }
                                }
                                $strTempwhere = '';
                                if (!empty($arrtempWhere)) {
                                    $strTempwhere = ' where ' . implode(' and ', $arrtempWhere);
                                    if (in_array($this->ac, array('edit', 'batch_update'))) {
                                        $strTempwhere .= ' and `' . $this->_dbfield['mainKey'] . '`!="' . $info[$this->_dbfield['mainKey']] . '"';
                                    }
                                }
                                if ($strTempwhere) {
                                    $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` ' . $strTempwhere . ' limit 1');
                                }
                            } else {
                                if (in_array($this->ac, array('edit', 'batch_update'))) {
                                    $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` where `' . $field . '`="' . $info[$field] . '" and `' . $this->_dbfield['mainKey'] . '`!="' . $info[$this->_dbfield['mainKey']] . '" limit 1');
                                } else {
                                    $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` where `' . $field . '`="' . $info[$field] . '" limit 1');
                                }
                            }
                            if ($arrTempData) {
                                cls_msgbox::show('系统提示', $vali['2'], -1);
                                exit;
                            }
                        }
                    }
                }
            }
            if (isset($this->_auto) && $this->_auto) {
                foreach ($this->_auto as $field => $vali) {
                    if (!isset($info[$field]) || empty($info[$field])) {
                        if ($vali['3'] == 'all' || $vali['3'] == 'update') {
                            if ($vali['1'] == 'value' && isset($vali['2'])) {
                                $info[$field] = $vali['2'];
                            } elseif ($vali['1'] == 'function' && isset($vali['2'])) {
                                $info[$field] = $vali['2'];
                            }
                        }
                    }
                }
            }
            $data['content'] = str_replace(PHP_EOL, '', $data['content']);
            $data['content'] = str_replace(array('
', '
', '
'), '', $data['content']);
            if (isset($this->_uploadFile) && $this->_uploadFile) {
                foreach ($this->_uploadFile as $field => $arrItem) {
                    if (isset(req::$files[$field]['tmp_name']) && !empty(req::$files[$field]['tmp_name'])) {
                        $info[$field] = $this->update_image(req::$files[$field], $arrItem, $field, $info[$this->_dbfield['mainKey']]);
                    }
                }
            }
            $where_arr[] = '`' . $this->_dbfield['mainKey'] . "`='{$info[$this->_dbfield['mainKey']]}'";
            $result = false;
            if ($info && $where_arr) {
                $result = db::update($this->table, $info, $where_arr);
            }
            if ($result) {
                if (isset($this->_updateCache) && !empty($this->_updateCache)) {
                    foreach ($this->_updateCache as $arrItem) {
                        if (isset($arrItem['prefix']) && isset($arrItem['key']) && !empty($arrItem['key'])) {
                            $strCacehKeyTemp = '';
                            foreach ($info as $strField => $strFieldValue) {
                                $strCacehKeyTemp = str_ireplace('{{' . $strField . '}}', $strFieldValue, $arrItem['key']);
                            }
                            if ($strCacehKeyTemp) {
                                cache::del($arrItem['prefix'], $strCacehKeyTemp);
                                cache::set($arrItem['prefix'], $strCacehKeyTemp, null);
                            }
                        }
                    }
                }
                cls_msgbox::show('系统提示', '成功修改 id 为:' . $info[$this->_dbfield['mainKey']] . '的信息！', '?ct=' . $this->ct . '&ac=' . $this->listPage);
            } else {
                cls_msgbox::show('系统提示', '没有检测到修改的更新信息！', -1);
            }
        } else {
            $sql = "SELECT * FROM `{$this->table}` WHERE `" . $this->_dbfield['mainKey'] . "`='{$id}' LIMIT 1";
            $data = db::get_one($sql);
            $data['content'] = str_replace(PHP_EOL, '', $data['content']);
            $data['content'] = str_replace(array('
', '
', '
'), '', $data['content']);
            tpl::assign('data', $data);
            if (file_exists(PATH_ROOT . '/templates/template/admin/' . $this->ct . '.' . $this->ac . '.tpl')) {
                tpl::display($this->ct . '.' . $this->ac . '.tpl');
            } else {
                exit('no tpl file');
            }
        }
    }
    public function delete()
    {
        $id = (int) req::item($this->_dbfield['mainKey'], 0);
        if ($id && $this->table) {
            $info = db::get_one('select * from `' . $this->table . '` where `' . $this->_dbfield['mainKey'] . '`=' . $id . ' limit 1');
            $r = db::query('delete from `' . $this->table . '` where `' . $this->_dbfield['mainKey'] . '`=' . $id . ' limit 1');
            if ($r) {
                if (isset($this->_updateCache) && !empty($this->_updateCache)) {
                    foreach ($this->_updateCache as $arrItem) {
                        if (isset($arrItem['prefix']) && isset($arrItem['key']) && !empty($arrItem['key'])) {
                            $strCacehKeyTemp = '';
                            foreach ($info as $strField => $strFieldValue) {
                                $strCacehKeyTemp = str_ireplace('{{' . $strField . '}}', $info[$strField], $arrItem['key']);
                            }
                            if ($strCacehKeyTemp) {
                                cache::del($arrItem['prefix'], $strCacehKeyTemp);
                            }
                            if (OPEN_DEBUG) {
                                file_put_contents(PATH_ROOT . '/admin.txt', 'cache::del :' . $arrItem['prefix'] . ',' . $strCacehKeyTemp, FILE_APPEND);
                            }
                        }
                    }
                }
                $arrDeleteFileFields = $arrDeleteExtendTables = array();
                if (isset($this->_dbfield['batchDeleteTableField']['extend']) && $this->_dbfield['batchDeleteTableField']['extend']) {
                    foreach ($this->_dbfield['batchDeleteTableField']['extend'] as $k => $v) {
                        if ($k == 'delete_file' && !$v) {
                            $arrDeleteFileFields = $v;
                        }
                        if ($k == 'delete_extend_table' && !$v) {
                            $arrDeleteExtendTables = $v;
                        }
                    }
                }
                if ($arrDeleteFileFields) {
                    foreach ($arrDeleteFileFields as $strFileField) {
                        if (isset($info[$strFileField]) && $info[$strFileField]) {
                            @unlink(PATH_ROOT . $info[$strFileField]);
                            if (OPEN_DEBUG) {
                                file_put_contents(PATH_ROOT . '/admin.txt', 'unlink :' . PATH_ROOT . $info[$strFileField], FILE_APPEND);
                            }
                        }
                    }
                }
                cls_msgbox::show('系统提示', '删除成功！', '?ct=' . $this->ct . '&amp;ac=' . $this->listPage);
            } else {
                cls_msgbox::show('系统提示', '删除失败！', -1);
            }
        } else {
            cls_msgbox::show('系统提示', '参数错误！', -1);
        }
    }
    protected function debug($mixData)
    {
        echo '<!--';
        echo '<pre>';
        var_dump($mixData);
        file_put_contents(PATH_ROOT . '/debug.log', var_export($mixData, true) . '
', FILE_APPEND);
        echo '-->';
    }
    public function batch_update()
    {
        $ids = req::item('ids', '');
        if (empty($ids)) {
            cls_msgbox::show('对不起，出错了！', '你没有选择项目！', '-1');
        }
        $success = $failure = 0;
        $arrData = array();
        if (isset($this->_dbfield['batchUpdateTableField']) && $this->_dbfield['batchUpdateTableField']) {
            foreach ($this->_dbfield['batchUpdateTableField'] as $v) {
                $arrData[$v] = req::item($v, array());
            }
        } else {
            cls_msgbox::show('对不起，出错了！', '你没有授权批量修改的字段！', '-1');
            exit;
        }
        if (!$arrData) {
            cls_msgbox::show('对不起，出错了！', '你没有选择项目2！', '-1');
            exit;
        }
        foreach ($ids as $key => $id) {
            $strUpdateSql = '';
            $arrRow = array();
            foreach ($arrData as $field => $arrValues) {
                if ($arrValues && $arrValues[$key]) {
                    $arrRow[$field] = $arrValues[$key];
                    $arrtemp = array();
                }
            }
            foreach ($arrData as $field => $arrValues) {
                if ($arrRow) {
                    $arrRow[$this->_dbfield['mainKey']] = $id;
                    $arrtemp = array();
                    $arrtemp = $this->_autoHandle($arrRow, $field, 'update');
                    if ($arrtemp[$field]) {
                        $strUpdateSql .= '`' . $field . '`="' . $arrtemp[$field] . '",';
                    }
                } else {
                    $failure++;
                }
            }
            $strUpdateSql = trim($strUpdateSql, ',');
            if ($strUpdateSql && $id && $this->_dbfield['mainKey']) {
                $strUpdateSql = 'UPDATE `' . $this->table . '` SET ' . $strUpdateSql . ' where `' . $this->_dbfield['mainKey'] . '`=' . $id . ' limit 1';
                $result = db::query($strUpdateSql);
                if ($result >= 0) {
                    $success++;
                    if (isset($this->_updateCache) && !empty($this->_updateCache)) {
                        foreach ($this->_updateCache as $arrItem) {
                            if (isset($arrItem['prefix']) && isset($arrItem['key']) && !empty($arrItem['key'])) {
                                $strCacehKeyTemp = '';
                                foreach ($arrData as $field => $arrValues) {
                                    if ($arrValues && $arrValues[$key]) {
                                        $strCacehKeyTemp = str_ireplace('{{' . $field . '}}', $arrValues[$key], $arrItem['key']);
                                    }
                                }
                                if ($strCacehKeyTemp) {
                                    cache::del($arrItem['prefix'], $strCacehKeyTemp);
                                    cache::set($arrItem['prefix'], $strCacehKeyTemp, null);
                                }
                            }
                        }
                    }
                } else {
                    $failure++;
                }
            } else {
                $failure++;
            }
        }
        $referurl = empty($_SERVER['HTTP_REFERER']) ? '?ct=' . $this->ct . '&amp;ac=' . $this->listPage : $_SERVER['HTTP_REFERER'];
        cls_msgbox::show('成功了！', "成功修改：{$success}条，失败:{$failure}条！", $referurl);
    }
    public function batch_delete()
    {
        $ids = req::item('ids', '');
        if (empty($ids)) {
            cls_msgbox::show('对不起，出错了！', '你没有选择项目！', '-1');
        }
        if (!isset($this->_dbfield['batchDeleteTableField']) || empty($this->_dbfield['batchDeleteTableField']) || !$this->_dbfield['batchDeleteTableField']['mainKey']) {
            cls_msgbox::show('对不起，出错了！', '不允许该操作！', '-1');
        }
        $success = $failure = 0;
        $arrDeleteFileFields = $arrDeleteExtendTables = array();
        if (isset($this->_dbfield['batchDeleteTableField']['extend']) && $this->_dbfield['batchDeleteTableField']['extend']) {
            foreach ($this->_dbfield['batchDeleteTableField']['extend'] as $k => $v) {
                if ($k == 'delete_file' && $v) {
                    $arrDeleteFileFields = $v;
                }
                if ($k == 'delete_extend_table' && $v) {
                    $arrDeleteExtendTables = $v;
                }
            }
        }
        foreach ($ids as $key => $id) {
            if ($id && $this->_dbfield['mainKey']) {
                $arrTemp = array();
                $arrTemp = db::get_one('select * from `' . $this->table . '` where `' . $this->_dbfield['mainKey'] . '`=' . $id . ' limit 1');
                if (empty($arrTemp)) {
                    $failure++;
                    continue;
                }
                $strSql = '';
                $result = false;
                $strSql = 'delete from `' . $this->table . '` where `' . $this->_dbfield['mainKey'] . '`=' . $id . ' limit 1';
                $result = db::query($strSql);
                if ($result >= 0) {
                    $success++;
                    if ($arrDeleteFileFields) {
                        foreach ($arrDeleteFileFields as $strFileField) {
                            if (isset($arrTemp[$strFileField]) && $arrTemp[$strFileField]) {
                                @unlink(PATH_ROOT . $arrTemp[$strFileField]);
                                if (OPEN_DEBUG) {
                                    file_put_contents(PATH_ROOT . '/admin.txt', 'unlink :' . PATH_ROOT . $arrTemp[$strFileField], FILE_APPEND);
                                }
                            }
                        }
                    }
                    if (isset($this->_updateCache) && !empty($this->_updateCache)) {
                        foreach ($this->_updateCache as $arrItem) {
                            if (isset($arrItem['prefix']) && isset($arrItem['key']) && !empty($arrItem['key'])) {
                                $strCacehKeyTemp = '';
                                foreach ($arrTemp as $strField => $strFieldValue) {
                                    $strCacehKeyTemp = str_ireplace('{{' . $strField . '}}', $arrTemp[$strField], $arrItem['key']);
                                }
                                if ($strCacehKeyTemp) {
                                    cache::del($arrItem['prefix'], $strCacehKeyTemp);
                                    cache::set($arrItem['prefix'], $strCacehKeyTemp, null);
                                }
                            }
                        }
                    }
                } else {
                    $failure++;
                }
            } else {
                $failure++;
            }
        }
        $referurl = empty($_SERVER['HTTP_REFERER']) ? '?ct=' . $this->ct . '&amp;ac=' . $this->listPage : $_SERVER['HTTP_REFERER'];
        cls_msgbox::show('成功了！', "成功删除：{$success}条，失败:{$failure}条！", $referurl);
    }
    protected function _autoHandle($info, $field, $operation)
    {
        if ($info && !is_array($info)) {
            $info = array($field => $info);
        }
        if (isset($this->_submit_validate) && $this->_submit_validate) {
            foreach ($this->_submit_validate as $field => $vali) {
                if (in_array($this->ac, array('batch_update')) && !$this->_dbfield['batchUpdateTableField'][$field]) {
                    continue;
                }
                if (!isset($info[$field]) || empty($info[$field])) {
                    if (($vali['3'] == 'all' || $vali['3'] == $operation) && $vali['1'] == 'notempty') {
                        cls_msgbox::show('系统提示', ($vali['2'] ? $vali['2'] : $this->_dbfield['allTableField'][$field] . '必须!') . ' 当前值为:' . $info[$field], -1);
                        exit;
                    }
                } else {
                }
            }
        }
        if (isset($this->_db_validate) && $this->_db_validate) {
            foreach ($this->_db_validate as $field => $vali) {
                if (isset($info[$field]) && !empty($info[$field])) {
                    if (($vali['3'] == 'all' || $vali['3'] == $operation) && $vali['1'] == 'unique') {
                        $arrTempData = array();
                        if (isset($vali['extend']) && $vali['extend']) {
                            $arrtempWhere = array();
                            $arrtempWhere[] = '`' . $field . '`="' . $info[$field] . '"';
                            foreach ($vali['extend'] as $extendField) {
                                if (isset($info[$extendField])) {
                                    $arrtempWhere[] = '`' . $extendField . '`="' . $info[$extendField] . '"';
                                }
                            }
                            $strTempwhere = '';
                            if (!empty($arrtempWhere)) {
                                $strTempwhere = ' where ' . implode(' and ', $arrtempWhere);
                                if (in_array($this->ac, array('edit', 'batch_update'))) {
                                    $strTempwhere .= ' and `' . $this->_dbfield['mainKey'] . '`!="' . $info[$this->_dbfield['mainKey']] . '"';
                                }
                            }
                            if ($strTempwhere) {
                                $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` ' . $strTempwhere . ' limit 1');
                            }
                        } else {
                            if (in_array($this->ac, array('edit', 'batch_update'))) {
                                $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` where `' . $field . '`="' . $info[$field] . '" and `' . $this->_dbfield['mainKey'] . '`!="' . $info[$this->_dbfield['mainKey']] . '" limit 1');
                            } else {
                                $arrTempData = db::get_one('select `' . $this->_dbfield['mainKey'] . '` from `' . $this->table . '` where `' . $field . '`="' . $info[$field] . '" limit 1');
                            }
                        }
                        if ($arrTempData) {
                            cls_msgbox::show('系统提示', $vali['2'], -1);
                            exit;
                        }
                    }
                }
            }
        }
        if (isset($this->_auto) && $this->_auto) {
            foreach ($this->_auto as $field => $vali) {
                if (!isset($info[$field]) || empty($info[$field])) {
                    if ($vali['3'] == 'all' || $vali['3'] == $operation) {
                        if ($vali['1'] == 'value' && isset($vali['2'])) {
                            $info[$field] = $vali['2'];
                        } elseif ($vali['1'] == 'function' && isset($vali['2'])) {
                            $info[$field] = $vali['2'];
                        }
                    }
                }
            }
        }
        return $info;
    }
    public function update_image($imgurl, $filevali, $itemName, $id)
    {
        if (empty($imgurl['name'])) {
            return '';
        } else {
            $tem_arr = explode('.', $imgurl['name']);
            $ext = array_pop($tem_arr);
            if ($filevali['format']) {
                if (!in_array($ext, $filevali['format'])) {
                    cls_msgbox::show('系统提示', '上传图片格式有误！' . implode(',', $filevali['format']), '-1');
                    exit;
                }
            } elseif (!preg_match('#(gif|jpg|png)#', $ext)) {
                cls_msgbox::show('系统提示', '上传图片格式有误！', '-1');
                exit;
            }
            $max_file_size = 5000000;
            if ($filevali['size']) {
                $max_file_size = $filevali['size'];
            }
            if ($max_file_size < $imgurl['size']) {
                cls_msgbox::show('系统提示', '上传图片太大！', '-1');
                exit;
            }
            $imgUrl = PATH_ROOT . '/html/static/upload/' . date('Y') . '/';
            $relaUrl = '/html/static/upload/' . date('Y') . '/';
            if (file_exists($imgUrl) === false) {
                mkdir($imgUrl, 0777, true);
            }
            $file_name = $this->table . '_' . $id . '_' . $itemName . '.' . $ext;
            if ($file_name && file_exists($imgUrl . $file_name)) {
            }
            $local_File = $imgUrl . $file_name;
            $relative_File = $relaUrl . $file_name;
            $imgurl['tmp_name'] = str_ireplace('\\\\', '\\', $imgurl['tmp_name']);
            if (move_uploaded_file($imgurl['tmp_name'], $local_File)) {
                return $relative_File;
            } else {
                cls_msgbox::show('系统提示', '图片上传失败！' . $imgurl['tmp_name'] . '  to ' . $local_File, '-1');
                exit;
            }
        }
    }
}