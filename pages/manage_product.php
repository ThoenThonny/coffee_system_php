<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin'){
    echo "<h3 style='color:red'>Access Denied</h3>";
    exit();
}

$query = "SELECT * FROM prd_coffee";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h3 class="mb-4">☕ Manage Coffee Products</h3>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price ($)</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr class="align-middle" id="row<?= $row['cof_id'] ?>">
                <td><?= $row['cof_id'] ?></td>
                <td>
                    <img style="width:70px;height:70px;object-fit:cover"
                         src="uploads/<?= $row['cof_image'] ?>">
                </td>
                <td><?= $row['cof_name'] ?></td>
                <td><?= $row['cof_qty'] ?></td>
                <td>$<?= $row['cof_price'] ?></td>
                <td>
                    <button  class="btn btn-warning btn-sm edit-btn" data-id="<?= $row['cof_id'] ?>">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['cof_id'] ?>">
                      Delete
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- modal -->

<style>
  :root {
    --espresso: #1a0a00;
    --roast: #3b1f0a;
    --caramel: #c47a2b;
    --cream: #f5efe6;
    --foam: #fdfaf5;
    --shadow: rgba(60, 20, 0, 0.18);
  }



  .form-card {
    background: var(--foam);
    border-radius: 20px;
    padding: 2.8rem 2.5rem;
    max-width: 820px;
    width: 100%;
    box-shadow: 0 24px 64px var(--shadow), 0 2px 8px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    position: absolute;
    top: 50%;
    left: 56%;
    transform: translate(-50%,-50%);
    display: none;
  }

  .form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--caramel), #e8a04a, var(--caramel));
  }

  .form-title {
    font-family: 'Playfair Display', serif;
    color: var(--roast);
    font-size: 1.85rem;
    font-weight: 700;
    margin-bottom: 0.2rem;
    letter-spacing: -0.5px;
  }

  .form-subtitle {
    color: #9e7a55;
    font-size: 0.85rem;
    font-weight: 300;
    margin-bottom: 2rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .form-label {
    font-weight: 500;
    font-size: 0.8rem;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: var(--roast);
    margin-bottom: 0.4rem;
  }

  .form-control,
  .input-group .form-control {
    background: var(--cream);
    border: 1.5px solid #ddd0c3;
    border-radius: 10px;
    color: var(--espresso);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    padding: 0.65rem 1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .form-control:focus {
    border-color: var(--caramel);
    box-shadow: 0 0 0 3px rgba(196, 122, 43, 0.18);
    background: #fff;
    outline: none;
  }

  .form-control::placeholder {
    color: #bba98a;
  }

  /* ID field — read-only style */
  .form-control[readonly] {
    background: #ece4da;
    color: #9e7a55;
    cursor: not-allowed;
  }

  /* Price prefix */
  .input-group-text {
    background: var(--caramel);
    border: 1.5px solid var(--caramel);
    border-radius: 10px 0 0 10px !important;
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
  }

  .input-group .form-control {
    border-radius: 0 10px 10px 0 !important;
  }

  /* Image upload zone */
  .upload-zone {
    background: var(--cream);
    border: 2px dashed #ddd0c3;
    border-radius: 12px;
    padding: 1.6rem;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    position: relative;
  }

  .upload-zone:hover {
    border-color: var(--caramel);
    background: #fdf6ee;
  }

  .upload-zone input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
  }

  .upload-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
  }

  .upload-zone p {
    margin: 0;
    color: #9e7a55;
    font-size: 0.85rem;
  }

  .upload-zone strong {
    color: var(--caramel);
  }

  /* Preview */
  #imagePreview {
    display: none;
    max-height: 220px;
    border-radius: 8px;
    margin-top: 0.8rem;
    object-fit: cover;
    width: 100%;
  }

  /* Buttons */
  .btn-save {
    background: linear-gradient(135deg, var(--caramel), #e8913a);
    border: none;
    border-radius: 10px;
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-weight: 500;
    font-size: 0.95rem;
    padding: 0.7rem 2rem;
    letter-spacing: 0.5px;
    transition: opacity 0.2s, transform 0.15s;
    box-shadow: 0 4px 16px rgba(196, 122, 43, 0.35);
  }

  .btn-save:hover {
    opacity: 0.92;
    transform: translateY(-1px);
    color: #fff;
  }

  .btn-reset {
    background: transparent;
    border: 1.5px solid #ddd0c3;
    border-radius: 10px;
    color: #9e7a55;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    padding: 0.7rem 1.5rem;
    transition: border-color 0.2s, color 0.2s;
  }

  .btn-reset:hover {
    border-color: var(--caramel);
    color: var(--caramel);
  }

  .divider {
    border: none;
    border-top: 1.5px solid #ece4da;
    margin: 1.8rem 0 1.5rem;
  }

  /* Floating bean decoration */
  .bean-deco {
    position: absolute;
    width: 90px;
    height: 90px;
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
    background: rgba(196, 122, 43, 0.06);
    bottom: -20px;
    right: -20px;
    pointer-events: none;
  }
  .opacity{
    width: 100%;
    height: 100vh;
    background-color: #00000059;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    cursor: pointer;
    display: none;
  }

  .delete-modal{
          display:none;
           position:absolute; 
           top:50%; left:50%;
            transform:translate(-50%,-50%); 
            background:#fff; 
            padding:25px; 
            border-radius:15px; 
            box-shadow:0 10px 30px rgba(0,0,0,0.3); 
            z-index:999;
  }
</style>
</head>

<body>
    <div class="opacity"></div>
  <section class="form-card mx-auto">
    <div class="bean-deco"></div>

    <h2 class="form-title">Update Data Coffee</h2>
    <p class="form-subtitle">prd_coffee — update your coffee</p>

    <form method="post" id="coffeeForm" novalidate>

         <input
          type="hidden"
          class="form-control"
          id="cof_id"
          name="cof_id"
          required />
          <input type="hidden" name="old_image" id="old_image">
        
      <!-- COF_NAME -->
      <div class="mb-3">
        <label class="form-label" for="cof_name">Coffee Name</label>
        <input
          type="text"
          class="form-control"
          id="cof_name"
          name="cof_name"
          placeholder="e.g. Ethiopian Yirgacheffe"
          required />
        <div class="invalid-feedback">Please enter a coffee name.</div>
      </div>

      <!-- COF_QTY -->
      <div class="mb-3">
        <label class="form-label" for="cof_qty">Quantity (kg)</label>
        <input
          type="number"
          class="form-control"
          id="cof_qty"
          name="cof_qty"
          placeholder="0"
          min="0"
          step="0.5"
          required />
        <div class="invalid-feedback">Please enter a valid quantity.</div>
      </div>

      <!-- COF_PRICE -->
      <div class="mb-3">
        <label class="form-label" for="cof_price">Price</label>
        <div class="input-group">
          <span class="input-group-text">$</span>
          <input
            type="number"
            class="form-control"
            id="cof_price"
            name="cof_price"
            placeholder="0.00"
            min="0"
            step="0.01"
            required />
        </div>
        <div class="invalid-feedback">Please enter a valid price.</div>
      </div>

      <!-- COF_IMAGE -->
      <div class="mb-4">
        <label class="form-label">Coffee Image</label>
        <div class="upload-zone" id="uploadZone">
          <input type="file" id="cof_image" name="cof_image" accept="image/*" />
          <span class="upload-icon">☕</span>
          <p><strong>Click to upload</strong> or drag & drop</p>
          <p>PNG, JPG, WEBP — max 2 MB</p>
        </div>
        <img id="imagePreview" alt="Preview" />
      </div>

      <hr class="divider" />

      <div class="d-flex gap-2 justify-content-end">
        <button type="reset" class="btn btn-reset">Reset</button>
        <button type="submit" class="btn btn-save">Update Product</button>
      </div>

    </form>
  </section>
  
  <div class="delete-modal">
    <h4>⚠️ Delete Product</h4>
    <p>Are you sure you want to delete this product?</p>
    <input type="hidden" id="delete_id">

    <div style="text-align:right;">
        <button class="btn btn-secondary btn-sm" id="cancelDelete">Cancel</button>
        <button class="btn btn-danger btn-sm" id="confirmDelete">Delete</button>
    </div>
</div>
</body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $("#cof_image").change(function(e) {
      const file = e.target.files[0]
      const readfile = new FileReader()
      readfile.onload = function() {
        $("#imagePreview").show();
        $("#imagePreview").attr("src", readfile.result)
      }
      readfile.readAsDataURL(file)
    })

    // get_old_data to form modal
    $(document).on("click",".edit-btn",function(){
            $(".form-card").fadeIn(300)
            $(".opacity").fadeIn(300)
            const id = $(this).data("id");
            $.ajax({
                url:"products/get_product.php",
                method: "POST",
                data:{cof_id:id},
                dataType:"JSON",
                success:function(data){
                    $("#cof_id").val(data.cof_id);
                    $("#old_image").val(data.cof_image);
                    $("#cof_name").val(data.cof_name);
                    $("#cof_qty").val(data.cof_qty);
                    $("#cof_price").val(data.cof_price);
                    $("#imagePreview").show().attr("src","uploads/" +data.cof_image);
                }
            })
    })

    $(".opacity").click(function(){
         $(".form-card").fadeOut(300)
            $(".opacity").fadeOut(300)
    })

    $("#coffeeForm").submit(function(e) {
      e.preventDefault()

      const formData = new FormData(this);
      $.ajax({
        url: "products/update_prd.php",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
          const item = JSON.parse(res);
          if (item.status == 'success') {
            $("#row"+item.id).html(`
              <td>${item.id}</td>
                <td>
                    <img style="width:70px;height:70px;object-fit:cover"
                         src="uploads/${item.image}">
                </td>
                <td>${item.name}</td>
                <td>${item.qty}</td>
                <td>$${item.price}</td>
                <td>
                    <button  class="btn btn-warning btn-sm edit-btn" data-id="${item.id}">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="${item.id}">
                    Delete
                    </button>
                </td>
            `)
            alert("Update Product Already");
            $("#coffeeForm")[0].reset();
            $("#imagePreview").hide().attr("src", "");
            $(".form-card").fadeOut(300)
            $(".opacity").fadeOut(300)
          } else {
            alert(res);
          }
        }
      })
    })

    $(document).on("click", ".delete-btn", function(){
    const id = $(this).data("id");

    $("#delete_id").val(id);

    $(".delete-modal").fadeIn(200);
    $(".opacity").fadeIn(200);
});

$("#cancelDelete, .opacity").click(function(){
    $(".delete-modal").fadeOut(200);
    $(".opacity").fadeOut(200);
});

$("#confirmDelete").click(function(){
    const id = $("#delete_id").val();

    $.ajax({
        url: "products/delete_prd.php",
        method: "POST",
        data: {cof_id: id},
        success: function(res){
            if(res == "success"){
                $("#row"+id).remove(); // remove row only

                $(".delete-modal").fadeOut(200);
                $(".opacity").fadeOut(200);

                alert("Deleted successfully");
            }else{
                alert(res);
            }
        }
    })
});
  </script>