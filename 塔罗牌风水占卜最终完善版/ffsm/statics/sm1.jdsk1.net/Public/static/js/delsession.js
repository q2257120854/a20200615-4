"use strict";
$('.measure').on("click",function(){   
$.ajax({
	type: "post",
	url: link_address,
	data: {data:1},
	success: function(data) {
	}
});
})

