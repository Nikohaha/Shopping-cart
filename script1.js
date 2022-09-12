

// check if the cart is empty, if there is item in cart, the button will change className
    var btn = document.querySelector(".pur-btn");
    var rows = document.getElementById("my-table").rows.length;
    var x = rows - 1;
    var cells = document.getElementById("my-table").rows.item(0).cells.length;
    var y = cells - 1;
    var td1 = document.getElementById("my-table").rows[x].cells[1].innerHTML;
    console.log (td1);

    if(td1 != "$0"){
        btn.className = "show-btn";
    }

// when click purchase button, show the message that you purchase successfully
btn.onclick = function(){
    alert("Thanks for your purchase!!!");
}

// When blur on discount input, will add a "%" automatically
var auto = document.querySelector(".auto");
auto.addEventListener("blur",function(){
   var n = auto.value;
   auto.value = n + "%";
   btn.className = "show-btn";  
})

// select drop-down menu
var purchase = document.querySelector("#submitorder");
function change(){
  
    var select = document.getElementById("newitem");
    var index = select.selectedIndex;
    var item = document.querySelector("#item");
    var retail = document.querySelector("#retail");
    var discount = document.querySelector("#discount");
    var total = document.querySelector("#total");

   var list = [];
   list[0] = ["mandolin",460];
   list[1] = ["classical guitar",1200];
   list[2] = ["acoustic guitar",750];
   list[3] = ["kazoo",6.8];
   list[4] = ["djembe",250];
   list[5] = ["sitar",810];
   list[6] = ["bamboo flute",48];  

   item.value = (list[index][0]);
   retail.value = (list[index][1]);
   total.value = (list[index][1]);

   discount.addEventListener("keyup",discountcal);
   
}

//calculate the finnal total price with discount
function discountcal(){
    var retail = document.querySelector("#retail");
    var discount = document.querySelector("#discount");
    var total = document.querySelector("#total");
    total.value = retail.value *(1-(discount.value * 0.01));
}






