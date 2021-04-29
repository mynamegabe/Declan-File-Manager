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
