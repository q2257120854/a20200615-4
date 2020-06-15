
// 验证香港、澳门手机号码和电话号码
function is_HK_telephone(telephone) {
    return /^(00|00 |00-|\+|\+00|0|000)?(852|853)?[-]?[0-9]{8,8}$/.test(telephone);
}