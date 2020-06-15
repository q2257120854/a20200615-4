function postAjax(requestPath, requestData,succCallback, errorCallback, dataType,merchantName){
    /*requestPath：请求路径
     requestData：请求参数，默认为空
     requestType：请求方式("POST" 或 "GET")， 默认为 "GET"
     succCallback：请求成功回调函数
     errorCallback：请求失败回调函数
     dataType：预期服务器返回的数据类型， 默认为 JSON
     merchantName:商家名称 */
    requestData = requestData || {}
    requestType = 'POST'
    dataType = dataType || 'JSON'
    $.ajax({
        headers:{'Content-Type':'application/json;charset=utf8',merchantName:merchantName},
        url:requestPath,               //请求地址
        type:requestType,              //请求类型
        data:JSON.stringify(requestData),              //请求数据
        timeout:100000,               //请求超时时间(毫秒)
        beforeSend:function(){
            //load.init()                //发送请求之前，插入加载提示信息“拼命加载中···”
        },
        success:function(res){         //请求成功
            if(res.code === 200){   //res.message不是唯一，也有可能是res.code 需结合项目实际场景来写入判断条件
                succCallback(res)  //返回OK回调函数，将返回的数据res传入到该回调函数中
            }else{
                errorCallback(res) //返回不是OK时回调函数，将返回的数据res传入到该回调函数中
            }
        },
        complete:function(res,status){
                         //ajax请求完成 
        },
        error:function(){
            errorCallback("请重新请求")                    //请求错误，弹出提示
        }
    })
}

function postAjax1(requestPath,succCallback, errorCallback, dataType,merchantName){
    /*requestPath：请求路径
     requestData：请求参数，默认为空
     requestType：请求方式("POST" 或 "GET")， 默认为 "GET"
     succCallback：请求成功回调函数
     errorCallback：请求失败回调函数
     dataType：预期服务器返回的数据类型， 默认为 JSON
     merchantName:商家名称 */
    requestType = 'POST'
    dataType = dataType || 'JSON'
    $.ajax({
        headers:{'Content-Type':'application/json;charset=utf8',merchantName:merchantName},
        url:requestPath,               //请求地址
        type:requestType,              //请求类型
        timeout:100000,               //请求超时时间(毫秒)
        beforeSend:function(){
            //load.init()                //发送请求之前，插入加载提示信息“拼命加载中···”
        },
        success:function(res){         //请求成功
            if(res.code === 200){   //res.message不是唯一，也有可能是res.code 需结合项目实际场景来写入判断条件
                succCallback(res)  //返回OK回调函数，将返回的数据res传入到该回调函数中
            }else{
                errorCallback(res) //返回不是OK时回调函数，将返回的数据res传入到该回调函数中
            }
        },
        complete:function(res,status){
                         //ajax请求完成 
        },
        error:function(){
            errorCallback("请重新请求")                    //请求错误，弹出提示
        }
    })
}



function getAjax(requestPath, requestData,succCallback, errorCallback, dataType,merchantName){
    /*requestPath：请求路径
     requestData：请求参数，默认为空
     requestType：请求方式("POST" 或 "GET")， 默认为 "GET"
     succCallback：请求成功回调函数
     errorCallback：请求失败回调函数
     dataType：预期服务器返回的数据类型， 默认为 JSON
     merchantName:商家名称 */
    requestData = requestData || {}
    requestType = 'GET'
    dataType = dataType || 'JSON'
    $.ajax({
        headers:{'Content-Type':'application/json;charset=utf8',merchantName:merchantName},
        url:requestPath,               //请求地址
        type:requestType,              //请求类型
        data:requestData,              //请求数据
        timeout:100000,               //请求超时时间(毫秒)
        beforeSend:function(){
            //load.init()                //发送请求之前，插入加载提示信息“拼命加载中···”
        },
        success:function(res){         //请求成功
            if(res.code === 200){  //res.message不是唯一，也有可能是res.code 需结合项目实际场景来写入判断条件
                if(succCallback){
                    succCallback(res)  //返回OK回调函数，将返回的数据res传入到该回调函数中
                }
            }else{
                if(errorCallback){
                    errorCallback(res) //返回不是OK时回调函数，将返回的数据res传入到该回调函数中
                }
            }
        },
        complete:function(res,status){
                         //ajax请求完成 
        },
        error:function(){
            errorCallback("请重新请求")                    //请求错误，弹出提示
        }
    })
}