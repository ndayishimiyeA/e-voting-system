/*================================================================================
  Item Name: INTORE VOTING SYSTEM
  Version: 0.0.1
  Author: NDAYISHIMIYE ALAIN
================================================================================*/
$(function() {

    "use strict";

    var currentPage = window.location.href;
    var segments = currentPage.split('/');
    var lastSegment = segments.pop();

    var window_width = $(window).width();

    /*Preloader*/
    $(window).load(function() {
        setTimeout(function() {
            $('body').addClass('loaded');
        }, 200);
    });

    $('.show-search').click(function() {
        $('.search-out').fadeToggle("50", "linear");
    });

    // Check first if any of the task is checked
    $('#task-card input:checkbox').each(function() {
        checkbox_check(this);
    });

    // Task check box
    $('#task-card input:checkbox').change(function() {
        checkbox_check(this);
    });

    // Check Uncheck function
    function checkbox_check(el) {
        if (!$(el).is(':checked')) {
            $(el).next().css('text-decoration', 'none'); // or addClass            
        } else {
            $(el).next().css('text-decoration', 'line-through'); //or addClass
        }
    }

    /*----------------------
    * Plugin initialization
    ------------------------*/

    // Materialize Slider
    $('.slider').slider({
        full_width: true
    });

    // Materialize Dropdown
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 125,
        constrain_width: true, // Does not change width of dropdown to that of the activator
        hover: false, // Activate on click
        alignment: 'left', // Aligns dropdown to left or right edge (works with constrain_width)
        gutter: 0, // Spacing from edge
        belowOrigin: true // Displays dropdown below the button
    });

    // Materialize Tabs
    $('.tab-demo').show().tabs();
    $('.tab-demo-active').show().tabs();

    // Materialize Parallax
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();

    // Materialize scrollSpy
    $('.scrollspy').scrollSpy();

    // Materialize tooltip
    $('.tooltipped').tooltip({
        delay: 50
    });

    // Materialize sideNav  

    //Main Left Sidebar Menu
    $('.sidebar-collapse').sideNav({
        edge: 'left', // Choose the horizontal origin      
    });

    //Main Left Sidebar Chat
    $('.chat-collapse').sideNav({
        menuWidth: 240,
        edge: 'right',
    });
    $('.chat-close-collapse').click(function() {
        $('.chat-collapse').sideNav('hide');
    });
    $('.chat-collapsible').collapsible({
        accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    // Pikadate datepicker
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    // Perfect Scrollbar
    $('select').not('.disabled').material_select();
    var leftnav = $(".page-topbar").height();
    var leftnavHeight = window.innerHeight - leftnav;
    $('.leftside-navigation').height(leftnavHeight).perfectScrollbar({
        suppressScrollX: true
    });
    var righttnav = $("#chat-out").height();
    $('.rightside-navigation').height(righttnav).perfectScrollbar({
        suppressScrollX: true
    });

    // Fullscreen
    function toggleFullScreen() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
            (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
    }

    $('.toggle-fullscreen').click(function() {
        toggleFullScreen();
    });

    // Floating-Fixed table of contents (Materialize pushpin)
    if ($('nav').length) {
        $('.toc-wrapper').pushpin({
            top: $('nav').height()
        });
    } else if ($('#index-banner').length) {
        $('.toc-wrapper').pushpin({
            top: $('#index-banner').height()
        });
    } else {
        $('.toc-wrapper').pushpin({
            top: 0
        });
    }

    // Toggle Flow Text
    var toggleFlowTextButton = $('#flow-toggle')
    toggleFlowTextButton.click(function() {
        $('#flow-text-demo').children('p').each(function() {
            $(this).toggleClass('flow-text');
        })
    });


    //Toggle Containers on page
    var toggleContainersButton = $('#container-toggle-button');
    toggleContainersButton.click(function() {
        $('body .browser-window .container, .had-container').each(function() {
            $(this).toggleClass('had-container');
            $(this).toggleClass('container');
            if ($(this).hasClass('container')) {
                toggleContainersButton.text("Turn off Containers");
            } else {
                toggleContainersButton.text("Turn on Containers");
            }
        });
    });

    // Detect touch screen and enable scrollbar if necessary
    function is_touch_device() {
        try {
            document.createEvent("TouchEvent");
            return true;
        } catch (e) {
            return false;
        }
    }
    if (is_touch_device()) {
        $('#nav-mobile').css({
            overflow: 'auto'
        })
    }

    //LINE CHART WITH AREA IN SIDEBAR
    // new Chartist.Line('#ct2-chart', {
    //     labels: [1, 2, 3, 4, 5, 6, 7, 8],
    //     series: [
    //         [5, 9, 7, 8, 5, 3, 5, 4]
    //     ]
    // }, {
    //     low: 0,
    //     showArea: true
    // });

    //Trending chart for small screen
    if (window_width <= 480) {
        $("#trending-line-chart").attr({
            height: '200'
        });
    }

    //FEILD CHECKER FOR VOTING FORM

    if (lastSegment == 'vote' || lastSegment == 'vote#!') {
        $('#votingForm').find('table').each(function() {
            var divId = $(this).attr('id');
            $("#" + divId + " input[type=radio]").removeAttr('name');
            $("#" + divId + " input[type=radio]:not(:checked)").data('waschecked', false);
            $("#" + divId + " input[type=radio]:checked").data('waschecked', true);
            $("#" + divId + " input[type=radio]").on('click', (e) => {
                var $radio = $(e.target);

                // if this was previously checked
                if ($radio.data('waschecked') == true) {
                    $radio.prop('checked', false);
                    $radio.data('waschecked', false);
                } else {
                    $radio.prop('checked', true);
                    $radio.data('waschecked', true);
                }

            });
        })
    }
    $("#votingForm").submit(function(e) {
        var error_msg = '';
        var i = 0;

        $('#votingForm input[type="radio"]:checked').each(function() {
            var key = $(this).attr('data-name');
            var value = $(this).val();
            $(this).append('<input type="hidden" name="' + key + '" value="' + value + '" />');
        });


        $('#votingForm .candidate-list').each(function(index) {
            var id = $(this).attr('id');
            var candi = ((id.split('_').join(' ')).split(' ').slice(-1)[0]);
            if (candi == 'Female') {
                candi = "w'umugore"
            } else {
                candi = "w'umugabo"
            }

            if ($('#' + id + ' input:radio:checked').length < 1) {
                error_msg += ("<i class='mdi-alert-error prefix' style='font-size: 14px;'></i> Hitamo umukandida " + candi + ".<br/>");
                i++;
            }
        })

        if (i != 0) {
            $('#vote_error_modal').openModal();
            $("#vote_error").html(error_msg);
            e.preventDefault();
        } else {

            if ($('#Position_Female input[type="radio"]:checked').length < 6) {
                error_msg += ("<i class='mdi-alert-error prefix' style='font-size: 14px;'></i>Hitamo byibuze abakandida <b>batandatu babagore</b>.<br/>");
                $('#vote_error_modal').openModal();
                $("#vote_error").html(error_msg);
                e.preventDefault();

            } else if ($('#votingForm input[type="radio"]:checked').length != 20) {
                error_msg += ("<i class='mdi-alert-error prefix' style='font-size: 14px;'></i>Wahisemo aba kandida babagore <span class='erro_count'>" + $('#Position_Female input[type="radio"]:checked').length + "</span> naba kandida babagabo <span class='erro_count'>" + $('#Position_Male input[type="radio"]:checked').length + "</span>. Hitamo abakandida makunyambiri kugirango wemeze amajwi. <br/>");
                $('#vote_error_modal').openModal();
                $("#vote_error").html(error_msg);
                e.preventDefault();
            } else {
                e.currentTarget.submit();
            }

            e.preventDefault();
        }

        $("#votingForm input[type=radio]").empty();
    })

    //TIMER AND REDIRECT 
    var redirect_countdown = 5;

    function updateTimer() {
        redirect_countdown--;
        $('#redirect-countdown').text(redirect_countdown);
        if (redirect_countdown === 0) {
            window.location.href = '/voting';
            clearInterval(timer);
        }
    }
    if (lastSegment == 'success' || lastSegment == 'error') {
        var timer = setInterval(updateTimer, 1000);
    } else {

    }
}); // end of document ready