$(() => {
    function listing(){
        $.ajax({
            url: "https://fakestoreapi.com/products?limit=5",
            type: "get",
            dataType: "JSON",
            success: (data) => {
                console.log(data);
                let tpl = `<div class="row">`;
                $.each(data, (i, row) => {
                    tpl += `<div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="${row.image}" alt="" title="">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <div class="title">${row.title}</div>
                                        </h4>
                                        <h5>${row.price}</h5>
                                        <div class="btn btn-dark mt-2 addToCart" data-id="${row.id}">Add To Cart</div>
                                    </div>
                                </div>
                            </div>
                    `;
                });
                tpl += "</div>";

                $(".listing-product").append(tpl);

                $(".addToCart").on("click", (e) => {
                    add_to_cart(e);
                });
            }
        })
    }
    listing();

    function add_to_cart(e){
        let product_id = $(e.target).data("id");

        $.ajax({
            url: "rest/cart/add",
            type: "post",
            dataType: "JSON",
            data: { product_id : product_id },
            success: (data) => {
                if(data.status == "failed"){
                    location.href = "login";
                }
                // console.log(data.status);
                cart_count();
            }
        })
    }

})