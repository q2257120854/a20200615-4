<?php
	class Edlm{
		function ede1($key,$str,$t){
			if($key=="" or $str==""){
				return '参数内容不完整,第一个参数Key(密钥必填),二个参数Str(需要加密的内容),第三个参数T(加密的方式0为默认,1为CN式加密,2为EN式加密,3为LM式加密).';
			}else{
				if(!is_numeric($t)){
					return 'T参数错误,T参数为整数型，目前有 0:普通加密(面对普通数据已经足够),1:CN式加密对付不懂中文者(兼容性低速度慢),2:EN式加密对付不懂英文者(兼容性高速度快),3:LM式乱来对付各种人士(兼容性低速度慢安全高).';
				}else{
					if($t>=4){
						return 'T参数错误,T参数为整数型，目前有 0:普通加密(面对普通数据已经足够),1:CN式加密对付不懂中文者,2:EN式加密对付不懂英文者,3:LM式乱来对付各种人士.';
					}
					$rusult = $this->Rc4($key,$str);
					$rusult = base64_encode($rusult);
					$tt = strlen($rusult) / 2;
					$tt= intval($tt);
					$left = substr($rusult, 0,$tt);
					if($tt%2===0 and strlen($rusult)%2===1){
						$tt = $tt + 1;
					}
					$right = substr($rusult, intval("-$tt"));
					$md5="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm=+-~!@#$%^&*()|:/'";
					str_shuffle($md5);
					$rusult = substr(str_shuffle($md5),26,5).$left.substr(str_shuffle($md5),26,5).$right.substr(str_shuffle($md5),26,5);
					if($t==0){
						return $rusult;
					}else if($t==1){
						return $this->Cncode($rusult);
					}else if($t==2){
						return $this->Encode($rusult);
					}else{
						return $this->Lmcode($rusult);
					}
				}
			}
		}
		function edd1($key,$str,$t){
			if($key=="" or $str==""){
				return '参数内容不完整,第一个参数Key(密钥必填),二个参数Str(需要解密的内容),第三个参数T(解密的方式0为默认,1为CN式解密,2为EN式解密,3为LM式解密).';
			}else{
				if(!is_numeric($t)){
					return 'T参数错误,T参数为整数型,以什么方式加密的就需要用什么方式解密.';
				}else{
					if($t>=4){
						return 'T参数错误,T参数为整数型,以什么方式加密的就需要用什么方式解密.';
					}
					if($t==0){
						$str = $str;
					}else if($t==1){
						$str = $this->Cndecode($str);
					}else if($t==2){
						$str = $this->Endecode($str);
					}else{
						$str = $this->Lmdecode($str);
					}
					$count = strlen($str) - 15;
					$tt = $count / 2;
					$tt= intval($tt);
					$left = str_replace(substr($str, 0,5),"",$str);
					$left = substr($left, 0,$tt);
					if($tt%2===0 and strlen($str)%2===1){
						$tt = $tt + 1;
					}
					$right = str_replace(substr($str,-5),"",$str);
					$tt = $tt - 1;
					$right = substr($right, intval("-$tt"));
					$str = $left.$right;
					$rusult = base64_decode($str);
					$rusult = $this->Rc4($key,$rusult);
					return $rusult;
				}
			}
		}
		public function Rc4($pwd,$data){
			$cipher      = '';
		    $key[]       = "";
		    $box[]       = "";
		    $pwd_length  = strlen($pwd);
		    $data_length = strlen($data);
		    for ($i = 0; $i < 256; $i++) {
		        $key[$i] = ord($pwd[$i % $pwd_length]);
		        $box[$i] = $i;
		    }
		    for ($j = $i = 0; $i < 256; $i++) {
		        $j       = ($j + $box[$i] + $key[$i]) % 256;
		        $tmp     = $box[$i];
		        $box[$i] = $box[$j];
		        $box[$j] = $tmp;
		    }
		    for ($a = $j = $i = 0; $i < $data_length; $i++) {
		        $a       = ($a + 1) % 256;
		        $j       = ($j + $box[$a]) % 256;
		        $tmp     = $box[$a];
		        $box[$a] = $box[$j];
		        $box[$j] = $tmp;
		        $k       = $box[(($box[$a] + $box[$j]) % 256)];
		        $cipher .= chr(ord($data[$i]) ^ $k);
		    }
		    return $cipher;
		}
		public function tomail ($url,$token){
			$post_data = array('token' => $token);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			$output = curl_exec($ch);
			curl_close($ch);
	        return $output;
		}
		public function getSubstr($str, $leftStr, $rightStr){
		    $left = strpos($str, $leftStr);
		    $right = strpos($str, $rightStr,$left);
		    if($left < 0 or $right < $left) return '';
		    return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
		}
		private function Cncode($str){
			$str = str_replace('0',"零",$str);
			$str = str_replace('1',"壹",$str);
			$str = str_replace('2',"贰",$str);
			$str = str_replace('3',"叁",$str);
			$str = str_replace('4',"肆",$str);
			$str = str_replace('5',"伍",$str);
			$str = str_replace('6',"陆",$str);
			$str = str_replace('7',"柒",$str);
			$str = str_replace('8',"捌",$str);
			$str = str_replace('9',"玖",$str);
			$str = str_replace('q',"叉",$str);
			$str = str_replace('w',"大",$str);
			$str = str_replace('e',"鑫",$str);
			$str = str_replace('r',"驲",$str);
			$str = str_replace('t',"腾",$str);
			$str = str_replace('y',"元",$str);
			$str = str_replace('u',"亦",$str);
			$str = str_replace('i',"唉",$str);
			$str = str_replace('o',"跑",$str);
			$str = str_replace('p',"说",$str);
			$str = str_replace('a',"哦",$str);
			$str = str_replace('s',"上",$str);
			$str = str_replace('d',"到",$str);
			$str = str_replace('f',"发",$str);
			$str = str_replace('g',"高",$str);
			$str = str_replace('h',"就",$str);
			$str = str_replace('j',"和",$str);
			$str = str_replace('k',"开",$str);
			$str = str_replace('l',"心",$str);
			$str = str_replace('z',"从",$str);
			$str = str_replace('x',"做",$str);
			$str = str_replace('c',"成",$str);
			$str = str_replace('v',"女",$str);
			$str = str_replace('b',"呸",$str);
			$str = str_replace('n',"气",$str);
			$str = str_replace('m',"麻",$str);
			$str = str_replace('Q',"逆",$str);
			$str = str_replace('W',"增",$str);
			$str = str_replace('E',"墨",$str);
			$str = str_replace('R',"咳",$str);
			$str = str_replace('T',"姨",$str);
			$str = str_replace('Y',"介",$str);
			$str = str_replace('U',"阳",$str);
			$str = str_replace('I',"东",$str);
			$str = str_replace('O',"长",$str);
			$str = str_replace('P',"德",$str);
			$str = str_replace('L',"辣",$str);
			$str = str_replace('K',"麽",$str);
			$str = str_replace('J',"丑",$str);
			$str = str_replace('H',"孩",$str);
			$str = str_replace('G',"晡",$str);
			$str = str_replace('F',"朵",$str);
			$str = str_replace('D',"锻",$str);
			$str = str_replace('S',"练",$str);
			$str = str_replace('A',"唐",$str);
			$str = str_replace('Z',"爱",$str);
			$str = str_replace('X',"窦",$str);
			$str = str_replace('C',"亚",$str);
			$str = str_replace('V',"逗",$str);
			$str = str_replace('B',"埠",$str);
			$str = str_replace('N',"香",$str);
			$str = str_replace('M',"欧",$str);
			$str = str_replace('`',"垫",$str);
			$str = str_replace('~',"波",$str);
			$str = str_replace('!',"抗",$str);
			$str = str_replace('@',"特",$str);
			$str = str_replace('#',"星",$str);
			$str = str_replace('$',"钱",$str);
			$str = str_replace('%',"百",$str);
			$str = str_replace('^',"啊",$str);
			$str = str_replace('&',"卵",$str);
			$str = str_replace('*',"行",$str);
			$str = str_replace('(',"跨",$str);
			$str = str_replace(')',"漷",$str);
			$str = str_replace('_',"博",$str);
			$str = str_replace('-',"妎",$str);
			$str = str_replace('+',"脚",$str);
			$str = str_replace('=',"钉",$str);
			$str = str_replace('[',"蒸",$str);
			$str = str_replace('{',"整",$str);
			$str = str_replace('}',"黄",$str);
			$str = str_replace(']',"绿",$str);
			$str = str_replace('\\',"撇",$str);
			$str = str_replace('|',"竖",$str);
			$str = str_replace(';',"猫",$str);
			$str = str_replace(':',"茂",$str);
			$str = str_replace('\'',"杆",$str);
			$str = str_replace('"',"爽",$str);
			$str = str_replace('<',"酢",$str);
			$str = str_replace(',',"兜",$str);
			$str = str_replace('>',"油",$str);
			$str = str_replace('.',"殿",$str);
			$str = str_replace('?',"稳",$str);
			$str = str_replace('/',"毙",$str);
			return $str;
		}
		private function Encode($str){
			$str = str_replace('0',"DuanG",$str);
			$str = str_replace('1',"oNe",$str);
			$str = str_replace('2',"TwO",$str);
			$str = str_replace('3',"thREe",$str);
			$str = str_replace('4',"FouR",$str);
			$str = str_replace('5',"fiVe",$str);
			$str = str_replace('6',"SiX",$str);
			$str = str_replace('7',"seVen",$str);
			$str = str_replace('8',"EighT",$str);
			$str = str_replace('9',"niGht",$str);
			$str = str_replace('`',"dDosc",$str);
			$str = str_replace('~',"bBlls",$str);
			$str = str_replace('!',"TtBom",$str);
			$str = str_replace('@',"TeiL",$str);
			$str = str_replace('#',"SianM",$str);
			$str = str_replace('$',"BbQi",$str);
			$str = str_replace('%',"rooM",$str);
			$str = str_replace('^',"Aisop",$str);
			$str = str_replace('&',"Qlqis",$str);
			$str = str_replace('*',"hyUi",$str);
			$str = str_replace('(',"Kuyfa",$str);
			$str = str_replace(')',"yOsdf",$str);
			$str = str_replace('_',"bJkfs",$str);
			$str = str_replace('-',"jUEjs",$str);
			$str = str_replace('+',"cCJDd",$str);
			$str = str_replace('=',"DiSLD",$str);
			$str = str_replace('[',"JJzhn",$str);
			$str = str_replace('{',"ChEng'",$str);
			$str = str_replace('}',"YelLo",$str);
			$str = str_replace(']',"GLVpu",$str);
			$str = str_replace('\\',"PiEis",$str);
			$str = str_replace('|',"SiuDi",$str);
			$str = str_replace(';',"MiAos",$str);
			$str = str_replace(':',"uvAos",$str);
			$str = str_replace('\'',"GunlI",$str);
			$str = str_replace('"',"xiSua",$str);
			$str = str_replace('<',"zHaSi",$str);
			$str = str_replace(',',"dOuLT",$str);
			$str = str_replace('>',"YoNba",$str);
			$str = str_replace('.',"Ddiff",$str);
			$str = str_replace('?',"wwERW",$str);
			$str = str_replace('/',"BbenB",$str);
			return $str;
		}
		private function Lmcode($str){
			$str = str_replace('q',"叉",$str);
			$str = str_replace('w',"大",$str);
			$str = str_replace('e',"鑫",$str);
			$str = str_replace('r',"驲",$str);
			$str = str_replace('t',"腾",$str);
			$str = str_replace('y',"元",$str);
			$str = str_replace('u',"亦",$str);
			$str = str_replace('i',"唉",$str);
			$str = str_replace('o',"跑",$str);
			$str = str_replace('p',"说",$str);
			$str = str_replace('a',"哦",$str);
			$str = str_replace('s',"上",$str);
			$str = str_replace('d',"到",$str);
			$str = str_replace('f',"发",$str);
			$str = str_replace('g',"高",$str);
			$str = str_replace('h',"就",$str);
			$str = str_replace('j',"和",$str);
			$str = str_replace('k',"开",$str);
			$str = str_replace('l',"心",$str);
			$str = str_replace('z',"从",$str);
			$str = str_replace('x',"做",$str);
			$str = str_replace('c',"成",$str);
			$str = str_replace('v',"女",$str);
			$str = str_replace('b',"呸",$str);
			$str = str_replace('n',"气",$str);
			$str = str_replace('m',"麻",$str);
			$str = str_replace('Q',"逆",$str);
			$str = str_replace('W',"增",$str);
			$str = str_replace('E',"墨",$str);
			$str = str_replace('R',"咳",$str);
			$str = str_replace('T',"姨",$str);
			$str = str_replace('Y',"介",$str);
			$str = str_replace('U',"阳",$str);
			$str = str_replace('I',"东",$str);
			$str = str_replace('O',"长",$str);
			$str = str_replace('P',"德",$str);
			$str = str_replace('L',"辣",$str);
			$str = str_replace('K',"麽",$str);
			$str = str_replace('J',"丑",$str);
			$str = str_replace('H',"孩",$str);
			$str = str_replace('G',"晡",$str);
			$str = str_replace('F',"朵",$str);
			$str = str_replace('D',"锻",$str);
			$str = str_replace('S',"练",$str);
			$str = str_replace('A',"唐",$str);
			$str = str_replace('Z',"爱",$str);
			$str = str_replace('X',"窦",$str);
			$str = str_replace('C',"亚",$str);
			$str = str_replace('V',"逗",$str);
			$str = str_replace('B',"埠",$str);
			$str = str_replace('N',"香",$str);
			$str = str_replace('M',"欧",$str);
			$str = str_replace('0',"DuanG",$str);
			$str = str_replace('1',"oNe",$str);
			$str = str_replace('2',"TwO",$str);
			$str = str_replace('3',"thREe",$str);
			$str = str_replace('4',"FouR",$str);
			$str = str_replace('5',"fiVe",$str);
			$str = str_replace('6',"SiX",$str);
			$str = str_replace('7',"seVen",$str);
			$str = str_replace('8',"EighT",$str);
			$str = str_replace('9',"niGht",$str);
			$str = str_replace('`',"dDosc",$str);
			$str = str_replace('~',"bBlls",$str);
			$str = str_replace('!',"TtBom",$str);
			$str = str_replace('@',"TeiL",$str);
			$str = str_replace('#',"SianM",$str);
			$str = str_replace('$',"BbQi",$str);
			$str = str_replace('%',"rooM",$str);
			$str = str_replace('^',"Aisop",$str);
			$str = str_replace('&',"Qlqis",$str);
			$str = str_replace('*',"hyUi",$str);
			$str = str_replace('(',"Kuyfa",$str);
			$str = str_replace(')',"yOsdf",$str);
			$str = str_replace('_',"bJkfs",$str);
			$str = str_replace('-',"jUEjs",$str);
			$str = str_replace('+',"cCJDd",$str);
			$str = str_replace('=',"DiSLD",$str);
			$str = str_replace('[',"JJzhn",$str);
			$str = str_replace('{',"ChEng'",$str);
			$str = str_replace('}',"YelLo",$str);
			$str = str_replace(']',"GLVpu",$str);
			$str = str_replace('\\',"PiEis",$str);
			$str = str_replace('|',"SiuDi",$str);
			$str = str_replace(';',"MiAos",$str);
			$str = str_replace(':',"uvAos",$str);
			$str = str_replace('\'',"GunlI",$str);
			$str = str_replace('"',"xiSua",$str);
			$str = str_replace('<',"zHaSi",$str);
			$str = str_replace(',',"dOuLT",$str);
			$str = str_replace('>',"YoNba",$str);
			$str = str_replace('.',"Ddiff",$str);
			$str = str_replace('?',"wwERW",$str);
			$str = str_replace('/',"BbenB",$str);
			return $str;
		}
		private function Cndecode($str){
			$str = str_replace("零",'0',$str);
			$str = str_replace("壹",'1',$str);
			$str = str_replace("贰",'2',$str);
			$str = str_replace("叁",'3',$str);
			$str = str_replace("肆",'4',$str);
			$str = str_replace("伍",'5',$str);
			$str = str_replace("陆",'6',$str);
			$str = str_replace("柒",'7',$str);
			$str = str_replace("捌",'8',$str);
			$str = str_replace("玖",'9',$str);
			$str = str_replace("叉",'q',$str);
			$str = str_replace("大",'w',$str);
			$str = str_replace("鑫",'e',$str);
			$str = str_replace("驲",'r',$str);
			$str = str_replace("腾",'t',$str);
			$str = str_replace("元",'y',$str);
			$str = str_replace("亦",'u',$str);
			$str = str_replace("唉",'i',$str);
			$str = str_replace("跑",'o',$str);
			$str = str_replace("说",'p',$str);
			$str = str_replace("哦",'a',$str);
			$str = str_replace("上",'s',$str);
			$str = str_replace("到",'d',$str);
			$str = str_replace("发",'f',$str);
			$str = str_replace("高",'g',$str);
			$str = str_replace("就",'h',$str);
			$str = str_replace("和",'j',$str);
			$str = str_replace("开",'k',$str);
			$str = str_replace("心",'l',$str);
			$str = str_replace("从",'z',$str);
			$str = str_replace("做",'x',$str);
			$str = str_replace("成",'c',$str);
			$str = str_replace("女",'v',$str);
			$str = str_replace("呸",'b',$str);
			$str = str_replace("气",'n',$str);
			$str = str_replace("麻",'m',$str);
			$str = str_replace("逆",'Q',$str);
			$str = str_replace("增",'W',$str);
			$str = str_replace("墨",'E',$str);
			$str = str_replace("咳",'R',$str);
			$str = str_replace("姨",'T',$str);
			$str = str_replace("介",'Y',$str);
			$str = str_replace("阳",'U',$str);
			$str = str_replace("东",'I',$str);
			$str = str_replace("长",'O',$str);
			$str = str_replace("德",'P',$str);
			$str = str_replace("辣",'L',$str);
			$str = str_replace("麽",'K',$str);
			$str = str_replace("丑",'J',$str);
			$str = str_replace("孩",'H',$str);
			$str = str_replace("晡",'G',$str);
			$str = str_replace("朵",'F',$str);
			$str = str_replace("锻",'D',$str);
			$str = str_replace("练",'S',$str);
			$str = str_replace("唐",'A',$str);
			$str = str_replace("爱",'Z',$str);
			$str = str_replace("窦",'X',$str);
			$str = str_replace("亚",'C',$str);
			$str = str_replace("逗",'V',$str);
			$str = str_replace("埠",'B',$str);
			$str = str_replace("香",'N',$str);
			$str = str_replace("欧",'M',$str);
			$str = str_replace("垫",'`',$str);
			$str = str_replace("波",'~',$str);
			$str = str_replace("抗",'!',$str);
			$str = str_replace("特",'@',$str);
			$str = str_replace("星",'#',$str);
			$str = str_replace("钱",'$',$str);
			$str = str_replace("百",'%',$str);
			$str = str_replace("啊",'^',$str);
			$str = str_replace("卵",'&',$str);
			$str = str_replace("行",'*',$str);
			$str = str_replace("跨",'(',$str);
			$str = str_replace("漷",')',$str);
			$str = str_replace("博",'_',$str);
			$str = str_replace("妎",'-',$str);
			$str = str_replace("脚",'+',$str);
			$str = str_replace("钉",'=',$str);
			$str = str_replace("蒸",'[',$str);
			$str = str_replace("整",'{',$str);
			$str = str_replace("黄",'}',$str);
			$str = str_replace("绿",']',$str);
		    $str = str_replace("撇",'\\',$str);
			$str = str_replace("竖",'|',$str);
			$str = str_replace("猫",';',$str);
			$str = str_replace("茂",':',$str);
		    $str = str_replace("杆",'\'',$str);
			$str = str_replace("爽",'"',$str);
			$str = str_replace("酢",'<',$str);
			$str = str_replace("兜",',',$str);
			$str = str_replace("油",'>',$str);
			$str = str_replace("殿",'.',$str);
			$str = str_replace("稳",'?',$str);
			$str = str_replace("毙",'/',$str);
			return $str;
		}
		private function Endecode($str){
			$str = str_replace("DuanG",'0',$str);
			$str = str_replace("oNe",'1',$str);
			$str = str_replace("TwO",'2',$str);
			$str = str_replace("thREe",'3',$str);
			$str = str_replace("FouR",'4',$str);
			$str = str_replace("fiVe",'5',$str);
			$str = str_replace("SiX",'6',$str);
			$str = str_replace("seVen",'7',$str);
			$str = str_replace("EighT",'8',$str);
			$str = str_replace("niGht",'9',$str);
			$str = str_replace("dDosc",'`',$str);
			$str = str_replace("bBlls",'~',$str);
			$str = str_replace("TtBom",'!',$str);
			$str = str_replace("TeiL",'@',$str);
			$str = str_replace("SianM",'#',$str);
			$str = str_replace("BbQi",'$',$str);
			$str = str_replace("rooM",'%',$str);
			$str = str_replace("Aisop",'^',$str);
			$str = str_replace("Qlqis",'&',$str);
			$str = str_replace("hyUi",'*',$str);
			$str = str_replace("Kuyfa",'(',$str);
			$str = str_replace("yOsdf",')',$str);
			$str = str_replace("bJkfs",'_',$str);
			$str = str_replace("jUEjs",'-',$str);
			$str = str_replace("cCJDd",'+',$str);
			$str = str_replace("DiSLD",'=',$str);
			$str = str_replace("JJzhn",'[',$str);
			$str = str_replace("ChEg'",'{',$str);
			$str = str_replace("YelLo",'}',$str);
			$str = str_replace("GLVpu",']',$str);
			$str = str_replace("PiEis",'\\',$str);
			$str = str_replace("SiuDi",'|',$str);
			$str = str_replace("MiAos",';',$str);
			$str = str_replace("uvAos",':',$str);
			$str = str_replace("GunlI",'\'',$str);
			$str = str_replace("xiSua",'"',$str);
			$str = str_replace("zHaSi",'<',$str);
			$str = str_replace("dOuLT",',',$str);
			$str = str_replace("YoNba",'>',$str);
			$str = str_replace("Ddiff",'.',$str);
			$str = str_replace("wwERW",'?',$str);
			$str = str_replace("BbenB",'/',$str);
			return $str;
		}
		private function Lmdecode($str){
			$str = str_replace("叉",'q',$str);
			$str = str_replace("大",'w',$str);
			$str = str_replace("鑫",'e',$str);
			$str = str_replace("驲",'r',$str);
			$str = str_replace("腾",'t',$str);
			$str = str_replace("元",'y',$str);
			$str = str_replace("亦",'u',$str);
			$str = str_replace("唉",'i',$str);
			$str = str_replace("跑",'o',$str);
			$str = str_replace("说",'p',$str);
			$str = str_replace("哦",'a',$str);
			$str = str_replace("上",'s',$str);
			$str = str_replace("到",'d',$str);
			$str = str_replace("发",'f',$str);
			$str = str_replace("高",'g',$str);
			$str = str_replace("就",'h',$str);
			$str = str_replace("和",'j',$str);
			$str = str_replace("开",'k',$str);
			$str = str_replace("心",'l',$str);
			$str = str_replace("从",'z',$str);
			$str = str_replace("做",'x',$str);
			$str = str_replace("成",'c',$str);
			$str = str_replace("女",'v',$str);
			$str = str_replace("呸",'b',$str);
			$str = str_replace("气",'n',$str);
			$str = str_replace("麻",'m',$str);
			$str = str_replace("逆",'Q',$str);
			$str = str_replace("增",'W',$str);
			$str = str_replace("墨",'E',$str);
			$str = str_replace("咳",'R',$str);
			$str = str_replace("姨",'T',$str);
			$str = str_replace("介",'Y',$str);
			$str = str_replace("阳",'U',$str);
			$str = str_replace("东",'I',$str);
			$str = str_replace("长",'O',$str);
			$str = str_replace("德",'P',$str);
			$str = str_replace("辣",'L',$str);
			$str = str_replace("麽",'K',$str);
			$str = str_replace("丑",'J',$str);
			$str = str_replace("孩",'H',$str);
			$str = str_replace("晡",'G',$str);
			$str = str_replace("朵",'F',$str);
			$str = str_replace("锻",'D',$str);
			$str = str_replace("练",'S',$str);
			$str = str_replace("唐",'A',$str);
			$str = str_replace("爱",'Z',$str);
			$str = str_replace("窦",'X',$str);
			$str = str_replace("亚",'C',$str);
			$str = str_replace("逗",'V',$str);
			$str = str_replace("埠",'B',$str);
			$str = str_replace("香",'N',$str);
			$str = str_replace("欧",'M',$str);
			$str = str_replace("DuanG",'0',$str);
			$str = str_replace("oNe",'1',$str);
			$str = str_replace("TwO",'2',$str);
			$str = str_replace("thREe",'3',$str);
			$str = str_replace("FouR",'4',$str);
			$str = str_replace("fiVe",'5',$str);
			$str = str_replace("SiX",'6',$str);
			$str = str_replace("seVen",'7',$str);
			$str = str_replace("EighT",'8',$str);
			$str = str_replace("niGht",'9',$str);
			$str = str_replace("dDosc",'`',$str);
			$str = str_replace("bBlls",'~',$str);
			$str = str_replace("TtBom",'!',$str);
			$str = str_replace("TeiL",'@',$str);
			$str = str_replace("SianM",'#',$str);
			$str = str_replace("BbQi",'$',$str);
			$str = str_replace("rooM",'%',$str);
			$str = str_replace("Aisop",'^',$str);
			$str = str_replace("Qlqis",'&',$str);
			$str = str_replace("hyUi",'*',$str);
			$str = str_replace("Kuyfa",'(',$str);
			$str = str_replace("yOsdf",')',$str);
			$str = str_replace("bJkfs",'_',$str);
			$str = str_replace("jUEjs",'-',$str);
			$str = str_replace("cCJDd",'+',$str);
			$str = str_replace("DiSLD",'=',$str);
			$str = str_replace("JJzhn",'[',$str);
			$str = str_replace("ChEg'",'{',$str);
			$str = str_replace("YelLo",'}',$str);
			$str = str_replace("GLVpu",']',$str);
			$str = str_replace("PiEis",'\\',$str);
			$str = str_replace("SiuDi",'|',$str);
			$str = str_replace("MiAos",';',$str);
			$str = str_replace("uvAos",':',$str);
			$str = str_replace("GunlI",'\'',$str);
			$str = str_replace("xiSua",'"',$str);
			$str = str_replace("zHaSi",'<',$str);
			$str = str_replace("dOuLT",',',$str);
			$str = str_replace("YoNba",'>',$str);
			$str = str_replace("Ddiff",'.',$str);
			$str = str_replace("wwERW",'?',$str);
			$str = str_replace("BbenB",'/',$str);
			return $str;
		}
	}
?>