
//Add and reduce cart nombers

var  minusButton = document.querySelectorAll('#cart_list .minus');
var  plusButton = document.querySelectorAll('#cart_list .plus');
var  quantityItem = document.querySelectorAll('#cart_list .item-quantity');
var  productStock = document.querySelectorAll('#cart_list .stock-number');
var  newquantity, stock;

var updateCartNumberByButton = function(){


    for(var i = 0; i < quantityItem.length; i++){
        newquantity = quantityItem[i].value;
        stock = productStock[i].value;

        minusButton[i].addEventListener('click', function(){
            if(newquantity > 0){
                newquantity--;
            }
            else alert("No more!!");
        });

        plusButton[i].addEventListener('click', function(){
            if(stock > 0){
                newquantity++;
            }
            else alert("No more!!");
        });
    }

}

updateCartNumberByButton();

    //Toggle change theme
    var switchtheme = false;
    var btns = document.querySelectorAll("#switchBTN");
    var themeSwitcher = function() {
        switchtheme = !switchtheme;

        if (switchtheme){
            document.getElementById("SwitchBG").className = "theme-header";
            document.getElementById("switchBGfooter").className = "theme-footer";
            
            for(var i = 0; i < btns.length; i++){
                btns[i].classList.add("themeColor");
            }
        }
        else{
            document.getElementById("SwitchBG").className = "";
            document.getElementById("switchBGfooter").className = "";
            
            for(var i = 0; i < btns.length; i++){
                btns[i].classList.remove("themeColor");
            }
        }
    }
  

