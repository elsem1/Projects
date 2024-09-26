const shoppingList = document.getElementById("shoppingList");
const products = document.getElementsByClassName("product")
const prices = document.getElementsByClassName("productPrice");
const amounts = document.getElementsByClassName("productQuantity");
const subTotal = document.getElementsByClassName("productTotalCost");
const totalCost= document.getElementById("totalCost");


const calculatePoints = () => {
    console.log('Aantal producten is gewijzigd');

    let totalPrice = 0;    
   
    for (let i = 0; i < prices.length; i++) {

        let tempTotalProduct = prices[i].innerHTML * amounts[i].value;

        subTotal[i].innerHTML = tempTotalProduct.toFixed(2)

        totalPrice += tempTotalProduct; 

    }

       
    
    totalCost.innerHTML = totalPrice.toFixed(2);
    

  

};


shoppingList.addEventListener("change", calculatePoints);








 