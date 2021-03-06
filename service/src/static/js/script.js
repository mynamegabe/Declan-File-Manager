var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4)))
{
    isMobile = true;
}

if (isMobile == true) {
  $("#form-div").scroll(function() {
    var scrolled = $("#form-div").scrollLeft();
    if (scrolled > 270) {
      signupForm_loose();
    } else if (scrolled < 270){
      loginForm_loose()
    }
  });
}

function checkHeight() {
  if (window.innerHeight < 1322) {
    var newheight = String((window.innerHeight - $(".center").height())/2) + "px"
    $(".center").css("padding-top",newheight)
    //console.log(String((window.innerHeight - $(".center").height())/6) + "px");
  }
}

document.getElementById("get-directory").value = $("#dir").text()

$("#search-button").click(function() {
  $("#search-form").submit();
})

$(".folder").click(function() {
  var dir = document.getElementById("currentdirectory").value
  if (dir == "/") {
    document.getElementById("get-directory").value = "/" + $(this).text()
  } else {
    document.getElementById("get-directory").value = document.getElementById("currentdirectory").value + "/" + $(this).text()
  }
  $("#file-form").submit();
})


$('.file, .notActive').click(function () {
  var req = new XMLHttpRequest();
  req.open("POST", "loadfile.php", true);
  req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var filename = $(this).text()
  var filedir = "filedir=" + document.getElementById("get-directory").value + "/" + filename
  req.send(filedir);
  req.onload = function() {
    resp = req.responseText
    var title = document.createElement("h2")
    title.setAttribute("id", "item-filename");
    title.setAttribute("style", "color:black;margin:10px;margin-left:10px;");
    title.innerText = filename
    if (resp.endsWith(".jpg") || resp.endsWith(".png")) {
      image = new Image();
        image.src = req.responseText
        image.onload = function () {
            $('#file-container').empty().append(title);
            $('#file-container').append(image);
        };
        image.onerror = function () {
            $('#file-container').empty().html('The image is not available.');
        }

        $('#image-holder').empty().html('Loading...');
        itemOpen()
        return false;
    } else if (resp.endsWith(".txt")){
      var filereq = new XMLHttpRequest();
      filereq.open('GET', req.responseText);
      filereq.onreadystatechange = function() {
        textdoc = document.createElement("p");
        textdoc.innerText = filereq.responseText;
        $('#file-container').empty().append(title);
        $('#file-container').append(textdoc);
      }
      filereq.send();
      itemOpen()
    } else if (resp.endsWith(".mp4")) {
      var video = $('<video />', {
        id: 'item-video',
        src: resp,
        type: 'video/mp4',
        controls: true
      });
      $('#file-container').empty().append(title);
      video.appendTo($('#file-container'));
      itemOpen()
    }
  }
});

document.getElementById("currentdirectory").value = document.getElementById("get-directory").value

$('.file').hover(function() {
  var context = $(this).children()[0]
  $(context).css("opacity","1");
}, function() {
  var context = $(this).children()[0]
  $(context).css("opacity","0");
})

$('.context-button').hover(function() {
  $(this).parent().toggleClass("notActive").off('click');
}, function() {
  $(this).parent().toggleClass("notActive");
  $('.file, .notActive').click(function () {
    var req = new XMLHttpRequest();
    req.open("POST", "loadfile.php", true);
    req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var filename = $(this).text()
    var filedir = "filedir=" + document.getElementById("get-directory").value + "/" + filename
    req.send(filedir);
    req.onload = function() {
      resp = req.responseText
      var title = document.createElement("h2")
      title.setAttribute("id", "item-filename");
      title.setAttribute("style", "color:black;margin:10px;margin-left:10px;");
      title.innerText = filename
      if (resp.endsWith(".jpg") || resp.endsWith(".png")) {
        image = new Image();
          image.src = req.responseText
          image.onload = function () {
              $('#file-container').empty().append(title);
              $('#file-container').append(image);
          };
          image.onerror = function () {
              $('#file-container').empty().html('The image is not available.');
          }

          $('#image-holder').empty().html('Loading...');
          itemOpen()
          return false;
      } else if (resp.endsWith(".txt")){
        var filereq = new XMLHttpRequest();
        filereq.open('GET', req.responseText);
        filereq.onreadystatechange = function() {
          textdoc = document.createElement("p");
          textdoc.innerText = filereq.responseText;
          $('#file-container').empty().append(title);
          $('#file-container').append(textdoc);
        }
        filereq.send();
        itemOpen()
      } else if (resp.endsWith(".mp4")) {
        var video = $('<video />', {
          id: 'item-video',
          src: resp,
          type: 'video/mp4',
          controls: true
        });
        $('#file-container').empty().append(title);
        video.appendTo($('#file-container'));
        itemOpen()
      }
    }
  });
});

$('.file-context-button').click(function ( event ) {
  if ($(this).siblings().is($('.fav-logo'))) {
    $('.file-context-fav-switch').attr('id','file-context-unfav')
    document.querySelector('.file-context-fav-switch').innerHTML = "<img src='static/images/icons/favourite.png' id='fav-context-img'/>Unfavourite"


    $('.file-context-fav-switch').off('click')
    $('.file-context-fav-switch').click(function() {
      var req = new XMLHttpRequest();
      req.open("POST", "unfavfile.php", true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      var query = "currentdirectory=" + document.getElementById("get-directory").value + "&filename=" + document.getElementById("use-filename").innerText
      req.send(query);
      req.onload = function() {
        if (getCookie("Success")=="True") {
          //alert("File favourited")
          document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
        } else {
          //alert("Error in file favouriting")
          document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
        }
        location.reload();
      }
    })


  } else {
    $('.file-context-fav-switch').attr('id','file-context-fav')
    document.querySelector('.file-context-fav-switch').innerHTML = "<img src='static/images/icons/nofavourite.png' id='fav-context-img'/>Favourite"

    $('.file-context-fav-switch').off('click')
    $('.file-context-fav-switch').click(function() {
      var req = new XMLHttpRequest();
      req.open("POST", "favfile.php", true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      var query = "currentdirectory=" + document.getElementById("get-directory").value + "&filename=" + document.getElementById("use-filename").innerText
      req.send(query);
      req.onload = function() {
        if (getCookie("Success")=="True") {
          //alert("File favourited")
          document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
        } else {
          //alert("Error in file favouriting")
          document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
        }
        location.reload();
      }
    })


  }
  fileContextOpen()
  $("#file-context-menu").css("display","block");
  $("#file-context-menu").css("left",event.pageX);
  $("#file-context-menu").css("top",event.pageY);
  document.getElementById("use-filename").innerText=$($(this).parent()).text()
  $(this).parent().addClass("del")
  var left = event.pageX;
  var right = event.pageY;
})

$('#file-context-popup').click(function() {
  fileContextClose()
  fileMoveClose()
  $("#file-context-menu").css("display","none");
})

$("#file-context-menu").hover(function() {
  $('#file-context-popup').off('click')
}, function() {
  $('#file-context-popup').click(function() {
    fileContextClose()
    fileMoveClose()
    $("#file-context-menu").css("display","none");
  })
})

$('#file-context-duplicate').click(function() {
  var req = new XMLHttpRequest();
  req.open("POST", "duplicatefile.php", true);
  req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var query = "currentdirectory=" + document.getElementById("get-directory").value + "&filename=" + document.getElementById("use-filename").innerText
  req.send(query);
  req.onload = function() {
    if (getCookie("Success")=="True") {
      location.reload();
      document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    } else {
      alert("Error in file duplication.")
      document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    }
  }
})

$('#file-context-delete').click(function() {
  document.querySelector("#file-delete-div h3 span").innerText = " " + document.getElementById("use-filename").innerText
  $('#file-context-delete-confirm-box').css('display','block')
})

$('#file-context-delete-confirm').click(function() {
  var req = new XMLHttpRequest();
  req.open("POST", "deletefile.php", true);
  req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var query = "currentdirectory=" + document.getElementById("get-directory").value + "&filename=" + document.getElementById("use-filename").innerText
  req.send(query);
  req.onload = function() {
    if (getCookie("Success")=="True") {
      $(".del").remove()
      document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    } else {
      alert("Error in file deletion")
      $(".del").removeClass("del")
      document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    }
    deleteFileClose()
  }
})

$('#file-context-move').click(function() {
  fileMoveOpen()
  var offset = $("#file-context-menu").offset();
  $("#move-menu").css("left",offset.left - $(window).scrollLeft());
  $("#move-menu").css("top",offset.top - $(window).scrollTop());
})



$("#add-folder-button").click( function() {
  var req = new XMLHttpRequest();
  req.open("POST", "addfolder.php", true);
  req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var query = "currentdirectory=" + document.getElementById("get-directory").value + "&foldername=" + document.getElementById("foldername").value
  req.send(query);
  req.onload = function() {
    addFolderClose()
    location.reload()
  }
})

$(".move-menu-option").click(function() {
  var newdir = $(this).data("dir")
  var parent = $(this).text()
  $("#dir-to-move-to").val( function() {
    return newdir
  })

  if ($(this).parent().hasClass("top-level")) {
    var allmid = document.querySelectorAll(".mid-level > .move-menu-option")
    allmid.forEach(function(mid) {
      mid.style.display = "none";
      if (mid.dataset.parent == parent) {
        mid.style.display = "block"
      }
    })
    $("#levels-container").scrollLeft(256)
  } else if ($(this).parent().hasClass("mid-level")) {
    var alllow = document.querySelectorAll(".low-level > .move-menu-option")
    alllow.forEach(function(low) {
      low.style.display = "none";
      if (low.dataset.parent == parent) {
        low.style.display = "block"
      }
    })
    $("#levels-container").scrollLeft(506)
  }
})

$("#move-menu-back").click(function() {
  if ($("#levels-container").scrollLeft()<300) {
    $("#levels-container").scrollLeft(0)
  } else if ($("#levels-container").scrollLeft()>300) {
    $("#levels-container").scrollLeft(256)
  }
})

$("#move-menu-select").click(function() {
  var req = new XMLHttpRequest();
  req.open("POST", "movefile.php", true);
  req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var query = "destination=" + document.getElementById("dir-to-move-to").value + "&currentdirectory=" + document.getElementById("currentdirectory").value + "&filename=" + document.getElementById("use-filename").innerText
  req.send(query);
  req.onload = function() {
    if (getCookie("Success")=="True") {
      document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    } else {
      //alert("Error in file moving")
      alert(req.responseText)
      document.cookie = "Success= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    }
    fileMoveClose()
    location.reload()
  }
})

$("#file-context-download").click(function() {
  var query = "?currentdirectory=" + document.getElementById("currentdirectory").value + "&filename=" + document.getElementById("use-filename").innerText
  document.location.href = "downloadfile.php" + query;
})


var dirobj = document.getElementById("dir")
var dirtext = dirobj.innerText
var count = (dirtext.match(/\//g) || []).length
var objectlist = []
$("#dir").empty()

var dirs = dirtext.split('/')
while (dirs.includes("")) {
  dirs.splice(dirs.indexOf(""),1)
}

if (count >= 1 && dirtext.length > 0) {
  var rootspan = document.createElement("span")
  rootspan.classList.add('direct')
  rootspan.innerText="/"
  $("#dir").append(rootspan)

  var dircount = 0
  var dirlen = dirs.length
  dirs.forEach(function(dir){
    if (dircount != dirlen - 1) {
      var span = document.createElement("span")
      span.classList.add('direct')
      span.innerText=dir
      $("#dir").append(span)
      $("#dir").append("/")
    } else {
      $("#dir").append(dir)
    }
  })
  //dirobj.removeChild(dirobj.lastChild)
}

$(".direct").click(function(){
  var parent = $(this).parent()
  var children = $(parent).children()
  var pos = $('.direct').index(this)
  var dir = ""
  var len = $(this).text().length
  for (i=0;i<pos+len;i++) {
    dir += $(children[i]).text()
  }
  document.getElementById("get-directory").value = dir
  $("#file-form").submit();
})
