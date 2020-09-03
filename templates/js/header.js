class Header{
    setUserInfo(response){
        // got Sign Up / Login if user is not already logged in else their respected name
        this.$userInfo = response;
    }
    createHeader() {
        let $parentTag = document.getElementsByTagName('header')[0];
        let $element = document.createElement('div');
        let $row = $parentTag.appendChild($element);
        $element.setAttribute('class', 'row');
        if (screenWidth() < 957) {
            $element = document.createElement('div');
            $element.setAttribute('class', 'col-sm-12');
            $row.appendChild($element);
            $element.setAttribute('id', 'name_of_website');
            $element.innerHTML = '<i class="ion-android-apps sidebarIcon"></i>' + '<a href="edit"><i class="ion-create" title="Write your own blog" id="edit"></i></a><input form="search" title = "Search any anime blog" class="menubarSearch" type="text" placeholder="Search..." name="search" required> ';
        } else {
            $element = document.createElement('div');
            $row.appendChild($element);
            $element.setAttribute('class', 'col-sm-4 text-center');
            $element.setAttribute('id', 'name_of_website');
            $element.innerText = 'MasterOtaku';
            $element = document.createElement('div');
            $parentTag = $row.appendChild($element);
            $element.setAttribute('class', 'col-sm-8');

            $element = document.createElement('div');
            $parentTag.appendChild($element);
            $element.setAttribute('id', 'options');
            $element.innerHTML = '<a href="home"><span title = "Animsia" class="menu_div">Home</span></a><a href="joinus"><span title= "Manga,Anime,Light noval,Action anime etc." class="menu_div">About</span></a>';
            $element.innerHTML += this.$userInfo + '<input form="search" title = "Search any anime blog" id="top_searchbar" type="text" placeholder="Search..." name="search" required><a href="edit"><i class="ion-create" title="Write your own blog" id="edit"></i></a>';
        }
    }
    appendHeader(){
        let $headerTag = document.getElementsByTagName('header')[0];
        $headerTag.removeChild($headerTag.childNodes[0]); // removing the menu bar
        this.createHeader(); // creating the menu bar again
    }
}
/*Controller Section
* ==================*/
function createMenuBar(){
    let $xhttp = new XMLHttpRequest();
    $xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200){
            const $header = new Header();
            $header.setUserInfo(this.response); // setting the response in the Header class
            let $currentWidth = screenWidth(); // getting the current screen size
            let $mobile; // setting a variable mobile which will be used to check if user is on mobile or PC
            window.onresize = function () {
                // checking user is on PC or mobile
                if ($currentWidth < 957)
                    $mobile = true; // on mobile
                else
                    $mobile = false;// on PC
                if ($mobile) {
                    if (screenWidth() > 957)
                        $header.appendHeader() // size changes from mobile to PC than menu bar changes
                }else{
                    if (screenWidth() < 957)
                        $header.appendHeader() // size changes from PC to mobile than menu bar changes
                }
                $currentWidth = screenWidth();
            }; // if screen size changes, change the menu bar
            $header.createHeader()// creating the menu bar as per ajax request
        }
    };
    $xhttp.open("GET", "fetchuser", true);
    $xhttp.send();
}