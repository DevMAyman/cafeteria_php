$(".container1").on("click", ".fa-plus", function () {
  let productId = $(this).data("product-id");

  let quantityElement = $(this).closest("tr").find("h5");
  let currentQuantity = parseInt(quantityElement.text(), 10);
  let newQuantity = currentQuantity + 1;

  quantityElement.text(newQuantity);

  $.ajax({
    url: "../controller/update_order_item_quantity.php",
    type: "POST",
    data: {
      product_id: productId,
      quantity: newQuantity,
      operation: "increment",
    },
    success: function (response) {
      if (response.status === "success") {
        console.log("Quantity incremented:", response);
      } else {
        console.error("Error incrementing quantity:", response);
      }
    },
    error: function () {
      console.error("Error during AJAX request.");
    },
  });
});

$(".container1").on("click", ".fa-minus", function () {
  let productId = $(this).data("product-id");
  // console.log("decrement===>", productId);

  let quantityElement = $(this).closest("tr").find("h5");
  let currentQuantity = parseInt(quantityElement.text(), 10);

  if (currentQuantity > 1) {
    let newQuantity = currentQuantity - 1;

    quantityElement.text(newQuantity);
    $.ajax({
      url: "../controller/update_order_item_quantity.php",
      type: "POST",
      data: {
        product_id: productId,
        quantity: newQuantity,
        operation: "decrement",
      },
      success: function (response) {
        if (response.status === "success") {
          // console.log("Quantity decremented:", response);
        } else {
          // console.error("Error decrementing quantity:", response);
        }
      },
      error: function () {
        console.error("Error during AJAX request.");
      },
    });
  } else {
    console.warn("Cannot decrease quantity below 1.");
  }
});

$(document).ready(function () {
  $(".container1").on("click", ".fa-trash", function () {
    let productId = $(this).data("product-id");

    $(this).closest("tr").remove();

    $.ajax({
      url: "../controller/delete_order_item.php",
      type: "POST",
      data: {
        product_id: productId,
      },
      success: function (response) {
        if (response.status === "success") {
        } else {
          $(".cardcontainer")
            .filter(function () {
              return $(this).data("product-id") == productId;
            })
            .removeClass("disabled");
          if ($(".container1 tbody").children("tr").length === 0) {
            $(".order-div").hide(); 
          }
        }
      },
      error: function (xhr, status, error) {
        console.error("Error during AJAX request:", status, error);
      },
    });
  });
});
