
$(function () {
    //$(".more1").click(function () {
    //    if ($(this).siblings(".starlist").innerHeight() <= 160 && $(this).siblings(".starlist").children().innerHeight() > 160) {
    //        $(this).siblings(".starlist").animate({ height: $(this).siblings(".starlist").children().innerHeight() });
    //        $(this).text("点击收起");
    //    } else {
    //        $(this).siblings(".starlist").animate({ height: 160 });
    //        $(this).text("了解更多");
    //    }
    //});

    //$(".morebg").click(function () {
    //    if ($(this).siblings(".starlist").innerHeight() <= 160 && $(this).siblings(".starlist").children().innerHeight() > 160) {
    //        $(this).siblings(".starlist").animate({ height: $(this).siblings(".starlist").children().innerHeight() });
    //        $(".more1").text("点击收起").addClass("up");
    //    } else {
    //        $(this).siblings(".starlist").animate({ height: 160 });
    //        $(".more1").text("了解更多").removeClass("up");
    //    }
    //});

    $(".dj1").click(function () {
        $(".starlist div").slideDown(300);
        $(this).hide();
        $(".dj2").show();
    });
    $(".dj2").click(function () {
        $(".starlist div").slideUp(300);
        $(this).hide();
        $(".dj1").show();
    });
});

