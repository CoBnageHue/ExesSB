"use strict";

function __reg_init__() {
    let RegFields = {
        name: document.querySelector('#regnamebar'),
        email: document.querySelector('#regmailebar'),
        phone: document.querySelector('#regphonebar'),
        pass: document.querySelector('#regpassbar'),
        verpass: document.querySelector('#regverpassbar'),
        AgreeCheckBoxLabel: document.querySelector('#arglabel'),
        AgreeCheckBox: document.querySelector('#regcheckbox'),
        SubmitButton: document.querySelector('#submitreg'),
    };
    let RegDescriptions = {
        name: document.querySelector('.regnamebartext'),
        email: document.querySelector('.regmailebartext'),
        phone: document.querySelector('.regphonebartext'),
        pass: document.querySelector('.regpassbartext'),
        verpass: document.querySelector('.regverpassbartext')
    };
    let LogFields = {
        Email: document.querySelector('#logmailebar'),
        Pass: document.querySelector('#logpassbar'),
        SubmitButton: document.querySelector('#submitlog'),
        ErrorString: document.querySelector('#errorsting')
    };
    let FormScripts = {
        RegButtonActions: function (RegFields) {
            this.ReloadFields(RegFields)
            this.ReloadDesc(RegDescriptions)
            Requests.verifyDBforReg(RegFields).then(function (ErrorData){
                let check = 0
                for(let key1 in ErrorData){
                    check = check + Object.values(ErrorData[key1]).length
                    if(Object.values(ErrorData[key1]).length > 0){
                        for(let key2 in ErrorData[key1]){
                            let li = document.createElement('li')

                            li.className = 'error'

                            li.innerHTML = ErrorData[key1][key2]

                            RegDescriptions[key1].appendChild(li)
                        }
                        RegFields[key1].classList.add("_error")
                    }
                }
                if(check == 0){
                    window.open('php/Relocator.php', '_self', false)
                }
            })
        }
        ,
        LogButtonActions: function(selector_list){
            let obj = {
                email: selector_list[0],
                pass: selector_list[1]
            }
            Requests.verifyDBforLog(obj).then((response_answer) =>{
                if(response_answer == '1') {
                    window.open('php/Relocator.php', '_self', false)
                } else{
                    LogFields.ErrorString.classList.add('_error')
                }
            })
        }
        ,
        AgreeCheckBoxActions: function (checkBoxState) {
            RegFields.SubmitButton.disabled = checkBoxState;
        }
        ,
        clearForm: function (classForm) {
            if (classForm === '.reg') {
                document.forms[0].reset();
                this.ReloadFields(RegFields)
                this.ReloadDesc(RegDescriptions)
            } else {
                document.forms[1].reset();
                this.ReloadFields([LogFields.Email, LogFields.Pass])
                LogFields.ErrorString.classList.remove('_error')
            }
        }
        ,
        ReloadDesc: function (desc_obj) {
            for(let key1 in desc_obj){
                desc_obj[key1].innerHTML = ""
            }
        }
        ,
        ReloadFields: function (field_obj) {
                for(let key in field_obj){
                    field_obj[key].classList.remove('_error')
                }
        }
        ,
        ClearFormOnPopUpClose : function (link) {
            if (document.querySelector('#reg').contains(link)) {
                FormScripts.clearForm('.reg')
            } else {
                FormScripts.clearForm('.log')
            }
        }
    };
    let Requests = {
        verifyDBforReg: async function (selector_list){
            let FM = new FormData()
            //Создаём объект с данными для БД
            FM.append("name", RegFields.name.value)
            FM.append("email", RegFields.email.value)
            FM.append("phone", RegFields.phone.value)
            FM.append("pass", RegFields.pass.value)
            FM.append("verpass", RegFields.verpass.value)
            //Проверка email на уникальность

            let result = fetch('../php/RegAndLog/Reg.php',{
                method: 'POST',
                body: FM
            }).then(function (response){
                return response.json()
            })

            return result
        }
        ,
        verifyDBforLog: async function(selector_obj) {
            let FM = new FormData()
            //Создаём объект с данными для БД
            FM.append("email", selector_obj.email.value)
            FM.append("pass", selector_obj.pass.value)

            let result = fetch('../php/RegAndLog/Log.php', {
                method: 'POST',
                body: FM
            }).then((response) => {
                return response.json()
            })

            return result
        }
    };
    let Subscribes = {
        onPopUpsCloseAction: function (link_list) {
            for (let i = 0; link_list.length > i; i++) {
                link_list[i].addEventListener('click', function () {FormScripts.ClearFormOnPopUpClose(link_list[i])})
            }
        }
        ,
        onAgreeCheckBoxSwitch: function (Label, CheckBox) {
            Label.addEventListener('click', function (){
                FormScripts.AgreeCheckBoxActions(CheckBox.checked)
            })
        }
        ,
        onRegButtonClick: function (RegButton, RegFields) {
            RegButton.addEventListener('click', function () {
                FormScripts.RegButtonActions(RegFields)
            })
        }
        ,
        onLogButtonClick: function (LogButton, field_list) {
            LogButton.addEventListener('click', function () {
                FormScripts.LogButtonActions(field_list)
            })
        }
    };

    Subscribes.onRegButtonClick(RegFields.SubmitButton,RegFields)
    Subscribes.onLogButtonClick(LogFields.SubmitButton, [LogFields.Email, LogFields.Pass])
    Subscribes.onAgreeCheckBoxSwitch(RegFields.AgreeCheckBoxLabel, RegFields.AgreeCheckBox)
    Subscribes.onPopUpsCloseAction(document.querySelectorAll('.pop-up-close'))
}

document.addEventListener('DOMContentLoaded', function () {
    __reg_init__()
})