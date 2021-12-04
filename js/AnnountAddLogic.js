function __add_annount_init__(){
    let Form = document.forms[0]

    let Regex = {
        Price: /^([1-9].*[,\\.][0-9]*)$/g
    }

    let AnnountFields = {
        Name: document.querySelector('#ann_name'),
        Price: document.querySelector('#ann_price'),
        Image: document.querySelector('#ann_pic'),
        Desc: document.querySelector('#ann_desc'),
        Button: document.querySelector('#submitaddann')
    }

    let FormScripts = {
        AddButtonClick: function (Field_obj){

        }
    }

    let DataScripts = {
        verifyPrice: function (price_field){
            let result;
            if(Regex.Price.test(price_field.value)) result = true
            else result = false
            return result
        }
        ,
        DBVerify: async function (Field_obj){
            let FM = new FormData()
            //Создаём объект с данными для БД
            FM.append("price", Field_obj.Price.value)
            FM.append("pic", Field_obj.Image.files[0])


            console.log(Field_obj.Image.files[0].type)

            let result = fetch('../annount/annVerify.php',{
                method: 'POST',
                body: FM
            }).then(function (response){
                return response.json()
            })
        }
    }

    AnnountFields.Button.addEventListener('click', function (){
        DataScripts.DBVerify(AnnountFields).then(function (result){
            console.log(result.json())
        })
    })


}

__add_annount_init__()