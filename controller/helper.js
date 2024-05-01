$(document).ready(function () {
  $(".cardcontainer").on("click", function () {
    if ($(this).hasClass("disabled")) {
      return;
    }

    let productId = $(this).data("product-id");

    $(this).addClass("disabled");

    $(".order-div").show();
    let productName = $(this).find(".txt4").text();
    let productImage = $(this).find("img").attr("src");
    let productPrice = $(this)
      .find(".price")
      .text()
      .replace("Price:", "")
      .trim();
    let productQuantity = 1;

    let orderNotes = $("#customer_notes").val();

    $.ajax({
      url: "../controller/add_to_order.php",
      type: "POST",
      data: {
        product_id: productId,
        quantity: productQuantity,
        product_price: productPrice,
        notes: orderNotes,
      },
      success: function (response) {
        let jsonParts = response.match(/{[^}]*}/g);
        let orderItem = JSON.parse(jsonParts[0]);
        let productId = orderItem.product_id;

        if (response) {
          updateOrderDisplay(
            productName,
            productImage,
            productQuantity,
            productPrice,
            productId
          );
        } else {
          console.log("Error adding product to order.");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      },
    });
  });

  function updateOrderDisplay(name, image, quantity, price, productId) {
    let newRow = `
        <tr>
          <td colspan="5" class="p-2 bg-white mt-4 rounded">
            <div class="d-flex flex-row align-items-center">
              <div class="mr-1 product-item">
                <img class="rounded" src="${image}" width="70" />
              </div>
              <div class="d-flex flex-column align-items-center product-details">
                <span class="font-weight-bold product-item">${name}</span>
              </div>
              <div class="d-flex flex-row align-items-center qty">
                <i style="cursor:pointer;" class="product-item fa fa-minus text-danger" data-product-id="${productId}"></i> <!-- Updated -->
              </div>
              <div class="d-flex flex-row align-items-center qty">
                <h5 class="product-item text-grey mt-1 mr-1 ml-1">${quantity}</h5>
              </div>
              <div class="d-flex flex-row align-items-center qty">
                <i style="cursor:pointer;" class="product-item fa fa-plus text-success" data-product-id="${productId}"></i> <!-- Updated -->
              </div>
              <div class="d-flex align-items-center">
                <i style="cursor:pointer;" class="product-item fa fa-trash text-danger" data-product-id="${productId}"></i>
              </div>
            </div>
          </td>
        </tr>`;
    $(".container1 tbody").find(".order-notes").parent().before(newRow);
  }
});
