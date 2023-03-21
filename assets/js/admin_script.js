/*================================================================================
  Item Name: INTORE VOTING SYSTEM ADMIN SCRIPT
  Version: 0.0.1
  Author: NDAYISHIMIYE ALAIN
================================================================================*/
$(function() {
    "use strict";


    $('.message-div').delay(5000).fadeOut();

    // SHOW HIDE PASSWORD
    var clicked = 0;

    $(".toggle-password").click(function(e) {
        e.preventDefault();

        $(this).toggleClass("toggle-password");
        if (clicked == 0) {
            $(this).html('<span class="material-icons">visibility_off</span >');
            clicked = 1;
        } else {
            $(this).html('<span class="material-icons">visibility</span >');
            clicked = 0;
        }

        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });


    // CLEAR FORM
    var currentPage = window.location.href;
    var segments = currentPage.split('/');
    var lastSegment = segments[segments.length - 1];



    if (lastSegment != '') {
        if (lastSegment == 'login') {
            setTimeout(function() {
                $('form').each(function() {
                    this.reset()
                })
            }, 1000);
        }
    } else {
        lastSegment = segments[segments.length - 2]
        if (lastSegment == 'login') {
            setTimeout(function() {
                $('form').each(function() {
                    this.reset()
                })
            }, 1000);
        }
    }

    //CREATE NEW USER
    $("#create-admin-user").click(function() {
        $('#new-admin-user-modal').openModal();
        setTimeout(function() {
            $('form').each(function() {
                this.reset()
            })
        }, 1000);

        $("#submit-admin-user").click(function() {
            $("#add-admin-Form").submit();
        })


    });


    //MODAL CLICKS
    $("#admin-reset-user-password-Modal").click(function() {
        $('#resetModal').openModal();
    });
    $("#admin-delete-user-Modal").click(function() {
        $('#deleteModal').openModal();
    });

    $("#admin-generate-voting-code-Modal").click(function() {
        $('#generateModal').openModal();
    });
    $("#admin-delete-candidate-Modal").click(function() {
        $('#deleteModal').openModal();
    });

    $("#clear-votes-modal").click(function() {
        $('#clearVote').openModal();
    });

    $("#reset-settings-modal").click(function() {
        $('#resetDefault').openModal();
    });

    $("#update-segment").click(function() {
        {
            $($(this).attr('name')).openModal();
        }
    });
    $("#delete-segment").click(function() {
        {
            $($(this).attr('name')).openModal();
        }
    });



    //-----------------------------------------------------------


    $('#download-csv').click(function() {
        // Get the table data
        var tableData = [];
        $('#results-table tr').each(function(row, tr) {
            tableData[row] = [];
            $(tr).find('td:not(:last-child), th:not(:last-child)').each(function(cell, td) {
                tableData[row][cell] = $(td).text();
            });
        });
        // Create the CSV file
        var csvContent = "data:text/csv;charset=utf-8,";
        tableData.forEach(function(infoArray, index) {
            var dataString = infoArray.join(",");
            csvContent += index < tableData.length ? dataString + "\n" : dataString;
        });
        // Download the CSV file
        var currentDate = new Date();
        var file_name = 'rpf_vote_count_' + currentDate.toLocaleDateString('en-US');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", file_name + ".csv");
        document.body.appendChild(link); // Required for FF
        link.click(); // This will download the data file named "my_data.csv".
    });


}); // end of document ready