<?php
namespace app\admin\controller;
use think\addons\ AddonException;
use think\addons\Service;
use think\Cache;
use think\Config;
use think\Exception;
use app\common\util\Dir;
//插件作者QQ:834023388
//新增手机模板配置、站群列表分页；
//当前版本：v1.2
//新增分页、手机模板等功能
class Domain extends Base {
  public function __construct() {
    parent::__construct();
    if ( !file_exists( APP_PATH . 'extra/domain.php' ) ) {
      file_put_contents( APP_PATH . 'extra/domain.php', "<?php\nreturn array ();" );
    }

  }
  public function index() {
    $param = input();
    $param[ 'page' ] = intval( $param[ 'page' ] ) < 1 ? 1 : $param[ 'page' ];
    $param[ 'limit' ] = intval( $param[ 'limit' ] ) < 1 ? $this->_pagesize : $param[ 'limit' ];
    $templates = glob( './template' . '/*', GLOB_ONLYDIR );
    foreach ( $templates as $k => & $v ) {
      $v = str_replace( './template/', '', $v );
    }
    $this->assign( 'templates', $templates );
    $maccms = Config( 'maccms' );
    $this->assign( 'maccms', $maccms );
    $domain_list = Config( 'domain' );
    $total = count( $domain_list );
    $page = 1;
    $limit = 10;
    $res = $this->page_array( $param[ 'limit' ], $param[ 'page' ], $domain_list, 0 );
    $this->assign( 'list', $res[ 'list' ] );
    $this->assign( 'total', $res[ 'total' ] );
    $this->assign( 'page', $res[ 'page' ] );
    $this->assign( 'limit', $res[ 'limit' ] );;
    $param[ 'page' ] = '{page}';
    $param[ 'limit' ] = '{limit}';
    $this->assign( 'param', $param );
    $this->assign( 'domain_list', $domain_list );
    $this->assign( 'title', '站群管理' );
    return $this->fetch( 'admin@domain/index' );
  }
  public function page_array( $count, $page, $array, $order ) {

    global $countpage; #定全局变量
    $page = ( empty( $page ) ) ? '1' : $page; #判断当前页面是否为空 如果为空就表示为第一页面
    $start = ( $page - 1 ) * $count; #计算每次分页的开始位置
    if ( $order == 1 ) {
      $array = array_reverse( $array );
    }
    $totals = count( $array );
    $countpage = ceil( $totals / $count ); #计算总页面数
    $pagedata = [];

    $pagedata[ 'list' ] = array_slice( $array, $start, $count );
    $pagedata[ 'total' ] = $totals;
    $pagedata[ 'page' ] = $page;
    $pagedata[ 'limit' ] = $count;

    return $pagedata; #返回查询数据
  }
  public function export () { 
    $param = input();
    $list = config( 'domain' );
    if ( isset( $param[ 'site_url' ] ) ) {
      $info[ $param[ 'site_url' ] ] = $list[ $param[ 'site_url' ] ];
      $title = $param[ 'site_url' ];
    } else {
      $info = $list;
      $title = '全部';
    }
    header( "Content-type: application/octet-stream" );
    if ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], "MSIE" ) ) {
      header( "Content-Disposition: attachment; filename=mac_" . urlencode( $title ) . '.txt' );
    } else {
      header( "Content-Disposition: attachment; filename=mac_" . $title . '.txt' );
    }
    echo base64_encode( json_encode( $info ) );
  }
  public function import () {

    $file = $this->request->file( 'file' );
    $info = $file->rule( 'uniqid' )->validate( [ 'size' => 10240000, 'ext' => 'txt' ] );
    if ( $info ) {
      $data = json_decode( base64_decode( file_get_contents( $info->getpathName() ) ), true );
      @unlink( $info->getpathName() );
      if ( $data ) {

        if ( empty( $data ) ) {
          return $this->error( '格式错误' );
        }
        $list = config( 'domain' );
        $config_new = array_merge( $list, $data );
        $res = mac_arr2file( APP_PATH . 'extra/domain.php', $config_new );
        if ( $res === false ) {
          return $this->error( '保存配置文件失败，请重试!' );
        }

      }
      return $this->success( '导入失败，请检查文件格式' );
    } else {
      return $this->error( $file->getError() );
    }
  }
  public function del() {
    $param = input();
    $domain = config( 'domain' );


    foreach ( $param[ 'site_url' ] as $value ) {



      unset( $domain[ $value ] );
    }

    unset( $domain[ $param[ 'site_url' ] ] );
    $res = mac_arr2file( APP_PATH . 'extra/domain.php', $domain );
    if ( $res === false ) {
      return $this->error( '删除失败，请重试!' );
    }
    return $this->success( '删除成功!' );
  }
  public function info() {

    $site_url = input( 'site_url' );
    if ( isset( $site_url ) ) {
      if ( Request()->isPost() ) {
        $param = input( 'post.' );
        $config_new[ $param[ 'site' ][ 'site_url' ] ] = array_filter( $param[ 'site' ], 'app\admin\controller\Domain::test_site' );
        $config_old = config( 'domain' );

        if ( $config_old[ $site_url ][ 'site_url' ] != $param[ 'site' ][ 'site_url' ] ) {
          return $this->error( '域名不存在修改失败，请点击添加增加!' );
        }
        $config_new = array_merge( $config_old, $config_new );


        $res = mac_arr2file( APP_PATH . 'extra/domain.php', $config_new );

        if ( $res === false ) {
          return $this->error( '修改失败，请重试!' );
        }
        return $this->success( '修改成功!', 'index' );

      }

      $info = config( 'domain' );
      $this->assign( 'info', $info[ $site_url ] );
      $this->assign( 'title', '编辑站点' );

    } else {
      if ( Request()->isPost() ) {
        $param = input( 'post.' );
        $config_new[ $param[ 'site' ][ 'site_url' ] ] = array_filter( $param[ 'site' ], 'app\admin\controller\Domain::test_site' );
        $config_old = config( 'domain' );

        if ( isset( $config_old[ $param[ 'site' ][ 'site_url' ] ][ 'site_url' ] ) ) {
          return $this->error( '域名存在 添加失败，请点击编辑修改!' );
        }

        $config_new = array_merge( $config_old, $config_new );
        $res = mac_arr2file( APP_PATH . 'extra/domain.php', $config_new );

        if ( $res === false ) {
          return $this->error( '添加失败，请重试!' );
        }
        return $this->success( '添加成功!' );
      }
      $this->assign( 'title', '添加站点' );
    }

    $templates = glob( './template' . '/*', GLOB_ONLYDIR );
    foreach ( $templates as $k => & $v ) {
      $v = str_replace( './template/', '', $v );
    }
    $this->assign( 'templates', $templates );

    return $this->fetch( 'admin@domain/info' );
  }
  public static function test_site( $arr ) {
    if ( $arr === '' || $arr === null ) {
      return false;
    }
    return true;
  }

}
 
?>