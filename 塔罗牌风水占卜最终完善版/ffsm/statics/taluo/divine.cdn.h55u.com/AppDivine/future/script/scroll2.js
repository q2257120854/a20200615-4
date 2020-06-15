var scrollArea = document.getElementsByClassName('upto-wrap')[0];
var li = scrollArea.getElementsByTagName("li");
scrollArea.style.height = (li[0].offsetHeight * 3 )+ "px";
//滚动
var liHeight = li[0].offsetHeight;   //单行滚动的高度
var speed = 20;      //滚动的速度
var timer;
var delay = 2000;    //滚动的间隔
scrollArea.scrollTop = 0;
scrollArea.innerHTML += scrollArea.innerHTML;
function startScroll(){
    timer = setInterval(scrollUp, speed);
    scrollArea.scrollTop++;
}
function scrollUp(){
    if(scrollArea.scrollTop % liHeight == 0){
        clearInterval(timer);
        setTimeout(startScroll, delay);
    }else{
        scrollArea.scrollTop++;
        if(scrollArea.scrollTop >= scrollArea.scrollHeight / 2){
            scrollArea.scrollTop = 0;
        }
    }
}
setTimeout(startScroll, delay);
