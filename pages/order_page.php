<?php
  include "../config/db.php";

  $sql = "SELECT o.order_id, o.qty, p.cof_name, p.cof_price, p.cof_image FROM oders o JOIN prd_coffee p ON o.cof_id = p.cof_id";
  $result = $conn->query($sql);
  $orders = [];
  $total_pay = 0;
  $item_count = 0;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $orders[] = $row;
      $total_pay += $row['qty'] * $row['cof_price'];
      $item_count += $row['qty'];
    }
  }
?>

<style>
  :root {
    --bg: #f5f0eb;
    --card-bg: #ffffff;
    --accent: #3a6bcc;
    --accent-hover: #2d55a8;
    --text-primary: #1a1a2e;
    --text-muted: #888;
    --border: #e8e2da;
    --img-bg: #e8e2da;
    --shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
  }

  .cart-card {
    background: var(--card-bg);
    border-radius: 20px;
    box-shadow: var(--shadow);
    padding: 2.2rem 2.4rem 2rem;
    width: 100%;
  }

  .cart-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.75rem;
    color: var(--text-primary);
    margin-bottom: 1.4rem;
    letter-spacing: -0.5px;
  }

  .cart-table thead th {
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--text-muted);
    border-bottom: 1.5px solid var(--border);
    padding-bottom: 0.6rem;
    border-top: none;
  }

  .cart-table td {
    vertical-align: middle;
    border: none;
    padding: 0.95rem 0.5rem;
  }

  .cart-table tbody tr:not(.subtotal-row) td {
    border-bottom: 1px solid var(--border);
  }

  .product-thumb {
    width: 48px;
    height: 48px;
    background: var(--img-bg);
    border-radius: 10px;
    flex-shrink: 0;
    display: inline-block;
  }

  .product-name {
    font-size: 0.92rem;
    font-weight: 500;
    color: var(--text-primary);
  }

  .price-text {
    font-size: 0.92rem;
    color: var(--text-primary);
    white-space: nowrap;
  }

  .total-text {
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--text-primary);
    white-space: nowrap;
  }

  .qty-stepper {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
  }

  .qty-stepper input[type="number"] {
    width: 36px;
    text-align: center;
    border: none;
    border-left: 1.5px solid var(--border);
    border-right: 1.5px solid var(--border);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    font-weight: 500;
    color: var(--text-primary);
    background: transparent;
    padding: 4px 0;
    -moz-appearance: textfield;
    outline: none;
  }

  .qty-stepper input[type="number"]::-webkit-inner-spin-button,
  .qty-stepper input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
  }

  .qty-btn {
    background: none;
    border: none;
    width: 30px;
    height: 30px;
    font-size: 1.1rem;
    color: var(--text-primary);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    line-height: 1;
    transition: background 0.15s;
  }

  .qty-btn:hover {
    background: var(--bg);
    color: var(--text-primary);
  }

  .btn-remove {
    background: none;
    border: none;
    color: var(--accent);
    font-size: 0.82rem;
    font-weight: 500;
    padding: 0;
    cursor: pointer;
    text-decoration: none;
    transition: opacity 0.15s;
    white-space: nowrap;
  }

  .btn-remove:hover {
    opacity: 0.65;
    color: var(--accent);
  }

  .btn-checkout {
    background-color: #452b16;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    padding: 0.75rem 2.5rem;
    display: block;
    width: 30%;
    margin-top: 1.2rem;
    text-align: center;
    text-decoration: none;
    transition: background 0.18s;
  }

  .btn-checkout:hover {
    background-color: #694222;
    color: #fff;
  }
</style>

<div class="cart-card">
  <div class="cart-title">Shopping Cart</div>

  <?php if (empty($orders)) : ?>
    <p class="text-danger fs-5 text-center">Order is empty</p>
  <?php else: ?>

    <table class="table cart-table mb-0">
      <thead>
        <tr>
          <th style="width:42%">Product</th>
          <th style="width:14%">Price</th>
          <th style="width:22%">Quantity</th>
          <th style="width:12%">Total</th>
          <th style="width:10%"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $odr):
          $total = $odr['qty'] * $odr['cof_price'];
        ?>
        <tr>
          <td>
            <div class="d-flex align-items-center gap-3">
              <img class="product-thumb" src="uploads/<?= $odr['cof_image'] ?>" alt="">
              <span class="product-name"><?= $odr['cof_name'] ?></span>
            </div>
          </td>
          <td><span class="price-text">$ <?= $odr['cof_price'] ?></span></td>
          <td>
            <div class="qty-stepper">
              <span class="qty-btn minus" data-id="<?= $odr['order_id'] ?>">−</span>
              <input type="number" value="<?= $odr['qty'] ?>" min="1" max="99" />
              <span class="qty-btn plus" data-id="<?= $odr['order_id'] ?>">+</span>
            </div>
          </td>
          <td><span class="total-text"><?= number_format($total, 2) ?>$</span></td>
          
          <td><button class="btn-remove text-danger" data-id="<?= $odr['order_id'] ?>">Remove</button></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    
    <div class="w-100 d-flex justify-content-between align-items-center align-content-center mt-3">
      <div>
        <span class="fs-5 fw-bold text-success">
          Item: <span class="item-count"><?= $item_count ?></span>
        </span><br>
        <span class="fs-5 fw-bold text-success">
          totalpayments: <span class="total-pay"><?= number_format($total_pay, 2) ?>$</span>
        </span>
      </div>
      <a href="#" id="checkout-btn" class="btn-checkout">Checkout</a>
    </div>

  <?php endif; ?>
</div>
<script>
  function updateSummary() {
    let totalPay = 0;
    let itemCount = 0;

    
    $(".cart-table tbody tr").each(function() {
      const qty = parseInt($(this).find("input[type='number']").val()) || 0;
      const price = parseFloat($(this).find(".price-text").text().replace(/[^0-9.]/g, "")) || 0;
      totalPay += qty * price;
      itemCount += qty;
    });

    $(".item-count").text(itemCount);
    $(".total-pay").text(totalPay.toFixed(2) + "$");
  }

  $(".cart-card").off("click", ".plus").on("click", ".plus", function(e) {
    e.preventDefault();
    const id = $(this).data("id");
    const $row = $(this).closest("tr");
    const $input = $row.find("input[type='number']");
    const $total = $row.find(".total-text");
    const price = parseFloat($row.find(".price-text").text().replace(/[^0-9.]/g, ""));

    $.post("orders/update_qty.php", { order_id: id, type: "plus" }, function(res) {
      if (res.trim() == "success") {
        let newQty = parseInt($input.val()) + 1;
        $input.val(newQty);
        $total.text((newQty * price).toFixed(2) + "$");
        updateSummary();
      }
    });
  });

  $(".cart-card").off("click", ".minus").on("click", ".minus", function(e) {
    e.preventDefault();
    const id = $(this).data("id");
    const $row = $(this).closest("tr");
    const $input = $row.find("input[type='number']");
    const $total = $row.find(".total-text");
    const price = parseFloat($row.find(".price-text").text().replace(/[^0-9.]/g, ""));

    let currentQty = parseInt($input.val());
    if (currentQty <= 1) return;

    $.post("orders/update_qty.php", { order_id: id, type: "minus" }, function(res) {
      if (res.trim() == "success") {
        let newQty = currentQty - 1;
        $input.val(newQty);
        $total.text((newQty * price).toFixed(2) + "$");
        updateSummary();
      }
    });
  });
  $(".cart-card").off("click","btn-remove").on("click",".btn-remove",function(e){
    e.preventDefault();
    const id = $(this).data("id");
    const $row = $(this).closest("tr");
    $.post("orders/remove_item.php", {order_id: id}, function(res){
      if(res.trim()=="success"){
         $row.remove();
         updateSummary();
      }
    })
  })
</script>