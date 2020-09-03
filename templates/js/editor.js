class View{
    static showValue($array){
        document.getElementsByTagName('textarea')[0].value = $array[0];
        document.getElementById('title').value = $array[1];
    }
}
class Model{
    tags(){
        let $tags = ['#anime', '#manga', '#lightnovel', '#death note', '#one piece','#one punch man','#tokyo ghoul', '#code geass','#dragon ball series','#sword art online' ,'#boku no hero academia',
            '#attack on titan', '#kimi no na wa', '#gintama', '#grand blue', '#fullmetal alchemist: brotherhood', '#steins gate', '#steins;gate', '#hunterxhunter',
            '#hunter hunter','#3-gatsu no lion', '#ginga eiyuu densetsu', '#owarimonogatari', '#clannad', '#spirited Away ', '#sen to chihiro no kamikakushi'];
        localStorage.setItem("tags", JSON.stringify($tags));
    }
    findElementArray($string) {
        let $elements = [];
        let $arr = JSON.parse(localStorage.getItem("tags"));
        for (let $element of $arr) {
            $element= $element.toLowerCase();
            if ($element.startsWith($string))
                $elements.push($element);
        }
        return $elements;
    }
    fetchValue($array = []){
        $array.push(localStorage.getItem("blog"));
        $array.push(localStorage.getItem("title"));
        return $array;
    }
    clearLocalStorage(){
        localStorage.removeItem('blog');
        localStorage.removeItem('title');
        localStorage.removeItem('tags');
    }
}
/* Controller
* ===========*/
createMenuBar();// creating the menu bar fully responsive
const $editor = new Model();
if (localStorage.getItem("tags") !== "")
    $editor.tags();
window.onload = function () {
    View.showValue($editor.fetchValue()); // onload check if user has input something before.
    /*On typing show appropriate tags
    * ==============================*/
    const $tag = document.getElementById('tags');
    $tag.onkeypress = function(){return !(window.event && (event.which === 13)||(event.keyCode === 13));};// if pressed enter than don't submit form
    $tag.onkeyup = function (event) {
        let $value;
        $value = $tag.value;
        $value = $value.substr($value.lastIndexOf('#'));
        let $search = $editor.findElementArray($value); // get tags as per input value
        console.log($search);
        if (event.which === 13||event.keyCode === 13){
            $tag.value = "";
            $tag.value = $tag.value + $search[0] + "#";
        }
    };
    /*Save typed information in local storage
    * =======================================*/
    const $title = document.getElementById('title');
    $title.onkeypress = function(){return !(window.event && (event.which === 13)||(event.keyCode === 13));};// if pressed enter than don't submit form
    $title.onkeyup = function () {
        localStorage.setItem('title',$title.value);
    };
    const $blog = document.getElementsByTagName('textarea')[0]; // blog
    $blog.onkeyup = function () {
        localStorage.setItem('blog',$blog.value);
    };
    // onSubmit clear storage and remove key from hidden input
    document.getElementsByTagName('form')[1].onsubmit = function () {
        $editor.clearLocalStorage();
        let $imagesList =JSON.parse(decodeURIComponent(document.getElementById("hidden").value));
        let $newImageList = [];
        for ($image in $imagesList){
            $newImageList.push($imagesList[$image]);
        }
        document.getElementById("hidden").value = encodeURIComponent(JSON.stringify($newImageList));
    };
    let $modal = document.getElementById('popup');
    document.getElementById('imageIcon').onclick = function(){
        $modal.style.display = 'block';
    };
    window.onclick = function(event) {
        if (event.target === $modal) {
            $modal.style.display = "none";
        }
    }
};
let imageElement = document.getElementById('image');
let thumbnailElement = document.getElementById('thumbnail');
FilePond.setOptions({
    server: {
        process: 'filepondUpload',
        fetch: null,
        revert: null
    }
});
FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateType);
const thumbnail = FilePond.create(thumbnailElement,{
        labelIdle:'Upload Thumbnail'
    });
const image = FilePond.create(imageElement,{
    labelIdle:'Upload Image'
});

let $blogImages = {};
image.onprocessfile = function(error,file){
    $blogImages[file.id] = file.serverId;
    document.getElementById("hidden").value = encodeURIComponent(JSON.stringify($blogImages));
};
image.onremovefile = function (file) {
    delete  $blogImages[file.id];
    document.getElementById("hidden").value = encodeURIComponent(JSON.stringify($blogImages));
};