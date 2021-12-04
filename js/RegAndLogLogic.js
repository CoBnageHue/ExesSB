"use strict";

function __reg_init__() {
    let RegexCheckList = {
        special_begin_n_end_name: /^(?!-)(?!\s)(?!.*-$)(?!.*\s$)/g,
        special_double_name: /^(?!.*--)(?!.*- )(?!.* -)(?!.*\s\s)/g,
        email: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$/g,
        phone: /(\+7|8)[- _]*\(?[- _]*(\d{3}[- _]*\)?([- _]*\d){7}|\d\d[- _]*\d\d[- _]*\)?([- _]*\d){6})/,
        special_all_string_pass: /^(?!\d+$)(?!-+$)(?!\/+$)(?!\.+$)/
    };
    let RegFields = {
        Name: document.querySelector('#regnamebar'),
        Email: document.querySelector('#regmailebar'),
        Phone: document.querySelector('#regphonebar'),
        Pass: document.querySelector('#regpassbar'),
        VerPass: document.querySelector('#regverpassbar'),
        AgreeCheckBoxLabel: document.querySelector('#arglabel'),
        AgreeCheckBox: document.querySelector('#regcheckbox'),
        SubmitButton: document.querySelector('#submitreg'),
    };
    let RegDescriptions = {
        NameDesc: RegFields.Name.nextElementSibling.children ,
        EmailDesc: RegFields.Email.nextElementSibling.children,
        PhoneDesc: RegFields.Phone.nextElementSibling.children,
        PassDesc: RegFields.Pass.nextElementSibling.children,
        VerPassDesc: RegFields.VerPass.nextElementSibling.children
    };
    let LogFields = {
        Email: document.querySelector('#logmailebar'),
        Pass: document.querySelector('#logpassbar'),
        desc: document.querySelector('#errorsting'),
        SubmitButton: document.querySelector('#submitlog'),
        ErrorString: document.querySelector('#errorsting')
    };
    let FormScripts = {
        RegButtonActions: function (selector_list) {
            DataScripts.verifyDBforReg(selector_list).then(function (onDBData){
                let flag_list =[]
                for(let i=0; i<onDBData.length;i++){
                    let temp =[]
                    for(let j=0;j<onDBData[i].length;j++){
                        if(onDBData[i][j] === "1") temp.push(true)
                        else temp.push(false)
                    }
                    flag_list.push(temp)
                }
                return flag_list
            }).then(function (temp_list){
                let desc_flag_list = [DataScripts.verifyFlagListName(selector_list[0].value),
                    DataScripts.verifyFlagListEmail(selector_list[1].value, temp_list[0][0]),
                    DataScripts.verifyFlagListPhone(selector_list[2].value, temp_list[0][1]),
                    DataScripts.verifyFlagListPass(selector_list[3].value),
                    DataScripts.verifyFlagListOfComparition(selector_list[3].value, selector_list[4].value,
                        DataScripts.verifyFlagListPass(selector_list[3].value).every(elem => elem === true))]


                let obj = {
                    server_list : temp_list[1],
                    js_list : desc_flag_list
                }


                return obj
            }).then(function (result_obj){
                let res = []
                FormScripts.changeDescColor(result_obj.js_list,
                    [RegDescriptions.NameDesc,RegDescriptions.EmailDesc, RegDescriptions.PhoneDesc,
                        RegDescriptions.PassDesc, RegDescriptions.VerPassDesc])

                let verify_list = DataScripts.getVerifyByDesc([RegDescriptions.NameDesc, RegDescriptions.EmailDesc
                    , RegDescriptions.PhoneDesc ,RegDescriptions.PassDesc, RegDescriptions.VerPassDesc])

                for(let i=0; i<result_obj.server_list.length; i++){
                    if(result_obj.server_list[i] && verify_list[i]) res.push(true)
                    else res.push(false)
                }

                res.push(verify_list[verify_list.length-1])

                return res
            }).then(function (verify_list){
                FormScripts.changeFieldColor(verify_list, selector_list)
                if(verify_list.every((elem => elem === true)) === true){
                    DataScripts.Registration(selector_list[0].value, selector_list[1].value,
                        selector_list[2].value, selector_list[3].value)
                    window.open('vendor/Relocator.php','_self',false)
                }
            })
        }
        ,
        LogButtonActions: function(selector_list){
            let obj = {
                email: selector_list[0],
                pass: selector_list[1]
            }
            DataScripts.verifyDBforLog(obj).then((response_answer) =>{
                if(response_answer == '1') {
                    window.open('vendor/Relocator.php', '_self', false)
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
                this.ReloadFields([RegFields.Name, RegFields.Email, RegFields.Phone, RegFields.Pass, RegFields.VerPass])
                this.ReloadDesc([RegDescriptions.NameDesc, RegDescriptions.EmailDesc, RegDescriptions.PhoneDesc,
                    RegDescriptions.PassDesc, RegDescriptions.VerPassDesc])
            } else {
                document.forms[1].reset();
                this.ReloadFields([LogFields.Email, LogFields.Pass])
                LogFields.ErrorString.classList.remove('_error')
            }
        }
        ,
        changeFieldColor: function (flag_list, selector_list) {
            this.ReloadFields(selector_list)
            //Добавляем классы в зависимости от ошибок
            for (let i = 0; i < flag_list.length; i += 1) {
                if (flag_list[i]) {
                    selector_list[i].classList.add('_confirm')
                } else {
                    selector_list[i].classList.add('_error')
                }
            }
        }
        ,
        changeDescColor: function (flag_list, ul_list) {
            this.ReloadDesc(ul_list)
            for (let i = 0; flag_list.length > i; i++) {
                for (let j = 0; flag_list[i].length > j; j++) {
                    if (flag_list[i][j]) {
                        ul_list[i][j].classList.add('_confirm')
                    } else {
                        ul_list[i][j].classList.add('_error')
                    }
                }
            }
        }
        ,
        ReloadDesc: function (ul_list) {
            for (let i = 0; ul_list.length > i; i++) {
                for (let j = 0; ul_list[i].length > j; j++)
                    ul_list[i][j].classList.remove('_confirm', '_error')
            }
        }
        ,
        ReloadFields: function (field_list) {
            for (let i = 0; field_list.length > i; i++) {
                field_list[i].classList.remove('_confirm', '_error')
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
    let DataScripts = {
        verifyDBforReg: async function (selector_list){
            let FM = new FormData()
            //Создаём объект с данными для БД
            FM.append("name", selector_list[0].value)
            FM.append("email", selector_list[1].value)
            FM.append("phone", selector_list[2].value)
            FM.append("pass", selector_list[3].value)
            //Проверка email на уникальность

            let result = fetch('../vendor/verifyOnExisting.php',{
                method: 'POST',
                body: FM
            }).then(function (response){
                return response.json()
            })

            return result
        }
        ,
        verifyDBforLog: async function(selector_obj){
            let FM = new FormData()
            //Создаём объект с данными для БД
            FM.append("email", selector_obj.email.value)
            FM.append("pass", selector_obj.pass.value)

            let result = fetch('../vendor/Log.php', {
                method: 'POST',
                body: FM
            }).then((response) =>{
                return response.json()
            })

            return result
        }
        ,
        getVerifyByDesc : function (selector_list) {
            let flag_list = []
            for (let i = 0; i < selector_list.length; i++) {
                let a = 0;
                for (let j = 0; j < selector_list[i].length; j++) {
                    if(selector_list[i][j].classList.contains('_confirm')) a++;
                }
                if(a == selector_list[i].length) flag_list.push(true); else flag_list.push(false);
            }
            return flag_list
        }
        ,
        verifyFlagListName: function (name) {
            let flag_list = []
            let cyrillic_name = name.replace(/[a-z]+/gi, '')
            let special_name = name.replace(/[^a-zа-яёе\s-]+/gi, '')


            //Проверка на кириллицу - 0
            if (name.length !== cyrillic_name.length)
                flag_list.push(false)
            else
                flag_list.push(true)

            //Проверка на запрещённые символы - 1
            if (name.length !== special_name.length)
                flag_list.push(false)
            else
                flag_list.push(true)

            //Проверка на запрещённые символы в конце - 2
            if (!RegexCheckList.special_begin_n_end_name.test(name))
                flag_list.push(false)
            else
                flag_list.push(true)

            //Проверка на сдваивание запрещённых символов - 3
            if (!RegexCheckList.special_double_name.test(name))
                flag_list.push(false)
            else
                flag_list.push(true)

            //Проверка на длину имени
            if (name.length < 1)
                flag_list.push(false)
            else
                flag_list.push(true)

            return flag_list
        }
        ,
        verifyFlagListEmail: function (mail, flag) {
            let flag_list = []

            //Проверка формата
            if (!/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$/g.test(mail))
                flag_list.push(false)
            else
                flag_list.push(true)

            flag_list.push(flag)

            return flag_list
        }
        ,
        verifyFlagListPhone: function (phone, flag) {
            let flag_list = []

            //Проверка формата
            if (!RegexCheckList.phone.test(phone))
                flag_list.push(false)
            else
                flag_list.push(true)

            flag_list.push(flag)

            return flag_list
        }
        ,
        verifyFlagListPass: function (pass) {
            let flag_list = []

            let latinic_pass = pass.replace(/[а-яё]+/gi, '')
            let special_pass = pass.replace(/[^a-zа-яёе0-9./-]+/gi, '')

            //Проверка, что в строке только латиница
            if (latinic_pass.length !== pass.length)
                flag_list.push(false)
            else
                flag_list.push(true)

            //Проверка, что в строке нет запрещённых символов
            if (special_pass.length !== pass.length)
                flag_list.push(false)
            else
                flag_list.push(true)

            //Проверка на длину пароля
            if (pass.length < 6)
                flag_list.push(false)
            else
                flag_list.push(true)

            //Проверка на пароль только из специальных символов
            if (!RegexCheckList.special_all_string_pass)
                flag_list.push(false)
            else
                flag_list.push(true)

            return flag_list
        }
        ,
        verifyFlagListOfComparition: function (pass1, pass2, flag) {
            let flag_list = []

            if (pass1 !== pass2)
                flag_list.push(false)
            else
                flag_list.push(true)

            if (!flag)
                flag_list.push(false)
            else
                flag_list.push(true)

            return flag_list
        }
        ,
        Registration: function (name, mail, phone, pass) {
            let FM = new FormData()
            FM.append("name", name)
            FM.append("mail", mail)
            FM.append("phone", phone)
            FM.append("password", pass)

            fetch('../vendor/signUp.php', {
                method: 'POST',
                body: FM
            })
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
        onRegButtonClick: function (RegButton, field_list) {
            RegButton.addEventListener('click', function () {
                FormScripts.RegButtonActions(field_list)
            })
        }
        ,
        onLogButtonClick: function (LogButton, field_list) {
            LogButton.addEventListener('click', function () {
                FormScripts.LogButtonActions(field_list)
            })
        }
    };

    Subscribes.onRegButtonClick(RegFields.SubmitButton,[RegFields.Name, RegFields.Email, RegFields.Phone, RegFields.Pass, RegFields.VerPass])
    Subscribes.onLogButtonClick(LogFields.SubmitButton, [LogFields.Email, LogFields.Pass])
    Subscribes.onAgreeCheckBoxSwitch(RegFields.AgreeCheckBoxLabel, RegFields.AgreeCheckBox)
    Subscribes.onPopUpsCloseAction(document.querySelectorAll('.pop-up-close'))
}

document.addEventListener('DOMContentLoaded', function () {
    __reg_init__()
})