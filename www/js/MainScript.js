$(document).ready(function() {

  $("#article-languages-en").click(function() {
    
    $("#article-edit-en").show();
    $("#article-edit-ua").hide();
    
    $("#article-languages-en").attr("class", "article-edit-enabled");
    $("#article-languages-ua").attr("class", "article-edit-disabled");
    
  });
  
  $("#article-languages-ua").click(function() {
    
    $("#article-edit-ua").show();
    $("#article-edit-en").hide();
    
    $("#article-languages-ua").attr("class", "article-edit-enabled");
    $("#article-languages-en").attr("class", "article-edit-disabled");
    
  });

  if ($(".article-edit-enabled")) {
    
    $("#article-edit-en").show();
    $("#article-edit-ua").hide();
    
    $("#article-languages-en").attr("class", "article-edit-enabled");
    $("#article-languages-ua").attr("class", "article-edit-disabled");
    
  }
  else {
    
    $("#article-edit-ua").show();
    $("#article-edit-en").hide();
    
    $("#article-languages-ua").attr("class", "article-edit-enabled");
    $("#article-languages-en").attr("class", "article-edit-disabled");
    
  }

  // REGISTRATION VALIDATOR

  $('input:not([type="submit"]):not([type="file"])').unbind().blur( function() {

    var inputName = $(this).attr('name');

    if (inputName == 'login'
        || inputName == 'password'
        || inputName == 'password_2'
        || inputName == 'email') {
    
      if ($(this).val() != '') {
        $(this).removeClass('error');
        $('lable[for="' + inputName + '"]').css('color','green')
               .animate({'marginRight':'20px'}, 40)
               .animate({'marginRight':'0'}, 40);
      }
      else {
        $(this).addClass('error');
        $('lable[for="' + inputName + '"]').css('color','red')
               .animate({'marginRight':'20px'}, 40)
               .animate({'marginRight':'0'}, 40);
      }
    }
  });

  $('#form_user').submit(function(e) {
    if ($('.error').length > 0) {
      e.preventDefault();
      alert('Error! Not all fields are filled!');
    }
  });
})
