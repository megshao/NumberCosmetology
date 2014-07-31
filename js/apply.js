function checkForm(){
    if(document.getElementById('m_username').value==""){     
        alert("請填寫帳號!");
        document.getElementById('m_username').focus();
        return false;
    }else{
        uid=document.getElementById('m_username').value;
        if(uid.length<5 || uid.length>12){
            alert( "您的帳號長度只能5至12個字元!" );
            document.getElementById('m_username').focus();
            return false;
        }
        if(!(uid.charAt(0)>='a' && uid.charAt(0)<='z')){
            alert("您的帳號第一字元只能為小寫字母!" );
            document.getElementById('m_username').focus();
            return false;
        }
        for(idx=0;idx<uid.length;idx++){
            if(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z'){
                alert("帳號不可以含有大寫字元!" );
                document.getElementById('m_username').focus();
                return false;
            }
            if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||( uid.charAt(idx)=='_'))){
                alert( "您的帳號只能是數字,英文字母及「_」等符號,其他的符號都不能使用!" );
                document.getElementById('m_username').focus();
                return false;
            }
            if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
                alert( "「_」符號不可相連 !\n" );
                document.getElementById('m_username').focus();
                return false;               
            }
        }
    }
    if(!check_passwd(document.getElementById('m_passwd').value,document.getElementById('m_passwdrecheck').value)){
        document.getElementById('m_passwd').focus();
        return false;
    }   
    if(document.getElementById('m_name').value==""){
        alert("請填寫姓名!");
        document.getElementById('m_name').focus();
        return false;
    }
    if(document.getElementById('m_birthday').value==""){
        alert("請填寫生日!");
        document.getElementById('m_birthday').focus();
        return false;
    }
    if(document.getElementById('m_email').value==""){
        alert("請填寫電子郵件!");
        document.getElementById('m_email').focus();
        return false;
    }
    if(!checkmail(document.getElementById('m_email'))){
        document.getElementById('m_email').focus();
        return false;
    }
    return confirm('確定送出嗎？');
}
function check_passwd(pw1,pw2){
    if(pw1==''){
        alert("密碼不可以空白!");
        return false;
    }
    for(var idx=0;idx<pw1.length;idx++){
        if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
            alert("密碼不可以含有空白或雙引號 !\n");
            return false;
        }
        if(pw1.length<5 || pw1.length>10){
            alert( "密碼長度只能5到10個字母 !\n" );
            return false;
        }
        if(pw1!= pw2){
            alert("密碼二次輸入不一樣,請重新輸入 !\n");
            return false;
        }
    }
    return true;
}
function checkmail(myEmail) {
    var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(filter.test(myEmail.value)){
        return true;
    }
    alert("電子郵件格式不正確");
    return false;
}
function dataClean(){
    document.getElementById('m_username').value="";
    document.getElementById('m_passwd').value="";
    document.getElementById('m_passwdrecheck').value="";
    document.getElementById('m_name').value="";
    document.getElementById('m_birthday').value="";
    document.getElementById('m_email').value="";
    document.getElementById('m_phone').value="";
    document.getElementById('m_address').value="";
}