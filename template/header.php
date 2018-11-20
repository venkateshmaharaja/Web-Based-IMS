<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">SVA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"><i class="fa fa-home">&nbsp;</i>  Home   <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown_purchase" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          &nbsp;
          <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
          Pruchase
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="purchase_entry.php">Purchase Entry</a>
            <a class="dropdown-item" href="manage_purchase_details.php">Purchase Details</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="manage_purchase_report.php">Purchase Report</a>
          </div>
        </li> 
        &nbsp;
        &nbsp;
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown_sales" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          &nbsp;
          <i class="fa fa-cart-plus" aria-hidden="true"></i>
          Sales
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="sales_entry.php">Sales Entry</a>
            <a class="dropdown-item" href="manage_sales_details.php">Sales Details</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="manage_sales_report.php">Sales Report</a>
          </div>
        </li> 
        &nbsp;
        &nbsp;
        &nbsp;
      <li class="nav-item">
        <a class="nav-link" href="#" align="right"><i class="fa fa-user">&nbsp;</i>Logout</a>
      </li>
    </ul>
  </div>
</nav>