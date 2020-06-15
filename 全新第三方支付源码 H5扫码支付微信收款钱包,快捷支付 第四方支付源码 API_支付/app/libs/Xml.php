<?php
namespace WY\app\libs;
if (!defined('WY_ROOT')) {
    exit;
}
class Xml
{
    static $version = '1.0';
    static $encoding = 'UTF-8';
    /*** 将数据转为XML*/
    public static function toXml($array)
    {
        $xml = '<xml>';
        foreach ($array as $k => $v) {
            $xml .= '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
        }
        $xml .= '</xml>';
        return $xml;
    }
    public static function parseXml($xmlSrc)
    {
        if (empty($xmlSrc)) {
            return false;
        }
        $array = array();
        $xml = simplexml_load_string($xmlSrc);
        $encode = Xml::getXmlEncode($xmlSrc);
        if ($xml && $xml->children()) {
            foreach ($xml->children() as $node) {
                if ($node->children()) {
                    $k = $node->getName();
                    $nodeXml = $node->asXML();
                    $v = substr($nodeXml, strlen($k) + 2, strlen($nodeXml) - 2 * strlen($k) - 5);
                } else {
                    $k = $node->getName();
                    $v = (string) $node;
                }
                if ($encode != "" && $encode != "UTF-8") {
                    $k = iconv("UTF-8", $encode, $k);
                    $v = iconv("UTF-8", $encode, $v);
                }
                $array[$k] = $v;
            }
        }
        return $array;
    }
    static function getXmlEncode($xml)
    {
        $ret = preg_match("/<?xml[^>]* encoding=\"(.*)\" [^>]* ?>/i", $xml, $arr);
        if ($ret) {
            return strtoupper($arr[1]);
        } else {
            return "";
        }
    }
}
?>