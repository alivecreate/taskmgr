<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    /* CSS3 */

/* The whole thing */
.custom-menu {
    display: none;
    z-index: 1000;
    position: absolute;
    overflow: hidden;
    border: 1px solid #CCC;
    white-space: nowrap;
    font-family: sans-serif;
    background: #FFF;
    color: #333;
    border-radius: 5px;
    padding: 0;
}

/* Each of the items in the list */
.custom-menu li {
    padding: 8px 12px;
    cursor: pointer;
    list-style-type: none;
    transition: all .3s ease;
    user-select: none;
}

.custom-menu li:hover {
    background-color: #DEF;
}

    </style>
    <script>

// Customize Right Click
$(document).bind("contextmenu", function (event) {
    
    // Avoid the real one
    // event.preventDefault();
    
    // // Show contextmenu
    // $(".custom-menu").finish().toggle(100).
    
    // // In the right position (the mouse)
    // css({
    //     top: event.pageY + "px",
    //     left: event.pageX + "px"
    // });
});


// If the document is clicked somewhere
$(document).bind("mousedown", function (e) {
    
    // If the clicked element is not the menu
    if (!$(e.target).parents(".custom-menu").length > 0) {
        
        // Hide it
        $(".custom-menu").hide(100);
    }
});


// If the menu element is clicked
$(".custom-menu li").click(function(){
    
    // This is the triggered action name
    switch($(this).attr("data-action")) {
        
        // A case for each action. Your actions here
        case "first": alert("first"); break;
        case "second": alert("second"); break;
        case "third": alert("third"); break;
    }
  
    // Hide it AFTER the action was triggered
    $(".custom-menu").hide(100);
  });

// End Customize Right Click


    </script>
</head>

<body>
    
    <ul class='custom-menu'>
    <li data-action="first">First thing</li>
    <li data-action="second">Second thing</li>
    <li data-action="third">Third thing</li>
    </ul>

</body>
</html>
