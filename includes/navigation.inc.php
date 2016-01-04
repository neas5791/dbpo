<div id="navigation">
  <ul>
    <li 
      <?php 
        if ($thispage=="home") 
          echo " id=\"currentpage\""; 
      ?>><a href="/">Home</a></li>
    <li
      <?php 
        if ($thispage=="status") 
          echo " id=\"currentpage\""; 
        ?>><a href="/status">Status</a></li>
    <li
      <?php 
        if ($thispage=="type") 
          echo " id=\"currentpage\""; 
        ?>><a href="/type">Type</a></li>
    <li
      <?php 
        if ($thispage=="category") 
          echo " id=\"currentpage\""; 
        ?>><a href="/category">Category</a></li>
    <li
      <?php 
        if ($thispage=="part") 
          echo " id=\"currentpage\""; 
        ?>><a href="/part">Part</a></li>
    <li
      <?php 
        if ($thispage=="supplier") 
          echo " id=\"currentpage\""; 
        ?>><a href="/supplier">Supplier</a></li>
    <li
      <?php 
        if ($thispage=="purchase") 
          echo " id=\"currentpage\""; 
        ?>><a href="/purchase">Purchase</a></li>
  </ul>
</div> <!-- div navigation -->
