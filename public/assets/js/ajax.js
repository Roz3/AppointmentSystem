$(document).ready(function() {
    // Handle click on sidebar or navbar
    $('#sidebar, #navbar').on('click', function(event) {
      event.preventDefault();
      var url = $(this).attr('href');
      // Make AJAX request
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        success: function(data) {
          // Update content of page
          $('#content').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log('Error: ' + errorThrown);
        }
      });
    });
  });
  