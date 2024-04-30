$(document).ready(function() {
  $('#placeOrder').on('click', function() {

      let selectedRoom = $('#rooms').val();
      let orderNotes = $('#customer_notes').val();

      $.ajax({
          url: '../controller/confirm_order.php', 
          type: 'POST',
          data: {
              room_id: selectedRoom,
              notes: orderNotes
          },
          success: function(response) {
            console.log(response);
              if (response.status === 'success') {
                  console.log('Order confirmed:', response.message);
              } else {
                  console.error('Error confirming order:', response.message);
              }
          },
          error: function() {
              console.error("Error during AJAX request.");
          }
      });
  });
});
