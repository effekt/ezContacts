$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

$('a[title="Delete"]').click(function(event) {
  if (!confirm("Are you sure you'd like to delete this contact?"))
    event.preventDefault();
});

$(function(){
    $("#searchSubmit").click(function(){
        document.location.href = $("#searchForm").attr("action") + $("#search").val();
        return false;
    });
});

function fixContacts() {
    var contactsInRow = 0;

    $('.min-size').each(function() {
        $(this).removeClass('clear');
    });

    $('.min-size').each(function() {
        if($(this).prev().length > 0) {
            if($(this).position().top != $(this).prev().position().top) return false;
            contactsInRow++;
        }
        else {
            contactsInRow++;
        }
    });

    $('div.min-size').filter(function(i) {
        return (i % contactsInRow == 0);
    }).addClass('clear');
}

$(window).resize(function() {
    fixContacts();
});

$(document).ready(fixContacts());