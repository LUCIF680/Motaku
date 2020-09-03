/*Setting up Tags
* ===============*/
function setTags(){
    let $tagsDiv = document.getElementsByClassName('tags')[0];
    let $allTags = $tagsDiv.innerHTML;
    $allTags = $allTags.substring(1);
    $allTags = $allTags.split('#');
    for(let $i = 0;$i < $allTags.length ;$i++) {
        if ($allTags[$i] === "") {
            $allTags.splice($i,1);
            $i = $i - 1;
        }
    }
    $tagsDiv.innerHTML = null;
    for ($tag of $allTags) {
        $a = document.createElement('a');
        $a = $tagsDiv.appendChild($a);
        $a.innerText = $tag;
    }
}
/*Setting up Blog contents,images,bold,header etc
* =============================================*/
function setBlogContent(){
    let $blog = document.getElementsByClassName('blogSection')[0];
    $blog.innerHTML = $blog.innerHTML.replace(/\n/gi, "<br>"); // Replacing the \n to <br>
    // Changing @image to <img>
    $blog.innerHTML = addImage($blog.innerHTML,
        document.getElementsByClassName('hiddenServer'));
    // Changing @bold to <b>
    changeToBlod($blog.innerHTML);
    // Changing @header to <h3>
    changeToH3($blog.innerHTML);
}

function getPrevNext() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let $response = JSON.parse(this.responseText);
        document.getElementById("prev").innerHTML = $response[0];
        document.getElementById("prev_a").href = "showblog?id="+$response[1];
        document.getElementById("next").innerHTML = $response[2];
        document.getElementById("next_a").href ="showblog?id="+$response[3];
        
      }
    };
    let $current_id = window.location.href;
    $current_id = $current_id.slice(-1);
    xhttp.open("GET", "get_next_prev?current_id="+$current_id, true);
    xhttp.send();
}

setTags();
try {
    setBlogContent();
    createMenuBar();
    getPrevNext();
}catch (e){  console.log(e);}
