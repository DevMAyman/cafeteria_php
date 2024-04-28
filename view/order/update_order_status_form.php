<form action="update_order_status.php" method="post">
    <input type="hidden" name="orderId" value="<?php echo $_GET['orderId']; ?>">
    <label for="newStatus">Select New Status:</label>
    <select name="newStatus" id="newStatus">
        <option value="processing">Processing</option>
        <option value="out_for_delivery">Out for Delivery</option>
        <option value="done">Done</option>
    </select>
    <br><br>
    <input type="submit" value="Update Status">
</form>
