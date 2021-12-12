function __add_annount_init__() {
    let Form = document.forms[0]

    let AnnountFields = {
        Name: document.querySelector('#ann_name'),
        Price: document.querySelector('#ann_price'),
        Image: document.querySelector('#ann_pic'),
        Desc: document.querySelector('#ann_desc'),
        Button: document.querySelector('#submitaddann')
    }

    let AnnFormScripts = {
        AddButtonClick: function (Field_obj) {
            AnnDataScripts.AnnAdd(Field_obj).then((DBErrors) => {
                console.log(DBErrors)
            })
        }
    }

    let AnnDataScripts = {
        AnnAdd: async function (Field_obj) {
            let FM = new FormData()
            //Создаём объект с данными для БД
            FM.append("name", Field_obj.Name.value)
            FM.append("price", Field_obj.Price.value)
            FM.append("pic", Field_obj.Image.files[0])
            FM.append("desc", Field_obj.Desc.value)

            let result = fetch('../annount/addAnn.php', {
                method: 'POST',
                body: FM
            }).then((response) => {
                return response.json()
            })

            return result
        }
    }

    AnnountFields.Button.addEventListener('click', function () {
        AnnFormScripts.AddButtonClick(AnnountFields)
    })
}
document.addEventListener('DOMContentLoaded', function () {
__add_annount_init__()
})