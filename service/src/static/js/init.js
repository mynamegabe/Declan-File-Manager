function signupForm_loose() {
  $('#form-swapper-slider').css('left','50%')
}

function loginForm_loose() {
  $('#form-swapper-slider').css('left','0px')
}

function signupForm() {
  $('#form-swapper-slider').css('left','50%')
  $("#form-div").scrollLeft(540);
}

function loginForm() {
  $('#form-swapper-slider').css('left','0px')
  $("#form-div").scrollLeft(0);
}

function open() {
  $("#title").css('opacity','1');
  $("#main-logo").css('opacity','1');
  setTimeout( function() {
    $("#full-form").css('height','780px');
  },1400);
  checkHeight()
}

function checkHeight() {
  if (window.innerHeight < 1450) {
    var newheight = String((1450 - window.innerHeight)/2) + "px"
    $(".center").css("padding-top",newheight)
    console.log(newheight);
  }
}

function rushopen() {
  $("#title").css('opacity','1');
  $("#main-logo").css('opacity','1');
  $("#full-form").css('transition','none');
  $("#full-form").css('height','780px');
  checkHeight()
}

function addPopup() {
  $("#add-button-div").css("width","200px")
  $("#add-button-div").css("background-color","#fff8e3")
  $("#add-button").attr("onclick","addPopupClose()")
}
function addPopupClose() {
  $("#add-button-div").css("width","60px")
  $("#add-button-div").css("background-color","#fffffc")
  $("#add-button").attr("onclick","addPopup()")
}

function addFolder() {
  $("#folder-popup").css("display","block")
}

function addFolderClose() {
  $("#folder-popup").css("display","none")
}

function addFile() {
  $("#file-popup").css("display","block")
}

function addFileClose() {
  $("#file-popup").css("display","none")
}

function itemOpen() {
  $("#item-popup").css("display","block")
}

function itemClose() {
  $("#item-popup").css("display","none")
  $('#file-container').empty()
}

function fileContextOpen() {
  $("#file-context-popup").css("display","block")
}

function fileContextClose() {
  $("#file-context-popup").css("display","none")
}

function listFavs(lst) {
  favlist = favlist.split(",")
  files = document.querySelectorAll(".file")
  files.forEach(file => {
    if (favlist.includes(file.innerText)) {
      file.classList.add("fav")
      favlogo = document.createElement("img")
      favlogo.setAttribute("src","static/images/icons/favourite.png")
      favlogo.classList.add("fav-logo")
      file.append(favlogo)
    }
  });

}

function deleteFileClose() {
  $("#file-context-delete-confirm-box").css("display","none")
  $(".del").removeClass("del")
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
