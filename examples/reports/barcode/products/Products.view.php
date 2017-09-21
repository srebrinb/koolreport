<?php
use \koolreport\widgets\koolphp\Table;
use koolreport\barcode\BarCode;
use koolreport\barcode\QRCode;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Barcode Types</title>
    <link rel="stylesheet" href="../../../assets/css/example.css" />
  </head>
  <style type="text/css">
    a.pk
    {
        color:#333 !important;
        text-decoration:none !important;
    }
    div.thumbnail:hover
    {
        box-shadow: 0 6px 10px 0 rgba(0,0,0,.14), 0 1px 18px 0 rgba(0,0,0,.12), 0 3px 5px -1px rgba(0,0,0,.2);
    }
    div.thumbnail div.img img
    {
        width:200px;
    }
    div.thumbnail div.img
    {
        text-align:center;
        padding-top:15px;
    }    
    div.thumbnail span.price
    {
        margin-top:2px;
        font-weight:bold;
    }
    div.thumbnail .pk-info h3
    {
        text-align:center;
        margin-top: 0;
    }
    div.thumbnail .pk-info p
    {
      color: #888;
        font-size: 12px;
    }
    div.barcode {
        margin-top: 10px;
        text-align:center;
        color:#777;
        font-size:12px;
        font-weight:bold; 
        letter-spacing: 3px;
    }
    div.vendor {
      text-align: right;
      font-weight: bold;
    }
    div.kreport-title {
      // text-align: center;
    }
    div.website {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
  <body>
    <div class="container box-container">
    
      <div class='row kreport-title'>
        <div class='col-md-6'>
          <h1>Product Catalogs</h1>
        </div>
        <div class='col-md-6 text-right'>
          <?php
            QRCode::create(array(
            "format" => "svg",
            "value"=>"https://www.koolreport.com",
            'size' => 100
          ));
          ?>
        </div>
      </div>
      <div class='row kreport-horizontal-line-0'>&nbsp;</div>
      
      <?php
        // Table::create(array(
          // "dataStore"=>$this->dataStore('products'),
        // ));
     
        $data = $this->dataStore('products')->data();
        $len = count($data);
        $numRow = floor($len / 3);
        
        for ($i=0; $i<$numRow; $i++) {
          ?>
          <div class='row'>
          <?php
          for ($j=0; $j<3; $j++) {
            $index = $i * 3 + $j;
            $row = $data[$index];
            $productCode = $row['productCode'];
            $code = (string)str_replace('_', '', substr($productCode, 1));
            // echo $code;
            ?>
            <div class="col-md-4">
              <a href="#" class="pk">
                <div class="thumbnail">
                  <div class="img">
                    <img src="img/<?php echo $code;?>.jpg" alt="...">
                  </div>
                  <div class='barcode'>
                    <?php
                      Barcode::create(array(
                        "format" => "svg",
                        "value"=>$code,
                        "type"=>"TYPE_EAN_8"
                      ));
                      echo '<br>' . $code;
                    ?>
                  </div>
                  <div class="caption">
                    <div class="pk-info">
                        <h3><strong><?php echo $row['productName']; ?></strong></h3>
                        <p><?php echo $row['productDescription']; ?></p>
                    </div>
                    
                  </div>  
                  <div class="pk-extra row">
                    <div class="col-md-3">
                      VENDOR:
                    </div>
                    <div class="vendor col-md-9">
                      <?php echo $row['productVendor']; ?>
                    </div>
                  </div>
                  <div class="pk-extra row">
                    <div class="col-md-6">
                      LIST PRICE:
                    </div>
                    <div class="vendor text-success col-md-6">
                      <?php echo '$' . $row['buyPrice']; ?>
                    </div>
                  </div> 
                </div>
              </a>
            </div>
            <?php            
          }
          ?>
          </div>
          <?php
        }
        
     ?>
      
     
      
    </div>
  </body>
</html>