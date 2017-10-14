//Set SideBar app icon when toggle
$MENU_TOGGLE.on('click', function () {
    if ($BODY.hasClass('nav-md')) {
        $('#homeBarImage').attr("src","images/logo.png");
    }
    else{
        $('#homeBarImage').attr("src","images/logo.png");
    }
});
