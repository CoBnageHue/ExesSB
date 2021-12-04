let menuelement =[document.getElementById('menu_block_1'),
    document.getElementById('menu_block_2'),
    document.getElementById('menu_block_3'),
    document.getElementById('menu_block_4')];
let menulink =[
    document.getElementById('menu1'),
    document.getElementById('menu2'),
    document.getElementById('menu3'),
    document.getElementById('menu4')
]
function flex_none(i){
    for(let j = 0; j < menuelement.length; j++){
        if(j === i)
            menuelement[i].style.display = "flex";
        else
            menuelement[j].style.display = "none";

    }
}
for(let i = 0; i < menulink.length; i++){
    menulink[i].addEventListener("click", function (){
        flex_none(i);
    })

}

