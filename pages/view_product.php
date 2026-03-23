<div  class="container mt-4">

    <h1>All Menu Our Coffee Store</h1>
    <div   id="show-allproduct" class="row">

        

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $.getJSON("products/get_all_prd.php",function(data){
            let html = ``;
            data.forEach(item=>{
                html+=`<div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                <img style="height: 230px;"  src="uploads/${item.cof_image}" class="card-img-top object-fit-cover" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">${item.cof_name}</h5>
                    <p class="card-text text-muted">$ ${item.cof_price}</p>
                    <button style="background-color: #9e7a55;" class="btn w-100 text-white">Order</button>
                </div>
                </div>
            </div>`
            })
            $("#show-allproduct").html(html);
        })
    })
</script>