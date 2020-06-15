function  a(_position_,_className_){

    var picker = document.getElementById(_position_);
    var picker_li = picker.getElementsByTagName('li');

    picker.addEventListener('touchstart',touch, false);  
    //picker.addEventListener('touchmove',touch, false);  
    picker.addEventListener('touchend',touch, false); 
    picker.style.transform = "translateY(64px) perspective(1000px)";

    var pickerY = 0;
    var picker_index = 1;
    var picker_clientY = 0;

    var Regex = /\.*translateY\((.*)px\)/i;

    function touch(event){
        var event = event || window.event; 

        switch(event.type){
            case "touchstart":
                picker_array =  this.style.transform.split(" ");
                for(var i=0;i<picker_array.length;i++){
                    var picker_Regex = Regex.exec(picker_array[i]);
                    if (picker_Regex !== null){
                        pickerY = picker_Regex[1];
                    }
                    
                }
                picker_clientY = event.changedTouches[0].clientY
                
                break;
            case "touchmove":

                break;
            case "touchend":
                
                if(picker_clientY >= event.changedTouches[0].clientY){
                    if(picker_index != picker_li.length){
                        this.style.transform = "translateY("+ (parseInt(pickerY) - (32) ) +"px) perspective(1000px)";
                        this.style.transition = "100ms ease-in";
                        picker_li[picker_index-1].className = "";
                        if(_className_ == 'onethis'){
                            picker_li[picker_index].className = "onethis";
                        }else{
                            picker_li[picker_index].className = "twothis";
                        }
                        picker_index = parseInt(picker_index) + 1;                      
                    }

                }else{
                    if(picker_index != 1){
                        this.style.transform = "translateY("+ (parseInt(pickerY) + (32) ) +"px) perspective(1000px)";
                        this.style.transition = "100ms ease-in";
                        picker_li[picker_index-1].className = "";
                        if(_className_ == 'onethis'){
                            picker_li[picker_index-2].className = "onethis";
                        }else{
                            picker_li[picker_index-2].className = "twothis";
                        }
                        picker_index = parseInt(picker_index) - 1;
                        picker_li[picker_index-1]
                    }
                    
                }

                calc();  //调用计算
                break;

        }


    }


}

function calc(){


    var L = document.getElementsByClassName('onethis')[0].innerHTML; 
    var R = document.getElementsByClassName('twothis')[0].innerHTML; 
    var money = document.getElementById('money');

    console.log(L); //left_value
    console.log(R); //right_value

    //公式自己写
    //money.innerHTML = "￥" +  parseInt(L) * parseInt(R);

}
 calc()
 a("picker_left","onethis");
 a("picker_right","twothis");
