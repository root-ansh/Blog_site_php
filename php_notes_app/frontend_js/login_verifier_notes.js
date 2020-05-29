
function checkIfLoggedInAndContinue_OR_LoadLoginPage() {
    //always called via notes.html page
    console.log("checkIfLoggedInAndContinue_OR_LoadLoginPage :called from notes html");

    let userID = localStorage.getItem(KEY_USER_ID);
    console.log("userid value = "+userID);

    if (userID){}
    else {
        window.location.pathname.replace('notes.html', 'index.html');        //gives /notes.html index.html or nothing :https://stackoverflow.com/a/423385/7500651

    }



}
function checkIfNotLoggedInAndContinue_OR_LoadNotesPage() {
    //always called via index.html page
    console.log("checkIfNotLoggedInAndContinue_OR_LoadNotesPage :called from login html");

    let userID = localStorage.getItem(KEY_USER_ID);
    console.log("userid value = "+userID);
    if(userID!=null){
        window.location.pathname.replace('index.html','notes.html');
    }

    // if (userID === null) {
    //     //continue. weather its a valid id or not will be handled by the app js script
    // } else {
    //
    //     window.location.reload();
    //
    //     // let curr_path = window.location.pathname;                                                    //gives <localhost://> /php_mysql_backend_minis/login_notes_backend/notes.html or index.html or <nothing>
    //     // curr_path = curr_path.replace('index.html', 'notes.html');        //gives /notes.html index.html or nothing :https://stackoverflow.com/a/423385/7500651
    //     // console.log(curr_path);
    //     // window.location.replace(curr_path);
    //
    // }


}

//------------------------------------main-------------------------------------------------------------------------

// if user landed on login page, we have to either show login page or dashboard page based on login key
// if user landed on dashboard page, we have to either show dash (if  login key available) or error page

let curr_path = window.location.pathname;                                                   //gives <localhost://> /php_mysql_backend_minis/login_notes_backend/notes.html or index.html or <nothing>
curr_path = '/' + curr_path.replace(/^.*[\\\/]/, '');              //gives /notes.html index.html or nothing :https://stackoverflow.com/a/423385/7500651
if (curr_path === '/notes.html') {
    checkIfLoggedInAndContinue_OR_LoadLoginPage()
} else {
    checkIfNotLoggedInAndContinue_OR_LoadNotesPage()

}