var MenuElements = {
    Burger : document.querySelector('#burger'),
    Menu: document.querySelector('#menu')
};
var BurgerFunctions = {
    BurgerActions: function (Burger, Menu){
        if(!Menu.classList.contains('_active')) {
            this.BurgerOpen(Burger, Menu)
        }
        else {
            this.BurgerClose(Burger, Menu)
        }
    }
    ,
    BurgerOpen: function (Burger, Menu){
        Burger.classList.add('_active')
        Menu.classList.add('_active')
    }
    ,
    BurgerClose: function (Burger, Menu) {
        Burger.classList.remove('_active')
        Menu.classList.remove('_active')
    }
};
var Burger_Subscribes = {
    onBurgerClick: function (Burger, Menu){
        Burger.addEventListener('click', function () {
            BurgerFunctions.BurgerActions(Burger, Menu)
        })
    }
    ,
    onBurgerChoose: function (Burger, Menu){
        for(let i=0; Menu.children.length >i;i++) {
            Menu.children[i].addEventListener('click', function () {
                BurgerFunctions.BurgerClose(Burger,Menu)
            })
        }
    }
};

function __burger_init__() {
    Burger_Subscribes.onBurgerClick(MenuElements.Burger, MenuElements.Menu)
    Burger_Subscribes.onBurgerChoose(MenuElements.Burger, MenuElements.Menu)
}

document.addEventListener('DOMContentLoaded', function () {
    __burger_init__()
})