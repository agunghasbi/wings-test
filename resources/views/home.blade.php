@extends('layout')

@section('css')
<style>
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    p {
        color: grey
    }

    #heading {
        text-transform: uppercase;
        color: #0dcaf0;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform input,
    #msform textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #0dcaf0;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #0dcaf0;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #311B92
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #0dcaf0;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: #0dcaf0;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #0dcaf0
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 33%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f00a"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f0d6"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f030"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:not(:first-child):after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        right: 50%;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #0dcaf0
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #0dcaf0
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-12 text-end">
        <a href="/report" class="btn btn-success">Report <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>
    <div class="col-10 text-center p-0 mt-3 mb-2">
        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">

            <form id="msform">
                <!-- progressbar -->
                <ul class="p-0" id="progressbar">
                    <li class="active" id="account"><strong>Product List</strong></li>
                    <li id="personal"><strong>Checkout <span id="cart-count"></span></strong></li>
                    <li id="confirm"><strong>Finish</strong></li>
                </ul>

                <fieldset class="w-75 mx-auto">
                    <div class="form-card product-list-container mb-5">

                    </div>
                    <button type="button" class="btn btn-info rounded-pill fw-bold text-white px-5 next">CHECKOUT</button>
                </fieldset>

                <fieldset class="w-75 mx-auto">
                    <div class="form-card mb-3">
                        <div class="product-checkout-container">

                        </div>

                        <div class="border w-75 mx-auto text-center checkout-total">
                            <h2>TOTAL : Rp. <span id="checkout-total">0</span>,-</h2>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary rounded-pill fw-bold text-white previous">Back</button>
                    <button type="button" class="btn btn-info rounded-pill fw-bold text-white" onclick="checkout(this)">CONFIRM</button>
                </fieldset>

                <fieldset>
                    <div class="form-card">

                        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                        <div class="row justify-content-center">
                            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                        </div> <br><br>
                        <div class="row justify-content-center">
                            <div class="col-7 text-center">
                                <h5 class="purple-text text-center">Products purchased</h5>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary rounded-pill fw-bold text-white" onclick="return window.location.reload()">Buy Again</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-product" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PRODUCT DETAIL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;

        $(".next").click(function() {
            nextStep(this)
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
        });

        $(".submit").click(function() {
            return false;
        })

        // Fetch Product List
        $.ajax({
            type: "GET",
            url: "{{url('/api/products')}}",
            dataType: "json",
            success: function(response) {
                let data = response.data
                $.each(response.data, function(i, v) {

                    let product = productContainer(v)

                    $('.product-list-container').prepend(product)
                });
            }
        });
    });

    function nextStep(t) {
        current_fs = $(t).parent();
        next_fs = $(t).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({
                    'opacity': opacity
                });
            },
            duration: 500
        });
    }

    function productContainer(data) {
        // Create the main container div with class "row mb-3"
        var mainContainer = document.createElement("div");
        mainContainer.className = "row mb-3";

        // Create the first column div with class "col-3"
        var col1 = document.createElement("div");
        col1.className = "col-3";

        // Create the nested div inside col1 with classes "w-100 h-100 bg-info rounded"
        var nestedDiv1 = document.createElement("div");
        nestedDiv1.className = "w-100 bg-info rounded";
        nestedDiv1.style.height = "75px"
        col1.appendChild(nestedDiv1);

        // Create the second column div with class "col-6"
        var col2 = document.createElement("div");
        col2.className = "col-6";

        // Create spans with dynamic content using ${v.Product_Name}
        var productName = document.createElement("span");
        productName.className = "fw-bold cursor-pointer";
        productName.textContent = data.Product_Name;
        productName.addEventListener('click', function() {
            showProductDetail(data)
        })


        var price = document.createElement("span");

        // Append spans to col2
        col2.appendChild(productName);
        col2.appendChild(document.createElement("br"));

        if (data.Discount > 0) {
            var delPrice = document.createElement("del");
            delPrice.textContent = "Rp. " + formatCurrency(parseInt(data.Price));
            col2.appendChild(delPrice);
            col2.appendChild(document.createElement("br"));

            discountedPrice = parseInt(data.Price) - ((data.Discount / 100) * parseInt(data.Price))
            price.textContent = "Rp. " + formatCurrency(discountedPrice);
        } else {
            price.textContent = "Rp. " + formatCurrency(parseInt(data.Price));
        }

        col2.appendChild(price);

        // Create the third column div with class "col-3 align-self-center"
        var col3 = document.createElement("div");
        col3.className = "col-3 text-end align-self-center";

        // Create a button with classes "btn btn-info rounded-pill fw-bold text-white"
        var buyButton = document.createElement("button");
        buyButton.type = "button";
        buyButton.className = "btn btn-info rounded-pill fw-bold text-white";
        buyButton.textContent = "BUY";
        buyButton.addEventListener('click', function() {
            addToCart(data)
        })

        // Append the button to col3
        col3.appendChild(buyButton);

        // Append columns to the main container
        mainContainer.appendChild(col1);
        mainContainer.appendChild(col2);
        mainContainer.appendChild(col3);

        return mainContainer
    }

    function formatCurrency(num) {
        var str = num.toString().split('.');
        if (str[0].length >= 5) {
            str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1.');
        }
        if (str[1] && str[1].length >= 5) {
            str[1] = str[1].replace(/(\d{3})/g, '$1 ');
        }
        return str.join('.');
    }

    function showProductDetail(data) {

        // Create the main container div with class "row mb-3 cursor-pointer"
        var mainContainer = document.createElement("div");
        mainContainer.className = "row mb-3 cursor-pointer";

        // Create the first column div with class "col-6"
        var col1 = document.createElement("div");
        col1.className = "col-6";

        // Create the nested div inside col1 with classes "w-100 h-100 bg-info rounded"
        var nestedDiv1 = document.createElement("div");
        nestedDiv1.className = "w-100 h-100 bg-info rounded";
        col1.appendChild(nestedDiv1);

        // Create the second column div with class "col-6 mb-3"
        var col2 = document.createElement("div");
        col2.className = "col-6 mb-3";

        // Create a span with classes "fw-bold cursor-pointer" for the product name
        var productName = document.createElement("span");
        productName.className = "fw-bold cursor-pointer";
        productName.textContent = data.Product_Name;

        // Create spans for other information
        var priceSpan = document.createElement("span");
        priceSpan.textContent = "Rp. " + parseInt(data.Price);

        var dimensionSpan = document.createElement("span");
        dimensionSpan.textContent = "Dimension: " + data.Dimension;

        var unitSpan = document.createElement("span");
        unitSpan.textContent = "Price Unit: " + data.Unit;

        var price = document.createElement("span");

        // Append spans to col2
        col2.appendChild(productName);
        col2.appendChild(document.createElement("br"));

        if (data.Discount > 0) {
            var delPrice = document.createElement("del");
            delPrice.textContent = "Rp. " + formatCurrency(parseInt(data.Price));
            col2.appendChild(delPrice);
            col2.appendChild(document.createElement("br"));

            discountedPrice = parseInt(data.Price) - ((data.Discount / 100) * parseInt(data.Price))
            price.textContent = "Rp. " + formatCurrency(discountedPrice);
        } else {
            price.textContent = "Rp. " + formatCurrency(parseInt(data.Price));
        }

        col2.appendChild(price);
        col2.appendChild(document.createElement("br"));
        col2.appendChild(dimensionSpan);
        col2.appendChild(document.createElement("br"));
        col2.appendChild(unitSpan);

        // Create the third column div with class "col-6 offset-6"
        var col3 = document.createElement("div");
        col3.className = "col-6 offset-6";

        // Create a button with classes "btn btn-info rounded-pill fw-bold text-white"
        var buyButton = document.createElement("button");
        buyButton.type = "button";
        buyButton.className = "btn btn-info rounded-pill fw-bold text-white";
        buyButton.textContent = "BUY";
        buyButton.addEventListener('click', function() {
            addToCart(data)
            alert('Product added to Cart');
        })

        // Append the button to col3
        col3.appendChild(buyButton);

        // Append columns to the main container
        mainContainer.appendChild(col1);
        mainContainer.appendChild(col2);
        mainContainer.appendChild(col3);

        $('.modal-body').html(mainContainer)
        $('#modal-product').modal('show');
    }

    /**
     * For now save cart into a variable
     * If have enough Time save cart into LocalStorage
     */
    let cart = [];

    function addToCart(data) {
        let inCart = false;
        $.each(cart, function(i, v) {
            if (v.id == data.id) {
                alert("Already in cart");
                inCart = true;
            };
        });

        if (!inCart) {
            data.qty = 1;
            cart.push(data)
            $('#cart-count').text(`(${cart.length})`)
        }

        updateCart();
    }

    function updateCart() {
        $('.product-checkout-container').html("")
        $.each(cart, function(i, v) {

            let product = productCheckoutContainer(v)

            $('.product-checkout-container').prepend(product)
        });

        updateTotalCheckout();
    }

    function productCheckoutContainer(data) {
        if (data.Discount > 0) {
            discountedPrice = parseInt(data.Price) - ((data.Discount / 100) * parseInt(data.Price))
            finalPrice = data.qty * parseInt(discountedPrice);
        } else {
            finalPrice = data.qty * parseInt(data.Price);
        }

        // Create the main container div with class "row mb-3"
        var mainContainer = document.createElement("div");
        mainContainer.className = "row mb-3";

        // Create the first column div with class "col-3"
        var col1 = document.createElement("div");
        col1.className = "col-3";

        // Create the nested div inside col1 with classes "w-100 bg-info rounded" and inline style for height
        var nestedDiv1 = document.createElement("div");
        nestedDiv1.className = "w-100 bg-info rounded";
        nestedDiv1.style.height = "75px";
        col1.appendChild(nestedDiv1);

        // Create the second column div with class "col-9"
        var col2 = document.createElement("div");
        col2.className = "col-9";

        // Create a span with classes "fw-bold cursor-pointer" for the product name
        var productName = document.createElement("span");
        productName.className = "fw-bold cursor-pointer";
        productName.textContent = data.Product_Name;

        // Create an input element with type "number" and class "w-25 bg-white" with a default value of 1
        var quantityInput = document.createElement("input");
        quantityInput.type = "number";
        quantityInput.setAttribute('min', 1);
        quantityInput.className = "w-25 bg-white";
        quantityInput.value = data.qty;
        quantityInput.addEventListener("change", function() {
            changeSubtotal(data.id, this.value)
        });

        // Create a span with the unit 
        var unitSpan = document.createElement("span");
        unitSpan.textContent = data.Unit;

        // Create a span for the subtotal text
        var subtotalText = document.createElement("span");
        subtotalText.textContent = "Subtotal : Rp. ";

        // Create a span for the subtotal amount (replace with actual value)
        var subtotalAmount = document.createElement("span");
        subtotalAmount.className = "subtotal-" + data.id;
        subtotalAmount.setAttribute('data-price', finalPrice)
        subtotalAmount.textContent = formatCurrency(finalPrice)

        // Append elements to col2
        col2.appendChild(productName);
        col2.appendChild(document.createElement("br"));
        col2.appendChild(quantityInput);
        col2.appendChild(unitSpan);
        col2.appendChild(document.createElement("br"));
        col2.appendChild(subtotalText);
        col2.appendChild(subtotalAmount);

        // Append columns to the main container
        mainContainer.appendChild(col1);
        mainContainer.appendChild(col2);

        return mainContainer;
    }

    function changeSubtotal(productId, val) {
        $.each(cart, function(i, v) {
            if (v.id == productId) {
                cart[i].qty = parseInt(val)
            }
        });
        let price = $(".subtotal-" + productId).attr('data-price');
        $(".subtotal-" + productId).text(formatCurrency(val * price));

        updateTotalCheckout();
    }

    function updateTotalCheckout() {
        let total = 0;
        $("span[class^=subtotal-]").each(function() {
            total += parseInt($(this).text().replace('.', ''));
        });
        $("#checkout-total").text(formatCurrency(total))
    }

    function checkout(t) {
        if (cart.length > 0) {
            let data = [];
            $.each(cart, function(i, v) {
                data.push({
                    'id': v.id,
                    'qty': v.qty
                });
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "POST",
                url: "{{url('/api/transactions')}}",
                contentType: 'application/json; charset=utf-8',
                data: JSON.stringify(data),
                dataType: "json",
                success: function(response) {
                    nextStep(t)
                }
            });
        } else {
            alert('Cart empty.')
        }

    }
</script>
@endsection