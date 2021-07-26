
var number = 1

function updateProdTotalPlus(row) {
        var cart_container = document.getElementsByClassName('cart-left')[0]
        var cart_rows = document.getElementsByClassName('prod_row')
        var cart_row = cart_rows[row]
        var prod_qty_element = cart_row.getElementsByClassName('quantity-field').value
        var prod_qty = parseFloat(prod_qty_element)
        var element_price = cart_row.getElementsByClassName('cart-price')[0]
        var prod_price = parseFloat(element_price.innerText.replace('RON', ''))
        var total_prod = prod_price * prod_qty
        total_prod = Math.round(total_prod * 100) / 100
        cart_row.getElementsByClassName('cart-prod-price')[0].innerText =total_prod + ' RON'
        updateTotal()

}
function updateCartProd(row) {
        var cart_container = document.getElementsByClassName('cart-left')[0]
        var cart_rows = document.getElementsByClassName('prod_row')
        var cart_row = cart_rows[row]
        var prod_qty_element = cart_row.getElementsByClassName('quantity-field').value
        var prod_qty = parseFloat(prod_qty_element)
        var element_price = cart_row.getElementsByClassName('cart-price')[0]
        var prod_price = parseFloat(element_price.innerText.replace('RON', ''))
        var total_prod = prod_price * prod_qty
        total_prod = Math.round(total_prod * 100) / 100
        cart_row.getElementsByClassName('cart-prod-price')[0].innerText =total_prod + ' RON'
        updateTotal()

}
function updateProdTotalMinus(row) {
        var cart_container = document.getElementsByClassName('cart-left')[0]
        var cart_rows = document.getElementsByClassName('prod_row')
        var cart_row = cart_rows[row]
        var prod_qty2 = cart_row.getElementsByClassName('quantity-field')[0].value
        var element_price = cart_row.getElementsByClassName('cart-price')[0]
        var prod_price = parseFloat(element_price.innerText.replace('RON', ''))
        if(prod_qty2>0){
        var total_prod2 = prod_price * prod_qty2
        total_prod2 = Math.round(total_prod2 * 100) / 100
        cart_row.getElementsByClassName('cart-prod-price')[0].innerText =total_prod2 + ' RON'
        updateTotal()
    }
    

}
function updateTotal(){
var total = 0
$(".cart-prod-price").each(function() {
    var total_prod = $.trim( $(this).text() );

    if ( total_prod ) {
        total_prod = parseFloat( total_prod.replace( /^\'RON'/, "" ) );

        total += !isNaN( total_prod ) ? total_prod : 0;
    }
});

    total = Math.round(total * 100) / 100
    item_count = document.getElementsByClassName("cart-prod").length
    document.getElementsByClassName('cart-summary-items')[0].innerText ='Sumar (' + item_count + ' produse):'
    document.getElementsByClassName('cart-summary-price')[0].innerText =total + ' RON'
    document.getElementsByClassName('cart-total-price')[0].innerText =total + ' RON'

}
