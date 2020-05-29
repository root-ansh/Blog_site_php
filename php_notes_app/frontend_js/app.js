function handleLoginPage() {

    // forms return makes a request with either
    //  {"type": "login", "email": "inpEmail", "pswd": "inpPaswd"} or
    //  {"type": "sign_up", "email": "inpEmail", "pswd": "inpPaswd"} and recieves a response as
    //  {success:true,id="some_id} or{success:false}

    function attachActionsToForm(req_type,form, tagEmail,tagPassword,tagPas2Optional,op ){
        //first let's handle the option password input tag
        if(tagPas2Optional!==undefined){
            tagPas2Optional.onkeyup = (event)=>{
                let inpPassword = tagPassword.value;
                if(tagPas2Optional.value!==inpPassword){
                    op.innerText = "Password does not match";
                }
                else {
                    op.innerText = "matches";
                }

            };

        }
        else {
            //there is no optional password check. so let's make the optional
            //pswd to true to make request possible;
        }

        form.target = "";
        form.method = "post";
        form.onsubmit = function (event) {


            event.preventDefault(); //to prevent auto loading on button press

            let inpEmail = tagEmail.value;
            let inpPaswd = tagPassword.value;


            // if (isUserInputValid()) {sendrequest}else{show error} // handled validation in the html only

            let xmlHttpReq = new XMLHttpRequest();
            let requestObj = {
                "type": req_type,
                "email": inpEmail,
                "pswd": inpPaswd
            };
            let request_string = "req=" + JSON.stringify(requestObj);

            // noinspection UnnecessaryLocalVariableJS
            let onReadyStateChange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    console.log(`response\n\n${this.response}\n\n`);
                    let responseObj = JSON.parse(this.response);
                    console.log(responseObj);


                    if(responseObj["success"]===true){
                        let id = responseObj["id"];
                        localStorage.setItem(KEY_USER_ID,id);
                        console.log("setted key successfully:"+localStorage.getItem(KEY_USER_ID))
                    }
                    setTimeout(()=>{window.location.reload();},100);

                }
            };
            xmlHttpReq.onreadystatechange = onReadyStateChange;
            xmlHttpReq.open("POST", "backend/ReqReciever.php");
            xmlHttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttpReq.send(request_string);


        }



    }
    let formLogin = document.forms.namedItem("id_form_login");
    let tagInpLoginEmail = document.getElementById("id_email");
    let tagInpLoginPaswd = document.getElementById("id_password");

    attachActionsToForm("login",formLogin,tagInpLoginEmail,tagInpLoginPaswd);

    let formReg = document.forms.namedItem("id_form_signup");
    let tagInpRegEmail = document.getElementById("id_reg_email");
    let tagInpRegPaswd = document.getElementById("id_reg_pass");
    let tagInpRegPswd2 = document.getElementById("id_reg_pass2");
    let tagSpanPswdMatchOutput =document.getElementById("id_sp_pswd_match_res");
    attachActionsToForm("sign_up",formReg,tagInpRegEmail,tagInpRegPaswd,tagInpRegPswd2,tagSpanPswdMatchOutput);





}

function handleNotesPage() {

}

window.onload = () => {

    if (localStorage.getItem(KEY_USER_ID) === null) {
        //login_verifier has ensured that our user is in login page at this point, so perform login related actions
        handleLoginPage()
    } else {
        //login_verifier has ensured that our user is in notes page at this point, so perform login related actions
        handleNotesPage();
    }

    localStorage.removeItem(KEY_USER_ID)

};



