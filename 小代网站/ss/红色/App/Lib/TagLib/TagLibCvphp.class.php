<?php
class TagLibCvphp extends TagLib{
	protected $tags = array(
		
		#网站配置
		'config'	=>		array(
				'attr'		=>		'name',
				'close'		=>		0
		),
		#自由块标签
		'block'		=>		array(
				'attr'		=>		'name',
				'close'		=>		0
		),
		
		
	);
	
	
	
	
	
	
	#网站配置标签方法
	public function _config($attr,$content){
		$attr = $this->parseXmlAttr($attr);
		$name = $attr['name'];//调用名称
$str = <<<str
<?php
	\$value = C("$name");
	\$content = '';
	if(\$value){
		\$content = htmlspecialchars_decode(htmlspecialchars_decode(\$value));
	}
	echo \$content;
	?>
str;
		return $str;
	}
	#自由块标签方法
	public function _block($attr,$content){
		$attr = $this->parseXmlAttr($attr);
		$name = $attr['name'];//调用名称
$str = <<<str
<?php
	\$block = M("Block")->where(array('name'=>"$name"))->find();
	\$content = '';
	if(\$block){
		\$content = htmlspecialchars_decode(htmlspecialchars_decode(\$block['content']));
		if(\$block['type'] == 2) \$content = "<img src='".\$content."' />";
	}
	echo \$content;
	?>
str;
		return $str;
	}
	
}