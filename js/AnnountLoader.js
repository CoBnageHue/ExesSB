let Button = document.querySelector('.show-more')

async function getAnnounFromDB(){
    let result = fetch('../php/annount/AnnountLoaderFromDB.php', {
        method: 'GET',
    }).then((response) =>{
        return response.json()
    })

    return result
}

function getStartAnnounts(data){
    data.then(function(result){
        let t = 0;
        if(result.length < 3){
            t= result.length;
        }
        else
        {
            t = 3;
        }
        for(let i=0; i<t; i++){
            let div = document.createElement('div')

            div.className = 'annbox'

            div.innerHTML = "<p href=\"#\" class=\"annname\" >" + result[i]["name_item"] + "</p>\n" +
                "                <img src=\" "+"/img/uploads/"+result[i]["picture"] +" \" class=\"annimg\">\n" +
                "                <p class=\"annabout\">Цена: "+result[i]["price"]+"</p>\n" +
                "                <p class=\"annabout\">Опубликовано в: "+result[i]["publication_time"]+"</p>\n" +
                "                <button class=\"annlink\">Откликнуться</button>\<n></n>"
            document.querySelector('.annoutblock').appendChild(div)
        }
        SubscribeButtons()

    })
}

function addAnnountsOnClick(children_count, data){
    data.then(function (result){
        let countOfResAnn;
        if(result.length - children_count > 3){
            countOfResAnn =children_count + 3;
        }
        else if(result.length == children_count){
            countOfResAnn = children_count;
        }
        else{
            countOfResAnn = result.length;
        }

        let obj = {
            Result: result,
            ResAnnCount : countOfResAnn,
            ChildrenCount: children_count
        }

        return obj
    }).then(function (obj){
        for(let i=obj.ChildrenCount; i<obj.ResAnnCount; i++){
            let div = document.createElement('div')

            div.className = 'annbox'

            div.innerHTML = "<p href=\"#\" class=\"annname\" >" + obj.Result[i]["name_item"] + "</p>\n" +
                "                <img src=\" "+" /img/uploads/"+ obj.Result[i]["picture"] + "\" class=\"annimg\">\n" +
                "                <p class=\"annabout\">Цена: "+ obj.Result[i]["price"]+"</p>\n" +
                "                <p class=\"annabout\">Опубликовано в: "+ obj.Result[i]["publication_time"]+"</p>\n" +
                "                <button action=\"/php/detailpage.php\" target=\"_self\" class=\"annlink\">Откликнуться</button>"

            document.querySelector('.annoutblock').appendChild(div)
        }
        SubscribeButtons()
    })
}


function Subscribe(data) {
    Button.addEventListener('click', function () {
        let count = document.querySelector('.annoutblock').childElementCount
        addAnnountsOnClick(count, data)
    })
}

function SubscribeButtons(){
    let links = document.querySelectorAll('.annlink')
    for(let i=0; i<links.length; i++){
        links[i].addEventListener('click',function (){
            window.location = '/php/detailpage.php/id=1'
        })
    }
}

function  __anninit__(){
    let data = getAnnounFromDB()
    getStartAnnounts(data)
    Subscribe(data)
}


__anninit__()