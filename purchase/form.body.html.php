<fieldset>
  <form method="POST">
  	<table class="purchase_add_edit" oninput="linetotal.value = parseInt(qty.value) * parseFloat(price.value)" >
  		<caption>Purchase order details:</caption>
    	<tr>
        <th scope="col"><!-- Select --></th>
        <th scope="col">Line</th>
        <th scope="col">Job No</th>
        <th scope="col">Part Number</th>
        <th scope="col">Quantity</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Line Total</th>
        <th scope="col">Status</th>
      </tr>
      <tr>
        <td center>
          <input type="radio" name="select" value="<?php echo $reading['id']; ?>"></input></td>
        <td class="select"> 
          <input name="line" id="line" value="<?php echo $reading['line']; ?>"></td>
        <td class="select"> 
          <input name="job" id="jab" value="<?php echo $reading['job']; ?>"</td>
        <td>
          <select name="partnumber" id="partnumber">
            <!-- <option value=""></option> -->
              <?php foreach ($partnumbers as $partnumber): ?>
                <option value="<?php htmlout($partnumber['id']); ?>"><?php htmlout($partnumber['partnumber']); ?></option>
              <?php endforeach; ?>
          </select>
        </td>
        <td>                
          <input name="qty" id="qty" value="<?php echo $reading['qty']; ?>">
        </td>
        <td>
          <input name="price" id="price" value="<?php echo $reading['price']; ?>"></td>
        <td>
          <input name="linetotal" id="linetotal"></td>
        <td>
          <input name="status" id="status" value="<?php echo $reading['status'];?>"></td>
      </tr>
  	</table>
  </form>
</fieldset>