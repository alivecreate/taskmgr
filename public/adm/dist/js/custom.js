

$( document ).ready(function() {
    
      $(".category-color span:nth-child(1)").addClass( "bg-primary");
      $(".category-color span:nth-child(2)").addClass( "bg-danger");
      $(".category-color span:nth-child(3)").addClass( "bg-warning");



      
});

$('.on-click-disable').click(function (e) { 
      $(this).hide();
      $('.btn-processing').show();
});

$("textarea").on("input", function() {
      var text = $(this).val();
      var count = (text.match(/(^|\W)(@[a-z\d][\w-]*)/g) || []).length;
      var word = "waffle"
      

      if(text.endsWith("@")){
            // alert(count);
            
      }



      
    }).trigger('input');


// $('.comment_area').keyup(function (e) { 
//       var comment = $(this).val();
//       // alert(comment);

//       if (comment.indexOf('#') !== -1) {
//             alert('@');
//             // Url contains a #
//         }

//       if(comment == '@'){
//             alert('@');
//       }

//       // alert(comment);

// });
